<?php
session_start();
require_once '../../models/Client.php'; 
require_once '../../models/Maid.php'; 

$totalClients   = Client::getTotalClients();
$totalMaids     = Maid::getTotalMaids();
$maidsByStatus  = Maid::getMaidsByEmploymentStatus();
?>

<style>
  /* Fade in from below animation */
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
    animation: fadeInUp 0.6s ease-out forwards;
  }
</style>

<!-- Dynamic Dashboard Content -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 auto-rows-min">
  <!-- Total Maids Section -->
  <div class="bg-gray-700 text-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 animate-fade-in">
    <h2 class="text-lg font-semibold mb-4 text-purple-400">Total Maids</h2>
    <p class="text-4xl font-bold"><?php echo $totalMaids; ?></p>
  </div>

  <!-- Total Clients Section -->
  <div class="bg-gray-700 text-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 animate-fade-in">
    <h2 class="text-lg font-semibold mb-4 text-purple-400">Total Clients</h2>
    <p class="text-4xl font-bold"><?php echo $totalClients; ?></p>
  </div>

  <!-- Reminders Section -->
  <div class="bg-gray-700 text-white p-6 rounded-lg shadow-lg lg:row-span-2 transform transition duration-300 hover:scale-105 animate-fade-in">
    <h2 class="text-lg font-extrabold mb-4">Upcoming Reminders</h2>
    <!-- Reminder filter -->
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

  <!-- Employment Status Chart -->
  <div class="bg-gray-700 text-white p-6 rounded-lg shadow-lg col-span-1 md:col-span-2 chart-container transform transition duration-300 hover:scale-105 animate-fade-in" style="height:500px;">
    <h2 class="text-lg font-semibold mb-4 text-purple-400">Employment Status</h2>
    <canvas id="employmentStatusChart" class="w-full" style="height:100%;"></canvas>
  </div>
</div>

<script>
  // Pass employment status data to JavaScript for charts.js to use.
  var maidsByStatus = <?php echo json_encode($maidsByStatus); ?>;

  // Function to fetch reminders based on the selected filter (week, month, or year)
  function fetchReminders(filter) {
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
            li.textContent = reminder.text;
            reminderList.appendChild(li);
          });
        }
      })
      .catch(error => {
        console.error('Error fetching reminders:', error);
      });
  }

  // Listen for changes on the reminder filter
  document.getElementById('reminderFilter').addEventListener('change', function() {
    fetchReminders(this.value);
  });

  // Load default reminders (Next Week) on page load
  fetchReminders(document.getElementById('reminderFilter').value);
</script>
