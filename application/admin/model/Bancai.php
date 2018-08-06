<?php

namespace app\admin\model;

use think\Model;

class Bancai extends Model
{
    protected $insert = ['status'=>1]; // 新增数据自动添加字段
    protected $autoWriteTimestamp = true; // 自动写入时间戳

    //颜色
    public function getBpcidAttr($vaule) {
        $model = new ProductColor();
        $result = $model::get($vaule);
        return $result;
    }

    //料型
    public function getBplidAttr($vaule) {
        $model = new BancaiList();
        $result = $model::get($vaule);
        return $result;
    }
}