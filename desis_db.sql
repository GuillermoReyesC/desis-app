-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql:3306
-- Tiempo de generación: 25-07-2025 a las 23:16:41
-- Versión del servidor: 8.0.43
-- Versión de PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `desis_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencies`
--

CREATE TABLE `agencies` (
  `id` int NOT NULL,
  `warehouse_id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `agencies`
--

INSERT INTO `agencies` (`id`, `warehouse_id`, `name`) VALUES
(1, 1, 'Sucursal Santiago'),
(2, 1, 'Sucursal Valparaíso'),
(3, 2, 'Sucursal Antofagasta'),
(4, 3, 'Sucursal Chillán');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`id`, `name`) VALUES
(1, 'CLP'),
(2, 'USD'),
(3, 'EUR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materials`
--

CREATE TABLE `materials` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `materials`
--

INSERT INTO `materials` (`id`, `name`) VALUES
(1, 'Plástico'),
(2, 'Metal'),
(3, 'Madera'),
(4, 'Vidrio'),
(5, 'textil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `code` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `warehouse_id` int NOT NULL,
  `agency_id` int NOT NULL,
  `currency_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `warehouse_id`, `agency_id`, `currency_id`, `price`, `description`, `created_at`) VALUES
(1, 'PRD12345', 'Laptop Lenovo ThinkPad', 1, 3, 1, 899.99, 'Laptop empresarial con 16GB RAM y 512GB SSD', '2025-07-24 23:29:13'),
(2, 'QWERTY123', 'HP', 1, 3, 1, 899.99, 'Equipo barato', '2025-07-25 07:25:54'),
(3, 'HP1000', 'HP1000', 3, 4, 1, 10000.00, 'computador negro hp', '2025-07-25 08:12:21'),
(4, 'AUA123', 'aaa', 3, 4, 3, 999999.00, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-07-25 08:13:32'),
(5, 'AZZ333', 'BigMac XL', 3, 4, 2, 10000.00, 'lorem ipsum dolor sit amet', '2025-07-25 08:21:40'),
(6, 'DFS12345', 'DFS 5500', 3, 3, 3, 200000.00, 'producto desconocido', '2025-07-25 08:25:40'),
(7, 'ABC123', 'producto 10', 2, 1, 1, 5500.00, 'producto numero 10', '2025-07-25 08:27:21'),
(8, 'NEW999', 'Producto999', 2, 3, 3, 500.00, 'nuevo producto', '2025-07-25 08:30:44'),
(9, 'EEERR11', 'EEERRR', 3, 4, 3, 10000.00, 'producto test', '2025-07-25 08:32:48'),
(10, 'PROD27', 'producto 1212112', 3, 4, 3, 10000.00, 'descripcion corta o larga', '2025-07-25 16:16:26'),
(11, 'ZXC123', 'producto 1200', 3, 4, 3, 12000.00, 'producto mil docientos', '2025-07-25 22:28:26'),
(12, 'ZT1200', 'otro producto', 1, 2, 2, 1200.00, 'otro producto', '2025-07-25 22:30:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_material`
--

CREATE TABLE `product_material` (
  `product_id` int NOT NULL,
  `material_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `product_material`
--

INSERT INTO `product_material` (`product_id`, `material_id`) VALUES
(1, 1),
(2, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(1, 2),
(2, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(12, 2),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(1, 4),
(2, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(1, 5),
(2, 5),
(7, 5),
(8, 5),
(9, 5),
(10, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`) VALUES
(1, 'Bodega Central'),
(2, 'Bodega Norte'),
(3, 'Bodega Sur');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `currency_id` (`currency_id`);

--
-- Indices de la tabla `product_material`
--
ALTER TABLE `product_material`
  ADD PRIMARY KEY (`product_id`,`material_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indices de la tabla `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agencies`
--
ALTER TABLE `agencies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agencies`
--
ALTER TABLE `agencies`
  ADD CONSTRAINT `agencies_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);

--
-- Filtros para la tabla `product_material`
--
ALTER TABLE `product_material`
  ADD CONSTRAINT `product_material_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
