<?php
$host = 'localhost';
$dbname = 'users_schema';
$username = 'root';
$password = '';

mysqli_report(MYSQLI_REPORT_ERROR |
MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $username, 
    $password, $dbname);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log("Connection failed:" .
    $e->getMessage());
    die("Database connection failed.
    Please check the logs.");
}
?>