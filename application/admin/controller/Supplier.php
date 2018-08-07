<?php
namespace app\admin\controller;
use think\Request;
use think\Validate;

class Supplier extends Base {
    
    private $scene = 'add';
    
    public function index(){
        $request = $this->request;
        $query = $request->param(); // 分页查询传参数
        $status = $request->param('status'); // 状态查询
        $cus_short = $request->param('cus_short'); // 企业名称查询
        $start_time = $request->param('start_time'); // 企业名称查询
        $end_time = $request->param('end_time'); // 企业名称查询
        
        $where = "supplier_status=1";
        if ($start_time != '' && $end_time != ''){
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time);
            $where .= " and create_time >= '{$start_time}' and create_time <= '{$end_time}'";
        }
        if ($cus_short != ''){
            $where .= " and supplier_short like '%{$cus_short}%'";
        }
        $result = db('supplier')->where($where)->paginate('', false, ['query' => $query ]);
        $data = $result->all();
        foreach ($data as $key => $value){
            $user = db('users')->where(['id' => $value['add_uid']])->find();
            $data[$key]['add_user'] = $user['user_nick'];
            $data[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
            $data[$key]['update_time'] = date('Y-m-d H:i:s',$value['update_time']);
        }
        
        $this->assign('data',$data);
        $this->assign('title','供应商列表');
//         $page = $data->render();
        $page = '';
        $this->assign('page',$page);
        $this->assign('empty', '<tr><td colspan="19" align="center">当前条件没有查到数据</td></tr>');
        return $this->fetch();
    }
    
    public function add(){
        
        $section = getParams(7); //获取部门
        if (!empty($section)){
            $section = $section['params_value'];
        }
        $business = getParams(8); //获取业务经理
        if (!empty($business)){
            $business = $business['params_value'];
        }
        $payment = getParams(1); //获取付款方式
        if (!empty($payment)){
            $payment = $payment['params_value'];
        }
        $this->assign('business',$business);
        $this->assign('payment',$payment);
        $this->assign('section',$section);
        $this->assign('title','新增供应商');
        return $this->fetch();
    }
    
    public function edit(){
        $supplier_id = intval($this->request->param('id'));
        if ($supplier_id <= 0) $this->error('操作失败');
        $supplier = db('supplier')->where(['id' => $supplier_id])->find();
        if (empty($supplier)) $this->error('供应商信息不存在');
        
        $this->assign('data',$supplier);
        $section = getParams(7); //获取部门
        if (!empty($section)){
            $section = $section['params_value'];
        }
        $business = getParams(8); //获取业务经理
        if (!empty($business)){
            $business = $business['params_value'];
        }
        $payment = getParams(1); //获取付款方式
        if (!empty($payment)){
            $payment = $payment['params_value'];
        }
        $this->assign('business',$business);
        $this->assign('payment',$payment);
        $this->assign('section',$section);
        $this->assign('title','修改供应商');
        return $this->fetch();
    }
    
    protected $rules = [
        'supplier_name' => 'require|checkName:1',
        'supplier_short' => 'require',
        'supplier_mobile' => 'require|checkMobile:1',
        'supplier_contacts' => 'require',
        'supplier_email' => 'require|email|checkEmail:1',
        'supplier_payment' => 'require',
        'supplier_province' => 'require',
        'supplier_city' => 'require',
        'supplier_address' => 'require'
    ];
    
    protected $message = [
        'supplier_name.require' => '供应商名称不能为空',
        'supplier_name.checkName' => '供应商名称已存在',
        'supplier_short.require' => '供应商简称不能为空',
        'supplier_mobile.require' => '供应商手机号不能为空',
        'supplier_mobile.checkMobile' => '供应商手机号已存在',
        'supplier_contacts.require' => '联系人不能为空',
        'supplier_email.require' => '邮箱不能为空',
        'supplier_email.email' => '邮箱格式不正确',
        'supplier_email.checkEmail' => '邮箱已存在',
        'supplier_payment.require' => '请选择付款方式',
        'supplier_province.require' => '请选择省份',
        'supplier_city.require' => '请选择城市',
        'supplier_address.require' => '请输入详细地址',
    ];
    
    public function checkName($value,$rule,$data){
        if ($this->scene == 'edit'){
            $where = [
                'id' => ['NEQ',intval($this->request->post('supplier_id'))],
                'supplier_name' => $value];
        }else{
            $where = ['supplier_name' => $value];
        }
        $find = db('supplier')->where($where)->find();
        return empty($find);
    }

    public function checkMobile($value,$rule,$data){
        if ($this->scene == 'edit'){
            $where = [
                'id' => ['NEQ',intval($this->request->post('supplier_id'))],
                'supplier_mobile' => $value];
        }else{
            $where = ['supplier_mobile' => $value];
        }
        $find = db('supplier')->where($where)->find();
        return empty($find);
    }
    
    public function checkEmail($value,$rule,$data){
        if ($this->scene == 'edit'){
            $where = ['id' => ['NEQ',intval($this->request->post('supplier_id'))],
                'supplier_email' => $value];
        }else{
            $where = ['supplier_email' => $value];
        }
        $find = db('supplier')->where($where)->find();
        return empty($find);
    }
    
    private function handerData(){
        $validate = new Validate($this->rules,$this->message);
        $data = $this->request->param();
        $validate->extend([
            'checkName' => [$this,'checkName'],
            'checkMobile' => [$this,'checkMobile'],
            'checkEmail' => [$this,'checkEmail']
        ]);
        if (!$validate->check($data)){
            $this->error($validate->getError());
        }
        $city = $this->request->param('supplier_city');
        $dist = $this->request->param('supplier_area');
        $cus_city = !empty($city) ? $city : '';
        $cus_dist = !empty($dist) ? $dist : '';
        $supplier_remark = cutstr_html($this->request->param('supplier_remark'));
        $data['supplier_remark'] = $supplier_remark;
        return $data;
    }
    
    //添加提交
    public function add_do(){
        if ($this->request->isPost()) {
            $data = $this->handerData();
            $data['create_time'] = time();
            $data['update_time'] = time();
            $data['add_uid'] = $this->userinfo['id'];
            $result = db('supplier')->insert($data);
            if ($result) {
                $this->success($this->request->post('supplier_name').' 添加成功',url('index'));
            } else {
                $this->error('数据操作有错误');
            }
        }
    }
    
    public function edit_do(){
        if ($this->request->isPost()) {
            $this->scene = 'edit';
            $data = $this->handerData();
            $supplier_id = intval($data['supplier_id']);
            if ($supplier_id <= 0)  $this->error('数据操作有错误');
            $data['update_time'] = time();
            unset($data['supplier_id']);
            $result = db('supplier')->where(['id' => $supplier_id])->update($data);
            if ($result) {
                $this->success($this->request->post('supplier_name').' 修改成功',url('index'));
            } else {
                $this->error('数据操作有错误');
            }
        }
    }
    
    //删除操作
    public function delete() {
        $Request = Request::instance();
        if ($Request->isPost()) {
            $supplier_id = intval($this->request->post('supplier_id'));
            if ($supplier_id <= 0)  $this->error('数据操作有错误');
            if (db('supplier')->where(['id' => $supplier_id])->setField('supplier_status','-1')){
                $this->success('删除成功');
            }
            $this->error('数据操作有错误');
        }
    }
    
}