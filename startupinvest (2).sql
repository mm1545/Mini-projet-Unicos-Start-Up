-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 28 avr. 2024 à 22:43
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `startupinvest`
--

-- --------------------------------------------------------

--
-- Structure de la table `capital_risque`
--

DROP TABLE IF EXISTS `capital_risque`;
CREATE TABLE IF NOT EXISTS `capital_risque` (
  `id_capital_risque` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `CIN` varchar(10) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `pwrd` varchar(20) NOT NULL,
  PRIMARY KEY (`id_capital_risque`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `capital_risque`
--

INSERT INTO `capital_risque` (`id_capital_risque`, `nom`, `prenom`, `email`, `CIN`, `pseudo`, `pwrd`) VALUES
(11, 'Ben Ali', 'Mohamed', 'mohamed.benali23@gmail.com', '12345678', 'mohamedB', 'Ali1234#'),
(12, 'Bouazizi', 'Fatima', 'fatima.bouazizi555@gmail.com', '23456789', 'fatimaB', 'Bouazizi1$'),
(13, 'Ghannouchi', 'Ahmed', 'ahmed.ghannouchi52@outlook.com', '34567890', 'ahmedG', 'Ghannouchi#'),
(14, 'Souissi', 'Amina', 'aminasouissi7441@yahoo.com', '45678901', 'aminaS', 'Souissi123#'),
(15, 'Cherif', 'Sami', 'sami487cherif@gmail.com', '56789012', 'samiC', 'Cherif@2022#'),
(16, 'Khadhraoui', 'Leila', 'leila.khadhraoui333@yahoo.com', '67890123', 'leilaK', 'Khadhraoui12$'),
(17, 'Ben Youssef', 'Ahmed', 'ahmedbenyoussef20@egmail.com', '78901234', 'ahmedBY', 'BenYoussef123#'),
(18, 'Mabrouk', 'Salma', 'salma.mabrouk147@outlook.com', '89012345', 'salmaM', 'Mabrouk@2023#'),
(19, 'Nasri', 'Karim', 'karim.nasri111@gmx.fr', '90123456', 'karimN', 'Nasri1234$'),
(20, 'Saidi', 'Yasmine', 'yasmine.saidi22@egmail.com', '01234567', 'yasmineS', 'Saidi2024#');

-- --------------------------------------------------------

--
-- Structure de la table `capital_risque_projet`
--

DROP TABLE IF EXISTS `capital_risque_projet`;
CREATE TABLE IF NOT EXISTS `capital_risque_projet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_projet` int NOT NULL,
  `id_capital_risque` int NOT NULL,
  `nombre_actions_achetees` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projet` (`id_projet`),
  KEY `id_capital_risque` (`id_capital_risque`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `capital_risque_projet`
--

INSERT INTO `capital_risque_projet` (`id`, `id_projet`, `id_capital_risque`, `nombre_actions_achetees`) VALUES
(1, 5, 20, 1000),
(3, 6, 20, 1200),
(4, 5, 20, 1200),
(8, 6, 20, 1500),
(9, 9, 20, 400),
(10, 6, 20, 1200),
(11, 7, 20, 200);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `id_projet` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nombre_actions_a_vendre` int NOT NULL,
  `nombre_actions_vendues` int NOT NULL,
  `prix_action` float NOT NULL,
  `id_startuper` int NOT NULL,
  PRIMARY KEY (`id_projet`),
  KEY `id_startuper` (`id_startuper`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `titre`, `description`, `nombre_actions_a_vendre`, `nombre_actions_vendues`, `prix_action`, `id_startuper`) VALUES
(1, 'Projet Alpha', 'Le Projet Alpha vise à développer une plateforme de commerce électronique révolutionnaire, offrant une expérience utilisateur immersive et intuitive. Avec une interface conviviale, des fonctionnalités avancées de recherche et des options de personnalisation étendues, cette plateforme ambitionne de redéfinir les normes du commerce en ligne.', 1000, 200, 25, 17),
(2, 'Projet Beta', 'Le Projet Beta consiste en la création d\'une application mobile innovante pour le suivi et la gestion de la santé mentale. Avec des fonctionnalités telles que la journalisation des émotions, les rappels de médicaments et la connectivité avec des professionnels de la santé, cette application vise à promouvoir le bien-être mental et à faciliter l\'accès aux services de santé.', 800, 150, 30.5, 14),
(3, 'Projet Gamma', 'Le Projet Gamma propose le développement d\'une solution logicielle de gestion des ressources humaines destinée aux petites et moyennes entreprises. Avec des modules pour le suivi des congés, la gestion des performances et la planification des effectifs, cette solution offre une approche intégrée pour optimiser la gestion du capital humain.', 1200, 300, 20.75, 15),
(4, 'Projet Delta', 'Le Projet Delta ambitionne de créer un système de gestion de la chaîne d\'approvisionnement basé sur la blockchain. En utilisant la technologie distribuée de la blockchain, ce système vise à améliorer la transparence, la traçabilité et l\'efficacité dans la gestion des flux de marchandises et des transactions commerciales.', 1500, 500, 15.25, 16),
(5, 'Projet Épsilon', 'Le Projet Épsilon envisage de construire une plateforme de crowdfunding décentralisée, permettant aux créateurs de lever des fonds pour leurs projets sans intermédiaires traditionnels. Grâce à l\'utilisation de contrats intelligents et de mécanismes de gouvernance communautaire, cette plateforme offre une alternative transparente et sécurisée au financement traditionnel.', 900, 100, 35.99, 18),
(6, 'Projet Zêta', 'Le Projet Zêta propose le développement d\'un système de gestion de l\'énergie intelligente pour les bâtiments commerciaux. En intégrant des capteurs IoT, des algorithmes d\'analyse de données et des contrôles automatisés, ce système vise à optimiser la consommation d\'énergie, à réduire les coûts et à minimiser l\'empreinte carbone.', 400, 600, 18.5, 22),
(7, 'Projet Êta', 'Le Projet Êta a pour objectif de concevoir une application de réalité augmentée pour l\'industrie du tourisme. En fournissant des expériences immersives et interactives aux utilisateurs, cette application vise à enrichir les visites touristiques en proposant des informations contextuelles, des guides virtuels et des itinéraires personnalisés.', 1300, 600, 22.75, 21),
(8, 'Projet Thêta', 'Le Projet Thêta consiste en la création d\'une plateforme de formation en ligne spécialisée dans les technologies émergentes. Avec des cours sur l\'intelligence artificielle, la blockchain, l\'IoT et d\'autres domaines, cette plateforme vise à former la prochaine génération de professionnels de la technologie et à répondre à la demande croissante de compétences numériques.', 1400, 700, 28, 19),
(9, 'Projet Iota', 'Le Projet Iota vise à développer un système de gestion de la relation client (CRM) sur mesure pour les petites entreprises. En offrant des fonctionnalités telles que la gestion des contacts, le suivi des ventes et le marketing automatisé, ce système aide les entreprises à améliorer leur efficacité opérationnelle et à mieux comprendre leurs clients.', 1000, 300, 19.99, 20),
(10, 'Projet Kappa', 'Le Projet Kappa ambitionne de construire une plateforme d\'échange de cryptomonnaies sécurisée et conviviale. En mettant l\'accent sur la sécurité, la liquidité et l\'expérience utilisateur, cette plateforme vise à faciliter l\'accès aux marchés de la cryptomonnaie et à promouvoir l\'adoption de cette nouvelle classe d\'actifs.', 1800, 800, 24.5, 23),
(14, 'tiiiiitre', 'descriiiiption', 700, 0, 1000.8, 16);

-- --------------------------------------------------------

--
-- Structure de la table `startuper`
--

DROP TABLE IF EXISTS `startuper`;
CREATE TABLE IF NOT EXISTS `startuper` (
  `id_startuper` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `CIN` varchar(10) NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nom_entreprise` varchar(30) NOT NULL,
  `adresse_entreprise` varchar(50) NOT NULL,
  `numero_registre_commerce` varchar(20) NOT NULL,
  `photo` longblob NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `pwrd` varchar(20) NOT NULL,
  PRIMARY KEY (`id_startuper`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `startuper`
--

INSERT INTO `startuper` (`id_startuper`, `nom`, `prenom`, `CIN`, `email`, `nom_entreprise`, `adresse_entreprise`, `numero_registre_commerce`, `photo`, `pseudo`, `pwrd`) VALUES
(14, 'Fathi', 'Ammar', '16034964', 'ammar.fathi38@gmail.com', 'ABC', '12 Rue Habib Bourguiba, Tunis', 'A1234567890', 0x6d6f68616d65645f70686f746f2e6a7067, 'mohamedB', 'Abcd1234$'),
(15, 'Houda', 'Rami', '52034248', 'rami.houdaf1@yahoo.com', 'XYZ', '24 Avenue de la Liberté, Sfax', 'B2345678901', 0x666174696d615f70686f746f2e6a7067, 'fatimaB', 'Bouazizi1$'),
(16, 'Khaled', 'Leila', '44336061', 'leilakhaled4b5@gmx.fr', 'DEF', '36 Boulevard Habib Bourguiba, Tunis', 'C3456789012', 0xffd8ffe000104a46494600010100000100010000ffdb0084000a0708121512181214121518181818181812121818121818181c1818191a181818181c212e251c1e2b1f181a2638262b2f313535351c243b403b343f2e343531010c0c0c100f101a12121a34212425343434343434343431343431353434343134343434343434343434343434343431313434343434343435343f313434343f34ffc000110800e100e103012200021101031101ffc4001c0000010501010100000000000000000000000102030405070608ffc40040100002010203040509060503050000000001020003110412210531415106617181910713223242a1b1c1d15262728292f01423a2b2e13443f1337393b3c2ffc400190101010101010100000000000000000000000102030405ffc4002111010100020300030100030000000000000001021103213112415171132232ffda000c03010002110311003f00e9914448b36858421014474688e1014458458042116010848abd65452ccc140d4926c04096233002e6794da7d3bc1d2bd9cb917d141d7bccf17d21f288d5414a685148d03100eef6adc3abb3ae67e51af8574ac4f48b0a84835574d0dae478ee9513a678126c6ba8edbdbc45e70badb46a39f4d99adb81d147e103403b24b4defcfc6fee33173adcc257d0f82da146a8bd2aa8e3eeb2b7c25ab4f9de906539918ab0d43292a475f31dd3d5ec4e9ce328d92a91593efdf3dba9c6fef113927d978afd3aec2666c8db94312a0a37a56b943a30facd49d2597c73b2cf442116104210804211602421080421081522c6c5942c20210144708822c0745110474022c48340a7b5368d3c3d3352a30007bcf003999c83a45d25ab89a86e4aa0f56983a0ede6dfbe72c74e7a407118934d0ff2e912abc99868cdf21d9d7307074c04351b76b96ff1fdf19c33cb7d3be18ebb50ae093aefe03f7dd28e3d329b71f6a69e110b333f05d7b49dd2bd4c2b11720dc9bfbccccad59b515ccbbb553c394b786704eefac5a344ea8c377ef48d6a6cac2c4c6f66ac6c61803a5c1ea3e89f19a94f66822fae9eeff1d9e13170559af6600f51dc7abaa7a3c0629775f2db8370eabf09cb275c4da14ead270f4decc355d746fa1f719d1fa33d215c4ae475c95546abc1adbcafd2788aa88e35162378dc475fbb849f6362d56aa163c6d9c6fea3db3586765673c258ea108da6d700f311d3d6f188b08402108b012103080908b0814a28891650a20202101c2288823840511c2245101650db78914f0d56a1f6119bc0683c65f9e63ca2391b3aa5b8e507f5099cbc59dd715a04b137e3a9ed63ff001e32f6d77c89e6c7016fac830eb9541e24827b87f8926d34cd55579b09e6b5e98b783c395a6abc5bd23e049f72dbf34bd86c1dc2df9807c64af4acc3f0bdbff1a0f94d2c053b823919cf2c9e8c318c9c7eca2a3ce28dc7eb32f1785b58f0d190f51de3bbe73a37f081908e77f899e6369e0f2a143ecb5c7619264b96119b4f67dc683f665ec2e1c9173bd779fafc2686c64d15ad716cac25fc4617cdd4cebaab0d7af81bf5c9f25f8467d24f46dcb775750ea99f89434d832faa4ea391ea9ab5d321ccbaa9d2dcbaa53ab66ba93bf507ab81ed07432cae794d3a1744368f9da0013764f44f67b27e5dd37a734e87e28d3c52aeb95c146039ef07c47be74b9ebe3cb78bc7c98eb2116109d1cc4210804210804210814611978b7943c458d0628301e2384608e101e2384688e1009e6fca025f6755eac87fad47ce7a4132fa5185353055e9aef28c5475afa43e1337c5c7d70b7dc3b47c25a64be213b54fba56ae6cb7fbca3c65fc36ae8fd487fa47d27972f1ebc7d7a0c453b32f63dff4093eca5d4c315a38eab1f70fa43000ab8e5c673b371e8c5e9b0eb6d3f7be51dbdb3b3d32c3d61efea9a949374b4501163248b6bc4ecd392d986877f519eac618544baef1bc73e46415766293a8d3eb1d41970ec3f98a54e85491984cebb37f8a7576693716ed130369601e99b5b4de87e20f68f84f6adb52931f4483d922dad8515291394dc0b8b8d6e04d4c6c66ddced81d1050d5d6fd7e2351fbea9d2273ee895226b2bdb8ebd475179d0a7af87fe5e2e69ac842109d5c44210804210804210819978a0c8ef16f289018f06440c783024531e2460c78301e23846831c202881101144838974df67a52a95553d557d072dcd6eebdbba50d99ad00c37a9b785fea26bf4ed58e3312a38146b730512ffbea997b0980a6ea78da79b2ef6f5c966bf8dbc454a8eca540d554efea9350d9f8ab663511795f59995b16c8be8fac059656a1fc439ce6a3826f94fa4403716f575b764931dba5cb51eb70b8fae86ceeac06f204d9c06d1577201be930f1986fe42d446a8ed73e8365ce16fe882e0004db81bf74cae8c5674c4946dd9b4f8cc658eab78ddba3e257d1bdeda6f9e4f1f8bc3d37d467637bdf7766ed67adc5599472d2f3ca62b64867617d09f4465161a588d778373bf9c93dec92e9670bb6682004d3c834058a655f4802b7620017074b9d66fd2ae1d7fc4cdc16ccb5334c9cc1b2e6b81a8550aabc8280374d4c36155172a8b002c00dc3b04de5a97a666f5dfac8e8fd1c8ce07b2f6feb379eca79ed96967a839d4b8f1d7e73d0cebc3e579f9fe842109d9e710842010842010842063de2831978a0ca1e0c9019108e0604ca63c191ac7a981209209129920301c22c411d20e7be52b0195d314a3d7192a75e5b95f716fd33c56069857651b8eabe13b0f4a3661c4611e92faf60f4cfdf4d40efd57f34e40c4ab8623506ce0f020d8f66e338e73576f571df963fc68a510c26b6ccc2e4d6c3bc4c9a4e55ad377095aeb69c72ba7ab092c4bb4aa964b70f098bb3942d40dd737b134ae849d2d3c9d2c516a9a68b7201e763be665db5648e9b866cc8248b441e129ecc73e6c69da64cf8964d48badf53cafba2d4d5f17d120efc222d50c2e22017335fc73bd7751e013d307ef331ecd6d3624387c304d6f73ce4d3d1863719dbc7cb94cb2e842109d1c84211602422c480421081840c708c11c251208e5918922c0914c904884916048b245912c91604823a3563a404c4c6f4530752a1aaf4fd33a9b33052df68a836bdf59b706dd164beacb678e3b8f4c8e47224781b1f84d1d96fa89436ad547af5321b8151f29e6a5b7f89f7cb18019aaa2036d359e4cfd7d0e2ba8f418eb1a4473169e3ce15c5955771b83357a418fa949bcd84cc38d9803d8257c06d2bebe6cdfbc9efd26718e9bdde9ebb61b5514c23a85246fbef9acb497215de0efbea4cf3f86dad5081fcb7b81a595be2749a5877acf62c720e20104f8da5d1963676b7416c2c0ffc4b7861e90edbf84a94a88563626d6d0124ea4ebbe696093daee1f3978e6f270e5cb58d5a84213d6f088421008b1210161010300842103cf031c0c608e06512031eb2311eb0255922c8964ab02458f58c58f5812ac511ab144074c3e97ed8186c2bb0367705290fbc46addc35f0936dadbf4b0eb66399c8f4692fac7f17d91d67baf396edec557c4b9a954f0b228f550700a3f7be72cf393afb75e3e3b977f4c7a559b2861bf5b75d89d3bef35f058bd56a2ef1bc71b7d44c9a54ce40397ecc9298286e2f63afd679f6f5eb4dcda55fcebe6e601ff2259d949622e3eb3169b11623513d06cf75b03c0c9e358dede970c14e9af64d5a7b87c26761516c086bcd2a22e6c38e91374cef5dd4894cb3587799a6ab6161194a985161de79c7cf4e18fc63c39e7f2a21084e8e6210840211610089161012116103cd831e0c8818e06512a9922c894c7a98132992ac89648902658f590bd45452eec1540bb3310001cc93a09e0ba4de5368d3069e0ed55f779e37f34a79af173d961d67740f67b5ba4384c2e5188c42532deaa9b962071caa09b75cf2db43ca050acde6b095d45f4351ae8c7a915c0f1df38b63b1352ad46a952a33bb1bb5463727fc756e12002672ee6a378ea5dd9b766c3eca24e662493a927527ac98fc66ce1948b4e6db0fa538ac35823e741fed3dd96df74ef5ee36ea9edf03d36c2d7195ef45f939053b9c7cc09e3cf8b2977ebdb872e37af19630e56a65238cd11b3efc343ee32dd6c2e77cca41d01522d63dff0039ad83a20a836edf9ccedbd69854f65b21cc012bed01ecf581c44dac3ecb056e34ec9b185c38b49d2885ddba5959c94f67e0b293726dca6ee013d2dda01f19569d8709a5824b2df9fc06e9d38e6f270e5bfeab108427a9e51084201084580421080421080421081e5818f06440c729944ea648b2153245302759e4fa59d3ca185052894ab5ee41406e94edbcb91c7ee8d7b252f28bd2bfe1a97f0f45bf9f506ac0eb4d0e85bf11dc3bcf017e3889ce4b574dcdb1b7f198a6cd5ab171bd69db2a2fe141a77efeb992ce77100776f8f59215be86150db48c2b250b636f03029208408a0911f9219205dd9db56ad037a751939aef43ceea74f74f65b17a7a55c79fa432b5854743fd790ee36df63af29e08538f5a6666e18e5ec6f1cf2c7caee3b33a4b8377c8b59035ec51fd06bf506dfda2e26f3b0b5fdf3e7da6a5d32ef741e8f3741a91d6cbbc735bfd9179309b46bd3ffa75aa20fb2aee17f4836339de1fcae9fe6fd8ef6ae002c77004f84b5b036ad1c4e1d2b517cc8c05bed0e6ac3830371dd381627a438c7521b1356dd4e53bce5b5e5fd81b5abe1c38a151919867f46d666404b12a459aeb9b7f54de18fc58cf2993e8084f09d13e9ead6228e2b2a39d12a8d11cf0561ec375ee3d5a5fde4e8e248422c00421080421080421080421081e4418f532b86922b4a2c2990ed1da34f0f45eb5460111493a8b93c147324e8041aaaaa976202a82ccc770005c93dd38974bfa4b531b58d8914909f329d5bb3b0e2c7dc34e775ba199b4f68bd7acf5ea1bbbb163c97928ea02c0764855a44ab255132d265324590ac954ca1ceb71d7bc4728b8062068e4e3db7f180058b9619a28680a0458d318440991ca90ca482082ac378237112d6269ab28ac8000c72d441b91ed7200fb0c2ecbdebeccceb99361f14509d2eac32ba7da5bdf4e4c08b83cc40d1d8bb37f8835e981765c354741cd90a6503c6d20c1622c51f7faa6dcedbc1ea3f3973a37b4461318951f5a6c32b541a5d1f4cf6ea2351c0a91bc49ba61b3061b1472dbcdd6bd4a446e04faea3bcdc7530e531f2d65a74f8ef1dcfa55c45308cc80dc03a1e6bbd4f7820f7ce8be4eba5ecccb82c43df4b61ea31d74ff006d89dfa6e3ddca73baa735347e3628ddab6b1fd2547e59551b5ec9b737d311278ff269b6ea62708cb558b3d27c9e70ef6520142c7891a8bf509ec2192c21080448b080421080421081e2034915a570d23c5631292354a8c15545d98fef53d528c0f295b48d3c179b536359829e7947a4de3603be725a696f9cf43d2ee927f195132a154a79825cfa4d9ad7661b87aa2c260033355208a22288e510a708f11b1c250b1e0fefbe20116dbbbfe500cf16c223a486e44227b91d71c083ba4095f9c90329fac07de1a42ddf1192fb8c2ae61943af9a3c4de993c1ce96bf26b01db94f0337e82b633663d06b9ab8521e95fd6c963e8f75987e99e3c542a6c774f79d077cd8af38355ab4ea254e5e713231bfe252afdacdc8cc673adfe37c57bd7ebc9ec9c46747a7ed5b3af6a5effd25fdd11b7c6edba270b8f755d007ccbcac75b766f11f96e2dde25c6ee6d9ca6ad8e8fe466a9cd8aa77d2d49add77a83e53a94e55e45dbf998a1f728fc5eff19d566992c210841084201084202422c2073e0d3c1794bda04b52c3026d6351c7337ca9e166f19ee434f09e52825e89ff0072ce2ff745b7fe63a77c557860248b2312559152288e11ab16f00263d6444c929ca89960e6c57bfe51408dac7d251d47e5f4854b78c648b9a2668431a8c89a811ba580d1615545475e1264c529dfa19281237a0a785a04ae8184ddf277b5168e3452a9ea55f4549f66a00c29b77e664fce394f2e33a1e6258ca8f6e046e61a112525d5db4fa65552b635dd082a342dc348dc4d45ba303eb2211f95721f7a186d239ed5adabdfce7fdc16ce7f35c3fe63ca262e8de9d36fbacbfa5d8fc1c449a9a5cafcaedd07c90e5f3f88237b534247639d7df3aace1fe49f145768ad327d7a7513c007ff00e276f959a58448b08210840210840210840e681a731e9be2b3e31d7822aa0edb666f7b5bba74acd38de36be7aaf53edbbb7ea627e71551a8922c6a8922c8a5106808da92869327a32b3196f0d4eea6416500949deeec797a23bb7fbe462b323daf7d3e3235308b3e7847ad61224223c9128941063809006ea92a13024531e24768e17e2214f640458caac854e92da9838bc225c1d50caf4cf11997f1202dfdb9fc65d55be194fd9aae3b9d2991fd8d32518a3ad402f958365e763aaf78d3be6be25052a6e80dd7cfa9a6df690d2ce8dde9514f7c0bdd021936b61ff1b8f1a6e3e73bf4e1bd00a19f69e19c7b39d9bf2d37b7bc89dca0a4842108584484058448405844840e558aff00a6ff0081bfb4ce36bc2108aa9963c421229636b6e8420452f61371ec84220a18bf5cf60f846ac21089d23f8c484aa997746b42108929cb3c224214a23a108432aee9afb57fd2d0ec4ffd29084a37fc95ff00af4fc0ff00d8676b84242921084208b08404842100842103ffd9, 'ahmedG', 'Ghannouchi#'),
(17, 'Ines', 'Mohamed', '74076968', 'mohamed.inesd39@gmail.com', 'GHI', '48 Rue de la République, Sousse', 'D4567890123', 0x616d696e615f70686f746f2e6a7067, 'aminaS', 'Souissi123#'),
(18, 'Amine', 'Sana', '08437876', 'sanaamine88@outlook.com', 'JKL', '60 Avenue Habib Bourguiba, Bizerte', 'E5678901234', 0x73616d695f70686f746f2e706e67, 'samiC', 'Cherif@2022#'),
(19, 'Sarra', 'Mehdi', '93626966', 'mehdi.sarrac4@yahoo.com', 'MNO', '72 Rue Ahmed Bey, Monastir', 'F6789012345', 0x6c65696c615f70686f746f2e6a7067, 'leilaK', 'Khadhraoui12$'),
(20, 'Ahmed', 'Monia', '02971502', 'monia.ahmeddba@gmail.com', 'PQR', '84 Avenue Mohamed V, Kairouan', 'G7890123456', 0x61686d6564795f70686f746f2e6a7067, 'ahmedBY', 'BenYoussef123#'),
(21, 'Lina', 'Ali', '13815882', 'ali.lina4129d@gmail.com', 'STU', '96 Rue Tahar Sfar, Gabès', 'H8901234567', 0x73616c6d615f70686f746f2e6a7067, 'salmaM', 'Mabrouk@2023#'),
(22, 'Yassine', 'Imen', '35758271', 'imenyassine03@outlook.com', 'VWX', '108 Avenue Habib Bourguiba, Nabeul', 'I9012345678', 0x6b6172696d5f70686f746f2e706e67, 'karimN', 'Nasri1234$'),
(23, 'Nadia', 'Amina', '55064249', 'amina.nadia854@outlook.com', 'YZI', '120 Rue Ali Belhouane, Tataouine', 'J0123456789', 0x7961736d696e655f70686f746f2e706e67, 'yasmineS', 'Saidi2024#');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `capital_risque_projet`
--
ALTER TABLE `capital_risque_projet`
  ADD CONSTRAINT `capital_risque_projet_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `capital_risque_projet_ibfk_2` FOREIGN KEY (`id_capital_risque`) REFERENCES `capital_risque` (`id_capital_risque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`id_startuper`) REFERENCES `startuper` (`id_startuper`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
