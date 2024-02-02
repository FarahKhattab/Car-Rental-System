-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 01:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ssn` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ssn`, `fname`, `lname`, `email`, `password`, `office_id`) VALUES
(1234, 'Main', 'Admin', 'mainadmin@gmail.com', '123456789', 1),
(7487, 'Farah', 'Khattab', 'farahkhatab@outlook.com', '123456789', 3),
(7597, 'Nour', 'Khamis', 'nourkhamis1606@gmail.com', '123456789', 2),
(7695, 'Mariam', 'Samy', 'mariamsamy@gmail.com', '123456789', 5),
(7697, 'Rana', 'Abo El Amayem', 'rana7697@gmail.com', '123456789', 4);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `plate_no` varchar(20) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `car_type` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `price_per_day` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `image` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`plate_no`, `model`, `car_type`, `color`, `capacity`, `price_per_day`, `status`, `office_id`, `image`) VALUES
('ACD 2386', 'Toyota Crolla', 'Sedan', 'White', 5, 2000.00, 'available', 5, 'Corolla 2024 white.png'),
('AEDP134', 'Mini Cooper', 'Hatchback', 'red', 4, 2050.00, 'rented', 2, 'minicooper.png'),
('IQA 2ZS', 'BMW 500', 'Sedan', 'Black', 5, 3000.00, 'available', 2, 'BMW 2020.jpeg'),
('KBD 0115', 'Kia Cerato', 'Sedan', 'Blue', 5, 1800.00, 'available', 5, 'Kia Cerato 2023.jpg'),
('MRC 218', 'Mercedes GLS', 'Compact SUV', 'Red', 7, 3500.00, 'available', 4, 'Mercedes GLS 2018.jpg'),
('OCY 915', 'Volvo S60', 'Sedan', 'Silver', 5, 2500.00, 'available', 3, 'Volvo S60.jpg'),
('س ح ر 5555', 'Captiva ', 'Compact SUV', 'Red', 7, 2200.00, 'available', 4, 'Captiva Red 2021.jpg'),
('س د ف 1234', 'Renault Sandero', 'Sedan', 'silver', 5, 1250.00, 'available', 3, 'sandero.png'),
('س س س 6666', 'Chery Tigo 5', 'Compact SUV', 'Grey', 7, 1900.00, 'available', 3, 'Chery Tigo5 2022.jpg'),
('س ع ي 1234', 'Toyota Corolla', 'Sedan', 'champagne', 5, 1500.00, 'available', 1, 'toyota_corolla.jpg'),
('ف ر ح 5555', 'Opel Mokka', 'Compact SUV', 'red', 5, 1750.00, 'available', 1, 'opel_mokka.png');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `country`, `city`) VALUES
(1, 'Egypt', 'Alexandria'),
(2, 'USA', 'New York City'),
(3, 'Egypt', 'Cairo'),
(4, 'Canada', 'Toronto'),
(5, 'Egypt', 'Hurghada'),
(6, 'USA', 'Chicago');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `user_ssn` int(11) NOT NULL,
  `plate_no` varchar(8) NOT NULL,
  `reservation_date` date NOT NULL,
  `pick_up_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `card_no` varchar(30) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`user_ssn`, `plate_no`, `reservation_date`, `pick_up_date`, `return_date`, `card_no`, `total_amount`, `status`) VALUES
(1234, 'AEDP134', '2024-01-02', '2024-01-23', '2024-01-30', '12345678910', 14350.00, 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ssn` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `phone_no` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ssn`, `fname`, `lname`, `username`, `email`, `password`, `gender`, `phone_no`, `address`) VALUES
(1234, 'Mohamed', 'Khamis', 'mkhamis', 'mkhamis@gmail.com', '42f749ade7f9e195bf475f37a44cafcb', 'm', '01000011100', 'Roushdy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ssn`),
  ADD KEY `office_id` (`office_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`plate_no`),
  ADD KEY `office_id` (`office_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`user_ssn`,`plate_no`,`reservation_date`),
  ADD KEY `fk_rental_car` (`plate_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ssn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`);

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`);

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `fk_rental_car` FOREIGN KEY (`plate_no`) REFERENCES `car` (`plate_no`),
  ADD CONSTRAINT `fk_rental_user` FOREIGN KEY (`user_ssn`) REFERENCES `user` (`ssn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
