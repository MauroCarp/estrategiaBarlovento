-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-01-2025 a las 12:11:36
-- Versión del servidor: 8.3.0
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estrategiabarlovento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dietas`
--

DROP TABLE IF EXISTS `dietas`;
CREATE TABLE IF NOT EXISTS `dietas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `insumos` varchar(200) DEFAULT NULL,
  `porcentajes` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dietas`
--

INSERT INTO `dietas` (`id`, `nombre`, `insumos`, `porcentajes`) VALUES
(2, 'Simple', '[59,67,38]', '[50,40,10]'),
(6, 'TERMINACION', '[59,93,67,31]', '[65,20,5,10]'),
(9, 'estandar', '[59,30,93,67]', '[70,16,10,4]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estrategias`
--

DROP TABLE IF EXISTS `estrategias`;
CREATE TABLE IF NOT EXISTS `estrategias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `campania` varchar(100) NOT NULL,
  `stockInsumos` varchar(500) DEFAULT NULL,
  `idDieta` int DEFAULT NULL,
  `dietaReal` varchar(3000) DEFAULT NULL,
  `adpPlan` varchar(3000) DEFAULT NULL,
  `adpReal` varchar(3000) DEFAULT NULL,
  `msPlan` varchar(3000) DEFAULT NULL,
  `msReal` varchar(3000) DEFAULT NULL,
  `stockAnimales` int DEFAULT NULL,
  `stockKgProm` int NOT NULL DEFAULT '0',
  `seteado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estrategias`
--

INSERT INTO `estrategias` (`id`, `campania`, `stockInsumos`, `idDieta`, `dietaReal`, `adpPlan`, `adpReal`, `msPlan`, `msReal`, `stockAnimales`, `stockKgProm`, `seteado`, `created_at`) VALUES
(43, '2024/2025', '[{\"59\":1000000},{\"93\":280000},{\"67\":120000},{\"31\":1000000}]', 6, '{\"1\":{\"31\":\"20\",\"59\":\"50\",\"67\":\"20\",\"93\":\"10\"}}', '[\"1.1\",\"1.2\",\"1.2\",\"1.2\",\"1.3\",\"1.3\",\"1.3\",\"1.3\",\"1.2\",\"1.2\",\"1.1\",\"1.1\"]', '{\"1\":\"1.1\"}', '[\"2.8\",\"2.8\",\"2.8\",\"2.8\",\"2.8\",\"2.8\",\"2.6\",\"2.6\",\"2.6\",\"2.6\",\"2.8\",\"2.8\"]', '{\"1\":\"2.8\"}', 3000, 360, 1, '2024-10-18 16:40:47'),
(44, '2025/2026', '[{\"59\":300000},{\"93\":140000},{\"67\":90000},{\"31\":2000000}]', 6, '{\"1\":{\"31\":\"10\",\"59\":\"65\",\"67\":\"5\",\"93\":\"20\"},\"2\":{\"31\":\"10\",\"59\":\"65\",\"67\":\"5\",\"93\":\"20\"},\"3\":{\"31\":\"10\",\"59\":\"65\",\"67\":\"5\",\"93\":\"20\"},\"4\":{\"31\":\"10\",\"59\":\"65\",\"67\":\"5\",\"93\":\"20\"},\"5\":{\"31\":\"0\",\"59\":\"0\",\"67\":\"0\",\"93\":\"0\"},\"6\":{\"31\":\"10\",\"59\":\"70\",\"67\":\"5\",\"93\":\"15\"},\"7\":{\"31\":\"10\",\"59\":\"70\",\"67\":\"5\",\"93\":\"15\"},\"8\":{\"31\":\"5\",\"59\":\"60\",\"67\":\"3\",\"93\":\"32\"},\"9\":{\"31\":\"10\",\"59\":\"70\",\"67\":\"5\",\"93\":\"15\"}}', '[\"1.1\",\"1.2\",\"1.2\",\"1.2\",\"1.3\",\"1.3\",\"1.3\",\"1.1\",\"1.1\",\"1.1\",\"1.2\",\"1.3\"]', '{\"1\":\"1.2\",\"2\":\"1.2\",\"3\":\"1.3\",\"4\":\"1.1\",\"5\":\"1.3\",\"6\":\"1.3\",\"7\":\"1.2\",\"8\":\"1.3\",\"\":null,\"9\":\"1.2\"}', '[\"2.8\",\"2.8\",\"2.8\",\"2.8\",\"2.6\",\"2.6\",\"2.6\",\"2.6\",\"2.6\",\"2.8\",\"2.8\",\"2.8\"]', '{\"1\":\"2.7\",\"2\":\"2.7\",\"3\":\"2.6\",\"4\":\"2.5\",\"5\":\"2.8\",\"6\":\"2.8\",\"7\":\"2.8\",\"8\":\"2.9\",\"\":null,\"9\":\"6\"}', 3000, 350, 1, '2024-10-23 13:41:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faenas`
--

DROP TABLE IF EXISTS `faenas`;
CREATE TABLE IF NOT EXISTS `faenas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `faenas`
--

INSERT INTO `faenas` (`id`, `nombre`, `fecha`, `created_at`, `update_at`) VALUES
(24, 'Prueba 1 ', '2023-11-02', '2023-11-02 16:56:34', NULL),
(30, 'Prueba 2', '2023-11-02', '2023-11-02 17:19:45', NULL),
(31, 'Prueba 3', '2023-11-02', '2023-11-02 17:42:39', NULL),
(32, 'Barlovento Expo 31-10', '2023-10-31', '2023-11-02 17:53:03', NULL),
(40, 'Ornela', '2023-11-27', '2023-11-27 18:01:50', NULL),
(41, 'San José 06-11', '2023-11-06', '2023-11-28 08:44:22', NULL),
(42, 'Barlovento 09-11', '2023-11-09', '2023-11-28 08:53:53', NULL),
(44, 'San José 14-11', '2023-11-14', '2023-11-28 08:58:29', NULL),
(47, 'Barlovento 20-11', '2023-11-20', '2023-12-14 17:41:53', NULL),
(49, 'San José 20-11', '2023-11-20', '2023-12-14 17:48:02', NULL),
(50, 'San José 22-11', '2023-11-22', '2023-12-14 17:49:57', NULL),
(51, 'San José 27-11', '2023-11-27', '2023-12-14 17:56:09', NULL),
(54, 'Barlovento 27-11', '2023-11-27', '2023-12-14 18:04:59', NULL),
(55, 'Barlovento 29-11', '2023-11-29', '2023-12-14 18:06:21', NULL),
(71, 'San José 04-12', '2023-12-04', '2023-12-18 09:25:30', NULL),
(72, 'San José 06-12', '2023-12-06', '2023-12-18 09:27:41', NULL),
(73, 'Barlovento 06-12', '2023-12-06', '2023-12-18 09:34:14', NULL),
(76, 'Barlovento expo 13-12', '2023-12-13', '2023-12-18 09:59:32', NULL),
(78, 'San José 14-12', '2023-12-14', '2023-12-18 10:20:09', NULL),
(88, 'San José 11-12', '2023-12-11', '2023-12-18 14:03:07', NULL),
(101, 'Prueba', '2024-01-26', '2024-01-26 12:53:10', NULL),
(230, 'Barlovento 18-12-2023', '2023-12-18', '2024-04-09 09:35:32', NULL),
(231, 'San José 18-12-23', '2023-12-18', '2024-04-09 09:38:16', NULL),
(232, 'San José 20-12-23', '2023-12-20', '2024-04-09 10:33:13', NULL),
(233, 'San José 21-12-23', '2023-12-21', '2024-04-09 10:49:52', NULL),
(236, 'San José 27-12-23', '2023-12-27', '2024-04-09 11:31:39', NULL),
(237, 'Barlovento 03-01-23', '2023-01-03', '2024-04-09 11:41:08', NULL),
(238, 'San José 03-01-23', '2023-01-03', '2024-04-09 11:47:00', NULL),
(239, 'Barlovento 04-01-24', '2024-01-04', '2024-04-09 11:59:42', NULL),
(240, 'San José 07-01-24', '2024-01-07', '2024-04-09 12:08:13', NULL),
(241, 'Barlovento 13-01-24', '2024-01-13', '2024-04-10 16:17:03', NULL),
(242, 'San José 13-01-24', '2024-01-13', '2024-04-10 16:19:13', NULL),
(243, 'San José 22-01-24', '2024-01-22', '2024-04-11 15:38:11', NULL),
(244, 'Barlovento 26-01-24', '2024-01-26', '2024-04-11 15:51:00', NULL),
(245, 'Barlovento 28-01-24', '2024-01-28', '2024-04-11 16:01:06', NULL),
(246, 'San José 29-01-24', '2024-01-29', '2024-04-11 16:10:40', NULL),
(247, 'Barlovento 05-02-24', '2024-02-05', '2024-04-11 16:17:11', NULL),
(248, 'San José 05-02-24', '2024-02-05', '2024-04-11 16:23:35', NULL),
(249, 'San José 09-02-24', '2024-02-09', '2024-04-11 16:40:17', NULL),
(250, 'San José 14-02-24', '2024-02-14', '2024-04-11 16:46:49', NULL),
(251, 'Barlovento 18-02-24', '2024-02-18', '2024-04-11 17:05:14', NULL),
(252, 'Barlovento 19-02-24', '2024-02-19', '2024-04-11 17:13:34', NULL),
(253, 'San José 19-02-24', '2024-02-19', '2024-04-11 17:15:48', NULL),
(254, 'Barlovento 26-02-24', '2024-02-26', '2024-04-11 17:21:06', NULL),
(255, 'San José 26-02-24', '2024-02-26', '2024-04-11 17:27:40', NULL),
(256, 'Barlovento 28-02-24', '2024-02-28', '2024-04-11 17:36:30', NULL),
(257, 'San José 04-03-24', '2024-03-04', '2024-04-11 17:47:49', NULL),
(258, 'Barlovento 07-03-24', '2024-03-07', '2024-04-11 17:55:24', NULL),
(259, 'Barlovento 11-03-24', '2024-03-11', '2024-04-11 18:01:41', NULL),
(260, 'San José 11-03-24', '2024-03-11', '2024-04-11 18:06:01', NULL),
(261, 'San José 18-03-24', '2024-03-18', '2024-04-11 18:11:24', NULL),
(262, 'Barlovento 21-03-24', '2024-03-21', '2024-04-11 18:17:24', NULL),
(263, 'San José 25-03-24', '2024-03-25', '2024-04-11 18:30:42', NULL),
(264, 'Barlovento 29-03-24', '2024-03-29', '2024-04-11 18:35:41', NULL),
(265, 'Barlovento 02-04-24', '2024-04-02', '2024-04-11 18:37:16', NULL),
(266, 'Barlovento 08-04-24', '2024-04-08', '2024-04-11 18:45:26', NULL),
(267, 'San José 08-04-24', '2024-04-08', '2024-04-11 18:49:52', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

DROP TABLE IF EXISTS `insumos`;
CREATE TABLE IF NOT EXISTS `insumos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `insumo` varchar(150) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `porceMS` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `insumo`, `tipo`, `porceMS`) VALUES
(1, 'Alfalfa prefloracion', 'FORRAJES FRESCOS', 20),
(2, 'Alfalfa pura, 10% de floracion', 'FORRAJES FRESCOS', 22),
(3, 'Alfalfa pura, 50% de floracion', 'FORRAJES FRESCOS', 24),
(4, 'Alfalfa pura, 100% de floracion', 'FORRAJES FRESCOS', 26),
(5, 'Gramineas templadas (65-70 DMS)', 'FORRAJES FRESCOS', 20),
(6, 'Gramineas templadas (60-65 DMS)', 'FORRAJES FRESCOS', 22),
(7, 'Gramineas templadas (57-60 DMS)', 'FORRAJES FRESCOS', 25),
(8, 'Gramineas megat alta cal(62-DMS)', 'FORRAJES FRESCOS', 24),
(9, 'Gram Megat med calidad(59%DMS)', 'FORRAJES FRESCOS', 26),
(10, 'Gram Megatermica Dif(56 % DMS)', 'FORRAJES', 80),
(11, 'Verdeos invernales primer corte', 'FORRAJES FRESCOS', 20),
(12, 'Verdeos invernales último corte', 'FORRAJES FRESCOS', 24),
(19, 'Heno Alfalfa prefloracion', 'HENOS', 85),
(20, 'Heno Alfalfa pura, 10% floracion', 'HENOS', 85),
(21, 'Heno Alfalfa pura, 50% de floracion', 'HENOS', 85),
(22, 'Heno Alfalfa pura, 100% de floracion', 'HENOS', 85),
(23, 'Heno Moha vegetativo', 'HENOS', 85),
(24, 'Heno Moha grano pastoso', 'HENOS', 85),
(25, 'Cascara de Girasol', 'HENOS', 90),
(26, 'Silaje Alfalfa, 10% floracion', 'SILAJES', 34),
(27, 'Silaje Alfalfa, 50% floracion ', 'SILAJES', 34),
(28, 'Silaje Maiz Bajo Grano', 'SILAJES', 35),
(29, 'Silaje Maiz Medio Grano', 'SILAJES', 35),
(30, 'Silaje Maiz Alto Grano', 'SILAJES', 35),
(31, 'Silaje Maiz Muy Alto Grano', 'SILAJES', 35),
(32, 'Silaje Sorgo Granifero Bajo Grano', 'SILAJES', 32),
(33, 'Silaje Sorgo Granifero Medio Grano', 'SILAJES', 32),
(34, 'Silaje Sorgo Granifero Alto Grano', 'SILAJES', 32),
(35, 'Silaje Sorgo Gra. Muy Alto Grano', 'SILAJES', 32),
(36, 'Silaje Sorgo forrajero tierno', 'SILAJES', 28),
(37, 'Silaje sorgo forrajero maduro ', 'SILAJES', 28),
(38, 'Silaje de cebada', 'SILAJES', 39),
(74, 'Gluten feed pellet', 'CONCENTRADOS (C)', 89),
(73, 'Gluten feed humedo', 'CONCENTRADOS (C)', 45),
(72, 'Permeado de suero ', 'CONCENTRADOS (C)', 18),
(71, 'Urea', 'CONCENTRADOS (C)', 98),
(70, 'Algodon  expeller', 'CONCENTRADOS (C)', 89),
(69, 'Girasol expeller', 'CONCENTRADOS (C)', 89),
(68, 'Soja expeller', 'CONCENTRADOS (C)', 89),
(67, 'Soja grano ', 'CONCENTRADOS (C)', 87),
(66, 'Pulpa de citricos', 'CONCENTRADOS (C)', 92),
(65, 'Afrechillo de trigo', 'CONCENTRADOS (C)', 88),
(64, 'Algodón semilla', 'CONCENTRADOS (C)', 88),
(63, 'Trigo grano', 'CONCENTRADOS (C)', 86),
(62, 'Cebada grano', 'CONCENTRADOS (C)', 86),
(61, 'Avena grano', 'CONCENTRADOS (C)', 86),
(60, 'Sorgo grano', 'CONCENTRADOS', 87),
(59, 'Maiz Grano', 'CONCENTRADOS (C)', 87),
(75, 'Silaje Maiz grano humedo', 'CONCENTRADOS (C)', 75),
(76, 'Silaje Sorgo grano húmedo', 'CONCENTRADOS (C)', 72),
(77, 'Girasol expeller baja proteina', 'CONCENTRADOS (C)', 89),
(78, 'Orujo de  Uva', 'CONCENTRADOS (C)', 90),
(79, 'Premezcla Vit. Min. Con Monensina', 'Premix', 99),
(80, 'Agua', 'LIQUIDO', 1),
(89, 'Ingreso s/atb', 'Premix', 88),
(90, 'Ingreso C/ATB', 'Premix', 99),
(91, 'Terminacion', 'Premix', 99),
(92, 'Recria', 'Premix', 99),
(93, 'Cascara de Mani', 'Fibra', 90),
(95, 'Insumo 1 ', 'SILAJES', 50),
(96, 'Gram Megat muy alta cal (65%DMS)', 'FORRAJES', 22),
(97, 'Suplemento 1', 'Premix', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientosanimales`
--

DROP TABLE IF EXISTS `movimientosanimales`;
CREATE TABLE IF NOT EXISTS `movimientosanimales` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `idEstrategia` bigint UNSIGNED NOT NULL,
  `ingresosPlan` varchar(400) NOT NULL,
  `kgIngresosPlan` varchar(400) DEFAULT NULL,
  `egresosPlan` varchar(400) DEFAULT NULL,
  `kgEgresosPlan` varchar(400) DEFAULT NULL,
  `ingresosReal` varchar(400) DEFAULT NULL,
  `kgIngresosReal` varchar(400) DEFAULT NULL,
  `ventasReal` varchar(400) DEFAULT NULL,
  `kgVentasReal` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientosanimales`
--

INSERT INTO `movimientosanimales` (`id`, `idEstrategia`, `ingresosPlan`, `kgIngresosPlan`, `egresosPlan`, `kgEgresosPlan`, `ingresosReal`, `kgIngresosReal`, `ventasReal`, `kgVentasReal`) VALUES
(43, 43, '{\"1\":\"300\",\"2\":\"400\",\"3\":\"400\",\"4\":\"400\",\"5\":\"500\",\"6\":\"500\",\"7\":\"500\",\"8\":\"400\",\"9\":\"400\",\"10\":\"500\",\"11\":\"500\",\"12\":\"500\"}', '{\"1\":\"350\",\"2\":\"300\",\"3\":\"280\",\"4\":\"350\",\"5\":\"370\",\"6\":\"290\",\"7\":\"350\",\"8\":\"280\",\"9\":\"280\",\"10\":\"280\",\"11\":\"250\",\"12\":\"250\"}', '{\"1\":\"400\",\"2\":\"400\",\"3\":\"500\",\"4\":\"500\",\"5\":\"500\",\"6\":\"550\",\"7\":\"500\",\"8\":\"400\",\"9\":\"400\",\"10\":\"500\",\"11\":\"500\",\"12\":\"400\"}', '{\"1\":\"460\",\"2\":\"460\",\"3\":\"440\",\"4\":\"440\",\"5\":\"440\",\"6\":\"450\",\"7\":\"500\",\"8\":\"450\",\"9\":\"460\",\"10\":\"460\",\"11\":\"460\",\"12\":\"460\"}', '{\"1\":\"300\"}', '{\"1\":\"350\"}', '{\"1\":\"400\"}', '{\"1\":\"460\"}'),
(44, 44, '{\"1\":\"300\",\"2\":\"350\",\"3\":\"400\",\"4\":\"350\",\"5\":\"400\",\"6\":\"400\",\"7\":\"500\",\"8\":\"500\",\"9\":\"500\",\"10\":\"500\",\"11\":\"800\",\"12\":\"800\"}', '{\"1\":\"350\",\"2\":\"320\",\"3\":\"280\",\"4\":\"350\",\"5\":\"350\",\"6\":\"290\",\"7\":\"300\",\"8\":\"350\",\"9\":\"350\",\"10\":\"350\",\"11\":\"400\",\"12\":\"350\"}', '{\"1\":\"400\",\"2\":\"400\",\"3\":\"400\",\"4\":\"500\",\"5\":\"500\",\"6\":\"500\",\"7\":\"400\",\"8\":\"400\",\"9\":\"400\",\"10\":\"400\",\"11\":\"500\",\"12\":\"600\"}', '{\"1\":\"420\",\"2\":\"420\",\"3\":\"450\",\"4\":\"450\",\"5\":\"450\",\"6\":\"420\",\"7\":\"420\",\"8\":\"420\",\"9\":\"450\",\"10\":\"450\",\"11\":\"420\",\"12\":\"500\"}', '{\"1\":\"300\",\"2\":\"400\",\"3\":\"200\",\"4\":\"250\",\"5\":\"500\",\"6\":\"500\",\"7\":\"1500\",\"8\":\"1500\",\"\":null,\"9\":\"200\"}', '{\"1\":\"350\",\"2\":\"280\",\"3\":\"350\",\"4\":\"380\",\"5\":\"350\",\"6\":\"350\",\"7\":\"400\",\"8\":\"400\",\"\":null,\"9\":\"180\"}', '{\"1\":\"400\",\"2\":\"500\",\"3\":\"500\",\"4\":\"300\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"\":null,\"9\":\"500\"}', '{\"1\":\"420\",\"2\":\"450\",\"3\":\"420\",\"4\":\"420\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"\":null,\"9\":\"480\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoscereales`
--

DROP TABLE IF EXISTS `movimientoscereales`;
CREATE TABLE IF NOT EXISTS `movimientoscereales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `idEstrategia` int NOT NULL,
  `cerealesPlan` varchar(400) DEFAULT '0',
  `cerealesReal` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientoscereales`
--

INSERT INTO `movimientoscereales` (`id`, `idEstrategia`, `cerealesPlan`, `cerealesReal`) VALUES
(39, 43, '{\"59\":[\"0\",\"60.000\",\"60000\",\"90000\",\"900000\",\"0\",\"2000000\",\"120000\",\"120000\",\"\",\"5000000\",\"0\"],\"93\":[\"0\",\"0\",\"28000\",\"280000\",\"560000\",\"56000\",\"300000\",\"200000\",\"200000\",\"0\",\"100000\",\"300000\"],\"67\":[\"0\",\"0\",\"0\",\"0\",\"90000\",\"60000\",\"30000\",\"60000\",\"\",\"\",\"60000\",\"30000\"],\"31\":[\"0\",\"0\",\"0\",\"0\",\"300000\",\"200000\",\"1000000\",\"\",\"\",\"\",\"0\",\"0\"]}', '{\"1\":{\"31\":\"0\",\"59\":\"0\",\"67\":\"0\",\"93\":\"0\"}}'),
(40, 44, '{\"59\":[\"300000\",\"300000\",\"30000\",\"1000000\",\"1000000\",\"1000000\",\"1000000\",\"300000\",\"300000\",\"300000\",\"1000000\",\"1000000\"],\"93\":[\"24000\",\"24000\",\"400000\",\"400000\",\"400000\",\"400000\",\"400000\",\"0\",\"0\",\"50000\",\"48000\",\"48000\"],\"67\":[\"0\",\"0\",\"0\",\"0\",\"90000\",\"0\",\"50000\",\"50000\",\"40000\",\"60000\",\"70000\",\"50000\"],\"31\":[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"]}', '{\"1\":{\"31\":\"0\",\"59\":\"300000\",\"67\":\"0\",\"93\":\"24000\"},\"2\":{\"31\":\"0\",\"59\":\"300000\",\"67\":\"0\",\"93\":\"0\"},\"3\":{\"31\":\"0\",\"59\":\"120000000\",\"67\":\"30000\",\"93\":\"0\"},\"4\":{\"31\":\"0\",\"59\":\"0\",\"67\":\"0\",\"93\":\"300000\"},\"5\":{\"31\":\"0\",\"59\":\"0\",\"67\":\"0\",\"93\":\"0\"},\"6\":{\"31\":\"0\",\"59\":\"0\",\"67\":\"0\",\"93\":\"0\"},\"7\":{\"31\":\"0\",\"59\":\"0\",\"67\":\"0\",\"93\":\"0\"},\"8\":{\"31\":\"0\",\"59\":\"0\",\"67\":\"0\",\"93\":\"0\"},\"9\":{\"31\":\"0\",\"59\":\"100000\",\"67\":\"0\",\"93\":\"0\"}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `empresa` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `perfil` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `foto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `estado` int DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `empresa`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Administrador', 'Jorge', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Barlovento', 'Administrador', NULL, 1, '2024-12-24 10:41:39', '2022-02-17 13:26:54'),
(12, 'Barlovento', 'Barlovento', '$2a$07$asxx54ahjppf45sd87a5au6PyrAp0fMPCXhOfJTH/.lk80lR5me3q', 'Barlovento', 'Administrador', NULL, 1, '2024-12-12 17:37:01', '2022-05-31 14:16:50'),
(13, 'operario', 'operario', '$2a$07$asxx54ahjppf45sd87a5au4gG2PucVOGjfyd7IgLvarlZ2vCzy1tu', 'Barlovento', 'Operario', NULL, 1, '2024-11-13 08:15:41', '2022-05-31 14:23:52'),
(14, 'Jorge', 'JCornale', '$2a$07$asxx54ahjppf45sd87a5auwXPL7F5D4FZp3QF82C7HCTuZZm50l6i', 'Supermercado rural', 'Administrador', NULL, 1, '2022-06-03 11:19:15', '2022-06-03 14:11:13'),
(15, 'Jorge Ferrario', 'JorgeF', '$2a$07$asxx54ahjppf45sd87a5auF8BWRdMZRYk9eZGcNlQ0GLivHjiQHFu', 'Jorge Ferrario', 'Administrador', NULL, 0, '2023-03-08 18:06:56', '2022-06-13 12:48:45'),
(19, 'Jorge Ferrario', 'Operador', '$2a$07$asxx54ahjppf45sd87a5au/5NrFyOVsHpbETWTMKPHrsTVXzsmeOO', '', 'Operario', NULL, 0, '2022-06-13 15:59:34', '2022-06-13 18:52:47'),
(20, 'JorgeC', 'JorgeC', '$2a$07$asxx54ahjppf45sd87a5aueTpu8KZyE2ZYTI56lDwzTsqqGSSvjvy', '', 'Administrador', NULL, 1, '2024-12-23 08:53:43', '2022-06-13 19:10:41'),
(22, 'Mauro', 'Mauro1', '$2a$07$asxx54ahjppf45sd87a5aumz05tbqncvnFta0EzQw5j/y0auoL1y6', 'Jorge Ferrario', 'Operario', NULL, NULL, NULL, '2022-06-14 08:13:58'),
(23, 'Mauro', 'Tecnico', '$2a$07$asxx54ahjppf45sd87a5auCqRfN5riaXMbI325TFZ6KOpzYf9E84i', 'Barlovento', 'Administrador', NULL, 1, '2024-11-22 12:23:21', '2022-09-28 20:43:37'),
(24, 'Tecnico', 'tecnicoEstrategia', '$2a$07$asxx54ahjppf45sd87a5auCqRfN5riaXMbI325TFZ6KOpzYf9E84i', 'Estrategia', 'Administrador', NULL, 1, '2025-01-17 08:19:13', '2024-05-22 02:51:19'),
(25, 'Jorge', 'JorgePlan', '$2a$07$asxx54ahjppf45sd87a5auCseuQDrLZZ7ic0MltFw4qsxZXNnhb/K', 'Estrategia', 'Administrador', NULL, 1, '2024-12-23 18:12:15', '2024-10-18 17:27:37'),
(26, 'Ornela', 'OrnelaPlan', '$2a$07$asxx54ahjppf45sd87a5auF964pzcuwj/zySN7jCfGu.f443ilD02', 'Estrategia', 'Administrador', NULL, 1, '2024-11-20 13:09:13', '2024-10-18 19:39:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
