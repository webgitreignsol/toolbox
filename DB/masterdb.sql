-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2021 at 02:21 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_08_134026_create_permission_tables', 1),
(5, '2021_01_08_134156_create_products_table', 2),
(6, '2021_01_14_085631_create_categories_table', 3),
(7, '2021_01_14_091152_create_subcategories_table', 3),
(8, '2021_01_14_151600_create_dishes_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(4, 'App\\User', 3),
(5, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `added_by`, `updated_by`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'role-list', 'web', '2021-01-08 09:14:08', '2021-01-11 03:27:49'),
(2, NULL, 1, 'role-create', 'web', '2021-01-08 09:14:08', '2021-01-11 03:47:49'),
(3, NULL, NULL, 'role-edit', 'web', '2021-01-08 09:14:08', '2021-01-09 08:00:49'),
(4, NULL, NULL, 'role-delete', 'web', '2021-01-08 09:14:08', '2021-01-09 08:00:45'),
(5, NULL, NULL, 'product-list', 'web', '2021-01-08 09:14:08', '2021-01-09 08:00:05'),
(6, NULL, NULL, 'product-create', 'web', '2021-01-08 09:14:08', '2021-01-09 08:00:08'),
(7, NULL, NULL, 'product-edit', 'web', '2021-01-08 09:14:08', '2021-01-09 08:00:12'),
(8, NULL, NULL, 'product-delete', 'web', '2021-01-08 09:14:08', '2021-01-09 08:00:17'),
(9, NULL, NULL, 'user-list', 'web', '2021-01-08 09:43:31', '2021-01-09 07:59:26'),
(10, NULL, NULL, 'user-create', 'web', '2021-01-08 09:43:31', '2021-01-09 07:59:21'),
(11, NULL, NULL, 'user-edit', 'web', '2021-01-08 09:43:31', '2021-01-09 07:59:14'),
(12, NULL, NULL, 'user-delete', 'web', '2021-01-08 09:43:31', '2021-01-09 07:59:09'),
(13, NULL, NULL, 'permission-list', 'web', '2021-01-09 05:55:14', '2021-01-09 07:58:46'),
(14, NULL, NULL, 'permission-create', 'web', '2021-01-09 05:55:14', '2021-01-09 07:58:42'),
(15, NULL, NULL, 'permission-edit', 'web', '2021-01-09 05:55:14', '2021-01-09 07:58:38'),
(16, NULL, NULL, 'permission-delete', 'web', '2021-01-09 05:55:15', '2021-01-09 07:57:50'),
(17, NULL, NULL, 'category-list', 'web', '2021-01-14 04:21:53', '2021-01-14 04:21:53'),
(18, NULL, NULL, 'category-create', 'web', '2021-01-14 04:21:53', '2021-01-14 04:21:53'),
(19, NULL, NULL, 'category-edit', 'web', '2021-01-14 04:21:53', '2021-01-14 04:21:53'),
(20, NULL, NULL, 'category-delete', 'web', '2021-01-14 04:21:53', '2021-01-14 04:21:53'),
(21, NULL, 1, 'dish-list', 'web', '2021-01-14 04:21:53', '2021-01-14 10:00:46'),
(22, NULL, 1, 'dish-create', 'web', '2021-01-14 04:21:54', '2021-01-14 10:00:54'),
(23, NULL, 1, 'dish-edit', 'web', '2021-01-14 04:21:54', '2021-01-14 10:01:02'),
(24, NULL, 1, 'dish-delete', 'web', '2021-01-14 04:21:54', '2021-01-14 10:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `added_by`, `updated_by`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Admin', 'web', '2021-01-08 09:15:51', '2021-01-11 03:45:55'),
(2, NULL, NULL, 'User', 'web', '2021-01-08 09:29:42', '2021-01-08 09:29:42'),
(4, NULL, 1, 'Vendor', 'web', '2021-01-09 05:03:16', '2021-04-01 07:04:52'),
(5, 1, NULL, 'Manager', 'web', '2021-01-11 03:50:49', '2021-01-11 03:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(5, 4),
(5, 5),
(6, 2),
(6, 4),
(7, 2),
(7, 4),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `added_by`, `updated_by`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Admin', 'admin@reignsol.com', NULL, '$2y$10$3TWU8LoWfDo9RuTnyC.mqecOXH.tec3.2XuNWQuBm1v3kA9RJKiOu', NULL, '2021-01-08 09:15:51', '2021-04-01 07:05:49'),
(2, NULL, 1, 'User', 'user@reignsol.com', NULL, '$2y$10$y7IpMVBSluFe3Te.RKfDdO6hiao1Zu5FXdYfbvrAcJ6RHoTKcvw1q', NULL, '2021-01-08 09:30:13', '2021-04-01 07:05:23'),
(3, NULL, 1, 'Vendor', 'vendor@reignsol.com', NULL, '$2y$10$gQCo7oTKD.MZ41bCn4zY0u5X6o3iXep3Waand5LMibFMHxpTZ/C0q', NULL, '2021-01-09 05:07:09', '2021-04-01 07:04:39'),
(4, 1, 1, 'Manager', 'manager@reignsol.com', NULL, '$2y$10$G4VvdmeO8bgetdVYdlHjauaWfTKFcpipeaBSTuNPgJVmE3Nu8R7ES', NULL, '2021-01-11 03:13:45', '2021-04-01 07:06:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
