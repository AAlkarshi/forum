-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour bddforum
CREATE DATABASE IF NOT EXISTS `bddforum` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bddforum`;

-- Listage de la structure de table bddforum. category
CREATE TABLE IF NOT EXISTS `category` (
  `ID_Category` int NOT NULL,
  `name_category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.category : ~0 rows (environ)

-- Listage de la structure de table bddforum. post
CREATE TABLE IF NOT EXISTS `post` (
  `ID_post` int NOT NULL,
  `text` text,
  `creationDate` datetime DEFAULT NULL,
  `topic_ID` int DEFAULT NULL,
  `user_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID_post`),
  KEY `topic_ID` (`topic_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`topic_ID`) REFERENCES `topic` (`ID_topic`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.post : ~0 rows (environ)

-- Listage de la structure de table bddforum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `ID_topic` int NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `verrouillage` tinyint(1) DEFAULT NULL,
  `Category_ID` int DEFAULT NULL,
  `user_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID_topic`),
  KEY `Category_ID` (`Category_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`ID_Category`),
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.topic : ~0 rows (environ)

-- Listage de la structure de table bddforum. user
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.user : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
