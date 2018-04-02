-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 01 月 26 日 14:14
-- 服务器版本: 5.6.21
-- PHP 版本: 5.4.34

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `onlineloan`
--

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imgurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `text` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `linkurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bgmanager`
--

CREATE TABLE IF NOT EXISTS `bgmanager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `rights` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remarks` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime DEFAULT NULL,
  `lastmodifytime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `bgmanager`
--

INSERT INTO `bgmanager` (`id`, `loginname`, `password`, `rights`, `remarks`, `createtime`, `lastmodifytime`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '{"bghomepage":"1","bgmessage":"1","bgareastation":"1"}', '', '2016-10-09 13:49:03', '2016-10-09 13:49:03');

-- --------------------------------------------------------

--
-- 表的结构 `calculateloanofcar`
--

CREATE TABLE IF NOT EXISTS `calculateloanofcar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `areaid` int(11) NOT NULL DEFAULT '0',
  `payscale` float NOT NULL DEFAULT '0' COMMENT '首付比例',
  `rate` float NOT NULL DEFAULT '0',
  `taxcost` float NOT NULL DEFAULT '0',
  `*****` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `calculateloanofhouse`
--

CREATE TABLE IF NOT EXISTS `calculateloanofhouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limittime` int(11) NOT NULL DEFAULT '0' COMMENT '1六个月内2六个月至一年3一年至三年4三年至五年5五年以上',
  `rate` float NOT NULL DEFAULT '0',
  `***` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `calculateloanofoldhouse`
--

CREATE TABLE IF NOT EXISTS `calculateloanofoldhouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limittime` int(11) NOT NULL DEFAULT '0' COMMENT '1六个月内2六个月至一年3一年至三年4三年至五年5五年以上',
  `rate` float NOT NULL DEFAULT '0',
  `***` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `calculateloanofpublicfunds`
--

CREATE TABLE IF NOT EXISTS `calculateloanofpublicfunds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limittime` int(11) NOT NULL DEFAULT '0' COMMENT '1六个月内2六个月至一年3一年至三年4三年至五年5五年以上',
  `rate` float NOT NULL DEFAULT '0',
  `***` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cooperatagency`
--

CREATE TABLE IF NOT EXISTS `cooperatagency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imgurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` int(11) NOT NULL,
  `linkurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `demanderblacklist`
--

CREATE TABLE IF NOT EXISTS `demanderblacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1拉黑-1解除拉黑',
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `demandername` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operator` int(11) NOT NULL DEFAULT '0',
  `operattime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `demandercheckhistory`
--

CREATE TABLE IF NOT EXISTS `demandercheckhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `operator` int(11) NOT NULL DEFAULT '0',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime DEFAULT NULL,
  `*****` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `demanderfocuslist`
--

CREATE TABLE IF NOT EXISTS `demanderfocuslist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `demanderinfo`
--

CREATE TABLE IF NOT EXISTS `demanderinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime DEFAULT NULL,
  `operator` int(11) NOT NULL DEFAULT '0',
  `isblacklist` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `demandervisithistory`
--

CREATE TABLE IF NOT EXISTS `demandervisithistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `visittime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `demandinfo`
--

CREATE TABLE IF NOT EXISTS `demandinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isstick` int(11) NOT NULL DEFAULT '0',
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `demandnum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `profession` int(11) NOT NULL DEFAULT '0',
  `houseproperty` int(11) NOT NULL DEFAULT '0',
  `carinfo` int(11) NOT NULL DEFAULT '0',
  `creditinvestigate` int(11) NOT NULL DEFAULT '0',
  `socialsecurity` int(11) NOT NULL DEFAULT '0',
  ` creditcard` int(11) NOT NULL DEFAULT '0',
  `age` int(11) NOT NULL DEFAULT '0',
  `marriage` int(11) NOT NULL DEFAULT '0',
  `children` int(11) NOT NULL DEFAULT '0',
  `company` int(11) NOT NULL DEFAULT '0',
  `companyrun` int(11) NOT NULL DEFAULT '0',
  `demandstate` int(11) NOT NULL DEFAULT '0',
  `otherloans` int(11) NOT NULL DEFAULT '0',
  `demandtime` int(11) NOT NULL DEFAULT '0',
  `otherdesc` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Applytime` datetime DEFAULT NULL,
  `aptitude` int(11) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_unicode_ci,
  `showright` int(11) NOT NULL DEFAULT '0' COMMENT '1所有人可见2仅供方可见3仅站方可见',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime DEFAULT NULL,
  `operator` int(11) NOT NULL DEFAULT '0',
  `maxvisible` int(11) NOT NULL DEFAULT '0',
  `currentvisiblenum` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '-1撤回',
  `*****` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `demandinfocheckhistory`
--

CREATE TABLE IF NOT EXISTS `demandinfocheckhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demandinfoid` int(11) NOT NULL DEFAULT '0',
  `demandinfocontent` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operator` int(11) NOT NULL DEFAULT '0',
  `operattime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `footerfixed`
--

CREATE TABLE IF NOT EXISTS `footerfixed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `copyright` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `******` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `footervaried`
--

CREATE TABLE IF NOT EXISTS `footervaried` (
  `id` int(11) NOT NULL,
  `footerfixid` int(11) NOT NULL DEFAULT '0',
  `keytext` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `****` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `keywordwarn`
--

CREATE TABLE IF NOT EXISTS `keywordwarn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `labelhistory`
--

CREATE TABLE IF NOT EXISTS `labelhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `labelid` int(11) NOT NULL DEFAULT '0',
  `demandinfoid` int(11) NOT NULL DEFAULT '0',
  `supplyinfoid` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `labels`
--

CREATE TABLE IF NOT EXISTS `labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `label` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `newscheckhistory`
--

CREATE TABLE IF NOT EXISTS `newscheckhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsid` int(11) NOT NULL DEFAULT '0',
  `newscontent` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `operator` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `newslabellist`
--

CREATE TABLE IF NOT EXISTS `newslabellist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsid` int(11) NOT NULL DEFAULT '0',
  `labelid` int(11) NOT NULL DEFAULT '0',
  `labeltext` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `newslablesset`
--

CREATE TABLE IF NOT EXISTS `newslablesset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `newslist`
--

CREATE TABLE IF NOT EXISTS `newslist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newstypeid` int(11) NOT NULL DEFAULT '0',
  `isstick` int(11) NOT NULL DEFAULT '0',
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowreply` int(11) NOT NULL DEFAULT '0',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operator` int(11) NOT NULL DEFAULT '0',
  `operattime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`newstypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `newsreplylist`
--

CREATE TABLE IF NOT EXISTS `newsreplylist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsid` int(11) NOT NULL DEFAULT '0',
  `repliertype` int(11) NOT NULL DEFAULT '0' COMMENT '1需方2供方3站方',
  `replierid` int(11) NOT NULL DEFAULT '0',
  `repliername` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isstick` int(11) NOT NULL DEFAULT '0',
  `isstop` int(11) NOT NULL DEFAULT '0',
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `replytime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `newssubarea`
--

CREATE TABLE IF NOT EXISTS `newssubarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsid` int(11) NOT NULL DEFAULT '0',
  `subareaid` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `newstype`
--

CREATE TABLE IF NOT EXISTS `newstype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `parentid` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `publish` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `rechargerule`
--

CREATE TABLE IF NOT EXISTS `rechargerule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cashnum` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `giftscore` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `scorerule`
--

CREATE TABLE IF NOT EXISTS `scorerule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publishgoodsscore` int(11) NOT NULL DEFAULT '0',
  `goodsmaxscore` int(11) NOT NULL DEFAULT '0',
  `publishinfoscore` int(11) NOT NULL DEFAULT '0',
  `infomaxscore` int(11) NOT NULL DEFAULT '0',
  `lookcontactneed` int(11) NOT NULL DEFAULT '0',
  `infostick` int(11) NOT NULL DEFAULT '0',
  `inforecommended` int(11) NOT NULL DEFAULT '0',
  `registscore` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `slideimginfo`
--

CREATE TABLE IF NOT EXISTS `slideimginfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `imgurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `linkurl` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `slideimgsubarea`
--

CREATE TABLE IF NOT EXISTS `slideimgsubarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subareaid` int(11) NOT NULL DEFAULT '0',
  `slideimgid` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `subarea`
--

CREATE TABLE IF NOT EXISTS `subarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `suppliercheckhistory`
--

CREATE TABLE IF NOT EXISTS `suppliercheckhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `operator` int(11) NOT NULL DEFAULT '0',
  `isallowed` int(11) NOT NULL DEFAULT '0' COMMENT '1通过-1不通过',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime DEFAULT NULL,
  `*****` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `supplieridentityconfirm`
--

CREATE TABLE IF NOT EXISTS `supplieridentityconfirm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `idnumber` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operator` int(11) NOT NULL DEFAULT '0',
  `operattime` datetime DEFAULT NULL,
  `*****` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `supplierinfo`
--

CREATE TABLE IF NOT EXISTS `supplierinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `area` int(11) NOT NULL DEFAULT '0',
  `company` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `imgurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `recommendindex` int(11) NOT NULL DEFAULT '0',
  `goodproduct` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `qqnum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `wxnum` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `personalfeature` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1个人2企业机构',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `ismodify` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime DEFAULT NULL,
  `operator` int(11) NOT NULL DEFAULT '0',
  `***` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `score` float NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `supplierscorehistory`
--

CREATE TABLE IF NOT EXISTS `supplierscorehistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `scoretype` int(11) NOT NULL DEFAULT '0' COMMENT '1增加积分-1扣除积分',
  `changetype` int(11) NOT NULL DEFAULT '0' COMMENT '1发布产品2发布资讯3每日发布资讯上限数4查看一个联系方式5资讯被置顶6资讯被推荐7站方设置8供方充值',
  `rechargemoney` int(11) NOT NULL DEFAULT '0',
  `beforescore` int(11) NOT NULL DEFAULT '0',
  `changescore` int(11) NOT NULL DEFAULT '0',
  `afterscore` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime NOT NULL,
  `operator` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `suppliersubarea`
--

CREATE TABLE IF NOT EXISTS `suppliersubarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `subareaid` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `suppliervisithistory`
--

CREATE TABLE IF NOT EXISTS `suppliervisithistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `payscore` int(11) NOT NULL DEFAULT '0',
  `visittime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `supplyinfo`
--

CREATE TABLE IF NOT EXISTS `supplyinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producttype` int(11) NOT NULL DEFAULT '0' COMMENT '1房产抵押2信用贷款',
  `loannum` int(11) NOT NULL DEFAULT '0' COMMENT '1房产7层，2按揭50倍',
  `isstick` int(11) NOT NULL DEFAULT '0',
  `supplierid` int(11) NOT NULL DEFAULT '0',
  `productname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `rate` int(11) NOT NULL DEFAULT '0' COMMENT '15年内利率为5.4%,210年内利率6.8%',
  `paytype` int(11) NOT NULL DEFAULT '0' COMMENT '1等额本金2等额本息',
  `paytime` int(11) NOT NULL DEFAULT '0' COMMENT '11-5年25-10年310-15年415年以上',
  `paynum` int(11) NOT NULL DEFAULT '0' COMMENT '11-10万210-20万320-30万430-40万',
  `needyear` int(11) NOT NULL DEFAULT '0' COMMENT '11-2年22-3年33-5年45年以上',
  `needincome` int(11) NOT NULL DEFAULT '0' COMMENT '13000-5000,25000-10000,310000以上',
  `needage` int(11) NOT NULL DEFAULT '0' COMMENT '140岁以下，240-60岁，360岁以上',
  `worktype` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nationality` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `needcompany` int(11) NOT NULL DEFAULT '0' COMMENT '1无公司2有公司3股东',
  `needliushui` int(11) NOT NULL DEFAULT '0' COMMENT '1无',
  `needprofession` int(11) NOT NULL DEFAULT '0',
  `needproperty` int(11) NOT NULL DEFAULT '0',
  `needcredit` int(11) NOT NULL DEFAULT '0',
  `needtime` int(11) NOT NULL DEFAULT '0',
  `Featuresintroduce` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime DEFAULT NULL,
  `operator` int(11) NOT NULL DEFAULT '0',
  `refreshtime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `supplyinfocheckhistory`
--

CREATE TABLE IF NOT EXISTS `supplyinfocheckhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplyinfoid` int(11) NOT NULL DEFAULT '0',
  `supplyinfocontent` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isallowed` int(11) NOT NULL DEFAULT '0',
  `operator` int(11) NOT NULL DEFAULT '0',
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operattime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `supplyinforeply`
--

CREATE TABLE IF NOT EXISTS `supplyinforeply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplyinfoid` int(11) NOT NULL DEFAULT '0',
  `isstick` int(11) NOT NULL DEFAULT '0',
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `demandername` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `isstop` int(11) NOT NULL DEFAULT '0',
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `replytime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `supplyinfovisithistory`
--

CREATE TABLE IF NOT EXISTS `supplyinfovisithistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplyinfoid` int(11) NOT NULL DEFAULT '0',
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `visittime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `staytime` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `webannounce`
--

CREATE TABLE IF NOT EXISTS `webannounce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isstick` int(11) NOT NULL DEFAULT '0',
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `websitenotice`
--

CREATE TABLE IF NOT EXISTS `websitenotice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `operator` int(11) NOT NULL DEFAULT '0',
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `websitenoticehistory`
--

CREATE TABLE IF NOT EXISTS `websitenoticehistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noticeid` int(11) NOT NULL DEFAULT '0',
  `demanderid` int(11) NOT NULL DEFAULT '0',
  `isread` int(11) NOT NULL DEFAULT '0',
  `readtime` datetime DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `lastmodifytime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
