<?php include '../includes/header.php'; ?>
  <div class="login-container">
    <h1>MaidVault</h1>
    <p>Please log in to continue</p>

    <form action="../controllers/loginController.php" method="POST">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Email Address" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <small class="password-requirement">
          It must be a combination of a minimum of 8 letters, numbers, and symbols.
        </small>
      </div>

      <div class="options">
        <label>
          <input type="checkbox" name="remember"> Remember me
        </label>
        <a href="forgot-password.php">Forgot password?</a>
      </div>

      <button type="submit">Log In</button>
    </form>

    <div class="signup">
      No account yet? <a href="../views/signup.php">Sign up</a>
    </div>
  </div>
<?php include '../includes/footer.php'; ?>
