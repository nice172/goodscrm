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
    	return $this->fetch();
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