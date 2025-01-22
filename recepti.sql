-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 17. dec 2024 ob 17.40
-- Različica strežnika: 10.4.27-MariaDB
-- Različica PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `recepti`
--

-- --------------------------------------------------------

--
-- Struktura tabele `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `post_number` varchar(10) DEFAULT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `number_of_people` int(11) DEFAULT NULL,
  `proceedings` text NOT NULL,
  `ingredients` text NOT NULL,
  `avg_score` float DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `city_id` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship5` (`user_id`),
  ADD KEY `IX_Relationship6` (`recipe_id`);

--
-- Indeksi tabele `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship3` (`recipe_id`);

--
-- Indeksi tabele `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Relationship2` (`user_id`),
  ADD KEY `IX_Relationship4` (`category_id`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `IX_Relationship1` (`city_id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Relationship5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `Relationship6` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Omejitve za tabelo `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `Relationship3` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Omejitve za tabelo `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `Relationship2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `Relationship4` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Omejitve za tabelo `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Relationship1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
