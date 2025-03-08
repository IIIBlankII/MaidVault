<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/Maid.php';
require_once '../models/Visa.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $date_of_birth = $_POST['date_of_birth'];
    $skills = $_POST['skills'];
    $employment_status = $_POST['employment_status'];
    $nationality = $_POST['nationality']; // Field for nationality
    $language = $_POST['language']; // New field for language

    // Add maid details to the database with nationality and language
    $maid_id = Maid::addMaid($fname, $lname, $date_of_birth, $skills, $employment_status, $nationality, $language);

    if ($maid_id) {
        // Visa details
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
        $visa_image_path = null; // Default value (no image uploaded)
        if (isset($_FILES['visa_image']) && $_FILES['visa_image']['error'] == 0) {
            $target_dir = "../uploads/visa_images/"; // Folder for visa images
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = time() . "_" . basename($_FILES["visa_image"]["name"]);
            $target_file = $target_dir . $file_name;
            if (move_uploaded_file($_FILES["visa_image"]["tmp_name"], $target_file)) {
                $visa_image_path = "uploads/visa_images/" . $file_name;
            }
        }
        
        // Handle Passport Image Upload
        $passport_image_path = null;
        if (isset($_FILES['passport_image']) && $_FILES['passport_image']['error'] == 0) {
            $target_dir = "../uploads/passport_images/"; // Folder for passport images
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = time() . "_" . basename($_FILES["passport_image"]["name"]);
            $target_file = $target_dir . $file_name;
            if (move_uploaded_file($_FILES["passport_image"]["tmp_name"], $target_file)) {
                $passport_image_path = "uploads/passport_images/" . $file_name;
            }
        }
        
        // Handle Work Permit Image Upload
        $work_permit_image_path = null;
        if (isset($_FILES['work_permit_image']) && $_FILES['work_permit_image']['error'] == 0) {
            $target_dir = "../uploads/work_permit_images/"; // Folder for work permit images
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = time() . "_" . basename($_FILES["work_permit_image"]["name"]);
            $target_file = $target_dir . $file_name;
            if (move_uploaded_file($_FILES["work_permit_image"]["tmp_name"], $target_file)) {
                $work_permit_image_path = "uploads/work_permit_images/" . $file_name;
            }
        }

        // Add visa details with image paths (including passport and work permit images)
        $visaAdded = Visa::addVisaDetails(
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
            $passport_image_path,      // New parameter
            $work_permit_image_path    // New parameter
        );

        if ($visaAdded) {
            $visa_id = $conn->insert_id;

            // Link visa details to the maid
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
