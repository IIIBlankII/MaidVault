<?php
// resetCode.php
// Retrieve the email from the URL parameter (if provided)
$email = isset($_GET['email']) ? $_GET['email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Code Verification - MaidVault</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Reset Your Password</h1>
        <p>Please enter the 6-digit reset code sent to your email. Once verified, you will be able to reset your password.</p>
        <form action="../controllers/resetCodeController.php" method="POST">
            <!-- Hidden field to pass the email -->
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            
            <div class="form-group">
                <label for="reset_code">Reset Code:</label>
                <input type="text" id="reset_code" name="reset_code" placeholder="Enter your reset code" required>
            </div>
            <button type="submit">Verify Code</button>
        </form>
    </div>
</body>
</html>
