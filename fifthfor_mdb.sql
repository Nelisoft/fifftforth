-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2026 at 03:47 PM
-- Server version: 11.4.9-MariaDB
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fifthfor_mdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `username`, `email`, `country`, `country_code`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Raphael Palmdale', 'admin', 'freetimebusinesssuite@gmail.com', 'Nigeria', '+234', '‪+234 912 370 6987‬', '2025-11-11 11:11:58', '$2y$12$4HV9k6TDYI3hn7bsMEHoV.t2bsxf4efoBfyOLCnyNamaogvAYmY3e', NULL, '2025-11-11 11:11:58', '2025-12-05 19:01:47');

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
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `transaction_reference` varchar(255) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `wallet_id`, `amount`, `status`, `transaction_reference`, `payment_proof`, `created_at`, `updated_at`) VALUES
(16, 10, 3, 5000.00000000, 'approved', NULL, 'deposits/69335145634ff.png', '2025-12-05 20:40:21', '2025-12-05 20:42:24'),
(17, 5, 4, 5000.00000000, 'approved', NULL, 'deposits/69355469c0428.jpg', '2025-12-07 09:18:17', '2025-12-07 09:18:27'),
(18, 12, 3, 5000.00000000, 'approved', NULL, 'deposits/6937876d10e79.jpeg', '2025-12-09 01:20:29', '2025-12-09 01:25:12'),
(19, 5, 3, 100.00000000, 'pending', NULL, 'deposits/6976c605cd3e4.jpg', '2026-01-26 00:40:21', '2026-01-26 00:40:21');

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
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `profit` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','completed','cancelled') NOT NULL DEFAULT 'active',
  `started_at` timestamp NULL DEFAULT NULL,
  `last_profit_time` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `capital_returned` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `user_id`, `plan_id`, `amount`, `profit`, `status`, `started_at`, `last_profit_time`, `ends_at`, `capital_returned`, `created_at`, `updated_at`) VALUES
(7, 10, 4, 1500.00, 900.00, 'active', '2025-12-05 20:46:17', '2025-12-17 20:46:17', '2025-12-12 20:46:17', 0, '2025-12-05 20:46:17', '2025-12-18 01:57:24'),
(8, 10, 3, 1000.00, 600.00, 'active', '2025-12-05 20:46:50', '2025-12-17 20:46:50', '2025-12-08 20:46:50', 0, '2025-12-05 20:46:50', '2025-12-18 01:57:24'),
(9, 10, 3, 500.00, 300.00, 'active', '2025-12-05 20:49:32', '2025-12-17 20:49:32', '2025-12-08 20:49:32', 0, '2025-12-05 20:49:32', '2025-12-18 01:57:24'),
(10, 5, 3, 500.00, 1225.00, 'active', '2025-12-07 09:18:59', '2026-01-25 09:18:59', '2025-12-10 09:18:59', 0, '2025-12-07 09:18:59', '2026-01-26 00:39:36'),
(11, 12, 4, 5000.00, 2250.00, 'active', '2025-12-09 01:25:53', '2025-12-18 01:25:53', '2025-12-16 01:25:53', 0, '2025-12-09 01:25:53', '2025-12-18 01:53:31'),
(12, 10, 4, 3800.00, 0.00, 'active', '2025-12-18 01:59:14', '2025-12-18 01:59:14', '2025-12-25 01:59:14', 0, '2025-12-18 01:59:14', '2025-12-18 01:59:14');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(3, 'default', '{\"uuid\":\"6e57c7fd-1706-45d8-8df0-916a517be94f\",\"displayName\":\"App\\\\Mail\\\\InvestmentCompletedMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:32:\\\"App\\\\Mail\\\\InvestmentCompletedMail\\\":3:{s:10:\\\"investment\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:21:\\\"App\\\\Models\\\\Investment\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:2:{i:0;s:4:\\\"user\\\";i:1;s:4:\\\"plan\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:18:\\\"nelskidd@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1764221426,\"delay\":null}', 0, NULL, 1764221426, 1764221426);

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
(4, '2025_11_06_103913_create_admins_table', 1),
(5, '2025_11_06_104216_create_wallets_table', 1),
(6, '2025_11_06_104217_create_deposits_table', 1),
(7, '2025_11_06_104941_create_plans_table', 1),
(8, '2025_11_06_105003_create_investments_table', 1),
(10, '2025_11_07_155302_create_withdrawal_settings_table', 1),
(11, '2025_11_08_121559_add_last_profit_time_to_investments_table', 1),
(12, '2025_11_08_174433_create_settings_table', 1),
(13, '2025_11_09_105058_add_referrer_id_to_users_table', 1),
(14, '2025_11_09_114059_add_referral_bonus_to_settings_table', 1),
(15, '2025_11_09_133827_add_referral_bonus_received_to_users_table', 1),
(19, '2025_11_29_074117_add_kyc_fields_to_users_table', 2),
(20, '2025_12_03_071040_create_password_resets_table', 3),
(22, '2025_11_07_132121_create_withdrawals_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('donnelskid287@gmail.com', '$2y$12$hqFgQOzoKkjRCSoTO9QEqek4J8uPghJ80.htoYl1PBuA/pTLMIrs6', '2026-01-26 00:49:42'),
('nelskidd@gmail.com', '$2y$12$1jHcNOw6l0I2xJEsvwyp6e7YBhi1rZXiS9isk9LapIMJyvhdu8V0i', '2026-01-27 10:42:29');

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
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_amount` decimal(15,2) NOT NULL,
  `max_amount` decimal(15,2) NOT NULL,
  `daily_roi` decimal(5,2) NOT NULL,
  `duration_days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `min_amount`, `max_amount`, `daily_roi`, `duration_days`, `created_at`, `updated_at`) VALUES
(3, 'Trial Plan', 500.00, 1500.00, 5.00, 3, '2025-12-05 18:43:27', '2025-12-05 18:43:27'),
(4, 'Advanced AI Trading Plan (TradeGPT)', 1500.00, 10000.00, 5.00, 7, '2025-12-05 18:45:57', '2025-12-05 18:45:57'),
(5, 'Joint Trading Plan', 10000.00, 50000.00, 3.50, 14, '2025-12-05 18:47:20', '2025-12-05 18:47:20'),
(6, 'VIP Plan (Special Growth Edition)', 50000.00, 500000.00, 2.30, 30, '2025-12-05 18:50:26', '2025-12-05 18:50:26');

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
('07l4gVB0TPcElfgkqag8aIS5E2LXMUguSjRTkjwT', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3ZoeGtNWTNubzZ4YjZhMmdyZHhjOU82cFo3QWxpbEczWm9Fb0toSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516848),
('3ZUhIoqrl6kYgqpLmUdNlsbDe3Lv6BoTh3yrYiVV', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2hOZDMyVW9Fc1lvb21CaFp1S1lNa0oxZm1OWnRiRnQ3S3RUUzVuUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516286),
('40BAznjAp7Fd2BzHgIFVIch2tuW8i9EyjsN7hNH7', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0RUMVRRemxZbUszNUF6NkhKRVVHTTlzd2c4akhhQWpPcXJqblZ0eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513312),
('4tD1OwEMnNAZ5Ujx1vfVju44GMYHRGA5958uXgFm', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTE80cjN4YUVIY2c0YnYyVkZBU1FBbDhCV2ZrdXNkdGdmaFRpMFFaTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516267),
('5VH7Zjgf7r6pbU1eLJ7DI0jap5NpjlY4MkHUxVIr', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFFNYWxXZDVFU0RwZ200d1A0eHBUZUlqNFFBS2lmZ2ljNFBuTEphNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513295),
('6LWFu4LLuWEJplFKWCrbXZ48bKIePyefVI9UoODm', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjlBV09UWmdOQThLWk9Zak9vOUxhMkFzY3pTSGI0YXl0SlNqOEJuRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516883),
('6N3IpRhZ6xCwLmzq34qWakGWzR25fA3HtZJP1k5h', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmFOVzZYWnpBbTk5VnlGTXE0T25PV0tDVkFVaVpyY3ZNQnljd0FTUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516865),
('7ujexNIq6csNMSdgvqiWF89sUgHWl9ZjdYZ83Fvy', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1RWbDRsT01Dak1OSzRGUU5YNUh2QTNoaFFIajJnVHhHWEVmVWdqRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513417),
('862SH3b1lrHNcqzfQPuLFZlYJun4jT5XFnL3LTOl', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUERhNzl3OUZCbVBXMHNncXp2czgxVWtvbHN0bWd5RE4wZWo5c01nWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516575),
('8Xqh1PQNIhlQKZwgLxEH4qCxC9SlrfXPQJ6vW6Is', NULL, '66.249.66.2', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.7499.192 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1JBclBycWkzOFhCZ0txWnVTbm1sNkVSMmF4OXk0WUVRVWVuZEZReSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769511655),
('98On7JlkAr1tf6nxGQmLNHrcYWQBhsT5X5lCSjso', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2Rvelh3TFBLbzZZZ09ZdHVOaXl0Q2dHSDRzdm10RkJVbXlkSHJHVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513261),
('9eodfQQWgBMFep5WqnnvfD9z1Z361XxGQbP10NqA', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWhkbjdBaWlhYXdXQUhVU1FuVXAzRjYzQWluY0JYcGtXanhXNkxTeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516977),
('aFW6mahfBUjCew1TQkqrYTq969zrluEJ4BiW1LLH', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkVrcjZYVVA0YnA1b3JFdE5RNTBQUFlMaFp6VXRkOU1RejRIRkhtRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513243),
('auOgYRkWpHTC5b7xf3PFXfmS5jmuZyOGFTpaROql', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzVvNjV2VWdvUUNSRHFYdjRCdG5hajBhM1Q0aE9lWUtkVHRQRE12OCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517277),
('b7O1Hr4a9CAqy90tqDyxnftOJIhGBwWiGisECA63', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjdVbEtacmp2MVM0cDFEdHhOaU1wZmNpMEpld3ZIbnIwdVBBSWNwMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513770),
('bybDm9iZlXiUS55N1zuhOR1mFfDOlIYQqVZrRSsZ', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienZBUU81WnpXdkZWZ3ZKTU8yOFg2NlVNTnNBSzVFaWRkRExBemdzViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516596),
('C4aHJDoVnUcLhJMaOvOPtp8DjF0MerOC2sAacSNf', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkxKM2c1TEx3Z3JPa2FERXJwYzdoY2RPWkM5OXBVRDczUXp3U2ZaYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513833),
('CIxHvqCLh1w3HpJHEnxjQdR1pxDyXjOvbrlajSG8', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3BhTWRMaFBmZWM3RXVwOTRkRmpZMDFvY2FBY0FuZEVLUXpyY0s3VSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517292),
('cMrWBDIsvOdS39HCb3zAUSx0vQxTLOJ88WQT1DLf', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1VWajFKNGtwQ0YxRXRNaDRFVmRXaFVGT2xYbmtTYmZ4N043NEZCMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517486),
('cWCtXydHSEHKKr2kTymMxhJpbOzS9KvYaxf2kpdH', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmdGdXJQeGNHbFNIckFhNlFUSGh1SVl5dGpoMWN2clRRODQ1TWN5OSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517265),
('Czzr3Amk23j87SAY74m8lmRto3SHyMivA5blNSj6', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1pqU0JYclBOd3hVeU0zM1FRZkRvZ1UyNEJpckxySTVGZllEREJRZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516277),
('DDTBgSHezTteCE3ifKXSfcYE02oupW5XyENqo0S0', NULL, '105.112.208.189', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5.1 Mobile/21F90 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWhnN1lpSW5lNVpVaWJzczZja3JEcXQ1TlFHNDl1ZkJjRVlxNnptTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20vdGVybSI7czo1OiJyb3V0ZSI7czo0OiJ0ZXJtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769520127),
('Df91Lz7xhvTDYxveYrDOJGqn0abp1lJABgoiTzHo', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmpMY1NoWmdmaVQycndaYk4zTklhYzJHUEdvdVNMUUVFZFc1VWM5QiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513354),
('DiTUUmuDwrRb9ztf65f8OGWuCZmJ3BNZIuy4R6V3', NULL, '197.211.52.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUZwdzUwOHE5SEd5SmFmako4T1VjQ3JwYVpkUllScFBJNkZPSDVWTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20vdXNlci9wYXNzd29yZC9yZXF1ZXN0IjtzOjU6InJvdXRlIjtzOjIxOiJ1c2VyLnBhc3N3b3JkLnJlcXVlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769514210),
('dr1eeZcZBUsrZd4AprtYbnIOIb67d47NkqvXqCaU', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia09pZWdSdUJnbDZCajFaSnlPWnhEWThESnJRTVRCNXlzZWtnMm5tbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517441),
('EzzZ025yyvyihNo0FkqkR36TpjYgnp3TlKh25zO2', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFJNd3NwZkxGWGFLT3M2VUR4UnlYTTZUazRSRXdZdDNWenNOT3BSYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513253),
('fCTKGBqpr7p1QIUjjTaG4kSmg3Fgziddhacoq7i1', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHdtMXNieTdRWllNeHVubWZiV2NQUU45MDNpcmZFMElvelB2bERUeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516960),
('FyzXpPGtVVOdhAI6NV0I8feAuLId0QmAygYvV0it', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlNQaHR4bTJBRWdaYWNlZ1VJTHhjZEVXRDR0Tmgyam9SbHpoZ0tVZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517925),
('G5tjK4fVhRr7WSp9sR4usqffGfMbysSBJ42cATBh', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjR5cnlvdE9GYmpvdkowaVNqSVdJVEM2VW1BdXVpT0pHcG1ERXdXUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517496),
('gJatGbDqQc2eJeSjkWWFAMb7MfhTapqe6eqP6OLG', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWElMN3dOaUhZa0NVb1ZnTjFSYkhkN0R2VTlSR01CMWtGUVlTTEloZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513321),
('gJJVJjjvLg0YiBq3pC9bqw9pJQe3NSSJRTVYTYm7', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVVYNXp3eHI5dWNzNlhQUWtqWEJibGs1b2o1QlhoYXNjbndFMHZaUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513338),
('GUPZtYGkY55EGxH8AZat8aNOzLWGYV3OOY0mjyaV', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1J6WTNSejNGaEk2M2Y4ZWhjR3hUQUF5T1ZyRkF2YmMyMGVqMURSSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517455),
('gX7XUZOvk1BoGCfTOUWl9f7pqcKYxy2Fu2l0XihL', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieWlQSXF0cHJYR2R1U3NZcjhSWTRJZ0g3TncxWkVjRVhxUHdpdWdhTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513269),
('h0ZiUbIdXfGa2KP4FeizSR43P6ZWStwoJc3nmWzh', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDVjWXJNUElWMHZ0d3NSazVQU1hVMUJjZUxsWVBwU1BzRTZveHppWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517310),
('h84MoVPpxNqknYIcHqPVgVlJ4PsjvO9EvpWurcWd', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1F2YUVpeFZOazRycUwxZlBLTWZWNmpxSkw4SlhJemcwcDZUVjhxTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513304),
('HkgOxWrDr5VelbbHDjQmVx8Zd3HGCFsFva6If8KS', NULL, '197.211.52.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMUsxNEJJMHZBOTB4ZXVnc3FSOFRoQTh2ejdWWWN4NnA1eHdsU3NhdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769512282),
('hKTxiUyjqsrpTYKW4DOIuDrwfvJryVrgBHVoffPi', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDEyTnExVkFjTnpCOHNDUTZCQ2dBakgzeXRQWVZ4ME96STFpNnVybiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513217),
('hLzJtqZaqBpzH6HOVLOH0lW2XF3VetWrCUYsNuIa', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTVhMEVRQWxiSFdWMTBITThWcVkxVElKSEhyRG12ckEydEtYa1ZVciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517353),
('HPC8069nHWshXcceE6Ra6INO4P34q22S0EfUYTGA', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2xIUzd6a0tzTkxZTnlwazYyWjhWeHVwU0d3bUMzSVRscHdiRjV0byI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516873),
('hY2XUzR1u69ZlCDMnFA7o8p4vHVAJA6zq2sy4Xrl', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSERncEg2cHhKRnZJZXRZdk55cFd5dkh1c1huZWtpWk03MlpCTDJ4ciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516906),
('iaN4KaUN4wwtK6WeIcRNW1TYQK56JRNRN3jwGTXe', NULL, '197.211.52.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2lVWXNmRWNyV3I4bVE3d1ZVSFlFQ1JiOHJTdmpHdGpOSHZLNXUyeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20vdXNlci9wYXNzd29yZC9yZXF1ZXN0IjtzOjU6InJvdXRlIjtzOjIxOiJ1c2VyLnBhc3N3b3JkLnJlcXVlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769512582),
('iGuQ1XD2qZCXEAFR0GBRROzsSYwgCmNkPAK5Lz7n', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2xQRklicWVPTm5ZTFdINDdEY1B1ZzVEbzI4RHJ0OFN1c0RDVVpRMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516607),
('IXmSOXyNAeXN9pgrFm0O06w9ReAdIgo9QOx8VKNF', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzNPSFFHcmhUbG5aV1k3Mm5CeW5Na09RYjVvVUhPSzAyRXN2TDBROSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513190),
('IY9j5UjRqjnuHTkuX6401CwWtg7pl56hzSNZRkvz', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXVTS1BweHNjTFZpSzBUcXI3ekRDdjlHN0ExMVhYeDczZ1BWTnliNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513287),
('Jc9jqTlJ0KYbwHWHyZNilCS25xrwDWTZd6heEcfY', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZngwRk9ldkYxbklyb2VOME1hWHYxeWNDd0EwUVpFQjA0R1pUYUhUQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513382),
('jNllCB3wPd9LBSk5Wuc0RKg7SmCjBllWtpCtgsT3', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkxsR1NjTEZqNWViUDdVWEZZUFhNZDVEZUxJcnFGVkFVd2oybmFNRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517374),
('jxxAEwMly7DDKFl7oOoFNmlJPQW04iEdehDYVWV8', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak1BQWxkUVFmVkdWOW5hRW05UXFSdkJqSE9VaGFLam1PbTlLS3Y4diI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517133),
('KFx1UBiBh4TJlq6gxzDJGfoPAIK7KHhxzlEwvNe7', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYU9KMWJOWk42QXl0TGpsb29ucWhUQ3lOakV6eWxtcDBnU0hmdVpoQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516856),
('kpLvMda91bTeuyhSrZHNl0mhCDPo5TsvT0yPnOeT', NULL, '149.154.161.216', 'TelegramBot (like TwitterBot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT09pRzhTQlN6NDh4MjlMY21ibHVtSXc3TGFkb3FpNGRZemI4bUJVSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20vdGVybSI7czo1OiJyb3V0ZSI7czo0OiJ0ZXJtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769520146),
('kQgIuu7kBQW6w3lVTewBzZQw9DF95nRIKADg6p9h', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzhhaTFIU0t0RTlFNTRIYzNUQ2taVVZ5Y0xXdE14T0J4OTF3SzJWVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513409),
('l8ycaV2P7EuIU2OBvqnXTQ8dXDlgvmJk42rX2Lur', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDkydmJxMWJvWGkxQlUxZlNGYk85N1FKcGw5bFVEbjIyVWRwTmFRSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517386),
('lCUP4mQyEqsRNpykwsd0uo5ZJLsycFm3MCLGW17E', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWpaQnZ3N1Y3REdUVWZ6TWphcWdaWjBEMlZSUXh6elRVWUFlTkZnTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517343),
('LIR5D4bYmFiyyzPGyv2x7TkrWjkS1aurgqRNYwgd', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTNrQjRoZUZQS1NxUDdWSzloZ3VVdGUxMDRNc3h5d2xXM3RTMUZkRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513400),
('lvQPJJTG7bLl6pX0ws6ZeIyVRPF97xkqMCLu8cuU', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak0yWjJ3Q1E4d3dna25oaEdIM0tMZnBuMXU2V3FBZXh2RkZsWmZ5MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516938),
('mk1ZXHuRpl0u4KA4ioNxlzZzL9Lpj4KlkbdHjAIR', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2dldFBLdWRhVFYyMFNuQ09jUG9WV3RIVlNaTVFqWnU1MzNtcHFWTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516917),
('Mu5hqQhodHXmCRlIQXXpQA1CVSS0MPT0ef8EtfZv', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3ZURThoVURkNEJuWnBWMjZDaERUblVxb1RrczhVczRJRGF0WGV3QiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513751),
('n1rPQU0TJDKPOoP3IkDiUAG0hWZDxsRfNSIAuRcN', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUVFeWRJUzhDRFRZUVRoM2phTG50RmlpQWRxaWtlQ1oxMmw3UjZ0NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516950),
('nrPKOu6LIUkIXTyYedl0oHG27jwNueXxU3bW6n1C', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmNQSm1oVzlsTlJLcnVsVm1KcEk0YW9wZVVDRXI5NEdiYVZiWHBFMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517397),
('NrTub4YeIfSOtCAPcVudVb2uk7fA83mOuq1N1eXS', NULL, '72.27.22.220', 'Mozilla/5.0 (Linux; Android 15; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.7559.59 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMnFpTUZXcjZqdTNZZHowbGcwYWVyZ1o5WEJOVkRTZEExRXJuVW9RUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20vdGVybSI7czo1OiJyb3V0ZSI7czo0OiJ0ZXJtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769520307),
('obF3qsaKt18kpUUDJgndrmXueioGDiYfeajG40oi', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWJIREJFb0ZPNEw2Z0djaVhUemoxa3ZkM2FaSHZIWDc2RldJRjFGMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513391),
('oRdagu5EyW0IZ2jljPMwg4REtJc7urCwJWpgJRYg', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnAzTUtaaVIzMjlDNlNzMnMwR0l5dDB5STNkS3JrVlpSWG90Vm5vRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517253),
('owN2S0JC9ZdwikDs0vDjgrlc8QGu1VdpostwBFD6', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWtlMkljQ0FneG5EQ3AxbmZsQklLQTBobTJMZzRtOG05dFZmb2llMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513209),
('P3Gw61CXjRwnhc1ELHT5tudaU0xmbg30GvnxN21l', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXZFTU8yV1dLOGdDaWtEaUVob3lKOFhnWEltRE9vN0p0c3NlYWpObyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513199),
('ptyyatg3i26V6OvQJGZsyKGBywoS3SxHFG9GcDDv', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTB4WjZLUk5rYU1MNDRwUmV1Nk9VR3FDMGJXY2tyak1vV0RReGdjVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513235),
('pVMOuf3P5CRkTsX38VWUj7nYZyVIF5FAia0pG4KY', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTms3aEw3R2NrVndGQjJac1o2RHM2SkxrT3FJaWNTS0c3ZzRGZGZ6aCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516305),
('qgM6tMySKDYrucDuJpFWm4cJJB1txcGYTjn4HDlP', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkREQTNadmVRZHZVVENSaHJJckFnQzJRYlBjQzgxMUkyUFJ2ZnBWQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513278),
('rBvREIfCV4tU64rG4NieWsida998medjCve6QAss', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0tMWFpVNmJmcUR5Y09INGw5Rkg3R2pGbHlkSkNSS004eFZaQXhtMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513227),
('S2V1sMpKkDb08ihP6KrP7uULBVilo6TcrkZqUlVd', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTJoWnFQbzNBNkFUbFFLN08wMVZOdXpEbGRXZkY4WjNHM3BRcVR6VCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513346),
('SW4bIlOcIRFHfDGS9ED1U6ZXIVNWVkxRJmX34Ko6', NULL, '72.27.22.220', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDlKeFZIYms5eE9Ickoxb3hmMVY0N0psSFZHY3Y3ZXpUVmJtMG5kUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20vdGVybSI7czo1OiJyb3V0ZSI7czo0OiJ0ZXJtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769520380),
('tAS0JXggg2n5kMPLSVaTD4GUp7dysGDa2Gj1wM9y', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGVJdmI2UlJTY3F3QUx1Wm4yTlFxdXV0Y3V4cnNFb21hdjgwMWZydiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517936),
('UG1SEptXVtuQRq9tH8KsL9llFFo7bFqhWwIQJ0Fj', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDdZUVRlM1dPa1JvZXZhU1Q5cUNUc1lQV21naUExTTdtcW4yQ3dBbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517978),
('UGHJJfx9fNDk5j3XIZNiUVu765p5umz4zWlbxi3W', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVNhd1pWVlcyNHprSXJPRGRzNjZaaXBKN1pLV0dqWDI5elBGaHVhbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516986),
('wHWyI8YFAkA9xsWFra0VHMeNLFKDgHZoAbww6uI3', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUhzQTA5U3VLT3JuRXA1MmQ1d3RJaUh2U2ptNXkzSDZVQVhvdmpTNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517506),
('wQ2p8UPtJLsNfwwZjOa6m7z65dulNhOW2fEo9L15', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEs3UnhWNnoxZHFDbmJqcXl5STBnSFNHOHV6TzZyZnR4QktDUzUxZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516296),
('XbSOkxhW6d5vbuEs0hWaCtcoJFjH56mxT9x5BjXd', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUhTT0lieDRwSGVMQmpyZ0hLNmxneFRkOWp6OHVhUGNRQ3M4c1ZVSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517363),
('XdKGwcoE5NfTd0ojb75tXlvBllNMwPL0B2UUklv1', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmphdm9KTmlkaTZlemdiMk53VVd3YkpQdEtRbHRzQmNPcDZGdDNLciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517321),
('XSwk5xTr4nXxzI2bQhTE913KFx4AJSoOVCNm68oX', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGdFeHBZRnlreU5sRkxzekdTVWxIZXhkQWZnaUV3NWx3dXNJYjRIVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517334),
('xUhpWcnZQtZE3pHX2pw0ZiZ9crXc3zO1oEukM5pj', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1ZSM1NkT05UVkRVRTFhV21nMkM2dmh2dE04YXlqVU1rVFZWUmlRTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516894),
('xyMba0sVCp77bmtfT2WvR6MzmzIx3EDbH9qbur8o', NULL, '197.210.55.132', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTc1Qm5kcDM1aFkyTXdMRVZIWE50eWN2ckhUU1dPaUNnNTdsY25kUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769525067),
('y2FBoRnurDwrm5eoerL8tr48hZ90wtUieDDskZkJ', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEZEemNPQ2Vqc3JqTHlXWXJrOVRjOVh0cGp1dHNxd3FqTGtkMm1ETCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513330),
('YAT5T7hTKkxzNub1dYoP2CQMOTjMAVwco71TSY3Z', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzd5dnRHd29ycldQdVdjZXhqYU9GRG1Gd09LbVV0WVA1OENlTHBnVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513363),
('YcbKSyIb8gq0A2OiTHC6gFj3EgVWw6XL69O0QW9B', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjRUbk12TXV0a3dkcXZwSU9UZXZ4UnFyTFRpeTE4blV6QmdFdUlyUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513373),
('YfhOntJBRPdT624YhSsLMLEvBbekYxSBhMfakklB', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGZRMjdEQVVWTjlVb0V5SU9zZTBEMFdJSXd3M0hWUnZHaEpiRFI0dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769517948),
('Z8Hk4o7Lhqj2lN2I37EN5FSJb1sZ2t1v5W1iJBbw', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEpXZVpRNFZlV3MwSndIUjZxNWowcmUwUU1wY3JVN1ZUQW5TNHBFWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516927),
('ZmbEaPhSqef5kdyeJJRxH7isc4I6qXZ4ng4JV7eE', NULL, '104.28.82.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVZTeTlqdHFRQzhSWjRoRWF1NkVTdzV6dHNPdzJQT3FBSjAxM0xjYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769513725),
('ZwmeFXCoGbapwsFJehkaV8MuazniZdXCZDUc0RRN', NULL, '104.28.82.68', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWQzRTBrRnd0MDJqNkwzOU9za0I4NVljNXhlRk04SWcxNTBocVo4eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmlmdGhmb3J0aGZpbi5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1769516586);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) NOT NULL DEFAULT 'My Application',
  `tagline` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_dark` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `app_url` varchar(255) DEFAULT NULL,
  `default_language` varchar(255) NOT NULL DEFAULT 'en',
  `timezone` varchar(255) NOT NULL DEFAULT 'UTC',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referral_bonus` decimal(5,2) NOT NULL DEFAULT 5.00 COMMENT 'Referral bonus percentage for referred users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `tagline`, `logo`, `logo_dark`, `favicon`, `app_url`, `default_language`, `timezone`, `created_at`, `updated_at`, `referral_bonus`) VALUES
(1, 'Fifthforthfin', 'Building a decentralized future to unlock economic and societal opportunities..', 'settings/6932fe3372534.png', 'settings/6932fdb056a1e.png', 'settings/zfb1TSs47Z05DasUKMIT0qKj5acFLfe0DdUypJb7.png', NULL, 'en', 'UTC', '2025-11-11 19:23:23', '2025-12-05 17:13:55', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referrer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `profit` decimal(15,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referral_bonus_received` tinyint(1) NOT NULL DEFAULT 0,
  `kyc_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `kyc_document` varchar(255) DEFAULT NULL,
  `kyc_submitted_at` timestamp NULL DEFAULT NULL,
  `kyc_reviewed_at` timestamp NULL DEFAULT NULL,
  `Home_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `referrer_id`, `fullname`, `username`, `email`, `country`, `country_code`, `phone`, `profit`, `balance`, `is_blocked`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `referral_bonus_received`, `kyc_status`, `kyc_document`, `kyc_submitted_at`, `kyc_reviewed_at`, `Home_address`) VALUES
(5, NULL, 'Chuks Nelson', 'mike', 'nelskidd@gmail.com', 'Afghanistan', '+93', '93782772', 1225.00, 4600.00, 0, NULL, '$2y$12$HMB9FBC2NKflZ/ZYtm0jbuHmWt.M4NZRc0JgVHz7Lrn1DOWGwupda', 'DAumK5oix78HTlTwrCfCqQehFe763HjkEbSIjtx1Pjq6b7sn7t6E4HSdrlP6', '2025-12-01 02:30:12', '2026-01-26 00:39:36', 0, 'approved', 'kyc/692d62d864250.PNG', '2025-12-01 17:41:44', '2025-12-05 17:12:36', 'No 3 church street'),
(6, NULL, 'Thomas', 'Thomas', 'houseofattorneyharris@outlook.com', 'Australia', '+61', '9178558907', 0.00, 0.00, 0, NULL, '$2y$12$QEfwDfx3NwlZO9/K5RlNCeldJO9ykt06AZyUCdYZkLcHSgdP.oLsG', NULL, '2025-12-05 15:51:55', '2025-12-05 15:51:55', 0, 'pending', NULL, NULL, NULL, NULL),
(7, NULL, 'Thomas', 'Thomass', 'freetimebeatrice@outlook.com', 'Australia', '+61', '9178558907', 0.00, 0.00, 0, NULL, '$2y$12$scl3PGu1uK1EWX1nu.dMXeeJEEu1lURqJmqRPrfrO7YntxW.Mjd1i', NULL, '2025-12-05 15:56:06', '2025-12-05 16:05:31', 0, 'approved', 'kyc/69330ef27071d.jpg', '2025-12-05 15:57:22', '2025-12-05 15:57:45', 'Gvc'),
(8, NULL, 'Chukwuka Justin Ugwuanyi', 'Justin', 'ugwuanyijustin2002@gmail.com', 'Togo', '+228', '08163131798', 0.00, 0.00, 0, NULL, '$2y$12$fJVnwfOKqXWV3LJCdEky6es47/kSjHXf0ezKLSb3peIXFum9Eib5W', NULL, '2025-12-05 15:59:07', '2025-12-05 16:00:19', 0, 'pending', 'kyc/69330fa391eaf.jpg', '2025-12-05 16:00:19', NULL, '13b Lagos State'),
(9, NULL, 'Reichow', 'Davidreichow', 'reichowdavid87@gmail.com', 'United States', '+1', '2705712863', 25000.00, 40000.00, 0, NULL, '$2y$12$mN3NSbcg/cnshjPCM.uuHuOKTzVvGmXzSa8CCSDsNS0vHR/Lq65YS', NULL, '2025-12-05 18:53:43', '2025-12-05 19:07:18', 0, 'approved', 'kyc/693339c18edf2.jpeg', '2025-12-05 19:00:01', '2025-12-05 19:03:05', 'Raleigh North Carolina'),
(10, NULL, 'Helen', 'Helen', 'walkercandacelynn@gmail.com', 'Australia', '+61', '912846767', 0.00, 0.00, 0, NULL, '$2y$12$prLl6w3kokB3HiMksIzzK./VoCaQTrPGQ9leE/WKDZEk86kh6.Yn2', NULL, '2025-12-05 20:33:06', '2025-12-18 01:59:14', 0, 'approved', 'kyc/693350051808a.png', '2025-12-05 20:35:01', '2025-12-05 20:35:58', 'NYC'),
(11, NULL, 'Jack Hills', 'jay', 'mysticteck@gmail.com', 'Australia', '+61', '0845829973547', 0.00, 0.00, 0, NULL, '$2y$12$JLzJ3uh2bEQpLKPG6Q4ogeECwa3XvwCJgHXU2f9LbnEzQPjXECjVy', NULL, '2025-12-08 19:24:40', '2025-12-08 19:24:40', 0, 'pending', NULL, NULL, NULL, NULL),
(12, NULL, 'Hudson Debra', 'Hudson', 'eorjeifhiebdheduhsu47@gmail.com', 'Argentina', '+54', '53948467587', 2250.00, 0.00, 0, NULL, '$2y$12$xmZKYwO7OLJVdiNrlLcSrOOKdeY0/c0F2AqI0CgAnPQR5Iss5tSZO', NULL, '2025-12-09 01:12:31', '2025-12-18 01:53:31', 0, 'approved', 'kyc/6937871fee39b.jpeg', '2025-12-09 01:19:11', '2025-12-09 01:19:40', 'Argentina'),
(13, NULL, 'David reichow', 'David', 'reichowdavid094@gmail.com', 'United States', '+1', '21566528990', 0.00, 0.00, 0, NULL, '$2y$12$DrsENqhK5mLbFCFmEWWP6OW1D/T5RKFN60f.ZcoMRAwMORVRq0.Vy', NULL, '2026-01-25 03:43:08', '2026-01-25 03:43:08', 0, 'pending', NULL, NULL, NULL, NULL),
(14, NULL, 'Charlotte  Ann Walker', 'Charlotteaw', 'charlotteaw501@gmail.com', 'United States', '+1', '7146866372', 0.00, 0.00, 0, NULL, '$2y$12$nPAcqwgxbtWygCR6ShfQB.U/h7u2KVVvmVg.nPtEeYzVkb/JXb3Gy', NULL, '2026-01-25 21:30:12', '2026-01-25 21:30:12', 0, 'pending', NULL, NULL, NULL, NULL),
(15, NULL, 'Dave', 'Stargate', 'jacksonemabel@gmail.com', 'United States', '+1', '2708152026', 0.00, 0.00, 0, NULL, '$2y$12$9221hGcjvlcGOZHvahvJLuxS9Pikw/OUiieET6DMfwsseKvmeiJv6', NULL, '2026-01-26 00:29:47', '2026-01-26 00:29:47', 0, 'pending', NULL, NULL, NULL, NULL),
(16, NULL, 'Mike neul', 'Mikeneul', 'donnelskid287@gmail.com', 'Andorra', '+376', '0810717893', 0.00, 0.00, 0, NULL, '$2y$12$Y2WRWlwNqafNzTWDbmOIyuOtipqgEH2HtgMPN487rEJN2DjN75qhm', NULL, '2026-01-26 00:46:04', '2026-01-26 00:46:04', 0, 'pending', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `coin_type` varchar(255) NOT NULL,
  `wallet_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `name`, `coin_type`, `wallet_address`, `created_at`, `updated_at`) VALUES
(3, 'Bitcoin', 'BTC', 'bc1qq0lxc9kd08cx6xgshkdcwwxf8qvhq4kw95ft3x', '2025-12-05 18:52:01', '2025-12-05 18:52:01'),
(4, 'USDT', 'Usdt ERC20', '0x0Bb344872e0757cacfBfbd41a4a18f5D26626276', '2025-12-05 18:53:06', '2025-12-05 18:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `coin_type` varchar(255) NOT NULL,
  `wallet_address` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `coin_type`, `wallet_address`, `amount`, `status`, `admin_note`, `created_at`, `updated_at`) VALUES
(1, 5, 'weeged', 'wthsfdsad', 5100.00, 'pending', NULL, '2025-12-05 17:43:43', '2025-12-05 17:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_settings`
--

CREATE TABLE `withdrawal_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_withdrawal` decimal(15,2) NOT NULL DEFAULT 10.00,
  `max_withdrawal` decimal(15,2) NOT NULL DEFAULT 10000.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal_settings`
--

INSERT INTO `withdrawal_settings` (`id`, `min_withdrawal`, `max_withdrawal`, `created_at`, `updated_at`) VALUES
(1, 10000.00, 500000.00, '2025-11-13 02:57:46', '2025-12-05 18:55:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

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
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposits_user_id_foreign` (`user_id`),
  ADD KEY `deposits_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investments_user_id_foreign` (`user_id`),
  ADD KEY `investments_plan_id_foreign` (`plan_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_referrer_id_foreign` (`referrer_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_wallet_address_unique` (`wallet_address`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawals_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdrawal_settings`
--
ALTER TABLE `withdrawal_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawal_settings`
--
ALTER TABLE `withdrawal_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deposits_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investments`
--
ALTER TABLE `investments`
  ADD CONSTRAINT `investments_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_referrer_id_foreign` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
