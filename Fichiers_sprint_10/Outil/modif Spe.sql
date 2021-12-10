DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `idSpe` int(11) NOT NULL AUTO_INCREMENT,
  `nomSpe` char(32) NOT NULL,
  PRIMARY KEY (`idSpe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `specialite` (`idSpe`, `nomSpe`) VALUES
(1, 'natation'),
(2, 'foot'),
(3, 'judo'),
(4, 'equitation'),
(5, 'volley'),
(6, 'athletisme'),
(7, 'moto cross');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `equipe` (`idEquipe`, `nomEquipe`, `nbrPlaceEquipe`, `ageMinEquipe`, `ageMaxEquipe`, `sexeEquipe`, `idEntraineur`, `idSpe`) VALUES
(1, 'natation', 10, 5, 8, 'F', 3, 1),
(2, 'foot', 20, 10, 12, 'F', 2, 2),
(3, 'judo', 10, 5, 8, 'F', 1, 3),
(4, 'equitation', 10, 5, 8, 'F', 1, 4),
(5, 'volley', 10, 5, 8, 'F', 1, 5),
(6, 'athletisme', 10, 5, 8, 'F', 1, 6),
(7, 'moto cross', 10, 5, 8, 'F', 1, 7);

DROP TABLE IF EXISTS `spe_entraineur`;
CREATE TABLE IF NOT EXISTS `Spe_Entraineur` (
  `idSpe` int(11) NOT NULL,
  `idEntraineur` int(11) NOT NULL,
  PRIMARY KEY (`idSpe`,`idEntraineur`),
  KEY `fk_specialite_spe_entraineur` (`idSpe`),
  KEY `fk_entraineur_spe_entraineur` (`idEntraineur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



ALTER TABLE `equipe`
  ADD CONSTRAINT `fk_equipe_entraineur` FOREIGN KEY (`idEntraineur`) REFERENCES `entraineur` (`idEntraineur`),
  ADD CONSTRAINT `fk_equipe_specialite` FOREIGN KEY (`idSpe`) REFERENCES `specialite` (`idSpe`);

ALTER TABLE `spe_entraineur`
  ADD CONSTRAINT `fk_specialite_spe_entraineur` FOREIGN KEY (`idSpe`) REFERENCES `specialite` (`idSpe`),
  ADD CONSTRAINT `fk_entraineur_spe_entraineur` FOREIGN KEY (`idEntraineur`) REFERENCES `entraineur` (`idEntraineur`);

