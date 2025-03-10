<?php include '../includes/header.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>

<style>
  @keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

.animated-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 0;
  background: linear-gradient(-75deg,rgb(6, 6, 6),rgb(54, 52, 54),rgb(37, 35, 39),rgb(73, 73, 74)); /* Test colors */
  background-size: 800% 800%;
  animation: gradient 10s linear infinite; /* Faster animation for testing */
  opacity: 0.8; /* Full opacity for testing */
  display: flex;                /* Add this line */
  justify-content: center;      /* Add this line */
  align-items: center;
}
  </style>
<div class="animated-bg">
  <div class="login-container">
    <h1 class="text-xl font-semibold">MaidVault</h1>
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
        <a href="../views/forgotPassword.php">Forgot password?</a>
      </div>

      <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white px-28 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">Log In</button>
    </form>

    <div class="signup">
      No account yet? <a href="../views/signup.php">Sign up</a>
    </div>
  </div>
</div>
<?php include '../includes/footer.php'; ?>
