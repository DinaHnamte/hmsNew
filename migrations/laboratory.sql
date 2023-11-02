
DROP TABLE IF EXISTS `lab_test_template`;
CREATE TABLE `lab_test_template` (
  `id` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `test_type` varchar(255) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `pat_category` varchar(25) NOT NULL,  
  `ref_range` varchar(50) NOT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `labtest`;
CREATE TABLE IF NOT EXISTS `labtest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtest` int(11) NOT NULL DEFAULT '0',
  `idpat` int(11) NOT NULL DEFAULT '0',
  `result` varchar(25) NOT NULL DEFAULT '',
  `create_at` int(11) NOT NULL DEFAULT '0',
  `update_at` int(11) NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `idpat` (`idpat`),
  KEY `idtest` (`idtest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
