<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Portal - Wings Cafe</title>
</head>
<body>
<form action="saveorder.php" method="post">
    <input name="id" type="hidden" value="<?php echo $_SESSION['SESS_MEMBER_ID']; ?>" />
    <input name="transcode" type="hidden" value="<?php echo $_SESSION['SESS_FIRST_NAME']; ?>" />
    <table width="400" border="0" cellpadding="0" cellspacing="0">
        <?php
        if (isset($_GET['id'])) {
            include('connection.php');
            $id = $_GET['id'];
            $result = $bd->query("SELECT * FROM products WHERE product_id = $id");

            while ($row3 = $result->fetch_assoc()) {
                echo "<tr>
                        <td><img src='images/bgr/{$row3['product_photo']}' width='75' height='75'></td>
                        <td><input name='name' type='text' value='{$row3['name']}' readonly /></td>
                      </tr>";
            }
        }
        ?>
    </table>
    <table width="400" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>Price:</td>
            <td><input type="text" name="price" value="<?php echo $row3['price']; ?>" readonly /></td>
        </tr>
        <tr>
            <td>Quantity:</td>
            <td><input type="text" name="quantity" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Add to Order">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
