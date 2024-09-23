<?php
include '../connect.php';
include '../session.php';
if (!($_SESSION['type'] == 'euser' or $_SESSION['type'] == 'muser')) {
    header('location:..\index.php');
}


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

    <div class="container-fluid mt-5 align-items-center justify-content-center ">


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




    </div>

    </div>

</body>

</html>