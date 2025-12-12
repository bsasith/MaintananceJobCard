<?php
include '../connect.php';
include '../session.php';

if (!($_SESSION['type'] == 'puser')) {
    header('location:..\index.php');
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
            cursor: pointer;
        }

        .not-certified td {
            background-color: #f8d7da !important;
            /* light red */
        }

        .transferred td {
            background-color: #78d3f7ff !important;
            /* light blue */
        }
    </style>
</head>

<body>
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'] ?> User</h1>

        <a href="..\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">

        <div class="mt-5">
            <h1>Pending Jobs</h1>

            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">Job Code <br>No</th>
                        <th scope="col">Issuing<br>User</th>
                        <th scope="col">Issuing <br>date & time</th>
                        <th scope="col">Job Issuing<br> Division</th>
                        <th scope="col">Name of<br> the Machine</th>
                        <th scope="col">Electrical Status</th>
                        <th scope="col">Mechcanical Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Report To</th>
                        <th scope="col">Breif <br>Description</th>
                        <th scope="col">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //sql fetch data
                    $workplace = $_SESSION['workplace'];

                    echo $workplace;

                    $sql = "SELECT * FROM `jobdatasheet` 
        WHERE `JobPostingDev` = '$workplace'
          AND (`JobStatusE` = 'Pending' OR `JobStatusM` = 'Pending')
          AND JobStatusE NOT IN ('Started', 'Finished')
          AND JobStatusM NOT IN ('Started', 'Finished')
        ORDER BY JobPostingDateTime DESC";


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
                        $JobStatusE = $row['JobStatusE'];
                        $JobStatusM = $row['JobStatusM'];
                        $TryCount = $row['TryCount'];
                        $Certification = $row['Certification'];
                        // consider job locked if E or M is Started or Finished

                        $classes = [];

                        $Certification = isset($row['Certification']) ? trim($row['Certification']) : '';

                        if (strcasecmp($Certification, 'Not Certified') == 0) {
                            $classes[] = 'not-certified';
                        }

                        if ($TryCount == '2') {
                            $classes[] = 'transferred';
                        }

                        $rowClass = implode(' ', $classes);

                        echo
                        "
                        


<tr class='clickable-row $rowClass' data-href='\MaintananceJobCard\PUser\ViewJobPUserPending.php?updateid=$id'>


                            
                           
        <td>$JobCodeNo</td>
        <td>$username</td>
        <td>$JobIssuingDateTime</td>
        <td>$JobIssuingDivision</td>
        <td>$MachineName</td>
        <td>$JobStatusE</td>
        <td>$JobStatusM</td>
        <td>$priority</td>
        <td>$ReportTo</td>
        <td style='white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;'>$BriefDescription</td>
";
                        if ($TryCount == '1') {
                            echo "<td><a href='\MaintananceJobCard\PUser\UpdateDeleteJob.php?updateid=$id' class='btn btn-warning'>Update or <br>Delete</a></td>";
                        } else if ($TryCount == '3') {
                            echo "<td>Disapproved <br>Job</td>  </tr>";
                        } else {
                            echo "<td>Transferred Job</td>  </tr>";
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
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
</body>
</body>