-- used in just creating the tables and the restrictions


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- create the task table
-- user id here later
CREATE TABLE IF NOT EXISTS `Task` (
	`task_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER UNSIGNED NOT NULL,
	`title` VARCHAR(255),
	`due_date` DATETIME NOT NULL,
	`priority_id` INTEGER UNSIGNED NOT NULL,
	`category_id` INTEGER UNSIGNED NOT NULL,
	`is_done` TINYINT(1) NOT NULL DEFAULT 0,
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY(`task_id`)
);

-- this will be used for later on
CREATE TABLE IF NOT EXISTS `User` (
	`user_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_name` VARCHAR(255),
	`user_email` VARCHAR(255),
	-- password must be hashed before storing to this
	`password_hash` VARCHAR(255) NOT NULL,
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY(`user_id`),
	UNIQUE KEY `uq_user_email` (`user_email`),
	UNIQUE KEY `uq_user_username` (`user_name`)
);


CREATE TABLE IF NOT EXISTS `Category` (
	`category_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	`category_name` VARCHAR(255),
	PRIMARY KEY(`category_id`)
);


CREATE TABLE IF NOT EXISTS `Priority` (
	`priority_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	`priority_name` VARCHAR(255),
	PRIMARY KEY(`priority_id`)
);

ALTER TABLE `Task`
ADD FOREIGN KEY(`category_id`) REFERENCES `Category`(`category_id`)
ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE `Task`
ADD FOREIGN KEY(`priority_id`) REFERENCES `Priority`(`priority_id`)
ON UPDATE CASCADE ON DELETE NO ACTION;

ALTER TABLE `Task`
ADD FOREIGN KEY(`user_id`) REFERENCES `User`(`user_id`)
ON UPDATE CASCADE ON DELETE CASCADE 
