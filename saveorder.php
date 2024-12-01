<?php
session_start();

include('connection.php'); // Including the PDO connection

// Get values from POST request
$memid = $_POST['id'];
$qty = $_POST['quantity'];
$name = $_POST['name'];
$transcode = $_POST['transcode'];
$id = $_POST['butadd']; // Get the 'butadd' value from the form

$pprice = (int)$_REQUEST['price'];
$pn = $_REQUEST['name'];
$total = $pprice * $qty;

// Prepare the insert query using PDO
$stmt = $bd->prepare("INSERT INTO orderditems (customer, quantity, price, total, name, transactioncode) VALUES (:memid, :qty, :pprice, :total, :pn, :transcode)");

// Bind parameters to the query
$stmt->bindParam(':memid', $memid, PDO::PARAM_INT);
$stmt->bindParam(':qty', $qty, PDO::PARAM_INT);
$stmt->bindParam(':pprice', $pprice, PDO::PARAM_INT);
$stmt->bindParam(':total', $total, PDO::PARAM_INT);
$stmt->bindParam(':pn', $pn, PDO::PARAM_STR);
$stmt->bindParam(':transcode', $transcode, PDO::PARAM_STR);

// Execute the query
$stmt->execute();

// Redirect to the order page
header("location: order.php");
exit(); // Always call exit after header redirect
?>
