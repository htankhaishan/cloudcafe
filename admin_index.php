<?php
// Start session
session_start();

// Unset session variables
unset($_SESSION['SESS_MEMBER_ID']);

unset($_SESSION['SESS_FIRST_NAME']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css">
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage : 'src/loading.gif',
                closeImage   : 'src/closelabel.png'
            });
        });

        function validateForm() {
            var email = document.forms["login"]["email"].value;
            var password = document.forms["login"]["password"].value;

            if (!email) {
                alert("You must enter your email");
                return false;
            }
            if (!password) {
                alert("You must enter your password");
                return false;
            }
        }
    </script>
</head>
<body>
<div id="container">
    <header id="header_section"></header>
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
        <div class="login-form">
            <form name="login" method="post" action="admin.php" onsubmit="return validateForm()">
                <div class="form-header">Administrator Login</div>
                <table align="center">
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="text" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="Submit" value="Login">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </main>
</div>
<footer>
    <div class="middle">Copyright © Wings Cafe 2024</div>
</footer>
</body>
</html>
