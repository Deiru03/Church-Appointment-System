<?php
include('extension/connect.php');
include('extension/check-login.php');
include('extension/function.php');
$userid = $_SESSION['userid'];
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $dateofdeath = mysqli_real_escape_string($con, $_POST['dateofdeath']);
    $sched = mysqli_real_escape_string($con, $_POST['sched']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);

    // SQL Insert Query for burial record
    $insertQuery = "INSERT INTO burial (date, dateofdeath, phone, address, fullname, uname, sched)
                    VALUES (NOW(), '$dateofdeath', '$phone', '$address', '$fullname', '$uname', '$sched')";

    if (mysqli_query($con, $insertQuery)) {
        $status = '<div class="alert alert-success">Burial record successfully added!</div>';
    } else {
        $status = '<div class="alert alert-danger">Error adding burial record: ' . mysqli_error($con) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burial Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Burial Application</h1>
        <?php if ($status) echo $status; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
            <div class="mb-3">
                <label for="dateofdeath" class="form-label">Date of Death</label>
                <input type="date" class="form-control" id="dateofdeath" name="dateofdeath" required>
            </div>
            <div class="mb-3">
                <label for="sched" class="form-label">Burial Schedule</label>
                <input type="datetime-local" class="form-control" id="sched" name="sched" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <input type="hidden" name="uname" value="<?php echo $_SESSION['username']; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
