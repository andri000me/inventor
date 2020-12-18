-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2020 at 04:44 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(35) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `deskripsi_barang` text NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `status_barang` enum('baru','bekas','','') NOT NULL,
  `garansi` enum('ya','tidak','','') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kode_barang`, `nama_barang`, `deskripsi_barang`, `id_kategori`, `jumlah_barang`, `harga_beli`, `tanggal_beli`, `status_barang`, `garansi`, `id_user`) VALUES
(1, '123654', 'Monitor Asuz', 'Monitor Asuz 14 In', 1, 4, 5000000, '2020-12-16', 'baru', 'tidak', 3),
(3, '123456', 'laptop Asuz Roq', 'laptop asuz warna merah, ram 3 GB, Hdd 1 TB. ukuran 14Ince', 1, 4, 5000000, '2020-12-16', 'baru', 'ya', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_devisi`
--

CREATE TABLE `tb_devisi` (
  `id_devisi` int(11) NOT NULL,
  `nama_devisi` varchar(200) NOT NULL,
  `no_tlp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_devisi`
--

INSERT INTO `tb_devisi` (`id_devisi`, `nama_devisi`, `no_tlp`) VALUES
(1, 'Ruang Rapat', '021-222120'),
(2, 'Ruang Humas', '021-202122'),
(3, 'Ruang Keuangan', '021-020103'),
(4, 'Ruang Kajur', '021-020301'),
(5, 'Ruang Perpus', '021-020103');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Elektronik'),
(2, 'Kendaraan'),
(3, 'ATK'),
(4, 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_user` int(11) NOT NULL,
  `npp` varchar(10) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `id_devisi` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `status` enum('terima','tolak','','') NOT NULL,
  `level` enum('member','admin','super','') NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `terakhir_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_user`, `npp`, `nama_pegawai`, `id_devisi`, `email`, `password`, `status`, `level`, `tgl_daftar`, `terakhir_masuk`) VALUES
(1, '222251', 'Johan', 3, 'johan@admin.com', 'sha256:1000:NozycXw+v3WuovFNGVh+JbBcEJrTtQuW:PO8wAXV2fyOFlwKFYe3sIlt3I3P45Vrq', 'terima', 'member', '2020-12-18 03:43:03', '2020-12-17 21:43:03'),
(2, '222201', 'Mr Josa', 2, '', 'sha256:1000:NozycXw+v3WuovFNGVh+JbBcEJrTtQuW:PO8wAXV2fyOFlwKFYe3sIlt3I3P45Vrq', 'terima', 'member', '2020-12-17 03:44:00', '2020-12-17 03:44:00'),
(3, '222292921', 'admin', 2, 'admin@gmail.com', 'sha256:1000:NozycXw+v3WuovFNGVh+JbBcEJrTtQuW:PO8wAXV2fyOFlwKFYe3sIlt3I3P45Vrq', 'terima', 'super', '2020-12-18 03:41:51', '2020-12-17 21:41:51'),
(4, '202020', 'jo', 3, '', '', 'terima', 'member', '2020-12-17 03:18:09', '2020-12-17 03:18:09'),
(6, '123123', 'wqddasd', 3, '', '', 'terima', 'member', '2020-12-17 03:18:09', '2020-12-17 03:18:09'),
(7, '43234', 'dasdasda', 4, '', '', 'terima', 'member', '2020-12-17 03:18:09', '2020-12-17 03:18:09'),
(8, '234324', 'contoh', 1, '', '', 'terima', 'member', '2020-12-17 03:18:09', '2020-12-17 03:18:09'),
(9, '423423', 'siapa ini', 5, '', '', 'terima', 'member', '2020-12-17 03:18:09', '2020-12-17 03:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_pengajuan` int(11) NOT NULL,
  `deskripsi_pengajuan` text NOT NULL,
  `status_pengajuan` enum('on','','') NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `update_at` date DEFAULT current_timestamp(),
  `catatan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `id_user`, `id_barang`, `jumlah_pengajuan`, `deskripsi_pengajuan`, `status_pengajuan`, `tanggal_pengajuan`, `update_at`, `catatan`) VALUES
(11, 1, 1, 1, 'mengajukan monitor baru, asus 14 inc', 'on', '2020-12-17', '2020-12-18', '-'),
(12, 1, 3, 1, 'eeeeeeeeeeee', 'on', '2020-12-17', '2020-12-18', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_devisi`
--
ALTER TABLE `tb_devisi`
  ADD PRIMARY KEY (`id_devisi`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_devisi`
--
ALTER TABLE `tb_devisi`
  MODIFY `id_devisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
