<?php
namespace app\admin\controller;

use think\Image;

class Goods extends Base {
	
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index(){
		
	    $this->assign('page','');
	    $this->assign('list',[]);
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
		$lists = db('goods_attr')->where($map)->paginate(config('PAGE_SIZE'));
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
	        if (db('goods_attr')->where(['attr_name' => $data['attr_name']])->find()){
	            $this->error('属性名称已存在');
	        }
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
	        if (db('goods_attr')->where(['goods_attr_id' => ['NEQ',$data['goods_attr_id']],'attr_name' => $data['attr_name']])->find()){
	            $this->error('属性名称已存在');
	        }
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
	
	public function change_type(){
	    if ($this->request->isAjax()){
	        $goods_type_id = $this->request->param('goods_type_id',0,'intval');
	        $attr = db('goods_attr')->where(['goods_type_id' => $goods_type_id,'attr_type' => 1])->select();
	        $html = '';
	        foreach ($attr as $key => $value){
	            $attr_value = explode("\n", $value['attr_value']);
	            $html .= '<div class="form-group">';
	            $html .= '<label for="goods_weight" class="col-sm-2 control-label">'.$value['attr_name'].'</label>';
	            $html .= '<div class="col-sm-10"><select class="form-control w300" name="attr['.$value['goods_attr_id'].']">';
	            foreach ($attr_value as $val){
	                $html .= '<option value="'.$val.'">'.$val.'</option>';
	            }
	            $html .= '</select></div></div>';
	        }
	        echo $html;
	    }
	}
	
	public function add(){
	    
	    if ($this->request->isAjax()){
	        $data = $this->request->param();
	        if (!empty($data['attr'])){
	            $goods_attr = [];
	            foreach ($data['attr'] as $attr_id => $value){
	                $attr = db('goods_attr')->where(['goods_attr_id' => $attr_id])->field('attr_name')->find();
	                if (!empty($attr)) {
	                    $goods_attr[] = [
	                        'goods_attr_id' => $attr_id,
	                        'attr_name:' => $attr['attr_name']
	                    ];
	                }
	            }
	            $data['goods_attr'] = json_encode($goods_attr);
	        }
	        unset($data['attr']);
	        $data['create_time'] = time();
	        $data['update_time'] = time();
	        $data['status'] = 1;
	        if (db('goods')->insert($data)){
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