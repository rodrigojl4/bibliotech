-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2026 a las 11:25:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bibliotech_db`
--
CREATE DATABASE IF NOT EXISTS `bibliotech_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bibliotech_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

DROP TABLE IF EXISTS `auditoria`;
CREATE TABLE IF NOT EXISTS `auditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) DEFAULT NULL,
  `accion` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `accion`, `fecha`) VALUES
(1, '0', 'Prestó el serial SN-69D8D921BEDB9 a Pedro hasta el 2026-04-30.', '2026-04-10 13:28:58'),
(2, '0', 'Movió el serial SN-D1E36-8846 a \'DISPONIBLE\'.', '2026-04-10 13:30:00'),
(3, '0', 'Prestó el serial SN-D1E36-8846 a San juan hasta el 2026-04-30.', '2026-04-10 13:30:19'),
(4, '0', 'Prestó el serial SN-69D8D2C8B77C1 a San juan hasta el 2026-04-30.', '2026-04-10 13:31:44'),
(5, '0', 'Movió el serial SN-69D8D921BEDB9 a \'DISPONIBLE\'.', '2026-04-10 13:38:54'),
(6, '0', 'Movió el serial SN-69D8D2C8B77C1 a \'DISPONIBLE\'.', '2026-04-10 13:39:03'),
(7, '0', 'Prestó el serial SN-69D8D921BEDB9 a Antonua hasta el 2026-04-30.', '2026-04-10 13:39:47'),
(8, '0', 'Eliminó el material maestro ID: 39', '2026-04-10 13:43:31'),
(9, '0', 'Prestó el serial SN-69D8DA4B044C9 a Rodri hasta el 2026-04-02.', '2026-04-10 13:45:03'),
(10, '0', 'Movió el serial SN-69D8DA4B044C9 a \'ROTO\'.', '2026-04-10 13:45:29'),
(11, '0', 'Movió el serial SN-69D8D921BEDB9 a \'DISPONIBLE\'.', '2026-04-10 13:45:45'),
(12, '0', 'Movió el serial SN-D1E36-8846 a \'DISPONIBLE\'.', '2026-04-10 13:45:54'),
(13, '0', 'Movió el serial SN-69D8DA4B044C9 a \'DISPONIBLE\'.', '2026-04-10 13:46:39'),
(14, '0', 'Asignó el serial SN-69D8D921BEDB9 al aula: A12.', '2026-04-10 13:58:37'),
(15, '0', 'Movió el serial SN-69D8D921BEDB9 a \'DISPONIBLE\'.', '2026-04-10 13:58:53'),
(16, '0', 'Añadió 10 unidad(es) de \'Pantallas doc\' en estado \'PEDIDO\'.', '2026-04-10 14:01:50'),
(17, '0', 'Movió el serial SN-6A587-2653 a \'DISPONIBLE\'.', '2026-04-10 14:02:01'),
(18, '0', 'Movió el serial SN-6B14F-4742 a \'DISPONIBLE\'.', '2026-04-10 14:03:15'),
(19, '0', 'Movió el serial SN-6BCDE-8791 a \'DISPONIBLE\'.', '2026-04-10 14:03:16'),
(20, '0', 'Movió el serial SN-6BBF4-9365 a \'DISPONIBLE\'.', '2026-04-10 14:03:17'),
(21, '0', 'Añadió 1 unidad(es) de \'El principito\' en estado \'DISPONIBLE\'.', '2026-04-10 14:03:48'),
(22, '0', 'Asignó el serial SN-69D8D921BEDB9 al aula: A12.', '2026-04-10 14:07:12'),
(23, '0', 'Movió el serial SN-69D8D921BEDB9 a \'ROTO\'.', '2026-04-10 14:07:20'),
(24, '0', 'Movió el serial SN-69D8D921BEDB9 a \'DISPONIBLE\'.', '2026-04-10 14:07:31'),
(25, '0', 'Movió el serial SN-6BD96-7834 a \'DISPONIBLE\'.', '2026-04-10 14:17:26'),
(26, '0', 'Movió el serial SN-6BE52-7844 a \'DISPONIBLE\'.', '2026-04-10 14:17:26'),
(27, '0', 'Movió el serial SN-6BF75-9983 a \'DISPONIBLE\'.', '2026-04-10 14:17:26'),
(28, '0', 'Movió el serial SN-6C02B-7323 a \'DISPONIBLE\'.', '2026-04-10 14:17:26'),
(29, '0', 'Movió el serial SN-6C0C2-4356 a \'DISPONIBLE\'.', '2026-04-10 14:17:26'),
(30, '0', 'Movió el serial SN-6C14A-3434 a \'DISPONIBLE\'.', '2026-04-10 14:17:26'),
(31, '0', 'Movió el serial SN-6A587-2653 a \'ROTO\'.', '2026-04-10 14:28:00'),
(32, '0', 'Movió el serial SN-6B14F-4742 a \'ROTO\'.', '2026-04-10 14:28:00'),
(33, '0', 'Movió el serial SN-6A587-2653 a \'DISPONIBLE\'.', '2026-04-10 14:28:17'),
(34, '0', 'Movió el serial SN-6B14F-4742 a \'DISPONIBLE\'.', '2026-04-10 14:28:17'),
(35, '0', 'Asignó el serial SN-6B14F-4742 al aula: 11.', '2026-04-10 14:29:05'),
(36, '0', 'Eliminó el material maestro ID: 41', '2026-04-10 14:51:21'),
(37, '0', 'Prestó el serial SN-69D8D921BEDB9 a 2 hasta el 2026-04-22.', '2026-04-10 14:51:38'),
(38, '0', 'Prestó el serial SN-6A587-2653 a 3 hasta el 2026-04-15.', '2026-04-10 14:51:48'),
(39, '0', 'Añadió 1 unidad(es) de \'Pedro\' en estado \'ROTO\'.', '2026-04-15 08:50:27'),
(40, '0', 'Movió el serial SN-040BD-8896 a \'DISPONIBLE\'.', '2026-04-15 08:51:11'),
(41, '0', 'Añadió 1 unidad(es) de \'Juan\' en estado \'PEDIDO\'.', '2026-04-15 08:57:14'),
(42, '0', 'Movió el serial SN-D47E3-6281 a \'DISPONIBLE\'.', '2026-04-15 08:57:20'),
(43, '0', 'Eliminó el material maestro ID: 43', '2026-04-15 08:58:00'),
(44, '0', 'Añadió 1 unidad(es) de \'Juan\' en estado \'ROTO\'.', '2026-04-15 09:02:44'),
(45, '0', 'Eliminó el material maestro ID: 44', '2026-04-15 09:04:15'),
(46, '0', 'Eliminó el material maestro ID: 42', '2026-04-15 09:04:17'),
(47, '0', 'Eliminó el material maestro ID: 22', '2026-04-15 11:14:56'),
(48, '0', 'Asignó el serial SN-6BBF4-9365 al aula: 12.', '2026-04-15 11:16:56'),
(49, '0', 'Prestó el serial SN-6BCDE-8791 a 2 hasta el 2026-04-23.', '2026-04-15 11:17:52'),
(50, '0', 'Movió el serial SN-69D8D921BEDB9 a \'ROTO\'.', '2026-04-15 11:18:08'),
(51, '0', 'Eliminó el material maestro ID: 40', '2026-04-15 11:18:19'),
(52, '0', 'Eliminó el material maestro ID: 26', '2026-04-15 11:20:24'),
(53, '0', 'Movió el serial SN-69D8D921BEDB9 a \'PEDIDO\'.', '2026-04-15 11:22:44'),
(54, '0', 'Movió el serial SN-69D8D921BEDB9 a \'DISPONIBLE\'.', '2026-04-15 11:22:51'),
(55, '0', 'Prestó el serial SN-69D8D921BEDB9 a 2 hasta el 2026-04-10.', '2026-04-15 11:23:02'),
(56, '0', 'Asignó el serial SN-69D8D21C15648 al aula: 22.', '2026-04-15 11:23:04'),
(57, '0', 'Movió el serial SN-69D8D921BEDB9 a \'DISPONIBLE\'.', '2026-04-15 11:23:28'),
(58, '0', 'Añadió 1 unidad(es) de \'Juan\' en estado \'PEDIDO\'.', '2026-04-15 11:29:31'),
(59, '0', 'Eliminó el material maestro ID: 45', '2026-04-15 11:32:52'),
(60, '0', 'Eliminó el material maestro ID: 38', '2026-04-15 11:32:54'),
(61, '0', 'Eliminó el material maestro ID: 36', '2026-04-15 11:32:59'),
(62, '0', 'Eliminó el material maestro ID: 35', '2026-04-15 11:33:02'),
(63, '0', 'Eliminó el material maestro ID: 34', '2026-04-15 11:33:04'),
(64, '0', 'Añadió 1 unidad(es) de \'Teclado Acer\' en estado \'ROTO\'.', '2026-04-15 11:33:48'),
(65, '0', 'Añadió 1 unidad(es) de \'Ratones Logitec Nuevos\' en estado \'DISPONIBLE\'.', '2026-04-15 11:34:36'),
(66, '0', 'Añadió 10 unidad(es) de \'Pantalla Asus\' en estado \'PEDIDO\'.', '2026-04-15 11:35:18'),
(67, '0', 'Añadió 1 unidad(es) de \'Silla\' en estado \'ROTO\'.', '2026-04-15 11:44:47'),
(68, '0', 'Añadió 2 unidad(es) de \'Altavoces\' en estado \'DISPONIBLE\'.', '2026-04-15 11:45:32'),
(69, '0', 'Asignó el serial SN-3FB1B-4836 al aula: D30.', '2026-04-15 11:45:44'),
(70, '0', 'Prestó el serial SN-3FC64-3844 a Juan hasta el 2026-04-23.', '2026-04-15 11:46:06'),
(71, '0', 'Eliminó el material maestro ID: 32', '2026-04-15 11:47:49'),
(72, '0', 'Eliminó el material maestro ID: 25', '2026-04-15 11:47:52'),
(73, '0', 'Eliminó el material maestro ID: 29', '2026-04-15 11:47:56'),
(74, '0', 'Eliminó el material maestro ID: 31', '2026-04-15 11:48:00'),
(75, '0', 'Eliminó el material maestro ID: 30', '2026-04-15 11:48:03'),
(76, '0', 'Eliminó el material maestro ID: 28', '2026-04-15 11:48:05'),
(77, '0', 'Eliminó el material maestro ID: 27', '2026-04-15 11:48:08'),
(78, '0', 'Añadió 2 unidad(es) de \'Ordenador Asus\' en estado \'DISPONIBLE\'.', '2026-04-29 08:49:55'),
(79, '0', 'Añadió 1 unidad(es) de \'Los futbolisimos\' en estado \'DISPONIBLE\'.', '2026-04-29 08:50:57'),
(80, '0', 'Añadió 1 unidad(es) de \'teclado\' en estado \'DISPONIBLE\'.', '2026-04-29 10:48:54'),
(81, '0', 'Movió el serial SN-C0D52-9954 a \'ROTO\'.', '2026-04-29 10:49:43'),
(82, '0', 'Movió el serial SN-C0FC7-1389 a \'ROTO\'.', '2026-04-29 10:49:43'),
(83, '0', 'Movió el serial SN-E5787-1159 a \'ROTO\'.', '2026-04-29 10:49:43'),
(84, '0', 'Eliminó el material maestro ID: 53', '2026-04-29 10:50:30'),
(85, '0', 'Prestó el serial SN-03696-5045 a Pedro hasta el 2026-04-30.', '2026-04-29 10:52:06'),
(86, '0', 'Movió el serial SN-F2045-7822 a \'DISPONIBLE\'.', '2026-04-29 10:52:45'),
(87, '0', 'Movió el serial SN-F21BA-6819 a \'DISPONIBLE\'.', '2026-04-29 10:52:49'),
(88, '0', 'Asignó el serial SN-F2045-7822 al aula: Aula D22.', '2026-04-29 10:53:38'),
(89, '0', 'Movió el serial SN-3FB1B-4836 a \'DISPONIBLE\'.', '2026-04-29 10:54:41'),
(90, '0', 'Asignó el serial SN-3FB1B-4836 al aula: A14.', '2026-04-29 11:31:12'),
(91, '0', 'Asignó el serial SN-F21BA-6819 al aula: A11.', '2026-04-29 11:35:13'),
(92, '0', 'Movió el material ID: 52 al historial (borrado lógico).', '2026-04-29 12:09:02'),
(93, '0', 'Movió el serial SN-C0D52-9954 a \'ROTO\'.', '2026-04-29 12:09:48'),
(94, '0', 'Movió el serial SN-C0D52-9954 a \'DISPONIBLE\'.', '2026-04-29 12:09:55'),
(95, '0', 'Movió el serial SN-3FB1B-4836 a \'ROTO\'.', '2026-04-29 12:14:48'),
(96, '0', 'Movió el serial SN-3FB1B-4836 a \'DISPONIBLE\'.', '2026-04-29 12:14:52'),
(97, '0', 'Restauró el material ID: 52 desde el historial.', '2026-04-29 12:15:42'),
(98, '0', 'Movió el material ID: 52 al historial (borrado lógico).', '2026-04-29 13:17:17'),
(99, '0', 'Movió el material ID: 51 al historial (borrado lógico).', '2026-04-29 13:22:47'),
(100, '0', 'Añadió 1 unidad(es) de \'Caperucita Roja\' en estado \'DISPONIBLE\'.', '2026-04-29 13:50:53'),
(101, '0', 'Movió el serial SN-6865C-8141 a \'ROTO\'.', '2026-04-29 13:51:50'),
(102, '0', 'Añadió 1 unidad(es) de \'Disco duro \'.', '2026-04-29 14:13:55'),
(103, '0', 'Asignó SN-3FB1B-4836 a aula: A08.', '2026-04-29 14:24:57'),
(104, '0', 'Cambió serial SN-C354F-6614 a \'DISPONIBLE\'.', '2026-04-29 14:27:54'),
(105, '0', 'Movió el material ID: 46 al historial.', '2026-04-29 14:28:01'),
(106, '0', 'Movió el material ID: 55 al historial.', '2026-04-30 09:38:37'),
(107, '0', 'Añadió 1 unidad(es) de \'Disco duro\'.', '2026-04-30 09:47:02'),
(108, '0', 'Asignó SN-0707B-5958 a aula: A07.', '2026-04-30 10:15:52'),
(109, '0', 'Movió el material ID: 48 al historial.', '2026-04-30 10:20:54'),
(110, '0', 'Cambió serial SN-F2308-3017 a \'DISPONIBLE\'.', '2026-04-30 10:24:41'),
(111, '0', 'Añadió 3 unidad(es) de \'sdd\'.', '2026-04-30 10:31:17'),
(112, '0', 'Cambió serial SN-E5787-1159 a \'DISPONIBLE\'.', '2026-04-30 10:39:13'),
(113, '0', 'Cambió serial SN-56BE9-8538 a \'ROTO\'.', '2026-04-30 10:39:25'),
(114, '0', 'Cambió serial SN-56BE9-8538 a \'PEDIDO\'.', '2026-04-30 10:39:32'),
(115, '0', 'Prestó SN-56DCE-5148 a .', '2026-04-30 10:40:07'),
(116, '0', 'Cambió serial SN-56DCE-5148 a \'DISPONIBLE\'.', '2026-04-30 10:40:22'),
(117, '0', 'Prestó SN-579AB-7760 a .', '2026-04-30 10:40:42'),
(118, '0', 'Eliminó material ID: 56', '2026-04-30 10:43:17'),
(119, '0', 'Reactivó el material ID: 56', '2026-04-30 10:48:03'),
(120, '0', 'Reactivó el material ID: 46', '2026-04-30 10:48:08'),
(121, '0', 'Eliminó material ID: 56', '2026-04-30 10:48:16'),
(122, '0', 'Reactivó el material ID: 56', '2026-04-30 10:48:27'),
(123, '0', 'Reactivó el material ID: 51', '2026-04-30 10:48:28'),
(124, '0', 'Reactivó el material ID: 52', '2026-04-30 10:48:30'),
(125, '0', 'Eliminó material ID: 56', '2026-04-30 10:49:31'),
(126, '0', 'Reactivó el material ID: 56', '2026-04-30 10:49:36'),
(127, '0', 'Cambió serial SN-56BE9-8538 a \'ROTO\'.', '2026-04-30 10:49:42'),
(128, '0', 'Cambió serial SN-56BE9-8538 a \'PEDIDO\'.', '2026-04-30 10:49:48'),
(129, '0', 'Cambió serial SN-C0D52-9954 a \'PEDIDO\'.', '2026-04-30 10:49:59'),
(130, '0', 'Cambió serial SN-28456-5818 a \'PEDIDO\'.', '2026-04-30 10:49:59'),
(131, '0', 'Añadió 1 unidad(es) de \'El principito\'.', '2026-04-30 10:50:36'),
(132, '0', 'Reactivó el material ID: 55', '2026-04-30 10:51:39'),
(133, '0', 'Eliminó material ID: 58', '2026-04-30 10:51:43'),
(134, '0', 'Prestó SN-C354F-6614 a .', '2026-04-30 10:51:56'),
(135, '0', 'Asignó SN-E5787-1159 a aula: A31.', '2026-04-30 10:56:47'),
(136, '0', 'Reactivó el material ID: 48', '2026-04-30 11:00:40'),
(137, '0', 'Prestó SN-56DCE-5148 a ee.', '2026-04-30 11:09:49'),
(138, '0', 'Cambió serial SN-F242D-6598 a \'DISPONIBLE\'.', '2026-04-30 11:10:19'),
(139, '0', 'Cambió serial SN-F2FE0-1184 a \'DISPONIBLE\'.', '2026-04-30 11:10:19'),
(140, '0', 'Cambió serial SN-F312F-6907 a \'DISPONIBLE\'.', '2026-04-30 11:10:35'),
(141, '0', 'Cambió serial SN-F3231-5295 a \'DISPONIBLE\'.', '2026-04-30 11:10:35'),
(142, '0', 'Cambió serial SN-F330D-7741 a \'DISPONIBLE\'.', '2026-04-30 11:10:35'),
(143, '0', 'Prestó SN-F2308-3017 a rr.', '2026-04-30 11:11:13'),
(144, '0', 'Cambió serial SN-E5787-1159 a \'DISPONIBLE\'.', '2026-04-30 11:11:56'),
(145, '0', 'Cambió serial SN-F2045-7822 a \'DISPONIBLE\'.', '2026-04-30 11:11:56'),
(146, '0', 'Eliminó material ID: 54', '2026-04-30 11:12:18'),
(147, '0', 'Reactivó el material ID: 54', '2026-04-30 11:12:29'),
(148, '0', 'Añadió 1 unidad(es) de \'USB\'.', '2026-04-30 11:12:58'),
(149, '0', 'Cambió serial SN-F2045-7822 a \'PEDIDO\'.', '2026-04-30 11:14:55'),
(150, '0', 'Cambió serial SN-F242D-6598 a \'PEDIDO\'.', '2026-04-30 11:14:55'),
(151, '0', 'Prestó SN-E5787-1159 a a.', '2026-04-30 11:15:09'),
(152, '0', 'Eliminó material ID: 59', '2026-04-30 11:16:08'),
(153, '0', 'Reactivó el material ID: 59', '2026-04-30 11:16:18'),
(154, '0', 'Cambió serial SN-56BE9-8538 a \'ROTO\'.', '2026-04-30 11:16:52'),
(155, '0', 'Cambió serial SN-C0FC7-1389 a \'PEDIDO\'.', '2026-04-30 11:28:59'),
(156, '0', 'Cambió serial SN-F33FA-6810 a \'ROTO\'.', '2026-04-30 11:29:09'),
(157, '0', 'Cambió serial SN-C354F-6614 a \'ROTO\'.', '2026-04-30 11:29:20'),
(158, '0', 'Cambió serial SN-56BE9-8538 a \'DISPONIBLE\'.', '2026-04-30 11:29:29'),
(159, '0', 'Asignó SN-0A2A7-6537 a aula: A22.', '2026-04-30 11:30:03'),
(160, '0', 'Cambió serial SN-0707B-5958 a \'DISPONIBLE\'.', '2026-04-30 11:30:18'),
(161, '0', 'Eliminó material ID: 46', '2026-04-30 11:30:34'),
(162, '0', 'Añadió 3 unidad(es) de \'Cable hdmi\'.', '2026-04-30 11:31:22'),
(163, '0', 'Cambió serial SN-F2FE0-1184 a \'ROTO\'.', '2026-04-30 11:36:38'),
(164, '0', 'Cambió serial SN-F2FE0-1184 a \'DISPONIBLE\'.', '2026-04-30 11:38:13'),
(165, '0', 'Añadió 3 unidad(es) de \'Silla con ruedas\'.', '2026-04-30 11:41:06'),
(166, '0', 'Eliminó material ID: 47', '2026-04-30 11:43:29'),
(167, '0', 'Añadió 4 unidad(es) de \'Ordenador Lenovo 32ram\'.', '2026-04-30 12:02:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

DROP TABLE IF EXISTS `aulas`;
CREATE TABLE IF NOT EXISTS `aulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id`, `nombre`) VALUES
(5, 'A01'),
(6, 'A02'),
(7, 'A03'),
(8, 'A04'),
(9, 'A05'),
(10, 'A06'),
(11, 'A07'),
(12, 'A08'),
(13, 'A09'),
(14, 'A10'),
(15, 'A11'),
(16, 'A12'),
(17, 'A13'),
(18, 'A14'),
(19, 'A15'),
(20, 'A16'),
(21, 'A17'),
(22, 'A18'),
(23, 'A19'),
(24, 'A20'),
(25, 'A21'),
(26, 'A22'),
(27, 'B01'),
(28, 'B02'),
(29, 'B03'),
(30, 'B04'),
(31, 'B05'),
(32, 'B06'),
(33, 'B07'),
(34, 'B08'),
(35, 'B09'),
(36, 'B10'),
(37, 'B11'),
(38, 'B12'),
(39, 'B13'),
(40, 'B14'),
(41, 'B15'),
(42, 'B16'),
(43, 'B17'),
(44, 'B18'),
(45, 'B19'),
(46, 'B20'),
(47, 'B21'),
(48, 'B22'),
(49, 'C01'),
(50, 'C02'),
(51, 'C03'),
(52, 'C04'),
(53, 'C05'),
(54, 'C06'),
(55, 'C07'),
(56, 'C08'),
(57, 'C09'),
(58, 'C10'),
(59, 'C11'),
(60, 'C12'),
(61, 'C13'),
(62, 'C14'),
(63, 'C15'),
(64, 'C16'),
(65, 'C17'),
(66, 'C18'),
(67, 'C19'),
(68, 'C20'),
(69, 'C21'),
(70, 'C22'),
(71, 'D01'),
(72, 'D02'),
(73, 'D03'),
(74, 'D04'),
(75, 'D05'),
(76, 'D06'),
(77, 'D07'),
(78, 'D08'),
(79, 'D09'),
(80, 'D10'),
(81, 'D11'),
(82, 'D12'),
(83, 'D13'),
(84, 'D14'),
(85, 'D15'),
(86, 'D16'),
(87, 'D17'),
(88, 'D18'),
(89, 'D19'),
(90, 'D20'),
(91, 'D21'),
(92, 'D22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Informática'),
(2, 'Mobiliario'),
(3, 'Multimedia'),
(4, 'Libros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_fisicos`
--

DROP TABLE IF EXISTS `items_fisicos`;
CREATE TABLE IF NOT EXISTS `items_fisicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) NOT NULL,
  `codigo_serial` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'DISPONIBLE',
  `notas_estado` text DEFAULT NULL,
  `prestado_a` varchar(100) DEFAULT NULL,
  `fecha_limite` date DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `aula_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_serial` (`codigo_serial`),
  KEY `idx_items_estado` (`estado`),
  KEY `material_id` (`material_id`),
  KEY `fk_items_aulas` (`aula_id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `items_fisicos`
--

INSERT INTO `items_fisicos` (`id`, `material_id`, `codigo_serial`, `estado`, `notas_estado`, `prestado_a`, `fecha_limite`, `ubicacion`, `aula_id`) VALUES
(70, 46, 'SN-C354F-6614', 'ROTO', NULL, NULL, NULL, NULL, NULL),
(71, 47, 'SN-E5787-1159', 'PRESTADO', NULL, 'a', '2026-05-08', NULL, NULL),
(72, 48, 'SN-F2045-7822', 'PEDIDO', NULL, NULL, NULL, NULL, NULL),
(73, 48, 'SN-F21BA-6819', 'EN_USO', NULL, NULL, NULL, 'A11', NULL),
(74, 48, 'SN-F2308-3017', 'PRESTADO', NULL, 'rr', '2026-04-30', NULL, NULL),
(75, 48, 'SN-F242D-6598', 'PEDIDO', NULL, NULL, NULL, NULL, NULL),
(76, 48, 'SN-F2FE0-1184', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(77, 48, 'SN-F312F-6907', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(78, 48, 'SN-F3231-5295', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(79, 48, 'SN-F330D-7741', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(80, 48, 'SN-F33FA-6810', 'ROTO', NULL, NULL, NULL, NULL, NULL),
(81, 48, 'SN-F34F9-5626', 'PEDIDO', NULL, NULL, NULL, NULL, NULL),
(82, 49, 'SN-8984A-5439', 'ROTO', NULL, NULL, NULL, NULL, NULL),
(83, 50, 'SN-3FB1B-4836', 'EN_USO', NULL, NULL, NULL, 'A08', NULL),
(84, 50, 'SN-3FC64-3844', 'PRESTADO', NULL, 'Juan', '2026-04-23', NULL, NULL),
(85, 51, 'SN-C0D52-9954', 'PEDIDO', NULL, NULL, NULL, NULL, NULL),
(86, 51, 'SN-C0FC7-1389', 'PEDIDO', NULL, NULL, NULL, NULL, NULL),
(87, 52, 'SN-03696-5045', 'PRESTADO', NULL, 'Pedro', '2026-04-30', NULL, NULL),
(89, 54, 'SN-6865C-8141', 'ROTO', NULL, NULL, NULL, NULL, NULL),
(90, 55, 'SN-0707B-5958', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(91, 56, 'SN-28456-5818', 'PEDIDO', NULL, NULL, NULL, NULL, NULL),
(92, 57, 'SN-56BE9-8538', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(93, 57, 'SN-56DCE-5148', 'PRESTADO', NULL, 'ee', '2026-05-08', NULL, NULL),
(94, 57, 'SN-579AB-7760', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(95, 58, 'SN-29BF7-9532', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(96, 59, 'SN-0A2A7-6537', 'EN_USO', NULL, NULL, NULL, 'A22', NULL),
(97, 60, 'SN-587CA-1515', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(98, 60, 'SN-5890E-3312', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(99, 60, 'SN-593B9-1173', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(100, 61, 'SN-96AB8-7325', 'ROTO', NULL, NULL, NULL, NULL, NULL),
(101, 61, 'SN-96C85-1888', 'ROTO', NULL, NULL, NULL, NULL, NULL),
(102, 61, 'SN-96DE0-4349', 'ROTO', NULL, NULL, NULL, NULL, NULL),
(103, 63, 'SN-69578-4924', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(104, 63, 'SN-69903-4816', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(105, 63, 'SN-69A85-4741', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL),
(106, 63, 'SN-69BF6-1044', 'DISPONIBLE', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

DROP TABLE IF EXISTS `materiales`;
CREATE TABLE IF NOT EXISTS `materiales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) DEFAULT 1,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_alta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id`, `nombre`, `descripcion`, `categoria_id`, `imagen_url`, `fecha_registro`, `activo`, `fecha_baja`, `usuario_alta`) VALUES
(46, 'Teclado Acer', 'No funciona la tecla de escape', 1, NULL, '2026-04-15 11:33:48', 0, '2026-04-30 13:30:34', NULL),
(47, 'Ratones Logitec Nuevos', 'Comprados ', 1, NULL, '2026-04-15 11:34:36', 0, '2026-04-30 13:43:29', NULL),
(48, 'Pantalla Asus', 'Recambio aula D11', 1, NULL, '2026-04-15 11:35:18', 1, NULL, NULL),
(49, 'Silla', 'Rota', 2, NULL, '2026-04-15 11:44:47', 1, NULL, NULL),
(50, 'Altavoces', '', 1, NULL, '2026-04-15 11:45:32', 1, NULL, NULL),
(51, 'Ordenador Asus', 'Cambiar por viejos\r\n', 1, NULL, '2026-04-29 08:49:55', 1, NULL, NULL),
(52, 'Los futbolisimos', '', 4, NULL, '2026-04-29 08:50:57', 1, NULL, NULL),
(54, 'Caperucita Roja', 'aaaa', 4, NULL, '2026-04-29 13:50:53', 1, NULL, NULL),
(55, 'Disco duro ', '', 1, NULL, '2026-04-29 14:13:55', 1, NULL, NULL),
(56, 'Disco duro', '', 1, NULL, '2026-04-30 09:47:02', 1, NULL, 'Admin'),
(57, 'sdd', '', 1, NULL, '2026-04-30 10:31:17', 1, NULL, 'Admin'),
(58, 'El principito', '', 3, NULL, '2026-04-30 10:50:36', 0, '2026-04-30 12:51:43', 'Admin'),
(59, 'USB', 'Contiene examen', 1, NULL, '2026-04-30 11:12:58', 1, NULL, 'Admin'),
(60, 'Cable hdmi', '', 1, NULL, '2026-04-30 11:31:22', 1, NULL, 'Sandra'),
(61, 'Silla con ruedas', 'Tienen el respaldo mal', 2, NULL, '2026-04-30 11:41:06', 1, NULL, 'Sandra'),
(63, 'Ordenador Lenovo 32ram', 'nuevos', 1, NULL, '2026-04-30 12:02:39', 1, NULL, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
CREATE TABLE IF NOT EXISTS `prestamos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `fecha_prestamo` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_limite_devolucion` datetime NOT NULL,
  `fecha_devolucion_real` datetime DEFAULT NULL,
  `estado_prestamo` enum('ACTIVO','DEVUELTO','VENCIDO') NOT NULL DEFAULT 'ACTIVO',
  `observaciones_prestamo` text DEFAULT NULL,
  `observaciones_devolucion` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `cargo` varchar(100) DEFAULT 'Usuario',
  `departamento` varchar(100) DEFAULT 'General',
  `sede` varchar(100) DEFAULT 'Campus Central',
  `ultimo_acceso` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `email`, `password`, `rol_id`, `fecha_registro`, `cargo`, `departamento`, `sede`, `ultimo_acceso`) VALUES
(3, 'Admin', 'admin@admin.com', '$2y$10$d4kT6pZx1IjegZZfleqi8urEHhgse2WWTXYaxVEdLELiRq6ixWLPu', 1, '2026-04-08 12:57:52', 'Usuario', 'General', 'Campus Central', '2026-05-02 18:47:14'),
(5, 'Rodrigo Jimenez Lorenzo', 'rodrigo.jimlor@educa.jcyl.es', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, '2026-04-10 14:45:03', 'Creador', 'DAW2', 'D22', '2026-04-29 13:13:52'),
(6, 'Pedro', 'pedro@gmail.com', '$2y$10$eKF8Us364XxjHM0D4Q58ROWvrkETSmstVIkjitCN.RHzGMSa1UjYe', 2, '2026-04-29 12:08:40', 'Usuario', 'General', 'Campus Central', '2026-04-30 11:46:38'),
(8, 'Juan', 'juan@gmail.com', '$2y$10$KpafkFRPbFrlkm7X55T6AeThaU6P3vhfmU4eyyCpd3leuTB9ne0j.', 2, '2026-04-30 10:22:34', 'Usuario', 'General', 'Campus Central', '2026-04-30 10:22:46'),
(9, 'Sandra', 'sandra@gmail.com', '$2y$10$KvXnmLfAeGX5VxNKArHpuuch6AFOfyZUdy3E6ryW9UKbj8FsWxsUi', 1, '2026-04-30 10:41:52', 'Usuario', 'General', 'Campus Central', '2026-04-30 11:46:27');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `items_fisicos`
--
ALTER TABLE `items_fisicos`
  ADD CONSTRAINT `fk_items_aulas` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `items_fisicos_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items_fisicos` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
