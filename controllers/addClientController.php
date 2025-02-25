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

    $client_id = Client::addClient($fname, $lname, $address, $contact_number, $email, $company_name, $notes);

    if ($client_id) {
        header("Location: ../views/dashboard/main.php?msg=Client+added+successfully");
        exit();
    } else {
        echo "Error adding client.";
    }
}
?>
