<?php
session_start();
require_once '../../models/Client.php';

if (!isset($_GET['client_id'])) {
    echo "No client specified.";
    exit;
}

$client_id = intval($_GET['client_id']);
$client = Client::getClientById($client_id);

if (!$client) {
    echo "Client not found.";
    exit;
}

// Format created_at and updated_at dates in "day-month-year (time in am and pm)" format.
$createdAt = date('d-m-Y (h:i A)', strtotime($client['created_at']));
$updatedAt = date('d-m-Y (h:i A)', strtotime($client['updated_at']));
?>

<div class="p-4">
    <!-- Top bar with Back and Edit button -->
    <div class="flex justify-between items-center mb-4">
        <button onclick="loadPage('clients')" class="bg-gray-500 text-white px-4 py-2 rounded-md">Back</button>
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <a href="#" onclick="loadPage('edit_clients.php?client_id=<?php echo htmlspecialchars($client['client_id']); ?>')" class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</a>
        <?php endif; ?>
    </div>

    <h1 class="text-2xl font-semibold mb-4">Client Details: <?php echo htmlspecialchars($client['fname'] . " " . $client['lname']); ?></h1>

    <!-- Basic Information Section -->
    <div class="bg-white p-4 shadow-md rounded-md mb-4">
        <h2 class="text-xl font-semibold mb-2">Basic Information</h2>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($client['client_id']); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($client['fname'] . " " . $client['lname']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($client['address']); ?></p>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($client['contact_number']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($client['email']); ?></p>
    </div>

    <!-- Additional Information Section -->
    <div class="bg-white p-4 shadow-md rounded-md mb-4">
        <h2 class="text-xl font-semibold mb-2">Additional Information</h2>
        <p><strong>Household Size:</strong> <?php echo htmlspecialchars($client['household_size']); ?></p>
        <p><strong>Number of Children:</strong> <?php echo htmlspecialchars($client['number_of_children']); ?></p>
        <p><strong>Number of Elders:</strong> <?php echo htmlspecialchars($client['number_of_elders']); ?></p>
        <p><strong>Pets:</strong> <?php echo htmlspecialchars($client['pets']); ?></p>
        <p><strong>Notes:</strong> <?php echo htmlspecialchars($client['notes']); ?></p>
    </div>

    <!-- Maid Preference Section -->
    <div class="bg-white p-4 shadow-md rounded-md mb-4">
        <h2 class="text-xl font-semibold mb-2">Maid Preference</h2>
        <p><strong>Preferred Nationality:</strong> <?php echo htmlspecialchars($client['preferred_nationality']); ?></p>
        <p><strong>Preferred Language:</strong> <?php echo htmlspecialchars($client['preferred_language']); ?></p>
        <p><strong>Work Type:</strong> <?php echo htmlspecialchars($client['work_type']); ?></p>
        <p><strong>Special Requirements:</strong> <?php echo htmlspecialchars($client['special_requirements']); ?></p>
    </div>

    <!-- Created and Updated Dates Section -->
    <div class="bg-white p-4 shadow-md rounded-md">
        <p><strong>Created at:</strong> <?php echo $createdAt; ?></p>
        <p><strong>Updated at:</strong> <?php echo $updatedAt; ?></p>
    </div>

    <!-- Delete Button Section (Admin Only) -->
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
    <div class="mt-4" id="deleteButtonContainer" data-client-id="<?php echo htmlspecialchars($client['client_id']); ?>">
        <button id="deleteButton" onclick="showConfirmDelete(event)" class="bg-red-500 text-white px-4 py-2 rounded-md">
            Delete
        </button>
    </div>
    <?php endif; ?>
</div>

<script>
    // Show confirm delete button in place of the delete button
    function showConfirmDelete(event) {
        event.stopPropagation(); // Prevent the event from bubbling up immediately
        const container = document.getElementById('deleteButtonContainer');
        const clientId = container.getAttribute('data-client-id');
        container.innerHTML = `<button id="confirmDeleteButton" onclick="performDelete(${clientId}); event.stopPropagation();" class="bg-red-700 text-white px-4 py-2 rounded-md">
            Confirm Delete
        </button>`;
        
        // Add a global click listener to detect clicks outside the container
        setTimeout(() => {
            document.addEventListener('click', handleClickOutside);
        }, 0);
    }
    
    // Revert the confirm delete button back to the original delete button when clicking outside
    function handleClickOutside(event) {
        const container = document.getElementById('deleteButtonContainer');
        if (!container.contains(event.target)) {
            const clientId = container.getAttribute('data-client-id');
            container.innerHTML = `<button id="deleteButton" onclick="showConfirmDelete(event)" class="bg-red-500 text-white px-4 py-2 rounded-md">
                Delete
            </button>`;
            document.removeEventListener('click', handleClickOutside);
        }
    }
    
    // Perform the deletion after final confirmation
    function performDelete(clientId) {
        loadPage('../../controllers/deleteClientController.php?client_id=' + clientId);
    }
</script>
