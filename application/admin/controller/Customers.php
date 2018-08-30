<?php

namespace app\admin\controller;

use think\Db;
use think\Loader;
use think\Request;
use app\admin\model\Customers AS CustomersModel;
use app\admin\model\CustomersPremises;
use app\admin\model\Purchase;
use app\admin\model\Logistics;
use app\admin\model\Finance AS FinanceModel;
use think\Url;

class Customers extends Base{
    public function _initialize(){
        return parent::_initialize(); // TODO: Change the autogenerated stub
    }

    public function index(){
        $Customers = new CustomersModel();
        $request = Request::instance();
        $query = $request->param(); // 分页查询传参数
        $status = $request->param('status'); // 状态查询
        $cus_short = $request->param('cus_short'); // 企业名称查询
        $start_time = $request->param('start_time'); // 企业名称查询
        $end_time = $request->param('end_time'); // 企业名称查询
        
        $where = "status=1";
        if ($start_time != '' && $end_time != ''){
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time.' 23:59:59');
            $where .= " and create_time >= '{$start_time}' and create_time <= '{$end_time}'";
        }
        if ($cus_short != ''){
            $where .= " and cus_short like '%{$cus_short}%'";
        }
        $data = $Customers->where($where)->paginate('', false, ['query' => $query ]);
//         foreach ($data as $key => $value){
//             $user = db('users')->where(['id' => $value['cus_order_ren']])->find();
//             $data[$key]['cus_order_ren'] = $user['user_nick'];
//         }
  
        // 获取分页显示
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('data', $data);
        $this->assign('empty', '<tr><td colspan="19" align="center">当前条件没有查到数据</td></tr>');
        $this->assign('title', '客户信息');
        return $this->fetch();
    }

    //添加
    public function add(){
        // 职员
        //$user = Db::name('users')->field('id,user_nick')->order('id','desc')->select();
        // 企业类型
        $property=Db::name('customers_type')->order('ty_id', 'asc')->select();
        // 评估等级
        $evaluate=Db::name('customers_evaluate')->order('eva_id', 'asc')->select();
        $this->assign('title', '新增客户');
        //$this->assign('user', $user);
        
        $section = getParams(7); //获取部门
        if (!empty($section)){
            $section = $section['params_value'];
        }
        $business = getParams(8); //获取业务经理
        if (!empty($business)){
            $business = $business['params_value'];
        }
        $order_ren = getParams(10); //获取跟单员
        if (!empty($order_ren)){
        	$order_ren= $order_ren['params_value'];
        }
        $this->assign('order_ren',$order_ren);
        $this->assign('business',$business);
        $this->assign('section',$section);
        $this->assign('property', $property);
        $this->assign('evaluate', $evaluate);
        return $this->fetch();
    }

    //添加提交
    public function add_do(){
        $request=Request::instance();
        if ($request->isPost()) {
            $duty = cutstr_html($request->param('con_duty'));
            $Customers = new CustomersModel();
            $validate = Loader::validate('Customers');
            if (!$validate->check($request->param())) {
                $this->error($validate->getError());
            }
            $find = db('customers')->where(['cus_name' => $request->param('con_name')])->find();
            if (!empty($find)){
                $this->error('公司名称已存在');
            }
            $city = $request->param('con_city');
            $dist = $request->param('con_dist');
            $cus_city = !empty($city) ? $city : '';
            $cus_dist = !empty($dist) ? $dist : '';

            $data = [
                'cus_name' => $request->param('con_name'),
                'cus_duty' => $duty,
                'cus_phome' => $request->param('con_phome'),
                'cus_fax' => $request->param('con_fax'),
                'cus_order_ren' => $request->param('con_order_ren'),
                'cus_mobile' => $request->param('con_mobile'),
                'cus_email' => $request->param('con_email'),
                'cus_business' => $request->param('con_business'),
                'cus_prov' => $request->param('con_prov'),
                'cus_city' => $cus_city,
                'cus_dist' => $cus_dist,
                'cus_sex' => $request->param('con_sex'),
                'cus_qq' => $request->param('con_qq'),
                'cus_section' => $request->param('con_section'),
                'cus_post' => $request->post('con_post'),
                'cus_short' => $request->param('con_short'),
                'cus_street' => $request->param('con_street'),
                'status' => 1
            ];
            $content = cutstr_html($request->param('con_content'));
            $result = $Customers->data($data)->save();
            if ($result) {
                $contact = [
                    'con_cus_id' => $Customers->cus_id,
                    'con_name' => $duty,
                    'con_sex' => $request->param('con_sex'),
                    'con_qq' => $request->param('con_qq'),
                    'con_post' => $request->post('con_post'),
                    'con_mobile' => $request->param('con_mobile'),
                    'con_email' => $request->param('con_email'),
                    'con_section' => $request->param('con_section'),
                    'con_address' => $data['cus_prov'].$data['cus_city'].$data['cus_dist'].$data['cus_street'],
                    'con_description' => $content,
                    'create_time' => time(),
                    'update_time' => time(),
                    'status' => 1
                ];
                db('customers_contact')->insert($contact);
                Db::name('customers_message')->insert(['msg_cus_id'=>$Customers->cus_id, 'msg_content'=>$content]);
                $this->success($data['cus_name'].' 添加成功',Url::build('customers/index'));
            } else {
                $this->error('数据操作有错误');
            }
        }
    }

    //修改企业信息
    public function edit() {
        $Request = Request::instance();
        $id = $Request->param('id');
        if (!is_numeric($id) || empty($id)) {
            $this->error('参数错误！');
        }
        $data = Db::name('customers')->where('cus_id', $id)->find();
        if (empty($data)) {
            $this->error('参数错误！');
        }

        $dataLog = '';
        //备注信息
        $message = Db::name('customers_message')->where('msg_cus_id', $id)->find();
        $assign = array(
            'title' => '修改客户信息',
            //'property' => $property,
            //'evaluate' => $evaluate,
            'data' => $data,
            'dataLog' => $dataLog,
            'msg' => $message,
        );
        $section = getParams(7); //获取部门
        if (!empty($section)){
            $section = $section['params_value'];
        }
        $business = getParams(8); //获取业务经理
        if (!empty($business)){
            $business = $business['params_value'];
        }
        $order_ren = getParams(10); //获取跟单员
        if (!empty($order_ren)){
        	$order_ren= $order_ren['params_value'];
        }
        $this->assign('order_ren',$order_ren);
        $this->assign('business',$business);
        $this->assign('section',$section);
        $this->assign($assign);
        return $this->fetch();
    }

    //提交修改企业信息
    public function edit_do() {
        $request = Request::instance();
        $id = $request->param('con_id');
        if (!is_numeric($id) || empty($id)) {
            $this->error('参数错误！');
        }
        $validate = Loader::validate('Customers');
        if (!$validate->check($request->param())) {
            $this->error($validate->getError());
        }
        $By = Db::name('customers')->where('cus_id', $id)->find();
        if (empty($By)) {
            $this->error('参数错误！');
        }
        $find = db('customers')->where(['cus_id' => ['neq',$id],'cus_name' => $request->param('con_name')])->find();
        if (!empty($find)){
            $this->error('公司名称已存在');
        }

        $city = $request->param('con_city');
        $dist = $request->param('con_dist');
        $cus_city = !empty($city) ? $city : '';
        $cus_dist = !empty($dist) ? $dist : '';
        $dist = $request->param('dist');
        $dist = !empty($dist) ? $dist : '';
        $data = [
            'cus_name' => $request->param('con_name'),
            'cus_duty' => $request->param('con_duty'),
            'cus_phome' => $request->param('con_phome'),
            'cus_fax' => $request->param('con_fax'),
        	'cus_order_ren' => $request->param('con_order_ren'),
            'cus_mobile' => $request->param('con_mobile'),
            'cus_email' => $request->param('con_email'),
            'cus_business' => $request->param('con_business'),
            'cus_prov' => $request->param('con_prov'),
            'cus_city' => $cus_city,
            'cus_dist' => $cus_dist,
            'cus_sex' => $request->param('con_sex'),
            'cus_qq' => $request->param('con_qq'),
            'cus_section' => $request->param('con_section'),
            'cus_post' => $request->post('con_post'),
            'cus_short' => $request->param('con_short'),
            'cus_street' => $request->param('con_street')
        ];
        
        Db::name('customers')->where('cus_id', $id)->update($data);
        Db::name('customers_message')->where('msg_cus_id', $id)->update(['msg_content'=>cutstr_html($request->param('con_content'))]);
        $this->success('修改成功', Url::build('customers/index'));
    }

    //查看基本信息
    public function view() {
        $Request = Request::instance();
        $id = $Request->param('id');
        $record = $Request->param('r');
        if (!is_numeric($id) || empty($id)) {
            $this->error('参数错误！');
        }
        $this->assign('record',$record);
        $Customers = new CustomersModel();
        $data = $Customers->where('cus_id', $id)->find();
        if (empty($data)) $this->error('客户信息不存在！');
        //备注信息
        $message = Db::name('customers_message')->where('msg_cus_id', $id)->find();
        //联系人
        $contact = Db::name('customers_contact')->where('con_cus_id', $id)->where('status','>=','1')->select();
        //默认收货信息
        //$premises = CustomersPremises::where('pre_cus_id', $id)->find();
        //历史订单
//         $purchase = new Purchase();
//         $lsdd = $purchase->where('pcus_id', $id)->order('pstart_date','deas')->paginate();
//         //遍历获取订金金额
//         foreach ($lsdd AS $key=>$val) {
//             //订单订金
//             $amo_dj = FinanceModel::where('fpnumber',$val['pnumber'])->where('sort',1)->sum('amount');
//             $lsdd[$key]['amo_dj'] = '￥'.number_format($amo_dj,2);
//             //订单余款
//             $amo_yk = FinanceModel::where('fpnumber',$val['pnumber'])->where('sort',2)->sum('amount');
//             $lsdd[$key]['amo_yk'] = '￥'.number_format($amo_yk,2);
//         }

        // 历史订单分页
        //$page_l = $lsdd->render();

        if ($record=='list'){
	        $result = Db::name('order o')->join('__CUSTOMERS_CONTACT__ c','o.con_id=c.con_id')
	        ->field('o.*,c.con_name,c.con_mobile,u.user_nick')
	        ->where(['o.cus_id' => $id])
	        ->join('__USERS__ u','o.create_uid=u.id')->order('o.create_time desc')->paginate(config('PAGE_SIZE'));
	        
	        $this->assign('lsdd',$result);
	        $this->assign('page_l',$result->render());
        
        }else{
        	$this->assign('lsdd',[]);
        	$this->assign('page_l','');
        }
        
        $assign = array(
            'title' => '查看信息',
            'data' => $data,
            'msg' => $message,
            'contact' => $contact,
            //'premises' => $premises,
            'empty_con' => '<tr><td colspan="8" align="center">当前条件没有查到数据</td></tr>',
            'empty_lsdd' => '<tr><td colspan="9" align="center">当前客户还没有订单</td></tr>',
        );
        $this->assign($assign);
        return $this->fetch();
    }

    //修改默认联系人
    public function adduser() {
        $Request = Request::instance();
        if ($Request->isPost()) {
            $conid = $Request->param('con');
            $cusid = $Request->param('cus');
            if (!is_numeric($conid) || empty($conid) && is_numeric($cusid) || empty($cusid)) {
                $this->error('参数错误！');
            }
            $result = Db::name('customers')->where('cus_id', $cusid)->update(['cus_con_id'=>$conid]);
            if ($result) {
            	$contacts = db('customers_contact')->where(['con_id' => $conid])->find();
            	Db::name('customers')->where('cus_id', $cusid)->update([
            		'cus_duty' => $contacts['con_name'],
            		'cus_mobile' => $contacts['con_mobile'],
            		'cus_email' => $contacts['con_email']
            	]);
                $this->success('设定默认联系人成功');
            } else {
                $this->error('设定错误！');
            }
        }
    }

    //删除操作
    public function delete() {
        $Request = Request::instance();
        if ($Request->isPost()) {
            $uid = $Request->param("uid");
            $name = $Request->param("name");
            if (empty($uid)) {
                $this->error('传入参数错误');
            }
            if ($name == 'delone') {
                // 单条删除操作
                Db::name('customers')->where('cus_id', $uid)->update(['status'=>'-1']);
                $this->success('删除成功', Url::build('customers/index'));
            } elseif ($name == 'delallattr') {
                // 多条删除操作
                $arrUid = explode(",",$uid);
                if (!empty($arrUid)) {
                    $i=0;
                    foreach ($arrUid as $key=>$val) {
                        Db::name('customers')->where('cus_id', $val)->update(['status'=>'-1']);
                        $i++;
                    }
                    $this->success($i.' 条记录删除成功', Url::build('customers/index'));
                }
            } else {
                // 不执行操作
                $this->error('传入参数错误');
            }
        }
    }

    //增加企业时判断名称是否存在
//    public function check_name() {
//        $Request = Request::instance();
//        if ($Request->isPost()) {
//            $name = $Request->param("name");
//            // 查询是否有此账户
//            $userDb = Db::name('customers')->where('cus_name', $name)->find();
//            if ($userDb) {
//                return false;
//            } else {
//                return true;
//            }
//        }
//    }

    //导出Excel
    public function excel() {
        $customers = Db::name('customers')->order('cus_prov asc')->select();
        foreach ($customers as $kc=>$vc) {
            //$dataResult
            //统计有没下过订单
            $xiadan = Db::name('purchase')->where('pcus_id', $vc['cus_id'])->count();
            //查找附加联系人
            $lianxi = Db::name('customers_contact')->where('con_cus_id', $vc['cus_id'])->find();

            $dataResult[$kc]['cus_prov'] = $vc['cus_prov'];
            $dataResult[$kc]['cus_city'] = $vc['cus_city'];
            $dataResult[$kc]['cus_dist'] = $vc['cus_dist'];
            $dataResult[$kc]['cus_street'] = $vc['cus_street'];
            $dataResult[$kc]['cus_name'] = $vc['cus_name'];
            //下单状况
            if ($xiadan > 0) {
                $dataResult[$kc]['status'] = '有下单';
            } else {
                $dataResult[$kc]['status'] = '未下单';
            }

            $dataResult[$kc]['cus_duty'] = $vc['cus_duty'];
            $dataResult[$kc]['cus_moble'] = $vc['cus_moble'];
            $dataResult[$kc]['cus_phome'] = $vc['cus_phome'];
            $dataResult[$kc]['cus_fax'] = $vc['cus_fax'];
            $dataResult[$kc]['qq'] = '';
            $dataResult[$kc]['cus_email'] = $vc['cus_email'];
            //第二联系人
            if (empty($lianxi)) {
                $dataResult[$kc]['lxr2'] = '';
                $dataResult[$kc]['lxdh2'] = '';
            } else {
                $dataResult[$kc]['lxr2'] = $lianxi['con_name'];
                $dataResult[$kc]['lxdh2'] = $lianxi['con_mobile'];
            }
            //物流信息
            $wuliu = Db::name('logistics')->where('log_id', $vc['cus_log_id'])->field('log_name,log_phone,log_address')->find();
            if (empty($wuliu)) {
                $dataResult[$kc]['log_name'] = '';
                $dataResult[$kc]['log_phone'] = '';
                $dataResult[$kc]['log_address'] = '';
            } else {
                $dataResult[$kc]['log_name'] = $wuliu['log_name'];
                $dataResult[$kc]['log_phone'] = $wuliu['log_phone'];
                $dataResult[$kc]['log_address'] = $wuliu['log_address'];
            }
        }
        $headTitle = \think\Config::get('syc_webname')." - 客户信息";
        $title = "客户信息-".date('Y-m-d');
        $headtitle= '<thead><tr style="height:50px;border-style:none;"><th border="0" style="height:60px;width:270px;font-size:22px;" colspan="17">'.$headTitle.'</th></tr>';
        $titlename = "<tr style='height:30px;'> 
               <th style='width:60px;'>省</th> 
               <th style='width:60px;'>市</th> 
               <th style='width:60px;'>区/县/镇</th> 
               <th style='width:150px;'>地址</th> 
               <th style='width:70px;'>单位</th> 
               <th style='width:50px;'>状态</th> 
               <th style='width:70px;'>联系人</th> 
               <th style='width:100px;'>手机</th> 
               <th style='width:70px;'>固话</th> 
               <th style='width:70px;'>传真</th> 
               <th style='width:90px;'>QQ</th> 
               <th style='width:90px;'>邮箱</th> 
               <th style='width:90px;'>联系人2</th> 
               <th style='width:90px;'>联系人2电话</th> 
               <th style='width:90px;'>物流名称</th> 
               <th style='width:90px;'>物流电话</th> 
               <th style='width:90px;'>物流地址</th>
           </tr></thead>";
        $filename = $title.".xls";
        $this->excelData($dataResult,$titlename,$headtitle,$filename);
    }

    /*
    *处理Excel导出
    *@param $datas array 设置表格数据
    *@param $titlename string 设置head
    *@param $title string 设置表头
    */
    public function excelData($datas,$titlename,$title,$filename){
        IS_ROOT([1,2,3,4])  ? true : $this->error('没有权限');
        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .="<table border=1>".$title."";
        $str .= $titlename;
        $str .= "<tbody>";
        foreach ($datas  as $key=> $rt )
        {
            $str .= "<tr>";
            foreach ( $rt as $k => $v )
            {
                $str .= "<td>{$v}</td>";
            }
            $str .= "</tr>\n";
        }
        $str .= "</tbody>";
        $str .= "</table>\r\n</body>\r\n</html>";
        header( "Content-Type: application/vnd.ms-excel; name='excel'" );
        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=".$filename );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );
        exit( $str );
    }
}