-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2021 at 09:25 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smallprojecttest`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `kd_jurusan` varchar(20) NOT NULL,
  `nm_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`kd_jurusan`, `nm_jurusan`) VALUES
('JR-001', 'Sistem Informasi'),
('JR-002', 'Teknologi Informasi'),
('JR-003', 'Sastra Inggris'),
('JR-004', 'Pertanian'),
('JR-005', 'Manajemen');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nomor_mahasiswa` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kd_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nomor_mahasiswa`, `nama`, `semester`, `kd_jurusan`) VALUES
('12173941', 'Salman alfarisyie', '1', 'JR-001'),
('12173942', 'Yuda adi pratama', '2', 'JR-005'),
('12173943', 'Muhammad ilham arfandi', '1', 'JR-001');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kd_matakuliah` varchar(20) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `nm_matakuliah` varchar(30) NOT NULL,
  `jumlah_sks` int(11) NOT NULL,
  `kd_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kd_matakuliah`, `semester`, `nm_matakuliah`, `jumlah_sks`, `kd_jurusan`) VALUES
('01', '1', 'Web programming', 4, 'JR-001'),
('02', '2', 'Pendidikan agama islam', 2, 'JR-005'),
('03', '2', 'Sistem informasi manajemen', 3, 'JR-005');

-- --------------------------------------------------------

--
-- Table structure for table `transkrip_nilai`
--

CREATE TABLE `transkrip_nilai` (
  `kd_transkrip_nilai` int(11) NOT NULL,
  `nomor_mahasiswa` varchar(10) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kd_matakuliah` varchar(10) NOT NULL,
  `mutu_matakuliah` varchar(2) NOT NULL,
  `total_mutu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transkrip_nilai`
--

INSERT INTO `transkrip_nilai` (`kd_transkrip_nilai`, `nomor_mahasiswa`, `nama_mahasiswa`, `semester`, `kd_matakuliah`, `mutu_matakuliah`, `total_mutu`) VALUES
(23, '12173942', 'Yuda adi pratama', '2', '02', 'C', 4),
(24, '12173942', 'Yuda adi pratama', '2', '03', 'A', 12),
(25, '12173941', 'Salman alfarisyie', '1', '01', 'A', 16),
(26, '12173943', 'Muhammad ilham arfandi', '1', '01', 'A', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`kd_jurusan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nomor_mahasiswa`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kd_matakuliah`);

--
-- Indexes for table `transkrip_nilai`
--
ALTER TABLE `transkrip_nilai`
  ADD PRIMARY KEY (`kd_transkrip_nilai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transkrip_nilai`
--
ALTER TABLE `transkrip_nilai`
  MODIFY `kd_transkrip_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
