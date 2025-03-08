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
        <p><strong>Nationality:</strong> <?php echo htmlspecialchars($maid['nationality']); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($maid['date_of_birth']); ?></p>
        <p><strong>Language:</strong> <?php echo htmlspecialchars($maid['language']); ?></p>
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
    
    <!-- Passport Image Section (new) -->
    <?php if (!empty($maid['passport_image'])): ?>
    <div class="bg-white p-4 shadow-md rounded-md mt-4">
        <h2 class="text-xl font-semibold mb-2">Passport Image</h2>
        <img src="../../<?php echo htmlspecialchars($maid['passport_image']); ?>" 
             alt="Passport Image" 
             class="w-full h-auto border rounded-md">
    </div>
    <!-- Existing Visa Image Section (optional) -->
    <?php if (!empty($maid['visa_image'])): ?>
    <div class="bg-white p-4 shadow-md rounded-md mt-4">
        <h2 class="text-xl font-semibold mb-2">Visa Image</h2>
        <img src="../../<?php echo htmlspecialchars($maid['visa_image']); ?>" 
             alt="Visa Image" 
             class="w-full h-auto border rounded-md">
    </div>
    <?php endif; ?>
    <?php endif; ?>
    
    <!-- Work Permit Image Section (new) -->
    <?php if (!empty($maid['work_permit_image'])): ?>
    <div class="bg-white p-4 shadow-md rounded-md mt-4">
        <h2 class="text-xl font-semibold mb-2">Work Permit Image</h2>
        <img src="../../<?php echo htmlspecialchars($maid['work_permit_image']); ?>" 
             alt="Work Permit Image" 
             class="w-full h-auto border rounded-md">
    </div>
    <?php endif; ?>
    
    <!-- Created and Updated Dates Section -->
    <div class="bg-white p-4 shadow-md rounded-md mt-4">
        <p><strong>Created at:</strong> <?php echo $createdAt; ?></p>
        <p><strong>Updated at:</strong> <?php echo $updatedAt; ?></p>
    </div>
    
    <!-- Delete Button Section -->
    <div class="mt-4" id="deleteButtonContainer" data-maid-id="<?php echo htmlspecialchars($maid['maid_id']); ?>">
        <button id="deleteButton" onclick="showConfirmDelete(event)" class="bg-red-500 text-white px-4 py-2 rounded-md">
            Delete
        </button>
    </div>
</div>

<script>
    // Show confirm delete button in place of the delete button
    function showConfirmDelete(event) {
        event.stopPropagation(); // Prevent the event from bubbling up immediately
        const container = document.getElementById('deleteButtonContainer');
        const maidId = container.getAttribute('data-maid-id');
        container.innerHTML = `<button id="confirmDeleteButton" onclick="performDelete(${maidId}); event.stopPropagation();" class="bg-red-700 text-white px-4 py-2 rounded-md">
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
            const maidId = container.getAttribute('data-maid-id');
            container.innerHTML = `<button id="deleteButton" onclick="showConfirmDelete(event)" class="bg-red-500 text-white px-4 py-2 rounded-md">
                Delete
            </button>`;
            document.removeEventListener('click', handleClickOutside);
        }
    }
    
    // Perform the deletion after final confirmation
    function performDelete(maidId) {
        loadPage('../../controllers/deleteMaidController.php?maid_id=' + maidId);
    }
</script>
