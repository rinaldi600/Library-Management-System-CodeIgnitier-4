-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2021 pada 09.39
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `idAdmin` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `idAdmin`, `nama`, `email`, `username`, `password`, `picture`, `created_at`, `updated_at`) VALUES
(5, 'ADMIN-m9yp6bcan', 'Rinaldi Hendrawan', 'rinaldih84@gmail.com', 'rinaldi600', '$2y$10$ll3VlzrXzC8VMn6NXd3JOO.tWTWLt2ymI5T.qK1zJopo1TZ51Ufhm', '1631540122_b0c7b04802da3b5e0870.jpg', '2021-09-13 01:35:23', '2021-09-13 01:35:23'),
(6, 'ADMIN-xqmcuahzx', 'Joaquin Phoenix', 'rinaldihendrawan2@gmail.com', 'Joaquin666', '$2y$10$WEtAlzm/7hekv3lPWoFcQ.3K604SsKOGX7GBeO2G2B6PwTcnIlv6O', '1634565302_42f2b991907611786ccb.jpg', '2021-10-18 01:55:02', '2021-10-18 01:55:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `authadmin`
--

CREATE TABLE `authadmin` (
  `id` int(11) NOT NULL,
  `idAuth` varchar(100) NOT NULL,
  `idAdmin` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `authidlib`
--

CREATE TABLE `authidlib` (
  `id` int(11) NOT NULL,
  `idAdmin` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `authidlib`
--

INSERT INTO `authidlib` (`id`, `idAdmin`, `created_at`, `updated_at`) VALUES
(19, 'ADMIN-m9yp6bcan', '2021-09-07 18:21:02', '2021-09-07 18:21:02'),
(20, 'ADMIN-8tnh1g5ii', '2021-09-09 02:31:38', '2021-09-09 02:31:38'),
(21, 'ADMIN-xqmcuahzx', '2021-10-18 01:47:43', '2021-10-18 01:47:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `authuser`
--

CREATE TABLE `authuser` (
  `id` int(11) NOT NULL,
  `idAuth` varchar(100) NOT NULL,
  `idUser` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `idBook` varchar(100) NOT NULL,
  `ISBN` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publish` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `book`
--

INSERT INTO `book` (`id`, `idBook`, `ISBN`, `title`, `author`, `publish`, `picture`, `stok`, `created_at`, `updated_at`) VALUES
(6, 'BOOK-dcd5', '9785119802363', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka ', '1632319807_1812caf06f86e598d6e5.jpg', 20, '2021-09-22 02:10:07', '2021-10-19 19:19:58'),
(7, 'BOOK-7196', '6374104684', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1632320159_021ae43155d789d80ad2.jpg', 30, '2021-09-22 02:15:59', '2021-10-20 19:11:04'),
(17, 'BOOK-67d3', '9796481788964', 'Jejak Langkah', 'Pramoedya Ananta Toer', 'Bentang Pustaka ', '1632989971_9327409b2ed5fe9c3f02.jpg', 21, '2021-09-29 20:19:31', '2021-10-19 19:20:07'),
(18, 'BOOK-ff4f', '3472856394', 'Sang Pemimpi', 'Andrea Hirata', 'Bentang Pustaka ', '1632990372_08ef1a9d74b03044438d.jpg', 3, '2021-09-29 20:26:12', '2021-10-19 19:15:41'),
(22, 'BOOK-8701', '989925813X', 'Naruto Vol. 72', 'Masashi Kishimoto', 'Shonen Jump', '1634801582_1978872b54d04d55e5aa.jpg', 30, '2021-10-20 19:30:52', '2021-10-20 19:35:15'),
(23, 'BOOK-1738', '9798991732406', 'Harry Potter and The Deathly Hallows', 'JK Rowling', 'Gramedia', '1634801862_a8cf356b301982df5e4f.jpg', 1, '2021-10-20 19:37:42', '2021-10-20 19:39:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rent`
--

CREATE TABLE `rent` (
  `id` int(11) NOT NULL,
  `idRent` varchar(100) NOT NULL,
  `idUser` varchar(100) NOT NULL,
  `idBook` varchar(100) NOT NULL,
  `usernameAdmin` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rent`
--

INSERT INTO `rent` (`id`, `idRent`, `idUser`, `idBook`, `usernameAdmin`, `status`, `created_at`, `updated_at`) VALUES
(109, 'RENT-db38', 'USER-76e43b', 'BOOK-67d3', 'rinaldi600', 'complete', '2021-10-19 01:48:03', '2021-10-19 19:16:41'),
(112, 'RENT-d964', 'USER-9b60ce', 'BOOK-dcd5', 'rinaldi600', 'complete', '2021-10-19 01:52:47', '2021-10-19 19:15:34'),
(113, 'RENT-d8c4', 'USER-9b60ce', 'BOOK-7196', 'rinaldi600', 'complete', '2021-10-19 01:52:51', '2021-10-19 19:15:37'),
(114, 'RENT-645d', 'USER-9b60ce', 'BOOK-67d3', 'rinaldi600', 'complete', '2021-10-19 01:52:55', '2021-10-19 19:15:39'),
(115, 'RENT-ebe9', 'USER-9b60ce', 'BOOK-ff4f', 'rinaldi600', 'complete', '2021-10-19 01:52:58', '2021-10-19 19:15:41'),
(119, 'RENT-ef37', 'USER-76e43b', 'BOOK-67d3', 'rinaldi600', 'complete', '2021-10-19 02:22:50', '2021-10-19 19:16:41'),
(120, 'RENT-7d6a', 'USER-76e43b', 'BOOK-dcd5', 'rinaldi600', 'pending', '2021-10-19 19:16:56', '2021-10-20 19:10:53'),
(121, 'RENT-b48d', 'USER-76e43b', 'BOOK-7196', 'rinaldi600', 'complete', '2021-10-19 19:17:03', '2021-10-20 19:11:04'),
(122, 'RENT-a959', 'USER-76e43b', 'BOOK-67d3', NULL, 'pending', '2021-10-19 19:17:06', '2021-10-19 19:17:06'),
(123, 'RENT-3659', 'USER-76e43b', 'BOOK-ff4f', NULL, 'pending', '2021-10-19 19:17:09', '2021-10-19 19:17:09'),
(124, 'RENT-5226', 'USER-9b60ce', 'BOOK-dcd5', NULL, 'pending', '2021-10-19 19:17:34', '2021-10-19 19:17:34'),
(125, 'RENT-ec66', 'USER-9b60ce', 'BOOK-7196', NULL, 'pending', '2021-10-19 19:17:42', '2021-10-19 19:17:42'),
(126, 'RENT-9efe', 'USER-9b60ce', 'BOOK-67d3', 'rinaldi600', 'pending', '2021-10-19 19:17:45', '2021-10-19 19:20:07'),
(127, 'RENT-a65a', 'USER-9b60ce', 'BOOK-ff4f', NULL, 'pending', '2021-10-19 19:17:47', '2021-10-19 19:17:47'),
(128, 'RENT-b9e3', 'USER-76e43b', 'BOOK-8701', 'rinaldi600', 'complete', '2021-10-20 19:33:38', '2021-10-20 19:35:15'),
(129, 'RENT-4b1e', 'USER-76e43b', 'BOOK-1738', 'rinaldi600', 'complete', '2021-10-20 19:38:03', '2021-10-20 19:39:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `idUser` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `idUser`, `nama`, `email`, `username`, `password`, `picture`, `created_at`, `updated_at`) VALUES
(5, 'USER-76e43b', 'Rinaldi Hendrawan', 'rinaldihendrawan2@gmail.com', 'Rinaldi007', '$2y$10$taAiy4y.mdQ1Rs4774ZBD.IIpnkrmoUkmX.moVgCt7VpRumnS.Jhy', '1631540269_08276eec211e54af6554.jpg', '2021-09-13 01:37:49', '2021-09-13 01:37:49'),
(6, 'USER-9b60ce', 'Joko Susanto', 'artdraw69@gmail.com', 'joko69', '$2y$10$e9808S8MamwUs9yoOKcowOqnjLvXzhOwYE11OmhrZOlMz582Fwfe2', '1633959529_c079b9f788ffa3ab050c.jpg', '2021-10-11 01:38:49', '2021-10-11 01:38:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idAdmin` (`idAdmin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `authadmin`
--
ALTER TABLE `authadmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idAuth` (`idAuth`),
  ADD UNIQUE KEY `idAdmin` (`idAdmin`);

--
-- Indeks untuk tabel `authidlib`
--
ALTER TABLE `authidlib`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idAdmin` (`idAdmin`);

--
-- Indeks untuk tabel `authuser`
--
ALTER TABLE `authuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idAuth` (`idAuth`),
  ADD UNIQUE KEY `idUser` (`idUser`);

--
-- Indeks untuk tabel `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idBook` (`idBook`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indeks untuk tabel `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idRent` (`idRent`),
  ADD KEY `fk_idBook` (`idBook`),
  ADD KEY `fk_idUser` (`idUser`),
  ADD KEY `fk_usernameAdmin` (`usernameAdmin`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `authadmin`
--
ALTER TABLE `authadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `authidlib`
--
ALTER TABLE `authidlib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `authuser`
--
ALTER TABLE `authuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `rent`
--
ALTER TABLE `rent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_idAdmin` FOREIGN KEY (`idAdmin`) REFERENCES `authidlib` (`idAdmin`);

--
-- Ketidakleluasaan untuk tabel `authadmin`
--
ALTER TABLE `authadmin`
  ADD CONSTRAINT `fk_idAuthAdmin` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`idAdmin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `authuser`
--
ALTER TABLE `authuser`
  ADD CONSTRAINT `fk_idAuthUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rent`
--
ALTER TABLE `rent`
  ADD CONSTRAINT `fk_idBook` FOREIGN KEY (`idBook`) REFERENCES `book` (`idBook`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usernameAdmin` FOREIGN KEY (`usernameAdmin`) REFERENCES `admin` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
