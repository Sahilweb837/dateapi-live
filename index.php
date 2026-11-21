<?php
/**
 * CupDate.in - Live Server Root Forwarder
 * Enables running Laravel seamlessly on cPanel / MilesWeb when DocumentRoot is public_html
 */

if (isset($_GET['debug'])) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
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
