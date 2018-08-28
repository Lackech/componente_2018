DROP TABLE IF EXISTS `#__congreso`;
DROP TABLE IF EXISTS `#__congreso_author`;
DROP TABLE IF EXISTS `#__congreso_author_ref`;

CREATE TABLE IF NOT EXISTS `#__congreso` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(25) NOT NULL,
	`catid` INT(11) NOT NULL DEFAULT '0',
	`description` VARCHAR(25) NOT NULL,
	`link` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)

)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;



CREATE TABLE IF NOT EXISTS `#__congreso_author` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25) NOT NULL,
	`biography` text,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

CREATE TABLE IF NOT EXISTS `#__congreso_author_ref` (
	`id`				INT(11)			NOT NULL AUTO_INCREMENT,
	`linkid`		INT(11)			NOT NULL DEFAULT '0',
	`autid`			INT(11)			NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE KEY `r_linkid` (`linkid`,`autid`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

