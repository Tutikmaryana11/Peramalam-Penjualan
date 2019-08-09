-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 09, 2019 at 07:32 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `satuan_barang` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `tgl_update` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `nama_barang`, `merk`, `harga_beli`, `harga_jual`, `satuan_barang`, `stok`, `tgl_input`, `tgl_update`) VALUES
('BR001', 1, 'Pensil', 'Fabel Castel', '1000', '2000', 'PCS', 99719, '7 May 2017, 10:34', '7 May 2017, 10:35'),
('BR002', 5, 'sabun lifeboy', 'lifeboy', '2000', '3000', 'PCS', 0, '7 May 2017, 10:52', '23 June 2019, 23:15');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `no_nota` varchar(10) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag_bayar` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `no_nota`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`, `flag_bayar`) VALUES
(26, '1', 'BR001', 1, '2', '4000', '2019-07-09 16:38:59', 'Y'),
(30, '2', 'BR001', 1, '2', '4000', '2019-08-09 16:47:24', 'Y'),
(31, '3', 'BR001', 1, '2', '4000', '2019-09-09 16:47:44', 'Y'),
(33, '4', 'BR001', 1, '1', '2000', '2019-07-10 00:38:18', 'Y'),
(34, '5', 'BR001', 1, '1', '2000', '2019-07-10 00:38:41', 'Y'),
(35, '6', 'BR001', 1, '1', '2000', '2019-07-10 00:39:00', 'Y'),
(36, '7', 'BR001', 1, '1', '2000', '2019-07-10 00:39:19', 'Y'),
(37, '8', 'BR001', 1, '3', '6000', '2019-07-10 00:39:37', 'Y'),
(38, '9', 'BR001', 1, '3', '6000', '2019-07-10 00:39:54', 'Y'),
(39, '10', 'BR001', 1, '7', '14000', '2019-07-10 00:40:13', 'Y'),
(41, '11', 'BR001', 1, '2', '4000', '2019-07-10 01:58:46', 'Y'),
(42, '12', 'BR001', 1, '2', '4000', '2019-07-10 01:59:03', 'Y'),
(43, '13', 'BR001', 1, '1', '2000', '2019-07-10 02:11:22', 'Y'),
(46, '14', 'BR002', 1, '1', '3000', '2019-07-10 02:22:43', 'Y');

--
-- Triggers `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER UPDATE ON `detail_penjualan` FOR EACH ROW UPDATE barang SET stok=stok-NEW.jumlah where id_barang=NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peramalan`
--

CREATE TABLE `detail_peramalan` (
  `id_detailperamalan` int(11) NOT NULL,
  `id_peramalan` int(11) NOT NULL,
  `bulan` varchar(30) NOT NULL,
  `tahun` year(4) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `prediksi_penjualan` int(11) NOT NULL,
  `eror` float NOT NULL,
  `erorpositif` float NOT NULL,
  `erorpangkat` float NOT NULL,
  `erorpersen` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_peramalan`
--

INSERT INTO `detail_peramalan` (`id_detailperamalan`, `id_peramalan`, `bulan`, `tahun`, `penjualan`, `prediksi_penjualan`, `eror`, `erorpositif`, `erorpangkat`, `erorpersen`) VALUES
(1, 1, 'Juli', 2019, 2, 0, 0, 0, 0, 0),
(2, 1, 'Agustus', 2019, 2, 2, 0, 0, 0, 0),
(3, 1, 'September', 2019, 2, 2, 0, 0, 0, 0),
(4, 2, 'Juli', 2019, 24, 0, 0, 0, 0, 0),
(5, 2, 'Agustus', 2019, 2, 24, -22, 22, 484, 1100),
(6, 2, 'September', 2019, 2, 2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hasilperamalan`
--

CREATE TABLE `hasilperamalan` (
  `id_peramalan` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `pergerakan` int(11) NOT NULL,
  `mse` float NOT NULL,
  `mad` float NOT NULL,
  `mape` float NOT NULL,
  `hasil_peramalan` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasilperamalan`
--

INSERT INTO `hasilperamalan` (`id_peramalan`, `tgl_awal`, `tgl_akhir`, `pergerakan`, `mse`, `mad`, `mape`, `hasil_peramalan`, `nama_barang`, `id_member`) VALUES
(1, '2019-07-01', '2019-10-31', 1, 0, 0, 0, 2, 'Pensil', 0),
(2, '0000-00-00', '2019-11-14', 1, 242, 11, 550, 2, 'Pensil', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tgl_input`) VALUES
(1, 'ATK', '7 May 2017, 10:23'),
(5, 'Sabun', '7 May 2017, 10:28');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`, `id_member`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nm_member` varchar(255) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `NIK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nm_member`, `alamat_member`, `telepon`, `email`, `gambar`, `NIK`) VALUES
(1, 'Admin', 'Admin', '089618173609', 'admin@gamil.com', 'download.png', '12314121');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(10) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `total`, `tanggal_input`) VALUES
(1, '4000', '2019-07-09 16:38:59'),
(2, '4000', '2019-07-09 16:47:24'),
(3, '4000', '2019-07-09 16:47:44'),
(4, '2000', '2019-07-10 00:38:18'),
(5, '2000', '2019-07-10 00:38:41'),
(6, '2000', '2019-07-10 00:39:00'),
(7, '2000', '2019-07-10 00:39:19'),
(8, '6000', '2019-07-10 00:39:37'),
(9, '6000', '2019-07-10 00:39:54'),
(10, '14000', '2019-07-10 00:40:13'),
(11, '4000', '2019-07-10 01:58:46'),
(12, '4000', '2019-07-10 01:59:03'),
(13, '2000', '2019-07-10 02:11:22'),
(14, '3000', '2019-07-10 02:22:43');

--
-- Triggers `penjualan`
--
DELIMITER $$
CREATE TRIGGER `update_flag` AFTER INSERT ON `penjualan` FOR EACH ROW UPDATE detail_penjualan set flag_bayar='Y' WHERE no_nota=NEW.id_penjualan
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `detail_peramalan`
--
ALTER TABLE `detail_peramalan`
  ADD PRIMARY KEY (`id_detailperamalan`);

--
-- Indexes for table `hasilperamalan`
--
ALTER TABLE `hasilperamalan`
  ADD PRIMARY KEY (`id_peramalan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `detail_peramalan`
--
ALTER TABLE `detail_peramalan`
  MODIFY `id_detailperamalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hasilperamalan`
--
ALTER TABLE `hasilperamalan`
  MODIFY `id_peramalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
