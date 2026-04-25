-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2026 at 04:50 AM
-- Server version: 8.4.3
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-bk`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `id` int NOT NULL,
  `nama_pelanggaran` varchar(255) NOT NULL,
  `kategori` enum('Ringan','Sedang','Berat') DEFAULT 'Ringan',
  `poin` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_pelanggaran`
--

INSERT INTO `jenis_pelanggaran` (`id`, `nama_pelanggaran`, `kategori`, `poin`, `created_at`) VALUES
(1, 'Terlambat Masuk Sekolah', 'Ringan', 5, '2026-04-25 02:15:17'),
(2, 'Tidak Memakai Atribut Lengkap', 'Ringan', 10, '2026-04-25 02:15:17'),
(3, 'Membolos Pelajaran', 'Sedang', 20, '2026-04-25 02:15:17'),
(4, 'Merusak Fasilitas Sekolah', 'Berat', 50, '2026-04-25 02:15:17'),
(5, 'Berkelahi / Tawuran', 'Berat', 100, '2026-04-25 02:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `walikelas_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `walikelas_id`) VALUES
(1, 'X IPA 1', 5),
(2, 'XI IPS 2', 6),
(4, 'XII IPA 1', 3),
(5, 'XII IPS 2', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `nama_pelanggaran` varchar(255) NOT NULL,
  `poin` int NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_cetak` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id`, `siswa_id`, `nama_pelanggaran`, `poin`, `tanggal`, `keterangan`, `created_at`, `is_cetak`) VALUES
(1, 1, 'Membawa sajam', 100, '2026-04-24', '', '2026-04-24 13:15:43', 1),
(2, 3, 'Makan ojek saat jam pelajaran', 15, '2026-04-25', '', '2026-04-25 02:38:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text,
  `total_poin` int DEFAULT '0',
  `foto` varchar(255) DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah_panggilan` int DEFAULT '0',
  `angkatan` varchar(4) DEFAULT '2024'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nisn`, `nama`, `kelas`, `jenis_kelamin`, `alamat`, `total_poin`, `foto`, `created_at`, `jumlah_panggilan`, `angkatan`) VALUES
(1, '1234567890', 'Ahmad Fauzi', 'X IPA 1', 'Laki-laki', 'Surakarta', 100, 'default.png', '2026-04-24 12:48:47', 5, '2024'),
(2, '1234567891', 'Siti Aminah', 'XI IPS 2', 'Perempuan', 'Boyolali', 0, 'default.png', '2026-04-24 12:48:47', 0, '2024'),
(3, '12345678910', 'Wahyu', 'X IPA 1', 'Laki-laki', 'Juwiring', 15, 'default.png', '2026-04-24 13:37:16', 0, '2026');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','guru_bk','walikelas') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$FwDRbO976ZkeC13pRqiaQut23ldRDzu9rKHbSdr2ozpJOIqMAGMbK', 'Super Admin', 'admin', '2026-04-24 12:48:47'),
(2, 'gurubk', '$2y$10$e7/82KUVb1rWqz2QJdcmPeOlB45zSq4P5PiOlzhJ/bhywyaAoO71K', 'Drs. Ahmad Fauzi', 'guru_bk', '2026-04-24 12:48:47'),
(3, 'walikelas1', '$2y$10$E4V7e/yTKnFU5uiCYiu3OuCE3RyuGHAB0DrNuTLU3sXe07aR3vE0a', 'Handayani, S.Pd', 'walikelas', '2026-04-24 12:49:36'),
(4, 'Siti92', '$2y$10$gcyeZbKGjObQNNUTpWzPKeNM4Fa29e8sCQx/t5xngbrqtP.MBUjbe', 'Siti, S.Pd', 'walikelas', '2026-04-24 13:05:58'),
(5, 'walikelas2', '$2y$10$3DNmVlVX9eCTA6VEOcxEk.OsMRdYEarrRqo5gJbtOYJOP7LFuK2ZC', 'Hanafi, S.Kom', 'walikelas', '2026-04-24 13:07:16'),
(6, 'walikelas', '$2y$10$5yfpPjVbBmkvPtqjN8IkYuldQM3kafVEzgO0KKDQhpr8BT7wY0Or6', 'Wali Kelas XI IPA 1', 'walikelas', '2026-04-24 13:12:45'),
(7, 'walikelas3', '$2y$10$yRrVBB4xzDhipIN.KVo.l.llsR0ljdkimIlIurrlc80zrtvOua6yK', 'Agus Purwadi, S.T', 'walikelas', '2026-04-24 13:26:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `walikelas_id` (`walikelas_id`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`walikelas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
