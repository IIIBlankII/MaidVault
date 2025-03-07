<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <script src="../public/js/validation.js"></script>
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

</head>
<body>
    <div class="animated-bg">
    <div class="login-container ">
        <h1>Sign Up</h1>

        <div style="height: 30px;"></div> <!-- Adjust height as needed -->

        <form action="../controllers/signupController.php" method="post" onsubmit="return validateForm()">
            <div class="name-fields">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" placeholder="First Name" required pattern="[A-Za-z]+" title="Only letters allowed">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Last Name" required pattern="[A-Za-z]+" title="Only letters allowed">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required pattern="^[^\s@]+@[^\s@]+\.com$" title="Email must be in a valid format and end with .com">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required minlength="8"
                       pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                       title="Must contain at least 8 characters, including one letter, one number, and one special character">
                <span class="password-requirement">It must be at least 8 characters long and include at least one letter, one number, and one special character.</span>
            </div>

            <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white px-28 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">Sign Up</button>
        </form>

        <div class="separator"></div>

        <p class="signup"><a href="../public/login.php">Already have an account?</a></p>
    </div>
    </div>    
</body>
</html>
