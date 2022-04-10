-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 08:13 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_kaval`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(10) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdDate`, `updatedDate`) VALUES
(32, 'Vivek', 'Sharma', 'vg@gmail.com', 'd41d8cd98f00b204e9800998e', 1, '2022-03-10 19:06:22', '2022-04-04 22:21:30'),
(33, 'Krsna', 'Nair', 'kk@gmail.com', 'a14c60a0b5aeb22c17468c1c3', 1, '2022-03-10 19:08:49', '2022-03-26 10:18:46'),
(38, 'Rohan', 'Carriappa', 'rc@gmail.com', '1a4e8e830e6757bdd6b0be0b0', 2, '2022-04-01 10:36:02', '2022-04-06 19:41:55'),
(39, 'Vivek', 'Gupta', 'vg@gmail.com', 'ba248c985ace94863880921d8', 1, '2022-04-01 10:41:35', NULL),
(40, 'Krsna', 'Kaul', 'kk@gmail.com', '5d101713d1261ac8562dad4e1', 1, '2022-04-01 10:43:34', NULL),
(41, 'Rohan', 'Carriappa', 'rc@gmail.com', '1f7a95a8074c90297e22553ef', 1, '2022-04-02 13:32:11', NULL),
(42, 'Mahesh', 'Carriappa', 'rc@gmail.com', '912ec803b2ce49e4a541068d4', 1, '2022-04-02 13:32:39', NULL),
(45, 'Nishu', 'Kaul', 'rp@gmail.com', 'asdf', 1, '2022-04-04 18:28:54', NULL),
(46, 'Nishu', 'Kaul', 'rp@gmail.com', 'asdf', 1, '2022-04-04 18:28:54', NULL),
(47, 'Raj', 'Kaul', 'rp@gmail.com', 'asdf', 1, '2022-04-04 18:28:54', NULL),
(49, 'Mitesh', 'Kaul', 'rp@gmail.com', 'asdf', 1, '2022-04-04 18:28:54', NULL),
(50, 'Rohan', 'Carriappa', 'rc@gmail.com', '912ec803b2ce49e4a541068d4', 1, '2022-04-06 16:03:24', NULL),
(51, 'Smit', 'Carriappa', 'rc@gmail.com', '912ec803b2ce49e4a541068d4', 1, '2022-04-06 16:06:49', NULL),
(52, 'Krsna', 'Kaul', 'kk@gmail.com', 'fd2cc6c54239c40495a0d3a93', 1, '2022-04-06 16:07:23', NULL),
(54, 'Rohan', 'Carriappa', 'rc@gmail.com', 'fefa1d66de89b47cbc7c0a31e', 1, '2022-04-06 19:49:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(10) NOT NULL,
  `customerId` int(10) NOT NULL,
  `subTotal` float DEFAULT NULL,
  `shippingMethod` int(10) DEFAULT NULL,
  `paymentMethod` int(10) DEFAULT NULL,
  `deliveryCharge` float DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `subTotal`, `shippingMethod`, `paymentMethod`, `deliveryCharge`, `createdDate`, `updatedDate`) VALUES
(1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, NULL, 3, 4, 50, NULL, NULL),
(4, 30, NULL, 2, 3, 100, NULL, NULL),
(5, 32, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 45, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 43, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `addressId` int(10) NOT NULL,
  `cartId` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `billing` bigint(1) NOT NULL DEFAULT 0,
  `shipping` bigint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`addressId`, `cartId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shipping`) VALUES
(1, 4, 'address3', 385535, 'Deesa', 'Gujarat', 'India', 0, 1),
(2, 4, 'address3', 385535, 'Deesa', 'Gujarat', 'India', 1, 0),
(3, 3, 'address6', 258746, 'Gurgaon', 'Delhi', 'India', 0, 1),
(4, 3, 'address6', 258746, 'Gurgaon', 'Delhi', 'India', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` int(10) NOT NULL,
  `cartId` int(10) NOT NULL,
  `productId` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `discount` float NOT NULL,
  `price` float NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`itemId`, `cartId`, `productId`, `quantity`, `discount`, `price`, `createdDate`, `updatedDate`) VALUES
(1, 4, 11, 10, 0, 100, '0000-00-00 00:00:00', NULL),
(2, 1, 12, 8, 0, 100, '0000-00-00 00:00:00', NULL),
(3, 3, 11, 10, 0, 100, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_payment`
--

CREATE TABLE `cart_payment` (
  `paymentId` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `note` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_payment`
--

INSERT INTO `cart_payment` (`paymentId`, `name`, `note`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Credit Card/ Debit Card', 'note1', 1, '2022-03-23 07:00:19', NULL),
(3, 'UPI', 'note2', 1, '2022-03-23 07:07:04', NULL),
(4, 'QR', 'note3', 1, '2022-03-23 07:07:28', NULL),
(5, 'COD', 'note4', 1, '2022-03-23 07:07:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_shipping`
--

CREATE TABLE `cart_shipping` (
  `shippingId` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_shipping`
--

INSERT INTO `cart_shipping` (`shippingId`, `name`, `note`, `amount`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Express delivery', 'Ok', 200, 1, '2022-03-23 06:31:32', NULL),
(2, 'Same day delivery', 'okk', 100, 1, '2022-03-23 06:32:11', NULL),
(3, 'Normal delivery', 'okk', 50, 1, '2022-03-23 06:38:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `parentId` int(10) DEFAULT NULL,
  `categoryId` int(10) NOT NULL,
  `path` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`parentId`, `categoryId`, `path`, `name`, `status`, `createdDate`, `updatedDate`) VALUES
(NULL, 8, '8', 'Fashion', 1, '2022-03-10 23:07:38', NULL),
(NULL, 9, '9', 'Electronic', 1, '2022-03-10 23:07:56', NULL),
(8, 10, '8/10', 'Shirt', 1, '2022-03-10 23:08:09', NULL),
(9, 11, '9/11', 'Mobile', 1, '2022-03-10 23:08:27', NULL),
(NULL, 12, '12', 'Bedroom', 1, '2022-03-10 23:08:43', NULL),
(12, 13, '12/13', 'Bed', 1, '2022-03-10 23:08:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `imageId` int(10) NOT NULL,
  `categoryId` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `base` tinyint(2) NOT NULL DEFAULT 0,
  `thumbnail` tinyint(2) NOT NULL DEFAULT 0,
  `small` tinyint(2) NOT NULL DEFAULT 0,
  `gallery` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`imageId`, `categoryId`, `name`, `base`, `thumbnail`, `small`, `gallery`) VALUES
(1, 27, '20220228110114.JPG', 1, 0, 1, 1),
(3, 27, '20220305212826.jpg', 0, 1, 0, 1),
(7, 8, '20220405104612.jpg', 1, 0, 0, 1),
(8, 8, '20220405104638.jpg', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` int(10) NOT NULL,
  `productId` int(10) NOT NULL,
  `categoryId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entityId`, `productId`, `categoryId`) VALUES
(43, 11, 9),
(53, 18, 8),
(54, 12, 12),
(55, 12, 13);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `name`, `code`, `value`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Config33', 'qwe', '555', 2, '2022-02-26 00:19:49', '2022-04-04 22:35:35'),
(9, 'Con1', 'asdf', '2525', 1, '2022-03-19 17:45:18', '2022-04-06 20:06:57'),
(10, 'Con1', 'asdf', 'wer', 1, '2022-03-19 18:50:55', NULL),
(11, 'Con1', 'code5', 'qwa', 1, '2022-03-19 18:53:03', NULL),
(12, 'Con2', 'code5', '123', 1, '2022-03-19 18:53:30', NULL),
(13, 'Con2', 'code5', 'qwa', 1, '2022-03-19 18:59:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `salesmanId` int(10) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(1, NULL, 'Nirav', 'Carriappa', 'cr@gmail.com', 2147483647, 2, '2022-02-07 11:44:00', '2022-03-28 22:18:48'),
(2, 1, 'Vivek 456', 'Gupta', 'vg@gmail.com', 2147483647, 1, '2022-02-07 11:45:07', '2022-03-28 22:20:33'),
(3, NULL, 'Smit', 'Patel', 'sp@gmail.com', 2147483647, 2, '2022-02-07 11:46:12', '2022-03-28 22:19:38'),
(30, NULL, 'Vivek', 'Gupta', 'vg@gmail.com', 875486577, 1, '2022-03-05 18:50:17', NULL),
(32, NULL, 'Raftaar', 'Patel', 'vg@gmail.com', 875486577, 2, '2022-03-12 18:29:38', '2022-03-12 18:34:24'),
(33, NULL, 'Vivek', 'Gupta', 'vg@gmail.com', 875486577, 1, '2022-03-15 12:02:23', NULL),
(34, NULL, 'Vivek', 'Gupta', 'vg@gmail.com', 2147483647, 1, '2022-03-15 12:28:51', '2022-03-15 12:30:32'),
(43, NULL, 'Rohan', 'Carriappa', 'rc@gmail.com', 875486577, 1, '2022-03-15 13:04:41', '2022-03-15 22:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shipping`) VALUES
(1, 1, 'address6', 258746, 'Gurgaon', 'Delhi', 'India', 1, 0),
(2, 2, 'address222', 258744, 'Ahmedabad', 'Gujarat', 'India', 1, 0),
(3, 3, 'address444', 385535, 'Deesa', 'Gujarat', 'Japan', 1, 0),
(46, 32, 'raftaar address', 258744, 'Ahmedabad', 'Gujarat', 'India', 0, 1),
(48, 34, 'address2', 258744, 'Ahmedabad', 'Gujarat', 'India', 1, 0),
(56, 43, 'address3', 385535, 'Deesa', 'Gujarat', 'India', 1, 0),
(74, 32, 'address2', 258744, 'Ahmedabad', 'Gujarat', 'India', 1, 0),
(75, 33, 'address5', 258746, 'Gurgaon', 'Delhi', 'India', 1, 0),
(79, 30, 'address3', 385535, 'Deesa', 'Gujarat', 'India', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int(10) NOT NULL,
  `customerId` int(10) DEFAULT NULL,
  `productId` int(10) DEFAULT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`entityId`, `customerId`, `productId`, `price`) VALUES
(1, 1, 1, 85),
(3, 2, 2, 90),
(4, 2, 3, 300),
(14, 2, 7, 28),
(15, 2, 8, 90),
(16, 2, 11, 100),
(17, 2, 12, 95),
(18, 2, 18, 95);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(10) NOT NULL,
  `customerId` int(10) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `mobile` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `grandTotal` float NOT NULL,
  `shippingId` int(10) NOT NULL,
  `shippingAmount` int(10) NOT NULL,
  `paymentId` int(10) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 2,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `firstName`, `lastName`, `mobile`, `email`, `grandTotal`, `shippingId`, `shippingAmount`, `paymentId`, `state`, `status`, `createdDate`) VALUES
(1, 30, 'Vivek', 'Gupta', 875486577, 'vg@gmail.com', 1070, 2, 100, 3, 1, 1, '2022-04-05 12:54:00'),
(2, 1, 'Nirav', 'Carriappa', 2147483647, 'cr@gmail.com', 1020, 3, 50, 4, 1, 1, '2022-04-09 19:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `addressId` int(10) NOT NULL,
  `orderId` int(10) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `mobile` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`addressId`, `orderId`, `firstName`, `lastName`, `mobile`, `email`, `address`, `postalCode`, `city`, `state`, `country`, `type`, `createdDate`) VALUES
(1, 1, 'Vivek', 'Gupta', 875486577, 'vg@gmail.com', 'address3', 385535, 'Deesa', 'Gujarat', 'India', 1, '2022-04-05 12:54:00'),
(2, 1, 'Vivek', 'Gupta', 875486577, 'vg@gmail.com', 'address3', 385535, 'Deesa', 'Gujarat', 'India', 2, '2022-04-05 12:54:00'),
(3, 2, 'Nirav', 'Carriappa', 2147483647, 'cr@gmail.com', 'address6', 258746, 'Gurgaon', 'Delhi', 'India', 1, '2022-04-09 19:37:55'),
(4, 2, 'Nirav', 'Carriappa', 2147483647, 'cr@gmail.com', 'address6', 258746, 'Gurgaon', 'Delhi', 'India', 2, '2022-04-09 19:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `itemId` int(10) NOT NULL,
  `orderId` int(10) NOT NULL,
  `productId` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sku` varchar(10) NOT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `taxPercentage` decimal(10,2) NOT NULL,
  `taxAmount` float NOT NULL,
  `discount` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`itemId`, `orderId`, `productId`, `name`, `sku`, `cost`, `price`, `taxPercentage`, `taxAmount`, `discount`, `quantity`, `createdDate`) VALUES
(1, 1, 11, 'Trimmer', 'arsh', 50, 100, '2.00', 0, 5, 10, '2022-04-05 12:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdDate`, `updatedDate`) VALUES
(34, 'kaval34', '34', 'content34', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'kaval35', '35', 'content35', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'kaval36', '36', 'content36', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'kaval37', '37', 'content37', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'kaval38', '38', 'content38', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'kaval39', '39', 'content39', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'kaval40', '40', 'content40', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'kaval41', '41', 'content41', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'kaval42', '42', 'content42', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'kaval43', '43', 'content43', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'kaval45', '45', 'content45', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'kaval46', '46', 'content46', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'kaval47', '47', 'content47', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'kaval48', '48', 'content48', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'kaval49', '49', 'content49', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'kaval50', '50', 'content50', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'kaval51', '51', 'content51', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'kaval52', '52', 'content52', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'kaval53', '53', 'content53', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'kaval54', '54', 'content54', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'kaval55', '55', 'content55', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'kaval56', '56', 'content56', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'kaval57', '57', 'content57', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'kaval58', '58', 'content58', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'kaval59', '59', 'content59', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'kaval60', '60', 'content60', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'kaval61', '61', 'content61', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'kaval62', '62', 'content62', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'kaval63', '63', 'content63', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'kaval64', '64', 'content64', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'kaval65', '65', 'content65', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'kaval66', '66', 'content66', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'kaval67', '67', 'content67', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'kaval68', '68', 'content68', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'kaval69', '69', 'content69', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'kaval70', '70', 'content70', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'kaval71', '71', 'content71', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'kaval72', '72', 'content72', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'kaval73', '73', 'content73', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'kaval74', '74', 'content74', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'kaval75', '75', 'content75', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'kaval76', '76', 'content76', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'kaval77', '77', 'content77', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'kaval78', '78', 'content78', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'kaval79', '79', 'content79', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'kaval80', '80', 'content80', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'kaval81', '81', 'content81', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'kaval82', '82', 'content82', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'kaval83', '83', 'content83', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'kaval84', '84', 'content84', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'kaval85', '85', 'content85', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'kaval86', '86', 'content86', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'kaval87', '87', 'content87', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'kaval88', '88', 'content88', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'kaval89', '89', 'content89', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'kaval90', '90', 'content90', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'kaval91', '91', 'content91', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'kaval92', '92', 'content92', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'kaval93', '93', 'content93', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'kaval94', '94', 'content94', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'kaval95', '95', 'content95', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'kaval96', '96', 'content96', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'kaval97', '97', 'content97', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'kaval98', '98', 'content98', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'kaval99', '99', 'content99', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'kaval100', '100', 'content100', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'kaval101', '101', 'content101', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'kaval102', '102', 'content102', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'kaval103', '103', 'content103', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'kaval104', '104', 'content104', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'kaval105', '105', 'content105', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'kaval106', '106', 'content106', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'kaval107', '107', 'content107', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'kaval108', '108', 'content108', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'kaval109', '109', 'content109', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'kaval110', '110', 'content110', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'kaval111', '111', 'content111', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'kaval112', '112', 'content112', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'kaval113', '113', 'content113', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'kaval114', '114', 'content114', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'kaval115', '115', 'content115', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'kaval116', '116', 'content116', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'kaval117', '117', 'content117', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'kaval118', '118', 'content118', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'kaval119', '119', 'content119', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'kaval120', '120', 'content120', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'kaval121', '121', 'content121', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'kaval122', '122', 'content122', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'kaval123', '123', 'content123', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'kaval124', '124', 'content124', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'kaval125', '125', 'content125', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'kaval126', '126', 'content126', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'kaval127', '127', 'content127', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'kaval128', '128', 'content128', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'kaval129', '129', 'content129', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Page2', '1234', 'content2', 1, '2022-03-19 09:47:59', NULL),
(133, 'Page2', '1234', 'content2', 1, '2022-03-19 09:50:09', NULL),
(137, 'page5', '5555', 'content45', 1, '2022-03-29 22:35:44', NULL),
(138, 'Page858', '3698', 'content45', 1, '2022-03-29 22:38:01', '2022-03-29 22:38:29'),
(139, 'page778', 'Code123', 'content123', 1, '2022-04-03 23:12:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sku` varchar(10) NOT NULL,
  `map` float(5,2) NOT NULL,
  `msp` float(5,2) NOT NULL,
  `costPrice` float(5,2) NOT NULL,
  `price` float(10,2) NOT NULL,
  `discount` float(5,2) DEFAULT NULL,
  `tax` float(5,2) DEFAULT NULL,
  `taxAmount` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `sku`, `map`, `msp`, `costPrice`, `price`, `discount`, `tax`, `taxAmount`, `quantity`, `status`, `createdDate`, `updatedDate`) VALUES
(11, 'Trimmer', 'arsh', 80.00, 0.00, 50.00, 100.00, 5.00, 2.00, 0, 10, 1, '2022-03-10 23:19:41', NULL),
(12, 'Panel Bed1', 'olkj', 80.00, 0.00, 50.00, 100.00, 10.00, 5.00, 0, 8, 1, '2022-03-10 23:20:54', '2022-03-11 00:14:55'),
(18, 'Pen4', 'awd', 80.00, 0.00, 50.00, 100.00, 10.00, 3.00, 0, 5, 1, '2022-03-10 23:44:43', NULL),
(34, 'product55', 'sku55', 80.00, 0.00, 55.00, 100.00, NULL, NULL, 0, 10, 1, '2022-04-06 22:43:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `imageId` int(10) NOT NULL,
  `productId` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `base` tinyint(2) NOT NULL DEFAULT 0,
  `thumbnail` tinyint(2) NOT NULL DEFAULT 0,
  `small` tinyint(2) NOT NULL DEFAULT 0,
  `gallery` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`imageId`, `productId`, `name`, `base`, `thumbnail`, `small`, `gallery`) VALUES
(20, 17, '20220227173651.JPG', 1, 0, 1, 1),
(22, 17, '20220227173704.JPG', 0, 1, 0, 1),
(28, 18, '20220305201039.JPG', 1, 0, 1, 1),
(29, 18, '20220305201753.JPG', 0, 1, 0, 1),
(31, 1, '20220308102704.jpg', 1, 1, 1, 1),
(33, 11, '20220321172945.jpg', 0, 0, 0, 0),
(34, 12, '20220321173023.jpg', 1, 1, 1, 1),
(35, 11, '20220405102445.jpg', 0, 0, 0, 0),
(36, 11, '20220405103006.jpg', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesmanId` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) DEFAULT NULL,
  `discount` float(5,2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `discount`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Rohan', 'Carriappa', 'rc@gmail.com', 2147483647, 10.00, 1, '2022-03-01 08:57:39', NULL),
(2, 'Smit', 'Patel', 'sp@gmail.com', 234567, 20.00, 1, '2022-03-01 08:59:18', '2022-03-04 12:45:26'),
(8, 'Vivek', 'Shah', 'vg@gmail.com', 875486577, 0.00, 1, '2022-04-04 09:37:43', '2022-04-04 09:38:42'),
(12, 'Rohan', 'Carriappa', 'rc@gmail.com', 2147483647, 10.00, 1, '2022-04-06 21:28:16', '2022-04-06 21:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int(10) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(11, 'Vivek', 'Gupta', 'vg@gmail.com', 9999, 1, '2022-03-05 21:49:55', '2022-03-05 21:50:13'),
(12, 'Krsna', 'Kaul', 'kk@gmail.com', 858585, 1, '2022-03-05 21:51:48', '2022-03-19 10:26:05'),
(18, 'Krsna', 'Shah', 'kk@gmail.com', 975486577, 2, '2022-03-12 17:38:43', '2022-03-12 18:01:47'),
(19, 'Vivek', 'Ramanandi', 'vg@gmail.com', 875486577, 2, '2022-03-12 17:53:55', NULL),
(20, 'Smit', 'Patel', 'sp@gmail.com', 875486577, 1, '2022-03-12 17:58:51', NULL),
(21, 'Smit', 'Patel', 'sp@gmail.com', 875486577, 1, '2022-03-12 18:02:57', NULL),
(22, 'Raju', 'Kaul', 'kk@gmail.com', 975486577, 1, '2022-03-12 18:04:26', '2022-03-12 18:04:51'),
(23, 'Ram', 'Gupta', 'vg@gmail.com', 875486577, 1, '2022-03-15 12:19:02', '2022-03-15 12:26:37'),
(24, 'Rohan', 'Carriappa', 'rc@gmail.com', 875486577, 1, '2022-03-19 10:01:17', NULL),
(25, 'Ramprasad', 'Gupta', 'vg@gmail.com', 875486577, 1, '2022-03-19 10:03:15', '2022-03-19 11:22:33'),
(44, 'Vivek', 'Gupta', 'vg@gmail.com', 875486577, 1, '2022-03-19 11:23:42', NULL),
(45, 'Rohan', 'Carriappa', 'rc@gmail.com', 875486577, 1, '2022-03-19 11:24:55', '2022-03-19 11:25:17'),
(46, 'Mahesh', 'Carriappa', 'rc@gmail.com', 875486577, 1, '2022-03-19 11:27:26', '2022-03-19 11:27:51'),
(47, 'Rohan', 'Carriappa', 'rc@gmail.com', 875486577, 1, '2022-04-05 18:13:09', NULL),
(48, 'Nirav', 'Carriappa', 'rc@gmail.com', 2147483647, 1, '2022-04-05 18:14:04', NULL),
(49, 'Ram', 'Prajapati', 'rp@gmail.com', 789456123, 1, '2022-04-05 18:18:24', NULL),
(50, 'first', 'last', 'mail@gmail.com', 45632178, 1, '2022-04-06 01:22:16', NULL),
(51, 'Rishabh', 'Arora', 'ra@gmail.com', 878787878, 1, '2022-04-06 01:30:57', NULL),
(52, 'Vivek', 'Gupta', 'vg@gmail.com', 2147483647, 1, '2022-04-06 01:32:32', NULL),
(53, 'Krsna', 'Kaul', 'kk@gmail.com', 2147483647, 1, '2022-04-06 01:33:54', NULL),
(54, 'Vivek', 'Gupta', 'vg@gmail.com', 2147483647, 1, '2022-04-06 01:35:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `addressId` int(10) NOT NULL,
  `vendorId` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`addressId`, `vendorId`, `address`, `postalCode`, `city`, `state`, `country`) VALUES
(11, 11, 'address2', 8888, 'Ahmedabad', 'Gujarat', 'India'),
(12, 12, 'address5', 6666, 'Gurgaon', 'Mumbai', 'India'),
(14, 18, 'krsna address', 258746, 'Gurgaon', 'Delhi', 'India'),
(16, 22, 'Raju house', 258746, 'Gurgaon', 'Delhi', 'India'),
(17, 23, 'okk', 258744, 'Palanpur', 'Gujarat', 'India'),
(18, 25, 'Address234', 258744, 'Ahmedabad', 'Gujarat', 'India'),
(20, 45, 'address6', 258746, 'Gurgaon', 'Delhi', 'India'),
(21, 46, 'address456', 258746, 'Gurgaon', 'Delhi', 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`addressId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `cart_payment`
--
ALTER TABLE `cart_payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `cart_shipping`
--
ALTER TABLE `cart_shipping`
  ADD PRIMARY KEY (`shippingId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `category` (`parentId`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `foreign_category_media` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `salesmanId` (`salesmanId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `foreign key` (`customerId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `shippingId` (`shippingId`),
  ADD KEY `paymentId` (`paymentId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemId`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `foreign` (`productId`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesmanId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `addressId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_payment`
--
ALTER TABLE `cart_payment`
  MODIFY `paymentId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_shipping`
--
ALTER TABLE `cart_shipping`
  MODIFY `shippingId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `imageId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `category` FOREIGN KEY (`parentId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `foreign_category_media` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`);

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`salesmanId`) REFERENCES `salesman` (`salesmanId`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `foreign key` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customer_price_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_price_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shippingId`) REFERENCES `cart_shipping` (`shippingId`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`paymentId`) REFERENCES `cart_payment` (`paymentId`);

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
