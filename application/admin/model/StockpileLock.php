<?php

namespace app\admin\model;

use think\Model;

class StockpileLock extends Model
{
    protected $insert = ['status'=>1]; // 新增数据自动添加字段
    protected $autoWriteTimestamp = true; // 自动写入时间戳

    //锁具名称
    public function getStLidAttr($vaule) {
        $model = new FittingsLock();
        $result = $model::get($vaule);
        return $result;
    }
}