<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Production self-healing: ensure environment, directories, and cache are healthy
$baseDir = dirname(__DIR__);

// Auto-clean stale config cache so new credentials and key are always picked up
if (file_exists($baseDir.'/bootstrap/cache/config.php')) {
    @unlink($baseDir.'/bootstrap/cache/config.php');
}

// Auto-create and set permissions on essential storage directories if missing
@mkdir($baseDir.'/storage/framework/views', 0777, true);
@mkdir($baseDir.'/storage/framework/sessions', 0777, true);
@mkdir($baseDir.'/storage/framework/cache/data', 0777, true);
@mkdir($baseDir.'/storage/logs', 0777, true);
@chmod($baseDir.'/storage', 0777);
@chmod($baseDir.'/storage/framework', 0777);
@chmod($baseDir.'/storage/framework/views', 0777);
@chmod($baseDir.'/storage/framework/sessions', 0777);
@chmod($baseDir.'/storage/framework/cache', 0777);
@chmod($baseDir.'/storage/logs', 0777);
@chmod($baseDir.'/bootstrap/cache', 0777);

// Sync .env from .env.production if .env is absent, missing credentials, or has wrong DB_HOST
if (file_exists($baseDir.'/.env.production')) {
    if (!file_exists($baseDir.'/.env')) {
        @copy($baseDir.'/.env.production', $baseDir.'/.env');
    } else {
        $envContent = (string)@file_get_contents($baseDir.'/.env');
        $needsSync = !str_contains($envContent, 'cupamate1_backendlaraveldate2s')
            || !str_contains($envContent, 'APP_KEY=base64:')
            || str_contains($envContent, 'DB_HOST=127.0.0.1');

        if ($needsSync) {
            @copy($baseDir.'/.env.production', $baseDir.'/.env');
        }
    }
}

// Force-patch DB_HOST to localhost if 127.0.0.1 sneaks back in (cPanel shared hosting safety net)
$currentEnv = (string)@file_get_contents($baseDir.'/.env');
if (str_contains($currentEnv, 'DB_HOST=127.0.0.1')) {
    $patched = str_replace('DB_HOST=127.0.0.1', 'DB_HOST=localhost', $currentEnv);
    @file_put_contents($baseDir.'/.env', $patched);
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.cupdate' => \App\Http\Middleware\RequireAuth::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'auth/google',
            'deploy.php',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
