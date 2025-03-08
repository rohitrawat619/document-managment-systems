-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2025 at 01:25 PM
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
-- Table structure for table `achievenment`
--

CREATE TABLE `achievenment` (
  `id` bigint UNSIGNED NOT NULL,
  `computer_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_publication` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `file_type` tinyint DEFAULT NULL COMMENT '0 => confidential, 1=> non-confidential',
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `achievenment`
--

INSERT INTO `achievenment` (`id`, `computer_no`, `file_no`, `date_of_publication`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `keyword`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Sushmita Sen', 'L-1222/1/2024-IA-I-(R)', NULL, 'Software Engineer', 'IGI', 'Director', 2, 'Joint,Sectary', '2025-02-27 00:00:00', NULL, 1, 0, NULL, NULL, 73, '2025-02-27 18:29:59', '2025-02-27 18:29:59'),
(2, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-05', '2222222', 'Super Admin', 'Director General of Forest & Special Secretary', 0, 'trytr', '2025-03-04 00:00:00', NULL, 1, 1, 1, '2025-03-04 05:00:55', 1, '2025-03-03 23:30:44', '2025-03-03 23:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `achievenment_upload`
--

CREATE TABLE `achievenment_upload` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `achievenment_upload`
--

INSERT INTO `achievenment_upload` (`id`, `user_id`, `record_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 73, 1, 'achievenment_upload/ALhQdRniqL75V5ImsRt69O2CxRD8D9tPYGBKbDtJ.pdf', 'rohitrawat_europass_resume.pdf', '2025-02-27 18:29:59', '2025-02-27 18:29:59'),
(2, 1, 2, 'achievenment_upload/n9YmXamXtXa4Jc0wbY7jKojwXkSoeE9VY5L8aiBF.pdf', 'dummy.pdf', '2025-03-03 23:30:44', '2025-03-03 23:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Secretary (EF&CC)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Director General of Forest & Special Secretary', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Additional Director General of Forest', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'Chief Executive Officer officer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'Additional Secretary', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(6, 'Additional Secretary & Financial Advisor', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'Senior Economic Advisor', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(8, 'Joint Secretary', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'Inspector General of Forest', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(10, 'Economic Advisor', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(11, 'Statistical Advisor', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(12, 'Chief Controller of Account', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(13, 'Scientist G', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(14, 'Chief Engineer (CCU)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(15, 'Deputy Inspector General of Forest', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(16, 'Scientist F', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(17, 'Director', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(18, 'Principal Staff Officer (PSO)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(19, 'Scientist E', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(20, 'Deputy Secretary', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(21, 'Joint Director', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(22, 'Assistant Inspector General of Forest', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(23, 'Senior Principal Private Secretary (Sr. PPS)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(24, 'Scientist D ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(25, 'Under Secretary', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(26, 'Assistant Commissioner (Forestry)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(27, 'Deputy Director', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(28, 'Scientist C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(29, 'Principal Private Secretary (PPS)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(30, 'Assistant Director', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(31, 'Scientist B', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(32, 'Section Officer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(33, 'Private Secretary (PS)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(34, 'Technical Officer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(35, 'Research Officer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(36, 'Technical Assistant (TA)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(37, 'Assistant Section Officer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(38, 'Personal Assistant (PA)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(39, 'Senior Secretariat Assistant (SSA)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(40, 'Stenographer D', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00'),
(41, 'JSA', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Null', 0, 0, 0, '0000-00-00 00:00:00');

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
-- Table structure for table `gazette_notification`
--

CREATE TABLE `gazette_notification` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
  `notification_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_notification` date DEFAULT NULL,
  `issuer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gazette_notification`
--

INSERT INTO `gazette_notification` (`id`, `division_id`, `notification_no`, `title`, `date_of_notification`, `issuer_name`, `issuer_designation`, `uploaded_by`, `keyword`, `date_of_upload`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'skjdfnkjsadnfks', 'klsdksnk', '2025-03-19', 'IGI', 'Director', 0, 'Joint,Sectary', '2025-03-03 00:00:00', 1, 0, NULL, NULL, 3, '2025-03-03 06:39:05', '2025-03-03 06:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `gazette_notification_uploads`
--

CREATE TABLE `gazette_notification_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gazette_notification_uploads`
--

INSERT INTO `gazette_notification_uploads` (`id`, `user_id`, `record_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'gazette_notification_uploads/7juV7Jjir0y21QSB9WEzq9d6sdNb3pv0fTzcz49W.pdf', 'Document Management System Ver.pdf', '2025-03-03 06:39:05', '2025-03-03 06:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `guidelines`
--

CREATE TABLE `guidelines` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
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
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guidelines`
--

INSERT INTO `guidelines` (`id`, `division_id`, `computer_no`, `file_no`, `date_of_issue`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`, `keyword`) VALUES
(1, 2, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-20 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-19 23:26:19', NULL),
(2, 2, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-20 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-19 23:26:33', NULL),
(3, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(4, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(5, 2, 'Ministry', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'IGI', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 06:30:42', NULL),
(6, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(7, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(8, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(9, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(10, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(11, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(12, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(13, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:30:31', '2025-02-18 00:30:31', NULL),
(14, 3, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-19', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-18 03:26:18', '2025-02-18 03:27:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guideline_uploads`
--

CREATE TABLE `guideline_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guideline_uploads`
--

INSERT INTO `guideline_uploads` (`id`, `user_id`, `record_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(3, 3, 14, 'guideline_uploads/IEvhzmcvJN8fgLAw226M8L14yU2zU5fnQq32L1az.pdf', 'SSC & HSC & MOI English proof.pdf.pdf', '2025-02-18 03:27:08', '2025-02-18 03:27:08'),
(4, 2, 2, 'guideline_uploads/hXrmItXO2WFLZvZqKfePNaX7YWf0ZsVEulA14mWp.pdf', 'rohitrawat - coverletter.pdf', '2025-02-19 23:26:33', '2025-02-19 23:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `letter`
--

CREATE TABLE `letter` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
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
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `letter`
--

INSERT INTO `letter` (`id`, `division_id`, `computer_no`, `file_no`, `date_of_issue`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`, `keyword`) VALUES
(1, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(2, 2, 'Demo', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 06:12:51', NULL),
(3, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(4, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(5, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(6, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(7, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(8, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(9, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(10, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL),
(11, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-12', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 2, '2025-02-18 00:34:26', '2025-02-18 00:34:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `letter_uploads`
--

CREATE TABLE `letter_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `letter_uploads`
--

INSERT INTO `letter_uploads` (`id`, `user_id`, `record_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'letterupload/PoWpdU23dIQ2KcPG4wfJfgiRQc3RLZ8mA52pyNCJ.pdf', 'rohitrawat - coverletter.pdf', '2025-02-18 00:34:26', '2025-02-18 00:34:26');

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
(29, '2025_02_12_054613_create_notification_table', 12),
(30, '2025_02_12_054629_create_notification_uploads_table', 13),
(31, '2025_02_12_054613_create_notifications_table', 14),
(32, '2025_02_13_110619_add_columns_to_roles_table', 15),
(33, '2025_02_12_054711_office_orders_table', 16),
(34, '2025_02_13_074358_create_letter_uploads_table', 17),
(35, '2025_02_13_074154_create_letter_table', 18),
(36, '2025_02_14_053625_create_guidelines_table', 19),
(37, '2025_02_14_152937_create_guideline_uploads_table', 20),
(38, '2025_02_21_094121_create_recruitment_table', 21),
(39, '2025_02_21_100351_create_recruitment_upload_table', 22),
(40, '2025_02_24_104451_create_achievenment_table', 23),
(41, '2025_02_24_104737_create_achievenment_upload_table', 24),
(42, '2025_02_25_073958_create_records_of_discussion_table', 25),
(43, '2025_02_25_075012_create_records_of_discussion_upload_table', 26),
(44, '2025_02_25_104851_create_minutes_of_metting_table', 27),
(45, '2025_02_25_105005_create_minutes_of_metting_upload_table', 28),
(46, '2025_02_27_112325_create_presentations_table', 29),
(47, '2025_02_27_112749_create_presentations_upload_table', 30),
(48, '2025_02_27_055518_create_gazette_notification_table', 31),
(49, '2025_02_27_062753_create_gazette_notification_uploads_table', 32),
(50, '2025_02_20_055851_add_keyword_to_guidelines_table', 33),
(51, '2025_02_20_062725_add_keyword_to_letter_table', 34),
(52, '2025_02_20_065151_add_keyword_to_notification_table', 35),
(53, '2025_02_20_094321_add_keyword_to_office_order_table', 36),
(54, '2025_02_20_103340_add_keyword_to_office_memorandum_table', 37),
(55, '2025_02_28_051644_add_columns_to_users_table', 38),
(56, '2025_03_04_053135_create_pm_reference_table', 39),
(57, '2025_03_04_053740_create_pm_reference_upload_table', 40),
(58, '2025_03_05_063303_create_vip_reference_table', 41),
(59, '2025_03_05_063355_create_vip_reference_upload_table', 42),
(60, '2025_03_06_064342_create_pragati_table', 43),
(61, '2025_03_06_070637_create_pragati_uploads_table', 44),
(62, '2025_03_06_072924_create_rebuttals_table', 45),
(63, '2025_03_06_072959_create_rebuttals_upload_table', 46);

-- --------------------------------------------------------

--
-- Table structure for table `minutes_of_metting`
--

CREATE TABLE `minutes_of_metting` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
  `date_of_Meeting` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agenda` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minutes_of_metting_upload`
--

CREATE TABLE `minutes_of_metting_upload` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
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
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `division_id`, `computer_no`, `file_no`, `date_of_issue`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`, `keyword`) VALUES
(1, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(2, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(3, 3, 'rohit', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-18 06:38:18', NULL),
(4, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(5, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(6, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(7, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(8, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(9, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(10, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(11, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL),
(12, 9, 'fdf000000', 'L-1222/1/2024-IA-I-(R)', '2025-01-31', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 0, NULL, NULL, 3, '2025-02-12 03:25:28', '2025-02-12 03:25:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_uploads`
--

CREATE TABLE `notification_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_uploads`
--

INSERT INTO `notification_uploads` (`id`, `record_id`, `user_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'notification_uploads/HfDF2lCoKIfoemF3H2PX3r2pZosjx43OJFbKCCxK.pdf', '1.pdf', '2025-02-12 03:25:28', '2025-02-12 03:25:28'),
(2, 1, 3, 'notification_uploads/6ZKQwmHDi63PuLfairGq7GhIyQ4gMSc1M65uxINM.pdf', 'Appointment Rohit Rawat.pdf', '2025-02-12 03:25:28', '2025-02-12 03:25:28');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_memorandum`
--

INSERT INTO `office_memorandum` (`id`, `division_id`, `user_id`, `computer_no`, `file_no`, `date_of_issue`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`, `keyword`) VALUES
(1, 3, 3, 'fdf999999', 'L-1222/1/2024-IA-I-(R)', '2025-02-08', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 1, 1, '2025-02-18 04:23:09', '2025-02-11 23:42:27', '2025-02-17 22:53:09', NULL),
(2, 2, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-07', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-03-03 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:10:10', '2025-03-03 04:19:54', 'Joint,Sectary'),
(3, 2, 2, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:10:34', '2025-03-03 23:28:54', 'df,ffg'),
(4, 2, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-07', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:10:10', '2025-03-04 05:53:41', 'fghhjn'),
(5, 3, 3, 'fdf999999', 'L-1222/1/2024-IA-I-(R)', '2025-02-08', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 1, 1, '2025-02-18 04:23:09', '2025-02-11 23:42:27', '2025-02-17 22:53:09', NULL),
(6, 2, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-07', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:10:10', '2025-03-04 05:53:55', 'sedgdh'),
(7, 2, 2, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:10:34', '2025-03-04 05:54:11', 'werwet'),
(8, 2, 2, 'mgk', 'L-1222/1/2024-IA-I-(R)', '2025-02-07', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 1, 1, '2025-03-04 11:24:52', '2025-02-18 00:10:10', '2025-03-04 05:54:52', NULL),
(9, 3, 3, 'fdf999999', 'L-1222/1/2024-IA-I-(R)', '2025-02-08', 'ttrt', 'issuer', 'LA', NULL, '2025-02-12 00:00:00', 0, 1, 1, 1, '2025-02-18 04:23:09', '2025-02-11 23:42:27', '2025-02-17 22:53:09', NULL),
(10, 1, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-07', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 1, 1, '2025-03-04 11:24:56', '2025-02-18 00:10:10', '2025-03-04 05:54:56', NULL),
(11, 1, 2, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 1, 1, '2025-03-04 11:25:00', '2025-02-18 00:10:34', '2025-03-04 05:55:00', NULL),
(12, 2, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-07', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:10:10', '2025-03-04 05:54:33', 'etetergt'),
(13, 2, 2, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-13', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:10:34', '2025-03-04 05:36:12', 'g,fghb'),
(14, 1, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-07', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 1, 1, '2025-03-04 11:24:45', '2025-02-18 00:10:10', '2025-03-04 05:54:45', NULL),
(15, 1, 2, 'dfdfgfdg', 'L-1222/1/2024-IA-I-(R)', '2025-02-07', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 1, 1, '2025-03-04 11:02:04', '2025-02-18 00:10:10', '2025-03-04 05:32:04', NULL),
(16, 2, 2, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-14', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-03-04 00:00:00', 0, 1, 1, 1, '2025-03-04 11:24:41', '2025-02-18 00:13:19', '2025-03-04 05:54:41', 'h,vfbv,gnn'),
(17, 1, 2, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-04', '2222222', 'Super Admin', 'Director General of Forest & Special Secretary', 0, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-03-04 00:35:27', '2025-03-04 00:35:27', 'h'),
(18, 1, 2, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-11', '2222222', 'Super Admin', 'Director General of Forest & Special Secretary', 0, '2025-03-04 00:00:00', 1, 1, 1, 1, '2025-03-04 11:01:59', '2025-03-04 03:44:52', '2025-03-04 05:31:59', 'h'),
(19, 1, 2, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-05', '2222222', 'Super Admin', 'Director General of Forest & Special Secretary', 0, '2025-03-04 00:00:00', 0, 1, 1, 1, '2025-03-04 11:03:16', '2025-03-04 05:32:58', '2025-03-04 05:33:16', 'h'),
(20, 2, 2, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-28', '2222222', 'Super Admin', 'Director General of Forest & Special Secretary', 0, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-03-04 05:33:41', '2025-03-04 05:34:49', 'hrftgbb'),
(21, 2, 72, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-05', '2222222', 'Super Admin', 'Director General of Forest & Special Secretary', 0, '2025-03-04 00:00:00', 0, 1, 0, NULL, NULL, '2025-03-04 05:36:59', '2025-03-04 05:36:59', 'g');

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
(1, 1, 3, 'office_memorandum_uploads/8QR8TxBAwuhDJVDlBN49wYDOUJ5EgvcqESARX7Cj.pdf', '1.pdf', '2025-02-11 23:42:28', '2025-02-11 23:42:28'),
(3, 1, 3, 'office_memorandum_uploads/DDuEdDsTO0KhiKAX3mv3ARYdjtxVFRdQ7A0nJPSa.pdf', 'Appointment Rohit Rawat.pdf', '2025-02-11 23:43:18', '2025-02-11 23:43:18'),
(4, 2, 2, 'office_memorandum_uploads/0gnEnS9svxVrPYJFyiOZ8xcK3f2bZptnxDLmWavI.pdf', 'rohitrawat - coverletter.pdf', '2025-02-18 00:10:10', '2025-02-18 00:10:10'),
(5, 3, 2, 'office_memorandum_uploads/VkVZecQOgeFLiKFkfze7dC7A79MAVQTcDps49x9X.pdf', 'rohitrawat - coverletter.pdf', '2025-02-18 00:10:34', '2025-02-18 00:10:34'),
(6, 16, 2, 'office_memorandum_uploads/3bx4Io2Wu1DP8I2IvxsgRy9zp3w3oItBQtgXgnH8.pdf', 'rohitrawat_europass_resume.pdf', '2025-02-18 00:13:19', '2025-02-18 00:13:19'),
(7, 17, 2, 'office_memorandum_uploads/KmUud5CsEcObrIacRkE2iwz2QSEjMoMBMxPVBftH.pdf', 'dummy.pdf', '2025-03-04 00:35:27', '2025-03-04 00:35:27'),
(8, 18, 2, 'office_memorandum_uploads/FdQzn3f9vonHEQLrdwWjx3dsfm34mFpfbBKz4HNX.pdf', 'dummy.pdf', '2025-03-04 03:44:52', '2025-03-04 03:44:52'),
(9, 19, 2, 'office_memorandum_uploads/jvBDnyDiqTBHtYRRq9kZJGrffkgikEKFfKlnz6Gw.pdf', 'dummy.pdf', '2025-03-04 05:32:58', '2025-03-04 05:32:58'),
(10, 20, 2, 'office_memorandum_uploads/dqC3b4yp7ccm6J5JSzyOpdZ6m0Y78WYie9DeV7RJ.pdf', 'dummy.pdf', '2025-03-04 05:33:41', '2025-03-04 05:33:41'),
(11, 13, 2, 'office_memorandum_uploads/CAQN258tlbq0nhHTqacWMwzysG2cT4xqhUHSuGOj.pdf', 'dummy.pdf', '2025-03-04 05:36:12', '2025-03-04 05:36:12'),
(12, 21, 72, 'office_memorandum_uploads/KK0PGvWWnYosOklftVyJLZIahvImKBUJq7dF1zFi.pdf', 'dummy.pdf', '2025-03-04 05:36:59', '2025-03-04 05:36:59'),
(13, 6, 2, 'office_memorandum_uploads/aYI2ottJoVGIHpgrwXzj1WZ4uBLXiQmxpZNigmeq.pdf', 'dummy.pdf', '2025-03-04 05:53:55', '2025-03-04 05:53:55'),
(14, 7, 2, 'office_memorandum_uploads/T6ygjhgyM2AnOZnIdhml0Vz5UVY5wHAN24abISOV.pdf', 'dummy.pdf', '2025-03-04 05:54:11', '2025-03-04 05:54:11'),
(15, 12, 2, 'office_memorandum_uploads/r9wslygNpFli2fa8BHNLrQj4hQzsJbF2IIAJg51v.pdf', 'dummy.pdf', '2025-03-04 05:54:33', '2025-03-04 05:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `office_order`
--

CREATE TABLE `office_order` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_order`
--

INSERT INTO `office_order` (`id`, `division_id`, `computer_no`, `file_no`, `date_of_issue`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`, `user_id`, `keyword`) VALUES
(2, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(3, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(4, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(5, 2, 'shivam', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 06:37:57', 2, NULL),
(6, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(7, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(8, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(9, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(10, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(11, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(12, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL),
(13, 1, 'sedjfhuisdf', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'sdkfnjkd', 'fdgfd', NULL, '2025-02-18 00:00:00', 0, 1, 0, NULL, NULL, '2025-02-18 00:19:48', '2025-02-18 00:19:48', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `office_order_uploads`
--

CREATE TABLE `office_order_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `user_id` int NOT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_order_uploads`
--

INSERT INTO `office_order_uploads` (`id`, `record_id`, `user_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'office_order_uploads/eCbem00tp7hQTZPT9qvnO5h9Kzwm1rEbtPXQevZi.pdf', 'rohitrawat - coverletter.pdf', '2025-02-18 00:19:48', '2025-02-18 00:19:48');

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
(8, NULL, 'Office Memorandum\r\n', 1, 0, NULL, NULL, NULL, NULL),
(9, NULL, 'Office Order\r\n', 1, 0, NULL, NULL, NULL, NULL),
(10, NULL, 'Notifications\r\n', 1, 0, NULL, NULL, NULL, NULL),
(11, NULL, 'Letters', 1, 0, NULL, NULL, NULL, NULL),
(12, NULL, 'Record of Discussion (ROD)\r\n', 1, 0, NULL, NULL, NULL, NULL),
(13, NULL, 'Minutes of Meeting (MoM)\r\n', 1, 0, NULL, NULL, NULL, NULL),
(14, NULL, 'Bilateral / Multilateral\r\n', 1, 0, NULL, NULL, NULL, NULL),
(15, NULL, 'International Meetings (COPs, G20, etc)\r\n', 1, 0, NULL, NULL, NULL, NULL),
(16, NULL, 'Gazette Notifications\r\n', 1, 0, NULL, NULL, NULL, NULL),
(17, NULL, 'Recruitment Rules\r\n', 1, 0, NULL, NULL, NULL, NULL),
(18, NULL, 'Guidelines\r\n', 1, 0, NULL, NULL, NULL, NULL),
(19, NULL, 'Achievements\r\n', 1, 0, NULL, NULL, NULL, NULL),
(20, NULL, 'Rebuttals\r\n', 1, 0, NULL, NULL, NULL, NULL),
(21, NULL, 'Presentations\r\n', 1, 0, NULL, NULL, NULL, NULL),
(22, NULL, 'Parliament Questions (Lok Sabha)\r\n', 1, 0, NULL, NULL, NULL, NULL),
(23, NULL, 'Parliament Questions (Rajya Sabha)\r\n', 1, 0, NULL, NULL, NULL, NULL),
(24, NULL, 'Office\r\n', 1, 0, NULL, NULL, NULL, NULL),
(25, NULL, 'Court Case', 1, 0, NULL, NULL, NULL, NULL),
(26, NULL, 'PM Reference', 1, 0, NULL, NULL, NULL, NULL),
(27, NULL, 'VIP Reference', 1, 0, NULL, NULL, NULL, NULL),
(28, NULL, 'Cabinet Note', 1, 0, NULL, NULL, NULL, NULL),
(29, NULL, 'Pragati', 1, 0, NULL, NULL, NULL, NULL),
(30, NULL, 'Prayas', 1, 0, NULL, NULL, NULL, NULL),
(31, NULL, 'Cabinet Observation', 1, 0, NULL, NULL, NULL, NULL),
(32, NULL, 'eSamikSha', 1, 0, NULL, NULL, NULL, NULL),
(33, NULL, 'Annual Report', 1, 0, NULL, NULL, NULL, NULL),
(34, NULL, 'MEF Speech', 1, 0, NULL, NULL, NULL, NULL),
(35, NULL, 'Subordinate Legislations', 1, 0, NULL, NULL, NULL, NULL),
(36, NULL, 'Public Grievance', 1, 0, NULL, NULL, NULL, NULL),
(37, NULL, 'RTI', 1, 0, NULL, NULL, NULL, NULL),
(38, NULL, 'Bilateral / Multilateral', 1, 0, NULL, NULL, NULL, NULL),
(39, NULL, 'International', 1, 0, NULL, NULL, NULL, NULL),
(40, NULL, 'Read', 1, 0, NULL, NULL, NULL, NULL),
(41, NULL, 'Write', 1, 0, NULL, NULL, NULL, NULL),
(42, NULL, 'Update', 1, 0, NULL, NULL, NULL, NULL),
(43, NULL, 'Delete', 1, 0, NULL, NULL, NULL, NULL);

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
-- Table structure for table `pm_reference`
--

CREATE TABLE `pm_reference` (
  `id` bigint UNSIGNED NOT NULL,
  `computer_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_receipt` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_sent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pm_reference`
--

INSERT INTO `pm_reference` (`id`, `computer_no`, `file_no`, `date_of_receipt`, `subject`, `action`, `date_of_sent`, `issuer_name`, `issuer_designation`, `uploaded_by`, `keyword`, `date_of_upload`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-11', '2222222', 'sdfgfh', '2025-03-10', 'Super Admin', 'Director General of Forest & Special Secretary', 0, 't', '2025-03-04 00:00:00', 1, 1, 1, '2025-03-04 06:03:19', 1, '2025-03-04 00:12:51', '2025-03-04 00:33:19'),
(2, 'dffh', 'L-1222/1/2024-IA-I-(R)', '2025-03-11', '2222222', 'sfge', '2025-03-10', 'Super Admin', 'Director General of Forest & Special Secretary', 0, 'fh,drfgh', '2025-03-05 00:00:00', 1, 0, NULL, NULL, 1, '2025-03-04 00:17:45', '2025-03-05 01:41:56'),
(3, 'dffh', 'L-1222/1/2024-IA-I-(R)', '2025-03-06', '2222222', 'sfge', '2025-03-05', 'Super Admin', 'Director General of Forest & Special Secretary', 0, 'f,h', '2025-03-04 00:00:00', 1, 0, NULL, NULL, 1, '2025-03-04 00:22:26', '2025-03-04 00:22:26'),
(4, 'dffh', 'L-1222/1/2024-IA-I-(R)', '2025-03-04', '2222222', 'sfge', '2025-03-04', 'Super Admin', 'Director General of Forest & Special Secretary', 0, 'g', '2025-03-04 00:00:00', 1, 1, 1, '2025-03-04 06:03:14', 1, '2025-03-04 00:27:44', '2025-03-04 00:33:14'),
(5, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-03', '2222222', 'sfge', '2025-03-03', 'Super Admin', 'Director General of Forest & Special Secretary', 0, 'gfghbfh', '2025-03-04 00:00:00', 1, 0, NULL, NULL, 1, '2025-03-04 05:39:39', '2025-03-04 05:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `pm_reference_upload`
--

CREATE TABLE `pm_reference_upload` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pm_reference_upload`
--

INSERT INTO `pm_reference_upload` (`id`, `user_id`, `record_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'pm_reference_upload/kMt5SKpkZRrVx50AufoPSdbMCgbXOmgtusNGG7sM.pdf', 'dummy.pdf', '2025-03-04 00:12:51', '2025-03-04 00:12:51'),
(2, 1, 2, 'pm_reference_upload/tQwqtUhjCt2njyt1rFzij5ijhLQjA4efZn2HFlU6.pdf', 'dummy.pdf', '2025-03-04 00:17:45', '2025-03-04 00:17:45'),
(3, 1, 3, 'pm_reference_upload/sEDrbCtn3wS2BdZley705KzfgB6THwS2TF7czPKO.pdf', 'dummy.pdf', '2025-03-04 00:22:26', '2025-03-04 00:22:26'),
(4, 1, 4, 'pm_reference_upload/OQD9ERWzNaNHaV31MUHSThI2pBjh9iuUXBsVm862.pdf', 'dummy.pdf', '2025-03-04 00:27:44', '2025-03-04 00:27:44'),
(5, 1, 5, 'pm_reference_upload/AvgcCTq3dn87gGslfmRFDrrolreIy1ijnNUqyjWr.pdf', 'dummy.pdf', '2025-03-04 05:39:39', '2025-03-04 05:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `pragati`
--

CREATE TABLE `pragati` (
  `id` bigint UNSIGNED NOT NULL,
  `computer_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_receipt` date DEFAULT NULL,
  `agenda` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_taken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_reply` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `issuer_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `keywords` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pragati_uploads`
--

CREATE TABLE `pragati_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presentations`
--

CREATE TABLE `presentations` (
  `id` bigint UNSIGNED NOT NULL,
  `computer_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_publication` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approvedBy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presentations_upload`
--

CREATE TABLE `presentations_upload` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rebuttals`
--

CREATE TABLE `rebuttals` (
  `id` bigint UNSIGNED NOT NULL,
  `computer_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `court_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `petitioner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `respondent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rebuttals_upload`
--

CREATE TABLE `rebuttals_upload` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records_of_discussion`
--

CREATE TABLE `records_of_discussion` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint DEFAULT NULL,
  `date_of_Meeting` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agenda` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records_of_discussion`
--

INSERT INTO `records_of_discussion` (`id`, `division_id`, `date_of_Meeting`, `subject`, `agenda`, `issuer_designation`, `uploaded_by`, `keyword`, `date_of_upload`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-03-05', 'vvvv', 'aaa', 'Director General of Forest & Special Secretary', 0, 'vv,v', '2025-03-04 00:00:00', 1, 0, NULL, NULL, 2, '2025-03-04 02:19:54', '2025-03-04 02:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `records_of_discussion_upload`
--

CREATE TABLE `records_of_discussion_upload` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records_of_discussion_upload`
--

INSERT INTO `records_of_discussion_upload` (`id`, `user_id`, `record_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'records_of_discussion_uploads/zFhxHWqBkHYxNoguIw9U948gYWO1lW8mz14KlL59.pdf', 'dummy.pdf', '2025-03-04 02:19:54', '2025-03-04 02:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment`
--

CREATE TABLE `recruitment` (
  `id` bigint UNSIGNED NOT NULL,
  `computer_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `file_type` tinyint DEFAULT NULL COMMENT '0 => confidential, 1=> non-confidential',
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recruitment`
--

INSERT INTO `recruitment` (`id`, `computer_no`, `file_no`, `date_of_issue`, `subject`, `issuer_name`, `issuer_designation`, `uploaded_by`, `keyword`, `date_of_upload`, `file_type`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Anerudh pandey', 'L-1222/1/2024-IA-I-(R)', '2025-02-27', 'Software Engineer', 'Sushmita', 'Director', 2, 'klxf,sdkjnfks', '2025-02-27 00:00:00', NULL, 1, 0, NULL, NULL, 73, '2025-02-27 18:29:15', '2025-02-27 18:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_upload`
--

CREATE TABLE `recruitment_upload` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recruitment_upload`
--

INSERT INTO `recruitment_upload` (`id`, `user_id`, `record_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 73, 1, 'recruitment_upload/zh61mB0QrpvqlZFXYqxnbmTeJofM6WPtPo4izu78.pdf', 'Information Technology.pdf', '2025-02-27 18:29:15', '2025-02-27 18:29:15');

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
  `designation_id` varchar(51) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `unique_key`, `name`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`, `designation_id`, `permission_id`) VALUES
(0, '41a232cc-b11b-4e15-bf09-4c1aef8fe1a9', 'admin', 1, 0, NULL, NULL, '2025-02-19 04:21:52', '2025-02-27 16:58:29', '1,3,4,27,2', '8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,42,43'),
(2, '74ad948f-b7d0-4f3b-bd71-7d5ce1ac9f94', 'user', 1, 0, NULL, NULL, '2025-02-19 04:41:59', '2025-03-07 06:18:40', '3,5,8', '8,9,10,11,17,40'),
(3, '9350b08b-b2cf-41a3-8ab7-846b053ddcd8', 'divadmin', 1, 0, NULL, NULL, '2025-02-19 04:42:47', '2025-02-19 04:42:47', '3', '8,11,12,13,18,24');

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
  `is_pwd_changed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_key`, `first_name`, `last_name`, `name`, `email`, `email_verified_at`, `user_name`, `password`, `is_admin`, `role_id`, `designation`, `division`, `phone`, `phone_code`, `phone_iso`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `is_pwd_changed`) VALUES
(1, '935', 'Rohit', 'Rawat', 'Super Admin', 'admin@gmail.com', NULL, 'admin', '$2y$10$wdMVsu.tu2A3wKlryxN5MuH3FPeR3GAb218YNd89EIJFO8ckMpPW6', 1, 0, '2', '0', '8010176343', '91', 'in', 1, 1, 1, '2025-02-20 12:00:55', NULL, '2025-01-08 04:25:18', '2025-03-03 06:19:35', 1),
(2, 'V0IFA94O-FMMN-BCKQ-HKQXSCEJXTK', 'Jaid', 'Shrivastva', 'Jaid Shrivastva', 'jai123@gmail.in', NULL, 'jai123', '$2y$10$Uljgbg.liG/xVGSY0eMwJ.Yb34aHsCyqPHwNubDEAccNQJA00PA6y', 0, 3, '1', '1', '9893434421', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-01-08 04:25:18', '2025-02-25 02:54:13', 0),
(3, 'OXX39SRY-IHT1-USWH-VZXF9TLSBDL', 'Om', 'Bansal', 'Om Bansal', 'om@gov.in', NULL, 'om89', '$2y$10$Uljgbg.liG/xVGSY0eMwJ.Yb34aHsCyqPHwNubDEAccNQJA00PA6y', 0, 2, '2', '1,4,9', '8969408837', '91', 'in', 1, 1, 3, '2025-02-27 01:47:31', NULL, '2025-01-08 04:30:21', '2025-02-26 20:17:31', 0),
(4, 'OXX39SRY-IHT1-USWH-VZXF9TLSBDL', 'Om', 'Bansal', 'Om Bansal', 'ome@nic.com', NULL, 'om89', '$2y$10$Uljgbg.liG/xVGSY0eMwJ.Yb34aHsCyqPHwNubDEAccNQJA00PA6y', 0, NULL, '2', '1,4,9', '8969408837', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-01-08 04:30:21', '2025-02-24 05:50:11', 0),
(5, NULL, 'jasmin', 'Ali', 'jasmin Ali', 'jasmin676@nic.in', NULL, 'omms_jasmin69', '$2y$10$N2reJpqgctwhdNbItXzqIuSPe8B0bz9IMfc4kNQpV6DYaJIl6xNJO', 0, 3, '5', '2,3', '8937453829', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-02-21 03:17:32', '2025-03-03 04:39:15', 1),
(70, NULL, 'sdhfkjdsb', 'kjsdfkjdns', 'sdhfkjdsb kjsdfkjdns', 'rohitrawat8676@nic.in', NULL, 'omms_rohitrawat8676', '$2y$10$wImgDa7TnAYWkFU7auVbE.HPK8SBSWUeAMIG4dYD2SReSkHTEgd/G', 0, 2, '8', '2', '3298672384', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-02-24 06:07:09', '2025-02-24 06:07:09', 0),
(71, NULL, 'shivam', 'minocha', 'shivam minocha', 'rohitrawat98789676@nic.in', NULL, 'rohitrawat9878967672', '$2y$10$/88m4ca2xQJ.qcHWZjM7zuA.zgfn6x6lUGL5VbOg3EC2QihZdWBIi', 0, 2, '5', '2', '8839087842', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-02-24 06:09:11', '2025-02-24 06:09:11', 0),
(72, NULL, 'Abushl', 'Jubli', 'Abushl Jubli', 'rohitrawat690328476@gov.in', NULL, 'rohitrawat69032847673', '$2y$10$Vdyhs6fj9IJomzeKIq34UuSQV6RUaMfJMVG25n2Z7CanrWsW9CdT6', 0, 2, '5', '2', '8456378943', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-02-24 06:14:08', '2025-02-24 06:14:08', 0),
(73, NULL, 'Rohit', 'Rawat', 'Rohit Rawat', 'rohitrawat676@nic.in', NULL, 'rohitrawat67674', '$2y$10$ZxNodIPJqM8Gtn8XRPMi4ec4ncUJk9.fgOWoBK7StlfJPlyLC07Cm', 0, 2, '5', '2', '8630950613', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-02-27 17:00:20', '2025-02-27 17:00:20', 0),
(74, NULL, 'esdg', 'fdhrfj', 'esdg fdhrfj', 'singhbeautyk@gov.in', NULL, 'singhbeautyk75', '$2y$10$wdMVsu.tu2A3wKlryxN5MuH3FPeR3GAb218YNd89EIJFO8ckMpPW6', 0, 2, '3', '3', '9634646346', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-03-04 06:51:02', '2025-03-04 06:51:02', 1),
(75, NULL, 'sonali', 'dhoundiyal', 'sonali dhoundiyal', 'sonali@nic.in', NULL, 'sonali', '$2y$10$PFACYEnbigb2HugMxVtj5OyX8aDV6Vu1CC5VXpA6Na3O0q/Qwl342', 0, 2, '5', '3', '8908790808', '91', 'in', 1, 0, NULL, NULL, NULL, '2025-03-05 12:44:36', '2025-03-05 12:46:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vip_reference`
--

CREATE TABLE `vip_reference` (
  `id` bigint UNSIGNED NOT NULL,
  `computer_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_receipt` date DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_sent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuer_designation` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint DEFAULT NULL,
  `keyword` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_upload` datetime DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  `is_deleted` tinyint DEFAULT '0',
  `deleted_by` bigint DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vip_reference`
--

INSERT INTO `vip_reference` (`id`, `computer_no`, `file_no`, `date_of_receipt`, `subject`, `action`, `vip`, `date_of_sent`, `issuer_name`, `issuer_designation`, `uploaded_by`, `keyword`, `date_of_upload`, `is_active`, `is_deleted`, `deleted_by`, `deleted_at`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-04', '2222222', 'sfge', 'Beauty Kumari', '2025-03-04', 'Super Admin', 'Director General of Forest & Special Secretary', 0, 'h,gt,hy', '2025-03-05 00:00:00', 1, 0, NULL, NULL, 1, '2025-03-05 01:18:39', '2025-03-05 01:24:37'),
(2, '12362222222222', 'L-1222/1/2024-IA-I-(R)', '2025-03-04', '2222222', 'sfge', 'Beauty Kumari', '2025-03-04', 'Super Admin', 'Director General of Forest & Special Secretary', 0, 'g', '2025-03-05 00:00:00', 1, 1, 1, '2025-03-05 06:55:56', 1, '2025-03-05 01:20:35', '2025-03-05 01:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `vip_reference_upload`
--

CREATE TABLE `vip_reference_upload` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record_id` bigint DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vip_reference_upload`
--

INSERT INTO `vip_reference_upload` (`id`, `user_id`, `record_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'vip_reference_upload/oxJ6DX7VXEVIr9S58piODL290L0p1CXnxlI6SwVG.pdf', 'dummy.pdf', '2025-03-05 01:18:39', '2025-03-05 01:18:39'),
(2, 1, 2, 'vip_reference_upload/YOIe3SFJb0Y1CX5lXKzjGB4VLJURxqCYOSf4wc0k.pdf', 'dummy.pdf', '2025-03-05 01:20:35', '2025-03-05 01:20:35'),
(3, 1, 1, 'vip_reference_upload/03g8xvvs3aLcdw9ao4tbctaRvMoqGTvGP2zf3ZCM.pdf', 'dummy.pdf', '2025-03-05 01:24:37', '2025-03-05 01:24:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievenment`
--
ALTER TABLE `achievenment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achievenment_user_id_foreign` (`user_id`),
  ADD KEY `achievenment_uploaded_by_index` (`uploaded_by`),
  ADD KEY `achievenment_file_type_index` (`file_type`),
  ADD KEY `achievenment_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `achievenment_upload`
--
ALTER TABLE `achievenment_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achievenment_upload_user_id_foreign` (`user_id`),
  ADD KEY `achievenment_upload_record_id_index` (`record_id`);

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
-- Indexes for table `gazette_notification`
--
ALTER TABLE `gazette_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gazette_notification_user_id_foreign` (`user_id`),
  ADD KEY `gazette_notification_division_id_index` (`division_id`),
  ADD KEY `gazette_notification_uploaded_by_index` (`uploaded_by`),
  ADD KEY `gazette_notification_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `gazette_notification_uploads`
--
ALTER TABLE `gazette_notification_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gazette_notification_uploads_user_id_foreign` (`user_id`),
  ADD KEY `gazette_notification_uploads_record_id_index` (`record_id`);

--
-- Indexes for table `guidelines`
--
ALTER TABLE `guidelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guidelines_user_id_foreign` (`user_id`),
  ADD KEY `guidelines_division_id_index` (`division_id`),
  ADD KEY `guidelines_uploaded_by_index` (`uploaded_by`),
  ADD KEY `guidelines_file_type_index` (`file_type`),
  ADD KEY `guidelines_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `guideline_uploads`
--
ALTER TABLE `guideline_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guideline_uploads_user_id_foreign` (`user_id`),
  ADD KEY `guideline_uploads_record_id_index` (`record_id`);

--
-- Indexes for table `letter`
--
ALTER TABLE `letter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `letter_user_id_foreign` (`user_id`),
  ADD KEY `letter_division_id_index` (`division_id`),
  ADD KEY `letter_uploaded_by_index` (`uploaded_by`),
  ADD KEY `letter_file_type_index` (`file_type`),
  ADD KEY `letter_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `letter_uploads`
--
ALTER TABLE `letter_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `letter_uploads_record_id_index` (`record_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minutes_of_metting`
--
ALTER TABLE `minutes_of_metting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `minutes_of_metting_user_id_foreign` (`user_id`),
  ADD KEY `minutes_of_metting_division_id_index` (`division_id`),
  ADD KEY `minutes_of_metting_uploaded_by_index` (`uploaded_by`),
  ADD KEY `minutes_of_metting_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `minutes_of_metting_upload`
--
ALTER TABLE `minutes_of_metting_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `minutes_of_metting_upload_user_id_foreign` (`user_id`),
  ADD KEY `minutes_of_metting_upload_record_id_index` (`record_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_user_id_foreign` (`user_id`),
  ADD KEY `notification_division_id_index` (`division_id`),
  ADD KEY `notification_uploaded_by_index` (`uploaded_by`),
  ADD KEY `notification_file_type_index` (`file_type`),
  ADD KEY `notification_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `notification_uploads`
--
ALTER TABLE `notification_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_uploads_record_id_index` (`record_id`);

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
-- Indexes for table `pm_reference`
--
ALTER TABLE `pm_reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pm_reference_user_id_foreign` (`user_id`),
  ADD KEY `pm_reference_uploaded_by_index` (`uploaded_by`),
  ADD KEY `pm_reference_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `pm_reference_upload`
--
ALTER TABLE `pm_reference_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pm_reference_upload_user_id_foreign` (`user_id`),
  ADD KEY `pm_reference_upload_record_id_index` (`record_id`);

--
-- Indexes for table `pragati`
--
ALTER TABLE `pragati`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pragati_user_id_foreign` (`user_id`),
  ADD KEY `pragati_uploaded_by_index` (`uploaded_by`),
  ADD KEY `pragati_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `pragati_uploads`
--
ALTER TABLE `pragati_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pragati_uploads_user_id_foreign` (`user_id`),
  ADD KEY `pragati_uploads_record_id_index` (`record_id`);

--
-- Indexes for table `presentations`
--
ALTER TABLE `presentations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presentations_user_id_foreign` (`user_id`),
  ADD KEY `presentations_uploaded_by_index` (`uploaded_by`),
  ADD KEY `presentations_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `presentations_upload`
--
ALTER TABLE `presentations_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presentations_upload_user_id_foreign` (`user_id`),
  ADD KEY `presentations_upload_record_id_index` (`record_id`);

--
-- Indexes for table `rebuttals`
--
ALTER TABLE `rebuttals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rebuttals_user_id_foreign` (`user_id`),
  ADD KEY `rebuttals_uploaded_by_index` (`uploaded_by`),
  ADD KEY `rebuttals_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `rebuttals_upload`
--
ALTER TABLE `rebuttals_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rebuttals_upload_user_id_foreign` (`user_id`),
  ADD KEY `rebuttals_upload_record_id_index` (`record_id`);

--
-- Indexes for table `records_of_discussion`
--
ALTER TABLE `records_of_discussion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `records_of_discussion_user_id_foreign` (`user_id`),
  ADD KEY `records_of_discussion_division_id_index` (`division_id`),
  ADD KEY `records_of_discussion_uploaded_by_index` (`uploaded_by`),
  ADD KEY `records_of_discussion_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `records_of_discussion_upload`
--
ALTER TABLE `records_of_discussion_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `records_of_discussion_upload_user_id_foreign` (`user_id`),
  ADD KEY `records_of_discussion_upload_record_id_index` (`record_id`);

--
-- Indexes for table `recruitment`
--
ALTER TABLE `recruitment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recruitment_user_id_foreign` (`user_id`),
  ADD KEY `recruitment_uploaded_by_index` (`uploaded_by`),
  ADD KEY `recruitment_file_type_index` (`file_type`),
  ADD KEY `recruitment_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `recruitment_upload`
--
ALTER TABLE `recruitment_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recruitment_upload_user_id_foreign` (`user_id`),
  ADD KEY `recruitment_upload_record_id_index` (`record_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `vip_reference`
--
ALTER TABLE `vip_reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vip_reference_user_id_foreign` (`user_id`),
  ADD KEY `vip_reference_uploaded_by_index` (`uploaded_by`),
  ADD KEY `vip_reference_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `vip_reference_upload`
--
ALTER TABLE `vip_reference_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vip_reference_upload_user_id_foreign` (`user_id`),
  ADD KEY `vip_reference_upload_record_id_index` (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievenment`
--
ALTER TABLE `achievenment`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `achievenment_upload`
--
ALTER TABLE `achievenment_upload`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
-- AUTO_INCREMENT for table `gazette_notification`
--
ALTER TABLE `gazette_notification`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gazette_notification_uploads`
--
ALTER TABLE `gazette_notification_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guidelines`
--
ALTER TABLE `guidelines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `guideline_uploads`
--
ALTER TABLE `guideline_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `letter`
--
ALTER TABLE `letter`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `letter_uploads`
--
ALTER TABLE `letter_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `minutes_of_metting`
--
ALTER TABLE `minutes_of_metting`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `minutes_of_metting_upload`
--
ALTER TABLE `minutes_of_metting_upload`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification_uploads`
--
ALTER TABLE `notification_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `office_memorandum`
--
ALTER TABLE `office_memorandum`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `office_memorandum_uploads`
--
ALTER TABLE `office_memorandum_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `office_order`
--
ALTER TABLE `office_order`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `office_order_uploads`
--
ALTER TABLE `office_order_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_reference`
--
ALTER TABLE `pm_reference`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pm_reference_upload`
--
ALTER TABLE `pm_reference_upload`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pragati`
--
ALTER TABLE `pragati`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pragati_uploads`
--
ALTER TABLE `pragati_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presentations`
--
ALTER TABLE `presentations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presentations_upload`
--
ALTER TABLE `presentations_upload`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rebuttals`
--
ALTER TABLE `rebuttals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rebuttals_upload`
--
ALTER TABLE `rebuttals_upload`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records_of_discussion`
--
ALTER TABLE `records_of_discussion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `records_of_discussion_upload`
--
ALTER TABLE `records_of_discussion_upload`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recruitment`
--
ALTER TABLE `recruitment`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recruitment_upload`
--
ALTER TABLE `recruitment_upload`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `vip_reference`
--
ALTER TABLE `vip_reference`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vip_reference_upload`
--
ALTER TABLE `vip_reference_upload`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievenment`
--
ALTER TABLE `achievenment`
  ADD CONSTRAINT `achievenment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `achievenment_upload`
--
ALTER TABLE `achievenment_upload`
  ADD CONSTRAINT `achievenment_upload_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gazette_notification`
--
ALTER TABLE `gazette_notification`
  ADD CONSTRAINT `gazette_notification_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gazette_notification_uploads`
--
ALTER TABLE `gazette_notification_uploads`
  ADD CONSTRAINT `gazette_notification_uploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guidelines`
--
ALTER TABLE `guidelines`
  ADD CONSTRAINT `guidelines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guideline_uploads`
--
ALTER TABLE `guideline_uploads`
  ADD CONSTRAINT `guideline_uploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `letter`
--
ALTER TABLE `letter`
  ADD CONSTRAINT `letter_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `minutes_of_metting`
--
ALTER TABLE `minutes_of_metting`
  ADD CONSTRAINT `minutes_of_metting_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `minutes_of_metting_upload`
--
ALTER TABLE `minutes_of_metting_upload`
  ADD CONSTRAINT `minutes_of_metting_upload_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `pragati`
--
ALTER TABLE `pragati`
  ADD CONSTRAINT `pragati_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pragati_uploads`
--
ALTER TABLE `pragati_uploads`
  ADD CONSTRAINT `pragati_uploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `presentations`
--
ALTER TABLE `presentations`
  ADD CONSTRAINT `presentations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `presentations_upload`
--
ALTER TABLE `presentations_upload`
  ADD CONSTRAINT `presentations_upload_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rebuttals`
--
ALTER TABLE `rebuttals`
  ADD CONSTRAINT `rebuttals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rebuttals_upload`
--
ALTER TABLE `rebuttals_upload`
  ADD CONSTRAINT `rebuttals_upload_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `records_of_discussion`
--
ALTER TABLE `records_of_discussion`
  ADD CONSTRAINT `records_of_discussion_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `records_of_discussion_upload`
--
ALTER TABLE `records_of_discussion_upload`
  ADD CONSTRAINT `records_of_discussion_upload_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recruitment`
--
ALTER TABLE `recruitment`
  ADD CONSTRAINT `recruitment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recruitment_upload`
--
ALTER TABLE `recruitment_upload`
  ADD CONSTRAINT `recruitment_upload_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
