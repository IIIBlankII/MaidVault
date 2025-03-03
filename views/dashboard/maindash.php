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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js?v=<?=time()?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-black text-white">

    <!-- Dashboard Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        <!-- Maid Growth Chart -->
        <div class="bg-purple-900 text-white p-4 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Maid Growth</h2>
            <canvas id="maidGrowthChart" class="w-full"></canvas>
        </div>

        <!-- Client Activity Chart -->
        <div class="bg-purple-900 text-white p-4 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Client Activity</h2>
            <canvas id="clientActivityChart" class="w-full"></canvas>
        </div>

        <!-- Reminders Section -->
        <div class="bg-purple-900 text-white p-4 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Upcoming Reminders</h2>
            <ul class="space-y-2">
                <li class="border-b border-purple-700 pb-2">Meeting with client A - 25th Feb</li>
                <li class="border-b border-purple-700 pb-2">Maid B visa expires - 1st Mar</li>
                <li>Review report submission - 3rd Mar</li>
            </ul>
        </div>

        <!-- Sales Overview -->
        <div class="bg-purple-900 text-white p-4 rounded-lg shadow-lg col-span-1 md:col-span-2">
            <h2 class="text-lg font-semibold mb-4">Sales Overview</h2>
            <canvas id="salesOverviewChart" class="w-full"></canvas>
        </div>
    </div>

    <script>
        // Maid Growth Chart
        function renderCharts() {
            const maidGrowthCtx = document.getElementById('maidGrowthChart').getContext('2d');
            new Chart(maidGrowthCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Number of Maids',
                        data: [10, 20, 30, 40, 50],
                        borderColor: '#A78BFA',
                        borderWidth: 2,
                        fill: false
                    }]
                }
            });

            // Client Activity Chart
            const clientActivityCtx = document.getElementById('clientActivityChart').getContext('2d');
            new Chart(clientActivityCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Inactive'],
                    datasets: [{
                        data: [70, 30],
                        backgroundColor: ['#A78BFA', '#4B5563']
                    }]
                }
            });

            // Sales Overview Chart
            const salesOverviewCtx = document.getElementById('salesOverviewChart').getContext('2d');
            new Chart(salesOverviewCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Total Sales',
                        data: [1000, 1200, 1500, 1700, 2000],
                        backgroundColor: '#A78BFA'
                    }]
                }
            });
        }

        renderCharts();
    </script>


</body>
</html>
