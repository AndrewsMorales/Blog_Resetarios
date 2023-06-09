-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-04-2023 a las 06:36:58
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
-- Base de datos: `blog_master`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Gourmet'),
(2, 'Casera'),
(3, 'Rapida'),
(4, 'Saludable'),
(5, 'Postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

DROP TABLE IF EXISTS `entradas`;
CREATE TABLE IF NOT EXISTS `entradas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` mediumtext,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_entrada_usuario` (`usuario_id`),
  KEY `fk_entrada_categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `usuario_id`, `categoria_id`, `titulo`, `descripcion`, `fecha`) VALUES
(21, 2, 1, 'Pasta Bolañesa', 'Sofría la carne molida y la cebolla en una sartén hasta que estén dorados.\r\nAgregue salsa de tomate y sazone con sal, pimienta y hierbas italianas al gusto.\r\nCocine a fuego medio durante unos 10 minutos hasta que la salsa se espese y sirva sobre pasta cocida.', '2023-04-15'),
(22, 2, 1, 'Risotto de hongos', 'Sofría arroz con ajo y cebolla, añada vino blanco, caldo de champiñones y hongos picados, queso parmesano y mantequilla.', '2023-04-15'),
(23, 2, 1, 'Tártara de carne con alioli', 'Pique finamente carne de res, agregue alcaparras, cebolla, pepinillos, mostaza, salsa Worcestershire, aceite de oliva, sal y pimienta, y sirva con alioli.', '2023-04-15'),
(24, 2, 2, 'Estofado de carne', 'Dore la carne en una olla, agregue cebolla, zanahoria, ajo, caldo de carne, salsa Worcestershire, tomillo, laurel y cocine a fuego lento durante 2 horas.', '2023-04-15'),
(25, 2, 2, 'Guiso de lentejas', 'Sofría cebolla, ajo, zanahoria y apio en una olla, añada lentejas, caldo de pollo, tomate, comino, pimentón y cocine a fuego lento durante 30-40 minutos.', '2023-04-15'),
(26, 2, 2, 'Albóndigas de pollo', 'Mezcle pollo picado, ajo, cebolla, pan rallado, huevo, sal y pimienta, forme albóndigas y fría en aceite caliente, sirva con salsa de tomate.', '2023-04-15'),
(27, 2, 3, 'Tacos de pollo', 'Cocine pollo en una sartén con cebolla, ajo, chile en polvo, comino, sal y pimienta, sirva en tortillas con cilantro, cebolla y limón.', '2023-04-15'),
(28, 2, 3, 'Quesadillas de champiñones', 'Saltee champiñones con ajo y cebolla, coloque sobre una tortilla con queso, doble y caliente en una sartén.', '2023-04-15'),
(29, 2, 3, 'Ensalada de atún', 'Mezcle atún enlatado, cebolla, apio, pepinillos, mayonesa, mostaza, sal y pimienta, sirva sobre lechuga.', '2023-04-15'),
(30, 2, 4, 'Salmón al horno con brócoli', 'Cubra el salmón con ajo, limón, sal y pimienta, hornee junto con brócoli con aceite de oliva, ajo, sal y pimienta.', '2023-04-15'),
(31, 2, 4, 'Ensalada de quinoa', 'Mezcle quinoa cocida, tomate, pepino, pimiento, cilantro, jugo de limón, aceite de oliva, sal y pimienta.', '2023-04-15'),
(32, 2, 4, 'Pollo a la plancha con verduras al vapor', 'Cocine pechugas de pollo a la parrilla con sal y pimienta, sirva con zanahorias, brócoli y calabacín al vapor.', '2023-04-15'),
(33, 2, 5, 'Mousse de chocolate', 'Derretir chocolate amargo con mantequilla, mezclar con yemas de huevo batidas, añadir claras de huevo batidas a nieve con azúcar, y refrigerar.', '2023-04-15'),
(34, 2, 5, 'Tarta de limón', 'Mezcle leche condensada, jugo de limón y yemas de huevo, vierta sobre una corteza de galleta, hornee por 10 minutos y enfríe antes de servir.', '2023-04-15'),
(35, 2, 5, 'Sorbete de frutas', 'Mezcle frutas con agua, jugo de limón y azúcar, licue y congele, raspe con un tenedor cada hora hasta obtener textura de sorbete.', '2023-04-15'),
(36, 2, 5, 'Brownies de nueces', 'Mezcle chocolate amargo, mantequilla, huevos, azúcar, harina y nueces picadas, hornee por 25 minutos y sirva tibio.', '2023-04-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `fecha`) VALUES
(1, 'Andres', 'Morales Castro', 'admin@gmail.com', '$2y$04$uWPLfHZahGAGW3IWnJSLyu2TeWRZ61uxs3VvUS31h.u7oxAd5EpDi', '2022-12-16'),
(2, 'Juan', 'perez', 'juanperez@gmail.com', '$2y$04$uQ45gufdYhCdpAgI7iwNR.oTIf.nOG9gENe3vkwGHTgTnlYNopNae', '2023-04-14');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entrada_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_entrada_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
