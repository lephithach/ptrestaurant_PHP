-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 07:39 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlnhahang`
--

-- --------------------------------------------------------

--
-- Table structure for table `ban`
--

CREATE TABLE `ban` (
  `soban` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tenban` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `trangthaiban` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ban`
--

INSERT INTO `ban` (`soban`, `tenban`, `trangthaiban`) VALUES
('01', 'Bàn 01', 0),
('02', 'Bàn 02', 0),
('03', 'Bàn 03', 0),
('04', 'Bàn 04', 0),
('05', 'Bàn 05', 0),
('06', 'Bàn 06', 0),
('07', 'Bàn 07', 0),
('08', 'Bàn 08', 0),
('09', 'Bàn 09', 0),
('10', 'Bàn 10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `mahd` int(11) NOT NULL,
  `mamon` int(11) NOT NULL,
  `soluong` tinyint(4) NOT NULL,
  `dongia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `mahd` int(11) NOT NULL,
  `ngaylaphd` date NOT NULL,
  `soban` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `giovao` time NOT NULL,
  `giora` time NOT NULL,
  `chietkhau` tinyint(4) NOT NULL,
  `tongtien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaimon`
--

CREATE TABLE `loaimon` (
  `maloai` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tenloai` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaimon`
--

INSERT INTO `loaimon` (`maloai`, `tenloai`) VALUES
('BIACACLOAI', 'Bia các loại'),
('CUA', 'Cua'),
('DANGIAN', 'Món Ăn Dân Gian'),
('GHE', 'Ghẹ'),
('LAU', 'Lẩu'),
('MONANNHANH', 'Món Ăn Nhanh'),
('MUC', 'Mực'),
('NUOCGK', 'Nước Giải Khát'),
('RUOU', 'Rượu'),
('XAO_NUONG', 'Xào - Nướng');

-- --------------------------------------------------------

--
-- Table structure for table `monan`
--

CREATE TABLE `monan` (
  `mamon` int(11) NOT NULL,
  `tenmon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `maloai` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dongia` int(11) NOT NULL,
  `hinh` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `monan`
--

INSERT INTO `monan` (`mamon`, `tenmon`, `maloai`, `dongia`, `hinh`) VALUES
(1, 'HEINEKEN (CHAI)', 'BIACACLOAI', 20000, 'images/monan/HEINEKEN_CHAI.jpg'),
(2, 'HEINEKEN (LON)', 'BIACACLOAI', 25000, 'images/monan/HEINEKEN_LON.jpg'),
(5, 'Rượu chuối hột (500ml)', 'RUOU', 50000, 'images/monan/ruou-chuoi-hot.jpg'),
(6, 'Cua hấp bia', 'CUA', 299000, 'images/monan/cua_hap_bia.jpg'),
(7, 'Cua nướng mọi', 'CUA', 199000, 'images/monan/cua_nuong_moi.jpg'),
(8, 'Lẩu thái', 'LAU', 179000, 'images/monan/lau_thai.jpg'),
(9, 'Lẩu hải sản', 'LAU', 189000, 'images/monan/lau-hai-san.jpg'),
(10, 'Lẩu tôm', 'LAU', 179000, 'images/monan/lau-tom.jpg'),
(11, 'Lươn hấp sả', 'DANGIAN', 149000, 'images/monan/luon-hap-sa.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`soban`);

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `mahd` (`mahd`,`mamon`),
  ADD KEY `mamon` (`mamon`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `soban` (`soban`);

--
-- Indexes for table `loaimon`
--
ALTER TABLE `loaimon`
  ADD PRIMARY KEY (`maloai`);

--
-- Indexes for table `monan`
--
ALTER TABLE `monan`
  ADD PRIMARY KEY (`mamon`),
  ADD KEY `maloai` (`maloai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `mahd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `mahd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monan`
--
ALTER TABLE `monan`
  MODIFY `mamon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`mamon`) REFERENCES `monan` (`mamon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`soban`) REFERENCES `ban` (`soban`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monan`
--
ALTER TABLE `monan`
  ADD CONSTRAINT `monan_ibfk_1` FOREIGN KEY (`maloai`) REFERENCES `loaimon` (`maloai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
