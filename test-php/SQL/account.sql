-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-28 15:36:27
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `account`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account_info`
--

CREATE TABLE `account_info` (
  `aId` int(250) NOT NULL,
  `aAccount` varchar(16) NOT NULL,
  `aName` varchar(6) NOT NULL,
  `aSex` varchar(8) NOT NULL,
  `aBirthday` date NOT NULL,
  `aMail` varchar(250) NOT NULL,
  `aNote` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `account_info`
--

INSERT INTO `account_info` (`aId`, `aAccount`, `aName`, `aSex`, `aBirthday`, `aMail`, `aNote`) VALUES
(1, 'winnie83831', '吳嘉雯', '0', '1994-08-31', 'winnie83831@gmail.com', ''),
(2, 'test123', '王曉明', '0', '1977-02-05', 'test123@gmail.com', '無'),
(4, 'abc123', '張曉華', '1', '1985-06-04', 'abc123@gmail.com', ''),
(6, 'qwe789', '吳美美', '1', '1994-08-31', 'qwe789@gmail', ''),
(8, 'gdd546', '黃小小', '1', '1985-02-06', 'gdd546@gmail.com', ''),
(9, 'gh789', '陳小紅', '0', '1985-05-06', 'gh789@gmail.com', ''),
(10, 'bnm741', '陳大大', '1', '2022-06-28', 'bnm741@gmail', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`aId`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account_info`
--
ALTER TABLE `account_info`
  MODIFY `aId` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
