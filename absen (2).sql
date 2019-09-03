-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2019 at 01:53 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `tbl_idadmin` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `username_admin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_hp` int(15) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `otp` text NOT NULL,
  `timeotp` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `createDtm` datetime NOT NULL,
  `updateDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`tbl_idadmin`, `nama_admin`, `username_admin`, `password`, `email_admin`, `alamat`, `nomor_hp`, `tanggal_lahir`, `tempat_lahir`, `otp`, `timeotp`, `foto`, `createDtm`, `updateDtm`) VALUES
(1, 'Nadoyoas', 'Nadoyo', '$2y$10$jCYUzAeG6sxr/UBUQmh9ieMTuqsltk2zUxhmAH.ivj2KNVVNGYhCK', 'Nadoyo27@gmail.com', 'Jalan Rayaasd', 324234234, '2019-07-14', 'Indonesia', '$2y$10$reA0o.m/FhGqkIidiPFkUuKNtRKjxkEiQM4YjEA31Hfzia8zFHaLC', 'MTU2NzUxMDkzMA==', '9576531.jpg', '0000-00-00 00:00:00', '2019-09-02 13:32:54'),
(2, 'Sayang', 'Sayang', '$2y$10$PoCnBb8UcygbWQZG7h2F3.xg6uu8RgPI1M0FfqLNjKc2CUn46K9ou', 'Sayang@gmail.com', 'Jalan Satu', 77782378, '2019-07-22', 'Yogyakarta', '$2y$10$jnb7CTk7rdEIsMoVhWgvMuUEREYHfVYgRBEM.18m1cOvwhaLilE22', 'MTU2NzQwNTgwNQ==', 'default1.png', '0000-00-00 00:00:00', '2019-09-01 20:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_hadir`
--

CREATE TABLE `daftar_hadir` (
  `tbl_idabsen` int(10) NOT NULL,
  `nomor_pegawai` varchar(255) NOT NULL,
  `koderfid` varchar(255) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_pegawai`
--

CREATE TABLE `jabatan_pegawai` (
  `id` int(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan_pegawai`
--

INSERT INTO `jabatan_pegawai` (`id`, `jabatan`) VALUES
(3, 'Manager'),
(4, 'Bos');

-- --------------------------------------------------------

--
-- Table structure for table `jam_absen`
--

CREATE TABLE `jam_absen` (
  `id` int(255) NOT NULL,
  `jam_masuk` time NOT NULL,
  `max_jammasuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `max_jampulang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam_absen`
--

INSERT INTO `jam_absen` (`id`, `jam_masuk`, `max_jammasuk`, `jam_pulang`, `max_jampulang`) VALUES
(1, '07:00:00', '10:00:00', '15:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `log_login_admin`
--

CREATE TABLE `log_login_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `tanggal_login` date NOT NULL,
  `jam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_login_pegawai`
--

CREATE TABLE `log_login_pegawai` (
  `id` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `tanggal_login` date NOT NULL,
  `jam_login` time NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `tbl_idpegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `tanggal_lahir_pegawai` date NOT NULL,
  `tempat_lahir_pegawai` varchar(255) NOT NULL,
  `nomor_hp_pegawai` varchar(15) NOT NULL,
  `nomor_pegawai` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `koderfid` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jeniskelamin` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `createDtm` datetime NOT NULL,
  `updateDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`tbl_idpegawai`, `nama_pegawai`, `tanggal_lahir_pegawai`, `tempat_lahir_pegawai`, `nomor_hp_pegawai`, `nomor_pegawai`, `jabatan`, `koderfid`, `foto`, `password`, `alamat`, `jeniskelamin`, `agama`, `email`, `active`, `createDtm`, `updateDtm`) VALUES
(30, 'System Administrator', '2019-09-18', 'Indonesia', '5345345', '12345', 'Manager', '71323010', 'default.png', '$2y$10$cYXfplAL9WBZADfAO1M3GepXGUXectCtX3aW.PVHEo6RIW2j0Kkl2', 'Indonesia', 'Laki-laki', 'Islam', 'Admin@gmail.com', '', '2019-09-03 18:51:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_keluar`
--

CREATE TABLE `pegawai_keluar` (
  `id` int(255) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `nomor_hp` varchar(255) NOT NULL,
  `nomor_pegawai` varchar(255) NOT NULL,
  `koderfid` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jeniskelamin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `tanggal_keluar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `timend` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_login`
--

CREATE TABLE `status_login` (
  `id` int(255) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `nomor_pegawai` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_izin`
--

CREATE TABLE `surat_izin` (
  `id` int(255) NOT NULL,
  `tbl_idpegawai` int(255) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `nomor_pegawai` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `isi` text NOT NULL,
  `DTM` datetime NOT NULL,
  `hasil` varchar(255) NOT NULL,
  `DTM_hasil` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`tbl_idadmin`);

--
-- Indexes for table `daftar_hadir`
--
ALTER TABLE `daftar_hadir`
  ADD PRIMARY KEY (`tbl_idabsen`);

--
-- Indexes for table `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jam_absen`
--
ALTER TABLE `jam_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_login_admin`
--
ALTER TABLE `log_login_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_login_pegawai`
--
ALTER TABLE `log_login_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`tbl_idpegawai`);

--
-- Indexes for table `pegawai_keluar`
--
ALTER TABLE `pegawai_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_login`
--
ALTER TABLE `status_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_izin`
--
ALTER TABLE `surat_izin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `tbl_idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daftar_hadir`
--
ALTER TABLE `daftar_hadir`
  MODIFY `tbl_idabsen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT for table `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jam_absen`
--
ALTER TABLE `jam_absen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_login_admin`
--
ALTER TABLE `log_login_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `log_login_pegawai`
--
ALTER TABLE `log_login_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `tbl_idpegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pegawai_keluar`
--
ALTER TABLE `pegawai_keluar`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `status_login`
--
ALTER TABLE `status_login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_izin`
--
ALTER TABLE `surat_izin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
