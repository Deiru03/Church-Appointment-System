<?php
include('extension/connect.php');
?>
<?php
    
    if (!isset($_SESSION['userid'])) {

    }else{
        header("location:dashboard");
    }
?>

<?php
session_start();
include('extension/connect.php');

// Function to generate a random OTP
function generate_otp($length = 6) {
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= mt_rand(0, 9); // Generate a random number between 0 and 9
    }
    return $otp;
}

// PHPMailer function to send the OTP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email_notification($to, $subject, $message) {
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = 587; // or 465 for SSL
    $smtp_username = 'schedulechurch@gmail.com';  // Replace with your actual email
    $smtp_password = 'komgbstuqmvaunrc';  // Your SMTP password
   
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_username;
    $mail->Password   = $smtp_password;
    $mail->SMTPSecure = 'tls';
    $mail->Port       = $smtp_port;
    
    $mail->setFrom($smtp_username, 'CHURCH-RESERVATION');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    return $mail->send();
}

$status = '';
if (isset($_POST['login'])) {
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_pass = mysqli_real_escape_string($con, $_POST['user_pass']);

    if ($user_name != '' && $user_pass != '') {
        // Query to fetch user data including the email
        $query = mysqli_query($con, "SELECT * FROM users WHERE user_name='$user_name' AND user_pass='$user_pass'");
        $num_rows = mysqli_num_rows($query);

        if ($num_rows > 0) {
            $qry = mysqli_fetch_array($query);
            $user_id = $qry['user_id'];
            $user_email = $qry['user_name']; // Assuming user_name is the Gmail address

            // Generate OTP
            // $otp_pin = generate_otp();

            // Save OTP to user's record
            // $update_otp_query = mysqli_query($con, "UPDATE users SET otp = '$otp_pin' WHERE user_id = '$user_id'");

            // if ($update_otp_query) {
            //     // Send the OTP to user's email
            //     $subject = 'Your One-Time PIN (OTP) for Login';
            //     $message = 'Your one-time PIN is: ' . $otp_pin;
            //     if (send_email_notification($user_email, $subject, $message)) {
            //         // Store user ID in session
            //         $_SESSION['userid'] = $user_id;

            //         // Redirect to OTP verification page
            //         header("Location: otp.php"); // Redirect to OTP verification page
            //         exit();
            //     } else {
            //         $status = '<div class="alert alert-danger">Failed to send OTP via email.</div>';
            //     }
            // } else {
            //     $status = '<div class="alert alert-danger">Failed to save OTP. Please try again.</div>';
            // }

            $_SESSION['id'] = session_id(); // Storing the session ID
            $_SESSION['userid'] = $user_id; // Storing user ID
            $_SESSION['login_type'] = "users"; // Specifying login type

            // Redirect to dashboard
            echo "<script>window.location.href = 'dashboard';</script>";
            exit();

            
        } else {
            $status = '<div class="alert alert-warning">Login Failed: Invalid username or password</div>';
        }
    } else {
        $status = '<p class="mt-20 mb-0 text-danger">Please fill out all forms</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="David Espinosa" />
    <meta name="description" content="David Espinosa Project" />
    <meta name="author" content="David Espinosa" />
    <meta property="og:image" content="/img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php include('extension/title.php'); ?> | Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="church/assets/images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/church/assets/css/style.css" />
</head>
<style>
.field-icon {
    float: right;
    margin-left: -23px;
    margin-top: -28px;
    position: relative;
    z-index: 2;
}

.container {
    padding-top: 50px;
    margin: auto;
}
</style>

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
                    <!-- login-fancy-bg bg -->
                    
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg"
                        style="background-image: url(/assets/images/login-inner-bg-x-davidbonggot.png);">
                        <div class="login-fancy pb-40 clearfix">
                            <form method="post">
                                <div align="center">
                                    <h2 class="text-white mb-20"><img
                                            src="https://img.sikatpinoy.net/images/2024/08/07/photo_2024-07-30_09-46-38-removebg-preview.png" height="100px"
                                            width="100px"></h2>

                                </div>
                                <?php echo $status; ?>
                                <div class="section-field mb-20">
                                    <Login class="mb-10" for="user_name" style="color: white;">Login</label>
                                    <input id="user_name" class="web form-control" type="email" placeholder="User name"
                                        name="user_name">
                                </div>
                                <div class="section-field mb-20">
                                    <!-- <label class="mb-10" for="user_pass" style="color: white;">Password* </label> -->
                                    <input id="user_pass" id="password-field" class="Password form-control"
                                        type="password" placeholder="Password" name="user_pass">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"
                                        onclick="togglePasswordVisibility()"></span>

                                </div>
                                <div class="section-field">
                                    <button name="login" type="submit" class="button">
                                        <span>Log in</span>
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <p class="mt-20 mb-0" style="color: white;">Don't have an account? <a
                                            href="register" style="color: #fcba03;"> REGISTER NOW!</a></p>
                                </div>




                            </form>
                            
                            
                    </div>
                </div><br>  <br>  <br>  <br>  <br><br>  <br>  
            </div>
            </div>

        </section>

    

        <!--=================================
 login-->
    </div>


    <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("user_pass");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
    </script>

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
