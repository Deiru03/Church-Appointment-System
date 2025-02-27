<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$status = '';
$status1 = '';
$teacher_id = $_SESSION['userid'];

ob_start(); // Start output buffering
include('extension/title.php'); // Include the title file
$title = ob_get_clean(); // Store the included content and clear the buffer

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action_a'] == 'approved') {
        $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

        // Prepare the statement
        $stmt = mysqli_prepare($con, "UPDATE burial SET status='1' WHERE id = ?");

        if ($stmt) {
            // Bind the log_id parameter to the statement
            mysqli_stmt_bind_param($stmt, 'i', $log_id);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $status = '<div class="alert alert-success alert-dismissible" role="alert">Approval successful!</div>';
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">Approval failure.</div>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">Statement preparation failed: ' . mysqli_error($con) . '</div>';
        }
    } elseif ($_POST['action_a'] == 'declined') {
        $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

        // Prepare the statement
        $stmt = mysqli_prepare($con, "UPDATE burial SET status='2' WHERE id = ?");

        if ($stmt) {
            // Bind the log_id parameter to the statement
            mysqli_stmt_bind_param($stmt, 'i', $log_id);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $status = '<div class="alert alert-success alert-dismissible" role="alert">Decline successful!</div>';
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">Decline failure.</div>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">Statement preparation failed: ' . mysqli_error($con) . '</div>';
        }
    } elseif ($_POST['action_a'] == 'cancel') {
        $log_id = mysqli_real_escape_string($con, $_POST['action_u']);  // Assuming action_u contains the log_id

        // Prepare the statement
        $stmt = mysqli_prepare($con, "UPDATE burial SET status='3' WHERE id = ?");

        if ($stmt) {
            // Bind the log_id parameter to the statement
            mysqli_stmt_bind_param($stmt, 'i', $log_id);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $status = '<div class="alert alert-success alert-dismissible" role="alert">Cancel successful!</div>';
            } else {
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">Cancel failure.</div>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">Statement preparation failed: ' . mysqli_error($con) . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
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

        <?php include('extension/topnav.php'); ?>

        <div class="container-fluid">
            <div class="row">
            <?php include('extension/sidenav.php'); ?>
            <!-- main content wrapper start-->

            <div class="content-wrapper">
                <div class="page-title">
                <h1>Approved Burial Management</h1>
                <?php if(!empty($status)) echo $status; ?>
                </div>

                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Approved Burial Records</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>Full Name</th>
                                <th>Request Date</th>
                                <th>Scheduled Date</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Presiding Priest</th>
                                <th>Status</th>
                                <th>Date of Approved</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php
                        $rank_check = mysqli_query($con, "select user_rank from users where user_id='$userid'");
                        $myrank = mysqli_fetch_array($rank_check);
                        $user_rank = $myrank['user_rank'];

                        if ($user_rank == 'normal') {
                            $uname = $t['user_name']; // Initialize $uname with the logged-in user's name
                            $query = mysqli_query($con, "SELECT * FROM burial WHERE uname = '$uname' AND status='3'");
                        } elseif ($user_rank == 'superadmin') {
                            // Check if the status column exists
                            $check_column = mysqli_query($con, "SHOW COLUMNS FROM burial LIKE 'status'");
                            if(mysqli_num_rows($check_column) > 0) {
                            $query = mysqli_query($con, "SELECT * FROM burial WHERE status='3'");
                            } else {
                            $query = mysqli_query($con, "SELECT * FROM burial");
                            }
                        } else {
                            // Handle other ranks or an unknown rank if necessary
                            echo "<tr><td colspan='6' class='text-center'>Unknown user rank.</td></tr>";
                            exit;
                        }

                        if (!$query) {
                            echo "<tr><td colspan='6' class='text-center text-danger'>Query error: " . mysqli_error($con) . "</td></tr>";
                        } elseif (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_array($query)) {
                            $id = $row['id'];
                            $date = $row['date']; // Ensure this column exists and is used correctly
                            $formattedDate = date('M d, Y', strtotime($date));
                            $sched = $row['sched']; // Ensure this column exists and is used correctly
                            $formattedDatesched = date('M d, Y', strtotime($sched));
                            $address = $row['address'];
                            $fullname = $row['fullname'];
                            $phone = $row['phone'];
                            $status = $row['status'];
                            $uname = $row['uname'];

                            $statusText = '';
                            if ($status == 0) {
                                $statusText = '<span class="badge bg-warning text-dark">PENDING</span>';
                            } elseif ($status == 1) {
                                $statusText = '<span class="badge bg-success">APPROVED</span>';
                            } elseif ($status == 2) {
                                $statusText = '<span class="badge bg-danger">DECLINED</span>';
                            } elseif ($status == 3) {
                                $statusText = '<span class="badge bg-danger">CANCELLED</span>';
                            }

                            $statusButton = '';
                            if ($status == 0) {
                                $statusButton = 'APPROVED';
                            } elseif ($status == 1) {
                                $statusButton = '';
                            } elseif ($status == 2) {
                                $statusButton = '';
                            }
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fullname); ?></td>
                                <td><?php echo $formattedDate; ?></td>
                                <td><?php echo $formattedDatesched; ?></td>
                                <td><?php echo htmlspecialchars($address); ?></td>
                                <td><?php echo $phone; ?></td>
                                <td>To be added</td>
                                <td width="5%"><?php echo $statusText; ?></td>
                                <td>upcoming function</td>
                                <td width="7%">
                                    <div class="custom-dropdown">
                                            <button onclick="toggleDropdown(this)" class="dropbtn">Action</button>
                                            <?php if ($user_rank == 'superadmin' && $status == 3): ?>
                                            <div class="dropdown-content">
                                                <a href="#" onclick="openapproved('<?php echo $id; ?>')">Approve</a>
                                                <a href="#" onclick="opendeclined('<?php echo $id; ?>')">Decline</a>
                                                <!-- <a href="#" onclick="opencancel('<?php echo $id; ?>')">Cancel</a> -->
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <style>
                                        .custom-dropdown {
                                            position: relative;
                                            display: inline-block;
                                            color: #090909
                                        }
                                        .dropbtn {
                                            background-color: #28a745;
                                            color: white;
                                            padding: 6px 12px;
                                            border: none;
                                            border-radius: 4px;
                                            cursor: pointer;
                                        }
                                        .dropdown-content {
                                            display: none;
                                            position: absolute;
                                            background-color: #f9f9f9;
                                            min-width: 80px;
                                            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                                            z-index: 1;
                                        }
                                        .dropdown-content a {
                                            color: black;
                                            padding: 8px 12px;
                                            text-decoration: none;
                                            display: block;
                                        }
                                        .dropdown-content a:hover {
                                            background-color:rgb(213, 255, 207);
                                        }
                                        .show {
                                            display: block;
                                        }
                                        </style>
                                        <script>
                                        function toggleDropdown(btn) {
                                            btn.nextElementSibling.classList.toggle("show");
                                        }
                                        window.onclick = function(event) {
                                            if (!event.target.matches('.dropbtn')) {
                                                var dropdowns = document.getElementsByClassName("dropdown-content");
                                                for (var i = 0; i < dropdowns.length; i++) {
                                                    var openDropdown = dropdowns[i];
                                                    if (openDropdown.classList.contains('show')) {
                                                        openDropdown.classList.remove('show');
                                                    }
                                                }
                                            }
                                        }
                                        </script>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="9">No records found.</td></tr>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approved Modal -->
    <div class="modal fade" id="confirmModalapproved" tabindex="-1" role="dialog" aria-labelledby="confirmModalApprovedLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalApprovedLabel">Confirm Approval</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to approve this record? Type 'approved' to confirm.</p>
                    <input type="text" id="confirmationInputApproved" placeholder="Type 'approved'" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmButtonApproved" class="btn btn-danger">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Declined Modal -->
    <div class="modal fade" id="confirmModaldeclined" tabindex="-1" role="dialog" aria-labelledby="confirmModalDeclinedLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalDeclinedLabel">Confirm Decline</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to decline this record? Type 'declined' to confirm.</p>
                    <input type="text" id="confirmationInputDeclined" placeholder="Type 'declined'" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmButtonDeclined" class="btn btn-danger">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="confirmModalcancel" tabindex="-1" role="dialog" aria-labelledby="confirmModalCancelLabel" aria-hidden="true">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setupModal('approved', 'approved', 'confirmModalapproved', 'confirmButtonApproved', 'confirmationInputApproved');
            setupModal('declined', 'declined', 'confirmModaldeclined', 'confirmButtonDeclined', 'confirmationInputDeclined');
            setupModal('cancel', 'cancel', 'confirmModalcancel', 'confirmButtoncancel', 'confirmationInputcancel');
        });

        function setupModal(actionName, confirmationText, modalId, buttonId, inputId) {
            var confirmModal = $('#' + modalId);
            var confirmButton = document.getElementById(buttonId);
            var confirmationInput = document.getElementById(inputId);
            var idToAction = '';

            window['open' + actionName] = function(id) {
                idToAction = id;
                $(confirmModal).modal('show'); // Show the modal using jQuery
            }

            confirmButton.addEventListener('click', function() {
                if (confirmationInput.value === confirmationText) {
                    submitForm(actionName, idToAction);
                    $(confirmModal).modal('hide'); // Hide the modal using jQuery
                } else {
                    alert("Type '" + confirmationText + "' to confirm.");
                }
            });
        }

        function submitForm(action, id) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = ''; // The current page or URL handling the action

            var inputAction = document.createElement('input');
            inputAction.type = 'hidden';
            inputAction.name = 'action_a';
            inputAction.value = action;
            form.appendChild(inputAction);

            var inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'action_u';
            inputId.value = id;
            form.appendChild(inputId);

            document.body.appendChild(form);
            form.submit();
        }
    </script>

<!-- Bootstrap ESSENTIAL FOR SIDENAV -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap JS -->
</body>

</html>
