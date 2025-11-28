<?php
include '../connect.php';
include '../session.php';

date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d G:i:s");

if (!($_SESSION['type'] == 'puser')) {
    header('location:..\index.php');
    exit;
}

if (isset($_POST['submit'])) {

    // Read form data
    $Jobtype            = $_POST['JobType'];
    $JobIssuingDivision = $_POST['JobIssuingDivision'];
    $MachineName        = $_POST['MachineName'];
    $priority           = $_POST['priority'];
    $ReportTo           = $_POST['ReportTo'];
    $BriefDescription   = $_POST['BriefDescription'];
    $username           = $_SESSION['username'];

    $JobStatusE = null;
    $JobStatusM = null;

    if ($ReportTo == 'Both') {
        $JobStatusE = 'Pending';
        $JobStatusM = 'Pending';
    } elseif ($ReportTo == 'Electrical') {
        $JobStatusE = 'Pending';
        $JobStatusM = 'NA';
    } elseif ($ReportTo == 'Mechanical') {
        $JobStatusE = 'NA';
        $JobStatusM = 'Pending';
    }

    $_SESSION['SubmitJobSucess'] = false;

    // --------- START TRANSACTION ------------
    try {
        // Start transaction
        $con->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

        // Decide prefix for Job code
        if ($Jobtype == "JobOrder") {
            $JobSerString = "JO";
        } elseif ($Jobtype == "WorkOrder") {
            $JobSerString = "WO";
        } else {
            $JobSerString = "XX"; // fallback, should not happen normally
        }

        // Get next numeric part based on last jobdatasheet id
        // Lock latest row to avoid race conditions
        $sqlLast = "SELECT id FROM jobdatasheet ORDER BY id DESC LIMIT 1 FOR UPDATE";
        $resLast = mysqli_query($con, $sqlLast);

        if ($resLast && mysqli_num_rows($resLast) > 0) {
            $rowLast = mysqli_fetch_assoc($resLast);
            $nextId  = (int)$rowLast['id'] + 1;
        } else {
            $nextId  = 1; // first record
        }

        // Build ONE serial code used in BOTH tables
        $serial_no = $JobSerString . $nextId; // e.g. JO1, JO2, WO3...

        // 1) Insert into parent table: jobdatasheet
        $insertJob = "
            INSERT INTO jobdatasheet 
                (JobCodeNo,
                 JobPostingDateTime,
                 JobPostingDev,
                 MachineName,
                 Priority,
                 ReportTo,
                 BDescription,
                 Username,
                 JobStatusE,
                 JobStatusM,
                 TryCount)
            VALUES 
                ('$serial_no',
                 '$date',
                 '$JobIssuingDivision',
                 '$MachineName',
                 '$priority',
                 '$ReportTo',
                 '$BriefDescription',
                 '$username',
                 '$JobStatusE',
                 '$JobStatusM',
                 '1')
        ";

        $resJob = mysqli_query($con, $insertJob);
        if (!$resJob) {
            throw new Exception("Job insert failed: " . mysqli_error($con));
        }

        // 2) Insert into child table: serial_numbers
        $insertSerial = "
            INSERT INTO serial_numbers (serial_no, status)
            VALUES ('$serial_no', 'used')
        ";

        $resSerial = mysqli_query($con, $insertSerial);
        if (!$resSerial) {
            throw new Exception("Serial insert failed: " . mysqli_error($con));
        }

        // Commit if both inserts were successful
        $con->commit();
        $_SESSION['SubmitJobSucess'] = true;

        // Redirect after success
        header('location:..\PUser\SubmitJobSuccess.php');
        exit;

    } catch (Exception $e) {
        // Rollback the transaction on error
        $con->rollback();
        echo "Failed to submit form: " . $e->getMessage();
    }
}

// After this point, no transaction is running, connection is still open for form dropdowns.
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Submit Form</title>
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

<body onload="eee()">
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo $_SESSION['workplace'] ?> User</h1>

        <a href="..\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo $_SESSION['username'] ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">
        <h1> Job Submit Form</h1>
        <div class="mt-3">
            <form method="POST">
                <table>
                    <div class="form-group">
                        <tr>
                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Job Type</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="JobType" id="JobType" class="form-select" required>
                                    <option value="JobOrder">Job Order</option>
                                    <option value="WorkOrder">Work Order</option>
                                </select>
                            </td>
                        </tr>

                        <!-- If you want to SHOW Job Code to user, you can re-enable this as readonly
                             but it is NOT required for saving to DB now. -->
                        <!--
                        <tr>
                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Job code No</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <input type="text" name="JobCodeNo" class="form-control" id="JobCodeNo" readonly>
                            </td>
                        </tr>
                        -->

                        <tr>
                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Job Issuing Division</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="JobIssuingDivision" id="dept" class="form-select" required>
                                    <?php
                                    if ($_SESSION['workplace'] == "ACF") {
                                        echo "<option value='ACF'>ACF</option>";
                                    }
                                    if ($_SESSION['workplace'] == "CCF") {
                                        echo "<option value='CCF'>CCF</option>";
                                    }
                                    if ($_SESSION['workplace'] == "DR") {
                                        echo "<option value='DR'>DR</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Flexible") {
                                        echo "<option value='Flexible'>Flexible</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Aluminium Rodmill") {
                                        echo "<option value='Aluminium Rodmill'>Aluminium Rodmill</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Ceylon Copper") {
                                        echo "<option value='Ceylon Copper'>Ceylon Copper</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Bail Room") {
                                        echo "<option value='Bail Room'>Bail Room</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Drum Yard") {
                                        echo "<option value='Drum Yard'>Drum Yard</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Carpentry") {
                                        echo "<option value='Carpentry'>Carpentry</option>";
                                    }
                                    if ($_SESSION['workplace'] == "Quality Assurance") {
                                        echo "<option value='Quality Assurance'>Quality Assurance Department</option>";
                                    }
                                    if ($_SESSION['workplace'] == "TSD") {
                                        echo "<option value='TSD'>Technical Services Department</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Name of the Machine</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select id='division' class="form-select" name="MachineName" required>
                                    <?php
                                    $workplace = $_SESSION['workplace'];
                                    if ($workplace == 'ACF') {
                                        $Factory = 'acfmachines';
                                    }
                                    if ($workplace == 'CCF') {
                                        $Factory = 'ccfmachines';
                                    }
                                    if ($workplace == 'DR') {
                                        $Factory = 'drmachines';
                                    }
                                    if ($workplace == 'Flexible') {
                                        $Factory = 'flexiblemachines';
                                    }
                                    if ($workplace == 'Ceylon Copper') {
                                        $Factory = 'ceyloncoppermachines';
                                    }
                                    if ($workplace == 'Aluminium Rodmill') {
                                        $Factory = 'aluminiumrodmillmachines';
                                    }
                                    if ($workplace == 'Drum Yard') {
                                        $Factory = 'drumyardmachines';
                                    }
                                    if ($workplace == 'Bail Room') {
                                        $Factory = 'bailmachines';
                                    }
                                    if ($workplace == 'Carpentry') {
                                        $Factory = 'carpentrymachines';
                                    }
                                    if ($workplace == 'Quality Assurance') {
                                        $Factory = 'common';
                                    }
                                    if ($workplace == 'TSD') {
                                        $Factory = 'common';
                                    }

                                    $query = "SELECT * FROM $Factory";
                                    $result = $con->query($query);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . htmlspecialchars($row['MachineName']) . '">' . htmlspecialchars($row['MachineName']) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No data available</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Priority</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="priority" id="priority" class="form-select" required>
                                    <option value="Low">Low</option>
                                    <option value="High">High</option>
                                    <option value="Critical">Critical</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Report to</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <select name="ReportTo" class="form-select" required>
                                    <option value="Electrical">Electrical</option>
                                    <option value="Mechanical">Mechanical</option>
                                    <option value="Both">Both</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:200px;padding:5px">
                                <label class="pr-3">Brief Description</label>
                            </td>
                            <td style="width:500px;padding:5px">
                                <textarea name="BriefDescription" class="form-control" id="exampleFormControlTextarea1"
                                    rows="3" required></textarea>
                            </td>
                        </tr>
                    </div>
                </table>

                <button type="submit" class="btn btn-primary mt-3" name="submit">Submit</button>
                <button type="button" class="btn btn-danger mt-3" name="back">
                    <a href="\MaintananceJobCard\PUser\indexPUser.php"
                        style="text-decoration:none;color:white">Back to Main</a>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Keep this function to avoid JS error from body onload="eee()"
        function eee() {
            // You can add preview logic here if you want in future
        }
    </script>
</body>

</html>
