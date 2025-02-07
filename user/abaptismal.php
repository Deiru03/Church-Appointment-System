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
    } elseif ($_POST['action_a'] == 'delete') {
        $u = mysqli_real_escape_string($con, $_POST['action_u']);

        // Fetch the filename associated with the log_id
        $filename_query = mysqli_prepare($con, "SELECT picture FROM patient WHERE log_id = ?");
        mysqli_stmt_bind_param($filename_query, "s", $u);
        mysqli_stmt_execute($filename_query);
        $filename_result = mysqli_stmt_get_result($filename_query);
        $filename_row = mysqli_fetch_assoc($filename_result);

        if ($filename_row) {
            $filename = $filename_row['picture'];

            // Delete the file from the img/picture folder
            $file_path = "img/picture/$filename";
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Delete the record from the patient table
            $delete_query = mysqli_prepare($con, "DELETE FROM patient WHERE log_id = ?");
            mysqli_stmt_bind_param($delete_query, "s", $u);
            $delete_result = mysqli_stmt_execute($delete_query);

            if ($delete_result) {
                $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            User deleted successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            User deletion failed
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
    } else {

    }
}



?>

<?php
include('extension/connect.php');

if (isset($_POST['upload'])) {
    // Check if a picture was uploaded
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        // Define allowed picture types
        $allowedPictureExtensions = array('png', 'jpg');
        $pictureExtension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

        // Check if the picture extension is allowed
        if (!in_array(strtolower($pictureExtension), $allowedPictureExtensions)) {
            echo '<script>
                    alert("Only PNG and JPG images are allowed.");
                    window.location.reload();
                  </script>';
            exit;
        }

        // Generate a unique filename for the picture
        $timestamp = date('YmdHis');
        $uniquePictureFilename = $timestamp . '.' . $pictureExtension;
        $pictureUploadDir = 'img/picture/';
        $pictureUploadFile = $pictureUploadDir . $uniquePictureFilename;

        // Move the uploaded picture
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $pictureUploadFile)) {
            // Retrieve and sanitize form inputs
            $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
            $gender = mysqli_real_escape_string($con, $_POST['gender']);
            $dateofbirth = mysqli_real_escape_string($con, $_POST['dateofbirth']);
            $sched = mysqli_real_escape_string($con, $_POST['sched']); // Date and time of baptism ceremony
            $address = mysqli_real_escape_string($con, $_POST['address']);
            $phone = mysqli_real_escape_string($con, $_POST['phone']);
            $fathersname = mysqli_real_escape_string($con, $_POST['fathersname']);
            $father_occupation = mysqli_real_escape_string($con, $_POST['father_occupation']);
            $mothersname = mysqli_real_escape_string($con, $_POST['mothersname']);
            $mother_occupation = mysqli_real_escape_string($con, $_POST['mother_occupation']);
            $godparents_1 = mysqli_real_escape_string($con, $_POST['godparents_1']);
            $godparents_2 = mysqli_real_escape_string($con, $_POST['godparents_2']);
            $godparents_3 = mysqli_real_escape_string($con, $_POST['godparents_3']);
            $godparents_4 = mysqli_real_escape_string($con, $_POST['godparents_4']);
            $godparents_5 = mysqli_real_escape_string($con, $_POST['godparents_5']);
            $uname = mysqli_real_escape_string($con, $_POST['uname']);

            // Insert data into the baptismal table
            $insertBaptismalQuery = "INSERT INTO baptismal (date, dateofbirth, phone, gender, address, fullname, fathersname, father_occupation, mothersname, mother_occupation, godparents_1, godparents_2, godparents_3, godparents_4, godparents_5, picture, uname, sched)
                                     VALUES (NOW(), '$dateofbirth', '$phone', '$gender', '$address', '$fullname', '$fathersname', '$father_occupation', '$mothersname', '$mother_occupation', '$godparents_1', '$godparents_2', '$godparents_3', '$godparents_4', '$godparents_5', '$pictureUploadFile', '$uname', '$sched')";

            if (mysqli_query($con, $insertBaptismalQuery)) {
                // Send SMS Notification
                // Load Twilio SDK

                // Convert datetime to a more readable format
                $dateTime = new DateTime($sched);
                $formattedDate = $dateTime->format('F j, Y'); // e.g., August 14, 2024
                $formattedTime = $dateTime->format('g:i A'); // e.g., 11:25 PM

                // Message body
                $messageBody = "Your application is successfully submitted. The baptismal ceremony is scheduled on $formattedDate at $formattedTime. To check details and proceed with the payment, please review the information.";
                // Format phone number to E.164
                if (substr($phone, 0, 2) == '09') {
                    $phone = '+63' . substr($phone, 1);
                }



                try {
                    $message = $twilio->messages->create(
                        $phone,  // The recipient's phone number from the database
                        array(
                            "from" => "+12515722383",  // Your Twilio phone number
                            "body" => $messageBody
                        )
                    );

                    // Show approval success message with SMS confirmation
                    $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                 Successfully added baptismal record and uploaded picture. SMS sent to ' . $phone . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <meta http-equiv="refresh" content="2; url=baptismal">
                               </div>';
                } catch (Exception $e) {
                    // Handle SMS sending failure
                    $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                                   Successfully added baptismal record but SMS failed to send: ' . $e->getMessage() . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>';
                }
            } else {
                echo '<script>
                        alert("Error inserting data into the database.");
                      </script>';
            }
        } else {
            echo '<script>
                    alert("Error uploading the picture.");
                  </script>';
        }
    } else {
        echo '<script>
                alert("No picture was uploaded or an error occurred.");
              </script>';
    }
}

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

        <div class="container-fluid" style="background-color:skyblue;">
            <div class="row">
                <?php include('extension/sidenav.php'); ?>
                <!-- main content wrapper start-->

                <div class="content-wrapper" style="background-color:skyblue;">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"></h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">


                                    <?php if ($user_rank == 'normal') { ?>
                                        <li class="breadcrumb-item"><a href="#" class="default-color"><button
                                                    data-toggle="modal" data-target="#baptismalmodal"> <img
                                                        src="https://img.sikatpinoy.net/images/2024/08/07/image-removebg-preview-1.png"
                                                        alt="Dashboard Image" height="20" width="25"> APPLY BAPTISM</button>
                                            </a></li>
                                    <?php } ?>

                                </ol>
                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php echo $status; ?>
                                        <table id="datatable" class="table table-striped table-bordered p-0">
                                            <thead>
                                                <tr>
                                                    <th>Picture</th>
                                                    <th>FullName</th>
                                                    <th>Date Apply</th>
                                                    <th>Sched</th>
                                                    <th>Phone</th>
                                                    <th>Proofpayment</th>
                                                    <th>payment</th>
                                                    <th>STATUS</th>
                                                    <!-- <?php if ($user_rank == 'superadmin') { ?>
                                                    <th>BHW</th>
                                                    <?php } ?> -->
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                $rank_check = mysqli_query($con, "select user_rank from users where user_id='$userid'");
                                                $myrank = mysqli_fetch_array($rank_check);
                                                $user_rank = $myrank['user_rank'];

                                                if ($user_rank == 'normal') {
                                                    $uname = $t['user_name']; // Initialize $uname with the logged-in user's name
                                                    $query = mysqli_query($con, "SELECT * FROM baptismal WHERE uname = '$uname'");
                                                } elseif ($user_rank == 'superadmin') {
                                                    $query = mysqli_query($con, "SELECT * FROM baptismal WHERE bapstatus='1'");
                                                } else {
                                                    // Handle other ranks or an unknown rank if necessary
                                                    // For example, you could set a default query or show an error message
                                                    echo "Unknown user rank.";
                                                    exit;
                                                }

                                                $uname = $t['user_name']; // Initialize $uname with the logged-in user's name
                                                // $query = mysqli_query($con, "SELECT * FROM patient WHERE uname = '$uname'");
                                                if (!$query) {
                                                    echo "Query error: " . mysqli_error($con);
                                                } elseif (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        $id = $row['log_id'];
                                                        $date = $row['date']; // Ensure this column exists and is used correctly
                                                        $formattedDate = date('M d, Y', strtotime($date));
                                                        $sched = $row['sched']; // Ensure this column exists and is used correctly
                                                        $formattedDatesched = date('M d, Y', strtotime($sched));
                                                        $picture = $row['picture']; // Ensure this column exists and contains the file path
                                                        $fullname = $row['fullname'];
                                                        $phone = $row['phone'];
                                                        $proofpayment = $row['proofpayment'];
                                                        $statuspayment = $row['statuspayment'];
                                                        $bapstatus = $row['bapstatus'];
                                                        $uname = $row['uname'];

                                                        $statusText = '';
                                                        if ($statuspayment == 1) {
                                                            $statusText = '<label class="badge badge-warning">PENDING</label>';
                                                        } elseif ($statuspayment == 0) {
                                                            $statusText = '<label class="badge badge-success">PAID</label>';
                                                        } elseif ($statuspayment == 2) {
                                                            $statusText = 'Declined';
                                                        }

                                                        $bapstat = '';
                                                        if ($bapstatus == 0) {
                                                            $bapstat = '<label class="badge badge-warning">PENDING</label>';
                                                        } elseif ($bapstatus == 1) {
                                                            $bapstat = '<label class="badge badge-success">APPROVED</label>';
                                                        } elseif ($bapstatus == 2) {
                                                            $bapstat = '<label class="badge badge-danger">DECLINED</label>';
                                                        } elseif ($bapstatus == 3) {
                                                            $bapstat = '<label class="badge badge-danger">CANCEL</label>';
                                                        }

                                                        $bapstatbutton = '';

                                                        if ($bapstatus == 0) {
                                                            $bapstatbutton = $bapstat;
                                                        } elseif ($bapstatus == 1) {
                                                            $bapstatbutton = '';
                                                        } elseif ($bapstatus == 2) {
                                                            $bapstatbutton = '';
                                                        }

                                                        $bapstatbuttonnew = '';

                                                        if ($bapstatus == 0) {
                                                            $bapstatbuttonnew = 'APPROVED';
                                                        } elseif ($bapstatus == 1) {
                                                            $bapstatbuttonnew = '';
                                                        } elseif ($bapstatus == 2) {
                                                            $bapstatbuttonnew = '';
                                                        }


                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <img src="<?php echo htmlspecialchars($picture); ?>"
                                                                    alt="Picture"
                                                                    style="width:35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                                            </td>

                                                            <td><?php echo htmlspecialchars($fullname); ?></td>
                                                            <td><?php echo $formattedDate; ?></td>
                                                            <td><?php echo $formattedDatesched; ?></td>
                                                            <td><?php echo $phone; ?></td>
                                                            <td align="center">
                                                                <a href="javascript:void(0);"
                                                                    onclick="showFullImage('<?php echo htmlspecialchars($proofpayment); ?>')">
                                                                    <img src="<?php echo htmlspecialchars($proofpayment); ?>"
                                                                        alt="Proof of Payment"
                                                                        style="width:35px; height:35px; object-fit: cover; border-radius: 5px;">
                                                                </a>
                                                            </td>


                                                            <td><?php echo $statusText; ?></td>
                                                            <td><?php echo $bapstat; ?></td>
                                                            <!-- <td style="color: blue">
                                                        <button class="btn btn-info" data-toggle="modal"
                                                            data-target="#pdfModals"
                                                            onclick="openPDFViewers('<?php echo $files; ?>')">pdf</button>
                                                    </td> -->
                                                            <!-- <td>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-toggle="modal" data-target="#contactModal"
                                                            onclick="showContact('<?php echo htmlspecialchars($contact); ?>')">
                                                            <img src="https://img.sikatpinoy.net/images/2024/07/26/imagea6f5218eb6fef2b7.png"
                                                                alt="Dashboard Image" height="20" width="20">

                                                        </a>

                                                    </td> -->
                                                            <?php if ($user_rank == 'superadmin') { ?>
                                                                <!-- <td>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-toggle="modal" data-target="#unameModal"
                                                            onclick="showUname('<?php echo htmlspecialchars($uname); ?>')">
                                                            <img src="https://img.sikatpinoy.net/images/2024/08/03/image0de202e879913da9.png"
                                                                alt="Dashboard Image" height="20" width="20">

                                                        </a>

                                                    </td> -->

                                                            <?php } ?>
                                                            
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="9">No records found.</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Approved Modal -->
                    <div class="modal fade" id="confirmModalapproved" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalApprovedLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalApprovedLabel">Confirm Approval</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to approve this record? Type 'approved' to confirm.</p>
                                    <input type="text" id="confirmationInputApproved" placeholder="Type 'approved'"
                                        class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmButtonApproved"
                                        class="btn btn-danger">Confirm</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Declined Modal -->
                    <div class="modal fade" id="confirmModaldeclined" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalDeclinedLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalDeclinedLabel">Confirm Declined</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to decline this record? Type 'declined' to confirm.</p>
                                    <input type="text" id="confirmationInputDeclined" placeholder="Type 'declined'"
                                        class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmButtonDeclined"
                                        class="btn btn-danger">Confirm</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cancel Modal -->
                    <div class="modal fade" id="confirmModalcancel" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalCancelLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalCancelLabel">Confirm Cancel</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to cancel this record? Type 'cancel' to confirm.</p>
                                    <input type="text" id="confirmationInputcancel" placeholder="Type 'cancel'"
                                        class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmButtoncancel"
                                        class="btn btn-danger">Confirm</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Modal Structure -->
                    <!-- <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Confirm Deletion</h5>

                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this record? Type 'delete' to confirm.</p>
                                    <input type="text" id="confirmationInput" placeholder="Type 'delete'"
                                        class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmButton" class="btn btn-danger">Confirm</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div> -->


                    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel"> <img
                                            src="https://img.sikatpinoy.net/images/2024/07/26/imagea6f5218eb6fef2b7.png"
                                            alt="Dashboard Image" height="35" width="35"> Contact</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="contactDetails"></p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <script>
                        function showContact(contact) {
                            document.getElementById('contactDetails').innerText = contact;
                        }
                    </script>







                    <div class="modal fade" id="unameModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel"> <img
                                            src="https://img.sikatpinoy.net/images/2024/07/26/imagea6f5218eb6fef2b7.png"
                                            alt="Dashboard Image" height="35" width="35"> BHW</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="unameDetails"></p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <script>
                        function showUname(uname) {
                            document.getElementById('unameDetails').innerText = uname;
                        }
                    </script>

                    <!-- <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                        var confirmButton = document.getElementById('confirmButton');
                        var confirmationInput = document.getElementById('confirmationInput');
                        var actionToPerform = '';
                        var idToDelete = '';

                        window.openModal = function(id) {
                            idToDelete = id;
                            confirmModal.show(); // Show the modal
                        }

                        confirmButton.addEventListener('click', function() {
                            if (confirmationInput.value === 'delete') {
                                submitForm('delete', idToDelete);
                                confirmModal.hide(); // Hide the modal
                            } else {
                                alert("Type 'delete' to confirm.");
                            }
                        });
                    });

                    function submitForm(action, id) {
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = ''; // Replace with your actual action URL

                        var inputAction = document.createElement('input');
                        inputAction.type = 'hidden';
                        inputAction.name = 'action';
                        inputAction.value = action;
                        form.appendChild(inputAction);

                        var inputId = document.createElement('input');
                        inputId.type = 'hidden';
                        inputId.name = 'id';
                        inputId.value = id;
                        form.appendChild(inputId);

                        document.body.appendChild(form);
                        form.submit();
                    }
                    </script> -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            setupModal('approved', 'approved', 'confirmModalapproved', 'confirmButtonApproved', 'confirmationInputApproved');
                            setupModal('declined', 'declined', 'confirmModaldeclined', 'confirmButtonDeclined', 'confirmationInputDeclined');
                            setupModal('cancel', 'cancel', 'confirmModalcancel', 'confirmButtoncancel', 'confirmationInputcancel');
                        });

                        function setupModal(actionName, confirmationText, modalId, buttonId, inputId) {
                            var confirmModal = new bootstrap.Modal(document.getElementById(modalId));
                            var confirmButton = document.getElementById(buttonId);
                            var confirmationInput = document.getElementById(inputId);
                            var idToAction = '';

                            window['open' + actionName] = function (id) {
                                idToAction = id;
                                confirmModal.show(); // Show the modal
                            }

                            confirmButton.addEventListener('click', function () {
                                if (confirmationInput.value === confirmationText) {
                                    submitForm(actionName, idToAction);
                                    confirmModal.hide(); // Hide the modal
                                } else {
                                    alert("Type '" + confirmationText + "' to confirm.");
                                }
                            });
                        }

                        function submitForm(action, id) {
                            var form = document.createElement('form');
                            form.method = 'POST';
                            form.action = ''; // Replace with your actual action URL

                            var inputAction = document.createElement('input');
                            inputAction.type = 'hidden';
                            inputAction.name = 'action';
                            inputAction.value = action;
                            form.appendChild(inputAction);

                            var inputId = document.createElement('input');
                            inputId.type = 'hidden';
                            inputId.name = 'id';
                            inputId.value = id;
                            form.appendChild(inputId);

                            document.body.appendChild(form);
                            form.submit();
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








    <div class="modal fade" id="baptismalmodal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="header">
                            <img src="https://img.sikatpinoy.net/images/2024/08/07/image-removebg-preview-1.png"
                                alt="Right Image">
                            <h1>Baptismal</h1>
                            <img src="https://img.sikatpinoy.net/images/2024/08/14/image-removebg-preview.png"
                                alt="Left Image 2">
                        </div>
                        <small> St. Joseph cathedral Parish </small>
                        <p>This form is used to apply for the Baptism/ Christening of child/candidate at St. Joseph
                            Cathedral Parish Church,
                            San Jose, Mindoro</p>


                        <form method="POST" action="" class="ui grid form" enctype="multipart/form-data">
                            <label for="fullname">Full name:</label>
                            <input type="text" name="fullname" required>

                            <label for="gender">Gender:</label>
                            <select name="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>

                            <label for="dateofbirth">Date of Birth:</label>
                            <input type="date" name="dateofbirth" required>

                            <label for="sched">Baptism Date and Time:</label>
                            <input type="datetime-local" name="sched" required>

                            <label for="address">Address:</label>
                            <input type="text" name="address" required>

                            <label for="phone">Phone Number:</label>
                            <input type="tel" name="phone" required>

                            <label for="fathersname">Father's Name:</label>
                            <input type="text" name="fathersname" required>

                            <label for="father_occupation">Occupation:</label>
                            <input type="text" name="father_occupation" required>

                            <label for="mothersname">Mother's Name:</label>
                            <input type="text" name="mothersname" required>

                            <label for="mother_occupation">Occupation:</label>
                            <input type="text" name="mother_occupation" required>

                            <label>Godparents:</label>
                            <div class="godparents">
                                <input type="text" name="godparents_1" placeholder="1.">
                                <input type="text" name="godparents_2" placeholder="2.">
                                <input type="text" name="godparents_3" placeholder="3.">
                                <input type="text" name="godparents_4" placeholder="4.">
                                <input type="text" name="godparents_5" placeholder="5.">
                            </div>

                            <input type="hidden" name="uname" value="<?php echo $t['user_name']; ?>">

                            <div class="user-id">
                                <label for="userid">Upload Picture:</label>
                                <input type="file" name="picture" accept="image/png, image/jpeg" required>
                            </div>

                            <button type="submit" name="upload" class="submit-btn">&#9658;</button>
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

    <!-- <script>
    function openFileViewers(files) {
        // Path to your PDF and DOCX files directory
        var filePath = '';
        var fileUrl = filePath + files;

        var fileExtension = files.split('.').pop().toLowerCase();
        var viewerUrl = '';

        if (fileExtension === 'pdf') {
            viewerUrl = fileUrl;
        } else if (fileExtension === 'docx') {
            viewerUrl = 'https://docs.google.com/viewer?url=' + encodeURIComponent(fileUrl);
        } else {
            alert('Unsupported file type.');
            return;
        }

        // Set the source of the iframe
        var iframe = document.getElementById('fileViewerS');
        iframe.src = viewerUrl;

        // Show the modal
        $('#fileModals').modal('show');
    }
    </script> -->

    <!--=================================
 footer -->

    <!--=================================
 jquery -->

    <script>
        var notificationElement = document.getElementById('notification');
        if (notificationElement.innerHTML !== '') {
            setTimeout(function () {
                notificationElement.innerHTML = '';
            }, 5000); // Clear notification after 5 seconds
        }
    </script>
    <!-- jquery -->
    <script src="/assets/js/jquery-3.3.1.min.js"></script>

    <!-- plugins-jquery -->
    <script src="/assets/js/plugins-jquery.js"></script>

    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';
    </script>

    <!-- chart -->
    <script src="/assets/js/chart-init.js"></script>

    <!-- calendar -->
    <script src="/assets/js/calendar.init.js"></script>

    <!-- charts sparkline -->
    <script src="/assets/js/sparkline.init.js"></script>

    <!-- charts morris -->
    <script src="/assets/js/morris.init.js"></script>

    <!-- sweetalert2 -->
    <script src="/assets/js/sweetalert2.js"></script>

    <!-- toastr -->
    <script src="/assets/js/toastr.js"></script>

    <!-- validation -->
    <script src="/assets/js/validation.js"></script>

    <!-- lobilist -->
    <script src="/assets/js/lobilist.js"></script>

    <!-- custom -->
    <script src="/assets/js/custom.js"></script>

    <script src="/assets/alertifyjs/alertify.js"></script>

    <script>
        $(function () {
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
        window.addEventListener('click', function (event) {
            if (event.target == modal) {
                closeModal();
            }
        });
    </script>

    <script>
        function openEditModal(id) {
            // Use AJAX to fetch the data based on the ID
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_patient.php?id=' + id, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    // Populate the form fields in the modal
                    document.querySelector('input[name="firstname"]').value = data.firstname;
                    document.querySelector('input[name="lastname"]').value = data.lastname;
                    document.querySelector('input[name="diagnosis"]').value = data.diagnosis;
                    document.querySelector('input[name="dateofbirth"]').value = data.dateofbirth;
                    document.querySelector('input[name="address"]').value = data.address;
                    document.querySelector('input[name="date"]').value = data.date;
                    document.querySelector('input[name="contact"]').value = data.contact;
                    document.querySelector('img').src = data.picture; // Display current picture
                    document.querySelector('input[name="log_id"]').value = data.log_id;

                    // Show the modal
                    $('#pdfModalss').modal('show');
                } else {
                    alert('Error fetching data');
                }
            };
            xhr.send();
        }
    </script>
    <script>
        function showFullImage(imagePath) {
            // Create a new image element for the full-size image
            const fullImage = document.createElement('img');
            fullImage.src = imagePath;
            fullImage.style.maxWidth = '100%';
            fullImage.style.height = 'auto';

            // Create a modal to display the full-size image
            const modal = document.createElement('div');
            modal.style.position = 'fixed';
            modal.style.top = '0';
            modal.style.left = '0';
            modal.style.width = '100%';
            modal.style.height = '100%';
            modal.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
            modal.style.display = 'flex';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
            modal.style.cursor = 'pointer';
            modal.appendChild(fullImage);

            // Append the modal to the body
            document.body.appendChild(modal);

            // Remove the modal when clicked
            modal.addEventListener('click', function () {
                document.body.removeChild(modal);
            });
        }
    </script>


</body>

</html>