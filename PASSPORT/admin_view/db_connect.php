<?php
$servername = "localhost";
$username = "root";
$password = "root";  // Replace 'your_password' with the actual password
$dbname = "passport_application_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
