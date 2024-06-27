<?php
include '../connect.php';
include '../session.php';

if (!($_SESSION['type'] == 'admin')) {
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
            <h1>All Jobs</h1>

            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">JobCodeNo </th>
                        <th scope="col">JobPostingDateTime</th>
                        <th scope="col">JobPostingDev</th>
                        <th scope="col">MachineName</th>
                        <th scope="col">Priority</th>
                        <th scope="col">ReportTo</th>
                        <th scope="col">BDescription</th>
                        <th scope="col">Username</th>
                        <th scope="col">JobStatusE</th>
                        <th scope="col">JobStatusM</th>
                        <th scope="col">Approval</th>
                        <th scope="col">FinishedCommentE</th>
                        <th scope="col">FinishedCommentM</th>
                        <th scope="col">TransferCommentE</th>
                        <th scope="col">TransferCommentM</th>

                </thead>
                <tbody>
                    <?php
                    //sql fetch data
                    $workplace = $_SESSION['workplace'];

                    echo $workplace;

                    $sql = "Select * from `jobdatasheet` ";



                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $JobCodeNo  = $row['JobCodeNo'];
                        $JobPostingDateTime = $row['JobPostingDateTime'];
                        $JobPostingDev = $row['JobPostingDev'];
                        $MachineName = $row['MachineName'];
                        $Priority = $row['Priority'];
                        $ReportTo = $row['ReportTo'];
                        $BDescription = $row['BDescription'];
                        $Username = $row['Username'];
                        $JobStatusE = $row['JobStatusE'];
                        $JobStatusM = $row['JobStatusM'];
                        $Approval = $row['Approval'];
                        $FinishedCommentE = $row['FinishedCommentE'];
                        $FinishedCommentM = $row['FinishedCommentM'];
                        $TransferCommentE = $row['TransferCommentE'];
                        $TransferCommentM = $row['TransferCommentM'];



                        echo
                            "


     <tr>
        
       <td>$JobCodeNo </td>
    <td>$JobPostingDateTime</td>
<td>$JobPostingDev</td>
<td>$MachineName</td>
<td>$Priority</td>
<td>$ReportTo</td>
<td style='white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;'>$BDescription</td>
<td>$Username</td>
<td>$JobStatusE</td>
<td>$JobStatusM</td>
<td>$Approval</td>
<td>$FinishedCommentE</td>
<td>$FinishedCommentM</td>
<td>$TransferCommentE</td>
<td>$TransferCommentM</td>

       
        
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



</body>
</body>