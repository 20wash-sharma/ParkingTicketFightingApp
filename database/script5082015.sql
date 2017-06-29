INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Accounting');
INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Letter Template');

INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '12', 'View', 'View account details');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '12', 'Add', 'Add account details');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '12', 'Edit', 'Edit account details');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '12', 'Delete', 'Delete account details');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '13', 'View', 'View letter templates');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '13', 'Add', 'Add letter templates');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '13', 'Edit', 'Edit letter templates');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '13', 'Delete', 'Delete letter templates');