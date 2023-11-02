-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 11:40 AM
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
-- Database: `hmsbasic`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) DEFAULT NULL UNIQUE KEY Primary Key AUTO_INCREMENT,
  `name` varchar(34) DEFAULT NULL,
  `form` varchar(10) DEFAULT NULL,
  `composition` varchar(139) DEFAULT NULL,
  `manufacturer` varchar(38) DEFAULT NULL,
  `mrp` decimal(7,2) DEFAULT NULL,
  `price` varchar(5) DEFAULT NULL,
  `packaging` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `myMedicines` (
  `id` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
   KEY `med_id` (`med_id`),
   KEY `doc_id` (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `dosages` (
  `id` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `med_id` int(11) NOT NULL,
  `dose` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
   KEY `med_id` (`med_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`name`, `form`, `composition`, `manufacturer`, `mrp`, `price`, `packaging`) VALUES
('C2Win 1mg Tablet', '', 'Prucalopride (1mg)', 'Samarth Life Sciences Pvt Ltd', 149.00, '111.7', '10 tablets in 1 strip'),
('C 3One 1000mg Injection', '', 'Ceftriaxone (1000mg)', 'Novalife Healthcare', 80.00, '', '1 Injection in 1 vial'),
('Cabaza Tablet', '', 'Pentoxifylline (400mg)', 'Jolly Healthcare', 112.00, '84', '10 tablets in 1 strip'),
('Cabaza Tablet ER', '', 'Pentoxifylline (400mg)', 'Jolly Healthcare', 112.00, '', '10 tablet er in 1 strip'),
('Cabazirix 60mg Injection', '', 'Cabazitaxel (60mg)', 'Therdose Pharma Pvt Ltd', 19272.29, '', '1 Injection in 1 vial'),
('Cacb 4mg Tablet', '', 'Benidipine (4mg)', 'Retro Life Sciences', 99.00, '74.25', '10 tablets in 1 strip'),
('Cacb 8mg Tablet', '', 'Benidipine (8mg)', 'Retro Life Sciences', 153.00, '114.7', '10 tablets in 1 strip'),
('Cadace-PS Tablet', '', 'Aceclofenac (100mg) + Paracetamol (325mg) + Serratiopeptidase (15mg)', 'Cadman Healthcare', 78.00, '', '10 tablets in 1 strip'),
('Cadcold Syrup', '', 'Chlorpheniramine Maleate (2mg/5ml) + Paracetamol (125mg/5ml) + Phenylephrine (5mg/5ml)', 'Cadman Healthcare', 67.00, '', '60 ml in 1 bottle'),
('Cadi-OR Tablet', '', 'Ofloxacin (200mg) + Ornidazole (500mg)', 'Zydus Healthcare Limited', 25.00, '', '10 tablets in 1 strip'),
('Cadma OZ 200mg/500mg Tablet', '', 'Ofloxacin (200mg) + Ornidazole (500mg)', 'Cadman Healthcare', 78.00, '', '10 tablets in 1 strip'),
('Cadnadin 120mg Tablet', '', 'Fexofenadine (120mg)', 'Cadman Healthcare', 93.00, '', '10 tablets in 1 strip'),
('Cadoric 90mg Tablet', '', 'Etoricoxib (90mg)', 'Cadman Healthcare', 96.00, '', '10 tablets in 1 strip'),
('Cadpen 40mg Tablet', '', 'Pantoprazole (40mg)', 'Cadman Healthcare', 57.00, '', '10 tablets in 1 strip'),
('Cadpen D 10mg/40mg Tablet', '', 'Domperidone (10mg) + Pantoprazole (40mg)', 'Cadman Healthcare', 66.00, '', '10 tablets in 1 strip'),
('Cadpen-DSR Capsule', '', 'Domperidone (30mg) + Pantoprazole (40mg)', 'Cadman Healthcare', 87.00, '', '10 capsule sr in 1 strip'),
('Cadpenem 1000mg Injection', '', 'Meropenem (1000mg)', 'Cadman Healthcare', 1902.00, '', '1 Injection in 1 vial'),
('Caefroxel 200mg Tablet', '', 'Cefpodoxime Proxetil (200mg)', 'Caphap Pharmaceuticals', 192.00, '', '10 tablets in 1 strip'),
('Cagpan-DSR Capsule', '', 'Domperidone (30mg) + Pantoprazole (40mg)', 'Cagrus Biopharma', 89.00, '66.75', '10 capsule pr in 1 strip'),
('Cagrab 20mg Tablet', '', 'Rabeprazole (20mg)', 'Cagrus Biopharma', 75.00, '56.25', '10 tablets in 1 strip'),
('Cagrab-DSR Capsule', '', 'Domperidone (30mg) + Rabeprazole (20mg)', 'Cagrus Biopharma', 85.00, '63.75', '10 capsule sr in 1 strip'),
('Calcimate-CL Nasal Spray', '', 'Calcitonin (Salmon) (2200IU)', 'Best Biotech', 1800.00, '1350', '3.7 ml in 1 bottle'),
('Calcirol XT Tablet', '', 'Calcium Carbonate (1250mg) + Vitamin D3 (2000IU) + Methylcobalamin (1500mcg) + L-Methyl Folate Calcium (1mg) + Pyridoxal-5-phosphate (20mg)', 'Cadila Pharmaceuticals Ltd', 295.50, '221.6', '15 tablets in 1 strip'),
('Calcitag CT Capsule', '', 'Methylcobalamin (1500mcg) + Pregabalin (75mg)', 'Intag Remedies', 93.75, '', '10 capsules in 1 strip'),
('Calcitic-CZ Capsule', '', 'Calcitriol (0.25mcg) + Calcium Carbonate (500mg) + Zinc Sulfate (7.5mg)', 'Zestica Pharma', 160.00, '', '15 soft gelatin capsules in 1 strip'),
('Calcium Folinate Injection', '', 'Calcium Leucovorin (50mg)', 'Fresenius Kabi India Pvt Ltd', 330.94, '248.2', '5 ml in 1 vial'),
('Calcobal Plus Injection', '', 'Methylcobalamin (1000mcg) + Vitamin B6 (Pyridoxine) (100mg) + Nicotinamide (100mg)', 'Clarix Healthcare', 90.00, '67.5', '1 Injection in 1 vial'),
('Calcordia M Tablet', '', 'L-Methyl Folate (1mg) + Methylcobalamin (1500mcg) + Pyridoxal-5-phosphate (0.5mg)', 'Concordia Healthcare Private Limited', 98.00, '', '10 tablets in 1 strip'),
('Calmer 10mg Syrup', '', 'Hydroxyzine (10mg/5ml)', 'Esquire Drug House', 55.00, '', '100 ml in 1 bottle'),
('Calpime 1 Injection', '', 'Cefepime (1000mg)', 'H & I Critical Care', 212.60, '159.4', '1 Injection in 1 vial'),
('Calpsor C  Ointment', '', 'Calcipotriol (0.005% w/w) + Clobetasol (0.05% w/w)', 'Biocon', 590.00, '442.5', '30 gm in 1 tube'),
('Calvin 500mg/125mg Tablet', '', 'Amoxycillin  (500mg) +  Clavulanic Acid (125mg)', 'Remandish Pharma Pvt Ltd', 203.00, '', '10 tablets in 1 strip'),
('Camcin N Gel', '', 'Clindamycin (1% w/w) + Nicotinamide (4% w/w)', 'JVJ Pharmaceuticals Pvt Ltd', 137.00, '', '20 gm in 1 tube'),
('Cameriv 10mg Tablet', '', 'Rivaroxaban (10mg)', 'Alembic Pharmaceuticals Ltd', 182.00, '136.5', '14 tablets in 1 strip'),
('Camfloxm Plus Cream', '', 'Ofloxacin (0.75% w/w) + Ornidazole (2% w/w) + Itraconazole (1% w/w) + Clobetasol (0.05% w/w)', 'Swakam Biotech Private Limited', 80.00, '', '15 gm in 1 tube'),
('Camflox O 200mg/500mg Tablet', '', 'Ofloxacin (200mg) + Ornidazole (500mg)', 'Swakam Biotech Private Limited', 90.00, '', '10 tablets in 1 strip'),
('Camifort N Tablet', '', 'Nimesulide (100mg) + Camylofin (50mg)', 'Intel Pharmaceuticals', 65.00, '', '10 tablets in 1 strip'),
('Camifort Suspension', '', 'Camylofin (12mg) + Paracetamol (125mg)', 'Intel Pharmaceuticals', 46.00, '33', '30 ml in 1 bottle'),
('Cancap 200mg Capsule', '', 'Itraconazole (200mg)', 'Ind Swift Laboratories Ltd', 285.00, '213.7', '10 capsules in 1 strip'),
('Candichrome 100 Capsule', '', 'Itraconazole (100mg)', 'Netprime Pharma Pvt Ltd', 149.90, '112.4', '10 capsules in 1 strip'),
('Candichrome 200 Capsule', '', 'Itraconazole (200mg)', 'Netprime Pharma Pvt Ltd', 299.90, '224.9', '10 capsules in 1 strip'),
('Candid-B Lotion', '', 'Beclometasone (0.025% w/v) + Clotrimazole (1% w/v)', 'Glenmark Pharmaceuticals Ltd', 108.00, '81', '10 ml in 1 bottle'),
('Candid Ear Drop', '', 'Ofloxacin (0.3% w/v) + Beclometasone (0.25% w/v) + Clotrimazole (1% w/v)', 'Glenmark Pharmaceuticals Ltd', 84.00, '', '15 ml in 1 bottle'),
('Candiderma Plus  Cream', '', 'Beclometasone (0.025% w/w) + Neomycin (0.5% w/w) + Clotrimazole (1% w/w)', 'Glenmark Pharmaceuticals Ltd', 118.00, '', '15 gm in 1 tube'),
('Candid-K Anti-Dandruff Shampoo', '', 'Ketoconazole (2% w/v) + Zinc pyrithione (1% w/v)', 'Glenmark Pharmaceuticals Ltd', 221.00, '', '75 ml in 1 bottle'),
('Candid KZ Cream', '', 'Ketoconazole (2% w/w)', 'Glenmark Pharmaceuticals Ltd', 176.00, '', '30 gm in 1 tube'),
('Candiforce-SB 50 Capsule', '', 'Itraconazole (50mg)', 'Mankind Pharma Ltd', 105.00, '78.75', '10 capsules in 1 strip'),
('Candikrus 200mg Capsule', '', 'Itraconazole (200mg)', 'Skymax Life Science Pvt Ltd', 125.00, '93.75', '4 capsules in 1 strip'),
('Candipoz-GR Tablet', '', 'Posaconazole (100mg)', 'Glenmark Pharmaceuticals Ltd', 4522.00, '', '10 tablets in 1 strip'),
('Candipraz 100mg Capsule', '', 'Itraconazole (100mg)', 'Glenmark Pharmaceuticals Ltd', 200.00, '150', '10 capsules in 1 strip'),
('Candipraz 100mg Capsule', '', 'Itraconazole (100mg)', 'Glenmark Pharmaceuticals Ltd', 88.00, '66', '4 capsules in 1 strip'),
('Candipraz 200mg Capsule', '', 'Itraconazole (200mg)', 'Glenmark Pharmaceuticals Ltd', 152.00, '114', '4 capsules in 1 strip'),
('Candiraze 100 Capsule', '', 'Itraconazole (100mg)', 'Cure Tech Skincare', 50.00, '37.5', '4 capsules in 1 strip'),
('Canditra 100mg Capsule', '', 'Itraconazole (100mg)', 'Newgen Biotech Pvt. Ltd.', 180.00, '135', '10 capsules in 1 strip'),
('Candiwell 100mg Capsule', '', 'Itraconazole (100mg)', 'Altrawell Biotech Pvt Ltd', 90.00, '67.5', '4 capsules in 1 strip'),
('Candiwell 1% Soap', '', 'Itraconazole (1% w/w)', 'Altrawell Biotech Pvt Ltd', 150.00, '', '75 gm in 1 box'),
('Candiwell 200 Capsule', '', 'Itraconazole (200mg)', 'Altrawell Biotech Pvt Ltd', 124.00, '', '4 capsules in 1 strip'),
('Candizon 100 Tablet', '', 'Itraconazole (100mg)', 'Anvicure Drugs', 90.00, '67.5', '4 tablets in 1 strip'),
('Candizon 200 Capsule', '', 'Itraconazole (200mg)', 'Anvicure Drugs', 124.00, '93', '4 capsules in 1 strip'),
('Canesten Topical Solution', '', 'Clotrimazole (1% w/v)', 'Bayer Pharmaceuticals Pvt Ltd', 89.00, '', '30 ml in 1 bottle'),
('Canex IT 100mg Capsule', '', 'Itraconazole (100mg)', 'Vance   Health Pharmaceuticals Ltd', 119.90, '', '10 capsules in 1 strip'),
('Canex IT 200mg Capsule', '', 'Itraconazole (200mg)', 'Vance   Health Pharmaceuticals Ltd', 199.90, '', '10 capsules in 1 strip'),
('Canfem 200mg Tablet VT', '', 'Clotrimazole (200mg)', 'Cadila Pharmaceuticals Ltd', 35.00, '', '3 tablet vt in 1 strip'),
('Canitro 100 Capsule', '', 'Itraconazole (100mg)', 'Vitabiotech Healthcare Private Limited', 240.00, '', '10 capsules in 1 strip'),
('Canitro 200 Capsule', '', 'Itraconazole (200mg)', 'Vitabiotech Healthcare Private Limited', 390.00, '', '10 capsules in 1 strip'),
('Canpan 40mg Tablet', '', 'Pantoprazole (40mg)', 'Igniva Marketing Pvt Ltd', 95.00, '71.25', '10 tablets in 1 strip'),
('Cans 3 Vaginal Suppository', '', 'Clindamycin (100mg) + Clotrimazole (200mg)', 'Ravenbhel Pharmaceuticals Pvt Ltd', 72.00, '', '3 Vaginal Suppository in 1 strip'),
('Cantocef 1000 Injection', '', 'Ceftriaxone (1000mg)', 'Alicanto Drugs Pvt Ltd', 67.00, '50.25', '1 Injection in 1 vial'),
('Cantocef 500 Injection', '', 'Ceftriaxone (500mg)', 'Alicanto Drugs Pvt Ltd', 48.00, '36', '1 Injection in 1 vial'),
('Cantocef-S Injection', '', 'Ceftriaxone (1000mg) + Sulbactam (500mg)', 'Alicanto Drugs Pvt Ltd', 124.00, '93', '1 Injection in 1 vial'),
('Canyn 100mg Tablet', '', 'Cefpodoxime Proxetil (100mg)', 'Taksa LIfe Sciences', 114.00, '', '10 tablets in 1 strip'),
('Canyn 200mg Tablet', '', 'Cefpodoxime Proxetil (200mg)', 'Taksa LIfe Sciences', 192.00, '', '10 tablets in 1 strip'),
('Canyn O 200mg/200mg Tablet', '', 'Cefpodoxime Proxetil (200mg) + Ofloxacin (200mg)', 'Taksa LIfe Sciences', 220.00, '', '10 tablets in 1 strip'),
('Canzero 100mg Capsule', '', 'Itraconazole (100mg)', 'Zennar Life Sciences', 89.00, '', '4 capsules in 1 strip'),
('Canzero 200mg Capsule', '', 'Itraconazole (200mg)', 'Zennar Life Sciences', 139.00, '', '4 capsules in 1 strip'),
('Capace D 30mg/40mg Capsule SR', '', 'Domperidone (30mg) + Esomeprazole (40mg)', 'Caphap Pharmaceuticals', 101.00, '', '10 capsule sr in 1 strip'),
('Capcefo SB 1000mg/500mg Injection', '', 'Cefoperazone (1000mg) + Sulbactam (500mg)', 'Caphap Pharmaceuticals', 273.00, '', '1 Injection in 1 vial'),
('Capdef 30mg Tablet', '', 'Deflazacort (30mg)', 'Caphap Pharmaceuticals', 324.00, '', '10 tablets in 1 strip'),
('Capdef 6mg Tablet', '', 'Deflazacort (6mg)', 'Caphap Pharmaceuticals', 89.00, '', '10 tablets in 1 strip'),
('Capdoxy 100mg Injection', '', 'Doxycycline (100mg)', 'Caphap Pharmaceuticals', 476.00, '', '1 Injection in 1 vial'),
('Capdriv M 750mcg/75mg Capsule', '', 'Methylcobalamin (750mcg) + Pregabalin (75mg)', 'Addii Biotech Pvt Ltd', 125.00, '', '10 capsules in 1 strip'),
('Capfixo Clav 200mg/125mg Tablet', '', 'Cefixime (200mg) + Clavulanic Acid (125mg)', 'Caphap Pharmaceuticals', 170.00, '', '6 tablets in 1 strip'),
('Capfixo Clav LB 200mg/250mg Tablet', '', 'Cefixime (200mg) + Azithromycin (250mg) + Lactobacillus (60Million spores)', 'Caphap Pharmaceuticals', 242.00, '', '10 tablets in 1 strip'),
('Capfloxzole 200mg/500mg Tablet', '', 'Ofloxacin (200mg) + Ornidazole (500mg)', 'Caphap Pharmaceuticals', 78.00, '', '10 tablets in 1 strip'),
('Capgab NT 400mg/10mg Tablet', '', 'Gabapentin (400mg) + Nortriptyline (10mg)', 'Caphap Pharmaceuticals', 190.00, '', '10 tablets in 1 strip'),
('Capmethin G 300mg/500mcg Tablet', '', 'Gabapentin (300mg) + Methylcobalamin (500mcg)', 'Caphap Pharmaceuticals', 121.00, '', '10 tablets in 1 strip'),
('Capmol 650mg Tablet', '', 'Paracetamol (650mg)', 'Caphap Pharmaceuticals', 15.00, '', '10 tablets in 1 strip'),
('Caporyl-Forte Tablet', '', 'Trypsin (48mg) + Bromelain (90mg) + Rutoside (100mg) + Diclofenac (50mg)', 'Capri Pharmaceuticals', 186.00, '139.5', '10 tablets in 1 strip'),
('Cappan D 30mg/40mg Capsule SR', '', 'Domperidone (30mg) + Pantoprazole (40mg)', 'Caphap Pharmaceuticals', 89.00, '', '10 capsule sr in 1 strip'),
('Capra 1000mg/125mg Injection', '', 'Piperacillin (1000mg) + Tazobactum (125mg)', 'Caphap Pharmaceuticals', 131.00, '', '1 Injection in 1 vial'),
('Caprab-DSR Capsule', '', 'Domperidone (30mg) + Rabeprazole (20mg)', 'Caphap Pharmaceuticals', 84.00, '', '10 capsule sr in 1 strip'),
('Caprabe 20mg Injection', '', 'Rabeprazole (20mg)', 'Caphap Pharmaceuticals', 51.00, '', '1 Injection in 1 vial'),
('Caprgblin-NT Tablet', '', 'Pregabalin (75mg) + Nortriptyline (10mg) + Methylcobalamin (1500mcg)', 'Caphap Pharmaceuticals', 180.00, '', '10 tablets in 1 strip'),
('Capricef 500mg Injection', '', 'Ceftriaxone (500mg)', 'Capri Pharmaceuticals', 37.00, '27.75', '1 Injection in 1 vial'),
('Capricef-CL Tablet', '', 'Cefixime (200mg) + Clavulanic Acid (125mg)', 'Capri Pharmaceuticals', 172.00, '129', '10 tablets in 1 strip'),
('Capricef SS 500mg/250mg Injection', '', 'Ceftriaxone (500mg) + Sulbactam (250mg)', 'Capri Pharmaceuticals', 78.00, '58.5', '1 Injection in 1 vial'),
('Capricort 4mg Tablet', '', 'Methylprednisolone (4mg)', 'Capri Pharmaceuticals', 51.00, '38.25', '10 tablets in 1 strip'),
('Capridox 200 Tablet DT', '', 'Cefpodoxime Proxetil (200mg)', 'Capri Pharmaceuticals', 192.00, '144', '10 tablet dt in 1 strip'),
('Capridox CV 200mg/125mg Tablet', '', 'Cefpodoxime Proxetil (200mg) + Clavulanic Acid (125mg)', 'Capri Pharmaceuticals', 202.00, '151.5', '6 tablets in 1 strip'),
('Caprimox CL 1000mg/200mg Injection', '', 'Amoxycillin  (1000mg) +  Clavulanic Acid (200mg)', 'Capri Pharmaceuticals', 144.00, '108', '1 Injection in 1 vial');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
