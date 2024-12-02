-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-01-2024 a las 13:08:13
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
-- Base de datos: `bd_libreria_exam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `referencia` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `autor` varchar(30) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `portada` varchar(50) NOT NULL DEFAULT 'no_imagen.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`referencia`, `titulo`, `autor`, `descripcion`, `precio`, `portada`) VALUES
(1, 'dfhkjsdhfdsf', 'dfsdfdsf', 'dfsfdsfdf', 18.75, 'no_imagen.jpg'),
(2, 'asder', 'rewrewr', 'ewrewr', 12.40, 'no_imagen.jpg'),
(3, 'dsfds', 'fdsfsdfsdf', 'hyjuyiyuiu', 40.23, 'no_imagen.jpg'),
(4, 'ufiuty', 'ewrer', 'ytryrtytry', 20.30, 'no_imagen.jpg'),
(5, 'gfgdf', 'gdfgfd', 'gdfgdf', 5.00, 'img5.png'),
(768678, 'dasd', 'asd', 'sadsa', 6.00, 'img768678.png'),
(34545435, '544545', '454', '35345', 4.00, 'img34545435.png'),
(345454355, '544545', '454', '35345', 4.00, 'no_imagen.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `lector` varchar(15) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `tipo` enum('admin','normal') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `lector`, `clave`, `tipo`) VALUES
(1, 'nerea', '2c3d27e49a23fb4bc49b515ae6e1548c', 'admin'),
(2, 'edu', '379ef4bd50c30e261ccfb18dfc626d9f', 'normal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`referencia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
