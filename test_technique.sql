-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 06 juin 2021 à 12:49
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test_technique`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Electroménager'),
(2, 'Multimédia'),
(3, 'Equipement'),
(5, 'Meuble');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210605125148', '2021-06-05 12:52:19', 58),
('DoctrineMigrations\\Version20210605125946', '2021-06-05 12:59:57', 208);

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCE3F79812469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `name`) VALUES
(1, 5, 'Chambre / Literie'),
(2, 5, 'Cuisine - salle à manger'),
(3, 5, 'Salon'),
(7, 1, 'Gros électroménager'),
(8, 1, 'Petit électroménager'),
(9, 2, 'Image et son'),
(10, 2, 'Informatique'),
(11, 2, 'Jeux vidéo'),
(12, 3, 'Entretien'),
(13, 3, 'Loisirs'),
(14, 3, 'Matériel de jardin'),
(15, 3, 'Matériel de sport'),
(16, 3, 'Puériculture');

-- --------------------------------------------------------

--
-- Structure de la table `sub_sub_category`
--

DROP TABLE IF EXISTS `sub_sub_category`;
CREATE TABLE IF NOT EXISTS `sub_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ABB1B0AEF7BFE87C` (`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sub_sub_category`
--

INSERT INTO `sub_sub_category` (`id`, `sub_category_id`, `name`) VALUES
(1, 1, 'Armoire'),
(2, 1, 'Commode'),
(3, 1, 'Lit'),
(4, 1, 'Matelas'),
(5, 1, 'Sommier'),
(6, 2, 'Cuisine conviviale'),
(7, 2, 'Vaisselle'),
(8, 2, 'Linge de table'),
(9, 2, 'Bouilloire'),
(10, 3, 'Canapé'),
(11, 3, 'Fauteuil'),
(12, 3, 'Pouf / repose-pieds'),
(13, 3, 'Table basse'),
(14, 3, 'Meuble TV'),
(15, 3, 'Console'),
(16, 7, 'Cuisinière'),
(17, 7, 'Four'),
(18, 7, 'Réfrigérateur'),
(19, 7, 'Cave à vin'),
(20, 7, 'Congélateur'),
(21, 7, 'Lave vaisselle'),
(22, 7, 'Lave linge'),
(23, 7, 'Sèche-linge'),
(24, 8, 'Four - Micro ondes'),
(25, 8, 'Plaque électrique'),
(26, 8, 'Robot culinaire'),
(27, 8, 'Friteuse'),
(28, 9, 'Télévision'),
(29, 9, 'Support TV'),
(30, 9, 'Décodeur TNT'),
(31, 9, 'Vidéoprojecteur'),
(32, 9, 'Enceinte'),
(33, 10, 'Console de jeux'),
(34, 10, 'Manette'),
(35, 12, 'Accessoire de ménage'),
(36, 12, 'Planche à repasser'),
(37, 13, 'Baby Foot'),
(38, 14, 'Tondeuse'),
(39, 15, 'Banc de musculation'),
(40, 15, 'Haltères'),
(41, 15, 'Tapis de sport'),
(42, 15, 'Vélo elliptique'),
(43, 15, 'Rameur'),
(44, 15, 'Plateforme vibrante'),
(45, 15, 'Tapis de course'),
(46, 15, 'Matériel de fitness'),
(47, 16, 'Poussette'),
(48, 16, 'Chaise haute bébé'),
(49, 16, 'Siège auto'),
(50, 16, 'Coffre à jouet');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `FK_BCE3F79812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `sub_sub_category`
--
ALTER TABLE `sub_sub_category`
  ADD CONSTRAINT `FK_ABB1B0AEF7BFE87C` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
