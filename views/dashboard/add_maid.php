<?php
// This view file contains only the form markup.
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
    <h1 class="text-2xl text-neutral-100 font-semibold mb-6">Add New Maid</h1>
    <form id="addMaidForm" method="POST" action="../../controllers/addMaidAndVisaController.php" class="space-y-6" enctype="multipart/form-data">
        <!-- Maid Details Section -->
        <div class="p-6 border border-gray-700 rounded-md">
            <h2 class="text-xl font-semibold mb-4 text-purple-400">Maid Details</h2>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">First Name</label>
                <input type="text" name="fname" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Last Name</label>
                <input type="text" name="lname" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Nationality</label>
                <input type="text" name="nationality" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <!-- Language Field -->
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Language</label>
                <input type="text" name="language" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Skills</label>
                <textarea name="skills" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Employment Status</label>
                <select name="employment_status" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    <option value="Available">Available</option>
                    <option value="Hired">Hired</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Visa Details Section -->
        <div class="p-6 border border-gray-700 rounded-md">
            <h2 class="text-xl font-semibold mb-4 text-purple-400">Visa Details</h2>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Visa Type</label>
                <input type="text" name="visa_type" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Visa Number</label>
                <input type="text" name="visa_number" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Date of Issue</label>
                <input type="date" name="date_of_issue" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Expiration Date</label>
                <input type="date" name="expiration_date" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Visa Duration</label>
                <input type="text" name="visa_duration" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Work Permit Status</label>
                <input type="text" name="work_permit_status" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Passport Number</label>
                <input type="text" name="passport_number" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Issuing Country</label>
                <input type="text" name="issuing_country" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Immigration Reference Number</label>
                <input type="text" name="immigration_reference_number" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Entry Date</label>
                <input type="date" name="entry_date" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Exit Date</label>
                <input type="date" name="exit_date" required class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <!-- Visa Image Upload Field -->
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Attach Visa Image</label>
                <input type="file" name="visa_image" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <!-- Passport Image Field -->
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Attach Passport Image</label>
                <input type="file" name="passport_image" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
            <!-- Work Permit Image Field -->
            <div class="mb-4">
                <label class="block text-gray-300 mb-1">Attach Work Permit Image</label>
                <input type="file" name="work_permit_image" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">
            Add Maid
        </button>
    </form>
</div>
