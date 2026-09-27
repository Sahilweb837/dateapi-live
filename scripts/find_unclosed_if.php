<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function checkFile($path) {
    echo "Checking $path ...\n";
    $lines = file($path);
    $stack = [];
    foreach ($lines as $lineNum => $line) {
        if (preg_match_all('/@(if|auth|guest|isset|empty|unless|forelse|foreach)\b/', $line, $matches, PREG_OFFSET_CAPTURE)) {
            foreach ($matches[1] as $m) {
                $stack[] = ['type' => $m[0], 'line' => $lineNum + 1, 'text' => trim($line)];
            }
        }
        if (preg_match_all('/@(endif|endauth|endguest|endisset|endempty|endunless|endforelse|endforeach)\b/', $line, $matches, PREG_OFFSET_CAPTURE)) {
            foreach ($matches[1] as $m) {
                if (!empty($stack)) {
                    array_pop($stack);
                } else {
                    echo "Unexpected " . $m[0] . " on line " . ($lineNum + 1) . "\n";
                }
            }
        }
    }

    if (empty($stack)) {
        echo "No unclosed directives in $path.\n";
    } else {
        echo "UNCLOSED in $path:\n";
        foreach ($stack as $s) {
            echo "Line {$s['line']}: {$s['text']} ({$s['type']})\n";
        }
    }
}

checkFile(__DIR__ . '/../resources/views/layouts/app.blade.php');
checkFile(__DIR__ . '/../resources/views/welcome.blade.php');

echo "\n--- Attempting Blade compile of welcome ---\n";
try {
    $blade = app('blade.compiler');
    $content = file_get_contents(__DIR__ . '/../resources/views/welcome.blade.php');
    $compiled = $blade->compileString($content);
    echo "Compiled welcome length: " . strlen($compiled) . "\n";
    
    // Check syntax of compiled string
    $tmpFile = __DIR__ . '/temp_compiled.php';
    file_put_contents($tmpFile, $compiled);
    $output = shell_exec('php -l ' . escapeshellarg($tmpFile));
    echo "Syntax check welcome: " . $output . "\n";
    @unlink($tmpFile);

    $appContent = file_get_contents(__DIR__ . '/../resources/views/layouts/app.blade.php');
    $appCompiled = $blade->compileString($appContent);
    file_put_contents($tmpFile, $appCompiled);
    $outputApp = shell_exec('php -l ' . escapeshellarg($tmpFile));
    echo "Syntax check app: " . $outputApp . "\n";
    @unlink($tmpFile);
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . " on line " . $e->getLine() . "\n";
}
