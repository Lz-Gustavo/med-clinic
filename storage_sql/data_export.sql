CREATE DATABASE  IF NOT EXISTS `GeracaoSaude` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `GeracaoSaude`;
-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: GeracaoSaude
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Table structure for table `clinicas`
--

DROP TABLE IF EXISTS `clinicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinicas` (
  `id` int(10) unsigned NOT NULL,
  `nome` varchar(32) DEFAULT NULL,
  `descricao` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinicas`
--

LOCK TABLES `clinicas` WRITE;
/*!40000 ALTER TABLE `clinicas` DISABLE KEYS */;
INSERT INTO `clinicas` VALUES (1,'Saude Prazer','Somos uma clinica de tratamento de doenças ligadas a prática do coito, proporcionando a voce e sua parceira momentos de felicidade.'),(2,'MedFoot','Para nós, a preocupação com seu bem estar vem em primeiro lugar. Somos uma clínica especializada em tratamentos de enfermidades originadas nos membros inferiores.'),(3,'Brain Health','Problemas de despressão? Ansiedade? Nós da Brain Health possuímos capacitados profissionais capazes de te deixar animado novamente!');
/*!40000 ALTER TABLE `clinicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultas` (
  `crm` int(10) unsigned DEFAULT NULL,
  `cpf` int(10) unsigned DEFAULT NULL,
  `clinica` int(10) unsigned DEFAULT NULL,
  `dia` varchar(12) DEFAULT NULL,
  `horario` varchar(16) DEFAULT NULL,
  `obs` varchar(256) DEFAULT NULL,
  `receita` varchar(256) DEFAULT NULL,
  KEY `crm` (`crm`),
  KEY `cpf` (`cpf`),
  KEY `clinica` (`clinica`),
  CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`crm`) REFERENCES `medicos` (`crm`),
  CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`cpf`) REFERENCES `pacientes` (`cpf`),
  CONSTRAINT `consultas_ibfk_3` FOREIGN KEY (`clinica`) REFERENCES `clinicas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (1234,35123456,1,'2018-09-29','1 0 0 0 0 0 0 0','Indiscreto demais','Tilenol 400mg'),(1234,35123456,1,'2018-11-12','0 0 1 0 0 0 0 0','Gente boa','2 copo de whisky'),(1234,35123456,1,'2018-11-19','0 0 0 1 0 0 0 0','Possibilidade de câncer','Aspirina, 2 comprimido'),(9876,2112345678,1,'2018-11-12','0 0 1 0 0 0 0 0','la vem',NULL),(1234,808080,1,'2018-10-22','0 1 0 0 0 0 0 0','Pequeno grande homem','Lactobacilos férteis'),(1234,808080,1,'2018-10-04','0 0 0 1 0 0 0 0','H.D. doença encefálica',NULL),(1234,2456789,1,'2018-10-24','0 0 1 0 0 0 0 0',NULL,NULL),(1234,2112345678,1,'2018-10-24','0 0 0 0 0 0 1 0',NULL,NULL),(1234,2112345678,1,'2018-10-24','0 0 0 0 0 1 0 0',NULL,NULL),(1234,35123456,1,'2018-10-25','0 1 0 0 0 0 0 0',NULL,'Descanso'),(1234,2456789,2,'2018-10-23','1 0 0 0 0 0 0 0',NULL,NULL),(1234,2456789,3,'2018-10-26','0 0 0 0 0 1 0 0',NULL,NULL),(1234,2456789,3,'2018-10-26','0 0 0 0 0 0 1 0',NULL,NULL),(1234,808080,2,'2018-10-23','0 0 0 0 0 1 0 0',NULL,NULL),(1234,808080,3,'2018-10-26','0 1 0 0 0 0 0 0',NULL,NULL),(1234,35123456,2,'2018-10-23','0 0 0 0 0 0 0 1',NULL,NULL),(4321,35123456,2,'2018-10-25','0 0 1 0 0 0 0 0',NULL,NULL),(9876,35123456,3,'2018-10-26','0 0 0 1 0 0 0 0','Zé roela','Repouso Intensivo');
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credentials`
--

DROP TABLE IF EXISTS `credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credentials` (
  `crm` int(10) unsigned DEFAULT NULL,
  `cpf` int(10) unsigned DEFAULT NULL,
  `pw` varchar(32) DEFAULT NULL,
  KEY `crm` (`crm`),
  KEY `cpf` (`cpf`),
  CONSTRAINT `credentials_ibfk_1` FOREIGN KEY (`crm`) REFERENCES `medicos` (`crm`),
  CONSTRAINT `credentials_ibfk_2` FOREIGN KEY (`cpf`) REFERENCES `pacientes` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credentials`
--

LOCK TABLES `credentials` WRITE;
/*!40000 ALTER TABLE `credentials` DISABLE KEYS */;
INSERT INTO `credentials` VALUES (1234,NULL,'698dc19d489c4e4db73e28a713eab07b'),(9876,NULL,'96744845e691df222da01631aadc7b98'),(NULL,35123456,'f4cc08fa20e1167cba660c5fae1f2a1a'),(NULL,2456789,'f76d601547eb35762a020f4e7a5c907d'),(9090,NULL,'5c07c06622b0eb031a4658d8aa235af4'),(NULL,808080,'a905d89574379cec8ba1fc0438bf9597');
/*!40000 ALTER TABLE `credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `func_clinica`
--

DROP TABLE IF EXISTS `func_clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `func_clinica` (
  `crm` int(10) unsigned DEFAULT NULL,
  `clinica` int(10) unsigned DEFAULT NULL,
  `seg` varchar(8) DEFAULT NULL,
  `ter` varchar(8) DEFAULT NULL,
  `qua` varchar(8) DEFAULT NULL,
  `qui` varchar(8) DEFAULT NULL,
  `sex` varchar(8) DEFAULT NULL,
  KEY `crm` (`crm`),
  KEY `clinica` (`clinica`),
  CONSTRAINT `func_clinica_ibfk_1` FOREIGN KEY (`crm`) REFERENCES `medicos` (`crm`),
  CONSTRAINT `func_clinica_ibfk_2` FOREIGN KEY (`clinica`) REFERENCES `clinicas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `func_clinica`
--

LOCK TABLES `func_clinica` WRITE;
/*!40000 ALTER TABLE `func_clinica` DISABLE KEYS */;
INSERT INTO `func_clinica` VALUES (1234,1,'11110010','11111111','10101110','11111111','11111111'),(4321,1,'10000000','00000001','00000000','00000000','00000000'),(9876,1,'00000000','11110001','11110000','11110000','11111111'),(7777,1,'00000000','00000000','00000000','00000000','00000000'),(1234,2,'11111111','10000101','11111111','11111111','11111111'),(1234,3,'11111111','11111111','11111111','11111111','01000110'),(4321,2,'11111111','00000000','11111111','00100000','00000000'),(9876,3,'00000000','11111111','00000000','11111111','00011111');
/*!40000 ALTER TABLE `func_clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicos` (
  `crm` int(10) unsigned NOT NULL,
  `nome` varchar(60) NOT NULL,
  `sobrenome` varchar(80) DEFAULT NULL,
  `especializacao` varchar(60) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefone` varchar(60) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`crm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` VALUES (1234,'Ronaldinho','Bruxo','Obstretero','ronaldao@hotzao.com','32139139','Rua das Flores, 26'),(4321,'Ronaldo','Fenomena','Urologista','ronaldao@hotmail.com','32324455','rua das flores, 34'),(7777,'Socrates','Doutor','Hematologista','doc@curintia.com.br','5112345678','Av. Miguel Ignácio Curi, 111'),(9090,'Oswaldo','Cigarro','Pediatra','oswaldao22@hotmail.com','84074070','Avenida Presidente Vargas, 1234'),(9876,'Cafu','Roberto','Urologista','cafu@naoehopele.com','32139139','Marcilio Dias, 961');
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `cpf` int(10) unsigned NOT NULL,
  `nome` varchar(60) NOT NULL,
  `sobrenome` varchar(80) DEFAULT NULL,
  `nascimento` varchar(40) DEFAULT NULL,
  `sangue` varchar(40) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefone` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (808080,'Albano','Borbado','01/01/2001','O-','borba@hotmail.com','32321234'),(2456789,'Rafinha','Bastos',NULL,'B-','bastos@hotmail.com','32139139'),(35123456,'Zico','Fura Olheira','17/03/1941','O-','zicasso@hotzao.com','3232-4455'),(2112345678,'Cleiton','Cabecinha','08/12/1993','O-','cleitinho@furg.br','32324455');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-14 11:36:16
