-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 08, 2020 at 11:43 PM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza`
--
CREATE DATABASE IF NOT EXISTS `baza` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `baza`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `sifra` varchar(128) NOT NULL,
  `admin` varchar(1) DEFAULT '0',
  `ocena` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `ime`, `prezime`, `sifra`, `admin`, `ocena`) VALUES
(18, 'admin', 'Admin', 'Adminić', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '1', '0.00'),
(19, 'jole', 'Jovana', 'Kitanović', '1e91b7929b9d382118f687492da3fb64e4017b8b20fc573bcba98f825d9f632f6bc3751bf6c250a234637bc56c7e8f575c4ee9333ac26f9522d0015f969b3683', '0', '4.67'),
(20, 'knezluka', 'Luka', 'Knežević', '809f321e676777da6a5caabb6294d47a8188947c57558c3fda4d405c5a9e785bdc6daa8a70dff6f014c7df6c7901988b7143a8493408e0b222238c25e1f21565', '0', '2.00'),
(21, 'maja', 'Maja', 'Ličina', 'e3080019ea5db0aa55c8f23b8b145a3e4ec20fccd8dcba1e2d73ae4046e4a4780c669e4a31f451ada7222630eda785de53e208573c333d002520004a4f39894e', '0', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `korisnikocena`
--

DROP TABLE IF EXISTS `korisnikocena`;
CREATE TABLE IF NOT EXISTS `korisnikocena` (
  `idK` int(11) NOT NULL,
  `idR` int(11) NOT NULL,
  PRIMARY KEY (`idK`,`idR`),
  KEY `fk_idr` (`idR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnikocena`
--

INSERT INTO `korisnikocena` (`idK`, `idR`) VALUES
(20, 101),
(21, 101),
(19, 102),
(19, 103);

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

DROP TABLE IF EXISTS `prijava`;
CREATE TABLE IF NOT EXISTS `prijava` (
  `idK` int(11) NOT NULL,
  `idR` int(11) NOT NULL,
  PRIMARY KEY (`idK`,`idR`),
  KEY `strani_kljuc_idr` (`idR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`idK`, `idR`) VALUES
(19, 101),
(21, 102);

-- --------------------------------------------------------

--
-- Table structure for table `recepti`
--

DROP TABLE IF EXISTS `recepti`;
CREATE TABLE IF NOT EXISTS `recepti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slika` varchar(80) NOT NULL,
  `sastojci` longtext NOT NULL,
  `priprema` longtext NOT NULL,
  `k1` varchar(1) DEFAULT '0',
  `k2` varchar(1) DEFAULT '0',
  `k3` varchar(1) DEFAULT '0',
  `autor` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `ocena` int(11) DEFAULT '0',
  `brocena` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recepti`
--

INSERT INTO `recepti` (`id`, `slika`, `sastojci`, `priprema`, `k1`, `k2`, `k3`, `autor`, `ime`, `ocena`, `brocena`) VALUES
(101, 'uploads/patka.jpg', 'patka, dobra volja, beli luk, senf sa renom', 'uloviti patku, ili je kupiti, iseckati luk, namazati ga senfom sa renom i ponuditi patki. Ako patka prihvati mamac onda ste prijatelji i mozete ga nazvati Perfeks, ako ne pustiti patku na miru.', '1', '0', '0', 19, 'Lepršava patka od Dunava', 10, 2),
(102, 'uploads/bombone.jpg', 'guma, boja', 'Nemojte gubiti vreme praveći, idite u radnju i kupite veeeeeeliko pakoanje (ili ne, OSTANITE KOD KUĆE! )', '0', '1', '0', 20, 'Šarene gumene bombone', 2, 1),
(103, 'uploads/sarma-rolnice.jpg', 'Kupus, meso,začini, baba', 'Otići kod babe u posetu, poneti činiju od sladoleda. Sesti u kuhinju dok baka mota sarme (jer to sigurno radi bolje od vas, tako da samo gledajte i ćutite). Nakon što baka smota sarme, skuvati joj kafu da se okrepi. Kada sarme budu  gotove, uzeti gore navedeni sud i spakovati sarme za poneti.', '1', '0', '0', 19, 'Sarma', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sacuvano`
--

DROP TABLE IF EXISTS `sacuvano`;
CREATE TABLE IF NOT EXISTS `sacuvano` (
  `idR` int(11) NOT NULL,
  `idK` int(11) NOT NULL,
  PRIMARY KEY (`idR`,`idK`),
  KEY `fkidk` (`idK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sacuvano`
--

INSERT INTO `sacuvano` (`idR`, `idK`) VALUES
(102, 19),
(101, 21),
(103, 21);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnikocena`
--
ALTER TABLE `korisnikocena`
  ADD CONSTRAINT `fk_idk` FOREIGN KEY (`idK`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idr` FOREIGN KEY (`idR`) REFERENCES `recepti` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `stani_kljuc_idk` FOREIGN KEY (`idK`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `strani_kljuc_idr` FOREIGN KEY (`idR`) REFERENCES `recepti` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sacuvano`
--
ALTER TABLE `sacuvano`
  ADD CONSTRAINT `fkidk` FOREIGN KEY (`idK`) REFERENCES `korisnik` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkird` FOREIGN KEY (`idR`) REFERENCES `recepti` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
