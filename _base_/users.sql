-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 05 2020 г., 12:43
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
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_login` varchar(64) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `mail_confirm` varchar(64) NOT NULL,
  `user_hash` varchar(32) DEFAULT NULL,
  `user_surname` varchar(32) DEFAULT NULL,
  `user_name` varchar(32) DEFAULT NULL,
  `user_city` varchar(32) DEFAULT NULL,
  `user_mail` varchar(32) DEFAULT NULL,
  `user_phone` varchar(32) DEFAULT NULL,
  `user_role` varchar(6) NOT NULL DEFAULT 'mgr',
  `user_status` varchar(6) NOT NULL DEFAULT 'false',
  `id_vk` char(16) NOT NULL DEFAULT '' COMMENT 'ID пользователя в VKontakte',
  `id_ok` char(16) NOT NULL DEFAULT '' COMMENT 'ID пользователя в Одноклассниках',
  `id_facebook` char(16) NOT NULL DEFAULT '' COMMENT 'ID пользователя в Facebook',
  `id_google` char(16) NOT NULL DEFAULT '' COMMENT 'ID пользователя в Google',
  `id_mailru` char(16) NOT NULL DEFAULT '' COMMENT 'ID пользователя в Mail.ru',
  `id_yandex` char(16) NOT NULL DEFAULT '' COMMENT 'ID пользователя в Yandex',
  `id_instagram` char(16) NOT NULL DEFAULT '' COMMENT 'ID пользователя в Instagram'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `mail_confirm`, `user_hash`, `user_surname`, `user_name`, `user_city`, `user_mail`, `user_phone`, `user_role`, `user_status`, `id_vk`, `id_ok`, `id_facebook`, `id_google`, `id_mailru`, `id_yandex`, `id_instagram`) VALUES
(1, 'serge', 'f25c28fa4d121e1ac3a1286c59822424', '', '00a35c611126046a729d794b1b33c3af', 'Цветков', 'Сергей', 'Ростов-на-Дону', 'Tsvetkov-SA@grmp.ru', '', 'mgr', 'true', '', '', '', '', '', '', ''),
(54, 'z00m.serge@gmail.com', 'f25c28fa4d121e1ac3a1286c59822424', '74695e4a6b7bb7ca8c083cbdfa69dc54', '146cd21285d924de73c49f51d999ebe3', NULL, NULL, NULL, 'z00m.serge@gmail.com', NULL, 'mgr', 'true', '', '', '', '', '', '', ''),
(55, 'marinichev@gmail.com', 'fbc2319fc1d590a922446e78ae0bcffe', '1ede2b7e8bd3ffd284b87872e5e88b54', '707baf8f6be1f468ddd63235f38d515b', NULL, NULL, NULL, 'marinichev@gmail.com', NULL, 'mgr', 'true', '', '', '', '', '', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `id_vk` (`id_vk`),
  ADD KEY `id_ok` (`id_ok`),
  ADD KEY `id_facebook` (`id_facebook`),
  ADD KEY `id_google` (`id_google`),
  ADD KEY `id_mailru` (`id_mailru`),
  ADD KEY `id_yandex` (`id_yandex`),
  ADD KEY `id_instagram` (`id_instagram`),
  ADD KEY `user_login` (`user_login`),
  ADD KEY `user_password` (`user_password`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
