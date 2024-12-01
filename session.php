<?php
session_start();  // Start the session

// Function to check if the user is logged in
function logged_in() {
    return isset($_SESSION['user_id']);
}

// Function to confirm if the user is logged in
function confirm_logged_in() {
    if (!logged_in()) {
        header("Location: login.php");
        exit();  // Ensure redirection stops here
    }
}

// Optional: Check if session variables are set
if (isset($_SESSION['SESS_FIRST_NAME'])) {
    echo "Session First Name: " . $_SESSION['SESS_FIRST_NAME'];
} else {
    echo "No First Name found in session.";
}
?>
