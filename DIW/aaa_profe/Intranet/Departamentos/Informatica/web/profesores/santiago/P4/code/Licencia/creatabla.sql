 Base de datos licenciadb  - Tabla licencia  ejecut�ndose en localhost

# phpMyAdmin SQL Dump
# version 2.5.7
# http://www.phpmyadmin.net
#
# Servidor: localhost
# Tiempo de generaci�n: 16-09-2004 a las 09:14:21
# Versi�n del servidor: 4.0.18
# Versi�n de PHP: 5.0.1
# 
# Base de datos : `licenciadb`
# 

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `licencia`
#
# Creaci�n: 12-09-2004 a las 21:39:08
# �ltima actualizaci�n: 16-09-2004 a las 09:10:35
#

DROP TABLE IF EXISTS `licencia`;
CREATE TABLE `licencia` (
  `AClave1` int(11) NOT NULL default '0',
  `AClave2` varchar(4) NOT NULL default '',
  `AClaveActiva` varchar(4) NOT NULL default '',
  `AApellidos` varchar(50) NOT NULL default '',
  `ANombre` varchar(50) NOT NULL default '',
  `ADomicilio` varchar(50) default NULL,
  `ATel�fono` varchar(50) default NULL,
  `AEmail` varchar(50) NOT NULL default '',
  `AObserv` text,
  `AFecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`AClave1`)
) TYPE=MyISAM;

