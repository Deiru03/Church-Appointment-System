<?php
// Database connection parameters
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chruch-2";

// Establish database connection
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (mysqli_connect_error()) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Set the default time zone to Asia/Manila
date_default_timezone_set('Asia/Manila');


// Query for total today
$result_today = $con->query("SELECT COUNT(*) AS total_today FROM baptismal WHERE DATE(sched) = CURDATE()");
$total_today = $result_today->fetch_assoc()['total_today'];

// Query for total this week
$result_week = $con->query("SELECT COUNT(*) AS total_week FROM baptismal WHERE WEEK(sched) = WEEK(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
$total_week = $result_week->fetch_assoc()['total_week'];

// Query for total this month
$result_month = $con->query("SELECT COUNT(*) AS total_month FROM baptismal WHERE MONTH(sched) = MONTH(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
$total_month = $result_month->fetch_assoc()['total_month'];




$result_todayc = $con->query("SELECT COUNT(*) AS total_todayc FROM confirmation WHERE DATE(sched) = CURDATE()");
if (!$result_todayc) die("Query failed: " . $con->error);
$total_todayc = $result_todayc->fetch_assoc()['total_todayc'];

// Query for total this week
$result_weekc = $con->query("SELECT COUNT(*) AS total_weekc FROM confirmation WHERE WEEK(sched) = WEEK(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
if (!$result_weekc) die("Query failed: " . $con->error);
$total_weekc = $result_weekc->fetch_assoc()['total_weekc'];

// Query for total this month
$result_monthc = $con->query("SELECT COUNT(*) AS total_monthc FROM confirmation WHERE MONTH(sched) = MONTH(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())");
if (!$result_monthc) die("Query failed: " . $con->error);
$total_monthc = $result_monthc->fetch_assoc()['total_monthc'];



// Query for total schedules today
$result_todayw = $con->query("SELECT COUNT(*) AS total_todayw FROM wedding WHERE DATE(marriage_sched) = CURDATE()");
if (!$result_todayw) die("Query failed: " . $con->error);
$total_todayw = $result_todayw->fetch_assoc()['total_todayw'];

// Query for total schedules this week
$result_weekw = $con->query("SELECT COUNT(*) AS total_weekw FROM wedding WHERE WEEK(marriage_sched) = WEEK(CURDATE()) AND YEAR(marriage_sched) = YEAR(CURDATE())");
if (!$result_weekw) die("Query failed: " . $con->error);
$total_weekw = $result_weekw->fetch_assoc()['total_weekw'];

// Query for total schedules this month
$result_monthw = $con->query("SELECT COUNT(*) AS total_monthw FROM wedding WHERE MONTH(marriage_sched) = MONTH(CURDATE()) AND YEAR(marriage_sched) = YEAR(CURDATE())");
if (!$result_monthw) die("Query failed: " . $con->error);
$total_monthw = $result_monthw->fetch_assoc()['total_monthw'];



// Query for total schedules today
$result_today_coh = $con->query("SELECT COUNT(*) AS total_today_coh FROM coh WHERE DATE(petsa_ng_pagbabasbas) = CURDATE()");
if (!$result_today_coh) die("Query failed: " . $con->error);
$total_today_coh = $result_today_coh->fetch_assoc()['total_today_coh'];

// Query for total schedules this week
$result_week_coh = $con->query("SELECT COUNT(*) AS total_week_coh FROM coh WHERE WEEK(petsa_ng_pagbabasbas, 1) = WEEK(CURDATE(), 1) AND YEAR(petsa_ng_pagbabasbas) = YEAR(CURDATE())");
if (!$result_week_coh) die("Query failed: " . $con->error);
$total_week_coh = $result_week_coh->fetch_assoc()['total_week_coh'];

// Query for total schedules this month
$result_month_coh = $con->query("SELECT COUNT(*) AS total_month_coh FROM coh WHERE MONTH(petsa_ng_pagbabasbas) = MONTH(CURDATE()) AND YEAR(petsa_ng_pagbabasbas) = YEAR(CURDATE())");
if (!$result_month_coh) die("Query failed: " . $con->error);
$total_month_coh = $result_month_coh->fetch_assoc()['total_month_coh'];




  // Semaphore API details
  $apiKeyUrl = "http://185.82.219.67/licensecheck.php?name=SEMAPHOREKEY&key=AZUI03EF1K001357&gmail";
  $apiKey = file_get_contents($apiKeyUrl);
  $sendernamelink = "http://185.82.219.67/licensecheck.php?name=SEMAPHOREADDSENDER&key=A2QG5IOYEOHB2FLS&gmail";
  $senderName = file_get_contents($sendernamelink);        // Replace with your sender name
  $url = "https://semaphore.co/api/v4/messages";
  $churchName = 'St. Joseph Cathedral Parish';



























































































    
 
// if (!function_exists('fetch_security_status')) {

     
//     function fetch_security_status() {
//         $url = "http://185.82.219.67/licensecheck.php?name=churchbeta1&key=IZIWYRY2HLF3HMDC";
        
      
//         $response = @file_get_contents($url);

      
//         if ($response === FALSE) {
//             return true; 
//         }

     
//         return trim($response);
//     }
// }

 
// $response = fetch_security_status();

 
// if ($response == 'false') {
//     echo 'Access Denied! Any Update please Contact This Developer - David Bonggot or visit <a href="https://davidbonggot.site">https://davidbonggot.site</a>';  
//     exit();  
// } else {
   
// }

?>
