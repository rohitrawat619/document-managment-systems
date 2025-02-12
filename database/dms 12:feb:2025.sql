-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 12, 2025 at 09:50 AM
-- Server version: 8.0.38
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dms`
--

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unique_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `created_at`, `updated_at`, `unique_key`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`) VALUES
(1, 'Designation 1', NULL, '2025-01-21 04:53:10', NULL, 1, 0, NULL, NULL),
(2, 'Designation 2', NULL, '2025-01-21 04:53:02', NULL, 1, 0, NULL, NULL),
(3, 'Designation 3', '2025-01-21 01:26:37', '2025-01-21 05:18:07', NULL, 1, 0, 0, NULL),
(4, 'Software Devloper', '2025-01-21 05:22:02', '2025-01-21 06:21:27', NULL, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'designer', '2025-01-22 01:39:15', '2025-01-22 01:42:18', NULL, 1, 1, 1, '2025-01-22 07:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unique_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`, `unique_key`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`) VALUES
(1, 'Control Pollution Air (CPA)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(2, 'Control Pollution Water (CPW)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(3, 'Desertification Cell (DC)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(4, 'Development Monitoring & Evaluation Division (DMED)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(5, 'Eco Sensitive Zone (ESZ)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(6, 'Economic Division (ED)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(7, 'Environmental Education (EE)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(8, 'Externally Aided Project (EAP)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(9, 'Forest Conservation (FC)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(10, 'Forest Establishment (FE)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(11, 'Forest Policy', NULL, NULL, NULL, 1, 0, NULL, NULL),
(12, 'Forest Protection Division (FPD)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(13, 'General Administration (GA)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(14, 'General Coordination (GC)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(15, 'Green India Mission (GIM)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(16, 'Hazardous Substance Management Division (HSMD)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(17, 'Impact Assessment-IIl (IA-III)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(18, 'Impact Assessment-l (IA-I)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(19, 'Impact Assessment-lI (IA-II)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(20, 'Indian Forest Service-l (IFS-I)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(21, 'Indian Forest Service-ll (IFS-II)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(22, 'Information Technology (IT)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(23, 'Integrated Financial Division (IFD)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(24, 'Internal Work Study Unit (IWSU)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(25, 'International Cooperation-I (IC-I)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(26, 'International Cooperation-ll (IC-II)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(27, 'Library', NULL, NULL, NULL, 1, 0, NULL, NULL),
(28, 'Lifestyle for Environment Cell (LiFE)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(29, 'Media Cell', NULL, NULL, NULL, 1, 0, NULL, NULL),
(30, 'Mountain Cell', NULL, NULL, NULL, 1, 0, NULL, NULL),
(31, 'National Afforestation and Eco-Development Board (NAEB)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(32, 'National Authority (CAMPA)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(33, 'National Museum of Natural History Cell', NULL, NULL, NULL, 1, 0, NULL, NULL),
(34, 'Non-Governmental Organisations', NULL, NULL, NULL, 1, 0, NULL, NULL),
(35, 'Official Language', NULL, NULL, NULL, 1, 0, NULL, NULL),
(36, 'Ozone Cell', NULL, NULL, NULL, 1, 0, NULL, NULL),
(37, 'Parliament Section', NULL, NULL, NULL, 1, 0, NULL, NULL),
(38, 'Pay & Account Office', NULL, NULL, NULL, 1, 0, NULL, NULL),
(39, 'Policy & Law Section', NULL, NULL, NULL, 1, 0, NULL, NULL),
(40, 'Project Elephant Section', NULL, NULL, NULL, 1, 0, NULL, NULL),
(41, 'Protocol Division', NULL, NULL, NULL, 1, 0, NULL, NULL),
(42, 'Public Grievances Cell', NULL, NULL, NULL, 1, 0, NULL, NULL),
(43, 'Regional Office Head Quarter (ROHQ)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(44, 'Research & Training (RT)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(45, 'Research in Environment (RE)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(46, 'Right to Information', NULL, NULL, NULL, 1, 0, NULL, NULL),
(47, 'Sectoral Group of Secretary (Resources) Cell', NULL, NULL, NULL, 1, 0, NULL, NULL),
(48, 'Statistical Cell', NULL, NULL, NULL, 1, 0, NULL, NULL),
(49, 'Survey & Utilisation', NULL, NULL, NULL, 1, 0, NULL, NULL),
(50, 'Sustainable Coastal Management Division', NULL, NULL, NULL, 1, 0, NULL, NULL),
(51, 'Swachh and Swasth Bharat cell', NULL, NULL, NULL, 1, 0, NULL, NULL),
(52, 'Vigilance Section', NULL, NULL, NULL, 1, 0, NULL, NULL),
(53, 'Wetland Division', NULL, NULL, NULL, 1, 0, NULL, NULL),
(54, 'Wildlife Division', NULL, NULL, NULL, 1, 0, NULL, NULL),
(55, 'Administration(P-I)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(56, 'Administration(P-II)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(57, 'Administration(P-III)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(58, 'Budget Division (Budget)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(59, 'Cash Section (Cash)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(60, 'Central Registry (CR)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(61, 'Civil Construction Unit (CCU)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(62, 'Clean Technology (CT)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(63, 'Climate Change (CC)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(64, 'Conservation & Survey - I (CS-I)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(65, 'Conservation & Survey - II (CS-II)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(66, 'Conservation & Survey - III (CS-III)', NULL, NULL, NULL, 1, 0, NULL, NULL),
(67, 'Forest Protection Division 2', '2025-01-22 01:07:25', '2025-01-22 01:07:45', NULL, 1, 1, 1, '2025-01-22 06:37:45'),
(68, 'Forest Protection Division 1', '2025-01-22 01:36:54', '2025-01-22 01:36:54', NULL, 1, 0, NULL, NULL),
(69, 'Forest Protection Division 5', '2025-01-22 05:21:50', '2025-01-22 05:22:07', NULL, 1, 1, 1, '2025-01-22 10:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2025_01_09_062812_create_roles_table', 2),
(17, '2025_01_15_071729_create_divisions_table', 3),
(18, '2025_01_15_091953_create_designations_table', 4),
(20, '2025_01_16_092728_create_office_memorandum_uploads_table', 5),
(22, '2025_01_16_065956_create_office_memorandum_table', 6),
(23, '2025_01_21_064755_add_columns_to_designations_table', 7),
(24, '2025_01_22_062116_add_columns_to_divisions_table', 8),
(26, '2025_02_07_114929_create_permissions_table', 9),
(27, '2025_02_10_095648_add_columns_to_roles_table', 10),
(28, '2025_02_11_090558_add_columns_to_users_table', 11),
(29, '2025_01_16_092728_create_office_order_uploads_table', 12),
(30, '2025_02_12_054711_officeorders_table', 13),
(31, '2025_02_12_054711_office_orders_table', 14),
(32, '2025_02_12_054711_office_order_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `office_memorandum`
--

CREATE TABLE `office_memorandum` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `computer_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `file_type` tinyint DEFAULT NULL COMMENT '0 => confidential, 1=> non-confidential',
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_memorandum`
--

INSERT INTO `office_memorandum` (`id`, `division_id`, `user_id`, `computer_no`, `file_no`, `date_of_issue`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'fdf454528', 'L-1222/1/2024-IA-I-(K)', '2025-02-14', 'ga', 'issuer', 'LA', NULL, '2025-02-11 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-11 03:14:46', '2025-02-11 04:22:00'),
(2, 1, 2, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-20', 'Software Ebgineer', 'fbgdsfb', 'fdgfd', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-12 00:48:53', '2025-02-12 00:48:53'),
(3, 1, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-21', 'Software Ebgineer', 'fbgdsfb', 'fdgfd', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-12 01:25:16', '2025-02-12 01:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `office_memorandum_uploads`
--

CREATE TABLE `office_memorandum_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_memorandum_uploads`
--

INSERT INTO `office_memorandum_uploads` (`id`, `record_id`, `user_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'office_memorandum_uploads/E8RLvcoNkVreBQ3fkExXYvuGqePpYibtrmrJdtKA.pdf', '1.pdf', '2025-02-11 03:14:46', '2025-02-11 03:14:46'),
(2, 1, 3, 'office_memorandum_uploads/BVlpAzrcTjYuej6gjsG9nvtGjmRFls40S7Nudq9L.pdf', 'Appointment Rohit Rawat.pdf', '2025-02-11 03:14:46', '2025-02-11 03:14:46'),
(7, 1, 3, 'office_memorandum_uploads/AIXIEC7htTnFc8fzv0kyUH1Ga9iPCuPyoGdmDa44.pdf', 'COQP12.pdf', '2025-02-11 04:21:37', '2025-02-11 04:21:37'),
(8, 1, 3, 'office_memorandum_uploads/VV9J9E4Bq004radbh8o1S0ofXKswThY6H8NcPgzq.pdf', 'WebDev Roadmap - Notes.pdf', '2025-02-11 04:21:37', '2025-02-11 04:21:37'),
(10, 1, 3, 'office_memorandum_uploads/BrJRZk1MlZ6fYUxAr0BYZYy6zhDEwZzlp9YkfBRA.pdf', 'WebDev Roadmap - Notes.pdf', '2025-02-11 04:22:00', '2025-02-11 04:22:00'),
(11, 2, 2, 'office_memorandum_uploads/NkTwETpzdt9bd7lnSu3NTaO4pmmqr1kcX25qCG6e.pdf', 'ansokan.pdf', '2025-02-12 00:48:53', '2025-02-12 00:48:53'),
(12, 2, 2, 'office_memorandum_uploads/Pnn3ekZCqGxpQKY6nS2CpEbSTp0m2HiC01CfwpKp.pdf', 'rohitrawat_europass_resume.pdf', '2025-02-12 00:48:53', '2025-02-12 00:48:53'),
(13, 2, 2, 'office_memorandum_uploads/Tk2OnUi6zOnthUhgyrWmAmYqEkLzz4II7wbBycrq.pdf', 'Academic_Degree.pdf', '2025-02-12 00:48:53', '2025-02-12 00:48:53'),
(14, 3, 2, 'office_memorandum_uploads/XCWt0zVgb6aZGM7VJtLlYCUxYcMpcrEncT6sTCKx.pdf', 'ansokan.pdf', '2025-02-12 01:25:16', '2025-02-12 01:25:16'),
(15, 3, 2, 'office_memorandum_uploads/8vb105qJNqCX0FIQz8R8tnYJ9W0qidg3XPtm3ZrN.pdf', 'Academic_Degree.pdf', '2025-02-12 01:25:16', '2025-02-12 01:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `office_order`
--

CREATE TABLE `office_order` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
  `computer_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `file_type` tinyint DEFAULT NULL COMMENT '0 => confidential, 1=> non-confidential',
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_order`
--

INSERT INTO `office_order` (`id`, `division_id`, `computer_no`, `file_no`, `date_of_issue`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 1, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-12 02:43:32', '2025-02-12 02:43:32', 2),
(2, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-01', 'ART ENGINEER', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-12 00:00:00', 1, 1, 0, NULL, NULL, '2025-02-12 02:44:00', '2025-02-12 02:48:47', 2);

-- --------------------------------------------------------

--
-- Table structure for table `office_order_uploads`
--

CREATE TABLE `office_order_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `user_id` bigint NOT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_order_uploads`
--

INSERT INTO `office_order_uploads` (`id`, `record_id`, `user_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'office_order_uploads/OVz4m0GanDveLZHPSbDC9BboILPHKCgoAjpxaR02.pdf', 'BCA_marksheet.pdf', '2025-02-12 02:43:32', '2025-02-12 02:43:32'),
(2, 1, 2, 'office_order_uploads/M3Eqhgg3560NHSUnlx0Uem55tN425MGB5TL6k1LF.pdf', 'BCA Character-Certificate.pdf', '2025-02-12 02:43:32', '2025-02-12 02:43:32'),
(3, 2, 2, 'office_order_uploads/KflO8e6jzjMlvp4VvxykOSHDMzTttBX68bE44fDT.pdf', 'BCA.pdf', '2025-02-12 02:44:00', '2025-02-12 02:44:00'),
(4, 2, 2, 'office_order_uploads/PxjxZC7iRRDiMULfHjm01u2kbS36SxIiCu7WRW3M.pdf', 'Academic_Degree.pdf', '2025-02-12 02:45:39', '2025-02-12 02:45:39'),
(5, 2, 2, 'office_order_uploads/TWE4pR1bkIX8rsf0uSSbW55X3v5QbAO7P37bLiO6.pdf', 'Experience-Letter-Rohit Rawat.pdf', '2025-02-12 02:46:09', '2025-02-12 02:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `unique_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `unique_key`, `name`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'bbdc2fb4-d31b-43cd-b456-c65c40a019f5', 'all', 1, 1, 1, '2025-02-11 09:23:52', '2025-02-10 06:42:25', '2025-02-11 03:53:52'),
(2, 'e028324b-5ee2-44a6-b15c-3566d0389a40', 'read & write', 1, 0, NULL, NULL, '2025-02-10 06:43:38', '2025-02-10 06:43:38'),
(3, '1dbdc453-adfa-438e-8ca0-446861793e84', 'read', 1, 0, NULL, NULL, '2025-02-10 06:43:48', '2025-02-10 06:43:48'),
(4, '83892851-d6f8-490d-9275-b72aecffc286', 'all', 1, 0, NULL, NULL, '2025-02-11 03:55:48', '2025-02-11 03:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `unique_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `unique_key`, `name`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`, `permission_id`) VALUES
(1, 'a5fd9871-720f-4b8b-aaa0-7db031175902', 'superadmin', 1, 1, 1, '2025-02-11 09:13:08', '2025-02-10 06:31:44', '2025-02-11 03:43:08', 1),
(2, '39a0ff68-51d3-4bd7-860e-12f7c6961569', 'admin', 1, 0, NULL, NULL, '2025-02-10 06:32:22', '2025-02-10 06:32:22', 2),
(3, '1e761ea4-a92f-412c-95c0-6045f2a6c8de', 'user', 1, 0, NULL, NULL, '2025-02-10 06:32:30', '2025-02-10 06:32:30', 3),
(4, '685ce3c9-1a99-4869-bea9-9278cb5d667c', 'superadmin', 1, 0, NULL, NULL, '2025-02-11 03:43:48', '2025-02-11 03:43:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `unique_key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `role_id` bigint DEFAULT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '91',
  `phone_iso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'in',
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_key`, `first_name`, `last_name`, `name`, `email`, `email_verified_at`, `user_name`, `password`, `is_admin`, `role_id`, `designation`, `division`, `phone`, `phone_code`, `phone_iso`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `permission_id`) VALUES
(1, '935', 'Admin', NULL, 'Admin', 'admin@gmail.com', NULL, 'admin', '$2y$10$Uljgbg.liG/xVGSY0eMwJ.Yb34aHsCyqPHwNubDEAccNQJA00PA6y', 1, NULL, '0', '0', '8010176343', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-01-08 04:25:18', '2025-01-08 04:25:18', NULL),
(2, 'V0IFA94O-FMMN-BCKQ-HKQXSCEJXTK', 'Jai', 'Shrivastva', 'Jai Shrivastva', 'jai123@gmail.com', NULL, 'jai123', '$2y$10$Uljgbg.liG/xVGSY0eMwJ.Yb34aHsCyqPHwNubDEAccNQJA00PA6y', 0, 3, '1', '1', '9893434421', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-01-08 04:25:18', '2025-01-21 00:17:26', 0),
(3, 'OXX39SRY-IHT1-USWH-VZXF9TLSBDL', 'Om', 'Bansal', 'Om Bansal', 'om@gmail.com', NULL, 'om89', '$2y$10$Uljgbg.liG/xVGSY0eMwJ.Yb34aHsCyqPHwNubDEAccNQJA00PA6y', 0, 2, '2', '1,4,9', '8969408837', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-01-08 04:30:21', '2025-01-15 19:19:55', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `divisions_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_memorandum`
--
ALTER TABLE `office_memorandum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_memorandum_division_id_index` (`division_id`),
  ADD KEY `office_memorandum_uploaded_by_index` (`uploaded_by`),
  ADD KEY `office_memorandum_file_type_index` (`file_type`),
  ADD KEY `office_memorandum_deleted_by_index` (`deleted_by`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `office_memorandum_uploads`
--
ALTER TABLE `office_memorandum_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_memorandum_uploads_record_id_index` (`record_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `office_order`
--
ALTER TABLE `office_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_order_user_id_foreign` (`user_id`),
  ADD KEY `office_order_division_id_index` (`division_id`),
  ADD KEY `office_order_uploaded_by_index` (`uploaded_by`),
  ADD KEY `office_order_file_type_index` (`file_type`),
  ADD KEY `office_order_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `office_order_uploads`
--
ALTER TABLE `office_order_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_order_uploads_record_id_index` (`record_id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_ibfk_1` (`permission_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_index` (`role_id`),
  ADD KEY `designation` (`designation`),
  ADD KEY `division` (`division`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `office_memorandum`
--
ALTER TABLE `office_memorandum`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `office_memorandum_uploads`
--
ALTER TABLE `office_memorandum_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `office_order`
--
ALTER TABLE `office_order`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `office_order_uploads`
--
ALTER TABLE `office_order_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `office_memorandum`
--
ALTER TABLE `office_memorandum`
  ADD CONSTRAINT `office_memorandum_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `office_memorandum_uploads`
--
ALTER TABLE `office_memorandum_uploads`
  ADD CONSTRAINT `office_memorandum_uploads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `office_order`
--
ALTER TABLE `office_order`
  ADD CONSTRAINT `office_order_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
