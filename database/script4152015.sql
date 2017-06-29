ALTER TABLE `vehicles` CHANGE `VehicleID` `VehicleID` INT(11) NOT NULL AUTO_INCREMENT;

insert into vehiclemake(vehiclemake,description)values('Alfa Romeo','Alfa Romeo');
insert into vehiclemake(vehiclemake,description)values('American Motors','American Motors');
insert into vehiclemake(vehiclemake,description)values('Aston Martin','Aston Martin');
insert into vehiclemake(vehiclemake,description)values('Audi','Audi');
insert into vehiclemake(vehiclemake,description)values('BMW','BMW');
insert into vehiclemake(vehiclemake,description)values('Bentley','Bentley');
insert into vehiclemake(vehiclemake,description)values('Buck','Buck');


INSERT INTO `parkingticket`.`vehicles` (`creationtime`, `nickName`, `VIN`, `user_UserID`, `vehicleMake_vehicleMake`) VALUES (CURRENT_TIMESTAMP, 'Car', 'B4P4523', '2', '2');
INSERT INTO `parkingticket`.`vehicles` (`creationtime`, `nickName`, `VIN`, `user_UserID`, `vehicleMake_vehicleMake`) VALUES (CURRENT_TIMESTAMP, 'Blue Car', 'B5P4623', '2', '3');
INSERT INTO `parkingticket`.`vehicles` (`creationtime`, `nickName`, `VIN`, `user_UserID`, `vehicleMake_vehicleMake`) VALUES (CURRENT_TIMESTAMP, 'Van', 'B9P4923', '2', '3');

INSERT INTO `parkingticket`.`payment_accounts` (`PaymentaccountID`, `user_UserID`, `nickName`, `creationtime`, `updatetime`, `accounttype`, `accountnumber`, `routingnumber`, `experationdate`) VALUES ('1', '2', 'Master Card', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'Credit Card', '1090-66265-215620-22', '987654321', 'CURRENT_TIMESTAMP');
INSERT INTO `parkingticket`.`payment_accounts` (`PaymentaccountID`, `user_UserID`, `nickName`, `creationtime`, `updatetime`, `accounttype`, `accountnumber`, `routingnumber`, `experationdate`) VALUES ('2', '2', 'Visa Card', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'Credit Card', '1090-66265-215620-22', '987654321', 'CURRENT_TIMESTAMP');
INSERT INTO `parkingticket`.`payment_accounts` (`PaymentaccountID`, `user_UserID`, `nickName`, `creationtime`, `updatetime`, `accounttype`, `accountnumber`, `routingnumber`, `experationdate`) VALUES ('3', '2', 'Master Card', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'Bank', '1090-66265-215620-22', '987654321', 'CURRENT_TIMESTAMP');