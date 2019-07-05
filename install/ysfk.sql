/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : syfaka

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-21 23:43:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ys_acp
-- ----------------------------
DROP TABLE IF EXISTS `ys_acp`;
CREATE TABLE `ys_acp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(300) NOT NULL DEFAULT '',
  `userid` text NOT NULL,
  `userkey` text NOT NULL,
  `is_ste` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用 1是 0否',
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_acp
-- ----------------------------
INSERT INTO `ys_acp` VALUES ('38', 'zfbf2f', '支付宝当面付', '', '', '', '1');
INSERT INTO `ys_acp` VALUES ('39', 'paysapi', 'PaysApi支付', '', '', '', '0');
INSERT INTO `ys_acp` VALUES ('40', 'alipay', '支付宝即时到账', '', '', '', '0');
INSERT INTO `ys_acp` VALUES ('41', 'mazf', '码支付', '', '', '', '1');

-- ----------------------------
-- Table structure for ys_admin
-- ----------------------------
DROP TABLE IF EXISTS `ys_admin`;
CREATE TABLE `ys_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adminname` varchar(20) NOT NULL,
  `adminpass` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `is_state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `limits` text,
  `limit_ip` varchar(300) NOT NULL DEFAULT '',
  `is_limit_ip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_admin
-- ----------------------------
INSERT INTO `ys_admin` VALUES ('1', 'admin', 'd5a1bdf9ce989fd6161063e94b92bdeacb94ed23', '4718737b9f2f6e2c225fe605d6c7234330e7e7e4', '0', '{\"limit_ip\":\"\",\"is_limit_ip\":\"0\",\"set\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"mailtpl\":\"\\u90ae\\u4ef6\\u6a21\\u7248\",\"admins\":\"\\u7ba1\\u7406\\u5458\\u5217\\u8868\",\"pwd\":\"\\u4fee\\u6539\\u5bc6\\u7801\",\"logs\":\"\\u767b\\u5f55\\u65e5\\u5fd7\",\"cog\":\"\\u5bfc\\u822a\\u8bbe\\u7f6e\",\"user\":\"\\u7528\\u6237\\u5217\\u8868\",\"ulevel\":\"\\u7528\\u6237\\u7ea7\\u522b\",\"orders\":\"\\u8ba2\\u5355\\u5217\\u8868\",\"gdclass\":\"\\u5546\\u54c1\\u5206\\u7c7b\",\"goods\":\"\\u5546\\u54c1\\u5217\\u8868\",\"kami\":\"\\u5361\\u5bc6\\u7ba1\\u7406\",\"acp\":\"\\u63a5\\u5165\\u4fe1\\u606f\"}', '', '0');

-- ----------------------------
-- Table structure for ys_adminlogs
-- ----------------------------
DROP TABLE IF EXISTS `ys_adminlogs`;
CREATE TABLE `ys_adminlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adminid` int(10) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `ip` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adminid` (`adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_adminlogs
-- ----------------------------
INSERT INTO `ys_adminlogs` VALUES ('45', '1', '1526994097', '127.0.0.1');
INSERT INTO `ys_adminlogs` VALUES ('46', '1', '1527074809', '127.0.0.1');
INSERT INTO `ys_adminlogs` VALUES ('47', '1', '1527161504', '127.0.0.1');
INSERT INTO `ys_adminlogs` VALUES ('48', '1', '1527315069', '127.0.0.1');
INSERT INTO `ys_adminlogs` VALUES ('49', '1', '1527595236', '127.0.0.1');
INSERT INTO `ys_adminlogs` VALUES ('50', '1', '1527776771', '127.0.0.1');
INSERT INTO `ys_adminlogs` VALUES ('51', '1', '1527864135', '127.0.0.1');
INSERT INTO `ys_adminlogs` VALUES ('52', '1', '1529584936', '127.0.0.1');

-- ----------------------------
-- Table structure for ys_config
-- ----------------------------
DROP TABLE IF EXISTS `ys_config`;
CREATE TABLE `ys_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sitename` varchar(50) NOT NULL,
  `siteurl` varchar(50) NOT NULL,
  `siteinfo` varchar(50) NOT NULL DEFAULT '',
  `keyword` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(300) NOT NULL DEFAULT '',
  `webcopy` text,
  `links` text COMMENT '友情链接',
  `email` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(12) NOT NULL DEFAULT '',
  `qq` varchar(12) NOT NULL DEFAULT '',
  `icpcode` varchar(20) NOT NULL DEFAULT '',
  `stacode` varchar(500) NOT NULL DEFAULT '',
  `smtp_server` varchar(20) NOT NULL DEFAULT '',
  `smtp_email` varchar(50) NOT NULL DEFAULT '',
  `smtp_pwd` varchar(20) NOT NULL DEFAULT '',
  `tips` text,
  `ctime` varchar(100) DEFAULT NULL,
  `email_state` tinyint(1) NOT NULL DEFAULT '0',
  `ismail_kuc` tinyint(1) NOT NULL DEFAULT '0',
  `ismail_num` int(20) DEFAULT '0',
  `serive_token` varchar(255) DEFAULT NULL,
  `sw_reg` tinyint(1) DEFAULT '1' COMMENT '是否开启注册',
  `regle` tinyint(1) DEFAULT '1' COMMENT '默认注册级别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_config
-- ----------------------------
INSERT INTO `ys_config` VALUES ('1', '云尚发卡系统1', 'http://www.syfaka.com', '云尚发卡系统 安全稳定1', '云尚发卡系统 安全稳定', '云尚发卡系统 安全稳定', '<p>由 <a href=\"http://www.yunscx.com/\" title=\"云尚创想\"\r\n                target=\"_blank\" class=\"\">云尚创想</a>\r\n            提供技术支持</p>\r\n        <p>CopyRight©2018  Yunscx Inc.</p>', '<a class=\"am-footer-desktop\" href=\"http://www.yunscx.com\" target=\"_blank\">云尚官网</a>', '53331323@qq.com', '400-000-0000', '53331323', '沪ICP备13008591号', '', '', '', '', '<h2>\r\n	<ul class=\"tpl-task-list tpl-task-remind\" style=\"box-sizing:border-box;margin:0px;padding:0px;list-style:none;color:#333333;font-family:&quot;font-size:18px;white-space:normal;background-color:#FFFFFF;\">\r\n		<li style=\"box-sizing:border-box;margin:0px 0px 7px;padding:10px !important;list-style:none;position:relative;border-bottom:1px solid #F4F6F9;height:auto !important;font-size:14px !important;line-height:22px !important;color:#82949A;\">\r\n			<div class=\"cosA\" style=\"box-sizing:border-box;margin-right:80px;\">\r\n				<span class=\"cosIco\" style=\"box-sizing:border-box;display:inline-block;width:24px;height:24px;vertical-align:middle;color:#FFFFFF;text-align:center;border-radius:3px;background-color:#36C6D3;\"><span class=\"am-icon-bell-o\" style=\"box-sizing:border-box;display:inline-block;\"></span></span>&nbsp;<span style=\"box-sizing:border-box;\">注意：本站为云尚发卡系统演示站，商品数据只做测试使用！</span>\r\n			</div>\r\n		</li>\r\n		<li style=\"box-sizing:border-box;margin:0px 0px 7px;padding:10px !important;list-style:none;position:relative;border-bottom:1px solid #F4F6F9;height:auto !important;font-size:14px !important;line-height:22px !important;color:#82949A;\">\r\n			<div class=\"cosA\" style=\"box-sizing:border-box;margin-right:80px;\">\r\n				<span class=\"cosIco label-danger\" style=\"box-sizing:border-box;background-color:#36C6D3;display:inline-block;width:24px;height:24px;vertical-align:middle;color:#FFFFFF;text-align:center;border-radius:3px;\"><span class=\"am-icon-bolt\" style=\"box-sizing:border-box;display:inline-block;\"></span></span>&nbsp;云尚发卡系统免授权使用，切勿上当受骗，系统开源没有任何加密！\r\n			</div>\r\n		</li>\r\n		<li style=\"box-sizing:border-box;margin:0px 0px 7px;padding:10px !important;list-style:none;position:relative;border-bottom:1px solid #F4F6F9;height:auto !important;font-size:14px !important;line-height:22px !important;color:#82949A;\">\r\n			<div class=\"cosA\" style=\"box-sizing:border-box;margin-right:80px;\">\r\n				<span class=\"cosIco label-info\" style=\"box-sizing:border-box;background-color:#36C6D3;display:inline-block;width:24px;height:24px;vertical-align:middle;color:#FFFFFF;text-align:center;border-radius:3px;\"><span class=\"am-icon-bullhorn\" style=\"box-sizing:border-box;display:inline-block;\"></span></span>&nbsp;防止不法分子在源码中加入后门请到云尚官网下载正版程序！\r\n			</div>\r\n		</li>\r\n		<li style=\"box-sizing:border-box;margin:0px 0px 7px;padding:10px !important;list-style:none;position:relative;border-bottom:1px solid #F4F6F9;height:auto !important;font-size:14px !important;line-height:22px !important;color:#82949A;background:#F4F6F9;\">\r\n			<div class=\"cosA\" style=\"box-sizing:border-box;margin-right:80px;\">\r\n				<span class=\"cosIco label-warning\" style=\"box-sizing:border-box;background-color:#36C6D3;display:inline-block;width:24px;height:24px;vertical-align:middle;color:#FFFFFF;text-align:center;border-radius:3px;\"><span class=\"am-icon-plus\" style=\"box-sizing:border-box;display:inline-block;\"></span></span>&nbsp;软件官网：<a href=\"http://www.yunscx.com\" target=\"_blank\">http://www.yunscx.com</a>&nbsp; &nbsp; 交流QQ群 ：<a target=\"_blank\" href=\"//shang.qq.com/wpa/qunwpa?idkey=633fb72ae5064407d2af35f9bc0502629ccd3d9cd5b64ea51a424b1276f0cb9b\"><img border=\"0\" src=\"//pub.idqqimg.com/wpa/images/group.png\" alt=\"云尚软件交流群\" title=\"云尚软件交流群\"></a>\r\n			</div>\r\n		</li>\r\n	</ul>\r\n</h2>', '2017-03-21', '1', '0', '10', 'yunsfk2018', '1', '1');

-- ----------------------------
-- Table structure for ys_gdclass
-- ----------------------------
DROP TABLE IF EXISTS `ys_gdclass`;
CREATE TABLE `ys_gdclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '分类名称',
  `ord` int(100) DEFAULT '0' COMMENT '商品排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_gdclass
-- ----------------------------
INSERT INTO `ys_gdclass` VALUES ('10', '测试分类', '0');

-- ----------------------------
-- Table structure for ys_goods
-- ----------------------------
DROP TABLE IF EXISTS `ys_goods`;
CREATE TABLE `ys_goods` (
  `id` int(100) NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `cid` int(100) NOT NULL COMMENT '分类id',
  `gname` varchar(255) NOT NULL COMMENT '商品名称',
  `gurl` varchar(255) DEFAULT NULL,
  `gmoney` decimal(20,2) NOT NULL COMMENT '普通售价',
  `onemoney` decimal(20,2) DEFAULT NULL,
  `twomoney` decimal(20,2) DEFAULT NULL,
  `smoney` decimal(20,2) DEFAULT NULL,
  `gpasswd` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 自动发卡  1 手工订单',
  `checks` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许重复下单 1是  0否',
  `cont` text COMMENT '商品介绍',
  `onetle` varchar(255) DEFAULT NULL COMMENT '第一个输入框标题',
  `gdipt` varchar(255) DEFAULT NULL COMMENT '更多input qq密码 ,大区名称',
  `ord` int(100) DEFAULT '0' COMMENT '排序',
  `is_ste` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0下架 1上架',
  `kuc` int(100) NOT NULL DEFAULT '0' COMMENT '库存',
  `ss` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ugurl` (`gurl`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_goods
-- ----------------------------
INSERT INTO `ys_goods` VALUES ('23', '10', '测试商品', 'cessp', '4.00', '3.00', '2.00', '1.00', '', '0', '1', '测试测测测测测', 'QQ号', '', '0', '1', '3', null);

-- ----------------------------
-- Table structure for ys_kami
-- ----------------------------
DROP TABLE IF EXISTS `ys_kami`;
CREATE TABLE `ys_kami` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `gid` int(100) NOT NULL COMMENT '商品id',
  `kano` text NOT NULL COMMENT '卡号',
  `is_ste` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:正常 1:已售',
  `ctime` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=226 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_kami
-- ----------------------------
INSERT INTO `ys_kami` VALUES ('223', '23', '123321', '0', '1527598485');
INSERT INTO `ys_kami` VALUES ('224', '23', '123321', '0', '1527598485');
INSERT INTO `ys_kami` VALUES ('225', '23', '123321', '0', '1527598485');

-- ----------------------------
-- Table structure for ys_mailtoken
-- ----------------------------
DROP TABLE IF EXISTS `ys_mailtoken`;
CREATE TABLE `ys_mailtoken` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `ctime` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_mailtoken
-- ----------------------------
INSERT INTO `ys_mailtoken` VALUES ('1', '2', '14a1e909662c6b145fb71ac80e5eec3a318dca6e', '1527327947');
INSERT INTO `ys_mailtoken` VALUES ('2', '2', 'f30be7ae8b0213201d1144886c57b8e6f2db9e84', '1527328056');
INSERT INTO `ys_mailtoken` VALUES ('3', '2', '905c1b65cd15e988912f04f6a660189ef7bf1e6c', '1527328169');

-- ----------------------------
-- Table structure for ys_mailtpl
-- ----------------------------
DROP TABLE IF EXISTS `ys_mailtpl`;
CREATE TABLE `ys_mailtpl` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text,
  `is_state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cname` (`cname`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_mailtpl
-- ----------------------------
INSERT INTO `ys_mailtpl` VALUES ('3', '卡密发送', '您在{sitename}购买的商品已发货', '<p class=\"p1\">\r\n<span class=\"s1\">尊敬的用户您好：</span> \r\n</p>\r\n<p class=\"p1\">\r\n<span class=\"s1\">您在：【{sitename}】 购买的商品：{gname} 已发货。</span> \r\n</p>\r\n<p class=\"p1\">订单号：{orid}</p>\r\n<p class=\"p1\">数量：{ornum}</p>\r\n<p class=\"p1\">金额：{cmoney}</p>\r\n<p class=\"p1\">时间：{ctime}</p>\r\n---------------------------------------------------------------------------------------------------------------------------<br/>\r\n<p class=\"p1\"> \r\n<span class=\"s1\">{orderinfo}</span>\r\n</p> \r\n---------------------------------------------------------------------------------------------------------------------------<br/>\r\n\r\n感谢您的惠顾，祝您生活愉快！<br/>\r\n<p class=\"p1\">\r\n	<span class=\"s1\">来自 <span style=\"white-space:normal;\">{sitename} -{siteurl}</span></span> \r\n</p>', '0', '1523789794');
INSERT INTO `ys_mailtpl` VALUES ('5', '管理员通知', '【{sitename}】新订单等待处理', '<p class=\"p1\">尊敬的管理员：</p>\r\n\r\n<p class=\"p1\">客户购买的商品：【{gname}】 已支付成功，请及时处理。</p>\r\n------------------------------------------<br/>\r\n<p class=\"p1\">订单号：{orid}</p>\r\n<p class=\"p1\">数量：{ornum}</p>\r\n<p class=\"p1\">金额：{cmoney}</p>\r\n<p class=\"p1\">时间：{ctime}</p>\r\n---------------------------------------------<br/>\r\n\r\n<p class=\"p1\">\r\n	<span class=\"s1\">来自 <span style=\"white-space:normal;\">{sitename} -{siteurl}</span></span> \r\n</p>', '0', '1523790269');
INSERT INTO `ys_mailtpl` VALUES ('6', '库存告警', '【{sitename}】库存告警', '<p class=\"p1\">尊敬的管理员：</p>\r\n\r\n<p class=\"p1\">平台商品：【{gname}】库存低于{ornum}，请及时补货。</p>\r\n\r\n<p class=\"p1\">\r\n	<span class=\"s1\">来自 <span style=\"white-space:normal;\">{sitename} -{siteurl}</span></span> \r\n</p>', '0', '1526475356');
INSERT INTO `ys_mailtpl` VALUES ('7', '找回密码', '【{sitename}】找回密码', '<p class=\"p1\">\r\n<span class=\"s1\">尊敬的用户您好：</span> \r\n</p>\r\n<p class=\"p1\">\r\n<span class=\"s1\">以下是您找回密码的验证链接，请勿告知他人！链接有效期为2小时！</span> \r\n</p>\r\n---------------------------------------------------------------------------------------------------------------------------<br/>\r\n\r\n<a href=\"{siteurl}/reg/repwd?token={token}\">{siteurl}/reg/repwd?token={token}</a><br/>\r\n\r\n---------------------------------------------------------------------------------------------------------------------------<br/>\r\n\r\n感谢您的惠顾，祝您生活愉快！<br/>\r\n<p class=\"p1\">\r\n	<span class=\"s1\">来自 <span style=\"white-space:normal;\">{sitename} -{siteurl}</span></span> \r\n</p>', '0', '1527327193');

-- ----------------------------
-- Table structure for ys_navcog
-- ----------------------------
DROP TABLE IF EXISTS `ys_navcog`;
CREATE TABLE `ys_navcog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_navcog
-- ----------------------------
INSERT INTO `ys_navcog` VALUES ('16', '{\"set\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"admins\":\"\\u7ba1\\u7406\\u5458\\u5217\\u8868\",\"orders\":\"\\u8ba2\\u5355\\u5217\\u8868\"}');

-- ----------------------------
-- Table structure for ys_orders
-- ----------------------------
DROP TABLE IF EXISTS `ys_orders`;
CREATE TABLE `ys_orders` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(200) NOT NULL COMMENT '订单id',
  `uid` int(200) DEFAULT NULL,
  `uname` varchar(200) DEFAULT NULL COMMENT '用户',
  `oname` varchar(255) NOT NULL COMMENT '订单名称',
  `gid` int(100) NOT NULL COMMENT '商品id',
  `omoney` decimal(60,2) NOT NULL DEFAULT '0.00' COMMENT '商品单价',
  `cmoney` decimal(60,2) NOT NULL COMMENT '订单总价',
  `onum` int(100) NOT NULL COMMENT '订单数量',
  `chapwd` varchar(255) DEFAULT NULL COMMENT '查询密码',
  `account` varchar(255) NOT NULL COMMENT '充值账号',
  `otype` tinyint(1) NOT NULL COMMENT '订单类型 0自动发卡 1手工充值',
  `info` text COMMENT '充值详情',
  `payid` varchar(200) DEFAULT NULL COMMENT '第三方支付平台id',
  `paytype` varchar(255) DEFAULT NULL COMMENT '支付方式',
  `ctime` int(100) NOT NULL COMMENT '下单日期',
  `status` tinyint(1) NOT NULL COMMENT '0待付款 1待处理 2已处理 3已完成  4处理失败 5发卡失败',
  PRIMARY KEY (`id`,`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=799 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_orders
-- ----------------------------
INSERT INTO `ys_orders` VALUES ('1', '123321', '2', '测试', '测试', '21', '10.00', '0.00', '0', '123', '123321', '0', '123321123321', null, null, '0', '2');

-- ----------------------------
-- Table structure for ys_ulevel
-- ----------------------------
DROP TABLE IF EXISTS `ys_ulevel`;
CREATE TABLE `ys_ulevel` (
  `id` int(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_ulevel
-- ----------------------------
INSERT INTO `ys_ulevel` VALUES ('1', '屌丝');
INSERT INTO `ys_ulevel` VALUES ('2', '大神');
INSERT INTO `ys_ulevel` VALUES ('3', '老板');

-- ----------------------------
-- Table structure for ys_user
-- ----------------------------
DROP TABLE IF EXISTS `ys_user`;
CREATE TABLE `ys_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `lid` int(10) NOT NULL COMMENT '代理级别',
  `uname` varchar(255) NOT NULL COMMENT '用户名',
  `upasswd` varchar(255) NOT NULL,
  `is_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `ctmoney` decimal(65,2) DEFAULT '0.00' COMMENT '累计消费',
  `logip` varchar(255) DEFAULT NULL,
  `logtime` varchar(100) DEFAULT NULL,
  `uemail` varchar(100) DEFAULT NULL,
  `ckmail` tinyint(1) DEFAULT '1',
  `ctime` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`uname`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_user
-- ----------------------------
INSERT INTO `ys_user` VALUES ('1', '1', 'test1', 'a3272723efd5acc96681ad90674ef1a540b7dc5a', '0', '0.00', '11', null, 'a1dsa@qq.com', '1', null);
INSERT INTO `ys_user` VALUES ('2', '3', 'ashang', '4d9012b4a77a9524d675dad27c3276ab5705e5e8', '1', '1.00', '127.0.0.1', '1527866892', 'ashang@utf8.hk', '1', null);
INSERT INTO `ys_user` VALUES ('3', '1', 'admin', '4d9012b4a77a9524d675dad27c3276ab5705e5e8', '1', '0.00', null, null, 'ashang1@utf8.hk', '1', null);
INSERT INTO `ys_user` VALUES ('4', '1', 'admin1', '4d9012b4a77a9524d675dad27c3276ab5705e5e8', '1', '0.00', null, null, 'ashang11@utf8.hk', '1', null);
INSERT INTO `ys_user` VALUES ('5', '1', 'test', '4d9012b4a77a9524d675dad27c3276ab5705e5e8', '1', '0.00', '127.0.0.1', '1527321829', 'test@qq.com', '1', '1527321801');
