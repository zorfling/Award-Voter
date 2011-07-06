-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2011 at 08:47 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
USE `awards`;
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `award_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`award_id`, `name`) VALUES
(1, 'Vader'),
(2, 'Firefighter');

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

CREATE TABLE IF NOT EXISTS `rounds` (
  `round_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `round_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`round_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rounds`
--

INSERT INTO `rounds` (`round_id`, `round_date`) VALUES
(1, '2011-07-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `round_awards`
--

CREATE TABLE IF NOT EXISTS `round_awards` (
  `round_id` int(10) unsigned NOT NULL,
  `award_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`round_id`,`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `round_awards`
--

INSERT INTO `round_awards` (`round_id`, `award_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `round_users`
--

CREATE TABLE IF NOT EXISTS `round_users` (
  `round_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`round_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `round_users`
--

INSERT INTO `round_users` (`round_id`, `user_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `first_name`, `surname`, `email`, `password`, `is_admin`) VALUES
('admin', 'Admin', 'User', 'chrisc@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 1),
('lcarmichael', 'Lucy', 'Carmichael', 'lucy@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('rdwyer', 'Ryan', 'Dwyer', 'ryan@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('zmeherhomji', 'Zal', 'Meher-Homji', 'zal@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('klines', 'Kieran', 'Lines', 'kieran@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('ctaylor', 'Chris', 'Taylor', 'chris@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('afinden', 'Adam', 'Finden', 'adam@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('ccolborne', 'Chris', 'Colborne', 'chrisc@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('ataylor', 'Andrew', 'Taylor', 'andrew@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('ncrowe', 'Nathan', 'Crowe', 'nathan@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('tcox', 'Tyson', 'Cox', 'tyson@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('rlines', 'Rowan', 'Lines', 'rowan@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('mbertrand', 'Michael', 'Bertrand', 'michael@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('hsingleton', 'Henry', 'Singleton', 'henry@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('sarraiol', 'Sandy', 'Arraiol', 'sandy@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('jsmadja', 'Jerome', 'Smadja', 'jerome@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('ngay', 'Nickolas', 'Gay', 'nick@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0),
('dsisodia', 'Dhruv', 'Sisodia', 'dhruv@brightlabs.com.au', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `vote_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `round_id` int(10) unsigned NOT NULL,
  `award_id` int(10) unsigned NOT NULL,
  `voter_user_id` int(10) unsigned NOT NULL,
  `votee_user_id` int(10) unsigned NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

