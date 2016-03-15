-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2016 at 05:35 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `check_point`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(3) unsigned NOT NULL,
  `year_id` int(2) NOT NULL,
  `semester_id` int(1) NOT NULL,
  `class_name` varchar(100) DEFAULT NULL,
  `class_code` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `teacher` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `year_id`, `semester_id`, `class_name`, `class_code`, `link`, `teacher`) VALUES
(1, 1, 1, 'Cơ - Nhiệt', 'PHY1100 6', NULL, 'PGS.TS.Hoàng Nam Nhật'),
(2, 1, 1, 'Đại số', 'MAT1093 1', NULL, 'Viện toán'),
(3, 1, 1, 'Giải tích 1', 'MAT1094 6', NULL, 'ThS.Nguyễn Văn Quang'),
(4, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 7', NULL, 'ThS.Lê Thị Vinh'),
(5, 1, 1, 'Tiếng Anh A1', 'FLF1105 13', NULL, 'ĐHNN'),
(6, 1, 1, 'Tiếng Anh A1', 'FLF1105 14', NULL, 'ĐHNN'),
(7, 1, 1, 'Tiếng Anh A1', 'FLF1105 15', NULL, 'ĐHNN'),
(8, 1, 1, 'Tin học cơ sở 1', 'INT1003 7', NULL, 'Khoa Công nghệ Thông tin'),
(9, 1, 1, 'Cơ - Nhiệt', 'PHY1100 7', NULL, 'PGS.TS.Nguyễn Anh Tuấn'),
(10, 1, 1, 'Đại số', 'MAT1093 2', NULL, 'Viện toán'),
(11, 1, 1, 'Giải tích 1', 'MAT1094 7', NULL, 'ThS.Nguyễn Quang Vinh'),
(12, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 8', NULL, 'ThS.Lê Thị Vinh'),
(13, 1, 1, 'Tiếng Anh A1', 'FLF1105 16', NULL, 'ĐHNN'),
(14, 1, 1, 'Tiếng Anh A1', 'FLF1105 17', NULL, 'ĐHNN'),
(15, 1, 1, 'Tiếng Anh A1', 'FLF1105 18', NULL, 'ĐHNN'),
(16, 1, 1, 'INT1003 8', 'INT1003 8', NULL, 'ThS.Hoàng Thị Ngọc Trang'),
(17, 1, 1, 'Cơ - Nhiệt', 'PHY1100 8', NULL, 'TS.Đặng Đình Long'),
(18, 1, 1, 'Đại số', 'MAT1093 3', NULL, 'Viện toán'),
(19, 1, 1, 'Giải tích 1', 'MAT1094 8', NULL, 'PGS.TS.Nguyễn Việt Khoa'),
(20, 1, 1, 'Tiếng Anh A1', 'FLF1105 19', NULL, 'ĐHNN'),
(21, 1, 1, 'Tiếng Anh A1', 'FLF1105 20', NULL, 'ĐHNN'),
(22, 1, 1, 'Tin học cơ sở 1', 'INT1003 9', NULL, 'TS.Nguyễn Văn Nam'),
(23, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 1', NULL, 'TS.Nguyễn Thanh Huyền'),
(24, 1, 1, 'Cơ - Nhiệt', 'PHY1100 1', NULL, 'PGS.TS.Hoàng Nam Nhật'),
(25, 1, 1, 'Giải tích 1', 'MAT1094 1', NULL, 'PGS.TS.Nguyễn Việt Khoa'),
(26, 1, 1, 'Tiếng Anh A1', 'FLF1105 1', NULL, 'ĐHNN'),
(27, 1, 1, 'Tiếng Anh A1', 'FLF1105 2', NULL, 'ĐHNN'),
(28, 1, 1, 'Tiếng Anh A1', 'FLF1105 3', NULL, 'ĐHNN'),
(29, 1, 1, 'Tin học cơ sở 1', 'INT1003 1', NULL, 'ThS.Đào Kiến Quốc'),
(30, 1, 1, 'Tin học cơ sở 4', 'INT1006 1', NULL, 'TS.Nguyễn Văn Vinh'),
(31, 1, 1, 'Cơ - Nhiệt', 'PHY1100 2', NULL, 'PGS.TS.Nguyễn Phương Hoài Nam'),
(32, 1, 1, 'Giải tích 1', 'MAT1094 2', NULL, 'PGS.TS.Trần Thu Hà'),
(33, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 2', NULL, 'TS.Nguyễn Thanh Huyền'),
(34, 1, 1, 'Tiếng Anh A1', 'FLF1105 4', NULL, 'ĐHNN'),
(35, 1, 1, 'Tiếng Anh A1', 'FLF1105 5', NULL, 'ĐHNN'),
(36, 1, 1, 'Tiếng Anh A1', 'FLF1105 6', NULL, 'ĐHNN'),
(37, 1, 1, 'Tin học cơ sở 1', 'INT1003 2', NULL, 'CNTT'),
(38, 1, 1, 'Tin học cơ sở 4', 'INT1006 2', NULL, 'ThS.Hồ Đắc Phương'),
(39, 1, 1, 'Cơ - Nhiệt', 'PHY1100 3', NULL, 'TS.Đinh Văn Châu'),
(40, 1, 1, 'Giải tích 1', 'MAT1094 3', NULL, 'TS.Lã Đức Việt'),
(41, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 3', NULL, 'TS.Nguyễn Thanh Huyền'),
(42, 1, 1, 'Tiếng Anh A1', 'FLF1105 7', NULL, 'ĐHNN'),
(43, 1, 1, 'Tiếng Anh A1', 'FLF1105 8', NULL, 'ĐHNN'),
(44, 1, 1, 'Tiếng Anh A1', 'FLF1105 9', NULL, 'ĐHNN'),
(45, 1, 1, 'Tin học cơ sở 1', 'INT1003 3', NULL, 'ThS.Hoàng Thị Ngọc Trang'),
(46, 1, 1, 'Tin học cơ sở 4', 'INT1006 3', NULL, 'TS.Lê Nguyên Khôi'),
(47, 1, 1, 'Cơ - Nhiệt', 'PHY1100 4', NULL, 'PGS.TS.Nguyễn Phương Hoài Nam'),
(48, 1, 1, 'Giải tích 1', 'MAT1094 4', NULL, 'ThS.Nguyễn Quang Vinh'),
(49, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 4', NULL, 'TS.Nguyễn Thái Sơn'),
(50, 1, 1, 'Tiếng Anh A1', 'FLF1105 10', NULL, 'ĐHNN'),
(51, 1, 1, 'Tiếng Anh A1', 'FLF1105 11', NULL, 'ĐHNN'),
(52, 1, 1, 'Tiếng Anh A1', 'FLF1105 12', NULL, 'ĐHNN'),
(53, 1, 1, 'Tin học cơ sở 1', 'INT1003 4', NULL, 'TS.Phạm Hồng Thái'),
(54, 1, 1, 'Tin học cơ sở 4', 'INT1006 4', NULL, 'TS.Phạm Hồng Thái'),
(55, 1, 1, 'Cơ - Nhiệt', 'PHY1100 9', NULL, 'PGS.TS.Nguyễn Thế Hiện'),
(56, 1, 1, 'Giải tích 1', 'MAT1094 9', NULL, 'TS.Hà Đức Vượng'),
(57, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 9', NULL, 'KHXHNV'),
(58, 1, 1, 'Tiếng Anh A1', 'FLF1105 21', NULL, 'Trường ĐHNN'),
(59, 1, 1, 'Tiếng Anh A1', 'FLF1105 22', NULL, 'Trường ĐHNN'),
(60, 1, 1, 'Tiếng Anh A1', 'FLF1105 23', NULL, 'Trường ĐHNN'),
(61, 1, 1, 'Tin học cơ sở 1', 'INT1003 10', NULL, 'Khoa CNTT'),
(62, 1, 1, 'Đại số', 'MAT1093 5', NULL, 'ThS.Nguyễn Nam Hải'),
(63, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 5', NULL, 'TS.Nguyễn Thái Sơn'),
(64, 1, 1, 'Tin học cơ sở 1', 'INT1003 5', NULL, 'ThS.Đào Kiến Quốc'),
(65, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 1', 'PHI1004 6', NULL, 'TS.Nguyễn Thái Sơn'),
(66, 1, 1, 'Tin học cơ sở 1', 'INT1003 6', NULL, 'TS.Phạm Hồng Thái'),
(67, 1, 1, 'Cơ học kỹ thuật 1', 'EMA2002 1', NULL, 'TS.Bùi Hồng Sơn'),
(68, 1, 1, 'Điện và Quang', 'PHY1103 6', NULL, 'TS.Đỗ Ngọc Chung'),
(69, 1, 1, 'Kỹ thuật hiển thị máy tính', 'EMA3090', NULL, 'PGS.TS.Đinh Văn Mạnh'),
(70, 1, 1, 'Matlab và ứng dụng', 'EMA2006 1', NULL, 'PGS.TS.Đặng Thế Ba'),
(71, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 2', 'PHI1005 6', NULL, 'TS.Nguyễn Thị Lan'),
(72, 1, 1, 'Phương trình đạo hàm riêng', 'EMA2001 1', NULL, 'TS.Trần Dương Trí'),
(73, 1, 1, 'Tiếng Anh B1', 'FLF1107 1', NULL, 'ĐHNN'),
(74, 1, 1, 'Tiếng Anh B1', 'FLF1107 2', NULL, 'ĐHNN'),
(75, 1, 1, 'Hình hoạ kỹ thuật và CAD', 'EMA2032', NULL, 'ThS.Hoàng Văn Mạnh'),
(76, 1, 1, 'Cơ học kỹ thuật 1', 'EMA2002 2', NULL, 'PGS.TS.Đào Như Mai'),
(77, 1, 1, 'Cơ sở kỹ thuật điện', 'EMA2026', NULL, 'PGS.TS.Chử Đức Trình'),
(78, 1, 1, 'Điện và Quang', 'PHY1103 7', NULL, 'TS.Đinh Văn Châu'),
(79, 1, 1, 'Matlab và ứng dụng', 'EMA2006 2', NULL, 'TS.Nguyễn Ngọc Linh'),
(80, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 2', 'PHI1005 5', NULL, 'TS.Nguyễn Thị La'),
(81, 1, 1, 'Tiếng Anh B1', 'FLF1107 13', NULL, 'ĐHNN'),
(82, 1, 1, 'Tiếng Anh B1', 'FLF1107 14', NULL, 'ĐHNN'),
(83, 1, 1, 'Tiếng Anh B1', 'FLF1107 15', NULL, 'ĐHNN'),
(84, 1, 1, 'Tư tưởng Hồ Chí Minh', 'POL1001 2', NULL, 'ThS.Hoàng Thị Thuận'),
(85, 1, 1, 'Tư tưởng Hồ Chí Minh', 'POL1001 6', NULL, 'ThS.Trần Bách Hiếu'),
(86, 1, 1, 'Điện và Quang', 'PHY1103 8', NULL, 'TS.Đặng Đình Long'),
(87, 1, 1, 'Các phương pháp toán lý', 'EPN2023', NULL, 'PGS.TS.Hoàng Nam Nhật'),
(88, 1, 1, 'Vật lý phân tử', 'EPN2050', NULL, 'GS.TS.Nguyễn Năng Định'),
(89, 1, 1, 'Tiếng Anh B1', 'FLF1107 16', NULL, 'ĐHNN'),
(90, 1, 1, 'Thực hành Vật lý đại cương', 'PHY1104 1', NULL, 'KHTN'),
(91, 1, 1, 'Thực hành Vật lý đại cương', 'PHY1104 2', NULL, 'KHTN'),
(92, 1, 1, 'Những nguyên lý cơ bản của chủ nghĩa  Mác – Lênin 2', 'PHI1005 4', NULL, 'PGS.TS.Phạm Công Nhất'),
(93, 1, 1, 'Cấu trúc dữ liệu và giải thuật', 'INT2203 4', NULL, 'PGS.TS.Phạm Bảo Sơn');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE IF NOT EXISTS `semesters` (
  `semester_id` int(1) NOT NULL,
  `semester_name` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `semester_name`, `active`) VALUES
(1, 'Học kỳ I', 1),
(2, 'Học kỳ I - Học kỳ phụ', NULL),
(3, 'Học kỳ II', NULL),
(4, 'Học kỳ II - Học kỳ phụ', NULL),
(5, 'Học kỳ hè', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) unsigned NOT NULL,
  `role` int(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'hung1', 'hung1@gmail.com', '$2a$10$gsBCOnPTHlfkl5Dc15GSp.KvgCqagyT2WwWjb.mYw/vXumGR715Ke', 'USJUQSKnyLmGdcXzQYxHpwDGaSfHaOVUZmHWW2Bj0Ccca2OfDmRav0YgFdZ8', NULL, '2016-03-13 09:36:16'),
(2, 2, 'Trần Trúc Mai', 'maitt@vnu.edu.vn', '$2y$10$Y3iYsJHMFSJZJtUDRVbPveTzrZ00BU8ZQmGCfKYX1I8aAtIQoPY1i', 'eJqGGrgzzKDLpEKUUtiQDxF4lyEznTbWd7XDJZyQ0U3A0o4nHGMv40qp2CKp', '2016-03-09 01:20:12', '2016-03-13 10:56:44'),
(3, 1, 'dai', 'daitd58@gmail.com', '$2y$10$nAZ5huZIU2KaeEhHB7pVvekvPmEsh4ItTzCyaOYm5yzRTVz9Og/6y', 'JMdgatQm0ELohK5xgDP3BkHKzg5BimikbbW9Vj1BjvcxezCn3Gg0c98DVsix', '2016-03-12 03:16:05', '2016-03-12 03:23:21'),
(5, 0, 'lol', 'dai@foobla.com', '$2y$10$woJpNAtQla3.KLQSISI7VOyicRSnIbPp4mUWrihM9klym67l8A5vG', NULL, '2016-03-12 10:47:31', '2016-03-12 10:47:31'),
(7, 0, 'po', 'neverfrown.95@gmail.com', '$2y$10$bCPI2JQush9zWCYc.W24ROuccCvKVeTwhJwTJaF01C93PXqW5iaAq', NULL, '2016-03-12 10:49:09', '2016-03-12 10:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE IF NOT EXISTS `years` (
  `year_id` int(2) NOT NULL,
  `year_name` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`year_id`, `year_name`, `active`) VALUES
(1, 'Năm học 2015-2016', 1),
(2, 'Năm học 2014-2015', NULL),
(3, 'Năm học 2013-2014', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`), ADD KEY `fk_semester_id` (`semester_id`), ADD KEY `fk_class_year_id` (`year_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `year_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
ADD CONSTRAINT `fk_class_year_id` FOREIGN KEY (`year_id`) REFERENCES `years` (`year_id`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
