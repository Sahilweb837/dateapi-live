<?php
/**
 * CupDate.in - Live Server Root Forwarder
 * Enables running Laravel seamlessly on cPanel / MilesWeb when the root directory is public_html
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? ''
);

// Serve static assets from public/ if requested directly
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
