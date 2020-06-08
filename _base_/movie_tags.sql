-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 08 2020 г., 06:48
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u1068761_default`
--

-- --------------------------------------------------------

--
-- Структура таблицы `movie_tags`
--

CREATE TABLE `movie_tags` (
  `mov_id` int(10) UNSIGNED NOT NULL COMMENT 'ID видеоролика',
  `tag_id` int(10) UNSIGNED NOT NULL COMMENT 'ID тега'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Теги видеороликов';

--
-- Дамп данных таблицы `movie_tags`
--

INSERT INTO `movie_tags` (`mov_id`, `tag_id`) VALUES
(0, 3),
(1, 1),
(1, 3),
(1, 6),
(1, 7),
(1, 16),
(1, 17),
(1, 20),
(1, 23),
(2, 1),
(2, 6),
(2, 7),
(2, 11),
(2, 14),
(2, 17),
(2, 20),
(2, 23),
(4, 1),
(4, 3),
(4, 6),
(4, 14),
(4, 16),
(4, 17),
(4, 20),
(5, 6),
(5, 20),
(6, 6),
(7, 3),
(7, 6),
(7, 20),
(8, 1),
(9, 3),
(9, 7),
(10, 3),
(10, 6),
(10, 7),
(10, 11),
(10, 21),
(10, 23);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `movie_tags`
--
ALTER TABLE `movie_tags`
  ADD PRIMARY KEY (`mov_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `mov_id` (`mov_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
