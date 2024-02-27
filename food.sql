-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2024 at 05:32 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Prof. Vincenza Treutel', 'pbogan@example.net', '2024-01-27 12:02:35', '$2y$12$QMeKnpPI.mJVCQSXRg91buNuE4FKi5xw3rMXyxlg8FTKOdG81AgnO', 0, '2024-01-27 12:02:35', '2024-01-27 12:02:35'),
(3, 'admin', 'admin@gmail.com', NULL, '$2y$12$GrTe422YGOG4k5bAC3wr8eNpNn4jFYyBxNsmZxGjAr7feLcSviAIS', 0, '2024-01-28 10:26:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `clock_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_in_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_out_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `clock_in`, `clock_out`, `clock_in_note`, `clock_out_note`, `status`, `date`, `month`, `year`, `created_at`, `updated_at`) VALUES
(2, 3, '11:03', '12:43', 'in', 'out', 'Present', '21-02-2024', 'February', '2024', '2024-02-21 10:37:51', '2024-02-23 10:55:31'),
(3, 5, '13:33', '12:42', 'in', 'out', 'Present', '21-02-2024', 'February', '2024', '2024-02-21 10:38:14', '2024-02-22 00:41:30'),
(6, 5, '00:07', '01:10', 'tty', 'tty', 'Present', '16-02-2024', 'February', '2024', '2024-02-21 22:05:14', '2024-02-22 00:40:01'),
(7, 6, '11:13', NULL, NULL, NULL, NULL, '22-02-2024', 'February', '2024', '2024-02-21 22:09:12', '2024-02-21 22:09:12'),
(8, 2, '13:26', '01:26', 'in', 'out', 'Present', '22-02-2024', 'February', '2024', '2024-02-22 11:24:51', '2024-02-22 11:24:51'),
(9, 5, '13:31', NULL, NULL, NULL, 'Present', '23-02-2024', 'February', '2024', '2024-02-22 11:27:47', '2024-02-22 11:27:47'),
(10, 3, '23:03', '22:02', NULL, NULL, 'Present', '24-02-2024', 'February', '2024', '2024-02-23 08:59:20', '2024-02-23 08:59:20'),
(11, 4, '13:06', '12:05', NULL, NULL, 'Present', '24-02-2024', 'February', '2024', '2024-02-23 09:01:28', '2024-02-23 09:01:28'),
(12, 4, '23:22', '23:23', NULL, NULL, 'Present', '25-02-2024', 'February', '2024', '2024-02-23 09:19:23', '2024-02-23 09:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `award_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `employee_id`, `award_name`, `award`, `award_date`, `award_month`, `award_year`, `details`, `created_at`, `updated_at`) VALUES
(2, 3, 'best leader', 'book', '2024-05-09', 'May', '2024', 'poetry book', '2024-02-19 23:25:43', '2024-02-20 00:40:31'),
(3, 3, 'best leader', 'historical', '2024-02-21', 'April', '2024', 'werfwsffsdsfsd', '2024-02-20 00:13:47', '2024-02-20 00:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `id` bigint UNSIGNED NOT NULL,
  `b_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beverages`
--

INSERT INTO `beverages` (`id`, `b_name`, `b_price`, `b_image`, `created_at`, `updated_at`) VALUES
(3, 'chocolate', '3453', 'image/beverage/1790798887789301.jpg', '2024-02-13 08:03:41', '2024-02-13 09:41:45'),
(4, 'meat', '46', 'image/beverage/1790792734029650.jpg', '2024-02-13 08:03:56', '2024-02-13 09:40:28'),
(5, 'ruti', '245', 'image/beverage/1790796902129589.jpg', '2024-02-13 09:10:11', '2024-02-13 09:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `blogcategories`
--

CREATE TABLE `blogcategories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogcategories`
--

INSERT INTO `blogcategories` (`id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES
(1, 'Junk Food', 'junk-food', '2024-01-29 02:15:22', '2024-01-29 02:15:22'),
(3, 'offer e', 'offer-e', '2024-01-29 06:54:04', '2024-01-30 08:37:23'),
(4, 'campaign e', 'campaign-e', '2024-01-29 06:55:06', '2024-01-30 08:37:17'),
(7, 'offer ee', 'offer-ee', '2024-01-30 08:43:03', '2024-01-30 08:43:03'),
(8, 'Junk Food 2', 'junk-food-2', '2024-01-30 08:43:11', '2024-01-30 08:43:11'),
(9, 'offer extreme', 'offer-extreme', '2024-01-30 08:49:01', '2024-01-30 08:49:01'),
(10, 'offer high', 'offer-high', '2024-01-30 08:49:09', '2024-01-30 08:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `user_id`, `title`, `title_slug`, `image`, `description`, `created_date`, `created_month`, `created_at`, `updated_at`) VALUES
(6, 7, 2, 'beaf', 'beaf', 'image/blog/1789527184153441.png', '<p>fsdfsdfsdfsdfsdaf</p>', '30-01-2024', 'January', NULL, '2024-02-19 10:22:23'),
(10, 3, 2, 'dfsafaa', 'dfsafaa', 'image/blog/1789524837148134.jpg', '<p>sdfvsdfsdcxvx</p>', '30-01-2024', 'January', NULL, '2024-01-30 10:42:45'),
(11, 3, 2, 'title onesfd', 'title-onesfd', 'image/blog/1789536116973158.jpg', '<p>sfsdfsdfsd</p>', '30-01-2024', 'January', NULL, '2024-01-30 11:10:33'),
(15, 3, 2, 'dftged  1', 'dftged-1', 'image/blog/1789534244050836.jpg', '<p>fsdfsdfsdfsd</p>', '30-01-2024', 'January', NULL, '2024-01-30 10:42:38'),
(16, 1, 2, 'test11', 'test11', 'image/blog/1789535857625143.png', '<p>fsadsdfsdsd</p>', '30-01-2024', 'January', NULL, NULL),
(17, 1, 2, 'test22', 'test22', 'image/blog/1789535946384881.jpg', '<p>dsfwesdf</p>', '30-01-2024', 'January', NULL, NULL),
(18, 1, 2, 'test 333', 'test-333', 'image/blog/1789536060147193.jpg', '<p>sdfsdafdsfv</p>', '30-01-2024', 'January', NULL, NULL),
(19, 1, 2, 'test 555', 'test-555', 'image/blog/1789536080973989.jpg', '<p>sfsdfsdfsdsfsdfsd</p>', '30-01-2024', 'January', NULL, '2024-01-30 11:10:40'),
(20, 1, 2, 'test 444', 'test-444', 'image/blog/1789536097234541.jpg', '<p>sdfsdafdsfvsfsdsfsd</p>', '30-01-2024', 'January', NULL, NULL),
(21, 4, 2, 'fd#@@##', 'fd-at-at', 'image/blog/1790442523950467.jpg', '<p>df</p>', '09-02-2024', 'February', NULL, NULL),
(22, 1, 3, 'fsdaf', 'fsdaf', 'image/blog/1791341244710981.jpg', '<p>Text Area</p>', '19-02-2024', 'February', NULL, '2024-02-19 09:44:20'),
(23, 1, 3, 'a2', 'a2', 'image/blog/1791341982787625.jpg', '<p>a2</p>', '19-02-2024', 'February', NULL, '2024-02-19 10:11:16'),
(24, 1, 3, 'a1', 'a1', 'image/blog/1791342700860486.jpg', NULL, '19-02-2024', 'February', NULL, '2024-02-19 10:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES
(1, 'Lunch', 'lunch', '2024-01-23 06:42:11', '2024-01-23 06:42:11'),
(2, 'Dinner', 'dinner', '2024-01-23 06:42:29', '2024-01-23 06:42:29'),
(3, 'break fast', 'break-fast', '2024-01-23 06:42:38', '2024-02-24 12:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `clientsays`
--

CREATE TABLE `clientsays` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `rating` int NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clientsays`
--

INSERT INTO `clientsays` (`id`, `user_id`, `rating`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, 3, 'The symbol € is based on the Greek letter epsilon (Є), with the first letter in the word “Europe” and with 2 parallel lines signifying stability. The ISO code for the euro is EUR. This is used when referring to euro amounts without using the symbol. updated', 1, NULL, NULL),
(4, 11, 1, 'If you have an Eloquent model for the clientsays table, it\'s more conventional to use Eloquent methods. This requires that you first find the model by its ID and then call delete() on the model instance.', 1, NULL, NULL),
(5, 8, 2, 'The code snippet you\'ve shared is attempting to retrieve a record from the clientsays table by its ID and then delete it. However, the approach used in the snippet is incorrect because the delete method cannot be called directly on the model instance retrieved b', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'cash', '2024-02-15 08:03:04', '2024-02-15 08:03:04'),
(2, 'cook', '2024-02-15 08:03:09', '2024-02-15 08:03:09'),
(3, 'weater', '2024-02-15 08:03:14', '2024-02-15 08:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint UNSIGNED NOT NULL,
  `designation_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `created_at`, `updated_at`) VALUES
(2, 'designation 2', '2024-02-14 07:53:27', '2024-02-14 08:08:32'),
(3, 'designation 1', '2024-02-15 09:56:23', '2024-02-15 09:56:23'),
(4, 'designation 3', '2024-02-15 09:56:32', '2024-02-15 09:56:32'),
(5, 'designation 4', '2024-02-15 09:56:38', '2024-02-15 09:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `designation_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `employee_id`, `designation_id`, `name`, `phone`, `address`, `gender`, `blood`, `nid`, `image`, `joining_date`, `salary`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 6543, 3, 'Md Alauddin', '4564', 'sdafas', 'Other', 'A+', '6546215663', 'image/employee/1790991694984096.jpg', '2024-02-27', '541654', 1, '2024-02-15 09:57:38', '2024-02-15 12:46:27'),
(3, 1, 6543788, 5, 'admin', '01703790103', 'KOLANDHA', 'Male', 'o+', '654621564565', 'image/employee/1790981502194069.jpg', '2024-03-07', '54165', 1, '2024-02-15 10:04:19', '2024-02-15 10:04:19'),
(4, 3, 654334, 3, 'admin1', '01703790458', 'KOLANDHA', 'Female', 'A+', '65462156458974', 'image/employee/1790987102596008.jpg', '2024-02-27', '541655', 0, '2024-02-15 11:33:21', '2024-02-21 22:06:31'),
(5, 3, 53415, 4, 'bjmb', '01703790454', 'KOLANDHA', 'Female', 'A+', '6546215645897454', 'image/employee/1790990830579168.jpg', '2024-02-22', '541654', 0, '2024-02-15 12:32:36', '2024-02-15 12:32:36'),
(6, 1, 564, 3, 'admin2', '0170379045425', 'KOLANDHA', 'Female', 'o+', '54165', 'image/employee/1790992827365554.jpg', '2024-02-15', '54165', 0, '2024-02-15 13:04:20', '2024-02-21 22:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `expensetype_id` bigint UNSIGNED DEFAULT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expensetype_id`, `user`, `amount`, `details`, `month`, `date`, `year`, `created_at`, `updated_at`) VALUES
(3, 2, 'admin', '45', 'paid', 'February', '2024-02-14', '2024', '2024-02-14 13:04:42', '2024-02-14 14:01:06'),
(4, 1, 'admin', '500', 'paid', 'February', '2024-02-14', '2024', '2024-02-14 13:12:27', '2024-02-14 14:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `expensetypes`
--

CREATE TABLE `expensetypes` (
  `id` bigint UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensetypes`
--

INSERT INTO `expensetypes` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Electric BIll', '2024-02-11 08:14:47', '2024-02-11 08:20:12'),
(2, 'gass', '2024-02-11 08:16:12', '2024-02-11 08:20:05'),
(6, 'furniture', '2024-02-11 08:25:11', '2024-02-11 08:25:11'),
(11, 'cook', '2024-02-14 12:49:01', '2024-02-14 12:49:01');

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
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint UNSIGNED NOT NULL,
  `floor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `floor_name`, `created_at`, `updated_at`) VALUES
(2, 'first floor', '2024-01-31 06:09:21', '2024-01-31 06:09:21'),
(3, 'Second floor', '2024-01-31 06:13:07', '2024-01-31 07:07:17'),
(4, 'Third floor', '2024-01-31 06:13:17', '2024-01-31 07:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `subcategory_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `discount_price` decimal(8,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` int DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `top` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `category_id`, `subcategory_id`, `name`, `slug`, `tags`, `price`, `discount_price`, `image`, `description`, `user_id`, `date`, `month`, `year`, `status`, `top`, `created_at`, `updated_at`) VALUES
(16, 3, 7, 'break fast drink food', 'break-fast-drink-food', NULL, 435.00, 345.00, 'image/food/1790720551100314.jpg', 'fgds', 3, '2024-02-24', 'February', '2024', 1, 1, '2024-02-12 12:56:37', '2024-02-24 12:24:47'),
(18, 2, 21, 'dinner masala food', 'dinner-masala-food', NULL, 34.00, 33.00, 'image/food/1790720610874402.jpg', 'sdfsadf', 3, '2024-02-24', 'February', '2024', 1, 0, '2024-02-12 12:57:34', '2024-02-24 12:24:33'),
(19, 1, 8, 'lunch sandwitch food', 'lunch-sandwitch-food', NULL, 493.00, 47.00, 'image/food/1791791957790476.jpg', 'Velit aspernatur ven', 3, '2024-02-24', 'February', '2024', 1, 1, '2024-02-24 08:46:10', '2024-02-24 12:24:18'),
(20, 1, 19, 'lunch chiness food', 'lunch-chiness-food', NULL, 420.00, 45.00, 'image/food/1791792024633387.jpg', 'Ut earum velit ut vo', 3, '2024-02-24', 'February', '2024', 1, 0, '2024-02-24 08:47:14', '2024-02-24 12:24:02'),
(22, 1, 23, 'lunch rice food', 'lunch-rice-food', NULL, 220.00, 87.00, 'image/food/1791792062647716.jpg', 'Nihil eos nemo null', 3, '2024-02-24', 'February', '2024', 1, 0, '2024-02-24 08:47:50', '2024-02-24 12:23:48'),
(24, 1, 8, 'lunch sanwithch food', 'lunch-sanwithch-food', NULL, 678.00, 228.00, 'image/food/1791792380210879.jpg', 'Corrupti mollitia v', 3, '2024-02-24', 'February', '2024', 1, 1, '2024-02-24 08:52:53', '2024-02-24 12:23:31'),
(25, 1, 23, 'lunch rice food', 'lunch-rice-food', NULL, 821.00, 2.00, 'image/food/1791792499597677.jpg', 'Mollitia harum ut ni', 3, '2024-02-24', 'February', '2024', 0, 1, '2024-02-24 08:54:47', '2024-02-24 12:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_of_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `type`, `name`, `from`, `to`, `num_of_days`, `month`, `year`, `created_at`, `updated_at`) VALUES
(1, 'Offday', 'casual e', '2024-02-05', '2024-02-23', '19', 'February', '2024', '2024-02-15 23:16:26', '2024-02-16 00:04:45'),
(3, 'Holiday', 'puja', '2024-02-21', '2024-02-27', '7', 'February', '2024', '2024-02-15 23:39:42', '2024-02-15 23:39:42'),
(9, 'Holiday', 'puja', '2024-02-21', '2024-02-28', '8', 'February', '2024', '2024-02-18 09:09:42', '2024-02-18 09:09:42'),
(10, 'Holiday', 'fsdafs', '2024-02-29', '2024-02-21', '-7', 'February', '2024', '2024-02-19 09:14:27', '2024-02-19 09:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` int DEFAULT NULL,
  `leavetype_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `leavetype_name`, `start_date`, `end_date`, `leave_day`, `date`, `month`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'EL', '2024-02-22', '2024-02-24', '3', '2024-02-19', 'February', '2024', '0', '2024-02-19 02:08:10', '2024-02-19 02:08:10'),
(3, 2, 'SL', '2024-02-07', '2024-02-29', '23', '2024-02-19', 'February', '2024', '3', '2024-02-19 02:20:04', '2024-02-19 02:20:04'),
(5, 5, 'EL', '2024-02-15', '2024-02-29', '15', '2024-02-19', 'February', '2024', '1', '2024-02-19 02:41:35', '2024-02-19 02:52:29'),
(6, 5, 'CL', '2024-02-22', '2024-02-25', '4', '2024-02-19', 'February', '2024', '1', '2024-02-19 02:48:06', '2024-02-19 02:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `leavetypes`
--

CREATE TABLE `leavetypes` (
  `id` bigint UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leavetypes`
--

INSERT INTO `leavetypes` (`id`, `type_name`, `leave_day`, `created_at`, `updated_at`) VALUES
(2, 'SL', '8', '2024-02-18 07:57:09', '2024-02-18 21:08:12'),
(3, 'EL', '10', '2024-02-18 07:57:21', '2024-02-18 21:03:10'),
(6, 'CL', '19', '2024-02-18 21:08:28', '2024-02-18 21:08:28');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_20_130752_create_categories_table', 2),
(6, '2024_01_21_101151_create_cats_table', 3),
(7, '2024_01_21_101659_create_cat1s_table', 4),
(8, '2024_01_23_125021_create_subcategories_table', 5),
(9, '2024_01_27_045008_create_blogcategories_table', 6),
(10, '2024_01_27_080109_create_admins_table', 7),
(15, '2024_01_29_161019_create_blogs_table', 8),
(16, '2024_01_31_112027_create_floors_table', 9),
(17, '2024_01_31_134440_create_tables_table', 10),
(18, '2024_02_06_024915_create_reservations_table', 11),
(19, '2024_02_09_144236_add_phone_to_users', 12),
(20, '2024_02_09_144450_add_phone_to_users', 13),
(21, '2024_02_11_124518_create_expensetypes_table', 14),
(22, '2024_02_11_124506_create_expenses_table', 15),
(23, '2024_02_11_130526_create_expensetypes_table', 16),
(24, '2024_02_11_130620_create_expenses_table', 17),
(26, '2024_02_11_162829_create_food_table', 18),
(27, '2024_02_13_124929_create_beverages_table', 19),
(28, '2024_02_14_125100_create_designations_table', 20),
(30, '2024_02_14_142356_create_departments_table', 21),
(31, '2024_02_14_172407_drop_expenses_table', 21),
(32, '2024_02_14_172817_drop_expenses_table', 21),
(33, '2024_02_14_173223_drop_expenses_table', 22),
(34, '2024_02_14_173637_drop_expenses_table', 23),
(35, '2024_02_15_124016_create_employees_table', 24),
(36, '2024_02_15_190935_create_holidays_table', 25),
(37, '2024_02_18_125020_create_leavetypes_table', 26),
(40, '2024_02_19_031602_create_leaves_table', 27),
(41, '2024_02_19_032220_create_awards_table', 27),
(42, '2024_02_20_050841_drop_awards_table', 28),
(43, '2024_02_20_051137_drop_awards_table', 29),
(44, '2024_02_20_051439_drop_awards_table', 30),
(45, '2024_02_20_052005_create_awards_name', 31),
(46, '2024_02_20_071714_create_attendances_table', 32),
(47, '2024_02_23_172538_add_user_id_to_reservations', 33),
(48, '2024_02_24_143456_add_top_to_food', 34),
(49, '2024_02_26_043746_create_website_settings_table', 35),
(50, '2024_02_26_074439_create_clientsays_table', 36),
(51, '2024_02_27_122545_create_wishlists_table', 37);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `r_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `people` int DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `r_time`, `r_date`, `people`, `phone`, `name`, `details`, `status`, `r_month`, `r_year`, `created_at`, `updated_at`) VALUES
(1, NULL, '05:12', '2024-01-25', 4, '01703790103', 'Md Alauddin', 'launch', 'Success', 'February', '2024', '2024-02-06 09:59:42', '2024-02-06 06:34:13'),
(2, NULL, '08:05', '2024-02-16', 2, '01703790458', 'admin', 'snacks', 'Pending', 'February', '2024', '2024-02-06 10:02:58', '2024-02-13 13:21:52'),
(6, NULL, '01:29', '2025-04-07', 4, '01703790102', 'admin', 'dinner party', 'Success', 'April', '2025', '2024-02-06 16:25:57', '2024-02-07 00:33:43'),
(7, NULL, '15:14', '2024-07-24', 2, '01703790455', 'emu emu', 'launch and snacks', 'Pending', 'July', '2024', '2024-02-07 05:12:20', NULL),
(8, NULL, '17:25', '2024-02-16', 4, '01703790453', 'Md Alauddin', 'fvxcvxcv', 'Reject', 'February', '2024', '2024-02-13 17:19:26', '2024-02-13 13:22:52'),
(9, NULL, '04:24', '2024-02-07', 3, '01703790454', 'Md Alaudding', 'dgfdgsdf', 'Pending', 'February', '2024', '2024-02-13 17:23:52', '2024-02-13 13:23:52'),
(10, NULL, '05:25', '2024-02-09', 4, '01703790104', 'dfgdf', 'gfdfg', 'Approved', 'February', '2024', '2024-02-13 17:32:40', '2024-02-13 13:22:31'),
(11, NULL, '1:06 AM', '2024-02-28', 8, '01703790456', 'problem solve', 'problem solve', 'Pending', 'February', '2024', '2024-02-13 19:06:43', NULL),
(12, 9, '13:18', '2024-02-15', 88, '01703790986', 'kjnkl', 'knkl', 'Approved', 'February', '2024', '2024-02-24 06:14:35', '2024-02-24 00:38:13'),
(23, 9, '17:17', '2024-03-07', 4, '01703790654156', 'emu', 'dfg', 'Pending', 'March', '2024', '2024-02-24 07:14:42', NULL),
(26, 9, '15:41', '2024-02-14', 3, '0170379454', 'admin', 'complete', 'Approved', 'February', '2024', '2024-02-24 07:38:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_slug`, `image`, `created_at`, `updated_at`) VALUES
(7, 3, 'break fast drink', '', 'image/category/1789526755836977.jpg', '2024-01-25 06:58:32', '2024-02-24 12:21:57'),
(8, 1, 'lunch sandwitch', '', 'image/category/1789535510803426.jpg', '2024-01-25 06:59:54', '2024-02-24 12:22:17'),
(12, 3, 'break fast omlet', '', 'image/category/1789526661468331.jpg', '2024-01-30 08:40:15', '2024-02-24 12:21:27'),
(13, 2, 'dinner fish', '', 'image/category/1789526796506164.jpg', '2024-01-30 08:42:24', '2024-02-24 12:21:09'),
(14, 3, 'break fast ruti', '', 'image/category/1789527257067076.jpg', '2024-01-30 08:49:43', '2024-02-24 12:20:59'),
(19, 1, 'lunch chiness', '', 'image/category/1789535594304124.jpg', '2024-01-30 11:02:14', '2024-02-24 12:20:42'),
(21, 2, 'dinner masala', '', 'image/category/1789535682995806.jpeg', '2024-01-30 11:03:39', '2024-02-24 12:20:28'),
(23, 1, 'lunch rice', '', 'image/category/1791341033688546.jpeg', '2024-02-19 09:18:55', '2024-02-24 12:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint UNSIGNED NOT NULL,
  `floor_id` bigint UNSIGNED NOT NULL,
  `table_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_sit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `floor_id`, `table_code`, `table_sit`, `created_at`, `updated_at`) VALUES
(1, 4, 'table one', '1:1', '2024-02-01 08:06:08', '2024-02-01 10:24:55'),
(3, 3, 'table three', '2:2', '2024-02-01 10:25:17', '2024-02-01 10:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'alauddin', 'alauddin@gmail.com', '01734087059', NULL, '$2y$12$sew4xr5/53L/uPWyaWOLO.3r5I2w5kdMO5F5CMp6y5vWQB3rqrpTa', 0, NULL, '2024-02-09 11:56:55', '2024-02-13 10:17:24'),
(6, 'Md alauddin', 'alauddinEmon@gmail.com', '01715333945', NULL, '$2y$12$v.tQV/RzEUQjJigCsVEKfuivko//GcM7vfh5Bi8ABNfEQeJRU.wee', 0, NULL, '2024-02-10 06:06:15', '2024-02-23 20:50:45'),
(7, 'Md  Emon', 'ddsfsd@gmail.com', '01715343533945', NULL, '$2y$12$PlqexKN8/Xdhnl6QLKrI0uAMF7T0Es3uM.wuB8zEbrut8VtoeZYAS', 1, NULL, '2024-02-10 06:14:57', '2024-02-13 10:18:29'),
(8, 'emu', 'emu@gmail.com', '01715333940', NULL, '$2y$12$ZtI9rhX.BJNaGm6XjRFcQOZtiFLzlqq5C0eCYrWSIsI/ts07hYp82', 1, NULL, '2024-02-13 10:17:55', '2024-02-13 10:17:55'),
(9, 'customer', 'customer@gmail.com', '01715333948', NULL, '$2y$12$nrNXGDsP5Z1UhFSLmCpO5O0xJlvo.uj9/7yzNIBgXUf2dHDz1bOO6', 1, NULL, '2024-02-23 20:51:18', '2024-02-23 20:51:18'),
(11, 'u', 'u@gmail.com', '01703790489', NULL, '$2y$12$NLjtaNLbPtCYdvakO2hW0ulV3ukH39Gctc81m/QlYyKx5LMI9Y0AC', 1, NULL, '2024-02-26 10:05:41', '2024-02-26 10:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `currency`, `phone_one`, `phone_two`, `main_email`, `support_email`, `logo`, `favicon`, `address`, `twitter`, `instagram`, `linkedin`, `youtube`, `created_at`, `updated_at`) VALUES
(1, '₹', '56456456456', '564654654564', 'emu@gmail.com', 'emu1@gmail.com', NULL, NULL, 'mirpur 12 dhaka', 'https://www.google.com.bd/', 'https://www.google.com.bd/', 'https://www.google.com.bd/', 'https://www.google.com.bd/', NULL, '2024-02-26 00:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 9, 19, '2024-02-27 07:43:06', '2024-02-27 07:43:06'),
(2, 9, 25, '2024-02-27 07:49:20', '2024-02-27 07:49:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beverages`
--
ALTER TABLE `beverages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogcategories`
--
ALTER TABLE `blogcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientsays`
--
ALTER TABLE `clientsays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientsays_user_id_foreign` (`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_designation_id_foreign` (`designation_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expensetype_id_foreign` (`expensetype_id`);

--
-- Indexes for table `expensetypes`
--
ALTER TABLE `expensetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_category_id_foreign` (`category_id`),
  ADD KEY `food_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leavetypes`
--
ALTER TABLE `leavetypes`
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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tables_floor_id_foreign` (`floor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `beverages`
--
ALTER TABLE `beverages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogcategories`
--
ALTER TABLE `blogcategories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `clientsays`
--
ALTER TABLE `clientsays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `expensetypes`
--
ALTER TABLE `expensetypes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leavetypes`
--
ALTER TABLE `leavetypes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blogcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clientsays`
--
ALTER TABLE `clientsays`
  ADD CONSTRAINT `clientsays_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expensetype_id_foreign` FOREIGN KEY (`expensetype_id`) REFERENCES `expensetypes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `tables_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
