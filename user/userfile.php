<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$search = $userid;
$status = '';
$teacher_id = $_SESSION['userid'];

if(!isset($_POST['action_a'])){
    
}else{
    if($_POST['action_a'] == 'password'){
        $newpass = rand(0,9999999);
        $authvpn = md5($newpass);
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET user_pass = '$newpass', user_encryptedPass = '$authvpn' WHERE user_id='$u'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Password] Reset successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Password] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'block'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET is_freeze='1' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Block successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Reset failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'unblock'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET is_freeze='0' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [User] Unblock successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [User] Unblock failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'review'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        
        $query = mysqli_query($con,"UPDATE users SET student_type='pendingpre-school' WHERE user_id='".$u."'");
        if($query)
        {
            $status = '<div class="alert alert-success alert-dismissible" role="alert">
                            [Students] Review successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }else{
            $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                            [Students] Aprroved failure
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>';
        }
    }elseif($_POST['action_a'] == 'delete'){
    
        $u = mysqli_real_escape_string($con,$_POST['action_u']);
        $chk_user = mysqli_query($con,"select * from users where user_id='$u'");
        $chk = mysqli_fetch_array($chk_user);
        $del_userid = $chk['user_id'];
        $del_username = $chk['user_name'];
        $del_password = $chk['user_pass'];
        $del_rank = $chk['user_rank'];
        
        $query = mysqli_query($con,"insert into delete_users(`user_id`,`user_name`,`user_pass`,`user_rank`) values('$del_userid','$del_username','$del_password','$del_rank')");
        if($query)
            {
                $qq = mysqli_query($con,"DELETE FROM users WHERE user_id='".$u."'");
                    if($qq){
                        $status = '<div class="alert alert-success alert-dismissible" role="alert">
                                    [User] Delete successfully
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>';
                    }else{
                        $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                        [User] Delete failure
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>';
                    }
            }else{
                $status = '<div class="alert alert-danger alert-dismissible" role="alert">
                                Something went wrong
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
            }
    }else{
        
    }
}

?>

<?php
if (isset($_POST['upload'])) {
    
    // Check if a file was uploaded
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        // Define allowed file types
        $allowedExtensions = array('doc', 'docx');
        
        // Get the file extension of the uploaded file
        $fileExtension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
        
        // Check if the file extension is in the list of allowed extensions
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            // File type not allowed
            echo '<script>
                    alert("Only Word documents (doc/docx) are allowed.");
                    window.location.href = "userfile"; // Redirect back to the upload form
                  </script>';
            exit; // Stop execution
        }

        $uploadDir = 'uploads/'; // Specify the directory where you want to save attachments
        $uploadFile = $uploadDir . basename($_FILES['attachment']['name']);
        
        // Check if a file with the same name already exists in the "uploads" directory
        if (file_exists($uploadFile)) {
            // File with the same name already exists, handle accordingly
            echo '<script>
                    alert("A file with the same name already exists.");
                    window.location.href = "userfile"; // Redirect back to the upload form
                  </script>';
            exit; // Stop execution
        }
        
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadFile)) {
            // File upload successful
            
            // Retrieve the uploader's name from the form (sanitize input to prevent SQL injection)
            $uploaderName = isset($_POST['uploader_name']) ? mysqli_real_escape_string($con, $_POST['uploader_name']) : '';
            $uname = isset($_POST['uname']) ? mysqli_real_escape_string($con, $_POST['uname']) : '';


            // Retrieve the size and type of the uploaded file
            $fileSizeBytes = $_FILES['attachment']['size'];
            $fileSizeKB = round($fileSizeBytes / 1024, 2); // Convert to KB
            $fileSizeMB = round($fileSizeBytes / (1024 * 1024), 2); // Convert to MB

          
            // Insert log entry into the database
            $fileName = basename($_FILES['attachment']['name']);
            $insertLogQuery = "INSERT INTO file_upload_logs (date_uploaded, uploader_name, file_name, size, type_of_files , uname)
            VALUES (NOW(), '$uploaderName', '$fileName', $fileSizeKB, '$fileExtension' , '$uname')";
            mysqli_query($con, $insertLogQuery);

             

            // Display success message
            $query = mysqli_query($con, "UPDATE users SET user_status='submitted' WHERE user_id='$userid'");
            echo '<script>
                    alert("File has been Successfully Submitted.");
                    window.location.href = "userfile"; // Redirect back to the upload form
                  </script>';
            exit; // Stop execution
        } else {
            // File upload failed
            echo '<script>
                    alert("Error uploading the attachment.");
                    window.location.href = "userfile"; // Redirect back to the upload form
                  </script>';
            exit; // Stop execution
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
<meta name="description" content="" />
<meta name="author" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php include('extension/title.php'); ?> | View User Document</title>
    
<script src="/assets/js/jquery-3.3.1.min.js"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="/assets/images/favicon.ico" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="/church/assets/css/style.css" />

<link rel="stylesheet" type="text/css" href="/assets/alertifyjs/css/alertify.css">
</head>
<style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            width: 60%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        /* Close button styles */
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
 
<div class="container-fluid" style="background-color:skyblue;">
  <div class="row">
    <?php include('extension/sidenav.php'); ?>
<!-- main content wrapper start-->

    <div class="content-wrapper" style="background-color:skyblue;">
      <div class="page-title">
        <div class="row">
          <div class="col-sm-6" >
                <h4 class="mb-0"> View User Document</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="default-color"><button id="openModalBtn">UPLOAD PROJECT</button> </a></li>
               
            </ol>
          </div>
        </div>
      </div>
    
 
        
    <div class="row" >   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body" >
            <div class="table-responsive">
            <?php echo $status; ?>
           
            <table id="datatable" class="table table-striped table-bordered p-0">
    <thead>
        <tr>
            <th>icon</th>
            <th>Filename</th>
            <th>Date Upload</th>
            <th>Type of Files</th>
            <th>Size</th>
            <th>Owner</th>
        </tr>
    </thead>
    <tbody id="fileList">
        <!-- File information will be dynamically populated here -->
    </tbody>
</table>

        </div>
    </div>
</div>
</div>
</div>

<form method="post" id="action_form">
    <input type="hidden" id="action_a" name="action_a"/>
    <input type="hidden" id="action_u" name="action_u"/>
</form>
        
<script>
    function submitForm(action_id, user_id) {
      document.getElementById('action_a').value = action_id;
      document.getElementById('action_u').value = user_id;
      document.getElementById('action_form').submit();
    }
</script>

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

<script>
    var notificationElement = document.getElementById('notification');
    if (notificationElement.innerHTML !== '') {
        setTimeout(function() {
            notificationElement.innerHTML = '';
        }, 5000); // Clear notification after 5 seconds
    }
</script>
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

<script src="/assets/alertifyjs/alertify.js"></script>

<script>
  $(function () {
    $("#datatable").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
    });
  });

  

</script>




<script>
// Function to fetch file information from the server for a specific username or uname
function fetchFileInformation(uname) {
    fetch(`http://localhost/user/userapi.php?action=getFileInformation&uname=${uname}`)
        .then(response => response.json())
        .then(data => {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = ''; // Clear the previous content

            data.forEach(file => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><div class="file-icon"> <img src="/img/word.png" alt="" height="50px" width="50px"> </div></td>
                    <td>${file.file_name}</td>
                    <td>${file.date_uploaded}</td>
                    <td>${file.type_of_files}</td>  
                    <td>${file.size} kb</td> 
                    <td>${file.uploader_name}</td>
                `;
                fileList.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching file information:', error);
        });
}

// Call the fetchFileInformation function with a specific username or uname
const uname = '<?php echo $t['user_name']; ?>'; // Replace 'test' with the desired username or uname
fetchFileInformation(uname);

</script>





<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="closeModalBtn">&times;</span>

        
          <form method="POST" action="" class="ui grid form" enctype="multipart/form-data">
                        
                        <div class="row field">
                          <label class="twelve wide column" for="uploader_name">Your Name or Identifier:</label>
                                      <div class="twelve wide column">
                            <div class="ui input">
                               <textarea type="text" id="uploader_name" name="uploader_name" placeholder="uploader_name | Group" rows="1" required></textarea><br>
 </div>
                          </div>
                        </div>
                        
                        <input type="hidden" name="uname" id="uname" value="<?php echo $t['user_name']; ?>" >

                        <div class="row field">
                          <label class="twelve wide column" for="barangay_information">Select File to Upload:</label>
                          <div class="twelve wide column">
                            <div class="ui input">
                             <input type="file" name="attachment" id="attachment">
 
                            </div>
                          </div>
                        </div>


                        
    <!-- Size and Type fields (optional) -->
    <!-- <label for="size">Size:</label>
    <input type="text" name="size" id="size">

    <label for="type_of_files">Type of Files:</label>
    <input type="text" name="type_of_files" id="type_of_files"> -->


                        
                        
                        <div class="row">
                          <label class="twelve wide column"></label>
                          <div class="twelve wide column">
                            <button type="submit" name="upload" class="btn btn-primary ml-15">UPLOAD FILES</button>
                          </div>
                        </div>
                        
                    </form>


    </div>

</div>

<script>
    // Get the modal and buttons
    const modal = document.getElementById('myModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');

    // Function to open the modal
    function openModal() {
        modal.style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = 'none';
    }

    // Event listeners for the buttons
    openModalBtn.addEventListener('click', openModal);
    closeModalBtn.addEventListener('click', closeModal);

    // Close the modal if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            closeModal();
        }
    });
</script>


</body>
</html>
