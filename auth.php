<?php
session_start();

// Logout the user if 'logout' is set in the URL query string
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Delete the session cookie (if it exists)
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }

    // Redirect to the login page (admin_index.php)
    header("Location: admin_index.php");
    exit();
}

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['SESS_MEMBER_ID']) || trim($_SESSION['SESS_MEMBER_ID']) === '') {
    header("Location: admin_index.php"); // Redirect to login page
    exit();
}
?>
