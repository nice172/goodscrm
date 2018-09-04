<?php
namespace app\admin\controller;
class Auth extends Base{
	
	public function index(){
		$lists = db('auth_rule')->order('sort asc')->select();
		$select = getChild($lists,0);
		$this->assign('select', $select);
		$this->assign('lists',self::arrMarge($lists));
		return $this->fetch();
	}
	
	private function arrMarge($lists,$pid=0){
	    $arr = [];
	    foreach($lists as $key => $value){
	        if ($value['parentid'] == $pid){
	            $arr[] = $value;
	            $arr = array_merge($arr,self::arrMarge($lists,$value['id']));
	        }
	    }
	    return $arr;
	}
	
	public function rule_add_runadd(){
		if (!request()->isAjax()) $this->error('操作失败');
		$data = $this->rule_post_check();
		//if (db('auth_rule')->where(array('name' => $data['name']))->find()) $this->error('节点名称已存在');
		if (db('auth_rule')->insert($data)){
			$this->success('添加成功');
		}else{
			$this->error('添加失败');
		}
	}
	
	private function rule_post_check(){
		$data = array(
				'parentid' => input('parentid',0),
				'level' => 1,
				'name' => strtolower(input('name')),
				'title' => input('title'),
				'status' => input('status'),
				'css' => input('css'),
				'sort' => input('sort',50),
				'ismenu' => input('ismenu'),
				'condition' => input('condition'),
		);
		if ($data['parentid']){
			$parent = db('auth_rule')->where(array('id' => $data['parentid']))->find();
			$data['level'] = $parent['level']+1;
		}
		if (empty($data['title'])) $this->error('权限标题不能为空');
		if (empty($data['name'])) $this->error('权限名称不能为空');
		preg_match('/\./', $data['name'],$arr);
		if (!empty($arr)) $this->error('权限名称不合法');
		if ($data['parentid']){
			@list($modules,$controller,$action,$ext) = explode('/', $data['name']);
			if (!isset($modules) || !isset($controller) || !isset($action)) $this->error('权限名称不合法');
		}else{
			@list($modules,$controller,$ext) = explode('/', $data['name']);
			if (!isset($modules) || !isset($controller)) $this->error('权限名称不合法');
		}
		return $data;
	}
	
	public function node_status(){
		if (!request()->isAjax()) $this->error('操作失败');
		$id = intval(input('id'));
		$model = db('auth_rule');
		$data = $model->where(array('id' => $id))->find();
		if (!$data) $this->error('操作失败');
		$status = $data['status'] ? 0 : 1;
		$affected_row = $model->where(array('id' => $data['id']))->setField('status',$status);
		if (!$affected_row) $this->error('操作失败');
		$this->success('操作成功');
	}
	
	public function edit_node(){
		$id = intval(input('id'));
		if (!$id) $this->error('操作失败');
		$data = db('auth_rule')->where(array('id' => $id))->find();
		$lists = db('auth_rule')->select();
		$select = getChild($lists,0);
		$this->assign('select', $select);
		$this->assign('data',$data);
		return $this->fetch();
	}
	
	public function rule_edit_runedit(){
		if (!request()->isAjax()) $this->error('操作失败');
		$data = $this->rule_post_check();
		$data['id'] = intval(input('id'));
		if (!$data['id']) $this->error('保存失败');
		//if (db('auth_rule')->where(array('name' => $data['name'],'id' => array("NEQ",$data['id'])))->find()) $this->error('节点名称已存在');
		if (db('auth_rule')->update($data)){
			$this->success('保存成功',url('index'));
		}
		$this->error('保存失败');
	}
	
	public function nodesort(){
		if (!request()->isAjax()) $this->error('操作失败');
		$data['id'] = intval(input('id'));
		$data['sort'] = intval(input('sort'));
		if ($data['sort'] < 0) $data['sort'] = 0;
		if (db('auth_rule')->update($data)){
			$this->success('保存成功');
		}
		$this->error('操作失败');
	}
	
	public function deletenode(){
		if (!request()->isAjax()) $this->error('操作失败');
		$id = input('id');
		$groupModel = db('auth_group');
		$group_auth = $groupModel->where(array('rules' => array('NEQ','')))->select();
		foreach ($group_auth as $key => $value){
			$rules_array = explode(',', $value['rules']);
			$pids_array = explode(',', $value['rule_pids']);
			foreach ($rules_array as $rk => $rv){
				if ($rv == $id){
					unset($rules_array[$rk]);
				}
			}
			foreach ($pids_array as $pk => $pv){
				if ($pv == $id){
					unset($pids_array[$pk]);
				}
			}
			$update = array(
					'rules' => implode(',', $rules_array),
					'rule_pids' => implode(',', $pids_array)
			);
			$groupModel->where(array('id' => $value['id']))->update($update);
		}
		if (db('auth_rule')->where(array('id' => $id))->delete()){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	
}