<?php
require_once '../../includes/db_connect.php';

// Query every maid along with their visa expiration date (if available) and nationality
$query = "SELECT m.maid_id, m.fname, m.lname, m.date_of_birth, m.nationality, m.skills, m.employment_status, v.expiration_date 
          FROM maid m 
          LEFT JOIN visa_details v ON m.visa_details_id = v.id
          ORDER BY m.maid_id ASC";
$result = $conn->query($query);

// Helper function to calculate age from date of birth
function calculate_age($dob) {
    $birthDate = new DateTime($dob);
    $today = new DateTime('today');
    return $birthDate->diff($today)->y;
}
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

  /* Link hover effect */
  .maid-link:hover {
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

<h1 class="text-2xl text-neutral-100 font-semibold mb-6">Maid List</h1>

<!-- Outer container with fade in animation -->
<div class="fade-in-up w-full bg-gray-800 rounded-lg shadow-lg p-4">
    <table class="min-w-full border border-white rounded-lg overflow-hidden">
        <!-- Table Head -->
        <thead class="bg-purple-600">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Age</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Nationality</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Skills</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white uppercase tracking-wider">Visa Status</th>
            </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="bg-gray-800 divide-y divide-gray-700 text-gray-100 text-base">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                        $age = calculate_age($row['date_of_birth']);
                        if (!empty($row['expiration_date'])) {
                            $expiration = new DateTime($row['expiration_date']);
                            $today = new DateTime('today');
                            $visaStatus = ($expiration >= $today) ? "Active" : "Expired";
                        } else {
                            $visaStatus = "No Visa";
                        }
                    ?>
                    <!-- Row with slight scale and background change on hover -->
                    <tr class="transition-transform duration-200 hover:scale-[1.01] hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a 
                                class="maid-link text-purple-300 transition-colors duration-200" 
                                href="#" 
                                onclick="animateAndLoad(event, 'detailed_maids.php?maid_id=<?php echo $row['maid_id']; ?>')"
                            >
                                <?php echo htmlspecialchars($row['maid_id']); ?>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a 
                                class="maid-link text-purple-300 transition-colors duration-200" 
                                href="#" 
                                onclick="animateAndLoad(event, 'detailed_maids.php?maid_id=<?php echo $row['maid_id']; ?>')"
                            >
                                <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $age; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['nationality']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['skills']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $visaStatus; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-300">
                        No maids found.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
  /**
   * Combines the link click animation and row fade-out animation,
   * then navigates to the detailed page after the animations complete.
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
