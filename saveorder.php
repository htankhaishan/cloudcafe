<?php
session_start();
include('connection.php');

$memid = $_POST['id'];
$qty = $_POST['quantity'];
$name = $_POST['name'];
$transcode = $_POST['transcode'];
$id = $_POST['butadd'];  // This will now be set correctly from the form submission

$pprice = (int)$_REQUEST['price'];
$pn = $_REQUEST['name'];
$total = $pprice * $qty;

$sql = "INSERT INTO orderditems (customer, quantity, price, total, name, transactioncode) 
        VALUES('$memid', '$qty', '$pprice', '$total', '$pn', '$transcode')";

if (mysqli_query($bd, $sql)) {
    header("Location: order.php");
    exit();
} else {
    echo "Error: " . mysqli_error($bd);
}
?>
