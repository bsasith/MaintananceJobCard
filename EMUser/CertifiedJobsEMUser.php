<?php
include '../connect.php';
include '../session.php';

if (!(($_SESSION['type'] == 'euser') or ($_SESSION['type'] == 'muser'))) {
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
    <link rel="stylesheet" href="\MaintananceJobCard\styles\SubmitJobstyle.css">

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
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'] ?> User</h1>

        <a href="\MaintananceJobCard\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">

        <div class="mt-5">
            <h1>Certified Jobs</h1>
            <form method="post">
                <div><input type="text" class="form-control w-25" style="float:left" name="query"></div>
                <div><button class="btn btn-dark mb-4 mx-3 " type="submit" name="search"
                        style="float:left">Search</button></div>

            </form>
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
                        <th scope="col">Breif <br>Description</th>
                        <th scope="col">Certification<br> Status </th>
                        <!-- <th scope="col">Operations</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION["searchquery"]) or (isset($_POST['search']))) {
                        if (isset($_SESSION["searchquery"])) {
                            $query = $_SESSION["searchquery"];

                        }
                        if (isset($_POST['search'])) {
                            $query = $_POST['query'];
                            $_SESSION["searchquery"] = $query;
                        }
                        //  if(isset($_POST['search'])){
                        // $query=$_POST['query'];
                        //sql fetch data
                        $workplace = $_SESSION['workplace'];
                        // echo $workplace;
                        if (empty($query)) {
    // No search query entered - show latest 10
    if ($workplace == 'Electrical') {
        $sql = "SELECT * FROM `jobdatasheet` 
                WHERE JobStatusE='Finished' 
                AND Certification='Certified' 
                AND (ReportTo='$workplace' OR ReportTo='Both') 
                ORDER BY JobPostingDateTime DESC 
                LIMIT 10";
    } else {
        $sql = "SELECT * FROM `jobdatasheet` 
                WHERE JobStatusM='Finished' 
                AND Certification='Certified' 
                AND (ReportTo='$workplace' OR ReportTo='Both') 
                ORDER BY JobPostingDateTime DESC 
                LIMIT 10";
    }
} else {
    // Search query entered - return max 30 results
    if ($workplace == 'Electrical') {
        $sql = "SELECT * FROM `jobdatasheet` 
                WHERE (BDescription LIKE '%$query%' 
                OR MachineName LIKE '%$query%' 
                OR JobCodeNo LIKE '%$query%' 
                OR JobPostingDev LIKE '%$query%' 
                OR ReportTo LIKE '%$query%') 
                AND JobStatusE='Finished' 
                AND Certification='Certified' 
                AND (ReportTo='$workplace' OR ReportTo='Both') 
                ORDER BY JobPostingDateTime DESC 
                ";
    } else {
        $sql = "SELECT * FROM `jobdatasheet` 
                WHERE (BDescription LIKE '%$query%' 
                OR MachineName LIKE '%$query%' 
                OR JobCodeNo LIKE '%$query%' 
                OR JobPostingDev LIKE '%$query%' 
                OR ReportTo LIKE '%$query%') 
                AND JobStatusM='Finished' 
                AND Certification='Certified' 
                AND (ReportTo='$workplace' OR ReportTo='Both') 
                ORDER BY JobPostingDateTime DESC 
                ";
    }
}


/*
                        $result = mysqli_query($con, $sql);
                        $num = mysqli_num_rows($result);
                        $numberPerPages = 3;
                        $totalPages = ceil($num / $numberPerPages);
                        $btn=null;
                        for ($btn = 1; $btn <= $totalPages; $btn++) {
                            //echo $btn;
                            echo "<button class='btn btn-dark mx-1 mb-3'><a href=CertifiedJobsEMUser.php?page=$btn class='text-light'>$btn</a></button>";
                        }
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                           // echo $page;
                        } else {
                            $page = 1;
                        }
                        $startinglimit = (intval($page) - 1) * $numberPerPages;

                        if ($workplace == 'Electrical') {
                            $sql3 = "Select * from `jobdatasheet` where (BDescription like '%$query%' or MachineName like '%$query%' or JobCodeNo like '%$query%' or JobPostingDev like '%$query%' or ReportTo like '%$query%') and JobStatusE='Finished' and Certification='Certified' and (ReportTo='$workplace' or ReportTo='Both') limit $startinglimit,$numberPerPages";
                        } else {
                            $sql3 = "Select * from `jobdatasheet` where (BDescription like '%$query%' or MachineName like '%$query%' or JobCodeNo like '%$query%' or JobPostingDev like '%$query%' or ReportTo like '%$query%') and  JobStatusM='Finished' and Certification='Certified' and (ReportTo='$workplace' or ReportTo='Both') limit $startinglimit,$numberPerPages";
                        }
                            */
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
                            $BriefDescription = $row['BDescription'];
                            $JobStatusM = $row['JobStatusM'];
                            $Approval = $row['Certification'];



                            echo
                                "


     <tr class='clickable-row' data-href='\MaintananceJobCard\EMUser\ViewJobEMUserCertifed.php?updateid=$id'>
        
        <td>$JobCodeNo</td>
        <td>$username</td>
        <td>$JobIssuingDateTime</td>
        <td>$JobIssuingDivision</td>
        <td>$MachineName</td>
        <td>$priority</td>
        <td>$ReportTo</td>
        <td style='white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;'>$BriefDescription</td>
         <td>$Approval</td>
        
      </tr>
      
      ";

                        }
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