<?php
// Setup SQLite schema for local development
$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists(dirname($dbPath))) {
    mkdir(dirname($dbPath), 0777, true);
}

$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Execute Schema
$pdo->exec("
CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  member_code TEXT,
  email TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL,
  full_name TEXT NOT NULL,
  dob DATE NOT NULL,
  gender TEXT NOT NULL DEFAULT 'other',
  preference TEXT NOT NULL DEFAULT 'everyone',
  interested_in TEXT NOT NULL DEFAULT 'everyone',
  bio TEXT,
  avatar TEXT DEFAULT 'assets/images/default_avatar.png',
  lat REAL NOT NULL DEFAULT 28.6139,
  lng REAL NOT NULL DEFAULT 77.2090,
  country TEXT DEFAULT 'India',
  interests TEXT,
  astrology TEXT DEFAULT 'Libra',
  mbti TEXT DEFAULT 'ENFP',
  coffee_style TEXT DEFAULT 'Vanilla Oat Latte',
  google_id TEXT,
  instagram TEXT,
  snapchat TEXT,
  premium_status TEXT NOT NULL DEFAULT 'free',
  premium_until DATETIME,
  is_admin INTEGER DEFAULT 0,
  is_verified INTEGER DEFAULT 0,
  status TEXT NOT NULL DEFAULT 'active',
  coins INTEGER DEFAULT 50,
  xp INTEGER DEFAULT 10,
  is_boosted INTEGER DEFAULT 0,
  boosted_until DATETIME,
  security_pin TEXT,
  last_active DATETIME DEFAULT CURRENT_TIMESTAMP,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS password_reset_tokens (
  email TEXT PRIMARY KEY,
  token TEXT NOT NULL,
  created_at DATETIME
);

CREATE TABLE IF NOT EXISTS messages (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  sender_id INTEGER NOT NULL,
  receiver_id INTEGER NOT NULL,
  message TEXT,
  body TEXT,
  attachment TEXT,
  image_path TEXT,
  is_read INTEGER NOT NULL DEFAULT 0,
  is_call_request INTEGER NOT NULL DEFAULT 0,
  call_status TEXT,
  is_audio INTEGER DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS swipes (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  swiper_id INTEGER NOT NULL,
  swipee_id INTEGER NOT NULL,
  type TEXT NOT NULL DEFAULT 'like',
  direction TEXT NOT NULL DEFAULT 'like',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME,
  UNIQUE(swiper_id, swipee_id)
);

CREATE TABLE IF NOT EXISTS matches (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user1_id INTEGER NOT NULL,
  user2_id INTEGER NOT NULL,
  matched_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  status TEXT NOT NULL DEFAULT 'active',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME,
  UNIQUE(user1_id, user2_id)
);

CREATE TABLE IF NOT EXISTS ideas (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  content TEXT,
  idea_text TEXT,
  cafe_name TEXT DEFAULT 'Cozy Coffee Spot',
  city TEXT DEFAULT 'Shimla',
  vibe TEXT DEFAULT 'Cozy',
  budget TEXT DEFAULT '₹₹',
  image TEXT,
  image_path TEXT,
  sparks INTEGER NOT NULL DEFAULT 0,
  sparks_count INTEGER NOT NULL DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS idea_sparks (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  idea_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(idea_id, user_id)
);

CREATE TABLE IF NOT EXISTS daily_rewards (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  reward_date DATE NOT NULL,
  claimed_date DATE,
  day_streak INTEGER NOT NULL DEFAULT 1,
  streak_count INTEGER NOT NULL DEFAULT 1,
  coins_rewarded INTEGER NOT NULL DEFAULT 10,
  reward_coins INTEGER NOT NULL DEFAULT 10,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME,
  UNIQUE(user_id, reward_date)
);

CREATE TABLE IF NOT EXISTS date_places (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  type TEXT NOT NULL DEFAULT 'Coffee Shop',
  city TEXT DEFAULT 'Shimla',
  description TEXT NOT NULL,
  address TEXT NOT NULL,
  lat REAL NOT NULL DEFAULT 31.1048,
  lng REAL NOT NULL DEFAULT 77.1734,
  rating REAL NOT NULL DEFAULT 4.8,
  cup_offer TEXT DEFAULT '15% Off with CupDate Badge',
  image_url TEXT DEFAULT 'assets/images/default_cafe.jpg',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS blogs (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  slug TEXT UNIQUE NOT NULL,
  title TEXT NOT NULL,
  category TEXT DEFAULT 'Dating Advice',
  excerpt TEXT,
  content TEXT NOT NULL,
  image_icon TEXT DEFAULT 'fa-mug-hot',
  views INTEGER DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS reports (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  reporter_id INTEGER NOT NULL,
  reported_id INTEGER NOT NULL,
  reason TEXT NOT NULL,
  content_snapshot TEXT,
  status TEXT NOT NULL DEFAULT 'pending',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS transactions (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  type TEXT NOT NULL DEFAULT 'coins',
  amount_coins INTEGER NOT NULL DEFAULT 0,
  description TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS contact_messages (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  subject TEXT NOT NULL,
  category TEXT NOT NULL DEFAULT 'general',
  message TEXT NOT NULL,
  status TEXT NOT NULL DEFAULT 'new',
  ip_address TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS page_views (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  ip_address TEXT NOT NULL,
  url TEXT NOT NULL,
  route_name TEXT,
  method TEXT DEFAULT 'GET',
  user_agent TEXT,
  referer TEXT,
  user_id INTEGER,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS sessions (
  id TEXT PRIMARY KEY,
  user_id INTEGER,
  ip_address TEXT,
  user_agent TEXT,
  payload TEXT NOT NULL,
  last_activity INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS cache (
  key TEXT PRIMARY KEY,
  value TEXT NOT NULL,
  expiration INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS cache_locks (
  key TEXT PRIMARY KEY,
  owner TEXT NOT NULL,
  expiration INTEGER NOT NULL
);
");

// Insert Admin & Demo Users
$pwdAdmin123 = password_hash('admin123', PASSWORD_BCRYPT);
$pwdSahil = password_hash('sahilsandhu', PASSWORD_BCRYPT);
$pwdUsers = password_hash('secret123', PASSWORD_BCRYPT);

$pdo->exec("
INSERT OR IGNORE INTO users (id, member_code, email, password, full_name, dob, gender, preference, interested_in, bio, avatar, country, interests, astrology, mbti, coffee_style, is_verified, is_admin, coins, xp, status, created_at) VALUES
(100, 'CD-00001', 'sahilsandhu@cupdate.in', '$pwdSahil', 'Sahil Sandhu', '1995-01-01', 'male', 'everyone', 'everyone', 'Head of Engineering & Community Moderation Lead for CupDate.', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80&fit=crop', 'Kangra / Delhi, India', 'Coffee, Cybersecurity, Engineering, Mountains', 'Aquarius', 'INTJ', 'Double Ristretto', 1, 1, 9999, 9999, 'active', datetime('now')),
(101, 'CD-00002', 'admin@cupdate.in', '$pwdAdmin123', 'CupDate Administrator', '1995-01-01', 'other', 'everyone', 'everyone', 'System Administrator & Trust Moderation Lead for CupDate.', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80&fit=crop', 'Delhi, India', 'Moderation, Cyber Security, Coffee, Technology', 'Aquarius', 'INTJ', 'Double Ristretto', 1, 1, 9999, 9999, 'active', datetime('now')),
(1, 'CD-10001', 'priya.mehta.cupdate@gmail.com', '$pwdUsers', 'Priya Mehta', '1999-05-14', 'female', 'men', 'men', 'Specialty coffee enthusiast, amateur film photographer, and indie acoustic fan. Let us explore Wake & Bake! ☕📸', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80&fit=crop&crop=face', 'Shimla, Himachal Pradesh', 'Coffee, Books, Photography, Vinyl Records', 'Taurus', 'ENFP', 'Vanilla Oat Milk Latte', 1, 0, 150, 80, 'active', datetime('now')),
(2, 'CD-10002', 'arjun.kapoor.cupdate@gmail.com', '$pwdUsers', 'Arjun Kapoor', '1997-11-20', 'male', 'women', 'women', 'Architect by day, espresso aficionado by night. Always looking for cozy cafes with mountain views. ☕', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80&fit=crop&crop=face', 'Pune, Maharashtra', 'Architecture, Espresso, Hiking, Jazz', 'Scorpio', 'INTJ', 'Double Espresso Macchiato', 1, 0, 100, 45, 'active', datetime('now')),
(3, 'CD-10003', 'tanya.sharma.cupdate@gmail.com', '$pwdUsers', 'Tanya Sharma', '1998-08-22', 'female', 'women', 'women', 'Born in Shimla, lover of cedar trails, hot cappuccinos at Cafe Simla Times, and soulful poetry. ☕🏔️', 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&q=80&fit=crop&crop=face', 'Shimla, Himachal Pradesh', 'Trekking, Specialty Coffee, Poetry, Himalayas', 'Virgo', 'INFJ', 'Cinnamon Honey Latte', 1, 0, 200, 110, 'active', datetime('now')),
(4, 'CD-10004', 'vikram.thakur.cupdate@gmail.com', '$pwdUsers', 'Vikram Thakur', '1996-03-12', 'male', 'everyone', 'everyone', 'Old Manali local, backcountry snowboarder, and French roast barista. Let us grab an outdoor table at Cafe 1947 by the river. ☕🏂', 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&q=80&fit=crop&crop=face', 'Manali, Himachal Pradesh', 'Snowboarding, Pour-overs, Indie Rock, Camping', 'Aries', 'ENFP', 'French Press Dark Roast', 1, 0, 120, 60, 'active', datetime('now')),
(5, 'CD-10005', 'zoya.khan.cupdate@gmail.com', '$pwdUsers', 'Zoya Khan', '2000-02-18', 'female', 'women', 'women', 'Designer & queer artist in Mumbai. Loves cozy rooftop cafes, cats, and single origin pour-overs.', 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&q=80&fit=crop&crop=face', 'Mumbai, Maharashtra', 'Art, Queer Culture, Coffee, Indie Pop', 'Pisces', 'INFP', 'Iced Spanish Latte', 1, 0, 300, 120, 'active', datetime('now')),
(6, 'CD-10006', 'rohan.verma.cupdate@gmail.com', '$pwdUsers', 'Rohan Verma', '1997-09-05', 'male', 'men', 'men', 'Tech lead in Bangalore, gay traveler, love craft beer and third-wave espresso. Let’s connect at Araku!', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&q=80&fit=crop&crop=face', 'Bangalore, Karnataka', 'Coding, LGBTQ+ Rights, Gym, Filter Coffee', 'Virgo', 'ENTJ', 'Cortado', 1, 0, 240, 95, 'active', datetime('now')),
(7, 'CD-10007', 'maya.sen.cupdate@gmail.com', '$pwdUsers', 'Maya Sen (she/they)', '1998-12-10', 'nonbinary', 'everyone', 'everyone', 'Transgender writer & community organizer. Big believer in soft slow dates, good books, and hot matcha lattes.', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&q=80&fit=crop&crop=face', 'Delhi NCR', 'Writing, LGBTQ+ Activism, Matcha, Cinema', 'Sagittarius', 'ENFJ', 'Oat Matcha Latte', 1, 0, 400, 150, 'active', datetime('now'))
;

-- Insert Cafes / Date Places
INSERT OR IGNORE INTO date_places (id, name, type, city, description, address, lat, lng, rating, cup_offer, image_url) VALUES
(1, 'Wake & Bake Cafe', 'Rooftop Mountain Cafe', 'Shimla', 'Iconic yellow window overlooking the historic Mall Road. Serves artisan pour-overs, hand-tossed crepes, and warm apple pie with pine forest views.', 'The Mall, Near Town Hall, Shimla, Himachal Pradesh', 31.1048, 77.1734, 4.9, '15% Off Total Bill', 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80&fit=crop'),
(2, 'Cafe Simla Times', 'Heritage Boutique Cafe', 'Shimla', 'Artistic murals, outdoor terrace, and handcrafted cappuccinos. Enjoy crisp mountain air and live acoustic indie performances.', 'The Mall Road, Near Hotel Willow Banks, Shimla, Himachal Pradesh', 31.1030, 77.1740, 4.8, 'Free Chocolate Truffle with 2 Coffees', 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600&q=80&fit=crop'),
(3, 'Cafe 1947', 'Riverside Alpine Cafe', 'Manali', 'Historic riverside cafe perched right along the rushing Manalsu river in Old Manali. Famous for wood-fired pizzas and espresso.', 'Old Manali, Near Bridge, Manali, Himachal Pradesh', 32.2530, 77.1750, 4.9, '15% Off Artisanal Roast Set', 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?w=600&q=80&fit=crop'),
(4, 'The Lazy Dog Lounge', 'Bohemian River Cafe', 'Manali', 'Rustic wooden deck overlooking the river. Cozy beanbags, fresh mountain brews, and quiet conversation corners.', 'Manu Temple Road, Old Manali, Himachal Pradesh', 32.2560, 77.1720, 4.7, 'Free Double Shot Espresso Upgrade', 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&q=80&fit=crop'),
(5, 'Illiterati Books & Coffee', 'Literary Mountain Cafe', 'Dharamshala', 'Balcony seating overlooking the Kangra Valley. Thousands of curated books, authentic Italian roast espresso, and quiet fireplace ambience.', 'Jogiwara Road, McLeod Ganj, Dharamshala, Himachal Pradesh', 32.2350, 76.3260, 4.9, 'Free Artisanal Cookie on Coffee Date', 'https://images.unsplash.com/photo-1445116572660-236099ec97a0?w=600&q=80&fit=crop'),
(6, 'Cafe Rudra', 'Cozy Hilltop Cafe', 'Kasauli', 'Charming hill-station cafe famous for acoustic guitar jams, herbal teas, and hazelnut lattes away from tourist traffic.', 'Heritage Market, Mall Road, Kasauli, Himachal Pradesh', 30.9013, 76.9649, 4.7, '10% Off CupDate Members', 'https://images.unsplash.com/photo-1521017432531-fbd92d768814?w=600&q=80&fit=crop'),
(7, 'Subko Coffee Roasters & Bakehouse', 'Artisanal Roastery', 'Mumbai', 'Vintage converted heritage home serving single-origin Indian arabica and craft pastries in Bandra.', 'Chapel Road, Bandra West, Mumbai', 19.0558, 72.8295, 4.9, 'Free Signature Cold Brew on Date', 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80&fit=crop'),
(8, 'Araku Coffee Landmark', 'Luxury Coffee Lounge', 'Bangalore', 'World-class regenerative micro-lot coffees with award-winning ambient architecture.', '12th Main Road, Indiranagar, Bangalore', 12.9719, 77.6412, 4.9, '20% Off Artisanal Tasting Set', 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=600&q=80&fit=crop'),
(9, 'Blue Tokai Coffee Roasters', 'Specialty Cafe', 'Delhi NCR', 'Intimate string-lit patio offering rich pour overs, cold brews, and peaceful date corners in Saidulajab.', 'Lane 3, Saidulajab, Saket, New Delhi', 28.5186, 77.2023, 4.8, 'Buy 1 Get 1 on Handcrafted Drinks', 'https://images.unsplash.com/photo-1507133750040-4a8f57021571?w=600&q=80&fit=crop'),
(10, 'Blue Tokai Coffee Roasters', 'Specialty Cafe', 'Pune', 'Cozy botanical courtyard with artisan pour-overs and organic sourdough in Koregaon Park.', 'North Main Road, Koregaon Park, Pune', 18.5362, 73.8938, 4.8, '15% Off Total Bill', 'https://images.unsplash.com/photo-1498804103079-a6351b050096?w=600&q=80&fit=crop')
;

-- Insert Community Ideas
INSERT OR IGNORE INTO ideas (id, user_id, content, cafe_name, city, vibe, budget, sparks_count, created_at) VALUES
(1, 1, 'Sunday morning pour-over and reading poetry on the balcony overlooking the valley. Who is in?', 'Wake & Bake Cafe', 'Shimla', 'Cozy', '₹₹', 24, datetime('now')),
(2, 2, 'Evening architectural walk through Koregaon Park followed by cortados and sourdough.', 'Blue Tokai', 'Pune', 'Artistic', '₹₹', 18, datetime('now')),
(3, 4, 'Riverside table, sound of the water, hot wood-fired Margherita pizza and double espresso.', 'Cafe 1947', 'Manali', 'Adventurous', '₹₹₹', 42, datetime('now')),
(4, 5, 'Late afternoon vinyl listening session + iced oat latte. Welcoming cute queer folks and allies!', 'Subko Coffee', 'Mumbai', 'Creative', '₹₹', 37, datetime('now'))
;

-- Insert Sample Blogs
INSERT OR IGNORE INTO blogs (id, slug, title, category, excerpt, content, image_icon, views, created_at) VALUES
(1, 'ultimate-coffee-dating-etiquette-2026', 'Ultimate Coffee Dating Etiquette Guide (2026)', 'Dating Advice', 'The complete handbook on navigating first dates over specialty coffee: who pays, how long to stay, and conversational green flags.', 'Coffee dates have rapidly evolved into the preferred first encounter for modern dating. A 45-minute specialty pour-over provides a warm, low-pressure setting where genuine chemistry can unfold naturally.', 'fa-mug-hot', 1420, datetime('now')),
(2, 'dating-safety-guide-2026', 'CupDate Dating Safety & Inclusivity Guide', 'Safety & Trust', 'Essential security protocols, location sharing, verification badges, and reporting mechanisms for peace of mind.', 'At CupDate, member safety and inclusivity are our foundational design principles. Meet in vetted public cafes and verify profiles.', 'fa-shield-halved', 2180, datetime('now')),
(3, 'mountain-romance-cafe-guide', 'The Mountain Romance Guide: Coffee Dates in Shimla & Manali', 'Travel & Dates', 'Discover quiet colonial verandas in Shimla, riverside patios in Old Manali, and literary retreats in McLeodGanj.', 'There is something uniquely magical about sharing hot espresso overlooking snow-dusted Himalayan peaks.', 'fa-mountain', 950, datetime('now'))
;

-- Seed initial page views for analytics
INSERT OR IGNORE INTO page_views (ip_address, url, route_name, method, user_agent, created_at) VALUES
('127.0.0.1', '/', 'home', 'GET', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0', datetime('now')),
('192.168.1.42', '/', 'home', 'GET', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0) Mobile/15E148 Safari/604.1', datetime('now', '-5 minutes')),
('192.168.1.88', '/dates', 'dates', 'GET', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0', datetime('now', '-10 minutes')),
('10.0.0.15', '/swipes', 'swipes', 'GET', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) Safari/537.36', datetime('now', '-2 minutes')),
('172.16.0.4', '/feed', 'feed', 'GET', 'Mozilla/5.0 (Linux; Android 14) Chrome/120.0 Mobile', datetime('now', '-1 minute'))
;
");

echo "SQLite Database created and seeded successfully!\n";
