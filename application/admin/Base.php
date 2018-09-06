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
         $this->menu();
         $this->assign('empty',$this->empty);
     }

     private function menu(){
     	$URL = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
     	$notAuth = config('AUTH_CONFIG')['NO_AUTH_USER'];
     	$where = array('status' => 1);
     	if (!in_array($this->userinfo['id'], $notAuth)){
     		if (empty($this->userinfo['group_id'])){
     			Session::clear(); // 清除session值
     			$this->error('您没有权限访问！',url('Login/index'));
     		}
     		$auth_group = db('auth_group')->where(['id' => $this->userinfo['group_id']])->find();
     		if (empty($auth_group) || empty($auth_group['rule_pids']) || empty($auth_group['rules'])){
     			Session::clear(); // 清除session值
     			$this->error('您没有权限访问！',url('Login/index'));
     		}
     		if (!$auth_group['status']){
     		    Session::clear(); // 清除session值
     		    $this->error('角色状态已禁用',url('Login/index'));
     		}
     		$rulesID = $auth_group['rule_pids'].','.$auth_group['rules'];
     		$where['id'] = ['in',$rulesID];
     	}
     	$lists = db('auth_rule')->where($where)->order('sort asc')->select();
     	$parentid = 0;
     	foreach ($lists as $key => $value){
     		if ($value['name'] == $URL && $value['parentid']){
     			$parent = getParent($lists,$value['id']);
     			$parentid = $parent['id'];
     			break;
     		}
     	}
     	$top_menu = array();
     	$current_name = '';
     	$current_pid = 0;
     	if ($parentid){
     		foreach ($lists as $key => $value){
     			if ($value['name'] == $URL){
     				$current_name = $value['title'];
     				$current_pid = $value['parentid'];
     			}
     			if ($value['parentid'] == $parentid){
     				$top_menu[] = array(
     						'node' => $value['name'],
     						'nodeid' => str_replace('/', '-', $value['name']),
     						'title' => $value['title'],
     						'level' => $value['level'],
     						'icon' => $value['css'],
     						'id' => $value['id']
     				);
     			}
     		}
     	}
     	$node = getChild($lists);
     	$menu = array();
     	foreach ($node as $key => $value){
     		if (empty($value['child'])){
     			$menu[$value['name']] = array(
     					'node' => $value['name'],
     					'nodeid' => str_replace('/', '-', $value['name']),
     					'title' => $value['title'],
     					'level' => $value['level'],
     					'icon' => $value['css'],
     					'id' => $value['id'],
     					'subNode' => array(),
     			);
     		}else{
     			$menu[$value['name']] = array(
     					'node' => $value['name'],
     					'nodeid' => str_replace('/', '-', $value['name']),
     					'title' => $value['title'],
     					'level' => $value['level'],
     					'icon' => $value['css'],
     					'id' => $value['id'],
     					'subNode' => array(),
     			);
     			$subNode = array();
     			foreach ($value['child'] as $childKey => $childValue){
     				$subNode[] = array(
     						'node' => $childValue['name'],
     						'url' => url($childValue['name']),
     						'nodeid' => str_replace('/', '-', $childValue['name']),
     						'icon' => !empty($childValue['css']) ? $childValue['css'] : 'icon-ecs',
     						'title' => $childValue['title'],
     						'level' => $childValue['level'],
     						'id' => $childValue['id'],
     						'parentid' => $childValue['parentid']
     				);
     			}
     			$menu[$value['name']]['subNode'] = $subNode;
     		}
     	}
     	$this->assign('top_menu',$top_menu);
     	$this->assign('left_URL',$URL);
     	$this->assign('left_menu',$menu);
//      	echo 'current_pid='.$current_pid.'<br />';
//      	echo 'parentid_pid='.$parentid.'<br />';
//      	p($menu);
//      	exit;
     	$this->assign('current_title', $current_name);
     	$this->assign('current_pid', $current_pid);
     	$this->assign('left_active',$parentid);
     }
     
     protected function ajaxReturn($data){
         header("Content-Type: application/json; charset=utf-8");
         exit(json($data)->getContent());
     }
     
     public function _empty(){
         if ($this->request->isAjax()){
             $this->error('方法不存在');
         }
         if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
             $this->redirect($_SERVER['HTTP_REFERER']);
             exit;
         }
         $this->error('方法不存在');
     }
     
     protected function upload_file($subDir=''){
     	// 获取表单上传文件 例如上传了001.jpg
     	$file = request()->file('file');
     	if (empty($file)){
     		$file = request()->file('Filedata');
     	}
     	if (empty($file)) return [];
     	// 移动到框架应用根目录/public/uploads/ 目录下
     	if (!empty($subDir)) $subDir = DS.$subDir;
     	$ext = ['ext'=>'jpg,png,gif,jpeg,pdf,docx,doc,xlsx,xls,csv'];

     	if (is_array($file)){
     	    $files = [];
     	    foreach ($file as $obj){
     	        $info = $obj->validate($ext)->move(config('UPLOAD_DIR') . $subDir);
     	        if ($info){
     	            $files[] = [
     	                'ext' => $info->getExtension(),
     	                'path' => str_replace('\\', '/', DS . config('UPLOAD_DIR') .$subDir .'/'.$info->getSaveName()),
     	                'oldfilename' => $obj->getInfo('name'),
     	                'filename' => $info->getFilename()
     	            ];
     	        }else{
     	            $this->error($obj->getError());
     	        }
     	    }
     	    return $files;
     	}else{
     	    $info = $file->validate($ext)->move(config('UPLOAD_DIR') . $subDir);
         	if($info){
         		return [
         				'ext' => $info->getExtension(),
         				'path' => str_replace('\\', '/', DS . config('UPLOAD_DIR') .$subDir .'/'.$info->getSaveName()),
         		    'oldfilename' => $file->getInfo('name'),
         		         'filename' => $info->getFilename()
         		];
         	}else{
         		// 上传失败获取错误信息
         	    $this->error($file->getError());
         	}
     	}
     }
 }