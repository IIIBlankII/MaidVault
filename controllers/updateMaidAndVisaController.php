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

    // Update maid details using the Maid model
    $maidUpdated = Maid::updateMaid($maid_id, $fname, $lname, $date_of_birth, $skills, $employment_status);
    if (!$maidUpdated) {
        echo "Error updating maid.";
        exit;
    }

    // Check if a visa record already exists for this maid
    $currentVisaId = Maid::getVisaId($maid_id);
    if ($currentVisaId) {
        // Update existing visa record using the Visa model
        $visaUpdated = Visa::updateVisa($currentVisaId, $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date);
        if (!$visaUpdated) {
            echo "Error updating visa details.";
            exit;
        }
    } else {
        // Insert a new visa record and update the maid with its ID
        $newVisaId = Visa::addVisaDetails($maid_id, $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date);
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
