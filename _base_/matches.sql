-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 08 2020 г., 21:59
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
-- Структура таблицы `matches`
--

CREATE TABLE `matches` (
  `match_id` int(10) UNSIGNED NOT NULL COMMENT 'ID конкурса',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Статус конкурса: 0 - не активен, 1 - активен',
  `name` varchar(255) NOT NULL COMMENT 'Название конкурса',
  `begin_date` date NOT NULL COMMENT 'Дата начала',
  `end_date` date NOT NULL COMMENT 'Дата окончания'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица конкурсов';

--
-- Дамп данных таблицы `matches`
--

INSERT INTO `matches` (`match_id`, `status`, `name`, `begin_date`, `end_date`) VALUES
(1, 1, 'Удивительный теннис', '2020-06-12', '2020-06-26'),
(2, 1, 'Семейный теннис', '2020-06-12', '2020-06-26'),
(3, 0, 'Теннисная прокачка', '2020-06-27', '2020-07-07'),
(4, 0, 'Свой конкурс', '2020-06-27', '2020-07-07');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID конкурса', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
