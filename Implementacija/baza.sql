-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2020 at 11:29 PM
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
CREATE DATABASE IF NOT EXISTS `baza` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `ime`, `prezime`, `sifra`, `admin`, `ocena`) VALUES
(18, 'admin', 'Admin', 'Adminić', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '1', '0.00'),
(19, 'jole', 'Jovana', 'Kitanović', '1e91b7929b9d382118f687492da3fb64e4017b8b20fc573bcba98f825d9f632f6bc3751bf6c250a234637bc56c7e8f575c4ee9333ac26f9522d0015f969b3683', '0', '4.50'),
(20, 'knezluka', 'Luka', 'Knežević', '809f321e676777da6a5caabb6294d47a8188947c57558c3fda4d405c5a9e785bdc6daa8a70dff6f014c7df6c7901988b7143a8493408e0b222238c25e1f21565', '0', '5.00'),
(21, 'maja', 'Maja', 'Ličina', 'e3080019ea5db0aa55c8f23b8b145a3e4ec20fccd8dcba1e2d73ae4046e4a4780c669e4a31f451ada7222630eda785de53e208573c333d002520004a4f39894e', '0', '1.50'),
(22, 'jovanka', 'jovanka', 'kitanovic', '493a48b86c2671e2805ce3578c2fdba33be5c199d4e951d7189c468b4db4354a56d21f14205381738e0c6e31ff4ff65d4924121cf27f1245048289f35adae180', '0', '0.00'),
(23, 'vesna', 'vesna', 'vesna', '90ab6128f7fb586475f1cc416abab2b97c3a37fcb824ff0c6241e214164c54c0fb20f8b3ca8dee790f74c7442da02aefcddd18100f10de5950194ae7767c55e0', '0', '4.00'),
(24, 'luka', 'luka', 'luka', '35c5a8409e42386fd692d5ab1d1edc161939471b0aab88c8e47a6bbf3deffac813eb6a0c58531e7961556798de07cbb83becd3f168d90e35d9c313b5ff99898e', '0', '2.00'),
(25, 'ana', 'ana', 'ana', '40c41475561375aa28d4d035445525f0e8f6bfaba1fdb4bc0c30dec2de112d7c7df168bdced38b4d87326b4c3f226c2ba1a09f4384451b0bc5f9c108c1c1df32', '0', '4.00'),
(28, 'petrija', 'petrija', 'petrija', 'e3e34781ee201b7a935a24eeff9bff4d933cdcd6841d81dfe927bbd0a56e81e898a05efc3aa79dca6e9cc0ad4b4d45649647807860738a6b88ff16d70b18ec31', '0', '2.89'),
(29, 'ema', 'emilija', 'radivojevic', '9a3e5184a08be8ca366af77bd2f9a53fd950239f9bcd6f13212f30bedf39b95de2e8b46c412554885393c621718572a7cabb23f44a1d4f6e38d13577bd8384d9', '0', '3.67');

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
(25, 133),
(28, 133),
(25, 135),
(28, 135),
(25, 136),
(28, 136);

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
(25, 135),
(28, 135),
(28, 137);

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
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recepti`
--

INSERT INTO `recepti` (`id`, `slika`, `sastojci`, `priprema`, `k1`, `k2`, `k3`, `autor`, `ime`, `ocena`, `brocena`) VALUES
(133, 'uploads/pile-of-chocolate-chip-cookies_GJkZuoRO-e1478622720654.jpg', '250 g brasna\r\n20 g kakaoa\r\n125 g secera\r\n125 g margarina\r\n1 mala kasika p.za pecivo (5 g)\r\nribana kora narandze (5 g)\r\n1 jaje (55 g)\r\n50 g coko komadica\r\n15 g meda\r\ni jos + 20 g coko komadica za preko', '1.\r\nPripremiti pleh oblozen papirom za pecenje.\r\n\r\nUkljuciti pecnicu da se zagrije na200 °C.\r\n\r\n2.\r\nBrasno,kakao,prasak za pecivo,secer,malo soli,buter u komadicima,jaje,koru narandze prvo kratko sa spiralama na mikseru izmjesti,pa onda dodati 50 g coko komadica i sa rukama izraditi toliko dugo da se fino sjedini.\r\n\r\n3.\r\nOd tjesta oblikovati 20-24 okrugla keksa,koje prvo u kuglu valjate izmedju dlanova,pa lafgano pritisnete izmedju dlanova.\r\n\r\nStavljati ih na pleh,preko raspodjeliti coko komadice,malo ih priteci,da se bolje sljepe.\r\n\r\n4.\r\nPeci kekse 15 minuta.\r\n\r\nNakon pecenja pustiti ih na plehu da se ohlade.', '0', '1', '0', 19, 'čokoladni kolačići', 9, 2),
(135, 'uploads/kilice.jpg', '1 kg brašna 1/2 l vode 1 kocka kvasca 1 supena kašika soli 1 supena kašika šećera 2 dl ulja za fil: 1 manji praziluk 400 g mlevenog mesa', 'Za fil: Praziluk isecite na sitno, pa ga prodinstajte na malo ulja. Dodajte mleveno meso, začinite po ukusu i propržite. Kvasac izmrvite u brašno, dodajte vodu, ulje, so i šećer. Umesite testo.Razvucite ga u duguljastu formu, pa ga secite na kolutove kao rolat. Od svakog koluta formirajte kuglice veličine nešto veće od oraha. Svaku kuglice rastanjite, pospite malo mlevenog mesa pa urolajte u kiflicu. Ređajte u pleh obložen papirom za pečenje, pa ostavite da narastaju oko 30 minuta. Nakon toga stavite u rernu i pecite 40 minuta na 200 stepeni. Kada su pečene na tihoj vatri rastopite margarin i njime prelijte vruće kiflice.', '1', '0', '1', 21, 'kiflice sa mesom', 3, 2),
(136, 'uploads/sarma-rolnice.jpg', '500 g mešanog mlevenog mesa\r\n2 glavice crnog luka\r\n2 čena belog luka\r\n1 šargarepa\r\n100 g pirinča\r\n1 i po kašika začinske paprike\r\n10 bibera u zrnu\r\n½ kašičice mlevenog bibera\r\nso\r\n3 lovorova lista\r\n200 ml ulja\r\n200 g mesnate slanine\r\nglavica kiselog kupusa', 'Na ulju propržite iseckan crni i beli luk i rendanu šargarepu. Kada povrće bude uprženo, dodajte meso, polovinu slanine iseckanu na kockice i propržite. Začinite solju i mlevenim biberom i dodajte pirinač i pola kašike začinske paprike. Sve dobro promešajte i po kašiku fila stavljajte na list kupusa i uvijte sarmu . Birajte manje glavice kupusa da bi i listovi bili manji i sarma lepše izgledala.\r\nNa dno dubljeg suda stavite malo kupusa, a zatim ređajte sarme. Kada sve složite,  preostalu slaninu stavite preko sarme.\r\n\r\nKašiku začinske paprike, biber u zrnu i lovor stavite preko sarme. Pokrijte listovima kupusa i nalijte vodom da pređe preko sarme oko 2 prsta. Stavite poklopac i ostavite da provri, a zatim smanjite temperature i lagano krčkajte 3-4 sata.\r\n\r\nNapomena: Listove kupusa odvojiti i sa svakog nožem odstraniti zadebljani deo koji  ih vezuje za koren. Listove properite i ostavite da se ocede pre uvijanja sarme.\r\n\r\n', '1', '0', '0', 20, 'Sama', 10, 2),
(137, 'uploads/punjene-paprike.jpg', 'oko 8 kom. babura srednje veličine\r\n500 gr mlevenog mesa, po izboru\r\n100 gr pirinča\r\n1 jaje\r\n1 srednja glavica luka\r\n1 kašikica Vegete Natur\r\n1 kašikica Slatke mlevene crvene paprike Podravka\r\n1 kašikica soli\r\n1/2 kašikice mlevenog bibera\r\n1 kašika seckanog peršunovog lista\r\nSOS:\r\n1 dl suncokretovog ulja\r\n3 kašike Oštrog brašna Podravka\r\n1/2 lit. gustog soka od paradajza\r\n1 1/2 lit. mlake vode\r\n2 kašikice soli\r\n1 kašikica Vegete Natur\r\n1 kašikica slatke mlevene crvene paprike', '1.\r\nPrvo skuvajte sos. U lonac  ( najbolje onaj od 5 lit.) sipajte ulje, malo ga ugrejte, pa dodajte brašno i popržite ga. Dodajte alevu papriku, promešajte i odmah zalijte sa paradajz sokom i vodom. Promešajte da ne bude grudvica, dodajte i ostale začine predviđene za sos (sem peršunovog lista, on je za kraj) i ostavite da provri. Za to vreme napunite paprike babure.\r\n\r\n2.\r\nU mleveno meso dodajte sve sastojke sa spiska, promešajte i napunite izdubljene babure. Ako vam ostane malo nadeva za paprike, napravite od njega kuglice veličine krupnog oraha i ubacite ih u sos zajedno sa paprikama. \r\n\r\n3.\r\nSve zajedno kuvati oko 60 minuta. Na kraju probati da li je dobro začinjeno, popraviti ukus ako treba i posuti peršunovim listom.\r\n\r\n4.\r\nKada sam ranije kuvala punjene paprike, uvek mi je nečega falilo ili sam imala viška :))))) U ovom receptu je sve izbalansirano i nikada ne omanem.', '1', '0', '0', 25, 'punjene paprike', 0, 0);

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
(133, 20),
(133, 25),
(133, 28),
(136, 28),
(135, 29);

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
