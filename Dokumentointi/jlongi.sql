SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;




CREATE TABLE IF NOT EXISTS `ainekset` (
  `ainesID` int(11) NOT NULL AUTO_INCREMENT,
  `nimi` varchar(255) NOT NULL,
  `alkoholiprosentti` int(11) NOT NULL,
  `yksikko` varchar(255) NOT NULL,
  PRIMARY KEY (`ainesID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;



CREATE TABLE IF NOT EXISTS `drinkki` (
  `drinkkiID` int(11) NOT NULL AUTO_INCREMENT,
  `drinkkinimi` varchar(255) NOT NULL,
  `tyyppi` varchar(255) NOT NULL,
  `lasi` varchar(255) NOT NULL,
  `lisaaja` varchar(255) NOT NULL,
  `ohjeet` varchar(1000) NOT NULL,
  PRIMARY KEY (`drinkkiID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;



CREATE TABLE IF NOT EXISTS `kayttajat` (
  `kayttajaID` int(11) NOT NULL AUTO_INCREMENT,
  `kayttaja` varchar(10) NOT NULL,
  `salasana` varchar(40) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `admin` int(1) NOT NULL,
  PRIMARY KEY (`kayttajaID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;



CREATE TABLE IF NOT EXISTS `kommentti` (
  `kommenttiID` int(11) NOT NULL AUTO_INCREMENT,
  `kayttajaID` int(11) NOT NULL,
  `drinkkiID` int(11) NOT NULL,
  `kommentti` text NOT NULL,
  PRIMARY KEY (`kommenttiID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;



CREATE TABLE IF NOT EXISTS `raaka_ainekset` (
  `drinkkiID` int(11) NOT NULL,
  `ainesID` int(11) NOT NULL,
  `maara` int(11) NOT NULL,
  PRIMARY KEY (`drinkkiID`,`ainesID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
