-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2025 at 12:57 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sparta`
--

-- --------------------------------------------------------

--
-- Table structure for table `assement_answers`
--

CREATE TABLE `assement_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` int NOT NULL,
  `ans_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `ans_input_type` int NOT NULL COMMENT '0=radio check, 1=select dropdown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assement_answers`
--

INSERT INTO `assement_answers` (`id`, `question_id`, `ans_text`, `is_active`, `ans_input_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Yes', 0, 0, '2025-04-17 07:20:36', '2025-04-17 07:20:36'),
(2, 1, 'No', 0, 0, '2025-04-17 07:20:36', '2025-04-17 07:20:36'),
(3, 2, 'None', 0, 1, '2025-04-17 07:24:05', '2025-04-17 07:24:05'),
(4, 2, 'Chain Link', 0, 1, '2025-04-17 07:24:06', '2025-04-17 07:24:06'),
(5, 2, 'Wood', 0, 1, '2025-04-17 07:24:06', '2025-04-17 07:24:06'),
(6, 2, 'Brick/Concrete', 0, 1, '2025-04-17 07:24:06', '2025-04-17 07:24:06'),
(7, 2, 'Metal', 0, 1, '2025-04-17 07:24:06', '2025-04-17 07:24:06'),
(8, 4, 'Yes', 0, 0, '2025-04-17 07:29:37', '2025-04-17 07:29:37'),
(9, 4, 'No', 0, 0, '2025-04-17 07:29:37', '2025-04-17 07:29:37'),
(10, 5, 'Yes', 0, 0, '2025-04-17 07:30:22', '2025-04-17 07:30:22'),
(11, 5, 'No', 0, 0, '2025-04-17 07:30:22', '2025-04-17 07:30:22'),
(12, 6, 'Yes', 0, 0, '2025-04-17 07:30:43', '2025-04-17 07:30:43'),
(13, 6, 'No', 0, 0, '2025-04-17 07:30:43', '2025-04-17 07:30:43'),
(14, 7, 'Yes', 0, 0, '2025-04-17 07:31:01', '2025-04-17 07:31:01'),
(15, 7, 'No', 0, 0, '2025-04-17 07:31:01', '2025-04-17 07:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `assement_comments`
--

CREATE TABLE `assement_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `assement_fillup_id` int NOT NULL,
  `perimeter_security_comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `perimeter_entry_point_comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `perimeter_lighting_comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `risk_scoring` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assement_fillups`
--

CREATE TABLE `assement_fillups` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `assement_no` int DEFAULT NULL,
  `question_id` int NOT NULL,
  `answer_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assement_notes`
--

CREATE TABLE `assement_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `assement_fillup_id` int NOT NULL,
  `question_type_id` int NOT NULL,
  `security_notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assement_questions`
--

CREATE TABLE `assement_questions` (
  `id` bigint UNSIGNED NOT NULL,
  `type_id` int NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assement_questions`
--

INSERT INTO `assement_questions` (`id`, `type_id`, `question`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Is perimeter fencing installed?', 0, '2025-04-17 07:20:36', '2025-04-17 07:20:36'),
(2, 1, 'Type of fencing?', 0, '2025-04-17 07:24:05', '2025-04-17 07:24:05'),
(4, 1, 'Are perimeter gates secured with locks or electronic access?', 0, '2025-04-17 07:29:37', '2025-04-17 07:29:37'),
(5, 1, 'Are natural barriers (hedges, water features, terrain) used as deterrents?', 0, '2025-04-17 07:30:22', '2025-04-17 07:30:22'),
(6, 1, 'Is perimeter lighting adequate?', 0, '2025-04-17 07:30:43', '2025-04-17 07:30:43'),
(7, 1, 'Are motion-activated lights installed along the perimeter?', 0, '2025-04-17 07:31:01', '2025-04-17 07:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `assement_question_types`
--

CREATE TABLE `assement_question_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assement_question_types`
--

INSERT INTO `assement_question_types` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Perimeter Security', 0, NULL, NULL),
(2, 'Entry Points', 0, NULL, NULL),
(3, 'Lighting & Cameras', 0, NULL, NULL),
(4, 'Interior Security', 0, NULL, NULL),
(5, 'Emergency Preparedness', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int NOT NULL DEFAULT '0' COMMENT '0=active, 1=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_07_231441_create_customers_table', 1),
(5, '2025_04_10_190732_create_assement_questions_table', 1),
(6, '2025_04_10_190742_create_assement_answers_table', 1),
(7, '2025_04_10_190914_create_assement_fillups_table', 1),
(8, '2025_04_10_191113_create_assement_question_types_table', 1),
(9, '2025_04_10_192055_create_assement_comments_table', 1),
(10, '2025_04_10_200101_create_assement_notes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-04-17 07:05:53', '$2y$12$BEtHmnecvZb6gmw0XxzenOq0xL1PclFrVM71Gx8wSLoAXeKgIY/f6', 'rjoXYWtiMS', '2025-04-17 07:05:54', '2025-04-17 07:05:54'),
(2, 'Administrator', 'admin@admin.com', NULL, '$2y$12$M0Wx0HLgoKOqLbBBN33GD.MpbecJYguFtu0i.1XoxWfyZ9vNKaZyW', NULL, '2025-04-17 07:06:31', '2025-04-17 07:06:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assement_answers`
--
ALTER TABLE `assement_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assement_comments`
--
ALTER TABLE `assement_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assement_fillups`
--
ALTER TABLE `assement_fillups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assement_notes`
--
ALTER TABLE `assement_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assement_questions`
--
ALTER TABLE `assement_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assement_question_types`
--
ALTER TABLE `assement_question_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assement_answers`
--
ALTER TABLE `assement_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `assement_comments`
--
ALTER TABLE `assement_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assement_fillups`
--
ALTER TABLE `assement_fillups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assement_notes`
--
ALTER TABLE `assement_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assement_questions`
--
ALTER TABLE `assement_questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `assement_question_types`
--
ALTER TABLE `assement_question_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
