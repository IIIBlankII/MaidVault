<?php
    session_start();
?>

<div class="p-6">
    <h1 class="text-2xl font-semibold text-white mb-4">Analytics Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-purple-800 p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium text-white">Total Maids</h2>
            <p class="text-3xl font-bold text-white">120</p>
            <p class="text-sm text-purple-200">+8% this month</p>
        </div>
        <div class="bg-purple-800 p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium text-white">Total Clients</h2>
            <p class="text-3xl font-bold text-white">85</p>
            <p class="text-sm text-purple-200">+5% this month</p>
        </div>
        <div class="bg-purple-800 p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium text-white">Total Sales</h2>
            <p class="text-3xl font-bold text-white">RM 12,500</p>
            <p class="text-sm text-purple-200">+12% this month</p>
        </div>
    </div>

    <div class="bg-purple-900 p-6 mt-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-white mb-4">Growth Analysis</h2>
        <canvas id="growthChart"></canvas>
    </div>

    <div class="bg-purple-900 p-6 mt-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-white mb-4">Active Percentage</h2>
        <canvas id="activePercentageChart"></canvas>
    </div>
</div>

<script>
    if (typeof renderCharts === "function") {
        renderCharts();
    } else {
        console.error("renderCharts function not found.");
    }
</script>
