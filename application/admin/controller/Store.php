<?php
namespace app\admin\controller;
class Store extends Base {
 
    public function index(){
        $cate_lists = db('goods_category')->select();
        $this->assign('lists',$cate_lists);
        $supplier_name = $this->request->param('supplier_name');
        $category_id = $this->request->param('category_id',0,'intval');
        $goods_name = $this->request->param('goods_name');
        $db = db('purchase p');
        $where = ['g.status' => ['neq','-1']];
        if ($supplier_name != ''){
            $db->where('s.supplier_name|s.supplier_short','like',"%{$supplier_name}%");
        }
        if ($goods_name != ''){
            $db->where('g.goods_name','like',"%{$goods_name}%");
        }
        if ($category_id > 0){
            $where['g.category_id'] = $category_id;
        }
        
        $db->where($where);
        $db->field('g.goods_id,g.goods_name,g.unit,g.store_number,gc.category_name,s.supplier_name');
        $db->join('__PURCHASE_GOODS__ pg','p.id=pg.purchase_id');
        $db->join('__GOODS__ g ','pg.goods_id=g.goods_id');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $db->join('__SUPPLIER__ s','s.id=g.supplier_id');
        
        //$db->join('__DELIVERY_ORDER__ do','p.order_id=do.order_id');
        //$db->where(['do.is_confirm' => 1]);
        
        $result = $db->group('g.goods_id')->paginate(config('PAGE_SIZE'),false, ['query' => $this->request->param()]);
        
        $this->assign('page',$result->render());
        $this->assign('list',$result);
        $this->assign('title','库存盘点');
        return $this->fetch();
    }
    
    public function log(){
        //1入库，2出库，3报溢，4报损
        $goods_id = $this->request->param('goods_id',0,'intval');
        $order_id = $this->request->param('order_id',0,'intval');
        $delivery_order = db('delivery_order')->where(['order_id' => $order_id])->find();
        $result = db('store_log l')->where(['l.order_id' => $order_id,'l.goods_id' => $goods_id])
        ->join('__GOODS__ g','l.goods_id=g.goods_id')
        ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
        ->field('l.*,gc.category_name')->order('l.create_time desc')->paginate(config('page_size'));
        $this->assign('page',$result->render());
        $this->assign('data',$result->all());
        return $this->fetch();
    }
    
    public function relation(){
        $cate_lists = db('goods_category')->select();
        $this->assign('lists',$cate_lists);
        $supplier_name = $this->request->param('supplier_name');
        $category_id = $this->request->param('category_id',0,'intval');
        $goods_name = $this->request->param('goods_name');
        
        $db = db('purchase p');
        $where = ['p.status' => ['neq','-1']];
        if ($supplier_name != ''){
            $db->where('s.supplier_name|s.supplier_short','like',"%{$supplier_name}%");
        }
        if ($goods_name != ''){
            $db->where('g.goods_name|pg.goods_name','like',"%{$goods_name}%");
        }
        if ($category_id > 0){
            $where['gc.category_id'] = $category_id;
        }
        
        $db->where($where);
        $db->field('p.*,p.id as purchase_id,g.store_number,pg.goods_id,pg.goods_name,pg.unit,pg.goods_number,pg.goods_price,gc.category_name,s.supplier_name');
        $db->join('__PURCHASE_GOODS__ pg','p.id=pg.purchase_id');
        $db->join('__GOODS__ g ','pg.goods_id=g.goods_id');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $db->join('__SUPPLIER__ s','s.id=p.supplier_id');
        
        //$db->join('__DELIVERY_ORDER__ do','p.order_id=do.order_id');
        //$db->where(['do.is_confirm' => 1]);
        
        $result = $db->order('p.create_time desc')->paginate(config('PAGE_SIZE'),false, ['query' => $this->request->param()]);
        $list = $result->all();
        foreach ($list as $key => $value){
        	if ($value['create_type'] == 1){
        		$list[$key]['order_id'] = db('delivery_order')->where(['purchase_id' => $value['id']])->value('order_id');
        	}
        }
        $this->assign('page',$result->render());
        $this->assign('list',$list);
        $this->assign('title','关联库存');
        return $this->fetch();
    }
    
    public function cancel(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('purchase')->where(['id' => $id])->setField('is_cancel',1)){
            	$info = db('purchase')->where(['id' => $id])->find();
            	if ($info['order_id']){
            		db('order')->where(['id' => $info['order_id']])->setField('is_create',0);
            	}
                $this->success('取消成功');
            }
            $this->error('取消失败');
        }
    }
    
    public function update_store(){
        if ($this->request->isAjax()){
            $goods_id = $this->request->param('goods_id',0,'intval');
            $store_number = $this->request->param('store_number',0,'intval');
            $goods = db('goods')->where(['goods_id' => $goods_id])->find();
            if ($goods['store_number'] == $store_number){
            	$this->success('更新成功');
            }
            if (db('goods')->where(['goods_id' => $goods_id])->update(['store_number' => $store_number,'update_time' => time()])){
                //1入库，2出库，3报溢，4报损
                $type = 0;
                if ($goods['store_number'] > $store_number){
                    $diff_number = $goods['store_number'] - $store_number;
                    $type = 4;
                }
                if ($goods['store_number'] < $store_number){
                    $diff_number = $store_number - $goods['store_number'];
                    $type = 3;
                }
                db('store_log')->insert([
                    'goods_id' => $goods['goods_id'],
                    'goods_name' => $goods['goods_name'],
                    'type' => $type,
                    'number' => $diff_number,
                    'create_time' => time()
                ]);
                $this->success('更新成功');
            }
            $this->error('更新失败');
        }
    }
    
}