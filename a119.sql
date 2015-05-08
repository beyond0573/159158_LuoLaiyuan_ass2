-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 09 日 07:03
-- 服务器版本: 5.1.37
-- PHP 版本: 5.3.0

	SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


	/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
	/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
	/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
	/*!40101 SET NAMES utf8 */;

--
-- 数据库: `a119`
--

-- --------------------------------------------------------

--
-- 表的结构 `tb_comment`
--

	CREATE TABLE IF NOT EXISTS tb_comment (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`username` varchar(20) NOT NULL,
		`admi` int(2) NOT NULL,
		`picName` varchar(20) NOT NULL,
		`comment` text NOT NULL,
		`time` varchar(20) NOT NUll
	)ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `tb_comment`
--

	INSERT INTO `tb_comment` (`id`,  `username`, `admi`, `picName`,`comment`,`time`) VALUES
	(1, 'admin', 1, '002.jpg', 'It is a good picture.',  '12:23:11 May 17 2013'), 
	(2, 'qq', 0, '002.jpg', 'It a beautiful girl.', '12:25:40 May 17 2013'), 
	(3, 'qq', 0, '001.jpg', 'There are so many fishes.', '12:25:40 May 18 2013');

-- --------------------------------------------------------

--
-- 表的结构 `tb_picture`
--

	CREATE TABLE IF NOT EXISTS tb_picture (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`name` varchar(20) NOT NULL,
		`author` varchar(20) NOT NULL,
		`admi` int(2) NOT NULL,
		`picture` text NOT NULL,
		`time` varchar(20) NOT NUll,
		`picdiscrip` text NOT NUll
	)ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `tb_picture`
--

	INSERT INTO `tb_picture` (`id`, `name`, `author`, `admi`, `picture`, `time`, `picdiscrip` ) VALUES
	(1, '001.jpg', 'admin', 1, './submissions/001.jpg', '14:24:17 May 17 2013', 'It a blue world.'),
	(2, '002.jpg', 'Jim', 1, './submissions/002.jpg', '19:13:49 May 17 2013', 'what the girl is thinking!' ),
	(3, '003.jpg', 'Bob', 0, './submissions/003.jpg', '9:15:32 May 20 2013', 'How happy they are!');
 

 

-- --------------------------------------------------------

--
-- 表的结构 `tb_users`
--

	CREATE TABLE IF NOT EXISTS tb_users (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`name` varchar(20) NOT NULL,
		`passward` varchar(20) NOT NULL,
		`admi` int(2) NOT NULL,
		`email` varchar(40) NOT NULL,
		`sex` varchar(20), NOT NUll,
		`country` varchar(20) NOT NULL,
		`intrest` text,
		`time` varchar(20) NOT NUll
	)ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `tb_users`
--

	INSERT INTO `tb_users` (`id`, `name`, `passward`, `admi`, `email`, `sex`, `country`, `intrest`, `time`) VALUES
	(1, 'admin', '343b1c4a3ea721b2d640fc8700db0f36', 1, 'qq@qq.com', 'Male', 'China',  \'a:4:{s:5:"sport";s:5:"sport";s:7:"reading";s:7:"reading";s:8:"playgame";s:0:"";s:5:"other";s:0:"";}', '14:11:12 May 17 2013'), 
	(2, 'Tom', '343b1c4a3ea721b2d640fc8700db0f36', 0, 'qq@qq.com', 'Male', 'China',  \'a:4:{s:5:"sport";s:5:"sport";s:7:"reading";s:7:"reading";s:8:"playgame";s:0:"";s:5:"other";s:0:"";}', '20:04:23 May 17 2013'), 
	(3, 'Bob', '343b1c4a3ea721b2d640fc8700db0f36', 0, 'ww@qq.com', 'Male', 'China',  \'a:4:{s:5:"sport";s:5:"sport";s:7:"reading";s:0:"";s:8:"playgame";s:0:"";s:5:"other";s:0:"";}', '20:42:24 May 17 2013'), 
	(4, 'Jim', '343b1c4a3ea721b2d640fc8700db0f36', 0, 'ww@qq.com', 'Male', 'China',  \'a:4:{s:5:"sport";s:5:"sport";s:7:"reading";s:0:"";s:8:"playgame";s:0:"";s:5:"other";s:0:"";}', '11:59:38 May 20 2013'); 


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
