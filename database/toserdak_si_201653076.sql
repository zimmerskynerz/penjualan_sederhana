-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2020 at 10:48 PM
-- Server version: 10.3.24-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toserdak_si_201653076`
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

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_brg`, `id_kategori`, `nm_brg`, `stok`, `h_beli`, `h_jual`, `foto`, `status`) VALUES
('AKS001', 'AKS', 'Asbak Rokok', 10, 25000, 45000, '06082020161920b0df7dfdea5e2b7d5559b9a7c9e76fba.jpg', 'ada'),
('AKS002', 'AKS', 'Tempat Tisu', 12, 60000, 85000, '06082020162221F3.jpg', 'ada'),
('AKS003', 'AKS', 'Asus', 2, 2, 2, '060820201625481c97d6984b6ef69dc040e7a17c2f84ba.jpg', 'ada'),
('AKS004', 'AKS', 'Tempat Air Minum', 22, 120000, 155000, '06082020163703ngasem_ngasem-model-angsa-kayu-jati-tempat-air-mineral---coklat_full05.jpg', 'ada'),
('AKS005', 'AKS', 'Nampan Baki', 25, 40000, 95000, '06082020171419644924_c63c3efd-679e-43ae-8a52-52ca1285022f_1280_960.png', 'ada'),
('AKS006', 'AKS', 'Sendok Teh', 50, 10000, 23000, '060820201717409394818_92a96140-0d87-40cb-8538-af06454858aa_1280_1280.jpg', 'ada'),
('AKS007', 'AKS', 'Mangkok Bumbu', 30, 15000, 38000, '060820201718269394818_eb2779b3-e0fd-4801-8211-a17bdfabe475_1280_1280.jpg', 'ada'),
('AKS008', 'AKS', 'Mangkok Mie', 30, 40000, 68000, '06082020171939242040513_b25b4490-9cde-49e5-b082-3cf9465f1a22_2048_2048.jpg', 'ada'),
('KRS001', 'KRS', 'Kursi Teras', 15, 300000, 550000, '0608202016393639048383_8d952dbe-6f4f-4648-8493-d0e07a17115d_1000_750.jpg', 'ada'),
('KRS002', 'KRS', 'Kursi Tamu Mewah', 10, 3000000, 4900000, '060820201643292c1fc75428a0fd095828dee296f0dd6c.jpg', 'ada'),
('KRS003', 'KRS', 'Kursi Tamu Minimalis', 12, 2000000, 3700000, '06082020164629Kursi-Tamu-Minimalis-2016.jpg', 'ada'),
('KRS004', 'KRS', 'Kursi Tamu Antik', 10, 1900000, 3200000, '0608202016494925811941_d5d60b7a-7f81-45d2-9272-c8ce2a3ef530_2048_1536.jpg', 'ada'),
('KRS005', 'KRS', 'Kursi Antik Lawas', 20, 300000, 650000, '06082020165143Kursi_jati_antik_kayu_jati_lama_lawas_kuno.jpg', 'ada'),
('KRS006', 'KRS', 'Kursi Panjang Minimalis', 10, 2000000, 2800000, '06082020165329bd16b52155c41670db1471a277e4c937.jpg', 'ada'),
('KRS007', 'KRS', 'Kursi Anyam', 25, 400000, 750000, '060820201655353075314_b72c09bf-1d2c-497c-a7c8-be20b35751cc_882_882.png', 'ada'),
('KRS008', 'KRS', 'Kursi Cafe Minimalis', 30, 120000, 230000, '0608202017054474368c6d-3f35-4d0d-a939-69f5c62a1bab.jpg', 'ada'),
('KRS009', 'KRS', 'Kursi Cafe Mewah', 20, 230000, 500000, '0608202017090285b0fc9cc1e4aedca4d0c75717238a2a.jpg', 'ada'),
('KRS010', 'KRS', 'Kursi Tamu Ganesha Mewah', 6, 6000000, 8500000, '060820201740192c1fc75428a0fd095828dee296f0dd6c.jpg', 'ada'),
('MJ001', 'MJ', 'Meja Kopi', 25, 500000, 850000, '0608202016594945440445_479697a7-629b-465d-84ed-5059c2a85f29_1280_1280.jpg', 'ada'),
('MJ002', 'MJ', 'Meja Lesehan', 15, 100000, 200000, '0608202017125418511450_5ce533e7-8b3f-4a9b-b3ef-6ea6d6428544_2000_2000.jpg', 'ada'),
('MJ003', 'MJ', 'Meja Ukir Lesehan', 10, 500000, 850000, '06082020173037d9e543fba2c62e4d4778874eb55da866.jpg', 'ada'),
('MJ004', 'MJ', 'Meja Ukir Ketapang', 7, 950000, 1400000, '060820201733551977207_cb0819d0-ac1b-4e39-98b1-cfb496e1bc4f_960_960.jpg', 'ada'),
('MJM001', 'MJM', 'Meja Makan Set Balero', 5, 2500000, 3300000, '0608202017235411161630_fe8e89d3-7104-44a9-903d-a70d07db7908_1000_1000.jpg', 'ada'),
('MJM002', 'MJM', 'Meja Makan 6 kursi', 6, 3000000, 5000000, '06082020172515158967426_45192c30-6c9c-42c1-a3dd-039b53b2e121_1280_720.jpg', 'ada');

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

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nm_kategori`, `ket`, `status`) VALUES
('AKS', 'Aksesoris', 'Aksesoris Kayu Jati', 'ada'),
('KRS', 'Kursi', 'Berbagai jenis Kursi', 'ada'),
('MJ', 'Meja', 'Aneka Jenis Meja', 'ada'),
('MJM', 'Meja Makan', 'Set Meja Makan', 'ada');

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

--
-- Dumping data for table `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`id_ongkir`, `kota_tujuan`, `tarif`, `status`) VALUES
(1, 'KUDUS', 90000, 'ada');

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
(1, 'pemilik', 'pemilik', 'Pemilik Maya Antique Meubel', 'Desa Sengonbugel, Kecamatan Mayong, Kabupaten Jepara - Jawa Tengah kode pos : 59465', 'JEPARA', 59465, '08112904711', 'maya.antique@gmail.com', 'pemilik', 'ada'),
(2, 'kasir', 'kasir', 'Putri Kurmala Sari', 'Ds. Karangan', 'Jepara', 59382, '0895411547434', 'kurmala@gmal.com', 'kasir', 'ada'),
(3, 'gudang', 'gudang', 'GUDANG COI', 'D', 'a', 59382, '0895411547434', 'gudang@rizki.com', 'gudang', 'ada'),
(4, 'pelanggan', 'pelanggan', 'PELANGGAN 1', 'Kudus', 'KUDUS', 59382, '0895411547434', 'Gudang@rizki.com', 'pelanggan', 'ada'),
(5, 'Wiwik', '123', 'Wiwik', 'Hagsnsisb', 'KUDUS', 12345, '086172862819', 'heheb@gmail.com', 'pelanggan', 'ada');

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
-- AUTO_INCREMENT for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_beli` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
