<?php
session_start();
require_once '../models/Maid.php';

// Check if maid_id is provided
if (!isset($_GET['maid_id'])) {
    echo "No maid specified.";
    exit;
}

$maid_id = intval($_GET['maid_id']);

// Optional: Only allow deletion for admin users
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "Unauthorized access.";
    exit;
}

// Attempt to delete the maid record
if (Maid::deleteMaid($maid_id)) {
    echo "Maid deleted successfully.";
} else {
    echo "Error deleting maid.";
}
?>
