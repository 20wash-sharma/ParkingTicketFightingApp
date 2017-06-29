ALTER TABLE `platetypes` CHANGE `PlatetypesID` `PlatetypesID` INT(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `parkingticket`.`platetypes` (`PlatetypesID`, `platetype`, `platetypesdesc`) VALUES (NULL, 'Type 1', 'Description 1');
INSERT INTO `parkingticket`.`platetypes` (`PlatetypesID`, `platetype`, `platetypesdesc`) VALUES (NULL, 'Type 2', 'Description 2');
INSERT INTO `parkingticket`.`platetypes` (`PlatetypesID`, `platetype`, `platetypesdesc`) VALUES (NULL, 'Type 3', 'Description 3');
INSERT INTO `parkingticket`.`platetypes` (`PlatetypesID`, `platetype`, `platetypesdesc`) VALUES (NULL, 'Type 4', 'Description 4');

CREATE TABLE IF NOT EXISTS `states` (
  `StateID` int(11) NOT NULL AUTO_INCREMENT,
  `StateName` varchar(250) NOT NULL,
  `StateShortName` varchar(15) NOT NULL,
  PRIMARY KEY (`StateID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Alabama', 'AL');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Alaska', 'AK');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Arizona', 'AZ');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Arkansas', 'AR');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'California', 'CA');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Colorado', 'CO');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Connecticut', 'CT');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Delaware', 'DE');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Florida', 'FL');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Georgia', 'GA');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Hawaii', 'HI');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Idaho', 'ID');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Illinois', 'IL');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Indiana', 'IN');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Iowa', 'IA');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Kansas', 'KS');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Kentucky', 'KY');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Louisiana', 'LA');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Maine', 'ME');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Maryland', 'MD');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Massachusetts', 'MA');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Michigan', 'MI');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Minnesota', 'MN');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Mississippi', 'MS');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Missouri', 'MO');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Montana', 'MT');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Nebraska', 'NE');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Nevada', 'NV');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'New Hampshire', 'NH');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'New Jersey', 'NJ');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'New Mexico', 'NM');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'New York', 'NY');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'North Carolina', 'NC');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'North Dakota', 'ND');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Ohio', 'OH');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Oklahoma', 'OK');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Oregon', 'OR');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Pennsylvania', 'PA');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Rhode Island', 'RI');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'South Carolina', 'SC');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'South Dakota', 'SD');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Tennessee', 'TN');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Texas', 'TX');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Utah', 'UT');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Vermont', 'VT');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Virginia', 'VA');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Washington', 'WA');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'West Virginia', 'WV');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Wisconsin', 'WI');
INSERT INTO `parkingticket`.`states` (`StateID`, `StateName`, `StateShortName`) VALUES (NULL, 'Wyoming', 'WY');

ALTER TABLE `plates` CHANGE `PlateID` `PlateID` BIGINT(15) NOT NULL AUTO_INCREMENT;