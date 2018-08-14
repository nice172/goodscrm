<?php
namespace app\admin\controller;
use think\Validate;

class Params extends Base {
    
    protected $rules = [
        //'name' => 'require|token',
        'name' => 'require|checkName:1',
        'params_value' => 'require'
    ];
    
    protected $message = [
        'name.require' => '参数名称不能为空',
        'name.checkName' => '参数名称已存在'
    ];
    
    public function index(){
        
        $result = db('params')->order('id desc')->paginate();
        $list = $result->all();
        foreach ($list as $k => $value){
            if (PHP_OS == 'WINNT'){
                $list[$k]['params_value'] = str_replace("\n", '，', $value['params_value']);
            }else{
                //在本地开发无用
                $list[$k]['params_value'] = str_replace(PHP_EOL, '，', $value['params_value']);
            }
        }
        $this->assign('page',$result->render());
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    public function add(){
        if ($this->request->isAjax()){
            $validate = new Validate($this->rules,$this->message);
            $validate->extend('checkName',function($value,$rule,$data){
                $find = db('params')->where(['name' => $value])->find();
                if (empty($find)) return true;
                return false;
            });
            if (!$validate->check($this->request->post())){
                $this->error($validate->getError());
            }
            $data = $this->request->post();
            unset($data['__token__']);
            $file = '';
            if (!empty($_FILES)){
                $file = $this->upload_file();
                if (is_array($file)){
                    $file = $file['path'];
                }else{
                    $file = '';
                }
            }
            $data['file'] = $file;
            if (db('params')->insert($data)){
                $this->success('新增成功',url('index'));
            }
            $this->error('新增失败');
        }
        return $this->fetch();
    }
    
    public function edit(){
        if ($this->request->isAjax()){
            $validate = new Validate($this->rules,$this->message);
            $validate->extend('checkName',function($value,$rule,$data){
                $id = $this->request->post('id');
                $find = db('params')->where(['id' => ['NEQ',$id],'name' => $value])->find();
                if (empty($find)) return true;
                return false;
            });
            if (!$validate->check($this->request->post())){
                $this->error($validate->getError());
            }
            $data = $this->request->post();
            $file = '';
            if (!empty($_FILES)){
                $file = $this->upload_file();
                if (is_array($file)){
                    $file = $file['path'];
                }else{
                    $file = '';
                }
            }
            if (!empty($file)){
                $data['file'] = $file;
            }else{
                $data['file'] = $data['org_file'];
            }
            unset($data['org_file']);
            if (db('params')->update($data)){
                $this->success('修改成功',url('index'));
            }
            $this->error('修改失败');
        }
        $id = intval(input('id'));
        $data = db('params')->where(['id' => $id])->find();
        if (empty($data)) $this->error('操作失败');
        $this->assign('data',$data);
        return $this->fetch();
    }
    
    public function delete(){
        if ($this->request->isAjax()){
            if (isset($_POST['name']) && $_POST['name'] == 'delallattr'){
                if (db('params')->where(['id' => ['IN',explode(',', $_POST['id'])]])->delete()){
                    $this->success('删除成功');
                }
                $this->error('删除失败');
                return;
            }
            $id = intval(input('id'));
            if (db('params')->where(['id' => $id])->delete()){
                $this->success('删除成功');
            }
            $this->error('删除失败');
        }
    }
    
}