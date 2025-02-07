<?php
// Include the database connection
include('extension/connect.php'); // Ensure this file contains your $con mysqli connection

if (isset($_GET['sched_date'])) {
    $sched_date = $_GET['sched_date'];  // Get the selected date from the AJAX request

    // Format the date to match the format in the database (adjust this depending on your DB schema)
    $formattedDate = date('Y-m-d', strtotime($sched_date));  // Use only the date part

    // Prepare the query to select all records for the same date, regardless of time
    $query = "SELECT * FROM baptismal WHERE DATE(sched) = ?";
    if ($stmt = $con->prepare($query)) {
        // Bind the parameter (now only the date part)
        $stmt->bind_param("s", $formattedDate);  // "s" means string

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are scheduled times and display them
        if ($result->num_rows > 0) {
            while ($time = $result->fetch_assoc()) {
                // Output available scheduled times
                echo 'Scheduled Time: ' . date('h:i A', strtotime($time['sched'])) . '<br>';
            }
        } else {
            echo 'No scheduled times for this date.';  // No scheduled times found
        }

        // Close the statement
        $stmt->close();
    } else {
        echo 'Error preparing query.';
    }
}
?>
