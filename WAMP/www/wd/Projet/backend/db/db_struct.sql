-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 mars 2023 à 09:40
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `imm_projet_idaw`
--

-- --------------------------------------------------------

--
-- Structure de la table `aliment`
--

DROP TABLE IF EXISTS `aliment`;
CREATE TABLE IF NOT EXISTS `aliment` (
  `ID_ALIMENT` int NOT NULL AUTO_INCREMENT,
  `LABEL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `TYPE` int NOT NULL,
  PRIMARY KEY (`ID_ALIMENT`),
  KEY `type_aliment` (`TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compose`
--

DROP TABLE IF EXISTS `compose`;
CREATE TABLE IF NOT EXISTS `compose` (
  `ID_ALIMENT` int NOT NULL,
  `ID_COMPOSANT` int NOT NULL,
  `POURCENTAGE` tinyint NOT NULL,
  PRIMARY KEY (`ID_ALIMENT`,`ID_COMPOSANT`),
  KEY `compose_aliment` (`ID_COMPOSANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consomme`
--

DROP TABLE IF EXISTS `consomme`;
CREATE TABLE IF NOT EXISTS `consomme` (
  `ID_CONSO` int NOT NULL AUTO_INCREMENT,
  `ID_USER` int NOT NULL,
  `ID_ALIMENT` int NOT NULL,
  `QUANTITE` float NOT NULL,
  `DATE` date NOT NULL,
  PRIMARY KEY (`ID_CONSO`),
  KEY `consomme_aliment` (`ID_ALIMENT`),
  KEY `user_consomme` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `ID_ALIMENT` int NOT NULL,
  `ID_NUTRIMENT` int NOT NULL,
  `QUANTITE` double DEFAULT NULL,
  PRIMARY KEY (`ID_ALIMENT`,`ID_NUTRIMENT`),
  KEY `contient_nutriment` (`ID_NUTRIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
CREATE TABLE IF NOT EXISTS `niveau` (
  `ID_NIVEAU` int NOT NULL AUTO_INCREMENT,
  `LABEL` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_NIVEAU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nutriment`
--

DROP TABLE IF EXISTS `nutriment`;
CREATE TABLE IF NOT EXISTS `nutriment` (
  `ID_NUTRIMENT` int NOT NULL AUTO_INCREMENT,
  `LABEL` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID_NUTRIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `ID_TYPE` int NOT NULL AUTO_INCREMENT,
  `LABEL` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_USER` int NOT NULL AUTO_INCREMENT,
  `NOM` varchar(16) NOT NULL,
  `PRENOM` varchar(16) NOT NULL,
  `LOGIN` varchar(25) NOT NULL,
  `MAIL` varchar(60) NOT NULL,
  `MDP` varchar(25) NOT NULL,
  `SEXE` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DATE_NAISSANCE` date NOT NULL,
  `ID_NIVEAU` int NOT NULL,
  PRIMARY KEY (`ID_USER`),
  KEY `niveau_sportif` (`ID_NIVEAU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aliment`
--
ALTER TABLE `aliment`
  ADD CONSTRAINT `type_aliment` FOREIGN KEY (`TYPE`) REFERENCES `type` (`ID_TYPE`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `compose`
--
ALTER TABLE `compose`
  ADD CONSTRAINT `aliment_compose_par` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `compose_aliment` FOREIGN KEY (`ID_COMPOSANT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `consomme`
--
ALTER TABLE `consomme`
  ADD CONSTRAINT `consomme_aliment` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `user_consomme` FOREIGN KEY (`ID_USER`) REFERENCES `utilisateur` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `aliment_contient` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `contient_nutriment` FOREIGN KEY (`ID_NUTRIMENT`) REFERENCES `nutriment` (`ID_NUTRIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `niveau_sportif` FOREIGN KEY (`ID_NIVEAU`) REFERENCES `niveau` (`ID_NIVEAU`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
