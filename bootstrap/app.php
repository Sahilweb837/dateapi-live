<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Production self-healing: ensure .env is populated with production key & DB if missing or empty
$baseDir = dirname(__DIR__);
if (file_exists($baseDir.'/.env.production')) {
    if (!file_exists($baseDir.'/.env')) {
        @copy($baseDir.'/.env.production', $baseDir.'/.env');
    } elseif (!str_contains((string)@file_get_contents($baseDir.'/.env'), 'APP_KEY=base64:')) {
        @copy($baseDir.'/.env.production', $baseDir.'/.env');
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
