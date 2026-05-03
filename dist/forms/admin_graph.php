<?php
require 'connection.php';

// Fetch count of admins grouped by role
$sql = "SELECT role, COUNT(*) as count FROM admins GROUP BY role";
$result = $conn->query($sql);

$roles = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $roles[] = $row['role'];
    $counts[] = (int)$row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admins Role Bar Graph</title>
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
        <h2>Admins Role Distribution</h2>
        <canvas id="adminRoleChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('adminRoleChart').getContext('2d');
        const adminRoleChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($roles) ?>,
                datasets: [{
                    label: 'Number of Admins',
                    data: <?= json_encode($counts) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
