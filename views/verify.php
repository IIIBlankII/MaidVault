<?php
// Capture the email from the URL parameter
$email = isset($_GET['email']) ? $_GET['email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify Your Account</title>
  <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
  <div class="login-container">
    <h1>Verify Your Account</h1>
    <form action="../controllers/verifyController.php" method="POST">
      <!-- Hidden email field so that it's passed along -->
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
      
      <!-- Display the email (optional, read-only) -->
      <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
      
      <div class="form-group">
        <label for="code">Verification Code:</label>
        <input type="text" id="code" name="code" required>
      </div>
      <button type="submit">Verify Account</button>
    </form>
  </div>
</body>
</html>
