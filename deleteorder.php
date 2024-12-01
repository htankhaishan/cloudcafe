<?php
if (isset($_GET['id'])) {
    include('connection.php');
    $id = $_GET['id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $bd->prepare("DELETE FROM orderditems WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect to order page after deletion
    header("Location: order.php");
    exit();
}
?>
