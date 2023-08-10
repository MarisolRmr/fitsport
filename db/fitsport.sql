-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2023 a las 14:18:59
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
-- Base de datos: `fitsport`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `explicacion` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id`, `nombre`, `descripcion`, `explicacion`, `imagen`, `created_at`, `updated_at`) VALUES
(6, 'ql', 'qk', 'qk', '00c45e2b-9382-4556-ae11-fede6ce50e92.jpg', '2023-08-02 18:47:55', '2023-08-02 19:11:38'),
(7, 'Plancha abdominal', 'La plancha abdominal es un ejercicio anaeróbico de estabilización horizontal que fortalece el abdomen y por eso se ha convertido en un ejercicio estrella para tener unos abdominales perfectos. Sin embargo va mucho más allá ya que hay numerosos músculos implicados . La más habitual es la plancha frontal en la que, efectivamente, los músculos primarios son los abdominales, tanto el recto mayor como el transverso del abdomen junto a músculo erector de la columna. Pero además de éstos, también están implicados trapecio, romboides, manguito rotador, deltoides, pectoral mayor, serrato anterior, glúteo mayor, cuádriceps femoral y gemelos.', 'Póngase en posición de tabla mientras te apoyas con los antebrazos. Asegúrate de que los codos están en el suelo directamente debajo de los hombros con los pies separados al ancho de las caderas. Asegúrate de que la espalda está plana y su cabeza y cuello están en una posición neutral. Lleva los codos hacia el suelo y aprieta los cuádriceps, los glúteos y el core. Inhala por la nariz y exhale por la boca, no contenga la respiración', '2fde32ca-cbbc-4436-b5e9-297ae2b0afce.jpeg', '2023-08-09 18:01:33', '2023-08-09 18:01:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores`
--

CREATE TABLE `entrenadores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gimnasios`
--

CREATE TABLE `gimnasios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `horario` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `latitud` varchar(255) DEFAULT NULL,
  `longitud` varchar(255) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `horarioCierre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gimnasios`
--

INSERT INTO `gimnasios` (`id`, `nombre`, `telefono`, `horario`, `descripcion`, `latitud`, `longitud`, `fotografia`, `created_at`, `updated_at`, `horarioCierre`) VALUES
(1, 'gym1', '8341459893', '22:20', 'si', NULL, NULL, NULL, '2023-07-14 16:16:17', '2023-07-14 16:16:17', ''),
(2, 'gym2', '8344280421', '10:41', 'si', NULL, NULL, NULL, '2023-07-14 16:39:39', '2023-07-14 16:39:39', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_07_12_145524_create_tipo_usuarios_table', 1),
(6, '2014_10_12_000000_create_users_table', 2),
(7, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(8, '2019_08_19_000000_create_failed_jobs_table', 2),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(11, '2023_07_14_070008_create_noticias_table', 3),
(12, '2023_07_14_160306_create_gimnasios_table', 4),
(13, '2023_07_14_162048_create_entrenadores_table', 5),
(14, '2023_07_14_162104_create_ejercicios_table', 5),
(17, '2023_08_06_214518_add_hora_to_users_table', 6),
(18, '2023_08_06_223707_make_email_nullable_in_users_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `texto` text NOT NULL,
  `fecha` datetime NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `nombre`, `descripcion`, `texto`, `fecha`, `imagen`, `created_at`, `updated_at`) VALUES
(4, 'x', 'h', 'khk', '2023-08-01 12:47:00', '4fad209b-a0c3-4277-bacb-c099f21d6f39.jpg', '2023-08-01 13:44:23', '2023-08-03 14:06:55'),
(6, 'n', 'jLorem\r\n                        cillum dolore eu fugi', 'm Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-08-18 09:18:00', 'b0364443-0ddc-454b-b4ed-50e052d1e527.jpg', '2023-08-01 15:19:10', '2023-08-03 14:38:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE `tipo_usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'administrador', NULL, NULL),
(2, 'atleta', NULL, NULL),
(3, 'entrenador', NULL, NULL),
(4, 'nutriologo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `fecha_nac` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `latitud` varchar(255) DEFAULT NULL,
  `longitud` varchar(255) DEFAULT NULL,
  `horario` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `tipo_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `horaEntrada` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `correo`, `email_verified_at`, `fecha_nac`, `telefono`, `genero`, `usuario`, `password`, `fotografia`, `latitud`, `longitud`, `horario`, `direccion`, `cedula`, `tipo_id`, `remember_token`, `created_at`, `updated_at`, `horaEntrada`, `horaSalida`) VALUES
(5, 'Nubia Esmeralda', 'Cantu Sanchez', 'cantu.nubia.1am@gmail.com', NULL, '2002-06-04 00:00:00', '8344280422', NULL, 'nubia', '$2y$10$iFvD8o5lmwj/cMzoQnfRtuenwZzwTfwSeMn53MioZSZwh735LOI/O', 'b2bbd061-5735-4f78-89ff-aecae4bcf5fe.jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'Sonia Lizbeth', 'Muñoz Barrirntos', '2030114@upv.edu.mx', NULL, '2023-07-02 00:00:00', '8341541335', NULL, 'sonia', '$2y$10$sHi/IqDWBUCWkwe4CzBqW.rbyd8b.FoTA3nhnyn60MEDcaG.FZhvC', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'xi', 'dedo', 'si@n.mii', NULL, '2023-06-08 00:00:00', '834145983', NULL, 'hola', '123456789', '3470fe72-4e72-495d-a889-bffdd96809a3.jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'j', 'h', 'cantu.nubia.1am@gmail.cam', NULL, '2023-08-09 00:00:00', '567890098765', NULL, 'sisi', '$2y$10$WHU7Ucaywn2FM1qU2dPkC.TD2rGNYGhqtUT7STjY/I3RtEmcy3YtC', 'f5b19863-92b6-4ee9-82c3-eccdf127a1a5.jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'NUbia esm', 'Cantú', 'si@si.cpm', NULL, '2023-08-04 00:00:00', '6767677660', NULL, 'nubiaatleta', '$2y$10$JLZL2QtzitI3rV09WEUtIOjTIm9CQnB32c73dlAxvejQxAGa4KM7i', '9232ed1f-2a5f-4785-8d45-6e0c3fca3f25.png', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(17, 'q', 'q', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6', 4, NULL, NULL, NULL, '17:11:00', '19:08:00'),
(19, 'w', 'w', NULL, NULL, NULL, '5', NULL, NULL, NULL, '0f971d62-c8af-4325-bd15-e80bb96a83e0.png', '23.7273088', '-99.1232', NULL, NULL, '7', 4, NULL, '2023-08-06 23:18:57', '2023-08-06 23:18:57', '19:18:00', '20:18:00'),
(20, 'sonia', 'munoz', 'sony.mu200002@gmail.com', NULL, '2002-08-11', '8341036148', NULL, 'soniamuu', '$2y$10$5xN6/K8c.SORHzox7XN7.ebY4Zu3vBLR6z5XsIBhEG6Dh8SGfFu1O', '5ff0e6fb-aa8c-4622-a78b-e984e16c3805.jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `gimnasios`
--
ALTER TABLE `gimnasios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_correo_unique` (`correo`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD UNIQUE KEY `users_cedula_unique` (`cedula`),
  ADD KEY `users_tipo_id_foreign` (`tipo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gimnasios`
--
ALTER TABLE `gimnasios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
