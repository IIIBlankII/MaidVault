<?php
session_start();
require_once '../models/Event.php';

// Get the current user's ID (assumes it's stored in the session)
$user_id = $_SESSION['user_id'] ?? null;

header('Content-Type: application/json');

if ($user_id) {
    $events = Event::getEvents($user_id);
    echo json_encode($events);
} else {
    echo json_encode([]);
}
?>
