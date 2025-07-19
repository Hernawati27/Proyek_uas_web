-- phpMyAdmin SQL Dump
-- version 5.2.1

CREATE DATABASE IF NOT EXISTS rekam_medis;
USE rekam_medis;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','perawat') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` VALUES
(1, 'admin', '$2y$10$eW5xJipf3DQzQyVuMkptCuvmQeJkILgOtBSW..X8So4h5/dzWWYx2', 'admin', '2025-07-19 13:26:09'),
(5, 'dokter', '$2y$10$jlM/2xWg5CfDTYxJwUFkPejamiCUpdeRcdolY.uCx1xsZTZA8oPZi', 'dokter', '2025-07-19 14:12:57');

-- --------------------------------------------------------

CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `admin_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dokter` VALUES
(1, 'Dr. Ahmad', 'Umum', '081234567800', '2025-07-19 13:26:10'),
(2, 'Dr. Rina', 'Anak', '081234567801', '2025-07-19 13:26:10');

-- --------------------------------------------------------

CREATE TABLE `poliklinik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_poli` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `poliklinik` VALUES
(1, 'Poli Umum', 'Pelayanan pemeriksaan umum'),
(2, 'Poli Anak', 'Pelayanan kesehatan anak');

-- --------------------------------------------------------

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pasien` VALUES
(1, '1234567890123456', 'Budi Santoso', '1990-05-10', 'L', 'Jl. Merdeka No. 10', '081234567890', '2025-07-19 13:26:10'),
(2, '1234567890123457', 'Siti Aminah', '1992-08-15', 'P', 'Jl. Pahlawan No. 5', '081234567891', '2025-07-19 13:26:10');

-- --------------------------------------------------------

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) DEFAULT NULL,
  `dokter_id` int(11) DEFAULT NULL,
  `poli_id` int(11) DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `diagnosa` text DEFAULT NULL,
  `tanggal_periksa` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `dokter_id` (`dokter_id`),
  KEY `poli_id` (`poli_id`),
  CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rekam_medis_ibfk_3` FOREIGN KEY (`poli_id`) REFERENCES `poliklinik` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `jadwal_dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dokter_id` int(11) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokter_id` (`dokter_id`),
  CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_obat` varchar(100) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `obat` VALUES
(1, 'Paracetamol', 'Tablet', 100),
(2, 'Amoxicillin', 'Kapsul', 50);

-- --------------------------------------------------------

CREATE TABLE `resep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rekam_medis_id` int(11) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `dosis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekam_medis_id` (`rekam_medis_id`),
  KEY `obat_id` (`obat_id`),
  CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rekam_medis_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` enum('Lunas','Belum Lunas') DEFAULT 'Belum Lunas',
  `tanggal_bayar` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekam_medis_id` (`rekam_medis_id`),
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;
