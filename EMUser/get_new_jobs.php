<?php
// MaintananceJobCard/EMUser/get_new_jobs.php
include '../connect.php';
include '../session.php';

header('Content-Type: application/json');

// Allow only EM users: euser or muser
if (
    !isset($_SESSION['type']) ||
    ($_SESSION['type'] !== 'euser' && $_SESSION['type'] !== 'muser')
) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$workplace = $_SESSION['workplace'] ?? ''; // 'Electrical' or 'Mechanical'

// Remember which jobs this user has already seen in this session
if (!isset($_SESSION['last_seen_job_ids_em'])) {
    $_SESSION['last_seen_job_ids_em'] = [];
}
$last_seen_ids = $_SESSION['last_seen_job_ids_em'];

// Build query based on workplace (Electrical / Mechanical)
if ($workplace === 'Electrical') {
    // Electrical jobs: ReportTo = Electrical or Both, and Electrical status pending/started
    $sql = "
        SELECT 
            id,
            JobCodeNo,
            JobPostingDateTime,
            JobPostingDev,
            ReportTo,
            MachineName,
            Priority,
            BDescription,
            JobStatusE AS JobStatus
        FROM jobdatasheet
        WHERE 
            (ReportTo = 'Electrical' OR ReportTo = 'Both')
            AND JobStatusE IN ('Pending', 'Started')
        ORDER BY JobPostingDateTime DESC
    ";
} elseif ($workplace === 'Mechanical') {
    // Mechanical jobs: ReportTo = Mechanical or Both, and Mechanical status pending/started
    $sql = "
        SELECT 
            id,
            JobCodeNo,
            JobPostingDateTime,
            JobPostingDev,
            ReportTo,
            MachineName,
            Priority,
            BDescription,
            JobStatusM AS JobStatus
        FROM jobdatasheet
        WHERE 
            (ReportTo = 'Mechanical' OR ReportTo = 'Both')
            AND JobStatusM IN ('Pending', 'Started')
        ORDER BY JobPostingDateTime DESC
    ";
} else {
    // Fallback: show nothing
    echo json_encode([
        'jobs' => [],
        'new_jobs_count' => 0
    ]);
    exit;
}

$result = mysqli_query($con, $sql);

$jobs    = [];
$new_ids = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = (int) $row['id'];

        // New job if ID not in last_seen list
        $isNew = !in_array($id, $last_seen_ids);

        if ($isNew) {
            $new_ids[] = $id;
        }

        $row['isNew'] = $isNew;
        $jobs[] = $row;
    }
}

// Update session so these now count as "seen"
$_SESSION['last_seen_job_ids_em'] = array_column($jobs, 'id');

echo json_encode([
    'jobs'           => $jobs,
    'new_jobs_count' => count($new_ids)
]);
