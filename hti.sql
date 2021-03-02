/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `hti` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hti`;

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lkey` varchar(250) NOT NULL,
  `en` varchar(250) NOT NULL,
  `pl` varchar(250) DEFAULT NULL,
  `fr` varchar(250) DEFAULT NULL,
  `de` varchar(250) DEFAULT NULL,
  `es` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `delivered` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`lkey`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id`, `lkey`, `en`, `pl`, `fr`, `de`, `es`, `description`, `delivered`, `ip`) VALUES
	(1, 'msg_operation_ok', 'The operation was successful', 'Operacja powiodła się', NULL, NULL, NULL, NULL, '2019-03-14 18:47:04', 'localhost'),
	(2, 'menu_registration', 'Registration', 'Wpis', NULL, NULL, NULL, NULL, '2019-03-14 18:47:02', 'localhost'),
	(3, 'menu_list', 'List', 'Lista', NULL, NULL, NULL, NULL, '2019-03-14 18:47:52', 'localhost'),
	(4, 'menu_results', 'Results', 'Wyniki', NULL, NULL, NULL, NULL, '2019-03-14 18:48:39', 'localhost'),
	(5, 'menu_profile', 'Profile', 'Profil', NULL, NULL, NULL, NULL, '2019-03-14 18:49:51', 'localhost'),
	(6, 'txt_messages', 'Messages', 'Komunikaty', NULL, NULL, NULL, NULL, '2019-03-14 19:06:56', 'localhost'),
	(7, 'txt_patient', 'Patient', 'Pacjent', NULL, NULL, NULL, NULL, '2019-03-14 19:15:55', 'localhost'),
	(8, 'txt_firstname', 'First name', 'Imię', NULL, NULL, NULL, NULL, '2019-03-14 20:47:17', 'localhost'),
	(9, 'txt_lastname', 'Last name', 'Nazwisko', NULL, NULL, NULL, NULL, '2019-03-14 20:47:55', 'localhost'),
	(10, 'txt_nickname', 'Nick name', 'Przydomek', NULL, NULL, NULL, NULL, '2019-03-14 20:51:17', 'localhost'),
	(11, 'txt_birth_date', 'Date of birth', 'Data urodzenia', NULL, NULL, NULL, NULL, '2019-03-14 21:01:39', 'localhost'),
	(12, 'txt_citizenship', 'Citizenship', 'Obywatelstwo', NULL, NULL, NULL, NULL, '2019-03-14 21:04:12', 'localhost'),
	(13, 'txt_rank', 'Rank', 'Stopień', NULL, NULL, NULL, NULL, '2019-03-14 21:05:19', 'localhost'),
	(14, 'txt_id_number', 'ID number', 'Nr legitymacji', NULL, NULL, NULL, NULL, '2019-03-14 21:06:07', 'localhost'),
	(15, 'txt_photo', 'Photo', 'Fotografia', NULL, NULL, NULL, NULL, '2019-03-14 21:56:00', 'localhost'),
	(16, 'txt_status', 'Status', 'Status', NULL, NULL, NULL, NULL, '2019-03-14 22:13:06', 'localhost');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `delivered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `status`, `type`, `title`, `body`, `autor`, `delivered`, `ip`) VALUES
	(1, 1, 2, 'Hello Marian,', 'this is your first entry into the HT system, follow the instructions received and system indications.', 'HT team<br><br><br><br>', '2019-03-15 17:08:33', 'localhost'),
	(2, 1, 0, 'Welcome everyone,', 'from Saturday, technical work will continue in the system, access to the service may be difficult between 23 and 03 CET, we apologize.', 'HT team<br><br><br>', '2019-03-25 18:25:05', 'localhost'),
	(3, 1, 1, 'Hello Marian,', 'this is your first entry into the HT system, follow the instructions received and system indications.', 'HT team<br><br><br><br>', '2019-03-15 17:08:33', 'localhost');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `oxygenation1` int(11) unsigned NOT NULL DEFAULT '0',
  `pressure1A` int(11) unsigned NOT NULL DEFAULT '0',
  `pressure1B` int(11) unsigned NOT NULL DEFAULT '0',
  `pulse1` int(11) unsigned NOT NULL DEFAULT '0',
  `distance1` int(11) unsigned DEFAULT '0',
  `time_of_exercise1` int(11) unsigned DEFAULT '0',
  `liveindex1` int(11) unsigned DEFAULT '0',
  `oxygenation1e` int(11) unsigned DEFAULT '0',
  `pressure1Ae` int(11) unsigned DEFAULT '0',
  `pressure1Be` int(11) unsigned DEFAULT '0',
  `pulse1e` int(11) unsigned DEFAULT '0',
  `oxygenation2` int(11) unsigned DEFAULT '0',
  `pressure2A` int(11) unsigned DEFAULT '0',
  `pressure2B` int(11) unsigned DEFAULT '0',
  `pulse2` int(11) unsigned DEFAULT '0',
  `distance2` int(11) unsigned DEFAULT '0',
  `time_of_exercise2` int(11) unsigned DEFAULT '0',
  `liveindex2` int(10) unsigned DEFAULT '0',
  `oxygenation2e` int(11) unsigned DEFAULT '0',
  `pressure2Ae` int(11) unsigned DEFAULT '0',
  `pressure2Be` int(11) unsigned DEFAULT '0',
  `pulse2e` int(11) unsigned DEFAULT '0',
  `oxygenation3` int(11) unsigned DEFAULT '0',
  `pressure3A` int(11) unsigned DEFAULT '0',
  `pressure3B` int(11) unsigned DEFAULT '0',
  `pulse3` int(11) unsigned DEFAULT '0',
  `distance3` int(11) unsigned DEFAULT '0',
  `time_of_exercise3` int(11) unsigned DEFAULT '0',
  `liveindex3` int(11) unsigned DEFAULT '0',
  `oxygenation3e` int(11) unsigned DEFAULT '0',
  `pressure3Ae` int(11) unsigned DEFAULT '0',
  `pressure3Be` int(11) unsigned DEFAULT '0',
  `pulse3e` int(11) unsigned DEFAULT '0',
  `comfort` int(10) unsigned DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` (`id`, `userid`, `status`, `oxygenation1`, `pressure1A`, `pressure1B`, `pulse1`, `distance1`, `time_of_exercise1`, `liveindex1`, `oxygenation1e`, `pressure1Ae`, `pressure1Be`, `pulse1e`, `oxygenation2`, `pressure2A`, `pressure2B`, `pulse2`, `distance2`, `time_of_exercise2`, `liveindex2`, `oxygenation2e`, `pressure2Ae`, `pressure2Be`, `pulse2e`, `oxygenation3`, `pressure3A`, `pressure3B`, `pulse3`, `distance3`, `time_of_exercise3`, `liveindex3`, `oxygenation3e`, `pressure3Ae`, `pressure3Be`, `pulse3e`, `comfort`, `date`, `delivered`, `ip`) VALUES
	(1, 1, 0, 81, 42, 144, 109, 2611, 10833, 14, 84, 178, 77, 30, 96, 183, 81, 194, 9717, 142062, 10, 87, 83, 52, 132, 81, 186, 46, 50, 9940, 199947, 5, 81, 47, 56, 152, 3, '2019-03-19 21:47:05', '2019-03-19 21:47:07', '::1'),
	(2, 1, 0, 87, 134, 64, 182, 8106, 41135, 15, 95, 137, 117, 168, 95, 97, 83, 164, 4965, 165420, 7, 80, 196, 114, 111, 86, 72, 134, 158, 6356, 124061, 12, 99, 135, 72, 85, 3, '2019-03-19 23:30:13', '2019-03-19 23:30:16', '::1'),
	(3, 1, 0, 84, 54, 58, 43, 2618, 9593, 9, 97, 75, 134, 177, 96, 84, 85, 115, 1758, 65092, 12, 91, 122, 55, 192, 89, 157, 42, 165, 4110, 25541, 15, 96, 53, 111, 79, 3, '2019-03-19 23:59:09', '2019-03-19 23:59:13', '::1'),
	(4, 1, 0, 89, 62, 107, 144, 6340, 24309, 5, 87, 131, 139, 140, 89, 82, 106, 53, 7053, 21372, 4, 91, 185, 62, 178, 83, 79, 80, 123, 6586, 19828, 7, 81, 193, 77, 177, 3, '2019-03-20 15:55:10', '2019-03-20 15:55:13', '::1'),
	(5, 1, 0, 83, 117, 64, 88, 5377, 99452, 14, 86, 96, 130, 116, 99, 92, 66, 103, 3992, 42142, 8, 86, 92, 81, 162, 89, 175, 125, 47, 8697, 60577, 16, 89, 113, 65, 102, 3, '2019-03-20 17:12:07', '2019-03-20 17:12:09', '::1'),
	(6, 1, 0, 95, 109, 118, 167, 4735, 247, 6, 90, 74, 114, 153, 94, 72, 86, 79, 1859, 210, 15, 97, 158, 118, 41, 85, 192, 66, 109, 3692, 65, 12, 81, 141, 102, 187, 3, '2019-03-20 23:19:08', '2019-03-20 23:19:12', '::1'),
	(7, 1, 0, 86, 128, 48, 192, 6821, 54, 9, 80, 192, 46, 197, 92, 49, 116, 140, 4561, 46, 6, 82, 171, 56, 84, 94, 119, 80, 196, 6108, 3, 4, 94, 52, 101, 74, 3, '2019-03-20 23:19:16', '2019-03-20 23:19:18', '::1'),
	(8, 1, 0, 92, 147, 74, 66, 1586, 205, 2, 84, 184, 43, 117, 97, 67, 120, 42, 8265, 278, 6, 95, 122, 86, 154, 90, 110, 79, 156, 5834, 226, 5, 85, 170, 104, 148, 3, '2019-03-21 16:07:21', '2019-03-21 16:07:24', '::1'),
	(9, 1, 0, 1, 84, 71, 95, 4, 76, 0, 86, 89, 99, 130, 99, 138, 101, 138, 3557, 241, 3, 86, 195, 131, 135, 87, 108, 58, 98, 510, 231, 0, 87, 160, 79, 135, 3, '2019-03-22 17:09:26', '2019-03-22 17:09:50', '::1'),
	(10, 1, 0, 7, 187, 82, 100, 33, 65, 0, 81, 138, 125, 40, 93, 55, 62, 171, 6219, 173, 7, 83, 92, 70, 134, 96, 65, 51, 73, 8443, 23, 73, 81, 55, 95, 121, 3, '2019-03-22 17:14:32', '2019-03-22 17:14:56', '::1'),
	(11, 1, 0, 9, 135, 101, 139, 99, 37, 1, 97, 95, 91, 52, 99, 96, 85, 119, 5599, 120, 9, 88, 132, 66, 178, 82, 168, 53, 70, 5723, 70, 16, 89, 105, 77, 42, 3, '2019-03-22 17:22:12', '2019-03-22 17:22:28', '::1'),
	(12, 1, 0, 9, 194, 149, 63, 99, 102, 0, 81, 153, 141, 132, 84, 112, 149, 70, 5763, 243, 5, 93, 136, 145, 193, 96, 103, 87, 162, 6941, 153, 9, 93, 105, 112, 59, 3, '2019-03-22 17:32:59', '2019-03-22 17:33:11', '::1'),
	(13, 1, 0, 9, 41, 125, 141, 99, 185, 0, 81, 80, 99, 100, 92, 166, 95, 171, 6760, 171, 8, 90, 145, 138, 146, 88, 124, 129, 185, 1256, 151, 2, 89, 148, 128, 131, 3, '2019-03-22 17:34:23', '2019-03-22 17:34:32', '::1'),
	(14, 1, 0, 9, 197, 109, 122, 99, 75, 0, 91, 136, 121, 162, 88, 124, 139, 150, 2392, 213, 2, 90, 162, 42, 108, 89, 48, 124, 193, 7543, 143, 11, 86, 112, 138, 171, 3, '2019-03-22 17:37:53', '2019-03-22 17:38:02', '::1'),
	(15, 1, 0, 9, 69, 109, 129, 99, 60, 0, 84, 196, 54, 181, 84, 128, 97, 30, 5536, 291, 4, 93, 157, 55, 106, 90, 58, 112, 111, 8509, 300, 6, 97, 197, 114, 138, 3, '2019-03-22 17:47:26', '2019-03-22 17:47:43', '::1'),
	(16, 1, 0, 99, 66, 123, 85, 123, 199, 0, 97, 102, 70, 32, 92, 97, 134, 192, 626, 252, 0, 94, 110, 109, 145, 89, 83, 52, 156, 1996, 143, 3, 91, 65, 46, 78, 3, '2019-03-22 17:49:26', '2019-03-22 17:50:04', '::1'),
	(17, 1, 0, 85, 150, 143, 45, 7615, 239, 6, 90, 83, 70, 168, 70, 181, 97, 100, 1339, 156, 2, 80, 76, 55, 139, 91, 54, 51, 182, 9832, 183, 11, 91, 187, 147, 135, 3, '2019-03-22 17:51:30', '2019-03-22 18:12:21', '::1'),
	(18, 1, 0, 87, 170, 106, 173, 2995, 209, 3, 83, 74, 88, 146, 79, 94, 89, 82, 7122, 226, 6, 94, 80, 117, 143, 83, 65, 78, 80, 5977, 221, 5, 96, 54, 123, 48, 3, '2019-03-22 18:13:52', '2019-03-22 18:13:56', '::1'),
	(19, 1, 0, 79, 102, 137, 70, 360, 203, 0, 86, 159, 70, 101, 84, 127, 47, 169, 681, 131, 1, 89, 129, 56, 150, 86, 135, 88, 181, 8119, 250, 6, 91, 149, 128, 197, 3, '2019-03-22 18:14:10', '2019-03-22 18:14:25', '::1'),
	(20, 1, 0, 83, 169, 81, 57, 3335, 276, 2, 82, 94, 98, 77, 79, 133, 55, 192, 7551, 246, 6, 94, 106, 129, 100, 84, 164, 135, 176, 9244, 163, 11, 84, 43, 94, 186, 3, '2019-03-22 18:32:52', '2019-03-22 18:32:56', '::1'),
	(21, 1, 0, 90, 171, 105, 11, 8670, 86, 20, 93, 94, 127, 173, 80, 120, 112, 158, 3281, 213, 3, 93, 164, 142, 132, 96, 128, 70, 160, 3316, 265, 3, 88, 186, 45, 113, 3, '2019-03-22 18:48:31', '2019-03-22 18:50:11', '::1'),
	(22, 1, 0, 88, 49, 80, 11, 8118, 191, 9, 90, 91, 83, 128, 97, 110, 129, 67, 5696, 199, 6, 80, 106, 47, 157, 81, 191, 85, 157, 7518, 234, 6, 93, 162, 41, 156, 3, '2019-03-22 18:50:24', '2019-03-22 18:50:28', '::1'),
	(23, 1, 0, 98, 57, 136, 14, 1424, 137, 2, 83, 122, 62, 154, 82, 41, 138, 136, 3534, 293, 2, 84, 82, 107, 162, 88, 156, 144, 124, 2801, 213, 3, 81, 178, 47, 82, 3, '2019-03-22 18:51:13', '2019-03-22 18:51:23', '::1'),
	(24, 1, 0, 80, 176, 75, 178, 3102, 55, 11, 86, 177, 96, 105, 87, 137, 124, 76, 6593, 139, 9, 91, 99, 144, 197, 77, 98, 46, 189, 4817, 192, 5, 92, 67, 105, 138, 3, '2019-03-22 21:41:47', '2019-03-22 21:41:50', '::1'),
	(25, 1, 0, 87, 127, 148, 21, 9854, 138, 14, 89, 152, 150, 175, 94, 48, 46, 90, 9025, 136, 13, 93, 48, 67, 70, 85, 43, 75, 195, 9582, 192, 10, 82, 125, 129, 87, 3, '2019-03-22 22:23:35', '2019-03-22 22:23:43', '::1'),
	(26, 1, 0, 98, 116, 121, 103, 4425, 28, 32, 99, 66, 128, 103, 86, 81, 67, 99, 286, 202, 0, 92, 40, 75, 156, 82, 87, 72, 35, 2810, 75, 7, 97, 182, 124, 0, 3, '2019-03-23 01:53:50', '2019-03-23 01:53:56', '::1'),
	(27, 1, 0, 91, 197, 137, 64, 2757, 225, 2, 89, 118, 98, 143, 89, 160, 92, 0, 534, 88, 1, 99, 53, 116, 107, 88, 89, 141, 163, 3103, 114, 5, 92, 189, 119, 137, 3, '2019-03-23 01:54:04', '2019-03-23 01:54:26', '::1'),
	(28, 1, 0, 83, 99, 143, 124, 0, 216, 0, 95, 106, 101, 76, 86, 155, 144, 165, 2254, 19, 24, 94, 99, 121, 40, 97, 90, 107, 94, 7597, 163, 9, 87, 57, 48, 126, 3, '2019-03-23 01:56:53', '2019-03-23 01:57:00', '::1'),
	(29, 1, 0, 95, 138, 128, 71, 1929, 61, 6, 93, 50, 137, 180, 91, 132, 110, 158, 9994, 238, 8, 89, 66, 111, 134, 90, 112, 54, 141, 9824, 158, 12, 94, 94, 117, 41, 3, '2019-03-25 15:56:09', '2019-03-26 09:11:02', '::1'),
	(30, 1, 0, 88, 70, 131, 46, 2133, 211, 2, 94, 95, 113, 164, 81, 134, 59, 139, 3270, 108, 6, 81, 104, 98, 48, 95, 98, 65, 80, 4792, 19, 50, 90, 165, 74, 126, 4, '2019-03-26 00:17:04', '2019-03-26 09:16:09', '::1'),
	(31, 1, 0, 88, 129, 74, 175, 3540, 64, 11, 95, 121, 86, 114, 80, 124, 65, 65, 12, 122, 0, 97, 189, 98, 95, 86, 93, 97, 145, 2918, 129, 5, 93, 165, 62, 128, 3, '2019-03-26 00:17:10', '2019-03-26 00:17:43', '::1'),
	(32, 1, 0, 88, 111, 83, 161, 2796, 202, 3, 98, 169, 99, 48, 81, 75, 93, 94, 1032, 166, 1, 93, 137, 67, 196, 93, 97, 41, 43, 5268, 44, 24, 97, 148, 83, 200, 3, '2019-03-26 23:05:27', '2019-03-26 23:05:33', '::1'),
	(33, 1, 0, 95, 67, 74, 100, 4882, 151, 6, 84, 94, 80, 112, 80, 146, 92, 105, 7468, 202, 7, 90, 177, 65, 91, 82, 122, 58, 185, 2722, 151, 4, 95, 132, 67, 149, 3, '2019-03-26 23:05:36', '2019-03-26 23:05:38', '::1');
/*!40000 ALTER TABLE `results` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `permissions` int(10) unsigned NOT NULL DEFAULT '11',
  `blockade` int(10) unsigned NOT NULL DEFAULT '0',
  `active` int(10) NOT NULL DEFAULT '0',
  `language` varchar(100) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `firstname` varchar(200) NOT NULL,
  `nickname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `citizenship` varchar(100) DEFAULT NULL,
  `rank` varchar(200) DEFAULT NULL,
  `unit` varchar(250) DEFAULT NULL,
  `idnumber` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `recommended` varchar(250) DEFAULT NULL,
  `approved` varchar(250) DEFAULT NULL,
  `doctorid` varchar(200) DEFAULT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `history` text,
  `delivered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `password`, `permissions`, `blockade`, `active`, `language`, `lang`, `firstname`, `nickname`, `lastname`, `date_of_birth`, `photo`, `citizenship`, `rank`, `unit`, `idnumber`, `status`, `recommended`, `approved`, `doctorid`, `secret`, `history`, `delivered`, `ip`) VALUES
	(1, 'marian-test', '8f8379652d17e0d7e5bcc672d8720049db108fa5b8b0774d0f9a497c1e4714d1', 11, 0, 1, 'Polski', 'pl', 'ZmM0N2U3MGY1MGMyNzE4YW1ycXMzOVM3MU5uSjh2Rm9UUnNMakE9PQ==', NULL, 'ZTY5OWQ0OWM1MjI5Mzg1OWRHR1BoRUhsTUQyVjVaQ01obTBua1E9PQ==', '1943-06-11', NULL, 'Polish', 'ZmZkMjNhMWNmNDYzMzMwZlBXazNQWTJCSER0THZsY2lHZjZUOVE9PQ==', NULL, 'MDFkMzZlOGMxNzQ4ODRkYUNPQ3F5cFd5NGdYVFNWNm5RWDNabVE9PQ==', 'MmY4ZWRkZjkwNjAzYTA3MkVSZEU3NndCdDd1TFJWdDV4dGhKL1dYOVpGb1dHZFo0RWw3K1dnVjdXMjg9', 'ZGQyOTIxNGI1MjlkNmUwN3MzcVlMRkdGMDFtTnp6eHYwZUNZNHR1UWEyajExVE0xMkd5S1FXOUNEMU1YT3oxZEdMUHcwR21tZmNrYWVyZ2s=', 'Yjk3YWMzZWMxNjUwYjgwYzhvbXpWMVo1dTFqb1I4OVpRVll0U2I4YmxMc0JXVGs0aW4rZFFKZGdNbjg9', 'YWJkODZiODNmZTVkYWYwNzRsRVF3NXFHR2NYQzZYb3dIQVY5ckVscFlZTlBKQnhLZkR1S1FtNmdHU2c9', '0', NULL, '2019-03-13 18:10:00', 'ZGM5YjJkNjZjZjU1NDI1MW5aZDlLbTQ4MElQdHdNUmpOZVpPSlE9PQ=='),
	(2, 'marian', '8f8379652d17e0d7e5bcc672d8720049db108fa5b8b0774d0f9a497c1e4714d1', 11, 0, 1, 'Polski', 'pl', 'ZmM0N2U3MGY1MGMyNzE4YW1ycXMzOVM3MU5uSjh2Rm9UUnNMakE9PQ==', NULL, 'ZTY5OWQ0OWM1MjI5Mzg1OWRHR1BoRUhsTUQyVjVaQ01obTBua1E9PQ==', '1943-06-11', NULL, 'Polish', 'ZmZkMjNhMWNmNDYzMzMwZlBXazNQWTJCSER0THZsY2lHZjZUOVE9PQ==', NULL, 'MDFkMzZlOGMxNzQ4ODRkYUNPQ3F5cFd5NGdYVFNWNm5RWDNabVE9PQ==', 'MmY4ZWRkZjkwNjAzYTA3MkVSZEU3NndCdDd1TFJWdDV4dGhKL1dYOVpGb1dHZFo0RWw3K1dnVjdXMjg9', 'ZGQyOTIxNGI1MjlkNmUwN3MzcVlMRkdGMDFtTnp6eHYwZUNZNHR1UWEyajExVE0xMkd5S1FXOUNEMU1YT3oxZEdMUHcwR21tZmNrYWVyZ2s=', 'Yjk3YWMzZWMxNjUwYjgwYzhvbXpWMVo1dTFqb1I4OVpRVll0U2I4YmxMc0JXVGs0aW4rZFFKZGdNbjg9', 'YWJkODZiODNmZTVkYWYwNzRsRVF3NXFHR2NYQzZYb3dIQVY5ckVscFlZTlBKQnhLZkR1S1FtNmdHU2c9', '0', NULL, '2019-03-13 18:10:00', 'ZGM5YjJkNjZjZjU1NDI1MW5aZDlLbTQ4MElQdHdNUmpOZVpPSlE9PQ==');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
