-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 27, 2016 at 07:40 PM
-- Server version: 5.5.42-log
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `chatter`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `body` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `body`, `image_url`, `created_at`) VALUES
(1, 1, 'Visiting New York for the first time. Any suggestions on great places to visit?', '', '2016-07-01 01:00:00'),
(2, 1, 'Wow, the buildings are so big! ', '', '2016-07-05 01:00:00'),
(3, 1, 'So let me tell you what happened last night. I was just hanging out minding my own business and saw the Empire State Building.', '', '2016-07-12 00:00:00'),
(4, 1, 'So I decided to go see it. That''s when the trouble started', '', '2016-07-12 01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_icon` varchar(255) NOT NULL,
  `apikey` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `profile_icon`, `apikey`) VALUES
(1, 'peter', '000c285457fc971f862a79b786476c78812c8897063c6fa9c045f579a3b2d63f', 'peter@example.com', 'peter.jpg', 'd0763edaa9d9bd2a9516280e9044d885'),
(2, 'marcia', '4d6b96d1e8f9bfcd28169bafe2e17da6e1a95f71e8ca6196d3affb4f95ca809f', 'marcia@example.com', 'marcia.jpg', 'd0763edaa9d9bd2a9516280e9044d885'),
(3, 'cindy', '81ba24935dd9a720826155382938610f1b74ba226e85a7b4ca2ad58cf06664fa', 'cindy@example.com', 'cindy.jpg', 'd0763edaa9d9bd2a9516280e9044d885'),
(4, 'mike', 'ef1b839067281c41a6abdf36ff2346700f9cd5f17d8d4e486be9e81c67779258', 'mike@example.com', 'mike.jpg', 'd0763edaa9d9bd2a9516280e9044d885');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;