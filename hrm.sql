-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2012 at 04:47 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE IF NOT EXISTS `cuti` (
  `username` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `lama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`username`, `tanggal`, `lama`) VALUES
('admin', '2012-12-04', 2),
('admin', '2012-12-01', 1),
('boss', '2012-11-07', 2),
('boss', '2012-10-01', 2),
('admin', '2012-10-30', 2),
('admin', '2013-01-03', 2),
('admin', '2013-01-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `noTelp` varchar(15) NOT NULL,
  `gaji` int(11) NOT NULL,
  `jumlahCuti` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`username`, `password`, `nama`, `jabatan`, `alamat`, `noTelp`, `gaji`, `jumlahCuti`) VALUES
('admin', '202cb962ac59075b964b07152d234b70', 'macho', 'admin', 'BSD', '12345', 50000, 8),
('boss', '202cb962ac59075b964b07152d234b70', 'albert', 'boss', 'Bintaro', '123', 30000, 5),
('user01', '202cb962ac59075b964b07152d234b70', 'yuddis', 'user', 'BSD', '987', 10000, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
