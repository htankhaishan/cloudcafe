<?php
session_start(); // Always start the session at the top
?>


<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div style="width:900px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0);">
        <div style="background-color:#ff3300; height:40px;">
            <div style="float:right; width:50px; margin-right:20px; background-color:#cccccc; text-align:center;">
                <a href="home_admin.php">Back</a>
            </div>
            <div style="float:left; margin-left:10px; margin-top:10px;">
                <strong>Welcome</strong> <?php echo $_SESSION['SESS_FIRST_NAME']; ?>  <!-- Display the first name here -->
            </div>
        </div>

        <br />
        <label style="margin-left:12px;">Filter</label>
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

                // Query to fetch orders
                $result3 = mysqli_query($bd, "SELECT * FROM wings_orders");

                // Fetch and display orders
                while ($row3 = mysqli_fetch_array($result3)) {
                    echo '<tr>';
                    echo '<td>' . $row3['cusid'] . '</td>';
                    echo '<td>' . 'M' . $row3['total'] . '.00' . '</td>';
                    echo '<td>' . '<a rel="facebox" href="listorder.php?id=' . $row3["transactioncode"] . '">' . $row3['transactioncode'] . '</a></td>';
                    echo '<td>' . $row3['transactiondate'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
