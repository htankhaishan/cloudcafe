<?php
session_start();
include("connection.php");  // Include the connection to MySQL

$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize the input
$email = mysqli_real_escape_string($bd, $email);
$password = mysqli_real_escape_string($bd, $password);

// Query the database to check credentials
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($bd, $sql);

// Check if user exists
if (mysqli_num_rows($result) == 1) {
    // Fetch user data
    $user = mysqli_fetch_assoc($result);

    // Store user details in session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['SESS_FIRST_NAME'] = $user['first_name']; // Set first name in session

    // Debugging: Check if session variable is set
    echo "First Name: " . $_SESSION['SESS_FIRST_NAME'];  // This will print the first name to the screen

    // Redirect to home_admin.php
    header("Location: home_admin.php");
    exit();
} else {
    // Invalid login
    echo "<h4 style='color:red;'>Please enter your correct login details!</h4>";
}
?>
