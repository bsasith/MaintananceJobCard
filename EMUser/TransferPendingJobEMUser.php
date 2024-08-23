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
$JobStatusE = $row['JobStatusM'];

// $gen = explode(",",$gender);
// $lang = explode(",",$datas);
// $pl = explode(",",$place);

//echo  $BriefDescription;



// update operation
if (isset($_POST['transfer'])) {
    $workplace = $_SESSION['workplace'];
    $transferto = $_POST['transferto'];
    $transfercomment = $_POST['transfercomment'];
    $_SESSION['TransferJob'] = true;


    // if ($transferto == 'Electrical') {
    //     $JobStatusM = 'NA';
    //     $JobStatusE = 'Pending';
    // }
    // elseif ($transferto == 'Mechanical') {
    //     $JobStatusM = 'Pending';
    //     $JobStatusE = 'NA';
    // }
    // elseif ($transferto == 'Both') {
    //     $JobStatusM = 'Pending';
    //     $JobStatusE = 'Pending';
    // }

    if ($transferto == 'Electrical') {
        $insert = "update jobdatasheet set ReportTo='Electrical',TransferCommentM='$transfercomment',JobStatusE='Pending',JobStatusM='NA',TryCount='2' where id='$id'";
    } elseif ($transferto == 'Mechanical') {
        $insert = "update jobdatasheet set ReportTo='Mechanical',TransferCommentE='$transfercomment',JobStatusE='NA',JobStatusM='Pending',TryCount='2' where id='$id'";
    } elseif ($transferto == 'Both') {
        $insert = "update jobdatasheet set ReportTo='Both',TransferCommentM='$transfercomment',TransferCommentE='$transfercomment',JobStatusE='Pending',JobStatusM='Pending',TryCount='2' where id='$id'";
    }
    //$insert = "update jobdatasheet set JobStatusM='Finished' where id='$id'";

    if ($con->query($insert) == TRUE) {
        //$_SESSION['SubmitJobSucess']=true;
        //echo "Sucessfully Started Job";

        header('location:.\TransferJobSucessEMUser.php');

    } else {

        echo mysqli_error($con);
        //  header('location:location:..\PUser\indexPUser.php');
    }
    //$insert->close();
}







// delete operation
// if (isset($_POST['delete'])) {

//     $sql = "delete  from `jobdatasheet` where id='$idu'";
//     $result = mysqli_query($con, $sql);
//     $_SESSION['DeleteJobSucess'] = true;
//     header('location:.\TransferJobSucessEMUser.php');



// }




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Job</title>
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
        <h1> Transfer Pending Job </h1>
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
                            Electrical Status
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
                            Brief Description
                        </td>
                        <td>
                            <?php echo $BriefDescription; ?>
                        </td>
                        <!-- Table row -->
                    <tr>
                        <td>
                            Total DownTime
                        </td>
                        <td>
                            <?php
                            date_default_timezone_set("Asia/Colombo");
                            $now = date("Y-m-d H:i:s");
                            $start_date = new DateTime(date("Y-m-d H:i:s"));
                            $since_start = $start_date->diff(new DateTime($JobIssuingDateTime));
                            echo $since_start->days . ' days total<br>';
                            echo $since_start->m . ' months<br>';
                            echo $since_start->d . ' days<br>';
                            echo $since_start->h . ' hours<br>';
                            echo $since_start->i . ' minutes<br>';
                            ?>
                        </td>
                    </tr>
                    </tr>
                    <!-- table row transferto -->
                    <tr>
                        <td>
                            Tranfer To
                        </td>
                        <td>
                            <select name="transferto" id="" class="form-control">

                                <?php
                                $workplace = $_SESSION['workplace'];
                                if ($workplace == 'Electrical') {
                                    echo "<option value='Mechanical'>Mechanical</option>";
                                    echo "<option value='Both'>Both Departments</option>";
                                } elseif ($workplace == 'Mechanical') {
                                    echo "<option value='Electrical'>Electrical</option>";
                                    echo "<option value='Both'>Both Departments</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <!-- table row comment -->
                    <tr>
                        <td>
                            Transfer Comment
                        </td>
                        <td>
                            <input type="text" class="form-control" name="transfercomment" required>
                        </td>
                    </tr>
                    </tr>

                </table>


                <button type="submit" class="btn btn-success mt-3" name="transfer"
                    onclick="return confirm('Are you sure?')">Transfer Job</button>
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