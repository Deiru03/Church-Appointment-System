<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php'); 

$userid = $_SESSION['userid'];
$status = '';

// Check if the log_id is provided via GET or POST
if(isset($_GET['log_id'])) {
    $log_id = $_GET['log_id'];
} elseif (isset($_POST['log_id'])) {
    $log_id = $_POST['log_id'];
} else {
    // Handle case where log ID is not provided
    echo 'Patient ID not provided.';
    exit; // Terminate script execution
}

// Read the JSON file
$jsonData = file_get_contents('confirmation.json');

// Decode JSON data into an array
$patients = json_decode($jsonData, true);

// Find the patient by log_id
$client_data = null;
foreach ($patients as $patient) {
    if ($patient['log_id'] === $log_id) {
        $client_data = $patient;
        break;
    }
}

// Check if patient was found
if ($client_data) {
    // Patient data found, proceed to display
} else {
    // Handle case where patient is not found
    echo 'Client not found.';
    exit; // Terminate script execution
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
    <title><?php include('extension/title.php'); ?> | Create Reseller</title>

    <script src="/assets/js/jquery-3.3.1.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/church/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/davidstyles.css" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

</head>

<style>
.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 20px;
    padding: 20px;
}

.grid-item {
    background: linear-gradient(135deg, #e1f1fc, #f9f9f9); /* Soft gradient for a serene look */
    border-radius: 15px;
    color: #333;
    padding: 30px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    flex-direction: row;
    align-items: center;
    position: relative;
    transition: transform 0.3s ease-in-out; /* Animation for hover effect */
}

.grid-item:hover {
    transform: scale(1.05); /* Gentle zoom effect on hover */
}

.user-picture {
    width: 200px;
    height: 200px;
    border-radius: 30%;
    margin-right: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.user-info {
    flex-grow: 1;
    text-align: left;
    font-family: 'Poppins', sans-serif;
}

.user-info h1 {
    font-size: 2rem;
    margin-bottom: 15px;
    color: #0066cc; /* A calm and spiritual blue */
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.user-info p {
    font-size: 1.1rem;
    line-height: 1.5;
    margin: 5px 0;
    color: #555;
}

.user-info span {
    font-weight: bold;
    color: #333;
}

.chart-container {
    width: 250px;
    height: 250px;
}

@media (max-width: 768px) {
    .grid-item {
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .user-picture {
        width: 120px;
        height: 120px;
        margin-bottom: 15px;
    }

    .user-info {
        text-align: center;
    }
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


                        </div>
                    </div>




                    <div class="container">
    <div class="content ">
        <?php echo $status; ?>

        <div class="grid-item">
            <img src="<?php echo htmlspecialchars($client_data['picture']); ?>" alt="User Picture" class="user-picture">
            
            <div class="user-info">
                <h1><?php echo htmlspecialchars($client_data['fullname']); ?></h1>
                <p><span>Address:</span> <?php echo htmlspecialchars($client_data['address']); ?></p>
                <p><span>Sex:</span> <?php echo htmlspecialchars($client_data['gender']); ?></p>
                <p><span>Birthday:</span> <?php echo date('F j, Y', strtotime($client_data['dateofbirth'])); ?></p>
                <p><span>Date Apply:</span> <?php echo date('F j, Y', strtotime($client_data['date'])); ?></p>
                
                <p><span>Contact:</span> <?php echo htmlspecialchars($client_data['phone']); ?></p>
                <p><span>Father's Name:</span> <?php echo htmlspecialchars($client_data['fathersname']); ?></p>
                <p><span>Mother's Name:</span> <?php echo htmlspecialchars($client_data['mothersname']); ?></p>
                <p><span>Parent Residence:</span> <?php echo htmlspecialchars($client_data['parentresidence']); ?></p>
                <p><span>Baptism:</span> <?php echo date('F j, Y g:i A', strtotime($client_data['sched'])); ?></p>
                <!-- <p><span>Place of Baptism:</span> <?php echo htmlspecialchars($client_data['placeofbaptism']); ?></p>
                <p><span>Name of Church:</span> <?php echo htmlspecialchars($client_data['nameofchurch']); ?></p> -->
                </div>

            <div class="user-info">

            <p><span>Requirments:</span> 

            <a href="javascript:void(0);" onclick="showFullImage('<?php echo htmlspecialchars($client_data['cob']); ?>')">
           CERTIFICATE OF BAPTISM
        </a><br>
            <!-- <p><span>Denomination:</span> <?php echo htmlspecialchars($client_data['iwd']); ?></p> -->
            <!-- <p><span>Date of Confirmation:</span> <?php echo date('F j, Y g:i A', strtotime($client_data['dateofconfirmation'])); ?></p>
                <p><span>Presented By:</span> <?php echo htmlspecialchars($client_data['presentedby']); ?></p>
                <p><span>Bishop Confirming:</span> <?php echo htmlspecialchars($client_data['bishopconfirming']); ?></p>
                <p><span>Remarks:</span> <?php echo htmlspecialchars($client_data['remarks']); ?></p> -->


             






                <!-- <p><span>Payment Proof:</span> <a href="<?php echo htmlspecialchars($client_data['proofpayment']); ?>" target="_blank">View Proof</a></p>
            


                  <p><span>Confirmation Status:</span> 
                <h2>Status</h2>
                <p><span>Payment Status:</span> 
                    <?php 
                        if ($client_data['statuspayment'] == 0) {
                            echo '<label class="badge badge-warning">PENDING</label>';
                        } elseif ($client_data['statuspayment'] == 1) {
                            echo '<label class="badge badge-success">DONE</label>';
                        } elseif ($client_data['statuspayment'] == 2) {
                            echo '<label class="badge badge-danger">DECLINED</label>';
                        }
                    ?>
                </p>
 
                <p><span>Confirmation Status:</span> 
                    <?php 
                        if ($client_data['bapstatus'] == 0) {
                            echo '<label class="badge badge-warning">PENDING</label>';
                        } elseif ($client_data['bapstatus'] == 1) {
                            echo '<label class="badge badge-success">APPROVED</label>';
                        } elseif ($client_data['bapstatus'] == 2) {
                            echo '<label class="badge badge-danger">DECLINED</label>';
                        } elseif ($client_data['bapstatus'] == 3) {
                            echo '<label class="badge badge-dark">CANCELLED</label>';
                        }
                    ?>
                </p> -->
            </div>
        </div>
    </div>
</div>
                        </div>


<br>

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
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('progressChart-<?php echo $patient_data['uname']; ?>').getContext(
                '2d');
            var med = <?php echo $patient_data['med']; ?>; // Total days (reference for 100%)
            var med1 = <?php echo $patient_data['med1']; ?>; // Remaining days

            // Calculate the progress percentage
            var progressPercentage = ((med - med1) / med) * 100;
            var remainingPercentage = 100 - progressPercentage;

            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Progress', 'Remaining'],
                    datasets: [{
                        data: [progressPercentage, remainingPercentage],
                        backgroundColor: ['#4caf50', '#e0e0e0']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var dataset = tooltipItem.dataset;
                                    var currentValue = dataset.data[tooltipItem.dataIndex];
                                    return currentValue.toFixed(2) + '%';
                                }
                            }
                        },
                        legend: {
                            display: false // Hide legend if you prefer
                        },
                        datalabels: {
                            formatter: (value, context) => {
                                let percent = Math.round(value);
                                return `${percent}%`;
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 16
                            }
                        }
                    }
                }
            });
        });
        </script>




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
        <!--=================================
 jquery -->

        <!-- Bootstrap and jQuery libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- jquery -->
        <script src="/assets/js/jquery-3.3.1.min.js"></script>

        <!-- plugins-jquery -->
        <script src="/assets/js/plugins-jquery.js"></script>

        <!-- plugin_path -->
        <script>
        var plugin_path = 'js/';
        </script>

        <!-- chart -->
        <script src="/assets/js/chart-init.js"></script>

        <!-- calendar -->
        <script src="/assets/js/calendar.init.js"></script>

        <!-- charts sparkline -->
        <script src="/assets/js/sparkline.init.js"></script>

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

        <script>
        function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            //alert("Copied the text: " + copyText.value);
        }
        </script>
        <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('picturePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
        </script>



</body>

</html>
