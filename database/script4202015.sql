ALTER TABLE `user` ADD `phone` VARCHAR(50) NOT NULL AFTER `email`, ADD `twitter` VARCHAR(500) NOT NULL AFTER `phone`, ADD `facebook` VARCHAR(500) NOT NULL AFTER `twitter`;

