-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2026 pada 14.44
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
-- Database: `db_sistemkasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `id_toko`, `nama_kategori`) VALUES
(1, 1, 'Handphone'),
(2, 1, 'TV'),
(3, 1, 'Kulkas'),
(6, 1, 'Mesin Cuci'),
(7, 1, 'AC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_toko`, `nama_pelanggan`, `email_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 1, 'Sugiarta', 'sugiarta@gmail.com', '6287866809467', 'Dusun Kawan Tohpati'),
(2, 1, 'Darmawan', 'darmawan@gmail.com', '6281805303019', 'dusun kawan desa tohpati'),
(3, 1, 'Nyoman Wira Raja', 'wira@gmail.com', '6281558162825', 'dangin puri'),
(4, 1, 'I Wayan Krisnawan', 'tapak@gmail.com', '6281238514340', 'Nusa penida, klungkung, bali'),
(5, 1, 'I Kadek Nanda Kusuma', 'nanda@gmail.com', '6281913721731', 'dauh tukad'),
(6, 1, 'Ni Kadek Ita Dewi', 'itadewi@gmail.com', '6287762521080', 'Tohpati klungkung'),
(7, 1, 'Putu Tuari', 'tuari@gmail.com', '6282145283895', 'Desa Amerta Buana, Karangasem');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_rekening` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_penjualan` datetime NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `bayar_penjualan` int(11) NOT NULL,
  `kembalian_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_pelanggan`, `id_rekening`, `id_toko`, `id_user`, `tanggal_penjualan`, `total_penjualan`, `bayar_penjualan`, `kembalian_penjualan`) VALUES
(1, 1, 1, 1, 2, '2024-10-24 18:04:46', 10000, 15000, 5000),
(3, 1, 1, 1, 2, '2024-10-28 11:21:49', 27000, 35000, 8000),
(5, 0, 1, 1, 2, '2024-10-29 18:15:30', 75000, 80000, 5000),
(6, 1, 1, 1, 2, '2024-10-29 18:53:57', 5000, 10000, 5000),
(7, 2, 1, 1, 2, '2024-10-29 19:03:37', 65000, 70000, 5000),
(8, 0, 1, 1, 2, '2024-10-30 13:25:14', 30000, 40000, 10000),
(10, 2, 1, 1, 2, '2024-10-30 13:50:11', 120000, 150000, 30000),
(12, 0, 2, 1, 2, '2024-10-30 14:33:52', 60000, 70000, 10000),
(13, 3, 1, 1, 2, '2024-10-30 14:37:08', 27000, 30000, 3000),
(14, 1, 3, 1, 2, '2024-10-31 15:05:41', 62000, 100000, 38000),
(15, 1, 1, 1, 2, '2024-11-05 15:45:03', 60000, 70000, 10000),
(16, 2, 1, 1, 2, '2024-11-05 16:11:45', 30000, 40000, 10000),
(17, 4, 1, 1, 2, '2024-11-08 11:57:04', 15800000, 15800000, 0),
(18, 5, 2, 1, 2, '2024-12-06 12:22:25', 12800000, 13000000, 200000),
(19, 1, 1, 1, 2, '2024-12-10 13:03:07', 13900000, 14000000, 100000),
(20, 6, 1, 1, 2, '2024-12-10 13:07:59', 4500000, 5000000, 500000),
(31, 1, 1, 1, 2, '2024-12-22 04:04:53', 6300000, 6500000, 200000),
(34, 2, 1, 1, 2, '2026-03-11 14:07:24', 2000000, 2000000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_produk`
--

CREATE TABLE `penjualan_produk` (
  `id_penjualan_produk` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `nama_jual` varchar(255) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `subtotal_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan_produk`
--

INSERT INTO `penjualan_produk` (`id_penjualan_produk`, `id_penjualan`, `id_produk`, `id_toko`, `harga_beli`, `nama_jual`, `harga_jual`, `jumlah_jual`, `subtotal_jual`) VALUES
(1, 1, 2, 1, 1500, 'Nabati Vanila', 2000, 3, 6000),
(2, 1, 1, 1, 1500, 'Nextar Kelapa', 2000, 2, 4000),
(5, 3, 1, 1, 1500, 'Nextar Kelapa', 2000, 1, 2000),
(6, 3, 3, 1, 20000, 'Creatine Mono', 25000, 1, 25000),
(9, 5, 4, 1, 50000, 'Jasa Joki Tugas', 75000, 1, 75000),
(10, 6, 2, 1, 2000, 'Nabati Keju', 5000, 1, 5000),
(11, 7, 5, 1, 40000, 'Service AC Sharp', 60000, 1, 60000),
(12, 7, 2, 1, 2000, 'Nabati Keju', 5000, 1, 5000),
(13, 8, 2, 1, 2000, 'Nabati Keju', 5000, 1, 5000),
(14, 8, 3, 1, 20000, 'Creatine Mono', 25000, 1, 25000),
(17, 10, 5, 1, 40000, 'Service AC Sharp', 60000, 2, 120000),
(19, 12, 5, 1, 40000, 'Service AC Sharp', 60000, 1, 60000),
(20, 13, 1, 1, 1500, 'Nextar Kelapa', 2000, 1, 2000),
(21, 13, 3, 1, 20000, 'Creatine Mono', 25000, 1, 25000),
(22, 14, 5, 1, 40000, 'Service AC Sharp', 60000, 1, 60000),
(23, 14, 1, 1, 1500, 'Nextar Kelapa', 2000, 1, 2000),
(24, 15, 5, 1, 40000, 'Service AC Sharp', 60000, 1, 60000),
(25, 16, 3, 1, 20000, 'Creatine Mono', 25000, 1, 25000),
(26, 16, 2, 1, 2000, 'Nabati Keju', 5000, 1, 5000),
(27, 17, 12, 1, 6700000, 'MESIN CUCI LD', 6900000, 1, 6900000),
(28, 17, 6, 1, 8500000, 'SAMSUNG 50\" OLED Q60D', 8900000, 1, 8900000),
(29, 18, 11, 1, 5500000, 'AC SAMSUNG ', 6000000, 1, 6000000),
(30, 18, 10, 1, 2500000, 'AC SHARP ', 3000000, 1, 3000000),
(31, 18, 9, 1, 3500000, 'MESIN CUCI SAMSUNG', 3800000, 1, 3800000),
(32, 19, 12, 1, 6700000, 'MESIN CUCI LD', 6900000, 1, 6900000),
(33, 19, 7, 1, 650000, 'LG 50UR7500 Smart TV ', 7000000, 1, 7000000),
(34, 20, 4, 1, 4000000, 'REDMI NOTE 13 PRO', 4500000, 1, 4500000),
(50, 34, 15, 1, 1799000, 'XIAOMI TV A2 32 Inch', 2000000, 1, 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `kode_produk` varchar(25) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `beli_produk` int(11) NOT NULL,
  `jual_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `keterangan_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_supplier`, `id_kategori`, `id_toko`, `kode_produk`, `nama_produk`, `beli_produk`, `jual_produk`, `stok_produk`, `foto_produk`, `keterangan_produk`) VALUES
(1, 1, 1, 1, 'KD1', 'IPHONE 13 PRO', 10500000, 11000000, 8, 'Iphone 13 pro.jpg', 'Dapatkan iPhone 13 dengan layar Super Retina XDR dan chipset A15 Bionic. Pengalaman terbaik dengan kamera dual 12MP dan fitur canggih di iBox Indonesia.'),
(2, 1, 1, 1, 'KD2', 'IPHONE 14 PRO', 11000000, 11500000, 7, 'Iphone 14 pro.png', 'Layar · Layar Super Retina XDR · Layar OLED menyeluruh 6,1 inci (diagonal) · Resolusi 2556 x 1179 piksel pada 460 ppi · Dynamic Island · Layar yang Selalu Aktif.'),
(3, 1, 1, 1, 'KD3', 'IPHONE 15 PRO MAX', 20000000, 22000000, 6, 'Iphone 15 pro max.jpg', 'iPhone 15 Pro Max memiliki desain titanium sekelas industri dirgantara yang kuat dan ringan dengan bagian belakang kaca matte bertekstur.'),
(4, 2, 1, 1, 'KD4', 'REDMI NOTE 13 PRO', 4000000, 4500000, 8, 'redmi 13 pro.png', 'Redmi Note 13 Pro Android smartphone. Announced Sep 2023. Features 6.67″ display, Snapdragon 7s Gen 2 chipset, 5100 mAh battery, 512 GB storage'),
(5, 2, 1, 1, 'KD5', 'REDMI NOTE 12 PRO', 3900000, 4300000, 9, 'redmin 12 pro.png', 'Redmi Note 12 Pro ; Prosesor octa-core. CPU dan GPU canggih ; Desain frame datar yang trendi. Glacier BlueGraphite GrayPolar WhiteGlacier Blue'),
(6, 3, 2, 1, 'KD6', 'SAMSUNG 50\" OLED Q60D', 8500000, 8900000, 9, 'tv samsung.jpg', 'Rasakan Kekuatan Penuh Kecerdasan Buatan di 4K dengan Samsung Neo QLED Q60D'),
(7, 7, 2, 1, 'KD7', 'LG 50UR7500 Smart TV ', 650000, 7000000, 9, 'tv lg.jpg', 'LG 50 INCH 4K UHD SMART TV UP80 SERIES [50UP8000PTB], Rp. 8.450.000 ; LG TV UHD NANOCELL SMART TV 4K 50 INCH NEW 2021'),
(8, 8, 3, 1, 'KD8', 'KULKAS SHARP 2 PINTU', 3300000, 3500000, 5, 'kulkas sharp.jpg', 'Kulkas 2 pintu Sharp memiliki Fan Cooling System: Sistem pendingin yang dibantu kipas untuk mendinginkan isi kulkas secara merata.'),
(9, 3, 6, 1, 'KD9', 'MESIN CUCI SAMSUNG', 3500000, 3800000, 6, 'MESIN CUCI.avif', 'Pre-Order The NEW Bespoke AI Laundry Combo & Discover Ultimate Laundry Experience. Get Free Galaxy Flip6 & Other Benefit up to IDR 24 Mio.'),
(10, 8, 7, 1, 'KD10', 'AC SHARP ', 2500000, 3000000, 8, 'AC SHARP.webp', 'Plasmacluster Ion Technology J-Tech Inverter Copper Evaporator & Condensor. 1 PK · DETAILS WHERE TO BUY. '),
(11, 3, 7, 1, 'KD11', 'AC SAMSUNG ', 5500000, 6000000, 3, 'AC SAMSUNG.jpg', 'Beli AC Samsung terbaik harga murah dari toko resmi Samsung Indonesia. Harga AC Samsung 1PK 2PK'),
(12, 7, 6, 1, 'KD12', 'MESIN CUCI LD', 6700000, 6900000, 8, 'MESIN CUCI LG.avif', 'Mesin cuci LG hadir dengan berbagai fitur dan teknologi unggulan untuk memberikan cucian pakaian yang bersih dengan konsumsi energi yang minimum.'),
(15, 2, 2, 1, 'KD13', 'XIAOMI TV A2 32 Inch', 1799000, 2000000, 14, 'tv redmi.jpg', 'Dilengkapi dengan layar beresolusi 4K dan berukuran hingga 32 inci, Xiaomi Smart TV mengaburkan batas antara kenyataan dan grafis serta meningkatkan pengalaman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `id_toko`, `bank`, `nomor`, `nama`) VALUES
(1, 1, 'Cash', '-', 'Tunai Kasir'),
(2, 1, 'Bank Central Asia (BCA)', '7730715522', 'I Putu Gede Sugiarta'),
(3, 1, 'Bank Rakyat Indonesia (BRI)', '0987654321', 'I Kadek Nanda Kusuma');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `id_toko`, `nama_supplier`) VALUES
(1, 1, 'IPHONE'),
(2, 1, 'REDMI'),
(3, 1, 'SAMSUNG'),
(7, 1, 'LG'),
(8, 1, 'SHARP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `alamat_toko` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`) VALUES
(1, 'Toko Sugi', 'Dusun Kawan Tohpati, Banjarangkan, Klungkung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `level_user` enum('kasir','gudang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_toko`, `email_user`, `password_user`, `nama_user`, `level_user`) VALUES
(1, 1, 'sugi@gmail.com', '1d4c8d73a33e42bcbc46586bc8e230a85ad2143c', 'Sugiarta', 'gudang'),
(2, 1, 'ita@gmail.com', 'c30f9cac5a3355a4214a6070577466f86df5ba41', 'Ni Kadek Ita Dewi', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  ADD PRIMARY KEY (`id_penjualan_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `penjualan_produk`
--
ALTER TABLE `penjualan_produk`
  MODIFY `id_penjualan_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
