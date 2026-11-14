-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2026 a las 02:00:57
-- Versión del servidor: 10.11.16-MariaDB
-- Versión de PHP: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_beneficios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficio`
--

CREATE TABLE `beneficio` (
  `id_beneficio` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `creador` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cant_prod` int(11) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_beneficio` int(11) NOT NULL,
  `fecha_inscripto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock_inicial` int(11) DEFAULT NULL,
  `stock_actual` int(11) DEFAULT NULL,
  `id_beneficio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `dni` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `rol` enum('admin','vendedor','pendiente') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `dni`, `telefono`, `email`, `direccion`, `password_hash`, `rol`) VALUES
(1, 'administrador', 'sistema', '1', '1', 'admin@email.com', '', '$2y$10$UPtG/RlmWJjVYj2OjW5ANOrg55UF5Rd1IW70TPRXbv8Efe.UmUDLu', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `entregado` tinyint(4) DEFAULT NULL,
  `pagado` tinyint(4) DEFAULT NULL,
  `fecha_venta` date DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficio`
--
ALTER TABLE `beneficio`
  ADD PRIMARY KEY (`id_beneficio`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`,`id_venta`,`id_producto`),
  ADD KEY `fk_beneficio_has_productos_productos1_idx` (`id_producto`),
  ADD KEY `fk_beneficio_has_productos_beneficio1_idx` (`id_venta`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`,`id_usuario`,`id_beneficio`),
  ADD KEY `fk_usuario_has_beneficio_beneficio1_idx` (`id_beneficio`),
  ADD KEY `fk_usuario_has_beneficio_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_beneficio1_idx` (`id_beneficio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_venta_usuarios_idx` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beneficio`
--
ALTER TABLE `beneficio`
  MODIFY `id_beneficio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_beneficio_has_productos_beneficio1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_beneficio_has_productos_productos1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_usuario_has_beneficio_beneficio1` FOREIGN KEY (`id_beneficio`) REFERENCES `beneficio` (`id_beneficio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_has_beneficio_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_beneficio1` FOREIGN KEY (`id_beneficio`) REFERENCES `beneficio` (`id_beneficio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
