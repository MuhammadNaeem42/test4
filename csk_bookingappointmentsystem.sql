-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 03:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csk_bookingappointmentsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role_type` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `role_type`) VALUES
(1, 'admin@admin.com', '$2y$10$fnb.o2jNQHJPwAULY088N.wUth/ylBqoW6sSQSxyOh7cacK2EInhm', 3);

-- --------------------------------------------------------

--
-- Table structure for table `booking_list`
--

CREATE TABLE `booking_list` (
  `member_id` int(10) NOT NULL,
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `aptDate` date NOT NULL,
  `aptTime` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_list`
--

INSERT INTO `booking_list` (`member_id`, `id`, `title`, `description`, `aptDate`, `aptTime`) VALUES
(1, 2, 'Sample 102', 'Sample Description 102', '2022-10-07', '9:00 AM - 10:00 AM'),
(2, 3, 'Sample 102', 'Sample Description 102', '2022-10-08', '9:00 AM - 10:00 AM'),
(1, 4, 'Sample 102', 'Sample Description 102', '2022-10-08', '9:00 AM - 10:00 AM'),
(2, 5, 'Sample 102', 'Sample Description', '2022-10-12', '1:00 PM - 2:00 PM'),
(2, 85, 'This is a test', 'This is a test', '2022-11-18', '9:00 AM - 10:00 AM'),
(2, 92, 'asg', 'asgas', '2022-11-17', '10:00 AM - 11:00 AM'),
(2, 93, 'asgas', 'gasga', '2022-11-17', '10:00 AM - 11:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `booking_slots`
--

CREATE TABLE `booking_slots` (
  `aptSlots` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_slots`
--

INSERT INTO `booking_slots` (`aptSlots`) VALUES
('2022-11-10'),
('2022-11-20'),
('2022-11-21'),
('2022-11-22'),
('2022-11-23'),
('2022-11-17'),
('2022-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_bi`
--

CREATE TABLE `enquiry_bi` (
  `BI_Outlet_ID` int(255) NOT NULL,
  `BI_Outlet_name` varchar(255) NOT NULL,
  `BI_operating_time` varchar(255) NOT NULL,
  `BI_phoneNo` int(255) NOT NULL,
  `BI_Email` varchar(255) NOT NULL,
  `BI_Location` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry_bi`
--

INSERT INTO `enquiry_bi` (`BI_Outlet_ID`, `BI_Outlet_name`, `BI_operating_time`, `BI_phoneNo`, `BI_Email`, `BI_Location`) VALUES
(1, 'Cacti-Succulent kuching', 'Monday - Friday | 9am - 9pm', 8888888, 'isnowypanterx@gmail.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63815.574538863766!2d110.25891013125!3d1.4877164000000023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fb0bfe6c7989b1%3A0xddaf7e6f55cb2195!2zVGhlIEdvbGRlbiBCbG9vbSBHYXJkZW5zIC0g6YeR5py16Iqx5Zut!5e0!3m2!1sen!2smy!4v1668431855943!5m2!1sen!2smy');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_faqs`
--

CREATE TABLE `enquiry_faqs` (
  `FAQs_ID` int(255) NOT NULL,
  `FAQs_enquiry` varchar(1000) NOT NULL,
  `FAQs_answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry_faqs`
--

INSERT INTO `enquiry_faqs` (`FAQs_ID`, `FAQs_enquiry`, `FAQs_answer`) VALUES
(1, 'Why An FAQ Resource?', 'Firstly, FAQ pages can bring new visitors to your website via organic search and drive them quickly to related pages – most typically deeper blog pages and service pages closely related to the questions being resolved.'),
(2, 'Why FAQ Pages Are A Priority', 'FAQ pages continue to be a priority area for SEO and digital marketing professionals.  An FAQ page is one of the simplest ways to improve your site and help site visitors and users.'),
(3, 'What Are the Benefits of a Good FAQ Page?', 'An FAQ page is a helpful type of technical documentation that streamlines the customer service experience.');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `message`, `created_at`) VALUES
(1, 10, 'Your refund request #1 has been approved.', '2023-11-10 01:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `notification_tb`
--

CREATE TABLE `notification_tb` (
  `no` int(255) NOT NULL,
  `appointment_id` int(30) NOT NULL,
  `appointment_type` varchar(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `apt_status` varchar(255) NOT NULL,
  `curr_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `alert_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `apt_date` date NOT NULL,
  `apt_time` text NOT NULL,
  `noti_date` date NOT NULL,
  `noti_day` varchar(255) NOT NULL,
  `noti_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_tb`
--

INSERT INTO `notification_tb` (`no`, `appointment_id`, `appointment_type`, `cust_id`, `cust_name`, `details`, `apt_status`, `curr_time`, `alert_time`, `end_time`, `apt_date`, `apt_time`, `noti_date`, `noti_day`, `noti_time`) VALUES
(5, 92, 'Ended', '2', 'Has123', 'Your Appointment Has Ended', 'Inactive', '2022-11-17 09:43:00', '2022-11-17 09:42:00', '2022-11-17 09:43:00', '2022-11-17', '10:00 AM - 11:00 AM', '2022-11-17', 'Thursday', '09:39 AM'),
(6, 93, 'Ended', '2', 'Has123', 'Your Appointment Has Ended', 'Inactive', '2022-11-17 09:46:00', '2022-11-17 09:45:00', '2022-11-17 09:46:00', '2022-11-17', '10:00 AM - 11:00 AM', '2022-11-17', 'Thursday', '09:43 AM');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 14, 2, 4, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Processing',
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `payment_method`, `total_price`, `order_status`, `customer_id`) VALUES
(14, 10, '2023-10-20 15:16:56', 'CashNGo', NULL, 'shipped', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_ID` int(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_qnt` bigint(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `category` varchar(55) NOT NULL,
  `seller_id` int(55) NOT NULL,
  `promoted` varchar(10) NOT NULL,
  `sold_quantity` int(10) NOT NULL,
  `promo_price` int(56) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_ID`, `product_image`, `product_desc`, `product_qnt`, `product_name`, `product_price`, `category`, `seller_id`, `promoted`, `sold_quantity`, `promo_price`, `date`) VALUES
(1, 'promo_plant1.jpg', '', 2, 'Rickrack cactus', '200', 'Plants', 12, 'Yes', 0, 0, NULL),
(2, 'promo_plant2.jpg', '', 2, 'Christmas Cactus', '200', 'Plants', 12, 'No', 0, 0, NULL),
(3, 'Screenshot 2023-10-10 045705.png', 'rewrew', 11, 'rando', '123', 'clothing', 12, 'Yes', 0, 0, NULL),
(4, 'Screenshot 2023-10-10 045416.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 12, 'shirt', '111', 'clothing', 12, 'No', 0, 0, '2023-10-17 02:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `product_ID` int(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sname` varchar(255) NOT NULL,
  `product_price` int(255) NOT NULL,
  `product_discount` int(255) NOT NULL,
  `product_dprice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`product_ID`, `product_image`, `product_name`, `product_sname`, `product_price`, `product_discount`, `product_dprice`) VALUES
(1, 'promo_plant1.jpg', 'Rickrack cactus', 'Selenicereus anthonyanus', 200, 50, 100),
(2, 'promo_plant2.jpg', 'Christmas Cactus', 'Schlumbergera bridgesii', 200, 50, 100),
(3, 'promo_plant3.jpg', 'Fairy Castle Cactus', 'Acanthocereus tetragonus', 200, 50, 100),
(4, 'promo_plant4.jpg', 'Star Cactus', 'Astrophytum asterias', 200, 50, 100),
(5, 'promo_plant5.jpg', 'Golden Barrel Cactus', 'Echinocactus grusonii', 100, 50, 50),
(6, 'promo_plant6.jpg', 'Easter Cactus', 'Schlumbergera gaertneri', 100, 50, 100),
(7, 'promo_plant7.jpg', 'Moon Cactus', 'Grafted hybrid', 100, 50, 100),
(8, 'promo_plant8.jpg', 'Old Lady Cactus', 'Mammillaria hahniana', 100, 50, 100);

-- --------------------------------------------------------

--
-- Table structure for table `refundrequests`
--

CREATE TABLE `refundrequests` (
  `request_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `admin_response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refundrequests`
--

INSERT INTO `refundrequests` (`request_id`, `order_id`, `user_id`, `reason`, `details`, `images`, `status`, `admin_response`, `created_at`, `updated_at`) VALUES
(1, 14, 10, 'Damaged item', 'rgerfefw', '', 'approved', '', '2023-11-10 00:16:02', '2023-11-10 01:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `seller_password` text NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `location` text NOT NULL,
  `is_approved` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers_product`
--

CREATE TABLE `sellers_product` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers_product`
--

INSERT INTO `sellers_product` (`id`, `seller_id`, `product_id`) VALUES
(1, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `role_type` int(11) NOT NULL DEFAULT 1,
  `phone_number` text NOT NULL,
  `dob` date NOT NULL,
  `password` text NOT NULL,
  `validation_key` text NOT NULL,
  `seller_location` text DEFAULT NULL,
  `registration_date` date NOT NULL,
  `is_active` int(11) NOT NULL,
  `otp` text NOT NULL,
  `pp` text NOT NULL DEFAULT 'avatar3.png',
  `country_code` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `username`, `email`, `role_type`, `phone_number`, `dob`, `password`, `validation_key`, `seller_location`, `registration_date`, `is_active`, `otp`, `pp`, `country_code`, `address`, `postcode`) VALUES
(2, '', 'Hassaan', 'Ghayas', 'Has123', 'kingharispro7@gmail.com', 1, '09120901290', '1999-05-03', '$2y$10$juoAk4s1CDqKoqNwtO5izeMkbibrzPSFa8biOm13bDTqAbi4Mpmj6', 'ZWFmZGFhMWJkNGMyYTc2ZGNhZjE2YTcz', NULL, '2022-11-08', 1, '', 'demo636a9a79713fa2.04158188.jpg', NULL, NULL, NULL),
(9, '', 'Seller', 'sell', 'seller', 'seller@sell.com', 2, '1234567890', '2023-09-27', '$2y$10$u8YxqL5KBJcA1jnoZ/vDX.glsWzWKkcmUeKW3NtoNqnn4v24lToXu', '', 'mumbai', '2023-10-09', 1, '', 'avatar3.png', NULL, NULL, NULL),
(10, '', 'Osama', 'Iftikhar', 'samifti', 'osamaifti@gmail.com', 1, '245245425', '1999-02-02', '$2y$10$hp/tm3mv0yjSskGQ7/gDDOP0pzt38BPkwJ5CDBpxBTnvMuSi.H/h2', 'ODU2ZjRlNWYxZjYxYjc4NWIxNzYyNWJk', 'kuching', '2023-10-09', 1, '', 'pp.jpg', '+60', 'swinburne city, swin street, swinville', '83001'),
(12, '', 'noor', 'ain', 'sam12', 'cache5834@gmail.com', 2, '97502718', '1999-02-01', '$2y$10$UEjY5pEzP6iWriue64MmIeFw0eS9MvQLTEklFP4Zj0dmFtnREULnS', 'MzY1MjdjZjU0MmRhNTg2OTkxYzJhNDFl', 'swinburne city', '2023-10-09', 1, '', 'pp.jpg', NULL, 'swinburne city, swin street, swinville', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pp` varchar(255) NOT NULL DEFAULT 'default-pp.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_list`
--
ALTER TABLE `booking_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `enquiry_bi`
--
ALTER TABLE `enquiry_bi`
  ADD PRIMARY KEY (`BI_Outlet_ID`);

--
-- Indexes for table `enquiry_faqs`
--
ALTER TABLE `enquiry_faqs`
  ADD PRIMARY KEY (`FAQs_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification_tb`
--
ALTER TABLE `notification_tb`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `refundrequests`
--
ALTER TABLE `refundrequests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sellers_product`
--
ALTER TABLE `sellers_product`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_list`
--
ALTER TABLE `booking_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enquiry_bi`
--
ALTER TABLE `enquiry_bi`
  MODIFY `BI_Outlet_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiry_faqs`
--
ALTER TABLE `enquiry_faqs`
  MODIFY `FAQs_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_tb`
--
ALTER TABLE `notification_tb`
  MODIFY `no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `refundrequests`
--
ALTER TABLE `refundrequests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers_product`
--
ALTER TABLE `sellers_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_ID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `refundrequests`
--
ALTER TABLE `refundrequests`
  ADD CONSTRAINT `refundrequests_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `refundrequests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `e` ON SCHEDULE EVERY 1 SECOND STARTS '2022-11-17 08:22:06' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE
            notification_tb
        SET
            curr_time = CURRENT_TIMESTAMP
        WHERE
            apt_status = 'Active' OR apt_status = 'Alert'$$

CREATE DEFINER=`root`@`localhost` EVENT `e1` ON SCHEDULE EVERY 1 SECOND STARTS '2022-11-17 09:08:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE notification_tb SET appointment_type = "Appointment Alert", details = "**REMINDER** You Have An Upcoming Appointment!!!", apt_status = "Alert" WHERE alert_time = curr_time$$

CREATE DEFINER=`root`@`localhost` EVENT `e2` ON SCHEDULE EVERY 1 SECOND STARTS '2022-11-17 09:41:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE notification_tb SET appointment_type = "Ended", details = "Your Appointment Has Ended", apt_status = "Inactive" WHERE end_time = curr_time$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
