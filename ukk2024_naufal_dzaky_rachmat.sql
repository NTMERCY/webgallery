-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 04:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk2024_naufal_dzaky_rachmat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `jenis_kelamin`) VALUES
(19, 'huhu', 'f3c2cefc1f3b082a56f52902484ca511', 'huhu@gmail.com', 'L'),
(20, 'hehe', '529ca8050a00180790cf88b63468826a', 'hehe@gmail.com', 'L'),
(21, 'haha', '4e4d6c332b6fe62a63afe56171fd3725', 'haha@gmail.com', 'L'),
(22, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@gmail.com', ''),
(23, 'dapin', '310a75c822caefd88a14ea396cda0832', 'dapin@gmail.com', ''),
(24, 'arip', '5d7eb10bb6ad23967c1aef0829b418eb', 'arip@gmail.com', 'L'),
(25, 'cewe', '3e67ea9b8c83c7d44e7e726e413d01e2', 'cewe@gmail.com', ''),
(26, 'uh', 'b20b42abce21dcd370986f1b3c2dfa5b', 'uh@gmail.com', 'P'),
(27, 'uy', '1b23f8a4c97cc55f757ec2aae921f03d', 'uy@gmail.com', 'L'),
(28, 'yyy', 'f0a4058fd33489695d53df156b77c724', 'yyy@gmail.com', 'P'),
(29, 'uhuy', '1f4bc94546ba4a629fca63b8e2fe2931', 'uhuy@gmail.com', 'P'),
(30, 'hehehe', 'ffe553694f5096471590343432359e02', 'hehehe@gmail.com', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nama_album` varchar(255) NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caption`
--

CREATE TABLE `caption` (
  `caption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `caption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `caption`) VALUES
(109, 'images/customer-support.jpg', 'animasi'),
(114, 'images/download (3).jpg', 'kucing guwa'),
(116, 'images/download (2).jpg', 'bagus'),
(117, 'images/download (3).jpg', 'smooooth'),
(120, 'images/download (8).jpg', 'leooo'),
(122, 'images/holduplethimcook.jpg', 'capybara'),
(130, 'images/download (7).jpg', 'mashle'),
(131, 'images/scara.jpg', 'gacor kang'),
(135, 'images/profile.jpg', 'animasi profil'),
(137, 'images/gojo.jpg', 'gojo'),
(139, 'images/download (8).jpg', 'anjay'),
(140, 'images/gojo.gif', 'satoru'),
(141, 'images/gojo2.gif', 'keren oy'),
(142, 'images/download (1).jpg', 'kucing'),
(143, 'images/eren.gif', 'TATAKAEEEEEE!!!!!!'),
(144, 'images/mikasa.gif', 'zzzzzzzzzzzz');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `komentar_id` int(12) NOT NULL,
  `admin_id` int(12) DEFAULT NULL,
  `id` int(12) NOT NULL,
  `komentar_teks` text NOT NULL,
  `tanggal_komentar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`komentar_id`, `admin_id`, `id`, `komentar_teks`, `tanggal_komentar`) VALUES
(1, NULL, 130, 'dasdasdsa', '2024-04-24 02:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `like_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `id` (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `komentar_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `album_ibfk_2` FOREIGN KEY (`id`) REFERENCES `images` (`id`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id`) REFERENCES `images` (`id`);

--
-- Constraints for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
