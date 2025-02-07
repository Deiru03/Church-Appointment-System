<?php
header('Content-Type: application/json');

// Set the timezone to Manila (Philippines Time)
date_default_timezone_set('Asia/Manila');

// Load JSON data
$jsonData = file_get_contents('confirmation.json');
$data = json_decode($jsonData, true);

// Initialize counters
$total_todayc = 0;
$total_weekc = 0;
$total_monthc = 0;

// Get current date and calculate today, start of week, and start of month
$currentDate = new DateTime('now', new DateTimeZone('Asia/Manila'));
$today = $currentDate->format('Y-m-d');  // Today's date in Y-m-d format
$startOfWeek = (clone $currentDate)->modify('monday this week')->format('Y-m-d');
$startOfMonth = $currentDate->format('Y-m-01');

// Debugging: Print key dates for confirmation
error_log("Today's Date: $today");
error_log("Start of Week: $startOfWeek");
error_log("Start of Month: $startOfMonth");

// Unique Log IDs to prevent duplicate counts
$uniqueLogIdsToday = [];
$uniqueLogIdsWeek = [];
$uniqueLogIdsMonth = [];

// Process data
foreach ($data as $entry) {
    // Parse the dateofconfirmation
    if (!empty($entry['dateofconfirmation'])) {
        $confirmationDate = DateTime::createFromFormat('Y-m-d\TH:i', $entry['dateofconfirmation'], new DateTimeZone('Asia/Manila'));

        if ($confirmationDate) {
            $confirmationDay = $confirmationDate->format('Y-m-d');
            $logId = $entry['log_id'];

            // Debugging: Log each confirmation date
            error_log("Log ID: $logId, Confirmation Day: $confirmationDay");

            // Count for today
            if ($confirmationDay === $today && !in_array($logId, $uniqueLogIdsToday)) {
                $uniqueLogIdsToday[] = $logId;
                $total_todayc++;
            }

            // Count for this week
            if ($confirmationDay >= $startOfWeek && $confirmationDay <= $today && !in_array($logId, $uniqueLogIdsWeek)) {
                $uniqueLogIdsWeek[] = $logId;
                $total_weekc++;
            }

            // Count for this month
            if ($confirmationDay >= $startOfMonth && $confirmationDay <= $today && !in_array($logId, $uniqueLogIdsMonth)) {
                $uniqueLogIdsMonth[] = $logId;
                $total_monthc++;
            }
        } else {
            // Debugging: Log parse errors
            error_log("Failed to parse date: " . $entry['dateofconfirmation']);
        }
    }
}

// Return the final counts
echo json_encode([
    'total_todayc' => $total_todayc,
    'total_weekc' => $total_weekc,
    'total_monthc' => $total_monthc
]);
?>
