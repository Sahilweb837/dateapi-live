<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('db:safe-import', function () {
    $sqlPath = base_path('safe.sql');
    if (!file_exists($sqlPath)) {
        $this->error("safe.sql not found at {$sqlPath}");
        return 1;
    }
    $this->info("Importing safe.sql schema and seed data into database...");
    \Illuminate\Support\Facades\DB::unprepared(file_get_contents($sqlPath));
    $this->info("safe.sql successfully imported!");
    return 0;
})->purpose('Import the safe.sql schema and initial seed data into the connected database');
