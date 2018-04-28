# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.53
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2018-04-28 17:12:36
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for jianguo
DROP DATABASE IF EXISTS `jianguo`;
CREATE DATABASE IF NOT EXISTS `jianguo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `jianguo`;


# Dumping structure for table jianguo.game_admin
DROP TABLE IF EXISTS `game_admin`;
CREATE TABLE IF NOT EXISTS `game_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '昵称',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1为超级管理员2为管理员',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `jiesuan` tinyint(4) NOT NULL DEFAULT '0' COMMENT '结算百分比',
  `jiesuan_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '结算方式 0押注,1充换值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table jianguo.game_admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `game_admin` DISABLE KEYS */;
INSERT INTO `game_admin` (`id`, `username`, `nickname`, `password`, `login_time`, `login_ip`, `type`, `parent_id`, `jiesuan`, `jiesuan_type`) VALUES
	(1, 'admin', '', '21232f297a57a5a743894a0e4a801fc3', 1524802558, '0.0.0.0', 1, 0, 0, 0);
/*!40000 ALTER TABLE `game_admin` ENABLE KEYS */;


# Dumping structure for table jianguo.game_admin_log
DROP TABLE IF EXISTS `game_admin_log`;
CREATE TABLE IF NOT EXISTS `game_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员id',
  `admin_name` varchar(100) NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `time` int(11) NOT NULL DEFAULT '0' COMMENT '操作时间',
  `login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '登录ip',
  `details` varchar(100) NOT NULL DEFAULT '' COMMENT '操作详情',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0管理员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table jianguo.game_admin_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `game_admin_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_admin_log` ENABLE KEYS */;


# Dumping structure for table jianguo.game_chat
DROP TABLE IF EXISTS `game_chat`;
CREATE TABLE IF NOT EXISTS `game_chat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '发布者',
  `admin_id` int(10) NOT NULL DEFAULT '0' COMMENT '回复的管理员',
  `to_user_id` int(10) NOT NULL DEFAULT '0' COMMENT '未使用',
  `title` varchar(50) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `readtime` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='消息';

# Dumping data for table jianguo.game_chat: 0 rows
/*!40000 ALTER TABLE `game_chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_chat` ENABLE KEYS */;


# Dumping structure for table jianguo.game_check_ip
DROP TABLE IF EXISTS `game_check_ip`;
CREATE TABLE IF NOT EXISTS `game_check_ip` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rule` varchar(500) NOT NULL DEFAULT '',
  `type` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0黑名单，1白名单',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table jianguo.game_check_ip: 2 rows
/*!40000 ALTER TABLE `game_check_ip` DISABLE KEYS */;
INSERT INTO `game_check_ip` (`id`, `rule`, `type`) VALUES
	(1, '*.*.*.*', '0'),
	(2, '*.*.*.*', '1');
/*!40000 ALTER TABLE `game_check_ip` ENABLE KEYS */;


# Dumping structure for table jianguo.game_config
DROP TABLE IF EXISTS `game_config`;
CREATE TABLE IF NOT EXISTS `game_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='全局配置';

# Dumping data for table jianguo.game_config: 3 rows
/*!40000 ALTER TABLE `game_config` DISABLE KEYS */;
INSERT INTO `game_config` (`id`, `name`, `title`, `value`) VALUES
	(1, 'tel', '官网热线', '010-100000'),
	(2, 'fax', '传真', '5555444666'),
	(3, 'official_link', '官网', '官网:<a href="www.baidu.com" >www.baidu.com</a>');
/*!40000 ALTER TABLE `game_config` ENABLE KEYS */;


# Dumping structure for table jianguo.game_error
DROP TABLE IF EXISTS `game_error`;
CREATE TABLE IF NOT EXISTS `game_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '错误id',
  `error_id` varchar(50) DEFAULT '' COMMENT '错误编号',
  `error_detail` varchar(100) DEFAULT '' COMMENT '错误说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

# Dumping data for table jianguo.game_error: ~48 rows (approximately)
/*!40000 ALTER TABLE `game_error` DISABLE KEYS */;
INSERT INTO `game_error` (`id`, `error_id`, `error_detail`) VALUES
	(1, '10000', '帐号或密码错误'),
	(2, '10001', '您输入的验证码错误'),
	(3, '10002', '欢迎登录'),
	(4, '10003', '抱歉！你无权访问该模块！'),
	(6, '10004', '暂未登录或登录超时，请重新登录!'),
	(7, '10005', '缓存清理成功'),
	(8, '10006', '授权成功！窗口正在关闭....'),
	(9, '10007', '数据新增成功！窗口正在关闭...'),
	(10, '10008', '数据新增失败！请查看错误日志...'),
	(11, '10009', '数据修改成功！窗口正在关闭...'),
	(12, '10010', '数据修改失败！请查看错误日志...'),
	(13, '10011', '数据删除成功！窗口正在关闭...'),
	(14, '10012', '数据删除失败！'),
	(15, '10013', '数据恢复成功！窗口正在关闭...'),
	(16, '10014', '数据恢复失败！'),
	(18, '10015', '短信验证码错误！'),
	(21, '10018', '短信验证码已经发送到手机！'),
	(22, '10019', '短信验证码发送接口出现错误！'),
	(23, '10020', '短信验证码校监出错，请重新获取！'),
	(24, '10021', '短信验证码校监成功！'),
	(26, '10022', '用户已存在'),
	(27, '10024', '未知错误'),
	(28, '10025', '注册成功'),
	(29, '10026', '注册会员写入数据失败,请联系管理员'),
	(30, '10027', '身份证或者手机和验证的不匹配！'),
	(31, '10028', '身份证号不能为空'),
	(32, '10029', '手机号不能为空'),
	(33, '10030', '验证码核对正确'),
	(34, '10031', '姓名不能为空'),
	(35, '10032', '出生日期格式不正确'),
	(36, '10033', '身份证格式不正确'),
	(41, '10038', '电话号码格式不正确'),
	(43, '10040', '银行卡号格式不正确'),
	(44, '10041', '您无权限操作'),
	(45, '10042', 'success'),
	(46, '10043', '暂无数据'),
	(62, '10045', '图片上传失败'),
	(63, '10046', '注册失败,请重试'),
	(64, 'csrf', '页面已过期,请刷新重试'),
	(65, '10047', '用户名格式不正确'),
	(66, 'ok', '操作成功'),
	(67, '10048', '请上传图片'),
	(68, '10049', '请完整填写表单'),
	(69, '10050', '密码修改成功'),
	(70, '10051', '交易密码错误'),
	(71, 'no', '操作失败'),
	(72, '10023', '两次密码输入不一致'),
	(73, '10016', '邮箱验证码错误！');
/*!40000 ALTER TABLE `game_error` ENABLE KEYS */;


# Dumping structure for table jianguo.game_menu
DROP TABLE IF EXISTS `game_menu`;
CREATE TABLE IF NOT EXISTS `game_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `parent` int(11) NOT NULL DEFAULT '0',
  `rank` int(11) NOT NULL DEFAULT '0',
  `display` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='导航菜单';

# Dumping data for table jianguo.game_menu: 0 rows
/*!40000 ALTER TABLE `game_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_menu` ENABLE KEYS */;


# Dumping structure for table jianguo.game_model
DROP TABLE IF EXISTS `game_model`;
CREATE TABLE IF NOT EXISTS `game_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL DEFAULT 'Index',
  `action` varchar(255) NOT NULL DEFAULT 'index',
  `verify` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1必须验证2不需要验证',
  `user_id` varchar(1000) NOT NULL DEFAULT '0',
  `belongid` int(11) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '结构等级0公用1菜单2模型3操作',
  `icon` varchar(255) NOT NULL DEFAULT 'cog',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

# Dumping data for table jianguo.game_model: ~78 rows (approximately)
/*!40000 ALTER TABLE `game_model` DISABLE KEYS */;
INSERT INTO `game_model` (`id`, `name`, `controller`, `action`, `verify`, `user_id`, `belongid`, `level`, `icon`) VALUES
	(1, '系统设置', 'A', 'index', 1, '0', 0, 1, 'cog'),
	(2, '信息设置', 'Setting', 'index', 1, '0', 1, 2, 'commenting-o'),
	(3, '菜单管理', 'Setting', 'meun', 1, '0', 1, 2, 'align-left'),
	(4, '系统管理员', 'Admin', 'index', 1, '0', 1, 2, 'user'),
	(5, '增加', 'Setting', 'error_add', 1, '0', 2, 3, 'plus-square'),
	(6, '修改', 'Setting', 'error_save', 1, '0', 2, 3, 'edit'),
	(7, '删除', 'Setting', 'error_del', 1, '0', 2, 3, 'trash'),
	(8, '增加', 'Setting', 'add', 1, '0', 3, 3, 'plus-square'),
	(9, '修改', 'Setting', 'save', 1, '0', 3, 3, 'edit'),
	(10, '删除', 'Setting', 'del', 1, '0', 3, 3, 'trash'),
	(11, '增加', 'Admin', 'add', 1, '0', 4, 3, 'plus-square'),
	(12, '修改', 'Admin', 'save', 1, '0', 4, 3, 'edit'),
	(13, '删除', 'Admin', 'del', 1, '0', 4, 3, 'trash'),
	(14, '授权管理', 'Admin', 'rbac', 1, '0', 4, 3, 'unlock-alt'),
	(15, '用户管理', 'B', 'index', 1, '0', 0, 1, 'cog'),
	(16, '订单管理', 'C', 'index', 1, '0', 0, 1, 'cog'),
	(17, '游戏管理', 'D', 'index', 1, '0', 0, 1, 'cog'),
	(18, '用户列表', 'User', 'index', 1, '0', 15, 2, 'user'),
	(19, '增加', 'User', 'add', 1, '0', 18, 3, 'plus-square'),
	(20, '查看', 'User', 'save', 1, '0', 18, 3, 'edit'),
	(21, '加入黑名单', 'User', 'black', 1, '0', 18, 3, 'trash'),
	(22, '订单列表', 'Order', 'index', 1, '0', 16, 2, ''),
	(24, '查看聊天记录', 'Order', 'view', 1, '0', 22, 3, 'eye'),
	(25, '删除', 'Order', 'del', 1, '0', 22, 3, 'trash'),
	(26, '全局设置', 'E', 'index', 1, '0', 0, 1, 'cog'),
	(28, '会员等级规则', 'Member', 'index', 1, '0', 26, 2, ''),
	(31, '删除', 'Member', 'del', 1, '0', 28, 3, 'trash'),
	(32, '音频', 'Audio', 'index', 1, '0', 81, 2, 'file-audio-o'),
	(33, '增加', 'Audio', 'add', 1, '0', 32, 3, 'plus-square'),
	(34, '修改', 'Audio', 'save', 1, '0', 32, 3, 'edit'),
	(36, 'ip限制', 'Checkip', 'index', 1, '0', 26, 2, ''),
	(38, '修改', 'Checkip', 'save', 1, '0', 36, 3, 'edit'),
	(40, '轮播图', 'Slide', 'index', 1, '0', 26, 2, ''),
	(41, '增加', 'Slide', 'add', 1, '0', 40, 3, 'plus-square'),
	(42, '修改', 'Slide', 'save', 1, '0', 40, 3, 'edit'),
	(43, '删除', 'Slide', 'del', 1, '0', 40, 3, 'trash'),
	(44, '在线用户', 'Online', 'index', 1, '0', 15, 2, ''),
	(47, '下线', 'Online', 'del', 1, '0', 44, 3, 'unlink'),
	(49, '批量添加会员', 'User', 'user_add_more', 1, '0', 15, 3, 'file-excel-o'),
	(50, '游戏列表', 'Games', 'index', 1, '0', 17, 2, ''),
	(51, '增加', 'Games', 'add', 1, '0', 50, 3, 'plus-square'),
	(52, '修改', 'Games', 'save', 1, '0', 50, 3, 'edit'),
	(53, '上架/下架', 'Games', 'disable_data', 1, '0', 50, 3, 'exchange'),
	(54, '导航菜单', 'Menu', 'index', 1, '0', 26, 2, ''),
	(55, '增加', 'Menu', 'add', 1, '0', 54, 3, 'plus-square'),
	(56, '修改', 'Menu', 'save', 1, '0', 54, 3, 'edit'),
	(57, '删除', 'Menu', 'del', 1, '0', 54, 3, 'trash'),
	(58, '公告管理', 'Announcement', 'index', 1, '0', 80, 2, ''),
	(59, '增加', 'Announcement', 'add', 1, '0', 58, 3, 'plus-square'),
	(60, '修改', 'Announcement', 'save', 1, '0', 58, 3, 'edit'),
	(61, '删除', 'Announcement', 'del', 1, '0', 58, 3, 'trash'),
	(64, '移出黑名单', 'User', 'returnBlack', 1, '0', 18, 3, 'reply-all'),
	(65, '交易日志', 'Walletlog', 'index', 1, '0', 16, 2, ''),
	(66, '财产管理', 'Moneyreport', 'index', 1, '0', 26, 2, ''),
	(67, '修改', 'Moneyreport', 'save', 1, '0', 66, 3, 'edit'),
	(68, '全局LOG', 'Admin', 'log_view', 1, '0', 15, 2, 'eye'),
	(71, '统计', 'Count', 'index', 1, '0', 26, 2, ''),
	(73, '修改', 'Member', 'save', 1, '0', 28, 3, 'edit'),
	(74, '骰子游戏结果提交', 'Games', 'dice_add', 1, '0', 1, 2, 'gamepad'),
	(75, '游戏结果', 'Games', 'game_result', 1, '0', 17, 2, ''),
	(76, '删除结果', 'Games', 'del_result', 1, '0', 75, 3, 'trash'),
	(77, '用户押注列表', 'User', 'user_bet', 1, '0', 17, 2, 'user'),
	(78, '押注回滚', 'User', 'user_bet_back', 1, '0', 77, 3, 'trash'),
	(79, '充换值管理', 'F', 'index', 1, '0', 0, 1, 'cog'),
	(80, '信息管理', 'G', 'index', 1, '0', 0, 1, 'cog'),
	(81, '网站管理', 'H', 'index', 1, '0', 0, 1, 'cog'),
	(82, '充换值列表', 'Apply', 'index', 1, '0', 79, 2, ''),
	(83, 'point获取设置', 'Point', 'index', 1, '0', 79, 2, ''),
	(84, '金币使用日志', 'Moneylog', 'index', 1, '0', 79, 2, ''),
	(85, 'point使用日志', 'Pointlog', 'index', 1, '0', 79, 2, ''),
	(86, '用户咨询列表', 'Userchat', 'index', 1, '0', 80, 2, ''),
	(87, '游戏规则', 'Games', 'rule', 1, '0', 80, 2, ''),
	(88, '弹窗公告', 'Announcement', 'tips', 1, '0', 80, 2, ''),
	(89, 'API', 'Api', 'index', 1, '0', 81, 2, ''),
	(90, '余额管理', 'User', 'money_change', 1, '0', 18, 3, 'money'),
	(91, '日志', 'User', 'user_log', 1, '0', 18, 3, 'eye'),
	(92, '通过', 'Apply', 'save', 1, '0', 82, 3, 'check'),
	(93, '取消', 'Apply', 'cancel', 1, '0', 82, 3, 'times');
/*!40000 ALTER TABLE `game_model` ENABLE KEYS */;


# Dumping structure for table jianguo.game_news
DROP TABLE IF EXISTS `game_news`;
CREATE TABLE IF NOT EXISTS `game_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '',
  `content` varchar(500) NOT NULL DEFAULT '',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `readtime` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='消息';

# Dumping data for table jianguo.game_news: 0 rows
/*!40000 ALTER TABLE `game_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_news` ENABLE KEYS */;


# Dumping structure for table jianguo.game_online
DROP TABLE IF EXISTS `game_online`;
CREATE TABLE IF NOT EXISTS `game_online` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `logintime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='在线用户';

# Dumping data for table jianguo.game_online: 0 rows
/*!40000 ALTER TABLE `game_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_online` ENABLE KEYS */;


# Dumping structure for table jianguo.game_region
DROP TABLE IF EXISTS `game_region`;
CREATE TABLE IF NOT EXISTS `game_region` (
  `region_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `region_name` varchar(120) NOT NULL DEFAULT '',
  `region_type` tinyint(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Dumping data for table jianguo.game_region: ~0 rows (approximately)
/*!40000 ALTER TABLE `game_region` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_region` ENABLE KEYS */;


# Dumping structure for table jianguo.game_slide
DROP TABLE IF EXISTS `game_slide`;
CREATE TABLE IF NOT EXISTS `game_slide` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL DEFAULT '',
  `img` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='轮播图';

# Dumping data for table jianguo.game_slide: 0 rows
/*!40000 ALTER TABLE `game_slide` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_slide` ENABLE KEYS */;


# Dumping structure for table jianguo.game_user
DROP TABLE IF EXISTS `game_user`;
CREATE TABLE IF NOT EXISTS `game_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `nick_name` varchar(50) NOT NULL DEFAULT '',
  `login_pwd` varchar(100) NOT NULL DEFAULT '' COMMENT '登录密码',
  `pay_pwd` varchar(100) NOT NULL DEFAULT '' COMMENT '支付密码',
  `head_img` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `bank_name` varchar(50) NOT NULL DEFAULT '' COMMENT '银行名',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `bank_sn` varchar(50) NOT NULL DEFAULT '' COMMENT '银行卡号',
  `money` bigint(20) NOT NULL DEFAULT '0',
  `point` int(11) NOT NULL DEFAULT '0',
  `tel` varchar(50) NOT NULL DEFAULT '',
  `money_in` bigint(20) NOT NULL DEFAULT '0' COMMENT '充值额',
  `money_out` bigint(20) NOT NULL DEFAULT '0' COMMENT '换值额',
  `bet_count` int(11) NOT NULL DEFAULT '0' COMMENT '押注次数',
  `parent_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级用户id',
  `invite_code` varchar(50) NOT NULL DEFAULT '0' COMMENT '上级用户id',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最近登录时间',
  `rank` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员等级',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '邀请码',
  `comment` varchar(500) NOT NULL DEFAULT '' COMMENT '备注',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT '注册IP',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否为管理员',
  `status` tinyint(11) NOT NULL DEFAULT '0' COMMENT '状态码',
  `form` tinyint(11) NOT NULL DEFAULT '0' COMMENT '来源,0注册,1管理员添加,2批量添加',
  `confine` tinyint(11) NOT NULL DEFAULT '0' COMMENT '是否被限制登录',
  `confine_time` int(11) NOT NULL DEFAULT '0' COMMENT '被限制时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

# Dumping data for table jianguo.game_user: ~6 rows (approximately)
/*!40000 ALTER TABLE `game_user` DISABLE KEYS */;
INSERT INTO `game_user` (`id`, `user_name`, `nick_name`, `login_pwd`, `pay_pwd`, `head_img`, `email`, `bank_name`, `name`, `bank_sn`, `money`, `point`, `tel`, `money_in`, `money_out`, `bet_count`, `parent_user_id`, `invite_code`, `last_login_time`, `rank`, `code`, `comment`, `createtime`, `ip`, `is_admin`, `status`, `form`, `confine`, `confine_time`) VALUES
	(1, 'jianguo', 'jianguo', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '/Uploads/2018-02-10/5a7e6ad68c93f.jpg', '1697837999@qq.com', '银行名称', 'jianguo', '', 1000, 1031, '18630219823', 1000, 300, 50, 2, '999999', 1524712968, 0, '0', '', 111122233, '123', 0, 0, 0, 0, 0),
	(2, 'dadajie', '大大姐', 'e10adc3949ba59abbe56e057f20f883e', '', '', '444', '', '111', '', 0, 0, '', 0, 0, 0, 0, '0', 1524712968, 0, '0', '', 1517385140, '', 0, 0, 0, 0, 0),
	(3, 'jianguo', '坚果', '', '', '', 'sdf@qq.com', '', 'jianguo', '', 0, 0, '18866655315', 0, 0, 0, 0, '0', 1524712968, 0, '0', '', 0, '', 0, 0, 0, 0, 0),
	(4, 'shaman', '傻慢', '', '', '', 'sm.e@qq.com', '', 'shaman', '', 0, 0, '188999333220', 0, 0, 0, 0, '0', 1524712968, 0, '0', '', 0, '', 0, 0, 0, 0, 0),
	(5, 'daozei', '呆呆贼', '', '', '', 'ddz@sina.com', '', 'daozei', '', 0, 0, '22233300991', 0, 0, 0, 0, '0', 1524712968, 0, '0', '', 0, '', 0, 0, 0, 0, 0),
	(6, 'lieren', '劣人', '', '', '', 'gsf@163.com', '', 'lieren', '', 0, 0, '333111000022', 0, 0, 0, 0, '0', 1524712968, 0, '0', '', 0, '', 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `game_user` ENABLE KEYS */;


# Dumping structure for table jianguo.game_user_log
DROP TABLE IF EXISTS `game_user_log`;
CREATE TABLE IF NOT EXISTS `game_user_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `log_type` int(10) NOT NULL DEFAULT '0' COMMENT '登录日志',
  `type` int(10) NOT NULL DEFAULT '0',
  `money_type` int(10) NOT NULL DEFAULT '0',
  `number` bigint(20) NOT NULL DEFAULT '0',
  `msg` varchar(500) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户日志';

# Dumping data for table jianguo.game_user_log: 0 rows
/*!40000 ALTER TABLE `game_user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_user_log` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
