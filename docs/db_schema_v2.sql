-- MySQL dump 10.13  Distrib 5.5.17, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: students
-- ------------------------------------------------------
-- Server version	5.5.17-4ubuntu6

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
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `course_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Име на курса (Пример: Първи курс, Информатика задочно)',
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `course_name_unique` (`course_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Таблица съдържаща информация за курсовете';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (2,'Втори курс'),(1,'Първи курс'),(3,'Трети курс'),(4,'Четвърти курс');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialities`
--

DROP TABLE IF EXISTS `specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialities` (
  `speciality_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `speciality_name_long` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Име на специалността (пълно)',
  `speciality_name_short` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Име на специалността (кратко)',
  PRIMARY KEY (`speciality_id`),
  UNIQUE KEY `speciality_name_long_UNIQUE` (`speciality_name_long`),
  UNIQUE KEY `speciality_name_short_UNIQUE` (`speciality_name_short`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Таблица с основна информация за специалностите. Всеки курс м';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialities`
--

LOCK TABLES `specialities` WRITE;
/*!40000 ALTER TABLE `specialities` DISABLE KEYS */;
INSERT INTO `specialities` VALUES (1,'Информатика','И'),(2,'Бизнес Информационни Технологии','БИТ'),(3,'Математика','М');
/*!40000 ALTER TABLE `specialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_course_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ИД на курса, в който е записан студента',
  `student_speciality_id` int(10) unsigned NOT NULL DEFAULT '0',
  `student_fname` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Собствено име на студента',
  `student_lname` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Фамилия на студента',
  `student_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'E-mail адрес на студента',
  `student_fnumber` int(10) unsigned zerofill DEFAULT '0000000000' COMMENT 'Факултетен номер на студента',
  `student_education_form` enum('Р','З','') COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `student_email_UNIQUE` (`student_email`),
  UNIQUE KEY `student_name_fn_UNIQUE` (`student_fname`,`student_lname`,`student_fnumber`),
  KEY `student_course_id` (`student_course_id`),
  KEY `student_speciality_id` (`student_speciality_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Таблица с основни данни за студентите';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,4,2,'Атанаска','Тодорова','student_1@fmi.uni-plovdiv.bg',0964099111,'З'),(2,1,3,'Десислава','Тодорова','student_2@fmi.uni-plovdiv.bg',1001959219,'Р'),(3,3,1,'Грета','Ангелова','student_3@fmi.uni-plovdiv.bg',1035693350,'З'),(4,3,2,'Десислава','Георгиева','student_4@fmi.uni-plovdiv.bg',1031219473,'Р'),(5,3,3,'Димитринка','Димитрова','student_5@fmi.uni-plovdiv.bg',0941564931,'З'),(6,3,1,'Ивайло','Стоименов','student_6@fmi.uni-plovdiv.bg',1024053945,'Р'),(7,3,2,'Атанаска','Йорданова','student_7@fmi.uni-plovdiv.bg',1001245107,'З'),(8,3,3,'Петър','Ангелов','student_8@fmi.uni-plovdiv.bg',0940618886,'Р'),(9,2,1,'Ангел','Цветков','student_9@fmi.uni-plovdiv.bg',1028015127,'З'),(10,2,2,'Атанаска','Георгиева','student_10@fmi.uni-plovdiv.bg',1109820547,'Р'),(11,1,3,'Атанаска','Петрова','student_11@fmi.uni-plovdiv.bg',0978906240,'З'),(12,2,1,'Димитринка','Тодорова','student_12@fmi.uni-plovdiv.bg',1079315176,'Р'),(13,1,2,'Стоян','Симеонов','student_13@fmi.uni-plovdiv.bg',1004699697,'З'),(14,3,3,'Зоя','Георгиева','student_14@fmi.uni-plovdiv.bg',1065509024,'Р'),(15,2,1,'Ангел','Петров','student_15@fmi.uni-plovdiv.bg',1099926748,'З'),(16,3,2,'Георги','Симеонов','student_16@fmi.uni-plovdiv.bg',1003558340,'Р'),(17,2,3,'Ивета','Георгиева','student_17@fmi.uni-plovdiv.bg',0952868642,'З'),(18,1,1,'Атанас','Георгиев','student_18@fmi.uni-plovdiv.bg',0997369375,'Р'),(19,3,2,'Зоя','Стоянова','student_19@fmi.uni-plovdiv.bg',0995556631,'З'),(20,3,3,'Кремена','Йорданова','student_20@fmi.uni-plovdiv.bg',0969598379,'Р'),(21,2,1,'Зоя','Василева','student_21@fmi.uni-plovdiv.bg',1053771963,'З'),(22,3,2,'Иван','Иванов','student_22@fmi.uni-plovdiv.bg',0911651601,'Р'),(23,4,3,'Стоян','Йорданов','student_23@fmi.uni-plovdiv.bg',0997045889,'З'),(24,2,1,'Стоян','Цветков','student_24@fmi.uni-plovdiv.bg',0933685293,'Р'),(25,2,2,'Атанаска','Василева','student_25@fmi.uni-plovdiv.bg',0988659658,'З'),(26,4,3,'Десислава','Василева','student_26@fmi.uni-plovdiv.bg',0914605703,'Р'),(27,1,1,'Иван','Ангелов','student_27@fmi.uni-plovdiv.bg',0935644521,'З'),(28,3,2,'Ангел','Симеонов','student_28@fmi.uni-plovdiv.bg',0952069082,'Р'),(29,1,3,'Камелия','Стоянова','student_29@fmi.uni-plovdiv.bg',0938781728,'З'),(30,3,1,'Камелия','Христова','student_30@fmi.uni-plovdiv.bg',1012481680,'Р'),(31,3,2,'Мария','Павлова','student_31@fmi.uni-plovdiv.bg',0942602529,'З'),(32,2,3,'Ивайло','Георгиев','student_32@fmi.uni-plovdiv.bg',0980999746,'Р'),(33,1,1,'Петър','Тодоров','student_33@fmi.uni-plovdiv.bg',0985388174,'З'),(34,1,2,'Грета','Христова','student_34@fmi.uni-plovdiv.bg',0911529531,'Р'),(35,3,3,'Иванка','Димитрова','student_35@fmi.uni-plovdiv.bg',1049169912,'З'),(36,4,1,'Стефан','Георгиев','student_36@fmi.uni-plovdiv.bg',1076727285,'Р'),(37,4,2,'Христо','Димитров','student_37@fmi.uni-plovdiv.bg',1109728995,'З'),(38,4,3,'Иван','Иванов','student_38@fmi.uni-plovdiv.bg',1017999258,'Р'),(39,3,1,'Иванка','Стоянова','student_39@fmi.uni-plovdiv.bg',0986596670,'З'),(40,1,2,'Иванка','Йорданова','student_40@fmi.uni-plovdiv.bg',0995501699,'Р'),(41,3,3,'Десислава','Георгиева','student_41@fmi.uni-plovdiv.bg',0993054189,'З'),(42,1,1,'Ивайло','Димитров','student_42@fmi.uni-plovdiv.bg',1038140860,'Р'),(43,2,2,'Атанаска','Георгиева','student_43@fmi.uni-plovdiv.bg',0986132803,'З'),(44,3,3,'Ивайло','Тодоров','student_44@fmi.uni-plovdiv.bg',0993572988,'Р'),(45,3,1,'Георги','Симеонов','student_45@fmi.uni-plovdiv.bg',1016613760,'З'),(46,3,2,'Петър','Димитров','student_46@fmi.uni-plovdiv.bg',0978204336,'Р'),(47,2,3,'Георги','Георгиев','student_47@fmi.uni-plovdiv.bg',0979028310,'З'),(48,3,1,'Стоян','Тодоров','student_48@fmi.uni-plovdiv.bg',1027191152,'Р'),(49,3,2,'Димитър','Димитров','student_49@fmi.uni-plovdiv.bg',1061657705,'З'),(50,1,3,'Петър','Стоименов','student_50@fmi.uni-plovdiv.bg',0944439687,'Р'),(51,2,1,'Кремена','Стоянова','student_51@fmi.uni-plovdiv.bg',0996533193,'З'),(52,1,2,'Пламен','Петров','student_52@fmi.uni-plovdiv.bg',0952606191,'Р'),(53,1,3,'Георги','Ангелов','student_53@fmi.uni-plovdiv.bg',1109436026,'З'),(54,3,1,'Атанас','Иванов','student_54@fmi.uni-plovdiv.bg',0943096914,'Р'),(55,4,2,'Грета','Георгиева','student_55@fmi.uni-plovdiv.bg',0969897451,'З'),(56,4,3,'Христо','Симеонов','student_56@fmi.uni-plovdiv.bg',0926068105,'Р'),(57,1,1,'Камелия','Стоянова','student_57@fmi.uni-plovdiv.bg',1041198721,'З'),(58,2,2,'Десислава','Ангелова','student_58@fmi.uni-plovdiv.bg',1080426016,'Р'),(59,2,3,'Димитринка','Стефанова','student_59@fmi.uni-plovdiv.bg',0930371084,'З'),(60,2,1,'Кремена','Ангелова','student_60@fmi.uni-plovdiv.bg',1003826894,'Р'),(61,3,2,'Иванка','Йорданова','student_61@fmi.uni-plovdiv.bg',1038195791,'З'),(62,1,3,'Ивайло','Иванов','student_62@fmi.uni-plovdiv.bg',0962676992,'Р'),(63,4,1,'Атанас','Симеонов','student_63@fmi.uni-plovdiv.bg',1009204092,'З'),(64,4,2,'Атанаска','Стоянова','student_64@fmi.uni-plovdiv.bg',0942132558,'Р'),(65,4,3,'Ангел','Димитров','student_65@fmi.uni-plovdiv.bg',0981677236,'З'),(66,1,1,'Ивайло','Георгиев','student_66@fmi.uni-plovdiv.bg',1096099844,'Р'),(67,2,2,'Атанаска','Ангелова','student_67@fmi.uni-plovdiv.bg',1037646475,'З'),(68,4,3,'Атанас','Ангелов','student_68@fmi.uni-plovdiv.bg',0997235098,'Р'),(69,4,1,'Грета','Петрова','student_69@fmi.uni-plovdiv.bg',1052893057,'З'),(70,3,2,'Ивайло','Иванов','student_70@fmi.uni-plovdiv.bg',1086944571,'Р'),(71,4,3,'Ангел','Цветков','student_71@fmi.uni-plovdiv.bg',0946948232,'З'),(72,1,1,'Христо','Стефанов','student_72@fmi.uni-plovdiv.bg',0925384511,'Р'),(73,1,2,'Десислава','Димитрова','student_73@fmi.uni-plovdiv.bg',0933093252,'З'),(74,2,3,'Стефан','Стоименов','student_74@fmi.uni-plovdiv.bg',1041461172,'Р'),(75,3,1,'Кремена','Тодорова','student_75@fmi.uni-plovdiv.bg',0968359365,'З'),(76,3,2,'Иванка','Георгиева','student_76@fmi.uni-plovdiv.bg',0982830801,'Р'),(77,4,3,'Пламен','Петров','student_77@fmi.uni-plovdiv.bg',1003527822,'З'),(78,1,1,'Димитър','Симеонов','student_78@fmi.uni-plovdiv.bg',0965899648,'Р'),(79,3,2,'Стоян','Стефанов','student_79@fmi.uni-plovdiv.bg',1033129873,'З'),(80,1,3,'Ангел','Йорданов','student_80@fmi.uni-plovdiv.bg',0925823964,'Р'),(81,3,1,'Ангел','Цветков','student_81@fmi.uni-plovdiv.bg',0945446767,'З'),(82,4,2,'Георги','Иванов','student_82@fmi.uni-plovdiv.bg',0966510000,'Р'),(83,2,3,'Ангел','Димитров','student_83@fmi.uni-plovdiv.bg',0972509756,'З'),(84,2,1,'Детелина','Стоянова','student_84@fmi.uni-plovdiv.bg',1010614004,'Р'),(85,3,2,'Кремена','Димитрова','student_85@fmi.uni-plovdiv.bg',0940100088,'З'),(86,1,3,'Ангел','Иванов','student_86@fmi.uni-plovdiv.bg',1049542227,'Р'),(87,1,1,'Камелия','Тодорова','student_87@fmi.uni-plovdiv.bg',0917749013,'З'),(88,2,2,'Камелия','Стоянова','student_88@fmi.uni-plovdiv.bg',0993450918,'Р'),(89,1,3,'Пламен','Йорданов','student_89@fmi.uni-plovdiv.bg',1068737783,'З'),(90,2,1,'Стоян','Ангелов','student_90@fmi.uni-plovdiv.bg',0921246328,'Р'),(91,4,2,'Иван','Стоименов','student_91@fmi.uni-plovdiv.bg',1100097647,'З'),(92,3,3,'Кремена','Димитрова','student_92@fmi.uni-plovdiv.bg',0930584707,'Р'),(93,4,1,'Камелия','Стоянова','student_93@fmi.uni-plovdiv.bg',0912609853,'З'),(94,4,2,'Димитринка','Йорданова','student_94@fmi.uni-plovdiv.bg',0987872305,'Р'),(95,1,3,'Грета','Георгиева','student_95@fmi.uni-plovdiv.bg',1050805654,'З'),(96,4,1,'Кремена','Петрова','student_96@fmi.uni-plovdiv.bg',0978265371,'Р'),(97,3,2,'Ангел','Йорданов','student_97@fmi.uni-plovdiv.bg',0952966299,'З'),(98,3,3,'Иван','Георгиев','student_98@fmi.uni-plovdiv.bg',0955670156,'Р'),(99,1,1,'Иван','Ангелов','student_99@fmi.uni-plovdiv.bg',1001123037,'З'),(100,1,2,'Мария','Христова','student_100@fmi.uni-plovdiv.bg',0992742910,'Р'),(101,1,3,'Атанас','Димитров','student_101@fmi.uni-plovdiv.bg',0971057119,'З'),(102,4,1,'Зоя','Христова','student_102@fmi.uni-plovdiv.bg',1030889883,'Р'),(103,1,2,'Димитър','Цветков','student_103@fmi.uni-plovdiv.bg',1082299795,'З'),(104,3,3,'Камелия','Георгиева','student_104@fmi.uni-plovdiv.bg',0930267324,'Р'),(105,3,1,'Кремена','Йорданова','student_105@fmi.uni-plovdiv.bg',1048132315,'З'),(106,2,2,'Стефан','Стоименов','student_106@fmi.uni-plovdiv.bg',0919781484,'Р'),(107,1,3,'Камелия','Георгиева','student_107@fmi.uni-plovdiv.bg',0925585927,'З'),(108,1,1,'Зоя','Йорданова','student_108@fmi.uni-plovdiv.bg',1047088613,'Р'),(109,2,2,'Иван','Цветков','student_109@fmi.uni-plovdiv.bg',0965441885,'З'),(110,3,3,'Христо','Йорданов','student_110@fmi.uni-plovdiv.bg',1028594961,'Р'),(111,1,1,'Иван','Стоименов','student_111@fmi.uni-plovdiv.bg',1062231436,'З'),(112,3,2,'Димитър','Йорданов','student_112@fmi.uni-plovdiv.bg',1099456778,'Р'),(113,4,3,'Димитър','Симеонов','student_113@fmi.uni-plovdiv.bg',1004235830,'З'),(114,2,1,'Ивета','Христова','student_114@fmi.uni-plovdiv.bg',1063580313,'Р'),(115,2,2,'Атанас','Тодоров','student_115@fmi.uni-plovdiv.bg',0923486318,'З'),(116,1,3,'Петър','Ангелов','student_116@fmi.uni-plovdiv.bg',0943621816,'Р'),(117,2,1,'Атанас','Йорданов','student_117@fmi.uni-plovdiv.bg',0945764150,'З'),(118,2,2,'Иван','Георгиев','student_118@fmi.uni-plovdiv.bg',1030987539,'Р'),(119,3,3,'Димитър','Цветков','student_119@fmi.uni-plovdiv.bg',1040600576,'З'),(120,1,1,'Петър','Димитров','student_120@fmi.uni-plovdiv.bg',0935833730,'Р');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_assessments`
--

DROP TABLE IF EXISTS `students_assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_assessments` (
  `sa_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sa_student_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ИД на студент',
  `sa_subject_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ИД на предмет',
  `sa_workload_lectures` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Действително посетени часове хорарим за лекции (от студента)',
  `sa_workload_exercises` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Действително посетени хорариум часове за упражнения (от студента)',
  `sa_assesment` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Оценка на студента за конкретната дисциплина',
  PRIMARY KEY (`sa_id`),
  UNIQUE KEY `sa_student_subject_UNIQUE` (`sa_student_id`,`sa_subject_id`),
  KEY `sa_student_id` (`sa_student_id`),
  KEY `sa_subject_id` (`sa_subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=361 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Таблица съдържаща информация за оценки на студент за конкрет';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_assessments`
--

LOCK TABLES `students_assessments` WRITE;
/*!40000 ALTER TABLE `students_assessments` DISABLE KEYS */;
INSERT INTO `students_assessments` VALUES (1,1,1,62,78,3),(2,1,2,53,106,2),(3,1,3,78,79,2),(4,2,1,57,89,4),(5,2,2,47,120,4),(6,2,3,72,69,6),(7,3,1,57,88,6),(8,3,2,56,108,4),(9,3,3,77,69,6),(10,4,1,55,81,5),(11,4,2,58,107,3),(12,4,3,65,79,6),(13,5,1,60,90,6),(14,5,2,60,117,5),(15,5,3,66,67,2),(16,6,1,60,79,6),(17,6,2,51,106,2),(18,6,3,72,78,3),(19,7,1,69,90,6),(20,7,2,45,111,3),(21,7,3,80,72,2),(22,8,1,63,80,6),(23,8,2,60,117,5),(24,8,3,65,77,6),(25,9,1,69,79,2),(26,9,2,53,119,3),(27,9,3,80,65,6),(28,10,1,59,80,5),(29,10,2,59,110,2),(30,10,3,66,73,6),(31,11,1,60,78,5),(32,11,2,60,109,3),(33,11,3,71,68,3),(34,12,1,68,83,4),(35,12,2,47,108,2),(36,12,3,74,68,2),(37,13,1,62,86,4),(38,13,2,48,117,6),(39,13,3,71,73,3),(40,14,1,64,79,4),(41,14,2,54,109,3),(42,14,3,74,80,2),(43,15,1,57,87,3),(44,15,2,51,117,3),(45,15,3,74,76,3),(46,16,1,67,88,4),(47,16,2,58,115,2),(48,16,3,77,79,4),(49,17,1,57,77,4),(50,17,2,50,110,6),(51,17,3,72,72,2),(52,18,1,67,85,2),(53,18,2,60,117,3),(54,18,3,65,76,4),(55,19,1,65,76,2),(56,19,2,52,106,5),(57,19,3,66,66,3),(58,20,1,59,76,4),(59,20,2,54,114,3),(60,20,3,68,69,6),(61,21,1,68,81,2),(62,21,2,53,111,5),(63,21,3,72,66,4),(64,22,1,70,84,2),(65,22,2,47,118,4),(66,22,3,78,75,4),(67,23,1,67,89,2),(68,23,2,47,120,6),(69,23,3,73,77,4),(70,24,1,59,75,4),(71,24,2,49,110,2),(72,24,3,76,77,3),(73,25,1,65,89,2),(74,25,2,56,116,5),(75,25,3,71,65,6),(76,26,1,69,83,4),(77,26,2,56,106,2),(78,26,3,70,71,2),(79,27,1,56,79,6),(80,27,2,47,118,4),(81,27,3,77,71,5),(82,28,1,66,80,2),(83,28,2,55,106,4),(84,28,3,75,65,3),(85,29,1,58,75,5),(86,29,2,52,109,3),(87,29,3,79,77,5),(88,30,1,55,88,6),(89,30,2,46,105,3),(90,30,3,78,68,6),(91,31,1,63,89,2),(92,31,2,59,117,6),(93,31,3,68,76,3),(94,32,1,68,77,6),(95,32,2,47,112,4),(96,32,3,76,68,2),(97,33,1,69,89,2),(98,33,2,58,114,6),(99,33,3,69,75,5),(100,34,1,60,90,3),(101,34,2,55,110,3),(102,34,3,76,74,6),(103,35,1,69,87,2),(104,35,2,47,110,3),(105,35,3,71,79,5),(106,36,1,58,82,6),(107,36,2,56,106,3),(108,36,3,69,66,5),(109,37,1,67,85,4),(110,37,2,58,111,5),(111,37,3,70,71,6),(112,38,1,56,80,5),(113,38,2,51,119,6),(114,38,3,68,74,4),(115,39,1,57,76,5),(116,39,2,58,106,5),(117,39,3,78,65,3),(118,40,1,63,85,6),(119,40,2,56,113,4),(120,40,3,74,68,5),(121,41,1,63,87,3),(122,41,2,51,117,4),(123,41,3,72,68,3),(124,42,1,65,85,4),(125,42,2,49,111,2),(126,42,3,66,71,6),(127,43,1,65,75,4),(128,43,2,48,106,2),(129,43,3,75,66,5),(130,44,1,62,75,3),(131,44,2,58,107,3),(132,44,3,69,77,4),(133,45,1,55,90,5),(134,45,2,57,120,6),(135,45,3,72,71,4),(136,46,1,65,76,6),(137,46,2,54,114,3),(138,46,3,66,77,4),(139,47,1,63,79,2),(140,47,2,59,114,3),(141,47,3,70,80,5),(142,48,1,68,79,4),(143,48,2,60,119,2),(144,48,3,75,75,4),(145,49,1,59,83,3),(146,49,2,56,119,4),(147,49,3,72,75,5),(148,50,1,69,82,6),(149,50,2,56,108,4),(150,50,3,77,68,5),(151,51,1,66,76,6),(152,51,2,49,106,2),(153,51,3,76,69,2),(154,52,1,56,86,3),(155,52,2,50,115,2),(156,52,3,66,74,6),(157,53,1,67,76,5),(158,53,2,45,117,2),(159,53,3,79,69,6),(160,54,1,63,88,5),(161,54,2,56,106,4),(162,54,3,70,71,4),(163,55,1,70,85,4),(164,55,2,51,105,3),(165,55,3,80,75,5),(166,56,1,62,79,2),(167,56,2,45,109,3),(168,56,3,70,80,5),(169,57,1,68,77,5),(170,57,2,51,113,6),(171,57,3,71,73,3),(172,58,1,60,75,6),(173,58,2,49,108,6),(174,58,3,71,69,5),(175,59,1,58,79,2),(176,59,2,57,120,3),(177,59,3,74,65,2),(178,60,1,60,84,2),(179,60,2,60,106,6),(180,60,3,74,76,6),(181,61,1,65,78,6),(182,61,2,46,117,6),(183,61,3,73,71,4),(184,62,1,62,90,6),(185,62,2,54,119,3),(186,62,3,77,70,5),(187,63,1,57,88,6),(188,63,2,58,114,2),(189,63,3,72,72,5),(190,64,1,70,82,6),(191,64,2,51,114,5),(192,64,3,78,72,4),(193,65,1,68,88,2),(194,65,2,56,106,3),(195,65,3,69,68,3),(196,66,1,58,81,2),(197,66,2,52,105,4),(198,66,3,75,69,5),(199,67,1,60,90,4),(200,67,2,57,106,3),(201,67,3,67,70,6),(202,68,1,60,86,4),(203,68,2,55,105,2),(204,68,3,67,75,3),(205,69,1,66,86,4),(206,69,2,54,114,5),(207,69,3,69,72,3),(208,70,1,66,90,6),(209,70,2,58,110,6),(210,70,3,66,72,4),(211,71,1,55,86,6),(212,71,2,54,118,6),(213,71,3,73,80,5),(214,72,1,59,83,4),(215,72,2,57,110,6),(216,72,3,72,68,3),(217,73,1,66,89,4),(218,73,2,49,118,4),(219,73,3,71,71,2),(220,74,1,69,77,5),(221,74,2,45,116,3),(222,74,3,73,74,4),(223,75,1,57,78,5),(224,75,2,53,119,4),(225,75,3,79,65,2),(226,76,1,59,80,3),(227,76,2,58,108,4),(228,76,3,74,69,6),(229,77,1,63,75,4),(230,77,2,51,118,5),(231,77,3,67,69,6),(232,78,1,70,75,6),(233,78,2,48,119,4),(234,78,3,78,74,5),(235,79,1,63,87,4),(236,79,2,51,115,2),(237,79,3,80,80,5),(238,80,1,67,76,5),(239,80,2,45,118,6),(240,80,3,69,76,6),(241,81,1,66,84,6),(242,81,2,57,107,6),(243,81,3,70,69,3),(244,82,1,63,85,6),(245,82,2,54,107,4),(246,82,3,79,68,3),(247,83,1,59,85,4),(248,83,2,51,108,4),(249,83,3,76,79,6),(250,84,1,60,76,4),(251,84,2,51,116,4),(252,84,3,71,65,2),(253,85,1,66,83,6),(254,85,2,52,115,2),(255,85,3,65,65,6),(256,86,1,56,83,6),(257,86,2,49,119,2),(258,86,3,75,72,5),(259,87,1,63,78,4),(260,87,2,51,111,6),(261,87,3,78,80,6),(262,88,1,59,82,5),(263,88,2,54,115,6),(264,88,3,70,76,3),(265,89,1,65,76,2),(266,89,2,53,111,6),(267,89,3,72,66,4),(268,90,1,55,90,4),(269,90,2,54,107,5),(270,90,3,65,74,2),(271,91,1,68,82,3),(272,91,2,60,108,4),(273,91,3,70,65,2),(274,92,1,58,90,2),(275,92,2,48,106,4),(276,92,3,78,77,2),(277,93,1,64,84,3),(278,93,2,47,106,6),(279,93,3,79,67,5),(280,94,1,58,86,2),(281,94,2,57,116,5),(282,94,3,68,79,6),(283,95,1,55,82,6),(284,95,2,47,110,6),(285,95,3,68,80,4),(286,96,1,60,87,2),(287,96,2,57,115,5),(288,96,3,65,66,3),(289,97,1,59,76,4),(290,97,2,56,109,5),(291,97,3,71,80,4),(292,98,1,68,76,5),(293,98,2,46,107,6),(294,98,3,72,65,4),(295,99,1,63,87,2),(296,99,2,47,114,5),(297,99,3,72,75,3),(298,100,1,66,84,4),(299,100,2,58,113,6),(300,100,3,65,76,3),(301,101,1,59,80,2),(302,101,2,57,120,4),(303,101,3,74,79,4),(304,102,1,66,88,2),(305,102,2,48,114,5),(306,102,3,69,75,4),(307,103,1,61,77,5),(308,103,2,54,110,4),(309,103,3,65,65,4),(310,104,1,57,86,3),(311,104,2,47,115,3),(312,104,3,77,79,3),(313,105,1,60,87,4),(314,105,2,45,115,3),(315,105,3,68,66,6),(316,106,1,70,83,2),(317,106,2,56,107,3),(318,106,3,71,75,2),(319,107,1,69,87,5),(320,107,2,45,118,6),(321,107,3,65,77,4),(322,108,1,68,86,6),(323,108,2,48,119,4),(324,108,3,79,76,2),(325,109,1,68,77,4),(326,109,2,48,113,6),(327,109,3,65,74,6),(328,110,1,68,83,2),(329,110,2,45,113,6),(330,110,3,74,69,3),(331,111,1,65,82,4),(332,111,2,51,115,3),(333,111,3,66,71,5),(334,112,1,67,84,6),(335,112,2,57,120,2),(336,112,3,72,74,3),(337,113,1,62,85,3),(338,113,2,58,108,6),(339,113,3,74,71,4),(340,114,1,59,90,5),(341,114,2,47,118,5),(342,114,3,77,72,3),(343,115,1,69,77,3),(344,115,2,45,115,2),(345,115,3,67,76,3),(346,116,1,59,77,5),(347,116,2,59,105,6),(348,116,3,74,78,2),(349,117,1,63,90,2),(350,117,2,51,105,4),(351,117,3,65,66,2),(352,118,1,61,87,5),(353,118,2,52,108,2),(354,118,3,75,75,2),(355,119,1,57,75,4),(356,119,2,52,112,3),(357,119,3,78,76,2),(358,120,1,65,87,6),(359,120,2,80,120,6),(360,120,3,80,80,6);
/*!40000 ALTER TABLE `students_assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `subject_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Име на предмет',
  `subject_workload_lectures` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Хорариум часове за лекции',
  `subject_workload_exercises` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Хорариум часове за упражнения',
  PRIMARY KEY (`subject_id`),
  UNIQUE KEY `subject_name_UNIQUE` (`subject_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Таблица съдържаща основни данни за учебните дисциплини';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'Математика',70,90),(2,'Информатика',60,120),(3,'Физика',80,80);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Потребителско име',
  `user_fname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Собствено име на потребителя',
  `user_lname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Фамиля на потребителя',
  `user_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'E-mail адрес на потребителя',
  `user_password` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SHA-1 hash на паролата',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Таблица съдържаща основна информация за потребителите в сист';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'arruor','Димитър','Ников','d.nikov@viscomp.bg','cabab33031b3c69b4fad90b5e0f6a935f54b33cc'),(2,'nask0','Атанас','Василев','a.vasilev@viscomp.bg','cabab33031b3c69b4fad90b5e0f6a935f54b33cc');
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

-- Dump completed on 2012-02-03 15:49:37
