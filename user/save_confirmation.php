<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chruch-2";

// Establish database conection
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check conection
if ($con->connect_error) {
    die("conection failed: " . $con->connect_error);
}

// Get JSON data from POST request
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    foreach ($data as $entry) {
        $log_id = $con->real_escape_string($entry['log_id']);
        $fullname = $con->real_escape_string($entry['fullname']);
        $gender = $con->real_escape_string($entry['gender']);
        $dateofbirth = $entry['dateofbirth'];
        $address = $con->real_escape_string($entry['address']);
        $phone = $con->real_escape_string($entry['phone']);
        $fathersname = $con->real_escape_string($entry['fathersname']);
        $mothersname = $con->real_escape_string($entry['mothersname']);
        $parentresidence = $con->real_escape_string($entry['parentresidence']);
        $raop = $con->real_escape_string($entry['raop']);
        $sched = $entry['sched'];
        $dateofconfirmation = $entry['dateofconfirmation'];
        $statuspayment = (int)$entry['statuspayment'];
        $bapstatus = (int)$entry['bapstatus'];
        $picture = $con->real_escape_string($entry['picture']);
        $cob = $con->real_escape_string($entry['cob']);
        $proofpayment = $con->real_escape_string($entry['proofpayment']);
        $uname = $con->real_escape_string($entry['uname']);
        $date = $entry['date'];

        // Insert or update data
        $sql = "INSERT INTO confirmation (
            log_id, fullname, gender, dateofbirth, address, phone, fathersname, 
            mothersname, parentresidence, raop, sched, dateofconfirmation, 
            statuspayment, bapstatus, picture, cob, proofpayment, uname, date
        ) VALUES (
            '$log_id', '$fullname', '$gender', '$dateofbirth', '$address', '$phone', 
            '$fathersname', '$mothersname', '$parentresidence', '$raop', '$sched', 
            '$dateofconfirmation', $statuspayment, $bapstatus, '$picture', '$cob', 
            '$proofpayment', '$uname', '$date'
        ) ON DUPLICATE KEY UPDATE 
            fullname='$fullname', gender='$gender', dateofbirth='$dateofbirth', 
            address='$address', phone='$phone', fathersname='$fathersname', 
            mothersname='$mothersname', parentresidence='$parentresidence', 
            raop='$raop', sched='$sched', dateofconfirmation='$dateofconfirmation', 
            statuspayment=$statuspayment, bapstatus=$bapstatus, picture='$picture', 
            cob='$cob', proofpayment='$proofpayment', uname='$uname', date='$date'";

        $con->query($sql);
    }
}

$con->close();
echo json_encode(["status" => "success"]);
?>
