/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : ctplatform

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2013-12-23 00:45:05
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
  `status` tinyint(1) NOT NULL COMMENT '0-删除  1-已审核  2-待审核',
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐  0-不推荐  1-推荐',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_member
-- ----------------------------
INSERT INTO `pf_member` VALUES ('1', 'test', '测试', '15c9dfa38cfaf2635d54b1f94ffaed6c', '1', '123456', null, '123456', '15236660754', null, '1387524530', '127.0.0.1', '0', null, '1387524530', '1387524530', '2', '0');
INSERT INTO `pf_member` VALUES ('2', 'test2', 'test2', 'b67508a1f2983c7365b37946a59ad5b1', '1', 'test2', null, 'test2', '15236660754', null, '1387524634', '127.0.0.1', '0', null, '1387524634', '1387524634', '2', '0');
INSERT INTO `pf_member` VALUES ('3', 'test3', 'test3', '5f85eb5b813593a29037e93fedc5af34', '1', 'test3', null, 'test3', '15236660754', null, '1387525844', '127.0.0.1', '0', null, '1387525844', '1387525844', '2', '0');
INSERT INTO `pf_member` VALUES ('4', 'test4', 'test4', 'e5fc178b0bc754b47e09f19c3f5eef7e', '1', 'test4', null, 'test4', '15236660754', null, '1387525888', '127.0.0.1', '0', null, '1387525888', '1387525888', '2', '0');
INSERT INTO `pf_member` VALUES ('5', 'test5', 'test5', '7a957cf67b7ce665286ab651f36f86a0', '1', 'test5', null, 'test5', '15236660754', null, '1387526308', '127.0.0.1', '0', null, '1387526308', '1387526308', '2', '0');
INSERT INTO `pf_member` VALUES ('6', 'a1111', '11111', 'b4b3aced3193c18c653bdeff2dd5c141', '1', '11111', null, '11111', '11111111111', null, '1387616424', '127.0.0.1', '0', null, '1387616424', '1387616424', '1', '0');

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
  `update_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '更新时间 unix时间戳',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-删除 1-正常',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_news
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_news_category
-- ----------------------------
INSERT INTO `pf_news_category` VALUES ('1', '0', 'hhhhh', '1', '100', '0', '0', '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_news_comment
-- ----------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_node
-- ----------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_role
-- ----------------------------

-- ----------------------------
-- Table structure for `pf_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `pf_role_user`;
CREATE TABLE `pf_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_role_user
-- ----------------------------

-- ----------------------------
-- Table structure for `pf_suggest`
-- ----------------------------
DROP TABLE IF EXISTS `pf_suggest`;
CREATE TABLE `pf_suggest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL COMMENT '提交建议的用户ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '处理建议的管理员ID',
  `title` varchar(255) NOT NULL COMMENT '建议标题',
  `reply_type` varchar(255) NOT NULL COMMENT '希望回复方式  1-短信 2-邮件 3-电话 4-信函',
  `content` text COMMENT '信息内容',
  `remark` varchar(255) DEFAULT NULL COMMENT '其他说明',
  `create_time` varchar(20) NOT NULL DEFAULT '0' COMMENT '建议提交时间 unix时间戳',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '信息状态 0-删除 1-已处理 2-待处理',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_suggest
-- ----------------------------
INSERT INTO `pf_suggest` VALUES ('1', '1', '1', 'biaoti', '', 'neirong', null, '0', '1');
INSERT INTO `pf_suggest` VALUES ('2', '1', '1', 'ceshi', '', 'neirong2', null, '0', '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_sugreply
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_user
-- ----------------------------
INSERT INTO `pf_user` VALUES ('1', 'admin', '3d06188d51e8024d76f1013b1563afcf', '超级管理员', '1387724336', '127.0.0.1', '30', null, '0', '0', '1');
