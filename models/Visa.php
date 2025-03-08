<?php
require_once '../includes/db_connect.php';

class Visa {
    public static function addVisaDetails($maid_id, $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date, $visa_image) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO visa_details (maid_id, visa_type, visa_number, date_of_issue, expiration_date, visa_duration, work_permit_status, passport_number, issuing_country, immigration_reference_number, entry_date, exit_date, visa_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssssssss", $maid_id, $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date, $visa_image);
        if ($stmt->execute()) {
            $newVisaId = $conn->insert_id;
            $stmt->close();
            return $newVisaId;
        } else {
            $stmt->close();
            return false;
        }
    }

    public static function updateVisa($visa_id, $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date, $visa_image) {
        global $conn;
        $stmt = $conn->prepare("UPDATE visa_details SET visa_type = ?, visa_number = ?, date_of_issue = ?, expiration_date = ?, visa_duration = ?, work_permit_status = ?, passport_number = ?, issuing_country = ?, immigration_reference_number = ?, entry_date = ?, exit_date = ?, visa_image = ? WHERE id = ?");
        $stmt->bind_param("ssssssssssssi", $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date, $visa_image, $visa_id);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}
?>
