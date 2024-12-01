<?php
// Start session
session_start();

// Check if session variables are set (i.e., user is logged in)
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    // If not logged in, redirect to the login page
    header("Location: admin_index.php");
    exit();
}

// Retrieve session variables
$email = $_SESSION['email'];
$password = $_SESSION['password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="css/ble.css" rel="stylesheet" type="text/css" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="container">
        <div id="header_section">
            <div style="float:right; width:50px; margin-right:20px; background-color:#cccccc; text-align:center;">
                <a href="admin_index.php">Logout</a>
            </div>
            <p>&nbsp;</p>
        </div>

        <div id="menu_bg">
            <div id="menu">
                <ul>
                    <li><a href="index.php" class="current">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="loginindex.php">Order Now! </a></li>
                    <li><a href="admin_index.php">Admin</a></li>
                </ul>
            </div>
        </div>

        <div id="content">
            <div style="width:300px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:10%;">
                <div style="height:40px; margin-bottom:10px;">
                    <div style="float:left; margin-left:10px; margin-top:10px; color:black">
                        <strong>Welcome, <?php echo htmlspecialchars($email); ?></strong>
                    </div>
                </div>

                <div align="center">
                    <p><strong>Session Details:</strong></p>
                    <p>Email: <?php echo htmlspecialchars($email); ?></p>
                    <p>Password: <?php echo htmlspecialchars($password); ?></p>
                </div>

                <div align="center">
                    <a href="vieworders.php"><img src="images/84.png" border="0" style="padding:5px;" title="View all orders" /></a><br />
                    <a href="addproduct.php"><img src="images/78.png" border="0" style="padding:5px;" title="Add products" /></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
