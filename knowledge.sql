-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 04 nov. 2022 à 09:54
-- Version du serveur : 8.0.31-0ubuntu0.22.04.1
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `knowledge`
--

-- --------------------------------------------------------

--
-- Structure de la table `exercise`
--

CREATE TABLE `exercise` (
  `id` int NOT NULL,
  `notion_id` int DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(2100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `exercise`
--

INSERT INTO `exercise` (`id`, `notion_id`, `name`, `url`) VALUES
(1, 1, 'exercice1', 'www.google.com');

-- --------------------------------------------------------

--
-- Structure de la table `notion`
--

CREATE TABLE `notion` (
  `id` int NOT NULL,
  `subject_id` int DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `lesson` text,
  `sample` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notion`
--

INSERT INTO `notion` (`id`, `subject_id`, `date_create`, `name`, `lesson`, `sample`) VALUES
(1, 1, '2022-10-27 00:00:00', 'Balise', 'l1', 's1'),
(2, 1, '2022-01-27 00:00:00', 'Header', 'l2', 's2'),
(3, 1, '2022-11-03 21:44:17', 'Paragraphs', NULL, NULL),
(4, 1, '2022-11-02 21:48:04', 'Styles', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

CREATE TABLE `subject` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `theme_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `subject`
--

INSERT INTO `subject` (`id`, `name`, `theme_id`) VALUES
(1, 'HTML', 1),
(2, 'CSS', 1),
(3, 'ANTIVIRUS', 3),
(4, 'JAVASCRIPT', 1),
(5, 'PHP', 1),
(6, 'COMPOSER', 1),
(7, 'TWIG', 1),
(8, 'COMPOSER', 1),
(9, 'SYMPHONY', 1),
(10, 'REACT', 1),
(11, 'NODE.JS', 1),
(12, 'SQL', 1),
(14, 'C', 1),
(15, 'C++', 1);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `name`) VALUES
(1, 'DEV'),
(2, 'UX/UI'),
(3, 'DATA ANALYST'),
(4, 'DATA INGENIEUR'),
(6, 'NO CODE'),
(7, 'CYBERSECURITE');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exercise_1_idx` (`notion_id`);

--
-- Index pour la table `notion`
--
ALTER TABLE `notion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notion_1_idx` (`subject_id`);

--
-- Index pour la table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subject_1_idx` (`theme_id`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `notion`
--
ALTER TABLE `notion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `fk_exercise_1` FOREIGN KEY (`notion_id`) REFERENCES `notion` (`id`);

--
-- Contraintes pour la table `notion`
--
ALTER TABLE `notion`
  ADD CONSTRAINT `fk_notion_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Contraintes pour la table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_subject_1` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
