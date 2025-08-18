<?php
include '../connect.php';
include '../session.php';

if (!(($_SESSION['type'] == 'euser')or($_SESSION['type'] == 'muser'))) {
    header('location:..\index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Started Jobs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="..\styles\SubmitJobstyle.css">

    <style>
        h1 {
            font-family: "Jockey One", sans-serif;
        }

        th,
        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace']?> User</h1>

        <a href="..\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">

        <div class="mt-5">
            <h1>Finished Jobs</h1>

            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">Job Code <br>No</th>
                        <th scope="col">Issuing<br>User</th>
                        <th scope="col">Issuing <br>date & time</th>
                        <th scope="col">Job Issuing<br> Division</th>
                        <th scope="col">Name of<br> the Machine</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Report To</th>
                        <th scope="col">Job Electrical<br> Status</th>
                        <th scope="col">Job Mechanical<br> Status</th>
                        
                        <th scope="col">Breif <br>Description</th>
                        <th scope="col">Certiifcation <br> Status </th>
                        <!-- <th scope="col">Operations</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //sql fetch data
                    $workplace=$_SESSION['workplace'];
                    //echo $workplace;
            if($workplace=='Electrical'){
                $sql = "Select * from `jobdatasheet` where  JobStatusE='Finished' and (ReportTo='$workplace' or ReportTo='Both') and Certification='Pending Certification'";
            }else{
                $sql = "Select * from `jobdatasheet` where  JobStatusM='Finished' and (ReportTo='$workplace' or ReportTo='Both') and Certification='Pending Certification'";
            }
                    
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $JobCodeNo = $row['JobCodeNo'];
                        $username = $row['Username'];
                        $JobIssuingDateTime = $row['JobPostingDateTime'];
                        $JobIssuingDivision = $row['JobPostingDev'];
                        $MachineName = $row['MachineName'];
                        $priority = $row['Priority'];
                        $ReportTo = $row['ReportTo'];
                        $JobStatusE= $row['JobStatusE'];
                        $JobStatusM= $row['JobStatusM'];
                        $BriefDescription = $row['BDescription'];
                        $JobStatusM=$row['JobStatusM'];
                        $Certification=$row['Certification'];



                        echo
                            "


     <tr class='clickable-row' data-href='\MaintananceJobCard\EMUser\ViewJobEMUserFinished.php?updateid=$id'>
        
        <td>$JobCodeNo</td>
        <td>$username</td>
        <td>$JobIssuingDateTime</td>
        <td>$JobIssuingDivision</td>
        <td>$MachineName</td>
        <td>$priority</td>
        <td>$ReportTo</td>
        <td>$JobStatusE</td>
        <td>$JobStatusM</td>
        <td style='white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;'>$BriefDescription</td>
         <td>$Certification</td>
        
      </tr>
      
      ";

                    } ?>
                </tbody>
            </table>
            <button type="back" class="btn btn-danger mt-3" name="back"><a
                    href="\MaintananceJobCard\PUser\indexPUser.php" style="text-decoration:none;color:white">Back to
                    Main</a></button>
        </div>
    </div>


    <script>
        jQuery(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.location = $(this).data("href");
            });
        });
    </script>
</body>