<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Validate;

class Supplier extends Base {
    
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
            $end_time = strtotime($end_time.' 23:59:59');
            if ($start_time && $end_time){
                $where .= " and create_time >= '{$start_time}' and create_time <= '{$end_time}'";
            }
        }
        if ($cus_short != ''){
            $where .= " and supplier_short like '%{$cus_short}%'";
        }
        $result = db('supplier')->where($where)->order('create_time desc')->paginate(config('PAGE_SIZE'), false, ['query' => $query ]);
        $data = $result->all();
        foreach ($data as $key => $value){
            $user = db('users')->where(['id' => $value['add_uid']])->find();
            $data[$key]['add_user'] = $user['user_nick'];
            $data[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
            $data[$key]['update_time'] = date('Y-m-d H:i:s',$value['update_time']);
        }
        
        $this->assign('data',$data);
        $this->assign('title','供应商列表');
        $page = $result->render();
        $this->assign('page',$page);
        $this->assign('empty', '<tr><td colspan="19" align="center">当前条件没有查到数据</td></tr>');
        return $this->fetch();
    }
    
    public function view(){
        $supplier_id = intval($this->request->param('id'));
        if ($supplier_id <= 0) $this->error('操作失败');
        $supplier = db('supplier')->where(['id' => $supplier_id])->find();
        if (empty($supplier)) $this->error('供应商信息不存在');
        $this->assign('title','供应商详情');
        $this->assign('data', $supplier);
        $contact = Db::name('supplier_contacts')->where('supplier_id', $supplier_id)->where('status','>=','1')->select();
        $this->assign('contact',$contact);
        
        $result = Db::name('purchase p')->where(['p.supplier_id' => $supplier_id])
        ->field('p.*,c.con_name,c.con_mobile,u.user_nick')
        ->join('__ORDER__ o','p.order_id=o.id')->join('__CUSTOMERS_CONTACT__ c','c.con_id=o.con_id')
        ->join('__USERS__ u','o.create_uid=u.id')->order('p.create_time desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
        
        $this->assign('lsdd',$result->all());
        $this->assign('page_l',$result->render());
        $this->assign('empty', '<tr><td colspan="19" align="center">当前条件没有查到数据</td></tr>');
        return $this->fetch();
    }
    
    public function add(){
        $this->_getParams();
        $this->assign('title','新增供应商');
        return $this->fetch();
    }
    
    private function _getParams(){
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
    }
    
    public function edit(){
        $supplier_id = intval($this->request->param('id'));
        if ($supplier_id <= 0) $this->error('操作失败');
        $supplier = db('supplier')->where(['id' => $supplier_id])->find();
        if (empty($supplier)) $this->error('供应商信息不存在');
        
        $this->assign('data',$supplier);
        $this->_getParams();
        $this->assign('title','修改供应商');
        return $this->fetch();
    }
        
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
    
    public function add_contacts(){
        $id = $this->request->param('id');
        if (!is_numeric($id) || empty($id)) {
            $this->error('参数错误！');
        }
        $section = getParams(7); //获取部门
        if (!empty($section)){
            $section = $section['params_value'];
        }
        $this->assign('section',$section);
        $data = db('supplier')->field('id')->where('id',$id)->find();
        $this->assign('data', $data);
        return $this->fetch();
    }
    
    protected $contacts_rules = [
        'con_name' => 'require|checkContacts:1',
        'con_mobile' => 'require|checkContactsMobile:1',
        'con_section' => 'require',
        'con_post' => 'require',
        'con_email' => 'email|checkContactsEmail:1',
        'con_address' => 'require'
    ];
    
    protected $contacts_message = [
        'con_name.require' => '姓名不能为空',
        'con_name.checkContacts' => '姓名已存在',
        'con_mobile.require' => '手机号不能为空',
        'con_mobile.checkContactsMobile' => '手机号已存在',
        'con_section.require' => '请选择部门',
        'con_post.require' => '职务不能为空',
        'con_email.email' => '邮箱格式不合法',
        'con_email.checkContactsEmail' => '邮箱已存在',
        'con_address.require' => '送货地址不能为空',
    ];
    
    public function checkContacts($value,$rule,$data){
        if ($this->scene == 'edit'){
            $where = ['con_name' => $value,
                'con_id' => ['NEQ',intval($this->request->param('con_id'))]
            ];
        }else{
            $where = ['con_name' => $value];
        }
        $find = db('supplier_contacts')->where($where)->find();
        return empty($find);
    }
    
    public function checkContactsMobile($value,$rule,$data){
        if ($this->scene == 'edit'){
            $where = ['con_mobile' => $value,
                'con_id' => ['NEQ',intval($this->request->param('con_id'))]
            ];
        }else{
            $where = ['con_mobile' => $value];
        }
        $find = db('supplier_contacts')->where($where)->find();
        return empty($find);
    }
    
    public function checkContactsEmail($value,$rule,$data){
        if ($this->scene == 'edit'){
            $where = ['con_email' => $value,
                'con_id' => ['NEQ',intval($this->request->param('con_id'))]
            ];
        }else{
            $where = ['con_email' => $value];
        }
        $find = db('supplier_contacts')->where($where)->find();
        return empty($find);
    }
    
    //提交增加联系
    public function contacts_do() {
        $Request = Request::instance();
        $cusid = $Request->param('con_id');
        if (!is_numeric($cusid) || empty($cusid)) {
            $this->error('参数错误！');
        }
        $data = $this->request->param();
        $validate = new Validate($this->contacts_rules,$this->contacts_message);
        $validate->extend([
            'checkContacts' => [$this,'checkContacts'],
            'checkContactsMobile' => [$this,'checkContactsMobile'],
            'checkContactsEmail' => [$this,'checkContactsEmail'],
        ]);
        if (!$validate->check($data)){
            $this->error($validate->getError());
        }
        $ByCus = db('supplier')->where('id',$cusid)->find();
        if (empty($ByCus)) {
            $this->error('操作失败');
        }
        $data['update_time'] = time();
        $data['create_time'] = time();
        $data['status'] = 1;
        $data['supplier_id'] = $ByCus['id'];
        unset($data['__token__'],$data['con_id']);
        $result = \think\Db::name('supplier_contacts')->insert($data);
        if ($result) {
            $this->success('新增成功', url('view',['id'=>$cusid]));
        } else {
            $this->error('新增失败，估计服务器有错误，请联系管理员！');
        }
    }
    
    public function edit_e_do(){
        $this->scene = 'edit';
        $Request = Request::instance();
        $cusid = $Request->param('con_id');
        if (!is_numeric($cusid) || empty($cusid)) {
            $this->error('参数错误！');
        }
        $data = $this->request->param();
        $validate = new Validate($this->contacts_rules,$this->contacts_message);
        $validate->extend([
            'checkContacts' => [$this,'checkContacts'],
            'checkContactsMobile' => [$this,'checkContactsMobile'],
            'checkContactsEmail' => [$this,'checkContactsEmail'],
        ]);
        if (!$validate->check($data)){
            $this->error($validate->getError());
        }
        $data['update_time'] = time();
        unset($data['__token__']);
        $result = \think\Db::name('supplier_contacts')->update($data);
        if ($result) {
            $this->success('保存成功');
        } else {
            $this->error('保存失败，估计服务器有错误，请联系管理员！');
        }
    }
    
    public function edit_contacts() {
        $Request = Request::instance();
        $id = $Request->param('id');
        if (!is_numeric($id) || empty($id)) {
            $this->error('参数错误！');
        }
        $data = db('supplier_contacts')->where(['con_id' => $id])->find();
        $this->assign('data', $data);
        $section = getParams(7); //获取部门
        if (!empty($section)){
            $section = $section['params_value'];
        }
        $this->assign('section',$section);
        return $this->fetch();
    }
    
    //删除联系
    public function deluser() {
        $Request = Request::instance();
        $id = $Request->param('id');
        if (!is_numeric($id) || empty($id)) {
            $this->error('参数错误！');
        }
        $result = db('supplier_contacts')->where(['con_id' => $id])->update(['status'=>'-1']);
        if ($result) {
            $this->success('删除联系人成功');
        } else {
            $this->error('删除操作错误');
        }
    }
    
    public function product(){
        $supplier_id = $this->request->param('supplier_id');
        $supplier = db('supplier')->where('id',$supplier_id)->find();
        if (empty($supplier)) {
            $this->error('供应商信息不存在');
        }
        $this->assign('data',$supplier);
        $this->assign('title','产品列表');
        $result = db('goods')->where(['supplier_id' => $supplier_id])->paginate(config('PAGE_SIZE'));
        $page = $result->render();
        $list = $result->all();
        foreach ($list as $key=>$value){
            $list[$key]['goods_attr'] = json_decode($value['goods_attr'],true);
        }
        $this->assign('lsdd',$list);
        $this->assign('page_l',$page);
        $this->assign('empty', '<tr><td colspan="19" align="center">当前条件没有查到数据</td></tr>');
        return $this->fetch();
    }
    
}