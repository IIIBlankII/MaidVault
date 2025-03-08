<?php
session_start();
require_once '../../models/Maid.php';

if (!isset($_GET['maid_id'])) {
    echo "No maid specified.";
    exit;
}

$maid_id = intval($_GET['maid_id']);

// Retrieve maid details using the Maid model method
$maid = Maid::getMaidById($maid_id);

if (!$maid) {
    echo "Maid not found.";
    exit;
}

function calculate_age($dob) {
    $birthDate = new DateTime($dob);
    $today = new DateTime('today');
    return $birthDate->diff($today)->y;
}

$age = calculate_age($maid['date_of_birth']);

// Format the created_at and updated_at dates
$createdAt = date('d-m-Y (h:i A)', strtotime($maid['created_at']));
$updatedAt = date('d-m-Y (h:i A)', strtotime($maid['updated_at']));
?>

<div class="p-4">
    <!-- Top bar with Back and conditional Edit button -->
    <div class="flex justify-between items-center mb-4">
        <button onclick="loadPage('maids')" class="bg-gray-500 text-white px-4 py-2 rounded-md">Back</button>
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <button onclick="loadPage('edit_maids.php?maid_id=<?php echo htmlspecialchars($maid['maid_id']); ?>')" class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</button>
        <?php endif; ?>
    </div>
    
    <h1 class="text-2xl font-semibold mb-4">Maid Details: <?php echo htmlspecialchars($maid['fname'] . " " . $maid['lname']); ?></h1>
    
    <!-- Basic Information Section -->
    <div class="bg-white p-4 shadow-md rounded-md mb-4">
        <h2 class="text-xl font-semibold mb-2">Basic Information</h2>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($maid['maid_id']); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($maid['fname'] . " " . $maid['lname']); ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($maid['date_of_birth']); ?></p>
        <p><strong>Skills:</strong> <?php echo htmlspecialchars($maid['skills']); ?></p>
        <p><strong>Employment Status:</strong> <?php echo htmlspecialchars($maid['employment_status']); ?></p>
    </div>
    
    <!-- Visa Details Section -->
    <div class="bg-white p-4 shadow-md rounded-md">
        <h2 class="text-xl font-semibold mb-2">Visa Details</h2>
        <?php if (!empty($maid['visa_type'])): ?>
            <p><strong>Visa Type:</strong> <?php echo htmlspecialchars($maid['visa_type']); ?></p>
            <p><strong>Visa Number:</strong> <?php echo htmlspecialchars($maid['visa_number']); ?></p>
            <p><strong>Date of Issue:</strong> <?php echo htmlspecialchars($maid['date_of_issue']); ?></p>
            <p><strong>Expiration Date:</strong> <?php echo htmlspecialchars($maid['expiration_date']); ?></p>
            <p><strong>Visa Duration:</strong> <?php echo htmlspecialchars($maid['visa_duration']); ?></p>
            <p><strong>Work Permit Status:</strong> <?php echo htmlspecialchars($maid['work_permit_status']); ?></p>
            <p><strong>Passport Number:</strong> <?php echo htmlspecialchars($maid['passport_number']); ?></p>
            <p><strong>Issuing Country:</strong> <?php echo htmlspecialchars($maid['issuing_country']); ?></p>
            <p><strong>Immigration Reference Number:</strong> <?php echo htmlspecialchars($maid['immigration_reference_number']); ?></p>
            <p><strong>Entry Date:</strong> <?php echo htmlspecialchars($maid['entry_date']); ?></p>
            <p><strong>Exit Date:</strong> <?php echo htmlspecialchars($maid['exit_date']); ?></p>
        <?php else: ?>
            <p>No visa details available.</p>
        <?php endif; ?>
    </div>
    
    <!-- Visa Image Section -->
    <?php if (!empty($maid['visa_image'])): ?>
    <div class="bg-white p-4 shadow-md rounded-md mt-4">
        <h2 class="text-xl font-semibold mb-2">Visa Image</h2>
        <img src="../../<?php echo htmlspecialchars($maid['visa_image']); ?>" alt="Visa Image" class="w-40 h-auto border rounded-md">
    </div>
    <?php endif; ?>
    
    <!-- Created and Updated Dates Section -->
    <div class="bg-white p-4 shadow-md rounded-md mt-4">
        <p><strong>Created at:</strong> <?php echo $createdAt; ?></p>
        <p><strong>Updated at:</strong> <?php echo $updatedAt; ?></p>
    </div>
</div>
