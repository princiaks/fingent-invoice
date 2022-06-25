-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 11:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pomoservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carted_item_details`
--

CREATE TABLE `tbl_carted_item_details` (
  `id` int(11) NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `product_id` varchar(15) NOT NULL,
  `restaurant_id` int(15) NOT NULL,
  `product_name` varchar(35) NOT NULL,
  `product_price` varchar(15) NOT NULL,
  `product_variant` varchar(20) NOT NULL,
  `product_count` varchar(15) NOT NULL,
  `product_total` varchar(20) NOT NULL,
  `product_image` varchar(300) NOT NULL,
  `type` varchar(30) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_charge_master`
--

CREATE TABLE `tbl_delivery_charge_master` (
  `id` int(11) NOT NULL,
  `range_from` float NOT NULL,
  `range_to` float NOT NULL,
  `charge` float NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(5) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_delivery_charge_master`
--

INSERT INTO `tbl_delivery_charge_master` (`id`, `range_from`, `range_to`, `charge`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(21, 0, 2.5, 30, '', 0, '2022-03-14 00:05:12', '2022-03-14 00:05:12'),
(22, 2.5, 5, 50, '', 0, '2022-03-14 00:05:12', '2022-03-14 00:05:12'),
(23, 5, 7.5, 65, '', 0, '2022-03-14 00:05:12', '2022-03-14 00:05:12'),
(24, 7.5, 10, 100, '', 0, '2022-03-14 00:05:12', '2022-03-14 00:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_additional_details`
--

CREATE TABLE `tbl_food_additional_details` (
  `id` int(20) NOT NULL,
  `restaurant_id` int(15) NOT NULL,
  `food_id` int(20) NOT NULL,
  `variant_id` int(20) NOT NULL,
  `actual_price` varchar(20) NOT NULL,
  `selling_price` varchar(20) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `franchise_id` int(20) NOT NULL,
  `status` varchar(25) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_addons`
--

CREATE TABLE `tbl_food_addons` (
  `id` int(20) NOT NULL,
  `restaurant_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `mrp` varchar(20) NOT NULL,
  `selling_price` varchar(20) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `order_limit` varchar(15) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `franchise_id` int(20) NOT NULL,
  `status` varchar(25) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food_addons`
--

INSERT INTO `tbl_food_addons` (`id`, `restaurant_id`, `name`, `description`, `mrp`, `selling_price`, `discount`, `order_limit`, `image_url`, `franchise_id`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 1, 'addon1', '', '25', '20', '20', '6', 'ADDONS_16452965109.png', 0, 'Deleted', 1, '2022-02-20 00:18:30', '2022-02-20 00:42:53'),
(2, 1, 'addon2', '', '26', '20', '23', '12', 'ADDONS_16452972876.png', 0, 'In Stock', 1, '2022-02-20 00:31:27', '2022-02-20 00:31:27'),
(3, 5, 'tomato ketchup, mayonnaise', 'short description about..........', '10', '5', '50', '5', 'ADDONS_16457331619.jpg', 0, 'Deleted', 1, '2022-02-25 01:36:01', '2022-03-15 23:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_categories`
--

CREATE TABLE `tbl_food_categories` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_category_master`
--

CREATE TABLE `tbl_food_category_master` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `image_url` varchar(250) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food_category_master`
--

INSERT INTO `tbl_food_category_master` (`id`, `name`, `slug`, `image_url`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 'Snacks', '', 'MASCAT_16443502514.jpg', 'Deleted', 1, '2022-02-09 01:27:31', '2022-02-25 00:57:51'),
(2, 'Manish', '', 'MASCAT_16445263424.jpg', 'Deleted', 1, '2022-02-11 02:22:22', '2022-02-25 00:57:47'),
(3, 'Coffee', 'coffee', 'MASCAT_16457311481.png', 'Deleted', 13, '2022-02-25 01:02:28', '2022-03-15 23:12:12'),
(4, 'Breakfast', 'breakfast', 'MASCAT_16457311776.png', 'Deleted', 13, '2022-02-25 01:02:57', '2022-03-15 23:12:09'),
(5, 'Burger', 'burger', 'MASCAT_16457311928.png', 'Deleted', 13, '2022-02-25 01:03:12', '2022-03-15 23:12:06'),
(6, 'cola can', 'cola-can', 'MASCAT_16457312096.png', 'Deleted', 13, '2022-02-25 01:03:29', '2022-03-15 23:12:04'),
(7, 'Fries', 'fries', 'MASCAT_16457312290.png', 'Deleted', 13, '2022-02-25 01:03:49', '2022-03-15 23:12:01'),
(8, 'pizza', 'pizza', 'MASCAT_16457312428.png', 'Deleted', 13, '2022-02-25 01:04:02', '2022-03-15 23:11:58'),
(9, 'steak', 'steak', 'MASCAT_16457312533.png', 'Deleted', 13, '2022-02-25 01:04:13', '2022-03-15 23:11:55'),
(10, 'Arabian', 'arabian', 'MASCAT_16473661673.jpg', 'Active', 1, '2022-03-15 23:12:47', '2022-03-15 23:12:47'),
(11, 'biriyani web', 'biriyani-web', 'MASCAT_16473661966.jpg', 'Active', 1, '2022-03-15 23:13:16', '2022-03-15 23:13:16'),
(12, 'breakfast', 'breakfast', 'MASCAT_16473662160.jpg', 'Active', 1, '2022-03-15 23:13:36', '2022-03-15 23:13:36'),
(13, 'burger', 'burger', 'MASCAT_16473662281.jpg', 'Active', 1, '2022-03-15 23:13:48', '2022-03-15 23:13:48'),
(14, 'Juices', 'juices', 'MASCAT_16473662414.jpg', 'Active', 1, '2022-03-15 23:14:01', '2022-03-15 23:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_offer_details`
--

CREATE TABLE `tbl_food_offer_details` (
  `id` int(20) NOT NULL,
  `restaurant_id` int(20) NOT NULL,
  `food_category_id` int(20) NOT NULL,
  `variant_id` int(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `actual_price` varchar(15) NOT NULL,
  `offer_price` varchar(15) NOT NULL,
  `discount` varchar(15) NOT NULL,
  `stock` varchar(15) NOT NULL,
  `no_of_usage` varchar(15) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `franchise_id` int(20) NOT NULL,
  `status` varchar(25) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_offer_user_details`
--

CREATE TABLE `tbl_food_offer_user_details` (
  `id` int(20) NOT NULL,
  `restaurant_id` int(15) NOT NULL,
  `food_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `no_of_usage` int(15) NOT NULL,
  `status` varchar(25) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_products`
--

CREATE TABLE `tbl_food_products` (
  `id` int(20) NOT NULL,
  `restaurant_id` int(15) NOT NULL,
  `food_category_id` int(20) NOT NULL,
  `veg_nonveg_status` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `franchise_id` int(20) NOT NULL,
  `featured_status` int(15) NOT NULL COMMENT '1-featured,0-not featured',
  `trending_status` int(2) NOT NULL DEFAULT 0,
  `add_to_home` int(10) NOT NULL DEFAULT 0,
  `order_limit` varchar(15) NOT NULL,
  `coins` float NOT NULL,
  `mrp` double NOT NULL,
  `selling_price` double NOT NULL,
  `discount` varchar(15) NOT NULL,
  `addons` varchar(500) NOT NULL,
  `visibility` int(2) NOT NULL DEFAULT 1 COMMENT '1-on,0-off',
  `opening_time` varchar(30) NOT NULL,
  `closing_time` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food_products`
--

INSERT INTO `tbl_food_products` (`id`, `restaurant_id`, `food_category_id`, `veg_nonveg_status`, `name`, `slug`, `description`, `image_url`, `franchise_id`, `featured_status`, `trending_status`, `add_to_home`, `order_limit`, `coins`, `mrp`, `selling_price`, `discount`, `addons`, `visibility`, `opening_time`, `closing_time`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 1, 1, 'veg', 'test', '', '', 'FOOD_16450349791.jpg', 0, 0, 0, 0, '10', 0, 45, 40, '', '', 0, '', '', 'Deleted', 1, '2022-02-16 23:39:39', '2022-03-09 05:19:05'),
(2, 1, 2, 'non_veg', 'xcxzcz', '', 'ZxZX', 'FOOD_16450351294.jpg', 0, 0, 0, 0, '10', 0, 100, 90, '10', '[\"2\"]', 0, '09:00', '21:00', 'Deleted', 1, '2022-02-16 23:42:09', '2022-03-09 05:19:25'),
(3, 1, 2, 'veg', 'xcxzcz', '', 'bnvbn', 'FOOD_16450359506.jpg', 0, 0, 0, 0, '10', 0, 45, 35, '22', '', 0, '09:00', '21:00', 'Deleted', 1, '2022-02-16 23:55:50', '2022-03-09 05:19:43'),
(4, 2, 2, 'veg', 'Arun', '', '', 'FOOD_16450416077.jpg', 0, 0, 0, 0, '10', 0, 45, 40, '', '', 0, '', '', 'Deleted', 1, '2022-02-17 01:30:07', '2022-03-09 05:19:11'),
(5, 4, 8, 'non_veg', 'chicken pizza', 'chicken-pizza', 'very good yummy pizza', 'FOOD_16457322069.jpg', 0, 1, 1, 0, '5', 0.001, 300, 250, '17', '[\"3\"]', 1, '06:00', '18:00', 'Deleted', 1, '2022-02-25 01:20:06', '2022-03-15 23:19:08'),
(6, 5, 4, 'veg', 'dosha', 'dosha', 'dosha is a very tasty food', 'FOOD_16457381699.jpg', 0, 0, 0, 0, '4', 0, 50, 45, '10', '', 1, '09:00', '21:00', 'Deleted', 1, '2022-02-25 02:59:29', '2022-03-15 23:19:11'),
(7, 4, 8, 'veg', 'veg pizza', 'veg-pizza', 'dffgdg fhgf', 'FOOD_16466977268.jpg', 0, 0, 0, 0, '12', 0, 15, 10, '33', '', 1, '09:35', '21:35', 'Deleted', 1, '2022-03-08 05:32:06', '2022-03-15 23:19:08'),
(8, 7, 13, 'non_veg', 'BEEF burger', 'beef-burger', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'FOOD_16473671679.jpg', 0, 1, 1, 0, '10', 0.1, 35, 30, '14', '', 1, '17:35', '22:30', 'In Stock', 1, '2022-03-15 23:29:27', '2022-03-15 23:34:34'),
(9, 7, 13, 'non_veg', 'chicken burger', 'chicken-burger', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'FOOD_16473672637.jpg', 0, 1, 1, 0, '10', 0, 100, 80, '20', '', 1, '15:30', '19:45', 'In Stock', 1, '2022-03-15 23:31:03', '2022-03-15 23:34:26'),
(10, 7, 14, 'veg', 'orange juice', 'orange-juice', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'FOOD_16473673165.jpg', 0, 0, 0, 0, '20', 0, 55, 50, '9', '', 1, '11:31', '16:36', 'In Stock', 1, '2022-03-15 23:31:56', '2022-03-15 23:31:56'),
(11, 7, 14, 'veg', 'grape juice', 'grape-juice', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'FOOD_16473673663.jpg', 0, 0, 1, 0, '12', 0, 34, 30, '12', '', 1, '14:35', '21:45', 'In Stock', 1, '2022-03-15 23:32:46', '2022-03-15 23:34:26'),
(12, 7, 10, 'non_veg', 'chicken kabab', 'chicken-kabab', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'FOOD_16473674358.jpg', 0, 1, 0, 0, '12', 0, 55, 50, '9', '', 1, '13:22', '23:35', 'In Stock', 1, '2022-03-15 23:33:55', '2022-03-15 23:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_franchise_details`
--

CREATE TABLE `tbl_franchise_details` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grocery_categories`
--

CREATE TABLE `tbl_grocery_categories` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `status` varchar(25) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_grocery_categories`
--

INSERT INTO `tbl_grocery_categories` (`id`, `name`, `slug`, `image_url`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 'Rice', 'rice', 'GROCCAT_16460021168.png', 'Active', 13, '2022-02-09 04:04:22', '2022-03-01 23:53:33'),
(2, 'General Grocery', 'general-grocery', 'GROCCAT_16460033203.png', 'Active', 13, '2022-02-28 04:38:40', '2022-03-01 23:53:26'),
(3, 'Grains & Floors', 'grains--floors', 'GROCCAT_16460033565.png', 'Active', 13, '2022-02-28 04:39:16', '2022-03-01 23:53:21'),
(4, 'Frozen Foods', 'frozen-foods', 'GROCCAT_16460034057.png', 'Active', 13, '2022-02-28 04:40:05', '2022-03-01 23:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grocery_products`
--

CREATE TABLE `tbl_grocery_products` (
  `id` int(20) NOT NULL,
  `grocery_category_id` int(15) NOT NULL,
  `name` varchar(350) NOT NULL,
  `price_description` varchar(30) NOT NULL,
  `slug` varchar(400) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `mrp` varchar(15) NOT NULL,
  `selling_price` varchar(15) NOT NULL,
  `discount` varchar(15) NOT NULL,
  `order_limit` varchar(15) NOT NULL,
  `coins` float NOT NULL,
  `top_deals_status` int(2) NOT NULL DEFAULT 0,
  `franchise_id` int(20) NOT NULL,
  `variants_count` int(15) NOT NULL,
  `visibility` int(2) NOT NULL DEFAULT 1,
  `status` varchar(25) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_grocery_products`
--

INSERT INTO `tbl_grocery_products` (`id`, `grocery_category_id`, `name`, `price_description`, `slug`, `description`, `image_url`, `mrp`, `selling_price`, `discount`, `order_limit`, `coins`, `top_deals_status`, `franchise_id`, `variants_count`, `visibility`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 1, 'chrumani', '30/1kg', 'chrumani', 'Cherumani Rice is a type of parboiled round rice. This rice is shorter in size and is stored with perfection to retain their original flavour and taste. The white rice is more nutritious as compared to other white rice.', 'GROCERY_16459987425.jpg', '50', '30', '40', '10', 0.1, 0, 0, 0, 1, 'In Stock', 1, '2022-02-28 03:22:22', '2022-03-15 22:48:35'),
(2, 1, 'MATTAVADI ₹ 37.00 /- ( 1 Kg )', '', 'mattavadi-37-00-1-kg-', 'It is a rich parboiled red rice, which is long in size. The Matta Rice is the most preferred and consumed rice in Kerala.', 'GROCERY_16459994862.jpg', '47', '37', '21', '10', 0, 0, 0, 0, 1, 'In Stock', 13, '2022-02-28 03:34:46', '2022-03-01 23:57:02'),
(3, 1, 'MAYOORI ₹ 34.00 /- ( 1 Kg )', '', 'mayoori-34-00-1-kg-', 'Kuruva is a natural and traditional rice variety from Wayanad in Kerala, with the original seeds being passed across generations. It is widely using rice in Kerala.', 'GROCERY_16459997526.jpg', '35', '34', '3', '10', 0, 0, 0, 0, 1, 'In Stock', 13, '2022-02-28 03:39:12', '2022-03-01 23:57:17'),
(4, 1, 'test', '', 'test', 'SDSADA', 'GROCERY_16459997957.png', '213', '212', '0', '32', 0, 0, 0, 0, 1, 'Deleted', 1, '2022-02-28 03:39:55', '2022-02-28 03:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_details`
--

CREATE TABLE `tbl_offer_details` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `slug` varchar(85) NOT NULL,
  `image_url` varchar(150) NOT NULL,
  `offer_url` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `offer_type` varchar(35) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_offer_details`
--

INSERT INTO `tbl_offer_details` (`id`, `name`, `slug`, `image_url`, `offer_url`, `description`, `offer_type`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 'offer1', 'offer1', 'OFFER_16474247988.jpg', 'dsjagdhd.safs', 'sdadsadd sad sa dsa da', 'food', 'Active', 1, '2022-03-06 16:31:58', '2022-03-16 15:29:58'),
(2, 'ghfh', 'fgdfgd', 'OFFER_16474248121.jpg', 'fggfg.ghjgjh', 'fgdfgdgdgf', 'food', 'Active', 1, '2022-03-06 16:47:28', '2022-03-16 15:30:12'),
(3, 'offer3', 'offer3', 'OFFER_16474248511.jpg', 'fdsfgdg.fdsf', 'dfgdgdf gdf gdf g', 'food', 'Active', 1, '2022-03-16 15:30:51', '2022-03-16 15:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `id` int(11) NOT NULL,
  `order_id` varchar(400) NOT NULL,
  `customer_id` varchar(35) NOT NULL,
  `customer_address` int(15) NOT NULL,
  `order_time` datetime NOT NULL DEFAULT current_timestamp(),
  `order_type` varchar(30) NOT NULL,
  `items` varchar(1000) NOT NULL,
  `cart_total` varchar(15) NOT NULL,
  `delivery_charge` varchar(15) NOT NULL,
  `delivery_tax` varchar(25) DEFAULT NULL,
  `tax` varchar(15) NOT NULL,
  `total_before_vat` varchar(30) DEFAULT NULL,
  `tax_amount` varchar(15) NOT NULL,
  `promo_code` varchar(150) DEFAULT NULL,
  `discount` varchar(16) NOT NULL,
  `reward_redeemed` varchar(5) DEFAULT NULL,
  `redeemed_points` varchar(15) DEFAULT NULL,
  `order_total` varchar(15) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `razorpay_order_id` varchar(300) NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `delivery_boy_id` varchar(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remarks` varchar(1500) NOT NULL,
  `request_address` varchar(500) NOT NULL,
  `sub_service_id` int(15) NOT NULL,
  `distance` varchar(15) NOT NULL,
  `loc_latitude` varchar(150) DEFAULT NULL,
  `loc_longitude` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`id`, `order_id`, `customer_id`, `customer_address`, `order_time`, `order_type`, `items`, `cart_total`, `delivery_charge`, `delivery_tax`, `tax`, `total_before_vat`, `tax_amount`, `promo_code`, `discount`, `reward_redeemed`, `redeemed_points`, `order_total`, `payment_type`, `razorpay_order_id`, `payment_status`, `invoice_no`, `status`, `delivery_boy_id`, `created_on`, `updated_on`, `remarks`, `request_address`, `sub_service_id`, `distance`, `loc_latitude`, `loc_longitude`) VALUES
(1, 'ORD_270edd69788dce200a3b395a6da6fdb7', '5', 16, '2022-03-25 14:54:27', 'food', 'chicken kabab', '50', '65', NULL, '', NULL, '', NULL, '0', NULL, NULL, '115', 'online-payment', 'order_JBGqPUfTGWUN1p', 'payment success', 'INV-97', '', '', '2022-03-25 14:54:27', '2022-03-25 14:54:27', '', '', 0, '', NULL, NULL),
(2, 'ORD_6cf821bc98b2d343170185bb3de84cc4', '5', 17, '2022-03-25 15:06:15', 'food', 'chicken kabab', '50', '65', NULL, '', NULL, '', NULL, '0', NULL, NULL, '115', 'online-payment', 'order_JBGqPUfTGWUN1p', 'payment success', 'INV-47', '', '', '2022-03-25 15:06:15', '2022-03-25 15:06:15', '', '', 0, '', NULL, NULL),
(3, 'ORD_435d6ab1ba16ba7e05e09d9728bc36ca', '5', 18, '2022-03-25 15:07:03', 'food', '', '50', '65', NULL, '', NULL, '', NULL, '0', NULL, NULL, '115', 'online-payment', 'order_JBGqPUfTGWUN1p', 'payment success', 'INV-44', '', '', '2022-03-25 15:07:03', '2022-03-25 15:07:03', '', '', 0, '', NULL, NULL),
(4, 'ORD_41ab1b1d6bf108f388dfb5cd282fb76c', '5', 0, '2022-03-25 15:33:58', 'food', 'chicken burger,grape juice', '110', '65', NULL, '', NULL, '', NULL, '0', NULL, NULL, '175', 'online-payment', 'order_JBHYijgShIHrhO', 'payment success', 'INV-11', '', '', '2022-03-25 15:33:58', '2022-03-25 15:33:58', '', '', 0, '', NULL, NULL),
(5, 'ORD_0f2c9a93eea6f38fabb3acb1c31488c6', '5', 0, '2022-03-26 03:45:58', 'service', '', '', '', NULL, '', NULL, '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', '2022-03-26 03:45:58', '2022-03-26 03:45:58', '', '86JM+C4 Pullur, Kerala, India', 2, '0', '10.331069824675804', '76.23282848522'),
(6, 'ORD_b426b30042abbc15e363cb679bbc937d', '5', 0, '2022-03-26 03:57:05', 'service', '', '', '', NULL, '', NULL, '', NULL, '', NULL, NULL, '', '', '', '', '', '', '', '2022-03-26 03:57:05', '2022-03-26 03:57:05', '', '86MP+524, Avittathur, Kerala 680121, India', 3, '0', '10.331806991801828', '76.23432711646534');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pomo_deals`
--

CREATE TABLE `tbl_pomo_deals` (
  `id` int(11) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `status` varchar(35) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restaurant_details`
--

CREATE TABLE `tbl_restaurant_details` (
  `id` int(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `tags` varchar(250) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `address` varchar(600) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `featured_status` int(2) NOT NULL DEFAULT 0 COMMENT '1-featured,0-not featured',
  `recommented_status` int(2) NOT NULL DEFAULT 0 COMMENT '1-recommented,0-not recommented',
  `most_popular_status` int(2) NOT NULL DEFAULT 0 COMMENT '0-not popular,1-most popular',
  `visibility` int(2) NOT NULL DEFAULT 1 COMMENT '0-hidden,1-visible,2-disabled',
  `loc_latitude` varchar(250) NOT NULL,
  `loc_longitude` varchar(250) NOT NULL,
  `nearest_restaurants` varchar(1000) NOT NULL,
  `opening_time` varchar(15) NOT NULL,
  `closing_time` varchar(15) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_restaurant_details`
--

INSERT INTO `tbl_restaurant_details` (`id`, `name`, `slug`, `tags`, `mobile_no`, `email_id`, `address`, `image_url`, `featured_status`, `recommented_status`, `most_popular_status`, `visibility`, `loc_latitude`, `loc_longitude`, `nearest_restaurants`, `opening_time`, `closing_time`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 'Ikkoo bai family restaurant', '', '', '08943800347', 'ikkoobai@gmail.com', 'gfghfhggh', 'RESTRNT_16443539523.jpg', 0, 0, 0, 1, '10.3446664', '76.20937149999997', '[\"3\"]', '00:00', '00:00', 'Deleted', 1, '2022-02-09 02:29:12', '2022-02-25 01:04:41'),
(2, 'Ikkoo bai family restaurant', '', '', '08943800347', 'ikkoo@gmh.jj', 'rtfdtf', 'RESTRNT_16447047624.jpg', 0, 0, 0, 1, '345354', '3234', '', '0000-00-00 00:0', '0000-00-00 00:0', 'Deleted', 1, '2022-02-09 02:30:42', '2022-02-25 01:04:44'),
(3, 'test', '', '', '2424', 'princia@gmail.com', 'dsdsd\r\ndsdsd', 'RESTRNT_16447088757.jpg', 0, 0, 0, 1, '32131', '31313', '', '05:02', '21:06', 'Deleted', 1, '2022-02-13 05:04:35', '2022-02-25 01:04:47'),
(4, 'Iqoo bai kuzhimanthi kada', 'iqoo-bai-kuzhimanthi-kada', 'Arabian|Chinese|indian', '9834212121', 'iqoo@gmail.com', 'irinjalakuda', 'RESTRNT_16457316911.png', 1, 0, 0, 1, '10.347100', '76.216698', '', '09:00', '21:00', 'Deleted', 1, '2022-02-25 01:11:31', '2022-03-15 23:19:08'),
(5, 'bombay bakes', 'bombay-bakes', 'indian', '888888888', 'bombaybakes@gmail.com', ' Irinjalakuda Kattoor Rd, Irinjalakuda, Kerala 680121', 'RESTRNT_16457320527.png', 0, 1, 0, 1, '10.347057', '76.218675', '[\"4\"]', '08:00', '22:00', 'Deleted', 1, '2022-02-25 01:17:32', '2022-03-15 23:19:11'),
(6, 'chikkoos', 'chikkoos', 'Arabian', '8956783456', 'chikkoos@gmail.com', 'irinjalakuda-tana', 'RESTRNT_16465541174.png', 0, 0, 1, 1, '212', '23321', '[\"4\"]', '09:30', '22:15', 'Deleted', 1, '2022-03-06 13:38:37', '2022-03-15 23:19:14'),
(7, 'HOTTASTE', 'hottaste', 'Arabian|chinese', '0000000000', 'hotaste@gmail.com', 'irinjalakuda', 'RESTRNT_16474690597.jpg', 1, 1, 0, 1, '27723728', '87887878', '', '09:00', '22:00', 'Active', 1, '2022-03-15 23:21:29', '2022-03-17 03:47:39'),
(8, 'IKKU BHAI', 'ikku-bhai', 'Arabian|Indian', '111111111', 'ikku@gmail.com', 'iewhjehjwhew', 'RESTRNT_16474690767.jpg', 0, 1, 0, 1, '2323', '32323', '[\"7\"]', '08:00', '22:50', 'Active', 1, '2022-03-15 23:23:49', '2022-03-17 03:47:56'),
(9, 'Vrindhavan', 'vrindhavan', 'Indian', '2222222222', 'sadd@GHH.HGH', 'assaDadAD', 'RESTRNT_16474691058.jpg', 0, 0, 1, 1, '434242', '242424', '[\"8\"]', '10:20', '17:30', 'Active', 1, '2022-03-15 23:25:10', '2022-03-17 03:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_categories`
--

CREATE TABLE `tbl_service_categories` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(250) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image_url` varchar(150) NOT NULL,
  `sub_service_status` int(2) NOT NULL COMMENT '1-yes,0-no',
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_service_categories`
--

INSERT INTO `tbl_service_categories` (`id`, `name`, `link`, `description`, `image_url`, `sub_service_status`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 'Home Appliances', '', '', 'SERCAT_16441763517.jpg', 1, 'Deleted', 1, '2022-02-07 01:09:11', '2022-02-21 00:35:58'),
(2, 'Home Maintenance', '', '', 'SERCAT_16443458403.jpg', 0, 'Deleted', 1, '2022-02-09 00:14:00', '2022-02-12 02:31:52'),
(3, '', '', '', '', 0, 'Deleted', 1, '2022-02-11 22:29:13', '2022-02-12 02:31:49'),
(4, '', '', '', '', 0, 'Deleted', 1, '2022-02-11 22:29:17', '2022-02-12 02:31:46'),
(5, '', '', '', '', 0, 'Deleted', 1, '2022-02-11 22:30:10', '2022-02-12 02:31:42'),
(6, 'test', '', '', 'SERCAT_16446008737.jpg', 0, 'Deleted', 1, '2022-02-11 23:04:33', '2022-02-12 02:31:38'),
(7, 'princia', '', '', 'SERCAT_16446014916.jpg', 0, 'Deleted', 1, '2022-02-11 23:14:51', '2022-02-12 02:31:33'),
(8, 'Manish', '', '', 'SERCAT_16446016579.jpg', 0, 'Deleted', 1, '2022-02-11 23:17:37', '2022-02-12 02:31:28'),
(9, 'xcxzcz', '', '', 'SERCAT_16446041444.jpg', 0, 'Deleted', 1, '2022-02-11 23:18:18', '2022-02-12 02:31:19'),
(10, 'Pomo Food Court', 'pomo-food-court', '', 'SERCAT_16453839834.png', 0, 'Active', 1, '2022-02-21 00:36:23', '2022-02-24 23:48:00'),
(11, 'Pomo Hyper Market', 'pomo-hyper-market', '', 'SERCAT_16453844045.png', 0, 'Active', 1, '2022-02-21 00:43:24', '2022-02-28 03:44:55'),
(12, 'Appliance Services', '', '', 'SERCAT_16453846441.png', 1, 'Active', 1, '2022-02-21 00:47:24', '2022-02-21 00:48:27'),
(13, 'Home Maintenance', '', '', 'SERCAT_16453847387.png', 1, 'Active', 1, '2022-02-21 00:48:58', '2022-02-21 00:48:58'),
(14, 'Car Wash On Your Door Step', '', '', 'SERCAT_16453848821.png', 1, 'Active', 1, '2022-02-21 00:51:22', '2022-02-21 00:51:22'),
(15, 'More Services', '', '', 'SERCAT_16453875186.png', 1, 'Active', 1, '2022-02-21 01:35:18', '2022-02-21 01:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider_details`
--

CREATE TABLE `tbl_slider_details` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image_url` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `slider_type` varchar(35) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slider_details`
--

INSERT INTO `tbl_slider_details` (`id`, `name`, `image_url`, `description`, `link`, `slider_type`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 'tslider11', 'SLIDER_16456439028.png', 'slider1jhjhfdjnjzdj', 'dsjdsd.jsf', 'main', 'Deleted', 1, '2022-02-24 00:48:22', '2022-03-15 22:54:13'),
(2, 'slider23', 'SLIDER_16456455846.png', 'dsd', 'jdskdj.dsjkjd', 'main', 'Deleted', 1, '2022-02-24 01:16:24', '2022-03-15 22:54:24'),
(3, 'test service slider', 'SLIDER_16458309863.png', 'test service slider', 'service-slider.html', 'service', 'Deleted', 1, '2022-02-26 04:46:26', '2022-03-15 23:02:09'),
(4, 'test', 'SLIDER_16458310462.png', 'test', 'test.html', 'service', 'Deleted', 1, '2022-02-26 04:47:26', '2022-03-15 23:02:15'),
(5, 'test grocery slider', 'SLIDER_16458311137.png', 'test grocery slider', 'groceryslide.html', 'grocery', 'Active', 1, '2022-02-26 04:48:33', '2022-02-26 04:48:33'),
(6, 'testgroceryslider2', 'SLIDER_16458311459.png', 'testgroceryslider2', 'testgroceryslider2.html', 'grocery', 'Active', 1, '2022-02-26 04:49:05', '2022-02-26 04:49:05'),
(7, 'testfoodslider1', 'SLIDER_16458311936.png', 'testfoodslider1', 'testfoodslider1', 'food', 'Deleted', 1, '2022-02-26 04:49:53', '2022-03-06 16:39:25'),
(8, 'slider2', 'SLIDER_16465650745.png', 'ffggg', 'fdf,fgg', 'food', 'Deleted', 1, '2022-03-06 16:41:14', '2022-03-15 22:54:40'),
(9, 'slider1', 'SLIDER_16473656062.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '', 'main', 'Active', 1, '2022-03-15 23:03:26', '2022-03-15 23:03:26'),
(10, 'food offer', 'SLIDER_16473659573.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '', 'main', 'Active', 1, '2022-03-15 23:09:17', '2022-03-15 23:09:17'),
(11, 'grocery offer', 'SLIDER_16473659790.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '', 'main', 'Active', 1, '2022-03-15 23:09:39', '2022-03-15 23:09:39'),
(12, 'home appliance', 'SLIDER_16473660047.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '', 'main', 'Active', 1, '2022-03-15 23:10:04', '2022-03-15 23:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_service_categories`
--

CREATE TABLE `tbl_sub_service_categories` (
  `id` int(20) NOT NULL,
  `service_category_id` int(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `link` varchar(250) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image_url` varchar(150) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sub_service_categories`
--

INSERT INTO `tbl_sub_service_categories` (`id`, `service_category_id`, `name`, `link`, `description`, `image_url`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 1, 'TV', '', '', 'SUBSERCAT_16443476745.jpg', 'Deleted', 1, '2022-02-09 00:44:34', '2022-02-12 02:32:11'),
(2, 12, 'Audio/Video Repair', 'audiovideo-repair', '', 'SUBSERCAT_16453876875.png', 'Active', 1, '2022-02-21 01:38:07', '2022-03-03 02:07:01'),
(3, 12, 'Washing Machine Repair', 'washing-machine-repair', '', 'SUBSERCAT_16453877249.png', 'Active', 1, '2022-02-21 01:38:44', '2022-03-03 02:06:51'),
(4, 12, 'Fridge', 'fridge', '', 'SUBSERCAT_16453877648.png', 'Active', 1, '2022-02-21 01:39:24', '2022-03-03 02:04:35'),
(5, 13, 'Plumbing Works', 'plumbing-works', '', 'SUBSERCAT_16453878022.png', 'Active', 1, '2022-02-21 01:40:02', '2022-03-03 02:05:12'),
(6, 13, 'Electric Works', 'electric-works', '', 'SUBSERCAT_16453878517.png', 'Active', 1, '2022-02-21 01:40:51', '2022-03-03 02:06:15'),
(7, 13, 'Painting', 'painting', '', 'SUBSERCAT_16453878810.png', 'Active', 1, '2022-02-21 01:41:21', '2022-03-03 02:07:25'),
(8, 14, 'Car Wash', 'car-wash', '', 'SUBSERCAT_16453879473.png', 'Active', 1, '2022-02-21 01:42:27', '2022-03-03 02:07:52'),
(9, 14, 'Bike Wash', 'bike-wash', '', 'SUBSERCAT_16453879626.png', 'Active', 1, '2022-02-21 01:42:42', '2022-03-03 02:08:03'),
(10, 15, 'Event Management', '', '', 'SUBSERCAT_16453879874.png', 'Active', 1, '2022-02-21 01:43:07', '2022-02-21 01:43:07'),
(11, 15, 'Classifieds', '', '', 'SUBSERCAT_16453880033.png', 'Active', 1, '2022-02-21 01:43:23', '2022-02-21 01:43:23'),
(12, 15, 'Grass Cutting', '', '', 'SUBSERCAT_16453880442.png', 'Active', 1, '2022-02-21 01:44:04', '2022-02-21 01:44:04'),
(13, 15, 'Mobile Car Repair', '', '', 'SUBSERCAT_16453880736.png', 'Active', 1, '2022-02-21 01:44:33', '2022-02-21 01:44:33'),
(14, 15, 'Mobile Car Puncture Service', 'mobile-car-puncture-service', '', 'SUBSERCAT_16453881057.png', 'Active', 1, '2022-02-21 01:45:05', '2022-02-24 23:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_address_details`
--

CREATE TABLE `tbl_user_address_details` (
  `id` int(11) NOT NULL,
  `user_id` int(15) NOT NULL,
  `address` varchar(500) NOT NULL,
  `current_location` varchar(500) NOT NULL,
  `delivery_area` varchar(350) NOT NULL,
  `loc_latitude` varchar(150) NOT NULL,
  `loc_longitude` varchar(150) NOT NULL,
  `loc_distance` float NOT NULL,
  `delivery_instructions` varchar(600) NOT NULL,
  `address_type` varchar(30) NOT NULL,
  `default_status` int(5) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_add_details`
--

CREATE TABLE `tbl_user_add_details` (
  `id` int(11) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `profile_pic` varchar(300) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `address` varchar(250) NOT NULL,
  `addresstype` varchar(30) NOT NULL,
  `street` varchar(50) NOT NULL,
  `landmark` varchar(300) NOT NULL,
  `area` varchar(15) NOT NULL,
  `loc_latitude` varchar(150) DEFAULT NULL,
  `loc_longitude` varchar(150) DEFAULT NULL,
  `role` varchar(25) NOT NULL,
  `reward_point` double DEFAULT 0,
  `status` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_add_details`
--

INSERT INTO `tbl_user_add_details` (`id`, `user_id`, `name`, `mobile`, `profile_pic`, `email_id`, `address`, `addresstype`, `street`, `landmark`, `area`, `loc_latitude`, `loc_longitude`, `role`, `reward_point`, `status`, `created_on`, `updated_on`) VALUES
(4, '5', 'princiaks', '8943800347', '', 'princiaks@gmail.com', 'dsdsd\r\ndsdsd', '', '', '', '', NULL, NULL, 'customer', 0, '', '2022-03-14 17:31:41', '2022-03-23 05:08:16'),
(6, '7', 'sooraj', '9061797735', '', 'sooraj2raj@gmail.com', '\'KRITHI\',mapranam\r\n\'KRITHI\',mapranam', '', '', '', '', NULL, NULL, 'customer', 0, '', '2022-03-14 18:25:38', '2022-03-14 18:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_details`
--

CREATE TABLE `tbl_user_details` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `pomotoken` varchar(350) NOT NULL,
  `email_id` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(30) NOT NULL,
  `franchise_id` int(20) DEFAULT NULL COMMENT 'For Franchise Admins(default 0 for super admin)',
  `status` varchar(25) NOT NULL,
  `loc_latitude` varchar(250) NOT NULL,
  `loc_longitude` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_details`
--

INSERT INTO `tbl_user_details` (`id`, `name`, `mobile`, `pomotoken`, `email_id`, `username`, `password`, `role`, `franchise_id`, `status`, `loc_latitude`, `loc_longitude`, `created_on`, `updated_on`) VALUES
(1, 'admin', '9048888698', '', 'info@pomoservices.com', 'admin', '361501d7f255ba285f85dd991e6a2934', 'admin', 0, 'Active', '10.3446664', '76.20937149999997', '2022-01-29 15:18:13', '2022-02-11 00:32:37'),
(5, 'princia', '8943800347', '', 'princiaks@gmail.com', '', '', 'customer', NULL, 'Active', '', '', '2022-03-14 17:31:41', '2022-03-26 03:18:03'),
(7, 'sooraj', '9061797735', '', 'sooraj2raj@gmail.com', '', '', 'customer', NULL, 'Active', '', '', '2022-03-14 18:25:38', '2022-03-14 18:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_variants_master`
--

CREATE TABLE `tbl_variants_master` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `product_type` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_variants_master`
--

INSERT INTO `tbl_variants_master` (`id`, `name`, `product_type`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1, 'Full', 'food', 'Deleted', 1, '2022-02-09 03:11:35', '2022-02-21 02:37:25'),
(2, 'Default', 'food', 'Deleted', 1, '2022-02-13 06:02:09', '2022-02-21 02:37:21'),
(3, 'Kilogram', 'grocery', 'Active', 1, '2022-02-21 02:18:12', '2022-02-21 02:18:12'),
(4, 'Gram', '', 'Active', 1, '2022-02-21 02:38:07', '2022-02-21 02:38:07'),
(5, 'Liter', '', 'Active', 1, '2022-02-21 02:38:25', '2022-02-21 02:38:25'),
(6, 'Milligram', '', 'Active', 1, '2022-02-21 02:38:36', '2022-02-21 02:38:36'),
(7, 'Meter', '', 'Active', 1, '2022-02-21 02:38:53', '2022-02-21 02:38:53'),
(8, 'Centimeter', '', 'Active', 1, '2022-02-21 02:39:07', '2022-02-21 02:39:07'),
(9, 'Foot', '', 'Active', 1, '2022-02-21 02:39:12', '2022-02-21 02:39:12'),
(10, 'Inch', '', 'Deleted', 1, '2022-02-21 02:39:26', '2022-02-26 04:56:02'),
(11, 'Nos', '', 'Active', 1, '2022-02-21 02:39:30', '2022-02-21 02:39:30'),
(12, 'Pieces', '', 'Active', 1, '2022-02-21 02:39:39', '2022-02-21 02:41:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_carted_item_details`
--
ALTER TABLE `tbl_carted_item_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_delivery_charge_master`
--
ALTER TABLE `tbl_delivery_charge_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food_additional_details`
--
ALTER TABLE `tbl_food_additional_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food_addons`
--
ALTER TABLE `tbl_food_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food_categories`
--
ALTER TABLE `tbl_food_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food_category_master`
--
ALTER TABLE `tbl_food_category_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food_offer_details`
--
ALTER TABLE `tbl_food_offer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food_offer_user_details`
--
ALTER TABLE `tbl_food_offer_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food_products`
--
ALTER TABLE `tbl_food_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_franchise_details`
--
ALTER TABLE `tbl_franchise_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_grocery_categories`
--
ALTER TABLE `tbl_grocery_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_grocery_products`
--
ALTER TABLE `tbl_grocery_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offer_details`
--
ALTER TABLE `tbl_offer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pomo_deals`
--
ALTER TABLE `tbl_pomo_deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_restaurant_details`
--
ALTER TABLE `tbl_restaurant_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_categories`
--
ALTER TABLE `tbl_service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider_details`
--
ALTER TABLE `tbl_slider_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sub_service_categories`
--
ALTER TABLE `tbl_sub_service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_address_details`
--
ALTER TABLE `tbl_user_address_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_add_details`
--
ALTER TABLE `tbl_user_add_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_variants_master`
--
ALTER TABLE `tbl_variants_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_carted_item_details`
--
ALTER TABLE `tbl_carted_item_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_delivery_charge_master`
--
ALTER TABLE `tbl_delivery_charge_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_food_additional_details`
--
ALTER TABLE `tbl_food_additional_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_food_addons`
--
ALTER TABLE `tbl_food_addons`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_food_categories`
--
ALTER TABLE `tbl_food_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_food_category_master`
--
ALTER TABLE `tbl_food_category_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_food_offer_details`
--
ALTER TABLE `tbl_food_offer_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_food_offer_user_details`
--
ALTER TABLE `tbl_food_offer_user_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_food_products`
--
ALTER TABLE `tbl_food_products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_franchise_details`
--
ALTER TABLE `tbl_franchise_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_grocery_categories`
--
ALTER TABLE `tbl_grocery_categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_grocery_products`
--
ALTER TABLE `tbl_grocery_products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_offer_details`
--
ALTER TABLE `tbl_offer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_pomo_deals`
--
ALTER TABLE `tbl_pomo_deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_restaurant_details`
--
ALTER TABLE `tbl_restaurant_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_service_categories`
--
ALTER TABLE `tbl_service_categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_slider_details`
--
ALTER TABLE `tbl_slider_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_sub_service_categories`
--
ALTER TABLE `tbl_sub_service_categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user_address_details`
--
ALTER TABLE `tbl_user_address_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_user_add_details`
--
ALTER TABLE `tbl_user_add_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_variants_master`
--
ALTER TABLE `tbl_variants_master`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
