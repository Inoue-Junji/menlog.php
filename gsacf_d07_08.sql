-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 2 月 04 日 15:17
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_d07_08`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `likes_table`
--

CREATE TABLE `likes_table` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `shop_name_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `like_table`
--

CREATE TABLE `like_table` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `todo_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `like_table`
--

INSERT INTO `like_table` (`id`, `user_id`, `todo_id`, `created_at`) VALUES
(2, 1, 7, '2021-01-16 15:33:43'),
(3, 1, 9, '2021-01-16 15:33:44'),
(26, 1, 11, '2021-01-16 17:48:11'),
(27, 0, 3, '2021-01-28 22:08:52'),
(28, 0, 10, '2021-01-28 22:08:54'),
(32, 0, 2, '2021-01-28 23:02:36'),
(34, 1, 14, '2021-01-28 23:06:01'),
(35, 1, 12, '2021-01-30 22:15:32'),
(37, 2, 2, '2021-02-03 22:44:34'),
(38, 2, 9, '2021-02-03 22:44:38');

-- --------------------------------------------------------

--
-- テーブルの構造 `menloger_table`
--

CREATE TABLE `menloger_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `menloger_table`
--

INSERT INTO `menloger_table` (`id`, `username`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'gane26', '1234', 0, 0, '2021-02-04 20:43:58', '2021-02-04 20:43:58');

-- --------------------------------------------------------

--
-- テーブルの構造 `menlog_table`
--

CREATE TABLE `menlog_table` (
  `id` int(12) NOT NULL,
  `date` date NOT NULL,
  `jiro_flag` int(1) NOT NULL,
  `shop_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ordered` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `nearest_station` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `distance` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_zone` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `menlog_table`
--

INSERT INTO `menlog_table` (`id`, `date`, `jiro_flag`, `shop_name`, `ordered`, `area`, `nearest_station`, `distance`, `time_zone`, `image`) VALUES
(1, '2020-12-29', 1, '桜台', '小ラーメン ニンニクヤサイ', '関東', '桜台', '徒歩2分 ', '13:30', 'upload/20210204145645eb2b4d30f14c5e809a3af818ec6fd5d8.jpeg'),
(2, '2020-12-29', 1, '桜台', '小ラーメン ニンニクヤサイ', '関東', '桜台', '徒歩2分 ', '13:30', 'upload/202102041457117e4f2293b72f2cef10442fec942bcb62.jpeg'),
(3, '2021-02-04', 1, '桜台', '小ラーメン ニンニクヤサイ', '関東', '桜台', '徒歩2分 ', '22:59', 'upload/202102041459217900f9215bc61a46e678266f954133bc.jpg');

-- --------------------------------------------------------

--
-- テーブルの構造 `result_table`
--

CREATE TABLE `result_table` (
  `id` int(12) NOT NULL,
  `date` date NOT NULL,
  `result` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `score` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `starter` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `memo` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `result_table`
--

INSERT INTO `result_table` (`id`, `date`, `result`, `score`, `starter`, `memo`) VALUES
(2, '2020-12-25', '引き分け', '0-0', '則本', 'チャンスで１本出ず'),
(4, '2020-12-25', '勝ち', '4-0', '千賀', '１安打完封'),
(5, '2020-12-25', '勝ち', '2-1', '山岡', 'ピンチ招くも切り抜ける'),
(6, '2020-12-26', '勝ち', '5-3', '山本', '松田のサヨナラ２ランで勝利'),
(7, '2021-01-05', '勝ち', '2-1', '金田', '１安打完投'),
(8, '2020-12-27', '負け', '0-4', '前田', '初回２エラー'),
(9, '2021-02-03', '負け', '0-1', '菅野', '岡本に縦スラやられる');

-- --------------------------------------------------------

--
-- テーブルの構造 `todo_table`
--

CREATE TABLE `todo_table` (
  `id` int(12) NOT NULL,
  `todo` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `todo_table`
--

INSERT INTO `todo_table` (`id`, `todo`, `deadline`, `image`, `created_at`, `updated_at`) VALUES
(2, 'マリーンズ', '2020-12-21', NULL, '2020-12-19 16:06:04', '2020-12-19 16:06:04'),
(3, 'ライオンズ', '2020-12-22', NULL, '2020-12-19 16:06:51', '2020-12-19 16:06:51'),
(4, 'イーグルス', '2020-12-23', NULL, '2020-12-19 16:07:18', '2020-12-19 16:07:18'),
(5, 'ファイターズ', '2020-12-24', NULL, '2020-12-19 16:08:24', '2020-12-19 16:08:24'),
(6, 'ジャイアンツ', '2020-12-25', NULL, '2020-12-19 16:09:28', '2020-12-19 16:09:28'),
(7, 'タイガース', '2020-12-26', NULL, '2020-12-19 16:10:08', '2020-12-19 16:10:08'),
(8, 'ドラゴンズ', '2020-12-27', NULL, '2020-12-19 16:11:04', '2020-12-19 16:11:04'),
(9, 'カープ', '2020-12-28', NULL, '2020-12-19 16:12:05', '2020-12-19 16:12:05'),
(10, 'スワローズ', '2020-12-29', NULL, '2020-12-19 16:12:47', '2020-12-19 16:12:47'),
(11, 'ベイスターズ', '2020-12-30', NULL, '2020-12-19 16:13:34', '2020-12-19 16:13:34'),
(12, 'abcd', '2020-12-18', NULL, '2020-12-19 16:52:16', '2020-12-19 16:52:16'),
(13, 'abcd', '2020-12-18', NULL, '2020-12-19 16:52:22', '2020-12-19 16:52:22'),
(14, 'arararar', '2020-12-08', NULL, '2020-12-19 17:24:14', '2020-12-19 17:24:14'),
(16, 'あららら', '2021-01-08', NULL, '2021-01-09 17:48:51', '2021-01-09 17:48:51'),
(17, 'あめ', '2021-01-30', 'upload/20210130092519cc50d9dc48fcc6c790657f169430c0eb.jpeg', '2021-01-30 17:27:55', '2021-01-30 17:27:55'),
(25, 'つつけもの', '2021-02-02', 'upload/20210202074223274ad07a5ab1f8372dc82e7d184183c7.jpeg', '2021-02-02 15:42:23', '2021-02-02 15:42:23');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'aiueo', 'kakikukeko', 0, 0, '2021-01-09 15:44:55', '2021-01-09 15:44:55'),
(2, 'harehare', 'ameame', 0, 0, '2021-01-14 22:04:32', '2021-01-14 22:04:32');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `likes_table`
--
ALTER TABLE `likes_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `like_table`
--
ALTER TABLE `like_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `menloger_table`
--
ALTER TABLE `menloger_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `menlog_table`
--
ALTER TABLE `menlog_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `result_table`
--
ALTER TABLE `result_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `todo_table`
--
ALTER TABLE `todo_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `likes_table`
--
ALTER TABLE `likes_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `like_table`
--
ALTER TABLE `like_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- テーブルの AUTO_INCREMENT `menloger_table`
--
ALTER TABLE `menloger_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `menlog_table`
--
ALTER TABLE `menlog_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `result_table`
--
ALTER TABLE `result_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `todo_table`
--
ALTER TABLE `todo_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
