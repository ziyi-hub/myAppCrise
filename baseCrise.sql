-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 13 oct. 2021 à 11:57
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

--
-- Déchargement des données de la table `Contact`
--

INSERT INTO `Contact` (`idContact`, `nomContact`, `idGroupContact`, `idUtilisateur`, `idMessage`) VALUES
(2, 'Paul', 1, 39, 1),
(3, 'Thibaut', 1, 44, 2),
(4, 'Ziyi', 1, 38, 3),
(5, 'Denis', 2, 48, 15),
(23, 'Ziyi', 2, 38, 20),
(24, 'Anne', 3, 45, 21),
(31, 'Ziyi', 1, 38, 28),
(32, 'Ziyi', 2, 38, 29),
(33, 'Ziyi', 2, 38, 30),
(34, 'Ziyi', 3, 38, 31),
(35, 'Paul', 4, 39, 32),
(36, 'Ziyi', 4, 38, 33),
(37, 'Thibaut', 4, 44, 34),
(38, 'Anne', 1, 45, 35),
(39, 'Denis', 1, 48, 36),
(40, 'Ziyi', 3, 38, 37),
(41, 'Ziyi', 1, 38, 38),
(42, 'Ziyi', 1, 38, 39);

-- --------------------------------------------------------

--
-- Structure de la table `Group`
--

CREATE TABLE `Group` (
  `idGroup` int(12) NOT NULL,
  `nomGroup` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Group`
--

INSERT INTO `Group` (`idGroup`, `nomGroup`) VALUES
(1, 'group1'),
(2, 'group2'),
(3, 'group3'),
(11, 'group4'),
(12, 'group5'),
(13, 'group6'),
(14, 'group7'),
(15, 'group8');

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
  `tempsEnvoi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Messages`
--

INSERT INTO `Messages` (`idMessage`, `content`, `tempsEnvoi`) VALUES
(1, 'Bonjour, je m\'appelle Paul!', '2021-09-21 14:08:19'),
(2, 'Bonsoir, je suis dans lp2', '2021-09-22 14:09:02'),
(3, 'Hi je m\'appelle Ziyi', '2021-10-12 00:52:13'),
(15, 'Hi, Ziyiiiii', '2021-10-12 09:36:43'),
(20, '', '2021-10-12 23:43:25'),
(21, '', '2021-10-12 23:52:55'),
(28, 'Coucou Thibaut, coucou Paul', '2021-10-13 01:03:49'),
(29, 'Hi Denis', '2021-10-13 01:06:44'),
(30, 'Salut !', '2021-10-13 01:07:11'),
(31, 'Hi, Anne', '2021-10-13 08:25:08'),
(32, '\"\"', '2021-10-13 08:34:22'),
(33, '\"\"', '2021-10-13 08:34:54'),
(34, '\"\"', '2021-10-13 08:36:49'),
(35, '', '2021-10-13 08:40:13'),
(36, '', '2021-10-13 08:40:53'),
(37, 'Hi, je suis Ziyi', '2021-10-13 08:41:15'),
(38, 'Hi Anne', '2021-10-13 08:42:37'),
(39, 'je n\'aime pas le docker', '2021-10-13 11:17:01');

-- --------------------------------------------------------

--
-- Structure de la table `Profil`
--

CREATE TABLE `Profil` (
  `idProfil` int(50) NOT NULL,
  `codeProfil` varchar(12) NOT NULL DEFAULT 'Admin',
  `roleId` int(10) NOT NULL,
  `statutContaminé` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Profil`
--

INSERT INTO `Profil` (`idProfil`, `codeProfil`, `roleId`, `statutContaminé`) VALUES
(16, 'admin', 1, NULL),
(17, 'admin', 1, NULL),
(19, 'admin', 1, NULL),
(22, 'admin', 1, NULL),
(23, 'admin', 1, NULL),
(24, 'admin', 1, NULL),
(25, 'admin', 1, NULL),
(26, 'admin', 1, NULL),
(27, 'admin', 1, NULL),
(28, 'admin', 1, NULL),
(29, 'admin', 1, NULL),
(30, 'admin', 1, NULL),
(31, 'admin', 1, NULL),
(32, 'admin', 1, NULL),
(33, 'admin', 1, NULL),
(34, 'admin', 1, NULL),
(35, 'admin', 1, NULL),
(36, 'admin', 1, NULL),
(37, 'admin', 1, NULL),
(38, 'admin', 1, NULL),
(39, 'admin', 1, NULL),
(40, 'admin', 1, NULL),
(41, 'admin', 1, NULL),
(42, 'admin', 1, NULL),
(43, 'admin', 1, NULL),
(44, 'admin', 1, NULL),
(45, 'admin', 1, NULL),
(46, 'admin', 1, NULL),
(47, 'admin', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `idUtilisateur` int(10) NOT NULL,
  `nomUtilisateur` varchar(50) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `roleId` int(11) DEFAULT NULL,
  `idProfil` int(12) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `tokenModif` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`idUtilisateur`, `nomUtilisateur`, `motDePasse`, `roleId`, `idProfil`, `token`, `tokenModif`) VALUES
(38, 'Ziyi', '$2y$10$LOXy0gbzZmu4HREncZan1OWnzDOafeQwp3bUuuu/Wd/jxqaAiX8JK', 1, 16, 'b8cb683831c4014e18019ce20e91efaa', NULL),
(39, 'Paul', '$2y$10$0tC74niWV0tx/Ue7BwY0eOIB792DmYxCovzCqFTs94YJamXsfx.BW', 1, 17, '75241ee1999d66563e78f05946ca21aa', NULL),
(41, 'Ziyiii', '$2y$10$Z7eFTBHgQY/ggxqEecN/0uy4hCBGVjezReO.nw8tazTZpY85I2HcS', 1, 19, NULL, NULL),
(44, 'Thibaut', '$2y$10$FBmgjcOOeNl3Myw/wn.4fOh/3BMYhObhcZA7FqBw1TKY14W2vFgZy', 1, 22, NULL, NULL),
(45, 'Anne', '$2y$10$wI/FfgoAaT4uInzTYsVA3.YN2j8VT40MbjwNbZJmv6ZY0n2uVJ.aS', 1, 23, NULL, NULL),
(46, 'Bunny', '$2y$10$N5CC/fYyBvfhw6tsE6OwC.EzzazOKOhxf7h5X26uzSrZYuZ05iTQK', 1, 24, NULL, NULL),
(47, 'Canal', '$2y$10$Y22zrQSyX8b97bkqokfHh.UbsPRyW56ln98wICRzEZEK0bOvo3nsm', 1, 25, NULL, NULL),
(48, 'Denis', '$2y$10$Lvzu.spkDfDKuo4KQarx4ur4bSpqa0arD9dKvd4mhAXmjUTgHp9di', 1, 26, NULL, NULL),
(49, 'Emmanuel', '$2y$10$JBsRuuORpUv42uBlSFqq4OF7.XUfcCz6GlWFCZdwOj.tQRK/A8ro.', 1, 27, NULL, NULL),
(50, 'ZiyiW', '$2y$10$2p87Om1f0kgB0SLRrs5lPePN3yqEHr3xMxialjkWSOLfWelXRk2iy', 1, 28, NULL, NULL),
(51, 'WAng', '$2y$10$9JFXk89JHtPVdNH5tMReBexxsZqb1QBpED46qO8hHUTktlry.GeBe', 1, 29, NULL, NULL),
(52, 'Z', '$2y$10$vvKMMKLWscjGnL8scwYUFuPdSPgPam2kVhxj75CVX3iZl7wju1AsC', 1, 30, NULL, NULL),
(53, 'Ziiii', '$2y$10$UQCOR0FLy8h50Jr/Vg6KBOWKaQpKm4.4eYM56Kjk7XVMnFFKDJYt.', 1, 31, NULL, NULL),
(54, 'Ziyiyiyiiiiijdsdnskdsnjkd', '$2y$10$45Z6TejXRBYqaWWHd1bQmeu6d3czxgIst3CRAnMI7QVc/2kVhVLm6', 1, 32, NULL, NULL),
(55, 'Ziyi', '$2y$10$c7JgXZjmVucqtS8bJVxHHu4eIdkXBX.l7iZlbu1AiWMWcMfvDfvtq', 1, 33, NULL, NULL),
(56, 'Ziyiiii', '$2y$10$yASzVMkDuk44Lqmg0rg17OtBKJqMrnOyKDcBCbnQ.aGCFY2dGlVG.', 1, 34, NULL, NULL),
(57, 'Zi_yi', '$2y$10$FZ2.tuhEs8lUj/S6ejKZSuPmK6gFwp3G5dEjtjIn.4XKI3xTchleG', 1, 35, NULL, NULL),
(58, 'zzzzz', '$2y$10$tPBU5bOqFx9RgHrxm2Zjye/ysdaAAeJCnT5GzRd77yQR3UKRS13iq', 1, 36, NULL, NULL),
(59, 'Ziyii', '$2y$10$O1Jgz2r2yA2NotFXgTLRCOouAYYwRIfrlIQSTeQKUpguPGhKTuxfS', 1, 37, NULL, NULL),
(60, 'Ziyi_w', '$2y$10$x6YKrfhsqiKayPIqUps9.OD9qnVc5EKtWIXhdC41dlQK2ziCN57RS', 1, 38, NULL, NULL),
(61, 'Ziyiii', '$2y$10$PuG4U5UEjgWZ602rLgMSyezZYrpCoBS2/OcpmYnuWCF3vDrI7ajI2', 1, 39, NULL, NULL),
(62, 'Z_', '$2y$10$3RDxROzl.XXkjk43OihTSeX37YHF9Dnp2nb94EJxpL.Tj6Hf7cYMi', 1, 40, NULL, NULL),
(63, 'zimba', '$2y$10$YLhmZEzZawH.Xsi.3ewG1.WVRRC2L2DFLacBoYBuXL.GOiqiIwun.', 1, 41, NULL, NULL),
(64, 'Ziyiiiii', '$2y$10$qmbsnC.dALpkkQoetNLtv.MTfXnY7hpBteo4LgSlYsLVNvcw8sM/6', 1, 42, NULL, NULL),
(65, 'Ziyiii', '$2y$10$KYyCq5Deei0bAsbnMBVQpeLPOqxHLZdalAot.z1LTDL7SErtmv4/a', 1, 43, NULL, NULL),
(66, 'zzz', '$2y$10$CLNLgvrSin/hu6CuAUWzTekbSpCbaT.oGvdq6QP/N86XZgBQZtvAK', 1, 44, NULL, NULL),
(67, 'Ziyi', '$2y$10$OmOA393dIbyykGpKfeKB2ev4ioMR5OCuYEuv7Ll3SEf6lipd5sJfi', 1, 45, NULL, NULL),
(68, 'Ziyiiiiiii', '$2y$10$bq51DiJlt/EoTDCKEK/5fOPIz8G9eZxJRXmafXFvRSr6HySkWlUSm', 1, 46, NULL, NULL),
(69, 'cbdhjksvackjbc', '$2y$10$769.WILm4HcEUpsRm97mG.nh8lNa/Vbn.kEQF5ysn20KkKZ4MvS/2', 1, 47, 'fbd503f1b3856c88633703e926ac911f', NULL);

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
  MODIFY `idContact` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `Group`
--
ALTER TABLE `Group`
  MODIFY `idGroup` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `Localisations`
--
ALTER TABLE `Localisations`
  MODIFY `numLocal` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `idMessage` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `Profil`
--
ALTER TABLE `Profil`
  MODIFY `idProfil` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `idUtilisateur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
