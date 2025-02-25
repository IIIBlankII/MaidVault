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

<h1 class="text-2xl font-semibold mb-4">Client List</h1>
<table class="w-full border-collapse border">
    <thead class="bg-gray-200">
        <tr>
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Address</th>
            <th class="border px-4 py-2">Contact Number</th>
            <th class="border px-4 py-2">Email</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="border px-4 py-2">
                        <a class="client-link" href="#" onclick="loadPage('detailed_clients.php?client_id=<?php echo $row['client_id']; ?>')">
                            <?php echo htmlspecialchars($row['client_id']); ?>
                        </a>
                    </td>
                    <td class="border px-4 py-2">
                        <a class="client-link" href="#" onclick="loadPage('detailed_clients.php?client_id=<?php echo $row['client_id']; ?>')">
                            <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?>
                        </a>
                    </td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['address']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['contact_number']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['email']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="border px-4 py-2 text-center">No clients found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
