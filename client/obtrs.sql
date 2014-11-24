-- MySQL dump 10.13  Distrib 5.5.27, for Win32 (x86)
--
-- Host: localhost    Database: obtrs
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `bus`
--

DROP TABLE IF EXISTS `bus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus` (
  `busid` int(11) NOT NULL AUTO_INCREMENT,
  `busregno` varchar(10) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `bustype` varchar(20) DEFAULT NULL,
  `fare` int(11) DEFAULT NULL,
  PRIMARY KEY (`busid`),
  UNIQUE KEY `busregno` (`busregno`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus`
--

LOCK TABLES `bus` WRITE;
/*!40000 ALTER TABLE `bus` DISABLE KEYS */;
INSERT INTO `bus` VALUES (1,NULL,5,'AC',40),(2,NULL,2,'AC',30),(3,NULL,10,'AC',40),(4,NULL,10,'NON-AC',30),(5,NULL,10,'NON-AC',30),(6,NULL,4,'AC',40),(7,NULL,10,'NON-AC',30),(8,NULL,10,'AC',40),(9,NULL,10,'NON-AC',30);
/*!40000 ALTER TABLE `bus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route` (
  `routeid` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(40) NOT NULL,
  `destination` varchar(40) NOT NULL,
  `distance` int(11) DEFAULT NULL,
  PRIMARY KEY (`routeid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` VALUES (1,'delhi','chandigarh',100),(2,'patiala','amritsar',200),(3,'jaipur','ahmedabad',600),(4,'agra','delhi',100),(5,'jaipur','agra',500),(9,'jaipur','delhi',300);
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule` (
  `routeid` int(11) NOT NULL DEFAULT '0',
  `busid` int(11) NOT NULL DEFAULT '0',
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `monday` int(11) DEFAULT NULL,
  `tuesday` int(11) DEFAULT NULL,
  `wednesday` int(11) DEFAULT NULL,
  `thursday` int(11) DEFAULT NULL,
  `friday` int(11) DEFAULT NULL,
  `saturday` int(11) DEFAULT NULL,
  `sunday` int(11) DEFAULT NULL,
  PRIMARY KEY (`routeid`,`busid`),
  KEY `busid` (`busid`),
  CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`routeid`) REFERENCES `route` (`routeid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`busid`) REFERENCES `bus` (`busid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (1,2,'10:00:00','20:00:00',1,0,1,0,1,0,1),(2,1,'18:00:00','08:00:00',1,1,1,1,0,0,0),(2,3,'05:30:00','20:00:00',0,1,0,1,0,1,1),(2,7,'13:00:00','23:00:00',0,1,1,1,1,0,1),(3,4,'12:30:00','20:00:00',0,1,1,0,0,0,0),(4,5,'04:00:00','18:30:00',1,1,0,0,0,1,1),(4,9,'15:30:00','04:00:00',1,1,0,1,1,1,0),(5,6,'10:00:00','23:30:00',1,0,0,0,0,1,1),(9,8,'20:30:00','10:00:00',0,1,1,0,1,1,0);
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `ticketid` int(11) NOT NULL AUTO_INCREMENT,
  `busid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `departuredate` date DEFAULT NULL,
  `seat1` int(11) DEFAULT '0',
  `seat2` int(11) DEFAULT '0',
  `seat3` int(11) DEFAULT '0',
  `passenger1` varchar(40) DEFAULT NULL,
  `passenger2` varchar(40) DEFAULT NULL,
  `passenger3` varchar(40) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `no_of_seats` int(11) DEFAULT '0',
  `bookingdate` date DEFAULT NULL,
  PRIMARY KEY (`ticketid`),
  KEY `busid` (`busid`),
  KEY `userid` (`userid`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`busid`) REFERENCES `bus` (`busid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (6,9,1,'2013-11-15',1,2,3,'jottie','shottie','pottie',1590,3,'2013-11-15'),(8,9,1,'2013-11-15',3,0,0,'kjl','','',530,1,'2013-11-15'),(19,2,13,'2013-11-18',1,2,0,'pp','ffffffffffffffffffff','',1060,2,'2013-11-15'),(20,9,1,'2013-11-15',4,5,0,'a','b','',1060,2,'2013-11-15');
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email_id` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'a','b','ab@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(2,'c','d','cd@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Female',NULL,'normal'),(3,'e','f','ef@yahoo.com','e807f1fcf82d132f9bb018ca6738a19f','Female',NULL,'normal'),(4,'g','h','gh@yahoo.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(5,'i','j','ij@yahoo.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(6,'r','s','rs@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(7,'aa','bb','aabb@yahoo.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(8,'q','w','qw@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(9,'x','y','xy@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(10,'j','k','jk@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(11,'shahzad','alam','shah@gg','25d55ad283aa400af464c76d713c07ad','Male',NULL,'normal'),(12,'l','m','lm@yahoo.com','e807f1fcf82d132f9bb018ca6738a19f','Female',NULL,'normal'),(13,'h','k','hk@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(14,'p','m','pm@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(15,'q','w','qw@yahoo.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(17,'x','y','xyz@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male',NULL,'normal'),(19,'aj','kl','ajkl@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-11-05','normal'),(20,'aa','ww','pq@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-11-03','normal'),(21,'aj','qw','aj@hotmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-11-06','normal'),(22,'adminA','admin','adminA@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-11-01','admin'),(23,'adminB','admin','adminB@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-11-01','admin'),(24,'qw','er','qwrer@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-11-08','normal'),(25,'surbhi','aggarwal','surbhiagg964@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Female','1993-09-28','normal'),(26,'vv','ag','vkaggarwal2@ff','e807f1fcf82d132f9bb018ca6738a19f','Male','1959-10-06','normal'),(27,'h','i','hih@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-11-03','normal'),(28,'q','k','qq@qq','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-11-07','normal'),(29,'Shashwat','Aggarwal','shashwat4699@gmail.com','dc677ef7574e4b7e0954be562d72ff0c','Male','1999-06-04','normal'),(30,'s','aaa','sagg@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','Male','2013-10-03','normal');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-15 20:57:26
