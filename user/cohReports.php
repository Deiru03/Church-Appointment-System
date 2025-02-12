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

?>

<?php
// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chruch-2";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

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
            max-width: 800px auto;
            margin: 30px auto;
            margin-top: 100px;
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

<?php include('extension/topnav.php'); ?>

<div class="container-fluid" >
    <div class="row">
        <?php include('extension/sidenav.php'); ?>
        <!-- main content wrapper start-->

        <div class="content-wrapper" >
            <div class="page-title">
            <div class="card-header text-white">
                <h1 class="mb-0">Car or House Baptismal Reports</h1>
            </div>

            <p class="mb-3">This page displays a list of wedding reports that have been approved or declined.</p>
            
            <!-- Add a print button -->
            <div style="text-align: right; margin-bottom: 10px;" class="no-print">
                <button onclick="openPrintWindow()" class="btn btn-primary">Print Report</button>
            </div>

            <!-- Wrap the table in an element with an ID we can reference -->
            <div id="printableContent">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Report Type</th>
                                <th>May Ari</th>
                                <th>Date Application</th>
                                <th>Scheduled Date</th>
                                <th>Contact Number</th>
                                <th>Proof Payment</th>
                                <th>Baptism Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch records where bapstatus is 1 or 2
                            $query = mysqli_query($conn, "SELECT * FROM coh WHERE bapstatus IN ('1', '2')");
                            while ($report = mysqli_fetch_assoc($query)) {
                                echo '<tr>';
                                echo '<td>Car/House Report</td>';
                                echo '<td>' . htmlspecialchars($report['may_ari']) . '</td>';
                                echo '<td>' . date('M d, Y h:i A', strtotime($report['date'])) . '</td>';
                                echo '<td>' . date('M d, Y h:i A', strtotime($report['petsa_ng_pagbabasbas'])) . '</td>';
                                echo '<td>' . htmlspecialchars($report['contact_number_owner']) . '</td>';

                                // Show proof payment
                                if (!empty($report['picture'])) {
                                    echo '<td><img src="' . htmlspecialchars($report['proofpayment']) . '" alt="Picture" /></td>';
                                } else {
                                    echo '<td></td>';
                                }

                                // Map bapstatus to a badge label
                                if ($report['bapstatus'] == '1') {
                                    $statusLabel = '<label class="badge badge-success">APPROVED</label>';
                                } elseif ($report['bapstatus'] == '2') {
                                    $statusLabel = '<label class="badge badge-danger">DECLINED</label>';
                                } else {
                                    $statusLabel = '<label class="badge badge-secondary">UNKNOWN</label>';
                                }
                                echo '<td>' . $statusLabel . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?php
// Footer
?>
</body>

<!-- JavaScript function for printing -->
<script>
function openPrintWindow() {
    var printContents = document.getElementById('printableContent').innerHTML;
    var newWindow = window.open('', '', 'width=900,height=600');
    newWindow.document.write('<html><head><title>Car/House Reports</title>');
    // Include Bootstrap or other styling
    newWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
    // Optional table border styling
    newWindow.document.write('<style>table, th, td { border: 1px solid #000 !important; border-collapse: collapse; }</style>');
    newWindow.document.write('</head><body>');
    newWindow.document.write('<h1 style="text-align: center;">Car/House Baptismal History Reports</h1>');
    newWindow.document.write(printContents);
    newWindow.document.write('</body></html>');
    newWindow.document.close();
    newWindow.focus();
    newWindow.print();
    newWindow.close();
}
</script>