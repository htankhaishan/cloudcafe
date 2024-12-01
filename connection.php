<?php
// Create connection to the database
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "@Bcde12345"; // Your MySQL password (empty for XAMPP by default)
$dbname = "wings"; // Your database name

// Create a connection
$bd = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($bd->connect_error) {
    die("Connection failed: " . $bd->connect_error);
}
?>
