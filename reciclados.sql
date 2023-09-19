-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2023 a las 00:17:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reciclados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `department`
--

INSERT INTO `department` (`id`, `code`, `name`) VALUES
(1, 'AC', 'ATENCIÓN AL CLIENTE'),
(2, 'RH', 'RECURSOS HUMANOS'),
(3, 'CM', 'COMERCIAL'),
(4, 'LP', 'LIMPIEZA'),
(5, 'PR', 'PLANTA DE RECICLAJE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `id_departament` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `name_cliente` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `id_users` int(11) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `reactiva_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `observation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `id_departament`, `description`, `name_cliente`, `company`, `phone`, `id_users`, `created_date`, `update_date`, `deleted_date`, `reactiva_date`, `status`, `observation`) VALUES
(1, 3, 'AQUI ESTAMOS DOS', 'carlos guzman', 'luis', '0412-1525588', 1, '2023-09-17 20:10:33', '2023-09-18 16:31:16', NULL, NULL, 2, 'FALTA OTRA'),
(2, 1, 'LIMPIEZA EJECUTIVAS', 'CARMEN GONZALEZ', 'LIMPIEZA C.A', '0416-8524100', 1, '2023-09-17 20:13:11', '2023-09-18 15:41:51', '2023-09-18 18:11:21', '2023-09-18 18:13:00', 3, 'QUEDO BIEN LIMPIO'),
(3, 1, 'HOLA COMO ESTAS ES UN AVANCE', 'RAUL PADRON', 'CASTROL C.A.', '0412-7845522', 2, '2023-09-18 17:04:59', NULL, NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `code` varchar(5) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `code`, `name`) VALUES
(1, 'JF', 'JEFE'),
(2, 'RE', 'RESPONSABLE DEL EQUIPO'),
(3, 'EM', 'EMPLEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `code`, `name`) VALUES
(1, 'PD', 'PENDIENTE'),
(2, 'PC', 'EN PROCESO'),
(3, 'TM', 'TERMINADO'),
(4, 'EL', 'ELIMINADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `id_department`, `id_rol`, `created_at`) VALUES
(1, 'KATHEREN SALOM', 'katherensalom@gmail.com', '123456', 1, 1, '2023-09-17 16:23:30'),
(2, 'AZUCENA MARTIN', 'azucena.martin@x-netdigital.com', '123456', 3, 1, '2023-09-18 16:24:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
