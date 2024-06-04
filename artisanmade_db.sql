-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2024 a las 00:06:11
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `artisanmade_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token_password` varchar(40) DEFAULT NULL,
  `password_request` tinyint(4) NOT NULL DEFAULT 0,
  `activo` tinyint(4) NOT NULL,
  `fecha_alta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `password`, `nombre`, `email`, `token_password`, `password_request`, `activo`, `fecha_alta`) VALUES
(1, 'admin', '$2y$10$ZizJhKJQ.8JDUCVHHd84Leb8XtQG0tOggRXg1CkPo7MqIOjgsS6pC', 'Administrador', 'edwardalejozuluaga669@gmail.com', NULL, 0, 1, '2024-04-28 09:09:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(11) NOT NULL,
  `caracteristica` varchar(30) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `caracteristica`, `activo`) VALUES
(1, 'Talla', 1),
(2, 'Color', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `dni` int(20) NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `email`, `telefono`, `dni`, `estatus`, `fecha_alta`, `fecha_modifica`, `fecha_baja`) VALUES
(1, 'david', 'alberto', 'davidalberot@gmail.com', '123456789', 1000133974, 1, '2023-05-13 21:58:12', NULL, NULL),
(2, 'pedro', 'sanchez', 'pedrosanchez@gmail.com', '3012403535', 1000133974, 1, '2023-05-14 10:54:47', NULL, NULL),
(3, 'Carlos', 'Alberto', 'carlosalberto@gmail.com', '3000000000', 1000133974, 1, '2023-05-20 08:00:09', NULL, NULL),
(4, 'alejandro', 'zuluaga', 'edwardalejozuluaga111@gmail.com', '111111111', 1000133974, 1, '2023-11-15 18:33:12', NULL, NULL),
(5, 'admin', 'admin', 'admin@admin.com', 'admin', 0, 1, '2024-02-12 10:46:28', NULL, NULL),
(6, 'juan', 'julian', 'jjuan@gmail.com', '123', 123456, 1, '2024-02-16 17:36:56', NULL, NULL),
(7, 'juan', 'lopez', 'edward123@gmail.com', '111111111', 1000133974, 1, '2024-04-27 11:52:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `Id` int(11) NOT NULL,
  `id_transaccion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`Id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`) VALUES
(1, '00436200N10010748', '2023-05-20 16:13:12', 'COMPLETED', 'sb-au0yc25616300@per', 'EEJKCPNLLJM72', '170'),
(2, '7EG90968VY516002Y', '2023-05-20 16:16:43', 'COMPLETED', 'sb-au0yc25616300@per', 'EEJKCPNLLJM72', '170'),
(3, '2AE94048T4200193M', '2024-04-28 23:41:10', 'COMPLETED', 'sb-au0yc25616300@per', 'EEJKCPNLLJM72', '34000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 1, 'Collar Rosado', '20', 1),
(2, 1, 2, 'Arbol para gatos', '100', 1),
(3, 1, 3, 'Cepillo para gatos', '50', 1),
(4, 2, 1, 'Collar Rosado', '20', 1),
(5, 2, 2, 'Arbol para gatos', '100', 1),
(6, 2, 3, 'Cepillo para gatos', '50', 1),
(7, 3, 10, 'Porta Toallas', '24500', 1),
(8, 3, 11, 'Cuadros ', '9500', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcadores`
--

CREATE TABLE `marcadores` (
  `id` int(11) NOT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcadores`
--

INSERT INTO `marcadores` (`id`, `latitud`, `longitud`, `direccion`, `nombre`, `descripcion`) VALUES
(1, '4.58248642', '-74.20513339', 'Pasaje comercial san mateo, Soacha', 'Dazydijur artesanias', 'Productos elaborados por artesanos habitantes del municipio de Xuacha en diferentes técnicas.'),
(2, '4.58506188', '-74.22047245', 'Cl. 12A #9-99, Soacha', 'Collares artesanales Tierra Buena', 'Elaboración de accesorios en semillas naturales, que no dañan el medio ambiente, diseños ecológicos creativos y exclusivos para todas ocasión,100% Colombia.'),
(3, '4.60328732', '-74.21999403', 'JQ3J+53, Soacha', 'Táquira Artesanías', 'Productos con materias primas 100% colombianas, preservando las tradiciones culturales y destacando el diseño y la innovación.'),
(4, '4.59856590', '-74.07185716', 'Cra. 2 #11-72, La Candelaria, Bogotá', 'Artesanías kankiwas', 'Artesanías indígenas de Colombia.'),
(5, '4.61910154', '-74.13732143', 'Cra. 71d #08 18, Kennedy, Bogota', 'Feria Artesanal Las Américas local', 'Es un vibrante mercado donde convergen talentosos artesanos para exhibir y vender sus creaciones únicas, representando la rica diversidad cultural y creativa de las Américas.'),
(6, '4.60138984', '-74.07454845', 'Carrera 7 # 12A - 04 local 4A Centro Artesanal Plaza, Bolívar, Bogotá', 'Artesanías - Tesoro Artesanal', 'Es un enclave de creatividad donde se encuentran tesoros artesanales, reflejando la habilidad y la tradición de los artesanos en cada pieza única.'),
(7, '4.60880373', '-74.07048113', 'locales.45, 69, 04 y 28, Cra. 7 #22-66, Bogotá', 'Colombia Artesanal', 'Es un paraíso de artesanías que ofrece una amplia gama de productos, desde exquisitos jarrones y platos hasta hermosas flores elaboradas a mano, todo reflejando la rica cultura y la destreza artesanal de Colombia.'),
(8, '4.61634851', '-74.08373469', 'Ac. 19 #25-4 Local 80-014, Los Mártires, Bogotá', 'Casona Mercado Artesanal', 'Es un tesoro de la cultura local, donde se pueden encontrar desde esencias aromáticas hasta bebidas típicas, pasando por platos tradicionales y encantadoras canastas, todo ello reflejando la autenticidad.'),
(9, '4.59221800', '-74.13921100', 'Diagonal 48Sur#13L29, Bogota', 'Artesanías Valentina', 'En Artesanías Valentina fabricamos medallas en zamak con una variedad de diseños. Ven a visitarnos en Bogotá.'),
(10, '4.63836100', '-74.14749900', 'carrera 80 bis 7a 15, Bogotá', 'Clara Ascencio Artesanias', 'Pintamos piezas en MDF, Arte country, cuadros abstractos, bajo pedido.'),
(11, '4.56958800', '-74.15190100', 'Calle 64c # 37 - 31 sur, calle 64 C # 37 - 31 sur, Bogota', 'Artesanias y Trofeos la Candelaria', 'Somos una empresa legalmente constituida, con una gran experiencia en el manejo de productos deportivos y académicos, premiaciones y condecoraciones en todos los rangos, clases, niveles y categorías.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `activo` int(11) NOT NULL,
  `imagen_principal` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `activo`, `imagen_principal`, `fecha_registro`) VALUES
(1, 'Ilustracion Decorativa Arte', 'Es una colección exquisita que captura la belleza y la delicadeza de la naturaleza en pequeña escala. Cada pieza está meticulosamente diseñada para reflejar la intrincada estructura y los detalles vibrantes de las plantas y flores. Estas miniaturas son perfectas para agregar un toque de frescura y elegancia a cualquier espacio, ya sea en tu hogar u oficina. Hechas con materiales de alta calidad y atención al detalle, estas obras de arte botánico son una expresión encantadora de la belleza natural que te rodea.', '20000', 0, 1, '/proyectos/ArtisanMade/assets/img/productos/1/2020-06-07-16.59.59.webp', '2024-05-05 19:19:11'),
(2, 'Macetero de madera maciza', ' Este macetero está diseñado a medida, lo que significa que se adapta perfectamente a tus necesidades y preferencias específicas. Fabricado con madera de alta calidad, este macetero agrega un toque de calidez y estilo a cualquier espacio interior o exterior. Su diseño sólido y duradero garantiza una base estable para tus plantas, mientras que su belleza natural complementa la vegetación que contiene. Ya sea que lo coloques en tu jardín, terraza o sala de estar, este macetero hecho a medida añade un toque de elegancia y encanto personalizado a tu entorno.', '60000', 0, 1, '/proyectos/ArtisanMade/assets/img/productos/2/IMG_9171.webp', '2024-05-05 19:34:40'),
(3, 'Bolígrafo de madera estilo Slimline', 'Con un cuerpo más ancho es una elegante fusión entre lo clásico y lo contemporáneo. Este bolígrafo combina la estética delgado y aerodinámico del estilo Slimline con un cuerpo ligeramente más ancho, lo que lo hace más cómodo de sostener y escribir durante períodos prolongados. Fabricado con madera de alta calidad, este bolígrafo no solo es una herramienta funcional, sino también una declaración de estilo. Su diseño refinado y suave al tacto lo convierten en un accesorio de escritura imprescindible para aquellos que aprecian la artesanía y la belleza natural de la madera. Ideal para uso diario o como regalo especial, este bolígrafo ofrece una experiencia de escritura excepcional en un paquete estéticamente atractivo.', '60000', 0, 1, '/proyectos/ArtisanMade/assets/img/productos/3/Slimline-Pens-Woodcraft-By-Owen-01.webp', '2024-05-05 19:38:01'),
(4, 'Cuadro enmarcado de papercut', 'Con la imagen de urracas es una obra de arte cautivadora que combina la delicadeza del arte del papercut con la belleza natural de las aves. Esta pieza presenta una meticulosa técnica de corte de papel que da vida a las gráciles siluetas de las urracas en medio de un intrincado diseño. El marco complementa perfectamente la elegancia de la obra, resaltando cada detalle con estilo y sofisticación. Colgado en cualquier pared, este cuadro añade un toque de encanto y serenidad a cualquier espacio, convirtiéndolo en una pieza destacada en la decoración del hogar o la oficina.', '200000', 0, 1, '/proyectos/ArtisanMade/assets/img/productos/4/Magpies-lifestyle-scaled.webp', '2024-05-05 19:43:22'),
(5, 'Bolso cruzado Silverlake', ' Es una elección sofisticada y versátil para el día a día. Fabricado en cuero de alta calidad, este bolso combina estilo y funcionalidad a la perfección. Con un diseño casual pero elegante, presenta un patrón floral grabado en relieve que añade un toque de distinción. Cuenta con múltiples bolsillos con cremallera que ofrecen un amplio espacio para organizar tus pertenencias de manera segura y conveniente. La correa ajustable te permite llevarlo cómodamente cruzado sobre el cuerpo, mientras que su tamaño compacto lo hace ideal para llevarlo contigo en cualquier ocasión. Ya sea para una salida informal o un evento más formal, este bolso es el complemento perfecto para tu estilo.', '400000', 5, 1, '/proyectos/ArtisanMade/assets/img/productos/5/71oe31W+sRL._AC_SY395_.jpg', '2024-05-05 19:46:50'),
(6, 'Bandeja redonda de Mamure ', 'Es una pieza artesanal encantadora y funcional que añade un toque de estilo y autenticidad a cualquier espacio. Fabricada con materiales de alta calidad y meticulosamente elaborada a mano, esta bandeja presenta un diseño único inspirado en la rica cultura y tradiciones de Mamure y Chiquichiqui. Su forma redonda y sus detalles artesanales le confieren un encanto especial, haciéndola perfecta para servir aperitivos, decorar una mesa o simplemente exhibirla como una obra de arte en sí misma. Ya sea en una reunión con amigos o como un elemento decorativo en tu hogar, esta bandeja añade un toque de belleza y originalidad a cualquier ocasión.', '120000', 0, 1, '/proyectos/ArtisanMade/assets/img/productos/6/07_Pia_900x.webp', '2024-05-05 21:27:23'),
(7, 'Canasto redondo de Cañaflecha', 'es una obra de artesanía tradicional que combina la belleza natural de los materiales con la funcionalidad práctica. Tejido a mano con cañaflecha, una planta nativa de ciertas regiones, este canasto destaca por su durabilidad y su distintivo diseño circular. Su tejido apretado y su construcción robusta lo hacen ideal para almacenar y transportar una variedad de objetos, desde alimentos hasta artículos de tocador o artesanías.', '75000', 0, 1, '/proyectos/ArtisanMade/assets/img/productos/7/zen-013-3_900x.webp', '2024-05-05 21:29:50'),
(8, 'Bolso Pera Beige Artesanal', 'es una expresión de elegancia y artesanía meticulosa. Fabricado con materiales de alta calidad y con un diseño único en forma de pera, este bolso es una pieza que destaca por su estilo distintivo y su atención al detalle. El color beige le otorga un aire de sofisticación atemporal, lo que lo convierte en un complemento versátil que puede adaptarse a una variedad de conjuntos y ocasiones. ', '150000', 5, 1, '/proyectos/ArtisanMade/assets/img/productos/8/descarga_1_b9dc3dd8-8274-4120-8898-afe59f8faabb.webp', '2024-05-05 21:34:13'),
(9, 'Sombrero Tradicional Fibras + Estuche + Correa', 'Los sombreros vueltiaos se tejen por fibras, naturales de caña flecha, el número de fibras al momento del tejido es lo que define la calidad de cada sombrero y la vida útil, siendo el menos fino es las 12 fibras tejido grueso y el más extra fino el 33 fibras.\r\n\r\nEl sombrero vueltiao es elaborado con productos totalmente natural y de una manera artesanal dicha materia prima es la caña flecha que se cultiva en el territorio del pueblo indígena Zenú en Córdoba y Sucre, de esta planta se sacan unas fibras delgadas con las cuales se realiza el tejido con el que se elabora el sombrero vueltiao.', '180000', 5, 1, '/proyectos/ArtisanMade/assets/img/productos/9/15_176a48a0-4a89-412a-b2d0-9663941ef509.webp', '2024-05-05 21:36:33'),
(10, 'Ruana Tradicional de Lana', 'Es una prenda emblemática que encarna la herencia cultural y la artesanía tradicional. Tejida con lana de alta calidad y con un diseño clásico, esta ruana es una muestra de la habilidad artesanal y la dedicación de sus fabricantes. Su estilo atemporal y su versatilidad la convierten en una opción elegante para cualquier ocasión, ya sea para abrigarse en un día frío o para complementar un conjunto sofisticado. ', '220000', 0, 1, '/proyectos/ArtisanMade/assets/img/productos/10/pas-016-1_900x.webp', '2024-05-05 21:37:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `activacion` int(11) NOT NULL DEFAULT 0,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(40) DEFAULT NULL,
  `password_request` int(11) NOT NULL DEFAULT 0,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `activacion`, `token`, `token_password`, `password_request`, `id_cliente`) VALUES
(1, 'gamerboyt1', '$2y$10$5O7tlPdlYF7ZGosqgkFpQ.RYwtV7RyebgBO5emUQPTQqqDyO0pyYe', 0, '6f6b61ad908414387ec7d89db12debf6', NULL, 0, 1),
(2, 'gamerboyt12', '$2y$10$LZUQgFMpajOGg2RHuXysLeJegPDKlNzXcmcFhGeUMU5fAkHpjv6gS', 0, '66b1aef8c216293ad96a29352d6c16ef', NULL, 0, 2),
(3, 'alejo123', '$2y$10$0WnI3P5ezGgXFSnr.EmwBeZUm9ustt2Msksz4Pf6JVygk7dLvEOOm', 0, 'ad3078dae2258ca4e340b5bd6fe02d6a', NULL, 0, 3),
(4, 'gamerboyt123', '$2y$10$R9S2HuUvZiPTIOUS6etsPeHkG.jVTRUwZV4LJXfz947WdL5b93Kpy', 0, 'be465e4a11e500f167752b93ece029fc', NULL, 0, 4),
(5, 'josemiguel', '$2y$10$SIT/LeoTRhr/vBNkAGQsUOOgTLr45c16efcCKp5QBmpvUorGdofz2', 0, '45030dc1d75877c2261d9f11aae7e1c8', NULL, 0, 5),
(6, 'Prueba1', '$2y$10$pgyjaizSPo1CjcephP2hOeS3fEalRZRDnQvnBIsSrutSh1Rtkxfgq', 0, 'f9395269ceb5852bd8889407c883d72f', NULL, 0, 6),
(7, 'alejo', '$2y$10$JSoWfkBPcl9ldL8pEMq0KuzspDDaPLoJ/YirrItRgilNNKx9N6doy', 0, '5903318942b14fcf3ca5fb17fd2fc84d', NULL, 0, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcadores`
--
ALTER TABLE `marcadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `marcadores`
--
ALTER TABLE `marcadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
