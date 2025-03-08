<?php
require_once dirname(__DIR__) . '/includes/db_connect.php';

class Maid {
    // Now accepts nationality and language as additional parameters
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

    // Updated to include nationality and language in the update
    public static function updateMaid($maid_id, $fname, $lname, $date_of_birth, $skills, $employment_status, $nationality, $language) {
        global $conn;
        $stmt = $conn->prepare("UPDATE maid SET fname = ?, lname = ?, date_of_birth = ?, skills = ?, employment_status = ?, nationality = ?, language = ? WHERE maid_id = ?");
        $stmt->bind_param("sssssssi", $fname, $lname, $date_of_birth, $skills, $employment_status, $nationality, $language, $maid_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

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

    public static function updateVisaId($maid_id, $visa_id) {
        global $conn;
        $stmt = $conn->prepare("UPDATE maid SET visa_details_id = ? WHERE maid_id = ?");
        $stmt->bind_param("ii", $visa_id, $maid_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Updated SELECT query to include nationality, language, passport_image, and work_permit_image
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

    // New delete function to remove a maid record by ID
    public static function deleteMaid($maid_id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM maid WHERE maid_id = ?");
        $stmt->bind_param("i", $maid_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>
