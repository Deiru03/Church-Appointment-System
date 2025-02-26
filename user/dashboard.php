<?php
date_default_timezone_set('Asia/Manila');

include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
$Badge = "warning";

?>


<?php
// Fetch Baptismal data
$result_today_bap = $con->query("SELECT COUNT(*) AS total_today FROM baptismal WHERE DATE(sched) = CURDATE()");
$result_week_bap = $con->query("SELECT COUNT(*) AS total_week FROM baptismal WHERE WEEK(sched) = WEEK(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
$result_month_bap = $con->query("SELECT COUNT(*) AS total_month FROM baptismal WHERE MONTH(sched) = MONTH(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
$total_today_bap = $result_today_bap->fetch_assoc()['total_today'];
$total_week_bap = $result_week_bap->fetch_assoc()['total_week'];
$total_month_bap = $result_month_bap->fetch_assoc()['total_month'];
$total_bap = $con->query("SELECT COUNT(*) AS total FROM baptismal")->fetch_assoc()['total'];

// Fetch Confirmation data
$result_today_conf = $con->query("SELECT COUNT(*) AS total_today FROM confirmation WHERE DATE(sched) = CURDATE()");
$result_week_conf = $con->query("SELECT COUNT(*) AS total_week FROM confirmation WHERE WEEK(sched) = WEEK(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
$result_month_conf = $con->query("SELECT COUNT(*) AS total_month FROM confirmation WHERE MONTH(sched) = MONTH(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
$total_today_conf = $result_today_conf->fetch_assoc()['total_today'];
$total_week_conf = $result_week_conf->fetch_assoc()['total_week'];
$total_month_conf = $result_month_conf->fetch_assoc()['total_month'];
$total_conf = $con->query("SELECT COUNT(*) AS total FROM confirmation")->fetch_assoc()['total'];

// Fetch Wedding data
$result_today_wed = $con->query("SELECT COUNT(*) AS total_today FROM wedding WHERE DATE(marriage_sched) = CURDATE()");
$result_week_wed = $con->query("SELECT COUNT(*) AS total_week FROM wedding WHERE WEEK(marriage_sched) = WEEK(CURDATE()) AND YEAR(marriage_sched) = YEAR(CURDATE())");
$result_month_wed = $con->query("SELECT COUNT(*) AS total_month FROM wedding WHERE MONTH(marriage_sched) = MONTH(CURDATE()) AND YEAR(marriage_sched) = YEAR(CURDATE())");
$total_today_wed = $result_today_wed->fetch_assoc()['total_today'];
$total_week_wed = $result_week_wed->fetch_assoc()['total_week'];
$total_month_wed = $result_month_wed->fetch_assoc()['total_month'];
$total_wed = $con->query("SELECT COUNT(*) AS total FROM wedding")->fetch_assoc()['total'];

// Fetch COH data
$result_today_coh = $con->query("SELECT COUNT(*) AS total_today FROM coh WHERE DATE(petsa_ng_pagbabasbas) = CURDATE()");
$result_week_coh = $con->query("SELECT COUNT(*) AS total_week FROM coh WHERE WEEK(petsa_ng_pagbabasbas) = WEEK(CURDATE()) AND YEAR(petsa_ng_pagbabasbas) = YEAR(CURDATE())");
$result_month_coh = $con->query("SELECT COUNT(*) AS total_month FROM coh WHERE MONTH(petsa_ng_pagbabasbas) = MONTH(CURDATE()) AND YEAR(petsa_ng_pagbabasbas) = YEAR(CURDATE())");
$total_today_coh = $result_today_coh->fetch_assoc()['total_today'];
$total_week_coh = $result_week_coh->fetch_assoc()['total_week'];
$total_month_coh = $result_month_coh->fetch_assoc()['total_month'];
$total_coh = $con->query("SELECT COUNT(*) AS total FROM coh")->fetch_assoc()['total'];

// Fetch Burial data
$result_today_burial = $con->query("SELECT COUNT(*) AS total_today FROM burial WHERE DATE(sched) = CURDATE()");
$result_week_burial = $con->query("SELECT COUNT(*) AS total_week FROM burial WHERE WEEK(sched) = WEEK(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
$result_month_burial = $con->query("SELECT COUNT(*) AS total_month FROM burial WHERE MONTH(sched) = MONTH(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
$total_today_burial = $result_today_burial->fetch_assoc()['total_today'];
$total_week_burial = $result_week_burial->fetch_assoc()['total_week'];
$total_month_burial = $result_month_burial->fetch_assoc()['total_month'];
$total_burial = $con->query("SELECT COUNT(*) AS total FROM burial")->fetch_assoc()['total'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="<?php include('extension/title.php'); ?>" />
  <meta name="description" content="<?php include('extension/title.php'); ?> - VPN Panel System" />
  <meta name="author" content="<?php include('extension/title.php'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title><?php include('extension/title.php'); ?> | Dashboard</title>

  <script src="js/jquery-3.3.1.min.js"></script>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php include('extension/logo.php'); ?>" />

  <!-- Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

  <!-- css -->
  <link rel="stylesheet" type="text/css" href="/church/assets/css/style.css" />

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>
<style>
  .totals {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
  }

  .total-box {
    display: flex;
    align-items: center;
    background-color: skyblue;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    position: relative;
  }

  .box-icon {
    width: 50px;
    height: 50px;
    margin-right: 15px;
  }

  .box-content {
    flex: 1;
  }

  .box-content p {
    margin: 0;
    font-size: 1.2em;
    color: #555;
  }

  .total-number {
    font-size: 2em;
    font-weight: bold;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
  }

  .month-text {
    font-size: 0.6em;
    color: #888;
    margin-left: 8px;
  }
</style>
<style>
  .active-baptism-sched {
    background-color: #f1f1f1;
    border-radius: 10px;
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    position: relative;
  }

  .active-baptism-sched h4 {
    margin-bottom: 10px;
    color: #333;
    font-size: 1.8em;
    font-weight: bold;
  }

  .sched-info {
    font-size: 1.4em;
    color: #555;
  }

  .sched-info span {
    font-weight: bold;
    color: #2c3e50;
    margin-right: 10px;
  }

  .attention-message {
    font-size: 1.2em;
    color: red;
    margin-top: 15px;
    font-weight: bold;
    background-color: #ffe9e9;
    border-radius: 5px;
    padding: 10px;
    display: inline-block;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }




  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px;
  }

  .grid-item {
    background-color: #f9f9f9;
    /* Light gray */
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .grid-item:hover {
    transform: translateY(-5px);
    /* Slight upward movement on hover */
    box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.2);
    /* Stronger shadow on hover */
  }

  .grid-item img {
    width: 150px;
    height: 200px;
    object-fit: cover;
    /* Ensures consistent aspect ratio */
    border-radius: 5px;
    /* Optional rounded corners */
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>

<body>

  <div class="wrapper">





    <!--=================================
 header start-->

    <?php include('extension/topnav.php'); ?>

    <!--=================================
 header End-->

    <!--=================================
 Main content -->

    <?php
    $query = mysqli_query($con, "select * from users where user_id='$userid'");
    $result = mysqli_fetch_array($query);

    // if($result['user_rank'] == 'superadmin' || $result['user_rank'] == 'administrator'){
    //     $credits = '&#8734;';
    //     $cred_details = 'Unlimited Credits';
    // }else{
    //     $credits = $result['user_credits'];
    //     $cred_details = 'Available Credit(s)';
    // }

    // if($result['user_credits'] > 0){
    //     $icon = 'text-success';
    // }else{
    //     $icon = 'text-danger';
    // }

    // if($result['user_rank']=='superadmin'){
    //     $que3 = mysqli_query($con,"select * from users where user_rank='export'");
    // }else{
    //     $que3 = mysqli_query($con,"select * from users where user_rank='export' and user_upline='$userid'");
    // }
    // $exp = mysqli_num_rows($que3);

    // if($exp == 0){
    //     $desc_exp = 'You have no  export users!';
    // }else{
    //     $desc_exp = 'Total export user(s)';
    // }

    //  if($result['user_rank']=='superadmin'){
    //     $que5 = mysqli_query($con,"select * from users where user_rank='subadmin'");
    // }else{
    //     $que5 = mysqli_query($con,"select * from users where user_rank='subadmin' and user_upline='$userid'");
    // }
    // $suba = mysqli_num_rows($que5);

    // if($suba == 0){
    //     $desc_suba = 'You have no Subadmin!';
    // }else{
    //     $desc_suba = 'Total Subadmin(s)';
    // }


    // if($result['user_rank']=='superadmin'){
    //     $que2 = mysqli_query($con,"select * from users where user_rank='reseller'");
    // }else{
    //     $que2 = mysqli_query($con,"select * from users where user_rank='reseller' and user_upline='$userid'");
    // }
    // $rese = mysqli_num_rows($que2);

    // if($rese == 0){
    //     $desc_reseller = 'You have no resellers!';
    // }else{
    //     $desc_reseller = 'Total reseller(s)';
    // }

    if ($result['user_rank'] == 'superadmin') {
      $que6 = mysqli_query($con, "select * from users where user_rank='normal'");
    } else {
      $que6 = mysqli_query($con, "select * from users where user_rank='normal' and user_upline='$userid'");
    }
    $users = mysqli_num_rows($que6);

    if ($users == 0) {
      $desc_users = 'You have no bhw!';
    } else {
      $desc_users = 'Total Sub bhw(s)';
    }



    // if($result['user_rank']=='superadmin'){
    //     $que4 = mysqli_query($con,"select * from users where is_active='1' and user_duration>'0'");
    // }else{
    //     $que4 = mysqli_query($con,"select * from users where is_active='1' and user_duration>'0' and user_upline='$userid'");
    // }
    // $onl = mysqli_num_rows($que4);

    // if($onl == 0){
    //     $desc_online = 'You have no users online!';
    // }else{
    //     $desc_online = 'Total user(s) online';
    // }

    // if($result['user_rank']=='superadmin'){
    //     $que11 = mysqli_query($con,"select * from users where user_rank='administrator'");
    // }else{
    //     $que11 = mysqli_query($con,"select * from users where user_rank='administrator' and user_upline='$userid'");
    // }
    // $administrator_ = mysqli_num_rows($que11);

    // if($administrator_ == 0){
    //     $desc11 = 'You have no administrators!';
    // }else{
    //     $desc11 = 'Total administrator(s)';
    // // }

    // if($result['user_rank']=='superadmin'){
    //     $que12 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and device_connected='1' and user_duration>'0' and is_freeze='0'");
    // }else{
    //     $que12 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and device_connected='1' and user_duration>'0' and is_freeze='0' and user_upline='$userid'");
    // }
    // $aclient = mysqli_num_rows($que12);

    // if($aclient == 0){
    //     $desc12 = 'You have no active users!';
    // }else{
    //     $desc12 = 'Total active user(s)';
    // }

    // if($result['user_rank']=='superadmin'){
    //     $que13 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and device_connected='0' and user_duration>'0' and is_freeze='0'");
    // }else{
    //     $que13 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and device_connected='0' and user_duration>'0' and is_freeze='0' and user_upline='$userid'");
    // }
    // $iclient = mysqli_num_rows($que13);

    // if($iclient == 0){
    //     $desc13 = 'You have no inactive users!';
    // }else{
    //     $desc13 = 'Total inactive user(s)';
    // }

    // if($result['user_rank']=='superadmin'){
    //     $que14 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and user_duration<1 and is_freeze='0'");
    // }else{
    //     $que14 = mysqli_query($con,"select * from users where (user_rank='normal' || user_rank='export') and user_duration<1 and is_freeze='0' and user_upline='$userid'");
    // }
    // $iexpired = mysqli_num_rows($que14);

    // if($iexpired == 0){
    //     $desc14 = 'You have no expired users!';
    // }else{
    //     $desc14 = 'Total expired user(s)';
    // }

    //  $dur = calc_time($bio); 
    //  $pdays = $dur['days'] . " days";
    //  $phours = $dur['hours'] . " hours";
    // $pminutes = $dur['minutes'] . " minutes";
    // $pseconds = $dur['seconds'] . " seconds";

    // $user_dur1 = strtotime($pdays . $phours . $pminutes . $pseconds);
    // $iac = date('F d, Y ', $user_dur1);
    // $kwery = mysqli_query($con,"select bio from users where user_id='$userid'");
    //             $rows_kwery = mysqli_fetch_array($kwery);      
    //             $dura = $rows_kwery['bio'];


    // if(  $bio >= '1'){
    //            $dura = $iac;
    // }elseif( $bio == '0'){
    //        $dura = '<label class="badge badge-danger">IN-ACTIVE</label>';
    // } 



    ?>

    <div>
      <!-- <div class="container-fluid"  > -->
      <div class="row">

        <?php include('extension/sidenav.php'); ?>

        <!-- main content wrapper start-->


        <div class="content-wrapper" class="height-100vh d-flex align-items-center page-section-ptb login"
          style="background-image: url('https://img.sikatpinoy.net/images/2024/07/30/411290198_672262648420031_4110901413062602878_n.jpg'); background-size: cover; background-position: center;">
          >
          <div class="page-title">
            <div class="row">
              <div class="col-sm-6">
                <?php
                $kwery = mysqli_query($con, "select maintenance from admin");
                $rows_kwery = mysqli_fetch_array($kwery);
                $maintenance_mode = $rows_kwery['maintenance'];
                if ($maintenance_mode == 1) { ?>
                  <h4 class="mb-0">ðŸ”§ UNDER MAINTENANCE ðŸ”§ </h4>
                <?php } else { ?>

                <?php } ?>
              </div>

            </div>
          </div>


          <!-- widgets -->

          <div>




            <?php if ($user_rank == 'normal') { ?>
              <div class="row" style="margin-top: 50px;">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                  <div class="card card-statistics h-100" style="background-color:grey;">
                    <div class="card-body">
                      <a href="baptismal">
                        <div class="clearfix">
                          <div class="float-left">
                            <span class="text-danger">
                              <img src="https://img.sikatpinoy.net/images/2024/08/07/image-removebg-preview-1.png"
                                height="40" width="45" alt="Document Icon">
                            </span>
                          </div>
                          <div class="float-right text-right">
                            <p class="card-text" style="color:white;"><label>BAPTISMAL REQUEST</label></p>
                            <h4 style="color: white;"> </h4>
                          </div>
                        </div>
                        <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                          <i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Request Baptismal Certificate
                        </p>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                  <div class="card card-statistics h-100" style="background-color:grey;">
                    <div class="card-body">
                      <a href="confirmation">
                        <div class="clearfix">
                          <div class="float-left">
                            <span class="text-danger">
                              <img src="https://img.sikatpinoy.net/images/2024/08/14/image48efe10dd8815c06.png"
                                height="40" width="45" alt="Document Icon">
                            </span>
                          </div>
                          <div class="float-right text-right">
                            <p class="card-text" style="color:white;"><label>CONFIRMATION REQUEST</label></p>
                            <h4 style="color: white;"> </h4>
                          </div>
                        </div>
                        <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                          <i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Request Confirmation Certificate
                        </p>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                  <div class="card card-statistics h-100" style="background-color:grey;">
                    <div class="card-body">
                      <a href="wedding1">
                        <div class="clearfix">
                          <div class="float-left">
                            <span class="text-danger">
                              <img src="https://img.sikatpinoy.net/images/2024/08/14/imageebd8db62f2da2051.png"
                                height="40" width="45" alt="Document Icon">
                            </span>
                          </div>
                          <div class="float-right text-right">
                            <p class="card-text" style="color:white;"><label>WEDDING REQUEST</label></p>
                            <h4 style="color: white;"> </h4>
                          </div>
                        </div>
                        <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                          <i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Request Marriage Certificate
                        </p>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                  <div class="card card-statistics h-100" style="background-color:grey;">
                    <div class="card-body">
                      <a href="coh">
                        <div class="clearfix">
                          <div class="float-left">
                            <span class="text-danger">
                              <img src="https://stveronicassf.com/wp-content/uploads/2021/05/icon-car-blessed.png"
                                height="40" width="45" alt="Document Icon">
                            </span>
                          </div>
                          <div class="float-right text-right">
                            <p class="card-text" style="color:white;"><label>CAR/HOUSE BLESSING</label></p>
                            <h4 style="color: white;"> </h4>
                          </div>
                        </div>
                        <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                          <i class="fa fa-plus-circle mr-1" aria-hidden="true"></i> Request Blessing Schedule
                        </p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

            <?php
            // Read and parse sched.json file
            $schedJson = file_get_contents('sched.json');
            $schedules = json_decode($schedJson, true);
            ?>
              <div class="row" style="margin-top: 50px;">
              
              <!-- Display Schedule Information -->
              <div class="col-12 mb-30">
              <div class="card card-statistics h-100" style="background-color: rgba(128, 128, 128, 0.7);">
              <div class="card-body">
                <h4 style="color: rgba(255,255,255,0.9); text-align:center; font-weight:bold; margin-bottom:25px; 
                  text-transform:uppercase; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
                Available Schedule Times
                </h4>
                
                <div class="schedule-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <?php foreach($schedules as $type => $times) { 
                if (!empty($times) && $times !== ['']) { ?>
                <div class="schedule-card" style="background: rgba(255,255,255,0.15); 
                        padding: 20px; 
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.08);
                        backdrop-filter: blur(8px);">
                  <h5 style="color: rgba(255,255,255,0.95); 
                     font-weight:bold; 
                     border-bottom: 2px solid rgba(255,255,255,0.15);
                     padding-bottom: 10px;
                     margin-bottom: 15px;">
                  <?php echo $type; ?>
                  </h5>
                  
                  <div style="color: rgba(255,255,255,0.9);">
                  <?php foreach($times as $day => $time) {
                  if($time && $day) { ?>
                  <div class="schedule-item" style="margin-bottom: 8px;
                          display: flex;
                          justify-content: space-between;
                          align-items: center;
                          padding: 5px 0;">
                    <strong style="color: rgba(255,215,0,0.85);"><?php echo $day; ?>:</strong>
                    <span style="color: rgba(255,255,255,0.85); 
                       background: rgba(0,0,0,0.15); 
                       padding: 3px 8px; 
                       border-radius: 4px;">
                    <?php echo $time; ?>
                    </span>
                  </div>
                  <?php }
                  } ?>
                  </div>
                </div>
                <?php }
                } ?>
                </div>
              </div>
              </div>
              </div>
              </div>
            <?php } ?>

            <?php if ($user_rank == 'superadmin') { ?>

            <?php } ?>


            <?php if ($user_rank == 'normal' || $user_rank == 'superadmin') { ?>
              <div class="row">


                <!-- <div  class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100"
                                style="background-color: <?php include('extension/theme.php'); ?>;">
                                <div class="card-body">
                                <?php


                                // Fetch baptism data
                                $query = "SELECT * FROM baptismal WHERE bapstatus = 1";
                                $result = $con->query($query);

                                // Check if any records are found
                                if ($result->num_rows > 0) {
                                  // Display the title only once
                                  echo "<h4>Active Mass Baptism Schedule</h4>";

                                  // Open a container for all schedules
                                  echo "<div class='schedule-container'>";

                                  // Loop through the records and display each as a separate schedule
                                  while ($row = $result->fetch_assoc()) {
                                    // Display each schedule in its own box
                                    echo "<div class='schedule-box'>";
                                    echo "<p class='sched-info'>";
                                    echo "<span>Date:</span> " . date("F j, Y", strtotime($row['sched'])) . " ";
                                    echo "<span>Time:</span> " . date("g:i A", strtotime($row['sched'])) . "";
                                    echo "</p>";
                                    echo "</div>";
                                  }

                                  // Display the attention message once after all schedules
                                  echo "<p class='attention-message'>This date is occupied and not available for other schedules.</p>";

                                  // Close the container div
                                  echo "</div>";
                                } else {
                                  echo "<p>No active mass baptism schedules.</p>";
                                }
                                ?>
                                </div>
                            </div> 
                        </div>   -->
              </div>









              <br>

            <?php } ?>


          </div>

          <div class="row">
            <?php if ($user_rank == 'superadmin') { ?>
              <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background-color:grey;">
                  <div class="card-body">
                    <a href="abaptismal">
                      <div class="clearfix">
                        <div class="float-left">
                          <span class="text-danger">
                            <img src="https://img.sikatpinoy.net/images/2024/08/07/image-removebg-preview-1.png"
                              height="40" width="45" alt="Document Icon">
                          </span>
                        </div>
                        <div class="float-right text-right">
                          <p class="card-text" style="color:white;"><label>BAPTISMAL REPORTS</label></p>
                          <h4 style="color: white;"> </h4>
                        </div>
                      </div>
                      <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                        <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Today:
                        <?php echo $total_today; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Week:
                        <?php echo $total_week; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Month:
                        <?php echo $total_month; ?>
                      </p>
                    </a>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background-color:grey;">
                  <div class="card-body">
                    <a href="aConfirmation">
                      <div class="clearfix">
                        <div class="float-left">
                          <span class="text-danger">
                            <img src="https://img.sikatpinoy.net/images/2024/08/14/image48efe10dd8815c06.png" height="40"
                              width="45" alt="Document Icon">
                          </span>
                        </div>
                        <div class="float-right text-right">
                          <p class="card-text" style="color:white;"><label>CONFIRMATION REPORTS</label></p>
                          <h4 style="color: white;"> </h4>
                        </div>
                      </div>
                      <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                        <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Today:
                        <?php echo $total_todayc; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Week:
                        <?php echo $total_weekc; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Month:
                        <?php echo $total_monthc; ?>
                      </p>
                    </a>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background-color:grey;">
                  <div class="card-body">
                    <a href="awedding">
                      <div class="clearfix">
                        <div class="float-left">
                          <span class="text-danger">
                            <img src="https://img.sikatpinoy.net/images/2024/08/14/imageebd8db62f2da2051.png" height="40"
                              width="45" alt="Document Icon">
                          </span>
                        </div>
                        <div class="float-right text-right">
                          <p class="card-text" style="color:white;"><label>WEDDING REPORTS</label></p>
                          <h4 style="color: white;"> </h4>
                        </div>
                      </div>
                      <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                        <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Today:
                        <?php echo $total_todayw; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Week:
                        <?php echo $total_weekw; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Month:
                        <?php echo $total_monthw; ?>
                      </p>
                    </a>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background-color:grey;">
                  <div class="card-body">
                    <a href="acoh">
                      <div class="clearfix">
                        <div class="float-left">
                          <span class="text-danger">
                            <img src="https://stveronicassf.com/wp-content/uploads/2021/05/icon-car-blessed.png"
                              height="40" width="45" alt="Document Icon">
                          </span>
                        </div>
                        <div class="float-right text-right">
                          <p class="card-text" style="color:white;"><label>CAR/HOUSE REPORTS</label></p>
                          <h4 style="color: white;"> </h4>
                        </div>
                      </div>
                      <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                        <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Today:
                        <?php echo $total_today_coh; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Week:
                        <?php echo $total_week_coh; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Month:
                        <?php echo $total_month_coh; ?>
                      </p>
                    </a>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100" style="background-color:grey;">
                  <div class="card-body">
                    <a href="aburial">
                      <div class="clearfix">
                        <div class="float-left">
                          <span class="text-danger">
                            <img src="path/to/burial-icon.png" height="40" width="45" alt="Burial Icon">
                          </span>
                        </div>
                        <div class="float-right text-right">
                          <p class="card-text" style="color:white;"><label>BURIAL REPORTS</label></p>
                          <h4 style="color: white;"> </h4>
                        </div>
                      </div>
                      <p class="pt-3 mb-0 mt-2 border-top" style="color:white">
                        <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Today:
                        <?php echo $total_today_burial; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Week:
                        <?php echo $total_week_burial; ?>
                        <br><i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> Total Schedules Month:
                        <?php echo $total_month_burial; ?>
                      </p>
                    </a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>

          <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
            <div class="card card-statistics h-100" style="background-color:grey;">
              <div class="card-body">
                <div style="margin: 0 auto; background-color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <canvas id="scheduleChart" width="1000" height="280"></canvas>
                </div>
              </div>
            </div>
          </div>



        <?php ?>



        <?php include('extension/footer.php'); ?>

        </div>

      </div>
    </div>
  </div>

  <!--=================================
 footer -->



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

  <!-- sweetalert2 -->
  <script src="/church/assets/js/sweetalert2.js"></script>

  <!-- toastr -->
  <script src="/church/assets/js/toastr.js"></script>

  <!-- validation -->
  <script src="/church/assets/js/validation.js"></script>

  <!-- lobilist -->
  <script src="/church/assets/js/lobilist.js"></script>

  <!-- custom -->
  <script src="/assets/js/custom.js"></script>


  <script>
    var ctx = document.getElementById('scheduleChart').getContext('2d');
    var scheduleChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Baptismal', 'Confirmation', 'Wedding', 'COH', 'Burial'],
        datasets: [{
            label: 'Today',
            data: [
              <?php echo $total_today_bap; ?>,
              <?php echo $total_today_conf; ?>,
              <?php echo $total_today_wed; ?>,
              <?php echo $total_today_coh; ?>,
              <?php echo $total_today_burial; ?>
            ],
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            borderWidth: 1
          },
          {
            label: 'This Week',
            data: [
              <?php echo $total_week_bap; ?>,
              <?php echo $total_week_conf; ?>,
              <?php echo $total_week_wed; ?>,
              <?php echo $total_week_coh; ?>,
              <?php echo $total_week_burial; ?>
            ],
            backgroundColor: 'rgb(54, 162, 235)',
            borderColor: 'rgb(54, 162, 235)',
            borderWidth: 1
          },
          {
            label: 'This Month',
            data: [
              <?php echo $total_month_bap; ?>,
              <?php echo $total_month_conf; ?>,
              <?php echo $total_month_wed; ?>,
              <?php echo $total_month_coh; ?>,
              <?php echo $total_month_burial; ?>
            ],
            backgroundColor: 'rgb(75, 192, 192)',
            borderColor: 'rgb(75, 192, 192)',
            borderWidth: 1
          },
          {
            label: 'Total',
            data: [
              <?php echo $total_bap; ?>,
              <?php echo $total_conf; ?>,
              <?php echo $total_wed; ?>,
              <?php echo $total_coh; ?>,
              <?php echo $total_burial; ?>
            ],
            backgroundColor: 'rgb(153, 102, 255)',
            borderColor: 'rgb(153, 102, 255)',
            borderWidth: 1
          }
        ]
      },
      options: {
        scales: {
          x: {
            ticks: {
              color: 'black'
            }
          },
          y: {
            beginAtZero: true,
            ticks: {
              color: 'black'
            }
          }
        }
      }
    });
  </script>

  <script>
    async function calculateSchedules() {
      try {
        console.log('Starting script...');

        // Fetch JSON data
        const response = await fetch('confirmation.json');
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        const data = await response.json();
        console.log('Fetched Data:', data);

        // Get today's date
        const now = new Date();
        const manilaNow = new Date(now.toLocaleString("en-US", {
          timeZone: "Asia/Manila"
        }));
        const today = manilaNow.toISOString().split('T')[0]; // YYYY-MM-DD format

        // Define boundaries
        const startOfMonth = new Date(manilaNow.getFullYear(), manilaNow.getMonth(), 1);
        const endOfMonth = new Date(manilaNow.getFullYear(), manilaNow.getMonth() + 1, 0);
        const dayOfMonth = manilaNow.getDate();
        const currentWeekNumber = Math.ceil(dayOfMonth / 7);
        const weekStartDate = new Date(manilaNow.getFullYear(), manilaNow.getMonth(), (currentWeekNumber - 1) * 7 + 1);
        const weekEndDate = new Date(weekStartDate);
        weekEndDate.setDate(weekStartDate.getDate() + 6);

        console.log('Today:', today);
        console.log('Week Start:', weekStartDate, 'Week End:', weekEndDate);
        console.log('Month Start:', startOfMonth, 'Month End:', endOfMonth);

        // Initialize counters
        const uniqueToday = new Set();
        const uniqueThisWeek = new Set();
        const uniqueThisMonth = new Set();

        // Count schedules
        data.forEach((entry) => {
          const schedDate = new Date(entry.sched);
          const logId = entry.log_id;

          // Count Today
          if (schedDate.toISOString().split('T')[0] === today) {
            uniqueToday.add(logId);
          }

          // Count This Week
          if (schedDate >= weekStartDate && schedDate <= weekEndDate) {
            uniqueThisWeek.add(logId);
          }

          // Count This Month
          if (schedDate >= manilaNow && schedDate <= endOfMonth) {
            uniqueThisMonth.add(logId);
          }
        });

        // Update counts
        const totalToday = uniqueToday.size;
        const totalThisWeek = uniqueThisWeek.size;
        const totalThisMonth = uniqueThisMonth.size;

        // Update the DOM
        document.getElementById('total-todayc').textContent = totalToday;
        document.getElementById('total-weekc').textContent = totalThisWeek;
        document.getElementById('total-monthc').textContent = totalThisMonth;

        console.log(`Today: ${totalToday}, Week: ${totalThisWeek}, Month: ${totalThisMonth}`);
      } catch (error) {
        console.error('Error:', error);
      }
    }

    calculateSchedules();
  </script>


  <script>
    async function syncDataToDatabase() {
      try {
        // Fetch confirmation.json
        const response = await fetch('confirmation.json');
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        const data = await response.json();

        // Send data to PHP script
        const saveResponse = await fetch('save_confirmation.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
        });

        const saveResult = await saveResponse.json();
        console.log('Database Update Status:', saveResult);

      } catch (error) {
        console.error('Error syncing data:', error);
      }
    }

    // Run every 5 seconds
    setInterval(syncDataToDatabase, 5000);
  </script>

  <script>
    async function syncWeddingDataToDatabase() {
      try {
        const response = await fetch('wedding.json');
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        const data = await response.json();

        // Combine sched and schedtime into marriage_sched in the correct format
        const updatedData = data.map((item) => {
          const marriageSched = `${item.marriage.sched} ${item.marriage.schedtime}`;
          return {
            ...item,
            marriage_sched: marriageSched
          };
        });

        const saveResponse = await fetch('save_wedding.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(updatedData),
        });

        const saveResult = await saveResponse.json();
        console.log('Database Update Status:', saveResult);
      } catch (error) {
        console.error('Error syncing wedding data:', error);
      }
    }

    setInterval(syncWeddingDataToDatabase, 10000);
  </script>

  <script>
    async function syncCohDataToDatabase() {
      try {
        const response = await fetch('coh.json');
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        const data = await response.json();

        const saveResponse = await fetch('save_coh.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
        });

        const saveResult = await saveResponse.json();
        console.log('Database Update Status:', saveResult);
      } catch (error) {
        console.error('Error syncing coh data:', error);
      }
    }

    setInterval(syncCohDataToDatabase, 5000);
  </script>




  <script>
    // Function to fetch and update data
    async function updateDashboard() {
      try {
        // Fetch the latest data from the server
        const response = await fetch('dashboard_data.php'); // Replace with your PHP file
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();

        // Update the HTML elements
        document.getElementById('total_today_bap').textContent = data.total_today_bap;
        document.getElementById('total_week_bap').textContent = data.total_week_bap;
        document.getElementById('total_month_bap').textContent = data.total_month_bap;

        document.getElementById('total_today_conf').textContent = data.total_today_conf;
        document.getElementById('total_week_conf').textContent = data.total_week_conf;
        document.getElementById('total_month_conf').textContent = data.total_month_conf;

        document.getElementById('total_today_wed').textContent = data.total_today_wed;
        document.getElementById('total_week_wed').textContent = data.total_week_wed;
        document.getElementById('total_month_wed').textContent = data.total_month_wed;

        document.getElementById('total_today_coh').textContent = data.total_today_coh;
        document.getElementById('total_week_coh').textContent = data.total_week_coh;
        document.getElementById('total_month_coh').textContent = data.total_month_coh;

        document.getElementById('total_today_burial').textContent = data.total_today_burial;
        document.getElementById('total_week_burial').textContent = data.total_week_burial;
        document.getElementById('total_month_burial').textContent = data.total_month_burial;

        // Update the chart data
        scheduleChart.data.datasets[0].data = [
          data.total_today_bap,
          data.total_today_conf,
          data.total_today_wed,
          data.total_today_coh,
          data.total_today_burial
        ];
        scheduleChart.data.datasets[1].data = [
          data.total_week_bap,
          data.total_week_conf,
          data.total_week_wed,
          data.total_week_coh,
          data.total_week_burial
        ];
        scheduleChart.data.datasets[2].data = [
          data.total_month_bap,
          data.total_month_conf,
          data.total_month_wed,
          data.total_month_coh,
          data.total_month_burial
        ];
        scheduleChart.data.datasets[3].data = [
          data.total_bap,
          data.total_conf,
          data.total_wed,
          data.total_coh,
          data.total_burial
        ];

        // Refresh the chart
        scheduleChart.update();
      } catch (error) {
        console.error('Error updating dashboard:', error);
      }
    }

    // Update every 5 seconds
    setInterval(updateDashboard, 5000);

    // Initial update
    updateDashboard();
  </script>
</body>

</html>