<?php
// mailer.php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Configures the PHPMailer instance with common server settings and sender information.
 *
 * @param PHPMailer $mail The PHPMailer instance to configure.
 */
function configureMailer(PHPMailer $mail) {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Disable debug output in production
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'vaultmaid@gmail.com';       // Your Gmail address
    $mail->Password   = 'zaqa ccsy cfcn txkp';         // Your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Enable implicit TLS encryption
    $mail->Port       = 465;
    
    // Set the sender (From address)
    $mail->setFrom('vaultmaid@gmail.com', 'MaidVault');
}

/**
 * Sends a verification email to the user.
 *
 * @param string $to The recipient's email address.
 * @param string $toName The recipient's name.
 * @param string $verificationCode The verification code to send.
 * @return bool Returns true if the email was sent successfully, false otherwise.
 */
function sendVerificationEmail($to, $toName, $verificationCode) {
    $mail = new PHPMailer(true);
    try {
        configureMailer($mail);
        $mail->addAddress($to, $toName);
        $mail->isHTML(true);
        $mail->Subject = 'Account Verification - MaidVault';
        $mail->Body    = "Thank you for registering with MaidVault. Your verification code is: <strong>$verificationCode</strong>";
        $mail->AltBody = "Your verification code is: $verificationCode";
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Optionally log $mail->ErrorInfo here
        return false;
    }
}

/**
 * Sends a password reset code email to the user.
 *
 * @param string $to The recipient's email address.
 * @param string $toName The recipient's name.
 * @param string $resetCode The reset code to send.
 * @return bool Returns true if the email was sent successfully, false otherwise.
 */
function sendResetCodeEmail($to, $toName, $resetCode) {
    $mail = new PHPMailer(true);
    try {
        configureMailer($mail);
        $mail->addAddress($to, $toName);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Code - MaidVault';
        $mail->Body    = "Your password reset code is: <strong>$resetCode</strong>";
        $mail->AltBody = "Your password reset code is: $resetCode";
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Optionally log $mail->ErrorInfo here
        return false;
    }
}
?>
