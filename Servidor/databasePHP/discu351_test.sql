-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2017 at 10:12 AM
-- Server version: 5.6.37-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `discu351_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `ALUMNOS`
--

CREATE TABLE `ALUMNOS` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `MAYOR_EDAD` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ALUMNOS`
--

INSERT INTO `ALUMNOS` (`ID`, `NOMBRE`, `FECHA_NACIMIENTO`, `MAYOR_EDAD`) VALUES
(1, 'Ricardo Alexis', '1990-08-23', 1),
(2, 'Inuyashiki, Ichirou ', '1950-08-02', 1),
(3, 'Shishigami, Hiro', '2009-04-02', 0),
(4, 'Andou, Naoyuki', '2006-04-18', 0),
(5, 'Watanabe, Shion', '1999-04-18', 1),
(6, 'Lacia Arturus', '2000-08-22', 1),
(8, 'Uraraka, Ochako (Gravity)', '2011-06-21', 0),
(11, 'Akari Kawamoto', '1996-08-23', 1),
(12, 'Sakuranomiya, Maika', '2001-04-04', 0),
(13, 'Kaho Hinata', '2000-08-12', 0),
(16, 'Mafuyu Hoshikawa', '1996-08-23', 1),
(19, 'Miu Amano', '2000-06-15', 1),
(20, 'Kafuu, Chino', '2005-12-04', 0),
(21, 'Tedeza, Rize', '1999-02-04', 0),
(23, 'Kokoa Hot Cocoa Hoto', '2007-04-04', 0),
(26, 'Chiya \"Uji Matcha Chiyo Mukashi\" Ujimatsu', '2017-10-05', 0),
(27, 'Megumi \"Nutmeg, Meg\" Natsu', '2017-10-18', 0),
(30, 'Maya \"Jogmaya\" Jouga', '1995-06-07', 1),
(32, '<script>alert(\"hola\");</script>', '1999-02-04', 1),
(36, 'Emilia \"Satella, Lia\"', '2014-07-09', 0),
(37, 'Subaru \"Barusu\" Natsuki', '2012-07-04', 0),
(38, 'Rem', '2007-02-14', 0),
(39, 'Felix \"Ferris\" Argail', '2001-10-19', 1),
(40, 'Ram', '2000-10-05', 1),
(41, 'Beatrice \"Betty, Beako\"', '1999-06-18', 1),
(43, 'Puck', '1934-02-14', 1),
(44, 'Crusch Karsten', '1999-06-16', 1),
(45, 'Wilhelm van Astrea', '1972-01-12', 1),
(58, '← Æ', '2015-07-15', 1),
(60, '\" !\"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~\"', '1999-02-16', 1),
(61, 'Hatori, Chise', '2000-11-20', 1),
(69, ';DROP TABLE ALUMNOS;', '2017-11-15', 1),
(369, '← Æ ωΛ φ', '2015-07-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ASIGNATURAS`
--

CREATE TABLE `ASIGNATURAS` (
  `id` int(11) NOT NULL,
  `NOMBRE` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CURSO` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CICLO` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ASIGNATURAS`
--

INSERT INTO `ASIGNATURAS` (`id`, `NOMBRE`, `CURSO`, `CICLO`) VALUES
(1, 'Servidor2', 'Primero', 'DAWS'),
(2, 'Servicios', 'Segundo', 'DAM'),
(3, 'Ingles\'2', 'Segundo', 'DAW'),
(4, 'Emprésa', 'Segundo', 'DAW'),
(127, 'Emprésat', 'Segundo', 'DAW'),
(128, 'Servidor en PHP', 'Primero', 'DAWS'),
(132, 'Emprésat2', 'Segundo', 'DAW'),
(136, '← Æ ♣®η', 'Primero', 'DAWS2');

-- --------------------------------------------------------

--
-- Table structure for table `NOTAS`
--

CREATE TABLE `NOTAS` (
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_ASIGNATURA` int(11) NOT NULL,
  `NOTA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `NOTAS`
--

INSERT INTO `NOTAS` (`ID_ALUMNO`, `ID_ASIGNATURA`, `NOTA`) VALUES
(1, 1, 9),
(1, 2, 6),
(1, 3, 5),
(1, 4, 2),
(1, 132, 58),
(2, 1, 7),
(3, 2, 2),
(5, 2, 5),
(5, 4, 0),
(13, 132, 10),
(16, 1, 0),
(16, 3, 9),
(16, 4, 8),
(21, 4, 75),
(21, 136, 75),
(27, 4, 9),
(36, 132, 6),
(37, 1, 4),
(37, 2, 0),
(38, 4, 8),
(38, 128, 6),
(40, 128, 7),
(43, 2, 3),
(43, 3, 9),
(43, 4, 5),
(43, 128, 0),
(43, 136, 8),
(44, 4, 5),
(44, 127, 8),
(45, 4, 9),
(45, 136, 58),
(58, 3, 9),
(60, 127, 8),
(60, 128, 5),
(69, 3, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ALUMNOS`
--
ALTER TABLE `ALUMNOS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ASIGNATURAS`
--
ALTER TABLE `ASIGNATURAS`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `NOTAS`
--
ALTER TABLE `NOTAS`
  ADD PRIMARY KEY (`ID_ALUMNO`,`ID_ASIGNATURA`),
  ADD KEY `NOTAS_ASIGNATURAS_idx` (`ID_ASIGNATURA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ALUMNOS`
--
ALTER TABLE `ALUMNOS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=381;
--
-- AUTO_INCREMENT for table `ASIGNATURAS`
--
ALTER TABLE `ASIGNATURAS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `NOTAS`
--
ALTER TABLE `NOTAS`
  ADD CONSTRAINT `NOTAS_ALUMNOS` FOREIGN KEY (`ID_ALUMNO`) REFERENCES `ALUMNOS` (`ID`),
  ADD CONSTRAINT `NOTAS_ASIGNATURAS` FOREIGN KEY (`ID_ASIGNATURA`) REFERENCES `ASIGNATURAS` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
