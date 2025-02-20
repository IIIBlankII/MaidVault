<?php
require_once dirname(__DIR__) . '/includes/db_connect.php';

class Maid {

    // Method to add a new maid
    public static function addMaid($firstName, $lastName, $dob, $nationality, $skills, $status) {
        global $conn;

        
        $stmt = $conn->prepare("INSERT INTO maid (fname, lname, date_of_birth, skills, employment_status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $dob, $skills, $status);

    
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }

        
        $stmt->close();
    }

}
?>
