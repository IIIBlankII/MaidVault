
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
});

// Function to load PHP pages dynamically
function loadPage(page) {
    const mainContent = document.getElementById("main-content");
    mainContent.innerHTML = '<p class="text-gray-500">Loading...</p>';

    fetch(`../../views/dashboard/${page}.php`)
        .then(response => {
            if (!response.ok) throw new Error(`Failed to load ${page}`);
            return response.text();
        })
        .then(html => {
            mainContent.innerHTML = html;
            
            // Check for pages that need reinitializing scripts
            if (page === "calendar") {
                if (typeof initializeCalendar === "function") {
                  initializeCalendar();
                }
            }
            
            // Only reinitialize charts if analytics or maindash are loaded (fix the condition)
            if (page === "analytics" || page === "maindash") {
                setTimeout(() => reinitializeCharts(), 100);
            }
        })
        .catch(error => {
            console.error(error);
            mainContent.innerHTML = '<p class="text-red-500">Error loading content.</p>';
        });
}
