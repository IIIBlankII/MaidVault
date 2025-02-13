<?php
session_start();
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Basic validation
    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Check if the user exists in the database
    $stmt = $conn->prepare("SELECT id, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $db_email, $db_password, $role);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user_email"] = $db_email;
            $_SESSION["user_role"] = $role;

            $stmt->close(); 
            header("Location: ../html/dashboard.html");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close(); 
}

$conn->close();

?>
