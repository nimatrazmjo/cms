# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.38)
# Database: cms
# Generation Time: 2015-12-08 06:13:20 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cms_artical
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_artical`;

CREATE TABLE `cms_artical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT 'title of th articals',
  `status` enum('a','b') DEFAULT 'a' COMMENT 'a:active b:Not active',
  `desc` longtext COMMENT 'details of the articals',
  `registerdate` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'registerdate of the artical',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='table for adding artical';

LOCK TABLES `cms_artical` WRITE;
/*!40000 ALTER TABLE `cms_artical` DISABLE KEYS */;

INSERT INTO `cms_artical` (`id`, `title`, `status`, `desc`, `registerdate`)
VALUES
	(1,'this is about me','a','<p>My name is nimatullah</p>\r\n\r\n<p>i studied Computer Science In India Under Pune Universities</p>\r\n\r\n<p>Currently I am Working as Software Developer in Afghanistan Development and Registery Services</p>\r\n\r\n<p>my Contact Number Is</p>\r\n\r\n<p>0093 77 888 0875</p>\r\n\r\n<p>My Email Address : <u>Nimatullah.razmjo@hotmail.com</u></p>\r\n','2013-03-30 17:03:47');

/*!40000 ALTER TABLE `cms_artical` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_attachment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_attachment`;

CREATE TABLE `cms_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL COMMENT 'file name which typed by user',
  `name` varchar(255) DEFAULT NULL COMMENT 'name  of the attachment',
  `size` varchar(35) DEFAULT NULL COMMENT 'size of the picture',
  `ext` varchar(10) DEFAULT NULL COMMENT 'extenstion of the images like.jpg.png...etc',
  `type` int(5) DEFAULT NULL COMMENT '1:slide show ,2:banner 3:logo 4:donate_right_side',
  `registerdate` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'registerdate of the picture',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='attachment for slide show';

LOCK TABLES `cms_attachment` WRITE;
/*!40000 ALTER TABLE `cms_attachment` DISABLE KEYS */;

INSERT INTO `cms_attachment` (`id`, `file_name`, `name`, `size`, `ext`, `type`, `registerdate`)
VALUES
	(1,'banner','image_8526_20130330172509','38.84','.jpg',2,'2013-03-30 17:03:09'),
	(2,'@rtretertertr','image_1020_20130330172550','13.73','.png',3,'2013-03-30 17:03:50'),
	(3,'donate write','image_2320_20130330172710','43.42','.jpg',4,'2013-03-30 17:03:10'),
	(4,NULL,'image_2536_20130331143552','17.98','.jpg',1,'2013-03-31 14:03:52'),
	(5,NULL,'image_9200_20130331143605','17.98','.jpg',1,'2013-03-31 14:03:05'),
	(6,NULL,'image_5265_20130331143612','50.83','.jpg',1,'2013-03-31 14:03:12'),
	(7,NULL,'image_8555_20130331143618','28.57','.jpg',1,'2013-03-31 14:03:18'),
	(8,NULL,'image_5645_20130331143628','39.48','.jpg',1,'2013-03-31 14:03:28');

/*!40000 ALTER TABLE `cms_attachment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_content`;

CREATE TABLE `cms_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT 'title of the content',
  `desc` text COMMENT 'descryption of the content',
  `status` varchar(255) DEFAULT NULL COMMENT 'a:active b:not active',
  `regdate` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'registerd date of the content',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='this table is used to store the content of websites';

LOCK TABLES `cms_content` WRITE;
/*!40000 ALTER TABLE `cms_content` DISABLE KEYS */;

INSERT INTO `cms_content` (`id`, `title`, `desc`, `status`, `regdate`)
VALUES
	(1,'POSITION DESCRIPTION Center for UPDATE Man','<p style=\"margin-left:1.5in;\"><strong>fd;slkf;ldsfksfkas</strong></p>\r\n\r\n<p style=\"margin-left:1.5in;\"><strong>fkasdfksakf;asfks;afklds;fksla</strong></p>\r\n\r\n<p style=\"margin-left:1.5in;\"><strong>dlkfsl</strong></p>\r\n\r\n<p style=\"margin-left:1.5in;\"><strong>adfksl</strong></p>\r\n\r\n<p style=\"margin-left:1.5in;\"><strong>dfksdaVacancy No:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 93/MSH/SPS/2013</p>\r\n\r\n<p><strong>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>Pharmaceutical Management Information System (PMIS) Officer</p>\r\n\r\n<p><strong>Reports to:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PMIS Advisor</p>\r\n\r\n<p style=\"margin-left:2.0in;\"><strong>Grade:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I</p>\r\n\r\n<p><strong>Location:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kabul, Afghanistan</p>\r\n\r\n<p><strong>Duration:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1 Year (extendable)</p>\r\n\r\n<p><strong>Sex:&nbsp;&nbsp;&nbsp;&nbsp; </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Male/Female</p>\r\n\r\n<p><strong>Organization:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MSH/SPS</p>\r\n\r\n<p><strong>Number of Post:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1</p>\r\n\r\n<p><strong>Posting Date: </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2 February, 2013</p>\r\n\r\n<p><strong>Closing Date: </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23 February, 2013</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>OVERALL RESPONSIBILITIES</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>PMIS Officer will support the PMIS Advisor and M&amp;E program manager in providing assistance to the Ministry of Public Health (MOPH) for commodity and patient number data collection, validation and entry into a fully accessible database. S/he will support the MOPH in their interactions between the database management operations and the data reporting centers and assist in achieving optimum data reporting rate and quality. The PMIS Officer will communicate with reporting centers and provide support to MOPH to facilitate smooth functioning of PMIS across the system.&nbsp; S/he will also be responsible to communicate changes in information requirements to the Database Developer.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>SPECIFIC RESPONSIBILITIES</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"margin-left:.25in;\">1.Assist the MOPH to keep track of the reports received from the reporting centers and follow-up through constant communication.</p>\r\n\r\n<p style=\"margin-left:.25in;\">2.Assist the PMIS Advisor in designing and presenting information that facilitates decision making (e.g., comparison of consumption among different geographical regions, morbidity vs medicine use pattern, cost of expiry, etc.).</p>\r\n\r\n<p style=\"margin-left:.25in;\">3.Assist Database developer and PMIS Officer to review, analyze, and validate data to ensure consistency, integrity and accuracy based on GDPA and MOPH specific guidelines</p>\r\n\r\n<p style=\"margin-left:.25in;\">4.Provide assistance in designing and conducting training programs on data management and analysis and use in management decision making.</p>\r\n\r\n<p style=\"margin-left:.25in;\">5.Provide assistance in standardizing data management procedures such as documentation for databases, data cleaning, confidentiality and protection of data.</p>\r\n\r\n<p style=\"margin-left:.25in;\">6.Perform other duties as assigned.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>QUALIFICATIONS</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"margin-left:.25in;\">1.Degree in computer science or information systems.</p>\r\n\r\n<p style=\"margin-left:.25in;\">2.Knowledge in database development and maintenance is required</p>\r\n\r\n<p style=\"margin-left:.25in;\">3.Experience with Afghanistan public health sector, especially in the area of medicine management, and familiarity with USAID project protocols is preferred.</p>\r\n\r\n<ol>\r\n	<li value=\"4\">Excellent verbal and written communication skills in English.</li>\r\n</ol>\r\n\r\n<p style=\"margin-left:.25in;\">5.Proven ability to work as part of a team. Ability to work independently, prioritize tasks and to take initiative.</p>\r\n\r\n<p style=\"margin-left:.25in;\">6.Demonstrated expert skills in Microsoft Office Suite applications, including Word, Excel, PowerPoint, and Outlook. Intermediate expertise in MS Access is strongly preferred.</p>\r\n\r\n<p style=\"margin-left:.25in;\">7.Knowledge of pharmaceuticals is an advantage.</p>\r\n\r\n<ol>\r\n	<li value=\"8\">Willingness to travel within Afghanistan.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em>Management Sciences for Health is an equal opportunity employer offering employment without regard to race, color, religion, sex, sexual orientation, age, national origin, citizenship, physical or mental handicap, or status as a disabled or Vietnam Era veteran of the U.S. Armed Forces.</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The application comprises of a one-page cover letter explaining your interest and suitability for the post and your CV+ Application. Internal interested Afghan Nationals should submit their applications to:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Human Resources Officer</p>\r\n\r\n<p>Management Sciences for Health (MSH)</p>\r\n\r\n<p>House # 24, Darulaman Road, Ayub Khan Meina,</p>\r\n\r\n<p>Near the Ministry of Commerce,</p>\r\n\r\n<p>Karte &ndash; Seh, Kabul, Afghanistan</p>\r\n\r\n<p>Email:&nbsp; <a href=\"mailto:frahmani@msh.org\">frahmani@msh.org</a></p>\r\n','a','2013-03-31 18:03:23'),
	(2,'#this is my first php','<p>fdsfdsafdsaf</p>\r\n\r\n<p>sf</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sd</p>\r\n\r\n<p>f</p>\r\n\r\n<p>ds</p>\r\n\r\n<p>fs</p>\r\n\r\n<p>d</p>\r\n','a','2013-03-31 17:03:23'),
	(3,'fdfasfadsfd','<p>fdsfdsfdsaf</p>\r\n','a','2013-03-31 17:03:33'),
	(4,'fsdfsdfds','<p>fsdaf</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>dsfdsfds</p>\r\n','a','2013-03-31 17:03:41'),
	(5,'ffewrwe','<p>fewrwerrwerwrerewrewrew</p>\r\n\r\n<p>r</p>\r\n\r\n<p>ewr</p>\r\n\r\n<p>ew</p>\r\n\r\n<p>rw</p>\r\n\r\n<p>er</p>\r\n\r\n<p>we</p>\r\n\r\n<p>re</p>\r\n','b','2013-03-31 17:03:01'),
	(6,'ewrkwerkew;lrk','<p>fkkf;jasd;fs</p>\r\n\r\n<p>afks;lfksdf;lksla</p>\r\n\r\n<p>;fks;</p>\r\n\r\n<p>afksafksa</p>\r\n\r\n<p>fksl</p>\r\n\r\n<p>afklsa</p>\r\n\r\n<p>kfl</p>\r\n','b','2013-03-31 17:03:16'),
	(7,'dfsdfdsfds','<p>fsdfsdfdsfdsfdsfdsfd</p>\r\n','a','2013-03-31 17:03:30'),
	(8,'fdsfdsfdsfds','<p>dsfdsfdsfdsfdsfdsfsdfdsf</p>\r\n','b','2013-03-31 17:03:41'),
	(9,'fdsfdsfdsfds','<p>fdsfsdfsdfdsfds</p>\r\n','b','2013-03-31 17:03:49'),
	(10,'fsdfsdfds','<p>fdsfdsfdsfdsfds</p>\r\n','b','2013-03-31 17:03:57'),
	(11,'dfskjgfdskjg;ldfjgdfs\'j','<p>vdsfvkjsd;flkjds;lfkds</p>\r\n','a','2013-03-31 17:03:12'),
	(12,'fdsfsdfdsfs','<p>ffsdfdsfds</p>\r\n\r\n<p>fsd</p>\r\n\r\n<p>fs</p>\r\n\r\n<p>df</p>\r\n\r\n<p>ds</p>\r\n\r\n<p>fsd</p>\r\n\r\n<p>&nbsp;</p>\r\n','a','2013-03-31 17:03:24'),
	(13,'cdsfdsklfjksjf','<p>fdsfdsfdsfdsfds</p>\r\n','','2013-03-31 17:03:35'),
	(14,'new list','<p>fsjaklfjsklfjas</p>\r\n\r\n<p>fskjf</p>\r\n\r\n<p>asfj</p>\r\n','a','2013-03-31 17:03:11');

/*!40000 ALTER TABLE `cms_content` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_menu`;

CREATE TABLE `cms_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto increment',
  `label` varchar(255) DEFAULT NULL COMMENT 'name of the menu',
  `link` varchar(255) DEFAULT NULL COMMENT 'link of the menu',
  `parent_id` varchar(255) DEFAULT NULL COMMENT 'id of parent menu for the submenu',
  `sort` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='cms menu';

LOCK TABLES `cms_menu` WRITE;
/*!40000 ALTER TABLE `cms_menu` DISABLE KEYS */;

INSERT INTO `cms_menu` (`id`, `label`, `link`, `parent_id`, `sort`)
VALUES
	(1,'Home','#','',NULL),
	(2,'About Me','#','',NULL),
	(3,'Our Projects',NULL,'',NULL);

/*!40000 ALTER TABLE `cms_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_menu_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_menu_link`;

CREATE TABLE `cms_menu_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(255) DEFAULT NULL COMMENT 'id of the menu',
  `link` varchar(255) DEFAULT NULL COMMENT 'link id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='used to show the menu';

LOCK TABLES `cms_menu_link` WRITE;
/*!40000 ALTER TABLE `cms_menu_link` DISABLE KEYS */;

INSERT INTO `cms_menu_link` (`id`, `menu_id`, `link`)
VALUES
	(1,'2','cms/home/readArtical/1');

/*!40000 ALTER TABLE `cms_menu_link` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_news`;

CREATE TABLE `cms_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT 'title of the news',
  `featured` int(5) DEFAULT '0' COMMENT '0:not featured 1:featured',
  `status` enum('a','b') DEFAULT 'a' COMMENT 'a:active,b:not active',
  `description` longtext COMMENT 'description of the news',
  `registerdate` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'registerdate of the news',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='this table is used to read the news from database';

LOCK TABLES `cms_news` WRITE;
/*!40000 ALTER TABLE `cms_news` DISABLE KEYS */;

INSERT INTO `cms_news` (`id`, `title`, `featured`, `status`, `description`, `registerdate`)
VALUES
	(1,'A Poison Tree',1,'a','<p>I was angry with my friend:<br />\r\nI told my wrath, my wrath did end.<br />\r\nI was angry with my foe:<br />\r\nI told it not, my wrath did grow.</p>\r\n\r\n<p>And I watered it in fears,<br />\r\nNight &amp; morning with my tears;<br />\r\nAnd I sunned it with smiles,<br />\r\nAnd with soft deceitful wiles.</p>\r\n\r\n<p>And it grew both day and night,<br />\r\nTill it bore an apple bright.<br />\r\nAnd my foe beheld it shine,<br />\r\nAnd he knew that it was mine,</p>\r\n\r\n<div>\r\n<p>And into my garden stole,<br />\r\nWhen the night had veild the pole;<br />\r\nIn the morning glad I see<br />\r\nMy foe outstretched beneath the tree.</p>\r\n</div>\r\n','2013-03-30 17:03:19'),
	(2,'System Requirements System Requirements',1,'a','<ul>\r\n	<li>PC with 300 megahertz or higher processor clock speed recommended; 233 MHz minimum required (single or dual processor system);* Intel Pentium/Celeron family, or AMD K6/Athlon/Duron family, or compatible processor recommended</li>\r\n	<li>128 megabytes (MB) of RAM or higher recommended (64 MB minimum supported; may limit performance and some features)</li>\r\n	<li>1.5 gigabytes (GB) of available hard disk space*</li>\r\n	<li>Super VGA (800 &times; 600) or higher-resolution video adapter and monitor</li>\r\n	<li>CD-ROM or DVD drive</li>\r\n	<li>Keyboard and Microsoft Mouse or compatible pointing device</li>\r\n</ul>\r\n\r\n<p align=\"center\"><strong>Additional Requirements</strong></p>\r\n\r\n<ul>\r\n	<li><strong>For Internet access:</strong>\r\n\r\n	<ul>\r\n		<li>Some Internet functionality may require Internet access, a Microsoft&nbsp;.NET Passport account, and payment of a separate fee to a service provider; local and/or long-distance telephone toll charges may apply</li>\r\n		<li>14.4 kilobits per second (Kbps) or higher-speed modem<br />\r\n		&nbsp;</li>\r\n	</ul>\r\n	</li>\r\n	<li><strong>For networking:</strong></li>\r\n	<li>Network adapter appropriate for the type of local-area, wide-area, wireless, or home network you wish to connect to, and access to an appropriate network infrastructure; access to third-party networks may require additional charges<br />\r\n	&nbsp;</li>\r\n	<li>Microsoft .NET Passport account and Internet access or Microsoft Exchange 2000 Server instant messaging account and network access (some configurations may require download of additional components)<br />\r\n	&nbsp;</li>\r\n	<li>33.6 Kbps or higher-speed modem, or a network connection</li>\r\n	<li>Microphone and sound card with speakers or headset<br />\r\n	&nbsp;</li>\r\n	<li>Video conferencing camera</li>\r\n	<li>Windows XP<br />\r\n	&nbsp;</li>\r\n	<li>33.6 Kbps or higher-speed modem, or a network connection</li>\r\n	<li>Windows XP<br />\r\n	&nbsp;</li>\r\n	<li>Both parties must be running Windows XP and be connected by a network<br />\r\n	&nbsp;</li>\r\n	<li>A Windows 95 or later&ndash;based computer, and the two machines must be connected by a network<br />\r\n	&nbsp;</li>\r\n	<li>Sound card and speakers or headphones<br />\r\n	&nbsp;</li>\r\n	<li>DVD drive and DVD decoder card or DVD decoder software</li>\r\n	<li>8 MB of video RAM<br />\r\n	&nbsp;</li>\r\n	<li>Video capture feature requires appropriate digital or analog video capture device</li>\r\n	<li>400 MHz or higher processor for digital video camera capture</li>\r\n	<li><strong>For instant messaging, voice and videoconferencing, and application sharing, both parties need:</strong></li>\r\n	<li><strong>For voice and videoconferencing, both parties also need:</strong></li>\r\n	<li><strong>For videoconferencing, both parties also need:</strong></li>\r\n	<li><strong>For application sharing, both parties also need:</strong></li>\r\n	<li><strong>For remote assistance:</strong></li>\r\n	<li><strong>For remote desktop:</strong></li>\r\n	<li><strong>For sound:</strong></li>\r\n	<li><strong>For DVD video playback:</strong></li>\r\n	<li><strong>For Windows Movie Maker:</strong></li>\r\n</ul>\r\n\r\n<p align=\"center\">* Actual requirements will vary based on your system configuration and the applications and features you choose to install. Additional available hard disk space may be required if you are installing over a network.</p>\r\n\r\n<p><strong>Pricing</strong></p>\r\n','2013-03-30 17:03:38');

/*!40000 ALTER TABLE `cms_news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_section
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_section`;

CREATE TABLE `cms_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'name of the section',
  `link` varchar(255) DEFAULT NULL COMMENT 'link of the section menu',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='this table is used for dividing of each page';

LOCK TABLES `cms_section` WRITE;
/*!40000 ALTER TABLE `cms_section` DISABLE KEYS */;

INSERT INTO `cms_section` (`id`, `name`, `link`)
VALUES
	(1,'menu','menu/home'),
	(2,'articals','artical/home'),
	(3,'News','news/home'),
	(4,'Picture','pic/home'),
	(5,'Menu Link','admin/home/menuLink'),
	(6,'Content','content/home'),
	(7,'Copy right','#');

/*!40000 ALTER TABLE `cms_section` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_table
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_table`;

CREATE TABLE `cms_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='it used to store the content of the websites';



# Dump of table cms_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_users`;

CREATE TABLE `cms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT 'username of the user',
  `Name` varchar(255) DEFAULT NULL COMMENT 'name of the user',
  `password` varchar(255) DEFAULT NULL COMMENT 'password of the user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='this table for the user who change the dashboard';

LOCK TABLES `cms_users` WRITE;
/*!40000 ALTER TABLE `cms_users` DISABLE KEYS */;

INSERT INTO `cms_users` (`id`, `username`, `Name`, `password`)
VALUES
	(1,'admin','Administrator','21232f297a57a5a743894a0e4a801fc3');

/*!40000 ALTER TABLE `cms_users` ENABLE KEYS */;
UNLOCK TABLES;

-- --------------------------------------------------------

--
-- Table structure for table `cms_copyright`
--

CREATE TABLE `cms_copyright` (
`id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_copyright`
--
ALTER TABLE `cms_copyright`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_copyright`
--
ALTER TABLE `cms_copyright`
