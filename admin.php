<?php
session_start();

include("connection.php");
$id = $_POST['email'];
$password = $_POST['password'];

try {
    // Use prepared statements to prevent SQL injection
    $stmt = $bd->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $id, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;

    if ($count == 1) {
        session_regenerate_id();
        $member = $result->fetch_assoc();
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_FIRST_NAME'] = $member['username'];
        session_write_close();
        header("Location: home_admin.php");
        exit();
    } else {
        echo "<h4 style='color:red;'>Please enter your correct login details!!!</h4>";
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

$stmt->close();
$bd->close();
?>
