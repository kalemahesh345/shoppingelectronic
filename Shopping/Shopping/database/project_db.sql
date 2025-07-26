-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 06:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `image`, `quantity`) VALUES
(6, 1, 'smart LED flat TV', '300.00', 'product-6.jpg', 2),
(10, 3, 'premium watch white colored', '100.00', 'product-2.jpg', 1),
(11, 3, 'nikon hd camera black', '150.00', 'product-3.jpg', 1),
(12, 3, 'smart LED flat TV', '300.00', 'product-6.jpg', 3),
(13, 4, 'smart LED flat TV', '300.00', 'product-6.jpg', 1),
(15, 4, 'premium wired headset', '50.00', 'product-5.jpg', 1),
(16, 4, 'smartphone 4GB ram/64 rom', '250.00', 'product-1.jpg', 1),
(17, 4, 'premium watch white colored', '100.00', 'product-2.jpg', 1),
(19, 5, 'smartphone 4GB ram/64 rom', '250.00', 'product-1.jpg', 2),
(34, 2, 'premium wired headset', '50.00', 'product-5.jpg', 3),
(35, 7, 'smartphone 4GB ram/64 rom', '250.00', 'product-1.jpg', 1),
(36, 7, 'smart LED flat TV', '300.00', 'product-6.jpg', 1),
(37, 2, 'smartphone 4GB ram/64 rom', '250.00', 'product-1.jpg', 1),
(38, 2, 'Wireless Mouse', '25.00', 'product-8.jpg', 1),
(39, 2, 'Bluetooth Keyboard', '45.00', 'product-9.jpg', 1),
(40, 2, 'smart LED flat TV', '300.00', 'product-6.jpg', 2),
(45, 10, 'Wireless Mouse', '25.00', 'product-8.jpg', 1),
(46, 10, 'Bluetooth Keyboard', '45.00', 'product-9.jpg', 1),
(47, 10, 'premium watch white colored', '100.00', 'product-2.jpg', 1),
(49, 10, 'smartphone 4GB ram/64 rom', '250.00', 'product-1.jpg', 1),
(51, 11, 'Wireless Mouse', '25.00', 'product-8.jpg', 13),
(52, 11, 'smart speaker black', '80.00', 'product-4.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'smartphone 4GB ram/64 rom', 250.00, 'product-1.jpg'),
(2, 'premium watch white colored', 100.00, 'product-2.jpg'),
(3, 'nikon hd camera black', 150.00, 'product-3.jpg'),
(4, 'smart speaker black', 80.00, 'product-4.jpg'),
(5, 'premium wired headset', 50.00, 'product-5.jpg'),
(6, 'smart LED flat TV', 300.00, 'product-6.jpg'),
(7, 'Wireless Mouse', 25.00, 'product-8.jpg'),
(8, 'Bluetooth Keyboard', 45.00, 'product-9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_from`
--

CREATE TABLE `user_from` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_from`
--

INSERT INTO `user_from` (`id`, `name`, `email`, `password`) VALUES
(13, 'prasad wandhekar', 'prasad12@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(14, 'Prasad', 'prasad123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(15, 'vaishu', 'vaishu123@gmail', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_from`
--
ALTER TABLE `user_from`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_from`
--
ALTER TABLE `user_from`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
