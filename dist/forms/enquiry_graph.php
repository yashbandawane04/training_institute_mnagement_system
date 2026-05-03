<?php
require 'connection.php';

// Extract domain from email and count how many enquiries from each domain
$sql = "SELECT 
            SUBSTRING_INDEX(email, '@', -1) AS domain, 
            COUNT(*) AS count 
        FROM enquiry 
        WHERE email LIKE '%@%' 
        GROUP BY domain 
        ORDER BY count DESC";

$result = $conn->query($sql);

$domains = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $domains[] = $row['domain'];
    $counts[] = (int)$row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Enquiry Email Domain Distribution</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;     /* vertical center */
            justify-content: center; /* horizontal center */
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .chart-container {
            width: 700px;
            height: 450px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        canvas {
            max-width: 100%;
            max-height: 380px;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <h2>Enquiries by Email Domain</h2>
        <canvas id="enquiryDomainChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('enquiryDomainChart').getContext('2d');
        const enquiryDomainChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($domains) ?>,
                datasets: [{
                    label: 'Number of Enquiries',
                    data: <?= json_encode($counts) ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                animation: {
                    duration: 1000,
                    loop: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 16 }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
