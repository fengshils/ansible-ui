/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : ansible

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2019-08-11 17:13:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ansible_host`
-- ----------------------------
DROP TABLE IF EXISTS `ansible_host`;
CREATE TABLE `ansible_host` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '主机名',
  `ip` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `key` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_id` int(11) NOT NULL COMMENT '主机分组',
  `create_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_2` (`name`,`ip`),
  KEY `name` (`name`),
  KEY `g_id` (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of ansible_host
-- ----------------------------
INSERT INTO `ansible_host` VALUES ('1', 'localhost', '127.0.0.1', 'root', 'centos', '', '1', '1565193407');

-- ----------------------------
-- Table structure for `ansible_host_group`
-- ----------------------------
DROP TABLE IF EXISTS `ansible_host_group`;
CREATE TABLE `ansible_host_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ansible_host_group
-- ----------------------------
INSERT INTO `ansible_host_group` VALUES ('1', 'localhost');

-- ----------------------------
-- Table structure for `ansible_playbook`
-- ----------------------------
DROP TABLE IF EXISTS `ansible_playbook`;
CREATE TABLE `ansible_playbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL COMMENT '剧本名称',
  `path` varchar(255) DEFAULT NULL COMMENT '脚本路径',
  `comment` varchar(255) DEFAULT NULL COMMENT '备注',
  `tag` varchar(255) DEFAULT '' COMMENT '主机标识 标签',
  `create_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_unique` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ansible_playbook
-- ----------------------------
INSERT INTO `ansible_playbook` VALUES ('3', '添加用户2', '/opt/ansible/user.yml', '<p>再此处输入playbook使用方法，备注，以及需要的变量等</p>', 'user', '1565448453');
INSERT INTO `ansible_playbook` VALUES ('4', 'localhost', '/opt/ansible/user.yml', '<p>再此处输入playbook使用方法，备注，以及需要的变量等</p>', 'tag', '1565448464');

-- ----------------------------
-- Table structure for `ansible_user`
-- ----------------------------
DROP TABLE IF EXISTS `ansible_user`;
CREATE TABLE `ansible_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ansible_user
-- ----------------------------
INSERT INTO `ansible_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', null, null);
