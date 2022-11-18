-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 18, 2022 at 06:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_tool_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `exam_question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`exam_question_id`, `exam_id`, `question`, `answer`) VALUES
(1, 1, 'Total types of the array in PHP is?', '2'),
(2, 1, 'Functions in PHP should start with which of the following keyword?', '3'),
(3, 1, 'Index of an array by default starts with which of the following in PHP?', '1'),
(4, 1, 'trim() in PHP is used for?', '2'),
(5, 1, 'Identify the function which converts a string to uppercase?', '3'),
(6, 2, 'In SQL, __________ is an Aggregate function', '3'),
(7, 2, 'A relational database consists of a collection of', '1'),
(8, 2, 'To remove a relation from an SQL database, we use the ______ command.', '4'),
(9, 2, 'In order to add a new column to an existing table in SQL, we can use the command', '3'),
(10, 2, 'Which clause is used to sort the result of SELECT statement?', '2');

-- --------------------------------------------------------

--
-- Table structure for table `exam_quetion_options`
--

CREATE TABLE `exam_quetion_options` (
  `exam_option_id` int(11) NOT NULL,
  `exam_question_id` int(11) NOT NULL,
  `exam_option` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_quetion_options`
--

INSERT INTO `exam_quetion_options` (`exam_option_id`, `exam_question_id`, `exam_option`, `title`) VALUES
(1, 1, 1, '2'),
(2, 1, 2, '3'),
(3, 1, 3, '4'),
(4, 1, 4, '5'),
(5, 2, 1, 'def'),
(6, 2, 2, 'fun'),
(7, 2, 3, 'function'),
(8, 2, 4, 'None'),
(9, 3, 1, '0'),
(10, 3, 2, '-1'),
(11, 3, 3, '1'),
(12, 3, 4, '2'),
(13, 4, 1, 'Removes uppercase alphabets'),
(14, 4, 2, 'Removes Whitespaces'),
(15, 4, 3, 'Removes lowercase alphabates'),
(16, 4, 4, 'Removes Underscores'),
(17, 5, 1, 'uppercase()'),
(18, 5, 2, 'str_uppercase()'),
(19, 5, 3, 'strtoupper()'),
(20, 5, 4, 'struppercase()'),
(21, 6, 1, 'SELECT'),
(22, 6, 2, 'CREATE'),
(23, 6, 3, 'AVG'),
(24, 6, 4, 'MODIFY'),
(25, 7, 1, 'Table'),
(26, 7, 2, 'Fields'),
(27, 7, 3, 'Records'),
(28, 7, 4, 'Keys'),
(29, 8, 1, 'Delete'),
(30, 8, 2, 'Purge'),
(31, 8, 3, 'Remove'),
(32, 8, 4, 'Drop table'),
(33, 9, 1, 'MODIFY TABLE'),
(34, 9, 2, 'EDIT TABLE'),
(35, 9, 3, 'ALTER TABLE'),
(36, 9, 4, 'ALTER COLUMNS'),
(37, 10, 1, 'SORT BY'),
(38, 10, 2, 'ORDER BY'),
(39, 10, 3, 'ARRENGE BY'),
(40, 10, 4, 'None of the above');

-- --------------------------------------------------------

--
-- Table structure for table `exam_subject_details`
--

CREATE TABLE `exam_subject_details` (
  `exam_id` int(11) NOT NULL,
  `exam_title` varchar(255) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `marks_per_right_ans` varchar(255) NOT NULL,
  `marks_per_wrong_ans` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_subject_details`
--

INSERT INTO `exam_subject_details` (`exam_id`, `exam_title`, `total_questions`, `duration`, `marks_per_right_ans`, `marks_per_wrong_ans`) VALUES
(1, 'PHP TEST', 5, '5', '1', '0'),
(2, 'MYSQL', 5, '5', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `exam_user_question_ans`
--

CREATE TABLE `exam_user_question_ans` (
  `exam_question_ans_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `exam_question_id` int(11) NOT NULL,
  `user_ans_option` enum('0','1','2','3','4') NOT NULL,
  `marks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_user_question_ans`
--

INSERT INTO `exam_user_question_ans` (`exam_question_ans_id`, `user_id`, `exam_id`, `exam_question_id`, `user_ans_option`, `marks`) VALUES
(1, 4, 1, 1, '2', '1'),
(2, 4, 1, 2, '3', '1'),
(3, 4, 1, 3, '2', '0'),
(4, 4, 1, 5, '2', '0'),
(5, 5, 2, 6, '3', '1'),
(6, 5, 2, 7, '1', '1'),
(7, 5, 2, 8, '4', '1'),
(8, 5, 2, 9, '1', '0'),
(9, 5, 2, 10, '1', '0'),
(10, 7, 1, 1, '2', '1'),
(11, 7, 1, 2, '2', '0'),
(12, 7, 1, 3, '1', '1'),
(13, 7, 1, 4, '2', '1'),
(14, 7, 1, 5, '3', '1'),
(15, 4, 1, 4, '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_mail`, `user_created`) VALUES
(4, 'thetesonali', 'sonalithete@gmail.com', '0000-00-00 00:00:00'),
(5, 'hiretanmay', 'hiretanmay@gmail.com', '0000-00-00 00:00:00'),
(7, 'thetesonali123', 'sonalithete123@gmail.com', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`exam_question_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_quetion_options`
--
ALTER TABLE `exam_quetion_options`
  ADD PRIMARY KEY (`exam_option_id`),
  ADD KEY `exam_question_id` (`exam_question_id`);

--
-- Indexes for table `exam_subject_details`
--
ALTER TABLE `exam_subject_details`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `exam_user_question_ans`
--
ALTER TABLE `exam_user_question_ans`
  ADD PRIMARY KEY (`exam_question_ans_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `exam_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exam_quetion_options`
--
ALTER TABLE `exam_quetion_options`
  MODIFY `exam_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `exam_subject_details`
--
ALTER TABLE `exam_subject_details`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_user_question_ans`
--
ALTER TABLE `exam_user_question_ans`
  MODIFY `exam_question_ans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam_subject_details` (`exam_id`);

--
-- Constraints for table `exam_quetion_options`
--
ALTER TABLE `exam_quetion_options`
  ADD CONSTRAINT `exam_quetion_options_ibfk_1` FOREIGN KEY (`exam_question_id`) REFERENCES `exam_questions` (`exam_question_id`);

--
-- Constraints for table `exam_user_question_ans`
--
ALTER TABLE `exam_user_question_ans`
  ADD CONSTRAINT `exam_user_question_ans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `exam_user_question_ans_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam_subject_details` (`exam_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
