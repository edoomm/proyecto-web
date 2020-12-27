/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.17-MariaDB : Database - sistema_registro
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sistema_registro` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sistema_registro`;

/*Table structure for table `alumno` */

DROP TABLE IF EXISTS `alumno`;

CREATE TABLE `alumno` (
  `curp` varchar(18) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `primer_apellido` varchar(30) NOT NULL,
  `segundo_apellido` varchar(30) NOT NULL,
  `genero` char(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(320) NOT NULL,
  `telefono_celular` varchar(13) NOT NULL,
  `telefono_casa` varchar(13) DEFAULT NULL,
  `direccion` varchar(500) NOT NULL,
  `contrasena` varchar(32) NOT NULL,
  PRIMARY KEY (`curp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `alumno` */

/*Table structure for table `alumno_has_escuela` */

DROP TABLE IF EXISTS `alumno_has_escuela`;

CREATE TABLE `alumno_has_escuela` (
  `curp_alumno` varchar(16) NOT NULL,
  `id_escuela` int(11) NOT NULL,
  `id_formacion_tecnica` int(11) DEFAULT NULL,
  `promedio` varchar(4) NOT NULL,
  KEY `FK6` (`curp_alumno`),
  KEY `FK7` (`id_escuela`),
  KEY `Fk8` (`id_formacion_tecnica`),
  CONSTRAINT `FK6` FOREIGN KEY (`curp_alumno`) REFERENCES `alumno` (`curp`),
  CONSTRAINT `FK7` FOREIGN KEY (`id_escuela`) REFERENCES `escuela` (`id_escuela`),
  CONSTRAINT `Fk8` FOREIGN KEY (`id_formacion_tecnica`) REFERENCES `formacion_tecnica` (`id_formacion_tecnica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `alumno_has_escuela` */

/*Table structure for table `alumno_has_grupo` */

DROP TABLE IF EXISTS `alumno_has_grupo`;

CREATE TABLE `alumno_has_grupo` (
  `curp_alumno` varchar(16) NOT NULL,
  `clave_grupo` varchar(4) NOT NULL,
  KEY `FK5` (`clave_grupo`),
  KEY `FK4` (`curp_alumno`),
  CONSTRAINT `FK4` FOREIGN KEY (`curp_alumno`) REFERENCES `alumno` (`curp`),
  CONSTRAINT `FK5` FOREIGN KEY (`clave_grupo`) REFERENCES `grupo` (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `alumno_has_grupo` */

/*Table structure for table `alumno_has_programa` */

DROP TABLE IF EXISTS `alumno_has_programa`;

CREATE TABLE `alumno_has_programa` (
  `curp_alumno` varchar(16) NOT NULL,
  `id_programa_academico` int(11) NOT NULL,
  `opcion` int(11) NOT NULL,
  `aceptado` tinyint(1) DEFAULT NULL,
  KEY `FK9` (`curp_alumno`),
  KEY `FK10` (`id_programa_academico`),
  CONSTRAINT `FK10` FOREIGN KEY (`id_programa_academico`) REFERENCES `programa_academico` (`id_programa_academico`),
  CONSTRAINT `FK9` FOREIGN KEY (`curp_alumno`) REFERENCES `alumno` (`curp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `alumno_has_programa` */

/*Table structure for table `escuela` */

DROP TABLE IF EXISTS `escuela`;

CREATE TABLE `escuela` (
  `id_escuela` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `localidad` varchar(500) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_escuela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `escuela` */

insert  into `escuela`(`id_escuela`,`nombre`,`localidad`,`tipo`) values 
(0,'CET 1 \"Walter Cross Buchanan\"','Av. 661 S/N, F0VISSTE Aragón, San Juan de Aragón V Secc, Gustavo A. Madero, 07920 Ciudad de México, CDMX',''),
(1,'CECyT No. 1 \"Gonzalo Vázquez Vela\"','Av. 510 Nº 1000 Col. Ejidos de Aragón, Alcaldía Gustavo A. Madero, C.P. 07480, Ciudad de México.',''),
(2,'CECyT No. 2 \"Miguel Bernard\"','Av. Nueva Casa de la Moneda 133, Lomas de Sotelo, Panteón Frances, 11200 Miguel Hidalgo, CDMX',''),
(3,'CECyT No. 3 \"Estanislao Ramírez Ruiz\"','Av. Carlos Hank González s/n, Col. Valle de Ecatepec, Ecatepec de Morelos, Edo. de México, CP 55119',''),
(4,'CECyT No. 4 \"Lázaro Cárdenas\"','Av. Constituyentes No. 813 Colonia Belem de las Flores, Alcaldía Álvaro Obregón CDMX, C.P. 01110',''),
(5,'CECyT No. 5 \"Benito Juárez\"','Emilio Donde 1, Colonia Centro, Centro, Cuauhtémoc, 06040 Ciudad de México, CDMX',''),
(6,'CECyT No. 6 \"Miguel Othón de Mendizábal\"','Calle 4 20, Col del Gas, Azcapotzalco, 02950 Ciudad de México, CDMX',''),
(7,'CECyT No. 7 \"Cuauhtémoc\"','Calzada Ermita Iztapalapa #3241 Col. Santa María Aztahuacán Ciudad de México CP. 09500',''),
(8,'CECyT No. 8 \"Narciso Bassols\"','Av. de las Granjas 618, Santo Tomas, Azcapotzalco, 02020 Ciudad de México, CDMX',''),
(9,'CECyT No. 9 \"Juan de Dios Bátiz\"','Mar Mediterráneo 227, Popotla, 11400 Ciudad de México, CDMX',''),
(10,'CECyT No. 10 \"Carlos Vallejo Márquez\"','Av. 508 s/n, Pueblo de San Juan de Aragón, Gustavo A. Madero, 07950 Ciudad de México, CDMX',''),
(11,'CECyT No. 11 \"Wilfrido Massieu\"','Av. de los Maestros No. 217, Miguel Hidalgo, Casco de Santo Tomás, 11340 Ciudad de México, CDMX',''),
(12,'CECyT No. 12 \"José María Morelos\"','Paseo de las Jacarandas 196, Santa María Insurgentes, 06430 Ciudad de México, CDMX',''),
(13,'CECyT No. 13 \"Ricardo Flores Magón\"','Calz Taxqueña 1620, Paseos de Taxqueña, Coyoacán, 04250 Ciudad de México, CDMX',''),
(14,'CECyT No. 14 \"Luis Enrique Erro\"','Peluqueros S/N, Michoacana, Gustavo A. Madero, 15240 Ciudad de México, CDMX',''),
(15,'CECyT No. 15 \"Diódoro Antúnez Echegaray\"','Calle Gastón Melo #41 Col. San Antonio Tecómitl, Milpa Alta.CP.12100, Ciudad de México.',''),
(16,'CECyT No. 16 \"Hidalgo\"','Kilómetro 1.500, Actopan - Pachuca, San Agustín Tlaxiaca, Hgo.',''),
(17,'CECyT No. 17 \"León, Guanajuato\"','Blvd. Calíope 1055 Parcela 179, Col. Las Joyas C.P. 37358, León de los Aldama, Guanajuato, México',''),
(18,'CECyT No. 18 \"Zacatecas\"','Blvrd El Bote S/N, 98160 Zacatecas, Zac.',''),
(19,'CECyT No. 19 \"Leona Vicario\"','Tecámac, Estado de México.','');

/*Table structure for table `escuela_has_formacion` */

DROP TABLE IF EXISTS `escuela_has_formacion`;

CREATE TABLE `escuela_has_formacion` (
  `id_escuela` int(11) NOT NULL,
  `id_formacion_tecnica` int(11) NOT NULL,
  KEY `FK1` (`id_escuela`),
  KEY `FK2` (`id_formacion_tecnica`),
  CONSTRAINT `FK1` FOREIGN KEY (`id_escuela`) REFERENCES `escuela` (`id_escuela`),
  CONSTRAINT `FK2` FOREIGN KEY (`id_formacion_tecnica`) REFERENCES `formacion_tecnica` (`id_formacion_tecnica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `escuela_has_formacion` */

/*Table structure for table `examen` */

DROP TABLE IF EXISTS `examen`;

CREATE TABLE `examen` (
  `id_examen` int(11) NOT NULL,
  `curp_alumno` varchar(16) NOT NULL,
  `aciertos` int(11) NOT NULL,
  PRIMARY KEY (`id_examen`),
  KEY `FK3` (`curp_alumno`),
  CONSTRAINT `FK3` FOREIGN KEY (`curp_alumno`) REFERENCES `alumno` (`curp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `examen` */

/*Table structure for table `formacion_tecnica` */

DROP TABLE IF EXISTS `formacion_tecnica`;

CREATE TABLE `formacion_tecnica` (
  `id_formacion_tecnica` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  PRIMARY KEY (`id_formacion_tecnica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `formacion_tecnica` */

/*Table structure for table `grupo` */

DROP TABLE IF EXISTS `grupo`;

CREATE TABLE `grupo` (
  `clave` varchar(4) NOT NULL,
  `horario` datetime NOT NULL,
  `cupo` int(11) NOT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `grupo` */

/*Table structure for table `programa_academico` */

DROP TABLE IF EXISTS `programa_academico`;

CREATE TABLE `programa_academico` (
  `id_programa_academico` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  PRIMARY KEY (`id_programa_academico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `programa_academico` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
