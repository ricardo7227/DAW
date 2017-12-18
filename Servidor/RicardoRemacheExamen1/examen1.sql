-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2017 at 08:57 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examen1`
--

-- --------------------------------------------------------

--
-- Table structure for table `EXAMEN`
--

CREATE TABLE `EXAMEN` (
  `ID` int(11) NOT NULL,
  `COCHE` varchar(245) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `COMPRADO` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EXAMEN1`
--

CREATE TABLE `EXAMEN1` (
  `ID_EXAMEN` int(11) NOT NULL,
  `FECHA_COMPRA` datetime DEFAULT NULL,
  `KM` int(11) DEFAULT NULL,
  `DESCUENTO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `LOGIN_PHP`
--

CREATE TABLE `LOGIN_PHP` (
  `NOMBRE` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FECHA_LOGIN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `ID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `NOMBRE` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ACTIVO` tinyint(4) NOT NULL DEFAULT '0',
  `CODIGO_ACTIVACION` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FECHA_ACTIVACION` datetime(6) NOT NULL,
  `EMAIL` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EXAMEN`
--
ALTER TABLE `EXAMEN`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EXAMEN1`
--
ALTER TABLE `EXAMEN1`
  ADD PRIMARY KEY (`ID_EXAMEN`);

--
-- Indexes for table `LOGIN_PHP`
--
ALTER TABLE `LOGIN_PHP`
  ADD PRIMARY KEY (`NOMBRE`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CODIGO_ACTIVACION_UNIQUE` (`CODIGO_ACTIVACION`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `EXAMEN`
--
ALTER TABLE `EXAMEN`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
