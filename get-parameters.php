<?php
require 'vendor/autoload.php';

use Aws\Ssm\SsmClient;
use Aws\Exception\AwsException;

$az = file_get_contents('http://169.254.169.254/latest/meta-data/placement/availability-zone');
$region = substr($az, 0, -1);

$ssm_client = new SsmClient([
    'version' => 'latest',
    'region'  => $region
]);

try {
    $result = $ssm_client->getParametersByPath([
        'Path' => '/example/',
        'WithDecryption' => true
    ]);

    $values = [];
    foreach ($result['Parameters'] as $p) {
        $values[$p['Name']] = $p['Value'];
    }

    $ep = $values['/example/endpoint'] ?? '';
    $un = $values['/example/username'] ?? '';
    $pw = $values['/example/password'] ?? '';
    $db = $values['/example/database'] ?? '';
} catch (AwsException $e) {
    error_log("Error retrieving parameters: " . $e->getMessage());
    $ep = $un = $pw = $db = '';
}
?>
