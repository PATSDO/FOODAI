-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 07:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_ai_db`
--
CREATE DATABASE IF NOT EXISTS `food_ai_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `food_ai_db`;

-- --------------------------------------------------------

--
-- Table structure for table `chat_log`
--

CREATE TABLE `chat_log` (
  `id` int(11) NOT NULL,
  `user_message` text NOT NULL,
  `bot_response` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `restaurant_name` varchar(100) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `allergen` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `restaurant_name`, `food_name`, `allergen`, `description`) VALUES
(1, 'McDonalds', 'Big Mac', 'Wheat, Soy, Egg, Milk, Sesame', 'Classic burger with two beef patties, special sauce, lettuce, cheese, pickles, onions on a sesame seed bun'),
(2, 'McDonalds', 'Cheeseburger', 'Wheat, Soy, Milk', 'A beef patty with cheese, pickles, onions, ketchup, and mustard on a bun'),
(3, 'McDonalds', 'Quarter Pounder with Cheese', 'Wheat, Soy, Milk', 'A quarter-pound beef patty with cheese, pickles, onions, ketchup, and mustard on a bun'),
(4, 'McDonalds', 'McChicken', 'Wheat, Soy, Egg, Milk', 'Crispy chicken patty with lettuce and mayo on a bun'),
(5, 'McDonalds', 'Filet-O-Fish', 'Wheat, Soy, Egg, Milk, Fish', 'Breaded fish fillet with tartar sauce and cheese on a steamed bun'),
(6, 'McDonalds', 'French Fries', 'May contain traces of: Wheat, Soy', 'Golden crispy fries, may be cooked in shared oil'),
(7, 'McDonalds', 'Apple Pie', 'Wheat, Soy', 'Baked apple pie with a crispy crust'),
(8, 'McDonalds', 'Chicken McNuggets', 'Wheat, Soy', 'Breaded chicken nuggets with dipping sauce'),
(9, 'McDonalds', 'McFlurry (Oreo)', 'Milk, Wheat, Soy', 'Soft-serve ice cream mixed with Oreo pieces'),
(10, 'McDonalds', 'Sundae (Chocolate/Caramel/Strawberry)', 'Milk', 'Vanilla soft-serve with syrup topping'),
(11, 'McDonalds', 'Milkshakes', 'Milk', 'Blended milkshake with different flavors'),
(12, 'McDonalds', 'Iced Coffee', 'Milk', 'Cold coffee with milk and sweetener'),
(13, 'Jollibee', 'Yumburger', 'Wheat, Soy, Egg, Milk', 'A simple burger with Jollibee’s signature dressing'),
(14, 'Jollibee', 'Cheesy Yumburger', 'Wheat, Soy, Egg, Milk', 'Yumburger with melted cheese'),
(15, 'Jollibee', 'Champ Burger', 'Wheat, Soy, Egg, Milk', 'Bigger beef patty with special dressing'),
(16, 'Jollibee', 'Chickenjoy', 'Wheat, Soy, Egg', 'Crispy fried chicken served with rice and gravy'),
(17, 'Jollibee', 'Jolly Spaghetti', 'Wheat, Soy, Milk', 'Sweet-style spaghetti with hotdogs and cheese'),
(18, 'Jollibee', 'Burger Steak', 'Wheat, Soy', 'Beef patties served with mushroom gravy and rice'),
(19, 'Jollibee', 'Jolly Fries', 'May contain traces of: Wheat, Soy', 'Crispy fries, cooked in shared oil'),
(20, 'Jollibee', 'Mashed Potato (Gravy)', 'Wheat, Soy, Milk', 'Mashed potatoes topped with Jollibee’s signature gravy'),
(21, 'Jollibee', 'Peach Mango Pie', 'Wheat, Soy', 'Crispy turnover filled with peach and mango filling'),
(22, 'Jollibee', 'Sundae (Chocolate/Caramel)', 'Milk', 'Vanilla soft-serve with syrup topping'),
(23, 'Jollibee', 'Iced Coffee', 'Milk', 'Cold coffee with milk and sweetener'),
(24, 'KFC', 'Original Recipe Chicken', 'Wheat, Soy, Egg', 'KFC’s signature seasoned fried chicken'),
(25, 'KFC', 'Hot & Crispy Chicken', 'Wheat, Soy, Egg', 'Spicy crispy fried chicken'),
(26, 'KFC', 'Chicken Tenders', 'Wheat, Soy, Egg', 'Boneless breaded chicken strips'),
(27, 'KFC', 'Zinger', 'Wheat, Soy, Egg, Milk', 'Spicy chicken sandwich with lettuce and mayo'),
(28, 'KFC', 'Colonel Burger', 'Wheat, Soy, Egg, Milk', 'Classic KFC burger with seasoned chicken patty'),
(29, 'KFC', 'Mashed Potatoes & Gravy', 'Wheat, Soy, Milk', 'Creamy mashed potatoes with brown gravy'),
(30, 'KFC', 'French Fries', 'May contain traces of: Wheat, Soy', 'Crispy potato fries, cooked in shared oil'),
(31, 'KFC', 'Coleslaw', 'Egg', 'Cabbage and carrot coleslaw with dressing'),
(32, 'KFC', 'Chocolate Chip Cookie', 'Wheat, Soy, Egg, Milk', 'Soft-baked chocolate chip cookie'),
(33, 'KFC', 'Sundae (Chocolate/Caramel)', 'Milk', 'Vanilla soft-serve with syrup topping'),
(34, 'KFC', 'Milkshakes', 'Milk', 'Creamy blended milkshake with different flavors');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `allergens` text DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `allergens`, `password_hash`) VALUES
(1, 'Asha', 'Cipriano', 'ashacipriano@gmail.com', 'Shellfish', '$2y$10$k8q6rcaZd7Jko9PfnacZN.sot01HZ.t9MRBm8uKeU0mSkwIWzYHm6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_log`
--
ALTER TABLE `chat_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_log`
--
ALTER TABLE `chat_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
