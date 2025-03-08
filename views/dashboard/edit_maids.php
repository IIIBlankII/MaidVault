<?php
session_start();
require_once '../../includes/db_connect.php';

if (!isset($_GET['maid_id'])) {
    echo "No maid specified.";
    exit;
}

$maid_id = intval($_GET['maid_id']);

// Updated SELECT query to include language, nationality, passport_image and work_permit_image
$stmt = $conn->prepare("SELECT m.maid_id, m.fname, m.lname, m.date_of_birth, m.language, m.skills, m.employment_status, m.nationality,
                               v.visa_type, v.visa_number, v.date_of_issue, v.expiration_date, v.visa_duration,
                               v.work_permit_status, v.passport_number, v.issuing_country, v.immigration_reference_number,
                               v.entry_date, v.exit_date, v.visa_image, v.passport_image, v.work_permit_image
                        FROM maid m
                        LEFT JOIN visa_details v ON m.visa_details_id = v.id
                        WHERE m.maid_id = ?");
$stmt->bind_param("i", $maid_id);
$stmt->execute();
$result = $stmt->get_result();
$maid = $result->fetch_assoc();

if (!$maid) {
    echo "Maid not found.";
    exit;
}
?>

<div class="p-4">
    <!-- Top bar with Back button -->
    <div class="flex justify-between items-center mb-4">
        <button onclick="loadPage('detailed_maids.php?maid_id=<?php echo htmlspecialchars($maid['maid_id']); ?>')" class="bg-gray-500 text-white px-4 py-2 rounded-md">Back</button>
    </div>
    
    <h1 class="text-2xl font-semibold mb-4">Edit Maid</h1>
    <!-- Added enctype for file uploads -->
    <form id="editMaidForm" method="POST" action="../../controllers/updateMaidAndVisaController.php" class="space-y-6" enctype="multipart/form-data">
        <!-- Hidden field to pass maid_id -->
        <input type="hidden" name="maid_id" value="<?php echo htmlspecialchars($maid['maid_id']); ?>">
        
        <!-- Maid Details Section -->
        <div class="bg-white p-4 shadow-md rounded-md">
            <h2 class="text-xl font-semibold mb-4">Maid Details</h2>
            <div class="mb-4">
                <label class="block text-gray-700">First Name</label>
                <input type="text" name="fname" value="<?php echo htmlspecialchars($maid['fname']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Last Name</label>
                <input type="text" name="lname" value="<?php echo htmlspecialchars($maid['lname']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <!-- Nationality Field -->
            <div class="mb-4">
                <label class="block text-gray-700">Nationality</label>
                <input type="text" name="nationality" value="<?php echo htmlspecialchars($maid['nationality']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($maid['date_of_birth']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <!-- New Language Field Below Date of Birth -->
            <div class="mb-4">
                <label class="block text-gray-700">Language</label>
                <input type="text" name="language" value="<?php echo htmlspecialchars($maid['language']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Skills</label>
                <textarea name="skills" required class="w-full px-3 py-2 border rounded-md"><?php echo htmlspecialchars($maid['skills']); ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Employment Status</label>
                <select name="employment_status" required class="w-full px-3 py-2 border rounded-md">
                    <option value="Available" <?php echo ($maid['employment_status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                    <option value="Hired" <?php echo ($maid['employment_status'] == 'Hired') ? 'selected' : ''; ?>>Hired</option>
                    <option value="Inactive" <?php echo ($maid['employment_status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
        </div>
        
        <!-- Passport Image Section (new) -->
        <div class="bg-white p-4 shadow-md rounded-md mb-4">
            <h2 class="text-xl font-semibold mb-4">Passport Image</h2>
            <?php if (!empty($maid['passport_image'])): ?>
                <div class="mb-2">
                    <img src="../../<?php echo htmlspecialchars($maid['passport_image']); ?>" alt="Passport Image" class="w-40 h-auto border rounded-md">
                </div>
            <?php endif; ?>
            <input type="file" name="passport_image" accept="image/*" class="w-full px-3 py-2 border rounded-md">
        </div>
    
        <!-- Visa Details Section -->
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <h2 class="text-xl font-semibold mb-4">Visa Details</h2>
            <div class="mb-4">
                <label class="block text-gray-700">Visa Type</label>
                <input type="text" name="visa_type" value="<?php echo htmlspecialchars($maid['visa_type']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Visa Number</label>
                <input type="text" name="visa_number" value="<?php echo htmlspecialchars($maid['visa_number']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Date of Issue</label>
                <input type="date" name="date_of_issue" value="<?php echo htmlspecialchars($maid['date_of_issue']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Expiration Date</label>
                <input type="date" name="expiration_date" value="<?php echo htmlspecialchars($maid['expiration_date']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Visa Duration</label>
                <input type="text" name="visa_duration" value="<?php echo htmlspecialchars($maid['visa_duration']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Work Permit Status</label>
                <input type="text" name="work_permit_status" value="<?php echo htmlspecialchars($maid['work_permit_status']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Passport Number</label>
                <input type="text" name="passport_number" value="<?php echo htmlspecialchars($maid['passport_number']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Issuing Country</label>
                <input type="text" name="issuing_country" value="<?php echo htmlspecialchars($maid['issuing_country']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Immigration Reference Number</label>
                <input type="text" name="immigration_reference_number" value="<?php echo htmlspecialchars($maid['immigration_reference_number']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Entry Date</label>
                <input type="date" name="entry_date" value="<?php echo htmlspecialchars($maid['entry_date']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Exit Date</label>
                <input type="date" name="exit_date" value="<?php echo htmlspecialchars($maid['exit_date']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <!-- Visa Image Upload Field -->
            <div class="mb-4">
                <label class="block text-gray-700">Visa Image</label>
                <?php if (!empty($maid['visa_image'])): ?>
                    <div class="mb-2">
                        <img src="../../<?php echo htmlspecialchars($maid['visa_image']); ?>" alt="Visa Image" class="w-40 h-auto border rounded-md">
                    </div>
                <?php endif; ?>
                <input type="file" name="visa_image" accept="image/*" class="w-full px-3 py-2 border rounded-md">
            </div>
        </div>
    
        <!-- Work Permit Image Section (new) -->
        <div class="bg-white p-4 shadow-md rounded-md mt-4">
            <h2 class="text-xl font-semibold mb-4">Work Permit Image</h2>
            <?php if (!empty($maid['work_permit_image'])): ?>
                <div class="mb-2">
                    <img src="../../<?php echo htmlspecialchars($maid['work_permit_image']); ?>" alt="Work Permit Image" class="w-40 h-auto border rounded-md">
                </div>
            <?php endif; ?>
            <input type="file" name="work_permit_image" accept="image/*" class="w-full px-3 py-2 border rounded-md">
        </div>
        <input type="hidden" name="existing_visa_image" value="<?php echo htmlspecialchars($maid['visa_image']); ?>">
        <input type="hidden" name="existing_passport_image" value="<?php echo htmlspecialchars($maid['passport_image']); ?>">
        <input type="hidden" name="existing_work_permit_image" value="<?php echo htmlspecialchars($maid['work_permit_image']); ?>">
    
        <!-- Single Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Maid</button>
    </form>
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
