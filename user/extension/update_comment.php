<?php
include('extension/connect.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Prepare the statement to fetch the comments
    $stmt = $con->prepare("SELECT comment FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users_data = $result->fetch_assoc();
    
    // Output the comments
    echo htmlspecialchars($users_data['comment']);
} else {
    echo 'User ID not provided.';
}
?>