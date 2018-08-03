<?php

namespace app\index\model;

use think\Model;

class Users extends Model
{
    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    protected $readonly = ['user_name']; // 锁定用户名为只读
    protected $auto = []; // 自动完成
    protected $insert = ['create_ip', 'status'=>1]; // 新增数据自动添加字段
    protected $update = ['update_ip']; // 更新数据自动修改字段
    protected $autoWriteTimestamp = true; // 自动写入时间戳

    // 自动添加IP
    protected function setCreateIpAttr()
    {
        return request()->ip();
    }

    // 定义全局查询
    protected function base($query) {
        $query->field('user_password,create_ip,update_ip', true);
    }

    // 定义查询账户状态
    protected function scopeStatus($query, $val) {
        $query->where('status', '=', $val);
    }

    // 定义姓名查询
    protected function scopeNick($query, $val) {
        $query->where('user_nick', 'like', '%'.$val.'%');
    }

    // 账户状态获取器
    public function getStatusAttr($value)
    {
        $status = [
            -1=> '<span class="label label-sm label-danger">删除</span>',
            0 => '<span class="label label-sm label-warning">禁用</span>',
            1 => '<span class="label label-sm label-success">正常</span>',
            2 => '<span class="label label-sm label-info">审核</span>'
        ];
        return $status[$value];
    }

    //管理组名称获取器
    public function getUserAuthAttr($value)
    {
        $AuthGroup = new AuthGroup();
        $user_auth = $AuthGroup::get($value);
        return $user_auth;
    }
}