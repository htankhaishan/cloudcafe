<?php
require_once('auth.php');
include('connection.php'); // Make sure the connection is included

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Wings Cafe</title>
    <style type="text/css">
        .style1 {
            color: #000000;
            font-weight: bold;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <form action="saveorder.php" method="post">
        <input name="id" type="hidden" value="<?php echo htmlspecialchars($_SESSION['SESS_MEMBER_ID']); ?>" />
        <input name="transcode" type="hidden" value="<?php echo htmlspecialchars($_SESSION['SESS_FIRST_NAME']); ?>" />
        
        <table width="400" border="0" cellpadding="0" cellspacing="0">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // Use PDO to fetch product details
                $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Display product details
                foreach ($result as $row3) {
                    $id = $row3['id'];

                    echo '<tr>';
                    echo '<td width="80"><img src="images/bgr/' . htmlspecialchars($row3['product_photo']) . '" alt="Product Image" /></td>';
                    echo '<td width="200"><span class="style1">' . htmlspecialchars($row3['name']) . '</span></td>';
                    echo '<td width="120"></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td width="80">
                            <input name="name" type="text" value="' . htmlspecialchars($row3['name']) . '" readonly/>
                            <input name="id" type="hidden" value="' . htmlspecialchars($id) . '"/>
                          </td>';
                    echo '<td width="120"></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>

        <br />
        <label style="color:#000000;"></label>
        <br />
        <table width="400" border="0" cellpadding="0" cellspacing="0" style="color:#000000;"> 
            <tr>
                <td width="128">Price</td>
                <td width="93">Quantity</td>
            </tr>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // Use PDO to fetch pricing and quantity information
                $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row3) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row3['price']) . '</td>';
                    echo '<input type="hidden" name="price" value="' . htmlspecialchars($row3['price']) . '">';
                    echo '<input type="hidden" name="name" value="' . htmlspecialchars($row3['name']) . '">';
                    echo '<td><input type="text" size="5" name="quantity"></td>';
                    echo '<td><input name="butadd" type="image" value="' . htmlspecialchars($row3['id']) . '" src="images/button.png" /></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </form>
</body>
</html>
