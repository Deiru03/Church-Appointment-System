-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 08:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chruch-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `title_name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `announce_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alert_name` enum('primary','info','danger','warning') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'primary',
  `author_name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `copyright_name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `website` text NOT NULL,
  `theme` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `theme_text` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_name` text NOT NULL,
  `maintenance` int(10) NOT NULL,
  `ads_id` text NOT NULL,
  `ads_body` text NOT NULL,
  `ads_amp` text NOT NULL,
  `ads_1` text NOT NULL,
  `ads_2` text NOT NULL,
  `ads_3` text NOT NULL,
  `ads_4` text NOT NULL,
  `ads_5` text NOT NULL,
  `ads_6` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `title_name`, `announce_name`, `alert_name`, `author_name`, `copyright_name`, `website`, `theme`, `theme_text`, `menu_name`, `maintenance`, `ads_id`, `ads_body`, `ads_amp`, `ads_1`, `ads_2`, `ads_3`, `ads_4`, `ads_5`, `ads_6`) VALUES
(1, 'ST.JOSEPH CATHEDRAL PARISH', 'David Espinosa', 'info', 'Sikatpinoy Admin', 'Sikatpinoy DEV', 'TB - CARE', '#59c5b8', '#042b97', 'Sikatpinoy', 0, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `adminmass`
--

CREATE TABLE `adminmass` (
  `log_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `hours` datetime DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminmass`
--

INSERT INTO `adminmass` (`log_id`, `date`, `hours`, `day`) VALUES
(7, NULL, '2024-08-22 18:24:00', 'Saturday'),
(8, NULL, '2024-09-06 18:27:00', 'Wednesday'),
(9, NULL, '2024-08-22 10:38:00', 'Thursday'),
(10, NULL, '2024-08-22 10:38:00', 'Thursday'),
(11, NULL, '2024-08-16 22:40:00', 'Saturday'),
(12, NULL, '2024-08-14 12:42:00', 'Friday'),
(13, NULL, '2024-08-16 10:45:00', 'Thursday'),
(14, NULL, '2024-08-16 10:45:00', 'Thursday'),
(16, NULL, '2024-08-14 05:19:00', 'Thursday');

-- --------------------------------------------------------

--
-- Table structure for table `baptismal`
--

CREATE TABLE `baptismal` (
  `log_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `sched` datetime DEFAULT NULL,
  `dateofbirth` datetime DEFAULT NULL,
  `phone` varchar(1000) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `fathersname` varchar(255) DEFAULT NULL,
  `father_occupation` varchar(255) DEFAULT NULL,
  `mothersname` varchar(255) DEFAULT NULL,
  `mother_occupation` varchar(255) DEFAULT NULL,
  `godparents_1` varchar(1000) DEFAULT NULL,
  `godparents_2` varchar(1000) DEFAULT NULL,
  `godparents_3` varchar(1000) DEFAULT NULL,
  `godparents_4` varchar(1000) DEFAULT NULL,
  `godparents_5` varchar(1000) DEFAULT NULL,
  `godparents_6` varchar(1000) DEFAULT NULL,
  `godparents_7` varchar(1000) DEFAULT NULL,
  `godparents_8` varchar(1000) DEFAULT NULL,
  `picture` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `proofpayment` varchar(500) NOT NULL,
  `statuspayment` varchar(100) NOT NULL DEFAULT '0',
  `bapstatus` varchar(200) NOT NULL DEFAULT '0',
  `uname` varchar(100) NOT NULL,
  `mcirth` varchar(100) NOT NULL,
  `bcirth` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baptismal`
--

INSERT INTO `baptismal` (`log_id`, `date`, `sched`, `dateofbirth`, `phone`, `fullname`, `fathersname`, `father_occupation`, `mothersname`, `mother_occupation`, `godparents_1`, `godparents_2`, `godparents_3`, `godparents_4`, `godparents_5`, `godparents_6`, `godparents_7`, `godparents_8`, `picture`, `gender`, `address`, `proofpayment`, `statuspayment`, `bapstatus`, `uname`, `mcirth`, `bcirth`) VALUES
(67, '2024-12-05 19:17:46', '2025-01-03 23:17:00', '0000-00-00 00:00:00', '09174549259', 'David Espinosa', 'asdasd', 'asdasdasd', 'asdaasd', 'asda', 'dasd', 'adasda', 'asdasd', 'asd', 'asdasda', NULL, NULL, NULL, 'img/picture/20241205191746_536426.png', 'male', 'asdasda', 'img/picture/20241205191746.png', '0', '1', 'sikatpinoy6@gmail.com', 'img/certificates/20241205191746_colors.png', 'img/certificates/20241205191746_536426.png'),
(68, '2024-12-05 19:26:58', '2024-12-16 19:26:00', '0000-00-00 00:00:00', '09174549259', 'Dane Espinosa', 'asdasdasda', 'asdasda', 'sdasd', 'asdasd', 'asdas', 'dasdas', 'dadsdasd', 'asdasd', 'asdasd', NULL, NULL, NULL, 'img/picture/20241205192658_536426.png', 'male', 'asdasd', 'img/picture/20241205192658.png', '0', '1', 'sikatpinoy6@gmail.com', 'img/certificates/20241205192658_536426.png', 'img/certificates/20241205192658_colors.png'),
(69, '2024-12-17 18:34:16', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241217183416_colors.png', 'male', 'manila', 'img/picture/20241217183416.png', '0', '2', 'sikatpinoy6@gmail.com', 'img/certificates/20241217183416_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241217183416_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(70, '2024-12-17 18:35:36', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241217183536_colors.png', 'male', 'manila', 'img/picture/20241217183536.png', '0', '1', 'sikatpinoy6@gmail.com', 'img/certificates/20241217183536_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241217183536_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(71, '2024-12-18 00:57:21', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005721_colors.png', 'male', 'manila', 'img/picture/20241218005721.png', '0', '1', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005721_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005721_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(72, '2024-12-18 00:58:05', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005805_colors.png', 'male', 'manila', 'img/picture/20241218005805.png', '0', '1', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005805_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005805_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(73, '2024-12-18 00:58:43', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005843_colors.png', 'male', 'manila', 'img/picture/20241218005843.png', '0', '2', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005843_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005843_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(74, '2024-12-18 00:59:05', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005905_colors.png', 'male', 'manila', 'img/picture/20241218005905.png', '0', '0', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005905_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005905_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(75, '2024-12-18 00:59:12', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005912_colors.png', 'male', 'manila', 'img/picture/20241218005912.png', '0', '0', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005912_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005912_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(76, '2024-12-18 00:59:18', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005918_colors.png', 'male', 'manila', 'img/picture/20241218005918.png', '0', '0', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005918_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005918_stock-vector-flower-reproduction-vector-illustration-labeled-process');

-- --------------------------------------------------------

--
-- Table structure for table `coh`
--

CREATE TABLE `coh` (
  `log_id` varchar(255) NOT NULL,
  `petsa_ng_pagbabasbas` date NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `ipapabasbas` varchar(255) NOT NULL,
  `may_ari` varchar(255) NOT NULL,
  `contact_number_owner` varchar(15) NOT NULL,
  `nagpalista` varchar(255) NOT NULL,
  `contact_number_registrant` varchar(15) NOT NULL,
  `proofpayment` varchar(255) DEFAULT NULL,
  `statuspayment` tinyint(1) DEFAULT 0,
  `bapstatus` tinyint(1) DEFAULT 0,
  `uname` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `cob` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coh`
--

INSERT INTO `coh` (`log_id`, `petsa_ng_pagbabasbas`, `lugar`, `ipapabasbas`, `may_ari`, `contact_number_owner`, `nagpalista`, `contact_number_registrant`, `proofpayment`, `statuspayment`, `bapstatus`, `uname`, `picture`, `cob`, `date`) VALUES
('log_674eb0d30e72f7.69225513', '2025-01-10', 'logggggggg', 'asdrasdada', 'berting labra', '09076011089', 'asdasdada', '09076011089', 'img/proof_payment/20241203151843_proofpayment.png', 0, 1, 'sikatpinoy6@gmail.com', '', '', '2024-12-03 15:18:43'),
('log_674eb11920b856.53159069', '2025-01-03', 'berting lobro', 'adasda', 'logggggggggg', '09076011089', 'asdasadsasd', '09076011089', 'img/proof_payment/20241203151953_proofpayment.png', 0, 1, 'sikatpinoy6@gmail.com', '', '', '2024-12-03 15:19:53'),
('log_674eb81379e937.01303327', '2024-01-04', 'rturtyut', 'utyutyu', 'barting pawosd', '09760795981', 'ertertetrert', '09760795981', 'img/proof_payment/20241203154939_proofpayment.png', 0, 1, 'sikatpinoy6@gmail.com', '', '', '2024-12-03 15:49:39'),
('log_674eb8140f2b93.71687343', '2024-12-20', 'rturtyut', 'utyutyu', 'katkat dog', '0960795981', 'ertertetrert', '0960795981', 'img/proof_payment/20241203154940_proofpayment.png', 0, 1, 'sikatpinoy6@gmail.com', '', '', '2024-12-03 15:49:40'),
('log_675abcda1eb248.06137392', '2024-12-21', 'asdasd', 'asdasd', 'gogle favedd', '09076011089', 'asdasdasda', 'sd', 'img/proof_payment/20241212183714_proofpayment.png', 0, 0, 'sikatpinoy6@gmail.com', '', '', '2024-12-12 18:37:14'),
('log_6761c6b8712153.31749899', '2024-12-05', 'adaada', 'dasda', 'adsasd', '09076011089', 'asdaasdasda', '09174549259', 'img/proof_payment/20241218024512_proofpayment.png', 0, 1, 'sikatpinoy6@gmail.com', '', '', '2024-12-18 02:45:12'),
('log_6761c70a61f183.01928430', '2024-12-05', 'adaada', 'dasda', 'adsasd', '09076011089', 'asdaasdasda', '09174549259', 'img/proof_payment/20241218024634_proofpayment.png', 0, 0, 'sikatpinoy6@gmail.com', '', '', '2024-12-18 02:46:34'),
('log_6776901dc398f3.72964554', '2025-01-16', 'manila', 'aaaaa', 'aaaa', '09076011089', 'adaaaaa', '09076011089', 'img/proof_payment/20250102210949_proofpayment.png', 0, 0, 'fakeg@mail.com', '', '', '2025-01-02 21:09:49'),
('log_677790cec02fa4.03206307', '2025-01-03', 'sdfdsf', 'adadasda', 'asdada', '09076011089', 'dadad', '09076011089', 'img/proof_payment/20250103152502_proofpayment.png', 0, 0, 'sikatpinoy6@gmail.com', '', '', '2025-01-03 15:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `confirmation`
--

CREATE TABLE `confirmation` (
  `log_id` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fathersname` varchar(255) DEFAULT NULL,
  `mothersname` varchar(255) DEFAULT NULL,
  `parentresidence` varchar(255) DEFAULT NULL,
  `raop` varchar(255) DEFAULT NULL,
  `sched` datetime DEFAULT NULL,
  `dateofconfirmation` datetime DEFAULT NULL,
  `statuspayment` tinyint(1) DEFAULT NULL,
  `bapstatus` tinyint(1) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `cob` varchar(255) DEFAULT NULL,
  `proofpayment` varchar(255) DEFAULT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmation`
--

INSERT INTO `confirmation` (`log_id`, `fullname`, `gender`, `dateofbirth`, `address`, `phone`, `fathersname`, `mothersname`, `parentresidence`, `raop`, `sched`, `dateofconfirmation`, `statuspayment`, `bapstatus`, `picture`, `cob`, `proofpayment`, `uname`, `date`) VALUES
('log_674f94482b44a42', 'coco martin', 'male', '2024-12-29', 'manila', '09076011089', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-03 07:28:00', '2024-12-17 10:28:00', 0, 1, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_674f94482ba42', 'coco martin', 'male', '2024-12-29', 'manila', '09076011089', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-03 07:28:00', '2024-12-17 10:28:00', 0, 1, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_674f94482ba422234', 'coco martin', 'male', '2024-12-29', 'manila', '09076011089', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-13 07:28:00', '2024-12-17 10:28:00', 0, 1, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_674f94482ba422342', 'coco martin', 'male', '2024-12-29', 'manila', '09076011089', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-03 07:28:00', '2024-12-17 10:28:00', 0, 1, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_674f94482ba42ss', 'coco martin', 'male', '2024-12-29', 'manila', '09076011089', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-11 07:28:00', '2024-12-17 10:28:00', 0, 1, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_674f94482ba44', 'coco martin', 'male', '2024-12-29', 'manila', '09076011089', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-03 07:28:00', '2024-12-17 10:28:00', 0, 1, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_674f94485453', 'John Rey', 'male', '2024-12-29', 'manila', '09971663588', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-03 07:28:00', '2024-12-17 10:28:00', 0, 0, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_674f9448545334223', 'John Rey', 'male', '2024-12-29', 'manila', '09971663588', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-03 07:28:00', '2024-12-17 10:28:00', 0, 0, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_6761b558c38d1', 'coco martin', 'male', '2024-12-17', 'manila', '09076011089', 'asdadsdas', 'dasdas', 'adsasdasda', 'asdasdasda', '2024-12-25 01:30:00', '2024-12-27 01:34:00', 0, 1, 'img/picture/20241218013104_picture.jpg', 'img/cob/20241218013104_cob.png', 'img/proofpayment/20241218013104_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-18 01:31:04'),
('log_6761b6ade55c6', 'putik na linta', 'male', '2024-12-26', 'manila', '09076011089', 'asdasda', 'dasdasda', 'asdasd', 'asdas', '2024-12-18 05:36:00', '2025-01-02 01:40:00', 0, 0, 'img/picture/20241218013645_picture.jpg', 'img/cob/20241218013645_cob.png', 'img/proofpayment/20241218013645_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-18 01:36:45'),
('log_6761b70fd1316', 'coco martin', 'male', '2025-01-01', 'sdfsdfsdf', '09076011089', 'asASAsda', 'dasd', 'asdadsd', 'asdsadaasda', '2025-01-02 03:38:00', '2025-01-08 05:38:00', 0, 0, 'img/picture/20241218013823_picture.png', 'img/cob/20241218013823_cob.png', 'img/proofpayment/20241218013823_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-18 01:38:23'),
('log_6761b7bcd03a2', 'coco martin', 'male', '2024-12-31', 'affsdfr', '09174549259', 'sfdsdfs', 'dfsdf', 'sdfsdfs', 'dffsdfsfs', '2024-12-28 04:40:00', '2025-01-02 06:40:00', 0, 0, 'img/picture/20241218014116_picture.png', 'img/cob/20241218014116_cob.jpg', 'img/proofpayment/20241218014116_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-18 01:41:16'),
('log_6777536362a43', 'coco martinsdfsdfss', 'male', '2025-01-03', 'asdasdadasd', '09076011089', 'coco marton', 'cocomartan', 'sdfdsfsd', 'dfsdfsdfs', '2025-01-03 01:02:00', '2025-01-17 11:02:00', 0, 0, 'img/picture/20250103110259_picture.png', 'img/cob/20250103110259_cob.png', 'img/proofpayment/20250103110259_proofpayment.png', 'fakeg@mail.com', '2025-01-03 11:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(64) NOT NULL,
  `contact` varchar(64) NOT NULL,
  `user_pass` varchar(64) NOT NULL,
  `form` varchar(1000) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `user_encryptedPass` varchar(64) NOT NULL,
  `user_rank` enum('superadmin','administrator','researcher','normal','export') NOT NULL DEFAULT 'normal',
  `user_status` enum('submitted','notsubmitted') NOT NULL DEFAULT 'notsubmitted',
  `user_upline` int(10) NOT NULL DEFAULT 1,
  `user_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` varchar(1) NOT NULL DEFAULT '0',
  `is_submit` enum('1','0') NOT NULL DEFAULT '0',
  `status` enum('1','0','2') NOT NULL DEFAULT '0',
  `comment` mediumtext NOT NULL,
  `comment_count` mediumtext NOT NULL,
  `bray` varchar(200) NOT NULL,
  `files` varchar(500) NOT NULL,
  `otpstatus` int(2) NOT NULL DEFAULT 0,
  `otp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `user_name`, `email`, `address`, `contact`, `user_pass`, `form`, `picture`, `user_encryptedPass`, `user_rank`, `user_status`, `user_upline`, `user_created`, `is_active`, `is_submit`, `status`, `comment`, `comment_count`, `bray`, `files`, `otpstatus`, `otp`) VALUES
(1, 'admin', 'johnreyespanola165@gmail.com', '', '', '', 'admin', '', '', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 'submitted', 1, '2023-09-21 20:59:15', '1', '0', '0', '<br>[test] [Aug 3, 2024 12:35 AM] EY', '0', '', '', 0, 724398),
(731, 'juan delacruz', 'juan@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1722872394.jpg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-08-05 07:39:54', '1', '0', '0', '', '', 'san jose', '', 0, 0),
(733, 'Super MAn', 'johnreyespanola165@gmail.com', '', '', '', '123456', '', 'uploads/pictures/1722872717.png', 'e10adc3949ba59abbe56e057f20f883e', 'normal', 'notsubmitted', 1, '2024-08-05 07:45:17', '0', '0', '0', '', '', 'burgos', '', 0, 0),
(734, 'marian revira', 'bonggotd@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1722874582.jpg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-08-05 08:16:22', '0', '0', '0', '', '', 'bulalakaw', '', 1, 519364),
(737, 'David Espinosa', 'sikatpinoy6@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1730694861.jpg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-11-04 04:34:21', '0', '0', '0', '', '', '', '', 0, 312130),
(738, 'Dasdasd', 'fakeg@mail.com', '', '', '', '123123', '', 'uploads/pictures/1730694944.jpeg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-11-04 04:35:44', '0', '0', '0', '', '', '', '', 0, 427047);

-- --------------------------------------------------------

--
-- Table structure for table `wedding`
--

CREATE TABLE `wedding` (
  `log_id` varchar(255) NOT NULL,
  `groom_name` varchar(255) DEFAULT NULL,
  `groom_age` varchar(50) DEFAULT NULL,
  `groom_birthplace` varchar(255) DEFAULT NULL,
  `groom_civil_status` varchar(50) DEFAULT NULL,
  `groom_residence` varchar(255) DEFAULT NULL,
  `groom_father` varchar(255) DEFAULT NULL,
  `groom_mother` varchar(255) DEFAULT NULL,
  `groom_baptism` varchar(255) DEFAULT NULL,
  `groom_confirmation` varchar(255) DEFAULT NULL,
  `groom_witnesses` text DEFAULT NULL,
  `bride_name` varchar(255) DEFAULT NULL,
  `bride_age` varchar(50) DEFAULT NULL,
  `bride_birthplace` varchar(255) DEFAULT NULL,
  `bride_civil_status` varchar(50) DEFAULT NULL,
  `bride_residence` varchar(255) DEFAULT NULL,
  `bride_father` varchar(255) DEFAULT NULL,
  `bride_mother` varchar(255) DEFAULT NULL,
  `bride_baptism` varchar(255) DEFAULT NULL,
  `bride_confirmation` varchar(255) DEFAULT NULL,
  `bride_witnesses` text DEFAULT NULL,
  `marriage_sched` datetime DEFAULT NULL,
  `marriage_phone` varchar(15) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `proofpayment` varchar(255) DEFAULT NULL,
  `statuspayment` tinyint(1) DEFAULT NULL,
  `bapstatus` tinyint(1) DEFAULT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `br` varchar(255) DEFAULT NULL,
  `bc` varchar(255) DEFAULT NULL,
  `wsphbb` varchar(255) DEFAULT NULL,
  `wsphbg` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wedding`
--

INSERT INTO `wedding` (`log_id`, `groom_name`, `groom_age`, `groom_birthplace`, `groom_civil_status`, `groom_residence`, `groom_father`, `groom_mother`, `groom_baptism`, `groom_confirmation`, `groom_witnesses`, `bride_name`, `bride_age`, `bride_birthplace`, `bride_civil_status`, `bride_residence`, `bride_father`, `bride_mother`, `bride_baptism`, `bride_confirmation`, `bride_witnesses`, `marriage_sched`, `marriage_phone`, `picture`, `proofpayment`, `statuspayment`, `bapstatus`, `uname`, `br`, `bc`, `wsphbb`, `wsphbg`, `date`) VALUES
('log_6761beb429f62', 'boy1', '22a', 'sdasdasd', 'adasd', 'adad', 'asdas', 'dasda', 'asdas', 'dasda', 'dasdasda\r\nasdad', 'girl1', '31 dec 9 2024', 'manila', 'asdasd', 'asdasd', 'asda', 'asdasd', 'asdasd', 'asdasd', 'aadasda', '2025-01-03 14:07:00', '09076011089', 'img/picture/20241218021100_picture.jpg', 'img/picture/20241218021100_proofpayment.png', 0, 1, 'sikatpinoy6@gmail.com', 'img/picture/20241218021100_br.png', 'img/picture/20241218021100_bc.png', 'img/picture/20241218021100_wsphbb.png', 'img/picture/20241218021100_wsphbg.png', '2024-12-18 02:11:00'),
('log_6761beb429f62c', 'boy1', '22a', 'sdasdasd', 'adasd', 'adad', 'asdas', 'dasda', 'asdas', 'dasda', 'dasdasda\r\nasdad', 'girl1', '31 dec 9 2024', 'manila', 'asdasd', 'asdasd', 'asda', 'asdasd', 'asdasd', 'asdasd', 'aadasda', '2025-01-03 14:07:00', '09076011089', 'img/picture/20241218021100_picture.jpg', 'img/picture/20241218021100_proofpayment.png', 0, 1, 'sikatpinoy6@gmail.com', 'img/picture/20241218021100_br.png', 'img/picture/20241218021100_bc.png', 'img/picture/20241218021100_wsphbb.png', 'img/picture/20241218021100_wsphbg.png', '2024-12-18 02:11:00'),
('log_6761c015037da', 'boy1', '22a', 'sdasdasd', 'adasd', 'adad', 'asdas', 'dasda', 'asdas', 'dasda', 'dasdasda\r\nasdad', 'girl1', '31 dec 9 2024', 'manila', 'asdasd', 'asdasd', 'asda', 'asdasd', 'asdasd', 'asdasd', 'aadasda', '2025-01-06 14:07:00', '09076011089', 'img/picture/20241218021653_picture.jpg', 'img/picture/20241218021653_proofpayment.png', 0, 0, 'sikatpinoy6@gmail.com', 'img/picture/20241218021653_br.png', 'img/picture/20241218021653_bc.png', 'img/picture/20241218021653_wsphbb.png', 'img/picture/20241218021653_wsphbg.png', '2024-12-18 02:16:53'),
('log_6761c03e6ee63', 'boy1', '22a', 'sdasdasd', 'adasd', 'adad', 'asdas', 'dasda', 'asdas', 'dasda', 'dasdasda\r\nasdad', 'girl1', '31 dec 9 2024', 'manila', 'asdasd', 'asdasd', 'asda', 'asdasd', 'asdasd', 'asdasd', 'aadasda', '2025-01-09 14:07:00', '09076011089', 'img/picture/20241218021734_picture.jpg', 'img/picture/20241218021734_proofpayment.png', 0, 0, 'sikatpinoy6@gmail.com', 'img/picture/20241218021734_br.png', 'img/picture/20241218021734_bc.png', 'img/picture/20241218021734_wsphbb.png', 'img/picture/20241218021734_wsphbg.png', '2024-12-18 02:17:34'),
('log_6761c0aa6ad78', 'boy1', '22a', 'sdasdasd', 'adasd', 'adad', 'asdas', 'dasda', 'asdas', 'dasda', 'dasdasda\r\nasdad', 'girl1', '31 dec 9 2024', 'manila', 'asdasd', 'asdasd', 'asda', 'asdasd', 'asdasd', 'asdasd', 'aadasda', '2025-01-09 14:07:00', '09076011089', 'img/picture/20241218021922_picture.jpg', 'img/picture/20241218021922_proofpayment.png', 0, 0, 'sikatpinoy6@gmail.com', 'img/picture/20241218021922_br.png', 'img/picture/20241218021922_bc.png', 'img/picture/20241218021922_wsphbb.png', 'img/picture/20241218021922_wsphbg.png', '2024-12-18 02:19:22'),
('log_67768dd3618a5', 'boy1', 'Dec 1 1988', 'manila', 'single', 'manil', 'boyf', 'boym', 'baptism1111', 'conformation111', 'ako ikaw sila', 'girl1', 'dec 9 2024', 'manila', 'single', 'manil', 'fatherg', 'motherg', 'baptism222222', 'confirmation222222', 'sila din at ikaw at ako', '2025-01-03 20:02:00', '09076011089', 'img/picture/20250102210003_picture.png', 'img/picture/20250102210003_proofpayment.png', 0, 0, 'fakeg@mail.com', 'img/picture/20250102210003_br.png', 'img/picture/20250102210003_bc.png', 'img/picture/20250102210003_wsphbb.png', 'img/picture/20250102210003_wsphbg.png', '2025-01-02 21:00:03'),
('log_67768dd363418a5', 'boy1', 'Dec 1 1988', 'manila', 'single', 'manil', 'boyf', 'boym', 'baptism1111', 'conformation111', 'ako ikaw sila', 'girl1', 'dec 9 2024', 'manila', 'single', 'manil', 'fatherg', 'motherg', 'baptism222222', 'confirmation222222', 'sila din at ikaw at ako', '2025-01-03 20:02:00', '09076011089', 'img/picture/20250102210003_picture.png', 'img/picture/20250102210003_proofpayment.png', 0, 0, 'fakeg@mail.com', 'img/picture/20250102210003_br.png', 'img/picture/20250102210003_bc.png', 'img/picture/20250102210003_wsphbb.png', 'img/picture/20250102210003_wsphbg.png', '2025-01-02 21:00:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `adminmass`
--
ALTER TABLE `adminmass`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `baptismal`
--
ALTER TABLE `baptismal`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `coh`
--
ALTER TABLE `coh`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `confirmation`
--
ALTER TABLE `confirmation`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wedding`
--
ALTER TABLE `wedding`
  ADD PRIMARY KEY (`log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adminmass`
--
ALTER TABLE `adminmass`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `baptismal`
--
ALTER TABLE `baptismal`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=739;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
