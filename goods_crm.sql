/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : goods_crm

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-08-23 11:50:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for syc_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_group`;
CREATE TABLE `syc_auth_group` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned DEFAULT '1',
  `time` int(10) unsigned DEFAULT '0',
  `rule_pids` varchar(500) DEFAULT '',
  `rules` varchar(3000) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_auth_group
-- ----------------------------
INSERT INTO `syc_auth_group` VALUES ('16', '超级管理员', '1', '1501687648', '98,164,138,113,168,123,125', '100,103,104,105,101,126,131,133,102,165,166,167,139,141,142,114,173,172,174,175,171,170,169,124,135,136,137,143,134');
INSERT INTO `syc_auth_group` VALUES ('14', '普通管理员', '1', '1501686282', '0', '');
INSERT INTO `syc_auth_group` VALUES ('15', '商品发布专员', '1', '1501687218', '0', '');
INSERT INTO `syc_auth_group` VALUES ('17', '订单处理专员', '1', '1501687779', '98,123,125', '100,124,134');
INSERT INTO `syc_auth_group` VALUES ('27', 'fdaf', '1', '1533462974', '', '');
INSERT INTO `syc_auth_group` VALUES ('19', '订单处理专员6ddd', '1', '1501687843', '98,164,138,113,168,123,125', '100,103,104,105,101,126,131,133,102,165,166,167,139,141,142,114,173,172,174,175,171,170,169,124,135,136,137,143,134');
INSERT INTO `syc_auth_group` VALUES ('23', '测试角色', '1', '0', '', '');

-- ----------------------------
-- Table structure for syc_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_group_access`;
CREATE TABLE `syc_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_auth_group_access
-- ----------------------------
INSERT INTO `syc_auth_group_access` VALUES ('2', '16');
INSERT INTO `syc_auth_group_access` VALUES ('3', '14');
INSERT INTO `syc_auth_group_access` VALUES ('7', '17');

-- ----------------------------
-- Table structure for syc_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_rule`;
CREATE TABLE `syc_auth_rule` (
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
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_auth_rule
-- ----------------------------
INSERT INTO `syc_auth_rule` VALUES ('98', '0', 'admin/manager/index', '管理员管理', '1', '1', '1', 'fa-users', '3', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('100', '98', 'admin/manager/index', '管理员列表', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('101', '98', 'admin/manager/group', '管理员组', '2', '1', '1', '', '90', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('102', '98', 'admin/manager/node', '节点管理', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('103', '100', 'admin/manager/add_admin', '新增管理员', '3', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('104', '100', 'admin/manager/deleteadmin', '删除管理员', '3', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('105', '100', 'admin/manager/edit_node', '编辑管理员', '3', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('164', '0', 'admin/content', '内容管理', '1', '1', '1', 'fa-list', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('165', '164', 'admin/content/publish', '发布文章', '2', '1', '1', '', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('138', '0', 'admin/data', '数据缓存', '1', '1', '1', 'fa-bar-chart-o', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('139', '138', 'admin/data/index', '数据库备份', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('166', '164', 'admin/content/index', '文章列表', '2', '1', '1', '', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('167', '164', 'admin/content/comment', '评论管理', '2', '1', '1', '', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('113', '0', 'admin/extend', '扩展管理', '1', '1', '1', 'fa-cubes', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('114', '113', 'admin/area/index', '地区管理', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('174', '172', 'admin/goods/add_type', '新增类型', '3', '1', '1', '', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('173', '168', 'admin/goods/brand', '品牌管理', '2', '1', '1', '', '5', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('172', '168', 'admin/goods/goods_type', '商品类型', '2', '1', '1', '', '4', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('171', '168', 'admin/goods/category', '商品分类', '2', '1', '1', '', '3', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('170', '168', 'admin/goods/add', '添加商品', '2', '1', '1', '', '2', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('169', '168', 'admin/goods/index', '商品列表', '2', '1', '1', '', '1', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('168', '0', 'admin/goods', '商品管理', '1', '1', '1', 'fa-list', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('123', '0', 'system/index', '系统设置', '1', '1', '1', 'fa-cogs', '2', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('124', '123', 'admin/system/setting', '基本配置', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('125', '0', 'admin/index', '控制台', '1', '1', '1', 'fa-tachometer', '1', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('126', '101', 'admin/manager/add_group', '新增管理员组', '3', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('131', '101', 'admin/manager/setting', '绑定权限', '3', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('133', '101', 'admin/manager/editgroup', '编辑管理员组', '3', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('134', '125', 'admin/index/index', '后台首页', '2', '1', '1', '', '1', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('135', '123', 'admin/system/email', '邮箱配置', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('136', '123', 'admin/system/payment', '支付接口', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('137', '123', 'admin/system/sms', '短信接口', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('141', '138', 'admin/data/ziplist', '数据库压缩', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('142', '138', 'admin/data/clear', '数据缓存', '2', '1', '1', '', '50', '1', '');
INSERT INTO `syc_auth_rule` VALUES ('143', '123', 'admin/weblog/index', '操作日志', '2', '1', '1', '', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('175', '172', 'admin/goods/typeparams', '添加参数', '3', '1', '1', '', '50', '1', null);

-- ----------------------------
-- Table structure for syc_bancai
-- ----------------------------
DROP TABLE IF EXISTS `syc_bancai`;
CREATE TABLE `syc_bancai` (
  `bid` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `bpcid` int(10) NOT NULL COMMENT '产品颜色ID',
  `bplid` int(10) NOT NULL COMMENT '板材ID',
  `bquantity` int(6) NOT NULL DEFAULT '0' COMMENT '数量',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='板材库存表';

-- ----------------------------
-- Records of syc_bancai
-- ----------------------------
INSERT INTO `syc_bancai` VALUES ('20', '24', '7', '0', '1512126578', '1512126578', '1');
INSERT INTO `syc_bancai` VALUES ('21', '23', '7', '0', '1512126578', '1512214528', '1');
INSERT INTO `syc_bancai` VALUES ('22', '22', '7', '0', '1512126578', '1512214528', '1');
INSERT INTO `syc_bancai` VALUES ('23', '25', '7', '0', '1512126578', '1512126578', '1');
INSERT INTO `syc_bancai` VALUES ('24', '24', '8', '0', '1512213006', '1512213006', '1');
INSERT INTO `syc_bancai` VALUES ('25', '23', '8', '0', '1512213006', '1512213006', '1');
INSERT INTO `syc_bancai` VALUES ('26', '22', '8', '0', '1512213006', '1512213006', '1');
INSERT INTO `syc_bancai` VALUES ('27', '25', '8', '0', '1512213006', '1512213006', '1');

-- ----------------------------
-- Table structure for syc_bancai_list
-- ----------------------------
DROP TABLE IF EXISTS `syc_bancai_list`;
CREATE TABLE `syc_bancai_list` (
  `blid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `blname` char(50) NOT NULL DEFAULT '' COMMENT '板材名称',
  `blpinpai` char(50) NOT NULL DEFAULT '' COMMENT '料型品牌',
  `bguige` char(50) NOT NULL COMMENT '规格',
  `blimg` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `bldescription` varchar(255) NOT NULL DEFAULT '' COMMENT '简述',
  `bl_uid` int(10) NOT NULL COMMENT '添加员',
  `blgl` char(255) NOT NULL DEFAULT '' COMMENT '关联料型',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`blid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='板材名称表';

-- ----------------------------
-- Records of syc_bancai_list
-- ----------------------------
INSERT INTO `syc_bancai_list` VALUES ('7', '801', '', '860*2150', '', '', '1', '', '1512126578', '1512212987', '1');
INSERT INTO `syc_bancai_list` VALUES ('8', '802', '', '860*2050', '', '', '1', '', '1512213006', '1512213006', '1');

-- ----------------------------
-- Table structure for syc_baojia
-- ----------------------------
DROP TABLE IF EXISTS `syc_baojia`;
CREATE TABLE `syc_baojia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '客户id',
  `order_sn` varchar(50) NOT NULL DEFAULT '' COMMENT '报价单号',
  `order_handle` varchar(50) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `company_short` varchar(255) NOT NULL DEFAULT '',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `order_remark` text,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_sn` (`order_sn`,`company_name`,`company_short`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_baojia
-- ----------------------------
INSERT INTO `syc_baojia` VALUES ('1', '2', '1686', 'CS-Q-08/1311410841', '跟单员2', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', 'order_remarkorder_remarkorder_remarkorder_remarkorder_remarkorder_remark', '1', '1534132387', '1534240032');

-- ----------------------------
-- Table structure for syc_baojia_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_baojia_goods`;
CREATE TABLE `syc_baojia_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `baojia_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `baojia_id` (`baojia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_baojia_goods
-- ----------------------------
INSERT INTO `syc_baojia_goods` VALUES ('1', '1', '4', '小米手机iPhone6s 32G', '台', '2199.00', '小米手机iPhone6s 32G备注', '1534132387');
INSERT INTO `syc_baojia_goods` VALUES ('6', '1', '6', '测试商品2', '台', '3999.00', '备注备注备注备注备注备注备注备注', '1534144452');
INSERT INTO `syc_baojia_goods` VALUES ('7', '1', '1', '测试商品', '台', '213.00', '商品备注', '1534144452');
INSERT INTO `syc_baojia_goods` VALUES ('8', '1', '2', 'fsafsa', '件', '12112.00', '23132', '1534144574');
INSERT INTO `syc_baojia_goods` VALUES ('9', '1', '5', 'gasafsdf', '台', '3123.00', '3122313', '1534144574');

-- ----------------------------
-- Table structure for syc_config
-- ----------------------------
DROP TABLE IF EXISTS `syc_config`;
CREATE TABLE `syc_config` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '配置名称',
  `info` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `type` varchar(10) NOT NULL DEFAULT 'string' COMMENT '配置类型',
  `value` text COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='基本配置表';

-- ----------------------------
-- Records of syc_config
-- ----------------------------
INSERT INTO `syc_config` VALUES ('1', 'syc_basehost', 'CRM站点', 'string', 'http://www.testgoodscrm.com');
INSERT INTO `syc_config` VALUES ('2', 'syc_webname', '企业名称', 'string', '广州市进销传系统有限公司');
INSERT INTO `syc_config` VALUES ('3', 'syc_webtel', '电话', 'string', '0757-88888888');
INSERT INTO `syc_config` VALUES ('4', 'syc_webfax', '传真', 'string', '0757-88888888');
INSERT INTO `syc_config` VALUES ('5', 'syc_contacts', '联系人', 'string', '管理员');
INSERT INTO `syc_config` VALUES ('6', 'syc_webemail', '邮件', 'string', 'nice172@126.com');
INSERT INTO `syc_config` VALUES ('7', 'syc_email_pwd', '验证密码', 'string', 'nice172');
INSERT INTO `syc_config` VALUES ('8', 'syc_port', 'SMTP端口', 'string', '25');
INSERT INTO `syc_config` VALUES ('10', 'syc_email_smtp', 'SMTP服务器', 'string', 'smtp.126.com');
INSERT INTO `syc_config` VALUES ('11', 'syc_powerby', '版权信息', 'bstring', 'Copyright © 2010-2017 <a href=\"http://www.sycit.cn\">广东省广州市天河区</a> 版权所有');
INSERT INTO `syc_config` VALUES ('12', 'syc_beian', '备案信息', 'string', '');
INSERT INTO `syc_config` VALUES ('13', 'syc_tousu', '投诉电话', 'string', '0757-88888888');
INSERT INTO `syc_config` VALUES ('14', 'syc_address', '地址', 'string', '广东省广州市天河区');
INSERT INTO `syc_config` VALUES ('15', 'syc_webqq', 'QQ', 'string', '316262448');
INSERT INTO `syc_config` VALUES ('16', 'syc_keywords', '关键词', 'bstring', '广东省广州市天河区');
INSERT INTO `syc_config` VALUES ('17', 'syc_description', '描述', 'bstring', '广州市进销传系统有限公司');

-- ----------------------------
-- Table structure for syc_customers
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers`;
CREATE TABLE `syc_customers` (
  `cus_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cus_con_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '默认联系人ID',
  `cus_name` varchar(255) NOT NULL DEFAULT '' COMMENT '企业名称',
  `cus_short` varchar(255) NOT NULL DEFAULT '' COMMENT '简称',
  `cus_duty` char(20) NOT NULL DEFAULT '' COMMENT '责任人',
  `cus_phome` char(20) NOT NULL COMMENT '座机',
  `cus_fax` char(20) NOT NULL COMMENT '传真',
  `cus_mobile` char(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `cus_email` char(20) NOT NULL COMMENT '邮箱',
  `cus_business` varchar(255) NOT NULL DEFAULT '' COMMENT '业务经理',
  `cus_order_ren` varchar(255) NOT NULL DEFAULT '' COMMENT '跟单员',
  `cus_post` varchar(255) NOT NULL DEFAULT '',
  `cus_prov` varchar(100) NOT NULL DEFAULT '' COMMENT '省份',
  `cus_city` varchar(100) NOT NULL DEFAULT '' COMMENT '城市',
  `cus_dist` varchar(100) NOT NULL DEFAULT '' COMMENT '县区',
  `cus_section` varchar(255) NOT NULL DEFAULT '',
  `cus_sex` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `cus_qq` varchar(255) NOT NULL DEFAULT '',
  `cus_street` varchar(100) NOT NULL DEFAULT '' COMMENT '街道信息',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1687 DEFAULT CHARSET=utf8 COMMENT='客户信息表';

-- ----------------------------
-- Records of syc_customers
-- ----------------------------
INSERT INTO `syc_customers` VALUES ('1686', '5', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '020-89898989', '13800138000', '354575573@qq.com', '彭立新', '跟单员2', 'PHP', '广东省', '广州市', '天河区', '工作部', '0', '354575573', '中山大道西1025号', '1533614328', '1533614328', '1');

-- ----------------------------
-- Table structure for syc_customers_contact
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_contact`;
CREATE TABLE `syc_customers_contact` (
  `con_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `con_cus_id` int(10) NOT NULL COMMENT '客户ID',
  `con_name` char(16) NOT NULL COMMENT '姓名',
  `con_sex` tinyint(2) DEFAULT '1' COMMENT '性别1男0女',
  `con_post` char(20) NOT NULL DEFAULT '' COMMENT '职位',
  `con_section` varchar(255) NOT NULL DEFAULT '' COMMENT '部门',
  `con_mobile` char(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `con_qq` char(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `con_email` char(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `con_address` varchar(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `con_description` varchar(200) NOT NULL DEFAULT '' COMMENT '备注信息',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='客户联系人表';

-- ----------------------------
-- Records of syc_customers_contact
-- ----------------------------
INSERT INTO `syc_customers_contact` VALUES ('5', '1686', 'nice172', '1', '开发者', '销售部', '13800138000', '354575573', '354575573@qq.com', '广东省广州市天河区中山大道西1025号', '客户备注内容', '1533614328', '1533614328', '1');
INSERT INTO `syc_customers_contact` VALUES ('6', '1686', '蜡笔小新', '1', '仓管', '仓储物流部', '13800138001', '354575575', '354575575@qq.com', '广州市天河区中山大道西1025号', '备注蜡笔小新', '1533622131', '1533622131', '1');
INSERT INTO `syc_customers_contact` VALUES ('7', '1686', 'fdsafa', '1', 'fdsafsaf', '采购部', '13800138000', 'fsafdsadf', 'fsdafa', 'fdsafsa', 'fsadf', '1533623950', '1533624036', '-1');

-- ----------------------------
-- Table structure for syc_customers_evaluate
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_evaluate`;
CREATE TABLE `syc_customers_evaluate` (
  `eva_id` int(6) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `eva_name` char(20) NOT NULL DEFAULT '' COMMENT '评估名称',
  `eva_text` char(100) NOT NULL COMMENT '说明',
  PRIMARY KEY (`eva_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='客户评估等级表';

-- ----------------------------
-- Records of syc_customers_evaluate
-- ----------------------------
INSERT INTO `syc_customers_evaluate` VALUES ('1', '优秀级', '（AAA）90分及以上。企业各项经济指标很好，经营管理状况好，经济效益很好，有很强的清偿与支付能力，市场竞争力强，企业信誉度高。');
INSERT INTO `syc_customers_evaluate` VALUES ('2', '良好级', '（AA）80-89分。企业各项经济指标良好，经营管理状况较好，经济效益良好，有较强的清偿与支付能力，企业信誉度良好。');
INSERT INTO `syc_customers_evaluate` VALUES ('3', '较好级', '（A）70-79分。企业有一定的经济实力，经营管理状况尚可，经济效益稳定，有一定的清偿与支付能力，企业信誉度尚可。');
INSERT INTO `syc_customers_evaluate` VALUES ('4', '一般级', '（BBB）60-69分。企业各项经济指标一般，经营管理状况一般，清偿与支付有一定难度，存在风险。');
INSERT INTO `syc_customers_evaluate` VALUES ('5', '较差级', '（BB）50-59分。企业各项经济指标较差，经营管理状况较差，清偿与支付有较大难度，存在较高风险。');
INSERT INTO `syc_customers_evaluate` VALUES ('6', '差级', '（B）49分及以下。企业各项经济指标差，经营管理状况差，清偿与支付有很大难度，存在高风险。');

-- ----------------------------
-- Table structure for syc_customers_message
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_message`;
CREATE TABLE `syc_customers_message` (
  `msg_cus_id` int(10) NOT NULL COMMENT '客户ID',
  `msg_content` text COMMENT '备注内容',
  PRIMARY KEY (`msg_cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客户备注信息';

-- ----------------------------
-- Records of syc_customers_message
-- ----------------------------
INSERT INTO `syc_customers_message` VALUES ('1686', '客户备注内容');

-- ----------------------------
-- Table structure for syc_customers_premises
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_premises`;
CREATE TABLE `syc_customers_premises` (
  `pre_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `pre_cus_id` int(10) NOT NULL DEFAULT '0' COMMENT '客户ID',
  `pre_log_id` int(10) NOT NULL DEFAULT '0' COMMENT '物流ID',
  `pre_name` char(20) NOT NULL DEFAULT '' COMMENT '收货人',
  `pre_phone` char(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `pre_prov` char(10) NOT NULL DEFAULT '' COMMENT '省份',
  `pre_city` char(10) NOT NULL DEFAULT '' COMMENT '城市',
  `pre_dist` char(10) NOT NULL DEFAULT '' COMMENT '县区',
  `pre_street` varchar(100) NOT NULL COMMENT '街道信息',
  `pre_description` varchar(255) NOT NULL DEFAULT '' COMMENT '备注信息',
  PRIMARY KEY (`pre_id`),
  UNIQUE KEY `pre_cus_id` (`pre_cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客户收货信息';

-- ----------------------------
-- Records of syc_customers_premises
-- ----------------------------

-- ----------------------------
-- Table structure for syc_customers_type
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers_type`;
CREATE TABLE `syc_customers_type` (
  `ty_id` int(6) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `ty_name` char(16) NOT NULL COMMENT '名称',
  PRIMARY KEY (`ty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='客户类型表';

-- ----------------------------
-- Records of syc_customers_type
-- ----------------------------
INSERT INTO `syc_customers_type` VALUES ('1', '零售业');
INSERT INTO `syc_customers_type` VALUES ('2', '经销商');
INSERT INTO `syc_customers_type` VALUES ('3', '专卖店');
INSERT INTO `syc_customers_type` VALUES ('4', '企业型');

-- ----------------------------
-- Table structure for syc_delivery_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_delivery_goods`;
CREATE TABLE `syc_delivery_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(100) NOT NULL DEFAULT '',
  `goods_attr` text,
  `current_send_number` int(10) unsigned NOT NULL DEFAULT '0',
  `add_number` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_id` (`delivery_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_delivery_goods
-- ----------------------------
INSERT INTO `syc_delivery_goods` VALUES ('1', '5', '4', '小米手机iPhone6s 32G', '台', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '0', '0', '小米手机iPhone6s 32G备注');
INSERT INTO `syc_delivery_goods` VALUES ('2', '5', '6', '测试商品2', '台', null, '0', '0', '备注备注备注备注备注备注备注备注');
INSERT INTO `syc_delivery_goods` VALUES ('3', '5', '2', 'fsafsa', '件', null, '0', '0', '23132');

-- ----------------------------
-- Table structure for syc_delivery_order
-- ----------------------------
DROP TABLE IF EXISTS `syc_delivery_order`;
CREATE TABLE `syc_delivery_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `purchase_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_dn` varchar(255) NOT NULL DEFAULT '',
  `po_sn` varchar(255) NOT NULL,
  `delivery_date` varchar(50) NOT NULL DEFAULT '',
  `purchase_date` varchar(50) NOT NULL DEFAULT '',
  `purchase_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(255) NOT NULL DEFAULT '',
  `cus_name` varchar(255) NOT NULL DEFAULT '',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `contacts_tel` varchar(50) NOT NULL DEFAULT '',
  `delivery_address` varchar(255) NOT NULL DEFAULT '',
  `delivery_sn` varchar(100) NOT NULL DEFAULT '',
  `delivery_way` varchar(100) NOT NULL DEFAULT '',
  `delivery_driver` varchar(50) NOT NULL DEFAULT '',
  `driver_tel` varchar(50) NOT NULL DEFAULT '',
  `relation_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0采购单关联订单，1随意送货订单',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `is_print` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已打印',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`,`order_id`,`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_delivery_order
-- ----------------------------
INSERT INTO `syc_delivery_order` VALUES ('5', '2', '7', 'DN201808220026260826', 'PO201808211221210821', '2018-08-23', '2018-08-21', '11808.00', '8', 'SO201808215917170817', '广州市进销传系统有限公司', '1686', 'nice172', '020-89898989', '广东省广州市天河区中山大道西1025号', 'abababdbs', 'fsafsfsa', 'safafda', '999999999', '1', '0', '1', '1534932091', '1534932091');

-- ----------------------------
-- Table structure for syc_finance
-- ----------------------------
DROP TABLE IF EXISTS `syc_finance`;
CREATE TABLE `syc_finance` (
  `fid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fpnumber` char(20) NOT NULL COMMENT '订单号',
  `fcus_id` int(10) NOT NULL COMMENT '企业ID',
  `fcus_name` char(50) NOT NULL COMMENT '客户名称',
  `sort` tinyint(2) NOT NULL DEFAULT '1' COMMENT '收款类:1为订金2为余款3为其他',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `fuid` int(10) NOT NULL DEFAULT '0' COMMENT '收款人',
  `shoukuan_time` int(16) NOT NULL DEFAULT '0' COMMENT '收款时间',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收款表';

-- ----------------------------
-- Records of syc_finance
-- ----------------------------

-- ----------------------------
-- Table structure for syc_finance_schedule
-- ----------------------------
DROP TABLE IF EXISTS `syc_finance_schedule`;
CREATE TABLE `syc_finance_schedule` (
  `fsid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fs_fid` int(10) NOT NULL DEFAULT '0' COMMENT '收款ID',
  `fs_img` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `fs_remark` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  PRIMARY KEY (`fsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收款附表';

-- ----------------------------
-- Records of syc_finance_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for syc_finance_sort
-- ----------------------------
DROP TABLE IF EXISTS `syc_finance_sort`;
CREATE TABLE `syc_finance_sort` (
  `sid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sname` char(20) NOT NULL DEFAULT '' COMMENT '订单号',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='收款附表项目类型';

-- ----------------------------
-- Records of syc_finance_sort
-- ----------------------------
INSERT INTO `syc_finance_sort` VALUES ('1', '订单订金');
INSERT INTO `syc_finance_sort` VALUES ('2', '订单尾款');
INSERT INTO `syc_finance_sort` VALUES ('3', '订单全款');
INSERT INTO `syc_finance_sort` VALUES ('4', '其他款项');

-- ----------------------------
-- Table structure for syc_fittings_lock
-- ----------------------------
DROP TABLE IF EXISTS `syc_fittings_lock`;
CREATE TABLE `syc_fittings_lock` (
  `lid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `lname` char(16) NOT NULL COMMENT '名称',
  `lprice` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `luser_nick` char(20) NOT NULL COMMENT '添加者',
  `laddress` varchar(100) NOT NULL DEFAULT '' COMMENT '产地',
  `limg` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `ldescription` varchar(255) NOT NULL DEFAULT '' COMMENT '简述',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`lid`),
  UNIQUE KEY `lname` (`lname`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='锁具配件表';

-- ----------------------------
-- Records of syc_fittings_lock
-- ----------------------------
INSERT INTO `syc_fittings_lock` VALUES ('1', '白至尊', '55.00', '1', '', '', '', '1507531190', '1507535077', '1');
INSERT INTO `syc_fittings_lock` VALUES ('2', '至尊锁', '60.00', '1', '', '', '', '1511074473', '1511074473', '1');

-- ----------------------------
-- Table structure for syc_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods`;
CREATE TABLE `syc_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `goods_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类',
  `goods_type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型',
  `brand_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '品牌',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属供应商',
  `unit` varchar(20) NOT NULL DEFAULT '' COMMENT '商品单位',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价格',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '采购价',
  `remark` text COMMENT '备注',
  `goods_attr` text COMMENT '商品属性',
  `goods_weight` varchar(50) NOT NULL DEFAULT '' COMMENT '商品重量',
  `store_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `store_attr` varchar(255) NOT NULL DEFAULT '' COMMENT '库存属性',
  `copyright` varchar(255) NOT NULL DEFAULT '' COMMENT '所有权',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '具体位置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0禁售，-1删除',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods
-- ----------------------------
INSERT INTO `syc_goods` VALUES ('1', '测试商品', '3', '1', '2', '1', '台', '3399.00', '2999.00', '测试商品备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '0.23KG', '1000', '库存属性', '小米公司', '具体位置具体位置具体位置具体位置具体位置', '1', '1533893242', '1533893242');
INSERT INTO `syc_goods` VALUES ('2', 'fsafsa', '1', '2', '2', '1', '件', '12112.00', '12.00', '23132', null, '31233', '32133', '313131', '321313', '具体位置具体位置具体位置具体位置具体位置', '1', '1533893431', '1534836108');
INSERT INTO `syc_goods` VALUES ('4', '小米手机iPhone6s 32G', '3', '1', '2', '1', '台', '2199.00', '1999.00', '小米手机iPhone6s 32G备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '0.23KG', '999', '小米广州仓库', '小米科技', '广州81号仓库', '1', '1533972542', '1534404690');
INSERT INTO `syc_goods` VALUES ('5', 'gasafsdf', '3', '2', '1', '1', '台', '3123.00', '12.00', '3122313', '', '231', '312313', '3213', '3213', '31223', '1', '1533974547', '1534059560');
INSERT INTO `syc_goods` VALUES ('6', '测试商品2', '7', '1', '1', '1', '台', '3999.00', '3899.00', '备注备注备注备注备注备注备注备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G+\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"java\"}]', '5.23KG', '9996', '华为广州仓库', '华为科技', '广东省广州市天河区', '1', '1533975224', '1534059313');
INSERT INTO `syc_goods` VALUES ('7', 'fdsaff', '3', '1', '2', '1', '件', '55.00', '12.00', 'fsdffa', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u9ed1\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u53cc\\u5361\\u53554G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e09\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '22', '500', '55', '66', '88', '1', '1534404872', '1534836118');

-- ----------------------------
-- Table structure for syc_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_attr`;
CREATE TABLE `syc_goods_attr` (
  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(20) NOT NULL DEFAULT '',
  `attr_value` varchar(200) DEFAULT '',
  `attr_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0参数，1规格',
  `sort` smallint(6) unsigned DEFAULT '0',
  `goods_type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型ID',
  PRIMARY KEY (`goods_attr_id`),
  KEY `goods_type_id` (`goods_type_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_attr
-- ----------------------------
INSERT INTO `syc_goods_attr` VALUES ('1', '操作系统', '安卓（Android）\r\n苹果（IOS）\n微软（WindowsPhone）\n基础功能机系统\r\n其他', '0', '1', '1');
INSERT INTO `syc_goods_attr` VALUES ('2', '屏幕尺寸', '5.6英寸及以上\n5.5-5.1英寸\n5.0-4.6英寸\n4.5-3.1英寸\n3.0英寸及以下', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('3', 'CPU核数', '十核\n八核\n双四核\n四核\n双核\n单核\n功能机\n其他', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('4', '手机价格', '500元以下\n500-1000元\n1000-1500元\n1500-2000元\n2000-2500元\n2500-3000元\n3000-3500元\n3500-4000元\n4500-5000元\n5000元以上', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('5', '网络类型', '移动4G/联通4G/电信4G\n移动4G+\n移动4G\n联通4G\n电信4G\n双卡单4G\n双卡双4G\n双卡2G网络', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('6', '机身内存', '256GB\n128GB\n64GB\n32GB\n16GB\n8GB\n8GB以下\n支持内存卡', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('7', '运行内存', '8GB\n6GB\n4GB\n3GB\n2GB\n2GB以下', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('8', '电池容量', '1200mAh以下\n1200mAh-1999mAh\n2000mAh-2999mAh\n3000mAh-3999mAh\n4000mAh-5999mAh\n6000mAh及以上', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('9', '前置摄像头像素', '1600万及以上\n800万-1599万\n500万-799万\n200万-499万\n120万-199万\n120万以下无', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('10', '后置摄像头像素', '后置双摄像头\n2000万及以上\n1200万-1999万\n500万-1199万\n500万以下无', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('11', '机身颜色', '白色\n黑色\n灰色\n金色\n银色\n红色\n蓝色\n粉色\n黄色\n绿色\n紫色', '0', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('12', '颜色', '白色\n黑色\n灰色\n金色\n银色\n红色\n蓝色\n粉色\n黄色\n绿色\n紫色', '1', '501', '1');
INSERT INTO `syc_goods_attr` VALUES ('13', '网络制式', '移动4G/联通4G/电信4G\n移动4G+\n移动4G\n联通4G\n电信4G\n双卡单4G\n双卡双4G\n双卡2G网络', '1', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('14', '套餐', '套餐一\n套餐二\n套餐三\n套餐四\n套餐五\n套餐六', '1', '50', '1');
INSERT INTO `syc_goods_attr` VALUES ('16', 'ab', 'ab\ndb\njava\nphp\njsp', '1', '50', '1');

-- ----------------------------
-- Table structure for syc_goods_attr_val
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_attr_val`;
CREATE TABLE `syc_goods_attr_val` (
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_attr_id` int(10) unsigned NOT NULL DEFAULT '0',
  `attr_name` varchar(255) NOT NULL DEFAULT '',
  `attr_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_attr_val
-- ----------------------------
INSERT INTO `syc_goods_attr_val` VALUES ('4', '12', '颜色', '白色');
INSERT INTO `syc_goods_attr_val` VALUES ('4', '13', '网络制式', '移动4G/联通4G/电信4G');
INSERT INTO `syc_goods_attr_val` VALUES ('4', '14', '套餐', '套餐二');
INSERT INTO `syc_goods_attr_val` VALUES ('4', '16', 'ab', 'php');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '颜色', '黑色');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '13', '网络制式', '移动4G+');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '套餐', '套餐三');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', 'ab', 'php');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '12', '颜色', '黑色');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '13', '网络制式', '双卡单4G');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '14', '套餐', '套餐三');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '16', 'ab', 'php');

-- ----------------------------
-- Table structure for syc_goods_brand
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_brand`;
CREATE TABLE `syc_goods_brand` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL DEFAULT '',
  `brand_name_en` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT '',
  `brand_logo` varchar(255) DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `website` varchar(255) DEFAULT '',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `cloud_upload` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1是云上传',
  PRIMARY KEY (`brand_id`),
  KEY `brand_name` (`brand_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_brand
-- ----------------------------
INSERT INTO `syc_goods_brand` VALUES ('1', '华为', 'HUAWEI', '华为手机', 'VElN5oiq5Zu+MjAxNzExMjUxNzM1NDYucG5n.png', '1', '', '50', '1');
INSERT INTO `syc_goods_brand` VALUES ('2', '小米', 'MI', '小米手机', '/uploads/brand/20171125/c532c05db25afbb09eb11238c5ce4f63.png', '1', 'https://mi.jd.com', '50', '0');
INSERT INTO `syc_goods_brand` VALUES ('3', '测试品牌', 'testa', '测试品牌', '', '1', 'https://mi.jd.com', '50', '0');

-- ----------------------------
-- Table structure for syc_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_category`;
CREATE TABLE `syc_goods_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL DEFAULT '',
  `keywords` varchar(200) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `is_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `filter_attr` varchar(100) NOT NULL DEFAULT '',
  `path` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `goods_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `price_nums` tinyint(6) unsigned NOT NULL DEFAULT '5',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_category
-- ----------------------------
INSERT INTO `syc_goods_category` VALUES ('1', '手机数码', '', '手机通讯描述', '0', '0', '50', '', '0', '1', '0', '5');
INSERT INTO `syc_goods_category` VALUES ('2', '手机通讯', '手机通讯', '手机通讯', '1', '0', '50', '', '0_1', '1', '0', '5');
INSERT INTO `syc_goods_category` VALUES ('3', '手机', '手机', '手机', '2', '0', '50', '3', '0_1_2', '1', '1', '5');
INSERT INTO `syc_goods_category` VALUES ('4', '对讲机', '对讲机', '对讲机', '2', '0', '50', '', '0_1_2', '1', '0', '5');
INSERT INTO `syc_goods_category` VALUES ('5', '家用电器', '家用电器', '家用电器', '0', '0', '50', '', '0', '1', '0', '5');
INSERT INTO `syc_goods_category` VALUES ('6', '大家电', '大家电', '大家电', '5', '0', '50', '', '0_5', '1', '0', '5');
INSERT INTO `syc_goods_category` VALUES ('7', '电视机', '', '', '6', '0', '50', '', '0_5_6', '1', '0', '5');
INSERT INTO `syc_goods_category` VALUES ('8', '电冰箱', '', '9999999999', '6', '0', '50', '', '0', '1', '0', '5');

-- ----------------------------
-- Table structure for syc_goods_type
-- ----------------------------
DROP TABLE IF EXISTS `syc_goods_type`;
CREATE TABLE `syc_goods_type` (
  `goods_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL DEFAULT '' COMMENT '商品类型名称',
  PRIMARY KEY (`goods_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods_type
-- ----------------------------
INSERT INTO `syc_goods_type` VALUES ('1', '手机');
INSERT INTO `syc_goods_type` VALUES ('2', '手机通讯');
INSERT INTO `syc_goods_type` VALUES ('3', '笔记本');
INSERT INTO `syc_goods_type` VALUES ('4', '衣服');
INSERT INTO `syc_goods_type` VALUES ('5', '洗衣机');
INSERT INTO `syc_goods_type` VALUES ('6', '冰箱');
INSERT INTO `syc_goods_type` VALUES ('7', '书');
INSERT INTO `syc_goods_type` VALUES ('8', '手机耳机');
INSERT INTO `syc_goods_type` VALUES ('9', '数码相机');
INSERT INTO `syc_goods_type` VALUES ('18', 'aaaaaaaaaa');
INSERT INTO `syc_goods_type` VALUES ('19', 'bbbbbb');
INSERT INTO `syc_goods_type` VALUES ('20', 'uuu');

-- ----------------------------
-- Table structure for syc_logistics
-- ----------------------------
DROP TABLE IF EXISTS `syc_logistics`;
CREATE TABLE `syc_logistics` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `log_name` char(20) NOT NULL DEFAULT '' COMMENT '名称',
  `log_phone` char(20) NOT NULL DEFAULT '' COMMENT '电话',
  `log_fax` char(20) NOT NULL DEFAULT '' COMMENT '传真',
  `log_address` varchar(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`log_id`),
  UNIQUE KEY `log_name` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物流信息表';

-- ----------------------------
-- Records of syc_logistics
-- ----------------------------

-- ----------------------------
-- Table structure for syc_material_att
-- ----------------------------
DROP TABLE IF EXISTS `syc_material_att`;
CREATE TABLE `syc_material_att` (
  `maid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ma_name` char(30) NOT NULL COMMENT '属性名称',
  PRIMARY KEY (`maid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='原料属性';

-- ----------------------------
-- Records of syc_material_att
-- ----------------------------
INSERT INTO `syc_material_att` VALUES ('1', 'Y');
INSERT INTO `syc_material_att` VALUES ('2', 'P');
INSERT INTO `syc_material_att` VALUES ('3', 'A');
INSERT INTO `syc_material_att` VALUES ('4', 'B');

-- ----------------------------
-- Table structure for syc_material_set
-- ----------------------------
DROP TABLE IF EXISTS `syc_material_set`;
CREATE TABLE `syc_material_set` (
  `msid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ms_pnid` char(30) NOT NULL COMMENT '产品系列',
  `ms_blname` char(30) NOT NULL COMMENT '板材名称',
  `ms_maname` char(30) NOT NULL COMMENT '材料属性',
  `ms_baobian` char(30) NOT NULL COMMENT '包边线',
  `ms_gl` char(255) NOT NULL COMMENT '关联料型',
  `ms_uid` int(10) NOT NULL COMMENT '添加员',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`msid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='原料设定表';

-- ----------------------------
-- Records of syc_material_set
-- ----------------------------
INSERT INTO `syc_material_set` VALUES ('3', 'P', '801', 'Y', '双包边', '18:0.5,19:1.5,20:2,21:2.5,22:3,23:1,24:1', '1', '1512127148', '1512127148', '1');
INSERT INTO `syc_material_set` VALUES ('4', 'P', '801', 'Y', '单包边', '18:0.5,19:1.5,20:2', '1', '1512128732', '1512128732', '1');

-- ----------------------------
-- Table structure for syc_order
-- ----------------------------
DROP TABLE IF EXISTS `syc_order`;
CREATE TABLE `syc_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `con_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '客户id',
  `order_sn` varchar(50) NOT NULL DEFAULT '' COMMENT '报价单号',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `company_short` varchar(255) NOT NULL DEFAULT '',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `order_remark` text,
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '-1已删除，0未确认，1已确认，2已交货，3已完成，4已取消，5已创建',
  `require_time` int(10) unsigned NOT NULL DEFAULT '0',
  `deliver_time` int(10) unsigned NOT NULL DEFAULT '0',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_sn` (`order_sn`,`company_name`,`company_short`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_order
-- ----------------------------
INSERT INTO `syc_order` VALUES ('3', '2', '5', '1686', 'SO201808175224240824', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '小米手机iPhone6s 32G备注', '5', '1534521600', '0', '0.00', '1534478095', '1534478095');
INSERT INTO `syc_order` VALUES ('4', '2', '5', '1686', 'SO201808175810100810', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '测试商品备注', '4', '1534694400', '0', '0.00', '1534478315', '1534478315');
INSERT INTO `syc_order` VALUES ('5', '2', '6', '1686', 'SO201808173345450845', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '备注备注备注备注备注备注备注备注', '5', '1535558400', '0', '0.00', '1534487649', '1534498451');
INSERT INTO `syc_order` VALUES ('6', '2', '6', '1686', 'SO201808173919190819', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '测试商品备注', '1', '1535385600', '0', '0.00', '1534487978', '1534498476');
INSERT INTO `syc_order` VALUES ('7', '2', '6', '1686', 'SO201808172553530853', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '小米手机iPhone6s 32G备注', '1', '1535299200', '0', '0.00', '1534494392', '1534496643');
INSERT INTO `syc_order` VALUES ('8', '2', '5', '1686', 'SO201808215917170817', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '23132', '0', '1534953600', '0', '17805.00', '1534841989', '1534948062');
INSERT INTO `syc_order` VALUES ('9', '2', '5', '1686', 'SO201808222802020802', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '23132', '0', '1535126400', '0', '24.00', '1534948109', '1534948109');

-- ----------------------------
-- Table structure for syc_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_order_goods`;
CREATE TABLE `syc_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下单数量',
  `send_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已送数量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际单价',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '标准单价',
  `goods_attr` text,
  `remark` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_order_goods
-- ----------------------------
INSERT INTO `syc_order_goods` VALUES ('10', '3', '4', '小米手机iPhone6s 32G', '台', '10', '0', '2199.00', '2199.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '小米手机iPhone6s 32G备注', '1534478095');
INSERT INTO `syc_order_goods` VALUES ('12', '4', '6', '测试商品2', '台', '1', '0', '3899.00', '3999.00', '[]', '备注备注备注备注备注备注备注备注', '1534478315');
INSERT INTO `syc_order_goods` VALUES ('13', '4', '1', '测试商品', '台', '1', '0', '2999.00', '3399.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u9ed1\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G+\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e09\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '测试商品备注', '1534478315');
INSERT INTO `syc_order_goods` VALUES ('14', '5', '6', '测试商品2', '台', '10', '0', '3899.00', '3999.00', '[]', '备注备注备注备注备注备注备注备注', '1534487649');
INSERT INTO `syc_order_goods` VALUES ('15', '6', '1', '测试商品', '台', '2', '0', '2999.00', '3399.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u9ed1\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G+\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e09\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '测试商品备注', '1534487978');
INSERT INTO `syc_order_goods` VALUES ('16', '7', '1', '测试商品', '台', '2', '0', '2999.00', '3399.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u9ed1\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G+\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e09\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '测试商品备注', '1534494392');
INSERT INTO `syc_order_goods` VALUES ('18', '7', '4', '小米手机iPhone6s 32G', '台', '5', '0', '1999.00', '2199.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '小米手机iPhone6s 32G备注', '1534496644');
INSERT INTO `syc_order_goods` VALUES ('19', '8', '4', '小米手机iPhone6s 32G', '台', '5', '1', '1999.00', '2199.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '小米手机iPhone6s 32G备注', '1534841989');
INSERT INTO `syc_order_goods` VALUES ('21', '8', '6', '测试商品2', '台', '2', '0', '3899.00', '3999.00', '[]', '备注备注备注备注备注备注备注备注', '1534842166');
INSERT INTO `syc_order_goods` VALUES ('22', '8', '2', 'fsafsa', '件', '1', '0', '12.00', '12112.00', '[]', '23132', '1534842624');
INSERT INTO `syc_order_goods` VALUES ('23', '9', '2', 'fsafsa', '件', '2', '0', '12.00', '12112.00', '[]', '23132', '1534948109');

-- ----------------------------
-- Table structure for syc_others_baobian
-- ----------------------------
DROP TABLE IF EXISTS `syc_others_baobian`;
CREATE TABLE `syc_others_baobian` (
  `bid` int(6) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `bname` char(16) NOT NULL DEFAULT '' COMMENT '分类',
  `bval` char(16) NOT NULL COMMENT '单边',
  `bamo` decimal(5,0) NOT NULL DEFAULT '0' COMMENT '单边线金额',
  `qhjc` char(16) NOT NULL DEFAULT '0' COMMENT '墙厚基础',
  `qhdz` char(16) NOT NULL DEFAULT '0' COMMENT '递增墙厚',
  `qhdzamo` decimal(5,0) NOT NULL DEFAULT '0' COMMENT '递增金额',
  `bremark` char(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='其他属性-包边线设置';

-- ----------------------------
-- Records of syc_others_baobian
-- ----------------------------
INSERT INTO `syc_others_baobian` VALUES ('1', '包边A类', '单包边', '0', '0', '0', '0', '');
INSERT INTO `syc_others_baobian` VALUES ('2', '包边A类', '双包边', '200', '180', '100', '66', '');
INSERT INTO `syc_others_baobian` VALUES ('3', '包边B类', '单包边', '0', '150', '60', '30', '');
INSERT INTO `syc_others_baobian` VALUES ('4', '包边B类', '双包边', '30', '150', '60', '30', '');

-- ----------------------------
-- Table structure for syc_others_thick
-- ----------------------------
DROP TABLE IF EXISTS `syc_others_thick`;
CREATE TABLE `syc_others_thick` (
  `otid` int(6) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `otname` char(16) NOT NULL DEFAULT '' COMMENT '属性',
  `otgu` decimal(5,0) NOT NULL DEFAULT '0' COMMENT '固额',
  `otval` char(16) NOT NULL DEFAULT '' COMMENT '间值',
  `otamo` decimal(5,0) NOT NULL DEFAULT '0' COMMENT '金额',
  `otremark` char(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`otid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='其他属性-厚度单价';

-- ----------------------------
-- Records of syc_others_thick
-- ----------------------------
INSERT INTO `syc_others_thick` VALUES ('1', '150', '30', '60', '30', '');
INSERT INTO `syc_others_thick` VALUES ('2', '180', '200', '100', '66', '');

-- ----------------------------
-- Table structure for syc_params
-- ----------------------------
DROP TABLE IF EXISTS `syc_params`;
CREATE TABLE `syc_params` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `desc` text,
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `params_value` text,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1文本显示',
  `file` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_params
-- ----------------------------
INSERT INTO `syc_params` VALUES ('1', '付款方式', '付款方式', '10', '现金交易\n月结30天\n月结60天\n月结90天\n月结180天', '0', '');
INSERT INTO `syc_params` VALUES ('5', '交易类别', '交易类别', '50', '内销\n外销', '0', '');
INSERT INTO `syc_params` VALUES ('7', '部门', '部门', '50', '销售部\n采购部\n工作部\n生产部\n仓储物流部', '0', '');
INSERT INTO `syc_params` VALUES ('8', '业务经理', '业务经理', '50', '彭立新', '0', '');
INSERT INTO `syc_params` VALUES ('9', '单位', '单位', '50', '张\n件\n个\n条\n包\n只\n台', '0', '');
INSERT INTO `syc_params` VALUES ('10', '跟单员', '跟单员', '50', '跟单员1\n跟单员2\n跟单员3', '0', '');
INSERT INTO `syc_params` VALUES ('11', '审核印章', '审核印章', '50', '审核印章', '2', '/uploads/20180814/0372ffd6312b9e66b13d820294021640.gif');
INSERT INTO `syc_params` VALUES ('12', 'PDF文件LOGO', 'PDF文件LOGO', '50', 'PDF文件LOGO', '2', '/uploads/20180814/512a803c3fca5bfe1928fb39d9f7746f.png');
INSERT INTO `syc_params` VALUES ('13', '报价单备注', '报价单备注', '50', '报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注\n报价单备注\n报价单备注', '1', '');
INSERT INTO `syc_params` VALUES ('14', 'PDF文件标题', 'PDF文件标题', '50', '众山化工有限公司', '1', '');
INSERT INTO `syc_params` VALUES ('15', 'PDF文件英文标题', 'PDF文件英文标题', '50', 'CSUN(SICHUAN) CHEMICAL CO.,LTD', '1', '');
INSERT INTO `syc_params` VALUES ('16', '交货方式', '交货方式', '50', '货运\n快递', '0', '');
INSERT INTO `syc_params` VALUES ('17', '税率', '税率', '50', '0%\n16%\n20%', '0', '');
INSERT INTO `syc_params` VALUES ('18', '采购单备注', '采购单备注', '50', '采购单备注采购单备注采购单备注采购单备注', '1', '');

-- ----------------------------
-- Table structure for syc_product_color
-- ----------------------------
DROP TABLE IF EXISTS `syc_product_color`;
CREATE TABLE `syc_product_color` (
  `pc_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pc_name` char(16) NOT NULL COMMENT '名称',
  `pc_user_nick` char(20) NOT NULL COMMENT '添加者',
  `pc_address` varchar(100) NOT NULL DEFAULT '' COMMENT '颜色产地',
  `pc_img` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `pc_description` varchar(255) NOT NULL DEFAULT '' COMMENT '简述',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`pc_id`),
  UNIQUE KEY `pc_name` (`pc_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='产品颜色表';

-- ----------------------------
-- Records of syc_product_color
-- ----------------------------
INSERT INTO `syc_product_color` VALUES ('22', '黄花梨', '1', '', '', '', '1509442079', '1509442079', '1');
INSERT INTO `syc_product_color` VALUES ('23', '金橡木', '1', '', '', '', '1509442092', '1509442092', '1');
INSERT INTO `syc_product_color` VALUES ('24', '红木', '1', '', '', '', '1509442570', '1509442570', '1');
INSERT INTO `syc_product_color` VALUES ('25', '黄花梨3', '1', '', '', '', '1510159234', '1510159234', '1');

-- ----------------------------
-- Table structure for syc_product_number
-- ----------------------------
DROP TABLE IF EXISTS `syc_product_number`;
CREATE TABLE `syc_product_number` (
  `pn_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pn_name` char(16) NOT NULL COMMENT '编号',
  `pn_price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `pn_baobian` char(16) NOT NULL COMMENT '包边线分类',
  `pn_user_nick` char(20) NOT NULL COMMENT '添加者',
  `pn_address` varchar(100) NOT NULL DEFAULT '' COMMENT '颜色产地',
  `pn_img` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `pn_description` varchar(255) NOT NULL DEFAULT '' COMMENT '简述',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`pn_id`),
  UNIQUE KEY `pn_name` (`pn_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='产品系列表';

-- ----------------------------
-- Records of syc_product_number
-- ----------------------------
INSERT INTO `syc_product_number` VALUES ('1', 'P', '780.00', '包边B类', '1', '', '/uploads/images/20170914/3242614c7efdfcd1f122cf32202115a2.jpg', '编号简述', '1505318622', '1508216195', '1');
INSERT INTO `syc_product_number` VALUES ('2', 'P10', '750.00', '包边B类', '1', '', '', '', '1505319213', '1508216183', '1');
INSERT INTO `syc_product_number` VALUES ('3', 'P20', '500.00', '包边A类', '1', '', '', '编号简述', '1505929197', '1508216189', '1');
INSERT INTO `syc_product_number` VALUES ('4', 'Y', '380.00', '包边A类', '1', '', '', '', '1508061095', '1508216176', '1');
INSERT INTO `syc_product_number` VALUES ('5', 's', '380.00', '包边A类', '1', '', '', '', '1508216262', '1508216262', '1');

-- ----------------------------
-- Table structure for syc_purchase
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase`;
CREATE TABLE `syc_purchase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(100) NOT NULL DEFAULT '',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0',
  `po_sn` varchar(100) NOT NULL DEFAULT '',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_phome` varchar(50) NOT NULL DEFAULT '',
  `transaction_type` varchar(100) NOT NULL DEFAULT '',
  `payment` varchar(100) NOT NULL DEFAULT '',
  `delivery_type` varchar(100) NOT NULL DEFAULT '',
  `delivery_company` varchar(255) NOT NULL DEFAULT '',
  `tax` varchar(20) NOT NULL DEFAULT '',
  `delivery_address` varchar(255) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '-1已删除，0保存，1已确认，2确认已发送',
  `is_cancel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已取消关联订单',
  `remark` text,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`order_sn`,`po_sn`,`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_purchase
-- ----------------------------
INSERT INTO `syc_purchase` VALUES ('5', '2', '3', 'SO201808175224240824', '1686', 'PO201808192023230823', '1', '020-89898989', '外销', '月结30天', '货运', '送货公司送货公司', '16%', '广东省广州市天河区中山大道西1025号', '020-89898989', '354575573@qq.com', 'nice172', '10395.00', '0', '1', 'faf', '1534648851', '1534746896');
INSERT INTO `syc_purchase` VALUES ('6', '2', '5', 'SO201808173345450845', '1686', 'PO201808200237370837', '1', '020-89898989', '外销', '月结30天', '货运', '送货公司名称', '20%', '广州市天河区中山大道西1025号', '020-89898989', '354575573@qq.com', 'nice172', '38990.00', '1', '0', '采购单备注采购单备注采购单备注采购单备注', '1534734198', '1534734198');
INSERT INTO `syc_purchase` VALUES ('7', '2', '8', 'SO201808215917170817', '1686', 'PO201808211221210821', '1', '020-89898989', '内销', '月结60天', '快递', '测试送货公司', '20%', '广东省广州市天河区中山大道西1025号', '020-89898989', '354575573@qq.com', 'nice172', '11808.00', '1', '0', '采购单备注采购单备注采购单备注采购单备注测试送货公司', '1534842814', '1534842814');

-- ----------------------------
-- Table structure for syc_purchase_affirm
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase_affirm`;
CREATE TABLE `syc_purchase_affirm` (
  `aid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `a_pnumber` char(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `a_affirm` tinyint(2) NOT NULL DEFAULT '1' COMMENT '确认1为确认',
  `a_img` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `a_remark` char(200) NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_ip` char(16) NOT NULL DEFAULT '' COMMENT '添加IP',
  `update_ip` char(16) NOT NULL DEFAULT '' COMMENT '更新IP',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单确认附表内容图片';

-- ----------------------------
-- Records of syc_purchase_affirm
-- ----------------------------

-- ----------------------------
-- Table structure for syc_purchase_bak
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase_bak`;
CREATE TABLE `syc_purchase_bak` (
  `pid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pnumber` char(20) NOT NULL COMMENT '订单号',
  `pcus_id` int(12) NOT NULL COMMENT '企业ID',
  `pbname` char(80) NOT NULL COMMENT '企业名称',
  `pcsname` char(20) NOT NULL COMMENT '客户名称',
  `pyouhui` tinyint(4) NOT NULL DEFAULT '100' COMMENT '订单优惠',
  `pamount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `pcount` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单数量',
  `pstart_date` date NOT NULL COMMENT '销售日期',
  `pend_date` date NOT NULL COMMENT '发货日期',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `affirm` tinyint(4) NOT NULL DEFAULT '0' COMMENT '确认1为确认',
  `pshengcwc` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1生产完成',
  `pshoudj` tinyint(4) NOT NULL DEFAULT '0' COMMENT '定金1为定金',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pnumber` (`pnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='销售订单表';

-- ----------------------------
-- Records of syc_purchase_bak
-- ----------------------------

-- ----------------------------
-- Table structure for syc_purchase_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase_goods`;
CREATE TABLE `syc_purchase_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '采购数量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际单价',
  `count_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goods_attr` text,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_purchase_goods
-- ----------------------------
INSERT INTO `syc_purchase_goods` VALUES ('23', '5', '4', '小米手机iPhone6s 32G', '台', '2', '2199.00', '4398.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '1534648851');
INSERT INTO `syc_purchase_goods` VALUES ('25', '6', '6', '测试商品2', '台', '10', '3899.00', '38990.00', '[]', '1534734198');
INSERT INTO `syc_purchase_goods` VALUES ('26', '7', '4', '小米手机iPhone6s 32G', '台', '2', '1999.00', '3998.00', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '1534842814');
INSERT INTO `syc_purchase_goods` VALUES ('27', '7', '6', '测试商品2', '台', '2', '3899.00', '7798.00', '[]', '1534842814');
INSERT INTO `syc_purchase_goods` VALUES ('28', '7', '2', 'fsafsa', '件', '1', '12.00', '12.00', '[]', '1534842815');

-- ----------------------------
-- Table structure for syc_purchase_orders
-- ----------------------------
DROP TABLE IF EXISTS `syc_purchase_orders`;
CREATE TABLE `syc_purchase_orders` (
  `oid` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `xuhao` tinyint(4) NOT NULL DEFAULT '0' COMMENT '序号',
  `ord_pnumber` char(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `yanse` char(10) NOT NULL DEFAULT '' COMMENT '产品颜色',
  `products` char(10) NOT NULL DEFAULT '' COMMENT '编号系列',
  `chanph` char(20) NOT NULL DEFAULT '0' COMMENT '编号数字',
  `breadth` char(20) NOT NULL DEFAULT '' COMMENT '规格-宽',
  `heiget` char(10) NOT NULL DEFAULT '' COMMENT '规格-高',
  `mianji` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '计算面积',
  `thick` char(10) NOT NULL DEFAULT '' COMMENT '规格-厚',
  `diaojiao` char(50) NOT NULL DEFAULT '' COMMENT '吊脚高度',
  `attribute` char(50) NOT NULL DEFAULT '' COMMENT '包边线属性',
  `baobian` char(100) NOT NULL DEFAULT '' COMMENT '包边线名称',
  `suoxiang` char(100) NOT NULL DEFAULT '' COMMENT '锁向',
  `fittings` char(100) NOT NULL DEFAULT '' COMMENT '锁具',
  `quantity` char(100) NOT NULL DEFAULT '' COMMENT '数量',
  `unitPrice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `remark` char(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COMMENT='销售订单_产品附表';

-- ----------------------------
-- Records of syc_purchase_orders
-- ----------------------------
INSERT INTO `syc_purchase_orders` VALUES ('64', '1', '10364079354', '黄花梨', 'P10', '36', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁外开', '白至尊', '2', '1685.00', '3370.00', '备注1');
INSERT INTO `syc_purchase_orders` VALUES ('65', '2', '10364079354', '红木3', 'P10', '20', '850', '2000', '1.80', '250', '25', '', '双包边', '左锁外开', '白至尊', '3', '1735.00', '1735.00', '212');
INSERT INTO `syc_purchase_orders` VALUES ('67', '1', '10364078967', '黄花梨', 'P', '36', '100', '1900', '1.80', '200', '20', '', '单包边', '左锁外开', '至尊锁', '1', '1724.00', '1724.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('68', '1', '10364076395', '红木', 'P10', '36', '850', '1980', '1.80', '220', '20', '', '单包边', '左锁外开', '白至尊', '5', '1685.00', '8425.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('69', '1', '10364099578', '黄花梨', 'P', '20', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁内开', '白至尊', '1', '1659.00', '1659.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('70', '1', '20171102762', '黄花梨', 'P', '20', '880', '1980', '1.80', '200', '20', '', '单包边', '左锁外开', '白至尊', '1', '1492.12', '1492.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('71', '1', '20171102946', '金橡木', 'P10', '20', '880', '1900', '1.80', '200', '20', '', '双包边', '右锁内开', '白至尊', '1', '1468.00', '1468.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('72', '1', '20171102456', '红木', 's', '20', '880', '1900', '1.80', '200', '20', '', '双包边', '右锁内开', '白至尊', '1', '1006.52', '1006.52', '');
INSERT INTO `syc_purchase_orders` VALUES ('73', '1', '20171108247', '黄花梨', 'P10', '10', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁外开', '白至尊', '1', '1438.00', '1438.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('74', '1', '20171120210', '黄花梨', 'P', '801', '880', '2000', '1.80', '200', '20', '', '双包边', '左锁外开', '白至尊', '1', '1522.12', '1522.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('75', '2', '20171120210', '红木', 'P20', '902', '900', '2050', '1.85', '200', '20', '', '单包边', '左锁内开', '至尊锁', '1', '982.50', '982.50', '');
INSERT INTO `syc_purchase_orders` VALUES ('77', '1', '20171120179', '黄花梨', 'P', '801', '800', '1980', '1.80', '200', '20', '', '单包边', '左锁内开', '白至尊', '1', '1492.12', '1492.12', '001');
INSERT INTO `syc_purchase_orders` VALUES ('78', '1', '20171122139', '黄花梨', 'P20', '902', '880', '1999', '1.80', '200', '20', '', '双包边', '左锁内开', '白至尊', '1', '1223.00', '1223.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('79', '1', '20171124237', '金橡木', 'Y', '801', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁外开', '白至尊', '1', '740.52', '740.52', '');
INSERT INTO `syc_purchase_orders` VALUES ('80', '1', '20171124168', '金橡木', 'P', '801D', '800', '1900', '1.80', '200', '20', '', '单包边', '左锁内开', '白至尊', '1', '1492.12', '1492.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('81', '2', '20171124168', '金橡木', 'P', '801d', '800', '1900', '1.80', '200', '20', '', '双包边', '左锁外开', '至尊锁', '1', '1527.12', '1527.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('87', '1', '20171201520', '黄花梨', 'P', '801', '800', '1900', '1.80', '200', '20', 'Y', '双包边', '左锁内开', '白至尊', '1', '1519.00', '1519.00', '');
INSERT INTO `syc_purchase_orders` VALUES ('88', '1', '20171202965', '金橡木', 'P', '801', '800', '1990', '1.80', '200', '20', 'Y', '单包边', '左锁外开', '至尊锁', '1', '1497.12', '1497.12', '');
INSERT INTO `syc_purchase_orders` VALUES ('110', '1', '20180109670', '黄花梨', 'P', '801', '800', '1900', '1.80', '200', '-', '-', '-', '-', '-', '1', '1407.12', '1407.12', '备注2备注2备注2备注2备注2');
INSERT INTO `syc_purchase_orders` VALUES ('111', '2', '20180109670', '金橡木', 'P', '801', '810', '1950', '1.80', '200', '-', '-', '-', '-', '-', '1', '1407.12', '1407.12', '备注2');
INSERT INTO `syc_purchase_orders` VALUES ('112', '3', '20180109670', '红木', 'P', '801', '820', '1960', '1.80', '200', '-', '-', '-', '-', '-', '1', '1407.12', '1407.12', '备注3');
INSERT INTO `syc_purchase_orders` VALUES ('113', '4', '20180109670', '黄花梨3', 'P', '801', '850', '2000', '1.80', '200', '-', '-', '-', '-', '-', '1', '1407.12', '1407.12', '备注4');

-- ----------------------------
-- Table structure for syc_statistics
-- ----------------------------
DROP TABLE IF EXISTS `syc_statistics`;
CREATE TABLE `syc_statistics` (
  `pay_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pay_cus_id` int(10) NOT NULL COMMENT '企业ID',
  `pay_pbname` char(50) NOT NULL COMMENT '企业名称',
  `pay_pnumber` char(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `pay_pcount` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订数量',
  `pay_pyouhui` tinyint(4) NOT NULL DEFAULT '100' COMMENT '订单优惠',
  `pay_shijine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '实际金额',
  `pay_ddanjine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `pay_yhuijine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `pay_sshoujine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `pay_wshoujine` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '未收金额',
  `pay_jueklv` decimal(4,2) NOT NULL DEFAULT '0.00' COMMENT '结款率',
  `pay_pstart_date` date NOT NULL COMMENT '销售日期',
  `pay_pend_date` date NOT NULL COMMENT '发货日期',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='完成订单统计';

-- ----------------------------
-- Records of syc_statistics
-- ----------------------------

-- ----------------------------
-- Table structure for syc_stockpile
-- ----------------------------
DROP TABLE IF EXISTS `syc_stockpile`;
CREATE TABLE `syc_stockpile` (
  `sp_id` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sp_pcid` int(10) NOT NULL DEFAULT '0' COMMENT '产品颜色ID',
  `sp_lxid` int(10) NOT NULL DEFAULT '0' COMMENT '料型ID',
  `sp_quantity` char(10) NOT NULL DEFAULT '0' COMMENT '数量',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='库存数量表';

-- ----------------------------
-- Records of syc_stockpile
-- ----------------------------
INSERT INTO `syc_stockpile` VALUES ('26', '24', '18', '0', '1512126620', '1512126620', '1');
INSERT INTO `syc_stockpile` VALUES ('27', '23', '18', '-0.5', '1512126620', '1512126620', '1');
INSERT INTO `syc_stockpile` VALUES ('28', '22', '18', '-0.5', '1512126620', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('29', '25', '18', '0', '1512126620', '1512126620', '1');
INSERT INTO `syc_stockpile` VALUES ('30', '24', '19', '0', '1512126678', '1512126678', '1');
INSERT INTO `syc_stockpile` VALUES ('31', '23', '19', '-1.5', '1512126678', '1512126678', '1');
INSERT INTO `syc_stockpile` VALUES ('32', '22', '19', '-1.5', '1512126678', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('33', '25', '19', '0', '1512126678', '1512126678', '1');
INSERT INTO `syc_stockpile` VALUES ('34', '24', '20', '0', '1512126714', '1512126714', '1');
INSERT INTO `syc_stockpile` VALUES ('35', '23', '20', '-2', '1512126714', '1512126714', '1');
INSERT INTO `syc_stockpile` VALUES ('36', '22', '20', '-2', '1512126714', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('37', '25', '20', '0', '1512126714', '1512126714', '1');
INSERT INTO `syc_stockpile` VALUES ('38', '24', '21', '0', '1512126926', '1512126926', '1');
INSERT INTO `syc_stockpile` VALUES ('39', '23', '21', '0', '1512126926', '1512126926', '1');
INSERT INTO `syc_stockpile` VALUES ('40', '22', '21', '-2.5', '1512126926', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('41', '25', '21', '0', '1512126926', '1512126926', '1');
INSERT INTO `syc_stockpile` VALUES ('42', '24', '22', '0', '1512126956', '1512126956', '1');
INSERT INTO `syc_stockpile` VALUES ('43', '23', '22', '0', '1512126956', '1512126956', '1');
INSERT INTO `syc_stockpile` VALUES ('44', '22', '22', '-3', '1512126956', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('45', '25', '22', '0', '1512126956', '1512126956', '1');
INSERT INTO `syc_stockpile` VALUES ('46', '24', '23', '0', '1512126984', '1512126984', '1');
INSERT INTO `syc_stockpile` VALUES ('47', '23', '23', '0', '1512126984', '1512126984', '1');
INSERT INTO `syc_stockpile` VALUES ('48', '22', '23', '-1', '1512126984', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('49', '25', '23', '0', '1512126984', '1512126984', '1');
INSERT INTO `syc_stockpile` VALUES ('50', '24', '24', '0', '1512127012', '1512127012', '1');
INSERT INTO `syc_stockpile` VALUES ('51', '23', '24', '0', '1512127012', '1512127012', '1');
INSERT INTO `syc_stockpile` VALUES ('52', '22', '24', '-1', '1512127012', '1512128864', '1');
INSERT INTO `syc_stockpile` VALUES ('53', '25', '24', '0', '1512127012', '1512127012', '1');

-- ----------------------------
-- Table structure for syc_stockpile_lock
-- ----------------------------
DROP TABLE IF EXISTS `syc_stockpile_lock`;
CREATE TABLE `syc_stockpile_lock` (
  `stid` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `st_lid` int(10) NOT NULL COMMENT '锁具',
  `st_quantity` int(6) NOT NULL DEFAULT '0' COMMENT '数量',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`stid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='配件锁具库存表';

-- ----------------------------
-- Records of syc_stockpile_lock
-- ----------------------------
INSERT INTO `syc_stockpile_lock` VALUES ('1', '1', '-1', '1507531190', '1512128850', '1');
INSERT INTO `syc_stockpile_lock` VALUES ('2', '2', '-1', '1511074473', '1512126762', '1');

-- ----------------------------
-- Table structure for syc_storage_charge
-- ----------------------------
DROP TABLE IF EXISTS `syc_storage_charge`;
CREATE TABLE `syc_storage_charge` (
  `lxid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `lxxhao` char(20) NOT NULL COMMENT '料型型号',
  `lxname` char(30) NOT NULL COMMENT '料型名称',
  `lxkg` char(20) NOT NULL DEFAULT '0' COMMENT 'KG/M',
  `lxzhic` char(20) NOT NULL DEFAULT '0' COMMENT '支长/M',
  `lximg` varchar(250) NOT NULL DEFAULT '' COMMENT '图片',
  `lx_uid` int(10) NOT NULL COMMENT '添加员',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`lxid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='料型名称表';

-- ----------------------------
-- Records of syc_storage_charge
-- ----------------------------
INSERT INTO `syc_storage_charge` VALUES ('18', 'H-02', '反包边', '1.085', '5.3', '', '1', '1512126620', '1512126620', '1');
INSERT INTO `syc_storage_charge` VALUES ('19', 'H-07', '扇光企', '0.889', '5.9', '', '1', '1512126678', '1512126678', '1');
INSERT INTO `syc_storage_charge` VALUES ('20', 'H-05', '门芯框', '0.663', '6', '', '1', '1512126714', '1512126714', '1');
INSERT INTO `syc_storage_charge` VALUES ('21', 'H-09', '光企盖', '0.14', '5.9', '', '1', '1512126926', '1512126926', '1');
INSERT INTO `syc_storage_charge` VALUES ('22', 'H-10', '墙扣板', '0.58', '5', '', '1', '1512126956', '1512126956', '1');
INSERT INTO `syc_storage_charge` VALUES ('23', 'H-08', '扣板槽', '0.16', '5', '', '1', '1512126984', '1512126984', '1');
INSERT INTO `syc_storage_charge` VALUES ('24', 'H-06', '包边座', '0.45', '5.4', '', '1', '1512127012', '1512127012', '1');

-- ----------------------------
-- Table structure for syc_supplier
-- ----------------------------
DROP TABLE IF EXISTS `syc_supplier`;
CREATE TABLE `syc_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `default_con_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '默认联系人',
  `supplier_name` varchar(255) NOT NULL DEFAULT '',
  `supplier_short` varchar(255) NOT NULL DEFAULT '',
  `supplier_mobile` char(12) NOT NULL DEFAULT '',
  `supplier_contacts` varchar(50) NOT NULL DEFAULT '',
  `supplier_email` varchar(50) NOT NULL DEFAULT '',
  `supplier_post` varchar(100) NOT NULL DEFAULT '',
  `supplier_status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0禁用',
  `supplier_qq` varchar(12) NOT NULL DEFAULT '',
  `supplier_like` varchar(255) NOT NULL DEFAULT '',
  `supplier_payment` varchar(100) NOT NULL DEFAULT '',
  `supplier_province` varchar(50) NOT NULL DEFAULT '',
  `supplier_city` varchar(50) NOT NULL DEFAULT '',
  `supplier_area` varchar(50) NOT NULL DEFAULT '',
  `supplier_address` varchar(255) NOT NULL DEFAULT '',
  `supplier_remark` text,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `add_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加UID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_supplier
-- ----------------------------
INSERT INTO `syc_supplier` VALUES ('1', '0', '供应商名称', '简称', '13800138000', '联系人', '353575573@qq.com', '部门职务', '1', '353575573', 'php', '现金交易', '广东省', '广州市', '天河区', '详细地址1', '备注内容备注内容备注内容', '1533632664', '1533636165', '2');

-- ----------------------------
-- Table structure for syc_supplier_contacts
-- ----------------------------
DROP TABLE IF EXISTS `syc_supplier_contacts`;
CREATE TABLE `syc_supplier_contacts` (
  `con_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `supplier_id` int(10) NOT NULL COMMENT '客户ID',
  `con_name` char(16) NOT NULL COMMENT '姓名',
  `con_sex` tinyint(2) DEFAULT '1' COMMENT '性别1男0女',
  `con_post` char(20) NOT NULL DEFAULT '' COMMENT '职位',
  `con_section` varchar(255) NOT NULL DEFAULT '' COMMENT '部门',
  `con_mobile` char(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `con_qq` char(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `con_email` char(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `con_address` varchar(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `con_description` varchar(200) NOT NULL DEFAULT '' COMMENT '备注信息',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='客户联系人表';

-- ----------------------------
-- Records of syc_supplier_contacts
-- ----------------------------
INSERT INTO `syc_supplier_contacts` VALUES ('5', '1', 'nice172', '1', '开发者', '销售部', '13800138000', '354575573', '354575573@qq.com', '广东省广州市天河区中山大道西1025号', '客户备注内容', '1533614328', '1533614328', '1');
INSERT INTO `syc_supplier_contacts` VALUES ('6', '1', '蜡笔小新', '1', '仓管', '仓储物流部', '13800138001', '354575575', '354575573@qq.com', '广州市天河区中山大道西1025号', '备注蜡笔小新', '1533622131', '1533622131', '1');

-- ----------------------------
-- Table structure for syc_users
-- ----------------------------
DROP TABLE IF EXISTS `syc_users`;
CREATE TABLE `syc_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` char(16) NOT NULL COMMENT '名称',
  `user_password` char(255) NOT NULL COMMENT '密码',
  `user_nick` char(20) NOT NULL COMMENT '别名',
  `user_sex` tinyint(2) DEFAULT '1' COMMENT '性别1男0女',
  `user_email` char(50) NOT NULL COMMENT '邮件',
  `user_img` varchar(250) NOT NULL DEFAULT '' COMMENT '头像',
  `entry_time` char(10) DEFAULT NULL COMMENT '入职时间',
  `user_count` int(6) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `create_ip` char(16) NOT NULL DEFAULT '' COMMENT '注册IP',
  `update_ip` char(16) NOT NULL DEFAULT '' COMMENT '登录IP',
  `group_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_nick` (`user_nick`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Records of syc_users
-- ----------------------------
INSERT INTO `syc_users` VALUES ('1', 'asdasd', 'sha256:1000:X2vbzkCcKSScvZZ5ZUDs7DvTmergIc5u:fQt8UQynrp5psap5MoOq4scNMLNhcjIl', '开发者', '1', '354575573@qq.com', '/uploads/avatar/582d3a26a3369.jpg', '2017-01-01', '161', '1451577600', '1497704499', '127.0.0.1', '127.0.0.1', '16', '1');
INSERT INTO `syc_users` VALUES ('2', 'admin', 'sha256:1000:bb+qr8kui4m4JriYM/aLnznOODBwZfbi:30utxhFU7cxebnazg8Xh5TEkAmzR6ymJ', '管理员', '1', 'nice172@126.com', '', '2018-08-05', '19', '1533480247', '1533480247', '192.168.1.225', '', '16', '1');
INSERT INTO `syc_users` VALUES ('3', 'nice172', 'sha256:1000:GM0kcPbE+QNRSpmsG58qckJUkekhvpwi:XwmDtVMPAfE8DDYUdVW5DF5AOLljRm8q', '测试号', '1', 'nice172@163.com', '', '2018-08-06', '0', '1533526543', '1533526543', '10.10.0.99', '', '14', '1');
