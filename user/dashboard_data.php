<?php
header('Content-Type: application/json');

// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chruch-2";

$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($con->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $con->connect_error]);
    exit;
}

// Fetch Baptismal data
$total_today_bap = $con->query("SELECT COUNT(*) AS total_today FROM baptismal WHERE DATE(sched) = CURDATE()")->fetch_assoc()['total_today'] ?? 0;
$total_week_bap = $con->query("SELECT COUNT(*) AS total_week FROM baptismal WHERE WEEK(sched) = WEEK(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())")->fetch_assoc()['total_week'] ?? 0;
$total_month_bap = $con->query("SELECT COUNT(*) AS total_month FROM baptismal WHERE MONTH(sched) = MONTH(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())")->fetch_assoc()['total_month'] ?? 0;
$total_bap = $con->query("SELECT COUNT(*) AS total FROM baptismal")->fetch_assoc()['total'] ?? 0;

// Fetch Confirmation data
$total_today_conf = $con->query("SELECT COUNT(*) AS total_today FROM confirmation WHERE DATE(sched) = CURDATE()")->fetch_assoc()['total_today'] ?? 0;
$total_week_conf = $con->query("SELECT COUNT(*) AS total_week FROM confirmation WHERE WEEK(sched) = WEEK(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())")->fetch_assoc()['total_week'] ?? 0;
$total_month_conf = $con->query("SELECT COUNT(*) AS total_month FROM confirmation WHERE MONTH(sched) = MONTH(CURDATE()) AND YEAR(sched) = YEAR(CURDATE())")->fetch_assoc()['total_month'] ?? 0;
$total_conf = $con->query("SELECT COUNT(*) AS total FROM confirmation")->fetch_assoc()['total'] ?? 0;

// Fetch Wedding data
$total_today_wed = $con->query("SELECT COUNT(*) AS total_today FROM wedding WHERE DATE(marriage_sched) = CURDATE()")->fetch_assoc()['total_today'] ?? 0;
$total_week_wed = $con->query("SELECT COUNT(*) AS total_week FROM wedding WHERE WEEK(marriage_sched) = WEEK(CURDATE()) AND YEAR(marriage_sched) = YEAR(CURDATE())")->fetch_assoc()['total_week'] ?? 0;
$total_month_wed = $con->query("SELECT COUNT(*) AS total_month FROM wedding WHERE MONTH(marriage_sched) = MONTH(CURDATE()) AND YEAR(marriage_sched) = YEAR(CURDATE())")->fetch_assoc()['total_month'] ?? 0;
$total_wed = $con->query("SELECT COUNT(*) AS total FROM wedding")->fetch_assoc()['total'] ?? 0;

// Fetch COH data
$total_today_coh = $con->query("SELECT COUNT(*) AS total_today FROM coh WHERE DATE(petsa_ng_pagbabasbas) = CURDATE()")->fetch_assoc()['total_today'] ?? 0;
$total_week_coh = $con->query("SELECT COUNT(*) AS total_week FROM coh WHERE WEEK(petsa_ng_pagbabasbas) = WEEK(CURDATE()) AND YEAR(petsa_ng_pagbabasbas) = YEAR(CURDATE())")->fetch_assoc()['total_week'] ?? 0;
$total_month_coh = $con->query("SELECT COUNT(*) AS total_month FROM coh WHERE MONTH(petsa_ng_pagbabasbas) = MONTH(CURDATE()) AND YEAR(petsa_ng_pagbabasbas) = YEAR(CURDATE())")->fetch_assoc()['total_month'] ?? 0;
$total_coh = $con->query("SELECT COUNT(*) AS total FROM coh")->fetch_assoc()['total'] ?? 0;

// Return the data as JSON
echo json_encode([
    "total_today_bap" => $total_today_bap,
    "total_week_bap" => $total_week_bap,
    "total_month_bap" => $total_month_bap,
    "total_bap" => $total_bap,
    "total_today_conf" => $total_today_conf,
    "total_week_conf" => $total_week_conf,
    "total_month_conf" => $total_month_conf,
    "total_conf" => $total_conf,
    "total_today_wed" => $total_today_wed,
    "total_week_wed" => $total_week_wed,
    "total_month_wed" => $total_month_wed,
    "total_wed" => $total_wed,
    "total_today_coh" => $total_today_coh,
    "total_week_coh" => $total_week_coh,
    "total_month_coh" => $total_month_coh,
    "total_coh" => $total_coh
]);

$con->close();
?>
