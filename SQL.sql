-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2013 at 07:54 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `paper`
--
CREATE DATABASE `paper` DEFAULT CHARACTER SET ucs2 COLLATE ucs2_general_ci;
USE `paper`;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name` text CHARACTER SET latin1 NOT NULL,
  `x1` int(11) NOT NULL,
  `y1` int(11) NOT NULL,
  `x2` int(11) NOT NULL,
  `y2` int(11) NOT NULL,
  `widget` text CHARACTER SET latin1 NOT NULL,
  `opt` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `tmp`, `parent`, `name`, `x1`, `y1`, `x2`, `y2`, `widget`, `opt`) VALUES
(78, 1, 0, 's', 140, 16, 324, 42, 'none', 'a:1:{s:5:"hover";s:1:"0";}'),
(82, 1, 0, 'l', 377, 72, 444, 175, 'link', 'a:2:{s:4:"href";s:0:"";s:5:"hover";s:1:"1";}'),
(76, 28, 0, '1', 37, 23, 266, 48, 'input', 'a:2:{s:4:"name";s:5:"input";s:9:"direction";s:3:"RTL";}'),
(79, 28, 0, 'submit', 147, 305, 210, 341, 'submit', ''),
(80, 28, 0, 'sss', 109, 99, 261, 168, 'form', 'a:1:{s:3:"tmp";s:2:"29";}'),
(81, 1, 0, 'Hi', 183, 447, 242, 488, 'link', 'a:2:{s:4:"href";s:5:"salam";s:5:"hover";s:1:"1";}'),
(84, 30, 0, 'hi', 54, 37, 227, 67, 'input', 'a:3:{s:4:"name";s:2:"hi";s:4:"form";s:4:"form";s:9:"direction";s:3:"RTL";}'),
(85, 30, 0, 'submit', 84, 228, 156, 273, 'submit', ''),
(94, 1, 0, 'ss', 170, 61, 320, 120, 'link', ''),
(86, 30, 0, 'x', 10, 50, 46, 95, 'none', ''),
(87, 1, 0, 'Google', 31, 23, 122, 59, 'link', 'a:2:{s:4:"href";s:17:"http://google.com";s:5:"hover";s:1:"0";}'),
(88, 1, 0, 'hover', 387, 372, 459, 416, 'none', 'a:1:{s:5:"hover";s:1:"1";}'),
(89, 31, 0, 'MJS', 104, 3, 209, 38, 'link', 'a:2:{s:4:"href";s:14:"http://aaa.com";s:5:"hover";s:1:"0";}'),
(91, 31, 0, 'salam', 104, 229, 319, 256, 'input', 'a:3:{s:4:"name";s:3:"mmm";s:4:"form";s:3:"mmm";s:9:"direction";s:3:"RTL";}'),
(93, 1, 0, 'LLL', 70, 153, 306, 342, 'link', 'a:2:{s:4:"href";s:17:"http://google.com";s:5:"hover";s:1:"0";}');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `version` text NOT NULL,
  `title` text NOT NULL,
  `parent` int(11) NOT NULL,
  `css` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `version`, `title`, `parent`, `css`) VALUES
(1, 'Home_Page', '11', '', 0, 'body{background-color:#333;}\r\n#PapaDIV{text-align:center;margin-top:20px;\r\n}'),
(23, 'Form_TMPL', '', '', 0, ''),
(30, 'form_TMPL', '', '', 83, ''),
(31, 'M', '', '', 0, ''),
(28, 'form_TMPL', '', '', 75, ''),
(32, 'Hi', '', 'Bro', 0, ''),
(33, 'opps_TMPL', '', '', 95, '');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pathname` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `pathname`) VALUES
(1, 'None', 'none'),
(2, 'Link', 'link'),
(3, 'Form', 'form'),
(4, 'HTML', 'html'),
(5, 'InputBox', 'input'),
(6, 'Submit Button', 'submit');
