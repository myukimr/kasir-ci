-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 04:06 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(10) NOT NULL,
  `id_transaksi` bigint(20) NOT NULL,
  `kd_menu` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `kd_menu`, `quantity`, `catatan`) VALUES
(38, 1, '3MNM', 1, ''),
(39, 1, '2SNK', 1, ''),
(40, 1, '1MKN', 1, ''),
(41, 2, '3MNM', 1, 'hot'),
(42, 3, '1MKN', 1, 'level 2'),
(43, 4, '3MNM', 1, 'Hot'),
(44, 5, '3MNM', 2, '1 hot 1 ice'),
(45, 5, '1MKN', 1, 'cabe 3'),
(46, 6, '1MKN', 1, 'cabe 2'),
(47, 7, '3MNM', 1, 'hot'),
(48, 8, '1MKN', 1, 'cabe 4'),
(49, 9, '2SNK', 1, ''),
(50, 10, '3MNM', 1, 'hot'),
(51, 11, '3MNM', 1, 'hot'),
(52, 12, '3MNM', 1, 'ice'),
(53, 13, '2SNK', 1, ''),
(54, 14, '1MKN', 1, ''),
(55, 15, '3MNM', 1, 'hot'),
(56, 16, '1MKN', 1, ''),
(57, 16, '2SNK', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `kd_menu` varchar(10) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `harga_satuan` int(20) NOT NULL,
  `stok` int(10) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`kd_menu`, `nama_menu`, `type`, `harga_satuan`, `stok`, `img`) VALUES
('1MKN', 'Mie Tarik', 'makanan', 12000, 1, '1MKN0.jpg'),
('2SNK', 'French Fries', 'snack', 10000, 2, '2SNK0.jpg'),
('3MNM', 'Chocolate', 'minuman', 15000, 4, '3MNM1.jpg'),
('4SNK', 'Cireng', 'snack', 8000, 5, '4SNK0.jpg'),
('5SNK', 'Donat', 'snack', 12000, 5, '5SNK1.png'),
('6MNM', 'Americano', 'minuman', 15000, 5, '6MNM0.jpg'),
('7MNM', 'Cappucino', 'minuman', 12000, 5, '7MNM0.jpg'),
('8MNM', 'Espresso', 'minuman', 12000, 5, '8MNM0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) NOT NULL,
  `id_user` int(10) NOT NULL,
  `nama_customer` varchar(20) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `no_meja` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `nama_customer`, `total_harga`, `waktu`, `no_meja`) VALUES
(1, 10, 'Breng', 40700, '2020-04-30 13:59:11', 'C2'),
(2, 4, 'Yuks', 16500, '2020-05-02 08:46:01', 'C1'),
(3, 4, 'Dio', 13200, '2020-05-02 08:51:14', 'C5'),
(4, 4, 'Gio', 16500, '2020-05-02 08:52:39', 'C4'),
(5, 4, 'Dio', 46200, '2020-05-06 15:27:15', 'C2'),
(6, 4, 'Gio', 13200, '2020-05-06 15:31:41', 'C4'),
(7, 4, 'Yuks', 16500, '2020-05-06 15:33:44', 'C3'),
(8, 4, 'Dio', 13200, '2020-05-06 15:34:18', 'C3'),
(9, 4, 'Yuks', 11000, '2020-05-06 15:36:36', 'C1'),
(10, 4, 'Dio', 16500, '2020-05-06 15:39:23', 'C2'),
(11, 4, 'Gio', 16500, '2020-05-06 15:40:13', 'C2'),
(12, 4, 'Yuks', 16500, '2020-05-06 15:41:55', 'C1'),
(13, 4, 'Dio', 11000, '2020-05-06 15:45:15', 'C2'),
(14, 4, 'Yuks', 13200, '2020-05-06 15:45:43', 'C2'),
(15, 10, 'Yuks', 16500, '2020-05-07 08:49:17', 'C4'),
(16, 4, 'Yuks', 24200, '2020-05-14 09:52:07', 'C2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(10, 'yuki', 'eb855e04a20e5dbfd6d1bd14af20506b', 'user'),
(13, 'gio', '808c35293aebc74f0a68b40e88b0bde2', 'user'),
(14, 'dio', '1837149d7d4ef9a264baaeeecb5c7ae5', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kd_menu` (`kd_menu`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`kd_menu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_login` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`kd_menu`) REFERENCES `menu` (`kd_menu`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
