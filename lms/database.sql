-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 28 2026 г., 02:54
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
-- База данных: `lms_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `image_url`) VALUES
(1, 'Python-разработка', 'Изучите самый популярный язык для данных и автоматизации.', 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=800'),
(2, 'Веб-дизайн Figma', 'Проектирование современных интерфейсов и мобильных приложений.', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800'),
(3, 'SQL и Базы данных', 'Научитесь управлять данными и писать сложные запросы.', 'https://images.unsplash.com/photo-1544383023-53fbc43dc93f?w=800'),
(4, 'Нейросети для жизни', 'Как использовать ChatGPT, Midjourney и другие ИИ в работе.', 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800'),
(5, 'Backend на PHP', 'Создание серверной части сайтов и работа с движками.', 'https://images.unsplash.com/photo-1599507593499-a3f7f7d9a2cc?w=800'),
(6, 'Основы Frontend', 'Верстка сайтов на HTML5, CSS3 и основы JavaScript.', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800');

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `content`) VALUES
(20, 3, 'Введение в реляционные БД', 'Реляционные базы данных — это способ организации данных в таблицы, которые связаны между собой. Представьте таблицу \"Клиенты\" и таблицу \"Заказы\". В SQL каждая строка имеет уникальный ключ (Primary Key). Мы используем СУБД, такие как MySQL или PostgreSQL, чтобы эффективно извлекать эти данные. Основная мощь SQL заключается в том, что вы можете объединять данные из разных источников за миллисекунды.<br><hr><div class=\"hw-block\"><h4>🏠 Домашнее задание</h4><p>Спроектируйте структуру данных для хранения информации о пользователях (минимум 5 полей). Напишите запрос или код для фильтрации этих данных.</p></div>\r\n<div class=\"hw-block\">\r\n    <h4>🏠 Домашнее задание</h4>\r\n    <p>Выполните следующие задачи, чтобы закрепить материал:</p>\r\n    <ul>\r\n        <li>Опишите своими словами разницу между реляционной и нереляционной базой данных.</li>\r\n        <li>Придумайте структуру для простой БД \"Библиотека\": назовите минимум 3 таблицы и укажите, по каким полям они будут связаны (Primary Key и Foreign Key).</li>\r\n        <li>Напишите, почему поле \"ID\" важно для каждой таблицы.</li>\r\n    </ul>\r\n    <p><i>Результат сохраните в текстовом файле или PDF для проверки.</i></p>\r\n</div>'),
(21, 3, 'Оператор SELECT и фильтрация', 'Оператор SELECT — это база. С его помощью мы выбираем столбцы. Но самое интересное начинается с ключевого слова WHERE. Вы можете фильтровать данные по условиям: больше, меньше, равно или использовать оператор LIKE для поиска по тексту. Также важно знать про ORDER BY для сортировки и LIMIT для ограничения количества выводимых строк.<br><hr><div class=\"hw-block\"><h4>🏠 Домашнее задание</h4><p>Спроектируйте структуру данных для хранения информации о пользователях (минимум 5 полей). Напишите запрос или код для фильтрации этих данных.</p></div>'),
(22, 3, 'Связи и оператор JOIN', 'Данные редко живут в одной таблице. Чтобы собрать полную картину, мы используем JOIN. Inner Join соединяет строки, если есть совпадения в обеих таблицах. Left Join берет всё из левой таблицы и добавляет данные из правой там, где они есть. Это основа архитектуры любого серьезного веб-проекта.<br><hr><div class=\"hw-block\"><h4>🏠 Домашнее задание</h4><p>Спроектируйте структуру данных для хранения информации о пользователях (минимум 5 полей). Напишите запрос или код для фильтрации этих данных.</p></div>'),
(23, 6, 'Структура HTML документа', 'HTML — это скелет сайта. Каждый документ начинается с объявления DOCTYPE. Мы используем теги для разметки: header для шапки, nav для меню, main для основного контента. Важно соблюдать семантику, чтобы поисковые роботы понимали структуру вашей страницы. Каждый тег должен иметь смысл.'),
(24, 6, 'Основы CSS стилей', 'CSS превращает черный текст на белом фоне в красивый дизайн. Мы работаем с селекторами, свойствами и значениями. Основные концепции — это Box Model (отступы, рамки), Flexbox и Grid для расположения элементов. Современный Frontend невозможен без адаптивности, которую мы реализуем через Media Queries.');

-- --------------------------------------------------------

--
-- Структура таблицы `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `group_number` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `group_number`, `password`, `role`, `bio`, `created_at`) VALUES
(1, 'admin', NULL, 'STAFF', 'admin123', 'admin', NULL, '2026-04-27 23:06:10'),
(2, 'Frosty', NULL, NULL, '04032006', 'user', NULL, '2026-04-27 23:06:10'),
(3, 'admin1', NULL, 'вапв2', 'admin123', 'user', NULL, '2026-04-27 23:06:10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT для таблицы `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
