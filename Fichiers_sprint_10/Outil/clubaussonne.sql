-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--

-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 03 jan. 2022 à 07:12
-- Version du serveur : 8.0.25
-- Version de PHP : 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clubaussonne`
--

-- --------------------------------------------------------

--
-- Table structure for table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `idAdherent` int(11) NOT NULL AUTO_INCREMENT,
  `nomAdherent` char(32) NOT NULL,
  `prenomAdherent` char(32) NOT NULL,
  `ageAdherent` int(11) NOT NULL,
  `sexeAdherent` char(1) NOT NULL,
  `loginAdherent` char(20) NOT NULL,
  `pwdAdherent` varchar(200) NOT NULL,
  PRIMARY KEY (`idAdherent`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adherent`
--

INSERT INTO `adherent` (`idAdherent`, `nomAdherent`, `prenomAdherent`, `ageAdherent`, `sexeAdherent`, `loginAdherent`, `pwdAdherent`) VALUES
(1, 'Duponts', 'Pierreau', 8, 'F', 'pDupont', '382e0360e4eb7b70034fbaa69bec5786'),
(2, 'Dubois', 'Vincent', 10, 'M', 'vDubois', 'b6c7790658f2cabc77cfb445f3530cf4'),
(3, 'Durant', 'Jacques', 6, 'M', 'jDurant', '01e8e31b6f11b0872c662c306b3e87c9'),
(4, 'Fleur', 'Sophie', 7, 'F', 'sFleur', '520a72f041586acdeb770d35388ce6c4'),
(5, 'Seimei', 'Abe', 9, 'M', 'aSeimei', '908d5d34017b9fab73efc1b6869bc4e2'),
(6, 'Kirigaya', 'Kazuto', 11, 'M', 'kKirigaya', '528f44b153731a8f064333058d7e1d44'),
(7, 'abba', 'baab', 8, 'F', 'baaa', '1bd0c1893cb7bcb3ffd191412030ab11'),
(8, 'powder', 'jinx', 7, 'F', 'jinxed', 'a13e586e218c15a6b4539efc69a5c5b7'),
(9, 'neko', 'kuro', 5, 'M', 'kuroneko', '8c44c726c667b712e292e8432cb34caa'),
(10, 'clyde', 'jekyll', 7, 'M', 'clykyll', 'fbb35966823901b1632d42d006bae83c'),
(11, 'undefined', 'steve', 11, 'M', 'steve', 'd69403e2673e611d4cbd3fad6fd1788e'),
(12, 'test12', 'test12', 12, 'M', 'test12', '60474c9c10d7142b7508ce7a50acf414');

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nomAdmin` char(32) NOT NULL,
  `prenomAdmin` char(32) NOT NULL,
  `loginAdmin` char(20) NOT NULL,
  `pwdAdmin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`idAdmin`, `nomAdmin`, `prenomAdmin`, `loginAdmin`, `pwdAdmin`) VALUES
(1, 'LeFirst', 'Vincent', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'LeSecond', 'Pierre', 'admin2', 'c84258e9c39059a89ab77d846ddab909');

-- --------------------------------------------------------

--
-- Table structure for table `entraineur`
--

DROP TABLE IF EXISTS `entraineur`;
CREATE TABLE IF NOT EXISTS `entraineur` (
  `idEntraineur` int(11) NOT NULL AUTO_INCREMENT,
  `nomEntraineur` char(32) NOT NULL,
  `loginEntraineur` char(20) NOT NULL,
  `pwdEntraineur` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idEntraineur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entraineur`
--

INSERT INTO `entraineur` (`idEntraineur`, `nomEntraineur`, `loginEntraineur`, `pwdEntraineur`) VALUES
(1, 'Delbert', 'Delbert', '0b02931216d535031eea687d3b687eea'),
(2, 'Dubois', 'Dubois', '2da1fecc769db814efa8c4568a801ed3'),
(3, 'Bousquet', 'Bousquet', '3938b2f3fd8ef725d61e8f92c7dee52b'),
(4, 'paprica', 'paprica', '48b705eda40f6b3b14b1a77a70c15100');

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `idEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `nomEquipe` char(32) NOT NULL,
  `nbrPlaceEquipe` int(11) NOT NULL,
  `ageMinEquipe` int(11) NOT NULL,
  `ageMaxEquipe` int(11) NOT NULL,
  `sexeEquipe` char(1) NOT NULL,
  `idEntraineur` int(11) NOT NULL,
  `idSpe` int(11) NOT NULL,
  PRIMARY KEY (`idEquipe`),
  KEY `fk_equipe_entraineur` (`idEntraineur`),
  KEY `fk_equipe_specialite` (`idSpe`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`idEquipe`, `nomEquipe`, `nbrPlaceEquipe`, `ageMinEquipe`, `ageMaxEquipe`, `sexeEquipe`, `idEntraineur`, `idSpe`) VALUES
(1, 'natation1', 10, 5, 8, 'F', 3, 1),
(2, 'foot1', 20, 10, 12, 'F', 2, 2),
(3, 'judo1', 10, 5, 8, 'F', 3, 3),
(4, 'equitation1', 10, 5, 8, 'F', 2, 3),
(5, 'volley1', 10, 5, 8, 'F', 1, 5),
(6, 'athletisme1', 10, 5, 8, 'F', 1, 6),
(7, 'moto cross1', 10, 5, 8, 'F', 1, 7),
(8, 'judo2', 10, 5, 15, 'M', 2, 3);

--
-- Triggers `equipe`
--
DROP TRIGGER IF EXISTS `adequation_spe_entraineur_equipe_insert`;
DELIMITER $$
CREATE TRIGGER `adequation_spe_entraineur_equipe_insert` BEFORE INSERT ON `equipe` FOR EACH ROW BEGIN
DECLARE testNb int default 0;
if testNb = (SELECT count(*)
from spe_entraineur
where idEntraineur = new.idEntraineur
and idSpe = new.idSpe)
then
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'entraineur pas spécialisé pour cette équipe';
end IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `adequation_spe_entraineur_equipe_update`;
DELIMITER $$
CREATE TRIGGER `adequation_spe_entraineur_equipe_update` BEFORE UPDATE ON `equipe` FOR EACH ROW BEGIN
DECLARE testNb int default 0;
if testNb = (SELECT count(*)
from spe_entraineur
where idEntraineur = new.idEntraineur
and idSpe = new.idSpe)
then
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'entraineur pas spécialisé pour cette équipe';
end IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `check_equipes_entraineur_insert`;
DELIMITER $$
CREATE TRIGGER `check_equipes_entraineur_insert` BEFORE INSERT ON `equipe` FOR EACH ROW BEGIN
DECLARE $nbrEquipe int DEFAULT 3;

if $nbrEquipe <= (select COUNT(*)
                from equipe
                where idEntraineur = new.idEntraineur)
then
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'cet entraineur a déja son max équipes';
end IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `check_equipes_entraineur_update`;
DELIMITER $$
CREATE TRIGGER `check_equipes_entraineur_update` BEFORE UPDATE ON `equipe` FOR EACH ROW BEGIN
DECLARE $nbrEquipe int DEFAULT 3;

if $nbrEquipe <= (select COUNT(*)
                from equipe
                where idEntraineur = new.idEntraineur)
then
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'equipes max atteintes';
end IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `equipe_adherent`
--

DROP TABLE IF EXISTS `equipe_adherent`;
CREATE TABLE IF NOT EXISTS `equipe_adherent` (
  `idAdherent` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  PRIMARY KEY (`idAdherent`,`idEquipe`),
  KEY `fk_adherent_equipe_adherent` (`idAdherent`),
  KEY `fk_equipe_equipe_adherent` (`idEquipe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipe_adherent`
--

INSERT INTO `equipe_adherent` (`idAdherent`, `idEquipe`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1);

--
-- Triggers `equipe_adherent`
--
DROP TRIGGER IF EXISTS `check_equipes_adherent`;
DELIMITER $$
CREATE TRIGGER `check_equipes_adherent` BEFORE INSERT ON `equipe_adherent` FOR EACH ROW BEGIN
DECLARE $nbrPlace int DEFAULT 3;

if $nbrPlace <= (select COUNT(*)
                from equipe_adherent
                where idAdherent = new.idAdherent)
then
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'ne peut pas rejoindre une équipe de plus';
end IF;
end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `verifPlaceEquipe`;
DELIMITER $$
CREATE TRIGGER `verifPlaceEquipe` BEFORE INSERT ON `equipe_adherent`
 FOR EACH ROW BEGIN
DECLARE nbrPlace int DEFAULT 0;
set nbrPlace = (SELECT COUNT(*)
                 FROM equipe_adherent
                 where idEquipe = new.idEquipe);
                     
if nbrPlace > (select nbrPlaceEquipe
                from equipe
                where idEquipe = new.idEquipe)
then
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Pas de place disponible';
end IF;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `emailContact` char(40) NOT NULL,
  `messageContact` char(200) NOT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`idMessage`, `emailContact`, `messageContact`) VALUES
(1, 'cathy.delmas@laposte.net', 'test1'),
(2, 'cathy.delmas@laposte.net', 'test2'),
(8, 'antome', 'fdsb'),
(9, 'rftg', 'hjjtyj'),
(10, 'edrh', 'hserh');

-- --------------------------------------------------------

--
-- Table structure for table `nouvelle`
--

DROP TABLE IF EXISTS `nouvelle`;
CREATE TABLE IF NOT EXISTS `nouvelle` (
  `idNouvelle` int(11) NOT NULL,
  `dateParutionNouvelle` date NOT NULL,
  `descriptionNouvelle` char(150) NOT NULL,
  `idTypeNouvelle` int(11) NOT NULL,
  PRIMARY KEY (`idNouvelle`),
  KEY `fk_nouvelle_typeNouvelle` (`idTypeNouvelle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nouvelle`
--

INSERT INTO `nouvelle` (`idNouvelle`, `dateParutionNouvelle`, `descriptionNouvelle`, `idTypeNouvelle`) VALUES
(1, '2021-07-07', 'Une nouvelle ?®quipe est n?®e : la natation.\r\n', 1),
(2, '2021-07-18', 'L ?®quipe de judo est qualifi?® pour le tournoi r?®gional poid lourd.\r\n', 1),
(3, '2021-07-24', 'La vid?®oth?¿que sera ouverte d?¿s le 20 Juillet.\r\n', 2),
(4, '2021-07-25', 'R?®duction de 10% sur l abonnement pass cin?®ma de la commune.\r\n', 2),
(5, '2021-07-12', 'Nous venons de recevoir les nouveaux jeux du parc PERRAULT.\r\n', 3),
(6, '2021-07-10', 'Le tarif des entr?®es familles ?á la piscine ont baiss?® de 15% cette ann?®e.\r\n', 3),
(7, '2021-07-11', 'Organisation d un loto par le club du 3?¿me age. Tout le monde est le bienvenu.\r\n', 4),
(8, '2021-07-12', 'Le club couture organise une vente dans le hall de la Mairie le 20 juillet.\r\n', 4);

-- --------------------------------------------------------

--
-- Table structure for table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `idSpe` int(11) NOT NULL AUTO_INCREMENT,
  `nomSpe` char(32) NOT NULL,
  PRIMARY KEY (`idSpe`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialite`
--

INSERT INTO `specialite` (`idSpe`, `nomSpe`) VALUES
(1, 'natation'),
(2, 'foot'),
(3, 'judo'),
(4, 'equitation'),
(5, 'volley'),
(6, 'athletisme'),
(7, 'moto cross');

-- --------------------------------------------------------

--
-- Table structure for table `spe_entraineur`
--

DROP TABLE IF EXISTS `spe_entraineur`;
CREATE TABLE IF NOT EXISTS `spe_entraineur` (
  `idSpe` int(11) NOT NULL,
  `idEntraineur` int(11) NOT NULL,
  PRIMARY KEY (`idSpe`,`idEntraineur`),
  KEY `fk_specialite_spe_entraineur` (`idSpe`),
  KEY `fk_entraineur_spe_entraineur` (`idEntraineur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--

-- Déchargement des données de la table `spe_entraineur`
--

INSERT INTO `spe_entraineur` (`idSpe`, `idEntraineur`) VALUES
(3, 2),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `titulaire`
--

DROP TABLE IF EXISTS `titulaire`;
CREATE TABLE IF NOT EXISTS `titulaire` (
  `idEntraineur` int(11) NOT NULL,
  `dateEmbauche` date NOT NULL,
  PRIMARY KEY (`idEntraineur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `titulaire`
--

INSERT INTO `titulaire` (`idEntraineur`, `dateEmbauche`) VALUES
(1, '2019-10-10'),
(3, '2019-10-12'),
(4, '2020-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `typenouvelle`
--

DROP TABLE IF EXISTS `typenouvelle`;
CREATE TABLE IF NOT EXISTS `typenouvelle` (
  `idTypeNouvelle` int(11) NOT NULL,
  `libelleTypeNouvelle` char(32) NOT NULL,
  PRIMARY KEY (`idTypeNouvelle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `typenouvelle`
--

INSERT INTO `typenouvelle` (`idTypeNouvelle`, `libelleTypeNouvelle`) VALUES
(1, 'sport'),
(2, 'culture'),
(3, 'famille'),
(4, 'pratique');

-- --------------------------------------------------------

--
-- Table structure for table `vacataire`
--

DROP TABLE IF EXISTS `vacataire`;
CREATE TABLE IF NOT EXISTS `vacataire` (
  `idEntraineur` int(11) NOT NULL,
  `telephoneVacataire` char(14) NOT NULL,
  PRIMARY KEY (`idEntraineur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacataire`
--

INSERT INTO `vacataire` (`idEntraineur`, `telephoneVacataire`) VALUES
(2, '06.25.45.12.15');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `fk_equipe_entraineur` FOREIGN KEY (`idEntraineur`) REFERENCES `entraineur` (`idEntraineur`),
  ADD CONSTRAINT `fk_equipe_specialite` FOREIGN KEY (`idSpe`) REFERENCES `specialite` (`idSpe`);

--
-- Constraints for table `equipe_adherent`
--
ALTER TABLE `equipe_adherent`
  ADD CONSTRAINT `fk_adherent_equipe_adherent` FOREIGN KEY (`idAdherent`) REFERENCES `adherent` (`idAdherent`),
  ADD CONSTRAINT `fk_equipe_equipe_adherent` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`);

--
-- Constraints for table `spe_entraineur`
--
ALTER TABLE `spe_entraineur`
  ADD CONSTRAINT `fk_entraineur_spe_entraineur` FOREIGN KEY (`idEntraineur`) REFERENCES `entraineur` (`idEntraineur`),
  ADD CONSTRAINT `fk_specialite_spe_entraineur` FOREIGN KEY (`idSpe`) REFERENCES `specialite` (`idSpe`);

--
-- Constraints for table `titulaire`
--
ALTER TABLE `titulaire`
  ADD CONSTRAINT `fk_titulaire_entraineur` FOREIGN KEY (`idEntraineur`) REFERENCES `entraineur` (`idEntraineur`);

--
-- Constraints for table `vacataire`
--
ALTER TABLE `vacataire`
  ADD CONSTRAINT `fk_vacataire_entraineur` FOREIGN KEY (`idEntraineur`) REFERENCES `entraineur` (`idEntraineur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
