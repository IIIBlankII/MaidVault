<?php
session_start();
if (!isset($_SESSION['reset_user_email'])) {
    // If there is no email in session, redirect to login (or forgot password) page.
    header("Location: login.php");
    exit();
}
$email = $_SESSION['reset_user_email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - MaidVault</title>
  <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
  <div class="login-container">
    <h1>Reset Your Password</h1>
    <form action="../controllers/resetPasswordController.php" method="POST">
      <!-- Optionally display the email (read-only) -->
      <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
      <div class="form-group">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter new password" required minlength="8">
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required minlength="8">
      </div>
      <button type="submit">Reset Password</button>
    </form>
  </div>
</body>
</html>
