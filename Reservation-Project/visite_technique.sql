-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 02 jan. 2024 à 11:39
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `visite_technique`
--

-- --------------------------------------------------------

--
-- Structure de la table `prix_visites`
--

CREATE TABLE `prix_visites` (
  `id` int(11) NOT NULL,
  `type_visite_id` int(11) DEFAULT NULL,
  `chevaux_min` int(11) DEFAULT NULL,
  `chevaux_max` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT 200.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prix_visites`
--

INSERT INTO `prix_visites` (`id`, `type_visite_id`, `chevaux_min`, `chevaux_max`, `prix`) VALUES
(1, 1, 1, 7, 350.00),
(2, 2, 1, 7, 300.00),
(3, 3, 1, 7, 300.00),
(4, 4, 1, 7, 194.00),
(5, 1, 8, 10, 370.00),
(6, 2, 8, 10, 320.00),
(7, 3, 8, 10, 320.00),
(8, 4, 8, 10, 214.00),
(9, 1, 11, 14, 390.00),
(10, 2, 11, 14, 340.00),
(11, 3, 11, 14, 340.00),
(12, 4, 11, 14, 234.00),
(13, 1, 15, 96, 420.00),
(14, 2, 15, 96, 370.00),
(15, 3, 15, 96, 370.00),
(16, 4, 15, 96, 264.00);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `prenom_client` varchar(255) NOT NULL,
  `numero_matricule` varchar(255) NOT NULL,
  `numero_telephone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_heure_reservation` datetime NOT NULL,
  `type_visite` varchar(255) DEFAULT NULL,
  `nombre_chevaux` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `nom_client`, `prenom_client`, `numero_matricule`, `numero_telephone`, `email`, `date_heure_reservation`, `type_visite`, `nombre_chevaux`) VALUES
(49, 'rida', 'rida', '1212-Z-56', '0678986541', 'oscar.garcia@hcl.com', '2024-01-10 09:30:00', 'volontaire', 4),
(50, 'mouhssine', 'chkarka', '2356-W-12', '0677896312', 'mouhssine@gmail.com', '2024-01-16 09:30:00', 'periodique', 14);

-- --------------------------------------------------------

--
-- Structure de la table `types_visites`
--

CREATE TABLE `types_visites` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `types_visites`
--

INSERT INTO `types_visites` (`id`, `nom`) VALUES
(1, 'Périodique'),
(2, 'Volontaire'),
(3, 'Mutation'),
(4, 'Complémentaire');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `prix_visites`
--
ALTER TABLE `prix_visites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_visite_id` (`type_visite_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types_visites`
--
ALTER TABLE `types_visites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `prix_visites`
--
ALTER TABLE `prix_visites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `types_visites`
--
ALTER TABLE `types_visites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `prix_visites`
--
ALTER TABLE `prix_visites`
  ADD CONSTRAINT `prix_visites_ibfk_1` FOREIGN KEY (`type_visite_id`) REFERENCES `types_visites` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
