-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 05 2020 г., 12:42
-- Версия сервера: 5.7.23-24
-- Версия PHP: 7.1.32

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
-- Структура таблицы `rates_users`
--

CREATE TABLE `rates_users` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'UID записи',
  `match_id` int(10) UNSIGNED NOT NULL COMMENT 'ID конкурса',
  `movie_id` int(10) UNSIGNED NOT NULL COMMENT 'ID видеоролика',
  `movie_user_id` int(10) UNSIGNED NOT NULL COMMENT 'ID пользователя - создателя ролика',
  `rate_user_id` int(10) UNSIGNED NOT NULL COMMENT 'ID голосующего пользователя',
  `rate_value` int(10) UNSIGNED NOT NULL COMMENT 'Выставленная голосующим пользователем оценка',
  `rate_ip` char(15) NOT NULL COMMENT 'IP адрес с которого было голосование',
  `rate_ts` datetime NOT NULL COMMENT 'Дата и время голосования'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица голосований пользователей';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rates_users`
--
ALTER TABLE `rates_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `rate_user_id` (`rate_user_id`),
  ADD KEY `movie_user_id` (`movie_user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rates_users`
--
ALTER TABLE `rates_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'UID записи';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
