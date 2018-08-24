<?php
namespace app\admin\controller;
class Account extends Base {
    
    public function index(){
        
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','应收账款');
        return $this->fetch();
    }
    
    public function add_shou(){
        
    }
    
    public function payment(){
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','应付账款');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function wait(){
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','采购发票待处理');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function add_payment(){
        $this->assign('sub_class','viewFramework-product-col-1');
    }
    
}