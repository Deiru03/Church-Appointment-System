<?php
// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chruch-2";

$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Load wedding.json
$jsonFile = 'wedding.json'; // Path to your wedding.json file
if (!file_exists($jsonFile)) {
    die("Error: wedding.json file not found.");
}

// Decode the JSON data
$dataArray = json_decode(file_get_contents($jsonFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error decoding JSON: " . json_last_error_msg());
}

// Loop through each record and insert/update into the database
foreach ($dataArray as $data) {
    $log_id = $con->real_escape_string($data['log_id']);
    $groom = $data['groom'];
    $bride = $data['bride'];
    $marriage = $data['marriage'];

    $sql = "INSERT INTO wedding (
        log_id, groom_name, groom_age, groom_birthplace, groom_civil_status, groom_residence, groom_father, groom_mother,
        groom_baptism, groom_confirmation, groom_witnesses, bride_name, bride_age, bride_birthplace, bride_civil_status,
        bride_residence, bride_father, bride_mother, bride_baptism, bride_confirmation, bride_witnesses, marriage_sched,
        marriage_schedtime, marriage_phone, picture, proofpayment, statuspayment, bapstatus, uname, br, bc, wsphbb, wsphbg, date
    ) VALUES (
        '{$log_id}', '{$groom['name']}', '{$groom['age']}', '{$groom['birthplace']}', '{$groom['civil_status']}', '{$groom['residence']}',
        '{$groom['father']}', '{$groom['mother']}', '{$groom['baptism']}', '{$groom['confirmation']}', '{$groom['witnesses']}',
        '{$bride['name']}', '{$bride['age']}', '{$bride['birthplace']}', '{$bride['civil_status']}', '{$bride['residence']}',
        '{$bride['father']}', '{$bride['mother']}', '{$bride['baptism']}', '{$bride['confirmation']}', '{$bride['witnesses']}',
        '{$marriage['sched']}', '{$marriage['schedtime']}', '{$marriage['phone']}', '{$data['picture']}', '{$data['proofpayment']}',
        {$data['statuspayment']}, {$data['bapstatus']}, '{$data['uname']}', '{$data['br']}', '{$data['bc']}', '{$data['wsphbb']}',
        '{$data['wsphbg']}', '{$data['date']}'
    ) ON DUPLICATE KEY UPDATE
        groom_name = VALUES(groom_name),
        groom_age = VALUES(groom_age),
        groom_birthplace = VALUES(groom_birthplace),
        groom_civil_status = VALUES(groom_civil_status),
        groom_residence = VALUES(groom_residence),
        groom_father = VALUES(groom_father),
        groom_mother = VALUES(groom_mother),
        groom_baptism = VALUES(groom_baptism),
        groom_confirmation = VALUES(groom_confirmation),
        groom_witnesses = VALUES(groom_witnesses),
        bride_name = VALUES(bride_name),
        bride_age = VALUES(bride_age),
        bride_birthplace = VALUES(bride_birthplace),
        bride_civil_status = VALUES(bride_civil_status),
        bride_residence = VALUES(bride_residence),
        bride_father = VALUES(bride_father),
        bride_mother = VALUES(bride_mother),
        bride_baptism = VALUES(bride_baptism),
        bride_confirmation = VALUES(bride_confirmation),
        bride_witnesses = VALUES(bride_witnesses),
        marriage_sched = VALUES(marriage_sched),
        marriage_schedtime = VALUES(marriage_schedtime),
        marriage_phone = VALUES(marriage_phone),
        picture = VALUES(picture),
        proofpayment = VALUES(proofpayment),
        statuspayment = VALUES(statuspayment),
        bapstatus = VALUES(bapstatus),
        uname = VALUES(uname),
        br = VALUES(br),
        bc = VALUES(bc),
        wsphbb = VALUES(wsphbb),
        wsphbg = VALUES(wsphbg),
        date = VALUES(date)";

    if (!$con->query($sql)) {
        echo "Error inserting/updating log_id {$log_id}: " . $con->error . "<br>";
    }
}

echo "Data successfully uploaded to the database.";
$con->close();
?>
