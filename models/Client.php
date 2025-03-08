<?php
require_once dirname(__DIR__) . '/includes/db_connect.php';

class Client {
    public static function addClient($fname, $lname, $address, $contact_number, $email, $company_name, $notes) {
        global $conn;
        
        $stmt = $conn->prepare("INSERT INTO client (fname, lname, address, contact_number, email, company_name, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fname, $lname, $address, $contact_number, $email, $company_name, $notes);
        
        if ($stmt->execute()) {
            $id = $conn->insert_id;
            $stmt->close();
            return $id; // Return the newly created client_id
        } else {
            $stmt->close();
            return false;
        }
    }
    
    public static function updateClient($client_id, $fname, $lname, $address, $contact_number, $email, $company_name, $notes) {
        global $conn;
        
        $stmt = $conn->prepare("UPDATE client SET fname = ?, lname = ?, address = ?, contact_number = ?, email = ?, company_name = ?, notes = ? WHERE client_id = ?");
        $stmt->bind_param("sssssssi", $fname, $lname, $address, $contact_number, $email, $company_name, $notes, $client_id);
        
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
        $stmt = $conn->prepare("SELECT client_id, fname, lname, address, contact_number, email, company_name, notes, created_at, updated_at FROM client WHERE client_id = ?");
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $client = $result->fetch_assoc();
        $stmt->close();
        return $client;
    }
    
    // New delete function for Client
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
