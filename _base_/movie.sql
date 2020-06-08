-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 08 2020 г., 06:47
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
-- Структура таблицы `movie`
--

CREATE TABLE `movie` (
  `mov_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `match_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'ID конкурса, в котором участвует видеоролик',
  `mov_status` int(11) NOT NULL DEFAULT 1 COMMENT '0 - блокировка, 1 - ждет подтверждения, 2 - опубликован ',
  `mov_name` varchar(512) NOT NULL,
  `mov_description` text NOT NULL,
  `mov_link` varchar(1024) NOT NULL,
  `mov_link_type` varchar(128) NOT NULL,
  `mov_added` date NOT NULL,
  `mov_last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `mov_age_cat` varchar(128) NOT NULL,
  `voteuser_count` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Общее количество проголосовавших за ролик пользователей',
  `voteuser_points` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Общее количество баллов, выставленных проголосовавшими пользователями этому ролику ',
  `voteuser_avg` double UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Среднее значение результатов голосования по текущему видео',
  `reff_unique` double UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Среднее значение оценки по критерию: Уникальность',
  `reff_humor` double UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Среднее значение оценки по критерию: Юмор',
  `reff_competition` double UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Среднее значение оценки по критерию: Состязательность',
  `reff_hardness` double UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Среднее значение оценки по критерию: Сложность',
  `reff_usefulness` double UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Среднее значение оценки по критерию: Полезность',
  `reff_points` double UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Сумма баллов итоговых оценок видеоролика всеми членами жюри'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `movie`
--

INSERT INTO `movie` (`mov_id`, `user_id`, `match_id`, `mov_status`, `mov_name`, `mov_description`, `mov_link`, `mov_link_type`, `mov_added`, `mov_last_update`, `mov_age_cat`, `voteuser_count`, `voteuser_points`, `voteuser_avg`, `reff_unique`, `reff_humor`, `reff_competition`, `reff_hardness`, `reff_usefulness`, `reff_points`) VALUES
(1, 70, 3, 1, 'Australian Open 2018', 'Australian Open 2018 / 3-й Круг / Анжелик Кербер (Германия) – Мария Шарапова (Россия)', 'https://youtu.be/CdW9D7hhj0Y', 'youtube', '2020-06-06', '2020-06-06 18:27:58', 'Любой', 3, 8, 2.6667, 3.6667, 5.6667, 5, 7, 5.6667, 162),
(2, 70, 3, 2, 'Современный удар справа', 'Современный удар справа. Modern tennis forehand.\r\nУдар справа — один из основных ударов в теннисе, и что самое интересное — с него начинается все обучение.', 'https://youtu.be/K_7wBxg4aPs', 'youtube', '2020-06-06', '2020-06-06 18:29:28', 'до 15 лет', 2, 5, 2.5, 0, 0, 0, 0, 0, 0),
(4, 70, 3, 1, 'Eurosport | Home of Tennis', 'DixonBaxi partner with Eurosport to create the ‘Home of Tennis’ with a kinetic identity capturing the sensation of playing across multiple surfaces.', 'https://vimeo.com/325650740', 'vimeo', '2020-06-06', '2020-06-06 18:51:28', 'Любой', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 70, 1, 1, 'Подача один из самых важных элементов игры', 'Подача один из самых важных элементов игры в теннисе, Начинать разучивать базовую технику Крученой  подачи целесообразно держа ракетку', 'https://ok.ru/video/2612135213', 'ok', '2020-06-06', '2020-06-06 18:54:04', 'Любой', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 70, 1, 1, 'Покатушки', 'Покатушки - ролик на VK', '<iframe src=\"//vk.com/video_ext.php?oid=136507481&id=456239019&hash=ea5a501d2274f498&hd=2\" width=\"853\" height=\"480\" frameborder=\"0\" allowfullscreen></iframe>', 'vk', '2020-06-06', '2020-06-06 19:00:00', 'взрослые', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 70, 2, 1, 'Это название ролика', 'Это ролик на vimeo', 'https://vimeo.com/77270461', 'vimeo', '2020-06-07', '2020-06-07 15:11:38', 'до 13 лет', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 70, 1, 1, 'nastasia Pavlyuchenkova', 'Это какое-то описание ролика про Павлюченкову', 'https://www.instagram.com/p/CAIm3SDn54v', 'instagram', '2020-06-07', '2020-06-07 15:25:29', 'до 13 лет', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 70, 2, 1, 'Царева', 'Это совершенно новое описание', '<iframe src=\"https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fbyutistudia.tsareva%2Fvideos%2F618819275511354%2F&show_text=0&width=560\" width=\"560\" height=\"315\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\" allowFullScreen=\"true\"></iframe>', 'facebook', '2020-06-07', '2020-06-07 15:38:19', 'Любой', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 70, 1, 1, 'Tiktok', 'sdfg sdf gsdgsdfg', '<blockquote class=\"tiktok-embed\" cite=\"https://www.tiktok.com/@user014672575/video/6835512975684537606\" data-video-id=\"6835512975684537606\" style=\"max-width: 605px;min-width: 325px;\" > <section> <a target=\"_blank\" title=\"@user014672575\" href=\"https://www.tiktok.com/@user014672575\">@user014672575</a> <p>CNN Tennis</p> <a target=\"_blank\" title=\"♬ \" href=\"https://www.tiktok.com\">♬ </a> </section> </blockquote> <script async src=\"https://www.tiktok.com/embed.js\"></script>', 'tiktok', '2020-06-07', '2020-06-07 15:50:40', 'до 8 лет', 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mov_id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `mov_status` (`mov_status`),
  ADD KEY `mov_name` (`mov_name`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `movie`
--
ALTER TABLE `movie`
  MODIFY `mov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
