<?php
namespace app\admin\controller;

use think\Image;
use think\Validate;

class Goods extends Base {
	
	protected $scene = 'add';
	
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index(){
		
		$goods_name = $this->request->param('goods_name');
		$supplier_name = $this->request->param('supplier_name');
		$categroy_id = $this->request->param('categroy_id',0,'intval');
				
		if (empty($supplier_name)){
			$where = ['status' => ['neq','-1']];
			if ($goods_name != ''){
				$where['goods_name'] = ['like',"%$goods_name%"];
			}
			if (!empty($categroy_id)){
			    $where['category_id'] = $categroy_id;
			}
			$result = db('goods')->where($where)->order('create_time desc')->paginate(config('PAGE_SIZE'),false,['query' => $this->request->param()]);
		}
		
		if (!empty($supplier_name)){
			$where = [
				's.supplier_name' => ['like',"%{$supplier_name}%"],
			];
			if (!empty($goods_name)){
				$where['g.goods_name'] = ['like',"%$goods_name%"];
			}
			if (!empty($categroy_id)){
			    $where['g.category_id'] = $categroy_id;
			}
			$result = db('goods g')->join('__SUPPLIER__ s','g.supplier_id=s.id')
			->where($where)->order('g.create_time desc')->paginate(config('PAGE_SIZE'),false,['query' => $this->request->param()]);
		}
		
		$lists = $result->all();
		
		foreach ($lists as $key => $value){
			$supplier = db('supplier')->where(['id' => $value['supplier_id']])->find();
			$lists[$key]['supplier_name'] = $supplier['supplier_name'];
			$category = db('goods_category')->where(['category_id' => $value['category_id']])->find();
			$lists[$key]['category_name'] = $category['category_name'];
			$brand = db('goods_brand')->where(['brand_id' => $value['brand_id']])->find();
			$lists[$key]['brand_name'] = $brand['brand_name'];
		}
		
		$this->assign('list',$lists);
		$this->assign('page',$result->render());
		$category = db('goods_category')->where(array('status' => 1))->select();
		$this->assign('category',$category);
	    $this->assign('title','商品维护');
	    $this->assign('sub_class','viewFramework-product-col-1');
	    return $this->fetch();
	}
	
	public function goodsdel(){
		if ($this->request->isAjax()){
			$goods_id = $this->request->param('gid',0,'intval');
			if ($goods_id <= 0){
				$this->error('参数错误');
			}
			if (db('goods')->where(['goods_id' => $goods_id])->setField('status','-1')){
				$this->success('删除成功');
			}
			$this->error('删除失败');
		}
	}
	
	public function goodsinfo(){
		$goods_id = $this->request->param('gid',0,'intval');
		if ($goods_id <= 0){
			$this->error('参数错误');
		}
		$find = db('goods')->where(array(
			'goods_id' => $goods_id,
			'status' => ['neq','-1']
		))->find();
		if (empty($find)) $this->error('商品信息不存在');
		$find['category_name'] = db('goods_category')->where(['category_id' => $find['category_id']])->value('category_name');
		$find['supplier_name'] = db('supplier')->where(['id' => $find['supplier_id']])->value('supplier_name');
		$find['brand_name'] = db('goods_brand')->where(['brand_id' => $find['brand_id']])->value('brand_name');
		if ($find['goods_type_id'] != 0){
			$find['goods_type'] = db('goods_type')->where(['goods_type_id' => $find['goods_type_id']])->value('type_name');
			$find['goods_attr'] = json_decode($find['goods_attr'],true);
		}
		$this->assign('data',$find);
		$this->assign('title','商品维护');
		$this->assign('sub_class','viewFramework-product-col-1');
		return $this->fetch();
	}
	
	//商品类型
	public function goods_type(){
		$lists = db('goods_type')->paginate(config('PAGE_SIZE'));
		$this->assign('lists',$lists);
		$this->assign('page',$lists->render());
		return $this->fetch();
	}
	
	public function updatetypename(){
		if ($this->request->isAjax()){
			$data = $this->request->post();
			if (empty($data['type_name'])) $this->ajaxReturn(array('code' => 0,'msg' => '名称不能为空'));
			$find = db('goods_type')->where(array(
					'type_name' => $data['type_name'],
					'goods_type_id' => array('NEQ',$data['goods_type_id'])
			))->find();
			if (!empty($find)) $this->ajaxReturn(array('code' => 0,'msg' => '名称已存在'));
			if (!db('goods_type')->where(array('goods_type_id' => $data['goods_type_id']))->setField('type_name',$data['type_name'])){
				$this->ajaxReturn(array('code' => 0,'msg' => '修改名称失败'));
			}
		}
	}
	
	public function updatesort(){
		if ($this->request->isAjax()){
			$data = $this->request->post();
			if ($data['sort'] < 0) $data['sort'] = 1;
			if (!db('goods_attr')->where(array('goods_attr_id' => $data['goods_attr_id']))->setField('sort',intval($data['sort']))){
				$this->ajaxReturn(array('code' => 0,'msg' => '排序失败'));
			}
		}
	}
	
	public function brandsort(){
		if ($this->request->isAjax()){
			$data = $this->request->post();
			if ($data['sort'] < 0) $data['sort'] = 1;
			if (!db('goods_brand')->where(array('brand_id' => $data['brand_id']))->setField('sort',intval($data['sort']))){
				$this->ajaxReturn(array('code' => 0,'msg' => '排序失败'));
			}
		}
	}
	
	public function deletetype(){
		if ($this->request->isAjax()){
			$data = $this->request->param();
			db('goods_type')->where(array(
					'goods_type_id' => $data['goods_type_id'],
			))->delete();
			$this->ajaxReturn(array('code' => 1,'msg' => '删除成功'));
		}
	}
	
	public function delbrand(){
		if ($this->request->isAjax()){
			$data = $this->request->param();
			db('goods_brand')->where(array(
					'brand_id' => $data['brand_id'],
			))->delete();
			$this->ajaxReturn(array('code' => 1,'msg' => '删除成功'));
		}
	}
	
	public function deleteattr(){
		if ($this->request->isAjax()){
			$data = $this->request->param();
			db('goods_attr')->where(array(
					'goods_attr_id' => $data['goods_attr_id'],
			))->delete();
			$this->ajaxReturn(array('code' => 1,'msg' => '删除成功'));
		}
	}
	
	public function add_type(){
		if ($this->request->isAjax()){
			$data = $this->request->post();
			if (empty($data)) $this->ajaxReturn(array('code' => 0,'msg' => '名称不能为空'));
			$find = db('goods_type')->where(array(
					'type_name' => $data['type_name'],
			))->find();
			if (!empty($find)) $this->ajaxReturn(array('code' => 0,'msg' => '名称已存在'));
			if (db('goods_type')->insert($data)){
				$this->ajaxReturn(array('code' => 1,'msg' => '添加成功','url' => url('goods_type')));
			}
			$this->ajaxReturn(array('code' => 0,'msg' => '添加失败'));
		}else{
			return $this->fetch();
		}
	}
	
	public function typeparams(){
		$goods_type_id = intval(input('goods_type_id'));
		$map = ['goods_type_id' => $goods_type_id];
		$param = $this->request->param();
		if (isset($param['attr_type'])){
			$map['attr_type'] = intval($param['attr_type']);
		}
		$lists = db('goods_attr')->order('sort asc')->where($map)->paginate(config('PAGE_SIZE'));
		$this->assign('lists',$lists);
		$this->assign('page',$lists->render());
		unset($map['attr_type']);
		$goodsType = db('goods_type')->where($map)->find();
		$this->assign('goodsType',$goodsType);
		return $this->fetch();
	}
		
	public function add_attr(){
	    if ($this->request->isAjax()){
	        $data = $this->request->post();
	        if (empty($data)) $this->ajaxReturn(['code' => 0,'msg' => '参数名称不能为空']);
	        $data['attr_type'] = 1;
	        //if (db('goods_attr')->where(['attr_name' => $data['attr_name']])->find()){
	        //    $this->error('属性名称已存在');
	        //}
	        if (db('goods_attr')->insert($data)){
	            $this->ajaxReturn(['code' => 1,'msg' => '添加成功']);
	        }
	        $this->ajaxReturn(['code' => 0,'msg' => '添加失败']);
	    }
	    $goods_type_id = intval(input('goods_type_id'));
	    $map = ['goods_type_id' => $goods_type_id];
	    $param = $this->request->param();
	    if (isset($param['attr_type'])){
	        $map['attr_type'] = intval($param['attr_type']);
	    }
	    unset($map['attr_type']);
	    $goodsType = db('goods_type')->where($map)->find();
	    if (empty($goodsType)) $this->error('操作失败');
	    $this->assign('goodsType',$goodsType);
        return $this->fetch();
	}
	
	public function edit_attr(){
	    if ($this->request->isAjax()){
	        $data = $this->request->post();
	        if (empty($data['attr_name'])) $this->ajaxReturn(['code' => 0,'msg' => '名称不能为空']);
	        //if (db('goods_attr')->where(['goods_attr_id' => ['NEQ',$data['goods_attr_id']],'attr_name' => $data['attr_name']])->find()){
	        //    $this->error('属性名称已存在');
	        //}
	        if (db('goods_attr')->update($data)){
	            $this->ajaxReturn(['code' => 1,'msg' => '修改成功']);
	        }
	        $this->ajaxReturn(['code' => 0,'msg' => '修改失败']);
	    }
	    $goods_attr_id = intval(input('goods_attr_id'));
	    $map = ['goods_attr_id' => $goods_attr_id];
	    $goodsAttr = db('goods_attr')->where($map)->find();
	    if (empty($goodsAttr)) $this->error('操作失败');
	    $this->assign('goodsAttr',$goodsAttr);
	    return $this->fetch();
	}
	
	public function brand(){
		$lists = db('goods_brand')->paginate(config('PAGE_SIZE'));
		$this->assign('lists',$lists);
		$this->assign('page',$lists->render());
		$this->assign('title','商品维护');
		$this->assign('sub_class','viewFramework-product-col-1');
		return $this->fetch();
	}
	
	public function get_brand(){
		if ($this->request->isAjax()){
			$data = $this->request->param();
			$find = db('goods_brand')->where(array(
					'brand_id' => $data['brand_id'],
			))->find();
			$this->success('ok','',$find);
		}
	}
	
	public function addbrand(){
		if ($this->request->isAjax()){
			$data = $this->request->post();
			if (config('CLOUD_UPLOAD')){
				if (isset($_FILES['file']) && !empty($_FILES['file'])){
					$aliOss = new \AliOss();
					$options = array(
						'name' => $_FILES['file']['name'],
						'file' => $_FILES['file']['tmp_name'],
						'size' => $_FILES['file']['size'],
						'error' => $_FILES['file']['error'],
						//'subDir' => '',
					);
					$info = $aliOss->upload_file($options);
					if (is_array($info)){
						$data['brand_logo'] = $info['filename'];
						$data['cloud_upload'] = 1;
					}
				}
			}else{
				// $info = $this->upload_file('brand');
				//$data['brand_logo'] = $info['path'];
				$data['brand_logo'] = '';
			}
			if (isset($data['brand_id']) && intval($data['brand_id']) > 0){
			    if (db('goods_brand')->update($data)){
			        $this->ajaxReturn(['code' => 1,'msg' => '修改成功']);
			    }
			    $this->ajaxReturn(['code' => 0,'msg' => '修改失败']);
			    return;
			}
			if (db('goods_brand')->insert($data)){
				$this->ajaxReturn(['code' => 1,'msg' => '新增成功']);
			}
			$this->ajaxReturn(['code' => 0,'msg' => '新增失败']);
		}
	}
	
	public function category(){
		$lists = db('goods_category')->select();
		$this->assign('lists',$lists);
		$this->assign('page','');
		$goods_type = db('goods_type')->field(array('goods_type_id','type_name'))->select();
		$new_goods_type = array();
		foreach ($goods_type as $key => $value) {
			$new_goods_type[$value['goods_type_id']] = ['goods_type_id' => $value['goods_type_id'],'type_name' => $value['type_name']];
		}
		$this->assign('title','商品维护');
		$this->assign('sub_class','viewFramework-product-col-1');
		$this->assign('goods_type',$new_goods_type);
		return $this->fetch();
	}
	
	public function deletecategory(){
	    if ($this->request->isAjax()){
	        $category_id = $this->request->param('category_id',0,'intval');
	        $categoryInfo = db('goods_category')->where(['category_id' => $category_id])->find();
	        if (empty($categoryInfo)) $this->error('分类信息不存在',url('category'));
	        if (db('goods_category')->where(['category_id' => $category_id])->delete()){
	            $this->success('删除成功');
	        }
	        $this->error('删除失败');
	    }
	}
	
	public function updatecategory(){
	    $category_id = $this->request->param('category_id',0,'intval');
	    $categoryInfo = db('goods_category')->where(['category_id' => $category_id])->find();
	    if (empty($categoryInfo)) $this->error('分类信息不存在',url('category'));
	    if ($this->request->isAjax()){
	        $db = db('goods_category');
	        $name = $this->request->param('category_name');
	        if (!empty($db->where(['category_id' => array('NEQ',$category_id),'category_name' => $name])->find())){
	            $this->error('分类名称已存在');
	        }
	        if ($db->update($this->request->param())){
	            $this->success('修改成功');
	        }
	        $this->error('修改失败');
	        return;
	    }
	    $this->assign('categoryInfo',$categoryInfo);
	    $lists = db('goods_category')->select();
	    $this->assign('lists',$lists);
	    $goods_type = db('goods_type')->field(array('goods_type_id','type_name'))->select();
	    $new_goods_type = array();
	    foreach ($goods_type as $key => $value) {
	        $new_goods_type[$value['goods_type_id']] = ['goods_type_id' => $value['goods_type_id'],'type_name' => $value['type_name']];
	    }
	    $this->assign('goods_type',$new_goods_type);
	    return $this->fetch();
	}
	
	public function addcategory(){
		if ($this->request->isAjax()){
			$data = $this->request->post();
			// if (empty($data['goods_type_id'])) $this->error('请选择类型');
			if (empty($data['category_name'])) $this->error('请输入分类名称');
			if (db('goods_category')->insert($data)){
				$this->success('新增成功');
			}
			$this->error('新增失败');
		}
	}
	
	public function getgoodstype(){
		if ($this->request->isAjax()){
			$goods_type_id = intval($this->request->param('goods_type_id'));
			$goods_attr = db('goods_attr')->where(array('goods_type_id' => $goods_type_id))->field(array('goods_attr_id','attr_name'))->select();
			if (!empty($goods_attr)){
				
				$this->ajaxReturn(array('status' => 1,'data' => $goods_attr));
			}	
				$this->ajaxReturn(array('status' => 0));
		}
	}
	
	public function updatefilter(){
		if ($this->request->isAjax()){
			$data = $this->request->post();
			$category_id = intval($data['category_id']);
			$string = implode(',', array_filter($data['filter_attr']));
			if (db('goods_category')->where(array('category_id' => $category_id))->setField('filter_attr',$string)){
				$this->ajaxReturn(array('code' => 1,'msg' => '操作完成'));
			}
			$this->ajaxReturn(array('code' => 0,'msg' => '操作失败'));
		}
	}
	
	private $goods_name = '';
	
	public function change_type(){
	    if ($this->request->isAjax()){
	    	$goods_type_id = $this->request->param('goods_type_id',0,'intval');
	    	$html = self::getHtml($goods_type_id);
	    	$this->success('','',['goods_name' => rtrim($this->goods_name,' '),'attr_id' => $goods_type_id,'html' => $html]);
	    }
	}
	
	public function change_cate(){
	    if ($this->request->isAjax()){
	        $category_id = $this->request->param('category_id',0,'intval');
	        $goods_type_id = db('goods_category')->where(['category_id' => $category_id])->value('goods_type_id');
	        if($goods_type_id){
	           $html = self::getHtml($goods_type_id);
	           $this->success('','',['goods_name' => rtrim($this->goods_name,' '),'attr_id' => $goods_type_id,'html' => $html]);
	        }else{
	            $this->error('');
	        }
	    }
	}
	
	private function getHtml($goods_type_id,$goods_attr=[]){
	    $attr = db('goods_attr')->where(['goods_type_id' => $goods_type_id,'attr_type' => 1])->order('sort asc')->select();
		$html = '';
		foreach ($attr as $key => $value){
			$attr_value = explode("\n", $value['attr_value']);
			$html .= '<div class="form-group">';
			$html .= '<label for="goods_weight" class="col-sm-2 control-label">'.$value['attr_name'].'</label>';
			$html .= '<div class="col-sm-10"><select class="form-control w300 attr_item" onchange="changeItem(this)" name="attr['.$value['goods_attr_id'].']">';
			foreach ($attr_value as $v_key => $val){
				if (empty($goods_attr)){
				    if ($v_key == 0){
				        $this->goods_name .= $attr_value[$v_key].' ';
				    }
					$html .= '<option value="'.$val.'">'.$val.'</option>';
				}else{
					$selected = '';
					foreach ($goods_attr as $x_val){
						if ($x_val['goods_attr_id']==$value['goods_attr_id'] && $x_val['attr_value']==$val){
							$selected = 'selected="selected"';
							break;
						}
					}
					$option = '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
					$html .= $option;
				}
			}
			$html .= '</select></div></div>';
		}
		return $html;
	}
	
	protected $goods_rules = [
		'goods_name' => 'require',
		'supplier_id' => 'require',
		'category_id' => 'require',
		//'brand_id' => 'require',
		'unit' => 'require',
		'shop_price' => 'require|number',
		'market_price' => 'require|number',
		//'goods_weight' => 'require',
		//'store_number' => 'require|number',
		//'store_attr' => 'require',
		//'copyright' => 'require',
		//'address' => 'require'
	];
	protected $goods_message = [
		'goods_name.require' => '商品名称不能为空',
		'supplier_id.require' => '请选择供应商',
		'category_id.require' => '请选择商品分类',
		//'brand_id.require' => '请选择商品品牌',
		'unit.require' => '请选择单位',
		'shop_price.require' => '采购价不能为空',
		'shop_price.number' => '采购价不正确',
		'market_price.require' => '销售价不能为空',
		'market_price.number' => '销售价不正确',
		//'goods_weight.require' => '商品重量不能为空',
		//'store_number.require' => '商品库存不能为空',
		//'store_number.number' => '商品库存不正确',
		//'store_attr.require' => '库存属性不能为空',
		//'copyright.require' => '所有权不能为空',
		//'address.require' => '具体位置不能为空',
	];
	
	public function add(){
	    if ($this->request->isAjax()){
	        $data = $this->request->param();
	        $validate = new Validate($this->goods_rules,$this->goods_message);
	        if (!$validate->check($data)){
	        	$this->error($validate->getError());
	        }
	        $data['supplier_id'] = intval($data['supplier_id']);
	        if ($data['supplier_id'] <= 0) $this->error('选择供应商不正确');
	        $data['category_id'] = intval($data['category_id']);
	        if ($data['category_id'] <= 0) $this->error('选择商品分类不正确');
	        //$data['brand_id'] = intval($data['brand_id']);
	        //if ($data['brand_id'] <= 0) $this->error('选择品牌不正确');
	        if ($data['shop_price'] < 0) $this->error('采购价不正确');
	        if ($data['market_price'] < 0) $this->error('销售价不正确');
	        $goods_attr = [];
	        if (!empty($data['attr'])){
	            foreach ($data['attr'] as $attr_id => $value){
	                $attr = db('goods_attr')->where(['goods_attr_id' => $attr_id])->field('attr_name')->find();
	                if (!empty($attr)) {
	                    $goods_attr[] = [
	                        'goods_attr_id' => $attr_id,
	                        'attr_name' => $attr['attr_name'],
	                    	'attr_value' => $value,
	                    ];
	                }
	            }
	            $data['goods_attr'] = json_encode($goods_attr);
	        }
	        unset($data['attr']);
	        $data['create_time'] = time();
	        $data['update_time'] = time();
	        $data['status'] = 1;
	        if ($insertId = db('goods')->insert($data)){
	            foreach ($goods_attr as $attrValue){
	                $attrValue['goods_id'] = $insertId;
	                db('goods_attr_val')->insert($attrValue);
	            }
	            $this->success('新增成功');
	        }else{
	            $this->error('新增失败');
	        }
	        return;
	    }
	    
		$category = db('goods_category')->where(array('status' => 1))->select();
		$this->assign('category',$category);
		
		$brand = db('goods_brand')->where(array('status' => 1))->select();
		$this->assign('brand',$brand);
		
		$goods_type = db('goods_type')->field(array('goods_type_id','type_name'))->select();
		$this->assign('goods_type',$goods_type);
		
		$supplier = db('supplier')->where(['supplier_status' => 1])->field(array('supplier_name','id'))->select();
		$this->assign('supplier',$supplier);
		
		$unit = getParams(9);
		if (!empty($unit)){
		    $unit = $unit['params_value'];
		}
		$this->assign('unit',$unit);
		$this->assign('title','商品维护');
		$this->assign('sub_class','viewFramework-product-col-1');
		return $this->fetch();
	}
	
	public function goods_edit(){
		if ($this->request->isAjax()){
			$data = $this->request->param();
			$validate = new Validate($this->goods_rules,$this->goods_message);
			if (!$validate->check($data)){
				$this->error($validate->getError());
			}
			$data['supplier_id'] = intval($data['supplier_id']);
			if ($data['supplier_id'] <= 0) $this->error('选择供应商不正确');
			$data['category_id'] = intval($data['category_id']);
			if ($data['category_id'] <= 0) $this->error('选择商品分类不正确');
			//$data['brand_id'] = intval($data['brand_id']);
			//if ($data['brand_id'] <= 0) $this->error('选择品牌不正确');
			if ($data['shop_price'] < 0) $this->error('采购价不正确');
			if ($data['market_price'] < 0) $this->error('销售价不正确');
			$goods_attr = [];
			if (!empty($data['attr'])){
				foreach ($data['attr'] as $attr_id => $value){
					$attr = db('goods_attr')->where(['goods_attr_id' => $attr_id])->field('attr_name')->find();
					if (!empty($attr)) {
						$goods_attr[] = [
							'goods_attr_id' => $attr_id,
							'attr_name' => $attr['attr_name'],
							'attr_value' => $value,
						];
					}
				}
			}
			if (empty($goods_attr)){
				$data['goods_attr'] = '';
			}else{
				$data['goods_attr'] = json_encode($goods_attr);
			}
			unset($data['attr']);
			$data['update_time'] = time();
			if (db('goods')->update($data)){
			    db('goods_attr_val')->where(['goods_id' => $data['goods_id']])->delete();
			    foreach ($goods_attr as $attrValue){
			        $attrValue['goods_id'] = $data['goods_id'];
			        db('goods_attr_val')->insert($attrValue);
			    }
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
			return;
		}
		$goods_id = $this->request->param('gid',0,'intval');
		if ($goods_id <= 0) $this->error('参数错误');
		$goodinfo = db('goods')->where(['goods_id' => $goods_id,'status' => ['neq','-1']])->find();
		if (empty($goodinfo)) $this->error('商品信息不存在');
		$goodinfo['goods_attr'] = json_decode($goodinfo['goods_attr'],true);
		$goodinfo['attr_html'] = self::getHtml($goodinfo['goods_type_id'],$goodinfo['goods_attr']);
		$this->assign('goods',$goodinfo);
		
		$category = db('goods_category')->where(array('status' => 1))->select();
		$this->assign('category',$category);
		
		$brand = db('goods_brand')->where(array('status' => 1))->select();
		$this->assign('brand',$brand);
		
		$goods_type = db('goods_type')->field(array('goods_type_id','type_name'))->select();
		$this->assign('goods_type',$goods_type);
		
		$supplier = db('supplier')->where(['supplier_status' => 1])->field(array('supplier_name','id'))->select();
		$this->assign('supplier',$supplier);
		
		$unit = getParams(9);
		if (!empty($unit)){
			$unit = $unit['params_value'];
		}
		$this->assign('unit',$unit);
		$this->assign('title','商品维护');
		$this->assign('sub_class','viewFramework-product-col-1');
		return $this->fetch();
	}
	
	public function upload(){
		//云上传
		if (config('CLOUD_UPLOAD')){
			$goodsImage = array(
// 				'small_thumb' => $small_thumb,
// 				'medium_thumb' => $medium_thumb,
// 				'source_thumb' => $data['path']
			);
		}else{
			$data = $this->upload_file('goods');
			$Image = Image::open('.'.$data['path']);
			$filename = $data['filename'];
			$path = mb_substr($data['path'], 0,strpos($data['path'], $filename));
			$small_thumb = $path.'small_thumb_'.$filename;
			$Image->thumb(150, 150, \think\Image::THUMB_CENTER)->save('.'.$small_thumb);
			$medium_thumb = $path.'medium_htumb_'.$filename;
			$Image->thumb(350, 350, \think\Image::THUMB_CENTER)->save('.'.$medium_thumb);
			$goodsImage = array(
				'small_thumb' => $small_thumb,
				'medium_thumb' => $medium_thumb,
				'source_thumb' => $data['path']
			);
		}
		$this->ajaxReturn($goodsImage);
	}
	
	
}