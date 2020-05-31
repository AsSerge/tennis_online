-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 31 2020 г., 10:24
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
  `reff_id` int(11) NOT NULL COMMENT 'ID',
  `reff_name` varchar(256) NOT NULL COMMENT 'Имя',
  `reff_surname` varchar(256) NOT NULL COMMENT 'Фамилия',
  `reff_patronymic` varchar(255) NOT NULL COMMENT 'Отчество',
  `reff_birth` date NOT NULL COMMENT 'Дата рождения',
  `reff_status` varchar(256) NOT NULL COMMENT 'Статус',
  `reff_description` text NOT NULL COMMENT 'Описание',
  `reff_main_image` varchar(128) NOT NULL COMMENT 'Главное изображение',
  `reff_image_dir` varchar(256) NOT NULL COMMENT 'Каталог изображений',
  `reff_titles_single` int(11) DEFAULT NULL COMMENT 'Одиночных титулов',
  `reff_titles_double` int(11) NOT NULL COMMENT 'Парных титулов',
  `reff_wl_single` varchar(128) NOT NULL COMMENT 'Win/Lost одиночных',
  `reff_wl_double` varchar(128) NOT NULL COMMENT 'Win/Lost парных',
  `reff_rating_atp_single` varchar(20) NOT NULL COMMENT 'Рейтинг ATP мужчины',
  `reff_rating_atp_double` varchar(20) NOT NULL,
  `reff_rating_wta_single` varchar(20) NOT NULL COMMENT 'Рейтинг WTA женщины',
  `reff_rating_wta_double` varchar(20) NOT NULL,
  `reff_high_pos_single` int(11) NOT NULL COMMENT 'Наивысшая позиция одиночная',
  `reff_high_pos_single_date` date NOT NULL COMMENT 'Дата',
  `reff_high_pos_double` int(11) NOT NULL COMMENT 'Наивысшая позиция парная',
  `reff_high_pos_double_date` date NOT NULL COMMENT 'Дата',
  `reff_tags` text NOT NULL COMMENT 'Тэги',
  `reff_class_start` int(11) DEFAULT NULL COMMENT 'Начало обучения',
  `reff_carier_start` varchar(128) DEFAULT NULL COMMENT 'Начало карьеры',
  `reff_prize` int(11) NOT NULL COMMENT 'Призовые за карьеру',
  `reff_height` int(11) NOT NULL COMMENT 'Рост',
  `reff_weight` int(11) NOT NULL COMMENT 'Вес',
  `reff_website` varchar(256) NOT NULL COMMENT 'Вебсайт',
  `reff_facebook` varchar(256) NOT NULL COMMENT 'Facebook',
  `reff_google` varchar(256) NOT NULL COMMENT 'Google',
  `reff_instagram` varchar(256) NOT NULL COMMENT 'Instagram',
  `reff_twitter` varchar(256) NOT NULL COMMENT 'Twitter',
  `reff_vkontakte` varchar(256) NOT NULL,
  `reff_wiki` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `refferies`
--

INSERT INTO `refferies` (`reff_id`, `reff_name`, `reff_surname`, `reff_patronymic`, `reff_birth`, `reff_status`, `reff_description`, `reff_main_image`, `reff_image_dir`, `reff_titles_single`, `reff_titles_double`, `reff_wl_single`, `reff_wl_double`, `reff_rating_atp_single`, `reff_rating_atp_double`, `reff_rating_wta_single`, `reff_rating_wta_double`, `reff_high_pos_single`, `reff_high_pos_single_date`, `reff_high_pos_double`, `reff_high_pos_double_date`, `reff_tags`, `reff_class_start`, `reff_carier_start`, `reff_prize`, `reff_height`, `reff_weight`, `reff_website`, `reff_facebook`, `reff_google`, `reff_instagram`, `reff_twitter`, `reff_vkontakte`, `reff_wiki`) VALUES
(1, 'Даниил', 'Медведев', 'Сергеевич', '1996-02-11', 'Спортсмен', '<p><strong>Дании́л Серге́евич Медве́дев</strong> (род. 11 февраля 1996 года, Москва, Россия) — российский профессиональный теннисист; финалист Открытого чемпионата США 2019 года в одиночном разряде, победитель семи турниров ATP в одиночном разряде. Один из двух российских теннисистов в XXI веке (наряду с Маратом Сафиным), который доходил до финала турнира Большого шлема в одиночном разряде. </p>\r\n<p><strong>2018. Первый титул ATP</strong></p>				<p>В начале сезона 2018 года Медведев выиграл первый титул ATP в карьере. Произошло это на турнире в Сиднее, где он начал путь к победе с квалификационного отбора. В финальном матче, 13 января, российский спортсмен сломил сопротивление австралийца Алекс де Минаура, обыграв его со счётом 1-6, 6-4, 7-5. На Австралийском чемпионате результатом Даниила стал выход во второй раунд. В феврале он вышел в четвертьфинал зального турнира в Роттердаме. Грунтовую часть сезона Медведев провёл неудачно, выиграв на всех турнирах лишь один матч. В июле на Уимблдоне он смог дойти до стадии третьего раунда. 25 августа 22-летний россиянин выиграл турнир в Уинстон-Сейлеме, в финале обыграв американца Стива Джонсона — 6:4, 6:4.</p>\r\n<p>Во втором раунде Открытого чемпионата США 2018 года он в четырёх сетах переиграл 15-ю ракетку мира Стефаноса Циципаса и впервые вышел в третий раунд турнира. В сентябре Даниил дошёл до 1/4 финала на турнире в Санкт-Петербурге. В начале октября ему удалось завоевать третий в сезоне и за карьеру титул ATP. Медведев стал чемпионом на турнире серии АТР 500 в Токио. В финале он обыграл любимца местной публики Кэя Нисикори со счётом 6-2, 6-4. Победа в Японии позволила российскому теннисисту подняться на 22-е место в рейтинге. До конца сезона Медведев дважды сумел дойти до полуфинала на турнирах в Москве и Базеле. По итогам сезона он смог войти в Топ-20 и занять 16-ю строчку рейтинга.</p>\r\n', 'medvedev3.png', 'daniil_medvedev', 7, 0, '139/80', '11/16', '5', '181', '', '', 4, '2019-09-09', 170, '2019-08-19', 'Sydney (2018); Tokyo (2018); Winston-Salem (2018); Sofia (2019); ATP Masters 1000 Cincinnati (2019); St. Petersburg (2019); ATP Masters 1000 Shanghai (2019)', 6, '2014', 11230233, 198, 83, '', '', '', '', 'https://twitter.com/daniilmedwed', '', 'https://ru.wikipedia.org/wiki/%D0%9C%D0%B5%D0%B4%D0%B2%D0%B5%D0%B4%D0%B5%D0%B2,_%D0%94%D0%B0%D0%BD%D0%B8%D0%B8%D0%BB_%D0%A1%D0%B5%D1%80%D0%B3%D0%B5%D0%B5%D0%B2%D0%B8%D1%87'),
(2, 'Андрей', 'Рублев', 'Андреевич', '1997-10-20', 'Спортсмен', '', 'rublev3.png', 'andrey_rublev', 4, 1, '106/82', '29/36', '14', '82', '', '', 14, '2020-02-17', 74, '2020-01-06', 'Кубок Кремля (2015); Umag (2017); Кубок Кремля (2019); Doha (2020); Adelaide (2020)', 3, '2014', 5126914, 188, 70, '', '', '', '', '', '', 'https://ru.wikipedia.org/wiki/%D0%A0%D1%83%D0%B1%D0%BB%D1%91%D0%B2,_%D0%90%D0%BD%D0%B4%D1%80%D0%B5%D0%B9_%D0%90%D0%BD%D0%B4%D1%80%D0%B5%D0%B5%D0%B2%D0%B8%D1%87'),
(3, 'Карен', 'Хачанов', 'Абгарович', '1996-05-21', 'Спортсмен', '', 'khachanov2.png', 'karen_khachanov', 4, 0, '128/103', '31/47', '15', '76', '', '', 8, '2019-07-15', 64, '2018-05-21', 'Chengdu (2016); Marseille (2018); Кубок Кремля (2018); ATP Masters 1000 Paris (2018)', 3, '2013', 8281872, 198, 87, '', '', '', '', '', '', 'https://ru.wikipedia.org/wiki/%D0%A5%D0%B0%D1%87%D0%B0%D0%BD%D0%BE%D0%B2,_%D0%9A%D0%B0%D1%80%D0%B5%D0%BD_%D0%90%D0%B1%D0%B3%D0%B0%D1%80%D0%BE%D0%B2%D0%B8%D1%87'),
(4, 'Евгений', 'Донской', 'Евгеньевич', '1990-05-09', 'Cпортсмен', '', 'donskoy.png', 'evgeny_donskoy', 0, 0, '53/109', '16/30', '115', '973', '', '', 65, '2013-07-08', 161, '2012-11-05', '', 7, '2007', 2927231, 185, 75, '', '', '', 'https://www.instagram.com/edonskoy/', '', '', 'https://ru.wikipedia.org/wiki/%D0%94%D0%BE%D0%BD%D1%81%D0%BA%D0%BE%D0%B9,_%D0%95%D0%B2%D0%B3%D0%B5%D0%BD%D0%B8%D0%B9_%D0%95%D0%B2%D0%B3%D0%B5%D0%BD%D1%8C%D0%B5%D0%B2%D0%B8%D1%87'),
(5, 'Светлана', 'Кузнецова', 'Александровна', '1985-06-27', 'Спортсмен', '', 'kuznetsova.png', 'svetlana_kuznetsova', 19, 17, '663/336', '259/135', '', '', '-', '32', 2, '2007-09-10', 3, '2004-06-07', 'Олимпийские игры (2016); US Open (2004); Roland Garros (2009); Australian Open (2005, 2012); Кубка Федерации (2004, 2007, 2008); Кубок Кремля (2015, 2016)', 7, '2000', 25389852, 174, 73, 'https://www.svetlanakuznetsova27.com/', 'https://www.facebook.com/svetlanakuz27/?fref=ts', '', 'https://www.instagram.com/svetlanak27/?hl=ru', 'https://twitter.com/KuznetsovaNews', 'https://vk.com/svetlanak27_official', 'https://ru.wikipedia.org/wiki/%D0%9A%D1%83%D0%B7%D0%BD%D0%B5%D1%86%D0%BE%D0%B2%D0%B0,_%D0%A1%D0%B2%D0%B5%D1%82%D0%BB%D0%B0%D0%BD%D0%B0_%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80%D0%BE%D0%B2%D0%BD%D0%B0'),
(6, 'Елена', 'Веснина', 'Сергеевна', '1986-08-01', 'Спортсмен', '', 'vesnina.png', 'elena_vesnina', 3, 25, '416/336', '420/219', '', '', '-', '-', 13, '2017-03-20', 1, '2018-06-11', 'Олимийские игры (2016); Roland Garros (2013); US Open (2014); Wimbledon (2017); Australian Open (2016); Кубок Федерации (2007, 2008); Québec City (2005); Hobart (2007); Indian Wells (2008, 2013); Charleston (2013); Linz (2013); Moscow (2015); Montréal (2016); Dubai (2017); Toronto (2017); Madrid (2018) ', 7, '2002', 12527014, 176, 60, '', '', '', '', '', '', 'https://ru.wikipedia.org/wiki/%D0%92%D0%B5%D1%81%D0%BD%D0%B8%D0%BD%D0%B0,_%D0%95%D0%BB%D0%B5%D0%BD%D0%B0_%D0%A1%D0%B5%D1%80%D0%B3%D0%B5%D0%B5%D0%B2%D0%BD%D0%B0'),
(7, 'Анастасия', 'Павлюченкова', 'Сергеевна', '1991-07-03', 'Спортсмен', '', 'pavlyuchenkova.png', 'anastasia_pavlyuchenkova', 17, 13, '425/289', '210/152', '', '', '30', '114', 13, '2011-07-04', 21, '2013-09-16', 'Олимпийские игры (2008); Fès (2008); Monterrey (2010); Istanbul (2010); Brisbane (2011); Monterrey (2011); Charleston (2012); Monterrey (2013); Madrid (2013); Oeiras(2013); Кубок Кремля (2014); Paris (2014); Linz (2015); Sydney (2017); Rabat (2017); Monterrey (2017); Hong Kong (2017); Strasbourg (2018)', 6, '2005', 10219985, 177, 72, '', 'https://www.facebook.com/AnastasiaPavlyuchenkova/', '', 'https://www.instagram.com/nastia_pav/', 'https://twitter.com/NastiaPav', '', 'https://ru.wikipedia.org/wiki/%D0%9F%D0%B0%D0%B2%D0%BB%D1%8E%D1%87%D0%B5%D0%BD%D0%BA%D0%BE%D0%B2%D0%B0,_%D0%90%D0%BD%D0%B0%D1%81%D1%82%D0%B0%D1%81%D0%B8%D1%8F_%D0%A1%D0%B5%D1%80%D0%B3%D0%B5%D0%B5%D0%B2%D0%BD%D0%B0'),
(8, 'Екатерина', 'Макарова', 'Валерьевна', '1988-06-07', 'Завершила карьеру', '', 'makarova.png', 'ekaterina_makarova', 6, 24, '436/307', '376/180', '', '', '-', '-', 8, '2015-04-06', 1, '2018-06-11', 'Олимпийские игры (2016); Fès (2009); Eastbourne (2010);  Кубок Кремля (2012); Beijing (2012); Roland Garros (2013); Indian Wells (2013); US Open (2014); Pattaya City (2014); Montréal (2016); WTA Finals (2016); Toronto (2017); Wimbledon (2017); Washington D.C. (2017); Dubai (2017); Cincinnati (2017); Madrid (2018); St. Petersburg (2019)', 6, '2004', 13229362, 180, 65, '', '', '', '', '', '', 'https://ru.wikipedia.org/wiki/%D0%9C%D0%B0%D0%BA%D0%B0%D1%80%D0%BE%D0%B2%D0%B0,_%D0%95%D0%BA%D0%B0%D1%82%D0%B5%D1%80%D0%B8%D0%BD%D0%B0_%D0%92%D0%B0%D0%BB%D0%B5%D1%80%D1%8C%D0%B5%D0%B2%D0%BD%D0%B0'),
(9, 'Динара', 'Сафина', 'Мубиновна', '1986-04-27', 'Завершила карьеру', '', '', 'dinara_safina', 16, 12, '360/173', '181/91', '', '', '-', '-', 1, '2009-04-20', 8, '2008-05-12', 'Олимпийские игры (2008); Sopot (2002); Palermo (2003); Beijing (2004); Hertogenbosch (2005); Paris (2005); Antwerp (2006); Gold Coast (2006); US Open (2007); Gold Coast (2007); Gold Coast(2008); Indian Wells (2008); Tokyo (2008); Montréal (2008); Los Angeles (2008); Berlin (2008); Portoroz (2009); Madrid (2009); Rome (2009); Kuala Lumpur (2011)', 8, '2000', 10585640, 182, 70, '', '', '', '', '', '', 'https://ru.wikipedia.org/wiki/%D0%A1%D0%B0%D1%84%D0%B8%D0%BD%D0%B0,_%D0%94%D0%B8%D0%BD%D0%B0%D1%80%D0%B0_%D0%9C%D1%83%D0%B1%D0%B8%D0%BD%D0%BE%D0%B2%D0%BD%D0%B0'),
(10, 'Мария', 'Кириленко', 'Юрьевна', '1987-01-25', 'Завершила карьеру', '', '', 'maria_kirilenko', 9, 12, '364/257', '255/150', '', '', '-', '-', 10, '2013-06-10', 5, '2011-10-24', 'Олимпийские Игры (2012); Birmingham (2004); Tokyo (2005); Beijing (2005); Doha (2007); Kolkata (2007); Cincinnati (2008); Oeiras (2008); Barcelona (2008); Seoul (2008); Кубок Кремля (2009); Cincinnati (2010); San Diego (2010); Stanford (2011); Madrid (2011); Miami (2012); Pattaya City (2013)', 7, '2001', 6855919, 174, 61, '', '', '', '', '', '', 'https://ru.wikipedia.org/wiki/%D0%9A%D0%B8%D1%80%D0%B8%D0%BB%D0%B5%D0%BD%D0%BA%D0%BE,_%D0%9C%D0%B0%D1%80%D0%B8%D1%8F_%D0%AE%D1%80%D1%8C%D0%B5%D0%B2%D0%BD%D0%B0');

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
  MODIFY `reff_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
