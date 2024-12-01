<?php
session_start();

// Include the database connection
include('connection.php');

// Get data from POST request
$studentnum = $_POST['studentnum'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$contacts = $_POST['contacts'];
$password = $_POST['password'];
$email = $_POST['email'];

// Prepare the SQL statement
$sql = "INSERT INTO members (studentnum, name, surname, contacts, password, email) VALUES ('$studentnum', '$name', '$surname', '$contacts', '$password', '$email')";

// Execute the query using mysqli_query
if (mysqli_query($bd, $sql)) {
    // If the query was successful, redirect to the login page
    header("Location: loginindex.php");
    exit();
} else {
    // If there was an error with the query, display the error message
    die("Could not connect: " . mysqli_error($bd));
}

// Close the database connection
mysqli_close($bd);
?>
