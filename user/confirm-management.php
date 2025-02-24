<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
$status = '';
$teacher_id = $_SESSION['userid'];

ob_start(); // Start output buffering
include('extension/title.php'); // Include the title file
$title = ob_get_clean(); // Store the included content and clear the buffer


if (!isset($_POST['action_a'])) {
} else {
    if ($_POST['action_a'] == 'password') {
        $newpass = rand(0, 9999999);
        $authvpn = md5($newpass);
        $u = mysqli_real_escape_string($con, $_POST['action_u']);

        $query = mysqli_query($con, "UPDATE users SET user_pass = '$newpass', user_encryptedPass = '$authvpn' WHERE user_id='$u'");
        if ($query) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Password] Reset successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Password] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } elseif ($_POST['action_a'] == 'block') {

        $u = mysqli_real_escape_string($con, $_POST['action_u']);

        $query = mysqli_query($con, "UPDATE users SET is_freeze='1' WHERE user_id='" . $u . "'");
        if ($query) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Block successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } elseif ($_POST['action_a'] == 'unblock') {

        $u = mysqli_real_escape_string($con, $_POST['action_u']);

        $query = mysqli_query($con, "UPDATE users SET is_freeze='0' WHERE user_id='" . $u . "'");
        if ($query) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Unblock successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Unblock failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } elseif ($_POST['action_a'] == 'review') {

        $u = mysqli_real_escape_string($con, $_POST['action_u']);

        $query = mysqli_query($con, "UPDATE users SET student_type='pendingpre-school' WHERE user_id='" . $u . "'");
        if ($query) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Students] Review successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Students] Aprroved failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } elseif ($_POST['action_a'] == 'approved') {
        $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

        // Prepare the statement
        $stmt = mysqli_prepare($con, "UPDATE baptismal SET bapstatus='1' WHERE log_id = ?");

        if ($stmt) {
            // Bind the log_id parameter to the statement
            mysqli_stmt_bind_param($stmt, 'i', $log_id);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Fetch phone number and schedule datetime from the database
                $query = mysqli_query($con, "SELECT phone, sched FROM baptismal WHERE log_id = '$log_id'");

                if ($query && mysqli_num_rows($query) > 0) {
                    $row = mysqli_fetch_assoc($query);
                    $phone = $row['phone'];
                    $sched = $row['sched']; // The schedule datetime from the database

                    // Format phone number to E.164
                    if (substr($phone, 0, 2) == '09') {
                        $phone = '+63' . substr($phone, 1);
                    }

                    // Convert datetime to a more readable format
                    $dateTime = new DateTime($sched);
                    $formattedDate = $dateTime->format('F j, Y'); // e.g., August 14, 2024
                    $formattedTime = $dateTime->format('g:i A'); // e.g., 11:25 PM

                    // Assuming $title contains additional information (e.g., "Baptism Ceremony")
                    $titles = 'Baptism Ceremony';

                    // Twilio SMS Notification
                    require_once 'vendor/autoload.php';




                    try {
                        // Send the SMS
                        $message = $twilio->messages->create(
                            $phone,  // The recipient's phone number from the database
                            array(
                                "from" => "+12515722383",  // Your Twilio phone number
                                "body" => "Congratulations, your application has been approved. Your schedule is on $formattedDate at $formattedTime for $titles."
                            )
                        );

                        // Show approval success message with SMS confirmation
                        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                       Approval Done. SMS sent to ' . $phone . '
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>';
                    } catch (Exception $e) {
                        // Handle SMS sending failure
                        $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                                       Approval Done but SMS failed to send: ' . $e->getMessage() . '
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>';
                    }
                } else {
                    // No phone number or schedule found
                    $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                                   Approval Done but no phone number or schedule found for SMS.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>';
                }
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                Approval failure
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            Statement preparation failed: ' . mysqli_error($con) . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } elseif ($_POST['action_a'] == 'declined') {
        $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

        // Prepare the statement
        $stmt = mysqli_prepare($con, "UPDATE baptismal SET bapstatus='2' WHERE log_id = ?");

        if ($stmt) {
            // Bind the log_id parameter to the statement
            mysqli_stmt_bind_param($stmt, 'i', $log_id);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Fetch phone number of the user from the database
                $phone_query = mysqli_query($con, "SELECT phone FROM baptismal WHERE log_id = '$log_id'");
                if ($phone_query && mysqli_num_rows($phone_query) > 0) {
                    $row = mysqli_fetch_array($phone_query);
                    $phone = $row['phone'];

                    // Format phone number to E.164 (assume it's a Philippines number if it starts with 09)
                    if (substr($phone, 0, 2) == '09') {
                        // Replace the leading '09' with '+639' to format it to E.164
                        $phone = '+63' . substr($phone, 1);
                    }

                    // Check if phone number exists
                    if (!empty($phone)) {
                        try {

                            // Send the SMS
                            $message = $twilio->messages->create(
                                $phone,  // The recipient's phone number from the database
                                array(
                                    "from" => "+12515722383",  // Your Twilio phone number
                                    "body" => "your application has been declined from . $title"
                                )
                            );

                            // Show approval success message with SMS confirmation
                            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                           Approval Done. SMS sent to ' . $phone . '
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>';
                        } catch (Exception $e) {
                            // Handle SMS sending failure
                            $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                                           Approval Done but SMS failed to send: ' . $e->getMessage() . '
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>';
                        }
                    } else {
                        // No phone number found
                        $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                                       Approval Done but no phone number found for SMS.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>';
                    }
                } else {
                    $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                   Failed to retrieve phone number: ' . mysqli_error($con) . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>';
                }
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                Approval failure
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            Statement preparation failed: ' . mysqli_error($con) . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } elseif ($_POST['action_a'] == 'cancel') {
        $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

        // Prepare the statement
        $stmt = mysqli_prepare($con, "UPDATE baptismal SET bapstatus='3' WHERE log_id = ?");

        if ($stmt) {
            // Bind the log_id parameter to the statement
            mysqli_stmt_bind_param($stmt, 'i', $log_id);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Fetch phone number of the user from the database
                $phone_query = mysqli_query($con, "SELECT phone FROM baptismal WHERE log_id = '$log_id'");
                if ($phone_query && mysqli_num_rows($phone_query) > 0) {
                    $row = mysqli_fetch_array($phone_query);
                    $phone = $row['phone'];

                    // Format phone number to E.164 (assume it's a Philippines number if it starts with 09)
                    if (substr($phone, 0, 2) == '09') {
                        // Replace the leading '09' with '+639' to format it to E.164
                        $phone = '+63' . substr($phone, 1);
                    }

                    // Check if phone number exists
                    if (!empty($phone)) {
                        try {

                            // Send the SMS
                            $message = $twilio->messages->create(
                                $phone,  // The recipient's phone number from the database
                                array(
                                    "from" => "+12515722383",  // Your Twilio phone number
                                    "body" => "your application has been cancel from . $title"
                                )
                            );

                            // Show approval success message with SMS confirmation
                            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                           Approval Done. SMS sent to ' . $phone . '
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>';
                        } catch (Exception $e) {
                            // Handle SMS sending failure
                            $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                                           Approval Done but SMS failed to send: ' . $e->getMessage() . '
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>';
                        }
                    } else {
                        // No phone number found
                        $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                                       Approval Done but no phone number found for SMS.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>';
                    }
                } else {
                    $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                   Failed to retrieve phone number: ' . mysqli_error($con) . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>';
                }
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                Approval failure
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            Statement preparation failed: ' . mysqli_error($con) . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } elseif ($_POST['action_a'] == 'deletes') {
        $u = mysqli_real_escape_string($con, $_POST['action_u']);

        // Fetch the filename associated with the log_id
        $filename_query = mysqli_prepare($con, "SELECT file_name FROM fullpaper WHERE log_id = ?");
        mysqli_stmt_bind_param($filename_query, "s", $u);
        mysqli_stmt_execute($filename_query);
        $filename_result = mysqli_stmt_get_result($filename_query);
        $filename_row = mysqli_fetch_assoc($filename_result);

        if ($filename_row) {
            $filename = $filename_row['file_name'];

            // Delete the file from the fullpaper1 folder
            $file_path = "fullpaper1/$filename";
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Delete the record from the fullpaper table
            $delete_query = mysqli_prepare($con, "DELETE FROM fullpaper WHERE log_id = ?");
            mysqli_stmt_bind_param($delete_query, "s", $u);
            $delete_result = mysqli_stmt_execute($delete_query);

            if ($delete_result) {
                $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Delete successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                [User] Delete failure
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            }
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            Record not found
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action_a'] == 'delete21212') {
        $u = mysqli_real_escape_string($con, $_POST['action_u']);

        // Delete the record from the adminmass table
        $delete_query = mysqli_prepare($con, "DELETE FROM adminmass WHERE log_id = ?");
        mysqli_stmt_bind_param($delete_query, "s", $u);
        $delete_result = mysqli_stmt_execute($delete_query);

        if ($delete_result) {
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                    Record deleted successfully
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                    Deletion failed
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>';
        }
    } else {
    }
}



?>


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
function jsonToText($jsonData)
{
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php include('extension/title.php'); ?> | View User Document</title>

    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/church/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/davidstyles.css" />

    <link rel="stylesheet" type="text/css" href="/assets/alertifyjs/css/alertify.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f4ff;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background-color: #ffffff;
        border: 2px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1px;
    }

    .header img {
        max-width: 100px;
        max-height: 100px;
    }

    .center-image {
        text-align: center;
        margin-bottom: 20px;
    }

    .center-image img {
        max-width: 200px;
    }

    h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin: 10px 0 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="tel"],
    select {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
        width: 100%;
    }

    .row {
        display: flex;
        justify-content: space-between;
    }

    .row input[type="text"] {
        width: 48%;
    }

    .godparents {
        display: flex;
        flex-direction: column;
    }

    .godparents input[type="text"] {
        margin-bottom: 5px;
    }

    .user-id {
        margin: 20px 0;
    }

    .user-id input[type="file"] {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .submit-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        border: none;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
        align-self: flex-end;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }

    /* Style for the button */
    .custom-btn {
        display: flex;
        align-items: center;
        background-color: #007bff;
        /* Change to your preferred color */
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Style for the button on hover */
    .custom-btn:hover {
        background-color: #0056b3;
        /* Darker shade of your preferred color */
        transform: translateY(-2px);
    }

    /* Image styling inside the button */
    .custom-btn img {
        margin-right: 10px;
        /* Space between image and text */
        vertical-align: middle;
    }

    /* Style for the button on active (click) */
    .custom-btn:active {
        background-color: #004080;
        /* Even darker shade of your preferred color */
        transform: translateY(0);
    }

    select[name="day"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    table {
        font-size: 14px;
        /* Adjust font size */
        width: 100%;
    }

    th {
        font-weight: bold;
        padding: 10px;
        background-color: #f8f9fa;
        /* Light background for headers */
        text-align: left;
        /* Align text to the left */
    }

    td {
        padding: 10px;
        text-align: left;
        /* Align text to the left */
    }

    tr:hover {
        background-color: #f1f1f1;
        /* Light grey background on hover */
    }

    .btn {
        font-size: 12px;
        /* Adjust button font size */
        padding: 5px 10px;
        /* Adjust button padding */
    }


    textarea {
        width: 100%;
        font-family: monospace;
        font-size: 16px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
        /* Allows users to adjust the height */
    }
</style>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->


        <!--=================================
 preloader -->


        <!--=================================
 header start-->

        <?php include('extension/topnav.php'); ?>

        <!--=================================
 header End-->

        <!--=================================
 Main content -->

        <div class="container-fluid">
            <div class="row">
                <?php include('extension/sidenav.php'); ?>
                <!-- main content wrapper start-->

                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"></h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">


                                    <?php if ($user_rank == 'superadmin') { ?>
                                        <li class="breadcrumb-item">
                                            <a href="#" class="default-color">
                                                <button class="custom-btn" data-bs-toggle="modal" data-bs-target="#scheduleModal">
                                                    <img src="https://img.sikatpinoy.net/images/2024/08/03/image09dce3a988e61a91.png" alt="Dashboard Image" height="20" width="25">
                                                    Open Schedule EditorE
                                                </button>
                                            </a>
                                        </li>

                                    <?php } ?>

                                </ol>
                            </div>
                        </div>
                    </div>


                    <h1>Edit Schedule</h1>
                    <form method="post">
                        <textarea name="schedule_text" rows="15"><?php echo htmlspecialchars($textAreaContent); ?></textarea>
                        <br><br>

                    </form>



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

                    <script>
                        function showUname(uname) {
                            document.getElementById('unameDetails').innerText = uname;
                        }
                    </script>
                    <form method="post" id="action_form">
                        <input type="hidden" id="action_a" name="action_a" />
                        <input type="hidden" id="action_u" name="action_u" />
                    </form>

                    <script>
                        function submitForm(action_id, user_id) {
                            document.getElementById('action_a').value = action_id;
                            document.getElementById('action_u').value = user_id;
                            document.getElementById('action_form').submit();
                        }
                    </script>

                    <!-- main content wrapper end-->
                    <?php include('extension/footer.php'); ?>
                </div>

            </div>
        </div>
    </div>








    <div class="modal fade" id="addmassschedule" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="header">
                            <img src="https://img.sikatpinoy.net/images/2024/08/14/image48efe10dd8815c06.png" alt="Right Image">
                            <h1>Schedule Confirmation</h1>
                            <img src="https://img.sikatpinoy.net/images/2024/09/30/image-removebg-preview-3.png" alt="Left Image 2">
                        </div>
                        <small> St. Joseph cathedral Parish </small>
                        <p>Add Schedule Confirmation For St. Joseph cathedral Parish </p>


                        <form method="POST" action="" class="ui grid form" enctype="multipart/form-data">
                            <label for="day">Add Day:</label>
                            <select name="day" required>
                                <option value="" disabled selected>Select a day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>


                            <label for="date">Date:</label>
                            <input type="date" name="date" required>

                            <label for="hours">Hours:</label>
                            <input type="time" name="hours" required>


                            <button type="submit" name="addmass" class="submit-btn">&#9658;</button>
                        </form>


                    </div>




                </div>
            </div>
        </div>
    </div>






    <!-- Modal for viewing files -->
    <div class="modal fade" id="pdfModals" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabels"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabels">File Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewers" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and jQuery libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function openPDFViewers(files) {
            // Path to your PDF files directory
            var pdfPath = '';

            // URL of the PDF file
            var pdfUrl = pdfPath + files;

            // Set the source of the iframe
            var iframe = document.getElementById('pdfViewers');
            iframe.src = pdfUrl;

            // Show the modal
            $('#pdfModals').modal('show');
        }
    </script>

    <script>
        function submitForm(action, log_id) {
            if (action === 'delete') {
                if (confirm('Are you sure you want to delete this data?')) {
                    // Create a form dynamically to submit the delete request
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = ''; // The current page or URL handling the deletion

                    // Add hidden fields for the action and log_id
                    var actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action_a';
                    actionInput.value = action;
                    form.appendChild(actionInput);

                    var logIdInput = document.createElement('input');
                    logIdInput.type = 'hidden';
                    logIdInput.name = 'action_u';
                    logIdInput.value = log_id;
                    form.appendChild(logIdInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            }
        }
    </script>

    <script>
        var notificationElement = document.getElementById('notification');
        if (notificationElement.innerHTML !== '') {
            setTimeout(function() {
                notificationElement.innerHTML = '';
            }, 5000); // Clear notification after 5 seconds
        }
    </script>
    <!-- jquery -->
    <script src="/church/assets/js/jquery-3.3.1.min.js"></script>

    <!-- plugins-jquery -->
    <script src="/church/assets/js/plugins-jquery.js"></script>

    <!-- plugin_path -->
    <script>
        var plugin_path = '/church/assets/js/';
    </script>

    <!-- chart -->
    <script src="/church/assets/js/chart-init.js"></script>

    <!-- calendar -->
    <script src="/church/assets/js/calendar.init.js"></script>

    <!-- charts sparkline -->
    <script src="/church/assets/js/sparkline.init.js"></script>

    <!-- charts morris -->
    <script src="/church/assets/js/morris.init.js"></script>

    <!-- datepicker -->
    <script src="/church/assets/js/datepicker.js"></script>

    <!-- sweetalert2 -->
    <script src="/church/assets/js/sweetalert2.js"></script>

    <!-- toastr -->
    <script src="/church/assets/js/toastr.js"></script>

    <!-- validation -->
    <script src="/church/assets/js/validation.js"></script>

    <!-- lobilist -->
    <script src="/church/assets/js/lobilist.js"></script>

    <!-- custom -->
    <script src="/church/assets/js/custom.js"></script>

    <script src="/assets/alertifyjs/alertify.js"></script>

    <script>
        $(function() {
            $("#datatable").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });
        });
    </script>


    <script>
        // Get the modal and buttons
        const modal = document.getElementById('myModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');

        // Function to open the modal
        function openModal() {
            modal.style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = 'none';
        }

        // Event listeners for the buttons
        openModalBtn.addEventListener('click', openModal);
        closeModalBtn.addEventListener('click', closeModal);

        // Close the modal if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                closeModal();
            }
        });
    </script>



</body>

</html>