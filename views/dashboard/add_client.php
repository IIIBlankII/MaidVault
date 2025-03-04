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
            <label class="block text-gray-700">Company Name</label>
            <input type="text" name="company_name" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Notes</label>
            <textarea name="notes" class="w-full px-3 py-2 border rounded-md"></textarea>
        </div>
    </div>

    <!-- Single Submit Button -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Client</button>
</form>
