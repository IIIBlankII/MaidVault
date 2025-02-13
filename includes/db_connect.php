<?php
$servername = "localhost"; // Change if hosted elsewhere
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "maidvault"; // Change to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
