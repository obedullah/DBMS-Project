-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2013 at 07:40 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `obtrs`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `count_available_seats`( bus_id int, departure_date date ) RETURNS int(11)
begin
	declare total int;
	declare booked int default 0;
	declare available int;
	select capacity from bus where busid=bus_id into total;
	select sum(no_of_seats) from ticket where busid=bus_id and departuredate=departure_date into booked;
	if booked IS NULL then
		set booked=0;
	end if;
	set available= total-booked;
	return available;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `find_if_exists`( email varchar(40) ) RETURNS int(11)
begin
	declare found int;
	set found = 0;
	select count(*) from user where email_id=email into found;
	return found;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `busid` int(11) NOT NULL AUTO_INCREMENT,
  `busregno` varchar(10) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `bustype` varchar(20) DEFAULT NULL,
  `fare` int(11) DEFAULT NULL,
  PRIMARY KEY (`busid`),
  UNIQUE KEY `busregno` (`busregno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`busid`, `busregno`, `capacity`, `bustype`, `fare`) VALUES
(100, 'dl123', 40, 'AC', 40),
(101, 'sd345', 40, 'AC', 40),
(102, 'jk987', 40, 'NON AC', 25),
(103, 'bvn439', 40, 'NON AC', 30),
(104, 'pol981', 40, 'AC', 50),
(105, 'xzc561', 40, 'AC', 50),
(106, 'mkl321', 40, 'NON AC', 20),
(107, 'yrc503', 40, 'AC', 50),
(108, 'asd298', 40, 'NON AC', 25),
(109, 'lpx888', 40, 'NON AC', 25),
(110, 'ppp777', 40, 'AC', 40),
(111, '992iooi', 40, 'AC', 40),
(112, 'uuu666', 40, 'NON AC', 30),
(113, 'lll333', 40, 'NON AC', 15),
(114, 'ghf594', 2, 'NON AC', 50),
(115, 'jsfHKLJLKS', 40, 'AC', 234);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE IF NOT EXISTS `complaint` (
  `userid` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `comp_date` date DEFAULT NULL,
  `msg` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`userid`, `username`, `comp_date`, `msg`) VALUES
(1, 'A', '2013-11-19', 'seahbtrttttgggggggggggggggggggggggggttttjufguvtujukiugtkyukuygkiyu6hkyukhkyiuhkiuyk5ihuk,iukiuhk 989798908098098908                                                          kjkjflkjdfkljdfkljdfdfklfddffddf  ');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `routeid` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(40) NOT NULL,
  `destination` varchar(40) NOT NULL,
  `distance` int(11) DEFAULT NULL,
  PRIMARY KEY (`routeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`routeid`, `source`, `destination`, `distance`) VALUES
(1, 'delhi', 'chandigarh', 100),
(2, 'patiala', 'amritsar', 200),
(3, 'jaipur', 'ahmedabad', 600),
(4, 'agra', 'delhi', 340),
(5, 'jaipur', 'agra', 500),
(9, 'jaipur', 'delhi', 300),
(11, 'agra', 'bhopal', 437),
(24, 'delhi', 'kanpur', 389),
(25, 'delhi', 'lucknow', 414),
(27, 'delhi', 'palwal', 56);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `routeid` int(11) NOT NULL DEFAULT '0',
  `busid` int(11) NOT NULL DEFAULT '0',
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `monday` int(11) DEFAULT NULL,
  `tuesday` int(11) DEFAULT NULL,
  `wednesday` int(11) DEFAULT NULL,
  `thursday` int(11) DEFAULT NULL,
  `friday` int(11) DEFAULT NULL,
  `saturday` int(11) DEFAULT NULL,
  `sunday` int(11) DEFAULT NULL,
  PRIMARY KEY (`routeid`,`busid`),
  KEY `busid` (`busid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`routeid`, `busid`, `departure_time`, `arrival_time`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`) VALUES
(1, 100, '12:50:00', '17:00:00', 1, 1, 1, 0, 0, 0, 1),
(1, 112, '13:00:00', '18:00:00', 1, 0, 1, 1, 1, 1, 1),
(2, 101, '10:05:00', '12:30:00', 1, 1, 0, 1, 1, 0, 0),
(2, 113, '10:00:00', '13:00:00', 0, 1, 1, 0, 1, 1, 0),
(3, 102, '09:00:00', '21:54:00', 1, 0, 0, 1, 1, 1, 1),
(4, 103, '08:00:00', '12:30:00', 0, 1, 1, 1, 0, 1, 1),
(4, 111, '11:00:00', '16:00:00', 1, 1, 1, 1, 1, 1, 1),
(5, 104, '08:00:00', '14:23:00', 0, 0, 0, 1, 1, 1, 1),
(9, 105, '12:00:00', '17:00:00', 1, 1, 0, 1, 1, 1, 1),
(11, 106, '06:00:00', '14:00:00', 1, 1, 1, 1, 1, 0, 0),
(11, 107, '11:00:00', '20:00:00', 1, 1, 1, 1, 1, 1, 1),
(24, 108, '06:00:00', '17:30:00', 0, 1, 1, 0, 1, 0, 1),
(24, 110, '08:00:00', '19:00:00', 1, 1, 1, 1, 1, 0, 1),
(25, 109, '05:00:00', '17:00:00', 0, 1, 0, 1, 0, 1, 1),
(27, 114, '05:00:00', '08:00:00', 0, 1, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticketid` int(11) NOT NULL AUTO_INCREMENT,
  `busid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `departuredate` date DEFAULT NULL,
  `seat1` int(11) DEFAULT '0',
  `seat2` int(11) DEFAULT '0',
  `seat3` int(11) DEFAULT '0',
  `passenger1` varchar(40) DEFAULT NULL,
  `passenger2` varchar(40) DEFAULT NULL,
  `passenger3` varchar(40) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `no_of_seats` int(11) DEFAULT '0',
  `bookingdate` date DEFAULT NULL,
  PRIMARY KEY (`ticketid`),
  KEY `busid` (`busid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketid`, `busid`, `userid`, `departuredate`, `seat1`, `seat2`, `seat3`, `passenger1`, `passenger2`, `passenger3`, `amount`, `no_of_seats`, `bookingdate`) VALUES
(2, 100, 22, '2013-11-19', 5, 6, 0, 'pa', 'pb', '', 1080, 2, '2013-11-19'),
(3, 114, 26, '2013-11-22', 1, 2, 0, 'wer', 'tyu', '', 660, 2, '2013-11-19'),
(4, 100, 26, '2013-11-20', 15, 16, 28, 'jyyt', 'ytytd', 'hdyt', 1620, 3, '2013-11-19'),
(5, 109, 22, '2013-11-21', 1, 11, 21, 'jyyt', 'o', 'j', 6285, 3, '2013-11-21'),
(6, 111, 22, '2013-11-22', 7, 8, 18, 'efs', 'sf', 'ertert', 5220, 3, '2013-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email_id` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `first_name`, `last_name`, `email_id`, `password`, `gender`, `dob`, `type`) VALUES
(1, 'a', 'b', 'ab@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(2, 'c', 'd', 'cd@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Female', NULL, 'normal'),
(3, 'e', 'f', 'ef@yahoo.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Female', NULL, 'normal'),
(4, 'g', 'h', 'gh@yahoo.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(5, 'i', 'j', 'ij@yahoo.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(6, 'r', 's', 'rs@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(7, 'aa', 'bb', 'aabb@yahoo.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(8, 'q', 'w', 'qw@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(9, 'x', 'y', 'xy@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(10, 'j', 'k', 'jk@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(11, 'shahzad', 'alam', 'shah@gg', '25d55ad283aa400af464c76d713c07ad', 'Male', NULL, 'normal'),
(12, 'l', 'm', 'lm@yahoo.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Female', NULL, 'normal'),
(13, 'h', 'k', 'hk@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(14, 'p', 'm', 'pm@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(15, 'q', 'w', 'qw@yahoo.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(17, 'x', 'y', 'xyz@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', NULL, 'normal'),
(19, 'aj', 'kl', 'ajkl@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '2013-11-05', 'normal'),
(20, 'aa', 'ww', 'pq@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '2013-11-03', 'normal'),
(21, 'aj', 'qw', 'aj@hotmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '2013-11-06', 'normal'),
(22, 'adminA', 'admin', 'adminA@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '2013-11-01', 'admin'),
(23, 'adminB', 'admin', 'adminB@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '2013-11-01', 'admin'),
(24, 'shamim', 'biswas', 'sh@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '1993-06-12', 'normal'),
(25, 'aethi', 'kumar', 'aethi@g.com', '83f6ba84d1556f8917625a0510a3f49a', 'Male', '1967-03-12', 'normal'),
(26, 'shah', 'alam', 'sha@g.com', '3fc0a7acf087f549ac2b266baf94b8b1', 'Male', '1994-04-25', 'normal');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`routeid`) REFERENCES `route` (`routeid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`busid`) REFERENCES `bus` (`busid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`busid`) REFERENCES `bus` (`busid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
