# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Database: dvojcatanauteku
# Generation Time: 2016-06-28 17:35:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `content` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `date`, `content`)
VALUES
	(1,'2016-06-19 22:12:00','Tak jsem si pro ocenění dnešní dne všech OTCŮ musel dojet až do Olomouce i s celou rodinou. Ale výlet to byl krásný. Dvojčata byla uchvácená cestou, atrakcemi i deštěm, já jsem si těch 600 Km náležitě užil za volantem a má milovaná polovička se neustále usmívala, takže i pak, když nebylo sluníčko, všechno kolem ní zářilo ;-)'),
	(2,'2016-06-20 06:12:00','Z ničeho nic to začalo. Už od rána. Cokoli jsem udělal, bylo okomentováno, respektive slovně prozkoumáno.\n\"Tatínku a co to je? JAK SE TO MENUJE?!\" zkoumá dcera činnost obrušování zahradního nábytku, který posléze natřu.\n\"To je šmirgl papír,\" zamachroval jsem ve slangu smirkového papíru.\n\"Šmršgl papir,\" zopakovalo spokojeně dvojče.\n\"A proč to děláš?\" \nKrátce vše vysvětleno, spokojenost je doprovázena odchodem se houpat. Jdu jim tedy opravit hřiště, protože jejich váha jde nahoru a tím se začíná odpoutávat od země těžký přístřešek s pískovištěm a nerad bych, aby jednoho krásného houpání vše spadlo.\n\"Tatínků, já ti pomůžu!\" zase se vetře to samé dvojče a druhé mu chce mistrně sekundovat. Popadnou do ruky akuvrtačku a (bože!) kladivo.\n\"Tatínku a co to je?\" ukazuje prstem na vrtačku.\nZase kratší odpověď s názornou ukázkou, vyjmutí akubaterie a vrácení vrtačky (bez vrtáku) do rukou dcery, která začíná vrtat díky své vlastní, z úst se linoucí, zvukové kulise.\n\"Já ezmu to KLADAVO a budu ti pomáhat,\" nadšeně se vrhla na devastaci kolíku na zatlučení. Chvíle ticha mé drahé polovičky nebyla až tak matoucí, přeci jen si chtěla vypít odpolední kávu. A tak jsem naše dítko trochu poupravil.\n\"Ne, KLADIVO do ruky takovým malým pomocníkům NEPATŘÍ...\"\n\"Cože? Ona chtěla KLADIVO?\" téměř vstala má drahá.\n\"Ano, ci tlukat kladavem,\" hrdě se stále hlásila k manuální práci dcera. \n\"Kladivo,\" kantorsky zasáhla milá a dcera, k naší spokojenosti, slovo zopakovala dobře. Nu co, čekám, kdy se z našich dvojčat ozve to, z čeho jsme si my, jako malé děti dělaly někdy velkou legraci - \"A PROČ?\"'),
	(3,'2016-06-30 00:00:00','Dnes jsme byli nakoupit. Nic neobvyklého. Tak zkrátka do toho velkého nákupního dómu dojedeme, profrčíme čtyřicítkou mezi regály, já jako rozhodčí, dvojčata jako závodníci s modrými košíky. Dojedeme domů, všechno jako správná hospodyňka vyndám a holky mi ukořistí hned nákupní tašku. Chodily po bytě, kývaly se ze strany na stranu, zpívaly \"lalalalalááála\" a druhá se tomu vždy hrozně hihňala. No fakt. Mám k tomu i foto, aby mi konečně někdo věřil. Když se podívám nějaké dva roky dozadu, tak to dělaly také. Historie se opakuje...'),
	(4,'2016-06-28 18:40:54','Zkouška.');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table strings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `strings`;

CREATE TABLE `strings` (
  `code` varchar(32) NOT NULL DEFAULT '',
  `value` longtext,
  `type` varchar(16) NOT NULL DEFAULT 'plain',
  `description` tinytext,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `strings` WRITE;
/*!40000 ALTER TABLE `strings` DISABLE KEYS */;

INSERT INTO `strings` (`code`, `value`, `type`, `description`)
VALUES
	('page1_content','<img src=\"img/nohy.png\" style=\"width:300px\">','html','Obsah stránky 1'),
	('page1_h1','Dvojčata na útěku','plain','Hlavní nadpis stránky 1'),
	('page1_h2','Radim Keith','plain','Vedlejší nadpis stránky 1'),
	('page2_content','<p>Začalo jaro a s ním i nucené práce vykoupené krví a bolavými zády na vlastní zahrádce. Na zahrádku jsme vypustili i oba tygry. Běhají mezi krumpáčem, lopatou a hlínou a nedají se zkrotit. I ten řev našich dvojčat nasvědčuje tomu, že se po dalších pár měsíců nastěhovala zuřivá šelma na náš dvůr a jen tak se jí rozhodně nezbavíme. Co si holky ale oblíbily jsou domácí (rozuměj zahradní) zvířátka. Žádný krtek nebo hraboš, ale ke štěstí postačí žížala. Žížala je opečovávaná.</p>\n','html','Obsah stránky 2'),
	('page2_h1','','plain','Hlavní nadpis stránky 2'),
	('page2_h2','','plain','Vedlejší nadpis stránky 2'),
	('page3_content','<p>Zde bude možné si objednat knihu. Nyní sledujte stránku na <a href=\"https://www.facebook.com/dvojcatanauteku/\" target=\"_blank\">facebooku</a>.</p>','html','Obsah stránky 3'),
	('page3_h1','Kniha','plain','Hlavní nadpis stránky 3'),
	('page3_h2','Dvojčata na útěku','plain','Vedlejší nadpis stránky 3'),
	('page4_content','<p>Narodil se v roce 1978. V mládí krátce psal do místních novin jako sportovní redaktor a účastnil se literárních přehlídek (např. ocenění Novinář 97 KOLÍNSKÝCH NOVIN) nebo s kolegou vytvořil scénář pro divadelní komedii i hudební pohádku.</p>','html','Obsah stránky 4'),
	('page4_h1','<center>\n  <img src=\"img/radim.png\" /><br/>\n  BIO\n</center>','plain','Hlavní nadpis stránky 4'),
	('page4_h2','Radim Keith','plain','Vedlejší nadpis stránky 4'),
	('slides_count','4','number','Počet slajdů');

/*!40000 ALTER TABLE `strings` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
