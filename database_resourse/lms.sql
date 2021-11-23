-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 06:31 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cId` int(11) NOT NULL,
  `dId` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `field` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cId`, `dId`, `cname`, `field`, `time`, `type`) VALUES
(5, 5, 'logic design', 'is', '2020-07-11 17:10:52', 1),
(7, 5, 'graphics', 'cs', '2020-07-20 16:17:17', 1),
(8, 5, 'database 2', 'is', '2020-07-11 17:10:57', 1),
(10, 5, 'sondos', 'is', '2020-07-11 17:25:58', 1),
(11, 5, 'gemy', 'is', '2020-07-11 17:25:31', 1),
(12, 10, 'network', 'it', '2020-07-17 19:11:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `finished_quiz`
--

CREATE TABLE `finished_quiz` (
  `fQId` int(11) NOT NULL,
  `uId` int(11) NOT NULL,
  `qId` int(11) NOT NULL,
  `stdGrade` int(11) NOT NULL,
  `midGrade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finished_quiz`
--

INSERT INTO `finished_quiz` (`fQId`, `uId`, `qId`, `stdGrade`, `midGrade`) VALUES
(3, 7, 9, 20, 25);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `mId` int(11) NOT NULL,
  `dId` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `resource` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`mId`, `dId`, `course`, `resource`, `time`, `type`) VALUES
(9, 5, 'logic design', 'pdf_1594134420.pdf', '2020-07-07 15:42:45', 1),
(10, 5, 'graphics', 'pdf_1594136549.pdf', '2020-07-07 15:42:48', 1),
(11, 5, 'graphics', 'pdf_1594147227.pdf', '2020-07-07 19:03:05', 1),
(12, 5, 'graphics', 'pdf_1594148567.pdf', '2020-07-07 19:03:08', 1),
(13, 10, 'network', 'pdf_1595013210.pdf', '2020-07-17 19:14:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_data`
--

CREATE TABLE `quiz_data` (
  `dataId` int(11) NOT NULL,
  `qId` int(11) NOT NULL,
  `TOQ` int(11) NOT NULL,
  `FM` int(11) NOT NULL,
  `allow` int(11) NOT NULL DEFAULT '0',
  `complete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_data`
--

INSERT INTO `quiz_data` (`dataId`, `qId`, `TOQ`, `FM`, `allow`, `complete`) VALUES
(5, 9, 1000, 50, 1, 1),
(6, 10, 120, 50, 1, 1),
(7, 11, 7200, 100, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `quesId` int(11) NOT NULL,
  `quizId` int(11) NOT NULL,
  `question` text NOT NULL,
  `choice1` text NOT NULL,
  `choice2` text NOT NULL,
  `choice3` text NOT NULL,
  `choice4` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`quesId`, `quizId`, `question`, `choice1`, `choice2`, `choice3`, `choice4`, `answer`) VALUES
(2, 9, 'what', '1', '2', '3', '4', '1'),
(3, 9, 'hema', 'body', 'fawzia', 'said', 'rania', 'fawzia'),
(4, 9, 'who123', '12', '21', '34', '43', '12'),
(5, 10, 'who', '1', '2', '3', '4', '4'),
(6, 11, 'question 1', 'answer1', 'answer2', 'answer3', 'answer4', 'answer1'),
(7, 9, 'what 2', '1', '2', '3', '4', '1'),
(8, 9, 'ddfdf', 'dd', 'ddffggg', 'ggg', 'hhh', 'hhh');

-- --------------------------------------------------------

--
-- Table structure for table `requested_course`
--

CREATE TABLE `requested_course` (
  `reqId` int(11) NOT NULL,
  `stdId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requested_course`
--

INSERT INTO `requested_course` (`reqId`, `stdId`, `cId`, `status`) VALUES
(3, 5, 8, 1),
(4, 5, 5, 1),
(5, 7, 5, 1),
(6, 7, 8, 1),
(7, 8, 8, 1),
(8, 9, 8, 1),
(9, 3, 10, 1),
(11, 7, 7, 1),
(12, 11, 12, 2),
(13, 8, 5, 1),
(14, 8, 10, 1),
(15, 8, 11, 1),
(16, 11, 8, 1),
(17, 12, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requested_quiz`
--

CREATE TABLE `requested_quiz` (
  `quizId` int(11) NOT NULL,
  `dId` int(11) NOT NULL,
  `quizName` varchar(50) NOT NULL,
  `course` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requested_quiz`
--

INSERT INTO `requested_quiz` (`quizId`, `dId`, `quizName`, `course`, `status`) VALUES
(9, 5, 'quiz 1', 'logic design', 1),
(10, 10, 'quiz 1', 'network', 1),
(11, 5, 'first quiz', 'database 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `std_info`
--

CREATE TABLE `std_info` (
  `infoId` int(11) NOT NULL,
  `stdId` int(11) NOT NULL,
  `stdNum` varchar(50) NOT NULL,
  `stdDept` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_info`
--

INSERT INTO `std_info` (`infoId`, `stdId`, `stdNum`, `stdDept`) VALUES
(1, 6, '20150592', 'is'),
(2, 7, '20150003', 'cs'),
(3, 8, '20150000', 'is'),
(4, 9, '20150009', 'is'),
(5, 11, '20150014', 'is'),
(6, 12, '20153883', 'is');

-- --------------------------------------------------------

--
-- Table structure for table `std_request_quiz`
--

CREATE TABLE `std_request_quiz` (
  `sRQId` int(11) NOT NULL,
  `stdId` int(11) NOT NULL,
  `qId` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_request_quiz`
--

INSERT INTO `std_request_quiz` (`sRQId`, `stdId`, `qId`, `status`) VALUES
(1, 7, 9, 1),
(2, 11, 11, 1),
(3, 12, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `fullname`, `username`, `password`, `image`, `type`) VALUES
(3, 'mostafa', 'mostafa', 'gamal1234', 'IMG_20200204_131454.jpg', 'admin'),
(5, 'ali', 'ali', 'ali12345', '1594052754.png', 'doctor'),
(6, 'soso', 'soso', 'soso1234567', '1594148799.jpg', 'student'),
(7, 'bola', 'bola', 'bola12345', '1594214040.jpg', 'student'),
(8, 'bogy', 'bogy', 'bogy123', '1594486154.jpg', 'student'),
(9, 'zmzm', 'zmzm', 'zmzm123', '1594487827.jpg', 'student'),
(10, 't5a', 't5a', 't5a1234', '1595013049.jpg', 'doctor'),
(11, 'te7a1234', 'te7a1234', 'te7a1234', '1595013437.jpg', 'student'),
(12, 'yusra', 'yusra', 'yusra123', '1595546406.jpg', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `finished_quiz`
--
ALTER TABLE `finished_quiz`
  ADD PRIMARY KEY (`fQId`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`mId`);

--
-- Indexes for table `quiz_data`
--
ALTER TABLE `quiz_data`
  ADD PRIMARY KEY (`dataId`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`quesId`);

--
-- Indexes for table `requested_course`
--
ALTER TABLE `requested_course`
  ADD PRIMARY KEY (`reqId`);

--
-- Indexes for table `requested_quiz`
--
ALTER TABLE `requested_quiz`
  ADD PRIMARY KEY (`quizId`);

--
-- Indexes for table `std_info`
--
ALTER TABLE `std_info`
  ADD PRIMARY KEY (`infoId`);

--
-- Indexes for table `std_request_quiz`
--
ALTER TABLE `std_request_quiz`
  ADD PRIMARY KEY (`sRQId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `finished_quiz`
--
ALTER TABLE `finished_quiz`
  MODIFY `fQId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `mId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quiz_data`
--
ALTER TABLE `quiz_data`
  MODIFY `dataId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `quesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `requested_course`
--
ALTER TABLE `requested_course`
  MODIFY `reqId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `requested_quiz`
--
ALTER TABLE `requested_quiz`
  MODIFY `quizId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `std_info`
--
ALTER TABLE `std_info`
  MODIFY `infoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `std_request_quiz`
--
ALTER TABLE `std_request_quiz`
  MODIFY `sRQId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
