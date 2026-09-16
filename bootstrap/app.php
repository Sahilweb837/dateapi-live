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

// Sync .env from .env.production if .env is absent or missing credentials
if (file_exists($baseDir.'/.env.production')) {
    if (!file_exists($baseDir.'/.env')) {
        @copy($baseDir.'/.env.production', $baseDir.'/.env');
    } else {
        $envContent = (string)@file_get_contents($baseDir.'/.env');
        if (!str_contains($envContent, 'cupamate1_backendlaraveldate2s') || !str_contains($envContent, 'APP_KEY=base64:')) {
            @copy($baseDir.'/.env.production', $baseDir.'/.env');
        }
    }
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
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
