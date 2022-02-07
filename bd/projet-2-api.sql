-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 07 fév. 2022 à 04:39
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet-2-api`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `nomClient` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dateCommentaire` date NOT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `nomClient`, `dateCommentaire`, `commentaire`) VALUES
(1, 'Christian Lapointe', '2021-03-12', 'Gros plus, nous avons emmener notre chien avec nous pour un léger supplément...'),
(2, 'Marie-Claude Poirier', '2021-02-01', 'Le petit déjeuner est inclut (œuf, saucisse, crêpes).'),
(3, 'Claudine Gagnon', '2021-06-08', 'Super propre, accueil chaleureux et tarif très raisonnable.'),
(4, 'Rachel St-Pierre', '2021-05-22', 'Un bel hôtel très propre service courtois et poli.'),
(5, 'Carl Tremblay', '2021-07-24', 'La suite est tres grande bien equiper et propre.');

-- --------------------------------------------------------

--
-- Structure de la table `forfaits_voyages`
--

CREATE TABLE `forfaits_voyages` (
  `id` int NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `villeDepart` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `coordonnees` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nombreEtoiles` decimal(10,0) NOT NULL,
  `nombreChambres` decimal(10,0) NOT NULL,
  `caracteristiques` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dateDepart` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dateRetour` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `rabais` decimal(10,0) NOT NULL,
  `vedette` varchar(5) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `forfaits_voyages`
--

INSERT INTO `forfaits_voyages` (`id`, `destination`, `villeDepart`, `nom`, `coordonnees`, `nombreEtoiles`, `nombreChambres`, `caracteristiques`, `dateDepart`, `dateRetour`, `prix`, `rabais`, `vedette`) VALUES
(1, 'Montréal', 'Québec', 'Hotel Travelodge', '3125 Bd Hochelaga, Québec, QC G1W 2P9', '6', '4', 'Face à la plage;Ascenseur;Miniclub', '2021-01-01', '2022-01-08', '500', '100', '1'),
(3, 'Halifax', 'Québec', 'Hampton Inn by Hilton Halifax Downtown', '1960 Brunswick St, Halifax, NS B3J 2G7', '3', '2', 'Petit déjeuner gratuit;Bien situé', '2021-03-06', '2021-03-09', '102', '89', 'true'),
(4, 'Moncton', 'Halifax', 'Hilton Garden Inn Moncton Downtown', '40 Highfield St, Moncton, NB E1C 5N3', '3', '2', 'Piscine;Proche des transports en commun;Superbes chambres', '2021-02-22', '2021-02-28', '96', '90', 'false'),
(5, 'St John\'s', 'Moncton', 'Days Inn by Wyndham Saint John', '175 City Rd, Saint John, NB E2L 3M9', '2', '1', 'Piscine;Parking gratuit;Excellent petit-déjeuner', '2021-06-12', '2021-06-15', '105', '85', 'true'),
(7, 'Mexiquetestéditoin', 'Québectest', 'nom...', '...', '6', '100', 'Face à la plage;Ascenseur;Miniclub', '2021-01-01', '2020-01-08', '500', '100', '1'),
(8, 'Mexiquetest', 'Québectest', 'nom...', '...', '6', '100', 'Face à la plage;Ascenseur;Miniclub', '2021-01-01', '2020-01-08', '500', '100', '1'),
(10, 'Lévis', 'Montréal', 'Quality Inn & Suites Lévis', 'Quality Inn & Suites Lévis', '4', '100', 'Excellent entretien ménager;Parmis les mieux notés;Piscine formidable', '2021-01-01', '2020-01-08', '250', '175', '1'),
(11, 'Lévis', 'Montréal', 'Quality Inn & Suites Lévis', 'Quality Inn & Suites Lévis', '4', '100', 'Excellent entretien ménager;Parmis les mieux notés;Piscine formidable', '2021-01-01', '2020-01-08', '250', '175', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forfaits_voyages`
--
ALTER TABLE `forfaits_voyages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `forfaits_voyages`
--
ALTER TABLE `forfaits_voyages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
