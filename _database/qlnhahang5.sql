-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 06:14 AM
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
  `trangthaiban` tinyint(1) NOT NULL DEFAULT 0
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
  `dongia_cthd` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`mahd`, `mamon`, `soluong`, `dongia_cthd`) VALUES
(10, 1, 1, '35000.00'),
(10, 17, 1, '4690000.00'),
(10, 34, 1, '21000.00'),
(15, 1, 24, '35000.00'),
(15, 9, 1, '189000.00'),
(15, 12, 2, '79000.00'),
(15, 14, 1, '21000.00'),
(15, 21, 2, '119000.00'),
(15, 28, 2, '439000.00'),
(15, 36, 14, '24000.00'),
(15, 38, 10, '15000.00'),
(15, 39, 12, '15000.00'),
(16, 1, 24, '35000.00'),
(16, 8, 2, '179000.00'),
(16, 14, 10, '21000.00'),
(16, 28, 2, '439000.00'),
(17, 1, 46, '35000.00'),
(18, 37, 20, '21000.00'),
(19, 1, 10, '35000.00'),
(20, 32, 1, '25000.00'),
(21, 13, 1, '26000.00'),
(22, 1, 20, '35000.00');

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `machucvu` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `tenchucvu` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`machucvu`, `tenchucvu`, `quyen`) VALUES
('GD', 'Giám Đốc', 1),
('NV', 'Nhân Viên', 5),
('TN', 'Thu Ngân', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `mahd` int(11) NOT NULL,
  `manv` int(5) NOT NULL,
  `ngaylaphd` datetime NOT NULL,
  `ngaysuahd` datetime NOT NULL,
  `soban` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenkh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sdt` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giovao` time NOT NULL,
  `giora` time NOT NULL,
  `chietkhau` tinyint(2) NOT NULL,
  `tongtien` decimal(10,2) NOT NULL,
  `tinhtrang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dononline` tinyint(1) NOT NULL DEFAULT 0,
  `ghichu` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `manv`, `ngaylaphd`, `ngaysuahd`, `soban`, `tenkh`, `sdt`, `diachi`, `giovao`, `giora`, `chietkhau`, `tongtien`, `tinhtrang`, `dononline`, `ghichu`) VALUES
(10, 1, '2021-02-23 16:25:12', '2021-02-23 16:25:12', NULL, 'Ngô Trung Tiến', '0397059907', 'Xã Trị An, Vĩnh Cửu, Đồng Nai', '16:25:12', '16:25:12', 0, '4746000.00', 'Đã thanh toán', 1, 'Đừng có giao đồ ăn, Đặt cho vui thôi'),
(15, 1, '2021-03-02 14:32:08', '2021-03-02 14:32:08', NULL, 'Nguyễn Duy Thái', '0347697232', 'Tổ 7C KP3, Tân Hiệp, Biên Hòa, Đồng Nai', '14:32:08', '14:32:08', 0, '2990000.00', 'Chưa thanh toán', 1, NULL),
(16, 1, '2021-03-02 14:33:02', '2021-03-02 14:33:02', NULL, 'Ngô Trung Tiến', '0397059907', 'Cổng UBND Xã Trị An, Vĩnh Cửu, Đồng Nai', '14:33:02', '14:33:02', 0, '2286000.00', 'Đang xử lý', 1, NULL),
(17, 1, '2021-03-02 14:34:28', '2021-03-02 14:34:28', NULL, 'Nguyễn Duy Thái', '0347697232', 'Tổ 7C KP3, Tân Hiệp, Biên Hòa, Đồng Nai', '14:34:28', '14:34:28', 0, '1610000.00', 'Đang xử lý', 1, NULL),
(18, 1, '2021-03-02 14:35:56', '2021-03-02 14:35:56', NULL, 'Nguyễn Duy Thái', '0347697232', 'Tổ 7C KP3, Tân Hiệp, Biên Hòa, Đồng Nai', '14:35:56', '14:35:56', 0, '420000.00', 'Đang xử lý', 1, NULL),
(19, 1, '2021-03-02 14:40:39', '2021-03-02 14:40:39', NULL, 'Ngô Trung Tiến', '0397059907', 'Cổng UBND Xã Trị An, Vĩnh Cửu, Đồng Nai', '14:40:39', '14:40:39', 0, '350000.00', 'Đang xử lý', 1, NULL),
(20, 1, '2021-03-02 14:42:51', '2021-03-02 14:42:51', NULL, 'Nguyễn Duy Thái', '0347697232', 'Tổ 7C KP3, Tân Hiệp, Biên Hòa, Đồng Nai', '14:42:51', '14:42:51', 0, '25000.00', 'Đang xử lý', 1, NULL),
(21, 1, '2021-03-02 14:43:26', '2021-03-02 14:43:26', NULL, 'Nguyễn Duy Thái', '0347697232', 'Tổ 7C KP3, Tân Hiệp, Biên Hòa, Đồng Nai', '14:43:26', '14:43:26', 0, '26000.00', 'Đang xử lý', 1, NULL),
(22, 1, '2021-03-02 14:46:35', '2021-03-02 14:46:35', NULL, 'Phạm Hoàng Quân', '0123456789', '123 KP4 phường 5, TP Biên Hòa, Tỉnh 89', '14:46:35', '14:46:35', 0, '700000.00', 'Đang xử lý', 1, NULL);

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
('BIA', 'Bia'),
('CUA', 'Cua'),
('DANGIAN', 'Món Ăn Dân Gian'),
('GHE', 'Ghẹ'),
('LAU', 'Lẩu'),
('MI', 'Mì'),
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
  `dongia` decimal(10,2) NOT NULL,
  `hinh` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `monan`
--

INSERT INTO `monan` (`mamon`, `tenmon`, `maloai`, `dongia`, `hinh`) VALUES
(1, 'Heineken Chai', 'BIA', '35000.00', 'images/monan/HEINEKEN_CHAI.jpg'),
(2, 'Heineken Lon', 'BIA', '29000.00', 'images/monan/HEINEKEN_LON.jpg'),
(5, 'Rượu chuối hột (500ml)', 'RUOU', '49000.00', 'images/monan/ruou-chuoi-hot.jpg'),
(6, 'Cua Cà Mau thịt hấp bia', 'CUA', '279000.00', 'images/monan/cua_hap_bia.jpg'),
(7, 'Cua Cà Mau thịt nướng mọi', 'CUA', '259000.00', 'images/monan/cua_nuong_moi.jpg'),
(8, 'Lẩu thái', 'LAU', '179000.00', 'images/monan/lau_thai.jpg'),
(9, 'Lẩu hải sản', 'LAU', '189000.00', 'images/monan/lau-hai-san.jpg'),
(10, 'Lẩu tôm', 'LAU', '179000.00', 'images/monan/lau-tom.jpg'),
(11, 'Lươn hấp sả', 'DANGIAN', '149000.00', 'images/monan/luon-hap-sa.jpg'),
(12, 'Vodka Men (500ml)', 'RUOU', '79000.00', 'images/monan/Vodka-Men-500ml.jpg'),
(13, 'Tiger chai lớn (640ml)', 'BIA', '26000.00', 'images/monan/bia-tiger-chai-lon-640ml.jpeg'),
(14, 'Tiger chai nhỏ (330ml)', 'BIA', '21000.00', 'images/monan/bia-tiger-chai-nho-330ml.jpeg'),
(15, 'Cua Cà Mau thịt rang me', 'CUA', '269000.00', 'images/monan/cua-rang-me.jpg'),
(16, 'Hennessy XO (1L)', 'RUOU', '4190000.00', 'images/monan/Hennessy-XO-1L.jpg'),
(17, 'Hennessy XO Duluxe Offer 2021 (700ml)', 'RUOU', '4690000.00', 'images/monan/Hennessy-XO-Duluxe-offer-2021-700ml.jpg'),
(18, 'Johnnie Walker Blue Label 200th Anniversary Limited Edition (750ml)', 'RUOU', '6090000.00', 'images/monan/johnnie-walker-blue-label-200th-anniversary-limited-edition-750ml.jpg'),
(19, 'Royal Salute 21YO Signature Blend Red New Year (700ml)', 'RUOU', '2490000.00', 'images/monan/royal-salute-21yo-signature-blend-red-new-year-700ml.jpg'),
(20, 'Rượu Trâu Single Malt 15YO Whisky King Arthur (750ml)', 'RUOU', '1290000.00', 'images/monan/ruou-trau-single-malt-15yo-whisky-king-arthur-750ml.jpg'),
(21, 'Mỳ Ý sợi dẹt sốt hải sản', 'MI', '119000.00', 'images/monan/my-y-soi-det-sot-hai-san.jpg'),
(22, 'Mì xào hải sản', 'MI', '79000.00', 'images/monan/mi-xao-hai-san.jpg'),
(23, 'Rượu Nhân Sâm Hàn Quốc (2.4l)', 'RUOU', '2290000.00', 'images/monan/ruou-nhan-sam-han-quoc-2.4l.jpg'),
(24, 'Ketel One Citroen (700ml)', 'RUOU', '790000.00', 'images/monan/ketel-one-citroen-700ml.jpg'),
(25, 'Vodka Ciroc (200ml)', 'RUOU', '549000.00', 'images/monan/vodka-ciroc-200ml.jpg'),
(26, 'Ballantine\'s Series 001 The Glenburgie 18YO (700ml)', 'RUOU', '2290000.00', 'images/monan/ballantines-series-001-the-glenburgie-18YO-700ml.jpg'),
(27, 'Ballantine\'s 12YO (700ml)', 'RUOU', '609000.00', 'images/monan/ballantines-12YO-700ml.jpg'),
(28, 'Ghẹ hấp', 'GHE', '439000.00', 'images/monan/ghe-hap.jpg'),
(29, 'Ghẹ nướng mọi', 'GHE', '449000.00', 'images/monan/ghe-nuong-moi.png'),
(30, 'Ghẹ sốt me', 'GHE', '449000.00', 'images/monan/ghe-sot-me.jpg'),
(31, 'Càng ghẹ rang me', 'GHE', '249000.00', 'images/monan/cang-ghe-rang-me.jpg'),
(32, 'Coronita Extra (210ml)', 'BIA', '25000.00', 'images/monan/bia-coronita-extra-210ml.jpg'),
(33, 'Budweiser Lon (500ml)', 'BIA', '26000.00', 'images/monan/budweiser-lon-500ml.jpg'),
(34, 'Budweiser Chai (330ml)', 'BIA', '21000.00', 'images/monan/budweiser-chai-330ml.jpg'),
(35, 'Sapporo Lon (650ml)', 'BIA', '64000.00', 'images/monan/sapporo-lon-650ml.jpg'),
(36, 'Beck\'s Ice lon (330ml)', 'BIA', '24000.00', 'images/monan/becks-ice-lon-330ml.jpg'),
(37, 'Strongbow chai (330ml)', 'BIA', '21000.00', 'images/monan/strongbow-chai.jpg'),
(38, 'CocaCola lon (330ml)', 'NUOCGK', '15000.00', 'images/monan/coca-cola-lon-330ml.jpg'),
(39, '7UP lon (330ml)', 'NUOCGK', '15000.00', 'images/monan/7up-lon-330ml.jpg'),
(40, 'Sprite Chanh lon (330ml)', 'NUOCGK', '15000.00', 'images/monan/sprite-chanh-lon-330ml.jpg'),
(41, 'Mirinda Soda Kem lon (330ml)', 'NUOCGK', '15000.00', 'images/monan/mirinda-soda-kem-lon-330ml.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` int(5) NOT NULL,
  `ho` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phai` tinyint(1) NOT NULL DEFAULT 1,
  `ngaysinh` date NOT NULL,
  `chungminhthu` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `machucvu` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `ho`, `ten`, `phai`, `ngaysinh`, `chungminhthu`, `sdt`, `diachi`, `machucvu`) VALUES
(1, 'Lê Phi', 'Thạch', 1, '2000-06-30', '111111111', '0929626424', 'TT.Vĩnh An, Vĩnh Cửu, Đồng Nai', 'GD'),
(2, 'Nguyễn Đỗ', 'Phúc', 1, '1997-10-07', '124145741', '0975079581', 'An Hảo, Biên Hòa, Đồng Nai', 'NV'),
(3, 'Trịnh Duy Tuấn', 'Anh', 1, '1999-10-17', '147542457', '0942990706', 'Trảng Dài, Biên Hòa, Đồng Nai', 'NV');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `stt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`stt`) VALUES
(1),
(2);

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
  ADD KEY `mahd` (`mahd`,`mamon`),
  ADD KEY `mamon` (`mamon`);

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`machucvu`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `soban` (`soban`),
  ADD KEY `manv` (`manv`);

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
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`),
  ADD KEY `machucvu` (`machucvu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `mahd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `mahd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `monan`
--
ALTER TABLE `monan`
  MODIFY `mamon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `manv` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`soban`) REFERENCES `ban` (`soban`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `monan`
--
ALTER TABLE `monan`
  ADD CONSTRAINT `monan_ibfk_1` FOREIGN KEY (`maloai`) REFERENCES `loaimon` (`maloai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`machucvu`) REFERENCES `chucvu` (`machucvu`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;