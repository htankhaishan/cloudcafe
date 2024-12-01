<?php
// Debugging: Check if session variable is set
if (isset($_SESSION['SESS_FIRST_NAME'])) {
    echo "First Name: " . $_SESSION['SESS_FIRST_NAME']; // This will display the first name
} else {
    echo "First Name not set!";
}
include("session.php");
confirm_logged_in();
var_dump($_SESSION);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="css/ble.css" rel="stylesheet" type="text/css" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <!-- Facebox -->
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
    <style type="text/css">
        a:link, a:visited, a:hover, a:active {
            text-decoration: none;
        }
    </style>
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
    <div id="content">
        <div style="width:300px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); 
                    -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; 
                    -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); 
                    box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:10%;">
            <div style="height:40px; margin-bottom:10px;">
                <div style="float:left; margin-left:10px; margin-top:10px; color:black;">
                    <strong>Welcome </strong><?php echo htmlspecialchars($_SESSION['email']); ?>
                </div>
            </div>
            <div align="center">
                <a href="vieworders.php"><img src="images/84.png" border="0" style="padding:5px;" title="View All Orders" /></a><br />
                <a href="addproduct.php"><img src="images/78.png" border="0" style="padding:5px;" title="Add Products" /></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
