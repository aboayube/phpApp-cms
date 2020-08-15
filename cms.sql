-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2020 at 02:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat`) VALUES
(2, 'اخبار'),
(3, 'مقلات'),
(4, 'العاب');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `auther` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `comment` text NOT NULL,
  `regdata` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_post`, `auther`, `title`, `comment`, `regdata`, `status`) VALUES
(3, 6, 'wajeeh', 'aaaaaaaaa', 'z', '2019-02-25 01:28:10', 'publish'),
(4, 6, 'wajeeh', 'fffffffffffff', 'ffffffffffffffff', '2019-02-25 01:32:26', 'derft'),
(5, 6, 'wajeeh', 'fffffffffffffdddddddddddddddd', 'ffffffffffffffffdddddddddddd', '2019-02-25 01:32:38', 'derft');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `post` longtext NOT NULL,
  `cat` text NOT NULL,
  `img` text NOT NULL,
  `auther` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `regdata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `post`, `cat`, `img`, `auther`, `status`, `regdata`) VALUES
(1, 'ayube', 's', '3', 'images/post/post5c71dd69bf70a.png', 'wajeeh', 'publish', '2019-02-24 02:55:21'),
(2, 'ayube', 'n ', '2', 'images/post/post5c71dd8beac8c.jpg', 'wajeeh', 'publish', '2019-02-24 02:55:55'),
(3, 'xxxxxxc', 'c', '3', 'images/post/post5c71de2216cf2.jpg', 'wajeeh', 'publish', '2019-02-24 02:58:26'),
(4, 'aaaaaaaa', 'aaaaaaaaaa', '2', 'images/post/post5c71de30b640c.jpg', 'wajeeh', 'publish', '2019-02-24 02:58:40'),
(5, 'ccccccc', 'ssssssss', '2', 'images/post/post5c71de3f303ff.png', 'wajeeh', 'publish', '2019-02-24 02:58:55'),
(6, 'xccccccccvvvvvvv', 'sssssss', '2', 'images/post/post5c71de7c206ca.png', 'wajeeh', 'publish', '2019-02-24 02:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `slid` varchar(255) NOT NULL,
  `nslid` int(11) NOT NULL,
  `sec1` varchar(255) NOT NULL,
  `nsec1` int(11) NOT NULL,
  `sec2` varchar(255) NOT NULL,
  `nsec2` int(11) NOT NULL,
  `tab1` varchar(255) NOT NULL,
  `ntab1` int(11) NOT NULL,
  `tab2` varchar(255) NOT NULL,
  `ntab2` int(11) NOT NULL,
  `tab3` varchar(255) NOT NULL,
  `ntab3` int(11) NOT NULL,
  `face` varchar(255) NOT NULL,
  `twit` varchar(255) NOT NULL,
  `yout` varchar(255) NOT NULL,
  `inst` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `logo`, `slid`, `nslid`, `sec1`, `nsec1`, `sec2`, `nsec2`, `tab1`, `ntab1`, `tab2`, `ntab2`, `tab3`, `ntab3`, `face`, `twit`, `yout`, `inst`) VALUES
(1, 'صابر', 'images/post/post5c71c67476d81.jpg', 'العاب', 3, 'مقلات', 0, 'اخبار', 0, 'مقلات', 3, 'مقلات', 3, 'مقلات', 3, '#', '#', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `twit` varchar(255) NOT NULL,
  `face` varchar(255) NOT NULL,
  `yout` varchar(255) NOT NULL,
  `regdata` varchar(255) NOT NULL,
  `roll` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `img`, `about`, `twit`, `face`, `yout`, `regdata`, `roll`) VALUES
(2, 'ayube', 'ayube2010@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'images/useruser5c7075166d0dc.png', 'ayueb wajeeh shaib shik aid', 'ayube2010@gmail.com', 'ayube2010@gmail.com', 'ayube2010@gmail.com', '2019-02-18 00:20:17', 1),
(5, 'wajeeh', 'ahmed199696', '202cb962ac59075b964b07152d234b70', 1, 'images/useruser5c70828b54c58.png', 'wajeeh', 'ali199696@hotmail.com', 'ali199696@hotmail.com', 'ali199696@hotmail.com', '2019-02-18 00:45:26', 1),
(6, 'aid', 'aid2019@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'images/user/user5f37d240703ba.png', 'sadfd', 'sdasad', '', 'dsa', '2020-08-15 15:17:04', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
