-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2025 at 03:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thdc_hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `opd_reg_no` varchar(20) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `medicine` varchar(200) DEFAULT NULL,
  `lab_test` varchar(200) DEFAULT NULL,
  `status` enum('pending','completed','not_available') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `opd_reg_no` varchar(20) NOT NULL,
  `reg_date` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `category` enum('A','B') NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `workplace` varchar(100) DEFAULT NULL,
  `recommended_doctor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`opd_reg_no`, `reg_date`, `name`, `age`, `gender`, `mobile`, `email`, `category`, `employee_name`, `relationship`, `workplace`, `recommended_doctor`) VALUES
('OPD-462965', '2025-07-15 21:50:00', 'Anshika', 20, 'Female', '7890123455', 'abc@gmail.com', 'A', 'anshii', 'Self', 'Na', 'dr gulati'),
('OPD-973433', '2025-07-15 21:45:00', 'Vishal Kumar', 22, 'Male', '7461932895', 'luckyrounak2895@gmail.com', 'A', 'vishu', 'Self', 'abcd', 'dr gulati');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('receptionist','doctor','pharmacist','lab','patient','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin123', '$2y$10$JkBrufU48zN8EmlLX7T3MulRSv2dJJfqeWZEan7T9IF6fDoU/YhKq', 'admin'),
(2, 'dr.tehri', '$2y$10$YbLwcIjeIn8YJON1KMwFH.l1UWVikX5Lg3Yuvw18up.Cuu88SuyjC', 'doctor'),
(3, 'reception1', '$2y$10$dF3kgKbXrUqPSb0ZC.jjMe4mGLxq7FrDhLGqC4SkHF8ryI84mFa7a', 'receptionist'),
(4, 'rec1', '$2y$10$RUHf56f26QBw2aYNtedtGuCDli9/ccBq26yf9VaCvRjwH10bpsrJa', 'receptionist'),
(5, 'dr vishu', '$2y$10$d4Ct6X/jRpt.oOMab585Rut0696hn.jOaNkcsv0F3ExEQRu.oAKla', 'doctor'),
(6, 'user123', '$2y$10$8MhUf9reozpL5azUv3qbI.8jkT6x9YBxPOZwI5oWIdHdDn8eMvtI2', 'pharmacist'),
(7, 'lab', '$2y$10$zVO8P30XgJgYird6/vEHR.8aLeTBwJg4Zbu2ydbFPt/U6097gQcGa', 'lab'),
(8, 'phar', '$2y$10$4tKhUIaSGfbazZ3nqLGmEORgXK1uZyU0yejdGMG3TLrLu5kS90JBO', 'pharmacist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opd_reg_no` (`opd_reg_no`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`opd_reg_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`opd_reg_no`) REFERENCES `registrations` (`opd_reg_no`),
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
