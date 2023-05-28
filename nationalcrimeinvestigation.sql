-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 09:48 PM
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
-- Database: `nationalcrimeinvestigation`
--

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `occurrenceId` int(11) DEFAULT NULL,
  `stationCode` varchar(55) DEFAULT NULL,
  `officerId` int(11) DEFAULT NULL,
  `casename` varchar(55) DEFAULT NULL,
  `casestatus` varchar(55) DEFAULT NULL,
  `crimetype` varchar(20) NOT NULL,
  `allocationDate` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `timeLogged` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `occurrenceId`, `stationCode`, `officerId`, `casename`, `casestatus`, `crimetype`, `allocationDate`, `remarks`, `timeLogged`) VALUES
(1, 1, 'NBI01', 3, 'Jack Molestation', 'Completed', '', '2022-02-01', 'Q', '2022-01-31 17:10:54'),
(2, 2, 'NBI02', 3, 'Gender Violence', 'Allocated', 'GENDER', '2022-01-01', NULL, '2021-12-31 17:10:54'),
(3, 3, 'NBI04', 20, 'Jaji Murder Case', 'Completed', 'HOMICIDE', '2020-03-01', 'Good Handling of the case from the officer', '2020-03-07 18:45:54'),
(4, 4, 'NBI04', 20, 'Judy Attempted Murder ', 'Completed', 'HOMICIDE', '2020-02-01', 'Good Handling of the case from the officer', '2020-01-31 17:10:54'),
(5, 5, 'NBI01', 11, 'Robberry Along Wiyaki', 'Completed', 'HOMICIDE', '2021-03-01', 'Good Handling of the case from the officer', '2021-02-28 17:10:54'),
(6, 6, 'NBI01', 11, 'Assault on Miriam', 'Completed', 'HOMICIDE', '2021-05-01', 'Good Handling of the case from the officer', '2021-04-30 17:10:54'),
(7, 7, 'NBI01', 3, 'Yahoo case', 'Allocated', 'GENDER', '2022-01-15', NULL, '2022-01-07 17:10:54'),
(8, 8, 'NBI02', 7, 'Madam Mwaura Rape', 'Allocated', 'GENDER', '2022-04-01', NULL, '2022-03-31 17:10:54'),
(9, 9, 'NBI02', 7, 'Downtown Rape', 'Allocated', 'GENDER', '2022-04-01', NULL, '2022-03-31 18:10:54'),
(10, 10, 'MSA01', 4, 'Ukunda Rape', 'Closed', 'GENDER', '2019-04-02', 'Lack of sufficient evidence', '2021-04-01 17:10:54'),
(11, 11, 'NBI04', 17, 'Ukunda Rape 2', 'Closed', 'GENDER', '2019-02-01', 'Lack of follow up from the accuser', '2019-01-31 17:10:54'),
(12, 12, 'NBI04', 20, 'Mtwapa Stalker', 'Allocated', 'HOMICIDE', '2021-12-12', 'Lack of follow up from witnesses', '2021-12-31 17:10:54'),
(13, 13, 'NBI01', 11, 'Jiji Stalker', 'Allocated', 'HOMICIDE', '2022-01-01', 'Lack of follow up from witnesses', '2022-01-31 17:10:54'),
(14, 14, 'NBI01', 11, 'Jiji Stalker', 'Allocated', 'HOMICIDE', '2022-01-15', 'Lack of follow up from witnesses', '2022-01-31 17:10:54'),
(15, 15, 'NBI03', 13, 'Gange Rape', 'Allocated', 'GENDER', '2022-01-18', 'Showing bad handling of witnesses', '2022-01-31 17:10:54'),
(16, 16, 'NBI03', 13, 'Bike Incident', 'Completed', 'GENDER', '2022-04-01', 'Showing an interest in the accused', '2022-03-31 17:10:54'),
(17, 17, 'MSA01', 4, 'Bike Incident', 'Completed', 'GENDER', '2022-03-01', 'Complain from the witness', '2022-03-20 17:10:54'),
(18, 18, 'NBI04', 15, 'Love Birds', 'Completed', 'GENDER', '2022-03-01', 'Showing bad handling of witnesses', '2022-03-10 17:10:54'),
(19, 19, 'NBI04', 15, 'Love Birds', 'Allocated', 'GENDER', '2022-01-21', NULL, '2022-01-31 17:10:54'),
(20, 20, 'NBI01', 2, 'Molestation', 'Completed', 'GENDER', '2022-01-22', '', '2022-01-31 17:10:54'),
(21, 21, 'MSA01', 10, 'Molestation', 'Closed', 'GENDER', '2022-04-01', 'Lack of follow up from the accuser', '2019-01-31 17:10:54'),
(22, 22, 'NBI01', 2, 'Rape', 'Closed', 'GENDER', '2022-04-01', 'Witness Tampering', '2022-04-17 17:10:54'),
(23, 23, 'NBI02', 7, 'Rape', 'Closed', 'GENDER', '2022-03-21', 'Witness Tampering', '2022-03-17 17:10:54'),
(24, 24, 'NBI02', 7, 'Rape', 'Closed', 'GENDER', '2022-04-21', 'Witness Tampering', '2022-04-17 17:10:54'),
(25, 25, 'NBI03', 13, 'Gang Rape', 'Allocated', 'GENDER', '2022-04-01', NULL, '2022-03-31 17:10:54'),
(26, 26, 'NBI03', 13, 'Molestation', 'Allocated', 'GENDER', '2022-04-01', NULL, '2022-03-31 17:10:54'),
(27, 27, 'NBI04', 15, 'Gang Rape', 'Allocated', 'GENDER', '2022-04-01', NULL, '2022-03-31 17:10:54'),
(28, 28, 'MSA01', 4, 'Gang Violence', 'Allocated', 'GENDER', '2022-04-01', NULL, '2022-03-31 17:10:54'),
(29, 29, 'MSA01', 4, 'Molestation', 'Completed', 'GENDER', '2022-04-01', 'Good Handling of the case from the officer', '2022-04-07 17:10:54'),
(30, 30, 'NBI02', 8, 'Hostel Rape', 'Completed', 'GENDER', '2021-11-20', 'Good Handling of the case from the officer', '2022-01-07 17:10:54'),
(31, 31, 'NBI02', 8, 'Molestation', 'Completed', 'GENDER', '2021-11-20', 'Good Handling of the case from the officer', '2022-01-07 17:10:54'),
(32, 32, 'NBI01', 2, 'Hostel Strike', 'Completed', 'GENDER', '2021-11-20', 'Good Handling of the case from the officer', '2022-01-07 17:10:54'),
(33, 33, 'NBI01', 11, 'Car Accident', 'Completed', 'HOMICIDE', '2021-11-20', 'Good Handling of the case from the officer', '2022-01-07 17:10:54'),
(34, 34, 'NBI01', 11, 'School Strike', 'Completed', 'HOMICIDE', '2021-11-20', 'Good Handling of the case from the officer', '2022-01-07 17:10:54'),
(35, 35, 'NBI04', 20, 'Car Accident', 'Completed', 'HOMICIDE', '2021-11-25', 'Good Handling of the case from the officer', '2021-12-31 17:10:54'),
(36, 36, 'NBI04', 20, 'Bike Accident', 'Completed', 'HOMICIDE', '2021-11-25', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(37, 37, 'MSA01', 4, 'School Incident', 'Completed', 'GENDER', '2022-01-01', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(38, 38, 'MSA01', 4, 'Safaricom CEO', 'Completed', 'GENDER', '2022-01-01', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(39, 39, 'NBI01', 2, 'Molestation On 7year Old', 'Completed', 'GENDER', '2022-01-01', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(40, 40, 'NBI04', 16, 'National Police Service', 'Completed', 'GENDER', '2022-01-01', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(41, 41, 'NBI02', 8, 'Molestation', 'Completed', 'GENDER', '2022-01-01', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(42, 42, 'NBI04', 16, 'Kenyan Army', 'Allocated', 'GENDER', '2022-01-01', NULL, '2022-01-31 17:10:54'),
(43, 43, 'NBI02', 8, 'Molestation', 'Allocated', 'GENDER', '2022-01-01', NULL, '2022-01-31 17:10:54'),
(44, 44, 'NBI04', 16, 'Mugiwara Rape Case', 'Allocated', 'GENDER', '2022-01-01', NULL, '2022-03-31 17:10:54'),
(45, 45, 'NBI04', 20, 'Doctor Yasau', 'Allocated', 'HOMICIDE', '2022-03-01', NULL, '2022-03-31 17:10:54'),
(46, 46, 'NBI01', 6, 'Robbery with violence Mbagathi way', 'Allocated', 'THEFT', '2022-05-20', NULL, '2022-05-20 17:10:54'),
(47, 47, 'NBI04', 18, 'Pickpocketing Ring ', 'Allocated', 'THEFT', '2022-05-18', NULL, '2022-04-30 17:10:54'),
(48, 48, 'NBI01', 6, 'Gang Theft At The Mall', 'Allocated', 'THEFT', '2022-05-10', NULL, '2022-04-30 17:10:54'),
(49, 49, 'NBI01', 10, 'Ghetto Boys Robbery', 'Completed', 'THEFT', '2022-04-20', 'Good Handling of the case from the officer', '2022-04-07 17:10:54'),
(50, 50, 'NBI02', 10, 'House Robbery', 'Closed', 'THEFT', '2022-04-20', 'Missing witness', '2022-03-07 17:10:54'),
(51, 51, 'NBI02', 8, 'Bank Heist', 'Completed', 'THEFT', '2021-12-20', 'Good Handling of the case from the officer', '2021-11-07 17:10:54'),
(52, 52, 'NBI01', 5, 'Hostel Strike', 'Closed', 'THEFT', '2021-05-20', 'Witness decided to widhraw from the case', '2021-04-20 17:10:54'),
(53, 53, 'NBI04', 19, 'Shimoli Robbery', 'Completed', 'THEFT', '2021-03-20', 'Good Handling of the case from the officer', '2021-02-07 17:10:54'),
(54, 54, 'NBI04', 19, 'School Strike', 'Closed', 'THEFT', '2021-08-20', 'Lack of sufficient evidence', '2021-07-07 17:10:54'),
(55, 55, 'NBI04', 18, 'Vineyard Pickpocket', 'Completed', 'THEFT', '2021-11-25', 'Good Handling of the case from the officer', '2021-10-20 17:10:54'),
(56, 56, 'NBI04', 19, 'Bike Stolen', 'Completed', 'THEFT', '2021-11-25', 'Good Handling of the case from the officer', '2021-10-15 17:10:54'),
(57, 57, 'MSA01', 6, 'Cuea Theft', 'Completed', 'THEFT', '2022-01-01', 'Good Handling of the case from the officer', '2022-01-29 17:10:54'),
(58, 58, 'MSA01', 6, 'Laptop School Thief', 'Completed', 'THEFT', '2022-06-01', 'Good Handling of the case from the officer', '2022-05-29 17:10:54'),
(59, 59, 'NBI01', 19, 'Juvenile Theft', 'Completed', 'THEFT', '2022-06-01', 'Good Handling of the case from the officer', '2022-05-29 17:10:54'),
(60, 60, 'NBI04', 20, 'National Police Theft', 'Completed', 'THEFT', '2022-06-01', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(61, 61, 'NBI02', 5, 'Vmall Scandal', 'Completed', 'THEFT', '2022-02-01', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(62, 62, 'NBI04', 5, 'Toiletries Theft', 'Allocated', 'THEFT', '2022-06-15', NULL, '2022-05-15 17:10:54'),
(63, 63, 'NBI02', 9, 'Naivas Shoplifting', 'Allocated', 'THEFT', '2022-05-01', NULL, '2022-04-15 17:10:54'),
(64, 64, 'NBI04', 5, 'Mugiwara Heist', 'Allocated', 'THEFT', '2022-06-01', NULL, '2022-05-15 17:10:54'),
(65, 65, 'NBI04', 19, 'Doctor Yasau', 'Allocated', 'THEFT', '2022-03-01', NULL, '2022-02-15 17:10:54'),
(66, 66, 'NBI04', 19, 'Church Heist', 'Completed', 'THEFT', '2021-05-25', 'Good Handling of the case from the officer', '2022-01-30 17:10:54'),
(67, 67, 'MSA01', 6, 'G4S Heist', 'Completed', 'THEFT', '2022-05-01', 'Good Handling of the case from the officer', '2022-01-31 17:10:54'),
(68, 68, 'MSA01', 8, 'Safaricom CEO Heist', 'Completed', 'THEFT', '2022-06-01', 'Good Handling of the case from the officer', '2022-05-20 17:10:54'),
(69, 69, 'NBI01', 8, 'Muthurwa Fraud', 'Completed', 'THEFT', '2022-01-01', 'Good Handling of the case from the officer', '2022-04-30 17:10:54'),
(70, 70, 'NBI04', 8, 'PCEA Church Heist', 'Completed', 'THEFT', '2022-01-01', 'Good Handling of the case from the officer', '2022-04-30 17:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `caseid` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `occurrences`
--

CREATE TABLE `occurrences` (
  `id` int(11) NOT NULL,
  `officerId` int(11) DEFAULT NULL,
  `stationCode` varchar(55) DEFAULT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `residency` varchar(100) DEFAULT NULL,
  `date_of_incident` date DEFAULT NULL,
  `crimelocation` varchar(100) DEFAULT NULL,
  `crimetype` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `timeLogged` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `stationCode` varchar(20) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `county` varchar(20) DEFAULT NULL,
  `mobile` varchar(30) NOT NULL,
  `category` varchar(20) DEFAULT NULL,
  `cells` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `name`, `stationCode`, `location`, `county`, `mobile`, `category`, `cells`) VALUES
(1, 'Central Police Station', 'NBI01', 'PRC9+67Q, Moi Ave, Nairobi', 'Nairobi', '07O414399O', '5', 100),
(2, 'Donholm Police Station', 'NBI02', 'MVXQ+J8C,Donholmn', 'Nairobi', '0736350100', '3', 25),
(3, 'Ruaraka Police Station', 'NBI03', 'PVV4+JQ3, Thika Rd, Nairobi', 'Nairobi', '0736350103', '3', 40),
(4, 'Pangani Police Station', 'NBI04', 'PRHP+X8R, Opposite Pumwani Secondary School, Juja Rd, Nairobi', 'Nairobi', '0736350110', '3', 40),
(5, 'Gigiri Police Station', 'NBI05', 'QR75+CQ5, United Nations Cres, Nairobi City', 'Nairobi', '020 2724501', '4', 50),
(6, 'Starehe Police Division Station', 'NBI06', 'PRJM+4XH,Goan Institute,Juja Rd', 'Nairobi', 'O7O4143940', '5', 100),
(7, 'Nyali Police Station', 'MSA01', 'WMXV+27F, Moyne Dr, Mombasa', 'Mombasa', '041 2477555', '4', 100),
(8, 'Changamwe Police Station', 'MSA02', 'XJFG+RJ8, Opposite Changamwe Post Office, Magongo Rd', 'Mombasa', '020 353894', '3', 60),
(9, 'Mshomoroni Police Station', 'MSA03', 'XMHJ+CQQ, Kengelani Rd, Mombasa', 'Mombasa', '0720 655671', '2', 15),
(10, 'Bamburi Police Station', 'MSA04', '2P38+CMP, Unnamed Road, Mombasa', 'Mombasa', '041 2477412', '5', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `stationCode` varchar(20) DEFAULT NULL,
  `county` varchar(20) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `rank` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `mobile`, `stationCode`, `county`, `department`, `rank`, `username`, `password`, `date`) VALUES
(1, 'Wesley', 'Moturi', '0705562261', 'NBI01', 'Nairobi', 'OCPD', 'Cheif Inspector', 'inspektor', '78a7ae6ea0004b5e21b20ad05bd44a28', '2022-05-26 13:34:14'),
(2, 'Elton', 'Moturi', '0703332654', 'NBI01', 'Nairobi', 'HGENDER', 'Inspector', 'belton', '4a3f953f189ee4be9b955f673e81d9e3', '2022-05-30 04:06:04'),
(3, 'Yasukee', 'Mwanzo', '0736350110', 'NBI01', 'Nairobi', 'GENDER', 'Inspector', 'yasuu', 'da46c4a51342c24e7a8ddd386f7c673f', '2022-06-02 18:04:42'),
(4, 'Babazu', 'Khali', '0712350321', 'MSA01', 'Mombasa', 'GENDER', 'Inspector', 'khaali', '1cc1150d365475cbb1992d9ab138bd8e', '2022-06-02 18:05:46'),
(5, 'Eunice ', 'Gechem', '0745127863', 'NBI01', 'Nairobi', 'THEFT', 'Corporal', 'Gechem', '5f5df3e299da312c2c969772b95c52a3', '2022-06-02 18:20:35'),
(6, 'Maggie', 'Kianda', '0714567863', 'NBI01', 'Nairobi', 'HTHEFT', 'Inspector', 'Kiandaaa', '63c4304e7346de1c8ff6b3de9aae1f4b', '2022-06-02 18:35:51'),
(7, 'Jack', 'Mugeni', '0741890413', 'NBI02', 'Nairobi', 'GENDER', 'Corporal', 'Mugen', 'edba6ebf59cba94c668570ac52ba2f91', '2022-06-02 18:35:51'),
(8, 'Mboto', 'James', '0722654000', 'NBI02', 'Nairobi', 'HGENDER', 'Senior Sergeant', 'Zumanji', 'af7c97851662925e5a9ae20bccffe0aa', '2022-06-02 18:35:51'),
(9, 'Junet', 'Nasir', '0726754195', 'NBI02', 'Nairobi', 'THEFT', 'Sergeant', 'Nasizzy', '502e32f47d51a5a806325b95e68dce6d', '2022-06-02 18:35:51'),
(10, 'Kibwana', 'Banju', '0720987452', 'NBI02', 'Nairobi', 'HTHEFT', 'Senior Sergeant', 'Metoto789', '2576304585e974483c7ac8a192eacd0f', '2022-06-02 18:35:51'),
(11, 'Njambi', 'Merimela', '0780122555', 'NBI01', 'Nairobi', 'HOMICIDE', 'Chief Inspector', 'Merimela', '9950d2d7973589c27e95eacdd7414c71', '2022-06-02 18:35:51'),
(12, 'Jackson', 'Mogaka', '0119875641', 'NBI01', 'Nairobi', 'OCPD', 'Chief Inspector', 'Mogaks', 'f99d8467095ec3b770d2eb6d98f35567', '2022-06-02 18:35:51'),
(13, 'Peter', 'Sonk', 'O7O4143941', 'NBI03', 'Nairobi', 'GENDER', 'Corporal', 'Sontoo', 'a81dcdf9a58f38101dfd9b4c391f9d70', '2022-06-02 18:46:26'),
(14, 'Martin', 'Shikuku', '0700255441', 'NBI04', 'Nairobi', 'OCPD', 'Chief Inspector', 'Shikuku', '5cfa108e67f89f70e59e6bc96c0833e0', '2022-06-02 18:59:28'),
(15, 'Jhon', 'Muturi', '0121547896', 'NBI04', 'Nairobi', 'GENDER', 'Corporal', 'Jhonturi', '28b3fd96b3a7bcf8dd0516a541bd1cb3', '2022-06-02 18:59:28'),
(16, 'Pricilla', 'Mkahmbe', '0751498852', 'NBI04', 'Nairobi', 'HGENDER', 'Inspector', 'Prixxza', '3ce1caa29ed4dadd7eaeaf9c582c089f', '2022-06-02 18:59:28'),
(17, 'Muslim ', 'Shukri', '0745127863', 'NBI04', 'Nairobi', 'GENDER', 'Sergrant', 'Shukriiz', '1d84f40074625498112e7bb1f1edc200', '2022-06-02 18:59:28'),
(18, 'Jasper', 'Tembo', '0766321458', 'NBI04', 'Nairobi', 'HTHEFT', 'Corporal', 'Jaspezo', '629f72e66a6d8a8faa06ba8df7a96892', '2022-06-02 18:59:28'),
(19, 'James', 'Muchemi', '0722344554', 'NBI04', 'Nairobi', 'THEFT', 'Sergeant', 'Jamessz', '8993e16af6252894cad5d85c378443ba', '2022-06-02 18:59:28'),
(20, 'Janet', 'Wairimu', '0726541128', 'NBI04', 'Nairobi', 'HOMICIDE', 'Chief Inspector', 'Janexx', 'dd118d6795f9fbcdbee4fceb0296b5ca', '2022-06-02 18:59:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `occurrenceId` (`occurrenceId`),
  ADD KEY `stationCode` (`stationCode`),
  ADD KEY `officerId` (`officerId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occurrences`
--
ALTER TABLE `occurrences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stationCode` (`stationCode`),
  ADD KEY `officerId` (`officerId`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occurrences`
--
ALTER TABLE `occurrences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
