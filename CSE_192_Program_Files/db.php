<?php
// Database connection settings
$host = "localhost";
$user = "root";   // XAMPP default user
$pass = "";       // XAMPP default password is empty
$db   = "career_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
