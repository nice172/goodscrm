<?php

namespace app\admin\controller;

use think\Db;
use think\Request;
use think\Url;

class Role extends Base{
    public function index() {
        $group = Db::name('auth_group')->order('id', 'asc')->select();

        foreach ($group as $kcou=>$vcou) {
            $group[$kcou]['count'] = Db::name('users')->where('group_id',$vcou['id'])->where('status',1)->count();
        }
        foreach ($group as $key=>$val) {
            $group[$key]['son']=Db::name('users')->field(['id'=>'uid','user_name','user_nick','group_id'])->where('group_id',$val['id'])->where('status',1)->order('uid','asc')->select();
        }
        $this->assign('title', '角色管理');
        $this->assign('group', $group);
        return $this->fetch();
    }

    //
    public function add() {
    	$lists = db('auth_rule')->select();
    	$select = getChild($lists,0);
    	$this->assign('lists', $select);
    	$this->assign('data',['id' => 0,'rule_pids'=>[],'rules' => []]);
        return $this->fetch();
    }

    //增加
    public function add_do() {
        $Request = Request::instance();
        if ($Request->isPost()) {
            $title = $Request->param('bumenname');
            $status = intval($this->request->post('status'));
            if (empty($title)) {
                $this->error('请输入角色名称');
            }
            $ByTitle = Db::name('auth_group')->where('title', $title)->find();
            if ($ByTitle) {
                $this->error('名称已存在，请更换。');
            }
            $rule_ipds = implode(',', input('post.parent/a'));
            $rules = implode(',', input('post.rule/a'));
            $data = array(
            		'time' => time(),'status' => $status,'title'=>$title,
            		'rule_pids' => $rule_ipds,
            		'rules' => $rules
            );
            $result = Db::name('auth_group')->insert($data);
            if ($result) {
                $this->success('添加角色成功',url('index'));
            } else {
                $this->error('添加角色数据错误');
            }
        }
    }

    //查询
    public function check_name() {
        $Request = Request::instance();
        if ($Request->isPost()) {
            $title = $Request->param('bumenname');
            $result = Db::name('auth_group')->where('title', $title)->find();
            if ($result) {
                return false;
            } else {
                return true;
            }
        }
    }
    
    public function edit(){
    	$id = intval(input('id'));
    	$data = db('auth_group')->where(array('id' => $id))->find();
    	if (empty($data)) $this->error('数据不存在');
    	$lists = db('auth_rule')->select();
    	$select = getChild($lists,0);
    	$this->assign('lists', $select);
    	$data['rule_pids'] = explode(',', $data['rule_pids']);
    	$data['rules'] = explode(',', $data['rules']);
    	$this->assign('data',$data);
    	
    	return $this->fetch();
    }
    
    public function deleterole(){
    	if (!request()->isAjax()) $this->error('操作失败');
    	$id = input('id');
    	if (db('auth_group')->where(array('id' => $id))->delete()){
    		$this->success('删除成功');
    	}
    	$this->error('删除失败');
    }

    public function editrole(){
    	if (!request()->isAjax()) $this->error('操作失败');
    	$name = input('post.bumenname');
    	$id = input('post.id');
    	$status = intval(input('post.status'));
    	if (!$id) $this->error('提交失败');
    	if (empty($name)) $this->error('角色名称不能为空');
    	$rule_ipds = implode(',', input('post.parent/a'));
    	$rules = implode(',', input('post.rule/a'));
    	$data = array(
    			'title' => $name,
    			'status' => $status,
    			'rule_pids' => $rule_ipds,
    			'rules' => $rules
    	);
    	$model = db('auth_group');
    	if ($model->where(array('title' => $name,'id' => array('NEQ',$id)))->find()) $this->error('角色名称已存在');
    	if ($model->where(array('id' => $id))->update($data)) {
    		$this->success('修改成功');
    	} else{
    		$this->error('修改失败');
    	}
    }
    
    public function rolestatus(){
    	if (!request()->isAjax()) $this->error('操作失败');
    	$id = intval(input('id'));
    	$model = db('auth_group');
    	$data = $model->where(array('id' => $id))->find();
    	if (!$data) $this->error('操作失败');
    	$status = $data['status'] ? 0 : 1;
    	$affected_row = $model->where(array('id' => $data['id']))->setField('status',$status);
    	if (!$affected_row) $this->error('操作失败');
    	$this->success('操作成功');
    }
    
}