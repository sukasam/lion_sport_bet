
CREATE TABLE `affiliate` (
  `id` int(11) NOT NULL,
  `player` varchar(20) NOT NULL,
  `affiliate` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `action` varchar(50) NOT NULL,
  `commission` varchar(1) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `bank_info` (
  `id` int(11) NOT NULL,
  `player` varchar(20) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `bank_card` varchar(16) NOT NULL,
  `bank_sheba` varchar(26) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `action` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `player`, `bank_name`, `fullname`, `bank_card`, `bank_sheba`, `date`, `time`, `action`) VALUES
(1, 'adminT-T', 'TESST BANK', 'TEST ACCOUNT NAME', '1231564156415644', '215561561511655156515611', '2019-07-16', '15:50:34', 'Enable'),
(2, 'fa_fa', 'ss', 'ham ham', '1232432432452434', '123424243566347654356676', '2019-12-25', '21:05:16', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `bet_lotorry_history`
--

CREATE TABLE `bet_lotorry_history` (
  `id` int(11) NOT NULL,
  `bet_lotorry_jackpot` varchar(20) DEFAULT NULL,
  `bet_lotorry_date` date DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `time_create` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bet_lotorry_history`
--

INSERT INTO `bet_lotorry_history` (`id`, `bet_lotorry_jackpot`, `bet_lotorry_date`, `date_create`, `time_create`) VALUES
(5, '50 M', '2019-08-02', '2019-07-18', '02:57:15'),
(6, '50 M', '2020-01-09', '2020-01-09', '14:58:08'),
(7, '50 M', '2020-01-16', '2020-01-09', '20:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `bet_lotorry_play`
--

CREATE TABLE `bet_lotorry_play` (
  `id` int(11) NOT NULL,
  `player` varchar(100) NOT NULL,
  `jackpot` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL,
  `around` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bet_lotorry_play`
--

INSERT INTO `bet_lotorry_play` (`id`, `player`, `jackpot`, `date`, `time`, `status`, `around`) VALUES
(1, 'adminT-T', '50 M', '2019-07-18', '04:11:59', 1, '2019-08-02'),
(2, 'adminT-T', '50 M', '2019-07-18', '04:19:10', 1, '2019-08-02'),
(3, 'adminT-T', '50 M', '2019-07-19', '18:59:26', 1, '2019-08-02'),
(4, 'adminT-T', '50 M', '2020-01-09', '20:56:19', 1, '2020-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `bet_lotorry_play_results`
--

CREATE TABLE `bet_lotorry_play_results` (
  `row` int(11) NOT NULL,
  `id` varchar(20) DEFAULT NULL,
  `home` varchar(200) DEFAULT NULL,
  `results` varchar(10) DEFAULT NULL,
  `away` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bet_lotorry_play_results`
--

INSERT INTO `bet_lotorry_play_results` (`row`, `id`, `home`, `results`, `away`) VALUES
(1, '1', 'AIK', '1', 'AIK'),
(2, '1', 'QarabaÄŸ', '2', 'QarabaÄŸ'),
(3, '1', 'Rosenborg', '3', 'Rosenborg'),
(4, '1', 'Ludogorets', '2', 'Ludogorets'),
(5, '1', 'CFR Cluj', '1', 'CFR Cluj'),
(6, '1', 'Piast Gliwice', '2', 'Piast Gliwice'),
(7, '1', 'Maribor', '3', 'Maribor'),
(8, '1', 'Sutjeska', '2', 'Sutjeska'),
(9, '1', 'Celtic', '1', 'Celtic'),
(10, '1', 'Tunisia', '2', 'Tunisia'),
(11, '1', 'Amorebieta', '3', 'Amorebieta'),
(12, '1', 'Beerschot-Wilrijk', '2', 'Beerschot-Wilrijk'),
(13, '1', 'Bochum', '1', 'Bochum'),
(14, '1', 'First Vienna', '2', 'First Vienna'),
(15, '1', 'Kolding IF', '3', 'Kolding IF'),
(16, '2', 'AIK', '1', 'AIK'),
(17, '2', 'QarabaÄŸ', '1', 'QarabaÄŸ'),
(18, '2', 'Rosenborg', '2', 'Rosenborg'),
(19, '2', 'Ludogorets', '2', 'Ludogorets'),
(20, '2', 'CFR Cluj', '3', 'CFR Cluj'),
(21, '2', 'Piast Gliwice', '3', 'Piast Gliwice'),
(22, '2', 'Maribor', '1', 'Maribor'),
(23, '2', 'Sutjeska', '1', 'Sutjeska'),
(24, '2', 'Celtic', '2', 'Celtic'),
(25, '2', 'Tunisia', '2', 'Tunisia'),
(26, '2', 'Amorebieta', '3', 'Amorebieta'),
(27, '2', 'Beerschot-Wilrijk', '3', 'Beerschot-Wilrijk'),
(28, '2', 'Bochum', '2', 'Bochum'),
(29, '2', 'First Vienna', '1', 'First Vienna'),
(30, '2', 'Kolding IF', '1', 'Kolding IF'),
(31, '3', 'AIK', '1', 'AIK'),
(32, '3', 'QarabaÄŸ', '3', 'QarabaÄŸ'),
(33, '3', 'Rosenborg', '2', 'Rosenborg'),
(34, '3', 'Ludogorets', '1', 'Ludogorets'),
(35, '3', 'CFR Cluj', '3', 'CFR Cluj'),
(36, '3', 'Piast Gliwice', '1', 'Piast Gliwice'),
(37, '3', 'Maribor', '3', 'Maribor'),
(38, '3', 'Sutjeska', '1', 'Sutjeska'),
(39, '3', 'Celtic', '2', 'Celtic'),
(40, '3', 'Tunisia', '3', 'Tunisia'),
(41, '3', 'Amorebieta', '2', 'Amorebieta'),
(42, '3', 'Beerschot-Wilrijk', '2', 'Beerschot-Wilrijk'),
(43, '3', 'Bochum', '1', 'Bochum'),
(44, '3', 'First Vienna', '2', 'First Vienna'),
(45, '3', 'dd', '3', 'dd'),
(46, '4', 'tt', '1', 'tt'),
(47, '4', 'gg', '2', 'gg'),
(48, '4', 'vb', '1', 'vb'),
(49, '4', 'nv', '2', 'nv'),
(50, '4', 'vv', '1', 'vv'),
(51, '4', 'hljhlj', '2', 'hljhlj'),
(52, '4', 'jhlhl', '1', 'jhlhl'),
(53, '4', 'hkhk', '2', 'hkhk'),
(54, '4', 'khklhlk', '1', 'khklhlk'),
(55, '4', 'khk', '2', 'khk'),
(56, '4', 'khkhklh', '1', 'khkhklh'),
(57, '4', 'khklhkl', '2', 'khklhkl'),
(58, '4', 'khkhkl', '1', 'khkhkl'),
(59, '4', 'khlkh', '2', 'khlkh'),
(60, '4', 'hkhlkhlkl', '1', 'hkhlkhlkl');

-- --------------------------------------------------------

--
-- Table structure for table `bet_lotorry_prize`
--

CREATE TABLE `bet_lotorry_prize` (
  `id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `around` date NOT NULL,
  `matches` varchar(100) NOT NULL,
  `all_winners` int(50) NOT NULL,
  `prize_per` varchar(50) DEFAULT NULL,
  `cash_prize` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bet_lotorry_prize`
--

INSERT INTO `bet_lotorry_prize` (`id`, `history_id`, `around`, `matches`, `all_winners`, `prize_per`, `cash_prize`) VALUES
(69, 5, '2019-08-02', 'Match 15', 0, '50000000', 0),
(70, 5, '2019-08-02', 'Match 14', 0, '40000000', 0),
(71, 5, '2019-08-02', 'Match 5', 0, '30000000', 0),
(72, 5, '2019-08-02', 'Match 13', 0, '20000000', 0),
(73, 5, '2019-08-02', 'Match 12', 0, '10000000', 0),
(74, 5, '2019-08-02', 'Match 11', 0, '5000000', 0),
(75, 5, '2019-08-02', 'Match 10', 0, '4000000', 0),
(76, 5, '2019-08-02', 'Match 9', 0, '3000000', 0),
(77, 5, '2019-08-02', 'Match 8', 0, '2000000', 0),
(78, 5, '2019-08-02', 'Match 7', 0, '1000000', 0),
(79, 5, '2019-08-02', 'Match 6', 0, '100000', 0),
(80, 5, '2019-08-02', 'Match 5', 0, '50000', 0),
(81, 5, '2019-08-02', 'Match 4', 0, '10000', 0),
(82, 5, '2019-08-02', 'Match 3', 0, '5000', 0),
(83, 5, '2019-08-02', 'Match 2', 0, '1000', 0),
(84, 5, '2019-08-02', 'Match 1', 0, '', 0),
(85, 5, '2019-08-02', 'Totals', 0, '', 0),
(86, 6, '2020-01-09', 'Match 15', 0, '50000000', 0),
(87, 6, '2020-01-09', 'Match 14', 0, '40000000', 0),
(88, 6, '2020-01-09', 'Match 5', 0, '30000000', 0),
(89, 6, '2020-01-09', 'Match 13', 0, '20000000', 0),
(90, 6, '2020-01-09', 'Match 12', 0, '10000000', 0),
(91, 6, '2020-01-09', 'Match 11', 0, '5000000', 0),
(92, 6, '2020-01-09', 'Match 10', 0, '4000000', 0),
(93, 6, '2020-01-09', 'Match 9', 0, '3000000', 0),
(94, 6, '2020-01-09', 'Match 8', 0, '2000000', 0),
(95, 6, '2020-01-09', 'Match 7', 0, '1000000', 0),
(96, 6, '2020-01-09', 'Match 6', 0, '100000', 0),
(97, 6, '2020-01-09', 'Match 5', 0, '50000', 0),
(98, 6, '2020-01-09', 'Match 4', 0, '10000', 0),
(99, 6, '2020-01-09', 'Match 3', 0, '5000', 0),
(100, 6, '2020-01-09', 'Match 2', 0, '1000', 0),
(101, 6, '2020-01-09', 'Match 1', 0, '', 0),
(102, 6, '2020-01-09', 'Totals', 0, '', 0),
(103, 7, '2020-01-16', 'Match 15', 1, '50000000', 50000000),
(104, 7, '2020-01-16', 'Match 14', 0, '40000000', 0),
(105, 7, '2020-01-16', 'Match 5', 0, '30000000', 0),
(106, 7, '2020-01-16', 'Match 13', 0, '20000000', 0),
(107, 7, '2020-01-16', 'Match 12', 0, '10000000', 0),
(108, 7, '2020-01-16', 'Match 11', 0, '5000000', 0),
(109, 7, '2020-01-16', 'Match 10', 0, '4000000', 0),
(110, 7, '2020-01-16', 'Match 9', 0, '3000000', 0),
(111, 7, '2020-01-16', 'Match 8', 0, '2000000', 0),
(112, 7, '2020-01-16', 'Match 7', 0, '1000000', 0),
(113, 7, '2020-01-16', 'Match 6', 0, '100000', 0),
(114, 7, '2020-01-16', 'Match 5', 0, '50000', 0),
(115, 7, '2020-01-16', 'Match 4', 0, '10000', 0),
(116, 7, '2020-01-16', 'Match 3', 0, '5000', 0),
(117, 7, '2020-01-16', 'Match 2', 0, '1000', 0),
(118, 7, '2020-01-16', 'Match 1', 0, '', 0),
(119, 7, '2020-01-16', 'Totals', 1, '', 50000000);

-- --------------------------------------------------------

--
-- Table structure for table `bet_lotorry_results`
--

CREATE TABLE `bet_lotorry_results` (
  `row` int(11) NOT NULL,
  `id` varchar(20) DEFAULT NULL,
  `home` varchar(200) DEFAULT NULL,
  `results` varchar(10) DEFAULT NULL,
  `away` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bet_lotorry_results`
--

INSERT INTO `bet_lotorry_results` (`row`, `id`, `home`, `results`, `away`) VALUES
(571, '5', 'AIK', '', 'AIK'),
(572, '5', 'QarabaÄŸ', '', 'QarabaÄŸ'),
(573, '5', 'Rosenborg', '', 'Rosenborg'),
(574, '5', 'Ludogorets', '', 'Ludogorets'),
(575, '5', 'CFR Cluj', '', 'CFR Cluj'),
(576, '5', 'Piast Gliwice', '', 'Piast Gliwice'),
(577, '5', 'Maribor', '', 'Maribor'),
(578, '5', 'Sutjeska', '', 'Sutjeska'),
(579, '5', 'Celtic', '', 'Celtic'),
(580, '5', 'Tunisia', '', 'Tunisia'),
(581, '5', 'Amorebieta', '', 'Amorebieta'),
(582, '5', 'Beerschot-Wilrijk', '', 'Beerschot-Wilrijk'),
(583, '5', 'Bochum', '', 'Bochum'),
(584, '5', 'First Vienna', '', 'First Vienna'),
(585, '5', 'dd', '', 'dd'),
(601, '6', 'h', '', 'h'),
(602, '6', 'b', '', 'b'),
(603, '6', 'k', '', 'k'),
(604, '6', 'b', '', 'b'),
(605, '6', 'k', '', 'k'),
(606, '6', 'h', '', 'h'),
(607, '6', 'h', '', 'h'),
(608, '6', 'y', '', 'y'),
(609, '6', 'h', '', 'h'),
(610, '6', 'y', '', 'y'),
(611, '6', 'h', '', 'h'),
(612, '6', 'g', '', 'g'),
(613, '6', 'h', '', 'h'),
(614, '6', 'h', '', 'h'),
(615, '6', 'g', '', 'g'),
(631, '7', 'tt', '1', 'tt'),
(632, '7', 'gg', '2', 'gg'),
(633, '7', 'vb', '1', 'vb'),
(634, '7', 'nv', '2', 'nv'),
(635, '7', 'vv', '1', 'vv'),
(636, '7', 'hljhlj', '2', 'hljhlj'),
(637, '7', 'jhlhl', '1', 'jhlhl'),
(638, '7', 'hkhk', '2', 'hkhk'),
(639, '7', 'khklhlk', '1', 'khklhlk'),
(640, '7', 'khk', '2', 'khk'),
(641, '7', 'khkhklh', '1', 'khkhklh'),
(642, '7', 'khklhkl', '2', 'khklhkl'),
(643, '7', 'khkhkl', '1', 'khkhkl'),
(644, '7', 'khlkh', '2', 'khlkh'),
(645, '7', 'hkhlkhlkl', '1', 'hkhlkhlkl');

-- --------------------------------------------------------

--
-- Table structure for table `commission_history`
--

CREATE TABLE `commission_history` (
  `id` int(11) NOT NULL,
  `player` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `amount` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `commission_invite`
--

CREATE TABLE `commission_invite` (
  `id` int(11) NOT NULL,
  `player` varchar(50) NOT NULL,
  `affiliate` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `commistion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_evoucher`
--

CREATE TABLE `deposit_evoucher` (
  `id` int(11) NOT NULL,
  `player` varchar(50) NOT NULL,
  `VOUCHER_NUM` varchar(50) NOT NULL,
  `VOUCHER_ACTIVE` varchar(20) NOT NULL,
  `VOUCHER_AMOUNT` varchar(50) NOT NULL,
  `VOUCHER_AMOUNT_CURRENCY` varchar(50) NOT NULL,
  `Payee_Account` varchar(50) NOT NULL,
  `PAYMENT_BATCH_NUM` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_history`
--

CREATE TABLE `deposit_history` (
  `id` int(11) NOT NULL,
  `player` varchar(30) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `deposit_type` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `tran_id` varchar(100) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deposit_history`
--

INSERT INTO `deposit_history` (`id`, `player`, `amount`, `deposit_type`, `date`, `time`, `tran_id`, `currency`, `status`) VALUES
(1, 'adminT-T', '10000', 'Online Card', '2019-07-17', '11:54:53', 'test balance deposit', NULL, '1'),
(2, 'adminT-T', '10000', 'Online Card', '2019-07-17', '11:57:37', 'test balance deposit', NULL, '1'),
(3, 'adminT-T', '40000', 'Online Card', '2019-07-18', '04:18:42', 'Add for test', NULL, '1'),
(4, 'adminT-T', '30000', 'Online Card', '2019-07-18', '08:34:01', 'Add for test', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `iranian_milioner_history`
--

CREATE TABLE `iranian_milioner_history` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `jackpot` varchar(50) NOT NULL,
  `ball_numbers` varchar(100) NOT NULL,
  `lucky_stars` varchar(50) NOT NULL,
  `date_create` date NOT NULL,
  `time_create` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iranian_milioner_history`
--

INSERT INTO `iranian_milioner_history` (`id`, `date`, `jackpot`, `ball_numbers`, `lucky_stars`, `date_create`, `time_create`) VALUES
(4, '2019-07-26', '50 M', '08-09-10-11-12', '06-07', '2019-07-18', '08:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `iranian_milioner_play`
--

CREATE TABLE `iranian_milioner_play` (
  `id` int(11) NOT NULL,
  `player` varchar(100) NOT NULL,
  `ball_numbers` varchar(50) NOT NULL,
  `lucky_stars` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL,
  `around` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iranian_milioner_play`
--

INSERT INTO `iranian_milioner_play` (`id`, `player`, `ball_numbers`, `lucky_stars`, `date`, `time`, `status`, `around`) VALUES
(1, 'adminT-T', '01-02-03-04-05', '06-07', '2019-07-18', '08:28:24', 1, '2019-07-26'),
(2, 'adminT-T', '08-09-10-11-12', '02-03', '2019-07-18', '08:28:24', 1, '2019-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `iranian_milioner_prize`
--

CREATE TABLE `iranian_milioner_prize` (
  `id` int(11) NOT NULL,
  `history_id` int(11) NOT NULL,
  `around` date NOT NULL,
  `matches` varchar(100) NOT NULL,
  `all_winners` int(50) NOT NULL,
  `prize_per` varchar(50) DEFAULT NULL,
  `cash_prize` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `iranian_milioner_prize`
--

INSERT INTO `iranian_milioner_prize` (`id`, `history_id`, `around`, `matches`, `all_winners`, `prize_per`, `cash_prize`) VALUES
(155, 4, '2019-07-26', 'Match 5 + 2 Stars', 0, '1300000', 0),
(156, 4, '2019-07-26', 'Match 5 + 1 Stars', 0, '1200000', 0),
(157, 4, '2019-07-26', 'Match 5', 1, '1100000', 1100000),
(158, 4, '2019-07-26', 'Match 4 + 2 Stars', 0, '1000000', 0),
(159, 4, '2019-07-26', 'Match 4 + 1 Stars', 0, '900000', 0),
(160, 4, '2019-07-26', 'Match 4', 0, '800000', 0),
(161, 4, '2019-07-26', 'Match 3 + 2 Stars', 0, '700000', 0),
(162, 4, '2019-07-26', 'Match 3 + 1 Stars', 0, '600000', 0),
(163, 4, '2019-07-26', 'Match 3', 0, '500000', 0),
(164, 4, '2019-07-26', 'Match 2 + 2 Stars', 0, '400000', 0),
(165, 4, '2019-07-26', 'Match 2 + 1 Stars', 0, '300000', 0),
(166, 4, '2019-07-26', 'Match 2', 0, '200000', 0),
(167, 4, '2019-07-26', 'Match 1 + 2 Stars', 0, '100000', 0),
(168, 4, '2019-07-26', 'Totals', 1, '', 1100000);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `player` varchar(30) NOT NULL,
  `noti_type` varchar(50) NOT NULL,
  `noti_id` varchar(20) NOT NULL,
  `noti_title` text,
  `noti_link` text,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `point_history`
--

CREATE TABLE `point_history` (
  `id` int(11) NOT NULL,
  `player` varchar(30) NOT NULL,
  `point` varchar(30) NOT NULL,
  `point_type` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `sid` int(11) NOT NULL,
  `commission` varchar(20) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `currency_withdraw` varchar(20) DEFAULT NULL,
  `maintenance` varchar(11) DEFAULT NULL,
  `lobby` varchar(1) DEFAULT NULL,
  `withdraw` varchar(11) DEFAULT NULL,
  `card_destination` varchar(16) DEFAULT NULL,
  `card_destination2` varchar(16) DEFAULT NULL,
  `per_play` varchar(20) DEFAULT NULL,
  `per_lines` int(10) DEFAULT NULL,
  `per_jackpot` varchar(20) DEFAULT NULL,
  `game_close` varchar(50) DEFAULT NULL,
  `match1` varchar(20) DEFAULT NULL,
  `match2` varchar(20) DEFAULT NULL,
  `match3` varchar(20) DEFAULT NULL,
  `match4` varchar(20) DEFAULT NULL,
  `match5` varchar(20) DEFAULT NULL,
  `match6` varchar(20) DEFAULT NULL,
  `match7` varchar(20) DEFAULT NULL,
  `match8` varchar(20) DEFAULT NULL,
  `match9` varchar(20) DEFAULT NULL,
  `match10` varchar(20) DEFAULT NULL,
  `match11` varchar(20) DEFAULT NULL,
  `match12` varchar(20) DEFAULT NULL,
  `match13` varchar(20) DEFAULT NULL,
  `lotorry_close` varchar(50) DEFAULT NULL,
  `lotorry_per_play` varchar(20) DEFAULT NULL,
  `lotorry_per_jackpot` varchar(20) DEFAULT NULL,
  `lotorry_match1` varchar(20) DEFAULT NULL,
  `lotorry_match2` varchar(20) DEFAULT NULL,
  `lotorry_match3` varchar(20) DEFAULT NULL,
  `lotorry_match4` varchar(20) DEFAULT NULL,
  `lotorry_match5` varchar(20) DEFAULT NULL,
  `lotorry_match6` varchar(20) DEFAULT NULL,
  `lotorry_match7` varchar(20) DEFAULT NULL,
  `lotorry_match8` varchar(20) DEFAULT NULL,
  `lotorry_match9` varchar(20) DEFAULT NULL,
  `lotorry_match10` varchar(20) DEFAULT NULL,
  `lotorry_match11` varchar(20) DEFAULT NULL,
  `lotorry_match12` varchar(20) DEFAULT NULL,
  `lotorry_match13` varchar(20) DEFAULT NULL,
  `lotorry_match14` varchar(20) DEFAULT NULL,
  `lotorry_match15` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`sid`, `commission`, `currency`, `currency_withdraw`, `maintenance`, `lobby`, `withdraw`, `card_destination`, `card_destination2`, `per_play`, `per_lines`, `per_jackpot`, `game_close`, `match1`, `match2`, `match3`, `match4`, `match5`, `match6`, `match7`, `match8`, `match9`, `match10`, `match11`, `match12`, `match13`, `lotorry_close`, `lotorry_per_play`, `lotorry_per_jackpot`, `lotorry_match1`, `lotorry_match2`, `lotorry_match3`, `lotorry_match4`, `lotorry_match5`, `lotorry_match6`, `lotorry_match7`, `lotorry_match8`, `lotorry_match9`, `lotorry_match10`, `lotorry_match11`, `lotorry_match12`, `lotorry_match13`, `lotorry_match14`, `lotorry_match15`) VALUES
(1, '20', '150000', '130000', '0', '1', '1', '2522356425656525', '2522356425656525', '10000', 4, '50 M', '07/26/2019 06:00 PM', '1300000', '1200000', '1100000', '1000000', '900000', '800000', '700000', '600000', '500000', '400000', '300000', '200000', '100000', '01/16/2020 12:25 PM', '10000', '50 M', '50000000', '40000000', '30000000', '20000000', '10000000', '5000000', '4000000', '3000000', '2000000', '1000000', '100000', '50000', '10000', '5000', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `user_ban`
--

CREATE TABLE `user_ban` (
  `id` int(11) NOT NULL,
  `player` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_block`
--

CREATE TABLE `user_block` (
  `Player` varchar(100) NOT NULL,
  `block` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_pin`
--

CREATE TABLE `user_pin` (
  `Player` varchar(100) NOT NULL,
  `pin` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `Player` varchar(50) NOT NULL,
  `RealName` varchar(100) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Telephone` varchar(50) DEFAULT NULL,
  `Balance` varchar(50) DEFAULT NULL,
  `onlineCard` int(1) DEFAULT NULL,
  `inviteUser` int(11) DEFAULT NULL,
  `permission` varchar(20) DEFAULT NULL,
  `pins` varchar(4) DEFAULT NULL,
  `uactive` varchar(1) DEFAULT NULL,
  `password` text NOT NULL,
  `eactive` varchar(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `Player`, `RealName`, `Email`, `Telephone`, `Balance`, `onlineCard`, `inviteUser`, `permission`, `pins`, `uactive`, `password`, `eactive`) VALUES
(1, 'adminT-T', 'Admin Lion', 'admin@lionroyal.com', '022222220', '0', 1, 0, 'admin', '1234', '0', 'd16484z2u22394b4', '1'),
(2, 'saman', NULL, 'saman.lion2017@gmail.com', '', NULL, 0, 0, NULL, NULL, '1', 'c19464v2x253', '1'),
(3, 'MY_MY', NULL, 'mme_dumrus@hotmail.com', '', NULL, 0, 0, NULL, NULL, '1', 'u2l5q5w4d4k484z3f464g3n2', '1'),
(4, 'MY_MY2', NULL, 'mme.dumrus@gmail.com', '', NULL, 0, 0, NULL, NULL, '1', 'f1d4e413s243', '1'),
(5, 'gogoli', 'gogli gogoliyan', 'gopinat.menon@gmail.com', '091231456789', NULL, 0, 0, NULL, NULL, '1', 'd14464v2q2w2', '1'),
(6, 'fa_fa', 'pp ss', 'shahraki.p@gmail.com', '07987865434', NULL, 0, 0, NULL, NULL, '1', 'd16484z2u22394a453', '1');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_history`
--

CREATE TABLE `withdraw_history` (
  `id` int(11) NOT NULL,
  `player` varchar(50) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `evoucher` varchar(20) DEFAULT NULL,
  `activation_code` varchar(30) DEFAULT NULL,
  `evoucher_amount` varchar(30) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `withdraw_type` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `auto_withdraw` int(11) NOT NULL,
  `comment` text,
  `comment_date` date DEFAULT NULL,
  `comment_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_voucher`
--

CREATE TABLE `withdraw_voucher` (
  `id` int(11) NOT NULL,
  `player` varchar(50) NOT NULL,
  `Payer_Account` varchar(50) NOT NULL,
  `PAYMENT_AMOUNT` varchar(50) NOT NULL,
  `PAYMENT_BATCH_NUM` varchar(50) NOT NULL,
  `VOUCHER_NUM` varchar(50) NOT NULL,
  `VOUCHER_CODE` varchar(50) NOT NULL,
  `VOUCHER_AMOUNT` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliate`
--
ALTER TABLE `affiliate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_info`
--
ALTER TABLE `bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bet_lotorry_history`
--
ALTER TABLE `bet_lotorry_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bet_lotorry_play`
--
ALTER TABLE `bet_lotorry_play`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bet_lotorry_play_results`
--
ALTER TABLE `bet_lotorry_play_results`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `bet_lotorry_prize`
--
ALTER TABLE `bet_lotorry_prize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bet_lotorry_results`
--
ALTER TABLE `bet_lotorry_results`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `commission_history`
--
ALTER TABLE `commission_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_invite`
--
ALTER TABLE `commission_invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_evoucher`
--
ALTER TABLE `deposit_evoucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_history`
--
ALTER TABLE `deposit_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iranian_milioner_history`
--
ALTER TABLE `iranian_milioner_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iranian_milioner_play`
--
ALTER TABLE `iranian_milioner_play`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iranian_milioner_prize`
--
ALTER TABLE `iranian_milioner_prize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_history`
--
ALTER TABLE `point_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `user_ban`
--
ALTER TABLE `user_ban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_block`
--
ALTER TABLE `user_block`
  ADD PRIMARY KEY (`Player`);

--
-- Indexes for table `user_pin`
--
ALTER TABLE `user_pin`
  ADD PRIMARY KEY (`Player`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_history`
--
ALTER TABLE `withdraw_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_voucher`
--
ALTER TABLE `withdraw_voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliate`
--
ALTER TABLE `affiliate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bet_lotorry_history`
--
ALTER TABLE `bet_lotorry_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bet_lotorry_play`
--
ALTER TABLE `bet_lotorry_play`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bet_lotorry_play_results`
--
ALTER TABLE `bet_lotorry_play_results`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `bet_lotorry_prize`
--
ALTER TABLE `bet_lotorry_prize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `bet_lotorry_results`
--
ALTER TABLE `bet_lotorry_results`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=646;

--
-- AUTO_INCREMENT for table `commission_history`
--
ALTER TABLE `commission_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission_invite`
--
ALTER TABLE `commission_invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_evoucher`
--
ALTER TABLE `deposit_evoucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_history`
--
ALTER TABLE `deposit_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `iranian_milioner_history`
--
ALTER TABLE `iranian_milioner_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `iranian_milioner_play`
--
ALTER TABLE `iranian_milioner_play`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `iranian_milioner_prize`
--
ALTER TABLE `iranian_milioner_prize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_history`
--
ALTER TABLE `point_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_ban`
--
ALTER TABLE `user_ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `withdraw_history`
--
ALTER TABLE `withdraw_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_voucher`
--
ALTER TABLE `withdraw_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
