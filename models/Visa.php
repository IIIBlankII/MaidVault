<?php
require_once '../includes/db_connect.php';

class Visa {
    public static function addVisaDetails($maid_id, $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO visa_details (maid_id, visa_type, visa_number, date_of_issue, expiration_date, visa_duration, work_permit_status, passport_number, issuing_country, immigration_reference_number, entry_date, exit_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssssss", $maid_id, $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date);
        
        return $stmt->execute();
    }
}
?>
