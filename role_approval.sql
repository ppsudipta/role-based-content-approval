-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 03, 2026 at 03:18 AM
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
-- Database: `role_approval`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_02_013726_create_personal_access_tokens_table', 1),
(5, '2026_03_02_013742_add_role_to_users_table', 1),
(6, '2026_03_02_013927_create_posts_table', 1),
(7, '2026_03_02_014039_create_post_logs_table', 1),
(8, '2026_03_02_133928_change_action_column_in_post_logs_table', 1);

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
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
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
(2, 'App\\Models\\User', 4, 'api-token', '82fcf22a8696e68dc37bbb3163f56673b6279c5c2857b4a4203538369d8c0d93', '[\"*\"]', '2026-03-02 15:35:52', NULL, '2026-03-02 15:35:30', '2026-03-02 15:35:52'),
(3, 'App\\Models\\User', 5, 'api-token', '761a906c9652ba13828c3ae5e62c802accbf71eb8d215924ef036598eb6bae3d', '[\"*\"]', NULL, NULL, '2026-03-02 15:42:52', '2026-03-02 15:42:52'),
(6, 'App\\Models\\User', 1, 'api-token', 'da93be3b24c320d2e8668917eb1f912a628ac2cb7248f5be09806b5a36333068', '[\"*\"]', '2026-03-02 15:45:04', NULL, '2026-03-02 15:44:25', '2026-03-02 15:45:04'),
(8, 'App\\Models\\User', 6, 'api-token', '0d21f23254473e54d70a07286f61f2a8c062e4d79411ec0b62cf432167519655', '[\"*\"]', '2026-03-02 15:56:56', NULL, '2026-03-02 15:54:41', '2026-03-02 15:56:56'),
(11, 'App\\Models\\User', 7, 'api-token', '4896f965b80e5b40733fffce5045387775f3480c05cfc89f4ecc5de2e84affb7', '[\"*\"]', NULL, NULL, '2026-03-02 16:01:11', '2026-03-02 16:01:11'),
(13, 'App\\Models\\User', 2, 'api-token', '287b5fe69ace3eef790aebdceb692203e6d58176eb2afe855fcf977a62ea7014', '[\"*\"]', '2026-03-02 16:05:47', NULL, '2026-03-02 16:02:33', '2026-03-02 16:05:47'),
(14, 'App\\Models\\User', 3, 'api-token', 'b6dc0d8f477caa88bfd4b5a659374609ba6e8b2ec13925b67c9bdfe8ce9c1f22', '[\"*\"]', '2026-03-02 16:06:12', NULL, '2026-03-02 16:06:05', '2026-03-02 16:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rejected_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `status`, `approved_by`, `rejected_reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Pending Post', 'This is a pending post', 'pending', NULL, NULL, '2026-03-02 15:33:58', '2026-03-02 15:33:58', NULL),
(2, 1, 'Approved Post', 'This is approved', 'approved', 3, NULL, '2026-03-02 15:33:58', '2026-03-02 15:33:58', NULL),
(3, 1, 'Rejected Post', 'This is rejected', 'rejected', NULL, 'Invalid content', '2026-03-02 15:33:58', '2026-03-02 15:33:58', NULL),
(4, 1, 'Author Post', 'Post content by author', 'pending', NULL, NULL, '2026-03-02 15:45:04', '2026-03-02 15:45:04', NULL),
(5, 6, 'Author Post', 'Post content by author', 'approved', 2, NULL, '2026-03-02 15:56:50', '2026-03-02 16:06:12', '2026-03-02 16:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `post_logs`
--

CREATE TABLE `post_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `performed_by` bigint(20) UNSIGNED NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_logs`
--

INSERT INTO `post_logs` (`id`, `post_id`, `action`, `performed_by`, `meta`, `created_at`, `updated_at`) VALUES
(1, 1, 'created', 1, '\"{\\\"status\\\":\\\"pending\\\"}\"', '2026-03-02 15:33:58', '2026-03-02 15:33:58'),
(2, 2, 'created', 1, '\"{\\\"status\\\":\\\"approved\\\"}\"', '2026-03-02 15:33:58', '2026-03-02 15:33:58'),
(3, 2, 'approved', 3, '\"{\\\"approved_by\\\":3}\"', '2026-03-02 15:33:58', '2026-03-02 15:33:58'),
(4, 3, 'created', 1, '\"{\\\"status\\\":\\\"rejected\\\"}\"', '2026-03-02 15:33:58', '2026-03-02 15:33:58'),
(5, 3, 'rejected', 3, '\"{\\\"reason\\\":\\\"Invalid content\\\"}\"', '2026-03-02 15:33:58', '2026-03-02 15:33:58'),
(6, 4, 'created', 1, '\"[]\"', '2026-03-02 15:45:04', '2026-03-02 15:45:04'),
(7, 5, 'created', 6, '\"[]\"', '2026-03-02 15:56:50', '2026-03-02 15:56:50'),
(8, 5, 'approved', 2, '\"[]\"', '2026-03-02 16:04:10', '2026-03-02 16:04:10'),
(9, 5, 'deleted', 3, '\"[]\"', '2026-03-02 16:06:12', '2026-03-02 16:06:12');

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
('I7mJ5zGJaAfljBNkA26JeotkrKVZNMbojNXSsfn4', 3, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ2lUa2dnVUx2R1dQSXBzS1k4SVFEVzRKZmExbGFYZ1hxQTNRazlwMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3N0cyI7czo1OiJyb3V0ZSI7czoxMToicG9zdHMuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1772487615);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('author','manager','admin') NOT NULL DEFAULT 'author'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Author User', 'author@test.com', NULL, '$2y$12$LMziZ2HzGd2QFgzCJ.1vaOBjxItxKU/AA/DYcQpA4pS8bpT/Ygz5i', NULL, '2026-03-02 15:33:57', '2026-03-02 15:33:57', 'author'),
(2, 'Manager User', 'manager@test.com', NULL, '$2y$12$oq9P6L554h04U7/pTzP0Y.C.2ao0add791/YSgf7TOdjQOey8OVFW', NULL, '2026-03-02 15:33:58', '2026-03-02 15:33:58', 'manager'),
(3, 'Admin User', 'admin@test.com', NULL, '$2y$12$qGf.AUtP85dVCZD2Tu0KA.6wJ.VkAXnNstS3OEaUcXECl3R3MzV0.', NULL, '2026-03-02 15:33:58', '2026-03-02 15:33:58', 'admin'),
(4, 'Test User', 'manager12@test.com', NULL, '$2y$12$/iZl9qB3Vv.D84RvMxtE3eLN9kD8avOvrUGNjdN/.GDMbMc3fD8Zu', NULL, '2026-03-02 15:35:30', '2026-03-02 15:35:30', 'manager'),
(5, 'Author User', 'author_another@test.com', NULL, '$2y$12$AeKygcQ2esSsVdyt0//TEuiDDegADSzwScY0KzGSJ5QkUU49qrzdS', NULL, '2026-03-02 15:42:52', '2026-03-02 15:42:52', 'author'),
(6, 'New Writer', 'newwriter@test.com', NULL, '$2y$12$HH273eKRlfQAEvFgR76m6.BsSlL.q2Ufc8BTeSU83ul4LXAF4sFGO', NULL, '2026-03-02 15:53:57', '2026-03-02 15:53:57', 'author'),
(7, 'New Writer', 'newwriter1@test.com', NULL, '$2y$12$.6gWW0BYWASIDqq8y8frTuWg43u7MFW2ZWNv8NnUsxN5fSSlgd2xO', NULL, '2026-03-02 16:01:11', '2026-03-02 16:01:11', 'author');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_status_index` (`user_id`,`status`),
  ADD KEY `posts_approved_by_index` (`approved_by`);

--
-- Indexes for table `post_logs`
--
ALTER TABLE `post_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_logs_post_id_foreign` (`post_id`),
  ADD KEY `post_logs_performed_by_foreign` (`performed_by`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_logs`
--
ALTER TABLE `post_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_logs`
--
ALTER TABLE `post_logs`
  ADD CONSTRAINT `post_logs_performed_by_foreign` FOREIGN KEY (`performed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `post_logs_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
