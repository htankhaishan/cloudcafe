<?php
// Start session
session_start();

// Connect to MySQL server
include('connection.php');

// Validation error flag
$errmsg_arr = array();
$errflag = false;

// Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
    $str = @trim($str);
    // Removed get_magic_quotes_gpc check (no longer necessary)
    $str = mysqli_real_escape_string($GLOBALS['bd'], $str);
    return $str;
}

// Function to create a random password
function createRandomPassword() {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime() * 1000000);
    $pass = '';
    for ($i = 0; $i <= 7; $i++) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
    }
    return $pass;
}

$confirmation = createRandomPassword();

// Sanitize the POST values
$login = clean($_POST['user']);
$password = clean($_POST['password']);

// Create query
$qry = "SELECT * FROM members WHERE email='$login' AND password='$password'";
$result = mysqli_query($GLOBALS['bd'], $qry);

// Check whether the query was successful or not
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Login successful
        session_regenerate_id();
        $member = mysqli_fetch_assoc($result);
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_FIRST_NAME'] = $confirmation;  // Assuming you want to use the random password for first name (or it could be a real member name)
        
        session_write_close();
        header("Location: order.php");
        exit();
    } else {
        // Login failed
        $errmsg_arr[] = 'Invalid Email or password';
        $errflag = true;
        if ($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            header("Location: loginindex.php");
            exit();
        }
    }
} else {
    die("Query failed: " . mysqli_error($GLOBALS['bd']));
}
?>
