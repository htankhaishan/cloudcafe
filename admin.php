<?php
session_start();

include("connection.php"); // Ensure $pdo is defined as the PDO connection

// Check if email and password are set in the POST request
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Fetch input safely using prepared statements
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if exactly one user exists with the provided credentials
        if ($user) {
            session_regenerate_id(); // Regenerate session ID to prevent session fixation attacks
            $_SESSION['SESS_MEMBER_ID'] = $user['id'];
            $_SESSION['SESS_FIRST_NAME'] = $user['username'];
            session_write_close();
            header("location:home_admin.php"); // Redirect to admin page
            exit();
        } else {
            echo "<h4 style='color:red;'>Please enter your correct login details!!!</h4>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage()); // Handle any database connection or query issues
    }
} else {
    echo "<h4 style='color:red;'>Please fill in both email and password.</h4>";
}
?>
