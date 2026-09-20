-- CupDate database update
-- Date: 2026-09-20
-- Purpose: make chat persistence compatible with all existing installations.
-- Run this once against the production MySQL database before deploying the app.

ALTER TABLE `messages`
  ADD COLUMN IF NOT EXISTS `message` TEXT NULL AFTER `receiver_id`,
  ADD COLUMN IF NOT EXISTS `body` TEXT NULL AFTER `message`,
  ADD COLUMN IF NOT EXISTS `attachment` VARCHAR(255) NULL AFTER `body`,
  ADD COLUMN IF NOT EXISTS `image_path` VARCHAR(255) NULL AFTER `attachment`,
  ADD COLUMN IF NOT EXISTS `is_call_request` TINYINT(1) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `call_status` VARCHAR(30) NULL,
  ADD COLUMN IF NOT EXISTS `updated_at` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `messages`
  MODIFY COLUMN `message` TEXT NULL,
  MODIFY COLUMN `body` TEXT NULL;

CREATE INDEX IF NOT EXISTS `idx_messages_conversation_created`
  ON `messages` (`sender_id`, `receiver_id`, `created_at`);

CREATE INDEX IF NOT EXISTS `idx_messages_unread_receiver`
  ON `messages` (`receiver_id`, `is_read`, `created_at`);

-- Verify the update:
-- SELECT id, sender_id, receiver_id, COALESCE(message, body) AS message_text,
--        COALESCE(attachment, image_path) AS attachment_path, is_read, created_at
-- FROM messages ORDER BY id DESC LIMIT 20;
