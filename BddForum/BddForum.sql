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
  `nameCategory` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.category : ~5 rows (environ)
INSERT INTO `category` (`ID_Category`, `nameCategory`) VALUES
	(1, 'Finance'),
	(2, 'Loisirs'),
	(3, 'Aventure'),
	(4, 'Technologie'),
	(5, 'Sport');

-- Listage de la structure de table bddforum. post
CREATE TABLE IF NOT EXISTS `post` (
  `ID_post` int NOT NULL AUTO_INCREMENT,
  `text` text,
  `creationDate` datetime DEFAULT NULL,
  `topic_ID` int DEFAULT NULL,
  `user_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID_post`),
  KEY `topic_ID` (`topic_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_ID`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.post : ~10 rows (environ)
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

-- Listage de la structure de table bddforum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `verrouillage` tinyint(1) DEFAULT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `Category_ID` (`category_id`) USING BTREE,
  KEY `user_ID` (`user_id`) USING BTREE,
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`ID_Category`),
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.topic : ~10 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `verrouillage`, `category_id`, `user_id`) VALUES
	(1, 'Crypto', '2024-03-14 14:25:04', 2, 1, 1),
	(2, 'Lecture', '2024-03-14 16:44:41', 4, 2, 1),
	(3, 'Foot', '2024-03-14 16:45:10', 3, 5, 1),
	(4, 'Voyages', '2024-03-14 16:45:36', 3, 3, 1),
	(5, 'Informatique', '2024-03-14 16:46:05', 2, 4, 1),
	(6, 'Rugby', '2024-03-19 09:10:06', 3, 5, 2),
	(7, 'Conference', '2024-03-19 09:10:54', 2, 2, 4),
	(8, 'Blockchain', '2024-03-19 09:11:36', 3, 1, 3),
	(9, 'Bon Plans', '2024-03-19 09:12:08', 1, 3, 3),
	(10, 'Codage', '2024-03-19 09:13:08', 4, 4, 3);

-- Listage de la structure de table bddforum. user
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Listage des données de la table bddforum.user : ~7 rows (environ)
INSERT INTO `user` (`ID_user`, `email`, `password`, `nickname`, `role`) VALUES
	(1, 'a@gmail.com', 'abdullrahman', 'MOI', 'Utilisateur'),
	(2, 'alkarshi.abdullrahman@gmail.com', '$2y$10$l8nmwGPIRguw2XgDKtanNumzNxqb.MPMAnF352woQXfLUjZ2i0Q9O', 'exemple', 'Utilisateur'),
	(3, 'a@gmail.com', '$2y$10$Mb/xxwq6lESuPS7RuPeiIeYTpD1igfMWewffxxe3i5ClgqX9m9Lze', 'PONEY', 'Utilisateur'),
	(4, 'arnaud@gmail.com', '$2y$10$mfXSiTk1oH7AoiLOfTnVxuB0mMrxB9RXoaHQcuJ01VLINHE8R3l9e', 'arnaud', 'Utilisateur'),
	(5, 'exemple@gmail.com', '$2y$10$P0BzG/7Po1BAJmPFS3MxdOcSSgx69d3rsmykuX/mgI0v9MTQkHUXq', 'exemple', 'Utilisateur'),
	(7, 'exemple@exemple.com', '$2y$10$RivgXDTJgndbFRdS/0.ph.efdqAVHmi3t1q0AzWlLh6e.Ic85qJbi', 'exemple', 'Utilisateur'),
	(8, 'titre@gmail.com', '$2y$10$PmGV3kTcFASt3Oihke6qiOWsDCH5Vso3ePx6FiDEFzD/PY6ClCLFu', 'titre', 'Utilisateur'),
	(9, 'exemple@exemple.com', '$2y$10$B2NInte04L/pV4YEvBnDeeuFUMo3CYBYOPygTQ6NSutj.maQWNxZC', 'exemple', 'Utilisateur');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
