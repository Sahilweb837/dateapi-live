-- ==============================================================================
-- CupDate MySQL Fix: Create Database, Create/Update User & Grant All Privileges
-- Run this in phpMyAdmin (SQL tab) or in MySQL command line / terminal
-- Database: cupamate1_backenlaraveldate
-- User:     cupamate1_backendlaraveldate2s
-- Password: a0}A6(k7R#N=
-- ==============================================================================

-- 1. Create the Database if it doesn't already exist
CREATE DATABASE IF NOT EXISTS `cupamate1_backenlaraveldate` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

-- 2. Create or Update the User for 'localhost' with the exact .env password
CREATE USER IF NOT EXISTS 'cupamate1_backendlaraveldate2s'@'localhost' IDENTIFIED BY 'a0}A6(k7R#N=';
ALTER USER 'cupamate1_backendlaraveldate2s'@'localhost' IDENTIFIED BY 'a0}A6(k7R#N=';
GRANT ALL PRIVILEGES ON `cupamate1_backenlaraveldate`.* TO 'cupamate1_backendlaraveldate2s'@'localhost';

-- 3. Also grant for '127.0.0.1' (handles IPv4 loopback)
CREATE USER IF NOT EXISTS 'cupamate1_backendlaraveldate2s'@'127.0.0.1' IDENTIFIED BY 'a0}A6(k7R#N=';
ALTER USER 'cupamate1_backendlaraveldate2s'@'127.0.0.1' IDENTIFIED BY 'a0}A6(k7R#N=';
GRANT ALL PRIVILEGES ON `cupamate1_backenlaraveldate`.* TO 'cupamate1_backendlaraveldate2s'@'127.0.0.1';

-- 4. Also grant for '%' (wildcard host, covers all socket/network connections)
CREATE USER IF NOT EXISTS 'cupamate1_backendlaraveldate2s'@'%' IDENTIFIED BY 'a0}A6(k7R#N=';
ALTER USER 'cupamate1_backendlaraveldate2s'@'%' IDENTIFIED BY 'a0}A6(k7R#N=';
GRANT ALL PRIVILEGES ON `cupamate1_backenlaraveldate`.* TO 'cupamate1_backendlaraveldate2s'@'%';

-- 5. Reload all privilege tables in MySQL
FLUSH PRIVILEGES;

-- ==============================================================================
-- CPANEL NOTICE (If your shared hosting says "#1044 Access Denied to GRANT"):
-- In cPanel shared hosting, GRANT cannot be run via SQL tab. Follow these 3 clicks:
-- 1. In cPanel, click "MySQL® Databases".
-- 2. Scroll to "Add User To Database":
--    - Select User: cupamate1_backendlaraveldate2s
--    - Select Database: cupamate1_backenlaraveldate
--    - Click "Add" button.
-- 3. Check the "ALL PRIVILEGES" checkbox and click "Make Changes".
-- ==============================================================================
