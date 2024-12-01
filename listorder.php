<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<table width="249" border="1" cellpadding="0" cellspacing="0">
  <tr >
    <td width="189"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;Products</div></td>
    <td width="65">Price</td>
    <td width="50">Qty</td>
  </tr>
  
<?php
if (isset($_GET['id'])) {
    include('connection.php');

    $id = $_GET['id'];

    // Using mysqli query to select order items
    $result3 = $bd->query("SELECT * FROM orderditems WHERE transactioncode = '$id'");

    // Fetching results
    while ($row3 = $result3->fetch_assoc()) {
        echo '<tr>';
        echo '<td><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;' . $row3['name'] . '</div></td>';
        echo '<td>' . 'M' . $row3['price'] . '.00' . '</td>';
        echo '<td>' . $row3['quantity'] . '</td>';
        echo '</tr>';
    }
}
?>
</table><br>

<?php
if (isset($_GET['id'])) {
    include('connection.php');

    $id = $_GET['id'];

    // Fetching order details
    $result3 = $bd->query("SELECT * FROM orderditems WHERE transactioncode = '$id'");
    $row3 = $result3->fetch_assoc();
    $var = $row3['customer'];

    // Fetching member details
    $result4 = $bd->query("SELECT * FROM members WHERE id = '$var'");
    $row4 = $result4->fetch_assoc();
}
?>
<br />
