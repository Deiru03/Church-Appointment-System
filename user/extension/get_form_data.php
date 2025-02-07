<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$admin_data = data_records($con);
$fast_loading = fast_loading($con);
$fastpro_loading = fastpro_loading($con);

$user_id = $id; // Get the user ID from the loop
$query = mysqli_query($con, "SELECT form_data FROM users WHERE user_id = '$user_id'");
$row = mysqli_fetch_assoc($query);
$form_data = json_decode($row['form_data'], true);

// Generate HTML to display the form data
$html = '<ul>';
foreach ($form_data as $key => $value) {
    $html .= '<li><strong>' . $key . ':</strong> ' . $value . '</li>';
}
$html .= '</ul>';

echo $html;
?>
