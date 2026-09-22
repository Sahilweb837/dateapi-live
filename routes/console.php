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

Artisan::command('admin:credentials', function () {
    $this->info("==========================================");
    $this->info("       CupDate Admin Panel Access         ");
    $this->info("==========================================");
    $this->line("Login URL:     " . url('/admin/login'));
    $this->line("Standard URL:  " . url('/login'));
    $this->line("Preset ID:     admin OR admin@cupdate.in");
    $this->line("Preset Pass:   admin123");
    $this->info("------------------------------------------");

    try {
        $admins = \App\Models\User::where('is_admin', 1)->get();
        if ($admins->isEmpty()) {
            $this->warn("No admin users found in the current active database!");
            $this->line("Run 'php artisan admin:reset' to create one instantly.");
        } else {
            $this->info("Registered Admin Accounts in Active Database (" . config('database.default') . "):");
            foreach ($admins as $admin) {
                $this->line(" • ID: #{$admin->id} | Code: {$admin->member_code} | Email: {$admin->email} | Status: {$admin->status}");
            }
        }
    } catch (\Throwable $e) {
        $this->error("Could not query users: " . $e->getMessage());
    }
    $this->info("==========================================");
})->purpose('Display administrator login portal credentials and active accounts');

Artisan::command('admin:reset {password=admin123} {email=admin@cupdate.in}', function ($password, $email) {
    $email = strtolower(trim($email));
    $password = trim($password);

    try {
        $admin = \App\Models\User::where('is_admin', 1)->orWhere('email', $email)->first();
        if (!$admin) {
            $admin = new \App\Models\User();
            $admin->member_code = 'CD-00001';
            $admin->full_name = 'CupDate Administrator';
            $admin->dob = '1995-01-01';
            $admin->gender = 'other';
            $admin->bio = 'System Administrator & Moderation Lead for CupDate.';
            $admin->country = 'Kangra / Delhi, India';
            $admin->avatar = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80&fit=crop';
            $admin->is_verified = 1;
            $admin->coins = 9999;
            $admin->xp = 9999;
        }

        $admin->email = $email;
        $admin->password = \Illuminate\Support\Facades\Hash::make($password);
        $admin->is_admin = 1;
        $admin->status = 'active';
        $admin->save();

        $this->info("==========================================");
        $this->info("Admin Account Synchronized Successfully!");
        $this->info("==========================================");
        $this->line("Database:  " . config('database.default'));
        $this->line("Login URL: " . url('/admin/login'));
        $this->line("ID:        admin OR {$admin->email}");
        $this->line("Password:  {$password}");
        $this->line("Status:    {$admin->status} (Verified Admin)");
        $this->info("==========================================");
    } catch (\Throwable $e) {
        $this->error("Failed to update admin account: " . $e->getMessage());
        return 1;
    }
    return 0;
})->purpose('Set or reset administrator credentials and ensure admin account exists');

