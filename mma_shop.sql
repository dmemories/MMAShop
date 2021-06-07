-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 04:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mma_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_group_id` tinyint(11) NOT NULL,
  `member_level` tinyint(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_group_id`, `member_level`, `email`, `password`, `fullname`, `tel`, `address`) VALUES
(21, 2, 99, 'spyhack1234567@gmail.com', '1234', 'Al kaiser', '1112', '24 หมู่ 5 ซ.วาดสนิท ถ.รถไฟสายเก่า ต.สำโรง อำเภอพระประแดง จังหวัดสมุทรปราการ 10130'),
(22, 1, 0, 'spyhack13@gmail.com', '1234', 'Dear', '12922222999', 'Xxxjdj');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail_status`
--

CREATE TABLE `orderdetail_status` (
  `orderdetail_status_id` int(11) NOT NULL,
  `status_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetail_status`
--

INSERT INTO `orderdetail_status` (`orderdetail_status_id`, `status_name`) VALUES
(1, 'รอการชำระเงิน'),
(2, 'รอการตรวจสอบชำระเงิน'),
(3, 'ชำระเงินสำเร็จ / จัดส่งสินค้า');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `orderdetail_id` int(11) NOT NULL,
  `datetime` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `orderdetail_status_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`orderdetail_id`, `datetime`, `orderdetail_status_id`, `member_id`, `fullname`, `tel`, `address`, `payment_date`) VALUES
(1, '2021-04-06 16:28:51', 1, 21, 'Al kaiser', '097-101-8542', '24 หมู่ 5 ซ.วาดสนิท ถ.รถไฟสายเก่า ต.สำโรง อำเภอพระประแดง จังหวัดสมุทรปราการ 10130', ''),
(2, '2021-04-06 15:53:46', 1, 21, 'Al kaiser', '1112', 'sam', ''),
(3, '2021-04-06 15:57:40', 3, 21, 'Al kaiser', '1112', 'sam', ''),
(4, '2021-04-06 17:24:16', 2, 21, 'Al kaiser', '1112', '24 หมู่ 5 ซ.วาดสนิท ถ.รถไฟสายเก่า ต.สำโรง อำเภอพระประแดง จังหวัดสมุทรปราการ 10130', '2021-04-06 17:24:16'),
(5, '2021-04-06 17:26:48', 2, 21, 'Al kaiser', '1112', '24 หมู่ 5 ซ.วาดสนิท ถ.รถไฟสายเก่า ต.สำโรง อำเภอพระประแดง จังหวัดสมุทรปราการ 10130', '2021-04-06 17:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_color_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` float NOT NULL,
  `product_detail` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_type_id`, `product_color_id`, `product_name`, `product_price`, `product_detail`) VALUES
(1, 1, '1,2,3', 'Crossbody Bag', 500.5, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis dolorem iusto ab nisi sapiente aut est a ullam beatae eius.'),
(2, 1, '1,2', 'Double Mini Bag', 99.5, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis dolorem iusto ab nisi sapiente aut est a ullam beatae eius.'),
(3, 1, '2', 'Flip Bag', 222, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis dolorem iusto ab nisi sapiente aut est a ullam beatae eius.'),
(4, 1, '1', 'Mini Bag', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis dolorem iusto ab nisi sapiente aut est a ullam beatae eius.'),
(5, 2, '1', 'Strap', 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis dolorem iusto ab nisi sapiente aut est a ullam beatae eius.'),
(6, 2, '1', 'Strap Mini', 51, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis dolorem iusto ab nisi sapiente aut est a ullam beatae eius.'),
(7, 2, '1', 'Srap Card Frame', 52, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis dolorem iusto ab nisi sapiente aut est a ullam beatae eius.');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `product_color_id` int(11) NOT NULL,
  `color_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`product_color_id`, `color_name`) VALUES
(1, 'black'),
(2, 'white'),
(3, 'olive green');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `order_id` int(11) NOT NULL,
  `orderdetail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_color_id` int(11) NOT NULL,
  `current_price` float NOT NULL,
  `order_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`order_id`, `orderdetail_id`, `product_id`, `product_color_id`, `current_price`, `order_amount`) VALUES
(57, 1, 6, 1, 51, 3),
(58, 1, 7, 1, 52, 4),
(59, 2, 4, 1, 50, 2),
(60, 3, 4, 1, 50, 1),
(61, 4, 4, 1, 50, 1),
(62, 5, 4, 1, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `type_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `type_name`) VALUES
(1, 'bag'),
(2, 'accessory');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `orderdetail_status`
--
ALTER TABLE `orderdetail_status`
  ADD UNIQUE KEY `orderdetail_status_id` (`orderdetail_status_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD UNIQUE KEY `orderdetail_id` (`orderdetail_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`product_color_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `product_color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
