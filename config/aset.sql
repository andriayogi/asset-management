-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2020 at 02:58 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aset`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_aset`
--

CREATE TABLE `data_aset` (
  `id_aset` int(11) NOT NULL,
  `kode_aset` varchar(15) NOT NULL,
  `nama_aset` varchar(30) DEFAULT NULL,
  `tahun_aset` year(4) DEFAULT NULL,
  `harga_aset` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_aset`
--

INSERT INTO `data_aset` (`id_aset`, `kode_aset`, `nama_aset`, `tahun_aset`, `harga_aset`) VALUES
(1, 'MJ.SD.1', 'Meja', 2018, 150000),
(2, 'MJ.SD.2', 'Meja', 2018, 150000),
(3, 'MJ.SD.3', 'Meja', 2018, 150000),
(4, 'MJ.SD.4', 'Meja', 2018, 150000),
(5, 'MJ.SD.5', 'Meja', 2018, 150000),
(6, 'MJ.SD.6', 'Meja', 2018, 150000),
(7, 'MJ.SD.7', 'Meja', 2018, 150000),
(8, 'MJ.SD.8', 'Meja', 2018, 150000),
(9, 'MJ.SD.9', 'Meja', 2018, 150000),
(10, 'MJ.SD.10', 'Meja', 2018, 150000),
(11, 'PH.SMP.1', 'Penghapus', 2019, 10000),
(12, 'PH.SMP.2', 'Penghapus', 2019, 10000),
(13, 'PH.SMP.3', 'Penghapus', 2019, 10000),
(14, 'PH.SMP.4', 'Penghapus', 2019, 10000),
(15, 'PH.SMP.5', 'Penghapus', 2019, 10000),
(16, 'PH.SMP.6', 'Penghapus', 2019, 10000),
(17, 'PH.SMP.7', 'Penghapus', 2019, 10000),
(18, 'PH.SMP.8', 'Penghapus', 2019, 10000),
(19, 'PH.SMP.9', 'Penghapus', 2019, 10000),
(20, 'PH.SMP.10', 'Penghapus', 2019, 10000),
(21, 'KR.SMA.1', 'Kursi', 2018, 50000),
(22, 'KR.SMA.2', 'Kursi', 2018, 50000),
(23, 'KR.SMA.3', 'Kursi', 2018, 50000),
(24, 'KR.SMA.4', 'Kursi', 2018, 50000),
(25, 'KR.SMA.5', 'Kursi', 2018, 50000),
(26, 'KR.SMA.6', 'Kursi', 2019, 50000),
(27, 'KR.SMA.7', 'Kursi', 2019, 50000),
(28, 'KR.SMA.8', 'Kursi', 2019, 50000),
(29, 'KR.SMA.9', 'Kursi', 2019, 50000),
(30, 'KR.SMA.10', 'Kursi', 2019, 50000),
(31, 'PT.SMK.1', 'Papan Tulis', 2018, 500000),
(32, 'PT.SMK.2', 'Papan Tulis', 2018, 500000),
(33, 'PT.SMK.3', 'Papan Tulis', 2018, 500000),
(34, 'PT.SMK.4', 'Papan Tulis', 2018, 500000),
(35, 'PT.SMK.5', 'Papan Tulis', 2018, 500000),
(36, 'PT.SMK.6', 'Papan Tulis', 2018, 50000),
(37, 'PT.SMK.7', 'Papan Tulis', 2018, 50000),
(38, 'PT.SMK.8', 'Papan Tulis', 2018, 50000),
(39, 'PT.SMK.9', 'Papan Tulis', 2018, 50000),
(40, 'PT.SMK.10', 'Papan Tulis', 2018, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_role` enum('disdakmen','yayasan','kepsek','admin') NOT NULL,
  `role_location` enum('sd','smp','sma','smk','-') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nama_user`, `nip`, `password`, `nama_role`, `role_location`) VALUES
(1, 'H. Maman Kariman', '1993762', '15cf8c8bae47f076cfe7301e13ae8f5dae46c1de', 'disdakmen', '-'),
(2, 'Kepala Sekolah SD', '67890', '82b7283910ac7cb508ea7ecc645e5c944d7fb612', 'kepsek', 'sd'),
(4, 'Kepala Sekolah SMP', '13579', '82b7283910ac7cb508ea7ecc645e5c944d7fb612', 'kepsek', 'smp'),
(5, 'Ketua Yayasan', '1989022001', '23349438310fbf6efb8579094440db66533a9dfc', 'yayasan', '-'),
(6, 'Kepala Sekolah SMA', '09876', '82b7283910ac7cb508ea7ecc645e5c944d7fb612', 'kepsek', 'sma'),
(7, 'Kepala Sekolah SMK', '54321', '82b7283910ac7cb508ea7ecc645e5c944d7fb612', 'kepsek', 'smk'),
(8, 'Admin SD', '123455', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'sd'),
(9, 'Admin SMP', '123456', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'smp'),
(10, 'Admin SMA', '123457', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'sma'),
(11, 'Admin SMK', '123458', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'smk');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_aset`
--

CREATE TABLE `monitoring_aset` (
  `id_monitoring_aset` int(11) NOT NULL,
  `id_aset` int(11) NOT NULL,
  `periode_monitoring` enum('1','2','3','4') NOT NULL,
  `tahun_monitoring` year(4) NOT NULL,
  `jumlah_aset` int(11) NOT NULL,
  `kondisi_aset` enum('Sangat Rusak','Rusak','Kurang Baik','Baik') NOT NULL,
  `lokasi_aset` enum('sd','smp','sma','smk') NOT NULL,
  `prioritas_aset` enum('Sangat Berprioritas','Berprioritas','Cukup Berprioritas','Kurang Berprioritas') NOT NULL,
  `ajukan_aset` enum('belum','sudah') NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitoring_aset`
--

INSERT INTO `monitoring_aset` (`id_monitoring_aset`, `id_aset`, `periode_monitoring`, `tahun_monitoring`, `jumlah_aset`, `kondisi_aset`, `lokasi_aset`, `prioritas_aset`, `ajukan_aset`) VALUES
(1, 1, '4', 2019, 1, 'Sangat Rusak', 'sd', 'Sangat Berprioritas', 'sudah'),
(2, 2, '4', 2019, 1, 'Sangat Rusak', 'sd', 'Sangat Berprioritas', 'sudah'),
(3, 3, '4', 2019, 1, 'Sangat Rusak', 'sd', 'Sangat Berprioritas', 'sudah'),
(4, 4, '4', 2019, 1, 'Sangat Rusak', 'sd', 'Sangat Berprioritas', 'belum'),
(5, 5, '4', 2019, 1, 'Sangat Rusak', 'sd', 'Sangat Berprioritas', 'belum'),
(6, 6, '4', 2019, 1, 'Baik', 'sd', 'Kurang Berprioritas', 'belum'),
(7, 7, '4', 2019, 1, 'Baik', 'sd', 'Kurang Berprioritas', 'belum'),
(8, 8, '4', 2019, 1, 'Baik', 'sd', 'Kurang Berprioritas', 'belum'),
(9, 9, '4', 2019, 1, 'Baik', 'sd', 'Kurang Berprioritas', 'belum'),
(10, 10, '4', 2019, 1, 'Baik', 'sd', 'Kurang Berprioritas', 'belum'),
(11, 11, '4', 2019, 1, 'Rusak', 'smp', 'Berprioritas', 'belum'),
(12, 12, '4', 2019, 1, 'Rusak', 'smp', 'Berprioritas', 'belum'),
(13, 13, '4', 2019, 1, 'Rusak', 'smp', 'Berprioritas', 'belum'),
(14, 14, '4', 2019, 1, 'Rusak', 'smp', 'Berprioritas', 'belum'),
(15, 15, '4', 2019, 1, 'Rusak', 'smp', 'Berprioritas', 'belum'),
(16, 16, '4', 2019, 1, 'Kurang Baik', 'smp', 'Cukup Berprioritas', 'belum'),
(17, 17, '4', 2019, 1, 'Kurang Baik', 'smp', 'Cukup Berprioritas', 'belum'),
(18, 18, '4', 2019, 1, 'Kurang Baik', 'smp', 'Cukup Berprioritas', 'belum'),
(19, 19, '4', 2019, 1, 'Kurang Baik', 'smp', 'Cukup Berprioritas', 'belum'),
(20, 20, '4', 2019, 1, 'Kurang Baik', 'smp', 'Cukup Berprioritas', 'belum'),
(21, 21, '4', 2019, 1, 'Sangat Rusak', 'sma', 'Sangat Berprioritas', 'belum'),
(22, 22, '4', 2019, 1, 'Sangat Rusak', 'sma', 'Sangat Berprioritas', 'belum'),
(23, 23, '4', 2019, 1, 'Sangat Rusak', 'sma', 'Sangat Berprioritas', 'belum'),
(24, 24, '4', 2019, 1, 'Sangat Rusak', 'sma', 'Sangat Berprioritas', 'belum'),
(25, 25, '4', 2019, 1, 'Sangat Rusak', 'sma', 'Sangat Berprioritas', 'belum'),
(26, 26, '4', 2019, 1, 'Baik', 'sma', 'Kurang Berprioritas', 'belum'),
(27, 27, '4', 2019, 1, 'Baik', 'sma', 'Kurang Berprioritas', 'belum'),
(28, 28, '4', 2019, 1, 'Baik', 'sma', 'Kurang Berprioritas', 'belum'),
(29, 29, '4', 2019, 1, 'Baik', 'sma', 'Kurang Berprioritas', 'belum'),
(30, 30, '4', 2019, 1, 'Baik', 'sma', 'Kurang Berprioritas', 'belum'),
(31, 31, '4', 2019, 1, 'Rusak', 'smk', 'Berprioritas', 'belum'),
(32, 32, '4', 2019, 1, 'Rusak', 'smk', 'Berprioritas', 'belum'),
(33, 33, '4', 2019, 1, 'Rusak', 'smk', 'Berprioritas', 'belum'),
(34, 34, '4', 2019, 1, 'Rusak', 'smk', 'Berprioritas', 'belum'),
(35, 35, '4', 2019, 1, 'Rusak', 'smk', 'Berprioritas', 'belum'),
(36, 36, '4', 2019, 1, 'Kurang Baik', 'smk', 'Cukup Berprioritas', 'belum'),
(37, 37, '4', 2019, 1, 'Kurang Baik', 'smk', 'Cukup Berprioritas', 'belum'),
(38, 38, '4', 2019, 1, 'Kurang Baik', 'smk', 'Cukup Berprioritas', 'belum'),
(39, 39, '4', 2019, 1, 'Kurang Baik', 'smk', 'Cukup Berprioritas', 'belum'),
(40, 40, '4', 2019, 1, 'Kurang Baik', 'smk', 'Cukup Berprioritas', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_aset`
--

CREATE TABLE `pengajuan_aset` (
  `id_pengajuan` int(11) NOT NULL,
  `id_monitoring_aset` int(11) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_persetujuan` date DEFAULT NULL,
  `status_pengajuan` enum('1','2','3','4','5') NOT NULL,
  `status_aset` enum('diganti','diperbaiki','dihapus') NOT NULL,
  `harga_perkiraan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_aset`
--

INSERT INTO `pengajuan_aset` (`id_pengajuan`, `id_monitoring_aset`, `tanggal_pengajuan`, `tanggal_persetujuan`, `status_pengajuan`, `status_aset`, `harga_perkiraan`, `id_user`) VALUES
(1, 1, '2020-09-01', '2020-09-01', '3', 'diganti', 154077, 1),
(2, 2, '2020-09-01', '2020-09-01', '2', 'diganti', 154077, 1),
(3, 3, '2020-09-01', NULL, '1', 'diganti', 154077, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_aset`
--
ALTER TABLE `data_aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `monitoring_aset`
--
ALTER TABLE `monitoring_aset`
  ADD PRIMARY KEY (`id_monitoring_aset`);

--
-- Indexes for table `pengajuan_aset`
--
ALTER TABLE `pengajuan_aset`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_aset`
--
ALTER TABLE `data_aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `monitoring_aset`
--
ALTER TABLE `monitoring_aset`
  MODIFY `id_monitoring_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pengajuan_aset`
--
ALTER TABLE `pengajuan_aset`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
