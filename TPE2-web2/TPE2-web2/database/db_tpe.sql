-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2022 a las 02:50:23
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authors`
--

CREATE TABLE `authors` (
  `id_author` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `birthdate` int(4) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `authors`
--

INSERT INTO `authors` (`id_author`, `name`, `nationality`, `birthdate`, `img`) VALUES
(1, 'Florencia Bonelli', 'Argentina ', 1971, 'imgs/authors/florenciaBonelli.jpg'),
(2, 'Taylor Jenkins Reid', 'Estadounidense ', 1983, 'imgs/authors/taylorJenkinsReid.jpg'),
(3, 'Agatha Christie', 'Británica', 1890, 'imgs/authors/AgathaChristie.jpg'),
(4, 'Danielle Steel', 'Estadounidense ', 1947, 'imgs/authors/danielleSteel.jpg'),
(5, 'Eva García Sáenz', 'Española', 1972, 'imgs/authors/EvaGarciaSaenz.jpg'),
(6, 'Isabel Allende', 'Chilena', 1942, 'imgs/authors/isabelAllende.jpg'),
(7, 'Jane Austen', 'Británica', 1775, 'imgs/authors/janeAusten.jpg'),
(8, 'J.K. Rowling', 'Británica', 1965, 'imgs/authors/J.K.Rowling.jpg'),
(9, 'Suzanne Collins', 'Estadounidense ', 1962, 'imgs/authors/suzanneCollins.jpg'),
(10, 'Lucinda Riley', 'Irlandesa  ', 1965, 'imgs/authors/lucindaRiley.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `genre` varchar(45) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id`, `id_author`, `title`, `genre`, `imagen`) VALUES
(1, 1, 'Caballo de Fuego - Paris', 'Narrativa Romantica', 'imgs/books/caballodefuego-paris.jpg'),
(2, 2, 'Los Siete Maridos de Evelyn Hugo', 'Narrativa Romántica', 'imgs/books/losSieteMaridosdeEvelynHugo.jpg'),
(3, 10, 'Asesinato en Fleat House', 'Crimen y Misterio', 'imgs/books/AsesinatoenFleatHouse.jpg'),
(4, 3, 'Muerte en el Nilo', 'Crimen y Misterio', 'imgs/books/muerteenelNilo.jpg'),
(5, 1, 'Caballo de Fuego - Congo', 'Narrativa Romántica', 'imgs/books/caballodefuego-congo.jpg'),
(6, 4, 'Vecinos ', 'Narrativa Romántica', 'imgs/books/Vecinos.jpg'),
(7, 3, 'Asesinato en el Orient Express', 'Crimen y Misterio', 'imgs/books/AsesinatoenelOrientExpress.jpg'),
(8, 5, 'El silencio de la Ciudad Blanca', 'Crimen y Misterio', 'imgs/books/elSilenciodelaCiudadBlanca.jpg'),
(9, 9, 'Los juegos del Hambre', 'Ficción Literaria ', 'imgs/books/losJuegosdelHambre.jpg'),
(10, 8, 'Harry Potter y la Piedra filosofal', 'Ficción Literaria ', 'imgs/books/HarryPotterylaPiedrafilosofal.jpg'),
(12, 8, 'Harry Potter y el Prisionero de Azcaban', 'Ficción Literaria ', 'imgs/books/HarryPotteryelPrisionerodeAzcaban.jpg'),
(13, 8, 'Harry Potter y la Reliquia de las Muerte', 'Ficción Literaria ', 'imgs/books/HarryPotterylaReliquiadelasMuerte.jpg'),
(14, 1, 'Caballo de Fuego - Gaza', 'Narrativa Romantica', 'imgs/books/caballodefuego-gaza.jpg'),
(15, 6, 'Violeta', 'Ficción Literaria ', 'imgs/books/Violeta.jpg'),
(16, 6, 'Mas Alla del Invierno', 'Ficción Literaria ', 'imgs/books/MasAlladelInvierno.jpg'),
(17, 7, 'Orgullo y Prejuicio', 'Ficción Literaria ', 'imgs/books/OrgulloyPrejuicio.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`) VALUES
(1, 'administrador@admin', '$2a$12$K8UpTqA/3p07dcMRnZxz7ewU.RFhWnxQpRJsXtT411EGghpKO5FjW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_author` (`id_author`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id_author`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
