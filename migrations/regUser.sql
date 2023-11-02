-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 04:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icdx`
--

-- --------------------------------------------------------


--
-- Table structure for table `regUser`
--

CREATE TABLE `patreg` (
  `id` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `inst_id` int(11) NOT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  primary key (`id`),
  FOREIGN KEY (user_id) REFERENCES user(id)
  FOREIGN KEY (inst_id) REFERENCES inst(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `lab_report_template` (
  `id` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `test_name` varchar(255) NOT NULL,
  `pat_category` varchar(255) NOT NULL,
  `ref_range` varchar(25) NOT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Table structure for table `regUser`
--



--
-- Dumping data for table `regUser`
--

INSERT INTO `regUser` (`id`, `pwd`, `name`, `fname`, `dob`, `sex`, `tribe`, `commu`, `bg`, `mobno`, `add1`, `dist`, `createdAt`, `updatedAt`) VALUES
(1, b'0', 'Rohnaii', 'Laltlinga', '1947-07-15', 'F', 'ST', 'Mizo', 'O', '9856954817', 'Lunglawn', 'Lunglei', NULL, NULL),
(2, b'0', 'C.SANGKIMA', 'Sangkhupa', '1949-07-15', 'M', 'ST', 'Mizo', 'O', '9863896619', 'Bungtlang S', 'Lunglei', NULL, NULL),
(3, b'0', 'Lalthlamuani', 'R.Zatawna', '1975-07-15', 'M', 'ST', 'Mizo', 'O', '8014355309', 'Hmunthar', 'Lunglei', NULL, NULL),
(4, b'0', 'Ramdinpuii', 'K.Lalremruata', '1997-07-15', 'F', 'ST', 'Mizo', 'O', '9856947113', 'Venglai', 'Lunglei', NULL, NULL),
(5, b'0', 'Ruatzauva', 'Lalpari', '1959-07-15', 'M', 'ST', 'Mizo', 'O', '9612862530', 'Thaizawl', 'Lunglei', NULL, NULL),
(6, b'0', 'H.Lalthlamuanpuia', 'lalhminghlua', '1997-07-15', 'M', 'ST', 'Mizo', 'O', '9089569611', 'Zobawk', 'Lunglei', NULL, NULL),
(7, b'0', 'Chandra Hangso', 'Baza', '1967-07-15', 'F', 'ST', 'Chakma', 'O', '9863415797', 'Chawngte', 'Lunglei', NULL, NULL),
(8, b'0', 'Lalhlimpuii', 'Saizama', '1987-07-15', 'F', 'ST', 'Mizo', 'O', '9436390923', 'College Veng', 'Lunglei', NULL, NULL),
(9, b'0', 'Lalthanzami', 'Larinzuala', '1977-07-15', 'F', 'ST', 'Mizo', 'O', '9612078626', 'Bazar', 'Lunglei', NULL, NULL),
(10, b'0', 'Anil Moy', 'Botosan', '1966-07-15', 'M', 'ST', 'Mizo', 'O', '8731879630', 'Chawngte', 'Lunglei', NULL, NULL),
(11, b'0', 'Bijesh Kanti', 'Oday Sankar', '1965-07-15', 'M', 'ST', 'Chakma', 'O', '8731879630', 'Sakeilui', 'Lawngtlai', NULL, NULL),
(12, b'0', 'Sunil', 'Romoni Ranjan', '1976-07-15', 'F', 'ST', 'Chakma', 'O', '8731879630', 'Sakeilui', 'Lawngtlai', NULL, NULL),
(13, b'0', 'C.RAMLIANA', 'ROKIPDAWLA', '1969-07-15', 'M', 'ST', 'Mizo', 'O', '9485057319', 'Bungtlang \'S\'', 'Lawngtlai', NULL, NULL),
(14, b'0', 'JYOTNA', 'SURESH KUMAR', '1992-07-15', 'F', 'ST', 'Chakma', 'O', '9436178638', 'Tiperegath', 'Lunglei', NULL, NULL),
(15, b'0', 'LALKHUMA', 'PATHIMA', '1935-07-15', 'M', 'ST', 'Mizo', 'O', '8974804638', 'HNATHIAL', 'Lunglei', NULL, NULL),
(16, b'0', 'LIANCHHUMA', 'CHHINGA(L)', '1943-07-15', 'M', 'ST', 'Mizo', 'O', '8575319682', 'Bunghmun', 'Lunglei', NULL, NULL),
(17, b'0', 'GUPA DEVI', 'BAROT KUMAR', '1979-07-15', 'F', 'ST', 'Mizo', 'O', '7308379814', 'Tiperegath', 'Lunglei', NULL, NULL),
(18, b'0', 'LALRINTLUANGI', 'Lallianzuala', '1966-07-15', 'F', 'ST', 'Mizo', 'O', '9615956806', 'Chanmari', 'Lunglei', NULL, NULL),
(19, b'0', 'VANLALLAWMA', 'Lalrindiki', '1983-07-15', 'M', 'ST', 'Mizo', 'O', '9089569817', 'Lunglawn', 'Lunglei', NULL, NULL),
(20, b'0', 'KUSUMKUMARI', 'Chhetri Ranjan', '1973-07-15', 'F', 'ST', 'Chakma', 'O', '9863905726', 'Bethbony', 'Lunglei', NULL, NULL),
(21, b'0', 'NITI RANJAN', 'Chhetri Ranjan', '1970-07-15', 'M', 'ST', 'Chakma', 'O', '9863905726', 'Lawngpuigath', 'Lunglei', NULL, NULL),
(22, b'0', 'Bawlthuami', 'Donghinglova', '1966-07-15', 'F', 'ST', 'Mizo', 'O', '8014355537', 'Luangmual', 'Lunglei', NULL, NULL),
(23, b'0', 'Rajesh Kumar', 'Godaram', '1960-07-15', 'M', 'ST', 'Chakma', 'O', '9863873175', 'Tuichawng', 'Lunglei', NULL, NULL),
(24, b'0', 'Mailiani', 'Dono Kumar', '1983-07-15', 'F', 'ST', 'Mizo', 'O', '9862083008', 'Kauchhuah', 'Lunglei', NULL, NULL),
(25, b'0', 'Laltinkhuma', 'Riatlua', '1932-07-15', 'M', 'ST', 'Mizo', 'O', '9436376406', 'Electric', 'Lunglei', NULL, NULL),
(187, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 17:34:32', '2023-08-31 17:34:32'),
(188, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 17:37:10', '2023-08-31 17:37:10'),
(189, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 17:41:18', '2023-08-31 17:41:18'),
(190, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 17:43:19', '2023-08-31 17:43:19'),
(191, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 17:48:08', '2023-08-31 17:48:08'),
(192, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 17:57:46', '2023-08-31 17:57:46'),
(193, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 17:59:25', '2023-08-31 17:59:25'),
(194, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 18:03:33', '2023-08-31 18:03:33'),
(195, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 18:08:52', '2023-08-31 18:08:52'),
(196, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 18:10:35', '2023-08-31 18:10:35'),
(197, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-08-31 18:17:15', '2023-08-31 18:17:15'),
(198, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:13:05', '2023-09-01 06:13:05'),
(199, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:15:40', '2023-09-01 06:15:40'),
(200, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:16:19', '2023-09-01 06:16:19'),
(201, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:19:16', '2023-09-01 06:19:16'),
(202, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:21:45', '2023-09-01 06:21:45'),
(203, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:23:52', '2023-09-01 06:23:52'),
(204, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:25:06', '2023-09-01 06:25:06'),
(205, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:27:50', '2023-09-01 06:27:50'),
(206, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:28:19', '2023-09-01 06:28:19'),
(207, b'0', '', '', '0001-01-01', '', '', '', '', '0', '', '', '2023-09-01 06:37:26', '2023-09-01 06:37:26'),
(208, b'1', 'Tea', 'LL Thuama', '1968-06-21', 'M', '', '', 'B+', '0', 'Serkawn', 'xxx', '2023-09-02 14:49:54', '2023-09-02 14:49:54'),
(209, b'1', 'Lapuii', 'LT Zama', '1968-06-21', 'M', 'st', 'mizo', 'B+', '0', 'Serkawn', 'xxx', '2023-09-02 14:51:25', '2023-09-02 14:51:25'),
(210, b'1', 'Lapuii', 'LT Zama', '1968-06-21', 'M', 'st', 'mizo', 'B+', '0', 'Serkawn', 'xxx', '2023-09-02 14:55:50', '2023-09-02 14:55:50'),
(211, b'1', 'Lapuii', 'LT Zama', '1968-06-21', 'M', 'st', 'mizo', 'B+', '8974910665', 'Serkawn', 'xxx', '2023-09-02 14:58:51', '2023-09-02 14:58:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regUser`
--
ALTER TABLE `regUser`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patreg`
--
ALTER TABLE `regUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
