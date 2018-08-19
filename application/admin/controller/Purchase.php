<?php
namespace app\admin\controller;
use mpdf\mPDF;

class Purchase extends Base {
	
	private $send_email = '';
	
	public function index(){
		$supplier_name = $this->request->param('supplier_name');
		$start_time = $this->request->param('start_time');
		$end_time = $this->request->param('end_time');
		$status = $this->request->param('status');
		$categroy_id = $this->request->param('categroy_id');
		$db = db('purchase p');
		$db->field('p.*,s.supplier_name,o.order_sn,o.require_time');
		$where = ['p.status' => ['neq','-1']];
		if ($supplier_name != ''){
			$where['s.supplier_short'] = ['like',"%{$supplier_name}%"];
			$where['s.supplier_name'] = ['like',"%{$supplier_name}%"];
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
		$db->join('__ORDER__ o','o.id=p.order_id');
		$data = $db->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
		// 获取分页显示
		$page = $data->render();
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
				$value['goods_number'] = db('order_goods')->where(['order_id' => $purchase['order_id'],'goods_id' => $value['goods_id']])->value('goods_number');
				$value['store_number'] = db('goods')->where(['goods_id' => $value['goods_id']])->value('store_number');
				$value['totalMoney'] = _formatMoney($value['goods_price']*$value['goods_number']);
				$goodsInfo[$key] = json_encode($value);
			}
		}
		$purchase['goodsInfo'] = $goodsInfo;
		$this->assign('client',$cus);
		$this->assign('data',$purchase);
		$this->assign('page_l','');
		$this->assign('list',[]);
		$this->assign('title','采购单详情');
		return $this->fetch();
	}
	
	public function edit(){
		
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
    <td style="width:50%;">PO号码：'.$purchase['po_sn'].'</td>
    <td>采购日期：'.date('Y.m.d',$purchase['create_time']).'</td>
    </tr>
    <tr>
    <td style="width:50%;">销货方：'.config('syc_webname').'</td>
    <td>购货方：'.$cus['cus_name'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">地址：'.config('syc_address').'</td>
    <td>电话号码：'.$purchase['cus_phome'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">联系人：'.config('syc_contacts').'</td>
    <td>传真：'.$purchase['fax'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">电话号码：'.config('syc_webtel').'</td>
    <td>交易类别：'.$purchase['transaction_type'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">传真：'.config('syc_webfax').'</td>
    <td>付款条件：'.$purchase['payment'].'</td>
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
			$strContent .= '<tr>
        <td>'.($k+1).'</td>
    <td>'.$val['goods_name'].'</td>
	<td>'.$goods_attr_text.'</td>
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
		$strContent .= 	'<p style="width:87%;margin:10px auto 0 auto;">'.$purchase['remark'].'</p>';
		$img = getFileParams(11);
		
		$strContentFooter = '<table class="noborder" style="height:100px;">
<tbody>
    <tr>
    <td width="10%" align="right">供货方签署：</td>
    <td width="10%" align="left"><img src="'.$img.'" alt="" width="100px"/></td>
    <td width="80%"align="center">购货方签署：'.$purchase['contacts'].'（'.$purchase['cus_phome'].'）</td>
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
					$email_list = explode(',', $email_list);
					if (empty($email_list)) $this->error('请至少选择一个联系人');
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
			if (db('purchase')->where(['id' => $purchase['id']])->setField('status',1)){
				$this->success('确认采购单成功');
			}
			$this->error('确认采购单失败');
		}
	}
	
}