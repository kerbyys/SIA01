<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            header("Location: registration-form.php?error=exists");
            exit();
        } else {
            $stmt->close();
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, username, passwd) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fullname, $email, $username, $hashed_password);
            
            if ($stmt->execute()) {
                error_log("REGISTRATION_SUCCESS: User $username registered successfully.");

                header("Location: login-form.php?success=registered");
                exit();
            } else {
                header("Location: registration-form.php?error=failed");
                exit();
            }
        }
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        error_log("REGISTRATION_ERROR: " . $e->getMessage());
        header("Location: registration-form.php?error=system");
        exit();
    }
}
?>


