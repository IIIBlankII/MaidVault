<?php
// forgotPassword.php
?>
<!DOCTYPE html>
<script src="https://cdn.tailwindcss.com"></script>

<html lang="en">
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
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      background: linear-gradient(-75deg, rgb(6, 6, 6), rgb(54, 52, 54), rgb(37, 35, 39), rgb(73, 73, 74));
      background-size: 800% 800%;
      animation: gradient 7s linear infinite;
      opacity: 0.8;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    /* Ensure the login container appears above the background */
    .login-container {
      position: relative;
      z-index: 1;
    }
</style>

<head>
  <meta charset="UTF-8">
  <title>Forgot Password - MaidVault</title>
  <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
  <div class="animated-bg">
  <div class="login-container">
    <h1 class="text-lg font-semibold mb-5">Forgot Password</h1>
    <form action="../controllers/forgotPasswordController.php" method="POST">
      <div class="form-group">
        <label for="email">Enter your registered email:</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
      </div>
      <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white mt-5 px-5 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">Send Reset Code</button>
    </form>
  </div>
  </div>
</body>
</html>
