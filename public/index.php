<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Google Search Console & SEO 301 Redirect: Strip /index.php to canonical root /
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
if (preg_match('#^/index\.php(?:/(.*))?$#i', $requestUri, $matches)) {
    $cleanPath = !empty($matches[1]) ? '/' . $matches[1] : '/';
    $queryString = $_SERVER['QUERY_STRING'] ?? '';
    $redirectUrl = 'https://cupdate.in' . $cleanPath . ($queryString !== '' ? '?' . $queryString : '');
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirectUrl);
    exit;
}

// 2. Ensure .env exists in parent directory (Auto-sync from .env.production on server deploy)
$baseDir = dirname(__DIR__);
if (!file_exists($baseDir . '/.env')) {
    if (file_exists($baseDir . '/.env.production')) {
        @copy($baseDir . '/.env.production', $baseDir . '/.env');
    } elseif (file_exists(dirname($baseDir) . '/.env')) {
        @copy(dirname($baseDir) . '/.env', $baseDir . '/.env');
    }
}

// 3. Fallback environment keys to ensure zero-downtime and zero-crash
if (empty($_ENV['APP_KEY']) && empty($_SERVER['APP_KEY']) && !getenv('APP_KEY')) {
    putenv('APP_KEY=base64:2aBHToHdj9Vy37i1m1+Er06M/Z81HPvc1j2UxOcWYMQ=');
    $_ENV['APP_KEY'] = 'base64:2aBHToHdj9Vy37i1m1+Er06M/Z81HPvc1j2UxOcWYMQ=';
    $_SERVER['APP_KEY'] = 'base64:2aBHToHdj9Vy37i1m1+Er06M/Z81HPvc1j2UxOcWYMQ=';
}

// Enable error reporting if debug is requested or APP_DEBUG=true
if (isset($_GET['debug']) || (file_exists(__DIR__ . '/../.env') && strpos(@file_get_contents(__DIR__ . '/../.env'), 'APP_DEBUG=true') !== false)) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    if (!headers_sent()) {
        http_response_code(500);
    }
    // If debug is on or debug query param present, show actionable diagnostics
    if (ini_get('display_errors') || isset($_GET['debug'])) {
        echo "<!DOCTYPE html><html><head><title>500 Internal Error - CupDate</title><style>body{font-family:-apple-system,sans-serif;background:#fff5f5;padding:30px;color:#2d3748;}h1{color:#e53e3e;font-size:24px;}pre{background:#fff;border:1px solid #feb2b2;padding:16px;border-radius:8px;overflow-x:auto;font-size:13px;line-height:1.5;}</style></head><body>";
        echo "<h1>☕ CupDate Application Boot Error</h1>";
        echo "<p><b>Message:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><b>File:</b> " . htmlspecialchars($e->getFile()) . " (Line " . $e->getLine() . ")</p>";
        echo "<h3>Stack Trace:</h3><pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        echo "</body></html>";
    } else {
        echo "<!DOCTYPE html><html><head><title>500 | Server Error</title></head><body style='font-family:sans-serif;text-align:center;padding:50px;'><h2>500 | Server Error</h2><p>Please try again or contact support at support@cupdate.in</p></body></html>";
    }
}
