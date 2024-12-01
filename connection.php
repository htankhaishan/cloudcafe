<?php
// Set database credentials
$host = 'localhost';  // or your database host
$dbname = 'wings'; // your database name
$username = 'root'; // your username
$password = '@Bcde12345'; // your password

try {
    // Create PDO instance
    $bd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // In case of an error, display the error message
    die("Error: " . $e->getMessage());
}
?>
