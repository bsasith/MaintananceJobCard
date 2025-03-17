<?php
include '../connect.php';
include '../session.php';

 //the SQL query to be executed
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
 }
 if ($_SESSION['type'] == 'muser') {

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
 //storing the result of the executed query
 $result = $con->query($query);

 /////////////////////////////////////////////////////////////////////////
 //initialize the array to store the processed data
 $jsonArray = array();
 //check if there is any data returned by the SQL Query
 if ($result->num_rows > 0) {
   //Converting the results into an associative array
   while($row = $result->fetch_assoc()) {
     $jsonArrayItem = array();
     $jsonArrayItem['label'] = $row['JobPostingDev'];
     $jsonArrayItem['value'] = $row['TotalDownTimeInHours'];
     //append the above created object into the main array.
     header('Content-type: application/json');
     array_push($jsonArray, $jsonArrayItem);
   }
 }
 $con->close();
 //set the response content type as JSON
 //header('Content-type: application/json');
 //output the return value of json encode using the echo function.
 echo json_encode($jsonArray);
?>

////////////////////////////////////////////////////////////////////////////////////
<?php
// Fetch data using PHP (from database or another source)
$labels = ["January", "February", "March", "April", "May", "June"];
$values = [1, 1, 3, 5, 2,100];
$target = 2; // Define the target value
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

    <canvas id="myChart" width="400" height="200"></canvas>

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
                label: '# of Votes',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
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

</body>
</html>
