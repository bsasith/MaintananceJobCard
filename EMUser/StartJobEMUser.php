<?php
include '../connect.php';
include '../session.php';

if (!(($_SESSION['type'] == 'euser') or ($_SESSION['type'] == 'muser'))) {
    header('location:..\login.php');
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

// $gen = explode(",",$gender);
// $lang = explode(",",$datas);
// $pl = explode(",",$place);

//echo  $BriefDescription;



// update operation
if (isset($_POST['start'])) {

    $_SESSION['StartJob'] = true;

    $insert = "update jobdatasheet set JobStatusM='Started' where id='$id'";

    if ($con->query($insert) == TRUE) {
        //$_SESSION['SubmitJobSucess']=true;
        echo "Sucessfully Started Job";

        header('location:.\StartJobSucess.php');

    } else {

        echo mysqli_error($con);
        //  header('location:location:..\PUser\indexPUser.php');
    }
    //$insert->close();
}






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
        <h1> Start or Transfer Job </h1>
        <div class="mt-3">
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
                            User name
                        </td>
                        <td>
                            <?php echo $username; ?>
                        </td>
                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Job Issuing Type
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
                            Brief Description
                        </td>
                        <td>
                            <?php echo $BriefDescription; ?>
                        </td>
                    </tr>

                </table>


                <button type="submit" class="btn btn-success mt-3" name="start"
                    onclick="return confirm('Are you sure?')">Start</button>
                <!-- <button type="submit" class="btn btn-warning mt-3" name="delete"
            onclick="return confirm('Are you sure?')">Transfer</button> -->
                <button type="back" class="btn btn-danger mt-3" name="back"><a
                        href="\MaintananceJobCard\EMUser\indexEMUser.php" style="text-decoration:none;color:white">Back
                        to Main</a></button>
            </form>
        </div>
    </div>




</body>
</body>