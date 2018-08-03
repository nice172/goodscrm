<?php

namespace app\index\controller;

use app\index\model\Bancai;
use app\index\model\BancaiList;
use app\index\model\ProductNumber;
use app\index\model\StockpileLock;
use app\index\model\StorageCharge;
use app\index\model\Stockpile;
use think\Db;
use think\Session;
use think\Url;
use think\Request;

class Storage extends Common_base
{
    public function _initialize()
    {
        // 是否有权限
        IS_ROOT([1,3])  ? true : $this->error('没有权限');
        return parent::_initialize(); // TODO: Change the autogenerated stub
    }

    //铝材数量
    public function index() {
        $Request = Request::instance();
        $q = $Request->param('q');
        $lime = '25';
        //总重量
        $zongzl = '0';
        //颜色
        $name = Db::name('product_color')->field('pc_id,pc_name')->order('pc_id', 'asc')->select();
        //料型
        $list = StorageCharge::order('lxid', 'asc')->paginate($lime);
        //统计颜色数量
        $count = count($name);
        //
        if (empty($name) || empty($list)) {
            $list = [];
        } else {
            foreach ($list AS $kl=>$vl) {
                foreach ($name AS $ka=>$va) {
                    $list[$kl]['sun'] = Db::name('stockpile')->where('sp_lxid', $vl['lxid'])
                        ->field('sp_quantity')->order('sp_pcid', 'asc')->select();
                    $list[$kl]['zongshu'] =  Db::name('stockpile')->where('sp_lxid', $vl['lxid'])->sum('sp_quantity');
                }
            }
            //storage_charge stockpile
            $subLx = Db::name('storage_charge')->field('lxid,lxkg,lxzhic')->select();
            foreach ($subLx as $ks=>$vs) {
                $dzzl = $vs['lxkg'] * $vs['lxzhic'];
                $zzl = Db::name('stockpile')->where('sp_lxid', $vs['lxid'])->sum('sp_quantity');
                $zhongliang[] = $dzzl * $zzl;
                //unset($dzzl);
                //unset($zzl);
            }
            if (!empty($zhongliang)) {
                $zongzl = sprintf('%.2f', array_sum($zhongliang));
            }
        }
        if ($count <= 1) {
            $pagecol = 7+1;
        } else {
            $pagecol = 7+$count;
        }

        // 获取分页显示
        if (empty($list)) {
            $page = '';
        } else {
            $page = $list->render();
        }

        $assign = [
            'title' => '铝材数量',
            'name' => $name,
            'list' => $list,
            'count' => $count,
            'zongzl' => $zongzl,
            'page' => $page,
            'pagecol' => $pagecol,
            'empty'=> '<tr><td colspan="'.$pagecol.'" align="center">当前条件没有查到数据</td></tr>'
        ];

        $this->assign($assign);
        return $this->fetch();
        //p($name);
        //p($zongzl);
        //p($count);
        //p($pagecol);
    }

    //料型列表
    public function charge() {
        $lime = '25';
        $model = new StorageCharge();
        $list = $model->paginate($lime);
        // 获取分页显示
        $page = $list->render();
        $assign = [
            'title' => '铝材管理',
            'list' => $list,
            'page' => $page,
            'empty'=> '<tr><td colspan="8" align="center">当前条件没有查到数据</td></tr>'
        ];

        $this->assign($assign);
        return $this->fetch();
    }

    //新增料型
    public function charge_add() {
        $Request = Request::instance();
        if ($Request->isPost()) {
            //提交动作
            $file = request()->file('lximg'); // 获取上传文件
            $lxname = strFilter(cutstr_html($Request->param('lxname')));
            $lxxhao = $Request->param('lxxh');
            $lxkg   = $Request->param('lxkg');
            $lxzhic = $Request->param('lxzhic');

            //判断数字型
            if (!is_numeric($lxkg) || !is_numeric($lxzhic)) {
                $this->error('KG 或 支长格式错误');
            }

            if (empty($lxname)) {
                $this->error('名称没有填写');
            }

            $byName = StorageCharge::getByLxname($lxname);
            if ($byName) {
                $this->error('已存在名称');
            }

            $data = [
                'lxname' => $lxname,
                'lxxhao'   => $lxxhao,
                'lxkg'   => $lxkg,
                'lxzhic' => $lxzhic,
                'lx_uid' => Session::get('user_id'),
            ];
            //p($data);
            //exit();
            if (!empty($file)) {
                // 上传图片 移动 用 rule('uniqid') 无序
                $info = $file->validate([
                    'type' => 'image/jpeg,image/gif,image/png', // 上传文件头
                    'ext' => 'jpeg,jpg,png', // 上传类型
                    'size'=> 0.5 * 1024 * 1024, // 上传大小
                ])->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'images');
                // 判断信息
                if ($info) {
                    $image = DS . 'uploads'. DS .'images'. DS . $info->getSaveName();
                    //替换windows 下的 \
                    $data['lximg'] = str_replace("\\",'/',$image);
                } else {
                    // 上传失败获取错误信息
                    $this->error('上传图片失败');
                }
            }

            $model = new StorageCharge($_POST);
            $model->data($data);
            $result = $model->allowField(true)->save();

            if ($result) {
                //新增库存 $model->lxid; 获取自增ID
                $yanse = Db::name('product_color')->field('pc_id')->select();
                if (!empty($yanse)) {
                    $Stockpile = new Stockpile();
                    foreach ($yanse AS $ky=>$vy) {
                        $list[] = [
                            'sp_pcid'    => $vy['pc_id'],
                            'sp_lxid'    => $model->lxid,
                            'sp_quantity'=> '0',
                        ];
                    }
                    $Stockpile->saveAll($list);
                    $this->success('添加成功，并已更新库存',Url::build('storage/charge'));
                } else {
                    $this->success('添加成功，但无产品颜色',Url::build('storage/charge'));
                }

            } else {
                $this->error('服务器错误，请通知管理员');
            }
        } else {
            //添加
            $assign = [
                'title' => '新增铝材',
            ];

            $this->assign($assign);
            return $this->fetch();
        }
    }

    //修改料型
    public function charge_edit() {
        $Request = Request::instance();
        $pid = $Request->param('pid');
        if (!StorageCharge::get($pid)) {
            $this->error('参数错误');
        }
        $model = new StorageCharge();
        if ($Request->isPost()) {
            //提交动作
            $yanse = isset($_POST['lxyanse']) ? $_POST['lxyanse'] : '';
            $file = request()->file('lximg'); // 获取上传文件

            $lxxhao = $Request->param('lxxh');
            $lxkg   = $Request->param('lxkg');
            $lxzhic = $Request->param('lxzhic');

            //判断数字型
            if (!is_numeric($lxkg) || !is_numeric($lxzhic)) {
                $this->error('KG 或 支长格式错误');
            }

            $lx_yanse = StorageCharge::get($pid);
            if (!$lx_yanse) {
                $this->error('提交的参数错误');
            }

            $data = [
                'lxxhao'   => $lxxhao,
                'lxkg'   => $lxkg,
                'lxzhic' => $lxzhic,
            ];
            if (!empty($file)) {
                // 上传图片 移动 用 rule('uniqid') 无序
                $info = $file->validate([
                    'type' => 'image/jpeg,image/gif,image/png', // 上传文件头
                    'ext' => 'jpeg,jpg,png', // 上传类型
                    'size'=> 0.5 * 1024 * 1024, // 上传大小
                ])->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'images');
                // 判断信息
                if ($info) {
                    $image = DS . 'uploads'. DS .'images'. DS . $info->getSaveName();
                    //替换windows 下的 \
                    $data['lximg'] = str_replace("\\",'/',$image);
                } else {
                    // 上传失败获取错误信息
                    $this->error('上传图片失败');
                }
            }

            $result = $model->save($data, ['lxid' => $pid]);

            if ($result) {
                $this->success('修改成功',Url::build('storage/charge'));
            } else {
                $this->error('服务器错误，请通知管理员');
            }
        } else {
            //修改
            $data = $model->where('lxid', $pid)->find();
            $assign = [
                'title' => '修改料型',
                'data' => $data,
            ];

            $this->assign($assign);
            return $this->fetch();
            //p($yase);
        }
    }

    //查询料型名称
    public function charge_name() {
        $Request = Request::instance();
        $name = $Request->param('name');
        if ($Request->isPost()) {
            $result = Db::name('storage_charge')->where('lxname', $name)->find();
            if ($result) {
                return false;
            } else {
                return true;
            }
        }
    }

    //删除料型
    public function charge_delete() {
        $Request = Request::instance();
        if ($Request->isPost()) {
            $pid = $Request->param('pid');
            $name = $Request->param("name");
            if (empty($pid)) {
                $this->error('传入参数错误');
            }
            if ($name == 'delone') {
                // 单条删除操作
                //删除料型
                StorageCharge::where('lxid', $pid)->delete();
                //删除关联库存
                Stockpile::where('sp_lxid', $pid)->delete();

                $this->success('删除成功', Url::build('storage/charge'));
            } else {
                $this->error('传入参数错误');
            }
        }
    }

    //板材数量
    public function bancainum() {
        $Request = Request::instance();
        $q = $Request->param('q');
        $lime = '25';
        //颜色
        $name = Db::name('product_color')->field('pc_id,pc_name')->order('pc_id', 'asc')->select();
        //料型
        $list = BancaiList::order('create_time', 'desc')->paginate($lime);
        //统计颜色数量
        $count = count($name);
        //
        if (empty($name) || empty($list)) {
            $list = [];
        } else {
            foreach ($list AS $kl=>$vl) {
                foreach ($name AS $ka=>$va) {
                    $list[$kl]['sun'] = Db::name('bancai')->where('bplid', $vl['blid'])
                        ->field('bquantity')->order('bpcid', 'asc')->select();
                    $list[$kl]['zongshu'] =  Db::name('bancai')->where('bplid', $vl['blid'])->sum('bquantity');
                }
            }
        }

        if ($count <= 1) {
            $pagecol = 4+1;
        } else {
            $pagecol = 4+$count;
        }

        // 获取分页显示
        if (empty($list)) {
            $page = '';
        } else {
            $page = $list->render();
        }

        $assign = [
            'title' => '板材数量',
            'name' => $name,
            'list' => $list,
            'count' => $count,
            'page' => $page,
            'pagecol' => $pagecol,
            'empty'=> '<tr><td colspan="'.$pagecol.'" align="center">当前条件没有查到数据</td></tr>'
        ];

        $this->assign($assign);
        return $this->fetch();
    }

    //板材管理
    public function bancailist() {
		$lime = '25';
        $model = new BancaiList();
        $list = $model->paginate($lime);
        // 获取分页显示
        $page = $list->render();
        $assign = [
            'title' => '板材管理',
            'list' => $list,
            'page' => $page,
            'empty'=> '<tr><td colspan="5" align="center">当前条件没有查到数据</td></tr>'
        ];

        $this->assign($assign);
        return $this->fetch();
    }

    //新增板材
    public function bancai_add() {
        $Request = Request::instance();
        if ($Request->isPost()) {
            //Post动作
            $file = request()->file('blimg'); // 获取上传文件
            $blname = strFilter(cutstr_html($Request->param('blname')));
            $bguige = $Request->param('bguige');

            if (empty($bguige)) {
                $this->error('规格没有填写');
            }

            if (empty($blname)) {
                $this->error('名称没有填写');
            }

            $byName = Db::name('bancai_list')->where('blname', $blname)->find();
            if ($byName) {
                $this->error('系列中已存在编号');
            }
            $data = [
                'blname' => $blname,
                'bguige'   => $bguige,
                'bl_uid' => Session::get('user_id'),
            ];
            if (!empty($file)) {
                // 上传图片 移动 用 rule('uniqid') 无序
                $info = $file->validate([
                    'type' => 'image/jpeg,image/gif,image/png', // 上传文件头
                    'ext' => 'jpeg,jpg,png', // 上传类型
                    'size'=> 0.5 * 1024 * 1024, // 上传大小
                ])->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'images');
                // 判断信息
                if ($info) {
                    $image = DS . 'uploads'. DS .'images'. DS . $info->getSaveName();
                    //替换windows 下的 \
                    $data['blimg'] = str_replace("\\",'/',$image);
                } else {
                    // 上传失败获取错误信息
                    $this->error('上传图片失败');
                }
            }
            //保存
            $model = new BancaiList($_POST);
            $model->data($data);
            $result = $model->allowField(true)->save();

            if ($result) {
                //新增库存 $model->blid; 获取自增ID
                $yanse = Db::name('product_color')->field('pc_id')->select();
                if (!empty($yanse)) {
                    $Bancai = new Bancai();
                    foreach ($yanse AS $ky=>$vy) {
                        $list[] = [
                            'bpcid'    => $vy['pc_id'],
                            'bplid'    => $model->blid,
                            'bquantity'=> '0',
                        ];
                    }
                    if (!$Bancai->saveAll($list)) {
                        Db::name('bancai_list')->delete($model->blid);
                        $this->error('服务器错误，请通知管理员');
                    }
                    $this->success('添加成功，并已更新库存',Url::build('storage/bancailist'));
                } else {
                    $this->success('添加成功，但无产品颜色',Url::build('storage/bancailist'));
                }
            } else {
                $this->error('服务器错误，请通知管理员');
            }
        } else {
            //视图
            $number = Db::name('product_number')->field('pn_id,pn_name')->select();
            //添加
            $assign = [
                'title' => '新增板材',
                'number'=>$number,
            ];

            $this->assign($assign);
            return $this->fetch();
        }
    }

    //修改板材
    public function bancai_edit() {
        $Request = Request::instance();
        $pid = $Request->param('pid');
        if (!BancaiList::get($pid)) {
            $this->error('参数错误');
        }
        if ($Request->isPost()) {
            // POST动作
            $file = request()->file('blimg'); // 获取上传文件
            $bguige = $Request->param('bguige');

            if (empty($bguige)) {
                $this->error('规格没有填写');
            }

            $data = [
                'bguige'   => $bguige,
            ];
            if (!empty($file)) {
                // 上传图片 移动 用 rule('uniqid') 无序
                $info = $file->validate([
                    'type' => 'image/jpeg,image/gif,image/png', // 上传文件头
                    'ext' => 'jpeg,jpg,png', // 上传类型
                    'size'=> 0.5 * 1024 * 1024, // 上传大小
                ])->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'images');
                // 判断信息
                if ($info) {
                    $image = DS . 'uploads'. DS .'images'. DS . $info->getSaveName();
                    //替换windows 下的 \
                    $data['blimg'] = str_replace("\\",'/',$image);
                } else {
                    // 上传失败获取错误信息
                    $this->error('上传图片失败');
                }
            }
            $model = new BancaiList();
            $result = $model->save($data, ['blid' => $pid]);

            if ($result) {
                $this->success('修改成功',Url::build('storage/bancailist'));
            } else {
                $this->error('服务器错误，请通知管理员');
            }
        } else {
            $data = Db::name('bancai_list')->where('blid', $pid)->find();
            $assign = [
                'title' => '修改板材',
                'data' => $data,
            ];

            $this->assign($assign);
            return $this->fetch();
        }
    }

    //删除板材
    public function bancai_delete() {

        $Request = Request::instance();
        if ($Request->isPost()) {
            $pid = $Request->param('pid');
            $name = $Request->param("name");
            if (empty($pid)) {
                $this->error('传入参数错误');
            }
            if ($name == 'delone') {
                // 单条删除操作
                //删除板材
                BancaiList::where('blid', $pid)->delete();
                //删除关联库存
                Bancai::where('bplid', $pid)->delete();

                $this->success('删除成功', Url::build('storage/bancailist'));
            } else {
                $this->error('传入参数错误');
            }
        }
    }

    //查询板材名称
    public function bancai_name() {
        $Request = Request::instance();
        $blname = $Request->param('blname');
        if ($Request->isPost()) {
            $result = Db::name('bancai_list')->where('blname', $blname)->find();
            if ($result) {
                return false;
            } else {
                return true;
            }
        }
    }

    //配件数量
    public function peijian() {
        $Request = Request::instance();
        $q = $Request->param('q');
        $lime = '25';

        //锁具
        $list = StockpileLock::order('create_time', 'desc')->paginate($lime);

        // 获取分页显示
        $page = $list->render();
        $assign = [
            'title' => '配件数量',
            //'name' => $name,
            'list' => $list,
            'page' => $page,
            'empty'=> '<tr><td colspan="4" align="center">当前条件没有查到数据</td></tr>'
        ];

        $this->assign($assign);
        return $this->fetch();
    }

    //铝材进料
    public function numlc() {
        $Request = Request::instance();
        $name = $Request->param('name');

        if ($Request->isPost()) {
            //保存
            $quantity = $Request->param('sp_quantity/a');
            if (empty($name) || !is_array($quantity)) {
                $this->error('提交数据出错');
            }
            $Stockpile = new Stockpile();
            $AllData = [];

            //判断提交的方式
            if ($name == 'save') {
                foreach ($quantity as $k=>$v) {
                    $get = Stockpile::get($k);
                    //只有正整数才保存数据 strpos($v,".") == false
                    if(is_numeric($v) || strpos($v,".") == false && !empty($v)) {
                        $AllData[] = [
                            'sp_id' => $k,
                            'sp_quantity' => $v + $get->sp_quantity,
                        ];
                    }
                }
            }
            $Stockpile->saveAll($AllData);
            $this->success('保存成功', Url::build('storage/numlc'));
            //p($AllData);
        } else {
            //颜色
            $name = Db::name('product_color')->field('pc_id,pc_name')->order('pc_id', 'asc')->select();
            //料型
            $list = StorageCharge::order('lxid', 'asc')->select();
            //统计颜色数量
            $count = count($name);

            if (empty($name) || empty($list)) {
                $list = [];
            } else {
                foreach ($list AS $kl=>$vl) {
                    foreach ($name AS $ka=>$va) {
                        $list[$kl]['sun'] = Db::name('stockpile')->where('sp_lxid', $vl['lxid'])
                            ->field('sp_id,sp_quantity')->order('sp_pcid', 'asc')->select();
                        $list[$kl]['zongshu'] =  Db::name('stockpile')->where('sp_lxid', $vl['lxid'])->sum('sp_quantity');
                    }
                }
            }
            if ($count <= 1) {
                $pagecol = 3+1;
            } else {
                $pagecol = 3+$count;
            }

            $assign = [
                'title' => '铝材进料',
                'name' => $name,
                'list' => $list,
                'count' => $count,
                'pagecol' => $pagecol,
                'empty'=> '<tr><td colspan="'.$pagecol.'" align="center">当前条件没有查到数据</td></tr>'
            ];

            $this->assign($assign);
            return $this->fetch();
        }
    }

    //板材进料
    public function numbc() {
        $Request = Request::instance();
        $name = $Request->param('name');
        if ($Request->isPost()) {
            //保存
            $quantity = $Request->param('bquantity/a');
            if ($name !='save' || !is_array($quantity)) {
                $this->error('提交数据出错');
            }
            $Bancai = new Bancai();
            $AllData = [];
            foreach ($quantity as $k=>$v) {
                $get = Bancai::get($k);
                $num = $get->bquantity;
                //只有正整数才保存数据
                if(is_numeric($v) || strpos($v,".") == false && !empty($v)) {
                    $AllData[] = [
                        'bid' => $k,
                        'bquantity' =>$v + $num,
                    ];
                }
            }
            $Bancai->saveAll($AllData);
            $this->success('保存成功', Url::build('storage/numbc'));
            //p($AllData);
        } else {
            //颜色
            $name = Db::name('product_color')->field('pc_id,pc_name')->order('pc_id', 'asc')->select();
            //料型
            $list = BancaiList::order('create_time', 'desc')->select();
            //统计颜色数量
            $count = count($name);
            //
            if (empty($name) || empty($list)) {
                $list = [];
            } else {
                foreach ($list AS $kl=>$vl) {
                    foreach ($name AS $ka=>$va) {
                        $list[$kl]['sun'] = Db::name('bancai')->where('bplid', $vl['blid'])
                            ->field('bid,bquantity')->order('bpcid', 'asc')->select();
                        $list[$kl]['zongshu'] =  Db::name('bancai')->where('bplid', $vl['blid'])->sum('bquantity');
                    }
                }
            }

            if ($count <= 1) {
                $pagecol = 5+1;
            } else {
                $pagecol = 5+$count;
            }

            $assign = [
                'title' => '板材进料',
                'name' => $name,
                'list' => $list,
                'count' => $count,
                'pagecol' => $pagecol,
                'empty'=> '<tr><td colspan="'.$pagecol.'" align="center">当前条件没有查到数据</td></tr>'
            ];

            $this->assign($assign);
            return $this->fetch();
        }
    }

    //配件进料
    public function numpj() {
        $Request = Request::instance();
        $name = $Request->param('name');

        if ($Request->isPost()) {
            //保存数据
            //保存
            $quantity = $Request->param('st_quantity/a');
            if ($name !='save' || !is_array($quantity)) {
                $this->error('提交数据出错');
            }
            $Bancai = new StockpileLock();
            $AllData = [];
            foreach ($quantity as $k=>$v) {
                $get = StockpileLock::get($k);
                $num = $get->st_quantity;
                //只有正整数才保存数据
                if(is_numeric($v) || strpos($v,".") == false && !empty($v)) {
                    $AllData[] = [
                        'stid' => $k,
                        'st_quantity' =>$v + $num,
                    ];
                }
            }
            $Bancai->saveAll($AllData);
            $this->success('保存成功', Url::build('storage/numpj'));
            //p($AllData);
        } else {
            //锁具
            $list = StockpileLock::order('create_time', 'desc')->select();

            $assign = [
                'title' => '配件进料',
                //'name' => $name,
                'list' => $list,
                'empty'=> '<tr><td colspan="4" align="center">当前条件没有查到数据</td></tr>'
            ];

            $this->assign($assign);
            return $this->fetch();
        }
    }
}