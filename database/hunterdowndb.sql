CREATE DATABASE  IF NOT EXISTS `hunterdowndb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hunterdowndb`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: hunterdowndb
-- ------------------------------------------------------
-- Server version	5.5.32

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (3,1,'Game of Thrones: Ice and Fire: A Foreshadowing',0,'2014-05-23 04:05:22'),(4,1,'Two Swords',1,'2014-05-23 04:05:30'),(5,1,'The Lion and the Rose',2,'2014-05-23 04:05:03'),(6,1,'Breaker of Chains',3,'2014-05-23 04:05:26'),(7,1,'Oathkeeper',4,'2014-05-23 04:05:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'PelÃ­Â­culas'),(2,'Series');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (1,'Aventura'),(2,'FantasÃ­a'),(3,'Drama'),(4,'Terror'),(5,'Comedia'),(6,'Suspenso'),(7,'AcciÃ³n'),(8,'Ciencia FicciÃ³n'),(9,'Dibujos Animados');
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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generostemas`
--

LOCK TABLES `generostemas` WRITE;
/*!40000 ALTER TABLE `generostemas` DISABLE KEYS */;
INSERT INTO `generostemas` VALUES (69,1,1),(70,3,1),(71,2,1),(74,3,4),(75,6,4),(76,4,4);
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
  `idusuarios` bigint(19) unsigned NOT NULL,
  `puntaje` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idpuntajes`),
  KEY `fk_puntajes_temas1_idx` (`idtemas`),
  KEY `fk_puntajes_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_puntajes_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_puntajes_temas1` FOREIGN KEY (`idtemas`) REFERENCES `temas` (`idtemas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntajes`
--

LOCK TABLES `puntajes` WRITE;
/*!40000 ALTER TABLE `puntajes` DISABLE KEYS */;
INSERT INTO `puntajes` VALUES (1,1,31,10),(2,4,31,7);
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
  `logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idservidores`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidores`
--

LOCK TABLES `servidores` WRITE;
/*!40000 ALTER TABLE `servidores` DISABLE KEYS */;
INSERT INTO `servidores` VALUES (1,'torrent','servidores/1.png'),(2,'eLink',NULL),(3,'MediaFire','servidores/3.png'),(4,'Mega','servidores/4.png'),(13,'RapidShare','servidores/13.png');
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
  `imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idtemas`),
  KEY `fk_temas_categorias1_idx` (`idcategorias`),
  KEY `fk_temas_usuarios1_idx` (`idusuarios`),
  CONSTRAINT `fk_temas_categorias1` FOREIGN KEY (`idcategorias`) REFERENCES `categorias` (`idcategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_temas_usuarios1` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temas`
--

LOCK TABLES `temas` WRITE;
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
INSERT INTO `temas` VALUES (1,2,31,'Games of Thrones',4,'La historia de CanciÃ³n de Hielo y Fuego se sitÃºa en un mundo ficticio medieval. Hay tres lÃ­neas argumentales en la serie: la crÃ³nica de la guerra civil dinÃ¡stica por el control de Poniente entre varias familias nobles; la creciente amenaza de los Otros, apenas contenida por un inmenso muro de hielo que protege el norte de Poniente; y el viaje de Daenerys Targaryen, la hija exiliada del rey que fue asesinado en otra guerra civil hace quince aÃ±os, quien busca regresar a Poniente a reclamar sus derechos.',2014,'2014-05-23 20:05:04','',NULL,'',' HDTV',0,'posters/1.jpeg'),(4,2,31,'Hannibal',2,'\"Hannibal\", serie de televisiÃ³n basada en el personaje de Hannibal Lecter. Bryan Fuller, responsable del proyecto, ha comentado que la idea inicial que tienen es la de realizar siete temporadas. La serie empezarÃ­a con una precuela de \"El dragÃ³n rojo\", es decir en la relaciÃ³n entre Hannibal y Will, aunque sin mencionar la infancia del protagonista que ya se explica en una precuela. La serie seguirÃ­a en sus siguientes temporadas adaptando de nuevo los siguientes libros de la saga tanto \"El dragÃ³n rojo\", \"El silencio de los corderos\" o \"Hannibal\" donde terminarÃ­a la saga literaria aunque podrÃ­a continuar su historia inventado su continuaciÃ³n. Fuller tambiÃ©n ha comentado que no tienen intenciÃ³n de mostrar a Hannibal como un cruel villano desde el comienzo. De hecho afirma que si el pÃºblico no conociese su historia, no podrÃ­an esperar lo que sucederÃ¡.',2014,'2014-05-23 20:05:12','',NULL,'','HDTV',0,'posters/4.jpeg');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urls`
--

LOCK TABLES `urls` WRITE;
/*!40000 ALTER TABLE `urls` DISABLE KEYS */;
INSERT INTO `urls` VALUES (1,7,1,'http://www.mejorenvo.com/descargar.php?t=series&id=31284&torrent=1'),(2,7,2,'http://www.mejorenvo.com/descargar.php?t=series&id=31284&torrent=1'),(3,7,3,'http://www.mejorenvo.com/descargar.php?t=series&id=31284&torrent=1'),(4,7,4,'http://www.mejorenvo.com/descargar.php?t=series&id=31284&torrent=1'),(5,7,13,'http://www.mejorenvo.com/descargar.php?t=series&id=31284&torrent=1'),(20,3,1,'http://www.mejorenvo.com/descargar.php?t=series&id=31284&torrent=1'),(21,4,3,'http://www.google.com');
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
  `idtipousuarios` bigint(19) unsigned NOT NULL,
  `nombre` varchar(90) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwd` varchar(260) NOT NULL,
  `fecnac` date NOT NULL,
  `sexo` enum('Mujer','Hombre','Otros') NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idusuarios`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuarios_tipousuarios_idx` (`idtipousuarios`),
  CONSTRAINT `fk_usuarios_tipousuarios` FOREIGN KEY (`idtipousuarios`) REFERENCES `tipousuarios` (`idtipousuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (25,1,'Danny Boscan','admin','dannyboscan@gmail.com','5ff3c11f9a342cdf0ac25a85dcdddda5','1985-03-21','Hombre',1),(26,2,'Over','oversio','overmartinez@gmail.com','b59c67bf196a4758191e42f76670ceba','1986-07-25','Hombre',1),(31,1,'Yeniree Sanchez','yeni_sanchez','yeniree@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','1987-04-20','Mujer',1);
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

-- Dump completed on 2014-05-23 14:39:19
