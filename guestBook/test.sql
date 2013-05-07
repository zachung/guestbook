-- MySQL dump 10.13  Distrib 5.1.67, for redhat-linux-gnu (i386)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.1.67

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
-- Table structure for table `mess`
--

DROP TABLE IF EXISTS `mess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mess` (
  `ITEM` int(3) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(10) CHARACTER SET utf8 NOT NULL,
  `CONTENT` varchar(100) CHARACTER SET utf8 NOT NULL,
  `TIME` datetime NOT NULL,
  PRIMARY KEY (`ITEM`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mess`
--

LOCK TABLES `mess` WRITE;
/*!40000 ALTER TABLE `mess` DISABLE KEYS */;
INSERT INTO `mess` VALUES (6,'balanoca','New message after delete msg:1','2013-04-27 18:20:25'),(3,'lenka','my name is lenka','0000-00-00 00:00:00'),(4,'balanoca','54321','2013-04-27 12:06:26'),(9,'??','?????','2013-04-27 18:50:03'),(18,'test','','2013-04-29 02:10:04'),(11,'??','?????','2013-04-27 18:55:28'),(15,'zach','A Taiwanese businessman who fell ill three days after returning from Suzhou in China was confirmed W','2013-04-29 00:59:43'),(13,'123','123','2013-04-27 19:00:00'),(14,'班長','中文測試！','2013-04-27 19:00:00'),(16,'lenka','','2013-04-29 01:42:08'),(17,'lenka','.','2013-04-29 01:42:19'),(19,'Frankie','HIHIHIHI','2013-04-29 02:48:45'),(23,'??','','2013-04-29 05:05:07'),(24,'??','','2013-04-29 05:09:50'),(25,'??','????','2013-04-29 05:20:00');
/*!40000 ALTER TABLE `mess` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-29  5:36:39
