-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 01, 2023 at 01:40 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', '$2y$10$fCOiMky4n5hCJx3cpsG20Od4wHtlkCLKmO6VLobJNRIg9ooHTkgjK', 'Admin', '1', 'foto1.png', '2018-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL,
  `date` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `status` int NOT NULL,
  `status_in` enum('in','ijin','sakit','cuti','no') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'in',
  `time_out` time DEFAULT '00:00:00',
  `num_hr` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `status_in`, `time_out`, `num_hr`) VALUES
(75, 3, '2018-04-18', '08:00:00', 1, 'in', '17:00:00', 8),
(76, 4, '2018-04-19', '08:00:00', 1, 'in', '17:00:00', 8),
(77, 4, '2018-04-27', '08:00:00', 1, 'in', '17:00:00', 7),
(78, 4, '2018-04-28', '08:00:00', 1, 'in', '17:00:00', 8),
(79, 4, '2018-05-01', '08:30:00', 1, 'in', '17:00:00', 8),
(80, 4, '2018-05-03', '08:00:00', 1, 'in', '17:00:00', 0),
(81, 4, '2018-05-05', '08:00:00', 1, 'in', '17:00:00', 9),
(83, 4, '2018-05-31', '12:00:00', 0, 'in', '18:00:00', 5),
(84, 4, '2018-05-18', '08:00:00', 1, 'in', '17:00:00', 7),
(85, 4, '2018-05-09', '09:00:00', 1, 'in', '18:00:00', 8),
(86, 5, '2018-07-11', '07:41:00', 1, 'in', '16:00:00', 7),
(88, 6, '2018-07-11', '07:45:00', 1, 'in', '14:48:00', 3.8),
(89, 7, '2018-07-11', '07:56:00', 1, 'in', '17:00:00', 8),
(90, 8, '2018-07-11', '06:05:12', 1, 'in', '16:00:00', 7),
(91, 9, '2018-07-11', '18:12:06', 0, 'in', '00:00:00', 0),
(92, 10, '2018-07-11', '18:13:01', 0, 'in', '00:00:00', 0),
(93, 11, '2018-07-11', '18:14:30', 0, 'in', '00:00:00', 0),
(94, 12, '2018-07-11', '18:16:14', 0, 'in', '00:00:00', 0),
(95, 13, '2018-07-11', '18:17:32', 0, 'in', '00:00:00', 0),
(96, 14, '2018-07-11', '18:18:33', 0, 'in', '00:00:00', 0),
(97, 15, '2018-07-11', '18:19:26', 0, 'in', '00:00:00', 0),
(98, 16, '2018-07-11', '18:20:26', 0, 'in', '00:00:00', 0),
(99, 17, '2018-07-11', '18:21:41', 0, 'in', '00:00:00', 0),
(100, 18, '2018-07-12', '23:46:31', 1, 'in', '00:00:00', 0),
(101, 19, '2018-07-12', '23:50:28', 1, 'in', '00:00:00', 0),
(102, 20, '2018-07-12', '23:52:48', 1, 'in', '00:00:00', 0),
(103, 21, '2018-07-12', '23:54:50', 1, 'in', '00:00:00', 0),
(104, 22, '2018-07-12', '23:56:02', 1, 'in', '00:00:00', 0),
(105, 23, '2018-07-12', '13:57:00', 0, 'in', '00:00:00', 12.95),
(108, 3, '2023-08-13', '21:36:54', 0, 'in', NULL, 0),
(109, 20, '2023-08-14', '09:31:37', 1, 'in', NULL, 0),
(114, 23, '2023-08-14', '12:27:26', 0, 'ijin', '12:28:13', 0),
(118, 23, '2023-08-17', '08:00:00', 1, 'cuti', '17:00:00', 8),
(119, 23, '2023-08-18', '08:00:00', 1, 'cuti', '17:00:00', 8),
(120, 13, '2023-08-19', '08:04:33', 1, 'in', '08:04:37', 0.91666666666667),
(121, 23, '2023-08-19', '08:00:00', 1, 'in', '20:00:00', 8),
(122, 18, '2023-08-19', '08:00:00', 1, 'in', '08:00:00', 0),
(123, 15, '2023-08-19', '08:09:54', 1, 'in', '08:10:09', 0.81666666666667),
(124, 24, '2023-08-19', '08:00:00', 1, 'cuti', '17:00:00', 8),
(125, 24, '2023-08-20', '08:00:00', 1, 'cuti', '17:00:00', 8),
(126, 19, '2023-08-19', '10:00:00', 0, 'in', '10:01:00', 0.016666666666667),
(127, 21, '2023-08-19', '10:14:26', 0, 'in', '10:14:43', 0),
(129, 31, '2023-08-31', '08:00:00', 1, 'cuti', '17:00:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tidakhadir`
--

CREATE TABLE `attendance_tidakhadir` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL,
  `date` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `status` int NOT NULL,
  `status_in` enum('in','ijin','sakit','cuti','no') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'in',
  `time_out` time DEFAULT '00:00:00',
  `num_hr` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_tidakhadir`
--

INSERT INTO `attendance_tidakhadir` (`id`, `employee_id`, `date`, `time_in`, `status`, `status_in`, `time_out`, `num_hr`) VALUES
(1, 3, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(2, 4, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(3, 5, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(4, 6, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(5, 7, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(6, 8, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(7, 9, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(8, 10, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(9, 11, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(10, 12, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(11, 13, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(12, 14, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(13, 15, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(14, 16, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(15, 17, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(16, 18, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(17, 19, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(18, 20, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(19, 21, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(20, 22, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(21, 23, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(22, 24, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(23, 28, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(24, 29, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(25, 30, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(26, 31, '2023-09-01', NULL, 0, 'no', '00:00:00', 0),
(27, 32, '2023-09-01', NULL, 0, 'no', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashadvance`
--

INSERT INTO `cashadvance` (`id`, `date_advance`, `employee_id`, `amount`) VALUES
(4, '2023-07-12', '5', 3500);

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `description`, `amount`) VALUES
(1, 'SSS', 100),
(2, 'Pagibig', 150),
(3, 'PhilHealth', 150),
(4, 'Project Issues', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `password` varchar(100) DEFAULT 'password',
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position_id` int NOT NULL,
  `schedule_id` int NOT NULL,
  `photo` varchar(200) NOT NULL,
  `role` enum('employee','admin') DEFAULT 'employee',
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `jatah_cuti` int DEFAULT '21',
  `max_payment` varchar(50) NOT NULL DEFAULT '5000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `password`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `role`, `created_on`, `jatah_cuti`, `max_payment`) VALUES
(3, 'DYE473869250', 'password', 'Julyn', 'Divinagracia', 'E.B. Magalona', '1992-05-02', '09123456789', 'Female', 2, 2, '', 'employee', '2018-04-30 00:00:00', 21, '5000000'),
(4, 'JIE625973480', 'password', 'Gemalyn', 'Cepe', 'Carmen, Bohol', '1995-10-02', '09468029840', 'Female', 2, 3, '', 'employee', '2018-04-30 00:00:00', 21, '5000000'),
(5, 'TQO238109674', 'password', 'Bruno', 'Den', 'Test', '1995-08-23', '5454578965', 'Male', 1, 2, 'thanossmile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(6, 'EDQ203874591', 'password', 'Henry', 'Doe', 'New St. Esp', '1991-07-25', '9876543210', 'Male', 2, 4, 'male.png', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(7, 'TWY781946302', 'password', 'Johnny', 'Jr', 'Esp', '1995-07-11', '8467067344', 'Male', 1, 2, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(8, 'GWZ071342865', 'password', 'Tonny', 'Jr', 'Esp 12 South Street', '1994-07-19', '9876543210', 'Male', 1, 2, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(9, 'HEL079321846', 'password', 'Jacob', 'Carter', 'St12 N1', '1995-07-18', '5454578965', 'Male', 1, 2, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(10, 'OCN273564901', 'password', 'Benjamin', 'Cohen', 'TEST', '1991-07-25', '78548852145', 'Male', 2, 3, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(11, 'PGX413705682', 'password', 'Ethan', 'Carson', 'DEMO', '1994-07-19', '8467067344', 'Male', 1, 2, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(12, 'YWX536478912', 'password', 'Daniel', 'Cooper', 'Test', '1995-07-11', '9876543210', 'Male', 2, 4, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(13, 'ALB590623481', 'password', 'Emma', 'Wallis', 'Test', '1994-07-19', '9632145655', 'Female', 1, 3, 'female4.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(14, 'IOV153842976', 'password', 'Sophia', 'Maguire', 'Test', '1995-07-11', '5454578965', 'Female', 2, 2, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(15, 'CAB835624170', 'password', 'Mia', 'Hollister', 'Test', '1995-07-18', '9632145655', 'Female', 2, 3, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(16, 'MGZ312906745', 'password', 'Emily', 'JK', 'Test', '1996-07-24', '9876543210', 'Female', 2, 3, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(17, 'HSP067892134', 'password', 'Nakia', 'Grey', 'Test', '1995-10-24', '8467067344', 'Female', 1, 2, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(18, 'BVH081749563', 'password', 'Dave', 'Cruze', 'Demo', '1990-01-02', '5454578965', 'Male', 2, 2, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(19, 'ZTC714069832', 'password', 'Logan', 'Paul', 'Esp 16', '1994-12-30', '0202121255', 'Male', 1, 1, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(20, 'VFT157620348', 'password', 'Jack', 'Adler', 'Test', '1991-07-25', '6545698880', 'Male', 1, 4, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(21, 'XRF342608719', 'password', 'Mason', 'Beckett', 'Demo', '1996-07-24', '8467067344', 'Male', 2, 1, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 1, '5000000'),
(22, 'LVO541238690', 'password', 'Lucas', 'Cooper', 'Demo', '1995-07-18', '9632145655', 'Male', 2, 1, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(23, 'AEI036154829', 'password', 'Alex', 'Cohen', 'Demo', '1995-08-23', '9632145655', 'Male', 1, 2, 'profile.jpg', 'employee', '2018-07-11 00:00:00', 21, '5000000'),
(24, '18082023001', 'password', 'Test', '123', '123', '1996-02-28', '123', 'Male', 1, 2, '', 'employee', '2023-08-18 00:00:00', 12, '5000000'),
(28, '18082023002', 'password', 'Febri', 'Kukuh Santoso', 'asdas', '2023-08-17', '12', 'Male', 1, 2, '', 'employee', '2023-08-18 13:43:00', 3, '5000000'),
(29, '18082023003', 'password', 'Test3', 'asd', 'asd', '2023-08-29', '12', 'Male', 2, 1, '', 'employee', '2023-08-18 13:48:59', 21, '5000000'),
(30, '18082023004', 'password', 'Emerson', 'Roth', 'Ex cupidatat est eo', '2023-08-16', 'Commodi dolores est ', 'Male', 1, 4, '', 'employee', '2023-08-19 09:28:44', 1, '5000000'),
(31, '123456789', 'password', 'Admin', 'Admin', 'E.B. Magalona', '1992-05-02', '09123456789', 'Female', 2, 2, '', 'admin', '2018-04-30 00:00:00', 21, '10000'),
(32, '18082023005', 'password', 'Zelda', 'Patrick', 'Dolor ipsam tempora ', '2023-08-09', 'Asperiores expedita ', 'Female', 1, 4, '', 'employee', '2023-08-31 22:17:42', 21, '20000');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_id`, `start_date`, `end_date`, `status`, `keterangan`) VALUES
(1, 19, '2018-09-25', '2018-09-26', 'rejected', 'Impedit delectus v'),
(2, 21, '2023-01-10', '2023-01-12', 'approved', 'Et labore atque quas'),
(6, 23, '2023-08-17', '2023-08-18', 'approved', 'A'),
(7, 15, '2023-08-19', '2023-08-21', 'pending', 'Testt'),
(8, 24, '2023-08-19', '2023-08-20', 'approved', '213123'),
(10, 31, '2023-08-31', '2023-08-31', 'approved', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `employee_id`, `hours`, `rate`, `date_overtime`) VALUES
(4, '6', 240, 1500, '2031-11-08'),
(5, '4', 283.33333333333, 3600, '2018-06-05'),
(6, '28', 12.2, 12, '2023-08-07'),
(7, '28', 1.2, 15000, '2023-08-18'),
(8, '20', 1.2, 12000, '2023-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `rate`) VALUES
(1, 'Programmer', 100),
(2, 'Writer', 50),
(3, 'Marketing ', 35),
(4, 'Graphic Designer', 75);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`) VALUES
(1, '07:00:00', '16:00:00'),
(2, '08:00:00', '17:00:00'),
(3, '09:00:00', '18:00:00'),
(4, '10:00:00', '19:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_tidakhadir`
--
ALTER TABLE `attendance_tidakhadir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `attendance_tidakhadir`
--
ALTER TABLE `attendance_tidakhadir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
