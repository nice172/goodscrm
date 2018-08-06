{extend name="public/base" /}
{block name="main"}
<div class="main-content">
<script type="text/javascript">
	window.UEDITOR_HOME_URL = "<?php echo request()->domain();?>__PUBLIC__/ueditor/";  //配置编辑器相对路径
	window.onload = function(){
		window.UEDITOR_CONFIG.initialFrameWidth = '100%';		//配置编辑器宽度
		window.UEDITOR_CONFIG.initialFrameHeight = 500;			//配置编辑器高度
		UE.getEditor('container');			//载入编辑器
	};
	var dir = 'dir=goods';
</script>
	<div class="main-content-inner">
		<div class="page-content">
			
			<!-- #section:settings.box -->
			{include file="public/setting"}
			<!-- /section:settings.box -->
			
			<div class="page-header">
				<h1>您当前操作<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					{$current_title}
				</small></h1>
			</div>

			<div class="row">
				<div class="col-xs-12">
				{include file="public/top_menu"}

										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#home">基本信息</a>
												</li>
												<li>
													<a data-toggle="tab" href="#content">商品详情</a>
												</li>
												<li>
													<a data-toggle="tab" href="#photo">商品相册</a>
												</li>
												<li>
													<a data-toggle="tab" href="#params">商品参数</a>
												</li>
												<li>
													<a data-toggle="tab" href="#goods">规格</a>
												</li>
												<li>
													<a data-toggle="tab" href="#meta">META信息</a>
												</li>
											</ul>
									<form class="form-horizontal ajaxForm" name="goods_type_add" method="post" action="<?php echo url('');?>">
											<div class="tab-content">
												<div id="home" class="tab-pane fade in active">
										            
										            <div class="form-group">
										              <label for="pid" class="col-sm-2 control-label no-padding-right">所属分类：  </label>
										              <div class="col-sm-10">
										              <select name="category_id" id="category_id" class="col-xs-10 col-sm-4" required>
										              	<option value="0" path="0">├选择商品分类</option>
										              	<?php foreach ($category as $key => $value){ ?>
										              		<option value="<?php echo $value['category_id'];?>" path="<?php echo $value['path'].'_'.$value['category_id'];?>">
										              		<?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', substr_count($value['path'], '_'));?>
										              		└<?php echo str_repeat('─', substr_count($value['path'], '_'));?>
										              		<?php echo $value['category_name'];?>
										              		</option>
										              	<?php } ?>
										              </select>
										              </div>
										            </div>
										            <div class="space-4"></div>
										            <div class="form-group">
										              <label for="brand_id" class="col-sm-2 control-label no-padding-right">所属品牌：  </label>
										              <div class="col-sm-10">
										              <select name="brand_id" id="brand_id" class="col-xs-10 col-sm-4" required>
										              	<option value="0">选择品牌</option>
										              	<?php foreach ($brand as $key => $value){ ?>
										              		<option value="<?php echo $value['brand_id'];?>"><?php echo $value['brand_name'];?></option>
										              	<?php } ?>
										              </select>
										              </div>
										            </div>
										            <div class="space-4"></div>
										            <div class="form-group">
										              <label for="goods_type_id" class="col-sm-2 control-label no-padding-right">商品类型：  </label>
										              <div class="col-sm-10">
										              <select name="goods_type_id" id="goods_type_id" class="col-xs-10 col-sm-4" required>
										              	<option value="0">选择商品类型</option>
										              	<?php foreach ($goods_type as $key => $value){ ?>
										              		<option value="<?php echo $value['goods_type_id'];?>"><?php echo $value['type_name'];?></option>
										              	<?php } ?>
										              </select>
										              </div>
										            </div>
										            <div class="space-4"></div>
										          
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="goods_sn"> 商品编号：  </label>
														<div class="col-sm-10">
															<input type="text" name="goods_sn" id="goods_sn" placeholder="输入商品编号" class="col-xs-10 col-sm-4" required/>
														
														</div>
													</div>
													<div class="space-4"></div>
										            
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="goods_name"> 商品标题：  </label>
														<div class="col-sm-10">
															<input type="text" name="goods_name" id="goods_name" placeholder="输入商品标题" class="col-xs-10 col-sm-4" required/>
														
														<label class="middle" style="margin:5px 0 0 5px;">
															<input class="ace" value="bold" type="checkbox" id="id-disable-check">
															<span class="lbl"> 加粗</span>
														</label>
														</div>
													</div>
													<div class="space-4"></div>
													
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="goods_name_word"> 商品副标题：  </label>
														<div class="col-sm-10">
															<input type="text" name="goods_name_word" id="goods_name_word" placeholder="输入商品副标题" class="col-xs-10 col-sm-4" required/>
														<span class="help-inline col-xs-12 col-sm-7">
															<div class="bootstrap-colorpicker">
																颜色：<input id="colorpicker1" name="goods_name_style" type="text" class="input-small" />
															</div>
														</span>
														</div>
														
													</div>
													<div class="space-4"></div>
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="goods_price"> 商品价格：  </label>
														<div class="col-sm-10">
															<input type="text" name="goods_price" id="goods_price" placeholder="输入商品价格" class="col-xs-10 col-sm-4" required/>
														</div>
													</div>
													<div class="space-4"></div>
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="market_price"> 市场价格：  </label>
														<div class="col-sm-10">
															<input type="text" name="market_price" id="market_price" placeholder="输入市场价格" class="col-xs-10 col-sm-4" required/>
														</div>
													</div>
													<div class="space-4"></div>
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="goods_thumb"> 商品图片：  </label>
														<div class="col-sm-10">
															<input type="file" name="file" id="file" class="col-xs-10 col-sm-4"/>
															<div class="file-hidden"></div>
															<img src="" alt="" class="file-image" width="100" height="100" style="display:none;"/>
														</div>
													</div>
													<div class="space-4"></div>
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="market_price"> 商品标记：  </label>
														<div class="col-sm-10">
															<div class="checkbox">
													<label for="is_promote">
														<input name="form-field-checkbox" value="1" id="is_promote" name="is_promote" type="checkbox" class="ace" />
														<span class="lbl"> 促销</span>
													</label>
													<label>
														<input name="form-field-checkbox" value="1" name="is_hot" type="checkbox" class="ace" />
														<span class="lbl"> 热卖</span>
													</label>
													<label>
														<input name="form-field-checkbox" value="1" name="is_first" type="checkbox" class="ace" />
														<span class="lbl"> 首发</span>
													</label>
													<label>
														<input name="form-field-checkbox" value="1" name="is_well" type="checkbox" class="ace" />
														<span class="lbl"> 好评</span>
													</label>
												</div>
														</div>
													</div>
													<div class="space-4"></div>
													<div class="input-time" style="display: none;">
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="market_price"> 促销时间：  </label>
														<div class="col-sm-10"><div class="col-xs-8 col-sm-11">
															<div class="input-daterange input-group" style="width:330px;">
																	<input type="text" style="width:150px;" class="input-sm" id="promote_stime" name="promote_stime" />
																	<span class="input-group-addon">
																		<i class="fa fa-exchange"></i>
																	</span>
																	<input type="text" style="width:150px;" class="input-sm" id="promote_etime" name="promote_etime" />
																</div>
															</div>
														</div>
													</div>
													<div class="space-4"></div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="is_on_sale"> 是否上架：  </label>
														<div class="col-sm-10">
															<div class="checkbox">
													<label>
														<input name="form-field-checkbox" value="1" checked="checked" name="is_on_sale" type="checkbox" class="ace" />
														<span class="lbl"> 出售</span>
													</label>
													
												</div>
														</div>
													</div>
													<div class="space-4"></div>
														<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="sku"> 商品库存：  </label>
														<div class="col-sm-10">
															<input type="text" name="sku" id="sku" placeholder="输入商品库存" class="col-xs-10 col-sm-4" required/>
														</div>
													</div>
													<div class="space-4"></div>
														<div class="form-group">
														<label class="col-sm-2 control-label no-padding-right" for="unit"> 库存单位：  </label>
														<div class="col-sm-10">
															<input type="text" name="unit" id="unit" value="件" placeholder="输入库存单位" class="col-xs-10 col-sm-4" required/>
															<span class="help-inline col-xs-12 col-sm-7">
															<select class="form-control select-unit" style="width:80px;">
																<option value="件">件</option>
																<option value="个">个</option>
																<option value="只">只</option>
																<option value="箱">箱</option>
																<option value="台">台</option>
															</select>
															</span>
														</div>
													</div>
													<div class="space-4"></div>
												</div>
												<div id="content" class="tab-pane fade">
						    					<script id="container" name="content" type="text/plain">
        											商品详情
    												</script>
												</div>
												<div id="photo" class="tab-pane fade">
												<ul class="ace-thumbnails clearfix">
									
												</ul>
													<input type="file" name="file" id="file2"/>
												</div>
												<div id="params" class="tab-pane fade">
													params
												</div>
												<div id="goods" class="tab-pane fade">
													goods
												</div>
												<div id="meta" class="tab-pane fade">
													meta
												</div>
						<div class="clearfix">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								保存
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="ace-icon fa fa-undo bigger-110"></i>
								重置
							</button>
						</div>
					</div>
											</div>
											</form>
										</div>


				

				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->
{/block}
{block name="footer_static"}
<link rel="stylesheet" href="__PUBLIC__/laydate/theme/default/laydate.css" />
<script type="text/javascript" src="__PUBLIC__/laydate/laydate.js"></script>
<link rel="stylesheet" href="__PUBLIC__/uploadify/uploadify.css">
<script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify.min.js"></script>
<script src="__PUBLIC__/assets/js/jquery.colorbox.js"></script>
<script type="text/javascript">
laydate.render({
	  elem: '#promote_stime'
	  ,type: 'datetime'
});
laydate.render({
	  elem: '#promote_etime'
	  ,type: 'datetime'
});
$(function(){

	$('#colorpicker1').colorpicker();
	$('#simple-colorpicker-1').ace_colorpicker();
	$('label input#is_promote').click(function(){
		if ($(this).is(':checked')){
			$('.input-time').show();
		}else{
			$('.input-time').hide();
		}
	});
		$('.select-unit').change(function(){$('#unit').val($(this).find(':selected').val());});
        //设置uploadify上传插件
        $('#file').uploadify({
            swf : '__PUBLIC__/uploadify/uploadify.swf',
            width : 120,
            height : 35,
            //multi : false,
            buttonCursor : 'pointer',
            fileSizeLimit : '1MB',
            removeTimeout : 0,
            buttonText : '上传图片',
            uploader : '<?php echo url('upload');?>',
            fileTypeDesc : '图片类型',
            fileTypeExts : '*.png; *.jpeg; *.jpg; *.gif',
            overrideEvents: ['onSelectError','onSelect','onDialogClose'],
            onUploadStart : function () {},
            onSelectError : function (file, errorCode, errorMsg) {
                switch(errorCode) {
                 case -110:
                    
                    break;
                }
            },
            onUploadSuccess : function(file,data,status){
                var data = JSON.parse(data);
				var inputHtml = '';
                $.each(data,function(key,value){
                    if (key == 'small_thumb'){
						$('.file-image').attr('src',value).show();
                    }
					inputHtml += '<input type="hidden" value="'+value+'" name="'+key+'"/>';
                });
                $('.file-hidden').html(inputHtml);
            }
        });
        //设置uploadify上传插件
        $('#file2').uploadify({
            swf : '__PUBLIC__/uploadify/uploadify.swf',
            width : 120,
            height : 35,
            multi : true,
            buttonCursor : 'pointer',
            fileSizeLimit : '1MB',
            removeTimeout : 0,
            buttonText : '上传图片',
            uploader : '<?php echo url('upload');?>',
            fileTypeDesc : '图片类型',
            fileTypeExts : '*.png; *.jpeg; *.jpg; *.gif',
            overrideEvents: ['onSelectError','onSelect','onDialogClose'],
            onUploadStart : function () {},
            onSelectError : function (file, errorCode, errorMsg) {
                switch(errorCode) {
                 case -110:
                    
                    break;
                }
            },
            onUploadSuccess : function(file,data,status){
                var data = JSON.parse(data);
                var inputHtml = '<li>';
                $.each(data,function(key,value){
					inputHtml += '<input type="hidden" name="'+key+'[]" value="'+value+'"/>';
                });
            	inputHtml += '<a href="<?php echo request()->domain();?>'+data.source_thumb+'" target="_blank" data-rel="colorbox">';
            	inputHtml += '<img width="150" height="150" alt="150x150" src="<?php echo request()->domain();?>'+data.small_thumb+'" />';
				inputHtml += '</a><div class="tools"><a href="#">';
				inputHtml += '<i class="ace-icon fa fa-times red"></i>';
				inputHtml += '</a></div></li>';
                $('.ace-thumbnails').append(inputHtml);
            }
        });
});

</script>
<!-- 配置文件 -->
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.min.js"></script>
{/block}