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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Top Navigation Bar -->
    <div class="bg-white shadow-md flex justify-between items-center px-6 py-4">
        <div class="flex items-center">
            <img src="logo.png" alt="MaidVault Logo" class="h-8 w-8 mr-2">
            <span class="text-xl font-semibold">MaidVault</span>
        </div>
        <div class="flex space-x-6">
            <button class="text-gray-600 hover:text-blue-500"><i class="fa-solid fa-bell text-xl"></i></button>
            <button class="text-gray-600 hover:text-blue-500"><i class="fa-solid fa-cog text-xl"></i></button>
            <button class="text-gray-600 hover:text-blue-500"><i class="fa-solid fa-user-circle text-xl"></i></button>
        </div>
    </div>

    <!-- Dashboard Layout -->
    <div class="flex h-screen">
        <!-- Sidebar Navigation -->
        <div class="bg-white w-64 shadow-md p-4">
            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" placeholder="Search..." class="w-full px-3 py-2 border rounded-md">
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-4">
                <a href="#" onclick="loadPage('dashboard')" class="block py-2 px-4 text-gray-700 hover:bg-blue-100 rounded-md">
                    <i class="fa-solid fa-home mr-2"></i> Dashboard
                </a>

                <!-- Maid Dropdown -->
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

                <!-- Client Dropdown -->
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
        <div id="main-content" class="flex-1 p-6">
            <h1 class="text-2xl font-semibold">Welcome to MaidVault Dashboard</h1>
            <p class="text-gray-600">Manage maids, clients, and reports efficiently.</p>
        </div>
    </div>

    <script>
        var userRole = "<?php echo $_SESSION['user_role'] ?? 'user'; ?>";
    </script>

 
    <script src="../../public/js/dashboard.js"></script>

</body>
</html>
