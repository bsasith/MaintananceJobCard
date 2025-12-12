<?php
include '../connect.php';
include '../session.php';
if (!($_SESSION['type'] == 'euser' or $_SESSION['type'] == 'muser')) {
    header('location:..\index.php');
}

if (isset($_SESSION['dashboard-logged']) && $_SESSION['dashboard-logged'] === true) {
    header('Location: /MaintananceJobCard/EMUser/Dashboard.php');
    exit;
}
//echo $_SESSION['type'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Job Card</title>
    <link rel="stylesheet" href="\MaintananceJobCard\styles\indexstyle.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="../js/jquery-2.1.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'];
                                        ?> User</h1>

        <a href="..\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>

    <div class="container-fluid mt-5 mb-1 align-items-center justify-content-center ">


        <!-- first line of boxes -->
        <div class="grid-container ">

            <!-- <a href="\MaintananceJobCard\PUser\SubmitJob.php" style="text-decoration: none;">
                    <div class="grid-item" id="box3">
                        <h1 class="box-text" style="color: black">Submit a <br>job</h1>
                    </div>
                </a> -->

            <a href="\MaintananceJobCard\EMUser\DislplayPendingJobListEMUser.php" style="text-decoration: none;">
                <div class="grid-item" id="box1">
                    <h1 class="box-text" style="color: black">See my <br>Pending Jobs</h1>
                </div>
            </a>

            <a href="\MaintananceJobCard\EMUser\StartedJobsEMUser.php" style="text-decoration: none;">
                <div class="grid-item" id="box4">
                    <h1 class="box-text" style="color: black">Finish Job</h1>
                </div>

            </a>
            <a href="\MaintananceJobCard\EMUser\FinishedJobsEMUser.php" style="text-decoration: none;">
                <div class="grid-item" id="box2">
                    <h1 class="box-text" style="color: black">Finished & Pending <br>for Certification</h1>
                </div>
            </a>
            <a href="\MaintananceJobCard\EMUser\CertifiedJobsEMUser.php" style="text-decoration: none;">
                <div class="grid-item box5" id="box5">
                    <h1 class="box-text" style="color: black">Certified <br>Jobs</h1>
                </div>
            </a>
            <a href="\MaintananceJobCard\ChangeAcountinfoAlluser.php" style="text-decoration: none;">
                <div class="grid-item box6" id="box6">
                    <h1 class="box-text" style="color: black">Change Account info</h1>
                </div>
            </a>
            <a href="\MaintananceJobCard\EMUser\ReportsEMUser.php" style="text-decoration: none;">
                <div class="grid-item box7" id="box7">
                    <h1 class="box-text" style="color: black">Reports</h1>
                </div>
            </a>
            <a href="\MaintananceJobCard\EMUser\DashBoard.php" style="text-decoration: none;">
                <div class="grid-item box8" id="box8">
                    <h1 class="box-text" style="color: black">Night Shift Dashboard</h1>
                </div>
            </a>
            <a href="\MaintananceJobCard\EMUser\EditFrinishedOrCertifiedJobsList.php" style="text-decoration: none;">
                <div class="grid-item box9" id="box9">
                    <h1 class="box-text" style="color: black">Edit Comments for<br>finished jobs</h1>
                </div>
            </a>
        </div>



    </div>

    </div>

    <?php

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
                        label: 'Downtime (Hours) Current Month',
                        data: data,
                        backgroundColor: 'rgba(75, 174, 192, 0.2)',
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

</html>