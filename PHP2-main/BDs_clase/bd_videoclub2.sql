-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-01-2024 a las 13:08:41
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
-- Base de datos: `bd_videoclub2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `idPelicula` int(11) NOT NULL,
  `titulo` varchar(15) NOT NULL,
  `director` varchar(20) NOT NULL,
  `sinopsis` text NOT NULL,
  `tematica` varchar(15) NOT NULL,
  `caratula` varchar(30) NOT NULL DEFAULT 'no_imagen.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`idPelicula`, `titulo`, `director`, `sinopsis`, `tematica`, `caratula`) VALUES
(1, 'Juegos hambre', 'Gary Ross', 'dfsdfdsfs', 'Drama', 'no_imagen.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `DNI` varchar(15) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `telefono` int(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `tipo` enum('normal','admin') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`DNI`, `usuario`, `clave`, `telefono`, `email`, `tipo`) VALUES
('20797560V', 'edu', '379ef4bd50c30e261ccfb18dfc626d9f', 979875456, 'edu@inventado.e', 'normal'),
('79056701C', 'nerea', '2c3d27e49a23fb4bc49b515ae6e1548c', 123456789, 'n@inventado.es', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`idPelicula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`DNI`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `idPelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
