<?php
// Include AWS SDK for PHP
require 'vendor/autoload.php';

use Aws\Ssm\SsmClient;
use Aws\Exception\AwsException;

// Get the region based on instance metadata
$az = file_get_contents('http://169.254.169.254/latest/meta-data/placement/availability-zone');
$region = substr($az, 0, -1);

// Create the SSM client
$ssm_client = new SsmClient([
    'version' => 'latest',
    'region'  => $region
]);

try {
    // Retrieve parameters from AWS SSM
    $result = $ssm_client->getParametersByPath([
        'Path' => '/example/',
        'WithDecryption' => true
    ]);

    // Store the parameters in an array
    $values = [];
    foreach ($result['Parameters'] as $p) {
        $values[$p['Name']] = $p['Value'];
    }

    // Extract the parameters
    $ep = $values['/example/endpoint'] ?? '';
    $un = $values['/example/username'] ?? '';
    $pw = $values['/example/password'] ?? '';
    $db = $values['/example/database'] ?? '';
} catch (AwsException $e) {
    // Log the error and set defaults for parameters
    error_log("Error retrieving parameters: " . $e->getMessage());
    $ep = $un = $pw = $db = '';
}
?>
