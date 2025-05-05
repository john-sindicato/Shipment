-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 05:39 PM
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
-- Database: `shipment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'John Lloyd', 'Abellanosa', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `approved_request`
--

CREATE TABLE `approved_request` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `dispatch_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(50) NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('open','close','deleted') DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `province`, `address`, `contact_person`, `phone`, `email`, `status`) VALUES
(16, 'Manila', '733 M.L. Quezon Street', 'George Harrison', '09333925121', 'george@gmail.com', 'open'),
(19, 'Cebu', 'Mandaue City', 'Edward Samuel', '09333925123', 'edward@gmail.com', 'open'),
(21, 'Bohol', '733 M.L. Quezon Street', 'Daniel Joseph', '09333925124', 'daniel@gmail.com', 'open'),
(22, 'Leyte', '733 M.L. Quezon Street', 'Christopher Michael', '09333925111', 'christopher@gmail.com', 'open'),
(32, 'Mindoro', '733 M.L. Quezon Street', 'Alexander James', '09333925112', 'alexander@gmail.com', 'open'),
(33, 'Cagayan', '733 M.L. Quezon Street', 'Benjamin Thomas', '09333925111', 'benjamin@gmail.com', 'open'),
(34, 'Palawan', '733 M.L. Quezon Street', 'Francis William', '09333925111', 'francis@gmail.com', 'open'),
(35, 'Negros Occidental', '733 M.L. Quezon Street', 'Henry Oliver', '09333925111', 'henry@gmail.com', 'open'),
(36, 'Davao', '733 M.L. Quezon Street', 'Isaac Benjamin', '09333925111', 'isaac@gmail.com', 'close'),
(37, 'Bulacan', '733 M.L. Quezon Street', 'Jack Robert', '09333925111', 'jack@gmail.com', 'close'),
(38, 'pulpogan', '733 M.L. Quezon Street', 'Liam Alexander', '09333925111', 'liam@gmail.com', 'open'),
(39, 'mandaue', 'purok 5 newton', 'jonas cortes', '09333925111', 'matthew@gmail.com', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1746025255),
('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1746025255;', 1746025255);

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
-- Table structure for table `cancelled_shipment`
--

CREATE TABLE `cancelled_shipment` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `dispatch_date` varchar(255) DEFAULT NULL,
  `cancel_reason` varchar(255) DEFAULT NULL,
  `cancelled_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(50) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` enum('active','deleted') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `status`) VALUES
(6, 'Work of art', 'active'),
(7, 'Medical Supplies', 'active'),
(8, 'Miscellaneous manufactured articles', 'active'),
(9, 'Arms and ammunition', 'active'),
(10, 'Precious instruments', 'active'),
(11, 'Vehicles', 'active'),
(12, 'Machinery/Electrical', 'active'),
(13, 'Base metals', 'active'),
(14, 'Precious stone, metal, pears and coins', 'active'),
(15, 'Stone / Glass', 'active'),
(16, 'Footwear / Headgear', 'active'),
(17, 'Textiles', 'active'),
(18, 'Pulp of wood and fibrous material', 'active'),
(19, 'Wood and wood products', 'active'),
(20, 'Raw hides, skins, leather and furs', 'active'),
(21, 'Plastics / Rubbers', 'active'),
(22, 'Chemical and allied industries', 'active'),
(23, 'Mineral products', 'active'),
(24, 'Foodstuffs, beverages and tobacco', 'active'),
(25, 'Animal and vegetable fats and oils', 'active'),
(26, 'Vegetable products', 'active'),
(27, 'Animals & animal products', 'active'),
(28, 'Personal', 'active'),
(34, 'ok', 'deleted');

-- --------------------------------------------------------

--
-- Table structure for table `claimed_shipment`
--

CREATE TABLE `claimed_shipment` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `dispatch_date` varchar(255) DEFAULT NULL,
  `arrival_date` timestamp NULL DEFAULT NULL,
  `claimed_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim_stub`
--

CREATE TABLE `claim_stub` (
  `id` int(255) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `expected_delivery_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('new','read','deleted') DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_contact_details`
--

CREATE TABLE `company_contact_details` (
  `id` int(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_contact_details`
--

INSERT INTO `company_contact_details` (`id`, `address`, `phone`, `email`) VALUES
(1, '733 M.L Quezon Street Cabancalan Mandaue City', '09333925123', 'navicargo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(50) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('new','read','deleted','replied') DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `declined_request`
--

CREATE TABLE `declined_request` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `decline_reason` varchar(255) DEFAULT NULL,
  `decline_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dispatched_shipment`
--

CREATE TABLE `dispatched_shipment` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `dispatch_date` varchar(255) DEFAULT NULL,
  `arrival_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `in_transit_shipment`
--

CREATE TABLE `in_transit_shipment` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `expected_delivery_date` varchar(255) DEFAULT NULL,
  `dispatch_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('new','read') DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `queued`
--

CREATE TABLE `queued` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `dispatch_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(50) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('L4Le6Xoqx07gb7sZ2cIBfysONA8TMewAp0XBRthD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiMTJNNEJRWklxSnV6UjlGWlFzUUJCamVjWXJyQ3c5VW9QSmd4MWNYOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9pbmRleCI7fX0=', 1746200338);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_rate`
--

CREATE TABLE `shipping_rate` (
  `id` int(50) NOT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `delivery_days` varchar(255) DEFAULT NULL,
  `status` enum('open','close','deleted') DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_rate`
--

INSERT INTO `shipping_rate` (`id`, `origin`, `destination`, `price`, `delivery_days`, `status`) VALUES
(24, 'Zamboanga', 'Leyte', '190', '4', 'open'),
(25, 'Bulacan', 'Cavite', '195', '5', 'open'),
(26, 'Davao', 'Cebu', '125', '2', 'open'),
(30, 'Manila', 'Davao', '175', '8', 'open'),
(31, 'Palawan', 'Negros Occidental', '45', '5', 'open'),
(32, 'Bohol', 'Leyte', '200', '3', 'open'),
(33, 'Mindoro', 'Cagayan', '999', '60', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_request`
--

CREATE TABLE `submitted_request` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teller`
--

CREATE TABLE `teller` (
  `id` int(50) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('active','deleted') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teller`
--

INSERT INTO `teller` (`id`, `fname`, `lname`, `dob`, `gender`, `phone`, `email`, `street`, `brgy`, `city`, `province`, `zipcode`, `branch`, `profile`, `password`, `status`) VALUES
(28, 'John Lloyd', 'Abellanosa', '2003-04-07', 'Male', '09938241076', 'johnlloydabellanosa0@gmail.com', '733 M.L. Quezon Street', 'Cabancalan', 'Mandaue City', 'Cebu', '6014', 'Cebu', 'profiles/1746069167.jpg', '$2y$12$.Gd8RKYKbf1kxX5lHlg.x.DI10ZSQD88SJ/ByCA5Jiro9ExBo5OWq', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `unclaim_shipment`
--

CREATE TABLE `unclaim_shipment` (
  `id` int(11) NOT NULL,
  `shipment_id` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `dispatch_date` varchar(255) DEFAULT NULL,
  `arrival_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive','deleted') DEFAULT 'inactive',
  `otp` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `password_reset_otp` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `password_reset_otp_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weight_limit`
--

CREATE TABLE `weight_limit` (
  `id` int(11) NOT NULL,
  `weight` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weight_limit`
--

INSERT INTO `weight_limit` (`id`, `weight`) VALUES
(1, '100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved_request`
--
ALTER TABLE `approved_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
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
-- Indexes for table `cancelled_shipment`
--
ALTER TABLE `cancelled_shipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claimed_shipment`
--
ALTER TABLE `claimed_shipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claim_stub`
--
ALTER TABLE `claim_stub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_contact_details`
--
ALTER TABLE `company_contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `declined_request`
--
ALTER TABLE `declined_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatched_shipment`
--
ALTER TABLE `dispatched_shipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `in_transit_shipment`
--
ALTER TABLE `in_transit_shipment`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `queued`
--
ALTER TABLE `queued`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_rate`
--
ALTER TABLE `shipping_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_request`
--
ALTER TABLE `submitted_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teller`
--
ALTER TABLE `teller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unclaim_shipment`
--
ALTER TABLE `unclaim_shipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Indexes for table `weight_limit`
--
ALTER TABLE `weight_limit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `approved_request`
--
ALTER TABLE `approved_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `cancelled_shipment`
--
ALTER TABLE `cancelled_shipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `claimed_shipment`
--
ALTER TABLE `claimed_shipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `claim_stub`
--
ALTER TABLE `claim_stub`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `company_contact_details`
--
ALTER TABLE `company_contact_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `declined_request`
--
ALTER TABLE `declined_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `dispatched_shipment`
--
ALTER TABLE `dispatched_shipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_transit_shipment`
--
ALTER TABLE `in_transit_shipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;

--
-- AUTO_INCREMENT for table `queued`
--
ALTER TABLE `queued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `shipping_rate`
--
ALTER TABLE `shipping_rate`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `submitted_request`
--
ALTER TABLE `submitted_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `teller`
--
ALTER TABLE `teller`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `unclaim_shipment`
--
ALTER TABLE `unclaim_shipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `weight_limit`
--
ALTER TABLE `weight_limit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
