<?php
session_start();

include("connection.php"); // Ensure $db is defined as the PDO connection

// Check if the email and password are set in the POST request
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if exactly one user exists with the provided credentials
        if ($user) {
            session_regenerate_id();
            $_SESSION['SESS_MEMBER_ID'] = $user['id'];
            $_SESSION['SESS_FIRST_NAME'] = $user['username'];
            session_write_close();
            header("location:home_admin.php"); // Redirect to admin page
            exit();
        } else {
            echo "<h4 style='color:red;'>Incorrect email or password. Please try again.</h4>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "<h4 style='color:red;'>Please fill in both email and password.</h4>";
}
?>
