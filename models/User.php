<?php
require_once '../includes/db_connect.php';

class User {
    public static function login($email, $password) {
        global $conn;
        
        $stmt = $conn->prepare("SELECT id, fname, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $name, $db_email, $db_password, $role);
            $stmt->fetch();
            if (password_verify($password, $db_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name; // Store the user's name in the session
                $_SESSION['user_role'] = $role;
                return [
                    "id" => $id,
                    "name" => $name, // Return the name
                    "email" => $db_email,
                    "role" => $role
                ];
            }
        }
        
        return false;
    }
    
    // Updated register method to accept a verification code.
    // Assumes your users table has columns: verification_code and is_verified (default 0).
    public static function register($firstName, $lastName, $email, $password, $verificationCode) {
        global $conn;
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $conn->prepare("INSERT INTO users (email, password, fname, lname, verification_code, is_verified) VALUES (?, ?, ?, ?, ?, 0)");
        $stmt->bind_param("sssss", $email, $hashedPassword, $firstName, $lastName, $verificationCode);
        
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    // Retrieves a user record by email, including the verification code and is_verified flag.
    public static function getUserByEmail($email) {
        global $conn;
        
        $stmt = $conn->prepare("SELECT id, email, fname, lname, verification_code, is_verified FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }
    
    // Marks the user as verified (sets is_verified to 1 and optionally clears the verification code).
    public static function verifyUser($email) {
        global $conn;
        
        $stmt = $conn->prepare("UPDATE users SET is_verified = 1, verification_code = NULL WHERE email = ?");
        $stmt->bind_param("s", $email);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public static function setResetCode($email, $resetCode, $expires) {
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET reset_code = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $resetCode, $expires, $email);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    public static function getUserByResetCode($resetCode) {
        global $conn;
        $stmt = $conn->prepare("SELECT id, email, reset_code, reset_expires FROM users WHERE reset_code = ?");
        $stmt->bind_param("s", $resetCode);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }
    
    public static function updatePassword($email, $newPassword) {
        global $conn;
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        // Update password and clear reset code and expiry
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_code = NULL, reset_expires = NULL WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    
}
?>
