<?php
session_start();
?>

<head>
  <style>
    .event-link:hover {
      color: blue; /* Change to your desired blue shade */
      text-decoration: underline;
    }

  </style>
</head>

<div id="calendar-page" class="p-6">
  <h2 class="text-2xl font-semibold mb-4">Calendar & Schedule</h2>
  <div class="bg-white p-4 shadow-md rounded-lg">
    <!-- Calendar header -->
    <div class="flex justify-between items-center">
      <button id="prev" class="p-2">‹</button>
      <h3 id="calendar-title" class="text-lg font-semibold"></h3>
      <button id="next" class="p-2">›</button>
    </div>
    <!-- Weekday headers -->
    <div class="grid grid-cols-7 gap-1 text-center mt-4">
      <div class="font-bold">Mon</div>
      <div class="font-bold">Tue</div>
      <div class="font-bold">Wed</div>
      <div class="font-bold">Thu</div>
      <div class="font-bold">Fri</div>
      <div class="font-bold">Sat</div>
      <div class="font-bold">Sun</div>
    </div>
    <!-- Calendar grid -->
    <div id="calendar-grid" class="grid grid-cols-7 gap-1 text-center mt-2"></div>
  </div>
  
  <div id="events-list" class="mt-6 bg-white p-4 shadow-md rounded-lg">
  <div class="flex justify-between items-center mb-2">
  <h3 id="events-title" class="text-lg font-semibold">Events</h3>
    <button id="add-event-btn" class="text-blue-500 text-2xl font-bold">+</button>
  </div>

  <!-- This div will show the events list by default -->
  <div id="events-display">
    <!-- Your events list code here -->
  </div>

  <!-- Hidden event creation form -->
  <div id="event-form" class="hidden mt-4">
    <form method="POST">
      <div class="mb-2">
        <label for="event_date" class="block text-sm font-medium">Event Date:</label>
        <input type="date" name="event_date" id="event_date" required class="mt-1 p-2 border rounded w-full">
      </div>

      <div class="mb-2">
        <label for="title" class="block text-sm font-medium">Title:</label>
        <input type="text" name="title" id="title" required class="mt-1 p-2 border rounded w-full">
      </div>

      <div class="mb-2">
        <label for="description" class="block text-sm font-medium">Description:</label>
        <textarea name="description" id="description" class="mt-1 p-2 border rounded w-full"></textarea>
      </div>

      <?php 
      if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <div class="mb-2">
          <label for="event_type" class="block text-sm font-medium">Event Type:</label>
          <select name="event_type" id="event_type" required class="mt-1 p-2 border rounded w-full">
            <option value="local">Local (Only on your calendar)</option>
            <option value="global">Global (For all users)</option>
          </select>
        </div>
      <?php else: ?>
        <input type="hidden" name="event_type" value="local">
      <?php endif; ?>

      <!-- Assuming you have a session variable for user_id -->
      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? ''; ?>">

      <button type="submit" class="mt-2 p-2 bg-blue-500 text-white rounded">Add Event</button>
    </form>
  </div>
</div>




