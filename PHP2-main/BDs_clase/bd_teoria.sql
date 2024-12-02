-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-01-2024 a las 13:08:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_teoria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_alumnos`
--

CREATE TABLE `t_alumnos` (
  `cod_alu` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `telefono` int(11) NOT NULL,
  `cp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `t_alumnos`
--

INSERT INTO `t_alumnos` (`cod_alu`, `nombre`, `telefono`, `cp`) VALUES
(100, 'MARÍA RODRÍGUEZ', 123456789, 23965),
(102, 'YUMI VALLEJO', 564987321, 75623),
(144, 'EDUARDO', 987654321, 29854);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_asignaturas`
--

CREATE TABLE `t_asignaturas` (
  `cod_asig` int(11) NOT NULL,
  `denominacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `t_asignaturas`
--

INSERT INTO `t_asignaturas` (`cod_asig`, `denominacion`) VALUES
(50, 'DESARROLLO WEB EN ENTORNO SERVIDOR'),
(59, 'DESARROLLO WEB EN ENTORNO CLIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_notas`
--

CREATE TABLE `t_notas` (
  `cod_alu` int(11) NOT NULL,
  `cod_asig` int(11) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `t_notas`
--

INSERT INTO `t_notas` (`cod_alu`, `cod_asig`, `nota`) VALUES
(100, 50, 8),
(100, 59, 6),
(102, 50, 9),
(102, 59, 7),
(144, 50, 9),
(144, 59, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_alumnos`
--
ALTER TABLE `t_alumnos`
  ADD PRIMARY KEY (`cod_alu`);

--
-- Indices de la tabla `t_asignaturas`
--
ALTER TABLE `t_asignaturas`
  ADD PRIMARY KEY (`cod_asig`);

--
-- Indices de la tabla `t_notas`
--
ALTER TABLE `t_notas`
  ADD PRIMARY KEY (`cod_alu`,`cod_asig`),
  ADD KEY `cod_asig` (`cod_asig`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_notas`
--
ALTER TABLE `t_notas`
  ADD CONSTRAINT `t_notas_ibfk_1` FOREIGN KEY (`cod_alu`) REFERENCES `t_alumnos` (`cod_alu`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `t_notas_ibfk_2` FOREIGN KEY (`cod_asig`) REFERENCES `t_asignaturas` (`cod_asig`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
