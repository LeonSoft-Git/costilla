-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2018 a las 22:26:30
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `primaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(11) NOT NULL,
  `avisos_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdf` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `avisos_id`, `nombre`, `pdf`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Calendario SEP 2018-2019', '713b91af6d09d5b1166f9e6cbca5382c.pdf', 1, '2018-06-26 16:56:24', '2018-06-26 17:03:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE `avisos` (
  `id` int(11) NOT NULL,
  `mensaje` longtext COLLATE utf8_unicode_ci,
  `tipo` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `avisos`
--

INSERT INTO `avisos` (`id`, `mensaje`, `tipo`, `activo`, `created_at`, `updated_at`, `usuarios_id`, `nombre`, `imagen`, `slug`) VALUES
(1, '<p style=\"text-align:center\"><span style=\"font-size:22px\"><strong><span style=\"font-family:Courier New,Courier,monospace\">PRESENTACI&Oacute;N</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Courier New,Courier,monospace\"><span style=\"font-size:16px\">Les presento la nueva pagina web de la Escuela Primaria Miguel Hidalgo y Costilla, espero sea de su agrado.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Courier New,Courier,monospace\"><span style=\"font-size:16px\">Agradezco dejen sus comentarios al respecto.</span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-family:Courier New,Courier,monospace\"><span style=\"font-size:16px\"><img alt=\"\" src=\"http://miguelhidalgoycostilla.website/assets/images/logo.png\" style=\"height:106px; width:100px\" /></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:right\"><span style=\"font-family:Courier New,Courier,monospace\"><span style=\"font-size:16px\">Equipo Desarrollador de&nbsp;<a href=\"https://capacitacioninformatica.com\" target=\"_blank\">CI</a></span></span></p>', NULL, 1, '2018-06-25 21:52:08', '2018-06-26 18:24:30', 1, 'Presentación', '9083642820af77c30be6fe9c806a24a3.png', 'presentacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `enlace` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id`, `nombre`, `url`, `activo`, `created_at`, `updated_at`, `descripcion`, `enlace`) VALUES
(1, 'Escuela Primaria', '07fbbd52403eb6064106d98a96ddc247.jpeg', 1, '2018-06-11 21:14:44', '2018-06-11 21:14:44', 'Miguel Hidalgo y Costilla', NULL),
(2, 'Educación de Calidad', '824902b0770d5136ab1f7b703acb7522.jpeg', 1, '2018-06-11 21:33:48', '2018-06-11 21:33:48', 'Modelo Educativo con los más altos estandares', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `avisos_id` int(11) NOT NULL,
  `comentario` varchar(350) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `respuesta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `usuarios_id`, `avisos_id`, `comentario`, `activo`, `created_at`, `updated_at`, `tipo`, `respuesta`) VALUES
(1, 2, 1, 'quiero mas info de la pagina', 1, '2018-06-26 19:20:49', '2018-06-26 19:20:49', 1, NULL),
(2, 2, 1, 'hola', 1, '2018-06-26 19:26:54', '2018-06-26 19:26:54', 1, NULL),
(3, 1, 1, 'que informacion necesitas?', 1, '2018-06-26 13:49:22', '2018-06-26 13:49:22', 2, 1),
(4, 2, 1, 'gracias', 1, '2018-06-26 14:43:21', '2018-06-26 14:43:21', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensaje` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ext_log_entries`
--

CREATE TABLE `ext_log_entries` (
  `id` int(11) NOT NULL,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ext_translations`
--

CREATE TABLE `ext_translations` (
  `id` int(11) NOT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `nombre`, `url`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Niños', '956d563e4c5f7d5b2cb9e1115eeae7d5.jpeg', 1, '2018-06-25 18:15:22', '2018-06-25 18:15:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscriptores`
--

CREATE TABLE `suscriptores` (
  `id` int(11) NOT NULL,
  `contacto` int(11) DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `valido` tinyint(1) DEFAULT NULL,
  `salt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `user`, `password`, `tipo`, `activo`, `valido`, `salt`, `created_at`, `updated_at`) VALUES
(1, 'cesar', 'rios', 'cesar.rios@capacitacioninformatica.com', 'developer', '123456', 1, 1, 1, NULL, '2018-06-09 00:00:00', '2018-06-09 00:00:00'),
(2, 'francia', 'vallejo', 'francia@test.com', 'francia', '123456', 3, 1, 1, NULL, '2018-06-09 00:00:00', '2018-06-25 19:37:33'),
(3, 'User', 'Admin', 'admin@test.com', 'admin', '123456', 2, 1, NULL, NULL, '2018-06-25 20:10:07', '2018-06-25 20:10:07'),
(4, 'francia', 'vallejo', 'francia@testing.com', 'vallejo', '123456', 3, 1, NULL, NULL, '2018-06-26 20:51:23', '2018-06-26 20:51:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_archivos_avisos1_idx` (`avisos_id`);

--
-- Indices de la tabla `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_avisos_usuarios1_idx` (`usuarios_id`);

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comentarios_usuarios_idx` (`usuarios_id`),
  ADD KEY `fk_comentarios_avisos1_idx` (`avisos_id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ext_log_entries`
--
ALTER TABLE `ext_log_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_class_lookup_idx` (`object_class`),
  ADD KEY `log_date_lookup_idx` (`logged_at`),
  ADD KEY `log_user_lookup_idx` (`username`),
  ADD KEY `log_version_lookup_idx` (`object_id`,`object_class`,`username`);

--
-- Indices de la tabla `ext_translations`
--
ALTER TABLE `ext_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  ADD KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ext_log_entries`
--
ALTER TABLE `ext_log_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ext_translations`
--
ALTER TABLE `ext_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `FK_188D04B3AF5E9CCB` FOREIGN KEY (`avisos_id`) REFERENCES `avisos` (`id`);

--
-- Filtros para la tabla `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `FK_3F08515DF01D3B25` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `FK_F54B3FC0AF5E9CCB` FOREIGN KEY (`avisos_id`) REFERENCES `avisos` (`id`),
  ADD CONSTRAINT `FK_F54B3FC0F01D3B25` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
