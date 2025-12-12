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
$username = $row['Username'];
$JobIssuingDateTime = $row['JobPostingDateTime'];
$JobIssuingDivision = $row['JobPostingDev'];
$MachineName = $row['MachineName'];
$priority = $row['Priority'];
$ReportTo = $row['ReportTo'];
$BriefDescription = $row['BDescription'];
$JobStatusM = $row['JobStatusM'];
$JobStatusE = $row['JobStatusE'];
$JobFinishingDateTime = $row['JobFinishingDateTime'];
// $gen = explode(",",$gender);
// $lang = explode(",",$datas);
// $pl = explode(",",$place);

//echo  $BriefDescription;



// update operation
if (isset($_POST['finish'])) {
    /////Down time Calculation
    $manpowerE=$manpowerM=$_POST['manpower'];
    $finishcommentE=$finishcommentM=$_POST['finishcomment'];
    date_default_timezone_set("Asia/Colombo");
$now = date("Y-m-d H:i:s");
$start_date = new DateTime($now); // Current date and time
$jobIssuingDateTime = new DateTime($JobIssuingDateTime); // Convert the job issuing date-time string to DateTime object

// Calculate the difference
$since_start = $start_date->diff($jobIssuingDateTime);

// Get the total difference in hours
$totalHours = $since_start->days * 24 + $since_start->h + $since_start->i / 60 + $since_start->s / 3600;

    //$since_start=strval($since_start);

    ///////////////////

    $workplace = $_SESSION['workplace'];
    $finishcomment = $_POST['finishcomment'];
    $_SESSION['FinishJob'] = true;
    if ($workplace == 'Electrical') {
        $insert = "update jobdatasheet set JobStatusE='Finished',FinishedCommentE='$finishcommentE',DownTimeE='$totalHours',ManPowerInvolvedE='$manpowerE',JobFinishingDateTime='$now' where id='$id'";
    } elseif ($workplace == 'Mechanical') {
        $insert = "update jobdatasheet set JobStatusM='Finished',FinishedCommentM='$finishcommentM',DownTimeM='$totalHours',ManPowerInvolvedM='$manpowerM',JobFinishingDateTime='$now' where id='$id'";
    }

    //$insert = "update jobdatasheet set JobStatusM='Finished' where id='$id'";
// Example: Insert spare parts used

// Example: Insert spare parts used (optional section)

$part_names = isset($_POST['part_name']) ? $_POST['part_name'] : [];
$qtys       = isset($_POST['qty'])       ? $_POST['qty']       : [];

// Prepare insert only if array exists and has at least one element
if (!empty($part_names)) {

    $insert_spare = $con->prepare(
        "INSERT INTO spare_parts (JobCodeNo, part_name, qty) VALUES (?, ?, ?)"
    );

  

    for ($i = 0; $i < count($part_names); $i++) {

        $name = trim($part_names[$i]);
        $qty  = trim($qtys[$i]);

        // If both fields are empty, skip (optional section)
        if ($name === '' && $qty === '') {
            continue;
        }

        // Only insert valid rows (JS should catch bad ones, but double-safety)
        if (!empty($name) && !empty($qty) && is_numeric($qty)) {

            // JobCodeNo = string, part_name = string, qty = int
            $insert_spare->bind_param("ssi", $JobCodeNo, $name, $qty);

            if (!$insert_spare->execute()) {
                // For debugging; remove after testing
                die("Execute failed: " . $insert_spare->error);
            }
        }
    }

    $insert_spare->close();
}


    if ($con->query($insert) == TRUE) {
        //$_SESSION['SubmitJobSucess']=true;
        //echo "Sucessfully Started Job";

        header('location:.\FinishedJobSuccesEMUser.php');

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
        <h1> Finish Job </h1>
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
                            <?php echo $JobIssuingDateTime;?>
                            
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
                    <!-- table row comment -->
                    <tr>
                        <td>
                            Man Power Involved
                        </td>
                        <td>
                            <input type="text" class="form-control" name="manpower" required>
                        </td>
                    </tr>
                    <!-- table row comment -->
                    <tr>
                        <td>
                            Finish Comment
                        </td>
                        <td>
                            <input type="text" class="form-control" name="finishcomment" required>
                        </td>
                    </tr>
                   <!-- table row comment -->
                    <!-- Row of input fields -->
<!-- Row of input fields -->
<tr>
    <td class="py-3">
        <label for="spareParts">Spare Parts Used</label>
    </td>
    <td class="px-3" style="width: 500px;">

        <table id="sparePartsTable">
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th>Qty.</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="sparePartsBody">
                <tr>
                    <td>
                        <input class="form-control" type="text" name="part_name[]" placeholder="Enter part name">
                    </td>
                    <td>
                        <input class="form-control" type="number" name="qty[]" min="1" placeholder="0">
                    </td>
                    <td class="text-center">
                        <!-- first row usually not deleted, but keep button if you want -->
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button class="form-control bg-info w-50 mt-2" type="button" onclick="addSparePart()">
            Add Spare Part
        </button>

<script>
    function addSparePart() {
        let container = document.getElementById('sparePartsBody');
        let newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>
                <input class="form-control" type="text" name="part_name[]" placeholder="Enter part name">
            </td>
            <td>
                <input class="form-control" type="number" name="qty[]" min="1" placeholder="0">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">
                    Delete
                </button>
            </td>
        `;

        container.appendChild(newRow);
    }

    function deleteRow(button) {
        let row = button.closest('tr');
        row.remove();
    }

    // Validation on form submit (spare parts optional)
    document.querySelector('form').addEventListener('submit', function (e) {
        const partNames = document.querySelectorAll('input[name="part_name[]"]');
        const qtys      = document.querySelectorAll('input[name="qty[]"]');

        let errors = [];

        for (let i = 0; i < partNames.length; i++) {
            const name     = partNames[i].value.trim();
            const qtyValue = qtys[i].value.trim();
            const qty      = Number(qtyValue);

            // If both empty → ignore row (optional section)
            if (name === '' && qtyValue === '') {
                continue;
            }

            // If one filled and one empty → error
            if (name === '' && qtyValue !== '') {
                errors.push(`Part name is required in row ${i + 1}`);
            } else if (name !== '' && qtyValue === '') {
                errors.push(`Quantity is required in row ${i + 1}`);
            } else {
                // Both filled → check quantity validity
                if (isNaN(qty) || qty <= 0) {
                    errors.push(`Quantity must be a positive number in row ${i + 1}`);
                }
            }
        }

        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join('\n'));
        }
    });
</script>


    </td>
</tr>

        <!-- end of row -->

                </table>


                <button type="submit" class="btn btn-success mt-3" name="finish"
                    onclick="return confirm('Are you sure?')">Finish & send for Approval</button>
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