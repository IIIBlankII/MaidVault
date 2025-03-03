<?php
// forgotPassword.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password - MaidVault</title>
  <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
  <div class="login-container">
    <h1>Forgot Password</h1>
    <form action="../controllers/forgotPasswordController.php" method="POST">
      <div class="form-group">
        <label for="email">Enter your registered email:</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
      </div>
      <button type="submit">Send Reset Code</button>
    </form>
  </div>
</body>
</html>
