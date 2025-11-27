<?php
declare(strict_types=1);

// ---------------- Security headers (lightweight, CDN-friendly) ----------------
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer-when-downgrade');

// ---------------- Session hardening ----------------
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? null) == 443;
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',     // set your domain if needed
    'secure' => $isHttps,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

// A tiny helper
function redirect_and_exit(string $path): void {
    header('Location: ' . $path, true, 302);
    exit;
}

// ---------------- DB connection ----------------
// Use your existing connect.php, but ensure it exposes a **mysqli** instance $con
// with error mode enabled.
require __DIR__ . '/connect.php';
if (!($con instanceof mysqli)) {
    http_response_code(500);
    exit('DB connection not available.');
}
$con->set_charset('utf8mb4');

// ---------------- CSRF token (POST forms) ----------------
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// ---------------- Already logged in? ----------------
$routes = [
    'admin' => './admin/indexAdminUser.php',
    'puser' => './PUser/indexPUser.php',
    'euser' => './EMUser/indexEMUser.php',
    'muser' => './EMUser/indexEMUser.php',
];
if (!empty($_SESSION['LOGGEDIN']) && !empty($_SESSION['type']) && isset($routes[$_SESSION['type']])) {
    redirect_and_exit($routes[$_SESSION['type']]);
}

// ---------------- Basic rate limiting (per session) ----------------
$_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? 0;
$_SESSION['login_last']     = $_SESSION['login_last']     ?? 0;
$LOCK_WINDOW_SEC = 60;
$MAX_ATTEMPTS    = 10;

$tooManyAttempts = ($_SESSION['login_attempts'] >= $MAX_ATTEMPTS) && (time() - (int)$_SESSION['login_last'] < $LOCK_WINDOW_SEC);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Check CSRF
    $tokenOk = isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string)$_POST['csrf_token']);
    if (!$tokenOk) {
        $error = 'Invalid request. Please refresh and try again.';
    } elseif ($tooManyAttempts) {
        $error = 'Too many attempts. Please wait a minute and try again.';
    } else {
        $user = trim((string)($_POST['username'] ?? ''));
        $pass = (string)($_POST['password'] ?? '');

        // Minimal validation (avoid user enumeration; same message either way)
        if ($user === '' || $pass === '' || mb_strlen($user) > 100) {
            $error = 'Invalid username or password';
        } else {
            // Use a prepared statement, lookup by username
            $stmt = $con->prepare('SELECT id, username, password, type, workplace FROM users WHERE username = ? LIMIT 1');
            if ($stmt === false) {
                $error = 'Server error. Please try again later.';
            } else {
                $stmt->bind_param('s', $user);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res ? $res->fetch_assoc() : null;
                $stmt->close();

                // IMPORTANT:
                // The "password" column should contain a bcrypt/argon hash created by password_hash().
                // Do NOT store plaintext.
                $verified = false;
                if ($row) {
                    $hashFromDb = (string)$row['password'];
                    // If you are migrating from plaintext to hashed passwords,
                    // see the note after this code block.
                    $verified = password_verify($pass, $hashFromDb);
                }

                if ($verified) {
                    // Successful login: reset attempts, regenerate session ID
                    $_SESSION['login_attempts'] = 0;
                    $_SESSION['login_last'] = 0;
                    session_regenerate_id(true);

                    $_SESSION['LOGGEDIN']  = true;
                    $_SESSION['userID']    = (int)$row['id'];
                    $_SESSION['username']  = (string)$row['username'];
                    $_SESSION['type']      = (string)$row['type'];
                    $_SESSION['workplace'] = (string)$row['workplace'];
                    $_SESSION['ua_hash']   = hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? ''); // optional bind
                    $_SESSION['ip_hash']   = hash('sha256', $_SERVER['REMOTE_ADDR'] ?? '');     // optional bind
                    $_SESSION['last_seen'] = time();

                    $type = $_SESSION['type'];
                    $dest = $routes[$type] ?? './';
                    redirect_and_exit($dest);
                } else {
                    // Failed login; increment attempts but keep generic error
                    $_SESSION['login_attempts'] = (int)$_SESSION['login_attempts'] + 1;
                    $_SESSION['login_last'] = time();
                    $error = 'Invalid username or password';
                    // Optional: add a tiny random sleep to reduce brute force efficiency
                    usleep(random_int(10000, 90000));
                }
            }
        }
    }
}

// Escape helper for HTML output
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Maintenance Job Card Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
    <style>
        h1, h4 { font-family: "Jockey One", sans-serif; margin-left:auto; margin-right:auto; }
        .headingweb { margin-top: 100px; }
        .loginform { max-width: 420px; margin-left:auto; margin-right:auto; }
    </style>
</head>
<body>
<div class="container">
    <div class="headingweb text-center">
        <div><img src="logo.jpg" style="height:100px; width:auto" alt="Logo"></div>
        <h1>Maintenance Job Card Web</h1>
        <h4>ACL(C):QDI:06:02:04</h4>
    </div>

    <div class="loginform">
        <?php if ($error !== ''): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= e($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($tooManyAttempts): ?>
            <div class="alert alert-warning text-center" role="alert">
                Too many attempts. Please wait a minute and try again.
            </div>
        <?php else: ?>
            <form method="POST" autocomplete="on" novalidate>
                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="inputUsername"
                           placeholder="Username" required autocomplete="username" maxlength="100">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="inputPassword"
                           placeholder="Password" required autocomplete="current-password">
                </div>
                <button type="submit" class="btn btn-primary w-100" name="login" value="1">Login</button>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
