-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2018 at 07:50 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_tb`
--

CREATE TABLE `academic_tb` (
  `ACADEMIC_ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL DEFAULT '0',
  `DURATION_ID` int(11) DEFAULT '0',
  `INSTITUTENAME` varchar(150) DEFAULT '0',
  `START_DT` date DEFAULT '0000-00-00',
  `END_DT` date DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_tb`
--

INSERT INTO `academic_tb` (`ACADEMIC_ID`, `STUDENT_ID`, `DURATION_ID`, `INSTITUTENAME`, `START_DT`, `END_DT`) VALUES
(2, 7, 3, 'Miletstone school ', '2018-12-04', '2020-12-04'),
(3, 9, 4, 'Milestone College', '2018-12-22', '2020-12-22'),
(4, 11, 6, 'Uttara University', '2018-03-01', '2019-03-01'),
(5, 10, 6, 'Uttara University', '2018-03-01', '2019-03-01'),
(6, 13, 5, 'Asian University', '2015-03-01', '2019-03-01'),
(7, 6, 5, 'IUBAT', '2015-01-01', '2019-01-01'),
(8, 12, 3, 'Milestone College', '2018-12-22', '2020-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `allowance_tb`
--

CREATE TABLE `allowance_tb` (
  `ALLOWANCE_ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) DEFAULT NULL,
  `ALLOWANCE` int(11) DEFAULT NULL,
  `RECEIVED_DT` date DEFAULT NULL,
  `STATUS` int(11) DEFAULT '15',
  `REMARKS` varchar(50) DEFAULT 'Successfully paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance_tb`
--

INSERT INTO `allowance_tb` (`ALLOWANCE_ID`, `STUDENT_ID`, `ALLOWANCE`, `RECEIVED_DT`, `STATUS`, `REMARKS`) VALUES
(1, 10, 3500, '2018-11-15', 15, 'Successfully paid'),
(4, 9, 3000, '2018-11-16', 15, 'dsfsdf'),
(5, 7, 2500, '2018-11-16', 15, 'cANCELDEA'),
(6, 7, 2500, '2018-12-22', 17, 'Home'),
(7, 11, 2000, '2018-12-22', 15, 'Successfully paid'),
(8, 9, 3000, '2018-12-22', 17, 'HOme'),
(9, 10, 3500, '2018-12-22', 18, '');

--
-- Triggers `allowance_tb`
--
DELIMITER $$
CREATE TRIGGER `TRG_ALLOWANCE` BEFORE INSERT ON `allowance_tb` FOR EACH ROW BEGIN
SET New.ALLOWANCE = (SELECT ALLOWANCE from STUDENT_TB where STUDENT_ID = New.STUDENT_ID);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `balance_tb`
--

CREATE TABLE `balance_tb` (
  `BALANCE_ID` int(11) NOT NULL,
  `AMOUNT` double NOT NULL,
  `DATE` date NOT NULL,
  `DONOR_ID` int(11) NOT NULL,
  `PAYMENTTYPE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance_tb`
--

INSERT INTO `balance_tb` (`BALANCE_ID`, `AMOUNT`, `DATE`, `DONOR_ID`, `PAYMENTTYPE`) VALUES
(1, 50000, '2018-12-11', 1, 10),
(2, 10000, '2018-12-22', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `child_lookup_tb`
--

CREATE TABLE `child_lookup_tb` (
  `CLU_ID` int(11) NOT NULL,
  `PLU_ID` int(11) DEFAULT NULL,
  `CLUNAME` varchar(50) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_lookup_tb`
--

INSERT INTO `child_lookup_tb` (`CLU_ID`, `PLU_ID`, `CLUNAME`, `VALUE`) VALUES
(1, 1, 'MALE', NULL),
(2, 1, 'Female', NULL),
(3, 2, 'Active', NULL),
(4, 2, 'Terminated', NULL),
(5, 2, 'Waiting', NULL),
(6, 2, 'On Hold', NULL),
(7, 3, 'Active', NULL),
(8, 3, 'Inactive', NULL),
(9, 2, 'Completed', NULL),
(10, 4, 'Cash', NULL),
(11, 4, 'Cheque', NULL),
(12, 5, 'Paid', NULL),
(13, 5, 'Cancelled', NULL),
(14, 5, 'Due', NULL),
(15, 6, 'Paid', NULL),
(16, 6, 'Due', NULL),
(17, 6, 'Home', NULL),
(18, 6, 'cancelled', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) UNSIGNED NOT NULL,
  `division_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `website`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dhaka', 'à¦¢à¦¾à¦•à¦¾', 23.7115253, 90.4111451, 'www.dhaka.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(2, 3, 'Faridpur', 'à¦«à¦°à¦¿à¦¦à¦ªà§à¦°', 23.6070822, 89.8429406, 'www.faridpur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(3, 3, 'Gazipur', 'à¦—à¦¾à¦œà§€à¦ªà§à¦°', 24.0022858, 90.4264283, 'www.gazipur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(4, 3, 'Gopalganj', 'à¦—à§‹à¦ªà¦¾à¦²à¦—à¦žà§à¦œ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(5, 8, 'Jamalpur', 'à¦œà¦¾à¦®à¦¾à¦²à¦ªà§à¦°', 24.937533, 89.937775, 'www.jamalpur.gov.bd', '2015-09-12 22:33:27', '2016-04-06 04:48:38'),
(6, 3, 'Kishoreganj', 'à¦•à¦¿à¦¶à§‹à¦°à¦—à¦žà§à¦œ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(7, 3, 'Madaripur', 'à¦®à¦¾à¦¦à¦¾à¦°à§€à¦ªà§à¦°', 23.164102, 90.1896805, 'www.madaripur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(8, 3, 'Manikganj', 'à¦®à¦¾à¦¨à¦¿à¦•à¦—à¦žà§à¦œ', 0, 0, 'www.manikganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(9, 3, 'Munshiganj', 'à¦®à§à¦¨à§à¦¸à¦¿à¦—à¦žà§à¦œ', 0, 0, 'www.munshiganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(10, 8, 'Mymensingh', 'à¦®à§Ÿà¦®à¦¨à¦¸à¦¿à¦‚', 0, 0, 'www.mymensingh.gov.bd', '2015-09-12 22:33:27', '2016-04-06 04:49:01'),
(11, 3, 'Narayanganj', 'à¦¨à¦¾à¦°à¦¾à§Ÿà¦¾à¦£à¦—à¦žà§à¦œ', 23.63366, 90.496482, 'www.narayanganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(12, 3, 'Narsingdi', 'à¦¨à¦°à¦¸à¦¿à¦‚à¦¦à§€', 23.932233, 90.71541, 'www.narsingdi.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(13, 8, 'Netrokona', 'à¦¨à§‡à¦¤à§à¦°à¦•à§‹à¦¨à¦¾', 24.870955, 90.727887, 'www.netrokona.gov.bd', '2015-09-12 22:33:27', '2016-04-06 04:46:31'),
(14, 3, 'Rajbari', 'à¦°à¦¾à¦œà¦¬à¦¾à§œà¦¿', 23.7574305, 89.6444665, 'www.rajbari.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(15, 3, 'Shariatpur', 'à¦¶à¦°à§€à§Ÿà¦¤à¦ªà§à¦°', 0, 0, 'www.shariatpur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(16, 8, 'Sherpur', 'à¦¶à§‡à¦°à¦ªà§à¦°', 25.0204933, 90.0152966, 'www.sherpur.gov.bd', '2015-09-12 22:33:27', '2016-04-06 04:48:21'),
(17, 3, 'Tangail', 'à¦Ÿà¦¾à¦™à§à¦—à¦¾à¦‡à¦²', 0, 0, 'www.tangail.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(18, 5, 'Bogra', 'à¦¬à¦—à§à§œà¦¾', 24.8465228, 89.377755, 'www.bogra.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(19, 5, 'Joypurhat', 'à¦œà§Ÿà¦ªà§à¦°à¦¹à¦¾à¦Ÿ', 0, 0, 'www.joypurhat.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(20, 5, 'Naogaon', 'à¦¨à¦“à¦—à¦¾à¦', 0, 0, 'www.naogaon.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(21, 5, 'Natore', 'à¦¨à¦¾à¦Ÿà§‹à¦°', 24.420556, 89.000282, 'www.natore.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(22, 5, 'Nawabganj', 'à¦¨à¦¬à¦¾à¦¬à¦—à¦žà§à¦œ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(23, 5, 'Pabna', 'à¦ªà¦¾à¦¬à¦¨à¦¾', 23.998524, 89.233645, 'www.pabna.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(24, 5, 'Rajshahi', 'à¦°à¦¾à¦œà¦¶à¦¾à¦¹à§€', 0, 0, 'www.rajshahi.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(25, 5, 'Sirajgonj', 'à¦¸à¦¿à¦°à¦¾à¦œà¦—à¦žà§à¦œ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(26, 6, 'Dinajpur', 'à¦¦à¦¿à¦¨à¦¾à¦œà¦ªà§à¦°', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(27, 6, 'Gaibandha', 'à¦—à¦¾à¦‡à¦¬à¦¾à¦¨à§à¦§à¦¾', 25.328751, 89.528088, 'www.gaibandha.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(28, 6, 'Kurigram', 'à¦•à§à§œà¦¿à¦—à§à¦°à¦¾à¦®', 25.805445, 89.636174, 'www.kurigram.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(29, 6, 'Lalmonirhat', 'à¦²à¦¾à¦²à¦®à¦¨à¦¿à¦°à¦¹à¦¾à¦Ÿ', 0, 0, 'www.lalmonirhat.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(30, 6, 'Nilphamari', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€', 25.931794, 88.856006, 'www.nilphamari.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(31, 6, 'Panchagarh', 'à¦ªà¦žà§à¦šà¦—à§œ', 26.3411, 88.5541606, 'www.panchagarh.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(32, 6, 'Rangpur', 'à¦°à¦‚à¦ªà§à¦°', 25.7558096, 89.244462, 'www.rangpur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(33, 6, 'Thakurgaon', 'à¦ à¦¾à¦•à§à¦°à¦—à¦¾à¦à¦“', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(34, 1, 'Barguna', 'à¦¬à¦°à¦—à§à¦¨à¦¾', 0, 0, 'www.barguna.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(35, 1, 'Barisal', 'à¦¬à¦°à¦¿à¦¶à¦¾à¦²', 0, 0, 'www.barisal.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(36, 1, 'Bhola', 'à¦­à§‹à¦²à¦¾', 22.685923, 90.648179, 'www.bhola.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(37, 1, 'Jhalokati', 'à¦à¦¾à¦²à¦•à¦¾à¦ à¦¿', 0, 0, 'www.jhalakathi.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(38, 1, 'Patuakhali', 'à¦ªà¦Ÿà§à§Ÿà¦¾à¦–à¦¾à¦²à§€', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(39, 1, 'Pirojpur', 'à¦ªà¦¿à¦°à§‹à¦œà¦ªà§à¦°', 0, 0, 'www.pirojpur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(40, 2, 'Bandarban', 'à¦¬à¦¾à¦¨à§à¦¦à¦°à¦¬à¦¾à¦¨', 22.1953275, 92.2183773, 'www.bandarban.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(41, 2, 'Brahmanbaria', 'à¦¬à§à¦°à¦¾à¦¹à§à¦®à¦£à¦¬à¦¾à§œà¦¿à§Ÿà¦¾', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(42, 2, 'Chandpur', 'à¦šà¦¾à¦à¦¦à¦ªà§à¦°', 23.2332585, 90.6712912, 'www.chandpur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(43, 2, 'Chittagong', 'à¦šà¦Ÿà§à¦Ÿà¦—à§à¦°à¦¾à¦®', 22.335109, 91.834073, 'www.chittagong.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(44, 2, 'Comilla', 'à¦•à§à¦®à¦¿à¦²à§à¦²à¦¾', 23.4682747, 91.1788135, 'www.comilla.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(45, 2, 'Cox\'s Bazar', 'à¦•à¦•à§à¦¸ à¦¬à¦¾à¦œà¦¾à¦°', 0, 0, 'www.coxsbazar.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(46, 2, 'Feni', 'à¦«à§‡à¦¨à§€', 23.023231, 91.3840844, 'www.feni.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(47, 2, 'Khagrachari', 'à¦–à¦¾à¦—à§œà¦¾à¦›à§œà¦¿', 23.119285, 91.984663, 'www.khagrachhari.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(48, 2, 'Lakshmipur', 'à¦²à¦•à§à¦·à§à¦®à§€à¦ªà§à¦°', 22.942477, 90.841184, 'www.lakshmipur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(49, 2, 'Noakhali', 'à¦¨à§‹à§Ÿà¦¾à¦–à¦¾à¦²à§€', 22.869563, 91.099398, 'www.noakhali.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(50, 2, 'Rangamati', 'à¦°à¦¾à¦™à§à¦—à¦¾à¦®à¦¾à¦Ÿà¦¿', 0, 0, 'www.rangamati.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(51, 7, 'Habiganj', 'à¦¹à¦¬à¦¿à¦—à¦žà§à¦œ', 24.374945, 91.41553, 'www.habiganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(52, 7, 'Maulvibazar', 'à¦®à§Œà¦²à¦­à§€à¦¬à¦¾à¦œà¦¾à¦°', 24.482934, 91.777417, 'www.moulvibazar.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(53, 7, 'Sunamganj', 'à¦¸à§à¦¨à¦¾à¦®à¦—à¦žà§à¦œ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(54, 7, 'Sylhet', 'à¦¸à¦¿à¦²à§‡à¦Ÿ', 24.8897956, 91.8697894, 'www.sylhet.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(55, 4, 'Bagerhat', 'à¦¬à¦¾à¦—à§‡à¦°à¦¹à¦¾à¦Ÿ', 22.651568, 89.785938, 'www.bagerhat.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(56, 4, 'Chuadanga', 'à¦šà§à§Ÿà¦¾à¦¡à¦¾à¦™à§à¦—à¦¾', 23.6401961, 88.841841, 'www.chuadanga.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(57, 4, 'Jessore', 'à¦¯à¦¶à§‹à¦°', 23.16643, 89.2081126, 'www.jessore.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(58, 4, 'Jhenaidah', 'à¦à¦¿à¦¨à¦¾à¦‡à¦¦à¦¹', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(59, 4, 'Khulna', 'à¦–à§à¦²à¦¨à¦¾', 22.815774, 89.568679, 'www.khulna.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(60, 4, 'Kushtia', 'à¦•à§à¦·à§à¦Ÿà¦¿à§Ÿà¦¾', 23.901258, 89.120482, 'www.kushtia.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(61, 4, 'Magura', 'à¦®à¦¾à¦—à§à¦°à¦¾', 23.487337, 89.419956, 'www.magura.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(62, 4, 'Meherpur', 'à¦®à§‡à¦¹à§‡à¦°à¦ªà§à¦°', 23.762213, 88.631821, 'www.meherpur.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(63, 4, 'Narail', 'à¦¨à§œà¦¾à¦‡à¦²', 23.172534, 89.512672, 'www.narail.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20'),
(64, 4, 'Satkhira', 'à¦¸à¦¾à¦¤à¦•à§à¦·à§€à¦°à¦¾', 0, 0, 'www.satkhira.gov.bd', '2015-09-12 22:33:27', '2015-09-12 22:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(2) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`) VALUES
(1, 'Barisal'),
(2, 'Chittagong'),
(3, 'Dhaka'),
(4, 'Khulna'),
(5, 'Rajshahi'),
(6, 'Rangpur'),
(7, 'Sylhet'),
(8, 'Mymensingh');

-- --------------------------------------------------------

--
-- Table structure for table `donor_tb`
--

CREATE TABLE `donor_tb` (
  `DONOR_ID` int(11) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `IMAGE` varchar(50) DEFAULT NULL,
  `PHONE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `DIVISION_ID` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `ADDRESS` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor_tb`
--

INSERT INTO `donor_tb` (`DONOR_ID`, `NAME`, `IMAGE`, `PHONE`, `EMAIL`, `DIVISION_ID`, `DISTRICT_ID`, `ADDRESS`) VALUES
(1, 'Madam', 'don_1.ico', '01754213658', 'madam@atilimited.net', 5, 25, '  Sirajganj'),
(2, 'MD Sir', NULL, '01754263258', 'sir@gmail.com', 5, 25, 'Sirajganj');

-- --------------------------------------------------------

--
-- Table structure for table `duration_tb`
--

CREATE TABLE `duration_tb` (
  `DURATION_ID` int(11) NOT NULL,
  `CLASSNAME` varchar(50) DEFAULT NULL,
  `DURATION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duration_tb`
--

INSERT INTO `duration_tb` (`DURATION_ID`, `CLASSNAME`, `DURATION`) VALUES
(1, 'Class-8', 1),
(3, 'Class - (9-10)', 2),
(4, 'College', 2),
(5, 'University', 4),
(6, 'Masters', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tb`
--

CREATE TABLE `employee_tb` (
  `EMPLOYEE_ID` int(11) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `PHONE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `SALARY` double DEFAULT NULL,
  `DIVISION_ID` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `ADDRESS` varchar(150) DEFAULT NULL,
  `IMAGE` varchar(50) DEFAULT NULL,
  `HIRE_DT` date DEFAULT NULL,
  `END_DT` date DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_tb`
--

INSERT INTO `employee_tb` (`EMPLOYEE_ID`, `NAME`, `PHONE`, `EMAIL`, `SALARY`, `DIVISION_ID`, `DISTRICT_ID`, `ADDRESS`, `IMAGE`, `HIRE_DT`, `END_DT`, `STATUS`) VALUES
(2, 'Aleya', '01521364587', 'aleya@gmail.com', 500, 3, 1, 'Uttara ', 'emp_2.jpg', '2018-12-10', NULL, 7),
(3, 'Harun', '01687654321', 'harun@@gmail.com', 2500, 3, 17, 'Tangail', NULL, '2018-12-22', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `group_tb`
--

CREATE TABLE `group_tb` (
  `GROUP_ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `WEEKNO` int(11) NOT NULL,
  `DAYOFWEEK` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_tb`
--

INSERT INTO `group_tb` (`GROUP_ID`, `NAME`, `WEEKNO`, `DAYOFWEEK`) VALUES
(1, 'Group-1', 1, 'Friday'),
(2, 'Group-2', 2, 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `guardian_tb`
--

CREATE TABLE `guardian_tb` (
  `GUARDIAN_ID` int(11) NOT NULL,
  `GNAME` varchar(100) NOT NULL DEFAULT '0',
  `GRELATION` varchar(50) NOT NULL DEFAULT '0',
  `GPHONE` varchar(50) NOT NULL DEFAULT '0',
  `GEMAIL` varchar(50) NOT NULL DEFAULT '0',
  `GNATIONALID` varchar(50) NOT NULL DEFAULT '0',
  `GGENDER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardian_tb`
--

INSERT INTO `guardian_tb` (`GUARDIAN_ID`, `GNAME`, `GRELATION`, `GPHONE`, `GEMAIL`, `GNATIONALID`, `GGENDER`) VALUES
(4, 'Me', 'None', '01685220928', 'me@atilimited.net', 'me@atilimited.net', 0),
(5, 'Me', 'None', '01685220928', 'me@atilimited.net', 'me@atilimited.net', NULL),
(6, 'Ratul', 'Brother', '01548742365', 'ratul@gmail.com', 'ratul@gmail.com', NULL),
(7, 'Ratul', 'Brother', '01523145874', 'ratul@gmail.com', 'ratul@gmail.com', NULL),
(8, 'Ratul', 'Brother', '01523654789', 'ratul@gmail.com', 'ratul@gmail.com', NULL),
(9, 'Ratul', 'Brother', '01652314569', 'ratul@gmail.com', 'ratul@gmail.com', NULL),
(10, 'Nurul', 'brother', '01987654321', 'nurula@gmail.com', '9876543212', NULL),
(11, 'Zia', 'Brother', '01652312547', 'zia@gmail.com', 'zia@gmail.com', NULL),
(12, 'Amjad', 'Father', '01523156478', 'amzad@gmail.com', 'amzad@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent_lookup_tb`
--

CREATE TABLE `parent_lookup_tb` (
  `PLU_ID` int(11) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent_lookup_tb`
--

INSERT INTO `parent_lookup_tb` (`PLU_ID`, `NAME`) VALUES
(1, 'Gender'),
(2, 'Student Status'),
(3, 'Employee Status'),
(4, 'Payment Method'),
(5, 'Employee Payment Status'),
(6, 'Allowance Payment Status');

-- --------------------------------------------------------

--
-- Table structure for table `reference_tb`
--

CREATE TABLE `reference_tb` (
  `REF_ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `UPPERLIMIT` int(11) NOT NULL DEFAULT '0',
  `PHONE` varchar(50) NOT NULL,
  `EMAIL` varchar(70) NOT NULL,
  `DIVISION_ID` int(11) NOT NULL,
  `DISTRICT_ID` int(11) NOT NULL,
  `ADDRESS` varchar(250) NOT NULL,
  `LIMIT_FLAG` char(2) NOT NULL DEFAULT 'Y',
  `IMAGE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference_tb`
--

INSERT INTO `reference_tb` (`REF_ID`, `NAME`, `UPPERLIMIT`, `PHONE`, `EMAIL`, `DIVISION_ID`, `DISTRICT_ID`, `ADDRESS`, `LIMIT_FLAG`, `IMAGE`) VALUES
(2, 'Zia', 3, '01654236985', 'zia@gmail.com', 3, 12, '        Narshingdi', 'N', 'ref_2.png'),
(4, 'Johny', 5, '016523145690', 'johny@amarmail.com', 3, 1, 'Airport', 'Y', NULL),
(29, 'Aleya', 15, '01684521365', 'aleya@gmail.com', 3, 1, '         sector-7,Uttara', 'Y', 'ref_29.png');

-- --------------------------------------------------------

--
-- Table structure for table `result_tb`
--

CREATE TABLE `result_tb` (
  `RESULT_ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) DEFAULT NULL,
  `DURATION_ID` int(11) DEFAULT NULL,
  `SCALE` double DEFAULT NULL,
  `MARKSHEET` varchar(150) DEFAULT NULL,
  `GPA` double DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `EXAMTYPE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result_tb`
--

INSERT INTO `result_tb` (`RESULT_ID`, `STUDENT_ID`, `DURATION_ID`, `SCALE`, `MARKSHEET`, `GPA`, `DATE`, `EXAMTYPE`) VALUES
(3, 9, 4, 5, 'marksheet_3.xlsx', 4, '2018-12-16', 'Mid term'),
(4, 7, 1, 5, NULL, 5, '2018-12-22', 'Final'),
(5, 13, 5, 4, NULL, 3.2, '2018-11-01', 'Final'),
(6, 6, 5, 4, NULL, 3.8, '2018-12-22', '11th semester');

-- --------------------------------------------------------

--
-- Table structure for table `role_tb`
--

CREATE TABLE `role_tb` (
  `ROLE_ID` int(11) NOT NULL,
  `ROLENAME` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_tb`
--

INSERT INTO `role_tb` (`ROLE_ID`, `ROLENAME`, `DESCRIPTION`) VALUES
(1, 'Admin', 'Admin'),
(2, 'SuperAdmin', 'SuperAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `salary_tb`
--

CREATE TABLE `salary_tb` (
  `SAL_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `AMOUNT` double DEFAULT NULL,
  `PAYMENTSTATUS` int(11) DEFAULT NULL COMMENT 'Paid, Not Paid, Due',
  `REMARKS` varchar(50) DEFAULT 'Successful' COMMENT 'remarks for not paid and due',
  `BONUS` double DEFAULT '0' COMMENT 'if any bonus given'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary_tb`
--

INSERT INTO `salary_tb` (`SAL_ID`, `EMPLOYEE_ID`, `DATE`, `AMOUNT`, `PAYMENTSTATUS`, `REMARKS`, `BONUS`) VALUES
(2, 2, '2018-11-01', 500, 12, '', 0),
(3, 3, '2018-11-01', 2500, 12, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_tb`
--

CREATE TABLE `student_tb` (
  `STUDENT_ID` int(11) NOT NULL,
  `STNAME` varchar(100) DEFAULT NULL,
  `GENDER` int(11) DEFAULT NULL,
  `IMAGE` varchar(100) DEFAULT NULL,
  `STARTDT` date DEFAULT NULL,
  `GUARDIAN_ID` int(11) DEFAULT NULL,
  `ENDDT` date DEFAULT NULL,
  `REF_ID` int(11) DEFAULT NULL,
  `GROUP_ID` int(11) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PHONE` varchar(50) DEFAULT NULL,
  `PRSNTDIV_ID` int(11) DEFAULT NULL,
  `PRSNTDIS_ID` int(11) DEFAULT NULL,
  `PRSNTADDR` varchar(100) DEFAULT NULL,
  `PRMNTDIV_ID` int(11) DEFAULT NULL,
  `PRMNTDIS_ID` int(11) DEFAULT NULL,
  `PRMNTADDR` varchar(100) DEFAULT NULL,
  `CARDNO` varchar(50) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `NATIONALID` varchar(50) DEFAULT NULL,
  `ALLOWANCE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tb`
--

INSERT INTO `student_tb` (`STUDENT_ID`, `STNAME`, `GENDER`, `IMAGE`, `STARTDT`, `GUARDIAN_ID`, `ENDDT`, `REF_ID`, `GROUP_ID`, `EMAIL`, `PHONE`, `PRSNTDIV_ID`, `PRSNTDIS_ID`, `PRSNTADDR`, `PRMNTDIV_ID`, `PRMNTDIS_ID`, `PRMNTADDR`, `CARDNO`, `STATUS`, `NATIONALID`, `ALLOWANCE`) VALUES
(6, 'Md. Hossain', 1, NULL, NULL, 5, NULL, 2, 1, 'hossain@atilimited.net', '1684369981', 3, 3, 'Gazibari ', 3, 11, ' Narayanganj     ', '004', 6, '0123456789', 3500),
(7, 'Shuvo', 0, 'student_7.jpg', NULL, 6, NULL, 2, 1, 'shuvo@gmail.com', '1521368745', 3, 1, '   Uttara ', 3, 11, '   Gondhabpur ', '080', 3, '1236547890', 2500),
(9, 'Sabuj', 0, 'student_9.png', NULL, 8, NULL, 2, 2, 'sabuj@gmail.com', '1542784651', 3, 1, ' Uttara ', 4, 63, ' permanent address ', '050', 3, '012546987456', 3000),
(10, 'Ratul', 1, 'student_10.jpg', NULL, 9, NULL, 29, 2, 'ratul@gmail.com', '1652314569', 3, 1, 'Uttra', 3, 1, ' Uttra ', '002', 3, '465789123', 3500),
(11, 'Ziaur Rahman', 1, NULL, NULL, 10, NULL, 29, 1, 'zia@@gmail.com', '01621546325', 3, 3, 'Tongi', 3, 12, 'Narshingdi sadar', '001', 3, '987654324567', 2000),
(12, 'Hanif', 1, NULL, NULL, 11, NULL, 29, 2, 'hanif@@gmail.com', '01523126547', 3, 1, 'Uttara', 3, 12, ' Narshingdi Sadar ', '003', 3, '987654324567', 2000),
(13, 'Nurul', 1, 'student_13.jpg', NULL, 12, NULL, 2, 2, 'nurul@@gmail.com', '01987965467', 3, 3, 'Station road', 3, 3, '  Station road  ', '321', 3, '32145698777', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` int(2) UNSIGNED NOT NULL,
  `district_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `bn_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `USER_ID` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `ROLE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`USER_ID`, `USERNAME`, `PASSWORD`, `ROLE_ID`) VALUES
(4, 'Sir', '123', 1),
(9, 'Master', 'master', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_tb`
--
ALTER TABLE `academic_tb`
  ADD PRIMARY KEY (`ACADEMIC_ID`);

--
-- Indexes for table `allowance_tb`
--
ALTER TABLE `allowance_tb`
  ADD PRIMARY KEY (`ALLOWANCE_ID`);

--
-- Indexes for table `balance_tb`
--
ALTER TABLE `balance_tb`
  ADD PRIMARY KEY (`BALANCE_ID`);

--
-- Indexes for table `child_lookup_tb`
--
ALTER TABLE `child_lookup_tb`
  ADD PRIMARY KEY (`CLU_ID`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor_tb`
--
ALTER TABLE `donor_tb`
  ADD PRIMARY KEY (`DONOR_ID`);

--
-- Indexes for table `duration_tb`
--
ALTER TABLE `duration_tb`
  ADD PRIMARY KEY (`DURATION_ID`);

--
-- Indexes for table `employee_tb`
--
ALTER TABLE `employee_tb`
  ADD PRIMARY KEY (`EMPLOYEE_ID`);

--
-- Indexes for table `group_tb`
--
ALTER TABLE `group_tb`
  ADD PRIMARY KEY (`GROUP_ID`);

--
-- Indexes for table `guardian_tb`
--
ALTER TABLE `guardian_tb`
  ADD PRIMARY KEY (`GUARDIAN_ID`);

--
-- Indexes for table `parent_lookup_tb`
--
ALTER TABLE `parent_lookup_tb`
  ADD PRIMARY KEY (`PLU_ID`);

--
-- Indexes for table `reference_tb`
--
ALTER TABLE `reference_tb`
  ADD PRIMARY KEY (`REF_ID`);

--
-- Indexes for table `result_tb`
--
ALTER TABLE `result_tb`
  ADD PRIMARY KEY (`RESULT_ID`);

--
-- Indexes for table `role_tb`
--
ALTER TABLE `role_tb`
  ADD PRIMARY KEY (`ROLE_ID`);

--
-- Indexes for table `salary_tb`
--
ALTER TABLE `salary_tb`
  ADD PRIMARY KEY (`SAL_ID`);

--
-- Indexes for table `student_tb`
--
ALTER TABLE `student_tb`
  ADD PRIMARY KEY (`STUDENT_ID`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_tb`
--
ALTER TABLE `academic_tb`
  MODIFY `ACADEMIC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `allowance_tb`
--
ALTER TABLE `allowance_tb`
  MODIFY `ALLOWANCE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `balance_tb`
--
ALTER TABLE `balance_tb`
  MODIFY `BALANCE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `child_lookup_tb`
--
ALTER TABLE `child_lookup_tb`
  MODIFY `CLU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donor_tb`
--
ALTER TABLE `donor_tb`
  MODIFY `DONOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `duration_tb`
--
ALTER TABLE `duration_tb`
  MODIFY `DURATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_tb`
--
ALTER TABLE `employee_tb`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `group_tb`
--
ALTER TABLE `group_tb`
  MODIFY `GROUP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guardian_tb`
--
ALTER TABLE `guardian_tb`
  MODIFY `GUARDIAN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `parent_lookup_tb`
--
ALTER TABLE `parent_lookup_tb`
  MODIFY `PLU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reference_tb`
--
ALTER TABLE `reference_tb`
  MODIFY `REF_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `result_tb`
--
ALTER TABLE `result_tb`
  MODIFY `RESULT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_tb`
--
ALTER TABLE `role_tb`
  MODIFY `ROLE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary_tb`
--
ALTER TABLE `salary_tb`
  MODIFY `SAL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_tb`
--
ALTER TABLE `student_tb`
  MODIFY `STUDENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
