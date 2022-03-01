-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 02:26 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kayu`
--

-- --------------------------------------------------------

--
-- Table structure for table `det_kayu_keluar`
--

CREATE TABLE `det_kayu_keluar` (
  `id_detkk` varchar(20) NOT NULL,
  `id_kk` varchar(20) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `id_kayu` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `det_kayu_keluar`
--

INSERT INTO `det_kayu_keluar` (`id_detkk`, `id_kk`, `jumlah`, `id_kayu`, `status`) VALUES
('220202200018', '220202200027', 1, 'KY-001', '1');

-- --------------------------------------------------------

--
-- Table structure for table `det_kayu_masuk`
--

CREATE TABLE `det_kayu_masuk` (
  `id_detkm` varchar(20) NOT NULL,
  `id_km` varchar(20) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `id_kayu` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `det_kayu_masuk`
--

INSERT INTO `det_kayu_masuk` (`id_detkm`, `id_km`, `jumlah`, `id_kayu`, `status`) VALUES
('220202200301', '220202200256', 1, 'KY-001', '1'),
('220202200304', '220202200256', 1, 'KY-002', '1'),
('220202200310', '220202200306', 1, 'KY-002', '1'),
('220202200312', '220202200306', 1, 'KY-001', '1');

-- --------------------------------------------------------

--
-- Table structure for table `det_produk_keluar`
--

CREATE TABLE `det_produk_keluar` (
  `id_detpk` varchar(20) NOT NULL,
  `id_pk` varchar(20) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `id_produk` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `det_produk_masuk`
--

CREATE TABLE `det_produk_masuk` (
  `id_detpm` varchar(20) NOT NULL,
  `id_pm` varchar(20) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `id_produk` varchar(20) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kayu`
--

CREATE TABLE `kayu` (
  `id_kayu` varchar(20) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `kwalitas` varchar(20) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `rp` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kayu`
--

INSERT INTO `kayu` (`id_kayu`, `nama`, `jenis`, `kwalitas`, `stok`, `satuan`, `rp`) VALUES
('KY-001', 'kayuuu', 'Jati lokal', 'A1', 5, 'm3', 1),
('KY-002', 'kayu2', 'Jati lokal', 'A1', 2, 'm3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kayu_keluar`
--

CREATE TABLE `kayu_keluar` (
  `id_kk` varchar(20) NOT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `user` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kayu_keluar`
--

INSERT INTO `kayu_keluar` (`id_kk`, `tanggal`, `user`) VALUES
('220202200018', '2022-02-02 13:00:29', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kayu_masuk`
--

CREATE TABLE `kayu_masuk` (
  `id_km` varchar(20) NOT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `user` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kayu_masuk`
--

INSERT INTO `kayu_masuk` (`id_km`, `tanggal`, `user`) VALUES
('220202200256', '2022-02-02 13:03:06', 'admin'),
('220202200306', '2022-02-02 13:03:14', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(20) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `jenis`, `keterangan`, `harga`, `stok`) VALUES
('PRD-001', 'asdas', 'Jati lokal', '123', 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk_keluar`
--

CREATE TABLE `produk_keluar` (
  `id_pk` varchar(20) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk_masuk`
--

CREATE TABLE `produk_masuk` (
  `id_pm` varchar(20) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_telpon` varchar(12) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `password`, `nama`, `no_telpon`, `jabatan`) VALUES
('admin', '202cb962ac59075b964b07152d234b70', 'pardiyo', '081562827782', 'admin'),
('owner', '202cb962ac59075b964b07152d234b70', 'paijo', '120851025', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `det_kayu_keluar`
--
ALTER TABLE `det_kayu_keluar`
  ADD PRIMARY KEY (`id_detkk`),
  ADD KEY `id_kk` (`id_kk`),
  ADD KEY `id_kayu` (`id_kayu`);

--
-- Indexes for table `det_kayu_masuk`
--
ALTER TABLE `det_kayu_masuk`
  ADD PRIMARY KEY (`id_detkm`),
  ADD KEY `id_km` (`id_km`),
  ADD KEY `id_kayu` (`id_kayu`);

--
-- Indexes for table `det_produk_keluar`
--
ALTER TABLE `det_produk_keluar`
  ADD PRIMARY KEY (`id_detpk`),
  ADD KEY `id_pk` (`id_pk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `det_produk_masuk`
--
ALTER TABLE `det_produk_masuk`
  ADD PRIMARY KEY (`id_detpm`),
  ADD KEY `id_pm` (`id_pm`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kayu`
--
ALTER TABLE `kayu`
  ADD PRIMARY KEY (`id_kayu`);

--
-- Indexes for table `kayu_keluar`
--
ALTER TABLE `kayu_keluar`
  ADD PRIMARY KEY (`id_kk`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `kayu_masuk`
--
ALTER TABLE `kayu_masuk`
  ADD PRIMARY KEY (`id_km`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD PRIMARY KEY (`id_pk`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD PRIMARY KEY (`id_pm`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `det_kayu_keluar`
--
ALTER TABLE `det_kayu_keluar`
  ADD CONSTRAINT `det_kayu_keluar_ibfk_2` FOREIGN KEY (`id_kayu`) REFERENCES `kayu` (`id_kayu`);

--
-- Constraints for table `det_kayu_masuk`
--
ALTER TABLE `det_kayu_masuk`
  ADD CONSTRAINT `det_kayu_masuk_ibfk_2` FOREIGN KEY (`id_kayu`) REFERENCES `kayu` (`id_kayu`);

--
-- Constraints for table `det_produk_keluar`
--
ALTER TABLE `det_produk_keluar`
  ADD CONSTRAINT `det_produk_keluar_ibfk_1` FOREIGN KEY (`id_pk`) REFERENCES `produk_keluar` (`id_pk`),
  ADD CONSTRAINT `det_produk_keluar_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `det_produk_masuk`
--
ALTER TABLE `det_produk_masuk`
  ADD CONSTRAINT `det_produk_masuk_ibfk_1` FOREIGN KEY (`id_pm`) REFERENCES `produk_masuk` (`id_pm`),
  ADD CONSTRAINT `det_produk_masuk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `kayu_keluar`
--
ALTER TABLE `kayu_keluar`
  ADD CONSTRAINT `kayu_keluar_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`user`);

--
-- Constraints for table `kayu_masuk`
--
ALTER TABLE `kayu_masuk`
  ADD CONSTRAINT `kayu_masuk_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`user`);

--
-- Constraints for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD CONSTRAINT `produk_keluar_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`user`);

--
-- Constraints for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD CONSTRAINT `produk_masuk_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
