<?php
namespace app\admin\controller;
class Delivery extends Base {
    
    public function index(){
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','送货单');
        return $this->fetch();
    }
    
    public function add(){
        $this->assign('page','');
        $this->assign('list',[]);
        $this->assign('title','送货单');
        return $this->fetch();
    }
    
    public function search_purchase(){
        $supplier_name = $this->request->param('supplier_name');
        $start_time = $this->request->param('start_date');
        $end_time = $this->request->param('end_date');
        $db = db('purchase p');
        $db->field('p.*,og.send_num,s.supplier_name,pg.unit,pg.goods_price,pg.goods_id,pg.goods_number,pg.goods_name,o.order_sn,o.require_time');
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
        $db->where("og.order_id=p.order_id");
        $db->join('__SUPPLIER__ s','p.supplier_id=s.id');
        $db->join('__ORDER__ o','o.id=p.order_id');
        $result = $db->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
        $data = $result->all();
        foreach ($data as $key => $value){
            $category_name = db('goods g')->join('__GOODS_CATEGORY__ gc','gc.category_id=g.category_id')->where(['g.goods_id' => $value['goods_id']])->value('gc.category_name');
            $data[$key]['category_name'] = $category_name;
            $data[$key]['require_time'] = date('Y-m-d',$value['require_time']);
        }
        $this->assign('page',$result->render());
        $this->assign('data',$data);
        return $this->fetch();
    }
    
}