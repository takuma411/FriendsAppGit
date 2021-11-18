-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 11 月 18 日 05:11
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `friends`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `GiftShop`
--

CREATE TABLE `GiftShop` (
  `gift_shop_id` int(20) NOT NULL,
  `item1` int(250) NOT NULL DEFAULT '100',
  `item2` int(250) NOT NULL DEFAULT '100',
  `item3` int(250) NOT NULL DEFAULT '100',
  `item4` int(250) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `GiftShop`
--

INSERT INTO `GiftShop` (`gift_shop_id`, `item1`, `item2`, `item3`, `item4`) VALUES
(1, 91, 99, 99, 98);

-- --------------------------------------------------------

--
-- テーブルの構造 `PrivateChatRoom`
--

CREATE TABLE `PrivateChatRoom` (
  `chat_message_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) DEFAULT NULL,
  `msg_img` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `PrivateChatRoom`
--

INSERT INTO `PrivateChatRoom` (`chat_message_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `msg_img`) VALUES
(437, 1171815130, 874266758, NULL, '1636964652cairn-g1dcc4ef40_640.jpg'),
(438, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(439, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(440, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(441, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(442, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(443, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(444, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(445, 1171815130, 874266758, 'こんにちは', NULL),
(446, 1171815130, 874266758, 'こんにちは', NULL),
(447, 1171815130, 874266758, 'こんにちは', NULL),
(448, 1171815130, 874266758, 'こんにちは', NULL),
(449, 1171815130, 874266758, 'こんにちは', NULL),
(450, 1171815130, 874266758, 'こんにちは', NULL),
(451, 1171815130, 874266758, 'こんにちは', NULL),
(452, 1171815130, 874266758, 'こんにちは', NULL),
(453, 1171815130, 874266758, 'こんにちは', NULL),
(454, 1171815130, 874266758, 'こんにちは', NULL),
(455, 1171815130, 874266758, 'こんにちは', NULL),
(456, 1171815130, 874266758, 'こんにちは', NULL),
(457, 1171815130, 874266758, 'こんにちは', NULL),
(458, 1171815130, 874266758, 'こんにちは', NULL),
(467, 874266758, 1593747794, NULL, '1637030528cairn-g1dcc4ef40_640.jpg'),
(468, 874266758, 1593747794, NULL, '1637030532hamburg-g722c41837_640.jpg'),
(469, 1593747794, 874266758, 'FriendsGiftを送りました！', NULL),
(470, 1593747794, 874266758, NULL, '1637030994mountains-gee87e118b_640.jpg'),
(471, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(472, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(473, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(474, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(475, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(476, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(477, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(478, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(479, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(480, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(481, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(482, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(483, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(484, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(485, 874266758, 1593747794, 'FriendsGiftを送りました！', NULL),
(486, 1593747794, 874266758, 'FriendsGiftを送りました！', NULL),
(487, 1593747794, 874266758, 'FriendsGiftを送りました！', NULL),
(488, 1171815130, 874266758, 'k', NULL),
(489, 1171815130, 874266758, 'k', NULL),
(490, 1171815130, 874266758, 'k', NULL),
(491, 1171815130, 874266758, 'k', NULL),
(492, 1171815130, 874266758, 'k', NULL),
(493, 1171815130, 874266758, 'k', NULL),
(494, 1171815130, 874266758, 'k', NULL),
(495, 1171815130, 874266758, 'k', NULL),
(496, 1171815130, 874266758, 'k', NULL),
(497, 1171815130, 874266758, 'k', NULL),
(498, 1171815130, 874266758, 'k', NULL),
(499, 1171815130, 874266758, 'k', NULL),
(500, 1171815130, 874266758, 'k', NULL),
(501, 1171815130, 874266758, 'k', NULL),
(502, 1171815130, 874266758, 'k', NULL),
(503, 1171815130, 874266758, 'k', NULL),
(504, 1171815130, 874266758, 'k', NULL),
(505, 1171815130, 874266758, 'k', NULL),
(506, 1171815130, 874266758, 'k', NULL),
(507, 1171815130, 874266758, 'k', NULL),
(508, 1171815130, 874266758, 'k', NULL),
(509, 1171815130, 874266758, 'k', NULL),
(510, 1171815130, 874266758, 'k', NULL),
(511, 1171815130, 874266758, 'k', NULL),
(512, 1171815130, 874266758, 'k', NULL),
(513, 1171815130, 874266758, 'k', NULL),
(528, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(531, 1171815130, 874266758, 'k', NULL),
(532, 1171815130, 874266758, NULL, '1637035487cairn-g1dcc4ef40_640.jpg'),
(533, 1171815130, 874266758, 'こんにちは', NULL),
(534, 1171815130, 874266758, 'こんにちは', NULL),
(535, 1171815130, 874266758, 'FriendsGiftを送りました！', NULL),
(536, 1171815130, 874266758, 'こんにちは', NULL),
(537, 1171815130, 874266758, 'a', NULL),
(577, 354850384, 738167988, 'こんにちは', NULL),
(578, 354850384, 738167988, 'FriendsGiftを送りました！', NULL),
(579, 354850384, 738167988, NULL, '1637038822cairn-g1dcc4ef40_640.jpg'),
(580, 874266758, 738167988, 'FriendsGiftを送りました！', NULL),
(581, 874266758, 738167988, 'FriendsGiftを送りました！', NULL),
(582, 738167988, 874266758, 'FriendsGiftを送りました！', NULL),
(583, 738167988, 874266758, 'FriendsGiftを送りました！', NULL),
(584, 738167988, 874266758, '2P', NULL),
(585, 874266758, 881435769, NULL, '1637040203hamburg-g722c41837_640.jpg'),
(586, 874266758, 881435769, 'こんにちは', NULL),
(587, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(588, 881435769, 874266758, 'FriendsGiftを送りました！', NULL),
(589, 881435769, 874266758, 'FriendsGiftを送りました！', NULL),
(590, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(591, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(592, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(593, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(594, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(595, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(596, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(597, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(598, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(599, 874266758, 881435769, 'FriendsGiftを送りました！', NULL),
(600, 602191340, 874266758, 'か', NULL),
(601, 602191340, 874266758, 'か', NULL),
(602, 602191340, 874266758, 'か', NULL),
(603, 602191340, 874266758, 'か', NULL),
(604, 602191340, 874266758, 'kaiakai', NULL),
(605, 602191340, 874266758, 'ka', NULL),
(606, 602191340, 874266758, NULL, '1637049284hamburg-g722c41837_640.jpg'),
(607, 602191340, 874266758, 'FriendsGiftを送りました！', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_unique_id` int(255) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_name_kana` varchar(250) NOT NULL,
  `user_area` varchar(11) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '0会員：１管理者',
  `gift` int(250) DEFAULT '500',
  `gift_point` int(255) DEFAULT '0',
  `own_item1` int(255) DEFAULT '0',
  `own_item2` int(255) DEFAULT '0',
  `own_item3` int(255) DEFAULT '0',
  `own_item4` int(255) DEFAULT '0',
  `user_created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`user_id`, `user_unique_id`, `user_name`, `user_name_kana`, `user_area`, `user_email`, `user_password`, `role`, `gift`, `gift_point`, `own_item1`, `own_item2`, `own_item3`, `own_item4`, `user_created_on`) VALUES
(59, 710083556, '管理者A', 'カンリシャエー', '東京', 'kanri@gmail.com', '$2y$10$UaskHG3IQsMdZOSpo1VEE.DbrLYZs32i1iebe8rrv4cN2urJnrf5C', 1, 500, 0, 0, 0, 0, 0, '2021-11-02 04:18:32'),
(73, 874266758, '山口拓馬', 'ヤマグチタクマ', '東京', 'atc_chris411@yahoo.co.jp', '$2y$10$HISSkF5hvRIxmzMtoG/H0eBt/L8BrAJCYlLQWgHtF5LSzv1ciDWh.', 0, 389, 900, 6, 1, 1, 2, '2021-11-10 11:38:23'),
(74, 1171815130, 'ユーザーA', 'ユーザーエー', '名古屋', 'user_a@gmail.com', '$2y$10$T5iMibiXfPNkEWRkAfDnSeXl7eNl9LRfL67xH1gzBtAByNDz4duO2', 0, 266, 150, 0, 0, 0, 0, '2021-11-10 11:41:37'),
(75, 1593747794, 'ユーザーB', 'ユーザービー', '仙台', 'user_b@gmail.com', '$2y$10$Oly38srffFduCc76uQbu4ONEcPXqwN4CdeJiZUyN.LB1/QDsgUhV2', 0, 477, 4, 0, 0, 0, 0, '2021-11-10 11:42:07'),
(76, 602191340, 'ユーザーC', 'ユーザーシー', '北海道', 'user_c@gmail.com', '$2y$10$v4vmxCN5QgPlDsfcE2M6oOP.9UeV.y0MRVR6ntlohVDEVl8Nv/xcG', 0, 500, 2, 0, 0, 0, 0, '2021-11-12 13:56:24'),
(77, 1416289754, 'ユーザーD', 'ユーザーディー', '仙台', 'user_d@gmail.com', '$2y$10$mj4ChEIxtQwd.DXd8FAj4OAAXoGHq.x0ur8nhGr89UWtnPM7n/sMG', 0, 500, 0, 0, 0, 0, 0, '2021-11-12 13:56:54'),
(86, 1336490124, 'ユーザーE', 'ユーザーE', '仙台', 'user_e@gmail.com', '$2y$10$JUvPPdBqRVKLMcFO1/tMtuQ5VHk8N6vN.ppOTn2Cz3YBBOH/f7yQ2', 0, 500, 0, 0, 0, 0, 0, '2021-11-18 14:09:07'),
(87, 1576955278, 'ユーザーF', 'ユーザーF', '大阪', 'user_f@gmail.com', '$2y$10$icjYeCHQBdOBMEHd1iBYCOC96rIK/2Xf70ki2HzicjjvcO8A12UrG', 0, 500, 0, 0, 0, 0, 0, '2021-11-18 14:09:27'),
(88, 969135406, 'ユーザーG', 'ユーザーG', '名古屋', 'user_g@gmail.com', '$2y$10$hlbG1IriYgch4H27LuYo8uYpBQZQmONtIyS43hfZgpaZSBtcpbU.q', 0, 500, 0, 0, 0, 0, 0, '2021-11-18 14:09:46'),
(89, 107948500, 'ユーザーH', 'ユーザーH', '北海道', 'user_h@gmail.com', '$2y$10$JEMDnthzt1L9IKg.8L1f0OTj5H.PU8HmKaaIcGC.czH09Ey5Ozjkq', 0, 500, 0, 0, 0, 0, 0, '2021-11-18 14:10:06'),
(90, 148981850, 'ユーザーI', 'ユーザーI', '東京', 'user_i@gmail.com', '$2y$10$VSqlSbBNLGlcI0hhXLGIh.Kk.18cj4jmugADd0J2bP2.xKzv/j8Ya', 0, 500, 0, 0, 0, 0, 0, '2021-11-18 14:10:27'),
(91, 1156578483, 'ユーザーJ', 'ユーザーJ', '福岡', 'user_j@gmail.com', '$2y$10$uYZbBoW/wCVi7cHa5g5Nz.m/ebuFIpftwgOgKiPK8BcxMiLyDquAq', 0, 500, 0, 0, 0, 0, 0, '2021-11-18 14:10:45');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_info`
--

CREATE TABLE `user_info` (
  `user_unique_id` int(250) NOT NULL,
  `user_info_name` varchar(50) DEFAULT NULL,
  `user_info_age` varchar(250) DEFAULT NULL,
  `user_info_hobies` text,
  `user_info_from` varchar(250) DEFAULT NULL,
  `user_info_dept` varchar(250) DEFAULT NULL,
  `user_info_free` text,
  `user_img` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user_info`
--

INSERT INTO `user_info` (`user_unique_id`, `user_info_name`, `user_info_age`, `user_info_hobies`, `user_info_from`, `user_info_dept`, `user_info_free`, `user_img`) VALUES
(107948500, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148981850, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(354850384, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(465462390, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(587396688, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(602191340, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(738167988, 'テスト', '24', '', '', '', '', '1637038846hamburg-g722c41837_640.jpg'),
(834889343, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(874266758, 'たくま', '24', 'ドライブ、旅行', '東京', 'SES', '初めまして！\r\n山口拓馬です！\r\nよろしくお願いします。', '1636964878hamburg-g722c41837_640.jpg'),
(881435769, 'test', '22', '', '東京', '', '', '1637040188cairn-g1dcc4ef40_640.jpg'),
(969135406, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1156578483, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1171815130, 'A', '33', '釣り、読書', '静岡', '営業', 'はじめまして！\r\nよろしくお願いします！', '1636552652hedgehog-g9311d0cd2_640.jpg'),
(1197579655, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1336490124, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1416289754, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1576955278, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1593747794, 'B', '26', '', '青森', '経理', 'よろしく', '1637032208hamburg-g722c41837_640.jpg');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `GiftShop`
--
ALTER TABLE `GiftShop`
  ADD PRIMARY KEY (`gift_shop_id`);

--
-- テーブルのインデックス `PrivateChatRoom`
--
ALTER TABLE `PrivateChatRoom`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_unique_id` (`user_unique_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- テーブルのインデックス `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_unique_id`),
  ADD UNIQUE KEY `user_unique_id` (`user_unique_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `GiftShop`
--
ALTER TABLE `GiftShop`
  MODIFY `gift_shop_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `PrivateChatRoom`
--
ALTER TABLE `PrivateChatRoom`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=608;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
