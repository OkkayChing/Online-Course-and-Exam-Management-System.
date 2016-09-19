-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2016 at 10:49 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `munna`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `ans_id` int(5) NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `ques_id` int(5) NOT NULL,
  `right_ans` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `blog_body` text COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(5) NOT NULL,
  `blog_post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `blog`
--
CREATE TRIGGER `before_delete_blog` BEFORE DELETE ON `blog` FOR EACH ROW DELETE FROM blog_comments WHERE blog_id = OLD.blog_id;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment_body` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_author_id` int(5) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(5) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `last_modified_by` int(5) NOT NULL,
  `icon_class` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL,
  `content_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content_heading` text COLLATE utf8_unicode_ci NOT NULL,
  `content_data` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `content_type`, `content_heading`, `content_data`) VALUES
(1, 'wc_title', '', 'Welcome'),
(2, 'wc_msg', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eu urna sit amet libero posuere egestas. Aenean et enim eget dolor fringilla pulvinar. Pellentesque elit libero, placerat et eros id, pretium interdum nibh.'),
(3, 'about_us', 'About Us', '<div>Lorem ipsum dolor sit amet, ea sed noluisse definiebas eloquentiam, pro laoreet scaevola te. In malis aliquid duo, his erat viris inciderint ei, nisl quando appareat te sea. His sale civibus qualisque eu, per utinam tritani petentium ut, in vis vero aperiri facilisis. At est eripuit laoreet repudiandae.</div><div><br></div><div>Id nec mutat tantas lucilius, duo ad dico latine eleifend, quaestio voluptatum definiebas mel ea. Erant legere at pro, repudiare liberavisse ius ad, ad per mundi comprehensam interpretaris. Vix ea dolorum maluisset expetendis. Omnis choro an sit.</div>'),
(4, 'price_table_msg', 'Subscribe to Start Learning', 'Get access to a huge library of learning material, and support the site that helps you learn.'),
(5, 'slider_text', 'Online Learning made Easy', 'Non stop learning whenever you want wherever you want.'),
(6, 'slider_text', 'MinorSchool.net', 'One of the best E-learning platform available.'),
(7, 'slider_text', 'Lear From Home', 'You don''t have to move to school for learning. Learning from your comfort zone.');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` smallint(5) UNSIGNED NOT NULL,
  `country_code` char(2) NOT NULL,
  `country_code3` char(3) DEFAULT NULL,
  `country_name` varchar(255) NOT NULL,
  `currency_id` smallint(5) UNSIGNED DEFAULT NULL,
  `timezone_id` smallint(5) UNSIGNED DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_code`, `country_code3`, `country_name`, `currency_id`, `timezone_id`, `latitude`, `longitude`) VALUES
(1, 'AD', 'AND', 'Andorra', 49, 1, 42.5, 1.5),
(2, 'AE', 'ARE', 'United Arab Emirates', 1, 2, 24, 54),
(3, 'AF', 'AFG', 'Afghanistan', 2, 3, 33, 65),
(4, 'AG', 'ATG', 'Antigua and Barbuda', 168, 4, 17.05, -61.8),
(5, 'AI', 'AIA', 'Anguilla', 168, 5, 18.25, -63.1667),
(6, 'AL', 'ALB', 'Albania', 3, 6, 41, 20),
(7, 'AM', 'ARM', 'Armenia', 4, 7, 40, 45),
(8, 'AO', 'AGO', 'Angola', 6, 8, -12.5, 18.5),
(9, 'AQ', 'ATA', 'Antarctica', NULL, 13, -90, 0),
(10, 'AR', 'ARG', 'Argentina', 7, 19, -34, -64),
(11, 'AS', 'ASM', 'American Samoa', 151, 31, -14.3333, -170),
(12, 'AT', 'AUT', 'Austria', 49, 32, 47.3333, 13.3333),
(13, 'AU', 'AUS', 'Australia', 8, 45, -27, 133),
(14, 'AW', 'ABW', 'Aruba', 9, 46, 12.5, -69.9667),
(15, 'AX', 'ALA', 'Ãƒâ€¦land Islands', 49, 47, 60.177, 19.915),
(16, 'AZ', 'AZE', 'Azerbaijan', 10, 48, 40.5, 47.5),
(17, 'BA', 'BIH', 'Bosnia and Herzegovina', 11, 49, 44, 18),
(18, 'BB', 'BRB', 'Barbados', 12, 50, 13.1667, -59.5333),
(19, 'BD', 'BGD', 'Bangladesh', 13, 51, 24, 90),
(20, 'BE', 'BEL', 'Belgium', 49, 52, 50.8333, 4),
(21, 'BF', 'BFA', 'Burkina Faso', 171, 53, 13, -2),
(22, 'BG', 'BGR', 'Bulgaria', 14, 54, 43, 25),
(23, 'BH', 'BHR', 'Bahrain', 15, 55, 26, 50.55),
(24, 'BI', 'BDI', 'Burundi', 16, 56, -3.5, 30),
(25, 'BJ', 'BEN', 'Benin', 171, 57, 9.5, 2.25),
(26, 'BL', 'BLM', 'Saint BarthÃƒÂ©lemy', 49, 58, 17.9, -62.8333),
(27, 'BM', 'BMU', 'Bermuda', 17, 59, 32.3333, -64.75),
(28, 'BN', 'BRN', 'Brunei', 18, 60, 4.5, 114.667),
(29, 'BO', 'BOL', 'Bolivia', 19, 61, -17, -65),
(30, 'BQ', 'BES', 'Bonaire, Sint Eustatius and Saba', 151, 62, 12.1784, -68.2385),
(31, 'BR', 'BRA', 'Brazil', 21, 78, -10, -55),
(32, 'BS', 'BHS', 'Bahamas', 22, 79, 24.25, -76),
(33, 'BT', 'BTN', 'Bhutan', 23, 80, 27.5, 90.5),
(34, 'BV', 'BVT', 'Bouvet Island', 109, NULL, -54.4333, 3.4),
(35, 'BW', 'BWA', 'Botswana', 24, 81, -22, 24),
(36, 'BY', 'BLR', 'Belarus', 25, 82, 53, 28),
(37, 'BZ', 'BLZ', 'Belize', 26, 83, 17.25, -88.75),
(38, 'CA', 'CAN', 'Canada', 27, 107, 60, -95),
(39, 'CC', 'CCK', 'Cocos Islands', 8, 112, -12.5, 96.8333),
(40, 'CD', 'COD', 'DR Congo', 28, 113, 0, 25),
(41, 'CF', 'CAF', 'Central African Republic', 161, 115, 7, 21),
(42, 'CG', 'COG', 'Congo', 161, 116, -1, 15),
(43, 'CH', 'CHE', 'Switzerland', 29, 117, 47, 8),
(44, 'CI', 'CIV', 'CÃƒÂ´te d''Ivoire', 171, 118, 8, -5),
(45, 'CK', 'COK', 'Cook Islands', 111, 119, -21.2333, -159.767),
(46, 'CL', 'CHL', 'Chile', 32, 427, -30, -71),
(47, 'CM', 'CMR', 'Cameroon', 161, 122, 6, 12),
(48, 'CN', 'CHN', 'China', 34, 126, 35, 105),
(49, 'CO', 'COL', 'Colombia', 35, 128, 4, -72),
(50, 'CR', 'CRI', 'Costa Rica', 37, 129, 10, -84),
(51, 'CU', 'CUB', 'Cuba', 38, 130, 21.5, -80),
(52, 'CV', 'CPV', 'Cape Verde', 40, 131, 16, -24),
(53, 'CW', 'CUW', 'CuraÃƒÂ§ao', 5, 132, 12.1696, -68.99),
(54, 'CX', 'CXR', 'Christmas Island', 8, 133, -10.5, 105.667),
(55, 'CY', 'CYP', 'Cyprus', 49, 134, 35, 33),
(56, 'CZ', 'CZE', 'Czech Republic', 41, 135, 49.75, 15.5),
(57, 'DE', 'DEU', 'Germany', 49, 136, 51, 9),
(58, 'DJ', 'DJI', 'Djibouti', 42, 138, 11.5, 43),
(59, 'DK', 'DNK', 'Denmark', 43, 139, 56, 10),
(60, 'DM', 'DMA', 'Dominica', 168, 140, 15.4167, -61.3333),
(61, 'DO', 'DOM', 'Dominican Republic', 44, 141, 19, -70.6667),
(62, 'DZ', 'DZA', 'Algeria', 45, 142, 28, 3),
(63, 'EC', 'ECU', 'Ecuador', 151, 143, -2, -77.5),
(64, 'EE', 'EST', 'Estonia', 49, 145, 59, 26),
(65, 'EG', 'EGY', 'Egypt', 46, 146, 27, 30),
(66, 'EH', 'ESH', 'Western Sahara', 91, 147, 24.5, -13),
(67, 'ER', 'ERI', 'Eritrea', 47, 148, 15, 39),
(68, 'ES', 'ESP', 'Spain', 49, 151, 40, -4),
(69, 'ET', 'ETH', 'Ethiopia', 48, 152, 8, 38),
(70, 'EU', '', 'European Union', 49, NULL, 47, 8),
(71, 'FI', 'FIN', 'Finland', 49, 153, 64, 26),
(72, 'FJ', 'FJI', 'Fiji', 50, 154, -18, 175),
(73, 'FK', 'FLK', 'Falkland Islands', 51, 155, -51.75, -59),
(74, 'FM', 'FSM', 'Micronesia', 151, 156, 6.9167, 158.25),
(75, 'FO', 'FRO', 'Faroe Islands', 43, 159, 62, -7),
(76, 'FR', 'FRA', 'France', 49, 160, 46, 2),
(77, 'GA', 'GAB', 'Gabon', 161, 161, -1, 11.75),
(78, 'GB', 'GBR', 'United Kingdom', 52, 162, 54, -2),
(79, 'GD', 'GRD', 'Grenada', 168, 163, 12.1167, -61.6667),
(80, 'GE', 'GEO', 'Georgia', 53, 164, 42, 43.5),
(81, 'GF', 'GUF', 'French Guiana', 49, 165, 4, -53),
(82, 'GG', 'GGY', 'Guernsey', 52, 166, 49.4657, -2.58528),
(83, 'GH', 'GHA', 'Ghana', 54, 167, 8, -2),
(84, 'GI', 'GIB', 'Gibraltar', 55, 168, 36.1833, -5.3667),
(85, 'GL', 'GRL', 'Greenland', 43, 170, 72, -40),
(86, 'GM', 'GMB', 'Gambia', 56, 173, 13.4667, -16.5667),
(87, 'GN', 'GIN', 'Guinea', 57, 174, 11, -10),
(88, 'GP', 'GLP', 'Guadeloupe', 49, 175, 16.25, -61.5833),
(89, 'GQ', 'GNQ', 'Equatorial Guinea', 161, 176, 2, 10),
(90, 'GR', 'GRC', 'Greece', 49, 177, 39, 22),
(91, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', NULL, 178, -54.5, -37),
(92, 'GT', 'GTM', 'Guatemala', 58, 179, 15.5, -90.25),
(93, 'GU', 'GUM', 'Guam', 151, 180, 13.4667, 144.783),
(94, 'GW', 'GNB', 'Guinea-Bissau', 171, 181, 12, -15),
(95, 'GY', 'GUY', 'Guyana', 59, 182, 5, -59),
(96, 'HK', 'HKG', 'Hong Kong', 60, 183, 22.25, 114.167),
(97, 'HM', 'HMD', 'Heard Island and McDonald Islands', 8, NULL, -53.1, 72.5167),
(98, 'HN', 'HND', 'Honduras', 61, 184, 15, -86.5),
(99, 'HR', 'HRV', 'Croatia', 62, 185, 45.1667, 15.5),
(100, 'HT', 'HTI', 'Haiti', 63, 186, 19, -72.4167),
(101, 'HU', 'HUN', 'Hungary', 64, 187, 47, 20),
(102, 'ID', 'IDN', 'Indonesia', 65, 188, -5, 120),
(103, 'IE', 'IRL', 'Ireland', 49, 192, 53, -8),
(104, 'IL', 'ISR', 'Israel', 66, 193, 31.5, 34.75),
(105, 'IM', 'IMN', 'Isle of Man', 52, 194, 54.2361, -4.54806),
(106, 'IN', 'IND', 'India', 67, 195, 20, 77),
(107, 'IO', 'IOT', 'British Indian Ocean Territory', 151, 196, -6, 71.5),
(108, 'IQ', 'IRQ', 'Iraq', 68, 197, 33, 44),
(109, 'IR', 'IRN', 'Iran', 69, 198, 32, 53),
(110, 'IS', 'ISL', 'Iceland', 70, 199, 65, -18),
(111, 'IT', 'ITA', 'Italy', 49, 200, 42.8333, 12.8333),
(112, 'JE', 'JEY', 'Jersey', 52, 201, 49.2138, -2.13577),
(113, 'JM', 'JAM', 'Jamaica', 71, 202, 18.25, -77.5),
(114, 'JO', 'JOR', 'Jordan', 72, 203, 31, 36),
(115, 'JP', 'JPN', 'Japan', 73, 204, 36, 138),
(116, 'KE', 'KEN', 'Kenya', 74, 205, 1, 38),
(117, 'KG', 'KGZ', 'Kyrgyzstan', 75, 206, 41, 75),
(118, 'KH', 'KHM', 'Cambodia', 76, 207, 13, 105),
(119, 'KI', 'KIR', 'Kiribati', 8, 210, 1.4167, 173),
(120, 'KM', 'COM', 'Comoros', 77, 211, -12.1667, 44.25),
(121, 'KN', 'KNA', 'Saint Kitts and Nevis', 168, 212, 17.3333, -62.75),
(122, 'KP', 'PRK', 'North Korea', 78, 213, 40, 127),
(123, 'KR', 'KOR', 'South Korea', 79, 214, 37, 127.5),
(124, 'KW', 'KWT', 'Kuwait', 80, 215, 29.3375, 47.6581),
(125, 'KY', 'CYM', 'Cayman Islands', 81, 216, 19.5, -80.5),
(126, 'KZ', 'KAZ', 'Kazakhstan', 82, 217, 48, 68),
(127, 'LA', 'LAO', 'Laos', 83, 222, 18, 105),
(128, 'LB', 'LBN', 'Lebanon', 84, 223, 33.8333, 35.8333),
(129, 'LC', 'LCA', 'Saint Lucia', 168, 224, 13.8833, -61.1333),
(130, 'LI', 'LIE', 'Liechtenstein', 30, 225, 47.1667, 9.5333),
(131, 'LK', 'LKA', 'Sri Lanka', 85, 226, 7, 81),
(132, 'LR', 'LBR', 'Liberia', 86, 227, 6.5, -9.5),
(133, 'LS', 'LSO', 'Lesotho', 87, 228, -29.5, 28.5),
(134, 'LT', 'LTU', 'Lithuania', 88, 229, 56, 24),
(135, 'LU', 'LUX', 'Luxembourg', 49, 230, 49.75, 6.1667),
(136, 'LV', 'LVA', 'Latvia', 89, 231, 57, 25),
(137, 'LY', 'LBY', 'Libya', 90, 232, 25, 17),
(138, 'MA', 'MAR', 'Morocco', 91, 233, 32, -5),
(139, 'MC', 'MCO', 'Monaco', 49, 234, 43.7333, 7.4),
(140, 'MD', 'MDA', 'Moldova', 92, 235, 47, 29),
(141, 'ME', 'MNE', 'Montenegro', 49, 236, 42, 19),
(142, 'MF', 'MAF', 'Saint Martin', 49, 237, 18.0525, -63.0737),
(143, 'MG', 'MDG', 'Madagascar', 93, 238, -20, 47),
(144, 'MH', 'MHL', 'Marshall Islands', 151, 240, 9, 168),
(145, 'MK', 'MKD', 'Macedonia', 94, 241, 41.8333, 22),
(146, 'ML', 'MLI', 'Mali', 171, 242, 17, -4),
(147, 'MM', 'MMR', 'Myanmar', 95, 243, 22, 98),
(148, 'MN', 'MNG', 'Mongolia', 96, 244, 46, 105),
(149, 'MO', 'MAC', 'Macao', 97, 247, 22.1667, 113.55),
(150, 'MP', 'MNP', 'Northern Mariana Islands', 151, 248, 15.2, 145.75),
(151, 'MQ', 'MTQ', 'Martinique', 49, 249, 14.6667, -61),
(152, 'MR', 'MRT', 'Mauritania', 98, 250, 20, -12),
(153, 'MS', 'MSR', 'Montserrat', 168, 251, 16.75, -62.2),
(154, 'MT', 'MLT', 'Malta', 49, 252, 35.8333, 14.5833),
(155, 'MU', 'MUS', 'Mauritius', 99, 253, -20.2833, 57.55),
(156, 'MV', 'MDV', 'Maldives', 100, 254, 3.25, 73),
(157, 'MW', 'MWI', 'Malawi', 101, 255, -13.5, 34),
(158, 'MX', 'MEX', 'Mexico', 102, 263, 23, -102),
(159, 'MY', 'MYS', 'Malaysia', 104, 268, 2.5, 112.5),
(160, 'MZ', 'MOZ', 'Mozambique', 105, 270, -18.25, 35),
(161, 'NA', 'NAM', 'Namibia', 106, 271, -22, 17),
(162, 'NC', 'NCL', 'New Caledonia', 173, 272, -21.5, 165.5),
(163, 'NE', 'NER', 'Niger', 171, 273, 16, 8),
(164, 'NF', 'NFK', 'Norfolk Island', 8, 274, -29.0333, 167.95),
(165, 'NG', 'NGA', 'Nigeria', 107, 275, 10, 8),
(166, 'NI', 'NIC', 'Nicaragua', 108, 276, 13, -85),
(167, 'NL', 'NLD', 'Netherlands', 49, 277, 52.5, 5.75),
(168, 'NO', 'NOR', 'Norway', 109, 278, 62, 10),
(169, 'NP', 'NPL', 'Nepal', 110, 279, 28, 84),
(170, 'NR', 'NRU', 'Nauru', 8, 280, -0.5333, 166.917),
(171, 'NU', 'NIU', 'Niue', 111, 281, -19.0333, -169.867),
(172, 'NZ', 'NZL', 'New Zealand', 111, 282, -41, 174),
(173, 'OM', 'OMN', 'Oman', 112, 284, 21, 57),
(174, 'PA', 'PAN', 'Panama', 113, 285, 9, -80),
(175, 'PE', 'PER', 'Peru', 114, 286, -10, -76),
(176, 'PF', 'PYF', 'French Polynesia', 173, 288, -15, -140),
(177, 'PG', 'PNG', 'Papua New Guinea', 115, 290, -6, 147),
(178, 'PH', 'PHL', 'Philippines', 116, 291, 13, 122),
(179, 'PK', 'PAK', 'Pakistan', 117, 292, 30, 70),
(180, 'PL', 'POL', 'Poland', 118, 293, 52, 20),
(181, 'PM', 'SPM', 'Saint Pierre and Miquelon', 49, 294, 46.8333, -56.3333),
(182, 'PN', 'PCN', 'Pitcairn', 111, 295, -24.7036, -127.439),
(183, 'PR', 'PRI', 'Puerto Rico', 151, 296, 18.25, -66.5),
(184, 'PS', 'PSE', 'Palestine', NULL, 297, 32, 35.25),
(185, 'PT', 'PRT', 'Portugal', 49, 301, 39.5, -8),
(186, 'PW', 'PLW', 'Palau', 151, 302, 7.5, 134.5),
(187, 'PY', 'PRY', 'Paraguay', 119, 303, -23, -58),
(188, 'QA', 'QAT', 'Qatar', 120, 304, 25.5, 51.25),
(189, 'RE', 'REU', 'RÃƒÂ©union', 49, 305, -21.1, 55.6),
(190, 'RO', 'ROU', 'Romania', 121, 306, 46, 25),
(191, 'RS', 'SRB', 'Serbia', 122, 307, 44, 21),
(192, 'RU', 'RUS', 'Russia', 123, 323, 60, 100),
(193, 'RW', 'RWA', 'Rwanda', 124, 326, -2, 30),
(194, 'SA', 'SAU', 'Saudi Arabia', 125, 327, 25, 45),
(195, 'SB', 'SLB', 'Solomon Islands', 126, 328, -8, 159),
(196, 'SC', 'SYC', 'Seychelles', 127, 329, -4.5833, 55.6667),
(197, 'SD', 'SDN', 'Sudan', 128, 330, 15, 30),
(198, 'SE', 'SWE', 'Sweden', 129, 331, 62, 15),
(199, 'SG', 'SGP', 'Singapore', 130, 332, 1.3667, 103.8),
(200, 'SH', 'SHN', 'Saint Helena, Ascension and Tristan da Cunha', 131, 333, -15.9333, -5.7),
(201, 'SI', 'SVN', 'Slovenia', 49, 334, 46, 15),
(202, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 109, 335, 78, 20),
(203, 'SK', 'SVK', 'Slovakia', 49, 336, 48.6667, 19.5),
(204, 'SL', 'SLE', 'Sierra Leone', 132, 337, 8.5, -11.5),
(205, 'SM', 'SMR', 'San Marino', 49, 338, 43.9333, 12.4667),
(206, 'SN', 'SEN', 'Senegal', 171, 339, 14, -14),
(207, 'SO', 'SOM', 'Somalia', 133, 340, 10, 49),
(208, 'SR', 'SUR', 'Suriname', 134, 341, 4, -56),
(209, 'SS', 'SSD', 'South Sudan', 135, 342, 7.96309, 30.1589),
(210, 'ST', 'STP', 'Sao Tome and Principe', 136, 343, 1, 7),
(211, 'SV', 'SLV', 'El Salvador', 151, 344, 13.8333, -88.9167),
(212, 'SX', 'SXM', 'Sint Maarten', 5, 345, 18.0273, -63.0501),
(213, 'SY', 'SYR', 'Syrian Arab Republic', 138, 346, 35, 38),
(214, 'SZ', 'SWZ', 'Swaziland', 139, 347, -26.5, 31.5),
(215, 'TC', 'TCA', 'Turks and Caicos Islands', 151, 348, 21.75, -71.5833),
(216, 'TD', 'TCD', 'Chad', 161, 349, 15, 19),
(217, 'TF', 'ATF', 'French Southern Territories', 49, 350, -43, 67),
(218, 'TG', 'TGO', 'Togo', 171, 351, 8, 1.1667),
(219, 'TH', 'THA', 'Thailand', 140, 352, 15, 100),
(220, 'TJ', 'TJK', 'Tajikistan', 141, 353, 39, 71),
(221, 'TK', 'TKL', 'Tokelau', 111, 354, -9, -172),
(222, 'TL', 'TLS', 'Timor-Leste', 151, 355, -8.87422, 125.728),
(223, 'TM', 'TKM', 'Turkmenistan', 142, 356, 40, 60),
(224, 'TN', 'TUN', 'Tunisia', 143, 357, 34, 9),
(225, 'TO', 'TON', 'Tonga', 144, 358, -20, -175),
(226, 'TR', 'TUR', 'Turkey', 145, 359, 39, 35),
(227, 'TT', 'TTO', 'Trinidad and Tobago', 146, 360, 11, -61),
(228, 'TV', 'TUV', 'Tuvalu', 8, 361, -8, 178),
(229, 'TW', 'TWN', 'Taiwan', 147, 362, 23.5, 121),
(230, 'TZ', 'TZA', 'Tanzania', 148, 363, -6, 35),
(231, 'UA', 'UKR', 'Ukraine', 149, 364, 49, 32),
(232, 'UG', 'UGA', 'Uganda', 150, 368, 1, 32),
(233, 'UM', 'UMI', 'U.S. Minor Outlying Islands', 151, NULL, 19.2833, 166.6),
(234, 'US', 'USA', 'United States', 151, 392, 38, -97),
(235, 'UY', 'URY', 'Uruguay', 155, 402, -33, -56),
(236, 'UZ', 'UZB', 'Uzbekistan', 156, 404, 41, 64),
(237, 'VA', 'VAT', 'Vatican City', 49, 405, 41.9, 12.45),
(238, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 168, 406, 13.25, -61.2),
(239, 'VE', 'VEN', 'Venezuela', 157, 407, 8, -66),
(240, 'VG', 'VGB', 'British Virgin Islands', 151, 408, 18.5, -64.5),
(241, 'VI', 'VIR', 'U.S. Virgin Islands', 151, 409, 18.3333, -64.8333),
(242, 'VN', 'VNM', 'Vietnam', 158, 410, 16, 106),
(243, 'VU', 'VUT', 'Vanuatu', 159, 411, -16, 167),
(244, 'WF', 'WLF', 'Wallis and Futuna', 173, 412, -13.3, -176.2),
(245, 'WS', 'WSM', 'Samoa', 160, 413, -13.5833, -172.333),
(246, 'YE', 'YEM', 'Yemen', 179, 414, 15, 48),
(247, 'YT', 'MYT', 'Mayotte', 49, 415, -12.8333, 45.1667),
(248, 'ZA', 'ZAF', 'South Africa', 180, 416, -29, 24),
(249, 'ZM', 'ZMB', 'Zambia', 181, 417, -15, 30),
(250, 'ZW', 'ZWE', 'Zimbabwe', 182, 418, -20, 30);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_title` text COLLATE utf8_unicode_ci NOT NULL,
  `course_intro` text COLLATE utf8_unicode_ci NOT NULL,
  `course_description` text COLLATE utf8_unicode_ci NOT NULL,
  `course_price` float NOT NULL,
  `category_id` int(5) NOT NULL,
  `course_requirement` text COLLATE utf8_unicode_ci NOT NULL,
  `target_audience` text COLLATE utf8_unicode_ci NOT NULL,
  `what_i_get` text COLLATE utf8_unicode_ci NOT NULL,
  `feature_image` text COLLATE utf8_unicode_ci NOT NULL,
  `course_count_reviews` int(11) NOT NULL,
  `course_rating` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_view_count` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_audios`
--

CREATE TABLE `course_audios` (
  `audio_id` int(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `audio_title` text COLLATE utf8_unicode_ci NOT NULL,
  `preview_type` text COLLATE utf8_unicode_ci NOT NULL,
  `audio_link` text COLLATE utf8_unicode_ci NOT NULL,
  `orderList` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_docs`
--

CREATE TABLE `course_docs` (
  `doc_id` int(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `doc_title` text COLLATE utf8_unicode_ci NOT NULL,
  `preview_type` text COLLATE utf8_unicode_ci NOT NULL,
  `doc_link` text COLLATE utf8_unicode_ci NOT NULL,
  `orderList` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_ppts`
--

CREATE TABLE `course_ppts` (
  `ppt_id` int(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `ppt_title` text COLLATE utf8_unicode_ci NOT NULL,
  `preview_type` text COLLATE utf8_unicode_ci NOT NULL,
  `ppt_link` text COLLATE utf8_unicode_ci NOT NULL,
  `orderList` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_sections`
--

CREATE TABLE `course_sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `section_title` text COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `video_ids` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `doc_ids` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `audio_ids` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ppt_ids` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `orderList` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_videos`
--

CREATE TABLE `course_videos` (
  `video_id` int(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `video_title` text COLLATE utf8_unicode_ci NOT NULL,
  `preview_type` text COLLATE utf8_unicode_ci NOT NULL,
  `video_link` text COLLATE utf8_unicode_ci NOT NULL,
  `youtube_link` text COLLATE utf8_unicode_ci NOT NULL,
  `orderList` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` smallint(5) UNSIGNED NOT NULL,
  `currency_code` char(3) NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `country_id` smallint(5) UNSIGNED DEFAULT NULL,
  `allow_dec` int(1) NOT NULL DEFAULT '1' COMMENT '0= Decimal not allowed'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `currency_code`, `currency_name`, `currency_symbol`, `country_id`, `allow_dec`) VALUES
(8, 'AUD', 'Australian Dollar', '$', 13, 1),
(27, 'CAD', 'Canadian Dollar', '$', 38, 1),
(183, 'ILS', 'Israeli New Sheqel', '&#8362;', NULL, 1),
(30, 'CHF', 'Swiss Franc', '&#8355;', 43, 1),
(43, 'DKK', 'Danish Krone', 'kr', 59, 1),
(49, 'EUR', 'Euro', '&euro;', 70, 1),
(60, 'HKD', 'Hong Kong Dollar', '$', 96, 1),
(111, 'NZD', 'New Zealand Dollar', '$', 172, 1),
(116, 'PHP', 'Philippine Peso', '&#8369;', 178, 1),
(123, 'RUB', 'Russian Ruble', '&#x584;', 192, 1),
(129, 'SEK', 'Swedish Krona', 'kr', 198, 1),
(130, 'SGD', 'Singapore Dollar', '$', 199, 1),
(151, 'USD', 'US Dollar', '$', 234, 1),
(52, 'GBP', 'Pound Sterling', '&pound;', 78, 1),
(18, 'BRL', 'Brazilian Real', 'R$', 31, 1),
(41, 'CZK', 'Czech Koruna', 'Kč', 56, 1),
(1000, 'JPY', 'Japanese Yen', '¥', NULL, 1),
(104, 'MYR', 'Malaysian Ringgit', 'RM', 159, 1),
(102, 'MXN', 'Mexican Peso', '$', 158, 1),
(1001, 'TWD', 'Taiwan New Dollar', 'NT$', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_title`
--

CREATE TABLE `exam_title` (
  `title_id` int(5) NOT NULL,
  `title_name` text COLLATE utf8_unicode_ci NOT NULL,
  `exam_price` float NOT NULL DEFAULT '0',
  `syllabus` text COLLATE utf8_unicode_ci NOT NULL,
  `random_ques_no` int(5) NOT NULL,
  `pass_mark` int(3) NOT NULL DEFAULT '50' COMMENT '%',
  `time_duration` time NOT NULL DEFAULT '00:02:00',
  `feature_img_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(5) NOT NULL,
  `category_id` int(5) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `course_id` int(11) DEFAULT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '1',
  `exam_created` datetime NOT NULL,
  `last_modified_by` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `exam_title`
--
CREATE TRIGGER `before_delete_exam` BEFORE DELETE ON `exam_title` FOR EACH ROW DELETE FROM questions WHERE exam_id = OLD.title_id;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(5) NOT NULL,
  `faq_ques` text CHARACTER SET utf8 NOT NULL,
  `faq_ans` text CHARACTER SET utf8 NOT NULL,
  `faq_created_by` int(5) NOT NULL,
  `faq_last_modified_by` int(5) NOT NULL,
  `faq_last_update` date NOT NULL,
  `faq_grp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_grp`
--

CREATE TABLE `faq_grp` (
  `faq_grp_id` int(11) NOT NULL,
  `faq_grp_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feature_list`
--

CREATE TABLE `feature_list` (
  `feature_id` int(11) NOT NULL,
  `feature_item` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) NOT NULL,
  `message_sender` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sender_email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `message_send_to` varchar(100) CHARACTER SET utf8 NOT NULL,
  `message_subject` text CHARACTER SET utf8 NOT NULL,
  `message_body` text CHARACTER SET utf8 NOT NULL,
  `message_date` datetime NOT NULL,
  `message_folder` varchar(10) CHARACTER SET utf8 NOT NULL,
  `message_read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=unread,1=read',
  `spam` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=No,1=Yes',
  `trash` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=No,1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `messages`
--
CREATE TRIGGER `before_delete_message` BEFORE DELETE ON `messages` FOR EACH ROW DELETE FROM messages_reply WHERE message_id_fk = OLD.message_id;

-- --------------------------------------------------------

--
-- Table structure for table `messages_reply`
--

CREATE TABLE `messages_reply` (
  `message_reply_id` int(10) NOT NULL,
  `message_id_fk` int(10) NOT NULL,
  `replied_messages` text CHARACTER SET utf8 NOT NULL,
  `replied_by` int(5) NOT NULL,
  `replied_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE `noticeboard` (
  `notice_id` int(11) NOT NULL,
  `notice_title` text COLLATE utf8_unicode_ci NOT NULL,
  `notice_descr` text COLLATE utf8_unicode_ci NOT NULL,
  `notice_start` date NOT NULL,
  `notice_end` date NOT NULL,
  `notice_status` int(1) NOT NULL DEFAULT '1',
  `notice_created_by` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `pay_id` int(8) NOT NULL,
  `payer_id` varchar(100) NOT NULL,
  `pay_amount` varchar(20) NOT NULL,
  `currency_code` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `user_id_ref` int(5) NOT NULL,
  `payment_reference` text NOT NULL,
  `pay_date` date NOT NULL,
  `pay_method` varchar(25) NOT NULL,
  `gateway_reference` varchar(256) NOT NULL,
  `payment_type` varchar(22) NOT NULL DEFAULT 'exam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_settings`
--

CREATE TABLE `paypal_settings` (
  `id` int(5) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1' COMMENT '0 = ''Disabled'' ,1 = ''Enabled''',
  `currency_id` int(3) NOT NULL,
  `api_username` varchar(255) NOT NULL,
  `api_pass` varchar(255) NOT NULL,
  `api_signature` text NOT NULL,
  `sandbox` int(1) NOT NULL DEFAULT '1' COMMENT '1=Sandbox, 0=Live'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `price_table`
--

CREATE TABLE `price_table` (
  `price_table_id` int(11) NOT NULL,
  `price_table_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_table_cost` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `offer_duration` int(11) NOT NULL,
  `offer_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `price_table_top` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `puchase_history`
--

CREATE TABLE `puchase_history` (
  `purchase_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'course',
  `user_id` int(11) NOT NULL,
  `pur_ref_id` int(11) NOT NULL,
  `pur_date` date DEFAULT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ques_id` int(5) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `exam_id` int(5) NOT NULL,
  `option_type` text CHARACTER SET utf8 NOT NULL,
  `media_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `media_link` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `questions`
--
CREATE TRIGGER `before_delete_ques` BEFORE DELETE ON `questions` FOR EACH ROW DELETE FROM answers WHERE ques_id = OLD.ques_id;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `ans_id` int(5) NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `ques_id` int(5) NOT NULL,
  `right_ans` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `ques_id` int(5) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `quiz_id` int(5) NOT NULL,
  `option_type` text CHARACTER SET utf8 NOT NULL,
  `media_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `media_link` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_title`
--

CREATE TABLE `quiz_title` (
  `title_id` int(5) NOT NULL,
  `title_name` text COLLATE utf8_unicode_ci NOT NULL,
  `random_ques_no` int(5) NOT NULL,
  `pass_mark` int(3) NOT NULL DEFAULT '50' COMMENT '%',
  `time_duration` time NOT NULL DEFAULT '00:02:00',
  `feature_img_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(5) NOT NULL,
  `section_id` int(5) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `quiz_created` datetime NOT NULL,
  `last_modified_by` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `result_id` int(5) NOT NULL,
  `exam_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `result_percent` varchar(6) CHARACTER SET utf8 NOT NULL COMMENT '(%)',
  `question_answered` int(3) NOT NULL,
  `exam_taken_date` datetime NOT NULL,
  `result_json` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `brand_id` int(1) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_tagline` varchar(250) NOT NULL,
  `local_time_zone` varchar(100) NOT NULL,
  `support_email` varchar(100) NOT NULL,
  `support_phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `facbook_url` text NOT NULL,
  `googleplus_url` text NOT NULL,
  `linkedin_url` text NOT NULL,
  `you_tube_url` text NOT NULL,
  `flickr_url` text NOT NULL,
  `twitter_url` text NOT NULL,
  `pinterest_url` text NOT NULL,
  `show_video_on_home` int(1) NOT NULL DEFAULT '0',
  `student_can_register` int(1) NOT NULL DEFAULT '1',
  `last_update` date NOT NULL,
  `commercial` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`brand_id`, `brand_name`, `brand_tagline`, `local_time_zone`, `support_email`, `support_phone`, `address`, `facbook_url`, `googleplus_url`, `linkedin_url`, `you_tube_url`, `flickr_url`, `twitter_url`, `pinterest_url`, `show_video_on_home`, `student_can_register`, `last_update`, `commercial`) VALUES
(1, 'Minor School', 'Education for all.', 'Asia/Baku', 'support@demo.com', '09999999', '121 King Street, Melbourne  Victoria 3000 Australia', 'https://www.facebook.com/', '', 'https://twitter.com/', 'https://www.youtube.com/', '', 'https://twitter.com/', '', 1, 1, '2016-01-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) NOT NULL,
  `sub_cat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(5) NOT NULL,
  `created_by` int(5) NOT NULL,
  `sub_cat_active` int(1) NOT NULL DEFAULT '1',
  `last_modified_by` int(5) NOT NULL,
  `icon_class` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timezone`
--

CREATE TABLE `timezone` (
  `timezone_id` smallint(5) UNSIGNED NOT NULL,
  `timezone_name` varchar(255) NOT NULL,
  `country_id` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`timezone_id`, `timezone_name`, `country_id`) VALUES
(1, 'Europe/Andorra', 1),
(2, 'Asia/Dubai', 2),
(3, 'Asia/Kabul', 3),
(4, 'America/Antigua', 4),
(5, 'America/Anguilla', 5),
(6, 'Europe/Tirane', 6),
(7, 'Asia/Yerevan', 7),
(8, 'Africa/Luanda', 8),
(9, 'Antarctica/Casey', 9),
(10, 'Antarctica/Davis', 9),
(11, 'Antarctica/DumontDUrville', 9),
(12, 'Antarctica/Mawson', 9),
(13, 'Antarctica/McMurdo', 9),
(14, 'Antarctica/Palmer', 9),
(15, 'Antarctica/Rothera', 9),
(16, 'Antarctica/South_Pole', 9),
(17, 'Antarctica/Syowa', 9),
(18, 'Antarctica/Vostok', 9),
(19, 'America/Argentina/Buenos_Aires', 10),
(20, 'America/Argentina/Catamarca', 10),
(21, 'America/Argentina/Cordoba', 10),
(22, 'America/Argentina/Jujuy', 10),
(23, 'America/Argentina/La_Rioja', 10),
(24, 'America/Argentina/Mendoza', 10),
(25, 'America/Argentina/Rio_Gallegos', 10),
(26, 'America/Argentina/Salta', 10),
(27, 'America/Argentina/San_Juan', 10),
(28, 'America/Argentina/San_Luis', 10),
(29, 'America/Argentina/Tucuman', 10),
(30, 'America/Argentina/Ushuaia', 10),
(31, 'Pacific/Pago_Pago', 11),
(32, 'Europe/Vienna', 12),
(33, 'Antarctica/Macquarie', 13),
(34, 'Australia/Adelaide', 13),
(35, 'Australia/Brisbane', 13),
(36, 'Australia/Broken_Hill', 13),
(37, 'Australia/Currie', 13),
(38, 'Australia/Darwin', 13),
(39, 'Australia/Eucla', 13),
(40, 'Australia/Hobart', 13),
(41, 'Australia/Lindeman', 13),
(42, 'Australia/Lord_Howe', 13),
(43, 'Australia/Melbourne', 13),
(44, 'Australia/Perth', 13),
(45, 'Australia/Sydney', 13),
(46, 'America/Aruba', 14),
(47, 'Europe/Mariehamn', 15),
(48, 'Asia/Baku', 16),
(49, 'Europe/Sarajevo', 17),
(50, 'America/Barbados', 18),
(51, 'Asia/Dhaka', 19),
(52, 'Europe/Brussels', 20),
(53, 'Africa/Ouagadougou', 21),
(54, 'Europe/Sofia', 22),
(55, 'Asia/Bahrain', 23),
(56, 'Africa/Bujumbura', 24),
(57, 'Africa/Porto-Novo', 25),
(58, 'America/St_Barthelemy', 26),
(59, 'Atlantic/Bermuda', 27),
(60, 'Asia/Brunei', 28),
(61, 'America/La_Paz', 29),
(62, 'America/Kralendijk', 30),
(63, 'America/Araguaina', 31),
(64, 'America/Bahia', 31),
(65, 'America/Belem', 31),
(66, 'America/Boa_Vista', 31),
(67, 'America/Campo_Grande', 31),
(68, 'America/Cuiaba', 31),
(69, 'America/Eirunepe', 31),
(70, 'America/Fortaleza', 31),
(71, 'America/Maceio', 31),
(72, 'America/Manaus', 31),
(73, 'America/Noronha', 31),
(74, 'America/Porto_Velho', 31),
(75, 'America/Recife', 31),
(76, 'America/Rio_Branco', 31),
(77, 'America/Santarem', 31),
(78, 'America/Sao_Paulo', 31),
(79, 'America/Nassau', 32),
(80, 'Asia/Thimphu', 33),
(81, 'Africa/Gaborone', 35),
(82, 'Europe/Minsk', 36),
(83, 'America/Belize', 37),
(84, 'America/Atikokan', 38),
(85, 'America/Blanc-Sablon', 38),
(86, 'America/Cambridge_Bay', 38),
(87, 'America/Creston', 38),
(88, 'America/Dawson', 38),
(89, 'America/Dawson_Creek', 38),
(90, 'America/Edmonton', 38),
(91, 'America/Glace_Bay', 38),
(92, 'America/Goose_Bay', 38),
(93, 'America/Halifax', 38),
(94, 'America/Inuvik', 38),
(95, 'America/Iqaluit', 38),
(96, 'America/Moncton', 38),
(97, 'America/Montreal', 38),
(98, 'America/Nipigon', 38),
(99, 'America/Pangnirtung', 38),
(100, 'America/Rainy_River', 38),
(101, 'America/Rankin_Inlet', 38),
(102, 'America/Regina', 38),
(103, 'America/Resolute', 38),
(104, 'America/St_Johns', 38),
(105, 'America/Swift_Current', 38),
(106, 'America/Thunder_Bay', 38),
(107, 'America/Toronto', 38),
(108, 'America/Vancouver', 38),
(109, 'America/Whitehorse', 38),
(110, 'America/Winnipeg', 38),
(111, 'America/Yellowknife', 38),
(112, 'Indian/Cocos', 39),
(113, 'Africa/Kinshasa', 40),
(114, 'Africa/Lubumbashi', 40),
(115, 'Africa/Bangui', 41),
(116, 'Africa/Brazzaville', 42),
(117, 'Europe/Zurich', 43),
(118, 'Africa/Abidjan', 44),
(119, 'Pacific/Rarotonga', 45),
(120, 'America/Santiago', 46),
(121, 'Pacific/Easter', 46),
(122, 'Africa/Douala', 47),
(123, 'Asia/Chongqing', 48),
(124, 'Asia/Harbin', 48),
(125, 'Asia/Kashgar', 48),
(126, 'Asia/Shanghai', 48),
(127, 'Asia/Urumqi', 48),
(128, 'America/Bogota', 49),
(129, 'America/Costa_Rica', 50),
(130, 'America/Havana', 51),
(131, 'Atlantic/Cape_Verde', 52),
(132, 'America/Curacao', 53),
(133, 'Indian/Christmas', 54),
(134, 'Asia/Nicosia', 55),
(135, 'Europe/Prague', 56),
(136, 'Europe/Berlin', 57),
(137, 'Europe/Busingen', 57),
(138, 'Africa/Djibouti', 58),
(139, 'Europe/Copenhagen', 59),
(140, 'America/Dominica', 60),
(141, 'America/Santo_Domingo', 61),
(142, 'Africa/Algiers', 62),
(143, 'America/Guayaquil', 63),
(144, 'Pacific/Galapagos', 63),
(145, 'Europe/Tallinn', 64),
(146, 'Africa/Cairo', 65),
(147, 'Africa/El_Aaiun', 66),
(148, 'Africa/Asmara', 67),
(149, 'Africa/Ceuta', 68),
(150, 'Atlantic/Canary', 68),
(151, 'Europe/Madrid', 68),
(152, 'Africa/Addis_Ababa', 69),
(153, 'Europe/Helsinki', 71),
(154, 'Pacific/Fiji', 72),
(155, 'Atlantic/Stanley', 73),
(156, 'Pacific/Chuuk', 74),
(157, 'Pacific/Kosrae', 74),
(158, 'Pacific/Pohnpei', 74),
(159, 'Atlantic/Faroe', 75),
(160, 'Europe/Paris', 76),
(161, 'Africa/Libreville', 77),
(162, 'Europe/London', 78),
(163, 'America/Grenada', 79),
(164, 'Asia/Tbilisi', 80),
(165, 'America/Cayenne', 81),
(166, 'Europe/Guernsey', 82),
(167, 'Africa/Accra', 83),
(168, 'Europe/Gibraltar', 84),
(169, 'America/Danmarkshavn', 85),
(170, 'America/Godthab', 85),
(171, 'America/Scoresbysund', 85),
(172, 'America/Thule', 85),
(173, 'Africa/Banjul', 86),
(174, 'Africa/Conakry', 87),
(175, 'America/Guadeloupe', 88),
(176, 'Africa/Malabo', 89),
(177, 'Europe/Athens', 90),
(178, 'Atlantic/South_Georgia', 91),
(179, 'America/Guatemala', 92),
(180, 'Pacific/Guam', 93),
(181, 'Africa/Bissau', 94),
(182, 'America/Guyana', 95),
(183, 'Asia/Hong_Kong', 96),
(184, 'America/Tegucigalpa', 98),
(185, 'Europe/Zagreb', 99),
(186, 'America/Port-au-Prince', 100),
(187, 'Europe/Budapest', 101),
(188, 'Asia/Jakarta', 102),
(189, 'Asia/Jayapura', 102),
(190, 'Asia/Makassar', 102),
(191, 'Asia/Pontianak', 102),
(192, 'Europe/Dublin', 103),
(193, 'Asia/Jerusalem', 104),
(194, 'Europe/Isle_of_Man', 105),
(195, 'Asia/Kolkata', 106),
(196, 'Indian/Chagos', 107),
(197, 'Asia/Baghdad', 108),
(198, 'Asia/Tehran', 109),
(199, 'Atlantic/Reykjavik', 110),
(200, 'Europe/Rome', 111),
(201, 'Europe/Jersey', 112),
(202, 'America/Jamaica', 113),
(203, 'Asia/Amman', 114),
(204, 'Asia/Tokyo', 115),
(205, 'Africa/Nairobi', 116),
(206, 'Asia/Bishkek', 117),
(207, 'Asia/Phnom_Penh', 118),
(208, 'Pacific/Enderbury', 119),
(209, 'Pacific/Kiritimati', 119),
(210, 'Pacific/Tarawa', 119),
(211, 'Indian/Comoro', 120),
(212, 'America/St_Kitts', 121),
(213, 'Asia/Pyongyang', 122),
(214, 'Asia/Seoul', 123),
(215, 'Asia/Kuwait', 124),
(216, 'America/Cayman', 125),
(217, 'Asia/Almaty', 126),
(218, 'Asia/Aqtau', 126),
(219, 'Asia/Aqtobe', 126),
(220, 'Asia/Oral', 126),
(221, 'Asia/Qyzylorda', 126),
(222, 'Asia/Vientiane', 127),
(223, 'Asia/Beirut', 128),
(224, 'America/St_Lucia', 129),
(225, 'Europe/Vaduz', 130),
(226, 'Asia/Colombo', 131),
(227, 'Africa/Monrovia', 132),
(228, 'Africa/Maseru', 133),
(229, 'Europe/Vilnius', 134),
(230, 'Europe/Luxembourg', 135),
(231, 'Europe/Riga', 136),
(232, 'Africa/Tripoli', 137),
(233, 'Africa/Casablanca', 138),
(234, 'Europe/Monaco', 139),
(235, 'Europe/Chisinau', 140),
(236, 'Europe/Podgorica', 141),
(237, 'America/Marigot', 142),
(238, 'Indian/Antananarivo', 143),
(239, 'Pacific/Kwajalein', 144),
(240, 'Pacific/Majuro', 144),
(241, 'Europe/Skopje', 145),
(242, 'Africa/Bamako', 146),
(243, 'Asia/Rangoon', 147),
(244, 'Asia/Choibalsan', 148),
(245, 'Asia/Hovd', 148),
(246, 'Asia/Ulaanbaatar', 148),
(247, 'Asia/Macau', 149),
(248, 'Pacific/Saipan', 150),
(249, 'America/Martinique', 151),
(250, 'Africa/Nouakchott', 152),
(251, 'America/Montserrat', 153),
(252, 'Europe/Malta', 154),
(253, 'Indian/Mauritius', 155),
(254, 'Indian/Maldives', 156),
(255, 'Africa/Blantyre', 157),
(256, 'America/Bahia_Banderas', 158),
(257, 'America/Cancun', 158),
(258, 'America/Chihuahua', 158),
(259, 'America/Hermosillo', 158),
(260, 'America/Matamoros', 158),
(261, 'America/Mazatlan', 158),
(262, 'America/Merida', 158),
(263, 'America/Mexico_City', 158),
(264, 'America/Monterrey', 158),
(265, 'America/Ojinaga', 158),
(266, 'America/Santa_Isabel', 158),
(267, 'America/Tijuana', 158),
(268, 'Asia/Kuala_Lumpur', 159),
(269, 'Asia/Kuching', 159),
(270, 'Africa/Maputo', 160),
(271, 'Africa/Windhoek', 161),
(272, 'Pacific/Noumea', 162),
(273, 'Africa/Niamey', 163),
(274, 'Pacific/Norfolk', 164),
(275, 'Africa/Lagos', 165),
(276, 'America/Managua', 166),
(277, 'Europe/Amsterdam', 167),
(278, 'Europe/Oslo', 168),
(279, 'Asia/Kathmandu', 169),
(280, 'Pacific/Nauru', 170),
(281, 'Pacific/Niue', 171),
(282, 'Pacific/Auckland', 172),
(283, 'Pacific/Chatham', 172),
(284, 'Asia/Muscat', 173),
(285, 'America/Panama', 174),
(286, 'America/Lima', 175),
(287, 'Pacific/Gambier', 176),
(288, 'Pacific/Marquesas', 176),
(289, 'Pacific/Tahiti', 176),
(290, 'Pacific/Port_Moresby', 177),
(291, 'Asia/Manila', 178),
(292, 'Asia/Karachi', 179),
(293, 'Europe/Warsaw', 180),
(294, 'America/Miquelon', 181),
(295, 'Pacific/Pitcairn', 182),
(296, 'America/Puerto_Rico', 183),
(297, 'Asia/Gaza', 184),
(298, 'Asia/Hebron', 184),
(299, 'Atlantic/Azores', 185),
(300, 'Atlantic/Madeira', 185),
(301, 'Europe/Lisbon', 185),
(302, 'Pacific/Palau', 186),
(303, 'America/Asuncion', 187),
(304, 'Asia/Qatar', 188),
(305, 'Indian/Reunion', 189),
(306, 'Europe/Bucharest', 190),
(307, 'Europe/Belgrade', 191),
(308, 'Asia/Anadyr', 192),
(309, 'Asia/Irkutsk', 192),
(310, 'Asia/Kamchatka', 192),
(311, 'Asia/Khandyga', 192),
(312, 'Asia/Krasnoyarsk', 192),
(313, 'Asia/Magadan', 192),
(314, 'Asia/Novokuznetsk', 192),
(315, 'Asia/Novosibirsk', 192),
(316, 'Asia/Omsk', 192),
(317, 'Asia/Sakhalin', 192),
(318, 'Asia/Ust-Nera', 192),
(319, 'Asia/Vladivostok', 192),
(320, 'Asia/Yakutsk', 192),
(321, 'Asia/Yekaterinburg', 192),
(322, 'Europe/Kaliningrad', 192),
(323, 'Europe/Moscow', 192),
(324, 'Europe/Samara', 192),
(325, 'Europe/Volgograd', 192),
(326, 'Africa/Kigali', 193),
(327, 'Asia/Riyadh', 194),
(328, 'Pacific/Guadalcanal', 195),
(329, 'Indian/Mahe', 196),
(330, 'Africa/Khartoum', 197),
(331, 'Europe/Stockholm', 198),
(332, 'Asia/Singapore', 199),
(333, 'Atlantic/St_Helena', 200),
(334, 'Europe/Ljubljana', 201),
(335, 'Arctic/Longyearbyen', 202),
(336, 'Europe/Bratislava', 203),
(337, 'Africa/Freetown', 204),
(338, 'Europe/San_Marino', 205),
(339, 'Africa/Dakar', 206),
(340, 'Africa/Mogadishu', 207),
(341, 'America/Paramaribo', 208),
(342, 'Africa/Juba', 209),
(343, 'Africa/Sao_Tome', 210),
(344, 'America/El_Salvador', 211),
(345, 'America/Lower_Princes', 212),
(346, 'Asia/Damascus', 213),
(347, 'Africa/Mbabane', 214),
(348, 'America/Grand_Turk', 215),
(349, 'Africa/Ndjamena', 216),
(350, 'Indian/Kerguelen', 217),
(351, 'Africa/Lome', 218),
(352, 'Asia/Bangkok', 219),
(353, 'Asia/Dushanbe', 220),
(354, 'Pacific/Fakaofo', 221),
(355, 'Asia/Dili', 222),
(356, 'Asia/Ashgabat', 223),
(357, 'Africa/Tunis', 224),
(358, 'Pacific/Tongatapu', 225),
(359, 'Europe/Istanbul', 226),
(360, 'America/Port_of_Spain', 227),
(361, 'Pacific/Funafuti', 228),
(362, 'Asia/Taipei', 229),
(363, 'Africa/Dar_es_Salaam', 230),
(364, 'Europe/Kiev', 231),
(365, 'Europe/Simferopol', 231),
(366, 'Europe/Uzhgorod', 231),
(367, 'Europe/Zaporozhye', 231),
(368, 'Africa/Kampala', 232),
(369, 'Pacific/Johnston', 233),
(370, 'Pacific/Midway', 233),
(371, 'Pacific/Wake', 233),
(372, 'America/Adak', 234),
(373, 'America/Anchorage', 234),
(374, 'America/Boise', 234),
(375, 'America/Chicago', 234),
(376, 'America/Denver', 234),
(377, 'America/Detroit', 234),
(378, 'America/Indiana/Indianapolis', 234),
(379, 'America/Indiana/Knox', 234),
(380, 'America/Indiana/Marengo', 234),
(381, 'America/Indiana/Petersburg', 234),
(382, 'America/Indiana/Tell_City', 234),
(383, 'America/Indiana/Vevay', 234),
(384, 'America/Indiana/Vincennes', 234),
(385, 'America/Indiana/Winamac', 234),
(386, 'America/Juneau', 234),
(387, 'America/Kentucky/Louisville', 234),
(388, 'America/Kentucky/Monticello', 234),
(389, 'America/Los_Angeles', 234),
(390, 'America/Menominee', 234),
(391, 'America/Metlakatla', 234),
(392, 'America/New_York', 234),
(393, 'America/Nome', 234),
(394, 'America/North_Dakota/Beulah', 234),
(395, 'America/North_Dakota/Center', 234),
(396, 'America/North_Dakota/New_Salem', 234),
(397, 'America/Phoenix', 234),
(398, 'America/Shiprock', 234),
(399, 'America/Sitka', 234),
(400, 'America/Yakutat', 234),
(401, 'Pacific/Honolulu', 234),
(402, 'America/Montevideo', 235),
(403, 'Asia/Samarkand', 236),
(404, 'Asia/Tashkent', 236),
(405, 'Europe/Vatican', 237),
(406, 'America/St_Vincent', 238),
(407, 'America/Caracas', 239),
(408, 'America/Tortola', 240),
(409, 'America/St_Thomas', 241),
(410, 'Asia/Ho_Chi_Minh', 242),
(411, 'Pacific/Efate', 243),
(412, 'Pacific/Wallis', 244),
(413, 'Pacific/Apia', 245),
(414, 'Asia/Aden', 246),
(415, 'Indian/Mayotte', 247),
(416, 'Africa/Johannesburg', 248),
(417, 'Africa/Lusaka', 249),
(418, 'Africa/Harare', 250),
(419, 'Australia/Canberra', 13),
(420, 'Australia/NSW', 13),
(421, 'Australia/North', 13),
(422, 'Australia/Queensland', 13),
(423, 'Australia/South', 13),
(424, 'Australia/Tasmania', 13),
(425, 'Australia/Victoria', 13),
(426, 'Australia/West', 13),
(427, 'Chile/Continental', 46),
(428, 'America/Indianapolis', 234);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `user_phone` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_role_id` int(5) NOT NULL,
  `user_pass` varchar(32) CHARACTER SET utf8 NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0' COMMENT '1 = active, 0 = inactive',
  `banned` int(1) NOT NULL DEFAULT '0' COMMENT '1 = banned, 0 = active',
  `user_from` datetime NOT NULL,
  `subscription_id` int(5) NOT NULL DEFAULT '0',
  `subscription_start` text COLLATE utf8_unicode_ci NOT NULL,
  `subscription_end` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_role_id`, `user_pass`, `active`, `banned`, `user_from`, `subscription_id`, `subscription_start`, `subscription_end`) VALUES
(1, 'Super Admin', 'superadmin@demo.com', '', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '2016-01-04 00:00:00', 0, '', '');

--
-- Triggers `users`
--
CREATE TRIGGER `after_delete_user` AFTER DELETE ON `users` FOR EACH ROW DELETE FROM result WHERE user_id = OLD.user_id;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(5) NOT NULL,
  `user_role_name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_role_name`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Moderator'),
(4, 'Teacher'),
(5, 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ans_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`),
  ADD UNIQUE KEY `code` (`country_code`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_audios`
--
ALTER TABLE `course_audios`
  ADD PRIMARY KEY (`audio_id`);

--
-- Indexes for table `course_docs`
--
ALTER TABLE `course_docs`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `course_ppts`
--
ALTER TABLE `course_ppts`
  ADD PRIMARY KEY (`ppt_id`);

--
-- Indexes for table `course_sections`
--
ALTER TABLE `course_sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`),
  ADD UNIQUE KEY `code` (`currency_code`);

--
-- Indexes for table `exam_title`
--
ALTER TABLE `exam_title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `faq_grp`
--
ALTER TABLE `faq_grp`
  ADD PRIMARY KEY (`faq_grp_id`);

--
-- Indexes for table `feature_list`
--
ALTER TABLE `feature_list`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `messages_reply`
--
ALTER TABLE `messages_reply`
  ADD PRIMARY KEY (`message_reply_id`);

--
-- Indexes for table `noticeboard`
--
ALTER TABLE `noticeboard`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `paypal_settings`
--
ALTER TABLE `paypal_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_table`
--
ALTER TABLE `price_table`
  ADD PRIMARY KEY (`price_table_id`);

--
-- Indexes for table `puchase_history`
--
ALTER TABLE `puchase_history`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ques_id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`ans_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`ques_id`);

--
-- Indexes for table `quiz_title`
--
ALTER TABLE `quiz_title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezone`
--
ALTER TABLE `timezone`
  ADD PRIMARY KEY (`timezone_id`),
  ADD KEY `name` (`timezone_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `ans_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_audios`
--
ALTER TABLE `course_audios`
  MODIFY `audio_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_docs`
--
ALTER TABLE `course_docs`
  MODIFY `doc_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_ppts`
--
ALTER TABLE `course_ppts`
  MODIFY `ppt_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_sections`
--
ALTER TABLE `course_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_videos`
--
ALTER TABLE `course_videos`
  MODIFY `video_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;
--
-- AUTO_INCREMENT for table `exam_title`
--
ALTER TABLE `exam_title`
  MODIFY `title_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq_grp`
--
ALTER TABLE `faq_grp`
  MODIFY `faq_grp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feature_list`
--
ALTER TABLE `feature_list`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages_reply`
--
ALTER TABLE `messages_reply`
  MODIFY `message_reply_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `noticeboard`
--
ALTER TABLE `noticeboard`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `pay_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paypal_settings`
--
ALTER TABLE `paypal_settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price_table`
--
ALTER TABLE `price_table`
  MODIFY `price_table_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `puchase_history`
--
ALTER TABLE `puchase_history`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ques_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `ans_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `ques_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_title`
--
ALTER TABLE `quiz_title`
  MODIFY `title_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `result_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timezone`
--
ALTER TABLE `timezone`
  MODIFY `timezone_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
