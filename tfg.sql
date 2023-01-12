-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2022 a las 16:19:09
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.15

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_USUARIO` (IN `USUARIO` VARCHAR(20))  SELECT 
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `ST_LISTAR_ROL` ()  SELECT rol.rol_id,
rol.rol_nombre
FROM 
rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ST_LISTAR_TIPO_USU` ()  SELECT tipousuario.idtipo, tipousuario.nombre_tipo FROM tipousuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ST_MODIFICAR_ESTATUS_USUARIO` (IN `IDUSU` INT, IN `ESTATUS` VARCHAR(20))  UPDATE usuarios SET 
estado=ESTATUS
WHERE idusuario=IDUSU$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `cod_curso` int(11) NOT NULL,
  `cod_profesor` int(11) NOT NULL,
  `nombre_curso` varchar(35) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_curso` float NOT NULL,
  `descuento` int(3) NOT NULL,
  `fechapublicacion` date NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  `fechacurso` date NOT NULL DEFAULT '2022-06-25'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`cod_curso`, `cod_profesor`, `nombre_curso`, `descripcion`, `precio_curso`, `descuento`, `fechapublicacion`, `estado`, `fechacurso`) VALUES
(3, 1, 'Introducción a las bases de datos', 'Durante este curso conocerás las bases de datos más imporatntes que hay en el mercado actual', 5.5, 35, '2022-05-28', 'ACTIVO', '2022-06-11'),
(4, 1, 'sad', '', 0, 0, '0000-00-00', 'ACTIVO', '2022-06-25'),
(5, 1, 'sad', '', 0, 0, '0000-00-00', 'ACTIVO', '2022-06-24'),
(6, 1, 'dsa', 'aaaaaaaa', 0, 0, '0000-00-00', 'ACTIVO', '2022-06-25'),
(7, 1, 'dddd', '', 0, 0, '0000-00-00', 'ACTIVO', '2022-06-25'),
(8, 1, 'dddd', 'eeeeeee', 0, 0, '0000-00-00', 'ACTIVO', '2022-06-25'),
(9, 1, 'dddd', '', 0, 0, '0000-00-00', 'ACTIVO', '2022-06-25'),
(10, 1, 'aaa', '', 0.5, 0, '0000-00-00', 'ACTIVO', '2022-06-25'),
(11, 1, 'vava', '', 0, 0, '0000-00-00', 'ACTIVO', '2022-06-25'),
(12, 1, 'lolo', 'Añadir descripcion', 0, 0, '0000-00-00', 'ACTIVO', '2022-06-25'),
(13, 1, 'Un nombre de curso', 'Una descripcion sencilla del curso\n                                ', 0, 0, '2022-06-09', 'ACTIVO', '0000-00-00'),
(14, 1, 'Otro nombre de curso', 'Una descripcion sencilla', 0, 0, '2022-06-09', 'ACTIVO', '0000-00-00'),
(15, 1, 'Un nombre de curso', 'A', 0, 0, '2022-06-09', 'ACTIVO', '0000-00-00'),
(16, 1, 'Un nombre de curso', 'A\n                                ', 0, 0, '2022-06-09', 'ACTIVO', '2022-06-17');

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
(1, 15, 'Alcorcón', 20015, 'Madrid', '666111666', '3');

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
(1, 14, 'Carlos Bermudez Olsen', 'Madrid', 21598, 'Madrid', '666666666'),
(2, 11, 'Aitor Vázquez García', 'Fuenlabrada', 28941, 'Madrid', '634583869'),
(3, 13, 'Roberto Fernandez Plaza', 'Alcorcon', 28939, 'Madrid', '688956741'),
(4, 13, '', '', 0, '', ''),
(5, 8, 'Javier Santolaya', 'Mostoles', 24587, 'Madrid', '655889944'),
(6, 6, 'David Suarez Benavente', 'Leganes', 25889, 'Madrid', '645782854'),
(7, 3, 'Jordi Hernandez Fuentes', 'Barcelona', 23556, 'Barcelona', '646464646'),
(8, 15, 'Alberto Duro Cardenas', 'Madrid', 25555, 'Madrid', '648858544'),
(9, 16, 'Aitor Vázquez García', 'Fuenlabrada', 28941, 'Madrid', '634583869');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntosclave`
--

CREATE TABLE `puntosclave` (
  `idpuntosclave` int(11) NOT NULL,
  `fk_idpuntoclave_fk` int(11) NOT NULL,
  `puntoclave` varchar(255) NOT NULL,
  `idtarea_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntosclave`
--

INSERT INTO `puntosclave` (`idpuntosclave`, `fk_idpuntoclave_fk`, `puntoclave`, `idtarea_fk`) VALUES
(1, 1, 'manzana', 61);

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
(12, 'hola', 'sasadasdsadsadsacc dasfdsv adfavc ', 'SIN EMPEZAR', 1, 14),
(13, 'hola', 'sa', 'EN PROCESO', 1, 14),
(14, 'hola', 'sa', 'EN PROCESO', 1, 14),
(15, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(16, 'hola', 'sa', 'SIN EMPEZAR', 1, 14),
(19, 'hola', 'esp', 'SIN EMPEZAR', 1, 14),
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
(43, 'pru', 'pruuuuu', 'SIN EMPEZAR', 1, 14),
(46, 'sa', 'sas', 'SIN EMPEZAR', 1, 14),
(47, 'ssss', 'sss', 'SIN EMPEZAR', 1, 14),
(61, 'probando', 'probar', 'SIN EMPEZAR', 1, 65),
(62, 'a ver como funciona', 'f\n', 'SIN EMPEZAR', 1, 65);

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
  `tipo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre_usuario`, `nombre`, `apellidos`, `fecha_nacimiento`, `contrasena`, `correo`, `estado`, `rol_id`, `sexo`, `tipo_id`) VALUES
(3, 'xxx', 'x', 'XXx', '2022-06-17', '$2y$12$Ednu0gvZveBmmgIRlPF00u2W4XwuB58sEnERlsJp09HNAOWIhpOEO', 'x@x.x', 'ACTIVO', 2, 'MASCULINO', 2),
(6, 'prueba', 'p', 'rueba', '2022-06-11', 'RkNlUlZkc0lFck9US3BWeGh3T1Nhdz09', 'vac@vacio.v', 'ACTIVO', 2, 'FEMENINO', 2),
(8, 'probandoregistrousu', 'register', 'user', '1988-05-12', '132', 'email@email.com', 'ACTIVO', 2, 'MASCULINO', 2),
(11, 'ffff', 'Aitor', 'Vázquez García', '4444-04-04', 'ZTVQWUNVb0NzTFk5UzdGQ2V5YW5Odz09', 'aitorvazgar@gmail.com', 'ACTIVO', 2, 'MASCULINO', 2),
(13, 'sd', 'sd', 'sd', '0004-04-04', 'NVorZjNGSzZFQkJSMmJ6SjZUMU1BQT09', 'sdaf@fsd.vp', 'INACTIVO', 2, 'MASCULINO', 2),
(14, 'ccc', 'Aitorrrrrrrrrrr', 'cccc', '2012-12-12', 'aGVXWUZkOXBiQTBnK3E0dW5kQkpHQT09', 'cc@c.c', 'ACTIVO', 1, 'MASCULINO', 1),
(15, 'sa', 'sa', 'sa', '1999-04-05', 'L3dwY1IyYTNISnVSaVY0QUJJVHltZz09', 'sa@sa.sa', 'INACTIVO', 2, 'MASCULINO', 2),
(16, 'as', 'sa', 'as', '2007-07-07', 'YmxiU3pYVUh3NzVSVDNjZFN5THd6UT09', 'AS@as.c', 'INACTIVO', 2, 'MASCULINO', 1),
(20, 'ddd', 'dd', 'ddd ddd', '2022-06-23', 'VGVndlFUcGNvR0g3VDIrUnh3NzBhUT09', 'dsad@fds.vpff', 'ACTIVO', 2, 'MASCULINO', 1),
(31, 'sadfsfdsds', 'fdsa', 'dsadfds', '2022-06-11', 'NVorZjNGSzZFQkJSMmJ6SjZUMU1BQT09', 'dsaf@fdsdf.vv', 'ACTIVO', 2, 'MASCULINO', 1),
(34, 'atr', 'atr', 'vzquez', '2022-06-24', 'MUl0dFVCRmtzZ3Z5d2h6RWQ5Smd0UT09', 'atr@vzq.com', 'ACTIVO', 2, 'MASCULINO', 1),
(35, 'vvv', 'vvv', 'vvv', '2022-06-01', 'eWh3UmxoSE9ac00xR2gzSWNXekk2dz09', 'vvv@vvv.com', 'ACTIVO', 2, 'MASCULINO', 1),
(36, 'lll', 'lll', 'lll', '2022-06-09', 'UUgyRkVoakN2Unk3UUJqVHZ5SDRHdz09', 'll@lll.com', 'ACTIVO', 2, 'MASCULINO', 1),
(39, 'xxxx', 'xx', 'xxxx xxx', '0000-00-00', 'xxx', 'xx@xx.xxx', 'INACTIVO', 2, 'MASCULINO', 1),
(41, 'usuprueba1', 'Castillejos', 'de la vega ', '2022-11-03', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'castidela@gmail.com', 'ACTIVO', 1, 'FEMENINO', 1),
(42, 'usuprueba2', 'Albahama', 'ice', '2000-03-18', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'albahamaice@ice.com', 'ACTIVO', 1, 'MASCULINO', 1),
(44, 'usuprueba3', 'co', 'lorado', '2022-11-03', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'rmaaaamddmmdd@gmail.com', 'ACTIVO', 1, 'FEMENINO', 1),
(45, 'pruebaprueba', 'prueba', 'de edicion', '2022-11-03', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'prueba@edicion.user', 'ACTIVO', 1, 'FEMENINO', 1),
(46, 'usuprueba-def', 'defi', 'nitiva', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'definitiva@edicion.com', 'ACTIVO', 1, 'FEMENINO', 1),
(47, 'otraprueba', 'otra', 'prueba', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'otra@mas.com', 'ACTIVO', 1, 'MASCULINO', 1),
(48, 'ymas', 'a ver si edita', 'en el ajax de datatable', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'prueba@pru.com', 'ACTIVO', 1, 'FEMENINO', 1),
(49, 'avellll', 'aaaaaaaaa', 'vellllll', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'avel@avel.com', 'ACTIVO', 1, 'MASCULINO', 1),
(50, 'veremos', 'a ver', 'si sale', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'veremos@sisale.com', 'ACTIVO', 1, 'MASCULINO', 1),
(51, 'tendra', 'que', 'salir', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'tendra@quesalir.com', 'ACTIVO', 1, 'MASCULINO', 1),
(53, 'tendraaaas', 'que', 'salir', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'tessndra@quesalir.com', 'ACTIVO', 1, 'MASCULINO', 1),
(54, 'nose', 'nnn', 'oooo', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'nnnnsss@ns.com', 'ACTIVO', 1, 'MASCULINO', 1),
(56, 'sssssssaaaaaaaasddda', 'nnn', 'oooo', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'nnnnssdsadsass@ns.com', 'ACTIVO', 1, 'MASCULINO', 1),
(57, 'nuevousu', 'nuevo', 'usu', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'nuevousu@usu.com', 'ACTIVO', 1, 'MASCULINO', 1),
(58, 'usuprueban15', 'prruuuu', 'uhubdius', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'dnnnnncasnn@nidshb.com', 'ACTIVO', 1, 'MASCULINO', 1),
(59, 'sdfffff', 'sfdk', 'kdfs', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'ddd@s.com', 'ACTIVO', 1, 'MASCULINO', 1),
(60, 'sdaibudb', 'ibdciub', 'jbdibs', '2022-11-04', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'gggmm@gmmm.com', 'ACTIVO', 1, 'MASCULINO', 1),
(61, 'hvhhh', 'hhhhdws', 'hhdh', '2000-02-22', 'eXdTV1A4RVJVTFY4aFprNmcxdk0wUT09', 'nnnncc@ccn.com', 'ACTIVO', 1, 'MASCULINO', 1),
(62, 'suuu', 'elbicho', 'cr7', '2022-11-13', 'VCtnVzluU1RFb1hBSDFMLzRMN1pNUT09', 'cr7@elbicho.suu', 'INACTIVO', 2, 'MASCULINO', 1),
(63, 'aaa', 'aaa', 'aaa', '2022-11-02', 'ZkVMck9hQnpWSzZmdWdPTGpNVmswUT09', 'aaa@a.a', 'ACTIVO', 1, 'FEMENINO', 1),
(65, 'aitor', 'aitor', 'aitor', '2022-11-05', 'NHZvdWZkVXdac29JK2hwdUZpOTJJQT09', 'aiittoorr@atr.atr', 'ACTIVO', 2, 'MASCULINO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cod_curso`),
  ADD KEY `cod_profesor` (`cod_profesor`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD KEY `id_usuario_estudiante` (`id_usuario_estudiante`),
  ADD KEY `cod_curso` (`cod_curso`);

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
  ADD PRIMARY KEY (`idpuntosclave`),
  ADD KEY `fk_idpuntoclave_fk` (`fk_idpuntoclave_fk`),
  ADD KEY `idtarea_fk` (`idtarea_fk`);

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
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `cod_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `puntosclave`
--
ALTER TABLE `puntosclave`
  MODIFY `idpuntosclave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `taskapp`
--
ALTER TABLE `taskapp`
  MODIFY `idtarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`cod_profesor`) REFERENCES `profesores` (`id_profesor`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_2` FOREIGN KEY (`id_usuario_estudiante`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`id_usuario_profesor`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `puntosclave`
--
ALTER TABLE `puntosclave`
  ADD CONSTRAINT `puntosclave_ibfk_1` FOREIGN KEY (`idtarea_fk`) REFERENCES `taskapp` (`idtarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `taskapp`
--
ALTER TABLE `taskapp`
  ADD CONSTRAINT `taskapp_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `taskapp_ibfk_2` FOREIGN KEY (`puntosclave`) REFERENCES `puntosclave` (`fk_idpuntoclave_fk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`idcursotema`) REFERENCES `curso` (`cod_curso`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`),
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`tipo_id`) REFERENCES `tipousuario` (`idtipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
