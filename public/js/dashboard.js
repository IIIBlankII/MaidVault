document.addEventListener("DOMContentLoaded", function () {
    // Function to toggle dropdown menus
    function setupDropdown(buttonId, dropdownId) {
        const button = document.getElementById(buttonId);
        const dropdown = document.getElementById(dropdownId);

        button.addEventListener("click", function () {
            dropdown.classList.toggle("hidden");
        });
    }

    // Set up dropdowns
    setupDropdown("maid-btn", "maid-dropdown");
    setupDropdown("client-btn", "client-dropdown");
    setupDropdown("document-btn", "document-dropdown");

    // Function to dynamically load content
    window.loadPage = function (page) {
        fetch(`../../views/dashboard/${page}.html`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Page not found");
                }
                return response.text();
            })
            .then(html => {
                document.getElementById("main-content").innerHTML = html;
            })
            .catch(error => {
                console.error("Error loading page:", error);
                document.getElementById("main-content").innerHTML = "<h2 class='text-red-500 text-center mt-10'>⚠️ Page Not Found</h2>";
            });
    };
});
