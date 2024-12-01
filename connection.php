<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "@Bcde12345";
$mysql_database = "wings";

// Create a new mysqli object
$bd = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check for connection errors
if ($bd->connect_error) {
    die("Connection failed: " . $bd->connect_error);
}

// Set the charset for the connection
$bd->set_charset("utf8mb4");
?>
