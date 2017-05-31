CREATE DATABASE  IF NOT EXISTS `contaazulnfe` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `contaazulnfe`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: contaazulnfe
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `address_number` varchar(45) DEFAULT NULL,
  `address_neighb` varchar(50) DEFAULT NULL,
  `address_state` varchar(45) DEFAULT NULL,
  `address_city` varchar(50) DEFAULT NULL,
  `address_country` varchar(50) DEFAULT NULL,
  `address_zipcode` varchar(50) DEFAULT NULL,
  `stars` int(11) NOT NULL DEFAULT '3',
  `internal_obs` text,
  PRIMARY KEY (`id`),
  KEY `id_company_clients_fk_idx` (`id_company`),
  CONSTRAINT `id_company_clients_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (2,1,'Cliente teste','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','618','Boa Viagem','PE','Recife','Brasil','51021130',4,'cliente bom pagador 2'),(3,1,'Miguel','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','618','Boa Viagem','PE','Recife','Brasil','51021130',2,'cliente bom pagador 2'),(4,1,'Bernardo','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','618','Boa Viagem','PE','Recife','Brasil','51021130',1,'cliente bom pagador 2'),(5,1,'Valentina','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','618','Boa Viagem','PE','Recife','Brasil','51021130',3,'cliente bom pagador 2'),(6,1,'Maria Luiza','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','618','Boa Viagem','PE','Recife','Brasil','51021130',5,'cliente bom pagador 2'),(7,1,'Guilherme','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','6346','Boa Viagem','PE','Recife','Brasil','51021130',3,'cliente bom pagador 2'),(8,1,'João Pedro','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','534','Boa Viagem','PE','Recife','Brasil','51021130',2,'cliente bom pagador 2'),(9,1,'Gustavo Teste','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','634','Boa Viagem','PE','Recife','Brasil','51021130',4,'cliente bom pagador 2'),(10,1,'Ana Clara','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','523','Boa Viagem','PE','Recife','Brasil','51021130',4,'cliente bom pagador 2'),(11,1,'Enzo Gabriel','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','6234','Boa Viagem','PE','Recife','Brasil','51021130',3,'cliente bom pagador 2'),(12,1,'Isadora','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','6234','Boa Viagem','PE','Recife','Brasil','51021130',4,'cliente bom pagador 2'),(13,1,'Pedro Henrique','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','0890','Boa Viagem','PE','Recife','Brasil','51021130',5,'cliente bom pagador 2'),(14,1,'Ana Luiza','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','67','Boa Viagem','PE','Recife','Brasil','51021130',2,'cliente bom pagador 2'),(15,1,'Davi Lucca','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','45','Boa Viagem','PE','Recife','Brasil','51021130',2,'cliente bom pagador 2'),(16,1,'Maria Cecília','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','64','Boa Viagem','PE','Recife','Brasil','51021130',4,'cliente bom pagador 2'),(17,1,'João Guilherme','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','47','Boa Viagem','PE','Recife','Brasil','51021130',3,'cliente bom pagador 2'),(18,1,'Maria Fernanda','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','567','Boa Viagem','PE','Recife','Brasil','51021130',5,'cliente bom pagador 2'),(19,1,'Emilly','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','5247','Boa Viagem','PE','Recife','Brasil','51021130',3,'cliente bom pagador 2'),(20,1,'Vitor Hugo','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','3','Boa Viagem','PE','Recife','Brasil','51021130',5,'cliente bom pagador 2'),(21,1,'Pietra','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','652','Boa Viagem','PE','Recife','Brasil','51021130',4,'cliente bom pagador 2'),(22,1,'Fernanda','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','658','Boa Viagem','PE','Recife','Brasil','51021130',4,'cliente bom pagador 2'),(23,1,'Luiz Felipe','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','98','Boa Viagem','PE','Recife','Brasil','51021130',5,'cliente bom pagador 2'),(24,1,'Davi Luiz','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','897','Boa Viagem','PE','Recife','Brasil','51021130',3,'cliente bom pagador 2'),(25,1,'Carlos Eduardo','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','745','Boa Viagem','PE','Recife','Brasil','51021130',2,'cliente bom pagador 2'),(26,1,'Mirella','cliente2@hotmail.com','81 988824977','Rua Coronel Anízio Rodrigues Coelho','apt 2804','76','Boa Viagem','PE','Recife','Brasil','51021130',1,'cliente bom pagador 2'),(27,1,'Luiz Henrique','','','','','','','','','','',3,''),(28,1,'Paulo França','paulofranca.contato@gmail.com','81 988824977','Rua Rosa Amelia da Paz','apt 203','251','Piedade','PE','Jaboatão dos Guararapes','Brasil','54410-315',5,'Eu como cliente');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Empresa 123'),(2,'Paulo Admin');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `quant` int(11) NOT NULL,
  `min_quant` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_company_inventory_fk_idx` (`id_company`),
  CONSTRAINT `id_company_inventory_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,1,'Produto de Teste',150.25,10,15),(2,1,'Outro Produto',58.6,9,12),(3,1,'Produto novo [editado]',1500,12,12),(4,1,'teste2',15555.5,5,10),(5,1,'Produto de Limpeza',5.95,76,10),(6,1,'Placa de Vídeo Gigabyte [Nova]',590,9,3),(7,1,'PC Gamer',3500,9,5);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_history`
--

DROP TABLE IF EXISTS `inventory_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `action` varchar(3) NOT NULL,
  `date_action` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product_fk_idx` (`id_product`),
  KEY `id_user_fk_idx` (`id_user`),
  KEY `id_company_inventory_history_fk_idx` (`id_company`),
  CONSTRAINT `id_company_inventory_history_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_product_inventory_history_fk` FOREIGN KEY (`id_product`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_user_inventory_history_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_history`
--

LOCK TABLES `inventory_history` WRITE;
/*!40000 ALTER TABLE `inventory_history` DISABLE KEYS */;
INSERT INTO `inventory_history` VALUES (1,1,1,1,'add','2017-05-19 09:25:17'),(2,1,2,1,'add','2017-05-19 09:25:40'),(3,1,3,1,'add','2017-05-19 10:37:23'),(4,1,4,1,'add','2017-05-19 11:23:28'),(7,1,4,1,'edt','2017-05-19 11:29:41'),(8,1,4,1,'edt','2017-05-19 11:30:30'),(9,1,4,1,'edt','2017-05-19 11:30:38'),(15,1,4,1,'edt','2017-05-19 17:15:09'),(16,1,5,1,'add','2017-05-22 16:48:52'),(17,1,5,1,'dwn','2017-05-22 17:16:07'),(18,1,2,1,'dwn','2017-05-22 17:16:07'),(19,1,2,1,'dwn','2017-05-22 17:16:41'),(20,1,5,1,'dwn','2017-05-24 16:03:42'),(21,1,6,1,'add','2017-05-25 13:59:30'),(22,1,6,1,'edt','2017-05-25 13:59:40'),(23,1,6,1,'dwn','2017-05-25 14:28:17'),(24,1,5,1,'dwn','2017-05-25 14:28:17'),(25,1,7,1,'add','2017-05-26 17:32:29'),(26,1,7,1,'dwn','2017-05-26 17:32:56'),(27,1,5,1,'dwn','2017-05-26 17:33:33'),(28,1,2,1,'dwn','2017-05-26 17:33:33');
/*!40000 ALTER TABLE `inventory_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_groups`
--

DROP TABLE IF EXISTS `permission_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `params` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_company_permission_groups_fk_idx` (`id_company`),
  CONSTRAINT `id_company_permission_groups_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_groups`
--

LOCK TABLES `permission_groups` WRITE;
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
INSERT INTO `permission_groups` VALUES (1,1,'Desenvolvedores','1,2,6,7,8,9,10,11,12,13,15'),(5,2,'Grupo de teste 3','1,2,3,4'),(6,1,'Group of test','1,2,6');
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_params`
--

DROP TABLE IF EXISTS `permission_params`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_company_permission_params_fk_idx` (`id_company`),
  CONSTRAINT `id_company_permission_params_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_params`
--

LOCK TABLES `permission_params` WRITE;
/*!40000 ALTER TABLE `permission_params` DISABLE KEYS */;
INSERT INTO `permission_params` VALUES (1,1,'logout'),(2,1,'permissions_view'),(3,2,'permissions_view'),(4,2,'permission_usuarios_ex'),(6,1,'users_view'),(7,1,'clients_view'),(8,1,'clients_edit'),(9,1,'inventory_view'),(10,1,'inventory_add'),(11,1,'inventory_edit'),(12,1,'sales_view'),(13,1,'sales_edit'),(15,1,'report_view');
/*!40000 ALTER TABLE `permission_params` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_purchase` datetime NOT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_purchases_pk_idx` (`id_user`),
  KEY `id_company_purchases_fk_idx` (`id_company`),
  CONSTRAINT `id_company_purchases_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_user_purchases_pk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases_products`
--

DROP TABLE IF EXISTS `purchases_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_purchases` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quant` int(11) NOT NULL,
  `purchases_price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_purchases_purchases_products_idx` (`id_purchases`),
  KEY `id_company_purchases_products_fk_idx` (`id_company`),
  CONSTRAINT `id_company_purchases_products_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_purchases_purchases_products` FOREIGN KEY (`id_purchases`) REFERENCES `purchases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases_products`
--

LOCK TABLES `purchases_products` WRITE;
/*!40000 ALTER TABLE `purchases_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_sale` datetime NOT NULL,
  `total_price` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_client_fk_idx` (`id_client`),
  KEY `id_user_fk_idx` (`id_user`),
  KEY `id_company_sales_fk_idx` (`id_company`),
  CONSTRAINT `id_client_sales_fk` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_company_sales_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_user_sales_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (9,1,9,1,'2017-05-22 16:47:47',267.45,0),(10,1,9,1,'2017-05-22 16:49:13',59.5,1),(13,1,14,1,'2017-05-22 17:16:06',223.4,2),(14,1,11,1,'2017-05-22 17:16:40',58.6,1),(15,1,28,1,'2017-05-24 16:03:42',47.6,1),(16,1,28,1,'2017-05-25 14:28:17',607.85,1),(17,1,22,1,'2017-05-26 17:32:56',3500,0),(18,1,5,1,'2017-05-26 17:33:33',146.95,1);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_products`
--

DROP TABLE IF EXISTS `sales_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_sale` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quant` int(11) NOT NULL,
  `sale_price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sales_sales_products_fk_idx` (`id_sale`),
  KEY `id_product_sales_products_fk_idx` (`id_product`),
  KEY `id_company_sales_products_fk_idx` (`id_company`),
  CONSTRAINT `id_company_sales_products_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_product_sales_products_fk` FOREIGN KEY (`id_product`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_sales_sales_products_fk` FOREIGN KEY (`id_sale`) REFERENCES `sales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_products`
--

LOCK TABLES `sales_products` WRITE;
/*!40000 ALTER TABLE `sales_products` DISABLE KEYS */;
INSERT INTO `sales_products` VALUES (1,1,9,1,1,150.25),(2,1,9,2,2,58.6),(3,1,10,5,10,5.95),(6,1,13,5,8,5.95),(7,1,13,2,3,58.6),(8,1,14,2,1,58.6),(9,1,15,5,8,5.95),(10,1,16,6,1,590),(11,1,16,5,3,5.95),(12,1,17,7,1,3500),(13,1,18,5,5,5.95),(14,1,18,2,2,58.6);
/*!40000 ALTER TABLE `sales_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_company_users_fk_idx` (`id_company`),
  KEY `group_users_fk_idx` (`id_group`),
  CONSTRAINT `group_users_fk` FOREIGN KEY (`id_group`) REFERENCES `permission_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_company_users_fk` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'admin@empresa123.com.br','202cb962ac59075b964b07152d234b70',1),(5,2,'paulo@admin.com.br','202cb962ac59075b964b07152d234b70',5),(7,1,'teste@teste.com','e10adc3949ba59abbe56e057f20f883e',6),(8,1,'novodev@dev.com.br','202cb962ac59075b964b07152d234b70',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'contaazulnfe'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-26 17:34:24
