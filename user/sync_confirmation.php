<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'chruch-2';

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Fetch JSON data from POST request
$jsonData = json_decode(file_get_contents("php://input"), true);

if ($jsonData) {
    // Fetch existing data from the database
    $existingData = [];
    $result = $conn->query("SELECT log_id FROM confirmation");
    while ($row = $result->fetch_assoc()) {
        $existingData[] = $row['log_id'];
    }

    $jsonLogIds = array_column($jsonData, 'log_id');
    $toInsert = [];
    $toUpdate = [];
    $toDelete = array_diff($existingData, $jsonLogIds);

    foreach ($jsonData as $entry) {
        if (!in_array($entry['log_id'], $existingData)) {
            // New record to insert
            $toInsert[] = $entry;
        } else {
            // Existing record to update
            $toUpdate[] = $entry;
        }
    }

    // Insert new records
    foreach ($toInsert as $entry) {
        $stmt = $conn->prepare("INSERT INTO confirmation (
            log_id, fullname, gender, dateofbirth, address, phone, fathersname, mothersname,
            parentresidence, raop, sched, dateofconfirmation, statuspayment, bapstatus,
            picture, cob, proofpayment, uname, date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssssssssiiisssss",
            $entry['log_id'], $entry['fullname'], $entry['gender'], $entry['dateofbirth'],
            $entry['address'], $entry['phone'], $entry['fathersname'], $entry['mothersname'],
            $entry['parentresidence'], $entry['raop'], $entry['sched'], $entry['dateofconfirmation'],
            $entry['statuspayment'], $entry['bapstatus'], $entry['picture'], $entry['cob'],
            $entry['proofpayment'], $entry['uname'], $entry['date']
        );
        $stmt->execute();
    }

    // Update existing records
    foreach ($toUpdate as $entry) {
        $stmt = $conn->prepare("UPDATE confirmation SET 
            fullname=?, gender=?, dateofbirth=?, address=?, phone=?, fathersname=?, mothersname=?, 
            parentresidence=?, raop=?, sched=?, dateofconfirmation=?, statuspayment=?, bapstatus=?, 
            picture=?, cob=?, proofpayment=?, uname=?, date=? 
            WHERE log_id=?");
        $stmt->bind_param(
            "ssssssssssiiisssssss",
            $entry['fullname'], $entry['gender'], $entry['dateofbirth'], $entry['address'],
            $entry['phone'], $entry['fathersname'], $entry['mothersname'], $entry['parentresidence'],
            $entry['raop'], $entry['sched'], $entry['dateofconfirmation'], $entry['statuspayment'],
            $entry['bapstatus'], $entry['picture'], $entry['cob'], $entry['proofpayment'],
            $entry['uname'], $entry['date'], $entry['log_id']
        );
        $stmt->execute();
    }

    // Delete records missing in JSON
    foreach ($toDelete as $log_id) {
        $stmt = $conn->prepare("DELETE FROM confirmation WHERE log_id=?");
        $stmt->bind_param("s", $log_id);
        $stmt->execute();
    }

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["error" => "Invalid JSON data"]);
}

$conn->close();
?>
