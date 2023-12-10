-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 05:31 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auto_finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(2) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_address` varchar(255) NOT NULL,
  `business_contact` varchar(255) NOT NULL,
  `pincode` int(6) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `benif_name` varchar(255) DEFAULT NULL,
  `benif_acc` varchar(255) DEFAULT NULL,
  `benif_ifsc` varchar(255) DEFAULT NULL,
  `sign` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `m_id` varchar(255) NOT NULL,
  `m_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `business_name`, `business_address`, `business_contact`, `pincode`, `logo`, `benif_name`, `benif_acc`, `benif_ifsc`, `sign`, `branch`, `m_id`, `m_key`) VALUES
(1, 'admin', 'admin', 'Auto Financ', 'Abu highway, Palanpur                                    ', '9876543210', 385001, '1.png', 'bob', '55231000', 'ICIC0000257', '', 'ahmd', '1234', '5678');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(5) NOT NULL,
  `acc_no` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `loan_amount` int(5) NOT NULL,
  `loan_month` int(2) NOT NULL,
  `loan_rate` float(10,2) NOT NULL,
  `emi` float(10,2) NOT NULL,
  `emi_capital` float(10,2) NOT NULL,
  `emi_interest` float(10,2) NOT NULL,
  `file_charge` float(5,2) NOT NULL,
  `fine` int(5) DEFAULT NULL,
  `total_loan` float(10,2) NOT NULL,
  `loan_date` date NOT NULL,
  `first_emi_date` date NOT NULL,
  `vehicle_reg_no` varchar(255) NOT NULL,
  `chassis_no` varchar(255) NOT NULL,
  `engine_no` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `other` text DEFAULT NULL,
  `showroom` varchar(255) NOT NULL,
  `gtr_name` varchar(255) NOT NULL,
  `gtr_address` varchar(255) NOT NULL,
  `gtr_contact` varchar(10) NOT NULL,
  `gtr_document` varchar(255) NOT NULL,
  `loan_clear` enum('No','Yes') NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `wh_back` enum('No','Yes') NOT NULL,
  `birthday` date DEFAULT NULL,
  `pincode` int(6) NOT NULL,
  `vehicle_amount` int(10) NOT NULL,
  `downpayment` int(10) NOT NULL,
  `down_payment` enum('No','Yes') NOT NULL,
  `active` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `acc_no`, `name`, `address`, `mob_no`, `loan_amount`, `loan_month`, `loan_rate`, `emi`, `emi_capital`, `emi_interest`, `file_charge`, `fine`, `total_loan`, `loan_date`, `first_emi_date`, `vehicle_reg_no`, `chassis_no`, `engine_no`, `model`, `other`, `showroom`, `gtr_name`, `gtr_address`, `gtr_contact`, `gtr_document`, `loan_clear`, `city`, `district`, `wh_back`, `birthday`, `pincode`, `vehicle_amount`, `downpayment`, `down_payment`, `active`) VALUES
(1, 1, 'Dhruvesh Panchal', 'Bahadur Ganj, Tinbatt', '9909143247', 60000, 12, 6.00, 4000.00, 0.00, 0.00, 200.00, 500, 52000.00, '2022-02-14', '2022-02-17', 'GJ 08 AP', 'abc123', 'abc123', 'abc123', 'abc123', '2', 'bob', 'bob', '9876543210', 'sdnfsbsb', 'Yes', 'Palanpur', 'Banaskantha', 'Yes', '2000-04-24', 385001, 0, 0, 'Yes', ''),
(145, 2, 'Boby Panchal', 'Palanpur', '9978901992', 48200, 12, 10.00, 4418.33, 4016.00, 402.00, 200.00, 100, 53020.00, '2022-04-30', '2022-04-30', 'GJ 08 AP 442', '123', '123', '12', '123', '1', 'boby', 'palanpur', '9876543210', 'Resume_Dhruvesh.pdf', 'No', 'Palanpur', 'Banaskantha', 'No', '2000-04-24', 385001, 50000, 2000, 'No', 'Yes'),
(146, 3, 'Yagnesh ', 'Mehsana', '9876543112', 57100, 12, 10.00, 5234.17, 4758.00, 476.00, 100.00, 100, 62810.00, '2022-04-30', '2022-05-30', 'GJ 08 a 5226', 'abc', 'abc', 'abc', 'abc', '2', 'bob', 'abc', '9876543210', 'Resume_Dhruvesh.pdf', 'No', 'Palanpur', 'Banaskantha', 'No', '2000-02-12', 225212, 60000, 3000, 'No', 'Yes'),
(147, 4, 'Anuj', 'Pln', '9876543210', 69100, 12, 10.00, 6334.17, 5758.00, 576.00, 100.00, 100, 76010.00, '2022-04-30', '2022-05-30', 'GJ 01 AP 4442', 'abc', 'abc', 'abc', 'abc', '1', 'abc', 'abc', '9876543210', 'Resume_Dhruvesh.pdf', 'No', 'Palanpur', 'Banaskantha', 'No', '2000-12-09', 358412, 70000, 1000, 'No', 'Yes'),
(148, 5, 'Dhruvesh A. Panchal', 'Deesa highway, Palanpur', '9978901992', 60000, 12, 10.00, 5500.00, 5000.00, 500.00, 500.00, 100, 66000.00, '2022-03-20', '2022-04-20', 'GJ 08 AP 4420', 'abc123xy34', 'abc123xy34', 'Ather 450x', '2 wheeler', '1', 'Anuj', 'Mehsana', '9876543210', 'Hall Ticket.pdf', 'No', 'Palanpur', 'Banaskantha', 'No', '2000-04-24', 385001, 64500, 5000, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `cust_inst_record`
--

CREATE TABLE `cust_inst_record` (
  `id` int(5) NOT NULL,
  `acc_no` int(5) NOT NULL,
  `inst_no` int(2) NOT NULL,
  `inst_date` date NOT NULL,
  `inst_clear` enum('No','Yes') NOT NULL,
  `emi` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cust_inst_record`
--

INSERT INTO `cust_inst_record` (`id`, `acc_no`, `inst_no`, `inst_date`, `inst_clear`, `emi`) VALUES
(1, 2, 1, '2022-04-30', 'Yes', 4418.33),
(2, 2, 2, '2022-05-30', 'Yes', 4418.33),
(3, 2, 3, '2022-06-30', 'No', 4418.33),
(4, 2, 4, '2022-07-30', 'No', 4418.33),
(5, 2, 5, '2022-08-30', 'No', 4418.33),
(6, 2, 6, '2022-09-30', 'No', 4418.33),
(7, 2, 7, '2022-10-30', 'No', 4418.33),
(8, 2, 8, '2022-11-30', 'No', 4418.33),
(9, 2, 9, '2022-12-30', 'No', 4418.33),
(10, 2, 10, '2023-01-30', 'No', 4418.33),
(11, 2, 11, '2023-03-02', 'No', 4418.33),
(12, 2, 12, '2023-03-30', 'No', 4418.33),
(13, 3, 1, '2022-05-30', 'No', 5234.17),
(14, 3, 2, '2022-06-30', 'No', 5234.17),
(15, 3, 3, '2022-07-30', 'No', 5234.17),
(16, 3, 4, '2022-08-30', 'No', 5234.17),
(17, 3, 5, '2022-09-30', 'No', 5234.17),
(18, 3, 6, '2022-10-30', 'No', 5234.17),
(19, 3, 7, '2022-11-30', 'No', 5234.17),
(20, 3, 8, '2022-12-30', 'No', 5234.17),
(21, 3, 9, '2023-01-30', 'No', 5234.17),
(22, 3, 10, '2023-03-02', 'No', 5234.17),
(23, 3, 11, '2023-03-30', 'No', 5234.17),
(24, 3, 12, '2023-04-30', 'No', 5234.17),
(25, 4, 1, '2022-05-30', 'No', 6334.17),
(26, 4, 2, '2022-06-30', 'No', 6334.17),
(27, 4, 3, '2022-07-30', 'No', 6334.17),
(28, 4, 4, '2022-08-30', 'No', 6334.17),
(29, 4, 5, '2022-09-30', 'No', 6334.17),
(30, 4, 6, '2022-10-30', 'No', 6334.17),
(31, 4, 7, '2022-11-30', 'No', 6334.17),
(32, 4, 8, '2022-12-30', 'No', 6334.17),
(33, 4, 9, '2023-01-30', 'No', 6334.17),
(34, 4, 10, '2023-03-02', 'No', 6334.17),
(35, 4, 11, '2023-03-30', 'No', 6334.17),
(36, 4, 12, '2023-04-30', 'No', 6334.17),
(37, 5, 1, '2022-04-20', 'No', 5500.00),
(38, 5, 2, '2022-05-20', 'No', 5500.00),
(39, 5, 3, '2022-06-20', 'No', 5500.00),
(40, 5, 4, '2022-07-20', 'No', 5500.00),
(41, 5, 5, '2022-08-20', 'No', 5500.00),
(42, 5, 6, '2022-09-20', 'No', 5500.00),
(43, 5, 7, '2022-10-20', 'No', 5500.00),
(44, 5, 8, '2022-11-20', 'No', 5500.00),
(45, 5, 9, '2022-12-20', 'No', 5500.00),
(46, 5, 10, '2023-01-20', 'No', 5500.00),
(47, 5, 11, '2023-02-20', 'No', 5500.00),
(48, 5, 12, '2023-03-20', 'No', 5500.00);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `d_id` int(5) NOT NULL,
  `acc_no` int(5) NOT NULL,
  `doc_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`d_id`, `acc_no`, `doc_name`) VALUES
(1, 2, 'Resume_Dhruvesh.pdf'),
(2, 3, 'Resume_Dhruvesh.pdf'),
(3, 4, 'Resume_Dhruvesh.pdf'),
(4, 5, 'Hall Ticket.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `fine_payment`
--

CREATE TABLE `fine_payment` (
  `f_id` int(5) NOT NULL,
  `receipt` int(5) NOT NULL,
  `acc_no` int(5) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `type` enum('Cash','Cheque','Online') NOT NULL,
  `cheq_no` int(10) DEFAULT NULL,
  `cheq_date` date DEFAULT NULL,
  `fine_pay_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fine_payment`
--

INSERT INTO `fine_payment` (`f_id`, `receipt`, `acc_no`, `amount`, `type`, `cheq_no`, `cheq_date`, `fine_pay_date`) VALUES
(2, 0, 2, 100.00, 'Cash', 0, '0000-00-00', '2022-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `sr_no` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`sr_no`, `name`, `email`, `subject`, `comment`) VALUES
(1, 'boby', 'abc@gmail.com', 'asdsa', 'adasdsa'),
(2, 'Dhruv', 'ab@gmail.com', 'for', 'for');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(5) NOT NULL,
  `receipt_no` int(5) NOT NULL,
  `acc_no` int(5) NOT NULL,
  `inst_no` int(2) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `type` enum('Cash','Cheque','Online') NOT NULL,
  `cheque_no` int(10) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `emi_date` date NOT NULL,
  `pay_date` date NOT NULL,
  `fine` int(5) DEFAULT NULL,
  `inst_clear` enum('No','Yes') NOT NULL,
  `emi_capital` float(10,2) NOT NULL,
  `emi_interest` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`p_id`, `receipt_no`, `acc_no`, `inst_no`, `amount`, `type`, `cheque_no`, `cheque_date`, `emi_date`, `pay_date`, `fine`, `inst_clear`, `emi_capital`, `emi_interest`) VALUES
(1, 0, 2, 1, 4418.00, 'Cash', 0, '0000-00-00', '2022-04-30', '2022-05-02', 0, 'Yes', 4016.00, 402.00),
(9, 0, 2, 2, 4418.00, 'Cash', 0, '0000-00-00', '2022-05-30', '2022-05-05', 100, 'Yes', 4016.00, 402.00);

-- --------------------------------------------------------

--
-- Table structure for table `pre_sms`
--

CREATE TABLE `pre_sms` (
  `id` int(3) NOT NULL,
  `wel_sms` varchar(255) NOT NULL,
  `due_sms` varchar(255) NOT NULL,
  `reminder_sms` varchar(255) NOT NULL,
  `fine_sms` varchar(255) NOT NULL,
  `pay_sms` varchar(255) NOT NULL,
  `birth_sms` varchar(255) NOT NULL,
  `wel_sent` enum('No','Yes') NOT NULL,
  `due_sent` enum('No','Yes') NOT NULL,
  `reminder_sent` enum('No','Yes') NOT NULL,
  `fine_sent` enum('No','Yes') NOT NULL,
  `pay_sent` enum('No','Yes') NOT NULL,
  `birth_sent` enum('No','Yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pre_sms`
--

INSERT INTO `pre_sms` (`id`, `wel_sms`, `due_sms`, `reminder_sms`, `fine_sms`, `pay_sms`, `birth_sms`, `wel_sent`, `due_sent`, `reminder_sent`, `fine_sent`, `pay_sent`, `birth_sent`) VALUES
(1, 'Welcome To AUTO FINANCE [NAME] .Your Loan is approved, Account no is  ([FILE]) Loan amount ([AMT]),EMI Amount ([INST]).', 'Dear, [NAME] Account no ([FILE]),[DATE]  EMI ([AMT]) has been due. please pay as soon as. Thanks AUTO FINANCE', 'Reminder Dear, [NAME] Account No ([FILE]), on date [DATE] EMI Amount [AMT] is due. Thanks AUTO FINANCE', 'Dear Customer, [NAME] Fine Amount- [AMT] is received. Thanks AUTO  FINANCE', 'Dear, [NAME] Account No ([FILE]) EMI No- [INST] EMI Amount- [AMT] is received on  [DATE].Thanks Auto  FINANCE', 'Happy Birthday [name]. Many many returns of the day. May almighty bless you with long & healthy life.', 'Yes', 'No', 'No', 'Yes', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `showroom`
--

CREATE TABLE `showroom` (
  `sh_id` int(3) NOT NULL,
  `sh_name` varchar(255) NOT NULL,
  `sh_address` varchar(255) NOT NULL,
  `sh_city` varchar(255) NOT NULL,
  `sh_contact` varchar(255) NOT NULL,
  `sh_pincode` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showroom`
--

INSERT INTO `showroom` (`sh_id`, `sh_name`, `sh_address`, `sh_city`, `sh_contact`, `sh_pincode`) VALUES
(1, 'ather', '   Deesa highway   ', 'Mehsana', '9876543210', 384002),
(2, 'TVS motors', 'Deesa highway, Palanpur ', 'Mehsana', '9876543210', 3651002),
(3, 'Honda', 'Palanpur', 'Mehsana', '9876543210', 385001);

-- --------------------------------------------------------

--
-- Table structure for table `showroom_payment`
--

CREATE TABLE `showroom_payment` (
  `sh_payid` int(5) NOT NULL,
  `sh_id` int(3) NOT NULL,
  `acc_no` int(5) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `type` enum('cash','cheque','online') NOT NULL,
  `cheque_no` int(10) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `pay_date` date NOT NULL,
  `other` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showroom_payment`
--

INSERT INTO `showroom_payment` (`sh_payid`, `sh_id`, `acc_no`, `amount`, `type`, `cheque_no`, `cheque_date`, `pay_date`, `other`) VALUES
(2, 1, 2, 50000.00, 'cash', 0, '2022-05-20', '2022-05-20', '');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(5) NOT NULL,
  `sms` text NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `status` enum('N','Y') NOT NULL,
  `sent_time` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `sms`, `mob_no`, `status`, `sent_time`, `created`) VALUES
(1, 'Welcome To AUTO FINANCE Yagnesh .Your Loan is approved, Account no is  (8) Loan amount (5390.00),EMI Amount (449.17).', '9106466535', 'N', NULL, '2022-04-08 16:26:19'),
(2, 'Welcome To AUTO FINANCE Boby .Your Loan is approved, Account no is  (9) Loan amount (52910.00),EMI Amount (4409.17).', '98765', 'N', NULL, '2022-04-19 16:05:31'),
(4, 'Dear, Boby Account No (9) EMI No- 3 EMI Amount- 4409 is received on  19-04-22.Thanks Auto  FINANCE', '98765', 'N', NULL, '2022-04-19 16:44:34'),
(12, 'Dear, Darshan Panchal Account No (6) EMI No- 2 EMI Amount- 6893 is received on  20-04-22.Thanks Auto  FINANCE', '8866232023', 'N', NULL, '2022-04-20 17:19:11'),
(13, 'Welcome To AUTO FINANCE Boby Panchal .Your Loan is approved, Account no is  (2) Loan amount (53020.00),EMI Amount (4418.33).', '9876543210', 'N', NULL, '2022-04-30 16:38:32'),
(14, 'Welcome To AUTO FINANCE Yagnesh  .Your Loan is approved, Account no is  (3) Loan amount (62810.00),EMI Amount (5234.17).', '9876543112', 'N', NULL, '2022-04-30 16:48:29'),
(15, 'Welcome To AUTO FINANCE Anuj .Your Loan is approved, Account no is  (4) Loan amount (76010.00),EMI Amount (6334.17).', '9876543210', 'N', NULL, '2022-04-30 17:01:29'),
(16, 'Dear, Boby Panchal Account No (2) EMI No- 1 EMI Amount- 4418 is received on  02-05-22.Thanks Auto  FINANCE', '9876543210', 'N', NULL, '2022-05-02 18:24:26'),
(17, 'Dear Customer, Boby Panchal Fine Amount- 200 is received. Thanks AUTO  FINANCE', '9876543210', 'N', NULL, '2022-05-05 18:05:49'),
(18, 'Dear, Boby Panchal Account No (2) EMI No- 2 EMI Amount- 4418 is received on  05-05-22.Thanks Auto  FINANCE', '9876543210', 'N', NULL, '2022-05-05 18:15:12'),
(19, 'Dear, Boby Panchal Account No (2) EMI No- 2 EMI Amount- 4418 is received on  05-05-22.Thanks Auto  FINANCE', '9876543210', 'N', NULL, '2022-05-05 18:17:40'),
(20, 'Dear Customer, Boby Panchal Fine Amount- 100 is received. Thanks AUTO  FINANCE', '9876543210', 'N', NULL, '2022-05-05 18:17:40'),
(21, 'Dear, Boby Panchal Account No (2) EMI No- 2 EMI Amount- 4418 is received on  05-05-22.Thanks Auto  FINANCE', '9876543210', 'N', NULL, '2022-05-05 18:19:57'),
(22, 'Dear, Boby Panchal Account No (2) EMI No- 2 EMI Amount- 4418 is received on  05-05-22.Thanks Auto  FINANCE', '9876543210', 'N', NULL, '2022-05-05 18:20:17'),
(23, 'Dear Customer, Boby Panchal Fine Amount- 100 is received. Thanks AUTO  FINANCE', '9876543210', 'N', NULL, '2022-05-05 18:20:17'),
(24, 'Dear, Boby Panchal Account No (2) EMI No- 2 EMI Amount- 4418 is received on  05-05-22.Thanks Auto  FINANCE', '9876543210', 'N', NULL, '2022-05-05 19:26:05'),
(25, 'Dear Customer, Boby Panchal Fine Amount- 100 is received. Thanks AUTO  FINANCE', '9876543210', 'N', NULL, '2022-05-05 19:26:05'),
(26, 'Dear, Boby Panchal Account No (2) EMI No- 2 EMI Amount- 4418 is received on  05-05-22.Thanks Auto  FINANCE', '9876543210', 'N', NULL, '2022-05-05 19:28:25'),
(27, 'Dear Customer, Boby Panchal Fine Amount- 100 is received. Thanks AUTO  FINANCE', '9876543210', 'N', NULL, '2022-05-05 19:28:25'),
(28, 'Welcome To AUTO FINANCE Dhruvesh A. Panchal .Your Loan is approved, Account no is  (5) Loan amount (66000.00),EMI Amount (5500).', '9978901992', 'N', NULL, '2022-05-20 20:06:48'),
(29, 'Dear Customer, Boby Panchal Fine Amount- 100 is received. Thanks AUTO  FINANCE', '9978901992', 'N', NULL, '2022-05-20 20:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `acc_no` int(11) NOT NULL,
  `inst_no` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `status` enum('Pending','Success') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`acc_no`, `inst_no`, `orderid`, `status`) VALUES
(2, 2, 1651572108, 'Success'),
(2, 3, 1651897972, 'Pending'),
(2, 3, 1652004325, 'Pending'),
(2, 3, 1652538692, 'Pending'),
(2, 3, 1652538740, 'Pending'),
(2, 3, 1652538869, 'Pending'),
(2, 3, 1652942214, 'Pending'),
(2, 3, 1653043544, 'Pending'),
(2, 3, 1653044632, 'Pending'),
(2, 3, 1653044827, 'Pending'),
(2, 3, 1653044827, 'Pending'),
(2, 3, 1653044827, 'Pending'),
(2, 3, 1653046725, 'Pending'),
(2, 3, 1653046738, 'Pending'),
(2, 3, 1653046908, 'Pending'),
(2, 3, 1653049848, 'Pending'),
(2, 3, 1653049877, 'Pending'),
(2, 3, 1653050386, 'Success'),
(2, 4, 1653050706, 'Success');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `cust_inst_record`
--
ALTER TABLE `cust_inst_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `c_id` (`acc_no`);

--
-- Indexes for table `fine_payment`
--
ALTER TABLE `fine_payment`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `receipt_no` (`receipt_no`);

--
-- Indexes for table `pre_sms`
--
ALTER TABLE `pre_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showroom`
--
ALTER TABLE `showroom`
  ADD PRIMARY KEY (`sh_id`);

--
-- Indexes for table `showroom_payment`
--
ALTER TABLE `showroom_payment`
  ADD PRIMARY KEY (`sh_payid`),
  ADD UNIQUE KEY `acc_no` (`acc_no`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `cust_inst_record`
--
ALTER TABLE `cust_inst_record`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `d_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fine_payment`
--
ALTER TABLE `fine_payment`
  MODIFY `f_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `sr_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pre_sms`
--
ALTER TABLE `pre_sms`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `showroom`
--
ALTER TABLE `showroom`
  MODIFY `sh_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `showroom_payment`
--
ALTER TABLE `showroom_payment`
  MODIFY `sh_payid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
