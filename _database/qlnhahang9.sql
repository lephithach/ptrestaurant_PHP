-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 12:22 PM
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
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `manv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `manv`) VALUES
('lephithach', 'ebaaa0dd67640853e258b3a2a214b15f', 1);

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
(27, 6, 2, '279000.00'),
(27, 12, 1, '79000.00'),
(27, 26, 1, '2290000.00'),
(28, 5, 1, '49000.00'),
(28, 7, 1, '259000.00'),
(28, 11, 1, '149000.00'),
(29, 6, 2, '279000.00'),
(29, 8, 1, '179000.00'),
(29, 9, 1, '189000.00'),
(29, 10, 1, '179000.00'),
(29, 17, 1, '4690000.00'),
(29, 17, 1, '4690000.00'),
(28, 6, 1, '279000.00'),
(28, 12, 1, '79000.00'),
(28, 28, 1, '439000.00'),
(28, 5, 2, '49000.00'),
(28, 6, 2, '279000.00'),
(28, 7, 6, '259000.00'),
(28, 10, 2, '179000.00'),
(28, 12, 1, '79000.00'),
(28, 21, 1, '119000.00'),
(28, 37, 1, '21000.00'),
(29, 11, 1, '149000.00'),
(29, 12, 1, '79000.00'),
(29, 15, 1, '269000.00'),
(29, 26, 1, '2290000.00'),
(28, 11, 8, '149000.00'),
(28, 12, 1, '79000.00'),
(28, 26, 1, '2290000.00'),
(29, 6, 1, '279000.00'),
(29, 7, 1, '259000.00'),
(29, 26, 1, '2290000.00'),
(29, 31, 1, '249000.00'),
(29, 25, 1, '549000.00'),
(29, 5, 1, '49000.00'),
(29, 6, 1, '279000.00'),
(29, 16, 1, '4190000.00'),
(29, 25, 1, '549000.00'),
(29, 17, 1, '4690000.00'),
(29, 19, 1, '2490000.00'),
(29, 41, 1, '15000.00'),
(31, 14, 1, '21000.00'),
(31, 15, 1, '269000.00'),
(31, 36, 1, '24000.00'),
(32, 6, 1, '279000.00'),
(32, 10, 1, '179000.00'),
(32, 11, 1, '149000.00'),
(32, 15, 1, '269000.00'),
(33, 22, 1, '79000.00'),
(33, 26, 1, '2290000.00'),
(33, 27, 1, '609000.00'),
(33, 28, 1, '439000.00'),
(34, 5, 30, '49000.00'),
(34, 27, 3, '609000.00'),
(34, 33, 30, '26000.00'),
(35, 6, 1, '279000.00'),
(35, 10, 1, '179000.00'),
(35, 11, 1, '149000.00'),
(35, 10, 1, '179000.00'),
(35, 17, 1, '4690000.00'),
(35, 26, 1, '2290000.00'),
(35, 37, 1, '21000.00'),
(36, 2, 1, '29000.00'),
(36, 5, 1, '49000.00'),
(36, 6, 1, '279000.00'),
(36, 7, 1, '259000.00'),
(37, 7, 4, '259000.00'),
(37, 11, 4, '149000.00'),
(38, 7, 1, '259000.00'),
(39, 7, 1, '259000.00'),
(39, 8, 1, '179000.00'),
(39, 9, 1, '189000.00'),
(39, 12, 4, '79000.00'),
(39, 37, 48, '21000.00'),
(40, 16, 1, '4190000.00'),
(40, 17, 2, '4690000.00'),
(40, 26, 2, '2290000.00'),
(41, 7, 1, '259000.00'),
(41, 21, 1, '119000.00'),
(41, 22, 2, '79000.00'),
(41, 30, 2, '449000.00'),
(41, 36, 24, '24000.00'),
(42, 11, 1, '149000.00'),
(42, 13, 24, '26000.00'),
(42, 21, 1, '119000.00'),
(43, 7, 1, '259000.00'),
(43, 11, 1, '149000.00'),
(43, 15, 6, '269000.00'),
(44, 36, 1, '24000.00'),
(45, 6, 1, '279000.00'),
(45, 7, 1, '259000.00'),
(45, 10, 12, '179000.00'),
(45, 12, 12, '79000.00');

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `machucvu` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `tenchucvu` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`machucvu`, `tenchucvu`) VALUES
('GD', 'Giám Đốc'),
('NV', 'Nhân Viên'),
('TN', 'Thu Ngân');

-- --------------------------------------------------------

--
-- Table structure for table `gopy`
--

CREATE TABLE `gopy` (
  `id` int(11) NOT NULL,
  `thoigian` datetime NOT NULL,
  `hoten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci NOT NULL,
  `loai` tinyint(1) NOT NULL COMMENT '0: góp ý, 1: khiếu nại'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gopy`
--

INSERT INTO `gopy` (`id`, `thoigian`, `hoten`, `sdt`, `email`, `noidung`, `loai`) VALUES
(1, '2021-04-28 13:57:12', 'Lê Phi Thạch', '0347697232', 'jokivadet@gmail.com', 'Test', 0),
(2, '2021-04-06 14:11:40', 'Lê Phi Thạch', '0347697232', 'lephithach00@gmail.com', '- Có như không có\n- Không có như có\n- Có và không có\n- Có có không không', 0),
(3, '2021-04-06 14:31:47', 'Trương Văn Thi', '0397059907', 'thitaolao@taolao.com', 'Nhà hàng ngon quá', 0),
(4, '2021-04-06 14:33:46', 'Nguyễn Duy Thái', '0397059907', 'ee@gmail.com', 'Ngon quá', 1);

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
  `vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tongtien` decimal(10,2) NOT NULL,
  `tinhtrang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `khachdua` int(11) DEFAULT NULL,
  `trakhach` int(11) DEFAULT NULL,
  `dononline` tinyint(1) NOT NULL DEFAULT 0,
  `ghichu` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `manv`, `ngaylaphd`, `ngaysuahd`, `soban`, `tenkh`, `sdt`, `diachi`, `giovao`, `giora`, `chietkhau`, `vat`, `tongtien`, `tinhtrang`, `khachdua`, `trakhach`, `dononline`, `ghichu`) VALUES
(27, 1, '2021-03-23 15:11:10', '2021-03-26 14:03:06', '05', NULL, NULL, NULL, '15:11:10', '15:11:10', 0, '2665500.00', '3219700.00', 'Đã thanh toán', 5000000, 1780300, 0, NULL),
(28, 1, '2021-03-23 15:12:26', '2021-03-26 14:02:26', '07', NULL, NULL, NULL, '15:12:26', '15:12:26', 2, '2665500.00', '8194956.00', 'Đã thanh toán', 10000000, 1805044, 0, NULL),
(29, 1, '2021-03-23 15:15:59', '2021-03-26 13:59:35', '09', NULL, NULL, NULL, '15:15:59', '21:22:02', 1, '2916000.00', '31755240.00', 'Đã thanh toán', 35000000, 3244760, 0, NULL),
(31, 1, '2021-03-26 14:06:15', '2021-03-26 14:07:01', '01', NULL, NULL, NULL, '14:06:15', '14:06:15', 0, '31400.00', '345400.00', 'Đã thanh toán', 345400, 0, 0, NULL),
(32, 1, '2021-03-26 14:11:49', '2021-03-26 14:12:13', '01', NULL, NULL, NULL, '14:11:49', '14:11:49', 0, '87600.00', '963600.00', 'Đã thanh toán', 1000000, 36400, 0, NULL),
(33, 1, '2021-03-26 14:13:40', '2021-03-26 14:13:49', '02', NULL, NULL, NULL, '14:13:40', '14:13:40', 0, '341700.00', '3758700.00', 'Đã thanh toán', 4000000, 241300, 0, NULL),
(34, 1, '2021-03-26 14:28:17', '2021-03-26 14:35:32', '02', NULL, NULL, NULL, '14:28:17', '14:35:32', 0, '407700.00', '4484700.00', 'Đã thanh toán', 4484700, 0, 0, NULL),
(35, 1, '2021-03-26 14:31:34', '2021-03-26 14:32:29', '01', NULL, NULL, NULL, '14:31:34', '14:32:29', 0, '778700.00', '8565700.00', 'Đã thanh toán', 8565700, 0, 0, NULL),
(36, 1, '2021-03-26 14:44:23', '2021-03-26 14:49:05', '01', NULL, NULL, NULL, '14:44:23', '14:49:05', 0, '61600.00', '677600.00', 'Đã thanh toán', 677600, 0, 0, NULL),
(37, 1, '2021-03-26 14:50:08', '2021-03-26 14:52:20', '02', NULL, NULL, NULL, '14:50:08', '14:52:20', 0, '163200.00', '1795200.00', 'Đã thanh toán', 1795200, 0, 0, NULL),
(38, 1, '2021-03-26 14:52:26', '2021-03-26 14:52:34', '02', NULL, NULL, NULL, '14:52:26', '14:52:34', 0, '25900.00', '284900.00', 'Đã thanh toán', 300000, 15100, 0, NULL),
(39, 1, '2021-03-26 16:00:23', '2021-03-26 16:01:13', '06', NULL, NULL, NULL, '16:00:23', '16:01:13', 0, '195100.00', '2146100.00', 'Đã thanh toán', 3000000, 853900, 0, NULL),
(40, 1, '2021-04-03 12:18:16', '2021-04-03 14:24:15', NULL, 'Nguyễn Thị Kim Thùy', '0337823049', 'Vĩnh An, Vĩnh Cửu, Đồng Nai', '12:18:16', '14:24:15', 0, '0.00', '18150000.00', 'Đã thanh toán', 18150000, 0, 1, NULL),
(41, 1, '2021-04-03 13:04:10', '2021-04-03 14:30:13', '09', NULL, NULL, NULL, '13:04:10', '14:30:13', 0, '201000.00', '2211000.00', 'Đã thanh toán', 3000000, 789000, 0, NULL),
(42, 1, '2021-04-03 14:28:21', '2021-04-03 14:30:51', NULL, 'Võ Tuấn Kiệt', '0344915932', 'Vĩnh An, Vĩnh Cửu, Đồng Nai', '14:28:21', '14:30:51', 2, '0.00', '874160.00', 'Đã thanh toán', 1000000, 125840, 1, NULL),
(43, 1, '2021-04-03 14:38:14', '2021-04-03 14:39:13', '04', NULL, NULL, NULL, '14:38:14', '14:39:13', 0, '202200.00', '2224200.00', 'Đã thanh toán', 2224200, 0, 0, NULL),
(44, 2, '2021-04-03 21:52:57', '2021-04-03 21:54:13', NULL, 'Lê Phi Thạch', '0347697232', 'Tổ 7C KP3, Tân Hiệp, Biên Hòa, Đồng Nai', '21:52:57', '21:54:13', 0, '0.00', '24000.00', 'Đã thanh toán', 24000, 0, 1, NULL),
(45, 1, '2021-04-06 17:18:12', '2021-04-06 17:18:29', '01', NULL, NULL, NULL, '17:18:12', '17:18:29', 0, '363400.00', '3997400.00', 'Đã thanh toán', 4000000, 2600, 0, NULL);

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
(1, 'Heineken Chai', 'BIA', '36000.00', 'images/monan/HEINEKEN_CHAI.jpg'),
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
(41, 'Mirinda Soda Kem lon (330ml)', 'NUOCGK', '15000.00', 'images/monan/mirinda-soda-kem-lon-330ml.jpg'),
(52, 'Mực nướng tiêu xanh', 'MUC', '129000.00', 'images/monan/muc-nuong-tieu.png');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` int(5) NOT NULL,
  `ho` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phai` tinyint(1) NOT NULL COMMENT '1: Nam; 0: Nữ',
  `ngaysinh` date NOT NULL,
  `chungminhthu` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `hinh` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machucvu` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `ho`, `ten`, `phai`, `ngaysinh`, `chungminhthu`, `sdt`, `diachi`, `hinh`, `machucvu`) VALUES
(1, 'Lê Phi', 'Thạch', 1, '2000-06-30', '123456789', '0929626424', 'TT.Vĩnh An, Vĩnh Cửu, Đồng Nai', 'images/AnhNhanVien/avatar.jpg', 'GD'),
(2, 'Nguyễn Đỗ', 'Phúc', 1, '1997-10-07', '123456789', '0975079581', 'An Hảo, Biên Hòa, Đồng Nai', 'images/AnhNhanVien/avatar.jpg', 'NV'),
(3, 'Trịnh Duy Tuấn', 'Anh', 1, '1999-10-17', '147542457', '0942990706', 'Trảng Dài, Biên Hòa, Đồng Nai', 'images/AnhNhanVien/avatar.jpg', 'NV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

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
-- Indexes for table `gopy`
--
ALTER TABLE `gopy`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `mahd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `gopy`
--
ALTER TABLE `gopy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `mahd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `monan`
--
ALTER TABLE `monan`
  MODIFY `mamon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
