-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Des 2022 pada 08.33
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(35) NOT NULL,
  `harga` varchar(35) NOT NULL,
  `stok` varchar(35) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `gambar`, `id_kategori`) VALUES
(80, 'one set outfit sweater', '110000', '15', 'bajucowo3.jpg', 17),
(79, 'one set outfit ', '150000', '10', '9a1da13c9605825f1b560d5ca60e99f7.jpg', 17),
(78, 'Cardigan korea', '45000', '15', 'baju4.jpg', 16),
(84, 'Kemeja coklat', '70000', '20', 'bajucowo4.jpg', 17),
(83, 'Jaket varsity', '65000', '10', 'baju cowo2.jpg', 17),
(82, 'dress black', '125000', '10', 'dress2.jpg', 16),
(81, 'dress white', '115000', '20', 'dress1.jpg', 16),
(76, 'Jepit Aesthetic', '22000', '25', 'acc3.jpg', 19),
(77, 'Cardigan kekinian', '50000', '15', 'baju1.jpg', 16),
(74, 'Scrunchie', '25000', '20', 'acc2.jpg', 19),
(75, 'Sunglasses', '20000', '15', 'acc1.jpg', 19),
(85, 'dress anak', '95000', '20', 'bajuanak1.jpg', 18),
(86, 'dress anak white', '100000', '20', 'bajuanak2.jpg', 18),
(87, 'kaos anak', '75000', '25', 'bajuanak3.jpg', 18),
(88, 'one set kids', '125000', '20', 'bajuanak4.jpg', 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(19, 'Accessories'),
(16, 'Female'),
(17, 'Male'),
(18, 'Kids');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `harga_barang` varchar(25) NOT NULL,
  `jumlah_beli` varchar(25) NOT NULL,
  `status` varchar(30) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `total` varchar(25) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `hak` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `jenis_kelamin`, `tgl_lahir`, `username`, `password`, `hak`) VALUES
(6, 'Medisku', 'Perempuan', '2022-12-06', 'admin', 'ADMIN', 'admin'),
(11, 'eldis', 'Perempuan', '2022-12-06', 'eldis', 'eldis', 'pengguna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `waktu_transaksi` varchar(50) NOT NULL,
  `subtotal` varchar(25) NOT NULL,
  `status_transaksi` varchar(30) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `rekening` varchar(100) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `waktu_transaksi`, `subtotal`, `status_transaksi`, `alamat`, `no_hp`, `rekening`, `id_pengguna`) VALUES
(64, 'Thursday, 16-06-2022 09:13:15pm', '80000', 'lunas', 'Ardini', '089112233445', '326735682641237', 9),
(65, 'Sunday, 19-06-2022 04:30:24pm', '300000', 'lunas', 'Telang Indah', '999', '887878', 10),
(66, 'Sunday, 19-06-2022 04:57:29pm', '120000', 'lunas', 'bkl', '0882669979', '790202882002', 10);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
