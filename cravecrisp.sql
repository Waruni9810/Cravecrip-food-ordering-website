-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 04:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cravecrisp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_register_data`
--

CREATE TABLE `admin_register_data` (
  `user_id` int(10) NOT NULL,
  `title` varchar(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_register_data`
--

INSERT INTO `admin_register_data` (`user_id`, `title`, `fullname`, `email`, `password`, `address`, `phone`) VALUES
(0, 'Mr.', 'Deshan Asanka', 'dekkabiz99@gmail.com', '$2y$10$awSBFjo6mX8FInTXhRByveVSr0wXxLLKf7LQlkfO3X8qtqr/f4x1e', '29/a/63', 756994979);

-- --------------------------------------------------------

--
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `beverages_id` varchar(10) NOT NULL,
  `beverages_image` varchar(100) NOT NULL,
  `beverages_name` varchar(100) NOT NULL,
  `beverages_ingredients` varchar(500) NOT NULL,
  `beverages_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beverages`
--

INSERT INTO `beverages` (`beverages_id`, `beverages_image`, `beverages_name`, `beverages_ingredients`, `beverages_price`) VALUES
('#b01', 'images/Chicken/chicken2.png', 'pepsi', 'pepsi', 200),
('#be01', 'images/Chicken/chicken2.png', 'sprite', 'sprite', 200),
('#be02', 'images/Chicken/chicken2.png', 'coc', 'cbnh', 150);

-- --------------------------------------------------------

--
-- Table structure for table `burger`
--

CREATE TABLE `burger` (
  `burger_id` varchar(10) NOT NULL,
  `burger_image` varchar(100) NOT NULL,
  `burger_name` varchar(100) NOT NULL,
  `burger_ingredients` varchar(500) NOT NULL,
  `burger_price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `burger`
--

INSERT INTO `burger` (`burger_id`, `burger_image`, `burger_name`, `burger_ingredients`, `burger_price`) VALUES
('#B02', 'images/Chicken/chicken2.png', 'big boss burger', 'chicken', '1999');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_count` int(10) NOT NULL,
  `cart_image` varchar(250) NOT NULL,
  `cart_name` varchar(100) NOT NULL,
  `cart_price` int(10) NOT NULL,
  `cart_quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_count`, `cart_image`, `cart_name`, `cart_price`, `cart_quantity`) VALUES
(1, 'images/Chicken/chicken1.png', 'Fried Chicken', 100, 5),
(2, 'images/Chicken/chicken2.png', 'Thandoori Chicken', 50, 3);

-- --------------------------------------------------------

--
-- Table structure for table `chicken`
--

CREATE TABLE `chicken` (
  `chicken_id` varchar(10) NOT NULL,
  `chicken_image` varchar(100) NOT NULL,
  `chicken_name` varchar(100) NOT NULL,
  `chicken_ingredients` varchar(500) NOT NULL,
  `chicken_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chicken`
--

INSERT INTO `chicken` (`chicken_id`, `chicken_image`, `chicken_name`, `chicken_ingredients`, `chicken_price`) VALUES
('#C02', 'images/Chicken/chicken2.png', 'Fried Chicken', 'Indulge in the ultimate satisfaction of our delectable Fried Chicken—crispy perfection with juicy, flavorful meat.', 5555);

-- --------------------------------------------------------

--
-- Table structure for table `contactdata`
--

CREATE TABLE `contactdata` (
  `id` int(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactdata`
--

INSERT INTO `contactdata` (`id`, `firstname`, `lastname`, `phone`, `email`, `message`) VALUES
(1, 'dd', 'gfd', 4, 'ft@gmail.com', 'h'),
(2, 'dd', 'gfd', 4, 'ft@gmail.com', 'jh'),
(3, 'deshan', 'asanka', 750603138, 'midai000006@gmail.com', 'haaai'),
(4, 'deshan', 'asanka', 750603138, 'www.deshan991226@gmail.co', '4'),
(5, 'deshan', 'asanka', 750603138, 'midai000006@gmail.com', 'zs'),
(6, 'deshan', 'asanka', 750600313, 'midai000006@gmail.com', 'k'),
(7, 'deshan', 'asanka', 750603138, 'midai000006@gmail.com', 'fgh'),
(8, 'deshan', 'asanka', 750603138, 'midai000006@gmail.com', 'fgh'),
(9, 'deshan', 'asanka', 750603138, 'midai000006@gmail.com', 'fgh'),
(10, 'deshan', 'asanka', 750603138, 'waruniranjala@gmail.com', 'AD'),
(11, 'deshan', 'asanka', 750603138, 'waruniranjala@gmail.com', 'AD'),
(12, 'fgh', 'fgh', 750603138, 'waruniranjala@gmail.com', 'asf'),
(13, 'fgh', 'fgh', 750603138, 'waruniranjala@gmail.com', 'asf');

-- --------------------------------------------------------

--
-- Table structure for table `register_data`
--

CREATE TABLE `register_data` (
  `user_id` int(10) NOT NULL,
  `title` varchar(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register_data`
--

INSERT INTO `register_data` (`user_id`, `title`, `fullname`, `email`, `password`, `address`, `phone`) VALUES
(1, 'Mr.', 'Deshan', 'midai000006@gmail.com', '12345678', 'ampara', 750603138),
(3, 'Mr.', 'Deshan', 'midai000007@gmail.com', '12345678', 'ampara', 750603138),
(4, 'Mrs.', 'waruni', 'waruniranjala@gmail.com', '12345678', 'gall', 750603138),
(5, 'Mrs.', 'dd gfd', 'ft@gmail.com', '12345678', 'asd', 756994979),
(6, 'Rev.', 'dd gfd', 'xxxxx@gmail.com', '12345678', 'asd', 756994979),
(7, 'Rev.', 'dd gfd', 'zzzxxxx@gmail.com', '12345678', 'asd', 756994979),
(8, 'Rev.', 'dd gfd', 'ggggggggggg@gmail.com', '12345678', 'asd', 756994979),
(9, 'Mrs.', 'dd gfd', 'hhhhhhhhhh@gmail.com', '12345678', 'asd', 756994979),
(10, 'Mrs.', 'dd gfd', 'ttttttttttt@gmail.com', '12345678', 'asd', 756994979),
(11, 'Mrs.', 'dd gfd', 'aaaaaaaaaaa@gmail.com', '12345678', 'asd', 756994979),
(12, 'Mrs.', 'dd gfd', 'bbbbbbaaaaa@gmail.com', '12345678', 'asd', 756994979),
(13, 'Mrs.', 'dd gfd', 'mmmmmmmmm@gmail.com', '$2y$10$az6Ibyh4fGcivsXjTAE56Ox3h5Zlnk5eeDTWUvs5Uc6x4I5.XpUx2', 'asd', 756994979),
(14, 'Mr.', 'Deshan Asanka', 'dekkabiz99@gmail.com', '$2y$10$hIXM9eYRJVvplRu5abtL3OXXWlhKgJKvkOIji2Awzfhlx2ELeLkMC', '29/a/63', 756994979);

-- --------------------------------------------------------

--
-- Table structure for table `snacks`
--

CREATE TABLE `snacks` (
  `snacks_id` varchar(10) NOT NULL,
  `snacks_image` varchar(100) NOT NULL,
  `snacks_name` varchar(100) NOT NULL,
  `snacks_ingredients` varchar(500) NOT NULL,
  `snacks_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `snacks`
--

INSERT INTO `snacks` (`snacks_id`, `snacks_image`, `snacks_name`, `snacks_ingredients`, `snacks_price`) VALUES
('#s01', 'images/Chicken/chicken2.png', 'Potato chips', 'potato', 100),
('#s02', 'images/Chicken/chicken2.png', 'chips', 'sdg', 150),
('#s03', 'images/Chicken/chicken2.png', 'Pot chips', 'cg', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_register_data`
--
ALTER TABLE `admin_register_data`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `beverages`
--
ALTER TABLE `beverages`
  ADD PRIMARY KEY (`beverages_id`);

--
-- Indexes for table `burger`
--
ALTER TABLE `burger`
  ADD PRIMARY KEY (`burger_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_count`);

--
-- Indexes for table `chicken`
--
ALTER TABLE `chicken`
  ADD PRIMARY KEY (`chicken_id`);

--
-- Indexes for table `contactdata`
--
ALTER TABLE `contactdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_data`
--
ALTER TABLE `register_data`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `snacks`
--
ALTER TABLE `snacks`
  ADD PRIMARY KEY (`snacks_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_count` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contactdata`
--
ALTER TABLE `contactdata`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `register_data`
--
ALTER TABLE `register_data`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
