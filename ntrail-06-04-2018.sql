-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ntrail
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `nt_accesslevel`
--

DROP TABLE IF EXISTS `nt_accesslevel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_accesslevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` text,
  `permissions` text,
  `level` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_accesslevel`
--

LOCK TABLES `nt_accesslevel` WRITE;
/*!40000 ALTER TABLE `nt_accesslevel` DISABLE KEYS */;
INSERT INTO `nt_accesslevel` VALUES (1,'User','Default role assigned to registered accounts.','3,6',0),(2,'System Admin','Can do everything except dangerous system stuff','29,30,36,37,20,9,34,38,2,8,4,42,3,10,6,5,41,32,40',10),(6,'Super Admin','Can do anything','1',20);
/*!40000 ALTER TABLE `nt_accesslevel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_availability`
--

DROP TABLE IF EXISTS `nt_availability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_availability`
--

LOCK TABLES `nt_availability` WRITE;
/*!40000 ALTER TABLE `nt_availability` DISABLE KEYS */;
INSERT INTO `nt_availability` VALUES (1,'Private',10),(3,'Public',30);
/*!40000 ALTER TABLE `nt_availability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_block`
--

DROP TABLE IF EXISTS `nt_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` int(11) DEFAULT '0',
  `position` int(11) DEFAULT '0',
  `title` varchar(128) DEFAULT NULL,
  `content` text,
  `show_content_only` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_block`
--

LOCK TABLES `nt_block` WRITE;
/*!40000 ALTER TABLE `nt_block` DISABLE KEYS */;
INSERT INTO `nt_block` VALUES (4,1,0,'Sample Block','<p>This is a sample block.</p>\r\n<p>Blocks can be set to display on the left or right of the home page.</p>',0,0),(6,1,1,'Test, No Heading','<p>Blocks can also be displayed without the header and frame, like this one.</p>',1,1);
/*!40000 ALTER TABLE `nt_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_bug_tracker`
--

DROP TABLE IF EXISTS `nt_bug_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_bug_tracker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timeraised` int(11) DEFAULT NULL,
  `raiserid` int(11) NOT NULL,
  `comment` text,
  `priority` int(11) DEFAULT NULL,
  `fixed` int(11) DEFAULT '0',
  `timefixed` int(11) DEFAULT NULL,
  `fixerid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_bug_tracker`
--

LOCK TABLES `nt_bug_tracker` WRITE;
/*!40000 ALTER TABLE `nt_bug_tracker` DISABLE KEYS */;
INSERT INTO `nt_bug_tracker` VALUES (12,1429089793,7,'<p>add object categories</p>',0,0,NULL,0),(13,1429089843,7,'<p>add list MVC</p>\r\n<p>&bull; build list from objects</p>\r\n<p>&bull; give list a score based on object rarity</p>',0,0,NULL,0),(14,1429169416,7,'<p>add created by to nt_object</p>',0,1,1523003786,7),(15,1429169438,7,'<p>Add nt_object.availability</p>\r\n<p>Availabiliy table created, need to add to nt_object</p>',0,0,NULL,0),(16,1429169512,7,'<p>change page selector on object to be the same as on logs</p>',0,1,1523005162,7),(17,1522921768,7,'<p>Change bug priority to low medium high - colour code bugs.</p>',1,1,1522926899,7),(18,1522925324,7,'<p>Fixed Bug</p>',1,1,1522925395,7),(19,1522925345,7,'<p>Remove OK messages from add / edit / delete bug</p>',1,1,1522926935,7),(20,1522925375,7,'<p>High priority bug</p>\r\n<p>Text editor needs to start with a new file</p>',2,1,1522933539,7),(21,1522925990,7,'<p>Bugs - fixed drop down should just be yes / no</p>',1,1,1522926150,7),(22,1522926270,7,'<p>When adding new bug, priority should default to normal</p>',1,1,1522926946,7);
/*!40000 ALTER TABLE `nt_bug_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_config`
--

DROP TABLE IF EXISTS `nt_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `var` varchar(40) DEFAULT NULL,
  `value` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_config`
--

LOCK TABLES `nt_config` WRITE;
/*!40000 ALTER TABLE `nt_config` DISABLE KEYS */;
INSERT INTO `nt_config` VALUES (1,'allow_registration','0'),(2,'allowed_image_extensions','jpg|png'),(6,'my_test','this is a test value'),(7,'testVar','42');
/*!40000 ALTER TABLE `nt_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_country`
--

DROP TABLE IF EXISTS `nt_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_country`
--

LOCK TABLES `nt_country` WRITE;
/*!40000 ALTER TABLE `nt_country` DISABLE KEYS */;
INSERT INTO `nt_country` VALUES (1,'Afghanistan'),(2,'Aland Islands'),(3,'Albania'),(4,'Algeria'),(5,'American Samoa'),(6,'Andorra'),(7,'Angola'),(8,'Anguilla'),(9,'Antarctica'),(10,'Antigua And Barbuda'),(11,'Argentina'),(12,'Armenia'),(13,'Aruba'),(14,'Australia'),(15,'Austria'),(16,'Azerbaijan'),(17,'Bahamas'),(18,'Bahrain'),(19,'Bangladesh'),(20,'Barbados'),(21,'Belarus'),(22,'Belgium'),(23,'Belize'),(24,'Benin'),(25,'Bermuda'),(26,'Bhutan'),(27,'Bolivia'),(28,'Bosnia And Herzegovina'),(29,'Botswana'),(30,'Bouvet Island'),(31,'Brazil'),(32,'British Indian Ocean Territory'),(33,'Brunei Darussalam'),(34,'Bulgaria'),(35,'Burkina Faso'),(36,'Burundi'),(37,'Cambodia'),(38,'Cameroon'),(39,'Canada'),(40,'Cape Verde'),(41,'Cayman Islands'),(42,'Central African Republic'),(43,'Chad'),(44,'Chile'),(45,'China'),(46,'Christmas Island'),(47,'Cocos (Keeling) Islands'),(48,'Colombia'),(49,'Comoros'),(50,'Congo'),(51,'Congo, The Democratic Republic Of The'),(52,'Cook Islands'),(53,'Costa Rica'),(54,'Cote D\'ivoire'),(55,'Croatia'),(56,'Cuba'),(57,'Cyprus'),(58,'Czech Republic'),(59,'Denmark'),(60,'Djibouti'),(61,'Dominica'),(62,'Dominican Republic'),(63,'Ecuador'),(64,'Egypt'),(65,'El Salvador'),(66,'Equatorial Guinea'),(67,'Eritrea'),(68,'Estonia'),(69,'Ethiopia'),(70,'Falkland Islands (Malvinas)'),(71,'Faroe Islands'),(72,'Fiji'),(73,'Finland'),(74,'France'),(75,'French Guiana'),(76,'French Polynesia'),(77,'French Southern Territories'),(78,'Gabon'),(79,'Gambia'),(80,'Georgia'),(81,'Germany'),(82,'Ghana'),(83,'Gibraltar'),(84,'Greece'),(85,'Greenland'),(86,'Grenada'),(87,'Guadeloupe'),(88,'Guam'),(89,'Guatemala'),(90,'Guernsey'),(91,'Guinea'),(92,'Guinea-bissau'),(93,'Guyana'),(94,'Haiti'),(95,'Heard Island And Mcdonald Islands'),(96,'Holy See (Vatican City State)'),(97,'Honduras'),(98,'Hong Kong'),(99,'Hungary'),(100,'Iceland'),(101,'India'),(102,'Indonesia'),(103,'Iran, Islamic Republic Of'),(104,'Iraq'),(105,'Ireland'),(106,'Isle Of Man'),(107,'Israel'),(108,'Italy'),(109,'Jamaica'),(110,'Japan'),(111,'Jersey'),(112,'Jordan'),(113,'Kazakhstan'),(114,'Kenya'),(115,'Kiribati'),(116,'Korea, Democratic People\'s Republic Of'),(117,'Korea, Republic Of'),(118,'Kuwait'),(119,'Kyrgyzstan'),(120,'Lao People\'s Democratic Republic'),(121,'Latvia'),(122,'Lebanon'),(123,'Lesotho'),(124,'Liberia'),(125,'Libyan Arab Jamahiriya'),(126,'Liechtenstein'),(127,'Lithuania'),(128,'Luxembourg'),(129,'Macao'),(130,'Macedonia, The Former Yugoslav Republic Of'),(131,'Madagascar'),(132,'Malawi'),(133,'Malaysia'),(134,'Maldives'),(135,'Mali'),(136,'Malta'),(137,'Marshall Islands'),(138,'Martinique'),(139,'Mauritania'),(140,'Mauritius'),(141,'Mayotte'),(142,'Mexico'),(143,'Micronesia, Federated States Of'),(144,'Moldova, Republic Of'),(145,'Monaco'),(146,'Mongolia'),(147,'Montenegro'),(148,'Montserrat'),(149,'Morocco'),(150,'Mozambique'),(151,'Myanmar'),(152,'Namibia'),(153,'Nauru'),(154,'Nepal'),(155,'Netherlands'),(156,'Netherlands Antilles'),(157,'New Caledonia'),(158,'New Zealand'),(159,'Nicaragua'),(160,'Niger'),(161,'Nigeria'),(162,'Niue'),(163,'Norfolk Island'),(164,'Northern Mariana Islands'),(165,'Norway'),(166,'Oman'),(167,'Pakistan'),(168,'Palau'),(169,'Palestinian Territory, Occupied'),(170,'Panama'),(171,'Papua New Guinea'),(172,'Paraguay'),(173,'Peru'),(174,'Philippines'),(175,'Pitcairn'),(176,'Poland'),(177,'Portugal'),(178,'Puerto Rico'),(179,'Qatar'),(180,'Reunion'),(181,'Romania'),(182,'Russian Federation'),(183,'Rwanda'),(184,'Saint Helena'),(185,'Saint Kitts And Nevis'),(186,'Saint Lucia'),(187,'Saint Pierre And Miquelon'),(188,'Saint Vincent And The Grenadines'),(189,'Samoa'),(190,'San Marino'),(191,'Sao Tome And Principe'),(192,'Saudi Arabia'),(193,'Senegal'),(194,'Serbia'),(195,'Seychelles'),(196,'Sierra Leone'),(197,'Singapore'),(198,'Slovakia'),(199,'Slovenia'),(200,'Solomon Islands'),(201,'Somalia'),(202,'South Africa'),(203,'South Georgia And The South Sandwich Islands'),(204,'Spain'),(205,'Sri Lanka'),(206,'Sudan'),(207,'Suriname'),(208,'Svalbard And Jan Mayen'),(209,'Swaziland'),(210,'Sweden'),(211,'Switzerland'),(212,'Syrian Arab Republic'),(213,'Taiwan, Province Of China'),(214,'Tajikistan'),(215,'Tanzania, United Republic Of'),(216,'Thailand'),(217,'Timor-leste'),(218,'Togo'),(219,'Tokelau'),(220,'Tonga'),(221,'Trinidad And Tobago'),(222,'Tunisia'),(223,'Turkey'),(224,'Turkmenistan'),(225,'Turks And Caicos Islands'),(226,'Tuvalu'),(227,'Uganda'),(228,'Ukraine'),(229,'United Arab Emirates'),(230,'United Kingdom'),(231,'United States'),(232,'United States Minor Outlying Islands'),(233,'Uruguay'),(234,'Uzbekistan'),(235,'Vanuatu'),(236,'Venezuela'),(237,'Viet Nam'),(238,'Virgin Islands, British'),(239,'Virgin Islands, U.S.'),(240,'Wallis And Futuna'),(241,'Western Sahara'),(242,'Yemen'),(243,'Zambia'),(244,'Zimbabwe');
/*!40000 ALTER TABLE `nt_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_email_template`
--

DROP TABLE IF EXISTS `nt_email_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `content` text,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_email_template`
--

LOCK TABLES `nt_email_template` WRITE;
/*!40000 ALTER TABLE `nt_email_template` DISABLE KEYS */;
INSERT INTO `nt_email_template` VALUES (1,'Test','<p style=\"font-size: 11px; font-weight: normal;\">Hello [[NAME]],</p>\r\n<p style=\"font-size: 11px; font-weight: normal;\">This is a test, please let Jon Williams (<a href=\"mailto:jon.williams@cae.com\">jon.williams@cae.com</a>) know if you recieved this email ok.</p>\r\n<p style=\"font-size: 11px; font-weight: normal;\">&nbsp;</p>\r\n<p style=\"font-size: 11px; font-weight: normal;\">Thank you,</p>\r\n<p style=\"font-size: 11px; font-weight: normal;\">System Admin</p>',1),(2,'Hello','<p>Hello [[NAME]],</p>\r\n<p>This is a test email.</p>\r\n<p>Your fistname is [[FIRSTNAME]]</p>\r\n<p>Your lstname is [[LASTNAME]]</p>\r\n<p>Your email is [[EMAIL]]</p>',3);
/*!40000 ALTER TABLE `nt_email_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_gender`
--

DROP TABLE IF EXISTS `nt_gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_gender`
--

LOCK TABLES `nt_gender` WRITE;
/*!40000 ALTER TABLE `nt_gender` DISABLE KEYS */;
INSERT INTO `nt_gender` VALUES (1,'Male'),(2,'Female');
/*!40000 ALTER TABLE `nt_gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_group`
--

DROP TABLE IF EXISTS `nt_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_group`
--

LOCK TABLES `nt_group` WRITE;
/*!40000 ALTER TABLE `nt_group` DISABLE KEYS */;
INSERT INTO `nt_group` VALUES (1,'Oxford','');
/*!40000 ALTER TABLE `nt_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_group_membership`
--

DROP TABLE IF EXISTS `nt_group_membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_group_membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_group_membership`
--

LOCK TABLES `nt_group_membership` WRITE;
/*!40000 ALTER TABLE `nt_group_membership` DISABLE KEYS */;
/*!40000 ALTER TABLE `nt_group_membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_log`
--

DROP TABLE IF EXISTS `nt_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `action` varchar(128) DEFAULT NULL,
  `data` text,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=499 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_log`
--

LOCK TABLES `nt_log` WRITE;
/*!40000 ALTER TABLE `nt_log` DISABLE KEYS */;
INSERT INTO `nt_log` VALUES (444,7,'delete_user','5: Random Person',1519136195),(445,7,'add_user','8: Test User',1519292249),(446,7,'permanently_delete_user','5: Random Person',1519292266),(447,7,'add_availability','4: TEST',1519296489),(448,7,'update_availability','4: TEST 212',1519296496),(449,7,'delete_availability','4: TEST 212',1519296630),(450,7,'delete_availability','2: Group Only',1519296750),(451,7,'update_trail','1: Test Trail',1519296761),(452,7,'delete_permission','33: manage_groups',1519296930),(453,7,'assign_permissions','2: System Admin',1519297033),(454,7,'update_object','7: Branched Twig',1519297071),(455,7,'add_config_var','3: ',1519301230),(456,7,'add_config_var','4: ',1519301344),(457,7,'edit_config','3:123',1519301553),(458,7,'edit_config','3:123xxx',1519301597),(459,7,'delete_config','3: test123xxx',1519302138),(460,7,'delete_config','4: myVar',1519302146),(461,7,'add_config_var','5: ',1519302166),(462,7,'delete_config','5: deleteme',1519302209),(463,7,'add_config_var','6: ',1519302285),(464,7,'edit_config','6:this is a test value',1519302299),(465,7,'add_config_var','7: Jon Williams',1519302475),(466,7,'add_rarity','8: TEST',1519726775),(467,7,'add_rarity','9: 34',1519728100),(468,7,'update_rarity','0: ',1519730034),(469,7,'add_rarity','10: 23',1519730322),(470,7,'update_rarity','10: 56',1519732292),(471,7,'update_rarity','10: 56',1519732639),(472,7,'update_rarity','10: 56',1519732768),(473,7,'update_rarity','10: 56',1519732846),(474,7,'update_rarity','10: asdfgh',1519732991),(475,7,'update_rarity','10: asdfgh',1519733050),(476,7,'update_rarity','10: RARITY NAME',1519733320),(477,7,'update_rarity','10: RARITY NAME',1519733828),(478,7,'update_rarity','10: RARITY NAME',1519734386),(479,7,'update_rarity','10: RARITY NAME',1519734667),(480,7,'update_rarity','10: RARITY NAME',1519736904),(481,7,'add_rarity','11: 2222222',1519737131),(482,7,'add_rarity','12: 1234',1519737192),(483,7,'delete_rarity','12: 1234',1519737353),(484,7,'delete_rarity','9: 34',1519737380),(485,7,'delete_rarity','8: TEST',1519737386),(486,7,'delete_rarity','11: 2222222',1519737389),(487,7,'update_rarity','10: RARITY NAME xx',1519737420),(488,7,'add_rarity','13: New Item',1519737444),(489,7,'delete_rarity','10: RARITY NAME xx',1519737450),(490,7,'delete_rarity','13: New Item',1519737453),(491,7,'add_rarity','14: TEST',1519737555),(492,7,'update_rarity','14: TEST',1519737574),(493,7,'update_rarity','14: 987',1519737585),(494,7,'delete_rarity','14: 987',1519737590),(495,7,'add_availability','4: 6767',1519738400),(496,7,'update_availability','4: 101',1519738655),(497,7,'update_availability','4: 101',1519739093),(498,7,'delete_availability','4: 101',1519739098);
/*!40000 ALTER TABLE `nt_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_nationality`
--

DROP TABLE IF EXISTS `nt_nationality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_nationality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_nationality`
--

LOCK TABLES `nt_nationality` WRITE;
/*!40000 ALTER TABLE `nt_nationality` DISABLE KEYS */;
INSERT INTO `nt_nationality` VALUES (1,'Afghan'),(2,'Albanian'),(3,'Algerian'),(4,'American'),(5,'Andorran'),(6,'Angolan'),(7,'Antiguans'),(8,'Argentinean'),(9,'Armenian'),(10,'Australian'),(11,'Austrian'),(12,'Azerbaijani'),(13,'Bahamian'),(14,'Bahraini'),(15,'Bangladeshi'),(16,'Barbadian'),(17,'Barbudans'),(18,'Batswana'),(19,'Belarusian'),(20,'Belgian'),(21,'Belizean'),(22,'Beninese'),(23,'Bhutanese'),(24,'Bolivian'),(25,'Bosnian'),(26,'Brazilian'),(27,'British'),(28,'Bruneian'),(29,'Bulgarian'),(30,'Burkinabe'),(31,'Burmese'),(32,'Burundian'),(33,'Cambodian'),(34,'Cameroonian'),(35,'Canadian'),(36,'Cape Verdean'),(37,'Central African'),(38,'Chadian'),(39,'Chilean'),(40,'Chinese'),(41,'Colombian'),(42,'Comoran'),(43,'Congolese'),(44,'Costa Rican'),(45,'Croatian'),(46,'Cuban'),(47,'Cypriot'),(48,'Czech'),(49,'Danish'),(50,'Djibouti'),(51,'Dominican'),(52,'Dutch'),(53,'East Timorese'),(54,'Ecuadorean'),(55,'Egyptian'),(56,'Emirian'),(57,'Equatorial Guinean'),(58,'Eritrean'),(59,'Estonian'),(60,'Ethiopian'),(61,'Fijian'),(62,'Filipino'),(63,'Finnish'),(64,'French'),(65,'Gabonese'),(66,'Gambian'),(67,'Georgian'),(68,'German'),(69,'Ghanaian'),(70,'Greek'),(71,'Grenadian'),(72,'Guatemalan'),(73,'Guinea-Bissauan'),(74,'Guinean'),(75,'Guyanese'),(76,'Haitian'),(77,'Herzegovinian'),(78,'Honduran'),(79,'Hungarian'),(80,'Icelander'),(81,'Indian'),(82,'Indonesian'),(83,'Iranian'),(84,'Iraqi'),(85,'Irish'),(86,'Israeli'),(87,'Italian'),(88,'Ivorian'),(89,'Jamaican'),(90,'Japanese'),(91,'Jordanian'),(92,'Kazakhstani'),(93,'Kenyan'),(94,'Kittian and Nevisian'),(95,'Kuwaiti'),(96,'Kyrgyz'),(97,'Laotian'),(98,'Latvian'),(99,'Lebanese'),(100,'Liberian'),(101,'Libyan'),(102,'Liechtensteiner'),(103,'Lithuanian'),(104,'Luxembourger'),(105,'Macedonian'),(106,'Malagasy'),(107,'Malawian'),(108,'Malaysian'),(109,'Maldivan'),(110,'Malian'),(111,'Maltese'),(112,'Marshallese'),(113,'Mauritanian'),(114,'Mauritian'),(115,'Mexican'),(116,'Micronesian'),(117,'Moldovan'),(118,'Monacan'),(119,'Mongolian'),(120,'Moroccan'),(121,'Mosotho'),(122,'Motswana'),(123,'Mozambican'),(124,'Namibian'),(125,'Nauruan'),(126,'Nepalese'),(127,'Netherlander'),(128,'New Zealander'),(129,'Ni-Vanuatu'),(130,'Nicaraguan'),(131,'Nigerian'),(132,'Nigerien'),(133,'North Korean'),(134,'Northern Irish'),(135,'Norwegian'),(136,'Omani'),(137,'Pakistani'),(138,'Palauan'),(139,'Panamanian'),(140,'Papua New Guinean'),(141,'Paraguayan'),(142,'Peruvian'),(143,'Polish'),(144,'Portuguese'),(145,'Qatari'),(146,'Romanian'),(147,'Russian'),(148,'Rwandan'),(149,'Saint Lucian'),(150,'Salvadoran'),(151,'Samoan'),(152,'San Marinese'),(153,'Sao Tomean'),(154,'Saudi'),(155,'Scottish'),(156,'Senegalese'),(157,'Serbian'),(158,'Seychellois'),(159,'Sierra Leonean'),(160,'Singaporean'),(161,'Slovakian'),(162,'Slovenian'),(163,'Solomon Islander'),(164,'Somali'),(165,'South African'),(166,'South Korean'),(167,'Spanish'),(168,'Sri Lankan'),(169,'Sudanese'),(170,'Surinamer'),(171,'Swazi'),(172,'Swedish'),(173,'Swiss'),(174,'Syrian'),(175,'Taiwanese'),(176,'Tajik'),(177,'Tanzanian'),(178,'Thai'),(179,'Togolese'),(180,'Tongan'),(181,'Trinidadian or Tobagonian'),(182,'Tunisian'),(183,'Turkish'),(184,'Tuvaluan'),(185,'Ugandan'),(186,'Ukrainian'),(187,'Uruguayan'),(188,'Uzbekistani'),(189,'Venezuelan'),(190,'Vietnamese'),(191,'Welsh'),(192,'Yemenite'),(193,'Zambian'),(194,'Zimbabwean');
/*!40000 ALTER TABLE `nt_nationality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_object`
--

DROP TABLE IF EXISTS `nt_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` text,
  `filename` varchar(128) DEFAULT NULL,
  `rarity` int(11) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `timemodified` int(11) DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `timecreated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_object`
--

LOCK TABLES `nt_object` WRITE;
/*!40000 ALTER TABLE `nt_object` DISABLE KEYS */;
INSERT INTO `nt_object` VALUES (1,'Snail Shell','<p>TEST</p>','1_snail.jpg',5,NULL,1523003590,7,1429179151),(2,'Rabbit','<p>Fluffy bunny</p>','2_rabbit.jpg',5,NULL,NULL,7,1523003136),(3,'Deer','<p>TEST</p>','3_deer.jpg',6,NULL,1523003482,7,1429179167),(7,'Branched Twig','<p>A branched twig.</p>','7_twig.jpg',5,NULL,NULL,NULL,1519297303),(19,'Shiny Stone','<p>Any stone that sparkless in the sun.</p>','19_shiny_stone.jpg',7,NULL,NULL,NULL,1429179181),(20,'Moss','<p>Often found on trees - particularly old tree stumps.</p>','20_moss.jpg',6,NULL,NULL,NULL,1429179188),(21,'Feather','','21_feather.jpg',7,NULL,NULL,NULL,1429179201),(22,'Dog','<p>Woof!</p>','22_dog.jpg',4,NULL,NULL,NULL,1429179207),(23,'Alice','<p>A girl called Alice.</p>','23_alice_profile.jpg',3,NULL,NULL,NULL,1519297709),(24,'TEST','<p>TEST</p>','24_fox_front.jpg',1,NULL,NULL,NULL,1523003645),(25,'TEST 2','<p>TEST 2</p>','25_IMG_20160612_155353164.jpg',1,7,NULL,NULL,1523003751);
/*!40000 ALTER TABLE `nt_object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_permissions`
--

DROP TABLE IF EXISTS `nt_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` text,
  `heading` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_permissions`
--

LOCK TABLES `nt_permissions` WRITE;
/*!40000 ALTER TABLE `nt_permissions` DISABLE KEYS */;
INSERT INTO `nt_permissions` VALUES (1,'do_anything','Do anything. Overrides all other permissions.',0,10),(2,'assign_level','Assign users an access level',0,20),(3,'edit_profile','Edit Own Profile',0,20),(4,'edit_all_profiles','Edit all user profiles',0,20),(5,'view_all_profiles','View any user profile',0,20),(6,'upload_profile_image','Upload a profile image',0,20),(8,'delete_user','Delete a user account',0,20),(9,'view_debug','View debug pages',0,10),(10,'undelete_user','Can undelete any user',0,20),(17,'Admin','Admin',1,10),(20,'see_admin_menu','See admin menu',0,10),(28,'Users','Users',1,20),(29,'manage_blocks','Manage blocks',0,10),(30,'manage_bug_tracker','Can add and edit bug reports',0,10),(31,'update_database','Can run the debug/update_database code',0,10),(32,'manage_email_templates','Can manage email templates',0,30),(34,'view_logs','Can view activity logs',0,10),(35,'purge_logs','Can run the purge logs code',0,10),(36,'manage_permissions','Can manage these permissions',0,10),(37,'manage_roles','Can manage user roles',0,10),(38,'add_user','Can manually create a new user account',0,20),(39,'Email','email',1,30),(40,'send_bulk_emails','Can send emails to many users',0,30),(41,'email_user','Can email a single user',0,30),(42,'edit_customer_profiles','Can edit profile of any user with the \'Customer\' role',0,20),(43,'change_config','Make changes to the config table, nt_config',0,10);
/*!40000 ALTER TABLE `nt_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_rarity`
--

DROP TABLE IF EXISTS `nt_rarity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_rarity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_rarity`
--

LOCK TABLES `nt_rarity` WRITE;
/*!40000 ALTER TABLE `nt_rarity` DISABLE KEYS */;
INSERT INTO `nt_rarity` VALUES (1,'Very Rare',10),(3,'Rare',8),(4,'Very Commom',1),(5,'Common',2),(6,'Normal',4),(7,'Unusual',6);
/*!40000 ALTER TABLE `nt_rarity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_sessions`
--

DROP TABLE IF EXISTS `nt_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_sessions`
--

LOCK TABLES `nt_sessions` WRITE;
/*!40000 ALTER TABLE `nt_sessions` DISABLE KEYS */;
INSERT INTO `nt_sessions` VALUES ('fc3ae1e0bf5d281e46568d4ae298923a','::1','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',1523005097,'a:22:{s:9:\"user_data\";s:0:\"\";s:2:\"id\";s:1:\"7\";s:5:\"email\";s:24:\"jonwilliams101@gmail.com\";s:15:\"email_confirmed\";s:1:\"1\";s:8:\"password\";s:32:\"eb5b09925653b99662ea1aefc947c02c\";s:9:\"firstname\";s:3:\"Jon\";s:11:\"middlenames\";s:4:\"Marc\";s:8:\"lastname\";s:8:\"Williams\";s:7:\"knownas\";s:10:\"Riffmonger\";s:11:\"accesslevel\";s:1:\"6\";s:12:\"profileimage\";s:10:\"user_7.jpg\";s:11:\"timecreated\";s:10:\"1406275405\";s:12:\"timemodified\";s:10:\"1519295584\";s:10:\"modifierid\";s:1:\"7\";s:9:\"lastlogin\";s:10:\"1522916492\";s:10:\"lastlogout\";s:10:\"1519305160\";s:6:\"lastip\";s:3:\"::1\";s:18:\"password_reset_key\";N;s:7:\"deleted\";s:1:\"0\";s:9:\"deletedby\";N;s:11:\"timedeleted\";N;s:15:\"url_after_login\";s:40:\"http://localhost/ntrail/bug_tracker/view\";}');
/*!40000 ALTER TABLE `nt_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_trail`
--

DROP TABLE IF EXISTS `nt_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` text,
  `createdby` int(11) DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_trail`
--

LOCK TABLES `nt_trail` WRITE;
/*!40000 ALTER TABLE `nt_trail` DISABLE KEYS */;
INSERT INTO `nt_trail` VALUES (1,'Test Trail','<p>1st Ever Trail</p>',7,1,1429170975),(3,'Test TRAIL','',7,1,1519298001),(4,'Field Walk','',7,1,1519298040);
/*!40000 ALTER TABLE `nt_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_trail_objects`
--

DROP TABLE IF EXISTS `nt_trail_objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_trail_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objectid` int(11) DEFAULT NULL,
  `trailid` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_trail_objects`
--

LOCK TABLES `nt_trail_objects` WRITE;
/*!40000 ALTER TABLE `nt_trail_objects` DISABLE KEYS */;
INSERT INTO `nt_trail_objects` VALUES (1,3,1,NULL),(4,2,1,NULL),(6,22,1,NULL),(7,21,1,NULL),(8,19,3,NULL),(9,21,3,NULL),(10,22,3,NULL),(11,23,3,NULL),(12,1,3,NULL);
/*!40000 ALTER TABLE `nt_trail_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nt_user`
--

DROP TABLE IF EXISTS `nt_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nt_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `email_confirmed` varchar(40) DEFAULT '0',
  `password` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `middlenames` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `knownas` varchar(128) DEFAULT NULL,
  `accesslevel` int(11) DEFAULT '1',
  `profileimage` varchar(128) DEFAULT NULL,
  `timecreated` int(11) DEFAULT NULL,
  `timemodified` int(11) DEFAULT NULL,
  `modifierid` int(11) DEFAULT NULL,
  `lastlogin` int(11) DEFAULT NULL,
  `lastlogout` int(11) DEFAULT NULL,
  `lastip` varchar(20) DEFAULT NULL,
  `password_reset_key` varchar(40) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deletedby` int(11) DEFAULT NULL,
  `timedeleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nt_user`
--

LOCK TABLES `nt_user` WRITE;
/*!40000 ALTER TABLE `nt_user` DISABLE KEYS */;
INSERT INTO `nt_user` VALUES (7,'jonwilliams101@gmail.com','1','eb5b09925653b99662ea1aefc947c02c','Jon','Marc','Williams','Riffmonger',6,'user_7.jpg',1406275405,1519295584,7,1523002451,1519305160,'::1',NULL,0,NULL,NULL),(8,'alice.williams@jwdev.co.uk','0','eb5b09925653b99662ea1aefc947c02c','Test','','User','',1,NULL,1519292249,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `nt_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ntrail'
--

--
-- Dumping routines for database 'ntrail'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-06 10:02:19
