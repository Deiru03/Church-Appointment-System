<?php
// File path to the JSON file
$jsonFilePath = 'sched.json';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $textAreaInput = $_POST['schedule_text'];

    // Parse the text input into JSON
    $lines = explode("\n", trim($textAreaInput));
    $currentSection = '';
    $scheduleData = [];
    foreach ($lines as $line) {
        $line = trim($line);

        // Detect section headers (e.g., "Baptism")
        if (!empty($line) && !str_contains($line, '-')) {
            $currentSection = $line;
            $scheduleData[$currentSection] = [];
        } elseif (!empty($currentSection)) {
            // Handle individual lines within a section
            if (str_contains($line, '-')) {
                // Split by `-` or `,` for time-based entries
                [$day, $time] = array_map('trim', explode('-', $line, 2));
                $scheduleData[$currentSection][$day] = $time;
            } else {
                // Handle non-time-based entries
                $scheduleData[$currentSection][$line] = null;
            }
        }
    }

    // Save the structured JSON back to the file
    file_put_contents($jsonFilePath, json_encode($scheduleData, JSON_PRETTY_PRINT));
    echo "<script>alert('Schedule saved successfully!');</script>";
}

// Read the current JSON data
$jsonData = json_decode(file_get_contents($jsonFilePath), true);

// Convert JSON to human-readable text format
function jsonToText($jsonData) {
    $output = '';
    foreach ($jsonData as $section => $details) {
        $output .= $section . "\n";
        foreach ($details as $day => $time) {
            if (is_array($time)) {
                // Handle array values (e.g., Wedding times)
                $output .= "$day - " . implode(', ', $time) . "\n";
            } elseif ($time === null) {
                $output .= "$day\n";
            } else {
                $output .= "$day - $time\n";
            }
        }
        $output .= "\n"; // Add a blank line between sections
    }
    return trim($output);
}

$textAreaContent = jsonToText($jsonData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    
</head>
<body>
     

    <!-- Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleModalLabel">Edit Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <textarea name="schedule_text" class="form-control" rows="15"><?php echo htmlspecialchars($textAreaContent); ?></textarea>
                        <br>
                        <button type="submit" class="btn btn-success">Save Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
