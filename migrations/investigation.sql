-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 05:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `investi_dept`
--

CREATE TABLE `investi_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `dept_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `investi_dept`
--

INSERT INTO `investi_dept` (`dept_name`) VALUES
('PATHOLOGY'),
('SUGAR TEST'),
('LIVER FUCTION TEST (LFT)'),
('RENAL FUNCTION TEST (RFT)'),
('SERUM ELECTROLYTES'),
('LIPID PROFILE TEST'),
('SEROLOGY'),
('COVID TEST');

--
-- Table structure for table `investi_detail`
--

CREATE TABLE `investi_detail` (
  `id` int(11) NOT NULL,
  `investi_id` int(1) DEFAULT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `gender` varchar(3) DEFAULT NULL,
  `operand` varchar(1) DEFAULT NULL,
  `min_range` varchar(6) DEFAULT NULL,
  `max_range` varchar(7) DEFAULT NULL,
  `unit` varchar(6) DEFAULT NULL,
  `rate` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `investi_detail`
--

INSERT INTO `investi_detail` (`id`, `investi_id`, `test_name`, `sex`, `gender`, `operand`, `min_range`, `max_range`, `unit`, `rate`) VALUES
(1, 1, 'HAEMOGLOBIN', 'MALE', 'M', '', '13', '13', '%', 20),
(2, 1, 'HAEMOGLOBIN', 'FEMALE', 'F', '', '12', '16', '%', 20),
(3, 1, 'TLC', 'BOTH', 'M&F', '', '4000', '10000', 'cumm', 20),
(4, 1, 'DLC     Poly', 'BOTH', 'M&F', '', '50', '70', '%', 20),
(5, 1, 'DLC     Lympo', 'BOTH', 'M&F', '', '20', '40', '%', 20),
(6, 1, 'DLC     Mono', 'BOTH', 'M&F', '', '2', '8', '%', 20),
(7, 1, 'DLC     Ensino', 'BOTH', 'M&F', '', '2', '6', '%', 20),
(8, 1, 'DLC     Baso', 'BOTH', 'M&F', '', '0', '1', '%', 20),
(9, 1, 'ESR', 'MALE', 'M', '<', '0', '18', 'mm', 20),
(10, 1, 'ESR', 'FEMALE', 'F', '<', '0', '20', 'mm', 20),
(11, 1, 'Platelet Count', 'BOTH', 'M&F', '', '1.5', '4', 'lac', 20),
(12, 1, 'BT', 'BOTH', 'M&F', '', '1', '5', 'mins', 20),
(13, 1, 'CT', 'BOTH', 'M&F', '', '4', '9', 'mins', 20),
(14, 1, 'Blood MP', 'BOTH', 'M&F', '', '0', '3', '/mille', 0),
(15, 1, 'Urine exam', 'BOTH', 'M&F', '', '0', '', '', 30),
(16, 2, 'Blood sugar - Fasting', 'BOTH', 'M&F', '', '60', '110', 'mg/dl', 30),
(17, 2, 'Blood sugar - PP', 'BOTH', 'M&F', '<', '', '140', 'mg/dl', 30),
(18, 2, 'Blood sugar - Ramdom', 'BOTH', 'M&F', '', '', '', 'mg/dl', 30),
(19, 3, 'Protein - Total', 'BOTH', 'M&F', '', '5', '8', 'mg/dl', 50),
(20, 3, 'Albumin', 'BOTH', 'M&F', '', '3', '5', 'mg/dl', 50),
(21, 3, 'Globulin', 'BOTH', 'M&F', '', '2', '3', 'mg/dl', 50),
(22, 3, 'Bilirubin - Total', 'BOTH', 'M&F', '', '0.3', '1.2', 'mg/dl', 50),
(23, 3, 'Bilirubin – Direct', 'BOTH', 'M&F', '', '0.1', '0.3', 'mg/dl', 50),
(24, 3, 'Bilirubin – I Bacteria', 'BOTH', 'M&F', '', '0.2', '0.9', 'mg/dl', 50),
(25, 3, 'SGOT/ AST Other', 'BOTH', 'M&F', '<', '', '46', 'IU/L', 50),
(26, 3, 'SGPT/ALT', 'BOTH', 'M&F', '<', '', '46', 'IU/L', 50),
(27, 3, 'Alka. Phosphatase', 'BOTH', 'M&F', '<', '', '290', 'IU/L', 50),
(28, 4, 'Blood Urea', 'BOTH', 'M&F', '', '15', '45', 'mg/dl', 40),
(29, 4, 'Creatinine', 'BOTH', 'M&F', '', '0.5', '1.4', 'mg/dl', 40),
(30, 4, 'Uric Acid', 'BOTH', 'M&F', '', '2.4', '7', 'mg/dl', 40),
(31, 5, 'Sodium (Na+)', 'BOTH', 'M&F', '', '135', '155', 'mmol/L', 150),
(32, 5, 'Potassium (K+)', 'BOTH', 'M&F', '', '3.5', '5.5', 'mmol/L', 150),
(33, 5, ' Calcium (Ca++)', 'BOTH', 'M&F', '', '8.7', '11', 'mg/dl', 150),
(34, 6, 'Cholesterol', 'BOTH', 'M&F', '<', '0', '200', 'mg/dl', 40),
(35, 6, 'Triglyceride', 'BOTH', 'M&F', '<', '0', '200', 'mg/dl', 40),
(36, 7, 'VDRL', 'BOTH M', '', '', 'Negati', 'Negativ', '', 50),
(37, 7, 'HBSAG', 'BOTH M', '', '', 'Negati', 'Negativ', '', 100),
(38, 7, 'HCV Antibody', 'BOTH M', '', '', 'Negati', 'Negativ', '', 150),
(39, 7, 'RA', 'BOTH M', '', '', 'Negati', 'Negativ', '', 80),
(40, 7, 'ASO', 'BOTH M', '', '', 'Negati', 'Negativ', '', 80),
(41, 7, 'CRP', 'BOTH M', '', '', 'Negati', 'Negativ', '', 150),
(42, 7, 'Scrub Typhus', 'BOTH M', '', '', 'Negati', 'Negativ', '', 300),
(43, 7, 'Widal', 'BOTH M', '', '', 'Negati', 'Negativ', '', 50),
(44, 7, 'Typhidot', 'BOTH M', '', '', 'Negati', 'Negativ', '', 200),
(45, 7, 'Dengue', 'BOTH M', '', '', 'Negati', 'Negativ', '', 300),
(46, 7, 'H.pylori', 'BOTH M', '', '', 'Negati', 'Negativ', '', 200),
(47, 7, 'HIV ', 'BOTH M', '', '', 'Negati', 'Negativ', '', 0),
(48, 7, 'Montoux', 'BOTH M', '', '', 'Negati', 'Negativ', '', 50),
(49, 8, 'Rapid Antigen Test (Ragt)', 'BOTH M', '', '', 'Negati', 'Negativ', '', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `investi_detail`
--
ALTER TABLE `investi_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `investi_detail`
--
ALTER TABLE `investi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
