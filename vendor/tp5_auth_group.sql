/*
Navicat MySQL Data Transfer

Source Server         : localhost3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : tp5blog

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-08-04 12:42:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp5_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp5_auth_group`;
CREATE TABLE `tp5_auth_group` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned DEFAULT '1',
  `time` int(10) unsigned DEFAULT '0',
  `rule_pids` varchar(500) DEFAULT '',
  `rules` varchar(3000) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp5_auth_group
-- ----------------------------
INSERT INTO `tp5_auth_group` VALUES ('16', '超级管理员', '1', '1501687648', '98,113,123,125', '100,103,104,105,101,126,131,102,114,124');
INSERT INTO `tp5_auth_group` VALUES ('14', '普通管理员', '1', '1501686282', '0', '');
INSERT INTO `tp5_auth_group` VALUES ('15', '商品发布专员', '1', '1501687218', '0', '');
INSERT INTO `tp5_auth_group` VALUES ('17', '订单处理专员', '1', '1501687779', '98,123,125', '100,124,134');
INSERT INTO `tp5_auth_group` VALUES ('18', '订单处理专员1', '1', '1501687794', '0', '');
INSERT INTO `tp5_auth_group` VALUES ('19', '订单处理专员6ddd', '1', '1501687843', '98,99', '');

-- ----------------------------
-- Table structure for tp5_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tp5_auth_group_access`;
CREATE TABLE `tp5_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp5_auth_group_access
-- ----------------------------
INSERT INTO `tp5_auth_group_access` VALUES ('7', '17');

-- ----------------------------
-- Table structure for tp5_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp5_auth_rule`;
CREATE TABLE `tp5_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `css` varchar(50) DEFAULT '',
  `sort` smallint(6) unsigned DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示左侧菜单',
  `condition` char(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp5_auth_rule
-- ----------------------------
INSERT INTO `tp5_auth_rule` VALUES ('98', '0', 'admin/manager/index', '管理员管理', '1', '1', '1', 'fa-users', '3', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('100', '98', 'admin/manager/index', '管理员列表', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('101', '98', 'admin/manager/group', '管理员组', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('102', '98', 'admin/manager/node', '节点管理', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('103', '100', 'admin/manager/add_admin', '新增管理员', '3', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('104', '100', 'admin/manager/deleteadmin', '删除管理员', '3', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('105', '100', 'admin/manager/edit_node', '编辑管理员', '3', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('164', '0', 'admin/content', '内容管理', '1', '1', '1', 'fa-list', '50', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('165', '164', 'admin/content/publish', '发布文章', '2', '1', '1', '', '50', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('138', '0', 'admin/data', '数据缓存', '1', '1', '1', 'fa-bar-chart-o', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('139', '138', 'admin/data/index', '数据库备份', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('166', '164', 'admin/content/index', '文章列表', '2', '1', '1', '', '50', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('167', '164', 'admin/content/comment', '评论管理', '2', '1', '1', '', '50', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('140', '138', 'admin/data/restore', '导入数据表', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('113', '0', 'admin/extend', '扩展管理', '1', '1', '1', 'fa-cubes', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('114', '113', 'admin/area/index', '地区管理', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('174', '172', 'admin/goods/add_type', '新增类型', '3', '1', '1', '', '50', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('173', '168', 'admin/goods/brand', '品牌管理', '2', '1', '1', '', '5', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('172', '168', 'admin/goods/goods_type', '商品类型', '2', '1', '1', '', '4', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('171', '168', 'admin/goods/category', '商品分类', '2', '1', '1', '', '3', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('170', '168', 'admin/goods/add', '添加商品', '2', '1', '1', '', '2', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('169', '168', 'admin/goods/index', '商品列表', '2', '1', '1', '', '1', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('168', '0', 'admin/goods', '商品管理', '1', '1', '1', 'fa-list', '50', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('123', '0', 'system/index', '系统设置', '1', '1', '1', 'fa-cogs', '2', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('124', '123', 'admin/system/setting', '基本配置', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('125', '0', 'admin/index', '控制台', '1', '1', '1', 'fa-tachometer', '1', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('126', '101', 'admin/manager/add_group', '新增管理员组', '3', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('131', '101', 'admin/manager/setting', '绑定权限', '3', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('133', '101', 'admin/manager/editgroup', '编辑管理员组', '3', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('134', '125', 'admin/index/index', '后台首页', '2', '1', '1', '', '1', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('135', '123', 'admin/system/email', '邮箱配置', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('136', '123', 'admin/system/payment', '支付接口', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('137', '123', 'admin/system/sms', '短信接口', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('141', '138', 'admin/data/ziplist', '数据库压缩', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('142', '138', 'admin/data/clear', '数据缓存', '2', '1', '1', '', '50', '1', '');
INSERT INTO `tp5_auth_rule` VALUES ('143', '123', 'admin/weblog/index', '操作日志', '2', '1', '1', '', '50', '1', null);
INSERT INTO `tp5_auth_rule` VALUES ('175', '172', 'admin/goods/typeparams', '添加参数', '3', '1', '1', '', '50', '1', null);
