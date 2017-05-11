-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: sistema
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `Area`
--

DROP TABLE IF EXISTS `Area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(35) DEFAULT NULL,
  `puesto` varchar(35) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_colab` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_area`),
  KEY `id_empresa` (`id_empresa`),
  KEY `id_colab` (`id_colab`),
  CONSTRAINT `Area_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `Empresa` (`id_empresa`),
  CONSTRAINT `Area_ibfk_2` FOREIGN KEY (`id_colab`) REFERENCES `Colaborador` (`id_colaborador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Area`
--

LOCK TABLES `Area` WRITE;
/*!40000 ALTER TABLE `Area` DISABLE KEYS */;
/*!40000 ALTER TABLE `Area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Colaborador`
--

DROP TABLE IF EXISTS `Colaborador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Colaborador` (
  `id_colaborador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) NOT NULL,
  `a_paterno` varchar(35) DEFAULT NULL,
  `a_materno` varchar(35) DEFAULT NULL,
  `correo` varchar(35) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `clave` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_colaborador`),
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `Colaborador_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `Empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Colaborador`
--

LOCK TABLES `Colaborador` WRITE;
/*!40000 ALTER TABLE `Colaborador` DISABLE KEYS */;
INSERT INTO `Colaborador` VALUES (1,'Ivan','Orozco','Uscanga','ivan@blackinntech.com',1,1,2,'ivan2016'),(2,'Elizabeth','Diaz','Albarran','elizabeth.diaz@blackinntech.com',1,1,2,'eli2016'),(3,'Jose Carlos','Castro','Reyes','jose.reyes@blackinntech.com',1,1,2,'carlos2016'),(4,'Macario','Minor','Arenas','macario.miror@blackinntech.com',1,1,2,'macario2016'),(5,'Super','admin','admin','admin@admin.com',1,1,1,'admin2017'),(6,'Eliud','Elizondo','Moya','eliud@blackinntech.com',1,1,2,'eliud2016'),(7,'Carlos','Nacianceno','Sepulveda','carlos@blackinntech.com  ',1,0,2,'carlos2017');
/*!40000 ALTER TABLE `Colaborador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Empresa`
--

DROP TABLE IF EXISTS `Empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) DEFAULT NULL,
  `RFC` varchar(30) DEFAULT NULL,
  `direccion` text,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Empresa`
--

LOCK TABLES `Empresa` WRITE;
/*!40000 ALTER TABLE `Empresa` DISABLE KEYS */;
INSERT INTO `Empresa` VALUES (1,'BlackInnTech','BIT151016GI7','Calle Montes Urales 424, Lomas - Virreyes, Lomas de Chapultepec V Secc, 11000 Ciudad de México'),(2,'Total Medic','EHE170207U46','Calle Montes Urales 24, Lomas - Virreyes, Lomas de Chapultepec V Secc, 11000 Ciudad de México'),(3,'Emma','Emma1718w3edf','MontesUrales'),(4,'BlackTrust','1234567890123','MontesUrales');
/*!40000 ALTER TABLE `Empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visita`
--

DROP TABLE IF EXISTS `visita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_visitante` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_colaborador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_colaborador` (`id_colaborador`),
  KEY `id_visitante` (`id_visitante`),
  CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`id_colaborador`) REFERENCES `Colaborador` (`id_colaborador`),
  CONSTRAINT `visita_ibfk_2` FOREIGN KEY (`id_visitante`) REFERENCES `visitantes` (`id_visitante`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visita`
--

LOCK TABLES `visita` WRITE;
/*!40000 ALTER TABLE `visita` DISABLE KEYS */;
INSERT INTO `visita` VALUES (1,1,'2017-05-10','15:43:00',3),(2,1,'2017-05-10','15:47:00',3),(3,1,'2017-05-31','13:00:00',1),(4,2,'2017-05-11','09:50:00',7),(5,2,'2017-05-12','10:00:00',6);
/*!40000 ALTER TABLE `visita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitantes` (
  `id_visitante` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) DEFAULT NULL,
  `a_paterno` varchar(35) DEFAULT NULL,
  `a_materno` varchar(35) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `empresa_origen` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_visitante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitantes`
--

LOCK TABLES `visitantes` WRITE;
/*!40000 ALTER TABLE `visitantes` DISABLE KEYS */;
INSERT INTO `visitantes` VALUES (1,'Carolina','Castro','Reyes','carolina@gmail.com','Prueba'),(2,'German','Sanchez','Tamayo','germa@gmail.com','telmex');
/*!40000 ALTER TABLE `visitantes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-11 11:27:57
