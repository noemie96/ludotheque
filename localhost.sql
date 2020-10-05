-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  sam. 26 sep. 2020 à 10:05
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ludotheque`
--
CREATE DATABASE IF NOT EXISTS `ludotheque` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ludotheque`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'nono', '$2y$10$nXPO.d0kbJnx1T4PWy4Ble0vx3l68.9/aHUvc25HaG/VFyOGuRnkS');

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `editeur` varchar(100) DEFAULT NULL,
  `support` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `synopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `nom`, `type`, `editeur`, `support`, `image`, `synopsis`) VALUES
(1, 'Injustice', 'Action, Combat', 'test', 'PS3', '2091789949jaquette-injustice-les-dieux-sont-parmi-nous-playstation-3-ps3-cover-avant-g-1349895175.jpg', 'Les Dieux Sont Parmi Nous Édition Ultime améliore la nouvelle franchise de jeu de combat de NetherRealm Studios. Avec six nouveaux personnages jouables, 30 nouvelles skins et 60 nouvelles missions, cette édition est bourrée d\'action. En plus de personnages légendaires de DC Comics tels que Batman, le Joker, Green Lantern, Flash, Superman et Wonder Woman, ce titre vous propulse au cœur d\'une histoire captivante. Héros et Vilains s\'affrontent lors de grandes batailles épiques dans un monde où la frontière entre le bien et le mal est floue.'),
(2, 'Batman: Arkham City', 'Action, Aventure, Infiltration', 'DC ', 'PS3', '2063090095jaquette-batman-arkham-city-playstation-3-ps3-cover-avant-g-1315230615.jpg', 'Environ un an et demi après l\'émeute de l\'asile d\'Arkham, Quincy Sharp, l\'ancien directeur de l\'asile d\'Arkham, s\'est approprié la gloire de la capture du Joker, et a profité de sa notoriété pour se faire élire maire de Gotham. Comme l\'asile d\'Arkham et le pénitencier de Blackgate ne peuvent plus servir de lieux de détention, Sharp rachète une grande partie des bas quartiers de la ville et engage les mercenaires de la société militaire privée Tyger pour créer Arkham City, une ville close où tous les criminels de Gotham peuvent vivre libres, à la seule condition qu\'ils ne cherchent pas à s\'enfuir (des plans du projet « Arkham City » sont d\'ailleurs visibles dans une pièce cachée du bureau de Sharp dans Arkham Asylum 6). '),
(4, 'test', 'testt', 'test', 'PS5', NULL, 'test'),
(5, 'Harry potter et le prince de sang mêlé', 'Magie, Action', 'Warner Bros', 'PS3', '2137474144jaquette-harry-potter-et-le-prince-de-sang-mele-playstation-3-ps3-cover-avant-g.jpg', 'Ben c\'est le film mais en jeux ! et tu joues Harry Potter. Tu dois faire de potions durant le cours de potion, des matchs de quidditch, des duels,...'),
(6, 'test', 'tes', 'test', 'PC', NULL, 'test'),
(7, 'Hogwarts Legacy', 'RPG', 'Warner Bros', 'PS5', '2072289077hogwart.jpg', 'Hogwarts Legacy c\'est LE JEU qu\'on attendait depuis 2 ans, ça va juste faire chier s\'il ne sort que sur ps5 et pas sur ps4 pcq c\'est plus cher... et de toute façon j\'ai pas la ps4 non plus mais j\'aurais pu en acheté une pro à moindre prix... du coup je pense que j\'achèterai ça quand j\'aurai un salaire. Dans 1 an quand le jeu ne sera plus à la mode... FUCK'),
(8, 'Skyrim-The elder scrolls', 'RPG', 'Bethesda Softworks', 'PS3', '835706552The-Elder-Scrolls-5-Skyrim-Logo.png', 'OUI je sais je joue à Skyrim sur ps3 et alors... j\'avais pas de pc performant à l\'époque -_-'),
(9, 'Kingdom Hearts', 'RPG,Action', 'Squaresoft', 'PS3', '991260046kingdom-hearts.jpg', 'je l\'avais sur ps2 et je l\'ai racheté sur ps3. '),
(10, 'LOTR la guerre du nord', 'Action, monstres, role', 'Warner Bros', 'PS3', '1190732220jaquette-le-seigneur-des-anneaux-la-guerre-du-nord-playstation-3-ps3-cover-avant-g-1320658499.jpg', 'Ce jeu se passe pendant la Guerre de l\'Anneau. Un petit groupe composé d\'un Nain (Farin), d\'une Elfe (Andriel) et d\'un Rôdeur (Eradan) doit empêcher Agandaûr d\'envahir et d\'asservir tous les peuples libres des royaumes Dúnedain d\'Arnor et d\'Eriador. Pour ce faire, ils seront aidés d\'un grand aigle, Beleram. ');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
