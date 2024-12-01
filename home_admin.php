<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="container">
        <header id="header_section">
            <div style="float:right; width:50px; margin-right:20px;">
                <a href="admin_index.php">Logout</a>
            </div>
        </header>
        <nav id="menu_bg">
            <div id="menu">
                <ul>
                    <li><a href="index.php" class="current">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="loginindex.php">Order Now!</a></li>
                    <li><a href="admin_index.php">Admin</a></li>
                </ul>
            </div>
        </nav>
        <main id="content">
            <div class="welcome-box">
                <div class="welcome-message">
                    <strong>Welcome, <?php echo $_SESSION['SESS_FIRST_NAME']; ?></strong>
                </div>
                <div class="admin-actions">
                    <a href="vieworders.php" class="action-button">
                        <img src="images/84
