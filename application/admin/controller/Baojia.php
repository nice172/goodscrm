<?php
namespace app\admin\controller;
use app\admin\model\Customers;
use think\Request;
use think\Validate;
use mpdf\mPDF;

class Baojia extends Base {
	
	protected $rules = [
	    'company_name' => 'require',
	    'company_short' => 'require',
	    'contacts' => 'require',
	    'email' => 'require|email',
	    'order_handle' => 'require'
	];
	protected $message = [
	    'company_name.require' => '公司名称不能为空',
	    'company_short.require' => '简称不能为空',
	    'contacts.require' => '联系人不能为空',
	    'email.require' => 'E-Mail不是能为空',
	    'email.email' => 'E-Mail格式不正确',
	    'order_handle.require' => '请选择跟单员'
	];
	
	public function index(){
	    $company_short = $this->request->param('company_short'); // 企业名称查询
	    $start_time = $this->request->param('start_time'); // 企业名称查询
	    $end_time = $this->request->param('end_time'); // 企业名称查询
	    $db = db('baojia');
	    $where = ['status' => ['neq','-1']];
	    if ($company_short != ''){
	        //$where['company_short'] = ['like',"%{$company_short}%"];
	        //$where['company_name'] = ['like',"%{$company_short}%"];
	        $db->where('company_short|company_name','like',"%{$company_short}%");
	    }
	    $db->where($where);
	    if ($start_time != '' && $end_time != ''){
	        $start_time = strtotime($start_time);
	        $end_time = strtotime($end_time.' 23:59:59');
	        if ($start_time && $end_time){
	            $db->where("create_time",'>=',$start_time);
	            $db->where("create_time",'<=',$end_time);
	        }
	    }
	    $data = $db->order('create_time desc')->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
	    // 获取分页显示
	    $page = $data->render();
	    $this->assign('page',$page);
		$this->assign('list',$data);
		$this->assign('title','报价列表');
		return $this->fetch();
	}
	
	public function add(){
		if ($this->request->isAjax()){
		    $send_type = $this->request->post('type');
		    $data = [
		        'create_uid' => $this->userinfo['id'],
		        'cus_id' => $this->request->post('cus_id'),
		        'order_sn' => $this->request->post('order_sn'),
		        'company_name' => $this->request->post('company_name'),
		        'company_short' => $this->request->post('company_short'),
		        'fax' => $this->request->post('fax'),
		        'email' => $this->request->post('email'),
		        'contacts' => $this->request->post('contacts'),
		        'order_remark' => $this->request->post('order_remark'),
		        'status' => $send_type=='save'?0:1,
		        'order_handle' => $this->request->post('order_handle'),
		        'create_time' => time(),
		        'update_time' => time()
		    ];
		    $validate = new Validate($this->rules, $this->message);
		    if (!$validate->check($data)){
		        $this->error($validate->getError());
		    }
		    $goodsInfo = $this->request->param('goods_info/a');
		    if (empty($goodsInfo)){
		        $this->error('请选择商品');
		    }
		    $baojia_id = db('baojia')->insertGetId($data);
		    if ($baojia_id){
		        foreach ($goodsInfo as $val){
		            db('baojia_goods')->insert([
		                'baojia_id' => $baojia_id,
		                'goods_id' => $val['goods_id'],
		                'goods_name' => $val['goods_name'],
		                'unit' => $val['unit'],
		                'goods_price' => $val['market_price'],
		                'remark' => $val['remark'],
		                'create_time' => time()
		            ]);
		        }
		        if ($send_type != 'save'){
		            if ($this->_send_pdf($baojia_id)){
		                $this->success('生成PDF文件并发送成功',url('index'));
		            }else{
		                $this->success('保存成功，邮件发送失败',url('index'));
		            }
		        }
		        $this->success('保存成功',url('info',['gid' => $baojia_id]));
		    }else{
		        $this->error('保存失败请重试');
		    }
			return;
		}
		$order_handle = getParams(10);
		if (!empty($order_handle)){
		    $order_handle = $order_handle['params_value'];
		}
		$order_remark = getTextParams(13);
		$this->assign('order_remark',$order_remark);
		$this->assign('order_handle',$order_handle);
		$this->assign('title','新增报价单');
		return $this->fetch();
	}
	
	public function edit(){
	    if ($this->request->isAjax()){
	        $send_type = $this->request->post('type');
	        $data = [
	            'id' => $this->request->post('id'),
	            'cus_id' => $this->request->post('cus_id'),
	            'order_sn' => $this->request->post('order_sn'),
	            'company_name' => $this->request->post('company_name'),
	            'company_short' => $this->request->post('company_short'),
	            'fax' => $this->request->post('fax'),
	            'email' => $this->request->post('email'),
	            'order_handle' => $this->request->post('order_handle'),
	            'contacts' => $this->request->post('contacts'),
	            'order_remark' => $this->request->post('order_remark'),
	            'status' => $send_type=='save'?0:1,
	            'update_time' => time()
	        ];
	        $validate = new Validate($this->rules, $this->message);
	        if (!$validate->check($data)){
	            $this->error($validate->getError());
	        }
	        $goodsInfo = $this->request->param('goods_info/a');
	        if (empty($goodsInfo)){
	            $this->error('请选择商品');
	        }
	        $in = db('baojia_goods')->where(['baojia_id' => $data['id']])->field('id')->select();
	        $ids = [];
	        foreach ($in as $val){
	            $ids[] = $val['id'];
	        }
	        $postIds = [];
	        foreach ($goodsInfo as $value){
	            if (isset($value['id']) && intval($value['id']) > 0){
	               $postIds[] = $value['id'];
	            }
	        }
	        $affected = db('baojia')->update($data);
	        if ($affected){
	            $tempArr = array_count_values(array_merge($ids,$postIds));
	            foreach ($tempArr as $key => $count){
	                if ($count == 1){
	                    db('baojia_goods')->where(['id' => $key,'baojia_id' => $data['id']])->delete();
	                }
	            }
	            foreach ($goodsInfo as $val){
	                if (!isset($val['id']) || intval($val['id']) <= 0){
    	                db('baojia_goods')->insert([
    	                    'baojia_id' => $data['id'],
    	                    'goods_id' => $val['goods_id'],
    	                    'goods_name' => $val['goods_name'],
    	                    'unit' => $val['unit'],
    	                    'goods_price' => $val['market_price'],
    	                    'remark' => $val['remark'],
    	                    'create_time' => time()
    	                ]);
	                }else{
	                    db('baojia_goods')->where(['baojia_id' => $data['id'],'id' => intval($val['id'])])->update([
	                        'goods_id' => $val['goods_id'],
	                        'goods_name' => $val['goods_name'],
	                        'unit' => $val['unit'],
	                        'goods_price' => $val['market_price'],
	                        'remark' => $val['remark']
	                    ]);
	                }
	            }
	            if ($send_type != 'save'){
	                if($this->_send_pdf($data['id'])){
	                    $this->success('生成PDF文件并发送成功',url('index'));
	                }else{
	                    $this->success('保存成功，邮件发送失败',url('index'));
	                }
	            }
	            $this->success('保存成功',url('index'));
	        }else{
	            $this->error('保存失败请重试');
	        }
	        return;
	    }
	    $id = $this->request->param('gid',0,'intval');
	    if ($id <= 0) $this->error('参数错误');
	    $order = db('baojia')->where(['id' => $id,'status' => ['neq','-1']])->find();
	    if (empty($order)) $this->error('报价单不存在');
	    $goodsInfo = db('baojia_goods')->where(['baojia_id' => $order['id']])->select();
	    if (!empty($goodsInfo)){
	        foreach ($goodsInfo as $key => $value){
	            $value['market_price'] = $value['goods_price'];
	            $goodsInfo[$key] = json_encode($value);
	        }
	    }
	    $order['goodsInfo'] = $goodsInfo;
	    $order_handle = getParams(10);
	    if (!empty($order_handle)){
	        $order_handle = $order_handle['params_value'];
	    }
	    $this->assign('order',$order);
	    $this->assign('order_handle',$order_handle);
	    $this->assign('title','修改报价单');
	    return $this->fetch();
	}
	
	public function info(){
	    $id = $this->request->param('gid',0,'intval');
	    if ($id <= 0) $this->error('参数错误');
	    $order = db('baojia')->where(['id' => $id,'status' => ['neq','-1']])->find();
	    if (empty($order)) $this->error('报价单不存在');
	    $goodsInfo = db('baojia_goods')->where(['baojia_id' => $order['id']])->order('goods_id asc')->select();
	    $cus = db('customers')->where(['cus_id' => $order['cus_id']])->find();
	    $this->assign('client',$cus);
	    $order['order_remark'] = str_replace("\n", '<br />', str_replace(chr(32), "&nbsp;&nbsp;", $order['order_remark']));
	    $this->assign('data',$order);
	    $this->assign('goodsList',$goodsInfo);
	    $list = db('baojia')->where(['cus_id' => $order['cus_id']])
	    ->order('create_time desc')->limit(10)->select();
	    foreach ($list as $key => $value){
	        $list[$key]['user_nick'] = db('users')->where(['id' => $value['create_uid']])->value('user_nick');
	    }
	    $this->assign('list',$list);
	    $this->assign('page_l','');
	    $this->assign('title','报价单详情');
	    return $this->fetch();
	}
	
	private $send_email = '';
	
	private function _createPDF($id,$type=0){
	    $order = db('baojia')->where(['id' => $id,'status' => ['neq','-1']])->find();
	    if (empty($order)) $this->error('报价单不存在');
	    $goodsInfo = db('baojia_goods')->where(['baojia_id' => $order['id']])->order('goods_id asc')->select();
	    $cus = db('customers')->where(['cus_id' => $order['cus_id']])->find();
	    $this->assign('client',$cus);
	    $this->assign('data',$order);
	    $this->send_email = $order['email'];
	    $this->assign('goodsList',$goodsInfo);
	    $list = db('baojia')->where(['cus_id' => $order['cus_id']])->order('create_time desc')->limit(10)->select();
	    foreach ($list as $key => $value){
	        $list[$key]['user_nick'] = db('users')->where(['id' => $value['create_uid']])->value('user_nick');
	    }
	    $this->assign('list',$list);
	    $this->assign('page_l','');
	    $this->assign('title','报价单详情');
	    
	    $mpdf = new mPDF('zh-CN/utf-8','A4', 0, '宋体', 0, 0);
	    $mpdf->SetWatermarkText(getTextParams(14),0.1);
	    $logo = getFileParams(12);
	    if (empty($logo)) {
	        $logo = './assets/img/crm_logo.png';
	    }
	    $strContent = '<div style="width:90%;margin:0 auto;height:90px;background:#fff url('.$logo.') no-repeat top 20px;">';
	    $strContent .= '<h1 style="padding-top:10px;text-align:center;font-size:32px;">'.getTextParams(14).'</h1>';
	    $strContent .= '<p class="entitle" style="font-size:22px;">'.getTextParams(15).'</p>';
	    $strContent .= '</div>';
	    $strContent .= '<h2 style="text-align:center;padding:20px 0;">报价单</h2>';
	    
	    $strContent .= '<table class="noborder">
<tbody>
    <tr>
    <td style="width:70%;">致：'.$cus['cus_name'].'</td>
    <td>日期：'.date('Y.m.d',$order['create_time']).'</td>
    </tr>
    <tr>
    <td style="width:70%;">收：'.$order['contacts'].'</td>
    <td>编号：'.$order['order_sn'].'</td>
    </tr>
    <tr>
    <td style="width:70%;">传真：'.$order['fax'].'</td>
    <td>邮箱：'.$order['email'].'</td>
    </tr>
</tbody>
</table>';
	    
	    $strContent .= '<table class="table">
        <tbody>
            <tr>
            <td width="10%">序号</td>
            <td width="60%">产品名称</td>
            <td width="10%">单位</td>
            <td width="20%" style="border-right:none;">含税单价(RMB)</td>
            </tr>
        ';
	    foreach ($goodsInfo as $k => $val){
	        $strContent .= '<tr>
        <td>'.($k+1).'</td>
    <td>'.$val['goods_name'].'</td>
    <td>'.$val['unit'].'</td>
<td style="border-right:none;">'.$val['goods_price'].'</td>
    </tr>
    ';
	    }
	    $strContent .= '</tbody></table>';
	    $strContent .= '<p style="width:90%;margin:30px auto 0 auto;">备注：</p>';
	    $strContent .= 	'<p style="width:87%;margin:10px auto 0 auto;">'.str_replace("\n", '<br />', str_replace(chr(32), "&nbsp;&nbsp;", $order['order_remark'])).'</p>';
	    
	    $img = getFileParams(11);
	    
	    $strContentFooter = '<table class="noborder" style="height:100px;">
<tbody>
    <tr>
    <td width="27%">客户回签：</td>
    <td width="10%"align="right">审核：</td>
    <td width="23%"align="left"><img src="'.$img.'" alt="" width="100px"/></td>
    <td width="40%"align="center" style="border-right:none;">业务：'.$cus['cus_business'].'<br />'.$cus['cus_mobile'].'</td>
    </tr>
</tbody>
</table>';
	    
	    $mpdf->showWatermarkText = true;
	    $mpdf->SetTitle("报价单");
	    // 	   $mpdf->SetHTMLHeader( '头部' );
	    $mpdf->SetHTMLFooter( $strContentFooter );
	    $stylesheet='
body{padding:0;margin:0;}
h1,h2,h3,p,div,span{padding:0;margin:0;}
.entitle{text-align:center;}
.noborder{font-size: 13px;background: #FFF;width:95%;margin: 0 auto;border-spacing: 0;border-collapse: collapse;}
.noborder tbody tr td{padding:5px 0;}
.table{
    width:95%;
    margin: 0 auto;
    border-spacing: 0;
    border-collapse: collapse;
}
.table{
    background: #FFF;
    font-size: 13px;
    border-top: 1px solid #000;
    margin-top: 8px;
    border: 1px solid #000;
}
.table tbody tr td{
    padding: 12px 8px;
    border-top: 0px;
    border-bottom: 1px solid #000;
    border-right: 1px solid #000;
    vertical-align: middle;
}
';
	    $mpdf->WriteHTML($stylesheet, 1);
	    // 	   $mpdf->WriteHTML('h1{font-size:106px;}',1);
	    $mpdf->WriteHTML($strContent);
	    if ($type == 1){
	        $savePath = './pdf/B'.str_replace('/', '-', $order['order_sn']).'.pdf';
	        $mpdf->Output($savePath,'F');
	        return $savePath;
	    }
	    return $mpdf;
	}
	
	public function pdf(){
	    $id = $this->request->param('gid',0,'intval');
	    if ($id <= 0) $this->error('参数错误');
	    $mpdf = $this->_createPDF($id);
	   //保存ss.pdf文件
	   //$mpdf->Output('ss.pdf');
	   //直接浏览器输出pdf
// 	   $mpdf->Output('报价单.pdf','D');//下载
// 	   $mpdf->Output('tmp.pdf','d');
	   //$mpdf->Output('./pdf/B'.str_replace('/', '-', $order['order_sn']).'.pdf','F'); //保存本地
	   $mpdf->Output();
	   exit;
	}
	
	private function _send_pdf($id){
	    $savePath = $this->_createPDF($id,1);
	    if(send_email($this->send_email,'报价单',$savePath)){
	        db('baojia')->where(['id' => $id])->update(['status' => 1,'send_email_time' => time()]);
	       return true;
	    }
	    return false;
	}
	
	public function send(){
	    if ($this->request->isAjax()){
	    $bid = $this->request->param('gid',0,'intval');
	    if ($bid <= 0){
	        $this->error('参数错误');
	    }
	    $savePath = $this->_createPDF($bid,1);
	    if(send_email($this->send_email,'报价单',$savePath)){
	        db('baojia')->where(['id' => $bid])->update(['status' => 1,'send_email_time' => time()]);
	        $this->success('发送成功');
	    }
	    $this->error('发送失败');
	    }
	}
	
	public function ajaxdel(){
	    return;
	    if ($this->request->isAjax()){
	        $baojia_id = $this->request->param('baojia_id',0,'intval');
	        $bid = $this->request->param('bid',0,'intval');
	        if ($baojia_id <= 0 || $bid <= 0){
	            $this->error('参数错误');
	        }
	        if (db('baojia_goods')->where(['id' => $bid,'baojia_id' => $baojia_id])->delete()){
	            $this->success('删除成功');
	        }
	        $this->error('删除失败');
	    }
	}
	
	public function search_company(){
		$order_ren = getParams(10); //获取跟单员
		if (!empty($order_ren)){
			$order_ren= $order_ren['params_value'];
		}
		
		$Customers = new Customers();
		$request = Request::instance();
		$query = $request->param(); // 分页查询传参数
		$status = $request->param('status'); // 状态查询
		$cus_short = $request->param('cus_short'); // 企业名称查询
		$get_order_ren = $request->param('order_ren'); // 企业名称查询
		$where = "status=1";
		if ($get_order_ren != ''){
			$where .= " and cus_order_ren='{$get_order_ren}'";
		}
		if ($cus_short != ''){
			$where .= " and cus_short like '%{$cus_short}%'";
		}
		$data = $Customers->where($where)->paginate('', false, ['query' => $query ]);		
		// 获取分页显示
		$page = $data->render();
		$this->assign('page',$page);
		$this->assign('data', $data);
		$this->assign('empty', '<tr><td colspan="19" align="center">当前条件没有查到数据</td></tr>');
		$this->assign('title', '客户信息');
		
		$this->assign('order_ren',$order_ren);
		return $this->fetch();
	}
	
	public function get_goods(){
		$cate_lists = db('goods_category')->select();
		$this->assign('lists',$cate_lists);
		
		$goods_name = $this->request->param('goods_name');
		$category_id = $this->request->param('category_id',0,'intval');
		
		$where = ['status' => ['neq','-1']];
		if ($goods_name != ''){
			$where['goods_name'] = ['like',"%$goods_name%"];
		}
		if ($category_id > 0) {
			$where['category_id'] = $category_id;
		}
		$result = db('goods')->where($where)->paginate(config('PAGE_SIZE'),false,['query' => $this->request->param()]);
				
		$lists = $result->all();
		
		foreach ($lists as $key => $value){
			$supplier = db('supplier')->where(['id' => $value['supplier_id']])->find();
			$lists[$key]['supplier_name'] = $supplier['supplier_name'];
			$category = db('goods_category')->where(['category_id' => $value['category_id']])->find();
			$lists[$key]['category_name'] = $category['category_name'];
			$brand = db('goods_brand')->where(['brand_id' => $value['brand_id']])->find();
			$lists[$key]['brand_name'] = $brand['brand_name'];
		}
		
		$this->assign('data',$lists);
		$this->assign('page',$result->render());
		
		return $this->fetch();
	}
	
	public function delete(){
	    if ($this->request->isAjax()){
	        $goods_id = $this->request->param('gid',0,'intval');
	        if ($goods_id <= 0){
	            $this->error('参数错误');
	        }
	        if (db('baojia')->where(['id' => $goods_id])->setField('status','-1')){
	            $this->success('删除成功');
	        }
	        $this->error('删除失败');
	    }
	}
	
	public function record(){
		
	}
	
}