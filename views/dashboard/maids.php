<?php
require_once '../../includes/db_connect.php';

// Query every maid along with their visa expiration date (if available)
$query = "SELECT m.maid_id, m.fname, m.lname, m.date_of_birth, m.skills, m.employment_status, v.expiration_date 
          FROM maid m 
          LEFT JOIN visa_details v ON m.visa_details_id = v.id
          ORDER BY m.maid_id ASC";
$result = $conn->query($query);

// Helper function to calculate age
function calculate_age($dob) {
    $birthDate = new DateTime($dob);
    $today = new DateTime('today');
    return $birthDate->diff($today)->y;
}
?>

<h1 class="text-2xl font-semibold mb-4">Maid List</h1>
<table class="w-full border-collapse border">
    <thead class="bg-gray-200">
        <tr>
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Age</th>
            <th class="border px-4 py-2">Skills</th>
            <th class="border px-4 py-2">Employment Status</th>
            <th class="border px-4 py-2">Visa Status</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                    // Calculate Age
                    $age = calculate_age($row['date_of_birth']);

                    // Determine Visa Status using the expiration_date from visa_details
                    if (!empty($row['expiration_date'])) {
                        $expiration = new DateTime($row['expiration_date']);
                        $today = new DateTime('today');
                        $visaStatus = ($expiration >= $today) ? "Active" : "Expired";
                    } else {
                        $visaStatus = "No Visa";
                    }
                ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['maid_id']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></td>
                    <td class="border px-4 py-2"><?php echo $age; ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['skills']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['employment_status']); ?></td>
                    <td class="border px-4 py-2"><?php echo $visaStatus; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="border px-4 py-2 text-center">No maids found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
