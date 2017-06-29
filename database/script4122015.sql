ALTER TABLE `role` ADD UNIQUE(`name`);
ALTER TABLE `user` ADD UNIQUE(`username`);

ALTER TABLE `user` ADD `profileImage` VARCHAR(500) NOT NULL AFTER `status`;
ALTER TABLE `vehiclemake` ADD UNIQUE(`vehiclemake`);

ALTER TABLE `vehiclemake` CHANGE `VehiclemakeID` `VehiclemakeID` INT(11) NOT NULL AUTO_INCREMENT;