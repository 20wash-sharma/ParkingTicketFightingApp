INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Tickets');

INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '11', 'View', 'View all tickets');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '11', 'Add', 'Add new ticket');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '11', 'Edit', 'Edit ticket');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '11', 'Delete', 'Delete tickets');