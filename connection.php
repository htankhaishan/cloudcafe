<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);  // Show errors for debugging

$mysql_hostname = "127.0.0.1";
$mysql_user = "root";
$mysql_password = "@Bcde12345";
$mysql_database = "wings";

// Create a new MySQLi connection
$bd = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check for a connection error
if ($bd->connect_error) {
    die("Connection failed: " . $bd->connect_error);
}

// If the connection is successful, select the database (mysqli automatically does this on connection)
echo "Connected successfully to the database '$mysql_database'";

?>
