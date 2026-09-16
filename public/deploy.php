<?php
/**
 * CupDate Emergency Self-Update Script
 * URL: https://cupdate.in/deploy.php?key=cupdate_secure_init_2026
 * 
 * Downloads latest files from GitHub and applies them directly on the server.
 * No SSH or git pull required.
 */

define('SECRET_KEY', 'cupdate_secure_init_2026');
define('GITHUB_REPO', 'Sahilweb837/dateapi-live');
define('GITHUB_BRANCH', 'main');

if (($_GET['key'] ?? '') !== SECRET_KEY) {
    http_response_code(403);
    die('<h2 style="font-family:sans-serif;color:red;">403 Unauthorized</h2>');
}

// Files to update from GitHub
$filesToUpdate = [
    'app/Http/Controllers/AuthController.php',
    'app/Http/Controllers/HomeController.php',
    'bootstrap/app.php',
    'resources/views/layouts/app.blade.php',
    'resources/views/auth/login.blade.php',
    'resources/views/profile.blade.php',
    'routes/web.php',
];

$baseDir  = __DIR__;
$apiBase  = "https://raw.githubusercontent.com/" . GITHUB_REPO . "/" . GITHUB_BRANCH . "/";
$results  = [];
$updated  = 0;
$failed   = 0;

// Step 0: Fix DB_HOST first
$envPath  = $baseDir . '/../.env';
$prodPath = $baseDir . '/../.env.production';

if (file_exists($prodPath)) {
    @copy($prodPath, $envPath);
    $results[] = ['status' => 'ok', 'file' => '.env', 'msg' => 'Copied from .env.production'];
}

if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    if (strpos($envContent, 'DB_HOST=127.0.0.1') !== false) {
        $patched = str_replace('DB_HOST=127.0.0.1', 'DB_HOST=localhost', $envContent);
        file_put_contents($envPath, $patched);
        $results[] = ['status' => 'ok', 'file' => '.env', 'msg' => 'Patched DB_HOST → localhost'];
    }
}

// Clear config cache
$cacheFile = $baseDir . '/../bootstrap/cache/config.php';
if (file_exists($cacheFile)) {
    @unlink($cacheFile);
    $results[] = ['status' => 'ok', 'file' => 'bootstrap/cache/config.php', 'msg' => 'Config cache cleared'];
}

// Clear view cache
$viewCacheDir = $baseDir . '/../storage/framework/views/';
if (is_dir($viewCacheDir)) {
    $cached = glob($viewCacheDir . '*.php');
    foreach ($cached as $f) { @unlink($f); }
    $results[] = ['status' => 'ok', 'file' => 'storage/framework/views/', 'msg' => 'View cache cleared (' . count($cached) . ' files)'];
}

// Step 1: Download each file from GitHub
foreach ($filesToUpdate as $relPath) {
    $url      = $apiBase . $relPath;
    $destPath = $baseDir . '/../' . $relPath;
    $destDir  = dirname($destPath);

    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }

    $ctx  = stream_context_create(['http' => ['timeout' => 15, 'user_agent' => 'CupDate-Deploy/1.0']]);
    $body = @file_get_contents($url, false, $ctx);

    if ($body === false || strlen($body) < 10) {
        $results[] = ['status' => 'fail', 'file' => $relPath, 'msg' => 'Download failed from GitHub'];
        $failed++;
        continue;
    }

    if (@file_put_contents($destPath, $body) === false) {
        $results[] = ['status' => 'fail', 'file' => $relPath, 'msg' => 'Write failed (permissions?)'];
        $failed++;
        continue;
    }

    $results[] = ['status' => 'ok', 'file' => $relPath, 'msg' => 'Updated (' . number_format(strlen($body)) . ' bytes)'];
    $updated++;
}

// Step 2: Ensure storage permissions
$dirs = [
    '../storage/framework/sessions',
    '../storage/framework/cache/data',
    '../storage/framework/views',
    '../storage/logs',
];
foreach ($dirs as $d) {
    $path = $baseDir . '/' . $d;
    if (!is_dir($path)) mkdir($path, 0777, true);
    @chmod($path, 0777);
}
$results[] = ['status' => 'ok', 'file' => 'storage/', 'msg' => 'Storage permissions set to 777'];

// Test DB connection
$dbStatus = '?';
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cupamate1_backenlaraveldate', 'cupamate1_backendlaraveldate2s', 'a0}A6(k7R#N=');
    $cnt = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    $dbStatus = "✅ Connected! Users: {$cnt}";
} catch (Throwable $e) {
    $dbStatus = "❌ " . $e->getMessage();
}

// Output HTML report
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<title>CupDate Deploy Report</title>
<style>
body { font-family: -apple-system, sans-serif; background: #f8f5f3; padding: 30px; color: #231a15; }
h1 { color: #d65b6c; margin-bottom: 4px; }
.subtitle { color: #81756f; margin-bottom: 24px; }
table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
th { background: #271811; color: white; padding: 10px 14px; text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
td { padding: 10px 14px; font-size: 13px; border-bottom: 1px solid #f1dfd8; }
tr:last-child td { border-bottom: none; }
.ok { color: #059669; font-weight: 600; }
.fail { color: #dc2626; font-weight: 600; }
.summary { margin-top: 20px; padding: 16px 20px; background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
.db { margin-top: 12px; padding: 12px 16px; background: #fff8f6; border: 1px solid #f1dfd8; border-radius: 8px; font-family: monospace; font-size: 13px; }
.refresh { display: inline-block; margin-top: 16px; padding: 10px 20px; background: #d65b6c; color: white; border-radius: 99px; text-decoration: none; font-weight: 600; font-size: 14px; }
</style>
</head>
<body>
<h1>☕ CupDate Deploy Report</h1>
<p class="subtitle"><?= date('Y-m-d H:i:s') ?> · <?= $updated ?> updated · <?= $failed ?> failed</p>

<table>
<thead><tr><th>Status</th><th>File</th><th>Message</th></tr></thead>
<tbody>
<?php foreach ($results as $r): ?>
<tr>
  <td class="<?= $r['status'] === 'ok' ? 'ok' : 'fail' ?>"><?= $r['status'] === 'ok' ? '✅ OK' : '❌ FAIL' ?></td>
  <td><code><?= htmlspecialchars($r['file']) ?></code></td>
  <td><?= htmlspecialchars($r['msg']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="summary">
  <strong>Database:</strong>
  <div class="db"><?= htmlspecialchars($dbStatus) ?></div>
</div>

<br>
<a href="https://cupdate.in" class="refresh">→ Visit CupDate.in</a>
<a href="/deploy.php?key=<?= SECRET_KEY ?>" class="refresh" style="background:#271811; margin-left: 8px;">↻ Run Again</a>
</body>
</html>
