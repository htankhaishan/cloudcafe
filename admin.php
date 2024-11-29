<?php
session_start();

include("connection.php"); // Ensure $bd is defined as the mysqli connection

// Fetch input safely using prepared statements
$id = $_POST['email'];
$password = $_POST['password'];

// Prepare the SQL statement to prevent SQL injection
$stmt = $bd->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $id, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if exactly one user exists with the provided credentials
if ($result->num_rows === 1) {
    session_regenerate_id();
    $member = $result->fetch_assoc();
    $_SESSION['SESS_MEMBER_ID'] = $member['id'];
    $_SESSION['SESS_FIRST_NAME'] = $member['username'];
    session_write_close();
    header("location:home_admin.php");
    exit();
} else {
    echo "<h4 style='color:red;'>Please enter your correct login details!!!</h4>";
}
?>
