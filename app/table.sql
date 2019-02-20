-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL COMMENT 'how much was debited or credite',
  `type` char(1) NOT NULL COMMENT 'type of trxn',
  `name` varchar(100) NOT NULL COMMENT 'depositor',
  `details` text NOT NULL COMMENT 'reason for trxn',
  `account` varchar(100) NOT NULL COMMENT 'where it was paid to or deposited from',
  `trxn_ref` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'when it happened',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `token` mediumint(7) unsigned NOT NULL DEFAULT '0',
  `sent_at` datetime DEFAULT NULL,
  `valid` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table to store sms toekns and status';


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` text NOT NULL,
  `age` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) DEFAULT NULL,
  `account` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT '1',
  `type` enum('B','C') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2019-02-17 13:38:16