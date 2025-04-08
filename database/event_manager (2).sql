-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 08 avr. 2025 à 09:41
-- Version du serveur : 8.0.41-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `event_manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `Avoir`
--

CREATE TABLE `Avoir` (
  `id_lieu` int NOT NULL,
  `id_evenement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id_evenement` int NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id_evenement`, `titre`, `description`, `date`, `heure`, `lieu`, `image_path`) VALUES
(8, 'test4', 'testccczaczacacz', '2025-01-01', '10:19:00', 'pau', 'uploads/events/67c0672e590f2_51LdjRWonGL.png'),
(9, 'test2', 'test2', '2025-01-01', '10:19:00', 'pau', NULL),
(11, 'test event 1', 'lorem ipsum', '2025-01-02', '16:51:00', 'PAU', NULL),
(12, 'test event 2', 'lorem ipsum', '2025-01-01', '16:51:00', 'PAU', NULL),
(13, 'test event 3', 'lorem ipsum', '2025-01-01', '14:50:00', 'PAU', NULL),
(14, 'test event 4', 'lorem ipsum', '2025-01-23', '16:53:00', 'PAU', 'uploads/events/67c06746f39fc_Capture d’écran du 2024-05-02 13-29-44.png'),
(16, 'test event 6', 'lorem ipsum', '2025-01-10', '14:54:00', 'PAU', NULL),
(17, 'test', 'test', '2025-02-03', '13:24:00', 'pau', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `id_lieu` int NOT NULL,
  `ville` varchar(250) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `code_postal` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
--

CREATE TABLE `organisation` (
  `id_organisateur` int NOT NULL,
  `nom_organisateur` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `id_evenement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `register`
--

CREATE TABLE `register` (
  `id_utilisateur` int NOT NULL,
  `id_evenement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `register`
--

INSERT INTO `register` (`id_utilisateur`, `id_evenement`) VALUES
(1, 8),
(2, 8),
(5, 8),
(10, 8),
(1, 9),
(2, 9),
(1, 11),
(1, 12),
(10, 12),
(1, 13),
(2, 13),
(6, 14);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_utilisateur` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(250) NOT NULL,
  `date_inscription` date NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `date_inscription`, `role`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '$2y$10$SoTxpXkMkCqsXkS0UXVgduWvI3yB9jxqU7sdul2geBzKensE976O.', '2024-10-30', 'admin'),
(2, 'bob', 'bob', 'bob@gmail.com', '$2y$10$m2uQb3VeW6Ih75rAaL1LQerFgZGZ8QDpkLwxSgLm6rqRiWC/z7bV.', '2024-11-25', 'user'),
(5, 'organisateur', 'organisateur', 'organisateur@gmail.com', '$2y$10$vI4Qm2AVMEI.YSajPazRHOnPDVwBihYDA1GgAxMcB.oGHH4vsuzzq', '2025-01-08', 'admin'),
(6, 'userTest', 'userTest', 'userTest@gmail.com', '$2y$10$jp5o3i4GNsTpPSare.1aaOMEpyGoo95SjVtg1wGJ49NfAJGQYPWmu', '2025-02-24', 'user'),
(9, 'cccc', 'userTest', 'ccc@vv', '$2y$10$NjUW7opaQ.VEe3FcXDDLcuPomjgaHTYgUg0C7osdGBabWM.4UopEe', '2025-02-27', 'admin'),
(10, 'userTest4', 'userTest', 'userTest4@gmail.com', '$2y$10$SgEnuhWJu9KHsSt4I/KayeipPRwaCype5dEp9ASoubSmSz5xcGKkS', '2025-02-27', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Avoir`
--
ALTER TABLE `Avoir`
  ADD PRIMARY KEY (`id_lieu`,`id_evenement`),
  ADD KEY `Avoir_event0_FK` (`id_evenement`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_evenement`);

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`id_lieu`);

--
-- Index pour la table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id_organisateur`),
  ADD KEY `organisation_event_FK` (`id_evenement`);

--
-- Index pour la table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id_utilisateur`,`id_evenement`),
  ADD UNIQUE KEY `unique_user_event` (`id_utilisateur`,`id_evenement`),
  ADD KEY `register_event0_FK` (`id_evenement`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id_evenement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `id_lieu` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id_organisateur` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Avoir`
--
ALTER TABLE `Avoir`
  ADD CONSTRAINT `Avoir_event0_FK` FOREIGN KEY (`id_evenement`) REFERENCES `event` (`id_evenement`),
  ADD CONSTRAINT `Avoir_lieu_FK` FOREIGN KEY (`id_lieu`) REFERENCES `lieu` (`id_lieu`);

--
-- Contraintes pour la table `organisation`
--
ALTER TABLE `organisation`
  ADD CONSTRAINT `organisation_event_FK` FOREIGN KEY (`id_evenement`) REFERENCES `event` (`id_evenement`);

--
-- Contraintes pour la table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_event0_FK` FOREIGN KEY (`id_evenement`) REFERENCES `event` (`id_evenement`) ON DELETE CASCADE,
  ADD CONSTRAINT `register_user_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `user` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
