<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "@Bcde12345";
$mysql_database = "wings";

try {
    // Create a new PDO instance
    $bd = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_user, $mysql_password);
    
    // Set the PDO error mode to exception
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set the charset for the connection
    $bd->exec("SET NAMES 'utf8mb4'");

} catch (PDOException $e) {
    // If there is an error, display it
    die("Connection failed: " . $e->getMessage());
}
?>
