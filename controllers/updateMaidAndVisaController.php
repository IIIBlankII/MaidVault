<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/Maid.php';
require_once '../models/Visa.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve maid fields from POST data
    $maid_id = intval($_POST['maid_id']);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $date_of_birth = $_POST['date_of_birth'];
    $skills = $_POST['skills'];
    $employment_status = $_POST['employment_status'];
    $nationality = $_POST['nationality']; // New field for nationality

    // Retrieve visa fields from POST data
    $visa_type = $_POST['visa_type'];
    $visa_number = $_POST['visa_number'];
    $date_of_issue = $_POST['date_of_issue'];
    $expiration_date = $_POST['expiration_date'];
    $visa_duration = $_POST['visa_duration'];
    $work_permit_status = $_POST['work_permit_status'];
    $passport_number = $_POST['passport_number'];
    $issuing_country = $_POST['issuing_country'];
    $immigration_reference_number = $_POST['immigration_reference_number'];
    $entry_date = $_POST['entry_date'];
    $exit_date = $_POST['exit_date'];

    if (isset($_FILES['visa_image']) && $_FILES['visa_image']['error'] == 0) {
        $target_dir = "../uploads/visa_images/";
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
        $file_name = time() . "_" . basename($_FILES["visa_image"]["name"]);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["visa_image"]["tmp_name"], $target_file)) {
            $visa_image_path = "uploads/visa_images/" . $file_name;
        }
    } else {
        // No new file, use existing value
        $visa_image_path = $_POST['existing_visa_image'];
    }
    
    // Handle Passport Image Upload
    if (isset($_FILES['passport_image']) && $_FILES['passport_image']['error'] == 0) {
        $target_dir = "../uploads/passport_images/";
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
        $file_name = time() . "_" . basename($_FILES["passport_image"]["name"]);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["passport_image"]["tmp_name"], $target_file)) {
            $passport_image_path = "uploads/passport_images/" . $file_name;
        }
    } else {
        $passport_image_path = $_POST['existing_passport_image'];
    }
    
    // Handle Work Permit Image Upload
    if (isset($_FILES['work_permit_image']) && $_FILES['work_permit_image']['error'] == 0) {
        $target_dir = "../uploads/work_permit_images/";
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
        $file_name = time() . "_" . basename($_FILES["work_permit_image"]["name"]);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["work_permit_image"]["tmp_name"], $target_file)) {
            $work_permit_image_path = "uploads/work_permit_images/" . $file_name;
        }
    } else {
        $work_permit_image_path = $_POST['existing_work_permit_image'];
    }

    // Update maid details using the Maid model (including nationality)
    $maidUpdated = Maid::updateMaid($maid_id, $fname, $lname, $date_of_birth, $skills, $employment_status, $nationality);
    if (!$maidUpdated) {
        echo "Error updating maid.";
        exit;
    }

    // Check if a visa record already exists for this maid
    $currentVisaId = Maid::getVisaId($maid_id);
    if ($currentVisaId) {
        // Update existing visa record using the Visa model (including new image fields)
        $visaUpdated = Visa::updateVisa(
            $currentVisaId,
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
            $visa_image_path,
            $passport_image_path,
            $work_permit_image_path
        );
        if (!$visaUpdated) {
            echo "Error updating visa details.";
            exit;
        }
    } else {
        // Insert a new visa record and update the maid with its ID (including new image fields)
        $newVisaId = Visa::addVisaDetails(
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
            $visa_image_path,
            $passport_image_path,
            $work_permit_image_path
        );
        if (!$newVisaId) {
            echo "Error adding visa details.";
            exit;
        }
        $updatedVisaId = Maid::updateVisaId($maid_id, $newVisaId);
        if (!$updatedVisaId) {
            echo "Error updating maid with new visa details.";
            exit;
        }
    }

    header("Location: ../views/dashboard/main.php?msg=Maid+updated+successfully");
    exit();
}
?>
