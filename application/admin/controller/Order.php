<?php
namespace app\admin\controller;

use think\Request;
use app\admin\model\Customers;

class Order extends Base {
    
    public function index(){
        $assign = [
            'title' => '订单列表',
            'list'  => [],
            'page'  => '',
        ];
        $this->assign($assign);
        return $this->fetch();
    }
    
    public function add(){
        
        $assign = [
            'title' => '订单列表',
            'list'  => [],
            'page'  => '',
        ];
        $this->assign($assign);
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