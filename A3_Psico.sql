-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: a3_psico
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `id_paciente` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `genero` varchar(5) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `contato` varchar(15) DEFAULT NULL,
  `contato_emergencia` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `escolaridade` varchar(20) DEFAULT NULL,
  `ocupacao` varchar(25) DEFAULT NULL,
  `necessidade_especial` varchar(9) DEFAULT NULL,
  `estagiario_responsavel` int(4) DEFAULT NULL,
  `orientador_responsavel` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  KEY `estagiario_responsavel` (`estagiario_responsavel`),
  KEY `orientador_responsavel` (`orientador_responsavel`),
  CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`estagiario_responsavel`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`orientador_responsavel`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (11,'Ana Pereira','F','1985-07-22','11987654321','11987654322','ana.pereira@example.com','Rua Central, 456, Cidade Exemplo','Ensino Superior Comp','Professora','Nenhuma',2,3),(12,'Carlos Souza','M','1992-03-10','11912345678','11912345679','carlos.souza@example.com','Avenida Brasil, 789, Cidade Exemplo','Ensino Médio Complet','Motorista','Nenhuma',2,3),(13,'Fernanda Lima','F','1978-11-30','11923456789','11923456780','fernanda.lima@example.com','Rua das Flores, 101, Cidade Exemplo','Ensino Superior Comp','Advogada','Nenhuma',2,3),(14,'Marcos Oliveira','M','1980-09-15','11934567890','11934567891','marcos.oliveira@example.com','Rua do Campo, 202, Cidade Exemplo','Ensino Médio Complet','Técnico em Informática','Nenhuma',2,3),(15,'Beatriz Santos','F','1995-12-05','11945678901','11945678902','beatriz.santos@example.com','Rua Nova, 303, Cidade Exemplo','Ensino Fundamental C','Estudante','Nenhuma',2,3);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prontuario`
--

DROP TABLE IF EXISTS `prontuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prontuario` (
  `id_prontuario` int(11) NOT NULL AUTO_INCREMENT,
  `data_abertura` date DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `data_inicio_atendimentos` date DEFAULT NULL,
  `historico_familiar` varchar(255) DEFAULT NULL,
  `historico_social` varchar(255) DEFAULT NULL,
  `consideracoes_finais` varchar(255) DEFAULT NULL,
  `observacoes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_prontuario`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `fk_id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`),
  CONSTRAINT `fk_prontuario_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prontuario`
--

LOCK TABLES `prontuario` WRITE;
/*!40000 ALTER TABLE `prontuario` DISABLE KEYS */;
INSERT INTO `prontuario` VALUES (1,'2024-11-19',11,'2024-12-20','Todo mundo fodido.','Todo mundo esquisito.','É maluca.','1/2 Dramim p viajar.');
/*!40000 ALTER TABLE `prontuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessao`
--

DROP TABLE IF EXISTS `sessao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessao` (
  `id_sessao` int(11) NOT NULL AUTO_INCREMENT,
  `data_sessao` date DEFAULT NULL,
  `numero_sessao` int(3) DEFAULT NULL,
  `descricao_atividades` varchar(255) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  PRIMARY KEY (`id_sessao`),
  KEY `fk_sessao_paciente` (`id_paciente`),
  CONSTRAINT `fk_sessao_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessao`
--

LOCK TABLES `sessao` WRITE;
/*!40000 ALTER TABLE `sessao` DISABLE KEYS */;
INSERT INTO `sessao` VALUES (1,'2024-11-20',1,'Estimulo de clitoris','Não consegue limpa a bunda.',11),(2,'2024-11-21',2,'bla bka','ble blke',11);
/*!40000 ALTER TABLE `sessao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `nivel` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Julia','julia@gmail','$2y$10$wklwvh./','USER'),(2,'Marlon','marlon@gmail','$2y$10$uXoT0N5YqK67i6Rdyx005e4b77YnrkYzhwJGTUQu/mN.QSedgRahW','USER'),(3,'Xavier','xavier@gmail','$2y$10$4o2nDeZchpd/9wIXplAEle842tnqDswxk3mjYfB.0bMWgi31FprQu','ADM');
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

-- Dump completed on 2024-11-19 12:27:58
