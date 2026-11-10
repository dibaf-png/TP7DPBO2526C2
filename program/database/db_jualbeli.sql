-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2026 at 03:49 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jualbeli`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `no_phone` varchar(20) NOT NULL,
  `wealth_source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `no_ktp`, `no_phone`, `wealth_source`) VALUES
(1, 'H. Subur Solihin, M.T', '432678001', '081908765712', 'Hasil Tambang Nikel Ilegal & Setoran Jual Beli Izin Lahan'),
(2, 'Hj. Saras Hayati, M.Ked', '432985410', '082133445566', 'Warisan Dinasti Politik & Hasil Perkebunan Sawit Ilegal'),
(3, 'Prof. Bambang Subyanto', '432125678', '089876543210', 'Hasil Korupsi Bansos & Pinjaman Pengusaha'),
(4, 'Hj. Nur', '435991725', '087681991246', 'Hasil Monopoli Impor Beras & Hasil Perkebunan Sawit Ilegal'),
(5, 'Kurniawan, M.Pd', '432543129', '088765201154', 'Setoran Jual Beli Izin Lahan & Hasil Korupsi Bansos'),
(6, 'Dr. Harjono', '436141225', '087626589164', 'Hasil Tambang Nikel Ilegal & Hasil Monopoli Impor Beras');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `dept_code` varchar(20) NOT NULL,
  `dept_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_code`, `dept_name`) VALUES
(1, 'DPU', 'Dinas Pekerjaan Proyek Strategis'),
(2, 'DKS', 'Dinas Kesehatan dan Pengadaan Alat'),
(3, 'DIK', 'Dinas Pendidikan dan Pengelolaan Dana Hibah'),
(4, 'BGN', 'Dinas Pengadaan Bahan Pangan');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int NOT NULL,
  `department_id` int NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `quota` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `department_id`, `position_name`, `price`, `quota`) VALUES
(1, 1, 'Kepala Dinas Proyek Jalan Tol', 15000000000.00, 1),
(2, 2, 'Direktur Utama RSUD Kelas A', 12000000000.00, 1),
(3, 3, 'Kepala Dinas Pengadaan Buku dan Beasiswa', 9000000000.00, 1),
(4, 4, 'Kepala Gudang Impor Beras', 11000000000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `candidate_id` int NOT NULL,
  `position_id` int NOT NULL,
  `amount_paid` decimal(15,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `note` text,
  `status` enum('Pending','Verifikasi Mahar','Dilantik','Kena KPK') DEFAULT 'Pending',
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `candidate_id`, `position_id`, `amount_paid`, `payment_method`, `note`, `status`, `transaction_date`) VALUES
(1, 1, 1, 5000000000.00, 'Investasi Usaha Caffe', 'DP Awal 1/3 Mahar Proyek Tol', 'Verifikasi Mahar', '2026-03-01'),
(2, 2, 2, 12000000000.00, 'Transfer Offshore & Emas Batangan', 'Pelunasan Kursi Dirut RSUD Kelas A via Singapura', 'Dilantik', '2026-03-02'),
(3, 6, 3, 3000000000.00, 'Crypto USDT', 'DP Mahar Pengadaan Buku dan Beasiswa', 'Pending', '2026-03-05'),
(4, 5, 4, 5500000000.00, 'Donasi Pembangunan Panti Asuhan', 'DP 50% Disamarkan sebagai Donasi Yayasan Fiktif', 'Dilantik', '2026-10-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `position_id` (`position_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
