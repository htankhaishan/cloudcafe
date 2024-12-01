<?php
// Start session
session_start();

// Include the database connection
include('connection.php');

$errmsg_arr = array();

// Validation error flag
$errflag = false;

// Function to sanitize values received from the form (using modern methods)
function clean($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}

// Generate a random password (kept unchanged from the original script)
function createRandomPassword() {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}
$confirmation = createRandomPassword();

// Sanitize the POST values
$login = clean($_POST['user']);
$password = clean($_POST['password']);

try {
    // Use a prepared statement to prevent SQL injection
    $qry = "SELECT * FROM members WHERE email = :email AND password = :password";
    $stmt = $bd->prepare($qry);
    $stmt->bindParam(':email', $login);
    $stmt->bindParam(':password', $password);

    // Execute the query
    $stmt->execute();

    // Check whether the query was successful
    if ($stmt->rowCount() > 0) {
        // Login Successful
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        session_regenerate_id();
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_FIRST_NAME'] = $confirmation;

        session_write_close();
        header("location: order.php");
        exit();
    } else {
        // Login failed
        $errmsg_arr[] = 'Invalid email or password';
        $errflag = true;
        if ($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            header("location: loginindex.php");
            exit();
        }
    }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
