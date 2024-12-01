<?php
if (isset($_GET['id'])) {
    include('connection.php');

    $id = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $bd->prepare("DELETE FROM orderditems WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" means integer
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        header("Location: order.php");
        exit();
    } else {
        echo "Error: Could not delete order.";
    }

    $stmt->close();
}
?>
