-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-01-2024 a las 23:05:09
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
-- Base de datos: `proyectoiaw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `imagen`) VALUES
(1, 'Camisetas', 'imgcategorias/1.jpg'),
(2, 'Camisas', 'imgcategorias/2.jpg'),
(3, 'Vestidos', 'imgcategorias/3.jpg'),
(4, 'Sudaderas', 'imgcategorias/4.jpg'),
(5, 'Leggings', 'imgcategorias/5.jpg'),
(6, 'Pijamas', 'imgcategorias/6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indefinido`
--

DROP TABLE IF EXISTS `indefinido`;
CREATE TABLE IF NOT EXISTS `indefinido` (
  `titulo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `indefinido`
--

INSERT INTO `indefinido` (`titulo`, `texto`, `imagen`) VALUES
('Travis Johnson', 'Massive Dynamic tiene más de 10 años de experiencia en Moda. Estamos orgullosos de ofrecer diseños inteligentes y experiencias atractivas para clientes de todo el mundo. Disfruto resolviendo problemas y trabajando con clientes para buscar la mejor solución de diseño posible.', 'images/model.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idcat` int NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detalle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `precio` float NOT NULL,
  `fecalta` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcat` (`idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `idcat`, `nombre`, `detalle`, `precio`, `fecalta`) VALUES
(1, 1, 'Camiseta blanca', 'Camiseta básica blanca de manga corta. Perfecta para un estilo casual y fresco.', 9.99, '2024-01-17'),
(2, 1, 'Camiseta negra', 'Camiseta básica negra de manga corta. Perfecta para un estilo casual y fresco.', 9.99, '2024-01-16'),
(3, 1, 'Camiseta azul', 'Camiseta básica azul de manga corta. Perfecta para un estilo casual y fresco.', 9.99, '2024-01-16'),
(4, 1, 'Camiseta marrón', 'Camiseta básica marrón de manga corta. Perfecta para un estilo casual y fresco.', 9.99, '2024-01-16'),
(5, 1, 'Camiseta gris', 'Camiseta básica gris de manga corta. Perfecta para un estilo casual y fresco.', 9.99, '2024-01-16'),
(6, 2, 'Camisa Vaquera', 'Camisa de estilo vaquero con un toque vintage. Combina perfectamente con diferentes looks.', 14.99, '2024-01-16'),
(7, 2, 'Camisa Elegante', 'Camisa blanca con detalles elegantes. Ideal para ocasiones formales y eventos especiales.', 34.99, '2024-01-16'),
(8, 2, 'Camisa de Lino', 'Camisa amarillo bebé ligera de lino para un look fresco y casual. Manga corta perfecta para climas cálidos.', 12.99, '2024-01-17'),
(9, 3, 'Vestido Casual Midi', 'Vestido midi granate, cómodo y versátil. Adecuado para diversas ocasiones informales.', 15.99, '2024-01-17'),
(10, 3, 'Vestido de Noche Elegante', 'Vestido negro largo de noche con detalles elegantes y brillantes. Ideal para eventos formales.', 44.99, '2024-01-16'),
(11, 4, 'Sudadera con Capucha', 'Sudadera gris con capucha y diseño urbano. Ideal para un estilo callejero y cómodo.', 25, '2024-01-16'),
(12, 4, 'Sudadera sin Capucha', 'Sudadera blanca sin capucha casual y cómoda. Perfecta para cualquier ocasión.', 19.99, '2024-01-16'),
(13, 4, ' Sudadera de Terciopelo', 'Sudadera marrón suave de terciopelo. Perfecta para mantenerse abrigado con estilo.', 29.99, '2024-01-17'),
(14, 4, 'Sudadera Deportiva', 'Sudadera negra diseñada para actividades deportivas. Con tejido transpirable y cómodo.\r\n', 34.99, '2024-01-16'),
(15, 5, 'Leggings Deportivos', 'Leggings de compresión para un ajuste perfecto. Ideal para entrenamientos intensos.', 19.99, '2024-01-16'),
(16, 6, 'Pijama de Algodón', 'Pijama de dos piezas confeccionado en suave algodón. Perfecto para noches relajadas.', 15.99, '2024-01-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `slides`
--

INSERT INTO `slides` (`id`, `nombre`, `imagen`) VALUES
(1, 'Chica', 'images/3.jpg'),
(3, 'concierto', 'images/14.jpg'),
(4, 'prueba', 'images/ass.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `login` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`login`, `password`, `imagen`, `nombre`) VALUES
('admin', '$2y$10$Qhf2Ai6.5BREEDQmq2ZWKOUtJQ1Wh3baxr5c/pUkbRZycGET1TUAK', 'images/user', 'Miriam');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idcat`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
