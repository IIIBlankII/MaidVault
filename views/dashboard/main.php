<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MaidVault Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body, button, input, a, span, h1, p, div { font-family: 'Neutral 50', sans-serif; }

    /* Add these keyframes */
@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

.animated-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: -1;
  background: linear-gradient(-45deg, #4f46e5, #818cf8, #4338ca, #6366f1);
  background-size: 400% 400%;
  animation: gradient 15s ease infinite;
  opacity: 0.3;
}
  </style>
</head>
<body class="bg-neutral-700">

  <!-- Top Navigation Bar -->
  <div class="bg-purple-300 shadow-md flex justify-between items-center px-6 py-4 relative">
    <div class="flex items-center">
      <img src="logoo.png" alt="MaidVault Logo" class="h-8 w-8 mr-2">
      <span class="text-xl font-semibold text-white ">MaidVault</span>
    </div>
    <div class="flex space-x-6 items-center">
      <button class="text-nuetral-100 hover:text-blue-500">
        <i class="fa-solid fa-bell text-xl"></i>
      </button>
      <!-- Cog Button with Logout Dropdown -->
      <div class="relative">
        <button id="cog-btn" class="text-gray-600 hover:text-blue-500 focus:outline-none">
          <i class="fa-solid fa-cog text-xl"></i>
        </button>
        <div id="logout-dropdown" class="absolute right-0 mt-2 hidden bg-white shadow-md rounded-md z-10">
          <a href="../../public/logout.php" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Logout</a>
        </div>
      </div>
      <button class="text-gray-600 hover:text-blue-500">
        <i class="fa-solid fa-user-circle text-xl"></i>
      </button>
    </div>
  </div>

    <!-- Dashboard Layout -->
    <div class="flex min-h-screen h-full">
        <!-- Sidebar Navigation -->
        <div class="bg-purple-100 w-64 shadow-md p-4 flex flex-col h-screen sticky top-0">
            <div class="mb-4">
                <input type="text" placeholder="Search..." class="w-full px-3 py-2 border rounded-md">
            </div>

            <nav class="space-y-4">
                <a href="#" onclick="loadPage('maindash')" class="block py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                    <i class="fa-solid fa-home mr-2"></i> Dashboard
                </a>

                <div>
                    <button id="maid-btn" class="flex justify-between w-full py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                        <span><i class="fa-solid fa-users mr-2"></i> Maids</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div id="maid-dropdown" class="hidden pl-6">
                        <a href="#" onclick="loadPage('maids')" class="block py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                            View Maids
                        </a>
                        <a href="#" onclick="loadPage('add_maid')" id="add-maid-option" class="block py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                            Add Maid
                        </a>
                    </div>
                </div>

                <div>
                    <button id="client-btn" class="flex justify-between w-full py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                        <span><i class="fa-solid fa-briefcase mr-2"></i> Clients</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div id="client-dropdown" class="hidden pl-6">
                        <a href="#" onclick="loadPage('clients')" class="block py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                            View Clients
                        </a>
                        <a href="#" onclick="loadPage('add_client')" id="add-client-option" class="block py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                            Add Client
                        </a>
                    </div>
                </div>

                <a href="#" onclick="loadPage('calendar')" class="block py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                    <i class="fa-solid fa-calendar-alt mr-2"></i> Calendar & Schedule
                </a>

                <a href="#" onclick="loadPage('analytics')" class="block py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                    <i class="fa-solid fa-chart-line mr-2"></i> Analytics
                </a>
            </nav>
        </div>

  <!-- Main Content Area -->
<div id="main-content" class="flex-1 p-6 overflow-auto relative"> <!-- Added relative class -->
  <!-- Animated Background -->
  <div class="animated-bg rounded-lg"></div>
  
  <!-- Existing content -->
  <div class="relative z-10"> <!-- Added z-10 to bring content forward -->
    <h1 class="text-2xl font-semibold text-white">Welcome to MaidVault Dashboard</h1>
    <p class="text-neutral-200">Manage maids, clients, and reports efficiently.</p>
  </div>
</div>

  <script>
    var userRole = "<?php echo $_SESSION['user_role'] ?? 'user'; ?>";

    // Toggle dropdown for cog button (logout option)
    document.getElementById('cog-btn').addEventListener('click', function(e) {
      e.stopPropagation();
      var dropdown = document.getElementById('logout-dropdown');
      dropdown.classList.toggle('hidden');
    });

    // Hide the logout dropdown if clicking outside
    document.addEventListener('click', function() {
      var dropdown = document.getElementById('logout-dropdown');
      if (!dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
      }
    });
  </script>
  
  <!-- Keep this in your PHP file -->
<script>
    var userRole = "<?php echo $_SESSION['user_role'] ?? 'user'; ?>";

    // Toggle dropdown for cog button (logout option)
    document.getElementById('cog-btn').addEventListener('click', function(e) {
        e.stopPropagation();
        var dropdown = document.getElementById('logout-dropdown');
        dropdown.classList.toggle('hidden');
    });

    // Hide the logout dropdown if clicking outside
    document.addEventListener('click', function() {
        var dropdown = document.getElementById('logout-dropdown');
        if (!dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
        }
    });
</script>

  <script src="../../public/js/dashboard.js"></script>
</body>
</html>
