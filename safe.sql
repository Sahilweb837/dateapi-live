-- ==============================================================================
-- CupDate.in - Standalone Production-Ready Database Schema (safe.sql)
-- Database Target: `cupamate1_backenlaraveldate`
-- User Target: `backendlaraveldate2s`
-- Complete schema for users, messages, swipes, matches, blogs, date spots & rewards
-- Compatible with MySQL 5.7+, MySQL 8.0+, MariaDB 10.3+
-- ==============================================================================

-- ------------------------------------------------------------------------------
-- DIRECT CPANEL / PHPMYADMIN NOTICE:
-- If you are importing directly into an already selected database in phpMyAdmin,
-- you may safely keep or remove the CREATE DATABASE line below.
-- ------------------------------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `cupamate1_backenlaraveldate` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

USE `cupamate1_backenlaraveldate`;

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- 1. Table: users (Core Dating Profiles & Verification)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `member_code` VARCHAR(20) DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(100) NOT NULL,
  `dob` DATE NOT NULL,
  `gender` ENUM('male','female','nonbinary','other') NOT NULL DEFAULT 'other',
  `preference` VARCHAR(50) NOT NULL DEFAULT 'everyone',
  `interested_in` VARCHAR(50) NOT NULL DEFAULT 'everyone',
  `bio` TEXT DEFAULT NULL,
  `avatar` VARCHAR(255) DEFAULT 'assets/images/default_avatar.png',
  `lat` DECIMAL(10,8) NOT NULL DEFAULT 28.61390000,
  `lng` DECIMAL(11,8) NOT NULL DEFAULT 77.20900000,
  `country` VARCHAR(100) DEFAULT 'India',
  `interests` TEXT DEFAULT NULL,
  `astrology` VARCHAR(50) DEFAULT 'Libra',
  `mbti` VARCHAR(10) DEFAULT 'ENFP',
  `coffee_style` VARCHAR(100) DEFAULT 'Vanilla Oat Latte',
  `google_id` VARCHAR(100) DEFAULT NULL,
  `instagram` VARCHAR(100) DEFAULT NULL,
  `snapchat` VARCHAR(100) DEFAULT NULL,
  `premium_status` VARCHAR(50) NOT NULL DEFAULT 'free',
  `premium_until` DATETIME DEFAULT NULL,
  `is_admin` TINYINT(1) DEFAULT 0,
  `is_verified` TINYINT(1) DEFAULT 0,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `coins` INT(11) DEFAULT 50,
  `xp` INT(11) DEFAULT 10,
  `is_boosted` TINYINT(1) DEFAULT 0,
  `boosted_until` DATETIME DEFAULT NULL,
  `security_pin` VARCHAR(10) DEFAULT NULL,
  `last_active` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_users_email` (`email`),
  KEY `idx_users_status` (`status`),
  KEY `idx_users_gender` (`gender`),
  KEY `idx_users_boosted` (`is_boosted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `member_code` VARCHAR(20) DEFAULT NULL;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `google_id` VARCHAR(100) DEFAULT NULL;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `coffee_style` VARCHAR(100) DEFAULT 'Vanilla Oat Latte';
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `is_boosted` TINYINT(1) DEFAULT 0;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `boosted_until` DATETIME DEFAULT NULL;

-- --------------------------------------------------------
-- 2. Table: messages (Clean 1-on-1 Chat Messages + Attachments)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `sender_id` INT(11) NOT NULL,
  `receiver_id` INT(11) NOT NULL,
  `message` TEXT NOT NULL,
  `attachment` VARCHAR(255) DEFAULT NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_msg_sender` (`sender_id`),
  KEY `idx_msg_receiver` (`receiver_id`),
  KEY `idx_msg_conv` (`sender_id`, `receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `messages` ADD COLUMN IF NOT EXISTS `attachment` VARCHAR(255) DEFAULT NULL;

-- --------------------------------------------------------
-- 3. Table: swipes (Like, Dislike, Superlike Deck Actions)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `swipes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `swiper_id` INT(11) NOT NULL,
  `swipee_id` INT(11) NOT NULL,
  `type` ENUM('like','dislike','superlike') NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_swipe_pair` (`swiper_id`, `swipee_id`),
  KEY `idx_swipe_swipee` (`swipee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 4. Table: matches (Mutual Likes & Connections)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `matches` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user1_id` INT(11) NOT NULL,
  `user2_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_match_pair` (`user1_id`, `user2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 5. Table: ideas (Community Coffee Date Pitches + Photo)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ideas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `content` TEXT NOT NULL,
  `cafe_name` VARCHAR(100) DEFAULT 'Cozy Coffee Spot',
  `city` VARCHAR(50) DEFAULT 'India',
  `image` VARCHAR(255) DEFAULT NULL,
  `sparks_count` INT(11) DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_ideas_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `ideas` ADD COLUMN IF NOT EXISTS `image` VARCHAR(255) DEFAULT NULL;

-- --------------------------------------------------------
-- 6. Table: idea_sparks (Track user sparks/likes on ideas)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `idea_sparks` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `idea_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_spark_unique` (`idea_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 7. Table: daily_rewards (7-Day Login Coin Streak Tracker)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `daily_rewards` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `reward_date` DATE NOT NULL,
  `day_streak` INT(11) NOT NULL DEFAULT 1,
  `coins_rewarded` INT(11) NOT NULL DEFAULT 10,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_reward_day` (`user_id`, `reward_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 8. Table: date_places (Curated Landmark Coffee Date Spots)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `date_places` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `type` VARCHAR(50) NOT NULL DEFAULT 'Coffee Shop',
  `city` VARCHAR(50) DEFAULT 'Pune',
  `description` TEXT NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `lat` DECIMAL(10,8) NOT NULL DEFAULT 28.61390000,
  `lng` DECIMAL(11,8) NOT NULL DEFAULT 77.20900000,
  `rating` DECIMAL(3,1) NOT NULL DEFAULT 4.5,
  `cup_offer` VARCHAR(100) DEFAULT '15% Off with CupDate Badge',
  `image_url` VARCHAR(255) DEFAULT 'assets/images/default_cafe.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `date_places` ADD COLUMN IF NOT EXISTS `city` VARCHAR(50) DEFAULT 'Pune';
ALTER TABLE `date_places` ADD COLUMN IF NOT EXISTS `cup_offer` VARCHAR(100) DEFAULT '15% Off with CupDate Badge';

-- --------------------------------------------------------
-- 9. Table: blogs (Editorial Guides & Auto-Slug Engine)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `category` VARCHAR(100) DEFAULT 'Dating Advice',
  `excerpt` TEXT DEFAULT NULL,
  `content` LONGTEXT NOT NULL,
  `image_icon` VARCHAR(50) DEFAULT 'fa-mug-hot',
  `views` INT(11) DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_blogs_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 10. Table: reports (Moderation & Safety Center)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `reports` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `reporter_id` INT(11) NOT NULL,
  `reported_id` INT(11) NOT NULL,
  `reason` VARCHAR(255) NOT NULL,
  `content_snapshot` TEXT DEFAULT NULL,
  `status` ENUM('pending','resolved','dismissed') NOT NULL DEFAULT 'pending',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_reports_reported` (`reported_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 11. Table: transactions (Coin & Boost Economy Audit)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `amount_coins` INT(11) NOT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_tx_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 12. Table: contact_messages (Grievance & Support Inquiries)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `subject` VARCHAR(180) NOT NULL,
  `category` VARCHAR(80) NOT NULL DEFAULT 'general',
  `message` TEXT NOT NULL,
  `status` ENUM('new','read','replied','closed') NOT NULL DEFAULT 'new',
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_contact_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- SEED DATA: Curated Cafe Spots (Himachal Pradesh & Metros)
-- --------------------------------------------------------
INSERT INTO `date_places` (`name`, `type`, `city`, `description`, `address`, `lat`, `lng`, `rating`, `cup_offer`) VALUES
('Wake & Bake Cafe', 'Rooftop Mountain Cafe', 'Shimla', 'Iconic yellow window overlooking the historic Mall Road. Serves artisan pour-overs, hand-tossed crepes, and warm apple pie with pine forest views.', 'The Mall, Near Town Hall, Shimla, Himachal Pradesh', 31.10480000, 77.17340000, 4.9, '15% Off Total Bill'),
('Cafe Simla Times', 'Heritage Boutique Cafe', 'Shimla', 'Artistic murals, outdoor terrace, and handcrafted cappuccinos. Enjoy crisp mountain air and live acoustic indie performances.', 'The Mall Road, Near Hotel Willow Banks, Shimla, Himachal Pradesh', 31.10300000, 77.17400000, 4.8, 'Free Chocolate Truffle with 2 Coffees'),
('Cafe 1947', 'Riverside Alpine Cafe', 'Manali', 'Historic riverside cafe perched right along the rushing Manalsu river in Old Manali. Famous for wood-fired pizzas and espresso.', 'Old Manali, Near Bridge, Manali, Himachal Pradesh', 32.25300000, 77.17500000, 4.9, '15% Off Artisanal Roast Set'),
('The Lazy Dog Lounge', 'Bohemian River Cafe', 'Manali', 'Rustic wooden deck overlooking the river. Cozy beanbags, fresh mountain brews, and quiet conversation corners.', 'Manu Temple Road, Old Manali, Himachal Pradesh', 32.25600000, 77.17200000, 4.7, 'Free Double Shot Espresso Upgrade'),
('Illiterati Books & Coffee', 'Literary Mountain Cafe', 'Dharamshala', 'Balcony seating overlooking the Kangra Valley. Thousands of curated books, authentic Italian roast espresso, and quiet fireplace ambience.', 'Jogiwara Road, McLeod Ganj, Dharamshala, Himachal Pradesh', 32.23500000, 76.32600000, 4.9, 'Free Artisanal Cookie on Coffee Date'),
('Cafe Rudra', 'Cozy Hilltop Cafe', 'Kasauli', 'Charming hill-station cafe famous for acoustic guitar jams, herbal teas, and hazelnut lattes away from tourist traffic.', 'Heritage Market, Mall Road, Kasauli, Himachal Pradesh', 30.90130000, 76.96490000, 4.7, '10% Off CupDate Members'),
('Blue Tokai Coffee Roasters', 'Specialty Cafe', 'Pune', 'Cozy botanical courtyard with artisan pour-overs and organic sourdough.', 'Koregaon Park, North Main Road, Pune', 18.53620000, 73.89380000, 4.8, '15% Off Total Bill'),
('Subko Coffee Roasters & Bakehouse', 'Artisanal Roastery', 'Mumbai', 'Vintage converted heritage home serving single-origin Indian arabica and craft pastries.', 'Chapel Road, Bandra West, Mumbai', 19.05580000, 72.82950000, 4.9, 'Free Signature Cold Brew on Date'),
('Araku Coffee Landmark', 'Luxury Coffee Lounge', 'Bangalore', 'World-class regenerative micro-lot coffees with award-winning ambient architecture.', '12th Main Road, Indiranagar, Bangalore', 12.97190000, 77.64120000, 4.9, '20% Off Artisanal Tasting Set'),
('CaPhe Roasters & Vietnamese Brews', 'Cozy Date Spot', 'Delhi NCR', 'Intimate string-lit patio offering rich egg coffees, matcha lattes, and jazz vinyls.', 'Champa Gali, Saket, New Delhi', 28.51860000, 77.20230000, 4.7, 'Buy 1 Get 1 on Handcrafted Drinks'),
('Backyard Cafe & Roastery', 'Garden Cafe', 'Chandigarh', 'Lush shaded garden seating ideal for relaxed afternoon first meets.', 'Sector 9-D, Inner Market, Chandigarh', 30.74100000, 76.78650000, 4.6, 'Free Double Shot Espresso Upgrade')
ON DUPLICATE KEY UPDATE `description`=VALUES(`description`), `cup_offer`=VALUES(`cup_offer`);

-- --------------------------------------------------------
-- SEED DATA: Verified Demo Users
-- --------------------------------------------------------
INSERT INTO `users` (`id`, `member_code`, `email`, `password`, `full_name`, `dob`, `gender`, `bio`, `avatar`, `country`, `interests`, `astrology`, `mbti`, `coffee_style`, `is_verified`, `coins`, `xp`, `status`, `created_at`) VALUES
(1, 'CD-10001', 'aditi.rao@cupdate.in', '$2y$12$K88F5s2yU1wN4Q3Lp9Zke.pZfxr2k3Wk6PZ5M1G9aB3vC7eD8f1h2', 'Aditi Rao', '1999-05-14', 'female', 'Specialty coffee enthusiast, amateur film photographer, and indie acoustic fan. Let us explore Blue Tokai or Wake & Bake! ☕📸', 'assets/images/default_avatar.png', 'Pune, India', 'Coffee, Books, Photography, Vinyl Records', 'Taurus', 'ENFP', 'Vanilla Oat Milk Latte', 1, 150, 80, 'active', NOW()),
(2, 'CD-10002', 'rahul.kapoor@cupdate.in', '$2y$12$K88F5s2yU1wN4Q3Lp9Zke.pZfxr2k3Wk6PZ5M1G9aB3vC7eD8f1h2', 'Rahul Kapoor', '1997-11-20', 'male', 'Architect by day, espresso aficionado by night. Always looking for cozy cafes with good reading corners and mountain views.', 'assets/images/default_avatar.png', 'Mumbai, India', 'Architecture, Espresso, Hiking, Jazz', 'Scorpio', 'INTJ', 'Double Espresso Macchiato', 1, 100, 45, 'active', NOW()),
(3, 'CD-10003', 'tanya.sharma@cupdate.in', '$2y$12$K88F5s2yU1wN4Q3Lp9Zke.pZfxr2k3Wk6PZ5M1G9aB3vC7eD8f1h2', 'Tanya Sharma', '1998-08-22', 'female', 'Born in Shimla, lover of cedar trails, hot cappuccinos at Cafe Simla Times, and soulful poetry. Looking for authentic rishta or meaningful connection.', 'assets/images/default_avatar.png', 'Shimla, Himachal Pradesh', 'Trekking, Specialty Coffee, Poetry, Himalayas', 'Virgo', 'INFJ', 'Cinnamon Honey Latte', 1, 200, 110, 'active', NOW()),
(4, 'CD-10004', 'vikram.thakur@cupdate.in', '$2y$12$K88F5s2yU1wN4Q3Lp9Zke.pZfxr2k3Wk6PZ5M1G9aB3vC7eD8f1h2', 'Vikram Thakur', '1996-03-12', 'male', 'Old Manali local, backcountry snowboarder, and French roast barista. Let us grab an outdoor table at Cafe 1947 by the river.', 'assets/images/default_avatar.png', 'Manali, Himachal Pradesh', 'Snowboarding, Pour-overs, Indie Rock, Camping', 'Aries', 'ENFP', 'French Press Dark Roast', 1, 120, 60, 'active', NOW())
ON DUPLICATE KEY UPDATE `full_name`=VALUES(`full_name`), `country`=VALUES(`country`);

-- --------------------------------------------------------
-- SEED DATA: Editorial Guides & Articles
-- --------------------------------------------------------
INSERT INTO `blogs` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image_icon`, `views`, `created_at`) VALUES
(1, 'ultimate-coffee-dating-etiquette-india-2026', 'Ultimate Coffee Dating Etiquette Guide (2026)', 'Dating Advice', 'The complete handbook on navigating first dates over specialty coffee: who pays, how long to stay, and conversational green flags.', 'Coffee dates have rapidly evolved into India\'s preferred first encounter for modern dating and matrimonial pre-meets. Unlike rigid dinners or noisy clubs, a 45-minute specialty pour-over provides a warm, low-pressure setting where genuine chemistry can unfold naturally.\n\n### The Golden 45-Minute Window\nOne of the greatest benefits of a coffee date is its flexible timeframe. If the vibe is awkward, a 45-minute single cappuccino allows a graceful exit with zero hard feelings. If sparks fly, ordering a second round or taking a stroll along the promenade is effortless.\n\n### Specialty Venues vs. Generic Chains\nOpt for independent roasteries like Blue Tokai, Subko, Wake & Bake, or Illiterati Books. The artisanal atmosphere, soft acoustic playlist, and fragrant roast profile create an immediate conversation piece.', 'fa-mug-hot', 1420, NOW()),
(2, 'women-dating-safety-guide-india', 'Women\'s Dating Safety Guide for India (DPDP Act 2026)', 'Safety & Trust', 'Essential security protocols, location sharing, verification badges, and reporting mechanisms for peace of mind.', 'At CupDate, women\'s safety is our foundational design principle. With end-to-end user verification, government-compliant data protection (DPDP Act 2023), and AI-monitored photo moderation, here is how you can date with absolute confidence.\n\n### 1. Always Meet in Vetted Public Cafes\nNever agree to private residences or secluded locations on a first meet. Choose verified CupDate partner cafes with active foot traffic and attentive staff.\n\n### 2. Guard Your Phone Number with CupDate In-App Chat\nKeep your personal phone number, WhatsApp, and social media handles private until you have met in person and verified mutual comfort. Our in-app real-time chat supports secure photo attachments and instant moderation without exposing personal contact details.', 'fa-shield-halved', 2180, NOW()),
(3, 'romantic-coffee-date-guide-himachal-pradesh', 'The Mountain Romance Guide: Coffee Dates in Shimla & Manali', 'Himachal Dating', 'Discover quiet colonial verandas in Shimla, riverside patios in Old Manali, and literary retreats in McLeodGanj.', 'There is something uniquely magical about sharing hot espresso while wrapped in a woolen shawl overlooking snow-dusted Himalayan peaks. Himachal Pradesh offers the most atmospheric dating backdrop in the subcontinent.\n\nFrom the century-old woodcraft of Shimla\'s Mall Road to the artistic cafes along the rushing Manalsu river in Old Manali, discover our curated guide to mountain coffee dating.', 'fa-mountain', 950, NOW())
ON DUPLICATE KEY UPDATE `title`=VALUES(`title`), `excerpt`=VALUES(`excerpt`);

SET FOREIGN_KEY_CHECKS = 1;
