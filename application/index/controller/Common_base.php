<?php

 namespace app\index\controller;

 use think\Controller;
 use think\Db;
 use think\Session;
 use think\Request;

 class Common_base extends Controller
 {
     public function _initialize()
     {
         parent::_initialize(); // TODO: Change the autogenerated stub
         header("Content-Type: text/html; charset=utf-8");
         if (!Session::has("user_name") && !Session::has("user_id")) {
             $this->redirect("login/index");
         } else {
             //$request = Request::instance();
            // 查询用户信息
             //$globalUser = Db::name('users')->where(['id'=>Session::get('user_id')])->field('user_password', true)->find();
             //if ($globalUser) {
                 // 把数据压入视图
                 //$this->assign('globalUser', $globalUser);
             //} else {
             //    return json('你的数据非法，系统已记录你的行为！');
             //}
             // 开始 AUTH 认证
             //$Auth = new \Org\Auth();
             //验证规则
             //$authName = $request->module() . '/' . $request->controller() . '/' . $request->action();
             // 检查是否超管
             //define("IS_ROOT", IS_ROOT($globalUser["user_auth"], Session::get('user_auth')));
             //if (IS_ROOT === false) {
                 // 不是超管 执行验证
             //    if (!$Auth->check($authName, $globalUser["user_auth"])) {
             //        $this->error("无权限操作");
                     //p($Auth->check($authName, $admin_data["admin_id"]));
             //    }
             //}
         }
     }
 }