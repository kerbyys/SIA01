<?php
session_start();
include 'db.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login-form.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Login Successful!</h1>
    <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['fullname']); ?></strong></p>
    <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p>Username: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <p>Login Time: <?php echo date("Y-m-d H:i:s"); ?></p>

    <h3>Registered Users:</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php
        try {
            $sql = "SELECT id, username, email FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error fetching users.";
            error_log("FETCH_USERS_ERROR: " . $e->getMessage());
        }
        ?>
    </table>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>


