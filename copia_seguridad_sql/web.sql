-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: web
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredientes` (
  `id_ingredientes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ingredientes`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredientes`
--

LOCK TABLES `ingredientes` WRITE;
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` VALUES (1,'Tomate'),(2,'Diente de ajo'),(3,'Pan'),(4,'JamÃ³n picado'),(5,'Huevo cocido'),(6,'Vinagre'),(7,'Sal'),(8,'Aceite de oliva'),(9,'Cebolla'),(10,'CalabacÃ­n'),(11,'Caldo de pollo'),(12,'Quesito'),(13,'Pimienta negra'),(14,'Queso Parmesano'),(17,'Harina'),(20,'Agua');
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miembros`
--

DROP TABLE IF EXISTS `miembros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `miembros` (
  `id_miembros` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(99) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT 'usuario',
  PRIMARY KEY (`id_miembros`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembros`
--

LOCK TABLES `miembros` WRITE;
/*!40000 ALTER TABLE `miembros` DISABLE KEYS */;
INSERT INTO `miembros` VALUES (1,'HulFlyS','7ed1ca45414f40612d0c469e24453e40','juagilest@gmail.com','admin'),(2,'juan','7ed1ca45414f40612d0c469e24453e40','juan@juan.com','usuario'),(12,'pepe','7ed1ca45414f40612d0c469e24453e40','pepe@pepe.com','usuario');
/*!40000 ALTER TABLE `miembros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recetas`
--

DROP TABLE IF EXISTS `recetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recetas` (
  `id_recetas` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `texto` text,
  `tiempo` time DEFAULT NULL,
  `nivel` enum('bajo','medio','alto') DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `id_miembros` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_recetas`),
  KEY `id_miembros` (`id_miembros`),
  CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`id_miembros`) REFERENCES `miembros` (`id_miembros`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recetas`
--

LOCK TABLES `recetas` WRITE;
/*!40000 ALTER TABLE `recetas` DISABLE KEYS */;
INSERT INTO `recetas` VALUES (1,'Salmorejo','-Ponemos dos cucharas de aceite de oliva en la sartÃ©n y echamos el ajo picado. Lo tenemos a fuego suave hasta que se dore, y lo apartamos. -Lavamos y troceamos los tomates. A continuaciÃ³n lo echamos todo en el vaso de la batidora, junto con el ajo picado, el aceite, un chorrito de vinagre, una pizca de sal y un trocito de pan. Lo batimos todo y vamos echando pan hasta que tengamos la consistencia de un purÃ©, y lo probamos. Si nos gusta mÃ¡s fuerte echamos mÃ¡s vinagre. -Una vez estÃ¡ a tu gusto, lo vuelcas todo en un chino para quitar las pepitas y la piel del tomate. Y servir. -Picamos un huevo, un poco de jamÃ³n y los echamos al servirlo.','00:45:00','medio','salmorejo.jpg',1),(2,'Crema de calabacÃ­n','Paso 1. En una cazuela grande, agrega el caldo (o el agua con las patillas de caldo), el aceite de oliva virgen, la cebolla, el ajo y el calabacÃ­n. Ponlo a calentar a fuego medio, tÃ¡palo y deja que empiece a hervir. En el momento en que llegue a ebulliciÃ³n, reduce la temperatura.\nPaso 2. Deja que siga cocinero todo con la tapa puesta, removiendo los ingredientes ocasionalmente durante unos 20 minutos, hasta que todos los componentes estÃ©n tiernos (pincha con un tenedor los vegetales para ver si estÃ¡n bien cocidos).\nPaso 3. Retira del fuego la cazuela, incorpora los quesitos y, en la misma cazuela, bate todo el contenido con una batidora de mano, hasta que todo estÃ© fino y no tenga ningÃºn tropiezo.\nPaso 4. Sazona la crema de calabacÃ­n con sal y pimienta negra al gusto, rectificando si es necesario, y sÃ­rvelo caliente en platos individuales, con un poco de queso parmesano rallado por encima.','00:30:00','medio','crema_de_calabacin.jpg',1);
/*!40000 ALTER TABLE `recetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tienen`
--

DROP TABLE IF EXISTS `tienen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tienen` (
  `id_recetas` int(11) NOT NULL DEFAULT '0',
  `id_ingredientes` int(11) NOT NULL DEFAULT '0',
  `cantidad` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_recetas`,`id_ingredientes`),
  KEY `id_ingredientes` (`id_ingredientes`),
  CONSTRAINT `tienen_ibfk_1` FOREIGN KEY (`id_recetas`) REFERENCES `recetas` (`id_recetas`) ON DELETE CASCADE,
  CONSTRAINT `tienen_ibfk_2` FOREIGN KEY (`id_ingredientes`) REFERENCES `ingredientes` (`id_ingredientes`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tienen`
--

LOCK TABLES `tienen` WRITE;
/*!40000 ALTER TABLE `tienen` DISABLE KEYS */;
INSERT INTO `tienen` VALUES (1,1,'6 unidades'),(1,2,'1 unidad'),(1,3,'100g'),(1,4,'100g'),(1,5,'1 unidad'),(1,6,'Al gusto'),(1,7,'Al gusto'),(1,8,'2 cucharillas'),(2,2,'2 unidades'),(2,7,'Al gusto'),(2,8,'3 cucharadas'),(2,9,'1/2 unidad en cuartos'),(2,10,'3 unidades, trozos grandes'),(2,11,'700ml'),(2,12,'7 unidades'),(2,13,'Al gusto'),(2,14,'Al gusto, rallado');
/*!40000 ALTER TABLE `tienen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valoraciones`
--

DROP TABLE IF EXISTS `valoraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valoraciones` (
  `id_valoraciones` int(11) NOT NULL AUTO_INCREMENT,
  `puntuacion` int(11) DEFAULT NULL,
  `texto` text,
  `id_recetas` int(11) DEFAULT NULL,
  `id_miembros` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_valoraciones`),
  KEY `id_recetas` (`id_recetas`),
  KEY `id_miembros` (`id_miembros`),
  CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`id_recetas`) REFERENCES `recetas` (`id_recetas`) ON DELETE CASCADE,
  CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`id_miembros`) REFERENCES `miembros` (`id_miembros`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valoraciones`
--

LOCK TABLES `valoraciones` WRITE;
/*!40000 ALTER TABLE `valoraciones` DISABLE KEYS */;
INSERT INTO `valoraciones` VALUES (5,5,'Me gustÃ³ la receta',1,2),(10,4,'Me gusta mucho la receta, muy buena!',2,12);
/*!40000 ALTER TABLE `valoraciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-27 19:07:24
