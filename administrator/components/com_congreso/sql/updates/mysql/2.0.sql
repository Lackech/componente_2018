DROP TABLE IF EXISTS `#__contentitem_tag_map`;
DROP TABLE IF EXISTS `#__congreso`;
DROP TABLE IF EXISTS `#__congreso_author`;

CREATE TABLE IF NOT EXISTS `#__congreso` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(25) NOT NULL,
	`autid` INT(11)     NOT NULL DEFAULT '0',
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