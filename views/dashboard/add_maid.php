<?php
require_once '../../models/Maid.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['maid_fname'];
    $lastName = $_POST['maid_lname'];
    $dob = $_POST['maid_dob'];
    $nationality = $_POST['maid_nationality'];
    $skills = $_POST['maid_skills'];
    $status = $_POST['maid_status'];

    // Call the Maid class method to add the maid to the database
    $result = Maid::addMaid($firstName, $lastName, $dob, $nationality, $skills, $status);

    if ($result) {
        echo "<p class='text-green-500'>Maid added successfully!</p>";
    } else {
        echo "<p class='text-red-500'>Error: Could not add maid to the database.</p>";
    }
}
?>

<h1 class="text-2xl font-semibold mb-4">Add New Maid</h1>
<form id="addMaidForm" action="add_maid.php" method="POST" class="bg-white p-4 shadow-md rounded-md">
    <div class="mb-4">
        <label class="block text-gray-700">First Name</label>
        <input type="text" name="maid_fname" id="maidFName" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Last Name</label>
        <input type="text" name="maid_lname" id="maidLName" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Date of Birth</label>
        <input type="date" name="maid_dob" id="maidDob" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Nationality</label>
        <input type="text" name="maid_nationality" id="maidNationality" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Skills</label>
        <textarea name="maid_skills" id="maidSkills" rows="4" class="w-full px-3 py-2 border rounded-md" required></textarea>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Employment Status</label>
        <select name="maid_status" id="maidStatus" class="w-full px-3 py-2 border rounded-md">
            <option value="Available">Available</option>
            <option value="Hired">Hired</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Maid</button>
</form>
