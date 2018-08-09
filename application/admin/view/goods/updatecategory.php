<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header-model"}
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form method="post" class="ajaxForm" enctype="multipart/form-data" action="?">
            <input type="hidden" name="category_id" value="{$categoryInfo.category_id}" />
<!--         <div class="modal-header"> -->
<!--           <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
<!--             <span aria-hidden="true">&times;</span> -->
<!--             <span class="sr-only">关闭</span> -->
<!--           </button> -->
<!--           <h4 class="modal-title" id="exampleModalLabel">修改分类</h4> -->
<!--         </div> -->
        <div class="modal-body">
        
        	<div class="tabbable">
<!-- 				<ul class="nav nav-tabs" id="myTab"> -->
<!-- 					<li class="active"> -->
<!-- 						<a data-toggle="tab" href="#home">基本</a> -->
<!-- 					</li> -->
<!-- 					<li> -->
<!-- 						<a data-toggle="tab" href="#messages">META</a> -->
<!-- 					</li> -->
<!-- 				</ul> -->

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
			            <div class="form-group">
			              <label for="pid" class="control-label">上级分类:</label>
			              <select name="pid" id="pid" class="form-control">
			              	<option value="0" path="0">├顶级分类</option>
			              	<?php foreach ($lists as $key => $value){ ?>
			              		<option value="<?php echo $value['category_id'];?>" <?php if ($categoryInfo['pid']==$value['category_id']){echo 'selected="selected"';}?> path="<?php echo $value['path'].'_'.$value['category_id'];?>">
			              		<?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', substr_count($value['path'], '_'));?>
			              		└<?php echo str_repeat('─', substr_count($value['path'], '_'));?>
			              		<?php echo $value['category_name'];?>
			              		</option>
			              	<?php } ?>
			              </select>
			            </div>
			            <input type="hidden" value="0" name="path" id="path"/>
			            <div class="form-group">
			              <label for="goods_type_id" class="control-label">分类类型:</label>
			              <select name="goods_type_id" id="goods_type_id" class="form-control">
			              	<option value="0">请选择类型</option>
			              	<?php foreach ($goods_type as $key => $value){ ?>
			              	<option value="<?php echo $value['goods_type_id'];?>" <?php if ($categoryInfo['goods_type_id']==$value['goods_type_id']){echo 'selected="selected"';}?>><?php echo $value['type_name'];?></option>
			              	<?php } ?>
			              </select>
			            </div>
			            
			            <div class="form-group">
			              <label for="category_name" class="control-label">分类名称:</label>
			              <input type="text" name="category_name" value="<?php echo $categoryInfo['category_name'];?>" required="required" class="form-control" id="category_name">
			            </div>
			            <!--<div class="form-group hidden">
			              <label for="price_nums" class="control-label">价格区间个数:</label>
			              <input type="text" name="price_nums" required="required" class="form-control" id="price_nums">
			            </div>-->
            <div class="form-group hidden">
              <label for="" class="control-label">状态:</label>
              
				<div class="radio">
								<label>
					<input name="status" checked="checked" value="1" type="radio" class="ace">
					<span class="lbl">显示</span>
				</label>
				<label>
					<input name="status" value="0" type="radio" class="ace">
					<span class="lbl">禁用</span>
				</label>
			
				</div>
			  
            </div>
            <div class="form-group hidden">
              <label for="" class="control-label">是否导航:</label>
              
				<div class="radio">
				<label>
					<input name="is_nav" checked="checked" value="0" type="radio" class="ace">
					<span class="lbl">否</span>
				</label>
				&nbsp;&nbsp;
				<label>
					<input name="is_nav" value="1" type="radio" class="ace">
					<span class="lbl">是</span>
				</label>
				</div>
			  
            </div>          
            <div class="form-group">
              <label for="sort" class="control-label">排序:</label>
              <input type="text" name="sort" value="<?php echo $categoryInfo['sort'];?>" required="required" class="form-control" id="sort">
            </div>
               <div class="form-group">
			              <label for="desciption" class="control-label">分类描述:</label>
			              <textarea name="description" class="form-control" id="description" style="width: 100%;resize:none;"><?php echo $categoryInfo['description'];?></textarea>
			            </div>
            
					</div>

					<div id="messages" class="tab-pane fade">
			            <div class="form-group">
			              <label for="keywords" class="control-label">分类关键字:</label>
			              <input type="text" name="keywords" class="form-control" id="keywords">
			            </div>
			         
					</div>
				</div>
			</div>

        </div>
        <div class="modal-footer">
<!--           <button type="button" class="btn btn-secondary dismiss">关闭</button> -->
          <button type="submit" class="btn btn-primary">提交</button>
        </div>
        </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
	$('.ajaxForm').submit(function(){
		$(this).ajaxSubmit({
			success: function(res){
				if(res.code == 1){
					toastr.success(res.msg);
					setTimeout(function(){
						parent.window.location.reload();
						},2000);
				}else{
					toastr.error(res.msg);
					}
			}
		});
		return false;});
});
</script>
</body>
</html>