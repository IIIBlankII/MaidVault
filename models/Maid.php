<?php
require_once '../includes/db_connect.php';

class Maid {
    public static function addMaid($fname, $lname, $date_of_birth, $skills, $employment_status) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO maid (fname, lname, date_of_birth, skills, employment_status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fname, $lname, $date_of_birth, $skills, $employment_status);

        if ($stmt->execute()) {
            return $conn->insert_id; // Return the newly created maid_id
        } else {
            return false;
        }
    }
}
?>
