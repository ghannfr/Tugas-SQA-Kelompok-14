-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2026 at 10:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengaduanujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_pengaduan`
--

CREATE TABLE `t_pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `isi_laporan` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pengaduan`
--

INSERT INTO `t_pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `id_user`, `isi_laporan`, `foto`, `status`) VALUES
(9, '2026-04-29', 11, 'Saya mau melaporkan ada jalanan rusak di daerah kota baru', 'Screenshot 2026-04-28 140127.png', 1),
(10, '2026-04-29', 11, 'Saya melihat hantu', 'Konan.jpg', 1),
(11, '0000-00-00', 11, 'Hay', 'Picture1.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_tanggapan`
--

CREATE TABLE `t_tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` varchar(100) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_tanggapan`
--

INSERT INTO `t_tanggapan` (`id_tanggapan`, `tgl_tanggapan`, `tanggapan`, `id_pengaduan`, `id_user`) VALUES
(4, '2026-04-29', 'siap bos', 9, 10),
(5, '2026-04-29', 'Siap kami batu', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL,
  `level` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `is_verified` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `nik`, `username`, `password`, `nama`, `no_tlp`, `alamat`, `level`, `email`, `otp`, `is_verified`) VALUES
(10, 2147483647, 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 'Ghani Nasywa Fadlurohman', '083224245353', 'Ciparay', 1, 'ghaninasywafadlurohman@gmail.com', '745257', 1),
(11, 2147483647, 'Tans01', '2f291abfc07edc2fd54298aacaac66ed', 'Tania Cahyani Putri', '08389601056', 'Kota Baru', 3, 'taniacahyaniputri@gmail.com', '355581', 1),
(12, 2147483647, 'manji', 'bcf1c05dd32d72ee396901ba461ebea6', 'Maman Hidayat', '085457767555', 'Majalengka Selatan', 3, 'mamanhidayat067@gmail.com', '867303', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_pengaduan`
--
ALTER TABLE `t_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_tanggapan`
--
ALTER TABLE `t_tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_pengaduan`
--
ALTER TABLE `t_pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_tanggapan`
--
ALTER TABLE `t_tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_pengaduan`
--
ALTER TABLE `t_pengaduan`
  ADD CONSTRAINT `t_pengaduan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_tanggapan`
--
ALTER TABLE `t_tanggapan`
  ADD CONSTRAINT `t_tanggapan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `t_pengaduan` (`id_pengaduan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_tanggapan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
