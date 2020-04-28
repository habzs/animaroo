# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.38)
# Database: animaroo
# Generation Time: 2018-08-10 03:23:42 +0000
# ************************************************************


-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8 */;
-- /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
-- /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE animaroo;
USE animaroo;

-- # Dump of table contact
-- # ------------------------------------------------------------

-- DROP TABLE IF EXISTS `contact`;

CREATE TABLE contact (
  id11 int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  subject varchar(255) NOT NULL,
  message varchar(255) NOT NULL,
  date_time datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- LOCK TABLES `contact` WRITE;
-- /*!40000 ALTER TABLE `contact` DISABLE KEYS */;

INSERT INTO contact 
VALUES
	(2,'Ashley','olivialeejm@gmail.com','Walking','I want to walk my dog','2018-08-03 11:39:42'),
	(3,'David','email@example.com','Grooming - Wash','My dog is very smelly can i please book an appointment','2018-08-03 11:40:22'),
	(4,'Sean','sean_lim@hotmail.com','hello there','i am bored','2018-08-03 11:41:31'),
	(5,'Owen','owen@owen.com','dog','cat','2018-08-03 11:43:40'),
	(6,'shaza','shaza@gmail.com','dog','dog','2018-08-03 11:44:11'),
	(7,'nani','nani@nani.com','mew','lol','2018-08-03 11:49:12'),
	(8,'lol','lol@lol.com','lol','lol','2018-08-03 11:49:56'),
	(9,'spectrum','ah@ah.com','ah','ho','2018-08-03 11:50:18'),
	(10,'girl','girl@girl.com','girl','boy','2018-08-03 11:50:33'),
	(11,'boy','boy@boy.com','boy','hello','2018-08-03 11:51:11'),
	(12,'loop','array@array.com','keke','hehe','2018-08-03 11:51:27'),
	(13,'strings','string@string.com','striingssss','xiannnsss','2018-08-03 11:51:51'),
	(14,'profile','profile@profile.com','profiles','lol','2018-08-03 11:52:14'),
	(15,'racial','racial@racial.com','hha','hhao','2018-08-03 11:52:33'),
	(16,'goodboy','goodboy@goodboy.com','goood','gouuuuddd','2018-08-03 11:53:11'),
	(17,'joghn','john@gmail.com','john is sick','help','2018-08-03 11:53:39'),
	(18,'richie','richie@riche.com','i missmy dog','can someone help me','2018-08-03 11:54:08'),
	(19,'danial','daniel@daniel.com','daniel is sick','help daniel my dog','2018-08-03 11:55:12'),
	(20,'human','human@detroit.com','blue blood','my dog is becoming a deviant','2018-08-03 11:55:42'),
	(21,'kelly','kelly@lim.com','book appointment','is there a package which i can sign up for?','2018-08-03 11:56:24'),
	(22,'asdfasdf','2asdAS@asd.com','sdf','sdf','2018-08-10 10:32:12');

-- /*!40000 ALTER TABLE `contact` ENABLE KEYS */;
-- UNLOCK TABLES;


# Dump of table forum_posts
# ------------------------------------------------------------

-- DROP TABLE IF EXISTS `forum_posts`;

CREATE TABLE forum_posts (
  post_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  topic_id int(11) NOT NULL,
  post_text text NOT NULL,
  post_create_time datetime NOT NULL,
  post_owner varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- LOCK TABLES `forum_posts` WRITE;
-- /*!40000 ALTER TABLE `forum_posts` DISABLE KEYS */;

INSERT INTO forum_posts
VALUES
	(1,1,'Please help he is starving','2018-08-03 10:11:59','owenlee22@gmail.com'),
	(2,1,'Just buy cat food','2018-08-03 10:12:14','owenlee22@gmail.com'),
	(3,2,'He very smelly','2018-08-03 10:12:32','owenlee22@gmail.com'),
	(4,3,'just kill it','2018-08-03 11:47:42','123@456.com'),
	(5,3,'dint','2018-08-03 11:47:54','123@456.com'),
	(6,4,'i am hungry','2018-08-03 11:57:52','123@456.com'),
	(7,5,'my dog doesnt bark at all omg','2018-08-03 11:58:35','123@456.com'),
	(8,6,'which dog food should i get','2018-08-03 11:59:02','123@456.com'),
	(9,7,'i really love corg but i also love shiba i cant make up my minds','2018-08-03 12:01:57','penguin@penguin.com'),
	(10,8,'what do you guys recommend ','2018-08-03 12:02:24','penguin@penguin.com'),
	(11,9,'hello guys how are y','2018-08-03 12:02:39','penguin@penguin.com'),
	(12,10,'my pet is getting very sick and idk what to do','2018-08-03 12:03:01','penguin@penguin.com'),
	(13,11,'his shit is wet wet one not solid at all. isit normal','2018-08-03 13:12:41','wei_xun@gmail.com'),
	(14,12,'my cat hates supermarket pet food so can i make food for him','2018-08-03 13:13:27','wei_xun@gmail.com'),
	(15,13,'should i get a new one?','2018-08-03 13:13:52','wei_xun@gmail.com'),
	(16,14,'any recommendation of vets?','2018-08-03 13:14:43','wei_xun@gmail.com'),
	(17,15,'what should i do???','2018-08-03 13:17:41','danny@gmail.com'),
	(18,16,'can i get them back, is there a way to clone it','2018-08-03 13:24:30','penguin@gmail.com'),
	(19,17,'my dog keep saying zucc idk  waht it meaans','2018-08-03 13:26:33','penguin@gmail.com'),
	(20,18,'i love my keke very much, but he doesnt seem like he likes my affection. what am i doing wrong','2018-08-03 13:30:37','penguin@gmail.com'),
	(21,19,'help me choose :(','2018-08-03 13:33:32','penguin@gmail.com'),
	(22,20,'i heard that roboto is good but not in all cases so how?','2018-08-03 13:41:10','danny@gmail.com'),
	(23,20,'asdfdsf','2018-08-07 15:33:11','owenlee22@gmail.com');

-- /*!40000 ALTER TABLE `forum_posts` ENABLE KEYS */;
-- UNLOCK TABLES;


# Dump of table forum_topics
# ------------------------------------------------------------

-- DROP TABLE IF EXISTS `forum_topics`;

CREATE TABLE forum_topics (
  topic_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  topic_title varchar(150) NOT NULL,
  topic_create_time datetime NOT NULL,
  topic_owner varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- LOCK TABLES `forum_topics` WRITE;
-- /*!40000 ALTER TABLE `forum_topics` DISABLE KEYS */;

INSERT INTO forum_topics
VALUES
	(1,'How do i feed my pet','2018-08-03 10:11:59','owenlee22@gmail.com'),
	(2,'How to shower my dog','2018-08-03 10:12:32','owenlee22@gmail.com'),
	(3,'How to i kill my pet','2018-08-03 11:47:42','123@456.com'),
	(4,'how do i eat my cat','2018-08-03 11:57:52','123@456.com'),
	(5,'Check out my amazing dog','2018-08-03 11:58:35','123@456.com'),
	(6,'Dog food','2018-08-03 11:59:02','123@456.com'),
	(7,'what dog should i get for my first pet','2018-08-03 12:01:57','penguin@penguin.com'),
	(8,'which cat should i adopt','2018-08-03 12:02:24','penguin@penguin.com'),
	(9,'hello','2018-08-03 12:02:39','penguin@penguin.com'),
	(10,'i am very stress with my pet','2018-08-03 12:03:01','penguin@penguin.com'),
	(11,'My dog cannot shit','2018-08-03 13:12:41','wei_xun@gmail.com'),
	(12,'Can i make food for my cat','2018-08-03 13:13:27','wei_xun@gmail.com'),
	(13,'i love my cats','2018-08-03 13:13:52','wei_xun@gmail.com'),
	(14,'my guinea pigs are not feeling well','2018-08-03 13:14:43','wei_xun@gmail.com'),
	(15,'my pet rabbit is giving birth','2018-08-03 13:17:41','danny@gmail.com'),
	(16,'i miss my old pets','2018-08-03 13:24:30','penguin@gmail.com'),
	(17,'what is ZUCC','2018-08-03 13:26:33','penguin@gmail.com'),
	(18,'i love my kekekekekekeke','2018-08-03 13:30:37','penguin@gmail.com'),
	(19,'husky or german shepherd','2018-08-03 13:33:32','penguin@gmail.com'),
	(20,'how many times can i wash my dog in a month','2018-08-03 13:41:10','danny@gmail.com');

-- /*!40000 ALTER TABLE `forum_topics` ENABLE KEYS */;
-- UNLOCK TABLES;


# Dump of table newsletter
# ------------------------------------------------------------

-- DROP TABLE IF EXISTS `newsletter`;

CREATE TABLE newsletter (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- LOCK TABLES `newsletter` WRITE;
-- /*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;

INSERT INTO newsletter
VALUES
	(1,'penguin@penguin.com'),
	(2,'tingzhen3003@gmail.com'),
	(3,'danny@gmail.com'),
	(4,'asdf@asd.com'),
	(5,'peewd@gmail.com'),
	(6,'asd@dsa.com'),
	(7,'hello@hello.com'),
	(8,'hello@lol.com'),
	(9,'really@omg.com'),
	(10,'haha@gmail.com'),
	(11,'lol@hotmail.com'),
	(12,'haha@keke.com'),
	(13,'poppy@pop.com'),
	(14,'haha@kok.com'),
	(15,'toh@me.com'),
	(16,'ilovemykeke@gmail.com'),
	(17,'wed@klock.com'),
	(18,'hello@bye.com'),
	(19,'john@apple.com'),
	(20,'yes@no.com');

-- /*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
-- UNLOCK TABLES;


# Dump of table pets
# ------------------------------------------------------------

DROP TABLE IF EXISTS pets;

CREATE TABLE pets (
  id int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  petname varchar(20) DEFAULT NULL,
  age varchar(11) DEFAULT NULL,
  species varchar(20) DEFAULT NULL,
  breed varchar(20) DEFAULT NULL,
  image longblob,
  owner_email varchar(50) DEFAULT NULL,
  likes int(11) DEFAULT NULL,
  dislikes int(11) DEFAULT NULL,
  voter varchar(100) DEFAULT NULL,
  pic longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- LOCK TABLES `pets` WRITE;
-- /*!40000 ALTER TABLE `pets` DISABLE KEYS */;

INSERT INTO pets
VALUES
	(1,'Tan','12','Dog','Shiba',X'342E6A7067','owenlee22@gmail.com',0,0,NULL,NULL),
	(4,'Koufu','6','Cat','White',X'686561646572362E6A7067','tan@gmail.com',1,0,NULL,NULL),
	(5,'Desmond','5','Frog','Snack',X'312E6A7067','tan@gmail.com',1,0,NULL,NULL),
	(6,'Tan','55','Dog','Shiba',X'342E6A7067','owenlee22@gmail.com',0,0,NULL,NULL),
	(8,'meow','12','Dog','Shiba','','123@456.com',0,0,NULL,NULL),
	(9,'kook','9','dog','shiba',X'342E6A7067','danny@gmail.com',2,0,NULL,NULL),
	(10,'ron','2','cat','ragdoll',X'332E6A7067','danny@gmail.com',0,0,NULL,NULL),
	(11,'maxwell','8','dog','german shepherd',X'332E6A7067','danny@gmail.com',0,0,NULL,NULL),
	(12,'shy inu','12','cat','persian','','shy@shy.com',0,0,NULL,NULL),
	(13,'cook','9','rabbit','furball',X'312E6A7067','shy@shy.com',1,0,NULL,NULL),
	(14,'smol','1','guinea pig','hamster','','shy@shy.com',0,0,NULL,NULL),
	(15,'doggie','12','dog','corgi','','fila@lim.com',0,0,NULL,NULL),
	(16,'lucky','9','rabbit','holland lop','','fila@lim.com',0,0,NULL,NULL),
	(17,'Dave','6','rabbit','english lop','','fila@lim.com',0,0,NULL,NULL),
	(18,'penguin','10','dog','chihuahua','','tingzhen3003@hotmail.com',0,0,NULL,NULL),
	(19,'ash','9','cat','siamese','','tingzhen3003@hotmail.com',0,0,NULL,NULL),
	(20,'bloop','12','guinea pig','skinny pig','','tingzhen3003@hotmail.com',0,0,NULL,NULL);
-- /*!40000 ALTER TABLE `pets` ENABLE KEYS */;
-- UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

-- DROP TABLE IF EXISTS `users`;

CREATE TABLE users (
  user_id mediumint(8) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  first_name varchar(20) NOT NULL,
  last_name varchar(40) NOT NULL,
  email varchar(60) NOT NULL,
  pass char(40) NOT NULL,
  registration_date datetime NOT NULL,
  admin int(11) DEFAULT NULL,
  image longblob,
  voted int(11) DEFAULT NULL,
  image_name varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- LOCK TABLES `users` WRITE;
-- /*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO users
VALUES
	(11,'Test','User','test@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 09:36:43',NULL,X'342E6A7067',NULL,NULL),
	(12,'David','Lee','test@123.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 10:19:21',NULL,X'342E6A7067',NULL,NULL),
	(13,'Owen','Lee','123@456.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 11:45:45',NULL,'',NULL,NULL),
	(14,'pen','guin','penguin@penguin.com','73335c221018b95c013ff3f074bd9e8550e8d48e','2018-08-03 12:00:58',NULL,X'322E6A7067',NULL,NULL),
	(15,'wei xun','low','wei_xun@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 13:11:09',NULL,'',NULL,NULL),
	(16,'danny','lavito','danny@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 13:16:13',NULL,'',NULL,NULL),
	(17,'penguin','low','penguin@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 13:22:11',NULL,'',NULL,NULL),
	(18,'shy','martin','shy@shy.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:02:01',NULL,'',NULL,NULL),
	(19,'fila','lim','fila@lim.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:16:03',NULL,'',NULL,NULL),
	(20,'Low','TingZhen','tingzhen3003@hotmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:23:08',NULL,'',NULL,NULL),
	(21,'jackie','tan','jakie@tan.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:32:31',NULL,'',NULL,NULL),
	(22,'farq','faqr@far.com','farq@hotmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:33:13',NULL,'',NULL,NULL),
	(23,'reynard','tan','reynard@tan.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:33:40',NULL,'',NULL,NULL),
	(24,'malone','post','malone@post.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:34:43',NULL,'',NULL,NULL),
	(25,'genie','tan','genie@tan.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:35:33',NULL,'',NULL,NULL),
	(26,'dandan','sim','dan@dan.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:36:26',NULL,'',NULL,NULL),
	(27,'zhi feng','tan','zhi@feng.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:37:12',NULL,'',NULL,NULL),
	(28,'shaza','faruq','shaza@faruq.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:37:49',NULL,'',NULL,NULL),
	(29,'benny','jun hui','benny@junhui.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-03 14:38:14',NULL,'',NULL,NULL),
	(30,'Owen','Lee','olivialeejm@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-07 15:31:46',NULL,'',NULL,NULL),
	(31,'Owen','ads','what@you.want','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-10 10:44:12',NULL,X'342E6A7067',NULL,NULL),
	(32,'what','shutup','o@o.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-10 10:45:03',NULL,'',NULL,NULL),
	(33,'asd','dsa','321@123.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','2018-08-10 10:47:06',NULL,X'322E6A7067',NULL,NULL);

-- /*!40000 ALTER TABLE `users` ENABLE KEYS */;
-- UNLOCK TABLES;-- 
DELETE FROM USERS WHERE USER_ID = 37;
select * from users;


-- /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
-- /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
-- /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
