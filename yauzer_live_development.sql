-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2018 at 08:22 PM
-- Server version: 10.1.25-MariaDB-1~xenial
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yauzer_live_development`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lee Preston', 'teamphp00@gmail.com', '$2y$10$1J1OAsJJqzwREOzgrnGfGub05VlNtaQD2WF9bbQWKG5deX8IufFgm', '1521638446.png', 'J9qvo93ijI8g44B6Vxn9RZaNcNJIqQJHxLNDoky52pQgifRVq7k4Ge0YHhUA', '2018-02-26 18:30:00', '2018-03-21 07:50:47'),
(2, 'Lee Preston', 'admin@yauzer.com', '$2y$10$1J1OAsJJqzwREOzgrnGfGub05VlNtaQD2WF9bbQWKG5deX8IufFgm', '1519740929.png', 'E42GPMOAyuXoGwRjPbk0HN6lKxHmBeMIlQLNmtJR6T1q8UdEObzDarwafyrU', '2018-02-26 18:30:00', '2018-02-27 08:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `business_categories`
--

CREATE TABLE `business_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_categories`
--

INSERT INTO `business_categories` (`id`, `name`, `avatar`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(26, 'ff4', 'default.png', 'ff-1', 0, '2018-03-16 03:26:05', '2018-03-21 06:57:20'),
(29, 'kgjkg', 'default.png', 'kgjkg', 1, '2018-03-16 03:28:47', '2018-03-21 02:09:31'),
(30, 'kgjkg', 'default.png', 'kgjkg-1', 1, '2018-03-16 03:28:47', '2018-03-21 01:11:06'),
(31, 'kgjkg', '1521190730.png', 'kgjkg-2', 1, '2018-03-16 03:28:49', '2018-03-20 07:22:11'),
(32, 'Category Examiner', 'default.png', 'kj', 1, '2018-03-16 03:30:22', '2018-03-20 07:22:13'),
(35, 'Lee Preston', '1521266489.png', 'lee-preston', 1, '2018-03-17 00:31:29', '2018-03-20 07:22:18'),
(36, 'ryrtyry', '1521544471.png', 'ryrtyry', 1, '2018-03-20 05:44:31', '2018-03-20 07:22:16'),
(37, 'Adios Amigos', '1521550079.png', 'adios-amigos', 1, '2018-03-20 07:17:59', '2018-03-20 07:22:15'),
(38, 'AA', '1521639680.png', 'a', 1, '2018-03-20 07:46:39', '2018-03-21 08:11:20'),
(39, 'dsdddddddddddddddddd', '1521552663.png', 'dsddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 1, '2018-03-20 08:01:03', '2018-03-21 08:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `business_hours`
--

CREATE TABLE `business_hours` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `sun_status` tinyint(1) NOT NULL DEFAULT '0',
  `sun_open` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sun_close` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mon_status` tinyint(1) NOT NULL DEFAULT '0',
  `mon_open` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mon_close` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tue_status` tinyint(1) NOT NULL DEFAULT '0',
  `tue_open` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tue_close` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wed_status` tinyint(1) NOT NULL DEFAULT '0',
  `wed_open` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wed_close` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thur_status` tinyint(1) NOT NULL DEFAULT '0',
  `thur_open` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thur_close` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fri_status` tinyint(1) NOT NULL DEFAULT '0',
  `fri_open` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fri_close` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sat_status` tinyint(1) NOT NULL DEFAULT '0',
  `sat_open` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sat_close` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_hours`
--

INSERT INTO `business_hours` (`id`, `business_id`, `sun_status`, `sun_open`, `sun_close`, `mon_status`, `mon_open`, `mon_close`, `tue_status`, `tue_open`, `tue_close`, `wed_status`, `wed_open`, `wed_close`, `thur_status`, `thur_open`, `thur_close`, `fri_status`, `fri_open`, `fri_close`, `sat_status`, `sat_open`, `sat_close`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '06:30 PM', '06:30 PM', 1, '06:45 PM', '07:00 PM', 1, '06:30 PM', '06:30 PM', 1, '06:30 PM', '06:30 PM', 1, '07:30 AM', NULL, 1, '06:30 PM', '06:30 PM', 1, '06:30 PM', '06:30 PM', '2018-03-05 07:31:50', '2018-03-22 06:13:53'),
(2, 3, 1, '02:30 PM', '02:30 PM', 0, '02:30 PM', '02:30 PM', 0, '02:30 PM', '02:30 PM', 0, '02:30 PM', '02:30 PM', 0, '02:30 PM', NULL, 0, '02:30 PM', '02:30 PM', 0, '02:30 PM', '02:30 PM', '2018-03-23 03:01:21', '2018-03-23 03:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `business_listings`
--

CREATE TABLE `business_listings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `premium_status` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_listings`
--

INSERT INTO `business_listings` (`id`, `user_id`, `email`, `name`, `business_category`, `address`, `city`, `state`, `zipcode`, `country`, `phone_number`, `website`, `description`, `avatar`, `latitude`, `longitude`, `status`, `premium_status`, `slug`, `created_at`, `updated_at`) VALUES
(1, 36, 'deftsoft@gmail.com', 'Business First1', '1', 'London, UK', 'Miami', 'FLt', '152001', 'Bulgaria', '564877798789', 'https://www.google.com', 'This is my first business want everyone to yauz its', '1519822429.png', '51.5073509', '-0.12775829999998223', 0, 0, 'business-first', '2018-02-27 18:30:00', '2018-03-23 04:49:18'),
(3, 36, 'deftsof1t@gmail.com', 'Business Second', '1', 'Miami, FL', 'Miami', 'FLt', '152001', 'Bulgaria', '564877798789', 'https://www.google.com', 'This is my first business want everyone to yauzer', '1519822429.png', '51.5073509', '-0.12775829999998223', 0, 0, 'business-second', '2018-02-27 18:30:00', '2018-03-23 04:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `business_pictures`
--

CREATE TABLE `business_pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_pictures`
--

INSERT INTO `business_pictures` (`id`, `business_id`, `avatar`, `created_at`, `updated_at`) VALUES
(10, 1, '1521003889.jpg', '2018-03-13 23:34:49', '2018-03-13 23:34:49'),
(11, 1, '1521003903.jpg', '2018-03-13 23:35:02', '2018-03-13 23:35:03'),
(12, 3, '1521800731.png', '2018-03-23 04:55:30', '2018-03-23 04:55:32'),
(13, 3, '1521800749.png', '2018-03-23 04:55:49', '2018-03-23 04:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `business_subcategories`
--

CREATE TABLE `business_subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_subcategories`
--

INSERT INTO `business_subcategories` (`id`, `business_category_id`, `name`, `avatar`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Test', '1520252059.png', 'test', 1, '2018-03-05 06:44:19', '2018-03-05 06:44:20'),
(5, 13, 'business', '1521186657.png', 'singh-3', 0, '2018-03-16 01:23:09', '2018-03-20 04:47:46'),
(6, 32, 'sadcs', '1521265606.jpg', 'sadc', 1, '2018-03-17 00:16:46', '2018-03-20 01:46:29'),
(7, 32, 'fef', '1521265663.png', 'fef', 1, '2018-03-17 00:17:43', '2018-03-17 00:17:44'),
(8, 30, 'Tests', '1521465579.png', 'test-1', 1, '2018-03-19 07:49:38', '2018-03-19 07:49:46'),
(9, 35, 'Testings', '1521465822.png', 'testing', 1, '2018-03-19 07:53:42', '2018-03-19 08:03:26'),
(10, 36, '5tyg', '1521544504.png', '5tyg', 1, '2018-03-20 05:45:03', '2018-03-20 05:45:04'),
(11, 37, 'hello', '1521550109.png', 'hello', 0, '2018-03-20 07:18:29', '2018-03-20 07:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Deftsoft Developer', 'deftsoft_developer@gmail.com', 'This is test message', '2018-03-04 18:30:00', '2018-03-04 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `credit_card_owner_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cvv` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_exp_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_exp_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_cards`
--

INSERT INTO `credit_cards` (`id`, `user_id`, `business_id`, `credit_card_owner_name`, `cvv`, `credit_card_number`, `credit_exp_month`, `credit_exp_year`, `status`, `created_at`, `updated_at`) VALUES
(1, 36, 1, 'Sammy Singh', '7547', '4242 4242 4242 4242', '12', '22', 1, '2018-03-23 03:00:17', '2018-03-23 03:00:42'),
(2, 36, 3, 'Testing', '123', '4242 4242 4242 4242', '12', '18', 1, '2018-03-23 03:40:04', '2018-03-23 03:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `discount_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_thru` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `business_id`, `discount_title`, `valid_thru`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '15% Off', '2018-03-24', 'Working', 1, '2018-03-23 07:50:39', '2018-03-23 07:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Is that question?', 'gd', 'fd', 1, '2018-03-20 07:10:00', '2018-03-21 08:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `footer_menus`
--

CREATE TABLE `footer_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_menus`
--

INSERT INTO `footer_menus` (`id`, `name`, `url`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'http://14.141.82.37:9292/about-us', 'about-us', 1, '2018-03-19 08:29:23', '2018-03-20 07:26:32'),
(2, 'New Footer', 'http://14.141.82.37:9292/admin/new-footer-menu', 'sdfnsdffjfsjfsdkjlksdfjksfdjsdfjlksfdjkjfdslkjfsdljlfsdjfksdjlkfsdjsdfjlkjsdfksdflkjlsdkfjlsdfjlfjlkdfsjljlfsjlksdfjl', 1, '2018-03-20 08:03:16', '2018-03-21 01:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `header_menus`
--

CREATE TABLE `header_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `header_menus`
--

INSERT INTO `header_menus` (`id`, `name`, `url`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Sammya', 'http://14.141.82.37:9292/admin/new-header-menu', 'sammy', 0, '2018-03-20 02:26:45', '2018-03-21 01:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2018_02_09_084556_create_roles_table', 2),
(11, '2018_02_09_084625_create_user_roles_table', 3),
(76, '2014_10_12_000000_create_users_table', 4),
(77, '2014_10_12_100000_create_password_resets_table', 4),
(78, '2018_02_13_112528_create_admins_table', 4),
(79, '2018_02_16_084556_create_roles_table', 4),
(80, '2018_02_16_084625_create_user_roles_table', 4),
(81, '2018_02_20_102833_create_business_categories_table', 4),
(82, '2018_02_20_131354_create_business_listings_table', 4),
(83, '2018_02_21_065107_create_pages_table', 4),
(84, '2018_02_21_102921_create_slider_images_table', 4),
(85, '2018_02_23_065532_create_business_subcategories_table', 4),
(86, '2018_02_23_090651_create_countries_table', 4),
(87, '2018_02_23_111246_create_header_menus_table', 4),
(88, '2018_02_23_114044_create_footer_menus_table', 4),
(89, '2018_02_23_125528_create_contact_us_table', 4),
(90, '2018_02_27_092028_create_faqs_table', 4),
(91, '2018_02_27_114457_create_yauzers_table', 4),
(93, '2018_02_27_142656_create_credit_cards_table', 5),
(97, '2018_03_01_103151_create_business_hours_table', 6),
(98, '2018_03_13_064347_create_business_pictures_table', 7),
(101, '2018_03_23_123028_create_discounts_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pageurl` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metatitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metakeywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadescription` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `description`, `slug`, `pageurl`, `metatitle`, `metakeywords`, `metadescription`, `status`, `created_at`, `updated_at`) VALUES
(11, 'About Us', '<p>About Us</p>', 'about-us', 'http://14.141.82.37:9292/about-us', 'About Us', 'About Us', 'About Us', 1, '2018-03-21 08:16:42', '2018-03-21 08:17:30'),
(12, 'About UsAbout UsAbout UsAbout UsAbout UsAbout Us', '<p>About Us</p>', 'about-usabout-usabout-usabout-usabout-usabout-us', 'http://14.141.82.37:9292/about-usabout-usabout-usabout-usabout-usabout-us', 'About Us', 'About Us', 'About Us', 1, '2018-03-21 08:17:10', '2018-03-21 08:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('teamphp00@gmail.com', '$2y$10$0Iqc4yBo0m7.IqPiCggXiOp82im7/h9xewXd8IX2u6a8tUZjKj5Qa', '2018-03-05 00:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', '2018-02-26 18:30:00', '2018-02-26 18:30:00'),
(2, 'owner', '2018-02-26 18:30:00', '2018-02-26 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `sliderimages`
--

CREATE TABLE `sliderimages` (
  `id` int(10) UNSIGNED NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `avatar`, `description`, `slug`, `image_alt_text`, `status`, `created_at`, `updated_at`) VALUES
(2, '1521198080.png', 'asdaasd', '1521198080-png', '123as asdf', 0, '2018-03-16 05:31:20', '2018-03-21 06:56:18'),
(3, '1521549417.png', 's', '1521549417-png', 's', 1, '2018-03-20 07:06:57', '2018-03-20 07:24:29'),
(4, '1521550490.png', 'as', '1521550490-png', 'asd', 1, '2018-03-20 07:24:50', '2018-03-21 01:39:48'),
(5, '1521550520.png', 'asd', '1521550520-png', 'asd', 1, '2018-03-20 07:25:20', '2018-03-20 07:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` date DEFAULT NULL,
  `login_status` tinyint(1) NOT NULL DEFAULT '0',
  `registeration_status` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `password`, `city`, `state`, `zipcode`, `country`, `address`, `phone_number`, `age`, `login_status`, `registeration_status`, `slug`, `remember_token`, `created_at`, `updated_at`) VALUES
(15, 'Kunal Ratra', 'qa.deftsoft7@gmail.com', '1521551225.jpg', '$2y$10$tgHHcHeG8fnWEokFwg8Y6ukdNIrHOKtmIY/EYEju2IAikHzC6bLc6', 'chd', 'india', '132001', 'India', 'dsffdsfdsdfsfsdadfsa', '111', NULL, 0, 1, 'kunal', NULL, '2018-03-15 06:48:56', '2018-03-21 06:57:07'),
(22, 'nazuu', 'nazu1996@gmail.com', '1521614008.png', '$2y$10$WmEn5.fjvhuIIuPMrtAUX.ocxwH3yUAELIRQTwkh3kA7W6YSpanES', 'dhfgh12', 'fh', '123', 'Bahamas', 'fgh', '8883176164', NULL, 1, 1, 'nazuu-1', NULL, '2018-03-16 03:12:45', '2018-03-21 01:03:28'),
(28, 'asd op.as', 'asdlkl@gmail.com', '1521193447.png', '$2y$10$0t.yeV4p2eSfPLVEcVoTkOZo9a8Nrar/m.BiLCKIZF9rFgIuqDQ1m', 'asd as23\' sa', 'aasd=-;/as as', '123543121123121123', 'Bahrain', 'asd \'.as s', '123 sad\'[=as sd.d', NULL, 0, 1, 'asd-op-as', NULL, '2018-03-16 04:14:02', '2018-03-21 02:38:22'),
(29, 'asdwe43b  314//', 'asdasddd@gmail.com', '1521193995.png', '$2y$10$bRVWyWnRims8/W6vT3U24.W0Jqv1SpknEwavI2T7bArw4Tne4Rd0.', 'a2e 325 6t;\'. ed', 'assaasdasd qw34 .\'sdcv', '2312435799342345654662345465622123123123123', 'Algeria', '123asd2cc..', '123asd4567..;;ppedfv x343', NULL, 1, 1, 'asdwe43b-314', NULL, '2018-03-16 04:23:09', '2018-03-16 04:23:15'),
(31, 'asdasdasd', 'asdasd@sify.com', '1521194525.png', '$2y$10$I2t/51eCSTOEBE7cAKyjMuZCZDfzFVN2i5Vl./oPsADCoM68eW20m', 'asdw32@[\'as', 'asd3w p\'/ fgh@', '123123123', 'Bahrain', 'asd231 `as@', '12387aks', NULL, 1, 1, 'asdasdasd', NULL, '2018-03-16 04:32:00', '2018-03-16 04:32:05'),
(34, 'Deftsoft User', 'teamphp07770@gmail.com', '1521264435.png', '$2y$10$1sX4RxTTEAMCFCHnkh.jhebFz6J/ij/SZpgJppwfjRVGWVU0iMbiu', 'North Miami', 'jk', '116515', 'United Kingdom', '13540 NW 7th Avenue', '156169849', NULL, 1, 1, 'deftsoft-user-1', NULL, '2018-03-16 23:57:10', '2018-03-16 23:57:15'),
(35, 'Deftsoft User5', 'teamphp300@gmail.com', '1521266336.png', '$2y$10$qbY92u6KAKVqX0ph8d5fre6eOVKoHeJuJmra6iPk4qQRv9/.IxykG', 'New York', 'NY', '42423', 'Afghanistan', 'New York', '1254546456546', NULL, 1, 1, 'deftsoft-user', NULL, '2018-03-17 00:28:51', '2018-03-21 01:59:21'),
(36, 'Deftsoft User', 'tress786@yopmail.com', '1521457898.png', '$2y$10$BAtTaNlqfWs9FhU5K4b9neXewAgEOp0AgbLeyKKFqvDkl1bSSXvRS', 'New York', 'NYY', '42423', 'United States', 'New York', '2342342342', NULL, 0, 1, 'deftsoft-user-2', NULL, '2018-03-19 05:41:29', '2018-03-21 01:18:22'),
(37, 'Deftsoft User', 'deftsoft12@gmail.com', '1521458501.png', '$2y$10$3gyoCeYuihlFgwKa1OPyn.kBYT4hDu38fTRfTNx9zcv1Y.N8kCYN2', 'New York', 'NY', '42423', 'United States', 'New York', 'sdfdsfsdfsdfsdf', NULL, 1, 1, 'deftsoft-user-3', NULL, '2018-03-19 05:51:35', '2018-03-19 05:51:41'),
(41, 'asdasda', 'adminas@gmail.com', '1521544097.png', '$2y$10$n3xu0AEzDWrm/ySQ2iR3MOJiJYeUtknp.10HpLTUeEmYJt0P3/Vuu', '123123', '123123', '123', 'Algeria', 'awdasd1212', '123', NULL, 1, 1, 'asdasda', NULL, '2018-03-20 05:38:12', '2018-03-20 06:39:23'),
(42, 'asdasddasd', 'admssdin@gmail.com', '1521544317.png', '$2y$10$Ey1Y/V.DSYfe0cBCrrVFr.pOt5UBP42au.hLuWCPZJrgMV/6tI.oa', 'asda', 'asda', '12', 'Azerbaijan', 'asd22', '123', NULL, 1, 1, 'asdasddasd', NULL, '2018-03-20 05:41:52', '2018-03-20 06:39:24'),
(43, 'zsasasasd', 'admsssdsdin@gmail.com', '1521544372.png', '$2y$10$UCR1uKYDF04ePDYxUeGwn.9SpYDbpQsnKA7PWlj/KXeYOEUytooc.', 'asd1', 'qwsasd123', '123123', 'Bangladesh', 'asd1', '123', NULL, 1, 1, 'zsasasasd', NULL, '2018-03-20 05:42:48', '2018-03-20 06:39:25'),
(44, 'sharan', 'admss2q3in@gmail.com', '1521544496.png', '$2y$10$KLohRWkaU4JfX6aw4ewcwum53t0hkeaA1Hjom6P2RfAX4ZdFBohHC', 'asd112', 'asd', '123', 'Albania', 'asd12', '123', NULL, 1, 1, 'sharan', NULL, '2018-03-20 05:44:51', '2018-03-20 06:39:25'),
(48, '456', 'nazuu6@gmail.com', '1521545260.png', '$2y$10$FTxtMSCDrUSJJpZortn4b.QfBmVI5MJOh8nJLNEqTYScheFRGAcEO', 'fgh', 'gfh', '123', 'Bahamas', '4564gh', '8883176164', NULL, 1, 1, '456', NULL, '2018-03-20 05:57:35', '2018-03-21 01:07:12'),
(53, 'sdfsdfsf', 'nazuyty1996@gmail.fdgdfg', '1521614137.jpg', '$2y$10$pzmPpJFc7ygKVAnb1MR3cOkcsowijFeiict49K.tZOcEiY3UPdCUK', 'dhfgh', 'fh', '123', 'Bangladesh', 'fgh', '8883176164', NULL, 1, 1, 'sdfsdfsf', NULL, '2018-03-21 01:05:30', '2018-03-21 01:07:14'),
(55, 'Ashu', 's@gmail.com', '1521617005.jpg', '$2y$10$tAK8SsGLNpTdHos.r95yp.Kg98UzW2IJkY.ckBtBgkZnkDRHnmYyW', '123', '123', '12323', 'Azerbaijan', '123', '2312231231', NULL, 0, 0, 'ashu', NULL, '2018-03-21 01:53:17', '2018-03-21 02:15:24'),
(57, 'hfgh', 'fhfh@gmail.com', 'default.png', '$2y$10$jOoLkaST9R1t/GcnA05QBuOVw3PfqqQPMLOowXXqqerwNi7dONQC2', 'dfg', 'dsfg', '123', 'Azerbaijan', 'dg', '8883176164', NULL, 1, 1, 'hfgh', NULL, '2018-03-21 04:00:31', '2018-03-21 04:00:31'),
(58, 'hfgh', 'fhfgfh@gmail.com', 'default.png', '$2y$10$6YM2DNkDqXBOSN4PTzW/1O2Xsnu1F2pz4qDQewPR/Gf5LsA6RIaBq', 'dfg', 'dsfg', '123', 'Andorra', 'dg', '8883176164', NULL, 1, 1, 'hfgh-1', NULL, '2018-03-21 04:07:29', '2018-03-21 04:07:29'),
(59, 'hfgh', 'fhf56gfh@gmail.com', '1521625903.png', '$2y$10$nh3Vv6V8H4YoWNb7Y/j3s.m0yyJzOVGuESPzsVzaCHwoaof40gDly', 'dfg', 'dsfg', '123', 'Bahrain', 'dg', '8883176164', NULL, 1, 1, 'hfgh-2', NULL, '2018-03-21 04:21:36', '2018-03-21 04:21:43'),
(60, 'A', 'a@gmail.com', '1521631297.jpg', '$2y$10$mHQZjYvKbruZLLTj0Tc/EOs4n5RpyxhhTzqjdBUIG6Wd3TlUVln7G', 'fsdafdas', 'dfasdsd', '160020', 'Andorra', 'erte', '323232123', NULL, 1, 1, 'a', NULL, '2018-03-21 05:51:30', '2018-03-21 05:51:39'),
(61, 'A', 'aa@gmail.com', '1521631369.jpg', '$2y$10$esXAHql3Cr/Ow4X7QBDZ0OGr2ieYEMGUwr0y8gcGOhBkclzeSDbQO', 'fsdafdsfd', 'fdasfdaf', '31231321', 'Australia', 'dffdsadfs', '213313123', NULL, 0, 1, 'a-1', NULL, '2018-03-21 05:52:44', '2018-03-22 06:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 2, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 2, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 1, 13, NULL, NULL),
(14, 1, 14, NULL, NULL),
(15, 1, 15, NULL, NULL),
(16, 1, 16, NULL, NULL),
(17, 2, 17, NULL, NULL),
(18, 2, 18, NULL, NULL),
(19, 2, 19, NULL, NULL),
(20, 1, 20, NULL, NULL),
(21, 1, 21, NULL, NULL),
(22, 1, 22, NULL, NULL),
(23, 1, 23, NULL, NULL),
(24, 1, 24, NULL, NULL),
(25, 2, 25, NULL, NULL),
(26, 1, 26, NULL, NULL),
(27, 1, 27, NULL, NULL),
(28, 1, 28, NULL, NULL),
(29, 1, 29, NULL, NULL),
(30, 1, 30, NULL, NULL),
(31, 1, 31, NULL, NULL),
(32, 1, 32, NULL, NULL),
(33, 2, 33, NULL, NULL),
(34, 1, 33, NULL, NULL),
(35, 1, 34, NULL, NULL),
(36, 2, 35, NULL, NULL),
(37, 2, 36, NULL, NULL),
(38, 1, 37, NULL, NULL),
(39, 1, 38, NULL, NULL),
(40, 1, 39, NULL, NULL),
(41, 1, 40, NULL, NULL),
(42, 1, 41, NULL, NULL),
(43, 1, 42, NULL, NULL),
(44, 1, 43, NULL, NULL),
(45, 1, 44, NULL, NULL),
(46, 1, 45, NULL, NULL),
(47, 1, 46, NULL, NULL),
(48, 1, 47, NULL, NULL),
(49, 1, 48, NULL, NULL),
(50, 2, 49, NULL, NULL),
(51, 1, 50, NULL, NULL),
(52, 2, 51, NULL, NULL),
(53, 2, 52, NULL, NULL),
(54, 1, 53, NULL, NULL),
(55, 1, 54, NULL, NULL),
(56, 1, 55, NULL, NULL),
(57, 2, 56, NULL, NULL),
(58, 1, 53, NULL, NULL),
(59, 2, 54, NULL, NULL),
(60, 1, 55, NULL, NULL),
(61, 2, 56, NULL, NULL),
(62, 1, 57, NULL, NULL),
(63, 1, 58, NULL, NULL),
(64, 1, 59, NULL, NULL),
(65, 1, 60, NULL, NULL),
(66, 1, 61, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yauzers`
--

CREATE TABLE `yauzers` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `yauzer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yauzers`
--

INSERT INTO `yauzers` (`id`, `business_id`, `user_id`, `yauzer`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 34, 'Pellentesque lacinia sem eget felis consectetur aliquam. Nam non suscipit libero. Nullam leo ante, hendrerit nec eleifend eu, lobortis eget nunc. Donec sed dignissim ipsum. Pellentesque accum', 5, 1, '2018-03-21 21:33:07', '2018-03-21 21:33:07'),
(2, 3, 35, 'Pellentesque lacinia sem eget felis consectetur aliquam. Nam non suscipit libero. Nullam leo ante, hendrerit nec eleifend eu, lobortis eget nunc. Donec sed dignissim ipsum. Pellentesque accum', 2, 1, '2018-03-21 21:33:07', '2018-03-21 21:33:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `business_categories`
--
ALTER TABLE `business_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_hours`
--
ALTER TABLE `business_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_listings`
--
ALTER TABLE `business_listings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `business_listings_email_unique` (`email`);

--
-- Indexes for table `business_pictures`
--
ALTER TABLE `business_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_subcategories`
--
ALTER TABLE `business_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_menus`
--
ALTER TABLE `footer_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_menus`
--
ALTER TABLE `header_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliderimages`
--
ALTER TABLE `sliderimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yauzers`
--
ALTER TABLE `yauzers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `business_categories`
--
ALTER TABLE `business_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `business_hours`
--
ALTER TABLE `business_hours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `business_listings`
--
ALTER TABLE `business_listings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `business_pictures`
--
ALTER TABLE `business_pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `business_subcategories`
--
ALTER TABLE `business_subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `footer_menus`
--
ALTER TABLE `footer_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `header_menus`
--
ALTER TABLE `header_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sliderimages`
--
ALTER TABLE `sliderimages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `yauzers`
--
ALTER TABLE `yauzers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
