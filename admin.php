<?php
session_start();
include("connection.php");
$id = $_POST['email'];
$password = $_POST['password'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Create query with prepared statement
$stmt = $bd->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
$stmt->bindParam(':email', $id);
$stmt->bindParam(':password', $password);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    session_regenerate_id();
    $_SESSION['SESS_MEMBER_ID'] = $result['id'];
    $_SESSION['SESS_FIRST_NAME'] = $result['username'];
    session_write_close();
    header("Location: home_admin.php");
    exit();
} else {
    echo "<h4 style='color:red;'>Please enter your correct login details!!!</h4>";
}
$stmt = null;
$bd = null;
?>
