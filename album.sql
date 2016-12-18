-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-12-2016 a las 15:34:51
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `album`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE IF NOT EXISTS `albumes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 NOT NULL,
  `foto` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`id`, `nombre`, `usuario`, `foto`) VALUES
(18, 'Londres', 'davidm10', 0x66616c62756d65732f4c6f6e647265732e4a5047),
(19, 'Barcelona', 'silviagxi', 0x66616c62756d65732f42617263656c6f6e612e4a5047);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE IF NOT EXISTS `etiquetas` (
  `idfoto` int(11) NOT NULL,
  `etiqueta` varchar(20) NOT NULL,
  PRIMARY KEY (`idfoto`,`etiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`idfoto`, `etiqueta`) VALUES
(36, 'Eye'),
(36, 'London'),
(38, 'City'),
(40, 'Guell'),
(41, 'Montjuic'),
(42, 'Sagrada'),
(43, 'Clock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `idfoto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `foto` mediumblob NOT NULL,
  `idalbum` int(11) NOT NULL,
  `visibilidad` varchar(20) NOT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idfoto`, `titulo`, `usuario`, `foto`, `idalbum`, `visibilidad`) VALUES
(36, 'London_eye', 'davidm10', 0x66616c62756d65732f31385f4c6f6e646f6e5f6579652e4a5047, 18, 'publica'),
(38, 'City', 'davidm10', 0x66616c62756d65732f31385f436974792e4a5047, 18, 'privada'),
(40, 'Parque_Guell', 'silviagxi', 0x66616c62756d65732f31395f5061727175655f4775656c6c2e4a5047, 19, 'accesoLimitado'),
(41, 'Fuentes_de_Montjuic', 'silviagxi', 0x66616c62756d65732f31395f4675656e7465735f64655f4d6f6e746a7569632e4a5047, 19, 'publica'),
(42, 'Sagrada_familia', 'silviagxi', 0x66616c62756d65732f31395f536167726164615f66616d696c69612e4a5047, 19, 'privada'),
(43, 'Big_Ben', 'davidm10', 0x66616c62756d65732f31385f4269675f42656e2e4a5047, 18, 'accesoLimitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FechaNac` varchar(10) NOT NULL,
  `Sexo` varchar(10) NOT NULL,
  `Confirmado` tinyint(1) NOT NULL,
  PRIMARY KEY (`Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nombre`, `Apellidos`, `Usuario`, `Correo`, `Password`, `FechaNac`, `Sexo`, `Confirmado`) VALUES
('', '', 'admin', '', 'admin', '', '', 1),
('David ', 'Montllor Moreno', 'davidm10', 'davidmontllon96@gmail.com', 'password', '1996-04-10', 'hombre', 1),
('Silvia', 'GarcÃ­a GarcÃ­a', 'silviagxi', 'silviag94@hotmail.com', 'chorizo', '1996-04-09', 'mujer', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
