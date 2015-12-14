-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-09-2011 a las 12:40:07
-- Versión del servidor: 5.1.54
-- Versión de PHP: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `kz_adeada_talleres_electricos_demo_adeada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_decisiones`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_decisiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `decision` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_decisiones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_decisionesreunion`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_decisionesreunion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idreunion` int(11) NOT NULL,
  `iddecision` int(11) DEFAULT NULL,
  `responsable` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `plazo` date DEFAULT NULL,
  `cerrado` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_decisionesreunion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_departamentos`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_departamentos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_objetivos`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_objetivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fechacreacion` date DEFAULT NULL,
  `anno` int(4) DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `plazoconsecucion` date DEFAULT NULL,
  `cumplido` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `periodicidad` int(4) DEFAULT NULL,
  `responsable` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_objetivos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_politicas`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_politicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `politica` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_politicas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_reuniones`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_reuniones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `asistentes` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `objeto` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechasig` date DEFAULT NULL,
  `horasig` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `departamento` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_reuniones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_revisiondireccion`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_revisiondireccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `anno` year(4) NOT NULL,
  `asistentes` text COLLATE utf8_spanish_ci,
  `resultado` text COLLATE utf8_spanish_ci,
  `retroalimentacion` text COLLATE utf8_spanish_ci,
  `desempeno` text COLLATE utf8_spanish_ci,
  `conformidad` text COLLATE utf8_spanish_ci,
  `estado` text COLLATE utf8_spanish_ci,
  `acciones` text COLLATE utf8_spanish_ci,
  `cambios` text COLLATE utf8_spanish_ci,
  `recomendaciones` text COLLATE utf8_spanish_ci,
  `revision` text COLLATE utf8_spanish_ci,
  `decisiones1` text COLLATE utf8_spanish_ci,
  `decisiones2` text COLLATE utf8_spanish_ci,
  `decisiones3` text COLLATE utf8_spanish_ci,
  `objetivos` text COLLATE utf8_spanish_ci NOT NULL,
  `tratar_acciones_mejora` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_revisiondireccion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_seguimientoobjetivos`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_seguimientoobjetivos` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `objetivo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `datos` text COLLATE utf8_spanish_ci,
  `observaciones` text COLLATE utf8_spanish_ci,
  `responsable` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `grado_consecucion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_seguimientoobjetivos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_temas`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_temas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tema` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_temas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_dir_temasreunion`
--

CREATE TABLE IF NOT EXISTS `kz_tec_dir_temasreunion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtema` int(11) NOT NULL,
  `idreunion` int(11) NOT NULL,
  `cerrado` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_dir_temasreunion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_doc_documentos`
--

CREATE TABLE IF NOT EXISTS `kz_tec_doc_documentos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `interno` tinyint(1) NOT NULL,
  `cod` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `generado` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_doc` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_doc_documentos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_doc_documentos_reales`
--

CREATE TABLE IF NOT EXISTS `kz_tec_doc_documentos_reales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddoc` int(11) NOT NULL,
  `titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `contenido` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `idrev` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_doc_documentos_reales`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_doc_manual`
--

CREATE TABLE IF NOT EXISTS `kz_tec_doc_manual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `presentacion_empresa` text COLLATE utf8_spanish_ci NOT NULL,
  `politica_calidad` text COLLATE utf8_spanish_ci NOT NULL,
  `alcance_sistema` text COLLATE utf8_spanish_ci NOT NULL,
  `referencia_procedimientos` text COLLATE utf8_spanish_ci NOT NULL,
  `mapa_procesos` text COLLATE utf8_spanish_ci NOT NULL,
  `organigrama_empresa` text COLLATE utf8_spanish_ci NOT NULL,
  `funciones_responsabilidades` text COLLATE utf8_spanish_ci NOT NULL,
  `iddoc` int(11) NOT NULL,
  `idrev` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_doc_manual`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_doc_procedimientos`
--

CREATE TABLE IF NOT EXISTS `kz_tec_doc_procedimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objeto` text COLLATE utf8_spanish_ci NOT NULL,
  `alcance` text COLLATE utf8_spanish_ci NOT NULL,
  `responsabilidades` text COLLATE utf8_spanish_ci NOT NULL,
  `desarrollo` text COLLATE utf8_spanish_ci NOT NULL,
  `flujo_proceso` text COLLATE utf8_spanish_ci NOT NULL,
  `referencias` text COLLATE utf8_spanish_ci NOT NULL,
  `registros_asociados` text COLLATE utf8_spanish_ci NOT NULL,
  `iddoc` int(11) NOT NULL,
  `idrev` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_doc_procedimientos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_doc_revisiones`
--

CREATE TABLE IF NOT EXISTS `kz_tec_doc_revisiones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rev` int(5) DEFAULT NULL,
  `soporte` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `realizado` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `aprobado` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cambio` text COLLATE utf8_spanish_ci,
  `fecha` date NOT NULL,
  `lugar` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `periodo` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vigor` tinyint(1) NOT NULL,
  `iddoc` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_doc_revisiones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mant_categoria`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mant_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mant_categoria`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mant_correctivo`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mant_correctivo` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `equipo` int(6) NOT NULL,
  `materiales` text COLLATE utf8_spanish_ci NOT NULL,
  `euros` float NOT NULL,
  `fecha_mant` date NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `horas` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mant_correctivo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mant_equipos`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mant_equipos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `anofab` int(4) DEFAULT NULL,
  `ref` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fab` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `modelo` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `referencia` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `elemento` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `categoria` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ubicacion` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaadq` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `sn` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecharetirada` date DEFAULT NULL,
  `funcion` text COLLATE utf8_spanish_ci,
  `cee` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mant_equipos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mant_pautas`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mant_pautas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `equipo` int(5) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `periodicidad` int(4) NOT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date NOT NULL,
  `responsable` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tiempoestimado` text COLLATE utf8_spanish_ci NOT NULL,
  `euros` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mant_pautas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mant_ubicacion`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mant_ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mant_ubicacion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_acpm`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_acpm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_nc` int(11) DEFAULT NULL,
  `fecha_apertura` date DEFAULT NULL,
  `causa_probable` text COLLATE utf8_spanish_ci,
  `tipo_accion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_accion` text COLLATE utf8_spanish_ci,
  `fecha_prevista_cierre` date DEFAULT NULL,
  `seguimiento` text COLLATE utf8_spanish_ci,
  `valoracion` text COLLATE utf8_spanish_ci,
  `fecha_cierre` date DEFAULT NULL,
  `responsable` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `coste` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cierre_eficaz` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_acpm`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_campos`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_campos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_campos`
--

INSERT INTO `kz_tec_mej_campos` (`id`, `descripcion`) VALUES
(1, 'Rapidez en la elaboración de Ofertas:'),
(2, 'Claridad en la elaboración de Ofertas:'),
(3, 'Competitividad (Calidad/Precio):'),
(4, 'Cumplimiento de plazos de entrega pactados:'),
(5, 'Adecuación de nuestros plazos de entrega a sus necesidades:'),
(6, 'Información acerca del estado del Pedido:'),
(7, 'Asesoramiento Técnico para la petición de Producto:'),
(8, 'Rapidez de respuesta en la resolución de Problemas:'),
(9, 'Capacidad del equipo humano en la resolución de dudas y problemas:'),
(10, ' Calidad del Servicio:'),
(11, 'Atención a Reclamaciones:');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_campos_es`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_campos_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_campos_es`
--

INSERT INTO `kz_tec_mej_campos_es` (`id`, `descripcion`) VALUES
(1, 'Rapidez en la elaboración de Ofertas:'),
(2, 'Claridad en la elaboración de Ofertas:'),
(3, 'Competitividad (Calidad/Precio):'),
(4, 'Cumplimiento de plazos de entrega pactados:'),
(5, 'Adecuación de nuestros plazos de entrega a sus necesidades:'),
(6, 'Información acerca del estado del Pedido:'),
(7, 'Asesoramiento Técnico para la petición de Producto:'),
(8, 'Rapidez de respuesta en la resolución de Problemas:'),
(9, 'Capacidad del equipo humano en la resolución de dudas y problemas:'),
(10, 'Calidad del Servicio:'),
(11, 'Atención a Reclamaciones:');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_campos_eu`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_campos_eu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_campos_eu`
--

INSERT INTO `kz_tec_mej_campos_eu` (`id`, `descripcion`) VALUES
(1, 'Eskaintzak egiteko azkartasuna:'),
(2, 'Eskaintzak egiterakoan argitasuna:'),
(3, 'Lehiakortasuna (kalitatea/prezioa):'),
(4, 'Lanak adostutako epean entregatzea'),
(5, 'Gure entregatze-epeak zure beharrei moldatzea:'),
(6, 'Zure eskariaren egoerari buruzko informazioa:'),
(7, 'Produktu eskaera egiteko aholkularitza-teknikoa:'),
(8, 'Arazoak konpontzeko erantzute- azkartasuna:'),
(9, 'Lan taldearen gaitasuna arazo eta dudak ebazteko:'),
(10, 'Zerbitzuaren kalitatea:'),
(11, 'Erreklamazioekiko arreta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_campos_eu_es`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_campos_eu_es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_campos_eu_es`
--

INSERT INTO `kz_tec_mej_campos_eu_es` (`id`, `descripcion`) VALUES
(1, 'Rapidez en la elaboración de Ofertas: / Eskaintzak egiteko azkartasuna:'),
(2, 'Claridad en la elaboración de Ofertas: / Eskaintzak egiterakoan argitasuna:'),
(3, 'Competitividad (Calidad/Precio): / Lehiakortasuna (kalitatea/prezioa):'),
(4, 'Cumplimiento de plazos de entrega pactados: / Lanak adostutako epean entregatzea'),
(5, 'Adecuación de nuestros plazos de entrega a sus necesidades: / Gure entregatze-epeak zure beharrei moldatzea:'),
(6, 'Información acerca del estado del Pedido: / Zure eskariaren egoerari buruzko informazioa:'),
(7, 'Asesoramiento Técnico para la petición de Producto: / Produktu eskaera egiteko aholkularitza-teknikoa:'),
(8, 'Rapidez de respuesta en la resolución de Problemas: / Arazoak konpontzeko erantzute- azkartasuna:'),
(9, 'Capacidad del equipo humano en la resolución de dudas y problemas: / Lan taldearen gaitasuna arazo eta dudak ebazteko:'),
(10, 'Calidad del Servicio: / Zerbitzuaren kalitatea:'),
(11, 'Atención a Reclamaciones: / Erreklamazioekiko arreta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_detectadaen`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_detectadaen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detectada_en` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_detectadaen`
--

INSERT INTO `kz_tec_mej_detectadaen` (`id`, `detectada_en`) VALUES
(1, 'DIRECCION'),
(2, 'ADMINISTRACION'),
(3, 'COMERCIAL'),
(4, 'MANTENIMIENTO'),
(5, 'COMPRAS'),
(6, 'PRODUCCION'),
(7, 'CALIDAD'),
(8, 'AUDITORIA EXTERNA'),
(9, 'AUDITORIA INTERNA'),
(10, 'ALMACEN'),
(11, 'PROVEEDOR'),
(12, 'CLIENTE'),
(13, 'MONTAJE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_encuesta`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_encuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organizacion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `comercial` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaencuesta` date DEFAULT NULL,
  `fecharespuesta` date DEFAULT NULL,
  `sugerencias` text COLLATE utf8_spanish_ci,
  `analisis` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_encuesta`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_motivosencuesta`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_motivosencuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idencuesta` int(11) NOT NULL,
  `calidad` tinyint(4) NOT NULL,
  `precio` tinyint(4) NOT NULL,
  `confianza` tinyint(4) NOT NULL,
  `atencion` tinyint(4) NOT NULL,
  `servicio` tinyint(4) NOT NULL,
  `cercania` tinyint(4) NOT NULL,
  `experiencia` tinyint(4) NOT NULL,
  `otros` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_motivosencuesta`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_noconformidades`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_noconformidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cnc` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tipoNC` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detectada_en` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detectada_por` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_deteccion` date DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `causa_estimada` text COLLATE utf8_spanish_ci,
  `tratamiento` text COLLATE utf8_spanish_ci,
  `responsable` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_prevista` date DEFAULT NULL,
  `seguimiento` text COLLATE utf8_spanish_ci,
  `fecha_cierre` date DEFAULT NULL,
  `coste` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cierre_eficaz` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `maquinaria` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mano_obra` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `materia_prima` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mediciones` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `metodos` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden_pedido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `unidades` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `detectada_por_` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_noconformidades`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_tiponc`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_tiponc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_tiponc`
--

INSERT INTO `kz_tec_mej_tiponc` (`id`, `tipo`) VALUES
(1, 'CLIENTE'),
(2, 'PROVEEDOR'),
(3, 'AUDITORIA'),
(4, 'INTERNA'),
(5, 'NC POTENCIAL'),
(6, 'CONJUNTO NC'),
(7, 'MEJORA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_mej_valoraciones`
--

CREATE TABLE IF NOT EXISTS `kz_tec_mej_valoraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campo` int(11) NOT NULL,
  `idencuesta` int(11) NOT NULL,
  `valcompetencia` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `valoracion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `aspectoimportante` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_mej_valoraciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_rrhh_accformativa`
--

CREATE TABLE IF NOT EXISTS `kz_tec_rrhh_accformativa` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `ano` int(5) DEFAULT NULL,
  `accionformativa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `accionfinalizada` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dirigida` text COLLATE utf8_spanish_ci,
  `objetivo` text COLLATE utf8_spanish_ci,
  `fechaprevista` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `impartidopor` text COLLATE utf8_spanish_ci,
  `plazoevaluacion` date DEFAULT NULL,
  `procesorelacionado` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacomienzo` date DEFAULT NULL,
  `fechafinal` date DEFAULT NULL,
  `responsableseguimiento` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `horas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_rrhh_accformativa`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_rrhh_asistentesformacion`
--

CREATE TABLE IF NOT EXISTS `kz_tec_rrhh_asistentesformacion` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `curso` int(6) NOT NULL,
  `persona` int(6) NOT NULL,
  `valoracion` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comentarios` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_rrhh_asistentesformacion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_rrhh_nombresperfiles`
--

CREATE TABLE IF NOT EXISTS `kz_tec_rrhh_nombresperfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_rrhh_nombresperfiles`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_rrhh_perfilespuestos`
--

CREATE TABLE IF NOT EXISTS `kz_tec_rrhh_perfilespuestos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `funciones` text COLLATE utf8_spanish_ci,
  `formacion` text COLLATE utf8_spanish_ci,
  `experiencia` text COLLATE utf8_spanish_ci,
  `caracteristicas` text COLLATE utf8_spanish_ci,
  `forvsexp` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_rrhh_perfilespuestos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_tec_rrhh_personal`
--

CREATE TABLE IF NOT EXISTS `kz_tec_rrhh_personal` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `movil` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `cp` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `funciones` text COLLATE utf8_spanish_ci NOT NULL,
  `titulacion` text COLLATE utf8_spanish_ci NOT NULL,
  `formacion` text COLLATE utf8_spanish_ci NOT NULL,
  `alta` date NOT NULL,
  `baja` date NOT NULL,
  `poblacion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `experiencia` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `dni` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `seguridad_social` text COLLATE utf8_spanish_ci,
  `centro` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_tec_rrhh_personal`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_clientes`
--

CREATE TABLE IF NOT EXISTS `kz_te_clientes` (
  `id` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cif` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `razon_social` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre_comercial` text COLLATE utf8_spanish_ci NOT NULL,
  `responsable_empresa` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `cp` int(11) NOT NULL,
  `poblacion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `comarca` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `movil` int(11) NOT NULL,
  `fax` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `kz_te_clientes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_detalle_trabajo`
--

CREATE TABLE IF NOT EXISTS `kz_te_detalle_trabajo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `idtrabajo` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_detalle_trabajo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_dietas`
--

CREATE TABLE IF NOT EXISTS `kz_te_dietas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tecnico` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `km` double NOT NULL,
  `parking` double NOT NULL,
  `peajes` double NOT NULL,
  `comidas` double NOT NULL,
  `otros` double NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `horas` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_dietas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_funciones`
--

CREATE TABLE IF NOT EXISTS `kz_te_funciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `kz_te_funciones`
--

INSERT INTO `kz_te_funciones` (`id`, `funcion`) VALUES
(1, 'Gerencia'),
(2, 'Administración'),
(3, 'Responsable de calidad'),
(7, 'Jefe de taller'),
(8, 'Especialista'),
(9, 'Oficial primera'),
(10, 'Oficial segunda'),
(11, 'Ayudante'),
(12, 'Aprendiz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_objetivos_clientes`
--

CREATE TABLE IF NOT EXISTS `kz_te_objetivos_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `anno` int(11) NOT NULL,
  `objetivo` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente` (`cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_objetivos_clientes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_objetivos_proyectos`
--

CREATE TABLE IF NOT EXISTS `kz_te_objetivos_proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `anno` int(11) NOT NULL,
  `objetivo` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_objetivos_proyectos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_partes`
--

CREATE TABLE IF NOT EXISTS `kz_te_partes` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `comercial` int(11) NOT NULL COMMENT 'Técnico',
  `cliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cliente',
  `provincia` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Provincia',
  `proyecto` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Trabajo',
  `dia` date NOT NULL COMMENT 'Fecha',
  `hora_inicio` time NOT NULL COMMENT 'Hora inicio',
  `hora_fin` time NOT NULL COMMENT 'Hora fin',
  `total_duracion` int(11) NOT NULL COMMENT 'Duración',
  `tipo_trabajo` int(11) NOT NULL COMMENT 'Tipo trabajo',
  `subtrabajo` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Detalle trabajo',
  `labor_realizada` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Labor realizada',
  `otros` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Otros comentarios',
  `tema_importante` int(11) NOT NULL COMMENT 'Tema importante',
  `system_date` datetime NOT NULL COMMENT 'Hora',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_partes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_personal`
--

CREATE TABLE IF NOT EXISTS `kz_te_personal` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `funcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_personal`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_planificacion_partes`
--

CREATE TABLE IF NOT EXISTS `kz_te_planificacion_partes` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `comercial` int(11) NOT NULL COMMENT 'Comercial',
  `cliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cliente',
  `provincia` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Provincia',
  `proyecto` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Proyecto',
  `dia` date NOT NULL COMMENT 'Fecha',
  `hora_inicio` time NOT NULL COMMENT 'Hora inicio',
  `hora_fin` time NOT NULL COMMENT 'Hora fin',
  `total_duracion` int(11) NOT NULL COMMENT 'Duración',
  `tipo_trabajo` int(11) NOT NULL COMMENT 'Tipo trabajo',
  `subtrabajo` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Detalle',
  `labor_realizada` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Labor realizada',
  `otros` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Otros coment.',
  `tema_importante` int(11) NOT NULL,
  `system_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_planificacion_partes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_provincias`
--

CREATE TABLE IF NOT EXISTS `kz_te_provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=52 ;

--
-- Volcar la base de datos para la tabla `kz_te_provincias`
--

INSERT INTO `kz_te_provincias` (`id`, `provincia`) VALUES
(1, 'A Coruña'),
(2, 'Alava'),
(3, 'Albacete'),
(4, 'Alicante'),
(5, 'Almería'),
(6, 'Asturias'),
(7, 'Avila'),
(8, 'Badajoz'),
(9, 'Barcelona'),
(10, 'Bizkaia'),
(11, 'Burgos'),
(12, 'Cáceres'),
(13, 'Cádiz'),
(14, 'Cantabria'),
(15, 'Castellón de la Plana'),
(16, 'Ceuta'),
(17, 'Ciudad Real'),
(18, 'Córdoba'),
(19, 'Cuenca'),
(20, 'Gipuzkoa'),
(21, 'Girona'),
(22, 'Granada'),
(23, 'Guadalajara'),
(24, 'Huelva'),
(25, 'Huesca'),
(26, 'Illes Balears'),
(27, 'Jaén'),
(28, 'La Rioja'),
(29, 'Las Palmas'),
(30, 'León'),
(31, 'Lleida'),
(32, 'Lugo'),
(33, 'Madrid'),
(34, 'Málaga'),
(35, 'Murcia'),
(36, 'Navarra'),
(37, 'Ourense'),
(38, 'Palencia'),
(39, 'Pontevedra'),
(40, 'Salamanca'),
(41, 'Santa Cruz de Tenerife'),
(42, 'Segovia'),
(43, 'Sevilla'),
(44, 'Soria'),
(45, 'Tarragona'),
(46, 'Teruel'),
(47, 'Toledo'),
(48, 'Valencia'),
(49, 'Valladolid'),
(50, 'Zamora'),
(51, 'Zaragoza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_proyectos`
--

CREATE TABLE IF NOT EXISTS `kz_te_proyectos` (
  `id` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `cliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `zona` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `prioridad` int(1) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_prevista` date NOT NULL,
  `fecha_real` date NOT NULL,
  `tipo_proyecto` int(3) NOT NULL,
  `horas_auditoria` int(11) NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `finalizado` int(11) NOT NULL,
  `externo_interno` text COLLATE utf8_spanish_ci NOT NULL,
  `comercial` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `kz_te_proyectos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_proyecto_personal`
--

CREATE TABLE IF NOT EXISTS `kz_te_proyecto_personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tecnico` int(11) NOT NULL,
  `proyecto` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_proyecto_personal`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_s_accesos`
--

CREATE TABLE IF NOT EXISTS `kz_te_s_accesos` (
  `acc_num` int(5) NOT NULL,
  `acc_ini` int(4) NOT NULL,
  `acc_ruta` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `acc_orden` int(4) NOT NULL,
  `acc_nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `tipoacceso` int(11) NOT NULL COMMENT '0 - PC, 1 - PDA, 2 - PDA y PC ',
  PRIMARY KEY (`acc_num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `kz_te_s_accesos`
--

INSERT INTO `kz_te_s_accesos` (`acc_num`, `acc_ini`, `acc_ruta`, `acc_orden`, `acc_nombre`, `tipoacceso`) VALUES
(1001, 100, '../commons/gestion_usuarios/opciones_sistema', 4, 'Opciones sistema', 2),
(1002, 100, '../commons/gestion_usuarios/gestion_perfiles', 2, 'Gestión perfiles', 2),
(1003, 100, '../commons/gestion_usuarios/gestion_usuarios', 3, 'Gestión usuarios', 2),
(11, 1, '../commons/proyectos_clientes/proyectos', 1, 'Trabajos', 2),
(12, 1, '../commons/proyectos_clientes/clientes', 2, 'Clientes', 2),
(13, 1, '../commons/proyectos_clientes/personal', 3, 'Personal', 2),
(21, 2, '../commons/partes/partes', 1, 'Partes', 2),
(22, 2, '../commons/partes/parte_diario', 1, 'Parte diario', 2),
(31, 3, '../commons/informes/informe_partes', 1, 'Partes', 0),
(23, 2, '../commons/agenda', 3, 'Vista agenda', 0),
(1004, 100, '../commons/gestion_meses/meses', 1, 'Gestión meses', 2),
(51, 5, '../commons/planificacion/planificacion', 1, 'Planificación', 2),
(52, 5, '../commons/agenda_planificacion', 2, 'Planificar agenda', 0),
(14, 1, '../commons/proyectos_tecnico/proyectos', 1, 'Trabajos', 2),
(32, 3, '../commons/informes/informe_proyectos', 2, 'Trabajos', 0),
(34, 3, '../commons/informes/informe_temas', 4, 'Temas pendientes', 0),
(61, 6, '	../commons/calidad/calidad', 1, 'Calidad', 2),
(15, 1, '../commons/proyectos_clientes/clientes_tecnico/clientes', 1, 'Clientes', 2),
(40, 3, '../commons/informes/informe_proyectosmes', 10, 'Fin Trabajos', 0),
(38, 3, '../commons/informes/informe_clientes', 8, 'Listado clientes', 0),
(39, 3, '../commons/informes/informe_listadoproyectos', 9, 'Listado trabajos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_s_opciones`
--

CREATE TABLE IF NOT EXISTS `kz_te_s_opciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL DEFAULT 'Sin descripcion',
  `num` int(10) unsigned NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `activada` tinyint(1) NOT NULL DEFAULT '1',
  `valor` text CHARACTER SET latin1 NOT NULL COMMENT 'Las opciones que tienen un valor (por ejemplo horas) se pone el valor aqui',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC COMMENT='Opciones del programa' AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `kz_te_s_opciones`
--

INSERT INTO `kz_te_s_opciones` (`id`, `nombre`, `num`, `descripcion`, `activada`, `valor`) VALUES
(1, 'TRABAJAR CON PROYECTOS', 100, 'Permite trabajar a los comerciales / técnicos con proyectos en los partes de trabajo', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_s_perfil`
--

CREATE TABLE IF NOT EXISTS `kz_te_s_perfil` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `centro` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `permisos` text COLLATE utf8_spanish_ci NOT NULL,
  `accesos` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `kz_te_s_perfil`
--

INSERT INTO `kz_te_s_perfil` (`id`, `nombre`, `centro`, `permisos`, `accesos`) VALUES
(1, 'ADMINISTRADOR', '', '221', '1001, 1002, 1003, 1004, 11, 12, 13, 21, 22, 31, 23, 51, 52, 32, 33, 34, 35, 36, 38, 39, 40, 61, 62, 41, 63'),
(2, 'COMERCIAL', '', '', '22, 51, 52, 14, 31, 32, 33, 34, 35, 62, 63');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_s_permisos`
--

CREATE TABLE IF NOT EXISTS `kz_te_s_permisos` (
  `perm_num` int(5) NOT NULL,
  `perm_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `perm_acceso` int(5) NOT NULL,
  PRIMARY KEY (`perm_num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `kz_te_s_permisos`
--

INSERT INTO `kz_te_s_permisos` (`perm_num`, `perm_descripcion`, `perm_acceso`) VALUES
(221, 'Añadir partes de cualquier comercial', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_s_secciones`
--

CREATE TABLE IF NOT EXISTS `kz_te_s_secciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=102 ;

--
-- Volcar la base de datos para la tabla `kz_te_s_secciones`
--

INSERT INTO `kz_te_s_secciones` (`id`, `nombre`) VALUES
(100, 'GESTION DE SISTEMA'),
(1, 'ADMON. TRABAJOS'),
(2, 'ADMON. PARTES'),
(3, 'INFORMES'),
(4, 'PARTES DE TRABAJO'),
(5, 'PLANIFICACION'),
(6, 'CALIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_temas_pendientes`
--

CREATE TABLE IF NOT EXISTS `kz_te_temas_pendientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tema` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `responsable` int(11) NOT NULL,
  `plazo` date NOT NULL,
  `ok` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_temas_pendientes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_tipo_proyecto`
--

CREATE TABLE IF NOT EXISTS `kz_te_tipo_proyecto` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `proyecto` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_tipo_proyecto`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_tipo_trabajo`
--

CREATE TABLE IF NOT EXISTS `kz_te_tipo_trabajo` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `trabajo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `kz_te_tipo_trabajo`
--

INSERT INTO `kz_te_tipo_trabajo` (`id`, `trabajo`) VALUES
(1, 'Instalación'),
(2, 'Reparación'),
(3, 'Revisión'),
(4, 'Diagnóstico'),
(5, 'Sustitución'),
(6, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kz_te_usuarios`
--

CREATE TABLE IF NOT EXISTS `kz_te_usuarios` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(320) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `kz_te_usuarios`
--

