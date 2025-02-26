<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../models/User.php';
require_once 'mailer.php'; // This file contains the sendVerificationEmail() function

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["first-name"]);
    $lastName  = trim($_POST["last-name"]);
    $email     = trim($_POST["email"]);
    $password  = trim($_POST["password"]);

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long.");
    }

    // Generate a random 6-digit verification code
    $verificationCode = rand(100000, 999999);

    // Register the user (ensure your User::register method is updated to accept $verificationCode)
    $userCreated = User::register($firstName, $lastName, $email, $password, $verificationCode);

    if ($userCreated) {
        // Send verification email
        $emailSent = sendVerificationEmail($email, $firstName . " " . $lastName, $verificationCode);
        if ($emailSent) {
            header("Location: ../views/verify.php?email=" . urlencode($email));
            exit();
        } else {
            echo "Error: Verification email could not be sent.";
        }
    } else {
        echo "Error: Unable to register user.";
    }
}
?>
