<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['SESS_MEMBER_ID']) || trim($_SESSION['SESS_MEMBER_ID']) === '') {
    header("Location: loginindex.php"); // Redirect to the login page
    exit();
}
?>
