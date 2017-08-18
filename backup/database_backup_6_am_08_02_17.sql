-- MySQL dump 10.13  Distrib 5.6.31-77.0, for Linux (x86_64)
--
-- Host: localhost    Database: minbazu5_coopbank
-- ------------------------------------------------------
-- Server version	5.6.31-77.0-log

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
-- Table structure for table `accounttype`
--

DROP TABLE IF EXISTS `accounttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounttype` (
  `AccountTypeid` int(11) NOT NULL AUTO_INCREMENT,
  `Accounttypename` varchar(50) NOT NULL,
  `InterestRate` float DEFAULT NULL,
  `MinimumBal` float DEFAULT NULL,
  `InterestCalculationDays` int(11) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  `Createdby` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`AccountTypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounttype`
--

LOCK TABLES `accounttype` WRITE;
/*!40000 ALTER TABLE `accounttype` DISABLE KEYS */;
INSERT INTO `accounttype` VALUES (3,'Saving Account',7,500,90,'saving',1,15,'2017-03-27 00:00:00',30,'2017-06-04 07:24:39'),(4,'Current Account',1,1000,365,'current',1,15,'2017-03-27 00:00:00',30,'2017-06-04 07:22:06'),(5,'Student Saving Account(Gullak Yojna)',7,500,90,'saving',1,15,'2017-03-27 00:00:00',30,'2017-06-04 07:23:18'),(6,'Recurring Deposit Account',6,500,90,'Saving',1,30,'2017-06-04 00:00:00',NULL,NULL),(7,'Fixed Deposit Account',8,500,365,'Saving',1,30,'2017-06-04 00:00:00',NULL,NULL),(8,'Super Fixed Deposit Account',12,5000,365,'Saving',1,30,'2017-06-04 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `accounttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bankaccapplication`
--

DROP TABLE IF EXISTS `bankaccapplication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bankaccapplication` (
  `BankAccountAppId` bigint(20) NOT NULL AUTO_INCREMENT,
  `CustomerID` bigint(20) NOT NULL,
  `OpenBalance` float NOT NULL,
  `AccountTypeid` bigint(20) NOT NULL,
  `BranchId` bigint(20) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ApproverId` bigint(20) NOT NULL,
  `ModifiedBy` bigint(20) NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `ApproverRemark` text NOT NULL,
  `Approvaldate` datetime NOT NULL,
  `ApplicationStatus` text NOT NULL,
  `IsDeleted` int(11) NOT NULL,
  `Remarks` text NOT NULL,
  PRIMARY KEY (`BankAccountAppId`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bankaccapplication`
--

LOCK TABLES `bankaccapplication` WRITE;
/*!40000 ALTER TABLE `bankaccapplication` DISABLE KEYS */;
INSERT INTO `bankaccapplication` VALUES (41,62,10000,3,11,33,'2017-04-25 07:16:46',31,31,'0000-00-00 00:00:00','Approved','0000-00-00 00:00:00','approve',0,''),(42,63,5000,3,11,33,'2017-04-28 05:11:26',31,31,'0000-00-00 00:00:00','Approved','0000-00-00 00:00:00','approve',0,''),(43,64,5000,3,11,33,'2017-04-28 06:18:46',31,31,'0000-00-00 00:00:00','Approved','0000-00-00 00:00:00','approve',0,''),(44,62,1000,0,11,33,'2017-05-25 14:37:42',31,31,'0000-00-00 00:00:00','Testing purpose','0000-00-00 00:00:00','approve',0,'');
/*!40000 ALTER TABLE `bankaccapplication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bankaccount`
--

DROP TABLE IF EXISTS `bankaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bankaccount` (
  `AccountId` bigint(20) NOT NULL AUTO_INCREMENT,
  `accountNo` bigint(20) NOT NULL,
  `CustomerID` bigint(20) DEFAULT NULL,
  `OpenDate` date DEFAULT NULL,
  `Balance` double NOT NULL,
  `AccountTypeid` int(11) NOT NULL DEFAULT '0',
  `BranchId` bigint(20) DEFAULT NULL,
  `Active` tinyint(4) DEFAULT '1',
  `BankAccountAppId` bigint(20) DEFAULT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`AccountId`),
  UNIQUE KEY `accountNo` (`accountNo`),
  UNIQUE KEY `CustomerID` (`CustomerID`,`AccountTypeid`),
  KEY `AccountTypeid` (`AccountTypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bankaccount`
--

LOCK TABLES `bankaccount` WRITE;
/*!40000 ALTER TABLE `bankaccount` DISABLE KEYS */;
INSERT INTO `bankaccount` VALUES (15,1000001,62,'0000-00-00',15000,3,11,1,41,31,'0000-00-00 00:00:00',32,'2017-04-25 00:00:00'),(16,1000002,63,'2017-04-28',25000,4,11,1,NULL,31,'2017-04-28 05:12:28',NULL,NULL),(17,1000003,63,'0000-00-00',5000,3,11,1,42,31,'0000-00-00 00:00:00',NULL,NULL),(18,1000004,64,'0000-00-00',5000,3,11,1,43,31,'0000-00-00 00:00:00',NULL,NULL),(19,1000005,62,'0000-00-00',1000,0,11,1,44,31,'0000-00-00 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `bankaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bankaccounttransactions`
--

DROP TABLE IF EXISTS `bankaccounttransactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bankaccounttransactions` (
  `BankAccountTransactionId` bigint(20) NOT NULL AUTO_INCREMENT,
  `BankAccountId` bigint(20) NOT NULL DEFAULT '0',
  `accountNo` bigint(20) DEFAULT NULL,
  `CustomerID` bigint(20) DEFAULT NULL,
  `Deposit` double DEFAULT NULL,
  `Withdraw` double DEFAULT NULL,
  `SenderReceiverAccountNo` bigint(20) DEFAULT NULL,
  `MachineNo` varchar(500) DEFAULT NULL,
  `Transactiondate` datetime NOT NULL,
  `TransactionType` varchar(50) NOT NULL,
  `Transactionmode` varchar(255) NOT NULL,
  `Remarks` varchar(50) DEFAULT NULL,
  `Chequeno` bigint(20) DEFAULT NULL,
  `BankName` varchar(50) DEFAULT NULL,
  `ChequeDate` date DEFAULT NULL,
  `Balance` double DEFAULT NULL,
  `BranchId` bigint(20) DEFAULT NULL,
  `ViaMobile` tinyint(4) DEFAULT NULL,
  `ViaInternet` tinyint(4) DEFAULT NULL,
  `ConfirmOTP` varchar(50) DEFAULT NULL,
  `CreatedBy` bigint(20) DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`BankAccountTransactionId`),
  KEY `BankAccountId` (`BankAccountId`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bankaccounttransactions`
--

LOCK TABLES `bankaccounttransactions` WRITE;
/*!40000 ALTER TABLE `bankaccounttransactions` DISABLE KEYS */;
INSERT INTO `bankaccounttransactions` VALUES (25,15,1000001,62,10000,NULL,NULL,NULL,'2017-04-25 07:17:38','','','Approved',0,'','1970-01-01',10000,NULL,NULL,NULL,NULL,31,0,'0000-00-00 00:00:00'),(26,15,1000001,62,5000,0,NULL,NULL,'2017-04-25 12:00:00','Deposit','cash','Deposited',0,'','1970-01-01',15000,11,NULL,NULL,NULL,32,0,'2017-04-25 00:00:00'),(27,16,1000002,63,25000,NULL,NULL,NULL,'2017-04-28 05:12:28','cash','','qwdefsgbfv',0,'','1970-01-01',25000,NULL,NULL,NULL,NULL,31,0,'0000-00-00 00:00:00'),(28,17,1000003,63,5000,NULL,NULL,NULL,'2017-04-28 06:06:52','','','Approved',0,'','1970-01-01',5000,NULL,NULL,NULL,NULL,31,0,'0000-00-00 00:00:00'),(29,18,1000004,64,5000,NULL,NULL,NULL,'2017-04-28 06:19:05','','','Approved',0,'','1970-01-01',5000,NULL,NULL,NULL,NULL,31,0,'0000-00-00 00:00:00'),(30,19,1000005,62,1000,NULL,NULL,NULL,'2017-05-25 14:38:46','','','Testing purpose',0,'','1970-01-01',1000,NULL,NULL,NULL,NULL,31,0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `bankaccounttransactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `BranchId` bigint(20) NOT NULL AUTO_INCREMENT,
  `BranchName` varchar(105) NOT NULL,
  `BranchAddress` longtext NOT NULL,
  `CityId` bigint(20) NOT NULL,
  `StateId` bigint(20) NOT NULL,
  `RegionId` bigint(20) NOT NULL DEFAULT '0',
  `CountryId` bigint(20) NOT NULL,
  `BranchCode` varchar(50) DEFAULT NULL,
  `bdate` datetime DEFAULT NULL,
  `Active` tinyint(4) DEFAULT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`BranchId`),
  UNIQUE KEY `UQ__Branch__1C61B888CEB8F8D7` (`BranchCode`),
  KEY `CityId` (`CityId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (11,'Thikri','Barwani road, Thikri, Dist- Barwani',9,5,6,8,'003','2017-04-07 00:00:00',0,30,'2017-04-07 20:10:42',30,'2017-06-04 07:09:54'),(13,'Thikri','Barwani road, Thikri, Dist- Barwani',10,5,7,8,'001','2017-01-13 00:00:00',1,30,'2017-06-04 07:06:25',30,'2017-06-04 07:14:25');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `CityId` bigint(20) NOT NULL AUTO_INCREMENT,
  `CityName` varchar(77) NOT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`CityId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (9,'CHANDRAPUR',30,'2017-04-07 00:00:00',NULL,NULL,1),(10,'Barwani',30,'2017-06-04 00:00:00',NULL,NULL,1);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companysetup`
--

DROP TABLE IF EXISTS `companysetup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companysetup` (
  `CompanySetupId` bigint(20) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(255) NOT NULL,
  `CompanyAddress` varchar(255) DEFAULT NULL,
  `registrationno` varchar(101) DEFAULT NULL,
  `phoneno` varchar(50) DEFAULT NULL,
  `companylogo` longblob,
  `footer` varchar(50) DEFAULT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`CompanySetupId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companysetup`
--

LOCK TABLES `companysetup` WRITE;
/*!40000 ALTER TABLE `companysetup` DISABLE KEYS */;
INSERT INTO `companysetup` VALUES (1,'People Development Credit Co-operative bank','Barwani Road, Thikri, Dist- Barwani,(m.p)','ar/br','8224033413','54953-saharalogo.png','abc',1,'2017-02-15 00:00:00',30,'2017-06-04 07:33:35');
/*!40000 ALTER TABLE `companysetup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `CountryId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CountryName` varchar(50) NOT NULL,
  `CreatedBy` bigint(20) unsigned DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` bigint(20) unsigned DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`CountryId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (8,'India',15,'2017-03-27 00:00:00',NULL,NULL,1);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `CustomerID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CustomerNo` bigint(20) DEFAULT NULL,
  `CustomerName` varchar(55) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `AccountDate` date NOT NULL,
  `ResAddress` varchar(255) CHARACTER SET utf8 NOT NULL,
  `OffAddress` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `TelPhoneNo` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `MobileNo` varchar(14) CHARACTER SET utf8 DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Age` int(11) NOT NULL,
  `CityId` bigint(20) NOT NULL,
  `StateId` bigint(20) NOT NULL,
  `CountryId` bigint(20) NOT NULL,
  `EmailID` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pincode` int(11) NOT NULL,
  `MartialStatus` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `SpouseName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `SpouseDOB` date DEFAULT NULL,
  `NomineeName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `NomineeAge` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `NomineeRelation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Religion` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Caste` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Gender` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ApplicantFather` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `FamilyDetails` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `FamilyRelation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `PanCardNo` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `Uidno` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `idtype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `PhotoIdentityNumber` varchar(25) DEFAULT NULL,
  `mphoto` longblob,
  `photoid` longblob,
  `IDProof1` longblob,
  `IDProof2` longblob,
  `CSign` longblob,
  `MemberShipFees` double DEFAULT NULL,
  `BranchId` bigint(20) DEFAULT NULL,
  `memactive` tinyint(4) DEFAULT '0',
  `ActiveBy` bigint(20) NOT NULL,
  `Approval` varchar(50) DEFAULT NULL,
  `ApproverId` bigint(20) DEFAULT NULL,
  `ApproverRemark` varchar(250) DEFAULT NULL,
  `Approvaldate` datetime DEFAULT NULL,
  `LastModifiedBy` bigint(20) DEFAULT NULL,
  `LastModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (62,1,'Vipul Singh','2017-04-23','New para colony','rajajipuram','7905217012','7905217012','1991-01-26',26,9,5,8,'vipul26singh1992@gmail.com',226017,'single','','0000-00-00','','Vipul Singh','',NULL,NULL,'male','','','','sdvcvcd','dcxvc ','Pan  card','sdvxdccvs ','50667-nauk.JPG','64310-nauk.JPG','16048-nauk.JPG','74359-nauk.JPG','8524-nauk.JPG',300,11,1,33,'approve',31,'','2017-04-23 00:00:00',31,'2017-04-23 11:31:48'),(63,2,'Vipul Singh','2017-04-23','New para colony','rajajipuram','7905217012','7905217012','2004-01-14',13,9,5,8,'vipul26singh1992@gmail.com',226017,'','','0000-00-00','Vipul Singh','Vipul Singh','Vipul Singh',NULL,NULL,'male','','','','awdefsdgfvedwswdc v','sqsfdgbfvdsdcvx ','WDASVFCB','WDsfdbgn','97133-nauk.JPG','75058-nauk.JPG','80507-nauk.JPG','44187-nauk.JPG','39273-nauk.JPG',300,11,1,33,'approve',33,'','2017-04-23 00:00:00',33,'2017-04-23 12:08:02'),(64,3,'Vipul Singh','2017-04-23','New para colony','rajajipuram','7905217012','7905217012','2012-01-03',5,9,5,8,'vipul26singh1992@gmail.com',226017,'single','','0000-00-00','Vipul Singh','Vipul Singh','Vipul Singh',NULL,NULL,'male','','','','SADCXVVSDCSXC X','sDSVCXC ','ASDVCVFSDCSX ','ASDSFGGDCV B','54330-nauk.JPG','9380-nauk.JPG','20259-nauk.JPG','10139-nauk.JPG','99165-nauk.JPG',300,11,1,33,'approve',33,'','2017-04-23 00:00:00',33,'2017-04-23 12:08:08'),(65,4,'Ravi','2017-04-25','New para colony','rajajipuram','7905217012','07905217012','2013-05-06',3,9,5,8,'vipul26singh1992@gmail.com',226017,'single','','0000-00-00','Vipul Singh','Vipul Singh','Vipul Singh',NULL,NULL,'male','','','','adsfvdc ','sadfvc','aedsfvc ','adsfvc ','77652-4338-avatar2.png','56953-4338-avatar2.png','65480-4338-avatar2.png','78652-4338-avatar2.png','57489-4338-avatar2.png',500,11,1,31,'approve',31,'','2017-04-25 00:00:00',31,'2017-04-25 07:08:42'),(66,NULL,'Gorabai Koli','2017-07-13','Gram-Kerva','Gram-Kerva, Post-Kuwa, Thehsil-Thikri, ','','7354350865','1962-01-01',55,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Kadva Koli','0000-00-00','Kadva Koli','','Husband',NULL,NULL,'female','','','Husband','APQRS8562D','982452271235','123456789','123456789','94495-scanner_20170713_093814.jpg','67502-New Doc 2017-07-13_1.jpg','50573-New Doc 2017-07-13_1.jpg','92371-New Doc 2017-07-13_1.jpg','93652-scanner_20170713_093557.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(67,NULL,'Mangla Varma','2017-07-13','Gram-kerwa','Gram-kerwa, Post-kuwa, Thehsil-thikri, ','','9753058699','1974-01-01',43,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jitendra Varma','0000-00-00','Jitendra Varma','','Husband',NULL,NULL,'female','','','Husband','APQRS8562D','650583638018','650583638018','650583638018','84391-New Doc 2017-07-13 (1)_1.jpg','41728-New Doc 2017-07-13 (1)_2.jpg','38868-New Doc 2017-07-13 (1)_2.jpg','29704-New Doc 2017-07-13 (1)_2.jpg','98789-Business Cards_1.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(68,NULL,'Lakshmi Bai Varma','2017-07-13','Gram-Kerva','Gram-Kerva, word no-7,Ram mandir ke samne ,Post-kuva, Tehsil-Thikri,DIst-Barwani,MP','','12345','1985-01-01',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Dinesh Varma','0000-00-00','Ritesh Varma','15','Son',NULL,NULL,'female','','','Husband','APQRS8562D','688759662215','688759662215','688759662215','27622-New Doc 2017-07-13 (2)_1.jpg','66778-New Doc 2017-07-13 (2)_2.jpg','29124-New Doc 2017-07-13 (2)_2.jpg','41060-New Doc 2017-07-13 (2)_2.jpg','49077-Business Cards_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(69,NULL,'Sarika Varma','2017-07-13','gram-Kerva,','Purani Basti Gram-kerva, post-kuva,Thehsil-thikri, Dist.-Barwani MP','','7024544413','1990-01-01',27,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Gajanand Varma','0000-00-00','Gajanand Varma','','Husband',NULL,NULL,'female','','','Husband','APQRS8562D','421777325411','421777325411','421777325411','82722-New Doc 2017-07-13_1.jpg','71301-New Doc 2017-07-13_2.jpg','61086-New Doc 2017-07-13_2.jpg','8084-New Doc 2017-07-13_2.jpg','23463-Business Cards_1.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(70,NULL,'Krishnpal Chouhan','2017-07-14','thikri','gomata colony thikri, post-thikri ','','9977903077','1992-06-11',25,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'single','','0000-00-00','Lata chouhan','','mother',NULL,NULL,'male','Tulsiram chouhan','','','BFPPC4372E','BFPPC4372E','BFPPC4372E','BFPPC4372E','39481-Business Cards_2.jpg','65533-Business Cards_3.jpg','62389-Business Cards_3.jpg','19075-Business Cards_3.jpg','1664-Business Cards_1(2).jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(71,NULL,'Mohandas Karma','2017-07-14','thikri','Rathod mohalla thikri, Post-Thikri,','','9753993848','1965-06-03',52,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jyoti Karma','0000-00-00','Jyotibai Karma','','wife',NULL,NULL,'male','Tulsidas Karma','','Wife','557404613432','557404613432','557404613432','557404613432','47516-Business Cards_2.jpg','5067-Business Cards_3.jpg','12348-Business Cards_3.jpg','32432-Business Cards_3.jpg','96428-Business Cards_1.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(72,NULL,'Tejpal Aroro','2017-07-14','Thikri','Jen Mohalla thikri, Post-Thikri,','','9926021328','1977-05-19',40,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Nisha arora','0000-00-00','Nisha arora','','wife',NULL,NULL,'male','Dharamshing','','Wife','779431728324','779431728324','779431728324','779431728324','79813-Business Cards_2.jpg','85706-Business Cards_3.jpg','45144-Business Cards_3.jpg','84982-Business Cards_3.jpg','80881-Business Cards_1.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(73,NULL,'Rajendra Varema','2017-07-14','Gram-Kerva','Gram-Kerva, Past-kuwa, Tehsil-Thikri,','','9754443110','1985-07-01',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Renuka Varma','0000-00-00','Renuka Varma','','Wife',NULL,NULL,'male','om Varma','','Wife','958853838243','958853838243','958853838243','958853838243','70984-Business_Cards_2[1].jpg','45240-Business_Cards_3[1].jpg','56002-Business_Cards_3[1].jpg','66902-Business_Cards_3[1].jpg','37521-Business_Cards_1[1].jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(74,NULL,'Jitendra VArma','2017-07-14','Gram-kerwa','Grma-kerwa, Post-kuwa, Tehsil-thikri,','','9617349386','1971-01-01',46,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Mangalabai Varma','0000-00-00','Mangalabai Varma','','wife',NULL,NULL,'male','Rajaram VArma','','Wif','567727980735','567727980735','567727980735','567727980735','7924-New Doc 2017-07-14_1.jpg','80947-New Doc 2017-07-14_3.jpg','60952-New Doc 2017-07-14_3.jpg','90272-New Doc 2017-07-14_3.jpg','77308-New Doc 2017-07-14_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(75,NULL,'Kamal Yadav','2017-07-14','Thikri','Yadav Mohalla thikri','','9752001963','1975-10-15',41,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Chintabai yadav','0000-00-00','Chintabai yadav','','wife',NULL,NULL,'male','Aidoo Yadav','','Wife','570821885846','570821885846','570821885846','570821885846','11359-New Doc 2017-07-14_4.jpg','47033-New Doc 2017-07-14_6.jpg','7778-New Doc 2017-07-14_6.jpg','76009-New Doc 2017-07-14_6.jpg','83631-New Doc 2017-07-14_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(76,NULL,'Rajesh ','2017-07-14','Gram-Umarada','GRam-umarada,post- gatwa, tehsil-thikri,','','9926182384','1992-01-01',25,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','sumanbai rajesh','0000-00-00','gyanu bai','','',NULL,NULL,'male','Bhagavan ','','Wife','363297904144','363297904144','363297904144','363297904144','5447-New Doc 2017-07-14_7.jpg','5038-New Doc 2017-07-14_9.jpg','54620-New Doc 2017-07-14_9.jpg','30519-New Doc 2017-07-14_9.jpg','33065-New Doc 2017-07-14_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(77,NULL,'Manish Gupta','2017-07-14','Thikri','main road nima dharamshala ke samne thikri','','9424069134','1978-01-01',39,10,5,8,'pardeepjaiswal50@gmail.com',451660,'married','Aasha Gupta','0000-00-00','aasha Gupta','','wife',NULL,NULL,'male','Salakram Gupta','','wife','875716521241','875716521241','875716521241','875716521241','14233-New Doc 2017-07-14_1(2).jpg','49796-New Doc 2017-07-14_3(2).jpg','17825-New Doc 2017-07-14_3(2).jpg','65664-New Doc 2017-07-14_3(2).jpg','67692-New Doc 2017-07-14_2(2).jpg',0,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(78,5,'Ajay Dhangar','2017-07-14','Vill.-Dawana','Vill.-Dawana, Tehsil-thikri,','','9589583829','1988-02-12',29,10,5,8,'pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Surajbai','','',NULL,NULL,'male','Nanuram dhangar','','','715708541296','715708541296','715708541296','715708541296','86874-New Doc 2017-07-14_4(2).jpg','58709-New Doc 2017-07-14_6(2).jpg','77229-New Doc 2017-07-14_6(2).jpg','54275-New Doc 2017-07-14_6(2).jpg','7382-New Doc 2017-07-14_5(2).jpg',50,11,1,33,'approve',31,'','2017-07-15 00:00:00',31,'2017-07-15 10:56:47'),(79,NULL,'Pooja Megval','2017-07-14','thikri','Thikri,Tehsil-Thikri, ','','123456','1975-01-01',42,10,5,8,'pardeepjaiswal50@gmail.com',451660,'married','Devi megval','0000-00-00','Devi megval','','wife',NULL,NULL,'male','Apa megval','','Wife','000000000000','000000000000','000000000000','000000000000','91682-New Doc 2017-07-14_7(2).jpg','27754-New Doc 2017-07-14_9(2).jpg','76789-New Doc 2017-07-14_9(2).jpg','11395-New Doc 2017-07-14_9(2).jpg','13882-New Doc 2017-07-14_8(2).jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(80,NULL,'Santosh Matre','2017-07-14','Thikri ','Makan/no.260, Word/no.11, thikri','','7691922388','1984-01-01',33,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sonu Matre','0000-00-00','Sonu Matre','','Wife',NULL,NULL,'male','Ravichandra Matre','','Wife','479186641041','479186641041','479186641041','479186641041','27437-New Doc 2017-07-14_10.jpg','46457-New Doc 2017-07-14_12.jpg','82552-New Doc 2017-07-14_12.jpg','57321-New Doc 2017-07-14_12.jpg','93940-New Doc 2017-07-14_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(81,NULL,'Virendr solanki','2017-07-14','Gram-Pipri','Gram-Pipri, Post-Thikri, Tehsil-Thikri','','9165304120','1980-01-01',37,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Rekhabai','0000-00-00','Rekhabai','','Wife',NULL,NULL,'male','Dhayanasingh','','Wife','000000000000','000000000000','000000000000','000000000000','69496-New Doc 2017-07-14_13.jpg','91325-New Doc 2017-07-14_15.jpg','90331-New Doc 2017-07-14_15.jpg','12253-New Doc 2017-07-14_15.jpg','75479-New Doc 2017-07-14_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(82,NULL,'Balaram Dhangar','2017-07-14','Gram-Dawana','Gram-Dawan, Tehsil-Thikri','','9981140851','1987-02-09',30,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jyotibai','0000-00-00','Jyotibai','','Wife',NULL,NULL,'male','Shobharam Dhangar','','Wife','000000000000','000000000000','000000000000','000000000000','12428-New Doc 2017-07-14_16.jpg','46926-New Doc 2017-07-14_18.jpg','4614-New Doc 2017-07-14_18.jpg','79948-New Doc 2017-07-14_18.jpg','82081-New Doc 2017-07-14_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(83,NULL,'Budan  Sen','2017-07-14','Gram-Jarwai','Gram-Jarwai, Post-Thikri, Tehsil-Thikri','','9926895525','1990-03-02',27,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Punamchand sen','','','360522927050','360522927050','360522927050','360522927050','23308-New Doc 2017-07-14_19.jpg','87565-New Doc 2017-07-14_21.jpg','27320-New Doc 2017-07-14_21.jpg','2259-New Doc 2017-07-14_21.jpg','53538-New Doc 2017-07-14_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(84,NULL,'Mahesh Sen','2017-07-14','Gram-Lakhangaon','Gram-Lakhangaon,Post-Lakhangaon, Tehsil-Thikri,','','12345','1991-01-01',26,10,5,8,'pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Hiralal sen','','','522093249235','522093249235','522093249235','522093249235','93203-New Doc 2017-07-14_22.jpg','63229-New Doc 2017-07-14_24.jpg','94916-New Doc 2017-07-14_24.jpg','19550-New Doc 2017-07-14_24.jpg','77395-New Doc 2017-07-14_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(85,NULL,'Mahimaram rathod','2017-07-14','thikri','Thikri,Tehsil-Thikri,','','9907093486','1974-01-01',43,10,5,8,'pardeepjaiswal50@gmail.com',451660,'married','Kalabai Rathod','0000-00-00','Kalabai','','Wife',NULL,NULL,'male','Govind Rathod','','Wife','343611043121','343611043121','343611043121','343611043121','27941-Business Cards_1.jpg','40866-Business Cards_3.jpg','43084-Business Cards_3.jpg','16869-Business Cards_3.jpg','16189-Business Cards_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(86,NULL,'Shantilal Yadav','2017-07-14','Thikri','Yadav Mohalla, Gram-Thikri','','9630587587','1978-01-20',39,10,5,8,'pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','nandni Yadav','','',NULL,NULL,'male','Jagdish Yadav','','','243988228870','243988228870','243988228870','243988228870','12424-Business Cards_4.jpg','5182-Business Cards_6.jpg','37895-Business Cards_6.jpg','17204-Business Cards_6.jpg','64973-Business Cards_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(87,NULL,'Jaymti Bai','2017-07-15','Thikri','Yadav Mohalla,Thikri','','12345','1978-01-01',39,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sakharam Yadav','0000-00-00','sakharam Yadav','','Husband',NULL,NULL,'female','','','Husband','531967955204','531967955204','531967955204','531967955204','92219-Business Cards_1.jpg','64486-Business Cards_3.jpg','9556-Business Cards_3.jpg','71186-Business Cards_3.jpg','52341-Business Cards_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(88,NULL,'Karuna Kulambi','2017-07-15','Thikri','Yadav Mohalla,Thikri','','1245','1989-01-01',28,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Rakesh Kulambi','0000-00-00','Rakesh Kulambi','','Husband',NULL,NULL,'female','','','Husband','554480670801','554480670801','554480670801','554480670801','48390-Business Cards_4.jpg','1278-Business Cards_6.jpg','77328-Business Cards_6.jpg','64535-Business Cards_6.jpg','86993-Business Cards_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(89,NULL,'Naanu Bai Varma','2017-07-17','Thikri','Bedi Pura Thikri','','12345','1962-01-01',55,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Mathuralal  Varma','0000-00-00','Mathuralal Varma','','Husband',NULL,NULL,'female','','','Husband','266210546292','266210546292','266210546292','266210546292','21186-New Doc 2017-07-16_10.jpg','15598-New Doc 2017-07-16_12.jpg','38721-New Doc 2017-07-16_12.jpg','29592-New Doc 2017-07-16_12.jpg','17333-New Doc 2017-07-16_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(90,NULL,'Jyoti Varma','2017-07-17','Thikri','Bedi Pura, Thikri','','123456','1982-01-01',35,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Madhu Varma','0000-00-00','Madhu Varma','','Husband',NULL,NULL,'female','','','Husband','601696881471','601696881471','601696881471','601696881471','19044-New Doc 2017-07-16_13.jpg','91463-New Doc 2017-07-16_15.jpg','52793-New Doc 2017-07-16_15.jpg','89367-New Doc 2017-07-16_15.jpg','77357-New Doc 2017-07-16_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(91,NULL,'Jubeda bi ','2017-07-17','Thikri ','Bedi Pura Thikri','','12345','1986-01-01',31,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Anwar khan ','0000-00-00','Anwar khan','','Husband',NULL,NULL,'female','','','Husband','536377180021','536377180021','536377180021','536377180021','52120-New Doc 2017-07-16_1.jpg','21805-New Doc 2017-07-16_3.jpg','29020-New Doc 2017-07-16_3.jpg','69581-New Doc 2017-07-16_3.jpg','28027-New Doc 2017-07-16_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(92,NULL,'Samina Khan','2017-07-17','Thikri','Pir baba bedi,Thikri','','12345','1986-01-01',31,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Firoj Khan','0000-00-00','Firoj Khan','','Husband',NULL,NULL,'female','','','Husband','311136376639','311136376639','311136376639','311136376639','98086-New Doc 2017-07-16_4.jpg','91764-New Doc 2017-07-16_6.jpg','51478-New Doc 2017-07-16_6.jpg','41347-New Doc 2017-07-16_6.jpg','87132-New Doc 2017-07-16_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(93,NULL,'Nagma Khan','2017-07-17','Thikri','Pir baba bedi,Thikri','','12345','1991-01-01',26,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Ismail Khan','0000-00-00','Ismail Khan','','Husband',NULL,NULL,'female','','','Husband','443561466888','443561466888','443561466888','443561466888','27004-New Doc 2017-07-16_7.jpg','93125-New Doc 2017-07-16_9.jpg','30918-New Doc 2017-07-16_9.jpg','97584-New Doc 2017-07-16_9.jpg','24013-New Doc 2017-07-16_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(94,NULL,'Aasha Bai Varma','2017-07-17','Thikri','Bajarangbali Mohalla,thikri','','12345','1979-01-01',38,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Gopal Varma','0000-00-00','Gopal Varma','','Husband',NULL,NULL,'female','','','Husband','428600263521','428600263521','428600263521','428600263521','57889-New Doc 2017-07-16_16.jpg','38742-New Doc 2017-07-16_18.jpg','82187-New Doc 2017-07-16_18.jpg','67334-New Doc 2017-07-16_18.jpg','67824-New Doc 2017-07-16_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(95,NULL,'Dhanu Bai Yadav','2017-07-17','Thikri','Yadav Mohalla,Thikri','','12345','1962-01-01',55,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Ganesh Yadav','0000-00-00','Ganesh Yadav','','Husband',NULL,NULL,'female','','','Husband','878687858999','878687858999','878687858999','878687858999','36174-New Doc 2017-07-16_19.jpg','68083-New Doc 2017-07-16_21.jpg','62208-New Doc 2017-07-16_21.jpg','87100-New Doc 2017-07-16_21.jpg','30686-New Doc 2017-07-16_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(96,NULL,'Nasim Bi','2017-07-17','Thikri','Bedi Pura Thikri','','12345','1981-01-01',36,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jabir Khan','0000-00-00','Jabir Khan','','Husband',NULL,NULL,'female','','','Husband','512533896579','512533896579','512533896579','512533896579','43303-New Doc 2017-07-16_22.jpg','46041-New Doc 2017-07-16_24.jpg','27846-New Doc 2017-07-16_24.jpg','7692-New Doc 2017-07-16_24.jpg','66280-New Doc 2017-07-16_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(97,NULL,'Rina Bai Bhagule','2017-07-17','Thikri','Bedi Pura Thikri','','12345','1987-01-01',30,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Narayan Bhagule','0000-00-00','Narayan Bhagule','','Husband',NULL,NULL,'female','','','Husband','805292976541','805292976541','805292976541','805292976541','9339-New Doc 2017-07-16_25.jpg','10233-New Doc 2017-07-16_27.jpg','91751-New Doc 2017-07-16_27.jpg','50717-New Doc 2017-07-16_27.jpg','52232-New Doc 2017-07-16_26.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(98,NULL,'Arju Shah','2017-07-17','Thikri','Bedi Pura pirbaba ki gali,thikri','','12345','1992-01-01',25,10,5,8,'pardeepjaiswal50@gmail.com',451660,'married','Akram Shah','0000-00-00','Akram Shah','','Husband',NULL,NULL,'female','','','Husband','524114177846','524114177846','524114177846','524114177846','66405-New Doc 2017-07-16_28.jpg','18078-New Doc 2017-07-16_30.jpg','53473-New Doc 2017-07-16_30.jpg','46816-New Doc 2017-07-16_30.jpg','97998-New Doc 2017-07-16_29.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(99,NULL,'Komal Varma','2017-07-17','Thikri','Koli mohalla,thikri','','12345','1988-01-01',29,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Santosh Varma','0000-00-00','Santosh Varma','','Husband',NULL,NULL,'female','','','Husband','990729355991','990729355991','990729355991','990729355991','99660-New Doc 2017-07-17_1.jpg','17709-New Doc 2017-07-17_3.jpg','92701-New Doc 2017-07-17_3.jpg','7547-New Doc 2017-07-17_3.jpg','18573-New Doc 2017-07-17_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(100,NULL,'Chaya Solanki','2017-07-17','Thikri','Pir baba bedi,Thikri','','12345','1980-01-01',37,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Mukesh Solanki','0000-00-00','Mukesh Solanki','','Husband',NULL,NULL,'female','','','h','731399483249','731399483249','731399483249','731399483249','98112-New Doc 2017-07-17_4.jpg','28815-New Doc 2017-07-17_6.jpg','15090-New Doc 2017-07-17_6.jpg','77571-New Doc 2017-07-17_6.jpg','14848-New Doc 2017-07-17_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(101,NULL,'Kusum Varma','2017-07-17','thikri','Koli mohalla,thikri','','12345','1972-01-01',45,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Manshram Varma','0000-00-00','Manshram Varma','','Husband',NULL,NULL,'female','','','Husband','808828458888','808828458888','808828458888','808828458888','43826-New Doc 2017-07-17_7.jpg','8849-New Doc 2017-07-17_9.jpg','66044-New Doc 2017-07-17_9.jpg','38905-New Doc 2017-07-17_9.jpg','66991-New Doc 2017-07-17_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(102,NULL,'parveen','2017-07-17','Thikri','Thikri,Tehsil-Thikri,','','12345','1978-01-01',39,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jakir Khan','0000-00-00','Jakir Khan','','Husband',NULL,NULL,'female','','','Husband','278975635510','278975635510','278975635510','278975635510','59923-New Doc 2017-07-17_10.jpg','59544-New Doc 2017-07-17_12.jpg','89726-New Doc 2017-07-17_12.jpg','10851-New Doc 2017-07-17_12.jpg','54315-New Doc 2017-07-17_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(103,NULL,'Bharti yadav','2017-07-17','Thikri','Yadav Mohalla,Thikri','','12345','1992-01-01',25,9,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Vineet Yadav','0000-00-00','Vineet Yadav','','Husband',NULL,NULL,'female','','','Husband','724211500664','724211500664','724211500664','724211500664','67338-New Doc 2017-07-17_13.jpg','40332-New Doc 2017-07-17_15.jpg','54847-New Doc 2017-07-17_15.jpg','16467-New Doc 2017-07-17_15.jpg','50593-New Doc 2017-07-17_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(104,NULL,'Sewanti Bai Rathod','2017-07-17','Thikri','Dashara medan,thikri','','12345','1981-01-01',36,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jagdish Rathod','0000-00-00','Jagdish Rathod','','Husband',NULL,NULL,'female','','','Husband','982591195976','982591195976','982591195976','982591195976','44743-New Doc 2017-07-17_16.jpg','64798-New Doc 2017-07-17_18.jpg','88338-New Doc 2017-07-17_18.jpg','11159-New Doc 2017-07-17_18.jpg','11001-New Doc 2017-07-17_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(105,NULL,'Farida','2017-07-17','Thikri','Bedi Pura Thikri4','','12345','1975-01-01',42,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','mosam','0000-00-00','mosam','','Husband',NULL,NULL,'female','','','Husband','603207007313','603207007313','603207007313','603207007313','12894-New Doc 2017-07-17_19.jpg','82685-New Doc 2017-07-17_21.jpg','64352-New Doc 2017-07-17_21.jpg','90512-New Doc 2017-07-17_21.jpg','80692-New Doc 2017-07-17_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(106,NULL,'Kamala Bai Varma','2017-07-17','Thikri','Pir baba bedi,Thikri','','12345','1970-01-01',47,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Aasharam Varma','0000-00-00','Aasharam Varma','','Husband',NULL,NULL,'female','','','Husband','545098538621','545098538621','545098538621','545098538621','56272-New Doc 2017-07-17_22.jpg','62270-New Doc 2017-07-17_24.jpg','84515-New Doc 2017-07-17_24.jpg','26748-New Doc 2017-07-17_24.jpg','14011-New Doc 2017-07-17_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(107,NULL,'Sakina Shah','2017-07-17','Thikri','Bedi Pura Thikri','','12345','1972-01-01',45,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Salim Shah','0000-00-00','Salim Shah','','Husband',NULL,NULL,'female','','','Husband','737273631326','737273631326','737273631326','737273631326','33256-New Doc 2017-07-17_25.jpg','91275-New Doc 2017-07-17_27.jpg','88392-New Doc 2017-07-17_27.jpg','16567-New Doc 2017-07-17_27.jpg','98961-New Doc 2017-07-17_26.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(108,NULL,'Yasmin Bi','2017-07-17','Thikri','Pir baba bedi,Thikri','','12345','1987-01-01',30,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Arif','0000-00-00','Arif','','Husband',NULL,NULL,'female','','','Husband','618811489951','618811489951','618811489951','618811489951','83521-New Doc 2017-07-17_28.jpg','27967-New Doc 2017-07-17_30.jpg','16196-New Doc 2017-07-17_30.jpg','16207-New Doc 2017-07-17_30.jpg','39301-New Doc 2017-07-17_29.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(109,NULL,'Prem','2017-07-17','Thikri','Yadav Mohalla,Thikri','','12345','1967-01-01',50,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Manshram','0000-00-00','Manshram','','Husband',NULL,NULL,'female','','','Husband','762014286105','762014286105','762014286105','762014286105','72335-New Doc 2017-07-17_31.jpg','94805-New Doc 2017-07-17_33.jpg','63372-New Doc 2017-07-17_33.jpg','13741-New Doc 2017-07-17_33.jpg','43455-New Doc 2017-07-17_32.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(110,NULL,'Pooja Yadav','2017-07-17','Thikri','Yadav Mohalla,Thikri','','12345','1993-02-27',24,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','ramesh Yadav','','Father',NULL,NULL,'female','','','','AOHPY2921H','525879402911','525879402911','525879402911','72080-New Doc 2017-07-17_34.jpg','16343-New Doc 2017-07-17_36.jpg','72404-New Doc 2017-07-17_38.jpg','54255-New Doc 2017-07-17_36.jpg','17724-New Doc 2017-07-17_35.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(111,NULL,'Vijay patil','2017-07-17','Thikri','Gopi Vihar Calony,thikri','','12345','1978-01-01',39,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Archana','0000-00-00','Archana','','Wife',NULL,NULL,'female','','','Wife','754607489527','754607489527','754607489527','754607489527','62109-New Doc 2017-07-17_39.jpg','38998-New Doc 2017-07-17_41.jpg','49789-New Doc 2017-07-17_41.jpg','57590-New Doc 2017-07-17_41.jpg','90000-New Doc 2017-07-17_40.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(112,NULL,'Lakhan Kumavat','2017-07-17','Gram-Brahamangaon','Gram-Brahamangaon, Tehsil-Thikri','','12345','1992-05-05',25,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Rakesh Kumavat','','Father',NULL,NULL,'male','','','','334714558216','334714558216','334714558216','334714558216','33496-New Doc 2017-07-17_42.jpg','32830-New Doc 2017-07-17_44.jpg','28094-New Doc 2017-07-17_44.jpg','99529-New Doc 2017-07-17_44.jpg','52264-New Doc 2017-07-17_43.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(113,NULL,'Varshabai Yadav','2017-07-17','Thikri','Nayata Mohalla,Thikri','','12345','1985-01-01',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Ramchandra yadav','0000-00-00','Ramchandra yadav','','Husband',NULL,NULL,'female','','','Husband','876899305909','876899305909','876899305909','876899305909','21396-New Doc 2017-07-17_45.jpg','91986-New Doc 2017-07-17_47.jpg','46554-New Doc 2017-07-17_47.jpg','50397-New Doc 2017-07-17_47.jpg','55441-New Doc 2017-07-17_46.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(114,NULL,'Bapu Pawar','2017-07-17','Vill.-Pipri','Vill.-Pipri,Tehsil-Thikri,','','12345','1976-01-01',41,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sangita Bai','0000-00-00','Sangita Bai','','wife',NULL,NULL,'male','','','Wife','SHU0791749','SHU0791749','SHU0791749','SHU0791749','34136-New Doc 2017-07-17_48.jpg','36677-New Doc 2017-07-17_50.jpg','61802-New Doc 2017-07-17_50.jpg','5043-New Doc 2017-07-17_50.jpg','50414-New Doc 2017-07-17_49.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(115,NULL,'Vijay Patil','2017-07-19','Thikri','Gandhi chok,Thikri','','12345','1974-01-01',43,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sarla ','0000-00-00','Sarla','','Wife',NULL,NULL,'male','Kadu Patil','','Wife','483574778440','483574778440','483574778440','483574778440','89446-New Doc 2017-07-17_1.jpg','31387-New Doc 2017-07-17_3.jpg','94024-New Doc 2017-07-17_3.jpg','63581-New Doc 2017-07-17_3.jpg','23969-New Doc 2017-07-17_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(116,NULL,'Jitendra  Kevat','2017-07-19','Gram-Pipri,','Gram-Pipri, Tehsil-Thikri','','12345','1994-01-01',23,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Nandni Kevat','0000-00-00','Nandni Kevat','','Wife',NULL,NULL,'male','','','Wife','SHU0463901','SHU0463901','SHU0463901','SHU0463901','95726-New Doc 2017-07-17_4.jpg','32595-New Doc 2017-07-17_6.jpg','99583-New Doc 2017-07-17_6.jpg','55249-New Doc 2017-07-17_6.jpg','94384-New Doc 2017-07-17_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(117,NULL,'Sarika Yadav','2017-07-19','Gram-Kerva','Gram-Kerva,Tehsil-Thikri','','12345','1979-03-17',38,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Devendra Yadav','0000-00-00','Devendra Yadav','','Husband',NULL,NULL,'female','','','Husband','440571193337','440571193337','440571193337','440571193337','86888-New Doc 2017-07-19_4.jpg','49797-New Doc 2017-07-19_6.jpg','25888-New Doc 2017-07-19_6.jpg','57718-New Doc 2017-07-19_6.jpg','20394-New Doc 2017-07-19_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(118,NULL,'Krishna ','2017-07-19','Gram-Kundamal','Gram-Kundamal,Tehsil-Thikri','','12344','1990-01-01',27,10,5,8,'pardipjaiswal50@jaiwal.com',451660,'married','Mamta','0000-00-00','Mamta','','Wife',NULL,NULL,'male','','','Wife','443026100589','443026100589','443026100589','443026100589','68276-New Doc 2017-07-19_7.jpg','25051-New Doc 2017-07-19_9.jpg','88594-New Doc 2017-07-19_9.jpg','74388-New Doc 2017-07-19_9.jpg','95102-New Doc 2017-07-19_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(119,NULL,'Aashish Soni','2017-07-20','Thikri','Medical Colony,Thikri','','12344','1985-06-20',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Pooja Soni','0000-00-00','Pooja Soni','','Wife',NULL,NULL,'male','Gopal Soni','','Wife','1','1','1','1','3039-New Doc 2017-07-19_10.jpg','78072-New Doc 2017-07-19_12.jpg','90760-New Doc 2017-07-19_12.jpg','3840-New Doc 2017-07-19_12.jpg','64823-New Doc 2017-07-19_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(120,NULL,'Sunil Chouhan','2017-07-20','Thikri','Barwani Road,Thikri','','12345','1989-04-16',28,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sushma Chouhan','0000-00-00','Sushma Chouhan','','Wife',NULL,NULL,'male','Mangeelal Chouhan','','Wife','202174439777','202174439777','202174439777','202174439777','65567-New Doc 2017-07-19_13.jpg','18597-New Doc 2017-07-19_15.jpg','76617-New Doc 2017-07-19_15.jpg','17422-New Doc 2017-07-19_15.jpg','43330-New Doc 2017-07-19_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(121,NULL,'Vijay Karma','2017-07-20','Thikri','Thikri,Tehsil-Thikri','','12345','1982-07-05',35,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sapna Karma','0000-00-00','Sapna Karma','','Wife',NULL,NULL,'male','Radheshyam Karma','','Wife','SHU1012640','SHU1012640','SHU1012640','SHU1012640','81891-New Doc 2017-07-19_16.jpg','9181-New Doc 2017-07-19_18.jpg','19675-New Doc 2017-07-19_18.jpg','56791-New Doc 2017-07-19_18.jpg','20657-New Doc 2017-07-19_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(122,NULL,'Ravi Rathod ','2017-07-20','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','12345','1991-01-01',26,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Candu Bai Rathod','','Mother',NULL,NULL,'male','Salkaram Rathod','','','701950763750','701950763750','701950763750','701950763750','65855-New Doc 2017-07-19_19.jpg','33397-New Doc 2017-07-19_21.jpg','50383-New Doc 2017-07-19_21.jpg','58135-New Doc 2017-07-19_21.jpg','22414-New Doc 2017-07-19_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(123,NULL,'Santosh Karma','2017-07-20','Thikri','Rathod mohalla, Thikri','','7747966817','1972-01-28',45,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sundar Karma','0000-00-00','Sundar Karma','','Wife',NULL,NULL,'male','Tulsiram Karma','','Wife','278091393501','278091393501','278091393501','278091393501','17358-New Doc 2017-07-19_22.jpg','7701-New Doc 2017-07-19_24.jpg','66532-New Doc 2017-07-19_24.jpg','59470-New Doc 2017-07-19_24.jpg','33746-New Doc 2017-07-19_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(124,NULL,'Sevakram ','2017-07-20','Thikri','Nayata Mohalla,Thikri','','12345','1980-01-01',37,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Seema','0000-00-00','Seema','','Wife',NULL,NULL,'male','Gangaram','','Wife','SHU0936153','SHU0936153','SHU0936153','SHU0936153','73264-New Doc 2017-07-19_25.jpg','32805-New Doc 2017-07-19_27.jpg','24427-New Doc 2017-07-19_27.jpg','55491-New Doc 2017-07-19_27.jpg','94882-New Doc 2017-07-19_26.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(125,NULL,'Dipesh Dasondi','2017-07-20','Thikri','Goshala ke pass Thikri','','12345','1994-07-11',23,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','','0000-00-00','Mahendra dasondi','','father',NULL,NULL,'male','Mahendra dasondi','','','SHU0483271','SHU0483271','SHU0483271','SHU0483271','15313-New Doc 2017-07-19_30.jpg','51503-New Doc 2017-07-19_32.jpg','86411-New Doc 2017-07-19_32.jpg','47699-New Doc 2017-07-19_32.jpg','86647-New Doc 2017-07-19_31.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(126,NULL,'Yashpal Shing Dasaundhi','2017-07-20','Thikri','Thikri,Tehsil-Thikri','','9754851429','1985-08-24',31,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sharda','0000-00-00','Sharda','','Wife',NULL,NULL,'male','Rajendra Shing','','Wife','SHU16860052','SHU16860052','SHU16860052','SHU16860052','41101-New Doc 2017-07-19_34.jpg','8462-New Doc 2017-07-19_36.jpg','35585-New Doc 2017-07-19_36.jpg','48151-New Doc 2017-07-19_36.jpg','89015-New Doc 2017-07-19_35.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(127,NULL,'Girish','2017-07-20','Gram-Pipri','Gram-Pipri,Tehsil-thikri','','12345','1985-01-01',32,10,5,8,'Pardeepjaiswal50@gmail.com',45166,'married','Gaytri','0000-00-00','Gaytri','','Wife',NULL,NULL,'male','Keval','','Wife','344154464144','344154464144','344154464144','344154464144','92620-New Doc 2017-07-19_37.jpg','88638-New Doc 2017-07-19_39.jpg','83796-New Doc 2017-07-19_39.jpg','86482-New Doc 2017-07-19_39.jpg','36310-New Doc 2017-07-19_38.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(128,NULL,'Babu Rathore','2017-07-20','Gram-Pipri','Gram-Pipri,Tehsil-Thikri','','12345','1993-04-05',24,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Premlal Rathore','','Father',NULL,NULL,'male','Premlal Rathore','','','BLEPR3499E','BLEPR3499E','BLEPR3499E','BLEPR3499E','61596-New Doc 2017-07-19_40.jpg','20805-New Doc 2017-07-19_42.jpg','65124-New Doc 2017-07-19_42.jpg','77579-New Doc 2017-07-19_42.jpg','26892-New Doc 2017-07-19_41.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(129,NULL,'Akshay Jaiswal','2017-07-20','Thikri','Thikri,Tehsil-thikri','','12345','1994-09-01',22,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Satynarayan Jaiswal','','Mother',NULL,NULL,'male','Satynarayan Jaiswal','','','583308062662','583308062662','583308062662','SHU0653642','9035-New Doc 2017-07-19_43.jpg','12679-New Doc 2017-07-19_46.jpg','58577-New Doc 2017-07-19_45.jpg','22087-New Doc 2017-07-19_45.jpg','16082-New Doc 2017-07-19_44.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(130,NULL,'Santosh Dasaundhi','2017-07-20','Thikri','Thikri,Tehsil-Thikri','','12345','1967-01-01',50,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sangita','0000-00-00','Sangita','','Wife',NULL,NULL,'male','Mishrilal Dasaundhi','','Wife','721969231112','721969231112','721969231112','721969231112','46335-New Doc 2017-07-19_47.jpg','86307-New Doc 2017-07-19_49.jpg','88464-New Doc 2017-07-19_49.jpg','31671-New Doc 2017-07-19_49.jpg','37885-New Doc 2017-07-19_48.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(131,NULL,'Sachin yadav','2017-07-20','Thikri','Yadav Mohalla,thikri','','12345','1984-08-01',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Ramesh Yadav','','Father',NULL,NULL,'male','Ramesh Yadav','','','AFCPY6826M','AFCPY6826M','AFCPY6826M','SHU0649996','18762-New Doc 2017-07-19_51.jpg','13426-New Doc 2017-07-19_54.jpg','30023-New Doc 2017-07-19_53.jpg','63532-New Doc 2017-07-19_53.jpg','21355-New Doc 2017-07-19_52.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(132,NULL,'Pappu Varma','2017-07-20','Thiri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','12345','1988-08-01',28,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Komal Varma','0000-00-00','Komal Varma','','Wife',NULL,NULL,'male','Ramesh Varma','','Wife','709804958117','709804958117','709804958117','709804958117','56366-New Doc 2017-07-20_5.jpg','20769-New Doc 2017-07-20_7.jpg','64676-New Doc 2017-07-20_7.jpg','59023-New Doc 2017-07-20_7.jpg','28713-New Doc 2017-07-20_6.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(133,NULL,'Anil Yadav','2017-07-20','Thikri','Thikri,Tehsil-Thikri','','12345','1989-07-26',27,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Radheshyam Yadav','','','557241970380','557241970380','557241970380','SHU0888552','94044-New Doc 2017-07-20_11.jpg','63571-New Doc 2017-07-20_13.jpg','10534-New Doc 2017-07-20_14.jpg','53654-New Doc 2017-07-20_14.jpg','67935-New Doc 2017-07-20_12.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(134,NULL,'Tulsiram Varma','2017-07-20','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','7772866105','1977-01-01',40,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sunita Varma','0000-00-00','Sunita Varma','','Wife',NULL,NULL,'male','Tukadiya','','Wife','660310458522','660310458522','660310458522','660310458522','76008-New Doc 2017-07-20_1.jpg','86418-New Doc 2017-07-20_3.jpg','63461-New Doc 2017-07-20_3.jpg','13729-New Doc 2017-07-20_3.jpg','19786-New Doc 2017-07-20_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(135,NULL,'Madhuri Sen','2017-07-20','Gram-Kerva','Gram-Kerva,Tehsil-Thikri','','9575203927','1983-08-10',33,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Balram Sen','0000-00-00','Balram Sen','','Husband',NULL,NULL,'female','','','Husband','794910810933','794910810933','794910810933','794910810933','48940-New Doc 2017-07-20_4.jpg','68105-New Doc 2017-07-20_6.jpg','82257-New Doc 2017-07-20_6.jpg','35145-New Doc 2017-07-20_6.jpg','62978-New Doc 2017-07-20_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(136,NULL,'Sunil Rathod','2017-07-20','Thikri','Thikri,Tehsil-Thikri','','9806546700','1990-01-01',27,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','pooja Rathod','','',NULL,NULL,'male','Munnalal Rathod','','','758007738780','758007738780','758007738780','758007738780','91320-New Doc 2017-07-20 (1)_1.jpg','94657-New Doc 2017-07-20 (1)_3.jpg','76540-New Doc 2017-07-20 (1)_3.jpg','79559-New Doc 2017-07-20 (1)_3.jpg','1238-New Doc 2017-07-20 (1)_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(137,NULL,'Somesh Jaiswal','2017-07-20','Thikri','Shree Maya Colony, Shashkiy aspatal ke piche,pipari,thikri','','9424967189','1997-03-09',20,10,5,8,'pardipjaiswal50@jaiwal.com',451660,'','','0000-00-00','Sudhipa Jaiswal','','',NULL,NULL,'male','Rajendra Kumar ','','','BDEPJ5130L','721237212023','721237212023','721237212023','93401-New Doc 2017-07-20_7.jpg','29666-New Doc 2017-07-20_9.jpg','96266-New Doc 2017-07-20_10.jpg','78175-New Doc 2017-07-20_9.jpg','61029-New Doc 2017-07-20_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(138,NULL,'Subhash Varma','2017-07-20','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9649081541','1984-07-15',33,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jyoti Varma','0000-00-00','Jyoti Varma','','Wife',NULL,NULL,'male','Tarachandra Varma','','Wife','501953726170','501953726170','501953726170','501953726170','87867-New Doc 2017-07-20_11.jpg','3921-New Doc 2017-07-20_13.jpg','97415-New Doc 2017-07-20_13.jpg','48622-New Doc 2017-07-20_13.jpg','97613-New Doc 2017-07-20_12.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(139,NULL,'Jay Kumar Joshi','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','9589972599','1976-04-30',41,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Priti Joshi','0000-00-00','Priti Joshi','','Wife',NULL,NULL,'male','Sudam Joshi','','Wife','SHU0965137','SHU0965137','SHU0965137','SHU0965137','33751-New Doc 2017-07-23_1.jpg','24415-New Doc 2017-07-23_3.jpg','34150-New Doc 2017-07-23_3.jpg','91768-New Doc 2017-07-23_3.jpg','73968-New Doc 2017-07-23_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(140,NULL,'Trilok Mandloi','2017-07-23','Vill.- Umarda','Vill.-Umarda,Tehsil-Thikri','','9669769797','1993-12-22',23,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Devishing ','','Father',NULL,NULL,'male','Devishing ','','','418113177942','418113177942','SHU0297655','SHU0297655','87880-New Doc 2017-07-23_4.jpg','46257-New Doc 2017-07-23_6.jpg','86101-New Doc 2017-07-23_7.jpg','69194-New Doc 2017-07-23_7.jpg','1549-New Doc 2017-07-23_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(141,NULL,'Dheeraj kanungo','2017-07-23','Thikri','Gopi Vihar Colony, Thikri','','9669932360','1982-01-29',35,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Khusbu  Kanungo','0000-00-00','Khusbu  Kanungo','','Wife',NULL,NULL,'male','Suresh kanungo','','Wife','744975098041','744975098041','744975098041','744975098041','37810-New Doc 2017-07-23_8.jpg','91819-New Doc 2017-07-23_10.jpg','82485-New Doc 2017-07-23_10.jpg','96641-New Doc 2017-07-23_10.jpg','53511-New Doc 2017-07-23_9.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(142,NULL,'Mukesh Raval','2017-07-23','Gram-Makundpura,Khargone','Rajdani Hotel Thikri','','9753539365','1978-07-12',39,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','Santoshi Raval','0000-00-00','Santoshi Raval','','Wife',NULL,NULL,'male','Motilal Raval','','Wife','259200242309','259200242309','259200242309','259200242309','63630-New Doc 2017-07-23_11.jpg','65936-New Doc 2017-07-23_13.jpg','61134-New Doc 2017-07-23_13.jpg','83704-New Doc 2017-07-23_13.jpg','61374-New Doc 2017-07-23_12.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(143,NULL,'Bholaram Rathod','2017-07-23','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','12345','0000-00-00',-17965,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','Sarika Rathod','0000-00-00','Sarika Rathod','','Wife',NULL,NULL,'male','Jogilal Rathod','','Wife','523270610422','523270610422','523270610422','523270610422','75676-New Doc 2017-07-23_14.jpg','43780-New Doc 2017-07-23_16.jpg','74220-New Doc 2017-07-23_16.jpg','19397-New Doc 2017-07-23_16.jpg','11176-New Doc 2017-07-23_15.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(144,NULL,'Mulchand Megval','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','9165304120','1991-01-01',26,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Lashmi','0000-00-00','Lashmi','','Wife',NULL,NULL,'male','Raja Megval','','Wife','SHU0656777','SHU0656777','SHU0656777','SHU0656777','2244-New Doc 2017-07-23_17.jpg','29467-New Doc 2017-07-23_19.jpg','53239-New Doc 2017-07-23_19.jpg','16752-New Doc 2017-07-23_19.jpg','22868-New Doc 2017-07-23_18.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(145,NULL,'Abhishek Jaiswal','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','9987707777','1981-10-01',35,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Tuktuk Jaiswal','','',NULL,NULL,'male','RamKrishan Jaiswal','','','308999662307','308999662307','308999662307','308999662307','76232-New Doc 2017-07-23_20.jpg','64585-New Doc 2017-07-23_22.jpg','80382-New Doc 2017-07-23_22.jpg','71742-New Doc 2017-07-23_22.jpg','94940-New Doc 2017-07-23_21.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(146,NULL,'Jitandr Sen','2017-07-23','Magrkhedi Khargone','jarvah Road sen dukan,thikri','9987707777','9669284136','1982-01-01',35,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Rekha Bai','0000-00-00','Rekha Bai','','Wife',NULL,NULL,'male','Ramchandr Sen','','Wife','326088743123','326088743123','326088743123','326088743123','38369-New Doc 2017-07-23_23.jpg','23839-New Doc 2017-07-23_25.jpg','66792-New Doc 2017-07-23_25.jpg','36222-New Doc 2017-07-23_25.jpg','78346-New Doc 2017-07-23_24.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(147,NULL,'Sehjadv Khan','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','9893240259','1992-06-15',25,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Ebhrahim Khan','','Father',NULL,NULL,'male','Ebhrahim Khan','','','619108796026','619108796026','619108796026','619108796026','68762-New Doc 2017-07-23_26.jpg','58914-New Doc 2017-07-23_28.jpg','23763-New Doc 2017-07-23_28.jpg','75582-New Doc 2017-07-23_28.jpg','67867-New Doc 2017-07-23_27.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(148,NULL,'Rajendr Sen','2017-07-23','Gram-Khajuri','Gram-Khajuri, Dist.-Barwani','','7898798875','1991-01-11',26,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Pooja Sen','0000-00-00','Pooja Sen','','Wife',NULL,NULL,'male','Laxmichand Sen','','Wife','698483409975','698483409975','698483409975','698483409975','90655-New Doc 2017-07-23_32.jpg','11754-New Doc 2017-07-23_34.jpg','46799-New Doc 2017-07-23_34.jpg','16809-New Doc 2017-07-23_34.jpg','49935-New Doc 2017-07-23_33.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(149,NULL,'Tarun Patel','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','9753633302','1992-07-04',25,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Rahul Jaiswal','','Frind',NULL,NULL,'male','Santosh Patel','','','912099960777','912099960777','912099960777','912099960777','23676-New Doc 2017-07-23_35.jpg','10249-New Doc 2017-07-23_37.jpg','49152-New Doc 2017-07-23_37.jpg','65490-New Doc 2017-07-23_37.jpg','19523-New Doc 2017-07-23_36.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(150,NULL,'Mahendra Rathod','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','8959058838','1972-07-14',45,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','Anita Rathod','0000-00-00','Anita Rathod','','Wife',NULL,NULL,'male','Gajanand Rathod','','Wife','289331355809','289331355809','289331355809','289331355809','73928-New Doc 2017-07-23_38.jpg','12420-New Doc 2017-07-23_40.jpg','25847-New Doc 2017-07-23_40.jpg','47975-New Doc 2017-07-23_40.jpg','74522-New Doc 2017-07-23_39.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(151,NULL,'Nilesh Rathod','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','9669894539','1991-06-25',26,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Vandana Rathod','','Mother',NULL,NULL,'male','Ramesh Rathod','','','765834596296','765834596296','765834596296','765834596296','72094-New Doc 2017-07-23_44.jpg','40391-New Doc 2017-07-23_46.jpg','12413-New Doc 2017-07-23_46.jpg','59791-New Doc 2017-07-23_46.jpg','73368-New Doc 2017-07-23_45.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(152,NULL,'Abhishek Dasoundhi','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','9617015264','1983-10-20',33,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Pritibala','0000-00-00','Pritibala','','Wife',NULL,NULL,'male','Shripati Dasoundhi','','Wife','926079831535','926079831535','926079831535','926079831535','45137-New Doc 2017-07-23_1.jpg','52782-New Doc 2017-07-23_3.jpg','85007-New Doc 2017-07-23_3.jpg','84864-New Doc 2017-07-23_3.jpg','66530-New Doc 2017-07-23_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(153,NULL,'Shayam Kumar Gupta','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','8871350519','1975-06-12',42,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Gaytri Bai','0000-00-00','Gaytri Bai','','Wife',NULL,NULL,'male','Tukaram Gupta','','Wife','MP/36/295/238306','MP/36/295/238306',' MP/36/295/238306','MP/36/295/238306','81060-New Doc 2017-07-23_4.jpg','46983-New Doc 2017-07-23_6.jpg','60702-New Doc 2017-07-23_6.jpg','54371-New Doc 2017-07-23_6.jpg','88607-New Doc 2017-07-23_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(154,NULL,'Jeevan Balai','2017-07-23','Gram-Jarwah','Gram-Jarwah,Thikri','','7697023940','1981-01-01',36,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Kalabai','0000-00-00','Kalabai','','Wife',NULL,NULL,'male','Bholu Balai','','Wife','966118074281','966118074281','966118074281','966118074281','34856-New Doc 2017-07-23_7.jpg','59901-New Doc 2017-07-23_9.jpg','54905-New Doc 2017-07-23_9.jpg','33048-New Doc 2017-07-23_9.jpg','16166-New Doc 2017-07-23_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(155,NULL,'Rajesh rathod','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','12345','1971-06-01',46,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Pushpa Rathod','0000-00-00','Pushpa Rathod','','Wife',NULL,NULL,'male','Shankar Rathod','','Wife','830385226276','830385226276','830385226276','830385226276','57669-New Doc 2017-07-23_10.jpg','52103-New Doc 2017-07-23_12.jpg','19763-New Doc 2017-07-23_12.jpg','87020-New Doc 2017-07-23_12.jpg','9002-New Doc 2017-07-23_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(156,NULL,'Anil Varma','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','7470416610','1998-01-01',19,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Ramesh Varma','','Father',NULL,NULL,'male','Ramesh Varma','','','567935502979','567935502979','567935502979','567935502979','89011-New Doc 2017-07-23_17.jpg','9092-New Doc 2017-07-23_19.jpg','59830-New Doc 2017-07-23_19.jpg','78485-New Doc 2017-07-23_19.jpg','74795-New Doc 2017-07-23_18.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(157,NULL,'Mohaseen Khan','2017-07-23','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9826363445','1992-01-01',25,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Aarju','','',NULL,NULL,'male','Ayayub Khan','','','362375964272','362375964272','362375964272','362375964272','78959-New Doc 2017-07-23_20.jpg','20403-New Doc 2017-07-23_22.jpg','85795-New Doc 2017-07-23_22.jpg','57129-New Doc 2017-07-23_22.jpg','28352-New Doc 2017-07-23_21.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(158,NULL,'Laxmi Ptel','2017-07-23','Thikri','Thikri,Tehsil-Thikri','','9926461882','1983-01-01',34,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Mukesh Patel','0000-00-00','Mukesh Patel','','Husband',NULL,NULL,'female','','','Husband','540524081061','540524081061','540524081061','540524081061','17497-New Doc 2017-07-23_23.jpg','53995-New Doc 2017-07-23_25.jpg','41237-New Doc 2017-07-23_25.jpg','13201-New Doc 2017-07-23_25.jpg','62880-New Doc 2017-07-23_24.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(159,NULL,'Leela Yadav','2017-07-23','Gram-Kerva','Gram-Kerva,Tehsil-Thikri','','8462619590','1977-01-01',40,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Visnu Yadav','0000-00-00','Bhaskar Yadav','','',NULL,NULL,'female','','','Husband','510559215447','510559215447','510559215447','510559215447','36051-New Doc 2017-07-23_26.jpg','97371-New Doc 2017-07-23_28.jpg','11052-New Doc 2017-07-23_28.jpg','62630-New Doc 2017-07-23_28.jpg','63436-New Doc 2017-07-23_27.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(160,NULL,'Dulichand Yadav','2017-07-23','Gram-Kerva','Gram-Kerva,Tehsil-Thikri','','9009364234','1975-01-01',42,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Lalita Ydav','0000-00-00','Lalita Yadav','','Wife',NULL,NULL,'male','Ramesh Yadav','','Wife','984582346948','984582346948','984582346948','984582346948','19821-New Doc 2017-07-23_32.jpg','69026-New Doc 2017-07-23_34.jpg','97740-New Doc 2017-07-23_34.jpg','79988-New Doc 2017-07-23_34.jpg','34207-New Doc 2017-07-23_33.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(161,NULL,'Rekha Varma','2017-07-23','Gram-Kerva','Gram-Kerva,Tehsil-Thikri','`','12345','1979-01-01',38,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Dilip Varma','0000-00-00','Dilip Varma','','Husband',NULL,NULL,'female','','','Husband','423268593059','423268593059','423268593059','423268593059','51846-New Doc 2017-07-23_35.jpg','10796-New Doc 2017-07-23_37.jpg','38501-New Doc 2017-07-23_37.jpg','6384-New Doc 2017-07-23_37.jpg','70656-New Doc 2017-07-23_36.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(162,NULL,'Sulabha Bai','2017-07-23','Gram-Kerva','Gram-Kerva,Tehsil-Thikri','','9753036080','1969-01-01',48,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Shantilal ','0000-00-00','Shantilal ','','Husband',NULL,NULL,'female','','','Husband','456799123598','456799123598','456799123598','456799123598','65861-New Doc 2017-07-23_38.jpg','32125-New Doc 2017-07-23_40.jpg','71541-New Doc 2017-07-23_40.jpg','48232-New Doc 2017-07-23_40.jpg','25254-New Doc 2017-07-23_39.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(163,NULL,'Jamila Shah','2017-07-23','Thikri','Pirbaba ki bedi,Thikri','','9644846150','1972-01-01',45,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Roovabalee','0000-00-00','Roovabalee','','Husband',NULL,NULL,'female','','','Husband',' 205512347424','205512347424','205512347424','205512347424','24073-New Doc 2017-07-23_1.jpg','42624-New Doc 2017-07-23_3.jpg','78113-New Doc 2017-07-23_3.jpg','41156-New Doc 2017-07-23_3.jpg','19883-New Doc 2017-07-23_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(164,NULL,'Parvin Jabir khan','2017-07-23','Thikri','Pirbaba ki bedi,Thikri','','12345','1988-01-01',29,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jabir Khan','0000-00-00','Jabir Khan','','Husband',NULL,NULL,'female','','','Husband','867319831492','867319831492','867319831492','867319831492','14621-New Doc 2017-07-23_4.jpg','20173-New Doc 2017-07-23_6.jpg','75997-New Doc 2017-07-23_6.jpg','82627-New Doc 2017-07-23_6.jpg','78098-New Doc 2017-07-23_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(165,NULL,'Meshar Bai','2017-07-23','Thikri','Pirbaba ki bedi,Thikri','','7694975482','1977-01-01',40,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Munna Devrikya','0000-00-00','Munna Devrikya','','Husband',NULL,NULL,'female','','','Husband','646035776149','646035776149','646035776149','646035776149','83591-New Doc 2017-07-23_7.jpg','28165-New Doc 2017-07-23_9.jpg','73235-New Doc 2017-07-23_9.jpg','2033-New Doc 2017-07-23_9.jpg','68082-New Doc 2017-07-23_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(166,NULL,'Ruksana ','2017-07-23','Thikri','bedi pura thikri','','9753869636','1978-01-01',39,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sabir Shah','0000-00-00','Sabir Shah','','Husband',NULL,NULL,'female','','','Husband','776423739091','776423739091','776423739091','776423739091','11345-New Doc 2017-07-23_10.jpg','67485-New Doc 2017-07-23_12.jpg','19118-New Doc 2017-07-23_12.jpg','71569-New Doc 2017-07-23_12.jpg','85851-New Doc 2017-07-23_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(167,NULL,'Durga Bai Yadav','2017-07-23','Thikri','Yadav Mohalla,thikri','','12345','1964-01-01',53,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Badriprasad Yadav','0000-00-00','Badriprasad Yadav','','Husband',NULL,NULL,'female','','','Husband','883633641605','883633641605','883633641605 ','883633641605','8893-New Doc 2017-07-23_13.jpg','9992-New Doc 2017-07-23_15.jpg','26612-New Doc 2017-07-23_15.jpg','20218-New Doc 2017-07-23_15.jpg','3391-New Doc 2017-07-23_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(168,NULL,'Nurjaha ','2017-07-23','Thikri','Pirbaba ki bedi,Thikri','','9617141361','1988-01-01',29,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sikandar','0000-00-00','Sikandar','','Husband',NULL,NULL,'female','','','Husband','526733741632','526733741632','526733741632','526733741632','45857-New Doc 2017-07-23_16.jpg','40616-New Doc 2017-07-23_18.jpg','74288-New Doc 2017-07-23_18.jpg','76267-New Doc 2017-07-23_18.jpg','92497-New Doc 2017-07-23_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(169,NULL,'Binu Bai Varma','2017-07-23','Thikri','Pirbaba ki bedi,Thikri','','9826195366','1961-01-01',56,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Badrilal Varma','0000-00-00','Badrilal Varma','','Husband',NULL,NULL,'female','','','Husband','552196365579','552196365579','552196365579','552196365579','68930-New Doc 2017-07-23_19.jpg','80878-New Doc 2017-07-23_21.jpg','61161-New Doc 2017-07-23_21.jpg','48017-New Doc 2017-07-23_21.jpg','13164-New Doc 2017-07-23_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(170,NULL,'Keilash Varma','2017-07-23','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9537458783','1976-01-01',41,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Gangaram Varma','','','528510620894','528510620894','528510620894','528510620894','87691-New Doc 2017-07-23_22.jpg','17609-New Doc 2017-07-23_24.jpg','98122-New Doc 2017-07-23_24.jpg','68390-New Doc 2017-07-23_24.jpg','48924-New Doc 2017-07-23_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(171,NULL,'Lalita Yadav','2017-07-24','Thikri','Yadav Mohalla,thikri','','12345','1993-01-01',24,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Pardip Yadav','0000-00-00','Pardip Yadav','','Husband',NULL,NULL,'female','','','Husband','983375959625','983375959625','983375959625','983375959625','89005-New Doc 2017-07-23_25.jpg','80221-New Doc 2017-07-23_27.jpg','83928-New Doc 2017-07-23_27.jpg','99422-New Doc 2017-07-23_27.jpg','87594-New Doc 2017-07-23_26.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(172,NULL,'Nafisa Khan','2017-07-24','Thikri','Nayta mohalla Thikri','','12345','1984-01-01',33,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Dilawar Khan','0000-00-00','Dilawar Khan','','Husband',NULL,NULL,'female','','','Husband','800717999781','800717999781','800717999781','800717999781','41973-New Doc 2017-07-23_28.jpg','49737-New Doc 2017-07-23_30.jpg','18786-New Doc 2017-07-23_30.jpg','2483-New Doc 2017-07-23_30.jpg','71260-New Doc 2017-07-23_29.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(173,NULL,'Yeshwant Yadav','2017-07-24','Gram-Abhali','Gram-Abhali,Barwani','','8959297052','1989-05-16',28,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Bhagvati Yashvant Yadav','0000-00-00','Bhagvati Yashvant Yadav','','Wife',NULL,NULL,'male','Pandari Yadav','','Wife','351624198383','351624198383','351624198383','351624198383','6232-New Doc 2017-07-23_31.jpg','1333-New Doc 2017-07-23_33.jpg','7758-New Doc 2017-07-23_33.jpg','95637-New Doc 2017-07-23_33.jpg','48600-New Doc 2017-07-23_32.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(174,NULL,'Pintu Rathod','2017-07-24','Thikri','Thikri,Tehsil-Thikri','','9754848048','1992-07-01',25,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Omprakash Rathod','','Father',NULL,NULL,'male','Omprakash Rathod','','','982119147484','982119147484','982119147484','982119147484','82551-New Doc 2017-07-23_34.jpg','55851-New Doc 2017-07-23_36.jpg','45827-New Doc 2017-07-23_36.jpg','15661-New Doc 2017-07-23_36.jpg','57959-New Doc 2017-07-23_35.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(175,NULL,'Noushad Pathan','2017-07-24','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9754816222','1991-01-01',26,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Shabanam Pathan','0000-00-00','Shabanam Pathan','','Wife',NULL,NULL,'male','Jibrail Pathan','','Wife','996375224558','996375224558','996375224558','996375224558','96045-New Doc 2017-07-23_37.jpg','35563-New Doc 2017-07-23_39.jpg','34627-New Doc 2017-07-23_39.jpg','97340-New Doc 2017-07-23_39.jpg','26335-New Doc 2017-07-23_38.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(176,NULL,'Poona Bai Varma','2017-07-24','Thikri','Pirbaba ki bedi,Thikri','','7694957233','1987-01-01',30,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Kalu Varma','0000-00-00','Kalu Varma','','Husband',NULL,NULL,'female','','','Husband','272172428716','272172428716','272172428716','272172428716','56671-New Doc 2017-07-24_1.jpg','7916-New Doc 2017-07-24_3.jpg','94920-New Doc 2017-07-24_3.jpg','16082-New Doc 2017-07-24_3.jpg','20650-New Doc 2017-07-24_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(177,NULL,'Rubina Shah','2017-07-24','Thikri','Pirbaba ki bedi,Thikri','','9644846150','1996-08-30',20,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jafar Shah','0000-00-00','Jafar Shah','','Husband',NULL,NULL,'female','','','','485285350302','485285350302','485285350302','485285350302','35453-New Doc 2017-07-24_4.jpg','20745-New Doc 2017-07-24_6.jpg','1785-New Doc 2017-07-24_6.jpg','12704-New Doc 2017-07-24_6.jpg','65027-New Doc 2017-07-24_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(178,NULL,'Jeevan Rawal','2017-07-24','Gram-Makundpura,Khargone','purana bus stand Thikri','','9981584445','1981-06-20',36,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Santoshi Raval','0000-00-00','Santoshi Raval','','Wife',NULL,NULL,'male','Motilal Raval','','Wife','879039789947','879039789947','879039789947','879039789947','88017-New Doc 2017-07-24_7.jpg','60949-New Doc 2017-07-24_9.jpg','85028-New Doc 2017-07-24_9.jpg','97243-New Doc 2017-07-24_9.jpg','66544-New Doc 2017-07-24_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(179,NULL,'Nitin Jaiswal','2017-07-24','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9981702144','1981-04-25',36,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Premlal Jaiswal','','','863986490063','863986490063','863986490063','863986490063','55822-New Doc 2017-07-24_10.jpg','4922-New Doc 2017-07-24_12.jpg','4390-New Doc 2017-07-24_12.jpg','84948-New Doc 2017-07-24_12.jpg','54737-New Doc 2017-07-24_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(180,NULL,'Priti Varma','2017-07-24','Gram-Dawana','Gram-Dawana,Tehsil-Thikri','','9926657166','1983-09-01',33,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Narendra Varma','0000-00-00','Narendra Varma','','Husband',NULL,NULL,'female','','','Husband','867189921833','867189921833','867189921833','867189921833','30960-New Doc 2017-07-24_13.jpg','35734-New Doc 2017-07-24_15.jpg','38611-New Doc 2017-07-24_15.jpg','34129-New Doc 2017-07-24_15.jpg','55177-New Doc 2017-07-24_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(181,NULL,'Yogendra Rathod','2017-07-24','Thikri','Thikri,Tehsil-Thikri','','9754966669','1985-08-28',31,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','Ankita Rathod','0000-00-00','Ankita Rathod','','w',NULL,NULL,'male','Babulal Rathod','','Wife','281571011862','281571011862','281571011862','281571011862','15349-New Doc 2017-07-24_16.jpg','41860-New Doc 2017-07-24_18.jpg','96092-New Doc 2017-07-24_18.jpg','94971-New Doc 2017-07-24_18.jpg','88660-New Doc 2017-07-24_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(182,NULL,'Sunil Sen','2017-07-24','Thikri','Nayata Mohalla,Thikri','','9926025985','1985-01-01',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Kiran ji sen','0000-00-00','Kiran ji sen','','Wife',NULL,NULL,'male','Kailash Sen','','Wife','657788854600','657788854600','657788854600','657788854600','89571-New Doc 2017-07-24_19.jpg','30510-New Doc 2017-07-24_21.jpg','16361-New Doc 2017-07-24_21.jpg','44924-New Doc 2017-07-24_21.jpg','62982-New Doc 2017-07-24_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(183,NULL,'Rameshwar Sen','2017-07-24','Padlya Khurd, Khargone','Chanda Jents Palar Thikri','','9977759310','1974-01-01',43,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Aruna Bai ','0000-00-00','Aruna Bai ','','Wife',NULL,NULL,'male','Daluram Sen','','Wife','458064979206','458064979206','458064979206','458064979206','75954-New Doc 2017-07-24_22.jpg','43691-New Doc 2017-07-24_24.jpg','90527-New Doc 2017-07-24_24.jpg','75010-New Doc 2017-07-24_24.jpg','21109-New Doc 2017-07-24_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(184,NULL,'Laxman Meghwal','2017-07-24','Thikri','Pirbaba ki bedi,Thikri','','7415899474','1991-08-05',25,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Maalu Megwal','0000-00-00','Maalu Megwal','','Wife',NULL,NULL,'male','Govind Meghwal','','Wife','886533610947','886533610947','886533610947','886533610947','70765-New Doc 2017-07-24_25.jpg','84740-New Doc 2017-07-24_27.jpg','14840-New Doc 2017-07-24_27.jpg','68420-New Doc 2017-07-24_27.jpg','75310-New Doc 2017-07-24_26.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(185,NULL,'Dipak Meghwal','2017-07-24','Thikri','Dashera maidan Thikri','','7415899474','2001-08-04',15,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Vaala','','','300801228352','300801228352','300801228352','300801228352','98715-New Doc 2017-07-24_28.jpg','49951-New Doc 2017-07-24_30.jpg','16835-New Doc 2017-07-24_30.jpg','19613-New Doc 2017-07-24_30.jpg','34141-New Doc 2017-07-24_29.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(186,NULL,'Hiralal Meghwal','2017-07-24','Thikri','CharanMohalla,Thikri','','7477044998','1989-01-01',28,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Rupali Meghwal','0000-00-00','Rupali Meghwal','','Wife',NULL,NULL,'male','Raja Meghwal','','Wife','523971739094','523971739094','523971739094','523971739094','62663-New Doc 2017-07-24_31.jpg','78108-New Doc 2017-07-24_33.jpg','15170-New Doc 2017-07-24_33.jpg','21149-New Doc 2017-07-24_33.jpg','24125-New Doc 2017-07-24_32.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(187,NULL,'Rohit Rathod','2017-07-24','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9516424800','1997-02-17',20,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Bhartee Rathod','','',NULL,NULL,'male','Santosh Rathod','','','354074570385','354074570385','354074570385','354074570385','75867-New Doc 2017-07-24_34.jpg','56213-New Doc 2017-07-24_36.jpg','82630-New Doc 2017-07-24_36.jpg','46813-New Doc 2017-07-24_36.jpg','4505-New Doc 2017-07-24_35.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(188,NULL,'Nargis Bi','2017-07-24','Thikri','Pirbaba ki bedi,Thikri','','9755049736','1995-01-01',22,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Piru Shah','0000-00-00','Piru Shah','','Husband',NULL,NULL,'female','','','Husband','SHU0937409','SHU0937409','SHU0937409','SHU0937409','62883-New Doc 2017-07-24_1.jpg','82505-New Doc 2017-07-24 (1)_2.jpg','82216-New Doc 2017-07-24 (1)_2.jpg','96030-New Doc 2017-07-24 (1)_1.jpg','4939-New Doc 2017-07-24_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(189,NULL,'Lalee Koche','2017-07-24','Rampura Balakwada,','Sai Mandir Thikri','','8462025156','1985-01-01',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Sardar Koche','0000-00-00','Sardar Koche','','Husband',NULL,NULL,'female','','','Husband','706671854263','706671854263','706671854263','706671854263','87218-New Doc 2017-07-24_4.jpg','46830-New Doc 2017-07-24_6.jpg','47650-New Doc 2017-07-24_6.jpg','11784-New Doc 2017-07-24_6.jpg','37263-New Doc 2017-07-24_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(190,NULL,'Balaram Rathod','2017-07-24','Thikri','Thikri,Tehsil-Thikri','','12345','1984-01-01',33,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Gajannd Rathod','','Father',NULL,NULL,'male','Gajannd Rathod','','','389667943015','389667943015','389667943015','389667943015','36251-New Doc 2017-07-24_7.jpg','32334-New Doc 2017-07-24_9.jpg','44788-New Doc 2017-07-24_9.jpg','12895-New Doc 2017-07-24_9.jpg','91618-New Doc 2017-07-24_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(191,NULL,'Kiran Rathod','2017-07-24','Thikri','Thikri,Tehsil-Thikri','','123455','1988-01-01',29,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Balaram Rathod','0000-00-00','Balaram Rathod','','Husband',NULL,NULL,'female','','','Husband','758015911237','758015911237','758015911237','758015911237','91110-New Doc 2017-07-24_10.jpg','76125-New Doc 2017-07-24_12.jpg','5021-New Doc 2017-07-24_12.jpg','11370-New Doc 2017-07-24_12.jpg','49741-New Doc 2017-07-24_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(192,NULL,'Erfan Shah','2017-07-24','Thikri','Thikri,Tehsil-Thikri','','9753869636','1996-01-01',21,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Sabir Shah','','Father',NULL,NULL,'male','Sabir Shah','','','382446387488','382446387488','382446387488','382446387488','6978-New Doc 2017-07-24_19.jpg','61639-New Doc 2017-07-24_21.jpg','79039-New Doc 2017-07-24_21.jpg','48900-New Doc 2017-07-24_21.jpg','22376-New Doc 2017-07-24_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(193,NULL,'Shehajad Pathan','2017-07-24','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','8966832885','1989-01-01',28,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Najma','','',NULL,NULL,'female','Jeebrail','','','SHU0873935','SHU0873935','SHU0873935','SHU0873935','92540-New Doc 2017-07-24_22.jpg','1485-New Doc 2017-07-24_24.jpg','76422-New Doc 2017-07-24_24.jpg','93182-New Doc 2017-07-24_24.jpg','23111-New Doc 2017-07-24_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(194,NULL,'Sangeeta Rathod','2017-07-24','Thikri','Pirbaba ki bedi,Thikri','','7354527559','1983-01-01',34,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Tukaram Rathod','0000-00-00','Tukaram Rathod','','Husband',NULL,NULL,'female','','','Husband','731542407049','731542407049','731542407049','731542407049','25003-New Doc 2017-07-24_25.jpg','83723-New Doc 2017-07-24_27.jpg','87061-New Doc 2017-07-24_27.jpg','24609-New Doc 2017-07-24_27.jpg','27180-New Doc 2017-07-24_26.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(195,NULL,'Akil Shah','2017-07-24','Thikri','Thikri,Tehsil-Thikri','','9753017430','1982-01-01',35,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Rashid Shah','','Father',NULL,NULL,'male','Rashid Shah','','','SHU0481929','SHU0481929','SHU0481929','SHU0481929','14214-New Doc 2017-07-24_28.jpg','86571-New Doc 2017-07-24 (1)_3.jpg','39323-New Doc 2017-07-24 (1)_3.jpg','36650-New Doc 2017-07-24 (1)_3.jpg','78566-New Doc 2017-07-24_29.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(196,NULL,'Kallu Shah','2017-07-25','Thikri','bedi pura thikri','','9752101603','1968-01-01',49,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Suleman Shah','','Father',NULL,NULL,'male','Suleman Shah','','','481745344318','481745344318','481745344318','481745344318','3242-New Doc 2017-07-25_1.jpg','42384-New Doc 2017-07-25_3.jpg','3800-New Doc 2017-07-25_3.jpg','34481-New Doc 2017-07-25_3.jpg','78929-New Doc 2017-07-25_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(197,NULL,'Shabbir Khan','2017-07-25','Thikri','Thikri,Tehsil-Thikri','','8225013363','1978-01-01',39,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Gul Mohammad Khan','','Father',NULL,NULL,'male','Gul Mohammad Khan','','','496996830388','496996830388','496996830388','496996830388','3468-New Doc 2017-07-25_4.jpg','29576-New Doc 2017-07-25_6.jpg','78215-New Doc 2017-07-25_6.jpg','85130-New Doc 2017-07-25_6.jpg','97186-New Doc 2017-07-25_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(198,NULL,'Suvanra Patil','2017-07-25','Thikri','Gopi Vihar Colony, Thikri','','7566988457','1984-01-01',33,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Rajendr Patil','0000-00-00','Rajendr Patil','','Husband',NULL,NULL,'female','','','Husband','763313656536','763313656536','763313656536','763313656536','19814-New Doc 2017-07-25_7.jpg','48877-New Doc 2017-07-25_9.jpg','38457-New Doc 2017-07-25_9.jpg','59395-New Doc 2017-07-25_9.jpg','73093-New Doc 2017-07-25_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(199,NULL,'Sona Bai Nigval','2017-07-25','Gram-Kerva','Gram-Kerva,Tehsil-Thikri','','12345','1962-01-01',55,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Kalu Nigval','0000-00-00','Kalu Nigval','','Husband',NULL,NULL,'female','','','Husband','716108229957','716108229957','716108229957','716108229957','18761-New Doc 2017-07-25_10.jpg','53034-New Doc 2017-07-25_12.jpg','38451-New Doc 2017-07-25_12.jpg','90147-New Doc 2017-07-25_12.jpg','92390-New Doc 2017-07-25_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(200,NULL,'Sukhdev Kochak','2017-07-25','Gram-dabhad','Gram-dabhad,teh.-Thikri','','8889110783','1960-07-04',57,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Ramendr Mandloi','','',NULL,NULL,'male','Raghunath Kochak','','','MP/36/295/174816','MP/36/295/174816','MP/36/295/174816','MP/36/295/174816','65103-New Doc 2017-07-25_13.jpg','59026-New Doc 2017-07-25_15.jpg','58766-New Doc 2017-07-25_15.jpg','88901-New Doc 2017-07-25_15.jpg','72337-New Doc 2017-07-25_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(201,NULL,'Uttam Yadav ','2017-07-25','Gram-Bhagvanpura','Gram-Bhagvanpura,Teh.-Thikri','','9826498099','1992-08-02',24,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Manisha Yadav','0000-00-00','Manisha Yadav','','Wife',NULL,NULL,'male','Tilok Yadav','','Wife','912055925261','912055925261','912055925261','912055925261','68190-New Doc 2017-07-25_16.jpg','73595-New Doc 2017-07-25_18.jpg','95343-New Doc 2017-07-25_18.jpg','44080-New Doc 2017-07-25_18.jpg','38529-New Doc 2017-07-25_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(202,NULL,'Lakhan Sen','2017-07-25','Gram-Jarwah','Gram-Jarwah,Thikri','','12345','2000-01-01',17,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Jagan Sen','','','996005260345','996005260345','996005260345','996005260345','56409-New Doc 2017-07-25_19.jpg','13375-New Doc 2017-07-25_21.jpg','82948-New Doc 2017-07-25_21.jpg','10866-New Doc 2017-07-25_21.jpg','19579-New Doc 2017-07-25_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(203,NULL,'Shabana Shah','2017-07-25','Thikri','Thikri,Tehsil-Thikri','','12345','1988-08-28',28,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Shabab Shah','0000-00-00','Shabab Shah','','Husband',NULL,NULL,'female','','','Husband','597567295290','597567295290','SHU0481887','SHU0481887','89036-New Doc 2017-07-25_1.jpg','5364-New Doc 2017-07-25_4.jpg','17209-New Doc 2017-07-25_3.jpg','54222-New Doc 2017-07-25_3.jpg','1644-New Doc 2017-07-25_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(204,NULL,'Kanha Meghawal','2017-07-26','Thikri','CharanMohalla,Thikri','','7415899474','2003-01-01',14,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Dayaa Bai','','Mother',NULL,NULL,'male','Govind Meghawal','','','966312092171','966312092171','966312092171','966312092171','31101-New Doc 2017-07-26_1.jpg','4771-New Doc 2017-07-26_3.jpg','25702-New Doc 2017-07-26_3.jpg','86413-New Doc 2017-07-26_3.jpg','30875-New Doc 2017-07-26_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(205,NULL,'Imaran Khatri','2017-07-26','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9617175961','1988-01-01',29,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Rihana Khatri','','',NULL,NULL,'male','Gaffar Khatri','','','894321755610','894321755610','894321755610','894321755610','41358-New Doc 2017-07-26_4.jpg','40180-New Doc 2017-07-26_6.jpg','10458-New Doc 2017-07-26_6.jpg','88441-New Doc 2017-07-26_6.jpg','75095-New Doc 2017-07-26_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(206,NULL,'Rohit Varma','2017-07-26','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','8889928365','1993-01-05',24,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Radha Bai','','Mother',NULL,NULL,'male','Ganesh Varma','','','449297105797','449297105797','449297105797','449297105797','66290-New Doc 2017-07-26_7.jpg','64401-New Doc 2017-07-26_9.jpg','76658-New Doc 2017-07-26_9.jpg','66722-New Doc 2017-07-26_9.jpg','89649-New Doc 2017-07-26_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(207,NULL,'Saniya Meghawal','2017-07-26','Thikri','Thikri,Tehsil-Thikri','','9184468751','1995-01-01',22,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Vikram','','Brother',NULL,NULL,'male','Daya Meghawal','','','908432020674','908432020674','908432020674','908432020674','10348-New Doc 2017-07-26_13.jpg','34484-New Doc 2017-07-26_15.jpg','99672-New Doc 2017-07-26_15.jpg','83648-New Doc 2017-07-26_15.jpg','85217-New Doc 2017-07-26_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(208,NULL,'Hirdaram Chouhan','2017-07-26','Gram-Abhali','Gram-Abhali,Barwani','','7697472019','1967-01-01',50,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Subadra Chouhan','0000-00-00','Subadra Chouhan','','Wife',NULL,NULL,'male','Bhika Chouhan','','Wife','896782403361','896782403361','896782403361','896782403361','70315-New Doc 2017-07-26_16.jpg','62223-New Doc 2017-07-26_18.jpg','23353-New Doc 2017-07-26_18.jpg','74880-New Doc 2017-07-26_18.jpg','72407-New Doc 2017-07-26_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(209,NULL,'Radha Bai Yadav','2017-07-26','Thikri','Yadav Mohalla,thikri','','12345','1988-01-01',29,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Shriram Yadav','0000-00-00','Shriram Yadav','','Husband',NULL,NULL,'female','','','Husband','985434625854','985434625854','985434625854','985434625854','34363-New Doc 2017-07-26_1.jpg','86111-New Doc 2017-07-26_3.jpg','29352-New Doc 2017-07-26_3.jpg','43483-New Doc 2017-07-26_3.jpg','51047-New Doc 2017-07-26_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(210,NULL,'Sanjay Manvare','2017-07-26','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','12345','1985-01-01',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Jagan Manvare','','','277693330219','277693330219','277693330219','277693330219','41875-New Doc 2017-07-26_4.jpg','97199-New Doc 2017-07-26_6.jpg','43520-New Doc 2017-07-26_6.jpg','85368-New Doc 2017-07-26_6.jpg','65783-New Doc 2017-07-26_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(211,NULL,'Jitendra Singh','2017-07-26','Gram-Jarwah','Gram-Jarwah,Thikri','','12345','1975-01-01',42,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Kishor Singh','','','HZC2019172','HZC2019172','HZC2019172','HZC2019172','6009-New Doc 2017-07-26_7.jpg','15947-New Doc 2017-07-26_9.jpg','84899-New Doc 2017-07-26_9.jpg','10677-New Doc 2017-07-26_9.jpg','50095-New Doc 2017-07-26_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(212,NULL,'Dinesh Dhangar','2017-07-26','Thikri','Dashera maidan Thikri','','9893443102','1974-03-12',43,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Subadra Dhangar','0000-00-00','Subadra Dhangar','','Wife',NULL,NULL,'male','Shivjee Dhangar','','Wife','792909847531','792909847531','792909847531','792909847531','11234-New Doc 2017-07-26_10.jpg','64400-New Doc 2017-07-26_12.jpg','10092-New Doc 2017-07-26_12.jpg','86686-New Doc 2017-07-26_12.jpg','77410-New Doc 2017-07-26_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(213,NULL,'Yogendra Saraf','2017-07-27','Thikri','Nayata Mohalla,Thikri','','9981399774','1978-01-20',39,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Shayam Saraf','','',NULL,NULL,'male','Damodar Saraf','','','479535973236','479535973236','479535973236','479535973236','96890-New Doc 2017-07-26_13.jpg','66868-New Doc 2017-07-26_15.jpg','85354-New Doc 2017-07-26_15.jpg','2924-New Doc 2017-07-26_15.jpg','98120-New Doc 2017-07-26_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(214,NULL,'Arun Rathod','2017-07-27','Thikri','Thikri,Tehsil-Thikri','','12345','1991-01-01',26,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Usha Rathod','0000-00-00','Usha Rathod','','Wife',NULL,NULL,'male','Prakash Rathod','','Wife','960281954447','960281954447','960281954447','960281954447','1133-New Doc 2017-07-26_16.jpg','58537-New Doc 2017-07-26_18.jpg','59157-New Doc 2017-07-26_18.jpg','65580-New Doc 2017-07-26_18.jpg','6682-New Doc 2017-07-26_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(215,NULL,'Jabir Shah','2017-07-27','Thikri','bedi pura thikri','','9179319513','1979-01-01',38,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Nasim Shah','0000-00-00','Nasim Shah','','Wife',NULL,NULL,'male','Ikbal Shah','','Wife','907988298223','907988298223','907988298223','907988298223','42771-New Doc 2017-07-26_19.jpg','19142-New Doc 2017-07-26_21.jpg','7137-New Doc 2017-07-26_21.jpg','94342-New Doc 2017-07-26_21.jpg','27397-New Doc 2017-07-26_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(216,NULL,'Sunil Jadam ','2017-07-27','Thikri','Kahar Mohalla Thikri','','9752956315','1997-01-01',20,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Jitendra Jadam ','','Brother',NULL,NULL,'male','Kalu Jadam','','','976967881622','976967881622','976967881622','976967881622','3151-New Doc 2017-07-26_22.jpg','79721-New Doc 2017-07-26_24.jpg','71135-New Doc 2017-07-26_24.jpg','65267-New Doc 2017-07-26_24.jpg','2969-New Doc 2017-07-26_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(217,NULL,'Naresh Parmar','2017-07-27','Thikri','Pirbaba ki bedi,Thikri','','7866820456','1993-01-01',24,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Sannalal Parmar','','Father',NULL,NULL,'male','Sannalal Parmar','','','877129361985','877129361985','877129361985','877129361985','27094-New Doc 2017-07-26_25.jpg','61164-New Doc 2017-07-26_27.jpg','85240-New Doc 2017-07-26_27.jpg','52266-New Doc 2017-07-26_27.jpg','51627-New Doc 2017-07-26_26.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(218,NULL,'Rehamat Bee','2017-07-27','Thikri','Pirbaba ki bedi,Thikri','','9753083600','1981-01-01',36,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Masoomashah','0000-00-00','Parvesh ','','Son',NULL,NULL,'female','','','','HZC1787118','HZC1787118','HZC1787118','HZC1787118','45299-New Doc 2017-07-26_28.jpg','58368-New Doc 2017-07-26_30.jpg','5403-New Doc 2017-07-26_30.jpg','42707-New Doc 2017-07-26_30.jpg','13094-New Doc 2017-07-26_29.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(219,NULL,'Anil Jadam ','2017-07-27','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9754946546','1985-04-02',32,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Dhurv Jadam','','',NULL,NULL,'male','Ganesh Jadam','','','933816311792','933816311792','933816311792','933816311792','49799-New Doc 2017-07-26_31.jpg','2209-New Doc 2017-07-26_33.jpg','59327-New Doc 2017-07-26_33.jpg','69471-New Doc 2017-07-26_33.jpg','39072-New Doc 2017-07-26_32.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(220,NULL,'Bhagwan Prajapati','2017-07-27','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','12345','1968-07-01',49,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Laxmi Bai Prajapati','0000-00-00','Laxmi Bai Prajapati','','Wife',NULL,NULL,'male','Sitaram Prajapati','','Wife','SHU1137124','SHU1137124','SHU1137124','SHU1137124','54492-New Doc 2017-07-26_34.jpg','78342-New Doc 2017-07-26_36.jpg','28648-New Doc 2017-07-26_36.jpg','49169-New Doc 2017-07-26_36.jpg','9931-New Doc 2017-07-26_35.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(221,NULL,'Asha Patidar','2017-07-27','Gram-Kuwa','Gram-Kuwa,Teh.-Thikri','','8889957863','1971-09-30',45,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Subhash Patidar','0000-00-00','Subhash Patidar','','Husband',NULL,NULL,'female','','','Husband','950939017130','950939017130','950939017130','950939017130','93302-New Doc 2017-07-26_37.jpg','77557-New Doc 2017-07-26_39.jpg','40898-New Doc 2017-07-26_39.jpg','16769-New Doc 2017-07-26_39.jpg','28484-New Doc 2017-07-26_38.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(222,NULL,'Girja Yadav','2017-07-27','Thikri','Yadav Mohalla,thikri','','12345','1983-01-01',34,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Dinesh Yadav','0000-00-00','Dinesh Yadav','','Husband',NULL,NULL,'female','','','Husband','452364593056','452364593056','452364593056','452364593056','35645-New Doc 2017-07-27_1.jpg','54252-New Doc 2017-07-27_3.jpg','64190-New Doc 2017-07-27_3.jpg','74660-New Doc 2017-07-27_3.jpg','95519-New Doc 2017-07-27_2.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(223,NULL,'Rupali Yadav','2017-07-27','Thikri','Yadav Mohalla,thikri','','12345','1997-05-20',20,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Jaynat Yadav','0000-00-00','Jaynat Yadav','','Husband',NULL,NULL,'female','','','Husband','307958948346','307958948346','307958948346','307958948346','67371-New Doc 2017-07-27_4.jpg','61831-New Doc 2017-07-27_6.jpg','8400-New Doc 2017-07-27_6.jpg','72032-New Doc 2017-07-27_6.jpg','98019-New Doc 2017-07-27_5.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(224,NULL,'Lakhan Varma','2017-07-27','Thikri','Dindayal colony Thikri','','8889035525','1976-01-01',41,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Ganga Bai Varma','0000-00-00','Ganga Bai Varma','','Wife',NULL,NULL,'male','Kasiram Varma','','Wife','340770049229','340770049229','340770049229','340770049229','3192-New Doc 2017-07-27_7.jpg','63597-New Doc 2017-07-27_9.jpg','51030-New Doc 2017-07-27_9.jpg','76885-New Doc 2017-07-27_9.jpg','86859-New Doc 2017-07-27_8.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(225,NULL,'Javed Khan ','2017-07-27','Thikri','Nayata Mohalla,Thikri','','12345','1983-03-01',34,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Rehamat Bee','','',NULL,NULL,'male','Haidaralee Khan','','','567551639446','567551639446','567551639446','567551639446','65731-New Doc 2017-07-27_10.jpg','57675-New Doc 2017-07-27_12.jpg','54508-New Doc 2017-07-27_12.jpg','52727-New Doc 2017-07-27_12.jpg','39940-New Doc 2017-07-27_11.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(226,NULL,'Ajay Varma','2017-07-27','Thikri','Thikri,Tehsil-Thikri','','12345','1991-03-15',26,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','','','',NULL,NULL,'male','Kailassh Varma','','','655679449431','655679449431','655679449431','655679449431','54763-New Doc 2017-07-27_13.jpg','72435-New Doc 2017-07-27_15.jpg','80693-New Doc 2017-07-27_15.jpg','44128-New Doc 2017-07-27_15.jpg','31163-New Doc 2017-07-27_14.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(227,NULL,'Anil Matre','2017-07-27','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','12345','1978-09-05',38,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Lataa Bai Varma','0000-00-00','','','',NULL,NULL,'male','RAmesh Matre','','','874157068143','874157068143','874157068143','874157068143','86224-New Doc 2017-07-27_16.jpg','73328-New Doc 2017-07-27_18.jpg','8757-New Doc 2017-07-27_18.jpg','61876-New Doc 2017-07-27_18.jpg','34504-New Doc 2017-07-27_17.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(228,NULL,'Jabir Khan','2017-07-27','Thikri','Nayata Mohalla,Thikri','','9977808053','1986-01-01',31,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Shabanur','0000-00-00','Shabanur Jabir Khan','','Wife',NULL,NULL,'male','Pir Mahommad Khan','','Wife','233046583835','233046583835','233046583835','233046583835','55447-New Doc 2017-07-27_19.jpg','79061-New Doc 2017-07-27_21.jpg','89010-New Doc 2017-07-27_21.jpg','36277-New Doc 2017-07-27_21.jpg','51683-New Doc 2017-07-27_20.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(229,NULL,'Samina Khan','2017-07-27','Thikri','Pirbaba ki bedi,Thikri','','12345','1986-01-01',31,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Firoj Khan','0000-00-00','Afarin Khan','','Son',NULL,NULL,'female','','','Husband','311136376639','311136376639','311136376639','311136376639','91116-New Doc 2017-07-27_22.jpg','37375-New Doc 2017-07-27_24.jpg','47953-New Doc 2017-07-27_24.jpg','66656-New Doc 2017-07-27_24.jpg','56445-New Doc 2017-07-27_23.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(230,NULL,'Laxmi Karma','2017-07-27','Thikri','Rathod mohalla, Thikri','','9923536144','1973-01-01',44,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'married','Kamaldas Karma','0000-00-00','Kamaldas Karma','','Husband',NULL,NULL,'female','','','Husband','670801841338','670801841338','670801841338','670801841338','47221-New Doc 2017-07-27_25.jpg','38513-New Doc 2017-07-27_27.jpg','84112-New Doc 2017-07-27_27.jpg','9966-New Doc 2017-07-27_27.jpg','93198-New Doc 2017-07-27_26.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(231,NULL,'Santosh Salwe','2017-07-27','Gram-Pipri','Gram-Pipri,Post-Thikri,Tehsil-Thikri','','9754319250','1980-01-01',37,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Rahul Shinde','','Son',NULL,NULL,'male','Rajaram Salwe','','','526574973605','526574973605','526574973605','526574973605','48067-New Doc 2017-07-27_28.jpg','72737-New Doc 2017-07-27_30.jpg','4532-New Doc 2017-07-27_30.jpg','23709-New Doc 2017-07-27_30.jpg','8373-New Doc 2017-07-27_29.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL),(232,NULL,'Raja Yadav','2017-07-27','Thikri','Thikri,Tehsil-Thikri','','8748975151','1993-01-01',24,10,5,8,'Pardeepjaiswal50@gmail.com',451660,'','','0000-00-00','Gangaram Yadav','','Grand Father',NULL,NULL,'male','Mahesh Yadav','','','638164288622','638164288622','638164288622','638164288622','17793-New Doc 2017-07-27_31.jpg','87639-New Doc 2017-07-27_33.jpg','21776-New Doc 2017-07-27_33.jpg','28413-New Doc 2017-07-27_33.jpg','57899-New Doc 2017-07-27_32.jpg',50,11,0,33,'pending',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailsetup`
--

DROP TABLE IF EXISTS `emailsetup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailsetup` (
  `EmailSetupId` int(11) NOT NULL AUTO_INCREMENT,
  `EmailId` longtext,
  `EmailIdPassword` longtext,
  `smtphost` varchar(50) DEFAULT NULL,
  `portno` int(11) DEFAULT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`EmailSetupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailsetup`
--

LOCK TABLES `emailsetup` WRITE;
/*!40000 ALTER TABLE `emailsetup` DISABLE KEYS */;
/*!40000 ALTER TABLE `emailsetup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fdaccount`
--

DROP TABLE IF EXISTS `fdaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fdaccount` (
  `FDId` bigint(20) NOT NULL AUTO_INCREMENT,
  `FdNo` bigint(20) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `FDAmount` double NOT NULL,
  `Interest` double NOT NULL,
  `Duration` int(11) NOT NULL,
  `FDDate` datetime NOT NULL,
  `MaturityAmount` double NOT NULL,
  `MaturityDate` date NOT NULL,
  `WithdrawDate` datetime DEFAULT NULL,
  `BranchId` bigint(20) DEFAULT NULL,
  `fdsetupid` bigint(20) DEFAULT NULL,
  `ViaMobile` smallint(6) DEFAULT NULL,
  `ViaInternet` smallint(6) DEFAULT NULL,
  `ConfirmOTP` varchar(50) DEFAULT NULL,
  `Createdby` bigint(20) NOT NULL,
  `ModifiedBy` bigint(20) NOT NULL,
  `ModifiedDate` date NOT NULL,
  PRIMARY KEY (`FDId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fdaccount`
--

LOCK TABLES `fdaccount` WRITE;
/*!40000 ALTER TABLE `fdaccount` DISABLE KEYS */;
INSERT INTO `fdaccount` VALUES (17,3000001,62,0,23,240,'2017-04-28 00:00:00',5729.09,'2017-12-24','2017-04-28 06:06:31',11,4,NULL,NULL,NULL,31,31,'2017-04-28');
/*!40000 ALTER TABLE `fdaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fdsetup`
--

DROP TABLE IF EXISTS `fdsetup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fdsetup` (
  `fdsetupid` bigint(20) NOT NULL AUTO_INCREMENT,
  `Description` varchar(501) DEFAULT NULL,
  `fdinterest` double NOT NULL,
  `durationindays` int(11) NOT NULL,
  `Active` tinyint(4) NOT NULL,
  `SeniorCitzen` smallint(6) DEFAULT NULL,
  `SpecialRoi` smallint(6) DEFAULT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`fdsetupid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fdsetup`
--

LOCK TABLES `fdsetup` WRITE;
/*!40000 ALTER TABLE `fdsetup` DISABLE KEYS */;
INSERT INTO `fdsetup` VALUES (4,'Fixed deposit',8,365,1,NULL,NULL,31,'2017-04-23 00:00:00',30,'2017-06-04 07:35:01'),(5,'Super Fixed deposit',12,365,1,NULL,NULL,30,'2017-06-04 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `fdsetup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fdtransaction`
--

DROP TABLE IF EXISTS `fdtransaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fdtransaction` (
  `FDTransactionId` bigint(20) NOT NULL AUTO_INCREMENT,
  `FDId` bigint(20) NOT NULL,
  `FdNo` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `TransactionDate` date NOT NULL,
  `Transactionmode` varchar(50) NOT NULL,
  `TransactionType` varchar(32) NOT NULL,
  `ChequeNo` bigint(20) DEFAULT NULL,
  `BankName` varchar(50) DEFAULT NULL,
  `ChequeDate` date DEFAULT NULL,
  `SenderReceiverAccountNo` bigint(20) DEFAULT NULL,
  `Deposit` double DEFAULT NULL,
  `Withdraw` double DEFAULT NULL,
  `Balance` double NOT NULL,
  `Remark` varchar(59) DEFAULT NULL,
  `BranchId` bigint(20) NOT NULL,
  `ViaMobile` smallint(6) DEFAULT NULL,
  `ViaInternet` smallint(6) DEFAULT NULL,
  `ConfirmOTP` varchar(50) DEFAULT NULL,
  `CreatedBy` bigint(20) DEFAULT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`FDTransactionId`),
  KEY `FDId` (`FDId`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fdtransaction`
--

LOCK TABLES `fdtransaction` WRITE;
/*!40000 ALTER TABLE `fdtransaction` DISABLE KEYS */;
INSERT INTO `fdtransaction` VALUES (61,17,3000001,62,'2017-04-28','cash','Deposit',0,'','1970-01-01',NULL,5000,NULL,5000,NULL,11,NULL,NULL,NULL,31,NULL,NULL),(62,17,3000001,62,'2017-04-28','Cash','Withdraw',NULL,NULL,NULL,NULL,NULL,5000,5000,'withdrawn',11,NULL,NULL,NULL,NULL,31,'2017-04-28 06:06:31');
/*!40000 ALTER TABLE `fdtransaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goldloanapplication`
--

DROP TABLE IF EXISTS `goldloanapplication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goldloanapplication` (
  `ApplyGoldLoanID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CustomerID` bigint(20) NOT NULL,
  `ApplyLoanDate` date NOT NULL,
  `AppliedAmount` double NOT NULL,
  `LoanPurpose` varchar(50) DEFAULT NULL,
  `ForDurationinMonth` int(11) NOT NULL,
  `GoldValue` double NOT NULL,
  `WeightofOrnament` double NOT NULL,
  `GoldKarat` double NOT NULL,
  `GoldPurityCheck` varchar(50) NOT NULL,
  `Createdby` bigint(20) NOT NULL,
  `Remark` varchar(105) DEFAULT NULL,
  `BranchId` bigint(20) NOT NULL,
  `Approval` varchar(50) DEFAULT NULL,
  `ApproverRemark` varchar(50) DEFAULT NULL,
  `ApprovalDate` datetime DEFAULT NULL,
  `approve_by` int(11) NOT NULL,
  `OTP` varchar(50) DEFAULT NULL,
  `GoldLoanStatus` varchar(50) NOT NULL,
  `LoanTypeid` bigint(20) DEFAULT NULL,
  `ApproveAmount` double DEFAULT NULL,
  `Photo` longblob,
  `CustomerIncome` double DEFAULT NULL,
  `BillVerification` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ApplyGoldLoanID`),
  KEY `LoanTypeid` (`LoanTypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goldloanapplication`
--

LOCK TABLES `goldloanapplication` WRITE;
/*!40000 ALTER TABLE `goldloanapplication` DISABLE KEYS */;
INSERT INTO `goldloanapplication` VALUES (11,62,'2017-04-28',3000,'Pesonal loan',23,6000,20,22,'NotVerified',33,'give it to me',11,'approve','Approved','2017-04-28 00:00:00',31,'102401','approve',4,3000,'78234-',30000,'Verified');
/*!40000 ALTER TABLE `goldloanapplication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goldloantype`
--

DROP TABLE IF EXISTS `goldloantype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goldloantype` (
  `GoldLoanTypeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `GName` varchar(50) NOT NULL,
  `Description` varchar(50) DEFAULT NULL,
  `InterestRate` double DEFAULT NULL,
  `Durationinmonth` int(11) DEFAULT NULL,
  `Amount` double DEFAULT NULL,
  `NoofInstallments` int(11) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`GoldLoanTypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goldloantype`
--

LOCK TABLES `goldloantype` WRITE;
/*!40000 ALTER TABLE `goldloantype` DISABLE KEYS */;
INSERT INTO `goldloantype` VALUES (4,'Gold_year','',10,0,NULL,NULL,1,31,'2017-04-23 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `goldloantype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intializeaccountno`
--

DROP TABLE IF EXISTS `intializeaccountno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intializeaccountno` (
  `InitID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountNo` bigint(20) NOT NULL,
  `FDAccountNo` bigint(20) NOT NULL,
  `ShareAccountNo` bigint(20) DEFAULT NULL,
  `LoanAccountno` bigint(20) NOT NULL,
  `BranchId` bigint(20) DEFAULT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`InitID`),
  KEY `FK_BranchId` (`BranchId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intializeaccountno`
--

LOCK TABLES `intializeaccountno` WRITE;
/*!40000 ALTER TABLE `intializeaccountno` DISABLE KEYS */;
INSERT INTO `intializeaccountno` VALUES (1,1000001,3000001,2000001,4000001,NULL,1,'2017-02-13 00:00:00',15,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `intializeaccountno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan` (
  `LoanId` bigint(20) NOT NULL AUTO_INCREMENT,
  `LoanNumber` bigint(20) DEFAULT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `LoanDate` date NOT NULL,
  `Amount` double DEFAULT NULL,
  `Interestrate` double DEFAULT NULL,
  `Durationinmonth` int(11) DEFAULT NULL,
  `installmentamount` double DEFAULT NULL,
  `NoofInstallments` int(11) DEFAULT NULL,
  `Gaurantor1Id` bigint(20) DEFAULT NULL,
  `Gaurantor2Id` bigint(20) DEFAULT NULL,
  `Createdby` bigint(20) NOT NULL,
  `LoanTypeid` bigint(20) NOT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Balance` double NOT NULL,
  `FirstInstallmentDate` datetime DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `BranchId` bigint(20) DEFAULT NULL,
  `CollectorId` bigint(20) DEFAULT NULL,
  `DisburseDate` datetime DEFAULT NULL,
  `CustomerOTP` varchar(50) DEFAULT NULL,
  `ApplyLoanID` bigint(20) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `ODInterestAmount` double DEFAULT NULL,
  `FdNo` bigint(20) DEFAULT NULL,
  `FDId` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`LoanId`),
  UNIQUE KEY `LoanNumber` (`LoanNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
INSERT INTO `loan` VALUES (19,4000002,62,'2017-04-23',200000,15,12,0,12,63,64,32,2,'SWADSFG',0,'2017-04-18 00:00:00','active',11,NULL,'2017-04-23 00:00:00','107153',6,'reguler',NULL,NULL,NULL),(20,4000003,62,'2017-04-24',1000,15,12,90.26,12,63,64,37,2,'sadfgbv',830.7,'2017-04-12 00:00:00','active',11,NULL,'2017-04-24 00:00:00','105662',8,'reguler',0,NULL,NULL),(21,4000004,0,'2017-04-24',200000,15,12,18051.66,12,63,64,37,3,'saxcz sxcz x',200000,'2017-05-10 00:00:00','active',11,NULL,'2017-04-24 00:00:00','108979',7,'reguler',NULL,NULL,NULL),(22,4000005,0,'2017-04-24',200000,15,12,18051.66,12,63,64,37,3,'saxcz sxcz x',200000,'2017-05-10 00:00:00','active',11,NULL,'2017-04-24 00:00:00','108979',7,'reguler',NULL,NULL,NULL),(23,4000006,62,'2017-04-24',200000,15,12,18051.66,12,63,64,37,3,'saxcz sxcz x',200000,'2017-05-10 00:00:00','active',11,NULL,'2017-04-24 00:00:00','108979',7,'reguler',NULL,NULL,NULL),(24,4000007,62,'2017-04-25',1000,15,12,90.26,12,63,65,31,2,'Alloted',1000,'2017-05-10 00:00:00','active',11,NULL,'2017-04-25 00:00:00','100344',9,'reguler',NULL,NULL,NULL),(25,4000008,62,'2017-05-25',5000,15,12,451.29,12,63,64,32,2,'Approved',5000,'2017-05-25 00:00:00','active',11,NULL,'2017-05-25 00:00:00','104701',11,'reguler',NULL,NULL,NULL);
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loanapplication`
--

DROP TABLE IF EXISTS `loanapplication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loanapplication` (
  `ApplyLoanID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CustomerID` bigint(20) NOT NULL,
  `ApplyLoanDate` date NOT NULL,
  `AppliedAmount` double NOT NULL,
  `LoanPurpose` varchar(50) DEFAULT NULL,
  `ForDurationinMonth` int(11) NOT NULL,
  `Gaurantor1Id` bigint(20) DEFAULT NULL,
  `Gaurantor2Id` bigint(20) DEFAULT NULL,
  `Createdby` bigint(20) NOT NULL,
  `Remark` varchar(105) DEFAULT NULL,
  `ViaMobile` smallint(6) DEFAULT NULL,
  `ViaInternet` smallint(6) DEFAULT NULL,
  `BranchId` bigint(20) NOT NULL,
  `Approval` varchar(50) DEFAULT NULL,
  `ApproverRemark` varchar(50) DEFAULT NULL,
  `ApprovalDate` datetime DEFAULT NULL,
  `approve_by` int(11) NOT NULL,
  `OTP` varchar(50) DEFAULT NULL,
  `LoanStatus` varchar(50) NOT NULL,
  `LoanTypeid` bigint(20) DEFAULT NULL,
  `ApproveAmount` double DEFAULT NULL,
  PRIMARY KEY (`ApplyLoanID`),
  KEY `LoanTypeid` (`LoanTypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loanapplication`
--

LOCK TABLES `loanapplication` WRITE;
/*!40000 ALTER TABLE `loanapplication` DISABLE KEYS */;
INSERT INTO `loanapplication` VALUES (6,62,'2017-04-23',3000,'tESTINGGGGGGG',2,63,64,33,'swdaefsbgvdfvdwcx ',NULL,NULL,11,'approve','wdesfdg','2017-04-23 00:00:00',33,'107153','alloted',2,0),(7,62,'2017-04-24',200000,'asfvcvd',18,63,64,32,'FOr personal usage',NULL,NULL,11,'approve','sfdbdfvdvf ','2017-04-24 00:00:00',32,'108979','alloted',3,200000),(8,62,'2017-04-24',2000,'test',2,63,64,37,'test',NULL,NULL,11,'approve','ssds','2017-04-24 00:00:00',37,'105662','alloted',2,1000),(9,62,'2017-04-25',2000,'Personla loan',2,63,65,33,'wadsfv',NULL,NULL,11,'approve','Approved','2017-04-25 00:00:00',31,'100344','alloted',2,1000),(10,62,'2017-04-28',200000,'Personal loan regular',50,63,64,33,'regual',NULL,NULL,11,'pending',NULL,NULL,0,NULL,'pending',NULL,NULL),(11,62,'2017-05-25',5000,'Personal',6,63,64,32,'Personal',NULL,NULL,11,'approve','Approved','2017-05-25 00:00:00',32,'104701','alloted',2,5000);
/*!40000 ALTER TABLE `loanapplication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loansetting`
--

DROP TABLE IF EXISTS `loansetting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loansetting` (
  `LoanSettingId` int(11) NOT NULL AUTO_INCREMENT,
  `LoanGraceDays` int(11) NOT NULL,
  PRIMARY KEY (`LoanSettingId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loansetting`
--

LOCK TABLES `loansetting` WRITE;
/*!40000 ALTER TABLE `loansetting` DISABLE KEYS */;
/*!40000 ALTER TABLE `loansetting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loantransaction`
--

DROP TABLE IF EXISTS `loantransaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loantransaction` (
  `LoanTransactionId` bigint(20) NOT NULL AUTO_INCREMENT,
  `LoanId` bigint(20) NOT NULL,
  `LoanNumber` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `Amount` double NOT NULL,
  `DepositDate` date NOT NULL,
  `Balance` double NOT NULL,
  `TransactionType` varchar(50) NOT NULL,
  `Transactionmode` varchar(255) NOT NULL,
  `ChequeNo` bigint(20) DEFAULT NULL,
  `BankName` varchar(50) DEFAULT NULL,
  `ChequeDate` date DEFAULT NULL,
  `SenderReceiverAccountNo` bigint(20) DEFAULT NULL,
  `Remark` varchar(59) DEFAULT NULL,
  `principal` double DEFAULT NULL,
  `interestamount` double DEFAULT NULL,
  `ODInterestAmount` double DEFAULT NULL,
  `PenaltyAmount` double DEFAULT NULL,
  `BranchId` bigint(20) DEFAULT NULL,
  `ViaMobile` smallint(6) DEFAULT NULL,
  `ViaInternet` smallint(6) DEFAULT NULL,
  `ConfirmOTP` varchar(50) DEFAULT NULL,
  `CreatedBy` bigint(20) DEFAULT NULL,
  `ApproveBy` bigint(20) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `installment_date` date NOT NULL,
  PRIMARY KEY (`LoanTransactionId`),
  KEY `LoanId` (`LoanId`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loantransaction`
--

LOCK TABLES `loantransaction` WRITE;
/*!40000 ALTER TABLE `loantransaction` DISABLE KEYS */;
INSERT INTO `loantransaction` VALUES (124,0,4000002,0,0,'1970-01-01',0,'Deposit','0',0,'','1970-01-01',NULL,'',0,0,0,NULL,11,NULL,NULL,NULL,36,NULL,NULL,NULL,NULL,'1970-01-01'),(125,20,4000003,62,90.26,'2017-04-24',909.74,'Deposit','cash',0,'','1970-01-01',NULL,'',90.26,0,0,NULL,11,NULL,NULL,NULL,37,NULL,NULL,NULL,NULL,'2017-04-12'),(126,0,4000002,0,0,'1970-01-01',0,'Deposit','0',0,'','1970-01-01',NULL,'',0,0,0,NULL,11,NULL,NULL,NULL,37,NULL,NULL,NULL,NULL,'1970-01-01'),(128,20,4000003,62,90.26,'2017-04-25',830.7,'Deposit','cash',0,'','1970-01-01',NULL,'Payed',79.04,11.22,0,NULL,11,NULL,NULL,NULL,32,NULL,NULL,NULL,NULL,'2017-05-12');
/*!40000 ALTER TABLE `loantransaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loantype`
--

DROP TABLE IF EXISTS `loantype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loantype` (
  `LoanTypeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `Type` varchar(50) NOT NULL,
  `Description` varchar(50) DEFAULT NULL,
  `InterestRate` double DEFAULT NULL,
  `Durationinmonth` int(11) DEFAULT NULL,
  `Amount` double DEFAULT NULL,
  `NoofInstallments` int(11) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`LoanTypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loantype`
--

LOCK TABLES `loantype` WRITE;
/*!40000 ALTER TABLE `loantype` DISABLE KEYS */;
INSERT INTO `loantype` VALUES (2,'Personal Loan(Monthly)','Profession, Self Employeed',20,12,NULL,NULL,1,15,'2017-03-27 00:00:00',30,'2017-06-04 07:43:52'),(3,'Bussiness Loan','for Small Startup Bussiness',24,1,NULL,NULL,1,15,'2017-03-27 00:00:00',30,'2017-06-04 07:44:24'),(4,'Daily Deposit loan','Daily Deposit Installment',24,4,NULL,NULL,1,30,'2017-06-04 00:00:00',NULL,NULL),(5,'Weakly loan','weakly deposit installment',24,4,NULL,NULL,1,30,'2017-06-04 00:00:00',NULL,NULL),(6,'Two wheeler loan','two wheeler loan',24,12,NULL,NULL,1,30,'2017-06-04 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `loantype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membershipfees`
--

DROP TABLE IF EXISTS `membershipfees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membershipfees` (
  `MemberShipFeesId` int(11) NOT NULL AUTO_INCREMENT,
  `MemberShipFees` double NOT NULL,
  `MemberShipFeeDate` date NOT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`MemberShipFeesId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membershipfees`
--

LOCK TABLES `membershipfees` WRITE;
/*!40000 ALTER TABLE `membershipfees` DISABLE KEYS */;
INSERT INTO `membershipfees` VALUES (6,250,'2017-03-27',15,'2017-03-27',NULL,NULL),(7,300,'2017-03-27',15,'2017-03-27',NULL,NULL),(8,500,'2017-04-25',30,'2017-04-25',NULL,NULL),(9,50,'2017-01-13',30,'2017-06-04',NULL,NULL);
/*!40000 ALTER TABLE `membershipfees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `RegionId` bigint(20) NOT NULL AUTO_INCREMENT,
  `Regionname` varchar(50) NOT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`RegionId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (6,'Vidharbha',15,'2017-03-27 00:00:00',NULL,NULL,1),(7,'West Nimar',30,'2017-06-04 00:00:00',NULL,NULL,1);
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registation`
--

DROP TABLE IF EXISTS `registation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registation` (
  `registationId` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `fulladdress` text NOT NULL,
  `purchase_code` varchar(255) NOT NULL,
  `veryfication_code` varchar(255) NOT NULL,
  `domainName` varchar(255) NOT NULL,
  `emailId` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`registationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registation`
--

LOCK TABLES `registation` WRITE;
/*!40000 ALTER TABLE `registation` DISABLE KEYS */;
/*!40000 ALTER TABLE `registation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `RoleId` bigint(20) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(50) NOT NULL,
  PRIMARY KEY (`RoleId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'SuperAdmin'),(2,'Manager'),(3,'Accountant'),(4,'Cashier'),(5,'Clerk');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shareaccount`
--

DROP TABLE IF EXISTS `shareaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shareaccount` (
  `ShareAccountID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShareAccountNo` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `Balance` double NOT NULL,
  `Opendate` date NOT NULL,
  `BranchId` bigint(20) DEFAULT NULL,
  `CreatedBy` bigint(20) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `SActive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`ShareAccountID`),
  UNIQUE KEY `ShareAccountNo` (`ShareAccountNo`),
  UNIQUE KEY `ShareAccountNo_2` (`ShareAccountNo`),
  UNIQUE KEY `CustomerID` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shareaccount`
--

LOCK TABLES `shareaccount` WRITE;
/*!40000 ALTER TABLE `shareaccount` DISABLE KEYS */;
INSERT INTO `shareaccount` VALUES (13,2000001,65,1,'2017-04-28',11,31,'2017-04-28 00:00:00',NULL,NULL,1);
/*!40000 ALTER TABLE `shareaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sharedetails`
--

DROP TABLE IF EXISTS `sharedetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sharedetails` (
  `ShareId` int(11) NOT NULL AUTO_INCREMENT,
  `OneSharePrice` double NOT NULL,
  `ShareDate` date NOT NULL,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ShareId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sharedetails`
--

LOCK TABLES `sharedetails` WRITE;
/*!40000 ALTER TABLE `sharedetails` DISABLE KEYS */;
INSERT INTO `sharedetails` VALUES (2,500,'2017-04-28',30,'2017-04-28',NULL,NULL),(3,250,'2017-05-25',30,'2017-05-25',NULL,NULL),(4,500,'2017-05-25',30,'2017-05-25',NULL,NULL);
/*!40000 ALTER TABLE `sharedetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sharetransaction`
--

DROP TABLE IF EXISTS `sharetransaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sharetransaction` (
  `ShareTransactionId` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShareAccountID` bigint(20) NOT NULL DEFAULT '0',
  `ShareAccountNo` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `TransactionDate` date NOT NULL,
  `BalanceShare` double NOT NULL,
  `TransactionType` varchar(32) NOT NULL,
  `Deposit` double DEFAULT NULL,
  `Withdraw` double DEFAULT NULL,
  `SenderReceiverAccountNo` bigint(20) DEFAULT NULL,
  `ChequeNo` bigint(20) DEFAULT NULL,
  `BankName` varchar(50) DEFAULT NULL,
  `ChequeDate` date DEFAULT NULL,
  `ShareAmount` double DEFAULT NULL,
  `Remark` varchar(59) DEFAULT NULL,
  `BranchId` bigint(20) NOT NULL,
  `ViaMobile` tinyint(4) DEFAULT NULL,
  `ViaInternet` tinyint(4) DEFAULT NULL,
  `ConfirmOTP` varchar(50) DEFAULT NULL,
  `CreatedBy` bigint(20) DEFAULT NULL,
  `ModifiedBy` bigint(20) NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `Transactionmode` varchar(255) NOT NULL,
  PRIMARY KEY (`ShareTransactionId`),
  KEY `ShareAccountID` (`ShareAccountID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sharetransaction`
--

LOCK TABLES `sharetransaction` WRITE;
/*!40000 ALTER TABLE `sharetransaction` DISABLE KEYS */;
INSERT INTO `sharetransaction` VALUES (14,13,2000001,65,'2017-04-28',1,'Deposit',1,NULL,NULL,0,'','1970-01-01',500,'Share alloted',11,NULL,NULL,NULL,31,0,'0000-00-00 00:00:00','cash');
/*!40000 ALTER TABLE `sharetransaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms` (
  `smsid` int(11) NOT NULL AUTO_INCREMENT,
  `gatewayurl` longtext,
  `username` longtext,
  `apikey` longtext,
  `senderid` longtext,
  `CreatedBy` bigint(20) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`smsid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms`
--

LOCK TABLES `sms` WRITE;
/*!40000 ALTER TABLE `sms` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `StateId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `StateName` varchar(50) NOT NULL DEFAULT '',
  `CreatedBy` bigint(20) unsigned NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedBy` bigint(20) unsigned DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `Active` tinyint(4) NOT NULL,
  PRIMARY KEY (`StateId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (5,'Madhya Pradesh',15,'2017-03-27 00:00:00',30,'2017-04-25 00:00:00',1);
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
  `UserId` bigint(20) NOT NULL AUTO_INCREMENT,
  `EmployeeName` varchar(50) NOT NULL DEFAULT '',
  `Designation` varchar(50) NOT NULL DEFAULT '',
  `Username` varchar(700) NOT NULL DEFAULT '',
  `Apassword` longtext NOT NULL,
  `RoleId` bigint(20) DEFAULT NULL,
  `CityId` bigint(20) DEFAULT NULL,
  `StateId` bigint(20) DEFAULT NULL,
  `CountryId` bigint(20) DEFAULT NULL,
  `BranchId` bigint(20) DEFAULT NULL,
  `UnderofId` bigint(20) DEFAULT NULL,
  `EmpCode` varchar(50) DEFAULT NULL,
  `Userimage` longblob,
  `EmpId` bigint(20) DEFAULT NULL,
  `CreatedBy` bigint(20) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` bigint(20) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UQ__UserInfo__536C85E41AAA0C50` (`Username`),
  UNIQUE KEY `EmpCode` (`EmpCode`),
  KEY `RoleId` (`RoleId`),
  KEY `BranchId` (`BranchId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` VALUES (30,'SuperAdmin','SuperAdmin','SuperAdmin','0b28a5799a32c687dad2c5183718ceac',1,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,1,''),(31,'Yashpal singh Dasondhi','Manager','Manager','ae94be3cd532ce4a025884819eb08c98',2,10,5,8,11,NULL,'001','4338-avatar2.png',NULL,30,'2017-04-07 20:11:37','2017-06-04 07:55:18',30,1,''),(32,'Accontant','Accountant','Accountant','7516132c51e75ce65534cbdcc96c2c45',3,9,5,8,11,NULL,'002','62478-avatar2.png',NULL,30,'2017-04-07 20:12:25','2017-04-07 20:15:14',30,1,''),(33,'Shyampal singh Dasondhi','Clerk','Clerk','715102f7c5e27c5e4a213cc505bd2161',5,9,5,8,11,NULL,'003','82100-avatar.png',NULL,30,'2017-04-07 20:13:07','2017-06-04 07:57:06',30,1,''),(36,'Cashier','Cashier','Cashier','e7f85ad205399503a678592df8aadeb1',4,9,5,8,11,NULL,'005','60141-',NULL,30,'2017-04-24 04:24:21','2017-04-24 05:40:21',30,0,''),(37,'Cash','Cash','Cash','e7f85ad205399503a678592df8aadeb1',4,9,5,8,11,NULL,'004','44904-4338-avatar2.png',NULL,30,'2017-04-24 04:49:05','2017-04-24 05:41:32',30,1,'');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-02  6:53:12
