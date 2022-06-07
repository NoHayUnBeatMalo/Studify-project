-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2022 a las 15:49:10
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfg`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_USUARIO` (IN `USUARIO` VARCHAR(20))   SELECT 
usuarios.idusuario,
usuarios.nombre_usuario,
usuarios.nombre,
usuarios.apellidos,
usuarios.fecha_nacimiento,
usuarios.contrasena,
usuarios.correo,
usuarios.estado,
usuarios.rol_id,
rol.rol_id
FROM usuarios
INNER JOIN rol ON usuarios.rol_id = rol.rol_id
WHERE nombre_usuario = BINARY @USUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ST_LISTAR_ROL` ()   SELECT rol.rol_id,
rol.rol_nombre
FROM 
rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ST_MODIFICAR_ESTATUS_USUARIO` (IN `IDUSU` INT, IN `ESTATUS` VARCHAR(20))   UPDATE usuarios SET 
estado=ESTATUS
WHERE idusuario=IDUSU$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `idevento` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `color` varchar(20) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriascurso`
--

CREATE TABLE `categoriascurso` (
  `idcat` int(11) NOT NULL,
  `nombrecat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoriascurso`
--

INSERT INTO `categoriascurso` (`idcat`, `nombrecat`) VALUES
(1, 'Bases de datos'),
(2, 'Desarrollo de aplicaciones'),
(3, 'Php'),
(4, 'Javascript'),
(5, 'Uncategorized');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones`
--

CREATE TABLE `cupones` (
  `idcupon` int(11) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `limite` int(11) NOT NULL,
  `numdescuento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cupones`
--

INSERT INTO `cupones` (`idcupon`, `codigo`, `limite`, `numdescuento`) VALUES
(1, '65DC42', 10, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `cod_curso` int(11) NOT NULL,
  `cod_profesor` int(11) NOT NULL,
  `nombre_curso` varchar(35) NOT NULL,
  `descripcion` text NOT NULL,
  `horas_curso` int(11) NOT NULL,
  `precio_curso` float NOT NULL,
  `descuento` int(3) NOT NULL,
  `idcatfk` int(11) NOT NULL,
  `fechapublicacion` date NOT NULL,
  `participantes` int(11) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  `idimgfk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`cod_curso`, `cod_profesor`, `nombre_curso`, `descripcion`, `horas_curso`, `precio_curso`, `descuento`, `idcatfk`, `fechapublicacion`, `participantes`, `estado`, `idimgfk`) VALUES
(3, 1, 'Introducción a las bases de datos', 'Durante este curso conocerás las bases de datos más imporatntes que hay en el mercado actual', 80, 5.5, 35, 1, '2022-05-28', 1, 'ACTIVO', 1),
(4, 1, 'sad', '', 0, 0, 0, 5, '0000-00-00', 0, 'ACTIVO', 1),
(5, 1, 'sad', '', 5, 0, 0, 5, '0000-00-00', 0, 'ACTIVO', 1),
(6, 1, 'dsa', '', 5, 0, 0, 5, '0000-00-00', 0, 'ACTIVO', 1),
(7, 1, 'dddd', '', 80, 0, 0, 5, '0000-00-00', 0, 'ACTIVO', 1),
(8, 1, 'dddd', '', 80, 0, 0, 5, '0000-00-00', 0, 'ACTIVO', 1),
(9, 1, 'dddd', '', 80, 0, 0, 5, '0000-00-00', 0, 'ACTIVO', 1),
(10, 1, 'aaa', '', 6, 0.5, 0, 5, '0000-00-00', 0, 'ACTIVO', 1),
(11, 1, 'vava', '', 4, 0, 0, 5, '0000-00-00', 0, 'ACTIVO', 1),
(12, 1, 'lolo', '', 7, 0, 0, 5, '0000-00-00', 0, 'ACTIVO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_estudiante` int(11) NOT NULL,
  `id_usuario_estudiante` int(11) NOT NULL,
  `poblacion` varchar(20) NOT NULL,
  `codigo_postal` int(5) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `cod_curso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_estudiante`, `id_usuario_estudiante`, `poblacion`, `codigo_postal`, `provincia`, `telefono`, `cod_curso`) VALUES
(1, 15, 'Madrid', 21598, 'Madrid', '666666665', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `idimg` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `created` datetime NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `nombreproducto` varchar(200) NOT NULL,
  `descripcionproducto` text NOT NULL,
  `precioproducto` decimal(10,2) NOT NULL,
  `descuentoproducto` tinyint(3) NOT NULL DEFAULT 0,
  `id_categoriaproducto` int(11) NOT NULL,
  `estadoproducto` int(11) NOT NULL,
  `ownerproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `nombreproducto`, `descripcionproducto`, `precioproducto`, `descuentoproducto`, `id_categoriaproducto`, `estadoproducto`, `ownerproducto`) VALUES
(1, 'Curso Wordpress', 'Bienvenidos al curso de introducción a Wordpress', '100.00', 20, 1, 1, 1),
(2, 'Curso WooCommerce', 'Bienvenidos a la introducción a WooCommerce. Un plugin que te ayudará en el trabajo tedioso del día a día', '15.00', 0, 1, 1, 1),
(3, 'Curso PHP y bases de datos', 'Bienvenidos al curso de PHP. En este curso conocerás lo más importante sobre php y las bases de datos', '6.75', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `id_usuario_profesor` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `poblacion` varchar(20) NOT NULL,
  `codigo_postal` int(5) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `id_usuario_profesor`, `nombre`, `poblacion`, `codigo_postal`, `provincia`, `telefono`) VALUES
(1, 14, 'Carlos Bermudez Olsen', 'Madrid', 21598, 'Madrid', '666666666');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntosclave`
--

CREATE TABLE `puntosclave` (
  `idpclave` int(11) NOT NULL,
  `arraypc` varchar(255) NOT NULL,
  `estadopc` enum('COMPLETADO','NO COMPLETADO') NOT NULL,
  `id_usuario_pc` int(11) NOT NULL,
  `id_tarea_pc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntosclave`
--

INSERT INTO `puntosclave` (`idpclave`, `arraypc`, `estadopc`, `id_usuario_pc`, `id_tarea_pc`) VALUES
(1, 'manzanas, mandarinas, peras, melocotones, sa, como, asa, asdad', 'COMPLETADO', 14, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'INVITADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taskapp`
--

CREATE TABLE `taskapp` (
  `idtarea` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `estado` enum('SIN EMPEZAR','EN PROCESO','TERMINADO') NOT NULL,
  `puntosclave` int(11) DEFAULT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `taskapp`
--

INSERT INTO `taskapp` (`idtarea`, `name`, `description`, `estado`, `puntosclave`, `idusuario`) VALUES
(1, 'hola', 'sa', 'TERMINADO', 1, 14),
(3, 'civil', 'divorcio', 'SIN EMPEZAR', 1, 14),
(4, 'hola', 'sa', 'EN PROCESO', 1, 14),
(12, 'hola', 'sasadasdsadsadsacc dasfdsv adfavc ', 'SIN EMPEZAR', 2, 14),
(13, 'hola', 'sa', 'EN PROCESO', 1, 14),
(14, 'hola', 'sa', 'EN PROCESO', 1, 14),
(15, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(16, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(18, 'hola', 'sa', 'EN PROCESO', 1, 14),
(19, 'hola', 'esp', 'SIN EMPEZAR', 1, 14),
(20, 'as', 'as', 'SIN EMPEZAR', 1, 14),
(21, 'as', 'as', 'SIN EMPEZAR', 1, 14),
(22, 'as', 'as', 'SIN EMPEZAR', 1, 14),
(23, 'as', 'as', 'SIN EMPEZAR', 1, 14),
(24, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(25, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(26, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(27, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(28, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(29, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(30, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(31, 'asadadada', 'sdc ac', 'SIN EMPEZAR', 1, 14),
(32, 'hola', 'esp', 'SIN EMPEZAR', 1, 14),
(33, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(34, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(35, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(36, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(37, 'a vellll', 'llll', 'SIN EMPEZAR', 1, 14),
(38, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(39, 'prueba', 'PRUEB', 'SIN EMPEZAR', 1, 14),
(40, 'cuaren', 'tena', 'EN PROCESO', 1, 14),
(41, 'hola', 'sadsadsa', 'SIN EMPEZAR', 1, 14),
(42, 'dsadsad', 'adasda', 'SIN EMPEZAR', 1, 14),
(43, 'pru', 'pruuuuu', 'SIN EMPEZAR', NULL, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `idtema` int(11) NOT NULL,
  `titulotema` varchar(100) NOT NULL,
  `descripciontema` varchar(255) NOT NULL,
  `idcursotema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`idtema`, `titulotema`, `descripciontema`, `idcursotema`) VALUES
(1, 'Introduccion', 'Veremos los conceptos básicos de las bases de datos', 3),
(2, 'Bases de datos relacionales', 'Veremos una pequeña introducción a las bases de datos relacionales', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idtipo` int(11) NOT NULL,
  `nombre_tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idtipo`, `nombre_tipo`) VALUES
(1, 'ESTUDIANTE'),
(2, 'PROFESOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL,
  `rol_id` int(11) NOT NULL,
  `sexo` enum('MASCULINO','FEMENINO') NOT NULL,
  `tipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre_usuario`, `nombre`, `apellidos`, `fecha_nacimiento`, `contrasena`, `correo`, `estado`, `rol_id`, `sexo`, `tipo_id`) VALUES
(3, 'xxx', 'x', 'XXx', '0000-00-00', '$2y$12$Ednu0gvZveBmmgIRlPF00u2W4XwuB58sEnERlsJp09HNAOWIhpOEO', 'x@x.x', 'INACTIVO', 1, 'MASCULINO', 1),
(6, 'prueba', 'p', 'rueba', '0000-00-00', 'RkNlUlZkc0lFck9US3BWeGh3T1Nhdz09', 'vac@vacio.v', 'INACTIVO', 1, 'MASCULINO', 1),
(8, 'probandoregistrousu', 'register', 'user', '1988-05-12', '132', 'email@email.com', 'ACTIVO', 2, 'MASCULINO', 1),
(11, 'ffff', 'Aitor', 'Vázquez García', '4444-04-04', 'ZTVQWUNVb0NzTFk5UzdGQ2V5YW5Odz09', 'aitorvazgar@gmail.com', 'ACTIVO', 2, 'MASCULINO', 1),
(13, 'sd', 'sd', 'sd', '0004-04-04', 'NVorZjNGSzZFQkJSMmJ6SjZUMU1BQT09', 'sdaf@fsd.vp', 'ACTIVO', 2, 'MASCULINO', 1),
(14, 'ccc', 'cc', 'cccc', '2012-12-12', 'aGVXWUZkOXBiQTBnK3E0dW5kQkpHQT09', 'cc@c.c', 'ACTIVO', 2, 'MASCULINO', 1),
(15, 'sa', 'sa', 'sa', '1999-04-05', 'L3dwY1IyYTNISnVSaVY0QUJJVHltZz09', 'sa@sa.sa', 'ACTIVO', 2, 'MASCULINO', 1),
(16, 'as', 'sa', 'as', '2007-07-07', 'YmxiU3pYVUh3NzVSVDNjZFN5THd6UT09', 'AS@as.c', 'ACTIVO', 2, 'MASCULINO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`idevento`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `categoriascurso`
--
ALTER TABLE `categoriascurso`
  ADD PRIMARY KEY (`idcat`);

--
-- Indices de la tabla `cupones`
--
ALTER TABLE `cupones`
  ADD PRIMARY KEY (`idcupon`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cod_curso`),
  ADD KEY `cod_profesor` (`cod_profesor`),
  ADD KEY `idcatfk` (`idcatfk`),
  ADD KEY `idimgfk` (`idimgfk`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD KEY `id_usuario_estudiante` (`id_usuario_estudiante`),
  ADD KEY `cod_curso` (`cod_curso`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`idimg`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `id_categoriaproducto` (`id_categoriaproducto`),
  ADD KEY `ownerproducto` (`ownerproducto`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`),
  ADD KEY `id_usuario_profesor` (`id_usuario_profesor`);

--
-- Indices de la tabla `puntosclave`
--
ALTER TABLE `puntosclave`
  ADD PRIMARY KEY (`idpclave`),
  ADD KEY `id_usuario_pc` (`id_usuario_pc`),
  ADD KEY `id_tarea_pc` (`id_tarea_pc`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `taskapp`
--
ALTER TABLE `taskapp`
  ADD PRIMARY KEY (`idtarea`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `puntosclave` (`puntosclave`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`idtema`),
  ADD KEY `idcursotema` (`idcursotema`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `idevento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `categoriascurso`
--
ALTER TABLE `categoriascurso`
  MODIFY `idcat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cupones`
--
ALTER TABLE `cupones`
  MODIFY `idcupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `cod_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `idimg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `puntosclave`
--
ALTER TABLE `puntosclave`
  MODIFY `idpclave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `taskapp`
--
ALTER TABLE `taskapp`
  MODIFY `idtarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `idtema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idtipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`cod_profesor`) REFERENCES `profesores` (`id_profesor`),
  ADD CONSTRAINT `curso_ibfk_3` FOREIGN KEY (`idcatfk`) REFERENCES `categoriascurso` (`idcat`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_2` FOREIGN KEY (`id_usuario_estudiante`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`id_usuario_profesor`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `profesores_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `productos` (`ownerproducto`);

--
-- Filtros para la tabla `puntosclave`
--
ALTER TABLE `puntosclave`
  ADD CONSTRAINT `puntosclave_ibfk_1` FOREIGN KEY (`id_usuario_pc`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `puntosclave_ibfk_2` FOREIGN KEY (`id_tarea_pc`) REFERENCES `taskapp` (`idtarea`);

--
-- Filtros para la tabla `taskapp`
--
ALTER TABLE `taskapp`
  ADD CONSTRAINT `taskapp_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`idcursotema`) REFERENCES `curso` (`cod_curso`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`tipo_id`) REFERENCES `tipousuario` (`idtipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
