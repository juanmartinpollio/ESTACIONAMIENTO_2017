-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2017 a las 02:37:39
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpestacionamiento`
--
CREATE DATABASE IF NOT EXISTS `tpestacionamiento` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `tpestacionamiento`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cocheras`
--

CREATE TABLE `cocheras` (
  `patente` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `cantidadUsada` int(11) NOT NULL,
  `fechaIngreso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cocheras`
--

INSERT INTO `cocheras` (`patente`, `tipo`, `numero`, `estado`, `cantidadUsada`, `fechaIngreso`) VALUES
('vacio', 'reservado', 'P1C1', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'reservado', 'P1C2', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'reservado', 'P1C3', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P1C4', 0, 15, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P1C5', 0, 2, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P1C6', 0, 1, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P1C7', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P1C8', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P2C1', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P2C2', 0, 1, '0000-00-00 00:00:00'),
('afg174', 'normal', 'P2C3', 1, 1, '2017-06-18 18:22:02'),
('vacio', 'normal', 'P2C4', 0, 1, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P2C5', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P2C6', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P2C7', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P2C8', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P3C1', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P3C2', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P3C3', 0, 1, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P3C4', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P3C5', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P3C6', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P3C7', 0, 0, '0000-00-00 00:00:00'),
('vacio', 'normal', 'P3C8', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `apellido` varchar(30) CHARACTER SET latin1 NOT NULL,
  `password` varchar(30) CHARACTER SET latin1 NOT NULL,
  `turno` int(20) NOT NULL,
  `condicion` int(20) NOT NULL,
  `administrador` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `usuario`, `nombre`, `apellido`, `password`, `turno`, `condicion`, `administrador`) VALUES
(1, 'juanmartinpollio', 'Juan Martin', 'Pollio', '123456', 0, 0, 0),
(2, 'GusRot', 'Gustavo', 'Rotela', '123456', 0, 0, 1),
(5, 'CarlosGonz', 'Carlos', 'Gonzalez', '123456', 0, 0, 0),
(6, 'pepe', 'Jose', 'Perez', '123456', 1, 1, 1),
(8, 'jorge1789', 'Jorge', 'Lopez', '123456', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fechaIngreso` datetime NOT NULL,
  `cantOperaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `patente` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cochera` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fechaIngreso` datetime NOT NULL,
  `fechaRetiro` datetime NOT NULL,
  `pago` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`patente`, `color`, `marca`, `cochera`, `fechaIngreso`, `fechaRetiro`, `pago`) VALUES
('abc123', 'rojo', 'fiat', 'P1C4', '2017-06-18 17:51:55', '0000-00-00 00:00:00', 0),
('adb123', 'rojo', 'fiat', 'P1C5', '2017-06-18 18:07:04', '2017-06-18 18:10:52', 1),
('add147', 'azul', 'ford', 'P3C3', '2017-06-18 18:19:17', '2017-06-18 18:19:48', 1),
('afg174', 'verde', 'maseratti', 'P2C3', '2017-06-18 18:22:02', '0000-00-00 00:00:00', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
