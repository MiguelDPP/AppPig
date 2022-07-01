-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-07-2022 a las 02:04:51
-- Versión del servidor: 10.5.12-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u410708458_apppig`
--

-- --------------------------------------------------------

CREATE DATABASE u410708458_apppig;
USE u410708458_apppig;

--
-- Estructura de tabla para la tabla `Animal`
--

CREATE TABLE `Animal` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripción` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Animal`
--

INSERT INTO `Animal` (`Id`, `Nombre`, `Descripción`) VALUES
(1, 'Cerdo', 'Animal rozado que se parece a pepa pig');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ComidaComprada`
--

CREATE TABLE `ComidaComprada` (
  `Id` bigint(20) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` bigint(20) NOT NULL,
  `FechaCompra` date NOT NULL,
  `Lote` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ComidaComprada`
--

INSERT INTO `ComidaComprada` (`Id`, `Nombre`, `Cantidad`, `Precio`, `FechaCompra`, `Lote`) VALUES
(1, 'Yuca con suero', 5, 60000, '2022-06-30', 1),
(2, 'Yuca', 9, 10000, '2022-07-01', 1),
(3, 'Pura papa', 20, 90000, '2022-06-30', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_Registro_Animal`
--

CREATE TABLE `Detalle_Registro_Animal` (
  `Id` bigint(20) NOT NULL,
  `IdRegistroAnimal` bigint(20) NOT NULL,
  `Lote` bigint(20) NOT NULL,
  `EstaMuerto` tinyint(1) NOT NULL,
  `FechaFallecimiento` date DEFAULT NULL,
  `EstaVendido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Detalle_Registro_Animal`
--

INSERT INTO `Detalle_Registro_Animal` (`Id`, `IdRegistroAnimal`, `Lote`, `EstaMuerto`, `FechaFallecimiento`, `EstaVendido`) VALUES
(1, 1, 1, 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evolucion_Animal`
--

CREATE TABLE `Evolucion_Animal` (
  `Id` int(11) NOT NULL,
  `Id_Detalle_Registro_Animal` bigint(11) NOT NULL,
  `Peso` int(11) NOT NULL,
  `Tamaño` int(11) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Valor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lotes`
--

CREATE TABLE `Lotes` (
  `Id` bigint(20) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Lotes`
--

INSERT INTO `Lotes` (`Id`, `Nombre`, `Descripcion`) VALUES
(1, '1', 'Primer lote'),
(3, 'F', ' ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OtrosAtributos`
--

CREATE TABLE `OtrosAtributos` (
  `Id` bigint(20) NOT NULL,
  `IdRegistroAnimal` bigint(20) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Valor` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `OtrosAtributos`
--

INSERT INTO `OtrosAtributos` (`Id`, `IdRegistroAnimal`, `Nombre`, `Valor`) VALUES
(1, 1, 'foto', ''),
(2, 1, 'caracteristicas', 'El mejor cerdito del mundo.'),
(3, 1, 'color', 'Rosado'),
(4, 1, 'peso', '15'),
(5, 1, 'precio', '12500'),
(6, 1, 'Numero de Patas', '4'),
(7, 1, 'Cola', 'Larga y peluda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos_Roles`
--

CREATE TABLE `Permisos_Roles` (
  `id` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  `pagina` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Permisos_Roles`
--

INSERT INTO `Permisos_Roles` (`id`, `rol`, `pagina`) VALUES
(1, 1, 'all');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE `Persona` (
  `TipoDocumento` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CC',
  `NoDocumento` bigint(12) NOT NULL,
  `Nombre_Completo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sexo` tinyint(1) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Telefono` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Municipio` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No registra',
  `Foto` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Persona`
--

INSERT INTO `Persona` (`TipoDocumento`, `NoDocumento`, `Nombre_Completo`, `Sexo`, `FechaNacimiento`, `Telefono`, `Email`, `Direccion`, `Municipio`, `Foto`) VALUES
('CC', 12345, 'Miguel portillo padilla', 1, '2005-05-08', '1234567253', 'harolfsanchez@gmail.com', 'Calle 11 Norte # 13 - 23', 'Aguachica', NULL),
('CC', 123456, 'Robertico M', 1, '2022-02-16', '325465425', 'patola@gmail.com', 'Calle 45 A', 'Aguachica', NULL),
('CC', 223344, 'Jefe Prueba', 1, '2001-07-26', '342342', 'jefe@gmail.com', 'Calle 43 #45', 'Aguachica', NULL),
('CC', 12345678, 'Sebastyan Mariota Rompete', 1, '1997-06-12', '325456854', 'mariota@gmail.com', 'Calle 13 A Barrio Nueva era', 'Bogota', NULL),
('CC', 100757222, 'Hwarol Fabian Trillos Sanchez', 1, '2002-01-01', '3023473539', 'Harolfsanchez25@gmail.com', 'Cra 100 #148 - 58', 'Aguachica', NULL),
('CC', 1007571422, 'Hwarol Fabian trillos', 1, '1999-01-01', '3023474542', 'harolfsanchez@gmail.com', 'calle 2 $ 23 - 32', 'Aguachica', NULL),
('CC', 1007571432, 'Hwarol Fabian Trillos Sanchez', 1, '2000-01-01', '3023473540', 'Harolfsanchez25@gmail.com', 'Cra 100 #148 - 58', 'Aguachica', NULL),
('CC', 1007571440, 'Hwarol Fabian Sanchez', 1, '1999-01-01', '3023474542', 'harolfsanchez@gmail.com', 'calle 2 $ 23 - 32', 'Aguachica', NULL),
('CC', 1007571442, 'Hwarol Fabian Sanchez', 1, '1999-01-01', '3023474542', 'harolfsanchez@gmail.com', 'calle 2 $ 23 - 32', 'Aguachica', NULL),
('CC', 1007571446, 'Hwarol Fabian Sanchez', 1, '1999-01-01', '3023474542', 'harolfsanchez@gmail.com', 'calle 2 $ 23 - 32', 'Aguachica', NULL),
('CC', 1007571449, 'Hwarol Fabian Sanchez', 1, '1999-01-01', '3023474542', 'harolfsanchez@gmail.com', 'calle 2 $ 23 - 32', 'Aguachica', NULL),
('CC', 10033781069, 'Roberto Melendez', 1, '2007-07-25', '3005350586', 'robertico@gmail.com', 'Calle 40 Transversal 54', 'Aguachica', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Raza`
--

CREATE TABLE `Raza` (
  `Id` int(11) NOT NULL,
  `IdAnimal` int(11) NOT NULL,
  `Nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Raza`
--

INSERT INTO `Raza` (`Id`, `IdAnimal`, `Nombre`, `Descripcion`) VALUES
(1, 1, 'Australianos', 'Los mejores cerdos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Registro_Animal`
--

CREATE TABLE `Registro_Animal` (
  `Id` bigint(20) NOT NULL,
  `RazaAnimal` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Registro_Animal`
--

INSERT INTO `Registro_Animal` (`Id`, `RazaAnimal`, `Cantidad`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Relacion_Persona_Rol`
--

CREATE TABLE `Relacion_Persona_Rol` (
  `Id` int(11) NOT NULL,
  `NoDocumento` bigint(12) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `Contrasena` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Relacion_Persona_Rol`
--

INSERT INTO `Relacion_Persona_Rol` (`Id`, `NoDocumento`, `IdRol`, `Contrasena`) VALUES
(1, 12345, 1, 'mipor.2789'),
(2, 12345678, 1, '12345678'),
(3, 123456, 2, 'jefe'),
(4, 10033781069, 1, '123456'),
(5, 223344, 2, 'jefecito'),
(9, 100757222, 2, 'hwarol2002'),
(10, 1007571432, 2, '12345678'),
(11, 1007571422, 2, '12345678'),
(12, 1007571442, 2, '12345678'),
(13, 1007571446, 2, '12345678'),
(14, 1007571440, 2, '12345678'),
(15, 1007571449, 2, '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `Roles` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`Id`, `Nombre`) VALUES
(1, 'Administrador'),
(2, 'Jefe de granja');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Animal`
--
ALTER TABLE `Animal`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `ComidaComprada`
--
ALTER TABLE `ComidaComprada`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Lote` (`Lote`);

--
-- Indices de la tabla `Detalle_Registro_Animal`
--
ALTER TABLE `Detalle_Registro_Animal`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdRegistroAnimal` (`IdRegistroAnimal`),
  ADD KEY `Lote` (`Lote`);

--
-- Indices de la tabla `Evolucion_Animal`
--
ALTER TABLE `Evolucion_Animal`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Detalle_Registro_Animal` (`Id_Detalle_Registro_Animal`);

--
-- Indices de la tabla `Lotes`
--
ALTER TABLE `Lotes`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `OtrosAtributos`
--
ALTER TABLE `OtrosAtributos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdRegistroAnimal` (`IdRegistroAnimal`);

--
-- Indices de la tabla `Permisos_Roles`
--
ALTER TABLE `Permisos_Roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD PRIMARY KEY (`NoDocumento`);

--
-- Indices de la tabla `Raza`
--
ALTER TABLE `Raza`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdAnimal` (`IdAnimal`);

--
-- Indices de la tabla `Registro_Animal`
--
ALTER TABLE `Registro_Animal`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Registro_Animal_ibfk_1` (`RazaAnimal`);

--
-- Indices de la tabla `Relacion_Persona_Rol`
--
ALTER TABLE `Relacion_Persona_Rol`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `NoDocumento` (`NoDocumento`),
  ADD KEY `Relación_Documento_Rol` (`IdRol`);

--
-- Indices de la tabla `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Animal`
--
ALTER TABLE `Animal`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ComidaComprada`
--
ALTER TABLE `ComidaComprada`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Detalle_Registro_Animal`
--
ALTER TABLE `Detalle_Registro_Animal`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Evolucion_Animal`
--
ALTER TABLE `Evolucion_Animal`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Lotes`
--
ALTER TABLE `Lotes`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `OtrosAtributos`
--
ALTER TABLE `OtrosAtributos`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Permisos_Roles`
--
ALTER TABLE `Permisos_Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Raza`
--
ALTER TABLE `Raza`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Registro_Animal`
--
ALTER TABLE `Registro_Animal`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Relacion_Persona_Rol`
--
ALTER TABLE `Relacion_Persona_Rol`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ComidaComprada`
--
ALTER TABLE `ComidaComprada`
  ADD CONSTRAINT `ComidaComprada_ibfk_1` FOREIGN KEY (`Lote`) REFERENCES `Lotes` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Detalle_Registro_Animal`
--
ALTER TABLE `Detalle_Registro_Animal`
  ADD CONSTRAINT `Detalle_Registro_Animal_ibfk_1` FOREIGN KEY (`IdRegistroAnimal`) REFERENCES `Registro_Animal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Detalle_Registro_Animal_ibfk_2` FOREIGN KEY (`Lote`) REFERENCES `Lotes` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Evolucion_Animal`
--
ALTER TABLE `Evolucion_Animal`
  ADD CONSTRAINT `Evolucion_Animal_ibfk_1` FOREIGN KEY (`Id_Detalle_Registro_Animal`) REFERENCES `Detalle_Registro_Animal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `OtrosAtributos`
--
ALTER TABLE `OtrosAtributos`
  ADD CONSTRAINT `OtrosAtributos_ibfk_1` FOREIGN KEY (`IdRegistroAnimal`) REFERENCES `Detalle_Registro_Animal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Raza`
--
ALTER TABLE `Raza`
  ADD CONSTRAINT `Raza_ibfk_1` FOREIGN KEY (`IdAnimal`) REFERENCES `Animal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Registro_Animal`
--
ALTER TABLE `Registro_Animal`
  ADD CONSTRAINT `Registro_Animal_ibfk_1` FOREIGN KEY (`RazaAnimal`) REFERENCES `Raza` (`Id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `Relacion_Persona_Rol`
--
ALTER TABLE `Relacion_Persona_Rol`
  ADD CONSTRAINT `Relacion_Persona_Rol_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `Roles` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relacion_Persona_Rol_ibfk_2` FOREIGN KEY (`NoDocumento`) REFERENCES `Persona` (`NoDocumento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
