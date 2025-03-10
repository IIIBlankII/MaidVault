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
  <div class="bg-gradient-to-br from-neutral-50 to-neutral-200 text-purple-500 p-4 rounded-lg shadow-2xl ">
    <h2 class="text-lg font-semibold mb-4">Total Maids</h2>
    <p class="text-4xl font-bold"><?php echo $totalMaids; ?></p>
  </div>

  <!-- Total Clients Section -->
  <div class="bg-gradient-to-br from-neutral-50 to-neutral-200 text-purple-500 p-4 rounded-lg shadow-2xl ">
    <h2 class="text-lg font-semibold mb-4">Total Clients</h2>
    <p class="text-4xl font-bold"><?php echo $totalClients; ?></p>
  </div>

  <!-- Reminders Section -->
<div class="bg-gradient-to-br from-neutral-50 to-neutral-200 text-purple-500 p-6 rounded-lg shadow-2xl lg:row-span-2">
  <h2 class="text-lg font-semibold mb-6 tracking-wide">Upcoming Reminders</h2>
  
  <!-- Stylish Reminder Filter -->
  <div class="relative mb-6">
  <label for="reminderFilter" class="block text-sm font-medium mb-2">Filter by:</label>
  <select id="reminderFilter" class="w-full font-medium py-3 px-4 pr-10 rounded-lg bg-purple-500 text-white border-2 border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-3+200 appearance-none">
    <option value="week" class="text-white">Next Week</option>
    <option value="month" class="text-white">Next Month</option>
    <option value="year" class="text-white">Next Year</option>
  </select>
  <span class="absolute right-4 top-2/3 -translate-y-1/2 text-white pointer-events-none">▼</span>
</div>

  
  <!-- Reminder List -->
  <ul id="reminderList" class="space-y-4">
    <!-- Reminders will be populated here dynamically -->
  </ul>
</div>

  <!-- Employment Status Chart (replacing Sales Overview) -->
<div class="bg-gradient-to-br from-neutral-200 to-stone-300 text-purple-500 p-4 rounded-lg shadow-lg col-span-1 md:col-span-2 chart-container" style="height:500px;">
    <h2 class="text-lg font-semibold mb-4">Employment Status</h2>
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
