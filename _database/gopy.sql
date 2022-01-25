-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 08:37 AM
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
-- Table structure for table `gopy`
--

CREATE TABLE `gopy` (
  `id` int(11) NOT NULL,
  `thoigian` datetime NOT NULL,
  `hoten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci NOT NULL,
  `loai` tinyint(1) NOT NULL COMMENT '0: góp ý; 1: khiếu nại'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gopy`
--

INSERT INTO `gopy` (`id`, `thoigian`, `hoten`, `sdt`, `email`, `noidung`, `loai`) VALUES
(1, '2021-04-28 13:57:12', 'Lê Phi Thạch', '0347697232', 'jokivadet@gmail.com', 'Test', 0),
(2, '2021-04-06 14:11:40', 'Lê Phi Thạch', '0347697232', 'lephithach00@gmail.com', '- Có như không có\n- Không có như có\n- Có và không có\n- Có có không không', 0),
(3, '2021-04-06 14:31:47', 'Trương Văn Thi', '0397059907', 'thitaolao@taolao.com', 'Nhà hàng ngon quá', 0),
(4, '2021-04-06 14:33:46', 'Nguyễn Duy Thái', '0397059907', 'ee@gmail.com', 'Ngon quá', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gopy`
--
ALTER TABLE `gopy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gopy`
--
ALTER TABLE `gopy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
