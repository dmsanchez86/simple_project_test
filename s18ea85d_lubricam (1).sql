-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-01-2016 a las 16:55:19
-- Versión del servidor: 5.5.46-37.6
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `s18ea85d_lubricam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contaud`
--

CREATE TABLE IF NOT EXISTS `contaud` (
  `correo` varchar(250) NOT NULL,
  `id_usu` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE IF NOT EXISTS `creditos` (
  `correo` varchar(50) NOT NULL,
  `fichas` varchar(11) NOT NULL,
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`correo`, `fichas`) VALUES
('fjmeres@hotmail.com', '918'),
('franenalicante@hotmail.com', '872');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logeo`
--

CREATE TABLE IF NOT EXISTS `logeo` (
  `correo` varchar(50) NOT NULL,
  `unico` varchar(50) NOT NULL,
  `remoto` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  UNIQUE KEY `unico` (`unico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logeo`
--

INSERT INTO `logeo` (`correo`, `unico`, `remoto`, `fecha`) VALUES
('fjmeres@hotmail.com', '9491ce2c756881d978865d7d67d9ac0e', '217.216.40.201', '2015-11-16'),
('fjmeres@hotmail.com', '9bc5b9d2e0a1c0c9226157db82b51094', '90.69.133.201', '2015-11-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lubri_favoritos_usuarios`
--

CREATE TABLE IF NOT EXISTS `lubri_favoritos_usuarios` (
  `id_usuario_espectador` int(11) DEFAULT NULL,
  `id_usuario_modelo` int(11) DEFAULT NULL,
  KEY `id_usuario_espectador` (`id_usuario_espectador`),
  KEY `id_usuario_modelo` (`id_usuario_modelo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lubri_idiomas`
--

CREATE TABLE IF NOT EXISTS `lubri_idiomas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) DEFAULT NULL,
  `codigo2` varchar(20) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `original` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `lubri_idiomas`
--

INSERT INTO `lubri_idiomas` (`id`, `codigo`, `codigo2`, `descripcion`, `original`) VALUES
(1, 'eng', 'en', 'English', 'English'),
(2, 'spa', 'es', 'Spanish; Castilian', 'español'),
(3, 'ger', 'de', 'German', 'Deutsch'),
(4, 'fre', 'fr', 'French', 'français'),
(5, 'rus', 'ru', 'Russian', '???????'),
(6, 'ita', 'it', 'Italian', 'Italiano'),
(7, 'por', 'pt', 'Portuguese', 'Português'),
(8, 'chi', 'zh', 'Chinese', '??'),
(9, 'tur', 'tr', 'Turkish', 'Türkçe'),
(10, 'rum', 'ro', 'Romanian', 'Român'),
(11, 'pol', 'pl', 'Polish', 'Polskie'),
(12, 'ukr', 'uk', 'Ukrainian', '??????????'),
(13, 'gre', 'el', 'Greek', '????????'),
(14, 'jpn', 'ja', 'Japanese', '???'),
(15, 'hin', 'hi', 'Hindi', '??????'),
(16, 'urd', 'ur', 'Urdu', '????'),
(17, 'ara', 'ar', 'Arabic', '???????'),
(18, 'dut', 'nl', 'Dutch; Flemish', 'Nederlands'),
(19, 'ben', 'bn', 'Bangla', '??????'),
(20, 'ind', 'id', 'Indonesian', 'Indonesia'),
(21, 'tgl', 'tl', 'Tagalog', 'Tagalog'),
(22, 'tha', 'th', 'Thai', '???');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lubri_imagenes`
--

CREATE TABLE IF NOT EXISTS `lubri_imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_creador` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `precio_tokens` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_creador` (`id_usuario_creador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `lubri_imagenes`
--

INSERT INTO `lubri_imagenes` (`id`, `id_usuario_creador`, `fecha_creacion`, `precio_tokens`, `titulo`, `descripcion`, `url`) VALUES
(40, 3, '2015-11-13 00:36:32', NULL, NULL, NULL, 'fotoperfil6376.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lubri_paises`
--

CREATE TABLE IF NOT EXISTS `lubri_paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` varchar(3) NOT NULL,
  `pais_en` varchar(150) NOT NULL,
  `pais_es` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=248 ;

--
-- Volcado de datos para la tabla `lubri_paises`
--

INSERT INTO `lubri_paises` (`id`, `iso`, `pais_en`, `pais_es`) VALUES
(3, 'AD', 'Andorra', 'Andorra'),
(4, 'AE', 'United Arab Emirates', 'Emiratos Árabes Unidos'),
(5, 'AF', 'Afghanistan', 'Afganistán'),
(6, 'AG', 'Antigua and Barbuda', 'Antigua y Barbuda'),
(7, 'AI', 'Anguilla', 'Anguila'),
(8, 'AL', 'Albania', 'Albania'),
(9, 'AM', 'Armenia', 'Armenia'),
(10, 'AO', 'Angola', 'Angola'),
(11, 'AP', 'Asia/Pacific Region', 'Región de Asia/Pacífico'),
(12, 'AQ', 'Antarctica', 'Antártida'),
(13, 'AR', 'Argentina', 'Argentina'),
(14, 'AS', 'American Samoa', 'Samoa Americana'),
(15, 'AT', 'Austria', 'Austria'),
(16, 'AU', 'Australia', 'Australia'),
(17, 'AW', 'Aruba', 'Aruba'),
(18, 'AX', 'Aland Islands', 'Islas Åland'),
(19, 'AZ', 'Azerbaijan', 'Azerbaiyán'),
(20, 'BA', 'Bosnia and Herzegovina', 'Bosnia y Herzegovina'),
(21, 'BB', 'Barbados', 'Barbados'),
(22, 'BD', 'Bangladesh', 'Bangladés'),
(23, 'BE', 'Belgium', 'Bélgica'),
(24, 'BF', 'Burkina Faso', 'Burkina Faso'),
(25, 'BG', 'Bulgaria', 'Bulgaria'),
(26, 'BH', 'Bahrain', 'Baréin'),
(27, 'BI', 'Burundi', 'Burundi'),
(28, 'BJ', 'Benin', 'Benín'),
(29, 'BL', 'Saint Barthelemy', 'San Bartolomé'),
(30, 'BM', 'Bermuda', 'Bermudas'),
(31, 'BN', 'Brunei Darussalam', 'Brunéi'),
(32, 'BO', 'Bolivia', 'Bolivia'),
(33, 'BQ', 'Bonaire, Saint Eustatius and Saba', 'Bonaire, San Eustaquio y Saba'),
(34, 'BR', 'Brazil', 'Brasil'),
(35, 'BS', 'Bahamas', 'Bahamas'),
(36, 'BT', 'Bhutan', 'Bután'),
(37, 'BW', 'Botswana', 'Botsuana'),
(38, 'BY', 'Belarus', 'Bielorrusia'),
(39, 'BZ', 'Belize', 'Belice'),
(40, 'CA', 'Canada', 'Canada'),
(41, 'CC', 'Cocos (Keeling) Islands', 'Islas Cocos'),
(42, 'CD', 'Congo, The Democratic Republic of the', 'República Democrática del Congo'),
(43, 'CF', 'Central African Republic', 'República Centroafricana'),
(44, 'CG', 'Congo', 'República del Congo'),
(45, 'CH', 'Switzerland', 'Suiza'),
(46, 'CK', 'Cook Islands', 'Islas Cook'),
(47, 'CL', 'Chile', 'Chile'),
(48, 'CM', 'Cameroon', 'Camerún'),
(49, 'CN', 'China', 'Camerún'),
(50, 'CO', 'Colombia', 'Colombia'),
(51, 'CR', 'Costa Rica', 'Costa Rica'),
(52, 'CU', 'Cuba', 'Cuba'),
(53, 'CV', 'Cape Verde', 'Cabo Verde'),
(54, 'CW', 'Curacao', 'Curazao'),
(55, 'CX', 'Christmas Island', 'Isla de Navidad'),
(56, 'CY', 'Cyprus', 'Chipre'),
(57, 'CZ', 'Czech Republic', 'República Checa'),
(58, 'DE', 'Germany', 'Alemania'),
(59, 'DJ', 'Djibouti', 'Yibuti'),
(60, 'DK', 'Denmark', 'Dinamarca'),
(61, 'DM', 'Dominica', 'Dominica'),
(62, 'DO', 'Dominican Republic', 'República Dominicana'),
(63, 'DZ', 'Algeria', 'Argelia'),
(64, 'EC', 'Ecuador', 'Ecuador'),
(65, 'EE', 'Estonia', 'Estonia'),
(66, 'EG', 'Egypt', 'Egipto'),
(67, 'ER', 'Eritrea', 'Eritrea'),
(68, 'ES', 'Spain', 'España'),
(69, 'ET', 'Ethiopia', 'Etiopía'),
(70, 'EU', 'Europe', 'Europa'),
(71, 'FI', 'Finland', 'Finlandia'),
(72, 'FJ', 'Fiji', 'Fiyi'),
(73, 'FK', 'Falkland Islands (Malvinas)', 'Islas Malvinas'),
(74, 'FM', 'Micronesia, Federated States of', 'Micronesia'),
(75, 'FO', 'Faroe Islands', 'Islas Feroe'),
(76, 'FR', 'France', 'Francia'),
(77, 'GA', 'Gabon', 'Gabón'),
(78, 'GB', 'United Kingdom', 'Reino Unido'),
(79, 'GD', 'Grenada', 'Granada'),
(80, 'GE', 'Georgia', 'Georgia'),
(81, 'GF', 'French Guiana', 'Guayana Francesa'),
(82, 'GG', 'Guernsey', 'Guernsey'),
(83, 'GH', 'Ghana', 'Ghana'),
(84, 'GI', 'Gibraltar', 'Gibraltar'),
(85, 'GL', 'Greenland', 'Groenlandia'),
(86, 'GM', 'Gambia', 'Gambia'),
(87, 'GN', 'Guinea', 'Guinea'),
(88, 'GP', 'Guadeloupe', 'Guadalupe'),
(89, 'GQ', 'Equatorial Guinea', 'Guinea Ecuatorial'),
(90, 'GR', 'Greece', 'Grecia'),
(91, 'GS', 'South Georgia and the South Sandwich Islands', 'Islas Georgias del Sur y Sandwich del Sur'),
(92, 'GT', 'Guatemala', 'Guatemala'),
(93, 'GU', 'Guam', 'Guam'),
(94, 'GW', 'Guinea-Bissau', 'Guinea-Bisáu'),
(95, 'GY', 'Guyana', 'Guyana'),
(96, 'HK', 'Hong Kong', 'Hong Kong'),
(97, 'HN', 'Honduras', 'Honduras'),
(98, 'HR', 'Croatia', 'Croacia'),
(99, 'HT', 'Haiti', 'Haití'),
(100, 'HU', 'Hungary', 'Hungría'),
(101, 'ID', 'Indonesia', 'Indonesia'),
(102, 'IE', 'Ireland', 'Irlanda'),
(103, 'IL', 'Israel', 'Israel'),
(104, 'IM', 'Isle of Man', 'Isla de Man'),
(105, 'IN', 'India', 'India'),
(106, 'IO', 'British Indian Ocean Territory', 'Territorio Británico del Océano Índico'),
(107, 'IQ', 'Iraq', 'Irak'),
(108, 'IR', 'Iran, Islamic Republic of', 'República Islámica de Irán'),
(109, 'IS', 'Iceland', 'Islandia'),
(110, 'IT', 'Italy', 'Italia'),
(111, 'JE', 'Jersey', 'Jersey'),
(112, 'JM', 'Jamaica', 'Jamaica'),
(113, 'JO', 'Jordan', 'Jordania'),
(114, 'JP', 'Japan', 'Japón'),
(115, 'KE', 'Kenya', 'Kenia'),
(116, 'KG', 'Kyrgyzstan', 'Kirguistán'),
(117, 'KH', 'Cambodia', 'Camboya'),
(118, 'KI', 'Kiribati', 'Kiribati'),
(119, 'KM', 'Comoros', 'Comoras'),
(120, 'KN', 'Saint Kitts and Nevis', 'San Cristóbal y Nieves'),
(121, 'KR', 'Korea, Republic of', 'Corea del Sur'),
(122, 'KW', 'Kuwait', 'Kuwait'),
(123, 'KY', 'Cayman Islands', 'Islas Caimán'),
(124, 'KZ', 'Kazakhstan', 'Kazajistán'),
(125, 'LB', 'Lebanon', 'Líbano'),
(126, 'LC', 'Saint Lucia', 'Santa Lucía'),
(127, 'LI', 'Liechtenstein', 'Liechtenstein'),
(128, 'LK', 'Sri Lanka', 'Sri Lanka'),
(129, 'LR', 'Liberia', 'Liberia'),
(130, 'LS', 'Lesotho', 'Lesoto'),
(131, 'LT', 'Lithuania', 'Lituania'),
(132, 'LU', 'Luxembourg', 'Luxemburgo'),
(133, 'LV', 'Latvia', 'Letonia'),
(134, 'LY', 'Libya', 'Libia'),
(135, 'MA', 'Morocco', 'Marruecos'),
(136, 'MC', 'Monaco', 'Mónaco'),
(137, 'MD', 'Moldova, Republic of', 'República de Moldavia'),
(138, 'ME', 'Montenegro', 'Montenegro'),
(139, 'MF', 'Saint Martin', 'San Martín'),
(140, 'MG', 'Madagascar', 'Madagascar'),
(141, 'MH', 'Marshall Islands', 'Islas Marshall'),
(142, 'MK', 'Macedonia', 'República de Macedonia'),
(143, 'ML', 'Mali', 'Malí'),
(144, 'MM', 'Myanmar', 'Birmania'),
(145, 'MN', 'Mongolia', 'Mongolia'),
(146, 'MO', 'Macau', 'Macao'),
(147, 'MP', 'Northern Mariana Islands', 'Islas Marianas del Norte'),
(148, 'MQ', 'Martinique', 'Martinica'),
(149, 'MR', 'Mauritania', 'Mauritania'),
(150, 'MS', 'Montserrat', 'Montserrat'),
(151, 'MT', 'Malta', 'Malta'),
(152, 'MU', 'Mauritius', 'Mauricio'),
(153, 'MV', 'Maldives', 'Maldivas'),
(154, 'MW', 'Malawi', 'Malaui'),
(155, 'MX', 'Mexico', 'México'),
(156, 'MY', 'Malaysia', 'Malasia'),
(157, 'MZ', 'Mozambique', 'Mozambique'),
(158, 'NA', 'Namibia', 'Namibia'),
(159, 'NC', 'New Caledonia', 'Nueva Caledonia'),
(160, 'NE', 'Niger', 'Níger'),
(161, 'NF', 'Norfolk Island', 'Isla Norfolk'),
(162, 'NG', 'Nigeria', 'Nigeria'),
(163, 'NI', 'Nicaragua', 'Nicaragua'),
(164, 'NL', 'Netherlands', 'Países Bajos'),
(165, 'NO', 'Norway', 'Noruega'),
(166, 'NP', 'Nepal', 'Nepal'),
(167, 'NR', 'Nauru', 'Nauru'),
(168, 'NU', 'Niue', 'Niue'),
(169, 'NZ', 'New Zealand', 'Nueva Zelanda'),
(170, 'OM', 'Oman', 'Omán'),
(171, 'PA', 'Panama', 'Panamá'),
(172, 'PE', 'Peru', 'Perú'),
(173, 'PF', 'French Polynesia', 'Polinesia Francesa'),
(174, 'PG', 'Papua New Guinea', 'Papúa Nueva Guinea'),
(175, 'PH', 'Philippines', 'Filipinas'),
(176, 'PK', 'Pakistan', 'Pakistán'),
(177, 'PL', 'Poland', 'Polonia'),
(178, 'PM', 'Saint Pierre and Miquelon', 'San Pedro y Miquelón'),
(179, 'PN', 'Pitcairn Islands', 'Islas Pitcairn'),
(180, 'PR', 'Puerto Rico', 'Puerto Rico'),
(181, 'PS', 'Palestinian Territory', 'Autoridad Nacional Palestina'),
(182, 'PT', 'Portugal', 'Portugal'),
(183, 'PW', 'Palau', 'Palaos'),
(184, 'PY', 'Paraguay', 'Paraguay'),
(185, 'QA', 'Qatar', 'Catar'),
(186, 'RE', 'Reunion', 'Reunión'),
(187, 'RO', 'Romania', 'Rumania'),
(188, 'RS', 'Serbia', 'Serbia'),
(189, 'RU', 'Russian Federation', 'Federación de Rusia'),
(190, 'RW', 'Rwanda', 'Ruanda'),
(191, 'SA', 'Saudi Arabia', 'Arabia Saudita'),
(192, 'SB', 'Solomon Islands', 'Islas Salomón'),
(193, 'SC', 'Seychelles', 'Seychelles'),
(194, 'SD', 'Sudan', 'Sudán'),
(195, 'SE', 'Sweden', 'Suecia'),
(196, 'SG', 'Singapore', 'Singapur'),
(197, 'SH', 'Saint Helena', 'Santa Helena'),
(198, 'SI', 'Slovenia', 'Eslovenia'),
(199, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard y Jan Mayen'),
(200, 'SK', 'Slovakia', 'Eslovaquia'),
(201, 'SL', 'Sierra Leone', 'Sierra Leona'),
(202, 'SM', 'San Marino', 'San Marino'),
(203, 'SN', 'Senegal', 'Senegal'),
(204, 'SO', 'Somalia', 'Somalia'),
(205, 'SR', 'Suriname', 'Surinam'),
(206, 'SS', 'South Sudan', 'Sudán del Sur'),
(207, 'ST', 'Sao Tome and Principe', 'Santo Tomé y Príncipe'),
(208, 'SV', 'El Salvador', 'El Salvador'),
(209, 'SX', 'Sint Maarten (Dutch part)', 'Sint Maarten'),
(210, 'SY', 'Syrian Arab Republic', 'Siria'),
(211, 'SZ', 'Swaziland', 'Suazilandia'),
(212, 'TC', 'Turks and Caicos Islands', 'Islas Turcas y Caicos'),
(213, 'TD', 'Chad', 'Chad'),
(214, 'TF', 'French Southern Territories', 'Territorios Australes Franceses'),
(215, 'TG', 'Togo', 'Togo'),
(216, 'TH', 'Thailand', 'Tailandia'),
(217, 'TJ', 'Tajikistan', 'Tayikistán'),
(218, 'TK', 'Tokelau', 'Tokelau'),
(219, 'TL', 'Timor-Leste', 'Timor Oriental'),
(220, 'TM', 'Turkmenistan', 'Turkmenistán'),
(221, 'TN', 'Tunisia', 'Túnez'),
(222, 'TO', 'Tonga', 'Tonga'),
(223, 'TR', 'Turkey', 'Turquía'),
(224, 'TT', 'Trinidad and Tobago', 'Trinidad y Tobago'),
(225, 'TV', 'Tuvalu', 'Tuvalu'),
(226, 'TW', 'Taiwan', 'Taiwán'),
(227, 'TZ', 'Tanzania, United Republic of', 'República Unida de Tanzania'),
(228, 'UA', 'Ukraine', 'Ucrania'),
(229, 'UG', 'Uganda', 'Uganda'),
(230, 'UM', 'United States Minor Outlying Islands', 'Islas Ultramarinas Menores de Estados Unidos'),
(231, 'US', 'United States', 'Estados Unidos'),
(232, 'UY', 'Uruguay', 'Uruguay'),
(233, 'UZ', 'Uzbekistan', 'Uzbekistán'),
(234, 'VA', 'Holy See (Vatican City State)', 'Ciudad del Vaticano'),
(235, 'VC', 'Saint Vincent and the Grenadines', 'San Vicente y las Granadinas'),
(236, 'VE', 'Venezuela', 'Venezuela'),
(237, 'VG', 'Virgin Islands, British', 'Islas Vírgenes Británicas'),
(238, 'VI', 'Virgin Islands, U.S.', 'Islas Vírgenes de los Estados Unidos'),
(239, 'VN', 'Vietnam', 'Vietnam'),
(240, 'VU', 'Vanuatu', 'Vanuatu'),
(241, 'WF', 'Wallis and Futuna', 'Wallis y Futuna'),
(242, 'WS', 'Samoa', 'Samoa'),
(243, 'YE', 'Yemen', 'Yemen'),
(244, 'YT', 'Mayotte', 'Mayotte'),
(245, 'ZA', 'South Africa', 'Sudáfrica'),
(246, 'ZM', 'Zambia', 'Zambia'),
(247, 'ZW', 'Zimbabwe', 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lubri_registro_creditos_usuarios`
--

CREATE TABLE IF NOT EXISTS `lubri_registro_creditos_usuarios` (
  `id_usuario` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT NULL,
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lubri_usuarios`
--

CREATE TABLE IF NOT EXISTS `lubri_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(250) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `nick` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `detalles` varchar(500) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `creditos` int(11) DEFAULT NULL,
  `localidad` varchar(200) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `semilla` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `codigo_activacion` varchar(255) NOT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `id_imagen_perfil` int(11) DEFAULT NULL,
  `id_idioma` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `nick` (`nick`),
  KEY `id_imagen_perfil` (`id_imagen_perfil`),
  KEY `id_pais` (`id_pais`),
  KEY `id_idioma` (`id_idioma`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `lubri_usuarios`
--

INSERT INTO `lubri_usuarios` (`id`, `correo`, `fecha_nacimiento`, `nick`, `nombre`, `detalles`, `descripcion`, `fecha_registro`, `creditos`, `localidad`, `password`, `semilla`, `activo`, `codigo_activacion`, `id_pais`, `id_imagen_perfil`, `id_idioma`) VALUES
(1, 'jorge@gmail.com', '1993-08-26', 'jorge', 'jorge', 'en los pezones', 'soy un chico muy timido jjijiji', '2015-08-25 13:53:01', NULL, 'mursia', 'dM`VgÒLPÊ6Þx}­|9Æ(ÜæR‡RAnµ[§ÍšÕyqT‹iOXæŸ%Ã,É©ªÛ¯á?¾“Ãû(Ðkì>Åí|ðÎ¢óº«¤¥Í®ù¨^hq%¸˜—Äõ$ÝGøºÍ Û~ûZÄßV*åuMá›\0ÝŽuèéjÂ…4…Úá`]‰þ[¶Ê¦RRËÇkŽÀˆìö±h˜ý±¾¼õ3_Ã	¹.EV<›bŽ˜²¹&ÞhZ"_]íë«ž‡È’ÿêR', 'EUKADGHNHABBFDESASAZMRNOFMMZJDMFTKNFJNHSAWJLRLOURKZHFFXHEZLOKSJELJIBDRWEMYXZGVFINQNQAYEAXSIRCCNEZNNYTKRXCGPKBAIXLXBEFRWHRUHXCSBJJMTPPQUGBENCKWXVFVRIQQYZNYNHGBGLMDWIPCUYHBULYCGORRFEGHLNRBTHPEGKGTPJASMI', 1, 'GAKPPOWCZGUIIKVVFMUEJFNYVPTHTUHUTGZGLJBZFKJGPIDZELJQICMHJVHMWVAJDQNTNJRVUOSXMXAPCGPBCICSUGMDXRVFQAGHNLFCRCZYPVHKGCTTCQAUPIWFPXVFTFDWNMJIRZJBUAJWONKBASLGPYSNCNZLJIWZTMFOXQINPXCHNPMTYRNNGYBWMIWNFCZQRPPC', 68, 32, 391),
(2, 'bla@gmail.com', '1993-10-10', 'blas', 'blas', '', '', '2015-09-01 15:18:03', NULL, '', '20üX`ÆîNq3ûyI«Õ±Âk¼$Z7‘‹tµQ3»ypmmµ¯Œ_¨%/Ý¾b-a¶Ë†¾L1°Óa•ö¦:ÔTÏá€³TrÑzC²—tXá×­¸t¨¹hÚKˆPâ`ØSNâj†Wø*7’!(ü+òEYwÜåÀÐZ/lLì d%;m\nvæZÞ/BÃõPÑÁj|,®”M¼<ÅÌ:¡øÞà±‘Ï]õá.Ó¤¸ðÐ‹lJês5ZâÊÜ	¬?×_ê6C', 'SNUKNZHSYTQYPIOWTKXWLIWJREFUUKWAUAKGWBIZCOCXZKFHMWFXYKCZHZBXYZNPLYCYZIJTXTRKKOFBTPDGDJMWMJRKSYHPKCVKJMNFVFISAAJGWQWBMEXUTUMJETRCUUWPSLGBAPAZLZNERPYLRFEXIRVCZAJUFDWFSDPHYDANMOZPEDUSGPPHTKAPSRZADZVQFNXG', 1, 'KNDPVXPDXPYLPBTWESRNRVYWOXSBSQTMHTALDTGTYUOUVMIVVNTZRGCJSWVFCQGLTZQSJDOCBPIKEMNUMETRYQMRRKTEFCBUFDQHZNCKPJSQBFOLZFZIGUIVTVPYLSQMJOAUNPHWAIHJSALONEJDBDBEIBPTKIUUWIXYAUEAWOAKJOIEKZIWZGSVYXDCAYTLBMOVOACQ', 3, 27, 1),
(3, 'fjmeres@hotmail.com', NULL, 'lb123', '', '', '', '2015-09-01 22:38:24', NULL, NULL, 's´,IéÄÒŸ§l{ÇaKÍ|%]óŸÁ˜ä°\nŽ×Ð³2/†„;M€L.dÚ…òæX)z\nF•<#žkw¨ù	¬ð×™R‡:M\\À;ørð>édÎ’<>ÙŒƒ›µldÝŸºÍÞ,2š»f¨\n‹pìMcv)üKÔÒœo¦ìCðì	œ‹‚“üÌÓNsT²ör“Wº#3e‚b_ÊK_nði£¿þ§ÊÌ–''‚ÐäÏó6êÈ…îYßô#BW´ÈãÏ›ŠnqššÃëèY', 'LUPQADYXVNNRSJYGIZIMCRJCIHKXOALYWVSDNBLKNJFPGHCNAGIYPVLNBCBHZADKYBJFKYXDHZVRMVYUJNOIABMMTJNERNLQXVXWLBGHEXKYJRMGLHIRQTBHDXJOHTSGMETRRPZOVTJBWIPCSAVCSUKWHBQAIZSCCYBESIYFICFKTAKUEJEGUMCAILMTIKZEUMGOPXSH', 1, 'FVHPIDIKVSMIEVPVGORYOYOSLXHIJQFVMYBZSENPSTFHVFDFOPIVVMOFHCUOVQUQNHPAVLLDKBSTUHLLSURITIYWUKVAIYTKYQVYDJVCGILKHWLEEEKIDXHGMHVDKMUCSJGZCDYNEUPWAXVZCQCRJIIVIAMMDELEYEOEEWIMJQWKGQCRHJQRPPPCOPMZMMNYTZNXMUJP', NULL, 40, NULL),
(4, 'ricardojara01@gmail.com', NULL, 'ricardo', '', '', '', '2015-09-01 22:52:48', NULL, NULL, '±–w-Ñá,''ÚaæTy`*9âæFÄo„é`ºV''q,ÉäÔã@&¨"_å¯÷+{ØJo´8rðaq.²¸ž%çýìÉôê±tgËßä/¤“ÙÈ¤1Æì¨\Zq˜‘Â»OÑ²ºÝäÂ÷›7œ]ë›åã7Ä“_I-¥Î¾*¹µ@BÈ\ZýÆ­®>X°±\Z\r:\n›þjÂfšk`-ÕµHË¶G‘œ æ‚;q5ÖÒOåhfú‹qùïe·Š&6H0,-¤öë	‡9íˆ\\idg¢Ìa9Ð', 'PKPFGBUTJKPTDSGRXOFISEINFKTUMMJHDFRWHBHYHPZIJGEALLANLFHZGQIWSJQPQDKAKBGOZNBLLPMIDJEWQPKJUPTGLLCASZNIFAVPQERCTWCRYPYSPYMBPWBXLSYIDTBGBFYVDYUAPWUTOPBEVJXRCRAXIFADOTTXKYIOZMGNKNVBKVQWHJRQHBUFKGMUDQVHEPFH', 1, 'TUPPRUVXMTLMCVOLFQPNVITOKHODUWVFPMMZQDKUUHSGNGKNXUJLGYLMCZALQVOFMYWSQCOXHQCPUOYYMDQAFLJDEVOWFAMAIGQIVIHIGJBPKERUHGZKRXKKXSCVKMCUXBCPRXBPQDEIUQMTLKXNFNGNJBRQFJPCTAXYCLLBQYFCISYOKXEQXWNFVZCDXPBZVHZTRYVN', NULL, NULL, NULL),
(5, 'mtn.lcss@gmail.com', NULL, 'lb123456', '', '', '', '2016-01-04 14:50:53', NULL, NULL, '‡‰*S[\ZIÿávó·ÞéáÂ#¯~ÈÿÜ¼Žë¸‡Ø7}¢±¡~ba¿U‚Š}HV}cñL©a¶m¶WµÑ2X¬]h–ŸNµ§•²{ûþ­z¥]•Ïz*Ïib—:íg½ÇšJ÷îÄ%øHÔZ¡³¼W˜WZl”í=5£YCT363îè0ÏùNO<ópôˆfc‡ôÌM£åò Û9>æ2Âæ’ï)4OAä¼¬ÿ†;gIºÜœ¾«vû#ÛÊV<Â¼â*¥Z£™.‡ipr5Wè', 'XWJDITRGOKRLXVLUIWHKZPYWBBRAYHYBCIDLCPNATJTBLOUQYFOJZBHGLFIXFGSRELSJBVVTLGTGRNFBPSMYMDXGVMXWXWWIEEYXLHJEJVQBVJCUKNABXPAJCXHHGANOUTHMHHEBQCMPGOHPWANCRALVRHYUDQXCYYLGDUWLVCSLPOSSLGWNNBZLSHYAYDTWJPBHLQBJ', 1, 'ZMPIYSVSXCRKSZXCJGFOZQLAXOTAJOSNQPHRFVQDOAAXPCGMVFHQBILZCUKZQPZILFJCPFXOUTTHBWGYHLFWRALLCLYHBCWCXMVYWWIQLWEMWBKAFSHBZXFHKZDJOKKGPEXWEMEZJUKNNAOUBTJGUSBTBLEMYPPEZFRKPBQCBWQIMNFOJTYPCBPEIMFTOFRBANMNRWUQ', NULL, NULL, NULL),
(6, 'sergio_2015_2015_@hotmail.com', NULL, 'sebasnm', '', '', '', '2016-01-04 14:55:00', NULL, NULL, '± ªéù²M¸!âK+@ïô¿T\0nSöý`€øP§#CÈ¬*1¾‰ô¡IÅÀ#öjÓ§“øfD~¼(“±Má@&Cq°˜‹F€/\Ze¿» \\	hôph«žž–aè‘—VNôRdcÊ!u­BQãªÆŠ¤Èœüa¿Ü‰l}ù6T0a?vÈ/¤_T	2}y®MÎÎçOknšXüá]ªP´žpì)tÉOµÃ¿2õ]ÿôÕ2ÙôDaàCýª›A¼l]Œ0ÿzxÀ3Ü', 'VPNDGOUMASIQUMEVDSCKYQEWZIMCKGMHAVPLPSDENBVLZPPMCBCFEITUTKNLWXSSRDHKVNPZHFFXJBACULRPGZOIJQDOAUYTYEQPKWGDLVAOXBAUHSYJWVHDYYBKMRRYQSFOERPJGOWWKZIBMCCOQMBEJHPNEKGCVGYDENQYZNDHJLFPTGSEUPPBHAUGJKJSGCFIZWOO', 1, 'SFCVYYZTQCYOXJKFEQWYEKVSDUTRVBPAOZXUOBABTEXBCLRWHXXMZHADFHTKZXYMTSFLVGEGIRIEEZNIVTEXNOXYQOVERIWZGYPVEBKPXOPZQXKZPLCNWYFIQFLQVCQNRVWBNDEQRQGXINFMTERHLGAECIMABLBGDQWQHHGGHBJPXBDGGKJYBYDHZUWOHSUNADRLKJFF', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lubri_usuarios_idiomas`
--

CREATE TABLE IF NOT EXISTS `lubri_usuarios_idiomas` (
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `id_idioma` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`,`id_idioma`),
  KEY `id_idioma` (`id_idioma`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lubri_usuarios_paises_bloqueados`
--

CREATE TABLE IF NOT EXISTS `lubri_usuarios_paises_bloqueados` (
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `id_pais` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`,`id_pais`),
  KEY `id_pais` (`id_pais`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lubri_usuarios_paises_bloqueados`
--

INSERT INTO `lubri_usuarios_paises_bloqueados` (`id_usuario`, `id_pais`) VALUES
(1, 3),
(1, 6),
(1, 247);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(250) NOT NULL,
  `id_usu` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sexo` varchar(250) NOT NULL,
  `edad` varchar(250) NOT NULL,
  `emision` varchar(250) NOT NULL,
  `bondage` varchar(250) NOT NULL,
  `zona` varchar(250) NOT NULL,
  `codigo` text NOT NULL,
  `audiencia` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Volcado de datos para la tabla `online`
--

INSERT INTO `online` (`id`, `foto`, `id_usu`, `nombre`, `fecha`, `sexo`, `edad`, `emision`, `bondage`, `zona`, `codigo`, `audiencia`) VALUES
(24, 'uploads/original/8acd422d5898a69d440a4cc4e097594e.jpg', 4, 'ricardo', '2015-11-16 13:41:21', 'Hombre', '18 / 20', 'Webcam Hd', 'Estilo Bondage', 'Europa / Rusia', '<iframe width="420" height="315" src="http://www.youtube.com/embed/L-Cxu_s_wKY" frameborder="0" allowfullscreen></iframe>', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `edad` varchar(100) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `idioma` varchar(250) NOT NULL,
  `pais` varchar(250) NOT NULL,
  `localidad` varchar(250) NOT NULL,
  `detalles` text NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `correo`, `edad`, `alias`, `idioma`, `pais`, `localidad`, `detalles`, `descripcion`) VALUES
('2', 'fjmeres@hotmail.com', '1-1-1983', 'Nombre Chat', 'EspaÃ±ol, InglÃ©s', 'EspaÃ±a', 'Comunidad alenciana', 'Tatoos, Piercing?:Tatoos, Piercing?:', 'Acerca de mi:Acerca de mi:'),
('3', 'franenalicante@hotmail.com', '', 'lb123', '', '', '', '', ''),
('7', 'directer.murcia@hotmail.com', '', 'lb123456', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE IF NOT EXISTS `registro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(12) NOT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`usuario`,`correo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `usuario`, `correo`, `clave`, `fecha_registro`) VALUES
(2, 'lb12345', 'fjmeres@hotmail.com', 'fran12345', '2015-08-14'),
(3, 'lb123', 'franenalicante@hotmail.com', 'fran123', '2015-08-14'),
(7, 'lb123456', 'directer.murcia@hotmail.com', 'fran123456', '2015-10-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `textos`
--

CREATE TABLE IF NOT EXISTS `textos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `textos`
--

INSERT INTO `textos` (`id`, `texto`) VALUES
(1, 'TÃ©rminos y condiciones de acceso: \r\nEste sitio web contiene informaciÃ³n, enlaces, imÃ¡genes y vÃ­deos de material sexualmente explÃ­cito. No continÃºe si: (i) no tiene por lo menos 18 aÃ±os de edad o mayores de edad en su jurisdicciÃ³n en la que usted puede ver el material sexualmente explÃ­cito, (ii) dicho material le ofende, o (iii) de ver el material sexualmente explÃ­cito no es legal en su comunidad o paÃ­s donde  elige para visualizar.\r\nAl optar por entrar en este sitio web que estÃ¡ afirmando bajo juramento y pena de perjurio de conformidad con el TÃ­tulo 28 USC Â§ 1746 y otros estatutos y leyes que todas las siguientes declaraciones son verdaderas y correctas aplicables:\r\n\r\nâ€¢ He alcanzado la mayorÃ­a de edad en mi jurisdicciÃ³n;\r\nâ€¢ El material sexualmente explÃ­cito que voy a ver es para mi uso personal y no voy a exponer a los menores a dicho material;\r\nâ€¢ Deseo recibir / ver material sexualmente explÃ­cito;\r\nâ€¢ Creo que como adulto es mi derecho constitucional inalienable a recibir / ver material sexualmente explÃ­cito;\r\nâ€¢ Creo que los actos sexuales entre adultos que consienten no son ni ofensivos ni obscenos;\r\nâ€¢ La visualizaciÃ³n, lectura y descarga de material sexualmente explÃ­cito no viola los estÃ¡ndares de cualquier comunidad, pueblo, ciudad, estado o paÃ­s donde lo visualizarÃ©, leerÃ© y / o descargue los materiales sexualmente explÃ­citos;\r\nâ€¢ Yo soy el Ãºnico responsable de cualquier revelaciÃ³n o ramificaciones legales de ver, leer o descargar cualquier material que aparezca en este sitio. TambiÃ©n estoy de acuerdo que ni este sitio ni sus filiales serÃ¡n responsables por cualquier ramificaciÃ³n legal que surjan de cualquier entrada fraudulenta en o el uso de este sitio web;\r\nâ€¢ Entiendo que mi uso de este sitio web se rige por TÃ©rminos del sitio web que he revisado y aceptado, y yo estoy de acuerdo en estar obligado por estos TÃ©rminos.\r\nâ€¢ Estoy de acuerdo que al entrar en este sitio web, me estoy sometiendo a mÃ­ mismo, y cualquier entidad en la que tengo algÃºn interÃ©s legal o equitativo, a la jurisdicciÃ³n Europea, si surgiera cualquier disputa en cualquier momento entre este sitio web, yo y / o tal entidad;\r\nâ€¢ Esta pÃ¡gina de advertencia constituye un acuerdo legalmente vinculante entre yo, este sitio web y / o cualquier negocio en el que tengo algÃºn interÃ©s legal o equitativo. Si alguna disposiciÃ³n de este Acuerdo se encuentra que es inaplicable, el resto se harÃ¡ cumplir la medida de lo posible y la disposiciÃ³n inaplicable se considerarÃ¡ modificada a la limitada medida necesaria para permitir su aplicaciÃ³n de manera que representa mÃ¡s de cerca las intenciones expresadas en el presente documento;\r\nâ€¢ Todos los artistas en este sitio son mayores de 18 aÃ±os, han consentido ser fotografiado y / o filmado, creen que es su derecho a participar en actos sexuales consensuales para el entretenimiento y la educaciÃ³n de otros adultos y creo que es mi derecho como adulto para verlos hacer lo que hacen los adultos;\r\nâ€¢ Los vÃ­deos y las imÃ¡genes de este sitio estÃ¡n destinados a ser utilizados por adultos responsables como ayudas sexuales, para proporcionar educaciÃ³n sexual y para proporcionar entretenimiento sexual;\r\nâ€¢ Entiendo que proveer una declaraciÃ³n falsa bajo pena de perjurio es un delito penal; y\r\nâ€¢ Estoy de acuerdo en que este acuerdo se rige por la Ley de Firmas ElectrÃ³nicas en el Comercio Global y Nacional (comÃºnmente conocido como el "E-Sign Act"), 15 USC Â§ 7000, et seq., Y por la elecciÃ³n de hacer clic en "Acepto." indica mi aceptaciÃ³n a estar obligado por los tÃ©rminos de este acuerdo, yo afirmativamente adopto la lÃ­nea de firma abajo como mi firma y la manifestaciÃ³n de mi consentimiento en obligarse por los tÃ©rminos de este acuerdo.\r\n\r\nEn Ã©sta web se coopera activamente con la aplicaciÃ³n de la ley y supuestos casos de sospecha de uso ilegal del servicio, en especial en el uso ilegal del servicio por menores de edad.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ultima_entrada`
--

CREATE TABLE IF NOT EXISTS `ultima_entrada` (
  `entrada` date NOT NULL,
  `remoto` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  PRIMARY KEY (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ultima_entrada`
--

INSERT INTO `ultima_entrada` (`entrada`, `remoto`, `usuario`, `correo`) VALUES
('2015-10-27', '90.69.133.201', 'lb123456', 'directer.murcia@hotmail.com'),
('2015-12-04', '83.231.68.86', 'lb12345', 'fjmeres@hotmail.com'),
('2015-11-16', '83.231.68.86', 'lb123', 'franenalicante@hotmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
