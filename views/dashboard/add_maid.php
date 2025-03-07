<?php
// This view file contains only the form markup.
// Form action points to the combined controller.
?>
<h1 class="text-2xl text-neutral-100 font-semibold mb-4">Add New Maid</h1>
<form id="addMaidForm" method="POST" action="../../controllers/addMaidAndVisaController.php" class="space-y-6">
    <!-- Maid Details Section -->
    <div class="bg-white p-4 shadow-md rounded-md">
        <h2 class="text-xl font-semibold mb-4">Maid Details</h2>
        <div class="mb-4">
            <label class="block text-gray-700">First Name</label>
            <input type="text" name="fname" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Last Name</label>
            <input type="text" name="lname" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Date of Birth</label>
            <input type="date" name="date_of_birth" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Skills</label>
            <textarea name="skills" required class="w-full px-3 py-2 border rounded-md"></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Employment Status</label>
            <select name="employment_status" required class="w-full px-3 py-2 border rounded-md">
                <option value="Available">Available</option>
                <option value="Hired">Hired</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
    </div>

    <!-- Visa Details Section -->
    <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Visa Details</h2>
        <div class="mb-4">
            <label class="block text-gray-700">Visa Type</label>
            <input type="text" name="visa_type" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Visa Number</label>
            <input type="text" name="visa_number" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Date of Issue</label>
            <input type="date" name="date_of_issue" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Expiration Date</label>
            <input type="date" name="expiration_date" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Visa Duration</label>
            <input type="text" name="visa_duration" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Work Permit Status</label>
            <input type="text" name="work_permit_status" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Passport Number</label>
            <input type="text" name="passport_number" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Issuing Country</label>
            <input type="text" name="issuing_country" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Immigration Reference Number</label>
            <input type="text" name="immigration_reference_number" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Entry Date</label>
            <input type="date" name="entry_date" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Exit Date</label>
            <input type="date" name="exit_date" required class="w-full px-3 py-2 border rounded-md">
        </div>
    </div>

    <!-- Single Submit Button for Both Sections -->
    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">
  Add Maid
</button></form>
