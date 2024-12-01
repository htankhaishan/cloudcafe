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
$stmt = $bd->prepare("SELECT studentnum FROM members WHERE studentnum = :student");
$stmt->bindParam(':student', $student, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    echo "Wrong student number";
    exit(0);
}

// Insert the order using a prepared statement
$stmt = $bd->prepare("INSERT INTO wings_orders (cusid, total, transactiondate, transactioncode) 
                      VALUES (:student, :total, :transactiondate, :transactioncode)");
$stmt->bindParam(':student', $student, PDO::PARAM_INT);
$stmt->bindParam(':total', $total);
$stmt->bindParam(':transactiondate', $transactiondate);
$stmt->bindParam(':transactioncode', $transactioncode);
$stmt->execute();
$stmt = null;
$bd = null;
?>

<a rel="facebox" href="order.php"><img src="images/28.png" width="75px" height="75px" /></a>
