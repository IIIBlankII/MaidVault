<?php
session_start();
require_once dirname(__DIR__) . '/models/Client.php';

// Check if client_id is provided
if (!isset($_GET['client_id'])) {
    echo "No client specified.";
    exit;
}

$client_id = intval($_GET['client_id']);

// Optional: Only allow deletion for admin users
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "Unauthorized access.";
    exit;
}

// Attempt to delete the client record
if (Client::deleteClient($client_id)) {
    echo "Client deleted successfully.";

} else {
    echo "Error deleting client.";
}
?>
