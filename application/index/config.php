<?php

return [
    // AUTH 权限配置
    'AUTH_CONFIG' => [
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'auth_group_access', //用户组明细表
        'AUTH_RULE' => 'auth_rule', //权限规则表
        'AUTH_USER' => 'users'//用户信息表
    ],
    // 超级管理员的ID 数组模式
    'AUTH_ADMINISTRATOR_ID' => [1,2],
];