-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 11:21 AM
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
  `qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos-menu`
--

INSERT INTO `pos-menu` (`menu_no`, `code`, `title1`, `title2`, `label`, `label2`, `price1`, `price2`, `price3`, `image`, `qty`) VALUES
(1, 'A001', 'Peperoni', 'Pizza', 'Food', 'Pizza', 150, 300, 900, './foods/pizza.jpg', 5),
(2, 'A002', 'Cheese', 'Burger', 'Food', 'Burger', 100, 180, 250, './foods/burger.jpg', 4),
(3, 'B001', 'Americano', 'Coffee', 'Beverages', 'Coffee', 80, 120, 150, './foods/americano.jpg', 9),
(4, 'B002', 'Cappuccino', 'Coffee', 'Beverages', 'Coffee', 80, 120, 150, './foods/cappuccino.jpg', 0),
(5, 'B003', 'Spanish', 'Latte', 'Beverages', 'Coffee', 80, 120, 150, './foods/latte.jpg', 0),
(6, 'B004', 'Hazelnut', 'Latte', 'Beverages', 'Coffee', 80, 120, 150, './foods/hazelnut-latte.jpg', 0),
(7, 'U001', 'Sisig', 'Beef', 'Food', 'Ulam', 250, 450, 900, './foods/sisig.jpg', 0),
(8, 'P001', 'Carbonara', 'Pasta', 'Food', 'Pasta', 150, 300, 500, './foods/carbonara.jpg', 19),
(9, 'P002', 'Spaghetti', 'Pasta', 'Food', 'Pasta', 150, 300, 500, './foods/spagheti.jpg', 0),
(10, 'P003', 'Miki', 'Pasta', 'Food', 'Pasta', 150, 300, 500, './foods/pansit-miki.jpg', 14),
(11, 'D001', 'Buko Pandan', 'Salad', 'Food', 'Dessert', 50, 90, 150, './foods/buko-pandan.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `remit_sales`
--

CREATE TABLE `remit_sales` (
  `remit_id` int(255) NOT NULL,
  `cashier_name` varchar(255) NOT NULL,
  `total_sales` varchar(255) NOT NULL,
  `remit_date` varchar(255) NOT NULL,
  `remit_shortage` int(255) NOT NULL,
  `validation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `items_ordered` varchar(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `amount_paid` int(255) NOT NULL,
  `amount_change` int(255) NOT NULL,
  `order_take` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_sales`
--

INSERT INTO `total_sales` (`total_order`, `receipt_number`, `date`, `time`, `cashier_name`, `items_ordered`, `total_amount`, `amount_paid`, `amount_change`, `order_take`) VALUES
(99, '1', '11/16/2024', '3:42:45 PM', 'Mike', '[{\"order_name\":\"Peperoni\",\"order_name2\":\"Pizza\",\"order_quantity\":\"x2\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons2\":\"Bacon\",\"order_addons_price2\":\"20\",\"order_addons3\":\"Olives\",\"order_addons_price3\":\"10\"}]', 165, 500, 335, 'Dine In'),
(100, '100', '11/17/2024', '4:58:51 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\",\"order_price\":\"100\"}]', 100, 500, 400, 'Take Out'),
(101, '101', '11/17/2024', '4:59:10 PM', 'Mike', '[{\"order_name\":\"Miki\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons_price\":\"0\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\",\"order_price\":\"150\"}]', 150, 500, 350, 'Take Out'),
(102, '102', '11/17/2024', '4:59:31 PM', 'Mike', '[{\"order_name\":\"Carbonara\",\"order_name2\":\"Pasta\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons2\":\"Bacon\",\"order_addons_price2\":\"20\",\"order_addons3\":\"Olives\",\"order_addons_price3\":\"1\"}]', 165, 500, 335, 'Take Out'),
(103, '103', '11/17/2024', '5:13:41 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons_price2\":\"0\",\"order_addons_price3\":\"0\",\"order_price\":\"115\"}]', 115, 500, 385, 'Take Out'),
(104, '104', '11/17/2024', '5:13:54 PM', 'Mike', '[{\"order_name\":\"Peperoni\",\"order_name2\":\"Pizza\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons2\":\"Bacon\",\"order_addons_price2\":\"20\",\"order_addons3\":\"Olives\",\"order_addons_price3\":\"10\",\"or', 165, 500, 335, 'Take Out'),
(105, '105', '11/17/2024', '5:25:39 PM', 'Mike', '[{\"order_name\":\"Cheese\",\"order_name2\":\"Burger\",\"order_quantity\":\"x1\",\"order_size\":\"Regular\",\"order_addons\":\"Extra Cheese\",\"order_addons_price\":\"15\",\"order_addons2\":\"Bacon\",\"order_addons_price2\":\"20\",\"order_addons3\":\"Olives\",\"order_addons_price3\":\"10\"}]', 115, 500, 385, 'Take Out');

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
  MODIFY `order_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `pos-menu`
--
ALTER TABLE `pos-menu`
  MODIFY `menu_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `total_sales`
--
ALTER TABLE `total_sales`
  MODIFY `total_order` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user-staff`
--
ALTER TABLE `user-staff`
  MODIFY `staff_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
