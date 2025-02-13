<?php
require_once '../includes/db_connect.php';

class User {
    public static function login($email, $password) {
        global $conn;
        
        $stmt = $conn->prepare("SELECT id, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $db_email, $db_password, $role);
            $stmt->fetch();

            if (password_verify($password, $db_password)) {
                return [
                    "id" => $id,
                    "email" => $db_email,
                    "role" => $role
                ];
            }
        }

        return false;
    }

    public static function register($firstName, $lastName, $email, $password) {
        global $conn;

        // Hash password before storing
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $conn->prepare("INSERT INTO users (email, password, fname, lname) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $hashedPassword, $firstName, $lastName);
        
        return $stmt->execute(); // Returns true if successful, false otherwise
    }
}
?>
