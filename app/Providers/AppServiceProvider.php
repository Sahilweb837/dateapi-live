<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->ensureResilientDatabase();
    }

    /**
     * Ensures application always has an active, working database.
     * If MySQL is unreachable (e.g. Access Denied 1045 or server restarting),
     * automatically switches to local SQLite so that Google Login,
     * registration, password login, and public dating pages never fail.
     */
    protected function ensureResilientDatabase(): void
    {
        $mysqlOk = false;
        try {
            DB::connection('mysql')->getPdo();
            $mysqlOk = true;
        } catch (\Throwable $e) {
            $mysqlOk = false;
        }

        if (!$mysqlOk) {
            $sqlitePath = database_path('database.sqlite');
            if (!file_exists($sqlitePath)) {
                @touch($sqlitePath);
            }

            config([
                'database.default' => 'sqlite',
                'database.connections.sqlite.database' => $sqlitePath,
            ]);

            DB::purge('mysql');
            DB::purge('sqlite');
            DB::setDefaultConnection('sqlite');

            $this->initializeSqliteSchema();
        }
    }

    /**
     * Initialize essential tables and seed data in SQLite if not present.
     */
    protected function initializeSqliteSchema(): void
    {
        try {
            $db = DB::connection('sqlite')->getPdo();

            // Users table
            $db->exec("CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                member_code TEXT,
                google_id TEXT,
                email TEXT UNIQUE,
                password TEXT,
                full_name TEXT,
                dob TEXT,
                gender TEXT,
                preference TEXT DEFAULT 'everyone',
                interested_in TEXT DEFAULT 'everyone',
                bio TEXT,
                avatar TEXT,
                country TEXT,
                interests TEXT,
                astrology TEXT,
                mbti TEXT,
                coffee_style TEXT,
                is_verified INTEGER DEFAULT 1,
                is_admin INTEGER DEFAULT 0,
                coins INTEGER DEFAULT 100,
                xp INTEGER DEFAULT 10,
                status TEXT DEFAULT 'active',
                last_active TEXT,
                created_at TEXT,
                updated_at TEXT
            )");

            // Date Places table
            $db->exec("CREATE TABLE IF NOT EXISTS date_places (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT,
                type TEXT,
                city TEXT,
                description TEXT,
                address TEXT,
                lat REAL,
                lng REAL,
                rating REAL,
                cup_offer TEXT,
                created_at TEXT,
                updated_at TEXT
            )");

            // Blogs table
            $db->exec("CREATE TABLE IF NOT EXISTS blogs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                slug TEXT UNIQUE,
                title TEXT,
                category TEXT,
                excerpt TEXT,
                content TEXT,
                image_icon TEXT,
                views INTEGER DEFAULT 0,
                created_at TEXT,
                updated_at TEXT
            )");

            // Ideas table
            $db->exec("CREATE TABLE IF NOT EXISTS ideas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER,
                idea_text TEXT,
                cafe_name TEXT,
                city TEXT,
                sparks INTEGER DEFAULT 0,
                created_at TEXT,
                updated_at TEXT
            )");

            // Swipes table
            $db->exec("CREATE TABLE IF NOT EXISTS swipes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                swiper_id INTEGER,
                swipee_id INTEGER,
                direction TEXT,
                created_at TEXT,
                updated_at TEXT
            )");

            // Matches table
            $db->exec("CREATE TABLE IF NOT EXISTS matches (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user1_id INTEGER,
                user2_id INTEGER,
                matched_at TEXT,
                created_at TEXT,
                updated_at TEXT
            )");

            // Messages table (supports both message/body and attachment/image_path)
            $db->exec("CREATE TABLE IF NOT EXISTS messages (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                sender_id INTEGER,
                receiver_id INTEGER,
                message TEXT,
                body TEXT,
                attachment TEXT,
                image_path TEXT,
                is_read INTEGER DEFAULT 0,
                is_call_request INTEGER DEFAULT 0,
                call_status TEXT,
                created_at TEXT,
                updated_at TEXT
            )");

            // Ensure columns exist if table was previously created
            try { $db->exec("ALTER TABLE messages ADD COLUMN message TEXT"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE messages ADD COLUMN attachment TEXT"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE messages ADD COLUMN body TEXT"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE messages ADD COLUMN image_path TEXT"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE messages ADD COLUMN is_call_request INTEGER DEFAULT 0"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE messages ADD COLUMN call_status TEXT"); } catch (\Throwable $e) {}

            // Daily rewards table (supports both reward_date/claimed_date and day_streak/streak_count)
            $db->exec("CREATE TABLE IF NOT EXISTS daily_rewards (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER,
                reward_date TEXT,
                claimed_date TEXT,
                day_streak INTEGER DEFAULT 1,
                streak_count INTEGER DEFAULT 1,
                coins_rewarded INTEGER DEFAULT 10,
                reward_coins INTEGER DEFAULT 10,
                created_at TEXT,
                updated_at TEXT
            )");

            // Ensure columns exist if table was previously created
            try { $db->exec("ALTER TABLE daily_rewards ADD COLUMN reward_date TEXT"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE daily_rewards ADD COLUMN claimed_date TEXT"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE daily_rewards ADD COLUMN day_streak INTEGER DEFAULT 1"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE daily_rewards ADD COLUMN streak_count INTEGER DEFAULT 1"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE daily_rewards ADD COLUMN coins_rewarded INTEGER DEFAULT 10"); } catch (\Throwable $e) {}
            try { $db->exec("ALTER TABLE daily_rewards ADD COLUMN reward_coins INTEGER DEFAULT 10"); } catch (\Throwable $e) {}

            // Sessions table
            $db->exec("CREATE TABLE IF NOT EXISTS sessions (
                id TEXT PRIMARY KEY,
                user_id INTEGER,
                ip_address TEXT,
                user_agent TEXT,
                payload TEXT,
                last_activity INTEGER
            )");

            // Cache table
            $db->exec("CREATE TABLE IF NOT EXISTS cache (
                key TEXT PRIMARY KEY,
                value TEXT,
                expiration INTEGER
            )");

            // Page Views Analytics table
            $db->exec("CREATE TABLE IF NOT EXISTS page_views (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ip_address TEXT,
                url TEXT,
                route_name TEXT,
                method TEXT DEFAULT 'GET',
                user_agent TEXT,
                referer TEXT,
                user_id INTEGER,
                created_at TEXT
            )");

            // Seed demo singles if users table is empty
            $stmtUsers = $db->query("SELECT COUNT(*) FROM users");
            if ($stmtUsers && $stmtUsers->fetchColumn() == 0) {
                $pwHash = Hash::make('password123');
                $adminPwHash = Hash::make('admin123');
                $now = date('Y-m-d H:i:s');

                $insUser = $db->prepare("INSERT INTO users (member_code, email, password, full_name, dob, gender, bio, country, avatar, is_verified, is_admin, coins, xp, status, created_at, last_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                // Super Admin account (admin / admin123)
                $insUser->execute(['CD-00001', 'admin@cupdate.in', $adminPwHash, 'CupDate Administrator', '1995-01-01', 'other', 'System Administrator & Moderation Lead.', 'Kangra / Delhi, India', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80&fit=crop', 1, 1, 9999, 9999, 'active', $now, $now]);

                $insUser->execute(['CD-10001', 'priya.mehta.cupdate@gmail.com', $pwHash, 'Priya Mehta', '1999-05-14', 'female', 'Bookworm & pour-over addict. Let us explore hidden roasteries in Shimla! ☕📚', 'Shimla, Himachal Pradesh', 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&q=80&fit=crop&crop=face', 1, 0, 150, 80, 'active', $now, $now]);
                
                $insUser->execute(['CD-10002', 'arjun.kapoor.cupdate@gmail.com', $pwHash, 'Arjun Kapoor', '1997-11-20', 'male', 'Architect by day, espresso aficionado by night. Always looking for cozy cafes. ☕', 'Pune, Maharashtra', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80&fit=crop&crop=face', 1, 0, 100, 45, 'active', $now, $now]);

                $insUser->execute(['CD-10003', 'tanya.sharma.cupdate@gmail.com', $pwHash, 'Tanya Sharma', '1998-08-22', 'female', 'Born in Shimla, lover of cedar trails and hot cappuccinos at Cafe Simla Times. ☕🏔️', 'Shimla, Himachal Pradesh', 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&q=80&fit=crop&crop=face', 1, 0, 200, 110, 'active', $now, $now]);

                $insUser->execute(['CD-10004', 'vikram.thakur.cupdate@gmail.com', $pwHash, 'Vikram Thakur', '1996-03-12', 'male', 'Old Manali local, snowboarder & French roast barista. Let us grab a table at Cafe 1947 by the river. ☕🏂', 'Manali, Himachal Pradesh', 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&q=80&fit=crop&crop=face', 1, 0, 120, 60, 'active', $now, $now]);
            }

            // Seed date places if empty
            $stmtPlaces = $db->query("SELECT COUNT(*) FROM date_places");
            if ($stmtPlaces && $stmtPlaces->fetchColumn() == 0) {
                $now = date('Y-m-d H:i:s');
                $insPlace = $db->prepare("INSERT INTO date_places (name, type, city, description, address, lat, lng, rating, cup_offer, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insPlace->execute(['Wake & Bake Cafe', 'Rooftop Mountain Cafe', 'Shimla', 'Artisan pour-overs, hand-tossed crepes, and pine forest views along Mall Road.', 'The Mall, Near Town Hall, Shimla, HP', 31.1048, 77.1734, 4.9, '15% Off Total Bill', $now]);
                $insPlace->execute(['Cafe Simla Times', 'Heritage Boutique Cafe', 'Shimla', 'Artistic murals, outdoor terrace, and handcrafted cappuccinos.', 'The Mall Road, Near Hotel Willow Banks, Shimla, HP', 31.1030, 77.1740, 4.8, 'Free Chocolate Truffle with 2 Coffees', $now]);
                $insPlace->execute(['Cafe 1947', 'Riverside Alpine Cafe', 'Manali', 'Historic riverside cafe perched right along the Manalsu river in Old Manali.', 'Old Manali, Near Bridge, Manali, HP', 32.2530, 77.1750, 4.9, '15% Off Artisanal Roast Set', $now]);
                $insPlace->execute(['Blue Tokai Coffee Roasters', 'Specialty Cafe', 'Pune', 'Cozy botanical courtyard with artisan pour-overs and organic sourdough.', 'Koregaon Park, Pune', 18.5362, 73.8938, 4.8, '15% Off Total Bill', $now]);
            }

            // Seed blogs if empty
            $stmtBlogs = $db->query("SELECT COUNT(*) FROM blogs");
            if ($stmtBlogs && $stmtBlogs->fetchColumn() == 0) {
                $now = date('Y-m-d H:i:s');
                $insBlog = $db->prepare("INSERT INTO blogs (slug, title, category, excerpt, content, image_icon, views, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insBlog->execute(['ultimate-coffee-dating-etiquette-india-2026', 'Ultimate Coffee Dating Etiquette Guide (2026)', 'Dating Advice', 'The complete handbook on navigating first dates over specialty coffee: who pays, how long to stay, and conversational green flags.', 'Coffee dates have rapidly evolved into India\'s preferred first encounter for modern dating...', 'fa-mug-hot', 1420, $now]);
                $insBlog->execute(['women-dating-safety-guide-india', 'Women\'s Dating Safety Guide for India', 'Safety & Trust', 'Essential security protocols, location sharing, verification badges, and reporting mechanisms.', 'At CupDate, women\'s safety is our foundational design principle...', 'fa-shield-halved', 2180, $now]);
                $insBlog->execute(['romantic-coffee-date-guide-himachal-pradesh', 'The Mountain Romance Guide: Coffee Dates in Shimla & Manali', 'Himachal Dating', 'Discover quiet colonial verandas in Shimla, riverside patios in Old Manali, and literary retreats.', 'There is something uniquely magical about sharing hot espresso while overlooking snow-dusted peaks...', 'fa-mountain', 950, $now]);
            }
        } catch (\Throwable $e) {
            Log::warning('SQLite schema initialization warning: ' . $e->getMessage());
        }
    }
}
