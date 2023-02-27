-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Sep 2022 pada 07.11
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code_base_cms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_bahan_baku`
--

CREATE TABLE `stok_bahan_baku` (
  `id_seq` int(4) NOT NULL,
  `kode_stok_bahan_baku` varchar(10) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `kode_bahan_baku` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_produk`
--

CREATE TABLE `stok_produk` (
  `id_seq` int(11) NOT NULL,
  `kode_stok_produk` int(11) NOT NULL,
  `kode_produk` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabel untuk manajemen  perubahan stok setelah transaksi';

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_bahan_baku`
--

CREATE TABLE `t_mtr_bahan_baku` (
  `id_seq` int(11) NOT NULL,
  `kode_bahan_baku` varchar(15) NOT NULL,
  `nama_bahan_baku` varchar(50) NOT NULL,
  `satuan` varchar(11) NOT NULL COMMENT 'ton/kilogram dsb'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_bahan_baku`
--

INSERT INTO `t_mtr_bahan_baku` (`id_seq`, `kode_bahan_baku`, `nama_bahan_baku`, `satuan`) VALUES
(1, 'BB01', 'BB Biru Muda', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_feedback`
--

CREATE TABLE `t_mtr_feedback` (
  `id_seq` bigint(11) NOT NULL,
  `feedback_code` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `feedback_description` text DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_feedback`
--

INSERT INTO `t_mtr_feedback` (`id_seq`, `feedback_code`, `username`, `feedback_description`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(7, NULL, 'alimin.nutech@gmail.com', '<p>fgsdgsdfgsdf sdfsdfhsdhs ghgfhgd</p>', 1, 'system', '2021-11-12', NULL, NULL),
(8, NULL, 'alimin.nutech@gmail.com', '', 1, 'system', '2021-11-12', NULL, NULL),
(9, NULL, 'alimin.nutech@gmail.com', '', 1, 'system', '2021-11-12', NULL, NULL),
(10, NULL, 'alimin.nutech@gmail.com', '', 1, 'system', '2021-11-12', NULL, NULL),
(11, NULL, 'alimin.nutech@gmail.com', '', 1, 'system', '2021-11-12', NULL, NULL),
(12, NULL, 'alimin.nutech@gmail.com', '', 1, 'system', '2021-11-12', NULL, NULL),
(13, NULL, 'alimin.nutech@gmail.com', '', 1, 'system', '2021-11-12', NULL, NULL),
(14, NULL, 'alimin.nutech@gmail.com', '', 1, 'system', '2021-11-12', NULL, NULL),
(15, NULL, 'alimin.nutech@gmail.com', '<p>kjsf dasfajsk fasdbfjasd</p>', 1, 'system', '2021-11-12', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_guest`
--

CREATE TABLE `t_mtr_guest` (
  `id_seq` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_guest`
--

INSERT INTO `t_mtr_guest` (`id_seq`, `ip_address`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(1, '127.0.0.1', 'system', '2021-11-11', '0000-00-00', 1),
(2, '192.168.23.166', 'system', '2021-11-11', '0000-00-00', 1),
(3, '127.0.0.1', 'system', '2021-11-12', '0000-00-00', 1),
(4, '::1', 'system', '2021-11-12', '0000-00-00', 1),
(5, '::1', 'system', '2021-11-13', '0000-00-00', 1),
(6, '::1', 'system', '2021-11-15', '0000-00-00', 1),
(7, '::1', 'system', '2021-11-16', '0000-00-00', 1),
(8, '127.0.0.1', 'system', '2021-12-08', '0000-00-00', 1),
(9, '127.0.0.1', 'system', '2021-12-09', '0000-00-00', 1),
(10, '127.0.0.1', 'system', '2021-12-13', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_karyawan`
--

CREATE TABLE `t_mtr_karyawan` (
  `id_seq` int(11) NOT NULL,
  `kode_karyawan` varchar(15) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `n` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_menu`
--

CREATE TABLE `t_mtr_menu` (
  `id_seq` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `menu_order` smallint(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_menu`
--

INSERT INTO `t_mtr_menu` (`id_seq`, `parent_id`, `name`, `icon`, `slug`, `menu_order`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 0, 'Dashboard', 'fa fa-home', 'dashboard', 1, 1, NULL, '2019-12-12', 'superadmin', '2019-12-31'),
(2, 0, 'Configuration', 'fa fa-cog', '', 2, 1, NULL, '2019-12-13', 'superadmin', '2019-12-31'),
(3, 2, 'Menu', NULL, 'configuration/menu', 1, -5, NULL, '2019-12-13', 'superadmin', '2019-12-31'),
(4, 2, 'Users', '', 'configuration/user', 2, 1, 'superadmin', '2019-12-16', 'superadmin', '2019-12-31'),
(5, 2, 'User Group', '', 'configuration/user_group', 3, 1, 'superadmin', '2019-12-16', 'superadmin', '2019-12-31'),
(6, 2, 'User Privileges', '', 'configuration/privileges', 4, 1, 'superadmin', '2019-12-16', 'superadmin', '2019-12-31'),
(7, 2, 'Menu', '', 'configuration/menu', 5, 1, 'superadmin', '2019-12-16', NULL, NULL),
(8, 2, 'Menu Action', '', 'configuration/menu_action', 6, 1, 'superadmin', '2019-12-16', NULL, NULL),
(9, 0, 'Base Page', 'fa fa-file', 'base_page', 3, 1, 'superadmin', '2019-12-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_menu_action`
--

CREATE TABLE `t_mtr_menu_action` (
  `id_seq` bigint(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_menu_action`
--

INSERT INTO `t_mtr_menu_action` (`id_seq`, `name`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'view', 1, '1', '2018-12-10', NULL, NULL),
(2, 'add', 1, '1', '2018-12-10', NULL, NULL),
(3, 'edit', 1, '1', '2018-12-10', NULL, NULL),
(4, 'delete', 1, '1', '2018-12-10', NULL, NULL),
(5, 'change_password', 1, '1', '2018-12-10', NULL, NULL),
(6, 'import', 1, '1', '2018-12-10', NULL, NULL),
(7, 'detail', 1, '1', '2018-12-10', NULL, NULL),
(8, 'force_exit', 1, '1', '2018-12-10', '1', '2018-12-19'),
(9, 'blacklist', 1, '1', '2018-12-10', NULL, NULL),
(10, 'recommit', 1, '1', '2018-12-10', NULL, NULL),
(11, 'triaalll', -5, '1', '2018-12-26', '1', '2018-12-26'),
(12, 'status', 1, 'superadmin', '2019-09-23', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_menu_detail`
--

CREATE TABLE `t_mtr_menu_detail` (
  `id_seq` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `action_id` smallint(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_menu_detail`
--

INSERT INTO `t_mtr_menu_detail` (`id_seq`, `menu_id`, `action_id`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 1, 1, NULL, '2019-12-13', NULL, NULL),
(2, 1, 1, 1, NULL, '2019-12-13', NULL, NULL),
(3, 3, 1, 1, NULL, '2019-12-13', NULL, NULL),
(4, 3, 2, 1, NULL, '2019-12-13', NULL, NULL),
(5, 3, 3, 1, NULL, '2019-12-13', NULL, NULL),
(6, 3, 4, 1, NULL, '2019-12-13', NULL, NULL),
(7, 4, 1, 1, 'superadmin', '2019-12-16', NULL, NULL),
(8, 4, 2, 1, 'superadmin', '2019-12-16', NULL, NULL),
(9, 4, 3, 1, 'superadmin', '2019-12-16', NULL, NULL),
(10, 4, 4, 1, 'superadmin', '2019-12-16', NULL, NULL),
(11, 4, 5, 1, 'superadmin', '2019-12-16', NULL, NULL),
(12, 5, 1, 1, 'superadmin', '2019-12-16', NULL, NULL),
(13, 5, 2, 1, 'superadmin', '2019-12-16', NULL, NULL),
(14, 5, 3, 1, 'superadmin', '2019-12-16', NULL, NULL),
(15, 5, 4, 1, 'superadmin', '2019-12-16', NULL, NULL),
(16, 6, 1, 1, 'superadmin', '2019-12-16', NULL, NULL),
(17, 6, 2, 1, 'superadmin', '2019-12-16', NULL, NULL),
(18, 6, 3, 1, 'superadmin', '2019-12-16', NULL, NULL),
(19, 6, 4, 1, 'superadmin', '2019-12-16', NULL, NULL),
(20, 7, 1, 1, 'superadmin', '2019-12-16', NULL, NULL),
(21, 7, 2, 1, 'superadmin', '2019-12-16', NULL, NULL),
(22, 7, 3, 1, 'superadmin', '2019-12-16', NULL, NULL),
(23, 7, 4, 1, 'superadmin', '2019-12-16', NULL, NULL),
(24, 8, 1, 1, 'superadmin', '2019-12-16', NULL, NULL),
(25, 8, 2, 1, 'superadmin', '2019-12-16', NULL, NULL),
(26, 8, 3, 1, 'superadmin', '2019-12-16', NULL, NULL),
(27, 8, 4, 1, 'superadmin', '2019-12-16', NULL, NULL),
(28, 9, 1, 1, 'superadmin', '2019-12-18', NULL, NULL),
(29, 9, 2, 1, 'superadmin', '2019-12-18', NULL, NULL),
(30, 9, 3, 1, 'superadmin', '2019-12-18', NULL, NULL),
(31, 9, 4, 1, 'superadmin', '2019-12-18', NULL, NULL),
(32, 2, 1, 1, 'superadmin', '2019-12-30', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_privilege`
--

CREATE TABLE `t_mtr_privilege` (
  `id_seq` bigint(20) UNSIGNED NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `menu_detail_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_privilege`
--

INSERT INTO `t_mtr_privilege` (`id_seq`, `user_group_id`, `menu_id`, `menu_detail_id`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 1, 1, 1, NULL, '2019-12-13', NULL, NULL),
(2, 1, 2, 2, 1, NULL, '2019-12-13', NULL, NULL),
(3, 1, 3, 5, 1, NULL, '2019-12-13', NULL, NULL),
(4, 1, 6, 1, 1, NULL, '2019-12-16', NULL, NULL),
(5, 1, 4, 7, 1, 'superadmin', '2019-12-17', NULL, NULL),
(6, 1, 4, 8, 1, 'superadmin', '2019-12-17', NULL, NULL),
(7, 1, 4, 9, 1, 'superadmin', '2019-12-17', NULL, NULL),
(8, 1, 4, 10, 1, 'superadmin', '2019-12-17', NULL, NULL),
(9, 1, 4, 11, 1, 'superadmin', '2019-12-17', NULL, NULL),
(10, 1, 5, 12, 1, 'superadmin', '2019-12-17', NULL, NULL),
(11, 1, 5, 13, 1, 'superadmin', '2019-12-17', NULL, NULL),
(12, 1, 5, 14, 1, 'superadmin', '2019-12-17', NULL, NULL),
(13, 1, 5, 15, 1, 'superadmin', '2019-12-17', NULL, NULL),
(14, 1, 6, 16, 1, 'superadmin', '2019-12-17', NULL, NULL),
(15, 1, 6, 17, 1, 'superadmin', '2019-12-17', NULL, NULL),
(16, 1, 6, 18, 1, 'superadmin', '2019-12-17', NULL, NULL),
(17, 1, 6, 19, 1, 'superadmin', '2019-12-17', NULL, NULL),
(18, 1, 7, 20, 1, 'superadmin', '2019-12-17', NULL, NULL),
(19, 1, 7, 21, 1, 'superadmin', '2019-12-17', NULL, NULL),
(20, 1, 7, 22, 1, 'superadmin', '2019-12-17', NULL, NULL),
(21, 1, 7, 23, 1, 'superadmin', '2019-12-17', NULL, NULL),
(22, 1, 8, 24, 1, 'superadmin', '2019-12-17', NULL, NULL),
(23, 1, 8, 25, 1, 'superadmin', '2019-12-17', NULL, NULL),
(24, 1, 8, 26, 1, 'superadmin', '2019-12-17', NULL, NULL),
(25, 1, 8, 27, 1, 'superadmin', '2019-12-17', NULL, NULL),
(26, 1, 9, 28, -5, 'superadmin', '2019-12-19', 'superadmin', '2019-12-31'),
(27, 1, 9, 29, -5, 'superadmin', '2019-12-19', 'superadmin', '2019-12-31'),
(28, 1, 9, 30, -5, 'superadmin', '2019-12-19', 'superadmin', '2019-12-31'),
(29, 1, 9, 31, -5, 'superadmin', '2019-12-19', 'superadmin', '2019-12-31'),
(30, 1, 3, 3, -5, NULL, '2019-12-13', 'superadmin', '2019-12-31'),
(31, 1, 6, 3, -5, NULL, '2019-12-16', 'superadmin', '2019-12-31'),
(32, 1, 3, 4, -5, NULL, '2019-12-13', 'superadmin', '2019-12-31'),
(33, 1, 3, 6, -5, NULL, '2019-12-13', 'superadmin', '2019-12-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_produk`
--

CREATE TABLE `t_mtr_produk` (
  `id_seq` int(11) NOT NULL,
  `kode_produk` varchar(15) NOT NULL,
  `nama_produk` varchar(15) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_suplier`
--

CREATE TABLE `t_mtr_suplier` (
  `id_seq` int(11) NOT NULL,
  `nama_suplier` varchar(50) NOT NULL,
  `nomor_telepone` varchar(15) NOT NULL,
  `Alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_user`
--

CREATE TABLE `t_mtr_user` (
  `id_seq` int(11) NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_on` date DEFAULT NULL,
  `user_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_user`
--

INSERT INTO `t_mtr_user` (`id_seq`, `user_group_id`, `username`, `password`, `email`, `first_name`, `last_name`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`, `user_code`) VALUES
(1, 1, 'superadmin', '$2a$12$MtczIF7sAoy0ssuNhryoOe6BCS7wGsjPcSNXtdtHl3NjeHDTzPOQu', 'alimin.nutech@gmail.com', 'Ali', 'min', 1, NULL, '2019-12-12', NULL, NULL, NULL),
(2, 1, 'alimin', '$2a$12$pRcIOnuHM91.qwBuXB7uOezzq5N3WGjCwrw9ee9kHFcpUOLhf2e5u', 'alimin1313@gmail.com', 'ali', 'min', 1, 'superadmin', '2019-12-18', NULL, NULL, '3LVXZD7VLT'),
(3, 1, 'ojan', '$2a$12$qHs43kYBV/96hKchtUw7bOA4rOxZrtTw5MeTnyjjn4QPZkCkvbbaa', 'alimin1313@gmail.com', 'o', 'jan', 1, 'superadmin', '2019-12-18', NULL, NULL, 'GUXP19Q0QS'),
(4, 2, 'ojan333', '$2a$12$JSZNKNrQQiXR48KHis73/uDdSQRRp1oXDvYglXfi65kfbOLg7/Xu.', '123@gmail.com', 'o', 'jan', 1, 'superadmin', '2019-12-31', NULL, NULL, 'YKRZAZW6ZH'),
(5, 3, 'fadil', '$2a$12$6BZm27WFvNiTtMGtBzzuMu70We45g36SHENoDQ2eDvmi.cIBAZI/m', 'alimin1313@gmail.com', '11', '111', 1, 'superadmin', '2019-12-31', NULL, NULL, 'SN4B7EA6IU'),
(6, 3, 'alimin99', '756ea110eea2a923b1027878ae9b6ed36d8076632c7f4e264c26487492730b2dff1059b8b408d8f89faba5f65371505d8c502119326951232e2fc67bc9a11d9aYGxdG0PztPn8KZZEcRFPq5bw/o9Mvw==', 'alimin1313@gmail.com', 'afas', 'safas', 1, 'superadmin', '2019-12-31', 'superadmin', '2019-12-31', 'KBKZLFQ9GR'),
(7, NULL, 'john', '6fab0c7f620ff59757706239e3115e76eaaf58b199b57c88d39f0df4451ef765b1847a514cd2d11ee23f73eff17be8d383fa888fcf083ca8e6730c72ce174d2dnyxP3aAWBqC2tMhMrL+FfQPMHKM=', 'john@gmail.com', 'John', 'Garcia', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_user_frontend`
--

CREATE TABLE `t_mtr_user_frontend` (
  `id_seq` int(11) NOT NULL,
  `user_frontend_code` varchar(20) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_user_frontend`
--

INSERT INTO `t_mtr_user_frontend` (`id_seq`, `user_frontend_code`, `username`, `password`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'UF-000000001', 'alimin1313@gmail.com', '$2a$12$Dw3fnoUL/v3k2lusUEpVuO0z7eDVxYjQdqdhU1uJ35lOjk/gIhHPq', 1, 'system', '2021-11-12', NULL, NULL),
(2, 'UF-000000002', 'alimin.nutech@gmail.com', '$2a$12$YQSgmdNYT81wOWQndnWxxOXrusURZfYotApu0U.gEvEAdCGYR.hLy', 1, 'system', '2021-11-12', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_mtr_user_group`
--

CREATE TABLE `t_mtr_user_group` (
  `id_seq` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_on` date DEFAULT NULL,
  `group_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_mtr_user_group`
--

INSERT INTO `t_mtr_user_group` (`id_seq`, `group_name`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`, `group_code`) VALUES
(1, 'superadmin', 1, '', '2019-12-12', NULL, NULL, NULL),
(2, 'group 1', 1, '1', '2019-12-30', NULL, NULL, 'GP1001'),
(3, 'group 5511', 1, '1', '2019-12-30', '1', '2019-12-31', '23'),
(4, 'sgsdf', -5, '1', '2019-12-30', '1', '2019-12-31', 'SFGS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_trx_detail_penjualan`
--

CREATE TABLE `t_trx_detail_penjualan` (
  `id_seq` int(2) NOT NULL,
  `kode_penjualan` varchar(15) NOT NULL,
  `kode_produk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabel untuk menampilkan rincian item dalam transaksi';

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_trx_pembelian`
--

CREATE TABLE `t_trx_pembelian` (
  `id_seq` int(10) NOT NULL,
  `kode_pembelian` varchar(15) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `kode_suplier` varchar(15) NOT NULL,
  `kode_bahan_baku` varchar(15) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga_pembelian` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_trx_penjualan`
--

CREATE TABLE `t_trx_penjualan` (
  `id_seq` int(11) NOT NULL,
  `kode_penjualan` varchar(15) NOT NULL,
  `tgl_penjualan` int(11) NOT NULL,
  `no_invoice` int(11) NOT NULL,
  `grand_total` bigint(20) NOT NULL COMMENT 'dihitung dari semua item transaksi yg terjadi pada tabel t_trx_penjualan',
  `nama_customer` varchar(100) NOT NULL,
  `kode_karyawan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `stok_bahan_baku`
--
ALTER TABLE `stok_bahan_baku`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `stok_produk`
--
ALTER TABLE `stok_produk`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_bahan_baku`
--
ALTER TABLE `t_mtr_bahan_baku`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_feedback`
--
ALTER TABLE `t_mtr_feedback`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_guest`
--
ALTER TABLE `t_mtr_guest`
  ADD UNIQUE KEY `id_seq` (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_karyawan`
--
ALTER TABLE `t_mtr_karyawan`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_menu`
--
ALTER TABLE `t_mtr_menu`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_menu_action`
--
ALTER TABLE `t_mtr_menu_action`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_menu_detail`
--
ALTER TABLE `t_mtr_menu_detail`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_privilege`
--
ALTER TABLE `t_mtr_privilege`
  ADD PRIMARY KEY (`id_seq`),
  ADD UNIQUE KEY `id_seq` (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_produk`
--
ALTER TABLE `t_mtr_produk`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_suplier`
--
ALTER TABLE `t_mtr_suplier`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_user`
--
ALTER TABLE `t_mtr_user`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_user_frontend`
--
ALTER TABLE `t_mtr_user_frontend`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_mtr_user_group`
--
ALTER TABLE `t_mtr_user_group`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_trx_detail_penjualan`
--
ALTER TABLE `t_trx_detail_penjualan`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_trx_pembelian`
--
ALTER TABLE `t_trx_pembelian`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `t_trx_penjualan`
--
ALTER TABLE `t_trx_penjualan`
  ADD PRIMARY KEY (`id_seq`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `stok_bahan_baku`
--
ALTER TABLE `stok_bahan_baku`
  MODIFY `id_seq` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stok_produk`
--
ALTER TABLE `stok_produk`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_bahan_baku`
--
ALTER TABLE `t_mtr_bahan_baku`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_feedback`
--
ALTER TABLE `t_mtr_feedback`
  MODIFY `id_seq` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_guest`
--
ALTER TABLE `t_mtr_guest`
  MODIFY `id_seq` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_karyawan`
--
ALTER TABLE `t_mtr_karyawan`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_menu`
--
ALTER TABLE `t_mtr_menu`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_menu_action`
--
ALTER TABLE `t_mtr_menu_action`
  MODIFY `id_seq` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_menu_detail`
--
ALTER TABLE `t_mtr_menu_detail`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_privilege`
--
ALTER TABLE `t_mtr_privilege`
  MODIFY `id_seq` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_produk`
--
ALTER TABLE `t_mtr_produk`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_suplier`
--
ALTER TABLE `t_mtr_suplier`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_user`
--
ALTER TABLE `t_mtr_user`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_user_frontend`
--
ALTER TABLE `t_mtr_user_frontend`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_mtr_user_group`
--
ALTER TABLE `t_mtr_user_group`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_trx_detail_penjualan`
--
ALTER TABLE `t_trx_detail_penjualan`
  MODIFY `id_seq` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_trx_pembelian`
--
ALTER TABLE `t_trx_pembelian`
  MODIFY `id_seq` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_trx_penjualan`
--
ALTER TABLE `t_trx_penjualan`
  MODIFY `id_seq` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
