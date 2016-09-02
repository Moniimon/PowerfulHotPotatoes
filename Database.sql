

CREATE TABLE `Itemtable` (
  `ItemID` int(11) NOT NULL AUTO_INCREMENT,
  `ItemName` varchar(45) DEFAULT NULL,
  `ItemDescription` varchar(45) DEFAULT NULL,
  `ItemPrice` decimal(8,2) DEFAULT NULL,
  `ItemQuantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='List of all products that can be sold'

CREATE TABLE `saletable` (
  `SaleID` int(11) NOT NULL,
  `saleDate` int(11) NOT NULL,
  `SaleTime` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL ,
  PRIMARY KEY (`SaleID`,`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8


) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8
