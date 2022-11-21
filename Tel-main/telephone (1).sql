-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2022 at 10:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telephone`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` char(4) NOT NULL,
  `branch_address` varchar(100) DEFAULT NULL,
  `branch_tel` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_address`, `branch_tel`) VALUES
('b001', '21-29 ถ.นาคราช แขวงคลองมหานาคเขตป้อมปราบ จ.กรุงเทพฯ 10100', '0212334567'),
('b002', '1573-5 ถ.สุขุมวิท ซ.สาลีนิมิต เขตวัฒนา จ.กรุงเทพฯ 10110', '0212334567'),
('b003', '1379 ถ.จันทน์แขวงทุ่งวัดดอน เขตสาธร จ.กรุงเทพฯ 10120', '0271867920'),
('b004', '339 หมู่18 ถ.สุขสวัสดิ์ ต.บางพึ่ง อ.พระประแดง จ.สมทุรปราการ 10130', '0254800749'),
('b005', '316/9 ม.8 ถ.ประชาอุทิศราษฎร์บูรณะเขตราษฎร์บูรณะ จ.กรุงเทพฯ 10140', '0271867920'),
('b006', '123/165 ม.3 ถ.เอกชัย บางขุนเทียน เขตจอมทอง จ.กรุงเทพฯ 10150', '0270974178'),
('b007', '179/2 ม.1 ถ.เพชรเกษม แขวงบางแคเหนือ เขตบางแค จ.กรุงเทพฯ 10160', '0281274323'),
('b008', '49/2 หมู่4 ถ.ปิ่นเกล้า-นครชัยศรีเขตตลิ่งชัน จ.กรุงเทพฯ 10170', '0285034774'),
('b009', '81 ซ.ดำเนินกลางเหนือราชดำเนินกลาง เขตพระนคร จ.กรุงเทพฯ 10200', '0233268532'),
('b010', '88 หมู่3 ถ.แจ้งวัฒนะทุ่งสองห้อง เขตหลักสี่ จ.กรุงเทพฯ 10210', '0224000675');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_name` varchar(100) NOT NULL,
  `cus_prefix` varchar(50) DEFAULT NULL,
  `cus_tel` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_name`, `cus_prefix`, `cus_tel`) VALUES
('กุลนันท์ รัตนาอรุณ', 'นาง', '0919650708'),
('ขวัญทิพย์ แสนวงศ์', 'นาง', '0919023553'),
('ฐาปนัท สุวรรณศิริ', 'นาย', '0811547839'),
('ณัฐวุฒิ จรัสวงศ์', 'นาย', '0911223013'),
('ธนาธร อรุณฉาย', 'นาย', '0917964073'),
('ธัชพล ธนเกียรติโกศล', 'นาย', '0631331930'),
('บวรนันท์ เกียรติสกุล', 'นางสาว', '0863457047'),
('ปาณิตา ห้าวหาญ', 'นาง', '0916419102'),
('ปิยะดา ชัยเจริญ', 'นางสาว', '0866041710'),
('ภาดา รุ่งฤดี', 'นาง', '0861081860');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` char(4) NOT NULL,
  `branch_id` char(4) NOT NULL,
  `emp_prefix` varchar(50) DEFAULT NULL,
  `emp_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `emp_tel` char(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `branch_id`, `emp_prefix`, `emp_name`, `dob`, `emp_tel`, `start_date`) VALUES
('e001', 'b001', 'นาย', 'จิรายุ โอภาสพัฒน์', '1995-07-21', '0917765066', '2010-06-08'),
('e002', 'b001', 'นาง', 'นิรณา ทรัพย์ศิลา', '1994-09-12', '0817364958', '2010-05-05'),
('e003', 'b004', 'นางสาว', 'กมลฉันท์ จันทรทรัพย์', '1993-10-23', '0865317789', '2011-08-04'),
('e004', 'b003', 'นาง', 'พรทิพา พงศ์ไพศาล', '1997-02-16', '0916875518', '2012-10-10'),
('e005', 'b005', 'นางสาว', 'กิตติพร อุดมวิทยา', '1986-09-22', '0910010545', '2020-02-09'),
('e006', 'b006', 'นาย', 'ปิติพงศ์ ประสานวงศ์', '1988-02-10', '0632199884', '2011-05-21'),
('e007', 'b009', 'นาย', 'นิมมาน ธรรมภักดิ์', '1985-04-08', '0818919260', '2014-09-06'),
('e008', 'b010', 'นาย', 'พัฒนเดช ชัยชนา', '1985-01-08', '0814842524', '2011-11-29'),
('e009', 'b007', 'นาง', 'พัชญ์ธนัน คุ้มวงศ์', '1988-02-10', '0911228239', '2016-10-03'),
('e010', 'b002', 'นาง', 'ศศิพร วีรภัทรเมธี', '1996-08-09', '0911743578', '2011-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` char(6) NOT NULL,
  `repair_id` char(5) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT 'awaiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `repair_id`, `cost`, `pay_date`, `payment_status`) VALUES
('inv001', 'rp001', 450, '2020-07-20', 'completed'),
('inv002', 'rp002', 100, '2020-10-28', 'completed'),
('inv003', 'rp003', 250, '2020-10-28', 'completed'),
('inv004', 'rp004', 100, '2021-04-11', 'completed'),
('inv005', 'rp005', 100, NULL, 'pending'),
('inv006', 'rp006', 250, '2021-05-06', 'completed'),
('inv007', 'rp007', 450, '2021-06-17', 'completed'),
('inv008', 'rp008', NULL, NULL, 'awaiting'),
('inv009', 'rp009', NULL, NULL, 'awaiting'),
('inv010', 'rp010', NULL, NULL, 'awaiting');

-- --------------------------------------------------------

--
-- Table structure for table `repairman`
--

CREATE TABLE `repairman` (
  `repairman_id` char(4) NOT NULL,
  `employee_id` char(4) NOT NULL,
  `repair_count` int(11) NOT NULL DEFAULT 0,
  `is_avalible` tinyint(1) DEFAULT NULL,
  `repairing` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repairman`
--

INSERT INTO `repairman` (`repairman_id`, `employee_id`, `repair_count`, `is_avalible`, `repairing`) VALUES
('r001', 'e001', 4, 0, 'rp009'),
('r002', 'e006', 2, 0, 'rp010'),
('r003', 'e007', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repair_detail`
--

CREATE TABLE `repair_detail` (
  `repair_id` char(5) NOT NULL,
  `request_id` char(5) NOT NULL,
  `repairman_id` char(4) NOT NULL,
  `start_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `repair_status` varchar(20) DEFAULT 'in progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_detail`
--

INSERT INTO `repair_detail` (`repair_id`, `request_id`, `repairman_id`, `start_date`, `finish_date`, `repair_status`) VALUES
('rp001', 'rq001', 'r001', '2020-07-09', '2022-07-16', 'repaired'),
('rp002', 'rq002', 'r001', '2020-10-17', '2020-10-24', 'repaired'),
('rp003', 'rq003', 'r002', '2020-10-17', '2020-10-24', 'repaired'),
('rp004', 'rq004', 'r001', '2021-03-31', '2021-04-07', 'repaired'),
('rp005', 'rq006', 'r001', '2021-04-08', '2021-04-15', 'repaired'),
('rp006', 'rq007', 'r002', '2021-04-25', '2021-05-02', 'repaired'),
('rp007', 'rq008', 'r002', '2021-06-06', '2021-06-13', 'repaired'),
('rp008', 'rq009', 'r001', '2021-07-16', '2021-07-23', 'require spare part'),
('rp009', 'rq010', 'r002', '2021-08-26', '2021-09-02', 'in progress'),
('rp010', 'rq011', 'r001', '2022-09-03', '2022-09-10', 'in progress');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` char(5) NOT NULL,
  `tel_id` char(6) NOT NULL,
  `request_caretaker` char(4) NOT NULL,
  `request_date` date NOT NULL,
  `abnormality` varchar(200) DEFAULT NULL,
  `request_status` varchar(20) NOT NULL DEFAULT 'awaiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `tel_id`, `request_caretaker`, `request_date`, `abnormality`, `request_status`) VALUES
('rq001', 'tel001', 'e001', '2020-07-06', 'จอไม่แสดง', 'fulfill'),
('rq002', 'tel003', 'e004', '2020-10-14', 'เสียงซ่า', 'fulfill'),
('rq003', 'tel003', 'e003', '2020-10-14', 'กระดิ่งไม่ดัง', 'fulfill'),
('rq004', 'tel004', 'e004', '2021-03-28', 'โทรไม่ได้', 'fulfill'),
('rq005', 'tel004', 'e005', '2021-04-03', 'เสียงเบา', 'cancelled'),
('rq006', 'tel006', 'e006', '2021-04-05', 'จอไม่แสดง', 'fulfill'),
('rq007', 'tel007', 'e005', '2021-04-22', 'กระดิ่งไม่ดัง', 'fulfill'),
('rq008', 'tel008', 'e008', '2021-06-03', 'เสียงซ่า', 'fulfill'),
('rq009', 'tel005', 'e009', '2021-07-13', 'จอไม่แสดง', 'awaiting'),
('rq010', 'tel001', 'e003', '2022-08-31', 'กระดิ่งไม่ดัง', 'awaiting'),
('rq011', 'tel001', 'e003', '2022-08-31', 'เสียงเบา', 'awaiting');

-- --------------------------------------------------------

--
-- Table structure for table `telephone`
--

CREATE TABLE `telephone` (
  `tel_id` char(6) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `tel_model` varchar(100) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `telephone`
--

INSERT INTO `telephone` (`tel_id`, `cus_name`, `tel_model`, `color`) VALUES
('tel001', 'ขวัญทิพย์ แสนวงศ์', 'Panasonic KX-TG3411BX', 'ดำ'),
('tel002', 'ขวัญทิพย์ แสนวงศ์', 'Panasonic KX-TG3411BX', 'ดำ'),
('tel003', 'ปิยะดา ชัยเจริญ', 'Reach CP-B036', 'ขาว'),
('tel004', 'ภาดา รุ่งฤดี', 'Panasonic KX-TG3711B', 'เงิน'),
('tel005', 'ณัฐวุฒิ จรัสวงศ์', 'Yealink T30', 'น้ำตาล'),
('tel006', 'ฐาปนัท สุวรรณศิริ', 'Panasonic KX-TG3711B', 'แดง'),
('tel007', 'บวรนันท์ เกียรติสกุล', 'Reach DT2000', 'ชมพู'),
('tel008', 'กุลนันท์ รัตนาอรุณ', 'Yealink T19e2', 'ดำ'),
('tel009', 'ธนาธร อรุณฉาย', 'Panasonic KX-TG3411BX', 'ขาว'),
('tel010', 'ธัชพล ธนเกียรติโกศล', 'Reach CP-B036', 'แดง');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`),
  ADD UNIQUE KEY `branch_id` (`branch_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_name`),
  ADD UNIQUE KEY `cus_name` (`cus_name`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`),
  ADD KEY `repair_id` (`repair_id`);

--
-- Indexes for table `repairman`
--
ALTER TABLE `repairman`
  ADD PRIMARY KEY (`repairman_id`),
  ADD UNIQUE KEY `repairman_id` (`repairman_id`),
  ADD KEY `fk_employee_id` (`employee_id`),
  ADD KEY `fk_repairing` (`repairing`);

--
-- Indexes for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD PRIMARY KEY (`repair_id`),
  ADD UNIQUE KEY `repair_id` (`repair_id`),
  ADD KEY `fk_request_id` (`request_id`),
  ADD KEY `fk_repairman_id` (`repairman_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD UNIQUE KEY `request_id` (`request_id`),
  ADD KEY `fk_tel_id` (`tel_id`),
  ADD KEY `fk_request_caretaker` (`request_caretaker`);

--
-- Indexes for table `telephone`
--
ALTER TABLE `telephone`
  ADD PRIMARY KEY (`tel_id`),
  ADD UNIQUE KEY `tel_id` (`tel_id`),
  ADD KEY `cus_name` (`cus_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`repair_id`) REFERENCES `repair_detail` (`repair_id`);

--
-- Constraints for table `repairman`
--
ALTER TABLE `repairman`
  ADD CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `fk_repairing` FOREIGN KEY (`repairing`) REFERENCES `repair_detail` (`repair_id`);

--
-- Constraints for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD CONSTRAINT `fk_repairman_id` FOREIGN KEY (`repairman_id`) REFERENCES `repairman` (`repairman_id`),
  ADD CONSTRAINT `fk_request_id` FOREIGN KEY (`request_id`) REFERENCES `request` (`request_id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_request_caretaker` FOREIGN KEY (`request_caretaker`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `fk_tel_id` FOREIGN KEY (`tel_id`) REFERENCES `telephone` (`tel_id`);

--
-- Constraints for table `telephone`
--
ALTER TABLE `telephone`
  ADD CONSTRAINT `telephone_ibfk_1` FOREIGN KEY (`cus_name`) REFERENCES `customer` (`cus_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
