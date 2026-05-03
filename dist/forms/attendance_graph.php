<?php
require 'connection.php';

// Get counts of Present and Absent from status
$sqlStatus = "SELECT status, COUNT(*) as count FROM attendance GROUP BY status";
$resultStatus = $conn->query($sqlStatus);

$statusLabels = [];
$statusCounts = [];

while ($row = $resultStatus->fetch_assoc()) {
    $statusLabels[] = $row['status'];
    $statusCounts[] = (int)$row['count'];
}

// Get counts for remarks (A+, B+, C, D etc)
$sqlRemarks = "SELECT remarks, COUNT(*) as count FROM attendance GROUP BY remarks";
$resultRemarks = $conn->query($sqlRemarks);

$remarksLabels = [];
$remarksCounts = [];

while ($row = $resultRemarks->fetch_assoc()) {
    $remarksLabels[] = $row['remarks'];
    $remarksCounts[] = (int)$row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Attendance Status and Remarks Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 5px;
            margin-top: 40px;
        }
        .chart-container {
            width: 700px;
            max-width: 90vw;
            height: 400px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

    <h2>Attendance Status (Present vs Absent)</h2>
    <div class="chart-container">
        <canvas id="statusChart"></canvas>
    </div>

    <h2>Remarks Distribution (A+, B+, C, D etc.)</h2>
    <div class="chart-container">
        <canvas id="remarksChart"></canvas>
    </div>

    <script>
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const remarksCtx = document.getElementById('remarksChart').getContext('2d');

        const statusChart = new Chart(statusCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($statusLabels) ?>,
                datasets: [{
                    label: 'Number of Students',
                    data: <?= json_encode($statusCounts) ?>,
                    backgroundColor: ['#4caf50', '#f44336'], // green for present, red for absent (adjust as needed)
                    borderColor: ['#388e3c', '#d32f2f'],
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });

        const remarksChart = new Chart(remarksCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($remarksLabels) ?>,
                datasets: [{
                    label: 'Number of Students',
                    data: <?= json_encode($remarksCounts) ?>,
                    backgroundColor: 'rgba(255, 193, 7, 0.7)', // yellow-ish color
                    borderColor: 'rgba(255, 160, 0, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        ticks: {
                            precision: 0
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
