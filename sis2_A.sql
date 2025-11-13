-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2025 a las 09:13:51
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
-- Base de datos: `sis2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_actividades`
--

CREATE TABLE `log_actividades` (
  `id_log` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_bien` int(11) DEFAULT NULL,
  `accion` varchar(100) NOT NULL,
  `descripcion_accion` text DEFAULT NULL,
  `fecha_accion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime NOT NULL,
  `token` varchar(30) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id`, `id_usuario`, `fecha_hora_inicio`, `fecha_hora_fin`, `token`, `ip_address`, `user_agent`) VALUES
(43, 18, '2025-10-21 05:17:59', '2025-10-21 05:26:23', 'YyVLVvrFWn3w1hZy8SNjSpx)h6f]#x', NULL, NULL),
(44, 18, '2025-10-21 05:28:42', '2025-10-21 05:48:20', 'bjo*ZQTT0sMVT{5RaSbTF5P4pYX2vB', NULL, NULL),
(45, 18, '2025-10-21 05:47:31', '2025-10-21 06:09:09', '%Cj#6T7R@exZ#AJ[p}y3O0&}8wdcct', NULL, NULL),
(46, 18, '2025-10-22 18:27:07', '2025-10-22 23:04:41', 'N1u*h3sgz{G*HU*GV3IaQG[)8$C9DE', NULL, NULL),
(47, 18, '2025-10-22 23:04:17', '2025-10-22 23:05:23', 'G[[R7Hl*p2[TncrIB@BBemKmxUkwmG', NULL, NULL),
(48, 13, '2025-10-22 23:05:44', '2025-10-22 23:07:53', '4()qnCo%VMH#%08Lc05$)3A1pkrkXi', NULL, NULL),
(49, 18, '2025-10-22 23:07:13', '2025-10-22 23:20:27', '9p$fjzXXqXtWlY4Wc)O9T3&IQWX}Jo', NULL, NULL),
(50, 18, '2025-10-22 23:19:56', '2025-10-23 00:16:21', 'Nyh{jFlFyRNx%RF@tPgNYcC#/K[V8r', NULL, NULL),
(51, 18, '2025-10-23 08:12:00', '2025-10-23 10:13:35', 'mAIppPr%HZ24J)ejLmOJG}%qDKZeJk', NULL, NULL),
(52, 18, '2025-11-06 01:51:34', '2025-11-06 02:09:14', 'qc1j{)6f(/E[qop9WBsMZeFY{h9Nv4', NULL, NULL),
(53, 18, '2025-11-06 02:13:53', '2025-11-06 02:30:59', '&i#Uk]Es(5v2Zs7NVXuvagkJ7OjVD*', NULL, NULL),
(54, 18, '2025-11-06 02:30:18', '2025-11-06 02:31:18', 'UELfRS[nKU)jtzwxYU(uvAw]uJw$E]', NULL, NULL),
(55, 18, '2025-11-06 02:33:26', '2025-11-06 02:39:35', 'zh&uWNCv98d5%lF%S]hbh*iL0{gwNr', NULL, NULL),
(56, 18, '2025-11-08 22:16:39', '2025-11-08 22:41:44', '[R2SG1)o/rvC2h9icB2@Es7SDwylcU', NULL, NULL),
(57, 18, '2025-11-09 11:08:24', '2025-11-09 12:05:15', 'sukwRfvrt5f@aOpI%4r%R7QA&f/Epd', NULL, NULL),
(58, 18, '2025-11-11 18:50:15', '2025-11-11 18:52:15', 'e%H0G5yL*#C3nN88amDUQx6r#U8n5J', NULL, NULL),
(59, 18, '2025-11-11 18:50:15', '2025-11-12 01:02:37', 'kIY8/6UETTvdRtp5sHRmrc@]DdirCL', NULL, NULL),
(60, 18, '2025-11-12 18:06:48', '2025-11-13 03:11:24', 'HthZFkh(KSTy/TcnscQ{ueuWtbdQep', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens_api`
--

CREATE TABLE `tokens_api` (
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tokens_api`
--

INSERT INTO `tokens_api` (`token`) VALUES
('5fdbe4b8d48d1ee52bc371db8b23cf2a-20251023-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `dni` varchar(11) NOT NULL,
  `nombres_apellidos` varchar(140) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `password` varchar(1000) NOT NULL,
  `id_dependencia` int(11) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `tipo_usuario` enum('ADMINISTRATIVO','DOCENTE','ESTUDIANTE','PERSONAL_APOYO') NOT NULL,
  `rol_sistema` enum('ADMINISTRADOR','SUPERVISOR','OPERADOR','CONSULTA') DEFAULT 'CONSULTA',
  `estado` int(11) NOT NULL DEFAULT 1,
  `reset_password` int(1) NOT NULL DEFAULT 0,
  `token_password` varchar(30) NOT NULL DEFAULT '',
  `ultimo_acceso` timestamp NULL DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `dni`, `nombres_apellidos`, `correo`, `telefono`, `password`, `id_dependencia`, `id_carrera`, `tipo_usuario`, `rol_sistema`, `estado`, `reset_password`, `token_password`, `ultimo_acceso`, `fecha_registro`, `fecha_actualizacion`) VALUES
(13, '10123456', 'Luis Alberto Ramos', 'luis.ramos@instituto.edu.pe', '946123456', '$2b$10$fMEaHoPW3rXV3hQh/l3eKOQ.YtKtGLSk39Q1oFnJqT/nKFUze/hKu', 2, 1, 'ADMINISTRATIVO', 'ADMINISTRADOR', 1, 1, '1Ih1qD/sS%UJ@1SyAUd]tme2/T*%&I', NULL, '2025-09-11 00:16:02', '2025-09-11 01:27:55'),
(14, '10234567', 'Ana MarÃ­a Quispe', 'ana.quispe@instituto.edu.pe', '946123457', '$2b$10$YjRmKmfibz9A6p4ypgDrHuqgrwzAfNCoHONQ/ftnCcQ2RytIEOapu', 2, 1, 'DOCENTE', 'OPERADOR', 1, 1, '', NULL, '2025-09-11 00:16:02', '2025-09-11 00:19:41'),
(15, '10345678', 'Carlos Miguel Huaman', 'carlos.huaman@instituto.edu.pe', '946123458', '$2b$10$92ZYrFFGevGawieCHBMLDeMJ219/mqjn1MWuSiInq6yoYYyhOg5ji', 3, 3, 'DOCENTE', 'OPERADOR', 1, 1, '', NULL, '2025-09-11 00:16:02', '2025-09-11 00:19:41'),
(16, '10456789', 'MarÃ­a Fernanda Ortiz', 'maria.ortiz@instituto.edu.pe', '946123459', '$2b$10$1syakDf0dy9PFrBR5qXLDuRDbanxlpUtAGBxU3u9y2YyHJqum4VzW', 2, 1, 'ESTUDIANTE', 'CONSULTA', 1, 1, '', NULL, '2025-09-11 00:16:02', '2025-09-11 00:19:41'),
(17, '10567890', 'Javier Enrique Sosa', 'javier.sosa@instituto.edu.pe', '946123460', '$2b$10$ZUnnlc8uCtXo7cgasf1Cau6yDTw3lJ9NbtMi6bKO248380l6xhGM6', 4, 4, 'PERSONAL_APOYO', 'OPERADOR', 1, 1, '', NULL, '2025-09-11 00:16:02', '2025-09-11 00:19:41'),
(18, '71816086', 'Alexis Gabriel VALDIVIA TRUCIOS', 'valdivia@gmail.com', '974653924', '$2y$10$2.1/w3XToUivOhtULplNq.5rNHAeItt2NGKsZaoS/gGGxzRLs6G8u', NULL, NULL, 'ADMINISTRATIVO', 'CONSULTA', 1, 0, '', NULL, '2025-09-10 20:40:05', '2025-09-11 01:40:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `log_actividades`
--
ALTER TABLE `log_actividades`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_bien` (`id_bien`),
  ADD KEY `idx_usuario_log` (`id_usuario`),
  ADD KEY `idx_fecha_log` (`fecha_accion`),
  ADD KEY `idx_accion` (`accion`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_token` (`token`),
  ADD KEY `idx_usuario_sesion` (`id_usuario`),
  ADD KEY `idx_fecha_inicio` (`fecha_hora_inicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_dependencia` (`id_dependencia`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `log_actividades`
--
ALTER TABLE `log_actividades`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `log_actividades`
--
ALTER TABLE `log_actividades`
  ADD CONSTRAINT `log_actividades_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `log_actividades_ibfk_2` FOREIGN KEY (`id_bien`) REFERENCES `bienes` (`id_bien`);

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_dependencia`) REFERENCES `dependencias` (`id_dependencia`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
