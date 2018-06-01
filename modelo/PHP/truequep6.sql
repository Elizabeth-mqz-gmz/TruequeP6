-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: truequep6
-- ------------------------------------------------------
-- Server version	10.1.31-MariaDB

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
-- Current Database: `truequep6`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `truequep6` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `truequep6`;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  `id_em` int(9) NOT NULL,
  `id_rec` int(9) NOT NULL,
  PRIMARY KEY (`id_chat`),
  KEY `id_em` (`id_em`),
  KEY `id_rec` (`id_rec`),
  CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_em`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`id_rec`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario` (
  `id_comen` int(11) NOT NULL AUTO_INCREMENT,
  `id_usu_comen` int(9) DEFAULT NULL,
  `id_publi_comen` int(11) DEFAULT NULL,
  `denuncia_p` enum('0','1') DEFAULT '0',
  `comentario` text NOT NULL,
  PRIMARY KEY (`id_comen`),
  KEY `id_usu_comen` (`id_usu_comen`),
  KEY `id_publi_comen` (`id_publi_comen`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usu_comen`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_publi_comen`) REFERENCES `publicacion` (`id_publicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id_even` int(11) NOT NULL AUTO_INCREMENT,
  `id_chat` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo_even` enum('trueque','perdida') DEFAULT NULL,
  UNIQUE KEY `id_even` (`id_even`),
  KEY `id_chat` (`id_chat`),
  CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `id_men` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` text NOT NULL,
  `id_chat` int(11) NOT NULL,
  `emisor` enum('0','1') NOT NULL,
  UNIQUE KEY `id_men` (`id_men`),
  KEY `id_chat` (`id_chat`),
  CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacion` (
  `id_not` int(11) NOT NULL AUTO_INCREMENT,
  `id_usu_not` int(9) NOT NULL,
  `men_not` varchar(100) NOT NULL,
  PRIMARY KEY (`id_not`),
  KEY `id_usu_not` (`id_usu_not`),
  CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`id_usu_not`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perdida`
--

DROP TABLE IF EXISTS `perdida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perdida` (
  `id_perdida` int(11) NOT NULL AUTO_INCREMENT,
  `id_publi_per` int(11) DEFAULT NULL,
  `id_dueño` int(9) DEFAULT NULL,
  `tipo_perdida` enum('ropa','cuaderno','credencial') DEFAULT NULL,
  PRIMARY KEY (`id_perdida`),
  KEY `id_dueño` (`id_dueño`),
  KEY `id_publi_per` (`id_publi_per`),
  CONSTRAINT `perdida_ibfk_1` FOREIGN KEY (`id_dueño`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `perdida_ibfk_2` FOREIGN KEY (`id_publi_per`) REFERENCES `publicacion` (`id_publicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perdida`
--

LOCK TABLES `perdida` WRITE;
/*!40000 ALTER TABLE `perdida` DISABLE KEYS */;
/*!40000 ALTER TABLE `perdida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacion` (
  `id_publicacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(9) NOT NULL,
  `denuncia_p` enum('0','1') DEFAULT '0',
  `estado` enum('inconcluso','terminado') DEFAULT 'inconcluso',
  `imagen_publi` varchar(60) DEFAULT NULL,
  `publicacion` text NOT NULL,
  PRIMARY KEY (`id_publicacion`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacion`
--

LOCK TABLES `publicacion` WRITE;
/*!40000 ALTER TABLE `publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reaccion`
--

DROP TABLE IF EXISTS `reaccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reaccion` (
  `id_reaccion` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_publi_reac` int(11) DEFAULT NULL,
  `id_usu_reac` int(9) DEFAULT NULL,
  `tipo_reac` enum('Mmm','Jajajaja','Me vale') DEFAULT NULL,
  PRIMARY KEY (`id_reaccion`),
  KEY `id_publi_reac` (`id_publi_reac`),
  KEY `id_usu_reac` (`id_usu_reac`),
  CONSTRAINT `reaccion_ibfk_1` FOREIGN KEY (`id_publi_reac`) REFERENCES `publicacion` (`id_publicacion`),
  CONSTRAINT `reaccion_ibfk_2` FOREIGN KEY (`id_usu_reac`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reaccion`
--

LOCK TABLES `reaccion` WRITE;
/*!40000 ALTER TABLE `reaccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `reaccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trueque`
--

DROP TABLE IF EXISTS `trueque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trueque` (
  `id_trueque` int(11) NOT NULL AUTO_INCREMENT,
  `id_publi_true` int(11) DEFAULT NULL,
  `id_aceptador` int(9) DEFAULT NULL,
  PRIMARY KEY (`id_trueque`),
  KEY `id_aceptador` (`id_aceptador`),
  KEY `id_publi_true` (`id_publi_true`),
  CONSTRAINT `trueque_ibfk_1` FOREIGN KEY (`id_aceptador`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `trueque_ibfk_2` FOREIGN KEY (`id_publi_true`) REFERENCES `publicacion` (`id_publicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trueque`
--

LOCK TABLES `trueque` WRITE;
/*!40000 ALTER TABLE `trueque` DISABLE KEYS */;
/*!40000 ALTER TABLE `trueque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(9) NOT NULL,
  `nomus` varchar(30) NOT NULL,
  `nombre` char(30) NOT NULL,
  `ape_pat` char(30) DEFAULT NULL,
  `ape_mat` char(30) DEFAULT NULL,
  `contra` varchar(64) NOT NULL,
  `imagen` varchar(60) DEFAULT '../imagenes_pub/default.jpg',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (317346741,'','',NULL,NULL,'','../imagenes_pub/default.jpg'),(317346742,'','',NULL,NULL,'','../imagenes_pub/default.jpg'),(317346743,'','',NULL,NULL,'','../imagenes_pub/default.jpg'),(317346744,'','',NULL,NULL,'','../imagenes_pub/default.jpg'),(317346746,'','',NULL,NULL,'','../imagenes_pub/default.jpg');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-31 14:00:34
