-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2025 pada 16.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_data_dosen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang_keahlian`
--

CREATE TABLE `bidang_keahlian` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `nama_keahlian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang_keahlian`
--

INSERT INTO `bidang_keahlian` (`id`, `dosen_id`, `nama_keahlian`) VALUES
(4, 5, 'Ilmu Komputer'),
(5, 6, 'Ilmu Komputer'),
(6, 5, 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nidn` char(10) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `gelar` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `user_id`, `nidn`, `nip`, `gelar`, `alamat`, `telepon`, `foto`) VALUES
(5, 6, '0022220016', '0022220016', 'M.Kom', 'Rabangodu Utara', '082340625908', '1749388170_e95542d2ac7d1cacca5f.jpeg'),
(6, 7, '0011223344', '', 'M.Kom', 'Ngali', '082345678999', '1749698786_ace558ce209b45bf88e9.jpg'),
(7, 11, '0022230071', '', '', 'Wera', '082341396531', '1749909247_b054b35f26079f0b0c6c.jpg'),
(8, 13, '0022230073', '', 'M.Kom', 'Sape', '082341371229', '1749909347_d3f6830995e4e4a9a87c.jpg'),
(9, 14, '0022230076', '', 'M.Kom', 'Wera', '082341371235', '1749910233_eb16e233c02b29b5d251.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `evaluasi_kinerja`
--

CREATE TABLE `evaluasi_kinerja` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `tahun_ajaran` varchar(20) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tanggal_evaluasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `evaluasi_kinerja`
--

INSERT INTO `evaluasi_kinerja` (`id`, `dosen_id`, `semester`, `tahun_ajaran`, `skor`, `catatan`, `tanggal_evaluasi`) VALUES
(7, 6, NULL, NULL, 83, NULL, '2024-01-10'),
(8, 6, NULL, NULL, 88, NULL, '2024-03-15'),
(9, 6, NULL, NULL, 91, NULL, '2024-05-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `mata_kuliah` varchar(100) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `ruang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_mengajar`
--

INSERT INTO `jadwal_mengajar` (`id`, `dosen_id`, `mata_kuliah`, `hari`, `jam_mulai`, `jam_selesai`, `ruang`) VALUES
(3, 5, 'Web Developer', 'Senin', '08:00:00', '10:30:00', '1'),
(4, 6, 'Pakar Telematika', 'Selasa', '08:00:00', '10:30:00', '2'),
(5, 6, 'Sistem Informasi', 'Rabu', '08:00:00', '10:00:00', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_perubahan`
--

CREATE TABLE `permintaan_perubahan` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `data_yang_diubah` text DEFAULT NULL,
  `status` enum('pending','diterima','ditolak') DEFAULT 'pending',
  `tanggal_permintaan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `portofolio`
--

CREATE TABLE `portofolio` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `kategori` enum('pengajaran','penelitian','pengabdian') NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `portofolio`
--

INSERT INTO `portofolio` (`id`, `dosen_id`, `kategori`, `judul`, `deskripsi`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 6, 'pengajaran', 'Mengajar Tentang Kehidupan', 'Ini hanya contoh', 2024, '2025-06-14 12:30:46', '2025-06-14 12:30:46'),
(2, 6, 'penelitian', 'Contoh Penelitian', 'Ini Contoh', 2022, '2025-06-14 13:16:48', '2025-06-14 13:18:54'),
(3, 6, 'pengabdian', 'Contoh Pengabdian', 'Ini Hanya Contoh', 2020, '2025-06-14 13:17:25', '2025-06-14 13:17:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','dosen') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(6, 'Muchlis', 'muchlisbazzank@gmail.com', '$2y$10$W6L2vwN7s7Q5avrfKbhbC.mp12Ke08I4mr6Wj4AhnteDTCHO3w7KO', 'dosen', '2025-06-07 15:57:13', '2025-06-07 15:57:13'),
(7, 'Salman', 'salmanbahagia@gmail.com', '$2y$10$PDebvLj9TWFAEZoDxHijdujyPa8s6s9IXQUs.hXwlUdH2G7lnagQK', 'dosen', '2025-06-07 16:03:05', '2025-06-13 12:23:47'),
(9, 'Admin Bazzank', 'bazzank@gmail.com', '$2y$10$Eaa0POUNdYhd8feF5S3W2eMbHybyZtGcdAQwDRaUoC7jvu9N30Leq', 'admin', '2025-06-08 17:40:51', '2025-06-08 17:40:51'),
(11, 'Mirdan', 'mirdanbuzzer@gmail.com', '$2y$10$Db9zVbdeUH1.hKF/ltxXY.yLH2qlUMudh.hgMz8nlKnrrH4JlXAPG', 'dosen', '2025-06-08 11:13:40', '2025-06-08 11:13:40'),
(12, 'Bazzank', 'adminbazzank@gmail.com', '$2y$10$ITjYfGzrq0r3mAMcHu3x8.B3JhZ6GgnydI23nbWZcwBrxH1MN7lYi', 'admin', '2025-06-08 20:29:42', '2025-06-08 20:29:42'),
(13, 'Wahyu', 'wahyutri@gmail.com', '$2y$10$ZdEspY97Virk/7QuOoTM8O46NpCzrKZ757sE1mboLr116EOFgPtE2', 'dosen', '2025-06-13 13:54:08', '2025-06-13 13:54:08'),
(14, 'Muslimin', 'kangmustofa@gmail.com', '$2y$10$myKpCc.Ciwq7WLN2XHDvEOCfhOFZku1I.jEW1cwPwfT9O9.JJPsZS', 'dosen', '2025-06-14 14:09:06', '2025-06-14 14:09:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidn` (`nidn`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `evaluasi_kinerja`
--
ALTER TABLE `evaluasi_kinerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indeks untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indeks untuk tabel `permintaan_perubahan`
--
ALTER TABLE `permintaan_perubahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indeks untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `evaluasi_kinerja`
--
ALTER TABLE `evaluasi_kinerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `permintaan_perubahan`
--
ALTER TABLE `permintaan_perubahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  ADD CONSTRAINT `bidang_keahlian_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `evaluasi_kinerja`
--
ALTER TABLE `evaluasi_kinerja`
  ADD CONSTRAINT `evaluasi_kinerja_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD CONSTRAINT `jadwal_mengajar_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permintaan_perubahan`
--
ALTER TABLE `permintaan_perubahan`
  ADD CONSTRAINT `permintaan_perubahan_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permintaan_perubahan_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`);

--
-- Ketidakleluasaan untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  ADD CONSTRAINT `portofolio_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
