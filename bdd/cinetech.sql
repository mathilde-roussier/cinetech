-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 19 mai 2020 à 23:26
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cinetech`
--
CREATE DATABASE IF NOT EXISTS `cinetech` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cinetech`;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `commentaire` longtext NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `id_media` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_users` (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_users`, `commentaire`, `parent_id`, `id_media`) VALUES
(204, 5, 'Je suis du mÃªme avis ! ', 203, 16306),
(203, 4, 'J\'adore vraiment ce film il est trop cool :) ', 0, 16306);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_media` int(11) NOT NULL,
  `nom_media` varchar(255) NOT NULL,
  `type_media` varchar(255) NOT NULL,
  `img_media` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_users` (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `id_users`, `id_media`, `nom_media`, `type_media`, `img_media`) VALUES
(62, 4, 586945, 'La TraversÃ©e', 'id_film', 'http://image.tmdb.org/t/p/w500/eDv3y4biYkCYHSCRXfxOFHaECwr.jpg'),
(63, 4, 3508, 'Candy Boy', 'id_film', 'http://image.tmdb.org/t/p/w500/6yM0buxrFN3Gh6fwqfThusngMdI.jpg'),
(60, 5, 2632, 'Il Ã©tait une foisâ€¦ la Vie', 'id_serie', 'http://image.tmdb.org/t/p/w500/rs339eWHkz5AnYI935EFzmnPoFf.jpg'),
(61, 5, 586940, 'J\'ai perdu mon corps', 'id_film', 'http://image.tmdb.org/t/p/w500/yWLis6kHMffkUluFbPGs876Ib5y.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(5, 'test', 'test@test.com', '$2y$12$BX8/1AjmxIok/Sau0.RBeO5iBpNM4wqDierHtWB1bu7omxkwohAmK'),
(4, 'Mathilde', 'mathilde.roussier@laplateforme.io', '$2y$12$65X9yEjzWB4KJ./aNfOz3eE/ylh6LhxnzO4jNkNhDLdYcV.a6NutC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
