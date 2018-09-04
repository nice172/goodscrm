<?php
namespace app\admin\controller;
class Account extends Base {
    
    public function index(){
    	$cus_name = $this->request->param('cus_name');
    	$open_status = $this->request->param('open_status');
    	$start_time = $this->request->param('start_time');
    	$end_time = $this->request->param('end_time');
    	$invoice_status = $this->request->param('invoice_status');
    	$db = db('receivables');
    	$db->where(['is_delete' => 0]);
    	if ($cus_name != ''){
    		$db->where('cus_name','like',"%{$cus_name}%");
    	}
    	if (strtotime($start_time) && strtotime($end_time)){
    		$db->where(['invoice_date' => ['>=', $start_time]]);
    		$db->where(['invoice_date' => ['<=', $end_time]]);
    	}
    	if ($open_status != ''){
    		$db->where(['is_open' => $open_status]);
    	}
    	if ($invoice_status != ''){
    		$db->where(['status' => $invoice_status]);
    	}
        $result = $db->order('create_time desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
        $this->assign('page',$result->render());
        $this->assign('list',$result->all());
        $this->assign('title','应收账款');
        cookie('soset',null);
        return $this->fetch();
    }
    
    public function delete(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('receivables')->where(['id' => $id])->setField('is_delete',1)){
                $delivery_ids = db('receivables')->where(['id' => $id])->value('delivery_ids');
                db('delivery_order')->where(['id' => ['in',$delivery_ids]])->setField('is_invoice',0);
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function close(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('receivables')->where(['id' => $id])->setField('status',0)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function open(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('receivables')->where(['id' => $id])->setField('is_open',1)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function status(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('receivables')->where(['id' => $id])->setField('status',2)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function info(){
        $id = $this->request->param('id',0,'intval');
        if (empty($id)) $this->error('参数错误');
        $receivables = db('receivables')->where(['id' => $id,'is_delete' => 0])->find();
        if (empty($receivables)) $this->error('数据信息不存在');
        $this->assign('receivables',$receivables);
        $ids = $receivables['delivery_ids'];
        $db = db('delivery_order do');
        //$db->where(['do.is_invoice' => 0]);
        $result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
        ->join('__ORDER__ o','o.id=do.order_id')
        ->field('do.*,o.total_money,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
        ->where(['do.cus_id' => $receivables['cus_id'],'do.id' => ['in',$ids]])->order('do.create_time desc')->select();
        foreach ($result as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
            ->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $result[$key]['category_name'] = $category_name;
        }
        $this->assign('page','');
        $this->assign('list',$result);
        $this->assign('title','应收账款详情');
        return $this->fetch();
    }
    
    public function edit(){
        $id = $this->request->param('id',0,'intval');
        if (empty($id)) $this->error('参数错误');
        $receivables = db('receivables')->where(['id' => $id,'is_delete' => 0])->find();
        if (empty($receivables)) $this->error('数据信息不存在');
        if ($this->request->isAjax()){
            $invoice_sn = $this->request->post('invoice_sn');
            $invoice_date = $this->request->post('invoice_date');
            $id = $this->request->post('id');
            if (empty($invoice_sn)) $this->error('发票号码不能为空');
            if (empty($invoice_date)) $this->error('开票日期不能为空');
            $data = [
                'id' => intval($id),
                'invoice_sn' => $invoice_sn,
                'invoice_date' => $invoice_date,
                'update_time' => time()
            ];
            if (db('receivables')->where(['id' => ['neq',$data['id']],'invoice_sn' => $invoice_sn])->find()){
                $this->error('发票号码已存在');
            }
            if (db('receivables')->update($data)){
                $this->success('保存成功',url('index'));
            }
            $this->error('保存失败');
            return;
        }
        $this->assign('receivables',$receivables);
        $ids = $receivables['delivery_ids'];
        $db = db('delivery_order do');
        //$db->where(['do.is_invoice' => 0]);
        $result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
        ->join('__ORDER__ o','o.id=do.order_id')
        ->field('do.*,o.total_money,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
        ->where(['do.cus_id' => $receivables['cus_id'],'do.id' => ['in',$ids]])->select();
        foreach ($result as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
            ->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $result[$key]['category_name'] = $category_name;
        }
        $this->assign('page','');
        $this->assign('list',$result);
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
    	->order('do.create_time desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
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
    
    public function setsupplier(){
        if ($this->request->isAjax()){
            $data = $this->request->param();
            if (empty($data)) {
                cookie('setsupplier',null);
                $this->success('ok');
                return;
            }
            if (count(array_unique($data)) >= 2){
                $this->error('供应商不相同的不能创建对账单');
            }
            if (count(array_unique($data)) == 1){
                cookie('setsupplier',$data);
                $this->success('ok');
            }
        }
    }
    
    public function create(){
    	$checked = cookie('soset');
    	if (empty($checked) || empty($checked['checked'])) $this->error('请选择销售单');
    	/**
    	 * 1086_1_10
    	 * 1086_2_12
    	 */
    	$cus_ids = [];
    	$delivery_ids = [];
    	$order_ids = [];
    	foreach ($checked['checked'] as $value){
    		$arr = explode('_', $value);
    		$cus_ids[] = isset($arr[0]) ? $arr[0] : 0;
    		$delivery_ids[] = isset($arr[1]) ? $arr[1] : 0;
    		$order_ids[] = isset($arr[2]) ? $arr[2] : 0;
    	}
    	if (count(array_unique($cus_ids)) > 2){
    		$this->error('客户名称不相同的不能创建对账单');
    	}
    	$order_ids = array_unique($order_ids);
    	if (!empty($cus_ids) && !empty($order_ids)) {
    		$cus_id = $cus_ids[0];
    		$db = db('delivery_order do');
    		$db->where(['do.is_invoice' => 0]);
    		$db->where(['do.id' => ['in',$delivery_ids]]);
    		$result = $db->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
    		->join('__ORDER__ o','o.id=do.order_id')
    		->field('do.*,o.company_name,o.company_short,o.total_money,o.create_time as order_create_time,gd.goods_price,gd.goods_id,gd.unit,gd.goods_name,gd.add_number,gd.current_send_number')
    		->where(['do.cus_id' => $cus_id,'do.order_id' => ['in',$order_ids]])->order('do.create_time desc')->select();
    		foreach ($result as $key => $value){
    			$category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
    			->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
    			$result[$key]['category_name'] = $category_name;
    		}
    		if (empty($result)) $this->error('数据错误');
    		//$order = db('order')->where(['id' => ['in',$order_ids]])->field('total_money,company_name,company_short')->select();
    		$total_money = 0;
    		$company_name = '';
    		/*
    		foreach ($order as $key => $value){
    			$total_money += $value['total_money'];
    			$company_name = $value['company_name'];
    		}
    		*/
    		foreach ($result as $key => $value){
    			$total_money += $value['goods_price']*$value['current_send_number'];
    			$company_name = $value['company_name'];
    		}
    		$this->assign('total_money',_formatMoney($total_money));
    		$this->assign('company_name',$company_name);
    		if ($this->request->isAjax()){
    			$invoice_sn = $this->request->post('invoice_sn');
    			$invoice_date = $this->request->post('invoice_date');
    			//$delivery_ids = $this->request->post('delivery_ids');
    			if (empty($invoice_sn)) $this->error('发票号码不能为空');
    			if (empty($invoice_date)) $this->error('开票日期不能为空');
    			if (db('receivables')->where(['invoice_sn' => $invoice_sn])->find()){
    			    $this->error('发票号码已存在');
    			}
    			$delivery_ids = [];
    			foreach ($result as $key => $value){
    				$delivery_ids[] = $value['id'];
    			}
    			$delivery_ids = array_unique($delivery_ids);
    			$data = [
    				'admin_uid' => $this->userinfo['id'],
    				'cus_id' => $cus_id,
    				'cus_name' => $company_name,
    				'delivery_ids' => implode(',', $delivery_ids),
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
        $supplier_name = $this->request->param('supplier_name');
        $status = $this->request->param('status');
        $start_time = $this->request->param('start_time');
        $end_time = $this->request->param('end_time');
        $is_open = $this->request->param('is_open');
        $db = db('payment_order')->where(['is_delete' => 0]);
        if ($supplier_name != ''){
            $db->where('supplier_name','like',"%{$supplier_name}%");
        }
        if (strtotime($start_time) && strtotime($end_time)){
            $db->where(['invoice_date' => ['>=', $start_time]]);
            $db->where(['invoice_date' => ['<=', $end_time]]);
        }
        if ($is_open != ''){
            $db->where(['is_open' => $is_open]);
        }
        if ($status != ''){
            $db->where(['status' => $status]);
        }
        $result = $db->order('id desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
        $this->assign('page',$result->render());
        $this->assign('list',$result->all());
        $this->assign('title','应付账款');
        cookie('setsupplier',null);
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function payment_info(){
        $id = $this->request->param('id',0,'intval');
        if (!$id) $this->error('参数错误');
        $payment_order = db('payment_order')->where(['id' => $id])->find();
        if (empty($payment_order)) $this->error('应付账款信息不存在');
        $list = db('payment_goods pg')->where(['pg.payment_order_id' => $id])
        ->join('__GOODS__ g','pg.goods_id=g.goods_id')
        ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
        ->field('pg.*,gc.category_name')->select();
        $this->assign('total_money',$payment_order['total_money']);
        $this->assign('page','');
        $this->assign('info',$payment_order);
        $this->assign('list',$list);
        $this->assign('title','应付账款');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function payment_edit(){
        $id = $this->request->param('id',0,'intval');
        if (!$id) $this->error('参数错误');
        $payment_order = db('payment_order')->where(['id' => $id])->find();
        if (empty($payment_order)) $this->error('应付账款信息不存在');
        if ($this->request->isAjax()){
            $invoice_sn = $this->request->post('invoice_sn');
            $invoice_date = $this->request->post('invoice_date');
            $last_date = $this->request->post('last_date');
            if (empty($invoice_sn)) $this->error('发票号码不能为空');
            if (empty($invoice_date)) $this->error('开票日期不能为空');
            if (empty($last_date)) $this->error('到期日期不能为空');
            $id = $this->request->post('id');
            $data = [
                'id' => intval($id),
                'invoice_sn' => $invoice_sn,
                'invoice_date' => $invoice_date,
                'last_date' => $last_date,
                'update_time' => time()
            ];
            if (db('payment_order')->where(['id' => ['neq',$data['id']],'invoice_sn' => $invoice_sn])->find()){
                $this->error('发票号码已存在');
            }
            if (db('payment_order')->update($data)){
                $this->success('保存成功',url('payment'));
            }
            $this->error('保存失败');
            return;
        }
        $list = db('payment_goods pg')->where(['pg.payment_order_id' => $id])
        ->join('__GOODS__ g','pg.goods_id=g.goods_id')
        ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
        ->field('pg.*,gc.category_name')->select();
        $this->assign('total_money',$payment_order['total_money']);
        $this->assign('page','');
        $this->assign('info',$payment_order);
        $this->assign('list',$list);
        $this->assign('title','应付账款');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function wait(){
        $supplier_name = $this->request->param('supplier_name');
        $order_dn = $this->request->param('order_dn');
        $po_sn = $this->request->param('po_sn');
        $start_time = $this->request->param('start_time');
        $end_time = $this->request->param('end_time');
        $db = db('delivery_order do');
        $db->where(['do.is_payment' => 0]);
        if ($supplier_name != '') {
            $db->where(['s.supplier_name|s.supplier_short','like',"%{$supplier_name}%"]);
        }
        if (strtotime($start_time) && strtotime($end_time)){
            $db->where(['do.delivery_date' => ['>=', $start_time]]);
            $db->where(['do.delivery_date' => ['<=', $end_time]]);
        }
        if ($po_sn != ''){
            $db->where(['p.po_sn' => $po_sn]);
        }
        if ($order_dn != ''){
            $db->where(['do.order_dn' => $order_dn]);
        }
        $result = $db->join('__PURCHASE__ p','do.purchase_id=p.id')
        ->join('__SUPPLIER__ s','p.supplier_id=s.id')
        ->field(['do.order_dn,do.id,do.delivery_date,p.supplier_id,p.po_sn,s.supplier_name,s.supplier_short'])
        ->order('do.create_time desc')->paginate(config('page_size'),false,['query' => $this->request->param()]);
        $this->assign('page',$result->render());
        $this->assign('list',$result->all());
        $this->assign('title','采购发票待处理');
        $this->assign('sub_class','viewFramework-product-col-1');
        //cookie('setsupplier',null);
        $this->assign('soset',cookie('setsupplier'));
        return $this->fetch();
    }
    
    public function view(){
        $id = $this->request->param('id',0,'intval');
        if (!$id) $this->error('参数错误');
        $delivery_order = db('delivery_order')->where(['id' => $id])->find();
        if (empty($delivery_order)) $this->error('送货单不存在');
        $data = db('delivery_goods gd')->join('__GOODS__ g','g.goods_id=gd.goods_id')
        ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
        ->where(['gd.delivery_id' => $id])->field('gd.*,gc.category_name')->select();
        $this->assign('data',$data);
        $this->assign('page','');
        return $this->fetch();
    }
    
    public function create_payment(){
        $checked = cookie('setsupplier');
        if (empty($checked) || empty($checked['checked'])) $this->error('请选择供应商');
        $supplier_ids = [];
        $delivery_id = [];
        foreach ($checked['checked'] as $key => $value){
        	$tempArr = explode('_', $value);
        	if (isset($tempArr[0])) {
        		$supplier_ids[] = $tempArr[0];
        	}
        	if (isset($tempArr[1])) {
        		$delivery_id[] = $tempArr[1];
        	}
        }
        if (count(array_unique($supplier_ids)) > 2){
        	$this->error('不相同的供应商不能创建对账单');
        }
        $supplier_id = $supplier_ids[0]?:0;
        $supplier = db('supplier')->where(['id' => $supplier_id])->find();
        if (empty($supplier)) $this->error('供应商不存在');
        $this->assign('supplier',$supplier);
        $result = db('delivery_order do')->join('__DELIVERY_GOODS__ gd','gd.delivery_id=do.id')
        ->join('__GOODS__ g','gd.goods_id=g.goods_id')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')
        ->where(['do.id' => ['in',array_unique($delivery_id)]])->field('do.*,gd.goods_id,gd.goods_name,gd.goods_price,gd.unit,gd.current_send_number,gd.add_number,gc.category_name')
        ->order('do.create_time desc')->select();
        $totalMoney = 0;
        foreach ($result as $key => $value){
            $result[$key]['count_money'] = _formatMoney($value['goods_price']*($value['current_send_number']+$value['add_number']));   
            $totalMoney += $result[$key]['count_money'];
        }
        
        if ($this->request->isAjax()){
            $invoice_sn = $this->request->post('invoice_sn');
            $invoice_date = $this->request->post('invoice_date');
            $last_date = $this->request->post('last_date');
            if (empty($invoice_sn)) $this->error('发票号码不能为空');
            if (empty($invoice_date)) $this->error('开票日期不能为空');
            if (empty($last_date)) $this->error('到期日期不能为空');
            if (db('payment_order')->where(['invoice_sn' => $invoice_sn])->find()){
                $this->error('发票号码已存在');
            }
            $delivery_ids = [];
            foreach ($result as $key => $value){
                $delivery_ids[] = $value['id'];
            }
            $delivery_ids = array_unique($delivery_ids);
            $data = [
                'admin_uid' => $this->userinfo['id'],
                'supplier_id' => $supplier_id,
                'supplier_name' => $supplier['supplier_name'],
                'delivery_ids' => implode(',', $delivery_ids),
                'invoice_sn' => $invoice_sn,
                'invoice_date' => $invoice_date,
                'total_money' => _formatMoney($totalMoney),
                'pay_money' => _formatMoney($totalMoney),'diff_money' => 0,
                'is_open' => 0,'status' => 1,
                'payment_date' => $supplier['supplier_payment'],
                'last_date' => $last_date,
                'update_time' => time(),'create_time' => time()
            ];
            if (db('payment_order')->insert($data)){
                $payment_order_id = db('payment_order')->getLastInsID();
                db('delivery_order')->where(['id' => ['in',$delivery_ids]])->setField('is_payment',1);
                foreach ($result as $key => $value){
                    db('payment_goods')->insert([
                        'payment_order_id' => $payment_order_id,
                        'order_id' => $value['order_id'],
                        'order_sn' => $value['order_sn'],
                        'purchase_id' => $value['purchase_id'],
                        'po_sn' => $value['po_sn'],
                        'delivery_date' => $value['delivery_date'],
                        'delivery_dn' => $value['order_dn'], //送货单号
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'unit' => $value['unit'],
                        'goods_price' => $value['goods_price'],
                        'rec_number' => $value['current_send_number']+$value['add_number'], //收货数量
                        'open_number' => $value['current_send_number']+$value['add_number'], //开票数量
                        'count_money' => _formatMoney(($value['current_send_number']+$value['add_number'])*$value['goods_price'])
                    ]);
                }
                cookie('setsupplier',null);
                $this->success('保存成功',url('payment'));
            }else{
                $this->error('保存失败请重试');
            }
            return;
        }
        
        $this->assign('total_money',_formatMoney($totalMoney));
        $this->assign('page','');
        $this->assign('list',$result);
        $this->assign('title','应付账款');
        $this->assign('sub_class','viewFramework-product-col-1');
        return $this->fetch();
    }
    
    public function payment_open(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('payment_order')->where(['id' => $id])->setField('is_open',1)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function payment_status(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('payment_order')->where(['id' => $id])->setField('status',2)){
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
    public function payment_delete(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('payment_order')->where(['id' => $id])->setField('is_delete',1)){
                db('payment_goods')->where(['payment_order_id' => $id])->setField('is_delete',1);
                $delivery_ids = db('payment_order')->where(['id' => $id])->value('delivery_ids');
                db('delivery_order')->where(['id' => ['in',$delivery_ids]])->setField('is_invoice',0);
                $this->success('操作成功');
            }
            $this->error('操作失败');
        }
    }
    
}