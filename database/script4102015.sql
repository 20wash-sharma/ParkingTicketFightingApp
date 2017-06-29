ALTER TABLE `alerts` CHANGE `AlertsID` `AlertsID` INT(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `parkingticket`.`alerts` (`AlertsID`, `description`) VALUES (NULL, 'Notice of New Ticket');
INSERT INTO `parkingticket`.`alerts` (`AlertsID`, `description`) VALUES (NULL, 'Payment Notice');
INSERT INTO `parkingticket`.`alerts` (`AlertsID`, `description`) VALUES (NULL, 'Avoide Late fee');

ALTER TABLE `alertshistory` CHANGE `AlertsHistoryID` `AlertsHistoryID` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `alertpreferances` ADD `alertType` VARCHAR(250) NOT NULL AFTER `user_UserID`;
ALTER TABLE `alertpreferances` CHANGE `AlertpreferancesID` `AlertpreferancesID` INT(11) NOT NULL AUTO_INCREMENT;
