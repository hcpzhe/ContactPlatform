/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : ctplatform

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-12-16 17:37:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pf_member`
-- ----------------------------
DROP TABLE IF EXISTS `pf_member`;
CREATE TABLE `pf_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `password` char(32) NOT NULL,
  `last_login_time` varchar(20) DEFAULT '0' COMMENT 'unix时间戳',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_member
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
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '信息状态 0-删除 1-待处理 2-已处理',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pf_suggest
-- ----------------------------
