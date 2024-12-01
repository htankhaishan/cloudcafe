<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        function validateForm() {
            var a = document.forms["abcd"]["num"].value;
            if (!a) {
                alert("You must enter your student number.");
                return false;
            }

            if (!document.abcd.checkbox.checked) {
                alert('Please agree to the terms and conditions.');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div id="container">
        <header id="header_section">
            <div style="float:right; width:50px; margin-right:20px;">
                <a href="logout.php">Logout</a>
            </div>
            <strong>Welcome, <?php echo $_SESSION['SESS_FIRST_NAME']; ?></strong>
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
            <form method="post" action="confirm.php" name="abcd" onsubmit="return validateForm()">
                <h2>Order Details</h2>
                <table border="1" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Del</th>
                    </tr>
                    <?php
                    include('connection.php');
                    $memid = $_SESSION['SESS_FIRST_NAME'];
                    $resulta = $bd->query("SELECT * FROM orderditems WHERE transactioncode = '$memid'");

                    while ($row = $resulta->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['total']}</td>
                     
