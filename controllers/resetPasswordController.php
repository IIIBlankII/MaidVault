<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['reset_user_email'])) {
        die("Session expired. Please initiate the password reset process again.");
    }
    
    $email = $_SESSION['reset_user_email'];
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    if (empty($password) || empty($confirm_password)) {
        die("Both password fields are required.");
    }
    
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }
    
    // Update the user's password in the database.
    $updated = User::updatePassword($email, $password);
    if ($updated) {
        unset($_SESSION['reset_user_email']);
        echo "Your password has been reset successfully. You can now <a href='../public/login.php'>log in</a>.";
    
    } else {
        echo "Error updating your password. Please try again.";
    }
}
?>
