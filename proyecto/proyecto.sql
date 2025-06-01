-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: proyecto
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `proyecto`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `proyecto` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `proyecto`;

--
-- Table structure for table `corral`
--

DROP TABLE IF EXISTS `corral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `corral` (
  `id_corral` int(11) NOT NULL,
  `tamaño` decimal(5,2) NOT NULL,
  `tipo_material` varchar(100) NOT NULL,
  `limpieza_id` int(11) NOT NULL,
  `hato_id` int(11) NOT NULL,
  PRIMARY KEY (`id_corral`),
  KEY `limpieza_id` (`limpieza_id`),
  KEY `hato_id` (`hato_id`),
  CONSTRAINT `corral_ibfk_1` FOREIGN KEY (`limpieza_id`) REFERENCES `limpieza` (`id_limpieza`),
  CONSTRAINT `corral_ibfk_2` FOREIGN KEY (`hato_id`) REFERENCES `hato` (`id_hato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corral`
--

LOCK TABLES `corral` WRITE;
/*!40000 ALTER TABLE `corral` DISABLE KEYS */;
INSERT INTO `corral` VALUES (1,25.50,'Madera y alambre',1,1),(2,30.00,'Cemento',2,2),(3,18.75,'Madera',3,3),(4,22.10,'Metal galvanizado',4,4),(5,28.00,'Bloque y malla',5,5);
/*!40000 ALTER TABLE `corral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hato`
--

DROP TABLE IF EXISTS `hato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hato` (
  `id_hato` int(11) NOT NULL,
  `nombre_hato` varchar(100) NOT NULL,
  `produccion_diaria` decimal(6,2) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `vacas_actuales` int(11) NOT NULL,
  `tipo_suelo_id` int(11) NOT NULL,
  PRIMARY KEY (`id_hato`),
  KEY `tipo_suelo_id` (`tipo_suelo_id`),
  CONSTRAINT `hato_ibfk_1` FOREIGN KEY (`tipo_suelo_id`) REFERENCES `tipo_suelo` (`id_tipo_suelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hato`
--

LOCK TABLES `hato` WRITE;
/*!40000 ALTER TABLE `hato` DISABLE KEYS */;
INSERT INTO `hato` VALUES (1,'Hato Primavera',120.50,80,75,1),(2,'Hato El Roble',98.75,60,58,2),(3,'Hato Santa Rosa',140.00,90,85,3),(4,'Hato Buenavista',76.30,50,45,1),(5,'Hato La Esperanza',105.10,70,69,2);
/*!40000 ALTER TABLE `hato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `limpieza`
--

DROP TABLE IF EXISTS `limpieza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `limpieza` (
  `id_limpieza` int(11) NOT NULL,
  `metodo` varchar(100) NOT NULL,
  `frecuencia` varchar(50) NOT NULL,
  PRIMARY KEY (`id_limpieza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `limpieza`
--

LOCK TABLES `limpieza` WRITE;
/*!40000 ALTER TABLE `limpieza` DISABLE KEYS */;
INSERT INTO `limpieza` VALUES (1,'Lavado a presión','Diaria'),(2,'Desinfección con cloro','Semanal'),(3,'Enjuague con agua caliente','Diaria'),(4,'Limpieza manual','Cada 3 días'),(5,'Hidrolavadora con detergente','Semanal');
/*!40000 ALTER TABLE `limpieza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_suelo`
--

DROP TABLE IF EXISTS `tipo_suelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_suelo` (
  `id_tipo_suelo` int(11) NOT NULL,
  `tipo_suelo` varchar(100) NOT NULL,
  `calidad_suelo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_suelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_suelo`
--

LOCK TABLES `tipo_suelo` WRITE;
/*!40000 ALTER TABLE `tipo_suelo` DISABLE KEYS */;
INSERT INTO `tipo_suelo` VALUES (1,'Franco arenoso','Buena'),(2,'Arcilloso','Regular'),(3,'Franco limoso','Muy buena'),(4,'Arenoso','Pobre'),(5,'Franco arcilloso','Aceptable');
/*!40000 ALTER TABLE `tipo_suelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `documento` varchar(10) NOT NULL,
  `nombre1` varchar(20) DEFAULT NULL,
  `nombre2` varchar(20) DEFAULT NULL,
  `apellido1` varchar(20) DEFAULT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `municipio` varchar(30) DEFAULT NULL,
  `departamento` varchar(30) DEFAULT NULL,
  `perfil` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`documento`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('1018230700','brenda','hisela','arevalo','borja','3233505993','calle 111D #64-45','Medellín','Antioquia','Administrador','nazly0509@gmail.com','bren1234','A'),('1023523831','jhorman','andres','salazar','quiroz','3026718778','calle 111D #64-45','Medellín','Antioquia','Propietario','salazarjhorman818@gmail.com','jhor1234','A');
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

-- Dump completed on 2025-05-28 22:01:30
