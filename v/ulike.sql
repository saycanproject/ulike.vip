-- MariaDB dump 10.19  Distrib 10.11.3-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ulike
-- ------------------------------------------------------
-- Server version	10.11.3-MariaDB-1

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
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `bizname` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','pending','rejected') NOT NULL DEFAULT 'pending',
  `extra_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_info`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `member_id_index` (`member_id`),
  CONSTRAINT `business_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business`
--

LOCK TABLES `business` WRITE;
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
INSERT INTO `business` VALUES
(1,1,'又来®地摊连锁','又来® 地摊连锁业务模式是打造一个全新的街头摊贩运营模式，通过集中采购、统一管理、智能化运营,实现地摊品牌化，打造一个线上线下相结合的街头摊贩生态系统。我们将与摆地摊的个体建立合伙人关系，提供各种主要由个性化，标准化，文创类，手链和饰品，礼品，用品。家饰，车饰等精挑细选的商品，并通过我们的网站支持，人源支持，使得摆地摊的个体商贩能够更便捷、更高效、更优质的服务他们的客户。<br>\r\n计划实施：<br>\r\n1, 集中采购。\r\n我们将通过集中采购的方式，以较低的成本采购优质的商品，为街头摊贩提供更具竞争力的价格和更高品质的产品。这将大大降低街头摊贩的进货成本，并使他们能够提供更有吸引力的商品。<br>\r\n2，统一管理。\r\n我们将对摆地摊的个体商贩进行统一管理，包括摊位的规划、布局和设计，品牌形象和宣传，供应链和库存管理等方面。这将使得街头摊贩的运营更具规模化，提高运营效率和服务质量。<br>\r\n3，智能化运营。\r\n我们将通过互联网、大数据、人工智能等技术手段，实现智能化运营，包括客户管理、订单处理、供应链管理、数据分析和预测等方面，提高运营效率和决策能力。<br>\r\n4，数据化运营。\r\n我们将通过建立数据化运营平台，实现收支记录、客户管理、营销推广等方面的数据化管理，为投资者提供透明、可信的信息。','pending','{\"grand_total_target\":\"50000\",\"can_exceed\":\"0\",\"min_funding\":\"1000\",\"max_funding\":\"10000\",\"handlers\":\"1\"}','2023-08-10 05:30:17'),
(2,1,'又来®同城服务','又来®同城服务致力于构建一个线上线下相结合的同城服务生态系统。我们将通过微信、抖音等社交软件建立同城流量引流，实现生活服务信息互动式传播,为客人和客户搭建起一座桥梁，提供全方位的服务。我们可提供主要的服务包括但不限于:<br>\r\n家电(手机、电脑、电视、洗衣机、冰箱等)<br>\r\n家政(代看宠物，清洁服务等)<br>\r\n教培（幼教，补习，专业培训等）<br>\r\n装修（家装，店装等）<br>\r\n汽车（销售，保养，培训等）<br>\r\n康养康健（健康咨询，上门护理，健身，瑜伽，舞蹈等）<br>\r\n商务服务（法律咨询，会计服务，广告公关等)<br>\r\n技术服务（IT支持，网络维护，软件开发，AI服务等）<br>\r\n公共服务（婚庆，交通，公共设施维护，政府机关服务等）<br>\r\n其它（休闲，美食，美护，租赁等）<br><br>\r\n业务模式：<br>\r\n我们的业务模式主要包括社交软件的流量池建立、生活服务信息的互动式传播、生活服务提供商库的构建、用户订单与在线服务资源的精准匹配、派单系统、用户评价体系和服务质量监控机制等。我们将与服务提供者建立合伙人关系，为他们提供丰富的服务资源，帮助他们提高服务质量和效率。<br>\r\n信息管理：<br>\r\n我们将建立健全的信息管理系统，包括服务提供者信息库、客户信息库、服务订单管理、客户反馈处理等。我们还将对服务提供者进行统一管理，包括服务提供者的认证、服务质量的监控、客户反馈的处理等。通过信息系统的管理，我们将实现服务的高效配送，保证服务的及时性和准确性。<br>\r\n盈利模式：<br>\r\n我们的主要盈利方式包括服务提供商的推广费、平台抽成(暂无)、广告服务等。通过用户运营、生态运营，我们将实现用户规模增长和平台价值最大化。<br>\r\n前景愿景：<br>\r\n随着互联网的发展，同城服务市场的潜力越来越大。我们将凭借我们的专业团队、优化的管理系统和创新的运营模式，帮助客户和服务提供者实现价值最大化，赢得市场的认可。我们立志成为领先的本地生活服务综合平台，通过技术和服务创新，帮助人们享受便捷、高效的生活服务体验，让生活更简单。','pending','{\"grand_total_target\":\"50000\",\"can_exceed\":\"0\",\"min_funding\":\"1000\",\"max_funding\":\"10000\",\"handlers\":\"1\"}','2023-08-10 05:32:49'),
(3,1,'又来®网络科技','又来®网络科技是又来®平台下一个战略发展网络公司，在起步阶段我们运营实体门店或小型公司，提供微信小程序开发，网站制作，软件开发，人工智能，以及手机电脑销售，维修等服务。我们的目标是通过成立一家能自给自足的门店或公司，为又来®平台内部提供软件和技术支持，对外部发展高级软件开发和服务。<br><br>\r\n运营模式及展望：<br>\r\n我们的运营理念和模式为立足本地，服务全球！根据实际情况和发展可以分为三个阶段。<br>\r\n1, 通过本地基础销售和服务使公司得以维持，这些项目可包括但不限于：<br>\r\n手机电脑销售和维修，提供全方位的手机电脑销售和维修服务，包括新机销售、二手交易、硬件维修、软件更新等，满足客户全方位的电子产品需求。<br>\r\n打印设计和广告，包括照片打印，文件打印，LOGO设计，宣传单设计，广告制作，广告文案撰写等。<br>\r\n微信开发，微信小程序开发，支付接口开发<br>\r\n网站制作，提供专业的网站设计和开发服务，包括企业网站、电商网站。<br><br>\r\n\r\n2, 通过扩展和高级服务使公司得以发展壮大，这些项目主要针对公司服务可包括但不限于：<br>\r\n定制化的软件开发服务，包括商业软件、管理软件、教育软件等，满足客户多元化的软件需求。<br>\r\n人工智能解决方案，包括机器学习、深度学习、自然语言处理等，帮助客户利用人工智能技术提高业务效率和价值。<br>\r\n电子商务解决方案，提供电子商务网站设计和开发服务。提供电子商务策略咨询和优化。<br>\r\n数字营销服务，搜索引擎优化（SEO）,社交媒体推广，管理和广告，内容营销，网络分析和报告等。<br><br>\r\n\r\n3, 成为公司自身的核心和基础，公司自身的程序架构和开发团体，成为专业和知名的开发和服务公司。<br>\r\n远期目标和愿景。。。<br><br>\r\n\r\n盈利模式:<br>\r\n如上所诉，又来®网络科技的定位重点非盈利而是发展。但我们的初期盈利模式可包括产品销售，服务收费和广告推广等。我们将通过提供优质的服务和产品，吸引客户，增加公司的收入。同时，我们也将通过广告推广，提高公司的知名度和影响力，吸引更多的客户和合作伙伴。我们同时承诺，在初期阶段，一旦你投资又来®网络科技， 你将被视为又来®平台的初创和战略发展人员，在又来®平台发展壮大后将享有相应的投资份额红利和权利。<br><br>\r\n\r\n前景展望:<br>\r\n随着互联网的普及和科技的发展，网络科技服务的需求越来越大。我们将凭借我们的专业技术、优质服务和创新理念，把握市场机遇，探索更多的业务领域和发展可能性，努力成为网络科技服务行业的领导者。','pending','{\"grand_total_target\":\"120000\",\"can_exceed\":\"1\",\"min_funding\":\"10000\",\"max_funding\":\"100000\",\"handlers\":\"1\"}','2023-08-10 05:34:10');
/*!40000 ALTER TABLE `business` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capital`
--

DROP TABLE IF EXISTS `capital`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_id` (`member_id`),
  CONSTRAINT `capital_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capital`
--

LOCK TABLES `capital` WRITE;
/*!40000 ALTER TABLE `capital` DISABLE KEYS */;
INSERT INTO `capital` VALUES
(1,2,20200.00),
(3,1,975600.00);
/*!40000 ALTER TABLE `capital` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funding`
--

DROP TABLE IF EXISTS `funding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `extra_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_info`)),
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `business_id_index` (`business_id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `funding_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `funding_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funding`
--

LOCK TABLES `funding` WRITE;
/*!40000 ALTER TABLE `funding` DISABLE KEYS */;
INSERT INTO `funding` VALUES
(1,2,1,2000.00,'pending',NULL,'2023-08-10'),
(2,2,1,1250.00,'pending',NULL,'2023-08-11'),
(3,2,1,1250.00,'pending',NULL,'2023-08-11'),
(4,2,1,1500.00,'pending',NULL,'2023-08-11'),
(5,2,2,3800.00,'pending',NULL,'2023-08-12'),
(6,1,3,20000.00,'pending',NULL,'2023-08-12'),
(7,1,1,2000.00,'pending',NULL,'2023-08-12'),
(8,1,1,1200.00,'pending',NULL,'2023-08-13'),
(9,1,1,1200.00,'pending',NULL,'2023-08-13');
/*!40000 ALTER TABLE `funding` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` char(60) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `role` set('a','b','c','d','e','f','x','y','z') NOT NULL DEFAULT 'f',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES
(1,'hu','$2y$10$mzo7lYsTykFZqZDCNjEPm.Cr6xqxtvTgrM7DAdX3OcMFhW3ToBkeW','huyimin@hotmail.com','627350','approved',NULL,'a,c,f','2023-08-10 04:33:24'),
(2,'测试','$2y$10$uQF1ip82EqbRu7FLwZcKG.BdwvdGlP1aO6VqVz20SpaubJNOU.OmO','papino@sina.cn','704432','pending','{\"applyCreateBusiness\":{\"status\":\"y\",\"timestamp\":\"2023-08-13 01:00:04\"}}','f','2023-08-10 06:00:40'),
(3,'测试2','$2y$10$czjLKK5.AlEIogDU21BI4uX1bFD06xpxTNQ.YbfxdG9hKwNp2CnnG','sobest@gmail.com','332739','pending','{\"applyCreateBusiness\":{\"status\":\"y\",\"timestamp\":\"2023-08-11 21:53:56\"}}','f','2023-08-10 09:10:51');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `category` enum('income','expense') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `extra_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_info`)),
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `business_id_index` (`business_id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `records_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `records_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` VALUES
(1,1,1,'income',200.00,'营收',NULL,'2023-08-10'),
(2,1,1,'income',600.00,'营收',NULL,'2023-08-10'),
(3,1,1,'income',86.00,'营收',NULL,'2023-08-11'),
(4,1,1,'income',85.00,'营收',NULL,'2023-08-11'),
(5,1,1,'income',37.00,'营收',NULL,'2023-08-11');
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relation`
--

DROP TABLE IF EXISTS `relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relation` (
  `member_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`,`business_id`),
  KEY `relation_member_id_index` (`member_id`),
  KEY `relation_business_id_index` (`business_id`),
  CONSTRAINT `relation_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relation_ibfk_2` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relation`
--

LOCK TABLES `relation` WRITE;
/*!40000 ALTER TABLE `relation` DISABLE KEYS */;
INSERT INTO `relation` VALUES
(1,1),
(1,2),
(1,3);
/*!40000 ALTER TABLE `relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `json_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_options`)),
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES
(1,'1',1,'approved','{\"grand_total_target\":\"50000\",\"handlers\":\"1\",\"can_exceed\":0}'),
(2,'2',1,'pending','{\"grand_total_target\":\"50000\",\"handlers\":\"1\",\"can_exceed\":0}'),
(3,'3',1,'pending','{\"grand_total_target\":\"120000\",\"handlers\":\"1\",\"can_exceed\":1}');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-13 23:44:40
