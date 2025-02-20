<?php
require_once '../../includes/db_connect.php';

if (!isset($_GET['maid_id'])) {
    echo "No maid specified.";
    exit;
}

$maid_id = intval($_GET['maid_id']);

$stmt = $conn->prepare("SELECT m.maid_id, m.fname, m.lname, m.date_of_birth, m.skills, m.employment_status,
                               v.visa_type, v.visa_number, v.date_of_issue, v.expiration_date, v.visa_duration,
                               v.work_permit_status, v.passport_number, v.issuing_country, v.immigration_reference_number,
                               v.entry_date, v.exit_date
                        FROM maid m
                        LEFT JOIN visa_details v ON m.visa_details_id = v.id
                        WHERE m.maid_id = ?");
$stmt->bind_param("i", $maid_id);
$stmt->execute();
$result = $stmt->get_result();
$maid = $result->fetch_assoc();

if (!$maid) {
    echo "Maid not found.";
    exit;
}

function calculate_age($dob) {
    $birthDate = new DateTime($dob);
    $today = new DateTime('today');
    return $birthDate->diff($today)->y;
}

$age = calculate_age($maid['date_of_birth']);
?>

<div class="p-4">
    <!-- Back button -->
    <button onclick="loadPage('maids')" class="bg-gray-500 text-white px-4 py-2 rounded-md mb-4">Back</button>
    
    <h1 class="text-2xl font-semibold mb-4">Maid Details: <?php echo htmlspecialchars($maid['fname'] . " " . $maid['lname']); ?></h1>
    
    <!-- Basic Information Section -->
    <div class="bg-white p-4 shadow-md rounded-md mb-4">
        <h2 class="text-xl font-semibold mb-2">Basic Information</h2>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($maid['maid_id']); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($maid['fname'] . " " . $maid['lname']); ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($maid['date_of_birth']); ?></p>
        <p><strong>Skills:</strong> <?php echo htmlspecialchars($maid['skills']); ?></p>
        <p><strong>Employment Status:</strong> <?php echo htmlspecialchars($maid['employment_status']); ?></p>
    </div>
    
    <!-- Visa Details Section -->
    <div class="bg-white p-4 shadow-md rounded-md">
        <h2 class="text-xl font-semibold mb-2">Visa Details</h2>
        <?php if (!empty($maid['visa_type'])): ?>
            <p><strong>Visa Type:</strong> <?php echo htmlspecialchars($maid['visa_type']); ?></p>
            <p><strong>Visa Number:</strong> <?php echo htmlspecialchars($maid['visa_number']); ?></p>
            <p><strong>Date of Issue:</strong> <?php echo htmlspecialchars($maid['date_of_issue']); ?></p>
            <p><strong>Expiration Date:</strong> <?php echo htmlspecialchars($maid['expiration_date']); ?></p>
            <p><strong>Visa Duration:</strong> <?php echo htmlspecialchars($maid['visa_duration']); ?></p>
            <p><strong>Work Permit Status:</strong> <?php echo htmlspecialchars($maid['work_permit_status']); ?></p>
            <p><strong>Passport Number:</strong> <?php echo htmlspecialchars($maid['passport_number']); ?></p>
            <p><strong>Issuing Country:</strong> <?php echo htmlspecialchars($maid['issuing_country']); ?></p>
            <p><strong>Immigration Reference Number:</strong> <?php echo htmlspecialchars($maid['immigration_reference_number']); ?></p>
            <p><strong>Entry Date:</strong> <?php echo htmlspecialchars($maid['entry_date']); ?></p>
            <p><strong>Exit Date:</strong> <?php echo htmlspecialchars($maid['exit_date']); ?></p>
        <?php else: ?>
            <p>No visa details available.</p>
        <?php endif; ?>
    </div>
</div>
