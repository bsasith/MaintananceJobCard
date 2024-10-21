<?php
include '../connect.php';
include '../session.php';
if (!($_SESSION['type'] == 'euser' or $_SESSION['type'] == 'muser')) {
    header('location:..\index.php');
}

echo $_SESSION['type'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Job Card</title>
    <link rel="stylesheet" href="\MaintananceJobCard\styles\indexstyle.css">

    <style>

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="../js/jquery-2.1.4.js"></script>
</head>

<body>
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'];
        ?> User</h1>

        <a href="\MaintananceJobCard\logout.php">
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
        </div>

        <!-- second line of boxes -->

        <!-- <div class="box-secondline"> -->

        <!-- <a href="\MaintananceJobCard\PUser\SubmitJob.php">
                    <div class="box" id="box3">
                        <h1 class="box-text" style="color: black">Submit a job</h1>
                    </div>
                </a>

                <a href="\MaintananceJobCard\PUser\DisplayJobListPuser.php">
                    <div class="box" id="box1">
                        <h1 class="box-text" style="color: black">See my <br>Pending Jobs</h1>
                    </div>
                </a> -->

        <!-- <div class="box" id="box4">
                    <h1 class="box-text" style="color: black">Finished Jobs</h1>
                </div> -->


        <!-- </div> -->
        <!-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        <?php



//         //the SQL query to be executed
//         $query = "SELECT 
//     JobPostingDev, 
//     ROUND(SUM(TIME_TO_SEC(DownTime)) / 3600, 2) AS TotalDownTimeInHours
// FROM 
//     jobdatasheet
// WHERE 
//     MONTH(JobPostingDateTime) = MONTH(CURRENT_DATE())
//     AND YEAR(JobPostingDateTime) = YEAR(CURRENT_DATE())
//     AND ReportTo = 'Mechanical'
// GROUP BY 
//     JobPostingDev;";
//         //storing the result of the executed query
//         $result = $con->query($query);

        /////////////////////////////////////////////////////////////////////////
        //initialize the array to store the processed data
        // $jsonArray = array();
        // //check if there is any data returned by the SQL Query
        // if ($result->num_rows > 0) {
        //     //Converting the results into an associative array
        //     $result = $con->query($query);

        //     // Prepare arrays for labels and data
        //     $labels = [];
        //     $values = [];

          
        //         while ($row = $result->fetch_assoc()) {
        //             $labels[] = $row['JobPostingDev'];
        //             $values[] = $row['TotalDownTimeInHours'];
        //         }
            

        //     $con->close();
        // }
    //    echo json_encode($labels);
    //         echo json_encode($values); 
        ?>
        <script>
            const labels = <?php echo json_encode($labels); ?>;
            const data = <?php echo json_encode($values); ?>;
//             for (i = 0; i < labels.length; i++)
//   document.writeln((i+1) + ": " + labels[i]);
//   for (i = 0; i < data.length; i++)
//   document.writeln((i+1) + ": " + data[i]);
        </script>
        <script>
            var barColors = ["red", "green","blue","orange","brown"];
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar', // or 'line', 'pie', etc.
                data: {
                    labels: labels, // from PHP
                    datasets: [{
                        label: 'Sample Data',
                        data: data, // from PHP
                        backgroundColor: 'rgb(54, 162, 235)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                        
                    }
                }
                
            });
        </script> -->
       
       <center><div  id="chart-container">FusionCharts will render here</div></center>
<script src="../js/jquery-2.1.4.js"></script>
  <script src="../js/fusioncharts.js"></script>
  <script src="../js/fusioncharts.charts.js"></script>
  <script src="../js/themes/fusioncharts.theme.zune.js"></script>
  <script src="../js/app.js"></script>

        <!-- <script>
            var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
            var yValues = [55, 49, 44, 24, 15];
            var barColors = ["red", "green", "blue", "orange", "brown"];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: "World Wine Production 2018"
                    }
                }
            });
        </script> -->

    </div>

    </div>

</body>

</html>