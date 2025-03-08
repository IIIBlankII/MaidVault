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

    // Handle Visa Image Upload
    $visa_image_path = null;
    if (isset($_FILES['visa_image']) && $_FILES['visa_image']['error'] == 0) {
        $target_dir = "../uploads/visa_images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name = time() . "_" . basename($_FILES["visa_image"]["name"]);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["visa_image"]["tmp_name"], $target_file)) {
            $visa_image_path = "uploads/visa_images/" . $file_name; // Save relative path
        }
    }

    // Update maid details using the Maid model
    $maidUpdated = Maid::updateMaid($maid_id, $fname, $lname, $date_of_birth, $skills, $employment_status);
    if (!$maidUpdated) {
        echo "Error updating maid.";
        exit;
    }

    // Check if a visa record already exists for this maid
    $currentVisaId = Maid::getVisaId($maid_id);
    if ($currentVisaId) {
        // Update existing visa record using the Visa model (including visa_image)
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
            $visa_image_path
        );
        if (!$visaUpdated) {
            echo "Error updating visa details.";
            exit;
        }
    } else {
        // Insert a new visa record and update the maid with its ID (including visa_image)
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
            $visa_image_path
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
