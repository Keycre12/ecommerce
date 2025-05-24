-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 09:59 AM
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
-- Database: `ecommerce-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `guest_phone` varchar(20) DEFAULT NULL,
  `guest_address` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `guest_name`, `guest_phone`, `guest_address`, `total`, `created_at`, `updated_at`) VALUES
(9, 7, NULL, NULL, NULL, 15000.00, '2025-05-24 07:20:22', '2025-05-24 07:20:22'),
(10, 7, NULL, NULL, NULL, 150000.00, '2025-05-24 07:33:15', '2025-05-24 07:33:15'),
(11, 7, NULL, NULL, NULL, 105000.00, '2025-05-24 07:39:17', '2025-05-24 07:39:17'),
(12, 7, NULL, NULL, NULL, 362000.00, '2025-05-24 07:59:12', '2025-05-24 07:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`) VALUES
(15, 9, 9, 1, 15000.00, 15000.00),
(16, 10, 9, 2, 15000.00, 60000.00),
(17, 10, 10, 1, 90000.00, 90000.00),
(18, 11, 9, 1, 15000.00, 15000.00),
(19, 11, 10, 1, 90000.00, 90000.00),
(20, 12, 10, 2, 90000.00, 360000.00),
(21, 12, 11, 1, 1000.00, 1000.00),
(22, 12, 12, 1, 1000.00, 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `slug`, `image_path`, `created_at`, `updated_at`) VALUES
(9, 1, 'Washing washing', 'Easy Laundry', 15000.00, 'washing-washing', 'uploads/9786d76e6d7435d7041c78e7d02bbf53.jpg', '2025-05-24 06:29:09', '2025-05-24 00:29:09'),
(10, 1, 'Convection Gas Range', 'Stainless Steel Smart Wi-Fi Enabled Fan Convection', 90000.00, 'convection-gas-range', 'uploads/gas.jpg', '2025-05-24 06:56:39', '2025-05-24 00:56:39'),
(11, 7, 'Walking Dead', 'Zombie Outbreak Survival', 1000.00, 'walking-dead', 'uploads/twd.jpg', '2025-05-24 07:48:16', '2025-05-24 01:48:16'),
(12, 7, 'It Ends With Us', 'A powerful story about navigates love, heartbreak,', 1000.00, 'it-ends-with-us', 'uploads/2b6760353435b8ef1a3437385a381039.jpg', '2025-05-24 07:58:20', '2025-05-24 01:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(1, ' Electronics', 'Includes devices and gadgets such as smartphones, laptops, cameras, headphones, and smart home accessories. This category focuses on technology-driven products for personal and professional use.', 'electronics', '2025-05-22 04:14:42', '2025-05-22 04:14:42'),
(2, 'Fashion', 'Covers clothing, accessories, and apparel for men, women, and children. This category includes casual wear, formal outfits, and seasonal fashion trends.', 'fashion', '2025-05-22 04:14:42', '2025-05-22 04:14:42'),
(3, 'Shoes', 'Features a wide range of footwear for all ages and occasions, including athletic shoes, casual sneakers, boots, sandals, and formal shoes.', 'shoes', '2025-05-22 04:15:34', '2025-05-22 04:15:34'),
(4, 'Beauty & Personal Care', 'Offers skincare, haircare, cosmetics, grooming tools, and wellness products aimed at enhancing personal appearance and hygiene.', 'beauty-personal-care', '2025-05-22 04:15:34', '2025-05-22 04:15:34'),
(5, 'Home & Kitchen', 'Includes appliances, cookware, utensils, furniture, and decor for home improvement, organization, and kitchen use.', 'home-kitchen', '2025-05-22 04:16:28', '2025-05-22 04:16:28'),
(6, 'Sports & Outdoors', 'Focuses on fitness gear, outdoor equipment, sportswear, and accessories for activities like camping, hiking, cycling, and gym workouts.', 'sports-outdoors', '2025-05-22 04:16:28', '2025-05-22 04:17:02'),
(7, 'Books', 'Books are the quietest and most constant of friends ', 'books', '2025-05-24 07:46:31', '2025-05-24 07:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `phone`, `birthdate`, `created_at`, `updated_at`) VALUES
(6, 'Mizaki', 'mizaki@gmail.com', '$2y$10$FUWm0B.3jtwNV9zg4.qrFu6DL75OWfaseSjBEm0lrhep/348jXVaK', NULL, NULL, NULL, '2025-05-24 01:16:57', '2025-05-24 01:16:57'),
(7, 'Keycee', 'bolambotkeycee@gmail.com', '$2y$10$WvfK8MoKkO0e8tCExRoG6OF3MyXKN61GZLzUFB8.yuS.tdc0CWCGG', 'Costa, Plaza Bacay', '09493598037', '2004-12-17', '2025-05-24 06:01:33', '2025-05-24 06:01:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_customer` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_detail_order` (`order_id`),
  ADD KEY `fk_order_detail_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_detail_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_detail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
