<?php
declare(strict_types=1);
include 'connect.php';
include 'session.php';

if (!(($_SESSION['type'] ?? '') === 'puser' || ($_SESSION['type'] ?? '') === 'muser' || ($_SESSION['type'] ?? '') === 'euser')) {
    header('Location: .. /index.php');
    exit;
}

$con->set_charset('utf8mb4');

// CSRF token (create once per session)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

$idu = (int)($_SESSION['userID'] ?? 0);

// Fetch current user (username + password hash) using a prepared statement
$stmt = $con->prepare('SELECT id, username, password, workplace FROM users WHERE id = ? LIMIT 1');
$stmt->bind_param('i', $idu);
$stmt->execute();
$res = $stmt->get_result();
$userRow = $res ? $res->fetch_assoc() : null;
$stmt->close();

if (!$userRow) {
    http_response_code(403);
    exit('User not found.');
}

$id        = (int)$userRow['id'];
$username  = (string)$userRow['username'];
$pwdHash   = (string)$userRow['password']; // this is a HASH in the DB
$workplace = (string)$userRow['workplace'];

$msg = '';
$err = '';

// Handle submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // CSRF check
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], (string)$_POST['csrf_token'])) {
        $err = 'Invalid request. Please refresh and try again.';
    } else {
        $oldpassword = (string)($_POST['oldpassword'] ?? '');
        $newpassword1 = (string)($_POST['newpassword1'] ?? '');
        $newpassword2 = (string)($_POST['newpassword2'] ?? '');

        // Basic validation (do not reveal which check failed)
        $sameTwice = hash_equals($newpassword1, $newpassword2);
        $meetsPolicy = (strlen($newpassword1) >= 8); // adjust policy as needed

        // Verify the old password against the **hash** stored in DB
        $oldOk = password_verify($oldpassword, $pwdHash);

        if ($sameTwice && $meetsPolicy && $oldOk) {
            // Optional: upgrade hash if cost/algorithm changed
            if (password_needs_rehash($pwdHash, PASSWORD_DEFAULT)) {
                $pwdHash = password_hash($oldpassword, PASSWORD_DEFAULT);
                // Not necessary to save here; we will overwrite with the new password hash anyway.
            }

            // Hash the new password and store it
            $newHash = password_hash($newpassword1, PASSWORD_DEFAULT); // bcrypt/argon2 (depending on PHP)
            $up = $con->prepare('UPDATE users SET password = ? WHERE id = ?');
            $up->bind_param('si', $newHash, $id);
            $ok = $up->execute();
            $up->close();

            if ($ok) {
                // Invalidate old session and regen ID
                session_regenerate_id(true);
                $_SESSION['ChangePassword'] = true;
                $msg = 'Password changed successfully.';
                header('Refresh: 2; url=./index.php');
            } else {
                $err = 'Server error saving the new password. Please try again.';
            }
        } else {
            // Keep the error generic to avoid information leaks
            if (!$sameTwice) {
                $err = 'New passwords do not match.';
            } elseif (!$meetsPolicy) {
                $err = 'Password must be at least 8 characters.';
            } else {
                $err = 'Old password is incorrect.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
  <style>
    h1 { font-family: "Jockey One", sans-serif; }
    .topbar { display:flex; gap:1rem; align-items:center; padding:0.5rem 1rem; background:#f5f5f5; }
    .topbar h1 { margin:0; font-size:1.1rem; }
    .container { max-width: 720px; }
  </style>
</head>
<body>
  <div class="topbar">
      <h1 class="topbar-text">Welcome <?= e($workplace) ?> User</h1>
      <a href="..\logout.php"><h1 class="topbar-logout">Logout&nbsp;</h1></a>
      <h1 class="topbar-username"><?= e($_SESSION['username'] ?? '') ?>&nbsp;</h1>
  </div>

  <div class="container mt-5">
    <h1>Change Account Info</h1>

    <?php if ($msg): ?>
      <div class="alert alert-success mt-3" role="alert"><?= e($msg) ?></div>
    <?php endif; ?>
    <?php if ($err): ?>
      <div class="alert alert-danger mt-3" role="alert"><?= e($err) ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-3" autocomplete="off">
      <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
      <table>
        <tr>
          <td style="width:200px;padding:5px"><label class="pr-3">Username</label></td>
          <td style="width:500px;padding:5px">
            <input type="text" name="username" class="form-control" value="<?= e($username) ?>" readonly>
          </td>
        </tr>
        <tr>
          <td style="width:200px;padding:5px"><label class="pr-3">Old password</label></td>
          <td style="width:500px;padding:5px">
            <input type="password" name="oldpassword" class="form-control" required autocomplete="current-password">
          </td>
        </tr>
        <tr>
          <td style="width:200px;padding:5px"><label class="pr-3">New Password</label></td>
          <td style="width:500px;padding:5px">
            <input type="password" name="newpassword1" class="form-control" required autocomplete="new-password" minlength="8">
          </td>
        </tr>
        <tr>
          <td style="width:200px;padding:5px"><label class="pr-3">Re-enter new Password</label></td>
          <td style="width:500px;padding:5px">
            <input type="password" name="newpassword2" class="form-control" required autocomplete="new-password" minlength="8">
          </td>
        </tr>
        <tr>
          <td style="width:200px;padding:5px"></td>
          <td style="width:500px;padding:5px">
            <button type="submit" class="btn btn-primary mt-3" name="submit" value="1">Update</button>
            <a class="btn btn-danger mt-3" href="..\PUser\indexPUser.php">Back to Main</a>
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>
