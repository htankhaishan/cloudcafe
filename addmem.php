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
    $stmt = $bd->prepare("INSERT INTO members (studentnum, name, surname, contacts, password, email) 
                          VALUES (:studentnum, :name, :surname, :contacts, :password, :email)");
    $stmt->bindParam(':studentnum', $studentnum);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':contacts', $contacts);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    
    $stmt->execute();
    
    // Redirect to login page after successful insertion
    header("Location: loginindex.php");
    exit();
} catch (PDOException $e) {
    // Handle errors and display a message
    die("Error: Could not connect. " . $e->getMessage());
}

// Close the connection
$bd = null;
?>
