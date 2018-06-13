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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (9,317346744,317346743);
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
  `id_usu_comen` int(9) NOT NULL,
  `id_publi_comen` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `denuncia_c` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_comen`),
  KEY `id_publi_comen` (`id_publi_comen`),
  KEY `id_usu_comen` (`id_usu_comen`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_publi_comen`) REFERENCES `publicacion` (`id_publicacion`),
  CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_usu_comen`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` VALUES (17,317346745,8,'Al menos no son unos pantalones jajaj','1');
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
  `lugar` varchar(100) DEFAULT NULL,
  `tipo_even` enum('trueque','perdida') NOT NULL,
  UNIQUE KEY `id_even` (`id_even`),
  KEY `id_chat` (`id_chat`),
  CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (4,9,'2018-06-15 11:00:00','El pulpo','trueque');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `id_men` bigint(20) NOT NULL AUTO_INCREMENT,
  `mensaje` text NOT NULL,
  `id_chat` int(11) NOT NULL,
  `emisor` enum('0','1') NOT NULL,
  `hora_men` time NOT NULL,
  PRIMARY KEY (`id_men`),
  UNIQUE KEY `id_men` (`id_men`),
  KEY `id_chat` (`id_chat`),
  CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` VALUES (50,'X(~v55j#0-w${%1x|8~~v(!3t}2ky|r',9,'1','02:23:00'),(51,'X(~v@5\\\"x#~wx)%=3xy,5&+v3\\\'}%$$)1$q+s5|vtx#8w\\\"4*$)u*(z',9,'0','02:39:00');
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
  `visto` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id_not`),
  KEY `id_usu_not` (`id_usu_not`),
  CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`id_usu_not`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
INSERT INTO `notificacion` VALUES (89,317346742,'¡Felicidades, te has registrado en Trueque-P6! :)','0'),(91,317346743,'¡Felicidades, te has registrado en Trueque-P6! :)','1'),(92,317346744,'¡Felicidades, te has registrado en Trueque-P6! :)','0'),(94,317346743,'Al usuario 317346744 le interesa una publicación tuya','0'),(95,317346743,'317346744 ha reaccionado \"Mmm\" a una publicación tuya 7','1'),(96,317346745,'¡Felicidades, te has registrado en Trueque-P6! :)','0'),(97,317346744,'317346745 ha reaccionado \"Jajajaja\" a una publicación tuya 8','0'),(98,317346741,'¡Felicidades, te has registrado en Trueque-P6! :)','0'),(99,317346742,'El usuario 317346741 encontró tu credencial','1'),(100,979847874,'¡Felicidades, te has registrado en Trueque-P6! :)','0');
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
  `id_publi_per` int(11) NOT NULL,
  `id_dueño` int(9) DEFAULT NULL,
  `tipo_perdida` enum('ropa','cuaderno','credencial') NOT NULL,
  PRIMARY KEY (`id_perdida`),
  KEY `id_publi_per` (`id_publi_per`),
  KEY `id_dueño` (`id_dueño`),
  CONSTRAINT `perdida_ibfk_1` FOREIGN KEY (`id_publi_per`) REFERENCES `publicacion` (`id_publicacion`),
  CONSTRAINT `perdida_ibfk_2` FOREIGN KEY (`id_dueño`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perdida`
--

LOCK TABLES `perdida` WRITE;
/*!40000 ALTER TABLE `perdida` DISABLE KEYS */;
INSERT INTO `perdida` VALUES (2,8,NULL,'ropa'),(3,10,NULL,'credencial');
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
  `razon_denuncia` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_publicacion`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacion`
--

LOCK TABLES `publicacion` WRITE;
/*!40000 ALTER TABLE `publicacion` DISABLE KEYS */;
INSERT INTO `publicacion` VALUES (6,317346742,'1','inconcluso','../imagenes_pub/1.jpeg','Amigo, encontré tu celular, bonito fondo jajaja','Contenido inapropiado para la plataforma'),(7,317346743,'0','inconcluso','../imagenes_pub/7.jpeg','Cambio cualquiera de éstos libros por murmullos en la estación de Vega',NULL),(8,317346744,'0','inconcluso','../imagenes_pub/8.jpeg','Encontré esta playera en vestidores, pasa por ella al 518 :)',NULL),(9,317346745,'0','inconcluso','../imagenes_pub/9.jpeg','Vendo este cuaderno de física, está muy completo',NULL),(10,317346741,'0','inconcluso','../imagenes_pub/10.jpg','Hola, encontré tu credencial en biblioteca, pasa al 506 por ella con unos Hot Nuts',NULL);
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
  `id_publi_reac` int(11) NOT NULL,
  `id_usu_reac` int(9) NOT NULL,
  `tipo_reac` enum('Mmm','Jajajaja','Me vale') NOT NULL,
  PRIMARY KEY (`id_reaccion`),
  KEY `id_publi_reac` (`id_publi_reac`),
  KEY `id_usu_reac` (`id_usu_reac`),
  CONSTRAINT `reaccion_ibfk_1` FOREIGN KEY (`id_publi_reac`) REFERENCES `publicacion` (`id_publicacion`),
  CONSTRAINT `reaccion_ibfk_2` FOREIGN KEY (`id_usu_reac`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reaccion`
--

LOCK TABLES `reaccion` WRITE;
/*!40000 ALTER TABLE `reaccion` DISABLE KEYS */;
INSERT INTO `reaccion` VALUES (6,7,317346744,'Mmm'),(7,8,317346745,'Jajajaja');
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
  `id_publi_true` int(11) NOT NULL,
  `id_aceptador` int(9) DEFAULT NULL,
  PRIMARY KEY (`id_trueque`),
  KEY `id_aceptador` (`id_aceptador`),
  KEY `id_publi_true` (`id_publi_true`),
  CONSTRAINT `trueque_ibfk_1` FOREIGN KEY (`id_aceptador`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `trueque_ibfk_2` FOREIGN KEY (`id_publi_true`) REFERENCES `publicacion` (`id_publicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trueque`
--

LOCK TABLES `trueque` WRITE;
/*!40000 ALTER TABLE `trueque` DISABLE KEYS */;
INSERT INTO `trueque` VALUES (6,7,NULL),(7,9,NULL);
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
  `imagen` varchar(60) DEFAULT '../imagenes_per/default.png',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (317346741,'PaoInnes','cG#|D','\\T\"uV','UG&#R(','526e451c31fd5ebfed2f47e48fa0aee077983daa','modelo/imagenes_per/default.png'),(317346742,'EliMqzGmz','XR|+D{w+{','`á#T/w1','Zó}H4','ecd2595a4e2ced771e362d136eb4c0e778c400a6','modelo/imagenes_per/default.png'),(317346743,'EmyRam','XS||Lz','eG!í,w1','`S!}','ecd2595a4e2ced771e362d136eb4c0e778c400a6','modelo/imagenes_per/default.png'),(317346744,'Erikkk','XX|{','eí V','aUv{','ecd2595a4e2ced771e362d136eb4c0e778c400a6','modelo/imagenes_per/default.png'),(317346745,'Urielge','hX|uO','ZG&sís','XR##]z','526e451c31fd5ebfed2f47e48fa0aee077983daa','modelo/imagenes_per/default.png'),(979847874,'Administrador','Administrador',NULL,NULL,'658b387ccc6b6e388faf30f41ad5e988e62499c4','../imagenes_per/default.png');
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

-- Dump completed on 2018-06-13  2:53:49
