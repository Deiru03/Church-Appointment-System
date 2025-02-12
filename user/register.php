<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('extension/connect.php');

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function username_check($user_name) {
    global $con;

    // Check if the username is in email format
    if (!is_valid_email($user_name)) {
        return false;
    }

    $query = mysqli_query($con, "SELECT * FROM users WHERE user_name='$user_name'");
    if (mysqli_num_rows($query) > 0) {
        return false; // Username already exists
    } else {
        return true; // Username is available
    }
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email_notification($to, $subject, $message) {
    // Configure your SMTP settings here
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = '587'; // or 465 for SSL
    $smtp_username = 'schedulechurch@gmail.com';
    $smtp_password = 'komgbstuqmvaunrc';

    // // Load PHPMailer library
    // require 'PHPMailer/src/Exception.php';
    // require 'PHPMailer/src/PHPMailer.php';
    // require 'PHPMailer/src/SMTP.php';

    // // Create a PHPMailer object
    // $mail = new PHPMailer();

    // // Enable SMTP
    // $mail->isSMTP();
    // $mail->Host       = $smtp_host;
    // $mail->SMTPAuth   = true;
    // $mail->Username   = $smtp_username;
    // $mail->Password   = $smtp_password;
    // $mail->SMTPSecure = 'tls'; // or 'ssl' for SSL
    // $mail->Port       = $smtp_port;

    // // Set From, To, Subject, and Body
    // $mail->setFrom($smtp_username, 'CHURCH-RESERVATION');
    // $mail->addAddress($to);
    // $mail->Subject = $subject;
    // $mail->Body    = $message;

    // // Send the email
    // if ($mail->send()) {
    //     return true;
    // } else {
    //     return false;
    // }
}

$status = ''; 
if (isset($_POST['register'])) {
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $user_name = mysqli_real_escape_string($con, $_POST['username']);
    $user_pass = mysqli_real_escape_string($con, $_POST['password']);
    $re_pass = mysqli_real_escape_string($con, $_POST['re_password']);
    $picture = $_FILES['picture'];
    $auth_pass = md5($user_pass);

    // Check if passwords match
    if ($user_pass !== $re_pass) {
        $status = '<div class="alert alert-warning">Passwords do not match.</div>';
    } else {
        $kwery = mysqli_query($con, "SELECT maintenance FROM admin");
        $rows_kwery = mysqli_fetch_array($kwery);
        $maintenance_mode = $rows_kwery['maintenance'];

        if ($maintenance_mode == 0) {
            if (is_valid_email($user_name)) { // Check if the username follows email format
                if ($user_pass != '') {
                    if (username_check($user_name)) {
                        // Upload picture
                        $target_dir = "uploads/pictures/";
                        $imageFileType = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
                        $target_file = $target_dir . time() . '.' . $imageFileType;
                        $uploadOk = 1;

                        // Check if image file is a actual image or fake image
                        $check = getimagesize($picture["tmp_name"]);
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            $status = '<div class="alert alert-warning">File is not an image.</div>';
                            $uploadOk = 0;
                        }

                        // Check if file already exists (not necessary with timestamp-based naming)
                        // Check file size
                        if ($picture["size"] > 500000) {
                            $status = '<div class="alert alert-warning">Sorry, your file is too large.</div>';
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif") {
                            $status = '<div class="alert alert-warning">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $status .= '<div class="alert alert-danger">Sorry, your file was not uploaded.</div>';
                        } else {
                            if (move_uploaded_file($picture["tmp_name"], $target_file)) {
                                // Insert user data into the database
                                $query = mysqli_query($con, "INSERT INTO users(`full_name`, `user_name`, `user_pass`, `user_encryptedPass`, `user_status`, `picture`) VALUES ('$full_name', '$user_name', '$user_pass', '$auth_pass','notsubmitted', '$target_file')");

                                if ($query) {
                                    // Send email notification
                                    $subject = 'Registration Confirmation';
                                    $message = 'Thank you for registering on our website.';
                                    // if (send_email_notification($user_name, $subject, $message)) {
                                    //     // Email sent successfully
                                    //     $status = '<div class="alert alert-success">Registration successful!.</div> <meta http-equiv="refresh" content="5; url=/user/login">';
                                    // } else {
                                    //     // Failed to send email
                                    //     $status = '<div class="alert alert-warning">Registration successful, but failed to send confirmation email.</div>';
                                    // }
                                } else {
                                    $status = '<div class="alert alert-danger">Registration failed. Please try again later.</div>';
                                }
                            } else {
                                $status .= '<div class="alert alert-danger">Sorry, there was an error uploading your file.</div>';
                            }
                        }
                    } else {
                        $status = '<div class="alert alert-warning">Username already exists. Please choose a different username.</div>';
                    }
                } else {
                    $status = '<div class="alert alert-warning">Please enter a password.</div>';
                }
            } else {
                $status = '<div class="alert alert-warning">Invalid email format.</div>';
            }
        } else {
            $status = '<div class="alert alert-warning">The website is currently under maintenance. Registration is not allowed.</div>';
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php include('extension/title.php'); ?> | Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/church/assets/images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/church/assets/css/style.css" />

</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="/church/assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        <!--=================================
 login-->

 <section class="height-100vh d-flex align-items-center page-section-ptb login"
         style="background-image: url('https://img.sikatpinoy.net/images/2024/07/30/411290198_672262648420031_4110901413062602878_n.jpg'); background-size: cover; background-position: center;">

            <div class="container">
                <div class="justify-content-center no-gutters vertical-align" align="center">
                    <div class="col-lg-4 col-md-6 " style="background-color: #40a3ed;">
                       
                    </div>
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg"
                        style="background-image: url(/assets/images/login-inner-bg-David-Bonggot.png);">
                        <div class="login-fancy pb-40 clearfix">
                            <form method="post" id="createSingleUserForm" class="ui grid form"
                                enctype="multipart/form-data">
                                <div align="center">
                                    <h3
                                        style="font-family: 'Tahoma', sans-serif; font-size: 24px; font-weight: bold; color: black; text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;">
                                        REGISTER FORM
                                    </h3>
                                </div>
                                <?php echo isset($status) ? $status : ''; ?>
                                <div class="row field">
                                    <!-- <label class="twelve wide column" for="full_name" style="color: white;">Full
                                        Name</label> -->
                                    <div class="twelve wide column">
                                        <div class="ui input">
                                            <input type="text" id="full_name" name="full_name"
                                                aria-describedby="full_name" placeholder="Enter full name"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row field">
                                    <!-- <label class="twelve wide column" for="username" style="color: white;">Username
                                        (Email)</label> -->
                                    <div class="twelve wide column">
                                        <div class="ui input">
                                            <input type="email" id="username" name="username"
                                                aria-describedby="username" placeholder="Enter email" autocomplete="off"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row field">
                                    <!-- <label class="twelve wide column" for="password"
                                        style="color: white;">Password</label> -->
                                    <div class="twelve wide column">
                                        <div class="ui input">
                                            <input type="password" id="password" name="password"
                                                aria-describedby="password" placeholder="Enter password"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row field">
                                    <!-- <label class="twelve wide column" for="re_password" style="color: white;">Re-enter
                                        Password</label> -->
                                    <div class="twelve wide column">
                                        <div class="ui input">
                                            <input type="password" id="re_password" name="re_password"
                                                aria-describedby="re_password" placeholder="Re-enter password"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row field">
                                    <!-- <label class="twelve wide column" for="picture"
                                        style="color: white;">Picture</label> -->
                                    <div class="twelve wide column">
                                        <div class="ui input">
                                            <input type="file" id="picture" name="picture" aria-describedby="picture"
                                                required>
                                        </div>
                                        <small style="color:white">CHOOSE PROFILE PICTURE</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="twelve wide column"></label>
                                    <div class="twelve wide column">
                                        <button type="submit" name="register" class="btn btn-primary ml-15">Register
                                            Account</button>
                                    </div>
                                </div>
                                <p class="mt-20 mb-0" style="color: white;">Already have an account? <a href="login"
                                        style="color:blue"> Login Now!</a></p>
                            </form>

                        </div>
                    </div>
                </div>
        </section>

        <!--=================================
 login-->

    </div>



    <!--=================================
 jquery -->

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
</body>

</html>
