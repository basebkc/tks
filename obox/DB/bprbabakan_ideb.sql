-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 03 Apr 2020 pada 02.55
-- Versi server: 10.4.12-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bprbabakan_ideb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(8) NOT NULL,
  `no_antrian` text NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_ktp` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `file` text NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_kan` int(8) NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_ljk`
--

CREATE TABLE `jenis_ljk` (
  `id` int(8) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama_ljk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_ljk`
--

INSERT INTO `jenis_ljk` (`id`, `kode`, `nama_ljk`) VALUES
(2, '0105', 'Perusahaan Pembiayaan'),
(3, '0104', 'BPR Syariah'),
(4, '0103', 'BPR Konvensional'),
(5, '0102', 'Bank Umum Syariah/Unit Usaha Syariah'),
(6, '0101', 'Bank Umum Konvensional');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peran_pengguna`
--

CREATE TABLE `peran_pengguna` (
  `id` int(8) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peran_pengguna`
--

INSERT INTO `peran_pengguna` (`id`, `nama`) VALUES
(1, 'Petugas Permintaan Informasi'),
(2, 'Petugas Pelaporan'),
(3, 'Administrator'),
(4, 'Supervisor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kantor`
--

CREATE TABLE `tbl_kantor` (
  `id_kan` int(4) NOT NULL,
  `kd_kan` varchar(4) CHARACTER SET latin1 NOT NULL,
  `id_ljk` varchar(8) NOT NULL,
  `n_kan` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_kantor`
--

INSERT INTO `tbl_kantor` (`id_kan`, `kd_kan`, `id_ljk`, `n_kan`) VALUES
(1, '001', '4', 'KPO PD. BPR Babakan'),
(2, '002', '4', 'Cabang Sumber'),
(3, '009', '4', 'Cabang Susukan'),
(4, '007', '4', 'Cabang Plumbon'),
(5, '011', '4', 'Cabang Cirebon Barat'),
(6, '012', '4', 'Cabang Cirebon Utara'),
(7, '005', '4', 'Cabang Karangsembung'),
(8, '008', '4', 'Cabang Lemahabang'),
(9, '009', '4', 'Cabang Arjawinangun'),
(10, '006', '4', 'Cabang Palimanan'),
(11, '010', '4', 'Cabang Weru'),
(12, '004', '4', 'Cabang Waled');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `id_peran_pengguna` int(8) NOT NULL,
  `nip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_peran_pengguna`, `nip`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$KCnJFddjrCrUY4kjERLUDeJUpZbsohbFWm6Wf5qeBvwNKkQ3K5NHW', '', 'admin@admin.com', '', 'iYU9fyFmD7QWbQEM6F4xz.615e833a92fcee6f99', 1585824572, NULL, 1268889823, 1585830286, 1, 'Super', 'Administrator', '1', '0', 3, '0'),
(15, '114.124.211.98', 'info@bprbabakan.co.id', '$2y$08$lbTkziF7RpTeVBIJ1aRPY.nXAcq90GIdI0Uf8bJOoYtJ1YFYVU4iO', NULL, 'info@bprbabakan.co.id', NULL, NULL, NULL, NULL, 1585818777, 1585826621, 1, 'Moch.', 'Yanuar', '1', '0', 3, '0'),
(16, '114.124.211.98', 'admin@bprbabakan.co.id', '$2y$08$rdZrumXqF4zoPuagxfWMBexYeA3hVCm4u.dAWQYqXUG78xSgwEox6', NULL, 'admin@bprbabakan.co.id', NULL, 'TohTnGXIkfAVA-qqz42dM.8d77c8dc433287288a', 1585822733, NULL, 1585818825, 1585877403, 1, 'Saefudin', 'Zuhri', '1', '0', 3, '0'),
(18, '36.71.238.109', 'kpo@bprbabakan.co.id', '$2y$08$29Na72YG7.9a/6Tq4dwCOOep5S6rUcP8tQJtoDZbQKU9haUcFC.Ne', NULL, 'kpo@bprbabakan.co.id', '99d9458cdff6864f8ee7625a2577294a66ae6db9', NULL, NULL, NULL, 1585875779, NULL, 0, 'Angri', 'Sonjaya', '1', '0', 1, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(31, 1, 1),
(29, 15, 1),
(30, 16, 1),
(32, 18, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_ljk`
--
ALTER TABLE `jenis_ljk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peran_pengguna`
--
ALTER TABLE `peran_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_kantor`
--
ALTER TABLE `tbl_kantor`
  ADD PRIMARY KEY (`id_kan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_ljk`
--
ALTER TABLE `jenis_ljk`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `peran_pengguna`
--
ALTER TABLE `peran_pengguna`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kantor`
--
ALTER TABLE `tbl_kantor`
  MODIFY `id_kan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
