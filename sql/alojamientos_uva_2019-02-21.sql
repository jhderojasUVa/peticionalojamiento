# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.62)
# Base de datos: alojamientos_uva
# Tiempo de Generación: 2019-02-21 08:44:56 +0000
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

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `admin`, `key`)
VALUES
	(1,'e09338789',X'2D2D2D2D2D424547494E20');

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla alojamientos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `alojamientos`;

CREATE TABLE `alojamientos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID del alojamiento',
  `host` varchar(250) NOT NULL DEFAULT '' COMMENT 'HOST del alojamiento (IP o nombre)',
  `user` varchar(250) NOT NULL DEFAULT '' COMMENT 'Nombre del usuario',
  `pass` binary(250) DEFAULT '\\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `responsable` varchar(250) NOT NULL DEFAULT '' COMMENT 'Identificador del responsable',
  `emailContacto` varchar(250) NOT NULL DEFAULT '' COMMENT 'Email (por si es diferente)',
  `ip` varchar(250) DEFAULT NULL COMMENT 'IPs permitidas',
  `idestado` int(11) NOT NULL DEFAULT '1' COMMENT 'Estado en el que se encuentra (otra tabla)',
  `url` varchar(250) DEFAULT NULL COMMENT 'URL del alojamiento',
  `alias` varchar(250) DEFAULT NULL COMMENT 'Alias del alojamiento',
  `fechaPeticion` date NOT NULL COMMENT 'Fecha de la peticion',
  `fechaRealizacion` date DEFAULT NULL COMMENT 'Fecha de realizacion',
  `descripcion` text NOT NULL COMMENT 'Descripcion',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `alojamientos` WRITE;
/*!40000 ALTER TABLE `alojamientos` DISABLE KEYS */;

INSERT INTO `alojamientos` (`id`, `host`, `user`, `pass`, `responsable`, `emailContacto`, `ip`, `idestado`, `url`, `alias`, `fechaPeticion`, `fechaRealizacion`, `descripcion`)
VALUES
	(14,'3','1234',X'66396532623636316437666538653466333165633432396663346165326563303065303062386336000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000','e09338789f','123@uva.es','*',1,'s.uva.es','aaaa','2019-02-15',NULL,'bbbb'),
	(15,'3','234234',X'66616134646466313235613162626365393636666464393037306162373231396533376539643237000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000','e09338789f','333#@www.es','*',1,'1.uva.es','24234234','2019-02-19',NULL,'424234234234');

/*!40000 ALTER TABLE `alojamientos` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `bd` WRITE;
/*!40000 ALTER TABLE `bd` DISABLE KEYS */;

INSERT INTO `bd` (`id`, `host`, `user`, `password`, `basededatos`, `idalojamiento`)
VALUES
	(1,'cogeces.cpd.uva.es','tmp',X'5C305C305C305C305C305C','tmp',15);

/*!40000 ALTER TABLE `bd` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla estado
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID del estado',
  `estado` varchar(250) NOT NULL DEFAULT '' COMMENT 'Nombre del estado',
  `color` varchar(11) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;

INSERT INTO `estado` (`id`, `estado`, `color`)
VALUES
	(1,'nuevo','rojo'),
	(2,'en proceso: alojamiento','amarillo'),
	(3,'en proceso: base de datos','amarillo'),
	(4,'completado','verde');

/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla host
# ------------------------------------------------------------

DROP TABLE IF EXISTS `host`;

CREATE TABLE `host` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hostName` varchar(20) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `descripcion` varchar(250) NOT NULL DEFAULT '',
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `host` WRITE;
/*!40000 ALTER TABLE `host` DISABLE KEYS */;

INSERT INTO `host` (`id`, `hostName`, `ip`, `descripcion`, `active`)
VALUES
	(1,'alojamientos.uva.es','157.88.18.50','Aplicaciones corporativas',0),
	(2,'albergueweb.uva.es','157.88.26.18','Equipo con PHP 5.3',0),
	(3,'albergueweb1.uva.es','157.88.26.20','Equipo con PHP 7',1);

/*!40000 ALTER TABLE `host` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
