<?php
session_start();

// Check if the user clicked on the logout link
if (isset($_GET['logout'])) {
    // Destroy the session and logout the user
    session_unset();  // Unset all session variables
    session_destroy();  // Destroy the session
    header("Location: admin_index.php"); // Redirect to the login page
    exit();
}

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['SESS_MEMBER_ID']) || trim($_SESSION['SESS_MEMBER_ID']) === '') {
    header("Location: admin_index.php"); // Redirect to the login page
    exit();
}
?>
