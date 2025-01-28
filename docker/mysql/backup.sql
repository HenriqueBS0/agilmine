-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: agilmine
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `configuracoes`
--

DROP TABLE IF EXISTS `configuracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `configuracoes_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracoes`
--

LOCK TABLES `configuracoes` WRITE;
/*!40000 ALTER TABLE `configuracoes` DISABLE KEYS */;
INSERT INTO `configuracoes` VALUES (1,'redmine_api_url','http://redmine:3000','2025-01-27 14:18:59','2025-01-27 14:19:00'),(2,'redmine_api_key_adm','701418bde932b0b4bbe560ccdf09eb2e33476ff6','2025-01-27 14:19:00','2025-01-27 14:19:00');
/*!40000 ALTER TABLE `configuracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membro_regras`
--

DROP TABLE IF EXISTS `membro_regras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membro_regras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `membro` bigint unsigned NOT NULL,
  `regra` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membro_regras_membro_foreign` (`membro`),
  CONSTRAINT `membro_regras_membro_foreign` FOREIGN KEY (`membro`) REFERENCES `projeto_membros` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membro_regras`
--

LOCK TABLES `membro_regras` WRITE;
/*!40000 ALTER TABLE `membro_regras` DISABLE KEYS */;
INSERT INTO `membro_regras` VALUES (1,1,4,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(2,2,3,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(3,3,3,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(4,4,3,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(5,5,3,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(6,6,4,'2025-01-27 14:19:08','2025-01-27 14:19:08');
/*!40000 ALTER TABLE `membro_regras` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_10_24_140518_cria_tabela_sprints',1),(6,'2024_12_21_150625_adiciona_coluna_admin_para_tabela_usuario',1),(7,'2024_12_22_211301_add_coluna_habilitado_tabela_usuarios',1),(8,'2024_12_23_031357_habilita_admin_rodrigo_curvelo',1),(9,'2024_12_24_193453_criar_configuracoes_table',1),(10,'2024_12_24_194258_inserir_configuracoes_padrao',1),(11,'2024_12_24_224619_add_key_redmine_tabela_usuario',1),(12,'2024_12_25_004502_criar_tabela_projetos',1),(13,'2024_12_25_030405_criar_projeto_membros_table',1),(14,'2024_12_25_030543_criar_membro_regras_table',1),(15,'2024_12_25_050845_add_coluna_id_usuario_redmine_tabela_user',1),(16,'2024_12_26_151239_add_coluna_tarefas_tabela_projetos',1),(17,'2024_12_28_044704_cria_tabela_configuracoes_projeto',1),(18,'2024_12_28_093135_add_colunas_versao_resumo_relase_tabela_sprints',1),(19,'2024_12_29_175905_add_coluna_cancelada_tabela_sprint',1),(20,'2024_12_31_161914_cria_tabela_sprint_eventos',1),(21,'2025_01_03_132125_cria_key_adm_tabela_configuracoes',1),(22,'2025_01_16_070425_habilita_admin_felipe',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projeto_configuracoes`
--

DROP TABLE IF EXISTS `projeto_configuracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projeto_configuracoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `projeto_id` int unsigned NOT NULL,
  `metrica_usuario` tinyint(1) NOT NULL DEFAULT '1',
  `metrica_horas` tinyint(1) NOT NULL DEFAULT '1',
  `metrica_story_points` tinyint(1) NOT NULL DEFAULT '1',
  `cor_sprint_andamento` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#6711f2',
  `cor_sprint_atrasada` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFAE00',
  `cor_sprint_concluida` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#18FB4C',
  `cor_sprint_cancelada` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#18FBE8',
  `cor_release_andamento` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#6711f2',
  `cor_release_atrasada` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFAE00',
  `cor_release_concluida` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#18FB4C',
  `cor_release_cancelada` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#18FBE8',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projeto_configuracoes_projeto_id_foreign` (`projeto_id`),
  CONSTRAINT `projeto_configuracoes_projeto_id_foreign` FOREIGN KEY (`projeto_id`) REFERENCES `projetos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projeto_configuracoes`
--

LOCK TABLES `projeto_configuracoes` WRITE;
/*!40000 ALTER TABLE `projeto_configuracoes` DISABLE KEYS */;
INSERT INTO `projeto_configuracoes` VALUES (1,3,1,1,1,'#6711f2','#FFAE00','#18FB4C','#18FBE8','#6711f2','#FFAE00','#18FB4C','#18FBE8','2025-01-27 14:19:07','2025-01-27 14:19:07');
/*!40000 ALTER TABLE `projeto_configuracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projeto_membros`
--

DROP TABLE IF EXISTS `projeto_membros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projeto_membros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projeto_id` int unsigned NOT NULL,
  `membro` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projeto_membros_projeto_id_foreign` (`projeto_id`),
  CONSTRAINT `projeto_membros_projeto_id_foreign` FOREIGN KEY (`projeto_id`) REFERENCES `projetos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projeto_membros`
--

LOCK TABLES `projeto_membros` WRITE;
/*!40000 ALTER TABLE `projeto_membros` DISABLE KEYS */;
INSERT INTO `projeto_membros` VALUES (1,'Rodrigo Ramos',3,5,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(2,'Bruno Silva',3,8,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(3,'Henrique Borges dos Santos',3,6,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(4,'Pedro Pereira',3,9,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(5,'Alberto Carvalho',3,7,'2025-01-27 14:19:07','2025-01-27 14:19:07'),(6,'Redmine Admin',3,1,'2025-01-27 14:19:07','2025-01-27 14:19:07');
/*!40000 ALTER TABLE `projeto_membros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projetos` (
  `id` int unsigned NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `arquivado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tarefas` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` VALUES (3,'EcoTrack Solutions','O EcoTrack Solutions é uma plataforma inovadora focada no monitoramento e gestão de iniciativas ambientais e projetos de sustentabilidade. O sistema permite que organizações rastreiem indicadores ambientais, como emissões de carbono, consumo de energia e gestão de resíduos, enquanto promovem ações sustentáveis e avaliam o impacto de suas operações. Com ferramentas para análise de dados e relatórios detalhados, o EcoTrack Solutions ajuda empresas e ONGs a atingirem metas de sustentabilidade e contribuírem para um futuro mais verde.',0,'2025-01-27 14:19:07','2025-01-27 15:04:08','[33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54]');
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sprint_eventos`
--

DROP TABLE IF EXISTS `sprint_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sprint_eventos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID único do evento',
  `sprint_id` bigint unsigned NOT NULL,
  `tipo` tinyint unsigned NOT NULL COMMENT 'Tipo do evento (baseado no enum EventoTipo)',
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição do evento',
  `participantes` json NOT NULL COMMENT 'IDs dos membros participantes',
  `data_hora` datetime NOT NULL COMMENT 'Data e hora do evento',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sprint_eventos_sprint_id_foreign` (`sprint_id`),
  CONSTRAINT `sprint_eventos_sprint_id_foreign` FOREIGN KEY (`sprint_id`) REFERENCES `sprints` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sprint_eventos`
--

LOCK TABLES `sprint_eventos` WRITE;
/*!40000 ALTER TABLE `sprint_eventos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sprint_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sprints`
--

DROP TABLE IF EXISTS `sprints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sprints` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID único da sprint',
  `project_id` smallint unsigned NOT NULL COMMENT 'ID do projeto ao qual a sprint pertence',
  `serial` smallint unsigned NOT NULL COMMENT 'Código da sprint dentro do projeto',
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome',
  `resumo` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Resumo/Descrição',
  `data_inicio` date NOT NULL COMMENT 'Data de Inicio da Sprint',
  `data_fim` date NOT NULL COMMENT 'Data de Fim da Sprint',
  `versao` int unsigned DEFAULT NULL COMMENT 'ID da versão associada no Redmine',
  `gera_release` tinyint(1) NOT NULL COMMENT 'Se a sprint gera release',
  `resumo_release` text COLLATE utf8mb4_unicode_ci COMMENT 'Resumo da release gerada pela sprint',
  `tarefas` json NOT NULL DEFAULT (json_array()) COMMENT 'Id''s das tarefas da sprint',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cancelada` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_sprint_serial_por_projeto` (`project_id`,`serial`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sprints`
--

LOCK TABLES `sprints` WRITE;
/*!40000 ALTER TABLE `sprints` DISABLE KEYS */;
INSERT INTO `sprints` VALUES (1,3,1,'Outubro','A primeira sprint focou na estruturação inicial do EcoTrack Solutions, priorizando a criação de funcionalidades básicas para o monitoramento de indicadores ambientais e a configuração de relatórios de emissões de carbono. A equipe também implementou o sistema de autenticação de usuários e configurou os papéis iniciais (Admin, Projeto Manager, ScrumMaster, etc.).','2024-10-01','2024-10-31',2,0,NULL,'[33, 35, 34, 36, 37, 38]','2025-01-27 14:59:10','2025-01-27 15:01:38',0),(2,3,2,'Novembro','Durante essa sprint, o foco foi no desenvolvimento de funcionalidades avançadas de análise, incluindo relatórios detalhados de consumo de energia e gestão de resíduos. Além disso, foi implementado o painel administrativo para gerenciamento de permissões de usuários, integrando dados com ferramentas externas para importação automática de indicadores ambientais.','2024-11-01','2024-11-30',2,1,'A release expandiu significativamente as capacidades do EcoTrack Solutions, com ferramentas que permitem o rastreamento completo de consumo energético e resíduos, aumentando a relevância da plataforma para clientes com metas mais detalhadas de sustentabilidade.','[39, 40, 41, 42, 43, 44, 45]','2025-01-27 15:00:14','2025-01-27 15:02:09',0),(3,3,3,'Dezembro','O objetivo principal desta sprint foi otimizar o sistema com ferramentas de visualização de dados e métricas em dashboards interativos. Adicionalmente, foram implementados alertas personalizados que notificam os usuários sobre metas não alcançadas. A equipe também ajustou a escalabilidade do sistema para atender organizações maiores.','2024-12-01','2024-12-31',3,1,'Com essa release, os usuários agora têm acesso a dashboards dinâmicos e alertas automatizados, permitindo uma visão detalhada e interativa do progresso em iniciativas ambientais. A performance do sistema foi otimizada, garantindo suporte a organizações de grande porte.','[46, 47, 48, 49, 50, 51]','2025-01-27 15:01:11','2025-01-27 15:03:00',0);
/*!40000 ALTER TABLE `sprints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `habilitado` tinyint(1) NOT NULL DEFAULT '0',
  `key_redmine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_usuario_redmine` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@email.com',NULL,'$2y$12$9NOduikKZ0tGbTQVJxuNk.iJ2gGJ7qq0gqfQwMekrdSgrftx4npKm',NULL,'2025-01-27 14:19:00','2025-01-27 14:19:08',1,1,'701418bde932b0b4bbe560ccdf09eb2e33476ff6',1);
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

-- Dump completed on 2025-01-27 22:32:00
