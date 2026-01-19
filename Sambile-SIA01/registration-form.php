<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>Register</h2>

    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'exists') {
            echo "<p class='error'>Username or Email already exists!</p>";
        } elseif ($_GET['error'] == 'failed') {
            echo "<p class='error'>Registration failed. Please try again.</p>";
        } elseif ($_GET['error'] == 'system') {
            echo "<p class='error'>System error. Please contact admin.</p>";
        }
    }
    ?>

    <form action="register.php" method="POST">
        <label>Full Name:</label><br>
        <input type="text" name="fullname" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Register</button>
    </form>
    
    <p>Already have an account? <a href="login-form.php">Login here</a></p>
</body>
</html>

