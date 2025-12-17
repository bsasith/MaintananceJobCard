<?php
include '../connect.php';
include '../session.php';

if (!($_SESSION['type'] == 'puser')) {
    header('location:..\index.php');
    exit();
}

$workplace = $_SESSION['workplace'];

/**
 * Build SQL for PUser certified jobs based on workplace and search query
 */
function buildCertifiedJobsQueryPUser(string $workplace, string $query): string
{
    // Very simple escaping of wildcard chars (optional)
    $safeQuery = str_replace(['%', '_'], ['\%', '\_'], $query);

    if ($safeQuery === '') {
        // No search → show latest 10 certified jobs for this workplace
        return "
            SELECT * FROM `jobdatasheet`
            WHERE Certification = 'Certified'
              AND JobPostingDev = '$workplace'
            ORDER BY JobPostingDateTime DESC
            LIMIT 10
        ";
    } else {
        // Search by description, machine, report to, or posting datetime
        return "
            SELECT * FROM `jobdatasheet`
            WHERE Certification = 'Certified'
              AND JobPostingDev = '$workplace'
              AND (
                    BDescription        LIKE '%$safeQuery%' 
                 OR MachineName        LIKE '%$safeQuery%'
                 OR JobCodeNo      LIKE '%$safeQuery%' 
                 OR ReportTo           LIKE '%$safeQuery%' 
                 OR JobPostingDateTime LIKE '%$safeQuery%'
              )
            ORDER BY JobPostingDateTime DESC
        ";
    }
}

// ---------- Search handling & session memory ----------

// Use a separate key in session for this page if you like:
$sessionKey = 'puser_certified_searchquery';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $queryRaw = isset($_POST['query']) ? trim($_POST['query']) : '';

    if ($queryRaw === '') {
        // Empty search clears previous search
        unset($_SESSION[$sessionKey]);
        $query = '';
    } else {
        $_SESSION[$sessionKey] = $queryRaw;
        $query = $queryRaw;
    }
} else {
    // No form submit → reuse previous query if available
    $query = isset($_SESSION[$sessionKey]) ? $_SESSION[$sessionKey] : '';
}

// Build SQL & run it
$sql    = buildCertifiedJobsQueryPUser($workplace, $query);
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certified Jobs</title>
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
        }
    </style>
</head>

<body>
    <div class="topbar">
        <h1 class="topbar-text">Welcome <?php echo htmlspecialchars($_SESSION['workplace']); ?> User</h1>

        <a href="..\logout.php">
            <h1 class="topbar-logout">Logout &nbsp</h1>
        </a>
        <h1 class="topbar-username"><?php echo htmlspecialchars($_SESSION['username']); ?>&nbsp</h1>

    </div>
    <div class="container mt-5 ">

        <div class="mt-5">
            <h1>Certified Jobs</h1>

            <!-- Search form -->
            <form method="post">
                <div>
                    <input
                        type="text"
                        class="form-control w-25"
                        style="float:left"
                        name="query"
                        placeholder="Search..."
                        value="<?php echo htmlspecialchars($query, ENT_QUOTES); ?>">
                </div>
                <div>
                    <button class="btn btn-dark mb-4 mx-3" type="submit" name="search" style="float:left">
                        Search
                    </button>
                </div>
            </form>

            <table class="table table-hover mt-5">
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
                        <th scope="col">Certification<br>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id                 = $row['id'];
                            $JobCodeNo          = $row['JobCodeNo'];
                            $username           = $row['Username'];
                            $JobIssuingDateTime = $row['JobPostingDateTime'];
                            $JobIssuingDivision = $row['JobPostingDev'];
                            $MachineName        = $row['MachineName'];
                            $priority           = $row['Priority'];
                            $ReportTo           = $row['ReportTo'];
                            $BriefDescription   = $row['BDescription'];
                            $Certification      = $row['Certification'];

                            echo "
                                <tr class='clickable-row' data-href='\\MaintananceJobCard\\PUser\\ViewJobPUserCertified.php?updateid=$id'>
                                    <td>$JobCodeNo</td>
                                    <td>$username</td>
                                    <td>$JobIssuingDateTime</td>
                                    <td>$JobIssuingDivision</td>
                                    <td>$MachineName</td>
                                    <td>$priority</td>
                                    <td>$ReportTo</td>
                                    <td style=\"white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px;\">$BriefDescription</td>
                                    <td>$Certification</td>
                                </tr>
                            ";
                        }
                    } else {
                        echo "
                            <tr>
                                <td colspan='9'>No certified jobs found for this search.</td>
                            </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>

            <button type="button" class="btn btn-danger mt-3" name="back">
                <a href="\MaintananceJobCard\PUser\indexPUser.php" style="text-decoration:none;color:white">
                    Back to Main
                </a>
            </button>
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

</html>
