<?php
// This view file contains only the form markup.
// Form action points to the client controller (e.g., addClientController.php)
?>
<style>
  /* Container fade in from below */
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }
  .fade-in-up {
    animation: fadeInUp 0.5s ease-out forwards;
  }
</style>

<div class="fade-in-up w-full bg-gray-800 rounded-lg shadow-lg p-6">
    <h1 class="text-2xl text-neutral-100 font-semibold mb-6">Add New Client</h1>
    <form id="addClientForm" method="POST" action="../../controllers/addClientController.php" class="space-y-6">
        <!-- Client Details Section -->
        <div class="p-6 border border-gray-700 rounded-md">
            <h2 class="text-xl font-semibold mb-4 text-purple-400">Client Details</h2>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">First Name</label>
                <input type="text" name="fname" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Last Name</label>
                <input type="text" name="lname" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Address</label>
                <textarea name="address" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Contact Number</label>
                <input type="text" name="contact_number" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="p-6 border border-gray-700 rounded-md">
            <h2 class="text-xl font-semibold mb-4 text-purple-400">Additional Information</h2>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Household Size</label>
                <input type="number" name="household_size" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Number of Children</label>
                <input type="number" name="number_of_children" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Number of Elders</label>
                <input type="number" name="number_of_elders" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Pets</label>
                <select name="pets" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    <option value="None">None</option>
                    <option value="Dogs">Dogs</option>
                    <option value="Cats">Cats</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Notes</label>
                <textarea name="notes" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition"></textarea>
            </div>
        </div>

        <!-- Maid Preference Section -->
        <div class="p-6 border border-gray-700 rounded-md">
            <h2 class="text-xl font-semibold mb-4 text-purple-400">Maid Preference</h2>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Preferred Nationality</label>
                <input type="text" name="preferred_nationality" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Preferred Language</label>
                <input type="text" name="preferred_language" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Work Type</label>
                <select name="work_type" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Special Requirements</label>
                <textarea name="special_requirements" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition"></textarea>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">
            Add Client
        </button>
    </form>
</div>
