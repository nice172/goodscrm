<?php

namespace app\admin\model;

use think\Model;

class MaterialSet extends Model
{
    protected $insert = ['status'=>1]; // 新增数据自动添加字段
    protected $autoWriteTimestamp = true; // 自动写入时间戳

    //获取收款项目
    public function getMsUidAttr($value) {
        $model = new Users();
        $result = $model::get($value);
        return $result['user_nick'];
    }
}