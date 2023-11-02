-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 06:30 AM
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
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(18) DEFAULT NULL,
  `type` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `type`) VALUES
(1, 'Investigation', 'Disease'),
(2, 'Diagnosis', 'Syndrome'),
(3, 'Psychiatry Section', 'Disease'),
(4, 'Dental Section', 'Disease'),
(5, 'Gynae Section', 'Disease'),
(6, 'General Section', 'Disease');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;


--
-- Table structure for table `idsp_disease`
--

CREATE TABLE `idsp_disease` (
  `id` int(11) NOT NULL,
  `section_id` int(1) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `icd_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `idsp_disease`
--

INSERT INTO `idsp_disease` (`id`, `section_id`, `title`, `icd_code`) VALUES
(1, 1, 'Anthrax', 'A22.7'),
(2, 1, 'Chicken pox ', 'B01'),
(3, 1, 'Chikungunya', 'A92.0'),
(4, 1, 'Cholera', 'A00.1'),
(5, 1, 'Congo Crimean Haemorrhagic Fever', 'A98'),
(6, 1, 'COVID-19', 'U07.1'),
(7, 1, 'Dengue', 'A90'),
(8, 1, 'Diphtheria', 'A36.9'),
(9, 1, 'Hepatitis A', 'B15'),
(10, 1, 'Hepatitis E', 'B17.2'),
(11, 1, 'Human Rabies', 'A82.9'),
(12, 1, ' Influenza', 'J10.1'),
(13, 1, ' Japanese Encephalitis', 'A83.0'),
(14, 1, 'Kyasanur Forest Disease', 'A98.2'),
(15, 1, 'Leptospirosis', 'A27'),
(16, 1, 'Malaria', 'B54'),
(17, 1, 'Measles ', 'B05'),
(18, 1, 'Meningitis', 'G03.9'),
(19, 1, 'Mumps', 'B26'),
(20, 1, 'Pertussis', 'A37.0'),
(21, 1, 'Rubella', 'B06'),
(22, 1, 'Scrub Typhus', 'A75.3'),
(23, 1, 'Shigellosis', 'A03.0'),
(24, 1, 'typhoid', 'A01.0'),
(25, 1, 'Active Tuberculosis', 'Z11.1'),
(26, 1, 'Campylobacterosis', 'A04.5'),
(27, 1, 'Ebola', 'A98.4'),
(28, 1, 'Entamoeba Histolytica', 'A06.0'),
(29, 1, 'Gullian Barre Syndrome', 'G61.0'),
(30, 1, 'Haemophilus influenzae', 'B96.3'),
(31, 1, 'Hepatitis B ', 'B19.10'),
(32, 1, 'Hepatitis C', 'B18.2'),
(33, 1, 'Hepatitis D', 'B17.8'),
(34, 1, 'MERSCov', 'J20.8'),
(35, 1, 'Neisseria meningitidis', 'A39.0'),
(36, 1, 'Nipah Virus', 'B33.8'),
(37, 1, 'Pathogenic E Coli', 'A04.0'),
(38, 1, 'Respiratory Syncytial Viruses (RSV)', 'B974'),
(39, 1, 'Rotavirus', 'A08.0'),
(40, 1, 'Streptococcus pneumoniae', 'J13'),
(41, 1, 'Transverse Myelitis', 'G37.3'),
(42, 1, 'Traumatic Neuritis', 'M79.2'),
(43, 1, 'West Nile Fever', 'A92.31'),
(44, 1, 'Yellow Fever ', 'A95'),
(45, 1, 'Zika Virus', 'A92.5'),
(46, 1, 'Other', ''),
(47, 2, 'Only fever >= 7 days', 'R50.9'),
(48, 2, 'Only fever < 7days', 'R50.9'),
(49, 2, 'Fever with Rash', 'R50.81'),
(50, 2, 'Fever with Bleeding', 'A99.0'),
(51, 2, 'Fever with Altered sensorium', 'R41.8'),
(52, 2, 'Cough <= 2 weeks with fever', ''),
(53, 2, 'Cough <= 2 weeks without fever', ''),
(54, 2, 'Cough > 2 weeks with fever', ''),
(55, 2, 'Cough > 2 weeks without fever', ''),
(56, 2, 'Cough with blood', 'R04.2'),
(57, 2, 'Acute Flaccid Paralysis', 'G04.82'),
(58, 2, 'Animal bite - Snake Bite', 'T63.0'),
(59, 2, 'Animal bite - Dog Bite', 'W54'),
(60, 2, 'Animal bite - Monkey Bite', 'W55.81'),
(61, 2, 'Animal bite - Other', 'W55.8'),
(62, 2, 'Acute Diarrhoeal Disease', 'R19.7'),
(63, 2, 'Acute Encephalitic Syndrome', 'G93.40'),
(64, 2, 'Acute Hepatitis', 'K72.00'),
(65, 2, 'ARI/Influenza Like Illness (ILI)', 'J10.1'),
(66, 2, 'ARI/Severe Acute Respitatory Infection (SARI)', 'J06'),
(67, 2, 'Dysentery', 'A06.0'),
(68, 2, 'Others', ''),
(69, 3, 'Alcohol Dependency Syndrome (ADS)', 'F10.2'),
(70, 3, 'Opoid Dependency Syndrome (ODS)', 'F11'),
(71, 3, 'Generalised Anxiety Disorder (GAD)', 'F41.1'),
(72, 3, 'Major Depressive Disorder (MDD)', 'F33.3'),
(73, 3, 'Mix Anxiety Depression (MAD)', 'F41.2'),
(74, 3, 'Schizophernia', 'F20'),
(75, 3, 'Depression', 'F32'),
(76, 3, 'Anxiety', 'F41.1'),
(77, 3, 'Depressive Disorder', 'F32.1'),
(78, 3, 'Chronic Insomnia', 'G47.00'),
(79, 3, 'BPAD', 'F31'),
(80, 3, 'Panic', 'F41.0'),
(81, 3, 'Seizure Disorder', 'G40.91'),
(82, 3, 'Mix Anxiety Depression Depressive', 'F44'),
(83, 3, 'Dissociative Disorder', 'F44.8'),
(84, 3, 'Auditory Processing Disorder', 'H93.25'),
(85, 3, 'Post Traumatic Stress Disorder', 'F43.12'),
(86, 3, 'Adjustment Disorder', 'F43.2'),
(87, 3, 'Delusion Disorder', 'F22'),
(88, 3, 'Dementia', 'F03'),
(89, 3, 'Organic Personality Disorder', 'F07.0'),
(90, 3, 'Acute Stress Reaction', 'F43.0'),
(91, 3, 'Mild Depression', 'F32.0'),
(92, 3, 'Social Anxiety', 'F41.1'),
(93, 3, 'Intellectual Disability', 'F70'),
(94, 3, 'Parkinson Desease', 'G20'),
(95, 3, 'Suicidal attempt', 'T14.91'),
(96, 3, 'Attention Deficit Hyperactivity Disorder', 'F90.0'),
(97, 3, 'Multiple Substance Disorder', 'F19'),
(98, 3, 'Intellectual or Developmental Disabilities', 'F79'),
(99, 3, 'Psychosis', 'F06.2'),
(100, 3, 'Development Disorder', 'F43'),
(101, 3, 'Acute Pulmonary Edema', 'J81.0'),
(102, 3, 'Obcessive Compulsive Disorder', 'F42'),
(103, 3, 'Somatization Disorder', 'F45.0'),
(104, 3, 'Moderate Depressive Episode', 'F32.1'),
(105, 3, 'Severe Depressive Episode', 'F32.8'),
(106, 3, 'Down Syndrome', 'Q90.9'),
(107, 3, 'Delay Speech', 'F90.9'),
(108, 3, 'Sleep Disturbance', 'F51.9'),
(109, 3, 'Stuttering', 'F80.8'),
(110, 3, 'Amnestic Disorder', 'F04'),
(111, 3, 'Schizoaffective Disorders', 'F25'),
(112, 3, 'Phobia', 'F40'),
(113, 3, 'Autism Spectrum Disorder', 'F84'),
(114, 3, 'Cognitive Dysfunction', 'F70'),
(115, 3, 'Premenstrural Tension Syndrome', 'N94.1'),
(116, 3, 'Organic Amnestic Syndrome', 'F04'),
(117, 3, 'Stroke', 'I63.9'),
(118, 3, 'Borderline Personality Disorder', 'F60.3'),
(119, 3, 'Bipolar Affective Disorder', 'F31'),
(120, 3, 'Alcohol Abuse', 'F10'),
(121, 3, 'Mild Mental Reatardation', 'F70'),
(122, 3, 'Parkinson\'s Disease', 'G20'),
(123, 3, 'Ganja Abuse', 'F12'),
(124, 3, 'Cannabis Induced Psychosis', 'F12.95'),
(125, 3, 'Mixed Anxiety Disorder', 'F41.2'),
(126, 3, 'Coversion Disorder', 'F44.4'),
(127, 3, 'Dysthyma', 'F33'),
(128, 3, 'Alzheimar\'s Disease', 'G30.9'),
(129, 3, 'Codeine Abuse', 'F19.20'),
(130, 3, 'Anger Disorder', 'G45.4'),
(131, 4, 'Periapical Abscess', 'K04.7'),
(132, 4, 'Retained Tooth', 'z18.32'),
(133, 4, 'Multiple Tooth Caries', 'K08.9'),
(134, 4, 'Mobile Tooth', 'K08.89'),
(135, 4, 'Tooth Pain', 'K08.89'),
(136, 4, 'Dental Restoration/Filling', 'Z98.811'),
(137, 4, 'Caries Exposed', 'Z91.842'),
(138, 4, 'Deep Caries', 'K02.7'),
(139, 4, 'Caries Proximal', 'K02.9'),
(140, 4, 'Tooth Sensitivity', 'K08.89'),
(141, 4, 'Impacted Teeth', 'K01.1'),
(142, 4, 'Alveoloplasty', 'M26.71'),
(143, 4, 'Multiple Upper Anterior Caries', 'K00.2'),
(144, 4, 'Severe Attrition', 'K03.0'),
(145, 4, 'Composite Filling', 'Z98.811'),
(146, 4, 'Abscess Caries', 'K02.9'),
(147, 4, 'Palatal Examination', 'K13'),
(148, 4, 'Crossbite', 'M26.24'),
(149, 4, 'Exposed Caries', 'K08.54'),
(150, 4, 'Pulpititis', 'K04.0'),
(151, 4, 'Ulcerated', 'K27.9'),
(152, 4, 'Buccal Caries', 'K02.9'),
(153, 4, 'Sensitivity with Pain', 'K02.9'),
(154, 4, 'Broken Caries', 'K03.62'),
(155, 4, 'Invasive ulcerated Buccal', 'K12.30'),
(156, 4, 'Malpositioned Teeth', 'M26.30'),
(157, 4, 'Delayed Eruption', 'K00.6'),
(158, 4, 'Pericoronitis', 'K05.3'),
(159, 4, 'Erupting Pain', 'K00.6'),
(160, 4, 'Stitch Remove', 'Z45.82'),
(161, 4, 'Gingival Pocket', 'K05'),
(162, 4, 'Missing tooth', 'K08.109'),
(163, 4, 'Stitch given', 'Z98.811'),
(164, 4, 'Over eruption', 'K00.6'),
(165, 4, 'Tissue Impacted', 'K01.1'),
(166, 4, 'Silver Filling', 'Z98.811'),
(167, 4, 'Lymphatic Swelling', 'R59.9'),
(168, 4, 'Pericoronitis', 'K05.3'),
(169, 4, 'Deep Pockets', 'K05.30'),
(170, 4, 'Neuralgia', 'M79.2'),
(171, 4, 'Teeth Stain', 'K01.1'),
(172, 4, 'Post Filling Pain', 'K08.89'),
(173, 5, 'Antenetal Care', 'Z36'),
(174, 5, 'Menorrhagia', 'N92.0'),
(175, 5, 'Urinary tract Infection', 'N93.0'),
(176, 5, 'Copper T Removal', 'Z30.432'),
(177, 5, 'Vaginite', 'N77.1'),
(178, 5, 'Irregural Menstruation', 'N92.6'),
(179, 5, 'Incomplete Abortion', 'O003.4'),
(180, 5, 'Threatened Abortion', 'O20.0'),
(181, 5, 'Copper T Insertion', 'Z30.430'),
(182, 5, 'Anaemia', 'D64.9'),
(183, 5, 'Bartholin Cyst', 'N75.0'),
(184, 5, 'Menopousal Syndrom', 'N95.1'),
(185, 5, 'Dysmenorrhea', 'N94.6'),
(186, 5, 'Post Delivery check up', 'Z39.0'),
(187, 5, 'Polycystic Ovarian Syndrome', 'N97.0'),
(188, 5, 'Discharge of Vagina', 'N89.8'),
(189, 5, 'Ovarian Cyst', 'R36.9'),
(190, 5, 'Vaginal Candidiasis', 'B37.3'),
(191, 5, 'Haematuria', 'R31.9'),
(192, 5, 'Term Pregnancy For Induction', 'O75.82'),
(193, 5, 'Post Natal Care', 'Z39.0'),
(194, 5, 'Endometrial Polyp', 'N84.0'),
(195, 5, 'Abnormal Uterine Bleeding', 'N93.9'),
(196, 5, 'Missed Abortion', 'O02.1'),
(197, 5, 'Scanty Menstruation', 'N91'),
(198, 5, 'Galactorrhea', 'O92.6'),
(199, 5, 'Intermenstrual Bleeding', 'N92.1'),
(200, 5, 'Amenorrhea', 'N91.2'),
(201, 5, 'pain Urethra', 'N34'),
(202, 5, 'Secondary Infertility', 'M97.2'),
(203, 5, 'Post Abortion', 'O04.89'),
(204, 5, 'Tubectomy', 'Z98.51'),
(205, 5, 'Wound Gafing', 'O90.1'),
(206, 5, 'Pap Smear', 'Z12.4'),
(207, 5, 'Dysfunctional Uterine Bleeding', 'N93.9'),
(208, 5, 'Cervicities', 'N72'),
(209, 5, 'Decreased Libido', 'R68.82'),
(210, 5, 'Post LSCS Check up', 'Z39.2'),
(211, 5, 'uterine Fibroid', 'D25.9'),
(212, 5, 'Pelvic Inflammatory Disease', 'N73.9'),
(213, 5, 'Endometrial Biopsy', 'N85.02'),
(214, 5, 'Premenstrual Syndrome', 'N94.3'),
(215, 5, '', ''),
(216, 6, 'Elosa Dengue', 'A90'),
(217, 6, 'Joint Pain', 'M25.569'),
(218, 6, 'Dengue', 'A90'),
(219, 6, 'Sore Throat', 'R07.0'),
(220, 6, 'UTI', 'N39.0'),
(221, 6, 'Pulmonary', 'J44.9'),
(222, 6, 'Scabies', 'B86'),
(223, 6, 'Typhoid', 'A01.0'),
(224, 6, 'ARI', 'J06.9'),
(225, 6, 'Anemia', 'D64.9'),
(226, 6, 'Lrti', 'J22'),
(227, 6, 'APD', 'H93.25'),
(228, 6, 'Spndylitis', 'M45.9'),
(229, 6, 'Ankle Pain', 'M25.57'),
(230, 6, 'PUO', 'O86.4'),
(231, 6, 'Coryza', 'J00'),
(232, 6, 'General Examination', 'Z00'),
(233, 6, 'IBS', 'K58'),
(234, 6, 'Ulcer', 'K27.9'),
(235, 6, 'GERD', 'K21.9'),
(236, 6, 'Soreness', 'R52'),
(237, 6, 'Neuropathy', 'G60.9'),
(238, 6, 'Food Poisoning', 'A05.9'),
(239, 6, 'Amoebiasis', 'A06.9'),
(240, 6, 'Allergic Rhintis', 'J30.9'),
(241, 6, 'tonsilitis', 'J03.90'),
(242, 6, 'Myalgia', 'M79.1'),
(243, 6, 'Tinea Corposis ', 'B35.4'),
(244, 6, 'Enteric Fever', 'A01.0'),
(245, 6, 'Koch Disease', 'A16.9'),
(246, 6, 'Reflux', 'K21.9'),
(247, 6, 'HTN', 'R03.0'),
(248, 6, 'Swelling', 'R22.9'),
(249, 6, 'Diarrhea', 'R19.7'),
(250, 6, 'Cervical Spondylosis', 'M47.892'),
(251, 6, 'General Chest Pain', 'R07.9'),
(252, 6, 'H. Pylori', 'B98.0'),
(253, 6, 'LFT', 'R94.5'),
(254, 6, 'Conginital', 'Q89.9'),
(255, 6, 'Pharyngitis', 'J02.9'),
(256, 6, 'URTI', 'J06.9'),
(257, 6, 'Tubercolosis', 'A15.0'),
(258, 6, 'Mastoidities', 'H70.90'),
(259, 6, 'Axillary', 'L02.411'),
(260, 6, 'Arthritis', 'M13.80'),
(261, 6, 'Scrub typhus', 'A75.3'),
(262, 6, 'Cololities', 'K52.9'),
(263, 6, 'jaunice', 'R17'),
(264, 6, 'Acute Bronchitis', 'J20.9'),
(265, 6, '', ''),
(266, 6, 'RTI', 'J06.9'),
(267, 6, 'AGE', 'R41'),
(268, 6, 'URI', 'J06.9'),
(269, 6, 'URTI', 'J44.9'),
(270, 6, 'AFI', 'J06'),
(271, 6, 'PHARYNGITIS', 'J02.9'),
(272, 6, 'WALRI', 'R06.2'),
(273, 6, 'RAD', 'J66'),
(274, 6, 'LOOSE STOOL', 'R19.7'),
(275, 6, 'URI', 'J06.9'),
(276, 6, 'EMESUS', 'R11.10'),
(277, 6, 'HFMD', 'B08.4'),
(278, 6, 'IDP', 'G61.81'),
(279, 6, 'OROPHARYNGITIS', 'J02.9'),
(280, 6, 'DIARRHOEA', 'P78.3'),
(281, 6, 'GASTRITIS', 'K29'),
(282, 6, 'COLIE', 'B96.2'),
(283, 6, 'ECZEMA', 'L20.83'),
(284, 6, 'DYSPEPSIA', 'K30'),
(285, 6, 'ORAL', 'K12.0'),
(286, 6, 'BRONCHITIS', 'J20.9'),
(287, 6, 'IMPETIGO', 'L01.00'),
(288, 6, 'UTI', 'B95'),
(289, 6, 'PNEUMONIA', 'J18'),
(290, 6, 'NNJ', 'P59.9'),
(291, 6, 'NASAL ULCER', 'J34.81'),
(292, 6, 'IAP', 'R50.9'),
(293, 6, 'RAD', 'J66'),
(294, 6, 'TONSILITIES', 'J03.90'),
(295, 6, 'ENEMIA', 'D64.9'),
(296, 6, 'CHICKEN POX', 'B01'),
(297, 6, 'PAIN ABDOMEN', 'R10.9'),
(298, 6, 'PROBABLE SEPSIS', 'A41.9'),
(299, 6, 'ENTERIC FEVER', 'A01.0'),
(300, 6, 'WELL BABY', 'Z00.129'),
(301, 6, 'DYSURE', 'R30.0'),
(302, 6, 'ANGULAR', 'H10.52'),
(303, 6, 'SHINGLES', 'B02'),
(304, 6, 'ORAL ULCER', 'K12.0'),
(305, 6, 'NASAL COUGH', 'J94'),
(306, 6, 'ENZEMA', 'L30.9'),
(307, 6, 'GLOSSITIS', 'K14.0'),
(308, 6, 'CONSTIPATION', 'K59.90'),
(309, 6, 'DYSMA', 'R06.0'),
(310, 6, 'MENINGITIS', 'G03.9'),
(311, 6, 'DYSPEPTIA', 'K30'),
(312, 6, 'FALL FROM HEIGHT', 'Y30'),
(313, 6, 'CHALAZEN', 'H00.1'),
(314, 6, 'FTT', 'R62.51'),
(315, 6, 'ATOPSY', 'L20.9'),
(316, 6, 'SCABIES', 'B86'),
(317, 6, 'ATI', 'N17.0'),
(318, 6, 'INJURY', 'T14.90'),
(319, 6, 'SORENESS', 'R52'),
(320, 6, 'KOCH', 'A16.9'),
(321, 6, 'PUO', 'O86.4'),
(322, 6, 'H.PYLORI', 'B98.0'),
(323, 6, 'LFT', 'R94.5'),
(324, 6, 'SCRUB TYPHUS', 'A75.3'),
(325, 6, 'SWELLING', 'R22.9'),
(326, 6, 'GENERAL EXAMINATION', 'Z00'),
(327, 6, 'HTN', 'R03.0'),
(328, 6, 'DENGUE', 'A90'),
(329, 6, 'JOIN PAIN', 'M25.56'),
(330, 6, 'ARI', 'J06.9'),
(331, 6, 'TYPHOID', 'A01.0'),
(332, 6, 'ARD', 'H93.25'),
(333, 6, 'APD', 'H93.26'),
(334, 6, 'IBS', 'K58'),
(335, 6, 'CORYZA', 'J00'),
(336, 6, 'SPONDYLITIES', 'M45.9'),
(337, 6, 'PULMONARY', 'J44.9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `idsp_disease`
--
ALTER TABLE `idsp_disease`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `idsp_disease`
--
ALTER TABLE `idsp_disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
