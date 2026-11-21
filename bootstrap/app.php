<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$baseDir = dirname(__DIR__);

foreach ([
    $baseDir.'/storage/framework/views',
    $baseDir.'/storage/framework/sessions',
    $baseDir.'/storage/framework/cache/data',
    $baseDir.'/storage/logs',
    $baseDir.'/bootstrap/cache',
] as $directory) {
    if (!is_dir($directory)) {
        @mkdir($directory, 0777, true);
    }
    @chmod($directory, 0777);
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\TrackPageView::class,
        ]);
        $middleware->alias([
            'auth.cupdate' => \App\Http\Middleware\RequireAuth::class,
            'admin' => \App\Http\Middleware\EnsureAdmin::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'auth/google',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Database\QueryException $e, $request) {
            try {
                \Illuminate\Support\Facades\Log::warning('Database QueryException: ' . $e->getMessage());
            } catch (\Throwable $logEx) {}

            if (extension_loaded('pdo_sqlite')) {
                try {
                    $sqlitePath = database_path('database.sqlite');
                    if (!file_exists($sqlitePath)) { @touch($sqlitePath); @chmod($sqlitePath, 0666); }
                    config([
                        'database.default' => 'sqlite',
                        'database.connections.sqlite.database' => $sqlitePath,
                    ]);
                    \Illuminate\Support\Facades\DB::purge();
                    \Illuminate\Support\Facades\DB::setDefaultConnection('sqlite');
                } catch (\Throwable $sqEx) {}
            }

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['success' => true, 'fallback' => true]);
            }

            if ($request->is('auth/*') || $request->is('login*') || $request->is('register*')) {
                return redirect()->route('login');
            }

            return null;
        });

        $exceptions->render(function (\PDOException $e, $request) {
            try {
                \Illuminate\Support\Facades\Log::warning('Database PDOException: ' . $e->getMessage());
            } catch (\Throwable $logEx) {}

            if (extension_loaded('pdo_sqlite')) {
                try {
                    $sqlitePath = database_path('database.sqlite');
                    if (!file_exists($sqlitePath)) { @touch($sqlitePath); @chmod($sqlitePath, 0666); }
                    config([
                        'database.default' => 'sqlite',
                        'database.connections.sqlite.database' => $sqlitePath,
                    ]);
                    \Illuminate\Support\Facades\DB::purge();
                    \Illuminate\Support\Facades\DB::setDefaultConnection('sqlite');
                } catch (\Throwable $sqEx) {}
            }

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['success' => true, 'fallback' => true]);
            }

            if ($request->is('auth/*') || $request->is('login*') || $request->is('register*')) {
                return redirect()->route('login');
            }

            return null;
        });
    })->create();
