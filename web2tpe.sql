-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 20:56:06
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `web2tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataformas`
--

CREATE TABLE `plataformas` (
  `id_plataforma` int(11) NOT NULL,
  `nombrePlataforma` varchar(50) NOT NULL,
  `fabricante` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `plataformas`
--

INSERT INTO `plataformas` (`id_plataforma`, `nombrePlataforma`, `fabricante`, `tipo`) VALUES
(1, 'Steam', 'Valve', 'PC'),
(2, 'PlayStation', 'Sony', 'Consola'),
(3, 'Xbox', 'Microsoft', 'Consola'),
(4, 'Epic Games', 'Epic Games', 'PC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`) VALUES
(0, 'sandezdamian@gmail.com', '$2y$10$MYmNQvELqQeukC5et2H94eOlqTTVAHpJgJ7ojoGtYIHT8FO5wljUq'),
(1, 'vargasjeronimo@gmail.com', '$2y$10$TiVxmAbKp5zj.RWwrUGidul1gHAJTE71gXVQq6cNh8cjeRhKQkKWq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `id_videojuego` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `id_plataforma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `videojuegos`
--

INSERT INTO `videojuegos` (`id_videojuego`, `titulo`, `genero`, `id_plataforma`) VALUES
(4, 'Forza Horizon 4', 'Carreras', 4),
(5, 'EFotball 24', 'Deportes', 3),
(6, 'EA FC 24', 'Deportes', 2),
(7, 'Humankind', 'Estrategia', 4),
(8, 'Norland', 'Estrategia', 1),
(9, 'Counter Strike', 'Multijugador', 1),
(10, 'Valorant', 'Multijugador', 2),
(11, 'VallHeim', 'Multijugador', 4),
(12, 'Formula 1', 'Carreras', 3),
(13, 'Call of Duty', 'Accion', 3),
(14, 'Hitman', 'Estrategia', 2),
(15, 'WWE 2K24', 'Deportes', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id_plataforma`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`id_videojuego`),
  ADD KEY `id_plataforma` (`id_plataforma`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id_plataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `id_videojuego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD CONSTRAINT `videojuegos_ibfk_1` FOREIGN KEY (`id_plataforma`) REFERENCES `plataformas` (`id_plataforma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
