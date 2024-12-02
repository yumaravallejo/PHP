-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-01-2024 a las 13:07:56
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
-- Base de datos: `bd_horarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre`) VALUES
(1, '1DAW'),
(2, '2DAW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_lectivo`
--

CREATE TABLE `horario_lectivo` (
  `id_horario` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `dia` int(1) NOT NULL,
  `hora` int(2) NOT NULL,
  `grupo` int(11) NOT NULL,
  `aula` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `horario_lectivo`
--

INSERT INTO `horario_lectivo` (`id_horario`, `usuario`, `dia`, `hora`, `grupo`, `aula`) VALUES
(1, 2, 2, 1, 1, '104'),
(2, 2, 4, 2, 2, '103'),
(3, 1, 3, 4, 1, '234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `clave`, `email`) VALUES
(1, 'Nerea López', 'nerea', '2c3d27e49a23fb4bc49b515ae6e1548c', 'nerea@inventado.es'),
(2, 'Eduardo', 'edu', '379ef4bd50c30e261ccfb18dfc626d9f', 'edu@inventado.es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `horario_lectivo`
--
ALTER TABLE `horario_lectivo`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `grupo` (`grupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horario_lectivo`
--
ALTER TABLE `horario_lectivo`
  ADD CONSTRAINT `horario_lectivo_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `horario_lectivo_ibfk_2` FOREIGN KEY (`grupo`) REFERENCES `grupos` (`id_grupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
