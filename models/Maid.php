<?php
require_once dirname(__DIR__) . '/includes/db_connect.php';

class Maid {
    // Existing functions...
    
    // Add a new maid
    public static function addMaid($fname, $lname, $date_of_birth, $skills, $employment_status, $nationality, $language) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO maid (fname, lname, date_of_birth, skills, employment_status, nationality, language) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fname, $lname, $date_of_birth, $skills, $employment_status, $nationality, $language);
        if ($stmt->execute()) {
            $id = $conn->insert_id;
            $stmt->close();
            return $id;
        } else {
            $stmt->close();
            return false;
        }
    }

    // Update maid information
    public static function updateMaid($maid_id, $fname, $lname, $date_of_birth, $skills, $employment_status, $nationality, $language) {
        global $conn;
        $stmt = $conn->prepare("UPDATE maid SET fname = ?, lname = ?, date_of_birth = ?, skills = ?, employment_status = ?, nationality = ?, language = ? WHERE maid_id = ?");
        $stmt->bind_param("sssssssi", $fname, $lname, $date_of_birth, $skills, $employment_status, $nationality, $language, $maid_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Get visa id for a maid
    public static function getVisaId($maid_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT visa_details_id FROM maid WHERE maid_id = ?");
        $stmt->bind_param("i", $maid_id);
        $stmt->execute();
        $stmt->bind_result($visa_details_id);
        $stmt->fetch();
        $stmt->close();
        return $visa_details_id;
    }

    // Update visa id for a maid
    public static function updateVisaId($maid_id, $visa_id) {
        global $conn;
        $stmt = $conn->prepare("UPDATE maid SET visa_details_id = ? WHERE maid_id = ?");
        $stmt->bind_param("ii", $visa_id, $maid_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Get maid by ID (with visa details)
    public static function getMaidById($maid_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT m.maid_id, m.fname, m.lname, m.date_of_birth, m.language, m.skills, m.employment_status, m.nationality, m.created_at, m.updated_at,
                                       v.visa_type, v.visa_number, v.date_of_issue, v.expiration_date, v.visa_duration,
                                       v.work_permit_status, v.passport_number, v.issuing_country, v.immigration_reference_number,
                                       v.entry_date, v.exit_date, v.visa_image, v.passport_image, v.work_permit_image
                                FROM maid m
                                LEFT JOIN visa_details v ON m.visa_details_id = v.id
                                WHERE m.maid_id = ?");
        $stmt->bind_param("i", $maid_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $maid = $result->fetch_assoc();
        $stmt->close();
        return $maid;
    }

    // Delete maid by ID
    public static function deleteMaid($maid_id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM maid WHERE maid_id = ?");
        $stmt->bind_param("i", $maid_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // -------------------------------
    // Analytics Functions
    // -------------------------------

    // 1. Total number of maids
    public static function getTotalMaids() {
        global $conn;
        $query = "SELECT COUNT(*) AS total_maids FROM maid";
        $result = $conn->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total_maids'];
        }
        return false;
    }

    // 2. Breakdown by employment status
    public static function getMaidsByEmploymentStatus() {
        global $conn;
        $query = "SELECT employment_status, COUNT(*) AS total FROM maid GROUP BY employment_status ORDER BY total DESC";
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

    // 3. Nationality Alignment
    public static function getNationalityAlignment() {
        global $conn;
        // Get the most common preferred nationality from clients
        $query = "SELECT preferred_nationality FROM client GROUP BY preferred_nationality ORDER BY COUNT(*) DESC LIMIT 1";
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }
        $commonNationality = $result->fetch_assoc()['preferred_nationality'];
    
        // Count how many maids have that nationality
        $stmt = $conn->prepare("SELECT COUNT(*) AS matching FROM maid WHERE nationality = ?");
        $stmt->bind_param("s", $commonNationality);
        $stmt->execute();
        $stmt->bind_result($matching);
        $stmt->fetch();
        $stmt->close();
    
        // Get total number of maids
        $totalQuery = "SELECT COUNT(*) AS total FROM maid";
        $totalResult = $conn->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalMaids = $totalRow['total'];
    
        $percentage = $totalMaids > 0 ? ($matching / $totalMaids) * 100 : 0;
    
        return array(
            "common_nationality" => $commonNationality,
            "matching" => $matching,
            "total_maids" => $totalMaids,
            "percentage" => $percentage
        );
    }
    

    // 4. Age distribution (calculated from date_of_birth)
    public static function getAgeDistribution() {
        global $conn;
        $query = "SELECT TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) AS age, COUNT(*) AS total 
                  FROM maid 
                  GROUP BY age 
                  ORDER BY age";
        $result = $conn->query($query);
        $data = array();
        if ($result) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // 5. Language breakdown
    public static function getLanguageBreakdown() {
        global $conn;
        $query = "SELECT language, COUNT(*) AS total 
                  FROM maid 
                  GROUP BY language 
                  ORDER BY total DESC";
        $result = $conn->query($query);
        $data = array();
        if ($result) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // 6. Nationality breakdown
    public static function getNationalityBreakdown() {
        global $conn;
        $query = "SELECT nationality, COUNT(*) AS total 
                  FROM maid 
                  GROUP BY nationality 
                  ORDER BY total DESC";
        $result = $conn->query($query);
        $data = array();
        if ($result) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // 7. Common skills and specialties
    public static function getCommonSkills() {
        global $conn;
        $query = "SELECT skills, COUNT(*) AS total 
                  FROM maid 
                  GROUP BY skills 
                  ORDER BY total DESC";
        $result = $conn->query($query);
        $data = array();
        if ($result) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // 8. Language Alignment: Percentage of maids whose language matches the most common client preferred language.
    public static function getLanguageAlignment() {
        global $conn;
        // Get the most common preferred language from clients
        $query = "SELECT preferred_language FROM client GROUP BY preferred_language ORDER BY COUNT(*) DESC LIMIT 1";
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }
        $commonLanguage = $result->fetch_assoc()['preferred_language'];
    
        // Count how many maids have that language
        $stmt = $conn->prepare("SELECT COUNT(*) AS matching FROM maid WHERE language = ?");
        $stmt->bind_param("s", $commonLanguage);
        $stmt->execute();
        $stmt->bind_result($matching);
        $stmt->fetch();
        $stmt->close();
    
        // Get total number of maids
        $totalQuery = "SELECT COUNT(*) AS total FROM maid";
        $totalResult = $conn->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalMaids = $totalRow['total'];
    
        $percentage = $totalMaids > 0 ? ($matching / $totalMaids) * 100 : 0;
    
        return array(
            "common_language" => $commonLanguage,
            "matching" => $matching,
            "total_maids" => $totalMaids,
            "percentage" => $percentage
        );
    }
}
?>
