-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2019 at 01:52 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineShop`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(255) NOT NULL,
  `User_name` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `id_product` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `User_name`, `feedback`, `timestamp`, `id_product`) VALUES
(1, 'Светлана', 'Шикарнишие туфли', '12 November 2019 ', 2),
(2, 'Anastasia', 'Очень комфортные и качество идеальное!', '12 November 2019 ', 2),
(3, 'Елена', 'Я в восторге!', '12 November 2019 ', 2),
(4, 'Виктория', 'Безумно красивые, но не для ежедневной носки ', '12 November 2019 ', 1),
(5, 'Виктория', 'Безумно красивые, но не для ежедневной носки ', '12 November 2019 ', 1),
(6, 'Владимир', 'Очень удобные!', '12 November 2019 ', 3),
(7, 'Владимир', 'Очень удобные!', '12 November 2019 ', 3),
(8, 'Костя', 'Мне очень понравились!', '12 November 2019 ', 3),
(9, 'Костя', 'Мне очень понравились!', '12 November 2019 ', 3),
(10, 'Костя', 'Мне очень понравились!', '12 November 2019 ', 3),
(11, 'Костя', 'Мне очень понравились!', '12 November 2019 ', 3),
(12, 'Костя', 'Мне очень понравились!', '12 November 2019 ', 3),
(13, 'Светлана', 'Шикарные туфли!', '12 November 2019 ', 8),
(14, 'Светлана', 'Мне очень понравилось', '12 November 2019 ', 8);

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` int(255) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `img_dir` varchar(255) NOT NULL,
  `description_short` varchar(255) NOT NULL,
  `price_product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `name_product`, `img_dir`, `description_short`, `price_product`) VALUES
(2, 'leopard shoes', 'image2', 'blablablablablablablablablablabbalab', '350'),
(4, 'snikers nike', 'image3', 'blablablablablablablablablablabbalab', '500'),
(5, 'crazy shoes', 'image4', 'blablablablablablablablablablabbalab', '500'),
(6, 'black sandales', 'image6', 'blablablablablablablablablablabbalab', '500'),
(7, 'black high heals shoes', 'image7', 'blablablablablablablablablablabbalab', '500'),
(8, 'yellow shoes', 'image8', 'blablablablablablablablablablabbalab', '500');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Создан'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `adress`, `tel`, `email`, `time`, `status`) VALUES
(39, 15, 'Пряничная 10 34 Санкт-Петербург 124423', '89818394345', 'anastasianaymushina906734@gmail.com', '23/11/19 23:50', 'Создан'),
(58, 15, 'Пряничная 10 74 Санкт-Петербург 124423', '89818394345', 'stasya0903@mail.ru', '23/11/19 23:50', 'Создан'),
(59, 15, 'патриаршие пруды 12 74 Санкт-Петербург 124423', '89818394345', 'stasya0903@icloud.com', '23/11/19 23:55', 'Создан'),
(60, 15, 'патриаршие пруды 12 65 Санкт-Петербург 124423', '89818394345', 'stasya0903@icloud.com', '24/11/19 3:50', 'Создан'),
(61, 15, 'Кирочная 24 56 Санкт-Петербург 124423', '89818394345', 'stasya0903@icloud.com', '24:11:19 02:56', 'Создан');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `role`) VALUES
(15, 'Петр', 'петруха', '$2y$10$W7KQtHlaNlWp3qi9UoCe5.5TvfZAlu35wxxgqWKD.wqnAEDrtBsY2', 0),
(16, 'Anastasia Naymushina', 'stasya0903', '$2y$10$CNFXY9nhAvEDMJcD31mbouFmFLjtow4TBy.tUAdPtcpDPq2A9Acwq', 0),
(21, 'Сваровски Елена', 'аленчик', '$2y$10$uHfMJXAufM4VqkPapaYL5emphcbSO8LoJSpk1/SUmdsVJsr0rV6pS', 0),
(23, 'inspiredot', 'петруха', '$2y$10$vgojNngizJeKMvNu6HpoDuimn32VoV90m7KgHtePfH3whvQlfPM8.', 0),
(31, 'administrator', 'admin', '$2y$10$OoItTd3HA9.P.VZ7fcbedulAKoC3/xnSbzN6zbj.9MkJhUXSI0r7G', 1),
(32, 'Прокофьев', 'проха', '$2y$10$Dh1lU8athG8AUwz8kBZw5uf3TIEfY6OIa9cFzt9Vo3JRPcJbZHAXC', 0),
(33, 'Улисис', 'Ули', '$2y$10$MKIQs1bhBj89yx2KzPlEfOwGi3D7DZvJrxFnwl3SziAQVFb1aGeI2', 0),
(34, 'Anastasia', 'gjgjh', '$2y$10$eSBdio51ILoXlcNRil2Ckecw0TKyGBfjmG8FAmy5ktcpzdvWXEcT6', 0),
(35, 'Арсений', 'сеня', '$2y$10$nWk8aaUcRXXtwQKvUgZSwew8hqAcuXWMNYusRTkq33g8d3Z.Gpvt.', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
