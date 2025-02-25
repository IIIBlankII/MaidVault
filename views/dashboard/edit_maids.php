<?php
session_start();
require_once '../../includes/db_connect.php';

if (!isset($_GET['maid_id'])) {
    echo "No maid specified.";
    exit;
}

$maid_id = intval($_GET['maid_id']);

$stmt = $conn->prepare("SELECT m.maid_id, m.fname, m.lname, m.date_of_birth, m.skills, m.employment_status,
                               v.visa_type, v.visa_number, v.date_of_issue, v.expiration_date, v.visa_duration,
                               v.work_permit_status, v.passport_number, v.issuing_country, v.immigration_reference_number,
                               v.entry_date, v.exit_date
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
    <form id="editMaidForm" method="POST" action="../../controllers/updateMaidAndVisaController.php" class="space-y-6">
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
            <div class="mb-4">
                <label class="block text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($maid['date_of_birth']); ?>" required class="w-full px-3 py-2 border rounded-md">
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
        </div>
    
        <!-- Single Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Maid</button>
    </form>
</div>
