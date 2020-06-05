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
-- Структура таблицы `rates_jury`
--

CREATE TABLE `rates_jury` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'UID записи',
  `match_id` int(10) UNSIGNED NOT NULL COMMENT 'ID конкурса',
  `movie_id` int(10) UNSIGNED NOT NULL COMMENT 'ID видеоролика',
  `movie_user_id` int(10) UNSIGNED NOT NULL COMMENT 'ID пользователя - создателя ролика',
  `reff_id` int(10) UNSIGNED NOT NULL COMMENT 'ID голосующего члена жюри',
  `rate_unique` int(10) UNSIGNED NOT NULL COMMENT 'Уникальность (Критерий голосования)',
  `rate_humor` int(10) UNSIGNED NOT NULL COMMENT 'Юмор (Критерий голосования)',
  `rate_competition` int(10) UNSIGNED NOT NULL COMMENT 'Состязательность (Критерий голосования)',
  `rate_hardness` int(10) UNSIGNED NOT NULL COMMENT 'Сложность (Критерий голосования)',
  `rate_usefulness` int(10) UNSIGNED NOT NULL COMMENT 'Полезность (Критерий голосования)',
  `myprize_status` int(10) UNSIGNED NOT NULL COMMENT 'Признак Голосования <Мой приз>: 0 - ничего; 1 - отмечен как номинант; 2 - выбран как победитель',
  `myprize_data` char(32) NOT NULL COMMENT 'Дополнительные данные, по которым можно идентифицировать приз члена жюри (числовой или текстовый идентификатор)',
  `rate_ip` char(15) NOT NULL COMMENT 'IP адрес с которого было голосование',
  `rate_ts` datetime NOT NULL COMMENT 'Дата и время голосования'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица голосований членов жюри';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rates_jury`
--
ALTER TABLE `rates_jury`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `movie_user_id` (`movie_user_id`),
  ADD KEY `reff_id` (`reff_id`) USING BTREE,
  ADD KEY `myprize` (`myprize_status`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rates_jury`
--
ALTER TABLE `rates_jury`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'UID записи';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
