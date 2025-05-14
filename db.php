<?php
$host = "sql106.byetcluster.com";
$username = "if0_38834353"; 
$password = "Tesla3691801";
$dbname = "if0_38834353_Php_Project1";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
