<?php
include('extension/connect.php');
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input date and time
    $sched_date = $_POST['sched_date']; // Ensure the format matches the database format (e.g., YYYY-MM-DD)
    
    // Query the database for any conflicting schedules
    $query = "SELECT sched FROM baptismal WHERE sched = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $sched_date);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Return whether the date is available or not
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'unavailable']);
    } else {
        echo json_encode(['status' => 'available']);
    }
}
?>
