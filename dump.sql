-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: dbname
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB-1:10.3.27+maria~focal-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,0,'Bread & Bakery','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi gravida magna libero, a tristique justo tempus eget. Vestibulum tincidunt, sem nec vulputate iaculis, lectus orci venenatis mauris, et interdum mauris risus ut lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi. Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie. Proin quis tincidunt leo. In lobortis, nulla eu euismod ornare, sem lorem imperdiet quam, in congue justo arcu sit amet neque. Sed eu mauris nisi.'),(2,0,'Milk','Mauris fringilla dolor eu tortor sagittis, quis blandit lacusa rhoncus. Aliquam vel metus non nulla condimentum bibengdum quis at mi.'),(11,0,'Meat','Morbi gravida magna libero, a tristique justo tempus eget. Vestibulum tincidunt, sem nec vulputate iaculis, lectus orci venenatis mauris, et interdum mauris risus ut lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi. Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie.'),(12,0,'Vegetables & Fruits','Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie. Proin quis tincidunt leo. In lobortis, nulla eu euismod ornare, sem lorem imperdiet quam, in congue justo arcu sit amet neque.'),(13,0,'Sweeties','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi gravida magna libero, a tristique justo tempus eget. Vestibulum tincidunt, sem nec vulputate iaculis, lectus orci venenatis mauris, et interdum mauris risus ut lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi. Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie. Proin quis tincidunt leo. In lobortis, nulla eu euismod ornare, sem lorem imperdiet quam, in congue justo arcu sit amet neque. Sed eu mauris nisi.'),(14,1,'Bread Sticks','Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quisa at mi.'),(15,1,'Lavash','Morbi gravida magna libero, a tristique justo tempus eget. Vestibulum tincidunt, sem nec vulputate iaculis, lectus orci venenatis mauris, et interdum mauris risus ut lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi. Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie.'),(16,12,'Fresh Fruits','Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi.'),(17,12,'Fresh Vegetables','Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie. Proin quis tincidunt leo. In lobortis, nulla eu euismod ornare, sem lorem imperdiet quam, in congue justo arcu sit amet neque.'),(18,1,'Brown, White','Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie. Proin quis tincidunt leo. In lobortis, nulla eu euismod ornare, sem lorem imperdiet quam, in congue justo arcu sit amet neque.'),(19,18,'Whole Wheat','Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi. Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie.'),(20,0,'Alcohol','Morbi gravida magna libero, a tristique justo tempus eget. Vestibulum tincidunt, sem nec vulputate iaculis, lectus orci venenatis mauris, et interdum mauris risus ut lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi. Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie.'),(21,0,'Cleaning','Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi.'),(26,16,'Bananas','Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie. Proin quis tincidunt leo. In lobortis, nulla eu euismod ornare, sem lorem imperdiet quam, in congue justo arcu sit amet neque.'),(28,26,'Red bananas','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi gravida magna libero, a tristique justo tempus eget. Vestibulum tincidunt, sem nec vulputate iaculis, lectus orci venenatis mauris, et interdum mauris risus ut lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris fringilla dolor eu tortor sagittis, quis blandit lacus rhoncus. Aliquam vel metus non nulla condimentum bibendum quis at mi. Suspendisse et justo est. Praesent nec diam vulputate, euismod enim id, ultrices nibh. Quisque elementum velit eget nibh viverra molestie. Proin quis tincidunt leo. In lobortis, nulla eu euismod ornare, sem lorem imperdiet quam, in congue justo arcu sit amet neque. Sed eu mauris nisi.');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-12 16:54:01
