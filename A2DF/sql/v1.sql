SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `a2df` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `a2df`;

CREATE TABLE IF NOT EXISTS `appel` (
`idAppel` int(11) NOT NULL,
  `date` date NOT NULL,
  `idClient` int(11) NOT NULL,
  `idPersonnel` int(11) NOT NULL,
  `motif` varchar(300) CHARACTER SET latin1 NOT NULL,
  `idPriorite` int(11) NOT NULL,
  `traite` tinyint(1) NOT NULL,
  `commentaire` varchar(300) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

CREATE TABLE IF NOT EXISTS `atelier` (
`idAtelier` int(11) NOT NULL,
  `dateEntree` date NOT NULL,
  `idClient` int(11) NOT NULL,
  `idPriorite` int(11) NOT NULL,
  `typeProduit` int(11) NOT NULL,
  `marqueProduit` int(11) NOT NULL,
  `couleurProduit` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mdpProduit` varchar(50) CHARACTER SET latin1 NOT NULL,
  `probleme` varchar(300) CHARACTER SET latin1 NOT NULL,
  `solution` varchar(300) NOT NULL,
  `prix` float NOT NULL,
  `idTraitement` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

CREATE TABLE IF NOT EXISTS `charge` (
`idCharge` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `prix` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `client` (
`idClient` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cp` char(5) CHARACTER SET latin1 NOT NULL,
  `ville` varchar(100) CHARACTER SET latin1 NOT NULL,
  `courriel` varchar(50) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `portable` varchar(15) NOT NULL,
  `idType` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

CREATE TABLE IF NOT EXISTS `commande` (
`idCommande` int(11) NOT NULL,
  `dateBonCommande` date NOT NULL,
  `dateCommande` date NOT NULL,
  `typeProduit` varchar(50) NOT NULL,
  `marqueProduit` varchar(50) NOT NULL,
  `couleurProduit` varchar(50) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT '1',
  `idClient` int(11) NOT NULL,
  `prix` float NOT NULL,
  `acompte` int(11) NOT NULL,
  `idTraitement` int(11) NOT NULL,
  `traite` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

CREATE TABLE IF NOT EXISTS `comptabilite` (
  `TVA` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `etat` (
`idEtat` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `etat` (`idEtat`, `libelle`) VALUES
(1, 'Déclaré en panne'),
(2, 'En SAV'),
(3, 'Chez A2DF'),
(4, 'Retourné au client');

CREATE TABLE IF NOT EXISTS `fournisseur` (
`idFournisseur` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  `adresse` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cp` char(5) CHARACTER SET latin1 NOT NULL,
  `ville` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tel` char(10) CHARACTER SET latin1 NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `historique` (
  `idSAV` int(11) NOT NULL,
  `idEtat` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `marque` (
`idMarque` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=444 ;

INSERT INTO `marque` (`idMarque`, `libelle`) VALUES
(1, '3D Connexion'),
(2, '3D solut'),
(3, '3M'),
(4, 'Aastra'),
(5, 'Aavara'),
(6, 'Abus'),
(7, 'Acco'),
(8, 'Acer'),
(9, 'Acronis'),
(10, 'Adaptec'),
(11, 'Adder'),
(12, 'Adobe'),
(13, 'Adobe Licences'),
(14, 'AF'),
(15, 'AG Neovo'),
(16, 'Alcatel'),
(17, 'Alcatel Lucent'),
(18, 'Alvarion'),
(19, 'AMD'),
(20, 'Anfi'),
(21, 'Ansmann'),
(22, 'Antec'),
(23, 'Aoc'),
(24, 'APC'),
(25, 'Apple'),
(26, 'Arc créations'),
(27, 'Archos'),
(28, 'Armor'),
(29, 'Arnova by Archos'),
(30, 'Aruba'),
(31, 'Asus'),
(32, 'Aten'),
(33, 'Atrix'),
(34, 'Attachmate Group'),
(35, 'Atto'),
(36, 'Autodesk'),
(37, 'Autres fabricants'),
(38, 'Avanquest'),
(39, 'Avaya'),
(40, 'Aver'),
(41, 'Avermedia'),
(42, 'Avery'),
(43, 'Avocent'),
(44, 'Axel'),
(45, 'Axis'),
(46, 'Axtel'),
(47, 'Azenn'),
(48, 'Barco'),
(49, 'Be quiet'),
(50, 'Belkin'),
(51, 'Benq'),
(52, 'Bitdefender'),
(53, 'Bitdefender Licences'),
(54, 'Blackberry Rim'),
(55, 'Blue Mega'),
(56, 'Bluestork'),
(57, 'Bouygues Telecom Entreprises'),
(58, 'Brady'),
(59, 'Brocade'),
(60, 'Brodit'),
(61, 'Brother'),
(62, 'Buffalo'),
(63, 'Cables To Go'),
(64, 'Canon'),
(65, 'Case Logic'),
(66, 'Casio'),
(67, 'Celexon'),
(68, 'Checkpoint'),
(69, 'Cherry'),
(70, 'Chief'),
(71, 'Chip PC'),
(72, 'Cisco'),
(73, 'Cisco Meraki'),
(74, 'Cisco Small Business'),
(75, 'Citizen'),
(76, 'Citrix'),
(77, 'Compuprint'),
(78, 'Computer Associates'),
(79, 'Convac'),
(80, 'Cooler Master'),
(81, 'Corel'),
(82, 'Corsair'),
(83, 'Creative Labs'),
(84, 'Crosscall'),
(85, 'Crucial'),
(86, 'Cygnett'),
(87, 'D-Link'),
(88, 'Dacomex'),
(89, 'Datacard'),
(90, 'Dataflex'),
(91, 'Datalogic'),
(92, 'Datamax'),
(93, 'Dell'),
(94, 'Depaepe'),
(95, 'Devolo'),
(96, 'Dexlan'),
(97, 'Dialogic'),
(98, 'DIGI'),
(99, 'DLH Energy'),
(100, 'Doro Matra'),
(101, 'Durabook'),
(102, 'Dymo'),
(103, 'E-Pens'),
(104, 'Eaton Power Quality (MGE)'),
(105, 'Eboo solutions'),
(106, 'EBP'),
(107, 'EDP'),
(108, 'Eizo'),
(109, 'ELGATO'),
(110, 'Elo Touch'),
(111, 'Embarcadero'),
(112, 'EMC'),
(113, 'Energizer'),
(114, 'Energy France'),
(115, 'Engenius'),
(116, 'Epson'),
(117, 'Erard Pro'),
(118, 'Ergotron'),
(119, 'ESET'),
(120, 'Eurequat'),
(121, 'EUREX'),
(122, 'Europart'),
(123, 'Evolis'),
(124, 'Exabyte'),
(125, 'Expansys'),
(126, 'Extreme Networks'),
(127, 'F-Secure'),
(128, 'Facom'),
(129, 'Fargo'),
(130, 'Fellowes'),
(131, 'Fluke Networks'),
(132, 'France Prospect'),
(133, 'Freecom'),
(134, 'Fuji'),
(135, 'Fujitsu'),
(136, 'G data'),
(137, 'Garmin'),
(138, 'Garmin'),
(139, 'Gateway'),
(140, 'GCTO Calcomp'),
(141, 'Générique'),
(142, 'Giga-Byte'),
(143, 'Gigaset'),
(144, 'Glacialtech'),
(145, 'Glancetron'),
(146, 'GN Netcom'),
(147, 'Go lamp'),
(148, 'Google'),
(149, 'GoPro'),
(150, 'Grandstream'),
(151, 'Grd com'),
(152, 'Griffin'),
(153, 'Gyration'),
(154, 'Hama'),
(155, 'HANNSG'),
(156, 'Henge Docks'),
(157, 'Hercules'),
(158, 'HGST'),
(159, 'HID Global'),
(160, 'high point'),
(161, 'HIRSCHMANN'),
(162, 'Hitachi'),
(163, 'HKC Europe'),
(164, 'Honeywell'),
(165, 'HP'),
(166, 'HP Top Config'),
(167, 'HP Top Config Server'),
(168, 'HTC'),
(169, 'Huawei'),
(170, 'i2i'),
(171, 'IBM'),
(172, 'Icy box'),
(173, 'Ideal Industries Networks'),
(174, 'IER'),
(175, 'Ifrogz'),
(176, 'Igel'),
(177, 'Ihome'),
(178, 'Iiyama'),
(179, 'Imation'),
(180, 'Impact'),
(181, 'Incipio'),
(182, 'InFocus'),
(183, 'Infosec'),
(184, 'INMAC WSTORE'),
(185, 'Innes'),
(186, 'Integral Europe'),
(187, 'Intel'),
(188, 'Intermec'),
(189, 'Iogear'),
(190, 'Iomega'),
(191, 'Ipure'),
(192, 'IRIS'),
(193, 'Jabra'),
(194, 'Jawbone'),
(195, 'Jbl'),
(196, 'Jelt'),
(197, 'JVC'),
(198, 'Kanex'),
(199, 'Kaspersky'),
(200, 'Kaspersky Licences'),
(201, 'Kazam'),
(202, 'Kensington'),
(203, 'Kingston'),
(204, 'Kodak'),
(205, 'Konftel'),
(206, 'Konica-Minolta'),
(207, 'Koss'),
(208, 'Kyocera Document Solutions'),
(209, 'LaCie'),
(210, 'LapCabby'),
(211, 'LEBA Inovation'),
(212, 'Lenovo'),
(213, 'Lexar'),
(214, 'Lexmark'),
(215, 'LG Electronics'),
(216, 'Lifeproof'),
(217, 'LifeSize'),
(218, 'Lindy'),
(219, 'Linksys'),
(220, 'Logitech'),
(221, 'Lowepro'),
(222, 'Lumene'),
(223, 'Lycom'),
(224, 'Macally'),
(225, 'Maclocks'),
(226, 'Madcatz France'),
(227, 'MakerBot'),
(228, 'Maroo'),
(229, 'Matrox'),
(230, 'Mbp'),
(231, 'MCAD'),
(232, 'McAfee'),
(233, 'MCL Samar'),
(234, 'Mediatrix'),
(235, 'Mémoire Compatible'),
(236, 'Metapace'),
(237, 'Metrologic'),
(238, 'Micron Technology'),
(239, 'MicroScreen'),
(240, 'Microsoft'),
(241, 'Microsoft Licences'),
(242, 'Microsoft Surface'),
(243, 'Milestone'),
(244, 'Minicom'),
(245, 'Mio technology'),
(246, 'MISCO'),
(247, 'Mitacmio'),
(248, 'Mitel NetWork'),
(249, 'Mitsubishi'),
(250, 'Mobilis'),
(251, 'Mobility Lab'),
(252, 'Mobotix'),
(253, 'MonDSI.Com'),
(254, 'Moshi'),
(255, 'Motion Computing'),
(256, 'Motorola'),
(257, 'Mozy'),
(258, 'MSE'),
(259, 'MSI'),
(260, 'Multitech'),
(261, 'Multiware'),
(262, 'Mustek'),
(263, 'Mysoft'),
(264, 'Nashuatec'),
(265, 'Nasstor'),
(266, 'Native union'),
(267, 'Nec'),
(268, 'Nedis'),
(269, 'Neovo'),
(270, 'Neoware'),
(271, 'Netapp'),
(272, 'Netgear'),
(273, 'Newstar'),
(274, 'NG Office'),
(275, 'NGC'),
(276, 'Nikon'),
(277, 'Nitram'),
(278, 'Nokia'),
(279, 'Nortel'),
(280, 'Nova'),
(281, 'Nuance'),
(282, 'Nuance Licences'),
(283, 'NVidia'),
(284, 'OCE'),
(285, 'Octogone'),
(286, 'Oki'),
(287, 'Olivetti'),
(288, 'Olympus'),
(289, 'Omenex'),
(290, 'One-for-All'),
(291, 'Opticon'),
(292, 'Opticon'),
(293, 'Optoma'),
(294, 'Oracle'),
(295, 'Orange'),
(296, 'Orange Business Services'),
(297, 'Ordissimo'),
(298, 'Origin Storage Ltd'),
(299, 'OtterBOX'),
(300, 'Overland Storage'),
(301, 'Packard Bell'),
(302, 'Panasonic'),
(303, 'Parallels'),
(304, 'Parrot'),
(305, 'Pas-Lab'),
(306, 'Patchsee'),
(307, 'PDP'),
(308, 'Peerless'),
(309, 'Pelikan'),
(310, 'Pelikan Hardcopy Production AG'),
(311, 'Pentax'),
(312, 'Philips'),
(313, 'Photofast'),
(314, 'Pioneer'),
(315, 'Pixika'),
(316, 'Planet'),
(317, 'Plantronics'),
(318, 'Plecom'),
(319, 'Plus'),
(320, 'Plustek'),
(321, 'PNY'),
(322, 'Polycom'),
(323, 'Port'),
(324, 'PowerDsine'),
(325, 'Primera'),
(326, 'Printronix'),
(327, 'Procolor'),
(328, 'Projecta'),
(329, 'Promethean'),
(330, 'Psion'),
(331, 'Qnap'),
(332, 'Qualtec'),
(333, 'Quantum'),
(334, 'Quark'),
(335, 'Raidsonic'),
(336, 'Red Hat'),
(337, 'Reference Devis'),
(338, 'Revolabs'),
(339, 'Ricoh'),
(340, 'Riso'),
(341, 'Rittal'),
(342, 'ROADEYES Cam'),
(343, 'Roccat'),
(344, 'Routledge'),
(345, 'RTE network'),
(346, 'Sagemcom'),
(347, 'Samsonite'),
(348, 'Samsung'),
(349, 'Sandberg'),
(350, 'Sandisk'),
(351, 'Sanford écriture'),
(352, 'Sanyo'),
(353, 'SAP'),
(354, 'Sapphire'),
(355, 'Scott'),
(356, 'Seagate'),
(357, 'Seasonic'),
(358, 'Secu 4'),
(359, 'Seetec'),
(360, 'Seiko'),
(361, 'Sennheiser'),
(362, 'Services logiciels'),
(363, 'SFR'),
(364, 'Sharp'),
(365, 'Siemens'),
(366, 'Sitecom'),
(367, 'Smart technologie'),
(368, 'SMC'),
(369, 'SMS'),
(370, 'Snom'),
(371, 'Socket'),
(372, 'Sony'),
(373, 'Sony Ericsson'),
(374, 'Sophos'),
(375, 'Speck products'),
(376, 'Spire'),
(377, 'SQP'),
(378, 'SQP'),
(379, 'Startech'),
(380, 'Storex'),
(381, 'Stormshield'),
(382, 'Supporter'),
(383, 'Symantec'),
(384, 'Symantec Licences'),
(385, 'Symbol'),
(386, 'Synology'),
(387, 'Tally Genicom'),
(388, 'Tandberg Data'),
(389, 'Tangent'),
(390, 'Targus'),
(391, 'Tech Air'),
(392, 'Technofire'),
(393, 'Terra'),
(394, 'TERRATEC'),
(395, 'Texas Instruments'),
(396, 'Thecus'),
(397, 'Thomson'),
(398, 'ThrustMaster'),
(399, 'Tiptel'),
(400, 'TomTom'),
(401, 'Toshiba'),
(402, 'Tp link'),
(403, 'Transcend'),
(404, 'Trend Micro'),
(405, 'Trendnet'),
(406, 'Tucano'),
(407, 'Twelve South'),
(408, 'Tytech'),
(409, 'Ubiquiti'),
(410, 'Urban Factory'),
(411, 'US-Robotics'),
(412, 'V7'),
(413, 'Varta'),
(414, 'Veeam'),
(415, 'Veit'),
(416, 'Velleman'),
(417, 'Verbatim'),
(418, 'Videotec'),
(419, 'Viewsonic'),
(420, 'Vips'),
(421, 'Vision'),
(422, 'Visiosat'),
(423, 'Vivitek'),
(424, 'VMWare'),
(425, 'Vogel?s'),
(426, 'Volktek'),
(427, 'Wacom'),
(428, 'Watchguard'),
(429, 'Western-Digital'),
(430, 'Wiko Mobile'),
(431, 'WStore Services'),
(432, 'Wyse'),
(433, 'Xerox'),
(434, 'Xtrememac'),
(435, 'Y-cam'),
(436, 'Zavio'),
(437, 'Zebra'),
(438, 'ZETES'),
(439, 'ZipLinq'),
(440, 'Zotac'),
(441, 'Zyxel'),
(442, 'zzz BM Divers'),
(443, '');

CREATE TABLE IF NOT EXISTS `materiel` (
`idMateriel` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

INSERT INTO `materiel` (`idMateriel`, `libelle`) VALUES
(1, 'Autre'),
(2, 'DD Interne'),
(3, 'DD Externe'),
(4, 'Imprimante'),
(5, 'Moniteur'),
(6, 'PC Tour'),
(7, 'PC Portable'),
(8, 'Tablette'),
(9, 'Smartphone'),
(10, '');

CREATE TABLE IF NOT EXISTS `personnel` (
`idPersonnel` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cp` char(5) CHARACTER SET latin1 NOT NULL,
  `ville` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tel` char(10) CHARACTER SET latin1 NOT NULL,
  `salaire` float NOT NULL,
  `idStatut` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `priorite` (
`idPriorite` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `priorite` (`idPriorite`, `libelle`) VALUES
(1, 'Normal'),
(2, 'Important'),
(3, 'Urgent');

CREATE TABLE IF NOT EXISTS `sav` (
`idSAV` int(11) NOT NULL,
  `typeProduit` varchar(50) NOT NULL,
  `marqueProduit` varchar(50) NOT NULL,
  `couleurProduit` varchar(50) NOT NULL,
  `mdpProduit` varchar(50) NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `session` (
`idSession` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `session` (`idSession`, `login`, `mdp`) VALUES
(1, 'direction', '57077e98504c8948f5cf8fde85ac095816ddf412'),
(2, 'accueil', '63acf559f5523599c7ef4acc843b0ba1d91f7653'),
(3, 'atelier', '37300a0f64fdbddca5bd7a0f1164ecde537915ac');

CREATE TABLE IF NOT EXISTS `traitement` (
`idTraitement` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `traitement` (`idTraitement`, `libelle`) VALUES
(3, 'Termine'),
(1, 'Nouveau'),
(2, 'En cours'),
(4, 'Client prévenu'),
(5, 'Rendu au client');

CREATE TABLE IF NOT EXISTS `type` (
`idType` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `type` (`idType`, `libelle`) VALUES
(1, 'Client'),
(2, 'Professionnel');

CREATE TABLE IF NOT EXISTS `vente` (
`idVente` int(11) NOT NULL,
  `dateVente` date NOT NULL,
  `dateLivraison` date NOT NULL,
  `typeProduit` varchar(50) NOT NULL,
  `marqueProduit` varchar(50) NOT NULL,
  `couleurProduit` varchar(50) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  `acompte` int(11) NOT NULL,
  `idTraitement` int(11) NOT NULL,
  `traite` int(11) NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

ALTER TABLE `appel`
 ADD PRIMARY KEY (`idAppel`);

ALTER TABLE `atelier`
 ADD PRIMARY KEY (`idAtelier`);

ALTER TABLE `charge`
 ADD PRIMARY KEY (`idCharge`);

ALTER TABLE `client`
 ADD PRIMARY KEY (`idClient`);

ALTER TABLE `commande`
 ADD PRIMARY KEY (`idCommande`);

ALTER TABLE `etat`
 ADD PRIMARY KEY (`idEtat`);

ALTER TABLE `fournisseur`
 ADD PRIMARY KEY (`idFournisseur`);

ALTER TABLE `historique`
 ADD PRIMARY KEY (`idSAV`,`idEtat`), ADD KEY `idEtat` (`idEtat`);

ALTER TABLE `marque`
 ADD PRIMARY KEY (`idMarque`);

ALTER TABLE `materiel`
 ADD PRIMARY KEY (`idMateriel`);

ALTER TABLE `personnel`
 ADD PRIMARY KEY (`idPersonnel`);

ALTER TABLE `priorite`
 ADD PRIMARY KEY (`idPriorite`);

ALTER TABLE `sav`
 ADD PRIMARY KEY (`idSAV`);

ALTER TABLE `session`
 ADD PRIMARY KEY (`idSession`);

ALTER TABLE `traitement`
 ADD PRIMARY KEY (`idTraitement`);

ALTER TABLE `type`
 ADD PRIMARY KEY (`idType`);

ALTER TABLE `vente`
 ADD PRIMARY KEY (`idVente`);

ALTER TABLE `appel`
MODIFY `idAppel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
ALTER TABLE `atelier`
MODIFY `idAtelier` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
ALTER TABLE `charge`
MODIFY `idCharge` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `client`
MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
ALTER TABLE `commande`
MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
ALTER TABLE `etat`
MODIFY `idEtat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `fournisseur`
MODIFY `idFournisseur` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `marque`
MODIFY `idMarque` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=444;
ALTER TABLE `materiel`
MODIFY `idMateriel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
ALTER TABLE `personnel`
MODIFY `idPersonnel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `priorite`
MODIFY `idPriorite` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `sav`
MODIFY `idSAV` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `session`
MODIFY `idSession` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `traitement`
MODIFY `idTraitement` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE `type`
MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `vente`
MODIFY `idVente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
