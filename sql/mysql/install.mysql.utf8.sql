CREATE TABLE IF NOT EXISTS `#__emailform` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `phone` varchar(255) NOT NULL,
    `postnumber` varchar(255) NOT NULL,
    `residencesize` varchar(255) NOT NULL,
    `message` text NOT NULL,
    `pagetitle` varchar(255) NOT NULL, 
    `ipaddress` varchar(255) NOT NULL,
    `browser` varchar(255) NOT NULL,
    `os` varchar(255) NOT NULL,
    `screenresolution` varchar(255) NOT NULL,
    `referrerurl` varchar(255) NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
