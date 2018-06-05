-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: haulage_management_system
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

--
-- Table structure for table `hauliers`
--

DROP TABLE IF EXISTS `hauliers`;
CREATE TABLE `hauliers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_name_UNIQUE` (`short_name`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51622 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `area_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`area_code`),
  UNIQUE KEY `area_code_UNIQUE` (`area_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp(2) NULL DEFAULT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `idx_users_username_password_name_email` (`username`,`password`,`name`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2028 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `journeys`
--

DROP TABLE IF EXISTS `journeys`;
CREATE TABLE `journeys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `destination` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `haulier` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `destination_idx` (`destination`),
  KEY `source_idx` (`source`),
  KEY `haulier_idx` (`haulier`),
  CONSTRAINT `destination` FOREIGN KEY (`destination`) REFERENCES `locations` (`area_code`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `haulier` FOREIGN KEY (`haulier`) REFERENCES `hauliers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `source` FOREIGN KEY (`source`) REFERENCES `locations` (`area_code`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
