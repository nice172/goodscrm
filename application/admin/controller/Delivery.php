<?php
namespace app\admin\controller;
use think\Validate;
use mpdf\mPDF;

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
    
    protected $scene = [
        'add' => [],
        'edit' => ['delivery_date','purchase_money',
            'cus_name','contacts','contacts_tel',
            'delivery_address','delivery_sn','delivery_way',
            'delivery_driver','driver_tel']
    ];
    
    public function index(){
        $cus_name = $this->request->param('cus_name');
        $start_time = strtotime($this->request->param('start_time'));
        $end_time = strtotime($this->request->param('end_time'));
        $db = db('delivery_order do');
        if (!empty($cus_name)) {
            $db->where(['do.cus_name' => ['like',"%{$cus_name}%"]]);
        }
        if ($start_time && $end_time){
            $end_time = strtotime($this->request->param('end_time').' 23:59:59');
            $db->where(['do.create_time' => ['>=',$start_time]]);
            $db->where(['do.create_time' => ['<=',$end_time]]);
        }
        $result = $db->join('__DELIVERY_GOODS__ dg','do.id=dg.delivery_id')
        ->field('do.*,dg.goods_name,dg.unit,dg.current_send_number,dg.add_number')
        ->paginate(config('page_size'),FALSE,['query' => $this->request->param()]);
        
        $this->assign('page',$result->render());
        $this->assign('list',$result);
        $this->assign('title','送货单');
        return $this->fetch();
    }
    
    public function info(){
        $id = $this->request->param('id',0,'intval');
        if ($id <= 0) $this->error('参数错误');
        $delivery_order = db('delivery_order')->where(['id' => $id])->find();
        if (empty($delivery_order)) $this->error('送货单不存在');
//         $goods_info = db('delivery_order d')->where(['d.delivery_id' => $id])
//         ->join('__DELIVERY_GOODS__ dg','d.id=dg.delivery_id')
//         ->join('__GOODS__ g','dg.goods_id=g.goods_id')
//         ->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id')
//         ->field($field)->paginate(config('page_size'));
        
        $goods_info = db('delivery_goods')->where(['delivery_id' => $id])->select();
        
        $db = db('order_goods og');
        $db->where(['og.order_id' => $delivery_order['order_id']]);
        $db->join('__GOODS__ g','og.goods_id=g.goods_id');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $goodslist = $db->field('og.*,g.store_number,gc.category_name')->select();
        
        $totalMoney = 0;
        foreach ($goodslist as $key => $value){
            $goodslist[$key]['diff_number'] = $value['goods_number'] - $value['send_num']; //未交数量
            foreach ($goods_info as $val){
                if ($value['goods_id'] == $val['goods_id']){
                    $goodslist[$key]['current_send_number'] = $val['current_send_number']; //本次送货数量
                    $goodslist[$key]['add_number'] = $val['add_number']; //入库数量
                }
            }
            $totalMoney += $value['goods_number']*$value['goods_price'];
        }
        $this->assign('goodslist',json_encode($goodslist));
        $this->assign('delivery',$delivery_order);
        $this->assign('title','送货单详情');
        return $this->fetch();
    }
    
    public function delete(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            if (db('delivery_order')->where(['id' => $id])->delete()){
                db('delivery_goods')->where(['delivery_id' => $id])->delete();
                $this->success('删除成功');
            }
            $this->error('删除失败');
        }
    }
    
    public function confirm(){
        if ($this->request->isAjax()){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            $delivery_order = db('delivery_order')->where(['id' => $id])->find();
            if (empty($delivery_order)) $this->error('送货单不存在');
            $order = db('order')->where(['id' => $delivery_order['order_id']])->find();
            if (db('delivery_order')->where(['id' => $id])->setField('is_confirm',1)){
                $delivery_goods = db('delivery_goods')->where(['delivery_id' => $id])->select();
                //1入库，2出库，3报溢，4报损
                foreach ($delivery_goods as $key => $value){
                    db('store_log')->insert([
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'delivery_id' => $id,
                        'type' => 2,
                        'number' => $value['current_send_number'],
                        'create_time' => time()
                    ]);
                    db('store_log')->insert([
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'delivery_id' => $id,
                        'type' => 1,
                        'number' => $value['add_number'],
                        'create_time' => time()
                    ]);
                    db('order_goods')->where(['order_id' => $delivery_order['order_id'],'goods_id' => $value['goods_id']])->setInc('send_num',$value['current_send_number']);
                }
                $order_goods = db('order_goods')->where(['order_id' => $delivery_order['order_id']])->select();
                $count = 0;
                foreach ($order_goods as $value){
                    if ($value['goods_number'] == $value['send_num']){
                        $count += 1;
                    }
                }
                if ($count == count($order_goods)){
                    db('order')->where(['id' => $delivery_order['order_id']])->setField('status',2); //已送货
                }else{
                    db('order')->where(['id' => $delivery_order['order_id']])->setField('status',6); //部分送货
                }
                if (empty($order['deliver_time'])){
                    //strtotime($delivery_order['delivery_date'])
                    db('order')->where(['id' => $delivery_order['order_id']])->setField('deliver_time',time());
                }
                $this->success('确认成功');
            }
            $this->error('确认失败');
        }
    }
    
    public function edit(){
        if ($this->request->isAjax()){
            $data = $this->request->param();
            $validate = new Validate($this->rule,$this->message);
            $validate->scene('edit',$this->scene['edit']);
            if (!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $update = [
                'id' => $data['id'],
                'delivery_date' => $data['delivery_date'],
                'purchase_money' => $data['purchase_money'],
                'cus_name' => $data['cus_name'],
                'contacts' => $data['contacts'],
                'contacts_tel' => $data['contacts_tel'],
                'delivery_address' => $data['delivery_address'],
                'delivery_sn' => $data['delivery_sn'],
                'delivery_way' => $data['delivery_way'],
                'delivery_driver' => $data['delivery_driver'],
                'driver_tel' => $data['driver_tel'],
                'update_time' => time()
            ];
            if (db('delivery_order')->where(['id' => ['neq',$data['id']],'delivery_sn' => $data['delivery_sn']])->find()){
                $this->error('送货单号已存在');
            }
            $goods_info = $this->request->param('goods_info/a');
            if (empty($goods_info)) $this->error('商品信息不能为空');
            if (db('delivery_order')->update($update)){
                $delivery_id = $data['id'];
                $in = db('delivery_goods')->where(['delivery_id' => $delivery_id])->field('id')->select();
                $ids = [];
                foreach ($in as $val){
                    $ids[] = $val['id'];
                }
                $postIds = [];
                foreach ($goods_info as $value){
                    if (isset($value['id']) && intval($value['id']) > 0){
                        $postIds[] = $value['id'];
                    }
                }
                $tempArr = array_count_values(array_merge($ids,$postIds));
                foreach ($tempArr as $key => $count){
                    if ($count == 1){
                        db('delivery_goods')->where(['id' => $key,'delivery_id' => $delivery_id])->delete();
                    }
                }
                
                foreach ($goods_info as $key => $value){
                    db('delivery_goods')->where(['id' => $value['id'],'delivery_id' => $delivery_id])->update([
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'unit' => $value['unit'],
                        'goods_attr' => $value['goods_attr'],
                        'current_send_number' => $value['current_send_number'],
                        'add_number' => $value['add_number'],
                        'remark' => $value['remark']
                    ]);
                }
                $this->success('保存成功',url('index'));
            }
            $this->error('保存失败');
            return;
        }
        $id = $this->request->param('id',0,'intval');
        if ($id <= 0) $this->error('参数错误');
        $delivery_order = db('delivery_order')->where(['id' => $id])->find();
        if (empty($delivery_order)) $this->error('送货单不存在');
        
        $goods_info = db('delivery_goods')->where(['delivery_id' => $id])->select();
        
        $db = db('order_goods og');
        $db->where(['og.order_id' => $delivery_order['order_id']]);
        $db->join('__GOODS__ g','og.goods_id=g.goods_id');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $goodslist = $db->field('og.*,g.store_number,gc.category_name')->select();
        
        $totalMoney = 0;
        foreach ($goodslist as $key => $value){
            $goodslist[$key]['diff_number'] = $value['goods_number'] - $value['send_num']; //未交数量
            foreach ($goods_info as $val){
                if ($value['goods_id'] == $val['goods_id']){
                    $goodslist[$key]['current_send_number'] = $val['current_send_number']; //本次送货数量
                    $goodslist[$key]['add_number'] = $val['add_number']; //入库数量
                    $goodslist[$key]['id'] = $val['id'];
                }
            }
            $totalMoney += $value['goods_number']*$value['goods_price'];
        }
        $this->assign('goodslist',json_encode($goodslist));
        $this->assign('delivery',$delivery_order);
        $this->assign('title','编辑送货单');
        return $this->fetch();
    }
    
    private $send_email = '';
    
    public function prints(){
            $id = $this->request->param('id',0,'intval');
            if ($id <= 0) $this->error('参数错误');
            $delivery = db('delivery_order')->where(['id' => $id,'status' => ['neq','-1']])->find();
            if (empty($delivery)) $this->error('送货单不存在');
            $title = '送货单';
            $goodsInfo = db('delivery_goods')->where(['delivery_id' => $delivery['id']])->order('goods_id asc')->select();
            $cus = db('customers')->where(['cus_id' => $delivery['cus_id']])->find();
            $this->assign('client',$cus);
            $this->assign('data',$delivery);
            
            //$this->send_email = $delivery['email'];
            
            if (!$delivery['is_print']){
                db('delivery_order')->where(['id' => $id])->setField('is_print',1);
            }
            $order = db('order')->where(['id' => $delivery['order_id']])->find();
            
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
            $strContent .= '<h2 style="text-align:center;padding:20px 0;">'.$title.'</h2>';
            
            $strContent .= '<table class="noborder">
<tbody>
    <tr>
    <td colspan="2">订单号：'.$delivery['order_dn'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">下单时间：'.date('Y-m-d',$order['create_time']).'</td>
    <td>送货时间：'.$delivery['delivery_date'].'</td>
    </tr>
    <tr>
    <td style="width:50%">收货单位：'.$delivery['cus_name'].'</td>
    <td>收货人：'.$delivery['contacts'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">联系电话：'.$delivery['contacts_tel'].'</td>
    <td>收货地址：'.$delivery['delivery_address'].'</td>
    </tr>
    <tr>
    <td style="width:50%;">送货司机：'.$delivery['delivery_driver'].'</td>
    <td>司机电话：'.$delivery['driver_tel'].'</td>
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
            <td width="25%">备注</td>
            </tr>';
            $count_goods = 0;
            foreach ($goodsInfo as $k => $val){
                $count_goods += $val['current_send_number'];
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
<td>'.$val['current_send_number'].'</td>
<td>'.$val['remark'].'</td>
    </tr>
    ';
            }
            
            $strContent .= '</tbody></table>';
            $img = getFileParams(11);
            //<td width="10%" align="left"><img src="'.$img.'" alt="" width="100px"/></td>
            $strContentFooter = '<table class="noborder" style="height:100px;">
<tbody>
    <tr>
    <td width="33%" align="left">发货人签章：</td>
    <td width="33%" align="left">承运人：</td>
    <td width="33%" align="left">客户签章：</td>
    </tr>
</tbody>
</table>';
            
            $mpdf->showWatermarkText = true;
            $mpdf->SetTitle($title);
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
            $type = 0;
            if ($type == 1){
                $savePath = './pdf/P'.str_replace('/', '-', $order['order_sn']).'.pdf';
                $mpdf->Output($savePath,'F');
                return $savePath;
            }
         $mpdf->Output();
         exit;
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
            if (db('delivery_order')->where(['delivery_sn' => $data['delivery_sn']])->find()){
                $this->error('送货单号已存在');
            }
            $delivery_id = db('delivery_order')->insertGetId($data);
            if ($delivery_id){
                foreach ($goods_info as $key => $value){
                    db('delivery_goods')->insert([
                        'delivery_id' => $delivery_id,
                        'goods_id' => $value['goods_id'],
                        'goods_name' => $value['goods_name'],
                        'unit' => $value['unit'],
                        'goods_attr' => $value['goods_attr'],
                        'current_send_number' => $value['current_send_number'],
                        'add_number' => $value['add_number'],
                        'remark' => $value['remark']
                    ]);
                }
                $this->success('保存成功',url('index'));
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
        $where = ['p.status' => ['>=','1']];
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