-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2020 at 12:08 PM
-- Server version: 5.7.29-log
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joshuana_formula`
--

-- --------------------------------------------------------

--
-- Table structure for table `mstr_formula`
--

CREATE TABLE `mstr_formula` (
  `id_submit_formula` int(11) NOT NULL,
  `formula_name` varchar(100) DEFAULT NULL,
  `formula_desc` varchar(300) DEFAULT NULL,
  `formula_status` varchar(10) DEFAULT NULL,
  `formula_last_modified` datetime DEFAULT NULL,
  `id_last_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstr_formula`
--

INSERT INTO `mstr_formula` (`id_submit_formula`, `formula_name`, `formula_desc`, `formula_status`, `formula_last_modified`, `id_last_modified`) VALUES
(2, 'A. PEKERJAAN PERSIAPAN', 'Bedeng', 'ACTIVE', '2020-04-06 12:08:27', 3),
(4, 'B. PEKERJAAN TANAH DAN PONDASI', 'Pondasi batu kali', 'ACTIVE', '2020-04-06 13:57:48', NULL),
(5, 'C. PEKERJAAN STRUKTUR', 'Beton', 'ACTIVE', '2020-04-06 14:00:42', NULL),
(6, 'D. PEKERJAAN DINDING', 'Pasang batu bata', 'ACTIVE', '2020-04-06 14:01:53', NULL),
(7, 'E. PEKERJAAN PLAFOND', 'Rangka atap', 'ACTIVE', '2020-04-07 10:05:31', NULL),
(8, 'F. PEKERJAAN LANTAI', 'Beton', 'ACTIVE', '2020-04-06 14:14:46', NULL),
(9, 'G. PEKERJAAN CAT', 'Cat tembok dalam', 'ACTIVE', '2020-04-07 10:10:34', NULL),
(10, 'H. PEKERJAAN KUSEN PINTU DAN JENDELA', 'Pintu full panel solid', 'ACTIVE', '2020-04-07 10:11:40', NULL),
(11, 'I. PEKERJAAN LISTRIK', 'Titik lampu', 'ACTIVE', '2020-04-07 10:12:53', NULL),
(12, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 1/2\"', 'ACTIVE', '2020-04-07 10:14:04', NULL),
(13, 'K. PEKERJAAN WC', 'Pasang closet', 'ACTIVE', '2020-04-07 10:30:40', NULL),
(14, 'PEKERJAAN DAPUR BERSIH DAN KOTOR', 'PEKERJAAN DAPUR BERSIH DAN KOTOR', 'ACTIVE', '2020-04-06 11:37:33', 4),
(15, 'PEKERJAAN LAIN-LAIN', 'PEKERJAAN LAIN-LAIN', 'ACTIVE', '2020-04-06 11:39:00', 4),
(16, 'A. PEKERJAAN PERSIAPAN', 'Pagar sementara', 'ACTIVE', '2020-04-06 12:09:07', 3),
(17, 'A. PEKERJAAN PERSIAPAN', 'Pasang bouwplank', 'ACTIVE', '2020-04-06 12:09:29', 3),
(18, 'A. PEKERJAAN PERSIAPAN', 'Pembuatan sumur jetpump', 'ACTIVE', '2020-04-06 12:10:37', 3),
(19, 'A. PEKERJAAN PERSIAPAN', 'Air dan listrik kerja', 'ACTIVE', '2020-04-06 12:10:21', 3),
(20, 'A. PEKERJAAN PERSIAPAN', 'Biaya kuli turun', 'ACTIVE', '2020-04-06 12:10:54', 3),
(21, 'A. PEKERJAAN PERSIAPAN', 'Iuran keamanan proyek', 'ACTIVE', '2020-04-06 12:11:08', 3),
(22, 'B. PEKERJAAN TANAH DAN PONDASI', 'Galian tanah lunak', 'ACTIVE', '2020-04-06 13:57:10', NULL),
(23, 'B. PEKERJAAN TANAH DAN PONDASI', 'Urugan pasir', 'ACTIVE', '2020-04-06 13:58:06', NULL),
(24, 'B. PEKERJAAN TANAH DAN PONDASI', 'Pembesian', 'ACTIVE', '2020-04-06 13:58:18', NULL),
(25, 'B. PEKERJAAN TANAH DAN PONDASI', 'Beton', 'ACTIVE', '2020-04-06 13:58:32', NULL),
(26, 'B. PEKERJAAN TANAH DAN PONDASI', 'Bekisting sloof', 'ACTIVE', '2020-04-06 13:58:49', NULL),
(27, 'B. PEKERJAAN TANAH DAN PONDASI', 'Urugan sirtu', 'ACTIVE', '2020-04-06 13:59:01', NULL),
(28, 'C. PEKERJAAN STRUKTUR', 'Pembesian', 'ACTIVE', '2020-04-06 14:00:53', NULL),
(29, 'C. PEKERJAAN STRUKTUR', 'Bekisting kolom', 'ACTIVE', '2020-04-06 14:01:04', NULL),
(30, 'C. PEKERJAAN STRUKTUR', 'Kolom praktis', 'ACTIVE', '2020-04-06 14:01:18', NULL),
(31, 'D. PEKERJAAN DINDING', 'Pasang celcon blok', 'ACTIVE', '2020-04-06 14:02:09', NULL),
(32, 'D. PEKERJAAN DINDING', 'Plesteran bata', 'ACTIVE', '2020-04-06 14:02:31', NULL),
(33, 'D. PEKERJAAN DINDING', 'Acian bata', 'ACTIVE', '2020-04-06 14:04:07', NULL),
(34, 'E. PEKERJAAN PLAFOND', 'Pasang genteng', 'ACTIVE', '2020-04-07 10:05:41', NULL),
(35, 'E. PEKERJAAN PLAFOND', 'Pasang alumunium foil', 'ACTIVE', '2020-04-07 10:05:53', NULL),
(36, 'E. PEKERJAAN PLAFOND', 'Rangka plafond', 'ACTIVE', '2020-04-07 10:06:14', NULL),
(37, 'E. PEKERJAAN PLAFOND', 'Pasang gypsum', 'ACTIVE', '2020-04-07 10:06:33', NULL),
(38, 'E. PEKERJAAN PLAFOND', 'Pasang profil gypsum', 'ACTIVE', '2020-04-07 10:06:43', NULL),
(39, 'F. PEKERJAAN LANTAI', 'Pasang keramik', 'ACTIVE', '2020-04-06 14:15:02', NULL),
(40, 'F. PEKERJAAN LANTAI', 'Pasang granit', 'ACTIVE', '2020-04-06 14:15:11', NULL),
(41, 'F. PEKERJAAN LANTAI', 'Pasang plint keramik', 'ACTIVE', '2020-04-06 14:15:35', NULL),
(42, 'F. PEKERJAAN LANTAI', 'Pasang plint granit', 'ACTIVE', '2020-04-06 14:15:47', NULL),
(43, 'G. PEKERJAAN CAT', 'Cat tembok luar', 'ACTIVE', '2020-04-07 10:10:42', NULL),
(44, 'G. PEKERJAAN CAT', 'Cat kusen melamik', 'ACTIVE', '2020-04-07 10:10:50', NULL),
(45, 'G. PEKERJAAN CAT', 'Cat pintu melamik', 'ACTIVE', '2020-04-07 10:10:59', NULL),
(46, 'H. PEKERJAAN KUSEN PINTU DAN JENDELA', 'Kunci pintu', 'ACTIVE', '2020-04-07 10:11:53', NULL),
(47, 'H. PEKERJAAN KUSEN PINTU DAN JENDELA', 'Engsel pintu', 'ACTIVE', '2020-04-07 10:12:03', NULL),
(48, 'H. PEKERJAAN KUSEN PINTU DAN JENDELA', 'Pintu PVC', 'ACTIVE', '2020-04-07 10:12:19', NULL),
(49, 'H. PEKERJAAN KUSEN PINTU DAN JENDELA', 'Handle pintu', 'ACTIVE', '2020-04-07 10:12:30', NULL),
(50, 'I. PEKERJAAN LISTRIK', 'Titik stop kontak biasa', 'ACTIVE', '2020-04-07 10:13:02', NULL),
(51, 'I. PEKERJAAN LISTRIK', 'Titik stop kontak khusus', 'ACTIVE', '2020-04-07 10:13:10', NULL),
(52, 'I. PEKERJAAN LISTRIK', 'Box sekering MCB', 'ACTIVE', '2020-04-07 10:13:19', NULL),
(53, 'I. PEKERJAAN LISTRIK', 'Pasang saklar single', 'ACTIVE', '2020-04-07 10:13:27', NULL),
(54, 'I. PEKERJAAN LISTRIK', 'Pasang saklar double', 'ACTIVE', '2020-04-07 10:13:36', NULL),
(55, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 3/4\"', 'ACTIVE', '2020-04-07 10:14:21', NULL),
(56, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 1\"', 'ACTIVE', '2020-04-07 10:14:28', NULL),
(57, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 1 1/4\"', 'ACTIVE', '2020-04-07 10:14:36', NULL),
(58, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 1 1/2\"', 'ACTIVE', '2020-04-07 10:14:44', NULL),
(59, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 2\"', 'ACTIVE', '2020-04-07 10:14:53', NULL),
(60, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 2 1/2\"', 'ACTIVE', '2020-04-07 10:15:01', NULL),
(61, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 3\"', 'ACTIVE', '2020-04-07 10:15:09', NULL),
(62, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 4\"', 'ACTIVE', '2020-04-07 10:15:18', NULL),
(63, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC AW 6\"', 'ACTIVE', '2020-04-07 10:15:27', NULL),
(64, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 1/2\"', 'ACTIVE', '2020-04-07 10:15:44', NULL),
(65, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 3/4\"', 'ACTIVE', '2020-04-07 10:16:04', NULL),
(66, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 1\"', 'ACTIVE', '2020-04-07 10:16:15', NULL),
(67, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 1 1/4\"', 'ACTIVE', '2020-04-07 10:16:32', NULL),
(68, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 1 1/2\"', 'ACTIVE', '2020-04-07 10:16:42', NULL),
(69, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 2\"', 'ACTIVE', '2020-04-07 10:16:55', NULL),
(70, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 2 1/2\"', 'ACTIVE', '2020-04-07 10:17:08', NULL),
(71, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 3\"', 'ACTIVE', '2020-04-07 10:17:21', NULL),
(72, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 4\"', 'ACTIVE', '2020-04-07 10:17:36', NULL),
(73, 'J. PEKERJAAN INSTALASI AIR', 'Pemipaan PVC D 6\"', 'ACTIVE', '2020-04-07 10:18:31', NULL),
(74, 'J. PEKERJAAN INSTALASI AIR', 'Pasang floor drain', 'ACTIVE', '2020-04-07 10:18:20', NULL),
(75, 'J. PEKERJAAN INSTALASI AIR', 'Pasang kran', 'ACTIVE', '2020-04-07 10:18:09', NULL),
(76, 'J. PEKERJAAN INSTALASI AIR', 'Pasang septic tank', 'ACTIVE', '2020-04-07 10:17:57', NULL),
(77, 'J. PEKERJAAN INSTALASI AIR', 'Pembuatan bak kontrol', 'ACTIVE', '2020-04-07 10:17:46', NULL),
(78, 'K. PEKERJAAN WC', 'Pasang washtafel', 'ACTIVE', '2020-04-07 10:31:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mstr_formula`
--
ALTER TABLE `mstr_formula`
  ADD PRIMARY KEY (`id_submit_formula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mstr_formula`
--
ALTER TABLE `mstr_formula`
  MODIFY `id_submit_formula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
