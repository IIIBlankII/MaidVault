<?php
require_once '../../includes/db_connect.php';

// Query all clients including the email field
$query = "SELECT client_id, fname, lname, address, contact_number, email FROM client ORDER BY client_id ASC";
$result = $conn->query($query);
?>

<!-- Inline style for client link hover effects -->
<style>
    .client-link:hover {
        color: blue;
        text-decoration: underline;
    }
</style>

<h1 class="text-2xl text-neutral-100 font-semibold mb-4">Client List</h1>
<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
  <thead class="bg-gray-100">
    <tr>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Number</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
    </tr>
  </thead>
  <tbody class="divide-y divide-gray-200">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">
            <a class="client-link" href="#" onclick="loadPage('detailed_clients.php?client_id=<?php echo $row['client_id']; ?>')">
              <?php echo htmlspecialchars($row['client_id']); ?>
            </a>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <a class="client-link" href="#" onclick="loadPage('detailed_clients.php?client_id=<?php echo $row['client_id']; ?>')">
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
        <td colspan="5" class="px-6 py-4 text-center">No clients found.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

