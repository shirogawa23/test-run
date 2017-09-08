-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2017 at 05:43 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghdc`
--

-- --------------------------------------------------------

--
-- Table structure for table `companydetails_tbl`
--

CREATE TABLE `companydetails_tbl` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_contact` varchar(255) DEFAULT NULL,
  `company_res_add` varchar(255) DEFAULT NULL,
  `company_bill_add` varchar(255) DEFAULT NULL,
  `company__email` varchar(255) DEFAULT NULL,
  `company_description` varchar(255) DEFAULT NULL,
  `company_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '1',
  `company_branch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `corporate_accounts_tbl`
--

CREATE TABLE `corporate_accounts_tbl` (
  `corp_id` int(11) NOT NULL,
  `corp_name` varchar(255) NOT NULL,
  `corp_contact` varchar(255) DEFAULT NULL,
  `corp_email` varchar(255) DEFAULT NULL,
  `corp_pack_id` int(11) NOT NULL,
  `corp_contactperson` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_rebate_tbl`
--

CREATE TABLE `doctor_rebate_tbl` (
  `rebate_id` int(11) NOT NULL,
  `rebate_doctor_id` int(11) DEFAULT NULL,
  `rebate_latest` datetime NOT NULL,
  `rebate_percentage` float(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_access_tbl`
--

CREATE TABLE `employee_access_tbl` (
  `access_id` int(11) NOT NULL,
  `access_module_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `access_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_role_tbl`
--

CREATE TABLE `employee_role_tbl` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_role_tbl`
--

INSERT INTO `employee_role_tbl` (`role_id`, `role_name`, `status`) VALUES
(4, 'Radiologist', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `emp_id` int(11) NOT NULL,
  `emp_fname` varchar(255) NOT NULL,
  `emp_mname` varchar(255) NOT NULL,
  `emp_lname` varchar(255) NOT NULL,
  `emp_type_id` int(11) NOT NULL,
  `emp_address` varchar(255) DEFAULT NULL,
  `emp_username` varchar(255) DEFAULT NULL,
  `emp_password` varchar(255) DEFAULT NULL,
  `emp_medtech_rank_id` int(11) DEFAULT NULL,
  `license_no` varchar(250) DEFAULT NULL,
  `emp_contact` varchar(255) DEFAULT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`emp_id`, `emp_fname`, `emp_mname`, `emp_lname`, `emp_type_id`, `emp_address`, `emp_username`, `emp_password`, `emp_medtech_rank_id`, `license_no`, `emp_contact`, `status`) VALUES
(1, 'Billy', 'Lucas', 'Santos', 4, 'Quezon City', 'admin123', 'admin123', 1, 'N1242-1245', '09175664147', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medtech_rank`
--

CREATE TABLE `medtech_rank` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(20) NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medtech_rank`
--

INSERT INTO `medtech_rank` (`rank_id`, `rank_name`, `status`) VALUES
(1, 'Chief', 1),
(2, 'Senior', 1),
(3, 'Staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_tbl`
--

CREATE TABLE `module_tbl` (
  `module_id` int(11) NOT NULL,
  `module_part` varchar(20) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_detail` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_price_tbl`
--

CREATE TABLE `package_price_tbl` (
  `pack_price_id` int(11) NOT NULL,
  `pack_price` decimal(11,2) NOT NULL,
  `pack_latestprice` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_service_tbl`
--

CREATE TABLE `package_service_tbl` (
  `pack_serv_package_id` int(11) NOT NULL,
  `pack_serv_serv_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_tbl`
--

CREATE TABLE `package_tbl` (
  `pack_id` int(11) NOT NULL,
  `pack_name` varchar(255) NOT NULL,
  `pack_price_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_gender_tbl`
--

CREATE TABLE `patient_gender_tbl` (
  `gender_id` int(11) NOT NULL,
  `gender_name` varchar(6) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_gender_tbl`
--

INSERT INTO `patient_gender_tbl` (`gender_id`, `gender_name`, `status`) VALUES
(1, 'Male', 1),
(2, 'Female', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_tbl`
--

CREATE TABLE `patient_tbl` (
  `patient_id` int(11) NOT NULL,
  `patient_fname` varchar(255) NOT NULL,
  `patient_mname` varchar(255) DEFAULT NULL,
  `patient_lname` varchar(255) NOT NULL,
  `patient_address` varchar(255) NOT NULL,
  `patient_contact` varchar(255) NOT NULL,
  `patient_birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `patient_gender_id` int(6) NOT NULL,
  `patient_type_id` int(11) NOT NULL,
  `patient_corp_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_type_tbl`
--

CREATE TABLE `patient_type_tbl` (
  `ptype_id` int(11) NOT NULL,
  `ptype_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_type_tbl`
--

INSERT INTO `patient_type_tbl` (`ptype_id`, `ptype_name`, `status`) VALUES
(1, 'Walk-in', 1),
(2, 'Corporate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rolefields_tbl`
--

CREATE TABLE `rolefields_tbl` (
  `role_id` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `username` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `license` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolefields_tbl`
--

INSERT INTO `rolefields_tbl` (`role_id`, `address`, `username`, `password`, `rank`, `license`, `contact`, `status`) VALUES
(4, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_group_tbl`
--

CREATE TABLE `service_group_tbl` (
  `servgroup_id` int(11) NOT NULL,
  `servgroup_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_price_tbl`
--

CREATE TABLE `service_price_tbl` (
  `serv_price_id` int(11) NOT NULL,
  `serv_price` decimal(11,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_tbl`
--

CREATE TABLE `service_tbl` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_group_id` int(11) DEFAULT NULL,
  `service_type_id` int(11) DEFAULT NULL,
  `service_price_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_type_tbl`
--

CREATE TABLE `service_type_tbl` (
  `service_type_id` int(11) NOT NULL,
  `service_type_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `service_type_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `emp_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `role`, `email`, `display_name`, `created_at`, `updated_at`, `deleted`, `emp_id`) VALUES
(1, 'Admin', '$2y$10$R21a.6u.wqcpwJTWCoAFt.70yc.9jrAa.Na84D3e2j5rNh6JrOB42', 'XWDLckzTKd3LyzdCebMvNfdolgQ0FaYhSapDnvdhxRJ1xjWKs3EKr6vdheZN', 'admin', '', 'Admin', '2017-06-18 04:44:13', '2017-06-18 04:44:13', 0, 1),
(2, 'Lazaro101', '$2y$10$rZeJnQDdQXBeIDdiFNQKa.CNcnE5qjGS8JiQDGh2PIMXT4Cjua2vi', 'y1s0DF3lunQVHjNq67cAHPwuuaianaFMWNeJiBYXUHtnVUN4gHgJNNKrPym9', 'admin', 'louiselazaro06@gmail.com', 'John Louise', '2017-06-21 11:28:59', '2017-06-21 11:28:59', 0, 91);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companydetails_tbl`
--
ALTER TABLE `companydetails_tbl`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `corporate_accounts_tbl`
--
ALTER TABLE `corporate_accounts_tbl`
  ADD PRIMARY KEY (`corp_id`),
  ADD KEY `corp_pack_id` (`corp_pack_id`);

--
-- Indexes for table `doctor_rebate_tbl`
--
ALTER TABLE `doctor_rebate_tbl`
  ADD PRIMARY KEY (`rebate_id`),
  ADD KEY `rebate_doctor_id` (`rebate_doctor_id`);

--
-- Indexes for table `employee_access_tbl`
--
ALTER TABLE `employee_access_tbl`
  ADD PRIMARY KEY (`access_id`),
  ADD KEY `access_module_id` (`access_module_id`),
  ADD KEY `access_role_id` (`access_role_id`);

--
-- Indexes for table `employee_role_tbl`
--
ALTER TABLE `employee_role_tbl`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `emp_department_id` (`emp_medtech_rank_id`),
  ADD KEY `emp_type_id` (`emp_type_id`);

--
-- Indexes for table `medtech_rank`
--
ALTER TABLE `medtech_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `module_tbl`
--
ALTER TABLE `module_tbl`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `package_price_tbl`
--
ALTER TABLE `package_price_tbl`
  ADD PRIMARY KEY (`pack_price_id`);

--
-- Indexes for table `package_service_tbl`
--
ALTER TABLE `package_service_tbl`
  ADD KEY `pack_serv_package_id` (`pack_serv_package_id`,`pack_serv_serv_id`),
  ADD KEY `pack_serv_serv_id` (`pack_serv_serv_id`);

--
-- Indexes for table `package_tbl`
--
ALTER TABLE `package_tbl`
  ADD PRIMARY KEY (`pack_id`),
  ADD KEY `pack_price_id` (`pack_price_id`);

--
-- Indexes for table `patient_gender_tbl`
--
ALTER TABLE `patient_gender_tbl`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `patient_tbl`
--
ALTER TABLE `patient_tbl`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `patient_type_id` (`patient_type_id`,`patient_corp_id`),
  ADD KEY `patient_corp_id` (`patient_corp_id`),
  ADD KEY `patient_gender_id` (`patient_gender_id`);

--
-- Indexes for table `patient_type_tbl`
--
ALTER TABLE `patient_type_tbl`
  ADD PRIMARY KEY (`ptype_id`);

--
-- Indexes for table `rolefields_tbl`
--
ALTER TABLE `rolefields_tbl`
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `service_group_tbl`
--
ALTER TABLE `service_group_tbl`
  ADD PRIMARY KEY (`servgroup_id`);

--
-- Indexes for table `service_price_tbl`
--
ALTER TABLE `service_price_tbl`
  ADD PRIMARY KEY (`serv_price_id`);

--
-- Indexes for table `service_tbl`
--
ALTER TABLE `service_tbl`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `service_price_id` (`service_price_id`),
  ADD KEY `service_group_id` (`service_group_id`),
  ADD KEY `service_type_id` (`service_type_id`);

--
-- Indexes for table `service_type_tbl`
--
ALTER TABLE `service_type_tbl`
  ADD PRIMARY KEY (`service_type_id`),
  ADD KEY `service_type_group_id` (`service_type_group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companydetails_tbl`
--
ALTER TABLE `companydetails_tbl`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `corporate_accounts_tbl`
--
ALTER TABLE `corporate_accounts_tbl`
  MODIFY `corp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctor_rebate_tbl`
--
ALTER TABLE `doctor_rebate_tbl`
  MODIFY `rebate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_access_tbl`
--
ALTER TABLE `employee_access_tbl`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_role_tbl`
--
ALTER TABLE `employee_role_tbl`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `medtech_rank`
--
ALTER TABLE `medtech_rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `module_tbl`
--
ALTER TABLE `module_tbl`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `package_price_tbl`
--
ALTER TABLE `package_price_tbl`
  MODIFY `pack_price_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `package_tbl`
--
ALTER TABLE `package_tbl`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_tbl`
--
ALTER TABLE `patient_tbl`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_type_tbl`
--
ALTER TABLE `patient_type_tbl`
  MODIFY `ptype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `service_group_tbl`
--
ALTER TABLE `service_group_tbl`
  MODIFY `servgroup_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_price_tbl`
--
ALTER TABLE `service_price_tbl`
  MODIFY `serv_price_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_tbl`
--
ALTER TABLE `service_tbl`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_type_tbl`
--
ALTER TABLE `service_type_tbl`
  MODIFY `service_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `corporate_accounts_tbl`
--
ALTER TABLE `corporate_accounts_tbl`
  ADD CONSTRAINT `corporate_accounts_tbl_ibfk_1` FOREIGN KEY (`corp_pack_id`) REFERENCES `package_tbl` (`pack_id`);

--
-- Constraints for table `doctor_rebate_tbl`
--
ALTER TABLE `doctor_rebate_tbl`
  ADD CONSTRAINT `doctor_rebate_tbl_ibfk_1` FOREIGN KEY (`rebate_doctor_id`) REFERENCES `employee_tbl` (`emp_id`);

--
-- Constraints for table `employee_access_tbl`
--
ALTER TABLE `employee_access_tbl`
  ADD CONSTRAINT `employee_access_tbl_ibfk_2` FOREIGN KEY (`access_module_id`) REFERENCES `module_tbl` (`module_id`),
  ADD CONSTRAINT `employee_access_tbl_ibfk_3` FOREIGN KEY (`access_role_id`) REFERENCES `employee_role_tbl` (`role_id`);

--
-- Constraints for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD CONSTRAINT `employee_tbl_ibfk_1` FOREIGN KEY (`emp_medtech_rank_id`) REFERENCES `medtech_rank` (`rank_id`),
  ADD CONSTRAINT `employee_tbl_ibfk_2` FOREIGN KEY (`emp_type_id`) REFERENCES `employee_role_tbl` (`role_id`);

--
-- Constraints for table `package_service_tbl`
--
ALTER TABLE `package_service_tbl`
  ADD CONSTRAINT `package_service_tbl_ibfk_1` FOREIGN KEY (`pack_serv_package_id`) REFERENCES `package_tbl` (`pack_id`),
  ADD CONSTRAINT `package_service_tbl_ibfk_2` FOREIGN KEY (`pack_serv_serv_id`) REFERENCES `service_tbl` (`service_id`);

--
-- Constraints for table `patient_tbl`
--
ALTER TABLE `patient_tbl`
  ADD CONSTRAINT `patient_tbl_ibfk_1` FOREIGN KEY (`patient_corp_id`) REFERENCES `corporate_accounts_tbl` (`corp_id`),
  ADD CONSTRAINT `patient_tbl_ibfk_2` FOREIGN KEY (`patient_type_id`) REFERENCES `patient_type_tbl` (`ptype_id`),
  ADD CONSTRAINT `patient_tbl_ibfk_3` FOREIGN KEY (`patient_gender_id`) REFERENCES `patient_gender_tbl` (`gender_id`);

--
-- Constraints for table `rolefields_tbl`
--
ALTER TABLE `rolefields_tbl`
  ADD CONSTRAINT `rolefields_tbl_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `employee_role_tbl` (`role_id`);

--
-- Constraints for table `service_tbl`
--
ALTER TABLE `service_tbl`
  ADD CONSTRAINT `service_tbl_ibfk_1` FOREIGN KEY (`service_group_id`) REFERENCES `service_group_tbl` (`servgroup_id`),
  ADD CONSTRAINT `service_tbl_ibfk_2` FOREIGN KEY (`service_price_id`) REFERENCES `service_price_tbl` (`serv_price_id`),
  ADD CONSTRAINT `service_tbl_ibfk_3` FOREIGN KEY (`service_type_id`) REFERENCES `service_type_tbl` (`service_type_id`);

--
-- Constraints for table `service_type_tbl`
--
ALTER TABLE `service_type_tbl`
  ADD CONSTRAINT `service_type_tbl_ibfk_1` FOREIGN KEY (`service_type_group_id`) REFERENCES `service_group_tbl` (`servgroup_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
