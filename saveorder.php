<?php
session_start();

include('connection.php');

// Fetch POST data safely
$memid = $_POST['id'] ?? null; // Use null coalescing operator to handle unset variables
$qty = $_POST['quantity'] ?? null;
$name = $_POST['name'] ?? null;
$transcode = $_POST['transcode'] ?? null;
$id = $_POST['butadd'] ?? null; // Check if the key exists before using it

// Validate that necessary parameters are set
if ($memid && $qty && $name && $transcode && $id) {
    $pprice = (int)$_REQUEST['price'];
    $pn = $_REQUEST['name'];
    $total = $pprice * $qty;

    // Use prepared statements for security
    try {
        $stmt = $db->prepare("INSERT INTO orderditems (customer, quantity, price, total, name, transactioncode) 
                               VALUES (:memid, :qty, :pprice, :total, :pn, :transcode)");
        $stmt->execute([
            ':memid' => $memid,
            ':qty' => $qty,
            ':pprice' => $pprice,
            ':total' => $total,
            ':pn' => $pn,
            ':transcode' => $transcode
        ]);

        // Redirect to the order page
        header("Location: order.php");
        exit(); // Ensure that the script stops execution after the redirect
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "All fields are required!";
}
?>
