<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/Event.php'; // Adjust the path if needed

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $event_date  = isset($_POST['event_date']) ? trim($_POST['event_date']) : '';
    $title       = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $event_type  = isset($_POST['event_type']) ? trim($_POST['event_type']) : 'local';
    $user_id     = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;
    
    // Optional: Validate required fields
    if (empty($event_date) || empty($title)) {
        header('Content-Type: application/json');
        echo json_encode([
            'status'  => 'error',
            'message' => 'Event date and title are required.'
        ]);
        exit;
    }
    
    // Create the event using the Event model
    $result = Event::createEvent($event_date, $title, $description, $event_type, $user_id);
    
    // Return JSON response
    header('Content-Type: application/json');
    if ($result) {
        echo json_encode([
            'status'  => 'success',
            'message' => 'Event added successfully'
        ]);
    } else {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Failed to add event'
        ]);
    }
    exit;
} else {
    // If not a POST request, return an error message
    header('Content-Type: application/json');
    echo json_encode([
        'status'  => 'error',
        'message' => 'Invalid request method'
    ]);
    exit;
}
