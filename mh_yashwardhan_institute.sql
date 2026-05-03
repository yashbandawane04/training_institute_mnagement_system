-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2026 at 11:38 AM
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
-- Database: `mh_yashwardhan_institute`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` text NOT NULL,
  `role` enum('Admin','Staff') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password_hash`, `role`, `created_at`, `username`) VALUES
(1, 'yashadmin08@gmail.com', '$2y$10$dstv26SnYof3.VWHm6OJhOP.3bBZIEClTXduVcm5Q0rM94t1QT4Sq', 'Admin', '2025-07-14 19:33:00', 'Yash'),
(8, 'yashadmin10@gmail.com', '$2y$10$rlLarDhALeF8K2WEL4SyY.tnaobYAJQJ223SmdrH.ixNJeiZvSJuG', 'Admin', '2025-07-16 07:52:30', 'Yash'),
(9, 'yashadmin10@gmail.com', '$2y$10$1XbMkUNSbJNZZ0WjUpXbqeWoo0kIxOvZyOEfziBlzCL1C9swG5NC6', 'Admin', '2025-07-16 07:55:39', 'Yash'),
(10, 'yashadmin10@gmail.com', '$2y$10$Yx.jZQFKVzBTNpjwxHdNSu9gyC9RPfoGukO9anVWF7V1NOwgL760q', 'Admin', '2025-07-16 07:56:47', 'Yash'),
(11, 'yashadmin10@gmail.com', '$2y$10$4uZIiiJlADiElg4bfAqHhe7NVitwjZ9aN51j.A.Q.X/JUD9s43utO', 'Admin', '2025-07-16 07:57:10', 'Yash'),
(12, 'yashadmin10@gmail.com', '$2y$10$PbWZ0ThTqbpmzlmcQj35HulJplvPSUK4Sci70UMP6FdeSiOjWpRoi', 'Admin', '2025-07-16 07:57:20', 'Yash'),
(13, 'yashadmin10@gmail.com', '$2y$10$b2b4/9xdYEqlh2gpu68jZeBBgibbpMtyHTmgxloJBmvyhoLhbm1OK', 'Admin', '2025-07-16 07:57:54', 'Yash');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `student_name` varchar(200) DEFAULT NULL,
  `father_name` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`student_name`, `father_name`, `mobile`, `email`, `address`, `course`, `admission_date`) VALUES
('Abhiram Kailas Jadhav', 'kailas Jadhav', '+919876543219', 'Abiramjadhav06@gmail.com', 'Chikanghar Kalyan.(w) 421301.', 'Computer Engineering', '2025-06-02'),
('Abhiram Kailas Jadhav', 'kailas Jadhav', '+919876543219', 'Abiramjadhav06@gmail.com', 'Chikanghar Kalyan.(w) 421301.', 'Computer Engineering', '2025-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('Present','Absent','Leave') DEFAULT 'Present',
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `batch_id`, `student_id`, `date`, `status`, `remarks`) VALUES
(1, 1, 4, '2024-08-24', 'Present', 'A+'),
(3, 10, 14, '2024-08-03', 'Present', 'A+'),
(8, 18, 31, '2024-06-03', 'Present', 'A+'),
(9, 19, 32, '2024-06-03', 'Present', 'B+'),
(10, 20, 33, '2024-06-03', 'Present', 'A+'),
(11, 21, 34, '2024-06-03', 'Present', 'A+'),
(12, 22, 35, '2024-06-03', 'Present', 'A+'),
(13, 23, 36, '2024-06-03', 'Present', 'B+');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `batch_code` varchar(20) DEFAULT NULL,
  `batch_name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `days` varchar(50) DEFAULT NULL,
  `time_slot` varchar(50) DEFAULT NULL,
  `mode` enum('Online','Offline','Hybrid') DEFAULT NULL,
  `status` enum('Upcoming','Ongoing','Completed') DEFAULT 'Upcoming'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `course_id`, `trainer_id`, `batch_code`, `batch_name`, `start_date`, `end_date`, `days`, `time_slot`, `mode`, `status`) VALUES
(1, 1, NULL, 'WEB12345', 'WEB ITR', '2019-06-03', '2019-08-03', 'Mon-Wed-Fri', '1:30pm-4:30pm', 'Online', 'Upcoming'),
(2, 2, 4, 'MAD12345', 'Mobile App Dev', '2025-07-01', '2025-08-15', 'Mon-Wed-Fri', '10:00-12:00', 'Offline', 'Ongoing'),
(10, 12, 11, 'PY1366', 'PY ITR', '2019-06-03', '2019-08-03', 'Mon-Wed-Fri', '1:30pm-4:30pm', 'Online', 'Upcoming'),
(18, 28, 25, NULL, 'PY ITR', '2024-06-03', '2024-08-03', NULL, '1:30pm-4:30pm', NULL, 'Upcoming'),
(19, 29, 26, NULL, 'PY ITR', '2024-06-03', '2024-08-03', NULL, '1:30pm-4:30pm', NULL, 'Upcoming'),
(20, 30, 27, NULL, 'PY ITR', '2024-06-03', '2024-08-03', NULL, '1:30pm-4:30pm', NULL, 'Upcoming'),
(21, 31, 28, NULL, 'PY ITR', '2024-06-03', '2024-08-03', NULL, '1:30pm-4:30pm', NULL, 'Upcoming'),
(22, 32, 29, NULL, 'PY ITR', '2024-06-03', '2024-08-03', NULL, '1:30pm-4:30pm', NULL, 'Upcoming'),
(23, 33, 30, NULL, 'PY ITR', '2024-06-03', '2024-08-03', NULL, '1:30pm-4:30pm', NULL, 'Upcoming'),
(29, 128150, 0, '', 'MAD ITR', '0000-00-00', '0000-00-00', '', '', '', ''),
(31, 128150, 102, 'MAD12346', 'MAD ITR', '2024-03-02', '2024-08-02', 'Mon-Wed-Fri', '1:30pm-4:30pm', 'Online', ''),
(32, 128157, 105, 'DA26357', 'DA ITR', '2024-06-03', '2024-08-03', 'Mon-Wed-Fri', '1:00pm-4:00pm', 'Online', ''),
(34, 128157, 105, 'DA26358', 'DA ITR', '2024-06-03', '2024-08-03', 'Mon-Wed-Fri', '1:00pm-4:00pm', 'Online', '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `duration_weeks` int(11) DEFAULT NULL,
  `total_hours` int(11) DEFAULT NULL,
  `fees` decimal(10,2) DEFAULT NULL,
  `syllabus_link` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `course_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `description`, `duration_weeks`, `total_hours`, `fees`, `syllabus_link`, `created_at`, `course_code`) VALUES
(1, 'Web Development', 'Web development is the process of creating websites and web applications ', 12, 3, 2000.00, 'www.msbte.in', '2025-07-14 19:33:00', NULL),
(2, 'MA Development', 'Skilled in developing mobile applications using modern technologies like Android Studio, Java, and Kotlin.', 12, 3, 3000.00, 'www.msbte.in', '2025-07-14 19:49:39', NULL),
(12, 'Python Programming', 'Learn Python basics to advanced.', 12, 60, 5000.00, 'link_to_syllabus', '2025-07-15 08:57:19', NULL),
(13, 'Java Fullstack', 'Fullstack Java Developer course including frontend and backend.', 24, 144, 15000.00, 'https://example.com/syllabus/java-fullstack.pdf', '2025-07-15 13:39:06', NULL),
(28, 'Python Development', 'PY-Python Dev Internship', 12, 3, 2000.00, 'www.msbte.in', '2025-07-16 07:52:30', 'PY-Python'),
(29, 'Python Development', 'PY-Python Dev Internship', 12, 3, 2000.00, 'www.msbte.in', '2025-07-16 07:55:39', 'PY-Python'),
(30, 'Python Development', 'PY-Python Dev Internship', 12, 3, 2000.00, 'www.msbte.in', '2025-07-16 07:56:47', 'PY-Python'),
(31, 'Python Development', 'PY-Python Dev Internship', 12, 3, 2000.00, 'www.msbte.in', '2025-07-16 07:57:10', 'PY-Python'),
(32, 'Python Development', 'PY-Python Dev Internship', 12, 3, 2000.00, 'www.msbte.in', '2025-07-16 07:57:20', 'PY-Python'),
(33, 'Python Development', 'PY-Python Dev Internship', 12, 3, 2000.00, 'www.msbte.in', '2025-07-16 07:57:54', 'PY-Python'),
(34, 'Mobile App Development', '', 0, 0, 3000.00, '', '2025-07-21 14:57:47', 'MAD'),
(35, 'Mobile App Development', '', 0, 0, 3000.00, '', '2025-07-21 15:55:58', 'MAD'),
(36, 'Data Analytics ', 'Data Analytics Training Internship', 12, 3, 3000.00, 'https://msbte.ac.in/', '2024-06-02 18:30:00', 'DA');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `name` varchar(200) NOT NULL,
  `mobno` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`name`, `mobno`, `address`, `email`) VALUES
('Abhiram Jadhav', '9029509904', 'Kalyan.(w)', 'rajan@ac.com'),
('Abhiram Jadhav', '9029509904', 'Kalyan.(w)', 'rajan@ac.com'),
('Abhiram Jadhav', '9029509904', 'Kalyan.(w)', 'rajan@ac.com');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL,
  `status` enum('Active','Completed','Dropped') DEFAULT 'Active',
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_id`, `batch_id`, `enrollment_date`, `status`, `remarks`) VALUES
(2, 4, 1, 1, '2019-06-01', 'Active', 'A+'),
(5, 14, 12, 10, '2019-06-03', 'Active', 'A+'),
(11, 31, 28, 18, '2024-06-02', 'Active', NULL),
(12, 32, 29, 19, '2024-06-02', 'Active', NULL),
(13, 33, 30, 20, '2024-06-02', 'Active', NULL),
(14, 34, 31, 21, '2024-06-02', 'Active', NULL),
(15, 35, 32, 22, '2024-06-02', 'Active', NULL),
(16, 36, 33, 23, '2024-06-02', 'Active', NULL),
(18, 102015, 128150, 12, '2024-06-02', '', ''),
(19, 101101, 128150, 10245, '2024-03-02', '', 'Good'),
(20, 0, 0, 0, '0000-00-00', '', ''),
(21, 101108, 128159, 10240, '2024-06-02', 'Active', 'Good'),
(22, 101108, 128159, 10240, '2024-06-02', 'Active', 'Good'),
(23, 101108, 128159, 10240, '2024-06-02', 'Active', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expenses name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date of purchase` date NOT NULL,
  `added on` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expenses name`, `category`, `quantity`, `date of purchase`, `added on`, `price`) VALUES
(3, 'Desktops ', 'Equipment', 20, '2025-08-02', '2025-08-11 15:33:16', 1.15),
(4, 'Laptops ', 'Equipment', 20, '2025-08-02', '2025-08-11 15:33:41', 1.20),
(5, 'Desk', 'Furniture', 2, '2025-08-03', '2025-08-13 10:39:40', 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `Username`, `Password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `total_fees` decimal(10,2) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` enum('Cash','Online','Card') DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount_paid`, `total_fees`, `due_amount`, `payment_method`, `payment_date`, `transaction_id`, `student_id`, `amount`) VALUES
(1, 1000.00, 3000.00, 2000.00, 'Online', '2019-06-01', 'mh-yashwardhan01@okaxis', '', 0.00),
(3, 2000.00, 4000.00, 2000.00, 'Online', '2019-06-02', 'mh-yashwardhan01@okaxis', '', 0.00),
(8, 2000.00, 2000.00, 0.00, 'Online', '2024-06-02', 'mh-yashwardhan01@okaxis', '', 0.00),
(9, 2000.00, 2000.00, 0.00, 'Online', '2024-06-02', 'mh-yashwardhan01@okaxis', '', 0.00),
(10, 2000.00, 2000.00, 0.00, 'Online', '2024-06-02', 'mh-yashwardhan01@okaxis', '', 0.00),
(11, 2000.00, NULL, NULL, 'Online', '2024-06-02', 'mh-yashwardhan01@okaxis', NULL, NULL),
(12, 2000.00, NULL, NULL, 'Online', '2024-06-02', 'mh-yashwardhan01@okaxis', NULL, NULL),
(13, 2000.00, NULL, NULL, 'Online', '2024-06-02', 'mh-yashwardhan01@okaxis', NULL, NULL),
(17, 0.00, 0.00, 0.00, NULL, '2024-06-02', '', '102015', NULL),
(18, NULL, NULL, NULL, '', '2024-06-02', NULL, '102015', 3000.00),
(19, NULL, NULL, NULL, '', '2024-03-02', NULL, '101101', 3000.00),
(20, 3000.00, 3000.00, 0.00, 'Online', '2024-06-02', 'anishpandey@06ok-axis', '101108', 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alternate_phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `education_qualification` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `date_of_birth`, `gender`, `email`, `phone`, `alternate_phone`, `address`, `city`, `state`, `pincode`, `education_qualification`, `occupation`, `registration_date`) VALUES
(1, 'Abhiram Kailas Jadhav ', '2005-08-24', 'Male', 'abhiramjadhav06@gmail.com', '987654321', NULL, '101. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'SSC 10th Passed', '2025-07-14 19:23:26'),
(3, 'Abhiram Kailas Jadhav ', '2005-08-24', 'Male', 'abhiramjadhav06@gmail.com', '987654321', NULL, '101. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'SSC 10th Passed', '2025-07-14 19:29:46'),
(4, 'Abhiram Kailas Jadhav ', '2005-08-24', 'Male', 'abhiramjadhav06@gmail.com', '987654321', NULL, '101. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'SSC 10th Passed', '2025-07-14 19:33:00'),
(14, 'Akash Kailas Jadhav', '2005-09-24', 'Male', 'akashjadhav07@gmail.com', '987654323', NULL, '102. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In IT Engineering', 'HSC 12th Passed', '2025-07-15 08:57:19'),
(31, 'Mangesh Kailas Jadhav', '2005-08-24', 'Male', 'mjadhav06@gmail.com', '987654325', '9878654321', '105. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'HSC 12th Passed', '2025-07-16 07:52:30'),
(32, 'Mangesh Kailas Jadhav', '2005-08-24', 'Male', 'mjadhav06@gmail.com', '987654325', '9878654321', '105. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'HSC 12th Passed', '2025-07-16 07:55:39'),
(33, 'Mangesh Kailas Jadhav', '2005-08-24', 'Male', 'mjadhav06@gmail.com', '987654325', '9878654321', '105. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'HSC 12th Passed', '2025-07-16 07:56:47'),
(34, 'Mangesh Kailas Jadhav', '2005-08-24', 'Male', 'mjadhav06@gmail.com', '987654325', '9878654321', '105. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'HSC 12th Passed', '2025-07-16 07:57:10'),
(35, 'Mangesh Kailas Jadhav', '2005-08-24', 'Male', 'mjadhav06@gmail.com', '987654325', '9878654321', '105. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'HSC 12th Passed', '2025-07-16 07:57:20'),
(36, 'Mangesh Kailas Jadhav', '2005-08-24', 'Male', 'mjadhav06@gmail.com', '987654325', '9878654321', '105. Siddhivinayak Sankul co-op housing society station.rd Kalyan.(w) : 421301.', 'Kalyan ', 'Maharashtra', '421301', 'Diploma In Computer Engineering', 'HSC 12th Passed', '2025-07-16 07:57:54'),
(39, 'Anish Pandey', '1998-04-02', 'Male', 'anishpandey08@gmail.com', '987654329', '9878654320', '201 : Kailas Heights ', 'Kalyan ', 'Maharashtra', '421301', 'Diploma in Computer Engineering ', 'HSC 12th Passed', '2024-02-03 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `full_name`, `email`, `phone`, `qualification`, `specialization`, `joining_date`, `status`) VALUES
(1, 'Avinash Somnath Patil', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Information Technology', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '1999-01-01', 'Active'),
(4, 'Avinash Somnath Patil', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Information Technology', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '2019-06-03', 'Active'),
(11, 'Anil Pandurang Pawar', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Computer Science', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '1999-12-11', 'Active'),
(25, 'Avinash Somnath Patil', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Information Technology', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '1999-01-01', 'Active'),
(26, 'Avinash Somnath Patil', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Information Technology', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '1999-01-01', 'Active'),
(27, 'Avinash Somnath Patil', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Information Technology', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '1999-01-01', 'Active'),
(28, 'Avinash Somnath Patil', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Information Technology', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '1999-01-01', 'Active'),
(29, 'Avinash Somnath Patil', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Information Technology', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '1999-01-01', 'Active'),
(30, 'Avinash Somnath Patil', 'avinashpatil07@gmail.com', '8352919033', 'Masters In Information Technology', 'Delivering professional training in Web Development (HTML, CSS, JavaScript, PHP)  Backend developmen', '1999-01-01', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `batch_code_2` (`batch_code`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
