-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 05:54 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fos`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `foodId` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'In Menu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodId`, `name`, `price`, `description`, `image`, `status`) VALUES
(12, 'Best Burger', '6.12', 'Classic burger with quarter pound beef, lettuce and cheese', 'Food-Name-6340.jpg', 'In Menu'),
(13, 'Smoky BBQ Pizza', '7.00', 'Pizza consisting of BBQ sauce, meaty chicken, cheese and a dash of cilantro', '698a8648b00975991d3b4c515dec21ec.jpg', 'In Menu'),
(14, 'Sadheko Momo', '6.35', 'Spicy vegetable momo (dumplings) mixed with spices such as garlic, red onions, cumin, coriander and chiles', 'Food-Name-7387.jpg', 'In Menu'),
(18, 'Garlic Bread Set', '3.58', 'Garlic bread with homemade dipping sauce', '61eb3496bcfa0ae732c25c6657e8a0b7.jpg', 'In Menu'),
(19, 'Vegetarian Minestrone Soup', '4.00', 'The core ingredients are celery, onions, garlic, carrots, tomatoes, olive oil, and pasta topped with parmesan cheese', 'da3fd85f85aa2276ab1bbdbfd977c8fc.jpg', 'In Menu'),
(21, 'Spaghetti Bolognese', '5.50', 'Consists of spaghetti with an Italian ragù (meat sauce) made with minced beef, bacon and tomatoes, served with Parmesan cheese', 'a38495d87fc2e423c68597913b0f1761.png', 'In Menu'),
(22, 'Mushroom Risotto', '4.50', 'Classic mushroom risotto, a creamy dish with nearly a porridge-like consistency. Consists of mushrooms, butter, onions, a touch of wine, medium-grain rice and chicken broth', '5b2c7cadefb8b3a79137dcb0b20d139c.png', 'In Menu'),
(23, 'Salmon Fillet', '5.00', 'Pan seared salmon fillet seasoned with salt and pepper', '2e9137714e04984e9577b627eb0c06c8.jpg', 'In Menu'),
(24, 'Baked Ravioli', '4.50', 'Cheesy baked ravioli toossed with pasta sauce and Italian sausage, topped with parmesan and mozzarella', 'bd58aea87f21aedd84cc246a6121586f.png', 'In Menu'),
(25, 'Beef Lasagna', '6.00', 'Beef lasagna that includes layers of slow cooked bolognese sauce and cheesy bachamel sauce', 'cd8fc68a72f14fc215936f5c47b1642c.png', 'In Menu');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(10) UNSIGNED NOT NULL,
  `customerEmail` varchar(255) NOT NULL,
  `tableNo` int(5) NOT NULL,
  `orderDate` date NOT NULL,
  `orderStatus` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerEmail`, `tableNo`, `orderDate`, `orderStatus`) VALUES
(15, 'john@gmail.com', 2, '2022-05-09', 'Completed'),
(16, 'john@gmail.com', 5, '2022-04-13', 'Completed'),
(17, 'jill@gmail.com', 12, '2022-05-01', 'Completed'),
(18, 'john@gmail.com', 5, '2022-05-13', 'Completed'),
(19, 'jill@gmail.com', 17, '2022-05-11', 'Completed'),
(20, 's1213@lala.com', 7, '2022-05-15', 'Completed'),
(21, 's261@lala.com', 4, '2022-05-15', 'Completed'),
(22, 's123@lala.com', 12, '2022-05-15', 'Completed'),
(23, 'aaa@gmail.com', 1, '2022-05-21', 'Completed'),
(24, '22@gmail.com', 9, '2022-05-21', 'Pending'),
(25, '123@gmail.com', 12, '2022-05-21', 'Pending'),
(26, 'z2z@gmail.com', 32, '2022-05-21', 'Pending'),
(27, 'z211@gmail.com', 22, '2022-05-21', 'Pending'),
(28, '12322@gmail.com', 5, '2022-05-21', 'Pending'),
(29, 'f22@gmail.com', 7, '2022-05-21', 'Pending'),
(30, '23zz@gmail.com', 11, '2022-05-21', 'Pending'),
(31, 'f223@gmail.com', 2, '2022-05-17', 'Pending'),
(32, 'z2z2@gmail.com', 13, '2022-05-30', 'Pending'),
(33, '22@gmail.com', 23, '2022-05-24', 'Pending'),
(34, 'f22@gmail.com', 5, '2022-05-21', 'Pending'),
(35, 'z2z@gmail.com', 3, '2022-05-21', 'Pending'),
(36, '123@gmail.com', 13, '2022-05-21', 'Pending'),
(37, '22@gmail.com', 2, '2022-04-06', 'Pending'),
(38, 'f22@gmail.com', 12, '2022-04-06', 'Pending'),
(39, 'z2z2@gmail.com', 12, '2022-04-04', 'Pending'),
(40, 'z2z2@gmail.com', 23, '2022-05-21', 'Pending'),
(41, 'aaa@gmail.com', 13, '2022-04-18', 'Pending'),
(42, '12322@gmail.com', 2, '2022-04-12', 'Pending'),
(43, 'zz@gmail.com', 13, '2022-04-13', 'Pending'),
(44, 'a23aa@gmail.com', 13, '2022-04-13', 'Pending'),
(45, '12322@gmail.com', 11, '2022-04-14', 'Pending'),
(46, 'z2z@gmail.com', 5, '2022-04-17', 'Pending'),
(47, 'f222@gmail.com', 12, '2022-04-17', 'Pending'),
(48, '222@gmail.com', 9, '2022-04-18', 'Pending'),
(49, 'z2z@gmail.com', 9, '2022-04-18', 'Pending'),
(50, '22@gmail.com', 12, '2022-04-18', 'Pending'),
(51, 'f1122@gmail.com', 11, '2022-04-19', 'Pending'),
(52, 'z2z@gmail.com', 12, '2022-04-19', 'Pending'),
(53, '22@gmail.com', 11, '2022-04-20', 'Pending'),
(54, 'f22@gmail.com', 11, '2022-04-23', 'Pending'),
(55, '123@gmail.com', 9, '2022-05-21', 'Pending'),
(56, '12322@gmail.com', 1, '2022-04-23', 'Pending'),
(57, 'z2z@gmail.com', 23, '2022-05-21', 'Pending'),
(58, 'f22@gmail.com', 13, '2022-04-25', 'Pending'),
(59, '22@gmail.com', 1, '2022-04-26', 'Pending'),
(60, 'z2z@gmail.com', 11, '2022-05-21', 'Pending'),
(61, 'f22@gmail.com', 12, '2022-05-21', 'Pending'),
(62, '12322@gmail.com', 14, '2022-04-28', 'Pending'),
(63, '12322@gmail.com', 13, '2022-05-21', 'Pending'),
(64, '123221@gmail.com', 5, '2022-05-21', 'Pending'),
(65, '1231@gmail.com', 5, '2022-05-20', 'Pending'),
(66, '122t31@gmail.com', 3, '2022-05-21', 'Pending'),
(67, '22@gmail.com', 11, '2022-05-21', 'Pending'),
(68, '122t31@gmail.com', 23, '2022-05-21', 'Pending'),
(69, 'f22@gmail.com', 18, '2022-05-18', 'Pending'),
(70, '22@gmail.com', 6, '2022-05-16', 'Pending'),
(71, 'f2232@gmail.com', 5, '2022-05-14', 'Pending'),
(72, 'z12z@gmail.com', 9, '2022-05-13', 'Pending'),
(73, '122322@gmail.com', 7, '2022-05-06', 'Pending'),
(74, '122322@gmail.com', 5, '2022-05-04', 'Pending'),
(75, '12h322@gmail.com', 11, '2022-05-17', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `orderId` int(10) UNSIGNED NOT NULL,
  `foodName` varchar(255) NOT NULL,
  `unitPrice` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderId`, `foodName`, `unitPrice`, `quantity`, `totalPrice`, `status`) VALUES
(20, 15, 'Dumpling Specials', '5.50', 1, '5.50', 'Completed'),
(21, 15, 'Best Burger', '6.12', 4, '24.48', 'Completed'),
(22, 16, 'Dumpling Specials', '5.50', 3, '16.50', 'Completed'),
(23, 16, 'Sadeko Momo', '6.35', 4, '25.40', 'Completed'),
(24, 17, 'Dumpling Specials', '5.50', 5, '27.50', 'Completed'),
(25, 17, 'Best Burger', '6.12', 4, '24.48', 'Completed'),
(26, 17, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Completed'),
(27, 17, 'Sadeko Momo', '6.35', 7, '44.45', 'Completed'),
(28, 18, 'Dumpling Specials', '5.50', 4, '22.00', 'Completed'),
(29, 18, 'Best Burger', '6.12', 4, '24.48', 'Completed'),
(30, 19, 'Best Burger', '6.12', 5, '30.60', 'Completed'),
(31, 19, 'Dumpling Specials', '5.50', 5, '27.50', 'Completed'),
(32, 19, 'Sadeko Momo', '6.35', 5, '31.75', 'Completed'),
(33, 20, 'Dumpling Specials', '5.50', 3, '16.50', 'Completed'),
(34, 20, 'Vegetarian Minestrone Soup', '4.00', 8, '32.00', 'Completed'),
(35, 20, 'Sadeko Momo', '6.35', 4, '25.40', 'Completed'),
(36, 21, 'Smoky BBQ Pizza', '7.00', 5, '35.00', 'Completed'),
(37, 21, 'Garlic Bread Set', '3.58', 9, '32.22', 'Completed'),
(38, 22, 'Smoky BBQ Pizza', '7.00', 9, '63.00', 'Completed'),
(39, 22, 'Vegetarian Minestrone Soup', '4.00', 9, '36.00', 'Completed'),
(40, 22, 'Best Burger', '6.12', 6, '36.72', 'Completed'),
(41, 23, 'Dumpling Specials', '5.50', 1, '5.50', 'Completed'),
(42, 24, 'Sadeko Momo', '6.35', 2, '12.70', 'Pending'),
(43, 24, 'Vegetarian Minestrone Soup', '4.00', 1, '4.00', 'Pending'),
(44, 24, 'Best Burger', '6.12', 6, '36.72', 'Pending'),
(45, 25, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(46, 26, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending'),
(47, 27, 'Smoky BBQ Pizza', '7.00', 3, '21.00', 'Pending'),
(48, 28, 'Sadeko Momo', '6.35', 2, '12.70', 'Pending'),
(49, 29, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(50, 30, 'Smoky BBQ Pizza', '7.00', 2, '14.00', 'Pending'),
(51, 30, 'Vegetarian Minestrone Soup', '4.00', 2, '8.00', 'Pending'),
(52, 31, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(53, 31, 'Smoky BBQ Pizza', '7.00', 2, '14.00', 'Pending'),
(54, 31, 'Best Burger', '6.12', 1, '6.12', 'Pending'),
(55, 32, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(56, 32, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(57, 32, 'Dumpling Specials', '5.50', 2, '11.00', 'Pending'),
(58, 33, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(59, 34, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(60, 34, 'Vegetarian Minestrone Soup', '4.00', 5, '20.00', 'Pending'),
(61, 35, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(62, 36, 'Vegetarian Minestrone Soup', '4.00', 2, '8.00', 'Pending'),
(63, 37, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(64, 38, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending'),
(65, 39, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(66, 40, 'Vegetarian Minestrone Soup', '4.00', 1, '4.00', 'Pending'),
(67, 41, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(68, 42, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(69, 43, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(70, 44, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(71, 44, 'Smoky BBQ Pizza', '7.00', 2, '14.00', 'Pending'),
(72, 45, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(73, 45, 'Vegetarian Minestrone Soup', '4.00', 1, '4.00', 'Pending'),
(74, 46, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending'),
(75, 47, 'Best Burger', '6.12', 1, '6.12', 'Pending'),
(76, 48, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(77, 49, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending'),
(78, 49, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(79, 50, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(80, 51, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending'),
(81, 51, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(82, 51, 'Vegetarian Minestrone Soup', '4.00', 1, '4.00', 'Pending'),
(83, 52, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(84, 53, 'Best Burger', '6.12', 1, '6.12', 'Pending'),
(85, 54, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(86, 55, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(87, 56, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(88, 57, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(89, 58, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending'),
(90, 59, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(91, 60, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(92, 61, 'Best Burger', '6.12', 1, '6.12', 'Pending'),
(93, 62, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending'),
(94, 62, 'Best Burger', '6.12', 2, '12.24', 'Pending'),
(95, 63, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(96, 64, 'Vegetarian Minestrone Soup', '4.00', 1, '4.00', 'Pending'),
(97, 65, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(98, 66, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(99, 66, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(100, 67, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(101, 68, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(102, 69, 'Sadeko Momo', '6.35', 1, '6.35', 'Pending'),
(103, 70, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(104, 70, 'Best Burger', '6.12', 3, '18.36', 'Pending'),
(105, 71, 'Vegetarian Minestrone Soup', '4.00', 1, '4.00', 'Pending'),
(106, 72, 'Smoky BBQ Pizza', '7.00', 1, '7.00', 'Pending'),
(107, 72, 'Vegetarian Minestrone Soup', '4.00', 1, '4.00', 'Pending'),
(108, 72, 'Garlic Bread Set', '3.58', 1, '3.58', 'Pending'),
(109, 72, 'Best Burger', '6.12', 3, '18.36', 'Pending'),
(110, 72, 'Dumpling Specials', '5.50', 6, '33.00', 'Pending'),
(111, 73, 'Smoky BBQ Pizza', '7.00', 12, '84.00', 'Pending'),
(112, 74, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending'),
(113, 74, 'Best Burger', '6.12', 1, '6.12', 'Pending'),
(114, 75, 'Dumpling Specials', '5.50', 1, '5.50', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `name`, `status`) VALUES
(1, 'User Administrator', 'Active'),
(2, 'Restaurant Staff', 'Active'),
(3, 'Restaurant Manager', 'Active'),
(4, 'Restaurant Owner', 'Active'),
(8, 'Restaurant Cleaner', 'Suspended'),
(9, '113', 'Suspended'),
(10, 'foo10', 'Active'),
(11, 'foo11', 'Active'),
(12, 'foo12', 'Active'),
(13, 'foo13', 'Active'),
(14, 'foo14', 'Suspended'),
(15, 'foo15', 'Suspended'),
(16, 'foo16', 'Suspended'),
(17, 'foo17', 'Suspended'),
(18, 'foo18', 'Active'),
(19, 'foo19', 'Active'),
(20, 'foo20', 'Active'),
(21, 'foo21', 'Active'),
(22, 'foo22', 'Active'),
(23, 'foo23', 'Active'),
(24, 'foo24', 'Active'),
(25, 'foo25', 'Suspended'),
(26, 'foo26', 'Suspended'),
(27, 'foo27', 'Suspended'),
(28, 'foo28', 'Suspended'),
(29, 'foo29', 'Suspended'),
(30, 'foo30', 'Active'),
(31, 'foo31', 'Active'),
(32, 'foo32', 'Suspended'),
(33, 'foo33', 'Suspended'),
(34, 'foo34', 'Suspended'),
(35, 'foo35', 'Active'),
(36, 'foo36', 'Active'),
(37, 'foo37', 'Suspended'),
(38, 'foo38', 'Suspended'),
(39, 'foo39', 'Suspended'),
(40, 'foo40', 'Suspended'),
(41, 'foo41', 'Active'),
(42, 'foo42', 'Active'),
(43, 'foo43', 'Active'),
(44, 'foo44', 'Active'),
(45, 'foo45', 'Suspended'),
(46, 'foo46', 'Suspended'),
(47, 'foo47', 'Suspended'),
(48, 'foo48', 'Active'),
(49, 'foo49', 'Active'),
(50, 'foo50', 'Suspended'),
(51, 'foo51', 'Active'),
(52, 'foo52', 'Active'),
(53, 'foo53', 'Active'),
(54, 'foo54', 'Suspended'),
(55, 'foo55', 'Suspended'),
(56, 'foo56', 'Active'),
(57, 'foo57', 'Active'),
(58, 'foo58', 'Active'),
(59, 'foo59', 'Active'),
(60, 'foo60', 'Suspended'),
(61, 'foo61', 'Active'),
(62, 'foo62', 'Suspended'),
(63, 'foo63', 'Active'),
(64, 'foo64', 'Suspended'),
(65, 'foo65', 'Active'),
(66, 'foo66', 'Active'),
(67, 'foo67', 'Suspended'),
(68, 'foo68', 'Active'),
(69, 'foo69', 'Active'),
(70, 'foo70', 'Suspended'),
(71, 'foo71', 'Suspended'),
(72, 'foo72', 'Suspended'),
(73, 'foo73', 'Suspended'),
(74, 'foo74', 'Active'),
(75, 'foo75', 'Suspended'),
(76, 'foo76', 'Suspended'),
(77, 'foo77', 'Active'),
(78, 'foo78', 'Suspended'),
(79, 'foo79', 'Active'),
(80, 'foo80', 'Active'),
(81, 'foo81', 'Suspended'),
(82, 'foo82', 'Active'),
(83, 'foo83', 'Active'),
(84, 'foo84', 'Active'),
(85, 'foo85', 'Active'),
(86, 'foo86', 'Active'),
(87, 'foo87', 'Active'),
(88, 'foo88', 'Active'),
(89, 'foo89', 'Suspended'),
(90, 'foo90', 'Active'),
(91, 'foo91', 'Suspended'),
(92, 'foo92', 'Suspended'),
(93, 'foo93', 'Active'),
(94, 'foo94', 'Active'),
(95, 'foo95', 'Suspended'),
(96, 'foo96', 'Suspended'),
(97, 'foo97', 'Suspended'),
(98, 'foo98', 'Suspended'),
(99, 'foo99', 'Active'),
(100, 'foo100', 'Active'),
(101, 'foo101', 'Suspended'),
(102, 'foo102', 'Suspended'),
(103, 'foo103', 'Active'),
(104, 'foo104', 'Active'),
(105, 'foo105', 'Active'),
(106, 'foo106', 'Suspended'),
(107, 'foo107', 'Active'),
(108, 'foo108', 'Active'),
(109, 'foo109', 'Active'),
(110, 'foo110', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userroleId` int(10) UNSIGNED NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `userroleId`, `status`) VALUES
(1, 'Tim', 'user221', 'passwordd', 2, 'Active'),
(2, 'Matt', 'user92', 'passwordd', 3, 'Active'),
(3, 'Tom', 'user13', 'passwordd', 1, 'Active'),
(4, 'Matt', 'user84', 'passwordd', 8, 'Suspended'),
(5, 'Addy', 'user45', 'passwordd', 4, 'Suspended'),
(6, 'Addy', 'user26', 'passwordd', 2, 'Active'),
(7, 'Mark', 'user17', 'passwordd', 1, 'Suspended'),
(8, 'James', 'user98', 'passwordd', 9, 'Active'),
(9, 'God', 'user99', 'passwordd', 9, 'Active'),
(10, 'Anthony', 'user410', 'passwordd', 4, 'Suspended'),
(11, 'Jacob', 'user111', 'passwordd', 1, 'Active'),
(12, 'Tom', 'user812', 'passwordd', 8, 'Suspended'),
(13, 'Tom', 'user213', 'passwordd', 2, 'Suspended'),
(14, 'God', 'user214', 'passwordd', 2, 'Active'),
(15, 'Mark', 'user115', 'passwordd', 1, 'Suspended'),
(16, 'Matt', 'user816', 'passwordd', 8, 'Active'),
(17, 'God', 'user817', 'passwordd', 8, 'Suspended'),
(18, 'Tom', 'user818', 'passwordd', 8, 'Suspended'),
(19, 'Peter', 'user119', 'passwordd', 1, 'Active'),
(20, 'Mas', 'user820', 'passwordd', 8, 'Suspended'),
(21, 'Matt', 'user821', 'passwordd', 8, 'Active'),
(22, 'Selamat', 'user222', 'passwordd', 2, 'Suspended'),
(23, 'Anthony', 'user823', 'passwordd', 8, 'Active'),
(24, 'Tim', 'user824', 'passwordd', 8, 'Active'),
(25, 'Mas', 'user425', 'passwordd', 4, 'Suspended'),
(26, 'Addy', 'user226', 'passwordd', 2, 'Suspended'),
(27, 'God', 'user427', 'passwordd', 4, 'Suspended'),
(28, 'Parry', 'user928', 'passwordd', 9, 'Suspended'),
(29, 'God', 'user829', 'passwordd', 8, 'Active'),
(30, 'Parry', 'user930', 'passwordd', 9, 'Active'),
(31, 'Tom', 'user931', 'passwordd', 9, 'Active'),
(32, 'Tim', 'user132', 'passwordd', 1, 'Suspended'),
(33, 'Anthony', 'user233', 'passwordd', 2, 'Suspended'),
(34, 'Anthony', 'user434', 'passwordd', 4, 'Active'),
(35, 'Jacob', 'user435', 'passwordd', 4, 'Active'),
(36, 'Mark', 'user936', 'passwordd', 9, 'Suspended'),
(37, 'Mas', 'user437', 'passwordd', 4, 'Active'),
(38, 'Mas', 'user938', 'passwordd', 9, 'Suspended'),
(39, 'Selamat', 'user239', 'passwordd', 2, 'Suspended'),
(40, 'God', 'user940', 'passwordd', 9, 'Active'),
(41, 'Matt', 'user941', 'passwordd', 9, 'Active'),
(42, 'Tom', 'user442', 'passwordd', 4, 'Suspended'),
(43, 'Matt', 'user143', 'passwordd', 1, 'Active'),
(44, 'John', 'user844', 'passwordd', 8, 'Active'),
(45, 'Mas', 'user445', 'passwordd', 4, 'Suspended'),
(46, 'Addy', 'user946', 'passwordd', 9, 'Suspended'),
(47, 'Selamat', 'user947', 'passwordd', 9, 'Suspended'),
(48, 'Peter', 'user948', 'passwordd', 9, 'Suspended'),
(49, 'Mark', 'user849', 'passwordd', 8, 'Suspended'),
(50, 'James', 'user450', 'passwordd', 4, 'Active'),
(51, 'God', 'user951', 'passwordd', 9, 'Suspended'),
(52, 'Anthony', 'user852', 'passwordd', 8, 'Suspended'),
(53, 'Anthony', 'user453', 'passwordd', 4, 'Active'),
(54, 'Jacob', 'user954', 'passwordd', 9, 'Suspended'),
(55, 'Matt', 'user955', 'passwordd', 9, 'Suspended'),
(56, 'Jacob', 'user956', 'passwordd', 9, 'Active'),
(57, 'Tom', 'user157', 'passwordd', 1, 'Suspended'),
(58, 'Matt', 'user158', 'passwordd', 1, 'Suspended'),
(59, 'Peter', 'user859', 'passwordd', 8, 'Active'),
(60, 'God', 'user160', 'passwordd', 1, 'Suspended'),
(61, 'Peter', 'user461', 'passwordd', 4, 'Active'),
(62, 'Mas', 'user862', 'passwordd', 8, 'Suspended'),
(63, 'James', 'user863', 'passwordd', 8, 'Active'),
(64, 'God', 'user164', 'passwordd', 1, 'Active'),
(65, 'Tom', 'user965', 'passwordd', 9, 'Active'),
(66, 'Mark', 'user466', 'passwordd', 4, 'Active'),
(67, 'Tim', 'user467', 'passwordd', 4, 'Suspended'),
(68, 'John', 'user468', 'passwordd', 4, 'Active'),
(69, 'Anthony', 'user169', 'passwordd', 1, 'Suspended'),
(70, 'Selamat', 'user470', 'passwordd', 4, 'Active'),
(71, 'Tom', 'user271', 'passwordd', 2, 'Active'),
(72, 'James', 'user272', 'passwordd', 2, 'Active'),
(73, 'Tom', 'user473', 'passwordd', 4, 'Active'),
(74, 'John', 'user874', 'passwordd', 8, 'Suspended'),
(75, 'Mark', 'user975', 'passwordd', 9, 'Suspended'),
(76, 'Mark', 'user476', 'passwordd', 4, 'Active'),
(77, 'Peter', 'user977', 'passwordd', 9, 'Suspended'),
(78, 'Matt', 'user878', 'passwordd', 8, 'Active'),
(79, 'Selamat', 'user179', 'passwordd', 1, 'Suspended'),
(80, 'Jacob', 'user880', 'passwordd', 8, 'Suspended'),
(81, 'John', 'user881', 'passwordd', 8, 'Active'),
(82, 'Matt', 'user282', 'passwordd', 2, 'Active'),
(83, 'Selamat', 'user283', 'passwordd', 2, 'Suspended'),
(84, 'Tim', 'user884', 'passwordd', 8, 'Active'),
(95, 'Tim', 'user495', 'passwordd', 4, 'Active'),
(96, 'Tom', 'user496', 'passwordd', 4, 'Suspended'),
(97, 'John', 'user297', 'passwordd', 2, 'Active'),
(98, 'Tim', 'user198', 'passwordd', 1, 'Suspended'),
(99, 'Selamat', 'user899', 'passwordd', 8, 'Suspended'),
(100, 'Tim', 'user8100', 'passwordd', 8, 'Active'),
(101, 'Stave', 'teststaff1', 'passwordd', 2, 'Active'),
(102, 'Admin', 'testadmin2', 'passwordd', 1, 'Active'),
(103, 'Owner', 'testowner', 'passwordd', 4, 'Active'),
(104, 'Man', 'testmanager', 'passwordd', 3, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_id` (`orderId`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_userprofile` (`userroleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_orders_id` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_userprofile` FOREIGN KEY (`userroleId`) REFERENCES `userprofile` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
