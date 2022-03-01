-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 03:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persediaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_jenis` varchar(25) NOT NULL,
  `stok` float NOT NULL,
  `harga` int(11) NOT NULL,
  `lama_expired` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `kekurangan` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `id_jenis`, `stok`, `harga`, `lama_expired`, `satuan`, `kekurangan`) VALUES
('BRG-BM-1', 'Gula', 'BM', 0, 12000, 29, 'kg', 0),
('BRG-KP-1', 'Kopi Torabika', 'KP', 22, 2000, 29, 'kg', 0),
('BRG-KP-2', 'Kopi Gayo', 'KP', -37, 5000, 20, 'kg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `belanja`
--

CREATE TABLE `belanja` (
  `id_belanja` varchar(25) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `item_belanja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `belanja`
--

INSERT INTO `belanja` (`id_belanja`, `tanggal`, `total`, `status`, `item_belanja`) VALUES
('TRM-20210108-1', '08-01-2021', 1656000, 'dimasukan', 2),
('TRM-20210108-2', '08-01-2021', 12000, 'disetujui', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bkeluar`
--

CREATE TABLE `bkeluar` (
  `id_bkeluar` varchar(25) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `user` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bkeluar`
--

INSERT INTO `bkeluar` (`id_bkeluar`, `tanggal`, `user`) VALUES
('TRK-20210108-1', '2021-01-08 01:42:28', 'YUSUF TAMPAN'),
('TRK-20210108-2', '2021-01-08 01:54:27', 'Yusuf');

-- --------------------------------------------------------

--
-- Table structure for table `bmasuk`
--

CREATE TABLE `bmasuk` (
  `id_bmasuk` varchar(25) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmasuk`
--

INSERT INTO `bmasuk` (`id_bmasuk`, `total`, `tanggal`) VALUES
('TRM-20210108-1', 1656000, '2021-01-08 01:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `detbelanja`
--

CREATE TABLE `detbelanja` (
  `id_detbel` varchar(25) NOT NULL,
  `id_belanja` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `urgensi` varchar(20) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detbelanja`
--

INSERT INTO `detbelanja` (`id_detbel`, `id_belanja`, `id_barang`, `jumlah`, `urgensi`, `sub_total`) VALUES
('BRGM-210108082233', 'TRM-20210108-1', 'BRG-BM-1', 13, 'Urgent', 156000),
('BRGM-210108082245', 'TRM-20210108-1', 'BRG-KP-2', 300, 'Urgent', 1500000),
('BRGM-210108084711', 'TRM-20210108-2', 'BRG-BM-1', 1, 'Urgent', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `detbkeluar`
--

CREATE TABLE `detbkeluar` (
  `id_detbkeluar` varchar(25) NOT NULL,
  `id_bkeluar` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `kekurangan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detbkeluar`
--

INSERT INTO `detbkeluar` (`id_detbkeluar`, `id_bkeluar`, `id_barang`, `jumlah`, `kekurangan`) VALUES
('BRGK-210108084108', 'TRK-20210108-1', 'BRG-BM-1', 13, 0),
('BRGK-210108084113', 'TRK-20210108-1', 'BRG-KP-1', 0, 14),
('BRGK-210108084125', 'TRK-20210108-1', 'BRG-KP-2', 200, 0),
('BRGK-210108085321', 'TRK-20210108-2', 'BRG-BM-1', 1, 0),
('BRGK-210108085329', 'TRK-20210108-2', 'BRG-KP-2', 1, 0);

--
-- Triggers `detbkeluar`
--
DELIMITER $$
CREATE TRIGGER `fifo` BEFORE INSERT ON `detbkeluar` FOR EACH ROW BEGIN
	DECLARE jumlahkeluar INT;
	DELETE FROM fifo WHERE sisa=0;
	SET jumlahkeluar=new.jumlah;
	SET @id=(SELECT id_detbmasuk FROM fifo WHERE ex_date=  (SELECT ex_date FROM fifo WHERE sisa>0 ORDER BY ex_date ASC LIMIT 1) AND sisa>0 AND ex_date>CURDATE() LIMIT 1  );
	SET @sisa=(SELECT sisa FROM fifo WHERE id_detbmasuk=@id);
	REPEAT
	IF (@sisa>jumlahkeluar) THEN
	UPDATE fifo SET sisa=@sisa-jumlahkeluar,keluar=jumlahkeluar WHERE id_detbmasuk=@id;
	UPDATE detbmasuk SET sisa=@sisa-jumlahkeluar,keluar=jumlahkeluar WHERE id_detbmasuk=@id;
	SET jumlahkeluar=0;
	END IF;
	IF (@sisa<jumlahkeluar) THEN
	UPDATE fifo SET sisa=0,keluar=@sisa WHERE id_detbmasuk=@id;
	UPDATE detbmasuk SET sisa=0,keluar=@sisa WHERE id_detbmasuk=@id;
	SET jumlahkeluar=jumlahkeluar-@sisa;
	SET @id=(SELECT id_detbmasuk FROM fifo WHERE ex_date=(SELECT ex_date FROM fifo WHERE sisa>0 ORDER BY ex_date ASC LIMIT 1) AND sisa>0 AND ex_date>CURDATE() LIMIT 1);
	SET @sisa=(SELECT sisa FROM fifo WHERE id_detbmasuk=@id);
	END IF;
	IF (@sisa=jumlahkeluar) THEN
	UPDATE fifo SET sisa=0,keluar=jumlahkeluar WHERE id_detbmasuk=@id;
	UPDATE detbmasuk SET sisa=0,keluar=jumlahkeluar WHERE id_detbmasuk=@id;
	SET jumlahkeluar=0;
	END IF;
	UNTIL jumlahkeluar=0
	END REPEAT;


    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detbmasuk`
--

CREATE TABLE `detbmasuk` (
  `id_detbmasuk` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `id_bmasuk` varchar(25) NOT NULL,
  `ex_date` date NOT NULL,
  `jumlah` float NOT NULL,
  `sisa` float NOT NULL,
  `keluar` float NOT NULL,
  `harga_asli` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detbmasuk`
--

INSERT INTO `detbmasuk` (`id_detbmasuk`, `id_barang`, `id_bmasuk`, `ex_date`, `jumlah`, `sisa`, `keluar`, `harga_asli`, `sub_total`) VALUES
('BRGM-210108082233', 'BRG-BM-1', 'TRM-20210108-1', '2021-02-05', 13, 13, 0, 12000, 156000),
('BRGM-210108082245', 'BRG-KP-2', 'TRM-20210108-1', '2021-01-27', 300, 85, 1, 5000, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `detpbkeluar`
--

CREATE TABLE `detpbkeluar` (
  `id_detpbkeluar` varchar(25) NOT NULL,
  `id_pbkeluar` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `kekurangan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detpbkeluar`
--

INSERT INTO `detpbkeluar` (`id_detpbkeluar`, `id_pbkeluar`, `id_barang`, `jumlah`, `kekurangan`) VALUES
('BRGK-210108084108', 'TRK-20210108-1', 'BRG-BM-1', 13, 0),
('BRGK-210108084113', 'TRK-20210108-1', 'BRG-KP-1', 0, 14),
('BRGK-210108084125', 'TRK-20210108-1', 'BRG-KP-2', 200, 0),
('BRGK-210108085321', 'TRK-20210108-2', 'BRG-BM-1', 1, 0),
('BRGK-210108085329', 'TRK-20210108-2', 'BRG-KP-2', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detso`
--

CREATE TABLE `detso` (
  `id_detso` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `id_so` varchar(25) NOT NULL,
  `jml_stok` float NOT NULL,
  `jml_so` float NOT NULL,
  `status` varchar(25) NOT NULL,
  `selisih` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detso`
--

INSERT INTO `detso` (`id_detso`, `id_barang`, `id_so`, `jml_stok`, `jml_so`, `status`, `selisih`) VALUES
('BRGSO-210108085702', 'BRG-BM-1', 'SO-20210108-1', 12, 12, 'Sesuai', 0),
('BRGSO-210108085713', 'BRG-KP-1', 'SO-20210108-1', 0, 10, 'Lebih', 10),
('BRGSO-210108085725', 'BRG-KP-2', 'SO-20210108-1', 299, 250, 'kurang', -49),
('BRGSO-210108090816', 'BRG-BM-1', 'SO-20210108-2', 12, 10, 'kurang', -2),
('BRGSO-210108091725', 'BRG-BM-1', 'SO-20210108-3', 10, 0, 'kurang', -10);

-- --------------------------------------------------------

--
-- Table structure for table `dump_detbelanja`
--

CREATE TABLE `dump_detbelanja` (
  `id_detbel` varchar(25) NOT NULL,
  `id_belanja` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `urgensi` varchar(20) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detbkeluar`
--

CREATE TABLE `dump_detbkeluar` (
  `id_detbkeluar` varchar(25) NOT NULL,
  `id_bkeluar` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `kekurangan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detbmasuk`
--

CREATE TABLE `dump_detbmasuk` (
  `id_detbmasuk` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `id_bmasuk` varchar(25) NOT NULL,
  `ex_date` date NOT NULL,
  `jumlah` float NOT NULL,
  `sisa` float NOT NULL,
  `keluar` float NOT NULL,
  `harga_asli` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detpbkeluar`
--

CREATE TABLE `dump_detpbkeluar` (
  `id_detpbkeluar` varchar(25) NOT NULL,
  `id_pbkeluar` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `kekurangan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_detso`
--

CREATE TABLE `dump_detso` (
  `id_detso` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `id_so` varchar(25) NOT NULL,
  `jml_stok` float NOT NULL,
  `jml_so` float NOT NULL,
  `status` varchar(25) NOT NULL,
  `selisih` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_masdetbelanja`
--

CREATE TABLE `dump_masdetbelanja` (
  `id_detbel` varchar(25) NOT NULL,
  `id_belanja` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `urgensi` varchar(20) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dump_penyesuaian`
--

CREATE TABLE `dump_penyesuaian` (
  `id_penyesuaian` varchar(25) NOT NULL,
  `id_detso` varchar(25) NOT NULL,
  `tindakan` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fifo`
--

CREATE TABLE `fifo` (
  `id_detbmasuk` varchar(25) NOT NULL,
  `id_barang` varchar(25) NOT NULL,
  `id_bmasuk` varchar(25) NOT NULL,
  `ex_date` date NOT NULL,
  `jumlah` float NOT NULL,
  `sisa` float NOT NULL,
  `keluar` float NOT NULL,
  `harga_asli` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fifo`
--

INSERT INTO `fifo` (`id_detbmasuk`, `id_barang`, `id_bmasuk`, `ex_date`, `jumlah`, `sisa`, `keluar`, `harga_asli`, `sub_total`) VALUES
('BRGM-210108082233', 'BRG-BM-1', 'TRM-20210108-1', '2021-02-05', 13, 13, 0, 12000, 156000),
('BRGM-210108082245', 'BRG-KP-2', 'TRM-20210108-1', '2021-01-27', 300, 85, 1, 5000, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` varchar(25) NOT NULL,
  `jenis` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `jenis`) VALUES
('BM', 'Bahan Makanan'),
('KP', 'Kopi');

-- --------------------------------------------------------

--
-- Table structure for table `pbkeluar`
--

CREATE TABLE `pbkeluar` (
  `id_pbkeluar` varchar(25) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `user` varchar(25) DEFAULT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pbkeluar`
--

INSERT INTO `pbkeluar` (`id_pbkeluar`, `tanggal`, `user`, `status`) VALUES
('TRK-20210108-1', '08-01-2021', 'Yusuf', 'dimasukan'),
('TRK-20210108-2', '08-01-2021', 'Yusuf', 'dimasukan');

-- --------------------------------------------------------

--
-- Table structure for table `penyesuaian`
--

CREATE TABLE `penyesuaian` (
  `id_penyesuaian` varchar(25) NOT NULL,
  `id_detso` varchar(25) NOT NULL,
  `tindakan` varchar(25) NOT NULL,
  `jumlah` float NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `tanggal` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyesuaian`
--

INSERT INTO `penyesuaian` (`id_penyesuaian`, `id_detso`, `tindakan`, `jumlah`, `keterangan`, `status`, `tanggal`) VALUES
('tdk-210108085821', 'BRGSO-210108085713', 'Tambah', 10, '', 'disetujui-ditambah', '0000-00-00'),
('tdk-210108085916', 'BRGSO-210108085725', 'Kurangi', 49, '', 'disetujui-dikurang', '0000-00-00'),
('tdk-210108090844', 'BRGSO-210108090816', 'Kurangi', 2, '', 'disetujui-dikurang', '0000-00-00'),
('tdk-210108091743', 'BRGSO-210108091725', 'Kurangi', 10, '', 'disetujui-dikurang', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `so`
--

CREATE TABLE `so` (
  `id_so` varchar(25) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `so`
--

INSERT INTO `so` (`id_so`, `tanggal`, `status`) VALUES
('SO-20210108-1', '01/08/2021', 'disesuaikan'),
('SO-20210108-2', '01/08/2021', 'disesuaikan'),
('SO-20210108-3', '01/08/2021', 'disesuaikan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `password`, `nama`, `jabatan`) VALUES
('admin', 'admin', 'Yusuf', 'Barista');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `belanja`
--
ALTER TABLE `belanja`
  ADD PRIMARY KEY (`id_belanja`);

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
-- Indexes for table `detbelanja`
--
ALTER TABLE `detbelanja`
  ADD PRIMARY KEY (`id_detbel`);

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
-- Indexes for table `detpbkeluar`
--
ALTER TABLE `detpbkeluar`
  ADD PRIMARY KEY (`id_detpbkeluar`);

--
-- Indexes for table `detso`
--
ALTER TABLE `detso`
  ADD PRIMARY KEY (`id_detso`);

--
-- Indexes for table `dump_detbelanja`
--
ALTER TABLE `dump_detbelanja`
  ADD PRIMARY KEY (`id_detbel`);

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
-- Indexes for table `dump_detpbkeluar`
--
ALTER TABLE `dump_detpbkeluar`
  ADD PRIMARY KEY (`id_detpbkeluar`);

--
-- Indexes for table `dump_detso`
--
ALTER TABLE `dump_detso`
  ADD PRIMARY KEY (`id_detso`);

--
-- Indexes for table `dump_masdetbelanja`
--
ALTER TABLE `dump_masdetbelanja`
  ADD PRIMARY KEY (`id_detbel`);

--
-- Indexes for table `dump_penyesuaian`
--
ALTER TABLE `dump_penyesuaian`
  ADD PRIMARY KEY (`id_penyesuaian`);

--
-- Indexes for table `fifo`
--
ALTER TABLE `fifo`
  ADD PRIMARY KEY (`id_detbmasuk`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `pbkeluar`
--
ALTER TABLE `pbkeluar`
  ADD PRIMARY KEY (`id_pbkeluar`);

--
-- Indexes for table `penyesuaian`
--
ALTER TABLE `penyesuaian`
  ADD PRIMARY KEY (`id_penyesuaian`);

--
-- Indexes for table `so`
--
ALTER TABLE `so`
  ADD PRIMARY KEY (`id_so`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
