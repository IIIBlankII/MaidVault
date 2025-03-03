document.addEventListener("DOMContentLoaded", function () {
    // Dropdown toggles for Maids and Clients
    document.getElementById("maid-btn").addEventListener("click", function () {
        document.getElementById("maid-dropdown").classList.toggle("hidden");
    });

    document.getElementById("client-btn").addEventListener("click", function () {
        document.getElementById("client-dropdown").classList.toggle("hidden");
    });

    // Load pages dynamically when sidebar links are clicked
    document.querySelectorAll('a[onclick^="loadPage"]').forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const page = this.getAttribute("onclick").match(/'([^']+)'/)[1];
            loadPage(page);
        });
    });

    // Function to load PHP pages dynamically
    function loadPage(page) {
        const mainContent = document.getElementById("main-content");
        mainContent.innerHTML = '<p class="text-gray-500">Loading...</p>'; // Optional loading indicator

        fetch(`../../views/dashboard/${page}.php`)
            .then(response => {
                if (!response.ok) throw new Error(`Failed to load ${page}`);
                return response.text();
            })
            .then(html => {
                mainContent.innerHTML = html;
                setTimeout(() => reinitializeCharts(), 100); // Ensure charts are reloaded
            })
            .catch(error => {
                console.error(error);
                mainContent.innerHTML = '<p class="text-red-500">Error loading content.</p>';
            });
    }

    // Reinitialize charts after loading new content
    function reinitializeCharts() {
        // Dashboard charts
        const maidGrowth = document.getElementById('maidGrowthChart');
        if (maidGrowth) {
            new Chart(maidGrowth.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Number of Maids',
                        data: [10, 20, 30, 40, 50],
                        borderColor: '#4F46E5',
                        borderWidth: 2,
                        fill: false
                    }]
                }
            });
        }

        const clientActivity = document.getElementById('clientActivityChart');
        if (clientActivity) {
            new Chart(clientActivity.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Inactive'],
                    datasets: [{
                        data: [70, 30],
                        backgroundColor: ['#6366F1', '#CBD5E1']
                    }]
                }
            });
        }

        const salesOverview = document.getElementById('salesOverviewChart');
        if (salesOverview) {
            new Chart(salesOverview.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Total Sales',
                        data: [1000, 1200, 1500, 1700, 2000],
                        backgroundColor: '#4F46E5'
                    }]
                }
            });
        }

        // Analytics charts (added for analytics.php)
        const growthChart = document.getElementById('growthChart');
        if (growthChart) {
            new Chart(growthChart.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Growth Analysis',
                        data: [15, 25, 35, 45, 55],
                        borderColor: '#A78BFA',
                        borderWidth: 2,
                        fill: false
                    }]
                }
            });
        }

        const activePercentageChart = document.getElementById('activePercentageChart');
        if (activePercentageChart) {
            new Chart(activePercentageChart.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Inactive'],
                    datasets: [{
                        data: [80, 20],
                        backgroundColor: ['#A78BFA', '#4B5563']
                    }]
                }
            });
        }
    }
});
