-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20230323.7514e75794
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Jeu. 08 Juin 2023 à 14:53
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id_membre` int UNSIGNED NOT NULL,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `username` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `hash` varchar(250) NOT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `prenom` varchar(150) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `num_telephone` varchar(20) DEFAULT NULL,
  `adresse_postale` varchar(250) DEFAULT NULL,
  `code_postal` int DEFAULT NULL,
  `ville` varchar(150) DEFAULT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(250) DEFAULT NULL,
  `date_validite_token` datetime DEFAULT NULL,
  `solde_cagnotte` float UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `is_admin`, `username`, `email`, `hash`, `nom`, `prenom`, `date_naissance`, `num_telephone`, `adresse_postale`, `code_postal`, `ville`, `date_inscription`, `token`, `date_validite_token`, `solde_cagnotte`) VALUES
(1, 0, 'Disc', 'lmao@hotmail.com', 'quhgfqkshfqskldfh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1988-06-19 00:00:00', NULL, NULL, NULL),
(2, 0, 'aaa', 'test@hotmail.fr', 'bbb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-02 00:00:00', 'azeazeaze', NULL, NULL),
(3, 0, 'zezererz', 'ezrzerzer@hotmail.fr', '$2y$10$yxYUBfn/KsU3DKF1kkg7H.cna4x1D28jep74tbfHZOPMosbLTT0wm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02 12:22:20', '2920aa3b299128902fb4fdbe70f15297', '2023-06-02 14:22:20', NULL),
(5, 0, 'Testeur', 'testing@hotmail.com', '$2y$10$Ngl7MKRvwqf6FuxcEUtTV.x3yo3JA4/U4hV5TwKgyMyENkqCcyNOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02 12:36:23', '5199eaca4baf8f505a4d8b52b94149cd', '2023-06-02 14:36:23', NULL),
(6, 0, 'lafeignasse', 'omg@hotmail.fr', '$2y$10$6FuT/6Cs8DRbSoqAgxc3pOZkWZbsG0OpmpYW.KvheE3bcPbOBiCEq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02 13:24:58', 'af6d25dc1c272284b77f8b3fbe224e14', '2023-06-02 15:24:58', NULL),
(7, 0, 'aaaaaaaaa', 'lolmdr@hotmail.fr', '$2y$10$Yk9a8k5QBbKvjUNYIMutJe6lcEO6Jw/sF0LULw3xYa/T6UwUrWeP.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02 13:29:19', '10cd63b9c28f001098083cf508d43e5f', '2023-06-02 15:29:19', NULL),
(8, 0, 'azeazeaze', 'lol@hotmail.com', '$2y$10$FEvyU8y0c.M8jNn1zm2kFuC/Akq/DitvK1dveiWtaM.kVzYTOTkp2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-05 09:57:41', '9435e857edb94103e485000dffc38577', '2023-06-05 11:57:41', NULL),
(10, 0, 'lolmdrptdr', 'wtfisgoingon@hotmail.fr', '$2y$10$sEUGUn9sOaka9aocq1U2oOSnFpoT.c3/mF5c9StmPoBtOTmi7lhva', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 14:43:45', '75cf0eccfdc0f443df24bc1e54693f5b', '2023-06-08 16:43:45', NULL),
(11, 0, 'wtfisthat', 'oupsiedaisy@hotmail.fr', '$2y$10$Yehi3RKWOrx1Qwhj1HIGa./UlHqN0oZ.WXZ.AQWmTa8CgXaFWOeBy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 14:46:04', '61bf0b86b72ab0204785dc1f82178004', '2023-06-08 16:46:04', NULL),
(12, 0, 'azeazeazeaze', 'looooooool@hotmail.com', '$2y$10$b6R90izUTiNq7MQPrQReveexgMmXAyQE.dtPj.eSI4Bx3zfSaTnw2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 14:47:03', 'a9b884263326f0ba26cf3bb729bdef74', '2023-06-08 16:47:03', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id_membre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id_membre` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
