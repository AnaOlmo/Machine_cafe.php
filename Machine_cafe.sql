-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 25 jan. 2018 à 08:46
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `machine_cafe`
--

-- --------------------------------------------------------

--
-- Structure de la table `boisson`
--

DROP TABLE IF EXISTS `boisson`;
CREATE TABLE IF NOT EXISTS `boisson` (
  `code_boisson` varchar(3) NOT NULL,
  `nom_boisson` varchar(40) NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`code_boisson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boisson`
--

INSERT INTO `boisson` (`code_boisson`, `nom_boisson`, `prix`) VALUES
('CAF', 'Café Long', 50),
('CIT', 'Thé Citron', 80),
('COU', 'Café Court', 20),
('EXP', 'Expresso', 30),
('IRI', 'Irish Coffee', 100),
('THE', 'Thé', 40),
('TLA', 'Thé Lait', 90),
('TME', 'Thé Menthe', 85),
('YOO', 'Yoplait', 150);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `idingredient` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ingredient` varchar(40) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`idingredient`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`idingredient`, `nom_ingredient`, `stock`) VALUES
(1, 'Eau', 29),
(2, 'Café', 56),
(3, 'Thé', 14),
(4, 'Citron', 14),
(5, 'Menthe', 45),
(6, 'Lait', 20),
(7, 'Whisky', 90),
(8, 'Sucre', 39);

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `idpiece` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) NOT NULL,
  `valeur` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`idpiece`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`idpiece`, `nom`, `valeur`, `stock`) VALUES
(1, '1euro', 100, 50),
(2, '2euro', 200, 100),
(3, '50cts', 50, 100),
(4, '20cts', 20, 100),
(5, '10cts', 10, 100),
(6, '5cts', 5, 100);

-- --------------------------------------------------------

--
-- Structure de la table `pieces_inserees`
--

DROP TABLE IF EXISTS `pieces_inserees`;
CREATE TABLE IF NOT EXISTS `pieces_inserees` (
  `vente_numvente` int(11) NOT NULL,
  `piece_idpiece` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`vente_numvente`,`piece_idpiece`),
  KEY `fk_vente_has_piece_piece2_idx` (`piece_idpiece`),
  KEY `fk_vente_has_piece_vente2_idx` (`vente_numvente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pieces_inserees`
--

INSERT INTO `pieces_inserees` (`vente_numvente`, `piece_idpiece`, `quantite`) VALUES
(1, 1, 2),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pieces_rendues`
--

DROP TABLE IF EXISTS `pieces_rendues`;
CREATE TABLE IF NOT EXISTS `pieces_rendues` (
  `vente_numvente` int(11) NOT NULL,
  `piece_idpiece` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`vente_numvente`,`piece_idpiece`),
  KEY `fk_vente_has_piece_piece1_idx` (`piece_idpiece`),
  KEY `fk_vente_has_piece_vente1_idx` (`vente_numvente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `code_boisson` varchar(3) NOT NULL,
  `idingredient` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`code_boisson`,`idingredient`),
  KEY `fk_boisson_has_ingredient_ingredient1_idx` (`idingredient`),
  KEY `fk_boisson_has_ingredient_boisson1_idx` (`code_boisson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`code_boisson`, `idingredient`, `quantite`) VALUES
('CAF', 1, 2),
('CAF', 2, 2),
('CIT', 1, 2),
('CIT', 3, 2),
('CIT', 4, 2),
('COU', 1, 1),
('COU', 2, 2),
('EXP', 1, 1),
('EXP', 2, 1),
('IRI', 1, 1),
('IRI', 2, 2),
('IRI', 7, 3),
('THE', 1, 1),
('THE', 3, 1),
('TLA', 1, 2),
('TLA', 3, 2),
('TLA', 6, 3),
('TME', 1, 2),
('TME', 3, 2),
('TME', 5, 1),
('YOO', 6, 8),
('YOO', 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `numvente` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `nbsucre` int(11) NOT NULL,
  `id_boisson` varchar(3) NOT NULL,
  PRIMARY KEY (`numvente`),
  KEY `fk_vente_boisson1_idx` (`id_boisson`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`numvente`, `date`, `nbsucre`, `id_boisson`) VALUES
(1, '2018-01-04 03:16:21', 2, 'CAF'),
(2, '2018-01-01 16:28:41', 0, 'CIT'),
(3, '2017-12-29 19:42:05', 3, 'COU'),
(4, '2017-12-24 10:38:08', 0, 'EXP'),
(5, '2018-01-01 17:29:36', 2, 'IRI'),
(6, '2018-01-02 09:05:02', 3, 'THE'),
(7, '2018-01-03 13:41:11', 4, 'TLA'),
(8, '2018-01-03 13:44:44', 0, 'TME'),
(9, '2018-01-03 14:44:48', 2, 'CAF'),
(10, '2018-01-01 11:10:31', 0, 'CIT'),
(11, '2018-01-01 17:32:07', 1, 'IRI'),
(12, '2018-01-04 16:16:21', 1, 'EXP'),
(13, '2018-01-04 19:17:42', 2, 'IRI'),
(14, '2018-01-05 07:06:10', 0, 'CAF'),
(23, '2018-01-05 11:54:15', 2, 'EXP'),
(24, '2018-01-05 11:54:28', 4, 'IRI'),
(25, '2018-01-08 11:54:28', 2, 'COU'),
(26, '2018-01-08 11:54:28', 1, 'COU'),
(27, '2018-01-08 17:23:37', 5, 'CAF'),
(28, '2018-01-08 17:27:20', 0, 'IRI'),
(29, '2018-01-08 17:31:02', 0, 'IRI'),
(30, '2018-01-08 17:31:09', 0, 'EXP'),
(31, '2018-01-08 17:40:25', 0, 'IRI'),
(32, '2018-01-09 09:21:37', 2, 'CIT'),
(33, '2018-01-09 09:33:41', 0, 'THE'),
(34, '2018-01-09 09:33:58', 1, 'TME'),
(35, '2018-01-09 09:34:05', 2, 'TME'),
(36, '2018-01-09 09:50:44', 1, 'THE'),
(37, '2018-01-09 10:05:26', 2, 'CIT'),
(38, '2018-01-09 10:09:38', 2, 'CIT'),
(39, '2018-01-09 10:10:17', 5, 'CIT'),
(40, '2018-01-09 10:14:45', 2, 'COU'),
(41, '2018-01-09 10:14:52', 5, 'COU'),
(42, '2018-01-09 10:22:42', 0, 'CAF'),
(43, '2018-01-09 10:22:47', 5, 'CAF'),
(44, '2018-01-09 10:47:27', 2, 'CAF'),
(45, '2018-01-09 10:58:49', 3, 'COU'),
(46, '2018-01-09 11:30:38', 5, 'CIT'),
(47, '2018-01-09 11:50:58', 5, 'CAF'),
(48, '2018-01-09 11:51:10', 5, 'TME'),
(49, '2018-01-09 11:51:42', 5, 'CAF'),
(50, '2018-01-09 11:53:20', 5, 'CAF'),
(51, '2018-01-09 11:53:53', 5, 'CAF'),
(52, '2018-01-09 11:55:08', 1, 'CAF'),
(53, '2018-01-09 11:56:09', 1, 'CAF'),
(54, '2018-01-09 11:57:16', 1, 'CAF'),
(55, '2018-01-09 11:57:26', 5, 'IRI'),
(56, '2018-01-09 11:57:39', 5, 'COU'),
(57, '2018-01-09 11:59:31', 5, 'CAF'),
(58, '2018-01-09 11:59:37', 5, 'CIT'),
(59, '2018-01-09 12:02:56', 5, 'CAF'),
(60, '2018-01-09 12:06:47', 5, 'CIT'),
(61, '2018-01-09 13:09:56', 2, 'COU'),
(62, '2018-01-09 14:25:28', 1, 'CAF'),
(63, '2018-01-10 17:47:29', 3, 'COU'),
(64, '2018-01-10 17:48:22', 2, 'CAF'),
(65, '2018-01-10 17:48:47', 1, 'COU'),
(66, '2018-01-10 17:48:54', 1, 'COU'),
(67, '2018-01-11 14:46:49', 1, 'CIT');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pieces_inserees`
--
ALTER TABLE `pieces_inserees`
  ADD CONSTRAINT `fk_vente_has_piece_piece2` FOREIGN KEY (`piece_idpiece`) REFERENCES `piece` (`idpiece`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vente_has_piece_vente2` FOREIGN KEY (`vente_numvente`) REFERENCES `vente` (`numvente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pieces_rendues`
--
ALTER TABLE `pieces_rendues`
  ADD CONSTRAINT `fk_vente_has_piece_piece1` FOREIGN KEY (`piece_idpiece`) REFERENCES `piece` (`idpiece`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vente_has_piece_vente1` FOREIGN KEY (`vente_numvente`) REFERENCES `vente` (`numvente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `fk_boisson_has_ingredient_boisson1` FOREIGN KEY (`code_boisson`) REFERENCES `boisson` (`code_boisson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_boisson_has_ingredient_ingredient1` FOREIGN KEY (`idingredient`) REFERENCES `ingredient` (`idingredient`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `fk_vente_boisson1` FOREIGN KEY (`id_boisson`) REFERENCES `boisson` (`code_boisson`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
