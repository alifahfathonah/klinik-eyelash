-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2021 at 04:15 AM
-- Server version: 10.2.39-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitesidadmin_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_slot` int(11) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL,
  `warna` varchar(10) DEFAULT NULL,
  `start` varchar(255) NOT NULL,
  `start_jam` varchar(50) NOT NULL,
  `ends` varchar(255) NOT NULL,
  `ends_jam` varchar(50) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `transfer` varchar(255) NOT NULL,
  `cash` varchar(255) NOT NULL,
  `sumber` varchar(20) NOT NULL,
  `tgl_retouch` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `id_users`, `id_jabatan`, `id_cabang`, `id_produk`, `id_slot`, `id_tipe`, `no_telp`, `nama`, `tgl_lahir`, `warna`, `start`, `start_jam`, `ends`, `ends_jam`, `harga`, `transfer`, `cash`, `sumber`, `tgl_retouch`, `keterangan`, `status`) VALUES
(6, 0, 1, 1, 0, 0, 0, '089656606169', 'reksi', '', NULL, '', '', '', '', '', '', '', 'IG', '', '', 2),
(7, 2, 1, 1, 1, 1, 0, '089656606169', 'juliantara', '2021-07-11', '#008000', '2021-07-11', '09:00', '', '11:00', '150000', '100000', '50000', 'IG', '2021-07-20', 'An Reksi Juliantara', 1),
(8, 2, 2, 1, 2, 2, 0, '089656606169', 'putra', '1999-01-13', '#008000', '2021-07-13', '10:00', '', '15:00', '200000', '200000', '', 'IG', '2021-07-12', 'An Reksi Juliantara', 1),
(9, 3, 1, 1, 3, 5, 0, '089656606169', 'jujun', '2021-07-12', '#0071c5', '2021-07-13', '13:00', '', '14:00', '250000', '100000', '20000', 'Teman', '2021-08-16', 'An Reksi Juliantara', 1),
(11, 2, 0, 1, 1, 0, 0, '12345678', 'TES', '2021-08-13', '#008000', '2021-08-15', '09:00', '', '', '150000', '1500000', '', 'IG', '', '', 1),
(12, 4, 0, 1, 1, 0, 0, '123456', 'ASEP', '0001-01-01', '#008000', '2021-08-23', '09:00', '', '', '150000', '150000', '', 'IG', '', 'adadasd', 1),
(13, 5, 0, 1, 1, 0, 0, '1231414324', 'qdadas', '0111-11-11', '#008000', '2021-08-22', '09:00', '', '', '150000', '1500000', '', 'Teman', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id_booking` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `sumber` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cabang`
--

CREATE TABLE `tbl_cabang` (
  `id_cabang` int(11) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cabang`
--

INSERT INTO `tbl_cabang` (`id_cabang`, `nama_cabang`) VALUES
(1, 'Buah Batu'),
(2, 'Cimbuleuit'),
(4, 'Ujung Berung');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Senior'),
(2, 'Junior');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `harga`) VALUES
(1, 'Classic', '150000'),
(2, 'Semi Volume\r\n', '200000'),
(3, 'Volume\r\n', '250000'),
(4, 'Upgrade C ke SV\r\n', '150000'),
(5, 'Upgrade C ke V\r\n', '200000'),
(6, 'Upgrade SV ke V\r\n', '175000'),
(7, 'Remove\r\n', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slot`
--

CREATE TABLE `tbl_slot` (
  `id_slot` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `jam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slot`
--

INSERT INTO `tbl_slot` (`id_slot`, `id_cabang`, `id_jabatan`, `jam`) VALUES
(1, 1, 1, '09:00'),
(2, 1, 1, '10:00'),
(3, 1, 1, '11:00'),
(4, 1, 1, '12:00'),
(5, 1, 1, '13:00'),
(6, 2, 2, '09:00'),
(7, 2, 2, '10:00'),
(8, 2, 2, '11:00'),
(9, 2, 2, '12:00'),
(10, 2, 2, '13:00'),
(11, 1, 2, '09:00'),
(12, 1, 2, '10:00'),
(13, 1, 2, '11:00'),
(14, 1, 2, '12:00'),
(15, 1, 2, '13:00'),
(16, 2, 1, '09:00'),
(17, 2, 1, '10:00'),
(18, 2, 1, '11:00'),
(19, 2, 1, '12:00'),
(20, 2, 1, '13:00'),
(21, 3, 1, '09:00'),
(22, 3, 1, '10:00'),
(23, 3, 1, '11:00'),
(24, 3, 1, '12:00'),
(25, 3, 1, '13:00'),
(26, 3, 2, '09:00'),
(27, 3, 2, '10:00'),
(28, 3, 2, '11:00'),
(29, 3, 2, '12:00'),
(30, 3, 2, '13:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_kerja`
--

CREATE TABLE `tbl_status_kerja` (
  `id_kerja` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `status_kerja` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status_kerja`
--

INSERT INTO `tbl_status_kerja` (`id_kerja`, `id_users`, `status_kerja`, `tanggal`) VALUES
(1, 2, 1, '2021-08-11'),
(2, 3, 1, '2021-07-30'),
(3, 4, 1, '2021-07-30'),
(4, 5, 1, '2021-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipe`
--

CREATE TABLE `tbl_tipe` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tipe`
--

INSERT INTO `tbl_tipe` (`id_tipe`, `nama_tipe`) VALUES
(1, 'Ret - S V'),
(2, 'C'),
(3, 'S V'),
(4, 'Rem + C'),
(5, 'Ret - V'),
(6, 'Ret S - V');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `status_kerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `level`, `status_kerja`) VALUES
(1, 'admin', '$2y$10$tTNgG1026VY6Axg94A/c4Oe0RoZkt0XfEKmgRfgn1P29Ff.cAEAeO', 1, 0),
(2, 'derisa', '$2y$10$kPGadX693FlCOFQAhDaRjuagN.gQMBO29esJGl7lkmkCnWCA2JGbq', 2, 1),
(3, 'dini', '$2y$10$C/rxpuNTzMH35iYHjeqj/u9P.4I.w5T5U2mTX3cIa68GIQvpqEcVi', 2, 1),
(4, 'fitri', '$2y$10$dl7Oz87jrsDw3KV.8adEkeJxsSZOIKMZwgvQOwmerR/hZLLv.bHEu', 2, 0),
(5, 'gita', '$2y$10$LszvkhSDuyxhxojRwj4CT.YMig1YMi6Ct3Bqtd/CwlyEuIFBI.W1O', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `tbl_cabang`
--
ALTER TABLE `tbl_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_slot`
--
ALTER TABLE `tbl_slot`
  ADD PRIMARY KEY (`id_slot`);

--
-- Indexes for table `tbl_status_kerja`
--
ALTER TABLE `tbl_status_kerja`
  ADD PRIMARY KEY (`id_kerja`);

--
-- Indexes for table `tbl_tipe`
--
ALTER TABLE `tbl_tipe`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cabang`
--
ALTER TABLE `tbl_cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_slot`
--
ALTER TABLE `tbl_slot`
  MODIFY `id_slot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_status_kerja`
--
ALTER TABLE `tbl_status_kerja`
  MODIFY `id_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_tipe`
--
ALTER TABLE `tbl_tipe`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
