<?php
if (isset($_GET['id'])) {
    include('connection.php');
    $id = $_GET['id'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $bd->prepare("DELETE FROM orderditems WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirect to order page after deletion
    header("Location: order.php");
    exit();
}
?>
