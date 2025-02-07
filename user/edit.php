<?php
// Define the path to the JSON file
$jsonFilePath = '/sched.json';

// Handle form submission to update JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedJson = $_POST['jsonData'];
    // Save the updated JSON to the file
    file_put_contents($jsonFilePath, $updatedJson);
    echo "<p style='color: green;'>Schedule updated successfully!</p>";
}

// Read the current JSON data
$jsonData = file_get_contents($jsonFilePath);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        textarea {
            width: 100%;
            height: 400px;
            font-family: monospace;
            font-size: 14px;
            padding: 10px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Schedule</h1>
    <form method="post">
        <textarea name="jsonData"><?php echo htmlspecialchars($jsonData); ?></textarea>
        <br>
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
