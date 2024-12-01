<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List - Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div style="width:900px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:10%;">
        <div style="background-color:#ff3300; height:40px; margin-bottom:10px;">
            <div style="float:right; width:50px; margin-right:20px; background-color:#cccccc; text-align:center;">
                <a href="home_admin.php">Back</a>
            </div>
            <div style="float:left; margin-left:10px; margin-top:10px;">
                <strong>Welcome</strong> <?php echo $_SESSION['SESS_FIRST_NAME']; ?>
            </div>
        </div>
        <br /><label style="margin-left:12px;">Filter</label>
        <input type="text" name="filter" value="" id="filter" />
        <br /><br />
        <table cellpadding="1" cellspacing="1" id="resultTable" border="1">
            <thead>
                <tr bgcolor="#cccccc">
                    <th>Student Num</th>
                    <th>Amount Paid</th>
                    <th>Code (click to view order)</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include('connection.php');
                $result3 = $bd->query("SELECT * FROM wings_orders");

                while 
