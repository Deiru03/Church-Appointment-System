<?php
header('Content-Type: application/json');

// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chruch-2";

$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($con->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $con->connect_error]));
}

// Read JSON data
$jsonFile = 'coh.json';
$dataArray = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
if (!$dataArray) {
    die(json_encode(["error" => "Invalid or empty JSON file."]));
}

// Loop through each record and insert/update into the database
foreach ($dataArray as $data) {
    $log_id = $con->real_escape_string($data['log_id']);
    $petsa_ng_pagbabasbas = $con->real_escape_string($data['petsa_ng_pagbabasbas']);
    $lugar = $con->real_escape_string($data['lugar']);
    $ipapabasbas = $con->real_escape_string($data['ipapabasbas']);
    $may_ari = $con->real_escape_string($data['may_ari']);
    $contact_number_owner = $con->real_escape_string($data['contact_number_owner']);
    $nagpalista = $con->real_escape_string($data['nagpalista']);
    $contact_number_registrant = $con->real_escape_string($data['contact_number_registrant']);
    $proofpayment = $con->real_escape_string($data['proofpayment']);
    $statuspayment = (int)$data['statuspayment'];
    $bapstatus = (int)$data['bapstatus'];
    $uname = $con->real_escape_string($data['uname']);
    $picture = $con->real_escape_string($data['picture']);
    $cob = $con->real_escape_string($data['cob']);
    $date = $con->real_escape_string($data['date']);

    $sql = "INSERT INTO coh (
        log_id, petsa_ng_pagbabasbas, lugar, ipapabasbas, may_ari, contact_number_owner,
        nagpalista, contact_number_registrant, proofpayment, statuspayment, bapstatus,
        uname, picture, cob, date
    ) VALUES (
        '$log_id', '$petsa_ng_pagbabasbas', '$lugar', '$ipapabasbas', '$may_ari', '$contact_number_owner',
        '$nagpalista', '$contact_number_registrant', '$proofpayment', $statuspayment, $bapstatus,
        '$uname', '$picture', '$cob', '$date'
    ) ON DUPLICATE KEY UPDATE
        petsa_ng_pagbabasbas = VALUES(petsa_ng_pagbabasbas),
        lugar = VALUES(lugar),
        ipapabasbas = VALUES(ipapabasbas),
        may_ari = VALUES(may_ari),
        contact_number_owner = VALUES(contact_number_owner),
        nagpalista = VALUES(nagpalista),
        contact_number_registrant = VALUES(contact_number_registrant),
        proofpayment = VALUES(proofpayment),
        statuspayment = VALUES(statuspayment),
        bapstatus = VALUES(bapstatus),
        uname = VALUES(uname),
        picture = VALUES(picture),
        cob = VALUES(cob),
        date = VALUES(date)";

    if (!$con->query($sql)) {
        echo json_encode(["error" => "Error inserting/updating log_id $log_id: " . $con->error]);
        exit;
    }
}

echo json_encode(["status" => "success", "message" => "Data successfully uploaded to the database."]);
$con->close();
?>
