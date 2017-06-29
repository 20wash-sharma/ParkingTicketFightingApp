INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Profile');
INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Alerts');
INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Vehicle');
INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Payment Gatewary');
INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Vehicle Make');
INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'States');
INSERT INTO `parkingticket`.`permission_group` (`PermissionGroupID`, `GroupName`) VALUES (NULL, 'Plate Types');

INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '4', 'View', 'View User Profile');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '4', 'Add', 'Add User Profile');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '4', 'Edit', 'Edit User Profile');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '4', 'Delete', 'Delete User Profile');

INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '5', 'View', 'View User Profile');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '5', 'Add', 'Add User Alerts');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '5', 'Edit', 'Edit User Alerts');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '5', 'Delete', 'Delete User Alerts');

INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '6', 'View', 'View User Vehicle');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '6', 'Add', 'Add User Vehicle');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '6', 'Edit', 'Edit User Vehicle');
INSERT INTO `parkingticket`.`permission` (`PermissionID`, `PermissionGroup`, `name`, `description`) VALUES (NULL, '6', 'Delete', 'Delete User Vehicle');

