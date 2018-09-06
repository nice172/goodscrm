{extend name="public/base"}
{block name="header"}
<style>.tab-pane{padding-top:15px;}</style>
{/block}

{block name="sub_sidebar"}
{include file="goods/goods_sidebar"}
{/block}

{block name="main"}
<div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="console-title console-title-border clearfix">
                            <div class="pull-left">
                                <h5><span>修改商品</span></h5>
                                <a href="javascript:history.go(-1);" class="btn btn-default">
                                    <span class="icon-goback"></span><span>返回</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet margin-top-3">
 <form class="form-horizontal ajaxForm" method="post" action="<?php echo url('goods_edit');?>" id="form1">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">商品属性</a></li>
    <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">商品信息</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">其他信息</a></li>
  </ul>
<!--<div class="alert alert-warning alert-dismissible" role="alert">
    <strong>温馨提示</strong> 【KG/M】 和 【支长/M】 只能是整数或小数点后最多<B> 4 </B>位数，如：0.3542。
</div>-->
  <!-- Tab panes -->
  <input type="hidden" name="goods_id" value="{$goods.goods_id}" />
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="home">
						<div class="form-group">
                                    <label for="goods_name" class="col-sm-2 control-label"><span class="text-danger">*</span>商品名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" name="goods_name" value="<?php echo htmlspecialchars($goods['goods_name']);?>" id="goods_name" placeholder="输入商品名称">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label"><span class="text-danger">*</span>供应商</label>
                                    <div class="col-sm-10">
                                        <select name="supplier_id" class="form-control w300" id="supplier_id">
                                        <option value="">选择供应商</option>
                                        <?php foreach ($supplier as $key => $value):?>
                                        <option value="<?php echo $value['id']?>" {if condition="$goods['supplier_id'] eq $value['id']"}selected="selected"{/if}><?php echo $value['supplier_name'];?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span class="text-danger">*</span>商品分类</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-control w300" id="category_id">
                                        <option value="">选择分类</option>
                                        <?php foreach ($category as $key => $value):?>
                                        <option value="<?php echo $value['category_id'];?>" path="<?php echo $value['path'].'_'.$value['category_id'];?>" {if condition="$goods['category_id'] eq $value['category_id']"}selected="selected"{/if}>
			              		<?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', substr_count($value['path'], '_'));?>
			              		└<?php echo str_repeat('─', substr_count($value['path'], '_'));?>
			              		<?php echo $value['category_name'];?>
			              		</option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <!--
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span class="text-danger">*</span>商品品牌</label>
                                    <div class="col-sm-10">
                                        <select name="brand_id" class="form-control w300" id="brand_id">
                                        <option value="">选择品牌</option>
                                        <?php foreach ($brand as $key => $value):?>
                                        <option value="<?php echo $value['brand_id'];?>" {if condition="$goods['brand_id'] eq $value['brand_id']"}selected="selected"{/if}><?php echo $value['brand_name'];?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="unit" class="col-sm-2 control-label"><span class="text-danger">*</span>单位</label>
                                    <div class="col-sm-10">
                                        <select name="unit" class="form-control w300" id="unit">
                                        <option value="">选择单位</option>
                                        <?php foreach ($unit as $key => $value):?>
                                        <option value="<?php echo $value;?>" {if condition="$goods['unit'] eq $value"}selected="selected"{/if}><?php echo $value;?></option>
                                        <?php endforeach;?>
                                        </select>
<!--                                         <span>单支的总长度</span> -->
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label for="shop_price" class="col-sm-2 control-label"><span class="text-danger">*</span>采购价</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" name="shop_price" value="{$goods.shop_price}" id="shop_price" placeholder="输入采购价">
                                    </div>
                                </div>
                                                                <div class="form-group">
                                    <label for="market_price" class="col-sm-2 control-label"><span class="text-danger">*</span>销售价</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" name="market_price" value="{$goods.market_price}" id="market_price" placeholder="输入销售价">
                                    </div>
                                </div>
                          <div class="form-group">
                                    <label for="remark" class="col-sm-2 control-label">备注</label>
                                    <div class="col-sm-10">
                                        <textarea name="remark" id="remark" class="form-control w300" style="height: 150px;resize:none;">{$goods.remark}</textarea>
                                    </div>
                                </div>
        <div class="modal-footer">
        <div class="col-md-offset-2 col-md-8 left">
            <button type="button" class="btn btn-primary btn-one">上一步</button>
            <button type="button" class="btn btn-primary btn-last">下一步</button>
        </div>
    </div>
<!-- 
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">图片</label>
                                    <div class="col-sm-8">
                                        <input id="input-4" name="lximg" type="file" multiple class="file-loading form-control input-circle-right">
                                    </div>
                                </div>
 -->
    </div>
    <div role="tabpanel" class="tab-pane active" id="profile">
    
    <div class="form-group">
        <label for="goods_type_id" class="col-sm-2 control-label"><span class="text-danger"></span>商品类型</label>
        <div class="col-sm-10">
            <select name="goods_type_id" class="form-control attrChange w300" id="goods_type_id">
            <option value="0">选择商品类型</option>
            <?php foreach ($goods_type as $key => $value):?>
            <option value="<?php echo $value['goods_type_id'];?>" {if condition="$goods['goods_type_id'] eq $value['goods_type_id']"}selected="selected"{/if}><?php echo $value['type_name'];?></option>
            <?php endforeach;?>
            </select>
        </div>
    </div>
    
    <div class="appendAttr">{$goods.attr_html}</div>
        <div class="modal-footer">
        <div class="col-md-offset-2 col-md-8 left">
            <button type="button" class="btn btn-primary btn-two">下一步</button>
        </div>
    </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
           <div class="form-group">
            <label for="goods_weight" class="col-sm-2 control-label"><span class="text-danger"></span>商品重量</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300" name="goods_weight" id="goods_weight" value="{$goods.goods_weight}" placeholder="输入商品重量">
            </div>
        </div>
                   <div class="form-group">
            <label for="store_number" class="col-sm-2 control-label"><span class="text-danger"></span>商品库存</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300" name="store_number" value="{$goods.store_number}" id="store_number" placeholder="输入商品库存">
            </div>
        </div>
            <div class="form-group">
            <label for="store_attr" class="col-sm-2 control-label"><span class="text-danger"></span>库存属性</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300" name="store_attr" value="{$goods.store_attr}" id="store_attr" placeholder="输入库存属性">
            </div>
            </div>
              <div class="form-group">
            <label for="copyright" class="col-sm-2 control-label"><span class="text-danger"></span>所有权</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300" name="copyright" value="{$goods.copyright}" id="copyright" placeholder="输入所有权">
            </div>
        </div>
         <div class="form-group">
            <label for="address" class="col-sm-2 control-label"><span class="text-danger"></span>具体位置</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300" value="{$goods.address}" name="address" id="address" placeholder="输入具体位置">
            </div>
        </div>
        
    <div class="modal-footer">
        <div class="col-md-offset-2 col-md-8 left">
        	<button type="button" class="btn btn-primary btn-two">上一步</button>
            <button type="submit" class="btn btn-primary">保 存</button>
            <button type="button" onclick="history.go(-1);" class="btn btn-default">取 消</button>
        </div>
    </div>
        
    </div>
  </div>

</form>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
<!--icheck-->
<link href="/assets/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/icheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
function changeItem(_this){
	var goods_name = '';
	$('.attr_item').each(function(index){
		goods_name += $('.attr_item').eq(index).val()+' ';
	});
	if(goods_name != ''){
		goods_name = goods_name.substring(0,goods_name.length-1);
	}
	$('#goods_name').val(goods_name);
}
$(document).ready(function() {

	$('.btn-two').click(function(){
		$('.nav-tabs li').removeClass('active');
		$('.nav-tabs li').eq(1).addClass('active');
		$('.tab-content .tab-pane').removeClass('active');
		$('.tab-content .tab-pane').eq(0).addClass('active');
	});
	$('.btn-one').click(function(){
		$('.nav-tabs li').removeClass('active');
		$('.nav-tabs li').eq(0).addClass('active');
		$('.tab-content .tab-pane').removeClass('active');
		$('.tab-content .tab-pane').eq(1).addClass('active');
	});
	$('.btn-last').click(function(){
		$('.nav-tabs li').removeClass('active');
		$('.nav-tabs li').eq(2).addClass('active');
		$('.tab-content .tab-pane').removeClass('active');
		$('.tab-content .tab-pane').eq(2).addClass('active');
	});
	
        // 当前页面分类高亮
        $("#sidebar-storage").addClass("sidebar-nav-active"); // 大分类
        $("#storage-xingcai").addClass("active"); // 小分类

		$('.attrChange').change(function(){
			var goods_type_id = $(this).val();
			if(goods_type_id){
			$.get('<?php echo url('change_type');?>',{goods_type_id:goods_type_id},function(res){
				$('.appendAttr').html(res.data.html);
				$('#goods_name').val(res.data.goods_name);
			});
			}else{
				$('.appendAttr').html('');
			}
		});
		
		$('#category_id').change(function(){
			return;
			var category_id = $(this).val();
			if(!category_id){
				$('.attrChange').val(0);
				$('.appendAttr').html('');
				return;
			}
			$.get('<?php echo url('change_cate');?>',{category_id:category_id},function(res){
				if(res.code == 1){
					$('.attrChange').val(res.data.attr_id);
					$('.appendAttr').html(res.data.html);
				}else{
					$('.attrChange').val(0);
					$('.appendAttr').html('');
					}
			});
		});
        
        //料型颜色
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_square-blue', //颜色设置
            radioClass: 'iradio_square',
            increaseArea: '20%' // optional
        });

        //图片上传
        $("#input-4").fileinput({
            //uploadUrl: "/sycit.php/upload_img/index.html", //图片上传的地址
            allowedFileExtensions : ['jpg', 'png','gif'],//接收的文件后缀
            showUpload: false, //是否显示上传按钮
            showCaption: false,//是否显示标题
            showRemove: false,//是否显示删除
            showRemove: true,//是否显示删除
            showZoom: false,
            //预览图片的设置
            initialPreview: [
                "<img src='/uploads/noimage.png' class='file-preview-image' style='width:auto;height:100px;'>",
            ],
        });

    });
</script>
{/block}