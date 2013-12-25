/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : ctplatform

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-12-25 17:45:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pf_access`
-- ----------------------------
DROP TABLE IF EXISTS `pf_access`;
CREATE TABLE `pf_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_access
-- ----------------------------
INSERT INTO `pf_access` VALUES ('1', '3', '1', null);
INSERT INTO `pf_access` VALUES ('1', '5', '2', null);
INSERT INTO `pf_access` VALUES ('1', '4', '2', null);
INSERT INTO `pf_access` VALUES ('1', '6', '2', null);
INSERT INTO `pf_access` VALUES ('2', '3', '1', null);
INSERT INTO `pf_access` VALUES ('2', '9', '2', null);
INSERT INTO `pf_access` VALUES ('2', '10', '2', null);
INSERT INTO `pf_access` VALUES ('2', '11', '2', null);
INSERT INTO `pf_access` VALUES ('3', '3', '1', null);
INSERT INTO `pf_access` VALUES ('3', '7', '2', null);
INSERT INTO `pf_access` VALUES ('3', '8', '2', null);
INSERT INTO `pf_access` VALUES ('1', '12', '2', null);
INSERT INTO `pf_access` VALUES ('2', '12', '2', null);
INSERT INTO `pf_access` VALUES ('3', '12', '2', null);
INSERT INTO `pf_access` VALUES ('1', '13', '3', null);
INSERT INTO `pf_access` VALUES ('1', '14', '3', null);
INSERT INTO `pf_access` VALUES ('2', '14', '3', null);
INSERT INTO `pf_access` VALUES ('2', '13', '3', null);
INSERT INTO `pf_access` VALUES ('3', '13', '3', null);
INSERT INTO `pf_access` VALUES ('3', '14', '3', null);

-- ----------------------------
-- Table structure for `pf_member`
-- ----------------------------
DROP TABLE IF EXISTS `pf_member`;
CREATE TABLE `pf_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL COMMENT '用户名',
  `nickname` varchar(50) NOT NULL COMMENT '真实姓名',
  `password` char(32) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类别 1-人大代表 2-政协委员',
  `paper_number` varchar(255) NOT NULL COMMENT '委员证号',
  `photo` varchar(255) DEFAULT NULL COMMENT '头像URL',
  `company` varchar(255) NOT NULL COMMENT '工作单位',
  `mobile` varchar(11) NOT NULL COMMENT '手机',
  `email` varchar(255) DEFAULT NULL,
  `last_login_time` varchar(20) DEFAULT '0' COMMENT 'unix时间戳',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐  0-不推荐  1-推荐',
  `status` tinyint(1) NOT NULL COMMENT '0-删除  1-已审核  2-待审核',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_member
-- ----------------------------
INSERT INTO `pf_member` VALUES ('1', 'test', '测试', '15c9dfa38cfaf2635d54b1f94ffaed6c', '1', '123456', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', '123456', '15236660754', null, '1387524530', '127.0.0.1', '0', null, '1387524530', '1387524530', '1', '1');
INSERT INTO `pf_member` VALUES ('2', 'test2', 'test2', 'b67508a1f2983c7365b37946a59ad5b1', '1', 'test2', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'test2', '15236660754', null, '1387524634', '127.0.0.1', '0', null, '1387524634', '1387524634', '1', '1');
INSERT INTO `pf_member` VALUES ('3', 'test3', 'test3', '5f85eb5b813593a29037e93fedc5af34', '1', 'test3', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'test3', '15236660754', null, '1387525844', '127.0.0.1', '0', null, '1387525844', '1387525844', '1', '1');
INSERT INTO `pf_member` VALUES ('4', 'test4', 'test4', 'e5fc178b0bc754b47e09f19c3f5eef7e', '1', 'test4', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'test4', '15236660754', null, '1387525888', '127.0.0.1', '0', null, '1387525888', '1387525888', '1', '1');
INSERT INTO `pf_member` VALUES ('5', 'test5', 'test5', '7a957cf67b7ce665286ab651f36f86a0', '1', 'test5', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'test5', '15236660754', null, '1387526308', '127.0.0.1', '0', null, '1387526308', '1387526308', '1', '1');
INSERT INTO `pf_member` VALUES ('6', 'a1111', '11111', 'b4b3aced3193c18c653bdeff2dd5c141', '1', '11111', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', '11111', '11111111111', null, '1387961398', '127.0.0.1', '3', null, '1387616424', '1387616424', '1', '1');
INSERT INTO `pf_member` VALUES ('7', 'ceshi1', 'ceshi1', '22210798bc8f23ce100a7fe0a778dd9d', '2', 'ceshi1', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'ceshi1', '15236660754', null, '1387898786', '127.0.0.1', '2', 'ceshi1', '1387809403', '1387809403', '1', '1');
INSERT INTO `pf_member` VALUES ('8', 'a11111', 'aaa', 'b4b3aced3193c18c653bdeff2dd5c141', '2', '131555', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'aaaaa', '15194544953', null, '1387848744', '127.0.0.1', '0', 'aaaaaaaaaaaaaa', '1387848744', '1387848744', '1', '1');
INSERT INTO `pf_member` VALUES ('9', 'a111111', 'aaa', 'b4b3aced3193c18c653bdeff2dd5c141', '2', '131555', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'aaaaa', '15194544953', null, '1387848776', '127.0.0.1', '0', 'aaaaaaaaaaaaaa', '1387848776', '1387848776', '1', '1');
INSERT INTO `pf_member` VALUES ('10', 'a2222', 'aaa', 'd0a61972692ff53c844fbdd3d44c7a33', '2', '131555', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'aaaaa', '15194544953', null, '1387956799', '127.0.0.1', '0', 'aaaaaaaaaaaaaa', '1387848859', '1387956799', '1', '1');
INSERT INTO `pf_member` VALUES ('11', 'aaaa', 'aaaa', 'b4b3aced3193c18c653bdeff2dd5c141', '2', 'aaa', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'aaa', '15194544953', null, '1387936855', '127.0.0.1', '1', '', '1387849763', '1387849763', '1', '1');
INSERT INTO `pf_member` VALUES ('12', 'bbbb', 'bbbbb', 'b4b3aced3193c18c653bdeff2dd5c141', '2', 'bbbbb', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'bbbbb', '15194544953', null, '1387849932', '127.0.0.1', '0', '', '1387849932', '1387849932', '1', '1');
INSERT INTO `pf_member` VALUES ('13', 'bbbbbb', 'bbbbbbb', 'b4b3aced3193c18c653bdeff2dd5c141', '2', 'bbbbbb', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', 'bbbbb', '15194544953', null, '1387850302', '127.0.0.1', '0', '', '1387850302', '1387850302', '1', '1');
INSERT INTO `pf_member` VALUES ('14', 'zhangmeiling', '张美玲', 'b4b3aced3193c18c653bdeff2dd5c141', '2', '123456', '/Public/Uploads/Member/14/52b8fccc925f8.jpg', '测试', '15194544953', null, '1387956726', '127.0.0.1', '3', '', '1387855052', '1387956726', '1', '1');
INSERT INTO `pf_member` VALUES ('15', 'a7895', '测试', 'ff67e820ddd404fb081aa718b7a73211', '2', '546555', '/Public/Uploads/Member/15/52b8ffae07e23.jpg', '测试', '15194544953', null, '1387855790', '127.0.0.1', '0', '11111', '1387855790', '1387855790', '1', '0');
INSERT INTO `pf_member` VALUES ('16', 'a1111a', 'aaaa', 'bc591d797604e1e36a00cfcb1dc7a79e', '1', '1513151', null, '11111', '15194544953', null, '1387876266', '127.0.0.1', '1', null, '1387875903', '1387875903', '1', '0');

-- ----------------------------
-- Table structure for `pf_news`
-- ----------------------------
DROP TABLE IF EXISTS `pf_news`;
CREATE TABLE `pf_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ctg_id` int(10) unsigned NOT NULL COMMENT '所属分类ID',
  `title` varchar(255) NOT NULL COMMENT '新闻标题',
  `content` text COMMENT '新闻内容',
  `editor` varchar(255) DEFAULT NULL COMMENT '信息编辑人',
  `picture` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `is_pic` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否图片 0-否 1-是',
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐 0-不推荐 1-推荐',
  `is_display` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-不显示 1-显示',
  `create_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '发布时间 unix时间戳',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间 unix时间戳',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-删除 1-正常',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_news
-- ----------------------------
INSERT INTO `pf_news` VALUES ('1', '1', '1111', '1111', '超级管理员', null, '0', '0', '0', '0', '0', '0');
INSERT INTO `pf_news` VALUES ('2', '2', '4444', '4444444', '超级管理员', null, '0', '0', '0', '0', '0', '0');
INSERT INTO `pf_news` VALUES ('3', '1', '555', '5555', '超级管理员', null, '1', '1', '0', '0', '0', '0');
INSERT INTO `pf_news` VALUES ('4', '1', '66666', '66666', '超级管理员', '/Public/Uploads/News/4/52ba576d8bc91.jpg', '1', '1', '1', '0', '1387943789', '1');
INSERT INTO `pf_news` VALUES ('5', '2', '345345', '463443453543', '4345634', null, '0', '1', '0', '0', '0', '1');
INSERT INTO `pf_news` VALUES ('6', '1', '1111', '111111111', '超级管理员', null, '0', '0', '0', '0', '0', '1');
INSERT INTO `pf_news` VALUES ('7', '1', '11111111111', '1111111111111111111111111111111', '11111', null, '0', '0', '0', '0', '0', '1');
INSERT INTO `pf_news` VALUES ('8', '1', '11111111111', '1111111111111111111111111111111', '11111', null, '0', '0', '0', '0', '0', '1');
INSERT INTO `pf_news` VALUES ('9', '1', '11111111111', '1111111111111111111111111111111', '11111', null, '0', '0', '0', '0', '0', '1');
INSERT INTO `pf_news` VALUES ('10', '1', '11111111111', '1111111111111111111111111111111', '超级管理员', null, '0', '0', '0', '0', '0', '1');
INSERT INTO `pf_news` VALUES ('11', '2', '11111111111', '1111111111111111111111111111111', '超级管理员', null, '0', '0', '0', '0', '0', '0');
INSERT INTO `pf_news` VALUES ('12', '2', '11111111111', '1111111111111111111111111111111', '超级管理员', null, '0', '0', '0', '0', '0', '1');
INSERT INTO `pf_news` VALUES ('13', '2', '11111111111', '1111111111111111111111111111111', '超级管理员', null, '0', '0', '0', '0', '0', '1');
INSERT INTO `pf_news` VALUES ('14', '2', '11111111111', '1111111111111111111111111111111', '超级管理员', null, '0', '0', '0', '0', '0', '0');
INSERT INTO `pf_news` VALUES ('15', '2', '11111111111', '1111111111111111111111111111111', '超级管理员', null, '0', '0', '0', '0', '0', '0');
INSERT INTO `pf_news` VALUES ('16', '1', '444', '444444', '超级管理员', null, '0', '0', '0', '1387768476', '1387768476', '0');
INSERT INTO `pf_news` VALUES ('17', '1', '1111111', '11111111111', '11111111', null, '0', '0', '0', '1387768541', '1387768541', '0');
INSERT INTO `pf_news` VALUES ('18', '1', '11111111111111', '1111111111111111111', '1111111111', null, '0', '0', '0', '1387768602', '1387768602', '1');
INSERT INTO `pf_news` VALUES ('19', '1', '55555', '55555555', '超级管理员', null, '0', '1', '1', '1387769032', '1387769032', '1');
INSERT INTO `pf_news` VALUES ('20', '1', '123131', '651456123', '超级管理员', null, '0', '0', '0', '1387769157', '1387769157', '1');
INSERT INTO `pf_news` VALUES ('21', '1', '22222222222', '22222222222222222', '超级管理员', null, '0', '1', '1', '1387769863', '1387769863', '1');
INSERT INTO `pf_news` VALUES ('22', '1', '666666', '6666666666666', '超级管理员', null, '0', '0', '1', '1387770070', '1387770070', '1');
INSERT INTO `pf_news` VALUES ('23', '3', '44444', '444444444444444444444444444444444444444444', '4444', null, '0', '0', '1', '1387858184', '1387858184', '0');
INSERT INTO `pf_news` VALUES ('24', '4', '5555555555', '555555555555555555555555', '55555', null, '0', '0', '1', '1387858198', '1387858198', '1');
INSERT INTO `pf_news` VALUES ('25', '1', 'dsfsdfsfdsdfsd', 'xxcvvsvsdvsdvgsdgvsdgggggggggggggggggggggg', 'sdsfsdf', null, '0', '1', '1', '1387936666', '1387936666', '1');
INSERT INTO `pf_news` VALUES ('26', '1', 'cecece', '<p>\r\n	cecece\r\n</p>\r\n<p>\r\n	cecece\r\n</p>\r\n<p>\r\n	cecece\r\n</p>\r\n<p>\r\n	cecece\r\n</p>\r\n<p>\r\n	cecece\r\n</p>', 'cecece', '/Public/Uploads/News/26/52ba47c0e2102.jpg', '1', '0', '1', '1387939776', '1387939776', '1');
INSERT INTO `pf_news` VALUES ('27', '2', 'cececesss', '<p>\r\n	cececesss\r\n</p>\r\n<p>\r\n	cececesss\r\n</p>', 'cececesss', null, '0', '1', '1', '1387939857', '1387939857', '1');
INSERT INTO `pf_news` VALUES ('28', '2', 'cececesss', '<p>\r\n	cececesss\r\n</p>\r\n<p>\r\n	cececesss\r\n</p>', 'cececesss', null, '0', '1', '1', '1387939927', '1387939927', '1');
INSERT INTO `pf_news` VALUES ('29', '2', 'cececesss', '<p>\r\n	cececesss\r\n</p>\r\n<p>\r\n	cececesss\r\n</p>', 'cececesss', null, '0', '1', '1', '1387939956', '1387939956', '1');
INSERT INTO `pf_news` VALUES ('30', '2', 'cececesss', '<p>\r\n	cececesss\r\n</p>\r\n<p>\r\n	cececesss\r\n</p>', 'cececesss', null, '0', '1', '1', '1387940014', '1387940014', '1');
INSERT INTO `pf_news` VALUES ('31', '1', 'cececesss', '<p>\r\n	cececesss\r\n</p>\r\n<p>\r\n	cececesss\r\n</p>\r\n<p>\r\n	cececessscececessscececesss\r\n</p>\r\n<p>\r\n	cececesss\r\n</p>', 'cececesss', null, '0', '0', '0', '1387940384', '1387940384', '1');
INSERT INTO `pf_news` VALUES ('32', '3', 'cececesss', '<p>\r\n	cececesss\r\n</p>\r\n<p>\r\n	cececesss\r\n</p>\r\n<p>\r\n	cececessscececesss\r\n</p>', 'cececesss', null, '0', '0', '1', '1387940432', '1387940432', '1');

-- ----------------------------
-- Table structure for `pf_news_category`
-- ----------------------------
DROP TABLE IF EXISTS `pf_news_category`;
CREATE TABLE `pf_news_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属分类ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '栏目类型 1-列表 2-单页',
  `rank` smallint(6) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_display` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示 0-不显示 1-显示',
  `is_index` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否首页显示 0-不显示 1-显示',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-删除 1-正常',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_news_category
-- ----------------------------
INSERT INTO `pf_news_category` VALUES ('1', '0', '代表委员之声', '1', '100', '1', '1', '1');
INSERT INTO `pf_news_category` VALUES ('2', '0', '检查工作动态', '1', '200', '1', '1', '1');
INSERT INTO `pf_news_category` VALUES ('3', '0', '热点案件追踪', '1', '300', '1', '1', '1');
INSERT INTO `pf_news_category` VALUES ('4', '0', '重要工作部署', '1', '400', '1', '1', '1');
INSERT INTO `pf_news_category` VALUES ('5', '0', '建议提案办理情况', '2', '500', '1', '1', '1');
INSERT INTO `pf_news_category` VALUES ('6', '1', 'test', '1', '100', '1', '0', '1');

-- ----------------------------
-- Table structure for `pf_news_comment`
-- ----------------------------
DROP TABLE IF EXISTS `pf_news_comment`;
CREATE TABLE `pf_news_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(10) unsigned NOT NULL COMMENT '所属新闻ID',
  `member_id` int(10) unsigned NOT NULL COMMENT '评论用户ID',
  `title` varchar(255) NOT NULL COMMENT '评论标题',
  `content` text COMMENT '评论内容',
  `create_time` varchar(255) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-删除 1-已审核 2-未审核',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_news_comment
-- ----------------------------
INSERT INTO `pf_news_comment` VALUES ('1', '1', '1', '', '111', '1387935864', '1');
INSERT INTO `pf_news_comment` VALUES ('2', '1', '2', '', null, '1387936809', '1');
INSERT INTO `pf_news_comment` VALUES ('3', '1', '1', '', null, '1387936821', '0');
INSERT INTO `pf_news_comment` VALUES ('4', '2', '1', '', null, '1387950743', '1');
INSERT INTO `pf_news_comment` VALUES ('5', '2', '1', '', null, '1387950761', '0');
INSERT INTO `pf_news_comment` VALUES ('6', '12', '6', '', null, '0', '1');
INSERT INTO `pf_news_comment` VALUES ('7', '24', '6', '', null, '0', '1');
INSERT INTO `pf_news_comment` VALUES ('8', '29', '6', '', null, '1387960943', '2');
INSERT INTO `pf_news_comment` VALUES ('9', '24', '6', '', '11111', '1387961082', '2');
INSERT INTO `pf_news_comment` VALUES ('10', '32', '6', '', '11111', '1387961412', '2');
INSERT INTO `pf_news_comment` VALUES ('11', '24', '6', '', '1111', '1387961867', '2');
INSERT INTO `pf_news_comment` VALUES ('12', '24', '6', '', '111', '1387963229', '2');
INSERT INTO `pf_news_comment` VALUES ('13', '24', '6', '', '111111111', '1387963866', '2');
INSERT INTO `pf_news_comment` VALUES ('14', '24', '6', '', '111111111111111111111', '1387963871', '2');

-- ----------------------------
-- Table structure for `pf_node`
-- ----------------------------
DROP TABLE IF EXISTS `pf_node`;
CREATE TABLE `pf_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_node
-- ----------------------------
INSERT INTO `pf_node` VALUES ('4', 'Member', '会员模块', '1', null, null, '3', '1');
INSERT INTO `pf_node` VALUES ('3', 'Admin', '管理员', '1', null, null, '1', '1');
INSERT INTO `pf_node` VALUES ('5', 'User', '管理员模块', '1', null, null, '3', '1');
INSERT INTO `pf_node` VALUES ('6', 'Setting', '网站设置模块', '1', null, null, '3', '2');
INSERT INTO `pf_node` VALUES ('7', 'Suggest', '建议模块', '1', null, null, '3', '2');
INSERT INTO `pf_node` VALUES ('8', 'Sugreply', '建议回复模块', '1', null, null, '3', '2');
INSERT INTO `pf_node` VALUES ('9', 'News', '新闻模块', '1', null, null, '3', '2');
INSERT INTO `pf_node` VALUES ('10', 'NewsCategory', '新闻分类模块', '1', null, null, '3', '2');
INSERT INTO `pf_node` VALUES ('11', 'NewsComment', '新闻评论模块', '1', null, null, '3', '2');
INSERT INTO `pf_node` VALUES ('12', 'Index', '管理首页模块', '1', null, null, '3', '2');
INSERT INTO `pf_node` VALUES ('13', 'index', '管理首页', '1', null, null, '12', '3');
INSERT INTO `pf_node` VALUES ('14', 'info', '管理首页信息展示', '1', null, null, '12', '3');

-- ----------------------------
-- Table structure for `pf_role`
-- ----------------------------
DROP TABLE IF EXISTS `pf_role`;
CREATE TABLE `pf_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_role
-- ----------------------------
INSERT INTO `pf_role` VALUES ('1', '系统管理', '0', '1', null);
INSERT INTO `pf_role` VALUES ('2', '信息管理', '0', '1', null);
INSERT INTO `pf_role` VALUES ('3', '建议管理', '0', '1', null);

-- ----------------------------
-- Table structure for `pf_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `pf_role_user`;
CREATE TABLE `pf_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_role_user
-- ----------------------------
INSERT INTO `pf_role_user` VALUES ('1', '2');
INSERT INTO `pf_role_user` VALUES ('2', '2');
INSERT INTO `pf_role_user` VALUES ('1', '3');
INSERT INTO `pf_role_user` VALUES ('3', '3');
INSERT INTO `pf_role_user` VALUES ('3', '4');
INSERT INTO `pf_role_user` VALUES ('1', '14');
INSERT INTO `pf_role_user` VALUES ('2', '14');
INSERT INTO `pf_role_user` VALUES ('3', '14');
INSERT INTO `pf_role_user` VALUES ('1', '15');
INSERT INTO `pf_role_user` VALUES ('2', '15');
INSERT INTO `pf_role_user` VALUES ('2', '16');
INSERT INTO `pf_role_user` VALUES ('1', '17');
INSERT INTO `pf_role_user` VALUES ('2', '17');
INSERT INTO `pf_role_user` VALUES ('3', '17');
INSERT INTO `pf_role_user` VALUES ('3', '18');

-- ----------------------------
-- Table structure for `pf_setting`
-- ----------------------------
DROP TABLE IF EXISTS `pf_setting`;
CREATE TABLE `pf_setting` (
  `set_name` varchar(255) NOT NULL,
  `set_value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_setting
-- ----------------------------
INSERT INTO `pf_setting` VALUES ('web_name', '洛阳市老城区人民检察院');
INSERT INTO `pf_setting` VALUES ('copyright', '版权所有：洛阳市老城区人民检察院　技术支持：万谦科技');

-- ----------------------------
-- Table structure for `pf_suggest`
-- ----------------------------
DROP TABLE IF EXISTS `pf_suggest`;
CREATE TABLE `pf_suggest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL COMMENT '提交建议的用户ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '处理建议的管理员ID',
  `title` varchar(255) NOT NULL COMMENT '建议标题',
  `reply_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '希望回复方式  1-短信 2-邮件 3-电话 4-信函',
  `content` text COMMENT '信息内容',
  `remark` varchar(255) DEFAULT NULL COMMENT '其他说明',
  `create_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '建议提交时间 unix时间戳',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '信息状态 0-删除 1-已处理 2-待处理',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_suggest
-- ----------------------------
INSERT INTO `pf_suggest` VALUES ('1', '1', '1', 'biaoti', '0', 'neirong', null, '0', '1');
INSERT INTO `pf_suggest` VALUES ('2', '1', '1', 'ceshi', '0', 'neirong2', null, '0', '1');
INSERT INTO `pf_suggest` VALUES ('3', '6', '0', '1111', '1', '11111', '1111', '1387963254', '2');
INSERT INTO `pf_suggest` VALUES ('4', '6', '0', '2222222', '1', '22222222222', '22222222', '1387963453', '2');
INSERT INTO `pf_suggest` VALUES ('5', '6', '0', '222222222', '1', '22222222222\r\n\r\n', '111', '1387963470', '2');
INSERT INTO `pf_suggest` VALUES ('6', '6', '0', '444', '1', '4444', '444', '1387963595', '2');
INSERT INTO `pf_suggest` VALUES ('7', '6', '0', '1111', '1', '11111111', '1111111', '1387963837', '2');
INSERT INTO `pf_suggest` VALUES ('8', '6', '0', '111', '1', '1111', '111', '1387964493', '2');

-- ----------------------------
-- Table structure for `pf_sugreply`
-- ----------------------------
DROP TABLE IF EXISTS `pf_sugreply`;
CREATE TABLE `pf_sugreply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sug_id` int(10) unsigned NOT NULL COMMENT '所属建议ID',
  `user_id` int(10) unsigned NOT NULL COMMENT '回复人ID',
  `reply_time` varchar(255) NOT NULL DEFAULT '0' COMMENT '回复时间',
  `reply_content` varchar(255) DEFAULT NULL COMMENT '回复内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-删除 1-正常',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_sugreply
-- ----------------------------
INSERT INTO `pf_sugreply` VALUES ('1', '0', '1', '1387770784', null, '1');
INSERT INTO `pf_sugreply` VALUES ('2', '1', '1', '1387771136', null, '1');
INSERT INTO `pf_sugreply` VALUES ('3', '1', '1', '1387771165', '阿斯顿', '1');
INSERT INTO `pf_sugreply` VALUES ('4', '1', '1', '1387780069', '1111', '1');

-- ----------------------------
-- Table structure for `pf_user`
-- ----------------------------
DROP TABLE IF EXISTS `pf_user`;
CREATE TABLE `pf_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL COMMENT '帐号',
  `password` char(32) NOT NULL COMMENT '密码',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称,姓名',
  `last_login_time` varchar(20) DEFAULT '0' COMMENT 'unix时间戳',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(9) unsigned DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `create_time` varchar(20) DEFAULT '0' COMMENT 'unix时间戳',
  `update_time` varchar(20) DEFAULT '0' COMMENT 'unix时间戳',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-删除 1-正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_user
-- ----------------------------
INSERT INTO `pf_user` VALUES ('1', 'admin', '3d06188d51e8024d76f1013b1563afcf', '超级管理员', '1387963290', '127.0.0.1', '50', null, '0', '0', '1');
INSERT INTO `pf_user` VALUES ('2', 'user2', '3d06188d51e8024d76f1013b1563afcf', '2号', '1387789254', '127.0.0.1', '2', null, '0', '0', '1');
INSERT INTO `pf_user` VALUES ('3', 'user3', '3d06188d51e8024d76f1013b1563afcf', '3号', '0', null, '0', null, '0', '0', '1');
INSERT INTO `pf_user` VALUES ('4', 'user4', '3d06188d51e8024d76f1013b1563afcf', '4号', '0', null, '0', null, '0', '0', '1');
INSERT INTO `pf_user` VALUES ('7', 'user7', 'b4b3aced3193c18c653bdeff2dd5c141', null, 'time', '127.0.0.1', '0', null, '1387876702', '1387876702', '1');
INSERT INTO `pf_user` VALUES ('8', 'user5', 'b4b3aced3193c18c653bdeff2dd5c141', null, 'time', '127.0.0.1', '0', null, '1387876751', '1387876751', '1');
INSERT INTO `pf_user` VALUES ('9', 'user6', 'b4b3aced3193c18c653bdeff2dd5c141', null, '1387876879', '127.0.0.1', '0', null, '1387876879', '1387876879', '1');
INSERT INTO `pf_user` VALUES ('10', 'user8', '564736165e3715871289f3132886a6bd', null, '1387877657', '127.0.0.1', '0', null, '1387877657', '1387940353', '1');
INSERT INTO `pf_user` VALUES ('15', 'user9', '564736165e3715871289f3132886a6bd', null, '0', '127.0.0.1', '0', null, '1387940319', '1387940375', '1');
INSERT INTO `pf_user` VALUES ('16', 'user10', 'b4b3aced3193c18c653bdeff2dd5c141', null, '0', '127.0.0.1', '0', null, '1387949776', '1387949776', '1');
INSERT INTO `pf_user` VALUES ('17', 'user11', 'b4b3aced3193c18c653bdeff2dd5c141', null, '0', '127.0.0.1', '0', null, '1387949797', '1387949797', '1');
INSERT INTO `pf_user` VALUES ('18', 'user12', '15c9dfa38cfaf2635d54b1f94ffaed6c', null, '1387960313', '127.0.0.1', '11', null, '1387949909', '1387949909', '0');
