<?php
namespace app\admin\controller;
class Delivery extends Base {
    
    public function index(){
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','送货单');
        return $this->fetch();
    }
    
    public function add(){
        
        return $this->fetch();
    }
    
}