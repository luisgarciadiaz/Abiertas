-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: tracking
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.11-MariaDB

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
-- Table structure for table `bdv`
--

DROP TABLE IF EXISTS `bdv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time NOT NULL,
  `audio` varchar(2) DEFAULT NULL,
  `st` varchar(60) DEFAULT NULL,
  `fechaHoraIni` datetime NOT NULL,
  `fechaHoraFin` datetime NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `agente` int(11) NOT NULL,
  `fechabo` date DEFAULT NULL,
  `agentebo` int(11) DEFAULT NULL,
  `comentariosbo` text DEFAULT NULL,
  `IP` varchar(20) DEFAULT NULL,
  `actual` varchar(20) DEFAULT NULL,
  `completado` varchar(20) DEFAULT NULL,
  `2_1_R` text DEFAULT NULL,
  `2_2_R` text DEFAULT NULL,
  `2_3_R` text DEFAULT NULL,
  `3_4_R` text DEFAULT NULL,
  `4_5_R` text DEFAULT NULL,
  `4_6_R` text DEFAULT NULL,
  `4_7_R` text DEFAULT NULL,
  `4_8_R` text DEFAULT NULL,
  `5_9_R` text DEFAULT NULL,
  `5_10_R` text DEFAULT NULL,
  `5_11_R` text DEFAULT NULL,
  `5_12_R` text DEFAULT NULL,
  `5_13_R` text DEFAULT NULL,
  `5_14_R` text DEFAULT NULL,
  `5_51_R` text DEFAULT NULL,
  `6_15_R` text DEFAULT NULL,
  `6_16_R` text DEFAULT NULL,
  `6_17_R` text DEFAULT NULL,
  `6_18_R` text DEFAULT NULL,
  `6_19_R` text DEFAULT NULL,
  `6_20_R` text DEFAULT NULL,
  `6_52_R` text DEFAULT NULL,
  `7_21_R` text DEFAULT NULL,
  `8_22_R` text DEFAULT NULL,
  `8_23_R` text DEFAULT NULL,
  `8_24_R` text DEFAULT NULL,
  `8_25_R` text DEFAULT NULL,
  `9_26_R` text DEFAULT NULL,
  `9_27_R` text DEFAULT NULL,
  `9_28_R` text DEFAULT NULL,
  `9_29_R` text DEFAULT NULL,
  `9_30_R` text DEFAULT NULL,
  `9_31_R` text DEFAULT NULL,
  `9_32_R` text DEFAULT NULL,
  `9_33_R` text DEFAULT NULL,
  `9_34_R` text DEFAULT NULL,
  `9_35_R` text DEFAULT NULL,
  `9_36_R` text DEFAULT NULL,
  `9_37_R` text DEFAULT NULL,
  `9_38_R` text DEFAULT NULL,
  `9_39_R` text DEFAULT NULL,
  `10_40_R` text DEFAULT NULL,
  `10_41_R` text DEFAULT NULL,
  `11_42_R` text DEFAULT NULL,
  `11_43_R` text DEFAULT NULL,
  `12_44_R` text DEFAULT NULL,
  `12_45_R` text DEFAULT NULL,
  `12_46_R` text DEFAULT NULL,
  `12_47_R` text DEFAULT NULL,
  `12_48_R` text DEFAULT NULL,
  `12_49_R` text DEFAULT NULL,
  `12_50_R` text DEFAULT NULL,
  `1__R` text DEFAULT NULL,
  `13_54_R` text DEFAULT NULL,
  `13_54_1_R` text DEFAULT NULL,
  `13_54_2_R` text DEFAULT NULL,
  `13_55_R` text DEFAULT NULL,
  `13_55_1_R` text DEFAULT NULL,
  `13_55_2_R` text DEFAULT NULL,
  `13_56_R` text DEFAULT NULL,
  `13_56_1_R` text DEFAULT NULL,
  `13_56_2_R` text DEFAULT NULL,
  `12_53_R` text DEFAULT NULL,
  `12_53_1_R` text DEFAULT NULL,
  `12_53_2_R` text DEFAULT NULL,
  `12_53_3_R` text DEFAULT NULL,
  `12_53_4_R` text DEFAULT NULL,
  `12_53_5_R` text DEFAULT NULL,
  `12_53_6_R` text DEFAULT NULL,
  `13_57_R` text DEFAULT NULL,
  `13_57_1_R` text DEFAULT NULL,
  `13_57_2_R` text DEFAULT NULL,
  `13_58_R` text DEFAULT NULL,
  `13_58_1_R` text DEFAULT NULL,
  `13_58_2_R` text DEFAULT NULL,
  `13_59_R` text DEFAULT NULL,
  `13_59_1_R` text DEFAULT NULL,
  `13_59_2_R` text DEFAULT NULL,
  `13_60_R` text DEFAULT NULL,
  `12_53_7_R` text DEFAULT NULL,
  `12_53_8_R` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3315 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `abiertos`
--

DROP TABLE IF EXISTS `abiertos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abiertos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `toriginal` varchar(100) DEFAULT NULL,
  `tnuevo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-24 13:16:47
