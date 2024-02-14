-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2023 at 01:04 PM
-- Server version: 5.7.44-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ispscta6_db_enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `enrollment_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `sy_id` int(11) DEFAULT NULL,
  `month_id` int(11) DEFAULT NULL,
  `schoolDays` varchar(100) DEFAULT NULL,
  `daysPresent` varchar(100) DEFAULT NULL,
  `daysAbsent` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrollment`
--

CREATE TABLE `tbl_enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `grade_level_id` int(11) DEFAULT NULL,
  `sy_id` int(11) DEFAULT NULL,
  `date_of_enrollment` date DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `faculty_id` int(11) NOT NULL,
  `honorifics` varchar(11) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `userType` varchar(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1=active 0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`faculty_id`, `honorifics`, `fname`, `mname`, `lname`, `gender`, `title`, `position`, `birthdate`, `email`, `username`, `password`, `image`, `userType`, `status`) VALUES
(1, 'Mr.', 'admin', 'admin', 'admin', 'Male', 'MIT', 'Principal', '2023-05-02', 'admin@gmail.com', 'admin', 'admin12345', 'wallpaperflare.com_wallpaper.jpg', 'admin', 0),
(14, 'Mr.', 'zet', 'tudyan', 'ortiz', 'Male', 'wen', 'Instructor I', '1999-01-06', 'ortizzet1@gmail.comn', 'zetzet', '123456789', NULL, 'faculty', 0),
(15, '', 'zet', 'tudayan', 'ortiz', 'Male', '', 'Instructor I', '1998-01-17', 'zetortiz23@gmail.com', 'zetong', 'zet0000', NULL, 'faculty', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade`
--

CREATE TABLE `tbl_grade` (
  `grade_id` int(11) NOT NULL,
  `enrollment_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_subject_id` int(11) DEFAULT NULL,
  `offered_subject_id` int(11) DEFAULT NULL,
  `sy_id` int(11) DEFAULT NULL,
  `firstQ` varchar(100) DEFAULT NULL,
  `secondQ` varchar(100) DEFAULT NULL,
  `thirdQ` varchar(100) DEFAULT NULL,
  `fourthQ` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_level`
--

CREATE TABLE `tbl_grade_level` (
  `grade_level_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `grade_level` varchar(20) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `grade_level_section` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_grade_level`
--

INSERT INTO `tbl_grade_level` (`grade_level_id`, `faculty_id`, `grade_level`, `section`, `grade_level_section`, `status`) VALUES
(1, 7, 'Grade 7', 'z', 'Grade 7 - z', 1),
(2, 8, 'Grade 8', 'x', 'Grade 8 - x', 1),
(3, 10, 'Grade 9', 'y', 'Grade 9 - y', 1),
(4, 11, 'Grade 10', 'f', 'Grade 10 - f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_month`
--

CREATE TABLE `tbl_month` (
  `month_id` int(10) NOT NULL,
  `sy_id` int(11) DEFAULT '1',
  `month` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_month`
--

INSERT INTO `tbl_month` (`month_id`, `sy_id`, `month`) VALUES
(1, 1, 'JANUARY'),
(2, 1, 'FEBRUARY'),
(3, 1, 'MARCH'),
(4, 1, 'APRIL'),
(5, 1, 'MAY'),
(6, 1, 'JUNE'),
(7, 1, 'JULY'),
(8, 1, 'AUGUST'),
(9, 1, 'SEPTEMBER'),
(10, 1, 'OCTOBER'),
(11, 1, 'NOVEMBER'),
(12, 1, 'DECEMBER');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offered_subject`
--

CREATE TABLE `tbl_offered_subject` (
  `offered_subject_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_level_id` int(11) DEFAULT NULL,
  `sy_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_offered_subject`
--

INSERT INTO `tbl_offered_subject` (`offered_subject_id`, `faculty_id`, `subject_id`, `grade_level_id`, `sy_id`, `status`) VALUES
(17, 15, 2, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `lrn` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `lrn`, `fname`, `mname`, `lname`, `extension`, `gender`, `birthdate`, `status`) VALUES
(14, '1', 'Jeremy ', 'Torquato', 'Del Rosario', 'Jr.', 'Male', '2006-07-28', 1),
(15, '2', 'Zet', 'Cheta-e ', 'Lapid ', '', 'Male', '2007-01-28', 1),
(16, '3', 'Raphael', 'Salswet', 'Manding', '', 'Male', '2004-02-28', 1),
(17, '4', 'Frederick', 'Salswet', 'Manding', 'Sr.', 'Male', '2006-08-28', 1),
(18, '5', 'Marchie', 'Angkwan', 'Balandino', 'Sr.', 'Male', '2003-03-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_subject`
--

CREATE TABLE `tbl_student_subject` (
  `student_subject_id` int(11) NOT NULL,
  `enrollment_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `offered_subject_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subject_id`, `subject_name`, `status`) VALUES
(1, 'English', 1),
(2, 'Filipino', 1),
(3, 'Mathematics', 1),
(4, 'Science', 1),
(5, 'Araling Panlipunan', 1),
(6, 'Music', 1),
(7, 'Arts', 1),
(8, 'Physical Education', 1),
(9, 'Health', 1),
(10, 'Technology and Livelihood Education', 1),
(11, 'Values Education', 1),
(12, 'Christian Living Education', 1),
(13, 'Computer Education', 1),
(14, 'Introduction to Computing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sy`
--

CREATE TABLE `tbl_sy` (
  `sy_id` int(11) NOT NULL,
  `sy` varchar(50) DEFAULT NULL,
  `firstQ_status` int(11) DEFAULT '1',
  `secondQ_status` int(11) DEFAULT '1',
  `thirdQ_status` int(11) DEFAULT '1',
  `fourthQ_status` int(11) DEFAULT '1',
  `sy_status` int(11) DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sy`
--

INSERT INTO `tbl_sy` (`sy_id`, `sy`, `firstQ_status`, `secondQ_status`, `thirdQ_status`, `fourthQ_status`, `sy_status`) VALUES
(1, '2022-2023', 1, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `tbl_grade_level`
--
ALTER TABLE `tbl_grade_level`
  ADD PRIMARY KEY (`grade_level_id`);

--
-- Indexes for table `tbl_month`
--
ALTER TABLE `tbl_month`
  ADD PRIMARY KEY (`month_id`);

--
-- Indexes for table `tbl_offered_subject`
--
ALTER TABLE `tbl_offered_subject`
  ADD PRIMARY KEY (`offered_subject_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_student_subject`
--
ALTER TABLE `tbl_student_subject`
  ADD PRIMARY KEY (`student_subject_id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `tbl_sy`
--
ALTER TABLE `tbl_sy`
  ADD PRIMARY KEY (`sy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `tbl_grade_level`
--
ALTER TABLE `tbl_grade_level`
  MODIFY `grade_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_month`
--
ALTER TABLE `tbl_month`
  MODIFY `month_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_offered_subject`
--
ALTER TABLE `tbl_offered_subject`
  MODIFY `offered_subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
