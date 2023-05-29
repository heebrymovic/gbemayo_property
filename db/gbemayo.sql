-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2023 at 05:34 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gbemayo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `admin_username` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  `admin_company_id` int(255) DEFAULT NULL,
  `admin_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_company_id`, `admin_created_at`) VALUES
(1, 'gbemayo', '68ebd7c687747a867a2eddde336ea81a', 1, '2023-04-24 09:05:38'),
(2, 'heditus', '6f884357a570d315402557f679e00b64', 2, '2023-04-24 09:07:00'),
(3, 'eminent', 'da63a4ac88668e9f0e76f835ccaa4486', 3, '2023-04-24 09:08:05'),
(4, 'alikad', 'e4a31d185b9c39279ae8a5778a020356', 4, '2023-04-24 09:08:54'),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2023-04-24 09:26:06'),
(6, 'info', 'caf9b6b99962bf5c2264824231d7a40c', 1, '2023-04-24 09:26:18'),
(7, 'alien', '273910799eacaacec06aba83c9d54906', 5, '2023-04-29 11:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agent_id` int(255) NOT NULL,
  `agent_privilege_id` int(255) DEFAULT NULL,
  `agent_fullname` varchar(255) DEFAULT NULL,
  `agent_email` varchar(255) DEFAULT NULL,
  `agent_password` varchar(255) DEFAULT NULL,
  `agent_phone_number` varchar(255) DEFAULT NULL,
  `agent_address` varchar(255) DEFAULT NULL,
  `agent_profile_photo` varchar(255) DEFAULT NULL,
  `agent_bank_name` varchar(255) DEFAULT NULL,
  `agent_account_name` varchar(255) DEFAULT NULL,
  `agent_account_number` varchar(255) DEFAULT NULL,
  `agent_business_id` varchar(255) DEFAULT NULL,
  `agent_referral_id` varchar(255) DEFAULT NULL,
  `agent_referred_by_id` varchar(255) DEFAULT NULL,
  `agent_referral_type` enum('realtor','business') DEFAULT NULL,
  `agent_event_id` varchar(255) DEFAULT NULL,
  `agent_payment_status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `agent_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agent_id`, `agent_privilege_id`, `agent_fullname`, `agent_email`, `agent_password`, `agent_phone_number`, `agent_address`, `agent_profile_photo`, `agent_bank_name`, `agent_account_name`, `agent_account_number`, `agent_business_id`, `agent_referral_id`, `agent_referred_by_id`, `agent_referral_type`, `agent_event_id`, `agent_payment_status`, `agent_created_on`) VALUES
(16, 3, 'Adebayo Ibrahim', 'heebrymovic01@gmail.com', 'd386b39e9f0d09797a94a4c77412d92f', '08070734501', 'Oyo State Ibadan Nigeria', 'photos/645cad446ec13IMG_4950.JPG', NULL, NULL, NULL, '1', '17LS6d1l54G', '', 'business', 'I68WYbi', 'inactive', '2023-05-11 09:54:51'),
(17, 4, 'Funsho ismail', 'funsho@gmail.com', '870ab7ec3a025925602d425ac2ea57d4', '0801234567', 'Abuja Nigeria', 'photos/645d3310af520walpaper.png', NULL, NULL, NULL, '1', '92EQkwjKz21', '', 'business', 'Ls53lc3', 'inactive', '2023-05-11 19:25:20'),
(18, 3, 'Olu maintain', 'olumaintain@gmail.com', '39c261c1bc708cdbef32ac9b2254f2c7', '080123456', 'Sango Ibadan', 'photos/645d3945eb4d8startup-names-list.jpg', NULL, NULL, NULL, '1', 'yL0evQ1do1l', '', 'business', 'WBYUu5n', 'active', '2023-05-11 19:52:08'),
(19, 3, 'adewale johnson', 'johnson@gmail.com', '79ab945544e5bc017a2317b6146ed3aa', '080923456781', 'Oyo Ibadan', 'photos/645e13c1914acIMG_4950.JPG', NULL, NULL, NULL, '1', 'SoUkp8bl6vR', '', 'business', '7Me8SVH', 'active', '2023-05-12 11:28:14'),
(20, 3, 'heebrymovic', 'heebrymovic@gmail.com', 'd386b39e9f0d09797a94a4c77412d92f', '08072345678', 'Bodija', 'photos/645e43db616d0Screenshot from 2023-05-08 12-46-46.png', NULL, NULL, NULL, '1', '9U3hIKd6Wtu', '', 'business', '6syYrAg', 'active', '2023-05-12 14:49:52'),
(21, 4, 'aa', 'aa@gmail.com', '4124bc0a9335c27f086f24ba207a4912', '1234576', 'Sango', 'photos/645e449298183Screenshot from 2023-05-03 23-36-38.png', NULL, NULL, NULL, '3', 'wezI7235xkt', '', 'realtor', 'q7Q0ReW', 'inactive', '2023-05-12 14:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clients_id` int(255) NOT NULL,
  `clients_property_balance` varchar(255) DEFAULT '0',
  `clients_title` varchar(255) DEFAULT NULL,
  `clients_fullname` varchar(255) DEFAULT NULL,
  `clients_email` varchar(255) DEFAULT NULL,
  `clients_photo` varchar(255) DEFAULT NULL,
  `clients_phone_number` varchar(255) DEFAULT NULL,
  `clients_address` varchar(255) DEFAULT NULL,
  `clients_occupation` varchar(255) DEFAULT NULL,
  `clients_dob` varchar(255) DEFAULT NULL,
  `clients_valid_id` varchar(255) DEFAULT NULL,
  `clients_agent_id` varchar(255) DEFAULT NULL,
  `clients_business_id` varchar(255) DEFAULT NULL,
  `clients_password` varchar(255) DEFAULT NULL,
  `client_profile_update_count` varchar(255) NOT NULL DEFAULT '0',
  `clients_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clients_id`, `clients_property_balance`, `clients_title`, `clients_fullname`, `clients_email`, `clients_photo`, `clients_phone_number`, `clients_address`, `clients_occupation`, `clients_dob`, `clients_valid_id`, `clients_agent_id`, `clients_business_id`, `clients_password`, `client_profile_update_count`, `clients_created_on`) VALUES
(1, '0', 'Mrs', 'Alimi Rukayat', 'alimirukayat@gmail.com', 'photos/646e383f3f812e8657bd655aaee808693767d76a2145b.jpeg', '08012131415', 'Abuja Nigeria', NULL, NULL, NULL, '', '1', 'd6e98dbe2ecf9c91dada12cc68687a4a', '0', '2023-05-24 17:15:59'),
(2, '0', 'Mister', 'Peter Paul', 'peterpaul@gmail.com', 'photos/646e3871db05281bb081f815f15d8122ebd90bd11fa08.jpeg', '08012345678', 'Bodija Oyo State Nigeria', NULL, NULL, NULL, '', '1', 'c1a068ae48daa52a998f9854a506ca91', '0', '2023-05-24 17:16:49'),
(3, '0', 'Dr', 'Bamigboye Joel', 'bamigboyejoel@gmail.com', 'photos/646e3a085fe70710b42cc0a4d10728f74317fc6dbacfd.jpeg', '090876544131', 'Ilorin Kwara State Nigeria', 'Doctor', '1980-05-25', 'valid_id/646e3a085fe74710b42cc0a4d10728f74317fc6dbacfd.jpeg', '', '3', '8878a174f3c961eab4f36d74fe7749ef', '8', '2023-05-24 17:17:52'),
(4, '0', 'Mister', 'Muhammed Yusuff', 'muhammedyusuff@gmaill.com', 'photos/6470ec403849263660748d00f2startup-names-list.jpg', '08011223344', 'Lagos State Gbagada Nigeria', 'Banker', '1990-10-10', 'valid_id/6470ec40384966366071e4ebec0_vW_r_kIY9Xu7fNFw.jpeg', '20', '1', '86dabde94f0d92ff1f2751495fb4f33a', '1', '2023-05-26 03:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `client_next_of_kin`
--

CREATE TABLE `client_next_of_kin` (
  `client_next_of_kin_id` int(255) NOT NULL,
  `client_id` int(255) DEFAULT NULL,
  `client_next_of_kin_fullname` varchar(255) DEFAULT NULL,
  `client_next_of_kin_email` varchar(255) DEFAULT NULL,
  `client_next_of_kin_occupation` varchar(255) DEFAULT NULL,
  `client_next_of_kin_address` varchar(255) DEFAULT NULL,
  `client_next_of_kin_relationship` varchar(255) DEFAULT NULL,
  `client_next_of_kin_number` varchar(255) DEFAULT NULL,
  `client_next_of_kin_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_next_of_kin`
--

INSERT INTO `client_next_of_kin` (`client_next_of_kin_id`, `client_id`, `client_next_of_kin_fullname`, `client_next_of_kin_email`, `client_next_of_kin_occupation`, `client_next_of_kin_address`, `client_next_of_kin_relationship`, `client_next_of_kin_number`, `client_next_of_kin_created_on`) VALUES
(1, 3, 'Chief Ayinde Balogun', 'ayindebalogun01@gmail.com', 'Lawyer', 'Bodija Oyo State Nigeria', 'Brother', '08012343213', '2023-05-24 18:13:34'),
(2, 4, 'Alade Baliqees', 'aladebaleqees@gmail.com', 'Business Woman', 'Sango Oja Ibadan Oyo State', 'Inlaw', '080999122344', '2023-05-26 18:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `commission_id` int(255) NOT NULL,
  `commission_property_id` varchar(255) DEFAULT NULL,
  `commission_business_id` int(255) DEFAULT NULL,
  `commission_business` int(255) NOT NULL DEFAULT 0,
  `commission_realtors` int(255) NOT NULL DEFAULT 0,
  `commission_marketers` int(255) DEFAULT 0,
  `commission_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`commission_id`, `commission_property_id`, `commission_business_id`, `commission_business`, `commission_realtors`, `commission_marketers`, `commission_created_on`) VALUES
(3, '5', 1, 28, 16, 10, '2023-04-30 05:03:54'),
(4, '6', 1, 20, 14, 7, '2023-04-30 05:12:20'),
(7, '6', 2, 0, 8, 5, '2023-04-30 09:06:08'),
(8, '6', 3, 0, 10, 5, '2023-04-30 09:20:59'),
(9, '5', 3, 0, 10, 7, '2023-04-30 09:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_photo` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_phone_number` varchar(255) DEFAULT NULL,
  `company_account_name` varchar(255) DEFAULT NULL,
  `company_account_number` varchar(255) DEFAULT NULL,
  `company_bank_name` varchar(255) DEFAULT NULL,
  `company_referral_id` varchar(255) DEFAULT NULL,
  `company_event_id` varchar(255) DEFAULT NULL,
  `company_privilege_id` int(255) DEFAULT NULL,
  `company_subscription_status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `company_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_email`, `company_photo`, `company_address`, `company_phone_number`, `company_account_name`, `company_account_number`, `company_bank_name`, `company_referral_id`, `company_event_id`, `company_privilege_id`, `company_subscription_status`, `company_created_at`) VALUES
(1, 'Gbemayo Properties', 'gbemayo@gmail.com', 'photos/64466bc8aff9cmasonry-8.jpg', 'U16 Joke Plaza Bodija Oyo State', '08012345679', 'Gbemayo Inv. Properties', '0012345678', 'Union Bank ', 'HCFqEA60k29', '12kja3j', 1, 'active', '2023-04-24 09:05:37'),
(2, 'Heditus Inv. Limited', 'heditus@gmail.com', 'photos/6446a5d6844bcmasonry-5.jpg', 'New Bodija Oyo State Ibadan', '08070734501', 'Heditus Properties', '0708912345', 'Access Bank', 'D2F7i853xJP', 'fjhh121', 2, 'inactive', '2023-04-24 09:07:00'),
(3, 'Eminent Properties', 'eminent@gmail.com', 'photos/644667bf695a4cover1.png', 'Moore Plantation Oyo State Ibadan', '080123456781', 'Eminent Agro Limited', '890038438959', 'First Bank', 'tIWhmN252z0', 'jfj3e2b', 2, 'inactive', '2023-04-24 09:08:05'),
(4, 'Alikad Properties', 'alikad@gmail.com', NULL, 'Sango Oyo State Ibadan', NULL, NULL, NULL, NULL, 'Y808Bdl078n', 'ahg458e', 2, 'inactive', '2023-04-24 09:08:53'),
(5, 'Alien Property', 'alien@gmail.com', NULL, 'Agbowo Ibadan', NULL, NULL, NULL, NULL, 'O2lw8KXo1eq', '0Bc8pg6', 2, 'inactive', '2023-04-29 11:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `events_id` int(255) NOT NULL,
  `events_title` varchar(255) DEFAULT NULL,
  `events_desc` varchar(1500) DEFAULT NULL,
  `events_venue` varchar(255) DEFAULT NULL,
  `events_date` varchar(255) DEFAULT NULL,
  `events_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `events_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`events_id`, `events_title`, `events_desc`, `events_venue`, `events_date`, `events_status`, `events_created_on`) VALUES
(1, 'Introduction to real estate', 'All you need to know about real estate', 'ventura ibdan', '2023-05-19', 'active', '2023-05-12 15:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `event_invite`
--

CREATE TABLE `event_invite` (
  `event_invite_id` int(255) NOT NULL,
  `event_id` int(255) DEFAULT NULL,
  `event_client_id` int(255) DEFAULT NULL,
  `event_invite_agent_id` varchar(255) DEFAULT NULL,
  `event_invite_business_id` varchar(255) DEFAULT NULL,
  `event_invite_status` enum('will attend','not sure','not attending') DEFAULT NULL,
  `event_invite_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_invite`
--

INSERT INTO `event_invite` (`event_invite_id`, `event_id`, `event_client_id`, `event_invite_agent_id`, `event_invite_business_id`, `event_invite_status`, `event_invite_created_on`) VALUES
(1, 1, 3, '', '2', 'will attend', '2023-05-25 15:02:46'),
(2, 1, 4, '20', '1', 'will attend', '2023-05-26 04:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `installmental_tb`
--

CREATE TABLE `installmental_tb` (
  `installmental_id` int(255) NOT NULL,
  `installmental_property_id` varchar(255) DEFAULT NULL,
  `installmental_property_duration` varchar(255) DEFAULT NULL,
  `installmental_property_amount` int(255) DEFAULT NULL,
  `installmental_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `installmental_tb`
--

INSERT INTO `installmental_tb` (`installmental_id`, `installmental_property_id`, `installmental_property_duration`, `installmental_property_amount`, `installmental_created_on`) VALUES
(5, '5', '12 months', 50000000, '2023-04-30 05:03:54'),
(6, '5', '6 months', 48000000, '2023-04-30 05:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(255) NOT NULL,
  `media_title` varchar(255) DEFAULT NULL,
  `media_description` varchar(5000) DEFAULT NULL,
  `media_link` varchar(255) DEFAULT NULL,
  `media_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `media_title`, `media_description`, `media_link`, `media_created_on`) VALUES
(1, 'Media One', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'https://youtu.be/AzwC6umvd1s', '2023-04-24 19:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `privileges_id` int(255) NOT NULL,
  `privileges_name` varchar(255) DEFAULT NULL,
  `privileges_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`privileges_id`, `privileges_name`, `privileges_created_at`) VALUES
(1, 'superadmin', '2023-04-19 15:26:13'),
(2, 'business', '2023-04-19 15:26:13'),
(3, 'realtor', '2023-04-19 15:27:50'),
(4, 'marketer', '2023-04-19 15:27:50'),
(5, 'client', '2023-05-12 16:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(255) NOT NULL,
  `property_uniq_id` varchar(255) DEFAULT NULL,
  `property_type` int(255) DEFAULT NULL,
  `property_name` varchar(255) DEFAULT NULL,
  `property_location` varchar(255) DEFAULT NULL,
  `property_address` varchar(255) DEFAULT NULL,
  `property_file` varchar(5000) DEFAULT NULL,
  `property_desc` varchar(2555) DEFAULT NULL,
  `property_price` varchar(255) DEFAULT NULL,
  `property_sq_fit` varchar(255) DEFAULT NULL,
  `property_year` varchar(255) DEFAULT NULL,
  `property_features` varchar(5000) DEFAULT NULL,
  `property_bedroom` varchar(255) DEFAULT NULL,
  `property_status` enum('active','sold') NOT NULL DEFAULT 'active',
  `property_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `property_uniq_id`, `property_type`, `property_name`, `property_location`, `property_address`, `property_file`, `property_desc`, `property_price`, `property_sq_fit`, `property_year`, `property_features`, `property_bedroom`, `property_status`, `property_created_on`) VALUES
(5, '2fwRFg0lhx40W20', 2, 'Megamound homes', 'Lagos', 'Megamound homes and property ikeja Lagos state Nigeria', '[\"properties/2fwRFg0lhx40W20/644de8aa8e42502.jpg\",\"properties/2fwRFg0lhx40W20/644de8aa8e46a03.jpg\",\"properties/2fwRFg0lhx40W20/644de8aa8e47b04.jpg\"]', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '45000000', '346ft by 400ft ', '2018', '[\"Swimming pool\",\"Terrace\",\"Air conditioning\",\"Internet\",\"Balcony\",\"Computer\",\"Dishwasher\",\"Car Parking\"]', '8', 'sold', '2023-04-30 05:03:54'),
(6, 'p0q3U3ZoN9c1wOB', 1, 'Land One', 'Ibadan', 'Alabata Moniya Ibadan Oyo State, Nigeria.', '[\"properties/p0q3U3ZoN9c1wOB/644deaa43486801.jpg\"]', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '300000', '120ft by 60ft', '', '', '', 'sold', '2023-04-30 05:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `property_buy`
--

CREATE TABLE `property_buy` (
  `property_buy_id` int(255) NOT NULL,
  `property_buy_agent_id` varchar(255) DEFAULT NULL,
  `property_buy_client_id` int(255) DEFAULT NULL,
  `property_id` int(255) DEFAULT NULL,
  `property_buy_business_id` int(255) DEFAULT NULL,
  `property_buy_unit` int(255) DEFAULT NULL,
  `property_buy_payment_structure` varchar(255) DEFAULT NULL,
  `property_buy_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_buy`
--

INSERT INTO `property_buy` (`property_buy_id`, `property_buy_agent_id`, `property_buy_client_id`, `property_id`, `property_buy_business_id`, `property_buy_unit`, `property_buy_payment_structure`, `property_buy_created_on`) VALUES
(1, '', 3, 6, 3, 1, '', '2023-05-26 16:37:20'),
(2, '20', 4, 5, 1, 1, '5', '2023-05-26 18:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `property_buy_payment`
--

CREATE TABLE `property_buy_payment` (
  `property_buy_payment_id` int(255) NOT NULL,
  `property_buy_id` int(255) DEFAULT NULL,
  `property_id` varchar(255) DEFAULT NULL,
  `client_id` int(255) DEFAULT NULL,
  `property_buy_amount_paid` varchar(255) DEFAULT NULL,
  `property_buy_payment_proof` varchar(255) DEFAULT NULL,
  `property_payment_status` enum('pending','approved','cancelled') NOT NULL DEFAULT 'pending',
  `property_buy_payment_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_buy_payment`
--

INSERT INTO `property_buy_payment` (`property_buy_payment_id`, `property_buy_id`, `property_id`, `client_id`, `property_buy_amount_paid`, `property_buy_payment_proof`, `property_payment_status`, `property_buy_payment_created_on`) VALUES
(1, 1, '6', 3, '300000', 'proof/6470d230295c66341fb95926631.PNG', 'approved', '2023-05-26 16:37:20'),
(3, 2, '5', 4, '12000000', 'proof/6470ecd78539062f01fac194ca3688830_1dae_3.jpg', 'approved', '2023-05-26 18:31:03'),
(4, 2, '5', 4, '11000000', 'proof/647340999337a6338cf1441183Capture2-new.jpg', 'pending', '2023-05-28 12:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

CREATE TABLE `property_type` (
  `property_type_id` int(255) NOT NULL,
  `property_type_name` varchar(255) DEFAULT NULL,
  `property_type_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`property_type_id`, `property_type_name`, `property_type_created_on`) VALUES
(1, 'land', '2023-04-27 11:18:43'),
(2, 'house', '2023-04-27 11:18:43'),
(3, 'investment', '2023-04-27 11:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `reg_fee`
--

CREATE TABLE `reg_fee` (
  `reg_fee_id` int(255) NOT NULL,
  `reg_fee_privilege_id` varchar(255) DEFAULT NULL,
  `reg_fee_price` varchar(255) DEFAULT NULL,
  `reg_fee_duration` varchar(255) DEFAULT NULL,
  `reg_fee_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reg_fee`
--

INSERT INTO `reg_fee` (`reg_fee_id`, `reg_fee_privilege_id`, `reg_fee_price`, `reg_fee_duration`, `reg_fee_created_at`) VALUES
(1, '2', '20000', '11', '2023-05-11 21:42:00'),
(2, '3', '10000', '9', '2023-05-11 21:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(255) NOT NULL,
  `subscription_agent_id` varchar(255) DEFAULT NULL,
  `subscription_business_id` varchar(255) DEFAULT NULL,
  `subscription_start` varchar(255) DEFAULT NULL,
  `subscription_ends` varchar(255) DEFAULT NULL,
  `subscription_status` enum('active','expired') NOT NULL DEFAULT 'active',
  `subscription_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `subscription_agent_id`, `subscription_business_id`, `subscription_start`, `subscription_ends`, `subscription_status`, `subscription_created_on`) VALUES
(1, '16', '1', '2023-05-11', '2024-05-11', 'active', '2023-05-11 09:54:51'),
(2, '18', '1', '2023-05-11', '2024-05-11', 'active', '2023-05-11 19:52:09'),
(3, '19', '1', '2023-05-12', '2024-02-12', 'active', '2023-05-12 11:28:15'),
(4, '20', '1', '2023-05-12', '2024-02-12', 'active', '2023-05-12 14:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `txn_id` int(255) NOT NULL,
  `txn_agent_id` varchar(255) DEFAULT NULL,
  `txn_business_id` varchar(255) DEFAULT NULL,
  `txn_ref` varchar(255) DEFAULT NULL,
  `txn_payment_id` varchar(255) DEFAULT NULL,
  `txn_amount` varchar(255) DEFAULT NULL,
  `txn_status` enum('pending','success') DEFAULT NULL,
  `txn_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`txn_id`, `txn_agent_id`, `txn_business_id`, `txn_ref`, `txn_payment_id`, `txn_amount`, `txn_status`, `txn_created_on`) VALUES
(1, '16', '1', 'gb_830270037', '2794921686', '5000', 'success', '2023-05-11 09:54:51'),
(2, '18', '1', 'gb_64532798', '2795988714', '5000', 'success', '2023-05-11 19:52:09'),
(3, '19', '1', 'gb_941507643', '2797353777', '12000', 'success', '2023-05-12 11:28:14'),
(4, '20', '1', 'gb_228561625', '2797931335', '10000', 'success', '2023-05-12 14:49:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clients_id`);

--
-- Indexes for table `client_next_of_kin`
--
ALTER TABLE `client_next_of_kin`
  ADD PRIMARY KEY (`client_next_of_kin_id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`commission_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`events_id`);

--
-- Indexes for table `event_invite`
--
ALTER TABLE `event_invite`
  ADD PRIMARY KEY (`event_invite_id`);

--
-- Indexes for table `installmental_tb`
--
ALTER TABLE `installmental_tb`
  ADD PRIMARY KEY (`installmental_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`privileges_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `property_buy`
--
ALTER TABLE `property_buy`
  ADD PRIMARY KEY (`property_buy_id`);

--
-- Indexes for table `property_buy_payment`
--
ALTER TABLE `property_buy_payment`
  ADD PRIMARY KEY (`property_buy_payment_id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`property_type_id`);

--
-- Indexes for table `reg_fee`
--
ALTER TABLE `reg_fee`
  ADD PRIMARY KEY (`reg_fee_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`txn_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `agent_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clients_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_next_of_kin`
--
ALTER TABLE `client_next_of_kin`
  MODIFY `client_next_of_kin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `commission_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `events_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_invite`
--
ALTER TABLE `event_invite`
  MODIFY `event_invite_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `installmental_tb`
--
ALTER TABLE `installmental_tb`
  MODIFY `installmental_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `privileges_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `property_buy`
--
ALTER TABLE `property_buy`
  MODIFY `property_buy_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_buy_payment`
--
ALTER TABLE `property_buy_payment`
  MODIFY `property_buy_payment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `property_type_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reg_fee`
--
ALTER TABLE `reg_fee`
  MODIFY `reg_fee_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `txn_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
