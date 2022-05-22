-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 22 mai 2022 à 20:40
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_etudiant`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `cin` int(8) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `justifie` int(4) NOT NULL,
  `nonJustifie` int(4) NOT NULL,
  `date` date NOT NULL,
  `matiere` varchar(50) NOT NULL,
  `groupe` varchar(10) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`cin`, `nom`, `prenom`, `justifie`, `nonJustifie`, `date`, `matiere`, `groupe`, `login`) VALUES
(7242313, 'Hidoussi', 'Islem', 1, 0, '2022-05-20', 'Web', 'INFO1-A', 'Islem@gmail.com'),
(11142169, 'Besbes', 'Malak', 1, 1, '2022-05-23', 'Web', 'INFO1-A', 'Malak@yahou.fr'),
(11139661, 'Smiri', 'Rihem', 1, 1, '2022-05-14', 'Web', 'INFO1-A', 'Rihem99@gmail.com'),
(12323434, 'Alida', 'Tsimanavaka', 1, 1, '2022-05-09', 'Web', 'INFO1-D', 'tsimanavaka@gmail.com'),
(12323434, 'Alida', 'Tsimanavaka', 0, 1, '2022-05-10', 'Web', 'INFO1-D', 'tsimanavaka@gmail.com'),
(12323434, 'Alida', 'Tsimanavaka', 1, 2, '2022-05-11', 'Web', 'INFO1-D', 'tsimanavaka@gmail.com'),
(12323434, 'Alida', 'Tsimanavaka', 1, 0, '2022-05-12', 'Web', 'INFO1-D', 'tsimanavaka@gmail.com'),
(12323434, 'Alida', 'Tsimanavaka', 1, 0, '2022-05-13', 'Web', 'INFO1-D', 'tsimanavaka@gmail.com'),
(12323434, 'Alida', 'Tsimanavaka', 1, 1, '2022-05-09', 'BD', 'INFO1-D', 'tsimanavaka@gmail.com'),
(12222222, 'Tita', 'Tonton', 1, 1, '2022-05-09', 'BD', 'INFO3-A', 'ouesleti.97.farah@gmail.com'),
(42552517, 'shedi', 'Amara', 1, 0, '2022-05-02', 'Web', 'INFO1-B', 'shedi@gmail.com'),
(11429665, 'Kouki', 'Hamza', 2, 1, '2022-05-16', 'BD', 'INFO1-B', 'Hamza675@yahoo.fr'),
(14502681, 'Triki', 'Sahar', 2, 0, '2022-05-17', 'BD', 'INFO1-B', 'Sahar98@gmail.com'),
(13276298, 'Selmi', 'Jihed', 2, 0, '2022-05-21', 'BD', 'INFO1-B', 'Jihed67@gmail.com'),
(14361230, 'Oueslati', 'Farah', 1, 2, '2022-05-16', 'Web', 'INFO1-B', 'Farah91@gmail.com'),
(14502037, 'Manai', 'Nour', 1, 0, '2022-05-16', 'Web', 'INFO1-B', 'Nour@yahoo.fr'),
(14361230, 'Oueslati', 'Farah', 0, 1, '2022-05-17', 'Web', 'INFO1-B', 'Farah91@gmail.com'),
(14502037, 'Manai', 'Nour', 0, 1, '2022-05-17', 'Web', 'INFO1-B', 'Nour@yahoo.fr'),
(14361230, 'Oueslati', 'Farah', 1, 0, '2022-05-18', 'Web', 'INFO1-B', 'Farah91@gmail.com'),
(14502037, 'Manai', 'Nour', 1, 1, '2022-05-18', 'Web', 'INFO1-B', 'Nour@yahoo.fr'),
(14361230, 'Oueslati', 'Farah', 1, 1, '2022-05-19', 'Web', 'INFO1-B', 'Farah91@gmail.com'),
(14361230, 'Oueslati', 'Farah', 0, 1, '2022-05-20', 'Web', 'INFO1-B', 'Farah91@gmail.com'),
(14361230, 'Oueslati', 'Farah', 2, 1, '2022-05-21', 'Web', 'INFO1-B', 'Farah91@gmail.com'),
(11142169, 'Besbes', 'Malak', 1, 1, '2022-05-16', 'Web', 'INFO1-A', 'Malak@yahou.fr'),
(11424870, 'Bejaoui', 'Nourane', 0, 1, '2022-05-16', 'Web', 'INFO1-A', 'Nourane@gmail.com'),
(11424870, 'Bejaoui', 'Nourane', 1, 0, '2022-05-17', 'Web', 'INFO1-A', 'Nourane@gmail.com'),
(11142169, 'Besbes', 'Malak', 2, 0, '2022-05-18', 'Web', 'INFO1-A', 'Malak@yahou.fr'),
(11142169, 'Besbes', 'Malak', 1, 0, '2022-05-19', 'Web', 'INFO1-A', 'Malak@yahou.fr'),
(11142169, 'Besbes', 'Malak', 0, 2, '2022-05-20', 'Web', 'INFO1-A', 'Malak@yahou.fr'),
(11142169, 'Besbes', 'Malak', 1, 1, '2022-05-21', 'Web', 'INFO1-A', 'Malak@yahou.fr');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `date`, `nom`, `prenom`, `login`, `pass`) VALUES
(3, '2022-04-10 14:01:46', 'Torien', 'Torien', 'torien1227@gmail.com', '202cb962ac59075b964b07152d234b70'),
(4, '2022-04-10 14:41:41', 'Sorien', 'Rien', 'Sorien@gmail.com', '202cb962ac59075b964b07152d234b70'),
(9, '2022-05-09 14:57:17', 'ouesleti', 'farah', 'ouesleti.97.farah@gmail.com', '7d74f6896e07adce917c12a416944b0e');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `cin` int(8) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `cpassword` varchar(40) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `Classe` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`cin`, `email`, `password`, `cpassword`, `nom`, `prenom`, `adresse`, `Classe`) VALUES
(7242313, 'Islem@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Hidoussi', 'Islem', '     Bizerte', 'INFO1-A'),
(7498229, 'Wael67@yahoo.fr', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Wasli', 'Wael', '     Ariana', 'INFO1-A'),
(9637161, 'AmiraJolie@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Kchaou', 'Amira', '     Tunis', 'INFO1-A'),
(9893564, 'BarakeShehnez@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Baraket', 'Shehnez', '     Tunis', 'INFO1-A'),
(11139661, 'Rihem99@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Smiri', 'Rihem', '     Tunis', 'INFO1-A'),
(11142169, 'Malak@yahou.fr', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Besbes', 'Malak', '     Ariana', 'INFO1-A'),
(11424870, 'Nourane@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Bejaoui', 'Nourane', '     Charguia II', 'INFO1-A'),
(11429665, 'Hamza675@yahoo.fr', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Kouki', 'Hamza', '     Bizerte', 'INFO1-B'),
(11660732, 'Houssem@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Ben Moussa', 'Houssem', '     Tunis', 'INFO1-B'),
(13276298, 'Jihed67@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Selmi', 'Jihed', '     Gabes', 'INFO1-B'),
(13645504, 'Sorien@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Amdouni', 'Fedi', '     Ariana', 'INFO1-B'),
(14361230, 'Farah91@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Oueslati', 'Farah', '     Manouba', 'INFO1-B'),
(14361268, 'Mayssa@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Ben Othmen', 'Mayssa', '     Manouba', 'INFO1-A'),
(14400050, 'benothmenemna61@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Ben Othmen', 'Emna', '     Ariana', 'INFO1-B'),
(14406034, 'Chadi@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Amara Nebli', 'Chadi', '     Ariana', 'INFO1-B'),
(14502037, 'Nour@yahoo.fr', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Manai', 'Nour', '     Tunis', 'INFO1-B'),
(14502681, 'Sahar98@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Triki', 'Sahar', 'Tunis', 'INFO1-B'),
(42552517, 'shedi@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'shedi', 'Amara', '     Korbe', 'INFO1-B');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(4) NOT NULL,
  `login` varchar(40) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `login`, `nom`) VALUES
(5, 'Sorien@gmail.com', 'INFO1-B'),
(10, 'torien1227@gmail.com', 'INFO3-A'),
(16, 'torien1227@gmail.com', 'INFO2-D'),
(21, 'torien1227@gmail.com', 'INFO1-C'),
(31, 'Sorien@gmail.com', 'INFO1-A'),
(33, 'ouesleti.97.farah@gmail.com', 'INFO1-B');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `cin` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `dateNaiss` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`cin`, `name`, `firstname`, `dateNaiss`) VALUES
(11111111, 'Torien', 'Torien', '1999-05-24');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`cin`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`cin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
