<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/Client.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = intval($_POST['client_id']);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $company_name = $_POST['company_name'];
    $notes = $_POST['notes'];
    
    $clientUpdated = Client::updateClient($client_id, $fname, $lname, $address, $contact_number, $email, $company_name, $notes);
    
    if ($clientUpdated) {
        header("Location: ../views/dashboard/main.php?msg=Client+updated+successfully");
        exit();
    } else {
        echo "Error updating client.";
    }
}
?>
