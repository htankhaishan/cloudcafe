<?php
require_once('auth.php');
include('connection.php'); // Ensure this defines $db as a PDO object
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wings Cafe</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage : 'src/loading.gif',
            closeImage   : 'src/closelabel.png'
        });
    });
</script>
</head>
<body>
<div id="container">
  <div id="header_section">
    <div style="float:right; margin-right:30px;">
      <?php 
      $id = $_SESSION['SESS_MEMBER_ID'];
      try {
          $stmt = $db->prepare("SELECT name, surname FROM members WHERE id = :id");  // Changed to $db
          $stmt->bindParam(':id', $id);
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($row) {
              echo $row['name'] . ' ' . $row['surname'];
          }
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
      ?>
      &nbsp;<a href="logout.php" id="logout-button">Logout</a>
    </div>
  </div>
  <div id="menu_bg">
    <div id="menu">
      <ul>
        <div style="float:left">
          <input name="time" type="text" id="txt" readonly style="border: 0; font-size: 25px; margin-top: -5px; height: 23px; width: 130px; background-color:#000; color:#FF0000;" />
        </div>
      </ul>
    </div>
  </div>
  <div id="content">
    <div id="content_left">
      <div class="text">Select From Menu Below </div>
      <div class="view1">
        <?php
        try {
            $stmt = $db->query("SELECT * FROM products");  // Changed to $db
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="box">';
                echo '<a rel="facebox" href="portal.php?id=' . htmlspecialchars($row["product_id"]) . '">';
                echo '<img src="images/bgr/' . htmlspecialchars($row['product_photo']) . '" width="75px" height="75px" />';
                echo '</a>';
                echo '<div class="textbox">' . htmlspecialchars($row['name']) . '</div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
      </div>
    </div>
    <div id="content_right">
      <form method="post" action="confirm.php" name="abcd" onsubmit="return validateForm()">
        <input name="id" type="hidden" value="<?php echo htmlspecialchars($_SESSION['SESS_MEMBER_ID']); ?>" />
        <input name="transactioncode" type="hidden" value="<?php echo htmlspecialchars($_SESSION['SESS_FIRST_NAME']); ?>" />
        <h2>Order Details</h2>
        <table width="335" border="1" cellpadding="0" cellspacing="0" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
          <tr>
            <td width="90"><div align="center"><strong>Product Name</strong></div></td>
            <td width="27"><div align="center"><strong>Qty</strong></div></td>
            <td width="45"><div align="center"><strong>Price</strong></div></td>
            <td width="46"><div align="center"><strong>Total</strong></div></td>
            <td width="29"><div align="center"><strong>Del</strong></div></td>
          </tr>
          <?php
          try {
              $memid = $_SESSION['SESS_FIRST_NAME'];
              $stmt = $db->prepare("SELECT * FROM orderditems WHERE transactioncode = :transactioncode");  // Changed to $db
              $stmt->bindParam(':transactioncode', $memid);
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<tr>';
                  echo '<td><div align="center">' . htmlspecialchars($row['name']) . '</div></td>';
                  echo '<td><div align="center">' . htmlspecialchars($row['quantity']) . '</div></td>';
                  echo '<td><div align="center">' . htmlspecialchars($row['price']) . '</div></td>';
                  echo '<td><div align="center">' . htmlspecialchars($row['total']) . '</div></td>';
                  echo '<td><div align="center"><a href="deleteorder.php?id=' . htmlspecialchars($row['id']) . '">Cancel</a></div></td>';
                  echo '</tr>';
              }
          } catch (PDOException $e) {
              echo "Error: " . $e->getMessage();
          }
          ?>
        </table>
      </form>
    </div>
  </div>
</div>
</body>
</html>
