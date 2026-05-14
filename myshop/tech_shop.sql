-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 14 2026 г., 22:08
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tech_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `delivery_type` enum('pickup','delivery') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Новый',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image`) VALUES
(1, 'iPhone 17 Pro Max', 'Apple A19 Pro, 256GB, Titanium Blue, 6.9\" ProMotion Display', 144990.00, 'Смартфон', 'IP17.jpg\r\n'),
(2, 'Samsung Galaxy S26 Ultra', 'Snapdragon 8 Gen 5, 12/256GB, 200MP Camera, AI S-Pen', 124990.00, 'Смартфон', 'S26.jpg'),
(3, 'iPad Pro M5 13', 'Apple M5 Chip, 1TB SSD, OLED Tandem Display, Nano-texture', 189990.00, 'Планшет', 'M5.jpg'),
(4, 'Galaxy Tab S11 Ultra', 'Dynamic AMOLED 3X, 16GB RAM, 512GB Storage, Graphite', 112990.00, 'Планшет', 'S11.png'),
(5, 'Google Pixel 10 Pro', 'Google Tensor G5, 256GB, Pure Android 16, Hazel', 98990.00, 'Смартфон', '10.jpg'),
(6, 'iPhone 17 Pro Max', 'Чип A19 Pro, Титановый корпус, экран 6.9 дюйма, 256GB', 144990.00, 'Смартфон', 'IP17.jpg'),
(7, 'Samsung Galaxy S26 Ultra', 'Snapdragon 8 Gen 5, 200Мп камера, AI-переводчик, S-Pen', 124990.00, 'Смартфон', 'S26.jpg'),
(8, 'iPad Pro M5 13', 'Дисплей Tandem OLED, чип M5, ультратонкий дизайн, 512GB', 162990.00, 'Планшет', 'M5.jpg'),
(9, 'Galaxy Tab S11 Ultra', '14.6\" Dynamic AMOLED 3X, 12GB RAM, Защита IP68', 112990.00, 'Планшет', 'S11.png'),
(10, 'Google Pixel 10 Pro', 'Чистый Android 16, Камера нового поколения, чип Tensor G5', 98990.00, 'Смартфон', '10.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@techstore.ru', '12345678', 'admin', '2026-05-14 13:38:34'),
(2, 'dovaska007@gmail.com', 'dovaska007@gmail.com', '$2y$10$hcSzF1dvg26H0PD2yy3rDuBp50c6p8LqwWd8fnDfgiui/WU8Asvr6', 'user', '2026-05-14 13:45:08'),
(3, 'dovaska007@gmail.com', 'dovaska07@gmail.com', '$2y$10$kQZupgN4zfvy5rHlOYKL3.6h6n.48w1ihtUCZapEiZqIehr.iRW6K', 'admin', '2026-05-14 15:59:48');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
