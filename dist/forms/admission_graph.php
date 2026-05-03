<?php
require 'connection.php';

// Get course wise student counts dynamically
$sql = "SELECT course, COUNT(*) AS student_count FROM admission GROUP BY course ORDER BY course";
$result = $conn->query($sql);

$courses = [];
$studentCounts = [];

while ($row = $result->fetch_assoc()) {
    $courses[] = $row['course'];
    $studentCounts[] = (int)$row['student_count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admission Course-wise Student Count</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .chart-container {
            width: 800px;
            max-width: 90vw;
            height: 450px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Students Enrolled per Course</h2>
    <div class="chart-container">
        <canvas id="admissionCourseChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('admissionCourseChart').getContext('2d');
        const admissionCourseChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($courses) ?>,
                datasets: [{
                    label: 'Number of Students',
                    data: <?= json_encode($studentCounts) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: { font: { size: 16 } }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
