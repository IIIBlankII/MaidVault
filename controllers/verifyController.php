<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $code  = trim($_POST['code']);

    if (empty($email) || empty($code)) {
        echo "Both email and verification code are required.";
        exit;
    }

    // Retrieve the user record by email
    $user = User::getUserByEmail($email);
    
    if (!$user) {
        echo "No account found with that email.";
        exit;
    }

    // Compare the provided code with the stored verification code
    if ($user['verification_code'] == $code) {
        // Mark the user as verified
        $updated = User::verifyUser($email);
        if ($updated) {
            echo "Your account has been verified. You can now <a href='../public/login.php'>log in</a>.";
        } else {
            echo "Verification failed. Please try again later.";
        }
    } else {
        echo "Incorrect verification code.";
    }
}
?>
