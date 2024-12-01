<?php
session_start();

// Function to check if the user is logged in
function logged_in() {
    return isset($_SESSION['user_id']);
}

// Function to confirm if the user is logged in
function confirm_logged_in() {
    if (!logged_in()) {
        echo '<script type="text/javascript">window.location = "login.php";</script>';
        exit();
    }
}
?>
