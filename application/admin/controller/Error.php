<?php
namespace app\admin\controller;
use think\Controller;

class Error extends Controller {
    
    public function index(){
        if ($this->request->isAjax()){
            $this->error('控制器不存在');
        }
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            $this->redirect($_SERVER['HTTP_REFERER']);
            exit;
        }
        $this->redirect(url('index/index'));
    }
    
}