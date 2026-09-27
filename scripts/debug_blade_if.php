<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$blade = app('blade.compiler');
$appContent = file_get_contents(__DIR__ . '/../resources/views/layouts/app.blade.php');
$appCompiled = $blade->compileString($appContent);

file_put_contents(__DIR__ . '/app_compiled.php', $appCompiled);

$tokens = token_get_all($appCompiled);
$controlStack = [];

foreach ($tokens as $token) {
    if (is_array($token)) {
        $id = $token[0];
        $text = $token[1];
        $line = $token[2];

        if ($id === T_IF) {
            $controlStack[] = ['type' => 'if', 'line' => $line];
        } elseif ($id === T_ENDIF) {
            $last = end($controlStack);
            if ($last && $last['type'] === 'if') {
                array_pop($controlStack);
            } else {
                echo "Mismatched endif at line $line\n";
            }
        } elseif ($id === T_FOREACH) {
            $controlStack[] = ['type' => 'foreach', 'line' => $line];
        } elseif ($id === T_ENDFOREACH) {
            $last = end($controlStack);
            if ($last && $last['type'] === 'foreach') {
                array_pop($controlStack);
            } else {
                echo "Mismatched endforeach at line $line\n";
            }
        }
    }
}

echo "Remaining unclosed controls:\n";
print_r($controlStack);

// Also look at the lines around the unclosed control
$rawLines = explode("\n", $appContent);
foreach ($controlStack as $c) {
    echo "--- Near line {$c['line']} in app.blade.php ---\n";
    for ($k = max(0, $c['line'] - 4); $k <= min(count($rawLines) - 1, $c['line'] + 4); $k++) {
        echo ($k + 1) . ": " . $rawLines[$k] . "\n";
    }
}
