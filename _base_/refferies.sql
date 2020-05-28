-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2020 г., 22:32
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
-- Структура таблицы `refferies`
--

CREATE TABLE `refferies` (
  `reff_id` int(11) NOT NULL,
  `reff_name` varchar(1024) NOT NULL,
  `reff_surname` varchar(1024) NOT NULL,
  `reff_status` varchar(256) NOT NULL,
  `reff_description` text NOT NULL,
  `reff_main_image` varchar(2048) NOT NULL,
  `reff_image_dir` varchar(4096) NOT NULL,
  `reff_age` int(11) DEFAULT NULL,
  `reff_titles` int(11) DEFAULT NULL,
  `reff_cup_name` varchar(1024) NOT NULL,
  `reff_cup_value` varchar(1024) NOT NULL,
  `reff_experience` varchar(1024) NOT NULL,
  `reff_class_start` int(11) DEFAULT NULL,
  `reff_carier_start` int(11) DEFAULT NULL,
  `reff_arp_rating` int(11) DEFAULT NULL,
  `reff_highest_position` int(11) DEFAULT NULL,
  `reff_website` varchar(2048) NOT NULL,
  `reff_facebook` varchar(2048) NOT NULL,
  `reff_google` varchar(2048) NOT NULL,
  `reff_instagram` varchar(2048) NOT NULL,
  `reff_twitter` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `refferies`
--

INSERT INTO `refferies` (`reff_id`, `reff_name`, `reff_surname`, `reff_status`, `reff_description`, `reff_main_image`, `reff_image_dir`, `reff_age`, `reff_titles`, `reff_cup_name`, `reff_cup_value`, `reff_experience`, `reff_class_start`, `reff_carier_start`, `reff_arp_rating`, `reff_highest_position`, `reff_website`, `reff_facebook`, `reff_google`, `reff_instagram`, `reff_twitter`) VALUES
(1, 'Даниил', 'Медведев', 'Играющий', '							<p><strong>Дании́л Серге́евич Медве́дев</strong> (род. 11 февраля 1996 года, Москва, Россия) — российский профессиональный теннисист; финалист Открытого чемпионата США 2019 года в одиночном разряде, победитель семи турниров ATP в одиночном разряде. Один из двух российских теннисистов в XXI веке (наряду с Маратом Сафиным), который доходил до финала турнира Большого шлема в одиночном разряде. </p>\r\n									<p><strong>2018. Первый титул ATP</strong></p>\r\n									<p>В начале сезона 2018 года Медведев выиграл первый титул ATP в карьере. Произошло это на турнире в Сиднее, где он начал путь к победе с квалификационного отбора. В финальном матче, 13 января, российский спортсмен сломил сопротивление австралийца Алекс де Минаура, обыграв его со счётом 1-6, 6-4, 7-5. На Австралийском чемпионате результатом Даниила стал выход во второй раунд. В феврале он вышел в четвертьфинал зального турнира в Роттердаме. Грунтовую часть сезона Медведев провёл неудачно, выиграв на всех турнирах лишь один матч. В июле на Уимблдоне он смог дойти до стадии третьего раунда. 25 августа 22-летний россиянин выиграл турнир в Уинстон-Сейлеме, в финале обыграв американца Стива Джонсона — 6:4, 6:4.</p>\r\n									<p>Во втором раунде Открытого чемпионата США 2018 года он в четырёх сетах переиграл 15-ю ракетку мира Стефаноса Циципаса и впервые вышел в третий раунд турнира. В сентябре Даниил дошёл до 1/4 финала на турнире в Санкт-Петербурге. В начале октября ему удалось завоевать третий в сезоне и за карьеру титул ATP. Медведев стал чемпионом на турнире серии АТР 500 в Токио. В финале он обыграл любимца местной публики Кэя Нисикори со счётом 6-2, 6-4. Победа в Японии позволила российскому теннисисту подняться на 22-е место в рейтинге. До конца сезона Медведев дважды сумел дойти до полуфинала на турнирах в Москве и Базеле. По итогам сезона он смог войти в Топ-20 и занять 16-ю строчку рейтинга.</p>\r\n', 'medvedev3.png', 'daniil_medvedev', 24, 7, 'Win/Loss', '139/80', '18+ лет', 3, 2014, 5, 4, 'http://iamdesigning.com', '', '', '', ''),
(2, 'Андрей', 'Рублев', '', '', 'rublev3.png', '', 22, 4, 'Win/Loss', '106/82', '19+ лет', 0, 0, 0, 0, '', '', '', '', ''),
(3, 'Карен', 'Хачанов', '', '', 'khachanov2.png', '', 23, 4, 'Win/Loss', '128/103', '20+ лет', NULL, NULL, NULL, NULL, '', '', '', '', ''),
(4, 'Евгений', 'Донской', '', '', 'donskoy.png', '', 30, NULL, 'ATP Ranking', '115', '23+ лет', NULL, NULL, NULL, NULL, '', '', '', 'https://www.instagram.com/edonskoy/', ''),
(5, 'Светлана', 'Кузнецова', '', '', 'kuznetsova.png', '', 34, 34, 'Win/Loss', '922/471', '27+ лет', NULL, NULL, NULL, NULL, '', '', '', '', ''),
(6, 'Елена', 'Веснина', '', '', 'vesnina.png', '', 33, 21, 'Win/Loss', '836/555', '26+ лет', NULL, NULL, NULL, NULL, '', '', '', '', ''),
(7, 'Анастасия', 'Павлюченкова', '', '', 'pavlyuchenkova.png', '', 28, 17, 'Win/Loss', '635/441', '22+ лет', NULL, NULL, NULL, NULL, '', 'https://www.facebook.com/AnastasiaPavlyuchenkova/', '', 'https://www.instagram.com/nastia_pav/', 'https://twitter.com/NastiaPav'),
(8, 'Екатерина', 'Макарова', '', '', 'makarova.png', '', 31, 17, 'Win/Loss', '812/487', '25+ лет', NULL, NULL, NULL, NULL, '', '', '', '', ''),
(9, 'Динара', 'Сафина', '', '', '', '', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', ''),
(10, 'Мария', 'Кириленко', '', '', '', '', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `refferies`
--
ALTER TABLE `refferies`
  ADD PRIMARY KEY (`reff_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `refferies`
--
ALTER TABLE `refferies`
  MODIFY `reff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
