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


if(!isset($_POST['action_a'])){
    
}else{
    if($_POST['action_a'] == 'password'){
        $newpass = rand(0,9999999);
        $authvpn = md5($newpass);
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET user_pass = '$newpass', user_encryptedPass = '$authvpn' WHERE user_id='$u'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Password] Reset successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Password] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'block'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET is_freeze='1' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Block successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'unblock'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET is_freeze='0' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Unblock successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Unblock failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'review'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET student_type='pendingpre-school' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Students] Review successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Students] Aprroved failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif ($_POST['action_a'] == 'approved1') {
        $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id
    
        // Fetch existing confirmation data from the JSON file
        $jsonFile = 'wedding.json';  // Specify the path to your JSON file
        $jsonData = file_get_contents($jsonFile);
        $confirmations = json_decode($jsonData, true);
    
        // Find the entry with the matching log_id
        foreach ($confirmations as &$confirmation) {
            if ($confirmation['log_id'] == $log_id) {
                $confirmation['bapstatus'] = '1';  // Update bapstatus to '1'
                break;  // Exit loop once found
            }
        }
    
        // Save the updated data back to the JSON file
        file_put_contents($jsonFile, json_encode($confirmations, JSON_PRETTY_PRINT));
    
        // Fetch phone number and schedule datetime for SMS notification
        $phone = ''; // Initialize phone number
        $sched = ''; // Initialize schedule datetime
    
        foreach ($confirmations as $confirmation) {
            if ($confirmation['log_id'] == $log_id) {
                $phone = $confirmation['phone'];
                $sched = $confirmation['sched'];
                break;  // Exit loop once found
            }
        }
    
        if (!empty($phone) && !empty($sched)) {
            // Format phone number to E.164
            if (substr($phone, 0, 2) == '09') {
                $phone = '+63' . substr($phone, 1);
            }
    
            // Convert datetime to a more readable format
            $dateTime = new DateTime($sched);
            $formattedDate = $dateTime->format('F j, Y'); // e.g., August 14, 2024
            $formattedTime = $dateTime->format('g:i A'); // e.g., 11:25 PM
    
            // Assuming $titles contains additional information (e.g., "Confirmation Ceremony")
            $titles = 'Confirmation Ceremony';
    
            // Twilio SMS Notification
            require_once 'vendor/autoload.php';
    
            try {
                // Send the SMS
                $message = $twilio->messages->create(
                    $phone,  // The recipient's phone number from the JSON file
                    array(
                        "from" => "+12515722383",  // Your Twilio phone number
                        "body" => "Congratulations, your confirmation has been approved. Your schedule is on $formattedDate at $formattedTime for $titles."
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
    }
    
    elseif ($_POST['action_a'] == 'declined1') {
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
    }elseif ($_POST['action_a'] == 'cancel') {
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
    }elseif ($_POST['action_a'] == 'deletes') {
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
    }elseif ($_POST['action_a'] == 'delete') {
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
    }else{
        
    }
}



?>

<?php

if (isset($_POST['upload'])) {
    // Automatically generate a unique log_id
    $log_id = uniqid('log_'); // Generates a unique log_id like 'log_5f2a67b5d22d7'

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
            $seminar_date = htmlspecialchars($_POST['seminar_date']);
            $interview_date = htmlspecialchars($_POST['interview_date']);
            
            // Groom's Information
            $groom_name = htmlspecialchars($_POST['groom_name']);
            $groom_age = htmlspecialchars($_POST['groom_age']);
            $groom_birthplace = htmlspecialchars($_POST['groom_birthplace']);
            $groom_status = htmlspecialchars($_POST['groom_status']);
            $groom_residence = htmlspecialchars($_POST['groom_residence']);
            $groom_father = htmlspecialchars($_POST['groom_father']);
            $groom_mother = htmlspecialchars($_POST['groom_mother']);
            $groom_baptism = htmlspecialchars($_POST['groom_baptism']);
            $groom_confirmation = htmlspecialchars($_POST['groom_confirmation']);
            $groom_witnesses = htmlspecialchars($_POST['groom_witnesses']);
            
            // Bride's Information
            $bride_name = htmlspecialchars($_POST['bride_name']);
            $bride_age = htmlspecialchars($_POST['bride_age']);
            $bride_birthplace = htmlspecialchars($_POST['bride_birthplace']);
            $bride_status = htmlspecialchars($_POST['bride_status']);
            $bride_residence = htmlspecialchars($_POST['bride_residence']);
            $bride_father = htmlspecialchars($_POST['bride_father']);
            $bride_mother = htmlspecialchars($_POST['bride_mother']);
            $bride_baptism = htmlspecialchars($_POST['bride_baptism']);
            $bride_confirmation = htmlspecialchars($_POST['bride_confirmation']);
            $bride_witnesses = htmlspecialchars($_POST['bride_witnesses']);
            
            // Marriage Information
            $sched = htmlspecialchars($_POST['sched']);
            $schedtime = htmlspecialchars($_POST['schedtime']);
            $phone = htmlspecialchars($_POST['phone']);

            $proofpayment = htmlspecialchars($_POST['proofpayment']);
            $statuspayment = htmlspecialchars($_POST['statuspayment']);
            $bapstatus = htmlspecialchars($_POST['bapstatus']);
            $uname = htmlspecialchars($_POST['uname']); // Username

            // Save to wedding.json
            $jsonFile = 'wedding.json';

            // Check if the file exists and is readable
            if (file_exists($jsonFile)) {
                $jsonData = file_get_contents($jsonFile);
                $dataArray = json_decode($jsonData, true);
            } else {
                $dataArray = [];
            }

            // Create a new entry to append
            $newData = [
                'log_id' => $log_id, // Automatically generated log_id
                'seminar_date' => $seminar_date,
                'interview_date' => $interview_date,
                'groom' => [
                    'name' => $groom_name,
                    'age' => $groom_age,
                    'birthplace' => $groom_birthplace,
                    'civil_status' => $groom_status,
                    'residence' => $groom_residence,
                    'father' => $groom_father,
                    'mother' => $groom_mother,
                    'baptism' => $groom_baptism,
                    'confirmation' => $groom_confirmation,
                    'witnesses' => $groom_witnesses
                ],
                'bride' => [
                    'name' => $bride_name,
                    'age' => $bride_age,
                    'birthplace' => $bride_birthplace,
                    'civil_status' => $bride_status,
                    'residence' => $bride_residence,
                    'father' => $bride_father,
                    'mother' => $bride_mother,
                    'baptism' => $bride_baptism,
                    'confirmation' => $bride_confirmation,
                    'witnesses' => $bride_witnesses
                ],
                'marriage' => [
                    'sched' => $sched,
                    'schedtime' => $schedtime,
                    'phone' => $phone
                ],
                'picture' => $pictureUploadFile,
                'proofpayment' => $proofpayment,
                'statuspayment' => $statuspayment,
                'bapstatus' => $bapstatus,
                'uname' => $uname,
                'date' => date('Y-m-d H:i:s')
            ];

            // Append the new entry to the array
            $dataArray[] = $newData;

            // Encode the updated array back to JSON
            if (file_put_contents($jsonFile, json_encode($dataArray, JSON_PRETTY_PRINT))) {
                echo 'Record saved to JSON file successfully!';
            } else {
                echo '<script>
                        alert("Failed to save data to the JSON file.");
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


<?php
if (isset($_POST['pay'])) {
    // Check if a proof of payment was uploaded
    if (isset($_FILES['proofpayment']) && $_FILES['proofpayment']['error'] === UPLOAD_ERR_OK) {
        // Define allowed file types for proof of payment
        $allowedExtensions = array('png', 'jpg', 'jpeg');
        $proofExtension = pathinfo($_FILES['proofpayment']['name'], PATHINFO_EXTENSION);

        // Check if the file extension is allowed
        if (!in_array(strtolower($proofExtension), $allowedExtensions)) {
            echo '<script>
                    alert("Only PNG, JPG, and JPEG images are allowed for payment proof.");
                    window.location.reload();
                  </script>';
            exit;
        }

        // Generate a unique filename for the proof of payment
        $timestamp = date('YmdHis');
        $uniqueProofFilename = $timestamp . '.' . $proofExtension;
        $proofUploadDir = 'img/picture/';
        $proofUploadFile = $proofUploadDir . $uniqueProofFilename;

        // Move the uploaded proof of payment
        if (move_uploaded_file($_FILES['proofpayment']['tmp_name'], $proofUploadFile)) {
            // Retrieve and sanitize form inputs
            $log_id = htmlspecialchars($_POST['log_id']);
            
            // Define the JSON file path
            $jsonFilePath = 'wedding.json';

            // Read existing data from the JSON file, if it exists
            $dataArray = array(); // Initialize an empty array

            if (file_exists($jsonFilePath)) {
                $jsonData = file_get_contents($jsonFilePath);
                $dataArray = json_decode($jsonData, true); // Decode the existing JSON to an array
            }

            // Flag to check if log_id was found
            $logFound = false;

            // Loop through each entry to find the log_id and update it
            foreach ($dataArray as &$entry) {
                if ($entry['log_id'] === $log_id) {
                    // Update the proofpayment and statuspayment fields for the existing log_id
                    $entry['proofpayment'] = $proofUploadFile;
                    $entry['statuspayment'] = '1'; // Set status to paid
                    $logFound = true; // Mark as found
                    break; // Exit loop after finding the log_id
                }
            }

            // If log_id was not found, you can handle it here if needed
            if (!$logFound) {
                echo '<script>
                        alert("Log ID not found in the confirmation file.");
                      </script>';
                exit;
            }

            // Encode the updated array back to JSON format and save it to the file
            if (file_put_contents($jsonFilePath, json_encode($dataArray, JSON_PRETTY_PRINT))) {
                // Show success message
                echo '<div class="alert alert-success alert-dismissible" role="alert">
                        Successfully uploaded proof of payment and updated the status.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                       
                      </div>';
            } else {
                echo '<script>
                        alert("Error saving the payment confirmation to JSON.");
                      </script>';
            }
        } else {
            echo '<script>
                    alert("Error uploading the proof of payment.");
                  </script>';
        }
    } else {
        echo '<script>
                alert("No proof of payment was uploaded or an error occurred.");
              </script>';
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action_a']) && $_POST['action_a'] == 'approved') {
    $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

    // Fetch existing confirmation data from the JSON file
    $jsonFile = 'wedding.json';  // Specify the path to your JSON file
    $jsonData = file_get_contents($jsonFile);
    $confirmations = json_decode($jsonData, true);

    // Find the entry with the matching log_id
    foreach ($confirmations as &$confirmation) {
        if ($confirmation['log_id'] == $log_id) {
            $confirmation['bapstatus'] = '1';  // Update bapstatus to '1'
            break;  // Exit loop once found
        }
    }

    // Save the updated data back to the JSON file
    file_put_contents($jsonFile, json_encode($confirmations, JSON_PRETTY_PRINT));

    // Fetch phone number and schedule datetime for SMS notification
    $phone = ''; // Initialize phone number
    $sched = ''; // Initialize schedule datetime

    foreach ($confirmations as $confirmation) {
        if ($confirmation['log_id'] == $log_id) {
            $phone = $confirmation['phone'];
            $sched = $confirmation['sched'];
            break;  // Exit loop once found
        }
    }

    // Twilio SMS Notification (assuming you have Twilio setup)
    if (!empty($phone) && !empty($sched)) {
        // Format phone number to E.164
        if (substr($phone, 0, 2) == '09') {
            $phone = '+63' . substr($phone, 1);
        }

        // Convert datetime to a more readable format
        $dateTime = new DateTime($sched);
        $formattedDate = $dateTime->format('F j, Y'); // e.g., August 14, 2024
        $formattedTime = $dateTime->format('g:i A'); // e.g., 11:25 PM

        // Assuming $titles contains additional information (e.g., "Confirmation Ceremony")
        $titles = 'Confirmation Ceremony';

        require_once 'vendor/autoload.php'; // Load Twilio SDK

        try {
            // Send the SMS
            $message = $twilio->messages->create(
                $phone,  // The recipient's phone number from the JSON file
                array(
                    "from" => "+12515722383",  // Your Twilio phone number
                    "body" => "Congratulations, your confirmation has been approved. Your schedule is on $formattedDate at $formattedTime for $titles."
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
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action_a']) && $_POST['action_a'] == 'declined') {
    $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

    // Fetch existing confirmation data from the JSON file
    $jsonFile = 'wedding.json';  // Specify the path to your JSON file
    $jsonData = file_get_contents($jsonFile);
    $confirmations = json_decode($jsonData, true);

    // Find the entry with the matching log_id
    foreach ($confirmations as &$confirmation) {
        if ($confirmation['log_id'] == $log_id) {
            $confirmation['bapstatus'] = '2';  // Update bapstatus to '1'
            break;  // Exit loop once found
        }
    }

    // Save the updated data back to the JSON file
    file_put_contents($jsonFile, json_encode($confirmations, JSON_PRETTY_PRINT));

    // Fetch phone number and schedule datetime for SMS notification
    $phone = ''; // Initialize phone number
    $sched = ''; // Initialize schedule datetime

    foreach ($confirmations as $confirmation) {
        if ($confirmation['log_id'] == $log_id) {
            $phone = $confirmation['phone'];
            $sched = $confirmation['sched'];
            break;  // Exit loop once found
        }
    }

    // Twilio SMS Notification (assuming you have Twilio setup)
    if (!empty($phone) && !empty($sched)) {
        // Format phone number to E.164
        if (substr($phone, 0, 2) == '09') {
            $phone = '+63' . substr($phone, 1);
        }

        // Convert datetime to a more readable format
        $dateTime = new DateTime($sched);
        $formattedDate = $dateTime->format('F j, Y'); // e.g., August 14, 2024
        $formattedTime = $dateTime->format('g:i A'); // e.g., 11:25 PM

        // Assuming $titles contains additional information (e.g., "Confirmation Ceremony")
        $titles = 'Confirmation Ceremony';

        require_once 'vendor/autoload.php'; // Load Twilio SDK

        try {
            // Send the SMS
            $message = $twilio->messages->create(
                $phone,  // The recipient's phone number from the JSON file
                array(
                    "from" => "+12515722383",  // Your Twilio phone number
                    "body" => "your confirmation has been Declined for $titles."
                )
            );

            // Show approval success message with SMS confirmation
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                           Approval Declined Done. SMS sent to ' . $phone . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } catch (Exception $e) {
            // Handle SMS sending failure
            $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                           Approval Declined Done but SMS failed to send: ' . $e->getMessage() . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } else {
        // No phone number or schedule found
        $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                       Approval Declined Done but no phone number or schedule found for SMS.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>';
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action_a']) && $_POST['action_a'] == 'cancel') {
    $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

    // Fetch existing confirmation data from the JSON file
    $jsonFile = 'wedding.json';  // Specify the path to your JSON file
    $jsonData = file_get_contents($jsonFile);
    $confirmations = json_decode($jsonData, true);

    // Find the entry with the matching log_id
    foreach ($confirmations as &$confirmation) {
        if ($confirmation['log_id'] == $log_id) {
            $confirmation['bapstatus'] = '3';  // Update bapstatus to '1'
            break;  // Exit loop once found
        }
    }

    // Save the updated data back to the JSON file
    file_put_contents($jsonFile, json_encode($confirmations, JSON_PRETTY_PRINT));

    // Fetch phone number and schedule datetime for SMS notification
    $phone = ''; // Initialize phone number
    $sched = ''; // Initialize schedule datetime

    foreach ($confirmations as $confirmation) {
        if ($confirmation['log_id'] == $log_id) {
            $phone = $confirmation['phone'];
            $sched = $confirmation['sched'];
            break;  // Exit loop once found
        }
    }

    // Twilio SMS Notification (assuming you have Twilio setup)
    if (!empty($phone) && !empty($sched)) {
        // Format phone number to E.164
        if (substr($phone, 0, 2) == '09') {
            $phone = '+63' . substr($phone, 1);
        }

        // Convert datetime to a more readable format
        $dateTime = new DateTime($sched);
        $formattedDate = $dateTime->format('F j, Y'); // e.g., August 14, 2024
        $formattedTime = $dateTime->format('g:i A'); // e.g., 11:25 PM

        // Assuming $titles contains additional information (e.g., "Confirmation Ceremony")
        $titles = 'Confirmation Ceremony';

        require_once 'vendor/autoload.php'; // Load Twilio SDK

        try {
            // Send the SMS
            $message = $twilio->messages->create(
                $phone,  // The recipient's phone number from the JSON file
                array(
                    "from" => "+12515722383",  // Your Twilio phone number
                    "body" => "your confirmation has been cancel for $titles."
                )
            );

            // Show approval success message with SMS confirmation
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                           Approval cancel Done. SMS sent to ' . $phone . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } catch (Exception $e) {
            // Handle SMS sending failure
            $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                           Approval cancel Done but SMS failed to send: ' . $e->getMessage() . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } else {
        // No phone number or schedule found
        $status = '<div class="alert alert-warning alert-dismissible" role="alert">
                       Approval cancel Done but no phone number or schedule found for SMS.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>';
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
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
        input[type="text"], input[type="date"], input[type="tel"], select {
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

        <div class="container-fluid" >
            <div class="row">
                <?php include('extension/sidenav.php'); ?>
                <!-- main content wrapper start-->

                <div class="content-wrapper" >
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"></h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">

                               
                                <?php if($user_rank == 'normal' ){ ?>
                                    <li class="breadcrumb-item"><a href="#" class="default-color"><button
                                                data-toggle="modal" data-target="#baptismalmodal"> <img
                                                    src="https://img.sikatpinoy.net/images/2024/08/14/imageebd8db62f2da2051.png"
                                                    alt="Dashboard Image" height="20" width="25">  APPLY WEDDING</button>
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
            <th>Groom & Bride Name</th>
            <th>Date Apply</th>
            <th>Marriage Date</th>
            <th>Phone</th>
            <th>Proofpayment</th>
            <th>Payment Status</th>
            <th>Baptism Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Load and parse the wedding JSON file
        $jsonFile = 'wedding.json';
        if (file_exists($jsonFile)) {
            $jsonData = file_get_contents($jsonFile);
            $dataArray = json_decode($jsonData, true);
        } else {
            $dataArray = [];
        }

        // Check if there are records in the JSON file
        if (count($dataArray) > 0) {
            foreach ($dataArray as $row) {
                // Extract baptism status and ensure it is set
                $bapstatus = isset($row['bapstatus']) ? $row['bapstatus'] : 0;

                // Check if the user has permission to view based on rank and baptism status
                if (($user_rank == 'superadmin' && $bapstatus == 2) || ($user_rank == 'normal' && in_array($bapstatus, [0, 1, 2, 3]))) {
                    // Extract wedding details
                    $groomName = $row['groom']['name'];
                    $brideName = $row['bride']['name'];
                    $dateApply = date('M d, Y', strtotime($row['date']));
                    $marriageDate = date('M d, Y', strtotime($row['marriage']['sched']));
                    $phone = $row['marriage']['phone'];
                    $picture = !empty($row['picture']) ? $row['picture'] : 'img/noimage.jpg'; // Default if no picture
                    $proofpayment = !empty($row['proofpayment']) ? $row['proofpayment'] : 'img/noimage.jpg'; // Default if no proofpayment
                    $statuspayment = isset($row['statuspayment']) ? $row['statuspayment'] : 0;
                    $uname = $row['uname'];

                    // Set status text for payment
                    $statusText = '';
                    switch ($statuspayment) {
                        case 1:
                            $statusText = '<label class="badge badge-success">DONE</label>';
                            break;
                        case 2:
                            $statusText = '<label class="badge badge-danger">DECLINED</label>';
                            break;
                        default:
                            $statusText = '<label class="badge badge-warning">PENDING</label>';
                            break;
                    }

                    // Set status text for baptism
                    $bapstat = '';
                    switch ($bapstatus) {
                        case 1:
                            $bapstat = '<label class="badge badge-success">APPROVED</label>';
                            break;
                        case 2:
                            $bapstat = '<label class="badge badge-danger">DECLINED</label>';
                            break;
                        default:
                            $bapstat = '<label class="badge badge-warning">PENDING</label>';
                            break;
                    }

                    // Display table row
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo htmlspecialchars($picture); ?>" alt="Picture"
                                 style="width:35px; height: 35px; border-radius: 50%; object-fit: cover;">
                        </td>
                        <td><?php echo htmlspecialchars($groomName . ' & ' . $brideName); ?></td>
                        <td><?php echo $dateApply; ?></td>
                        <td><?php echo $marriageDate; ?></td>
                        <td><?php echo htmlspecialchars($phone); ?></td>
                        <td align="center">
                            <a href="javascript:void(0);" onclick="showFullImage('<?php echo htmlspecialchars($proofpayment); ?>')">
                                <img src="<?php echo htmlspecialchars($proofpayment); ?>" alt="Proof of Payment"
                                     style="width:35px; height:35px; object-fit: cover; border-radius: 5px;">
                            </a>
                        </td>
                        <td><?php echo $statusText; ?></td>
                        <td><?php echo $bapstat; ?></td>
                        <td>
                            <div class="dropdown show">
                                <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <?php if ($user_rank == 'superadmin' && $bapstatus == 0 && $statuspayment == 1) { ?>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="openApproved('<?php echo htmlspecialchars($row['log_id']); ?>')">APPROVED</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="opendeclined('<?php echo htmlspecialchars($row['log_id']); ?>')">DECLINED</a>
                                    <?php } ?>
                                    <?php if ($user_rank == 'normal' && $bapstatus == 0) { ?>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="openPaymentModal('<?php echo htmlspecialchars($row['log_id']); ?>')">PAY NOW</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="opencancel('<?php echo htmlspecialchars($row['log_id']); ?>')">CANCEL</a>
                                    <?php } ?>
                                    <form method="post" action="profile2">
                                        <input type="hidden" name="log_id" value="<?php echo htmlspecialchars($row['log_id']); ?>">
                                        <button type="submit" class="dropdown-item">FULL INFO</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            }
        } else {
            echo '<tr><td colspan="9">No records found.</td></tr>';
        }
    ?>
    </tbody>
</table>

<script>
    function showFullImage(imagePath) {
        const imageWindow = window.open(imagePath, '_blank');
        imageWindow.focus();
    }
</script>


            </div>
        </div>
    </div>
</div>


                    </div>
<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Payment Instructions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>1. Scan the QR Code below to pay via GCash:</h6>
        <img src="https://img.sikatpinoy.net/images/2024/08/19/Screenshot_2024_0819_105720.png" alt="GCash QR Code" style="width: 100%; max-width: 300px; display: block; margin: 0 auto;"/>
        <hr>
        <h6>2. Upload the screenshot of your payment below:</h6>
        <form id="paymentForm" method="post" enctype="multipart/form-data">
          <input type="hidden" name="log_id" id="log_id_payment">
          <div class="form-group">
            <label for="proofpayment">Upload Screenshot:</label>
            <input type="file" name="proofpayment" id="proofpayment" class="form-control-file" required>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="pay">Submit Payment Proof</button>
          </div>
          <div class="progress" style="display:none;">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function openPaymentModal(logId) {
    document.getElementById('log_id_payment').value = logId;
    $('#paymentModal').modal('show');
}
</script>
<!-- Approved Modal -->
<div class="modal fade" id="confirmModalapproved" tabindex="-1" role="dialog" aria-labelledby="confirmModalApprovedLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalApprovedLabel">Confirm Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Type 'approved' to confirm approval:</p>
                <input type="text" id="confirmationInputApproved" placeholder="Type 'approved'" class="form-control">
                <input type="hidden" id="log_id_approve"> <!-- Hidden input to store log_id -->
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmButtonApproved" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
function openApproved(logId) {
    // Set the log ID for the approved record
    document.getElementById('log_id_approve').value = logId;
    
    // Show the approval modal
    $('#confirmModalapproved').modal('show');
}

document.addEventListener('DOMContentLoaded', function() {
    var confirmButton = document.getElementById('confirmButtonApproved');
    var confirmationInput = document.getElementById('confirmationInputApproved');

    confirmButton.addEventListener('click', function() {
        // Check if the input matches 'approved'
        if (confirmationInput.value.trim().toLowerCase() === 'approved') {
            var logId = document.getElementById('log_id_approve').value; // Get log ID
            
            // Create a form to submit the approval
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = ''; // Your PHP script to handle the approval

            // Create a hidden input for action type
            var inputAction = document.createElement('input');
            inputAction.type = 'hidden';
            inputAction.name = 'action_a';
            inputAction.value = 'approved'; // Action type for approval
            form.appendChild(inputAction);

            // Create a hidden input for the log ID
            var inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'action_u';
            inputId.value = logId;
            form.appendChild(inputId);

            // Append the form to the body and submit
            document.body.appendChild(form);
            form.submit(); // Submit the form to the server

            $('#confirmModalapproved').modal('hide'); // Hide the modal after confirming
        } else {
            alert("Type 'approved' to confirm."); // Alert if input is incorrect
        }
    });
});
</script>

<div class="modal fade" id="confirmModaldeclined" tabindex="-1" role="dialog" aria-labelledby="confirmModaldeclinedLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModaldeclinedLabel">Confirm Declined</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Type 'declined' to confirm decline:</p>
                <input type="text" id="confirmationInputdeclined" placeholder="Type 'declined'" class="form-control">
                <input type="hidden" id="log_id_declined"> <!-- Hidden input to store log_id -->
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmButtondeclined" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
function opendeclined(logId) {
    // Set the log ID for the declined record
    document.getElementById('log_id_declined').value = logId;
    
    // Show the decline confirmation modal
    $('#confirmModaldeclined').modal('show');
}

document.addEventListener('DOMContentLoaded', function() {
    var confirmButton = document.getElementById('confirmButtondeclined');
    var confirmationInput = document.getElementById('confirmationInputdeclined');

    confirmButton.addEventListener('click', function() {
        // Check if the input matches 'declined'
        if (confirmationInput.value.trim().toLowerCase() === 'declined') {
            var logId = document.getElementById('log_id_declined').value; // Get log ID
            
            // Create a form to submit the decline action
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = ''; // Your PHP script to handle the decline

            // Create a hidden input for action type
            var inputAction = document.createElement('input');
            inputAction.type = 'hidden';
            inputAction.name = 'action_a';
            inputAction.value = 'declined'; // Action type for decline
            form.appendChild(inputAction);

            // Create a hidden input for the log ID
            var inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'action_u';
            inputId.value = logId;
            form.appendChild(inputId);

            // Append the form to the body and submit
            document.body.appendChild(form);
            form.submit(); // Submit the form to the server

            $('#confirmModaldeclined').modal('hide'); // Hide the modal after confirming
        } else {
            alert("Type 'declined' to confirm."); // Alert if input is incorrect
        }
    });
});
</script>



<!-- Cancel Confirmation Modal -->
<div class="modal fade" id="confirmModalCancel" tabindex="-1" role="dialog" aria-labelledby="confirmModalCancelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalCancelLabel">Confirm Cancel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Type 'cancel' to confirm cancellation:</p>
                <input type="text" id="confirmationInputCancel" placeholder="Type 'cancel'" class="form-control">
                <input type="hidden" id="log_id_cancel"> <!-- Hidden input to store log_id -->
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmButtonCancel" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
// Function to open the cancel confirmation modal
function opencancel(logId) {
    // Set the log ID for the canceled record
    document.getElementById('log_id_cancel').value = logId;
    
    // Show the cancel confirmation modal
    $('#confirmModalCancel').modal('show');
}

document.addEventListener('DOMContentLoaded', function() {
    var confirmButtonCancel = document.getElementById('confirmButtonCancel');
    var confirmationInputCancel = document.getElementById('confirmationInputCancel');

    confirmButtonCancel.addEventListener('click', function() {
        // Check if the input matches 'cancel'
        if (confirmationInputCancel.value.trim().toLowerCase() === 'cancel') {
            var logId = document.getElementById('log_id_cancel').value; // Get log ID
            
            // Create a form to submit the cancel action
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = ''; // Your PHP script to handle the cancel action

            // Create a hidden input for action type
            var inputAction = document.createElement('input');
            inputAction.type = 'hidden';
            inputAction.name = 'action_a';
            inputAction.value = 'cancel'; // Action type for cancellation
            form.appendChild(inputAction);

            // Create a hidden input for the log ID
            var inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'action_u';
            inputId.value = logId;
            form.appendChild(inputId);

            // Append the form to the body and submit
            document.body.appendChild(form);
            form.submit(); // Submit the form to the server

            $('#confirmModalCancel').modal('hide'); // Hide the modal after confirming
        } else {
            alert("Type 'cancel' to confirm."); // Alert if input is incorrect
        }
    });
});
</script>
 
<!-- Declined Modal
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
                <button type="button" id="confirmButtonDeclined" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Cancel Modal
<div class="modal fade" id="confirmModalcancel" tabindex="-1" role="dialog"
    aria-labelledby="confirmModalCancelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalCancelLabel">Confirm Cancel</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this record? Type 'cancel' to confirm.</p>
                <input type="text" id="confirmationInputcancel" placeholder="Type 'cancel'" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmButtoncancel" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
 -->


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



<!-- 


<script>
document.addEventListener('DOMContentLoaded', function() {
    setupModal('approved', 'approved', 'confirmModalapproved', 'confirmButtonApproved', 'confirmationInputApproved');
});

function setupModal(actionName, confirmationText, modalId, buttonId, inputId) {
    var confirmModal = new bootstrap.Modal(document.getElementById(modalId));
    var confirmButton = document.getElementById(buttonId);
    var confirmationInput = document.getElementById(inputId);
    var idToAction = '';

    window['open' + actionName.charAt(0).toUpperCase() + actionName.slice(1)] = function(id) {
        idToAction = id;
        confirmModal.show(); // Show the modal
    }

    confirmButton.addEventListener('click', function() {
        if (confirmationInput.value.toLowerCase() === confirmationText) {
            submitForm(actionName, idToAction);
            confirmModal.hide(); // Hide the modal
        } else {
            alert("Type '" + confirmationText + "' to confirm.");
        }
    });
}

function submitForm(action, id) {
    // Create a new XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "wedding.json", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    // Prepare data to send
    var data = JSON.stringify({
        action: action,
        id: id
    });

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle success response
            alert("Approval processed for ID: " + id);
            // Optionally refresh the page or update the UI here
        } else if (xhr.readyState === 4) {
            // Handle error response
            alert("Error processing approval.");
        }
    };

    xhr.send(data);
}
</script>

 -->







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
                    <!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    setupModal('approved', 'approved', 'confirmModalapproved', 'confirmButtonApproved', 'confirmationInputApproved');
    setupModal('declined', 'declined', 'confirmModaldeclined', 'confirmButtonDeclined', 'confirmationInputDeclined');
    setupModal('cancel', 'cancel', 'confirmModalcancel', 'confirmButtoncancel', 'confirmationInputcancel');
});

function setupModal(actionName, confirmationText, modalId, buttonId, inputId) {
    var confirmModal = new bootstrap.Modal(document.getElementById(modalId));
    var confirmButton = document.getElementById(buttonId);
    var confirmationInput = document.getElementById(inputId);
    var idToAction = '';

    window['open' + actionName] = function(id) {
        idToAction = id;
        confirmModal.show(); // Show the modal
    }

    confirmButton.addEventListener('click', function() {
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
</script> -->








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
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content" >
                <div class="modal-body">
                <div class="container" style="background-color: #a7b0a9;">
        <div class="header">
        <img src="https://img.sikatpinoy.net/images/2024/08/14/imageebd8db62f2da2051.png"  alt="Right Image">
        <h1>Wedding Form</h1>
            <img src="https://img.sikatpinoy.net/images/2024/09/30/image-removebg-preview-3.png"   alt="Left Image 2">
        </div>
        <small> St. Joseph cathedral Parish </small>
        <p>This form is used to apply for the Weeding at St. Joseph Cathedral Parish Church, 
        San Jose, Mindoro</p> 
        
        
        <form method="POST" action="" class="ui grid form" enctype="multipart/form-data">
    <!-- Date of Seminar / Date of Interview -->
    <label for="seminar_date">Date of Seminar:</label>
    <input type="date" name="seminar_date" required>

    <label for="interview_date">Date of Interview:</label>
    <input type="date" name="interview_date" required>

    <!-- Groom Details -->
    <h3>Groom</h3>
    <label for="groom_name">Name:</label>
    <input type="text" name="groom_name" required>

    <label for="groom_age">Age, Date of Birth:</label>
    <input type="text" name="groom_age" placeholder="Age, Date of Birth" required>

    <label for="groom_birthplace">Place of Birth:</label>
    <input type="text" name="groom_birthplace" required>

    <label for="groom_status">Civil Status:</label>
    <input type="text" name="groom_status" required>

    <label for="groom_residence">Residence:</label>
    <input type="text" name="groom_residence" required>

    <label for="groom_father">Father's Name:</label>
    <input type="text" name="groom_father" required>

    <label for="groom_mother">Mother's Name:</label>
    <input type="text" name="groom_mother" required>

    <label for="groom_baptism">Baptism:</label>
    <input type="text" name="groom_baptism" required>

    <label for="groom_confirmation">Confirmation:</label>
    <input type="text" name="groom_confirmation" required>

    <label for="groom_witnesses">Witnesses/Sponsors:</label>
    <textarea name="groom_witnesses"></textarea>

    <!-- Bride Details -->
    <h3>Bride</h3>
    <label for="bride_name">Name:</label>
    <input type="text" name="bride_name" required>

    <label for="bride_age">Age, Date of Birth:</label>
    <input type="text" name="bride_age" placeholder="Age, Date of Birth" required>

    <label for="bride_birthplace">Place of Birth:</label>
    <input type="text" name="bride_birthplace" required>

    <label for="bride_status">Civil Status:</label>
    <input type="text" name="bride_status" required>

    <label for="bride_residence">Residence:</label>
    <input type="text" name="bride_residence" required>

    <label for="bride_father">Father's Name:</label>
    <input type="text" name="bride_father" required>

    <label for="bride_mother">Mother's Name:</label>
    <input type="text" name="bride_mother" required>

    <label for="bride_baptism">Baptism:</label>
    <input type="text" name="bride_baptism" required>

    <label for="bride_confirmation">Confirmation:</label>
    <input type="text" name="bride_confirmation" required>

    <label for="bride_witnesses">Witnesses/Sponsors:</label>
    <textarea name="bride_witnesses"></textarea>

    <!-- Date of Marriage -->
    <label for="marriage_date">Date of Marriage:</label>
    <input type="date" name="sched" required>

    <label for="marriage_time">Time:</label>
    <input type="time" name="schedtime" required>

    <label for="contact_number">Contact Number:</label>
    <input type="tel" name="phone" required>

    <!-- Remarks Section -->
    <label>Remarks:</label>
    <input type="checkbox" name="baptismal_cert_groom"> Baptismal Cert (Groom)
    <input type="checkbox" name="baptismal_cert_bride"> Baptismal Cert (Bride)
    <br>
    <input type="checkbox" name="birth_cert_groom"> Birth Cert (Groom)
    <input type="checkbox" name="birth_cert_bride"> Birth Cert (Bride)
    <br>
    <input type="checkbox" name="cenomar_groom"> CENOMAR (Groom)
    <input type="checkbox" name="cenomar_bride"> CENOMAR (Bride)
    <br>
    <label for="interviewer">Interviewer:</label>
    <input type="text" name="interviewer" >

    <input type="hidden" name="uname" value="<?php echo $t['user_name']; ?>">
    <input type="hidden" name="proofpayment" value="">
    <input type="hidden" name="statuspayment" value="0">
    <input type="hidden" name="bapstatus" value="0">

<div class="user-id">
    <label for="userid">Upload Picture:</label>
    <input type="file" name="picture" accept="image/png, image/jpeg" required>
</div>

    <!-- Submit Button -->
    <button type="submit" name="upload" class="submit-btn">Submit</button>
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

    <script>
    function openEditModal(id) {
        // Use AJAX to fetch the data based on the ID
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_patient.php?id=' + id, true);
        xhr.onload = function() {
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
    fullImage.style.height = '70%';

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

<script>
function generateLogId(length) {
    const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let logId = '';
    for (let i = 0; i < length; i++) {
        logId += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return logId;
}

window.onload = function() {
    const logIdInput = document.getElementById('log_id');
    logIdInput.value = generateLogId(10); // Generate a 10-character log_id
};
</script>

</body>

</html>
