-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 06, 2019 at 08:55 PM
-- Server version: 5.7.23-log
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `podstanarodavac`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `IDK` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(45) DEFAULT NULL,
  `Prezime` varchar(45) DEFAULT NULL,
  `Mail` varchar(45) DEFAULT NULL,
  `Lozinka` varchar(45) DEFAULT NULL,
  `JMBG` varchar(45) DEFAULT NULL,
  `BrojTelefona` varchar(45) DEFAULT NULL,
  `Adresa` varchar(45) DEFAULT NULL,
  `Tip` varchar(1) DEFAULT NULL,
  `Pol` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`IDK`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`IDK`, `Ime`, `Prezime`, `Mail`, `Lozinka`, `JMBG`, `BrojTelefona`, `Adresa`, `Tip`, `Pol`) VALUES
(1, 'Nikola', 'Dimitrijević', 'alokindimitrijevic@gmail.com', '7890', '1912997750015', '0604191299', 'Kladovska 4 11000 Beograd', 'S', 'M'),
(2, 'Podstanar', 'Podstanaric', 'podstanar@gmail.com', 'podstanar', '1111111111111', '061111111', 'Podstanara 1 11111 Beograd', 'P', 'M'),
(4, 'Podstanar 1', 'Podstanaric 1', 'podstanar1@gmail.com', 'podstanar1', '1111111111111', '06398762', 'Podstanara 1 11000 Beograd', 'P', 'M'),
(6, 'Stanodavac 1', 'Stanodavcic 1', 'stanodavac@gmail.com', 'stanodavac', '1111111111112', '064512682', 'Stanodavca 1 11111 Beograd', 'S', 'M'),
(7, 'Petra', 'Petrovic', 'petrapetrovic123@gmail.com', 'petra', '1234567890123', '06012345', 'Vojvode Stepe 11000 Beograd', 'S', 'Z'),
(8, 'Ivana', 'Ivanovic', 'ivanaivanovic456@gmail.com', 'ivana', '0987654321987', '06624367', 'Bulevar Peka Dapcevica 11000 Beograd', 'P', 'Z');

-- --------------------------------------------------------

--
-- Table structure for table `kvar`
--

DROP TABLE IF EXISTS `kvar`;
CREATE TABLE IF NOT EXISTS `kvar` (
  `IDKvar` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(18) DEFAULT NULL,
  `Opis` varchar(100) DEFAULT NULL,
  `IDVlasnika` int(11) NOT NULL,
  `IDStanara` int(11) NOT NULL,
  PRIMARY KEY (`IDKvar`),
  KEY `fk_Kvar_Korisnik1_idx` (`IDVlasnika`),
  KEY `fk_Kvar_Korisnik2_idx` (`IDStanara`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kvar`
--

INSERT INTO `kvar` (`IDKvar`, `Naslov`, `Opis`, `IDVlasnika`, `IDStanara`) VALUES
(4, 'Kvar Bojler', 'Bojler curi.', 1, 2),
(5, 'Kvar Frizider', 'Frizider jako lose hladi', 1, 2),
(6, 'Kvar Net', 'Internet previse baguje', 7, 8),
(7, 'Kvar Ves Masina', 'Ves masina je odjednom prestala da radi', 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `obavestenje_opomena`
--

DROP TABLE IF EXISTS `obavestenje_opomena`;
CREATE TABLE IF NOT EXISTS `obavestenje_opomena` (
  `IDO` int(11) NOT NULL AUTO_INCREMENT,
  `IDVlasnika` int(11) NOT NULL,
  `IDStanara` int(11) NOT NULL,
  `Naslov` varchar(18) DEFAULT NULL,
  `Tekst` varchar(100) DEFAULT NULL,
  `Vrsta` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`IDO`,`IDVlasnika`,`IDStanara`),
  KEY `fk_Obavestenje_opomena_Korisnik1_idx` (`IDVlasnika`),
  KEY `fk_Obavestenje_opomena_Korisnik2_idx` (`IDStanara`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obavestenje_opomena`
--

INSERT INTO `obavestenje_opomena` (`IDO`, `IDVlasnika`, `IDStanara`, `Naslov`, `Tekst`, `Vrsta`) VALUES
(6, 1, 2, '29. Novembra 26', 'Tekst', 'Obaveštenje'),
(9, 7, 8, 'Poslednja opomena', 'Previse stanara u zgradi se zali na lavez vaseg psa. Prete pozivom komunalne policije.', 'Opomena');

-- --------------------------------------------------------

--
-- Table structure for table `oglasna_tabla`
--

DROP TABLE IF EXISTS `oglasna_tabla`;
CREATE TABLE IF NOT EXISTS `oglasna_tabla` (
  `IDO` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(18) DEFAULT NULL,
  `Tekst` varchar(108) DEFAULT NULL,
  `IDVlasnika` int(11) NOT NULL,
  PRIMARY KEY (`IDO`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oglasna_tabla`
--

INSERT INTO `oglasna_tabla` (`IDO`, `Naslov`, `Tekst`, `IDVlasnika`) VALUES
(7, 'Objava', 'Vau ovo radi', 1),
(11, 'Sastanak', 'Odrzace se u 15h 20.07.2019', 7);

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

DROP TABLE IF EXISTS `racun`;
CREATE TABLE IF NOT EXISTS `racun` (
  `IDR` int(11) NOT NULL AUTO_INCREMENT,
  `SvrhaUplate` varchar(40) DEFAULT NULL,
  `PozivNaBroj` varchar(18) DEFAULT NULL,
  `ZiroRacun` varchar(30) DEFAULT NULL,
  `Iznos` int(11) DEFAULT NULL,
  `IDVlasnika` int(11) NOT NULL,
  `IDStanara` int(11) NOT NULL,
  `Placen` tinyint(4) NOT NULL,
  PRIMARY KEY (`IDR`),
  KEY `fk_Racun_Korisnik1_idx` (`IDVlasnika`),
  KEY `fk_Racun_Korisnik2_idx` (`IDStanara`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`IDR`, `SvrhaUplate`, `PozivNaBroj`, `ZiroRacun`, `Iznos`, `IDVlasnika`, `IDStanara`, `Placen`) VALUES
(4, 'Svrha', '123', '123456', 1000, 1, 1, 1),
(7, 'Internet jul', '97', '123456', 1500, 1, 2, 1),
(8, 'Struja jul', '123', '123456', 5000, 1, 2, 0),
(9, 'Infostan jul', '97', '7089567', 3000, 1, 2, 1),
(10, 'Telefon jun', '123', '76543223', 800, 7, 8, 0),
(11, 'Kablovska jun', '97', '234568765', 1200, 7, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zakup`
--

DROP TABLE IF EXISTS `zakup`;
CREATE TABLE IF NOT EXISTS `zakup` (
  `IDZ` int(11) NOT NULL AUTO_INCREMENT,
  `IDVlasnika` int(11) NOT NULL,
  `IDStanara` int(11) NOT NULL,
  `AdresaStana` varchar(45) DEFAULT NULL,
  `Kirija` int(11) DEFAULT NULL,
  `TrajanjeZakupa` int(11) DEFAULT NULL,
  `DatumPocetkaZakupa` datetime DEFAULT NULL,
  `Kvadratura` int(11) DEFAULT NULL,
  `Prihvacen` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`IDZ`,`IDVlasnika`,`IDStanara`),
  KEY `fk_Zakup_Korisnik1_idx` (`IDVlasnika`),
  KEY `fk_Zakup_Korisnik2_idx` (`IDStanara`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zakup`
--

INSERT INTO `zakup` (`IDZ`, `IDVlasnika`, `IDStanara`, `AdresaStana`, `Kirija`, `TrajanjeZakupa`, `DatumPocetkaZakupa`, `Kvadratura`, `Prihvacen`) VALUES
(0, 1, 1, 'Kladovska 4 11000 Beograd', 8000, 12, '2019-05-15 00:00:00', 50, 0),
(5, 1, 2, 'Podstanara', 8000, 12, '2019-06-12 00:00:00', 50, 1),
(6, 6, 4, 'Adresa Stana', 5000, 13, '2019-06-11 00:00:00', 30, 0),
(7, 7, 8, 'Nova Ulica', 20000, 13, '2019-06-11 00:00:00', 60, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kvar`
--
ALTER TABLE `kvar`
  ADD CONSTRAINT `fk_Kvar_Korisnik1` FOREIGN KEY (`IDVlasnika`) REFERENCES `korisnik` (`IDK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Kvar_Korisnik2` FOREIGN KEY (`IDStanara`) REFERENCES `korisnik` (`IDK`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `obavestenje_opomena`
--
ALTER TABLE `obavestenje_opomena`
  ADD CONSTRAINT `fk_Obavestenje_opomena_Korisnik1` FOREIGN KEY (`IDVlasnika`) REFERENCES `korisnik` (`IDK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Obavestenje_opomena_Korisnik2` FOREIGN KEY (`IDStanara`) REFERENCES `korisnik` (`IDK`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `fk_Racun_Korisnik1` FOREIGN KEY (`IDVlasnika`) REFERENCES `korisnik` (`IDK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Racun_Korisnik2` FOREIGN KEY (`IDStanara`) REFERENCES `korisnik` (`IDK`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zakup`
--
ALTER TABLE `zakup`
  ADD CONSTRAINT `fk_Zakup_Korisnik1` FOREIGN KEY (`IDVlasnika`) REFERENCES `korisnik` (`IDK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Zakup_Korisnik2` FOREIGN KEY (`IDStanara`) REFERENCES `korisnik` (`IDK`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
