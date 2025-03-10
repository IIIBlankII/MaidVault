<?php
session_start();
require_once '../../models/Client.php'; 
require_once '../../models/Maid.php';   
require_once '../../models/Visa.php';   

// -------------------------
// Client Analytics Data
// -------------------------
$totalClients    = Client::getTotalClients();
$signupsPerDay   = Client::getSignupsPerDay();
$signupsPerWeek  = Client::getSignupsPerWeek();
$signupsPerMonth = Client::getSignupsPerMonth();
$clientsByCity   = Client::getClientsByCity();
$averageFamilyMetrics = Client::getAverageFamilyMetrics();
$preferredNationalityDistribution = Client::getPreferredNationalityDistribution();
$preferredLanguageDistribution  = Client::getPreferredLanguageDistribution();
$workTypeDistribution           = Client::getWorkTypeDistribution();

// -------------------------
// Maid Analytics Data
// -------------------------
$totalMaids = Maid::getTotalMaids();
$maidsByStatus = Maid::getMaidsByEmploymentStatus();
$ageDistribution = Maid::getAgeDistribution();
$languageBreakdown = Maid::getLanguageBreakdown();
$nationalityBreakdown = Maid::getNationalityBreakdown();
$commonSkills = Maid::getCommonSkills();
$nationalityAlignment = Maid::getNationalityAlignment();
$languageAlignment = Maid::getLanguageAlignment();

// -------------------------
// Visa Analytics Data
// -------------------------
$upcomingExpirations = Visa::getUpcomingExpirations();
$visaTypeDistribution = Visa::getVisaTypeDistribution();
$averageVisaDuration = Visa::getAverageVisaDuration();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Analytics Dashboard</title>
  <!-- Load Chart.js from CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
    }
    h1, h2, h3 { color: #333; }
    .card {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .section {
      margin-bottom: 40px;
    }
    .chart-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      grid-gap: 20px;
    }
    .chart-container {
      background: #fff;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      height: 300px;
    }
    .chart-container h3 {
      font-size: 1rem;
      margin-bottom: 10px;
      text-align: center;
    }
    canvas {
      width: 100% !important;
      height: 240px !important;
    }
  </style>
</head>
<body>
  <h1 class="text-5xl text-white font-bold pb-4">Analytics Dashboard</h1>
  
  <!-- Client Analytics Section -->
  <div class="section">
    <h2 class="text-3xl text-white font-bold pb-4">Client Analytics</h2>

    <!-- Display Total Clients -->
    <div class="card">
      <h3>Total Clients</h3>
      <p style="font-size: 2rem;"><?php echo htmlspecialchars($totalClients); ?></p>
    </div>
    <!-- Client Charts Grid -->
    <div class="chart-grid">
      <div class="chart-container">
        <h3>Sign-ups Per Day</h3>
        <canvas id="signupsPerDayChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Sign-ups Per Week</h3>
        <canvas id="signupsPerWeekChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Sign-ups Per Month</h3>
        <canvas id="signupsPerMonthChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Clients By City</h3>
        <canvas id="clientsByCityChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Average Family Metrics</h3>
        <canvas id="familyMetricsChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Preferred Nationality</h3>
        <canvas id="preferredNationalityChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Preferred Language</h3>
        <canvas id="preferredLanguageChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Work Type Distribution</h3>
        <canvas id="workTypeChart"></canvas>
      </div>
    </div>
  </div>
  
  <!-- Maid Analytics Section -->
  <div class="section">
    <h2 class="text-3xl text-white font-bold pb-4">Maid Analytics</h2>
    <!-- Display Total Maids -->
    <div class="card">
      <h3>Total Maids</h3>
      <p style="font-size: 2rem;"><?php echo htmlspecialchars($totalMaids); ?></p>
    </div>
    <!-- Maid Charts Grid -->
    <div class="chart-grid">
      <div class="chart-container">
        <h3>Employment Status</h3>
        <canvas id="employmentStatusChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Age Distribution</h3>
        <canvas id="ageDistributionChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Language Breakdown</h3>
        <canvas id="languageBreakdownChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Nationality Breakdown</h3>
        <canvas id="nationalityBreakdownChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Common Skills</h3>
        <canvas id="commonSkillsChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Nationality Alignment</h3>
        <canvas id="nationalityAlignmentChart"></canvas>
        </div>
        <div class="chart-container">
        <h3>Language Alignment</h3>
        <canvas id="languageAlignmentChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>Upcoming Visa Expiration Alerts</h3>
        <canvas id="visaExpirationChart"></canvas>
        </div>
        <div class="chart-container">
        <h3>Visa Type & Work Permit Distribution</h3>
        <canvas id="visaTypeChart"></canvas>
        </div>
        <div class="chart-container">
        <h3>Average Visa Duration (days)</h3>
        <canvas id="visaDurationChart"></canvas>
        </div>
    </div>
    </div>
    </div>

  <!-- Pass PHP Data to JavaScript -->
  <script>
    // Client Analytics
    var signupsPerDay = <?php echo json_encode($signupsPerDay); ?>;
    var signupsPerWeek = <?php echo json_encode($signupsPerWeek); ?>;
    var signupsPerMonth = <?php echo json_encode($signupsPerMonth); ?>;
    var clientsByCity = <?php echo json_encode($clientsByCity); ?>;
    var averageFamilyMetrics = <?php echo json_encode($averageFamilyMetrics); ?>;
    var preferredNationalityDistribution = <?php echo json_encode($preferredNationalityDistribution); ?>;
    var preferredLanguageDistribution = <?php echo json_encode($preferredLanguageDistribution); ?>;
    var workTypeDistribution = <?php echo json_encode($workTypeDistribution); ?>;
    
    // Maid Analytics
    var maidsByStatus = <?php echo json_encode($maidsByStatus); ?>;
    var ageDistribution = <?php echo json_encode($ageDistribution); ?>;
    var languageBreakdown = <?php echo json_encode($languageBreakdown); ?>;
    var nationalityBreakdown = <?php echo json_encode($nationalityBreakdown); ?>;
    var commonSkills = <?php echo json_encode($commonSkills); ?>;
    var nationalityAlignment = <?php echo json_encode($nationalityAlignment); ?>;
    var languageAlignment = <?php echo json_encode($languageAlignment); ?>;

    // Visa Analytics
    var upcomingExpirations = <?php echo json_encode($upcomingExpirations); ?>;
    var visaTypeDistribution = <?php echo json_encode($visaTypeDistribution); ?>;
    var averageVisaDuration = <?php echo json_encode($averageVisaDuration); ?>;
  </script>

  <script>
    // Initialize all charts when page loads
    renderCharts();
  </script>
</body>
</html>
