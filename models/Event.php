<?php
require_once __DIR__ . '/../includes/db_connect.php';

class Event {
    // Create a new event in the database.
    public static function createEvent($event_date, $title, $description, $event_type, $user_id) {
        global $conn;
        
        $stmt = $conn->prepare("INSERT INTO events (event_date, title, description, event_type, user_id) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssssi", $event_date, $title, $description, $event_type, $user_id);
        
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    // Fetch events for a given user.
    // Global events (event_type = 'global') are returned for all users,
    // while local events (event_type = 'local') are returned only for the given user.
    // This version supports multiple events per day.
    public static function getEvents($user_id) {
        global $conn;
        
        // Format event_date as 'YYYY-MM-DD'
        $stmt = $conn->prepare("SELECT id, DATE_FORMAT(event_date, '%Y-%m-%d') as event_date, title, description FROM events WHERE event_type = 'global' OR (event_type = 'local' AND user_id = ?)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $date = $row['event_date'];
            if (!isset($events[$date])) {
                $events[$date] = [];
            }
            // Instead of just appending the title, store an associative array with id, title, and description
            $events[$date][] = [
                'id'          => $row['id'],
                'title'       => $row['title'],
                'description' => $row['description']
            ];
        }
        $stmt->close();
        return $events;
    }

    public static function getEventDetails($user_id, $event_date, $event_title) {
        global $conn;
        
        // Format the date using DATE_FORMAT or convert it using PHP to ensure it matches the format you use in JS (YYYY-MM-DD)
        $stmt = $conn->prepare("
            SELECT title, description 
            FROM events 
            WHERE DATE_FORMAT(event_date, '%Y-%m-%d') = ? 
              AND title = ? 
              AND (event_type = 'global' OR (event_type = 'local' AND user_id = ?))
            LIMIT 1
        ");
        $stmt->bind_param("ssi", $event_date, $event_title, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $eventDetails = $result->fetch_assoc();
        $stmt->close();
        return $eventDetails;
    }
    
    public static function deleteEvent($event_id, $user_id) {
        global $conn;
        $stmt = $conn->prepare("
            DELETE FROM events 
            WHERE id = ? 
              AND (event_type = 'global' OR (event_type = 'local' AND user_id = ?))
        ");
        $stmt->bind_param("ii", $event_id, $user_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
}

?>
