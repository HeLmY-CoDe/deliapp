-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-11-2024 a las 19:57:03
-- Versión del servidor: 10.6.15-MariaDB-log
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `delizia_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `status`, `created_at`, `updated_at`) VALUES
(1, 'congelados', 'Área de congelados', 1, '2024-10-22 14:59:41', '2024-10-22 14:59:41'),
(2, 'mixtos', 'Área de mixtos', 0, '2024-10-22 15:00:34', '2024-10-23 21:52:35'),
(5, 'Prueba', 'Alguna descripción', 1, '2024-10-23 21:53:14', '2024-10-23 21:53:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, '2024-10-22 14:42:52', '2024-10-22 14:42:52'),
(2, 'transcriptor', 1, '2024-10-22 14:43:17', '2024-10-22 14:43:37'),
(4, 'Otro cargo', 1, '2024-10-23 21:57:41', '2024-10-23 21:57:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_area`
--

CREATE TABLE `equipo_area` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_producto`
--

CREATE TABLE `inventario_producto` (
  `id` int(11) NOT NULL,
  `inventario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `lote` varchar(50) DEFAULT NULL,
  `fecha_vencimiento` date NOT NULL,
  `equivalencia` int(11) NOT NULL,
  `cajas` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  `merma` int(11) NOT NULL,
  `estado_merma` tinyint(1) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `detalle`, `stock`, `seccion_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '3156', 'OVEJA NEGRA MENTA CHOC 190 ML X 1 U', 648, 6, 1, '2024-10-23 16:21:33', '2024-10-23 16:27:55'),
(2, '1393', 'POSTRE TRADICIÓN TUMBO 200 ML', 19, 6, 0, '2024-10-23 16:29:05', '2024-11-10 03:59:10'),
(3, '1538', 'POSTRE TRADICION CHANTILLY 200 ML', 1, 6, 1, '2024-10-23 16:30:08', '2024-10-23 16:30:08'),
(5, '457', 'HELADO DE CANELA PALETA', 68, 2, 1, '2024-10-23 16:35:34', '2024-10-23 16:35:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL DEFAULT '',
  `area_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `nombre`, `descripcion`, `area_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paletas de Crema', 'Pertenece al área de congelados', 1, 1, '2024-10-22 15:30:55', '2024-10-22 15:30:55'),
(2, 'Paletas de Agua', '', 1, 1, '2024-10-22 15:31:30', '2024-10-22 15:44:42'),
(4, 'Botellas 1', '', 2, 1, '2024-10-22 15:45:15', '2024-10-22 15:45:15'),
(5, 'Sachet', '', 2, 1, '2024-10-22 15:45:33', '2024-10-22 15:45:33'),
(6, 'Postres', '', 1, 1, '2024-10-23 16:22:59', '2024-10-23 16:22:59'),
(7, 'Sección de Prueba', '', 1, 1, '2024-10-23 21:55:44', '2024-10-23 21:55:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `cod_empleado` varchar(50) NOT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `nombre_usuario` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `cod_empleado`, `celular`, `nombre_usuario`, `password`, `seccion_id`, `cargo_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Javier', 'Paco', '123456', '77548528', 'admin', '$2y$10$6Sk0WUU3VgZuOA/sAzZ1KOTqIT3Bw7PrAsXYu3r/qlJP3P1oxetzK', 6, 1, 1, '2024-10-22 18:15:33', '2024-11-10 02:09:33'),
(2, 'Luke', 'Skywalker', '456789', '78965120', 'luke', '$2y$10$cfmJUuQVJkIAovcO03G0Le4Wg3L.1oi3USt.OYVsNY0M550z0TkUm', 4, 2, 1, '2024-10-22 18:16:18', '2024-10-22 18:24:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo_area`
--
ALTER TABLE `equipo_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `inventario_producto`
--
ALTER TABLE `inventario_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventario_id` (`inventario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seccion_id` (`seccion_id`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seccion_id` (`seccion_id`),
  ADD KEY `cargo_id` (`cargo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `equipo_area`
--
ALTER TABLE `equipo_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_producto`
--
ALTER TABLE `inventario_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo_area`
--
ALTER TABLE `equipo_area`
  ADD CONSTRAINT `equipo_area_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `equipo_area_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `inventarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inventario_producto`
--
ALTER TABLE `inventario_producto`
  ADD CONSTRAINT `inventario_producto_ibfk_1` FOREIGN KEY (`inventario_id`) REFERENCES `inventarios` (`id`),
  ADD CONSTRAINT `inventario_producto_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`seccion_id`) REFERENCES `secciones` (`id`);

--
-- Filtros para la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD CONSTRAINT `secciones_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`seccion_id`) REFERENCES `secciones` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
