<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="css/ble.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">

    <!-- Popup Scripts -->
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage : 'src/loading.gif',
                closeImage   : 'src/closelabel.png'
            });
        });
    </script>

    <!-- Form Validation -->
    <script type="text/javascript">
        function validateForm() {
            var y = document.forms["login"]["email"].value;
            var a = document.forms["login"]["password"].value;
            if ((y == null || y == "")) {
                alert("You must enter your username");
                return false;
            }
            if ((a == null || a == "")) {
                alert("You must enter your password");
                return false;
            }
        }
    </script>
</head>
<body>
    <div id="container">
        <div id="header_section">
            <div style="float:right; width:50px; margin-right:20px; background-color:#cccccc; text-align:center;">
                <a href="admin_index.php">Logout</a>
            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>

        <!-- Navigation Menu -->
        <div id="menu_bg">
            <div id="menu">
                <ul>
                    <li><a href="index.php" class="current">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="loginindex.php">Order Now!</a></li>
                    <li><a href="admin_index.php">Admin</a></li>
                </ul>
            </div>
        </div>

        <!-- Admin Content Section -->
        <div id="content">
            <div style="width:300px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); 
                        -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; 
                        -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); 
                        box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:10%;">
                <div style="height:40px; margin-bottom:10px;">
                    <div style="float:left; margin-left:10px; margin-top:10px; color:black">
                        <strong>Welcome</strong> <?php echo $_SESSION['SESS_FIRST_NAME']; ?>
                    </div>
                </div>

                <div align="center">
                    <!-- Link to View Orders -->
                    <a href="vieworders.php">
                        <img src="images/84.png" border="0" style="padding:5px;" title="View all orders" />
                    </a><br />

                    <!-- Link to Add Products -->
                    <a href="addproduct.php">
                        <img src="images/78.png" border="0" style="padding:5px;" title="Add products" />
                    </a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
