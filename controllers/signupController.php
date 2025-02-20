<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once '../models/User.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["first-name"]);
    $lastName = trim($_POST["last-name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long.");
    }

    
    $userCreated = User::register($firstName, $lastName, $email, $password);

    if ($userCreated) {
        
        header("Location: ../public/login.php");
        exit();
    } else {
        echo "Error: Unable to register user.";
    }
}
?>
