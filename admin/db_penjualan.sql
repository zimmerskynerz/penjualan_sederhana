-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2019 at 08:54 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `rinci_beli`
--

CREATE TABLE `rinci_beli` (
  `id_beli` int(6) DEFAULT NULL,
  `id_user` int(5) NOT NULL,
  `id_brg` varchar(7) NOT NULL,
  `jml` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `hrg_ttl` int(10) NOT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_brg` varchar(7) NOT NULL,
  `id_kategori` varchar(3) NOT NULL,
  `nm_brg` text NOT NULL,
  `stok` int(4) NOT NULL,
  `h_beli` int(9) NOT NULL,
  `h_jual` int(9) NOT NULL,
  `foto` text NOT NULL,
  `status` enum('ada','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` varchar(3) NOT NULL,
  `nm_kategori` text NOT NULL,
  `ket` text NOT NULL,
  `status` enum('ada','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `kota_tujuan` text NOT NULL,
  `tarif` int(11) NOT NULL,
  `status` enum('ada','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tranfer`
--

CREATE TABLE `tb_tranfer` (
  `id_beli` int(6) NOT NULL,
  `tgl_upload` date DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `no_rek` text DEFAULT NULL,
  `an` text DEFAULT NULL,
  `nominal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_beli` int(6) NOT NULL,
  `tgl_beli` date NOT NULL,
  `id_user` int(5) DEFAULT NULL,
  `ttl_hrg` int(10) DEFAULT NULL,
  `id_ongkir` int(5) DEFAULT NULL,
  `ttl_bayar` int(10) DEFAULT NULL,
  `bayar` int(10) DEFAULT NULL,
  `kembali` int(10) DEFAULT NULL,
  `status_bayar` enum('lunas','tranfer','order','belum') NOT NULL DEFAULT 'belum',
  `status_kirim` enum('belum','dikirim','diterima','return','proses') NOT NULL,
  `status` enum('ada','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `nm_user` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `kode_pos` int(5) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `level` enum('pemilik','kasir','gudang','pelanggan') NOT NULL,
  `status` enum('ada','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nm_user`, `alamat`, `kota`, `kode_pos`, `no_hp`, `email`, `level`, `status`) VALUES
(1, 'santijaya', 'SALOKU123abc', 'Shanti A Wijaya', 'Ds. Hadipolo, RT. 05/ RW. 05, Kec. Jekulo', 'Kudus', 59382, '085989777123', 'ajiw100@gmail.com', 'pemilik', 'ada'),
(2, 'admin', 'admin', 'Maulidya Putri', 'Ds. Welahan Wetan, RT. 09/RW01, Kec. Welahan', 'Jepara', 58947, '085664789153', 'Deamauli@gmail.com', 'kasir', 'ada'),
(16, NULL, NULL, 'sasa', 'dsds', 'Kudus', 59382, '666', 'wawansadhipay@yahoo.com', 'pelanggan', 'ada'),
(17, NULL, NULL, 'Kukoh', 'Ds. Pedawang, RT. 08/ RW. 1', 'Kudus', 59353, '089123111267', 'ajiw100@gmail.com', 'pelanggan', 'ada'),
(19, NULL, NULL, 'Tsama Muthia Ringgahadini', 'Ds. Bulungcangkring, RT. 09/ RW.5, Kec. Jekulo', 'KUDUS', 59353, '02917434', 'ajiw100@gmail.com', 'pelanggan', 'ada'),
(20, 'gudang', '123', 'Tamara Blandsky', 'Ds. Hadipolo, RT.09/ RW.05, Kec. Jekulo', 'KUDUS', 59382, '0895411547434', 'ajiw100@gmail.com', 'gudang', 'ada'),
(22, 'zimmersky', 'SALOKU123abc', 'Muhammad Yusuf Aji Wijaya', 'Ds. Hadipolo, RT. 05. RW,05, Kec. Jekulo,', 'KUDUS', 59382, '08765546677', 'wawansadhipay@yahoo.com', 'pelanggan', 'ada'),
(23, 'nswk1983', '123', 'Nitisastro Wijaya kusuma', 'Ds. Garong no. 10', 'JEPARA', 58966, '0895411547434', 'wawansadhipay@yahoo.com', 'pelanggan', 'ada'),
(24, NULL, NULL, 'Wawan', 'Hongosoco', 'KUDUS', 59366, '085647789456', 'wawansadhipay@yahoo.com', 'pelanggan', 'ada'),
(25, NULL, NULL, 'Riska', 'Ds. Sucen', 'KUDUS', 59382, '666', 'wawansadhipay@yahoo.com', 'pelanggan', 'ada'),
(26, 'kasir21', '123', 'Annonymous', 'DS', 'kudus', 59382, '085989777123', 'ajiw100@gmail.com', 'kasir', 'ada');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rinci_beli`
--
ALTER TABLE `rinci_beli`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_beli` (`id_beli`),
  ADD KEY `id_brg` (`id_brg`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_brg`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `tb_tranfer`
--
ALTER TABLE `tb_tranfer`
  ADD KEY `id_beli` (`id_beli`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_beli`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_beli` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rinci_beli`
--
ALTER TABLE `rinci_beli`
  ADD CONSTRAINT `rinci_beli_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `rinci_beli_ibfk_2` FOREIGN KEY (`id_beli`) REFERENCES `tb_transaksi` (`id_beli`),
  ADD CONSTRAINT `rinci_beli_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `rinci_beli_ibfk_4` FOREIGN KEY (`id_beli`) REFERENCES `tb_transaksi` (`id_beli`),
  ADD CONSTRAINT `rinci_beli_ibfk_5` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `rinci_beli_ibfk_6` FOREIGN KEY (`id_beli`) REFERENCES `tb_transaksi` (`id_beli`),
  ADD CONSTRAINT `rinci_beli_ibfk_7` FOREIGN KEY (`id_brg`) REFERENCES `tb_barang` (`id_brg`);

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`);

--
-- Constraints for table `tb_tranfer`
--
ALTER TABLE `tb_tranfer`
  ADD CONSTRAINT `tb_tranfer_ibfk_1` FOREIGN KEY (`id_beli`) REFERENCES `tb_transaksi` (`id_beli`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_ongkir`) REFERENCES `tb_ongkir` (`id_ongkir`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
