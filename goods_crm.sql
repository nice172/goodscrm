/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : goods_crm

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-09-05 18:09:24
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
INSERT INTO `syc_auth_group` VALUES ('16', '超级管理员', '1', '1501687648', '164,138,113,168,123,125', '126,131,133,165,166,167,139,141,142,114,173,172,174,171,170,169,124,135,136,137,143,134');
INSERT INTO `syc_auth_group` VALUES ('14', '普通管理员', '1', '1501686282', '177,205', '164,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,206,207,208,209,210,211,212,213,242,214');
INSERT INTO `syc_auth_group` VALUES ('15', '商品发布专员', '1', '1501687218', '0', '');
INSERT INTO `syc_auth_group` VALUES ('17', '订单处理专员', '1', '1501687779', '123,125', '124,134');
INSERT INTO `syc_auth_group` VALUES ('27', 'fdaf', '1', '1533462974', '', '');
INSERT INTO `syc_auth_group` VALUES ('19', '订单处理专员6ddd', '1', '1501687843', '164,138,113,168,123,125', '126,131,133,165,166,167,139,141,142,114,173,172,174,171,170,169,124,135,136,137,143,134');
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
) ENGINE=MyISAM AUTO_INCREMENT=292 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_auth_rule
-- ----------------------------
INSERT INTO `syc_auth_rule` VALUES ('177', '0', 'admin/system', '系统管理', '1', '1', '1', '', '2', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('164', '177', 'admin/config/index', '基本配置', '2', '1', '1', 'icon-ecs', '2', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('180', '177', 'admin/role/index', '角色管理', '2', '1', '1', 'icon-ecs', '3', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('181', '180', 'admin/role/add', '新增角色', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('182', '180', 'admin/role/edit', '修改角色', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('183', '180', 'admin/role/deleterole', '删除角色', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('184', '177', 'admin/users/index', '用户管理', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('185', '184', 'admin/users/add', '新增用户', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('186', '184', 'admin/users/edit', '修改用户', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('187', '184', 'admin/users/delete', '删除用户', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('188', '177', 'admin/auth/index', '权限管理', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('189', '188', 'admin/auth/rule_add', '添加节点', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('190', '188', 'admin/auth/node_status', '节点状态', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('191', '188', 'admin/auth/edit_node', '修改节点', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('192', '188', 'admin/auth/deletenode', '删除节点', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('193', '188', 'admin/auth/nodesort', '节点排序', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('194', '177', 'admin/goods/goods_type', '商品类型管理', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('195', '194', 'admin/goods/add_type', '新增类型', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('196', '194', 'admin/goods/typeparams', '属性列表', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('197', '194', 'admin/goods/edit_attr', '修改属性', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('198', '194', 'admin/goods/deleteattr', '删除属性', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('199', '194', 'admin/goods/add_attr', '新增属性', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('200', '194', 'admin/goods/deletetype', '删除类型', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('201', '194', 'admin/goods/updatetypename', '编辑类型名称', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('202', '177', 'admin/params/index', '系统参数管理', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('203', '202', 'admin/params/add', '新增参数', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('204', '202', 'admin/params/edit', '修改参数', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('205', '0', 'supplier/index', '供应商管理', '1', '1', '1', 'icon-ecs', '3', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('206', '205', 'admin/supplier/index', '供应商列表', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('207', '206', 'admin/supplier/add', '新增供应商', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('208', '206', 'admin/supplier/view', '供应商详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('209', '206', 'admin/supplier/product', '产品列表', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('210', '206', 'admin/supplier/edit', '修改供应商', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('211', '206', 'admin/supplier/delete', '删除供应商', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('212', '205', 'admin/goods/index', '商品维护', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('213', '212', 'admin/goods/index', '商品列表', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('214', '212', 'admin/goods/category', '商品分类', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('215', '0', 'admin/baojia', '报价管理', '1', '1', '1', 'icon-ecs', '5', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('216', '215', 'admin/baojia/index', '报价列表', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('217', '216', 'admin/baojia/add', '新增报价单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('218', '0', 'admin/cus', '客户管理', '1', '1', '1', 'icon-ecs', '4', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('219', '218', 'admin/customers/index', '客户信息', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('220', '219', 'admin/customers/add', '新增客户', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('221', '0', 'admin/order', '订单管理', '1', '1', '1', 'icon-ecs', '6', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('222', '221', 'admin/order/index', '订单列表', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('223', '222', 'admin/order/add', '新增订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('224', '221', 'admin/order/nodeliery', '未交货订单', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('225', '221', 'admin/order/finish', '完成订单', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('226', '0', 'admin/purchase', '采购管理', '1', '1', '1', 'icon-ecs', '7', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('227', '226', 'admin/purchase/index', '采购单', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('228', '227', 'admin/purchase/add', '新增采购单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('229', '0', 'admin/delivery', '送货管理', '1', '1', '1', 'icon-ecs', '8', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('230', '229', 'admin/delivery/index', '送货单', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('231', '230', 'admin/delivery/add', '新增送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('232', '0', 'admin/store', '库存管理', '1', '1', '1', 'icon-ecs', '9', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('233', '232', 'admin/store/relation', '关联库存', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('234', '232', 'admin/store/index', '库存盘点', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('235', '0', 'admin/account', '账务管理', '1', '1', '1', 'icon-ecs', '10', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('236', '235', 'admin/account/index', '应收账款', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('237', '236', 'admin/account/newcreate', '新建应收账款', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('238', '235', 'admin/account/payment', '应付账款', '2', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('239', '238', 'admin/account/payment', '应付账款列表', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('240', '238', 'admin/account/wait', '采购发票待处理', '3', '1', '1', 'icon-ecs', '50', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('241', '238', 'admin/account/create_payment', '创建对账单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('242', '213', 'admin/goods/add', '新增商品', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('244', '0', 'admin/index', '后台管理', '1', '1', '1', 'icon-ecs', '0', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('245', '244', 'admin/index/index', '后台首页', '2', '1', '1', 'icon-ecs', '1', '1', null);
INSERT INTO `syc_auth_rule` VALUES ('246', '184', 'admin/users/user_do', '新增提交', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('247', '184', 'admin/users/update', '修改提交', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('248', '213', 'admin/goods/goodsinfo', '商品详情', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('249', '213', 'admin/goods/goods_edit', '修改商品', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('250', '213', 'admin/goods/goodsdel', '删除商品', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('251', '214', 'admin/goods/addcategory', '新增分类', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('252', '214', 'admin/goods/updatecategory', '修改分类', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('253', '214', 'admin/goods/deletecategory', '删除分类', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('254', '206', 'admin/supplier/add_contacts', '添加联系人', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('255', '206', 'admin/supplier/delete', '删除供应商', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('256', '219', 'admin/customers/view', '客户详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('257', '219', 'admin/customers/edit', '修改客户信息', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('258', '216', 'admin/baojia/info', '报价单详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('259', '216', 'admin/baojia/send', '发送邮件', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('260', '216', 'admin/baojia/edit', '修改报价单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('261', '216', 'admin/baojia/delete', '删除报价单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('262', '222', 'admin/order/info', '订单详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('263', '222', 'admin/order/cancel', '取消订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('264', '222', 'admin/order/confirm', '确认订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('265', '222', 'admin/order/setfinish', '设置完成订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('266', '222', 'admin/order/create', '订单创建采购单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('267', '222', 'admin/order/edit', '修改订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('268', '222', 'admin/order/delete', '删除订单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('269', '227', 'admin/purchase/info', '采购单详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('270', '227', 'admin/purchase/record', '采购记录', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('271', '227', 'admin/purchase/confirm', '确认采购并发送邮件', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('272', '230', 'admin/delivery/info', '送货单详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('273', '230', 'admin/delivery/confirm', '确认送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('274', '230', 'admin/delivery/prints', '打印送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('275', '230', 'admin/delivery/edit', '修改送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('276', '230', 'admin/delivery/delete', '删除送货单', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('277', '233', 'admin/store/log', '查看记录', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('278', '233', 'admin/store/cancel', '取消关联', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('279', '234', 'admin/store/update_store', '修改库存', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('280', '236', 'admin/account/create', '新建应收账款', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('281', '236', 'admin/account/info', '应收账款详情', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('282', '236', 'admin/account/edit', '修改账款', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('283', '236', 'admin/account/open', '已开票', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('284', '236', 'admin/account/status', '已核销', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('285', '236', 'admin/account/close', '已关闭', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('286', '236', 'admin/account/delete', '删除账款', '3', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('287', '239', 'admin/account/payment_info', '账款详情', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('288', '239', 'admin/account/payment_edit', '修改账款', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('289', '239', 'admin/account/payment_open', '已开票', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('290', '239', 'admin/account/payment_status', '已对账', '4', '1', '1', 'icon-ecs', '50', '0', null);
INSERT INTO `syc_auth_rule` VALUES ('291', '239', 'admin/account/payment_delete', '删除账款', '4', '1', '1', 'icon-ecs', '50', '0', null);

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
  `send_email_time` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_sn` (`order_sn`,`company_name`,`company_short`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_baojia
-- ----------------------------
INSERT INTO `syc_baojia` VALUES ('1', '2', '1686', 'CS-Q-08/1311410841', '跟单员2', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', 'order_remarkorder_remarkorder_remarkorder_remarkorder_remarkorder_remark', '1', '0', '1534132387', '1534240032');
INSERT INTO `syc_baojia` VALUES ('2', '1', '1686', 'CS-Q-08/2914190819', '跟单员2', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注\n报价单备注\n报价单备注', '1', '1535526590', '1535525115', '1535526588');
INSERT INTO `syc_baojia` VALUES ('3', '1', '1686', 'CS-Q-08/2914370837', '跟单员3', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注\n报价单备注\n报价单备注', '1', '1535525333', '1535525328', '1535525328');
INSERT INTO `syc_baojia` VALUES ('4', '1', '1686', 'CS-Q-08/2915150815', '跟单员2', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注\n报价单备注\n报价单备注', '0', '0', '1535526956', '1535526956');
INSERT INTO `syc_baojia` VALUES ('5', '1', '1686', 'CS-Q-08/2915560856', '跟单员1', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n  报价单备注\n报价单备注\n报价单备注', '0', '1535527728', '1535527150', '1535610802');
INSERT INTO `syc_baojia` VALUES ('6', '1', '1686', 'CS-Q-08/29161805050805', '跟单员1', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注报价单备注报价单备注报价单备注\n报价单备注\n报价单备注\n报价单备注', '0', '0', '1535530694', '1535530694');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_baojia_goods
-- ----------------------------
INSERT INTO `syc_baojia_goods` VALUES ('1', '1', '4', '小米手机iPhone6s 32G', '台', '2199.00', '小米手机iPhone6s 32G备注', '1534132387');
INSERT INTO `syc_baojia_goods` VALUES ('6', '1', '6', '测试商品2', '台', '3999.00', '备注备注备注备注备注备注备注备注', '1534144452');
INSERT INTO `syc_baojia_goods` VALUES ('7', '1', '1', '测试商品', '台', '213.00', '商品备注', '1534144452');
INSERT INTO `syc_baojia_goods` VALUES ('8', '1', '2', 'fsafsa', '件', '12112.00', '23132', '1534144574');
INSERT INTO `syc_baojia_goods` VALUES ('9', '1', '5', 'gasafsdf', '台', '3123.00', '3122313', '1534144574');
INSERT INTO `syc_baojia_goods` VALUES ('10', '2', '4', '小米手机iPhone6s 32G', '台', '2199.00', '小米手机iPhone6s 32G备注', '1535525115');
INSERT INTO `syc_baojia_goods` VALUES ('11', '2', '8', 'FR4 1.4MM H/H 37\"*49\" 信息 技术', '台', '33.00', '123', '1535525115');
INSERT INTO `syc_baojia_goods` VALUES ('12', '2', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '312.00', '', '1535525115');
INSERT INTO `syc_baojia_goods` VALUES ('13', '3', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '312.00', '', '1535525328');
INSERT INTO `syc_baojia_goods` VALUES ('14', '4', '8', 'FR4 1.4MM H/H 37\"*49\" 信息 技术', '台', '33.00', '123', '1535526956');
INSERT INTO `syc_baojia_goods` VALUES ('15', '5', '4', '小米手机iPhone6s 32G', '台', '2199.00', '小米手机iPhone6s 32G备注', '1535527150');
INSERT INTO `syc_baojia_goods` VALUES ('16', '5', '1', '测试商品', '台', '3399.00', '测试商品备注', '1535527150');
INSERT INTO `syc_baojia_goods` VALUES ('17', '5', '8', 'FR4 1.4MM H/H 37\"*49\" 信息 技术', '台', '33.00', '123', '1535527150');
INSERT INTO `syc_baojia_goods` VALUES ('18', '5', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '312.00', '', '1535527150');
INSERT INTO `syc_baojia_goods` VALUES ('19', '6', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '312.00', '', '1535530694');

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
  `cus_sex` tinyint(2) NOT NULL DEFAULT '0',
  `cus_qq` varchar(255) NOT NULL DEFAULT '',
  `cus_street` varchar(100) NOT NULL DEFAULT '' COMMENT '街道信息',
  `create_time` int(16) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(16) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1688 DEFAULT CHARSET=utf8 COMMENT='客户信息表';

-- ----------------------------
-- Records of syc_customers
-- ----------------------------
INSERT INTO `syc_customers` VALUES ('1686', '5', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '020-89898989', '13800138000', '354575573@qq.com', '彭立新', '跟单员2', 'PHP', '广东省', '广州市', '天河区', '工作部', '0', '354575573', '中山大道西1025号', '1533614328', '1533614328', '1');
INSERT INTO `syc_customers` VALUES ('1687', '0', 'fdsafff', 'fsafafafd', '', 'fdsfsaffa', '', '', '', '0', '', '', '北京市', '东城区', '', '0', '-1', '', '', '1535615508', '1535615508', '-1');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='客户联系人表';

-- ----------------------------
-- Records of syc_customers_contact
-- ----------------------------
INSERT INTO `syc_customers_contact` VALUES ('5', '1686', 'nice172', '1', '开发者', '销售部', '13800138000', '354575573', '354575573@qq.com', '广东省广州市天河区中山大道西1025号', '客户备注内容', '1533614328', '1533614328', '1');
INSERT INTO `syc_customers_contact` VALUES ('6', '1686', '蜡笔小新', '1', '仓管', '仓储物流部', '13800138001', '354575575', '354575575@qq.com', '广州市天河区中山大道西1025号', '备注蜡笔小新', '1533622131', '1533622131', '1');
INSERT INTO `syc_customers_contact` VALUES ('7', '1686', 'fdsafa', '1', 'fdsafsaf', '采购部', '13800138000', 'fsafdsadf', 'fsdafa', 'fdsafsa', 'fsadf', '1533623950', '1533624036', '-1');
INSERT INTO `syc_customers_contact` VALUES ('8', '1687', '', '-1', '', '0', '', '', '', '北京市东城区', '', '1535615508', '1535615524', '-1');

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
INSERT INTO `syc_customers_message` VALUES ('1687', '');

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
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `unit` varchar(100) NOT NULL DEFAULT '',
  `goods_attr` text,
  `current_send_number` int(10) unsigned NOT NULL DEFAULT '0',
  `add_number` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` text,
  PRIMARY KEY (`id`),
  KEY `delivery_id` (`delivery_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_delivery_goods
-- ----------------------------
INSERT INTO `syc_delivery_goods` VALUES ('31', '27', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '312.00', '包', '[]', '5', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('32', '28', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '312.00', '包', '[]', '5', '0', '');
INSERT INTO `syc_delivery_goods` VALUES ('33', '29', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '312.00', '包', '[]', '5', '0', '');

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
  `is_confirm` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1确认',
  `is_print` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已打印',
  `is_invoice` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已开票',
  `is_payment` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已创建应付账款',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`,`order_id`,`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_delivery_order
-- ----------------------------
INSERT INTO `syc_delivery_order` VALUES ('27', '2', '24', 'DN201809012405050905', 'PO201809012331310931', '2018-09-26', '2018-09-01', '3120.00', '26', 'SO201809012308080908', '广州市进销传系统有限公司', '1686', '联系人', '13800138000', '广东省广州市天河区中山大道西1025号', '35656565', '898999', '9899898', '9898998', '1', '0', '1', '0', '0', '1', '1535815500', '1535815500');
INSERT INTO `syc_delivery_order` VALUES ('28', '2', '25', 'DN201809012708080908', 'PO201809012539390939', '2018-09-30', '2018-09-01', '3120.00', '26', 'SO201809012308080908', '广州市进销传系统有限公司', '1686', 'nice172', '020-89898989', '广东省广州市天河区中山大道西1025号', '9898', '98989', '98989', '989898', '0', '0', '1', '0', '1', '1', '1535815738', '1535815738');
INSERT INTO `syc_delivery_order` VALUES ('29', '2', '24', 'DN201809012920200920', 'PO201809012331310931', '2018-09-29', '2018-09-01', '6240.00', '27', 'SO201809012515150915', '广州市进销传系统有限公司', '1686', 'nice172', '020-89898989', '广东省广州市天河区中山大道西1025号', '86786', '7866', '867867', '8768678', '0', '0', '1', '0', '0', '0', '1535815835', '1535815835');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_goods
-- ----------------------------
INSERT INTO `syc_goods` VALUES ('1', '测试商品', '3', '1', '2', '1', '台', '3399.00', '2999.00', '测试商品备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '0.23KG', '1000', '库存属性', '', '具体位置具体位置具体位置具体位置具体位置', '-1', '1533893242', '1535614840');
INSERT INTO `syc_goods` VALUES ('2', 'fsafsa', '1', '2', '2', '1', '件', '12112.00', '12.00', '23132', null, '31233', '1000', '313131', '321313', '具体位置具体位置具体位置具体位置具体位置', '-1', '1533893431', '1535080253');
INSERT INTO `syc_goods` VALUES ('4', '小米手机iPhone6s 32G', '3', '1', '2', '1', '台', '2199.00', '1999.00', '小米手机iPhone6s 32G备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '0.23KG', '1000', '小米广州仓库', '小米科技', '广州81号仓库', '-1', '1533972542', '1535080261');
INSERT INTO `syc_goods` VALUES ('5', 'gasafsdf', '3', '2', '1', '1', '台', '3123.00', '12.00', '3122313', '', '231', '1000', '3213', '3213', '31223', '-1', '1533974547', '1535080267');
INSERT INTO `syc_goods` VALUES ('6', '测试商品2', '7', '1', '1', '1', '台', '3999.00', '3899.00', '备注备注备注备注备注备注备注备注', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G+\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e8c\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"java\"}]', '5.23KG', '1000', '华为广州仓库', '华为科技', '广东省广州市天河区', '-1', '1533975224', '1535080272');
INSERT INTO `syc_goods` VALUES ('7', 'fdsaff', '3', '1', '2', '1', '件', '55.00', '12.00', 'fsdffa', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u9ed1\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u53cc\\u5361\\u53554G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e09\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"php\"}]', '22', '1000', '55', '66', '88', '-1', '1534404872', '1535080279');
INSERT INTO `syc_goods` VALUES ('8', '移动4G/联通4G/电信4G 套餐一 白色', '3', '1', '2', '1', '台', '33.00', '12.00', '123', '[{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e00\"},{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"}]', '12', '321', '312', '321', '31', '1', '1535094209', '1536126202');
INSERT INTO `syc_goods` VALUES ('9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '3', '1', '2', '1', '包', '312.00', '21.00', '', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e00\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"ab\"}]', '213', '999', '321', '312', '31', '1', '1535094595', '1536045645');
INSERT INTO `syc_goods` VALUES ('10', 'fsadffdf', '3', '1', '0', '1', '件', '23123.00', '12.00', '412fds', '[{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"},{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e00\"},{\"goods_attr_id\":16,\"attr_name\":\"ab\",\"attr_value\":\"ab\"}]', '3213', '3211', '3213', '31231', '32131', '-1', '1535445430', '1535445445');

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
INSERT INTO `syc_goods_attr_val` VALUES ('7', '12', '颜色', '黑色');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '13', '网络制式', '双卡单4G');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '14', '套餐', '套餐三');
INSERT INTO `syc_goods_attr_val` VALUES ('7', '16', 'ab', 'php');
INSERT INTO `syc_goods_attr_val` VALUES ('10', '12', '颜色', '白色');
INSERT INTO `syc_goods_attr_val` VALUES ('10', '13', '网络制式', '移动4G/联通4G/电信4G');
INSERT INTO `syc_goods_attr_val` VALUES ('10', '14', '套餐', '套餐一');
INSERT INTO `syc_goods_attr_val` VALUES ('10', '16', 'ab', 'ab');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '12', '颜色', '白色');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '13', '网络制式', '移动4G/联通4G/电信4G');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '14', '套餐', '套餐二');
INSERT INTO `syc_goods_attr_val` VALUES ('1', '16', 'ab', 'php');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '13', '网络制式', '移动4G/联通4G/电信4G');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '14', '套餐', '套餐一');
INSERT INTO `syc_goods_attr_val` VALUES ('8', '12', '颜色', '白色');

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
  `cus_order_sn` varchar(255) NOT NULL DEFAULT '' COMMENT '客户订单号',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `company_short` varchar(255) NOT NULL DEFAULT '',
  `contacts` varchar(50) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `order_remark` text,
  `attachment` text COMMENT '附件',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '-1已删除，0未确认，1已确认，2已送货，3已完成，4已取消，5已创建采购单，6部分已送货',
  `is_create` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已创建采购单',
  `require_time` int(10) unsigned NOT NULL DEFAULT '0',
  `deliver_time` int(10) unsigned NOT NULL DEFAULT '0',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_sn` (`order_sn`,`company_name`,`company_short`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_order
-- ----------------------------
INSERT INTO `syc_order` VALUES ('26', '2', '5', '1686', 'SO201809012308080908', '', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '', null, '3', '0', '1537891200', '1537891200', '3120.00', '1535815401', '1535815744');
INSERT INTO `syc_order` VALUES ('27', '2', '5', '1686', 'SO201809012515150915', '', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', '', null, '6', '0', '1537977600', '1538150400', '6240.00', '1535815530', '1535815842');
INSERT INTO `syc_order` VALUES ('28', '2', '5', '1686', 'SO201809054508080908', 'CUS08080920180905084508', '广州市进销传系统有限公司', '进销传系统', 'nice172', '020-89898989', '354575573@qq.com', 'gdsgdsgsasfs', '[{\"ext\":\"jpg\",\"path\":\"\\/uploads\\/20180905\\/f7daf80c6e634127a801e720f55d65cb.jpg\",\"filename\":\"f7daf80c6e634127a801e720f55d65cb.jpg\"},{\"ext\":\"docx\",\"path\":\"\\/uploads\\/20180905\\/4da844c613e05a3f36ab86dca7294b0a.docx\",\"filename\":\"4da844c613e05a3f36ab86dca7294b0a.docx\"},{\"ext\":\"png\",\"path\":\"\\/uploads\\/20180905\\/7a09c1e2a2bf1f473e7625810495cbee.png\",\"filename\":\"7a09c1e2a2bf1f473e7625810495cbee.png\"}]', '5', '1', '1537372800', '0', '5200.00', '1536137153', '1536141092');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_order_goods
-- ----------------------------
INSERT INTO `syc_order_goods` VALUES ('52', '26', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '10', '10', '312.00', '312.00', '[]', '', '1535815402');
INSERT INTO `syc_order_goods` VALUES ('53', '27', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '20', '5', '312.00', '312.00', '[]', '', '1535815530');
INSERT INTO `syc_order_goods` VALUES ('54', '28', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '10', '0', '223.00', '312.00', '[]', '', '1536137153');
INSERT INTO `syc_order_goods` VALUES ('55', '28', '8', '移动4G/联通4G/电信4G 套餐一 白色', '台', '33', '0', '90.00', '33.00', '[{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e00\"},{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"}]', '123', '1536137153');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

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
INSERT INTO `syc_params` VALUES ('18', '采购单备注', '采购单备注', '50', '采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，', '1', '');
INSERT INTO `syc_params` VALUES ('19', '订单查询参数', '订单查询参数', '50', '品牌\n颜色\n尺寸\n内存', '0', '');

-- ----------------------------
-- Table structure for syc_payment_goods
-- ----------------------------
DROP TABLE IF EXISTS `syc_payment_goods`;
CREATE TABLE `syc_payment_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `purchase_id` int(10) unsigned NOT NULL DEFAULT '0',
  `po_sn` varchar(100) NOT NULL DEFAULT '',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_sn` varchar(100) NOT NULL DEFAULT '',
  `delivery_date` varchar(50) NOT NULL DEFAULT '',
  `delivery_dn` varchar(100) NOT NULL DEFAULT '',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rec_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收货数量',
  `open_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开票数量',
  `count_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已删除',
  PRIMARY KEY (`id`),
  KEY `payment_order_id` (`payment_order_id`,`order_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_payment_goods
-- ----------------------------
INSERT INTO `syc_payment_goods` VALUES ('3', '7', '24', 'PO201809012331310931', '26', 'SO201809012308080908', '2018-09-26', 'DN201809012405050905', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '312.00', '5', '5', '1560.00', '0');
INSERT INTO `syc_payment_goods` VALUES ('4', '7', '25', 'PO201809012539390939', '26', 'SO201809012308080908', '2018-09-30', 'DN201809012708080908', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '312.00', '5', '5', '1560.00', '0');

-- ----------------------------
-- Table structure for syc_payment_order
-- ----------------------------
DROP TABLE IF EXISTS `syc_payment_order`;
CREATE TABLE `syc_payment_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `supplier_id` int(10) unsigned NOT NULL DEFAULT '0',
  `supplier_name` varchar(255) NOT NULL DEFAULT '',
  `delivery_ids` varchar(255) NOT NULL DEFAULT '',
  `invoice_sn` varchar(100) NOT NULL DEFAULT '',
  `invoice_date` varchar(50) NOT NULL DEFAULT '',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `diff_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已开票',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0已关闭，1未对账，2已对账',
  `payment_date` varchar(100) NOT NULL DEFAULT '' COMMENT '付款期',
  `last_date` varchar(100) NOT NULL DEFAULT '' COMMENT '到期日期',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已删除',
  `update_time` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cus_id` (`supplier_id`,`invoice_sn`,`invoice_date`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_payment_order
-- ----------------------------
INSERT INTO `syc_payment_order` VALUES ('7', '2', '1', '供应商名称', '27,28', 'INV1234567890', '2018-09-18', '3120.00', '3120.00', '0.00', '0', '1', '现金交易', '2018-09-29', '0', '1535864899', '1535864899');

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
  `cus_order_sn` varchar(255) NOT NULL DEFAULT '' COMMENT '客户订单号',
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
  `is_finish` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1送货完成',
  `remark` text,
  `create_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1直接新建',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`order_sn`,`po_sn`,`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_purchase
-- ----------------------------
INSERT INTO `syc_purchase` VALUES ('24', '2', '26', 'SO201809012308080908', '', '1686', 'PO201809012331310931', '1', '13800138000', '内销', '现金交易', '货运', '广州市进销传系统有限公司', '20%', '广东省广州市天河区中山大道西1025号', '020-12345678', '353575573@qq.com', '联系人', '3120.00', '1', '1', '0', '采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，', '0', '1535815425', '1535815425');
INSERT INTO `syc_purchase` VALUES ('25', '2', '27', 'SO201809012515150915', '', '1686', 'PO201809012539390939', '1', '13800138000', '内销', '现金交易', '快递', '广州市进销传系统有限公司', '16%', '广东省广州市天河区中山大道西1025号', '020-12345678', '353575573@qq.com', '联系人', '6240.00', '1', '1', '0', '采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，', '0', '1535815549', '1535815549');
INSERT INTO `syc_purchase` VALUES ('26', '2', '28', 'SO201809054508080908', 'CUS08080920180905084508', '1686', 'PO201809055826260926', '1', '13800138000', '外销', '现金交易', '快递', '广州市进销传系统有限公司', '16%', '广东省广州市天河区中山大道西1025号', '020-12345678', '353575573@qq.com', '联系人', '5200.00', '0', '0', '0', '采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，\n采购单备注就是在系统参数管理读取的，', '0', '1536141521', '1536141521');

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
  `send_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '送货数量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际单价',
  `count_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goods_attr` text,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_purchase_goods
-- ----------------------------
INSERT INTO `syc_purchase_goods` VALUES ('50', '24', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '10', '10', '312.00', '3120.00', '[]', '1535815425');
INSERT INTO `syc_purchase_goods` VALUES ('51', '25', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '20', '5', '312.00', '6240.00', '[]', '1535815549');
INSERT INTO `syc_purchase_goods` VALUES ('52', '26', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '包', '10', '0', '223.00', '2230.00', '[]', '1536141521');
INSERT INTO `syc_purchase_goods` VALUES ('53', '26', '8', '移动4G/联通4G/电信4G 套餐一 白色', '台', '33', '0', '90.00', '2970.00', '[{\"goods_attr_id\":13,\"attr_name\":\"\\u7f51\\u7edc\\u5236\\u5f0f\",\"attr_value\":\"\\u79fb\\u52a84G\\/\\u8054\\u901a4G\\/\\u7535\\u4fe14G\"},{\"goods_attr_id\":14,\"attr_name\":\"\\u5957\\u9910\",\"attr_value\":\"\\u5957\\u9910\\u4e00\"},{\"goods_attr_id\":12,\"attr_name\":\"\\u989c\\u8272\",\"attr_value\":\"\\u767d\\u8272\"}]', '1536141521');

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
-- Table structure for syc_receivables
-- ----------------------------
DROP TABLE IF EXISTS `syc_receivables`;
CREATE TABLE `syc_receivables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cus_name` varchar(255) NOT NULL DEFAULT '',
  `delivery_ids` varchar(255) NOT NULL DEFAULT '',
  `invoice_sn` varchar(100) NOT NULL DEFAULT '',
  `invoice_date` varchar(50) NOT NULL DEFAULT '',
  `total_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `diff_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已开票',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0已关闭，1待核销，2已核销',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已删除',
  `update_time` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cus_id` (`cus_id`,`invoice_sn`,`invoice_date`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_receivables
-- ----------------------------
INSERT INTO `syc_receivables` VALUES ('3', '2', '1686', '广州市进销传系统有限公司', '28', 'INV12335567889', '2018-09-25', '3120.00', '0.00', '0.00', '0', '1', '0', '1535866078', '1535866078');

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
-- Table structure for syc_store_log
-- ----------------------------
DROP TABLE IF EXISTS `syc_store_log`;
CREATE TABLE `syc_store_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(10) unsigned NOT NULL DEFAULT '0',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1入库，2出库，3报溢，4报损',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `number` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `delivery_id` (`delivery_id`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of syc_store_log
-- ----------------------------
INSERT INTO `syc_store_log` VALUES ('55', '27', '26', '2', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '5', '1535815507');
INSERT INTO `syc_store_log` VALUES ('56', '27', '26', '1', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '0', '1535815507');
INSERT INTO `syc_store_log` VALUES ('57', '28', '26', '2', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '5', '1535815744');
INSERT INTO `syc_store_log` VALUES ('58', '28', '26', '1', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '0', '1535815744');
INSERT INTO `syc_store_log` VALUES ('59', '29', '27', '2', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '5', '1535815842');
INSERT INTO `syc_store_log` VALUES ('60', '29', '27', '1', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '0', '1535815842');
INSERT INTO `syc_store_log` VALUES ('61', '0', '0', '3', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '47', '1536045406');
INSERT INTO `syc_store_log` VALUES ('62', '0', '0', '3', '9', 'FR4 1.4MM H/H 37\"*49\" 含铜 黄料', '631', '1536045645');

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
  `supplier_fax` varchar(50) NOT NULL DEFAULT '',
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
INSERT INTO `syc_supplier` VALUES ('1', '0', '供应商名称', '简称', '13800138000', '联系人', '353575573@qq.com', '020-12345678', '部门职务', '1', '353575573', 'php', '现金交易', '广东省', '广州市', '天河区', '详细地址1', '备注内容备注内容备注内容', '1533632664', '1535596064', '2');

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
INSERT INTO `syc_users` VALUES ('1', 'asdasd', 'sha256:1000:X2vbzkCcKSScvZZ5ZUDs7DvTmergIc5u:fQt8UQynrp5psap5MoOq4scNMLNhcjIl', '开发者', '1', '354575573@qq.com', '/uploads/avatar/582d3a26a3369.jpg', '2017-01-01', '163', '1451577600', '1535506989', '127.0.0.1', '127.0.0.1', '16', '1');
INSERT INTO `syc_users` VALUES ('2', 'admin', 'sha256:1000:bb+qr8kui4m4JriYM/aLnznOODBwZfbi:30utxhFU7cxebnazg8Xh5TEkAmzR6ymJ', '管理员', '1', 'nice172@126.com', '', '2018-08-05', '29', '1533480247', '1536110924', '192.168.1.225', '', '16', '1');
INSERT INTO `syc_users` VALUES ('3', 'nice172', 'sha256:1000:GM0kcPbE+QNRSpmsG58qckJUkekhvpwi:XwmDtVMPAfE8DDYUdVW5DF5AOLljRm8q', '测试号', '1', 'nice172@163.com', '', '2018-08-06', '2', '1533526543', '1535612177', '10.10.0.99', '', '14', '1');
