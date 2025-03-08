<?php
session_start();
require_once '../../includes/db_connect.php';

if (!isset($_GET['client_id'])) {
    echo "No client specified.";
    exit;
}

$client_id = intval($_GET['client_id']);

$stmt = $conn->prepare("SELECT client_id, fname, lname, address, contact_number, email, household_size, number_of_children, number_of_elders, pets, preferred_nationality, preferred_language, work_type, special_requirements, notes FROM client WHERE client_id = ?");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();

if (!$client) {
    echo "Client not found.";
    exit;
}
?>

<div class="p-4">
    <!-- Top bar with Back button -->
    <div class="flex justify-between items-center mb-4">
        <button onclick="loadPage('detailed_clients.php?client_id=<?php echo htmlspecialchars($client['client_id']); ?>')" class="bg-gray-500 text-white px-4 py-2 rounded-md">Back</button>
    </div>
    
    <h1 class="text-2xl font-semibold mb-4">Edit Client</h1>
    <form id="editClientForm" method="POST" action="../../controllers/updateClientController.php" class="space-y-6">
        <!-- Hidden field to pass client_id -->
        <input type="hidden" name="client_id" value="<?php echo htmlspecialchars($client['client_id']); ?>">
        
        <!-- Client Details Section -->
        <div class="bg-white p-4 shadow-md rounded-md">
            <h2 class="text-xl font-semibold mb-4">Client Details</h2>
            <div class="mb-4">
                <label class="block text-gray-700">First Name</label>
                <input type="text" name="fname" value="<?php echo htmlspecialchars($client['fname']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Last Name</label>
                <input type="text" name="lname" value="<?php echo htmlspecialchars($client['lname']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Address</label>
                <textarea name="address" required class="w-full px-3 py-2 border rounded-md"><?php echo htmlspecialchars($client['address']); ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Contact Number</label>
                <input type="text" name="contact_number" value="<?php echo htmlspecialchars($client['contact_number']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required class="w-full px-3 py-2 border rounded-md">
            </div>
        </div>
        
        <!-- Additional Information Section -->
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <h2 class="text-xl font-semibold mb-4">Additional Information</h2>
            <div class="mb-4">
                <label class="block text-gray-700">Household Size</label>
                <input type="number" name="household_size" value="<?php echo htmlspecialchars($client['household_size']); ?>" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Number of Children</label>
                <input type="number" name="number_of_children" value="<?php echo htmlspecialchars($client['number_of_children']); ?>" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Number of Elders</label>
                <input type="number" name="number_of_elders" value="<?php echo htmlspecialchars($client['number_of_elders']); ?>" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Pets</label>
                <select name="pets" class="w-full px-3 py-2 border rounded-md">
                    <option value="None" <?php if ($client['pets'] == "None") echo "selected"; ?>>None</option>
                    <option value="Dogs" <?php if ($client['pets'] == "Dogs") echo "selected"; ?>>Dogs</option>
                    <option value="Cats" <?php if ($client['pets'] == "Cats") echo "selected"; ?>>Cats</option>
                    <option value="Other" <?php if ($client['pets'] == "Other") echo "selected"; ?>>Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Notes</label>
                <textarea name="notes" class="w-full px-3 py-2 border rounded-md"><?php echo htmlspecialchars($client['notes']); ?></textarea>
            </div>
        </div>
        
        <!-- Maid Preference Section -->
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <h2 class="text-xl font-semibold mb-4">Maid Preference</h2>
            <div class="mb-4">
                <label class="block text-gray-700">Preferred Nationality</label>
                <input type="text" name="preferred_nationality" value="<?php echo htmlspecialchars($client['preferred_nationality']); ?>" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Preferred Language</label>
                <input type="text" name="preferred_language" value="<?php echo htmlspecialchars($client['preferred_language']); ?>" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Work Type</label>
                <select name="work_type" required class="w-full px-3 py-2 border rounded-md">
                    <option value="Full-time" <?php if ($client['work_type'] == "Full-time") echo "selected"; ?>>Full-time</option>
                    <option value="Part-time" <?php if ($client['work_type'] == "Part-time") echo "selected"; ?>>Part-time</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Special Requirements</label>
                <textarea name="special_requirements" class="w-full px-3 py-2 border rounded-md"><?php echo htmlspecialchars($client['special_requirements']); ?></textarea>
            </div>
        </div>
        
        <!-- Single Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Client</button>
    </form>
</div>
