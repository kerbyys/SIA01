<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Login</h2>
    
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 'registered') {
        echo "<p class='success'>Registration successful! Please login.</p>";
    }
    ?>

    <form action="login.php" method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="registration-form.php">Register here</a></p>
</body>
</html>


