-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: grao-co
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `plans_id` int(11) DEFAULT NULL,
  `usersCategories_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_plans_idx` (`plans_id`),
  KEY `fk_users_usersCategories1_idx` (`usersCategories_id`),
  CONSTRAINT `fk_users_plans` FOREIGN KEY (`plans_id`) REFERENCES `plans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_usersCategories1` FOREIGN KEY (`usersCategories_id`) REFERENCES `userscategories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'antonio','antonio@gmail.com','$2y$10$krR4vgPvx9/yEbNg4/0CQOt66ScO4OuxnRL46oRUYcbWyB4ihEXWa','uploads/images/2024/11/ddcb5eccaf70c24593147416ab3af3c2672df679451e0.png',NULL,1),(6,'admin','admin@gmail.com','$2y$10$ABy4MVGLC53iWa4f2KCDO.kUBeUEa3KLtj7Zx2BmFsKUtceIusd6y',NULL,NULL,2),(7,'usuario','usuario@gmail.com','$2y$10$A34ZKy3ygZVJy9Yuucbp2ujPPudTPNKfP6fidqSrzkxxcQqQAe/Gu',NULL,NULL,1),(8,'Jhonatan','jhonatan@gmail.com','$2y$10$69A0XxUm46h398QUZPJh/esv9BJc//Fy.369yFOHhIVAGIRh9XSZC',NULL,NULL,1),(9,'usuario','usuario2@gmail.com','$2y$10$QL.G0VDIwSVmpJdZS2z8Huo/8Je7aTxDn2yt.8UZg1uoz6L82YfUq',NULL,NULL,1),(10,'cleito rasta','cleito@gmail.com','$2y$10$HsS/BG37Ne.JyrcMlb4R/eio7/bPkenFzLK9V0DLTXAm3rUz0.EkO',NULL,NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-11  8:21:31
