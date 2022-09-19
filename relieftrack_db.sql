-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 07:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `relieftrack_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `households`
--

CREATE TABLE `households` (
  `id` int(30) NOT NULL,
  `address` text NOT NULL,
  `street` text NOT NULL,
  `baranggay` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `households`
--

INSERT INTO `households` (`id`, `address`, `street`, `baranggay`, `city`, `state`, `zip_code`, `status`) VALUES
(77, '1230', 'dipitan st', 'San Isidro', 'Paranaque', '1006', '1006', 'Success'),
(78, '131', 'San Antonio Ave.', 'Don Bosco', 'Paranaque', '1715', '1715', 'Success'),
(79, '42', 'Palm Spring', '201', 'Paranaque', '1700', '1700', 'Pending'),
(80, '89', 'Buena Vida', 'Merville Park', 'Paranaque', '1709', '1709', 'Pending'),
(81, '1714', 'Ceylon', 'Aeropark', 'Paranaque', '1714', '1714', 'Pending'),
(82, '1701', 'Buena Castro St.', 'Don Galo', 'Paranaque', '1700', '1700', 'Pending'),
(83, '4310', 'Dimatimbangan St.', 'Don Galo', 'Paranaque', '1700', '1700', 'Pending'),
(84, '4304', 'Juan Gabriel St.', 'Don Galo', 'Paranaque', '1700', '1700', 'Pending'),
(85, '4000', 'Villamar 2nd St.', 'Don Galo', 'Paranaque', '1700', '1700', 'Pending'),
(86, '4100', 'A. Bonifacio st. ', 'San Dionisio', 'Paranaque', '1700', '1700', 'Pending'),
(87, '4204', 'Aldana St.', 'San Dionisio', 'Paranaque', '1700', '1700', 'Pending'),
(88, '421', 'Pitong Gatang St.', 'San Dionisio', 'Paranaque', '1700', '1700', 'Pending'),
(89, '505', 'I. Capistrano St.', 'San Dionisio', 'Paranaque', '1700', '1700', 'Pending'),
(90, '231', 'Buenventura', 'San Dionisio', 'Paranaque', '1700', '1700', 'Pending'),
(91, '17', 'E Montilla', 'Pitong Daan BF', 'Paranaque', '1709', '1709', 'Pending'),
(92, '207 E', 'Aldrin', 'Moonwalk Village', 'Paranaque', '1709', '1709', 'Pending'),
(93, '24', 'John', 'Multinational Village', 'Paranaque', '1709', '1709', 'Pending'),
(94, '39 A', 'Indonesia', 'Better Living', 'Paranaque', '1711', '1711', 'Pending'),
(95, '189', 'Dona Soledad', 'Better Living', 'Paranaque', '1711', '1711', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `tracking_id` text NOT NULL,
  `address` text NOT NULL,
  `street` text NOT NULL,
  `baranggay` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` text NOT NULL,
  `status` text NOT NULL,
  `reliefpacks` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `date_created`, `tracking_id`, `address`, `street`, `baranggay`, `city`, `state`, `zip_code`, `status`, `reliefpacks`) VALUES
(77, '2022-07-28 22:39:00', '548854578999\n', '1230', 'dipitan st', 'San Isidro', 'Paranaque', '1006', '1006', 'Success', 1),
(78, '2022-07-28 22:40:27', '120713216081\n', '131', 'San Antonio Ave.', 'Don Bosco', 'Paranaque', '1715', '1715', 'Success', 1);

-- --------------------------------------------------------

--
-- Table structure for table `relief_goods`
--

CREATE TABLE `relief_goods` (
  `no_of_relief_packs` int(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relief_goods`
--

INSERT INTO `relief_goods` (`no_of_relief_packs`, `id`) VALUES
(50, 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1 = Admin, 2= establishment_staff',
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `type`, `username`, `password`) VALUES
(1, 'Administrator', 1, 'admin', '0192023a7bbd73250516f069df18b500'),
(24, 'staff', 2, 'staff', '202cb962ac59075b964b07152d234b70'),
(25, 'staff2', 2, 'staff2', '8bc01711b8163ec3f2aa0688d12cdf3b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `households`
--
ALTER TABLE `households`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relief_goods`
--
ALTER TABLE `relief_goods`
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
-- AUTO_INCREMENT for table `households`
--
ALTER TABLE `households`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `relief_goods`
--
ALTER TABLE `relief_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
