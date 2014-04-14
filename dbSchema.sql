-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 14, 2014 at 06:08 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `vbs`
--
CREATE DATABASE IF NOT EXISTS `vbs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vbs`;

-- --------------------------------------------------------

--
-- Table structure for table `participantlist`
--

CREATE TABLE IF NOT EXISTS `participantlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kidID` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `address` text NOT NULL,
  `aptNum` text,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zipCode` text NOT NULL,
  `homePhone` text NOT NULL,
  `otherPhone` text,
  `emailAddress` text,
  `allergiesAndMedicalInfo` text,
  `emergencyContactName` text NOT NULL,
  `emergencyContactPhone` text NOT NULL,
  `emergencyContactRelationship` text NOT NULL,
  `primaryPickupName` text NOT NULL,
  `primaryPickupRelationship` text NOT NULL,
  `homeChurch` text,
  `dateOfBirth` text NOT NULL,
  `gradeJustCompleted` text,
  `tShirtSize` text,
  `signupTime` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kidID` (`kidID`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
