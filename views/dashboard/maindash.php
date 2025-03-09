<?php
session_start();
require_once '../../models/Client.php'; 
require_once '../../models/Maid.php'; 

$totalClients   = Client::getTotalClients();
$totalMaids     = Maid::getTotalMaids();
$maidsByStatus  = Maid::getMaidsByEmploymentStatus();
?>

<!-- Dynamic Content for maindash.php (loaded via dashboard.js) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 auto-rows-min">
  <!-- Total Maids Section -->
  <div class="bg-purple-300 text-white p-4 rounded-lg shadow-lg">
    <h2 class="text-lg font-semibold mb-4">Total Maids</h2>
    <p class="text-4xl font-bold"><?php echo $totalMaids; ?></p>
  </div>

  <!-- Total Clients Section -->
  <div class="bg-purple-300 text-white p-4 rounded-lg shadow-lg">
    <h2 class="text-lg font-semibold mb-4">Total Clients</h2>
    <p class="text-4xl font-bold"><?php echo $totalClients; ?></p>
  </div>

  <!-- Reminders Section -->
<!-- On large screens, span 2 rows so its height equals the combined height of the top row and the Employment Status container -->
<div class="bg-purple-300 text-white p-4 rounded-lg shadow-lg lg:row-span-2">
  <h2 class="text-lg font-extrabold mb-4">Upcoming Reminders</h2>
  <!-- Reminder filter with minimal styling -->
  <div class="mb-4">
    <select id="reminderFilter" class="w-full font-semibold py-2 px-3 bg-transparent border-b border-white focus:outline-none focus:border-purple-400 appearance-none">
      <option value="week" class="text-black">Next Week</option>
      <option value="month" class="text-black">Next Month</option>
      <option value="year" class="text-black">Next Year</option>
    </select>
  </div>
  <!-- Reminder list -->
  <ul id="reminderList" class="space-y-2">
    <!-- Reminders will be populated here dynamically -->
  </ul>
</div>

  <!-- Employment Status Chart (replacing Sales Overview) -->
  <div class="bg-purple-300 text-white p-4 rounded-lg shadow-lg col-span-1 md:col-span-2 chart-container" style="height:500px;">
    <h2 class="text-lg font-semibold mb-4">Employment Status</h2>
    <canvas id="employmentStatusChart" class="w-full" style="height:100%;"></canvas>
  </div>
</div>

<script>
  // Pass employment status data to JavaScript for charts.js to use.
  var maidsByStatus = <?php echo json_encode($maidsByStatus); ?>;

  // Function to fetch reminders based on selected filter (week, month, or year)
  function fetchReminders(filter) {
    // Modify the URL as needed to match your actual endpoint.
    fetch('../../controllers/getReminders.php?filter=' + filter)
      .then(response => response.json())
      .then(data => {
        const reminderList = document.getElementById('reminderList');
        reminderList.innerHTML = '';
        if (!data || data.length === 0) {
          reminderList.innerHTML = '<li>No reminders found for this period.</li>';
        } else {
          data.forEach(reminder => {
            const li = document.createElement('li');
            li.classList.add('border-b', 'border-purple-700', 'pb-2', 'font-semibold');
            // Assuming each reminder object has a 'text' property. Adjust if needed.
            li.textContent = reminder.text;
            reminderList.appendChild(li);
          });
        }
      })
      .catch(error => {
        console.error('Error fetching reminders:', error);
      });
  }

  // Add event listener to the filter dropdown
  document.getElementById('reminderFilter').addEventListener('change', function() {
    fetchReminders(this.value);
  });

  // Load default reminders (next week) when the content is loaded
  fetchReminders(document.getElementById('reminderFilter').value);
</script>
