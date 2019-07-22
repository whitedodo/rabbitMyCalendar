-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- ?앹꽦 ?쒓컙: 19-07-11 22:17
-- ?쒕쾭 踰꾩쟾: 5.5.59-log
-- PHP 踰꾩쟾: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- ?곗씠?곕쿋?댁뒪: `rabbit2me`
--

-- --------------------------------------------------------

--
-- ?뚯씠釉?援ъ“ `schedule_dyj`
--

CREATE TABLE `schedule_dyj` (
  `id` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `subject` varchar(50) NOT NULL,
  `contents` text NOT NULL,
  `passwd` text NOT NULL,
  `regidate` datetime NOT NULL,
  `ip` varchar(300) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- ?ㅽ봽???뚯씠釉붿쓽 ?몃뜳??
--

--
-- ?뚯씠釉붿쓽 ?몃뜳??`schedule_dyj`
--
ALTER TABLE `schedule_dyj`
  ADD PRIMARY KEY (`id`);

--
-- ?ㅽ봽???뚯씠釉붿쓽 AUTO_INCREMENT
--

--
-- ?뚯씠釉붿쓽 AUTO_INCREMENT `schedule_dyj`
--
ALTER TABLE `schedule_dyj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
