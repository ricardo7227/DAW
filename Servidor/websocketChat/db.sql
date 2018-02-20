-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: db4free.net    Database: clasesdaw
-- ------------------------------------------------------
-- Server version	8.0.4-rc-log

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
-- Table structure for table `APIKEY`
--

DROP TABLE IF EXISTS `APIKEY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `APIKEY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `APIKEY` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NUM_PETICIONES` int(11) DEFAULT NULL,
  `FECHA_ULTIMA_PETICION` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `APIKEY`
--

LOCK TABLES `APIKEY` WRITE;
/*!40000 ALTER TABLE `APIKEY` DISABLE KEYS */;
INSERT INTO `APIKEY` VALUES (1,'85RGF64UTVVFM9GZYY1H8U69N77IHSAKV83SEP9XWYB4R7GYM2',5,'2018-02-14 20:27:32'),(2,'2deee83e549c4a6e9709871d0fd58a0a',0,'2018-02-09 12:59:26'),(3,'a86tkwxxrfpcn0pf9krfu30kj7bd57uy',0,'2018-02-09 13:01:11'),(4,'25h78rp96hyyt468qee1431e114g39rew',0,'2018-02-11 11:32:51'),(5,'lkjasdfkadsflkjczxvjlkjadsdajklbjcarlos',0,'2018-02-09 12:49:26'),(6,'5481c1577cc22a1a08c7b9d0484ac244',0,'2018-02-09 17:49:26');
/*!40000 ALTER TABLE `APIKEY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `MAYOR_EDAD` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=725 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (403,'manolamela pls','2010-01-22',1),(412,'Andres Iniesta Iniaquella','1990-11-30',1),(426,'Manolito pue','2017-11-16',1),(431,'papapapajas eso es!!!','2017-11-16',1),(460,'alumno con nota3','2017-01-01',0),(523,'Paco Jones','2017-11-16',1),(525,'holacaracoola','2017-11-30',1),(526,'holacaraculo','2017-11-30',1),(527,'holacaracoola','2017-11-30',1),(530,'admin','2009-11-08',1),(532,'morta','2017-11-30',1),(535,'hola','2019-02-02',0),(723,'test4','2019-02-02',0);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignaturas`
--

DROP TABLE IF EXISTS `asignaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignaturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURSO` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CICLO` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignaturas`
--

LOCK TABLES `asignaturas` WRITE;
/*!40000 ALTER TABLE `asignaturas` DISABLE KEYS */;
INSERT INTO `asignaturas` VALUES (83,'dam','dam','dam'),(86,'cabrones','meteos con','EDU'),(94,'yiiha','ahusdau','asdako'),(99,'aaaaa','aaaaa','aaaaa'),(100,'sadasda','asdasdasd','dasdasda'),(111,'hola ','erasto','ketal'),(114,'mu','quien quiera','que seas'),(124,'mu2','que seas','quien quiera'),(129,'peter','peter','peter'),(135,'aa','aa','aa'),(138,'prueba2','2','122'),(142,'pruebba','ba','ba'),(155,'Barsa','Es','Enorme'),(166,'Asignatura','Asignatura','Asignatura'),(175,'asignatura con nota','no tocar','no tocar'),(199,'juan1ssss','juan2','juan1'),(207,'san','tin','valen'),(208,'ingles','tercero','b');
/*!40000 ALTER TABLE `asignaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canales`
--

DROP TABLE IF EXISTS `canales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clave` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canales`
--

LOCK TABLES `canales` WRITE;
/*!40000 ALTER TABLE `canales` DISABLE KEYS */;
/*!40000 ALTER TABLE `canales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canales_users`
--

DROP TABLE IF EXISTS `canales_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canales_users` (
  `id_canal` int(11) NOT NULL,
  `user` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_canal`,`user`),
  CONSTRAINT `canalFK` FOREIGN KEY (`id_canal`) REFERENCES `canales` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canales_users`
--

LOCK TABLES `canales_users` WRITE;
/*!40000 ALTER TABLE `canales_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `canales_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `id_canal` int(11) DEFAULT NULL,
  `nombre_user` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas` (
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_ASIGNATURA` int(11) NOT NULL,
  `NOTA` int(11) NOT NULL,
  PRIMARY KEY (`ID_ALUMNO`,`ID_ASIGNATURA`),
  KEY `NOTAS_ASIGNATURAS_idx` (`ID_ASIGNATURA`),
  CONSTRAINT `NOTAS_ALUMNOS` FOREIGN KEY (`ID_ALUMNO`) REFERENCES `alumnos` (`id`),
  CONSTRAINT `NOTAS_ASIGNATURAS` FOREIGN KEY (`ID_ASIGNATURA`) REFERENCES `asignaturas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
INSERT INTO `notas` VALUES (412,155,5),(426,166,7),(460,175,10),(530,99,5),(530,100,2),(530,111,3),(530,135,5),(723,208,6);
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro` (
  `nombre` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
INSERT INTO `registro` VALUES ('123','123'),('aa','nohay2sin3'),('Jones','1000:7816a0ef3c6d9b79bf273381e217d3a15270350e27213e9e:e1ebc4f79c985e9f769c9691a2f24ea4fd64c43c7aef8797'),('migueldiaz.tg@gmail.com','google'),('Paco','1000:c6dc1011931b05ecb74f3706324a5f53413fd670bd68ad93:2b40aa8f910053916228596e963a8a5075f8435739bd0491'),('sdas','asdasdasdasdasd');
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-20 13:03:56
