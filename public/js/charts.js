// charts.js

// Reinitialize all charts (both Client and Maid analytics)
function reinitializeCharts() {
    // =========================
    // Client Analytics Charts
    // =========================
  
    // 1. Signups Per Day (Bar Chart)
    const ctxDay = document.getElementById("signupsPerDayChart").getContext("2d");
    const dayLabels = signupsPerDay.map(item => item.signup_date);
    const dayData = signupsPerDay.map(item => parseInt(item.total_signups));
    new Chart(ctxDay, {
      type: "bar",
      data: {
        labels: dayLabels,
        datasets: [{
          label: "Signups Per Day",
          data: dayData,
          backgroundColor: "rgba(54, 162, 235, 0.5)",
          borderColor: "rgba(54, 162, 235, 1)",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
  
    // 2. Signups Per Week (Bar Chart) with friendlier labels
    const ctxWeek = document.getElementById("signupsPerWeekChart").getContext("2d");
    const weekLabels = signupsPerWeek.map(item => {
      const str = item.signup_week.toString();
      const year = str.substring(0, 4);
      const weekNum = str.substring(4);
      return `Week ${parseInt(weekNum)}, ${year}`;
    });
    const weekData = signupsPerWeek.map(item => parseInt(item.total_signups));
    new Chart(ctxWeek, {
      type: "bar",
      data: {
        labels: weekLabels,
        datasets: [{
          label: "Signups Per Week",
          data: weekData,
          backgroundColor: "rgba(75, 192, 192, 0.5)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
  
    // 3. Signups Per Month (Line Chart)
    const ctxMonth = document.getElementById("signupsPerMonthChart").getContext("2d");
    const monthLabels = signupsPerMonth.map(item => item.signup_month);
    const monthData = signupsPerMonth.map(item => parseInt(item.total_signups));
    new Chart(ctxMonth, {
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
  
    // 4. Clients By City (Pie Chart)
    const ctxCity = document.getElementById("clientsByCityChart").getContext("2d");
    const cityLabels = clientsByCity.map(item => item.city);
    const cityData = clientsByCity.map(item => parseInt(item.total_clients));
    new Chart(ctxCity, {
      type: "pie",
      data: {
        labels: cityLabels,
        datasets: [{
          label: "Clients By City",
          data: cityData,
          backgroundColor: [
            "rgba(255, 99, 132, 0.5)",
            "rgba(54, 162, 235, 0.5)",
            "rgba(255, 206, 86, 0.5)",
            "rgba(75, 192, 192, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 159, 64, 0.5)"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  
    // 5. Average Family Metrics (Bar Chart)
    const ctxFamily = document.getElementById("familyMetricsChart").getContext("2d");
    const familyLabels = ["Household Size", "Children", "Elders"];
    const familyData = [
      parseFloat(averageFamilyMetrics.avg_household_size).toFixed(2),
      parseFloat(averageFamilyMetrics.avg_children).toFixed(2),
      parseFloat(averageFamilyMetrics.avg_elders).toFixed(2)
    ];
    new Chart(ctxFamily, {
      type: "bar",
      data: {
        labels: familyLabels,
        datasets: [{
          label: "Average Family Metrics",
          data: familyData,
          backgroundColor: [
            "rgba(255, 159, 64, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 205, 86, 0.5)"
          ],
          borderColor: [
            "rgba(255, 159, 64, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 205, 86, 1)"
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
  
    // 6. Preferred Nationality Distribution (Pie Chart)
    const ctxPrefNat = document.getElementById("preferredNationalityChart").getContext("2d");
    const prefNatLabels = preferredNationalityDistribution.map(item => item.preferred_nationality || "Not Specified");
    const prefNatData = preferredNationalityDistribution.map(item => parseInt(item.total));
    new Chart(ctxPrefNat, {
      type: "pie",
      data: {
        labels: prefNatLabels,
        datasets: [{
          label: "Preferred Nationality",
          data: prefNatData,
          backgroundColor: [
            "rgba(255, 99, 132, 0.5)",
            "rgba(54, 162, 235, 0.5)",
            "rgba(255, 206, 86, 0.5)",
            "rgba(75, 192, 192, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 159, 64, 0.5)"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  
    // 7. Preferred Language Distribution (Pie Chart)
    const ctxPrefLang = document.getElementById("preferredLanguageChart").getContext("2d");
    const prefLangLabels = preferredLanguageDistribution.map(item => item.preferred_language || "Not Specified");
    const prefLangData = preferredLanguageDistribution.map(item => parseInt(item.total));
    new Chart(ctxPrefLang, {
      type: "pie",
      data: {
        labels: prefLangLabels,
        datasets: [{
          label: "Preferred Language",
          data: prefLangData,
          backgroundColor: [
            "rgba(75, 192, 192, 0.5)",
            "rgba(255, 205, 86, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 99, 132, 0.5)",
            "rgba(54, 162, 235, 0.5)"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  
    // 8. Work Type Distribution (Pie Chart)
    const ctxWorkType = document.getElementById("workTypeChart").getContext("2d");
    const workTypeLabels = workTypeDistribution.map(item => item.work_type);
    const workTypeData = workTypeDistribution.map(item => parseInt(item.total));
    new Chart(ctxWorkType, {
      type: "pie",
      data: {
        labels: workTypeLabels,
        datasets: [{
          label: "Work Type Distribution",
          data: workTypeData,
          backgroundColor: [
            "rgba(255, 159, 64, 0.5)",
            "rgba(255, 99, 132, 0.5)",
            "rgba(75, 192, 192, 0.5)"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  
    // =========================
    // Maid Analytics Charts
    // =========================
  
    // 9. Employment Status Breakdown (Bar Chart)
    const ctxEmployment = document.getElementById("employmentStatusChart").getContext("2d");
    const employmentLabels = maidsByStatus.map(item => item.employment_status);
    const employmentData = maidsByStatus.map(item => parseInt(item.total));
    new Chart(ctxEmployment, {
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
    
    // 10. Nationality Alignment Chart (Bar Chart)
    const ctxNatAlign = document.getElementById("nationalityAlignmentChart").getContext("2d");
    const natAlignPercentage = parseFloat(nationalityAlignment.percentage).toFixed(2);
    new Chart(ctxNatAlign, {
        type: "bar",
        data: {
            labels: ["Nationality Alignment"],
            datasets: [{
                label: `Matching ${nationalityAlignment.common_nationality}`,
                data: [natAlignPercentage],
                backgroundColor: "rgba(54, 162, 235, 0.5)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true, max: 100 } }
        }
    });
    
    // 11. Age Distribution (Bar Chart)
    const ctxAge = document.getElementById("ageDistributionChart").getContext("2d");
    const ageLabels = ageDistribution.map(item => item.age);
    const ageData = ageDistribution.map(item => parseInt(item.total));
    new Chart(ctxAge, {
      type: "bar",
      data: {
        labels: ageLabels,
        datasets: [{
          label: "Age Distribution",
          data: ageData,
          backgroundColor: "rgba(255, 206, 86, 0.5)",
          borderColor: "rgba(255, 206, 86, 1)",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    
    // 12. Maid Language Breakdown (Pie Chart)
    const ctxMaidLang = document.getElementById("languageBreakdownChart").getContext("2d");
    const maidLangLabels = languageBreakdown.map(item => item.language);
    const maidLangData = languageBreakdown.map(item => parseInt(item.total));
    new Chart(ctxMaidLang, {
      type: "pie",
      data: {
        labels: maidLangLabels,
        datasets: [{
          label: "Maid Language Breakdown",
          data: maidLangData,
          backgroundColor: [
            "rgba(75, 192, 192, 0.5)",
            "rgba(255, 205, 86, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 99, 132, 0.5)"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    
    // 13. Maid Nationality Breakdown (Pie Chart)
    const ctxMaidNat = document.getElementById("nationalityBreakdownChart").getContext("2d");
    const maidNatLabels = nationalityBreakdown.map(item => item.nationality);
    const maidNatData = nationalityBreakdown.map(item => parseInt(item.total));
    new Chart(ctxMaidNat, {
      type: "pie",
      data: {
        labels: maidNatLabels,
        datasets: [{
          label: "Maid Nationality Breakdown",
          data: maidNatData,
          backgroundColor: [
            "rgba(255, 99, 132, 0.5)",
            "rgba(54, 162, 235, 0.5)",
            "rgba(255, 206, 86, 0.5)",
            "rgba(75, 192, 192, 0.5)"
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
    
    // 14. Common Skills (Bar Chart)
    const ctxSkills = document.getElementById("commonSkillsChart").getContext("2d");
    const skillsLabels = commonSkills.map(item => item.skills);
    const skillsData = commonSkills.map(item => parseInt(item.total));
    new Chart(ctxSkills, {
      type: "bar",
      data: {
        labels: skillsLabels,
        datasets: [{
          label: "Common Skills",
          data: skillsData,
          backgroundColor: "rgba(255, 159, 64, 0.5)",
          borderColor: "rgba(255, 159, 64, 1)",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
      }
    });
    
    // 15. Language Alignment Chart (Bar Chart)
    const ctxLangAlign = document.getElementById("languageAlignmentChart").getContext("2d");
    const langAlignPercentage = parseFloat(languageAlignment.percentage).toFixed(2);
    new Chart(ctxLangAlign, {
        type: "bar",
        data: {
            labels: ["Language Alignment"],
            datasets: [{
                label: `Matching ${languageAlignment.common_language}`,
                data: [langAlignPercentage],
                backgroundColor: "rgba(255, 159, 64, 0.5)",
                borderColor: "rgba(255, 159, 64, 1)",
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true, max: 100 } }
        }
    });

    // =========================
    // Visa Analytics Charts
    // =========================

    // 16. Upcoming Visa Expiration Alerts
    const ctxVisaExp = document.getElementById("visaExpirationChart").getContext("2d");
    // Example: Create a simple bar chart using expiration dates (or count per date)
    // (You may need to process upcomingExpirations data to group by date)
    const expLabels = upcomingExpirations.map(item => item.expiration_date);
    const expData = upcomingExpirations.map(item => 1); // or count them if grouped
    new Chart(ctxVisaExp, {
        type: "bar",
        data: {
            labels: expLabels,
            datasets: [{
                label: "Expiring Visas",
                data: expData,
                backgroundColor: "rgba(255, 99, 132, 0.5)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });

    // 17. Distribution of Visa Types & Work Permit Statuses
    const ctxVisaType = document.getElementById("visaTypeChart").getContext("2d");
    // Process visaTypeDistribution data to create labels (e.g., "Type A / Permit OK")
    const visaTypeLabels = visaTypeDistribution.map(item => item.visa_type + " / " + item.work_permit_status);
    const visaTypeData = visaTypeDistribution.map(item => parseInt(item.total));
    new Chart(ctxVisaType, {
        type: "pie",
        data: {
            labels: visaTypeLabels,
            datasets: [{
                label: "Visa Types & Work Permit Statuses",
                data: visaTypeData,
                backgroundColor: [
                    "rgba(54, 162, 235, 0.5)",
                    "rgba(255, 206, 86, 0.5)",
                    "rgba(255, 99, 132, 0.5)",
                    "rgba(75, 192, 192, 0.5)",
                    "rgba(153, 102, 255, 0.5)"
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // 18. Average Visa Duration (Days)
    const ctxVisaDuration = document.getElementById("visaDurationChart").getContext("2d");
    const avgDuration = parseFloat(averageVisaDuration.avg_duration).toFixed(2);
    new Chart(ctxVisaDuration, {
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

}
  
function renderCharts() {
    reinitializeCharts();
}
  