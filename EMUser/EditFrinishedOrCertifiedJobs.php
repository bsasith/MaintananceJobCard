<?php
include '../connect.php';
include '../session.php';

if (!(($_SESSION['type'] == 'euser') or ($_SESSION['type'] == 'muser'))) {
    header('location:..\index.php');
    exit;
}

$idu = $_GET['updateid'];
$workplace = $_SESSION['workplace'];

$sql = "SELECT * FROM jobdatasheet WHERE id='$idu'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$id                  = $row['id'];
$JobCodeNo           = $row['JobCodeNo'];
$username            = $row['Username'];
$JobIssuingDateTime  = $row['JobPostingDateTime'];
$JobIssuingDivision  = $row['JobPostingDev'];
$MachineName         = $row['MachineName'];
$priority            = $row['Priority'];
$ReportTo            = $row['ReportTo'];
$BriefDescription    = $row['BDescription'];
$JobStatusM          = $row['JobStatusM'];
$JobStatusE          = $row['JobStatusE'];
$JobFinishingDateTime= $row['JobFinishingDateTime'];
$manpowerE           = $row['ManPowerInvolvedE'];
$manpowerM           = $row['ManPowerInvolvedM'];
$finishedcommentE    = $row['FinishedCommentE'];
$finishedcommentM    = $row['FinishedCommentM'];

// Load spare parts for this JobCodeNo
$sql2    = "SELECT * FROM spare_parts WHERE JobCodeNo = '$JobCodeNo'";
$result2 = mysqli_query($con, $sql2);

// update operation
if (isset($_POST['finish'])) {
    ///// Down time Calculation (you are not saving it here, but keeping as you wrote)
    $manpowerE = $manpowerM = $_POST['manpower'];
    $finishcomment = $_POST['finishcomment'];

    date_default_timezone_set("Asia/Colombo");
    $now = date("Y-m-d H:i:s");
    $start_date = new DateTime($now); 
    $jobIssuingDateTime = new DateTime($JobIssuingDateTime);

    // Calculate the difference
    $since_start = $start_date->diff($jobIssuingDateTime);

    // Get the total difference in hours
    $totalHours = $since_start->days * 24 + $since_start->h + $since_start->i / 60 + $since_start->s / 3600;

    ///////////////////

    $workplace = $_SESSION['workplace'];
    $_SESSION['FinishJob'] = true;

    if ($workplace == 'Electrical') {
        $insert = "UPDATE jobdatasheet 
                   SET JobStatusE='Finished',
                       FinishedCommentE='$finishcomment',
                       ManPowerInvolvedE='$manpowerE'
                   WHERE id='$id'";
    } elseif ($workplace == 'Mechanical') {
        $insert = "UPDATE jobdatasheet 
                   SET JobStatusM='Finished',
                       FinishedCommentM='$finishcomment',
                       ManPowerInvolvedM='$manpowerM'
                   WHERE id='$id'";
    } else {
        $insert = "";
    }

    if (!empty($insert) && $con->query($insert) === TRUE) {

        // 🔧 Spare parts section (OPTIONAL)

        // Remove all existing spare parts for this job
        $con->query("DELETE FROM spare_parts WHERE JobCodeNo = '$JobCodeNo'");

        // Get arrays from form
        $part_names = isset($_POST['part_name']) ? $_POST['part_name'] : [];
        $qtys       = isset($_POST['qty'])       ? $_POST['qty']       : [];

        if (!empty($part_names)) {

            $insert_spare = $con->prepare(
                "INSERT INTO spare_parts (JobCodeNo, part_name, qty) VALUES (?, ?, ?)"
            );

            if (!$insert_spare) {
                die("Prepare failed: " . $con->error);
            }

            for ($i = 0; $i < count($part_names); $i++) {

                $name = trim($part_names[$i]);
                $qty  = trim($qtys[$i]);

                // If both fields empty → skip (optional)
                if ($name === '' && $qty === '') {
                    continue;
                }

                // Only insert valid rows
                if (!empty($name) && !empty($qty) && is_numeric($qty)) {

                    // JobCodeNo = string, part_name = string, qty = int
                    $insert_spare->bind_param("ssi", $JobCodeNo, $name, $qty);

                    if (!$insert_spare->execute()) {
                        die("Execute failed: " . $insert_spare->error);
                    }
                }
            }

            $insert_spare->close();
        }

        header('location:.\EditFrinishedOrCertifiedJobsSuccess.php');
        exit;

    } else {
        echo mysqli_error($con);
    }
}

// delete operation
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM jobdatasheet WHERE id='$idu'";
    $result = mysqli_query($con, $sql);
    $_SESSION['DeleteJobSucess'] = true;
    header('location:.\DeleteJobSuccess.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Finished Job</title>
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
        <h1>Edit Finished Job</h1>
        <div class="mt-3">
            <form method="POST" id="editJobForm">
                <table class="table table-striped w-50">
                    <!-- Job details rows -->
                    <tr>
                        <td>Job code No</td>
                        <td><?php echo $JobCodeNo; ?></td>
                    </tr>
                    <tr>
                        <td>User name</td>
                        <td><?php echo $username; ?></td>
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
                        <td>Brief Description</td>
                        <td><?php echo $BriefDescription; ?></td>
                    </tr>
                    <tr>
                        <td>Total DownTime</td>
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

                    <!-- Man power & comments -->
                    <tr>
                        <td>Man Power Involved</td>
                        <td>
                            <input type="text" class="form-control" name="manpower"
                                value="<?php 
                                    if ($workplace == 'Electrical') {
                                        echo $manpowerE;
                                    } elseif ($workplace == 'Mechanical') {
                                        echo $manpowerM;
                                    }
                                ?>" >
                        </td>
                    </tr>

                    <tr>
                        <td>Finish Comment</td>
                        <td>
                            <input type="text" class="form-control" name="finishcomment"
                                value="<?php
                                    if ($workplace == 'Electrical') {
                                        echo $finishedcommentE;
                                    } elseif ($workplace == 'Mechanical') {
                                        echo $finishedcommentM;
                                    }
                                ?>" >
                        </td>
                    </tr>

                    <!-- Spare parts table (optional) -->
                    <tr>
                        <td class="py-3">
                            <label for="spareParts">Spare Parts Used</label>
                        </td>
                        <td class="px-3" style="width: 500px;">

                            <table id="sparePartsTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Part Name</th>
                                        <th>Qty.</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="sparePartsBody">
                                    <?php
                                    if (mysqli_num_rows($result2) > 0) {
                                        mysqli_data_seek($result2, 0);
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $part_name = htmlspecialchars($row2['part_name']);
                                            $qty       = (int)$row2['qty'];

                                            echo "<tr>";
                                            echo "<td><input class='form-control' type='text' name='part_name[]' value=\"$part_name\"></td>";
                                            echo "<td><input class='form-control' type='number' name='qty[]' min='1' value=\"$qty\"></td>";
                                            echo "<td class='text-center'>
                                                    <button type='button' class='btn btn-danger btn-sm' onclick='deleteRow(this)'>
                                                        Delete
                                                    </button>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // No existing parts → one empty row
                                        echo "<tr>
                                                <td><input class='form-control' type='text' name='part_name[]' placeholder='Enter part name'></td>
                                                <td><input class='form-control' type='number' name='qty[]' min='1' placeholder='0'></td>
                                                <td class='text-center'>
                                                    <button type='button' class='btn btn-danger btn-sm' onclick='deleteRow(this)'>
                                                        Delete
                                                    </button>
                                                </td>
                                              </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <button class="form-control bg-info w-50 mt-2" type="button" onclick="addSparePart()">
                                Add Spare Part
                            </button>

                        </td>
                    </tr>
                </table>

                <button type="submit" class="btn btn-success mt-3" name="finish"
                    onclick="return confirm('Are you sure?')">Finish Editing</button>

                <button type="button" class="btn btn-danger mt-3" name="back">
                    <a href="..\EMUser\indexEMUser.php" style="text-decoration:none;color:white">
                        Back to Main
                    </a>
                </button>
            </form>
        </div>
    </div>

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

        // Make spare parts optional, but validate filled rows
        document.getElementById('editJobForm').addEventListener('submit', function (e) {
            const partNames = document.querySelectorAll('input[name="part_name[]"]');
            const qtys      = document.querySelectorAll('input[name="qty[]"]');

            let errors = [];

            for (let i = 0; i < partNames.length; i++) {
                const name     = partNames[i].value.trim();
                const qtyValue = qtys[i].value.trim();
                const qty      = Number(qtyValue);

                // If both empty → ignore (section optional)
                if (name === '' && qtyValue === '') {
                    continue;
                }

                // One filled, one empty → error
                if (name !== '' && qtyValue === '') {
                    errors.push(`Quantity is required in spare part row ${i + 1}`);
                } else if (name === '' && qtyValue !== '') {
                    errors.push(`Part name is required in spare part row ${i + 1}`);
                } else if (name !== '' && qtyValue !== '') {
                    if (isNaN(qty) || qty <= 0) {
                        errors.push(`Quantity must be a positive number in spare part row ${i + 1}`);
                    }
                }
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join('\n'));
            }
        });
    </script>

</body>
</html>
