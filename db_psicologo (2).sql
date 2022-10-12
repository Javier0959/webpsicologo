-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2022 a las 03:15:08
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_psicologo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `nombrea` varchar(50) NOT NULL,
  `correoe` varchar(50) NOT NULL,
  `comentario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`nombrea`, `correoe`, `comentario`) VALUES
('', '', 'hola'),
('', '', 'Prueba'),
('', '', 'tele'),
('', '', 'Carro'),
('francisco', '', 'prueba'),
('francisco', 'javier', 'prueba1'),
('', 'javier@live.com', 'm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero` int(20) NOT NULL,
  `mensaje` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `edad`, `email`, `numero`, `mensaje`) VALUES
(1, 'Lucia', 'Figueroa', 20, 'lucia@miweb.com', 844569858, 'Hola dr'),
(2, 'Carlos', 'Mogollon', 19, 'carlos@miweb.com', 245368555, 'lo mas pronto '),
(3, 'Melina', 'Carbajal', 15, 'melina@miweb.com', 0, 'gracias'),
(4, 'Karina', 'Villaran', 24, 'karina@miweb.com', 0, 'plis'),
(5, 'Julian', 'Lee', 36, 'julian@miweb.com', 856999, 'grax'),
(6, 'Miguel', 'Cotrado', 40, 'miguel@miweb.com', 5555, 'muchas gracias'),
(7, 'Sujey', 'Cardenas', 13, 'sujey@miweb.com', 0, 'ayuda'),
(8, 'Hector', 'Santander', 45, 'hector@miweb.com', 0, 'gracias'),
(9, 'Valeria', 'Chumpitaz', 0, 'valeria@miweb.com', 5699455, 'estare al pendiente'),
(10, 'Marlen ', 'Rodriguez Ortiz', 85555633, 'marlen@outlook.es', 0, 'pueden enviarme whatsapp'),
(11, 'ximena', 'Rodriguez Perez', 0, 'marlen@hotmail.es', 0, '1'),
(12, 'Angela a', 'puente', 12, 'angela@gmail.com', 8449090, 'Angela'),
(13, 'jonathan ariel', 'perez', 23, 'ariel@gmail.com', 12345678, 'ariel '),
(14, 'jonathan ariel', 'perez', 23, 'ariel@gmail.com', 12345678, 'ariel '),
(15, 'lalo', 'briones', 89, 'lalo@gmail.com', 9882929, 'lalo'),
(16, 'gorra ny', 'nueva york', 20, 'ola@gmail.com', 99999999, 'samuel garcia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `nombre` varchar(50) NOT NULL,
  `edad` int(10) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `numero` int(20) NOT NULL,
  `mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`nombre`, `edad`, `correo`, `numero`, `mensaje`) VALUES
('Francisco javier puente martinez', 23, 'javierpuente130@gmail.com', 8445, 'ventilador'),
('Marlen Rodriguez', 23, 'M@m.com', 2147483647, 'payaso'),
('valeeee lopez', 23, 'M@m.com', 99999, 'ventilador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(130) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `last_session` datetime DEFAULT NULL,
  `activacion` int(11) NOT NULL DEFAULT 0,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) DEFAULT NULL,
  `password_request` int(11) DEFAULT 0,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `nombre`, `correo`, `last_session`, `activacion`, `token`, `token_password`, `password_request`, `id_tipo`) VALUES
(1, 'ny', '$2y$10$krXafAv.NEvLS19w.vFh0.8WQJqupsh23z8DrrjDRwrLHk6FfHRk6', 'Celular javier', 'javierpuente130@gmail.com', '2022-07-18 20:02:20', 1, 'bc45a86efd9e0e9a90d6086384eba482', '', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
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
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
