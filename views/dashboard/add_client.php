<?php
// This view file contains only the form markup.
// Form action points to the client controller (e.g., addClientController.php)
?>
<h1 class="text-2xl text-neutral-100 font-semibold mb-4">Add New Client</h1>
<form id="addClientForm" method="POST" action="../../controllers/addClientController.php" class="space-y-6">
    <!-- Client Details Section -->
    <div class="bg-white p-4 shadow-md rounded-md">
        <h2 class="text-xl font-semibold mb-4">Client Details</h2>
        <div class="mb-4">
            <label class="block text-gray-700">First Name</label>
            <input type="text" name="fname" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Last Name</label>
            <input type="text" name="lname" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Address</label>
            <textarea name="address" required class="w-full px-3 py-2 border rounded-md"></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Contact Number</label>
            <input type="text" name="contact_number" required class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" required class="w-full px-3 py-2 border rounded-md">
        </div>
    </div>

    <!-- Additional Information Section -->
    <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Additional Information</h2>
        <div class="mb-4">
            <label class="block text-gray-700">Household Size</label>
            <input type="number" name="household_size" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Number of Children</label>
            <input type="number" name="number_of_children" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Number of Elders</label>
            <input type="number" name="number_of_elders" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Pets</label>
            <select name="pets" class="w-full px-3 py-2 border rounded-md">
                <option value="None">None</option>
                <option value="Dogs">Dogs</option>
                <option value="Cats">Cats</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Notes</label>
            <textarea name="notes" class="w-full px-3 py-2 border rounded-md"></textarea>
        </div>
    </div>

    <!-- Maid Preference Section -->
    <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Maid Preference</h2>
        <div class="mb-4">
            <label class="block text-gray-700">Preferred Nationality</label>
            <input type="text" name="preferred_nationality" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Preferred Language</label>
            <input type="text" name="preferred_language" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Work Type</label>
            <select name="work_type" required class="w-full px-3 py-2 border rounded-md">
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Special Requirements</label>
            <textarea name="special_requirements" class="w-full px-3 py-2 border rounded-md"></textarea>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">
        Add Client
    </button>
</form>
