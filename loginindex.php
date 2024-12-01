<?php
session_start();
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_FIRST_NAME']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css">
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
                    <li><a href="loginindex.php" class="current">Order Now!</a></li>
                    <li><a href="admin_index.php">Admin</a></li>
                </ul>
            </div>
        </nav>
        <main id="content">
            <div class="login-box">
                <form id="form1" name="login" method="post" action="loginexec.php">
                    <div class="form-header">Members Login</div>
                    <table align="center">
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td><input type="text" name="user" id="email" required></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td><input type="password" name="password" id="password" required></td>
                        </tr>
                        <tr>
                            <td><a href="new.php">No account? Register here</a></td>
                            <td><input type="submit" name="Submit" value="Login"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
