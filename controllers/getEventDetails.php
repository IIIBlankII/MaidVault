<?php
session_start();
require_once '../models/Event.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo json_encode([
        'status' => 'error',
        'message' => 'User not logged in'
    ]);
    exit;
}

// Get parameters from POST (make sure your JS sends these)
$event_date = $_POST['event_date'] ?? null;
$event_title = $_POST['event_title'] ?? null;

if (!$event_date || !$event_title) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing event date or title'
    ]);
    exit;
}

// Use the new function to fetch event details (title & description)
$details = Event::getEventDetails($user_id, $event_date, $event_title);
if ($details) {
    echo json_encode([
        'status' => 'success',
        'data'   => $details
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Event not found'
    ]);
}
exit;
?>
