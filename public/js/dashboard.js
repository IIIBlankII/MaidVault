document.addEventListener("DOMContentLoaded", function () {
    
    function setupDropdown(buttonId, dropdownId) {
        const button = document.getElementById(buttonId);
        const dropdown = document.getElementById(dropdownId);

        if (button && dropdown) {
            button.addEventListener("click", function () {
                dropdown.classList.toggle("hidden");
            });
        }
    }

    
    setupDropdown("maid-btn", "maid-dropdown");
    setupDropdown("client-btn", "client-dropdown");
    setupDropdown("document-btn", "document-dropdown");

    
    window.loadPage = function (page) {
        fetch(`../../views/dashboard/${page}.php`)
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

    
    if (typeof userRole !== "undefined" && userRole !== "admin") {
        const addMaidOption = document.getElementById("add-maid-option");
        const addClientOption = document.getElementById("add-client-option");

        if (addMaidOption) addMaidOption.style.display = "none";
        if (addClientOption) addClientOption.style.display = "none";
    }
});
