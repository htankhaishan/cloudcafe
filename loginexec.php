<?php
// Start session
session_start();

// Include database connection
include('connection.php');

// Validation error flag
$errmsg_arr = array();
$errflag = false;

// Sanitize input to prevent SQL injection (PDO uses prepared statements)
function clean($str) {
    return trim($str); // Simple sanitization for now, PDO will take care of escaping
}

// Sanitize POST values
$login = clean($_POST['user']);
$password = clean($_POST['password']);

// Generate a random confirmation string (not the password)
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

// Create query with prepared statement
try {
    // Using PDO for parameterized queries to prevent SQL injection
    $stmt = $bd->prepare("SELECT * FROM members WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $login);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        // Login successful
        session_regenerate_id();
        
        // Store user data in session
        $_SESSION['SESS_MEMBER_ID'] = $result['id'];
        $_SESSION['SESS_FIRST_NAME'] = $result['name']; // Assuming 'name' is stored in the database
        session_write_close();
        
        // Redirect to order page
        header("Location: order.php");
        exit();
    } else {
        // Login failed, invalid credentials
        $errmsg_arr[] = 'Invalid Email or Password';
        $errflag = true;
        if ($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            header("Location: loginindex.php");
            exit();
        }
    }

} catch (PDOException $e) {
    // Catch any errors and display them
    die("Error: " . $e->getMessage());
}
?>
