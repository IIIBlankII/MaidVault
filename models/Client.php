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

    // -------------------------------
    // Analytics Methods
    // -------------------------------

    // 1. Total number of clients
    public static function getTotalClients() {
        global $conn;
        $query = "SELECT COUNT(*) AS total_clients FROM client";
        $result = $conn->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total_clients'];
        }
        return false;
    }

    // 2. New client sign-ups per day
    public static function getSignupsPerDay() {
        global $conn;
        $query = "SELECT DATE(created_at) AS signup_date, COUNT(*) AS total_signups FROM client GROUP BY DATE(created_at) ORDER BY signup_date";
        $result = $conn->query($query);
        $data = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // 3. New client sign-ups per week
    public static function getSignupsPerWeek() {
        global $conn;
        $query = "SELECT YEARWEEK(created_at, 1) AS signup_week, COUNT(*) AS total_signups FROM client GROUP BY signup_week ORDER BY signup_week";
        $result = $conn->query($query);
        $data = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // 4. New client sign-ups per month
    public static function getSignupsPerMonth() {
        global $conn;
        $query = "SELECT DATE_FORMAT(created_at, '%Y-%m') AS signup_month, COUNT(*) AS total_signups FROM client GROUP BY signup_month ORDER BY signup_month";
        $result = $conn->query($query);
        $data = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // 5. Geographic distribution: extract city from address assuming a consistent format
    // For example, if the address is "33, Jalan Mahkota 2, Kawasan 17, 41150, Klang, Selangor"
    // and the city is the 5th comma-separated element.
    public static function getClientsByCity() {
        global $conn;
        $query = "SELECT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(address, ',', 5), ',', -1)) AS city, COUNT(*) AS total_clients FROM client GROUP BY city ORDER BY total_clients DESC";
        $result = $conn->query($query);
        $data = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

        // 6. Average Family Metrics: Average household_size, number_of_children, and number_of_elders
        public static function getAverageFamilyMetrics() {
            global $conn;
            $query = "SELECT AVG(household_size) AS avg_household_size, 
                             AVG(number_of_children) AS avg_children, 
                             AVG(number_of_elders) AS avg_elders 
                      FROM client";
            $result = $conn->query($query);
            if ($result) {
                return $result->fetch_assoc();
            }
            return false;
        }
    
        // 7. Preferred Nationality Distribution
        public static function getPreferredNationalityDistribution() {
            global $conn;
            $query = "SELECT preferred_nationality, COUNT(*) AS total 
                      FROM client 
                      GROUP BY preferred_nationality 
                      ORDER BY total DESC";
            $result = $conn->query($query);
            $data = array();
            if ($result) {
                while ($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        }
    
        // 8. Preferred Language Distribution
        public static function getPreferredLanguageDistribution() {
            global $conn;
            $query = "SELECT preferred_language, COUNT(*) AS total 
                      FROM client 
                      GROUP BY preferred_language 
                      ORDER BY total DESC";
            $result = $conn->query($query);
            $data = array();
            if ($result) {
                while ($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        }
    
        // 9. Work Type Distribution
        public static function getWorkTypeDistribution() {
            global $conn;
            $query = "SELECT work_type, COUNT(*) AS total 
                      FROM client 
                      GROUP BY work_type 
                      ORDER BY total DESC";
            $result = $conn->query($query);
            $data = array();
            if ($result) {
                while ($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        }
    
}
?>
