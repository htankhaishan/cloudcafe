<?php 
session_start();

include('connection.php');

// Retrieve form data
$studentnum = $_POST['studentnum'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$contacts = $_POST['contacts'];
$password = $_POST['password'];
$email = $_POST['email'];

// Prepare and execute the SQL query using mysqli
$sql = "INSERT INTO members (studentnum, name, surname, contacts, password, email) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $bd->prepare($sql);

if ($stmt) {
    // Bind parameters
    $stmt->bind_param("ssssss", $studentnum, $name, $surname, $contacts, $password, $email);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect on success
        header("Location: loginindex.php");
        exit;
    } else {
        // Log and display error message
        echo "Error: " . $stmt->error;
    }
} else {
    // Log and display error in statement preparation
    echo "Error in SQL preparation: " . $bd->error;
}

// Close the database connection
$bd->close();
?>
