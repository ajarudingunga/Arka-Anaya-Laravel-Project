-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sample
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `daily_cuisine`
--

DROP TABLE IF EXISTS `daily_cuisine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_cuisine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuisine_day` varchar(50) DEFAULT NULL,
  `cuisine_time` varchar(50) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `cuisine_status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_cuisine`
--

LOCK TABLES `daily_cuisine` WRITE;
/*!40000 ALTER TABLE `daily_cuisine` DISABLE KEYS */;
INSERT INTO `daily_cuisine` VALUES (8,'Monday','Dinner',62,'1'),(9,'Friday','Lunch',62,'1'),(10,'Friday','Dinner',62,'1');
/*!40000 ALTER TABLE `daily_cuisine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cart` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5088 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (5084,40,'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:14;a:3:{s:3:\"qty\";i:1;s:5:\"price\";i:30;s:4:\"item\";O:8:\"stdClass\":10:{s:2:\"id\";i:14;s:12:\"product_name\";s:12:\"French Fries\";s:13:\"product_price\";i:30;s:17:\"product_old_price\";i:0;s:19:\"product_description\";s:2:\"--\";s:19:\"product_category_id\";i:20;s:12:\"product_type\";s:3:\"Veg\";s:17:\"product_image_url\";s:36:\"6eb9c673d90ed5b10f4055e698ae5824.jpg\";s:14:\"product_status\";i:1;s:8:\"featured\";N;}}}s:8:\"totalQty\";i:1;s:10:\"totalPrice\";i:30;}','2017-03-09 07:04:15','2017-03-09 01:34:15'),(5085,40,'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:26;a:3:{s:3:\"qty\";i:1;s:5:\"price\";i:30;s:4:\"item\";O:8:\"stdClass\":10:{s:2:\"id\";i:26;s:12:\"product_name\";s:13:\"Nylon Dhokala\";s:13:\"product_price\";i:30;s:17:\"product_old_price\";i:0;s:19:\"product_description\";s:1:\"-\";s:19:\"product_category_id\";i:16;s:12:\"product_type\";s:3:\"Veg\";s:17:\"product_image_url\";s:36:\"eedbd5f995f4b04ac00ef9858fdace24.jpg\";s:14:\"product_status\";i:1;s:8:\"featured\";s:1:\"1\";}}}s:8:\"totalQty\";i:1;s:10:\"totalPrice\";i:30;}','2017-03-09 07:04:44','2017-03-09 01:34:44'),(5086,40,'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:26;a:3:{s:3:\"qty\";i:1;s:5:\"price\";i:30;s:4:\"item\";O:8:\"stdClass\":10:{s:2:\"id\";i:26;s:12:\"product_name\";s:13:\"Nylon Dhokala\";s:13:\"product_price\";i:30;s:17:\"product_old_price\";i:0;s:19:\"product_description\";s:1:\"-\";s:19:\"product_category_id\";i:16;s:12:\"product_type\";s:3:\"Veg\";s:17:\"product_image_url\";s:36:\"eedbd5f995f4b04ac00ef9858fdace24.jpg\";s:14:\"product_status\";i:1;s:8:\"featured\";s:1:\"1\";}}}s:8:\"totalQty\";i:1;s:10:\"totalPrice\";i:30;}','2017-03-09 07:05:23','2017-03-09 01:35:23'),(5087,40,'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:13;a:3:{s:3:\"qty\";i:2;s:5:\"price\";i:80;s:4:\"item\";O:8:\"stdClass\":10:{s:2:\"id\";i:13;s:12:\"product_name\";s:22:\"Fafdi Gathiya & Jalebi\";s:13:\"product_price\";i:40;s:17:\"product_old_price\";i:0;s:19:\"product_description\";s:32:\"Gujarati mast mast fafda gathiya\";s:19:\"product_category_id\";i:16;s:12:\"product_type\";s:3:\"Veg\";s:17:\"product_image_url\";s:36:\"eda94d04fdec5fb33dd2519c30de4be6.jpg\";s:14:\"product_status\";i:1;s:8:\"featured\";s:1:\"1\";}}}s:8:\"totalQty\";i:2;s:10:\"totalPrice\";i:80;}','2017-03-09 07:06:45','2017-03-09 01:36:45');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `resetId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(35) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`resetId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES (1,'ajarudin.gunga@letsnurture.com','423ae5f80f7fb05f52bae98db487971d183a15fc3eb8a41a5350c5fa19283ed8','2017-02-27 23:44:41',NULL);
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `amount` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (83,40,'2017-03-09 01:34:15','2017-03-09 07:04:15',30,5084),(84,40,'2017-03-09 01:34:45','2017-03-09 07:04:45',30,5085),(85,40,'2017-03-09 01:35:23','2017-03-09 07:05:23',30,5086),(86,40,'2017-03-09 01:36:45','2017-03-09 07:06:45',80,5087);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) DEFAULT NULL,
  `product_price` int(20) DEFAULT NULL,
  `product_old_price` int(20) DEFAULT NULL,
  `product_description` text,
  `product_category_id` int(10) DEFAULT NULL,
  `product_type` varchar(50) DEFAULT NULL,
  `product_image_url` text,
  `product_status` int(1) NOT NULL DEFAULT '1',
  `featured` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_category_id` (`product_category_id`),
  KEY `product_name` (`product_name`),
  KEY `product_type` (`product_type`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (13,'Fafdi Gathiya & Jalebi',40,0,'Gujarati mast mast fafda gathiya',16,'Veg','eda94d04fdec5fb33dd2519c30de4be6.jpg',1,'1'),(14,'French Fries',30,0,'--',20,'Veg','6eb9c673d90ed5b10f4055e698ae5824.jpg',1,NULL),(15,'5 Star Chocolate',10,0,'-',19,'Veg','d535e2d2dfecc42bfc178503973cb51d.jpg',1,NULL),(16,'Balaji Tomato Wafer',10,0,'-',18,'Veg','0fea6b8ae613de1d2a6d4ed33a953c9f.jpg',1,NULL),(17,'Manchurian Rice',40,0,'-',14,'Veg','abd7d19195fc4cd1d2703e81bd6db250.jpg',1,NULL),(18,'Balaji Chataka Pataka',10,0,'-',18,'Veg','75c7967749b1bd5cb26f2047d8813bec.jpg',1,NULL),(19,'Masala Dosa',50,0,'-',15,'Veg','16066922a41214000bc874da4607db40.jpg',1,NULL),(20,'Chocolate Creame Cone',25,0,'-',19,'Veg','6c4c1ad9a6b63704e8829eac238b1677.jpg',1,NULL),(21,'Corn Masala Sabji',60,0,'--',21,'Veg','9dc11a7c00501eacc41d3b347a3dc00f.jpg',1,NULL),(22,'Dahi Purin',30,0,'-',12,'Veg','2ca9bdb79a38cd81bcd57d8c1a9dd61f.jpg',1,NULL),(23,'Dairy Milk Roast Almond',50,0,'-',19,'Veg','859145a3a7e781fb4170a0895eb2df4c.jpg',1,NULL),(24,'Dal Pakwan',20,0,'-',16,'Veg','54208305cf75f5ff8257e4f780bf8b9a.jpg',1,NULL),(25,'Chocolate  Dessert',90,0,'-',19,'Veg','a571e543595af243ce4bb8eef163da41.jpg',1,NULL),(26,'Nylon Dhokala',30,0,'-',16,'Veg','eedbd5f995f4b04ac00ef9858fdace24.jpg',1,'1'),(27,'Italian Pizza (M-size)',80,0,'-',20,'Veg','875112545ec43ac933ecb86b7da4e434.jpg',1,NULL),(28,'Veg Sandwich ',30,0,'-',20,'Veg','1e121aed3ad77c9dfa37930acbfbe477.jpg',1,NULL),(29,'Puff',10,0,'-',16,'Veg','38dffe0d8d18639afaadd42b6927a3a8.jpg',1,NULL),(30,'ChocoBar',15,0,'-',19,'Veg','f57fe5f246bb2b368f61889490a827f6.jpg',1,NULL),(31,'Blaji Farali Chevado',10,0,'-',18,'Veg','bcc4a12b2334af3ee003aab4e82a2887.jpg',1,NULL),(32,'Alu Pakoda',20,0,'-',16,'Veg','73cccf0225680e57f65173c9acd578c0.jpg',1,NULL),(33,'Bhaji Pau',50,0,'-',17,'Veg','0c56e1690e707bec780a71c733e381a9.jpg',1,NULL),(34,'Dahi',10,0,'-',17,'Veg','110e1e54fd27047f31e4475603eb6b3a.jpg',1,NULL),(35,'Chiness Bhel',50,0,'-',14,'Veg','c003df1c60bdcecf0982a09f2e0dd667.jpg',1,NULL),(36,'Cake 500.gm',230,0,'-',19,'Veg','a16a4253379ab5b293ee5cceaecbbc72.jpg',1,NULL),(37,'Bhajiya',30,0,'-',16,'Veg','42b1d0a54b94fe5e8d5f0b05c7a1b3ce.jpg',1,NULL),(38,'Dabeli',20,0,'-',20,'Veg','1969c44e43143817ebcf370756b2b1ad.JPG',1,NULL),(39,'Alu Tiki',40,0,'-\r\n',20,'Veg','c5b66210193dee4052cfd678d3c091ee.jpg',1,NULL),(40,'Samosa',20,0,'-',16,'Veg','436ea83e5e68455fcdade384f931ca13.jpg',1,'1'),(41,'Maggy',20,0,'-',20,'Veg','b26b48381b29e77f375bcf3ac7e930ad.JPG',1,NULL),(42,'Ghughara',20,0,'-',16,'Veg','4b51a804c97449f3d7ef5f6e0178845d.jpg',1,NULL),(43,'Manchurian Dry',50,0,'-',14,'Veg','3fcf6e733ab3ffeb777f53bad12f4c0f.jpg',1,NULL),(44,'Thepala 4-Nos',20,0,'-',16,'Veg','7f157747d4b31bc5e77c9b1e87c022f6.jpg',1,'1'),(45,'Noodles',40,0,'-',14,'Veg','85a3e0c1744297333e3f5cdd2942a986.jpg',1,NULL),(46,'Idli Sambhar',40,0,'-',15,'Veg','ebed2206c7b6bccb0fd0899b2333345a.jpg',1,NULL),(47,'Roti 5-Nos',30,0,'-',17,'Veg','5d02d70e9e843e135bf5d12b715b90c1.jpg',1,NULL),(48,'Havmor Choco Cup',20,0,'-\r\n',19,'Veg','35530513a8b4a7257a0dcf5d935963f7.jpg',1,NULL),(49,'Havmor American Nuts Cup',20,0,'-\r\n',19,'Veg','743a40c3dd6909140a75e136ee4d1ab2.jpg',1,NULL),(50,'Shahi Anjir Cup',30,0,'-\r\n',19,'Veg','62de94a7c66079043bbd00b25077890a.jpg',1,'1'),(51,'Paper Dosa',40,0,'-\r\n',15,'Veg','d1c65515e3b668e0ddf4a654a911aafc.jpg',1,NULL),(52,'Fafada',30,0,'-',16,'Veg','e98eb82e285e00660290d5c76e9b14e5.jpg',1,NULL),(53,'Puri 6-Nos',20,0,'-',17,'Veg','699a7945ba390e100fbce7f0f241e644.jpg',1,NULL),(54,'Pani Puri',15,0,'-',12,'Veg','6e8b2dc04819c0c4cf6a9b556851217d.jpg',1,NULL),(55,'Papdi chat',30,0,'-',12,'Veg','321e8a9dc65fa2e22beca31670b524a8.jpg',1,'1'),(56,'Pauva',20,0,'-',16,'Veg','bad85ed77bc3da7ded58706764cdbbaf.jpg',1,NULL),(57,'Gujju Bhel',30,0,'-',12,'Jain','061194959f989f3b1917995ca32dbfd5.jpg',1,NULL),(58,'Matar Panir Sabji',70,0,'-',21,'Veg','47f7ca582f29044239333d7f580e5b62.JPG',1,NULL),(59,'Coca Cola Tin',20,0,'-',1,'Veg','ae3b94cb6dbad876d08e5cd752fd9054.png',1,NULL),(60,'Mango Fruity',10,0,'-',1,'Veg','540df0b20596fbd6a6c22779c78a5360.jpg',1,NULL),(61,'Fanta Bottel',10,0,'-',1,'Veg','12b5148c83ff10bf293aaa3cdf2d8e58.jpeg',1,NULL),(62,'Dinner Plate',60,0,'Kadhi,Khichadi\r\n2-Sabji\r\n4-Roti\r\nGhee Gol\r\nButtermilk\r\nPapad\r\nSalad',22,'Veg','da13fc00ec960b148c6d5b586297f5d2.jpg',1,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(70) DEFAULT NULL,
  `category_desc` varchar(255) DEFAULT NULL,
  `category_active_status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `category_name` (`category_name`),
  KEY `category_desc` (`category_desc`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (1,'Soft-Drinks','contain all beverages type Item ',1),(12,'Chat','demo',1),(14,'Chiness','chiness categories ok',1),(15,'South-Indian','have south dishes',1),(16,'Morning-Meal','Morning Items',1),(17,'Gujarati','Gujrati Items',1),(18,'Packet-Food','Packet food items',1),(19,'Ice Cream & Chocolates','All ice-creame verities ',1),(20,'Fast-Food','All fast foods items',1),(21,'Punjab Ka Tadka','punjabi Verities',1),(22,'Cuisines','all items under this comes in cuisine category',0);
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recharge_transaction`
--

DROP TABLE IF EXISTS `recharge_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recharge_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enrollment` bigint(50) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`enrollment`)
) ENGINE=InnoDB AUTO_INCREMENT=10026 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recharge_transaction`
--

LOCK TABLES `recharge_transaction` WRITE;
/*!40000 ALTER TABLE `recharge_transaction` DISABLE KEYS */;
INSERT INTO `recharge_transaction` VALUES (10004,140043131005,150,'1','2017-03-01 08:02:39','2017-03-01 13:32:39'),(10005,140043131005,500,'1','2017-03-01 08:02:58','2017-03-01 13:32:58'),(10006,0,545,'0','2017-03-01 08:11:21','2017-03-01 13:41:21'),(10007,140043131005,150,'1','2017-03-01 08:11:51','2017-03-01 13:41:51'),(10008,140043131001,150,'0','2017-03-01 08:12:25','2017-03-01 13:42:25'),(10009,140043131005,500,'1','2017-03-01 08:12:36','2017-03-01 13:42:36'),(10010,14545,5,'0','2017-03-01 08:13:26','2017-03-01 13:43:26'),(10011,140043131005,450,'1','2017-03-01 08:13:41','2017-03-01 13:43:41'),(10012,0,654,'0','2017-03-02 00:35:45','2017-03-02 06:05:45'),(10013,130200107107,130,'0','2017-03-02 00:38:42','2017-03-02 06:08:42'),(10014,130540107100,500,'0','2017-03-02 00:38:59','2017-03-02 06:08:59'),(10015,0,561,'0','2017-03-02 01:38:43','2017-03-02 07:08:43'),(10016,0,654,'0','2017-03-02 01:39:20','2017-03-02 07:09:20'),(10017,140065464,120,'0','2017-03-02 04:32:20','2017-03-02 10:02:20'),(10018,21545465,321845,'0','2017-03-02 04:32:27','2017-03-02 10:02:27'),(10019,151254,3214,'0','2017-03-02 04:32:32','2017-03-02 10:02:32'),(10020,140043131005,120,'1','2017-03-02 04:32:52','2017-03-02 10:02:52'),(10021,140043131000,250,'0','2017-03-03 00:05:22','2017-03-03 05:35:22'),(10022,50254,5654,'0','2017-03-03 00:05:31','2017-03-03 05:35:31'),(10023,140043131005,500,'1','2017-03-07 07:21:12','2017-03-07 12:51:12'),(10024,211584,321,'0','2017-03-08 07:01:04','2017-03-08 12:31:04'),(10025,140043131005,50,'1','2017-03-08 23:08:46','2017-03-09 04:38:46');
/*!40000 ALTER TABLE `recharge_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_data`
--

DROP TABLE IF EXISTS `user_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(100) DEFAULT NULL,
  `user_lastname` varchar(100) DEFAULT NULL,
  `user_mobileno` varchar(20) DEFAULT NULL,
  `user_department` varchar(200) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `user_resiatcapus` int(1) DEFAULT NULL,
  `user_address` text,
  `user_city` varchar(70) DEFAULT NULL,
  `user_postcode` varchar(7) DEFAULT NULL,
  `user_balance` int(20) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_data`
--

LOCK TABLES `user_data` WRITE;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` VALUES (5,40,'Ajarudin','Gunga','9904132640','IT Enginnering','Staff',1,'Near towera','Nikawa','360311',3710,'2017-03-10 06:14:48','2017-02-24 04:11:55'),(6,41,'Ajarudin','Gunga','9904132640','Computer Science & Enginnering','Student',0,'Near tower','Nikava','360311',0,'2017-02-27 13:25:47','2017-02-27 07:55:47'),(7,42,'Sejad d','sPatani','99047166102','Computer Science & Enginnering','Student',1,'s sd','dfsa dfvc','360311',0,'2017-02-28 05:06:14','2017-02-27 23:36:14');
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `authProvider` enum('Facebook','Twitter','Normal') DEFAULT 'Normal',
  `enrollment` bigint(50) unsigned NOT NULL,
  `firstName` varchar(35) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(254) NOT NULL,
  `status` enum('-1','1','0') NOT NULL DEFAULT '1',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `enrollment` (`enrollment`),
  KEY `enrollment_2` (`enrollment`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Normal',140043131111,'Manan','manan@letsnurture.com','$2y$10$iCava0H0hUWjiyQiz1haVONBsqPtXxTWJKaKUqclDDsw4zJq0Z5Se','YWbtb5x8GqXWrfmlkSvXsdQjXTEYnsBqd3u7tIIE5EylnXB5iJlATYpaU4su','1','0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,'Normal',140043131005,'Ajarudin','ajarudin.gunga@letsnurture.com','$2y$10$a89.30zhmuvkVwCEbNTXfO0cZrnKyM/HWZwTQrrDxFEU9ru/WYu8.','bNyFMgbBCprhSID4pp3iNLi8gJf54L4ClcsoaShO7zdvAC9zWX3UxZJN1ijM','1','2017-02-24 09:41:55','0000-00-00 00:00:00'),(41,'Normal',140043131006,' Gunga','admin@gmail.com','$2y$10$uwB2yhnNLBN4mfqGO1cnSerJl7ixciKTolVm.orCnBxb5qloScX1i','','1','2017-02-27 13:25:46','0000-00-00 00:00:00'),(42,'Normal',140043131008,'Sejad d','sp@gmail.com','$2y$10$sRk3C6i0ZVXCFbY8Rq279uTALjFrsVgk9GZ.Iu1cZhi3sukw8qP4e','','0','2017-02-28 05:06:14','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_log`
--

DROP TABLE IF EXISTS `users_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_log` (
  `logId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userIp` varchar(35) CHARACTER SET latin1 DEFAULT NULL,
  `browserInfo` text CHARACTER SET latin1,
  `loginTime` datetime DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('-1','1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`logId`),
  KEY `userId` (`userId`),
  CONSTRAINT `users_log_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_log`
--

LOCK TABLES `users_log` WRITE;
/*!40000 ALTER TABLE `users_log` DISABLE KEYS */;
INSERT INTO `users_log` VALUES (6,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 09:42:15','2017-02-24 04:12:15','1'),(7,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 09:45:33','2017-02-24 04:15:33','1'),(8,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 10:11:14','2017-02-24 04:41:14','1'),(9,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 10:13:52','2017-02-24 04:43:52','1'),(10,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 10:15:27','2017-02-24 04:45:27','1'),(11,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 10:31:02','2017-02-24 05:01:02','1'),(12,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 10:36:55','2017-02-24 05:06:55','1'),(13,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 10:37:47','2017-02-24 05:07:47','1'),(14,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 10:41:17','2017-02-24 05:11:17','1'),(15,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 10:56:13','2017-02-24 05:26:13','1'),(16,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 11:14:58','2017-02-24 05:44:58','1'),(17,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-02-24 11:15:52','2017-02-24 05:45:52','1'),(18,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-27 04:22:09','2017-02-26 22:52:09','1'),(19,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-27 05:01:29','2017-02-26 23:31:29','1'),(20,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-27 05:55:15','2017-02-27 00:25:15','1'),(21,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-27 05:59:07','2017-02-27 00:29:07','1'),(22,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-27 06:02:47','2017-02-27 00:32:47','1'),(23,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-27 09:36:33','2017-02-27 04:06:33','1'),(24,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 04:31:36','2017-02-27 23:01:36','1'),(25,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 05:43:35','2017-02-28 00:13:35','1'),(26,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 05:44:00','2017-02-28 00:14:00','1'),(27,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 06:39:03','2017-02-28 01:09:03','1'),(28,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 06:40:35','2017-02-28 01:10:35','1'),(29,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 06:40:54','2017-02-28 01:10:54','1'),(30,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 06:43:12','2017-02-28 01:13:12','1'),(31,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 06:48:36','2017-02-28 01:18:36','1'),(32,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 06:48:52','2017-02-28 01:18:52','1'),(33,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 06:49:23','2017-02-28 01:19:23','1'),(34,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 07:07:39','2017-02-28 01:37:39','1'),(35,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 09:03:19','2017-02-28 03:33:19','1'),(36,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 10:20:50','2017-02-28 04:50:50','1'),(37,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 10:21:21','2017-02-28 04:51:21','1'),(38,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 10:23:06','2017-02-28 04:53:06','1'),(39,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 11:12:05','2017-02-28 05:42:05','1'),(40,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-02-28 12:53:14','2017-02-28 07:23:14','1'),(41,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-01 04:21:54','2017-02-28 22:51:54','1'),(42,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-02 04:25:36','2017-03-01 22:55:36','1'),(43,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-02 06:32:29','2017-03-02 01:02:29','1'),(44,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-02 12:09:47','2017-03-02 06:39:47','1'),(45,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-03 05:12:44','2017-03-02 23:42:44','1'),(46,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-03 06:00:18','2017-03-03 00:30:18','1'),(47,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-03-03 10:55:54','2017-03-03 05:25:54','1'),(48,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-03 11:22:51','2017-03-03 05:52:51','1'),(49,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 04:27:36','2017-03-05 22:57:36','1'),(50,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 04:29:30','2017-03-05 22:59:30','1'),(51,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 05:15:42','2017-03-05 23:45:42','1'),(52,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 05:18:41','2017-03-05 23:48:41','1'),(53,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 05:47:45','2017-03-06 00:17:45','1'),(54,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 05:50:32','2017-03-06 00:20:32','1'),(55,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 06:23:40','2017-03-06 00:53:40','1'),(56,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 06:25:45','2017-03-06 00:55:45','1'),(57,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 06:55:47','2017-03-06 01:25:47','1'),(58,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 06:56:29','2017-03-06 01:26:29','1'),(59,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 07:13:16','2017-03-06 01:43:16','1'),(60,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 11:42:23','2017-03-06 06:12:23','1'),(61,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 12:30:04','2017-03-06 07:00:04','1'),(62,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-06 12:31:36','2017-03-06 07:01:36','1'),(63,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-07 09:48:27','2017-03-07 04:18:27','1'),(64,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-07 10:18:21','2017-03-07 04:48:21','1'),(65,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-07 12:50:54','2017-03-07 07:20:54','1'),(66,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-07 12:51:52','2017-03-07 07:21:52','1'),(67,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-08 05:35:39','2017-03-08 00:05:39','1'),(68,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-08 06:19:39','2017-03-08 00:49:39','1'),(69,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-08 10:42:04','2017-03-08 05:12:04','1'),(70,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-08 11:23:11','2017-03-08 05:53:11','1'),(71,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-03-08 13:10:50','2017-03-08 07:40:50','1'),(72,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-09 04:37:28','2017-03-08 23:07:28','1'),(73,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-03-09 04:38:36','2017-03-08 23:08:36','1'),(74,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-09 05:57:50','2017-03-09 00:27:50','1'),(75,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-09 07:04:09','2017-03-09 01:34:09','1'),(76,40,'127.0.0.1','\"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:51.0) Gecko\\/20100101 Firefox\\/51.0\"','2017-03-10 05:08:48','2017-03-09 23:38:48','1'),(77,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-03-10 06:20:30','2017-03-10 00:50:30','1'),(78,1,'127.0.0.1','\"Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\"','2017-03-10 06:35:09','2017-03-10 01:05:09','1');
/*!40000 ALTER TABLE `users_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_role`
--

DROP TABLE IF EXISTS `users_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_role` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `roleType` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0 for admin, 1 for user',
  `moduleAccess` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL,
  `status` enum('-1','1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`roleId`),
  KEY `userId` (`userId`),
  CONSTRAINT `users_role_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_role`
--

LOCK TABLES `users_role` WRITE;
/*!40000 ALTER TABLE `users_role` DISABLE KEYS */;
INSERT INTO `users_role` VALUES (5,1,'0','','2016-11-17 11:26:30','0000-00-00 00:00:00','1'),(36,40,'1','','2017-02-24 09:41:55','0000-00-00 00:00:00','1'),(37,41,'1','','2017-02-27 13:25:46','0000-00-00 00:00:00','1'),(38,42,'1','','2017-02-28 05:06:14','0000-00-00 00:00:00','1');
/*!40000 ALTER TABLE `users_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-11 12:30:23
