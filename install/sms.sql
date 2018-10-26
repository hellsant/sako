-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2015 at 09:08 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ins`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_branch`
--

CREATE TABLE IF NOT EXISTS `tbl_add_branch` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `b_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `b_contact_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `b_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `b_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_add_branch`
--

INSERT INTO `tbl_add_branch` (`bid`, `b_name`, `b_email`, `b_contact_no`, `b_address`, `b_status`, `created_date`) VALUES
(1, 'Mirpur', 'mirpur@gmail.com', 'mirpur@gmail.com', 'Dhaka', 'enable', '2015-08-26 11:49:01'),
(3, 'Motijil', 'motijio@gmail.com', '01912365478', 'Dhaka', 'disable', '2015-08-26 11:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_class`
--

CREATE TABLE IF NOT EXISTS `tbl_add_class` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `c_numeric` int(11) NOT NULL,
  `c_teacher` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `c_note` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_add_class`
--

INSERT INTO `tbl_add_class` (`c_id`, `c_name`, `c_numeric`, `c_teacher`, `c_note`, `created_date`) VALUES
(1, 'One', 1, 'John Sina', 'This is Class One...', '2015-07-07 06:51:46'),
(2, 'Two', 2, 'Rubel Hossain', 'This is Class Two...', '2015-07-07 09:09:00'),
(3, 'Three', 3, 'Rubel Hossain', 'This is Class Three...', '2015-07-07 09:24:55'),
(4, 'Four', 4, 'Rubel Hossain', 'This is Class Four...', '2015-07-07 09:25:39'),
(5, 'Five', 5, 'Kamal Ahmed', 'This is Class Five...', '2015-07-07 09:26:07'),
(6, 'Six', 6, 'Kamal Uddin', 'This is Class Six...', '2015-07-07 09:26:33'),
(7, 'Seven', 7, 'Rubel Hossain', 'This is Class Seven...', '2015-07-07 09:27:07'),
(8, 'Eight', 8, 'Kamal Ahmed', 'This is Class Eight...', '2015-07-07 09:30:50'),
(9, 'Nine', 9, 'Kamal Uddin', 'This is Class Nine...', '2015-07-07 09:31:14'),
(10, 'Ten', 10, 'Rubel Hossain', 'This is Class Ten...', '2015-07-07 09:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_designation`
--

CREATE TABLE IF NOT EXISTS `tbl_add_designation` (
  `designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_add_designation`
--

INSERT INTO `tbl_add_designation` (`designation_id`, `designation_name`, `created_date`) VALUES
(1, 'Senior Teacher', '2015-07-06 08:11:58'),
(2, 'Principal', '2015-07-06 08:13:03'),
(4, 'Librarian', '2015-07-06 08:13:34'),
(5, 'Accountant', '2015-07-06 08:13:43'),
(6, 'Junior Teacher', '2015-10-05 09:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_employee_salary`
--

CREATE TABLE IF NOT EXISTS `tbl_add_employee_salary` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_name` int(11) NOT NULL,
  `e_month` int(11) NOT NULL,
  `e_pay_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `e_amount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_add_employee_salary`
--

INSERT INTO `tbl_add_employee_salary` (`e_id`, `e_name`, `e_month`, `e_pay_date`, `e_amount`, `created_date`) VALUES
(4, 4, 1, '09/08/2015', '12000', '2015-09-08 06:27:27'),
(5, 4, 2, '09/08/2015', '12000', '2015-09-08 06:27:43'),
(6, 1, 1, '09/08/2015', '20000', '2015-09-08 06:27:57'),
(7, 1, 2, '09/08/2015', '10000', '2015-09-08 06:28:09'),
(8, 4, 6, '09/08/2015', '12000', '2015-09-08 07:24:45'),
(10, 4, 12, '10/11/2015', '12000', '2015-10-11 09:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_exam_date`
--

CREATE TABLE IF NOT EXISTS `tbl_add_exam_date` (
  `ex_id` int(11) NOT NULL AUTO_INCREMENT,
  `ex_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ex_class_id` int(11) NOT NULL,
  `ex_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ex_note` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ex_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_add_exam_date`
--

INSERT INTO `tbl_add_exam_date` (`ex_id`, `ex_name`, `ex_class_id`, `ex_date`, `ex_note`, `created_date`) VALUES
(15, '1', 1, '01/07/2015', 'This is First Terminal Exm.', '2015-07-13 06:56:12'),
(16, '2', 1, '01/07/2015', 'This is 2nd Terminal Exm...', '2015-07-13 06:57:05'),
(17, '3', 1, '03/07/2015', 'This is Final Exm...', '2015-07-13 06:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_exam_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_add_exam_schedule` (
  `es_id` int(11) NOT NULL AUTO_INCREMENT,
  `es_term_id` int(11) NOT NULL,
  `es_class_id` int(11) NOT NULL,
  `es_subject_id` int(11) NOT NULL,
  `es_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `es_start_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `es_end_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `es_room_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`es_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_add_exam_schedule`
--

INSERT INTO `tbl_add_exam_schedule` (`es_id`, `es_term_id`, `es_class_id`, `es_subject_id`, `es_date`, `es_start_time`, `es_end_time`, `es_room_no`, `created_date`) VALUES
(1, 1, 1, 3, '01/07/2015', '10:20 AM', '1:00 PM', '201', '2015-07-13 06:32:57'),
(2, 1, 1, 11, '01/07/2015', '10:20 AM', '1:00 PM', '201', '2015-07-13 06:58:58'),
(3, 2, 1, 4, '07/07/2015', '10:20 AM', '1:00 PM', '203', '2015-07-13 06:59:38'),
(4, 3, 1, 10, '14/07/2015', '10:20 AM', '1:00 PM', '205', '2015-07-13 06:59:59'),
(5, 1, 5, 23, '09/30/2015', '10:25 PM', '3:25 AM', '502', '2015-09-26 15:58:16'),
(6, 1, 5, 8, '09/09/2015', '10:30 PM', '3:25 AM', '201', '2015-09-26 16:22:10'),
(7, 1, 1, 27, '10/01/2015', '10.00 AM', '12.00 PM', '102', '2015-10-18 09:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_expense`
--

CREATE TABLE IF NOT EXISTS `tbl_add_expense` (
  `ex_id` int(11) NOT NULL AUTO_INCREMENT,
  `ex_issue` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ex_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ex_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `ex_note` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ex_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_add_expense`
--

INSERT INTO `tbl_add_expense` (`ex_id`, `ex_issue`, `ex_date`, `ex_amount`, `ex_note`, `created_date`) VALUES
(2, 'Laptop', '08/20/2015', 20000.00, 'Laptop for Lab....', '2015-08-20 05:56:24'),
(3, 'Table', '10/11/2015', 4000.00, 'This is table for reception', '2015-10-11 10:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_fee_set`
--

CREATE TABLE IF NOT EXISTS `tbl_add_fee_set` (
  `fs_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name_id` int(11) NOT NULL,
  `f_type_id` int(11) NOT NULL,
  `f_fee` decimal(15,2) NOT NULL DEFAULT '0.00',
  `f_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `f_fine` decimal(15,2) NOT NULL DEFAULT '0.00',
  `fine_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_add_fee_set`
--

INSERT INTO `tbl_add_fee_set` (`fs_id`, `class_name_id`, `f_type_id`, `f_fee`, `f_date`, `f_fine`, `fine_date`, `created_date`) VALUES
(9, 1, 2, 1200.00, '09/07/2015', 20.00, '10/11/2015', '2015-09-07 12:53:49'),
(10, 1, 5, 200.00, '10/11/2015', 0.00, '10/20/2015', '2015-10-11 09:59:56'),
(11, 0, 0, 0.00, '', 0.00, '', '2015-10-11 10:02:23'),
(12, 5, 11, 5000.00, '10/11/2015', 0.00, '10/31/2015', '2015-10-11 10:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_fee_type`
--

CREATE TABLE IF NOT EXISTS `tbl_add_fee_type` (
  `ft_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fee_note` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ft_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_add_fee_type`
--

INSERT INTO `tbl_add_fee_type` (`ft_id`, `fee_type`, `fee_note`, `created_date`) VALUES
(2, 'Admission Fee', 'This is admission fee..', '2015-08-19 09:32:16'),
(5, 'Sports Fee ', 'This is Sports Fee...', '2015-08-20 06:47:53'),
(6, 'Cultural Club Fee ', 'This is Cultural Club Fee....', '2015-08-20 06:48:06'),
(7, ' 	Registration Fee ', '', '2015-08-20 06:48:16'),
(8, 'Form & Late Fee ', '', '2015-08-20 06:48:25'),
(9, 'Transcript Fee ', '', '2015-08-20 06:48:37'),
(10, 'Retake Fee ', '', '2015-08-20 06:48:49'),
(11, 'Others ', 'This is Others...', '2015-08-20 06:49:09'),
(12, 'Tution Fee', 'This is tution fee....', '2015-10-11 09:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_fine`
--

CREATE TABLE IF NOT EXISTS `tbl_add_fine` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fday` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fmonth` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fyear` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_add_fine`
--

INSERT INTO `tbl_add_fine` (`fid`, `fday`, `fmonth`, `fyear`, `created_date`) VALUES
(1, '5', 'September', '2015', '2015-09-01 08:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_grade`
--

CREATE TABLE IF NOT EXISTS `tbl_add_grade` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `g_point` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `g_from` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `g_upto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `g_note` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_add_grade`
--

INSERT INTO `tbl_add_grade` (`g_id`, `g_name`, `g_point`, `g_from`, `g_upto`, `g_note`, `created_date`) VALUES
(1, 'A+', '5.00', '80', '100', 'This is A Plus.', '2015-07-09 05:37:47'),
(5, 'A', '4.00', '60', '79', 'This is A Grade.', '2015-07-09 05:55:05'),
(6, 'A-', '3.50', '50', '59', 'This is A Minus.', '2015-07-09 05:55:57'),
(7, 'F', '0.00', '00', '32', 'This is F Grade.', '2015-07-09 05:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_hostel`
--

CREATE TABLE IF NOT EXISTS `tbl_add_hostel` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `h_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `h_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `h_note` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_add_hostel`
--

INSERT INTO `tbl_add_hostel` (`h_id`, `h_name`, `h_address`, `h_type`, `h_note`, `created_date`) VALUES
(1, 'Sher-e-Bangla', 'Chittagong College,Chittagong.', 'Boys', 'This is test', '2015-07-15 06:14:48'),
(2, 'Shorowardi', 'Chittagong College', 'Girls', 'This is Boys Hostel...', '2015-07-15 06:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_hostel_member`
--

CREATE TABLE IF NOT EXISTS `tbl_add_hostel_member` (
  `hmid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `hostel_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `hostel_category` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hmid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_add_hostel_member`
--

INSERT INTO `tbl_add_hostel_member` (`hmid`, `sid`, `cid`, `hostel_name`, `hostel_category`, `added_date`) VALUES
(14, 24, 3, '1', 'First Class', '2015-10-15 12:47:45'),
(15, 20, 1, '2', 'First Class', '2015-10-17 09:58:44'),
(16, 25, 2, '1', 'First Class', '2015-10-18 12:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_month`
--

CREATE TABLE IF NOT EXISTS `tbl_add_month` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_add_month`
--

INSERT INTO `tbl_add_month` (`mid`, `m_name`, `added_date`) VALUES
(1, 'January', '2015-09-08 06:46:57'),
(2, 'February', '2015-09-08 06:47:19'),
(3, 'March', '2015-09-08 06:47:28'),
(4, 'April', '2015-09-08 06:48:01'),
(5, 'May', '2015-09-08 06:48:10'),
(6, 'June', '2015-09-08 06:48:19'),
(7, 'July', '2015-09-08 06:48:27'),
(8, 'August', '2015-09-08 06:48:36'),
(9, 'September', '2015-09-08 06:48:53'),
(10, 'October', '2015-09-08 06:49:01'),
(11, 'November', '2015-09-08 06:49:10'),
(12, 'December', '2015-09-08 06:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_notice`
--

CREATE TABLE IF NOT EXISTS `tbl_add_notice` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `n_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `notice` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_add_notice`
--

INSERT INTO `tbl_add_notice` (`n_id`, `n_title`, `date`, `permission`, `notice`, `created_date`) VALUES
(3, 'special day', '08/06/2015', 'everyone', 'sgdhsg dhsgd shdgshd shdg shdghsd hsdgshdg shd shd shdghsdg shdghs dghsdgshd shdgsh dghsdgsh dgshd ghsdghsdghsdgshdgshdgsh dhsdgsh dhsgdhsdghsdgshd', '2015-08-23 06:53:09'),
(4, 'Eid Fastible', '08/11/2015', 'teacher', 'Yes GReat sjdhs djs djsh djshd jshdjs djs djs hdjshdjshdjshdjs kdfdkfdf  kdfjdkfjdkfd jdkfdkf kdfjdkfd dkfjdkfjd kdfdkf dkfdkf jkdfjkdfjdkf dkfjdkfjd dkfjdfkdjf  djshd jsdhjs djsdh jshdjsdhjshd sjdhsjdhsjdhjsdhsjd', '2015-08-24 09:52:35'),
(5, 'Durga Puza Fastival', '10/10/2015', 'student', 'School closed for 10 days...\r\nEvery student attend their class from opening date...', '2015-10-04 08:54:14'),
(6, 'Durga Puza', '10/11/2015', 'accountant', 'This is Accountant Notice....kdfjdkfjdkfjdlkfjdkfj', '2015-10-11 11:10:05'),
(7, 'Test', '10/18/2015', 'parent', 'This is only for parents......', '2015-10-18 12:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_parent`
--

CREATE TABLE IF NOT EXISTS `tbl_add_parent` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_guardian` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_father_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_father_profession` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_mother_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_mother_profession` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_contact` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `n_card` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `p_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `p_religion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_profile_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_add_parent`
--

INSERT INTO `tbl_add_parent` (`p_id`, `p_guardian`, `p_father_name`, `p_father_profession`, `p_mother_name`, `p_mother_profession`, `p_email`, `p_contact`, `n_card`, `p_address`, `p_religion`, `p_image`, `p_profile_name`, `p_password`, `created_date`) VALUES
(4, 'Jamal Uddin', 'Abdul Kader', 'Business', 'Jorina Khatun', 'House Wife', 'jamal@gmail.com', '018152365478', '', 'Dhaka', 'Islam', '93673561e3ede0ff95.png', 'jamal', '123456', '2015-10-14 11:39:10'),
(5, 'Kamal', 'Rakibul Hasan', 'Doctor', 'Hena', 'House Wife', 'rakib@yahoo.com', '12121212121', '', 'Dhaka , Kazipara', 'Islam', '419505624a9408bb69.jpg', 'Rakib', '123456', '2015-10-19 08:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_routine`
--

CREATE TABLE IF NOT EXISTS `tbl_add_routine` (
  `routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_class_id` int(11) NOT NULL,
  `r_subject_id` int(11) NOT NULL,
  `routine_day` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `routine_time_start` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `start_am_pm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `routine_time_end` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `end_am_pm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `routine_room` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`routine_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tbl_add_routine`
--

INSERT INTO `tbl_add_routine` (`routine_id`, `r_class_id`, `r_subject_id`, `routine_day`, `routine_time_start`, `start_am_pm`, `routine_time_end`, `end_am_pm`, `routine_room`, `created_date`) VALUES
(10, 1, 11, 'tuesday', '9.00', 'AM', '10.00', 'AM', '105', '2015-08-31 05:16:16'),
(11, 1, 11, 'saturday', '2.00', 'PM', '3.00', 'PM', '106', '2015-08-31 06:07:53'),
(12, 1, 3, 'sunday', '9.00', 'AM', '10.00', 'AM', '105', '2015-08-31 06:08:46'),
(13, 1, 4, 'sunday', '11.00', 'AM', '12.00', 'PM', '105', '2015-08-31 06:09:11'),
(14, 1, 10, 'sunday', '12.00', 'PM', '1.00', 'PM', '105', '2015-08-31 06:09:42'),
(15, 1, 11, 'sunday', '2.00', 'PM', '3.00', 'PM', '502', '2015-08-31 06:10:06'),
(16, 1, 3, 'monday', '9.00', 'AM', '10.00', 'AM', '105', '2015-08-31 06:10:28'),
(17, 1, 4, 'monday', '10.00', 'AM', '11.00', 'AM', '106', '2015-08-31 06:10:52'),
(18, 3, 19, 'saturday', '9.00', 'AM', '10.00', 'AM', '106', '2015-08-31 06:12:35'),
(19, 2, 16, 'saturday', '9.00', 'AM', '10.00', 'AM', '106', '2015-08-31 06:14:21'),
(20, 1, 3, 'saturday', '3.00', 'PM', '4.00', 'PM', '105', '2015-08-31 06:28:08'),
(21, 1, 3, 'saturday', '4.00', 'PM', '5.00', 'PM', '501', '2015-08-31 06:28:52'),
(22, 1, 10, 'saturday', '9.00', 'AM', '10.00', 'AM', '105', '2015-08-31 12:16:02'),
(23, 1, 11, 'saturday', '11.00', 'AM', '12.00', 'PM', '501', '2015-08-31 12:17:04'),
(24, 5, 23, 'saturday', '10.00', 'AM', '11.00', 'AM', '501', '2015-10-04 06:01:34'),
(25, 5, 8, 'saturday', '11.15', 'AM', '12.15', 'AM', '501', '2015-10-04 06:02:06'),
(26, 5, 23, 'sunday', '10.00', 'AM', '11.00', 'AM', '501', '2015-10-04 06:02:22'),
(27, 5, 8, 'sunday', '11.15', 'AM', '12.15', 'AM', '501', '2015-10-04 06:02:35'),
(28, 1, 27, 'saturday', '10:00', 'AM', '11:00', 'AM', '101', '2015-10-18 10:58:07'),
(29, 1, 27, 'sunday', '10:00', 'AM', '11:00', 'AM', '101', '2015-10-18 10:58:25'),
(30, 1, 27, 'monday', '10:00', 'AM', '11:00', 'AM', '101', '2015-10-18 10:58:38'),
(31, 1, 27, 'tuesday', '10:00', 'AM', '11:00', 'AM', '101', '2015-10-18 10:58:51'),
(32, 1, 27, 'saturday', '12:30', 'AM', '3:30', 'AM', '502', '2015-10-19 14:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_school`
--

CREATE TABLE IF NOT EXISTS `tbl_add_school` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `s_image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_add_school`
--

INSERT INTO `tbl_add_school` (`school_id`, `st_title`, `email`, `contact`, `address`, `s_image`, `created_date`) VALUES
(1, 'Sako International High School', 'sihs@gmail.com', '01919784512', 'Road-22,Block-F,Mirpur-1,Dhaka-1216.', '1827155dea48642c1d.png', '2015-08-27 05:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_student`
--

CREATE TABLE IF NOT EXISTS `tbl_add_student` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `s_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `s_contact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `s_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `s_dob` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `s_class_id` int(11) NOT NULL,
  `s_roll_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `s_gender` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `s_religion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `s_image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `s_profile_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `s_password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_add_student`
--

INSERT INTO `tbl_add_student` (`s_id`, `s_name`, `parent_id`, `s_email`, `s_contact`, `s_address`, `s_dob`, `s_class_id`, `s_roll_no`, `s_gender`, `s_religion`, `s_image`, `s_profile_name`, `s_password`, `created_date`) VALUES
(20, 'Jamal Uddin Ahmed', 4, 'jamal@gmail.com', '01717456321', 'Dhaka,Mirpur', '10/01/2015', 1, '11', 'Male', 'Islam', '57895561e502a649cd.png', 'jamal25', '121212', '2015-10-14 12:52:58'),
(24, 'Abdur Rahim', 4, 'rahim@gmail.com', '01789456321', 'Dhaka', '10/01/2015', 3, '15', 'Male', 'Islam', '85128561e548467b64.png', 'rahim', '123456', '2015-10-14 13:11:32'),
(25, 'Raiha', 4, 'raiha@gmail.com', '01925845678', 'Chandanaish', '01/01/2015', 2, '10', 'Female', 'Islam', '4577956232b291a301.png', 'raiha', '555555', '2015-10-18 05:16:25'),
(26, 'Hamid', 5, 'hamid@yahoo.com', '0191111711114', 'Same as Parent', '22/03/2007', 4, '12', 'Male', 'Islam', '570405624a9af007a1.jpg', 'Hamid', '123456', '2015-10-19 08:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_student_charge`
--

CREATE TABLE IF NOT EXISTS `tbl_add_student_charge` (
  `charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_class` int(11) NOT NULL,
  `sc_student` int(11) NOT NULL,
  `sc_roll` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sc_month` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sc_type_id` int(11) NOT NULL,
  `sc_amount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sc_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`charge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_add_student_charge`
--

INSERT INTO `tbl_add_student_charge` (`charge_id`, `sc_class`, `sc_student`, `sc_roll`, `sc_month`, `sc_type_id`, `sc_amount`, `sc_date`, `created_date`) VALUES
(20, 1, 20, '11', 'October', 2, '1200.00', '20/10/2015', '2015-10-20 08:22:13'),
(21, 2, 25, '10', 'October', 2, '1200.00', '20/10/2015', '2015-10-20 08:22:46'),
(22, 3, 24, '15', 'October', 2, '1200.00', '20/10/2015', '2015-10-20 08:24:02'),
(23, 4, 26, '12', 'October', 2, '1200.00', '20/10/2015', '2015-10-20 08:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_subject`
--

CREATE TABLE IF NOT EXISTS `tbl_add_subject` (
  `sb_id` int(11) NOT NULL AUTO_INCREMENT,
  `sb_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sb_author` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sb_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sb_class_id` int(11) NOT NULL,
  `sb_teacher_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbl_add_subject`
--

INSERT INTO `tbl_add_subject` (`sb_id`, `sb_name`, `sb_author`, `sb_code`, `sb_class_id`, `sb_teacher_id`, `created_date`) VALUES
(1, 'Physics', 'S.M. Forhad Uddin', 'P_9_001', 10, 3, '2015-07-09 04:46:04'),
(8, 'Physics', 'S.M. Forhad Uddin', 'P_5_001', 5, 7, '2015-07-09 08:48:38'),
(9, 'Mathematics', 'S U Ahmed', 'M_9_001', 10, 6, '2015-07-11 05:07:44'),
(12, 'Chemistry', 'S M Ziaur Rahman', 'C_9_001', 10, 3, '2015-07-11 06:11:27'),
(13, 'Biology', 'Mahmud Hasan', 'BI_9_001', 10, 3, '2015-07-11 06:15:44'),
(14, 'Bangla 1st Paper', 'Abdulla-Al-Mamun', 'B_2_001', 2, 6, '2015-07-11 06:17:01'),
(15, 'Bangla 2nd Paper', 'Promotho Chowdhury', 'B_2_002', 2, 6, '2015-07-11 06:17:24'),
(16, 'English Grammar', 'Mahmud Hasan', 'E_2_001', 2, 3, '2015-07-11 06:17:54'),
(17, 'Bangla 1st Paper', 'Abdulla-Al-Mamun', 'B_3_001', 3, 6, '2015-07-11 06:19:21'),
(18, 'Bangla 2nd Paper', 'Promotho Chowdhury', 'B_3_002', 3, 3, '2015-07-11 06:19:38'),
(19, 'English Grammar', 'Mahmud Hasan', 'E_3_001', 3, 6, '2015-07-11 06:20:06'),
(20, 'Bangla 1st Paper', 'Abdulla-Al-Mamun', 'B_4_001', 4, 6, '2015-07-11 06:20:39'),
(21, 'Bangla 2nd Paper', 'Promotho Chowdhury', 'B_4_002', 4, 3, '2015-07-11 06:20:59'),
(22, 'English Grammar', 'Mahmud Hasan', 'E_4_001', 4, 6, '2015-07-11 06:21:18'),
(23, 'Bangla 1st Paper', 'Abdulla-Al-Mamun', 'B_5_001', 5, 6, '2015-07-11 06:24:26'),
(24, 'Physics', 'S.M. Forhad Uddin', 'P_6_001', 6, 6, '2015-07-11 06:27:32'),
(25, 'Chemistry', 'S U Ahmed', 'C_7_001', 8, 3, '2015-07-11 06:27:57'),
(26, 'Biology', 'D. Shah Alam', 'BI_10_001', 11, 6, '2015-07-11 06:28:43'),
(27, 'Bangla 1st Paper', 'Md. Ramjan Ali', '102', 1, 6, '2015-10-15 05:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_teacher`
--

CREATE TABLE IF NOT EXISTS `tbl_add_teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `t_designation` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `t_dob` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `t_gender` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `t_religion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `t_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `t_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `t_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `t_joining_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_photo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_add_teacher`
--

INSERT INTO `tbl_add_teacher` (`teacher_id`, `t_name`, `t_designation`, `t_dob`, `t_gender`, `t_religion`, `t_email`, `t_phone`, `t_address`, `t_joining_date`, `t_photo`, `t_username`, `t_password`, `created_date`) VALUES
(3, 'Rubel Hossain', 'Senior Teacher', '01/07/2015', 'Male', 'Islam', 'rubel@gmail.com', '01717456321', 'Dhaka', '01/07/2015', '94403559a5d6c30291.png', 'Rubel', '99999', '2015-07-06 10:50:20'),
(6, 'John Sina', 'Junior Teacher', '31/07/2015', 'Male', 'Islam', 'john@yahoo.com', '01717112365', 'Dhaka', '29/07/2015', '6079755f03358713fb.jpg', 'Mahedi', '123456', '2015-07-08 05:17:33'),
(7, 'Rakib', 'Junior Teacher', '08/28/2015', 'Male', 'Islam', 'rakob@yahoo.com', '1212121', 'jsdksdj skdsjdk sdj', '08/07/2015', '9134255d03e4b57e47.png', 'Rakib', '123456', '2015-08-16 07:39:55'),
(8, 'Kader Chy.', 'Principal', '10/20/2015', 'Male', 'Islam', 'kader@gmail.com', '01558637863', 'Khagrachori.', '10/01/2015', '40045561ca597a5b36.png', 'kader', '6363', '2015-10-13 06:32:55'),
(9, 'Razarual Hoque', 'Junior Teacher', '21/03/1997', 'Male', 'Islam', 'raza@yahoo.com', '019111762147', 'Dhaka, Mirpur-1, Zipcode-1216', '28/10/2015', '466715624a8b91efe9.jpg', 'Raza', '123456', '2015-10-19 08:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_teacher_salary`
--

CREATE TABLE IF NOT EXISTS `tbl_add_teacher_salary` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` int(11) NOT NULL,
  `t_month` int(11) NOT NULL,
  `t_pay_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_amount` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_add_teacher_salary`
--

INSERT INTO `tbl_add_teacher_salary` (`t_id`, `t_name`, `t_month`, `t_pay_date`, `t_amount`, `created_date`) VALUES
(7, 3, 1, '09/08/2015', '15000', '2015-09-08 07:09:51'),
(8, 3, 2, '09/08/2015', '12000', '2015-09-08 07:10:04'),
(9, 6, 1, '09/08/2015', '10000', '2015-09-08 07:10:17'),
(10, 6, 2, '09/08/2015', '10000', '2015-09-08 07:10:30'),
(11, 7, 1, '09/08/2015', '5000', '2015-09-08 07:10:43'),
(12, 7, 2, '09/08/2015', '5000', '2015-09-08 07:10:57'),
(13, 7, 9, '09/08/2015', '5000', '2015-09-08 07:26:27'),
(14, 0, 0, '', '', '2015-10-11 05:13:12'),
(15, 3, 3, '10/10/2015', '5000', '2015-10-11 05:23:58'),
(16, 7, 12, '10/31/2015', '9.00', '2015-10-11 05:37:33'),
(17, 7, 7, '10/28/2015', '850.25', '2015-10-11 05:41:17'),
(18, 3, 12, '10/11/2015', '15000', '2015-10-11 06:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_tp_member`
--

CREATE TABLE IF NOT EXISTS `tbl_add_tp_member` (
  `tpm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `tpm_destination` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tpm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_add_tp_member`
--

INSERT INTO `tbl_add_tp_member` (`tpm_id`, `sid`, `cid`, `tpm_destination`, `created_date`) VALUES
(20, 20, 1, '1', '2015-10-17 13:10:49'),
(21, 24, 3, '2', '2015-10-17 15:10:11'),
(22, 25, 2, '1', '2015-10-18 05:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_transport`
--

CREATE TABLE IF NOT EXISTS `tbl_add_transport` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle` int(11) NOT NULL,
  `fare` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transport_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_add_transport`
--

INSERT INTO `tbl_add_transport` (`transport_id`, `destination`, `vehicle`, `fare`, `note`, `created_date`) VALUES
(1, 'Mirpur-1 to Mirpur-12', 10, '30', 'Per Member 30 taka only', '2015-07-12 08:50:54'),
(2, 'Mirpur 1 to Firmgate', 10, '20', 'Per Member Price 15 Taka.', '2015-09-07 06:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_user`
--

CREATE TABLE IF NOT EXISTS `tbl_add_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `u_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `u_contact` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `u_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `u_dob` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `u_gender` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `u_religion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `u_designation` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `u_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `u_profile_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `u_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_add_user`
--

INSERT INTO `tbl_add_user` (`u_id`, `u_name`, `u_email`, `u_contact`, `u_address`, `u_dob`, `u_gender`, `u_religion`, `u_designation`, `u_image`, `u_profile_name`, `u_password`, `created_date`) VALUES
(1, 'Rubel Hossain', 'rubel@gmail.com', '01915236548', 'Dhaka', '01/07/2015', 'Male', 'Islam', 'Librarian', '56833559cff8bd693a.png', 'rubel', '123456', '2015-07-08 10:38:25'),
(4, 'Abdullah', 'abu@gmail.com', '01717456321', 'Dhaka', '21/07/2015', 'Male', 'Islam', 'Accountant', '78467559d00493567e.png', 'abu', '123456', '2015-07-08 10:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_login`
--

CREATE TABLE IF NOT EXISTS `tbl_admin_login` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `a_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `d_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin_login`
--

INSERT INTO `tbl_admin_login` (`aid`, `a_email`, `password`, `d_name`, `created_date`) VALUES
(1, 'opu005@gmail.com', '123456', 'Khan', '2015-09-20 08:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_issue`
--

CREATE TABLE IF NOT EXISTS `tbl_book_issue` (
  `issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `issue_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `return_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fine` decimal(15,2) NOT NULL DEFAULT '0.00',
  `note` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`issue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_book_issue`
--

INSERT INTO `tbl_book_issue` (`issue_id`, `lid`, `bname`, `issue_date`, `return_date`, `fine`, `note`, `status`, `added_date`) VALUES
(6, '20018', '1', '09/06/2015', '09/20/2015', 0.00, 'test 1', 0, '2015-09-06 09:16:06'),
(7, '20021', '2', '09/06/2015', '09/22/2015', 0.00, 'test 2', 0, '2015-09-06 09:17:06'),
(8, '20018', '4', '09/30/2015', '10/07/2015', 0.00, 'Yes', 0, '2015-09-06 13:35:00'),
(9, '20022', '1', '09/07/2015', '09/15/2015', 0.00, 'eddd', 0, '2015-09-07 10:21:49'),
(10, '2002', '1', '09/10/2015', '09/30/2015', 10.00, 'done', 0, '2015-09-10 06:34:55'),
(11, '2002', '1', '10/08/2015', '10/30/2015', 0.00, 'done', 0, '2015-10-08 11:31:09'),
(12, '8', '1', '21/10/2015', '31/10/2015', 0.00, 'Issued', 1, '2015-10-21 09:40:48'),
(13, '8', '4', '21/10/2015', '31/10/2015', 0.00, 'Issued', 1, '2015-10-21 12:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_setup`
--

CREATE TABLE IF NOT EXISTS `tbl_book_setup` (
  `bk_id` int(11) NOT NULL AUTO_INCREMENT,
  `bk_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `bk_author` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_book_setup`
--

INSERT INTO `tbl_book_setup` (`bk_id`, `bk_name`, `bk_author`, `created_date`) VALUES
(1, 'Sheser Lobita', 'Rejwan Ahmed', '2015-07-13 09:31:39'),
(2, 'Jai Jai Din', 'Md. Mama.', '2015-07-13 09:32:08'),
(4, 'Jibon Colejai', 'Master Shifu', '2015-07-13 09:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hostel_category`
--

CREATE TABLE IF NOT EXISTS `tbl_hostel_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_id` int(11) NOT NULL,
  `hostel_category` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `hostel_fee` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `hostel_note` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_hostel_category`
--

INSERT INTO `tbl_hostel_category` (`category_id`, `hostel_id`, `hostel_category`, `hostel_fee`, `hostel_note`, `created_date`) VALUES
(1, 1, 'First Class', '5000', 'This is First Class....', '2015-07-15 07:17:07'),
(2, 2, 'First Class', '5000', 'This is First Class....', '2015-07-15 07:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hostel_monthly_fee`
--

CREATE TABLE IF NOT EXISTS `tbl_hostel_monthly_fee` (
  `htl_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_member_id` int(11) NOT NULL,
  `hostel_id` int(11) NOT NULL,
  `h_month` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `h_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `h_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`htl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_hostel_monthly_fee`
--

INSERT INTO `tbl_hostel_monthly_fee` (`htl_id`, `h_member_id`, `hostel_id`, `h_month`, `h_date`, `h_amount`, `created_date`) VALUES
(9, 15, 2, '10', '17/10/2015', 500.00, '2015-10-17 09:59:15'),
(10, 14, 1, '10', '17/10/2015', 600.00, '2015-10-17 10:02:02'),
(11, 15, 2, '1', '01/01/2015', 500.00, '2015-10-17 12:32:15'),
(12, 15, 2, '2', '05/10/2015', 500.00, '2015-10-17 12:32:44'),
(13, 15, 2, '3', '05/10/2015', 800.00, '2015-10-17 12:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_library_book_list`
--

CREATE TABLE IF NOT EXISTS `tbl_library_book_list` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `book_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `author_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `issue_qty` int(11) NOT NULL,
  `rack_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_library_book_list`
--

INSERT INTO `tbl_library_book_list` (`b_id`, `subject_code`, `book_name`, `author_name`, `quantity`, `issue_qty`, `rack_no`, `price`, `status`, `created_date`) VALUES
(1, '101', 'Shasher Lobita', 'Rejwan Ahmed', 10, 9, '1001', 100.00, 1, '2015-07-13 10:09:40'),
(2, '101', 'Dhori Mon', 'Mehedi Hasan', 60, 60, '1001', 100.00, 1, '2015-07-13 10:09:53'),
(4, '301', 'Fazil Pola', 'Rakib Ahmed', 111, 110, '102', 150.00, 1, '2015-07-15 05:16:25'),
(5, '303', 'Nill Jama', 'Shojib Hossain', 50, 50, '105', 150.00, 1, '2015-07-15 05:16:40'),
(6, '302', 'Science Fiction', 'Master Shifu', 30, 30, '105', 120.00, 1, '2015-07-15 05:19:49'),
(7, '1001', 'General Knowledge', 'Miya Mehedi', 40, 40, '115', 180.00, 1, '2015-09-06 10:03:07'),
(8, '1002', 'Physics', 'Dr. Abu Taher', 50, 53, '201', 160.00, 1, '2015-09-06 10:32:35'),
(11, '1003', 'Cricket Game', 'Asgar Hossain Chowdhury', 5000, 5000, '1010', 200.00, 1, '2015-10-08 11:47:10'),
(12, '111', 'eofjdkfgkd', 'dkfdfksjdq', 45454, 45454, '121212', 2000.00, 1, '2015-10-14 10:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_library_member`
--

CREATE TABLE IF NOT EXISTS `tbl_library_member` (
  `lmid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `library_fee` decimal(15,2) NOT NULL DEFAULT '10.00',
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lmid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_library_member`
--

INSERT INTO `tbl_library_member` (`lmid`, `sid`, `cid`, `library_fee`, `join_date`) VALUES
(6, 4, 1, 10.00, '2015-10-08 11:35:46'),
(7, 20, 1, 10.00, '2015-10-17 15:33:58'),
(8, 25, 2, 10.00, '2015-10-21 09:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_routine_setup`
--

CREATE TABLE IF NOT EXISTS `tbl_routine_setup` (
  `rsid` int(11) NOT NULL AUTO_INCREMENT,
  `weekday` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`rsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tbl_routine_setup`
--

INSERT INTO `tbl_routine_setup` (`rsid`, `weekday`, `sort`) VALUES
(26, 'saturday', 0),
(27, 'sunday', 1),
(28, 'monday', 2),
(29, 'tuesday', 3),
(30, 'wednesday', 4),
(31, 'thursday', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_setup`
--

CREATE TABLE IF NOT EXISTS `tbl_schedule_setup` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_schedule_setup`
--

INSERT INTO `tbl_schedule_setup` (`schedule_id`, `schedule_name`, `created_date`) VALUES
(1, '1st Terminal', '2015-07-12 05:46:56'),
(2, '2nd Terminal', '2015-07-12 05:47:07'),
(3, 'Final', '2015-07-12 05:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_attendance`
--

CREATE TABLE IF NOT EXISTS `tbl_student_attendance` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `attendance` int(1) NOT NULL DEFAULT '0',
  `roll_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `a_month` int(10) NOT NULL,
  `a_year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Dumping data for table `tbl_student_attendance`
--

INSERT INTO `tbl_student_attendance` (`aid`, `sid`, `cid`, `attendance`, `roll_no`, `added_date`, `a_month`, `a_year`) VALUES
(19, 4, 1, 1, '1', '09/02/2015', 9, '2015'),
(20, 6, 1, 1, '6', '09/02/2015', 9, '2015'),
(21, 4, 1, 1, '1', '09/04/2015', 9, '2015'),
(22, 6, 1, 1, '6', '09/04/2015', 9, '2015'),
(23, 4, 1, 1, '1', '09/07/2015', 9, '2015'),
(24, 6, 1, 1, '6', '09/07/2015', 9, '2015'),
(25, 4, 1, 1, '1', '09/09/2015', 9, '2015'),
(26, 6, 1, 1, '6', '09/09/2015', 9, '2015'),
(27, 4, 1, 1, '1', '09/11/2015', 9, '2015'),
(28, 6, 1, 1, '6', '09/11/2015', 9, '2015'),
(29, 4, 1, 1, '1', '09/30/2015', 9, '2015'),
(30, 6, 1, 1, '6', '09/30/2015', 9, '2015'),
(31, 4, 1, 1, '1', '09/03/2015', 9, '2015'),
(32, 6, 1, 1, '6', '09/03/2015', 9, '2015'),
(33, 4, 1, 1, '1', '01/14/2015', 9, '2015'),
(34, 6, 1, 1, '6', '01/14/2015', 9, '2015'),
(35, 4, 1, 1, '1', '09/05/2015', 9, '2015'),
(36, 6, 1, 1, '6', '09/05/2015', 9, '2015'),
(37, 4, 1, 1, '1', '09/07/2015', 9, '2015'),
(38, 6, 1, 1, '6', '09/07/2015', 9, '2015'),
(39, 4, 1, 1, '1', '09/10/2015', 9, '2015'),
(40, 6, 1, 1, '6', '09/10/2015', 9, '2015'),
(41, 4, 1, 1, '1', '08/31/2015', 9, '2015'),
(42, 6, 1, 1, '6', '08/31/2015', 9, '2015'),
(43, 4, 1, 1, '1', '10/05/2015', 10, '2015'),
(44, 6, 1, 1, '6', '10/05/2015', 10, '2015'),
(45, 20, 1, 1, '11', '10/17/2015', 10, '2015'),
(46, 20, 1, 1, '11', '10/18/2015', 10, '2015'),
(47, 25, 2, 1, '10', '10/18/2015', 10, '2015'),
(48, 24, 3, 1, '15', '10/18/2015', 10, '2015'),
(49, 20, 1, 1, '11', '19/10/2015', 10, '2015'),
(50, 20, 1, 1, '11', '01/01/2015', 10, '2015');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_fee`
--

CREATE TABLE IF NOT EXISTS `tbl_student_fee` (
  `sf_id` int(11) NOT NULL AUTO_INCREMENT,
  `sf_class_id` int(11) NOT NULL,
  `sf_name_id` int(11) NOT NULL,
  `sf_roll` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sf_exam_type` int(11) NOT NULL,
  `sf_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sf_amount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_student_fee`
--

INSERT INTO `tbl_student_fee` (`sf_id`, `sf_class_id`, `sf_name_id`, `sf_roll`, `sf_exam_type`, `sf_date`, `sf_amount`, `created_date`) VALUES
(14, 1, 20, '11', 1, '20/10/2015', '2000', '2015-10-20 08:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_marks`
--

CREATE TABLE IF NOT EXISTS `tbl_student_marks` (
  `smid` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `marks` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`smid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=86 ;

--
-- Dumping data for table `tbl_student_marks`
--

INSERT INTO `tbl_student_marks` (`smid`, `exam_id`, `class_id`, `subject_id`, `student_id`, `marks`, `created_date`) VALUES
(80, 1, 1, 27, 20, '80', '2015-10-18 15:26:12'),
(81, 2, 1, 27, 20, '80', '2015-10-18 15:26:59'),
(82, 3, 1, 27, 20, '88', '2015-10-18 15:27:09'),
(83, 1, 2, 14, 25, '80', '2015-10-21 09:32:06'),
(84, 2, 2, 14, 25, '88', '2015-10-21 09:32:16'),
(85, 3, 2, 14, 25, '90', '2015-10-21 09:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transport_fee`
--

CREATE TABLE IF NOT EXISTS `tbl_transport_fee` (
  `tpf_id` int(11) NOT NULL AUTO_INCREMENT,
  `tpf_class` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tpf_student` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tpf_roll` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tpf_month` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tpf_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tpf_destination` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tpf_amount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tpf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transport_monthly_fee`
--

CREATE TABLE IF NOT EXISTS `tbl_transport_monthly_fee` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_member_id` int(11) NOT NULL,
  `t_destination` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `t_month` int(11) NOT NULL,
  `t_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `t_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_transport_monthly_fee`
--

INSERT INTO `tbl_transport_monthly_fee` (`t_id`, `t_member_id`, `t_destination`, `t_month`, `t_date`, `t_amount`, `created_date`) VALUES
(12, 20, 'Mirpur-1 to Mirpur-12', 10, '18/10/2015', 30.00, '2015-10-18 05:32:10'),
(13, 21, 'Mirpur 1 to Firmgate', 10, '18/10/2015', 20.00, '2015-10-18 07:51:14'),
(14, 20, 'Mirpur-1 to Mirpur-12', 1, '01/01/2015', 30.00, '2015-10-18 08:14:58'),
(15, 20, 'Mirpur-1 to Mirpur-12', 2, '02/01/2015', 30.00, '2015-10-18 08:15:18'),
(16, 20, 'Mirpur-1 to Mirpur-12', 3, '03/01/2015', 30.00, '2015-10-18 08:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_access_setup`
--

CREATE TABLE IF NOT EXISTS `tbl_user_access_setup` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `access_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `access` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
