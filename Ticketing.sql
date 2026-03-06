-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 06 mars 2026 à 16:08
-- Version du serveur : 10.11.13-MariaDB-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Ticketing`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Member','Admin') NOT NULL DEFAULT 'Member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `accounts`
--

INSERT INTO `accounts` (`id`, `full_name`, `password`, `email`, `role`) VALUES
(1, 'Admin', '$2y$10$wXkhBmUEz7814.uAtHhYduoq.8WmFU3rRuwqc1k9xvSnB.OWj5aGq', 'admin@example.com', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'General'),
(2, 'Technical'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `full_name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `ticket_status` enum('open','closed','resolved') NOT NULL DEFAULT 'open',
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'low',
  `category_id` int(1) NOT NULL DEFAULT 1,
  `private` tinyint(1) NOT NULL DEFAULT 1,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `msg`, `full_name`, `email`, `created`, `ticket_status`, `priority`, `category_id`, `private`, `account_id`, `approved`) VALUES
(1, 'How do I navigate to the website?', 'Hello, I\'m having trouble and need your help!', 'John Doe', 'johndoe@example.com', '2023-04-17 13:06:17', 'open', 'low', 1, 0, 0, 1),
(2, 'Website issue', 'I\'m having issues running the website on my laptop, can you help?', 'John Doe', 'johndoe@example.com', '2023-04-17 13:07:40', 'resolved', 'medium', 1, 0, 0, 1),
(3, 'Responsive design issue', 'I have noticed on mobile devices the website does not work correctly, will you guys fix this problem?', 'John Doe', 'johndoe@example.com', '2023-04-18 14:30:33', 'open', 'low', 1, 0, 0, 1),
(4, 'Navigation menu not aligned', 'When I browser the website on a mobile device I have noticed the menu is not aligned, just letting you guys know.', 'John Doe', 'johndoe@example.com', '2023-04-18 15:47:20', 'closed', 'high', 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tickets_comments`
--

CREATE TABLE `tickets_comments` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `account_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `tickets_comments`
--

INSERT INTO `tickets_comments` (`id`, `ticket_id`, `msg`, `created`, `account_id`) VALUES
(1, 1, 'test affichage commentaire suplementaire', '2026-03-06 16:33:39', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tickets_uploads`
--

CREATE TABLE `tickets_uploads` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `filepath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tickets_comments`
--
ALTER TABLE `tickets_comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tickets_uploads`
--
ALTER TABLE `tickets_uploads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tickets_comments`
--
ALTER TABLE `tickets_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tickets_uploads`
--
ALTER TABLE `tickets_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
