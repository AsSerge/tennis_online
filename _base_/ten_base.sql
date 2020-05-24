-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 24 2020 г., 22:05
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
-- База данных: `ten_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `mail_confirm` varchar(1024) NOT NULL,
  `user_hash` varchar(32) DEFAULT NULL,
  `user_surname` varchar(32) DEFAULT NULL,
  `user_name` varchar(32) DEFAULT NULL,
  `user_city` varchar(32) DEFAULT NULL,
  `user_mail` varchar(32) DEFAULT NULL,
  `user_phone` varchar(32) DEFAULT NULL,
  `user_role` varchar(6) NOT NULL DEFAULT 'mgr',
  `user_status` varchar(6) NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `mail_confirm`, `user_hash`, `user_surname`, `user_name`, `user_city`, `user_mail`, `user_phone`, `user_role`, `user_status`) VALUES
(1, 'serge', 'f25c28fa4d121e1ac3a1286c59822424', '', '78b23a5e3df8a5b2cc12a4cfa77a44a1', 'Цветков', 'Сергей', 'Ростов-на-Дону', 'Tsvetkov-SA@grmp.ru', '', 'mgr', 'true'),
(36, 'zoom@tk-ug.ru', '0d3eb9e474d739879f1ff9bf8c2abaea', '8a7a51943d76c4af588060b711a753f9', 'bb853218cdadd449c17a252a26661ac7', NULL, NULL, NULL, 'zoom@tk-ug.ru', NULL, 'mgr', 'true');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
