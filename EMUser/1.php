<?php
include '../connect.php';
include '../session.php';

// Initialize arrays to store data
$labels = [];
$values = [];

if ($_SESSION['type'] == 'euser') {
    $query = "SELECT 
        JobPostingDev, 
        ROUND(SUM(DownTimeE)) AS TotalDownTimeInHours
    FROM 
        jobdatasheet
    WHERE 
        MONTH(JobFinishingDateTime) = MONTH(CURRENT_DATE())
        AND YEAR(JobFinishingDateTime) = YEAR(CURRENT_DATE())
        AND (ReportTo = 'Electrical' or ReportTo ='Both')
    GROUP BY 
        JobPostingDev;";
} elseif ($_SESSION['type'] == 'muser') {
    $query = "SELECT 
        JobPostingDev, 
        ROUND(SUM(DownTimeM)) AS TotalDownTimeInHours
    FROM 
        jobdatasheet
    WHERE 
        MONTH(JobFinishingDateTime) = MONTH(CURRENT_DATE())
        AND YEAR(JobFinishingDateTime) = YEAR(CURRENT_DATE())
        AND (ReportTo = 'Mechanical' or ReportTo ='Both')
    GROUP BY 
        JobPostingDev;";
}

$result = $con->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['JobPostingDev'];
        $values[] = $row['TotalDownTimeInHours'];
    }
}

$con->close();
?>

<?php
// Define target value
$target = 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart.js with Target Line</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<canvas id="myChart" width="200" height="100">

<script>
    // Embed PHP arrays into JavaScript
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($values); ?>;
    const target = <?php echo json_encode($target); ?>; // Target value from PHP

    // Plugin to draw a target line
    const targetLine = {
        id: 'targetLine',
        afterDraw: (chart) => {
            const ctx = chart.ctx;
            const yScale = chart.scales['y']; // Get the y-axis scale
            const yPos = yScale.getPixelForValue(target); // Get the position for the target value

            // Draw the target line
            ctx.save();
            ctx.beginPath();
            ctx.moveTo(chart.chartArea.left, yPos);
            ctx.lineTo(chart.chartArea.right, yPos);
            ctx.strokeStyle = 'red'; // Color of the target line
            ctx.lineWidth = 2;
            ctx.setLineDash([5, 5]); // Optional: Make the line dashed
            ctx.stroke();
            ctx.restore();

            // Draw target label
            ctx.fillStyle = 'red';
            ctx.font = '12px Arial';
            ctx.fillText('Target: ' + target, chart.chartArea.right - 70, yPos - 5);
        }
    };

    // Create the chart
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Downtime (Hours)',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 1)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        plugins: [targetLine] // Add the plugin to draw the target line
    });
</script>
</canvas>
</body>
</html>
