<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/incex.css">
    <title>Church Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
 <style>
    .active-baptism-sched {
    background-color: #f1f1f1;
    border-radius: 10px;
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    position: relative;
}

.active-baptism-sched h4 {
    margin-bottom: 10px;
    color: #333;
    font-size: 1.8em;
    font-weight: bold;
}

.sched-info {
    font-size: 1.4em;
    color: #555;
}

.sched-info span {
    font-weight: bold;
    color: #2c3e50;
    margin-right: 10px;
}

.attention-message {
    font-size: 1.2em;
    color: red;
    margin-top: 15px;
    font-weight: bold;
    background-color: #ffe9e9;
    border-radius: 5px;
    padding: 10px;
    display: inline-block;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


.schedule-day {
    font-size: 1.5em; /* Font size for day heading */
    margin-top: 20px; /* Space above heading */
    color: #2c3e50; /* Dark blue color for heading */
}

.schedule-list {
    list-style-type: none; /* Remove default list styles */
    padding-left: 0; /* Remove left padding */
    margin: 0; /* Remove margin */
}

.schedule-item {
    background-color: #ecf0f1; /* Light grey background for items */
    border-radius: 5px; /* Rounded corners */
    padding: 10px; /* Padding inside items */
    margin: 5px 0; /* Space between items */
}

.no-schedule {
    color: #e74c3c; /* Red color for no schedule message */
    font-weight: bold; /* Bold for emphasis */
}



.modal {
  display: none; /* Hidden by default */
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
 align-items: center;
  margin: 10% auto;
  padding: 20px;
  width: 50%;
  max-height: 80%; /* Prevents overflowing content */
  overflow-y: auto;
 /* Enables scrolling for overflow */
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 10px;
}

.grid-item {
  text-align: center;
}

.grid-item img {
  width: 150px;
  height: 200px;
  object-fit: cover; /* Ensures consistent aspect ratio */
  border-radius: 5px; /* Optional rounded corners */
}

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
    <!-- Header Section -->
    <header>
        <nav class="navbar">
            <div class="logo-container">
                <img src="img/logo.png" alt="St. Joseph" class="logo-image">
                <h2 class="logo-text">ST. JOSEPH CATHEDRAL PARISH</h2>
            </div>
            <div class="nav-brand">The Roman Catholic Apostolic Vicariate of San Jose in Mindoro</div>
            <div class="mobile-menu-icon" onclick="toggleMenu()">&#9776;</div>
            <ul class="nav-links" id="navLinks">
                <li class="home"><a href="/">Home</a></li>
                <li class="nav-button login" class="services" id="openModalBtn"><a href="#">Services</a></li>
                <!-- <li class="about"><a href="#">About</a></li>  -->
                <li class="cont"><a href="#contact">Contact</a></li>
                <li class="nav-button login"><a href="user/login">Login</a></li>
                <li class="nav-button login"><a href="user/register">Register</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-image">
            <img src="img/hero.png" alt="Church Interior">
        </div>
    </section>

    <!-- Main Content Section -->
 <!-- Main Content Section -->
<main class="main-content">
    <div class="info-grid">
        <!-- Calendar Section -->
        <div class="calendar">

   
           </div>

        <!-- Map Section -->
        <!-- <div class="map">
        <?php
// Path to the JSON file
$jsonFile = 'user/confirmation.json';

// Check if the JSON file exists
if (file_exists($jsonFile)) {
    // Get the existing data from the file
    $jsonData = file_get_contents($jsonFile);
    $dataArray = json_decode($jsonData, true);

    // If the file is empty or can't be decoded, initialize an empty array
    if (!is_array($dataArray)) {
        $dataArray = [];
    }

    // Get the current date
    $currentDate = strtotime(date("Y-m-d"));

    // Filter records where bapstatus is 1 and dateofconfirmation is in the future
    $filteredData = array_filter($dataArray, function ($entry) use ($currentDate) {
        return isset($entry['bapstatus'], $entry['dateofconfirmation']) && 
               $entry['bapstatus'] == 1 && 
               strtotime($entry['dateofconfirmation']) >= $currentDate; // Show only future dates based on dateofconfirmation
    });

    // Check if there are any records with bapstatus = 1 and future dateofconfirmation
    if (count($filteredData) > 0) {
        // Display the title only once
        echo "<h4>Active Confirmation Schedule</h4>";
        
        // Open a container for all schedules
        echo "<div class='schedule-container'>";
        
        // Loop through the filtered data and display each schedule
        foreach ($filteredData as $row) {
            // Display each schedule in its own box
            echo "<div class='schedule-box'>";
            echo "<p class='sched-info'>";
            echo "<span>Date of Confirmation:</span> " . date("F j, Y", strtotime($row['dateofconfirmation'])) . " ";
            echo "<span>Time:</span> " . date("g:i A", strtotime($row['dateofconfirmation'])) . "";
            echo "</p>";
            echo "</div>";
        }
        
        // Display the attention message once after all schedules
        echo "<p class='attention-message'>This date is occupied and not available for other schedules.</p>";
        
        // Close the container div
        echo "</div>";
    } else {
        echo "<p>No active Confirmation schedules.</p>";
    }
} else {
    // If the JSON file is not found
    echo "<p>Confirmation data file not found.</p>";
}
?>

    </div> -->


    <div class="map">
            <h3>Map</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3878.226000624896!2d121.1037839153276!3d13.857579099644794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd7fa4056be69d%3A0x20fdd1a2498f95c7!2sSan%20Jose%20Cathedral%2C%20San%20Jose%2C%20Mindoro!5e0!3m2!1sen!2sph!4v1630836110000!5m2!1sen!2sph" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>



        <!-- Schedule Section -->
        <!-- <div class="office-hours">
            <div class="schedule-header">
                <img src="img/logo.png" alt="Schedule Icon" class="schedule-icon">
                <h3>Mass Schedule</h3>
            </div>
            <?php
include('user/extension/connect.php');

$query = "SELECT * FROM adminmass ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), TIME(hours)";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $currentDay = '';
    echo '<div class="schedule-container">'; // Using existing class
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['day'] != $currentDay) {
            if ($currentDay != '') echo '</ul>'; // Close previous list
            $currentDay = $row['day'];
            echo '<h4 class="schedule-day">' . htmlspecialchars($currentDay) . ':</h4><ul class="schedule-list">'; // Using existing class
        }
        $time = date('g:i A', strtotime($row['hours']));
        echo '<li class="schedule-item">' . htmlspecialchars($time) . '</li>'; 
           echo '<li class="schedule-item">' . htmlspecialchars($time) . '</li>'; // Using existing class
    }
    echo '</ul>'; // Close last list
    echo '</div>'; // Close container
} else {
    echo '<p class="no-schedule">No schedule available.</p>'; // Using existing class
}

mysqli_close($con);
?>

        </div>  -->

        <!-- Parish Office Hours Section -->
        <!-- <div class="office-hours">
            <div class="schedule-header">
                <img src="img/logo.png" alt="Office Icon" class="schedule-icon">
                <h3>Confirmation Schedule</h3>
            </div>
            <div class="office-hours-content">
            <?php
// Path to JSON file
$jsonFile = 'user/confirmschedmanage.json';

// Load JSON data from file
$jsonData = file_get_contents($jsonFile);

// Parse JSON data as PHP array
$schedules = json_decode($jsonData, true);

// Check if data is available
if (!empty($schedules)) {
    $currentDay = ''; // Variable for the current day
    
    // Sort schedules by day of the week and time
    usort($schedules, function($a, $b) {
        // Days of the week for comparison
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $dayComparison = array_search($a['day'], $daysOfWeek) - array_search($b['day'], $daysOfWeek);
        
        if ($dayComparison === 0) {
            // If the same day, sort by time
            return strtotime($a['datetime']) - strtotime($b['datetime']);
        }
        
        return $dayComparison;
    });

    // Open a container for all schedules
    echo '<div class="schedule-container">'; // Using existing class
    
    // Loop through schedules
    foreach ($schedules as $row) {
        // If a new day, print heading and list
        if ($row['day'] != $currentDay) {
            if ($currentDay != '') echo '</ul>'; // Close previous list
            $currentDay = $row['day'];
            echo '<h4 class="schedule-day">' . htmlspecialchars($currentDay) . ':</h4><ul class="schedule-list">'; // Using existing class
        }

        // Format time from datetime
        $time = date('g:i A', strtotime($row['datetime']));
        echo '<li class="schedule-item">' . htmlspecialchars($time) . '</li>'; // Using existing class
    }
    
    echo '</ul>'; // Close last list
    echo '</div>'; // Close container
} else {
    echo '<p class="no-schedule">No schedule available.</p>'; // Using existing class
}
?>


 



            </div>
        </div> -->
    </div>

    <div class="info-grid" id="contact">
    <div>
    <img src="https://img.sikatpinoy.net/images/2025/01/02/image-removebg-preview-15.png" alt="Image Preview" style="max-width: 100%; height: auto;">
</div>
<div style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h3>CONTACT US</h3>
    <p><i class="fas fa-mobile-alt"></i> <strong>Mobile:</strong> 0920 985 0076</p>
    <p><i class="fas fa-envelope"></i> <strong>Email:</strong> Vkatedralsjom@gmail.com</p>
    <p><i class="fas fa-user-check"></i> <strong>Status:</strong> Active Now</p>
    <p><i class="fas fa-facebook"></i> <strong>Facebook:</strong> St. Joseph Cathedral Parish</p>
</div>
</div>


</main>


    <!-- Footer Section -->
   

    <script src="js/script.js"></script>
    <script>
        function toggleMenu() {
            var nav = document.getElementById('navLinks');
            if (nav.style.display === 'flex') {
                nav.style.display = 'none';
            } else {
                nav.style.display = 'flex';
            }
        }
    </script>

<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeModalBtn"></span>
    <div class="grid-container">
      <div class="grid-item">
        <a href="user/baptismal" target="_blank">
          <img 
            src="https://img.sikatpinoy.net/images/2024/12/12/baptismal.png" 
            alt="Image 1" 
            width="150" 
            height="150">
        </a>
      </div>
      <div class="grid-item">
        <a href="user/Confirmation" target="_blank">
          <img 
            src="https://img.sikatpinoy.net/images/2024/12/12/image-removebg-preview-14.png" 
            alt="Image 2" 
            width="150" 
            height="150">
        </a>
      </div>
      <div class="grid-item">
        <a href="user/wedding1" target="_blank">
          <img 
            src="https://img.sikatpinoy.net/images/2024/12/12/image-removebg-preview-8.png" 
            alt="Image 3" 
            width="150" 
            height="150">
        </a>
      </div>
      <div class="grid-item">
        <a href="user/coh" target="_blank">
          <img 
            src="https://img.sikatpinoy.net/images/2024/12/12/image-removebg-preview-9.png" 
            alt="Image 4" 
            width="150" 
            height="150">
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  // Modal functionality
  var modal = document.getElementById("myModal");
  var btn = document.getElementById("openModalBtn");
  var span = document.getElementById("closeModalBtn");

  btn.onclick = function () {
    modal.style.display = "block";
  };

  span.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
</script>
<script>
        // Fetch and display the JSON schedule
        fetch('user/sched.json') // Path to your JSON file
            .then(response => response.json()) // Parse JSON response
            .then(data => {
                const calendarDiv = document.querySelector('.calendar'); // Select the calendar div

                // Loop through the data and display it
                for (const [category, timings] of Object.entries(data)) {
                    // Create a heading for each category (e.g., Baptism, Wedding)
                    const categoryHeading = document.createElement('h3');
                    categoryHeading.textContent = category;
                    calendarDiv.appendChild(categoryHeading);

                    // Create a list for timings
                    const timingsList = document.createElement('ul');
                    for (const [day, time] of Object.entries(timings)) {
                        const listItem = document.createElement('li');
                        listItem.textContent = Array.isArray(time)
                            ? `${day}: ${time.join(', ')}` // For arrays (e.g., Wedding times)
                            : time !== null
                            ? `${day}: ${time}` // For single time (e.g., 9:30 am)
                            : day; // For entries without time (e.g., "First Communion")
                        timingsList.appendChild(listItem);
                    }
                    calendarDiv.appendChild(timingsList);
                }
            })
            .catch(error => console.error('Error fetching schedule:', error));
    </script>
</body>
</html>



 