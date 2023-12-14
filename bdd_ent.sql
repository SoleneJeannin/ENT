-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 13 déc. 2023 à 10:31
-- Version du serveur : 10.6.16-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `iarovaia_ent`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `id_abs` int(10) NOT NULL,
  `ext_etudiant` int(10) NOT NULL,
  `ext_cours` int(10) NOT NULL,
  `abs_duree` time(6) NOT NULL,
  `abs_justificatif` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`id_abs`, `ext_etudiant`, `ext_cours`, `abs_duree`, `abs_justificatif`) VALUES
(1, 1, 1, '00:15:00.000000', 'pas de rer');

-- --------------------------------------------------------

--
-- Structure de la table `acces_rapide`
--

CREATE TABLE `acces_rapide` (
  `id_acces_rapide` int(11) NOT NULL,
  `acces_titre` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `acces_rapide`
--

INSERT INTO `acces_rapide` (`id_acces_rapide`, `acces_titre`, `icon`, `url`) VALUES
(1, 'O2Switch', '', 'https://cpanel.$row.o2switch.site/'),
(2, 'FileSender', '', 'https://filesender.renater.fr/'),
(3, 'To Do List', '', ''),
(4, 'Absences/Retards', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE `actualite` (
  `id_actu` int(11) NOT NULL,
  `actu_text` varchar(100) NOT NULL,
  `actu_date` datetime NOT NULL,
  `actu_titre` varchar(100) NOT NULL,
  `actu_img` int(11) NOT NULL,
  `ext_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `actualite`
--

INSERT INTO `actualite` (`id_actu`, `actu_text`, `actu_date`, `actu_titre`, `actu_img`, `ext_categorie`) VALUES
(1, 'Ce classement reconduit pour une troisième édition, est réalisé par les Échos START et ChangeNOW en ', '2023-12-05 16:16:46', 'Troisième édition du classement ChangeNOW ', 0, 0),
(2, 'L’enquête, réalisée avec l’appui de France Universités, s’inscrit dans un contexte d’institutionnali', '2023-12-03 16:18:48', 'Enquête REMEDE : Résultats de l\'état des lieux des actions pour l\'égalité dans les établissements d\'', 0, 0),
(3, 'Olivier Berhault : CV Equipment, pôle équipements du groupe NextRoad, est né du rapprochement des ma', '2023-12-05 16:21:35', 'Controlab-Vectra-Equipment (CVE) et Université Gustave Eiffel : un partenariat fructueux pour la dif', 0, 0),
(4, 'L\'Observatoire National des Discriminations et de l\'Égalité dans le Supérieur (ONDES) et la Conféren', '2023-12-05 16:24:02', 'Enquête REMEDE : État des lieux des actions pour l\'égalité dans les établissements d\'enseignement su', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `categorie_titre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `categorie_titre`) VALUES
(1, 'art'),
(2, 'politique et societe'),
(3, 'technologie'),
(4, 'MMI'),
(5, 'INFO'),
(6, 'Marketing et communication'),
(7, 'emploi et stage\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_actu`
--

CREATE TABLE `categorie_actu` (
  `ext_categorie` int(11) NOT NULL,
  `ext_actu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int(11) NOT NULL,
  `cours_date` date NOT NULL,
  `cours_temps_debut` time NOT NULL,
  `cours_temps_fin` time NOT NULL,
  `cours_salle` varchar(50) NOT NULL,
  `ext_matiere` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `cours_date`, `cours_temps_debut`, `cours_temps_fin`, `cours_salle`, `ext_matiere`) VALUES
(1, '2023-12-05', '16:14:00', '18:14:00', '123', 1),
(2, '2023-12-06', '12:22:00', '09:22:00', '121', 2),
(3, '2023-12-04', '16:23:00', '18:23:00', '024', 3),
(4, '2023-12-06', '08:23:00', '10:23:00', '126', 3);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id_doc` int(11) NOT NULL,
  `ext_user` int(11) NOT NULL,
  `doc_titre` varchar(100) NOT NULL,
  `doc_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `eval_projet`
--

CREATE TABLE `eval_projet` (
  `id_eval` int(11) NOT NULL,
  `eval_date_debut` datetime DEFAULT NULL,
  `eval_date_fin` datetime NOT NULL,
  `coefficient` varchar(50) NOT NULL,
  `note` varchar(50) NOT NULL,
  `commentaire` varchar(300) NOT NULL,
  `ext_matiere` int(50) NOT NULL,
  `ext_etudiant` int(50) NOT NULL,
  `ext_cours` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `eval_projet`
--

INSERT INTO `eval_projet` (`id_eval`, `eval_date_debut`, `eval_date_fin`, `coefficient`, `note`, `commentaire`, `ext_matiere`, `ext_etudiant`, `ext_cours`) VALUES
(1, '2023-12-05 16:14:00', '2023-12-05 18:14:00', '2', '17.5', 'très bien', 1, 1, 1),
(2, NULL, '2023-12-07 23:59:00', '1', '17', 'ok c\'est biebn', 3, 2, NULL),
(3, NULL, '2023-12-03 23:59:00', '1.5', '12', 'c\'set ok ', 2, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `info_matiere`
--

CREATE TABLE `info_matiere` (
  `id_info` int(11) NOT NULL,
  `information` varchar(100) NOT NULL,
  `info_date` date NOT NULL,
  `info_titre` varchar(100) NOT NULL,
  `ext_matiere` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `info_matiere`
--

INSERT INTO `info_matiere` (`id_info`, `information`, `info_date`, `info_titre`, `ext_matiere`) VALUES
(1, 'ON va faire plein de choses utiles et interessante. C\'est formidable', '2023-12-06', 'Cours du 06/12', 1),
(2, 'Pleins de belles infos pour pouvoir afficher des trucs', '2023-12-04', 'Cours de CSS', 3),
(3, 'Plein de code javascript, de json et de github pour toujours plus de fun !', '2023-12-05', 'Tous les secrets de Javascript', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

CREATE TABLE `mail` (
  `id_mail` int(11) NOT NULL,
  `mail_text` varchar(1000) NOT NULL,
  `mail_document` varchar(100) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_objet` varchar(100) NOT NULL,
  `ext_utilisateur` int(50) NOT NULL,
  `ext_destinataire` int(50) NOT NULL,
  `ext_status` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `mail`
--

INSERT INTO `mail` (`id_mail`, `mail_text`, `mail_document`, `mail_date`, `mail_objet`, `ext_utilisateur`, `ext_destinataire`, `ext_status`) VALUES
(1, 'La mission Arts et Culture a le plaisir de vous convier à la représentation exceptionnelle de la pièce de théâtre :\r\nScrooge !\r\n\r\n \r\nUn soir de Noël, visité par un fantôme et une ribambelle d’Esprits, Scrooge va découvrir qu’une vie consacrée à l’argent engendre peu de profits. De son enfance à ses vieux jours, tout défile pour le mettre face à son destin et ses responsabilités. Pour jouer de cette métamorphose, une comédienne et la vingtaine de personnages qu’elle incarne surgissent avec masques, poupées, objets et marionnettes.\r\n\r\nCette aventure à rebondissements de Charles Dickens est drôle et édifiante, littéraire et populaire, fantastique et philosophique.\r\nLe Mercredi 13 Décembre 2023 à 18:00\r\nMaison de l\'étudiant - Foyer du BDE\r\nRue des frères lumière, 77420, Champs sur Marne\r\n\r\nEntrée gratuite - événement ouvert à tous - spectacle tout public\r\n\r\nINSCRIPTION OBLIGATOIRE ICI.\r\n\r\nLa représentation sera suivie, pour celles et ceux qui le souhaitent,\r\nd\'un temps d\'échange avec les a', '', '0000-00-00', '[PIÈCE DE THÉÂTRE] - Scrooge - 13 Décembre 2023 à 18:00', 1, 3, 1),
(2, 'Bonjour à tous,\r\n\r\nNous avons le plaisir de vous annoncer notre candidature pour l\'élection du conseil administratif qui se tiendra la semaine prochaine (du 4 au 8 décembre).\r\n\r\nNous nous engageons solennellement à défendre les intérêts des étudiants, à travers :\r\n\r\n    La préservation de l’excellence académique, en s’opposant à l’utilisation de l’écriture inclusive, en défendant une université bilingue par la promotion de programmes d’échanges internationaux, en rendant gratuites à tout moment de l’année les sessions de certification Voltaire.\r\n\r\n\r\n    Le développement de la commodité du campus, en élargissant les horaires du CROUS et de la bibliothèque, en modernisant les bâtiments (prises, wifi, chauffage) et en mettant en place des navettes pour les résidences éloignées du campus.\r\n\r\n\r\n    La protection de l’environnement, en installant un véritable système de tri sélectif, plus de cendriers et de poubelles, et en améliorant l’isolation des bâtiments pour réduire la consommation én', '', '0000-00-00', ' Présentation de la liste TPGE', 2, 6, 1),
(3, 'Bonjour, \r\nJe serai absente le 6 et 7 décembre, \r\ncoordialement, \r\nNéroli ', '', '0000-00-00', 'Absences', 1, 3, 3),
(4, 'Bonjour à tous, \r\nVoici les notes de votre TP test. \r\nBonne journée ', '', '0000-00-00', 'Notes JS', 4, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `id_materiel` int(11) NOT NULL,
  `materiel_titre` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `notice` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id_materiel`, `materiel_titre`, `description`, `type`, `image`, `notice`) VALUES
(1, 'Osmo mobile 6', 'L\'osmo est un appareil de stabilisateur.', 'camera', '<img src=\"./img/materiel/osmo.jpg\" alt=\"\">', 'notice_osmo.pdf'),
(2, 'Micro Canon', 'Le micro-canon permet de cibler le son à une longue distance.', 'son', '<img src=\"./img/materiel/micro_cravate.webp\" alt=\"\">', NULL),
(3, 'Caméra interview', 'Une caméra permettant de filmer des interviews.', 'camera', '<img src=\"./img/materiel/camera.webp\" alt=\"\">', NULL),
(4, 'Lampe à LED', 'Une lampe puissante. ', 'lumiere', '<img src=\"./img/materiel/lampe_led.webp\" alt=\"\">', NULL),
(5, 'Micro Canon', '', 'son', '<img src=\"./img/materiel/micro_canon.webp\" alt=\"\">', NULL),
(6, 'Projecteur', '', 'lumiere', '<img src=\"./img/materiel/projecteur.webp\" alt=\"\">', NULL),
(7, 'Trépied', '', 'camera', '<img src=\"./img/materiel/trepied.webp\" alt=\"\">', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int(11) NOT NULL,
  `programme` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `nom_matiere` varchar(50) NOT NULL,
  `ext_prof` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `programme`, `description`, `couleur`, `nom_matiere`, `ext_prof`) VALUES
(1, 'MMI1', 'marketing et com', 'jaune', 'Stratégie de Communication', 6),
(2, 'MMI2', 'Du code pour faire des trucs jolis', 'bleu', 'Javascript et dev front', 4),
(3, 'MMI2', 'HTML et CSS avec beaucoup de chats', 'rouge', 'Developpement Front', 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `res_date_debut` datetime NOT NULL,
  `res_date_fin` datetime NOT NULL,
  `res_salle` varchar(50) NOT NULL,
  `ext_materiel` int(50) NOT NULL,
  `ext_utilisateur` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `res_date_debut`, `res_date_fin`, `res_salle`, `ext_materiel`, `ext_utilisateur`) VALUES
(1, '2023-12-04 08:15:00', '2023-12-04 10:15:00', '201', 0, 2),
(2, '2023-12-04 15:45:00', '2023-12-04 17:45:00', '157', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_titre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `role_titre`) VALUES
(1, 'Étudiant'),
(2, 'Professeur');

-- --------------------------------------------------------

--
-- Structure de la table `status_mail`
--

CREATE TABLE `status_mail` (
  `id_status` int(11) NOT NULL,
  `status_nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `status_mail`
--

INSERT INTO `status_mail` (`id_status`, `status_nom`) VALUES
(1, 'envoyé'),
(2, 'pas envoyé'),
(3, 'brouillon');

-- --------------------------------------------------------

--
-- Structure de la table `todo_list`
--

CREATE TABLE `todo_list` (
  `id_todo_list` int(11) NOT NULL,
  `todo_list_text` varchar(100) NOT NULL,
  `todo_list_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `todo_list`
--

INSERT INTO `todo_list` (`id_todo_list`, `todo_list_text`, `todo_list_status`) VALUES
(1, 'Faire tout l\'ENT', 0),
(2, 'Créer une base de donnée', 1),
(3, 'Finir le semestre', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_login` varchar(100) NOT NULL,
  `user_nom` varchar(100) NOT NULL,
  `user_prenom` varchar(100) NOT NULL,
  `user_mdp` varchar(150) NOT NULL,
  `user_photo` varchar(100) DEFAULT NULL,
  `user_theme` int(11) NOT NULL,
  `user_admin` tinyint(1) NOT NULL,
  `ext_role` int(11) DEFAULT NULL,
  `user_document` varchar(100) DEFAULT NULL,
  `user_programme` varchar(100) DEFAULT NULL,
  `user_groupe` varchar(100) DEFAULT NULL,
  `user_retard` int(11) DEFAULT NULL,
  `user_acces_rapide1` varchar(100) DEFAULT NULL,
  `user_acces_rapide2` varchar(100) DEFAULT NULL,
  `user_acces_rapide3` varchar(100) DEFAULT NULL,
  `user_acces_rapide4` varchar(100) DEFAULT NULL,
  `ext_todo_list` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `user_login`, `user_nom`, `user_prenom`, `user_mdp`, `user_photo`, `user_theme`, `user_admin`, `ext_role`, `user_document`, `user_programme`, `user_groupe`, `user_retard`, `user_acces_rapide1`, `user_acces_rapide2`, `user_acces_rapide3`, `user_acces_rapide4`, `ext_todo_list`) VALUES
(1, 'neroli.prak', 'prak', 'neroli', 'neroli1234', NULL, 1, 0, 1, NULL, 'MMI1', 'TP-D', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'solene.jeannin', 'jeannin', 'solene', 'solene1234', NULL, 0, 0, 1, NULL, 'MMI2', 'TP-D', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'gaelle.charpentier', 'charpentier', 'gaelle', 'gaelle1234', NULL, 0, 0, 2, NULL, 'MMI', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'philippe.gambette', 'gambette', 'philippe', 'philippe1234', NULL, 0, 0, 2, NULL, 'MMI', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'sophie.david', 'david', 'sophie', 'sophie1234', NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'leyla.jaoued', 'Jaoued', 'Leyla', 'leyla1234', NULL, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id_abs`);

--
-- Index pour la table `acces_rapide`
--
ALTER TABLE `acces_rapide`
  ADD PRIMARY KEY (`id_acces_rapide`);

--
-- Index pour la table `actualite`
--
ALTER TABLE `actualite`
  ADD PRIMARY KEY (`id_actu`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_doc`);

--
-- Index pour la table `eval_projet`
--
ALTER TABLE `eval_projet`
  ADD PRIMARY KEY (`id_eval`);

--
-- Index pour la table `info_matiere`
--
ALTER TABLE `info_matiere`
  ADD PRIMARY KEY (`id_info`);

--
-- Index pour la table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id_mail`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id_materiel`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `status_mail`
--
ALTER TABLE `status_mail`
  ADD PRIMARY KEY (`id_status`);

--
-- Index pour la table `todo_list`
--
ALTER TABLE `todo_list`
  ADD PRIMARY KEY (`id_todo_list`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `id_abs` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `acces_rapide`
--
ALTER TABLE `acces_rapide`
  MODIFY `id_acces_rapide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `actualite`
--
ALTER TABLE `actualite`
  MODIFY `id_actu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `eval_projet`
--
ALTER TABLE `eval_projet`
  MODIFY `id_eval` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `info_matiere`
--
ALTER TABLE `info_matiere`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `mail`
--
ALTER TABLE `mail`
  MODIFY `id_mail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id_materiel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `status_mail`
--
ALTER TABLE `status_mail`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `todo_list`
--
ALTER TABLE `todo_list`
  MODIFY `id_todo_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
