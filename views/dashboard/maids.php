<?php
require_once '../../includes/db_connect.php';

// Query every maid along with their visa expiration date (if available)
$query = "SELECT m.maid_id, m.fname, m.lname, m.date_of_birth, m.skills, m.employment_status, v.expiration_date 
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

<!-- Inline style for link hover effects -->
<style>
    .maid-link:hover {
        color: blue;
        text-decoration: underline;
    }
</style>

<h1 class="text-2xl text-neutral-100 font-semibold mb-4">Maid List</h1>
<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
  <thead class="bg-gray-100">
    <tr>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">ID</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Age</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Skills</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Employment Status</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Visa Status</th>
    </tr>
  </thead>
  <tbody class="divide-y divide-gray-200">
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
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <a class="maid-link" href="#" onclick="loadPage('detailed_maids.php?maid_id=<?php echo $row['maid_id']; ?>')">
              <?php echo htmlspecialchars($row['maid_id']); ?>
            </a>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <a class="maid-link" href="#" onclick="loadPage('detailed_maids.php?maid_id=<?php echo $row['maid_id']; ?>')">
              <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?>
            </a>
          </td>
          <td class="px-6 py-4 whitespace-nowrap"><?php echo $age; ?></td>
          <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['skills']); ?></td>
          <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['employment_status']); ?></td>
          <td class="px-6 py-4 whitespace-nowrap"><?php echo $visaStatus; ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="6" class="px-6 py-4 text-center">No maids found.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
