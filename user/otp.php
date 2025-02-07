<?php
session_start();
include('extension/connect.php');

$status = '';
if (isset($_POST['verify_otp'])) {
    $user_id = $_SESSION['userid']; // Get the user ID from the session
    $input_otp = mysqli_real_escape_string($con, $_POST['otp']);

    // Fetch the saved OTP from the database
    $query = mysqli_query($con, "SELECT otp FROM users WHERE user_id='$user_id'");
    $result = mysqli_fetch_assoc($query);
    if ($result && $result['otp'] == $input_otp) {
        $_SESSION['id'] = session_id(); // Storing the session ID
        $_SESSION['userid'] = $user_id; // Storing user ID
        $_SESSION['login_type'] = "users"; // Specifying login type

        // Redirect to dashboard
        echo "<script>window.location.href = 'dashboard';</script>";
        exit();
    } else {
        $status = '<div class="alert alert-danger">Invalid OTP. Please try again.</div>';
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
    <link rel="shortcut icon" href="/assets/images/favicon.ico" />

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
            <img src="/assets/images/pre-loader/loader-01.svg" alt="">
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
                                            src="https://img.sikatpinoy.net/images/2024/08/07/photo_2024-07-30_09-46-38-removebg-preview.png"
                                            height="100px" width="100px"></h2>

                                </div>
                                <?php echo $status; ?>
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="otp" style="color: white;">Enter OTP</label>
                                    <input id="otp" class="web form-control" type="text" placeholder="One-Time Password"
                                        name="otp" required>
                                </div>
                                <div class="section-field">
                                    <button name="verify_otp" type="submit" class="button">
                                        <span>Verify OTP</span>
                                    </button>

                                </div>

                                <br>
                                <a href="login"> Back to login page</a>





                            </form>
                        </div>
                    </div>
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
    <script src="/assets/js/jquery-3.3.1.min.js"></script>

    <!-- plugins-jquery -->
    <script src="/assets/js/plugins-jquery.js"></script>

    <!-- plugin_path -->
    <script>
        var plugin_path = '/assets/js/';
    </script>

    <!-- chart -->
    <script src="/assets/js/chart-init.js"></script>

    <!-- calendar -->
    <script src="/assets/js/calendar.init.js"></script>

    <!-- charts sparkline -->
    <script src="/assets/js/sparkline.init.js"></script>

    <!-- charts morris -->
    <script src="/assets/js/morris.init.js"></script>

    <!-- datepicker -->
    <script src="/assets/js/datepicker.js"></script>

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

</body>

</html>