/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.5.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: atualiza_membros_ipvp
-- ------------------------------------------------------
-- Server version	11.5.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(70) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(70) DEFAULT NULL,
  `bairro` varchar(45) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `membro_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Cadastro Endereços';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membros`
--

DROP TABLE IF EXISTS `membros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` int(11) NOT NULL DEFAULT 1,
  `disciplina` int(11) DEFAULT NULL,
  `motivodemissao` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `datacasamento` date DEFAULT NULL,
  `naturalidade` varchar(100) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `estadocivil` int(11) DEFAULT NULL,
  `nomeconjuge` varchar(100) DEFAULT NULL,
  `nomepai` varchar(100) DEFAULT NULL,
  `nomemae` varchar(100) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `fone` varchar(20) DEFAULT NULL,
  `fone2` varchar(20) DEFAULT NULL,
  `cel` varchar(20) DEFAULT NULL,
  `escolaridade_id` int(11) DEFAULT NULL,
  `profissao_id` int(11) DEFAULT NULL,
  `empresa` varchar(150) DEFAULT NULL,
  `batizado` int(11) DEFAULT NULL,
  `databatismo` date DEFAULT NULL,
  `profissaofe` int(11) DEFAULT NULL,
  `dataprofe` date DEFAULT NULL,
  `igrejabatismo` varchar(100) DEFAULT NULL,
  `pastorbatismo` varchar(100) DEFAULT NULL,
  `igrejaprofe` varchar(100) DEFAULT NULL,
  `pastorprofe` varchar(100) DEFAULT NULL,
  `areainteresse` text DEFAULT NULL,
  `ultimaigreja` varchar(100) DEFAULT NULL,
  `datamembro` date DEFAULT NULL,
  `meioadmissao` int(11) DEFAULT NULL,
  `igrejasanteriores` text DEFAULT NULL,
  `foto_caminho` varchar(255) DEFAULT NULL,
  `foto_exibicao` varchar(255) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `tipo` enum('Membro','Visitante') DEFAULT NULL COMMENT 'Tipo de cadastro. 1 => Membro, 2 => Visitante',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Cadastro de membros';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membros`
--

LOCK TABLES `membros` WRITE;
/*!40000 ALTER TABLE `membros` DISABLE KEYS */;
/*!40000 ALTER TABLE `membros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissaos`
--

DROP TABLE IF EXISTS `profissaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profissaos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `descricao` text DEFAULT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Cadastro Profissão membros';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissaos`
--

LOCK TABLES `profissaos` WRITE;
/*!40000 ALTER TABLE `profissaos` DISABLE KEYS */;
/*!40000 ALTER TABLE `profissaos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-02-09 11:22:21
