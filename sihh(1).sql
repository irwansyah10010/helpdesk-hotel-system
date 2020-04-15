-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2020 at 03:08 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sihh`
--

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `kode_departement` varchar(5) NOT NULL,
  `nama_departement` varchar(25) NOT NULL,
  `keterangan` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`kode_departement`, `nama_departement`, `keterangan`) VALUES
('12345', 'gudang1', 'gudang 1'),
('E', 'Enginer', 'Khusus Perbaikan'),
('FO', 'Front Office', 'Lolos'),
('HK', 'House Keeping', 'terbanyak'),
('ITO', 'IT Office', 'It'),
('KTC', 'Kitchen', 'Masak'),
('O', 'Office', 'Kantor');

-- --------------------------------------------------------

--
-- Stand-in structure for view `departement_pegawai_permasalahan`
-- (See below for the actual view)
--
CREATE TABLE `departement_pegawai_permasalahan` (
`kode_permasalahan` int(10)
,`tanggal_permasalahan` datetime
,`keterangan` text
,`status` varchar(15)
,`nip` varchar(10)
,`pembuat` varchar(25)
,`foto` varchar(32)
,`kode_departement` varchar(5)
,`nama_departement` varchar(25)
);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(10) NOT NULL,
  `nama_pegawai` varchar(25) NOT NULL,
  `kode_departement` varchar(5) NOT NULL,
  `jabatan` varchar(15) NOT NULL,
  `email` varchar(32) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama_pegawai`, `kode_departement`, `jabatan`, `email`, `tanggal_lahir`, `foto`) VALUES
('E1', 'Fathur Firmansyah', 'E', 'Kepala Bagian', 'FathurFirmansyah@gmail.com', '1997-10-11', 'user/Fathur Firmansyah.PNG'),
('E2', 'Sugiono', 'E', 'Bagian', 'Sugiono@gmail.com', '1998-08-19', 'none'),
('FO001', 'Lisa Aprilia', 'FO', 'Kepala Bagian', 'LisaAprilia@gmail.com', '1996-10-15', 'none'),
('HK001', 'Deni Sugianto', 'HK', 'Kepala Bagian', 'DeniSugiarto@gmail.com', '1995-10-15', 'none'),
('ITO001', 'Sani Hidayat', 'ITO', 'Kepala Bagian', 'SaniHidayat@gmail.com', '1996-10-14', 'user/Sani Hidayat.jpg'),
('ITO2', 'Mawar', 'ITO', 'Kepala Bagian', 'Mawar@gmail.com', '1996-10-25', 'user/Mawar.PNG'),
('KTC1', 'TIO', 'KTC', 'Kepala Bagian', 'tio@gmail.com', '1989-10-12', 'none'),
('KTC2', 'Surti', 'KTC', 'Bagian', 'Surti@gmail.com', '1994-12-20', 'user/Surti.PNG'),
('O1', 'Irwansyah', 'O', 'Kepala Bagian', 'Irwansyah@gmail.com', '1996-12-18', 'none'),
('O2', 'Gerry', 'O', 'Kepala Bagian', 'gerry@gmail.com', '2019-10-25', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pegawai_departement`
-- (See below for the actual view)
--
CREATE TABLE `pegawai_departement` (
`nip` varchar(10)
,`nama_pegawai` varchar(25)
,`kode_departement` varchar(5)
,`nama_departement` varchar(25)
,`jabatan` varchar(15)
,`email` varchar(32)
,`tanggal_lahir` date
,`foto` varchar(32)
);

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan`
--

CREATE TABLE `perbaikan` (
  `kode_perbaikan` int(10) NOT NULL,
  `tanggal_perbaikan` datetime DEFAULT NULL,
  `keterangan` text,
  `status` varchar(15) NOT NULL,
  `kode_permasalahan` int(10) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `vendor` varchar(20) DEFAULT 'no vendor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perbaikan`
--

INSERT INTO `perbaikan` (`kode_perbaikan`, `tanggal_perbaikan`, `keterangan`, `status`, `kode_permasalahan`, `nip`, `vendor`) VALUES
(1, '2019-12-16 17:30:57', 'Komputer sudah berjalan kembali lama penanganan secepatnya', 'Selesai', 2, 'ITO2', 'no vendor'),
(2, '2019-12-16 18:11:57', 'Akan segera dicek lama penanganan secepatnya', 'Diperiksa', 3, 'E2', 'no_vendor'),
(3, '2020-02-10 05:46:04', 'engsel sudah di perbaiki lama penanganan secepatnya', 'Selesai', 8, 'E1', 'no vendor'),
(4, '2020-02-10 05:53:01', 'sudah di ganti kabel dengan yang baru  lama penanganan secepatnya', 'Selesai', 9, 'E2', 'no vendor'),
(5, '2020-02-11 12:17:58', 'kabel tidak pas lama penanganan secepatnya', 'Diperiksa', 10, 'ITO001', 'no_vendor');

-- --------------------------------------------------------

--
-- Table structure for table `permasalahan`
--

CREATE TABLE `permasalahan` (
  `kode_permasalahan` int(10) NOT NULL,
  `tanggal_permasalahan` datetime DEFAULT NULL,
  `keterangan` text,
  `status` varchar(15) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `kode_departement` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permasalahan`
--

INSERT INTO `permasalahan` (`kode_permasalahan`, `tanggal_permasalahan`, `keterangan`, `status`, `nip`, `kode_departement`) VALUES
(1, '2019-11-03 03:41:24', 'AC Kurang Dingin di lantai 2 nomor 34', 'Dibuat', 'O1', 'FO'),
(2, '2019-11-03 12:03:59', 'Komputer nomor 10 Bluescreen di Ruang Office ', 'Selesai', 'O1', 'ITO'),
(3, '2019-11-03 14:16:37', 'Freezer kulkas lama membekunya di bqt', 'Ditanggapi', 'KTC1', 'E'),
(4, '2019-11-03 14:20:35', 'Kompor tidak menyala di bqt', 'Dibuat', 'KTC1', 'E'),
(5, '2019-11-08 10:20:34', 'Ga tau di gg', 'Dibuat', 'O1', 'E'),
(6, '2019-12-16 06:46:20', 'kombi rusak tidak bisa roasted di collage', 'Dibuat', 'KTC1', 'KTC'),
(7, '2019-12-16 11:24:21', 'Kulkas Rusak di MK', 'Dibuat', 'KTC1', 'E'),
(8, '2020-02-10 05:42:32', 'pintu rusak di kamar 201 di lantai 4', 'Selesai', 'HK001', 'E'),
(9, '2020-02-10 05:49:31', 'tidak ada aliran listrik  di lobby hotel', 'Selesai', 'FO001', 'E'),
(10, '2020-02-11 12:16:42', 'komputer blu screan di lobby hotel', 'Ditanggapi', 'FO001', 'ITO');

-- --------------------------------------------------------

--
-- Stand-in structure for view `permasalahan_pegawai`
-- (See below for the actual view)
--
CREATE TABLE `permasalahan_pegawai` (
`kode_permasalahan` int(10)
,`tanggal_permasalahan` datetime
,`keterangan` text
,`status` varchar(15)
,`nip` varchar(10)
,`pemohon` varchar(25)
,`kode_departement` varchar(5)
,`foto` varchar(32)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nip` varchar(8) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hak_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nip`, `username`, `password`, `hak_akses`) VALUES
('FO001', 'LisaAprilia@gmail.com', '19961015', 'FO'),
('HK001', 'DeniSugiarto@gmail.com', '19951015', 'HK'),
('ITO001', 'SaniHidayat@gmail.com', '12345678', 'ITO'),
('O1', 'Irwansyah@gmail.com', '19961218', 'O'),
('E1', 'FathurFirmansyah@gmail.com', '19971011', 'E'),
('KTC1', 'tio@gmail.com', '19891012', 'KTC'),
('O2', 'gerry@gmail.com', '20191025', 'E'),
('ITO2', 'Mawar@gmail.com', '19961025', 'ITO');

-- --------------------------------------------------------

--
-- Structure for view `departement_pegawai_permasalahan`
--
DROP TABLE IF EXISTS `departement_pegawai_permasalahan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `departement_pegawai_permasalahan`  AS  select `permasalahan`.`kode_permasalahan` AS `kode_permasalahan`,`permasalahan`.`tanggal_permasalahan` AS `tanggal_permasalahan`,`permasalahan`.`keterangan` AS `keterangan`,`permasalahan`.`status` AS `status`,`pegawai`.`nip` AS `nip`,`pegawai`.`nama_pegawai` AS `pembuat`,`pegawai`.`foto` AS `foto`,`departement`.`kode_departement` AS `kode_departement`,`departement`.`nama_departement` AS `nama_departement` from ((`permasalahan` join `pegawai` on((`pegawai`.`nip` = `permasalahan`.`nip`))) join `departement` on((`departement`.`kode_departement` = `permasalahan`.`kode_departement`))) ;

-- --------------------------------------------------------

--
-- Structure for view `pegawai_departement`
--
DROP TABLE IF EXISTS `pegawai_departement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pegawai_departement`  AS  select `pegawai`.`nip` AS `nip`,`pegawai`.`nama_pegawai` AS `nama_pegawai`,`departement`.`kode_departement` AS `kode_departement`,`departement`.`nama_departement` AS `nama_departement`,`pegawai`.`jabatan` AS `jabatan`,`pegawai`.`email` AS `email`,`pegawai`.`tanggal_lahir` AS `tanggal_lahir`,`pegawai`.`foto` AS `foto` from (`pegawai` join `departement` on((`departement`.`kode_departement` = `pegawai`.`kode_departement`))) ;

-- --------------------------------------------------------

--
-- Structure for view `permasalahan_pegawai`
--
DROP TABLE IF EXISTS `permasalahan_pegawai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `permasalahan_pegawai`  AS  select `permasalahan`.`kode_permasalahan` AS `kode_permasalahan`,`permasalahan`.`tanggal_permasalahan` AS `tanggal_permasalahan`,`permasalahan`.`keterangan` AS `keterangan`,`permasalahan`.`status` AS `status`,`pegawai`.`nip` AS `nip`,`pegawai`.`nama_pegawai` AS `pemohon`,`pegawai`.`kode_departement` AS `kode_departement`,`pegawai`.`foto` AS `foto` from (`permasalahan` join `pegawai` on((`pegawai`.`nip` = `permasalahan`.`nip`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`kode_departement`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kode_departement` (`kode_departement`);

--
-- Indexes for table `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`kode_perbaikan`),
  ADD KEY `nip` (`nip`),
  ADD KEY `kode_permasalahan` (`kode_permasalahan`);

--
-- Indexes for table `permasalahan`
--
ALTER TABLE `permasalahan`
  ADD PRIMARY KEY (`kode_permasalahan`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD KEY `nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `kode_perbaikan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permasalahan`
--
ALTER TABLE `permasalahan`
  MODIFY `kode_permasalahan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kode_departement`) REFERENCES `departement` (`kode_departement`);

--
-- Constraints for table `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD CONSTRAINT `perbaikan_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`),
  ADD CONSTRAINT `perbaikan_ibfk_3` FOREIGN KEY (`kode_permasalahan`) REFERENCES `permasalahan` (`kode_permasalahan`);

--
-- Constraints for table `permasalahan`
--
ALTER TABLE `permasalahan`
  ADD CONSTRAINT `permasalahan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
