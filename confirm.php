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

// Using mysqli to query the database
$result = $bd->query("SELECT * FROM members");

while($info = $result->fetch_assoc()) {
    $stud = $info['studentnum'];
}

if($student != $stud){
    echo "wrong student Num";
    exit(0);
}

// Inserting data using mysqli
$query = "INSERT INTO wings_orders (cusid, total, transactiondate, transactioncode) VALUES ('$stud', '$total', '$transactiondate', '$transactioncode')";
$bd->query($query);

// Redirecting or confirming the transaction
echo '<a rel="facebox" href="order.php"><img src="images/28.png" width="75px" height="75px" /></a>';
?>
