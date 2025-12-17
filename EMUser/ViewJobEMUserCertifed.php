<?php
include '../connect.php';
include '../session.php';

if (!(($_SESSION['type'] == 'euser') or ($_SESSION['type'] == 'muser'))) {
    header('location:..\index.php');
    exit();
}

$idu = $_GET['updateid'];

$sql = "SELECT * FROM jobdatasheet WHERE id = '$idu'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$id                = $row['id'];
$JobCodeNo         = $row['JobCodeNo'];
$username          = $_SESSION['username'];
$JobIssuingDateTime = $row['JobPostingDateTime'];
$JobIssuingDivision = $row['JobPostingDev'];
$MachineName       = $row['MachineName'];
$priority          = $row['Priority'];
$ReportTo          = $row['ReportTo'];
$BriefDescription  = $row['BDescription'];
$JobStatusM        = $row['JobStatusM'];
$JobStatusE        = $row['JobStatusE'];
$Username2         = $row['Username'];
$FinishedCommentE  = $row['FinishedCommentE'];
$FinishedCommentM  = $row['FinishedCommentM'];
$TransferCommentE  = $row['TransferCommentE'];
$TransferCommentM  = $row['TransferCommentM'];
$ApproveComment    = $row['ApproveComment'];
$DisapproveComment = $row['DisapproveComment'];
$TryCount          = $row['TryCount'];
$DownTimeE         = $row['DownTimeE'];
$DownTimeM         = $row['DownTimeM'];
$ProdSettingTime   = $row['ProdSettingTime'];

// Spare parts – Electrical
$spareSqlE = "SELECT * FROM spare_parts 
              WHERE JobCodeNo = '$JobCodeNo' 
                AND UserType = 'euser'";
$spareResultE = mysqli_query($con, $spareSqlE);

// Spare parts – Mechanical
$spareSqlM = "SELECT * FROM spare_parts 
              WHERE JobCodeNo = '$JobCodeNo' 
                AND UserType = 'muser'";
$spareResultM = mysqli_query($con, $spareSqlM);

// delete operation
if (isset($_POST['delete'])) {
    $sqlDel = "DELETE FROM `jobdatasheet` WHERE id = '$idu'";
    $resultDel = mysqli_query($con, $sqlDel);
    $_SESSION['DeleteJobSucess'] = true;
    header('location:.\DeleteJobSuccess.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="..\styles\SubmitJobstyle.css">

    <style>
        h1 {
            font-family: "Jockey One", sans-serif;
        }
    </style>
</head>

<body onload="divSelect()">
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'] ?> User</h1>

        <a href="..\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>
    </div>

    <div class="container mt-5 ">
        <h1>View Job</h1>
        <div class="mt-3 mb-5">
            <form method="POST">
                <!-- Main Job Details Table -->
                <table class="table table-striped w-50">
                    <tr>
                        <td>Job code No</td>
                        <td><?php echo $JobCodeNo; ?></td>
                    </tr>
                    <tr>
                        <td>Issuing User</td>
                        <td><?php echo $Username2; ?></td>
                    </tr>
                    <tr>
                        <td>Job Issuing Time and Date</td>
                        <td><?php echo $JobIssuingDateTime; ?></td>
                    </tr>
                    <tr>
                        <td>Job Issuing Division</td>
                        <td><?php echo $JobIssuingDivision; ?></td>
                    </tr>
                    <tr>
                        <td>Machine Name</td>
                        <td><?php echo $MachineName; ?></td>
                    </tr>
                    <tr>
                        <td>Priority</td>
                        <td><?php echo $priority; ?></td>
                    </tr>
                    <tr>
                        <td>Report To</td>
                        <td><?php echo $ReportTo; ?></td>
                    </tr>
                    <tr>
                        <td>Electrical Department Status</td>
                        <td><?php echo $JobStatusE; ?></td>
                    </tr>
                    <tr>
                        <td>Mechanical Department Status</td>
                        <td><?php echo $JobStatusM; ?></td>
                    </tr>
                    <tr>
                        <td>Job Origin</td>
                        <td>
                            <?php
                            if ($TryCount == '1') {
                                echo "Fresh Job";
                            } elseif ($TryCount == '2') {
                                echo "Transferred Job";
                            } elseif ($TryCount == '3') {
                                echo "Disapproved Job";
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Brief Description</td>
                        <td><?php echo $BriefDescription; ?></td>
                    </tr>

                    <?php if (!is_null($FinishedCommentE)) { ?>
                        <tr>
                            <td>Finished Comment Electrical</td>
                            <td><?php echo $FinishedCommentE; ?></td>
                        </tr>
                    <?php } ?>

                    <?php if (!is_null($FinishedCommentM)) { ?>
                        <tr>
                            <td>Finished Comment Mechanical</td>
                            <td><?php echo $FinishedCommentM; ?></td>
                        </tr>
                    <?php } ?>

                    <?php if (!is_null($TransferCommentE)) { ?>
                        <tr>
                            <td>Transfer Comment Electrical</td>
                            <td><?php echo $TransferCommentE; ?></td>
                        </tr>
                    <?php } ?>

                    <?php if (!is_null($TransferCommentM)) { ?>
                        <tr>
                            <td>Transfer Comment Mechanical</td>
                            <td><?php echo $TransferCommentM; ?></td>
                        </tr>
                    <?php } ?>

                    <?php if (!is_null($DisapproveComment)) { ?>
                        <tr>
                            <td>Disapprove Comment</td>
                            <td><?php echo $DisapproveComment; ?></td>
                        </tr>
                    <?php } ?>

                    <?php if (!is_null($DownTimeE)) { ?>
                        <tr>
                            <td>DownTime Electrical</td>
                            <td>
                                <?php
                                $DownTimeDays = round($DownTimeE / 24, 0);
                                $DownTimeHoursResidue = round(fmod($DownTimeE, 24), 0);
                                $DownTiMinutesResidue = round(fmod($DownTimeE, 1) * 60, 0);
                                echo "days: $DownTimeDays, hours: $DownTimeHoursResidue, minutes: $DownTiMinutesResidue";
                                ?>
                            </td>
                        </tr>
                    <?php } ?>

                    <?php if (!is_null($DownTimeM)) { ?>
                        <tr>
                            <td>DownTime Mechanical</td>
                            <td>
                                <?php
                                $DownTimeDaysM = round($DownTimeM / 24, 0);
                                $DownTimeHoursResidueM = round(fmod($DownTimeM, 24), 0);
                                $DownTiMinutesResidueM = round(fmod($DownTimeM, 1) * 60, 0);
                                echo "days: $DownTimeDaysM, hours: $DownTimeHoursResidueM, minutes: $DownTiMinutesResidueM";
                                ?>
                            </td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td>Certify Comment</td>
                        <td><?php echo $ApproveComment; ?></td>
                    </tr>

                    <tr>
                        <td>Production Loss (Minutes)</td>
                        <td><?php echo $ProdSettingTime; ?></td>
                    </tr>
                </table>

                <!-- Spare Parts – Electrical -->
                <h5 class="mt-4">Spare Parts Used – Electrical</h5>
                <?php if ($spareResultE && mysqli_num_rows($spareResultE) > 0) { ?>
                    <table class="table table-striped w-50">
                        <thead>
                            <tr>
                                <th>Spare part name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($spE = mysqli_fetch_assoc($spareResultE)) { ?>
                                <tr>
                                    <td><?php echo $spE['part_name']; ?></td>
                                    <td><?php echo $spE['qty']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No spare parts recorded for Electrical department.</p>
                <?php } ?>

                <!-- Spare Parts – Mechanical -->
                <h5 class="mt-4">Spare Parts Used – Mechanical</h5>
                <?php if ($spareResultM && mysqli_num_rows($spareResultM) > 0) { ?>
                    <table class="table table-striped w-50">
                        <thead>
                            <tr>
                                <th>Spare part name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($spM = mysqli_fetch_assoc($spareResultM)) { ?>
                                <tr>
                                    <td><?php echo $spM['part_name']; ?></td>
                                    <td><?php echo $spM['qty']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No spare parts recorded for Mechanical department.</p>
                <?php } ?>

                <button type="back" class="btn btn-danger mt-3 mx-2" name="back">
                    <a href=".\indexEMUser.php" style="text-decoration:none;color:white">Back to Main</a>
                </button>

                <button type="back" class="btn btn-warning mt-3" name="back">
                    <a class="text-dark" href=".\CertifiedJobsEMUser.php" style="text-decoration:none;color:white">
                        Back to list
                    </a>
                </button>
            </form>
        </div>
    </div>
</body>

</html>
