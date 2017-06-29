ALTER TABLE `user` ADD `lastseen` DATETIME NOT NULL DEFAULT '0000-00-00' AFTER `creationtime`;
ALTER TABLE `user` ADD `status` BOOLEAN NOT NULL DEFAULT FALSE AFTER `signatureimage`;
ALTER TABLE `role` ADD `creationtime` DATETIME NOT NULL DEFAULT '0000-00-00' ;

insert into role_member(Role_roleID,user_UserID)values(17,2)
update user set status = 1 where UserID = 2
