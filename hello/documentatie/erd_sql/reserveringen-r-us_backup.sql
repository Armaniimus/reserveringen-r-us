-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 03 dec 2018 om 22:35
-- Serverversie: 5.7.24
-- PHP-versie: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reserveringen-r-us`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestellingID` int(10) UNSIGNED NOT NULL,
  `reserveringenID` int(10) UNSIGNED NOT NULL,
  `tafelnummer` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `tijd` time DEFAULT NULL,
  `menu item code` int(11) DEFAULT NULL,
  `aantal` int(11) DEFAULT NULL,
  `prijs` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`bestellingID`, `reserveringenID`, `tafelnummer`, `datum`, `tijd`, `menu item code`, `aantal`, `prijs`) VALUES
(1, 4, 3, '1945-12-01', '15:00:00', 2, 1, '19.95'),
(2, 7, 4, '1946-07-10', '11:00:00', 5, 1, '1.95'),
(3, 2, 1, '1947-02-10', '19:00:00', 9, 3, '2.99'),
(4, 1, 0, '1948-05-10', '17:00:00', 1, 2, '0.10'),
(5, 5, 4, '2016-03-29', '22:01:00', 3, 4, '1.94'),
(6, 5, 4, '2017-02-28', '23:01:00', 99, 99, '6.66');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cat`
--

CREATE TABLE `cat` (
  `cat_code` varchar(10) NOT NULL,
  `cat_naam` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `cat`
--

INSERT INTO `cat` (`cat_code`, `cat_naam`) VALUES
('HOG', 'Hoofdgerechten'),
('NAG', 'Nagerechten'),
('VOG', 'Voorgerechten');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menuitem`
--

CREATE TABLE `menuitem` (
  `item_code` int(11) NOT NULL,
  `subcat_code` varchar(10) DEFAULT NULL,
  `prijs` decimal(5,2) DEFAULT NULL,
  `naam` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `menuitem`
--

INSERT INTO `menuitem` (`item_code`, `subcat_code`, `prijs`, `naam`) VALUES
(1, 'os', '19.50', 'lasagne'),
(2, 'os', '21.40', 'mousaka'),
(3, 'vl-g', '15.50', 'biefstuk met champions en sla'),
(4, 'vl-g', '12.50', 'spareribs met friet'),
(5, 'vi-g', '17.00', 'makreel met friet'),
(6, 'vi-g', '26.00', 'kreeft met salade'),
(7, 'i', '9.50', 'vanille ijs met chocolade saus'),
(8, 'gbk', '15.00', 'appeltaart');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveringen`
--

CREATE TABLE `reserveringen` (
  `reserveringenID` int(10) UNSIGNED NOT NULL,
  `tafelnummer` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `tijd` time DEFAULT NULL,
  `klant voornaam` varchar(70) DEFAULT NULL,
  `klant achternaam` varchar(70) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `datum van toevoegen` date DEFAULT NULL,
  `aantal kinderen` int(11) DEFAULT NULL,
  `aantal totaal` int(11) DEFAULT NULL,
  `allergieen` varchar(45) DEFAULT NULL,
  `opmerkingen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `reserveringen`
--

INSERT INTO `reserveringen` (`reserveringenID`, `tafelnummer`, `datum`, `tijd`, `klant voornaam`, `klant achternaam`, `status`, `datum van toevoegen`, `aantal kinderen`, `aantal totaal`, `allergieen`, `opmerkingen`) VALUES
(1, 1, '2018-12-01', '15:00:00', 'alex', 'is gay lmao', 'gay', '1980-05-07', 15, 25, '', ''),
(2, 34, '1980-07-10', '111:00:00', 'struik', 'rover', 'in behandeling', '1980-04-07', 15, 25, '', ''),
(3, 65, '1980-02-10', '19:00:00', 'struik', 'rover', 'in behandeling', '1980-03-07', 15, 25, '', ''),
(4, 4, '1980-05-10', '17:00:00', 'struik', 'rover', 'in behandeling', '1980-05-07', 15, 25, '', ''),
(5, 4, '2018-12-04', '00:00:00', 'Alex', 'yohanes', 'ok', '2018-12-04', 18, 19, 'nee', 'heel veel'),
(6, -1, '2018-12-01', '23:59:00', 'alex', 'yohanes', 'in behandeling', '2018-12-01', 2, 1, '-', '-');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subcat`
--

CREATE TABLE `subcat` (
  `subcat_code` varchar(10) NOT NULL,
  `cat_code` varchar(10) DEFAULT NULL,
  `cat_naam` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `subcat`
--

INSERT INTO `subcat` (`subcat_code`, `cat_code`, `cat_naam`) VALUES
('kv-g', 'VOG', 'koude voorgerechten'),
('os', 'HOG', 'ovenschotels'),
('vi-g', 'HOG', 'vis gerechten'),
('vl-g', 'HOG', 'vlees gerechten'),
('wv-g', 'VOG', 'warme voorgerechten');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestellingID`),
  ADD UNIQUE KEY `bestellingID_UNIQUE` (`bestellingID`),
  ADD KEY `fk_Bestellingen_Reserveringen_idx` (`reserveringenID`);

--
-- Indexen voor tabel `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`cat_code`),
  ADD UNIQUE KEY `cat_code` (`cat_code`);

--
-- Indexen voor tabel `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`item_code`),
  ADD UNIQUE KEY `item_code` (`item_code`);

--
-- Indexen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD PRIMARY KEY (`reserveringenID`),
  ADD UNIQUE KEY `reserveringenID_UNIQUE` (`reserveringenID`);

--
-- Indexen voor tabel `subcat`
--
ALTER TABLE `subcat`
  ADD PRIMARY KEY (`subcat_code`),
  ADD UNIQUE KEY `subcat_code` (`subcat_code`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestellingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `item_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  MODIFY `reserveringenID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `fk_Bestellingen_Reserveringen` FOREIGN KEY (`reserveringenID`) REFERENCES `reserveringen` (`reserveringenID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
