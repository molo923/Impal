-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2019 at 09:15 AM
-- Server version: 10.3.16-MariaDB
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
-- Database: `gogon`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `u` ()  BEGIN
SELECT * FROM banksampah;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `a` (`phar` INT) RETURNS VARCHAR(30) CHARSET latin1 BEGIN
DECLARE surp varchar(30);
IF phar >= 10000 THEN SET surp = 'Dapat Gelas';
ELSEIF phar BETWEEN 7000 AND 9999 THEN SET surp = 'Dapat Pulpen';
ELSE SET surp = 'Belum Dapat';
END IF;
RETURN(surp);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `arus_sampah`
--

CREATE TABLE `arus_sampah` (
  `tgl_transaksi` date NOT NULL,
  `id_setoran` varchar(20) DEFAULT NULL,
  `id_sampahkeluar` varchar(20) DEFAULT NULL,
  `id_kategorisampah` int(11) NOT NULL,
  `ds` float(8,2) NOT NULL,
  `ks` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arus_sampah`
--

INSERT INTO `arus_sampah` (`tgl_transaksi`, `id_setoran`, `id_sampahkeluar`, `id_kategorisampah`, `ds`, `ks`) VALUES
('2019-07-05', 'S-42133', NULL, 33, 20.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `banksampah`
--

CREATE TABLE `banksampah` (
  `id_banksampah` int(11) NOT NULL,
  `id_induk` int(11) DEFAULT NULL,
  `nomor_wallet` varchar(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama_banksampah` varchar(100) NOT NULL,
  `nohp_banksampah` varchar(13) NOT NULL,
  `email_banksampah` varchar(100) NOT NULL,
  `alamat_banksampah` text NOT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `status_banksampah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banksampah`
--

INSERT INTO `banksampah` (`id_banksampah`, `id_induk`, `nomor_wallet`, `username`, `password`, `nama_banksampah`, `nohp_banksampah`, `email_banksampah`, `alamat_banksampah`, `longitude`, `latitude`, `status_banksampah`) VALUES
(12, NULL, '5214696930', 'bersinar', '664ca252f08d1b868670f5a2ffb8a93b', 'Bersinar', '082273696930', 'fi@a.com', 'Jl. Terusan Bojong Soang No.174, Baleendah, Kec. Baleendah, Bandung, Jawa Barat 40375', 107.615799, -6.967779, 'silver'),
(29, NULL, '351256745', 'adf', 'cdbbef4e17a1223199ffc105927d0dac', 'Adf', '08123456745', 'rizz_ranjy@yahoo.co.id', 'Jl. TAsik', NULL, NULL, 'bronze'),
(30, NULL, '1451985478', 'aguscans', '664ca252f08d1b868670f5a2ffb8a93b', 'AgusCan', '121223985478', 'rizz_ranjy@yahoo.co.id', 'Jl Solo', 110.861862, -7.658280, 'bronze'),
(31, NULL, '1521777667', 'asterz', 'f6f28cbbc9026f883a7e2a296a392859', 'Aster', '081234777667', 'atriutomo23@gmail.com', 'Jl,Kopo', NULL, NULL, 'bronze'),
(32, NULL, '320366666', 'k', '8ddcff3a80f4189ca1c9d4d902c3c909', 'Ecovillage', '06666666666', 'atriutomo23@gmail.com', 'k', NULL, NULL, 'bronze'),
(33, NULL, '140335667', 'j', '664ca252f08d1b868670f5a2ffb8a93b', 'Telkom', '07773435667', 'firzamaulananasution@gmail.com', 'Jlk', 107.590065, -6.939062, 'bronze'),
(34, NULL, '250254545', 'cgh', '664ca252f08d1b868670f5a2ffb8a93b', 'Huy', '04545454545', 'firzamaulananasution@gmail.com', 'Jl.Kawla', 107.630814, -6.974322, 'tidak aktif'),
(35, NULL, '514491223', 'pecelz', '664ca252f08d1b868670f5a2ffb8a93b', 'Teru', '08999991223', 'g@j.bom', 'Bandungan', 107.575027, -6.948354, 'tidak aktif');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id_driver` int(11) NOT NULL,
  `username_driver` varchar(35) NOT NULL,
  `password_driver` varchar(35) NOT NULL,
  `nama_driver` varchar(35) NOT NULL,
  `nohp_driver` varchar(12) NOT NULL,
  `jk_driver` varchar(15) NOT NULL,
  `alamat_driver` text NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `status_driver` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id_driver`, `username_driver`, `password_driver`, `nama_driver`, `nohp_driver`, `jk_driver`, `alamat_driver`, `id_banksampah`, `status_driver`) VALUES
(1, 'Kams', '123', 'kamals', '08123', 'Pria', 'jl.oo', 12, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `goniwallet`
--

CREATE TABLE `goniwallet` (
  `nomor_wallet` varchar(11) NOT NULL,
  `saldo` float(8,2) NOT NULL,
  `limit_wallet` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goniwallet`
--

INSERT INTO `goniwallet` (`nomor_wallet`, `saldo`, `limit_wallet`) VALUES
('134', 10.00, 1000.00),
('140335667', 0.00, 1000000.00),
('1451985478', 0.00, 1000000.00),
('1521777667', 0.00, 1000000.00),
('250254545', 0.00, 1000000.00),
('320366666', 0.00, 1000000.00),
('351256745', 0.00, 1000000.00),
('514491223', 0.00, 1000000.00),
('5214696930', 0.00, 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `histori_sampah`
--

CREATE TABLE `histori_sampah` (
  `tanggal_histori` date NOT NULL,
  `id_kategorisampah` int(20) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `qbeli` float(8,2) NOT NULL,
  `qhibah` float(8,2) NOT NULL,
  `qlainnya` float(8,2) NOT NULL,
  `qresidu` float(8,2) NOT NULL,
  `qmutasian` float(8,2) NOT NULL,
  `qdimutasi` float(8,2) NOT NULL,
  `qjual` float(8,2) NOT NULL,
  `qnonjual` float(8,2) NOT NULL,
  `qreject` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_sampah`
--

INSERT INTO `histori_sampah` (`tanggal_histori`, `id_kategorisampah`, `id_banksampah`, `qbeli`, `qhibah`, `qlainnya`, `qresidu`, `qmutasian`, `qdimutasi`, `qjual`, `qnonjual`, `qreject`) VALUES
('2019-06-11', 6, 12, 170.00, 723.00, 50.00, 40.00, 0.00, 0.00, 1087.00, 5.00, 200.00),
('2019-06-11', 7, 12, 20.00, 0.00, 97.00, 3.00, 0.00, 0.00, 530.00, 5.00, 27.00),
('2019-06-11', 8, 12, 415.00, 50.00, 80.00, 0.00, 0.00, 0.00, 60.00, 0.00, 30.00),
('2019-06-11', 9, 12, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 10, 12, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 11, 12, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 13, 29, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 18, 30, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 20, 30, 2488.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 21, 30, 12.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 22, 30, 44.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 25, 30, 2.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 26, 30, 44.00, 123.00, 0.00, 0.00, 0.00, 0.00, 500.00, 0.00, 0.00),
('2019-06-11', 27, 30, 165.50, 100.00, 0.00, 0.00, 0.00, 0.00, 2300.00, 0.00, 600.00),
('2019-06-11', 28, 30, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7900.00, 0.00, 2700.00),
('2019-06-11', 29, 31, 160.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 30, 31, 500.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 31, 32, 40.00, 10.00, 1.00, 5.00, 12.00, 0.00, 12.00, 0.00, 4.00),
('2019-06-11', 32, 32, 30.00, 10.00, 0.00, 0.00, 0.00, 18.00, 21.00, 0.00, 1.00),
('2019-06-11', 33, 33, 44.00, 100.00, 0.00, 15.50, 34.20, 88.00, 92.00, 0.00, 0.00),
('2019-06-11', 34, 33, 10.00, 0.00, 0.00, 20.00, 43.50, 10.00, 0.00, 0.00, 0.00),
('2019-06-11', 35, 33, 1.22, 0.00, 0.00, 52.50, 10.00, 0.50, 0.00, 0.00, 0.00),
('2019-06-11', 36, 33, 0.00, 0.00, 0.00, 0.00, 30.00, 10.00, 0.00, 0.00, 0.00),
('2019-06-11', 37, 33, 0.00, 0.00, 0.00, 0.40, 5.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 38, 33, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 39, 33, 10.44, 0.00, 0.00, 10.00, 3.30, 0.00, 0.00, 0.00, 0.00),
('2019-06-11', 40, 33, 20.00, 0.00, 0.00, 0.00, 7.00, 0.00, 6.00, 0.00, 16.40),
('2019-06-11', 41, 33, 0.00, 0.00, 0.00, 6.20, 0.00, 4.30, 0.00, 0.00, 0.00),
('2019-06-11', 42, 33, 0.00, 0.00, 0.00, 0.00, 0.00, 12.30, 0.00, 0.00, 0.00),
('2019-05-11', 6, 12, 170.00, 723.00, 50.00, 40.00, 0.00, 0.00, 1087.00, 5.00, 200.00),
('2019-05-11', 7, 12, 20.00, 0.00, 97.00, 3.00, 0.00, 0.00, 530.00, 5.00, 27.00),
('2019-05-11', 8, 12, 415.00, 50.00, 80.00, 0.00, 0.00, 0.00, 60.00, 0.00, 30.00),
('2019-05-11', 9, 12, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 10, 12, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 11, 12, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 13, 29, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 18, 30, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 20, 30, 2488.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 21, 30, 12.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 22, 30, 44.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 25, 30, 2.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 26, 30, 44.00, 123.00, 0.00, 0.00, 0.00, 0.00, 500.00, 0.00, 0.00),
('2019-05-11', 27, 30, 165.50, 100.00, 0.00, 0.00, 0.00, 0.00, 2300.00, 0.00, 600.00),
('2019-05-11', 28, 30, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7900.00, 0.00, 2700.00),
('2019-05-11', 29, 31, 160.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 30, 31, 500.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 31, 32, 40.00, 10.00, 1.00, 5.00, 12.00, 0.00, 12.00, 0.00, 4.00),
('2019-05-11', 32, 32, 30.00, 10.00, 0.00, 0.00, 0.00, 18.00, 21.00, 0.00, 1.00),
('2019-05-11', 33, 33, 44.00, 100.00, 0.00, 15.50, 34.20, 88.00, 92.00, 0.00, 0.00),
('2019-05-11', 34, 33, 10.00, 0.00, 0.00, 20.00, 43.50, 10.00, 0.00, 0.00, 0.00),
('2019-05-11', 35, 33, 1.22, 0.00, 0.00, 52.50, 10.00, 0.50, 0.00, 0.00, 0.00),
('2019-05-11', 36, 33, 0.00, 0.00, 0.00, 0.00, 30.00, 10.00, 0.00, 0.00, 0.00),
('2019-05-11', 37, 33, 0.00, 0.00, 0.00, 0.40, 5.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 38, 33, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 39, 33, 10.44, 0.00, 0.00, 10.00, 3.30, 0.00, 0.00, 0.00, 0.00),
('2019-05-11', 40, 33, 20.00, 0.00, 0.00, 0.00, 7.00, 0.00, 6.00, 0.00, 16.40),
('2019-05-11', 41, 33, 0.00, 0.00, 0.00, 6.20, 0.00, 4.30, 0.00, 0.00, 0.00),
('2019-05-11', 42, 33, 0.00, 0.00, 0.00, 0.00, 0.00, 12.30, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `jemput_langganan`
--

CREATE TABLE `jemput_langganan` (
  `id_jemputl` varchar(20) NOT NULL,
  `minggu` varchar(20) NOT NULL,
  `hari` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jemput_langganan`
--

INSERT INTO `jemput_langganan` (`id_jemputl`, `minggu`, `hari`) VALUES
('JL-00001', '1;3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `jemput_sekali`
--

CREATE TABLE `jemput_sekali` (
  `id_jemputs` varchar(20) NOT NULL,
  `id_setoran` varchar(20) NOT NULL,
  `tanggal_jemputs` date NOT NULL,
  `perkiraan_jemputs` float(8,2) NOT NULL,
  `long_jemputs` float(8,2) DEFAULT NULL,
  `lat_jemputs` float(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jemput_sekali`
--

INSERT INTO `jemput_sekali` (`id_jemputs`, `id_setoran`, `tanggal_jemputs`, `perkiraan_jemputs`, `long_jemputs`, `lat_jemputs`) VALUES
('JS-00001', 'S-00516', '2019-08-13', 100.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `join_akun`
--

CREATE TABLE `join_akun` (
  `id_joins` int(11) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `tanggal_join` date NOT NULL,
  `tanggal_out` date NOT NULL,
  `status_join` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `join_akun`
--

INSERT INTO `join_akun` (`id_joins`, `id_banksampah`, `id_nasabah`, `tanggal_join`, `tanggal_out`, `status_join`) VALUES
(11, 12, 25, '2019-06-27', '0000-00-00', 'aktif'),
(12, 12, 26, '2019-06-27', '0000-00-00', 'aktif'),
(13, 30, 27, '2019-06-28', '0000-00-00', 'aktif'),
(14, 31, 28, '2019-07-04', '0000-00-00', 'aktif'),
(15, 31, 29, '2019-07-04', '0000-00-00', 'aktif'),
(16, 33, 30, '2019-07-09', '0000-00-00', 'aktif'),
(17, 33, 31, '2019-07-10', '0000-00-00', 'aktif'),
(18, 33, 32, '2019-07-12', '0000-00-00', 'aktif'),
(19, 33, 33, '2019-07-12', '0000-00-00', 'aktif'),
(20, 33, 34, '2019-07-23', '0000-00-00', 'aktif'),
(21, 33, 35, '2019-07-24', '0000-00-00', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kategorisampah`
--

CREATE TABLE `kategorisampah` (
  `id_kategorisampah` int(20) NOT NULL,
  `kode_kat` varchar(30) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `golongan` varchar(20) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `harga` float(8,2) NOT NULL,
  `harga_rek` float(8,2) NOT NULL,
  `harga_atas` float(8,2) NOT NULL,
  `harga_bawah` float(8,2) NOT NULL,
  `qbeli` float(8,2) NOT NULL,
  `qhibah` float(8,2) NOT NULL,
  `qlainnya` float(8,2) NOT NULL,
  `qresidu` float(8,2) NOT NULL,
  `qmutasian` float(8,2) NOT NULL,
  `qdimutasi` float(8,2) NOT NULL,
  `qjual` float(8,2) NOT NULL,
  `qnonjual` float(8,2) NOT NULL,
  `qreject` float(8,2) NOT NULL,
  `deskripsi_kat` text NOT NULL,
  `status_kat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorisampah`
--

INSERT INTO `kategorisampah` (`id_kategorisampah`, `kode_kat`, `id_banksampah`, `golongan`, `jenis`, `harga`, `harga_rek`, `harga_atas`, `harga_bawah`, `qbeli`, `qhibah`, `qlainnya`, `qresidu`, `qmutasian`, `qdimutasi`, `qjual`, `qnonjual`, `qreject`, `deskripsi_kat`, `status_kat`) VALUES
(6, 'PLSTK', 12, 'anorganik', 'Plastik', 1000.00, 0.00, 0.00, 0.00, 170.00, 723.00, 50.00, 40.00, 0.00, 0.00, 1087.00, 5.00, 200.00, '', 'aktif'),
(7, 'BSI', 12, 'anorganik', 'Besi', 10.00, 0.00, 0.00, 0.00, 20.00, 0.00, 97.00, 3.00, 0.00, 0.00, 530.00, 5.00, 27.00, '', 'aktif'),
(8, 'C00', 12, 'anorganik', 'Campuran', 500.00, 0.00, 0.00, 0.00, 415.00, 50.00, 80.00, 0.00, 0.00, 0.00, 60.00, 0.00, 30.00, '', 'aktif'),
(9, 'b09', 12, 'anorganik', 'Besi tembaga', 1000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ' ', 'aktif'),
(10, 'tt', 12, 'anorganik', 'kain', 1000.00, 0.00, 0.00, 0.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', 'aktif'),
(11, 'PL', 12, 'anorganik', 'Palu', 50.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ' ', 'aktif'),
(13, 'P001', 29, 'lainnya', 'PET', 1005.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '            Botol Aqua', 'aktif'),
(18, '', 30, '', '', 0.00, 0.00, 0.00, 0.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', 'aktif'),
(20, '', 30, '', '', 0.00, 0.00, 0.00, 0.00, 2488.00, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', 'aktif'),
(21, 'BEMO', 30, 'anorganik', 'a', 500.00, 0.00, 0.00, 0.00, 12.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ' ', 'aktif'),
(22, '', 30, '', '', 0.00, 0.00, 0.00, 0.00, 44.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', 'aktif'),
(25, '', 30, '', '', 0.00, 0.00, 0.00, 0.00, 2.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', 'aktif'),
(26, 'erty', 30, 'anorganik', 'ff', 111.00, 0.00, 0.00, 0.00, 44.00, 123.00, 0.00, 0.00, 0.00, 0.00, 500.00, 0.00, 0.00, '', 'aktif'),
(27, 'ooo', 30, 'anorganik', '144', 144.00, 0.00, 0.00, 0.00, 165.50, 100.00, 0.00, 0.00, 0.00, 0.00, 2300.00, 0.00, 600.00, '', 'aktif'),
(28, 'P03', 30, 'anorganik', 'PET', 500.00, 0.00, 0.00, 0.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 7900.00, 0.00, 2700.00, '', 'aktif'),
(29, 'P00', 31, 'anorganik', 'PET', 100.00, 0.00, 0.00, 0.00, 160.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Aqua', 'aktif'),
(30, 'P01', 31, 'anorganik', 'Kardus', 1500.00, 0.00, 0.00, 0.00, 500.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', 'aktif'),
(31, 'P00', 32, 'anorganik', 'PET', 1000.00, 0.00, 0.00, 0.00, 40.00, 10.00, 1.00, 5.00, 12.00, 0.00, 12.00, 0.00, 4.00, '', 'aktif'),
(32, 'P001', 32, 'anorganik', 'PP', 300.00, 0.00, 0.00, 0.00, 30.00, 10.00, 0.00, 0.00, 0.00, 18.00, 21.00, 0.00, 1.00, '', 'aktif'),
(33, 'P00', 33, 'anorganik', 'PET', 1000.00, 0.00, 0.00, 0.00, 5069.33, 1100.00, 10.00, 15.50, 134.20, 95.00, 335.33, 0.00, 13.00, '', 'aktif'),
(34, 'P001', 33, 'anorganik', 'PP', 1200.00, 0.00, 0.00, 0.00, 10.00, 0.00, 0.00, 20.00, 48.50, 10.00, 123.00, 0.00, 124.00, '', 'aktif'),
(35, 'P003', 33, 'anorganik', 'HDPE', 100.00, 0.00, 0.00, 0.00, 4011.22, 0.00, 0.00, 52.50, 12.00, 0.50, 0.00, 0.00, 0.00, '', 'aktif'),
(36, 'P004', 33, 'anorganik', 'CC', 1000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 40.00, 10.00, 0.00, 0.00, 0.00, '', 'aktif'),
(37, 'K01', 33, 'anorganik', 'KOI', 3000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.40, 5.00, 0.00, 0.00, 0.00, 0.00, ' ', 'aktif'),
(38, 'P0l', 33, 'anorganik', 'Pi', 500.00, 0.00, 0.00, 0.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', 'aktif'),
(39, 'L0op', 33, 'anorganik', 'Lio', 100.00, 0.00, 0.00, 0.00, 10.44, 0.00, 0.00, 10.00, 3.30, 0.00, 0.00, 0.00, 0.00, ' ', 'aktif'),
(40, 'X00', 33, 'anorganik', 'Xiu', 1000.00, 0.00, 0.00, 0.00, 20.00, 0.00, 0.00, 0.00, 7.00, 0.00, 6.00, 0.00, 16.40, ' Auuw', 'aktif'),
(41, 'Goo', 33, 'anorganik', 'Grown', 120.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11.20, 0.00, 4.30, 0.00, 0.00, 0.00, '', 'aktif'),
(42, 'F00', 33, 'anorganik', 'Goni', 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.30, 0.00, 0.00, 0.00, ' ', 'aktif'),
(43, 'G88', 33, 'anorganik', 'TYU', 1000.00, 0.00, 0.00, 0.00, 122.00, 10.00, 0.00, 0.00, 0.00, 0.00, 10.00, 0.00, 20.00, '', 'aktif'),
(44, 'd00', 33, 'anorganik', 'Dasi', 500.00, 0.00, 0.00, 0.00, 10.00, 0.00, 0.00, 10.10, 40.00, 140.00, 5.00, 0.00, 0.00, 'Botol Biru', 'aktif'),
(45, 'p0060', 33, 'anorganik', 'PET', 15000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Warna biru ', 'nonaktif');

--
-- Triggers `kategorisampah`
--
DELIMITER $$
CREATE TRIGGER `r` AFTER UPDATE ON `kategorisampah` FOR EACH ROW BEGIN
INSERT INTO trgr VALUES(OLD.Id_kategorisampah,OLD.id_banksampah,OLD.golongan,OLD.jenis,OLD.harga,OLD.harga_atas,OLD.harga_bawah,OLD.deskripsi_kat,now());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kodetransaksi`
--

CREATE TABLE `kodetransaksi` (
  `kode_transaksi` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `nomorn_wallet` varchar(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `nama_nasabah` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `nohp_nasabah` varchar(12) NOT NULL,
  `email_nasabah` varchar(100) NOT NULL,
  `alamat_nasabah` text NOT NULL,
  `longitude` varchar(500) DEFAULT NULL,
  `latitude` varchar(500) DEFAULT NULL,
  `status_nasabah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nomorn_wallet`, `username`, `password`, `nama_nasabah`, `jenis_kelamin`, `nohp_nasabah`, `email_nasabah`, `alamat_nasabah`, `longitude`, `latitude`, `status_nasabah`) VALUES
(25, NULL, 'Zaaa', NULL, 'Zaaa', 'Pria', '0899919331', 'firza@jjj.com', 'Yuhu', NULL, NULL, 'Baru'),
(26, '134', 'Fakul', NULL, 'Fakul', 'Pria', '123', 'asd@k.com', 'Jl.K', NULL, NULL, 'Baru'),
(27, NULL, 'Azzavira', NULL, 'Azzavira', 'Wanita', '082273696930', 'azza@g.com', 'Jadnjd', NULL, NULL, 'Baru'),
(28, NULL, 'Rayan', NULL, 'Rayan', 'Pria', '082273696930', 'asd@k.com', 'Jl.K\r\n', NULL, NULL, 'Baru'),
(29, NULL, 'Jafar', NULL, 'Jafar', 'Pria', '082273696930', 'firza@jjj.cm', 'Jl.G\r\n', NULL, NULL, 'Baru'),
(30, NULL, 'Parjo', NULL, 'Parjo', 'Pria', '66666666666', 'azza@g.com', 'Jl.Salto', NULL, NULL, 'Baru'),
(31, NULL, 'SPAIN', NULL, 'SPAIN', 'Pria', '1234555', 'azza@g.com', '', NULL, NULL, 'Baru'),
(32, NULL, 'Lulu', NULL, 'Lulu', 'Pria', '83838388', 'azza@g.com', 'Jl.K\r\n', NULL, NULL, 'Baru'),
(33, NULL, 'Rari', NULL, 'Rari', 'Pria', '111111122', 'a@h.com', 'Jl.AAA', NULL, NULL, 'Baru'),
(34, NULL, 'Bima Sakti', NULL, 'Bima Sakti', 'Pria', '0982345', 'SWISSbel@gmail.com', 'UNJ', NULL, NULL, 'Baru'),
(35, NULL, 'Pak Dwiki', NULL, 'Pak Dwiki', 'Pria', '12345221', 'Ristek@g.com', 'Bogor', NULL, NULL, 'Baru');

-- --------------------------------------------------------

--
-- Table structure for table `sampahkeluar`
--

CREATE TABLE `sampahkeluar` (
  `id_sampahkeluar` varchar(11) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `tgl_sampahkeluar` date NOT NULL,
  `tgl_done` date NOT NULL,
  `jenis_sampahkeluar` varchar(10) NOT NULL,
  `berat_sampahkeluar` float(8,2) NOT NULL,
  `tujuan_sampahkeluar` text NOT NULL,
  `tberat_reject` float(8,2) NOT NULL,
  `total_harga_sampahkeluar` float(8,2) NOT NULL,
  `biaya_sampahkeluar` float(8,2) NOT NULL,
  `status_sampahkeluar` varchar(15) NOT NULL,
  `keterangan_sampahkeluar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampahkeluar`
--

INSERT INTO `sampahkeluar` (`id_sampahkeluar`, `id_banksampah`, `tgl_sampahkeluar`, `tgl_done`, `jenis_sampahkeluar`, `berat_sampahkeluar`, `tujuan_sampahkeluar`, `tberat_reject`, `total_harga_sampahkeluar`, `biaya_sampahkeluar`, `status_sampahkeluar`, `keterangan_sampahkeluar`) VALUES
('SK-02951', 12, '2019-05-12', '0000-00-00', 'jual', 122.00, '', 0.00, 1104.00, 0.00, 'reject', 'Kacau Semua'),
('SK-05865', 12, '2019-05-12', '0000-00-00', 'jual', 50.00, '', 0.00, 2300.00, 0.00, 'selesai', 'Cak Yu'),
('SK-12153', 12, '2019-05-13', '2019-05-13', 'jual', 1500.00, '', 0.00, 550000.00, 0.00, 'selesai', 'Buat meja'),
('SK-12251', 33, '2019-07-24', '2019-07-24', 'jual', 100.00, 'DANONE', 0.00, 1000000.00, 0.00, 'selesai', 'Ristek'),
('SK-12990', 32, '2019-07-04', '2019-07-04', 'jual', 0.00, 'RJECT', 2.00, 0.00, 0.00, 'reject', ''),
('SK-13053', 12, '2019-05-12', '0000-00-00', 'jual', 40.00, '', 10.00, 18100.00, 0.00, 'selesai', 'cc'),
('SK-13272', 12, '2019-05-12', '0000-00-00', 'jual', 30.00, '', 0.00, 3000.00, 0.00, 'reject', ''),
('SK-14689', 32, '2019-07-04', '2019-07-04', 'jual', 1.00, 'RJET', 2.00, 1.00, 0.00, 'selesai', ''),
('SK-14856', 30, '2019-07-02', '0000-00-00', 'jual', 50.00, 'Y', 50.00, 80000.00, 20000.00, 'diproses', 'Ke YPT'),
('SK-14869', 32, '2019-07-04', '0000-00-00', 'jual', 10.00, 'HUJI', 0.00, 5000.00, 0.00, 'selesai', ''),
('SK-16746', 30, '2019-07-03', '0000-00-00', 'jual', 500.00, 'ffff', 100.00, 0.00, 0.00, 'selesai', ''),
('SK-17486', 33, '2019-07-11', '2019-07-11', 'jual', 0.00, 'HUJI', 1.40, 0.00, 0.00, 'reject', 'SSS'),
('SK-18375', 32, '2019-07-04', '2019-07-04', 'jual', 2.00, 'kl', 0.00, 1400.00, 0.00, 'selesai', ''),
('SK-19395', 30, '2019-07-03', '0000-00-00', 'jual', 1500.00, 'jk', 0.00, 500000.00, 0.00, 'selesai', ''),
('SK-23227', 12, '2019-05-12', '0000-00-00', 'jual', 7.00, '', 0.00, 70.00, 0.00, 'selesai', 'ccc'),
('SK-23719', 31, '2019-07-04', '0000-00-00', 'jual', 50.00, 'gh', 0.00, 2900.00, 0.00, 'diproses', ''),
('SK-26403', 33, '2019-07-12', '2019-07-12', 'jual', 5.00, 'BTP', 0.00, 5000.00, 0.00, 'selesai', 'Bagus Sekali'),
('SK-27170', 30, '2019-07-03', '0000-00-00', 'jual', 500.00, 'hhhh', 0.00, 540000.00, 0.00, 'selesai', 'asd'),
('SK-30515', 33, '2019-07-04', '2019-07-04', 'jual', 50.00, 'YPT', 0.00, 75000.00, 0.00, 'selesai', '1111'),
('SK-31076', 30, '2019-07-03', '0000-00-00', 'jual', 900.00, 'ttt', 0.00, 580000.00, 0.00, 'selesai', ''),
('SK-31902', 33, '2019-07-08', '2019-07-08', 'jual', 20.00, 'SPAIN', 0.00, 20000.00, 0.00, 'selesai', 'MAntapu\r\n'),
('SK-35796', 12, '2019-05-12', '0000-00-00', 'jual', 10.00, '', 0.00, 1000.00, 0.00, 'reject', 'HMMM'),
('SK-38226', 30, '2019-07-02', '0000-00-00', 'jual', 12.00, '', 0.00, 24.00, 0.00, 'diproses', ''),
('SK-40166', 33, '2019-07-10', '2019-07-10', 'jual', 0.00, 'JKO', 10.00, 0.00, 0.00, 'reject', 'ss'),
('SK-40727', 30, '2019-07-03', '0000-00-00', 'jual', 1500.00, 'KLK', 0.00, 1000000.00, 0.00, 'selesai', ''),
('SK-45355', 30, '2019-07-03', '0000-00-00', 'jual', 1000.00, 'YPT', 0.00, 1000000.00, 2000.00, 'diproses', 'Minggu Sampai'),
('SK-47674', 33, '2019-07-20', '2019-07-20', 'jual', 246.00, 'DANONE', 0.00, 369000.00, 0.00, 'selesai', '1'),
('SK-47722', 30, '2019-07-02', '0000-00-00', 'jual', 12.00, '', 0.00, 24.00, 0.00, 'diproses', ''),
('SK-48622', 33, '2019-08-13', '2019-08-11', 'jual', 20.00, 'COC', 0.00, 600.00, 0.00, 'selesai', 'HABUL'),
('SK-48817', 30, '2019-07-03', '0000-00-00', 'jual', 500.00, 'ffff', 100.00, 50000.00, 0.00, 'selesai', ''),
('SK-50985', 12, '2019-05-13', '0000-00-00', 'jual', 40.00, '', 0.00, 4000.00, 0.00, 'selesai', 'Ke danone'),
('SK-51256', 33, '2019-07-10', '2019-07-10', 'jual', 12.30, 'YUI', 0.00, 123.00, 0.00, 'selesai', ''),
('SK-53791', 33, '2019-07-12', '2019-07-12', 'jual', 0.33, 'BTP', 0.00, 33.00, 0.00, 'selesai', ''),
('SK-55250', 32, '2019-07-04', '0000-00-00', 'jual', 12.00, 'HUJI 2', 0.00, 3400.00, 0.00, 'selesai', ''),
('SK-56383', 33, '2019-07-08', '2019-07-08', 'jual', 10.00, 'YUH', 0.00, 10000.00, 0.00, 'selesai', 'TYU'),
('SK-56845', 12, '2019-05-12', '2019-05-12', 'nonjual', 5.00, '', 0.00, 0.00, 0.00, 'selesai', 'Buat Kresek Belanja'),
('SK-59926', 12, '2019-05-12', '0000-00-00', 'jual', 60.00, '', 0.00, 6040.00, 0.00, 'diproses', 'ARR'),
('SK-60319', 32, '2019-07-04', '2019-07-04', 'jual', 1.00, 'RJET', 0.00, 2.00, 0.00, 'reject', ''),
('SK-61914', 30, '2019-07-03', '0000-00-00', 'jual', 600.00, 'BN', 0.00, 100000.00, 0.00, 'selesai', ''),
('SK-62719', 30, '2019-07-03', '0000-00-00', 'jual', 600.00, 'ffff', 0.00, 100000.00, 0.00, 'diproses', ''),
('SK-62806', 32, '2019-07-04', '0000-00-00', 'jual', 1.00, 'HUJI', 1.00, 50.00, 0.00, 'selesai', ''),
('SK-65505', 12, '2019-05-12', '0000-00-00', 'jual', 30.00, '', 0.00, 300.00, 0.00, 'diproses', ''),
('SK-65807', 32, '2019-07-04', '0000-00-00', 'jual', 1.00, 'hjj', 0.00, 3.00, 0.00, 'reject', ''),
('SK-67284', 30, '2019-07-03', '0000-00-00', 'jual', 700.00, 'ss', 0.00, 70000.00, 0.00, 'selesai', ''),
('SK-68836', 33, '2019-07-09', '2019-07-09', 'jual', 5.00, 'JUK', 0.00, 7500.00, 0.00, 'selesai', ''),
('SK-70358', 12, '2019-05-12', '0000-00-00', 'jual', 5.00, '', 5.00, 25.00, 0.00, 'diproses', 'AUUW'),
('SK-72027', 12, '2019-05-12', '0000-00-00', 'jual', 90.00, '', 0.00, 900.00, 0.00, 'diproses', 'xxx'),
('SK-72644', 33, '2019-07-12', '2019-07-12', 'jual', 10.00, 'GJG', 0.00, 5000.00, 0.00, 'selesai', 'BB'),
('SK-73013', 30, '2019-07-03', '0000-00-00', 'jual', 500.00, 'ghgh', 0.00, 0.00, 0.00, 'selesai', ''),
('SK-73409', 32, '2019-07-04', '0000-00-00', 'jual', 10.00, 'yt', 0.00, 70.00, 0.00, 'reject', ''),
('SK-74342', 12, '2019-05-12', '2019-05-12', 'jual', 40.00, '', 0.00, 10200.00, 0.00, 'selesai', 'Pak Robbi'),
('SK-75884', 33, '2019-07-20', '2019-07-20', 'jual', 0.00, 'TELKOm', 137.00, 0.00, 0.00, 'reject', 'qwerty'),
('SK-78441', 33, '2019-07-10', '2019-07-10', 'jual', 1.00, '3p', 12.00, 44.00, 0.00, 'selesai', ''),
('SK-79780', 12, '2019-05-12', '2019-05-12', 'jual', 8.00, '', 2.00, 3200.00, 0.00, 'selesai', 'Cak We'),
('SK-81068', 32, '2019-07-04', '0000-00-00', 'jual', 7.00, 'h', 0.00, 70.00, 0.00, 'selesai', ''),
('SK-81831', 12, '2019-05-12', '2019-05-12', 'jual', 30.00, '', 0.00, 3000.00, 0.00, 'selesai', 'ARU'),
('SK-82640', 33, '2019-07-12', '2019-07-12', 'jual', 0.00, 'PAK MIN', 20.00, 0.00, 0.00, 'selesai', 'BN'),
('SK-85056', 12, '2019-05-12', '0000-00-00', 'nonjual', 5.00, '', 5.00, 0.00, 0.00, 'selesai', 'Dapoer'),
('SK-85500', 30, '2019-07-03', '0000-00-00', 'jual', 1000.00, 'BTP', 0.00, 999500.00, 500.00, 'selesai', ''),
('SK-87895', 30, '2019-07-02', '0000-00-00', 'jual', 1000000.00, '', 0.00, 1000000.00, 0.00, 'diproses', ''),
('SK-89256', 33, '2019-07-11', '2019-07-11', 'jual', 12.00, 'BSB', 0.00, 1200.00, 0.00, 'selesai', ''),
('SK-92038', 12, '2019-05-12', '2019-05-12', 'jual', 2.00, '', 0.00, 200.00, 0.00, 'selesai', 'YEAY'),
('SK-97428', 30, '2019-07-03', '0000-00-00', 'jual', 1000.00, 'DANONE', 500.00, 580000.00, 20000.00, 'selesai', ''),
('SK-97590', 33, '2019-07-11', '2019-07-11', 'jual', 5.00, 'HJH', 5.00, 5000.00, 0.00, 'selesai', '');

-- --------------------------------------------------------

--
-- Table structure for table `sampahkeluar_detail`
--

CREATE TABLE `sampahkeluar_detail` (
  `id_sampahkeluar` varchar(11) NOT NULL,
  `id_kategorisampah` int(11) NOT NULL,
  `berat` float(8,2) NOT NULL,
  `berat_reject` float(8,2) NOT NULL,
  `harga_kg` float(8,2) NOT NULL,
  `sub_harga` float(8,2) NOT NULL,
  `status_terima` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampahkeluar_detail`
--

INSERT INTO `sampahkeluar_detail` (`id_sampahkeluar`, `id_kategorisampah`, `berat`, `berat_reject`, `harga_kg`, `sub_harga`, `status_terima`) VALUES
('SK-74342', 6, 20.00, 0.00, 500.00, 10000.00, 'terima'),
('SK-74342', 7, 20.00, 0.00, 10.00, 200.00, 'terima'),
('SK-56845', 6, 5.00, 0.00, 0.00, 0.00, 'terima'),
('SK-79780', 6, 8.00, 2.00, 400.00, 3200.00, 'terima'),
('SK-05865', 6, 20.00, 0.00, 100.00, 2000.00, 'terima'),
('SK-05865', 8, 30.00, 0.00, 10.00, 300.00, 'terima'),
('SK-92038', 6, 2.00, 0.00, 100.00, 200.00, 'terima'),
('SK-35796', 6, 10.00, 0.00, 100.00, 1000.00, 'reject'),
('SK-70358', 6, 0.00, 5.00, 100.00, 0.00, 'terima'),
('SK-70358', 8, 5.00, 0.00, 5.00, 25.00, 'reject'),
('SK-59926', 8, 40.00, 0.00, 1.00, 40.00, 'reject'),
('SK-59926', 7, 20.00, 0.00, 300.00, 6000.00, 'reject'),
('SK-13272', 6, 30.00, 0.00, 100.00, 3000.00, 'reject'),
('SK-65505', 6, 30.00, 0.00, 10.00, 300.00, 'reject'),
('SK-72027', 6, 90.00, 0.00, 10.00, 900.00, 'reject'),
('SK-13053', 6, 10.00, 10.00, 10.00, 100.00, 'terima'),
('SK-13053', 8, 30.00, 0.00, 600.00, 18000.00, 'terima'),
('SK-81831', 7, 30.00, 0.00, 100.00, 3000.00, 'terima'),
('SK-02951', 6, 100.00, 0.00, 4.00, 400.00, 'reject'),
('SK-02951', 7, 22.00, 0.00, 32.00, 704.00, 'reject'),
('SK-23227', 6, 7.00, 0.00, 10.00, 70.00, 'terima'),
('SK-85056', 7, 5.00, 5.00, 0.00, 0.00, 'terima'),
('SK-12153', 6, 1000.00, 0.00, 500.00, 500000.00, 'terima'),
('SK-12153', 7, 500.00, 0.00, 100.00, 50000.00, 'terima'),
('SK-50985', 6, 40.00, 0.00, 100.00, 4000.00, 'terima'),
('SK-87895', 18, 1000000.00, 0.00, 1000000.00, 1000000.00, 'belum terima'),
('SK-47722', 21, 12.00, 0.00, 2.00, 24.00, 'belum terima'),
('SK-14856', 27, 100.00, 0.00, 2000.00, 200000.00, 'belum terima'),
('SK-45355', 28, 1000.00, 0.00, 2500.00, 1000000.00, 'belum terima'),
('SK-85500', 28, 1000.00, 0.00, 1000.00, 1000000.00, 'terima'),
('SK-97428', 28, 800.00, 200.00, 500.00, 400000.00, 'terima'),
('SK-97428', 27, 200.00, 300.00, 1000.00, 200000.00, 'terima'),
('SK-67284', 28, 500.00, 0.00, 100.00, 50000.00, 'terima'),
('SK-67284', 27, 200.00, 0.00, 100.00, 20000.00, 'terima'),
('SK-31076', 27, 500.00, 0.00, 1000.00, 500000.00, 'terima'),
('SK-31076', 28, 400.00, 0.00, 200.00, 80000.00, 'reject'),
('SK-40727', 28, 1000.00, 0.00, 500.00, 500000.00, 'reject'),
('SK-40727', 27, 500.00, 0.00, 1000.00, 500000.00, 'terima'),
('SK-27170', 28, 100.00, 0.00, 5000.00, 500000.00, 'reject'),
('SK-27170', 27, 400.00, 0.00, 100.00, 40000.00, 'terima'),
('SK-73013', 28, 100.00, 0.00, 500.00, 50000.00, 'terima'),
('SK-73013', 27, 500.00, 0.00, 100.00, 50000.00, 'terima'),
('SK-61914', 27, 100.00, 0.00, 500.00, 50000.00, 'reject'),
('SK-61914', 28, 500.00, 0.00, 100.00, 50000.00, 'terima'),
('SK-19395', 28, 1000.00, 0.00, 500.00, 500000.00, 'reject'),
('SK-19395', 26, 500.00, 0.00, 1000.00, 500000.00, 'terima'),
('SK-48817', 27, 0.00, 100.00, 500.00, 0.00, 'reject'),
('SK-48817', 28, 500.00, 0.00, 100.00, 50000.00, 'terima'),
('SK-16746', 27, 0.00, 100.00, 500.00, 0.00, 'reject'),
('SK-16746', 28, 500.00, 0.00, 100.00, 50000.00, 'terima'),
('SK-62719', 27, 100.00, 0.00, 500.00, 50000.00, 'belum terima'),
('SK-62719', 28, 500.00, 0.00, 100.00, 50000.00, 'belum terima'),
('SK-23719', 29, 10.00, 0.00, 50.00, 500.00, 'belum terima'),
('SK-23719', 29, 40.00, 0.00, 60.00, 2400.00, 'belum terima'),
('SK-14869', 31, 10.00, 0.00, 500.00, 5000.00, 'terima'),
('SK-55250', 31, 2.00, 0.00, 200.00, 400.00, 'terima'),
('SK-55250', 32, 10.00, 0.00, 300.00, 3000.00, 'terima'),
('SK-62806', 31, 0.00, 1.00, 30.00, 0.00, 'reject'),
('SK-62806', 32, 1.00, 0.00, 50.00, 50.00, 'terima'),
('SK-18375', 32, 2.00, 0.00, 700.00, 1400.00, 'terima'),
('SK-73409', 32, 10.00, 0.00, 7.00, 70.00, 'belum terima'),
('SK-81068', 32, 7.00, 0.00, 10.00, 70.00, 'terima'),
('SK-65807', 31, 1.00, 0.00, 3.00, 3.00, 'belum terima'),
('SK-60319', 31, 1.00, 0.00, 2.00, 2.00, 'belum terima'),
('SK-14689', 31, 0.00, 2.00, 2.00, 0.00, 'reject'),
('SK-14689', 32, 1.00, 0.00, 1.00, 1.00, 'terima'),
('SK-12990', 31, 0.00, 1.00, 500.00, 0.00, 'reject'),
('SK-12990', 32, 0.00, 1.00, 500.00, 0.00, 'reject'),
('SK-30515', 33, 50.00, 0.00, 1500.00, 75000.00, 'terima'),
('SK-31902', 33, 20.00, 0.00, 1000.00, 20000.00, 'terima'),
('SK-56383', 33, 10.00, 0.00, 1000.00, 10000.00, 'terima'),
('SK-68836', 37, 5.00, 0.00, 1500.00, 7500.00, 'terima'),
('SK-51256', 42, 12.30, 0.00, 10.00, 123.00, 'terima'),
('SK-78441', 42, 0.00, 12.00, 12.30, 0.00, 'reject'),
('SK-78441', 40, 1.00, 0.00, 44.00, 44.00, 'terima'),
('SK-40166', 40, 0.00, 10.00, 100.00, 0.00, 'reject'),
('SK-89256', 33, 12.00, 0.00, 100.00, 1200.00, 'terima'),
('SK-97590', 40, 5.00, 5.00, 1000.00, 5000.00, 'terima'),
('SK-17486', 40, 0.00, 1.40, 100.00, 0.00, 'reject'),
('SK-53791', 33, 0.33, 0.00, 100.00, 33.00, 'terima'),
('SK-72644', 43, 10.00, 0.00, 500.00, 5000.00, 'terima'),
('SK-82640', 43, 0.00, 20.00, 1000.00, 0.00, 'reject'),
('SK-26403', 44, 5.00, 0.00, 1000.00, 5000.00, 'terima'),
('SK-47674', 33, 123.00, 0.00, 1000.00, 123000.00, 'terima'),
('SK-47674', 34, 123.00, 0.00, 2000.00, 246000.00, 'terima'),
('SK-75884', 33, 0.00, 13.00, 100.00, 0.00, 'reject'),
('SK-75884', 34, 0.00, 124.00, 1000.00, 0.00, 'reject'),
('SK-12251', 33, 100.00, 0.00, 12000.00, 1000000.00, 'terima'),
('SK-48622', 33, 20.00, 0.00, 30.00, 600.00, 'terima');

-- --------------------------------------------------------

--
-- Table structure for table `sampah_masuk`
--

CREATE TABLE `sampah_masuk` (
  `id_sampahmasuk` varchar(20) NOT NULL,
  `jenis_sampahmasuk` varchar(20) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `asal_sampahmasuk` text NOT NULL,
  `harga_sampahmasuk` float(8,2) NOT NULL,
  `total_beratsm` float(8,2) NOT NULL,
  `totalb_rejectsm` float(8,2) NOT NULL,
  `totalb_residusm` float(8,2) NOT NULL,
  `total_hargasm` float(8,2) NOT NULL,
  `tgl_sampahmasukin` datetime NOT NULL,
  `tgl_sampahmasuks` datetime NOT NULL,
  `biaya_sampahmasuk` float(8,2) NOT NULL,
  `status_sampahmasuk` varchar(15) NOT NULL,
  `keterangan_sampahmasuk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sampah_mutasi`
--

CREATE TABLE `sampah_mutasi` (
  `id_mutasi` int(11) NOT NULL,
  `kode_mutasi` varchar(5) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `tgl_mutasi` date NOT NULL,
  `idkatsam_mutasi` int(20) NOT NULL,
  `idkatsam_dimutasi` int(20) NOT NULL,
  `berat_kg` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampah_mutasi`
--

INSERT INTO `sampah_mutasi` (`id_mutasi`, `kode_mutasi`, `id_banksampah`, `tgl_mutasi`, `idkatsam_mutasi`, `idkatsam_dimutasi`, `berat_kg`) VALUES
(46, 'M-262', 33, '2019-07-10', 33, 34, 3.00),
(47, 'M-340', 33, '2019-07-10', 33, 34, 20.00),
(48, 'M-737', 33, '2019-07-10', 34, 33, 10.00),
(49, 'M-574', 33, '2019-07-10', 41, 33, 1.00),
(50, 'M-237', 33, '2019-07-10', 33, 37, 5.00),
(51, 'M-510', 33, '2019-07-10', 41, 39, 3.30),
(52, 'M-754', 33, '2019-07-10', 42, 40, 7.00),
(53, 'M-591', 33, '2019-07-11', 42, 33, 12.30),
(54, 'M-222', 33, '2019-07-12', 44, 44, 40.00),
(55, 'M-809', 33, '2019-07-12', 42, 36, 10.00),
(56, 'M-500', 33, '2019-07-12', 44, 33, 100.00),
(57, 'M-503', 33, '2019-07-20', 33, 34, 5.00),
(58, 'M-782', 33, '2019-08-06', 33, 35, 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `sampah_residu`
--

CREATE TABLE `sampah_residu` (
  `id_residu` int(11) NOT NULL,
  `kode_residu` varchar(5) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `tgl_residu` date NOT NULL,
  `id_kategorisampah` int(20) NOT NULL,
  `berat_residu` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampah_residu`
--

INSERT INTO `sampah_residu` (`id_residu`, `kode_residu`, `id_banksampah`, `tgl_residu`, `id_kategorisampah`, `berat_residu`) VALUES
(1, 'R-257', 33, '2019-07-10', 41, 0.90),
(2, 'R-453', 33, '2019-07-10', 37, 0.40),
(3, 'R-444', 33, '2019-07-10', 33, 5.00),
(4, 'R-900', 33, '2019-07-10', 35, 50.00),
(5, 'R-015', 33, '2019-07-10', 42, 0.30),
(6, 'R-941', 33, '2019-07-11', 33, 0.50),
(7, 'R-547', 33, '2019-07-11', 42, 5.00),
(8, 'R-927', 33, '2019-07-11', 39, 10.00),
(9, 'R-484', 33, '2019-07-12', 41, 5.00),
(10, 'R-376', 33, '2019-07-12', 44, 10.00),
(11, 'R-630', 33, '2019-07-12', 44, 0.10);

-- --------------------------------------------------------

--
-- Table structure for table `setoran`
--

CREATE TABLE `setoran` (
  `id_setoran` varchar(20) NOT NULL,
  `jenis_setoran` varchar(10) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `total_berat` float(8,2) NOT NULL,
  `totalb_reject` float(8,2) NOT NULL,
  `totalb_residu` float(8,2) NOT NULL,
  `total_harga` float(8,2) NOT NULL,
  `tgl_setorin` date NOT NULL,
  `tgl_setordone` date NOT NULL,
  `biaya_setoran` float(8,2) NOT NULL,
  `status_setoran` varchar(15) NOT NULL,
  `keterangan_setoran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setoran`
--

INSERT INTO `setoran` (`id_setoran`, `jenis_setoran`, `id_banksampah`, `id_nasabah`, `total_berat`, `totalb_reject`, `totalb_residu`, `total_harga`, `tgl_setorin`, `tgl_setordone`, `biaya_setoran`, `status_setoran`, `keterangan_setoran`) VALUES
('S-00516', 'beli', 33, NULL, 12.00, 0.00, 0.00, 12000.00, '2019-07-20', '2019-07-20', 0.00, 'selesai', 'BHJ'),
('S-00750', 'beli', 33, 32, 122.33, 0.00, 0.00, 122330.00, '2019-07-12', '2019-07-12', 0.00, 'selesai', 'MRT'),
('S-03567', 'beli', 32, NULL, 20.00, 0.00, 0.00, 20000.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', 'Bagus'),
('S-03805', 'hibah', 33, 34, 1000.00, 0.00, 0.00, -1000.00, '2019-07-23', '2019-07-23', 1000.00, 'selesai', 'Punya abang mapress'),
('S-04156', 'beli', 30, 27, 0.00, 0.00, 0.00, 0.00, '2019-07-01', '2019-07-02', 0.00, 'reject', 'uuu'),
('S-04355', 'hibah', 12, NULL, 3.00, 0.00, 0.00, 0.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', ''),
('S-04383', 'beli', 30, 27, 2496.00, 0.00, 0.00, 0.00, '2019-07-01', '2019-07-02', 0.00, 'selesai', ''),
('S-05837', 'beli', 32, NULL, 10.00, 0.00, 0.00, 10000.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', ''),
('S-05964', 'beli', 30, 27, 44.00, 0.00, 0.00, 0.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', 'Azza'),
('S-06014', 'beli', 30, NULL, 10.00, 0.00, 0.00, 1440.00, '2019-07-02', '2019-07-02', 1000.00, 'selesai', '2'),
('S-08508', 'beli', 30, NULL, 12.50, 0.00, 0.00, 1800.00, '2019-07-02', '0000-00-00', 0.00, 'diproses', 'XXX'),
('S-09224', 'beli', 30, NULL, 0.70, 0.00, 0.00, 350.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', ''),
('S-09460', 'beli', 30, 27, 10.00, 0.00, 0.00, 5000.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', 'ooo'),
('S-09464', 'beli', 33, 30, 1000.00, 0.00, 0.00, 1000000.00, '2019-08-11', '2019-08-11', 0.00, 'selesai', 'Habil\r\n'),
('S-10088', 'beli', 30, NULL, 10.00, 0.00, 0.00, 10000.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', ''),
('S-12020', 'hibah', 12, NULL, 50.00, 0.00, 0.00, 0.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', 'FUFU'),
('S-12186', 'beli', 30, NULL, 2.00, 0.00, 0.00, 2.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', 'cccc'),
('S-12453', 'beli', 33, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-09', '2019-05-01', 0.00, 'reject', 'UTU'),
('S-13212', 'beli', 30, 27, 10.00, 0.00, 0.00, 0.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', ''),
('S-13692', 'beli', 33, 30, 12.00, 0.00, 0.00, 12000.00, '2019-07-11', '2019-05-01', 0.00, 'selesai', 'OKE'),
('S-15616', 'beli', 12, NULL, 30.00, 0.00, 0.00, 10200.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', 'Pak Wawa'),
('S-16293', 'beli', 33, 31, 10.00, 0.00, 0.00, 1000.00, '2019-07-10', '2019-05-03', 0.00, 'selesai', 'Pak Acik'),
('S-16392', 'beli', 33, NULL, 12.00, 0.00, 0.00, 12000.00, '2019-07-11', '2019-05-01', 0.00, 'selesai', 'KE BSB'),
('S-16551', 'beli', 30, NULL, 1.00, 0.00, 0.00, 0.00, '2019-07-01', '2019-05-21', 0.00, 'selesai', 'q'),
('S-18674', 'beli', 33, 30, 20.00, 0.00, 0.00, 6000.00, '2019-07-09', '2019-06-12', 0.00, 'selesai', 'PA'),
('S-18714', 'beli', 32, NULL, 10.00, 0.00, 0.00, 3000.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', 'n'),
('S-19919', 'beli', 30, 27, 30.00, 0.00, 0.00, 0.00, '2019-07-01', '0000-00-00', 1000.00, 'diproses', 's'),
('S-21053', 'beli', 30, 27, 55.00, 0.00, 0.00, 10384.00, '2019-07-01', '2019-07-01', 100.00, 'selesai', 'sdf'),
('S-21302', 'beli', 30, NULL, 89.00, 1.00, 0.00, 44500.00, '2019-06-28', '0000-00-00', 0.00, 'diproses', ''),
('S-23534', 'beli', 30, NULL, 1.50, 0.00, 0.00, 2250.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', ''),
('S-24139', 'beli', 31, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-04', '2019-07-04', 0.00, 'reject', ''),
('S-24949', 'beli', 33, NULL, 10.44, 0.00, 0.00, 1044.00, '2019-07-09', '2019-03-01', 0.00, 'selesai', 'JKL'),
('S-26096', 'hibah', 30, 27, 20.00, 0.00, 0.00, -3000.00, '2019-07-01', '2019-07-01', 3000.00, 'selesai', 'asf'),
('S-29834', 'beli', 30, NULL, 1.30, 0.00, 0.00, -350.00, '2019-07-01', '0000-00-00', 1000.00, 'diproses', 'qwerty'),
('S-30180', 'beli', 30, NULL, 100.00, 0.00, 0.00, 14400.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', 'dddd'),
('S-31415', 'beli', 30, NULL, 2.00, 0.00, 0.00, 1000.00, '2019-07-03', '0000-00-00', 0.00, 'diproses', ''),
('S-34182', 'beli', 33, NULL, 10.00, 0.00, 0.00, 10000.00, '2019-07-05', '2019-05-01', 0.00, 'diproses', ''),
('S-34292', 'beli', 30, NULL, 1.00, 0.00, 0.00, 0.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', ''),
('S-34835', 'beli', 12, NULL, 50.00, 0.00, 0.00, 50000.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', 'Duno'),
('S-35468', 'hibah', 30, 27, 267.00, 0.00, 0.00, 0.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', 'Tahee'),
('S-37541', 'beli', 30, NULL, 5.00, 5.00, 0.00, 7500.00, '2019-07-01', '2019-07-01', 1500.00, 'selesai', 'zxcvbn'),
('S-39591', 'beli', 32, NULL, 20.00, 0.00, 0.00, 13000.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', ''),
('S-39737', 'beli', 33, 30, 13.00, 0.00, 0.00, 13000.00, '2019-07-20', '2019-07-20', 0.00, 'selesai', 'GHJK'),
('S-40455', 'beli', 30, NULL, 1.00, 0.00, 0.00, 500.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', ''),
('S-41539', 'beli', 30, NULL, 100.00, 0.00, 0.00, 14400.00, '2019-07-01', '0000-00-00', 10.00, 'diproses', 'www'),
('S-41643', 'beli', 30, NULL, 1.00, 0.00, 0.00, 500.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', ''),
('S-42133', 'beli', 33, NULL, 20.00, 0.00, 0.00, 20000.00, '2019-07-05', '2019-05-01', 0.00, 'selesai', 'nmb'),
('S-42580', 'beli', 33, 32, 10.00, 0.00, 0.00, 4000.00, '2019-07-12', '2019-07-12', 1000.00, 'selesai', 'ERTY'),
('S-43437', 'lainnya', 12, NULL, 50.00, 0.00, 0.00, 0.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', 'Kamal'),
('S-44589', 'beli', 31, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-04', '2019-07-04', 0.00, 'reject', 'hh'),
('S-44877', 'beli', 31, 28, 30.00, 0.00, 0.00, 2500.00, '2019-07-04', '2019-07-04', 500.00, 'selesai', 'Pak Karo'),
('S-46013', 'beli', 30, NULL, 777.00, 0.00, 0.00, 0.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', ''),
('S-47426', 'beli', 33, 31, 33.22, 0.00, 0.00, 3322.00, '2019-07-10', '2019-05-01', 0.00, 'selesai', 'KLO'),
('S-47630', 'beli', 12, NULL, 10.00, 10.00, 0.00, 5000.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', ''),
('S-48713', 'beli', 30, NULL, 10.00, 0.00, 0.00, 5000.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', ''),
('S-49201', 'beli', 31, 28, 130.00, 0.00, 0.00, 13000.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', 'hhh'),
('S-50120', 'beli', 33, 30, 4000.00, 0.00, 0.00, 1000000.00, '2019-08-14', '2019-08-11', 0.00, 'selesai', 'HABEEEL'),
('S-52490', 'beli', 30, 27, 11.00, 0.00, 0.00, 5500.00, '2019-06-28', '2019-07-01', 0.00, 'selesai', ''),
('S-53880', 'beli', 30, 27, 1.00, 0.00, 0.00, 500.00, '2019-07-01', '0000-00-00', 10.00, 'diproses', 'hhhhh'),
('S-54655', 'lainnya', 12, NULL, 40.00, 0.00, 0.00, 0.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', 'YUHU'),
('S-55377', 'beli', 12, NULL, 10.00, 0.00, 0.00, 10000.00, '2019-05-12', '2019-05-12', 0.00, 'reject', ''),
('S-55379', 'beli', 33, 35, 10.00, 0.00, 0.00, 1000.00, '2019-07-24', '2019-07-24', 0.00, 'selesai', 'Dari ristek'),
('S-57049', 'beli', 31, NULL, 10.00, 0.00, 0.00, 1000.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', 'n'),
('S-58228', 'beli', 31, 29, 40.00, 0.00, 0.00, 4000.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', 'asdfgh'),
('S-58550', 'hibah', 32, NULL, 10.00, 0.00, 0.00, 0.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', 'Hibah 1'),
('S-62394', 'lainnya', 30, NULL, 123.00, 0.00, 0.00, 0.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', ''),
('S-62548', 'beli', 30, NULL, 1.00, 0.00, 0.00, 750.50, '2019-07-01', '0000-00-00', 0.00, 'diproses', 'xxx'),
('S-62728', 'hibah', 33, NULL, 100.00, 0.00, 0.00, 0.00, '2019-07-04', '2019-05-01', 0.00, 'selesai', '123'),
('S-63746', 'beli', 33, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-10', '2019-05-01', 0.00, 'reject', 'ERT'),
('S-66316', 'hibah', 12, NULL, 20.00, 0.00, 0.00, 0.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', 'Bu Wawa'),
('S-66556', 'beli', 12, NULL, 10.00, 0.00, 0.00, 10000.00, '2019-05-20', '2019-05-20', 0.00, 'selesai', 'PAk RT'),
('S-67014', 'beli', 30, NULL, 1.00, 0.00, 0.00, 0.00, '2019-07-01', '0000-00-00', 0.00, 'diproses', 'axasax'),
('S-69400', 'hibah', 33, NULL, 10.00, 0.00, 0.00, 0.00, '2019-07-12', '2019-07-12', 0.00, 'selesai', '1000'),
('S-70759', 'beli', 33, NULL, 20.00, 0.00, 0.00, 20000.00, '2019-07-09', '2019-05-01', 0.00, 'selesai', 'XOXO'),
('S-71768', 'beli', 30, NULL, 10.00, 0.00, 0.00, 1110.00, '2019-07-02', '0000-00-00', 1000.00, 'diproses', 'GGG'),
('S-74742', 'beli', 33, NULL, 10.00, 0.00, 0.00, 12000.00, '2019-07-04', '2019-05-01', 0.00, 'selesai', '1234'),
('S-76785', 'beli', 32, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-04', '2019-07-04', 0.00, 'reject', ''),
('S-77008', 'beli', 30, NULL, 2.00, 0.00, 0.00, 288.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', 'kkk'),
('S-77176', 'beli', 31, 29, 0.00, 0.00, 0.00, -1500.00, '2019-07-04', '2019-07-04', 1500.00, 'reject', 'Pak O'),
('S-80891', 'beli', 33, 30, 12.00, 0.00, 0.00, 14400.00, '2019-07-10', '2019-05-01', 0.00, 'diproses', 'PKL'),
('S-81306', 'beli', 30, NULL, 10.00, 0.00, 0.00, 440.00, '2019-07-02', '2019-07-02', 1000.00, 'selesai', 'bbbbbb'),
('S-81440', 'beli', 33, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-20', '2019-07-20', 0.00, 'reject', 'fghjk'),
('S-82494', 'beli', 33, 30, 10.30, 0.00, 0.00, 3090.00, '2019-07-09', '2019-05-01', 0.00, 'selesai', 'KLO'),
('S-83746', 'beli', 12, NULL, 105.00, 0.00, 0.00, 102500.00, '2019-05-13', '2019-05-13', 0.00, 'selesai', 'Sudah selesai, wran merah plastiknya'),
('S-84093', 'beli', 30, NULL, 12.00, 0.00, 0.00, 4000.00, '2019-07-03', '2019-07-03', 2000.00, 'selesai', 'PET'),
('S-84687', 'beli', 33, NULL, 10.00, 0.00, 0.00, 5000.00, '2019-07-06', '2019-05-01', 0.00, 'selesai', 'PO'),
('S-84854', 'beli', 30, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-03', '2019-07-03', 0.00, 'reject', 'LOP'),
('S-85062', 'lainnya', 33, NULL, 12.00, 0.00, 0.00, 0.00, '2019-07-11', '2019-05-01', 0.00, 'selesai', 'RETUR'),
('S-85269', 'beli', 12, NULL, 410.00, 0.00, 40.00, 210000.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', 'gy'),
('S-85514', 'hibah', 33, NULL, 10.00, 0.00, 0.00, 0.00, '2019-07-10', '2019-05-01', 0.00, 'selesai', 'HJO'),
('S-86816', 'hibah', 12, NULL, 700.00, 0.00, 0.00, 0.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', ''),
('S-87919', 'beli', 31, 29, 600.00, 0.00, 0.00, 759800.00, '2019-07-04', '2019-07-04', 200.00, 'selesai', 'Pak Le'),
('S-91338', 'beli', 33, 30, 100.00, 0.00, 0.00, 99000.00, '2019-08-13', '0000-00-00', 1000.00, 'diproses', 'Buset'),
('S-91431', 'lainnya', 33, NULL, 10.00, 0.00, 0.00, 0.00, '2019-07-12', '2019-07-12', 0.00, 'selesai', 'hhhhhh'),
('S-93757', 'lainnya', 12, NULL, 97.00, 0.00, 3.00, 0.00, '2019-05-12', '2019-05-12', 0.00, 'selesai', 'retur'),
('S-94323', 'beli', 30, NULL, 10.00, 0.00, 0.00, 1440.00, '2019-07-02', '2019-07-02', 2.00, 'selesai', 'hhhhhh'),
('S-95363', 'lainnya', 32, NULL, 1.00, 0.00, 0.00, 0.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', ''),
('S-95887', 'beli', 30, NULL, 1.00, 0.00, 0.00, 0.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', ''),
('S-95889', 'beli', 31, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-04', '2019-07-04', 0.00, 'reject', 'df'),
('S-98230', 'beli', 33, NULL, 0.00, 0.00, 0.00, 0.00, '2019-07-10', '2019-05-01', 0.00, 'reject', 'JKOP'),
('S-98256', 'beli', 32, NULL, 10.00, 0.00, 0.00, 3000.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', ''),
('S-98300', 'beli', 30, NULL, 123.00, 0.00, 0.00, 0.00, '2019-07-01', '2019-07-01', 0.00, 'selesai', '1'),
('S-99118', 'beli', 30, NULL, 10.00, 0.00, 0.00, 1440.00, '2019-07-02', '2019-07-02', 0.00, 'selesai', '1'),
('S-99997', 'hibah', 32, NULL, 10.00, 0.00, 0.00, 0.00, '2019-07-04', '2019-07-04', 0.00, 'selesai', '');

-- --------------------------------------------------------

--
-- Table structure for table `setoran_detail`
--

CREATE TABLE `setoran_detail` (
  `id_setoran` varchar(20) NOT NULL,
  `id_kategorisampah` int(11) NOT NULL,
  `berat` float(8,2) NOT NULL,
  `beratsetoran_reject` float(8,2) NOT NULL,
  `berat_residu` float(8,2) NOT NULL,
  `sub_harga` float(8,2) NOT NULL,
  `status_sampah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setoran_detail`
--

INSERT INTO `setoran_detail` (`id_setoran`, `id_kategorisampah`, `berat`, `beratsetoran_reject`, `berat_residu`, `sub_harga`, `status_sampah`) VALUES
('S-15616', 6, 10.00, 0.00, 0.00, 10000.00, 'selesai'),
('S-15616', 7, 20.00, 0.00, 0.00, 200.00, 'selesai'),
('S-66316', 6, 20.00, 0.00, 0.00, 0.00, 'selesai'),
('S-43437', 6, 50.00, 0.00, 0.00, 0.00, 'selesai'),
('S-34835', 6, 50.00, 0.00, 0.00, 50000.00, 'selesai'),
('S-12020', 8, 50.00, 0.00, 0.00, 0.00, 'selesai'),
('S-54655', 8, 40.00, 0.00, 0.00, 0.00, 'selesai'),
('S-55377', 6, 10.00, 0.00, 0.00, 10000.00, 'reject'),
('S-04355', 6, 3.00, 0.00, 0.00, 0.00, 'selesai'),
('S-47630', 8, 10.00, 10.00, 0.00, 5000.00, 'selesai'),
('S-85269', 6, 10.00, 0.00, 40.00, 10000.00, 'selesai'),
('S-85269', 8, 400.00, 0.00, 0.00, 200000.00, 'selesai'),
('S-93757', 7, 97.00, 0.00, 3.00, 0.00, 'selesai'),
('S-86816', 6, 700.00, 0.00, 0.00, 0.00, 'selesai'),
('S-83746', 6, 100.00, 0.00, 0.00, 100000.00, 'selesai'),
('S-83746', 8, 5.00, 0.00, 0.00, 2500.00, 'selesai'),
('S-66556', 10, 10.00, 0.00, 0.00, 10000.00, 'selesai'),
('S-52490', 18, 10.00, 0.00, 0.00, 5000.00, 'belum selesai'),
('S-09460', 18, 10.00, 0.00, 0.00, 5000.00, 'selesai'),
('S-62394', 20, 123.00, 0.00, 0.00, 0.00, 'belum selesai'),
('S-13212', 18, 10.00, 0.00, 0.00, 0.00, 'selesai'),
('S-98300', 18, 123.00, 0.00, 0.00, 0.00, 'selesai'),
('S-04383', 18, 4.00, 0.00, 0.00, 0.00, 'selesai'),
('S-04383', 20, 1244.00, 0.00, 0.00, 0.00, 'selesai'),
('S-34292', 18, 1.00, 0.00, 0.00, 0.00, 'belum selesai'),
('S-67014', 18, 1.00, 0.00, 0.00, 0.00, 'belum selesai'),
('S-16551', 18, 1.00, 0.00, 0.00, 0.00, 'selesai'),
('S-23534', 18, 1.50, 0.00, 0.00, 2250.00, 'belum selesai'),
('S-62548', 18, 0.50, 0.00, 0.00, 750.00, 'belum selesai'),
('S-62548', 20, 0.50, 0.00, 0.00, 0.50, 'belum selesai'),
('S-10088', 18, 10.00, 0.00, 0.00, 15000.00, 'belum selesai'),
('S-37541', 18, 10.00, 0.00, 0.00, 15000.00, 'belum selesai'),
('S-09224', 21, 0.70, 0.00, 0.00, 350.00, 'selesai'),
('S-29834', 21, 1.30, 0.00, 0.00, 650.00, 'belum selesai'),
('S-26096', 20, 20.00, 0.00, 0.00, 0.00, 'selesai'),
('S-19919', 18, 30.00, 0.00, 0.00, 0.00, 'belum selesai'),
('S-05964', 22, 10.00, 0.00, 0.00, 1000.00, 'belum selesai'),
('S-05964', 22, 12.00, 0.00, 0.00, 1200.00, 'selesai'),
('S-05964', 22, 10.00, 0.00, 0.00, 0.00, 'selesai'),
('S-05964', 22, 12.00, 0.00, 0.00, 0.00, 'selesai'),
('S-04383', 18, 4.00, 0.00, 0.00, 0.00, 'selesai'),
('S-04383', 20, 1244.00, 0.00, 0.00, 0.00, 'selesai'),
('S-12186', 25, 2.00, 0.00, 0.00, 2.00, 'selesai'),
('S-77008', 27, 2.00, 0.00, 0.00, 288.00, 'selesai'),
('S-04156', 27, 12.00, 0.00, 0.00, 1728.00, 'reject'),
('S-35468', 27, 100.00, 0.00, 0.00, 0.00, 'selesai'),
('S-35468', 26, 123.00, 0.00, 0.00, 0.00, 'selesai'),
('S-35468', 21, 44.00, 0.00, 0.00, 0.00, 'reject'),
('S-21053', 21, 11.00, 0.00, 0.00, 5500.00, 'selesai'),
('S-21053', 26, 44.00, 0.00, 0.00, 4884.00, 'selesai'),
('S-53880', 21, 1.00, 0.00, 0.00, 500.00, 'selesai'),
('S-53880', 27, 3.00, 0.00, 0.00, 432.00, 'reject'),
('S-30180', 27, 100.00, 0.00, 0.00, 14400.00, 'belum selesai'),
('S-41539', 27, 100.00, 0.00, 0.00, 14400.00, 'belum selesai'),
('S-08508', 27, 12.50, 0.00, 0.00, 1800.00, 'selesai'),
('S-71768', 26, 10.00, 0.00, 0.00, 1110.00, 'belum selesai'),
('S-99118', 27, 10.00, 0.00, 0.00, 1440.00, 'selesai'),
('S-06014', 27, 10.00, 0.00, 0.00, 1440.00, 'selesai'),
('S-94323', 27, 10.00, 0.00, 0.00, 1440.00, 'selesai'),
('S-81306', 27, 10.00, 0.00, 0.00, 1440.00, 'selesai'),
('S-31415', 28, 2.00, 0.00, 0.00, 1000.00, 'belum selesai'),
('S-84093', 28, 12.00, 0.00, 0.00, 6000.00, 'selesai'),
('S-84854', 27, 90.00, 0.00, 0.00, 12960.00, 'reject'),
('S-44877', 29, 30.00, 0.00, 0.00, 3000.00, 'selesai'),
('S-77176', 29, 30.00, 0.00, 0.00, 3000.00, 'reject'),
('S-77176', 30, 50.00, 0.00, 0.00, 75000.00, 'reject'),
('S-87919', 29, 100.00, 0.00, 0.00, 10000.00, 'selesai'),
('S-87919', 30, 500.00, 0.00, 0.00, 750000.00, 'selesai'),
('S-24139', 29, 10.00, 0.00, 0.00, 1000.00, 'reject'),
('S-95889', 29, 100.00, 0.00, 0.00, 10000.00, 'reject'),
('S-95889', 29, 100.00, 0.00, 0.00, 10000.00, 'reject'),
('S-95889', 30, 100.00, 0.00, 0.00, 150000.00, 'reject'),
('S-44589', 30, 50.00, 0.00, 0.00, 75000.00, 'reject'),
('S-49201', 29, 30.00, 0.00, 0.00, 3000.00, 'selesai'),
('S-49201', 29, 30.00, 0.00, 0.00, 3000.00, 'selesai'),
('S-57049', 29, 10.00, 0.00, 0.00, 1000.00, 'selesai'),
('S-57049', 30, 50.00, 0.00, 0.00, 75000.00, 'reject'),
('S-58228', 29, 30.00, 0.00, 0.00, 3000.00, 'selesai'),
('S-58228', 29, 30.00, 0.00, 0.00, 3000.00, 'selesai'),
('S-03567', 31, 20.00, 0.00, 0.00, 20000.00, 'selesai'),
('S-39591', 31, 10.00, 0.00, 0.00, 10000.00, 'selesai'),
('S-39591', 32, 10.00, 0.00, 0.00, 3000.00, 'selesai'),
('S-18714', 31, 10.00, 0.00, 0.00, 10000.00, 'reject'),
('S-18714', 32, 10.00, 0.00, 0.00, 3000.00, 'selesai'),
('S-58550', 31, 10.00, 0.00, 0.00, 0.00, 'selesai'),
('S-95363', 31, 1.00, 0.00, 0.00, 0.00, 'selesai'),
('S-99997', 32, 10.00, 0.00, 0.00, 0.00, 'selesai'),
('S-76785', 31, 5.00, 0.00, 0.00, 5000.00, 'reject'),
('S-05837', 31, 10.00, 0.00, 0.00, 10000.00, 'selesai'),
('S-05837', 32, 30.00, 0.00, 0.00, 9000.00, 'reject'),
('S-98256', 32, 10.00, 0.00, 0.00, 3000.00, 'selesai'),
('S-98256', 31, 10.00, 0.00, 0.00, 10000.00, 'reject'),
('S-62728', 33, 100.00, 0.00, 0.00, 0.00, 'selesai'),
('S-74742', 33, 20.00, 0.00, 0.00, 20000.00, 'reject'),
('S-74742', 34, 10.00, 0.00, 0.00, 12000.00, 'selesai'),
('S-34182', 33, 10.00, 0.00, 0.00, 10000.00, 'belum selesai'),
('S-42133', 33, 20.00, 0.00, 0.00, 20000.00, 'selesai'),
('S-84687', 38, 10.00, 0.00, 0.00, 5000.00, 'selesai'),
('S-70759', 40, 20.00, 0.00, 0.00, 20000.00, 'selesai'),
('S-18674', 33, 10.00, 0.00, 0.00, 10000.00, 'reject'),
('S-18674', 37, 20.00, 0.00, 0.00, 6000.00, 'selesai'),
('S-82494', 37, 10.30, 0.00, 0.00, 3090.00, 'selesai'),
('S-24949', 39, 10.44, 0.00, 0.00, 1044.00, 'selesai'),
('S-12453', 37, 20.00, 0.00, 0.00, 6000.00, 'reject'),
('S-16293', 42, 10.00, 0.00, 0.00, 1000.00, 'selesai'),
('S-80891', 42, 100.00, 0.00, 0.00, 10000.00, 'reject'),
('S-80891', 34, 12.00, 0.00, 0.00, 14400.00, 'belum selesai'),
('S-47426', 35, 1.22, 0.00, 0.00, 122.00, 'selesai'),
('S-47426', 42, 32.00, 0.00, 0.00, 3200.00, 'selesai'),
('S-98230', 39, 1.00, 0.00, 0.00, 100.00, 'reject'),
('S-98230', 42, 2.00, 0.00, 0.00, 200.00, 'reject'),
('S-85514', 40, 1.45, 0.00, 0.00, 0.00, 'reject'),
('S-85514', 42, 10.00, 0.00, 0.00, 0.00, 'selesai'),
('S-63746', 42, 12.00, 0.00, 0.00, 1200.00, 'reject'),
('S-63746', 40, 13.00, 0.00, 0.00, 13000.00, 'reject'),
('S-16392', 33, 12.00, 0.00, 0.00, 12000.00, 'selesai'),
('S-13692', 33, 12.00, 0.00, 0.00, 12000.00, 'selesai'),
('S-85062', 42, 12.00, 0.00, 0.00, 0.00, 'selesai'),
('S-00750', 43, 122.00, 0.00, 0.00, 122000.00, 'selesai'),
('S-00750', 33, 0.33, 0.00, 0.00, 330.00, 'selesai'),
('S-69400', 33, 10.00, 0.00, 0.00, 0.00, 'reject'),
('S-69400', 43, 10.00, 0.00, 0.00, 0.00, 'selesai'),
('S-42580', 44, 10.00, 0.00, 0.00, 5000.00, 'selesai'),
('S-91431', 33, 10.00, 0.00, 0.00, 0.00, 'selesai'),
('S-00516', 33, 12.00, 0.00, 0.00, 12000.00, 'selesai'),
('S-00516', 35, 113.00, 0.00, 0.00, 11300.00, 'reject'),
('S-39737', 33, 13.00, 0.00, 0.00, 13000.00, 'selesai'),
('S-39737', 41, 13.00, 0.00, 0.00, 1560.00, 'reject'),
('S-81440', 33, 1000.00, 0.00, 0.00, 1000000.00, 'reject'),
('S-81440', 35, 4000.00, 0.00, 0.00, 400000.00, 'reject'),
('S-03805', 33, 1000.00, 0.00, 0.00, 0.00, 'selesai'),
('S-55379', 35, 10.00, 0.00, 0.00, 1000.00, 'selesai'),
('S-09464', 33, 1000.00, 0.00, 0.00, 1000000.00, 'selesai'),
('S-50120', 33, 4000.00, 0.00, 0.00, 1000000.00, 'selesai'),
('S-91338', 33, 100.00, 0.00, 0.00, 100000.00, 'belum selesai');

-- --------------------------------------------------------

--
-- Table structure for table `setoran_detailj`
--

CREATE TABLE `setoran_detailj` (
  `id_setoranj` varchar(20) NOT NULL,
  `id_kategorisampah` int(11) NOT NULL,
  `berat_detailp` float(8,2) NOT NULL,
  `berat_detaila` float(8,2) NOT NULL,
  `berat_rejectj` float(8,2) NOT NULL,
  `berat_residuj` float(8,2) NOT NULL,
  `sub_hargaj` float(8,2) NOT NULL,
  `status_sampahj` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setoran_jemput`
--

CREATE TABLE `setoran_jemput` (
  `id_setoranj` varchar(20) NOT NULL,
  `jenis_setoranj` varchar(20) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `total_beratp` float(8,2) NOT NULL,
  `total_berata` float(8,2) NOT NULL,
  `totalb_rejectj` float(8,2) NOT NULL,
  `totalb_residuj` float(8,2) NOT NULL,
  `total_hargaj` float(8,2) NOT NULL,
  `tgl_setorinj` datetime NOT NULL,
  `tgl_setordonej` datetime NOT NULL,
  `biaya_setoranj` float(8,2) NOT NULL,
  `status_setoranj` varchar(15) NOT NULL,
  `alamat_setoranj` text NOT NULL,
  `tanggal_setoranj` datetime NOT NULL,
  `keterangan_setoranj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setoran_langganan`
--

CREATE TABLE `setoran_langganan` (
  `id_jemputl` varchar(20) NOT NULL,
  `id_setoran` varchar(20) NOT NULL,
  `perkiraan` float(8,2) NOT NULL,
  `hari_res` int(11) DEFAULT NULL,
  `long_jemputl` float(8,2) NOT NULL,
  `lat_jemputl` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setoran_langganan`
--

INSERT INTO `setoran_langganan` (`id_jemputl`, `id_setoran`, `perkiraan`, `hari_res`, `long_jemputl`, `lat_jemputl`) VALUES
('JL-00001', 'S-91338', 150.00, NULL, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksikeluar`
--

CREATE TABLE `transaksikeluar` (
  `id_transaksikeluar` varchar(10) NOT NULL,
  `kode_transaksi` varchar(10) NOT NULL,
  `tgl_transaksikeluar` date NOT NULL,
  `nomor_wallet` varchar(11) NOT NULL,
  `destination` varchar(20) NOT NULL,
  `jumlah_transaksikeluar` int(11) NOT NULL,
  `keterangan_transaksikeluar` text NOT NULL,
  `status_transaksikeluar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksimasuk`
--

CREATE TABLE `transaksimasuk` (
  `id_transaksimasuk` varchar(10) NOT NULL,
  `kode_transaksi` varchar(10) NOT NULL,
  `tgl_transaksimasuk` date NOT NULL,
  `nomor_wallet` varchar(11) NOT NULL,
  `origin` varchar(20) NOT NULL,
  `jumlah_transaksimasuk` int(11) NOT NULL,
  `keterangan_transaksimasuk` text NOT NULL,
  `status_transaksimasuk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trgr`
--

CREATE TABLE `trgr` (
  `id_kategorisampah` varchar(20) NOT NULL,
  `id_banksampah` int(11) NOT NULL,
  `golongan` varchar(20) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `haga` int(11) NOT NULL,
  `harga_atas` int(11) NOT NULL,
  `harga_bawah` int(11) NOT NULL,
  `deskripsi_kat` text NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trgr`
--

INSERT INTO `trgr` (`id_kategorisampah`, `id_banksampah`, `golongan`, `jenis`, `haga`, `harga_atas`, `harga_bawah`, `deskripsi_kat`, `tgl`) VALUES
('C00', 12, 'lainnya', 'campuran plastik', 500, 0, 0, '', '2019-05-07'),
('B00', 12, 'anorganik', 'Besi', 100, 0, 0, ' ', '2019-05-07'),
('B003', 12, 'anorganik', 'Bajuu', 500, 0, 0, '', '2019-05-07'),
('B00', 12, 'anorganik', 'Besi', 500, 0, 0, '  ', '2019-05-10'),
('P00', 12, 'anorganik', 'Plastik Aqua dan Ale', 100, 0, 0, '   ', '2019-05-10'),
('P01', 12, 'anorganik', 'Plastik Galon', 500, 0, 0, '', '2019-05-10'),
('P01', 12, 'anorganik', 'Plastik Galon', 500, 0, 0, '', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aqua', 700, 0, 0, '', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aqua', 700, 0, 0, ' ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('5', 12, 'anorganik', 'Plastik', 100, 0, 0, '', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('5', 12, 'anorganik', 'Plastik', 100, 0, 0, '', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('5', 12, 'anorganik', 'Plastik', 100, 0, 0, '', '2019-05-10'),
('5', 12, 'anorganik', 'Plastik', 100, 0, 0, '', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('1', 12, 'anorganik', 'Botol Aquas', 700, 0, 0, '  ', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-10'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-12'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-12'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-12'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-12'),
('9', 12, 'anorganik', 'Besi tembaga', 100, 0, 0, '', '2019-05-13'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-13'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-05-13'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-13'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-05-13'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-05-13'),
('10', 12, 'anorganik', 'kain', 1000, 0, 0, '', '2019-05-20'),
('11', 12, 'anorganik', 'Paku', 50, 0, 0, '', '2019-05-30'),
('13', 29, 'anorganik', 'PET', 100, 0, 0, 'Botol Aqua', '2019-06-27'),
('13', 29, 'anorganik', 'PET', 1001, 0, 0, ' Botol Aqua', '2019-06-27'),
('13', 29, 'anorganik', 'PET', 1003, 0, 0, '  Botol Aqua', '2019-06-27'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '   Botol Aqua', '2019-06-27'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '   Botol Aqua', '2019-06-27'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '    Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '     Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '      Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '       Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '       Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '       Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '       Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '       Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '       Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '       Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '       Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '        Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '        Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '        Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '        Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '        Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '         Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '          Botol Aqua', '2019-06-28'),
('13', 29, 'anorganik', 'PET', 1005, 0, 0, '           Botol Aqua', '2019-06-28'),
('15', 29, 'anorganik', 'q', 1, 0, 0, '', '2019-06-28'),
('15', 29, 'organik', 'q', 1, 0, 0, ' ', '2019-06-28'),
('15', 29, 'organik', 'q', 1, 0, 0, '  ', '2019-06-28'),
('17', 30, 'anorganik', 'botol', 500, 0, 0, 'Aqua', '2019-06-29'),
('17', 30, 'anorganik', 'botol', 500, 0, 0, ' Aqua', '2019-06-30'),
('19', 30, 'anorganik', 'q', 1, 0, 0, '', '2019-06-30'),
('18', 30, 'anorganik', 'Kardus', 500, 0, 0, '', '2019-06-30'),
('20', 30, 'anorganik', '1', 1, 0, 0, '', '2019-06-30'),
('18', 30, '', '', 0, 0, 0, '', '2019-06-30'),
('18', 30, 'anorganik', '1', 0, 0, 0, ' ', '2019-06-30'),
('18', 30, 'anorganik', 'asd', 0, 0, 0, '  ', '2019-06-30'),
('18', 30, 'anorganik', 'asd', 0, 0, 0, '  ', '2019-06-30'),
('18', 30, 'anorganik', 'asd', 0, 0, 0, '  ', '2019-06-30'),
('18', 30, 'anorganik', 'asd', 0, 0, 0, '  ', '2019-06-30'),
('21', 30, 'anorganik', 'a', 1500, 0, 0, '', '2019-06-30'),
('21', 30, 'anorganik', 'a', 500, 0, 0, ' ', '2019-06-30'),
('20', 30, 'anorganik', '1', 1, 0, 0, ' ', '2019-06-30'),
('22', 30, 'anorganik', 'PET', 100, 0, 0, '', '2019-07-01'),
('22', 30, '', '', 0, 0, 0, '', '2019-07-01'),
('22', 30, '', '', 0, 0, 0, '', '2019-07-01'),
('22', 30, '', '', 0, 0, 0, '', '2019-07-01'),
('18', 30, 'anorganik', 'asd', 1500, 0, 0, '   ', '2019-07-01'),
('18', 30, '', '', 0, 0, 0, '', '2019-07-01'),
('18', 30, '', '', 0, 0, 0, '', '2019-07-01'),
('18', 30, '', '', 0, 0, 0, '', '2019-07-01'),
('20', 30, 'anorganik', '1', 1, 0, 0, ' ', '2019-07-01'),
('24', 30, 'anorganik', '1', 1, 0, 0, '', '2019-07-01'),
('25', 30, 'anorganik', 'Kardus', 1, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('26', 30, 'anorganik', 'ff', 111, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('21', 30, 'anorganik', 'a', 500, 0, 0, ' ', '2019-07-01'),
('26', 30, 'anorganik', 'ff', 111, 0, 0, '', '2019-07-01'),
('21', 30, 'anorganik', 'a', 500, 0, 0, ' ', '2019-07-01'),
('18', 30, '', '', 0, 0, 0, '', '2019-07-01'),
('20', 30, '', '', 0, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-01'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-02'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('26', 30, 'anorganik', 'ff', 111, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-03'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-03'),
('29', 31, 'anorganik', 'PET', 100, 0, 0, 'Aqua', '2019-07-03'),
('29', 31, 'anorganik', 'PET', 100, 0, 0, 'Aqua', '2019-07-03'),
('30', 31, 'anorganik', 'Kardus', 1500, 0, 0, '', '2019-07-03'),
('29', 31, 'anorganik', 'PET', 100, 0, 0, 'Aqua', '2019-07-03'),
('29', 31, 'anorganik', 'PET', 100, 0, 0, 'Aqua', '2019-07-03'),
('29', 31, 'anorganik', 'PET', 100, 0, 0, 'Aqua', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-03'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-03'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-04'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-04'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-04'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-04'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-04'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-04'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-04'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-04'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-07-04'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-04'),
('36', 33, 'anorganik', 'CC', 1000, 0, 0, '', '2019-07-04'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-04'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-04'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-07-04'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-04'),
('36', 33, 'anorganik', 'CC', 1000, 0, 0, '', '2019-07-04'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-05'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-07-05'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-05'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-05'),
('6', 12, 'anorganik', 'Plastik', 1000, 0, 0, '', '2019-07-05'),
('7', 12, 'anorganik', 'Besi', 10, 0, 0, '', '2019-07-05'),
('8', 12, 'anorganik', 'Campuran', 500, 0, 0, '', '2019-07-05'),
('9', 12, 'anorganik', 'Besi tembaga', 1000, 0, 0, ' ', '2019-07-05'),
('10', 12, 'anorganik', 'kain', 1000, 0, 0, '', '2019-07-05'),
('11', 12, 'anorganik', 'Palu', 50, 0, 0, ' ', '2019-07-05'),
('13', 29, 'lainnya', 'PET', 1005, 0, 0, '            Botol Aqua', '2019-07-05'),
('18', 30, '', '', 0, 0, 0, '', '2019-07-05'),
('20', 30, '', '', 0, 0, 0, '', '2019-07-05'),
('21', 30, 'anorganik', 'a', 500, 0, 0, ' ', '2019-07-05'),
('22', 30, '', '', 0, 0, 0, '', '2019-07-05'),
('25', 30, '', '', 0, 0, 0, '', '2019-07-05'),
('26', 30, 'anorganik', 'ff', 111, 0, 0, '', '2019-07-05'),
('27', 30, 'anorganik', '144', 144, 0, 0, '', '2019-07-05'),
('28', 30, 'anorganik', 'PET', 500, 0, 0, '', '2019-07-05'),
('29', 31, 'anorganik', 'PET', 100, 0, 0, 'Aqua', '2019-07-05'),
('30', 31, 'anorganik', 'Kardus', 1500, 0, 0, '', '2019-07-05'),
('31', 32, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-05'),
('32', 32, 'anorganik', 'PP', 300, 0, 0, '', '2019-07-05'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-05'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-05'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-07-05'),
('36', 33, 'anorganik', 'CC', 1000, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-05'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-05'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-05'),
('38', 33, 'anorganik', 'Pi', 500, 0, 0, '', '2019-07-05'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-06'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-06'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-07'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-07'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-08'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-08'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('39', 33, 'anorganik', 'Lio', 100, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('40', 33, 'anorganik', 'Xiu', 3000, 0, 0, 'Auuw', '2019-07-09'),
('40', 33, 'anorganik', 'Xiu', 1000, 0, 0, ' Auuw', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('39', 33, 'anorganik', 'Lio', 100, 0, 0, ' ', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 300, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 3000, 0, 0, ' ', '2019-07-09'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-09'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-09'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-09'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-09'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-09'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 3000, 0, 0, ' ', '2019-07-09'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('39', 33, 'anorganik', 'Lio', 100, 0, 0, ' ', '2019-07-09'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-09'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-09'),
('37', 33, 'anorganik', 'KOI', 3000, 0, 0, ' ', '2019-07-09'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-09'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-09'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-09'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('40', 33, 'anorganik', 'Xiu', 1000, 0, 0, ' Auuw', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('40', 33, 'anorganik', 'Xiu', 1000, 0, 0, ' Auuw', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('40', 33, 'anorganik', 'Xiu', 1000, 0, 0, ' Auuw', '2019-07-10'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-10'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-10'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-10'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-10'),
('40', 33, 'anorganik', 'Xiu', 1000, 0, 0, ' Auuw', '2019-07-11'),
('40', 33, 'anorganik', 'Xiu', 1000, 0, 0, ' Auuw', '2019-07-11'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, '', '2019-07-11'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-11'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, ' ', '2019-07-11'),
('39', 33, 'anorganik', 'Lio', 100, 0, 0, ' ', '2019-07-11'),
('41', 33, 'anorganik', 'Grown', 120, 0, 0, '', '2019-07-11'),
('43', 33, 'anorganik', 'TYU', 1000, 0, 0, '', '2019-07-12'),
('43', 33, 'anorganik', 'TYU', 1000, 0, 0, '', '2019-07-12'),
('43', 33, 'anorganik', 'TYU', 1000, 0, 0, '', '2019-07-12'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-12'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-12'),
('43', 33, 'anorganik', 'TYU', 1000, 0, 0, '', '2019-07-12'),
('43', 33, 'anorganik', 'TYU', 1000, 0, 0, '', '2019-07-12'),
('43', 33, 'anorganik', 'TYU', 1000, 0, 0, '', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('36', 33, 'anorganik', 'CC', 1000, 0, 0, '', '2019-07-12'),
('42', 33, 'anorganik', 'Goni', 100, 0, 0, ' ', '2019-07-12'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('44', 33, 'anorganik', 'Dasi', 500, 0, 0, 'Botol Biru', '2019-07-12'),
('38', 33, 'anorganik', 'Pi', 500, 0, 0, '', '2019-07-16'),
('38', 33, 'anorganik', 'Pi', 500, 0, 0, '', '2019-07-16'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-19'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-19'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-19'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-19'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-19'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-19'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-19'),
('34', 33, 'anorganik', 'PP', 1200, 0, 0, '', '2019-07-19'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-07-19'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-23'),
('45', 33, 'anorganik', 'PET', 15000, 0, 0, 'Warna biru ', '2019-07-24'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-07-24'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-07-24'),
('35', 33, 'anorganik', 'HDPE', 100, 0, 0, '', '2019-08-06'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-08-06'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-08-10'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-08-10'),
('33', 33, 'anorganik', 'PET', 1000, 0, 0, '', '2019-08-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arus_sampah`
--
ALTER TABLE `arus_sampah`
  ADD KEY `arus_sampah_ibfk_1` (`id_kategorisampah`),
  ADD KEY `id_sampahkeluar` (`id_sampahkeluar`),
  ADD KEY `id_setoran` (`id_setoran`);

--
-- Indexes for table `banksampah`
--
ALTER TABLE `banksampah`
  ADD PRIMARY KEY (`id_banksampah`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nohp_banksampah` (`nohp_banksampah`),
  ADD KEY `banksampah_ibfk_2` (`nomor_wallet`),
  ADD KEY `banksampah_ibfk_3` (`id_induk`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id_driver`),
  ADD KEY `id_banksampah` (`id_banksampah`);

--
-- Indexes for table `goniwallet`
--
ALTER TABLE `goniwallet`
  ADD PRIMARY KEY (`nomor_wallet`);

--
-- Indexes for table `histori_sampah`
--
ALTER TABLE `histori_sampah`
  ADD KEY `histori_sampah_ibfk_1` (`id_banksampah`),
  ADD KEY `id_kategorisampah` (`id_kategorisampah`);

--
-- Indexes for table `jemput_langganan`
--
ALTER TABLE `jemput_langganan`
  ADD PRIMARY KEY (`id_jemputl`);

--
-- Indexes for table `jemput_sekali`
--
ALTER TABLE `jemput_sekali`
  ADD PRIMARY KEY (`id_jemputs`),
  ADD KEY `id_setoran` (`id_setoran`);

--
-- Indexes for table `join_akun`
--
ALTER TABLE `join_akun`
  ADD PRIMARY KEY (`id_joins`),
  ADD KEY `id_banksampah` (`id_banksampah`),
  ADD KEY `id_nasabah` (`id_nasabah`);

--
-- Indexes for table `kategorisampah`
--
ALTER TABLE `kategorisampah`
  ADD PRIMARY KEY (`id_kategorisampah`),
  ADD KEY `id_banksampah` (`id_banksampah`);

--
-- Indexes for table `kodetransaksi`
--
ALTER TABLE `kodetransaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `nomorn_wallet` (`nomorn_wallet`);

--
-- Indexes for table `sampahkeluar`
--
ALTER TABLE `sampahkeluar`
  ADD PRIMARY KEY (`id_sampahkeluar`),
  ADD KEY `id_banksampah` (`id_banksampah`);

--
-- Indexes for table `sampahkeluar_detail`
--
ALTER TABLE `sampahkeluar_detail`
  ADD KEY `id_sampahkeluar` (`id_sampahkeluar`),
  ADD KEY `id_kategorisampah` (`id_kategorisampah`);

--
-- Indexes for table `sampah_mutasi`
--
ALTER TABLE `sampah_mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `id_banksampah` (`id_banksampah`),
  ADD KEY `idkatsam_mutasi` (`idkatsam_mutasi`),
  ADD KEY `sampah_mutasi_ibfk_2` (`idkatsam_dimutasi`);

--
-- Indexes for table `sampah_residu`
--
ALTER TABLE `sampah_residu`
  ADD PRIMARY KEY (`id_residu`),
  ADD KEY `id_banksampah` (`id_banksampah`),
  ADD KEY `id_kategorisampah` (`id_kategorisampah`);

--
-- Indexes for table `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`id_setoran`),
  ADD KEY `id_banksampah` (`id_banksampah`),
  ADD KEY `id_nasabah` (`id_nasabah`);

--
-- Indexes for table `setoran_detail`
--
ALTER TABLE `setoran_detail`
  ADD KEY `id_setoran` (`id_setoran`),
  ADD KEY `id_kategorisampah` (`id_kategorisampah`);

--
-- Indexes for table `setoran_detailj`
--
ALTER TABLE `setoran_detailj`
  ADD KEY `id_setoranj` (`id_setoranj`),
  ADD KEY `id_kategorisampah` (`id_kategorisampah`);

--
-- Indexes for table `setoran_jemput`
--
ALTER TABLE `setoran_jemput`
  ADD PRIMARY KEY (`id_setoranj`),
  ADD KEY `setoran_jemput_ibfk_1` (`id_banksampah`),
  ADD KEY `id_nasabah` (`id_nasabah`);

--
-- Indexes for table `setoran_langganan`
--
ALTER TABLE `setoran_langganan`
  ADD KEY `set_lang_ibfk_1` (`id_jemputl`),
  ADD KEY `id_setoran` (`id_setoran`);

--
-- Indexes for table `transaksikeluar`
--
ALTER TABLE `transaksikeluar`
  ADD PRIMARY KEY (`id_transaksikeluar`),
  ADD KEY `nomor_wallet` (`nomor_wallet`),
  ADD KEY `kode_transaksi` (`kode_transaksi`);

--
-- Indexes for table `transaksimasuk`
--
ALTER TABLE `transaksimasuk`
  ADD PRIMARY KEY (`id_transaksimasuk`),
  ADD KEY `nomor_wallet` (`nomor_wallet`),
  ADD KEY `kode_transaksi` (`kode_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banksampah`
--
ALTER TABLE `banksampah`
  MODIFY `id_banksampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id_driver` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `join_akun`
--
ALTER TABLE `join_akun`
  MODIFY `id_joins` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategorisampah`
--
ALTER TABLE `kategorisampah`
  MODIFY `id_kategorisampah` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sampah_mutasi`
--
ALTER TABLE `sampah_mutasi`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `sampah_residu`
--
ALTER TABLE `sampah_residu`
  MODIFY `id_residu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arus_sampah`
--
ALTER TABLE `arus_sampah`
  ADD CONSTRAINT `arus_sampah_ibfk_1` FOREIGN KEY (`id_kategorisampah`) REFERENCES `kategorisampah` (`id_kategorisampah`) ON DELETE NO ACTION,
  ADD CONSTRAINT `arus_sampah_ibfk_2` FOREIGN KEY (`id_sampahkeluar`) REFERENCES `sampahkeluar` (`id_sampahkeluar`),
  ADD CONSTRAINT `arus_sampah_ibfk_3` FOREIGN KEY (`id_setoran`) REFERENCES `setoran` (`id_setoran`);

--
-- Constraints for table `banksampah`
--
ALTER TABLE `banksampah`
  ADD CONSTRAINT `banksampah_ibfk_2` FOREIGN KEY (`nomor_wallet`) REFERENCES `goniwallet` (`nomor_wallet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banksampah_ibfk_3` FOREIGN KEY (`id_induk`) REFERENCES `banksampah` (`id_banksampah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`);

--
-- Constraints for table `histori_sampah`
--
ALTER TABLE `histori_sampah`
  ADD CONSTRAINT `histori_sampah_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `histori_sampah_ibfk_2` FOREIGN KEY (`id_kategorisampah`) REFERENCES `kategorisampah` (`id_kategorisampah`);

--
-- Constraints for table `jemput_sekali`
--
ALTER TABLE `jemput_sekali`
  ADD CONSTRAINT `jemput_sekali_ibfk_1` FOREIGN KEY (`id_setoran`) REFERENCES `setoran` (`id_setoran`);

--
-- Constraints for table `join_akun`
--
ALTER TABLE `join_akun`
  ADD CONSTRAINT `join_akun_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `join_akun_ibfk_2` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id_nasabah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategorisampah`
--
ALTER TABLE `kategorisampah`
  ADD CONSTRAINT `kategorisampah_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`);

--
-- Constraints for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD CONSTRAINT `nasabah_ibfk_1` FOREIGN KEY (`nomorn_wallet`) REFERENCES `goniwallet` (`nomor_wallet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sampahkeluar`
--
ALTER TABLE `sampahkeluar`
  ADD CONSTRAINT `sampahkeluar_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`);

--
-- Constraints for table `sampahkeluar_detail`
--
ALTER TABLE `sampahkeluar_detail`
  ADD CONSTRAINT `sampahkeluar_detail_ibfk_1` FOREIGN KEY (`id_sampahkeluar`) REFERENCES `sampahkeluar` (`id_sampahkeluar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sampahkeluar_detail_ibfk_2` FOREIGN KEY (`id_kategorisampah`) REFERENCES `kategorisampah` (`id_kategorisampah`);

--
-- Constraints for table `sampah_mutasi`
--
ALTER TABLE `sampah_mutasi`
  ADD CONSTRAINT `sampah_mutasi_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`) ON DELETE NO ACTION,
  ADD CONSTRAINT `sampah_mutasi_ibfk_2` FOREIGN KEY (`idkatsam_dimutasi`) REFERENCES `kategorisampah` (`id_kategorisampah`) ON DELETE NO ACTION,
  ADD CONSTRAINT `sampah_mutasi_ibfk_3` FOREIGN KEY (`idkatsam_mutasi`) REFERENCES `kategorisampah` (`id_kategorisampah`);

--
-- Constraints for table `sampah_residu`
--
ALTER TABLE `sampah_residu`
  ADD CONSTRAINT `sampah_residu_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`) ON DELETE CASCADE,
  ADD CONSTRAINT `sampah_residu_ibfk_2` FOREIGN KEY (`id_kategorisampah`) REFERENCES `kategorisampah` (`id_kategorisampah`);

--
-- Constraints for table `setoran`
--
ALTER TABLE `setoran`
  ADD CONSTRAINT `setoran_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`),
  ADD CONSTRAINT `setoran_ibfk_2` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id_nasabah`);

--
-- Constraints for table `setoran_detail`
--
ALTER TABLE `setoran_detail`
  ADD CONSTRAINT `setoran_detail_ibfk_1` FOREIGN KEY (`id_setoran`) REFERENCES `setoran` (`id_setoran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `setoran_detail_ibfk_2` FOREIGN KEY (`id_kategorisampah`) REFERENCES `kategorisampah` (`id_kategorisampah`);

--
-- Constraints for table `setoran_detailj`
--
ALTER TABLE `setoran_detailj`
  ADD CONSTRAINT `setoran_detailj_ibfk_1` FOREIGN KEY (`id_setoranj`) REFERENCES `setoran_jemput` (`id_setoranj`),
  ADD CONSTRAINT `setoran_detailj_ibfk_2` FOREIGN KEY (`id_kategorisampah`) REFERENCES `kategorisampah` (`id_kategorisampah`);

--
-- Constraints for table `setoran_jemput`
--
ALTER TABLE `setoran_jemput`
  ADD CONSTRAINT `setoran_jemput_ibfk_1` FOREIGN KEY (`id_banksampah`) REFERENCES `banksampah` (`id_banksampah`),
  ADD CONSTRAINT `setoran_jemput_ibfk_2` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id_nasabah`);

--
-- Constraints for table `setoran_langganan`
--
ALTER TABLE `setoran_langganan`
  ADD CONSTRAINT `setoran_langganan_ibfk_1` FOREIGN KEY (`id_jemputl`) REFERENCES `jemput_langganan` (`id_jemputl`) ON DELETE CASCADE,
  ADD CONSTRAINT `setoran_langganan_ibfk_2` FOREIGN KEY (`id_setoran`) REFERENCES `setoran` (`id_setoran`);

--
-- Constraints for table `transaksikeluar`
--
ALTER TABLE `transaksikeluar`
  ADD CONSTRAINT `transaksikeluar_ibfk_1` FOREIGN KEY (`nomor_wallet`) REFERENCES `goniwallet` (`nomor_wallet`),
  ADD CONSTRAINT `transaksikeluar_ibfk_2` FOREIGN KEY (`kode_transaksi`) REFERENCES `kodetransaksi` (`kode_transaksi`);

--
-- Constraints for table `transaksimasuk`
--
ALTER TABLE `transaksimasuk`
  ADD CONSTRAINT `transaksimasuk_ibfk_1` FOREIGN KEY (`nomor_wallet`) REFERENCES `goniwallet` (`nomor_wallet`),
  ADD CONSTRAINT `transaksimasuk_ibfk_2` FOREIGN KEY (`kode_transaksi`) REFERENCES `kodetransaksi` (`kode_transaksi`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `histori` ON SCHEDULE EVERY 1 MONTH STARTS '2019-07-11 09:39:34' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO histori_sampah 
SELECT CURRENT_DATE - INTERVAL 1 MONTH, kategorisampah.id_kategorisampah, kategorisampah.id_banksampah,kategorisampah.qbeli,
kategorisampah.qhibah, kategorisampah.qlainnya,kategorisampah.qresidu,kategorisampah.qmutasian,kategorisampah.qdimutasi,
kategorisampah.qjual,kategorisampah.qnonjual,kategorisampah.qreject FROM kategorisampah$$

CREATE DEFINER=`root`@`localhost` EVENT `histori_test` ON SCHEDULE EVERY 1 MINUTE STARTS '2019-07-11 09:40:03' ON COMPLETION NOT PRESERVE DISABLE DO INSERT INTO histori_sampah 
SELECT CURRENT_DATE - INTERVAL 2 MONTH, kategorisampah.id_kategorisampah, kategorisampah.id_banksampah,kategorisampah.qbeli,
kategorisampah.qhibah, kategorisampah.qlainnya,kategorisampah.qresidu,kategorisampah.qmutasian,kategorisampah.qdimutasi,
kategorisampah.qjual,kategorisampah.qnonjual,kategorisampah.qreject FROM kategorisampah$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
