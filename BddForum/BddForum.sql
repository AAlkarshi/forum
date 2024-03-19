-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour bddforum
CREATE DATABASE IF NOT EXISTS `bddforum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bddforum`;

-- Listage de la structure de la table bddforum. category
CREATE TABLE IF NOT EXISTS `category` (
  `ID_Category` int(11) NOT NULL,
  `nameCategory` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.category : ~5 rows (environ)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`ID_Category`, `nameCategory`) VALUES
	(1, 'Finance'),
	(2, 'Loisirs'),
	(3, 'Aventure'),
	(4, 'Technologie'),
	(5, 'Sport');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Listage de la structure de la table bddforum. post
CREATE TABLE IF NOT EXISTS `post` (
  `ID_post` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `creationDate` datetime DEFAULT NULL,
  `topic_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_post`),
  KEY `topic_ID` (`topic_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`topic_ID`) REFERENCES `topic` (`ID_topic`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.post : ~10 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`ID_post`, `text`, `creationDate`, `topic_ID`, `user_ID`) VALUES
	(1, 'Argent', '2024-03-14 14:26:00', 1, 1),
	(2, 'Blockchain', '2024-03-16 03:03:04', 1, 1),
	(3, 'Groupe', '2024-03-16 03:04:20', 4, 1),
	(4, 'Solo', '2024-03-16 03:04:31', 4, 1),
	(5, 'Thriller', '2024-03-16 03:04:59', 2, 1),
	(6, 'Topics', '2024-03-16 03:06:15', 2, 1),
	(7, 'Ligue 1', '2024-03-16 03:06:35', 3, 1),
	(8, 'Liga', '2024-03-16 03:06:51', 3, 1),
	(9, 'Front-End', '2024-03-16 03:07:26', 5, 1),
	(10, 'Back-End', '2024-03-16 03:07:39', 5, 1);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table bddforum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `ID_topic` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `verrouillage` tinyint(1) DEFAULT NULL,
  `Category_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_topic`),
  KEY `Category_ID` (`Category_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`ID_Category`),
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.topic : ~6 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`ID_topic`, `title`, `creationDate`, `verrouillage`, `Category_ID`, `user_ID`) VALUES
	(1, 'Crypto', '2024-03-14 14:25:04', 2, 1, 1),
	(2, 'Lecture', '2024-03-14 16:44:41', 4, 2, 1),
	(3, 'Foot', '2024-03-14 16:45:10', 3, 5, 1),
	(4, 'Voyages', '2024-03-14 16:45:36', 3, 3, 1),
	(5, 'Informatique', '2024-03-14 16:46:05', 2, 4, 1);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table bddforum. user
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.user : ~5 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`ID_user`, `email`, `password`, `nickname`, `role`) VALUES
	(1, 'a@gmail.com', 'abdullrahman', 'MOI', 'Utilisateur'),
	(2, 'alkarshi.abdullrahman@gmail.com', '$2y$10$l8nmwGPIRguw2XgDKtanNumzNxqb.MPMAnF352woQXfLUjZ2i0Q9O', 'exemple', 'Utilisateur'),
	(3, 'a@gmail.com', '$2y$10$Mb/xxwq6lESuPS7RuPeiIeYTpD1igfMWewffxxe3i5ClgqX9m9Lze', 'PONEY', 'Utilisateur'),
	(4, 'arnaud@gmail.com', '$2y$10$mfXSiTk1oH7AoiLOfTnVxuB0mMrxB9RXoaHQcuJ01VLINHE8R3l9e', 'arnaud', 'Utilisateur'),
	(5, 'exemple@gmail.com', '$2y$10$P0BzG/7Po1BAJmPFS3MxdOcSSgx69d3rsmykuX/mgI0v9MTQkHUXq', 'exemple', 'Utilisateur'),
	(6, 'a.alkarshi@gmail.com', '$2y$10$rWM0M9Rf.lIrx7L2ZOnjfuFzZvDIGX.yzgJsVGUEadzJfBnKrfDw.', 'Abdullrahman', 'Utilisateur');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
