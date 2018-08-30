<?php

namespace app\admin\validate;

use think\Validate;

class Customers extends Validate {
    protected $rule = [
        'con_name' => 'require',
        'con_short' => 'require',
        'con_phome' => 'require',
        'con_mobile' => 'require',
        'con_duty' => 'require',
        'con_email' => 'require',
        'con_section' => 'require',
        'con_business' => 'require',
    	'con_order_ren' => 'require',
        'con_prov' => 'require',
        'con_city' => 'require',
        'con_street' => 'require'
    ];

    protected $message = [
        'con_name.require' => '公司名称不能为空',
        //'con_name.checkName' => '公司名称已存在',
        'con_short.require' => '简称不能为空',
        'con_phome.require' => '电话号码不能为空',
        'con_mobile.require' => '手机号码不能为空',
        'con_duty.require' => '联系人不能为空',
        'con_email.require' => 'E-Mail不能为空',
        'con_email.email' => 'E-Mail格式不对',
        'con_section.require' => '部门不能为空',
        'con_business.require' => '业务经理不能为空',
    	'con_order_ren.require' => '跟单员不能为空',
        'con_street.require' => '详细地址不能为空',
        'con_prov.require' => '省份不能为空',
        'con_city.require' => '城市不能为空'
    ];

    protected $scene = [
        'add'      => ['con_name' => 'require|checkName:1'],
        'edit'     => ['con_name' => 'require|iNcheckName:1']
    ];
    
    protected function checkName($value,$rule,$data){
        $find = db('customers')->where(['cus_name' => $value])->find();
        return empty($find) ? true : false;
    }
    
}