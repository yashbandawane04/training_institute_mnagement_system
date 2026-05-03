<?php
require 'connection.php';

// Get total amount_paid grouped by payment_method dynamically
$sql = "SELECT payment_method, SUM(amount_paid) AS total_paid FROM payments GROUP BY payment_method ORDER BY payment_method";
$result = $conn->query($sql);

$methods = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $methods[] = $row['payment_method'];
    $totals[] = (float)$row['total_paid'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Payments by Method</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .chart-container {
            width: 800px;
            max-width: 90vw;
            height: 450px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Total Amount Paid by Payment Method</h2>
    <div class="chart-container">
        <canvas id="paymentMethodChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('paymentMethodChart').getContext('2d');
        const paymentMethodChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($methods) ?>,
                datasets: [{
                    label: 'Total Amount Paid',
                    data: <?= json_encode($totals) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                animation: {
                    duration: 1200,
                    loop: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // To format y-axis with currency sign if needed
                            callback: function(value) {
                                return '₹' + value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: { font: { size: 16 } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₹ ' + context.parsed.y.toFixed(2);
                            }
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
