
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
    
    function refreshEventsAndCalendar() {
      fetch('../../controllers/eventController.php', {
        method: 'POST'
      })
      .then(response => response.json())
      .then(data => {
        window.events = data; 
        loadPage('calendar');
      })
      .catch(error => {
        console.error("Error refreshing events:", error);
      });
    }

    document.getElementById("main-content").addEventListener("submit", function(e) {
        // Check if the submitted form is the event form (using a CSS selector)
        if (e.target && e.target.matches("#event-form form")) {
          console.log("Delegated form listener triggered");
          e.preventDefault(); // Prevent the default form submission
      
          const formData = new FormData(e.target);
          fetch('../../controllers/eventController.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              refreshEventsAndCalendar()
            } else {
              alert('Error: ' + data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
        }
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
          
          // Execute any inline scripts in the loaded HTML
          const scripts = mainContent.querySelectorAll("script");
          scripts.forEach(oldScript => {
              const newScript = document.createElement("script");
              // Copy the script content and attributes
              if (oldScript.src) {
                  newScript.src = oldScript.src;
              } else {
                  newScript.text = oldScript.innerHTML;
              }
              document.body.appendChild(newScript);
              
              document.body.removeChild(newScript);
          });
          
          // Check for pages that need reinitializing scripts
          if (page === "calendar") {
              if (typeof initializeCalendar === "function") {
                  initializeCalendar();
              }   
          }
          
          
          // Only reinitialize charts if analytics or maindash are loaded
          if (page === "analytics" ) {
              setTimeout(() => reinitializeCharts(), 100);
          }

          if (page === "maindash") {
            setTimeout(() => reinitializeDashCharts(), 100);
          }
      })
      .catch(error => {
          console.error(error);
          mainContent.innerHTML = '<p class="text-red-500">Error loading content.</p>';
      });
}

