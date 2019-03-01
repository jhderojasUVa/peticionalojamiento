# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.24)
# Base de datos: alojamientos_uva
# Tiempo de Generación: 2019-01-03 08:06:45 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID del admin',
  `admin` varchar(9) NOT NULL DEFAULT '' COMMENT 'Identificador del ADMIN',
  `key` binary(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Volcado de tabla alojamientos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `alojamientos`;

CREATE TABLE `alojamientos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID del alojamiento',
  `host` varchar(250) NOT NULL DEFAULT '' COMMENT 'HOST del alojamiento (IP o nombre)',
  `user` varchar(250) NOT NULL DEFAULT '' COMMENT 'Nombre del usuario',
  `pass` binary(1) DEFAULT '\0',
  `responsable` varchar(250) NOT NULL DEFAULT '' COMMENT 'Identificador del responsable',
  `emailContacto` varchar(250) NOT NULL DEFAULT '' COMMENT 'Email (por si es diferente)',
  `ip` varchar(250) DEFAULT NULL COMMENT 'IPs permitidas',
  `idestado` int(11) NOT NULL COMMENT 'Estado en el que se encuentra (otra tabla)',
  `url` varchar(250) DEFAULT NULL COMMENT 'URL del alojamiento',
  `alias` varchar(250) DEFAULT NULL COMMENT 'Alias del alojamiento',
  `fechaPeticion` date NOT NULL COMMENT 'Fecha de la peticion',
  `fechaRealizacion` date DEFAULT NULL COMMENT 'Fecha de realizacion',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Volcado de tabla bd
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bd`;

CREATE TABLE `bd` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `host` varchar(250) NOT NULL DEFAULT '' COMMENT 'Host de la base de datos',
  `user` varchar(250) NOT NULL DEFAULT '' COMMENT 'Usuario en la base de datos',
  `password` binary(11) DEFAULT '\0\0\0\0\0\0\0\0\0\0\0',
  `basededatos` varchar(250) NOT NULL DEFAULT '' COMMENT 'Nombre de la base de dato',
  `idalojamiento` int(11) NOT NULL COMMENT 'FK del alojamiento',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Volcado de tabla estado
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID del estado',
  `estado` varchar(250) NOT NULL DEFAULT '' COMMENT 'Nombre del estado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;

INSERT INTO `estado` (`id`, `estado`)
VALUES
	(1,'nuevo'),
	(2,'en proceso: alojamiento'),
	(3,'en proceso: base de datos'),
	(4,'completado');

/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
