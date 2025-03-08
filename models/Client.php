<?php
require_once dirname(__DIR__) . '/includes/db_connect.php';

class Client {
    public static function addClient($fname, $lname, $address, $contact_number, $email, $notes, $household_size, $number_of_children, $number_of_elders, $pets, $preferred_nationality, $preferred_language, $work_type, $special_requirements) {
        global $conn;
        
        $stmt = $conn->prepare("INSERT INTO client (fname, lname, address, contact_number, email, notes, household_size, number_of_children, number_of_elders, pets, preferred_nationality, preferred_language, work_type, special_requirements) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiiisssss", $fname, $lname, $address, $contact_number, $email, $notes, $household_size, $number_of_children, $number_of_elders, $pets, $preferred_nationality, $preferred_language, $work_type, $special_requirements);
        
        if ($stmt->execute()) {
            $id = $conn->insert_id;
            $stmt->close();
            return $id; // Return the newly created client_id
        } else {
            $stmt->close();
            return false;
        }
    }
    
    public static function updateClient($client_id, $fname, $lname, $address, $contact_number, $email, $notes, $household_size, $number_of_children, $number_of_elders, $pets, $preferred_nationality, $preferred_language, $work_type, $special_requirements) {
        global $conn;
        
        $stmt = $conn->prepare("UPDATE client SET fname = ?, lname = ?, address = ?, contact_number = ?, email = ?, notes = ?, household_size = ?, number_of_children = ?, number_of_elders = ?, pets = ?, preferred_nationality = ?, preferred_language = ?, work_type = ?, special_requirements = ? WHERE client_id = ?");
        $stmt->bind_param("ssssssiiisssssi", $fname, $lname, $address, $contact_number, $email, $notes, $household_size, $number_of_children, $number_of_elders, $pets, $preferred_nationality, $preferred_language, $work_type, $special_requirements, $client_id);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public static function getClientById($client_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT client_id, fname, lname, address, contact_number, email, notes, household_size, number_of_children, number_of_elders, pets, preferred_nationality, preferred_language, work_type, special_requirements, created_at, updated_at FROM client WHERE client_id = ?");
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $client = $result->fetch_assoc();
        $stmt->close();
        return $client;
    }
    
    public static function deleteClient($client_id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM client WHERE client_id = ?");
        $stmt->bind_param("i", $client_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>
