-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-02-2025 a las 09:19:30
-- Versión del servidor: 8.0.40-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3-4ubuntu2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;
CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'admin';

-- Otorgar todos los privilegios sobre la base de datos 'biblioteca' al usuario 'admin_biblioteca'
GRANT ALL PRIVILEGES ON biblioteca.* TO 'admin'@'localhost';

-- Asegurarse de que los cambios en privilegios se apliquen
FLUSH PRIVILEGES;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `autor` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  `cantidadTotal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id`, `nombre`, `cantidad`, `autor`, `genero`, `descripcion`, `url`, `habilitado`, `cantidadTotal`) VALUES
(1, '1984', 1, 'George Orwell', 'Distopía', 'Una novela que describe un mundo totalitario donde el gobierno controla todos los aspectos de la vida humana.', '../img/1984.jpg', 1, 20),
(2, 'El gran Gatsby', 6, 'F. Scott Fitzgerald', 'Ficción', 'La historia de Jay Gatsby y su obsesión con Daisy Buchanan en la era del jazz en los años 20.', '../img/el_gran_gatsby.jpeg', 1, 8),
(3, 'Don Quijote de la Mancha', 8, 'Miguel de Cervantes', 'Clásicos', 'Las aventuras de un caballero idealista y su fiel escudero, en una obra que explora la locura y la realidad.', '../img/don_quijote_de_la_mancha.jpg', 1, 8),
(4, 'Fahrenheit 451', 23, 'Ray Bradbury', 'Ciencia ficción', 'En un futuro distópico, los libros están prohibidos y los bomberos queman cualquier material literario encontrado.', '../img/farenheit_451.jpg', 1, 25),
(5, 'La sombra del viento', 10, 'Carlos Ruiz Zafón', 'Misterio', 'Un joven descubre un libro en un cementerio de libros olvidados, desatando una serie de misteriosos eventos.', '../img/la_sombra_del_viento.jpg', 1, 9),
(6, 'Orgullo y prejuicio', -6, 'Jane Austen', 'Romance', 'La historia de Elizabeth Bennet y su relación con el orgulloso señor Darcy en la Inglaterra del siglo XIX.', '../img/orgullo_y_prejuicio.jpg', 1, 2),
(7, 'Matar a un ruiseñor', 5, 'Harper Lee', 'Ficción', 'Una historia sobre la injusticia racial en el sur de Estados Unidos, vista a través de los ojos de una niña.', '../img/matar_a_un_ruisenor.jpg', 1, 5),
(8, 'El alquimista', 5, 'Paulo Coelho', 'Ficción', 'La búsqueda de Santiago, un joven pastor que viaja en busca de un tesoro personal, en una alegoría sobre el destino.', '../img/el_alquimista.jpg', 1, 10),
(9, 'erg', 2, 'sdfsdf', 'sdf', 'sweeeeeeeeeeeeeeeeeeeeeeee', '../img/erg.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checkouts`
--

CREATE TABLE `checkouts` (
  `id` int NOT NULL,
  `idBook` int NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `dateP` datetime NOT NULL,
  `dateD` datetime NOT NULL,
  `devuelto` tinyint(1) DEFAULT '0',
  `solicitudAmpliacion` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `checkouts`
--

INSERT INTO `checkouts` (`id`, `idBook`, `idUser`, `dateP`, `dateD`, `devuelto`, `solicitudAmpliacion`) VALUES
(1, 1, 'joel', '2025-01-06 03:20:48', '2025-01-06 05:41:05', 1, 1),
(2, 2, 'alicia', '2025-01-06 03:24:37', '2025-01-06 05:40:43', 1, 1),
(3, 1, 'alicia', '2025-01-06 03:24:41', '2025-01-06 05:40:44', 1, 1),
(4, 1, 'alicia', '2025-01-06 03:27:13', '2025-01-06 05:40:46', 1, 0),
(5, 3, 'joel', '2025-01-06 04:04:16', '2025-01-21 04:04:16', 0, 0),
(6, 3, 'joel', '2025-01-06 04:04:30', '2025-01-21 04:04:30', 0, 0),
(7, 2, 'joel', '2025-01-06 04:54:32', '2025-01-21 04:54:32', 0, 0),
(8, 2, 'joel', '2025-01-06 04:55:45', '2025-01-21 04:55:45', 0, 0),
(9, 2, 'joel', '2025-01-06 04:56:10', '2025-01-21 04:56:10', 0, 0),
(10, 2, 'joel', '2025-01-06 04:56:11', '2025-01-21 04:56:11', 0, 0),
(11, 2, 'joel', '2025-01-06 04:56:11', '2025-01-21 04:56:11', 0, 0),
(12, 2, 'joel', '2025-01-06 04:56:42', '2025-01-21 04:56:42', 0, 0),
(13, 2, 'joel', '2025-01-06 04:56:43', '2025-01-21 04:56:43', 0, 0),
(14, 2, 'joel', '2025-01-06 04:56:43', '2025-01-21 04:56:43', 0, 0),
(15, 2, 'joel', '2025-01-06 04:56:43', '2025-01-21 04:56:43', 0, 0),
(16, 2, 'joel', '2025-01-06 04:57:10', '2025-01-21 04:57:10', 0, 0),
(17, 2, 'joel', '2025-01-06 04:57:11', '2025-01-21 04:57:11', 0, 0),
(18, 2, 'joel', '2025-01-06 04:57:11', '2025-01-21 04:57:11', 0, 0),
(19, 2, 'joel', '2025-01-06 04:57:11', '2025-01-21 04:57:11', 0, 0),
(20, 2, 'joel', '2025-01-06 04:57:11', '2025-01-21 04:57:11', 0, 0),
(21, 5, 'Juan', '2025-01-06 05:35:14', '2025-01-21 05:35:14', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `blocked` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `pass`, `correo`, `admin`, `blocked`) VALUES
('1212', '1212', '$2y$10$AVbQpQiy3IJQ09q4vv1Ri.Fjx0lMojdEgjDMkqGEzB69ydIQTyDze', 'alicia2@gmail', 0, 0),
('alicia', 'alicia', '$2y$10$KzfnT78aXUhJ7.wHBOMAAOk3s52JjpEAUxydzJl/RfOD7A2BpyubG', 'alicia@gmail', 0, 0),
('joel', 'joel', '$2y$10$t7eIyFKJXZ1g0JqsiskgOeHFFOcKUEngk9vyX.rGayAX7GHMA8cUq', 'joel@gmail.com', 1, 0),
('Juan', 'Juan', '$2y$10$U0o8mf5OfECerZ7FbYg8tOQctOlFLlQDmzQSn/AI2X9Xu0iNK3CHK', 'Juan@gmail.com', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idBook` (`idBook`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_ibfk_1` FOREIGN KEY (`idBook`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checkouts_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
