<?php
require_once '../includes/db_connect.php';
require_once '../models/Maid.php';
require_once '../models/Visa.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $date_of_birth = $_POST['date_of_birth'];
    $skills = $_POST['skills'];
    $employment_status = $_POST['employment_status'];

    
    $maid_id = Maid::addMaid($fname, $lname, $date_of_birth, $skills, $employment_status);

    if ($maid_id) {
        
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

        
        $visaAdded = Visa::addVisaDetails($maid_id, $visa_type, $visa_number, $date_of_issue, $expiration_date, $visa_duration, $work_permit_status, $passport_number, $issuing_country, $immigration_reference_number, $entry_date, $exit_date);

        if ($visaAdded) {
            
            $visa_id = $conn->insert_id;

            
            $stmt = $conn->prepare("UPDATE maid SET visa_details_id = ? WHERE maid_id = ?");
            $stmt->bind_param("ii", $visa_id, $maid_id);
            $stmt->execute();
            $stmt->close();

            header("Location: ../views/dashboard/main.php?msg=Maid+and+Visa+details+added+successfully");
            exit();
        } else {
            echo "Error adding visa details.";
        }
    } else {
        echo "Error adding maid.";
    }
}
?>
