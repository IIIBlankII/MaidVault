<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Calendar & Schedule</title>
  <style>
    /* Fade in animation for the container */
    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fade-in {
      animation: fadeInUp 0.5s ease-out forwards;
    }

    /* Card styling matching the theme */
    .card {
      background-color: #2d3748; /* equivalent to bg-gray-800 */
      color: #edf2f7; /* light text */
      padding: 1rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #805ad5; /* bg-purple-600 */
      color: #fff;
      padding: 0.5rem 1rem;
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }
    .card-body {
      padding: 1rem;
    }

    /* Navigation buttons */
    button {
      transition: background-color 0.3s ease, transform 0.3s ease;
    }
    button:hover {
      transform: scale(1.05);
    }

    /* Calendar grid day cells */
    .calendar-day {
      background-color: #4a5568; /* similar to bg-gray-700 */
      color: #edf2f7;
      border: 1px solid #4a5568;
      border-radius: 0.25rem;
      padding: 0.5rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .calendar-day:hover {
      background-color: #4299e1; /* blue-400 accent */
    }
    .calendar-day.selected {
      border: 2px solid #d53f8c; /* pink accent for selection */
    }

    /* Weekday headers */
    .weekday {
      font-weight: bold;
      text-align: center;
      color: #edf2f7;
    }

    /* Event link styling */
    .event-link:hover {
      color: #63b3ed;
      text-decoration: underline;
    }
  </style>
</head>
<body class="bg-gray-900">
<div id="calendar-page" class="p-6 animate-fade-in">
  <h2 class="text-2xl font-semibold mb-4 text-white">Calendar & Schedule</h2>

  <!-- Calendar Card -->
  <div class="card">
    <div class="card-header flex justify-between items-center">
      <button id="prev" class="p-2 focus:outline-none">&lsaquo;</button>
      <h3 id="calendar-title" class="text-lg font-semibold"></h3>
      <button id="next" class="p-2 focus:outline-none">&rsaquo;</button>
    </div>
    <div class="card-body">
      <!-- Weekday headers -->
      <div class="grid grid-cols-7 gap-1 text-center mb-2">
        <div class="weekday">Mon</div>
        <div class="weekday">Tue</div>
        <div class="weekday">Wed</div>
        <div class="weekday">Thu</div>
        <div class="weekday">Fri</div>
        <div class="weekday">Sat</div>
        <div class="weekday">Sun</div>
      </div>
      <!-- Calendar grid -->
      <div id="calendar-grid" class="grid grid-cols-7 gap-1 text-center"></div>
    </div>
  </div>

  <!-- Events Card -->
  <div id="events-list" class="mt-6 card">
    <div class="card-header flex justify-between items-center">
      <h3 id="events-title" class="text-lg font-semibold">Events</h3>
      <button id="add-event-btn" class="text-blue-400 text-2xl font-bold">+</button>
    </div>
    <div class="card-body">
      <div id="events-display">
        <!-- Events will be loaded dynamically -->
      </div>
      <!-- Hidden event creation form -->
      <div id="event-form" class="hidden mt-4">
        <form method="POST">
          <div class="mb-2">
            <label for="event_date" class="block text-sm font-medium">Event Date:</label>
            <input type="date" name="event_date" id="event_date" required class="mt-1 p-2 border rounded w-full bg-gray-700 text-white">
          </div>
          <div class="mb-2">
            <label for="title" class="block text-sm font-medium">Title:</label>
            <input type="text" name="title" id="title" required class="mt-1 p-2 border rounded w-full bg-gray-700 text-white">
          </div>
          <div class="mb-2">
            <label for="description" class="block text-sm font-medium">Description:</label>
            <textarea name="description" id="description" class="mt-1 p-2 border rounded w-full bg-gray-700 text-white"></textarea>
          </div>
          <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <div class="mb-2">
              <label for="event_type" class="block text-sm font-medium">Event Type:</label>
              <select name="event_type" id="event_type" required class="mt-1 p-2 border rounded w-full bg-gray-700 text-white">
                <option value="local">Local (Only on your calendar)</option>
                <option value="global">Global (For all users)</option>
              </select>
            </div>
          <?php else: ?>
            <input type="hidden" name="event_type" value="local">
          <?php endif; ?>
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? ''; ?>">
          <button type="submit" class="mt-2 p-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add Event</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
