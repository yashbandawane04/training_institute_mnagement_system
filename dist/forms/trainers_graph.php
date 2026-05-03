<?php
// trainers_graph.php

include 'connection.php';

// Example: count trainers by specialization
$sql = "SELECT specialization, COUNT(*) AS total FROM trainers GROUP BY specialization";
$result = mysqli_query($conn, $sql);

$specializations = [];
$totals = [];

while ($row = mysqli_fetch_assoc($result)) {
    $specializations[] = $row['specialization'];
    $totals[] = (int)$row['total'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trainers Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        #chart {
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Trainers by Specialization</h2>
<div id="chart"></div>

<script>
// PHP arrays to JavaScript
var categories = <?php echo json_encode($specializations); ?>;
var values = <?php echo json_encode($totals); ?>;

// ApexCharts options
var options = {
    chart: {
        type: 'bar',
        height: 400
    },
    series: [{
        name: 'Number of Trainers',
        data: values
    }],
    xaxis: {
        categories: categories,
        title: { text: 'Specialization' }
    },
    yaxis: {
        title: { text: 'Total Trainers' }
    },
    colors: ['#00E396']
};

// Render chart
var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
</script>

</body>
</html>
