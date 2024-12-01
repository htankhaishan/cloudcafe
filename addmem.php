<?php
session_start();

include('connection.php');

// Collect form data
$studentnum = $_POST['studentnum'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$contacts = $_POST['contacts'];
$password = $_POST['password'];
$email = $_POST['email'];

try {
    // Use prepared statement to prevent SQL injection
    $stmt = $bd->prepare("INSERT INTO members (studentnum, name, surname, contacts, password, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $studentnum, $name, $surname, $contacts, $password, $email);
    $stmt->execute();
    $stmt->close();

    // Redirect to login page after successful insertion
    header("Location: loginindex.php");
    exit();
} catch (Exception $e) {
    // Handle errors and display a message
    die("Error: Could not connect. " . $e->getMessage());
}

// Close the connection
$bd->close();
?>
