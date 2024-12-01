<?php
// Start session
session_start();

// Check if the user is already logged in, if so, redirect to home_admin.php
if (isset($_SESSION['email'])) {
    header('Location: home_admin.php');
    exit();
}

// Handle login form submission
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Example: Hardcoded check for demo purposes (replace with database check)
    if ($email == 'admin' && $password == 'admin') {
        // Start the session and set session variables
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        // Redirect to home_admin.php after successful login
        header('Location: home_admin.php');
        exit();
    } else {
        $error_message = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        function validateForm() {
            var y = document.forms["login"]["email"].value;
            var a = document.forms["login"]["password"].value;
            if (y == null || y == "") {
                alert("You must enter your username");
                return false;
            }
            if (a == null || a == "") {
                alert("You must enter your password");
                return false;
            }
        }
    </script>
</head>
<body>
    <div id="container">
        <div id="header_section">
            <p>&nbsp;</p>
        </div>
        <div id="content">
            <div style="width:300px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:20px;">
                <form name="login" method="post" action="admin_index.php" onsubmit="return validateForm()">
                    <div style="font-family:Arial, Helvetica, sans-serif; color:#000000; padding:5px; height:22px;">
                        <strong>Administrator Login</strong>
                    </div>
                    <table width="286" align="center" style="color:black;">
                        <tr>
                            <td colspan="2">
                                <?php if (isset($error_message)) { echo "<div style='color:red;'>$error_message</div>"; } ?>
                            </td>
                        </tr>
                        <tr>
                            <td><div align="right">Username</div></td>
                            <td><input type="text" name="email" /></td>
                        </tr>
                        <tr>
                            <td><div align="right">Password</div></td>
                            <td><input type="password" name="password" /></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="Submit" value="Login" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
