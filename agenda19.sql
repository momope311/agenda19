-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 11:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `agenda19`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `artid` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(128) NOT NULL,
  `seo` varchar(128) NOT NULL,
  `datum` date NOT NULL,
  `tekst` text NOT NULL,
  `catid` int(11) NOT NULL,
  `pregledi` int(11) NOT NULL,
  `authorid` int(11) NOT NULL,
  `minview` int(11) NOT NULL DEFAULT 400,
  `comments` TINYINT(1) NOT NULL,
  PRIMARY KEY (`artid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(64) NOT NULL,
  `catseo` varchar(64) NOT NULL,
  `catdesc` text NOT NULL,
  `image` varchar(128) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `artid` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `pub` TINYINT(1) NOT NULL,
  PRIMARY KEY (`comid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `session` varchar(64) NOT NULL,
  `usertype` TINYINT(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;