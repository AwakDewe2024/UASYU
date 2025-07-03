-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2025 at 06:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','asisten') NOT NULL DEFAULT 'asisten'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `email`, `password`, `role`) VALUES
(13, 'Wahyu', 'wahyu@gmail.com', '$2y$10$e2KLNTRGSLcFvGI5iC8y7eH40F.uBnrRP1FHgoK2p7wfiSrgNBfaC', 'admin'),
(14, 'admin', 'admin@gmail.com', '$2y$10$1FsMIgsZ1hI8IsCzsxhTfe0B6W3sCa7.pWZwg6qZaEzvGJHc0AZga', 'admin'),
(15, 'asisten', 'asisten@gmail.com', '$2y$10$qi9iA4PfkBoYGXATt4D9GeMhuPIjABT2WePYfa5e.9YpxWSJ4iwZC', 'asisten'),
(16, 'Dhini', 'dhini@gmail.com', '$2y$10$JqvlYt8RX.3KmwPKfvm2XOR2z6HPG1qppUft1bEpAIaO1AvcCjkk2', 'asisten');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `keluhan` text DEFAULT NULL,
  `tanggal_periksa` date NOT NULL,
  `diagnosa` text DEFAULT NULL,
  `resep_obat` varchar(200) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `nama`, `alamat`, `keluhan`, `tanggal_periksa`, `diagnosa`, `resep_obat`, `file_upload`) VALUES
(1, 'wahyu', 'grati', 'kelelahan, pucat, sesak napas, sakit kepala, pusing, dan detak jantung cepat', '2025-07-01', 'anemia', 'Sangobion Kapsul, Hufabion, Feroglobin Kapsul', '6865170e622e9_RekamMedis.pdf'),
(4, 'nayla', 'lumajang', 'sensasi terbakar di dada, regurgitasi, mual, muntah, dan kesulitan menelan', '2025-07-02', 'asam lambung', 'Promag, Mylanta, Ranitidine dan Famotidine', '686518f91b9c2_RekamMedis.pdf'),
(5, 'fatma', 'malang', 'kehilangan keseimbangan, mual, muntah, telinga berdenging, penglihatan kabur, berkeringat dingin', '2025-07-03', 'vertigo', 'betahistine, flunarizine, dan dimenhydrinate', '68651a2ae782d_RekamMedis.pdf'),
(12, 'rizal', 'bangil', 'Menggigil dan berkeringat, Penurunan nafsu makan, Keluhan saluran napas', '2025-07-04', 'hipertermia', 'propofol, buspiron, magnesium, tramadol, dan deksmedetomidin', '68651ad98dc04_RekamMedis.pdf'),
(13, 'ibnu', 'pandaan', 'sesak napas, batuk, mengi, nyeri dada, hidung tersumbat atau berair', '2025-07-05', 'gangguan pernafasan', 'bronkodilator, kortikosteroid, diuretik', '68651b8c7cb80_RekamMedis.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
