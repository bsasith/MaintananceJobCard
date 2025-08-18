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
// $gen = explode(",",$gender);
// $lang = explode(",",$datas);
// $pl = explode(",",$place);

//echo  $BriefDescription;



// update operation
if (isset($_POST['start'])) {$JobType=$_POST['JobType'];
if ($JobType=="JobOrder")
{
    $JobCodeNo="JO".(substr($JobCodeNo, 2));
}
if ($JobType=="WorkOrder")
{
    $JobCodeNo="WO".(substr($JobCodeNo, 2));
}

    $_SESSION['StartJob'] = true;
    $workplace = $_SESSION['workplace'];
    if ($workplace == 'Electrical') {
        $insert = "update jobdatasheet set JobCodeNo='$JobCodeNo',JobStatusE='Started',Certification='Pending Certification' where id='$id'";
    } else {
        $insert = "update jobdatasheet set JobCodeNo='$JobCodeNo',JobStatusM='Started',Certification='Pending Certification' where id='$id'";
    }



    if ($con->query($insert) == TRUE) {
        //$_SESSION['SubmitJobSucess']=true;
        //echo "Sucessfully Started Job";

        header('location:.\StartJobSucess.php');

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
//     header('location:.\DeleteJobSuccess.php');



// }




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

    <link rel="stylesheet" href="..\styles\SubmitJobstyle.css">

    <style>
        h1 {
            font-family: "Jockey One", sans-serif;
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
        <h1> Start Job </h1>
        <div class="mt-3">
            <form method="POST">
                <table class="table table-striped w-50">
                    <h1 id="demo"></h1>
                    <tr>
                    <tr>

                        <td style="width:200px;padding:5px">
                            <label class="pr-3">Job Type</label>
                        </td>
                        <td style="width:500px;padding:5px">
                            <select name="JobType" id="JobType" class="form-select" required
                                onchange="updateTextbox()">
                                <option value="JobOrder" <?php if ((substr($JobCodeNo, 0, 2)) == "JO") {
                                    echo "selected";
                                } ?>>
                                    Job Order</option>
                                <option value="WorkOrder" <?php if ((substr($JobCodeNo, 0, 2)) == "WO") {
                                    echo "selected";
                                } ?>>Work Order</option>



                        </td>

                    </tr>
                    <!-- Table row -->
                    <tr>
                        <td>
                            Job code No
                        </td>

                        <!-- <input class="form-control" id="JobCodeNo" type="text" value="<?php echo "$JobCodeNo"; ?>" > -->
                        <script>
                            function updateTextbox() {
                                const selectedValue = document.getElementById("JobType").value;
                                const textbox = document.getElementById("JobCodeNo");

                                if (selectedValue === "JobOrder") {
                                    textbox.value = "JO" + "<?php echo substr($JobCodeNo, 2); ?>";
                                } else if (selectedValue === "WorkOrder") {
                                    textbox.value = "WO" + "<?php echo substr($JobCodeNo, 2); ?>";
                                } else {
                                    textbox.value = "";
                                }
                            }
                        </script>

                        <td style="width:500px;padding:5px">
                            <input type="text" name="JobCodeNo" class="form-control" id="JobCodeNo"
                                value="<?php echo $JobCodeNo; ?>" readonly required>
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
    <!-- <script>
    function updateTextbox() {
            const selectedValue = document.getElementById("mySelect").value;
            const textbox = document.getElementById("myTextbox");
            const textbox1 = "<?php echo "$JobCodeNo"; ?>";
            
            if (selectedValue === "JO") {
                textbox.value = 'JO'+ textbox1.substr(2);
            } else if (selectedValue === "WO") {
                textbox.value = 'WO'+ textbox1.substr(2);
            } else {
                textbox.value = "";
            }
        }
    </script> -->





</body>
</body>