-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 02:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `membership_gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telpon` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nama_depan`, `nama_belakang`, `alamat`, `telpon`, `username`, `password`) VALUES
('halo', 'kita', 'ketintang', '42363746', 'admin', 'admin'),
('halo', 'hai', 'ketintang', '2134274', 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi_kami`
--

CREATE TABLE `hubungi_kami` (
  `email` varchar(50) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `no_kontak` varchar(50) NOT NULL,
  `pesan` varchar(50) NOT NULL,
  `tgl_post` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hubungi_kami`
--

INSERT INTO `hubungi_kami` (`email`, `nama_depan`, `nama_belakang`, `no_kontak`, `pesan`, `tgl_post`) VALUES
('faisalbar2000@gmail.com', 'Mohammad Faiz Albar', '', '081298345535', 'Mau Konfirm TRN00000001 Sudah di bayar', '2024-04-03'),
('hlwdiyyy@gmail.com', 'diyan', 'dini', '3484873', 'MENYALA ABANGKUHHH', '2024-05-19'),
('marifatunnisa123@gmail.com', 'marifatunnisa', '', '081312201758', 'Ashiaaaap', '2024-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_trainer` varchar(50) NOT NULL,
  `tanggal_latihan` date NOT NULL,
  `waktu_latihan` varchar(50) NOT NULL,
  `trainer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_user`, `id_trainer`, `tanggal_latihan`, `waktu_latihan`, `trainer`) VALUES
('JD1', 'U0000001', 'TRN0000001', '2024-05-10', 'SIANG', 'EKO'),
('JD2', 'U0000002', 'TRN0000002', '2024-05-18', 'PAGI', 'EMA'),
('JD3', 'U0000003', 'TRN0000003', '2024-06-01', 'MALAM', 'WONGKA'),
('JD4', 'U0000004', 'TRN0000002', '2024-06-03', 'PAGI', 'EMA');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` varchar(50) NOT NULL,
  `jenis_layanan` varchar(50) NOT NULL,
  `jml_lat_max` varchar(50) NOT NULL,
  `biaya` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `jenis_layanan`, `jml_lat_max`, `biaya`) VALUES
('BL', 'BLACK', '8', '450.000'),
('GL', 'GOLD', '12', '600.000'),
('GR', 'GREY', '4', '250.000'),
('U1', 'UNLIMITED 1', 'unlimited', '1.200.000'),
('U2', 'UNLIMITED 2', 'unlimited', '10.000.000');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`) VALUES
('faisalbar2000@gmail.com ', '4ca98c1e481b25a7a278b6a33c696c4'),
('hlwdiyyy@gmail.com', 'diyan'),
('marifatunnisa123@gmail.com ', 'ff6d11fad3287047fcafb104c276e63a');

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE `login_admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `login_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_admin`
--

INSERT INTO `login_admin` (`username`, `password`, `login_time`) VALUES
('admin', 'admin', '2024-05-21 04:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_user` varchar(50) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `layanan` varchar(50) NOT NULL,
  `id_layanan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_user`, `nama_depan`, `nama_belakang`, `tgl_lahir`, `email`, `no_telp`, `layanan`, `id_layanan`) VALUES
('U0000001', 'fais', 'albar', '2014-04-01', 'faisalbar2000@gmail.com', '018292192', 'REGULER BLACK - 450.000', 'BL'),
('U0000002', 'marifatun', 'nisa', '2014-05-15', 'marifatunnisa123@gmail.com', '02139383', 'REGULER GREY - 250.000', 'GR'),
('U0000003', 'diyan', 'dini', '2024-04-30', 'hlwdiyyy@gmail.com', '33434343', 'UNLIMITED 1 - 1.400.000', 'U1'),
('U0000004', 'halo', 'hai', '2024-04-28', 'ummisoifah59@gmail.com', '063246378', 'UNLIMITED 1 - 1.400.000', 'U1');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `jenis_layanan` varchar(50) NOT NULL,
  `id_layanan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_user`, `nama_depan`, `nama_belakang`, `jenis_layanan`, `id_layanan`) VALUES
('A1', 'U0000001', 'fais', 'albar', 'REGULER BLACK - 450.000 ', 'BL'),
('A2', 'U0000002', 'diyan', 'dini', 'UNLIMITED 1 - 1.400.000 ', 'U1'),
('A3', 'U0000003', 'marifatun', 'nisa', 'REGULER GREY - 250.000 ', 'GR'),
('A4', 'U0000004', 'halo', 'hai', 'UNLIMITED 1 - 1.400.000 ', 'U1');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id_user` varchar(50) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telp` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id_user`, `nama_depan`, `nama_belakang`, `email`, `tgl_lahir`, `no_telp`, `password`) VALUES
('U0000001', 'fais', 'albar', 'faisalbar2000@gmail.com', '2024-05-01', '31266164', '4ca98c1e481b25a7a278b6a33c696c'),
('U0000002', 'diyan', 'dini', 'hlwdiyyy@gmail.com', '2024-05-01', '2179432749', 'diyan'),
('U0000003', 'marifatun', 'nisa', 'marifatunnisa123@gmail.com', '2024-05-01', '34388237487329', ' ff6d11fad3287047fcafb104c276e63a'),
('U0000004', 'halo', 'hai', 'ummisoifah59@gmail.com', '2024-04-28', '063246378', 'umi');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `email` varchar(50) NOT NULL,
  `testimonial` varchar(50) NOT NULL,
  `tgl_post` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`email`, `testimonial`, `tgl_post`) VALUES
('faisalbar2000@gmail.com', 'Recomended deh pokoknya', '2024-04-09'),
('hlwdiyyy@gmail.com', 'MANTAPPPPPPPPPPPPPP', '2024-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `id_trainer` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki - laki','Perempuaan','','') NOT NULL,
  `no_telp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`id_trainer`, `nama`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `no_telp`) VALUES
('TRN0000001 ', 'Eko Prasetyo ', 'Jl Kusuma ', '1995-02-08', 'Laki - laki', '08322343213'),
('TRN0000002 ', 'Ema Kurnia ', 'Jl. Contoh Alamat Jalan No 294 ', '1999-06-01', 'Perempuaan', '08342343xx'),
('TRN0000003', 'Wily Wongka', 'Jl. Baru Sidosermo', '1990-04-29', 'Laki - laki', '08898273492'),
('TRN0000004', 'Agatha Pricilla', 'Jl. Menuju Roma', '1996-07-14', 'Perempuaan', '085729997033');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `hubungi_kami`
--
ALTER TABLE `hubungi_kami`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `login_admin`
--
ALTER TABLE `login_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id_user`);
ALTER TABLE `signup` ADD FULLTEXT KEY `email` (`email`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id_trainer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
