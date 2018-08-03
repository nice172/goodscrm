/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : goods_crm

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-08-03 11:37:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for syc_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_group`;
CREATE TABLE `syc_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `rules` char(80) NOT NULL DEFAULT '' COMMENT '用户组的规则id',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='AUTH用户组表';

-- ----------------------------
-- Records of syc_auth_group
-- ----------------------------
INSERT INTO `syc_auth_group` VALUES ('1', '总经理室', '1,2', '1', '1');
INSERT INTO `syc_auth_group` VALUES ('2', '销售部', '', '1', '0');
INSERT INTO `syc_auth_group` VALUES ('3', '仓管部', '', '1', '0');
INSERT INTO `syc_auth_group` VALUES ('4', '财务部', '', '1', '0');
INSERT INTO `syc_auth_group` VALUES ('5', '生产部', '', '1', '0');
INSERT INTO `syc_auth_group` VALUES ('6', '测试部', '', '1', '0');

-- ----------------------------
-- Table structure for syc_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_group_access`;
CREATE TABLE `syc_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='AUTH用户组明细表';

-- ----------------------------
-- Records of syc_auth_group_access
-- ----------------------------
INSERT INTO `syc_auth_group_access` VALUES ('1', '1');
INSERT INTO `syc_auth_group_access` VALUES ('5', '2');
INSERT INTO `syc_auth_group_access` VALUES ('6', '2');
INSERT INTO `syc_auth_group_access` VALUES ('7', '3');
INSERT INTO `syc_auth_group_access` VALUES ('8', '1');
INSERT INTO `syc_auth_group_access` VALUES ('9', '1');
INSERT INTO `syc_auth_group_access` VALUES ('10', '1');
INSERT INTO `syc_auth_group_access` VALUES ('11', '3');
INSERT INTO `syc_auth_group_access` VALUES ('12', '1');
INSERT INTO `syc_auth_group_access` VALUES ('13', '1');

-- ----------------------------
-- Table structure for syc_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `syc_auth_rule`;
CREATE TABLE `syc_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `pid` tinyint(4) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '中文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '为1时，condition字段可以附加条件，反之无效',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则附件条件,满足附加条件的规则,才认为是有效的规则',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='AUTH规则表';

-- ----------------------------
-- Records of syc_auth_rule
-- ----------------------------
INSERT INTO `syc_auth_rule` VALUES ('1', '0', 'index/index/index', '控制台首页', '1', '1', '0');
INSERT INTO `syc_auth_rule` VALUES ('2', '0', 'index/cs/index', '测试页', '1', '1', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='基本配置表';

-- ----------------------------
-- Records of syc_config
-- ----------------------------
INSERT INTO `syc_config` VALUES ('1', 'syc_basehost', 'CRM站点', 'string', 'http://www.sycit.cn');
INSERT INTO `syc_config` VALUES ('2', 'syc_webname', '企业名称', 'string', '佛山市三叶草网络有限公司');
INSERT INTO `syc_config` VALUES ('3', 'syc_webtel', '电话', 'string', '0757-88888888');
INSERT INTO `syc_config` VALUES ('4', 'syc_webfax', '传真', 'string', '0757-88888888');
INSERT INTO `syc_config` VALUES ('5', 'syc_tousu', '投诉电话', 'string', '0757-88888888');
INSERT INTO `syc_config` VALUES ('6', 'syc_webemail', '邮件', 'string', 'hyzwd@outlook.com');
INSERT INTO `syc_config` VALUES ('7', 'syc_webqq', 'QQ', 'string', '316262448');
INSERT INTO `syc_config` VALUES ('8', 'syc_address', '地址', 'string', '广东省佛山市禅城区');
INSERT INTO `syc_config` VALUES ('9', 'syc_keywords', '关键词', 'bstring', '佛山市三叶草网络有限公司');
INSERT INTO `syc_config` VALUES ('10', 'syc_description', '描述', 'bstring', '佛山市三叶草网络有限公司');
INSERT INTO `syc_config` VALUES ('11', 'syc_powerby', '版权信息', 'bstring', 'Copyright © 2010-2017 <a href=\"http://www.sycit.cn\">佛山市三叶草网络有限公司</a> 版权所有');
INSERT INTO `syc_config` VALUES ('12', 'syc_beian', '备案信息', 'string', '');

-- ----------------------------
-- Table structure for syc_customers
-- ----------------------------
DROP TABLE IF EXISTS `syc_customers`;
CREATE TABLE `syc_customers` (
  `cus_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cus_con_id` int(10) NOT NULL DEFAULT '0' COMMENT '默认联系人ID',
  `cus_name` char(50) NOT NULL COMMENT '企业名称',
  `cus_duty` char(20) NOT NULL COMMENT '责任人',
  `cus_phome` char(20) NOT NULL COMMENT '座机',
  `cus_fax` char(20) NOT NULL COMMENT '传真',
  `cus_moble` char(20) NOT NULL COMMENT '手机号',
  `cus_email` char(20) NOT NULL COMMENT '邮箱',
  `cus_http` char(60) NOT NULL COMMENT '网址',
  `cus_code` char(20) NOT NULL COMMENT '邮编',
  `cus_prov` char(10) NOT NULL DEFAULT '' COMMENT '省份',
  `cus_city` char(10) NOT NULL DEFAULT '' COMMENT '城市',
  `cus_dist` char(10) NOT NULL DEFAULT '' COMMENT '县区',
  `cus_street` varchar(100) NOT NULL COMMENT '街道信息',
  `cus_log_id` int(10) NOT NULL DEFAULT '0' COMMENT '物流ID',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1680 DEFAULT CHARSET=utf8 COMMENT='客户信息表';

-- ----------------------------
-- Records of syc_customers
-- ----------------------------

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
  `con_phome` char(20) NOT NULL DEFAULT '' COMMENT '座机',
  `con_mobile` char(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `con_fax` char(20) NOT NULL DEFAULT '' COMMENT '传真',
  `con_qq` char(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `con_email` char(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `con_address` varchar(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `con_description` varchar(200) NOT NULL DEFAULT '' COMMENT '备注信息',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客户联系人表';

-- ----------------------------
-- Records of syc_customers_contact
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='销售订单表';

-- ----------------------------
-- Records of syc_purchase
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='订单确认附表内容图片';

-- ----------------------------
-- Records of syc_purchase_affirm
-- ----------------------------

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
-- Table structure for syc_users
-- ----------------------------
DROP TABLE IF EXISTS `syc_users`;
CREATE TABLE `syc_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` char(16) NOT NULL COMMENT '名称',
  `user_password` char(255) NOT NULL COMMENT '密码',
  `user_nick` char(20) NOT NULL COMMENT '别名',
  `user_sex` tinyint(2) DEFAULT '1' COMMENT '性别1男0女',
  `user_auth` tinyint(4) NOT NULL DEFAULT '0' COMMENT '管理组',
  `user_email` char(50) NOT NULL COMMENT '邮件',
  `user_img` varchar(250) NOT NULL DEFAULT '' COMMENT '头像',
  `entry_time` char(10) DEFAULT NULL COMMENT '入职时间',
  `user_count` int(6) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `create_ip` char(16) NOT NULL DEFAULT '' COMMENT '注册IP',
  `update_ip` char(16) NOT NULL DEFAULT '' COMMENT '登录IP',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_nick` (`user_nick`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Records of syc_users
-- ----------------------------
INSERT INTO `syc_users` VALUES ('1', 'asdasd', 'sha256:1000:X2vbzkCcKSScvZZ5ZUDs7DvTmergIc5u:fQt8UQynrp5psap5MoOq4scNMLNhcjIl', '隐士', '1', '1', 'hyzwd@outlook.com', '/uploads/avatar/582d3a26a3369.jpg', '2017-01-01', '154', '1451577600', '1497704499', '127.0.0.1', '127.0.0.1', '1');
