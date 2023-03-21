-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 11-03-2023 a las 19:31:24
-- Versión del servidor: 10.8.7-MariaDB-1:10.8.7+maria~ubu2204
-- Versión de PHP: 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Pelicules`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cine`
--

CREATE TABLE `Cine` (
  `idCine` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Ciutat_idCiutat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `Cine`
--

INSERT INTO `Cine` (`idCine`, `Nom`, `Ciutat_idCiutat`) VALUES
(19, 'Ies Manacor', '7'),
(24, 'Cel Obert', '6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciutat`
--

CREATE TABLE `Ciutat` (
  `idCiutat` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `Ciutat`
--

INSERT INTO `Ciutat` (`idCiutat`, `Nom`) VALUES
(1, 'Manacor'),
(5, 'Inca'),
(6, 'Inca'),
(7, 'Llucmajor'),
(8, 'Llucmajor'),
(10, 'Marratxi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Genere`
--

CREATE TABLE `Genere` (
  `id` int(11) NOT NULL,
  `Nom` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `Genere`
--

INSERT INTO `Genere` (`id`, `Nom`) VALUES
(1, 'Terror Psicologic'),
(2, 'Terror'),
(5, 'Comedia'),
(6, 'Policiaca'),
(7, 'Policiaca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pelicula`
--

CREATE TABLE `Pelicula` (
  `Titol` varchar(100) NOT NULL,
  `data_estrena` date NOT NULL,
  `durada` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `Pelicula`
--

INSERT INTO `Pelicula` (`Titol`, `data_estrena`, `durada`, `id`) VALUES
('Tarantino', '2023-02-12', 200, 27),
('UP', '2023-02-25', 120, 28),
('IT', '2023-02-25', 140, 30),
('Ies Manacor', '2023-02-21', 150, 31),
('Ies Manacor', '2023-03-04', 150, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Peli_cine`
--

CREATE TABLE `Peli_cine` (
  `data_hora` date DEFAULT NULL,
  `Cine_idCine` int(11) NOT NULL,
  `Pelicula_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `Peli_cine`
--

INSERT INTO `Peli_cine` (`data_hora`, `Cine_idCine`, `Pelicula_id`) VALUES
('2023-03-11', 24, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Peli_Genere`
--

CREATE TABLE `Peli_Genere` (
  `Pelicula_id` int(11) NOT NULL,
  `Genere_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `Peli_Genere`
--

INSERT INTO `Peli_Genere` (`Pelicula_id`, `Genere_id`) VALUES
(30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL,
  `nom_usuari` varchar(250) NOT NULL,
  `contrasenya` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `nom_usuari`, `contrasenya`) VALUES
(1, 'joan', 'iesmanacor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Cine`
--
ALTER TABLE `Cine`
  ADD PRIMARY KEY (`idCine`);

--
-- Indices de la tabla `Ciutat`
--
ALTER TABLE `Ciutat`
  ADD PRIMARY KEY (`idCiutat`);

--
-- Indices de la tabla `Genere`
--
ALTER TABLE `Genere`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Pelicula`
--
ALTER TABLE `Pelicula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Peli_cine`
--
ALTER TABLE `Peli_cine`
  ADD KEY `fk_Peli_cine_Cine1_idx` (`Cine_idCine`),
  ADD KEY `fk_Peli_cine_Pelicula1_idx` (`Pelicula_id`),
  ADD KEY `Cine_idCine` (`Cine_idCine`);

--
-- Indices de la tabla `Peli_Genere`
--
ALTER TABLE `Peli_Genere`
  ADD KEY `fk_Peli_Genere_Pelicula1_idx` (`Pelicula_id`),
  ADD KEY `fk_Peli_Genere_Genere1_idx` (`Genere_id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Cine`
--
ALTER TABLE `Cine`
  MODIFY `idCine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `Ciutat`
--
ALTER TABLE `Ciutat`
  MODIFY `idCiutat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Genere`
--
ALTER TABLE `Genere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Pelicula`
--
ALTER TABLE `Pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Peli_cine`
--
ALTER TABLE `Peli_cine`
  ADD CONSTRAINT `Peli_cine_ibfk_1` FOREIGN KEY (`Cine_idCine`) REFERENCES `Cine` (`idCine`);

--
-- Filtros para la tabla `Peli_Genere`
--
ALTER TABLE `Peli_Genere`
  ADD CONSTRAINT `Peli_Genere_ibfk_1` FOREIGN KEY (`Genere_id`) REFERENCES `Genere` (`id`),
  ADD CONSTRAINT `Peli_Genere_ibfk_2` FOREIGN KEY (`Pelicula_id`) REFERENCES `Pelicula` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
