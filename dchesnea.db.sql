-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  db473075695.db.1and1.com
-- Généré le :  Mer 04 Mai 2016 à 21:13
-- Version du serveur :  5.1.73-log
-- Version de PHP :  5.4.45-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db473075695`
--

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `primary` tinyint(4) NOT NULL,
  `id_portfolio_ext` int(11) NOT NULL,
  `img_description` varchar(600) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id_image`, `url`, `primary`, `id_portfolio_ext`, `img_description`) VALUES
(6, '../uploads/AndroidParametres.png', 0, 5, 'Activité Android qui me permettait de pouvoir changer facilement les paramètres d''accès au serveur'),
(7, '../uploads/AndroidSelectionnerUnBadg.png', 0, 5, 'Cette vue sur l''application android permettais de pouvoir choisir un badge parmi une liste'),
(8, '../uploads/JSFutilisateur.png', 1, 5, 'Voici le site que j''ai créé. Chaque liste utilisent AJAX avec JSF'),
(9, '../uploads/JSFATTribuerDEsBadges.png', 0, 5, 'Cette vue permet d''attribuer un utilisateur à un badge afin de pouvoir ensuite lui donner des droits d''accès'),
(10, '../uploads/csvAPI.jpeg', 1, 6, 'On voit ici l''utilisation très simple de la fonction writeAll qui prend en premier paramètre un map ayant comme clé une classe bean et en valeur une Arraylist de ce beans. Le deuxième paramètre et la localisation du fichier.'),
(11, '../uploads/carte_bureau.JPG', 1, 7, 'Visuel de la carte.'),
(12, '../uploads/carte_mobile.JPG', 0, 7, 'La carte en version mobile.'),
(13, '../uploads/choix_menu.JPG', 0, 7, 'Le logiciel peut aussi proposer des menus.'),
(14, '../uploads/olives_carte.JPG', 0, 7, 'L''application est utilisable par n''importe quel restaurant et peut être personnalisé.'),
(15, '../uploads/recap_viande.JPG', 0, 7, 'Possibilité de personnaliser son plat en y indiquant par exemple sa cuisson.');

-- --------------------------------------------------------

--
-- Structure de la table `localisationChoisi`
--

CREATE TABLE IF NOT EXISTS `localisationChoisi` (
  `id_Localisation` int(11) NOT NULL AUTO_INCREMENT,
  `id_Localisation_Choisi` int(11) NOT NULL,
  PRIMARY KEY (`id_Localisation`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Cette table permet de faire persister la localisation choisi' AUTO_INCREMENT=2 ;

--
-- Contenu de la table `localisationChoisi`
--

INSERT INTO `localisationChoisi` (`id_Localisation`, `id_Localisation_Choisi`) VALUES
(1, 16);

-- --------------------------------------------------------

--
-- Structure de la table `localisationsDisponible`
--

CREATE TABLE IF NOT EXISTS `localisationsDisponible` (
  `id_loc_dispo` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LONGITUDE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LATITUDE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_loc_dispo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liste des destinations disponible' AUTO_INCREMENT=25 ;

--
-- Contenu de la table `localisationsDisponible`
--

INSERT INTO `localisationsDisponible` (`id_loc_dispo`, `NOM`, `LONGITUDE`, `LATITUDE`) VALUES
(1, 'Evreux', '1.1648083', '49.0226735'),
(13, 'Angers', '-0.5422783', '47.4766078'),
(14, 'Londres', '-0.1352692', '51.5088493'),
(16, 'Paris', '2.3444653', '48.8595199'),
(24, 'D59, 91140 Villejust, France', '2.222810054895035', '48.67055226338585');

-- --------------------------------------------------------

--
-- Structure de la table `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id_portfolio` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(10000) COLLATE latin1_general_ci NOT NULL,
  `id_image_etrangere` int(11) NOT NULL,
  PRIMARY KEY (`id_portfolio`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `portfolio`
--

INSERT INTO `portfolio` (`id_portfolio`, `titre`, `description`, `id_image_etrangere`) VALUES
(5, 'Sécurisation site GVI', 'Ce projet est celui que j''ai effectué en fin de BTS pendant 6 mois. C''est un projet de sécurisation d''un site communal qui était souvent dégradé. Il était demandé un contrôle par badge d''accès, de la vidéo surveillance, et de la détection de coupure d''un grillage. Dans ce projet j''avais en charge le site web de gestion. Etant donné que je l''ai terminé assez rapidement j''ai eu du temps pour créer une application Android pour gérer ce parc avec des services web pour communiquer entre les deux. Les technologies utilisées : Java, Java EE, JPA, JSF, AJAX avec JSF, Service WEB REST, Android. <b> J''ai d''ailleurs obtenu la meilleure note de l''académie de Rouen pour ce projet.</b>', 0),
(6, 'CSV-API', 'J''ai créé cet API afin de m''aider lorsque j''aurais besoin de créé ou parser des fichiers CSV. Elle est très facilement utilisable par tous et sera bientôt disponible.', 0),
(7, 'Application de caisse', 'Durant mon stage de licence professionnelle j''ai effectué une application de caisse permettant à un utilisateur de pouvoir prendre sa commande lui-même dans un restaurant. Sans avoir à demander l''aide d''un serveur. L''application développée peut être utilisée par n''importe quel restaurant ou bar. Son contenu peut donc à n''importe quel moment changer aussi bien le style que les produits proposées.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utlisateurs`
--

CREATE TABLE IF NOT EXISTS `utlisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `utlisateurs`
--

INSERT INTO `utlisateurs` (`id`, `nom`, `prenom`, `email`, `password`) VALUES
(1, 'Chesneau', 'Damien', 'contact@damienchesneau.fr', '5f31769db16ce3556b416de8d4fb2fff');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
