-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 01:38 PM
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
-- Database: `farmersfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_firstname` varchar(30) NOT NULL,
  `admin_lastname` varchar(30) NOT NULL,
  `admin_phone` varchar(20) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  `admin_image` varchar(200) NOT NULL,
  `admin_last_signed_in` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_firstname`, `admin_lastname`, `admin_phone`, `admin_email`, `admin_password`, `admin_image`, `admin_last_signed_in`) VALUES
(1, '', '', '0', 'admin@gmail.com', '$2y$10$pUZ6jv8AXRyqm0zvTLE.FOhQhl.hW37EvVSDyk9Nesrxg58pHA7lm\n$2y$10$pUZ6jv8AXRyqm0zvTLE.FOhQhl.hW37EvVSDyk9Nesrxg58pHA7lm\n', '', '2024-05-05 18:53:52'),
(2, 'zion', 'Owolabi', '07067675432', 'superadmin@gmail.com', '$2y$10$pUZ6jv8AXRyqm0zvTLE.FOhQhl.hW37EvVSDyk9Nesrxg58pHA7lm', '17173246831158220054.png', '2024-05-06 10:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` enum('Product','Produce','Livestock') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Product'),
(2, 'Produce'),
(3, 'Livestock');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_firstname` varchar(30) NOT NULL,
  `customer_lastname` varchar(30) NOT NULL,
  `customer_phone` varchar(30) DEFAULT NULL,
  `customer_email` varchar(45) NOT NULL,
  `customer_dob` date DEFAULT NULL,
  `customer_password` varchar(200) NOT NULL,
  `customer_gender` enum('Male','Female') DEFAULT NULL,
  `customer_address` varchar(200) NOT NULL,
  `customer_profilep` varchar(200) NOT NULL,
  `state_id` int(11) NOT NULL,
  `lga_id` int(11) NOT NULL,
  `usercat_id` int(11) NOT NULL,
  `customer_registration_date` datetime DEFAULT current_timestamp(),
  `customerrole` enum('customer') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_firstname`, `customer_lastname`, `customer_phone`, `customer_email`, `customer_dob`, `customer_password`, `customer_gender`, `customer_address`, `customer_profilep`, `state_id`, `lga_id`, `usercat_id`, `customer_registration_date`, `customerrole`) VALUES
(1, 'Tvocals', 'Kenny', NULL, 'tvocals@gmail.com', NULL, '$2y$10$cIRmM2qj7eRQdJDnWRCXre7SVptdvfhbgJ.B93jFV8bessvED3H62', NULL, '', '', 0, 0, 3, '2024-06-04 10:10:29', 'customer'),
(2, 'Rolly', 'Adams', NULL, 'rolly@gmail.com', NULL, '$2y$10$9s/Q5u63xl1ClWcI7I/iPu.CC6aKAVezhTZObbcuSlvrIbyjn01QO', NULL, '', '', 0, 0, 3, '2024-06-05 16:49:04', 'customer'),
(3, 'Mich', 'miko', NULL, 'mich@gmail.com', NULL, '$2y$10$6o3xWWn7vWM7uOXqbT7ZWuIS7fGl4KHDRBMfKP3EWVM68YKZ1W1si', NULL, '', '', 0, 0, 3, '2024-06-05 17:07:55', 'customer'),
(4, 'Sule', 'Sule', '07066667676', 'sule@gmail.com', '2024-06-01', '$2y$10$XerXPAzaiWPNQ6cSSpDqsODZBKhHygGzdrju/KN9E7Trb3YteCrYy', 'Male', 'No 13 Ikeja Alausa Lagos', '1717673741426722210.png', 0, 0, 3, '2024-06-06 11:29:54', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `farmer_id` int(11) NOT NULL,
  `farmer_firstname` varchar(30) NOT NULL,
  `farmer_lastname` varchar(30) NOT NULL,
  `farmer_email` varchar(100) NOT NULL,
  `farmer_password` varchar(200) NOT NULL,
  `farmer_dob` date DEFAULT NULL,
  `farmer_gender` enum('Male','Female') DEFAULT NULL,
  `farmer_phone` varchar(15) DEFAULT NULL,
  `state_id` varchar(45) DEFAULT NULL,
  `lga_id` varchar(45) DEFAULT NULL,
  `farmer_bankname` varchar(45) DEFAULT NULL,
  `farmer_accountno` int(11) DEFAULT NULL,
  `farmer_bvn` int(11) DEFAULT NULL,
  `farmer_address` varchar(200) DEFAULT NULL,
  `farmer_farmsize` int(11) DEFAULT NULL,
  `farmer_profilep` varchar(200) NOT NULL,
  `farmer_cac` varchar(200) NOT NULL,
  `farmer_min` varchar(200) DEFAULT NULL,
  `usercat_id` int(11) NOT NULL,
  `farmer_regdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`farmer_id`, `farmer_firstname`, `farmer_lastname`, `farmer_email`, `farmer_password`, `farmer_dob`, `farmer_gender`, `farmer_phone`, `state_id`, `lga_id`, `farmer_bankname`, `farmer_accountno`, `farmer_bvn`, `farmer_address`, `farmer_farmsize`, `farmer_profilep`, `farmer_cac`, `farmer_min`, `usercat_id`, `farmer_regdate`) VALUES
(3, 'owo', 'zion', 'z@gmail.com', '$2y$10$mmTDACF3XGehJv4GWdF0xOa38delP/y9wffSb0TrtYexOECcmsXXi', '2012-04-11', 'Male', '0909999999', '25', '523', 'UBA', 2147483647, 2147483647, 'San Francisco Street New York', 5, '17173234861119912494.JPG', '1717323487243656991.png', '17173234871998593131.png', 1, '2024-06-01 16:26:11'),
(4, 'Kenny', 'Black', 'kn@gmail.com', '$2y$10$aU6.965KUNPgdj4iu0XOw.sR8Q.k8ATTx7GoRx1t2GDGnGiCz39xi', '2023-07-06', 'Male', '07067509905', '29', '605', 'Zenith', 1010101011, 2147483647, '12, Ikota First Gate Ajah, Lekki, Lagos.', 2, '171732078438799108.png', '17173207841491964141.png', '1717320784156639470.png', 1, '2024-06-02 08:46:28'),
(5, 'Taye', 'Taiwo', 't@gmail.com', '$2y$10$/cOWRRPKylEzJrJWus./MuDfWRdAfAA3XB7xC7NWZeAfNu18HlRFe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 1, '2024-06-02 12:56:52'),
(6, 'Mercy', 'Ajanlekoko', 'm@gmail.com', '$2y$10$IC4KOtuLIsP/WgaqC5HsC.HFJyJBAjHyczaYmxd161rd56mEuANcq', '1997-12-12', 'Female', '07067502222', '19', '365', 'GT', 2147483647, 2147483647, 'Elebiju Ketu Mile 12', 7, '1717335173713399171.png', '171733517380948398.png', '17173351731308087077.png', 1, '2024-06-02 14:29:16'),
(7, 'Mercy', 'Johnson', 'mj@gmail.com', '$2y$10$Rz53h9d0cHCKunsuc1aibeUks2K3l7ScKwsRirVe8jJ.1u2KzFEXG', '2020-08-04', 'Female', '07067500000', '22', '482', 'GT', 2020202020, 2147483647, 'Elebiju Ketu Mile 12', 2, '171753388227035155.png', '17175338821479757496.png', '1717533882767537253.png', 1, '2024-06-04 21:41:30'),
(8, 'Niger', 'John', 'r@gmail.com', '$2y$10$fEkv8mw7t69eSNodVXSRdeaRXpg2A.tCyOoU3DZ75iWR2OGpl3Ihq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 1, '2024-06-05 15:54:31'),
(9, 'Niger', 'John', 'nowolabi@gmail.com', '$2y$10$Wt//4TVVtwqQG0UGFKDjHusUHuimSm9oFo9dxwwST40sgtsBf24oa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 1, '2024-06-05 18:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `government`
--

CREATE TABLE `government` (
  `government_id` int(11) NOT NULL,
  `government_firstname` varchar(30) NOT NULL,
  `government_lastname` varchar(30) NOT NULL,
  `government_email` varchar(45) NOT NULL,
  `government_password` varchar(200) NOT NULL,
  `government_profilep` varchar(200) NOT NULL,
  `state_id` int(11) NOT NULL,
  `lga_id` int(11) NOT NULL,
  `usercat_id` int(11) NOT NULL,
  `government_registrationdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `government`
--

INSERT INTO `government` (`government_id`, `government_firstname`, `government_lastname`, `government_email`, `government_password`, `government_profilep`, `state_id`, `lga_id`, `usercat_id`, `government_registrationdate`) VALUES
(1, 'Niger', 'State', 'ng@gmail.com', '$2y$10$HSDdUE6fMjLHad/xmyY.NOv2NJUAx8PVyDT3BBiyDYHGO.E9tHyL.', '17173256071003450575.jpg', 26, 541, 4, '2024-06-01 16:59:14'),
(3, 'Lagos ', 'State', 'lg@gmail.com', '$2y$10$Kb41JOnIr.psbrFRSDjjluUY1LAq57e6cYM40tx0WUXjEQFNhEXS.', '1717325799841723373.jpg', 24, 510, 4, '2024-06-02 11:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `lga`
--

CREATE TABLE `lga` (
  `lga_id` int(11) NOT NULL,
  `lga_name` varchar(60) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lga`
--

INSERT INTO `lga` (`lga_id`, `lga_name`, `state_id`) VALUES
(1, 'Aba North', 1),
(2, 'Aba South', 1),
(3, 'Arochukwu', 1),
(4, 'Bende', 1),
(5, 'Ikwuano', 1),
(6, 'Isiala-Ngwa North', 1),
(7, 'Isiala-Ngwa South', 1),
(8, 'Isikwuato', 1),
(9, 'Nneochi', 1),
(10, 'Obi-Ngwa', 1),
(11, 'Ohafia', 1),
(12, 'Osisioma', 1),
(13, 'Ugwunagbo', 1),
(14, 'Ukwa East', 1),
(15, 'Ukwa West', 1),
(16, 'Umuahia North', 1),
(17, 'Umuahia South', 1),
(18, 'Demsa', 2),
(19, 'Fufore', 2),
(20, 'Genye', 2),
(21, 'Girei', 2),
(22, 'Gombi', 2),
(23, 'guyuk', 2),
(24, 'Hong', 2),
(25, 'Jada', 2),
(26, 'Jimeta', 2),
(27, 'Lamurde', 2),
(28, 'Madagali', 2),
(29, 'Maiha', 2),
(30, 'Mayo Belwa', 2),
(31, 'Michika', 2),
(32, 'Mubi North', 2),
(33, 'Mubi South', 2),
(34, 'Numan', 2),
(35, 'Shelleng', 2),
(36, 'Song', 2),
(37, 'Toungo', 2),
(38, 'Yola', 2),
(39, 'Abak', 3),
(40, 'Eastern-Obolo', 3),
(41, 'Eket', 3),
(42, 'Ekpe-Atani', 3),
(43, 'Essien-Udim', 3),
(44, 'Esit Ekit', 3),
(45, 'Etim-Ekpo', 3),
(46, 'Etinam', 3),
(47, 'Ibeno', 3),
(48, 'Ibesikp-Asitan', 3),
(49, 'Ibiono-Ibom', 3),
(50, 'Ika', 3),
(51, 'Ikono', 3),
(52, 'Ikot-Abasi', 3),
(53, 'Ikot-Ekpene', 3),
(54, 'Ini', 3),
(55, 'Itu', 3),
(56, 'Mbo', 3),
(57, 'Mkpae-Enin', 3),
(58, 'Nsit-Ibom', 3),
(59, 'Nsit-Ubium', 3),
(60, 'Obot-Akara', 3),
(61, 'Okobo', 3),
(62, 'Onna', 3),
(63, 'Oron', 3),
(64, 'Oro-Anam', 3),
(65, 'Udung-Uko', 3),
(66, 'Ukanefun', 3),
(67, 'Uru Offong Oruko', 3),
(68, 'Uruan', 3),
(69, 'Uquo Ibene', 3),
(70, 'Uyo', 3),
(71, 'Aguata', 4),
(72, 'Anambra', 4),
(73, 'Anambra West', 4),
(74, 'Anocha', 4),
(75, 'Awka- North', 4),
(76, 'Awka-South', 4),
(77, 'Ayamelum', 4),
(78, 'Dunukofia', 4),
(79, 'Ekwusigo', 4),
(80, 'Idemili-North', 4),
(81, 'Idemili-South', 4),
(82, 'Ihiala', 4),
(83, 'Njikoka', 4),
(84, 'Nnewi-North', 4),
(85, 'Nnewi-South', 4),
(86, 'Ogbaru', 4),
(87, 'Onisha North', 4),
(88, 'Onitsha South', 4),
(89, 'Orumba North', 4),
(90, 'Orumba South', 4),
(91, 'Oyi', 4),
(92, 'Alkaleri', 5),
(93, 'Bauchi', 5),
(94, 'Bogoro', 5),
(95, 'Damban', 5),
(96, 'Darazo', 5),
(97, 'Dass', 5),
(98, 'Gamawa', 5),
(99, 'Ganjuwa', 5),
(100, 'Giade', 5),
(101, 'Itas/Gadau', 5),
(102, 'Jama\'are', 5),
(103, 'Katagum', 5),
(104, 'Kirfi', 5),
(105, 'Misau', 5),
(106, 'Ningi', 5),
(107, 'Shira', 5),
(108, 'Tafawa-Balewa', 5),
(109, 'Toro', 5),
(110, 'Warji', 5),
(111, 'Zaki', 5),
(112, 'Brass', 6),
(113, 'Ekerernor', 6),
(114, 'Kolokuma/Opokuma', 6),
(115, 'Nembe', 6),
(116, 'Ogbia', 6),
(117, 'Sagbama', 6),
(118, 'Southern-Ijaw', 6),
(119, 'Yenegoa', 6),
(120, 'Kembe', 6),
(121, 'Ado', 7),
(122, 'Agatu', 7),
(123, 'Apa', 7),
(124, 'Buruku', 7),
(125, 'Gboko', 7),
(126, 'Guma', 7),
(127, 'Gwer-East', 7),
(128, 'Gwer-West', 7),
(129, 'Katsina-Ala', 7),
(130, 'Konshisha', 7),
(131, 'Kwande', 7),
(132, 'Logo', 7),
(133, 'Makurdi', 7),
(134, 'Obi', 7),
(135, 'Ogbadibo', 7),
(136, 'Ohimini', 7),
(137, 'Oju', 7),
(138, 'Okpokwu', 7),
(139, 'Otukpo', 7),
(140, 'Tarkar', 7),
(141, 'Vandeikya', 7),
(142, 'Ukum', 7),
(143, 'Ushongo', 7),
(144, 'Abadan', 8),
(145, 'Askira-Uba', 8),
(146, 'Bama', 8),
(147, 'Bayo', 8),
(148, 'Biu', 8),
(149, 'Chibok', 8),
(150, 'Damboa', 8),
(151, 'Dikwa', 8),
(152, 'Gubio', 8),
(153, 'Guzamala', 8),
(154, 'Gwoza', 8),
(155, 'Hawul', 8),
(156, 'Jere', 8),
(157, 'Kaga', 8),
(158, 'Kala/Balge', 8),
(159, 'Kukawa', 8),
(160, 'Konduga', 8),
(161, 'Kwaya-Kusar', 8),
(162, 'Mafa', 8),
(163, 'Magumeri', 8),
(164, 'Maiduguri', 8),
(165, 'Marte', 8),
(166, 'Mobbar', 8),
(167, 'Monguno', 8),
(168, 'Ngala', 8),
(169, 'Nganzai', 8),
(170, 'Shani', 8),
(171, 'Abi', 9),
(172, 'Akamkpa', 9),
(173, 'Akpabuyo', 9),
(174, 'Bakassi', 9),
(175, 'Bekwara', 9),
(176, 'Biasi', 9),
(177, 'Boki', 9),
(178, 'Calabar-Municipal', 9),
(179, 'Calabar-South', 9),
(180, 'Etunk', 9),
(181, 'Ikom', 9),
(182, 'Obantiku', 9),
(183, 'Ogoja', 9),
(184, 'Ugep North', 9),
(185, 'Yakurr', 9),
(186, 'Yala', 9),
(187, 'Aniocha North', 10),
(188, 'Aniocha South', 10),
(189, 'Bomadi', 10),
(190, 'Burutu', 10),
(191, 'Ethiope East', 10),
(192, 'Ethiope West', 10),
(193, 'Ika North East', 10),
(194, 'Ika South', 10),
(195, 'Isoko North', 10),
(196, 'Isoko South', 10),
(197, 'Ndokwa East', 10),
(198, 'Ndokwa West', 10),
(199, 'Okpe', 10),
(200, 'Oshimili North', 10),
(201, 'Oshimili South', 10),
(202, 'Patani', 10),
(203, 'Sapele', 10),
(204, 'Udu', 10),
(205, 'Ughilli North', 10),
(206, 'Ughilli South', 10),
(207, 'Ukwuani', 10),
(208, 'Uvwie', 10),
(209, 'Warri Central', 10),
(210, 'Warri North', 10),
(211, 'Warri South', 10),
(212, 'Abakaliki', 11),
(213, 'Ofikpo North', 11),
(214, 'Ofikpo South', 11),
(215, 'Ebonyi', 11),
(216, 'Ezza North', 11),
(217, 'Ezza South', 11),
(218, 'ikwo', 11),
(219, 'Ishielu', 11),
(220, 'Ivo', 11),
(221, 'Izzi', 11),
(222, 'Ohaukwu', 11),
(223, 'Ohaozara', 11),
(224, 'Onicha', 11),
(225, 'Akoko Edo', 12),
(226, 'Egor', 12),
(227, 'Esan Central', 12),
(228, 'Esan North East', 12),
(229, 'Esan South East', 12),
(230, 'Esan West', 12),
(231, 'Etsako-Central', 12),
(232, 'Etsako-West', 12),
(233, 'Igueben', 12),
(234, 'Ikpoba-Okha', 12),
(235, 'Oredo', 12),
(236, 'Orhionmwon', 12),
(237, 'Ovia North East', 12),
(238, 'Ovia South West', 12),
(239, 'owan east', 12),
(240, 'Owan West', 12),
(241, 'Umunniwonde', 12),
(242, 'Ado Ekiti', 13),
(243, 'Aiyedire', 13),
(244, 'Efon', 13),
(245, 'Ekiti-East', 13),
(246, 'Ekiti-South West', 13),
(247, 'Ekiti West', 13),
(248, 'Emure', 13),
(249, 'Ido Osi', 13),
(250, 'Ijero', 13),
(251, 'Ikere', 13),
(252, 'Ikole', 13),
(253, 'Ilejemeta', 13),
(254, 'Irepodun/Ifelodun', 13),
(255, 'Ise Orun', 13),
(256, 'Moba', 13),
(257, 'Oye', 13),
(258, 'Aninri', 14),
(259, 'Awgu', 14),
(260, 'Enugu East', 14),
(261, 'Enugu North', 14),
(262, 'Enugu South', 14),
(263, 'Ezeagu', 14),
(264, 'Igbo Etiti', 14),
(265, 'Igbo Eze North', 14),
(266, 'Igbo Eze South', 14),
(267, 'Isi Uzo', 14),
(268, 'Nkanu East', 14),
(269, 'Nkanu West', 14),
(270, 'Nsukka', 14),
(271, 'Oji-River', 14),
(272, 'Udenu', 14),
(273, 'Udi', 14),
(274, 'Uzo Uwani', 14),
(275, 'Akko', 15),
(276, 'Balanga', 15),
(277, 'Billiri', 15),
(278, 'Dukku', 15),
(279, 'Funakaye', 15),
(280, 'Gombe', 15),
(281, 'Kaltungo', 15),
(282, 'Kwami', 15),
(283, 'Nafada/Bajoga', 15),
(284, 'Shomgom', 15),
(285, 'Yamltu/Deba', 15),
(286, 'Ahiazu-Mbaise', 16),
(287, 'Ehime-Mbano', 16),
(288, 'Ezinihtte', 16),
(289, 'Ideato North', 16),
(290, 'Ideato South', 16),
(291, 'Ihitte/Uboma', 16),
(292, 'Ikeduru', 16),
(293, 'Isiala-Mbano', 16),
(294, 'Isu', 16),
(295, 'Mbaitoli', 16),
(296, 'Ngor-Okpala', 16),
(297, 'Njaba', 16),
(298, 'Nkwerre', 16),
(299, 'Nwangele', 16),
(300, 'obowo', 16),
(301, 'Oguta', 16),
(302, 'Ohaji-Eggema', 16),
(303, 'Okigwe', 16),
(304, 'Onuimo', 16),
(305, 'Orlu', 16),
(306, 'Orsu', 16),
(307, 'Oru East', 16),
(308, 'Oru West', 16),
(309, 'Owerri Municipal', 16),
(310, 'Owerri North', 16),
(311, 'Owerri West', 16),
(312, 'Auyu', 17),
(313, 'Babura', 17),
(314, 'Birnin Kudu', 17),
(315, 'Birniwa', 17),
(316, 'Bosuwa', 17),
(317, 'Buji', 17),
(318, 'Dutse', 17),
(319, 'Gagarawa', 17),
(320, 'Garki', 17),
(321, 'Gumel', 17),
(322, 'Guri', 17),
(323, 'Gwaram', 17),
(324, 'Gwiwa', 17),
(325, 'Hadejia', 17),
(326, 'Jahun', 17),
(327, 'Kafin Hausa', 17),
(328, 'Kaugama', 17),
(329, 'Kazaure', 17),
(330, 'Kirikasanuma', 17),
(331, 'Kiyawa', 17),
(332, 'Maigatari', 17),
(333, 'Malam Maduri', 17),
(334, 'Miga', 17),
(335, 'Ringim', 17),
(336, 'Roni', 17),
(337, 'Sule Tankarkar', 17),
(338, 'Taura', 17),
(339, 'Yankwashi', 17),
(340, 'Birnin-Gwari', 18),
(341, 'Chikun', 18),
(342, 'Giwa', 18),
(343, 'Gwagwada', 18),
(344, 'Igabi', 18),
(345, 'Ikara', 18),
(346, 'Jaba', 18),
(347, 'Jema\'a', 18),
(348, 'Kachia', 18),
(349, 'Kaduna North', 18),
(350, 'Kagarko', 18),
(351, 'Kajuru', 18),
(352, 'Kaura', 18),
(353, 'Kauru', 18),
(354, 'Koka/Kawo', 18),
(355, 'Kubah', 18),
(356, 'Kudan', 18),
(357, 'Lere', 18),
(358, 'Makarfi', 18),
(359, 'Sabon Gari', 18),
(360, 'Sanga', 18),
(361, 'Sabo', 18),
(362, 'Tudun-Wada/Makera', 18),
(363, 'Zango-Kataf', 18),
(364, 'Zaria', 18),
(365, 'Ajingi', 19),
(366, ' Albasu', 19),
(367, 'Bagwai', 19),
(368, 'Bebeji', 19),
(369, 'Bichi', 19),
(370, 'Bunkure', 19),
(371, 'Dala', 19),
(372, 'Dambatta', 19),
(373, 'Dawakin Kudu', 19),
(374, 'Dawakin Tofa', 19),
(375, 'Doguwa', 19),
(376, 'Fagge', 19),
(377, 'Gabasawa', 19),
(378, 'Garko', 19),
(379, 'Garun-Mallam', 19),
(380, 'Gaya', 19),
(381, 'Gezawa', 19),
(382, 'Gwale', 19),
(383, 'Gwarzo', 19),
(384, 'Kabo', 19),
(385, 'Kano Municipal', 19),
(386, 'Karaye', 19),
(387, 'Kibiya', 19),
(388, 'Kiru', 19),
(389, 'Kumbotso', 19),
(390, 'Kunchi', 19),
(391, 'Kura', 19),
(392, 'Madobi', 19),
(393, 'Makoda', 19),
(394, 'Minjibir', 19),
(395, 'Nasarawa', 19),
(396, 'Rano', 19),
(397, 'Rimin Gado', 19),
(398, 'Rogo', 19),
(399, 'Shanono', 19),
(400, 'Sumaila', 19),
(401, 'Takai', 19),
(402, 'Tarauni', 19),
(403, 'Tofa', 19),
(404, 'Tsanyawa', 19),
(405, 'Tudun Wada', 19),
(406, 'Ngogo', 19),
(407, 'Warawa', 19),
(408, 'Wudil', 19),
(409, 'Bakori', 20),
(410, 'Batagarawa', 20),
(411, 'Batsari', 20),
(412, 'Baure', 20),
(413, 'Bindawa', 20),
(414, 'Charanchi', 20),
(415, 'Danja', 20),
(416, 'Danjume', 20),
(417, 'Dan-Musa', 20),
(418, 'Daura', 20),
(419, 'Dutsi', 20),
(420, 'Dutsinma', 20),
(421, 'Faskari', 20),
(422, 'Funtua', 20),
(423, 'Ingara', 20),
(424, 'Jibia', 20),
(425, 'Kafur', 20),
(426, 'Kaita', 20),
(427, 'Kankara', 20),
(428, 'Kankia', 20),
(429, 'Katsina', 20),
(430, 'Kurfi', 20),
(431, 'Kusada', 20),
(432, 'Mai Adua', 20),
(433, 'Malumfashi', 20),
(434, 'Mani', 20),
(435, 'Mashi', 20),
(436, 'Matazu', 20),
(437, 'Musawa', 20),
(438, 'Rimi', 20),
(439, 'Sabuwa', 20),
(440, 'Safana', 20),
(441, 'Sandamu', 20),
(442, 'Zango', 20),
(443, 'Aleira', 21),
(444, 'Arewa', 21),
(445, 'Argungu', 21),
(446, 'Augie', 21),
(447, 'Bagudo', 21),
(448, 'Birnin-Kebbi', 21),
(449, 'Bumza', 21),
(450, 'Dandi', 21),
(451, 'Danko', 21),
(452, 'Fakai', 21),
(453, 'Gwandu', 21),
(454, 'Jega', 21),
(455, 'Kalgo', 21),
(456, 'Koko-Besse', 21),
(457, 'Maiyama', 21),
(458, 'Ngaski', 21),
(459, 'Sakaba', 21),
(460, 'Shanga', 21),
(461, 'Suru', 21),
(462, 'Wasagu', 21),
(463, 'Yauri', 21),
(464, 'Zuru', 21),
(465, 'Adavi', 22),
(466, 'Ajaokuta', 22),
(467, 'Ankpa', 22),
(468, 'Bassa', 22),
(469, 'Dekina', 22),
(470, 'Ibaji', 22),
(471, 'Idah', 22),
(472, 'Igalamela', 22),
(473, 'Ijumu', 22),
(474, 'Kabba/Bunu', 22),
(475, 'Kogi', 22),
(476, 'Lokoja', 22),
(477, 'Mopa-Muro-Mopi', 22),
(478, 'Ofu', 22),
(479, 'Ogori/Magongo', 22),
(480, 'Okehi', 22),
(481, 'Okene', 22),
(482, 'Olamaboro', 22),
(483, 'Omala', 22),
(484, 'Oyi', 22),
(485, 'Yagba-East', 22),
(486, 'Yagba-West', 22),
(487, 'Asa', 23),
(488, 'Baruten', 23),
(489, 'Edu', 23),
(490, 'Ekiti', 23),
(491, 'Ifelodun', 23),
(492, 'Ilorin East', 23),
(493, 'Ilorin South', 23),
(494, 'Ilorin West', 23),
(495, 'Irepodun', 23),
(496, 'Isin', 23),
(497, 'Kaiama', 23),
(498, 'Moro', 23),
(499, 'Offa', 23),
(500, 'Oke-Ero', 23),
(501, 'Oyun', 23),
(502, 'Pategi', 23),
(503, 'Agege', 24),
(504, 'Ajeromi-Ifelodun', 24),
(505, 'Alimosho', 24),
(506, 'Amuwo-Odofin', 24),
(507, 'Apapa', 24),
(508, 'Bagagry', 24),
(509, 'Epe', 24),
(510, 'Eti-Osa', 24),
(511, 'Ibeju-Lekki', 24),
(512, 'Ifako-Ijaiye', 24),
(513, 'Ikeja', 24),
(514, 'Ikorodu', 24),
(515, 'Kosofe', 24),
(516, 'Lagos-Island', 24),
(517, 'Lagos-Mainland', 24),
(518, 'Mushin', 24),
(519, 'Ojo', 24),
(520, 'Oshodi-Isolo', 24),
(521, 'Shomolu', 24),
(522, 'Suru-Lere', 24),
(523, 'Akwanga', 25),
(524, 'Awe', 25),
(525, 'Doma', 25),
(526, 'Karu', 25),
(527, 'Keana', 25),
(528, 'Keffi', 25),
(529, 'Kokona', 25),
(530, 'Lafia', 25),
(531, 'Nassarawa', 25),
(532, 'Nassarawa Eggor', 25),
(533, 'Obi', 25),
(534, 'Toto', 25),
(535, 'Wamba', 25),
(536, 'Agaie', 26),
(537, 'Agwara', 26),
(538, 'Bida', 26),
(539, 'Borgu', 26),
(540, 'Bosso', 26),
(541, 'Chanchaga', 26),
(542, 'Edati', 26),
(543, 'Gbako', 26),
(544, 'Gurara', 26),
(545, 'Katcha', 26),
(546, 'Kontagora', 26),
(547, 'Lapai', 26),
(548, 'Lavum', 26),
(549, 'Magama', 26),
(550, 'Mariga', 26),
(551, 'Mashegu', 26),
(552, 'Mokwa', 26),
(553, 'Muya', 26),
(554, 'Paikoro', 26),
(555, 'Rafi', 26),
(556, 'Rajau', 26),
(557, 'Shiroro', 26),
(558, 'Suleja', 26),
(559, 'Tafa', 26),
(560, 'Wushishi', 26),
(561, 'Abeokuta -North', 27),
(562, 'Abeokuta -South', 27),
(563, 'Ado-Odu/Ota', 27),
(564, 'Yewa-North', 27),
(565, 'Yewa-South', 27),
(566, 'Ewekoro', 27),
(567, 'Ifo', 27),
(568, 'Ijebu East', 27),
(569, 'Ijebu North', 27),
(570, 'Ijebu North-East', 27),
(571, 'Ijebu-Ode', 27),
(572, 'Ikenne', 27),
(573, 'Imeko-Afon', 27),
(574, 'Ipokia', 27),
(575, 'Obafemi -Owode', 27),
(576, 'Odeda', 27),
(577, 'Odogbolu', 27),
(578, 'Ogun-Water Side', 27),
(579, 'Remo-North', 27),
(580, 'Shagamu', 27),
(581, 'Akoko-North-East', 28),
(582, 'Akoko-North-West', 28),
(583, 'Akoko-South-West', 28),
(584, 'Akoko-South-East', 28),
(585, 'Akure- South', 28),
(586, 'Akure-North', 28),
(587, 'Ese-Odo', 28),
(588, 'Idanre', 28),
(589, 'Ifedore', 28),
(590, 'Ilaje', 28),
(591, 'Ile-Oluji-Okeigbo', 28),
(592, 'Irele', 28),
(593, 'Odigbo', 28),
(594, 'Okitipupa', 28),
(595, 'Ondo-West', 28),
(596, 'Ondo East', 28),
(597, 'Ose', 28),
(598, 'Owo', 28),
(599, 'Atakumosa', 29),
(600, 'Atakumosa East', 29),
(601, 'Ayeda-Ade', 29),
(602, 'Ayedire', 29),
(603, 'Boluwaduro', 29),
(604, 'Boripe', 29),
(605, 'Ede', 29),
(606, 'Ede North', 29),
(607, 'Egbedore', 29),
(608, 'Ejigbo', 29),
(609, 'Ife', 29),
(610, 'Ife East', 29),
(611, 'Ife North', 29),
(612, 'Ife South', 29),
(613, 'Ifedayo', 29),
(614, 'Ifelodun', 29),
(615, 'Ila', 29),
(616, 'Ilesha', 29),
(617, 'Ilesha-West', 29),
(618, 'Irepodun', 29),
(619, 'Irewole', 29),
(620, 'Isokun', 29),
(621, 'Iwo', 29),
(622, 'Obokun', 29),
(623, 'Odo-Otin', 29),
(624, 'Ola Oluwa', 29),
(625, 'Olorunda', 29),
(626, 'Ori-Ade', 29),
(627, 'Orolu', 29),
(628, 'Osogbo', 29),
(629, 'Afijio', 30),
(630, 'Akinyele', 30),
(631, 'Atiba', 30),
(632, 'Atisbo', 30),
(633, 'Egbeda', 30),
(634, 'Ibadan-Central', 30),
(635, 'Ibadan-North-East', 30),
(636, 'Ibadan-North-West', 30),
(637, 'Ibadan-South-East', 30),
(638, 'Ibadan-South West', 30),
(639, 'Ibarapa-Central', 30),
(640, 'Ibarapa-East', 30),
(641, 'Ibarapa-North', 30),
(642, 'Ido', 30),
(643, 'Ifedayo', 30),
(644, 'Ifeloju', 30),
(645, 'Irepo', 30),
(646, 'Iseyin', 30),
(647, 'Itesiwaju', 30),
(648, 'Iwajowa', 30),
(649, 'Kajola', 30),
(650, 'Lagelu', 30),
(651, 'Odo-Oluwa', 30),
(652, 'Ogbomoso-North', 30),
(653, 'Ogbomosho-South', 30),
(654, 'Olorunsogo', 30),
(655, 'Oluyole', 30),
(656, 'Ona-Ara', 30),
(657, 'Orelope', 30),
(658, 'Ori-Ire', 30),
(659, 'Oyo East', 30),
(660, 'Oyo West', 30),
(661, 'saki east', 30),
(662, 'Saki West', 30),
(663, 'Surulere', 30),
(664, 'Barkin Ladi', 31),
(665, 'Bassa', 31),
(666, 'Bokkos', 31),
(667, 'Jos-East', 31),
(668, 'Jos-South', 31),
(669, 'Jos-North', 31),
(670, 'Kanam', 31),
(671, 'Kanke', 31),
(672, 'Langtang North', 31),
(673, 'Langtang South', 31),
(674, 'Mangu', 31),
(675, 'Mikang', 31),
(676, 'Pankshin', 31),
(677, 'Quan\'pan', 31),
(678, 'Riyom', 31),
(679, 'Shendam', 31),
(680, 'Wase', 31),
(681, 'Abua/Odual', 32),
(682, 'Ahoada East', 32),
(683, 'Ahoada West', 32),
(684, 'Akukutoru', 32),
(685, 'Andoni', 32),
(686, 'Asari-Toro', 32),
(687, 'Bonny', 32),
(688, 'Degema', 32),
(689, 'Eleme', 32),
(690, 'Emuoha', 32),
(691, 'Etche', 32),
(692, 'Gokana', 32),
(693, 'Ikwerre', 32),
(694, 'Khana', 32),
(695, 'Obio/Akpor', 32),
(696, 'Ogba/Egbama/Ndoni', 32),
(697, 'Ogu/Bolo', 32),
(698, 'Okrika', 32),
(699, 'Omuma', 32),
(700, 'Opobo/Nkoro', 32),
(701, 'Oyigbo', 32),
(702, 'Port-Harcourt', 32),
(703, 'Tai', 32),
(704, 'Binji', 33),
(705, 'Bodinga', 33),
(706, 'Dange-Shuni', 33),
(707, 'Gada', 33),
(708, 'Goronyo', 33),
(709, 'Gudu', 33),
(710, 'Gwadabawa', 33),
(711, 'Illela', 33),
(712, 'Isa', 33),
(713, 'Kebbe', 33),
(714, 'Kware', 33),
(715, 'Raba', 33),
(716, 'Sabon-Birni', 33),
(717, 'Shagari', 33),
(718, 'Silame', 33),
(719, 'Sokoto North', 33),
(720, 'Sokoto South', 33),
(721, 'Tambuwal', 33),
(722, 'Tanzaga', 33),
(723, 'Tureta', 33),
(724, 'Wamakko', 33),
(725, 'Wurno', 33),
(726, 'Yabo', 33),
(727, 'Ardo Kola', 34),
(728, 'Bali', 34),
(729, 'Donga', 34),
(730, 'Gashaka', 34),
(731, 'Gassol', 34),
(732, 'Ibi', 34),
(733, 'Jalingo', 34),
(734, 'Karim-Lamido', 34),
(735, 'Kurmi', 34),
(736, 'Lau', 34),
(737, 'Sardauna', 34),
(738, 'Takuni', 34),
(739, 'Ussa', 34),
(740, 'Wukari', 34),
(741, 'Yarro', 34),
(742, 'Zing', 34),
(743, 'Bade', 35),
(744, 'Bursali', 35),
(745, 'Damaturu', 35),
(746, 'Fuka', 35),
(747, 'Fune', 35),
(748, 'Geidam', 35),
(749, 'Gogaram', 35),
(750, 'Gujba', 35),
(751, 'Gulani', 35),
(752, 'Jakusko', 35),
(753, 'Karasuwa', 35),
(754, 'Machina', 35),
(755, 'Nangere', 35),
(756, 'Nguru', 35),
(757, 'Potiskum', 35),
(758, 'Tarmua', 35),
(759, 'Yunisari', 35),
(760, 'Yusufari', 35),
(761, 'Anka', 36),
(762, 'Bakure', 36),
(763, 'Bukkuyum', 36),
(764, 'Bungudo', 36),
(765, 'Gumi', 36),
(766, 'Gusau', 36),
(767, 'Isa', 36),
(768, 'Kaura-Namoda', 36),
(769, 'Kiyawa', 36),
(770, 'Maradun', 36),
(771, 'Marau', 36),
(772, 'Shinkafa', 36),
(773, 'Talata-Mafara', 36),
(774, 'Tsafe', 36),
(775, 'Zurmi', 36),
(776, 'Obudu', 9),
(777, 'Abaji', 37),
(778, 'Bwari', 37),
(779, 'Gwagwalada', 37),
(780, 'Kuje', 37),
(781, 'Kwali', 37),
(782, 'Municipal', 37),
(783, 'Etsako-East', 12),
(784, 'Ahiazu-Mbaise', 16),
(785, 'Foreign', 38),
(786, 'Kaduna South', 18),
(787, 'Aboh-Mbaise', 16),
(788, 'Odukpani', 9);

-- --------------------------------------------------------

--
-- Table structure for table `ngo`
--

CREATE TABLE `ngo` (
  `ngo_id` int(11) NOT NULL,
  `ngo_firstname` varchar(45) NOT NULL,
  `ngo_lastname` varchar(45) NOT NULL,
  `ngo_email` varchar(45) NOT NULL,
  `ngo_phone` varchar(15) NOT NULL,
  `ngo_password` varchar(200) NOT NULL,
  `ngo_profilep` varchar(200) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `lga_id` int(11) DEFAULT NULL,
  `usercat_id` int(11) NOT NULL,
  `ngo_registrationdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ngo`
--

INSERT INTO `ngo` (`ngo_id`, `ngo_firstname`, `ngo_lastname`, `ngo_email`, `ngo_phone`, `ngo_password`, `ngo_profilep`, `state_id`, `lga_id`, `usercat_id`, `ngo_registrationdate`) VALUES
(1, 'AgricSupport', 'Foundation', 'agric@gmail.com', '', '$2y$10$lLiQaMdalaMGUF4o75TXd.dM4YlZHmBuTsATYeZrSrJiZeHH6BNpa', '1717326551789617870.jpg', 13, 242, 2, '2024-06-02 11:09:11'),
(2, 'James', 'State', 'wf@gmail.com', '', '$2y$10$hVMNhZmb.ST2CGbqxatDHeURd.a.2Ys82hWSckq6VbfrHebSLdMJW', '', NULL, NULL, 2, '2024-06-05 14:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderdetailsid` int(11) NOT NULL,
  `ptotal_amount` float NOT NULL,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `orderdetailsquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderdetailsid`, `ptotal_amount`, `order_id`, `pro_id`, `orderdetailsquantity`) VALUES
(1, 100000, 1, 16, 1),
(2, 1500, 1, 14, 2),
(3, 100, 2, 8, 2),
(4, 150, 2, 18, 2),
(5, 1000, 2, 17, 1),
(6, 1500, 2, 14, 1),
(7, 1000, 3, 17, 2),
(8, 100000, 3, 16, 1),
(9, 200000, 3, 15, 1),
(10, 1500, 3, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_ref` varchar(45) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `order_amount` float DEFAULT NULL,
  `order_status` enum('Pending','Delivered','Failed','Returned') NOT NULL DEFAULT 'Pending',
  `customer_id` int(11) NOT NULL,
  `delivery_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_ref`, `order_date`, `order_amount`, `order_status`, `customer_id`, `delivery_address`) VALUES
(1, '17176040481992181863', '2024-06-05 17:14:08', 103000, 'Delivered', 3, '6ygffghgf'),
(2, '17176047251468275759', '2024-06-05 17:25:25', 3000, 'Delivered', 1, '6ygffghgf'),
(3, '17176698362024838721', '2024-06-06 11:30:36', 303500, 'Pending', 4, '6ygffghgf');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(20) NOT NULL,
  `payment_amount` decimal(20,0) NOT NULL,
  `payment_status` enum('paid','pending','failed') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_amount`, `payment_status`, `payment_date`, `order_id`) VALUES
(1, 103000, 'paid', '2024-06-05 16:14:42', 1),
(2, 3000, 'paid', '2024-06-05 16:26:01', 2),
(3, 303500, 'paid', '2024-06-06 10:35:05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_qty` varchar(200) NOT NULL DEFAULT '1',
  `product_totalqty` int(11) NOT NULL,
  `product_desc` varchar(45) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `product_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_qty`, `product_totalqty`, `product_desc`, `product_image`, `cat_id`, `farmer_id`, `product_status`) VALUES
(1, 'Maize', 50, '1', 20000, 'Fresh Maize', '17173208401009215099.png', 2, 4, '1'),
(2, 'Cucumber', 60, '1', 200000, 'Fresh Cucumber', '1717320950997835525.png', 2, 4, '1'),
(3, 'Cashew', 10, '1', 1000000, 'Fresh Cashew', '1717321038159688681.png', 2, 4, '1'),
(4, 'Green Pepper', 10, '1', 2000000, 'Fresh Green Pepper', '1717321158966834517.png', 2, 4, '1'),
(5, 'Apple', 50, '1', 10000, 'Fresh Apple', '17173235881275913140.png', 2, 3, '1'),
(6, 'Coconut', 100, '1', 7000, 'Fresh Coconut', '1717323657237724317.png', 2, 3, '1'),
(7, 'Irish Potatoe', 10, '1', 5000, 'Fresh From farm', '1717323837621082036.png', 2, 3, '1'),
(8, 'Fresh Fruit', 100, '1', 500, 'Fresh from Farm', '1717323971198439670.png', 2, 3, '1'),
(9, 'Sweet Potatoes', 60, '1', 700000, 'Fresh Potatoes', '17173241041745168222.png', 2, 3, '1'),
(10, 'Egg', 1500, '1', 2000, 'Fresh farm egg', '17173241842061057446.png', 1, 3, '1'),
(11, 'Milk', 1000, '1', 90000, 'Fresh Farm Milk', '1717324259339564473.png', 1, 3, '1'),
(12, 'Cheese', 800, '1', 200, 'Fresh Cheese', '17173243311758888334.png', 1, 3, '1'),
(13, 'Steckerl Fish', 500, '1', 100, 'Steckerlfish', '1717324414995489049.png', 1, 3, '1'),
(14, 'Local Chicken', 1500, '1', 100, 'Local Chicken', '1717325001291156037.png', 3, 3, '1'),
(15, 'Cow', 200000, '1', 10, 'Fresh Bull', '17173250661874526961.png', 3, 3, '1'),
(16, 'Ram', 100000, '1', 50, 'Fresh Ram', '1717325150412189384.png', 3, 3, '1'),
(17, 'Wild Catfish', 1000, '1', 20, 'Wild Catfish', '17173252821895442607.png', 3, 3, '1'),
(18, 'Strawberry', 150, '1', 10000, 'Fresh Strawberry', '17173352691461222788.png', 2, 6, '1'),
(19, 'Tomatoes', 10, '1', 30000, 'Fresh Tomatoes', '17175340231017303895.png', 2, 7, '1');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `programme_id` int(11) NOT NULL,
  `programme_name` varchar(100) NOT NULL,
  `programme_goal` varchar(400) NOT NULL,
  `programme_invested_amount` decimal(10,0) NOT NULL,
  `programme_no_target` varchar(15) NOT NULL,
  `programme_desc` varchar(500) NOT NULL,
  `programme_image` varchar(200) NOT NULL,
  `government_id` int(11) NOT NULL,
  `ngo_id` int(11) NOT NULL,
  `programme_commence_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `programme_end_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`programme_id`, `programme_name`, `programme_goal`, `programme_invested_amount`, `programme_no_target`, `programme_desc`, `programme_image`, `government_id`, `ngo_id`, `programme_commence_date`, `programme_end_date`) VALUES
(1, 'Accelerate Fish Farming ', 'To Improve Fish Farming in Borgu', 50000000, '100', 'To Support fish farmers in Borgu LGA\r\nTo Provide improved seeds', '1717259204502491761.png', 1, 0, '2024-06-01 16:26:44', NULL),
(2, 'Operation Mechanize Farming', 'Tilting towards mechanized Farming', 2000000000, '37000', 'To Support each Local government with 2 Tractors\r\nTo Provide 1000 farmer with agricultural input of 300000\r\nTo Monitor yield from each of this farmers.....\r\nTo Provide farmers that did well and a new set of farmers with same the following season.', '17173226071610817069.jpg', 1, 0, '2024-06-02 10:03:27', NULL),
(3, 'Operation Go Back to Farm', 'To Support Lagos State Farmers', 300000000, '5000', 'To Support 5000 Lagos State Farmers\r\nTo Provide Farmers with Agric support Credit\r\nTo Ensure Accountability.....', '1717326041939488627.png', 3, 0, '2024-06-02 11:00:42', NULL),
(4, 'Agric must Thrive', 'To Support Poultry Farmers', 3000000, '10', 'To Support 10 Poultry Farmers in Ede LGA', '1717326676152675873.png', 0, 1, '2024-06-02 11:11:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `programmedetails`
--

CREATE TABLE `programmedetails` (
  `programmedetails_id` int(11) NOT NULL,
  `programmedetails_category` varchar(30) NOT NULL,
  `programmedetails_type` varchar(30) NOT NULL,
  `programmedetails_turnover` float NOT NULL,
  `programme_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `pro_status` enum('Pending','Approved','Declined','') NOT NULL DEFAULT 'Pending',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `programmedetails`
--

INSERT INTO `programmedetails` (`programmedetails_id`, `programmedetails_category`, `programmedetails_type`, `programmedetails_turnover`, `programme_id`, `farmer_id`, `pro_status`, `date`) VALUES
(1, 'Livestock', 'Fish Farming', 500000, 1, 3, 'Approved', '2024-06-01 17:28:29'),
(2, 'Livestock', 'Cattle Rearing', 20000000, 4, 3, 'Pending', '2024-06-02 13:13:48'),
(3, 'Plant', 'Maize farm', 10000000, 3, 3, 'Pending', '2024-06-02 13:58:28'),
(4, 'Plant', 'Casava farm', 1000000, 3, 3, 'Pending', '2024-06-02 14:49:51'),
(5, 'Plant', 'Casava farm', 1000000, 2, 3, 'Approved', '2024-06-04 20:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL DEFAULT 0,
  `state_name` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Abia'),
(2, 'Adamawa'),
(3, 'Akwa Ibom'),
(4, 'Anambra'),
(5, 'Bauchi'),
(6, 'Bayelsa'),
(7, 'Benue'),
(8, 'Borno'),
(9, 'Cross River'),
(10, 'Delta'),
(11, 'Ebonyi'),
(12, 'Edo'),
(13, 'Ekiti'),
(14, 'Enugu'),
(15, 'Gombe'),
(16, 'Imo'),
(17, 'Jigawa'),
(18, 'Kaduna'),
(19, 'Kano'),
(20, 'Katsina'),
(21, 'Kebbi'),
(22, 'Kogi'),
(23, 'Kwara'),
(24, 'Lagos'),
(25, 'Nassarawa'),
(26, 'Niger'),
(27, 'Ogun'),
(28, 'Ondo'),
(29, 'Osun'),
(30, 'Oyo'),
(31, 'Plateau'),
(32, 'Rivers'),
(33, 'Sokoto'),
(34, 'Taraba'),
(35, 'Yobe'),
(36, 'Zamfara'),
(37, 'FCT'),
(38, 'Foreign');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `subscriber_id` int(11) NOT NULL,
  `subscriber_email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`subscriber_id`, `subscriber_email`) VALUES
(4, 'admin@gmail.com'),
(1, 'fredhosea@gmail.com'),
(5, 'kenny@yahoo.com'),
(6, 'ng@gmail.com'),
(2, 'superadmin@gmail.com'),
(3, 'z@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `usercategory`
--

CREATE TABLE `usercategory` (
  `usercat_id` int(11) NOT NULL,
  `usercat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usercategory`
--

INSERT INTO `usercategory` (`usercat_id`, `usercat_name`) VALUES
(1, 'farmer'),
(2, 'ngo'),
(3, 'shopper'),
(4, 'government');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `roles` enum('farmer','ngo','customer','government') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `fname`, `lname`, `email`, `password`, `roles`) VALUES
(1, 'owo', 'zion', 'z@gmail.com', '$2y$10$nGR41c.CJY29ICDC5s/wX.4hKA.InWPCFPQqsdgcsRZX5Rb82YMzK', 'farmer'),
(2, 'Niger', 'State', 'ng@gmail.com', '$2y$10$ERV5Vj.4hrOr1y0Z4ktg0uVZEjGHhMHMRBKJPCPBzrFcW2Zm6V66K', 'government'),
(4, 'Salomi', 'John', 'a@gmail.com', '$2y$10$nKPF8IWBKyVVqVLrpqu60ONKyZKlZ.VgbmroDZe63b.qKJB1vSWMG', 'customer'),
(5, 'Kenny', 'Black', 'kn@gmail.com', '$2y$10$GgWu5Z4B8jz2xRzp0v/M0..ePTS/yNtvXTwqsmiYQvi.sH9qVV91u', 'farmer'),
(6, 'Lagos ', 'State', 'lg@gmail.com', '$2y$10$sQvq/RhTmizRDHpza7LcC.U/FuhcFovEoyd.qQySURVFxZuiGcE2i', 'government'),
(7, 'AgricSupport', 'Foundation', 'agric@gmail.com', '$2y$10$Eleitnn/JjspU6y6IM2JWO1NJQPq8lhfSFiM.qDMjbkxtvPrnL1Bi', 'ngo'),
(8, 'Taye', 'Taiwo', 't@gmail.com', '$2y$10$AH71lAZlPiei5y8870XULOiJGVuBw853zJb2caDA7/nVXXnENeEzu', 'farmer'),
(9, 'Mercy', 'Ajanlekoko', 'm@gmail.com', '$2y$10$AiJ3956x8Bq5QeDqLIlCcOZ.IPE0C/1z46GWSrebmh6zbaFUlStC2', 'farmer'),
(10, 'James', 'Jameson', 'jj@gmail.com', '$2y$10$PR1fwWtfGL81tvxUaWvmtO98aUuh74GbYaDlvLvkNAEvQ47XhSzLi', 'customer'),
(11, 'Tvocals', 'Kenny', 'tvocals@gmail.com', '$2y$10$DVJOz3p4GsSirUheSPv/g.3d7MKIgHxmiTsS04wcsJX3q7/eblJhe', 'customer'),
(12, 'Mercy', 'Johnson', 'mj@gmail.com', '$2y$10$KMr0suzCeyptoHK9X3dYdOxE091FIjmZgHAHcgOTmU.uVv8xjwlVG', 'farmer'),
(13, 'James', 'State', 'wf@gmail.com', '$2y$10$t.G3/YmG486EDhllfOjymeOATsCJO2hEqCrvTUAxBU/wagZHdUgi6', 'ngo'),
(14, 'Niger', 'John', 'r@gmail.com', '$2y$10$JZegKzDgajuxWBTWO7kZuehlhB6oSSeZf9mSD9f2goCcgAwVbr9pG', 'farmer'),
(15, 'Rolly', 'Adams', 'rolly@gmail.com', '$2y$10$ZN4VqHneEj0pm3RcKc.3Weyf1NDd1rbKdZd9aaNqp.8HXTCL4ttcu', 'customer'),
(16, 'Mich', 'miko', 'mich@gmail.com', '$2y$10$nKSxJj/EOt9tFxDkSA20L.csHiPcN8K3opGHwILIC1T3Au03f4xk.', 'customer'),
(17, 'Niger', 'John', 'nowolabi@gmail.com', '$2y$10$ypjpGigo0YSENApaozx6AeMGB70IHNHxEVK0BBO.SgnLQy8y1CA6O', 'farmer'),
(18, 'Sule', 'Sule', 'sule@gmail.com', '$2y$10$6lzBhXz7TXveOpM4COgk/OWPq4dUeeoFHpMY/hwm3dSK2fZm/gvfS', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`),
  ADD KEY `state_id` (`state_id`,`lga_id`,`usercat_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`farmer_id`),
  ADD UNIQUE KEY `farmer_email` (`farmer_email`);

--
-- Indexes for table `government`
--
ALTER TABLE `government`
  ADD PRIMARY KEY (`government_id`),
  ADD UNIQUE KEY `government_email` (`government_email`);

--
-- Indexes for table `lga`
--
ALTER TABLE `lga`
  ADD PRIMARY KEY (`lga_id`),
  ADD KEY `FKSTLGA_idx` (`state_id`);

--
-- Indexes for table `ngo`
--
ALTER TABLE `ngo`
  ADD PRIMARY KEY (`ngo_id`),
  ADD UNIQUE KEY `ngo_email` (`ngo_email`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderdetailsid`),
  ADD KEY `order_id` (`order_id`,`pro_id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`) USING BTREE,
  ADD KEY `ordercustomerkey_idx` (`customer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`) USING BTREE;

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`programme_id`) USING BTREE;

--
-- Indexes for table `programmedetails`
--
ALTER TABLE `programmedetails`
  ADD PRIMARY KEY (`programmedetails_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`subscriber_id`),
  ADD UNIQUE KEY `subscriber_email` (`subscriber_email`);

--
-- Indexes for table `usercategory`
--
ALTER TABLE `usercategory`
  ADD PRIMARY KEY (`usercat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `government`
--
ALTER TABLE `government`
  MODIFY `government_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ngo`
--
ALTER TABLE `ngo`
  MODIFY `ngo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderdetailsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `programme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programmedetails`
--
ALTER TABLE `programmedetails`
  MODIFY `programmedetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usercategory`
--
ALTER TABLE `usercategory`
  MODIFY `usercat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderkey` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `prodfarmerkey` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`farmer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
