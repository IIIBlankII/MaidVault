<?php
// mailer.php
    require_once __DIR__ . '/../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader (you can also require autoload.php from your autoload file if it's in a common location)
require_once __DIR__ . '/mailer.php';


/**
 * Sends a verification email to the user.
 *
 * @param string $to The recipient's email address.
 * @param string $toName The recipient's name.
 * @param string $verificationCode The verification code to send.
 * @return bool Returns true if the email was sent, false otherwise.
 */
function sendVerificationEmail($to, $toName, $verificationCode) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Disable debug output in production
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Use your SMTP server (Gmail example)
        $mail->SMTPAuth   = true;
        $mail->Username   = 'vaultmaid@gmail.com';       // Your Gmail address
        $mail->Password   = 'zaqa ccsy cfcn txkp';     // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Enable implicit TLS encryption
        $mail->Port       = 465;
        
        // Recipients
        $mail->setFrom('vaultmaid@gmail.com', 'MaidVault');
        $mail->addAddress($to, $toName);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Account Verification - MaidVault';
        $mail->Body    = "Thank you for registering with MaidVault. Your verification code is: <strong>$verificationCode</strong>";
        $mail->AltBody = "Your verification code is: $verificationCode";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        // In production, log $mail->ErrorInfo instead of echoing it
        return false;
    }
}
?>
