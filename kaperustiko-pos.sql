-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 12:16 PM
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
-- Database: `kaperustiko-pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_no` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_name2` varchar(255) NOT NULL,
  `order_quantity` int(255) NOT NULL,
  `order_size` varchar(255) NOT NULL,
  `basePrice` int(255) NOT NULL,
  `order_price` int(255) NOT NULL,
  `order_addons` varchar(255) NOT NULL,
  `order_addons_price` int(255) NOT NULL,
  `order_image` varchar(255) NOT NULL,
  `order_addons2` varchar(255) NOT NULL,
  `order_addons_price2` int(255) NOT NULL,
  `order_addons3` varchar(255) NOT NULL,
  `order_addons_price3` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos-menu`
--

CREATE TABLE `pos-menu` (
  `menu_no` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `label2` varchar(255) NOT NULL,
  `price1` int(255) NOT NULL,
  `price2` int(255) NOT NULL,
  `price3` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `stock_date` varchar(255) NOT NULL,
  `stock_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos-menu`
--

INSERT INTO `pos-menu` (`menu_no`, `code`, `title1`, `title2`, `label`, `label2`, `price1`, `price2`, `price3`, `image`, `qty`, `stock_date`, `stock_time`) VALUES
(1, 'A001', 'Peperoni', 'Pizza', 'Food', 'Pizza', 150, 300, 900, './foods/pizza.jpg', 3, '11/17/2024', '07:00:38 PM'),
(2, 'A002', 'Cheese', 'Burger', 'Food', 'Burger', 100, 180, 250, './foods/burger.jpg', 0, '11/17/2024', '07:13:00 PM'),
(3, 'B001', 'Americano', 'Coffee', 'Beverages', 'Coffee', 80, 120, 150, './foods/americano.jpg', 1, '11/17/2024\r\n', '07:13:00 PM'),
(4, 'B002', 'Cappuccino', 'Coffee', 'Beverages', 'Coffee', 80, 120, 150, './foods/cappuccino.jpg', 0, '11/17/2024\r\n', '07:13:00 PM'),
(5, 'B003', 'Spanish', 'Latte', 'Beverages', 'Coffee', 80, 120, 150, './foods/latte.jpg', 0, '11/17/2024\r\n', '07:13:00 PM'),
(6, 'B004', 'Hazelnut', 'Latte', 'Beverages', 'Coffee', 80, 120, 150, './foods/hazelnut-latte.jpg', 0, '11/17/2024\r\n', '07:13:00 PM'),
(7, 'U001', 'Sisig', 'Beef', 'Food', 'Ulam', 250, 450, 900, './foods/sisig.jpg', 0, '11/17/2024\r\n', '07:13:00 PM'),
(8, 'P001', 'Carbonara', 'Pasta', 'Food', 'Pasta', 150, 300, 500, './foods/carbonara.jpg', 6, '11/17/2024\r\n', '07:13:00 PM'),
(9, 'P002', 'Spaghetti', 'Pasta', 'Food', 'Pasta', 150, 300, 500, './foods/spagheti.jpg', 0, '11/17/2024\r\n', '07:13:00 PM'),
(10, 'P003', 'Miki', 'Pasta', 'Food', 'Pasta', 150, 300, 500, './foods/pansit-miki.jpg', 12, '11/17/2024\r\n', '07:13:00 PM'),
(11, 'D001', 'Buko Pandan', 'Salad', 'Food', 'Dessert', 50, 90, 150, './foods/buko-pandan.jpg', 0, '11/17/2024\r\n', '07:13:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `remit_returns`
--

CREATE TABLE `remit_returns` (
  `return_id` int(255) NOT NULL,
  `cashier_name` varchar(255) NOT NULL,
  `total_sales` varchar(255) NOT NULL,
  `return_date` varchar(255) NOT NULL,
  `return_time` varchar(255) NOT NULL,
  `return_validation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remit_returns`
--

INSERT INTO `remit_returns` (`return_id`, `cashier_name`, `total_sales`, `return_date`, `return_time`, `return_validation`) VALUES
(1, 'Mike', '945.00', '2024-11-17', '5:17:08 PM', 'Validated'),
(2, 'Mike', '945.00', '2024-11-17', '5:17:08 PM', 'Validated'),
(3, 'Mike', '150.00', '2024-11-18', '5:43:13 PM', 'Pending'),
(4, 'Mike', '150.00', '2024-11-18', '5:45:02 PM', 'Validated');

-- --------------------------------------------------------

--
-- Table structure for table `remit_sales`
--

CREATE TABLE `remit_sales` (
  `remit_id` int(255) NOT NULL,
  `cashier_name` varchar(255) NOT NULL,
  `total_sales` varchar(255) NOT NULL,
  `remit_date` varchar(255) NOT NULL,
  `remit_time` varchar(255) NOT NULL,
  `remit_shortage` int(255) NOT NULL,
  `remit_validation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remit_sales`
--

INSERT INTO `remit_sales` (`remit_id`, `cashier_name`, `total_sales`, `remit_date`, `remit_time`, `remit_shortage`, `remit_validation`) VALUES
(11, 'Mike', '645.00', '2024-11-17', '7:08:39 PM', 255, 'Validated'),
(12, 'Mike', '165.00', '2024-11-16', '7:18:48 PM', 23, 'Pending'),
(13, 'Mike', '300.00', '2024-11-18', '5:50:13 PM', 0, 'Validated');

-- --------------------------------------------------------

--
-- Table structure for table `return-orders`
--

CREATE TABLE `return-orders` (
  `return_id` int(255) NOT NULL,
  `receipt_number` int(255) NOT NULL,
  `return_date` varchar(255) NOT NULL,
  `return_time` varchar(255) NOT NULL,
  `cashier_name` varchar(255) NOT NULL,
  `items_ordered` varchar(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `amount_paid` int(255) NOT NULL,
  `amount_change` int(255) NOT NULL,
  `order_take` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return-orders`
--

INSERT INTO `return-orders` (`return_id`, `receipt_number`, `return_date`, `return_time`, `cashier_name`, `items_ordered`, `total_amount`, `amount_paid`, `amount_change`, `order_take`) VALUES
(4, 101, '11/17/2024', '4:59:10 PM', 'Mike', '[{\"order_name\":\"Miki\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\",\"order_price\":\"150\"}]', 150, 500, 350, 'Take Out'),
(5, 100, '11/17/2024', '4:58:51 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\",\"order_price\":\"100\"}]', 100, 500, 400, 'Take Out'),
(6, 102, '11/17/2024', '4:59:31 PM', 'Mike', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons2\":\"Bacon\",\"order_addons_price2\":\"20\",\"order_addons3\":\"Olives\",\"order_addons_price3\":\"1\"}]', 165, 500, 335, 'Take Out'),
(7, 103, '11/17/2024', '5:13:41 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\",\"order_price\":\"115\"}]', 115, 500, 385, 'Take Out'),
(8, 105, '11/17/2024', '5:25:39 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons2\":\"Bacon\",\"order_addons_price2\":\"20\",\"order_addons3\":\"Olives\",\"order_addons_price3\":\"10\"}]', 115, 500, 385, 'Take Out'),
(9, 105, '11/17/2024', '9:51:40 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 100, 500, 400, 'Take Out'),
(10, 105, '11/17/2024', '9:52:46 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 100, 500, 400, 'Take Out'),
(11, 105, '11/17/2024', '10:01:22 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 100, 500, 400, 'Take Out'),
(12, 105, '11/18/2024', '3:37:27 PM', 'Mike', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 150, 500, 350, 'Take Out'),
(13, 119, '11/18/2024', '6:30:27 PM', 'Mike', '[{\"order_name\":\"Americano\",\"order_name2\":\"Coffee\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"},{\"order_name\":\"Peperoni\",\"order_name2\":\"Pizza\",\"order_quantity\":\"x1\",\"order_size\":', 380, 500, 120, 'Dine In'),
(14, 1, '11/18/2024', '6:29:12 PM', 'Mike', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons2\":\"Bacon\",\"order_addons_price2\":\"20\",\"order_addons3\":\"Olives\",\"order_addons_price3\":\"10\"}]', 195, 500, 305, 'Dine In'),
(15, 1, '11/18/2024', '6:53:18 PM', 'Mike', '[{\"order_name\":\"Americano\",\"order_name2\":\"Coffee\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"},{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\"', 380, 500, 120, 'Take Out'),
(16, 122, '11/18/2024', '6:57:02 PM', '', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 150, 500, 350, 'Take Out'),
(17, 121, '11/18/2024', '6:54:25 PM', '', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 150, 200, 50, 'Take Out');

-- --------------------------------------------------------

--
-- Table structure for table `total_sales`
--

CREATE TABLE `total_sales` (
  `total_order` int(255) NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `cashier_name` varchar(255) NOT NULL,
  `items_ordered` varchar(999) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `amount_paid` int(255) NOT NULL,
  `amount_change` int(255) NOT NULL,
  `order_take` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_sales`
--

INSERT INTO `total_sales` (`total_order`, `receipt_number`, `date`, `time`, `cashier_name`, `items_ordered`, `total_amount`, `amount_paid`, `amount_change`, `order_take`) VALUES
(123, '123', '11/18/2024', '6:59:37 PM', 'Mike', '[{\"order_name\":\"Peperoni\",\"order_name2\":\"Pizza\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 150, 500, 350, 'Take Out'),
(124, '124', '11/18/2024', '7:00:54 PM', 'sample', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 150, 200, 50, 'Take Out'),
(125, '125', '11/18/2024', '7:02:22 PM', 'sample', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 150, 200, 50, 'Take Out'),
(126, '126', '11/18/2024', '7:02:40 PM', 'sample', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"},{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\"}]', 300, 200, -100, 'Take Out');

-- --------------------------------------------------------

--
-- Table structure for table `user-staff`
--

CREATE TABLE `user-staff` (
  `staff_no` int(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contactNumber` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `staff_token` int(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user-staff`
--

INSERT INTO `user-staff` (`staff_no`, `lastName`, `middleName`, `firstName`, `password`, `contactNumber`, `email`, `staff_token`, `avatar`) VALUES
(18, 'Dayandante', 'Dalaguit', 'Mike', '$2y$10$8waarktMtnJGANyeIZeMSeS6pypgTZOicWDRmhY6Tjp.i70wrxG5a', 2147483647, 'mikedayandante@gmail.com', 18, 'default.jpg'),
(20, 'sample', 'sample', 'sample', '$2y$10$9AFAZTDhYB8pzMZ4uWK.Ceb6nOVfLXWLerh4c0aLSZmO34KriPGVW', 2147483647, 'sample@gmail.com', 20, 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_no`);

--
-- Indexes for table `pos-menu`
--
ALTER TABLE `pos-menu`
  ADD PRIMARY KEY (`menu_no`);

--
-- Indexes for table `remit_returns`
--
ALTER TABLE `remit_returns`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `remit_sales`
--
ALTER TABLE `remit_sales`
  ADD PRIMARY KEY (`remit_id`);

--
-- Indexes for table `return-orders`
--
ALTER TABLE `return-orders`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `total_sales`
--
ALTER TABLE `total_sales`
  ADD PRIMARY KEY (`total_order`);

--
-- Indexes for table `user-staff`
--
ALTER TABLE `user-staff`
  ADD PRIMARY KEY (`staff_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `pos-menu`
--
ALTER TABLE `pos-menu`
  MODIFY `menu_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `remit_returns`
--
ALTER TABLE `remit_returns`
  MODIFY `return_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `remit_sales`
--
ALTER TABLE `remit_sales`
  MODIFY `remit_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `return-orders`
--
ALTER TABLE `return-orders`
  MODIFY `return_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `total_sales`
--
ALTER TABLE `total_sales`
  MODIFY `total_order` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `user-staff`
--
ALTER TABLE `user-staff`
  MODIFY `staff_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
