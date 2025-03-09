<?php
require_once dirname(__DIR__) . '/includes/db_connect.php';
require_once dirname(__DIR__) . '/models/Maid.php';

class Visa {
    public static function addVisaDetails(
        $maid_id,
        $visa_type,
        $visa_number,
        $date_of_issue,
        $expiration_date,
        $visa_duration,
        $work_permit_status,
        $passport_number,
        $issuing_country,
        $immigration_reference_number,
        $entry_date,
        $exit_date,
        $visa_image,
        $passport_image,        // New parameter
        $work_permit_image      // New parameter
    ) {
        global $conn;
        $stmt = $conn->prepare(
            "INSERT INTO visa_details (
                maid_id, visa_type, visa_number, date_of_issue, expiration_date, 
                visa_duration, work_permit_status, passport_number, issuing_country, 
                immigration_reference_number, entry_date, exit_date, 
                visa_image, passport_image, work_permit_image
             ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        // "i" for maid_id and then 14 "s" for the rest of the string parameters
        $stmt->bind_param(
            "issssssssssssss",
            $maid_id,
            $visa_type,
            $visa_number,
            $date_of_issue,
            $expiration_date,
            $visa_duration,
            $work_permit_status,
            $passport_number,
            $issuing_country,
            $immigration_reference_number,
            $entry_date,
            $exit_date,
            $visa_image,
            $passport_image,
            $work_permit_image
        );
        if ($stmt->execute()) {
            $newVisaId = $conn->insert_id;
            $stmt->close();
            return $newVisaId;
        } else {
            $stmt->close();
            return false;
        }
    }

    public static function updateVisa(
        $visa_id,
        $visa_type,
        $visa_number,
        $date_of_issue,
        $expiration_date,
        $visa_duration,
        $work_permit_status,
        $passport_number,
        $issuing_country,
        $immigration_reference_number,
        $entry_date,
        $exit_date,
        $visa_image,
        $passport_image,       // New parameter
        $work_permit_image     // New parameter
    ) {
        global $conn;
        $stmt = $conn->prepare(
            "UPDATE visa_details 
             SET visa_type = ?, visa_number = ?, date_of_issue = ?, expiration_date = ?, 
                 visa_duration = ?, work_permit_status = ?, passport_number = ?, issuing_country = ?, 
                 immigration_reference_number = ?, entry_date = ?, exit_date = ?, 
                 visa_image = ?, passport_image = ?, work_permit_image = ?
             WHERE id = ?"
        );
        // 14 strings followed by an integer for visa_id
        $stmt->bind_param(
            "ssssssssssssssi",
            $visa_type,
            $visa_number,
            $date_of_issue,
            $expiration_date,
            $visa_duration,
            $work_permit_status,
            $passport_number,
            $issuing_country,
            $immigration_reference_number,
            $entry_date,
            $exit_date,
            $visa_image,
            $passport_image,
            $work_permit_image,
            $visa_id
        );
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    // 1. Upcoming Visa Expiration Alerts
    public static function getUpcomingExpirations($days = 30) {
        global $conn;
        $query = "SELECT * FROM visa_details WHERE expiration_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL ? DAY) ORDER BY expiration_date ASC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $days);
        $stmt->execute();
        $result = $stmt->get_result();
        $expirations = array();
        while ($row = $result->fetch_assoc()){
            $expirations[] = $row;
        }
        $stmt->close();
        return $expirations;
    }

    // 2. Distribution of Visa Types and Work Permit Statuses
    public static function getVisaTypeDistribution() {
        global $conn;
        $query = "SELECT visa_type, work_permit_status, COUNT(*) AS total FROM visa_details GROUP BY visa_type, work_permit_status";
        $result = $conn->query($query);
        $distribution = array();
        if ($result) {
            while ($row = $result->fetch_assoc()){
                $distribution[] = $row;
            }
        }
        return $distribution;
    }

    // 3. Average Visa Duration and Other Metrics
    public static function getAverageVisaDuration() {
        global $conn;
        // Here we calculate the average duration in days between date_of_issue and expiration_date.
        $query = "SELECT AVG(DATEDIFF(expiration_date, date_of_issue)) AS avg_duration FROM visa_details";
        $result = $conn->query($query);
        if ($result) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public static function getUpcomingExpirationsWithMaidName($days = 30) {
        global $conn;
        $query = "SELECT v.*, CONCAT(m.fname, ' ', m.lname) AS maid_name
                  FROM visa_details v
                  JOIN maid m ON v.maid_id = m.maid_id
                  WHERE v.expiration_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL ? DAY)
                  ORDER BY v.expiration_date ASC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $days);
        $stmt->execute();
        $result = $stmt->get_result();
        $expirations = array();
        while ($row = $result->fetch_assoc()) {
            $expirations[] = $row;
        }
        $stmt->close();
        return $expirations;
    }
    
}
?>
