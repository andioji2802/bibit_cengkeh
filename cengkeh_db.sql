-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 12:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cengkeh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `email`, `phone`) VALUES
(1, 'admin123', '12345', 'Andi Khozin Mubarak', 'aduankonten@mail.kominfo.go.id', '081519456823'),
(2, 'oji', '123', 'OJI', 'oji@gmail.com', '081519456822');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id` int(11) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `jenis_bibit` varchar(255) NOT NULL,
  `ciri_daun` varchar(255) NOT NULL,
  `ciri_batang` varchar(255) NOT NULL,
  `tinggi_bibit` varchar(255) NOT NULL,
  `umur_bibit` varchar(255) NOT NULL,
  `ciri_akar` varchar(255) NOT NULL,
  `kualitas` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `proses_detail` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id`, `nama_pengguna`, `jenis_bibit`, `ciri_daun`, `ciri_batang`, `tinggi_bibit`, `umur_bibit`, `ciri_akar`, `kualitas`, `time`, `proses_detail`, `is_deleted`) VALUES
(182, 'andioji28', 'Cengkeh Zanzibar', 'halus tanpa bercak', 'berwarna coklat tua', '90cm', '18 Bulan', 'kuat & sehat', 'Berkualitas', '2024-09-14 15:08:02', NULL, 1),
(183, 'andioji28', 'Cengkeh Zanzibar', 'tegak & tidak layu', 'rusak atau menggulung', '70cm', '24 Bulan', 'kuat & sehat', 'Berkualitas', '2024-09-14 15:08:00', NULL, 1),
(184, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'rusak atau menggulung', '90cm', '24 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-09-14 15:08:00', NULL, 1),
(185, 'andioji28', 'Cengkeh Zanzibar', 'halus tanpa bercak', 'lurus tapi kecil', '20cm', '5 Bulan', 'banyak & bercabang', 'Tidak Berkualitas', '2024-09-14 15:08:00', NULL, 1),
(186, 'andioji28', 'Cengkeh Zanzibar', 'layu', 'rapuh & kering', '10cm', '5 Bulan', 'akar tipis atau pendek', 'Tidak Berkualitas', '2024-09-14 15:07:59', NULL, 1),
(187, 'andioji28', 'Cengkeh Zanzibar', 'tegak & tidak layu', 'rusak atau menggulung', '10cm', '10 Bulan', 'sedikit bercabang', 'Tidak Berkualitas', '2024-09-14 15:07:53', NULL, 1),
(188, 'andioji28', 'Cengkeh Zanzibar', 'layu', 'rapuh & kering', '90cm', '24 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-09-14 15:07:59', NULL, 1),
(189, 'andioji28', 'Cengkeh Zanzibar', 'layu', 'rapuh & kering', '90cm', '24 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-09-14 15:07:59', NULL, 1),
(190, 'andioji28', 'Cengkeh Zanzibar', 'layu', 'rapuh & kering', '90cm', '24 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-14 15:07:58', NULL, 1),
(191, 'andioji28', 'Cengkeh Zanzibar', 'layu', 'rapuh & kering', '90cm', '24 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-14 15:07:58', NULL, 1),
(192, 'andioji28', 'Cengkeh Zanzibar', 'mengkilap & sehat', 'lurus tapi kecil', '40cm', '24 Bulan', 'tidak bercabang', 'Berkualitas', '2024-09-14 15:07:58', NULL, 1),
(193, 'andioji28', 'Cengkeh Zanzibar', 'mengkilap & sehat', 'lurus tapi kecil', '40cm', '24 Bulan', 'akar busuk', 'Berkualitas', '2024-09-14 15:07:57', NULL, 1),
(194, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'besar & lurus', '90cm', '18 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-09-14 15:07:57', NULL, 1),
(195, 'andioji28', 'Cengkeh Zanzibar', 'halus tanpa bercak', 'besar tapi bengkok', '10cm', '5 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-09-14 15:07:56', NULL, 1),
(196, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'besar & lurus', '60cm', '12 Bulan', 'tidak busuk', 'Berkualitas', '2024-09-14 15:07:55', NULL, 1),
(197, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'kulit batang mulus tanpa luka', '40cm', '8 Bulan', 'tidak bercabang', 'Tidak Berkualitas', '2024-09-14 15:07:50', NULL, 1),
(198, 'andioji28', 'Cengkeh Zanzibar', 'Sempit & Kuning', 'kulit batang mulus tanpa luka', '90cm', '24 Bulan', 'akar busuk', 'Berkualitas', '2024-09-14 15:07:49', NULL, 1),
(199, 'andioji28', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'besar & lurus', '10cm', '5 Bulan', 'tidak busuk', 'Berkualitas', '2024-09-14 15:07:47', NULL, 1),
(200, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'besar & lurus', '70cm', '12 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-14 15:07:45', NULL, 1),
(201, 'andioji28', 'Cengkeh Zanzibar', 'Sempit & Kuning', 'berwarna coklat tua', '10cm', '6 Bulan', 'tidak bercabang', 'Tidak Berkualitas', '2024-09-15 14:44:54', NULL, 1),
(202, 'andioji28', 'Cengkeh Zanzibar', 'tegak & tidak layu', 'kuat & tidak rapuh', '60cm', '11 Bulan', 'akar tipis atau pendek', 'Berkualitas', '2024-09-15 14:44:53', NULL, 1),
(203, 'andioji28', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'rusak atau menggulung', '30cm', '24 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-09-15 14:44:53', NULL, 1),
(204, 'andioji28', 'Cengkeh Zanzibar', 'lebar tapi kuning', 'besar & lurus', '90cm', '18 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-15 14:44:53', NULL, 1),
(205, 'andioji28', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'retak atau patah', '70cm', '10 Bulan', 'banyak & bercabang', 'Tidak Berkualitas', '2024-09-15 14:44:52', NULL, 1),
(206, 'andioji28', 'Cengkeh Zanzibar', 'mengkilap & sehat', 'berwarna coklat tua', '80cm', '24 Bulan', 'tidak bercabang', 'Berkualitas', '2024-09-15 14:44:52', NULL, 1),
(207, 'andioji28', 'Cengkeh Zanzibar', 'layu', 'rapuh & kering', '50cm', '8 Bulan', 'kuat & sehat', 'Tidak Berkualitas', '2024-09-15 14:44:51', NULL, 1),
(208, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'rusak atau menggulung', '90cm', '24 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-09-15 14:44:50', NULL, 1),
(209, 'andioji28', 'Cengkeh Zanzibar', 'Sempit & Kuning', 'lurus tapi kecil', '90cm', '12 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-15 14:44:47', NULL, 1),
(210, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'besar tapi bengkok', '60cm', '9 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-09-15 14:44:43', NULL, 1),
(211, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'besar & lurus', '90cm', '11 Bulan', 'kuat & sehat', 'Berkualitas', '2024-09-15 04:50:20', NULL, 1),
(212, 'andioji28', 'Cengkeh Zanzibar', 'mengkilap & sehat', 'kuat & tidak rapuh', '70cm', '18 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-15 08:44:15', NULL, 0),
(213, 'andioji28', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'besar tapi bengkok', '60cm', '6 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-09-15 08:45:31', NULL, 0),
(214, 'andioji28', 'Cengkeh Zanzibar', 'mengkilap & sehat', 'besar & lurus', '90cm', '24 Bulan', 'tidak busuk', 'Berkualitas', '2024-09-15 08:46:08', NULL, 0),
(215, 'andioji28', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'besar tapi bengkok', '60cm', '8 Bulan', 'akar tipis atau pendek', 'Tidak Berkualitas', '2024-09-15 08:47:26', NULL, 0),
(216, 'andioji28', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'lurus tapi kecil', '10cm', '5 Bulan', 'akar tipis atau pendek', 'Tidak Berkualitas', '2024-09-15 08:48:00', NULL, 0),
(217, 'andioji28', 'Cengkeh Zanzibar', 'tegak & tidak layu', 'kuat & tidak rapuh', '70cm', '24 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-15 08:49:08', NULL, 0),
(218, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'kuat & tidak rapuh', '90cm', '18 Bulan', 'tidak busuk', 'Berkualitas', '2024-09-15 08:49:45', NULL, 0),
(219, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'kulit batang mulus tanpa luka', '90cm', '18 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-09-15 08:50:12', NULL, 0),
(220, 'andioji28', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'kuat & tidak rapuh', '90cm', '18 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-15 08:50:39', NULL, 0),
(221, 'andioji28', 'Cengkeh Zanzibar', 'tegak & tidak layu', 'besar & lurus', '70cm', '18 Bulan', 'tidak busuk', 'Berkualitas', '2024-09-15 08:51:08', NULL, 0),
(222, 'andioji28', 'Cengkeh Zanzibar', 'lebar tapi kuning', 'rapuh & kering', '10cm', '8 Bulan', 'akar tipis atau pendek', 'Tidak Berkualitas', '2024-09-15 14:52:04', NULL, 1),
(223, 'andioji28', 'Cengkeh Zanzibar', 'layu', 'retak atau patah', '30cm', '5 Bulan', 'sedikit bercabang', 'Tidak Berkualitas', '2024-09-15 09:40:52', NULL, 0),
(224, 'jokowi', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'rapuh & kering', '10cm', '6 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-09-22 19:07:12', NULL, 0),
(225, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'besar tapi bengkok', '10cm', '18 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-24 19:35:41', NULL, 0),
(226, 'jokowi', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'lurus tapi kecil', '10cm', '7 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-09-24 19:36:36', NULL, 0),
(227, 'jokowi', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'lurus tapi kecil', '10cm', '7 Bulan', 'banyak & bercabang', 'Tidak Berkualitas', '2024-09-24 19:36:50', NULL, 0),
(228, 'jokowi', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'lurus tapi kecil', '10cm', '7 Bulan', 'tumbuh merata', 'Tidak Berkualitas', '2024-09-24 19:37:03', NULL, 0),
(229, 'jokowi', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'lurus tapi kecil', '10cm', '24 Bulan', 'tumbuh merata', 'Berkualitas', '2024-09-24 19:37:10', NULL, 0),
(230, 'jokowi', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'lurus tapi kecil', '10cm', '24 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-09-24 19:37:17', NULL, 0),
(231, 'jokowi', 'Cengkeh Zanzibar', 'hijau tapi bercak', 'lurus tapi kecil', '10cm', '24 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-09-24 19:37:22', NULL, 0),
(232, 'jokowi', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'besar & lurus', '90cm', '18 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-11-17 06:11:49', NULL, 1),
(233, 'jokowi', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'besar & lurus', '90cm', '5 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-11-17 06:11:49', NULL, 1),
(234, 'jokowi', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'besar & lurus', '90cm', '5 Bulan', 'akar busuk', 'Berkualitas', '2024-11-17 06:11:48', NULL, 1),
(235, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'besar & lurus', '10cm', '12 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-11-17 06:11:48', NULL, 1),
(236, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'besar & lurus', '10cm', '5 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-11-17 06:11:47', NULL, 1),
(237, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'besar & lurus', '10cm', '5 Bulan', 'akar busuk', 'Tidak Berkualitas', '2024-11-17 06:11:47', NULL, 1),
(238, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'besar & lurus', '10cm', '5 Bulan', 'sedikit bercabang', 'Tidak Berkualitas', '2024-11-17 06:11:47', NULL, 1),
(239, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'besar & lurus', '10cm', '5 Bulan', 'kuat & sehat', 'Berkualitas', '2024-11-17 06:11:39', NULL, 1),
(240, 'jokowi', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'rapuh & kering', '10cm', '5 Bulan', 'kuat & sehat', 'Berkualitas', '2024-11-17 06:11:46', NULL, 1),
(241, 'jokowi', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'rapuh & kering', '90cm', '5 Bulan', 'kuat & sehat', 'Berkualitas', '2024-11-17 06:11:46', NULL, 1),
(242, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'rapuh & kering', '90cm', '5 Bulan', 'kuat & sehat', 'Tidak Berkualitas', '2024-11-17 06:11:46', NULL, 1),
(243, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'lurus tapi kecil', '40cm', '12 Bulan', 'kuat & sehat', 'Berkualitas', '2024-11-17 06:11:45', NULL, 1),
(244, 'jokowi', 'Cengkeh Zanzibar', 'halus tanpa bercak', 'kuat & tidak rapuh', '60cm', '9 Bulan', 'tidak bercabang', 'Berkualitas', '2024-11-17 06:11:45', NULL, 1),
(245, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'besar & lurus', '10cm', '5 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-11-17 06:11:44', NULL, 1),
(246, 'jokowi', 'Cengkeh Zanzibar', 'layu', 'besar & lurus', '10cm', '5 Bulan', 'banyak & bercabang', 'Berkualitas', '2024-11-17 06:11:44', NULL, 1),
(247, 'jokowi', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'berwarna coklat tua', '60cm', '24 Bulan', 'kuat & sehat', 'Berkualitas', '2024-11-17 06:11:44', NULL, 1),
(248, 'jokowi', 'Cengkeh Zanzibar', 'halus tanpa bercak', 'kuat & tidak rapuh', '70cm', '8 Bulan', 'tidak busuk', 'Berkualitas', '2024-11-17 06:11:41', NULL, 1),
(249, 'jokowi', 'Cengkeh Zanzibar', 'Lebar & Hijau', 'kulit batang mulus tanpa luka', '80cm', '12 Bulan', 'tidak bercabang', 'Berkualitas', '2024-11-28 23:23:54', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_time` varchar(16) NOT NULL,
  `logout_time` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `no_hp`, `password`, `login_time`, `logout_time`) VALUES
(6, 'Andi Khozin Al Mubarak', 'andioji28', 'akmaznur2802@gmail.com', '081234567891', '$2y$10$ScrsiFwEeMK7iSrl7jlm/.75xeghbmD68SDtWsQVLC78aYL1MyMc.', '2024-09-25 09:27', '2024-09-25 07:27'),
(7, 'Budi', 'budi1', 'budi@gmail.com', '098711442311', '$2y$10$TWvFpJdLrU.EJJF0HbScX.pPg0JePS1GYAhnuGsMZPUnFSiNrtblu', '2024-08-19 19:53', '2024-08-19 19:55'),
(8, 'Ahmad', 'ahmad25', 'ahmad25@gmail.com', '097512679823', '$2y$10$G.YavucEqnue03L1t.MxV.PVp0IjC1deET5lqE8q1.nI.WbImj5lS', '2024-08-19 19:55', '2024-08-19 19:58'),
(9, 'Dr. Eng. Hazriani, S. Kom., MT', 'hazriani_pa1', 'hazriani@gmail.com', '081342698078', '$2y$10$/eay981qcNcrtgD32yAGyOZv7DC2lFj0yJfqq/33ySScez9fTs.Ry', '2024-08-19 19:58', '2024-08-19 19:59'),
(10, 'Sitti Zuhriyah, S.Pd., M.Si.', 'zuhriyah_pa2', 'sittizuhriyah@gmail.com', '081342115571', '$2y$10$wY7QbXqN4n/9cy3P.eTYqOsXF2XcClmRAViTkVaz0M3XG6NI2dtNC', '2024-08-19 19:59', '2024-08-19 20:01'),
(11, 'Shin Tae Yong', 'coach_shin62', 'shintaeyong@gmail.com', '081211112222', '$2y$10$7MjEJPkooEPQIvam2F3SCOG6Ep4pVVQGS682KERzSIH6ky0Ww/1HC', '2024-08-19 20:02', '2024-08-19 20:03'),
(12, 'Rafael Struick', 'struick', 'struick@gmail.com', '089165873232', '$2y$10$NWlJYBmNta9BbyxDUTMCG.0LKlAt0DbLA57wkV8R3bCsv6p1Na.Mu', '2024-08-19 20:03', '2024-08-19 20:04'),
(13, 'Rizky Ridho', 'rizky_ridho', 'rizkyridho@gmail.com', '087609542313', '$2y$10$GpAmOCir8F9LXpFXbLI9ZOTAkjzIIiZqy4QKy9yg8Qxbo3IT3DcQK', '2024-08-19 20:05', '2024-08-19 20:06'),
(14, 'Nathan Tjoe A On', 'nathantjoeaon', 'nathantjoeaon@gmail.com', '07665648777', '$2y$10$RMQqjKpgIdilffnWZzX5huQ9ZfkrwzW1VasIBKOk/aiNETpZQAzZ.', '2024-08-20 20:20', '2024-08-20 20:23'),
(15, 'Marteen Paes', 'Paes', 'bangpaes@gmail.com', '017234642233', '$2y$10$7hycmPGsQyjt/s8KnUGN.Ol0TKdQciEpy15vU5D2b53QCOhnmcuQ6', '2024-08-19 20:09', '2024-08-19 20:10'),
(18, 'Ir. H. Joko Widodo', 'jokowi', 'jokowidodo@gmail.com', '081234567897', '$2y$10$wWenz.VY9ft2h2.4whHmMO26q0vEeh5mTP0W2B34A4kXovBGnbqiC', '2024-11-30 08:42', '2024-11-30 08:21'),
(19, 'Andi Alif', 'andiomi24', 'andialifkhalifahtullah@gmail.com', '011664433990', '$2y$10$C0gVUdkbP88d3B3YcN3woOOVa//ke8C8anyfKcK.NeU06AdJO8vAW', '2024-09-16 14:31', '2024-09-16 14:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
