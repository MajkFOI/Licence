-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2019 at 11:32 AM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.17-1+0~20190412070953.20+jessie~1.gbp23a36d

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2018x091`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik_rada`
--

CREATE TABLE `dnevnik_rada` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(10) DEFAULT NULL,
  `opis` varchar(100) COLLATE latin2_croatian_ci NOT NULL,
  `datum_vrijeme` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `dnevnik_rada`
--

INSERT INTO `dnevnik_rada` (`id`, `korisnik_id`, `opis`, `datum_vrijeme`) VALUES
(7, 1, 'Korisnik se uspješno prijavio.', '2019-06-03 10:57:53'),
(8, 13, 'Korisnik se uspješno prijavio.', '2019-06-04 11:00:44'),
(9, 13, 'Korisnik je blokiran zbog previše neuspješnih logiranja.', '2019-06-05 11:00:52'),
(17, 30, 'Korisnik je registriran i poslan mu je kod(4KTuhl6Atfm2bhq) za aktivaciju.', '2019-06-05 11:31:52'),
(19, 30, 'Korisnik je aktivirao svoj račun.', '2019-06-05 11:35:10'),
(20, 4, 'Korisnik se uspješno prijavio.', '2019-06-05 13:18:37'),
(21, 3, 'Korisnik se uspješno prijavio.', '2019-06-05 13:19:10'),
(22, 3, 'Korisnik šalje zahtjev za korištenjem licence (ID kupnje: 36).', '2019-06-05 13:22:51'),
(23, 3, 'Korisnik vraća licencu (ID korištenja: 23, ID kupnje: 36).', '2019-06-05 13:33:28'),
(24, 4, 'Korisnik se uspješno prijavio.', '2019-06-05 13:39:09'),
(25, 4, 'Moderator šalje zahtjev za kupnjom licence (ID:licence: 1).', '2019-06-05 13:43:54'),
(26, 4, 'Moderator odobrava korištenje licence (ID korištenja: 28).', '2019-06-05 13:58:27'),
(27, 1, 'Korisnik se uspješno prijavio.', '2019-06-05 14:07:59'),
(28, 1, 'Administrator uređuje licencu (ID licence: 1).', '2019-06-05 14:18:37'),
(29, 1, 'Administrator briše licencu (ID licence: 20).', '2019-06-05 14:21:04'),
(31, 1, 'Administator odblokirava korisnika (ID korisnika: 13).', '2019-06-05 14:45:01'),
(32, 1, 'Odjava sa sustava.', '2019-06-05 14:52:37'),
(33, 1, 'Korisnik se uspješno prijavio.', '2019-06-05 15:07:23'),
(34, 1, 'Odjava sa sustava.', '2019-06-05 15:07:24'),
(35, 1, 'Korisnik se uspješno prijavio.( IP: 193.198.27.58)', '2019-06-05 15:18:33'),
(36, 1, 'Odjava sa sustava.( IP: 193.198.27.58)', '2019-06-05 15:18:49'),
(37, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-05 15:19:19'),
(38, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-05 15:19:50'),
(39, 1, 'Korisnik se uspješno prijavio. (IP: 46.188.131.240)', '2019-06-05 15:30:34'),
(40, 1, 'Odjava sa sustava. (IP: 46.188.131.240)', '2019-06-05 15:30:43'),
(41, 1, 'Neuspješna prijava. (IP: 193.198.27.58)', '2019-06-05 15:44:46'),
(42, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-05 15:45:00'),
(43, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-05 15:45:46'),
(44, 13, 'Neuspješna prijava. (IP: 193.198.27.58)', '2019-06-05 15:45:51'),
(45, 13, 'Neuspješna prijava. (IP: 193.198.27.58)', '2019-06-05 15:45:54'),
(46, 13, 'Neuspješna prijava. (IP: 193.198.27.58)', '2019-06-05 15:45:56'),
(47, 13, 'Korisnik je blokiran zbog previše neuspješnih logiranja. (IP: 193.198.27.58)', '2019-06-05 15:45:56'),
(48, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-05 15:58:39'),
(49, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-05 16:21:28'),
(50, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-05 16:39:41'),
(51, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-05 17:41:42'),
(52, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-05 20:27:15'),
(54, 1, 'Administator odbija kupnju (ID kupnje: 29). (IP: 193.198.27.58)', '2019-06-05 20:33:34'),
(55, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-05 22:40:43'),
(56, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-06 17:09:48'),
(57, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-06 17:59:23'),
(58, 4, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-06 17:59:28'),
(59, 4, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-06 18:13:23'),
(60, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-06 18:13:37'),
(61, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-06 18:14:19'),
(62, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-06 20:41:43'),
(63, 1, 'Administrator unosi novu licencu: Windows XP u kategoriju 1. (IP: 193.198.27.58)', '2019-06-06 20:44:21'),
(64, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-06 20:45:03'),
(65, 1, 'Neuspješna prijava. (IP: 193.198.27.58)', '2019-06-06 20:45:12'),
(66, 4, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-06 20:45:21'),
(67, 4, 'Moderator šalje zahtjev za kupnjom licence (ID licence: 24). (IP: 193.198.27.58)', '2019-06-06 20:45:55'),
(68, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-06 20:46:30'),
(69, 1, 'Administator odobrava kupnju (ID kupnje: 41). (IP: 193.198.27.58)', '2019-06-06 20:46:44'),
(70, 3, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-06 20:49:02'),
(71, 1, 'Administrator unosi novu licencu: PowerPoint 2016 u kategoriju 4. (IP: 193.198.27.58)', '2019-06-06 20:51:32'),
(72, 4, 'Moderator šalje zahtjev za kupnjom licence (ID licence: 25). (IP: 193.198.27.58)', '2019-06-06 20:52:32'),
(73, 1, 'Administator odobrava kupnju (ID kupnje: 42). (IP: 193.198.27.58)', '2019-06-06 20:53:00'),
(74, 3, 'Korisnik šalje zahtjev za korištenjem licence (ID kupnje: 42). (IP: 193.198.27.58)', '2019-06-06 20:53:27'),
(75, 4, 'Moderator odobrava korištenje licence (ID korištenja: 30). (IP: 193.198.27.58)', '2019-06-06 20:53:44'),
(76, 3, 'Korisnik vraća licencu (ID korištenja: 27, ID kupnje: 38). (IP: 193.198.27.58)', '2019-06-06 20:53:56'),
(77, 3, 'Korisnik vraća licencu (ID korištenja: 28, ID kupnje: 36). (IP: 193.198.27.58)', '2019-06-06 20:57:06'),
(78, 1, 'Korisnik se uspješno prijavio. (IP: 93.139.223.164)', '2019-06-09 15:28:38'),
(79, 1, 'Odjava sa sustava. (IP: 93.139.223.164)', '2019-06-09 15:28:53'),
(80, 4, 'Korisnik se uspješno prijavio. (IP: 93.139.223.164)', '2019-06-09 15:29:02'),
(81, 4, 'Moderator šalje zahtjev za kupnjom licence (ID licence: 5). (IP: 93.139.223.164)', '2019-06-09 15:29:53'),
(82, 4, 'Odjava sa sustava. (IP: 93.139.223.164)', '2019-06-09 15:30:22'),
(83, 1, 'Korisnik se uspješno prijavio. (IP: 93.139.223.164)', '2019-06-09 15:30:29'),
(84, 1, 'Administator odobrava kupnju (ID kupnje: 43). (IP: 93.139.223.164)', '2019-06-09 15:30:34'),
(85, 1, 'Odjava sa sustava. (IP: 93.139.223.164)', '2019-06-09 15:30:54'),
(86, 3, 'Korisnik se uspješno prijavio. (IP: 93.139.223.164)', '2019-06-09 15:31:01'),
(87, 3, 'Korisnik šalje zahtjev za korištenjem licence (ID kupnje: 43). (IP: 93.139.223.164)', '2019-06-09 15:31:06'),
(88, 3, 'Odjava sa sustava. (IP: 93.139.223.164)', '2019-06-09 15:31:18'),
(89, 4, 'Korisnik se uspješno prijavio. (IP: 93.139.223.164)', '2019-06-09 15:31:22'),
(90, 4, 'Moderator odobrava korištenje licence (ID korištenja: 31). (IP: 93.139.223.164)', '2019-06-09 15:31:31'),
(91, 4, 'Odjava sa sustava. (IP: 93.139.223.164)', '2019-06-09 15:31:55'),
(92, 3, 'Korisnik se uspješno prijavio. (IP: 93.139.223.164)', '2019-06-09 15:32:03'),
(93, 3, 'Korisnik vraća licencu (ID korištenja: 30, ID kupnje: 42). (IP: 93.139.223.164)', '2019-06-09 15:32:21'),
(94, 3, 'Odjava sa sustava. (IP: 93.139.223.164)', '2019-06-09 15:33:28'),
(95, 1, 'Korisnik se uspješno prijavio. (IP: 93.139.223.164)', '2019-06-09 15:33:34'),
(96, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-09 21:47:08'),
(97, 3, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-09 21:47:37'),
(98, 4, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-09 21:47:39'),
(99, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-09 21:48:19'),
(100, 31, 'Korisnik je registriran i poslan mu je kod(Cd5PXTeT7hYppEK) za aktivaciju. (IP: 193.198.27.58)', '2019-06-09 21:51:03'),
(101, 31, 'Korisnik je aktivirao svoj račun. (IP: 193.198.27.58)', '2019-06-09 21:52:08'),
(102, 31, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-09 21:52:20'),
(103, 31, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-09 21:52:21'),
(104, 31, 'Neuspješna prijava. (IP: 193.198.27.58)', '2019-06-09 21:52:25'),
(105, 31, 'Neuspješna prijava. (IP: 193.198.27.58)', '2019-06-09 21:52:28'),
(106, 31, 'Neuspješna prijava. (IP: 193.198.27.58)', '2019-06-09 21:52:31'),
(107, 31, 'Korisnik je blokiran zbog previše neuspješnih logiranja. (IP: 193.198.27.58)', '2019-06-09 21:52:31'),
(108, 4, 'Moderator šalje zahtjev za kupnjom licence (ID licence: 24). (IP: 193.198.27.58)', '2019-06-09 22:16:13'),
(109, 4, 'Moderator odobrava korištenje licence (ID korištenja: 26). (IP: 193.198.27.58)', '2019-06-09 22:16:58'),
(110, 4, 'Moderator odbija korištenje licence (ID korištenja: ). (IP: 193.198.27.58)', '2019-06-09 22:17:42'),
(111, 4, 'Moderator odbija korištenje licence (ID korištenja: ). (IP: 193.198.27.58)', '2019-06-09 22:17:44'),
(113, 4, 'Moderator odbija korištenje licence (ID korištenja: 15). (IP: 193.198.27.58)', '2019-06-09 22:18:52'),
(114, 4, 'Moderator odbija korištenje licence (ID korištenja: 17). (IP: 193.198.27.58)', '2019-06-09 22:18:53'),
(115, 1, 'Korisnik se uspješno prijavio. (IP: 193.198.27.58)', '2019-06-09 22:21:05'),
(116, 1, 'Administator blokira korisnika (ID korisnika: 14). (IP: 193.198.27.58)', '2019-06-09 22:22:35'),
(117, 1, 'Administator blokira korisnika (ID korisnika: 15). (IP: 193.198.27.58)', '2019-06-09 22:22:44'),
(118, 1, 'Administator daje korisniku (ID korisnika: 15) ulogu moderatora . (IP: 193.198.27.58)', '2019-06-09 22:23:05'),
(119, 1, 'Administator miče korisniku (ID korisnika: 15) ulogu moderatora . (IP: 193.198.27.58)', '2019-06-09 22:23:15'),
(120, 1, 'Administator odobrava kupnju (ID kupnje: 44). (IP: 193.198.27.58)', '2019-06-09 22:23:56'),
(121, 1, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-09 22:26:04'),
(122, 4, 'Odjava sa sustava. (IP: 193.198.27.58)', '2019-06-09 22:26:35'),
(123, 32, 'Korisnik je registriran i poslan mu je kod(cXzWJwgt5oS9CNe) za aktivaciju. (IP: 10.85.8.209)', '2019-06-10 11:15:14'),
(124, 32, 'Korisnik je aktivirao svoj račun. (IP: 10.85.8.209)', '2019-06-10 11:15:41'),
(125, 32, 'Korisnik se uspješno prijavio. (IP: 10.85.8.209)', '2019-06-10 11:15:50'),
(126, 32, 'Odjava sa sustava. (IP: 10.85.8.209)', '2019-06-10 11:15:55'),
(127, 32, 'Neuspješna prijava. (IP: 10.85.8.209)', '2019-06-10 11:17:34'),
(128, 32, 'Neuspješna prijava. (IP: 10.85.8.209)', '2019-06-10 11:17:39'),
(129, 32, 'Neuspješna prijava. (IP: 10.85.8.209)', '2019-06-10 11:17:42'),
(130, 32, 'Korisnik je blokiran zbog previše neuspješnih logiranja. (IP: 10.85.8.209)', '2019-06-10 11:17:42'),
(131, 1, 'Korisnik se uspješno prijavio. (IP: 10.85.8.209)', '2019-06-10 11:18:06'),
(132, 1, 'Administator odblokirava korisnika (ID korisnika: 32). (IP: 10.85.8.209)', '2019-06-10 11:18:15'),
(133, 32, 'Korisnik se uspješno prijavio. (IP: 10.85.8.209)', '2019-06-10 11:18:29'),
(134, 32, 'Odjava sa sustava. (IP: 10.85.8.209)', '2019-06-10 11:18:31'),
(135, 32, 'Korisnik se uspješno prijavio. (IP: 10.85.8.209)', '2019-06-10 11:18:40'),
(136, 1, 'Administrator unosi novu kategoriju: Diskovi (IP: 10.85.8.209)', '2019-06-10 11:19:11'),
(137, 1, 'Administrator unosi novu licencu: SSD u kategoriju 19. (IP: 10.85.8.209)', '2019-06-10 11:20:10'),
(138, 4, 'Korisnik se uspješno prijavio. (IP: 10.85.8.209)', '2019-06-10 11:20:33'),
(139, 4, 'Moderator šalje zahtjev za kupnjom licence (ID licence: 26). (IP: 10.85.8.209)', '2019-06-10 11:21:04'),
(140, 1, 'Administator odobrava kupnju (ID kupnje: 45). (IP: 10.85.8.209)', '2019-06-10 11:21:22'),
(141, 32, 'Korisnik šalje zahtjev za korištenjem licence (ID kupnje: 45). (IP: 10.85.8.209)', '2019-06-10 11:22:05'),
(142, 4, 'Moderator odobrava korištenje licence (ID korištenja: 32). (IP: 10.85.8.209)', '2019-06-10 11:22:20'),
(143, 32, 'Korisnik vraća licencu (ID korištenja: 32, ID kupnje: 45). (IP: 10.85.8.209)', '2019-06-10 11:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id`, `naziv`) VALUES
(1, 'Operacijski sustavi'),
(2, 'Aplikacije'),
(3, 'Igrice'),
(4, 'Office'),
(8, 'Pomagala'),
(19, 'Diskovi');

-- --------------------------------------------------------

--
-- Table structure for table `konfiguracija`
--

CREATE TABLE `konfiguracija` (
  `id` int(11) NOT NULL,
  `trajanje_kolacica` int(11) NOT NULL DEFAULT '48',
  `stranicenje` int(11) NOT NULL DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `konfiguracija`
--

INSERT INTO `konfiguracija` (`id`, `trajanje_kolacica`, `stranicenje`) VALUES
(1, 48, 4);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `uloga_id` int(11) NOT NULL,
  `ime` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `prezime` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `lozinka` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `email` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `datum_vrijeme_uvjeta` datetime DEFAULT NULL,
  `blokiran` varchar(2) COLLATE latin2_croatian_ci NOT NULL DEFAULT 'NE',
  `kriptirana_lozinka` char(64) COLLATE latin2_croatian_ci DEFAULT NULL,
  `pokusaji_logiranja` int(11) NOT NULL,
  `aktiviran` tinyint(1) DEFAULT '0',
  `kod_aktivacije` varchar(20) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `uloga_id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `email`, `datum_vrijeme_uvjeta`, `blokiran`, `kriptirana_lozinka`, `pokusaji_logiranja`, `aktiviran`, `kod_aktivacije`) VALUES
(1, 1, 'Pero', 'Perić', 'pperic', '1234', 'pperic@mail.hr', '2019-04-09 05:20:12', 'NE', NULL, 0, 1, ''),
(2, 1, 'Đuro', 'Đurić', 'dduric', '1256', 'dduric@mail.hr', '2019-04-09 06:25:12', 'NE', NULL, 0, 1, ''),
(3, 3, 'Ante', 'Antić', 'aantic', '5436', 'aantic@mail.hr', '2019-04-10 08:25:12', 'NE', NULL, 0, 1, ''),
(4, 2, 'Mirko', 'Mirkić', 'mmirkic', '42asd', 'mmirkic@mail.hr', '2019-03-10 18:25:12', 'NE', NULL, 0, 1, ''),
(5, 3, 'Robert', 'Robić', 'rrobic', 'sdf435', 'rrobic@mail.hr', '2019-03-11 20:25:12', 'NE', NULL, 0, 1, ''),
(6, 2, 'Marjan', 'Marjanović', 'mmarjanovic', 'sdfs132', 'mmarjanovic@mail.hr', '2019-04-01 00:19:00', 'NE', NULL, 0, 1, ''),
(7, 3, 'asd', 'asd', 'asd', 'asdf', 'asd@fds.hr', NULL, 'NE', '3da541559918a808c2402bba5012f6c60b27661c', 3, 0, ''),
(11, 3, 'qwe', 'qwe', 'qwe', 'qwe', 'qwe@qwe.qwe', NULL, 'NE', '056eafe7cf52220de2df36845b8ed170c67e23e3', 3, 0, ''),
(12, 3, 'yxc', 'yxc', 'yxc', 'yxc', 'yxc@yxc.yxc', NULL, 'NE', '4bdc26d2b77e9e8989ce1a3211d08aa52369fafc', 3, 0, ''),
(13, 3, 'ert', 'ert', 'ert', 'ert', 'ert@ert.ert', NULL, 'NE', '179d9afbd6a5a817ca2765ab958ba9d8ec95eb7c', 3, 1, ''),
(14, 3, 'asd', 'asd', 'asdf', 'asd', 'asd@asd.asd', NULL, 'NE', 'f10e2821bbbea527ea02200352313bc059445190', 3, 0, ''),
(15, 3, 'asdf', 'asdf', 'asdg', 'asdg', 'asdfg@asdffg.gr', NULL, 'NE', '7b08df1aed060621508955f9cf3f0a5ad46309ac', 3, 1, ''),
(16, 3, 'dewd', 'wedewd', 'wedew', 'asdf', 'asd@asdf.ew', NULL, 'NE', '3da541559918a808c2402bba5012f6c60b27661c', 0, 1, ''),
(17, 3, 'ghj', 'ghj', 'ghj', 'ghj', 'ghj@gghj.ghj', NULL, 'NE', '046827b58f128d5f522134b9c4ac3c6d68377055', 0, 1, ''),
(30, 3, 'asd123', 'asd123', 'asd123', 'asd123', 'asd123@asd.asd', NULL, 'NE', '2891baceeef1652ee698294da0e71ba78a2a4064', 0, 1, ''),
(31, 3, 'Jura', 'Jurić', 'jjuric', 'jjuric123', 'jjuric@mail.hr', NULL, 'NE', '824cecfc873f4bbc3c90ffa29c985d8e81b0a644', 3, 1, ''),
(32, 3, 'Nikola', 'Horvatić', 'nhorvatic', '123', 'nhorvatic@mail.hr', NULL, 'NE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `korištenje`
--

CREATE TABLE `korištenje` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `kupnja_id` int(11) NOT NULL,
  `generirani_ključ` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korištenje`
--

INSERT INTO `korištenje` (`id`, `korisnik_id`, `status_id`, `kupnja_id`, `generirani_ključ`) VALUES
(7, 1, 4, 1, 'WQDHY-NKMZU-PAJVB-ICFEO-LTRGS'),
(8, 1, 6, 33, NULL),
(9, 1, 6, 31, NULL),
(10, 1, 6, 2, NULL),
(11, 1, 6, 33, NULL),
(12, 1, 6, 33, NULL),
(13, 1, 6, 34, NULL),
(14, 1, 6, 33, NULL),
(15, 4, 5, 1, NULL),
(16, 4, 4, 36, 'NHOYM-PEJKA-BSTXF-RCLQW-VDIUG'),
(17, 4, 5, 1, NULL),
(18, 3, 4, 1, 'ZYVEB-DCLPX-AJGNT-IFSWH-OMURQ'),
(21, 3, 3, 36, 'NFQXI-RHWCB-TVZOG-ADPEJ-MYKUS'),
(22, 3, 3, 36, 'HZILO-AXVTN-FKMSB-RUQDY-ECJPW'),
(23, 3, 3, 36, 'OCXTQ-LKNHE-BJIUF-DRYAV-PZWMG'),
(24, 3, 6, 31, NULL),
(25, 1, 6, 33, NULL),
(26, 4, 4, 36, 'JQHYZ-XNBPK-UAICO-VTSML-WDERG'),
(27, 3, 3, 38, 'EDQOB-PIZST-RXUJG-NMHFA-YCWVL'),
(28, 3, 3, 36, 'MKONI-PDFGR-AWQSB-HEVZT-LCXYU'),
(29, 3, 6, 36, NULL),
(30, 3, 3, 42, 'FEMWK-TZYBC-HVNRU-LIDGO-PAXSQ'),
(31, 3, 4, 43, 'KHGBI-ULNRW-CYJVM-TAZOP-SXFDE'),
(32, 32, 3, 45, 'ETLPB-AWFRD-QKYOX-MVNCH-USZGJ');

-- --------------------------------------------------------

--
-- Table structure for table `kupnja`
--

CREATE TABLE `kupnja` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `licenca_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `iznos` decimal(10,2) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date NOT NULL,
  `datum_vrijeme_promjene_statusa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kupnja`
--

INSERT INTO `kupnja` (`id`, `korisnik_id`, `licenca_id`, `status_id`, `kolicina`, `iznos`, `datum_od`, `datum_do`, `datum_vrijeme_promjene_statusa`) VALUES
(1, 4, 2, 1, 1, '199.99', '2019-04-09', '2019-04-23', '2019-05-27 07:00:00'),
(2, 6, 3, 1, 5, '299.99', '2019-04-02', '2019-04-16', '2019-05-28 03:29:26'),
(3, 4, 1, 2, 200, '799.99', '2019-04-09', '2019-04-30', '2019-06-01 00:00:00'),
(31, 1, 5, 1, 10, '120.00', '2019-05-27', '2019-06-26', '2019-05-27 04:04:19'),
(32, 1, 5, 1, 10, '120.00', '2019-05-27', '2019-05-29', '2019-06-02 00:00:00'),
(33, 1, 1, 1, 10, '123.00', '2019-05-28', '2019-06-19', '2019-05-29 03:10:27'),
(34, 1, 5, 1, 12, '123.00', '2019-05-28', '2019-05-30', '2019-05-29 04:09:19'),
(35, 2, 4, 1, 15, '244.00', '2019-05-30', '2019-06-19', '2019-06-18 00:00:00'),
(36, 4, 1, 1, 6, '20000.00', '2019-05-31', '2019-06-10', '2019-05-29 05:11:16'),
(37, 4, 2, 1, 15, '200.00', '2019-05-30', '2019-06-19', '2019-06-02 00:00:00'),
(38, 4, 19, 1, 5, '250.00', '2019-06-06', '2019-06-26', '2019-06-04 21:22:50'),
(39, 4, 1, 2, 23, '200.00', '2019-07-09', '2019-07-16', '2019-06-05 20:33:34'),
(40, 4, 1, 6, 23, '200.00', '2019-07-09', '2019-07-16', NULL),
(41, 4, 24, 1, 12, '259.99', '2019-06-09', '2019-07-15', '2019-06-06 20:46:44'),
(42, 4, 25, 1, 25, '250.00', '2019-06-06', '2019-06-27', '2019-06-06 20:53:00'),
(43, 4, 5, 1, 19, '3999.99', '2019-06-09', '2019-07-31', '2019-06-09 15:30:34'),
(44, 4, 24, 1, 5, '299.50', '2019-06-10', '2019-06-27', '2019-06-09 22:23:56'),
(45, 4, 26, 1, 5, '200.00', '2019-06-10', '2019-06-27', '2019-06-10 11:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `licenca`
--

CREATE TABLE `licenca` (
  `id` int(11) NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `naziv` varchar(45) COLLATE latin2_croatian_ci NOT NULL,
  `opis` text COLLATE latin2_croatian_ci NOT NULL,
  `slika` varchar(45) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `licenca`
--

INSERT INTO `licenca` (`id`, `kategorija_id`, `naziv`, `opis`, `slika`) VALUES
(1, 1, 'Windows 10', 'Windows 10 je najpopularniji operacijski sustav...', 'windows10.jpg'),
(2, 3, 'FIFA 19 ', 'FIFA 19 je najpopularnija nogometna igrica...', 'fifa19.jpg'),
(3, 4, 'Word 2016', 'Word 2016 je trenutno najkorišteniji alat za obradu teksta...', 'unaprijedPripremljena.jpg'),
(4, 4, 'Excel 2016', 'Excel 2016 je trenutno najpopularniji alat za tablične kalkulatore.', 'unaprijedPripremljena.jpg'),
(5, 2, 'Visual Studio Express', 'Visual Studio Express omogućava najbolje...', 'unaprijedPripremljena.jpg'),
(19, 8, 'Notepad Express ++', 'Notepad Express++ je nova aplikacija sa raznim mogućnostima...', 'notepadpp.png'),
(24, 1, 'Windows XP', 'Windows XP (kodnog imena Whistler) inačica je operacijskog sustava kojeg je razvio Microsoft. Slova XP stoje iza engleske riječi eXPerience što znači iskustvo.', 'unaprijedPripremljena.jpg'),
(25, 4, 'PowerPoint 2016', 'Microsoft PowerPoint je program za izradu prezentacija, proizvod kompanije Microsoft, sastavni je dio programskog paketa Microsoft Office. ', 'powerpoint.png'),
(26, 19, 'SSD', 'oahfoiwf', 'unaprijedPripremljena.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `naziv` varchar(45) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `naziv`) VALUES
(1, 'Prihvaćeno'),
(2, 'Odbijeno'),
(3, 'Vraćeno'),
(4, 'Odobren'),
(5, 'Odbijen'),
(6, 'Na čekanju');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `upravlja`
--

CREATE TABLE `upravlja` (
  `uloga_id` int(11) NOT NULL COMMENT 'korisnik_id',
  `kategorija_id` int(11) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upravlja`
--

INSERT INTO `upravlja` (`uloga_id`, `kategorija_id`, `datum_od`, `datum_do`) VALUES
(4, 1, '2019-04-08', NULL),
(6, 1, '2019-04-03', NULL),
(6, 2, '2019-03-08', NULL),
(4, 3, '2019-04-07', NULL),
(4, 5, '2019-03-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zadaca4_obrazac`
--

CREATE TABLE `zadaca4_obrazac` (
  `id` int(11) NOT NULL,
  `korisnik` varchar(100) NOT NULL,
  `link_slike` varchar(100) NOT NULL,
  `unos_broja` int(11) NOT NULL,
  `odabrana1` varchar(50) NOT NULL,
  `odabrana2` varchar(50) NOT NULL,
  `odabrana3` varchar(50) NOT NULL,
  `tekstualni_element` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zadaca4_obrazac`
--

INSERT INTO `zadaca4_obrazac` (`id`, `korisnik`, `link_slike`, `unos_broja`, `odabrana1`, `odabrana2`, `odabrana3`, `tekstualni_element`) VALUES
(3, 'pperic', '../multimedija/Gantogram.jpg', 4, '1;Pero', '', '', 'asd'),
(4, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 32, '1;Pero', '5;Jura', '', 'asd'),
(5, 'pperic', '../multimedija/Gantogram.jpg', 5, '1;Pero', '5;Jura', '', 'fdsge'),
(6, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 10, '1;Pero', '5;Jura', '', 'fergregerd'),
(12, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 20, '6;Danko', '12;Ispravno2', '13;Pera', 'dasdads'),
(13, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 20, '6;Danko', '12;Ispravno2', '13;Pera', 'dasdads'),
(14, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 2, '', '', '', 'as'),
(15, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 0, '5;Jura', '6;Danko', '', ''),
(16, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 0, '5;Jura', '6;Danko', '', ''),
(17, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 0, '1;Pero', '5;Jura', '', ''),
(21, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 3, '', '', '', 'asd'),
(22, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 12, '13;Pera', '14;Mato', '15;Branko', 'asdf'),
(24, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 123, '1;Pero', '5;Jura', '', 'asdf'),
(25, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 23, '5;Jura', '', '', 'asd'),
(33, 'pperic', '../multimedija/unaprijedPripremljena.jpg', 123, '1;Pero', '3;Mirko', '', 'asd'),
(34, 'pperic', '', 0, '', '', '', ''),
(35, 'pperic', '', 0, '', '', '', ''),
(36, 'pperic', '', 0, '', '', '', ''),
(37, 'pperic', '', 0, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfiguracija`
--
ALTER TABLE `konfiguracija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_korisnik_uloga1_idx` (`uloga_id`);

--
-- Indexes for table `korištenje`
--
ALTER TABLE `korištenje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_korištenje_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_korištenje_status1_idx` (`status_id`),
  ADD KEY `kupnja_id` (`kupnja_id`);

--
-- Indexes for table `kupnja`
--
ALTER TABLE `kupnja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kupnja_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_kupnja_licenca1_idx` (`licenca_id`),
  ADD KEY `fk_kupnja_status1_idx` (`status_id`);

--
-- Indexes for table `licenca`
--
ALTER TABLE `licenca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_licenca_kategorija1_idx` (`kategorija_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upravlja`
--
ALTER TABLE `upravlja`
  ADD PRIMARY KEY (`kategorija_id`,`uloga_id`),
  ADD KEY `fk_upravlja_uloga1_idx` (`uloga_id`),
  ADD KEY `fk_upravlja_kategorija1_idx` (`kategorija_id`);

--
-- Indexes for table `zadaca4_obrazac`
--
ALTER TABLE `zadaca4_obrazac`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `korištenje`
--
ALTER TABLE `korištenje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `kupnja`
--
ALTER TABLE `kupnja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `licenca`
--
ALTER TABLE `licenca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zadaca4_obrazac`
--
ALTER TABLE `zadaca4_obrazac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD CONSTRAINT `fk_dnevnik_rada_korisnik` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga1` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korištenje`
--
ALTER TABLE `korištenje`
  ADD CONSTRAINT `fk_korištenje_kupnja` FOREIGN KEY (`kupnja_id`) REFERENCES `kupnja` (`id`),
  ADD CONSTRAINT `fk_korištenje_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korištenje_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kupnja`
--
ALTER TABLE `kupnja`
  ADD CONSTRAINT `fk_kupnja_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kupnja_licenca1` FOREIGN KEY (`licenca_id`) REFERENCES `licenca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kupnja_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `licenca`
--
ALTER TABLE `licenca`
  ADD CONSTRAINT `fk_licenca_kategorija1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `upravlja`
--
ALTER TABLE `upravlja`
  ADD CONSTRAINT `fk_upravlja_kategorija1` FOREIGN KEY (`kategorija_id`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_upravlja_korisnik1` FOREIGN KEY (`uloga_id`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
