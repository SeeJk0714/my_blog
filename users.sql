-- Adminer 4.8.0 MySQL 5.5.5-10.5.17-MariaDB-1:10.5.17+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `create_at`) VALUES
(1,	'rex',	'rex@gmail.com',	'$2y$10$GFEoowt7847cL3PPvEQXze177sYODqDcQ6XvgrnIdCaWyiNuQBGwm',	'2023-05-23 07:07:59'),
(2,	'denish',	'denish@gmail.com',	'$2y$10$6crn.9.SdhR2sHiqNzq1j.unPgrdUO.ZUgzIHM0TXmOgrqzeOCUlq',	'2023-05-23 07:14:10');

-- 2023-05-23 07:43:25
