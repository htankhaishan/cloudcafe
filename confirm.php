<?php 
require_once('auth.php');
?>
<form method="post" action="">
<?php
$total = $_POST['total'];
$transactioncode = $_POST['transactioncode'];
?>
<input name="transactioncode" type="hidden" value="<?php echo $transactioncode;?>" />
<input name="total" type="hidden" value="<?php echo $total;?>" />
</form>

<?php
include('connection.php');
$total = $_POST['total'];
$transactiondate = date("m/d/Y");
$transactioncode = $_POST['transactioncode'];	
$student = $_POST['num'];

// Use prepared statements to prevent SQL injection
$stmt = $bd->prepare("SELECT studentnum FROM members WHERE studentnum = ?");
$stmt->bind_param("i", $student);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo "Wrong student number";
    exit(0);
}

$stmt->close();

// Insert the order using a prepared statement
$stmt = $bd->prepare("INSERT INTO wings_orders (cusid, total, transactiondate, transactioncode) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $student, $total, $transactiondate, $transactioncode);
$stmt->execute();
$stmt->close();
?>

<a rel="facebox" href="order.php"><img src="images/28.png" width="75px" height="75px" /></a>
