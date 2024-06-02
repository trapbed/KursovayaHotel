-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2024 г., 16:14
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lion`
--

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `date_arrival` date NOT NULL,
  `date_departure` date DEFAULT NULL,
  `status` set('принят','выполнен','отменен') NOT NULL DEFAULT 'принят'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id_book`, `id_user`, `id_room`, `date_arrival`, `date_departure`, `status`) VALUES
(1, 17, 2, '2024-10-06', '2024-10-10', 'выполнен'),
(2, 13, 3, '2024-11-06', NULL, 'отменен');

-- --------------------------------------------------------

--
-- Структура таблицы `buyer`
--

CREATE TABLE `buyer` (
  `id_buyer` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sname` varchar(50) DEFAULT NULL,
  `pathronymic` varchar(50) DEFAULT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `buyer`
--

INSERT INTO `buyer` (`id_buyer`, `id_user`, `name`, `sname`, `pathronymic`, `birthday`, `phone`) VALUES
(1, 2, 'user', 'user', NULL, '2014-02-15', '89528121435'),
(2, 5, NULL, NULL, NULL, '2008-06-03', NULL),
(3, 7, 'Акакий', 'Акакиевич', 'Башмачкин', '1912-10-04', '89170401352'),
(4, 8, NULL, NULL, NULL, '1995-10-13', NULL),
(5, 9, NULL, NULL, NULL, '1994-02-18', NULL),
(6, 10, 'Логин', 'Логинов', 'Логинович', '2001-09-18', '89345556261'),
(7, 11, NULL, NULL, NULL, '2005-10-31', NULL),
(8, 12, NULL, NULL, NULL, '2024-05-06', NULL),
(9, 13, 'polina', 'vl', 'georg', '2005-10-31', '89123456789'),
(10, 15, NULL, NULL, NULL, '2017-09-18', NULL),
(11, 17, NULL, NULL, NULL, '2010-10-10', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cat_rooms`
--

CREATE TABLE `cat_rooms` (
  `id_cat_room` int(11) NOT NULL,
  `name_cat_room` varchar(200) NOT NULL,
  `amount_room_in_room` int(11) NOT NULL,
  `number_pers` varchar(20) NOT NULL,
  `max_pers` int(11) NOT NULL,
  `square_cat_room` int(11) NOT NULL,
  `price_cat_room` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `cat_rooms`
--

INSERT INTO `cat_rooms` (`id_cat_room`, `name_cat_room`, `amount_room_in_room`, `number_pers`, `max_pers`, `square_cat_room`, `price_cat_room`) VALUES
(1, 'стандарт', 1, '1', 1, 16, '3000.00'),
(2, 'люкс', 2, '1, 2, 3', 3, 35, '13000.00'),
(3, 'апартамент', 3, '1, 2, 3 , 4', 4, 48, '20000.00'),
(4, 'студия', 1, '1, 2', 2, 27, '7000.00'),
(5, 'эконом', 1, '1, 2', 2, 10, '3000.00'),
(6, 'семейный', 3, '1, 2, 3, 4', 4, 30, '9000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `cat_services`
--

CREATE TABLE `cat_services` (
  `id_cat_service` int(11) NOT NULL,
  `name_cat_service` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `cat_services`
--

INSERT INTO `cat_services` (`id_cat_service`, `name_cat_service`) VALUES
(1, 'Включены в стоимость'),
(2, 'Красота & здоровье'),
(3, 'Мероприятия & развлечения');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id_room` int(11) NOT NULL,
  `long_name_room` varchar(270) NOT NULL,
  `short_name_room` varchar(150) NOT NULL,
  `desc_room` text NOT NULL,
  `img_room` varchar(70) NOT NULL,
  `id_cat_room` int(11) NOT NULL,
  `amount_in_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id_room`, `long_name_room`, `short_name_room`, `desc_room`, `img_room`, `id_cat_room`, `amount_in_hotel`) VALUES
(2, 'Стандартный одноместный номер с односпальной кроватью', 'стандарт 1 к 1', 'Теплая цветовая гамма, уникальная комплектация, дизайнерская мебель создают особенную атмосферу в номерах. \r\nСтильная и просторная гостиная с мягким диваном, рабочей зоной, кофемашиной и мини-холодильником. ', 'standart1k1.jpg', 1, 6),
(3, 'Семейный номер', 'семейный 3 к 4', 'Насладитесь приятным отдыхом всей семьей в номерах категории «Семейный». Большая кровать и дополнительный диван позволят с комфортом разместиться семье из четырех или пяти человек. В каждом номере данной категории установлена ванная. Площадь номера – 30 кв.м., количество номеров данной категории в отеле – 4.', 'family.jpg', 6, 3),
(4, 'Комфортабельный люкс ', 'люкс 2 к 3', 'Мы рады предложить Вам просторный трехкомнатный номер категории «представительский люкс». Роскошный и действительно просторный номер с уникальными дизайном для особенно требовательных гостей.\r\nНомер впечатляет современными удобствами и необычным европейским интерьером с безупречными цветовыми решениями и дизайнерской мебелью.', 'comfortableLux.jpg\r\n', 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `name_service` varchar(150) NOT NULL,
  `desc_service` text NOT NULL,
  `cat_service` int(11) NOT NULL,
  `img_service` varchar(150) NOT NULL,
  `price_service` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id_service`, `name_service`, `desc_service`, `cat_service`, `img_service`, `price_service`) VALUES
(1, 'Уборка номера', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 1, 'cleaning.jpg', '0.00'),
(2, 'Выдача постельного белья и ср-в личной гигиены', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 1, 'bedSheets.jpg', '0.00'),
(3, 'Wi-Fi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 1, 'wiFi.jpg', '0.00'),
(4, 'Телевидение', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 1, 'tv.jpg', '0.00'),
(5, 'Спортивный клуб', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 2, 'fitnessClub.jpg', '1000.00'),
(6, 'Массаж', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 2, 'massage.jpg', '1700.00'),
(7, 'Занятия с тренером', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 2, 'fitnessWithTrainer.jpg', '2000.00'),
(8, 'Услуги визажиста', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 2, 'visage.jpg', '1300.00'),
(9, 'Услуги парикмахера', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 2, 'hairdresser.jpg', '500.00'),
(10, 'Посещение сауны', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 2, 'sauna.jpg', '1800.00'),
(11, 'Проведение конференций', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 3, 'conference.jpg', '15000.00'),
(12, 'Проведение банкетов', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 3, 'banquet.jpg', '20000.00'),
(13, 'Проведение детских праздников', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 3, 'childParty.jpg', '7000.00'),
(14, 'Посещение мастер классов', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 3, 'classes.jpg', '1000.00'),
(15, 'Посещение мини- клуба', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 3, 'miniClub.jpg', '2200.00'),
(16, 'Посещение караоке', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit temporibus dolores perferendis, esse soluta neque est, ipsam porro consequuntur adipisci, aliquam optio hic aut pariatur nesciunt aperiam at animi et?', 3, 'karaoke.jpg', '1300.00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(5) NOT NULL DEFAULT 'user',
  `blocked` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `role`, `blocked`) VALUES
(1, 'admin@mail.ru', 'cropp', 'admin', '0'),
(2, 'user@mail.ru', 'user', 'user', '1'),
(5, 'milanas@mail.ru', 'milana', 'admin', '0'),
(7, 'akakiy@mail.ru', 'akakiy', 'user', '0'),
(8, 'ulyana@mail.ru', 'pass', 'user', '1'),
(9, 'hope@mail.ru', 'hope', 'user', '0'),
(10, 'loginov@mail.ru', 'loginov', 'user', '0'),
(11, 'login@mail.ru', 'password@mail.ru', 'user', '0'),
(12, 'user@mail.ru', '', 'user', '0'),
(13, 'polina@mail.ru', 'password', 'user', '0'),
(15, 'diamond@mail.com', 'pass', 'user', '0'),
(17, 'trapbed@mail.ru', 'trapbed', 'user', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `id_buyer` (`id_user`,`id_room`),
  ADD KEY `id_room` (`id_room`);

--
-- Индексы таблицы `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`id_buyer`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `cat_rooms`
--
ALTER TABLE `cat_rooms`
  ADD PRIMARY KEY (`id_cat_room`);

--
-- Индексы таблицы `cat_services`
--
ALTER TABLE `cat_services`
  ADD PRIMARY KEY (`id_cat_service`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `id_cat_room` (`id_cat_room`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `cat_service` (`cat_service`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `buyer`
--
ALTER TABLE `buyer`
  MODIFY `id_buyer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `cat_rooms`
--
ALTER TABLE `cat_rooms`
  MODIFY `id_cat_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `cat_services`
--
ALTER TABLE `cat_services`
  MODIFY `id_cat_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `buyer` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`id_cat_room`) REFERENCES `cat_rooms` (`id_cat_room`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`cat_service`) REFERENCES `cat_services` (`id_cat_service`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
