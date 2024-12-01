<?php
session_start();
include('connection.php');

// Collect form data
$memid = $_POST['id'];
$qty = $_POST['quantity'];
$name = $_POST['name'];
$transcode = $_POST['transcode'];
$id = $_POST['butadd'];
$pprice = (int)$_REQUEST['price'];
$pn = $_REQUEST['name'];
$total = $pprice * $qty;

try {
    // Use prepared statement to prevent SQL injection
    $stmt = $bd->prepare("INSERT INTO orderditems (customer, quantity, price, total, name, transactioncode) 
                          VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisss", $memid, $qty, $pprice, $total, $pn, $transcode);
    $stmt->execute();
    $stmt->close();

    // Redirect after successful order insertion
    header("Location: order.php");
    exit();
} catch (Exception $e) {
    // Handle error
    die("Error: Could not process your order. " . $e->getMessage());
}
?>
