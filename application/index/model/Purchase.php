<?php

namespace app\index\model;

use think\Model;

class Purchase extends Model
{
    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }
    protected $readonly = ['pnumber']; // 锁定订单号为只读
    protected $insert = ['affirm'=>0,'status'=>0]; // 新增数据自动添加字段
    protected $autoWriteTimestamp = true; // 自动写入时间戳

    // 定义全局查询
    protected function base($query) {
        $query->order('create_time', 'desc');
    }

    //定义订单号/企业名称/联系人查询
    protected function scopePnumber($query, $val) {
        $query->where('pnumber|pbname|pcsname', 'like', '%' .$val.'%');
    }

    //定义订单状态查询
    protected function scopeStatus($query, $val) {
        $query->where('status', '=', $val);
    }

    //定义客户确认查询
    protected function scopeAffirm($query, $val) {
        $query->where('affirm', '=', $val);
    }

    // 状态获取器affirm
//    public function getStatusAttr($value)
//    {
//        $status = [
//            -1=> '<span class="label label-sm label-danger">已废除</span>',
//            0 => '<span class="label label-sm label-warning">审核中</span>',
//            1 => '<span class="label label-sm label-info">生产中</span>',
//            2 => '<span class="label label-sm label-primary">已出货</span>'
//        ];
//        return $status[$value];
//    }

    // 订单是否确认affirm
//    public function getAffirmAttr($value)
//    {
//        $status = [
//            0 => '<span class="label label-sm label-default">未确认</span>',
//            1 => '<span class="label label-sm label-success">已确认</span>'
//        ];
//        return $status[$value];
//    }

    //获取企业信息
    public function getPcusIdAttr($value) {
        $model = new Customers();
        $result = $model::get($value);
        return $result;
    }
}