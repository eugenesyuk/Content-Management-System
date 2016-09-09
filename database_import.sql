-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Wrz 2016, 04:51
-- Wersja serwera: 5.6.21
-- Wersja PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `cms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Java'),
(2, 'Tutorials'),
(3, 'Videos'),
(4, 'Tabs');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(27, 1, 'EugeneSK', 'eugenesyuk@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia.', 'approved', '2016-04-04 23:57:48'),
(28, 2, 'EugeneSK', 'eugenesyuk@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia.', 'approved', '2016-04-04 23:58:05'),
(31, 3, 'EugeneSK', 'eugenesyuk@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.', 'approved', '2016-04-08 18:41:49'),
(32, 3, 'EugeneSK', 'eugenesyuk@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.', 'approved', '2016-04-08 18:43:53'),
(33, 3, 'EugeneSK', 'eugenesyuk@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.', 'approved', '2016-04-08 18:43:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`, `post_views_count`) VALUES
(1, 1, 'Tiesto', 'EugeneSK', '2016-04-08 17:58:50', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(2, 2, 'Cover', 'EugeneSK', '2016-04-08 17:58:59', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(3, 3, 'Just Another One', 'Paul', '2016-04-08 17:58:33', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(19, 3, 'Just Another Two', 'Paul', '2016-04-05 03:35:49', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(20, 1, 'Van Bauren', 'EugeneSK', '2016-04-05 03:35:34', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(21, 2, 'La Isla Bonita', 'EugeneSK', '2016-04-05 03:36:10', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(22, 2, 'La Isla Bonita (Clone)', 'EugeneSK', '2016-04-05 03:36:23', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(23, 3, 'Just Another Two (Clone)', 'Paul', '2016-04-05 03:36:23', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(24, 1, 'Van Bauren (Clone)', 'EugeneSK', '2016-04-05 03:36:23', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(25, 3, 'Just Another One (Clone)', 'Paul', '2016-04-05 03:36:23', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(26, 1, 'Tiesto (Clone)', 'EugeneSK', '2016-04-05 03:36:23', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(27, 2, 'Cover (Clone)', 'EugeneSK', '2016-04-05 03:36:23', '03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.', 'PHP,classes,tutorial', 'published', 0),
(28, 2, 'La Isla Bonita (Clone) (Clone)', 'EugeneSK', '2016-04-05 03:36:27', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(29, 3, 'Just Another Two (Clone) (Clone)', 'Paul', '2016-04-05 03:36:27', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(30, 1, 'Van Bauren (Clone) (Clone)', 'EugeneSK', '2016-04-05 03:36:27', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(31, 3, 'Just Another One (Clone) (Clone)', 'Paul', '2016-04-05 03:36:27', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(32, 1, 'Tiesto (Clone) (Clone)', 'EugeneSK', '2016-04-05 03:36:27', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(33, 2, 'Cover (Clone) (Clone)', 'EugeneSK', '2016-04-05 03:36:27', '03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.', 'PHP,classes,tutorial', 'published', 0),
(34, 2, 'La Isla Bonita (Clone)', 'EugeneSK', '2016-04-05 03:36:27', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(35, 3, 'Just Another Two (Clone)', 'Paul', '2016-04-05 03:36:27', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(36, 1, 'Van Bauren (Clone)', 'EugeneSK', '2016-04-05 03:36:27', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(37, 3, 'Just Another One (Clone)', 'Paul', '2016-04-05 03:36:27', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(38, 1, 'Tiesto (Clone)', 'EugeneSK', '2016-04-05 03:36:27', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(39, 2, 'Cover (Clone)', 'EugeneSK', '2016-04-05 03:36:27', '03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.', 'PHP,classes,tutorial', 'published', 0),
(40, 2, 'La Isla Bonita', 'EugeneSK', '2016-04-05 06:17:58', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(44, 1, 'One Republic', 'EugeneSK', '2016-04-08 16:22:39', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(45, 2, 'Apologize', 'EugeneSK', '2016-04-08 16:22:49', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(47, 3, 'Just Another  Post Example', 'Paul', '2016-04-08 16:23:27', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(48, 1, 'Van Bauren', 'EugeneSK', '2016-04-08 16:23:10', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(52, 2, 'La Isla Bonita (Clone) (Clone)', 'EugeneSK', '2016-04-05 03:36:33', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(53, 3, 'Just Another Two (Clone) (Clone)', 'Paul', '2016-04-05 03:36:33', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(54, 1, 'Van Bauren (Clone) (Clone)', 'EugeneSK', '2016-04-05 03:36:33', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(55, 3, 'Just Another One (Clone) (Clone)', 'Paul', '2016-04-05 03:36:33', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(56, 1, 'Tiesto (Clone) (Clone)', 'EugeneSK', '2016-04-05 03:36:33', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(57, 2, 'Cover (Clone) (Clone)', 'EugeneSK', '2016-04-05 03:36:33', '03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.', 'PHP,classes,tutorial', 'published', 0),
(58, 2, 'La Isla Bonita (Clone)', 'EugeneSK', '2016-04-05 03:36:33', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0),
(59, 3, 'Just Another Two (Clone)', 'Paul', '2016-04-05 03:36:33', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(60, 1, 'Van Bauren (Clone)', 'EugeneSK', '2016-04-05 03:36:33', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(61, 3, 'Just Another One (Clone)', 'Paul', '2016-04-05 03:36:33', '04.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'example, tutorial, post, new', 'published', 0),
(62, 1, 'Tiesto (Clone)', 'EugeneSK', '2016-04-05 03:36:33', '02.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'Java,tutorial,classe,post', 'published', 0),
(63, 2, 'Cover', 'EugeneSK', '2016-04-08 16:22:19', '03.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, impedit, voluptatibus! Voluptatibus, tempore minima quia. Eos natus, ullam architecto est odio pariatur dolorem laborum fugiat rerum magnam ipsam animi eaque.</p>', 'PHP,classes,tutorial', 'published', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(3) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_registered` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `acces_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_registered`, `status`, `acces_token`) VALUES
(1, 'EugeneSK', '$2y$12$0fFN92m0xZNFJFzYxfHB0em40iV4An6Q/pcsmB.yxC5WZOGqSOLdS', 'Eugene', 'Syrotiuk', 'eugenesyuk@gmail.com', 'eugene.jpg', 'administrator', '2016-03-23 01:06:39', 1, ''),
(4, 'UserExample', '$2y$12$q7udQamni.fUgn4.4Qe0TOR2y2z2Gt1CyCrXCUQM8rOkSRXsBVOka', '', '', 'user@skmusique.com', 'noimage.jpg', 'subscriber', '2016-04-05 00:45:28', 1, ''),
(5, 'Username1234', '$2y$12$p993VTV22cEkAqEKNDT51uvKbjTNw2uVHAApMBlwXXd58wrgPWlHS', '', '', 'eugefffnesyuk@gmail.com', 'noimage.jpg', 'subscriber', '2016-04-08 23:00:53', 1, '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
