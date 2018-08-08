<?php

 namespace app\admin\controller;

 use think\Controller;
 use think\Session;

 class Base extends Controller {
     
     protected $userinfo;
     protected $empty = '<tr><td colspan="20" align="center">当前条件没有查到数据</td></tr>';
     
     public function _initialize(){
         parent::_initialize();
         if (!Session::has("user_name") && !Session::has("user_id")) {
             $this->redirect("login/index");
         } 
         
         $user_id = session('user_id');
         $this->userinfo = db('users')->where(['id' => $user_id])->find();
         $this->assign('userinfo',$this->userinfo);
         
         $request = \think\Request::instance();
         define('MODULE_NAME', $request->module());
         define('CONTROLLER_NAME', $request->controller());
         define('ACTION_NAME', $request->action());
         define('REQUEST_URL', $request->url());
         if (!in_array($this->userinfo['id'], config('AUTH_CONFIG')['NO_AUTH_USER'])){
             $node = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
             if (!in_array($node, config('AUTH_CONFIG')['NO_AUTH_URL'])){
                 $auth = new \Auth();
                 if(!$auth->check($node, $this->userinfo['id'])){
                     if ($node == strtolower(MODULE_NAME).'/index/index'){
                         Session::clear(); // 清除session值
                         $this->redirect(url('Login/index'));
                     }
                     $this->error('您没有权限访问！');
                 }
             }
         }
         $this->assign('empty',$this->empty);
     }
     
     protected function ajaxReturn($data){
         header("Content-Type: application/json; charset=utf-8");
         exit(json($data)->getContent());
     }
 }