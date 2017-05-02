-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2017 a las 10:09:56
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productosnaturales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `id_catalog_type` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `catalog`
--

INSERT INTO `catalog` (`id`, `id_catalog_type`, `name`, `code`) VALUES
(1, 1, 'Circulatorio', 'SCH_CIRCULATORIO'),
(2, 1, 'Diabetes', 'SCH_DIABETES'),
(3, 1, 'Digestivo', 'SCH_DIGESTIVO'),
(4, 1, 'Genital femenino', 'SCH_GENITAL_FEMENINO'),
(5, 1, 'Hipoglicemiante', 'SCH_HIPOGLICEMIANTE'),
(6, 1, 'Locomotor', 'SCH_LOCOMOTOR'),
(7, 1, 'Miscelaneos', 'SCH_MISCELANEOS'),
(8, 1, 'Nervioso', 'SCH_NERVIOSO'),
(9, 1, 'Nutrición', 'SCH_NUTRICION'),
(10, 1, 'Piel Cosmética', 'SCH_PIEL_COSMETICA'),
(11, 1, 'Piel Normal', 'SCH_PIEL_NORMAL'),
(12, 1, 'Respiratorio', 'SCH_RESPIRATORIO'),
(13, 1, 'Urinario', 'SCH_URINARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalog_type`
--

CREATE TABLE `catalog_type` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `catalog_type`
--

INSERT INTO `catalog_type` (`id`, `name`, `code`) VALUES
(1, 'Sistema Corporal Humano', 'SCH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_product_type` int(11) DEFAULT NULL,
  `id_catalog` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `presentation` varchar(100) DEFAULT NULL,
  `code` varchar(150) DEFAULT NULL,
  `url_picture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `id_product_type`, `id_catalog`, `name`, `description`, `presentation`, `code`, `url_picture`) VALUES
(1, 1, 1, 'Alcachofa', 'COLERETICO, COLAGOGO', 'Cápsulas x 60', 'PFT2010-000273-R1', 'resources/thumbs/productos/1/picture.png'),
(2, 1, 1, 'Alcachofa', 'COLERETICO COLAGOGO', 'Jarabe x 240 mL', 'PFM2007-006073-R1', NULL),
(3, 1, 1, 'Alcachofa', 'COLERETICO, COLAGOGO', 'Gotas x 60 mL', 'PFM2011-0001847', NULL),
(4, 1, 6, 'Artrosed', 'ESTE PRODUCTO TRADICIONALMENTE HA SIDO UTILIZADO COMO ANALGÉSICO MENOR Y ANTIPIRETICO', 'Gotas x 60 mL', 'PFT2005-0000355', NULL),
(5, 2, 6, 'Hormonat E.F', 'HORMONAT', '30 ml', NULL, NULL),
(6, 3, NULL, 'Aceite Corporal', 'ACEITE', '250 mL', 'NSC2007CO28431', NULL),
(7, 3, NULL, 'Anticaida Defense', 'CAIDA DEL CABELLO', 'Frasco x 300 mL', 'NSC2007CO25307', NULL),
(8, 3, NULL, 'Arnica', 'CREMA', 'Crema x 60 g', 'NSC2006CO18842', NULL),
(9, 3, NULL, 'Bálsamo Acondicionador con placenta', 'BALSAMO ACONDICIONADOR', 'Frasco 300 mL', 'NSOC39383-10CO', NULL),
(10, 3, NULL, 'Caléndula y Te verde', 'CABELLO GRASO', 'Frasco x 300 mL', 'NSOC03649-00CO', NULL),
(11, 4, 9, 'Bodynat H Malteada', 'ALIMENTO ENRIQUECIDO CON VITAMINAS Y MINERALES', 'Polvo x 500 g', 'RSAD10I56609', NULL),
(12, 4, 9, 'Bodynat H proteína', 'ALIMENTO ENRIQUECIDO CON VITAMINAS Y MINERALES', 'Polvo 600 g', 'RSAD16I68911', NULL),
(13, 4, 9, 'Bodynat M Malteada', 'ALIMENTO ENRIQUECIDO CON VITAMINAS Y MINERALES', 'Polvo x 500 g', 'RSAD10I55309', 'resources/thumbs/productos/13/picture.png'),
(14, 4, 9, 'Bodynat M proteína', 'ALIMENTO ENRIQUECIDO CON VITAMINAS Y MINERALES', 'Polvo 600 g', 'RSAD10I55409', 'resources/thumbs/productos/14/picture.png'),
(15, 4, 9, 'Nutrocal', 'COMPLEMENTO MULTIVITAMINICO', 'Polvo x 400 g', 'RSIAD02M25693', 'resources/thumbs/productos/15/picture.png'),
(16, 4, 9, 'Milforce', 'COMPLEMENTO MULTIVITAMINICO', 'Polvo x 600 g', 'RSAD02I12101', 'resources/thumbs/productos/16/picture.png'),
(17, 4, 3, 'Te Nate', 'TE', '25 Bolsitas', 'RSAD15I12905', 'resources/thumbs/productos/17/picture.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `isActive` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `description`, `isActive`) VALUES
(1, 'FITOTERAPEUTICA', NULL, 1),
(2, 'ESENCIAS', NULL, 1),
(3, 'COSMETICA', NULL, 1),
(4, 'ALIMENTOS', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `catalog_id_Idx` (`id`) USING BTREE,
  ADD KEY `catalog_code_Idx` (`code`) USING BTREE,
  ADD KEY `catalog_id_catalog_type_Idx` (`id_catalog_type`) USING BTREE,
  ADD KEY `catalog_name_Idx` (`name`) USING BTREE;

--
-- Indices de la tabla `catalog_type`
--
ALTER TABLE `catalog_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `catalog_type_code_Idx` (`code`) USING BTREE,
  ADD UNIQUE KEY `catalog_type_id_Idx` (`id`) USING BTREE,
  ADD UNIQUE KEY `catalog_type_name_Idx` (`name`) USING BTREE;

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id_Idx` (`id`) USING BTREE,
  ADD UNIQUE KEY `product_code_Idx` (`code`) USING BTREE,
  ADD KEY `product_id_catalog_Idx` (`id_catalog`) USING BTREE,
  ADD KEY `product_id_product_type_Idx` (`id_product_type`) USING BTREE,
  ADD KEY `product_name_Idx` (`name`) USING BTREE;

--
-- Indices de la tabla `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_type_id_Idx` (`id`) USING BTREE,
  ADD UNIQUE KEY `product_type_name_Idx` (`name`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `catalog_type`
--
ALTER TABLE `catalog_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catalog`
--
ALTER TABLE `catalog`
  ADD CONSTRAINT `fk_catalog_catalog_type` FOREIGN KEY (`id_catalog_type`) REFERENCES `catalog_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_catalog` FOREIGN KEY (`id_catalog`) REFERENCES `catalog` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_product_type` FOREIGN KEY (`id_product_type`) REFERENCES `product_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
