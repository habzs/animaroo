-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: animaroo
-- ------------------------------------------------------
-- Server version	5.6.34-log

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
-- Table structure for table `forum_posts`
--

DROP TABLE IF EXISTS `forum_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `post_text` text NOT NULL,
  `post_create_time` datetime NOT NULL,
  `post_owner` varchar(150) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_posts`
--

LOCK TABLES `forum_posts` WRITE;
/*!40000 ALTER TABLE `forum_posts` DISABLE KEYS */;
INSERT INTO `forum_posts` VALUES (3,3,'hello','2018-07-27 17:56:57','tingzhen3003@gmail.com'),(4,4,'yryrt','2018-07-29 00:49:48','tingzhen3003@gmail.com');
/*!40000 ALTER TABLE `forum_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_topics`
--

DROP TABLE IF EXISTS `forum_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_title` varchar(150) NOT NULL,
  `topic_create_time` datetime NOT NULL,
  `topic_owner` varchar(150) NOT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_topics`
--

LOCK TABLES `forum_topics` WRITE;
/*!40000 ALTER TABLE `forum_topics` DISABLE KEYS */;
INSERT INTO `forum_topics` VALUES (3,'hello','2018-07-27 17:56:57','tingzhen3003@gmail.com'),(4,'test','2018-07-29 00:49:48','tingzhen3003@gmail.com');
/*!40000 ALTER TABLE `forum_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `age` int(11) NOT NULL,
  `species` text NOT NULL,
  `breed` text NOT NULL,
  `picture` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Maxwell',10,'Dog','Shiba',''),(2,'Another sample text',0,'','','');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating_info`
--

DROP TABLE IF EXISTS `rating_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating_info` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_action` varchar(20) NOT NULL,
  UNIQUE KEY `post_id` (`post_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating_info`
--

LOCK TABLES `rating_info` WRITE;
/*!40000 ALTER TABLE `rating_info` DISABLE KEYS */;
INSERT INTO `rating_info` VALUES (1,1,'like'),(1,2,'dislike'),(2,1,'dislike'),(2,2,'dislike');
/*!40000 ALTER TABLE `rating_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  `registration_date` datetime NOT NULL,
  `image` blob NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Larry','Ullman','email@example.com','e727d1464ae12436e899a726da5b2f11d8381b26','2018-07-24 14:48:49',' '),(2,'John','Lennon','john@beatles.com','2a50435b0f512f60988db719106a258fb7e338ff','2018-07-24 14:48:49',' '),(3,'Paul','McCartney','paul@beatles.com','6ae16792c502a5b47da180ce8456e5ae7d65e262','2018-07-24 14:48:49',' '),(4,'George','Harrison','george@beatles.com ','1af17e73721dbe0c40011b82ed4bb1a7dbe3ce29','2018-07-24 14:48:49',' '),(5,'Ringo','Starr','ringo@beatles.com','520f73691bcf89d508d923a2dbc8e6fa58efb522','2018-07-24 14:48:49',' '),(6,'Ashley','Low','tingzhen3003@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-07-25 01:12:49',''),(7,'shaza dhanea','rahmat','shazadhanea@gmail.com','ff9e4c1919a17aa7ae6656c889ece980daf234e4','2018-07-27 12:36:30','');
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

-- Dump completed on 2018-07-29 21:58:37
