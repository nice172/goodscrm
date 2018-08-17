<?php
namespace app\admin\controller;

use think\Request;
use think\Validate;
use app\admin\model\Customers;

class Order extends Base {
    
    protected $rules = [
        'company_name' => 'require',
        'company_short' => 'require',
        'contacts' => 'require',
        'email' => 'require|email',
        'require_time' => 'require'
    ];
    protected $message = [
        'company_name.require' => '公司名称不能为空',
        'company_short.require' => '简称不能为空',
        'contacts.require' => '联系人不能为空',
        'email.require' => 'E-Mail不是能为空',
        'email.email' => 'E-Mail格式不正确',
        'require_time.require' => '交货日期不能为空'
    ];
    
    public function index(){
        $company_short = $this->request->param('company_short');
        $start_time = $this->request->param('start_time');
        $end_time = $this->request->param('end_time');
        $status = $this->request->param('status');
        $categroy_id = $this->request->param('categroy_id');
        $db = db('order o');
        $db->field('o.*,g.*,o.id as oid,g.id as gid');
        if (empty($status)){
            $where = ['o.status' => ['neq','-1']];
        }else{
            $where = ['o.status' => intval($status)];
        }
        
        if ($company_short != ''){
            $where['o.company_short'] = ['like',"%{$company_short}%"];
            $where['o.company_name'] = ['like',"%{$company_short}%"];
        }
        $db->where($where);
        if ($start_time != '' && $end_time != ''){
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time.' 23:59:59');
            if ($start_time && $end_time){
                $db->where("o.create_time",'>=',$start_time);
                $db->where("o.create_time",'<=',$end_time);
            }
        }
        $db->join('__ORDER_GOODS__ g','o.id=g.order_id');
        
        if (!empty($categroy_id)){
            $db->join('__GOODS__ gd','gd.goods_id=g.goods_id');
            $db->where(['gd.category_id' => $categroy_id]);
        }
        $data = $db->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
        // 获取分页显示
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('list',$data);
        $this->assign('title','订单列表');
        $category = db('goods_category')->where(array('status' => 1))->select();
        $this->assign('category',$category);
        return $this->fetch();
    }
    
    public function nodeliery(){
        $company_short = $this->request->param('company_short');
        $start_time = $this->request->param('start_time');
        $end_time = $this->request->param('end_time');
        $status = $this->request->param('status');
        $categroy_id = $this->request->param('categroy_id');
        $db = db('order o');
        $db->field('o.*,g.*,o.id as oid,g.id as gid');
        if (empty($status)){
            //$where = ['o.status' => ['neq','-1']];
        }else{
            //$where = ['o.status' => intval($status)];
        }
        $where = ['o.status' => ['in',[1,5]]];
        if ($company_short != ''){
            $where['o.company_short'] = ['like',"%{$company_short}%"];
            $where['o.company_name'] = ['like',"%{$company_short}%"];
        }
        $db->where($where);
        if ($start_time != '' && $end_time != ''){
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time.' 23:59:59');
            if ($start_time && $end_time){
                $db->where("o.create_time",'>=',$start_time);
                $db->where("o.create_time",'<=',$end_time);
            }
        }
        $db->join('__ORDER_GOODS__ g','o.id=g.order_id');
        
        if (!empty($categroy_id)){
            $db->join('__GOODS__ gd','gd.goods_id=g.goods_id');
            $db->where(['gd.category_id' => $categroy_id]);
        }
        $category = db('goods_category')->where(array('status' => 1))->select();
        $result = $db->paginate(config('PAGE_SIZE'), false, ['query' => $this->request->param() ]);
        $data = $result->all();
        foreach ($data as $key => $value){
            $category_id = db('goods')->where(['goods_id' => $value['goods_id']])->value('category_id');
            foreach ($category as $val){
                if ($val['category_id'] == $category_id){
                    $data[$key]['category_name'] = $val['category_name'];
                    break;
                }
            }
        }
        $page = $result->render();
        $this->assign('page',$page);
        $this->assign('list',$data);
        $this->assign('title','订单列表');
//      $this->assign('category',$category);
        return $this->fetch();
    }
    
    public function cancel(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('order')->where(['id' => $id])->setField('status',4)){
                $this->success('取消成功');   
            }
            $this->error('取消失败');
        }
    }
    
    public function info(){
        $id = $this->request->param('id',0,'intval');
        if ($id <= 0) $this->error('参数错误');
        $order = db('order')->where(['id' => $id,'status' => ['neq','-1']])->find();
        if (empty($order)) $this->error('订单不存在');
        $goodsInfo = db('order_goods')->where(['order_id' => $order['id']])->order('goods_id asc')->select();
        $cus = db('customers')->where(['cus_id' => $order['cus_id']])->find();
        $this->assign('client',$cus);
        $this->assign('data',$order);
        $this->assign('goodsList',$goodsInfo);
        $this->assign('page_l','');
        $this->assign('list',[]);
        $this->assign('title','订单详情');
        return $this->fetch();
    }
    
    public function add(){
        if ($this->request->isAjax()){
            $type = $this->request->param('type');
            $data = [
                'create_uid' => $this->userinfo['id'],
                'cus_id' => $this->request->post('cus_id'),
                'order_sn' => $this->request->post('order_sn'),
                'company_name' => $this->request->post('company_name'),
                'company_short' => $this->request->post('company_short'),
                'fax' => $this->request->post('fax'),
                'email' => $this->request->post('email'),
                'contacts' => $this->request->post('contacts'),
                'order_remark' => $this->request->post('remark'),
                'require_time' => strtotime($this->request->post('require_time')),
                'status' => $type == 'confirm' ? 1 : 0,
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
            
            foreach ($goodsInfo as $val){
                if ($val['goods_number'] <= 0){
                    $this->error('下单数量不能小于1');
                }
                if ($val['send_num'] < 0){
                    $this->error('已送数量不能小于0');
                }
            }
            $order_id = db('order')->insertGetId($data);
            if ($order_id){
                foreach ($goodsInfo as $val){
                    
                    $goods_attr = db('goods_attr_val')->where(['goods_id' => $val['goods_id']])
                    ->field(['goods_attr_id','attr_name','attr_value'])->select();
                    
                    db('order_goods')->insert([
                        'order_id' => $order_id,
                        'goods_id' => $val['goods_id'],
                        'goods_name' => $val['goods_name'],
                        'unit' => $val['unit'],
                        'goods_price' => $val['shop_price'],
                        'market_price' => $val['market_price'],
                        'goods_number' => $val['goods_number'],
                        'send_num' => $val['send_num'],
                        'goods_attr' => json_encode($goods_attr),
                        'remark' => $val['remark'],
                        'create_time' => time()
                    ]);
                }
                $this->success('新增成功',url('index'));
            }else{
                $this->error('新增失败请重试');
            }
            return;
        }
        $assign = [
            'title' => '订单列表',
            'list'  => [],
            'page'  => '',
        ];
        $this->assign($assign);
        return $this->fetch();
        
    }
    
    
    public function edit(){
        if ($this->request->isAjax()){
            $type = $this->request->param('type');
            $data = [
                'id' => $this->request->post('id'),
                'cus_id' => $this->request->post('cus_id'),
                'order_sn' => $this->request->post('order_sn'),
                'company_name' => $this->request->post('company_name'),
                'company_short' => $this->request->post('company_short'),
                'fax' => $this->request->post('fax'),
                'email' => $this->request->post('email'),
                'contacts' => $this->request->post('contacts'),
                'order_remark' => $this->request->post('remark'),
                'require_time' => strtotime($this->request->post('require_time')),
                'status' => $type == 'confirm' ? 1 : 0,
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
            foreach ($goodsInfo as $val){
                if ($val['goods_number'] <= 0){
                    $this->error('下单数量不能小于1');
                }
                if ($val['send_num'] < 0){
                    $this->error('已送数量不能小于0');
                }
            }
            $in = db('order_goods')->where(['order_id' => $data['id']])->field('id')->select();
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
            $affected = db('order')->update($data);
            if ($affected){
                $tempArr = array_count_values(array_merge($ids,$postIds));
                foreach ($tempArr as $key => $count){
                    if ($count == 1){
                        db('order_goods')->where(['id' => $key,'order_id' => $data['id']])->delete();
                    }
                }
                foreach ($goodsInfo as $val){
                    $goods_attr = db('goods_attr_val')->where(['goods_id' => $val['goods_id']])
                    ->field(['goods_attr_id','attr_name','attr_value'])->select();
                    
                    if (!isset($value['id']) || intval($val['id']) <= 0){
                        db('order_goods')->insert([
                            'order_id' => $data['id'],
                            'goods_id' => $val['goods_id'],
                            'goods_name' => $val['goods_name'],
                            'unit' => $val['unit'],
                            'goods_price' => $val['shop_price'],
                            'market_price' => $val['market_price'],
                            'goods_number' => $val['goods_number'],
                            'send_num' => $val['send_num'],
                            'goods_attr' => json_encode($goods_attr),
                            'remark' => $val['remark'],
                            'create_time' => time()
                        ]);
                    }else{
                        db('order_goods')->where(['order_id' => $data['id'],'id' => intval($val['id'])])->update(
                            [
                                'goods_id' => $val['goods_id'],
                                'goods_name' => $val['goods_name'],
                                'unit' => $val['unit'],
                                'goods_price' => $val['shop_price'],
                                'market_price' => $val['market_price'],
                                'goods_number' => $val['goods_number'],
                                'send_num' => $val['send_num'],
                                'goods_attr' => json_encode($goods_attr),
                                'remark' => $val['remark'],
                        ]);
                    }
                }
                
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('编辑失败请重试');
            }
            return;
        }
        $id = $this->request->param('id',0,'intval');
        if ($id <= 0) $this->error('参数错误');
        $order = db('order')->where(['id' => $id,'status' => ['neq','-1']])->find();
        if (empty($order)) $this->error('订单不存在');
        $goodsInfo = db('order_goods')->where(['order_id' => $order['id']])->select();
        if (!empty($goodsInfo)){
            foreach ($goodsInfo as $key => $value){
                $value['shop_price'] = $value['goods_price']; //实际价格
                $goodsInfo[$key] = json_encode($value);
            }
        }
        $order['goodsInfo'] = $goodsInfo;
        $this->assign('data',$order);
        $this->assign('title','编辑订单');
        return $this->fetch();
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
    
    
}