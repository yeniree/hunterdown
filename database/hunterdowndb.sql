CREATE DATABASE  IF NOT EXISTS `hunterdowndb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hunterdowndb`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: hunterdowndb
-- ------------------------------------------------------
-- Server version	5.6.14

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
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos` (
  `idarticulos` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `idtemas` bigint(19) unsigned NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `episodio` tinyint(4) NOT NULL,
  `fechahora` datetime NOT NULL,
  PRIMARY KEY (`idarticulos`),
  KEY `fk_articulos_temas1_idx` (`idtemas`),
  CONSTRAINT `fk_articulos_temas1` FOREIGN KEY (`idtemas`) REFERENCES `temas` (`idtemas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `idcategorias` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategorias`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Películas'),(2,'Series'),(3,'Documental');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios` (
  `idcomentarios` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `idarticulos` bigint(19) unsigned NOT NULL,
  `idusuarios` bigint(19) unsigned NOT NULL,
  `comentario` text NOT NULL,
  `fechahora` datetime NOT NULL,
  PRIMARY KEY (`idcomentarios`),
  KEY `fk_comentarios_articulos1_idx` (`idarticulos`),
  KEY `fk_comentarios_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_comentarios_articulos1` FOREIGN KEY (`idarticulos`) REFERENCES `articulos` (`idarticulos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generos` (
  `idgeneros` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idgeneros`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (1,'Aventura'),(2,'Fantasía'),(3,'Drama'),(4,'Terror'),(5,'Comedia'),(6,'Suspenso'),(7,'Acción'),(8,'Ciencia Ficción'),(9,'Dibujos Animados');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generostemas`
--

DROP TABLE IF EXISTS `generostemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generostemas` (
  `idgenerostemas` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `idgeneros` bigint(19) unsigned NOT NULL,
  `idtemas` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`idgenerostemas`),
  KEY `fk_generos_has_temas_temas1_idx` (`idtemas`),
  KEY `fk_generos_has_temas_generos1_idx` (`idgeneros`),
  CONSTRAINT `fk_generos_has_temas_generos1` FOREIGN KEY (`idgeneros`) REFERENCES `generos` (`idgeneros`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_generos_has_temas_temas1` FOREIGN KEY (`idtemas`) REFERENCES `temas` (`idtemas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generostemas`
--

LOCK TABLES `generostemas` WRITE;
/*!40000 ALTER TABLE `generostemas` DISABLE KEYS */;
/*!40000 ALTER TABLE `generostemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntajes`
--

DROP TABLE IF EXISTS `puntajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puntajes` (
  `idpuntajes` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `idtemas` bigint(19) unsigned NOT NULL,
  `puntaje` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idpuntajes`),
  KEY `fk_puntajes_temas1_idx` (`idtemas`),
  CONSTRAINT `fk_puntajes_temas1` FOREIGN KEY (`idtemas`) REFERENCES `temas` (`idtemas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntajes`
--

LOCK TABLES `puntajes` WRITE;
/*!40000 ALTER TABLE `puntajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `puntajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servidores`
--

DROP TABLE IF EXISTS `servidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servidores` (
  `idservidores` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`idservidores`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidores`
--

LOCK TABLES `servidores` WRITE;
/*!40000 ALTER TABLE `servidores` DISABLE KEYS */;
INSERT INTO `servidores` VALUES (1,'torrent','servidores/1.png'),(2,'eLink','servidores/2.png'),(3,'MediaFire','servidores/'),(4,'MegaUpload','servidores/'),(5,'RapidShare','servidores/');
/*!40000 ALTER TABLE `servidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temas`
--

DROP TABLE IF EXISTS `temas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temas` (
  `idtemas` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `idcategorias` bigint(19) unsigned NOT NULL,
  `idusuarios` bigint(19) unsigned NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `temporada` tinyint(4) DEFAULT '0',
  `sipnosis` text NOT NULL,
  `ano` smallint(6) NOT NULL,
  `fechahora` datetime NOT NULL,
  `pagoficial` varchar(250) DEFAULT NULL,
  `info` varchar(45) DEFAULT NULL,
  `trailer` varchar(250) DEFAULT NULL,
  `formato` varchar(45) DEFAULT NULL,
  `descargas` bigint(20) DEFAULT '0',
  PRIMARY KEY (`idtemas`),
  KEY `fk_temas_categorias1_idx` (`idcategorias`),
  KEY `fk_temas_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_temas_categorias1` FOREIGN KEY (`idcategorias`) REFERENCES `categorias` (`idcategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_temas_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temas`
--

LOCK TABLES `temas` WRITE;
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
/*!40000 ALTER TABLE `temas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipousuarios`
--

DROP TABLE IF EXISTS `tipousuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipousuarios` (
  `idtipousuarios` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idtipousuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipousuarios`
--

LOCK TABLES `tipousuarios` WRITE;
/*!40000 ALTER TABLE `tipousuarios` DISABLE KEYS */;
INSERT INTO `tipousuarios` VALUES (1,'Administrador'),(2,'Publicador'),(3,'Usuario Base');
/*!40000 ALTER TABLE `tipousuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urls`
--

DROP TABLE IF EXISTS `urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urls` (
  `idurls` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `idarticulos` bigint(19) unsigned NOT NULL,
  `idservidores` bigint(19) unsigned NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`idurls`),
  KEY `fk_urls_articulos1_idx` (`idarticulos`),
  KEY `fk_urls_servidores1_idx` (`idservidores`),
  CONSTRAINT `fk_urls_articulos1` FOREIGN KEY (`idarticulos`) REFERENCES `articulos` (`idarticulos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_urls_servidores1` FOREIGN KEY (`idservidores`) REFERENCES `servidores` (`idservidores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urls`
--

LOCK TABLES `urls` WRITE;
/*!40000 ALTER TABLE `urls` DISABLE KEYS */;
/*!40000 ALTER TABLE `urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuarios` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `idtipousuarios` bigint(19) unsigned NOT NULL DEFAULT '3',
  `nombre` varchar(90) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwd` varchar(260) NOT NULL,
  `fecnac` date NOT NULL,
  `sexo` enum('Mujer','Hombre','Otro') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuarios`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuarios_tipousuarios_idx` (`idtipousuarios`),
  CONSTRAINT `fk_usuarios_tipousuarios` FOREIGN KEY (`idtipousuarios`) REFERENCES `tipousuarios` (`idtipousuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (25,1,'Danny Boscan','admin','dannyboscan@gmail.com','5ff3c11f9a342cdf0ac25a85dcdddda5','1985-03-21','Hombre',1),(26,2,'Over','oversio','overmartinez@gmail.com','b59c67bf196a4758191e42f76670ceba','1986-07-25','Hombre',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-20  5:22:20
