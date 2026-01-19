<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['passwd'])) {
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];

            error_log("LOGIN_SUCCESS: User $username logged in.");

            header("Location: welcome.php");
            exit();
        } else {
            error_log("LOGIN_FAILED: Failed login attempt for username $username.");
            echo "Invalid username or password.";
        }
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        error_log("LOGIN_ERROR: " . $e->getMessage());
        echo "System error. Please try again.";
    }
}
?>


