<?php
namespace app\admin\controller;

use think\Db;
use think\Session;

class Index extends Base {
    
    public function index(){
        //个人信息
        $user = Db::name('users')->alias('u')
            ->join('auth_group g', 'u.group_id = g.id')
            ->where('u.id',Session::get('user_id'))
            ->field('u.user_name,u.user_nick,u.id as uid,g.title')
            ->find();
        $pcount = Db::name('order')->where('status', '>', -1)->count();//共计订单

        $pshenc = Db::name('order')->where('status', '=', 1)->count();//未交货订单

        $pchuhuo = Db::name('order')->where('status', '=', 3)->count();//完成订单

        $pqueren = Db::name('order')->where('status', '=', 0)->count();//待确认订单

        $pqrdjin = Db::name('order')->where('status', '=',6)->count();//部分已送货

        $pqrchuku = Db::name('order')->where('status', '>=',1)
        ->where(['create_time' => ['>=',strtotime(date('Y-m-d'))]])
        ->where(['create_time' => ['<=',strtotime(date('Y-m-d 23:59:59'))]])
        ->count('distinct cus_id');//今日下单客户
        //今日下单金额
        $pqrweikuan = _formatMoney(Db::name('order')->where('status', '>=',1)
        ->where(['create_time' => ['>=',strtotime(date('Y-m-d'))]])
        ->where(['create_time' => ['<=',strtotime(date('Y-m-d 23:59:59'))]])->sum('total_money'));

        $yesterday = date('Y-m-d',strtotime('-1 day'));
        $yesterday_cus = Db::name('order')->where('status', '>=',1)
        ->where(['create_time' => ['>=',strtotime($yesterday)]])
        ->where(['create_time' => ['<=',strtotime($yesterday.' 23:59:59')]])
        ->count('distinct cus_id');//昨天下单客户
        //昨天下单金额
        $yesterday_money = _formatMoney(Db::name('order')->where('status', '>=',1)
        		->where(['create_time' => ['>=',strtotime($yesterday)]])
        		->where(['create_time' => ['<=',strtotime($yesterday.' 23:59:59')]])->sum('total_money'));

        $day_7 = date('Y-m-d',strtotime('-7 day'));
        $yesterday_7_cus = Db::name('order')->where('status', '>=',1)
        ->where(['create_time' => ['>=',strtotime($day_7)]])
        ->where(['create_time' => ['<=',strtotime(date('Y-m-d 23:59:59'))]])
        ->count('distinct cus_id');//近7天下单客户
        //近7天下单金额
        $yesterday_7_money = _formatMoney(Db::name('order')->where('status', '>=',1)
        		->where(['create_time' => ['>=',strtotime($day_7)]])
        		->where(['create_time' => ['<=',strtotime(date('Y-m-d 23:59:59'))]])->sum('total_money'));
        
        $day_30 = date('Y-m-d',strtotime('-30 day'));
        $yesterday_30_cus = Db::name('order')->where('status', '>=',1)
        ->where(['create_time' => ['>=',strtotime($day_30)]])
        ->where(['create_time' => ['<=',strtotime(date('Y-m-d 23:59:59'))]])
        ->count('distinct cus_id');//近30天下单客户
        //近30天下单金额
        $yesterday_30_money = _formatMoney(Db::name('order')->where('status', '>=',1)
        		->where(['create_time' => ['>=',strtotime($day_30)]])
        		->where(['create_time' => ['<=',strtotime(date('Y-m-d 23:59:59'))]])->sum('total_money'));
        $top5Result = Db::query('SELECT MAX(total_money) as total_money,cus_id FROM syc_order GROUP BY cus_id order by total_money limit 5');
        $top5 = [];
        if (!empty($top5Result)){
            foreach ($top5Result as $key => $value){
                $cus = db('customers')->where(['cus_id' => $value['cus_id']])->field('cus_name,cus_short')->find();
                $top5[] = [
                    'name' => isset($cus['cus_name']) ? $cus['cus_name'] : '',
                    'y' => $value['total_money']
                ];
            }
        }
        $this->assign('top5',$top5);
        //获取当前年份
        $dateD = date('Y');
        //获取当前月份 $dateM = date('m');
        //获取月份的最后一天 date('t',strtotime('2017-8')) //31
        //循环当前查询的年份，每个月销售
        for ($i=1;$i<=12;$i++) {
            $dqy = $dateD.'-'.$i;  //月份
            $dqy1 = $dqy.'-01 0:0:0'; //月份第一天
            $dqy2 = $dqy.'-'. date('t',strtotime($dqy)) .' 23:59:59'; //月份最后一天
            $dateArr[] = Db::name('order')
                ->where('status','>=',1)
                ->where('create_time', '>=',strtotime($dqy1))
                ->where('create_time', '<=', strtotime($dqy2))
                ->count();
        }
        
        $assign = [
            'title'  => '首页',
            'user'  => $user,
            'pcount' => $pcount,
            'pshenc' => $pshenc,
            'pchuhuo' => $pchuhuo,
            'pqueren' => $pqueren,
            'pqrdjin' => $pqrdjin,
            'pqrweikuan' => $pqrweikuan,
            'pqrchuku' => $pqrchuku,
        	'yesterday' => $yesterday_cus,
        	'yesterday_money' => $yesterday_money,
        	'yesterday_7_cus' => $yesterday_7_cus,
        	'yesterday_7_money' => $yesterday_7_money,
        	'yesterday_30_cus' => $yesterday_30_cus,
        	'yesterday_30_money' => $yesterday_30_money,
            'dateD' => $dateD,
            'dateArr' => json_encode($dateArr),
        ];
        $this->assign($assign);
        
        $record_list = db('baojia')->where(['status' => ['neq','-1']])
        ->order('create_time desc')->limit(5)->select();
        $this->assign('record_list',$record_list);
        
        $delivery_list = db('delivery_order do')
        ->join('__ORDER__ o','do.order_id=o.id')
        ->join('__CUSTOMERS__ c','c.cus_id=do.cus_id')
        ->field('do.*,o.require_time,o.order_remark,c.cus_order_ren')
        ->order('do.id desc')->select();
        $this->assign('delivery_list',$delivery_list);
        
        $db = db('goods g');
        $where = ['g.status' => ['neq','-1']];
        $db->where($where);
        $db->field('g.*,gc.category_name,s.supplier_name');
        $db->join('__GOODS_CATEGORY__ gc','g.category_id=gc.category_id');
        $db->join('__SUPPLIER__ s','s.id=g.supplier_id');
        $result = $db->paginate(config('PAGE_SIZE'),false, ['query' => $this->request->param()]);
        $this->assign('page',$result->render());
        $this->assign('list',$result);
        
        return $this->fetch();
    }
}
