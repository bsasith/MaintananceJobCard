<?php
// MaintananceJobCard/EMUser/DashBoard.php
include '../connect.php';
include '../session.php';
$_SESSION['dashboard-logged'] = true;

if (
    !isset($_SESSION['type']) ||
    ($_SESSION['type'] !== 'euser' && $_SESSION['type'] !== 'muser')
) {
    header('Location: ../index.php');
    exit;
}

date_default_timezone_set('Asia/Colombo');

$username  = $_SESSION['username'];
// echo $username;

$workplace = $_SESSION['workplace'] ?? ''; // 'Electrical' or 'Mechanical'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maintenance Dashboard - <?php echo htmlspecialchars($workplace); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    >

    <style>
        body {
            background-color: #f8f9fa;
        }
        .topbar {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .topbar h1 {
            font-size: 20px;
            margin: 0 10px;
        }

        /* Blinking red dot for NEW jobs */
        .red-dot-table {
            width: 12px;
            height: 12px;
            background: red;
            border-radius: 50%;
            display: inline-block;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%   { opacity: 1; }
            50%  { opacity: 0; }
            100% { opacity: 1; }
        }

        .small-input {
            width: 90px;
        }
    </style>
</head>
<body>

<div class="topbar">
    <h1><?php echo htmlspecialchars($username); ?> (<?php echo htmlspecialchars($workplace); ?>)</h1>
    <a href="../logout.php" class="btn btn-sm btn-outline-light ms-3">Logout</a>
</div>

<div class="container mt-4">
    <h2>Maintenance Dashboard</h2>

    <div class="mt-3 p-3 bg-white rounded shadow-sm">
        <h4>
            Active Jobs for <?php echo htmlspecialchars($workplace); ?> User
        </h4>
        <small class="text-muted">
            New jobs show with a blinking red dot.
            Use the buttons in the table to <strong>Start</strong>, <strong>Finish</strong>, or <strong>Transfer</strong> jobs.
            This table refreshes automatically.
        </small>
    </div>

    <div class="mt-3">
        <table class="table table-bordered table-striped" id="jobTable">
            <thead class="table-dark">
                <tr>
                    <th style="width: 40px;"></th> <!-- red dot -->
                    <th>Job Code No</th>
                    <th>Posting Time</th>
                    <th>Issuing Division</th>
                    <th>Report To</th>
                    <th>Machine Name</th>
                    <th>Priority</th>
                    <th>Brief Description</th>
                    <th style="width: 320px;">Actions</th>
                </tr>
            </thead>
            <tbody id="jobBody">
                <tr>
                    <td colspan="9" class="text-center">Loading jobs...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
// JS knows whether this is Electrical or Mechanical user
const workplace = "<?php echo htmlspecialchars($workplace, ENT_QUOTES); ?>";

function loadJobs() {
    fetch("get_new_jobs.php")
        .then(res => {
            if (!res.ok) {
                throw new Error("Network response was not ok: " + res.status);
            }
            return res.json();
        })
        .then(data => {
            const tbody = document.getElementById("jobBody");
            tbody.innerHTML = "";

            if (!data.jobs || data.jobs.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-danger">
                            No active jobs (Pending / Started) for ${workplace}
                        </td>
                    </tr>
                `;
                return;
            }

            data.jobs.forEach(job => {
                const tr = document.createElement("tr");

                const dotCell = `
                    <td>
                        ${job.isNew ? '<span class="red-dot-table"></span>' : ''}
                    </td>
                `;

                const statusText = job.JobStatus; // already picked in PHP as JobStatusE or JobStatusM

                let actionsHtml = '';

                // For Pending jobs: Start + Transfer
                if (statusText === 'Pending') {
                    actionsHtml = `
                        <a href="StartJobEMUser.php?updateid=${job.id}"
                           class="btn btn-sm btn-success mb-1">
                            Start Job
                        </a>
                        <a href="TransferPendingJobEMUser.php?updateid=${job.id}"
                           class="btn btn-sm btn-warning mb-1">
                            Transfer Job
                        </a>
                    `;
                }
                // For Started jobs: Finish + Transfer
                else if (statusText === 'Started') {
                    actionsHtml = `
                        <a href="FinishJobEMUser.php?updateid=${job.id}"
                           class="btn btn-sm btn-primary mb-1">
                            Finish Job
                        </a>
                        <a href="TransferStartedJobEMUser.php?updateid=${job.id}"
                           class="btn btn-sm btn-warning mb-1">
                            Transfer Job
                        </a>
                    `;
                }
                // Just in case (should not appear here, but safe)
                else {
                    actionsHtml = `<span class="text-muted">${statusText}</span>`;
                }

                tr.innerHTML =
                    dotCell +
                    `<td>${job.JobCodeNo}</td>
                     <td>${job.JobPostingDateTime}</td>
                     <td>${job.JobPostingDev}</td>
                     <td>${job.ReportTo}</td>
                     <td>${job.MachineName}</td>
                     <td>${job.Priority}</td>
                     <td>${job.BDescription}</td>
                     <td>${actionsHtml}</td>`;

                tbody.appendChild(tr);
            });

            // Popup only when new jobs arrived since last refresh
            if (data.new_jobs_count && data.new_jobs_count > 0) {
                alert(data.new_jobs_count + " new job(s) received for " + workplace + "!");
            }
        })
        .catch(err => {
            console.error("Error loading jobs:", err);
            const tbody = document.getElementById("jobBody");
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center text-danger">
                        Error loading jobs
                    </td>
                </tr>
            `;
        });
}

// First load
loadJobs();

// Auto-refresh every 10 seconds
setInterval(loadJobs, 10000);
</script>

</body>
</html>
