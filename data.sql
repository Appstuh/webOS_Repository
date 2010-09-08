-- phpMyAdmin SQL Dump
-- version 3.1.4
-- http://www.phpmyadmin.net
--
-- Host: 10.2.0.34
-- Generation Time: Sep 08, 2010 at 04:02 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `root`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(9) NOT NULL,
  `ipaddr` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `accessApp`
--

CREATE TABLE IF NOT EXISTS `accessApp` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(9) NOT NULL,
  `ipaddr` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `appid` varchar(255) NOT NULL,
  `ver` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `id` int(3) NOT NULL auto_increment,
  `user` varchar(7) NOT NULL,
  `token` varchar(55) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `pkgs`
--

CREATE TABLE IF NOT EXISTS `pkgs` (
  `appid` varchar(255) NOT NULL,
  `ver` varchar(10) NOT NULL,
  `section` varchar(40) NOT NULL,
  `arch` varchar(5) NOT NULL,
  `maintainer` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `title` varchar(30) NOT NULL,
  `updated` int(11) NOT NULL,
  `bin` varchar(255) NOT NULL,
  `permit` text NOT NULL,
  PRIMARY KEY  (`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
