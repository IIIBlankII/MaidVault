<?php
    // Get current month and year
    $month = date('m');
    $year = date('Y');
    
    // First day of the month
    $firstDay = strtotime("$year-$month-01");
    $daysInMonth = date('t', $firstDay);
    $startDay = date('N', $firstDay); // 1 (Monday) - 7 (Sunday)
    
    // Sample events data (replace with database fetch logic)
    $events = [
        '2025-02-10' => 'Client Meeting',
        '2025-02-15' => 'Maid Training Session',
        '2025-02-20' => 'Monthly Report Submission'
    ];
?>

<div id="calendar-page" class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Calendar & Schedule</h2>
    <div class="bg-white p-4 shadow-md rounded-lg">
        <h3 class="text-lg font-semibold text-center"> <?php echo date('F Y'); ?> </h3>
        <div class="grid grid-cols-7 gap-1 text-center mt-4">
            <div class="font-bold">Mon</div>
            <div class="font-bold">Tue</div>
            <div class="font-bold">Wed</div>
            <div class="font-bold">Thu</div>
            <div class="font-bold">Fri</div>
            <div class="font-bold">Sat</div>
            <div class="font-bold">Sun</div>
            
            <?php
                // Fill empty cells before first day
                for ($i = 1; $i < $startDay; $i++) {
                    echo '<div></div>';
                }
                
                // Display calendar days
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $date = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
                    $eventText = isset($events[$date]) ? '<span class="text-sm text-red-500">' . $events[$date] . '</span>' : '';
                    echo "<div class='p-2 border rounded-md hover:bg-blue-100 cursor-pointer'>
                            <span class='font-semibold'>$day</span>
                            <div class='text-xs'>$eventText</div>
                          </div>";
                }
            ?>
        </div>
    </div>
    
    <div class="mt-6 bg-white p-4 shadow-md rounded-lg">
        <h3 class="text-lg font-semibold">Ongoing Events</h3>
        <ul class="mt-2 text-gray-700">
            <?php
                if (empty($events)) {
                    echo "<li class='text-gray-500'>No upcoming events</li>";
                } else {
                    foreach ($events as $date => $event) {
                        echo "<li class='py-1'><span class='font-semibold'>$date:</span> $event</li>";
                    }
                }
            ?>
        </ul>
    </div>
</div>
