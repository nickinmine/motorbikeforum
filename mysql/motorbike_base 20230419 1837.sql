-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	8.0.27


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema motorbike_base
--

CREATE DATABASE IF NOT EXISTS motorbike_base;
USE motorbike_base;

--
-- Definition of table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `album_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `album`
--

/*!40000 ALTER TABLE `album` DISABLE KEYS */;
/*!40000 ALTER TABLE `album` ENABLE KEYS */;


--
-- Definition of table `album_image`
--

DROP TABLE IF EXISTS `album_image`;
CREATE TABLE `album_image` (
  `album_id` int NOT NULL,
  `image_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `R_24` (`album_id`),
  KEY `R_25` (`image_id`),
  CONSTRAINT `album_image_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`),
  CONSTRAINT `album_image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `album_image`
--

/*!40000 ALTER TABLE `album_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `album_image` ENABLE KEYS */;


--
-- Definition of table `ban_list`
--

DROP TABLE IF EXISTS `ban_list`;
CREATE TABLE `ban_list` (
  `user_uuid` varchar(36) NOT NULL,
  `ban_date` datetime NOT NULL,
  PRIMARY KEY (`user_uuid`),
  CONSTRAINT `ban_list_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ban_list`
--

/*!40000 ALTER TABLE `ban_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `ban_list` ENABLE KEYS */;


--
-- Definition of table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `thread_id` int NOT NULL,
  `content` text NOT NULL,
  `user_uuid` varchar(36) NOT NULL,
  `publish_date` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `R_12` (`thread_id`),
  KEY `R_13` (`user_uuid`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


--
-- Definition of table `comment_chosen`
--

DROP TABLE IF EXISTS `comment_chosen`;
CREATE TABLE `comment_chosen` (
  `user_uuid` varchar(36) NOT NULL,
  `comment_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `R_16` (`user_uuid`),
  KEY `R_18` (`comment_id`),
  CONSTRAINT `comment_chosen_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`),
  CONSTRAINT `comment_chosen_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment_chosen`
--

/*!40000 ALTER TABLE `comment_chosen` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_chosen` ENABLE KEYS */;


--
-- Definition of table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `image_uri` varchar(100) NOT NULL,
  `min_uri` varchar(100) NOT NULL,
  `user_uuid` varchar(36) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `R_27` (`user_uuid`),
  CONSTRAINT `image_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image`
--

/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;


--
-- Definition of table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `notification_id` int NOT NULL AUTO_INCREMENT,
  `user_uuid` varchar(36) NOT NULL,
  `notification_type` varchar(50) NOT NULL,
  `get_date` datetime NOT NULL,
  `notification_uri` datetime DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `R_26` (`user_uuid`),
  KEY `R_28` (`notification_type`),
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`),
  CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`notification_type`) REFERENCES `notification_type` (`notification_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification`
--

/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;


--
-- Definition of table `notification_type`
--

DROP TABLE IF EXISTS `notification_type`;
CREATE TABLE `notification_type` (
  `notification_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`notification_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification_type`
--

/*!40000 ALTER TABLE `notification_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_type` ENABLE KEYS */;


--
-- Definition of table `reg_data`
--

DROP TABLE IF EXISTS `reg_data`;
CREATE TABLE `reg_data` (
  `user_uuid` varchar(36) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_uuid`),
  CONSTRAINT `reg_data_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reg_data`
--

/*!40000 ALTER TABLE `reg_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `reg_data` ENABLE KEYS */;


--
-- Definition of table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role` varchar(20) NOT NULL,
  `description` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


--
-- Definition of table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tag` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tag`
--

/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;


--
-- Definition of table `thread`
--

DROP TABLE IF EXISTS `thread`;
CREATE TABLE `thread` (
  `thread_id` int NOT NULL AUTO_INCREMENT,
  `user_uuid` varchar(36) NOT NULL,
  `header` text NOT NULL,
  `content` text NOT NULL,
  `publish_date` datetime DEFAULT NULL,
  `is_news` blob,
  `view_num` int NOT NULL,
  `tag` varchar(100) NOT NULL,
  PRIMARY KEY (`thread_id`),
  KEY `R_9` (`user_uuid`),
  KEY `R_14` (`tag`),
  CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`),
  CONSTRAINT `thread_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `thread`
--

/*!40000 ALTER TABLE `thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread` ENABLE KEYS */;


--
-- Definition of table `thread_chosen`
--

DROP TABLE IF EXISTS `thread_chosen`;
CREATE TABLE `thread_chosen` (
  `user_uuid` varchar(36) NOT NULL,
  `thread_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `R_15` (`user_uuid`),
  KEY `R_17` (`thread_id`),
  CONSTRAINT `thread_chosen_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`),
  CONSTRAINT `thread_chosen_ibfk_2` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `thread_chosen`
--

/*!40000 ALTER TABLE `thread_chosen` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_chosen` ENABLE KEYS */;


--
-- Definition of table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `token` varchar(32) NOT NULL,
  `expires_on` datetime NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `token`
--

/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;


--
-- Definition of table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_uuid` varchar(36) NOT NULL,
  `name` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `experience` int NOT NULL,
  `reg_date` date NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar_id` int NOT NULL,
  `motorbike` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_uuid`),
  UNIQUE KEY `Index_4` (`nickname`),
  UNIQUE KEY `Index_5` (`email`),
  KEY `R_6` (`role`),
  KEY `R_29` (`avatar_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`role`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`avatar_id`) REFERENCES `image` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


--
-- Definition of table `wait_list`
--

DROP TABLE IF EXISTS `wait_list`;
CREATE TABLE `wait_list` (
  `user_uuid` varchar(36) NOT NULL,
  PRIMARY KEY (`user_uuid`),
  CONSTRAINT `wait_list_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wait_list`
--

/*!40000 ALTER TABLE `wait_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `wait_list` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
