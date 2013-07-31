-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2013 at 04:46 PM
-- Server version: 5.6.12
-- PHP Version: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `WebImageBD`
--
CREATE DATABASE IF NOT EXISTS `WebImageBD` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `WebImageBD`;

-- --------------------------------------------------------

--
-- Table structure for table `Authentication`
--

CREATE TABLE IF NOT EXISTS `Authentication` (
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Authentication`
--

INSERT INTO `Authentication` (`username`, `password`) VALUES
('sochoaf', '12345'),
('sochoaf', 'Sebas9324*'),
('jprivi', '12345'),
('', ''),
('', ''),
('', ''),
('', ''),
('sochoaf2', 'Sebas9324*');

-- --------------------------------------------------------

--
-- Table structure for table `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `idImagen` int(20) NOT NULL AUTO_INCREMENT,
  `nombreImagen` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fechaCarga` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idImagen`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `imagenes`
--

INSERT INTO `imagenes` (`idImagen`, `nombreImagen`, `fechaCarga`) VALUES
(8, '_DSC0433.jpg', '2013-07-31 03:59:51'),
(9, '200910034010.jpg', '2013-07-31 03:59:51'),
(10, 'img_about.jpg', '2013-07-31 04:01:24');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
