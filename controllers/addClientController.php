<?php
require_once '../includes/db_connect.php';
require_once '../models/Client.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $company_name = $_POST['company_name'];
    $notes = $_POST['notes'];
    $household_size = $_POST['household_size'];
    $number_of_children = $_POST['number_of_children'];
    $number_of_elders = $_POST['number_of_elders'];
    $pets = $_POST['pets'];
    $preferred_nationality = $_POST['preferred_nationality'];
    $preferred_language = $_POST['preferred_language'];
    $work_type = $_POST['work_type'];
    $special_requirements = $_POST['special_requirements'];

    $client_id = Client::addClient($fname, $lname, $address, $contact_number, $email, $notes, $household_size, $number_of_children, $number_of_elders, $pets, $preferred_nationality, $preferred_language, $work_type, $special_requirements);

    if ($client_id) {
        header("Location: ../views/dashboard/main.php?msg=Client+added+successfully");
        exit();
    } else {
        echo "Error adding client.";
    }
}
?>
