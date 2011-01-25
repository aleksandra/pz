-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 25 Sty 2011, 22:49
-- Wersja serwera: 5.1.41
-- Wersja PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `portal`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `branza`
--

CREATE TABLE IF NOT EXISTS `branza` (
  `branza_id` int(11) NOT NULL AUTO_INCREMENT,
  `branza_nazwa` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`branza_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `branza`
--

INSERT INTO `branza` (`branza_id`, `branza_nazwa`) VALUES
(1, 'Gastronomia'),
(2, 'IT'),
(3, 'Handel'),
(4, 'Szkolnictwo'),
(5, ' Inna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `dane`
--

CREATE TABLE IF NOT EXISTS `dane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `typ` char(1) COLLATE utf8_polish_ci NOT NULL,
  `aktywacja` int(11) NOT NULL DEFAULT '0',
  `klucz` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=59 ;

--
-- Zrzut danych tabeli `dane`
--

INSERT INTO `dane` (`id`, `login`, `haslo`, `typ`, `aktywacja`, `klucz`) VALUES
(1, 'ola', '793f970c52ded1276b9264c742f19d1888cbaf73', 'p', 1, ''),
(36, 'marcin', '75d547cc96937d13b87cf614e50d1ea059d60c0a', 'f', 1, ''),
(37, 'a', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'p', 1, ''),
(38, 'firma', '9841bfecf0955a4b53640f66d15042e11726c8ab', 'f', 1, ''),
(39, 'ala', 'c6a378510e0ec1d7809694ebf1d5579f37b1642e', 'p', 1, ''),
(49, 'z', '395df8f7c51f007019cb30201c49e884b46b92fa', 'p', 0, ''),
(50, 'p', '7ed324d086550f729f49599c5d6250911b68dafb', 'p', 0, ''),
(58, 'q', 'c6efae9869218c6d45b92a3090bce129f27c070d', 'p', 1, '64365');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `dodatkowe`
--

CREATE TABLE IF NOT EXISTS `dodatkowe` (
  `id` int(11) NOT NULL,
  `pracownik_id` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dodatkowe`
--

INSERT INTO `dodatkowe` (`id`, `pracownik_id`, `nazwa`) VALUES
(1, 1, ''),
(4, 1, 'cocococo'),
(3, 1, 'prawo jazdy kat. B'),
(2, 1, 'zzz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `doswiadczenie`
--

CREATE TABLE IF NOT EXISTS `doswiadczenie` (
  `id` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `od` varchar(20) NOT NULL,
  `do` varchar(20) NOT NULL,
  `gdzie` varchar(150) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`,`id_pracownika`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `doswiadczenie`
--

INSERT INTO `doswiadczenie` (`id`, `id_pracownika`, `od`, `do`, `gdzie`) VALUES
(1, 1, '2009-12', '2010-01', 'inny sklep'),
(2, 1, '2008-02', '2008-03', 'Praktyka studencka w firmie handlowej na stanowisku praktykanta'),
(3, 1, '', '', ''),
(4, 1, '2010-01', '2010-02', 'Praca w firmie handlowej jako przedstawiciel handlowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `firma`
--

CREATE TABLE IF NOT EXISTS `firma` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dolaczyl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adres` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `tel` varchar(10) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `branza` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `zdjecie` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `firma`
--

INSERT INTO `firma` (`id`, `nazwa`, `email`, `dolaczyl`, `adres`, `tel`, `branza`, `opis`, `zdjecie`) VALUES
(36, 'woodwaizer', 'cinoslaw_87@interia.pl', '2010-12-03 16:05:07', NULL, NULL, NULL, NULL, NULL),
(38, 'Firma', 'firma@firma.pl', '2011-01-16 17:07:35', 'Wejherowo', '123123123', NULL, ' Nasza firma jest super!     ', 'zdjecia/1295800973zarzadz.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `jezyki`
--

CREATE TABLE IF NOT EXISTS `jezyki` (
  `pracownik_id` int(11) NOT NULL,
  `jezyk_id` int(11) NOT NULL,
  `poziom_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `jezyki`
--

INSERT INTO `jezyki` (`pracownik_id`, `jezyk_id`, `poziom_id`) VALUES
(1, 5, 4),
(1, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `jezyki_lista`
--

CREATE TABLE IF NOT EXISTS `jezyki_lista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `jezyki_lista`
--

INSERT INTO `jezyki_lista` (`id`, `nazwa`) VALUES
(1, 'angielski'),
(2, 'niemiecki'),
(3, 'francuski'),
(4, 'hiszpaÅ„ski'),
(5, 'wÅ‚oski'),
(6, 'rosyjski');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `jezyki_poziom`
--

CREATE TABLE IF NOT EXISTS `jezyki_poziom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `jezyki_poziom`
--

INSERT INTO `jezyki_poziom` (`id`, `nazwa`) VALUES
(2, 'biegle'),
(3, 'komunikatywnie'),
(4, 'podstawy'),
(1, 'brak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `odp`
--

CREATE TABLE IF NOT EXISTS `odp` (
  `ogl_id` int(11) NOT NULL,
  `pracownik_id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `odp`
--

INSERT INTO `odp` (`ogl_id`, `pracownik_id`, `data`) VALUES
(9, 1, '2011-01-17 22:00:09'),
(10, 1, '2011-01-17 21:53:33'),
(10, 39, '2011-01-18 00:23:22'),
(14, 1, '2011-01-20 12:55:10'),
(21, 1, '2011-01-23 18:27:07'),
(21, 50, '2011-01-25 02:27:36');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `ogloszenie`
--

CREATE TABLE IF NOT EXISTS `ogloszenie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_firmy` int(11) NOT NULL,
  `branza_id` int(20) NOT NULL,
  `tresc` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
  `dodano` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Zrzut danych tabeli `ogloszenie`
--

INSERT INTO `ogloszenie` (`id`, `id_firmy`, `branza_id`, `tresc`, `dodano`) VALUES
(9, 38, 3, 'Szukam sprzedawcy .', '2011-01-17 20:45:27'),
(20, 38, 4, 'Nauczyciel pilnie potrzebny!!!', '2011-01-23 18:25:21'),
(12, 36, 3, '!!!', '2011-01-19 19:15:04'),
(21, 38, 1, 'PoszukujÄ™ kucharza do nowej restauracji.', '2011-01-23 18:25:41'),
(22, 38, 3, 'Przedstawiciel handlowy.\r\nWymagane doswiadczenie w branzy min. 3 lata.', '2011-01-25 14:35:08'),
(23, 36, 1, 'PoszukujÄ™ 3 kelnerek do baru na sezon.', '2011-01-25 14:35:08'),
(66, 36, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:44:02'),
(65, 38, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:58'),
(64, 36, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:58'),
(63, 38, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:55'),
(62, 36, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:55'),
(61, 38, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:48'),
(60, 36, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:48'),
(59, 38, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:41'),
(58, 36, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:41'),
(57, 38, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:35'),
(56, 36, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:35'),
(55, 38, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:31'),
(54, 36, 5, 'PoszukujÄ™ 3 pracownika.', '2011-01-25 14:43:31'),
(68, 36, 5, 'PoszukujÄ™ 3 pracownika.11', '2011-01-25 14:44:05'),
(67, 38, 5, 'PoszukujÄ™ 3 pracownika.10', '2011-01-25 14:44:02'),
(69, 38, 5, 'PoszukujÄ™ 3 pracownika.999', '2011-01-25 14:44:05'),
(70, 36, 5, 'PoszukujÄ™  pracownika.888', '2011-01-25 14:44:33'),
(71, 38, 5, 'PoszukujÄ™  pracownika.777', '2011-01-25 14:44:33'),
(72, 36, 5, 'PoszukujÄ™  pracownika.666', '2011-01-25 14:44:35'),
(73, 38, 5, 'PoszukujÄ™  pracownika.555', '2011-01-25 14:44:35'),
(74, 36, 5, 'PoszukujÄ™  pracownika.444', '2011-01-25 14:44:37'),
(75, 38, 5, 'PoszukujÄ™  pracownika.333', '2011-01-25 14:44:37'),
(76, 36, 5, 'PoszukujÄ™  pracownika.22', '2011-01-25 14:44:40'),
(77, 38, 5, 'PoszukujÄ™  pracownika.111', '2011-01-25 14:44:40'),
(78, 36, 5, 'PoszukujÄ™  pracownika.', '2011-01-25 14:44:42'),
(79, 38, 5, 'PoszukujÄ™  pracownika.', '2011-01-25 14:44:42'),
(80, 36, 5, 'PoszukujÄ™  pracownika.', '2011-01-25 14:44:57'),
(81, 38, 5, 'PoszukujÄ™  pracownika.pierwsze', '2011-01-25 14:44:57'),
(82, 38, 5, 'praca w ameryce.', '2011-01-25 22:16:32'),
(83, 38, 5, 'super praca', '2011-01-25 22:16:32'),
(84, 38, 5, 'praca w ameryce.', '2011-01-25 22:16:36'),
(85, 38, 5, 'super praca', '2011-01-25 22:16:36');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pracownik`
--

CREATE TABLE IF NOT EXISTS `pracownik` (
  `id` int(11) NOT NULL,
  `imie` varchar(30) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dolaczyl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_ur` date DEFAULT NULL,
  `miejsce_ur` varchar(20) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `adres` varchar(50) DEFAULT NULL,
  `stan_cywilny` varchar(10) DEFAULT NULL,
  `zdjecie` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `pracownik`
--

INSERT INTO `pracownik` (`id`, `imie`, `nazwisko`, `email`, `dolaczyl`, `data_ur`, `miejsce_ur`, `tel`, `adres`, `stan_cywilny`, `zdjecie`) VALUES
(1, 'Aleksandra Joanna', 'Bucior', 'ooleczka@o2.pl', '2010-12-02 22:37:12', '1988-08-18', 'Wejherowo', '505933178', '', 'panna', 'zdjecia/1295463004ja.jpg'),
(37, 'a', 'a', 'a', '2010-12-04 13:31:13', NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'ala', 'ala', 'ala@ala.pl', '2011-01-18 00:22:16', NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Aleksandra', 'Bucior', 'ooleczka@o2.pl', '2011-01-25 20:16:25', NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Pola', 'Bucio', 'ala@ala.pl', '2011-01-25 02:27:25', NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'z', 'z', 'z', '2011-01-23 21:22:11', NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Aleksandra', 'Bucior', 'ooleczka@o2.pl', '2011-01-25 20:18:05', NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Aleksandra', 'Bucior', 'ooleczka@o2.pl', '2011-01-25 20:21:23', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Aleksandra', 'Bucior', 'ooleczka@o2.pl', '2011-01-25 20:31:17', NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Aleksandra', 'Bucior', 'ooleczka@o2.pl', '2011-01-25 20:38:05', NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'Aleksandra', 'Bucior', 'ooleczka@o2.pl', '2011-01-25 20:48:51', NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'Aleksandra', 'Bucior', 'ooleczka@o2.pl', '2011-01-25 20:50:54', NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'Aleksandra', 'Bucior', 'ooleczka@o2.pl', '2011-01-25 20:54:53', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `wyksztalcenie`
--

CREATE TABLE IF NOT EXISTS `wyksztalcenie` (
  `id` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `od` varchar(20) NOT NULL,
  `do` varchar(20) NOT NULL,
  `gdzie` varchar(150) NOT NULL,
  PRIMARY KEY (`id`,`id_pracownika`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `wyksztalcenie`
--

INSERT INTO `wyksztalcenie` (`id`, `id_pracownika`, `od`, `do`, `gdzie`) VALUES
(1, 1, '2006-10', '2009-05', 'Uniwersytet GdaÅ„ski, ZarzÄ…dzanie'),
(2, 1, '', '', ''),
(3, 1, '2010-01', '2010-02', 'Studia Podyplomowe, ZarzÄ…dzanie zasobami ludzkimi'),
(1, 2, '2009', '2010', 'szkla'),
(4, 1, '', '', ''),
(5, 1, '2000-09', '2006-06', 'Liceum OgÃ³lnoksztaÅ‚cÄ…ce im. KogoÅ› w Wejherowie');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
