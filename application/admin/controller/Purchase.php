<?php
namespace app\admin\controller;
use mpdf\mPDF;
use think\Validate;

class Purchase extends Base {
	
	private $send_email = '';
	
	public function index(){
		$supplier_name = $this->request->param('supplier_name');
		$start_time = $this->request->param('start_time');
		$end_time = $this->request->param('end_time');
		$status = $this->request->param('status');
		$categroy_id = $this->request->param('categroy_id');
		$db = db('purchase p');
		$db->order('p.create_time desc');
		//$db->field('p.*,s.supplier_name,o.order_sn,o.require_time');
		$db->field('p.*,s.supplier_name');
		$where = ['p.status' => ['neq','-1']];
		if ($supplier_name != ''){
			//$where['s.supplier_short'] = ['like',"%{$supplier_name}%"];
			//$where['s.supplier_name'] = ['like',"%{$supplier_name}%"];
		    $db->where('s.supplier_short|s.supplier_name','like',"%{$supplier_name}%");
		}
		$db->where($where);
		if ($start_time != '' && $end_time != ''){
			$start_time = strtotime($start_time);
			$end_time = strtotime($end_time.' 23:59:59');
			if ($start_time && $end_time){
				$db->where("p.create_time",'>=',$start_time);
				$db->where("p.create_time",'<=',$end_time);
			}
		}
		$db->join('__SUPPLIER__ s','p.supplier_id=s.id');
		//$db->join('__ORDER__ o','o.id=p.order_id');
		$result = $db->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
		$data = $result->all();
		foreach ($data as $key => $value){
		    if ($value['order_id']){
		        $order = db('order')->where(['id' => $value['order_id']])->find();
		        $data[$key]['require_time'] = $order['require_time'];
		    }else{
		        $data[$key]['require_time'] = $value['create_time'];
		        $data[$key]['order_sn'] = '--';
		    }
		}
		$page = $result->render();
		$this->assign('page',$page);
		$this->assign('list',$data);
		$this->assign('title','采购单');
		$category = db('goods_category')->where(array('status' => 1))->select();
		$this->assign('category',$category);
		return $this->fetch();
	}
	
	public function info(){
		$id = $this->request->param('id',0,'intval');
		if ($id <= 0) $this->error('参数错误');
		$purchase = db('purchase')->where(['id' => $id,'status' => ['neq','-1']])->find();
		if (empty($purchase)) $this->error('采购单不存在');
		$goodsInfo = db('purchase_goods')->where(['purchase_id' => $purchase['id']])->order('goods_id asc')->select();
		$cus = db('customers')->where(['cus_id' => $purchase['cus_id']])->find();
		$purchase['supplier_name'] = db('supplier')->where(['id' => $purchase['supplier_id']])->value('supplier_name');
		$supplier = db('supplier_contacts')->where(['supplier_id' => $purchase['supplier_id']])->select();
		$this->assign('supplier',$supplier);
		if (!empty($goodsInfo)){
			foreach ($goodsInfo as $key => $value){
				$value['shop_price'] = $value['goods_price']; //实际价格
				$value['purchase_number'] = $value['goods_number'];
				if ($purchase['order_id']){
				    $value['goods_number'] = db('order_goods')->where(['order_id' => $purchase['order_id'],'goods_id' => $value['goods_id']])->value('goods_number');
				}else{
				    $value['goods_number'] = 0;
				}
				$value['store_number'] = db('goods')->where(['goods_id' => $value['goods_id']])->value('store_number');
				$value['totalMoney'] = _formatMoney($value['goods_price']*$value['goods_number']);
				$goodsInfo[$key] = json_encode($value);
			}
		}
		$purchase['goodsInfo'] = $goodsInfo;
		$this->assign('client',$cus);
		if (empty($purchase['order_sn'])){
		    $purchase['order_sn'] = '新建采购单';
		}
		$purchase['remark'] = str_replace("\n", '<br />', str_replace(chr(32), "&nbsp;&nbsp;", $purchase['remark']));
		$this->assign('data',$purchase);
		$this->assign('page_l','');
		$this->assign('list',[]);
		$this->assign('title','采购单详情');
		return $this->fetch();
	}
	
	protected $create_rule = [
	    //'order_id' => 'require',
	    //'order_sn' => 'require',
	    //'po_sn' => 'require|checkPosn:1',
	    'supplier_id' => 'require',
	    'cus_phome' => 'require',
	    'transaction_type' => 'require',
	    'payment' => 'require',
	    'delivery_type' => 'require',
	    //'delivery_company' => 'require',
	    'tax' => 'require',
	    //'delivery_address' => 'require',
	    'email' => 'require|email',
	    'contacts' => 'require',
	];
	protected $create_message = [
	    'order_id.require' => '订单ID参数错误',
	    'order_sn.require' => '关联订单号错误',
	    'po_sn.require' => 'PO号码不能为空',
	    'supplier_id.require' => '请选择供应商',
	    'contacts.require' => '联系人不能为空',
	    'email.require' => 'E-Mail不能为空',
	    'email.email' => 'E-Mail格式不正确',
	    'cus_phome.require' => '电话号码不能为空',
	    'transaction_type.require' => '请选择交易类别',
	    'payment.require' => '请选择付款条件',
	    'delivery_type.require' => '请选择交货方式',
	    //'delivery_company.require' => '送货公司不能为空',
	    'tax.require' => '请选择税率',
	    //'delivery_address.require' => '送货地址不能为空',
	    'po_sn.checkPosn' => 'PO号码已存在请刷新'
	];
	
	public function edit_do(){
	    if ($this->request->isAjax()){
	        $data = [
	            'id' => $this->request->post('id',0,'intval'),
	            'supplier_id' => $this->request->post('supplier_id'),
	            'cus_phome' => $this->request->post('cus_phome'),
	            'transaction_type' => $this->request->post('transaction_type'),
	            'payment' => $this->request->post('payment'),
	            'delivery_type' => $this->request->post('delivery_type'),
	            'delivery_company' => $this->request->post('delivery_company'),
	            'tax' => $this->request->post('tax'),
	            'delivery_address' => $this->request->post('delivery_address'),
	            'fax' => $this->request->post('fax'),
	            'email' => $this->request->post('email'),
	            'contacts' => $this->request->post('contacts'),
	            'status' => 0,
	            'remark' => $this->request->post('remark'),
	            'update_time' => time()
	        ];
	           if ($data['id'] <= 0) $this->error('保存采购单失败');
	           $validate = new Validate($this->create_rule,$this->create_message);
	            if (!$validate->check($data)){
	                $this->error($validate->getError());
	            }
	            $goodsInfo = $this->request->post('goods_info/a');
	            if (empty($goodsInfo)){
	                $this->error('商品信息不能为空');
	            }
	            $purchseGoods = [];
	            $totalMoney = 0;
	            foreach ($goodsInfo as $key => $value){
	                $countMoney = _formatMoney($value['purchase_number']*$value['shop_price']);
	                $purchseGoods[] = [
	                    'id' => isset($value['id']) ? intval($value['id']) : 0,
	                    'purchase_id' => isset($value['purchase_id']) ? intval($value['purchase_id']) : 0,
	                    'goods_id' => $value['goods_id'],
	                    'goods_name' => $value['goods_name'],
	                    'unit' => $value['unit'],
	                    'goods_number' => $value['purchase_number'],
	                    'goods_price' => $value['shop_price'],
	                    'count_money' => $countMoney,
	                    'goods_attr' => $value['goods_attr'],
	                    'create_time' => time()
	                ];
	                $totalMoney += $countMoney;
	            }
	            $data['total_money'] = _formatMoney($totalMoney);
	            if (db('purchase')->update($data)){
	                $purchase_id = $data['id'];
	                foreach ($purchseGoods as $value){
	                    $value['purchase_id'] = $purchase_id;
	                    if (!$value['id']){
	                        unset($value['id']);
	                        db('purchase_goods')->insert($value);
	                    }else{
	                        $pogoods_id = $value['id'];
	                        unset($value['create_time'],$value['id'],$value['purchase_id']);
	                        db('purchase_goods')->where(['id' => $pogoods_id,'purchase_id' => $purchase_id])->update($value);
	                    }
	                }
	                $this->success('保存采购单成功',url('purchase/info',['id' => $purchase_id]));
	            }else{
	                $this->error('保存采购单失败');
	            }
	    }
	}
	
	public function record(){
	    $id = $this->request->param('id',0,'intval');
	    $sid = $this->request->param('sid',0,'intval');
	    if ($id <= 0 || $sid <= 0) $this->error('参数错误');
	    $supplier = db('supplier')->where(['id' => $sid])->find();
	    if (empty($supplier)) $this->error('供应商不存在');
	    $list = db('purchase p')->join('__SUPPLIER__ s','p.supplier_id=s.id')
	    ->join('__USERS__ u','p.admin_uid=u.id')
	    ->where(['p.supplier_id' => $sid,'s.id' => $sid])->field('p.*,s.supplier_name,u.user_nick')
	    ->order('p.id desc')->paginate(config('PAGE_SIZE'));
	    
	    $this->assign('id',$id);
	    $this->assign('client',[]);
	    $this->assign('data',[]);
	    $this->assign('page',$list->render());
	    $this->assign('list',$list);
	    $this->assign('title','采购记录');
	    return $this->fetch();
	}
	
	public function edit(){
	    $id = $this->request->param('id',0,'intval');
	    if ($id <= 0) $this->error('参数错误');
	    $purchase = db('purchase')->where(['id' => $id,'status' => ['neq','-1']])->find();
	    if (empty($purchase)) $this->error('采购单不存在');
	    if ($purchase['status'] > 0) $this->error('采购单已确认不能修改');
	    $goodsInfo = db('purchase_goods')->where(['purchase_id' => $purchase['id']])->select();
	    if (!empty($goodsInfo)){
	        foreach ($goodsInfo as $key => $value){
	            $value['shop_price'] = $value['goods_price']; //实际价格
	            $value['purchase_number'] = $value['goods_number'];
	            $value['store_number'] = db('goods')->where(['goods_id' => $value['goods_id']])->value('store_number');
	            $value['totalMoney'] = _formatMoney($value['goods_price']*$value['purchase_number']);
	            $value['goods_number'] = db('order_goods')->where(['order_id' => $purchase['order_id'],'goods_id' => $value['goods_id']])->value('goods_number');
	            $goodsInfo[$key] = json_encode($value);
	        }
	    }
	    $purchase['goodsInfo'] = $goodsInfo;
	    $this->assign('data',$purchase);
	    
	    $client = db('customers')->where(['cus_id' => $purchase['cus_id']])->find();
	    $contacts = db('customers_contact')->where(['con_cus_id' => $client['cus_id']])->select();
	    $this->assign('client',$client);
	    $this->assign('contacts',$contacts);
	    
	    $this->_showParams();
	    
	    $this->assign('title','编辑采购单');
	    $this->assign('po_sn','PO'.date('Ymdis').date('sms'));
	    return $this->fetch();
	}
	
	public function view(){
		$id = $this->request->param('id',0,'intval');
		$this->create_pdf($id)->Output();
		exit;
	}
	
	private function create_pdf($id,$type=0){
		if ($id <= 0) $this->error('参数错误');
		$purchase = db('purchase')->where(['id' => $id,'status' => ['neq','-1']])->find();
		if (empty($purchase)) $this->error('采购单不存在');
		$goodsInfo = db('purchase_goods')->where(['purchase_id' => $purchase['id']])->order('goods_id asc')->select();
		$cus = db('customers')->where(['cus_id' => $purchase['cus_id']])->find();
		$this->assign('client',$cus);
		$this->assign('data',$purchase);
		$this->send_email = $purchase['email'];
		
		$supplier = db('supplier')->where(['id' => $purchase['supplier_id']])->find();
		
		$order = db('order')->where(['id' => $purchase['order_id']])->find();
		
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
		$strContent .= '<h2 style="text-align:center;padding:20px 0;">采购单</h2>';
		
		$strContent .= '<table class="noborder">
<tbody>
    <tr>
    <td style="width:50%;">客户订单号：'.$purchase['cus_order_sn'].'</td>
    <td>采购日期：'.date('Y.m.d',$purchase['create_time']).'</td>
    </tr>
    <tr>
    <td style="width:50%;">销货方：'.$supplier['supplier_name'].'</td>
    <td>购货方：'.config('syc_webname').'</td>
    </tr>
    <tr>
    <td style="width:50%;">地址：'.$supplier['supplier_province'].$supplier['supplier_city'].$supplier['supplier_area'].$supplier['supplier_address'].'</td>
    <td>联系人：'.config('syc_contacts').'</td>
    </tr>
    <tr>
    <td style="width:50%;">电话号码：'.$purchase['cus_phome'].'</td>
    <td>电话号码：'.config('syc_webtel').'</td>
    </tr>
    <tr>
    <td style="width:50%;">传真：'.$purchase['fax'].'</td>
    <td>传真：'.config('syc_webfax').'</td>
    </tr>
    <tr>
    <td style="width:50%;">送货公司：'.$purchase['delivery_company'].'</td>
    <td>交易类别：'.$purchase['transaction_type'].'</td>
    </tr>
    <tr>
    <td style="width:50%;"></td>
    <td>付款条件：'.$purchase['payment'].'</td>
    </tr>
    <tr>
    <td style="width:50%;"></td>
    <td>送货地址：'.$purchase['delivery_address'].'</td>
    </tr>
</tbody>
</table>';
		
		$strContent .= '<table class="table">
        <tbody>
            <tr>
            <td width="5%">序号</td>
            <td width="30%">产品名称</td>
			<td width="30%">产品规格</td>
            <td width="5%">单位</td>
			<td width="5%">数量</td>
            <td width="10%">单价</td>
			<td width="5%">税率</td>
			<td width="10%" style="border-right:none;">总金额</td>
            </tr>
        ';
		$count_goods = 0;
		foreach ($goodsInfo as $k => $val){
			$count_goods += $val['goods_number'];
			$goods_attr_text = '';
			$goods_attr = json_decode($val['goods_attr'],true);
			if (!empty($goods_attr)){
				foreach ($goods_attr as $attr){
					$goods_attr_text .= $attr['attr_value'].'&nbsp;';
				}
			}
			$val['type_name'] = db('goods g')->join('__GOODS_TYPE__ gt','g.goods_type_id=gt.goods_type_id')
			->where(['g.goods_id' => $val['goods_id']])->value('type_name');
			$strContent .= '<tr>
        <td>'.($k+1).'</td>
    <td>'.$val['type_name'].'</td>
	<td>'.$val['goods_name'].'</td>
    <td>'.$val['unit'].'</td>
<td>'.$val['goods_number'].'</td>
<td>'.$val['goods_price'].'</td>
<td>'.$purchase['tax'].'</td>
<td style="border-right:none;">'.$val['count_money'].'</td>
    </tr>
    ';
		}
		
		$strContent .= '<tr><td colspan="3">交货日期：'.date('Y-m-d',$order['require_time']).'</td><td></td><td></td><td></td><td></td><td style="border-right:none;"></td></tr>';
		$strContent .= '<tr><td colspan="3">金额大写：'._formatMoneyChinese($purchase['total_money']).'&nbsp;人民币</td><td></td><td>'.$count_goods.'</td><td></td><td></td><td style="border-right:none;">'.$purchase['total_money'].'</td></tr>';
		
		$strContent .= '</tbody></table>';
		$strContent .= '<p style="width:90%;margin:30px auto 0 auto;">备注：</p>';
		$strContent .= 	'<p style="width:87%;margin:10px auto 0 auto;">'.str_replace("\n", '<br />', str_replace(chr(32), "&nbsp;&nbsp;", $purchase['remark'])).'</p>';
		$img = getFileParams(11);
		//<td width="10%" align="left"><img src="'.$img.'" alt="" width="100px"/></td>
		$strContentFooter = '<table class="noborder" style="height:130px;">
<tbody>
    <tr>
    <td width="10%" align="right">供货方签署：</td>
    <td width="40%" align="left"></td>
    <td width="50%" align="center" style="height:150px;background:url('.$img.') no-repeat right center;">购货方签署：'.config('syc_contacts').'（'.config('syc_webtel').'）</td>
    </tr>
</tbody>
</table>';
		
		$mpdf->showWatermarkText = true;
		$mpdf->SetTitle("采购单");
		// 	   $mpdf->SetHTMLHeader( '头部' );
		$mpdf->SetHTMLFooter( $strContentFooter );
		$stylesheet='
body{padding:0;margin:0;font-family:"宋体";}
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
		$mpdf->WriteHTML($strContent);
		if ($type == 1){
			$savePath = './pdf/P'.str_replace('/', '-', $order['order_sn']).'.pdf';
			$mpdf->Output($savePath,'F');
			return $savePath;
		}
		return $mpdf;
	}
	
	public function confirm(){
		if ($this->request->isAjax()){
			$id = $this->request->param('id',0,'intval');
			if ($id <= 0) $this->error('参数错误');
			$purchase = db('purchase')->where(['id' => $id,'status' => ['neq','-1']])->find();
			if (empty($purchase)) $this->error('采购单不存在');
			if ($this->request->post('type') == 'send'){
				if ($purchase['status'] == 1){
					$email_list = $this->request->post('send_email_list');
					if (!empty($email_list)){
					   $email_list = explode(',', $email_list);
					}
					if (empty($email_list)) {
					    //$this->error('请至少选择一个联系人');
					    $email_list[] = $purchase['email'];
					}
					$email_list = array_unique($email_list);
					if (send_email($email_list,'采购单',$this->create_pdf($purchase['id'],1))){
						if(!db('purchase')->where(['id' => $purchase['id']])->setField('status',2)){
							$this->error('PDF发送成功,处理状态失败');
						}
						$this->success('PDF发送成功');
					}else{
						$this->error('PDF发送失败请重试');
					}
				}
				$this->error('生成PDF失败');
				return;
			}
			
			$goodsInfo = db('purchase_goods')->where(['purchase_id' => $purchase['id']])->select();
			
			foreach ($goodsInfo as $key => $value){
    			/*
			    $store_number = db('goods')->where(['goods_id' => $value['goods_id']])->value('store_number');
    			if ($store_number < $value['goods_number']){
    			    $this->error('“'.$value['goods_name'].'”采购数量不能大于库存量');
    			}
    			*/
    			if (!$purchase['create_type']){
    				/*
        			$goods_price = db('order_goods')->where(['order_id' => $purchase['order_id'],'goods_id' => $value['goods_id']])->value('goods_price');
        			if ($goods_price < $value['goods_price']){
        			    $this->error('“'.$value['goods_name'].'”采购单价不能高于关联订单价');
        			}
        			*/
    			}
    			if ($value['goods_number'] <= 0){
    			    $this->error('“'.$value['goods_name'].'”采购数量不能小于1');
    			}
			}
			if (db('purchase')->where(['id' => $purchase['id']])->setField('status',1)){
				$this->success('确认采购单成功');
			}
			$this->error('确认采购单失败');
		}
	}
	
	public function add(){
	    if ($this->request->isAjax()){
	        $data = [
	            'admin_uid' => $this->userinfo['id'],
	            'po_sn' => $this->request->post('po_sn'),
	            'cus_order_sn' => $this->request->post('cus_order_sn'),
	            'supplier_id' => $this->request->post('supplier_id'),
	            'cus_phome' => $this->request->post('cus_phome'),
	            'transaction_type' => $this->request->post('transaction_type'),
	            'payment' => $this->request->post('payment'),
	            'delivery_type' => $this->request->post('delivery_type'),
	            'delivery_company' => $this->request->post('delivery_company'),
	            'tax' => $this->request->post('tax'),
	            'delivery_address' => $this->request->post('delivery_address'),
	            'fax' => $this->request->post('fax'),
	            'email' => $this->request->post('email'),
	            'contacts' => $this->request->post('contacts'),
	            'status' => 0,
	            'remark' => $this->request->post('remark'),
	            'create_type' => 1,
	            'create_time' => time(),
	            'update_time' => time()
	        ];
	        $validate = new Validate($this->create_rule,$this->create_message);
	        if (!$validate->check($data)){
	            $this->error($validate->getError());
	        }
	        if (empty($data['po_sn'])) $this->error('PO号码不能为空');
	        if (!empty(db('purchase')->where(['po_sn' => $data['po_sn']])->find())) {
	            $this->error('PO号码已存在请刷新');
	        }
	        $goodsInfo = $this->request->post('goods_info/a');
	        if (empty($goodsInfo)){
	            $this->error('商品信息不能为空');
	        }
	        $purchseGoods = [];
	        $totalMoney = 0;
	        foreach ($goodsInfo as $key => $value){
	            if ($value['purchase_number'] <= 0){
	                $this->error('“'.$value['goods_name'].'”采购数量不能小于1');
	            }
	            $countMoney = _formatMoney($value['purchase_number']*$value['shop_price']);
	            $purchseGoods[] = [
	                'purchase_id' => isset($value['purchase_id']) ? intval($value['purchase_id']) : 0,
	                'goods_id' => $value['goods_id'],
	                'goods_name' => $value['goods_name'],
	                'unit' => $value['unit'],
	                'goods_number' => $value['purchase_number'],
	                'goods_price' => $value['shop_price'],
	                'count_money' => $countMoney,
	                'goods_attr' => $value['goods_attr'],
	                'create_time' => time()
	            ];
	            $totalMoney += $countMoney;
	        }
	        $data['total_money'] = _formatMoney($totalMoney);
	        if (db('purchase')->insert($data)){
	            $purchase_id = db('purchase')->getLastInsID();
	            foreach ($purchseGoods as $value){
	                $value['purchase_id'] = $purchase_id;
	                db('purchase_goods')->insert($value);
	            }
	            $this->success('保存采购单成功',url('info',['id' => $purchase_id]));
	        }else{
	            $this->error('保存采购单失败');
	        }
	        
	        return;
	    }
	    //$client = db('customers')->where(['cus_id' => 1686])->find();
	    //$contacts = db('customers_contact')->where(['con_cus_id' => $client['cus_id']])->select();
	    //$this->assign('client',$client);
	    //$this->assign('contacts',$contacts);
        
	    $this->_showParams();
	    $this->assign('title','新建采购单');
	    $this->assign('po_sn','PO'.date('Ymdis').date('sms'));
	    return $this->fetch();
	}
	
	private function _showParams(){
	    $supplier = db('supplier')->where(['supplier_status' => ['neq','-1']])->select();
	    $this->assign('supplier',$supplier);
	    
	    $trans_type = getParams(5);
	    if (!empty($trans_type)){
	        $trans_type = $trans_type['params_value'];
	    }
	    $this->assign('trans_type',$trans_type);
	    $payment = getParams(1);
	    if (!empty($payment)){
	        $payment = $payment['params_value'];
	    }
	    $this->assign('payment',$payment);
	    
	    $tax = getParams(17);
	    if (!empty($tax)){
	        $tax = $tax['params_value'];
	    }
	    $this->assign('tax',$tax);
	    $delivery_type = getParams(16);
	    if (!empty($delivery_type)){
	        $delivery_type = $delivery_type['params_value'];
	    }
	    $this->assign('delivery_type',$delivery_type);
	    
	    $remark = getTextParams(18);
	    $this->assign('remark',$remark);
	}
	
	public function newedit(){
	    $id = $this->request->param('id',0,'intval');
	    if (!$id) $this->error('参数错误');
	    $purchase = db('purchase')->where(['id' => $id])->find();
	    if (empty($purchase)) $this->error('采购单不存在');
	    if ($purchase['status'] > 0) $this->error('采购单已确认不能修改');
	    if ($this->request->isAjax()){
	        $data = [
	            'supplier_id' => $this->request->post('supplier_id'),
	            'cus_phome' => $this->request->post('cus_phome'),
	            'transaction_type' => $this->request->post('transaction_type'),
	            'payment' => $this->request->post('payment'),
	            'delivery_type' => $this->request->post('delivery_type'),
	            'delivery_company' => $this->request->post('delivery_company'),
	            'tax' => $this->request->post('tax'),
	            'delivery_address' => $this->request->post('delivery_address'),
	            'fax' => $this->request->post('fax'),
	            'email' => $this->request->post('email'),
	            'contacts' => $this->request->post('contacts'),
	            'status' => 0,
	            'remark' => $this->request->post('remark'),
	            'update_time' => time()
	        ];
	        $validate = new Validate($this->create_rule,$this->create_message);
	        if (!$validate->check($data)){
	            $this->error($validate->getError());
	        }
	        $goodsInfo = $this->request->post('goods_info/a');
	        if (empty($goodsInfo)){
	            $this->error('商品信息不能为空');
	        }
	        $purchseGoods = [];
	        $totalMoney = 0;
	        foreach ($goodsInfo as $key => $value){
	            if ($value['purchase_number'] <= 0){
	                $this->error('“'.$value['goods_name'].'”采购数量不能小于1');
	            }
	            $countMoney = _formatMoney($value['purchase_number']*$value['shop_price']);
	            $purchseGoods[] = [
	                'id' => isset($value['id']) ? intval($value['id']) : 0,
	                'purchase_id' => isset($value['purchase_id']) ? intval($value['purchase_id']) : 0,
	                'goods_id' => $value['goods_id'],
	                'goods_name' => $value['goods_name'],
	                'unit' => $value['unit'],
	                'goods_number' => $value['purchase_number'],
	                'goods_price' => $value['shop_price'],
	                'count_money' => $countMoney,
	                'goods_attr' => $value['goods_attr'],
	                'create_time' => time()
	            ];
	            $totalMoney += $countMoney;
	        }
	        $data['total_money'] = _formatMoney($totalMoney);
	        if (db('purchase')->where(['id' => $id])->update($data)){
	            $purchase_id = $id;
	            foreach ($purchseGoods as $value){
	                $value['purchase_id'] = $purchase_id;
	                if (!$value['id']){
	                    unset($value['id']);
	                    db('purchase_goods')->insert($value);
	                }else{
	                    $pogoods_id = $value['id'];
	                    unset($value['create_time'],$value['id'],$value['purchase_id']);
	                    db('purchase_goods')->where(['id' => $pogoods_id,'purchase_id' => $purchase_id])->update($value);
	                }
	            }
	            $this->success('保存采购单成功',url('info',['id' => $purchase_id]));
	        }else{
	            $this->error('保存采购单失败');
	        }
	        
	        return;
	    }
	    $goodsInfo = db('purchase_goods')->where(['purchase_id' => $purchase['id']])->select();
	    if (!empty($goodsInfo)){
	        foreach ($goodsInfo as $key => $value){
	            $value['shop_price'] = $value['goods_price']; //实际价格
	            $value['purchase_number'] = $value['goods_number'];
	            $value['store_number'] = db('goods')->where(['goods_id' => $value['goods_id']])->value('store_number');
	            $value['totalMoney'] = _formatMoney($value['goods_price']*$value['purchase_number']);
	            $value['goods_number'] = db('order_goods')->where(['order_id' => $purchase['order_id'],'goods_id' => $value['goods_id']])->value('goods_number');
	            $goodsInfo[$key] = json_encode($value);
	        }
	    }
	    $purchase['goodsInfo'] = $goodsInfo;
	    $this->assign('data',$purchase);
	    $this->_showParams();
	    $this->assign('title','编辑采购单');
	    return $this->fetch();
	}
	
	public function getsupplier(){
		$supplier_id = $this->request->param('supid',0,'intval');
		if ($supplier_id > 0){
		    $data = db('supplier')->where(['id' => $supplier_id])->find();
		    $this->success('','',['cus_phome' => $data['supplier_mobile'],
		        'email' => $data['supplier_email'],
		        'contacts' => $data['supplier_contacts'],
		        'fax' => $data['supplier_fax'],
		        'supplier_payment' => $data['supplier_payment']
		    ]);
		}
		$this->error('');
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
	        $lists[$key]['purchase_number'] = 0;
	        $lists[$key]['show_input'] = true;
	    }
	    
	    $this->assign('data',$lists);
	    $this->assign('page',$result->render());
	    
	    return $this->fetch();
	}
	
}