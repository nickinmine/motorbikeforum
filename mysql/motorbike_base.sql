-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Май 23 2023 г., 11:11
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = 'Europe/Moscow';


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `motorbike_base`
--
CREATE DATABASE IF NOT EXISTS `motorbike_base` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `motorbike_base`;

-- --------------------------------------------------------

--
-- Структура таблицы `album`
--

CREATE TABLE `album` (
  `album_id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `album_image`
--

CREATE TABLE `album_image` (
  `album_id` int NOT NULL,
  `image_id` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ban_list`
--

CREATE TABLE `ban_list` (
  `user_uuid` varchar(36) NOT NULL,
  `ban_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `comment_id` int NOT NULL,
  `thread_id` int NOT NULL,
  `content` text NOT NULL,
  `user_uuid` varchar(36) NOT NULL,
  `publish_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `comment_chosen`
--

CREATE TABLE `comment_chosen` (
  `user_uuid` varchar(36) NOT NULL,
  `comment_id` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `image_id` int NOT NULL,
  `image_uri` varchar(100) NOT NULL,
  `min_uri` varchar(100) NOT NULL,
  `user_uuid` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`image_id`, `image_uri`, `min_uri`, `user_uuid`) VALUES(1, 'https://i.ibb.co/rMTTNFN/1570955019-32-1.jpg', 'https://i.ibb.co/6bVVLrL/1570955019-32-1.jpg', '34a6775c-dee6-11ed-b95c-02503e34a03e');

-- --------------------------------------------------------

--
-- Структура таблицы `notification`
--

CREATE TABLE `notification` (
  `notification_id` int NOT NULL,
  `user_uuid` varchar(36) NOT NULL,
  `notification_type` varchar(50) NOT NULL,
  `get_date` datetime NOT NULL,
  `notification_uri` datetime DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `notification_type`
--

CREATE TABLE `notification_type` (
  `notification_type` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `notification_type`
--

INSERT INTO `notification_type` (`notification_type`, `description`) VALUES('ban', 'Блокировка администратором');
INSERT INTO `notification_type` (`notification_type`, `description`) VALUES('comment_answer', 'Ответ на Ваш комментарий');
INSERT INTO `notification_type` (`notification_type`, `description`) VALUES('comment_delete', 'Ваш комментарий удалён администратором');
INSERT INTO `notification_type` (`notification_type`, `description`) VALUES('news_accept', 'Ваша новость опубликована администратором');
INSERT INTO `notification_type` (`notification_type`, `description`) VALUES('news_reject', 'Ваша новость отклонена администратором');
INSERT INTO `notification_type` (`notification_type`, `description`) VALUES('theme_answer', 'Ответ в Вашей теме');
INSERT INTO `notification_type` (`notification_type`, `description`) VALUES('theme_delete', 'Ваша тема удалена администратором');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `role` varchar(20) NOT NULL,
  `description` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`role`, `description`) VALUES('admin', 'Администратор');
INSERT INTO `role` (`role`, `description`) VALUES('user', 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE `tag` (
  `tag` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`tag`, `description`) VALUES('ad', 'Реклама');
INSERT INTO `tag` (`tag`, `description`) VALUES('contacts', 'Знакомства');
INSERT INTO `tag` (`tag`, `description`) VALUES('dtp', 'ДТП');
INSERT INTO `tag` (`tag`, `description`) VALUES('equipment', 'Экипировка');
INSERT INTO `tag` (`tag`, `description`) VALUES('job', 'Работа');
INSERT INTO `tag` (`tag`, `description`) VALUES('movement', 'Приёмы управления');
INSERT INTO `tag` (`tag`, `description`) VALUES('other', 'Разное');
INSERT INTO `tag` (`tag`, `description`) VALUES('sport', 'Спорт');
INSERT INTO `tag` (`tag`, `description`) VALUES('stories', 'Истории');
INSERT INTO `tag` (`tag`, `description`) VALUES('technique', 'Техника');
INSERT INTO `tag` (`tag`, `description`) VALUES('trips', 'Путешествия');

-- --------------------------------------------------------

--
-- Структура таблицы `thread`
--

CREATE TABLE `thread` (
  `thread_id` int NOT NULL,
  `user_uuid` varchar(36) NOT NULL,
  `header` text NOT NULL,
  `content` text NOT NULL,
  `publish_date` datetime DEFAULT NULL,
  `is_news` blob,
  `view_num` int NOT NULL,
  `tag` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `thread_chosen`
--

CREATE TABLE `thread_chosen` (
  `user_uuid` varchar(36) NOT NULL,
  `thread_id` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

CREATE TABLE `token` (
  `user_uuid` varchar(36) NOT NULL,
  `token` varchar(32) NOT NULL,
  `ipv4` varchar(15) DEFAULT NULL,
  `expires_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_uuid` varchar(36) NOT NULL,
  `name` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `experience` int NOT NULL,
  `reg_date` date NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar_id` int NOT NULL,
  `motorbike` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_uuid`, `name`, `nickname`, `password`, `experience`, `reg_date`, `role`, `email`, `avatar_id`, `motorbike`) VALUES('34a6775c-dee6-11ed-b95c-02503e34a03e', 'root', 'root', 'pass', 0, '2023-04-19', 'admin', 'noemail@emaila.net', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wait_list`
--

CREATE TABLE `wait_list` (
  `user_uuid` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`);

--
-- Индексы таблицы `album_image`
--
ALTER TABLE `album_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `R_24` (`album_id`),
  ADD KEY `R_25` (`image_id`);

--
-- Индексы таблицы `ban_list`
--
ALTER TABLE `ban_list`
  ADD PRIMARY KEY (`user_uuid`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `R_12` (`thread_id`),
  ADD KEY `R_13` (`user_uuid`);

--
-- Индексы таблицы `comment_chosen`
--
ALTER TABLE `comment_chosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `R_16` (`user_uuid`),
  ADD KEY `R_18` (`comment_id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `R_27` (`user_uuid`);

--
-- Индексы таблицы `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `R_26` (`user_uuid`),
  ADD KEY `R_28` (`notification_type`);

--
-- Индексы таблицы `notification_type`
--
ALTER TABLE `notification_type`
  ADD PRIMARY KEY (`notification_type`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`);

--
-- Индексы таблицы `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag`);

--
-- Индексы таблицы `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `R_9` (`user_uuid`),
  ADD KEY `R_14` (`tag`);

--
-- Индексы таблицы `thread_chosen`
--
ALTER TABLE `thread_chosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `R_15` (`user_uuid`),
  ADD KEY `R_17` (`thread_id`);

--
-- Индексы таблицы `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`user_uuid`),
  ADD UNIQUE KEY `Index_6` (`token`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_uuid`),
  ADD UNIQUE KEY `Index_4` (`nickname`),
  ADD UNIQUE KEY `Index_5` (`email`),
  ADD KEY `R_6` (`role`),
  ADD KEY `R_29` (`avatar_id`);

--
-- Индексы таблицы `wait_list`
--
ALTER TABLE `wait_list`
  ADD PRIMARY KEY (`user_uuid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `album_image`
--
ALTER TABLE `album_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `comment_chosen`
--
ALTER TABLE `comment_chosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `thread`
--
ALTER TABLE `thread`
  MODIFY `thread_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `thread_chosen`
--
ALTER TABLE `thread_chosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `album_image`
--
ALTER TABLE `album_image`
  ADD CONSTRAINT `album_image_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`),
  ADD CONSTRAINT `album_image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`);

--
-- Ограничения внешнего ключа таблицы `ban_list`
--
ALTER TABLE `ban_list`
  ADD CONSTRAINT `ban_list_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`);

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`);

--
-- Ограничения внешнего ключа таблицы `comment_chosen`
--
ALTER TABLE `comment_chosen`
  ADD CONSTRAINT `comment_chosen_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`),
  ADD CONSTRAINT `comment_chosen_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`);

--
-- Ограничения внешнего ключа таблицы `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`);

--
-- Ограничения внешнего ключа таблицы `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`notification_type`) REFERENCES `notification_type` (`notification_type`);

--
-- Ограничения внешнего ключа таблицы `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`),
  ADD CONSTRAINT `thread_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tag` (`tag`);

--
-- Ограничения внешнего ключа таблицы `thread_chosen`
--
ALTER TABLE `thread_chosen`
  ADD CONSTRAINT `thread_chosen_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`),
  ADD CONSTRAINT `thread_chosen_ibfk_2` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`thread_id`);

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`role`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`avatar_id`) REFERENCES `image` (`image_id`);

--
-- Ограничения внешнего ключа таблицы `wait_list`
--
ALTER TABLE `wait_list`
  ADD CONSTRAINT `wait_list_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `user` (`user_uuid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
