<?php
include '../connect.php';
include '../session.php';

if (!(($_SESSION['type'] == 'euser') or ($_SESSION['type'] == 'muser'))) {
    header('location:..\index.php');
}


$idu = $_GET['updateid'];

$sql = "Select * from jobdatasheet where id='$idu'";

$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$JobCodeNo = $row['JobCodeNo'];
$username = $_SESSION['username'];
$JobIssuingDateTime = $row['JobPostingDateTime'];
$JobIssuingDivision = $row['JobPostingDev'];
$MachineName = $row['MachineName'];
$priority = $row['Priority'];
$ReportTo = $row['ReportTo'];
$BriefDescription = $row['BDescription'];
$JobStatusM = $row['JobStatusM'];
$JobStatusE = $row['JobStatusE'];
$Username2 = $row['Username'];
$FinishedCommentE = $row['FinishedCommentE'];
$FinishedCommentM = $row['FinishedCommentM'];
$TransferCommentE = $row['TransferCommentE'];
$TransferCommentM = $row['TransferCommentE'];
$DisapproveComment = $row['DisapproveComment'];
$TryCount = $row['TryCount'];
$DownTime = $row['DownTime'];
// $gen = explode(",",$gender);
// $lang = explode(",",$datas);
// $pl = explode(",",$place);

//echo  $BriefDescription;



// update operation
// if (isset($_POST['finish'])) {
//     $workplace=$_SESSION['workplace'];
// $finishcomment=$_POST['finishcomment'];
//     $_SESSION['FinishJob'] = true;
//     if ($workplace=='Electrical')
//     {
//         $insert = "update jobdatasheet set JobStatusE='Finished',FinishedCommentE='$finishcomment' where id='$id'";
//     }
//     elseif($workplace=='Mechanical')
//     {
//         $insert = "update jobdatasheet set JobStatusM='Finished',FinishedCommentM='$finishcomment' where id='$id'";
//     }

//     //$insert = "update jobdatasheet set JobStatusM='Finished' where id='$id'";

//     if ($con->query($insert) == TRUE) {
//         //$_SESSION['SubmitJobSucess']=true;
//         //echo "Sucessfully Started Job";

//         header('location:.\FinishedJobSuccesEMUser.php');

//     } else {

//         echo mysqli_error($con);
//         //  header('location:location:..\PUser\indexPUser.php');
//     }
//     //$insert->close();
// }






// delete operation
if (isset($_POST['delete'])) {

    $sql = "delete  from `jobdatasheet` where id='$idu'";
    $result = mysqli_query($con, $sql);
    $_SESSION['DeleteJobSucess'] = true;
    header('location:.\DeleteJobSuccess.php');



}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="\MaintananceJobCard\styles\SubmitJobstyle.css">

    <style>
        h1 {
            font-family: "Jockey One", sans-serif;
        }
    </style>
</head>

<body onload="divSelect()">
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'] ?> User</h1>

        <a href="\MaintananceJobCard\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">
        <h1>View Job </h1>
        <div class="mt-3 mb-5">
            <form method="POST">
                <table class="table table-striped w-50">
                    <tr>
                        <!-- Table row -->
                    <tr>
                        <td>
                            Job code No
                        </td>
                        <td>
                            <?php echo $JobCodeNo; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Issuing User
                        </td>
                        <td>
                            <?php echo $Username2; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Job Issuing Time and Date
                        </td>
                        <td>
                            <?php echo $JobIssuingDateTime; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Job Issuing Division
                        </td>
                        <td>
                            <?php echo $JobIssuingDivision; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Machine Name
                        </td>
                        <td>
                            <?php echo $MachineName; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Priority
                        </td>
                        <td>
                            <?php echo $priority; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Report To
                        </td>
                        <td>
                            <?php echo $ReportTo; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Electrical Department Status
                        </td>
                        <td>
                            <?php echo $JobStatusE; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Mechanical Department Status
                        </td>
                        <td>
                            <?php echo $JobStatusM; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Job Origin
                        </td>
                        <td>
                            <?php
                            if ($TryCount == '1') {
                                echo "Fresh Job";
                            } else if ($TryCount == '2') {
                                echo "Transferred<br>Job ";
                            } else if ($TryCount == '3') {
                                echo "Disapproved<br> Job";
                            } ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Brief Description
                        </td>
                        <td>
                            <?php echo $BriefDescription; ?>
                        </td>
                        <!-- Table row -->
                        <?php
                        if (!is_null($FinishedCommentE)) {
                            echo "<tr>
                        <td>
                            Finished Comment Electrical
                        </td>
                        <td>
                             $FinishedCommentE 
                        </td>";
                        }
                        ?>

                        <!-- Table row -->
                        <?php
                        if (!is_null($FinishedCommentM)) {
                            echo "<tr>
                        <td>
                            Finished Comment Mechanical
                        </td>
                        <td>
                             $FinishedCommentM 
                        </td>";
                        }
                        ?>
                        <!-- Table row -->
                        <?php
                        if (!is_null($TransferCommentE)) {
                            echo "<tr>
                        <td>
                            Transfer Comment Electrical
                        </td>
                        <td>
                             $TransferCommentE 
                        </td>";
                        }
                        ?>
                        <!-- Table row -->
                        <?php
                        if (!is_null($TransferCommentM)) {
                            echo "<tr>
                        <td>
                            Transfer Comment Mechanical
                        </td>
                        <td>
                             $TransferCommentM 
                        </td>";
                        }
                        ?>
                        <!-- Table row -->
                        <?php
                        if (!is_null($DisapproveComment)) {
                            echo "<tr>
                        <td>
                            Transfer Comment Mechanical
                        </td>
                        <td>
                             $DisapproveComment
                        </td>";
                        }
                        ?>

                    <tr>
                        <td>
                            Total DownTime
                        </td>
                        <td>
                            <?php
                            // The downtime string in format "00-00-00 07:24:43" (years-months-days hours:minutes:seconds)
                            

                            // Split the string into date part and time part
                            list($datePart, $timePart) = explode(' ', $DownTime);

                            // Extract years, months, and days from the date part
                            list($years, $months, $days) = explode('-', $datePart);

                            // Extract hours, minutes, and seconds from the time part
                            list($hours, $minutes, $seconds) = explode(':', $timePart);

                            // Convert cumulative time to hours, minutes, days, and months
// Assuming 1 month = 30 days, 1 year = 12 months, 1 day = 24 hours
                            
                            // Convert years to months, and add to existing months
                            $totalMonths = ($years * 12) + $months;

                            // Add days as they are
                            $totalDays = $days;

                            // Total hours are the hours from time string
                            $totalHours = $hours;

                            // Total minutes are the minutes from the time string
                            $totalMinutes = $minutes;

                            // Output the result cumulatively
                            echo "Months: $totalMonths\n";
                            echo "Days: $totalDays\n";
                            echo "Hours: $totalHours\n";
                            echo "Minutes: $totalMinutes\n";
                            ?>
                        </td>
                    </tr>
                    </tr>
                    <!-- table row comment -->
                    <!-- <tr>
                        <td>
                            Finish Comment
                        </td>
                        <td>
                            <input type="text" class="form-control" name="finishcomment">
                        </td>
                    </tr> -->
                    </tr>

                </table>


                <!-- <button type="submit" class="btn btn-success mt-3" name="finish"
                    onclick="return confirm('Are you sure?')">Finish & send for Approval</button> -->
                <!-- <button type="submit" class="btn btn-warning mt-3" name="delete"
            onclick="return confirm('Are you sure?')">Transfer</button> -->
                <button type="back" class="btn btn-danger mt-3 mx-2" name="back"><a
                        href="\MaintananceJobCard\EMUser\indexEMUser.php" style="text-decoration:none;color:white">Back
                        to Main</a></button>
                <button type="back" class="btn btn-warning mt-3" name="back"><a class="text-dark"
                        href="\MaintananceJobCard\EMUser\FinishedJobsEMUser.php"
                        style="text-decoration:none;color:white">Back to
                        list</a></button>
            </form>
        </div>
    </div>




</body>
</body>