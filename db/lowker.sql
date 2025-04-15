-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Apr 2025 pada 04.35
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowker`
--

CREATE TABLE `lowker` (
  `id_lowker` int(11) NOT NULL,
  `deskripsi_lowker` text DEFAULT NULL,
  `tgl_ditutup` date DEFAULT NULL,
  `persyaratan` text DEFAULT NULL,
  `tgl_posting` date DEFAULT curdate(),
  `id_perusahaan` int(11) DEFAULT NULL,
  `skill` varchar(250) DEFAULT NULL,
  `jumlah_pelamar` int(11) DEFAULT 0,
  `tunjangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lowker`
--

INSERT INTO `lowker` (`id_lowker`, `deskripsi_lowker`, `tgl_ditutup`, `persyaratan`, `tgl_posting`, `id_perusahaan`, `skill`, `jumlah_pelamar`, `tunjangan`) VALUES
(20, '............', '2025-04-15', '................', '2025-04-14', 2, 'PHP, Network, Linux', 0, '.........');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lowker`
--
ALTER TABLE `lowker`
  ADD PRIMARY KEY (`id_lowker`),
  ADD KEY `id_perusahaan` (`id_perusahaan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lowker`
--
ALTER TABLE `lowker`
  MODIFY `id_lowker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `lowker`
--
ALTER TABLE `lowker`
  ADD CONSTRAINT `lowker_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
