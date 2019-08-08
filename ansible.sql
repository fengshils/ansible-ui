/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.5
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ansible

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-08-08 23:07:32
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
