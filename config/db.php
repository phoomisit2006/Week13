<?php
// For local development only. Use environment variables on a shared server.
// On hosting without env vars (e.g. Angsila), create config/db.local.php (git-ignored)
// from config/db.local.example.php and put the real credentials there.
if (is_file(__DIR__ . '/db.local.php')) {
    $local = require __DIR__ . '/db.local.php';
    foreach (['DB_HOST','DB_USER','DB_PASS','DB_NAME'] as $k) {
        if (isset($local[$k])) putenv($k . '=' . $local[$k]);
    }
}
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: 'resume_lab';
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) { error_log(mysqli_connect_error()); http_response_code(500); exit('Database unavailable'); }
mysqli_set_charset($conn, 'utf8mb4');
