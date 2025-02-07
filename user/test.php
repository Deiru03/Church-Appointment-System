<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .grid-item {
        background: #e0f7fa;
        border-radius: 10px;
        color: #000;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: row;
        align-items: center;
        position: relative;
    }

    .user-picture {
        width: 150px;
        height: 150px;
        border-radius: 10%;
        margin-right: 20px;
    }

    .user-info {
        flex-grow: 1;
        text-align: left;
    }

    .user-info h1 {
        font-size: 1.25rem;
        margin-bottom: 5px;
    }

    .user-info p {
        font-size: 0.875rem;
        margin: 2px 0;
    }

    .chart-container {
        width: 150px;
        height: 150px;
        position: relative;
    }
    </style>
</head>

<body>
    <div class="grid-container">
        <?php
        // Sample patient data
        $patient_data = [
            'picture' => 'path/to/picture.jpg',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'lastvisit' => '2023-07-31',
            'dateofbirth' => '1990-01-01',
            'diagnosis' => 'Hypertension',
            'address' => '123 Main St',
            'contact' => '123-456-7890',
            'email' => 'john.doe@example.com',
            'uname' => 'johndoe',
            'progress' => 75 // Example progress value
        ];

        // Check user rank
        $user_rank = 'superadmin'; // Example user rank
        ?>
        <div class="grid-item">
            <img src="<?php echo htmlspecialchars($patient_data['picture']); ?>" alt="User Picture"
                class="user-picture">
            <div class="user-info">
                <h1>
                    <?php echo strtoupper(htmlspecialchars($patient_data['firstname'])); ?>
                    <?php echo strtoupper(htmlspecialchars($patient_data['lastname'])); ?>
                </h1>
                <p>
                    <?php echo 'Last Visit: ' . date('F j, Y', strtotime($patient_data['lastvisit'])); ?>
                </p>
                <p>
                    <?php echo 'Date of Birth: ' . date('F j, Y', strtotime($patient_data['dateofbirth'])); ?>
                </p>
                <p>
                    <?php echo 'Diagnosis: ' . htmlspecialchars($patient_data['diagnosis']); ?>
                </p>
                <p>
                    <?php echo 'Address: ' . htmlspecialchars($patient_data['address']); ?>
                </p>
                <p>
                    <?php echo 'Contact: ' . htmlspecialchars($patient_data['contact']); ?>
                </p>
                <p>
                    <?php echo 'Email: ' . htmlspecialchars($patient_data['email']); ?>
                </p>
                <?php if ($user_rank == 'superadmin') { ?>
                <p style="color:red"><b>BHW: <?php echo htmlspecialchars($patient_data['uname']); ?></b></p>
                <?php } ?>
            </div>
            <div class="chart-container">
                <canvas id="progressChart-<?php echo $patient_data['uname']; ?>"></canvas>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('progressChart-<?php echo $patient_data['uname']; ?>').getContext(
            '2d');
        var progress = <?php echo $patient_data['progress']; ?>;
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Progress', 'Remaining'],
                datasets: [{
                    data: [progress, 100 - progress],
                    backgroundColor: ['#4caf50', '#e0e0e0']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 70,
                plugins: {
                    datalabels: {
                        formatter: (value, context) => {
                            // Show percentage only for the 'Progress' slice
                            if (context.dataIndex === 0) {
                                return value + '%';
                            } else {
                                return '';
                            }
                        },
                        color: '#000',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        anchor: 'center',
                        align: 'center'
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var currentValue = dataset.data[tooltipItem.index];
                            return currentValue + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
    </script>
</body>

</html>
