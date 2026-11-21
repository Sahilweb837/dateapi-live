<?php
/**
 * CupDate Live Server Diagnostic Tool
 * Access URL: https://cupdate.in/diag.php?key=cupdate2026
 */

define('DIAG_KEY', 'cupdate2026');

if (($_GET['key'] ?? '') !== DIAG_KEY) {
    http_response_code(403);
    die('<h2 style="font-family:sans-serif;color:#c53030;">403 Unauthorized. Access key required: ?key=cupdate2026</h2>');
}

header('Content-Type: text/html; charset=utf-8');

$baseDir = dirname(__DIR__);
if (basename(__DIR__) === 'public') {
    $baseDir = dirname(__DIR__);
} else {
    $baseDir = __DIR__;
}

$results = [];

// 1. PHP Version
$phpVersion = PHP_VERSION;
$phpOk = version_compare($phpVersion, '8.2.0', '>=');
$results[] = [
    'name' => 'PHP Version',
    'status' => $phpOk,
    'detail' => $phpVersion . ($phpOk ? ' (Compatible with Laravel 12)' : ' (Requires PHP 8.2+)')
];

// 2. Required Extensions
$requiredExts = ['pdo', 'pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'curl', 'fileinfo'];
foreach ($requiredExts as $ext) {
    $loaded = extension_loaded($ext);
    $results[] = [
        'name' => 'Extension: ' . $ext,
        'status' => $loaded,
        'detail' => $loaded ? 'Installed & Active' : 'MISSING (Enable in cPanel -> Select PHP Version -> Extensions)'
    ];
}

// 2b. Optional SQLite
$sqliteLoaded = extension_loaded('pdo_sqlite');
$results[] = [
    'name' => 'Extension: pdo_sqlite (Fallback)',
    'status' => true,
    'detail' => $sqliteLoaded ? 'Installed (SQLite Fallback Available)' : 'Not Installed (MySQL Only)'
];

// 3. Storage Directory Writable Check & Auto-fix
$dirs = [
    'storage/framework/views',
    'storage/framework/sessions',
    'storage/framework/cache/data',
    'storage/logs',
    'bootstrap/cache',
];

if (isset($_GET['fix_permissions'])) {
    foreach ($dirs as $d) {
        $p = $baseDir . '/' . $d;
        if (!is_dir($p)) @mkdir($p, 0777, true);
        @chmod($p, 0777);
    }
    // Clear view cache
    $viewFiles = glob($baseDir . '/storage/framework/views/*.php');
    if ($viewFiles) { foreach ($viewFiles as $f) { @unlink($f); } }
    // Clear bootstrap cache
    $cacheFiles = glob($baseDir . '/bootstrap/cache/*.php');
    if ($cacheFiles) { foreach ($cacheFiles as $f) { if (basename($f) !== '.gitignore') @unlink($f); } }
}

foreach ($dirs as $d) {
    $path = $baseDir . '/' . $d;
    if (!is_dir($path)) {
        @mkdir($path, 0777, true);
    }
    @chmod($path, 0777);
    $writable = is_writable($path);
    $results[] = [
        'name' => 'Writable: ' . $d,
        'status' => $writable,
        'detail' => $writable ? 'Writable (OK)' : 'PERMISSION DENIED! Needs chmod 777'
    ];
}

// 4. Test .env reading
$envFile = $baseDir . '/.env';
$hasEnv = file_exists($envFile);
$results[] = [
    'name' => '.env File Present',
    'status' => $hasEnv,
    'detail' => $hasEnv ? 'Found in ' . $envFile : 'MISSING! Copy .env.production to .env'
];

$dbHost = 'localhost';
$dbName = 'cupdate_1_cupcup';
$dbUser = 'cupdate_1_cupcup';
$dbPass = 'a0}A6(k7R#N=';

if ($hasEnv) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($k, $v) = explode('=', $line, 2);
            $k = trim($k);
            $v = trim($v, " \t\n\r\0\x0B\"'");
            if ($k === 'DB_HOST') $dbHost = $v;
            if ($k === 'DB_DATABASE') $dbName = $v;
            if ($k === 'DB_USERNAME') $dbUser = $v;
            if ($k === 'DB_PASSWORD') $dbPass = $v;
        }
    }
}

// 5. Database Connection Test
$dbStatus = false;
$dbMessage = '';
try {
    $dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 3,
    ]);
    $tableCount = $pdo->query("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '{$dbName}'")->fetchColumn();
    $dbStatus = true;
    $dbMessage = "Successfully connected to `{$dbName}`! Tables found: {$tableCount}";
} catch (\Throwable $e) {
    $dbStatus = false;
    $dbMessage = "Failed: " . $e->getMessage();
}

$results[] = [
    'name' => 'MySQL Connection (' . $dbHost . ' / ' . $dbName . ')',
    'status' => $dbStatus,
    'detail' => $dbMessage
];

// 6. Recent Laravel Log Lines
$logFile = $baseDir . '/storage/logs/laravel.log';
$logSnippet = '';
if (file_exists($logFile) && filesize($logFile) > 0) {
    $content = file_get_contents($logFile);
    $lines = explode("\n", $content);
    $lastLines = array_slice($lines, -40);
    $logSnippet = implode("\n", $lastLines);
} else {
    $logSnippet = "Log file is empty or has not been created yet.";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>CupDate Server Diagnostics</title>
<style>
body { font-family: -apple-system, sans-serif; background: #fdf8f6; color: #2c1a14; padding: 30px; margin: 0; }
.card { background: white; border-radius: 14px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); max-width: 900px; margin: 0 auto; overflow: hidden; border: 1px solid #f1dfd8; }
.header { background: #22140d; color: white; padding: 24px 30px; display: flex; justify-content: space-between; align-items: center; }
.header h1 { margin: 0; font-size: 20px; font-weight: 700; color: #ff859d; }
table { width: 100%; border-collapse: collapse; }
th, td { padding: 12px 20px; text-align: left; font-size: 13px; border-bottom: 1px solid #f9ece8; }
th { background: #faf3f0; text-transform: uppercase; font-size: 11px; letter-spacing: 0.05em; color: #7a635a; }
.badge { display: inline-block; padding: 4px 10px; border-radius: 99px; font-weight: 700; font-size: 11px; }
.badge-ok { background: #def7ec; color: #03543f; }
.badge-fail { background: #fde8e8; color: #9b1c1c; }
.actions { padding: 20px 30px; background: #faf3f0; border-top: 1px solid #f1dfd8; display: flex; gap: 12px; }
.btn { display: inline-block; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 13px; cursor: pointer; }
.btn-primary { background: #ff2d75; color: white; }
.btn-dark { background: #22140d; color: white; }
pre { background: #1a1a24; color: #a5b4fc; padding: 16px; border-radius: 8px; overflow-x: auto; font-size: 12px; line-height: 1.5; max-height: 350px; }
</style>
</head>
<body>
<div class="card">
    <div class="header">
        <h1>☕ CupDate Live Diagnostic Report</h1>
        <div><?= date('Y-m-d H:i:s') ?></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Check</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $r): ?>
            <tr>
                <td><strong><?= htmlspecialchars($r['name']) ?></strong></td>
                <td>
                    <span class="badge <?= $r['status'] ? 'badge-ok' : 'badge-fail' ?>">
                        <?= $r['status'] ? 'PASSED' : 'ACTION REQUIRED' ?>
                    </span>
                </td>
                <td><?= htmlspecialchars($r['detail']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="padding: 24px 30px;">
        <h3 style="margin-top:0;">📋 Recent Laravel Log:</h3>
        <pre><?= htmlspecialchars($logSnippet) ?></pre>
    </div>

    <div class="actions">
        <a href="?key=cupdate2026&fix_permissions=1" class="btn btn-primary">🛠️ Auto-Fix Storage Permissions & Clear View Cache</a>
        <a href="/" class="btn btn-dark">→ Visit CupDate Home</a>
        <a href="?key=cupdate2026" class="btn" style="background:#e5e7eb;color:#374151;">↻ Re-run Diagnostics</a>
    </div>
</div>
</body>
</html>
