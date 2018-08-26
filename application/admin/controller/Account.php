<?php
namespace app\admin\controller;
class Account extends Base {
    
    public function index(){
        
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','应收账款');
        return $this->fetch();
    }
    
    public function newcreate(){
    	$cus_name = $this->request->param('cus_name');
    	$order_sn = $this->request->param('order_sn');
    	$start_time = $this->request->param('start_time');
    	$end_time = $this->request->param('end_time');
    	$db = db('delivery_order do');
    	$db->where(['do.is_invoice' => 0]);
    	if (!empty($cus_name)) {
    		$db->where(['do.cus_name' => ['like',"%{$cus_name}%"]]);
    	}
    	if (!empty($order_sn)){
    		$db->where(['o.order_sn' => $order_sn]);
    	}
    	if (strtotime($start_time) && strtotime($end_time)){
    		$db->where(['do.delivery_date' => ['>=',$start_time]]);
    		$db->where(['do.delivery_date' => ['<=',$end_time]]);
    	}
    	$result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
    	->join('__ORDER__ o','o.id=do.order_id')->join('__PURCHASE__ p','p.id=do.purchase_id')
    	->field('do.*,p.tax,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
    	->paginate(config('page_size'),false,['query' => $this->request->param()]);
    	$list = $result->all();
    	foreach ($list as $key => $value){
    		$category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
    		->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
    		$list[$key]['category_name'] = $category_name;
    	}
    	$this->assign('page',$result->render());
    	$this->assign('list',$list);
    	$this->assign('title','新建应收账款');
    	//cookie('soset',null);
    	$this->assign('soset',cookie('soset'));
    	return $this->fetch();
    }
    
    public function soset(){
    	if ($this->request->isAjax()){
    		$data = $this->request->param();
    		if (empty($data)) {
    			cookie('soset',null);
    			$this->success('ok');
    			return;
    		}
    		if (count(array_unique($data)) >= 2){
    			$this->error('销售单号不相同的不能创建对账单');
    		}
    		if (count(array_unique($data)) == 1){
    			cookie('soset',$data);
    			$this->success('ok');
    		}
    	}
    }
    
    public function create(){
    	$checked = cookie('soset');
    	if (empty($checked) || empty($checked['checked'])) $this->error('请选择销售单');
    	list($cus_id,$order_id) = explode('_', array_unique($checked['checked'])[0]);
    	/**
    	 * 1086_10
    	 * 1086_12
    	 */
    	$order_ids = [];
    	foreach ($checked['checked'] as $value){
    		$arr = explode('_', $value);
    		$order_ids[] = isset($arr[1]) ? $arr[1] : 0;
    	}
    	$order_ids = array_unique($order_ids);
    	if (isset($cus_id) && isset($order_ids)) {
    		$db = db('delivery_order do');
    		$db->where(['do.is_invoice' => 0]);
    		$result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
    		->join('__ORDER__ o','o.id=do.order_id')
    		->field('do.*,o.total_money,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
    		->where(['do.cus_id' => $cus_id,'do.order_id' => ['in',$order_ids]])->select();
    		foreach ($result as $key => $value){
    			$category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
    			->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
    			$result[$key]['category_name'] = $category_name;
    		}
    		if (empty($result)) $this->error('数据错误');
    		$order = db('order')->where(['id' => ['in',$order_ids]])->field('total_money,company_name,company_short')->select();
    		$total_money = 0;
    		$company_name = '';
    		foreach ($order as $key => $value){
    			$total_money += $value['total_money'];
    			$company_name = $value['company_name'];
    		}
    		$this->assign('total_money',_formatMoney($total_money));
    		$this->assign('company_name',$company_name);
    		if ($this->request->isAjax()){
    			$invoice_sn = $this->request->post('invoice_sn');
    			$invoice_date = $this->request->post('invoice_date');
    			$delivery_ids = $this->request->post('delivery_ids');
    			if (empty($invoice_sn)) $this->error('发票号码不能为空');
    			if (empty($invoice_date)) $this->error('开票日期不能为空');
    			$delivery_ids = [];
    			foreach ($result as $key => $value){
    				$delivery_ids[] = $value['id'];
    			}
    			$delivery_ids = array_unique($delivery_ids);
    			$data = [
    				'admin_uid' => $this->userinfo['id'],
    				'cus_id' => $cus_id,
    				'cus_name' => $company_name,
    				'delivery_ids' => implode('_', $delivery_ids),
    				'invoice_sn' => $invoice_sn,
    				'invoice_date' => $invoice_date,
    				'total_money' => _formatMoney($total_money),
    				'pay_money' => 0,'diff_money' => 0,
    				'is_open' => 0,'status' => 1,
    				'update_time' => time(),'create_time' => time()
    			];
    			if (db('receivables')->insert($data)){
    				db('delivery_order')->where(['id' => ['in',$delivery_ids]])->setField('is_invoice',1);
    				cookie('soset',null);
    				$this->success('保存成功',url('index'));
    			}else{
    				$this->error('保存失败请重试');
    			}
    			return;
    		}
    		
    		$this->assign('page','');
    		$this->assign('list',$result);
    		$this->assign('title','新建应收账款');
    		$this->assign('soset',cookie('soset'));
    		return $this->fetch();
    	}
    	$this->error('数据错误');
    }
    
    public function payment(){
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','应付账款');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function wait(){
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','采购发票待处理');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function add_payment(){
        $this->assign('sub_class','viewFramework-product-col-1');
    }
    
}