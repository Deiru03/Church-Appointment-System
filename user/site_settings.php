<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
include('extension/rank_check.php');
$userid = $_SESSION['userid'];
$search = $userid;
?>

<?php
$status = ''; // Initialize the $status variable before the if statement

if (isset($_POST['siteupdate'])) {
    $webname = mysqli_real_escape_string($con, $_POST['webname']);
    $weburl = mysqli_real_escape_string($con, $_POST['weburl']);
    $maintenance = mysqli_real_escape_string($con, $_POST['maintenance']);
    $mytheme = mysqli_real_escape_string($con, $_POST['themez']);
    $mytxt = mysqli_real_escape_string($con, $_POST['themetext']);

    if ($webname != '' && $weburl != '') {
        $query = mysqli_query($con, "UPDATE admin SET title_name='$webname', website='$weburl', maintenance='$maintenance', theme='$mytheme', theme_text='$mytxt'");
        if ($query) {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Site] Update successful
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Site] Update failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    } else {
        $status = "toastr.info('Please fill-out all forms!', 'Error!', {timeOut: 3000})";
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
<title><?php include('extension/title.php'); ?> | Site Settings</title>
    
<script src="/assets/js/jquery-3.3.1.min.js"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="/assets/images/favicon.ico" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="/church/assets/css/style.css" />
</head>

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
                <h4 class="mb-0"> Site Settings</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
              <li class="breadcrumb-item active">Site Settings</li>
            </ol>
          </div>
        </div>
      </div>
 
  <div class="row">
        
        <div class="col-xl-6 mb-30">
            <div class="card card-statistics mb-30">
                  <div class="card-body">
                    <h5 class="card-title">Site Settings</h5>
                    <?php echo $status; ?>
                    <form method="post" class="ui grid form">
                        
                        <?php
                        $query = mysqli_query($con,"select * from admin");
                        $result = mysqli_fetch_array($query);
                        
                        $web_name = $result['title_name'];
                        $web_url = $result['website'];
                        $mainte = $result['maintenance'];
                        $themez = $result['theme'];
                        $themeztext = $result['theme_text'];
                        ?>
                        
                        <div class="row field">
                          <label class="twelve wide column" for="webname">Website Name</label>
                          <div class="twelve wide column">
                            <div class="ui input">
                              <input id="webname" name="webname" type="text" placeholder="Enter website name" value="<?php echo $web_name; ?>" autocomplete="off" required/>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row field">
                          <label class="twelve wide column" for="weburl">Website URL</label>
                          <div class="twelve wide column">
                            <div class="ui input">
                              <input id="weburl" name="weburl" type="text" placeholder="ex. www.domain.com" value="<?php echo $web_url; ?>" autocomplete="off" required/>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row field">
                            <label class="twelve wide column" for="maintenance">Maintenance Mode</label>
                            <div class="twelve wide column">
                                <div class="ui input">
                                    <select class="custom-select custom-select-lg mb-3" id="maintenance" name="maintenance">
                                        <option value="0" selected>Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row field">
                            <label class="twelve wide column">Theme Color</label>
                            <div id="cp2" class="input-group colorpicker-component" style="flex-wrap: nowrap !important;">
                                <input type="text" name="themez" class="form-control input-lg" value="<?php echo $themez; ?>"/>
                                <div class="input-group-append">
                                    <span class="input-group-addon input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row field">
                            <label class="twelve wide column">Main Text Color</label>
                            <div id="cp1" class="input-group colorpicker-component" style="flex-wrap: nowrap !important;">
                                <input type="text" name="themetext" class="form-control input-lg" value="<?php echo $themeztext; ?>"/>
                                <div class="input-group-append">
                                    <span class="input-group-addon input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                          <label class="twelve wide column"></label>
                          <div class="twelve wide column">
                            <button type="submit" name="siteupdate" class="btn btn-primary ml-15">Submit</button>
                          </div>
                        </div>
                        
                    </form>
                </div>
            </div>
     </div>
        

           <div class="col-xl-6 mb-30">
            <div class="card card-statistics mb-30">
                  <div class="card-body">
                    <div align="center">
                    <img src="/img/R.png" height="350" width="350">
                    </div>
                </div>
            </div>
     </div>

   </div>
        
<!--=================================
 wrapper -->
      
<!-- main content wrapper end-->

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
<script src="/assets/js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="/assets/js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>var plugin_path = 'js/';</script>

<!-- chart -->
<script src="/assets/js/chart-init.js"></script>

<!-- calendar -->
<script src="/assets/js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="js/sparkline.init.js"></script>

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
  
</body>
</html>
