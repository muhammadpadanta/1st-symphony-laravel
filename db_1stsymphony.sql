-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2024 at 12:25 AM
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
-- Database: `db_1stsymphony`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `name`, `bio`, `genre`, `photo`) VALUES
(15, 'Raisa', 'Raisa Andriana, known by her mononym Raisa, is an Indonesian singer and songwriter. She is known for her powerful voice and emotive ballads.', 'Pop', 'artistphoto/TCnrfjoDANQEYyAlnLpqjgsdJSv39QpiaUcbh2Pf.png'),
(16, 'Afgansyah Reza', 'Afgansyah Reza, known as Afgan, is an Indonesian singer, songwriter, and actor. He is known for his soulful voice and romantic ballads.', 'Pop, R&B', 'artistphoto/6CffJEXs6EcPr0deWC85rb8LWqJeLvVFpbUHFs6J.jpg'),
(17, 'Agnez Mo', 'Agnes Monica Muljoto, known professionally as Agnez Mo, is an Indonesian singer, songwriter, and actress. She is one of the most influential figures in the Indonesian music industry.', 'Pop, R&B, Hip-Hop', 'artistphoto/smvUOoyvnpzuj56qRw7sAAUflyyMonBLDoFtKPVx.jpg'),
(18, 'Tulus', 'Muhammad Tulus Rusydi, known professionally as Tulus, is an Indonesian singer and songwriter. He is known for his rich voice and jazz-influenced music.', 'Jazz, Pop', 'artistphoto/kifIdKpElyRyECBmyroXBjndaS9EDjWWW10YL3aX.jpg'),
(19, 'Isyana Sarasvati', 'Isyana Sarasvati is an Indonesian singer, songwriter, and multi-instrumentalist. She is known for her vocal range and musical versatility.', 'Pop, Classical, Jazz', 'artistphoto/c1qH2IgBwNI1dqJrWsSKlm9ILjhLPzxUQrOmXRIk.jpg'),
(20, 'GAC', 'Gamaliel Audrey Cantika, also known as GAC, is an Indonesian vocal group consisting of Gamaliel Tapiheru, Audrey Tapiheru, and Cantika Abigail. They are known for their harmonies and contemporary pop sound.', 'Pop, R&B', 'artistphoto/xNblPiBby3Kks1RgDNvbKdU7RooT7Si6P0aAkGcb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `concert_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `concert_name` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `venue` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `concert_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`concert_id`, `artist_id`, `concert_name`, `date`, `venue`, `description`, `concert_photo`) VALUES
(17, 15, 'KONSER RAISA', '2024-06-05 00:00:00', 'INDONESIA', 'TEST DATA KONSER', 'concertphoto/vGfKyojncrTjGhAwhtqYq6VNLWVM2E6e2dL17uza.png'),
(18, 18, 'KONSER TULUS', '2024-06-12 00:00:00', 'INDONESIA', 'TEST DATA KONSER', 'concertphoto/tFL1jH7j2csa98xwJwh4dhaPH5ZOi8Sb4swG6gkS.jpg'),
(23, 18, 'EDIT', '2024-06-11 00:00:00', 'INDONESIA', 'TES', 'concertphoto/9I0JrIeALry3hymnVxKljacsW5uQHeudNugyU4BF.png');

-- --------------------------------------------------------

--
-- Table structure for table `concert_tickets`
--

CREATE TABLE `concert_tickets` (
  `concert_ticket_id` int(11) NOT NULL,
  `ticket_type_id` int(11) NOT NULL,
  `total_stock` int(11) NOT NULL,
  `sold_tickets` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concert_tickets`
--

INSERT INTO `concert_tickets` (`concert_ticket_id`, `ticket_type_id`, `total_stock`, `sold_tickets`) VALUES
(12, 18, 99, 1),
(13, 17, 46, 4),
(18, 23, 47, 3),
(19, 24, 53, 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` int(11) NOT NULL,
  `purchase_status` varchar(20) DEFAULT 'Pending',
  `snap_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `purchase_status`, `snap_token`) VALUES
(49, 57, '2024-06-19 06:58:30', 123000, 'Success', '296ab881-af77-4dd9-8d43-6ee5320842b1'),
(51, 57, '2024-06-19 07:45:29', 100000, 'Success', 'f68e291a-1480-4983-9403-0275c2542804'),
(52, 83, '2024-06-19 08:34:50', 100000, 'Success', '516d065d-8e10-44b7-ad5b-97cb0d868cbc');

-- --------------------------------------------------------

--
-- Table structure for table `order_tickets`
--

CREATE TABLE `order_tickets` (
  `order_ticket_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `concert_ticket_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tickets`
--

INSERT INTO `order_tickets` (`order_ticket_id`, `order_id`, `concert_ticket_id`, `quantity`) VALUES
(56, 49, 18, 1),
(58, 51, 12, 1),
(59, 52, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(56, 'App\\Models\\User', 58, 'admin', '3ab6d3586eb85acee5ef5b7d9684dfb16e7887bcdd757ca3d57f4244b3eb5a0a', '[\"*\"]', '2024-06-27 14:36:01', NULL, '2024-06-07 20:01:09', '2024-06-27 14:36:01'),
(58, 'App\\Models\\User', 57, 'muhammadpadanta', '5c8709ecef60f1fd9445f6765ddbd395f292ae957ba131323fb0dbb54fb89866', '[\"*\"]', '2024-06-08 02:08:27', NULL, '2024-06-08 02:07:43', '2024-06-08 02:08:27'),
(69, 'App\\Models\\User', 58, 'admin', 'a6ed5edfcab5902d14c2b61b3ca8650e8cedbe27258f1561d3e16cbd2a401250', '[\"*\"]', '2024-06-09 09:11:04', NULL, '2024-06-09 05:31:46', '2024-06-09 09:11:04'),
(82, 'App\\Models\\User', 57, 'muhammadpadanta', '62653a544f93515dcfec4d1dfc718e865c6111c3864ee7ca1a0d3b8093b24687', '[\"*\"]', '2024-06-19 04:03:09', NULL, '2024-06-12 12:03:42', '2024-06-19 04:03:09'),
(83, 'App\\Models\\User', 57, 'muhammadpadanta', 'c6175e7fc883c8aaf900fa2d370df9e95fe60e9ae20f2838ece2693135d80885', '[\"*\"]', '2024-06-12 23:51:04', NULL, '2024-06-12 12:42:44', '2024-06-12 23:51:04'),
(102, 'App\\Models\\User', 57, 'muhammadpadanta', '0c53fa624be63bf9c63fce479334b7765e97fbe5c0010352e734065988379a3a', '[\"*\"]', '2024-06-19 00:07:40', NULL, '2024-06-18 21:28:22', '2024-06-19 00:07:40'),
(106, 'App\\Models\\User', 58, 'admin', '45898bdc6095489abc1a9b09a4020b43255a0219988c565e13cf28d7f3011196', '[\"*\"]', '2024-06-27 15:22:05', NULL, '2024-06-27 07:57:59', '2024-06-27 15:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `artist_id`, `title`, `link_id`) VALUES
(1, 15, 'Tes', 'WjhbNUCuwLE'),
(2, 15, 'tes lagi', 'SHj2kJzVi_g'),
(3, 15, 'Raisa LAGU', '121WomHqiNk'),
(4, 16, 'Bukan CInta Biasa', 'nshdkoeu_fY'),
(20, 16, 'Terima kasih Cinta', 'Hr0AAqHLLSg');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_types`
--

CREATE TABLE `ticket_types` (
  `ticket_type_id` int(11) NOT NULL,
  `concert_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_types`
--

INSERT INTO `ticket_types` (`ticket_type_id`, `concert_id`, `type_name`, `price`) VALUES
(17, 18, 'VIP TULUS', 150000),
(18, 17, 'VIP RAISA', 100000),
(23, 23, 'VIP EDIT', 123000),
(24, 23, 'REGULAR EDIT', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pfp_path` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_token` varchar(60) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `gender`, `birth`, `phone`, `address`, `pfp_path`, `email_verified_at`, `verification_token`, `role`) VALUES
(57, 'Muhammad Padanta Tarigan', 'muhammadpadanta', 'dantaa@gmail.com', '$2y$12$CyfRvlKYjCNpLygSjY1iYOuXl0DVaKclpN.p/Tv1CN14nwXNfgsuy', 'Male', '2024-06-09', 1234, 'Batam, kepulauan riau, Indonesia', 'userpfps/9cYZFbRhrTOmRlLz3Qi04QNrPp8Uw8L5p4dBlHgs.jpg', '2024-06-07 17:24:18', '98f7d9e32534d662abb8900824c625e78a94c64f944c9da66bce6a5bf881', 'user'),
(58, 'admin', 'admin', 'admin@gmail.com', '$2y$12$4zZ9BrnYouejy.Rqhdb3AupmvbX1Ehm.oPyn/XOETFU6jHhdiVmBG', 'Male', '2024-06-06', 123, 'Batam', 'userpfps/XgaiUHnuYrCJIorH6AQMGvGmdaPZiKTXerHOhqBy.jpg', '2024-06-07 19:09:07', '7a90113370be817daf3b6984abf357893fd34579304f42d438916005ad5e', 'admin'),
(82, 'Christoffel Aristo', 'christoffel', 'Christoffel@gmail.com', '$2y$12$0zR.bDnKFE.6ejKD23aK6OdoajaT288tmK2YgTqmpE2HVMrMyz1Ci', 'Male', '2024-06-05', 123, 'Batam, kepulauan riau, Indonesia', 'userpfps/iLuQj2oKgSs32qb1ONLsUU8WZhAy5mexqKJLYGoH.png', '2024-06-10 19:28:30', 'f83951d4f2693726d2dcb693d22b7fd2a74c9db1ae89c012907b003718d0', 'user'),
(83, 'Yurisha Anindyas', 'yurisha', 'Yurisha@gmail.com', '$2y$12$hwEJeWJr2760V6Wj12782uVWXgDgAJn7QqkKKfw4qHfdcZ9sed6ja', 'Male', '2024-06-13', 123, 'Batam, kepulauan riau, Indonesia', 'userpfps/0TjUbO0HLHa77fBjMu9uH0PZQkKXunQr28FZmAiB.jpg', '2024-06-10 19:28:25', '846ab301b25dcc15ef70857ec00148ed5eed06d5ab9d44aa1297fc1ff5aa', 'user'),
(84, 'Theodore Kevin', 'theodore', 'Theodore@gmail.com', '$2y$12$MPDFVXnATVi1Z4fh3UgvRO0GO0Z8SfYI7w./Dva3/HGgiZKz4I9LW', 'Male', '2000-02-02', 123, 'Batam', 'userpfps/TEui31kaJjo8QPDdHf67VKYI3wNtaC2IwkHQVdg8.png', '2024-06-10 19:28:20', '2c55b33548f91aed73970f5038948dc5c07fff43618db7b7fb4eec4f9b2b', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_tickets`
--

CREATE TABLE `user_tickets` (
  `ticket_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ticket_link` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tickets`
--

INSERT INTO `user_tickets` (`ticket_id`, `order_id`, `ticket_link`, `created_at`) VALUES
(88, 49, 'storage/tickets/ticket_49.pdf', '2024-06-19 06:58:56'),
(89, 51, 'storage/tickets/ticket_51.pdf', '2024-06-19 07:45:50'),
(90, 52, 'storage/tickets/ticket_52.pdf', '2024-06-19 08:35:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`concert_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `concert_tickets`
--
ALTER TABLE `concert_tickets`
  ADD PRIMARY KEY (`concert_ticket_id`),
  ADD KEY `ticket_type_id` (`ticket_type_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_tickets`
--
ALTER TABLE `order_tickets`
  ADD PRIMARY KEY (`order_ticket_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `concert_ticket_id` (`concert_ticket_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `email` (`email`),
  ADD KEY `email_2` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tokenable_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `fk_name_username` (`name`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `ticket_types`
--
ALTER TABLE `ticket_types`
  ADD PRIMARY KEY (`ticket_type_id`),
  ADD KEY `concert_id` (`concert_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_tickets`
--
ALTER TABLE `user_tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `concert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `concert_tickets`
--
ALTER TABLE `concert_tickets`
  MODIFY `concert_ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `order_tickets`
--
ALTER TABLE `order_tickets`
  MODIFY `order_ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ticket_types`
--
ALTER TABLE `ticket_types`
  MODIFY `ticket_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `user_tickets`
--
ALTER TABLE `user_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `concerts`
--
ALTER TABLE `concerts`
  ADD CONSTRAINT `concerts_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`);

--
-- Constraints for table `concert_tickets`
--
ALTER TABLE `concert_tickets`
  ADD CONSTRAINT `concert_tickets_ibfk_1` FOREIGN KEY (`ticket_type_id`) REFERENCES `ticket_types` (`ticket_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_tickets`
--
ALTER TABLE `order_tickets`
  ADD CONSTRAINT `order_tickets_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_tickets_ibfk_2` FOREIGN KEY (`concert_ticket_id`) REFERENCES `concert_tickets` (`concert_ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `fk_email_useremail` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD CONSTRAINT `fk_name_username` FOREIGN KEY (`name`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_types`
--
ALTER TABLE `ticket_types`
  ADD CONSTRAINT `ticket_types_ibfk_1` FOREIGN KEY (`concert_id`) REFERENCES `concerts` (`concert_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_tickets`
--
ALTER TABLE `user_tickets`
  ADD CONSTRAINT `user_tickets_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
