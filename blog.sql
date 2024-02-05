-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-02-2024 a las 11:40:21
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `register`) VALUES
(4, 'Impulsando un Futuro Sostenible: El Poder Revolucionario de las Energías Limpias en Nuestro Planeta', '<p>En un mundo donde la preocupación por el cambio climático y la conservación del medio ambiente es cada vez más prominente, la transición hacia las energías limpias no es solo una opción, sino una necesidad imperativa. Este cambio no solo representa una oportunidad para reducir nuestra huella de carbono, sino también para impulsar un futuro sostenible y resiliente para las generaciones venideras.\r\n</p>\r\n<p>\r\n<strong>El Amanecer de las Energías Renovables.</strong>\r\n</p>\r\n<p>Las energías limpias, como la solar, eólica, hidráulica y geotérmica, están en la vanguardia de esta transición energética. La energía solar, en particular, ha visto una adopción masiva en todo el mundo, gracias a los avances tecnológicos que han reducido su costo significativamente. Los paneles solares, ahora más eficientes y accesibles, se están convirtiendo en una vista común en tejados de hogares y empresas.\r\n</p>\r\n\r\n', 'Basilio Fajardo', '2023-12-06 14:20:38'),
(5, 'Impulsando el Futuro: La Revolución de las Energías Renovables', '<p>\r\nEn las últimas décadas, la atención mundial se ha centrado en una cuestión crítica y omnipresente: la sostenibilidad energética. Frente a los crecientes desafíos del cambio climático y la degradación ambiental, las energías renovables han emergido no solo como una solución viable, sino también como una necesidad imperante para el futuro de nuestro planeta.\r\n</p>\r\n<p>\r\nTradicionalmente, hemos dependido de fuentes de energía no renovables, como el petróleo, el carbón y el gas natural. Estas fuentes, aunque poderosas y hasta hace poco económicas, tienen un coste ambiental significativo. La quema de combustibles fósiles libera grandes cantidades de gases de efecto invernadero, contribuyendo al calentamiento global y al cambio climático. Además, la extracción y el procesamiento de estos combustibles a menudo resultan en daños ambientales severos y contaminación.\r\n</p>', 'Basilio Fajardo', '2023-12-06 14:32:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `register`) VALUES
(2, 'admin', '$2y$10$pq9Voa0qE3jdKdV8hhxT2OPEHfr2e6JrGnxTyzcVk6m1Iah20wYem', '2023-12-06 11:34:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
