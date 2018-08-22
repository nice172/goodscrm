<?php
namespace app\admin\controller;
use think\Validate;

class Delivery extends Base {
    
    protected $rule = [
        'order_id' => 'require',
        'order_dn' => 'require',
        'delivery_date' => 'require',
        'po_sn' => 'require',
        'purchase_date' => 'require',
        'purchase_money' => 'require',
        'order_sn' => 'require',
        'cus_name' => 'require',
        'contacts' => 'require',
        'contacts_tel' => 'require',
        'delivery_address' => 'require',
        'delivery_sn' => 'require',
        'delivery_way' => 'require',
        'delivery_driver' => 'require',
        'driver_tel' => 'require',
    ];
    protected $message = [
        'order_id.require' => '订单ID不能为空',
        'order_dn.require' => '送货单号不能为空',
        'delivery_date.require' => '送货日期不能为空',
        'po_sn.require' => '采购单不能为空',
        'purchase_date.require' => '采购日期不能为空',
        'purchase_money.require' => '采购金额不能为空',
        'order_sn.require' => '关联订单不能为空',
        'cus_name.require' => '客户名称不能为空',
        'contacts.require' => '联系人不能为空',
        'contacts_tel.require' => '电话号码不能为空',
        'delivery_address.require' => '送货地址不能为空',
        'delivery_sn.require' => '送货单号不能为空',
        'delivery_way.require' => '交货方式不能为空',
        'delivery_driver.require' => '司机不能为空',
        'driver_tel.require' => '司机电话不能为空',
    ];
    
    public function index(){
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','送货单');
        return $this->fetch();
    }
    
    public function add(){
        if ($this->request->isAjax()){
            $data = $this->request->param();
            $validate = new Validate($this->rule,$this->message);
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }
            $goods_info = $this->request->param('goods_info/a');
            if (empty($goods_info)) $this->error('商品信息不能为空');
            unset($data['goods_info'],$data['type'],$data['current_send_number'],$data['remark'],$data['add_number']);
            $data['admin_uid'] = $this->userinfo['id'];
            $data['create_time'] = time();
            $data['update_time'] = time();
            $delivery_id = db('delivery_order')->insertGetId($data);
            if ($delivery_id){
                foreach ($goods_info as $key => $value){
                    db('delivery_goods')->insert([
                        'delivery_id' => $delivery_id,
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'unit' => $value['unit'],
                        'current_send_number' => $value['current_send_number'],
                        'add_number' => $value['add_number'],
                        'remark' => $value['remark']
                    ]);
                }
                $this->success('保存成功');
            }
            $this->error('保存失败');
            return;
        }
        $this->assign('title','送货单');
        return $this->fetch();
    }
    
    public function search_purchase(){
        $supplier_name = $this->request->param('supplier_name');
        $start_time = $this->request->param('start_date');
        $end_time = $this->request->param('end_date');
        $db = db('purchase p');
        $db->field('p.*,p.id as purchase_id,og.send_num,s.supplier_name,pg.unit,pg.goods_price,pg.goods_id,pg.goods_number,pg.goods_name,o.order_sn,o.require_time');
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
        $db->join('__PURCHASE_GOODS__ pg','p.id=pg.purchase_id');
        $db->join('__ORDER_GOODS__ og','pg.goods_id=og.goods_id AND og.order_id=p.order_id');
        $db->where("og.order_id=p.order_id and (pg.goods_number-og.send_num) > 0");
        $db->join('__SUPPLIER__ s','p.supplier_id=s.id');
        $db->join('__ORDER__ o','o.id=p.order_id');
        $result = $db->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
        $data = $result->all();
        foreach ($data as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $data[$key]['category_name'] = $category_name;
            $data[$key]['require_time'] = date('Y-m-d',$value['require_time']);
            $data[$key]['purchase_date'] = date('Y-m-d',$value['create_time']);
        }
        $this->assign('page',$result->render());
        $this->assign('data',$data);
        $this->assign('pojson',json_encode($data));
        return $this->fetch();
    }
    
    public function relation_order(){
        $supplier_name = $this->request->param('supplier_name');
        $start_time = $this->request->param('start_date');
        $end_time = $this->request->param('end_date');
        $db = db('order o');
        $db->field('o.*,o.id as orderid,og.*');
        $where = ['o.status' => ['neq','-1']];
        if ($supplier_name != ''){
            $db->where('o.company_short|s.compnay_name','like',"%{$supplier_name}%");
        }
        $db->where($where);
        if ($start_time != '' && $end_time != ''){
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time.' 23:59:59');
            if ($start_time && $end_time){
                $db->where("o.require_time",'>=',$start_time);
                $db->where("o.require_time",'<=',$end_time);
            }
        }
        
        $db->join('__ORDER_GOODS__ og','o.id=og.order_id');
        $db->where("(og.goods_number-og.send_num) > 0");
        $result = $db->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
        $data = $result->all();
        foreach ($data as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $data[$key]['category_name'] = $category_name;
            $data[$key]['require_time'] = date('Y-m-d',$value['require_time']);
            $data[$key]['purchase_date'] = date('Y-m-d',$value['create_time']);
        }
        $this->assign('page',$result->render());
        $this->assign('data',$data);
        $this->assign('pojson',json_encode($data));
        return $this->fetch();
    }
    
    public function rel_order(){
        if ($this->request->isAjax()){
            $order_id = $this->request->param('order_id',0,'intval');
            $order = db('order')->where(['id' => $order_id])->find();
            if (empty($order)) $this->error('订单不存在');
            $db = db('order_goods og');
            $db->where(['og.order_id' => $order_id]);
            $db->join('__GOODS__ g','og.goods_id=g.goods_id');
            $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
            $goodslist = $db->field('og.*,g.store_number,gc.category_name')->select();
            
            $totalMoney = 0;
            foreach ($goodslist as $key => $value){
                $goodslist[$key]['diff_number'] = $value['goods_number'] - $value['send_num']; //未交数量
                $goodslist[$key]['current_send_number'] = 0; //本次送货数量
                $goodslist[$key]['add_number'] = 0; //入库数量
                $totalMoney += $value['goods_number']*$value['goods_price'];
            }
            
            $data['total_money'] = _formatMoney($totalMoney);
            
            $cus = db('customers')->where(['cus_id' => $order['cus_id']])->find();
            $data['delivery_address'] = $cus['cus_prov'].$cus['cus_city'].$cus['cus_dist'].$cus['cus_street'];
            $data['cus_phome'] = $cus['cus_phome'];
            $data['contacts'] = $order['contacts'];
            $data['order_sn'] = $order['order_sn'];
            
            $data['goodslist'] = $goodslist;
            $data['cus_name'] = $order['company_name'];
            $data['cus_id'] = $order['cus_id'];
            
            $this->success('','',$data);
        }
    }
    
    public function order(){
        if ($this->request->isAjax()){
            $purchase_id = $this->request->param('purchase_id',0,'intval');
            $purchase = db('purchase')->where(['id' => $purchase_id,'is_cancel' => 0])->find();
            if (empty($purchase)) $this->error('采购单已取消关联订单');
            $purchase_goods = db('purchase_goods pg')->join('__GOODS__ g','g.goods_id=pg.goods_id')
            ->join('__ORDER_GOODS__ og','og.goods_id=pg.goods_id')->field('pg.*,g.store_number,og.send_num,gc.category_name,og.remark')
            ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
            ->where(['pg.purchase_id' => $purchase_id,'og.order_id' => $purchase['order_id']])->select();
            
            foreach ($purchase_goods as $key => $value){
                $purchase_goods[$key]['diff_number'] = $value['goods_number'] - $value['send_num']; //未交数量
                $purchase_goods[$key]['current_send_number'] = 0; //本次送货数量
                $purchase_goods[$key]['add_number'] = 0; //入库数量
            }
            
            $data['goodslist'] = $purchase_goods;
            $data['cus_name'] = db('customers')->where(['cus_id' => $purchase['cus_id']])->value('cus_name');
            $data['cus_id'] = $purchase['cus_id'];
            
            $this->success('','',$data);
        }
    }
    
}