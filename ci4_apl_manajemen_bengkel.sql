-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2024 at 09:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4_apl_manajemen_bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(2, 1, 'developer', '2023-12-14 06:10:09'),
(6, 6, 'admin', '2023-12-29 15:11:36'),
(7, 7, 'pemilik', '2024-01-03 08:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', 'Atha Nabil', 'thalalatha13@gmail.com', '$2y$12$mJWVZw8ySA3KnlVDzIIapeAgP5zcSvDISkEeyBcsQRYEeT9sPFzz.', NULL, NULL, 0, '2024-01-03 08:09:51', '2023-12-14 06:05:18', '2024-01-03 08:09:51'),
(6, 6, 'email_password', NULL, 'raldy@gmail.com', '$2y$12$v6.vNjt.51lT1/YZI3hh1Od1ztZPh0J/TuyFpPbU74WapbqZP4JVS', NULL, NULL, 0, NULL, '2023-12-29 15:11:36', '2023-12-29 15:11:36'),
(7, 7, 'email_password', NULL, 'mochrafly@gmail.com', '$2y$12$PioPbEjJvJJGhDE2sZrj2ut8HvW1kItGKgvjgsCAaG2E6aX1EeQ8a', NULL, NULL, 0, NULL, '2024-01-03 08:22:51', '2024-01-03 08:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'email_password', 'thalalatha13@gmail.com', 1, '2023-12-14 06:08:34', 1),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntx', 1, '2023-12-14 09:42:09', 1),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntx', 1, '2023-12-14 10:37:36', 1),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntx', NULL, '2023-12-19 15:53:04', 0),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntx', NULL, '2023-12-19 15:53:23', 0),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntx', NULL, '2023-12-19 15:53:34', 0),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntxx', 1, '2023-12-19 15:54:08', 1),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntxx', 1, '2023-12-19 18:35:02', 1),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntxx', 1, '2023-12-20 01:18:53', 1),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntxx', NULL, '2023-12-20 15:33:44', 0),
(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntxx', NULL, '2023-12-20 15:45:11', 0),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntxx', 1, '2023-12-20 15:45:21', 1),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntxx', 1, '2023-12-21 01:11:49', 1),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'username', 'ryzntxx', 1, '2023-12-21 09:41:37', 1),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-22 02:59:17', 1),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-22 09:22:32', 1),
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-22 12:40:42', 1),
(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-23 12:19:10', 1),
(19, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-23 16:30:11', 1),
(20, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-24 07:25:38', 1),
(21, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'mochrafly', NULL, '2023-12-24 10:03:38', 0),
(22, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntx', NULL, '2023-12-24 10:03:49', 0),
(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-24 10:05:07', 1),
(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'mochrafly', NULL, '2023-12-24 10:05:41', 0),
(25, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'mochrafly', 4, '2023-12-24 10:06:14', 1),
(26, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-24 16:52:12', 1),
(27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-25 00:38:46', 1),
(28, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-25 00:47:14', 1),
(29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-25 08:24:11', 1),
(30, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-26 06:31:10', 1),
(31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-27 00:50:58', 1),
(32, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-27 04:37:42', 1),
(33, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-27 07:55:33', 1),
(34, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-27 23:46:41', 1),
(35, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-27 23:51:44', 1),
(36, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-28 03:15:54', 1),
(37, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-29 10:09:05', 1),
(38, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-29 15:10:34', 1),
(39, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-29 18:40:49', 1),
(40, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-30 02:39:21', 1),
(41, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2023-12-30 04:44:08', 1),
(42, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2024-01-01 03:54:23', 1),
(43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2024-01-02 00:47:26', 1),
(44, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2024-01-02 06:59:08', 1),
(45, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2024-01-02 11:58:41', 1),
(46, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2024-01-03 00:58:07', 1),
(47, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2024-01-03 01:59:20', 1),
(48, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'username', 'ryzntxx', 1, '2024-01-03 08:09:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int UNSIGNED NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `merek_barang` varchar(120) NOT NULL,
  `jumlah_stok` int NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `id_supplier` int UNSIGNED DEFAULT NULL,
  `id_kategori_barang` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama`, `merek_barang`, `jumlah_stok`, `harga_beli`, `harga_jual`, `id_supplier`, `id_kategori_barang`, `created_at`, `updated_at`) VALUES
(16, 'DSM43860379', 'Kampas Rem Depan ', 'YGP', 9, 30000, 40000, 3, 2, '2023-12-27 20:20:07', '2024-01-01 02:16:18'),
(17, 'DSM49295035', 'Filter Oli R15', 'YGP', 5, 70000, 80000, 1, 1, '2023-12-27 20:21:05', '2023-12-27 20:21:05'),
(18, 'DSM99659894', 'Kampas Rem Depan', 'YGP', 8, 40000, 50000, 1, 1, '2023-12-30 22:29:17', '2023-12-30 22:29:17'),
(19, 'DSM97310445', 'Tali Gas Nmax', 'YGP', 4, 140000, 150000, 1, 1, '2023-12-31 23:37:10', '2023-12-31 23:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int UNSIGNED NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `no_plat` varchar(10) NOT NULL,
  `model_kendaraan` varchar(120) NOT NULL,
  `nama_pemilik` varchar(120) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `kode_transaksi`, `no_plat`, `model_kendaraan`, `nama_pemilik`, `no_telp`, `created_at`, `updated_at`) VALUES
(2, 'INV202401025', 'T 1234 V', 'Yamaha Nouvo', 'Atha', '', '2024-01-02 06:19:01', '2024-01-02 06:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int UNSIGNED NOT NULL,
  `kode_pembelian` varchar(120) NOT NULL,
  `id_barang` int UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `kode_pembelian`, `id_barang`, `jumlah`, `total_harga`, `created_at`, `updated_at`) VALUES
(13, 'PO202401011', 17, 1, 70000, '2024-01-01 00:54:17', '2024-01-01 00:54:17'),
(14, 'PO202401012', 16, 1, 30000, '2024-01-01 02:05:28', '2024-01-01 02:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int UNSIGNED NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `id_barang` int UNSIGNED DEFAULT NULL,
  `id_layanan_servis` int UNSIGNED DEFAULT NULL,
  `qty` int NOT NULL,
  `total_harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `kode_transaksi`, `id_barang`, `id_layanan_servis`, `qty`, `total_harga`, `created_at`, `updated_at`) VALUES
(7, 'INV202401021', 16, NULL, 1, 40000, '2024-01-02 05:42:46', '2024-01-02 05:42:46'),
(8, 'INV202401022', 17, NULL, 1, 80000, '2024-01-02 05:44:16', '2024-01-02 05:44:16'),
(9, 'INV202401023', 18, NULL, 1, 50000, '2024-01-02 05:49:41', '2024-01-02 05:49:41'),
(10, 'INV202401023', NULL, 1, 1, 10000, '2024-01-02 05:49:41', '2024-01-02 05:49:41'),
(13, 'INV202401025', 16, NULL, 1, 40000, '2024-01-02 06:19:01', '2024-01-02 06:19:01'),
(14, 'INV202401025', NULL, 1, 1, 10000, '2024-01-02 06:19:01', '2024-01-02 06:19:01'),
(15, 'INV202401026', 17, NULL, 1, 80000, '2024-01-02 06:24:01', '2024-01-02 06:24:01'),
(18, 'INV202401028', 19, NULL, 1, 150000, '2024-01-02 06:47:33', '2024-01-02 06:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id` int NOT NULL,
  `type` varchar(120) NOT NULL,
  `data` json DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id`, `type`, `data`, `visibility`) VALUES
(1, 'section1-headline', '{\"title\": \"Selamat Datang di DS Motor Cinangsi\", \"subtitle\": \"Kami menyediakan layanan perbaikan sepeda motor yang profesional dengan harga terjangkau.\"}', 1),
(2, 'section2-headline', '{\"title\": \"Layanan Kami\", \"subtitle\": \"Kami menawarkan berbagai layanan perbaikan dan perawatan sepeda motor.\"}', 1),
(3, 'section3-headline', '{\"title\": \"Kenapa Memilih Kami?\", \"subtitle\": \"Berikut adalah beberapa alasan mengapa Anda harus memilih bengkel motor kami.\"}', 1),
(4, 'section4-headline', '{\"title\": \"Hubungi Kami\", \"subtitle\": \"Setelah menghubungi kami, jangan lupa untuk datang!\"}', 1),
(5, 'section4-map', '{\"map\": \"<iframe class=\'w-100\' src=\'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1129.5904466700697!2d107.796212227274!3d-6.558723483832988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693b0ef729f41f%3A0x42cd2271c5b36889!2sDS%20Motor!5e0!3m2!1sid!2sid!4v1701957963491!5m2!1sid!2sid\' style=\'border:0;\' height=\'300\' allowfullscreen=\'\' loading=\'lazy\' referrerpolicy=\'no-referrer-when-downgrade\'></iframe>\"}', 1),
(8, 'section2-item', '{\"icon\": \"\", \"image\": \"1703733123_b38d15e90729002bdcf0.jpg\", \"small\": \"Cepat dan Andal\", \"title\": \"Mulai dari Rp. 50.000\", \"subtitle\": \"Perbaikan Sepeda Motor\"}', 1),
(9, 'section2-item', '{\"icon\": \"\", \"image\": \"1703733037_2c6b05d138aa7abcba78.jpg\", \"small\": \"Pemeriksaan Rutin\", \"title\": \"Mulai dari Rp. 30.000\", \"subtitle\": \"Pemeliharaan Sepeda Motor\"}', 1),
(11, 'section2-item', '{\"icon\": \"\", \"image\": \"1703733061_689abcb267f4c6ecd717.jpg\", \"small\": \"\", \"title\": \"Mulai dari Rp. 20.000\", \"subtitle\": \"Pergantian Ban\"}', 1),
(12, 'section3-item', '{\"icon\": \"\", \"image\": \"1703733210_ce0eca59b99c629e0b4e.jpg\", \"small\": \"\", \"title\": \"Mekanik yang Berpengalaman\", \"subtitle\": \"Tim mekanin kami yang berpengalaman memastikan perbaikan kualitas tinggi.\"}', 1),
(19, 'section4-item', '{\"icon\": \"fas fa-envelope fa-xl\", \"title\": \"Email\", \"subtitle\": \"dsmotor@gmail.com\"}', 1),
(20, 'section4-item', '{\"icon\": \"fas fa-phone fa-xl\", \"title\": \"No Handphone\", \"subtitle\": \"+6285-3242-32492\"}', 1),
(21, 'section4-item', '{\"icon\": \"fas fa-phone fa-xl\", \"image\": \"\", \"small\": \"\", \"title\": \"Alamat\", \"subtitle\": \"Jalan Cinangsi, Kec. Cibogo, Kabupaten Subang, Jawa Barat 41285\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` int UNSIGNED NOT NULL,
  `kategori_barang` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id`, `kategori_barang`, `created_at`, `updated_at`) VALUES
(1, 'Sparepart Yamaha', '2023-12-25 09:45:25', '2023-12-25 09:45:25'),
(2, 'Sparepart Honda', '2023-12-25 09:45:34', '2023-12-25 09:45:34'),
(4, 'Sparepart Suzuki', '2023-12-25 09:45:46', '2023-12-25 09:45:46'),
(5, 'Sparepart Kawasaki', '2023-12-25 09:45:55', '2023-12-25 09:45:55'),
(6, 'Aksesoris Motor', '2023-12-25 09:46:00', '2023-12-25 09:46:00'),
(7, 'Sparepart Viar', '2023-12-27 20:21:47', '2023-12-27 20:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `layanan_servis`
--

CREATE TABLE `layanan_servis` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `harga` int NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `layanan_servis`
--

INSERT INTO `layanan_servis` (`id`, `nama`, `harga`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Pemasangan Kampas Rem', 10000, 'Pemasangan Kampas Rem Depan atau Belakang', '2023-12-25 16:46:36', '2023-12-25 16:46:36'),
(2, 'Overhaul CVT Matic', 50000, '', '2023-12-28 03:22:39', '2023-12-28 03:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1701998419, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1701998419, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1701998419, 1),
(28, '2023-12-24-085031', 'App\\Database\\Migrations\\AddNewColumnToUsers', 'default', 'App', 1703408666, 3),
(29, '2023-12-14-140825', 'App\\Database\\Migrations\\AddSupplierMigration', 'default', 'App', 1703517650, 4),
(30, '2023-12-14-144856', 'App\\Database\\Migrations\\AddKategoriBarangMigration', 'default', 'App', 1703517651, 4),
(31, '2023-12-14-145222', 'App\\Database\\Migrations\\AddBarangMigration', 'default', 'App', 1703517651, 4),
(32, '2023-12-14-153243', 'App\\Database\\Migrations\\AddLayananJasaMigration', 'default', 'App', 1703517651, 4),
(33, '2023-12-14-153923', 'App\\Database\\Migrations\\AddPembelianMigration', 'default', 'App', 1703517651, 4),
(34, '2023-12-14-153945', 'App\\Database\\Migrations\\AddDetailPembelianMigration', 'default', 'App', 1703517651, 4),
(35, '2023-12-14-160632', 'App\\Database\\Migrations\\AddTransaksiMigration', 'default', 'App', 1703517651, 4),
(36, '2023-12-14-160642', 'App\\Database\\Migrations\\AddDetailTransaksiMigration', 'default', 'App', 1703517676, 5),
(37, '2023-12-14-160652', 'App\\Database\\Migrations\\AddCustomerMigration', 'default', 'App', 1703517676, 5),
(38, '2023-12-14-160748', 'App\\Database\\Migrations\\AddVoucherMigration', 'default', 'App', 1703517676, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int UNSIGNED NOT NULL,
  `kode_pembelian` varchar(120) NOT NULL,
  `id_supplier` int UNSIGNED NOT NULL,
  `jumlah_order` int NOT NULL,
  `total_harga` int NOT NULL,
  `status` enum('Menunggu Persetujuan','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu Persetujuan',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `kode_pembelian`, `id_supplier`, `jumlah_order`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(9, 'PO202401011', 1, 1, 70000, 'Disetujui', '2024-01-01 00:54:17', '2024-01-01 02:02:06'),
(10, 'PO202401012', 3, 1, 30000, 'Menunggu Persetujuan', '2024-01-01 02:05:28', '2024-01-01 02:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `class`, `key`, `value`, `type`, `context`, `created_at`, `updated_at`) VALUES
(1, '\\CodeIgniter\\Shield\\Controllers\\LoginController::class', 'Auth.validFields', 'username', 'string', NULL, '2023-12-14 09:32:01', '2023-12-14 09:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int UNSIGNED NOT NULL,
  `kode_supplier` varchar(120) NOT NULL,
  `nama_supplier` varchar(120) NOT NULL,
  `alamat` text,
  `no_telp` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `kode_supplier`, `nama_supplier`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'YGP93120483', 'Yamaha Genuine Part', 'Jakarta', '0852134413', '2023-12-25 10:40:13', '2023-12-25 10:40:13'),
(3, 'AHM038120434', 'Astra Honda Motor Motoparts', 'Jakarta', '08512314123', '2023-12-29 23:16:57', '2023-12-29 23:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int UNSIGNED NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `jenis_layanan` enum('Penjualan','Servis') NOT NULL,
  `total_dibayar` float DEFAULT NULL,
  `total_uang` float DEFAULT NULL,
  `status` enum('Belum Lunas','Lunas') NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `jenis_layanan`, `total_dibayar`, `total_uang`, `status`, `id_user`, `created_at`, `updated_at`) VALUES
(3, 'INV202401021', 'Penjualan', 40000, 50000, 'Lunas', 1, '2024-01-02 05:42:46', '2024-01-02 05:42:46'),
(4, 'INV202401022', 'Penjualan', 80000, 100000, 'Lunas', 1, '2024-01-02 05:44:16', '2024-01-02 05:44:16'),
(5, 'INV202401023', 'Penjualan', 60000, 60000, 'Lunas', 1, '2024-01-02 05:49:41', '2024-01-02 05:49:41'),
(7, 'INV202401025', 'Servis', 50000, 50000, 'Lunas', 1, '2024-01-02 06:19:01', '2024-01-02 06:19:01'),
(9, 'INV202401026', 'Penjualan', 80000, 100000, 'Lunas', 1, '2024-01-02 06:24:01', '2024-01-02 06:24:01'),
(11, 'INV202401028', 'Penjualan', 150000, 0, 'Lunas', 1, '2024-01-02 06:47:33', '2024-01-02 06:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`, `name`, `no_telp`, `alamat`) VALUES
(1, 'ryzntxx', NULL, NULL, 0, '2024-01-03 12:27:35', '2023-12-14 06:05:17', '2023-12-14 10:38:19', NULL, 'Ryzntx', NULL, NULL),
(6, 'raldy', NULL, NULL, 0, NULL, '2023-12-29 15:11:36', '2023-12-29 15:11:36', NULL, 'Raldy', '0811423212', 'Perum'),
(7, 'Rafly', NULL, NULL, 0, NULL, '2024-01-03 08:22:50', '2024-01-03 08:22:50', NULL, 'Mochamad Rafly ', '0821216372737', 'Cipaku');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `barang_id_kategori_barang_foreign` (`id_kategori_barang`),
  ADD KEY `barang_id_supplier_foreign` (`id_supplier`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_kode_transaksi_foreign` (`kode_transaksi`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pembelian_id_barang_foreign` (`id_barang`),
  ADD KEY `FK_detail_pembelian_pembelian` (`kode_pembelian`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksi_id_layanan_servis_foreign` (`id_layanan_servis`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `detail_transaksi_kode_transaksi_foreign` (`kode_transaksi`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_servis`
--
ALTER TABLE `layanan_servis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pembelian` (`kode_pembelian`),
  ADD KEY `pembelian_id_supplier_foreign` (`id_supplier`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_supplier` (`kode_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `transaksi_id_user_foreign` (`id_user`);

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
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `layanan_servis`
--
ALTER TABLE `layanan_servis`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_id_kategori_barang_foreign` FOREIGN KEY (`id_kategori_barang`) REFERENCES `kategori_barang` (`id`),
  ADD CONSTRAINT `barang_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_kode_transaksi_foreign` FOREIGN KEY (`kode_transaksi`) REFERENCES `transaksi` (`kode_transaksi`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `FK_detail_pembelian_pembelian` FOREIGN KEY (`kode_pembelian`) REFERENCES `pembelian` (`kode_pembelian`) ON DELETE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `detail_transaksi_id_layanan_servis_foreign` FOREIGN KEY (`id_layanan_servis`) REFERENCES `layanan_servis` (`id`),
  ADD CONSTRAINT `detail_transaksi_kode_transaksi_foreign` FOREIGN KEY (`kode_transaksi`) REFERENCES `transaksi` (`kode_transaksi`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
