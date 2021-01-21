DROP DATABASE sistema_registro;

CREATE DATABASE sistema_registro;

USE sistema_registro;

--
-- Base de datos: `sistema_registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `curp` varchar(18) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 NOT NULL,
  `primer_apellido` varchar(30) CHARACTER SET utf8 NOT NULL,
  `segundo_apellido` varchar(30) CHARACTER SET utf8 NOT NULL,
  `genero` char(1) CHARACTER SET utf8 NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(320) CHARACTER SET utf8 NOT NULL,
  `telefono_celular` varchar(13) CHARACTER SET utf8 NOT NULL,
  `telefono_casa` varchar(13) CHARACTER SET utf8 DEFAULT NULL,
  `direccion` varchar(500) CHARACTER SET utf8 NOT NULL,
  `contrasena` varchar(32) CHARACTER SET utf8,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_has_escuela`
--

CREATE TABLE `alumno_has_escuela` (
  `curp_alumno` varchar(18) CHARACTER SET utf8 NOT NULL,
  `id_escuela` int(11) NOT NULL,
  `id_formacion_tecnica` int(11) DEFAULT NULL,
  `promedio` varchar(4) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_has_grupo`
--

CREATE TABLE `alumno_has_grupo` (
  `curp_alumno` varchar(18) CHARACTER SET utf8 NOT NULL,
  `clave_grupo` varchar(8) CHARACTER SET utf8 NOT NULL,
  `aciertos` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_has_programa`
--

CREATE TABLE `alumno_has_programa` (
  `curp_alumno` varchar(18) CHARACTER SET utf8 NOT NULL,
  `semestre` varchar(10) CHARACTER SET utf8 NOT NULL,
  `id_programa_academico` int(11) NOT NULL,
  `opcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

CREATE TABLE `escuela` (
  `id_escuela` int(11) NOT NULL,
  `nombre` varchar(70) CHARACTER SET utf8 NOT NULL,
  `localidad` varchar(500) CHARACTER SET utf8 NOT NULL,
  `tipo` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`id_escuela`, `nombre`, `localidad`, `tipo`) VALUES
(1, 'CET 1 \"Walter Cross Buchanan\"', 'Av. 661 S/N, F0VISSTE Aragón, San Juan de Aragón V Secc, Gustavo A. Madero, 07920 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(2, 'CECyT No. 1 \"Gonzalo Vázquez Vela\"', 'Av. 510 Nº 1000 Col. Ejidos de Aragón, Alcaldía Gustavo A. Madero, C.P. 07480, Ciudad de México.', 'Bachillerato Técnico'),
(3, 'CECyT No. 2 \"Miguel Bernard\"', 'Av. Nueva Casa de la Moneda 133, Lomas de Sotelo, Panteón Frances, 11200 Miguel Hidalgo, CDMX', 'Bachillerato Técnico'),
(4, 'CECyT No. 3 \"Estanislao Ramírez Ruiz\"', 'Av. Carlos Hank González s/n, Col. Valle de Ecatepec, Ecatepec de Morelos, Edo. de México, CP 55119', 'Bachillerato Técnico'),
(5, 'CECyT No. 4 \"Lázaro Cárdenas\"', 'Av. Constituyentes No. 813 Colonia Belem de las Flores, Alcaldía Álvaro Obregón CDMX, C.P. 01110', 'Bachillerato Técnico'),
(6, 'CECyT No. 5 \"Benito Juárez\"', 'Emilio Donde 1, Colonia Centro, Centro, Cuauhtémoc, 06040 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(7, 'CECyT No. 6 \"Miguel Othón de Mendizábal\"', 'Calle 4 20, Col del Gas, Azcapotzalco, 02950 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(8, 'CECyT No. 7 \"Cuauhtémoc\"', 'Calzada Ermita Iztapalapa #3241 Col. Santa María Aztahuacán Ciudad de México CP. 09500', 'Bachillerato Técnico'),
(9, 'CECyT No. 8 \"Narciso Bassols\"', 'Av. de las Granjas 618, Santo Tomas, Azcapotzalco, 02020 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(10, 'CECyT No. 9 \"Juan de Dios Bátiz\"', 'Mar Mediterráneo 227, Popotla, 11400 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(11, 'CECyT No. 10 \"Carlos Vallejo Márquez\"', 'Av. 508 s/n, Pueblo de San Juan de Aragón, Gustavo A. Madero, 07950 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(12, 'CECyT No. 11 \"Wilfrido Massieu\"', 'Av. de los Maestros No. 217, Miguel Hidalgo, Casco de Santo Tomás, 11340 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(13, 'CECyT No. 12 \"José María Morelos\"', 'Paseo de las Jacarandas 196, Santa María Insurgentes, 06430 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(14, 'CECyT No. 13 \"Ricardo Flores Magón\"', 'Calz Taxqueña 1620, Paseos de Taxqueña, Coyoacán, 04250 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(15, 'CECyT No. 14 \"Luis Enrique Erro\"', 'Peluqueros S/N, Michoacana, Gustavo A. Madero, 15240 Ciudad de México, CDMX', 'Bachillerato Técnico'),
(16, 'CECyT No. 15 \"Diódoro Antúnez Echegaray\"', 'Calle Gastón Melo #41 Col. San Antonio Tecómitl, Milpa Alta.CP.12100, Ciudad de México.', 'Bachillerato Técnico'),
(17, 'CECyT No. 16 \"Hidalgo\"', 'Kilómetro 1.500, Actopan - Pachuca, San Agustín Tlaxiaca, Hgo.', 'Bachillerato Técnico'),
(18, 'CECyT No. 17 \"León, Guanajuato\"', 'Blvd. Calíope 1055 Parcela 179, Col. Las Joyas C.P. 37358, León de los Aldama, Guanajuato, México', 'Bachillerato Técnico'),
(19, 'CECyT No. 18 \"Zacatecas\"', 'Blvrd El Bote S/N, 98160 Zacatecas, Zac.', 'Bachillerato Técnico'),
(20, 'CECyT No. 19 \"Leona Vicario\"', 'Tecámac, Estado de México.', 'Bachillerato Técnico'),
(21, 'Otra', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela_has_formacion`
--

CREATE TABLE `escuela_has_formacion` (
  `id_escuela` int(11) NOT NULL,
  `id_formacion_tecnica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `escuela_has_formacion`
--

INSERT INTO `escuela_has_formacion` (`id_escuela`, `id_formacion_tecnica`) VALUES
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(4, 6),
(4, 13),
(4, 12),
(4, 4),
(4, 5),
(5, 6),
(5, 1),
(5, 15),
(5, 3),
(5, 12),
(6, 16),
(6, 17),
(6, 18),
(7, 19),
(7, 20),
(7, 21),
(7, 22),
(7, 23),
(7, 24),
(8, 6),
(8, 1),
(8, 25),
(8, 15),
(8, 26),
(8, 27),
(8, 12),
(9, 13),
(9, 26),
(9, 28),
(9, 12),
(10, 29),
(10, 30),
(10, 9),
(10, 10),
(10, 31),
(10, 5),
(11, 32),
(11, 10),
(11, 33),
(11, 34),
(12, 1),
(12, 25),
(12, 15),
(12, 3),
(12, 34),
(13, 35),
(13, 17),
(13, 18),
(13, 36),
(2, 10),
(14, 35),
(14, 2),
(14, 17),
(14, 37),
(14, 38),
(14, 18),
(15, 39),
(15, 17),
(15, 18),
(15, 40),
(15, 36),
(16, 41),
(16, 21),
(16, 23),
(16, 42),
(17, 26),
(17, 9),
(17, 3),
(17, 20),
(17, 21),
(17, 35),
(17, 16),
(18, 6),
(18, 33),
(18, 12),
(18, 41),
(18, 2),
(18, 16),
(19, 5),
(19, 22),
(20, 6),
(20, 1),
(20, 41),
(1, 43),
(1, 44),
(1, 12),
(1, 45),
(1, 46),
(1, 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacion_tecnica`
--

CREATE TABLE `formacion_tecnica` (
  `id_formacion_tecnica` int(11) NOT NULL,
  `nombre` varchar(70) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `formacion_tecnica`
--

INSERT INTO `formacion_tecnica` (`id_formacion_tecnica`, `nombre`) VALUES
(1, 'Técnico en Construcción'),
(2, 'Técnico en Administración de Empresas Turísticas'),
(3, 'Técnico en Procesos Industriales'),
(4, 'Técnico en Sistemas de Control Eléctrico'),
(5, 'Técnico en Sistemas Digitales'),
(6, 'Técnico en Aeronáutica'),
(7, 'Técnico en Dibujo Asistido por Computadora'),
(8, 'Técnico en Diseño Gráfico Digital'),
(9, 'Técnico en Máquinas con Sistemas Automatizados'),
(10, 'Técnico en Mecatrónica'),
(11, 'Técnico en Metalurgia'),
(12, 'Técnico en Sistemas Automotrices'),
(13, 'Técnico en Computación'),
(14, 'Técnico en Manufactura Asistida por Computadora'),
(15, 'Técnico en Instalaciones y Mantenimiento Eléctrico'),
(16, 'Técnico en Comercio Internacional'),
(17, 'Técnico en Contaduría'),
(18, 'Técnico en Informática'),
(19, 'Técnico en Ecología'),
(20, 'Técnico en Enfermería'),
(21, 'Técnico en Laboratorista Clínico'),
(22, 'Técnico en Laboratorista Químico'),
(23, 'Técnico en Nutrición Humana'),
(24, 'Técnico Químico Farmacéutico'),
(25, 'Técnico en Energía Sustentable'),
(26, 'Técnico en Mantenimiento Industrial'),
(27, 'Técnico en Soldadura Industrial'),
(28, 'Técnico en Plásticos'),
(29, 'Bachillerato General Polivirtual'),
(30, 'Técnico en Desarrollo de Software'),
(31, 'Técnico en Programación'),
(32, 'Técnico en Diagnóstico y Mejoramiento Ambiental'),
(33, 'Técnico en Metrología y Control de Calidad'),
(34, 'Técnico en Telecomunicaciones'),
(35, 'Técnico en Administración'),
(36, 'Técnico en Mercadotecnia Digital'),
(37, 'Técnico en Gastronomía'),
(38, 'Técnico en Gestión de la Ciberseguridad'),
(39, 'Técnico en Administración de Recursos Humanos'),
(40, 'Técnico en Mercadotecnia'),
(41, 'Técnico en Alimentos'),
(42, 'Técnico en Sustentabilidad'),
(43, 'Técnico en Automatización y Control Eléctrico Industrial'),
(44, 'Técnico en Redes de Cómputo'),
(45, 'Técnico en Sistemas Computacionales'),
(46, 'Técnico en Sistemas Constructivos Asistidos por Computadora'),
(47, 'Técnico en Sistemas Mecánicos Industriales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `clave` varchar(8) CHARACTER SET utf8 NOT NULL,
  `horario` datetime NOT NULL,
  `cupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`clave`, `horario`, `cupo`) VALUES
('1101-00', '2021-02-22 10:00:00', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_academico`
--

CREATE TABLE `programa_academico` (
  `id_programa_academico` int(11) NOT NULL,
  `nombre` varchar(70) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `programa_academico`
--

INSERT INTO `programa_academico` (`id_programa_academico`, `nombre`) VALUES
(1, 'Ing. en Sistemas Computacionales'),
(2, 'Ing. en Inteligencia Artificial'),
(3, 'Lic. en Ciencia de Datos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`curp`);

--
-- Indices de la tabla `alumno_has_escuela`
--
ALTER TABLE `alumno_has_escuela`
  ADD KEY `FK6` (`curp_alumno`),
  ADD KEY `FK7` (`id_escuela`),
  ADD KEY `Fk8` (`id_formacion_tecnica`);

--
-- Indices de la tabla `alumno_has_grupo`
--
ALTER TABLE `alumno_has_grupo`
  ADD KEY `FK5` (`clave_grupo`),
  ADD KEY `FK4` (`curp_alumno`);

--
-- Indices de la tabla `alumno_has_programa`
--
ALTER TABLE `alumno_has_programa`
  ADD KEY `FK9` (`curp_alumno`),
  ADD KEY `FK10` (`id_programa_academico`);

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`id_escuela`);

--
-- Indices de la tabla `escuela_has_formacion`
--
ALTER TABLE `escuela_has_formacion`
  ADD KEY `FK1` (`id_escuela`),
  ADD KEY `FK2` (`id_formacion_tecnica`);

--
-- Indices de la tabla `formacion_tecnica`
--
ALTER TABLE `formacion_tecnica`
  ADD PRIMARY KEY (`id_formacion_tecnica`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `programa_academico`
--
ALTER TABLE `programa_academico`
  ADD PRIMARY KEY (`id_programa_academico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `escuela`
--
ALTER TABLE `escuela`
  MODIFY `id_escuela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `formacion_tecnica`
--
ALTER TABLE `formacion_tecnica`
  MODIFY `id_formacion_tecnica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `programa_academico`
--
ALTER TABLE `programa_academico`
  MODIFY `id_programa_academico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno_has_escuela`
--
ALTER TABLE `alumno_has_escuela`
  ADD CONSTRAINT `FK6` FOREIGN KEY (`curp_alumno`) REFERENCES `alumno` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK7` FOREIGN KEY (`id_escuela`) REFERENCES `escuela` (`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk8` FOREIGN KEY (`id_formacion_tecnica`) REFERENCES `formacion_tecnica` (`id_formacion_tecnica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumno_has_grupo`
--
ALTER TABLE `alumno_has_grupo`
  ADD CONSTRAINT `FK4` FOREIGN KEY (`curp_alumno`) REFERENCES `alumno` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK5` FOREIGN KEY (`clave_grupo`) REFERENCES `grupo` (`clave`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumno_has_programa`
--
ALTER TABLE `alumno_has_programa`
  ADD CONSTRAINT `FK10` FOREIGN KEY (`id_programa_academico`) REFERENCES `programa_academico` (`id_programa_academico`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK9` FOREIGN KEY (`curp_alumno`) REFERENCES `alumno` (`curp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `escuela_has_formacion`
--
ALTER TABLE `escuela_has_formacion`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`id_escuela`) REFERENCES `escuela` (`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2` FOREIGN KEY (`id_formacion_tecnica`) REFERENCES `formacion_tecnica` (`id_formacion_tecnica`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Update todo a mayusculas
UPDATE escuela SET nombre = upper(nombre), localidad = upper(localidad), tipo = upper(tipo);
UPDATE formacion_tecnica SET nombre = upper(nombre);
UPDATE programa_academico SET nombre = upper(nombre);

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(70) CHARACTER SET utf8 NOT NULL,
  `contrasena` VARCHAR(32)  CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `admin` (`usuario`, `contrasena`) VALUES
('admin', '123');

-- Tablas para la administración de horas y grupos

CREATE TABLE `dia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `dia` (`fecha`) VALUES
('2021-02-22'), ('2021-02-23'), ('2021-02-24');

CREATE TABLE `horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hora` VARCHAR(8) UNIQUE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `horario` (`hora`) VALUES
("10:00:00"), ("12:00:00"), ("14:00:00"), ("16:00:00")

CREATE TABLE `edificio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edificio` VARCHAR(4) UNIQUE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `edificio` (`edificio`) VALUES
("1101"), ("1102"), ("1103"), ("1104"), ("1105");
