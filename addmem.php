<?php 
session_start();

// Include the database connection
include('connection.php');

// Check if $bd is defined
if (!isset($bd)) {
    die("Database connection is not defined.");
}

try {
    // Retrieve form data
    $studentnum = $_POST['studentnum'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $contacts = $_POST['contacts'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Prepare and execute the SQL query using PDO
    $sql = "INSERT INTO members (studentnum, name, surname, contacts, password, email) VALUES (:studentnum, :name, :surname, :contacts, :password, :email)";
    $stmt = $bd->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':studentnum', $studentnum);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':contacts', $contacts);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect on success
        header("Location: loginindex.php");
        exit;
    } else {
        echo "Error: Could not execute the query.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// No need to explicitly close the connection; PDO handles it automatically.
?>
