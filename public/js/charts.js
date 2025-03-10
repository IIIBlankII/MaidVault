// charts.js

// Helper function to get canvas context and destroy any existing Chart instance on that canvas
function getCleanContext(canvasId) {
  const canvas = document.getElementById(canvasId);
  if (!canvas) {
    console.error(`Canvas with id ${canvasId} not found.`);
    return null;
  }
  const existingChart = Chart.getChart(canvas);
  if (existingChart) {
    existingChart.destroy();
  }
  return canvas.getContext("2d");
}

function reinitializeCharts() {
  // Optionally, if you use a global array, you can also clear it:
  if (window.chartInstances) {
    window.chartInstances.forEach(chart => chart.destroy());
  }
  window.chartInstances = [];

  // =========================
  // Client Analytics Charts
  // =========================

  // 1. Signups Per Day (Bar Chart)
  const ctxDay = getCleanContext("signupsPerDayChart");
  if (ctxDay) {
    const dayLabels = signupsPerDay.map(item => item.signup_date);
    const dayData = signupsPerDay.map(item => parseInt(item.total_signups));
    const signupsPerDayChart = new Chart(ctxDay, {
      type: "bar",
      data: {
        labels: dayLabels,
        datasets: [{
          label: "Signups Per Day",
          data: dayData,
          backgroundColor:"#C4B5FD" ,
          borderColor: "#2E1065",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(signupsPerDayChart);
  }

  // 2. Signups Per Week (Bar Chart)
  const ctxWeek = getCleanContext("signupsPerWeekChart");
  if (ctxWeek) {
    const weekLabels = signupsPerWeek.map(item => {
      const str = item.signup_week.toString();
      const year = str.substring(0, 4);
      const weekNum = str.substring(4);
      return `Week ${parseInt(weekNum)}, ${year}`;
    });
    const weekData = signupsPerWeek.map(item => parseInt(item.total_signups));
    const signupsPerWeekChart = new Chart(ctxWeek, {
      type: "bar",
      data: {
        labels: weekLabels,
        datasets: [{
          label: "Signups Per Week",
          data: weekData,
          backgroundColor: "#C4B5FD ",
          borderColor: "#6D28D9",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(signupsPerWeekChart);
  }

  // 3. Signups Per Month (Line Chart)
  const ctxMonth = getCleanContext("signupsPerMonthChart");
  if (ctxMonth) {
    const monthLabels = signupsPerMonth.map(item => item.signup_month);
    const monthData = signupsPerMonth.map(item => parseInt(item.total_signups));
    const signupsPerMonthChart = new Chart(ctxMonth, {
      type: "line",
      data: {
        labels: monthLabels,
        datasets: [{
          label: "Signups Per Month",
          data: monthData,
          backgroundColor: "rgba(153, 102, 255, 0.5)",
          borderColor: "rgba(153, 102, 255, 1)",
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(signupsPerMonthChart);
  }

  // 4. Clients By City (Pie Chart)
  const ctxCity = getCleanContext("clientsByCityChart");
  if (ctxCity) {
    const cityLabels = clientsByCity.map(item => item.city);
    const cityData = clientsByCity.map(item => parseInt(item.total_clients));
    const clientsByCityChart = new Chart(ctxCity, {
      type: "pie",
      data: {
        labels: cityLabels,
        datasets: [{
          label: "Clients By City",
          data: cityData,
          backgroundColor: [
            "#4C1D95  ",
            "#C4B5FD ",
            "#A78BFA ",
            "#8B5CF6 ",
            "#6D28D9 ",
            "#2E1065"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    window.chartInstances.push(clientsByCityChart);
  }

  // 5. Average Family Metrics (Bar Chart)
  const ctxFamily = getCleanContext("familyMetricsChart");
  if (ctxFamily) {
    const familyLabels = ["Household Size", "Children", "Elders"];
    const familyData = [
      parseFloat(averageFamilyMetrics.avg_household_size).toFixed(2),
      parseFloat(averageFamilyMetrics.avg_children).toFixed(2),
      parseFloat(averageFamilyMetrics.avg_elders).toFixed(2)
    ];
    const familyMetricsChart = new Chart(ctxFamily, {
      type: "bar",
      data: {
        labels: familyLabels,
        datasets: [{
          label: "Average Family Metrics",
          data: familyData,
          backgroundColor: [
            "#4C1D95  ",
            "#C4B5FD ",
            "#A78BFA "

          ],
          borderColor: [
            "#8B5CF6 ",
            "#6D28D9",
            "#2E1065"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(familyMetricsChart);
  }

  // 6. Preferred Nationality Distribution (Pie Chart)
  const ctxPrefNat = getCleanContext("preferredNationalityChart");
  if (ctxPrefNat) {
    const prefNatLabels = preferredNationalityDistribution.map(item => item.preferred_nationality || "Not Specified");
    const prefNatData = preferredNationalityDistribution.map(item => parseInt(item.total));
    const preferredNationalityChart = new Chart(ctxPrefNat, {
      type: "pie",
      data: {
        labels: prefNatLabels,
        datasets: [{
          label: "Preferred Nationality",
          data: prefNatData,
          backgroundColor: [
            "#4C1D95  ",
            "#C4B5FD ",
            "#A78BFA ",
            "#8B5CF6 ",
            "#6D28D9 ",
            "#2E1065"

          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    window.chartInstances.push(preferredNationalityChart);
  }

  // 7. Preferred Language Distribution (Pie Chart)
  const ctxPrefLang = getCleanContext("preferredLanguageChart");
  if (ctxPrefLang) {
    const prefLangLabels = preferredLanguageDistribution.map(item => item.preferred_language || "Not Specified");
    const prefLangData = preferredLanguageDistribution.map(item => parseInt(item.total));
    const preferredLanguageChart = new Chart(ctxPrefLang, {
      type: "pie",
      data: {
        labels: prefLangLabels,
        datasets: [{
          label: "Preferred Language",
          data: prefLangData,
          backgroundColor: [
            "#4C1D95  ",
            "#C4B5FD ",
            "#A78BFA ",
            "#8B5CF6 ",
            "#6D28D9 "
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    window.chartInstances.push(preferredLanguageChart);
  }

  // 8. Work Type Distribution (Pie Chart)
  const ctxWorkType = getCleanContext("workTypeChart");
  if (ctxWorkType) {
    const workTypeLabels = workTypeDistribution.map(item => item.work_type);
    const workTypeData = workTypeDistribution.map(item => parseInt(item.total));
    const workTypeChart = new Chart(ctxWorkType, {
      type: "pie",
      data: {
        labels: workTypeLabels,
        datasets: [{
          label: "Work Type Distribution",
          data: workTypeData,
          backgroundColor: [
            "#4C1D95  ",
            "#C4B5FD ",
            "#A78BFA "
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    window.chartInstances.push(workTypeChart);
  }

  // =========================
  // Maid Analytics Charts
  // =========================

  // 9. Employment Status Breakdown (Bar Chart)
  const ctxEmployment = getCleanContext("employmentStatusChart");
  if (ctxEmployment) {
    const employmentLabels = maidsByStatus.map(item => item.employment_status);
    const employmentData = maidsByStatus.map(item => parseInt(item.total));
    const employmentStatusChart = new Chart(ctxEmployment, {
      type: "bar",
      data: {
        labels: employmentLabels,
        datasets: [{
          label: "Employment Status",
          data: employmentData,
          backgroundColor: [
            "#4C1D95  ",
            "#C4B5FD ",
            "#A78BFA "
          ],
          borderColor: [
            "#8B5CF6 ",
            "#6D28D9 ",
            "#4C1D95  "
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(employmentStatusChart);
  }

  // 10. Nationality Alignment Chart (Bar Chart)
  const ctxNatAlign = getCleanContext("nationalityAlignmentChart");
  if (ctxNatAlign) {
    const natAlignPercentage = parseFloat(nationalityAlignment.percentage).toFixed(2);
    const nationalityAlignmentChart = new Chart(ctxNatAlign, {
      type: "bar",
      data: {
        labels: ["Nationality Alignment"],
        datasets: [{
          label: `Matching ${nationalityAlignment.common_nationality}`,
          data: [natAlignPercentage],
          backgroundColor: "#4C1D95  ",
          borderColor: "#8B5CF6 ",

          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true, max: 100 } }
      }
    });
    window.chartInstances.push(nationalityAlignmentChart);
  }

  // 11. Age Distribution (Bar Chart)
  const ctxAge = getCleanContext("ageDistributionChart");
  if (ctxAge) {
    const ageLabels = ageDistribution.map(item => item.age);
    const ageData = ageDistribution.map(item => parseInt(item.total));
    const ageDistributionChart = new Chart(ctxAge, {
      type: "bar",
      data: {
        labels: ageLabels,
        datasets: [{
          label: "Age Distribution",
          data: ageData,
          backgroundColor: "#C4B5FD",
          borderColor: "#6D28D9 ",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(ageDistributionChart);
  }

  // 12. Maid Language Breakdown (Pie Chart)
  const ctxMaidLang = getCleanContext("languageBreakdownChart");
  if (ctxMaidLang) {
    const maidLangLabels = languageBreakdown.map(item => item.language);
    const maidLangData = languageBreakdown.map(item => parseInt(item.total));
    const languageBreakdownChart = new Chart(ctxMaidLang, {
      type: "pie",
      data: {
        labels: maidLangLabels,
        datasets: [{
          label: "Maid Language Breakdown",
          data: maidLangData,
          backgroundColor: [
            "#C4B5FD ",
            "#A78BFA ",
            "#8B5CF6",
            "#6D28D9 "
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    window.chartInstances.push(languageBreakdownChart);
  }

  // 13. Maid Nationality Breakdown (Pie Chart)
  const ctxMaidNat = getCleanContext("nationalityBreakdownChart");
  if (ctxMaidNat) {
    const maidNatLabels = nationalityBreakdown.map(item => item.nationality);
    const maidNatData = nationalityBreakdown.map(item => parseInt(item.total));
    const nationalityBreakdownChart = new Chart(ctxMaidNat, {
      type: "pie",
      data: {
        labels: maidNatLabels,
        datasets: [{
          label: "Maid Nationality Breakdown",
          data: maidNatData,
          backgroundColor: [
            "#C4B5FD ",
            "#A78BFA ",
            "#8B5CF6 ",
            "#6D28D9 "
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    window.chartInstances.push(nationalityBreakdownChart);
  }

  // 14. Common Skills (Bar Chart)
  const ctxSkills = getCleanContext("commonSkillsChart");
  if (ctxSkills) {
    const skillsLabels = commonSkills.map(item => item.skills);
    const skillsData = commonSkills.map(item => parseInt(item.total));
    const commonSkillsChart = new Chart(ctxSkills, {
      type: "bar",
      data: {
        labels: skillsLabels,
        datasets: [{
          label: "Common Skills",
          data: skillsData,
          backgroundColor: "#2E1065",
          borderColor: "#6D28D9",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(commonSkillsChart);
  }

  // 15. Language Alignment Chart (Bar Chart)
  const ctxLangAlign = getCleanContext("languageAlignmentChart");
  if (ctxLangAlign) {
    const langAlignPercentage = parseFloat(languageAlignment.percentage).toFixed(2);
    const languageAlignmentChart = new Chart(ctxLangAlign, {
      type: "bar",
      data: {
        labels: ["Language Alignment"],
        datasets: [{
          label: `Matching ${languageAlignment.common_language}`,
          data: [langAlignPercentage],
          backgroundColor: "#A78BFA",
          borderColor: "#8B5CF6",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true, max: 100 } }
      }
    });
    window.chartInstances.push(languageAlignmentChart);
  }

  // =========================
  // Visa Analytics Charts
  // =========================

  // 16. Upcoming Visa Expiration Alerts (Bar Chart)
  const ctxVisaExp = getCleanContext("visaExpirationChart");
  if (ctxVisaExp) {
    const expLabels = upcomingExpirations.map(item => item.expiration_date);
    const expData = upcomingExpirations.map(item => 1); // or group/count as needed
    const visaExpirationChart = new Chart(ctxVisaExp, {
      type: "bar",
      data: {
        labels: expLabels,
        datasets: [{
          label: "Expiring Visas",
          data: expData,
          backgroundColor: "#4C1D95 ",
          borderColor: "#C4B5FD",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(visaExpirationChart);
  }

  // 17. Distribution of Visa Types & Work Permit Statuses (Pie Chart)
  const ctxVisaType = getCleanContext("visaTypeChart");
  if (ctxVisaType) {
    const visaTypeLabels = visaTypeDistribution.map(item => item.visa_type + " / " + item.work_permit_status);
    const visaTypeData = visaTypeDistribution.map(item => parseInt(item.total));
    const visaTypeChart = new Chart(ctxVisaType, {
      type: "pie",
      data: {
        labels: visaTypeLabels,
        datasets: [{
          label: "Visa Types & Work Permit Statuses",
          data: visaTypeData,
          backgroundColor: [
            "#4C1D95  ",
            "#C4B5FD ",
            "#A78BFA ",
            "#8B5CF6 ",
            "#6D28D9 "
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    window.chartInstances.push(visaTypeChart);
  }

  // 18. Average Visa Duration (Bar Chart)
  const ctxVisaDuration = getCleanContext("visaDurationChart");
  if (ctxVisaDuration) {
    const avgDuration = parseFloat(averageVisaDuration.avg_duration).toFixed(2);
    const visaDurationChart = new Chart(ctxVisaDuration, {
      type: "bar",
      data: {
        labels: ["Avg Visa Duration (days)"],
        datasets: [{
          label: "Average Visa Duration",
          data: [avgDuration],
          backgroundColor: "rgba(153, 102, 255, 0.5)",
          borderColor: "rgba(153, 102, 255, 1)",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(visaDurationChart);
  }
}

function reinitializeDashCharts() {

  if (!window.chartInstances) {
    window.chartInstances = [];
  }
  
  const ctxEmployment = getCleanContext("employmentStatusChart");
  if (ctxEmployment) {
    const employmentLabels = maidsByStatus.map(item => item.employment_status);
    const employmentData = maidsByStatus.map(item => parseInt(item.total));
    const employmentStatusChart = new Chart(ctxEmployment, {
      type: "bar",
      data: {
        labels: employmentLabels,
        datasets: [{
          label: "Employment Status",
          data: employmentData,
          backgroundColor: [
            "rgba(54, 162, 235, 0.5)",
            "rgba(75, 192, 192, 0.5)",
            "rgba(255, 99, 132, 0.5)"
          ],
          borderColor: [
            "rgba(54, 162, 235, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(255, 99, 132, 1)"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    window.chartInstances.push(employmentStatusChart);
  }
}
function renderCharts() {
  reinitializeCharts();
}

function renderDashCharts() {
  reinitializeDashCharts();
}


