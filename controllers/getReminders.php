<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../models/Visa.php';
require_once __DIR__ . '/../models/Event.php';

// Get the filter from the GET parameter; default is "week"
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'week';

// Set the number of days based on the filter
switch ($filter) {
    case 'month':
        $days = 30;
        break;
    case 'year':
        $days = 365;
        break;
    case 'week':
    default:
        $days = 7;
        break;
}

$reminders = [];

// ---------------------------
// Visa Expiration Reminders
// ---------------------------
$visaReminders = Visa::getUpcomingExpirationsWithMaidName($days);

if ($visaReminders && is_array($visaReminders)) {
    foreach ($visaReminders as $visa) {
        // Format the expiration date nicely
        $formattedDate = date("d M Y", strtotime($visa['expiration_date']));
        // Use the maid's name instead of visa number.
        $reminders[] = [
            'type' => 'Visa Expiration',
            'date' => $visa['expiration_date'],
            'text' => "Visa ({$visa['maid_name']}) expires on {$formattedDate}"
        ];
    }
}

// ---------------------------
// Upcoming Event Reminders
// ---------------------------
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$allEvents = Event::getEvents($user_id);

// Define today's date and the end date of the range
$today   = date("Y-m-d");
$endDate = date("Y-m-d", strtotime("+$days days"));

// Filter events within the desired date range
if (!empty($allEvents)) {
    foreach ($allEvents as $eventDate => $eventList) {
        if ($eventDate >= $today && $eventDate <= $endDate) {
            foreach ($eventList as $event) {
                $formattedEventDate = date("d M Y", strtotime($eventDate));
                $reminders[] = [
                    'type' => 'Event',
                    'date' => $eventDate,
                    'text' => "{$event['title']} on {$formattedEventDate}"
                ];
            }
        }
    }
}

// Sort reminders by date in ascending order.
usort($reminders, function($a, $b) {
    return strcmp($a['date'], $b['date']);
});

echo json_encode($reminders);
exit();
