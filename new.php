<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Registration - Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
        function validateForm() {
            var j = document.forms["abc"]["studentnum"].value;
            var a = document.forms["abc"]["name"].value;
            var b = document.forms["abc"]["surname"].value;
            var d = document.forms["abc"]["email"].value;
            var e = document.forms["abc"]["password"].value;
            var f = document.forms["abc"]["ambot"].value;
            var g = document.forms["abc"]["contacts"].value;

            if (!j || !a || !b || !d || !e || !f || !g) {
                alert("All fields must be filled out.");
                return false;
            }

            if (e !== f) {
                alert("Passwords do not match.");
                return false;
            }

            var atpos = d.indexOf("@");
            var dotpos = d.lastIndexOf(".");
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= d.length) {
                alert("Not a valid email address.");
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
            <div class="registration-form">
                <form id="form1" name="abc" method="post" action="addmem.php" onsubmit="return validateForm()">
                    <h2>Members Registration</h2>
                    <table align="center">
                        <tr>
                            <td><label for="studentnum">Student Num:</label></td>
                            <td><input type="text" name="studentnum" id="studentnum"></td>
                        </tr>
                        <tr>
                            <td><label for="name">First Name:</label></td>
                            <td><input type="text" name="name" id="name"></td>
                        </tr>
                        <tr>
                            <td><label for="surname">Last Name:</label></td>
                            <td><input type="text" name="surname" id="surname"></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td><input type="email" name="email" id="email"></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td><input type="password" name="password" id="password"></td>
                        </tr>
                        <tr>
                            <td><label for="ambot">Retype Password:</label></td>
                            <td><input type="password" name="ambot" id="ambot"></td>
                        </tr>
                        <tr>
                            <td><label for="contacts">Contact Number:</label></td>
                            <td><input type="text" name="contacts" id="contacts"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Save">
                                <input type="reset" value="Clear">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
