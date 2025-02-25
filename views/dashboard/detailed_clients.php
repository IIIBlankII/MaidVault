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
    <!-- Top bar with Back and conditional Edit button -->
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
    <div class="bg-white p-4 shadow-md rounded-md">
        <h2 class="text-xl font-semibold mb-2">Additional Information</h2>
        <p><strong>Company Name:</strong> <?php echo htmlspecialchars($client['company_name']); ?></p>
        <p><strong>Notes:</strong> <?php echo htmlspecialchars($client['notes']); ?></p>
    </div>
    
    <!-- Created and Updated Dates Section -->
    <div class="bg-white p-4 shadow-md rounded-md mt-4">
        <p><strong>Created at:</strong> <?php echo $createdAt; ?></p>
        <p><strong>Updated at:</strong> <?php echo $updatedAt; ?></p>
    </div>
</div>
