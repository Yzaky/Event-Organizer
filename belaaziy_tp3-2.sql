-- phpMyAdmin SQL Dump
-- version 4.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 14, 2015 at 05:38 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `belaaziy_tp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `organizer` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 NOT NULL,
  `type` enum('public','private') CHARACTER SET latin1 NOT NULL,
  `duration` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `organizer`, `name`, `description`, `type`, `duration`) VALUES
(32, 5, 'ysf', 'ysf', 'public', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_dates`
--

CREATE TABLE `event_dates` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_dates`
--

INSERT INTO `event_dates` (`id`, `event_id`, `date`, `start_time`, `end_time`) VALUES
(1, 1, '2012-12-06', '08:00:00', '22:00:00'),
(2, 1, '2012-12-07', '08:00:00', '22:00:00'),
(3, 1, '2012-12-08', '08:00:00', '22:00:00'),
(4, 2, '2013-01-13', '08:00:00', '15:00:00'),
(5, 2, '2013-01-14', '08:00:00', '15:00:00'),
(6, 2, '2013-01-15', '08:00:00', '15:00:00'),
(7, 2, '2013-01-16', '08:00:00', '15:00:00'),
(8, 6, '2012-12-24', '05:00:00', '14:00:00'),
(9, 7, '2012-12-25', '00:00:00', '23:00:00'),
(10, 8, '2015-04-12', '09:00:00', '09:00:00'),
(11, 8, '2015-04-12', '09:00:00', '09:00:00'),
(12, 8, '2015-04-12', '09:00:00', '09:00:00'),
(13, 8, '2015-04-12', '09:00:00', '09:00:00'),
(14, 9, '2015-04-13', '09:00:00', '09:00:00'),
(15, 9, '2015-04-13', '09:00:00', '09:00:00'),
(16, 9, '2015-04-13', '09:00:00', '09:00:00'),
(17, 9, '2015-04-13', '09:00:00', '09:00:00'),
(18, 9, '2015-04-13', '09:00:00', '09:00:00'),
(19, 9, '2015-04-13', '09:00:00', '09:00:00'),
(20, 9, '2015-04-13', '09:00:00', '09:00:00'),
(21, 10, '2015-04-14', '10:00:00', '15:00:00'),
(22, 11, '2015-04-20', '01:00:00', '06:00:00'),
(23, 12, '2015-04-14', '10:00:00', '11:00:00'),
(24, 13, '2015-04-27', '09:00:00', '21:00:00'),
(25, 14, '2015-04-20', '02:00:00', '02:00:00'),
(26, 15, '2015-04-21', '22:00:00', '23:00:00'),
(27, 16, '2015-04-21', '00:00:00', '01:00:00'),
(28, 17, '2015-04-20', '12:00:00', '22:00:00'),
(29, 18, '2015-04-27', '12:00:00', '15:00:00'),
(30, 19, '2015-04-26', '02:00:00', '04:00:00'),
(31, 20, '2015-04-28', '04:00:00', '11:00:00'),
(32, 21, '2015-04-26', '00:00:00', '01:00:00'),
(33, 22, '2015-04-26', '00:00:00', '01:00:00'),
(34, 23, '2015-04-14', '01:00:00', '02:00:00'),
(35, 24, '2015-04-27', '01:00:00', '05:00:00'),
(36, 25, '2015-04-29', '01:00:00', '05:00:00'),
(37, 26, '2015-04-30', '04:00:00', '04:00:00'),
(38, 27, '2015-04-21', '02:00:00', '02:00:00'),
(39, 28, '2015-04-21', '03:00:00', '16:00:00'),
(40, 29, '2015-04-28', '03:00:00', '03:00:00'),
(41, 30, '2015-04-30', '03:00:00', '05:00:00'),
(42, 31, '2015-04-20', '03:00:00', '05:00:00'),
(43, 32, '2015-04-20', '03:00:00', '05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`user_id`, `event_id`) VALUES
(5, 32),
(14, 32);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_date_id` int(11) NOT NULL,
  `reservation_time` time NOT NULL,
  `can_go` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `event_date_id`, `reservation_time`, `can_go`) VALUES
(25, 5, 21, '10:00:00', 1),
(26, 5, 21, '11:00:00', 1),
(27, 5, 21, '12:00:00', 1),
(28, 5, 21, '13:00:00', 1),
(29, 5, 21, '14:00:00', 1),
(33, 5, 23, '10:00:00', 1),
(37, 5, 24, '12:00:00', 1),
(38, 5, 24, '14:00:00', 1),
(39, 5, 24, '17:00:00', 1),
(41, 14, 29, '12:00:00', 0),
(44, 5, 29, '13:00:00', 0),
(45, 5, 29, '14:00:00', 1),
(54, 5, 36, '02:00:00', 1),
(55, 5, 36, '04:00:00', 1),
(56, 5, 33, '00:00:00', 1),
(57, 5, 35, '01:00:00', 1),
(58, 5, 35, '03:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `is_admin`) VALUES
(4, 'lapalme@iro.umontreal.ca', 'ac92e42ee79150dab054951bc737240d96300c24', 'Guy', 'Lapalme', 0),
(5, 'belaaziz_youssef@hotmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'youssef', 'belaaziz', 1),
(7, 'ahmad@hotmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'ahmad', 'ghazi', 0),
(14, 'florin@hotmail.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'florin', 'oncica', 0),
(18, 'abas@hotmail.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'abas', 'kalo', 0),
(19, 'leo@hotmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'leo', 'mimi', 0),
(20, 'omar@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'omar', 'halbouni', 0),
(21, 'crestien@hotmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'cris', 'jeloul', 0),
(22, 'joli@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'joli', 'bela', 0),
(25, 'lionel@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'leonel', 'aww', 0),
(28, 'edward@iro.umontreal.ca', 'f5e8a3f937be6650ed531dd25a06ce47fc9c83e0', 'edward', 'francoi', 0),
(29, 'joli@hotmail.com', 'b37f6ddcefad7e8657837d3177f9ef2462f98acf', 'kl', 'ko', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`), ADD KEY `organizer` (`organizer`);

--
-- Indexes for table `event_dates`
--
ALTER TABLE `event_dates`
  ADD PRIMARY KEY (`id`), ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`user_id`,`event_id`), ADD KEY `event_id` (`event_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `event_date_id` (`event_date_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `event_dates`
--
ALTER TABLE `event_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`organizer`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizer`) REFERENCES `users` (`id`);

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `invitations_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`event_date_id`) REFERENCES `event_dates` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
