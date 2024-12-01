<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);  // Show errors for debugging

$mysql_hostname = "127.0.0.1";
$mysql_user = "root";
$mysql_password = "@Bcde12345";
$mysql_database = "wings";

try {
    // Create a new PDO connection and assign it to $db
    $db = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database;charset=utf8", $mysql_user, $mysql_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for errors
    echo "Connected successfully to the database '$mysql_database'";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
