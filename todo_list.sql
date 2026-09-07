
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--create the task table 
CREATE TABLE IF NOT EXISTS `Task` (
	`task_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	--user id here later
	`title` VARCHAR(255),
	`due_date` DATE NOT NULL,
	`priority_id` INTEGER NOT NULL,
	`category_id` INTEGER NOT NULL,
	PRIMARY KEY(`task_id`, `user_id`)
);

--this will be used for later on
CREATE TABLE IF NOT EXISTS `User` (
	`user_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(`user_id`)
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


ALTER TABLE `User`
ADD FOREIGN KEY(`user_id`) REFERENCES `Task`(`user_id`)
ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `Category`
ADD FOREIGN KEY(`category_id`) REFERENCES `Task`(`category_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Priority`
ADD FOREIGN KEY(`priority_id`) REFERENCES `Task`(`priority_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;