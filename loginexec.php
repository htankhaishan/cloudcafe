<?php
// Start session
session_start();

// Include database connection
include('connection.php');

// Validation error flag
$errmsg_arr = array();
$errflag = false;

// Sanitize input to prevent SQL injection
function clean($str) {
    $str = trim($str);
    return $bd->real_escape_string($str);
}

// Generate a random password (if necessary)
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

// Sanitize POST values
$login = clean($_POST['user']);
$password = clean($_POST['password']);

// Create query with prepared statement
$stmt = $bd->prepare("SELECT * FROM members WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $login, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login successful
    session_regenerate_id();
    $member = $result->fetch_assoc();
    $_SESSION['SESS_MEMBER_ID'] = $member['id'];
    $_SESSION['SESS_FIRST_NAME'] = $confirmation;
    session_write_close();
    header("Location: order.php");
    exit();
} else {
    // Login failed
    $errmsg_arr[] = 'Invalid Email or Password';
    $errflag = true;
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("Location: loginindex.php");
        exit();
    }
}
?>
