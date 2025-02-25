-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 15 déc. 2023 à 13:57
-- Version du serveur :  10.5.19-MariaDB-0+deb11u2
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e21803762_db1`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`e21803762sql`@`%` PROCEDURE `msg_sce` (IN `identifiant` INT, OUT `text` VARCHAR(255))  BEGIN
    DECLARE intitule VARCHAR(255);
    DECLARE nb_par INT;
    DECLARE premier_participant VARCHAR(255);

    SELECT intitule_sce INTO intitule FROM t_scenario_sce WHERE id_sce = identifiant;
    SELECT nb_participant_sce(identifiant) INTO nb_par;
    
    SELECT CONCAT(id_par, ' le ', MIN(dateFirstR_reu)) 
    INTO premier_participant 
    FROM t_reussite_reu 
    WHERE id_sce = identifiant  
    GROUP BY id_par                        
    ORDER BY MIN(dateFirstR_reu) 
    LIMIT 1;

    SET text = CONCAT(intitule, '--', nb_par, '--', premier_participant);
END$$

CREATE DEFINER=`e21803762sql`@`%` PROCEDURE `recap_participant` (IN `identifiant` INT)  BEGIN
SELECT GROUP_CONCAT(tp.adresse_par) as participant from t_reussite_reu tr
JOIN t_participant_par tp on tr.id_par = tp.id_par
where tr.id_sce = identifiant;
END$$

CREATE DEFINER=`e21803762sql`@`%` PROCEDURE `recup_codeSuiv` (IN `code_etape` VARCHAR(255), OUT `code_suiv` VARCHAR(255))  BEGIN

    SET @ordre := (SELECT ordre_eta + 1 FROM t_etape_eta WHERE code_eta = code_etape);
    SET @idDuSce := (SELECT id_sce FROM t_etape_eta WHERE code_eta = code_etape);

    SELECT code_eta
    INTO code_suiv
    FROM t_etape_eta
    WHERE ordre_eta = @ordre AND id_sce = @idDuSce;
END$$

--
-- Fonctions
--
CREATE DEFINER=`e21803762sql`@`%` FUNCTION `code_sce` () RETURNS VARCHAR(8) CHARSET utf8mb4 COLLATE utf8mb4_general_ci BEGIN
    DECLARE randomUUID VARCHAR(32);
    DECLARE randomCode VARCHAR(8);


    SET randomUUID = REPLACE(UUID(), '-', '');


    SET randomCode = UPPER(SUBSTRING(randomUUID, 1, 8));

    RETURN randomCode;
END$$

CREATE DEFINER=`e21803762sql`@`%` FUNCTION `nb_etat_par_sce` (`identifiant` INT) RETURNS INT(11) BEGIN
	set @num =(SELECT count(id_sce) from t_etape_eta where id_sce=identifiant);
    return @num;
END$$

CREATE DEFINER=`e21803762sql`@`%` FUNCTION `nb_participant_sce` (`identifiant` INT) RETURNS INT(11) BEGIN
	set @num =(SELECT count(id_par) from t_reussite_reu where id_sce=identifiant);
    return @num;
END$$

CREATE DEFINER=`e21803762sql`@`%` FUNCTION `nombre_joueurs_appli` () RETURNS INT(11) BEGIN
    DECLARE nombre_joueurs INT;

    SELECT COUNT(DISTINCT id_par) INTO nombre_joueurs
    FROM t_reussite_reu;

    RETURN nombre_joueurs;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `le_sel`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `le_sel` (
`sel` varchar(47)
);

-- --------------------------------------------------------

--
-- Structure de la table `t_actualite_act`
--

CREATE TABLE `t_actualite_act` (
  `id_act` int(11) NOT NULL,
  `intitule_act` varchar(100) NOT NULL,
  `description_act` varchar(200) NOT NULL,
  `etat_act` char(1) NOT NULL,
  `date_act` date NOT NULL,
  `pseudo_cpt` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_actualite_act`
--

INSERT INTO `t_actualite_act` (`id_act`, `intitule_act`, `description_act`, `etat_act`, `date_act`, `pseudo_cpt`) VALUES
(1, 'Nouvelle édition du Blind Test Musical', 'Préparez-vous pour la toute nouvelle édition du Blind Test Musical qui se déroulera le 10 octobre. Testez vos connaissances musicales et gagnez des prix passionnants !', 'A', '2023-10-10', 'DavidMiller'),
(2, 'Sortie du jeu de musique \"Rythmico\"', 'Le jeu de musique \"Rythmico\" sortira officiellement le 15 septembre. Jouez à des rythmes entraînants et défiez vos amis !', 'A', '2023-09-15', 'EmilyJones'),
(3, 'Concert en ligne de pop acoustique', 'Ne manquez pas notre concert en ligne de pop acoustique le 25 novembre. Les artistes joueront des versions acoustiques de vos chansons préférées en direct !', 'A', '2023-11-25', 'GraceDavis'),
(4, 'Quiz musical en direct sur Instagram', 'Rejoignez-nous pour un quiz musical en direct sur Instagram tous les mercredis à 18h. Testez vos connaissances musicales et gagnez des cadeaux !', 'A', '2023-09-20', 'HenryBrown'),
(5, 'Tournoi de jeux de musique', 'Inscrivez-vous dès maintenant pour notre tournoi de jeux de musique qui se tiendra le 5 octobre. Affrontez d\'autres joueurs dans des défis musicaux passionnants !', 'A', '2023-10-05', 'FrankWilson'),
(62, 'Nouvelle Réussite', 'Félicitation susan.wilson@example.com vous avez réussi le jeux Enquête hip-hop !', 'A', '2023-12-10', 'administrATeur'),
(63, 'Nouvelle Réussite', 'Félicitation adrien.fllr@gmail.com vous avez réussi le jeux Blindtest Rap Battle !', 'A', '2023-12-10', 'administrATeur'),
(64, 'Nouvelle Réussite', 'Félicitation adriendzdz.fllr@gmail.com vous avez réussi le jeux Blindtest Rap Battle !', 'A', '2023-12-10', 'administrATeur'),
(65, 'Nouvelle Réussite', 'Félicitation add@gmail.com vous avez réussi le jeux Blindtest Rap Battle !', 'A', '2023-12-11', 'administrATeur'),
(66, 'Nouvelle Réussite', 'Félicitation aymen_test_reussite@gmail.com vous avez réussi le jeux Blindtest Rap Battle !', 'A', '2023-12-11', 'administrATeur'),
(67, 'Nouvelle Réussite', 'Félicitation aymen_test_reussite2@gmail.com vous avez réussi le jeux Blindtest Rap Battle !', 'A', '2023-12-11', 'administrATeur'),
(68, 'Nouvelle Réussite', 'Félicitation aymen_test_reussite4@gmail.com vous avez réussi le jeux Blindtest Rap Battle !', 'A', '2023-12-11', 'administrATeur'),
(69, 'Nouvelle Réussite', 'Félicitation je@gmail.com vous avez réussi le jeux Blindtest Rap Battle !', 'A', '2023-12-13', 'administrATeur'),
(70, 'Nouvelle Réussite', 'Félicitation test@gmail.com vous avez réussi le jeux Blindtest Rap Battle !', 'A', '2023-12-13', 'administrATeur'),
(71, 'Nouvelle Réussite', 'Félicitation vm343@titi.fr vous avez réussi le jeux Enquête hip-hop !', 'A', '2023-12-13', 'administrATeur');

-- --------------------------------------------------------

--
-- Structure de la table `t_compte_cpt`
--

CREATE TABLE `t_compte_cpt` (
  `pseudo_cpt` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp_cpt` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`pseudo_cpt`, `mdp_cpt`) VALUES
('DavidMiller', '2d69fabb8612b0830f40d27bfe84278efe042df61d64e6b7ed10945d9fb2fbad'),
('EmilyJones', '91220a43765523b4ce295a71dc6c41097b90c54b99590d499a1f189b80a73bc8'),
('FrankWilson', '5729f72976b43da8a52b24082a93c41417d37c6b9bd06cb423ffbc1b42ba30a0'),
('GraceDavis', 'ba26751aa5c168946cd88b393d7749d45291ce51051a6130027ee46921a004d7'),
('HenryBrown', 'fe474e9fc1760fb7adf455e6e3d7f35fba88f22de084cd3a6a66092dec41a756'),
('OrganisATeur', '58631c546f17836abc6b2a44bb4c4626f7adc7fd308bb9cde8b6ce3664d43519'),
('administrATeur', '24512bcb09d85acdf773ed4efe24b01cbb9fec9ddd345bbcccca92a76bbb3143'),
('aymen_adm_test', '35470f880448c205237e0a071dfc34c93f0e4289d6174fb112f123bc51947f88'),
('aymen_org_test', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
('test_orga', '32467666320e7224a90f47898407c017fe3dd44c535f1c923da8abcf80cfb81c'),
('testtest', '345083d79bbcd6b8d73c9eaca065dd1c6cd206c351b7fd3d51c20a9e44fb9d42'),
('tuxie', 'c52071294f899907b3e2ccea671dcef0a2c0f88cb7eca55825df66dab9a26a80'),
('vm34vm', '24512bcb09d85acdf773ed4efe24b01cbb9fec9ddd345bbcccca92a76bbb3143');

--
-- Déclencheurs `t_compte_cpt`
--
DELIMITER $$
CREATE TRIGGER `cryptage_mdp` BEFORE INSERT ON `t_compte_cpt` FOR EACH ROW BEGIN
    DECLARE salt VARCHAR(50);
    DECLARE hashed_password VARCHAR(64);

    SELECT sel INTO salt FROM le_sel;

    SET NEW.mdp_cpt = SHA2(CONCAT(salt, NEW.mdp_cpt), 256);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `modif_actu_orga` BEFORE DELETE ON `t_compte_cpt` FOR EACH ROW BEGIN
DECLARE leRole char(1);
set leRole = (SELECT role_pfl from t_profil_pfl where pseudo_cpt=old.pseudo_cpt);
	if leRole = 'O' then
        Delete from t_actualite_act 
        where pseudo_cpt = old.pseudo_cpt;
        UPDATE t_scenario_sce
        set pseudo_cpt="organisATeur"
        where pseudo_cpt=old.pseudo_cpt;
   	end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_etape_eta`
--

CREATE TABLE `t_etape_eta` (
  `id_eta` int(11) NOT NULL,
  `question_eta` varchar(200) NOT NULL,
  `reponse_eta` varchar(45) NOT NULL,
  `ressource_eta` varchar(100) NOT NULL,
  `code_eta` char(8) DEFAULT NULL,
  `intitule_eta` varchar(45) NOT NULL,
  `ordre_eta` int(11) NOT NULL,
  `id_sce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_etape_eta`
--

INSERT INTO `t_etape_eta` (`id_eta`, `question_eta`, `reponse_eta`, `ressource_eta`, `code_eta`, `intitule_eta`, `ordre_eta`, `id_sce`) VALUES
(4, 'Trouvez le nom du rappeur qui a sorti l\'album \'Illmatic\'.', 'Nas', 'Illmatic.jpg', 'D533298D', 'Étape d\'Introduction', 1, 2),
(5, 'Qui est le chanteur de la chanson de rap la plus streamée de tous les temps ?', 'lil nas X', 'oldtownroad.jpg', 'D5332AC7', 'Énigme Hip-Hop', 2, 2),
(6, 'Identifiez le producteur légendaire de hip-hop derrière le hit \"Still D.R.E.\".', 'dr. dre', 'Still_dre.jpg', 'D53386DC', 'Défi Final', 3, 2),
(7, 'Complétez les paroles : \"Toute ma vie j\'ai donnée aux autres c\'est ma...\"', 'faiblesse', 'lafeve.jpg', 'D5338956', 'Question de Démarrage', 1, 3),
(8, 'Nommez le duo français de musique électronique derrière l\'album \'Random Access Memories\'.', 'Daft Punk', 'daft_punk.jpg', 'D5338A94', 'Défi Électro', 2, 3),
(9, 'Quel festival de musique électronique est célèbre pour avoir lieu à Boom, en Belgique ?', 'Tomorrowland', 'tomorrowland.jpg', 'D5338CB1', 'Étape Finale', 3, 3),
(10, 'Trouvez le nom du dernier album de sch.', 'JVLIVS II', 'JVLIVS II.jpg', 'D5338E96', 'Étape de Démarrage', 1, 4),
(11, 'de quel groupe est nez nekfeu ?', 'S-crew', 's_crew.jpg', 'D5339023', 'Énigme de Rue', 2, 4),
(12, 'Quel est l\'album que gazo et tiakola on sortie en 2023?', 'kassav', 'kassav.jpg', 'D533911E', 'Défi Ultime', 3, 4),
(13, 'Qui est considéré comme le pionnier du hip-hop et est souvent appelé le \"Parrain du rap\" ?', 'DJ Kool Herc', 'DJKoolHerc.jpg', 'D5339206', 'Question d\'Entrée', 1, 5),
(14, 'Quel rappeur a sorti l\'album \'The Chronic\' en 1992 ?', 'Dr. Dre', 'dree.jpg', 'D53392E9', 'Énigme Rap', 2, 5),
(15, 'Qui est surnommé \'Slim Shady\' et est connu pour ses alter egos dans ses chansons ?', 'Eminem', 'ressource_question3.jpg', 'D53393D4', 'Question Finale', 3, 5),
(18, 'Quel rappeur a sorti l\'album \'Good Kid, M.A.A.D City\' en 2012 ?', 'Kendrick Lamar', 'KendrickLamar.jpg', 'D5339677', 'Étape M.A.A.D City', 4, 2),
(19, 'Identifiez le rappeur et producteur qui a sorti l\'album \'Rodeo\' en 2015.', 'Travis Scott', 'TravisScott.jpg', 'D5339755', 'Étape Rodeo', 5, 2),
(20, 'Quel rappeur est derrière l\'album \'Atrocity Exhibition\' sorti en 2016 ?', 'Danny Brown', 'Danny_Brown.jpg', 'D5339835', 'Étape Exhibition', 4, 3),
(21, 'donne un nom de rappeurs qui a sorti l\'album \'Run the Jewels 2\' en 2014 ?', 'El-P', 'El-P.jpg', 'D5339916', 'Étape Jewels', 5, 3),
(22, 'Quel rappeur a sorti l\'album \'Lifestylez ov da Poor & Dangerous\' en 1995 ?', 'Big L', 'BigL.jpg', 'D53399F9', 'Étape Lifestylez', 4, 4),
(23, 'Quel est le titre de la chanson de rap qui a gagné le Grammy Award de la Meilleure Chanson Rap en 2020 ?', 'A Lot', 'alot.jpg', 'D5339AD8', 'Étape Grammy', 5, 4),
(24, 'Quel rappeur est derrière l\'album \'XXX\' sorti en 2011 ?', 'Danny Brown', 'Danny_B.jpg', 'D5339BFE', 'Étape XXX', 4, 5),
(25, 'Quel groupe de rap est connu pour leur album \'17\' sorti en 2017?', 'XXXTentacion', '17.jpg', 'D5339CEA', 'Étape Marauders', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_indice_ind`
--

CREATE TABLE `t_indice_ind` (
  `id_ind` int(11) NOT NULL,
  `description_ind` varchar(200) NOT NULL,
  `difficulte_ind` varchar(45) NOT NULL,
  `lien_ind` varchar(100) NOT NULL,
  `id_eta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_indice_ind`
--

INSERT INTO `t_indice_ind` (`id_ind`, `description_ind`, `difficulte_ind`, `lien_ind`, `id_eta`) VALUES
(4, 'Cet album a été publié en 1994 et est largement considéré comme l\'un des meilleurs albums de rap de tous les temps.', 'Facile', 'https://fr.wikipedia.org/wiki/Illmatic', 4),
(5, 'Pour découvrir les secrets de \"Old Town Road\", regardez des vidéos en coulisses de l\'enregistrement.', 'Facile', 'https://www.rollingstone.fr/quel-est-le-secret-du-tube-old-town-road/', 5),
(9, 'Cet album a été publié en 1994 et est largement considéré comme l\'un des meilleurs albums de rap de tous les temps.', 'Moyen', 'https://fr.wikipedia.org/wiki/Nas_(rappeur)', 4),
(10, 'Pour découvrir les secrets de \"Old Town Road\", regardez des vidéos en coulisses de l\'enregistrement.', 'Moyen', 'https://fr.wikipedia.org/wiki/Lil_Nas_X', 5),
(14, 'Cet album a été publié en 1994 et est largement considéré comme l\'un des meilleurs albums de rap de tous les temps.', 'Difficile', 'https://www.google.fr/', 4),
(15, 'Pour découvrir les secrets de \"Old Town Road\", regardez des vidéos en coulisses de l\'enregistrement.', 'Difficile', 'https://www.google.fr/', 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_participant_par`
--

CREATE TABLE `t_participant_par` (
  `id_par` int(11) NOT NULL,
  `adresse_par` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_participant_par`
--

INSERT INTO `t_participant_par` (`id_par`, `adresse_par`) VALUES
(25, 'add@gmail.com'),
(15, 'adrien.fllr@gmail.com'),
(22, 'adriendzdz.fllr@gmail.com'),
(27, 'aymen_test_reussite2@gmail.com'),
(28, 'aymen_test_reussite4@gmail.com'),
(26, 'aymen_test_reussite@gmail.com'),
(2, 'jane.smith@example.com'),
(29, 'je@gmail.com'),
(1, 'john.doe@example.com'),
(3, 'mark.jackson@example.com'),
(5, 'michael.davis@example.com'),
(4, 'susan.wilson@example.com'),
(30, 'test@gmail.com'),
(31, 'vm343@titi.fr');

-- --------------------------------------------------------

--
-- Structure de la table `t_profil_pfl`
--

CREATE TABLE `t_profil_pfl` (
  `nom_pfl` varchar(45) DEFAULT NULL,
  `prenom_pfl` varchar(45) DEFAULT NULL,
  `role_pfl` char(1) NOT NULL,
  `etat_pfl` char(1) NOT NULL,
  `pseudo_cpt` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_profil_pfl`
--

INSERT INTO `t_profil_pfl` (`nom_pfl`, `prenom_pfl`, `role_pfl`, `etat_pfl`, `pseudo_cpt`) VALUES
('Miller', 'David', 'O', 'A', 'DavidMiller'),
('Jones', 'Emily', 'O', 'D', 'EmilyJones'),
('Wilson', 'Frank', 'O', 'D', 'FrankWilson'),
('Davis', 'Grace', 'O', 'D', 'GraceDavis'),
('Brown', 'Henry', 'O', 'D', 'HenryBrown'),
('Filer', 'Hadrian', 'O', 'A', 'OrganisATeur'),
('Fayer', 'Adrian', 'A', 'A', 'administrATeur'),
('aymen_adm_test', 'aymen_adm_test', 'A', 'A', 'aymen_adm_test'),
('aymen_org_test', 'aymen_org_test', 'O', 'A', 'aymen_org_test'),
('jsmith', 'savos', 'O', 'A', 'test_orga'),
('teste', 'letest', 'O', 'A', 'testtest'),
('blabla', 'blabla', 'O', 'D', 'tuxie'),
('vm', 'vm', 'O', 'A', 'vm34vm');

-- --------------------------------------------------------

--
-- Structure de la table `t_reussite_reu`
--

CREATE TABLE `t_reussite_reu` (
  `id_par` int(11) NOT NULL,
  `id_sce` int(11) NOT NULL,
  `dateFirstR_reu` datetime NOT NULL,
  `dateSecondR_reu` datetime DEFAULT NULL,
  `difficulte_reu` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_reussite_reu`
--

INSERT INTO `t_reussite_reu` (`id_par`, `id_sce`, `dateFirstR_reu`, `dateSecondR_reu`, `difficulte_reu`) VALUES
(4, 2, '2023-09-18 00:00:00', '2023-09-19 00:00:00', 'Intermédiaire'),
(4, 5, '2023-12-10 13:30:30', '2023-12-10 13:30:30', 'Facile'),
(5, 2, '2023-09-19 00:00:00', '2023-09-20 00:00:00', 'Expert'),
(31, 2, '2023-12-13 08:19:57', NULL, 'Facile');

--
-- Déclencheurs `t_reussite_reu`
--
DELIMITER $$
CREATE TRIGGER `after_insert_reussite` AFTER INSERT ON `t_reussite_reu` FOR EACH ROW BEGIN
    DECLARE joueur_nom VARCHAR(255);
    DECLARE actualite_texte VARCHAR(255);
	DECLARE intitule_scenario VARCHAR(255);
    SELECT adresse_par INTO joueur_nom FROM t_reussite_reu left join t_participant_par using(id_par) WHERE id_par = NEW.id_par limit 1;
	SELECT intitule_sce INTO intitule_scenario from t_reussite_reu left join t_scenario_sce using (id_sce) where id_par=new.id_par limit 1;
    SET actualite_texte = CONCAT('Félicitation ', joueur_nom, ' vous avez réussi le jeux ',intitule_scenario, ' !');

    INSERT INTO t_actualite_act (intitule_act, description_act, etat_act, date_act, pseudo_cpt)
    VALUES ('Nouvelle Réussite', actualite_texte, 'A', NOW(), 'administrATeur');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_scenario_sce`
--

CREATE TABLE `t_scenario_sce` (
  `id_sce` int(11) NOT NULL,
  `intitule_sce` varchar(100) NOT NULL,
  `code_sce` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description_sce` varchar(200) NOT NULL,
  `etat_sce` char(1) NOT NULL,
  `image_sce` varchar(100) NOT NULL,
  `pseudo_cpt` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_scenario_sce`
--

INSERT INTO `t_scenario_sce` (`id_sce`, `intitule_sce`, `code_sce`, `description_sce`, `etat_sce`, `image_sce`, `pseudo_cpt`) VALUES
(2, 'Enquête hip-hop', 'ENQHIP123', 'Plongez dans une enquête hip-hop où vous devez résoudre des énigmes liées à des paroles de rap et à des indices musicaux. Démêlez le mystère du flow perdu !', 'A', 'enquete_hiphop.jpg', 'EmilyJones'),
(3, 'Jeux à trou électro', 'ELECPUZ4', 'Testez vos connaissances en musique électronique avec des jeux à trous passionnants. Complétez les paroles des chansons électro et montrez que vous êtes un vrai fan !', 'A', 'jeux_trou_electro.jpg', 'GraceDavis'),
(4, 'Chasse au trésor musical', 'CHASSEMU', 'Participez à une chasse au trésor musicale à travers la ville. Suivez les indices, résolvez les énigmes et découvrez des lieux de musique hip-hop cachés.', 'A', 'chasse_tresor_musical.jpg', 'HenryBrown'),
(5, 'Quiz de culture rap', 'QUIZRAP101', 'Testez vos connaissances en culture rap avec un quiz interactif. Répondez à des questions sur les légendes du rap, les albums classiques et les origines du hip-hop !', 'A', 'quiz_culture_rap.jpg', 'FrankWilson'),
(6, 'Visubruit', '6541HFD8', 'Un jeux d\'ecoute, ecoute bien et complete correctement pour avancer', 'A', 'visubruit.jpg', 'DavidMiller'),
(37, 'or', 'ff45b70b', 'petit', 'A', 'grenouille.jpg', 'vm34vm');

-- --------------------------------------------------------

--
-- Structure de la vue `le_sel`
--
DROP TABLE IF EXISTS `le_sel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`e21803762sql`@`%` SQL SECURITY DEFINER VIEW `le_sel`  AS SELECT 'OnRajouteDuSelPourAllongerleMDP123!!45678__Test' AS `sel` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  ADD PRIMARY KEY (`id_act`),
  ADD KEY `fk_t_actualite_act_t_compte_cpt1_idx` (`pseudo_cpt`);

--
-- Index pour la table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  ADD PRIMARY KEY (`pseudo_cpt`);

--
-- Index pour la table `t_etape_eta`
--
ALTER TABLE `t_etape_eta`
  ADD PRIMARY KEY (`id_eta`),
  ADD UNIQUE KEY `code_eta` (`code_eta`),
  ADD KEY `fk_t_etape_eta_t_scenario_sce1_idx` (`id_sce`);

--
-- Index pour la table `t_indice_ind`
--
ALTER TABLE `t_indice_ind`
  ADD PRIMARY KEY (`id_ind`),
  ADD KEY `fk_t_indice_ind_t_etape_eta1_idx` (`id_eta`);

--
-- Index pour la table `t_participant_par`
--
ALTER TABLE `t_participant_par`
  ADD PRIMARY KEY (`id_par`),
  ADD UNIQUE KEY `UC_adresse_par` (`adresse_par`);

--
-- Index pour la table `t_profil_pfl`
--
ALTER TABLE `t_profil_pfl`
  ADD UNIQUE KEY `unique_pseudo_cpt` (`pseudo_cpt`);

--
-- Index pour la table `t_reussite_reu`
--
ALTER TABLE `t_reussite_reu`
  ADD PRIMARY KEY (`id_par`,`id_sce`),
  ADD KEY `fk_t_participant_par_has_t_scenario_sce_t_scenario_sce1_idx` (`id_sce`),
  ADD KEY `fk_t_participant_par_has_t_scenario_sce_t_participant_par1_idx` (`id_par`);

--
-- Index pour la table `t_scenario_sce`
--
ALTER TABLE `t_scenario_sce`
  ADD PRIMARY KEY (`id_sce`),
  ADD KEY `fk_t_scenario_sce_t_compte_cpt1_idx` (`pseudo_cpt`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  MODIFY `id_act` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `t_etape_eta`
--
ALTER TABLE `t_etape_eta`
  MODIFY `id_eta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `t_indice_ind`
--
ALTER TABLE `t_indice_ind`
  MODIFY `id_ind` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `t_participant_par`
--
ALTER TABLE `t_participant_par`
  MODIFY `id_par` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `t_scenario_sce`
--
ALTER TABLE `t_scenario_sce`
  MODIFY `id_sce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  ADD CONSTRAINT `fk_t_actualite_act_t_compte_cpt1` FOREIGN KEY (`pseudo_cpt`) REFERENCES `t_compte_cpt` (`pseudo_cpt`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `t_etape_eta`
--
ALTER TABLE `t_etape_eta`
  ADD CONSTRAINT `fk_t_etape_eta_t_scenario_sce1` FOREIGN KEY (`id_sce`) REFERENCES `t_scenario_sce` (`id_sce`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `t_indice_ind`
--
ALTER TABLE `t_indice_ind`
  ADD CONSTRAINT `fk_t_indice_ind_t_etape_eta1` FOREIGN KEY (`id_eta`) REFERENCES `t_etape_eta` (`id_eta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `t_profil_pfl`
--
ALTER TABLE `t_profil_pfl`
  ADD CONSTRAINT `fk_t_profil_pfl_t_compte_cpt` FOREIGN KEY (`pseudo_cpt`) REFERENCES `t_compte_cpt` (`pseudo_cpt`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_profil_pfl_t_compte_cpt1` FOREIGN KEY (`pseudo_cpt`) REFERENCES `t_compte_cpt` (`pseudo_cpt`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `t_reussite_reu`
--
ALTER TABLE `t_reussite_reu`
  ADD CONSTRAINT `fk_t_participant_par_has_t_scenario_sce_t_participant_par1` FOREIGN KEY (`id_par`) REFERENCES `t_participant_par` (`id_par`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_participant_par_has_t_scenario_sce_t_scenario_sce1` FOREIGN KEY (`id_sce`) REFERENCES `t_scenario_sce` (`id_sce`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
