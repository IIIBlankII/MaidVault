<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resetCode = trim($_POST['reset_code']);
    
    if (empty($resetCode)) {
        die("Reset code is required.");
    }
    
    // Retrieve user by reset code using the User model
    $user = User::getUserByResetCode($resetCode);
    
    if (!$user) {
        echo "Invalid reset code.";
        exit;
    }
    
    // Check if the reset code has expired
    $expires = strtotime($user['reset_expires']);
    if (time() > $expires) {
        echo "Your reset code has expired. Please request a new reset code.";
        exit;
    }
    
    // Reset code is valid, store the user's email in the session
    $_SESSION['reset_user_email'] = $user['email'];
    
    // Redirect to the password reset page so the user can set a new password
    header("Location: ../views/resetPassword.php");
    exit();
}
?>
