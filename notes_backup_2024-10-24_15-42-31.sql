DROP TABLE IF EXISTS marque;
CREATE TABLE `marque` (
  `Id_marque` int NOT NULL,
  `Nom_marque` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id_marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO marque VALUES("1","Kia");
INSERT INTO marque VALUES("2","Renault");
INSERT INTO marque VALUES("3","Citroen");
INSERT INTO marque VALUES("4","Hyundai");
INSERT INTO marque VALUES("5","Fiat");

DROP TABLE IF EXISTS modele;
CREATE TABLE `modele` (
  `Id_modele` int NOT NULL,
  `Nom_modele` varchar(30) DEFAULT NULL,
  `Id_marque` int DEFAULT NULL,
  PRIMARY KEY (`Id_modele`),
  KEY `Id_marque` (`Id_marque`),
  CONSTRAINT `modele_ibfk_1` FOREIGN KEY (`Id_marque`) REFERENCES `marque` (`Id_marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO modele VALUES("1","Clio","2");
INSERT INTO modele VALUES("2","i20","4");
INSERT INTO modele VALUES("3","i10","4");
INSERT INTO modele VALUES("4","C3","3");
INSERT INTO modele VALUES("5","Picanto","1");
INSERT INTO modele VALUES("6","Niro","1");
INSERT INTO modele VALUES("7","Stonic","1");
INSERT INTO modele VALUES("8","Panda","5");
INSERT INTO modele VALUES("9","Punto","5");
INSERT INTO modele VALUES("10","Doblo","5");

DROP TABLE IF EXISTS notes;
CREATE TABLE `notes` (
  `nid` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `descr` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`nid`),
  KEY `fk1` (`uid`),
  CONSTRAINT `fk1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO notes VALUES("71","14712058","<script> alert(\'I just injected Javascript!\'); </script>");

DROP TABLE IF EXISTS proprietaire;
CREATE TABLE `proprietaire` (
  `CIN` varchar(8) NOT NULL,
  `Nom_proprietaire` varchar(30) DEFAULT NULL,
  `Prenom_proprietaire` varchar(30) DEFAULT NULL,
  `Date_de_naissance` date DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Telephone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`CIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO proprietaire VALUES("07776661","Dridi","Islem","1993-07-14","islem.dridi@gmail.com","22256321");
INSERT INTO proprietaire VALUES("08876661","Jday","Asma","1994-06-20","asma.jday@yahoo.fr","99234123");
INSERT INTO proprietaire VALUES("0918564","Lahmedi","Youssef","1998-12-13","youssef.lahmedi@gmail.com","52196245");
INSERT INTO proprietaire VALUES("09976661","Baldi","Hazem","1997-03-26","hazem.baldi@gmail.com","23157624");
INSERT INTO proprietaire VALUES("09996661","Gasmi","Amal","1999-10-12","amal.gasmi@gmail.com","21456321");
INSERT INTO proprietaire VALUES("19100115","Housni","Majd","2000-03-05","majd.housni@gmail.com","50368353");
INSERT INTO proprietaire VALUES("19123115","Akrimi","Ahmed","2001-07-14","ahmed.akrimi@gmail.com","20368753");

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `uid` int NOT NULL,
  `pass` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO users VALUES("0","123456");
INSERT INTO users VALUES("123456","123456");
INSERT INTO users VALUES("14712058","99999999");

DROP TABLE IF EXISTS voiture;
CREATE TABLE `voiture` (
  `Id_voiture` int NOT NULL,
  `immatriculation` varchar(30) DEFAULT NULL,
  `Couleur` varchar(30) DEFAULT NULL,
  `Carburant` varchar(30) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `Km` int DEFAULT NULL,
  `Id_modele` int DEFAULT NULL,
  `Id_proprietaire` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`Id_voiture`),
  KEY `Id_modele` (`Id_modele`),
  KEY `Id_proprietaire` (`Id_proprietaire`),
  CONSTRAINT `voiture_ibfk_1` FOREIGN KEY (`Id_modele`) REFERENCES `modele` (`Id_modele`),
  CONSTRAINT `voiture_ibfk_2` FOREIGN KEY (`Id_proprietaire`) REFERENCES `proprietaire` (`CIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO voiture VALUES("1","201 TN 2154","blanche","Essence","22000.00","120000","1","08876661");
INSERT INTO voiture VALUES("2","201 TN 2484","blanche","Essence","27000.00","110000","2","09996661");
INSERT INTO voiture VALUES("3","RS 125462","noire","Essence","28000.00","150000","3","19123115");
INSERT INTO voiture VALUES("4","180 TN 3652","noire","Essence","25000.00","130000","3","09996661");
INSERT INTO voiture VALUES("5","175 TN 1751","grise","Diesel","36000.00","140000","10","19123115");
INSERT INTO voiture VALUES("6","RS 256348","rouge","Essence","45000.00","170000","2","07776661");
INSERT INTO voiture VALUES("7","199 TN 2456","blanche","Essence","36000.00","100000","5","19123115");

