<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../models/Event.php'; // Adjust the path if needed

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'User not logged in'
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Branch 1: Delete event if action is "delete"
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $event_id = $_POST['event_id'] ?? null;
        if (!$event_id) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Missing event id for deletion.'
            ]);
            exit;
        }
        
        $result = Event::deleteEvent($event_id, $user_id);
        if ($result) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Event deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Failed to delete event.'
            ]);
        }
        exit;
    }
    // Branch 2: Create event if 'title' is provided (and not a deletion request)
    else if (isset($_POST['title'])) {
        $event_date  = isset($_POST['event_date']) ? trim($_POST['event_date']) : '';
        $title       = isset($_POST['title']) ? trim($_POST['title']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $event_type  = isset($_POST['event_type']) ? trim($_POST['event_type']) : 'local';
        
        if (empty($event_date) || empty($title)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Event date and title are required.'
            ]);
            exit;
        }
        
        $result = Event::createEvent($event_date, $title, $description, $event_type, $user_id);
        if ($result) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Event added successfully.'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Failed to add event.'
            ]);
        }
        exit;
    }
    // Otherwise, return all events for the user
    else {
        $events = Event::getEvents($user_id);
        echo json_encode($events);
        exit;
    }
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Invalid request method'
    ]);
    exit;
}
?>
