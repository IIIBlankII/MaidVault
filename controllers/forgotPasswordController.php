<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/User.php';
require_once 'mailer.php'; // Ensure this file contains sendResetCodeEmail()

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("A valid email is required.");
    }
    
    // Retrieve user record by email
    $user = User::getUserByEmail($email);
    if (!$user) {
        echo "No account found with that email.";
        exit;
    }
    

    $resetCode = rand(100000, 999999);
    

    $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));
    

    $updated = User::setResetCode($email, $resetCode, $expires);
    if (!$updated) {
        echo "Error setting reset code.";
        exit;
    }
    
    // Send the reset code email using your mailer function.
    // This function should send an email containing the 6-digit code.
    $mailSent = sendResetCodeEmail($email, $user['fname'] . " " . $user['lname'], $resetCode);
    if ($mailSent) {
        echo "A reset code has been sent to your email address.";        
        header("Location: ../views/resetCode.php?email=" . urlencode($email));
        exit;
    } else {
        echo "Error sending reset code email.";
    }
}
?>
