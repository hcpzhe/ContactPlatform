/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : ctplatform

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2013-12-20 04:09:39
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_member
-- ----------------------------

-- ----------------------------
-- Table structure for `pf_news`
-- ----------------------------
DROP TABLE IF EXISTS `pf_news`;
CREATE TABLE `pf_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ctg_id` int(10) unsigned NOT NULL COMMENT '所属分类ID',
  `title` varchar(255) NOT NULL COMMENT '新闻标题',
  `content` text COMMENT '新闻内容',
  `editor` varchar(255) DEFAULT NULL,
  `is_recom` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否推荐 0-不推荐 1-推荐',
  `is_display` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-不显示 1-显示',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-删除 1-正常',
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
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '栏目类型 1-列表 2-单页',
  `rank` smallint(6) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_display` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示 0-不显示 1-显示',
  `is_index` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否首页显示 0-不显示 1-显示',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-删除 1-正常',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_news_category
-- ----------------------------

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
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '信息状态 0-删除 1-已处理 2-待处理',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_suggest
-- ----------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_user
-- ----------------------------
