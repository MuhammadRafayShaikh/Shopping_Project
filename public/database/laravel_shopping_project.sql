-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 07:15 PM
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
-- Database: `laravel_shopping_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL,
  `brand_cat` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `brand_cat`, `created_at`, `updated_at`) VALUES
(1, 'Dell', 1, NULL, NULL),
(2, 'Realme', 2, NULL, NULL),
(3, 'Lenovo', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(10, 2, 3, 1, 50000.00, '2024-10-22 08:42:53', '2024-10-22 08:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_10_16_165709_create_categories_table', 1),
(5, '2024_10_16_194324_create_subcategories_table', 1),
(6, '2024_10_16_194339_create_brands_table', 1),
(7, '2024_10_16_195622_create_products_table', 1),
(8, '2024_10_17_203511_create_admins_table', 1),
(9, '2024_10_18_182517_create_sessions_table', 1),
(10, '2024_10_19_142616_create_carts_table', 1),
(11, '2024_10_19_202725_create_wishlists_table', 1),
(12, '2024_10_19_211723_create_views_table', 1),
(13, '2024_10_20_160436_create_orders_table', 1),
(14, '2024_10_20_160543_create_order_items_table', 1),
(15, '2024_10_21_175835_create_reviews_table', 2),
(16, '2024_10_22_122322_create_jobs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `total_price`, `payment_status`, `order_status`, `created_at`, `updated_at`) VALUES
(5, 3, 'Karachi', 25000.00, 'pending', 'processing', '2024-10-22 08:24:07', '2024-10-22 08:24:07'),
(6, 3, 'Karachi', 50000.00, 'pending', 'processing', '2024-10-22 08:33:09', '2024-10-22 08:33:09'),
(10, 1, 'Karachi', 50000.00, 'paid', 'processing', '2024-10-22 13:53:14', '2024-10-22 15:00:59'),
(11, 10, 'Shah Faisal Colony Block 3', 450000.00, 'paid', 'delivered', '2024-11-01 08:13:05', '2024-11-01 08:14:37'),
(28, 2, 'xyz', 25000.00, 'pending', 'processing', '2024-11-24 07:08:34', '2024-11-24 07:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(8, 6, 2, 1, 50000.00, '2024-10-22 08:33:09', '2024-10-22 08:33:09'),
(13, 10, 2, 1, 50000.00, '2024-10-22 13:53:14', '2024-10-22 13:53:14'),
(14, 11, 2, 3, 150000.00, '2024-11-01 08:13:05', '2024-11-01 08:13:05'),
(43, 28, 1, 1, 25000.00, '2024-11-24 07:08:34', '2024-11-24 07:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` longtext NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` text NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_views` int(11) NOT NULL DEFAULT 0,
  `product_cat` bigint(20) UNSIGNED NOT NULL,
  `product_sub_cat` bigint(20) UNSIGNED NOT NULL,
  `product_brand` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_desc`, `product_price`, `product_image`, `product_qty`, `product_views`, `product_cat`, `product_sub_cat`, `product_brand`, `created_at`, `updated_at`) VALUES
(1, 'Samsung Galaxy A20s (Blue, 32 GB)  (3 GB RAM)', '3 GB RAM | 32 GB ROM | Expandable Upto 512 GB\r\n16.51 cm (6.5 inch) HD+ Display\r\n13MP + 8MP + 5MP | 8MP Front Camera\r\n4000 mAh Lithium Ion Battery\r\nQualcomm SDM450-B01 Processor', 25000, '1729531512.jpeg', 0, 9, 1, 1, 1, '2024-10-21 12:25:12', '2024-11-24 07:08:34'),
(2, 'Realme C3 (Volcano Grey, 32 GB)  (3 GB RAM)', '3 GB RAM | 32 GB ROM | Expandable Upto 256 GB\r\n16.56 cm (6.52 inch) HD+ Display\r\n12MP + 2MP | 5MP Front Camera\r\n5000 mAh Battery\r\nHelio G70 Processor', 50000, '1729706109.jpeg', 17, 10, 1, 2, 2, '2024-10-21 12:27:30', '2024-11-20 08:57:36'),
(3, 'Lenovo Ideapad Flex 5 Core i3 10th Gen - (4 GB/256 GB SSD/Windows 10 Home) 14IIL05 2 in 1 Laptop  (14 inch, Graphite Grey, 1.5 kg, With MS Office)', 'Carry It Along 2 in 1 Laptop\r\n14 inch Full HD LED Backlit Glossy IPS Touch Display (16:9 Aspect Ratio, 250 nits Brightness, Stylus Support)\r\nLight Laptop without Optical Disk Drive\r\n\r\nShipping charges are calculated based on the number of units, distance and delivery date.\r\nFor Plus customers, shipping charges are free.\r\nFor non-Plus customers, if the total value of FAssured items is more than Rs.500, shipping charges are free. If the total value of FAssured items is less than Rs.500, shipping charges = Rs.40 per unit\r\n* For faster delivery, shipping charges will be applicable.', 45000, '1729531868.jpeg', 20, 8, 1, 1, 3, '2024-10-21 12:31:08', '2024-11-24 07:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(7, 10, 2, 3, 'Best Product', '2024-11-01 08:40:27', '2024-11-01 08:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('JMBsvB3dJOgvCc36HBjtN9lOWWRWfgwt9vssTZRc', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR3JjVVFQUnZRYnRWOWpzRUpoN0xNT0J3VTJybjUxWVZOZEFwQ0VWNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1733854494);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_cat_name` varchar(255) NOT NULL,
  `cat_name` bigint(20) UNSIGNED NOT NULL,
  `cat_products` int(11) NOT NULL DEFAULT 0,
  `s_i_header` tinyint(4) NOT NULL DEFAULT 0,
  `s_i_footer` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `sub_cat_name`, `cat_name`, `cat_products`, `s_i_header`, `s_i_footer`) VALUES
(1, 'Laptops', 1, 2, 1, 0),
(2, 'Mobile', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Rafay', 'rafay6744@gmail.com', NULL, '$2y$12$pbOvEOj6ctXTYcIJPSBMuOlIMN0uOMxMWOnb2zXBexUAuO3odhl0G', NULL, NULL, NULL, 2, NULL, NULL, NULL, '2024-10-21 12:19:29', '2024-11-20 09:01:24'),
(2, 'Rafay', 'rafayshaikh405@gmail.com', NULL, '$2y$12$y.W4qBSlxLNyDHPPoxq3l.SFZxw9kA3Q79VfEuWn/2pwjZq/H5oU2', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-21 12:28:53', '2024-12-10 13:13:32'),
(3, 'Rafay', 'rafay456@gmail.com', NULL, '$2y$12$ZuliPGwo4Q3P3MuwtJ.hqOTUiODVsC.2rrF2.tGNuwZ9bb69LiLBS', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-21 15:47:32', '2024-10-21 15:47:32'),
(4, 'hello', 'rafay123@gmail.com', NULL, '$2y$12$w94VHDwGaTLOKDOsL2BmAe7Cs2H6oA0PIxQ9IBkWslzF4wLWkQEWG', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-21 15:49:59', '2024-10-21 15:49:59'),
(5, 'hello2', 'hello@gmail.com', NULL, '$2y$12$XSOqJJGGX1SZJaQlUrE1h.ZuZT0zFzGK6VY2Kr15GH1U9i4lmCjAy', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-21 15:54:59', '2024-10-21 15:54:59'),
(6, 'Rafay', 'rafay199290@gmail.com', NULL, '$2y$12$QepEcq6qS0hArgx.awZc2elzZRYATxj1KmYac.fDk5d9KcwSqiC7S', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-21 16:05:07', '2024-10-21 16:05:07'),
(7, 'Rafay', 'xtylishlarka@gmail.com', NULL, '$2y$12$MbPByTtLsd4YcY5yeXc7xOHU1vxdFTuP.f6eBCZpbDDKeqZ2JOax.', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-21 16:07:03', '2024-10-21 16:07:03'),
(8, 'ghazali', 'ighazali791@gmail.com', NULL, '$2y$12$2OlPLtgdk34ReAgWqQKybuVu8tZl2eQ8pMRqvjQ89BThdeFj157jK', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-22 07:29:02', '2024-10-22 07:29:02'),
(9, 'rafay', 'xtylishlarka029@gmail.com', NULL, '$2y$12$z2m8RJVqe4XCImVnAXTD3.58OqmoIsLg3l1Rm2rz0sDC2Qgojcjr.', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-22 07:36:06', '2024-10-22 07:36:06'),
(10, 'Muhammad Rafay', 'aptechrafay4@gmail.com', NULL, '$2y$12$WIk1k9xGU48W1irBJJ01gOEEVvUU3rXdQ6J6bYqsbjwGpBZol1A9.', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-11-01 07:54:09', '2024-11-01 07:54:09'),
(11, 'Demo', 'demo123@gmail.com', NULL, '$2y$12$BrLPo6bru7DE5MsFkiIAKeYiaHRkti9TVoOegEMNIz4fbQZwHueY6', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-11-01 08:43:29', '2024-11-01 08:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2024-10-21 12:28:00', '2024-10-21 12:28:00'),
(2, 1, 1, '2024-10-21 12:28:04', '2024-10-21 12:28:04'),
(3, 1, 2, '2024-10-21 12:28:59', '2024-10-21 12:28:59'),
(4, 2, 2, '2024-10-21 12:32:00', '2024-10-21 12:32:00'),
(5, 3, 2, '2024-10-21 13:14:40', '2024-10-21 13:14:40'),
(6, 3, 1, '2024-10-21 13:21:04', '2024-10-21 13:21:04'),
(7, 1, 9, '2024-10-22 07:37:16', '2024-10-22 07:37:16'),
(8, 1, 3, '2024-10-22 08:23:48', '2024-10-22 08:23:48'),
(9, 2, 3, '2024-10-22 08:32:58', '2024-10-22 08:32:58'),
(12, 2, 10, '2024-11-01 07:54:19', '2024-11-01 07:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2024-10-22 08:47:20', '2024-10-22 08:47:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_brand_unique` (`brand`),
  ADD KEY `brands_brand_cat_foreign` (`brand_cat`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_cat_foreign` (`product_cat`),
  ADD KEY `products_product_sub_cat_foreign` (`product_sub_cat`),
  ADD KEY `products_product_brand_foreign` (`product_brand`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_sub_cat_name_unique` (`sub_cat_name`),
  ADD KEY `subcategories_cat_name_foreign` (`cat_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_product_id_foreign` (`product_id`),
  ADD KEY `views_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_brand_cat_foreign` FOREIGN KEY (`brand_cat`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_brand_foreign` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_product_cat_foreign` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_product_sub_cat_foreign` FOREIGN KEY (`product_sub_cat`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_cat_name_foreign` FOREIGN KEY (`cat_name`) REFERENCES `categories` (`id`);

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
