<?php
require_once '../../includes/db_connect.php';

// Query all clients including the email field
$query = "SELECT client_id, fname, lname, address, contact_number, email FROM client ORDER BY client_id ASC";
$result = $conn->query($query);
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

  /* Client link hover effect */
  .client-link:hover {
    color: #D8B4FE; /* Lighter purple accent on hover */
    text-decoration: underline;
  }

  /* Row fade-out animation on click */
  @keyframes fadeOut {
    from { opacity: 1; transform: scale(1); }
    to { opacity: 0; transform: scale(0.95); }
  }
  .animate-fade-out {
    animation: fadeOut 0.3s forwards;
  }

  /* Link click animation */
  @keyframes linkClick {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
  }
  .animate-click {
    animation: linkClick 0.2s forwards;
  }
</style>

<h1 class="text-2xl text-neutral-100 font-semibold mb-6">Client List</h1>

<!-- Outer container with fade in animation -->
<div class="fade-in-up w-full bg-gray-800 rounded-lg shadow-lg p-4">
    <table class="min-w-full border border-gray-700 rounded-lg overflow-hidden">
        <!-- Table Head -->
        <thead class="bg-purple-600">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Address</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Contact Number</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Email</th>
            </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="bg-gray-800 divide-y divide-gray-700 text-gray-100 text-base">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="transition-transform duration-200 hover:scale-[1.01] hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a 
                                class="client-link text-purple-300 transition-colors duration-200" 
                                href="#"
                                onclick="animateAndLoad(event, 'detailed_clients.php?client_id=<?php echo $row['client_id']; ?>')"
                            >
                                <?php echo htmlspecialchars($row['client_id']); ?>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a 
                                class="client-link text-purple-300 transition-colors duration-200" 
                                href="#"
                                onclick="animateAndLoad(event, 'detailed_clients.php?client_id=<?php echo $row['client_id']; ?>')"
                            >
                                <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php echo htmlspecialchars($row['address']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php echo htmlspecialchars($row['contact_number']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php echo htmlspecialchars($row['email']); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-300">
                        No clients found.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
  /**
   * Combines the link click animation and row fade-out animation,
   * then navigates to the detailed client page after the animations complete.
   */
  function animateAndLoad(event, url) {
      event.preventDefault();
      const link = event.currentTarget;
      // Animate the clicked link for immediate feedback
      link.classList.add('animate-click');
      // Get the closest table row for the clicked link
      const tableRow = link.closest('tr');
      // Apply the fade-out animation on the row
      tableRow.classList.add('animate-fade-out');
      // Wait for the animation to complete before navigating
      setTimeout(() => {
          loadPage(url);
      }, 300); // 300ms duration matches the fade-out animation
  }
</script>
