-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 02:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_refairy_kel8`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_Admin` int(25) NOT NULL,
  `Nama` char(25) NOT NULL,
  `Jobdisk` char(25) NOT NULL,
  `Shift` char(25) NOT NULL,
  `Tgl.Kerja` char(25) NOT NULL,
  `Status` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_Admin`, `Nama`, `Jobdisk`, `Shift`, `Tgl.Kerja`, `Status`) VALUES
(1, 'Lucien Drace', 'AC Spesialist', 'Morning', '19/07/2024', 'On Active');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id_Nama` int(25) NOT NULL,
  `Nama` char(25) NOT NULL,
  `No.Telepon` char(25) NOT NULL,
  `Tgl.Servis` char(25) NOT NULL,
  `Layanan Servis` char(50) NOT NULL,
  `Progres` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id_Nama`, `Nama`, `No.Telepon`, `Tgl.Servis`, `Layanan Servis`, `Progres`) VALUES
(1, 'Galeri', '081234567890', '21/04/2025', 'FairyFix Engine Check', 'On Hold');

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `id_N` int(25) NOT NULL,
  `Nama` char(25) NOT NULL,
  `No.Telepon` char(25) NOT NULL,
  `Alamat` char(50) NOT NULL,
  `Tgl.Servis` char(25) NOT NULL,
  `Model Barang` char(25) NOT NULL,
  `Tipe Barang` char(25) NOT NULL,
  `Tahun` char(25) NOT NULL,
  `Keluhan` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`id_N`, `Nama`, `No.Telepon`, `Alamat`, `Tgl.Servis`, `Model Barang`, `Tipe Barang`, `Tahun`, `Keluhan`) VALUES
(1, 'Galeri', '081234567890', 'Goethestrabe No.12 Charlottenburg, Berlin 10585, G', '21/04/2025', 'Ford', 'Ranger Raptor', '2023', 'FairyFix Engine Check');

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan`
--

CREATE TABLE `perbaikan` (
  `id_Servis` int(25) NOT NULL,
  `Kode Barang` char(25) NOT NULL,
  `Nama` char(25) NOT NULL,
  `Deskripsi` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perbaikan`
--

INSERT INTO `perbaikan` (`id_Servis`, `Kode Barang`, `Nama`, `Deskripsi`) VALUES
(1, 'RS001', 'FairyFix Engine Check', 'Pemeriksaaan & Penyetelan mesin untuk perfoma opti');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `Username` int(25) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sperpart`
--

CREATE TABLE `sperpart` (
  `id_Suku Cadang` int(25) NOT NULL,
  `Kode Barang` char(25) NOT NULL,
  `Nama Barang` char(25) NOT NULL,
  `Stock` char(25) NOT NULL,
  `Type` char(50) NOT NULL,
  `Letak Barang` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sperpart`
--

INSERT INTO `sperpart` (`id_Suku Cadang`, `Kode Barang`, `Nama Barang`, `Stock`, `Type`, `Letak Barang`) VALUES
(1, 'SP001', 'Engine Oil 10W-40', '25', 'Castrol', 'Rack A-1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_Admin`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id_Nama`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id_N`);

--
-- Indexes for table `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`id_Servis`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `sperpart`
--
ALTER TABLE `sperpart`
  ADD PRIMARY KEY (`id_Suku Cadang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_Admin` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id_Nama` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id_N` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `id_Servis` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `Username` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sperpart`
--
ALTER TABLE `sperpart`
  MODIFY `id_Suku Cadang` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
