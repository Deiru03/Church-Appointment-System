-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 27, 2025 at 04:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(74, '2024-12-18 00:59:05', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005905_colors.png', 'male', 'manila', 'img/picture/20241218005905.png', '0', '1', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005905_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005905_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(75, '2024-12-18 00:59:12', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005912_colors.png', 'male', 'manila', 'img/picture/20241218005912.png', '0', '1', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005912_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005912_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(76, '2024-12-18 00:59:18', '2025-01-11 18:38:00', '0000-00-00 00:00:00', '09174549259', 'david martin', 'coco marton', 'driver', 'cocomartan', 'asdasd', 'asd', 'aadasd', 'asdas', 'dasdas', 'dasd', NULL, NULL, NULL, 'img/picture/20241218005918_colors.png', 'male', 'manila', 'img/picture/20241218005918.png', '0', '1', 'sikatpinoy6@gmail.com', 'img/certificates/20241218005918_stock-vector-flower-reproduction-vector-illustration-labeled-process', 'img/certificates/20241218005918_stock-vector-flower-reproduction-vector-illustration-labeled-process'),
(77, '2025-01-06 11:41:23', '2002-07-24 03:37:00', '0000-00-00 00:00:00', '09772774640', 'Jaime Angel Miijares', 'Jim Mijares', 'Manager ', 'Rosario Mijares', 'Food Checker', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106114123_baby.png', 'female', 'Rumbang, Rizal, Occidental MIndoro', 'img/picture/20250106114123.png', '0', '1', 'mijaresangel782@gmail.com', 'img/certificates/20250106114123_Marriage.png', 'img/certificates/20250106114123_bith.png'),
(78, '2025-01-06 11:45:00', '2003-05-13 01:42:00', '0000-00-00 00:00:00', '09569581440', 'Kath Lumogda', 'Val Lumogda', 'Barangay Captain', 'Sol Lumogda', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106114500_baby.png', 'female', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250106114500.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250106114500_Marriage.png', 'img/certificates/20250106114500_bith.png'),
(79, '2025-01-06 11:51:03', '2003-07-23 11:46:00', '0000-00-00 00:00:00', '09509898262', 'Mary Felle Malayas', 'Nonoy Malayas', 'Barangay Captain', 'Marie Malayas', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106115103_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250106115103.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250106115103_Marriage.png', 'img/certificates/20250106115103_bith.png'),
(80, '2025-01-06 11:54:55', '2002-07-08 11:51:00', '0000-00-00 00:00:00', '09485508343', 'Regine Tomas', 'Freddie Tomas', 'Barangay Captain', 'Ellen Tomas', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106115455_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250106115455.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250106115455_Marriage.png', 'img/certificates/20250106115455_bith.png'),
(81, '2025-01-06 18:56:21', '2002-07-08 11:51:00', '0000-00-00 00:00:00', '09485508343', 'Regine Tomas', 'Freddie Tomas', 'Barangay Captain', 'Ellen Tomas', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106185621_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250106185621.png', '0', '3', 'mijaresangel782@gmail.com', 'img/certificates/20250106185621_Marriage.png', 'img/certificates/20250106185621_bith.png'),
(82, '2025-01-06 19:02:49', '2005-08-29 07:00:00', '2000-02-02 15:00:00', '09567281669', 'Andrea B. Acosta', 'Jun Acosta', 'Barangay Captain', 'Sollie Acosta', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106190249_baby.png', 'female', 'Rumbang, Rizal, Occidental MIndoro', 'img/picture/20250106190249.png', '0', '2', 'mijaresangel782@gmail.com', 'img/certificates/20250106190249_Marriage.png', 'img/certificates/20250106190249_bith.png'),
(83, '2025-01-06 19:05:59', '2000-11-30 19:03:00', '0000-00-00 00:00:00', '09930867136', 'Andrew F. Dimalaluan', 'Nestor Dimalaluan', 'Barangay Captain', 'Monica Dimalaluan', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106190559_baby.png', 'male', 'Rumbang, Rizal, Occidental MIndoro', 'img/picture/20250106190559.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250106190559_Marriage.png', 'img/certificates/20250106190559_bith.png'),
(84, '2025-01-06 19:10:52', '2002-08-16 19:07:00', '0000-00-00 00:00:00', '09971663588', 'John Rey Espanola', 'Val Lumogda', 'Barangay Captain', 'Sol Lumogda', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106191052_baby.png', 'male', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250106191052.png', '0', '1', 'mijaresangel782@gmail.com', 'img/certificates/20250106191052_Marriage.png', 'img/certificates/20250106191052_bith.png'),
(85, '2025-01-06 19:20:32', '2005-10-18 19:18:00', '0000-00-00 00:00:00', '09150489329', 'Anthony Dimalaluan', 'Nestor Dimalaluan', 'Barangay Captain', 'Monica Dimalaluan', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106192032_baby.png', 'male', 'Rumbang, Rizal, Occidental MIndoro', 'img/picture/20250106192032.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250106192032_Marriage.png', 'img/certificates/20250106192032_bith.png'),
(86, '2025-01-06 19:23:37', '2011-09-18 07:21:00', '0000-00-00 00:00:00', '09812521785', 'Sophia Acosta', 'Jun Acosta', 'Barangay Captain', 'Sollie Acosta', 'HouseWife', 'Ranela', 'Mary', 'Angel', 'Kim', 'Eugene', NULL, NULL, NULL, 'img/picture/20250106192337_baby.png', 'female', 'Rumbang, Rizal, Occidental MIndoro', 'img/picture/20250106192337.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250106192337_Marriage.png', 'img/certificates/20250106192337_bith.png'),
(87, '2025-01-13 09:09:33', '2025-01-13 08:48:00', '0000-00-00 00:00:00', '09187803476', 'Angel Abos', 'Fred Abod', 'Fisherman', 'Medjen Abos', 'HouseWife', 'Jen', 'Cath', 'Jane', 'Kim', 'Aivan', NULL, NULL, NULL, 'img/picture/20250113090933_baby.png', 'female', 'Rumbang, Rizal, Occidental Mindoro', 'img/picture/20250113090933.png', '0', '2', 'mijaresangel782@gmail.com', 'img/certificates/20250113090933_Marriage.png', 'img/certificates/20250113090933_bith.png'),
(88, '2025-01-13 09:16:19', '2024-02-13 13:10:00', '0000-00-00 00:00:00', '09100224366', 'Rose Ysug', 'Ian Ysug', 'Farmers', 'Lyn Ysug', 'HouseWife', 'Enrico', 'Shane', 'John', 'Angel', 'Sadra', NULL, NULL, NULL, 'img/picture/20250113091619_baby.png', 'female', 'San Roque 2', 'img/picture/20250113091619.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113091619_Marriage.png', 'img/certificates/20250113091619_bith.png'),
(89, '2025-01-13 09:16:22', '2024-02-13 13:10:00', '0000-00-00 00:00:00', '09100224366', 'Rose Ysug', 'Ian Ysug', 'Farmers', 'Lyn Ysug', 'HouseWife', 'Enrico', 'Shane', 'John', 'Angel', 'Sadra', NULL, NULL, NULL, 'img/picture/20250113091622_baby.png', 'female', 'San Roque 2', 'img/picture/20250113091622.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113091622_Marriage.png', 'img/certificates/20250113091622_bith.png'),
(90, '2025-01-13 09:21:24', '2025-01-31 01:20:00', '0000-00-00 00:00:00', '09180334568', 'Sandra Espino', 'Jurge Espino', 'Fisherman', 'Gina Espino', 'HouseWife', 'Famela', 'Dio', 'Kim', 'Leo', 'Carlo', NULL, NULL, NULL, 'img/picture/20250113092124_baby.png', 'female', 'Bagong Sikat', 'img/picture/20250113092124.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113092124_Marriage.png', 'img/certificates/20250113092124_bith.png'),
(91, '2025-01-13 09:26:35', '2025-02-13 09:16:00', '0000-00-00 00:00:00', '09511234565', 'Juan Lim', 'Cleo Lim', 'Teacher', 'Sherlyn Lim', 'HouseWife', 'Jeff', 'Angel', 'Bea', 'Ruby', 'Jessa', NULL, NULL, NULL, 'img/picture/20250113092635_baby.png', 'female', 'Labangan Poblacion', 'img/picture/20250113092635.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113092635_Marriage.png', 'img/certificates/20250113092635_bith.png'),
(92, '2025-01-13 09:31:15', '2025-02-28 13:30:00', '0000-00-00 00:00:00', '09284758688', 'Harvey Tan', 'Geo Tan', 'Barangay Kagawad', 'Helen Tan', 'Teacher', 'Ariel ', 'Vincent', 'Alkin', 'Mark', 'Shena', NULL, NULL, NULL, 'img/picture/20250113093115_baby.png', 'male', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250113093115.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113093115_Marriage.png', 'img/certificates/20250113093115_bith.png'),
(93, '2025-01-13 10:15:50', '2025-03-21 14:12:00', '0000-00-00 00:00:00', '09274657483', 'Jenalyn Saulong', 'Fernand Saulong ', 'Fisherman', 'Editha Saulong', 'HouseWife', 'Delaila', 'Robert', 'Helen', 'Jake', 'Mel', NULL, NULL, NULL, 'img/picture/20250113101550_baby.png', 'female', 'San Roque 2', 'img/picture/20250113101550.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113101550_Marriage.png', 'img/certificates/20250113101550_bith.png'),
(94, '2025-01-13 10:18:48', '2025-03-15 13:16:00', '0000-00-00 00:00:00', '09757483888', 'Rio Abos', 'Erwin Abos', 'Fisherman', 'Clena Abos', 'HouseWife', 'John', 'Fea', 'Arnold', 'James', 'Sunshine', NULL, NULL, NULL, 'img/picture/20250113101848_baby.png', 'male', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250113101848.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113101848_Marriage.png', 'img/certificates/20250113101848_bith.png'),
(95, '2025-01-13 10:24:27', '2025-03-04 10:20:00', '0000-00-00 00:00:00', '09483746756', 'Elena Gonzales', 'Bobby Gonzales', 'Farmers', 'Laila Gonzales', 'Teacher', 'Novelyn', 'Harold', 'Hanna', 'Ruby', 'Rico', NULL, NULL, NULL, 'img/picture/20250113102427_baby.png', 'female', 'Bagong Sikat', 'img/picture/20250113102427.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113102427_Marriage.png', 'img/certificates/20250113102427_bith.png'),
(96, '2025-01-13 10:28:32', '2025-03-05 13:25:00', '0000-00-00 00:00:00', '09103746556', 'Khenn Garcia', 'Carlos Grcia', 'Farmers', 'Helen Garcia', 'HouseWife', 'Ranela', 'Cath', 'Jane', 'Leo', 'Aivan', NULL, NULL, NULL, 'img/picture/20250113102832_baby.png', 'male', 'Bagong Sikat', 'img/picture/20250113102832.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113102832_Marriage.png', 'img/certificates/20250113102832_bith.png'),
(97, '2025-01-13 10:57:21', '2025-02-14 10:00:00', '0000-00-00 00:00:00', '09163748738', 'Cyden Paz', 'Bin Paz', 'Barangay Kagawad', 'Samie Paz', 'HouseWife', 'Ading', 'Fam', 'Book', 'Luis', 'Linda ', NULL, NULL, NULL, 'img/picture/20250113105721_baby.png', 'female', 'San Roque 2', 'img/picture/20250113105721.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113105721_Marriage.png', 'img/certificates/20250113105721_bith.png'),
(98, '2025-01-13 11:01:06', '2025-02-27 13:00:00', '0000-00-00 00:00:00', '09183754637', 'Apple Pedro', 'Kim Pedro', 'Teacher', 'Meldrid Pedro', 'Teacher', 'Angel', 'Jessy', 'Bogs', 'Arman', 'Sandra', NULL, NULL, NULL, 'img/picture/20250113110106_baby.png', 'female', 'Rumbang, Rizal, Occidental MIndoro', 'img/picture/20250113110106.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113110106_Marriage.png', 'img/certificates/20250113110106_bith.png'),
(99, '2025-01-13 11:04:32', '2025-05-07 14:00:00', '0000-00-00 00:00:00', '09374675748', 'Dominic Dela Cruz', 'Danilo Dela Cruz', 'Farmers', 'Danica Dela Cruz', 'Teacher', 'Darmie', 'Daryl', 'Mark', 'Myla', 'Shown', NULL, NULL, NULL, 'img/picture/20250113110432_baby.png', 'male', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250113110432.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113110432_Marriage.png', 'img/certificates/20250113110432_bith.png'),
(100, '2025-01-13 11:08:24', '2025-05-15 16:59:00', '0000-00-00 00:00:00', '09274563638', 'Arniel Valdez', 'John Valdez', 'Farmers', 'Lyn Valdez', 'HouseWife', 'Jen', 'Shane', 'Mark', 'Myla', 'Ian', NULL, NULL, NULL, 'img/picture/20250113110824_baby.png', 'female', 'Bagong Sikat', 'img/picture/20250113110824.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113110824_Marriage.png', 'img/certificates/20250113110824_bith.png'),
(101, '2025-01-13 11:11:50', '2025-01-31 13:09:00', '0000-00-00 00:00:00', '09756463535', 'Shine Luke', 'Kim Luke', 'Teacher', 'Hydee Luke', 'Teacher', 'Mark', 'Dio', 'Ian', 'Rose', 'Amy', NULL, NULL, NULL, 'img/picture/20250113111150_baby.png', 'female', 'San Roque 2', 'img/picture/20250113111150.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113111150_Marriage.png', 'img/certificates/20250113111150_bith.png'),
(102, '2025-01-13 11:16:20', '2025-01-22 15:18:00', '0000-00-00 00:00:00', '09373465653', 'Rea Jocel', 'Rey Jocel', 'Barangay Captain', 'Hanna Jocel', 'Teacher', 'Lena', 'Jose', 'James', 'Prince', 'linsay', NULL, NULL, NULL, 'img/picture/20250113111620_baby.png', 'female', 'San Roque 1', 'img/picture/20250113111620.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113111620_Marriage.png', 'img/certificates/20250113111620_bith.png'),
(103, '2025-01-13 11:20:04', '2025-03-02 15:00:00', '0000-00-00 00:00:00', '09747464539', 'Carol Garcia', 'Carol Garcia', 'Fisherman', 'Helen Garcia', 'HouseWife', 'Famela', 'Jenalyn', 'Ma. Angel', 'Carlo', 'Khenn Jay', NULL, NULL, NULL, 'img/picture/20250113112004_baby.png', 'female', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250113112004.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113112004_Marriage.png', 'img/certificates/20250113112004_bith.png'),
(104, '2025-01-13 11:22:59', '2025-02-27 13:22:00', '0000-00-00 00:00:00', '09756563534', 'Rico Capinpin', 'Ramel Capinpin', 'Fisherman', 'Aina Capinpin', 'HouseWife', 'Amela', 'Jenalyn', 'Jane', 'Ruby', 'Aivan', NULL, NULL, NULL, 'img/picture/20250113112259_baby.png', 'male', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250113112259.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113112259_Marriage.png', 'img/certificates/20250113112259_bith.png'),
(105, '2025-01-13 11:27:02', '2025-01-28 13:30:00', '0000-00-00 00:00:00', '09646745673', 'Pink Gavino', 'Brown Gavino', 'Teacher', 'Shine Gavino', 'HouseWife', 'Amela', 'Mark', 'Jane', 'Kim', 'Shena', NULL, NULL, NULL, 'img/picture/20250113112702_baby.png', 'female', 'Bagong Sikat', 'img/picture/20250113112702.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113112702_Marriage.png', 'img/certificates/20250113112702_bith.png'),
(106, '2025-01-13 11:30:36', '2025-02-20 13:30:00', '0000-00-00 00:00:00', '09757578363', 'May Abos', 'Frank Abos', 'Fisherman', 'Marieta Abos', 'HouseWife', 'Anna', 'Bannie', 'Marlyn', 'Angel', 'Bron', NULL, NULL, NULL, 'img/picture/20250113113036_baby.png', 'female', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250113113036.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113113036_Marriage.png', 'img/certificates/20250113113036_bith.png'),
(107, '2025-01-13 11:34:01', '2025-02-27 15:30:00', '0000-00-00 00:00:00', '09674635353', 'Hebron Ecal', 'James Ecal', 'OFW', 'Hykee Ecal', 'Teacher', 'Jen', 'Khenn', 'Jhay', 'Angel', 'Famela', NULL, NULL, NULL, 'img/picture/20250113113401_baby.png', 'female', 'Baranggay 1', 'img/picture/20250113113401.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113113401_Marriage.png', 'img/certificates/20250113113401_bith.png'),
(108, '2025-01-13 11:36:41', '2025-01-10 15:30:00', '0000-00-00 00:00:00', '09757353423', 'Rich Paz', 'John Paz', 'Teacher', 'Lanie Paz', 'Teacher', 'Famela', 'Dio', 'Jane', 'Leo', 'Aivan', NULL, NULL, NULL, 'img/picture/20250113113641_baby.png', 'male', 'San Roque 2', 'img/picture/20250113113641.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113113641_Marriage.png', 'img/certificates/20250113113641_bith.png'),
(109, '2025-01-13 11:40:10', '2025-02-10 13:40:00', '0000-00-00 00:00:00', '09574635323', 'Marian Revira', 'Nestor Revira', 'OFW', 'Felesa Revira', 'HouseWife', 'Jun', 'Rey', 'Angel', 'Kin', 'Sandra', NULL, NULL, NULL, 'img/picture/20250113114010_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250113114010.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113114010_Marriage.png', 'img/certificates/20250113114010_bith.png'),
(110, '2025-01-13 11:43:41', '2025-03-02 13:45:00', '0000-00-00 00:00:00', '09874734847', 'Ramel Gomez', 'Renz Gomez', 'Teacher', 'Liza Gomez', 'Teacher', 'Jane', 'Angel', 'Marry', 'Myca', 'Jobby', NULL, NULL, NULL, 'img/picture/20250113114341_baby.png', 'female', 'San Roque 2', 'img/picture/20250113114341.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113114341_Marriage.png', 'img/certificates/20250113114341_bith.png'),
(111, '2025-01-13 11:47:01', '2025-02-28 07:59:00', '0000-00-00 00:00:00', '09578578364', 'Sarah Serna', 'Robert Serna', 'Fisherman', 'Luo Serna', 'Teacher', 'Shaira', 'Zhenn', 'Jay', 'Sopia', 'Ann', NULL, NULL, NULL, 'img/picture/20250113114701_baby.png', 'female', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250113114701.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113114701_Marriage.png', 'img/certificates/20250113114701_bith.png'),
(112, '2025-01-13 11:52:24', '2025-03-09 13:00:00', '0000-00-00 00:00:00', '09767836646', 'Mhariel Cruz', 'Sales Cruz', 'Fisherman', 'Gina Cruz', 'HouseWife', 'Unice', 'Mark', 'Lui', 'Henrie', 'John', NULL, NULL, NULL, 'img/picture/20250113115224_baby.png', 'female', 'San Roque 2', 'img/picture/20250113115224.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113115224_Marriage.png', 'img/certificates/20250113115224_bith.png'),
(113, '2025-01-13 11:56:08', '2025-01-16 14:57:00', '0000-00-00 00:00:00', '09567345678', 'Joey Pena', 'Kare Pena', 'Farmers', 'Lisa Pena', 'Teacher', 'Toneth', 'Judy', 'Julie', 'Fred', 'John', NULL, NULL, NULL, 'img/picture/20250113115608_baby.png', 'male', 'Adela, Rizal', 'img/picture/20250113115608.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113115608_Marriage.png', 'img/certificates/20250113115608_bith.png'),
(114, '2025-01-13 12:17:43', '2025-03-26 13:16:00', '0000-00-00 00:00:00', '09575355587', 'Jenny Flores', 'June Flores', 'Fisherman', 'Sania Florers', 'OFW', 'Estiban', 'Ely', 'Fle', 'Nonalyn', 'Hazel', NULL, NULL, NULL, 'img/picture/20250113121743_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250113121743.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113121743_Marriage.png', 'img/certificates/20250113121743_bith.png'),
(115, '2025-01-13 12:22:43', '2025-01-06 16:10:00', '0000-00-00 00:00:00', '09573546857', 'Hazel Pnganiban', 'Edmon Panganiban', 'Fisherman', 'Christine Panganiban', 'HouseWife', 'Narciso', 'Liza', 'Angelo', 'John', 'Lester', NULL, NULL, NULL, 'img/picture/20250113122243_baby.png', 'female', 'Magbay, San Jose, Occidental Mindoro', 'img/picture/20250113122243.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113122243_Marriage.png', 'img/certificates/20250113122243_bith.png'),
(116, '2025-01-13 12:26:25', '2025-02-04 14:25:00', '0000-00-00 00:00:00', '09578943267', 'John Lester Dela Cruz', 'Arlo Dela Cruz', 'Fisherman', 'Lorna Dela Cruz', 'House', 'Emilie', 'Alfredo', 'Draline', 'charline', 'Junior', NULL, NULL, NULL, 'img/picture/20250113122625_baby.png', 'male', 'San Roque 2', 'img/picture/20250113122625.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113122625_Marriage.png', 'img/certificates/20250113122625_bith.png'),
(117, '2025-01-13 12:29:41', '2025-02-17 15:27:00', '0000-00-00 00:00:00', '091234567896', 'Keth Montano', 'Norman Montano', 'Teacher', 'Luz Montano', 'OFW', 'Anel', 'Jina', 'Julie', 'Aina', 'Chan', NULL, NULL, NULL, 'img/picture/20250113122941_baby.png', 'male', 'Bagong Sikat', 'img/picture/20250113122941.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113122941_Marriage.png', 'img/certificates/20250113122941_bith.png'),
(118, '2025-01-13 12:33:05', '2025-01-17 16:30:00', '0000-00-00 00:00:00', '09789504356', 'Rian Blanco', 'Julie Blanc0', 'Teacher', 'Aida Blanco', 'HouseWife', 'Darwin', 'Rudy', 'Pablo', 'Mylene', 'Lordy', NULL, NULL, NULL, 'img/picture/20250113123305_baby.png', 'female', 'La Curva', 'img/picture/20250113123305.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113123305_Marriage.png', 'img/certificates/20250113123305_bith.png'),
(119, '2025-01-13 12:44:20', '2025-02-11 08:45:00', '0000-00-00 00:00:00', '09456732467', 'Amy Pedro', 'Ernesto Pedro', 'Farmers', 'Nelda Pedro', 'HouseWife', 'Jake', 'Clair', 'Jazel', 'Anthony', 'Kevin', NULL, NULL, NULL, 'img/picture/20250113124420_baby.png', 'female', 'San Roque 2', 'img/picture/20250113124420.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113124420_Marriage.png', 'img/certificates/20250113124420_bith.png'),
(120, '2025-01-13 12:48:43', '2025-01-23 14:50:00', '0000-00-00 00:00:00', '09678945678', 'Laira Escultor', 'Pakito Escultor', 'Fisherman', 'Lolita Escultor', 'HouseWife', 'Renil', 'Aaron', 'Rio ', 'Angie', 'Corazon', NULL, NULL, NULL, 'img/picture/20250113124843_baby.png', 'female', 'Baranggay 5', 'img/picture/20250113124843.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113124843_Marriage.png', 'img/certificates/20250113124843_bith.png'),
(121, '2025-01-13 12:51:46', '2025-01-23 13:50:00', '0000-00-00 00:00:00', '09456732456', 'Olivia Hebelya', 'Kim Herbelya', 'Farmers', 'Norma Herbelya', 'HouseWife', 'Gyza', 'Cunnie', 'Toneth', 'Anna', 'Joanna', NULL, NULL, NULL, 'img/picture/20250113125146_baby.png', 'female', 'Labangan Poblacion', 'img/picture/20250113125146.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113125146_Marriage.png', 'img/certificates/20250113125146_bith.png'),
(122, '2025-01-13 12:55:02', '2025-02-25 16:00:00', '0000-00-00 00:00:00', '0965434567', 'Shannia Saulong', 'Lonie Saulong', 'Fisherman', 'Sarah Saulong', 'HouseWife', 'Chamie', 'Joyce', 'Jae', 'Florie', 'Merly', NULL, NULL, NULL, 'img/picture/20250113125502_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250113125502.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113125502_Marriage.png', 'img/certificates/20250113125502_bith.png'),
(123, '2025-01-13 12:58:25', '2025-02-18 08:00:00', '0000-00-00 00:00:00', '09788888543', 'Sofia Marie Chan', 'Junie Chan', 'Fisherman', 'Ann Chan', 'HouseWife', 'Alvin', 'Magime', 'Clue', 'Marga', 'Sharoon', NULL, NULL, NULL, 'img/picture/20250113125825_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250113125825.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113125825_Marriage.png', 'img/certificates/20250113125825_bith.png'),
(124, '2025-01-13 13:15:03', '2025-01-15 15:12:00', '0000-00-00 00:00:00', '09888776651', 'Kobe Calinog', 'Aiko Calinog', 'Fisherman', 'Lucita Calinog', 'Teacher', 'Juan', 'Pedro', 'Editha', 'Merlyn', 'Jannah', NULL, NULL, NULL, 'img/picture/20250113131503_baby.png', 'male', 'Labangan Poblacion', 'img/picture/20250113131503.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113131503_Marriage.png', 'img/certificates/20250113131503_bith.png'),
(125, '2025-01-13 13:17:59', '2025-01-31 13:20:00', '0000-00-00 00:00:00', '09786654450', 'Clair Curpoz', 'Agupito Curpoz', 'Farmers', 'Angie Curpoz', 'HouseWife', 'Gloria', 'Marlyn', 'Syna', 'Excel', 'Joy', NULL, NULL, NULL, 'img/picture/20250113131759_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250113131759.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113131759_Marriage.png', 'img/certificates/20250113131759_bith.png'),
(126, '2025-01-13 13:21:22', '2025-01-25 14:00:00', '0000-00-00 00:00:00', '09888990098', 'Jazel Bartolo', 'Pablo Bartlolo', 'Farmers', 'Monica Batolo', 'OFW', 'Lanie', 'Laila', 'Jane', 'Arnold', 'Henrieco', NULL, NULL, NULL, 'img/picture/20250113132122_baby.png', 'female', 'Adela, Rizal', 'img/picture/20250113132122.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113132122_Marriage.png', 'img/certificates/20250113132122_bith.png'),
(127, '2025-01-13 13:25:35', '2025-02-27 14:23:00', '0000-00-00 00:00:00', '09567544346', 'Janneth Pascual', 'Carlito Pascual', 'Farmers', 'Cutie Pascual', 'OFW', 'Cora', 'May', 'Shiela ', 'Joyce', 'Charis', NULL, NULL, NULL, 'img/picture/20250113132535_baby.png', 'female', 'Bagong Sikat', 'img/picture/20250113132535.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250113132535_Marriage.png', 'img/certificates/20250113132535_bith.png'),
(128, '2025-01-21 11:47:31', '2025-01-08 11:45:00', '0000-00-00 00:00:00', '09971663588', 'caren yana paz', 'NJKDNVJKFDVN', 'JHDVBJDBVF', 'BVJBFJHFJ', 'BVFJHERBFERHFUI', 'FDVJHFJ', 'DFFE', 'GERGFER', 'FGREG', 'BGFDGDR', NULL, NULL, NULL, 'img/picture/20250121114731_mai.png', 'male', 'FHGJKH', 'img/picture/20250121114731.png', '0', '0', 'johnreyespanola_caststudent@omsc.ph.education', 'img/certificates/20250121114731_mai.png', 'img/certificates/20250121114731_mai.png'),
(129, '2025-01-22 13:46:25', '2025-01-27 13:43:00', '0000-00-00 00:00:00', '09971663588', 'Judy Ann Lim', 'Jake  Lim', 'Fisherman', 'Ana Lim', 'HouseWife', 'Enrico', 'Shane', 'Bea', 'Jake', 'Carlo', NULL, NULL, NULL, 'img/picture/20250122134625_baby.png', 'male', 'Labangan Poblacion', 'img/picture/20250122134625.png', '0', '1', 'galvez01242003@gmail.com', 'img/certificates/20250122134625_women.png', 'img/certificates/20250122134625_women.png'),
(130, '2025-01-22 14:11:54', '2025-01-29 13:00:00', '0000-00-00 00:00:00', '09971663588', 'Carol Garcia', 'Jake  Lim', 'Fisherman', 'Ana Lim', 'HouseWife', 'Enrico', 'mkm', 'ju9ui9i', 'u8u9i9i', 'u8u9u9i9', NULL, NULL, NULL, 'img/picture/20250122141154_mai.png', 'male', 'Labangan Poblacion', 'img/picture/20250122141154.png', '0', '1', 'mijaresangel782@gmail.com', 'img/certificates/20250122141154_lia.png', 'img/certificates/20250122141154_lia.png'),
(131, '2025-01-23 14:07:21', '2025-01-26 02:06:00', '0000-00-00 00:00:00', '09971663588', 'Prado Jerome', 'Jake  Lim', 'Fisherman', 'Ana Lim', 'HouseWife', 'Enrico', 'Shane', 'Angel', 'Kim', 'Carlo', NULL, NULL, NULL, 'img/picture/20250123140721_mai.png', 'male', 'Labangan Poblacion', 'img/picture/20250123140721.png', '0', '1', 'johnreyespanola_caststudent@omsc.ph.education', 'img/certificates/20250123140721_women.png', 'img/certificates/20250123140721_lia.png'),
(132, '2025-01-23 14:29:24', '2025-01-30 08:30:00', '0000-00-00 00:00:00', '09971663588', 'Prado Jerome', 'Jake  Lim', 'Fisherman', 'Ana Lim', 'HouseWife', 'Enrico', 'Shane', 'Jane', 'Kim', 'Sandra', NULL, NULL, NULL, 'img/picture/20250123142924_lia.png', 'male', 'Labangan Poblacion', 'img/picture/20250123142924.png', '0', '1', 'jeromeprado231@gmail.com', 'img/certificates/20250123142924_lia.png', 'img/certificates/20250123142924_lia.png'),
(133, '2025-01-24 09:45:35', '2025-01-26 09:41:00', '0000-00-00 00:00:00', '09499332529', 'Prado Jerome', 'Jake  Lim', 'Fisherman', 'Ana Lim', 'HouseWife', 'Enrico', 'bogart', 'marie', 'ana', 'reden', NULL, NULL, NULL, 'img/picture/20250124094535_1.png', 'female', 'Labangan Poblacion', 'img/picture/20250124094535.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250124094535_3.png', 'img/certificates/20250124094535_4.png'),
(134, '2025-01-24 09:45:39', '2025-01-26 09:41:00', '0000-00-00 00:00:00', '09499332529', 'Prado Jerome', 'Jake  Lim', 'Fisherman', 'Ana Lim', 'HouseWife', 'Enrico', 'bogart', 'marie', 'ana', 'reden', NULL, NULL, NULL, 'img/picture/20250124094539_1.png', 'female', 'Labangan Poblacion', 'img/picture/20250124094539.png', '0', '0', 'mijaresangel782@gmail.com', 'img/certificates/20250124094539_3.png', 'img/certificates/20250124094539_4.png'),
(135, '2025-01-24 14:51:56', '2025-01-24 14:50:00', '0000-00-00 00:00:00', '09499332529', 'Prado Jerome', 'Jake  Lim', 'Fisherman', 'Ana Lim', 'HouseWife', 'Enrico', 'Shane', 'Angel', 'Kim', 'John', NULL, NULL, NULL, 'img/picture/20250124145156_lia.png', 'female', 'Labangan Poblacion', 'img/picture/20250124145156.png', '0', '0', 'angelmijares224@gmail.com', 'img/certificates/20250124145156_2.png', 'img/certificates/20250124145156_1.png'),
(136, '2025-01-30 17:15:00', '2025-02-05 07:00:00', '0000-00-00 00:00:00', '09499332529', 'Prado Jerome', 'Jake  Lim', 'Fisherman', 'Ana Lim', 'HouseWife', 'Enrico', 'Shane', 'Angel', 'Angel', 'Sandra', NULL, NULL, NULL, 'img/picture/20250130171500_lia.png', 'female', 'Labangan Poblacion', 'img/picture/20250130171500.png', '0', '0', 'johnreyespanola_caststudent@omsc.ph.education', 'img/certificates/20250130171500_Women are made to be loved and respected.png', 'img/certificates/20250130171500_lia.png');

-- --------------------------------------------------------

--
-- Table structure for table `burial`
--

CREATE TABLE `burial` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `dateofdeath` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `sched` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `burial`
--

INSERT INTO `burial` (`id`, `date`, `dateofdeath`, `phone`, `address`, `fullname`, `uname`, `sched`, `status`) VALUES
(1, '2025-02-27 00:00:00', '2025-02-12', '0923842384', 'San Jose Capital', 'Free Dom', 'd@g.com', '2025-02-21 13:00:00', 1),
(2, '2025-02-20 09:00:00', '2025-02-20', '091237465', 'ASD', 'D Dolphi', 'd@g.com', '2025-02-12 07:00:00', 0),
(3, '2025-02-20 00:00:00', '2025-02-25', '091283', '1234 Streey', 'd  d anohter ', 'd@g.com', '2025-02-19 10:00:00', 0),
(4, '2025-02-15 00:00:00', '2025-02-12', '092345775748', 'Nara house', 'Reove', 'd@g.com', '2025-02-18 00:00:00', 2);

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
('log_6761c70a61f183.01928430', '2024-12-05', 'adaada', 'dasda', 'adsasd', '09076011089', 'asdaasdasda', '09174549259', 'img/proof_payment/20241218024634_proofpayment.png', 0, 2, 'sikatpinoy6@gmail.com', '', '', '2024-12-18 02:46:34'),
('log_6776901dc398f3.72964554', '2025-01-16', 'manila', 'aaaaa', 'aaaa', '09076011089', 'adaaaaa', '09076011089', 'img/proof_payment/20250102210949_proofpayment.png', 0, 2, 'fakeg@mail.com', '', '', '2025-01-02 21:09:49'),
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
('log_674f94485453', 'John Rey', 'male', '2024-12-29', 'manila', '09971663588', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-03 07:28:00', '2024-12-17 10:28:00', 0, 2, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_674f9448545334223', 'John Rey', 'male', '2024-12-29', 'manila', '09971663588', 'asdasdas', 'dasdas', 'dasdas', 'daasdasd', '2025-01-03 07:28:00', '2024-12-17 10:28:00', 0, 0, 'img/picture/20241204072912_picture.png', 'img/cob/20241204072912_cob.png', 'img/proofpayment/20241204072912_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-04 07:29:12'),
('log_6761b558c38d1', 'coco martin', 'male', '2024-12-17', 'manila', '09076011089', 'asdadsdas', 'dasdas', 'adsasdasda', 'asdasdasda', '2024-12-25 01:30:00', '2024-12-27 01:34:00', 0, 1, 'img/picture/20241218013104_picture.jpg', 'img/cob/20241218013104_cob.png', 'img/proofpayment/20241218013104_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-18 01:31:04'),
('log_6761b6ade55c6', 'putik na linta', 'male', '2024-12-26', 'manila', '09076011089', 'asdasda', 'dasdasda', 'asdasd', 'asdas', '2024-12-18 05:36:00', '2025-01-02 01:40:00', 0, 0, 'img/picture/20241218013645_picture.jpg', 'img/cob/20241218013645_cob.png', 'img/proofpayment/20241218013645_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-18 01:36:45'),
('log_6761b70fd1316', 'coco martin', 'male', '2025-01-01', 'sdfsdfsdf', '09076011089', 'asASAsda', 'dasd', 'asdadsd', 'asdsadaasda', '2025-01-02 03:38:00', '2025-01-08 05:38:00', 0, 0, 'img/picture/20241218013823_picture.png', 'img/cob/20241218013823_cob.png', 'img/proofpayment/20241218013823_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-18 01:38:23'),
('log_6761b7bcd03a2', 'coco martin', 'male', '2024-12-31', 'affsdfr', '09174549259', 'sfdsdfs', 'dfsdf', 'sdfsdfs', 'dffsdfsfs', '2024-12-28 04:40:00', '2025-01-02 06:40:00', 0, 0, 'img/picture/20241218014116_picture.png', 'img/cob/20241218014116_cob.jpg', 'img/proofpayment/20241218014116_proofpayment.png', 'sikatpinoy6@gmail.com', '2024-12-18 01:41:16'),
('log_6777536362a43', 'coco martinsdfsdfss', 'male', '2025-01-03', 'asdasdadasd', '09076011089', 'coco marton', 'cocomartan', 'sdfdsfsd', 'dfsdfsdfs', '2025-01-03 01:02:00', '2025-01-17 11:02:00', 0, 0, 'img/picture/20250103110259_picture.png', 'img/cob/20250103110259_cob.png', 'img/proofpayment/20250103110259_proofpayment.png', 'fakeg@mail.com', '2025-01-03 11:02:59'),
('log_6784adf722a11', 'Alberto Delos Santos', 'male', '2009-01-14', 'Labangan Poblacion', '09386759847', 'Aldin Delos Santos', 'Aida Delos Santos', 'Labangan Poblacion', 'Roman Catholic', '2025-01-22 07:00:00', '2025-01-22 08:05:00', 0, 0, 'img/picture/20250113140855_picture.png', 'img/cob/20250113140855_cob.png', 'img/proofpayment/20250113140855_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-13 14:08:55'),
('log_6784af3f2f027', 'Jenalyn Saulong', 'female', '2003-05-25', 'Magbay, San Jose, Occidental Mindoro', '09187803476', 'Fernand Saulong ', 'Editha Saulong', 'Magbay', 'Roman Catholic', '2025-01-30 08:12:00', '2025-02-13 08:13:00', 0, 0, 'img/picture/20250113141423_picture.png', 'img/cob/20250113141423_cob.png', 'img/proofpayment/20250113141423_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-13 14:14:23'),
('log_6784b0e2e8a21', 'Ma. angel Abos', 'female', '2002-10-11', 'San Roque 2', '09569581440', 'Fred Abos', 'Medjen Abos', 'San Roque', 'Roman Catholic', '2025-02-14 14:20:00', '2025-01-20 07:24:00', 0, 0, 'img/picture/20250113142122_picture.png', 'img/cob/20250113142122_cob.png', 'img/proofpayment/20250113142122_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-13 14:21:22'),
('log_6784b39462593', 'Harvey Ysug', 'male', '2004-01-27', 'Adela, Rizal', '09772774640', 'Carlo Ysug', 'Monica Ysug', 'Adila, Rizal', 'Roman Catholic', '2025-01-13 08:37:00', '2025-02-05 19:36:00', 0, 0, 'img/picture/20250113143252_picture.png', 'img/cob/20250113143252_cob.png', 'img/proofpayment/20250113143252_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-13 14:32:52'),
('log_6784b61c4735b', 'Roselyn Panganiban', 'female', '2003-03-30', 'San Roque 2', '09569581440', 'John Panganiban', 'Hazel Panganiban', 'San Roque', 'Roman Catholic', '2025-01-30 08:47:00', '2025-02-11 07:45:00', 0, 0, 'img/picture/20250113144340_picture.png', 'img/cob/20250113144340_cob.png', 'img/proofpayment/20250113144340_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-13 14:43:40'),
('log_67863ce622cef', 'Mary Grace Enano', 'female', '2003-09-21', 'La Curva', '09678543234', 'Anicito Enano', 'Panchita Enano', 'La Cuva', 'Roman Catholic', '2025-01-29 10:30:00', '2025-02-18 10:30:00', 0, 0, 'img/picture/20250114183102_picture.png', 'img/cob/20250114183102_cob.png', 'img/proofpayment/20250114183102_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 18:31:02'),
('log_67863ee3934e7', 'Abegail Dela Cruz', 'female', '2001-08-14', 'San Roque 2', '09887654323', 'Arlo Dela Cruz', 'Luz Dela Cruz', 'San Roque', 'Roman Catholic', '2025-01-21 08:40:00', '2025-02-26 07:40:00', 0, 0, 'img/picture/20250114183931_picture.png', 'img/cob/20250114183931_cob.png', 'img/proofpayment/20250114183931_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 18:39:31'),
('log_67863fd4765a4', 'Angelo Garcia', 'male', '2004-05-04', 'Labangan Poblacion', '09100224366', 'Henrito Garcia', 'Lorna  Garcia', 'Labangan Poblacion', 'Roman Catholic', '2025-01-24 10:47:00', '2025-01-30 10:44:00', 0, 0, 'img/picture/20250114184332_picture.png', 'img/cob/20250114184332_cob.png', 'img/proofpayment/20250114184332_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 18:43:32'),
('log_678642090e021', 'lordy Rendon', 'female', '2005-07-06', 'Bagong Sikat', '09678543234', 'Leonardo Rendon ', 'Mylene Rendon', 'Bagong Sikat', 'Roman Catholic', '2025-01-23 08:47:00', '2025-01-29 10:59:00', 0, 0, 'img/picture/20250114185257_picture.png', 'img/cob/20250114185257_cob.png', 'img/proofpayment/20250114185257_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 18:52:57'),
('log_678643446b3f8', 'Andin Andress', 'male', '2006-03-07', 'Bagong Sikat', '093456784323', 'James Andress', 'Aida Andress', 'Bagong Sikat', 'Roman Catholic', '2025-01-25 13:00:00', '2025-01-31 06:00:00', 0, 0, 'img/picture/20250114185812_picture.png', 'img/cob/20250114185812_cob.png', 'img/proofpayment/20250114185812_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 18:58:12'),
('log_67864423aa957', 'Cutie Magbudhi', 'male', '2006-08-22', 'Bagong Silang', '09789654345', 'Nilo Magbudhi', 'Anna Magbudhi', 'Bagong Silang', 'Roman Catholic', '2025-01-22 09:01:00', '2025-02-26 13:01:00', 0, 0, 'img/picture/20250114190155_picture.png', 'img/cob/20250114190155_cob.png', 'img/proofpayment/20250114190155_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:01:55'),
('log_6786467b50a2b', 'Abner Janairo', 'male', '2003-01-17', 'San Roque 2', '09187803476', 'Jun Janairo', 'Gina Janairo', 'San Roque 2', 'Roman Catholic', '2025-01-18 10:10:00', '2025-01-29 16:11:00', 0, 0, 'img/picture/20250114191155_picture.png', 'img/cob/20250114191155_cob.png', 'img/proofpayment/20250114191155_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:11:55'),
('log_678648a860400', 'Sandro Hermoso', 'female', '2003-02-08', 'Baranggay 5', '09772774640', 'Fred Hermoso', 'Alma Hermoso', 'Barangay 5', 'Roman Catholic', '2025-02-07 10:40:00', '2025-02-19 09:20:00', 0, 0, 'img/picture/20250114192112_picture.png', 'img/cob/20250114192112_cob.png', 'img/proofpayment/20250114192112_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:21:12'),
('log_678648ae41250', 'Sandro Hermoso', 'female', '2003-02-08', 'Baranggay 5', '09772774640', 'Fred Hermoso', 'Alma Hermoso', 'Barangay 5', 'Roman Catholic', '2025-02-07 10:40:00', '2025-02-19 09:20:00', 0, 0, 'img/picture/20250114192118_picture.png', 'img/cob/20250114192118_cob.png', 'img/proofpayment/20250114192118_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:21:18'),
('log_6786499705d98', 'Miboy Paz', 'male', '2003-01-01', 'La Curva', '09678543234', 'Alfred Paz', 'Lina Paz', 'La Curva', 'Roman Catholic', '2025-02-04 10:31:00', '2025-03-11 10:30:00', 0, 0, 'img/picture/20250114192511_picture.png', 'img/cob/20250114192511_cob.png', 'img/proofpayment/20250114192511_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:25:11'),
('log_67864a827e234', 'Kevin Chan', 'male', '2006-06-30', 'Labangan Poblacion', '09772774640', 'Medy Chan', 'Jeffry Chan', 'Labangan Poblacion', 'Roman Catholic', '2025-02-03 07:27:00', '2025-02-02 10:30:00', 0, 0, 'img/picture/20250114192906_picture.png', 'img/cob/20250114192906_cob.png', 'img/proofpayment/20250114192906_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:29:06'),
('log_67864b8e713b2', 'Helena Herera', 'female', '2003-08-04', 'Baranggay 1 SJ', '093456784323', 'Carlito Herera', 'Unice Herera', 'Barangay 1 SJ', 'Roman Catholic', '2025-01-24 10:32:00', '2025-02-09 10:35:00', 0, 0, 'img/picture/20250114193334_picture.png', 'img/cob/20250114193334_cob.png', 'img/proofpayment/20250114193334_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:33:34'),
('log_67864ced408ba', 'Kim Lacsao', 'female', '2003-08-26', 'San Roque 2', '09100224366', 'Arnel Lacsao', 'Amy Lacsao', 'San Roque 2', 'Roman Catholic', '2025-01-22 09:40:00', '2025-02-25 10:40:00', 0, 0, 'img/picture/20250114193925_picture.png', 'img/cob/20250114193925_cob.png', 'img/proofpayment/20250114193925_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:39:25'),
('log_67864dca06135', 'Rey Perdro', 'female', '2006-06-23', 'Labangan Poblacion', '09678543234', 'Alden Pedro', 'Luchi Pedro', 'Labangan Poblacion', 'Roman Catholic', '2025-01-19 10:44:00', '2025-02-04 10:41:00', 0, 0, 'img/picture/20250114194306_picture.png', 'img/cob/20250114194306_cob.png', 'img/proofpayment/20250114194306_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:43:06'),
('log_67864f1f8b758', 'Novelyn Alicante', 'female', '2003-04-25', 'Magbay, San Jose, Occidental Mindoro', '09569581440', 'Nardo Alicante', 'Lyn Alicante', 'Magbay', 'Roman Catholic', '2025-01-16 10:00:00', '2025-02-03 10:59:00', 0, 0, 'img/picture/20250114194847_picture.png', 'img/cob/20250114194847_cob.png', 'img/proofpayment/20250114194847_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:48:47'),
('log_678650edc1f2b', 'Paulo Aquino', 'male', '2007-07-06', 'Labangan Poblacion', '09100224366', 'Juan Aquino', 'Imelda Aquino', 'Labangan Poblacion', 'Roman Catholic', '2025-01-15 10:00:00', '2025-02-25 07:00:00', 0, 0, 'img/picture/20250114195629_picture.png', 'img/cob/20250114195629_cob.png', 'img/proofpayment/20250114195629_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-14 19:56:29'),
('log_6787adf40022c', 'Rosa Dela Rosa ', 'female', '2007-08-06', 'San Roque 2', '09678543234', 'Diego Dela Rosa', 'Luisa Dela Rosa', 'San Roque', 'Roman Catholic', '2025-01-25 13:00:00', '2025-02-07 13:00:00', 0, 0, 'img/picture/20250115204540_picture.png', 'img/cob/20250115204540_cob.png', 'img/proofpayment/20250115204540_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-15 20:45:40'),
('log_6787b087427e6', 'Merna Fuentes', 'female', '2011-07-05', 'Labangan Poblacion', '09569581440', 'Allen Fuentes', 'Sarah Fuentes', 'Labangan Poblacion', 'Roman Catholic', '2025-01-09 01:00:00', '2025-02-18 13:00:00', 0, 0, 'img/picture/20250115205639_picture.png', 'img/cob/20250115205639_cob.png', 'img/proofpayment/20250115205639_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-15 20:56:39'),
('log_6787b9c443bfb', 'Joseph Aguilar', 'male', '2004-10-05', 'Magbay, San Jose, Occidental Mindoro', '09772774640', 'Jim Aguilar', 'Kim Aguilar', 'Magbay', 'Roman Catholic', '2025-01-31 13:30:00', '2025-01-30 13:31:00', 0, 0, 'img/picture/20250115213604_picture.png', 'img/cob/20250115213604_cob.png', 'img/proofpayment/20250115213604_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-15 21:36:04'),
('log_678837105f112', 'Regil Reyes', 'male', '2005-09-16', 'Baranggay 5', '09569581440', 'Jun Reyes', 'Merna Reyes', 'Barangay 5', 'Roman Catholic', '2025-01-24 09:30:00', '2025-02-02 10:30:00', 0, 0, 'img/picture/20250116063040_picture.png', 'img/cob/20250116063040_cob.png', 'img/proofpayment/20250116063040_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 06:30:40'),
('log_678837d46967f', 'Alona Abos', 'female', '2005-07-23', 'Adela, Rizal', '09678543234', 'Melvin Abos', 'Gina Abos', 'Adila, Rizal', 'Roman Catholic', '2025-01-24 20:32:00', '2025-02-10 22:32:00', 0, 0, 'img/picture/20250116063356_picture.png', 'img/cob/20250116063356_cob.png', 'img/proofpayment/20250116063356_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 06:33:56'),
('log_6788388f5c311', 'Ziana Macalipay', 'female', '2001-10-23', 'Magbay, San Jose, Occidental Mindoro', '09678543234', 'Ramcy Macalipay', 'Dona macalipay', 'Magbay', 'Roman Catholic', '2025-01-17 09:35:00', '2025-02-05 10:35:00', 0, 0, 'img/picture/20250116063703_picture.png', 'img/cob/20250116063703_cob.png', 'img/proofpayment/20250116063703_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 06:37:03'),
('log_678839b65e56b', 'Angela Luna ', 'female', '2003-10-25', 'Labangan Poblacion', '09772774640', 'Nilo Luna', 'Angie Luna', 'Labangan Poblacion', 'Roman Catholic', '2025-01-18 09:40:00', '2025-02-28 07:41:00', 0, 0, 'img/picture/20250116064158_picture.png', 'img/cob/20250116064158_cob.png', 'img/proofpayment/20250116064158_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 06:41:58'),
('log_67883a5457545', 'Charity Ysug', 'female', '2006-07-25', 'San Roque 2', '09678543234', 'Roberto Ysug', 'Che Ysug', 'San Roque 2', 'Roman Catholic', '2025-01-24 10:43:00', '2025-03-04 09:43:00', 0, 0, 'img/picture/20250116064436_picture.png', 'img/cob/20250116064436_cob.png', 'img/proofpayment/20250116064436_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 06:44:36'),
('log_67883b338a319', 'Jelly Ann Cabay', 'female', '0004-07-31', 'La Curva', '09100224366', 'Elly Caabay', 'Joan Caabay', 'La Cuva', 'Roman Catholic', '2025-01-17 10:30:00', '2025-02-21 10:00:00', 0, 0, 'img/picture/20250116064819_picture.png', 'img/cob/20250116064819_cob.png', 'img/proofpayment/20250116064819_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 06:48:19'),
('log_67883bd21083c', 'Danilo Roldan', 'male', '2005-06-24', 'Baranggay 5', '09678543234', 'Alkin Roldan', 'Marilo Roldan', 'Barangay 5', 'Roman Catholic', '2025-02-11 09:00:00', '2025-02-27 10:00:00', 0, 0, 'img/picture/20250116065058_picture.png', 'img/cob/20250116065058_cob.png', 'img/proofpayment/20250116065058_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 06:50:58'),
('log_67883eeb18b3d', 'Allen Prado', 'male', '2004-10-31', 'Magbay, San Jose, Occidental Mindoro', '09100224366', 'Aldin Prado', 'Hellen Prado', 'Magbay', 'Roman Catholic', '2025-01-29 10:02:00', '2025-03-11 09:03:00', 0, 0, 'img/picture/20250116070411_picture.png', 'img/cob/20250116070411_cob.png', 'img/proofpayment/20250116070411_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 07:04:11'),
('log_67883ffb0f642', 'Anthony Herera', 'female', '2005-01-04', 'Baranggay 5', '09772774640', 'Fed Herera', 'May Herera', 'Barangay 5', 'Roman Catholic', '2025-01-16 10:07:00', '2025-02-20 10:07:00', 0, 0, 'img/picture/20250116070843_picture.png', 'img/cob/20250116070843_cob.png', 'img/proofpayment/20250116070843_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 07:08:43'),
('log_67883ffde7e0e', 'Anthony Herera', 'female', '2005-01-04', 'Baranggay 5', '09772774640', 'Fed Herera', 'May Herera', 'Barangay 5', 'Roman Catholic', '2025-01-16 10:07:00', '2025-02-20 10:07:00', 0, 0, 'img/picture/20250116070845_picture.png', 'img/cob/20250116070845_cob.png', 'img/proofpayment/20250116070845_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 07:08:45'),
('log_678840dc1bd50', 'Neo Pacheco', 'male', '2003-02-25', 'Labangan Poblacion', '093456784323', 'Bens Pacheco', 'May Pacheco', 'Labangan Poblacion', 'Roman Catholic', '2025-01-30 10:15:00', '2025-02-11 08:11:00', 0, 0, 'img/picture/20250116071228_picture.png', 'img/cob/20250116071228_cob.png', 'img/proofpayment/20250116071228_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 07:12:28'),
('log_678857e15a00d', 'John Lester Dela Cruz', 'male', '2003-04-27', 'La Curva', '09187803476', 'Arlo Dela Cruz', 'Lorna Dela Cruz', 'Labangan Poblacion', 'Roman Catholic', '2025-01-13 03:46:00', '2025-02-28 14:00:00', 0, 0, 'img/picture/20250116085041_picture.png', 'img/cob/20250116085041_cob.png', 'img/proofpayment/20250116085041_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 08:50:41'),
('log_6788595addb52', 'Arnel Dioso', 'male', '2004-04-03', 'San Roque 2', '09678543235', 'Miguel Dioso', 'Abby Dioso', 'San Roque 2', 'Roman Catholic', '2025-01-17 10:00:00', '2025-02-21 15:00:00', 0, 0, 'img/picture/20250116085658_picture.png', 'img/cob/20250116085658_cob.png', 'img/proofpayment/20250116085658_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 08:56:58'),
('log_67885c2d5f948', 'Acasia Salibio', 'female', '2003-08-05', 'Magbay, San Jose, Occidental Mindoro', '09772774640', 'Andy Salibio', 'Anable Salibio', 'Magbay', 'Roman Catholic', '2025-02-05 09:08:00', '2025-03-06 10:10:00', 0, 0, 'img/picture/20250116090901_picture.png', 'img/cob/20250116090901_cob.png', 'img/proofpayment/20250116090901_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:09:01'),
('log_67885cc4cd3a0', 'Zhenn Jacinto', 'female', '2006-06-25', 'Baranggay 1', '09100224366', 'Andy Jacinto', 'Jelyn Jacinto', 'Barangay 1 SJ', 'Roman Catholic', '2025-01-24 13:10:00', '2025-03-12 09:10:00', 0, 0, 'img/picture/20250116091132_picture.png', 'img/cob/20250116091132_cob.png', 'img/proofpayment/20250116091132_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:11:32'),
('log_67885ea372af4', 'June Marcos', 'female', '2025-02-03', 'San Roque 2', '093456784323', 'Ariel Marcos', 'Sheila Marcos', 'San Roque 2', 'Roman Catholic', '2025-02-20 10:17:00', '2025-03-03 13:17:00', 0, 0, 'img/picture/20250116091931_picture.png', 'img/cob/20250116091931_cob.png', 'img/proofpayment/20250116091931_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:19:31'),
('log_67885f8b3eb6f', 'Judy Ann Lim', 'female', '2003-02-04', 'Labangan Poblacion', '09187803476', 'Jake  Lim', 'Ana Lim', 'Labangan Poblacion', 'Roman Catholic', '2025-02-21 13:22:00', '2025-03-25 09:22:00', 0, 0, 'img/picture/20250116092323_picture.png', 'img/cob/20250116092323_cob.png', 'img/proofpayment/20250116092323_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:23:23'),
('log_6788609fbcad9', 'Alex Gonzaga', 'female', '2005-03-25', 'Magbay, San Jose, Occidental Mindoro', '09678543234', 'Lue Gonzaga', 'Lisa Gonzaga', 'Magbay', 'Roman Catholic', '2025-02-21 07:35:00', '2025-03-28 15:30:00', 0, 0, 'img/picture/20250116092759_picture.png', 'img/cob/20250116092759_cob.png', 'img/proofpayment/20250116092759_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:27:59'),
('log_6788619c5e5e3', 'Sheila Zafra', 'female', '2007-03-24', 'Adela, Rizal', '093456784323', 'Kim Zafra', 'Alexa Zafra', 'Adela, Rizal', 'Roman Catholic', '2025-02-18 14:30:00', '2025-04-16 15:30:00', 0, 0, 'img/picture/20250116093212_picture.png', 'img/cob/20250116093212_cob.png', 'img/proofpayment/20250116093212_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:32:12'),
('log_67886277ee825', 'Fam Saulong', 'female', '2004-03-21', 'Bagong Sikat', '09772774640', 'Allan Saulong', 'Lyn Saulong', 'Bagong Sikat', 'Roman Catholic', '2025-02-19 13:34:00', '2025-03-27 13:34:00', 0, 0, 'img/picture/20250116093551_picture.png', 'img/cob/20250116093551_cob.png', 'img/proofpayment/20250116093551_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:35:51'),
('log_678863c0a48cf', 'Mila Duterte', 'female', '2007-04-26', 'La Curva San Jose ', '09678543234', 'Ian Duterte', 'Clina Duterte', 'La Curva', 'Roman Catholic', '2025-02-20 13:40:00', '2025-03-10 21:40:00', 0, 0, 'img/picture/20250116094120_picture.png', 'img/cob/20250116094120_cob.png', 'img/proofpayment/20250116094120_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:41:20'),
('log_678864b957a0a', 'Kim Paulo Galamay', 'female', '2006-05-28', 'Bagong Silang', '09678543234', 'Rolly Galamay', 'Princes Galamay', 'Bagong Silang', 'Roman Catholic', '2025-02-28 13:44:00', '2025-03-13 09:44:00', 0, 0, 'img/picture/20250116094529_picture.png', 'img/cob/20250116094529_cob.png', 'img/proofpayment/20250116094529_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:45:29'),
('log_678865aa792fa', 'Charlene Abelende', 'female', '2007-05-03', 'Baranggay 5', '093456784323', 'Mark Abelende', 'Lucia Abelende', 'Barangay 5', 'Roman Catholic', '2025-03-01 10:47:00', '2025-03-21 07:00:00', 0, 0, 'img/picture/20250116094930_picture.png', 'img/cob/20250116094930_cob.png', 'img/proofpayment/20250116094930_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:49:30'),
('log_6788667d7e314', 'Jake Rosie', 'male', '2004-04-25', 'San Roque 2', '09772774640', 'Jimboy Rosie', 'Lyca Rosie', 'San Rorue', 'Roman Catholic', '2025-02-18 14:00:00', '2025-03-09 09:52:00', 0, 0, 'img/picture/20250116095301_picture.png', 'img/cob/20250116095301_cob.png', 'img/proofpayment/20250116095301_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:53:01'),
('log_6788675a94e98', 'Sheila Mae Magalona', 'female', '2007-07-02', 'Baranggay 1', '09678543234', 'Nilo Magalona', 'Bambie Magalona', 'Barangay 1', 'Roman Catholic', '2025-03-23 13:00:00', '2025-03-31 13:00:00', 0, 0, 'img/picture/20250116095642_picture.png', 'img/cob/20250116095642_cob.png', 'img/proofpayment/20250116095642_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:56:42'),
('log_6788681519483', 'Maria Ladaga', 'female', '2006-05-27', 'Baranggay 5', '09772774640', 'Nico Ladaga', 'Abby Ladaga', 'Barangay 5', 'Roman Catholic', '2025-03-23 13:00:00', '2025-04-19 13:00:00', 0, 0, 'img/picture/20250116095949_picture.png', 'img/cob/20250116095949_cob.png', 'img/proofpayment/20250116095949_proofpayment.png', 'mijaresangel782@gmail.com', '2025-01-16 09:59:49');

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
(1, 'admin', 'johnreyespanola165@gmail.com', '', '', '', 'admin', '', '', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 'submitted', 1, '2023-09-21 20:59:15', '1', '0', '0', '<br>[test] [Aug 3, 2024 12:35 AM] EY', '0', '', '', 0, 979301),
(731, 'juan delacruz', 'juan@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1722872394.jpg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-08-05 07:39:54', '1', '0', '0', '', '', 'san jose', '', 0, 0),
(733, 'Super MAn', 'johnreyespanola165@gmail.com', '', '', '', '123456', '', 'uploads/pictures/1722872717.png', 'e10adc3949ba59abbe56e057f20f883e', 'normal', 'notsubmitted', 1, '2024-08-05 07:45:17', '0', '0', '0', '', '', 'burgos', '', 0, 0),
(734, 'marian revira', 'bonggotd@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1722874582.jpg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-08-05 08:16:22', '0', '0', '0', '', '', 'bulalakaw', '', 1, 519364),
(737, 'David Espinosa', 'sikatpinoy6@gmail.com', '', '', '', '123123', '', 'uploads/pictures/1730694861.jpg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-11-04 04:34:21', '0', '0', '0', '', '', '', '', 0, 312130),
(738, 'Dasdasd', 'fakeg@mail.com', '', '', '', '123123', '', 'uploads/pictures/1730694944.jpeg', '4297f44b13955235245b2497399d7a93', 'normal', 'notsubmitted', 1, '2024-11-04 04:35:44', '0', '0', '0', '', '', '', '', 0, 427047),
(739, 'Jaime Angel R. Mijares', 'mijaresangel782@gmail.com', '', '', '', 'Angel_7!', '', 'uploads/pictures/1736079492.png', 'f75810d69c3c61d5429e6cf186e0d5ab', 'normal', 'notsubmitted', 1, '2025-01-05 12:18:12', '0', '0', '0', '', '', '', '', 0, 915090),
(740, 'JOHN   REY ESPANOLA', 'johnreyespanola_caststudent@omsc.ph.education', '', '', '', 'DV3S610A', '', 'uploads/pictures/1737430949.png', '125da45e6c726d48d5e64a1514b066f1', 'normal', 'notsubmitted', 1, '2025-01-21 03:42:29', '0', '0', '0', '', '', '', '', 0, 263585),
(741, 'Paulo', 'galvez01242003@gmail.com', '', '', '', 'paupaugalvez)24', '', 'uploads/pictures/1737524464.png', '1aa3b51a0ee4a0e8f1d1c74479bec0b6', 'normal', 'notsubmitted', 1, '2025-01-22 05:41:04', '0', '0', '0', '', '', '', '', 0, 573145),
(742, 'Prado Jerome', 'jeromeprado231@gmail.com', '', '', '', 'jerome_prado31!', '', 'uploads/pictures/1737613390.png', '95d9f7a471e0683a1d8e49a75aec464b', 'normal', 'notsubmitted', 1, '2025-01-23 06:23:10', '0', '0', '0', '', '', '', '', 0, 269767),
(743, 'Angel Mijares', 'angelmijares224@gmail.com', '', '', '', 'mijares1234', '', 'uploads/pictures/1737701236.png', 'ba4fe98e27685775f2e4198c47ba6fd7', 'normal', 'notsubmitted', 1, '2025-01-24 06:47:16', '0', '0', '0', '', '', '', '', 0, 500933),
(744, 'Deiru Testing Admin', 'deiru', 'deiru@g.com', '', '', 'd123', '', '', '', 'superadmin', 'submitted', 1, '2025-02-03 07:11:51', '1', '0', '0', '', '', '', '', 0, 0),
(745, 'deiru admin test', 'deiru@g.com', '', '', '', 'd123', '', 'uploads/pictures/1738566812.jpg', '7097c422d46bb61fc4c169dbbae1c1e6', 'superadmin', 'submitted', 1, '2025-02-03 07:13:32', '0', '0', '0', '', '', '', '', 0, 0),
(746, 'Dale', 'd@g.com', 'd@g.com', '', '', 'd123', '', 'uploads/pictures/1739328490.png', '667e637599947726ab8d004569992ef4', 'normal', 'notsubmitted', 1, '2025-02-12 02:48:10', '0', '0', '0', '', '', '', '', 0, 0),
(747, 'dddd', 'dddd@g.com', '', '', '', 'd123', '', 'uploads/pictures/1739328577.png', '667e637599947726ab8d004569992ef4', 'normal', 'notsubmitted', 1, '2025-02-12 02:49:37', '0', '0', '0', '', '', '', '', 0, 0),
(748, 'Sam', 'sam@g.com', '', '', '', 's123', '', 'uploads/pictures/1739328758.png', '7812e8b74f6837fba66f86fe86688a2b', 'normal', 'notsubmitted', 1, '2025-02-12 02:52:38', '0', '0', '0', '', '', '', '', 0, 0);

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
('log_67768dd363418a5', 'boy1', 'Dec 1 1988', 'manila', 'single', 'manil', 'boyf', 'boym', 'baptism1111', 'conformation111', 'ako ikaw sila', 'girl1', 'dec 9 2024', 'manila', 'single', 'manil', 'fatherg', 'motherg', 'baptism222222', 'confirmation222222', 'sila din at ikaw at ako', '2025-01-03 20:02:00', '09076011089', 'img/picture/20250102210003_picture.png', 'img/picture/20250102210003_proofpayment.png', 0, 0, 'fakeg@mail.com', 'img/picture/20250102210003_br.png', 'img/picture/20250102210003_bc.png', 'img/picture/20250102210003_wsphbb.png', 'img/picture/20250102210003_wsphbg.png', '2025-01-02 21:00:03'),
('log_678efa82aac63', 'Angel Lim', '30, September 20, 1995', 'Makati', 'Single', 'La Curva SJ', 'James Lim', 'Leneth Lim', '1979', '1984', 'Christine Lacsao\r\nKristine Samson\r\nJessa Bracamonte', 'Alona Molina', '25, April 20,2025', 'Magbay, Occidental Mindoro', 'Single', 'Magbay, Occidental Mindoro ', 'Eugine Malina', 'Dayana Molina', '1979', '1980', 'Ma.Angel Abos\r\nJl Labian\r\nMark Monte', '2025-01-29 09:34:00', '09187803476', 'img/picture/20250121093810_picture.jpg', 'img/picture/20250121093810_proofpayment.png', 0, 0, 'mijaresangel782@gmail.com', 'img/picture/20250121093810_br.jpg', 'img/picture/20250121093810_bc.jpg', 'img/picture/20250121093810_wsphbb.jpg', 'img/picture/20250121093810_wsphbg.jpg', '2025-01-21 09:38:10'),
('log_678efe6c585f1', 'Mark Luces', '30, April 20, 1995', 'San Roque', 'Single', 'San Roque', 'James Luces', 'Janice Luces', '1981', '1983', 'Alkin Ysug\r\nJonh Luna', 'Angela De Amor', '25, June,2025', 'Magbay, Occidental Mindoro', 'Single', 'Magbay', 'Arthur De Amor', 'Diane De Amor', '2015', '2016', 'Jelly Eguia\r\nEunice Paz', '2025-02-14 14:00:00', '09187803476', 'img/picture/20250121095452_picture.jpg', 'img/picture/20250121095452_proofpayment.png', 0, 0, 'mijaresangel782@gmail.com', 'img/picture/20250121095452_br.jpg', 'img/picture/20250121095452_bc.jpg', 'img/picture/20250121095452_wsphbb.jpg', 'img/picture/20250121095452_wsphbg.jpg', '2025-01-21 09:54:52'),
('log_678efee74a52b', 'Mark Luces', '30, April 20, 1995', 'San Roque', 'Single', 'San Roque', 'James Luces', 'Janice Luces', '1981', '1983', 'Alkin Ysug\r\nJonh Luna', 'Angela De Amor', '25, June,2025', 'Magbay, Occidental Mindoro', 'Single', 'Magbay', 'Arthur De Amor', 'Diane De Amor', '2015', '2016', 'Jelly Eguia\r\nEunice Paz', '2025-02-14 14:00:00', '09187803476', 'img/picture/20250121095655_picture.jpg', 'img/picture/20250121095655_proofpayment.png', 0, 0, 'mijaresangel782@gmail.com', 'img/picture/20250121095655_br.jpg', 'img/picture/20250121095655_bc.jpg', 'img/picture/20250121095655_wsphbb.jpg', 'img/picture/20250121095655_wsphbg.jpg', '2025-01-21 09:56:55');

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
-- Indexes for table `burial`
--
ALTER TABLE `burial`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `burial`
--
ALTER TABLE `burial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=749;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
