-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2021 at 05:21 AM
-- Server version: 10.3.31-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbcgroup_warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `jenis`, `status`) VALUES
('BRG-001', 'ART Paper', 'kertas', 'aktif'),
('BRG-002', 'Duplex', 'kertas', 'aktif'),
('BRG-003', 'Stiker', 'kertas', 'aktif'),
('BRG-004', 'barang2', 'kertas', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `berat`
--

CREATE TABLE `berat` (
  `id_berat` varchar(8) NOT NULL,
  `berat` varchar(5) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berat`
--

INSERT INTO `berat` (`id_berat`, `berat`, `status`) VALUES
('BRT-001', '85 gr', 'aktif'),
('BRT-002', '90 gr', 'aktif'),
('BRT-003', '100 g', 'aktif'),
('BRT-004', '120 g', 'aktif'),
('BRT-005', '250 g', 'aktif'),
('BRT-006', '270 g', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `bkeluar`
--

CREATE TABLE `bkeluar` (
  `id_bkeluar` varchar(15) NOT NULL,
  `id_user` varchar(20) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_gudang` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bkeluar`
--

INSERT INTO `bkeluar` (`id_bkeluar`, `id_user`, `tanggal`, `id_gudang`) VALUES
('BK-20210808-1', 'g1_admin', '2021-08-08 13:55:03', 'g1'),
('BK-20210808-3', 'g2_admin', '2021-08-08 13:56:56', 'g2'),
('BK-20210808-4', 'g1_admin', '2021-08-08 13:57:02', 'g1'),
('BK-20210814-3', 'g1_admin', '2021-08-14 13:01:49', 'g1'),
('BK-20210814-4', 'g1_admin', '2021-08-14 13:03:32', 'g1'),
('BK-20210817-1', 'g1_admin', '2021-08-17 13:50:50', 'g1'),
('BK-20210817-2', 'g2_admin', '2021-08-17 13:51:02', 'g2'),
('BK-20210818-1', 'g2_admin', '2021-08-17 23:48:20', 'g2'),
('BK-20210818-3', 'g3_admin', '2021-08-18 00:24:11', 'g3'),
('BK-20210818-5', NULL, '2021-08-18 00:25:32', 'g2'),
('BK-20210818-6', 'g1_admin', '2021-08-18 02:34:34', 'g1'),
('BK-20210818-7', NULL, '2021-08-18 02:50:27', 'g1');

-- --------------------------------------------------------

--
-- Table structure for table `bmasuk`
--

CREATE TABLE `bmasuk` (
  `id_bmasuk` varchar(25) NOT NULL,
  `id_user` varchar(20) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_gudang` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmasuk`
--

INSERT INTO `bmasuk` (`id_bmasuk`, `id_user`, `tanggal`, `id_gudang`) VALUES
('BMS-210814200101', 'g1_admin', '2021-08-14 13:01:01', 'g1'),
('BMS-210814200104', 'g2_admin', '2021-08-14 13:01:04', 'g2'),
('BMS-210816142120', NULL, '2021-08-16 07:21:20', 'g1'),
('BMS-210817125850', NULL, '2021-08-17 05:58:50', 'g2'),
('BMS-210817132743', NULL, '2021-08-17 06:27:43', 'g3'),
('DBM-210730194017', 'g1_kepgudang', '2021-07-30 12:40:17', 'g1'),
('DBM-210816141800', 'g1_kepgudang', '2021-08-16 07:18:00', 'g1'),
('DBM-210817125831', 'g2_admin', '2021-08-17 05:58:31', 'g2'),
('DBM-210817125850', 'g2_admin', '2021-08-17 05:58:50', 'g2'),
('DBM-210817132147', 'g3_admin', '2021-08-17 06:21:47', 'g3');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` varchar(8) NOT NULL,
  `brand` varchar(30) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `brand`, `status`) VALUES
('BRD-001', 'PDGC', 'aktif'),
('BRD-002', 'NL', 'aktif'),
('BRD-003', 'Papyrus', 'aktif'),
('BRD-004', 'Mega surya', 'aktif'),
('BRD-005', 'IK', 'aktif'),
('BRD-006', 'Mirror star', 'aktif'),
('BRD-007', 'Vinil', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `cr`
--

CREATE TABLE `cr` (
  `id_cr` varchar(15) NOT NULL,
  `satuan1` varchar(20) DEFAULT NULL,
  `satuan2` varchar(20) DEFAULT NULL,
  `satuan3` varchar(20) DEFAULT NULL,
  `cr1` int(11) DEFAULT NULL,
  `cr2` int(11) DEFAULT NULL,
  `cr3` int(11) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cr`
--

INSERT INTO `cr` (`id_cr`, `satuan1`, `satuan2`, `satuan3`, `cr1`, `cr2`, `cr3`, `status`) VALUES
('CR-001', 'Kardus', 'Rim', 'Lembar', 1, 5, 500, 'aktif'),
('CR-002', 'Karton', 'Buah', '', 1, 20, 0, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `detbarang`
--

CREATE TABLE `detbarang` (
  `id_detbarang` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `id_brand` varchar(8) NOT NULL,
  `id_berat` varchar(8) NOT NULL,
  `id_ukuran` varchar(15) NOT NULL,
  `id_cr` varchar(25) NOT NULL,
  `stok_base` int(11) NOT NULL,
  `stok_con1` int(11) NOT NULL,
  `stok_con2` int(11) NOT NULL,
  `id_gudang` varchar(8) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detbarang`
--

INSERT INTO `detbarang` (`id_detbarang`, `id_barang`, `id_brand`, `id_berat`, `id_ukuran`, `id_cr`, `stok_base`, `stok_con1`, `stok_con2`, `id_gudang`, `status`) VALUES
('db-001-001-001-001-001-g1', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-001', 'CR-001', 92, 4, 400, 'g1', 'aktif'),
('db-001-001-001-001-001-g2', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-001', 'CR-001', 92, 2, 300, 'g2', 'aktif'),
('db-001-001-001-001-001-g3', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-001', 'CR-001', 92, 2, 0, 'g3', 'aktif'),
('db-001-001-001-002-001-g1', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-002', 'CR-001', 90, 4, 244, 'g1', 'aktif'),
('db-001-001-001-002-001-g2', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-002', 'CR-001', 263, 0, 0, 'g2', 'aktif'),
('db-001-001-001-002-001-g3', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-002', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-001-001-001-003-001-g1', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-003', 'CR-001', 800, 0, 0, 'g1', 'aktif'),
('db-001-001-001-003-001-g2', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-003', 'CR-001', 100, 0, 0, 'g2', 'aktif'),
('db-001-001-001-003-001-g3', 'BRG-001', 'BRD-001', 'BRT-001', 'UKR-003', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-001-002-001-002-001-g1', 'BRG-001', 'BRD-002', 'BRT-001', 'UKR-002', 'CR-001', 830, 0, 0, 'g1', 'aktif'),
('db-001-002-001-002-001-g2', 'BRG-001', 'BRD-002', 'BRT-001', 'UKR-002', 'CR-001', 70, 0, 0, 'g2', 'aktif'),
('db-001-002-001-002-001-g3', 'BRG-001', 'BRD-002', 'BRT-001', 'UKR-002', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-001-002-001-005-001-g1', 'BRG-001', 'BRD-002', 'BRT-001', 'UKR-005', 'CR-001', 844, 0, 0, 'g1', 'aktif'),
('db-001-002-001-005-001-g2', 'BRG-001', 'BRD-002', 'BRT-001', 'UKR-005', 'CR-001', 56, 0, 0, 'g2', 'aktif'),
('db-001-002-001-005-001-g3', 'BRG-001', 'BRD-002', 'BRT-001', 'UKR-005', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-001-002-004-003-001-g1', 'BRG-001', 'BRD-002', 'BRT-004', 'UKR-003', 'CR-001', 44, 0, 0, 'g1', 'aktif'),
('db-001-002-004-003-001-g2', 'BRG-001', 'BRD-002', 'BRT-004', 'UKR-003', 'CR-001', 78, 0, 0, 'g2', 'aktif'),
('db-001-002-004-003-001-g3', 'BRG-001', 'BRD-002', 'BRT-004', 'UKR-003', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-002-003-001-003-001-g1', 'BRG-002', 'BRD-003', 'BRT-001', 'UKR-003', 'CR-001', 78, 0, 0, 'g1', 'aktif'),
('db-002-003-001-003-001-g2', 'BRG-002', 'BRD-003', 'BRT-001', 'UKR-003', 'CR-001', 52, 0, 0, 'g2', 'aktif'),
('db-002-003-001-003-001-g3', 'BRG-002', 'BRD-003', 'BRT-001', 'UKR-003', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-002-003-005-004-001-g1', 'BRG-002', 'BRD-003', 'BRT-005', 'UKR-004', 'CR-001', 817, 0, 0, 'g1', 'aktif'),
('db-002-003-005-004-001-g2', 'BRG-002', 'BRD-003', 'BRT-005', 'UKR-004', 'CR-001', 33, 0, 0, 'g2', 'aktif'),
('db-002-003-005-004-001-g3', 'BRG-002', 'BRD-003', 'BRT-005', 'UKR-004', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-002-003-006-004-001-g1', 'BRG-002', 'BRD-003', 'BRT-006', 'UKR-004', 'CR-001', 0, 0, 0, 'g1', 'aktif'),
('db-002-003-006-004-001-g2', 'BRG-002', 'BRD-003', 'BRT-006', 'UKR-004', 'CR-001', 0, 0, 0, 'g2', 'aktif'),
('db-002-003-006-004-001-g3', 'BRG-002', 'BRD-003', 'BRT-006', 'UKR-004', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-002-004-004-003-001-g1', 'BRG-002', 'BRD-004', 'BRT-004', 'UKR-003', 'CR-001', 133, 0, 0, 'g1', 'aktif'),
('db-002-004-004-003-001-g2', 'BRG-002', 'BRD-004', 'BRT-004', 'UKR-003', 'CR-001', 67, 0, 0, 'g2', 'aktif'),
('db-002-004-004-003-001-g3', 'BRG-002', 'BRD-004', 'BRT-004', 'UKR-003', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-002-004-005-004-001-g1', 'BRG-002', 'BRD-004', 'BRT-005', 'UKR-004', 'CR-001', 100, 0, 0, 'g1', 'aktif'),
('db-002-004-005-004-001-g2', 'BRG-002', 'BRD-004', 'BRT-005', 'UKR-004', 'CR-001', 0, 0, 0, 'g2', 'aktif'),
('db-002-004-005-004-001-g3', 'BRG-002', 'BRD-004', 'BRT-005', 'UKR-004', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-002-005-005-003-001-g1', 'BRG-002', 'BRD-005', 'BRT-005', 'UKR-003', 'CR-001', 0, 0, 0, 'g1', 'aktif'),
('db-002-005-005-003-001-g2', 'BRG-002', 'BRD-005', 'BRT-005', 'UKR-003', 'CR-001', 0, 0, 0, 'g2', 'aktif'),
('db-002-005-005-003-001-g3', 'BRG-002', 'BRD-005', 'BRT-005', 'UKR-003', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-002-005-006-004-001-g1', 'BRG-002', 'BRD-005', 'BRT-006', 'UKR-004', 'CR-001', 0, 0, 0, 'g1', 'aktif'),
('db-002-005-006-004-001-g2', 'BRG-002', 'BRD-005', 'BRT-006', 'UKR-004', 'CR-001', 0, 0, 0, 'g2', 'aktif'),
('db-002-005-006-004-001-g3', 'BRG-002', 'BRD-005', 'BRT-006', 'UKR-004', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-003-006-003-003-001-g1', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-003', 'CR-001', 99, 0, 0, 'g1', 'aktif'),
('db-003-006-003-003-001-g2', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-003', 'CR-001', 61, 0, 0, 'g2', 'aktif'),
('db-003-006-003-003-001-g3', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-003', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-003-006-003-005-001-g1', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-005', 'CR-001', 129, 0, 0, 'g1', 'aktif'),
('db-003-006-003-005-001-g2', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-005', 'CR-001', 71, 0, 0, 'g2', 'aktif'),
('db-003-006-003-005-001-g3', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-005', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-003-006-003-006-001-g1', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-006', 'CR-001', 278, 0, 0, 'g1', 'aktif'),
('db-003-006-003-006-001-g2', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-006', 'CR-001', 22, 0, 0, 'g2', 'aktif'),
('db-003-006-003-006-001-g3', 'BRG-003', 'BRD-006', 'BRT-003', 'UKR-006', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-003-007-003-002-001-g1', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-002', 'CR-001', 696, 0, 0, 'g1', 'aktif'),
('db-003-007-003-002-001-g2', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-002', 'CR-001', 62, 0, 0, 'g2', 'aktif'),
('db-003-007-003-002-001-g3', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-002', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-003-007-003-003-001-g1', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-003', 'CR-001', 171, 0, 0, 'g1', 'aktif'),
('db-003-007-003-003-001-g2', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-003', 'CR-001', 66, 0, 0, 'g2', 'aktif'),
('db-003-007-003-003-001-g3', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-003', 'CR-001', 100, 0, 0, 'g3', 'aktif'),
('db-003-007-003-005-001-g1', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-005', 'CR-001', 503, 0, 0, 'g1', 'aktif'),
('db-003-007-003-005-001-g2', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-005', 'CR-001', 17, 0, 0, 'g2', 'aktif'),
('db-003-007-003-005-001-g3', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-005', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-003-007-003-006-001-g1', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-006', 'CR-001', 0, 0, 0, 'g1', 'aktif'),
('db-003-007-003-006-001-g2', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-006', 'CR-001', 0, 0, 0, 'g2', 'aktif'),
('db-003-007-003-006-001-g3', 'BRG-003', 'BRD-007', 'BRT-003', 'UKR-006', 'CR-001', 0, 0, 0, 'g3', 'aktif'),
('db-004-001-001-001-002-g1', 'BRG-004', 'BRD-001', 'BRT-001', 'UKR-001', 'CR-002', 0, 0, 0, 'g1', 'aktif'),
('db-004-001-001-001-002-g2', 'BRG-004', 'BRD-001', 'BRT-001', 'UKR-001', 'CR-002', 0, 0, 0, 'g2', 'aktif'),
('db-004-001-001-001-002-g3', 'BRG-004', 'BRD-001', 'BRT-001', 'UKR-001', 'CR-002', 0, 0, 0, 'g3', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `detbkeluar`
--

CREATE TABLE `detbkeluar` (
  `id_detbkeluar` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `id_bkeluar` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `convert` varchar(10) NOT NULL,
  `pengurangan` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detbkeluar`
--

INSERT INTO `detbkeluar` (`id_detbkeluar`, `id_detbarang`, `id_bkeluar`, `jumlah`, `convert`, `pengurangan`) VALUES
('DKEL-210808205550', 'db-001-001-001-001-001-g1', 'BK-20210808-1', 10, 'con1', '0'),
('DKEL-210808205557', 'db-001-001-001-001-001-g1', 'BK-20210808-1', 2, 'con2', '1'),
('DKEL-210808205606', 'db-001-001-001-001-001-g1', 'BK-20210808-1', 100, 'con3', '1-2'),
('DKEL-210808205958', 'db-001-001-001-001-001-g2', 'BK-20210808-3', 9, 'con1', '0'),
('DKEL-210814200240', 'db-001-001-001-002-001-g1', 'BK-20210814-3', 10, 'con1', '0'),
('DKEL-210814200319', 'db-001-001-001-002-001-g1', 'BK-20210814-3', 3, 'con2', '1'),
('DKEL-210814200328', 'db-001-001-001-002-001-g1', 'BK-20210814-3', 100, 'con3', '1-2'),
('DKEL-210814201412', 'db-001-001-001-002-001-g1', 'BK-20210814-4', 13, 'con1', '0'),
('DKEL-210814201441', 'db-001-001-001-002-001-g1', 'BK-20210814-4', 3, 'con2', '0'),
('DKEL-210814201447', 'db-001-001-001-002-001-g1', 'BK-20210814-4', 156, 'con3', '0'),
('DKEL-210817205232', 'db-001-001-001-001-001-g2', 'BK-20210817-2', 10, 'con1', '0'),
('DKEL-210817205240', 'db-001-001-001-001-001-g2', 'BK-20210817-2', 2, 'con2', '1'),
('DKEL-210817205245', 'db-001-001-001-001-001-g2', 'BK-20210817-2', 200, 'con3', '1-2'),
('DKEL-210818072452', 'db-001-001-001-001-001-g3', 'BK-20210818-3', 1, 'con1', '0'),
('DKEL-210818072457', 'db-001-001-001-001-001-g2', 'BK-20210818-1', 1, 'con1', '0'),
('DKEL-210818072502', 'db-001-001-001-001-001-g3', 'BK-20210818-3', 1, 'con2', '1'),
('DKEL-210818072526', 'db-001-001-001-001-001-g2', 'BK-20210818-1', 1, 'con2', '0'),
('DKEL-210818093152', 'db-001-001-001-001-001-g3', 'BK-20210818-3', 1, 'con1', '0'),
('DKEL-210818093546', 'db-001-001-001-001-001-g1', 'BK-20210818-6', 1, 'con1', '0'),
('DKEL-210818093613', 'db-001-001-001-001-001-g1', 'BK-20210818-6', 100, 'con3', '2');

-- --------------------------------------------------------

--
-- Table structure for table `detbmasuk`
--

CREATE TABLE `detbmasuk` (
  `id_detbmasuk` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `id_masuk` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `convert` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detbmasuk`
--

INSERT INTO `detbmasuk` (`id_detbmasuk`, `id_detbarang`, `id_masuk`, `jumlah`, `convert`) VALUES
('BDM-210814200119', 'db-001-001-001-001-001-g1', 'BMS-210814200101', 13, 'con1'),
('BDM-210814200123', 'db-001-001-001-002-001-g2', 'BMS-210814200104', 13, 'con1'),
('DBM-210730193549', 'db-001-001-001-001-001-g1', 'DBM-210730194017', 1000, ''),
('DBM-210730193553', 'db-001-001-001-002-001-g1', 'DBM-210730194017', 1000, ''),
('DBM-210730193558', 'db-001-001-001-003-001-g1', 'DBM-210730194017', 1000, ''),
('DBM-210730193603', 'db-001-002-001-002-001-g1', 'DBM-210730194017', 1000, ''),
('DBM-210730193607', 'db-001-002-001-005-001-g1', 'DBM-210730194017', 1000, ''),
('DBM-210730193613', 'db-001-002-004-003-001-g1', 'DBM-210730194017', 122, ''),
('DBM-210730193622', 'db-002-003-001-003-001-g1', 'DBM-210730194017', 230, ''),
('DBM-210730193630', 'db-002-003-005-004-001-g1', 'DBM-210730194017', 950, ''),
('DBM-210730193636', 'db-002-004-004-003-001-g1', 'DBM-210730194017', 300, ''),
('DBM-210730193643', 'db-003-006-003-005-001-g1', 'DBM-210730194017', 200, ''),
('DBM-210730193652', 'db-002-004-005-004-001-g1', 'DBM-210730194017', 200, ''),
('DBM-210730193659', 'db-003-006-003-003-001-g1', 'DBM-210730194017', 260, ''),
('DBM-210730193708', 'db-003-006-003-006-001-g1', 'DBM-210730194017', 300, ''),
('DBM-210730193715', 'db-003-007-003-002-001-g1', 'DBM-210730194017', 758, ''),
('DBM-210730193723', 'db-003-007-003-003-001-g1', 'DBM-210730194017', 337, ''),
('DBM-210730193731', 'db-003-007-003-005-001-g1', 'DBM-210730194017', 520, ''),
('DBM-210730202742', 'db-001-001-001-001-001-g2', 'DBM-210817125850', 200, ''),
('DBM-210730202749', 'db-001-001-001-002-001-g2', 'DBM-210817125850', 250, ''),
('DBM-210730202755', 'db-001-001-001-003-001-g2', 'DBM-210817125850', 100, ''),
('DBM-210730202802', 'db-001-002-001-002-001-g2', 'DBM-210817125850', 70, ''),
('DBM-210730202809', 'db-001-002-001-005-001-g2', 'DBM-210817125850', 56, ''),
('DBM-210730202816', 'db-001-002-004-003-001-g2', 'DBM-210817125850', 78, ''),
('DBM-210730202824', 'db-002-003-001-003-001-g2', 'DBM-210817125850', 52, ''),
('DBM-210730202831', 'db-002-003-005-004-001-g2', 'DBM-210817125850', 33, ''),
('DBM-210730202838', 'db-002-004-004-003-001-g2', 'DBM-210817125850', 67, ''),
('DBM-210730202900', 'db-003-006-003-003-001-g2', 'DBM-210817125850', 61, ''),
('DBM-210730202911', 'db-003-006-003-005-001-g2', 'DBM-210817125850', 71, ''),
('DBM-210730202921', 'db-003-006-003-006-001-g2', 'DBM-210817125850', 22, ''),
('DBM-210730202933', 'db-003-007-003-002-001-g2', 'DBM-210817125850', 62, ''),
('DBM-210730202939', 'db-003-007-003-003-001-g2', 'DBM-210817125850', 66, ''),
('DBM-210730202950', 'db-003-007-003-005-001-g2', 'DBM-210817125850', 17, ''),
('DBM-210801083008', 'db-001-001-001-001-001-g2', 'DBM-210817125831', 1, ''),
('DBM-210816141542', 'db-001-001-001-001-001-g1', 'DBM-210816141800', 2000, ''),
('DBM-210817130533', 'db-001-001-001-001-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130608', 'db-001-001-001-002-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130614', 'db-001-001-001-003-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130634', 'db-001-002-001-002-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130643', 'db-001-002-001-005-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130719', 'db-002-003-001-003-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130733', 'db-002-003-005-004-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130819', 'db-002-004-004-003-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130830', 'db-002-004-005-004-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130925', 'db-003-006-003-003-001-g3', 'DBM-210817132147', 100, ''),
('DBM-210817130936', 'db-003-007-003-003-001-g3', 'DBM-210817132147', 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `detpemesanan`
--

CREATE TABLE `detpemesanan` (
  `id_detpesan` varchar(25) NOT NULL,
  `id_pesan` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `convert` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detpemesanan`
--

INSERT INTO `detpemesanan` (`id_detpesan`, `id_pesan`, `id_detbarang`, `jumlah`, `convert`) VALUES
('DPEM-210730193549', 'PEM-20210730-001', 'db-001-001-001-001-001-g1', 1000, 'con1'),
('DPEM-210730193553', 'PEM-20210730-001', 'db-001-001-001-002-001-g1', 1000, 'con1'),
('DPEM-210730193558', 'PEM-20210730-001', 'db-001-001-001-003-001-g1', 1000, 'con1'),
('DPEM-210730193603', 'PEM-20210730-001', 'db-001-002-001-002-001-g1', 1000, 'con1'),
('DPEM-210730193607', 'PEM-20210730-001', 'db-001-002-001-005-001-g1', 1000, 'con1'),
('DPEM-210730193613', 'PEM-20210730-001', 'db-001-002-004-003-001-g1', 122, 'con1'),
('DPEM-210730193622', 'PEM-20210730-001', 'db-002-003-001-003-001-g1', 230, 'con1'),
('DPEM-210730193630', 'PEM-20210730-001', 'db-002-003-005-004-001-g1', 950, 'con1'),
('DPEM-210730193636', 'PEM-20210730-001', 'db-002-004-004-003-001-g1', 300, 'con1'),
('DPEM-210730193643', 'PEM-20210730-001', 'db-003-006-003-005-001-g1', 200, 'con1'),
('DPEM-210730193652', 'PEM-20210730-001', 'db-002-004-005-004-001-g1', 200, 'con1'),
('DPEM-210730193659', 'PEM-20210730-001', 'db-003-006-003-003-001-g1', 260, 'con1'),
('DPEM-210730193708', 'PEM-20210730-001', 'db-003-006-003-006-001-g1', 300, 'con1'),
('DPEM-210730193715', 'PEM-20210730-001', 'db-003-007-003-002-001-g1', 758, 'con1'),
('DPEM-210730193723', 'PEM-20210730-001', 'db-003-007-003-003-001-g1', 337, 'con1'),
('DPEM-210730193731', 'PEM-20210730-001', 'db-003-007-003-005-001-g1', 520, 'con1'),
('DPEM-210731171509', 'PEM-20210731-001', 'db-001-001-001-002-001-g1', 1, 'con1'),
('DPEM-210814125418', 'PEM-20210814-001', 'db-001-001-001-001-001-g1', 199, 'con1'),
('DPEM-210816141542', 'PEM-20210816-001', 'db-001-001-001-001-001-g1', 2000, 'con1'),
('DPEM-210818100535', 'PEM-20210818-001', 'db-001-001-001-001-001-g1', 1, 'con1');

-- --------------------------------------------------------

--
-- Table structure for table `detpenyesuaian`
--

CREATE TABLE `detpenyesuaian` (
  `id_detpenyesuaian` varchar(25) NOT NULL,
  `id_penyesuaian` varchar(25) NOT NULL,
  `id_detso` varchar(25) NOT NULL,
  `tindakan` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detpermintaan`
--

CREATE TABLE `detpermintaan` (
  `id_detpermintaan` varchar(25) NOT NULL,
  `id_permintaan` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `convert` varchar(10) NOT NULL,
  `pengurangan` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detpermintaan`
--

INSERT INTO `detpermintaan` (`id_detpermintaan`, `id_permintaan`, `id_detbarang`, `jumlah`, `convert`, `pengurangan`) VALUES
('DPER-210730202742', 'PER-20210730-001', 'db-001-001-001-001-001-g1', 200, 'con1', '0'),
('DPER-210730202749', 'PER-20210730-001', 'db-001-001-001-002-001-g1', 250, 'con1', '0'),
('DPER-210730202755', 'PER-20210730-001', 'db-001-001-001-003-001-g1', 100, 'con1', '0'),
('DPER-210730202802', 'PER-20210730-001', 'db-001-002-001-002-001-g1', 70, 'con1', '0'),
('DPER-210730202809', 'PER-20210730-001', 'db-001-002-001-005-001-g1', 56, 'con1', '0'),
('DPER-210730202816', 'PER-20210730-001', 'db-001-002-004-003-001-g1', 78, 'con1', '0'),
('DPER-210730202824', 'PER-20210730-001', 'db-002-003-001-003-001-g1', 52, 'con1', '0'),
('DPER-210730202831', 'PER-20210730-001', 'db-002-003-005-004-001-g1', 33, 'con1', '0'),
('DPER-210730202838', 'PER-20210730-001', 'db-002-004-004-003-001-g1', 67, 'con1', '0'),
('DPER-210730202900', 'PER-20210730-001', 'db-003-006-003-003-001-g1', 61, 'con1', '0'),
('DPER-210730202911', 'PER-20210730-001', 'db-003-006-003-005-001-g1', 71, 'con1', '0'),
('DPER-210730202921', 'PER-20210730-001', 'db-003-006-003-006-001-g1', 22, 'con1', '0'),
('DPER-210730202933', 'PER-20210730-001', 'db-003-007-003-002-001-g1', 62, 'con1', '0'),
('DPER-210730202939', 'PER-20210730-001', 'db-003-007-003-003-001-g1', 66, 'con1', '0'),
('DPER-210730202950', 'PER-20210730-001', 'db-003-007-003-005-001-g1', 17, 'con1', '0'),
('DPER-210801083008', 'PER-20210801-002', 'db-001-001-001-001-001-g1', 1, 'con1', '0'),
('DPER-210817130533', 'PER-20210817-002', 'db-001-001-001-001-001-g1', 100, 'con1', '0'),
('DPER-210817130608', 'PER-20210817-002', 'db-001-001-001-002-001-g1', 100, 'con1', '0'),
('DPER-210817130614', 'PER-20210817-002', 'db-001-001-001-003-001-g1', 100, 'con1', '0'),
('DPER-210817130634', 'PER-20210817-002', 'db-001-002-001-002-001-g1', 100, 'con1', '0'),
('DPER-210817130643', 'PER-20210817-002', 'db-001-002-001-005-001-g1', 100, 'con1', '0'),
('DPER-210817130719', 'PER-20210817-002', 'db-002-003-001-003-001-g1', 100, 'con1', '0'),
('DPER-210817130733', 'PER-20210817-002', 'db-002-003-005-004-001-g1', 100, 'con1', '0'),
('DPER-210817130819', 'PER-20210817-002', 'db-002-004-004-003-001-g1', 100, 'con1', '0'),
('DPER-210817130830', 'PER-20210817-002', 'db-002-004-005-004-001-g1', 100, 'con1', '0'),
('DPER-210817130925', 'PER-20210817-002', 'db-003-006-003-003-001-g1', 100, 'con1', '0'),
('DPER-210817130936', 'PER-20210817-002', 'db-003-007-003-003-001-g1', 100, 'con1', '0'),
('DPER-210817221636', 'PER-20210817-004', 'db-001-001-001-001-001-g2', 1, 'con1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `detretpesan`
--

CREATE TABLE `detretpesan` (
  `id_detretpesan` varchar(25) NOT NULL,
  `id_retpesan` varchar(25) NOT NULL,
  `id_detpesan` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `convert` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detso`
--

CREATE TABLE `detso` (
  `id_detso` varchar(25) NOT NULL,
  `id_so` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `jumlah_sistem` int(11) NOT NULL,
  `jumlah_riil` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `status` varchar(6) NOT NULL,
  `convert` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detbkeluar`
--

CREATE TABLE `dump_detbkeluar` (
  `id_detbkeluar` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `id_bkeluar` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `convert` varchar(10) DEFAULT NULL,
  `pengurangan` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dump_detbkeluar`
--

INSERT INTO `dump_detbkeluar` (`id_detbkeluar`, `id_detbarang`, `id_bkeluar`, `jumlah`, `convert`, `pengurangan`) VALUES
('DKEL-210818093152', 'db-001-001-001-001-001-g3', 'BK-20210818-3', 1, 'con1', '0'),
('DKEL-210818093244', 'db-001-001-001-001-001-g2', 'BK-20210818-5', 1, 'con1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `dump_detbmasuk`
--

CREATE TABLE `dump_detbmasuk` (
  `id_detbmasuk` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) DEFAULT NULL,
  `id_masuk` varchar(25) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `convert` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detpemesanan`
--

CREATE TABLE `dump_detpemesanan` (
  `id_detpesan` varchar(25) NOT NULL,
  `id_pesan` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `convert` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detpenyesuaian`
--

CREATE TABLE `dump_detpenyesuaian` (
  `id_detpenyesuaian` varchar(25) NOT NULL,
  `id_penyesuaian` varchar(25) NOT NULL,
  `id_detso` varchar(25) DEFAULT NULL,
  `tindakan` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detpermintaan`
--

CREATE TABLE `dump_detpermintaan` (
  `id_detpermintaan` varchar(25) NOT NULL,
  `id_permintaan` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `convert` varchar(11) DEFAULT NULL,
  `pengurangan` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detretpesan`
--

CREATE TABLE `dump_detretpesan` (
  `id_detretpesan` varchar(25) NOT NULL,
  `id_retpesan` varchar(25) NOT NULL,
  `id_detpesan` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `convert` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detso`
--

CREATE TABLE `dump_detso` (
  `id_detso` varchar(25) NOT NULL,
  `id_so` varchar(25) NOT NULL,
  `id_detbarang` varchar(25) NOT NULL,
  `jumlah_sistem` int(11) NOT NULL,
  `jumlah_riil` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `convert` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` varchar(5) NOT NULL,
  `gudang` varchar(30) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `gudang`, `alamat`) VALUES
('g1', 'Gudang MBC Pusat', 'Telukan'),
('g2', 'Gudang MBC Cabang Sukoharjo', 'Sukoharjo'),
('g3', 'Gudang MBM Tawangsari', 'Tawangsari');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pesan` varchar(25) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_supplier` varchar(8) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pesan`, `id_user`, `id_supplier`, `tanggal`, `status`) VALUES
('PEM-20210730-001', 'g1_kepgudang', 'SUP-003', '2021-07-30 12:40:17', 'sudah dimasukan'),
('PEM-20210731-001', 'g1_kepgudang', 'SUP-001', '2021-07-31 10:15:43', 'disetujui'),
('PEM-20210814-001', 'g1_kepgudang', 'SUP-002', '2021-08-14 05:54:20', 'belum disetujui'),
('PEM-20210816-001', 'g1_kepgudang', 'SUP-001', '2021-08-16 07:18:00', 'sudah dimasukan'),
('PEM-20210818-001', 'g1_kepgudang', 'SUP-001', '2021-08-18 03:05:47', 'belum disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `penyesuaian`
--

CREATE TABLE `penyesuaian` (
  `id_penyesuaian` varchar(25) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id_permintaan` varchar(25) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL,
  `tujuan` varchar(5) DEFAULT NULL,
  `asal` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id_permintaan`, `id_user`, `tanggal`, `status`, `tujuan`, `asal`) VALUES
('PER-20210730-001', 'g2_kepgudang', '2021-08-17 05:58:50', 'sudah dimasukan', 'g1', 'g2'),
('PER-20210801-002', 'g2_kepgudang', '2021-08-17 05:58:31', 'sudah dimasukan', 'g1', 'g2'),
('PER-20210817-001', 'g2_kepgudang', '2021-08-17 06:02:20', 'kosong', 'g1', 'g2'),
('PER-20210817-002', 'g3_kepgudang', '2021-08-17 06:21:47', 'sudah dimasukan', 'g1', 'g3'),
('PER-20210817-003', 'g3_kepgudang', '2021-08-17 06:23:04', 'kosong', 'g1', 'g3'),
('PER-20210817-004', 'g1_kepgudang', '2021-08-17 15:16:38', 'Diajukan-g1', 'g2', 'g1');

-- --------------------------------------------------------

--
-- Table structure for table `retpesan`
--

CREATE TABLE `retpesan` (
  `id_retpesan` varchar(25) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `so`
--

CREATE TABLE `so` (
  `id_so` varchar(25) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL,
  `id_gudang` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `so`
--

INSERT INTO `so` (`id_so`, `id_user`, `tanggal`, `status`, `id_gudang`) VALUES
('SO-20210816-001', '', '2021-08-16 06:20:53', 'ditambah', 'g1'),
('SO-20210817-001', '', '2021-08-17 06:23:20', 'ditambah', 'g3');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(8) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `penanggungjawab` varchar(50) NOT NULL,
  `telpon` varchar(13) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_perusahaan`, `penanggungjawab`, `telpon`, `alamat`, `status`) VALUES
('SUP-001', 'REMORA', 'Sulistyo', '08125372123', 'Sukoharjo', 'aktif'),
('SUP-002', 'TOSAKA', 'Endarwati', '08512361273', 'Yogyakarta', 'aktif'),
('SUP-003', 'RIVENDARE', 'Baron', '08158712874', 'Startlhome', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id_ukuran` varchar(15) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id_ukuran`, `ukuran`, `status`) VALUES
('UKR-001', '61 x 86', 'aktif'),
('UKR-002', '65 x 100', 'aktif'),
('UKR-003', '79 x 109', 'aktif'),
('UKR-004', '89 x 120', 'aktif'),
('UKR-005', '54 x 70', 'aktif'),
('UKR-006', '49 x 79', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `id_gudang` varchar(5) NOT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `password`, `nama`, `jabatan`, `id_gudang`, `status`) VALUES
('asdas', 'asdasd', '4', 'Owner', 'g1', 'tidak'),
('g1_admin', '123', 'g1_admin', 'Admin_Gudang', 'g1', 'aktif'),
('g1_kepgudang', '123', 'g1_kepgudang', 'Kepala_gudang', 'g1', 'aktif'),
('g2_admin', '123', 'g2_admin', 'Admin_Gudang', 'g2', 'aktif'),
('g2_kepgudang', '123', 'g2_kepgudang', 'Kepala_gudang', 'g2', 'aktif'),
('g3_admin', '123', 'g3_admin', 'Admin_Gudang', 'g3', 'aktif'),
('g3_kepgudang', '123', 'g3_kepgudang', 'Kepala_gudang', 'g3', 'aktif'),
('owner', '123', 'owner', 'Owner', 'g1', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `berat`
--
ALTER TABLE `berat`
  ADD PRIMARY KEY (`id_berat`);

--
-- Indexes for table `bkeluar`
--
ALTER TABLE `bkeluar`
  ADD PRIMARY KEY (`id_bkeluar`);

--
-- Indexes for table `bmasuk`
--
ALTER TABLE `bmasuk`
  ADD PRIMARY KEY (`id_bmasuk`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `cr`
--
ALTER TABLE `cr`
  ADD PRIMARY KEY (`id_cr`);

--
-- Indexes for table `detbarang`
--
ALTER TABLE `detbarang`
  ADD PRIMARY KEY (`id_detbarang`);

--
-- Indexes for table `detbkeluar`
--
ALTER TABLE `detbkeluar`
  ADD PRIMARY KEY (`id_detbkeluar`);

--
-- Indexes for table `detbmasuk`
--
ALTER TABLE `detbmasuk`
  ADD PRIMARY KEY (`id_detbmasuk`);

--
-- Indexes for table `detpemesanan`
--
ALTER TABLE `detpemesanan`
  ADD PRIMARY KEY (`id_detpesan`);

--
-- Indexes for table `detpenyesuaian`
--
ALTER TABLE `detpenyesuaian`
  ADD PRIMARY KEY (`id_detpenyesuaian`);

--
-- Indexes for table `detpermintaan`
--
ALTER TABLE `detpermintaan`
  ADD PRIMARY KEY (`id_detpermintaan`);

--
-- Indexes for table `detretpesan`
--
ALTER TABLE `detretpesan`
  ADD PRIMARY KEY (`id_detretpesan`);

--
-- Indexes for table `detso`
--
ALTER TABLE `detso`
  ADD PRIMARY KEY (`id_detso`);

--
-- Indexes for table `dump_detbkeluar`
--
ALTER TABLE `dump_detbkeluar`
  ADD PRIMARY KEY (`id_detbkeluar`);

--
-- Indexes for table `dump_detbmasuk`
--
ALTER TABLE `dump_detbmasuk`
  ADD PRIMARY KEY (`id_detbmasuk`);

--
-- Indexes for table `dump_detpemesanan`
--
ALTER TABLE `dump_detpemesanan`
  ADD PRIMARY KEY (`id_detpesan`);

--
-- Indexes for table `dump_detpenyesuaian`
--
ALTER TABLE `dump_detpenyesuaian`
  ADD PRIMARY KEY (`id_detpenyesuaian`);

--
-- Indexes for table `dump_detpermintaan`
--
ALTER TABLE `dump_detpermintaan`
  ADD PRIMARY KEY (`id_detpermintaan`);

--
-- Indexes for table `dump_detretpesan`
--
ALTER TABLE `dump_detretpesan`
  ADD PRIMARY KEY (`id_detretpesan`);

--
-- Indexes for table `dump_detso`
--
ALTER TABLE `dump_detso`
  ADD PRIMARY KEY (`id_detso`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `penyesuaian`
--
ALTER TABLE `penyesuaian`
  ADD PRIMARY KEY (`id_penyesuaian`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `retpesan`
--
ALTER TABLE `retpesan`
  ADD PRIMARY KEY (`id_retpesan`);

--
-- Indexes for table `so`
--
ALTER TABLE `so`
  ADD PRIMARY KEY (`id_so`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
