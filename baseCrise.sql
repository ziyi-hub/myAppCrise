-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 23 sep. 2021 à 11:44
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `PWeb`
--

-- --------------------------------------------------------

--
-- Structure de la table `Contact`
--

CREATE TABLE `Contact` (
  `idContact` int(12) NOT NULL,
  `nomContact` varchar(50) NOT NULL,
  `idGroupContact` int(12) NOT NULL,
  `idUtilisateur` int(50) DEFAULT NULL,
  `idMessage` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Group`
--

CREATE TABLE `Group` (
  `idGroup` int(12) NOT NULL,
  `nomGroup` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Localisations`
--

CREATE TABLE `Localisations` (
  `numLocal` int(50) NOT NULL,
  `rayon` int(50) DEFAULT NULL,
  `nomLocal` varchar(50) NOT NULL,
  `codePostal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Messages`
--

CREATE TABLE `Messages` (
  `idMessage` int(50) NOT NULL,
  `content` varchar(200) NOT NULL,
  `tempsEnvoi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Messages`
--

INSERT INTO `Messages` (`idMessage`, `content`, `tempsEnvoi`) VALUES
(1, 'Bonjour, je m\'appelle Ziyi!', '2021-09-21 14:08:19'),
(2, 'Bonsoir, je suis dans lp2', '2021-09-22 14:09:02');

-- --------------------------------------------------------

--
-- Structure de la table `Profil`
--

CREATE TABLE `Profil` (
  `idProfil` int(50) NOT NULL,
  `codeProfil` varchar(12) NOT NULL DEFAULT 'Admin',
  `roleId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `idUtilisateur` int(10) NOT NULL,
  `nomUtilisateur` varchar(50) NOT NULL,
  `motDePasse` int(50) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `roleId` int(11) DEFAULT NULL,
  `idProfil` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`idUtilisateur`, `nomUtilisateur`, `motDePasse`, `statut`, `roleId`, `idProfil`) VALUES
(5, 'Ziyiiiii', 20001027, 'non', NULL, NULL),
(6, 'Yifan', 20001027, 'non', NULL, NULL),
(7, 'Yujia', 20001027, 'non', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Contact`
--
ALTER TABLE `Contact`
  ADD PRIMARY KEY (`idContact`),
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idMessage` (`idMessage`);

--
-- Index pour la table `Group`
--
ALTER TABLE `Group`
  ADD PRIMARY KEY (`idGroup`);

--
-- Index pour la table `Localisations`
--
ALTER TABLE `Localisations`
  ADD PRIMARY KEY (`numLocal`);

--
-- Index pour la table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `Profil`
--
ALTER TABLE `Profil`
  ADD PRIMARY KEY (`idProfil`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `idProfil` (`idProfil`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Contact`
--
ALTER TABLE `Contact`
  MODIFY `idContact` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Group`
--
ALTER TABLE `Group`
  MODIFY `idGroup` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Localisations`
--
ALTER TABLE `Localisations`
  MODIFY `numLocal` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `idMessage` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Profil`
--
ALTER TABLE `Profil`
  MODIFY `idProfil` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `idUtilisateur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Contact`
--
ALTER TABLE `Contact`
  ADD CONSTRAINT `idMessage` FOREIGN KEY (`idMessage`) REFERENCES `Messages` (`idMessage`),
  ADD CONSTRAINT `idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD CONSTRAINT `idProfil` FOREIGN KEY (`idProfil`) REFERENCES `Profil` (`idProfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
