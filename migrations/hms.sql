
create table `auth_role`
(
   `id` int(11) NOT NULL Primary KEY AUTO_INCREMENT,
   `name`                 varchar(64) not null,
   `app_id`               varchar(10) not null,
   `description`          text,
   `created_at`           integer,
   `updated_at`           integer,
   INDEX (`name`, `app_id`)
) engine InnoDB;

create table `auth_assignment`
(
   `id` int(11) NOT NULL Primary KEY AUTO_INCREMENT,
   `role_id`            varchar(64) not null,
   `tenant_id`               char(13) not null,
   `user_id`              varchar(11) not null,
   `created_at`           integer,
   INDEX (`role_id`, `user_id`, `tenant_id`)
) engine InnoDB;

create table `app`
(
   `id` int(4) NOT NULL Primary KEY AUTO_INCREMENT,
   `name`            varchar(10) not null
) engine InnoDB AUTO_INCREMENT=1000;

CREATE TABLE `tenantapp` (
  `id` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `app_id` char(4) NOT NULL,
  `tenant_id` char(13) NOT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `tenants` (
  `id` char(13) NOT NULL,
  `app_id` char(10) NOT NULL,
  `regby_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `mobno` varchar(10) NOT NULL DEFAULT '0',
  `add1` varchar(50) NOT NULL DEFAULT '',
  `dist` varchar(50) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


CREATE TABLE `employee` (
  `id` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `tenant_id` char(13) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  primary key (`id`),
  INDEX (tenant_id, user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci AUTO_INCREMENT=10000000;

CREATE TABLE `reguser` (
  `id` int(11) NOT NULL,
  `pwd` bit(1) NOT NULL DEFAULT b'0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `fname` varchar(50) NOT NULL DEFAULT '',
  `dob` date NOT NULL DEFAULT '0001-01-01',
  `sex` varchar(10) NOT NULL DEFAULT '',
  `tribe` varchar(10) NOT NULL DEFAULT '',
  `commu` varchar(20) NOT NULL DEFAULT '',
  `religion` varchar(20) NOT NULL DEFAULT '',
  `bg` varchar(10) NOT NULL DEFAULT '',
  `mobno` varchar(10) NOT NULL DEFAULT '0',
  `add1` varchar(50) NOT NULL DEFAULT '',
  `dist` varchar(50) NOT NULL DEFAULT '',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci AUTO_INCREMENT=1000000;


--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `encounter_id` char(13) NOT NULL DEFAULT 0,
  `idmyicd10` int(11) NOT NULL DEFAULT 0,
  `icd_code` varchar(6) NOT NULL DEFAULT '0',
  `diag` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


CREATE TABLE `prescript` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `prescript_dt` date NOT NULL DEFAULT '0001-01-01',         
  `encounter_id` char(13) NOT NULL DEFAULT 0,
  `med_id` int(11) NOT NULL DEFAULT 0,
  `medi` varchar(100) NOT NULL DEFAULT '',
  `dose` varchar(100) NOT NULL DEFAULT '',
  INDEX (`encounter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `encounter` (
  `id` char(13) NOT NULL PRIMARY KEY,
  `encounter_type` varchar(20) NOT NULL DEFAULT '',   
  `pat_id` int(11) NOT NULL DEFAULT 0,
  `hsp_id` char(13) NOT NULL DEFAULT 0,
  `chief_complaint` varchar(250) NOT NULL DEFAULT '',
  `ref_dept` varchar(10) NOT NULL DEFAULT '0',
  `dr_id` varchar(10) NOT NULL DEFAULT '0',
  `admit` bit(1) NOT NULL DEFAULT b'0',
  `btest` bit(1) NOT NULL DEFAULT b'0',
  `reg_fee` int(4) NOT NULL DEFAULT 0,
  `registered_at` int(11) DEFAULT 0,                
  `counter_at` int(11) DEFAULT 0,                   
  `session_start_at` int(11) DEFAULT 0,             
  `session_end_at` int(11) DEFAULT 0,               
   INDEX (`pat_id`, `hsp_id`,`ref_dept`,`dr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `myicd10` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `icd10id` int(11) NOT NULL DEFAULT '0',
  `icd_code` char(6) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `tenant_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Table structure for table `ipdreg`
--

CREATE TABLE `ipdreg` (
  `id` char(13) NOT NULL UNIQUE KEY,
  `pat_id` int(11) NOT NULL DEFAULT 0,
  `tenant_id` char(13) NOT NULL DEFAULT 0,
  `ward_id` int(11) NOT NULL DEFAULT '',
  `admited_by` int(11) NOT NULL DEFAULT '0',
  `admited_at` int(11) DEFAULT 0,
  `discharged_at` int(11) DEFAULT 0,
  `discharge_reason` varchar(100) NOT NULL DEFAULT '',
  `icd_code` varchar(8) NOT NULL DEFAULT '',
   primary key (`id`),
   INDEX (`pat_id`, `tenant_id`, `ward_id`, `icd_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenant_id` char(13) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` bit(1) NOT NULL Default 0,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `employee_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenant_id` char(13) NOT NULL,
  `emp_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `dept_id` int(11) NOT NULL DEFAULT 0,
  primary key (`id`),
  INDEX (`emp_id`, `tenant_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `wards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenant_id` char(13) NOT NULL,
  `beds` int(2) NOT NULL,
  `occupied` int(2) NOT NULL,
  `cost` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  primary key (`id`),
  INDEX (`tenant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `vitalsign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_id` char(13) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `value` varchar(10) NOT NULL DEFAULT '',
  primary key (`id`),
  INDEX (`encounter_id`, `pat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
