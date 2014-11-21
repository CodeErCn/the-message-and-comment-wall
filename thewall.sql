CREATE DATABASE  IF NOT EXISTS `thewall` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `thewall`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: 127.0.0.1    Database: thewall
-- ------------------------------------------------------
-- Server version	5.5.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users_idx` (`user_id`),
  KEY `fk_comments_messages1_idx` (`message_id`),
  CONSTRAINT `fk_comments_messages1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'Test comment # 6. :0~~','6:19pm November 17 2014','2014-11-17 18:19:21',1,5),(2,'Test comment#7 @@~~','7:19pm November 17 2014','2014-11-17 19:19:31',1,5),(3,'Test comment#7 @@~~','7:19pm November 17 2014','2014-11-17 19:19:40',1,5),(4,'OH MY GOD!!  WHAT HAPPENED!!','7:21pm November 17 2014','2014-11-17 19:21:09',1,5),(5,'test comment for post','7:24pm November 17 2014','2014-11-17 19:24:30',1,5),(6,'OH MY GOD PLEASE WORK!!!! :S','7:33pm November 17 2014','2014-11-17 19:33:33',1,4),(7,'woohoo it works!!','9:15pm November 17 2014','2014-11-17 21:15:46',3,6),(8,'This is comment from user abc!!','9:31pm November 17 2014','2014-11-17 21:31:15',1,6),(9,'log off works as well.','9:42pm November 17 2014','2014-11-17 21:42:20',1,6),(10,'why still highlighting?','9:42pm November 17 2014','2014-11-17 21:42:56',1,6),(11,'comment will not highlight again.. i hope..','9:46pm November 17 2014','2014-11-17 21:46:46',1,7),(12,'comment test with user ccd...','9:47pm November 17 2014','2014-11-17 21:47:31',3,7),(13,'WOOHOO... thank you very much.. Wall is now complete...','9:48pm November 17 2014','2014-11-17 21:48:02',3,8),(14,'comment something','8:36am November 18 2014','2014-11-18 08:36:19',1,9);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users1_idx` (`user_id`),
  CONSTRAINT `fk_messages_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'Message test for user_id = 1;','4:48pm November 17 2014','2014-11-17 16:48:20',1),(2,'Here is the message 2nd test for user_id = 1; with message id = 2;','5:38pm November 17 2014','2014-11-17 17:38:29',1),(3,'Here is the message 3nd test for user_id = 1; with message id = 3;','5:38pm November 17 2014','2014-11-17 17:38:52',1),(4,'Test message 4 for user abc :)','5:50pm November 17 2014','2014-11-17 17:50:49',1),(5,'Test message 5 posted from user abc','5:55pm November 17 2014','2014-11-17 17:55:48',1),(6,'Test message again with user ccd','9:15pm November 17 2014','2014-11-17 21:15:34',3),(7,'Final test with user abc..','9:46pm November 17 2014','2014-11-17 21:46:16',1),(8,'Final test with user ccd...','9:47pm November 17 2014','2014-11-17 21:47:10',3),(9,'post something','8:36am November 18 2014','2014-11-18 08:36:09',1);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'abc','abc','abc@abc.com','1aYhvp7mX78d.','1:34pm November 17 2014','2014-11-17 13:34:59'),(2,'erc','cre','ecec@mail.com','d73Bj7pX5WmU2','3:48pm November 17 2014','2014-11-17 15:48:38'),(3,'ccd','ccd','cba@cba.com','29zwkaMyGT68I','8:48pm November 17 2014','2014-11-17 20:48:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-21 10:04:09
