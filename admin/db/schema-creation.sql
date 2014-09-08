-- Database Schema
--
-- Warning!
-- This will drop the chibicrittersdb and tables if they exist!

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2014 at 03:42 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chibicrittersdb`
--
CREATE DATABASE IF NOT EXISTS `chibicrittersdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `chibicrittersdb`;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(512) NOT NULL,
  `condition` varchar(512) DEFAULT NULL,
  `effect` varchar(1024) NOT NULL,
  `strength` varchar(4) DEFAULT NULL,
  `prize` varchar(255) DEFAULT NULL,
  `penalty` varchar(255) DEFAULT NULL,
  `turn_count` varchar(4) DEFAULT NULL,
  `quest_points` varchar(4) DEFAULT NULL,
  `card_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `card_type_id_idx` (`card_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `card_in_set`
--

DROP TABLE IF EXISTS `card_in_set`;
CREATE TABLE IF NOT EXISTS `card_in_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `set_id_idx` (`set_id`),
  KEY `card_id_idx` (`card_id`),
  KEY `language_id_idx` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `card_type`
--

DROP TABLE IF EXISTS `card_type`;
CREATE TABLE IF NOT EXISTS `card_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `background_image_path` varchar(512) NOT NULL,
  `foreground_image_path` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(2) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `prefix_UNIQUE` (`prefix`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `set`
--

DROP TABLE IF EXISTS `set`;
CREATE TABLE IF NOT EXISTS `set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) NOT NULL,
  `prefix` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `prefix_UNIQUE` (`prefix`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `fk_card_type_id` FOREIGN KEY (`card_type_id`) REFERENCES `card_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `card_in_set`
--
ALTER TABLE `card_in_set`
  ADD CONSTRAINT `fk_card_id` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_set_id` FOREIGN KEY (`set_id`) REFERENCES `set` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `prefix`, `name`) VALUES
(1, 'en', 'English');

--
-- Dumping data for table `card_type`
--

INSERT INTO `card_type` (`id`, `name`, `background_image_path`, `foreground_image_path`) VALUES
(1, 'Critter', './critter_bg.png', './critter_front.png'),
(2, 'Spell', './spell_bg.png', './spell_front.png'),
(3, 'Sabotage', './sabotage_bg.png', './sabotage_front.png'),
(4, 'Love', './love_bg.png', './love_front.png'),
(5, 'Quest', './quest_bg.png', './quest_front.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
