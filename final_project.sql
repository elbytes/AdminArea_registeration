-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2020 at 04:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Tools & Home Improvement'),
(2, 'Electronics'),
(3, 'Clothing'),
(4, 'Home & Kitchen'),
(5, 'Smart Home'),
(6, 'Food & Grocery'),
(7, 'Toys'),
(8, 'Health & Beauty');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_city` varchar(33) NOT NULL,
  `customer_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_address`, `customer_city`, `customer_status`) VALUES
(1, 'John Lennon', '2889  Thompson Street', 'Liverpool', '1'),
(2, 'Paul McCartney', '439  American Drive', '&lt;b&gt;Walton&lt;/b&gt;', '0'),
(3, 'Ringo Starr', '673  Simpson Avenue', 'Dingle', '0'),
(4, 'George Harrison', '12 Arnold Grove\r\n', 'Wavertree', '0'),
(9, 'James Hetfield', '123 Sesame Street', 'Redwood City', '1'),
(24, 'Karl Marx', '7647 Amerige Dr', 'Hyattsville', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_status`, `order_date`, `customer_id`) VALUES
(1, 0, '2020-11-22 05:18:34', 1),
(2, 1, '2020-11-22 05:18:34', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(11,0) NOT NULL,
  `product_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `product_category`) VALUES
(1, 'Pipe and Tube Cutter', '14', 1),
(2, 'Micro Cutter Flush Cutter', '7', 1),
(3, 'Impact Driver Bit Set', '17', 1),
(4, 'Karaoke Wireless Bluetooth Amplifier', '78', 2),
(5, 'Gaming headset', '32', 2),
(6, 'Wireless charger', '24', 2),
(7, 'Wrangler Boys’ Cargo Pant', '24', 3),
(8, 'Lacoste Men\'s Sweatshirt', '130', 3),
(9, 'Signature by Levi Boys Jeans', '19', 3),
(10, 'Decorative Wall Clock Quartz', '33', 4),
(11, 'Expert Swivel Chair', '76', 4),
(12, 'Industrial ladder shelf', '60', 4),
(13, 'Wireless Thermometer Hygrometer', '14', 5),
(14, 'Smart LED lightbulbs', '36', 5),
(15, 'Google Nest Learning Thermostat', '239', 5),
(16, 'Dole Bananas', '5', 6),
(17, 'Lean groundTurkey', '10', 6),
(18, 'Honey Maid Graham Crackers', '5', 6),
(23, 'Paint Your Own Small Wooden Birdhouses', '30', 7),
(24, 'LEGO Classic Medium Creative Brick Box', '28', 7),
(25, '20 Piece Animals Wooden Puzzles', '7', 7),
(26, 'Lancaster Sun Beauty Velvet Fluid Milk', '27', 8),
(27, 'Manhattan Clear Face Perfect', '10', 8),
(28, 'Solimo Eye Makeup Remover', '4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `user_created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_created_time`) VALUES
(1, 'a', '$2y$10$LvMLUGf6K8St95a4geMK4ee5gN0IVtIjZFActDoZlgCRHJsFfywKO', '2020-11-21 00:00:00'),
(2, 'b', '$2y$10$Fycrg1KBMYN7gqaJLEhdlueTh5rxdOsJLWM5gT1Ms8HHgExbXwPLC', '2020-11-21 01:22:29'),
(3, 'a', '$2y$10$9FeN5IeH8g/oFWrC.GSHJO2Q9kEArPn2vHMGffzLlvBcf6S25M7zG', '2020-11-21 09:36:02'),
(5, 'test', '$2y$10$VCSmsPBG5jmE1WnG7J7AuOVgfUm9qFlczk7rtuqK17GMkiVBTkrMu', '2020-11-22 03:43:14'),
(7, 'very new user', '$2y$10$gOIjlhZFAOLB5x4xOYnDYOS2l1pkz9zYuJl9bb.E7DhIV7RddS2UK', '2020-11-23 00:21:28'),
(8, 'very new user', '$2y$10$5PP8E0.bKvuk8aFeZ0cavuU1iudd2cN3oAWcupSt2TLs2DS.rBtJ6', '2020-11-23 00:22:43'),
(9, 'another test', '$2y$10$wGGfjf/kPQfqTn4tRligB.A9K3B15JCgGrjrEJzBAaDALVzqNZysO', '2020-11-23 00:23:58'),
(10, 'another test', '$2y$10$dN0t84RlQdJ9S7cdEcVGqe4IGkWVWy5JSVFGHezcrHRjqXuuUM3B6', '2020-11-23 00:24:28'),
(11, 'another test', '$2y$10$ddJqJHJj.8HkIiWORs06I.UX1Cuv4c368Otd9OASeL4.BpzZ5kkYO', '2020-11-23 00:26:13'),
(15, 'triple', '$2y$10$eAruB6yyJBNSTKEoDfc2wO7fKWXuIgS56CwyvuQTpbHIhvhhasySe', '2020-11-23 00:27:39'),
(16, '111', '$2y$10$PJcAeg8EgCBJhHlmqAjzf.XIlrfVASHniHmtaGN6kKzif6cHVRQKG', '2020-11-23 18:36:58'),
(18, 'El', '$2y$10$lzLauOTy4xfbCuoMH5FYK.1OaaZfEq80hZXN.KLYAE3uQBkGaIEqO', '2020-11-23 21:57:42'),
(21, 'ssss', '$2y$10$d5/nWMRMSAi3vaXQ0Blhv.LiODNrT/Kc3CjTQ7hEIZq0r8rl8yhUS', '2020-11-23 22:20:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
