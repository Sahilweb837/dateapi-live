<?php
/**
 * CupDate.in - Live Server Root Forwarder
 * Enables running Laravel seamlessly on cPanel / MilesWeb when DocumentRoot is public_html
 */

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

if (isset($_GET['debug'])) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

// 2. Ensure .env exists (Auto-sync from .env.production on zero-downtime deploy servers)
$envPath = __DIR__ . '/.env';
if (!file_exists($envPath)) {
    if (file_exists(__DIR__ . '/.env.production')) {
        @copy(__DIR__ . '/.env.production', $envPath);
    } elseif (file_exists(dirname(__DIR__) . '/.env')) {
        @copy(dirname(__DIR__) . '/.env', $envPath);
    }
}

// 3. Fallback environment variables
if (empty($_ENV['APP_KEY']) && empty($_SERVER['APP_KEY']) && !getenv('APP_KEY')) {
    putenv('APP_KEY=base64:2aBHToHdj9Vy37i1m1+Er06M/Z81HPvc1j2UxOcWYMQ=');
    $_ENV['APP_KEY'] = 'base64:2aBHToHdj9Vy37i1m1+Er06M/Z81HPvc1j2UxOcWYMQ=';
    $_SERVER['APP_KEY'] = 'base64:2aBHToHdj9Vy37i1m1+Er06M/Z81HPvc1j2UxOcWYMQ=';
}

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? ''
);

// If static asset exists in public/, serve it with proper content-type
$publicAsset = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($publicAsset) && !is_dir($publicAsset)) {
    $mimeMap = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'svg'   => 'image/svg+xml',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'webp'  => 'image/webp',
        'ico'   => 'image/x-icon',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'json'  => 'application/json',
        'xml'   => 'text/xml',
        'txt'   => 'text/plain',
    ];
    $ext = strtolower(pathinfo($publicAsset, PATHINFO_EXTENSION));
    if (isset($mimeMap[$ext])) {
        header('Content-Type: ' . $mimeMap[$ext]);
    }
    header('Content-Length: ' . filesize($publicAsset));
    readfile($publicAsset);
    exit;
}

// Forward all application requests to Laravel's front controller
require_once __DIR__ . '/public/index.php';
