-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL DEFAULT '0',
  `order` int NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'Dashboard','icon-chart-bar','/',NULL,NULL,NULL),(2,0,2,'Admin','icon-server','',NULL,NULL,NULL),(3,2,3,'Users','icon-users','auth/users',NULL,NULL,NULL),(4,2,4,'Roles','icon-user','auth/roles',NULL,NULL,NULL),(5,2,5,'Permission','icon-ban','auth/permissions',NULL,NULL,NULL),(6,2,6,'Menu','icon-bars','auth/menu',NULL,NULL,NULL),(7,2,7,'Operation log','icon-history','auth/logs',NULL,NULL,NULL);
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_operation_log`
--

DROP TABLE IF EXISTS `admin_operation_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_operation_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_operation_log`
--

LOCK TABLES `admin_operation_log` WRITE;
/*!40000 ALTER TABLE `admin_operation_log` DISABLE KEYS */;
INSERT INTO `admin_operation_log` VALUES (1,1,'admin','GET','127.0.0.1','[]','2025-03-18 00:40:02','2025-03-18 00:40:02'),(2,1,'admin','GET','127.0.0.1','[]','2025-03-18 00:56:58','2025-03-18 00:56:58'),(3,1,'admin','GET','127.0.0.1','[]','2025-03-18 00:57:01','2025-03-18 00:57:01'),(4,1,'admin','GET','127.0.0.1','[]','2025-03-18 01:08:41','2025-03-18 01:08:41'),(5,1,'admin','GET','127.0.0.1','[]','2025-03-18 01:18:13','2025-03-18 01:18:13'),(6,1,'admin/auth/login','GET','127.0.0.1','[]','2025-03-18 01:18:46','2025-03-18 01:18:46'),(7,1,'admin','GET','127.0.0.1','[]','2025-03-18 01:19:20','2025-03-18 01:19:20'),(8,1,'admin','GET','127.0.0.1','[]','2025-03-18 01:30:21','2025-03-18 01:30:21'),(9,1,'admin','GET','127.0.0.1','[]','2025-03-18 01:37:49','2025-03-18 01:37:49'),(10,1,'admin/auth/roles','GET','127.0.0.1','[]','2025-03-18 01:39:37','2025-03-18 01:39:37'),(11,1,'admin/auth/permissions','GET','127.0.0.1','[]','2025-03-18 01:39:43','2025-03-18 01:39:43'),(12,1,'admin/auth/menu','GET','127.0.0.1','[]','2025-03-18 01:39:49','2025-03-18 01:39:49'),(13,1,'admin/auth/users','GET','127.0.0.1','[]','2025-03-18 01:40:15','2025-03-18 01:40:15'),(14,1,'admin','GET','127.0.0.1','[]','2025-03-18 01:40:19','2025-03-18 01:40:19'),(15,1,'admin','GET','127.0.0.1','[]','2025-03-18 01:54:59','2025-03-18 01:54:59'),(16,1,'admin','GET','127.0.0.1','[]','2025-03-18 20:55:18','2025-03-18 20:55:18'),(17,1,'admin','GET','127.0.0.1','[]','2025-03-18 20:55:59','2025-03-18 20:55:59'),(18,1,'admin/auth/menu','GET','127.0.0.1','[]','2025-03-18 20:56:54','2025-03-18 20:56:54'),(19,1,'admin/auth/permissions','GET','127.0.0.1','[]','2025-03-18 20:57:13','2025-03-18 20:57:13'),(20,1,'admin/auth/roles','GET','127.0.0.1','[]','2025-03-18 20:57:17','2025-03-18 20:57:17'),(21,1,'admin/auth/users','GET','127.0.0.1','[]','2025-03-18 20:57:23','2025-03-18 20:57:23'),(22,1,'admin','GET','127.0.0.1','[]','2025-03-18 20:57:31','2025-03-18 20:57:31'),(23,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:12:00','2025-03-18 21:12:00'),(24,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:12:07','2025-03-18 21:12:07'),(25,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:13:58','2025-03-18 21:13:58'),(26,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:15:33','2025-03-18 21:15:33'),(27,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:17:47','2025-03-18 21:17:47'),(28,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:17:51','2025-03-18 21:17:51'),(29,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:17:55','2025-03-18 21:17:55'),(30,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:27:31','2025-03-18 21:27:31'),(31,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:27:33','2025-03-18 21:27:33'),(32,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:27:38','2025-03-18 21:27:38'),(33,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:27:40','2025-03-18 21:27:40'),(34,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:27:43','2025-03-18 21:27:43'),(35,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:27:45','2025-03-18 21:27:45'),(36,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:27:54','2025-03-18 21:27:54'),(37,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:28:49','2025-03-18 21:28:49'),(38,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:28:52','2025-03-18 21:28:52'),(39,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:28:57','2025-03-18 21:28:57'),(40,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:00','2025-03-18 21:29:00'),(41,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:02','2025-03-18 21:29:02'),(42,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:03','2025-03-18 21:29:03'),(43,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:21','2025-03-18 21:29:21'),(44,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:23','2025-03-18 21:29:23'),(45,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:25','2025-03-18 21:29:25'),(46,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:27','2025-03-18 21:29:27'),(47,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:28','2025-03-18 21:29:28'),(48,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:29','2025-03-18 21:29:29'),(49,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:35','2025-03-18 21:29:35'),(50,1,'admin','GET','127.0.0.1','[]','2025-03-18 21:29:40','2025-03-18 21:29:40'),(51,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:00:59','2025-03-18 22:00:59'),(52,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:01:01','2025-03-18 22:01:01'),(53,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:01:06','2025-03-18 22:01:06'),(54,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:01:07','2025-03-18 22:01:07'),(55,1,'admin/auth/users','GET','127.0.0.1','[]','2025-03-18 22:01:10','2025-03-18 22:01:10'),(56,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:01:11','2025-03-18 22:01:11'),(57,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:01:12','2025-03-18 22:01:12'),(58,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:01:28','2025-03-18 22:01:28'),(59,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:01:30','2025-03-18 22:01:30'),(60,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:30:00','2025-03-18 22:30:00'),(61,1,'admin/auth/roles','GET','127.0.0.1','[]','2025-03-18 22:31:17','2025-03-18 22:31:17'),(62,1,'admin/auth/users','GET','127.0.0.1','[]','2025-03-18 22:31:18','2025-03-18 22:31:18'),(63,1,'admin/auth/menu','GET','127.0.0.1','[]','2025-03-18 22:31:22','2025-03-18 22:31:22'),(64,1,'admin/auth/users','GET','127.0.0.1','[]','2025-03-18 22:31:27','2025-03-18 22:31:27'),(65,1,'admin/auth/roles','GET','127.0.0.1','[]','2025-03-18 22:31:29','2025-03-18 22:31:29'),(66,1,'admin/auth/permissions','GET','127.0.0.1','[]','2025-03-18 22:31:38','2025-03-18 22:31:38'),(67,1,'admin/auth/menu','GET','127.0.0.1','[]','2025-03-18 22:31:39','2025-03-18 22:31:39'),(68,1,'admin/auth/users','GET','127.0.0.1','[]','2025-03-18 22:31:47','2025-03-18 22:31:47'),(69,1,'admin/auth/roles','GET','127.0.0.1','[]','2025-03-18 22:31:52','2025-03-18 22:31:52'),(70,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:54:29','2025-03-18 22:54:29'),(71,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:54:35','2025-03-18 22:54:35'),(72,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:55:22','2025-03-18 22:55:22'),(73,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:55:25','2025-03-18 22:55:25'),(74,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:59:34','2025-03-18 22:59:34'),(75,1,'admin','GET','127.0.0.1','[]','2025-03-18 22:59:36','2025-03-18 22:59:36'),(76,1,'admin','GET','127.0.0.1','[]','2025-03-18 23:44:39','2025-03-18 23:44:39'),(77,1,'admin/survey-data','GET','127.0.0.1','{\"office_id\":null}','2025-03-18 23:44:40','2025-03-18 23:44:40'),(78,1,'admin/survey-data','GET','127.0.0.1','{\"office_id\":\"1\"}','2025-03-18 23:44:42','2025-03-18 23:44:42'),(79,1,'admin/survey-data','GET','127.0.0.1','{\"office_id\":\"3\"}','2025-03-18 23:44:44','2025-03-18 23:44:44'),(80,1,'admin/survey-data','GET','127.0.0.1','{\"office_id\":\"1\"}','2025-03-18 23:47:22','2025-03-18 23:47:22'),(81,1,'admin/survey-data','GET','127.0.0.1','{\"office_id\":\"2\"}','2025-03-18 23:47:23','2025-03-18 23:47:23'),(82,1,'admin/survey-data','GET','127.0.0.1','{\"office_id\":\"3\"}','2025-03-18 23:47:25','2025-03-18 23:47:25'),(83,1,'admin/survey-data','GET','127.0.0.1','{\"office_id\":\"5\"}','2025-03-18 23:47:28','2025-03-18 23:47:28'),(84,1,'admin','GET','127.0.0.1','[]','2025-03-19 23:02:03','2025-03-19 23:02:03'),(85,1,'admin/survey-data','GET','127.0.0.1','{\"office_id\":null}','2025-03-19 23:02:05','2025-03-19 23:02:05'),(86,1,'admin/auth/setting','GET','127.0.0.1','[]','2025-03-19 23:02:14','2025-03-19 23:02:14'),(87,1,'admin','GET','127.0.0.1','[]','2025-03-19 23:02:21','2025-03-19 23:02:21'),(88,1,'admin','GET','127.0.0.1','[]','2025-03-19 23:02:24','2025-03-19 23:02:24'),(89,1,'admin/auth/users','GET','127.0.0.1','[]','2025-03-19 23:02:28','2025-03-19 23:02:28'),(90,1,'admin/auth/roles','GET','127.0.0.1','[]','2025-03-19 23:02:32','2025-03-19 23:02:32'),(91,1,'admin/auth/permissions','GET','127.0.0.1','[]','2025-03-19 23:02:34','2025-03-19 23:02:34'),(92,1,'admin/auth/menu','GET','127.0.0.1','[]','2025-03-19 23:02:35','2025-03-19 23:02:35'),(93,1,'admin/auth/permissions','GET','127.0.0.1','[]','2025-03-19 23:02:37','2025-03-19 23:02:37'),(94,1,'admin/surveys','GET','127.0.0.1','[]','2025-03-19 23:03:16','2025-03-19 23:03:16'),(95,1,'admin','GET','127.0.0.1','[]','2025-03-19 23:06:23','2025-03-19 23:06:23'),(96,1,'admin','GET','127.0.0.1','[]','2025-03-19 23:07:19','2025-03-19 23:07:19');
/*!40000 ALTER TABLE `admin_operation_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_permissions`
--

DROP TABLE IF EXISTS `admin_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`),
  UNIQUE KEY `admin_permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL);
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_menu`
--

DROP TABLE IF EXISTS `admin_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_role_menu` (
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_permissions`
--

DROP TABLE IF EXISTS `admin_role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_role_permissions` (
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_users`
--

DROP TABLE IF EXISTS `admin_role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_role_users` (
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`),
  UNIQUE KEY `admin_roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2025-03-18 00:39:22','2025-03-18 00:39:22');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user_permissions`
--

DROP TABLE IF EXISTS `admin_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_user_permissions` (
  `user_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$12$DzzwarL9G0I8tF7LYhurEe0rHQWJf2731Yo/qNDbLQpEf.VYd9Rj6','Administrator',NULL,NULL,'2025-03-18 00:39:22','2025-03-18 00:39:22');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2016_01_04_173148_create_admin_tables',1),(2,'2025_03_05_090338_create_sessions_table',1),(3,'2025_03_06_052812_create_offices_table',1),(4,'2025_03_13_025854_create_cache_table',1),(5,'2025_03_13_090453_create_services_table',1),(6,'2025_03_18_080843_survey',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offices`
--

LOCK TABLES `offices` WRITE;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` VALUES (1,'Office of the Registrar',NULL,NULL),(2,'Accounting Office',NULL,NULL),(3,'Human Resources',NULL,NULL),(4,'IT Department',NULL,NULL),(5,'Library Services',NULL,NULL);
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_office_id_foreign` (`office_id`),
  CONSTRAINT `services_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Enrollment Assistance',1,NULL,NULL),(2,'Transcript Request',1,NULL,NULL),(3,'Diploma Processing',1,NULL,NULL),(4,'Payment Processing',2,NULL,NULL),(5,'Tuition Fee Assessment',2,NULL,NULL),(6,'Refund Requests',2,NULL,NULL),(7,'Employee Benefits',3,NULL,NULL),(8,'Job Applications',3,NULL,NULL),(9,'Employee Training',3,NULL,NULL),(10,'IT Support',4,NULL,NULL),(11,'Email Assistance',4,NULL,NULL),(12,'Network Issues',4,NULL,NULL),(13,'Library Membership',5,NULL,NULL),(14,'Book Borrowing',5,NULL,NULL),(15,'Research Assistance',5,NULL,NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0wddZzC7JVVtF3S7h9XsH0iNapWVcg8rcXbk0mad',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOWZSMkxHNnJKY2lOQ1luWExGNnNIa0hIOE9iNWNBUFBYcjNyTmtQdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1742360251),('27BFx5hNrD8Elkr4u3foOnAYWPN0J3mkDAK7u1p5',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUM5V1RWSTdvWU1ua3J2VkNFZjNQV2VqTkRsQXV3anI0VUMzVjdqdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdXJ2ZXktZGF0YT9vZmZpY2VfaWQ9NSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1742370448),('5FrrXYYAvXNljUaXpOxu0vOI92XnTjJN0MDBPeMu',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidUh5WnVEakY1NDdQQkpyTDRwWkJhT2c2WjVBUXZQQUxKdkY2MGFkZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdXJ2ZXlzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1742454439);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `surveys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `age` int unsigned NOT NULL,
  `sex` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_visited` bigint unsigned NOT NULL,
  `service` bigint unsigned NOT NULL,
  `awareness` int NOT NULL DEFAULT '0',
  `visibility` int NOT NULL DEFAULT '0',
  `helpfulness` int NOT NULL DEFAULT '0',
  `SQD0` int NOT NULL DEFAULT '0',
  `SQD1` int NOT NULL DEFAULT '0',
  `SQD2` int NOT NULL DEFAULT '0',
  `SQD3` int NOT NULL DEFAULT '0',
  `SQD4` int NOT NULL DEFAULT '0',
  `SQD5` int NOT NULL DEFAULT '0',
  `SQD6` int NOT NULL DEFAULT '0',
  `SQD7` int NOT NULL DEFAULT '0',
  `SQD8` int NOT NULL DEFAULT '0',
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surveys_office_visited_foreign` (`office_visited`),
  KEY `surveys_service_foreign` (`service`),
  CONSTRAINT `surveys_office_visited_foreign` FOREIGN KEY (`office_visited`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `surveys_service_foreign` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,'Citizen','2025-03-14',23,'Male',1,1,2,0,0,5,4,4,5,5,5,4,4,4,NULL,'2025-03-18 00:38:25','2025-03-18 00:38:25'),(5,'citizen','2024-04-22',56,'Male',4,11,3,5,1,5,2,5,5,5,2,4,3,5,'Assumenda consequuntur voluptas quia fugiat.','2025-03-18 00:55:44','2025-03-18 00:55:44'),(6,'government','2024-11-29',57,'Female',3,7,3,2,3,2,2,5,5,4,2,3,2,3,'Ducimus cumque ut ipsam est officia natus.','2025-03-18 00:55:44','2025-03-18 00:55:44'),(7,'government','2023-10-30',33,'Female',5,15,3,2,1,1,5,1,1,1,5,5,4,5,'Saepe accusamus minima consequatur ea quia.','2025-03-18 00:55:44','2025-03-18 00:55:44'),(8,'government','2024-01-25',58,'Male',4,10,3,4,2,3,3,1,1,2,3,2,3,3,'Quia occaecati et dolorum quis.','2025-03-18 00:55:44','2025-03-18 00:55:44'),(9,'government','2024-02-12',21,'Male',2,4,2,4,4,4,4,1,4,1,5,1,4,4,'Rerum reiciendis consequatur unde voluptates maxime eaque vel.','2025-03-18 00:55:44','2025-03-18 00:55:44'),(10,'business','2024-01-10',38,'Female',4,11,1,3,4,2,4,5,4,4,4,5,2,1,'Totam inventore rerum voluptatum maxime illum sit.','2025-03-18 00:55:44','2025-03-18 00:55:44'),(11,'government','2024-06-20',33,'Female',1,2,2,1,1,5,1,3,5,3,4,1,1,5,NULL,'2025-03-18 00:55:44','2025-03-18 00:55:44'),(12,'government','2023-02-07',60,'Female',4,10,1,1,3,3,3,5,3,4,2,5,2,3,'Iste itaque incidunt minima quo et facere possimus.','2025-03-18 00:56:34','2025-03-18 00:56:34'),(13,'government','2024-12-29',23,'Male',5,14,4,0,0,1,2,4,5,1,1,4,2,1,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(14,'government','2023-01-24',20,'Male',3,8,3,4,1,3,5,5,1,1,5,2,5,5,'Consectetur et eos ut pariatur cumque possimus sit.','2025-03-18 00:56:34','2025-03-18 00:56:34'),(15,'business','2023-06-11',21,'Male',3,7,3,3,4,4,3,3,4,1,4,4,4,5,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(16,'government','2023-05-16',30,'Female',1,3,3,5,2,4,4,5,1,4,4,3,3,5,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(17,'government','2023-12-23',26,'Female',4,11,1,1,4,2,1,1,2,2,2,5,2,4,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(18,'government','2024-10-07',56,'Male',2,6,2,1,4,2,4,1,1,5,5,4,5,2,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(19,'business','2023-06-06',48,'Male',3,9,1,4,3,2,1,2,2,1,3,5,5,1,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(20,'business','2023-08-30',28,'Female',3,9,4,0,0,3,1,1,1,2,2,4,3,4,'Mollitia est ratione veritatis aperiam voluptas et saepe.','2025-03-18 00:56:34','2025-03-18 00:56:34'),(21,'business','2024-07-21',24,'Female',3,7,2,1,3,5,4,5,3,4,4,1,3,5,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(22,'business','2023-06-27',26,'Male',1,1,4,0,0,5,3,3,2,3,3,2,5,5,'Repudiandae possimus eos id qui.','2025-03-18 00:56:34','2025-03-18 00:56:34'),(23,'business','2024-08-25',60,'Female',3,8,3,1,1,5,1,2,4,2,2,3,5,5,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(24,'government','2023-06-15',52,'Female',5,13,1,5,3,3,1,1,1,5,1,4,2,3,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(25,'citizen','2024-11-14',26,'Female',2,4,1,4,3,2,2,2,2,5,5,5,4,1,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(26,'business','2023-03-09',35,'Male',3,9,4,0,0,2,4,4,2,1,4,2,1,1,NULL,'2025-03-18 00:56:34','2025-03-18 00:56:34'),(27,'Business','2025-03-18',12,'Male',1,1,2,0,0,4,4,4,5,5,5,5,5,5,NULL,'2025-03-18 01:18:00','2025-03-18 01:18:00'),(28,'Citizen','2025-03-18',24,'Male',1,1,1,0,0,5,5,5,5,5,5,5,5,5,NULL,'2025-03-18 01:19:15','2025-03-18 01:19:15'),(29,'Business','2025-03-19',25,'Male',1,1,4,0,0,1,1,1,1,1,1,1,1,1,NULL,'2025-03-18 20:54:00','2025-03-18 20:54:00'),(30,'Citizen','2025-03-29',25,'Male',1,1,4,0,0,5,5,5,5,5,5,5,5,5,NULL,'2025-03-18 20:55:55','2025-03-18 20:55:55');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-20 15:09:39
