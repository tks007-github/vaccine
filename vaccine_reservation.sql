-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccine_reservation`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `citizen`
--

CREATE TABLE `citizen` (
  `my_num` char(5) NOT NULL,
  `name` varchar(12) NOT NULL,
  `birth` date NOT NULL,
  `sex` char(1) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `citizen`
--

INSERT INTO `citizen` (`my_num`, `name`, `birth`, `sex`, `address`) VALUES
('M0001', '鈴木一郎', '1984-06-10', '男', '茨城県常総市'),
('M0002', '田中花子', '1987-04-29', '女', '茨城県守谷市'),
('M0003', '佐藤雪子', '1965-10-12', '女', '茨城県つくば市'),
('M0004', '赤羽茜', '1957-09-15', '女', '茨城県坂東市'),
('M0005', '板橋樹', '2002-12-31', '男', '茨城県守谷市'),
('M0006', '高橋康太', '1965-08-28', '男', '茨城県常総市'),
('M0007', '宮本奈々', '1999-02-04', '女', '茨城県守谷市'),
('M0008', '森山慎吾', '1976-04-15', '男', '茨城県つくば市'),
('M0009', '増田直哉', '1982-03-30', '男', '茨城県つくば市'),
('M0010', '富田香澄', '1950-08-21', '女', '茨城県常総市');

-- --------------------------------------------------------

--
-- テーブルの構造 `citizen_add`
--

CREATE TABLE `citizen_add` (
  `my_num` char(5) NOT NULL,
  `kana` varchar(12) NOT NULL,
  `tel` varchar(16) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `citizen_add`
--

INSERT INTO `citizen_add` (`my_num`, `kana`, `tel`, `mail`) VALUES
('M0001', 'スズキイチロウ', '090-0000-0001', 'aaa@aaa.com'),
('M0002', 'タナカハナコ', '090-0000-0002', 'bbb@bbb.com'),
('M0003', 'サトウユキコ', '090-0000-0003', 'ccc@ccc.com'),
('M0004', 'アカバネアカネ', '090-0000-0004', 'ddd@ddd.com'),
('M0005', 'イタバシイツキ', '090-0000-0005', 'eee@eee.com');

-- --------------------------------------------------------

--
-- テーブルの構造 `pre_login`
--

CREATE TABLE `pre_login` (
  `pre_login_id` varchar(16) NOT NULL,
  `pre_pass` varchar(255) NOT NULL,
  `pre_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `pre_login`
--

INSERT INTO `pre_login` (`pre_login_id`, `pre_pass`, `pre_name`) VALUES
('xxx', 'xxx', '茨城県');

-- --------------------------------------------------------

--
-- テーブルの構造 `reservation`
--

CREATE TABLE `reservation` (
  `my_num` char(5) NOT NULL,
  `site_code` char(5) NOT NULL,
  `res_date` date NOT NULL,
  `res_time` time NOT NULL,
  `count` tinyint(4) NOT NULL,
  `vac_code` char(3) NOT NULL,
  `vac_sta_code` tinyint(1) NOT NULL,
  `res_sta_code` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `reservation`
--

INSERT INTO `reservation` (`my_num`, `site_code`, `res_date`, `res_time`, `count`, `vac_code`, `vac_sta_code`, `res_sta_code`) VALUES
('M0001', 'S0001', '2021-06-02', '11:00:00', 1, 'V01', 1, 1),
('M0002', 'S0002', '2021-06-02', '11:00:00', 1, 'V01', 1, 1),
('M0003', 'S0003', '2021-06-09', '12:00:00', 1, 'V01', 1, 1),
('M0004', 'S0002', '2021-06-02', '11:00:00', 1, 'V02', 1, 1),
('M0005', 'S0001', '2021-06-28', '13:00:00', 1, 'V02', 0, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `res_status`
--

CREATE TABLE `res_status` (
  `res_sta_code` tinyint(1) NOT NULL,
  `res_sta_value` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `res_status`
--

INSERT INTO `res_status` (`res_sta_code`, `res_sta_value`) VALUES
(0, '無効'),
(1, '有効');

-- --------------------------------------------------------

--
-- テーブルの構造 `site`
--

CREATE TABLE `site` (
  `site_code` char(5) NOT NULL,
  `site_name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `site`
--

INSERT INTO `site` (`site_code`, `site_name`) VALUES
('S0001', '常総病院'),
('S0002', '守谷病院'),
('S0003', 'つくば病院');

-- --------------------------------------------------------

--
-- テーブルの構造 `site_login`
--

CREATE TABLE `site_login` (
  `site_login_id` varchar(16) NOT NULL,
  `site_pass` varchar(16) NOT NULL,
  `site_code` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `site_login`
--

INSERT INTO `site_login` (`site_login_id`, `site_pass`, `site_code`) VALUES
('aaa', 'aaa', 'S0001'),
('bbb', 'bbb', 'S0002'),
('ccc', 'ccc', 'S0003');

-- --------------------------------------------------------

--
-- テーブルの構造 `vaccine`
--

CREATE TABLE `vaccine` (
  `vac_code` char(3) NOT NULL,
  `vac_name` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `vaccine`
--

INSERT INTO `vaccine` (`vac_code`, `vac_name`) VALUES
('V01', 'ファイザー'),
('V02', 'モデルナ');

-- --------------------------------------------------------

--
-- テーブルの構造 `vac_status`
--

CREATE TABLE `vac_status` (
  `vac_sta_code` tinyint(1) NOT NULL,
  `vac_sta_value` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `vac_status`
--

INSERT INTO `vac_status` (`vac_sta_code`, `vac_sta_value`) VALUES
(0, '未'),
(1, '済');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`my_num`);

--
-- Indexes for table `citizen_add`
--
ALTER TABLE `citizen_add`
  ADD PRIMARY KEY (`my_num`);

--
-- Indexes for table `pre_login`
--
ALTER TABLE `pre_login`
  ADD PRIMARY KEY (`pre_login_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`my_num`,`count`);

--
-- Indexes for table `res_status`
--
ALTER TABLE `res_status`
  ADD PRIMARY KEY (`res_sta_code`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`site_code`);

--
-- Indexes for table `site_login`
--
ALTER TABLE `site_login`
  ADD PRIMARY KEY (`site_login_id`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`vac_code`);

--
-- Indexes for table `vac_status`
--
ALTER TABLE `vac_status`
  ADD PRIMARY KEY (`vac_sta_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
