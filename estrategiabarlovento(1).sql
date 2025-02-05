-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-02-2025 a las 13:36:13
-- Versión del servidor: 8.0.31
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estrategias`
--

INSERT INTO `estrategias` (`id`, `campania`, `stockInsumos`, `idDieta`, `dietaReal`, `adpPlan`, `adpReal`, `msPlan`, `msReal`, `stockAnimales`, `stockKgProm`, `seteado`, `created_at`) VALUES
(44, '2025/2026', '[{\"59\":300000},{\"93\":140000},{\"67\":90000},{\"31\":2000000}]', 6, '{\"1\":{\"31\":\"10\",\"59\":\"65\",\"67\":\"5\",\"93\":\"20\"},\"2\":{\"31\":\"10\",\"59\":\"65\",\"67\":\"5\",\"93\":\"20\"},\"3\":{\"31\":\"10\",\"59\":\"65\",\"67\":\"5\",\"93\":\"20\"},\"4\":{\"31\":\"10\",\"59\":\"65\",\"67\":\"5\",\"93\":\"20\"},\"5\":{\"31\":\"0\",\"59\":\"0\",\"67\":\"0\",\"93\":\"0\"},\"6\":{\"31\":\"10\",\"59\":\"70\",\"67\":\"5\",\"93\":\"15\"},\"7\":{\"31\":\"10\",\"59\":\"70\",\"67\":\"5\",\"93\":\"15\"},\"8\":{\"31\":\"5\",\"59\":\"60\",\"67\":\"3\",\"93\":\"32\"},\"9\":{\"31\":\"10\",\"59\":\"70\",\"67\":\"5\",\"93\":\"15\"}}', '[\"1.1\",\"1.2\",\"1.2\",\"1.2\",\"1.3\",\"1.3\",\"1.3\",\"1.1\",\"1.1\",\"1.1\",\"1.2\",\"1.3\"]', '{\"1\":\"1.2\",\"2\":\"1.2\",\"3\":\"1.3\",\"4\":\"1.1\",\"5\":\"1.3\",\"6\":\"1.3\",\"7\":\"1.2\",\"8\":\"1.3\",\"\":null,\"9\":\"1.2\"}', '[\"2.8\",\"2.8\",\"2.8\",\"2.8\",\"2.6\",\"2.6\",\"2.6\",\"2.6\",\"2.6\",\"2.8\",\"2.8\",\"2.8\"]', '{\"1\":\"2.7\",\"2\":\"2.7\",\"3\":\"2.6\",\"4\":\"2.5\",\"5\":\"2.8\",\"6\":\"2.8\",\"7\":\"2.8\",\"8\":\"2.9\",\"\":null,\"9\":\"6\"}', 3000, 350, 1, '2024-10-23 13:41:31'),
(47, '2029/2030', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2024-12-10 18:45:18');

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
  `precioKgIngresosPlan` varchar(1500) DEFAULT NULL,
  `aPagarIngresosPlan` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `egresosPlan` varchar(400) DEFAULT NULL,
  `precioKgEgresosPlan` varchar(1500) DEFAULT NULL,
  `aPagarEgresosPlan` varchar(1500) DEFAULT NULL,
  `kgEgresosPlan` varchar(400) DEFAULT NULL,
  `ingresosReal` varchar(400) DEFAULT NULL,
  `kgIngresosReal` varchar(400) DEFAULT NULL,
  `ventasReal` varchar(400) DEFAULT NULL,
  `kgVentasReal` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `movimientosanimales`
--

INSERT INTO `movimientosanimales` (`id`, `idEstrategia`, `ingresosPlan`, `kgIngresosPlan`, `precioKgIngresosPlan`, `aPagarIngresosPlan`, `egresosPlan`, `precioKgEgresosPlan`, `aPagarEgresosPlan`, `kgEgresosPlan`, `ingresosReal`, `kgIngresosReal`, `ventasReal`, `kgVentasReal`) VALUES
(44, 44, '{\"1\":\"300\",\"2\":\"350\",\"3\":\"400\",\"4\":\"350\",\"5\":\"400\",\"6\":\"400\",\"7\":\"500\",\"8\":\"500\",\"9\":\"500\",\"10\":\"500\",\"11\":\"800\",\"12\":\"800\"}', '{\"1\":\"350\",\"2\":\"320\",\"3\":\"280\",\"4\":\"350\",\"5\":\"350\",\"6\":\"290\",\"7\":\"300\",\"8\":\"350\",\"9\":\"350\",\"10\":\"350\",\"11\":\"400\",\"12\":\"350\"}', '{\"1\":\"130\",\"2\":\"135\",\"3\":\"120\",\"4\":\"130\",\"5\":\"130\",\"6\":\"140\",\"7\":\"145\",\"8\":\"140\",\"9\":\"135\",\"10\":\"140\",\"11\":\"140\",\"12\":\"145\"}', '{\"1\":\"0\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"5\":\"2\",\"6\":\"1\",\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\",\"11\":\"2\",\"12\":\"2\"}', '{\"1\":\"400\",\"2\":\"400\",\"3\":\"400\",\"4\":\"500\",\"5\":\"500\",\"6\":\"500\",\"7\":\"400\",\"8\":\"400\",\"9\":\"400\",\"10\":\"400\",\"11\":\"500\",\"12\":\"600\"}', '{\"1\":\"450\",\"2\":\"450\",\"3\":\"450\",\"4\":\"420\",\"5\":\"420\",\"6\":\"420\",\"7\":\"450\",\"8\":\"450\",\"9\":\"450\",\"10\":\"450\",\"11\":\"420\",\"12\":\"400\"}', '{\"1\":\"0\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"0\",\"10\":\"0\",\"11\":\"0\",\"12\":\"0\"}', '{\"1\":\"420\",\"2\":\"420\",\"3\":\"450\",\"4\":\"450\",\"5\":\"450\",\"6\":\"420\",\"7\":\"420\",\"8\":\"420\",\"9\":\"450\",\"10\":\"450\",\"11\":\"420\",\"12\":\"500\"}', '{\"1\":\"300\",\"2\":\"400\",\"3\":\"200\",\"4\":\"250\",\"5\":\"500\",\"6\":\"500\",\"7\":\"1500\",\"8\":\"1500\",\"\":null,\"9\":\"200\"}', '{\"1\":\"350\",\"2\":\"280\",\"3\":\"350\",\"4\":\"380\",\"5\":\"350\",\"6\":\"350\",\"7\":\"400\",\"8\":\"400\",\"\":null,\"9\":\"180\"}', '{\"1\":\"400\",\"2\":\"500\",\"3\":\"500\",\"4\":\"300\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"\":null,\"9\":\"500\"}', '{\"1\":\"420\",\"2\":\"450\",\"3\":\"420\",\"4\":\"420\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"\":null,\"9\":\"480\"}');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `movimientoscereales`
--

INSERT INTO `movimientoscereales` (`id`, `idEstrategia`, `cerealesPlan`, `cerealesReal`) VALUES
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
(24, 'Tecnico', 'tecnicoEstrategia', '$2a$07$asxx54ahjppf45sd87a5auCqRfN5riaXMbI325TFZ6KOpzYf9E84i', 'Estrategia', 'Administrador', NULL, 1, '2025-02-04 23:04:53', '2024-05-22 02:51:19'),
(25, 'Jorge', 'JorgePlan', '$2a$07$asxx54ahjppf45sd87a5auCseuQDrLZZ7ic0MltFw4qsxZXNnhb/K', 'Estrategia', 'Administrador', NULL, 1, '2024-12-23 18:12:15', '2024-10-18 17:27:37'),
(26, 'Ornela', 'OrnelaPlan', '$2a$07$asxx54ahjppf45sd87a5auF964pzcuwj/zySN7jCfGu.f443ilD02', 'Estrategia', 'Administrador', NULL, 1, '2024-11-20 13:09:13', '2024-10-18 19:39:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
